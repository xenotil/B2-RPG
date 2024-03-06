<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Moment de répit</h5>
            <p class="card-text">Vous avez vaincu votre adversaire et profitez d'un moment de calme pour reprendre vos esprits.</p>
            <p class="card-text">Pièces d'or disponibles : <?php echo $this->player->gold; ?></p>
            <form method="POST">
                <input type="hidden" name="form" value="safe-place"/>
                <button type="submit" name="action" value="heal" class="btn btn-success btn-lg btn-block mb-3">Acheter une potion de guérison (5 pièces d'or)</button>
                <button type="submit" name="action" value="increase_attack" class="btn btn-warning btn-lg btn-block mb-3">Améliorer votre attaque (10 pièces d'or)</button>
                <!-- Ajoutez ici d'autres options d'achat ou d'amélioration -->
            </form>
            <form method="POST">
                <input type="hidden" name="form" value="First-ennemy"/>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Continuer l'aventure</button>
            </form>
        </div>
    </div>
</div>
