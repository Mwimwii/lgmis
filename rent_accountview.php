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
$rent_account_view = new rent_account_view();

// Run the page
$rent_account_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_account_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rent_account_view->isExport()) { ?>
<script>
var frent_accountview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frent_accountview = currentForm = new ew.Form("frent_accountview", "view");
	loadjs.done("frent_accountview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rent_account_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rent_account_view->ExportOptions->render("body") ?>
<?php $rent_account_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rent_account_view->showPageHeader(); ?>
<?php
$rent_account_view->showMessage();
?>
<?php if (!$rent_account_view->IsModal) { ?>
<?php if (!$rent_account_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rent_account_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="frent_accountview" id="frent_accountview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_account">
<input type="hidden" name="modal" value="<?php echo (int)$rent_account_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($rent_account_view->AccountNo->Visible) { // AccountNo ?>
	<tr id="r_AccountNo">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_AccountNo"><?php echo $rent_account_view->AccountNo->caption() ?></span></td>
		<td data-name="AccountNo" <?php echo $rent_account_view->AccountNo->cellAttributes() ?>>
<span id="el_rent_account_AccountNo">
<span<?php echo $rent_account_view->AccountNo->viewAttributes() ?>><?php echo $rent_account_view->AccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->PropertyNo->Visible) { // PropertyNo ?>
	<tr id="r_PropertyNo">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_PropertyNo"><?php echo $rent_account_view->PropertyNo->caption() ?></span></td>
		<td data-name="PropertyNo" <?php echo $rent_account_view->PropertyNo->cellAttributes() ?>>
<span id="el_rent_account_PropertyNo">
<span<?php echo $rent_account_view->PropertyNo->viewAttributes() ?>><?php echo $rent_account_view->PropertyNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_ClientSerNo"><?php echo $rent_account_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $rent_account_view->ClientSerNo->cellAttributes() ?>>
<span id="el_rent_account_ClientSerNo">
<span<?php echo $rent_account_view->ClientSerNo->viewAttributes() ?>><?php echo $rent_account_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_ClientID"><?php echo $rent_account_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $rent_account_view->ClientID->cellAttributes() ?>>
<span id="el_rent_account_ClientID">
<span<?php echo $rent_account_view->ClientID->viewAttributes() ?>><?php echo $rent_account_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->ChargeCode->Visible) { // ChargeCode ?>
	<tr id="r_ChargeCode">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_ChargeCode"><?php echo $rent_account_view->ChargeCode->caption() ?></span></td>
		<td data-name="ChargeCode" <?php echo $rent_account_view->ChargeCode->cellAttributes() ?>>
<span id="el_rent_account_ChargeCode">
<span<?php echo $rent_account_view->ChargeCode->viewAttributes() ?>><?php echo $rent_account_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_ChargeGroup"><?php echo $rent_account_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $rent_account_view->ChargeGroup->cellAttributes() ?>>
<span id="el_rent_account_ChargeGroup">
<span<?php echo $rent_account_view->ChargeGroup->viewAttributes() ?>><?php echo $rent_account_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->Securitydeposit->Visible) { // Securitydeposit ?>
	<tr id="r_Securitydeposit">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_Securitydeposit"><?php echo $rent_account_view->Securitydeposit->caption() ?></span></td>
		<td data-name="Securitydeposit" <?php echo $rent_account_view->Securitydeposit->cellAttributes() ?>>
<span id="el_rent_account_Securitydeposit">
<span<?php echo $rent_account_view->Securitydeposit->viewAttributes() ?>><?php echo $rent_account_view->Securitydeposit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_BalanceBF"><?php echo $rent_account_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $rent_account_view->BalanceBF->cellAttributes() ?>>
<span id="el_rent_account_BalanceBF">
<span<?php echo $rent_account_view->BalanceBF->viewAttributes() ?>><?php echo $rent_account_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->CurrentDemand->Visible) { // CurrentDemand ?>
	<tr id="r_CurrentDemand">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_CurrentDemand"><?php echo $rent_account_view->CurrentDemand->caption() ?></span></td>
		<td data-name="CurrentDemand" <?php echo $rent_account_view->CurrentDemand->cellAttributes() ?>>
<span id="el_rent_account_CurrentDemand">
<span<?php echo $rent_account_view->CurrentDemand->viewAttributes() ?>><?php echo $rent_account_view->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->VAT->Visible) { // VAT ?>
	<tr id="r_VAT">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_VAT"><?php echo $rent_account_view->VAT->caption() ?></span></td>
		<td data-name="VAT" <?php echo $rent_account_view->VAT->cellAttributes() ?>>
<span id="el_rent_account_VAT">
<span<?php echo $rent_account_view->VAT->viewAttributes() ?>><?php echo $rent_account_view->VAT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_AmountPaid"><?php echo $rent_account_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $rent_account_view->AmountPaid->cellAttributes() ?>>
<span id="el_rent_account_AmountPaid">
<span<?php echo $rent_account_view->AmountPaid->viewAttributes() ?>><?php echo $rent_account_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->BillPeriod->Visible) { // BillPeriod ?>
	<tr id="r_BillPeriod">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_BillPeriod"><?php echo $rent_account_view->BillPeriod->caption() ?></span></td>
		<td data-name="BillPeriod" <?php echo $rent_account_view->BillPeriod->cellAttributes() ?>>
<span id="el_rent_account_BillPeriod">
<span<?php echo $rent_account_view->BillPeriod->viewAttributes() ?>><?php echo $rent_account_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->PeriodType->Visible) { // PeriodType ?>
	<tr id="r_PeriodType">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_PeriodType"><?php echo $rent_account_view->PeriodType->caption() ?></span></td>
		<td data-name="PeriodType" <?php echo $rent_account_view->PeriodType->cellAttributes() ?>>
<span id="el_rent_account_PeriodType">
<span<?php echo $rent_account_view->PeriodType->viewAttributes() ?>><?php echo $rent_account_view->PeriodType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_BillYear"><?php echo $rent_account_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $rent_account_view->BillYear->cellAttributes() ?>>
<span id="el_rent_account_BillYear">
<span<?php echo $rent_account_view->BillYear->viewAttributes() ?>><?php echo $rent_account_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_StartDate"><?php echo $rent_account_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $rent_account_view->StartDate->cellAttributes() ?>>
<span id="el_rent_account_StartDate">
<span<?php echo $rent_account_view->StartDate->viewAttributes() ?>><?php echo $rent_account_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_EndDate"><?php echo $rent_account_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $rent_account_view->EndDate->cellAttributes() ?>>
<span id="el_rent_account_EndDate">
<span<?php echo $rent_account_view->EndDate->viewAttributes() ?>><?php echo $rent_account_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->LeaseDesc->Visible) { // LeaseDesc ?>
	<tr id="r_LeaseDesc">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_LeaseDesc"><?php echo $rent_account_view->LeaseDesc->caption() ?></span></td>
		<td data-name="LeaseDesc" <?php echo $rent_account_view->LeaseDesc->cellAttributes() ?>>
<span id="el_rent_account_LeaseDesc">
<span<?php echo $rent_account_view->LeaseDesc->viewAttributes() ?>><?php echo $rent_account_view->LeaseDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->Rent->Visible) { // Rent ?>
	<tr id="r_Rent">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_Rent"><?php echo $rent_account_view->Rent->caption() ?></span></td>
		<td data-name="Rent" <?php echo $rent_account_view->Rent->cellAttributes() ?>>
<span id="el_rent_account_Rent">
<span<?php echo $rent_account_view->Rent->viewAttributes() ?>><?php echo $rent_account_view->Rent->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->Period_type->Visible) { // Period_type ?>
	<tr id="r_Period_type">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_Period_type"><?php echo $rent_account_view->Period_type->caption() ?></span></td>
		<td data-name="Period_type" <?php echo $rent_account_view->Period_type->cellAttributes() ?>>
<span id="el_rent_account_Period_type">
<span<?php echo $rent_account_view->Period_type->viewAttributes() ?>><?php echo $rent_account_view->Period_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<tr id="r_LastUpdatedBy">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_LastUpdatedBy"><?php echo $rent_account_view->LastUpdatedBy->caption() ?></span></td>
		<td data-name="LastUpdatedBy" <?php echo $rent_account_view->LastUpdatedBy->cellAttributes() ?>>
<span id="el_rent_account_LastUpdatedBy">
<span<?php echo $rent_account_view->LastUpdatedBy->viewAttributes() ?>><?php echo $rent_account_view->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rent_account_view->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<tr id="r_LastUpdateDate">
		<td class="<?php echo $rent_account_view->TableLeftColumnClass ?>"><span id="elh_rent_account_LastUpdateDate"><?php echo $rent_account_view->LastUpdateDate->caption() ?></span></td>
		<td data-name="LastUpdateDate" <?php echo $rent_account_view->LastUpdateDate->cellAttributes() ?>>
<span id="el_rent_account_LastUpdateDate">
<span<?php echo $rent_account_view->LastUpdateDate->viewAttributes() ?>><?php echo $rent_account_view->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rent_account_view->IsModal) { ?>
<?php if (!$rent_account_view->isExport()) { ?>
<?php echo $rent_account_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$rent_account_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rent_account_view->isExport()) { ?>
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
$rent_account_view->terminate();
?>