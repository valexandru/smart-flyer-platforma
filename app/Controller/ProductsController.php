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
	$this->redirect(array('controller'=>'Users','action'=>'index'));
    }
    public function add() {
 
        $pix = $this->Product->find('first', array(
 	      'order' => array('Product.ppid' => 'desc')));
	$this->set('pix',$pix['Product']['ppid']+1);

	if ($this->request->is('post')) {

        	$this->loadModel('Company');
	        $this->Product->create();

		$id = $this->Auth->user('id');
	        $companyid = $this->Company->find('first', array('conditions' => array('Company.user_id' => $id)));

	        debug($companyid);	
	        debug($this->Auth->user('id'));

	        $data = array( 'id' => $pix['Product']['ppid']+1,
				'pid' => $companyid['Company']['id'], 
					'nume' => $this->request->data['Product']['nume'], 
						  'pret' => $this->request->data['Product']['pret'],
							'descriere' => $this->request->data['Product']['descriere'] 
		);

        	if ($this->Product->save($data)) {
	            
		    $this->Session->setFlash(__('The product has been created'));
	            $this->redirect(array('action' => 'show'));
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
 
	$product= $this->Product->find('first', array(
                'conditions' => array('Product.ppid' => $ppid)
        ));

	$this->loadModel('Company');
	$user_id=$this->Auth->user('id');

        $company= $this->Company->find('first', array(
                'conditions' => array('Company.user_id' => $user_id)
        ));
	
	$this->set('company',$company);
        $this->set('product',$product);

        if($company['Company']['id']==$product['Product']['pid'])
        {
        	if (!$product) {
	              $this->Session->setFlash('Invalid Product ID Provided');
	              $this->redirect(array('action'=>'index'));
	        }
 
	        if ($this->request->is('post') || $this->request->is('put')) {
	               $data = array('id' => $product['Product']['id'], 
                                       'nume' => $this->request->data['Product']['nume'], 
                                                'pret' => $this->request->data['Product']['pret'],
                                                      'descriere' => $this->request->data['Product']['descriere'] 
        	        );
              	if ($this->Product->save($data)) {
	                   $this->Session->setFlash(__('The product has been updated'));
	                   $this->redirect(array('action' => 'edit', $ppid));
	              }else{
	                   $this->Session->setFlash(__('Unable to update your product.'));
	              }
 	       }
 
        	if (!$this->request->data) {
	              $this->request->data = $product;
	        }
	}else {
		$this->Session->setFlash(__('You are not allowed to edit this product'));
		$this->redirect(array('action' => 'show'));
	}
    }
    
    public function delete($ppid = null) {

        if (!$ppid) {
              $this->Session->setFlash('Please provide a product id');
              $this->redirect(array('action'=>'index'));
        }

        $product= $this->Product->find('first', array(
                'conditions' => array('Product.ppid' => $ppid)
        ));

        $this->loadModel('Company');
        $user_id=$this->Auth->user('id');

        $company= $this->Company->find('first', array(
                'conditions' => array('Company.user_id' => $user_id)
        ));

        if($company['Company']['id']==$product['Product']['pid'])
        {
		$this->Product->deleteAll(array('Product.ppid' => $ppid), false);
        	$this->redirect(array('controller' => 'Products', 'action' => 'show'));
		$this->Session->setFlash(__('The product has been created'));
	}else {
                $this->Session->setFlash(__('You are not allowed to delete  this product'));
                $this->redirect(array('action' => 'show'));
        }

    }

}

