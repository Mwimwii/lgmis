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
$bill_board_account_view = new bill_board_account_view();

// Run the page
$bill_board_account_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_account_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bill_board_account_view->isExport()) { ?>
<script>
var fbill_board_accountview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbill_board_accountview = currentForm = new ew.Form("fbill_board_accountview", "view");
	loadjs.done("fbill_board_accountview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bill_board_account_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bill_board_account_view->ExportOptions->render("body") ?>
<?php $bill_board_account_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bill_board_account_view->showPageHeader(); ?>
<?php
$bill_board_account_view->showMessage();
?>
<?php if (!$bill_board_account_view->IsModal) { ?>
<?php if (!$bill_board_account_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_account_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbill_board_accountview" id="fbill_board_accountview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board_account">
<input type="hidden" name="modal" value="<?php echo (int)$bill_board_account_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bill_board_account_view->AccountNo->Visible) { // AccountNo ?>
	<tr id="r_AccountNo">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_AccountNo"><?php echo $bill_board_account_view->AccountNo->caption() ?></span></td>
		<td data-name="AccountNo" <?php echo $bill_board_account_view->AccountNo->cellAttributes() ?>>
<span id="el_bill_board_account_AccountNo">
<span<?php echo $bill_board_account_view->AccountNo->viewAttributes() ?>><?php echo $bill_board_account_view->AccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->BillBoardNo->Visible) { // BillBoardNo ?>
	<tr id="r_BillBoardNo">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_BillBoardNo"><?php echo $bill_board_account_view->BillBoardNo->caption() ?></span></td>
		<td data-name="BillBoardNo" <?php echo $bill_board_account_view->BillBoardNo->cellAttributes() ?>>
<span id="el_bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_view->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_account_view->BillBoardNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_ClientID"><?php echo $bill_board_account_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $bill_board_account_view->ClientID->cellAttributes() ?>>
<span id="el_bill_board_account_ClientID">
<span<?php echo $bill_board_account_view->ClientID->viewAttributes() ?>><?php echo $bill_board_account_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_BalanceBF"><?php echo $bill_board_account_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $bill_board_account_view->BalanceBF->cellAttributes() ?>>
<span id="el_bill_board_account_BalanceBF">
<span<?php echo $bill_board_account_view->BalanceBF->viewAttributes() ?>><?php echo $bill_board_account_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->CurrentDemand->Visible) { // CurrentDemand ?>
	<tr id="r_CurrentDemand">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_CurrentDemand"><?php echo $bill_board_account_view->CurrentDemand->caption() ?></span></td>
		<td data-name="CurrentDemand" <?php echo $bill_board_account_view->CurrentDemand->cellAttributes() ?>>
<span id="el_bill_board_account_CurrentDemand">
<span<?php echo $bill_board_account_view->CurrentDemand->viewAttributes() ?>><?php echo $bill_board_account_view->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->VAT->Visible) { // VAT ?>
	<tr id="r_VAT">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_VAT"><?php echo $bill_board_account_view->VAT->caption() ?></span></td>
		<td data-name="VAT" <?php echo $bill_board_account_view->VAT->cellAttributes() ?>>
<span id="el_bill_board_account_VAT">
<span<?php echo $bill_board_account_view->VAT->viewAttributes() ?>><?php echo $bill_board_account_view->VAT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_AmountPaid"><?php echo $bill_board_account_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $bill_board_account_view->AmountPaid->cellAttributes() ?>>
<span id="el_bill_board_account_AmountPaid">
<span<?php echo $bill_board_account_view->AmountPaid->viewAttributes() ?>><?php echo $bill_board_account_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->BillPeriod->Visible) { // BillPeriod ?>
	<tr id="r_BillPeriod">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_BillPeriod"><?php echo $bill_board_account_view->BillPeriod->caption() ?></span></td>
		<td data-name="BillPeriod" <?php echo $bill_board_account_view->BillPeriod->cellAttributes() ?>>
<span id="el_bill_board_account_BillPeriod">
<span<?php echo $bill_board_account_view->BillPeriod->viewAttributes() ?>><?php echo $bill_board_account_view->BillPeriod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->PeriodType->Visible) { // PeriodType ?>
	<tr id="r_PeriodType">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_PeriodType"><?php echo $bill_board_account_view->PeriodType->caption() ?></span></td>
		<td data-name="PeriodType" <?php echo $bill_board_account_view->PeriodType->cellAttributes() ?>>
<span id="el_bill_board_account_PeriodType">
<span<?php echo $bill_board_account_view->PeriodType->viewAttributes() ?>><?php echo $bill_board_account_view->PeriodType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_BillYear"><?php echo $bill_board_account_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $bill_board_account_view->BillYear->cellAttributes() ?>>
<span id="el_bill_board_account_BillYear">
<span<?php echo $bill_board_account_view->BillYear->viewAttributes() ?>><?php echo $bill_board_account_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_StartDate"><?php echo $bill_board_account_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $bill_board_account_view->StartDate->cellAttributes() ?>>
<span id="el_bill_board_account_StartDate">
<span<?php echo $bill_board_account_view->StartDate->viewAttributes() ?>><?php echo $bill_board_account_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_EndDate"><?php echo $bill_board_account_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $bill_board_account_view->EndDate->cellAttributes() ?>>
<span id="el_bill_board_account_EndDate">
<span<?php echo $bill_board_account_view->EndDate->viewAttributes() ?>><?php echo $bill_board_account_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_account_view->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<tr id="r_LastUpdatedBy">
		<td class="<?php echo $bill_board_account_view->TableLeftColumnClass ?>"><span id="elh_bill_board_account_LastUpdatedBy"><?php echo $bill_board_account_view->LastUpdatedBy->caption() ?></span></td>
		<td data-name="LastUpdatedBy" <?php echo $bill_board_account_view->LastUpdatedBy->cellAttributes() ?>>
<span id="el_bill_board_account_LastUpdatedBy">
<span<?php echo $bill_board_account_view->LastUpdatedBy->viewAttributes() ?>><?php echo $bill_board_account_view->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$bill_board_account_view->IsModal) { ?>
<?php if (!$bill_board_account_view->isExport()) { ?>
<?php echo $bill_board_account_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$bill_board_account_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bill_board_account_view->isExport()) { ?>
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
$bill_board_account_view->terminate();
?>