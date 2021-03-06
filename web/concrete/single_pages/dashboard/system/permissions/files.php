<?
	
	Loader::model('file_set');
	$fs = FileSet::getGlobal();
	$gl = new GroupList($fs);
	$ul = new UserInfoList($fs);
	$uArray = $ul->getUserInfoList();
	?>

	<?=Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Permissions'), false, 'span10 offset3', false)?>


	<form method="post" id="file-access-permissions" action="<?=$this->url('/dashboard/system/permissions/files', 'save_global_permissions')?>">
	<div class="ccm-pane-options clearfix">
		<a href="<?=REL_DIR_FILES_TOOLS_REQUIRED?>/user_group_selector" id="ug-selector" dialog-modal="false" dialog-width="90%" dialog-title="<?=t('Choose User/Group')?>"  dialog-height="70%" class="ccm-button-left btn dialog-launch"><?=t('Add Group or User')?></a>
	</div>
	<div class="ccm-pane-body">
		<?=$validation_token->output('file_permissions');?>


		<p>
		<?=t('Add users or groups to determine access to the file manager.');?>
		</p>
		
		<div class="ccm-spacer">&nbsp;</div><br/>
		
		<div id="ccm-file-permissions-entities-wrapper" class="ccm-permissions-entities-wrapper">			
		<div id="ccm-file-permissions-entity-base" class="ccm-permissions-entity-base">
		
			<? print $this->controller->getFileAccessRow('GLOBAL'); ?>
			
			
		</div>
		
		
		<? $gArray = $gl->getGroupList();
		foreach($gArray as $g) { ?>
			
			<? print $this->controller->getFileAccessRow('GLOBAL', 'gID_' . $g->getGroupID(), $g->getGroupName(), $g->getFileSearchLevel(), $g->getFileReadLevel(), $g->getFileWriteLevel(), $g->getFileAdminLevel(), $g->getFileAddLevel(), $g->getAllowedFileExtensions()); ?>
		
		<? } ?>
		<? foreach($uArray as $ui) { ?>
			
			<? print $this->controller->getFileAccessRow('GLOBAL', 'uID_' . $ui->getUserID(), $ui->getUserName(), $ui->getFileSearchLevel(), $ui->getFileReadLevel(), $ui->getFileWriteLevel(), $ui->getFileAdminLevel(), $ui->getFileAddLevel(), $ui->getAllowedFileExtensions()); ?>
		
		<? } ?>
		</div>
		
	</div>
	<div class="ccm-pane-footer">
		<? print $concrete_interface->submit(t('Save'), 'file-access-permissions', 'right', 'primary'); ?>
	</div>
	</form>

	<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false)?>

	<script type="text/javascript">
	$(function() {	
		ccm_triggerSelectUser = function(uID, uName) {
			ccm_alSelectPermissionsEntity('uID', uID, uName);
		}
		
		ccm_triggerSelectGroup = function (gID, gName) {
			ccm_alSelectPermissionsEntity('gID', gID, gName);
		}
		
		$("#ug-selector").dialog();	
		ccm_alActivateFilePermissionsSelector();	
	});
	
	</script>