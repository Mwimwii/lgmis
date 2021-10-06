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
$staffexperience_view = new staffexperience_view();

// Run the page
$staffexperience_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffexperience_view->isExport()) { ?>
<script>
var fstaffexperienceview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffexperienceview = currentForm = new ew.Form("fstaffexperienceview", "view");
	loadjs.done("fstaffexperienceview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffexperience_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffexperience_view->ExportOptions->render("body") ?>
<?php $staffexperience_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffexperience_view->showPageHeader(); ?>
<?php
$staffexperience_view->showMessage();
?>
<?php if (!$staffexperience_view->IsModal) { ?>
<?php if (!$staffexperience_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffexperience_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffexperienceview" id="fstaffexperienceview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffexperience">
<input type="hidden" name="modal" value="<?php echo (int)$staffexperience_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffexperience_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_EmployeeID"><?php echo $staffexperience_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffexperience_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffexperience_EmployeeID">
<span<?php echo $staffexperience_view->EmployeeID->viewAttributes() ?>><?php echo $staffexperience_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_ProvinceCode"><?php echo $staffexperience_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $staffexperience_view->ProvinceCode->cellAttributes() ?>>
<span id="el_staffexperience_ProvinceCode">
<span<?php echo $staffexperience_view->ProvinceCode->viewAttributes() ?>><?php echo $staffexperience_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->LAcode->Visible) { // LAcode ?>
	<tr id="r_LAcode">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_LAcode"><?php echo $staffexperience_view->LAcode->caption() ?></span></td>
		<td data-name="LAcode" <?php echo $staffexperience_view->LAcode->cellAttributes() ?>>
<span id="el_staffexperience_LAcode">
<span<?php echo $staffexperience_view->LAcode->viewAttributes() ?>><?php echo $staffexperience_view->LAcode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->PositionCode->Visible) { // PositionCode ?>
	<tr id="r_PositionCode">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_PositionCode"><?php echo $staffexperience_view->PositionCode->caption() ?></span></td>
		<td data-name="PositionCode" <?php echo $staffexperience_view->PositionCode->cellAttributes() ?>>
<span id="el_staffexperience_PositionCode">
<span<?php echo $staffexperience_view->PositionCode->viewAttributes() ?>><?php echo $staffexperience_view->PositionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->FromDate->Visible) { // FromDate ?>
	<tr id="r_FromDate">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_FromDate"><?php echo $staffexperience_view->FromDate->caption() ?></span></td>
		<td data-name="FromDate" <?php echo $staffexperience_view->FromDate->cellAttributes() ?>>
<span id="el_staffexperience_FromDate">
<span<?php echo $staffexperience_view->FromDate->viewAttributes() ?>><?php echo $staffexperience_view->FromDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->ExitDate->Visible) { // ExitDate ?>
	<tr id="r_ExitDate">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_ExitDate"><?php echo $staffexperience_view->ExitDate->caption() ?></span></td>
		<td data-name="ExitDate" <?php echo $staffexperience_view->ExitDate->cellAttributes() ?>>
<span id="el_staffexperience_ExitDate">
<span<?php echo $staffexperience_view->ExitDate->viewAttributes() ?>><?php echo $staffexperience_view->ExitDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->RelevantExperience->Visible) { // RelevantExperience ?>
	<tr id="r_RelevantExperience">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_RelevantExperience"><?php echo $staffexperience_view->RelevantExperience->caption() ?></span></td>
		<td data-name="RelevantExperience" <?php echo $staffexperience_view->RelevantExperience->cellAttributes() ?>>
<span id="el_staffexperience_RelevantExperience">
<span<?php echo $staffexperience_view->RelevantExperience->viewAttributes() ?>><?php echo $staffexperience_view->RelevantExperience->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->ReasonForExit->Visible) { // ReasonForExit ?>
	<tr id="r_ReasonForExit">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_ReasonForExit"><?php echo $staffexperience_view->ReasonForExit->caption() ?></span></td>
		<td data-name="ReasonForExit" <?php echo $staffexperience_view->ReasonForExit->cellAttributes() ?>>
<span id="el_staffexperience_ReasonForExit">
<span<?php echo $staffexperience_view->ReasonForExit->viewAttributes() ?>><?php echo $staffexperience_view->ReasonForExit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffexperience_view->RetirementType->Visible) { // RetirementType ?>
	<tr id="r_RetirementType">
		<td class="<?php echo $staffexperience_view->TableLeftColumnClass ?>"><span id="elh_staffexperience_RetirementType"><?php echo $staffexperience_view->RetirementType->caption() ?></span></td>
		<td data-name="RetirementType" <?php echo $staffexperience_view->RetirementType->cellAttributes() ?>>
<span id="el_staffexperience_RetirementType">
<span<?php echo $staffexperience_view->RetirementType->viewAttributes() ?>><?php echo $staffexperience_view->RetirementType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffexperience_view->IsModal) { ?>
<?php if (!$staffexperience_view->isExport()) { ?>
<?php echo $staffexperience_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$staffexperience_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffexperience_view->isExport()) { ?>
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
$staffexperience_view->terminate();
?>