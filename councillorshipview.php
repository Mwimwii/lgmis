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
$councillorship_view = new councillorship_view();

// Run the page
$councillorship_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillorship_view->isExport()) { ?>
<script>
var fcouncillorshipview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncillorshipview = currentForm = new ew.Form("fcouncillorshipview", "view");
	loadjs.done("fcouncillorshipview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$councillorship_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $councillorship_view->ExportOptions->render("body") ?>
<?php $councillorship_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $councillorship_view->showPageHeader(); ?>
<?php
$councillorship_view->showMessage();
?>
<?php if (!$councillorship_view->IsModal) { ?>
<?php if (!$councillorship_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncillorshipview" id="fcouncillorshipview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($councillorship_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_EmployeeID"><?php echo $councillorship_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $councillorship_view->EmployeeID->cellAttributes() ?>>
<span id="el_councillorship_EmployeeID">
<span<?php echo $councillorship_view->EmployeeID->viewAttributes() ?>><?php echo $councillorship_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_ProvinceCode"><?php echo $councillorship_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $councillorship_view->ProvinceCode->cellAttributes() ?>>
<span id="el_councillorship_ProvinceCode">
<span<?php echo $councillorship_view->ProvinceCode->viewAttributes() ?>><?php echo $councillorship_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_LACode"><?php echo $councillorship_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $councillorship_view->LACode->cellAttributes() ?>>
<span id="el_councillorship_LACode">
<span<?php echo $councillorship_view->LACode->viewAttributes() ?>><?php echo $councillorship_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->PoliticalParty->Visible) { // PoliticalParty ?>
	<tr id="r_PoliticalParty">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_PoliticalParty"><?php echo $councillorship_view->PoliticalParty->caption() ?></span></td>
		<td data-name="PoliticalParty" <?php echo $councillorship_view->PoliticalParty->cellAttributes() ?>>
<span id="el_councillorship_PoliticalParty">
<span<?php echo $councillorship_view->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_view->PoliticalParty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->Occupation->Visible) { // Occupation ?>
	<tr id="r_Occupation">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_Occupation"><?php echo $councillorship_view->Occupation->caption() ?></span></td>
		<td data-name="Occupation" <?php echo $councillorship_view->Occupation->cellAttributes() ?>>
<span id="el_councillorship_Occupation">
<span<?php echo $councillorship_view->Occupation->viewAttributes() ?>><?php echo $councillorship_view->Occupation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<tr id="r_PositionInCouncil">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_PositionInCouncil"><?php echo $councillorship_view->PositionInCouncil->caption() ?></span></td>
		<td data-name="PositionInCouncil" <?php echo $councillorship_view->PositionInCouncil->cellAttributes() ?>>
<span id="el_councillorship_PositionInCouncil">
<span<?php echo $councillorship_view->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_view->PositionInCouncil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->Committee->Visible) { // Committee ?>
	<tr id="r_Committee">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_Committee"><?php echo $councillorship_view->Committee->caption() ?></span></td>
		<td data-name="Committee" <?php echo $councillorship_view->Committee->cellAttributes() ?>>
<span id="el_councillorship_Committee">
<span<?php echo $councillorship_view->Committee->viewAttributes() ?>><?php echo $councillorship_view->Committee->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->CommitteeRole->Visible) { // CommitteeRole ?>
	<tr id="r_CommitteeRole">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_CommitteeRole"><?php echo $councillorship_view->CommitteeRole->caption() ?></span></td>
		<td data-name="CommitteeRole" <?php echo $councillorship_view->CommitteeRole->cellAttributes() ?>>
<span id="el_councillorship_CommitteeRole">
<span<?php echo $councillorship_view->CommitteeRole->viewAttributes() ?>><?php echo $councillorship_view->CommitteeRole->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->CouncilTerm->Visible) { // CouncilTerm ?>
	<tr id="r_CouncilTerm">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_CouncilTerm"><?php echo $councillorship_view->CouncilTerm->caption() ?></span></td>
		<td data-name="CouncilTerm" <?php echo $councillorship_view->CouncilTerm->cellAttributes() ?>>
<span id="el_councillorship_CouncilTerm">
<span<?php echo $councillorship_view->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_view->CouncilTerm->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->DateOfExit->Visible) { // DateOfExit ?>
	<tr id="r_DateOfExit">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_DateOfExit"><?php echo $councillorship_view->DateOfExit->caption() ?></span></td>
		<td data-name="DateOfExit" <?php echo $councillorship_view->DateOfExit->cellAttributes() ?>>
<span id="el_councillorship_DateOfExit">
<span<?php echo $councillorship_view->DateOfExit->viewAttributes() ?>><?php echo $councillorship_view->DateOfExit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->Allowance->Visible) { // Allowance ?>
	<tr id="r_Allowance">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_Allowance"><?php echo $councillorship_view->Allowance->caption() ?></span></td>
		<td data-name="Allowance" <?php echo $councillorship_view->Allowance->cellAttributes() ?>>
<span id="el_councillorship_Allowance">
<span<?php echo $councillorship_view->Allowance->viewAttributes() ?>><?php echo $councillorship_view->Allowance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<tr id="r_CouncillorTypeType">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_CouncillorTypeType"><?php echo $councillorship_view->CouncillorTypeType->caption() ?></span></td>
		<td data-name="CouncillorTypeType" <?php echo $councillorship_view->CouncillorTypeType->cellAttributes() ?>>
<span id="el_councillorship_CouncillorTypeType">
<span<?php echo $councillorship_view->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_view->CouncillorTypeType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->ExitReason->Visible) { // ExitReason ?>
	<tr id="r_ExitReason">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_ExitReason"><?php echo $councillorship_view->ExitReason->caption() ?></span></td>
		<td data-name="ExitReason" <?php echo $councillorship_view->ExitReason->cellAttributes() ?>>
<span id="el_councillorship_ExitReason">
<span<?php echo $councillorship_view->ExitReason->viewAttributes() ?>><?php echo $councillorship_view->ExitReason->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_view->CouncillorPhoto->Visible) { // CouncillorPhoto ?>
	<tr id="r_CouncillorPhoto">
		<td class="<?php echo $councillorship_view->TableLeftColumnClass ?>"><span id="elh_councillorship_CouncillorPhoto"><?php echo $councillorship_view->CouncillorPhoto->caption() ?></span></td>
		<td data-name="CouncillorPhoto" <?php echo $councillorship_view->CouncillorPhoto->cellAttributes() ?>>
<span id="el_councillorship_CouncillorPhoto">
<span<?php echo $councillorship_view->CouncillorPhoto->viewAttributes() ?>><?php echo GetFileViewTag($councillorship_view->CouncillorPhoto, $councillorship_view->CouncillorPhoto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$councillorship_view->IsModal) { ?>
<?php if (!$councillorship_view->isExport()) { ?>
<?php echo $councillorship_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("councillor_allowance", explode(",", $councillorship->getCurrentDetailTable())) && $councillor_allowance->DetailView) {
?>
<?php if ($councillorship->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillor_allowance", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillor_allowancegrid.php" ?>
<?php } ?>
<?php
	if (in_array("committee_appointed", explode(",", $councillorship->getCurrentDetailTable())) && $committee_appointed->DetailView) {
?>
<?php if ($councillorship->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("committee_appointed", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "committee_appointedgrid.php" ?>
<?php } ?>
</form>
<?php
$councillorship_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillorship_view->isExport()) { ?>
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
$councillorship_view->terminate();
?>