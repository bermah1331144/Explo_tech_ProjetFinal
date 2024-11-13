<?php

namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Load the Users model explicitly to avoid any loading issues
        $this->fetchTable('users');
    }

    public function login()
    {
        // Check if the form was submitted via POST
        if ($this->request->is('post')) {
            $username = $this->request->getData('username');
            $password = $this->request->getData('motDePasse');

            // Find the user in the database by username
            $user = $this->users->find('all')
                ->where(['username' => $username])
                ->first();

            // Verify if the user exists and if the password is correct
            if ($user && password_verify($password, $user->motDePasse)) {
                // Store the user data in the session
                $this->request->getSession()->write('Auth.User', $user);

                // Redirect to the home page or another protected page
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            } else {
                $this->Flash->error('Nom d’utilisateur ou mot de passe incorrect.');
            }
        }
    }

    public function logout()
    {
        // Clear user session data
        $this->request->getSession()->delete('Auth.User');
        $this->Flash->success('Vous avez été déconnecté.');
        return $this->redirect(['action' => 'login']);
    }

    public function register()
    {
        // Check if the form was submitted via POST
        if ($this->request->is('post')) {
            // Patch the entity with the form data using newEntity() as an alternative
            $user = $this->Users->patchEntity($this->Users->newEntity(), $this->request->getData());

            // Hash the password before saving
            $user->motDePasse = password_hash($user->motDePasse, PASSWORD_DEFAULT);

            // Save the user to the database
            if ($this->Users->save($user)) { // Use $this->Users with the correct capitalization
                $this->Flash->success(__('Registration successful.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Registration failed. Please, try again.'));
        }

        $this->set(compact('user'));
    }


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // Allow access to login, register, and logout actions without authentication
        if (!in_array($this->request->getParam('action'), ['login', 'register', 'logout'])) {
            // Check if the user is logged in
            if (!$this->request->getSession()->check('Auth.User')) {
                $this->Flash->error("Veuillez vous connecter pour accéder à cette page.");
                return $this->redirect(['action' => 'login']);
            }
        }
    }
}
