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
