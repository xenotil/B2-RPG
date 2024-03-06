<div class="container mt-5">
    <h2>Vous avez succombé à vos blessures</h2>
    <p>Vous avez été vaincu par <?= $this->ennemy->name ?> !</p>
    <!-- Add a reset button -->
    <form action="/" method="POST">
        <input type="hidden" name="form" value="reset-storage">
        <button type="submit" class="btn btn-primary">Recommencer</button>
    </form>
</div>