<h1>Test de connexion</h1>
<p><?= h($message) ?></p>

<?php if (isset($temperature)): ?>
    <h3>Premier enregistrement dans la table temperature :</h3>
    <p>ID : <?= h($temperature->temp_id) ?></p>
    <p>Température : <?= h($temperature->temperature) ?></p>
<?php endif; ?>
