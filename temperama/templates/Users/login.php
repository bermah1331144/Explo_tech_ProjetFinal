<h1>Connexion</h1>

<?= $this->Form->create() ?>
    <?= $this->Form->control('username', ['label' => 'Nom d’utilisateur']) ?>
    <?= $this->Form->control('motDePasse', ['type' => 'password', 'label' => 'Mot de passe']) ?>
    <?= $this->Form->button(__('Se connecter')) ?>
<?= $this->Form->end() ?>

<p>Pas encore inscrit ? <a href="<?= $this->Url->build(['action' => 'register']) ?>">Créez un compte ici</a>.</p>

