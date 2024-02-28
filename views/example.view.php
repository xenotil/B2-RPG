<p class="lead">
    Bienvenue <?= $this->player->name ?>, 
    Grand  <?= $this->player->label ?> des terre désoler
    c'est ici que votre Histoir tout commence...
</p>

<form method="POST">
    <input type="hidden" name="form" value="First-ennemy"/>
    <button type="submit" class="btn btn-primary">Commencer L'aventure</button>
</form>