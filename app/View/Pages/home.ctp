<?php
/**
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');

?>
<?php 
echo $this->Html->css('index');
?>

<div class="buttoncontainer">

<div style="float: left;">
	
<p>
	<a href="<?php echo $this->webroot; ?>users/login"> <button id="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Log In</button> </a>
</p>
</div>
<div style="float: left;">
	
<p>
<a href="<?php echo $this->webroot; ?>users/register"> <button id="register"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</button> </a>
</p>
</div>
</div><br><br>
<span class="title"> Message Board </span>
<p>
	<?php echo $this->Html->image('messageboard.jpg', array('class'=>"messageboardimg",'alt' => '$cakeDescription', 'border' => '0'));?>

</p>
<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>
