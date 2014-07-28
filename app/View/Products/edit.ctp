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
