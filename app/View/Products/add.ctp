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
<?php echo $this->Form->end();?>
</div>
