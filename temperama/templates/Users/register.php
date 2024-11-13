<h1>Créer un compte</h1>

<?= $this->Form->create($user) ?>
    <?= $this->Form->control('username', ['label' => 'Nom d’utilisateur']) ?>
    <?= $this->Form->control('prenom', ['label' => 'Prénom']) ?>
    <?= $this->Form->control('nom', ['label' => 'Nom']) ?>
    <?= $this->Form->control('email', ['label' => 'Email']) ?>
    <?= $this->Form->control('motDePasse', ['type' => 'password', 'label' => 'Mot de passe']) ?>
    <?= $this->Form->button(__('Créer un compte')) ?>
<?= $this->Form->end() ?>

<p>Déjà inscrit ? <a href="<?= $this->Url->build(['action' => 'login']) ?>">Connectez-vous ici</a>.</p>

