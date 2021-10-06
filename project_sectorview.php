<?php
namespace PHPMaker2020\lgmis20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$project_sector_view = new project_sector_view();

// Run the page
$project_sector_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_sector_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_sector_view->isExport()) { ?>
<script>
var fproject_sectorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproject_sectorview = currentForm = new ew.Form("fproject_sectorview", "view");
	loadjs.done("fproject_sectorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$project_sector_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $project_sector_view->ExportOptions->render("body") ?>
<?php $project_sector_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $project_sector_view->showPageHeader(); ?>
<?php
$project_sector_view->showMessage();
?>
<?php if (!$project_sector_view->IsModal) { ?>
<?php if (!$project_sector_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_sector_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproject_sectorview" id="fproject_sectorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_sector">
<input type="hidden" name="modal" value="<?php echo (int)$project_sector_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($project_sector_view->ProjectSector->Visible) { // ProjectSector ?>
	<tr id="r_ProjectSector">
		<td class="<?php echo $project_sector_view->TableLeftColumnClass ?>"><span id="elh_project_sector_ProjectSector"><?php echo $project_sector_view->ProjectSector->caption() ?></span></td>
		<td data-name="ProjectSector" <?php echo $project_sector_view->ProjectSector->cellAttributes() ?>>
<span id="el_project_sector_ProjectSector">
<span<?php echo $project_sector_view->ProjectSector->viewAttributes() ?>><?php echo $project_sector_view->ProjectSector->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_sector_view->ProjectSectorDesc->Visible) { // ProjectSectorDesc ?>
	<tr id="r_ProjectSectorDesc">
		<td class="<?php echo $project_sector_view->TableLeftColumnClass ?>"><span id="elh_project_sector_ProjectSectorDesc"><?php echo $project_sector_view->ProjectSectorDesc->caption() ?></span></td>
		<td data-name="ProjectSectorDesc" <?php echo $project_sector_view->ProjectSectorDesc->cellAttributes() ?>>
<span id="el_project_sector_ProjectSectorDesc">
<span<?php echo $project_sector_view->ProjectSectorDesc->viewAttributes() ?>><?php echo $project_sector_view->ProjectSectorDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$project_sector_view->IsModal) { ?>
<?php if (!$project_sector_view->isExport()) { ?>
<?php echo $project_sector_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$project_sector_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_sector_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$project_sector_view->terminate();
?>