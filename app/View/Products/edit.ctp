<div class="users form">

<?php echo $this->Form->create('Product');?>
    <fieldset>
        <legend><?php echo __('Edit Product'); ?></legend>
        <?php echo $this->Form->input('nume');
		echo $this->Form->input('pret');
        echo $this->Form->input('descriere');
		
		echo $this->Form->submit('Edit Product', array('class' => 'form-submit',  'title' => 'Click here to update product') ); 
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
