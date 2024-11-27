<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class AccueilController extends AppController
{


    public function index()
    {
        // Récupérer toutes les entrées de la table temperatures
        $temperaturesTable = TableRegistry::getTableLocator()->get('Temperature');
        $temperatures = $temperaturesTable->find()->first();
        $this->set(compact('temperatures'));
    }
}
?>


