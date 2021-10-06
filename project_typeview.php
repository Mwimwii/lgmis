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
$project_type_view = new project_type_view();

// Run the page
$project_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_type_view->isExport()) { ?>
<script>
var fproject_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproject_typeview = currentForm = new ew.Form("fproject_typeview", "view");
	loadjs.done("fproject_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$project_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $project_type_view->ExportOptions->render("body") ?>
<?php $project_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $project_type_view->showPageHeader(); ?>
<?php
$project_type_view->showMessage();
?>
<?php if (!$project_type_view->IsModal) { ?>
<?php if (!$project_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproject_typeview" id="fproject_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project_type">
<input type="hidden" name="modal" value="<?php echo (int)$project_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($project_type_view->ProjectType->Visible) { // ProjectType ?>
	<tr id="r_ProjectType">
		<td class="<?php echo $project_type_view->TableLeftColumnClass ?>"><span id="elh_project_type_ProjectType"><?php echo $project_type_view->ProjectType->caption() ?></span></td>
		<td data-name="ProjectType" <?php echo $project_type_view->ProjectType->cellAttributes() ?>>
<span id="el_project_type_ProjectType">
<span<?php echo $project_type_view->ProjectType->viewAttributes() ?>><?php echo $project_type_view->ProjectType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($project_type_view->ProjectTypeDesc->Visible) { // ProjectTypeDesc ?>
	<tr id="r_ProjectTypeDesc">
		<td class="<?php echo $project_type_view->TableLeftColumnClass ?>"><span id="elh_project_type_ProjectTypeDesc"><?php echo $project_type_view->ProjectTypeDesc->caption() ?></span></td>
		<td data-name="ProjectTypeDesc" <?php echo $project_type_view->ProjectTypeDesc->cellAttributes() ?>>
<span id="el_project_type_ProjectTypeDesc">
<span<?php echo $project_type_view->ProjectTypeDesc->viewAttributes() ?>><?php echo $project_type_view->ProjectTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$project_type_view->IsModal) { ?>
<?php if (!$project_type_view->isExport()) { ?>
<?php echo $project_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$project_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_type_view->isExport()) { ?>
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
$project_type_view->terminate();
?>