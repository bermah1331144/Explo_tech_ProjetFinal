<h1>Connexion</h1>

<?= $this->Form->create() ?>
    <?= $this->Form->control('username', ['label' => 'Nom d’utilisateur']) ?>
    <?= $this->Form->control('motDePasse', ['type' => 'password', 'label' => 'Mot de passe']) ?>
    <?= $this->Form->button(__('Se connecter')) ?>
<?= $this->Form->end() ?>

<p>Pas encore inscrit ? <a href="<?= $this->Url->build(['action' => 'register']) ?>">Créez un compte ici</a>.</p>

<?php
$password = '1234'; // Ce que l'utilisateur entre
    $hash = '$2y$10$67DWRSjA5Su3sL.uN38QA.c2sCzSU5FWTD2NV4tCiSKl86MGqmpFa'; // Hash depuis la base
    
    if (password_verify($password, $hash)) {
        echo 'Le mot de passe est correct.';
    } else {
        echo 'Mot de passe incorrect.';
    }
?>