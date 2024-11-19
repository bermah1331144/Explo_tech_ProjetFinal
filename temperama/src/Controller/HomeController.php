<?php
namespace App\Controller;


use App\Controller\AppController;

class HomeControlleur extends AppController
{

    public function index()
    {
        // Récupérer toutes les entrées de la table temperature
        $temperatures = $this->Temperature->find('all');
        $this->set(compact('temperatures'));
    }

}