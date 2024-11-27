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
        $temperature = $temperaturesTable->find()->first();
        $this->set(compact('temperature'));
    }
    
    public function GetTemperatureFroide()
    {
        $temperatureFroide = $this->Temperature->find('all',['condition'=>['temperature<' => 0], 'fields' =>['tempeFroid']
        ]);
        $this->set(compact('tempeFroid',$temperatureFroide));
    
    }

    public function GetTemperatureChaude(){

        $temperatureChaude =$this->temperature->find('all',['condition'=> ['temperature<'=> 35], 'fiels'=>['tempeChaud']
        ]);
        $this->set(compact('tempeChaud', $temperatureChaude));

    }

    public function GetTouteTemperature(){
        $this->set(compact('temperatureFroide','temperatureChaude'));
    }




   public function AfficherTableau($type = null){
        
        $this->fetchTable('Temperature');

        $temperatures = [];

        if($type == 'froid'){
            $temperatures = $this->Temperature->find('all')->where(['tempeFroid' => true]);
            
        }else if($type == 'chaud'){
            $temperatures = $this->Temperature->find('all')->where(['tempeChaud' => true]);
        }
   }



}
?>


