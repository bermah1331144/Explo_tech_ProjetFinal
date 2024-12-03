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


    // Ma condition pour aller chercher des temperature ne semle pas bien fonctionner a regarder
    public function getTemperatureFroide()
    {
        $etatTableau = 1;
        $temperaturesTable = TableRegistry::getTableLocator()->get('Temperature');
        $temperatureFroide = $temperaturesTable->find('all',['condition'=>['temperature<' => 15], 'fields' =>['temperature' => 15 ]
        ]);
        $this->set(compact('temperatureFroide', 'etatTableau'));
        $this->render('index');
    }

    public function getTemperatureChaude(){
        $etatTableau = 2;
        $temperaturesTable = TableRegistry::getTableLocator()->get('Temperature');
        $temperatureChaude = $temperaturesTable->find('all',['condition'=> ['temperature>'=> 15], 'fiels'=>['temperature' => 15]
        ]);
        $this->set(compact('temperatureChaude','etatTableau'));
        $this->render('index');

    }


}
?>


