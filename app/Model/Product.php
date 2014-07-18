<?php

class Product extends AppModel {
	public $useTable = 'produse';

        public $validate = array(
        'nume' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required',
                'allowEmpty' => false
            )
        ),
      	'descriere' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required',
                'allowEmpty' => false
            )
        )
     );

}

