<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<fieldset class="adminform">
	<legend><?php echo JText::_( 'Site Settings' ); ?></legend>
	<table class="admintable" cellspacing="1">
	<tbody>
		<tr>
			<td width="185" class="key">

			<span class="editlinktip hasTip" title="<?php echo JText::_( 'Site Offline' ); ?>::<?php echo JText::_( 'TIPSETYOURSITEISOFFLINE' ); ?>">

			<?php echo JText::_( 'Site Offline' ); ?>
			</span>
			</td>
			<td>
			<?php echo $lists['offline']; ?>
			</td>
		</tr>
		
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'Site Name' ); ?>::<?php echo JText::_( 'TIPSITENAME' ); ?>">
				<?php echo JText::_( 'Site Name' ); ?>
				</span>
			</td>
			<td>
				<input class="text_area" type="text" name="sitename" size="50" value="<?php echo $config->sitename; ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'Default WYSIWYG Editor' ); ?>::<?php echo JText::_( 'TIPDEFWYSIWYG' ); ?>">
			<?php echo JText::_( 'Default WYSIWYG Editor' ); ?>
			</span>
			</td>
			<td>
				<?php echo $lists['editor']; ?>
			</td>
		</tr>
		
        <tr>
				<td width="185" class="key">
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Secret Word' ); ?>::<?php echo JText::_( 'TIPSECRETWORD' ); ?>">
					<?php echo JText::_( 'Secret Word' ); ?>
				</span>
				</td>
				<td>
					<strong><?php echo $config->secret; ?></strong>
				</td>
			</tr>
			<tr>
				<td valign="top" class="key">
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Path to Log-folder' ); ?>::<?php echo JText::_( 'TIPLOGFOLDER' ); ?>">
						<?php echo JText::_( 'Path to Log-folder' ); ?>
					</span>
				</td>
				<td>
					<input class="text_area" type="text" size="50" name="log_path" value="<?php echo $config->log_path; ?>" />
				</td>
			</tr>
<tr>
				<td valign="top" class="key">
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Path to Temp-folder' ); ?>::<?php echo JText::_( 'TIPTMPFOLDER' ); ?>">
						<?php echo JText::_( 'Path to Temp-folder' ); ?>
					</span>
				</td>
				<td>
					<input class="text_area" type="text" size="50" name="tmp_path" value="<?php echo $config->tmp_path; ?>" />
				</td>
			</tr>

					
	</tbody>
	</table>
</fieldset>
