<h1>Liste des températures</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Température</th>
            <th>Heure</th>
            <th>Température Froid</th>
            <th>Température Chaud</th>
            <th>Tiede</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($temperature as $temperature): ?>
            <tr>
                <td><?= h($temperature->temp_id) ?></td>
                <td><?= h($temperature->temperature) ?></td>
                <td><?= h($temperature->time_tempe) ?></td>
                <td><?= $temperature->tempeFroid ? 'Oui' : 'Non' ?></td>
                <td><?= $temperature->tempeChaud ? 'Oui' : 'Non' ?></td>
                <td><?= $temperature->tiede ? 'Oui' : 'Non' ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
