<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected $_accesible = [
        '*' => true,
        'id' => false,
        'slug' => false
    ];
    
}




?>