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
$councillorship_history_view = new councillorship_history_view();

// Run the page
$councillorship_history_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_history_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillorship_history_view->isExport()) { ?>
<script>
var fcouncillorship_historyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncillorship_historyview = currentForm = new ew.Form("fcouncillorship_historyview", "view");
	loadjs.done("fcouncillorship_historyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$councillorship_history_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $councillorship_history_view->ExportOptions->render("body") ?>
<?php $councillorship_history_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $councillorship_history_view->showPageHeader(); ?>
<?php
$councillorship_history_view->showMessage();
?>
<?php if (!$councillorship_history_view->IsModal) { ?>
<?php if (!$councillorship_history_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_history_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncillorship_historyview" id="fcouncillorship_historyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_history">
<input type="hidden" name="modal" value="<?php echo (int)$councillorship_history_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($councillorship_history_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_EmployeeID"><?php echo $councillorship_history_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $councillorship_history_view->EmployeeID->cellAttributes() ?>>
<span id="el_councillorship_history_EmployeeID">
<span<?php echo $councillorship_history_view->EmployeeID->viewAttributes() ?>><?php echo $councillorship_history_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_ProvinceCode"><?php echo $councillorship_history_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $councillorship_history_view->ProvinceCode->cellAttributes() ?>>
<span id="el_councillorship_history_ProvinceCode">
<span<?php echo $councillorship_history_view->ProvinceCode->viewAttributes() ?>><?php echo $councillorship_history_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_LACode"><?php echo $councillorship_history_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $councillorship_history_view->LACode->cellAttributes() ?>>
<span id="el_councillorship_history_LACode">
<span<?php echo $councillorship_history_view->LACode->viewAttributes() ?>><?php echo $councillorship_history_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->PoliticalParty->Visible) { // PoliticalParty ?>
	<tr id="r_PoliticalParty">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_PoliticalParty"><?php echo $councillorship_history_view->PoliticalParty->caption() ?></span></td>
		<td data-name="PoliticalParty" <?php echo $councillorship_history_view->PoliticalParty->cellAttributes() ?>>
<span id="el_councillorship_history_PoliticalParty">
<span<?php echo $councillorship_history_view->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_history_view->PoliticalParty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->Occupation->Visible) { // Occupation ?>
	<tr id="r_Occupation">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_Occupation"><?php echo $councillorship_history_view->Occupation->caption() ?></span></td>
		<td data-name="Occupation" <?php echo $councillorship_history_view->Occupation->cellAttributes() ?>>
<span id="el_councillorship_history_Occupation">
<span<?php echo $councillorship_history_view->Occupation->viewAttributes() ?>><?php echo $councillorship_history_view->Occupation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<tr id="r_PositionInCouncil">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_PositionInCouncil"><?php echo $councillorship_history_view->PositionInCouncil->caption() ?></span></td>
		<td data-name="PositionInCouncil" <?php echo $councillorship_history_view->PositionInCouncil->cellAttributes() ?>>
<span id="el_councillorship_history_PositionInCouncil">
<span<?php echo $councillorship_history_view->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_history_view->PositionInCouncil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->Committee->Visible) { // Committee ?>
	<tr id="r_Committee">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_Committee"><?php echo $councillorship_history_view->Committee->caption() ?></span></td>
		<td data-name="Committee" <?php echo $councillorship_history_view->Committee->cellAttributes() ?>>
<span id="el_councillorship_history_Committee">
<span<?php echo $councillorship_history_view->Committee->viewAttributes() ?>><?php echo $councillorship_history_view->Committee->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->CouncilTerm->Visible) { // CouncilTerm ?>
	<tr id="r_CouncilTerm">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_CouncilTerm"><?php echo $councillorship_history_view->CouncilTerm->caption() ?></span></td>
		<td data-name="CouncilTerm" <?php echo $councillorship_history_view->CouncilTerm->cellAttributes() ?>>
<span id="el_councillorship_history_CouncilTerm">
<span<?php echo $councillorship_history_view->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_history_view->CouncilTerm->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->DateOfExit->Visible) { // DateOfExit ?>
	<tr id="r_DateOfExit">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_DateOfExit"><?php echo $councillorship_history_view->DateOfExit->caption() ?></span></td>
		<td data-name="DateOfExit" <?php echo $councillorship_history_view->DateOfExit->cellAttributes() ?>>
<span id="el_councillorship_history_DateOfExit">
<span<?php echo $councillorship_history_view->DateOfExit->viewAttributes() ?>><?php echo $councillorship_history_view->DateOfExit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->Allowance->Visible) { // Allowance ?>
	<tr id="r_Allowance">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_Allowance"><?php echo $councillorship_history_view->Allowance->caption() ?></span></td>
		<td data-name="Allowance" <?php echo $councillorship_history_view->Allowance->cellAttributes() ?>>
<span id="el_councillorship_history_Allowance">
<span<?php echo $councillorship_history_view->Allowance->viewAttributes() ?>><?php echo $councillorship_history_view->Allowance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<tr id="r_CouncillorTypeType">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_CouncillorTypeType"><?php echo $councillorship_history_view->CouncillorTypeType->caption() ?></span></td>
		<td data-name="CouncillorTypeType" <?php echo $councillorship_history_view->CouncillorTypeType->cellAttributes() ?>>
<span id="el_councillorship_history_CouncillorTypeType">
<span<?php echo $councillorship_history_view->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_history_view->CouncillorTypeType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->CouncillorshipStatus->Visible) { // CouncillorshipStatus ?>
	<tr id="r_CouncillorshipStatus">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_CouncillorshipStatus"><?php echo $councillorship_history_view->CouncillorshipStatus->caption() ?></span></td>
		<td data-name="CouncillorshipStatus" <?php echo $councillorship_history_view->CouncillorshipStatus->cellAttributes() ?>>
<span id="el_councillorship_history_CouncillorshipStatus">
<span<?php echo $councillorship_history_view->CouncillorshipStatus->viewAttributes() ?>><?php echo $councillorship_history_view->CouncillorshipStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->ExitReason->Visible) { // ExitReason ?>
	<tr id="r_ExitReason">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_ExitReason"><?php echo $councillorship_history_view->ExitReason->caption() ?></span></td>
		<td data-name="ExitReason" <?php echo $councillorship_history_view->ExitReason->cellAttributes() ?>>
<span id="el_councillorship_history_ExitReason">
<span<?php echo $councillorship_history_view->ExitReason->viewAttributes() ?>><?php echo $councillorship_history_view->ExitReason->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillorship_history_view->RetirementType->Visible) { // RetirementType ?>
	<tr id="r_RetirementType">
		<td class="<?php echo $councillorship_history_view->TableLeftColumnClass ?>"><span id="elh_councillorship_history_RetirementType"><?php echo $councillorship_history_view->RetirementType->caption() ?></span></td>
		<td data-name="RetirementType" <?php echo $councillorship_history_view->RetirementType->cellAttributes() ?>>
<span id="el_councillorship_history_RetirementType">
<span<?php echo $councillorship_history_view->RetirementType->viewAttributes() ?>><?php echo $councillorship_history_view->RetirementType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$councillorship_history_view->IsModal) { ?>
<?php if (!$councillorship_history_view->isExport()) { ?>
<?php echo $councillorship_history_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$councillorship_history_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillorship_history_view->isExport()) { ?>
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
$councillorship_history_view->terminate();
?>