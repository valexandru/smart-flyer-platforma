<div class="users form">
<?php echo $this->Form->create('Company'); ?>
    <fieldset>
        <legend><?php echo __('Edit Company details'); ?></legend>
        <?php 
	//	echo $this->Form->hidden('id', array('value' => $this->data['Company']['id']));
		echo $this->Form->input('nume', array( 'readonly' => 'readonly', 'label' => 'Company names cannot be changed!'));
        echo $this->Form->input('latitudine', array( 'label' => 'Insert latitude (not necessary)', 'maxLength' => 255, 'type'=>'number', 'step'=> 'any'));
        echo $this->Form->input('longitudine', array( 'label' => 'Insert longitude (not necessary)', 'maxLength' => 255, 'type'=>'number', 'step'=> 'any'));		

		echo $this->Form->submit('Edit Company details', array('class' => 'form-submit',  'title' => 'Click here to submit the data') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php if($this->Session->check('Auth.User')){
	echo $this->Html->link( "Return to Dashboard",   array('controller'=>'users','action'=>'index') );
	echo "<br>";
	echo $this->Html->link( "Edit Company Details",   array('controller'=>'companies','action'=>'edit') );
	echo "<br>";
	echo $this->Html->link( "Add Product",   array('controller'=>'products','action'=>'add') );
	echo "<br>";
	echo $this->Html->link( "Logout",   array('controller'=>'users', 'action'=>'logout') );
}else{
	echo $this->Html->link( "Login",   array('controller'=>'users','action'=>'login') );
}
