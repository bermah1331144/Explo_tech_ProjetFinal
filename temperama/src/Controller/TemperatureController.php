<?php

namespace App\Controller;

class TemperatureController extends AppController
{
    public function testConnection()
{
    // Tente de récupérer un enregistrement de la table temperature
    $temperature = $this->Temperature->find()->first();

    if ($temperature) {
        $this->set('message', 'La connexion à la base de données est réussie.');
        $this->set('temperature', $temperature);
    } else {
        $this->set('message', 'La connexion à la base de données est établie, mais aucune donnée n\'a été trouvée.');
    }
}


    public function index()
    {
         // Récupérer toutes les entrées de la table temperature
        $temperatures = $this->Temperature->find('all');
        $this->set(compact('temperatures'));
    }
}


?>