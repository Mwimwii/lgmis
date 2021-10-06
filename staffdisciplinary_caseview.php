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
$staffdisciplinary_case_view = new staffdisciplinary_case_view();

// Run the page
$staffdisciplinary_case_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_case_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffdisciplinary_case_view->isExport()) { ?>
<script>
var fstaffdisciplinary_caseview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffdisciplinary_caseview = currentForm = new ew.Form("fstaffdisciplinary_caseview", "view");
	loadjs.done("fstaffdisciplinary_caseview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffdisciplinary_case_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffdisciplinary_case_view->ExportOptions->render("body") ?>
<?php $staffdisciplinary_case_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffdisciplinary_case_view->showPageHeader(); ?>
<?php
$staffdisciplinary_case_view->showMessage();
?>
<?php if (!$staffdisciplinary_case_view->IsModal) { ?>
<?php if (!$staffdisciplinary_case_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_case_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffdisciplinary_caseview" id="fstaffdisciplinary_caseview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_case">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_case_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffdisciplinary_case_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_EmployeeID"><?php echo $staffdisciplinary_case_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffdisciplinary_case_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_EmployeeID">
<span<?php echo $staffdisciplinary_case_view->EmployeeID->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->CaseNo->Visible) { // CaseNo ?>
	<tr id="r_CaseNo">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_CaseNo"><?php echo $staffdisciplinary_case_view->CaseNo->caption() ?></span></td>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_case_view->CaseNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_CaseNo">
<span<?php echo $staffdisciplinary_case_view->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->CaseNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->OffenseCode->Visible) { // OffenseCode ?>
	<tr id="r_OffenseCode">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_OffenseCode"><?php echo $staffdisciplinary_case_view->OffenseCode->caption() ?></span></td>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_case_view->OffenseCode->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_OffenseCode">
<span<?php echo $staffdisciplinary_case_view->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->OffenseCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->CaseDescription->Visible) { // CaseDescription ?>
	<tr id="r_CaseDescription">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_CaseDescription"><?php echo $staffdisciplinary_case_view->CaseDescription->caption() ?></span></td>
		<td data-name="CaseDescription" <?php echo $staffdisciplinary_case_view->CaseDescription->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_CaseDescription">
<span<?php echo $staffdisciplinary_case_view->CaseDescription->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->CaseDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->ActionTaken->Visible) { // ActionTaken ?>
	<tr id="r_ActionTaken">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_ActionTaken"><?php echo $staffdisciplinary_case_view->ActionTaken->caption() ?></span></td>
		<td data-name="ActionTaken" <?php echo $staffdisciplinary_case_view->ActionTaken->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionTaken">
<span<?php echo $staffdisciplinary_case_view->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->ActionTaken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->OffenseDate->Visible) { // OffenseDate ?>
	<tr id="r_OffenseDate">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_OffenseDate"><?php echo $staffdisciplinary_case_view->OffenseDate->caption() ?></span></td>
		<td data-name="OffenseDate" <?php echo $staffdisciplinary_case_view->OffenseDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_OffenseDate">
<span<?php echo $staffdisciplinary_case_view->OffenseDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->OffenseDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->ActionDate->Visible) { // ActionDate ?>
	<tr id="r_ActionDate">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_ActionDate"><?php echo $staffdisciplinary_case_view->ActionDate->caption() ?></span></td>
		<td data-name="ActionDate" <?php echo $staffdisciplinary_case_view->ActionDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_ActionDate">
<span<?php echo $staffdisciplinary_case_view->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->ActionDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<tr id="r_DateOfAppealLetter">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_DateOfAppealLetter"><?php echo $staffdisciplinary_case_view->DateOfAppealLetter->caption() ?></span></td>
		<td data-name="DateOfAppealLetter" <?php echo $staffdisciplinary_case_view->DateOfAppealLetter->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_case_view->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->DateOfAppealLetter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<tr id="r_DateAppealReceived">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_DateAppealReceived"><?php echo $staffdisciplinary_case_view->DateAppealReceived->caption() ?></span></td>
		<td data-name="DateAppealReceived" <?php echo $staffdisciplinary_case_view->DateAppealReceived->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateAppealReceived">
<span<?php echo $staffdisciplinary_case_view->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->DateAppealReceived->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->DateConcluded->Visible) { // DateConcluded ?>
	<tr id="r_DateConcluded">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_DateConcluded"><?php echo $staffdisciplinary_case_view->DateConcluded->caption() ?></span></td>
		<td data-name="DateConcluded" <?php echo $staffdisciplinary_case_view->DateConcluded->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DateConcluded">
<span<?php echo $staffdisciplinary_case_view->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->DateConcluded->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->AppealStatus->Visible) { // AppealStatus ?>
	<tr id="r_AppealStatus">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_AppealStatus"><?php echo $staffdisciplinary_case_view->AppealStatus->caption() ?></span></td>
		<td data-name="AppealStatus" <?php echo $staffdisciplinary_case_view->AppealStatus->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_AppealStatus">
<span<?php echo $staffdisciplinary_case_view->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->AppealStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->DiciplinaryHearing->Visible) { // DiciplinaryHearing ?>
	<tr id="r_DiciplinaryHearing">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_DiciplinaryHearing"><?php echo $staffdisciplinary_case_view->DiciplinaryHearing->caption() ?></span></td>
		<td data-name="DiciplinaryHearing" <?php echo $staffdisciplinary_case_view->DiciplinaryHearing->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_DiciplinaryHearing">
<span<?php echo $staffdisciplinary_case_view->DiciplinaryHearing->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->DiciplinaryHearing->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_case_view->AppealNotes->Visible) { // AppealNotes ?>
	<tr id="r_AppealNotes">
		<td class="<?php echo $staffdisciplinary_case_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_case_AppealNotes"><?php echo $staffdisciplinary_case_view->AppealNotes->caption() ?></span></td>
		<td data-name="AppealNotes" <?php echo $staffdisciplinary_case_view->AppealNotes->cellAttributes() ?>>
<span id="el_staffdisciplinary_case_AppealNotes">
<span<?php echo $staffdisciplinary_case_view->AppealNotes->viewAttributes() ?>><?php echo $staffdisciplinary_case_view->AppealNotes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffdisciplinary_case_view->IsModal) { ?>
<?php if (!$staffdisciplinary_case_view->isExport()) { ?>
<?php echo $staffdisciplinary_case_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("staffdisciplinary_appeal", explode(",", $staffdisciplinary_case->getCurrentDetailTable())) && $staffdisciplinary_appeal->DetailView) {
?>
<?php if ($staffdisciplinary_case->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("staffdisciplinary_appeal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "staffdisciplinary_appealgrid.php" ?>
<?php } ?>
<?php
	if (in_array("staffdisciplinary_action", explode(",", $staffdisciplinary_case->getCurrentDetailTable())) && $staffdisciplinary_action->DetailView) {
?>
<?php if ($staffdisciplinary_case->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("staffdisciplinary_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "staffdisciplinary_actiongrid.php" ?>
<?php } ?>
</form>
<?php
$staffdisciplinary_case_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffdisciplinary_case_view->isExport()) { ?>
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
$staffdisciplinary_case_view->terminate();
?>