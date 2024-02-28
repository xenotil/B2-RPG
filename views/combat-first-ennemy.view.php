<p>Le combat Commence</p>
<?= $this->player->name ?></br>
<p>vous aite Lv <?= $this->player->level?></p>
<?= $this->player->health . "/" . $this->player->healthMax."Hp"?> </br>
<?= $this->player->mana . "/" . $this->player->manaPool."Mp"?></br></br>
<?= $this->ennemy->name ?></br>
<?= $this->ennemy->health . "/" . $this->ennemy->healthMax."Hp"?></br>
<?= $this->ennemy->mana . "/" . $this->ennemy->manaPool ."Mp"?></br>

<form method="POST">
    <input type="hidden" name="form" value="attaque"/>
    <button type="submit" class="btn btn-primary">Attaquer</button>
</form>