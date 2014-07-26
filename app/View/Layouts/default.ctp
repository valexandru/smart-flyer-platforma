<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Smart-Flyer');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//Favicon
		echo $this->Html->meta(
		    'smartflyer.ico',	
		    'img/smartflyer.ico',
		    array('type' => 'icon')
		);

		//CSS
                echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom.css');
		
		// Javascript/Jquery 
		echo $this->Html->script('jquery.min.js');
		echo $this->Html->script('jquery.common.min.js');

		// Bootstrap
		echo $this->Html->css('bootstrap.css');
	   	echo $this->Html->css('bootstrap-theme.css');
		echo $this->Html->script('bootstrap.min.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="menu-wrap">
	    <nav class="navbar-default" role="navigation">
		<div class="container" id="mainmenu">
			<div class="navbar-header">
				<a class="navbar-brand" href="/">
					<img alt="SmartFlyer" src="img/logo.png">
				</a>
			</div>
        	        <div class="collapse navbar-collapse navbar-right proxima-bold">
				<ul class="nav navbar-nav">
					<li><a class="active" href="/">Home</a></li>
					<li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#">				        
							 Products <span class="caret"></span>
					        </a>
				        	<ul class="dropdown-menu" role="menu">
					          <li><?php echo $this->Html->link( "Add Product",   array('controller'=>'products','action'=>'add') );?></li>
					          <li><?php echo $this->Html->link( "Edit Product",   array('controller'=>'products','action'=>'show') );?></li>
					        </ul>
				        </li>
                                               <li class="dropdown">
                                                       <a class="dropdown-toggle" data-toggle="dropdown" href="#">                                       
                                                                My account <span class="caret"></span>
                                                       </a>
                                                       <ul class="dropdown-menu" role="menu">
                                                         <li><?php echo $this->Html->link( "Edit Details",   array('controller'=>'companies','action'=>'edit') );?></li>
                                                         <li><?php echo $this->Html->link( "Logout",   array('controller'=>'users','action'=>'logout') );?></li>
                                                       </ul>
                                               </li>
				</ul>	
			</div>
	        </div>	
	    </nav>
	</div>
	<div id="header">
	</div>
	<div id="container">
		<div id="content">
			<?php
				$teams = $this->requestAction(
            				 array('controller' => 'app', 'action' => 'teams'),
				             array('return')
			          );
			?>
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div class="top-buffer" id="footer">
			<div class="container text-right"> <b>&copy; 2014 xInnovation</b> </div>
		</div>
	</div>
</body>
</html>
