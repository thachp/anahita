<?php if ( $actorbar->getTitle() && $actorbar->getActor() ) : ?>
<?php 
$commands = $actorbar->getCommands();
if ( count($commands) ) 
{
    $active   = array_shift($commands->getObjects());
    foreach($commands as $command) {
        if ( strpos($command->getAttribute('class'), 'active') !== false) {
            $active = $command;        
            break;
        } 
    }
}
?>
<div class="an-media-header" data-behavior="BS.Dropdown">	
	<div class="clearfix">
	    <div class="pull-left">			
    		<div class="avatar">
    			<?= @avatar($actorbar->getActor())?>
    		</div>		
    		<div class="info ">			
    			<h2 class="title"><?= $actorbar->getActor()->getName() ?></h2>			
    		</div>
		</div>
		<?php if ( !empty($active) ) : ?>
        <div class="btn-group pull-right">
            <button class="btn dropdown-toggle">
                <?= $active->label ?>&nbsp;<span class="caret"></span>
            </button>  
            <ul class="dropdown-menu">
        	<?php foreach($commands as $command) : ?>
        		<li><?= @helper('ui.command', $command) ?></li>
        	<?php endforeach; ?>
        	    <li class="divider"></li>
        		<li class="profile">
        			<a href="<?=@route($actorbar->getActor()->getURL())?>">
        			<?= @text('COM-ACTORS-BACK-TO-PROFILE') ?>
        			</a>
        		</li>
        	</ul>	        
        </div>		
        <?php endif;?>
	</div>
	
	
</div>
<?php endif;?>