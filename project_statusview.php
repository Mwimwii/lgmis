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
$project_status_view = new project_status_view();

// Run the page
$project_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_status_view->isExport()) { ?>
<script>
var fproject_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproject_statusview = currentForm = new ew.Form("fproject_statusview", "view");
	loadjs.done("fproject_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$project_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $project_status_view->ExportOptions->render("body") ?>
<?php $project_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $project_status_view->showPageHeader(); ?>
<?php
$project_status_view->showMessage();
?>
<?php if (!$project_status_view->IsModal) { ?>
<?php if (!$project_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproject_statusview" id="fproject_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_status">
<input type="hidden" name="modal" value="<?php echo (int)$project_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($project_status_view->ProjectStatusCode->Visible) { // ProjectStatusCode ?>
	<tr id="r_ProjectStatusCode">
		<td class="<?php echo $project_status_view->TableLeftColumnClass ?>"><span id="elh_project_status_ProjectStatusCode"><?php echo $project_status_view->ProjectStatusCode->caption() ?></span></td>
		<td data-name="ProjectStatusCode" <?php echo $project_status_view->ProjectStatusCode->cellAttributes() ?>>
<span id="el_project_status_ProjectStatusCode">
<span<?php echo $project_status_view->ProjectStatusCode->viewAttributes() ?>><?php echo $project_status_view->ProjectStatusCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_status_view->ProjectStatusDesc->Visible) { // ProjectStatusDesc ?>
	<tr id="r_ProjectStatusDesc">
		<td class="<?php echo $project_status_view->TableLeftColumnClass ?>"><span id="elh_project_status_ProjectStatusDesc"><?php echo $project_status_view->ProjectStatusDesc->caption() ?></span></td>
		<td data-name="ProjectStatusDesc" <?php echo $project_status_view->ProjectStatusDesc->cellAttributes() ?>>
<span id="el_project_status_ProjectStatusDesc">
<span<?php echo $project_status_view->ProjectStatusDesc->viewAttributes() ?>><?php echo $project_status_view->ProjectStatusDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_status_view->LastUserID->Visible) { // LastUserID ?>
	<tr id="r_LastUserID">
		<td class="<?php echo $project_status_view->TableLeftColumnClass ?>"><span id="elh_project_status_LastUserID"><?php echo $project_status_view->LastUserID->caption() ?></span></td>
		<td data-name="LastUserID" <?php echo $project_status_view->LastUserID->cellAttributes() ?>>
<span id="el_project_status_LastUserID">
<span<?php echo $project_status_view->LastUserID->viewAttributes() ?>><?php echo $project_status_view->LastUserID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_status_view->LastUpdated->Visible) { // LastUpdated ?>
	<tr id="r_LastUpdated">
		<td class="<?php echo $project_status_view->TableLeftColumnClass ?>"><span id="elh_project_status_LastUpdated"><?php echo $project_status_view->LastUpdated->caption() ?></span></td>
		<td data-name="LastUpdated" <?php echo $project_status_view->LastUpdated->cellAttributes() ?>>
<span id="el_project_status_LastUpdated">
<span<?php echo $project_status_view->LastUpdated->viewAttributes() ?>><?php echo $project_status_view->LastUpdated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$project_status_view->IsModal) { ?>
<?php if (!$project_status_view->isExport()) { ?>
<?php echo $project_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$project_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_status_view->isExport()) { ?>
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
$project_status_view->terminate();
?>