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
  <div class="btn-group">
        <button class="btn dropdown-toggle">
            <?= ucfirst($this->getView()->getIdentifier()->package)?>&nbsp;<span class="caret"></span>
        </button>  
        <ul class="dropdown-menu">
            <li><a href="<?=@route('option=photos&view=photos&oid='.$actorbar->getActor()->id)?>">Photos</a></li>
            <li><a href="<?=@route('option=topics&view=topics&oid='.$actorbar->getActor()->id)?>">Topics</a></li>
            <li><a href="<?=@route('option=todos&view=todos&oid='.$actorbar->getActor()->id)?>">Todos</a></li>
    	</ul>	        
    </div>	
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