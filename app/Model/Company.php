<?php

class Company extends AppModel {
      public $useTable = 'firme';

      public $validate = array(
      'latitudine' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A number is required',
                'allowEmpty' => false
            ),
             'isnumeric' => array(
                'rule'    => array('isanumber'),
                'message' => 'This is not a number'
            ),
        ),
      'longitudine' => array(
            'nonEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A number is required',
                'allowEmpty' => false
            ),
             'isnumeric' => array(
                'rule'    => array('isanumber'),
                'message' => 'This is not a number'
            ),
        )
     );

     public function isanumber($check){
	$value = array_values($check);
        $value = $value[0];

	return is_numeric($value);
     }
}

