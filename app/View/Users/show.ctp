<h1>Sorted Entries</h1>
<?php
   if (!empty($usersData)) {
  ?>
 <table>
   <tr>
       <th>ID</th>
       <th>Username</th>
       <th>Email</th>
       <th>Company Name</th>
       <th>Created</th>
       <th>Status</th>	
       <th>Role</th>
       <th>Modifica</th>
   </tr>
  <?php 
	$i=1;
	foreach ($usersData as $row): ?>
         <tr>
             <td><?php echo $i++; ?></td>
             <td>
                 <?php echo $row['User']['username']; ?>
             </td>
             <td> <?php echo $row['User']['email']; ?>
             </td>
             <td> <?php echo $row['User']['company_name']; ?>
             </td>
             <td> <?php echo $row['User']['created']; ?>
             </td>
	     <td> <?php if ($row['User']['status']==0) echo "Deactivated";
			else echo "Activated"; ?>
	     </td>
             <td> <?php echo $row['User']['role']; ?>
             </td>
             <td> <?php 
			echo $this->Html->link("Activate", array('controller'=>'Users', 'action' => 'activate',$row['User']['id'])); 
			echo " / ";
			echo $this->Html->link("Deactivate", array('controller'=>'Users', 'action' => 'deactivate',$row['User']['id']));
                        echo " / ";
                        echo $this->Html->link("Delete", array('controller'=>'Users', 'action' => 'delete',$row['User']['id']));
		  ?>
             </td>
         </tr>
   <?php endforeach;
         } else {
	print_r($usersData);
	print_r($pid);
        echo '<p>No results found!</p>';
        }
   ?>
 </table>
