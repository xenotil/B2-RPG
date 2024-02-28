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
    private function handleCombat(array $formData) : void {
        if($this->player->health > 0){
            $damagePlayer = $this->player->damage - $this->ennemy->defense;
            $this->ennemy->health = $this->ennemy->health - $damagePlayer;
            $this->storage->save('ennemy',$this->ennemy);
            $this->logAction("Vous infliger : " . $damagePlayer . "damage a " . $this->ennemy->name);
        } else{

        }
        if ($this->ennemy->health > 0){
            $damageEnnemy = $this->ennemy->damage - $this->player->defense;
            $this->player->health = $this->player->health - $damageEnnemy;
            $this->storage->save('player',$this->player);
            $this->logAction($this->ennemy->name . " vous infliger : " . $damageEnnemy . "damage");
        }else{
            $this->player->level = $this->player->level + $this->ennemy->level;
            $this->storage->save('player',$this->player);
            $this->logAction($this->ennemy->name. " est mort Felicitation!");
            $this->logAction($this->player->name. " gagne un Niveaux !");
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
        } else if ( $this->player->level > 1){
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