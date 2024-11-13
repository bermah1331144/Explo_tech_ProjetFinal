<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setPrimaryKey('user_id');
        
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('username', 'Veuillez entrer un nom d’utilisateur.')
            ->notEmptyString('prenom', 'Veuillez entrer un prénom.')
            ->notEmptyString('nom', 'Veuillez entrer un nom.')
            ->notEmptyString('email', 'Veuillez entrer un email.')
            ->email('email', false, 'Veuillez entrer un email valide.')
            ->notEmptyString('motDePasse', 'Veuillez entrer un mot de passe.');

        return $validator;
    }


    // Fonction pour hacher le mot de passe avant sauvegarde
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && $entity->motDePasse) {
            $entity->motDePasse = password_hash($entity->motDePasse, PASSWORD_DEFAULT);
        }
    }
}

