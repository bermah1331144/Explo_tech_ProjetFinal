<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class AccueilController extends AppController
{

    # 0 affiche aucun temperature
    # 1 affiche temperatire froid
    # 2 affiche temperature chaud

    public function index()
    {
        $etatTableau = 0;
        // Récupérer toutes les entrées de la table temperatures
        $temperaturesTable = TableRegistry::getTableLocator()->get('Temperature');
        $temperature = $temperaturesTable->find()->first();
        $this->set(compact('temperature'));
        $this->set(compact('temperature', 'etatTableau'));
    }

    public function getTemperatureFroide()
{
    $temperaturesTable = TableRegistry::getTableLocator()->get('Temperature');
    $temperature = $temperaturesTable->find()->first();
    $etatTableau = 1;
    $temperatureFroide = $temperaturesTable->find('all', [
        'conditions' => ['tempeFroid' => 1], 
        'fields' => ['temperature', 'time_tempe']       
    ]);

    // Envoi des données à la vue
    $this->set(compact('temperature','temperatureFroide', 'etatTableau'));
    $this->render('index');
}

public function getTemperatureChaude()
{
    $temperaturesTable = TableRegistry::getTableLocator()->get('Temperature');
    $temperature = $temperaturesTable->find()->first();
    $etatTableau = 2;
    $temperatureChaude = $temperaturesTable->find('all', [
        'conditions' => ['tempeChaud' => 1], 
        'fields' => ['temperature', 'time_tempe'] 
    ]);

    $this->set(compact('temperature','temperatureChaude', 'etatTableau'));
    $this->render('index');
}



}
?>


