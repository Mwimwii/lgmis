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
$deduction_type_view = new deduction_type_view();

// Run the page
$deduction_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$deduction_type_view->isExport()) { ?>
<script>
var fdeduction_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdeduction_typeview = currentForm = new ew.Form("fdeduction_typeview", "view");
	loadjs.done("fdeduction_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$deduction_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $deduction_type_view->ExportOptions->render("body") ?>
<?php $deduction_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $deduction_type_view->showPageHeader(); ?>
<?php
$deduction_type_view->showMessage();
?>
<?php if (!$deduction_type_view->IsModal) { ?>
<?php if (!$deduction_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deduction_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdeduction_typeview" id="fdeduction_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deduction_type">
<input type="hidden" name="modal" value="<?php echo (int)$deduction_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($deduction_type_view->DeductionCode->Visible) { // DeductionCode ?>
	<tr id="r_DeductionCode">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_DeductionCode"><?php echo $deduction_type_view->DeductionCode->caption() ?></span></td>
		<td data-name="DeductionCode" <?php echo $deduction_type_view->DeductionCode->cellAttributes() ?>>
<span id="el_deduction_type_DeductionCode">
<span<?php echo $deduction_type_view->DeductionCode->viewAttributes() ?>><?php echo $deduction_type_view->DeductionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->DeductionName->Visible) { // DeductionName ?>
	<tr id="r_DeductionName">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_DeductionName"><?php echo $deduction_type_view->DeductionName->caption() ?></span></td>
		<td data-name="DeductionName" <?php echo $deduction_type_view->DeductionName->cellAttributes() ?>>
<span id="el_deduction_type_DeductionName">
<span<?php echo $deduction_type_view->DeductionName->viewAttributes() ?>><?php echo $deduction_type_view->DeductionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->DeductionDescription->Visible) { // DeductionDescription ?>
	<tr id="r_DeductionDescription">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_DeductionDescription"><?php echo $deduction_type_view->DeductionDescription->caption() ?></span></td>
		<td data-name="DeductionDescription" <?php echo $deduction_type_view->DeductionDescription->cellAttributes() ?>>
<span id="el_deduction_type_DeductionDescription">
<span<?php echo $deduction_type_view->DeductionDescription->viewAttributes() ?>><?php echo $deduction_type_view->DeductionDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->Division->Visible) { // Division ?>
	<tr id="r_Division">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_Division"><?php echo $deduction_type_view->Division->caption() ?></span></td>
		<td data-name="Division" <?php echo $deduction_type_view->Division->cellAttributes() ?>>
<span id="el_deduction_type_Division">
<span<?php echo $deduction_type_view->Division->viewAttributes() ?>><?php echo $deduction_type_view->Division->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->DeductionAmount->Visible) { // DeductionAmount ?>
	<tr id="r_DeductionAmount">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_DeductionAmount"><?php echo $deduction_type_view->DeductionAmount->caption() ?></span></td>
		<td data-name="DeductionAmount" <?php echo $deduction_type_view->DeductionAmount->cellAttributes() ?>>
<span id="el_deduction_type_DeductionAmount">
<span<?php echo $deduction_type_view->DeductionAmount->viewAttributes() ?>><?php echo $deduction_type_view->DeductionAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
	<tr id="r_DeductionBasicRate">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_DeductionBasicRate"><?php echo $deduction_type_view->DeductionBasicRate->caption() ?></span></td>
		<td data-name="DeductionBasicRate" <?php echo $deduction_type_view->DeductionBasicRate->cellAttributes() ?>>
<span id="el_deduction_type_DeductionBasicRate">
<span<?php echo $deduction_type_view->DeductionBasicRate->viewAttributes() ?>><?php echo $deduction_type_view->DeductionBasicRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->RemittedTo->Visible) { // RemittedTo ?>
	<tr id="r_RemittedTo">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_RemittedTo"><?php echo $deduction_type_view->RemittedTo->caption() ?></span></td>
		<td data-name="RemittedTo" <?php echo $deduction_type_view->RemittedTo->cellAttributes() ?>>
<span id="el_deduction_type_RemittedTo">
<span<?php echo $deduction_type_view->RemittedTo->viewAttributes() ?>><?php echo $deduction_type_view->RemittedTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->AccountNo->Visible) { // AccountNo ?>
	<tr id="r_AccountNo">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_AccountNo"><?php echo $deduction_type_view->AccountNo->caption() ?></span></td>
		<td data-name="AccountNo" <?php echo $deduction_type_view->AccountNo->cellAttributes() ?>>
<span id="el_deduction_type_AccountNo">
<span<?php echo $deduction_type_view->AccountNo->viewAttributes() ?>><?php echo $deduction_type_view->AccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<tr id="r_BaseIncomeCode">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_BaseIncomeCode"><?php echo $deduction_type_view->BaseIncomeCode->caption() ?></span></td>
		<td data-name="BaseIncomeCode" <?php echo $deduction_type_view->BaseIncomeCode->cellAttributes() ?>>
<span id="el_deduction_type_BaseIncomeCode">
<span<?php echo $deduction_type_view->BaseIncomeCode->viewAttributes() ?>><?php echo $deduction_type_view->BaseIncomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
	<tr id="r_BaseDeductionCode">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_BaseDeductionCode"><?php echo $deduction_type_view->BaseDeductionCode->caption() ?></span></td>
		<td data-name="BaseDeductionCode" <?php echo $deduction_type_view->BaseDeductionCode->cellAttributes() ?>>
<span id="el_deduction_type_BaseDeductionCode">
<span<?php echo $deduction_type_view->BaseDeductionCode->viewAttributes() ?>><?php echo $deduction_type_view->BaseDeductionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->TaxExempt->Visible) { // TaxExempt ?>
	<tr id="r_TaxExempt">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_TaxExempt"><?php echo $deduction_type_view->TaxExempt->caption() ?></span></td>
		<td data-name="TaxExempt" <?php echo $deduction_type_view->TaxExempt->cellAttributes() ?>>
<span id="el_deduction_type_TaxExempt">
<span<?php echo $deduction_type_view->TaxExempt->viewAttributes() ?>><?php echo $deduction_type_view->TaxExempt->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->JobCode->Visible) { // JobCode ?>
	<tr id="r_JobCode">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_JobCode"><?php echo $deduction_type_view->JobCode->caption() ?></span></td>
		<td data-name="JobCode" <?php echo $deduction_type_view->JobCode->cellAttributes() ?>>
<span id="el_deduction_type_JobCode">
<span<?php echo $deduction_type_view->JobCode->viewAttributes() ?>><?php echo $deduction_type_view->JobCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->MinimumAmount->Visible) { // MinimumAmount ?>
	<tr id="r_MinimumAmount">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_MinimumAmount"><?php echo $deduction_type_view->MinimumAmount->caption() ?></span></td>
		<td data-name="MinimumAmount" <?php echo $deduction_type_view->MinimumAmount->cellAttributes() ?>>
<span id="el_deduction_type_MinimumAmount">
<span<?php echo $deduction_type_view->MinimumAmount->viewAttributes() ?>><?php echo $deduction_type_view->MinimumAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->MaximumAmount->Visible) { // MaximumAmount ?>
	<tr id="r_MaximumAmount">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_MaximumAmount"><?php echo $deduction_type_view->MaximumAmount->caption() ?></span></td>
		<td data-name="MaximumAmount" <?php echo $deduction_type_view->MaximumAmount->cellAttributes() ?>>
<span id="el_deduction_type_MaximumAmount">
<span<?php echo $deduction_type_view->MaximumAmount->viewAttributes() ?>><?php echo $deduction_type_view->MaximumAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
	<tr id="r_EmployerContributionRate">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_EmployerContributionRate"><?php echo $deduction_type_view->EmployerContributionRate->caption() ?></span></td>
		<td data-name="EmployerContributionRate" <?php echo $deduction_type_view->EmployerContributionRate->cellAttributes() ?>>
<span id="el_deduction_type_EmployerContributionRate">
<span<?php echo $deduction_type_view->EmployerContributionRate->viewAttributes() ?>><?php echo $deduction_type_view->EmployerContributionRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
	<tr id="r_EmployerContributionAmount">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_EmployerContributionAmount"><?php echo $deduction_type_view->EmployerContributionAmount->caption() ?></span></td>
		<td data-name="EmployerContributionAmount" <?php echo $deduction_type_view->EmployerContributionAmount->cellAttributes() ?>>
<span id="el_deduction_type_EmployerContributionAmount">
<span<?php echo $deduction_type_view->EmployerContributionAmount->viewAttributes() ?>><?php echo $deduction_type_view->EmployerContributionAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($deduction_type_view->Application->Visible) { // Application ?>
	<tr id="r_Application">
		<td class="<?php echo $deduction_type_view->TableLeftColumnClass ?>"><span id="elh_deduction_type_Application"><?php echo $deduction_type_view->Application->caption() ?></span></td>
		<td data-name="Application" <?php echo $deduction_type_view->Application->cellAttributes() ?>>
<span id="el_deduction_type_Application">
<span<?php echo $deduction_type_view->Application->viewAttributes() ?>><?php echo $deduction_type_view->Application->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$deduction_type_view->IsModal) { ?>
<?php if (!$deduction_type_view->isExport()) { ?>
<?php echo $deduction_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$deduction_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$deduction_type_view->isExport()) { ?>
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
$deduction_type_view->terminate();
?>