<body>
    <div class="container mt-5">
        <h2>Le combat commence</h2>
        
        <div class="row">
            <div class="col">
                <h3><?= $this->player->name ?></h3>
                <p>Niveau <?= $this->player->level?></p>
                <p><?= $this->player->health ?>/<?= $this->player->healthMax ?> HP</p>
                <p><?= $this->player->mana ?>/<?= $this->player->manaMax ?> MP</p>
            </div>
            <div class="col">
                <h3><?= $this->ennemy->name ?></h3>
                <p><?= $this->ennemy->health ?>/<?= $this->ennemy->healthMax ?> HP</p>
                <p><?= $this->ennemy->mana ?>/<?= $this->ennemy->manaMax ?> MP</p>
            </div>
        </div>

        <form method="POST" class="mt-3">
            <input type="hidden" name="form" value="attaque"/>

            <button type="submit" class="btn btn-primary mr-2" name="attaque" value="basic_attack">Attaque de base</button>

            <button type="submit" class="btn btn-danger" name="attaque" value="special_attack">Attaque spéciale</button>
        </form>

    </div>
</body>