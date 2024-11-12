<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class UserTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('User'); // Nom de la table dans la base de données
        $this->setPrimaryKey('user_id'); // Colonne de clé primaire
    }
}
