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
    private function retrieveDataFromSession(): void {
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
        // Get the type of attack from the form data
        $attackType = isset($formData['attaque']) ? $formData['attaque'] : '';
    
        // Validate the attack type
        if ($attackType !== 'basic_attack' && $attackType !== 'special_attack') {
            throw new \Exception("Attaque non reconnue : " . $attackType);
        }
    
        // Perform the corresponding attack based on the attack type
        switch ($attackType) {
            case 'basic_attack':
                // Perform basic attack
                $this->player->basicAttack($this->ennemy);
                $this->logAction("Vous avez attaqué " . $this->ennemy->name . " avec une attaque de base.");
                break;
            case 'special_attack':
                // Perform special attack
                $this->player->specialAttack($this->ennemy);
                $this->logAction("Vous avez utilisé une attaque spéciale contre " . $this->ennemy->name . ".");
                break;
            default:
                throw new \Exception("Attaque non reconnue : " . $attackType);
        }
    
        // Save the enemy's health after each attack
        $this->storage->save('ennemy', $this->ennemy);
    
        // Check if the enemy is defeated
        if ($this->ennemy->health <= 0) {
            $this->player->xp = $this->ennemy->level;
            $this->player->gold = $this->ennemy->gold + $this->player->gold;
            if ($this->player->xp >= $this->player->level) {
                $this->player->levelUp();
                $this->logAction($this->ennemy->name . " est mort ! Félicitations, vous avez monté de niveau !");
            } else {
                $this->logAction($this->ennemy->name . " est mort ! Vous avez gagné de l'expérience.");
            }
    
            // Set the enemy to null and save it to storage
            $this->ennemy = null;
            $this->storage->save('ennemy', $this->ennemy);
        } else {
            // If enemy is still alive, perform the enemy's basic attack on the player
            if ($this->ennemy !== null) {
                $this->ennemy->basicAttack($this->player);
                $this->logAction($this->ennemy->name . " a attaqué " . $this->player->name . " !");
        
                // Check if the player is defeated
                if ($this->player->health <= 0) {
                    // Log the message for player's defeat and reset the player
                    $this->logAction("Vous avez été vaincu par " . $this->ennemy->name . " !");
                }
            }
        }
    
        // Save the player data to storage after each attack
        $this->storage->save('player', $this->player);
    }
    

    // Méthode appelée lorsqu'on fait soumet un formulaire,
    // utilise le champ caché "form" afin de rediriger sur la méthode associée
    // Une fois la requête traitée, on redirige sur la page par défaut
    private function handleForm(array $formData): void {
        switch ($formData['form']) {
            case 'reset-storage':
                $this->resetStorage();
                break;
            case 'class-selector':
                $this->CreatPersonage($formData);
                break;
            case 'First-ennemy': // New case for handling the first enemy encounter
                $this->ennemy();
                break;
            case 'attaque':
                // Check if either basic_attack or special_attack is set in the form data
                if (isset($formData['attaque'])) {
                    $attackType = $formData['attaque'];
                } else {
                   throw new \Exception("Type d'attaque non spécifié.");
                }
                // Handle the combat with the correct attack type
                $this->handleCombat($formData);
                break;                
            case 'safe-place':
                $this->handleSafePlace($formData);
                break;
            default:
                throw new \Exception("Formulaire pas géré : " . $formData['form']);
        }
        // Redirection vers la page par défaut
        header('Location: /');
        exit;
    }
    
    private function handleSafePlace(array $formData): void {
        switch ($formData['action']) {
            case 'heal':
                $this->healPlayer();
                break;
            case 'increase_attack':
                $this->increaseAttack();
                break;
            case 'continue_fighting':
                // Logique de poursuite du combat ici
                break;
            default:
                throw new \Exception("Action non gérée : " . $formData['action']);
        }
    
        // Enregistrez les données du joueur mises à jour dans le stockage
        $this->storage->save('player', $this->player);
    }
    
    private function healPlayer(): void {
        // Calculer 100% de la santé maximale du joueur pour le soin
        $healAmount = $this->player->healthMax - $this->player->health;
    
        // Vérifier si le joueur a assez d'or pour effectuer l'action
        if ($this->player->gold >= 5) {
            $this->player->gold -= 5;
            $this->player->health = $this->player->healthMax;
            $this->logAction("Vous vous soignez et récupérez toute votre santé.");
        } else {
            $this->logAction("Vous n'avez pas assez d'or pour vous soigner.");
        }
    }
    
    private function increaseAttack(): void {
        if ($this->player->gold >= 10) {
            $this->player->gold -= 10;
            $this->player->damage += 2;
            $this->logAction("Vous augmentez votre puissance d'attaque de 2.");
        } else {
            $this->logAction("Vous n'avez pas assez d'or pour augmenter votre attaque.");
        }
    }

    private function render(): void {
        // Choix du template d'affichage selon l'état du jeu
        if ($this->player !== null && $this->player->level >= 5) {
            require 'views/victory.view.php';
        } elseif ($this->player === null) {
            require 'views/player-name-form.view.php';
        } elseif ($this->player->health <= 0) {
            require 'views/defeat-screen.view.php';
        } elseif ($this->ennemy !== null) {
            require 'views/combat-first-ennemy.view.php';
        } else {
            require 'views/safe-zone.view.php';
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