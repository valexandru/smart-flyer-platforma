<?php

class UsersController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','index', 'edit', 'logout');
   }

    public function login() {

        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
              if (AuthComponent::user('status')==0) {
		$this->Session->setFlash(__('Your user is deactivated'));
		$this->redirect($this->Auth->logout());
              } else {
			$this->redirect($this->Auth->redirectUrl());
		}
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }
 
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
 
    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }
 
     public function add() { 
      if (AuthComponent::user('role')=="admin") {   
	if ($this->request->is('post')) {

                $this->loadModel('Company'); 
                $this->User->create(); 

                if ($this->User->save($this->request->data)) { 

                        $data = array(
                                'nume' => $this->request->data['User']['company_name'], 
				'user_id' => $this->User->id
                        ); 
                        $this->Company->save($data); 
                        $this->Session->setFlash(__('The user has been created')); 
                        $this->redirect(array('action' => 'show')); 
                } else { 
                        $this->Session->setFlash(__('The user could not be created. Please, try again.')); 
		}
	}
     }
    }
    public function show(){
       if (AuthComponent::user('role')=="admin") { 
	       $usersData= $this->User->find('all');
               $this->set('usersData',$usersData);
       } 
    }
 
    public function edit() {

	    $id = $this->Auth->user('id'); 

            $user = $this->User->findById($id);
            if (!$user) {
                $this->Session->setFlash('Invalid User ID Provided');
                $this->redirect(array('action'=>'index'));
            }
 
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'));
                    $this->redirect(array('action' => 'edit'));
                }else{
                    $this->Session->setFlash(__('Unable to update your user.'));
                }
            }
 
            if (!$this->request->data) {
                $this->request->data = $user;
            }
    }
 
    public function deactivate($id = null) {
     if (AuthComponent::user('role')=="admin") { 
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'show'));
        }
         
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'show'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deactivated'));
            $this->redirect(array('action' => 'show'));
        }
        $this->Session->setFlash(__('User was not deactivated'));
        $this->redirect(array('action' => 'show'));
    
     }
   }
     
    public function activate($id = null) {
      if (AuthComponent::user('role')=="admin") {
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'show'));
        }
         
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'show'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'show'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'show'));
     }
   }

   public function delete($id = null) {
     if (AuthComponent::user('role')=="admin") { 
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'show'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'show'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'show'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'show'));
    
     }
   }

 
}
