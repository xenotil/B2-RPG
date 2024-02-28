<p class="lead">
    Soyez la bienvenue sur XenoQuest Chronicles, entrez le nom de votre personnage pour commencer l'aventure.
</p>

<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nom du personnage</label>
        <input type="text" name="player-name" class="form-control" />
    </div>
    
    <div class="mb-3">
        <label class="form-label">Votre Achetype</label>
        <div class="form-check">
            <input type="radio" name="class" value="warrior" class="form-check-input" id="warrior">
            <label class="form-check-label" for="warrior">guerrier</label>
        </div>

        <div class="form-check">
            <input type="radio" name="class" value="clerc" class="form-check-input" id="clerc">
            <label class="form-check-label" for="clerc">clerc</label>
        </div>

        <div class="form-check">
            <input type="radio" name="class" value="mage" class="form-check-input" id="mage">
            <label class="form-check-label" for="mage">Mage</label>
        </div>
    </div>

    <!-- Hidden input field for indicating class selection -->
    <input type="hidden" name="form" value="class-selector"/>
    

    <button type="submit" class="btn btn-primary">Créer</button>
</form>

