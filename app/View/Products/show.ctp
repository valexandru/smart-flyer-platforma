<h1>Sorted Entries</h1>
<?php
 echo $this->Html->link("Index", array('controller'=>'Users', 'action' => 'index'));
   if (!empty($editData)) {
  ?>
 <table>
   <tr>
       <th>ID</th>
       <th>Nume</th>
       <th>Pret</th>
       <th>Descriere</th>
       <th>Modifica</th>
   </tr>
  <?php 
	$i=1;
	foreach ($editData as $row): ?>
         <tr>
             <td><?php echo $i++; ?></td>
             <td>
                 <?php echo $row['Product']['nume']; ?>
             </td>
             <td> <?php echo $row['Product']['pret']; ?>
             </td>
             <td> <?php echo $row['Product']['descriere']; ?>
             </td>
             <td> <?php 
			echo $this->Html->link("Edit", array('controller'=>'Products', 'action' => 'edit',$row['Product']['ppid'])); 
			echo " / ";
			echo $this->Html->link("Delete", array('controller'=>'Products', 'action' => 'delete',$row['Product']['ppid']));
		  ?>
             </td>
         </tr>
   <?php endforeach;
         } else {
	print_r($editData);
	print_r($pid);
        echo '<p>No results found!</p>';
        }
   ?>
 </table>
