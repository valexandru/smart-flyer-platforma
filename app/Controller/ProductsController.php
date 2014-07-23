<?php

class ProductsController extends AppController {
 
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Product.nume' => 'asc' )
    );
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','index', 'add','logout','show','edit','delete');
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
	        $data = array('pid' => $companyid['Company']['id'], 
					'nume' => $this->request->data['Product']['nume'], 
						  'pret' => $this->request->data['Product']['pret'],
							'descriere' => $this->request->data['Product']['descriere'] 
		);

        	if ($this->Product->save($data)) {
	            
		    $this->Session->setFlash(__('The product has been created'));
	            $this->redirect(array('action' => 'index'));
		} else {
	            $this->Session->setFlash(__('The product could not be created. Please, try again.'));
	        }  	
        }
    }

    public function show() {

	$userId = $this->Auth->user('id');

	$this->loadModel('Company');
	$idData= $this->Company->find('first', array(
                'conditions' => array('Company.user_id' => $userId)
        ));

	$pid= $idData['Company']['id'];

	$editData= $this->Product->find('all', array(
        	'conditions' => array('Product.pid' => $pid )
    	));

	$this->set('editData',$editData);
	$this->set('pid',$pid);

    }

    public function edit($ppid = null) {
 
        if (!$ppid) {
              $this->Session->setFlash('Please provide a product id');
              $this->redirect(array('action'=>'index'));
        }
 
        $product = $this->Product->findById($ppid);
        if (!$product) {
              $this->Session->setFlash('Invalid Product ID Provided');
              $this->redirect(array('action'=>'index'));
        }
 
        if ($this->request->is('post') || $this->request->is('put')) {
              $this->Product->ppid = $ppid;
              if ($this->Product->save($this->request->data)) {
                   $this->Session->setFlash(__('The product has been updated'));
                   $this->redirect(array('action' => 'edit', $ppid));
              }else{
                   $this->Session->setFlash(__('Unable to update your product.'));
              }
        }
 
        if (!$this->request->data) {
              $this->request->data = $product;
        }
    }
    
    public function delete($ppid = null) {

	$this->Product->deleteAll(array('Product.ppid' => $ppid), false);
        $this->redirect(array('controller' => 'Products', 'action' => 'show'));
	$this->Session->setFlash(__('The product has been created'));
    }

}

