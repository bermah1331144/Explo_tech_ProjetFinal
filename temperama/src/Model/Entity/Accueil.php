<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Accueil extends Entity
{
    protected $_accesible = [
        '*' => true,
        'id' => false,
        'slug' => false
    ];
} 
?>