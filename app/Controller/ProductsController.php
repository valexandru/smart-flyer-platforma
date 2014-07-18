<?php

class ProductsController extends AppController {
 
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Product.nume' => 'asc' )
    );
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','index', 'add','logout');
    }
    
    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('Product.nume' => 'asc' )
        );
        $users = $this->paginate('Product');
        $this->set(compact('products'));
    }
    public function add() {
	if ($this->request->is('post')) {
        $this->loadModel('Company');
        $this->Product->create();

	$id = $this->Auth->user('id');
        $companyid = $this->Company->find('first', array('conditions' => array('Company.user_id' => $id)));

        debug($companyid);
        debug($this->Auth->user('id'));
        $data = array('id' => $companyid['Company']['id'], 
				'nume' => $this->request->data['Product']['nume'], 
					  'pret' => $this->request->data['Product']['pret'],
						'descriere' => $this->request->data['Product']['descriere'] 
	);

        if ($this->Product->save($data)) {
            $this->Session->setFlash(__('The product has been created'));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(__('The user could not be created. Please, try again.'));
        }  
    }
    }
}

