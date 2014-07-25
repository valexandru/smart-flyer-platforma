<div class="users form">

<?php echo $this->Form->create('Product', array('type' => 'post', 'action' => 'add'));?>
    <fieldset>
        <legend><?php echo __('Add Product'); ?></legend>
        <?php echo $this->Form->input('nume');
		echo $this->Form->input('pret');
        echo $this->Form->input('descriere');
		
		echo $this->Form->submit('Add Product', array('class' => 'form-submit',  'title' => 'Click here to add product') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); print_r($pix);?>
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
