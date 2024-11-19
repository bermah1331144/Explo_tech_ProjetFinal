<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Acceuil extends Entity
{
    protected $_accesible = [
        '*' => true,
        'id' => false,
        'slug' => false
    ];
} 
?>