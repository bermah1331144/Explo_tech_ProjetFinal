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

<button><?= $this->Html->link('Temperature Froide', ['controller' => 'Accueil', 'action' => 'getTemperatureFroide'], ['class' => 'btn btn-primary']) ?></button>
<button><?= $this->Html->link('Temperature Chaude', ['controller' => 'Accueil', 'action' => 'getTemperatureChaude'], ['class' => 'btn btn-primary']) ?></button>

<?php if ($etatTableau == 0): ?>

<?php endif?>
<?php if ($etatTableau == 1 ) : ?>
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
                <?php        
                    foreach ($temperatureFroide as $temp): ?>
                    <tr>
                        <td><?= h($temp->temperature) ?></td>
                        <td><?= h($temp->time_tempe) ?></td>
                        <td><?= h($temp->created) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif;?>


<?php if ($etatTableau == 2) : ?>
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
                <?php foreach ($temperatureChaude as $tempe): ?>
                    <tr>
                        <td><?= h($tempe->temperature) ?></td>
                        <td><?= h($tempe->time_tempe) ?></td>
                        <td><?= h($tempe->created) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif;?>