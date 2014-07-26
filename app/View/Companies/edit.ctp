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
