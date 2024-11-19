<?php
namespace App\Controller;



class AcceuilControlleur extends AppController
{

    public function index()
    {
        // Récupérer toutes les entrées de la table temperature
        $temperatures = $this->Temperature->find('all');
        $this->set(compact('temperatures'));
    }
    
    public function AfficherTempActuel()
    {
        $temperatures= $this->Temperatures->find()->firt();
        if($temperatures){
            $tempValue= $temperatures->temperature;
            $this->set('temperature', $tempValue);
        } 
    }
}
?>