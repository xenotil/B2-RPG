<?php

namespace Rpg;

use Rpg\Models\Player;
use Rpg\Models\Archetype;
use Rpg\Models\Ennemys\MonsterFactory;
use Rpg\Models\Ennemys\Ennemy;


class GameEngine {
    private SessionStorage $storage;
    public ?Player $player;
    public ?Ennemy $ennemy;
    public array $logs;

    public function __construct(){
        $this->storage = new SessionStorage();
    }

    // Accède à l'objet storage afin d'alimenter les attributs dans notre moteur
    private function retrieveDataFromSession() : void {
        $this->logs = $this->storage->get('logs') ?: [];
        $this->player = $this->storage->get('player');
        $this->ennemy = $this->storage->get('ennemy');
        
    }

    // Ajoute un message à la boîte de log en bas à droite
    private function logAction(string $action) : void {
        $message = date("H:i:s") . " : " . $action;
        $this->logs[] = $message;
        $this->storage->save('logs', $this->logs);
    }

    // Réinitialise le storage, associé au bouton en bas à droite
    private function resetStorage() : void {
        $this->storage->reset();
    }
  
    // Utilisation du formulaire de choix de nom et de class
    private function CreatPersonage(array $formData){
        $player = NULL;
        switch($formData['class']){
            case'warrior':
                $player = new Archetype\Warrior($formData['player-name'],);
                break;
            case'clerc':
                $player = new Archetype\Clerc($formData['player-name'], 10, 10, 5, 5, 1, 0, 2, 5);
                break;
            case'mage':
                $player = new Archetype\Mage($formData['player-name'], 10, 10, 5, 5, 1, 0, 2, 5);
                break;
            default: 
                break;
                //throw 
        }
        $this->storage->save('player', $player);

        $this->logAction("Personnage créé : " . $player->name);
        $this->logAction("Class sélectionnée : ".$player->label);
    }
    private function Ennemy(){
        $factory = new MonsterFactory();
        $ennemy = $factory->generatMonster($this->player->level); 
        $this->storage->save('ennemy',$ennemy);
        $this->logAction("Ennemy créé : " . $ennemy->name);
    }
    private function handleCombat(array $formData): void {
        // Check if the player chose to use a special attack
        $useSpecialAttack = isset($formData['special_attack']) && $formData['special_attack'] === 'true';
    
        if ($this->player->health > 0) {
            // Player's turn
            if ($useSpecialAttack && $this->player->mana >= 5) {
                // Use special attack
                $this->player->specialAttack($this->ennemy);
                $this->logAction("Vous utilisez une attaque spéciale!");
            } else {
                // Use basic attack
                $this->player->BasicAttack($this->ennemy);
                $this->logAction("Vous infligez " . $this->player->damage . " de dégâts à " . $this->ennemy->name);
            }
        }
    
        if ($this->ennemy->health > 0) {
            // Enemy's turn
            $this->ennemy->BasicAttack($this->player);
            $this->logAction($this->ennemy->name . " vous inflige " . $this->ennemy->damage . " de dégâts");
        } else {
            // Player wins the battle
            $this->player->level += $this->ennemy->level;
            $this->storage->save('player', $this->player);
            $this->logAction($this->ennemy->name . " est mort! Félicitations!");
            $this->player->xp += $this->ennemy->xp; // Assuming you have xp for defeating enemies
            $this->storage->save('player', $this->player);
    
            // Check if the player leveled up
            if ($this->player->xp >= $this->player->level) {
                $this->player->levelup();
                $this->logAction("Vous avez monté de niveau!");
            }
    
            $this->ennemy = NULL;
            $this->storage->save('ennemy', $this->ennemy);
        }
    }
    

    // Méthode appelée lorsqu'on fait soumet un formulaire,
    // utilise le champ caché "form" afin de rediriger sur la méthode associée
    // Une fois la requête traitée, on redirige sur la page par défaut
    private function handleForm(array $formData) : void {
        switch($formData['form']){
            case 'reset-storage':
                $this->resetStorage();
                break;
            case 'class-selector':
                $this->CreatPersonage($formData);
                break;
            case 'First-ennemy':
                $this->Ennemy();
                break;
            case 'attaque':
                $this->handleCombat($formData);
                break;
            default:
                throw new \Exception("Formulaire pas géré : " . $formData['form']);
        }

        // Redirection sur la page par défaut
        header('Location: /');
        exit;
    }

    private function render(){
         // Choix du template d'affichage selon l'état du jeu
        if($this->player == NULL){
            require 'views/player-name-form.view.php';
        } else if ( $this->ennemy == NULL){
            require 'views/safe-zone.view.php';
        } else if($this->player->health <= 0){
            require 'views/defeat-screen.view.php';
        } else if($this->ennemy && $this->player){
            require 'views/combat-first-ennemy.view.php';
        } else {
            require 'views/example.view.php';
        } 
    }

    public function run() : void {
        // Récupération des données
        $this->retrieveDataFromSession();

        // Traitement des formulaires
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->handleForm($_POST);
        } else {
           $this->render();
        }
    }
}

?>