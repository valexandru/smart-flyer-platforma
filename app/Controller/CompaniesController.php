<?php

class CompaniesController extends AppController {
 
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Company.nume' => 'asc' )
    );
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','index', 'edit');
    }
    
    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('Company.name' => 'asc' )
        );
        $users = $this->paginate('Company');
        $this->set(compact('companies'));
    }
    public function edit($id = null) {

	$id = $this->Auth->user('id');
        $user = $this->Company->findById($id);

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Company->id = $id;
            if ($this->Company->save($this->request->data)) {
                 $this->Session->setFlash(__('The data has been updated'));
                 $this->redirect(array('action' => 'edit', $id));
            }else{
                 $this->Session->setFlash(__('Unable to update your data.'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }
}

