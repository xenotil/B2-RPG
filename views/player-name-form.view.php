<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bienvenue sur XenoQuest Chronicles</h5>
            <p class="card-text lead">Entrez le nom de votre personnage pour commencer l'aventure.</p>
            <form method="POST">
                <div class="mb-3">
                    <label for="player-name" class="form-label">Nom du personnage</label>
                    <input type="text" name="player-name" id="player-name" class="form-control" />
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Votre Archétype</label>
                    <div class="form-check">
                        <input type="radio" name="class" value="warrior" class="form-check-input" id="warrior">
                        <label class="form-check-label" for="warrior">Guerrier</label>
                    </div>
        
                    <div class="form-check">
                        <input type="radio" name="class" value="clerc" class="form-check-input" id="clerc">
                        <label class="form-check-label" for="clerc">Clerc</label>
                    </div>
        
                    <div class="form-check">
                        <input type="radio" name="class" value="mage" class="form-check-input" id="mage">
                        <label class="form-check-label" for="mage">Mage</label>
                    </div>
                </div>
        
                <!-- Hidden input field for indicating class selection -->
                <input type="hidden" name="form" value="class-selector"/>
        
                <button type="submit" class="btn btn-primary btn-lg btn-block">Créer</button>
            </form>
        </div>
    </div>
</div>

<!-- Log des actions -->
<div class="position-fixed bottom-0 end-0 p-3">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Actions</strong>
            <small>maintenant</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php foreach ($this->logs as $log): ?>
                <p><?= $log ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
