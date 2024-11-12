<?php

namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function login()
    {
        // Si le formulaire est soumis en POST
        if ($this->request->is('post')) {
            $username = $this->request->getData('username');
            $password = $this->request->getData('motDePasse');

            // Cherchez l'utilisateur dans la base de données
            $user = $this->Users->find('all')
                ->where(['username' => $username])
                ->first();

            // Vérifiez si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($password, $user->motDePasse)) {
                // Stocker l'utilisateur dans la session
                $this->request->getSession()->write('Auth.User', $user);

                // Redirigez vers la page d'accueil ou une autre page protégée
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            } else {
                $this->Flash->error('Nom d’utilisateur ou mot de passe incorrect.');
            }
        }
    }

    public function logout()
    {
        // Efface les informations de l'utilisateur dans la session
        $this->request->getSession()->delete('Auth.User');
        $this->Flash->success('Vous avez été déconnecté.');
        return $this->redirect(['action' => 'login']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        if (!$this->request->getSession()->check('Auth.User') && !in_array($this->request->getParam('action'), ['login', 'logout'])) {
            $this->Flash->error("Veuillez vous connecter pour accéder à cette page.");
            return $this->redirect(['action' => 'login']);
        }
    }
}