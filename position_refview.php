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
$position_ref_view = new position_ref_view();

// Run the page
$position_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$position_ref_view->isExport()) { ?>
<script>
var fposition_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fposition_refview = currentForm = new ew.Form("fposition_refview", "view");
	loadjs.done("fposition_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$position_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $position_ref_view->ExportOptions->render("body") ?>
<?php $position_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $position_ref_view->showPageHeader(); ?>
<?php
$position_ref_view->showMessage();
?>
<?php if (!$position_ref_view->IsModal) { ?>
<?php if (!$position_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fposition_refview" id="fposition_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_ref">
<input type="hidden" name="modal" value="<?php echo (int)$position_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($position_ref_view->PositionCode->Visible) { // PositionCode ?>
	<tr id="r_PositionCode">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_PositionCode"><?php echo $position_ref_view->PositionCode->caption() ?></span></td>
		<td data-name="PositionCode" <?php echo $position_ref_view->PositionCode->cellAttributes() ?>>
<span id="el_position_ref_PositionCode">
<span<?php echo $position_ref_view->PositionCode->viewAttributes() ?>><?php echo $position_ref_view->PositionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->PositionName->Visible) { // PositionName ?>
	<tr id="r_PositionName">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_PositionName"><?php echo $position_ref_view->PositionName->caption() ?></span></td>
		<td data-name="PositionName" <?php echo $position_ref_view->PositionName->cellAttributes() ?>>
<span id="el_position_ref_PositionName">
<span<?php echo $position_ref_view->PositionName->viewAttributes() ?>><?php echo $position_ref_view->PositionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->RequisiteQualification->Visible) { // RequisiteQualification ?>
	<tr id="r_RequisiteQualification">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_RequisiteQualification"><?php echo $position_ref_view->RequisiteQualification->caption() ?></span></td>
		<td data-name="RequisiteQualification" <?php echo $position_ref_view->RequisiteQualification->cellAttributes() ?>>
<span id="el_position_ref_RequisiteQualification">
<span<?php echo $position_ref_view->RequisiteQualification->viewAttributes() ?>><?php echo $position_ref_view->RequisiteQualification->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->JobCode->Visible) { // JobCode ?>
	<tr id="r_JobCode">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_JobCode"><?php echo $position_ref_view->JobCode->caption() ?></span></td>
		<td data-name="JobCode" <?php echo $position_ref_view->JobCode->cellAttributes() ?>>
<span id="el_position_ref_JobCode">
<span<?php echo $position_ref_view->JobCode->viewAttributes() ?>><?php echo $position_ref_view->JobCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->SalaryScale->Visible) { // SalaryScale ?>
	<tr id="r_SalaryScale">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_SalaryScale"><?php echo $position_ref_view->SalaryScale->caption() ?></span></td>
		<td data-name="SalaryScale" <?php echo $position_ref_view->SalaryScale->cellAttributes() ?>>
<span id="el_position_ref_SalaryScale">
<span<?php echo $position_ref_view->SalaryScale->viewAttributes() ?>><?php echo $position_ref_view->SalaryScale->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_ProvinceCode"><?php echo $position_ref_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $position_ref_view->ProvinceCode->cellAttributes() ?>>
<span id="el_position_ref_ProvinceCode">
<span<?php echo $position_ref_view->ProvinceCode->viewAttributes() ?>><?php echo $position_ref_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_LACode"><?php echo $position_ref_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $position_ref_view->LACode->cellAttributes() ?>>
<span id="el_position_ref_LACode">
<span<?php echo $position_ref_view->LACode->viewAttributes() ?>><?php echo $position_ref_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_DepartmentCode"><?php echo $position_ref_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $position_ref_view->DepartmentCode->cellAttributes() ?>>
<span id="el_position_ref_DepartmentCode">
<span<?php echo $position_ref_view->DepartmentCode->viewAttributes() ?>><?php echo $position_ref_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_SectionCode"><?php echo $position_ref_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $position_ref_view->SectionCode->cellAttributes() ?>>
<span id="el_position_ref_SectionCode">
<span<?php echo $position_ref_view->SectionCode->viewAttributes() ?>><?php echo $position_ref_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($position_ref_view->FieldQualified->Visible) { // FieldQualified ?>
	<tr id="r_FieldQualified">
		<td class="<?php echo $position_ref_view->TableLeftColumnClass ?>"><span id="elh_position_ref_FieldQualified"><?php echo $position_ref_view->FieldQualified->caption() ?></span></td>
		<td data-name="FieldQualified" <?php echo $position_ref_view->FieldQualified->cellAttributes() ?>>
<span id="el_position_ref_FieldQualified">
<span<?php echo $position_ref_view->FieldQualified->viewAttributes() ?>><?php echo $position_ref_view->FieldQualified->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$position_ref_view->IsModal) { ?>
<?php if (!$position_ref_view->isExport()) { ?>
<?php echo $position_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("employment", explode(",", $position_ref->getCurrentDetailTable())) && $employment->DetailView) {
?>
<?php if ($position_ref->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employment", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employmentgrid.php" ?>
<?php } ?>
</form>
<?php
$position_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$position_ref_view->isExport()) { ?>
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
$position_ref_view->terminate();
?>