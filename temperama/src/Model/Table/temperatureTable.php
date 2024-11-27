<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class TemperatureTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('temperature');
        $this->addBehavior('Timestamp');
    }
}




?>