<form class="-koowa-form"  action="<?=@route()?>" method="post">
        <div id="config-document">
			<div id="page-site">
				<table class="noshow">
					<tr>
						<td width="50%">
							<?= @template('config_site'); ?>
						    <?= @template('config_seo'); ?>
							<?= @template('config_debug'); ?>
														
						</td>
						<td width="40%">
							<?= @template('config_cache'); ?>
							<?= @template('config_session'); ?>						
							<?= @template('config_database'); ?>
							<?= @template('config_mail'); ?>	
						</td>
					</tr>
				</table>
			</div>			
		</div>
</form>