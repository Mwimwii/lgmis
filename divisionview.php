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
$division_view = new division_view();

// Run the page
$division_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$division_view->isExport()) { ?>
<script>
var fdivisionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdivisionview = currentForm = new ew.Form("fdivisionview", "view");
	loadjs.done("fdivisionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$division_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $division_view->ExportOptions->render("body") ?>
<?php $division_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $division_view->showPageHeader(); ?>
<?php
$division_view->showMessage();
?>
<?php if (!$division_view->IsModal) { ?>
<?php if (!$division_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $division_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdivisionview" id="fdivisionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<input type="hidden" name="modal" value="<?php echo (int)$division_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($division_view->Division->Visible) { // Division ?>
	<tr id="r_Division">
		<td class="<?php echo $division_view->TableLeftColumnClass ?>"><span id="elh_division_Division"><?php echo $division_view->Division->caption() ?></span></td>
		<td data-name="Division" <?php echo $division_view->Division->cellAttributes() ?>>
<span id="el_division_Division">
<span<?php echo $division_view->Division->viewAttributes() ?>><?php echo $division_view->Division->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($division_view->DivisionName->Visible) { // DivisionName ?>
	<tr id="r_DivisionName">
		<td class="<?php echo $division_view->TableLeftColumnClass ?>"><span id="elh_division_DivisionName"><?php echo $division_view->DivisionName->caption() ?></span></td>
		<td data-name="DivisionName" <?php echo $division_view->DivisionName->cellAttributes() ?>>
<span id="el_division_DivisionName">
<span<?php echo $division_view->DivisionName->viewAttributes() ?>><?php echo $division_view->DivisionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($division_view->Comments->Visible) { // Comments ?>
	<tr id="r_Comments">
		<td class="<?php echo $division_view->TableLeftColumnClass ?>"><span id="elh_division_Comments"><?php echo $division_view->Comments->caption() ?></span></td>
		<td data-name="Comments" <?php echo $division_view->Comments->cellAttributes() ?>>
<span id="el_division_Comments">
<span<?php echo $division_view->Comments->viewAttributes() ?>><?php echo $division_view->Comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$division_view->IsModal) { ?>
<?php if (!$division_view->isExport()) { ?>
<?php echo $division_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("job", explode(",", $division->getCurrentDetailTable())) && $job->DetailView) {
?>
<?php if ($division->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("job", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "jobgrid.php" ?>
<?php } ?>
<?php
	if (in_array("salary_scale", explode(",", $division->getCurrentDetailTable())) && $salary_scale->DetailView) {
?>
<?php if ($division->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("salary_scale", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "salary_scalegrid.php" ?>
<?php } ?>
</form>
<?php
$division_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$division_view->isExport()) { ?>
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
$division_view->terminate();
?>