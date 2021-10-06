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
$department_type_view = new department_type_view();

// Run the page
$department_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$department_type_view->isExport()) { ?>
<script>
var fdepartment_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdepartment_typeview = currentForm = new ew.Form("fdepartment_typeview", "view");
	loadjs.done("fdepartment_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$department_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $department_type_view->ExportOptions->render("body") ?>
<?php $department_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $department_type_view->showPageHeader(); ?>
<?php
$department_type_view->showMessage();
?>
<?php if (!$department_type_view->IsModal) { ?>
<?php if (!$department_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $department_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdepartment_typeview" id="fdepartment_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department_type">
<input type="hidden" name="modal" value="<?php echo (int)$department_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($department_type_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $department_type_view->TableLeftColumnClass ?>"><span id="elh_department_type_DepartmentCode"><?php echo $department_type_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $department_type_view->DepartmentCode->cellAttributes() ?>>
<span id="el_department_type_DepartmentCode">
<span<?php echo $department_type_view->DepartmentCode->viewAttributes() ?>><?php echo $department_type_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($department_type_view->DepartmentName->Visible) { // DepartmentName ?>
	<tr id="r_DepartmentName">
		<td class="<?php echo $department_type_view->TableLeftColumnClass ?>"><span id="elh_department_type_DepartmentName"><?php echo $department_type_view->DepartmentName->caption() ?></span></td>
		<td data-name="DepartmentName" <?php echo $department_type_view->DepartmentName->cellAttributes() ?>>
<span id="el_department_type_DepartmentName">
<span<?php echo $department_type_view->DepartmentName->viewAttributes() ?>><?php echo $department_type_view->DepartmentName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($department_type_view->CouncilType->Visible) { // CouncilType ?>
	<tr id="r_CouncilType">
		<td class="<?php echo $department_type_view->TableLeftColumnClass ?>"><span id="elh_department_type_CouncilType"><?php echo $department_type_view->CouncilType->caption() ?></span></td>
		<td data-name="CouncilType" <?php echo $department_type_view->CouncilType->cellAttributes() ?>>
<span id="el_department_type_CouncilType">
<span<?php echo $department_type_view->CouncilType->viewAttributes() ?>><?php echo $department_type_view->CouncilType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$department_type_view->IsModal) { ?>
<?php if (!$department_type_view->isExport()) { ?>
<?php echo $department_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$department_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$department_type_view->isExport()) { ?>
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
$department_type_view->terminate();
?>