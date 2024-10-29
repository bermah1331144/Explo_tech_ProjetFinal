<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <form method="post" action="connexion_action.php">
        <label for="nomUtilisateur">Nom d'utilisateur:</label>
        <input type="text" id="nomUtilisateur" name="nomUtilisateur" required>
        <br>
        <label for="motDePasse">Mot de passe:</label>
        <input type="motDePasse" id="motDePasse" name="motDePasse" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>