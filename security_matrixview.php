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
$security_matrix_view = new security_matrix_view();

// Run the page
$security_matrix_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$security_matrix_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$security_matrix_view->isExport()) { ?>
<script>
var fsecurity_matrixview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsecurity_matrixview = currentForm = new ew.Form("fsecurity_matrixview", "view");
	loadjs.done("fsecurity_matrixview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$security_matrix_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $security_matrix_view->ExportOptions->render("body") ?>
<?php $security_matrix_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $security_matrix_view->showPageHeader(); ?>
<?php
$security_matrix_view->showMessage();
?>
<?php if (!$security_matrix_view->IsModal) { ?>
<?php if (!$security_matrix_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $security_matrix_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsecurity_matrixview" id="fsecurity_matrixview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="security_matrix">
<input type="hidden" name="modal" value="<?php echo (int)$security_matrix_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($security_matrix_view->UserCode->Visible) { // UserCode ?>
	<tr id="r_UserCode">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_UserCode"><?php echo $security_matrix_view->UserCode->caption() ?></span></td>
		<td data-name="UserCode" <?php echo $security_matrix_view->UserCode->cellAttributes() ?>>
<span id="el_security_matrix_UserCode">
<span<?php echo $security_matrix_view->UserCode->viewAttributes() ?>><?php echo $security_matrix_view->UserCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->PeriodCode->Visible) { // PeriodCode ?>
	<tr id="r_PeriodCode">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_PeriodCode"><?php echo $security_matrix_view->PeriodCode->caption() ?></span></td>
		<td data-name="PeriodCode" <?php echo $security_matrix_view->PeriodCode->cellAttributes() ?>>
<span id="el_security_matrix_PeriodCode">
<span<?php echo $security_matrix_view->PeriodCode->viewAttributes() ?>><?php echo $security_matrix_view->PeriodCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_ProvinceCode"><?php echo $security_matrix_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $security_matrix_view->ProvinceCode->cellAttributes() ?>>
<span id="el_security_matrix_ProvinceCode">
<span<?php echo $security_matrix_view->ProvinceCode->viewAttributes() ?>><?php echo $security_matrix_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_LACode"><?php echo $security_matrix_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $security_matrix_view->LACode->cellAttributes() ?>>
<span id="el_security_matrix_LACode">
<span<?php echo $security_matrix_view->LACode->viewAttributes() ?>><?php echo $security_matrix_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_DepartmentCode"><?php echo $security_matrix_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $security_matrix_view->DepartmentCode->cellAttributes() ?>>
<span id="el_security_matrix_DepartmentCode">
<span<?php echo $security_matrix_view->DepartmentCode->viewAttributes() ?>><?php echo $security_matrix_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_SectionCode"><?php echo $security_matrix_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $security_matrix_view->SectionCode->cellAttributes() ?>>
<span id="el_security_matrix_SectionCode">
<span<?php echo $security_matrix_view->SectionCode->viewAttributes() ?>><?php echo $security_matrix_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->SecurityNumber->Visible) { // SecurityNumber ?>
	<tr id="r_SecurityNumber">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_SecurityNumber"><?php echo $security_matrix_view->SecurityNumber->caption() ?></span></td>
		<td data-name="SecurityNumber" <?php echo $security_matrix_view->SecurityNumber->cellAttributes() ?>>
<span id="el_security_matrix_SecurityNumber">
<span<?php echo $security_matrix_view->SecurityNumber->viewAttributes() ?>><?php echo $security_matrix_view->SecurityNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->ValidFrom->Visible) { // ValidFrom ?>
	<tr id="r_ValidFrom">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_ValidFrom"><?php echo $security_matrix_view->ValidFrom->caption() ?></span></td>
		<td data-name="ValidFrom" <?php echo $security_matrix_view->ValidFrom->cellAttributes() ?>>
<span id="el_security_matrix_ValidFrom">
<span<?php echo $security_matrix_view->ValidFrom->viewAttributes() ?>><?php echo $security_matrix_view->ValidFrom->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->ValidTo->Visible) { // ValidTo ?>
	<tr id="r_ValidTo">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_ValidTo"><?php echo $security_matrix_view->ValidTo->caption() ?></span></td>
		<td data-name="ValidTo" <?php echo $security_matrix_view->ValidTo->cellAttributes() ?>>
<span id="el_security_matrix_ValidTo">
<span<?php echo $security_matrix_view->ValidTo->viewAttributes() ?>><?php echo $security_matrix_view->ValidTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->ApproveLevel->Visible) { // ApproveLevel ?>
	<tr id="r_ApproveLevel">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_ApproveLevel"><?php echo $security_matrix_view->ApproveLevel->caption() ?></span></td>
		<td data-name="ApproveLevel" <?php echo $security_matrix_view->ApproveLevel->cellAttributes() ?>>
<span id="el_security_matrix_ApproveLevel">
<span<?php echo $security_matrix_view->ApproveLevel->viewAttributes() ?>><?php echo $security_matrix_view->ApproveLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($security_matrix_view->ActivityCode->Visible) { // ActivityCode ?>
	<tr id="r_ActivityCode">
		<td class="<?php echo $security_matrix_view->TableLeftColumnClass ?>"><span id="elh_security_matrix_ActivityCode"><?php echo $security_matrix_view->ActivityCode->caption() ?></span></td>
		<td data-name="ActivityCode" <?php echo $security_matrix_view->ActivityCode->cellAttributes() ?>>
<span id="el_security_matrix_ActivityCode">
<span<?php echo $security_matrix_view->ActivityCode->viewAttributes() ?>><?php echo $security_matrix_view->ActivityCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$security_matrix_view->IsModal) { ?>
<?php if (!$security_matrix_view->isExport()) { ?>
<?php echo $security_matrix_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$security_matrix_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$security_matrix_view->isExport()) { ?>
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
$security_matrix_view->terminate();
?>