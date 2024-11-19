<?php
namespace App\Controller;
use App\Controller\AppController;



class HomeControlleur extends AppController
{

    public function AfficherTempActuel()
    {
        $temperatures= $this->Temperatures->find()->firt();
        if($temperatures){
            $tempValue= $temperatures->temperature;
            $this->set('temperature', $tempValue);
        } 
    }
    public function index()
    {
        // Récupérer toutes les entrées de la table temperature
        $temperatures = $this->Temperature->find('all');
        $this->set(compact('temperatures'));
    }

}