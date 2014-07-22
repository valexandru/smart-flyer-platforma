<h1>Users</h1>
<?php 
if($this->Session->check('Auth.User')){
	echo $this->Html->link( "Return to Dashboard",   array('controller'=>'users','action'=>'index') );
	echo "<br>";	
        if($role==1){
           echo $this->Html->link( "Add company",   array('controller'=>'users', 'action'=>'add') );
           echo "<br>";
        }	
	echo $this->Html->link( "Edit Company Details",   array('controller'=>'companies','action'=>'edit') );
	echo "<br>";
	echo $this->Html->link( "Add Product",   array('controller'=>'products','action'=>'add') );
	echo "<br>";
	echo $this->Html->link( "Logout",   array('controller'=>'users', 'action'=>'logout') );
	}
else{
	echo $this->Html->link( "Login",   array('controller'=>'users','action'=>'login') );
} 
?>

