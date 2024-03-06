<body>
    <div class="container mt-5">
        <h2>Le combat commence</h2>
        
        <div class="row">
            <div class="col">
                <h3><?= $this->player->name ?></h3>
                <p>Niveau <?= $this->player->level?></p>
                <p><?= $this->player->health ?>/<?= $this->player->healthMax ?> HP</p>
                <p><?= $this->player->mana ?>/<?= $this->player->manaPool ?> MP</p>
            </div>
            <div class="col">
                <h3><?= $this->ennemy->name ?></h3>
                <p><?= $this->ennemy->health ?>/<?= $this->ennemy->healthMax ?> HP</p>
                <p><?= $this->ennemy->mana ?>/<?= $this->ennemy->manaPool ?> MP</p>
            </div>
        </div>

        <form method="POST" class="mt-3">
            <input type="hidden" name="form" value="basic_attack"/>
            <button type="submit" class="btn btn-primary mr-2">Attaque de base</button>
        </form>
        
        <form method="POST" class="mt-3">
            <input type="hidden" name="form" value="special_attack"/>
            <button type="submit" class="btn btn-danger">Attaque spéciale</button>
        </form>
    </div>
</body>