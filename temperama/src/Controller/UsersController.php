<?php

namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Load the Users model explicitly to avoid any loading issues
        $this->fetchTable('Users');
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $username = $this->request->getData('username');
            $password = $this->request->getData('motDePasse');
    
            // Recherchez l'utilisateur dans la base de données
            $user = $this->Users->find('all')
                ->where(['username' => $username])
                ->first();

            if ($user) {
                debug($password); // Mot de passe saisi
                debug($user->motDePasse); // Mot de passe stocké (hashé)
            }
    
            // Vérifiez si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($password, $user->motDePasse)) {
                // Stockez les informations utilisateur dans la session
                $this->request->getSession()->write('Auth.User', $user);
    
                // Redirigez vers l'action `index` du contrôleur `Temperature`
                return $this->redirect(['controller' => 'Temperature', 'action' => 'index']);
            } else {
                $this->Flash->error(__('Nom d’utilisateur ou mot de passe incorrect.'));
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
    // Initialisez $user comme une nouvelle entité utilisateur
    $user = $this->Users->newEmptyEntity();

    if ($this->request->is('post')) {
        // Récupérez les données du formulaire
        $data = $this->request->getData();

        // Attribuez automatiquement le rôle "Utilisateur"
        $data['role_id'] = 2;

        // Patch l'entité avec les données du formulaire
        $user = $this->Users->patchEntity($user, $data);

        // Hash le mot de passe avant de sauvegarder
        $user->motDePasse = password_hash($user->motDePasse, PASSWORD_DEFAULT);

        // Tente de sauvegarder l'utilisateur
        if ($this->Users->save($user)) {
            // Stockez les informations utilisateur dans la session (connexion automatique)
            $this->request->getSession()->write('Auth.User', $user);

            // Redirigez vers une page sécurisée (par exemple, dashboard ou accueil)
            $this->Flash->success(__('Inscription réussie. Bienvenue, ' . $user->prenom . '!'));
            return $this->redirect(['controller' => 'Temperature', 'action' => 'index']);
        }

        // Gestion des erreurs
        if (!empty($user->getError('username'))) {
            $this->Flash->error(__('Ce nom d’utilisateur est déjà utilisé.'));
        } else {
            $this->Flash->error(__('L\'enregistrement a échoué. Veuillez réessayer.'));
        }
    }

    // Passe la variable $user à la vue
    $this->set(compact('user'));
}

 

    /*public function beforeFilter(\Cake\Event\EventInterface $event)
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
    }*/
}
