<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
//		echo $this->Html->meta('icon');


		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-responsive.min');
		echo $this->Html->css('style');
		echo $this->Html->script('jquery');
                echo $this->Html->script('jquery-ui.min');
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('tools/i18n/fre');
                echo $this->Html->script('tools/tools');
                echo $this->Html->script('core');
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="/">CMS</a>
            </div>
        </div>
    </div>

    <div id="container">
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                    <li class="active"><a href="#">Accueil</a></li>
                </ul>
            </div>
        </div>
        <div class="row-fluid">
            <?php echo $this->Session->flash(); ?>
        </div>
	<div class="row-fluid">
            <?php if(!empty($title)): ?>
            <div class="page-header">
                <h1><?php echo $title ?></h1>
            </div>
            <?php endif ?>
            <?php echo $this->fetch('content'); ?>
        </div>
	
        <footer class="footer">
            footer
        </footer>
        
        <?php echo $this->element('sql_dump'); ?>
    </div>
	
</body>
</html>
