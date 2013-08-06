<?php 
@service('application.dispatcher')->getRequest()->tmpl = 'component';
$path = JPATH_BASE.'/components/'.$component;
?>

<form class="-koowa-form" name="adminForm" autocomplete="off" method="post" action="<?=@route()?>" >
        <fieldset>
			<div style="float: right">
				<button type="button" onclick="this.form.submit();window.top.setTimeout('window.parent.document.getElementById(\'sbox-window\').close()', 700);">
					<?php echo JText::_( 'Save' );?></button>				
			</div>			
		</fieldset>
    <?= @helper('form.render', array(
    	'path'          => $path.'/config.xml',
        'element_paths' => array($path.'/administrator/components/com_base/templates/forms', $path.'/templates/forms'),
    	'data'          => get_config_value($component))) ?>
</form>