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
$dept_section_view = new dept_section_view();

// Run the page
$dept_section_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dept_section_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dept_section_view->isExport()) { ?>
<script>
var fdept_sectionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdept_sectionview = currentForm = new ew.Form("fdept_sectionview", "view");
	loadjs.done("fdept_sectionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$dept_section_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $dept_section_view->ExportOptions->render("body") ?>
<?php $dept_section_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $dept_section_view->showPageHeader(); ?>
<?php
$dept_section_view->showMessage();
?>
<?php if (!$dept_section_view->IsModal) { ?>
<?php if (!$dept_section_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dept_section_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdept_sectionview" id="fdept_sectionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dept_section">
<input type="hidden" name="modal" value="<?php echo (int)$dept_section_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($dept_section_view->SectionName->Visible) { // SectionName ?>
	<tr id="r_SectionName">
		<td class="<?php echo $dept_section_view->TableLeftColumnClass ?>"><span id="elh_dept_section_SectionName"><?php echo $dept_section_view->SectionName->caption() ?></span></td>
		<td data-name="SectionName" <?php echo $dept_section_view->SectionName->cellAttributes() ?>>
<span id="el_dept_section_SectionName">
<span<?php echo $dept_section_view->SectionName->viewAttributes() ?>><?php echo $dept_section_view->SectionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dept_section_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $dept_section_view->TableLeftColumnClass ?>"><span id="elh_dept_section_SectionCode"><?php echo $dept_section_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $dept_section_view->SectionCode->cellAttributes() ?>>
<span id="el_dept_section_SectionCode">
<span<?php echo $dept_section_view->SectionCode->viewAttributes() ?>><?php echo $dept_section_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dept_section_view->Telephone->Visible) { // Telephone ?>
	<tr id="r_Telephone">
		<td class="<?php echo $dept_section_view->TableLeftColumnClass ?>"><span id="elh_dept_section_Telephone"><?php echo $dept_section_view->Telephone->caption() ?></span></td>
		<td data-name="Telephone" <?php echo $dept_section_view->Telephone->cellAttributes() ?>>
<span id="el_dept_section_Telephone">
<span<?php echo $dept_section_view->Telephone->viewAttributes() ?>><?php echo $dept_section_view->Telephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dept_section_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $dept_section_view->TableLeftColumnClass ?>"><span id="elh_dept_section__Email"><?php echo $dept_section_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $dept_section_view->_Email->cellAttributes() ?>>
<span id="el_dept_section__Email">
<span<?php echo $dept_section_view->_Email->viewAttributes() ?>><?php echo $dept_section_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dept_section_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $dept_section_view->TableLeftColumnClass ?>"><span id="elh_dept_section_ProvinceCode"><?php echo $dept_section_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $dept_section_view->ProvinceCode->cellAttributes() ?>>
<span id="el_dept_section_ProvinceCode">
<span<?php echo $dept_section_view->ProvinceCode->viewAttributes() ?>><?php echo $dept_section_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dept_section_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $dept_section_view->TableLeftColumnClass ?>"><span id="elh_dept_section_LACode"><?php echo $dept_section_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $dept_section_view->LACode->cellAttributes() ?>>
<span id="el_dept_section_LACode">
<span<?php echo $dept_section_view->LACode->viewAttributes() ?>><?php echo $dept_section_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dept_section_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $dept_section_view->TableLeftColumnClass ?>"><span id="elh_dept_section_DepartmentCode"><?php echo $dept_section_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $dept_section_view->DepartmentCode->cellAttributes() ?>>
<span id="el_dept_section_DepartmentCode">
<span<?php echo $dept_section_view->DepartmentCode->viewAttributes() ?>><?php echo $dept_section_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$dept_section_view->IsModal) { ?>
<?php if (!$dept_section_view->isExport()) { ?>
<?php echo $dept_section_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("position_ref", explode(",", $dept_section->getCurrentDetailTable())) && $position_ref->DetailView) {
?>
<?php if ($dept_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("position_ref", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "position_refgrid.php" ?>
<?php } ?>
<?php
	if (in_array("programme", explode(",", $dept_section->getCurrentDetailTable())) && $programme->DetailView) {
?>
<?php if ($dept_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("programme", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "programmegrid.php" ?>
<?php } ?>
</form>
<?php
$dept_section_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dept_section_view->isExport()) { ?>
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
$dept_section_view->terminate();
?>