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




   public function AfficherTableau($type){
        $tableauFroid = document.getElementById('tableau-froid-contrainer');
        $tableauChaud = document.getElementById('tableau-chaud-contrainer');
        
        $tableauFroid.style.display == 'none';
        $tableauChaud.style.display =='none';

        if(type == 'froid'){
            $tableauFroid.style.display == 'block';
            
        }else if(type == 'chaud'){
            $tableauChaud.style.display == 'block';
        }
   }



}
?>


