<h1>Bienvenu a Temperama</h1>

<h2>Notre Histoire</h2>

<p>
    Dans le cadre du cour exploration et technologie, nous avons eu comme projet 
    d'avoir un apprentissage autodidacte dans le but de développer notre autonomie.
    Pour notre projet, nous devons applique nos compétances comme la programmation, le web,
    la base de données, le serveur et le réseaux.Tous des compétance appris durant notre parcours
    scolaire. Par la suite, nous devons faire fonctionner un rapberryPi qui fait partie de IoT,
    soit l'internet des Objets. 
</p>
<?php if (!empty($temperature)): ?>
    <p>Température la plus récente : <?= h($temperature->temperature) ?>°C</p>
<?php else: ?>
    <p>Aucune température disponible pour le moment.</p>
<?php endif; ?>

<button id="btn-temp-froide" onclick="afficherTableau($type)">Température froide</button>
<button id="btn-temp-chaud" onclick="afficherTableau($type)">Température chaude</button>
<?php
    $type = $_GET['type'] ?? '';
?>

<div id="tableau-froid-container" style=" margin-top: 20px;">
    <h3>Températures froides</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Température</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($temperatureFroide as $temperature): ?>
                <tr>
                    <td><?= h($temperature->temperature) ?></td>
                    <td><?= h($temperature->created) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
    document.getElementById('monBbtn-temp-froide').addEventListener('click', function () {
        var tableau = document.getElementById('monTableau');
        if (tableau-froid-container === 'none' || tableau-froid-container === '') {
            tableau-froid-container = 'table'; // Rendre visible
        } else {
            tableau-froid-container = 'none'; // Masquer à nouveau
        }
    });
    </script>

</div>



<div id="tableau-chaud-container" style=" margin-top: 20px;">
    <h3>Températures chaudes</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Température</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($temperatureChaude as $temperature): ?>
                <tr>
                    <td><?= h($temperature->temperature) ?></td>
                    <td><?= h($temperature->created) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
    document.getElementById('btn-temp-chaud').addEventListener('click', function () {
        var tableau = document.getElementById('monTableau');
        if (tableau-chaud-container === 'none' || tableau-chaud-container === '') {
            tableau-chaud-container = 'table'; // Rendre visible
        } else {
            tableau-chaud-container = 'none'; // Masquer à nouveau
        }
    });
    </script>

</div>