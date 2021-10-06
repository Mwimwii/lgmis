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
$bill_board_view = new bill_board_view();

// Run the page
$bill_board_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bill_board_view->isExport()) { ?>
<script>
var fbill_boardview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbill_boardview = currentForm = new ew.Form("fbill_boardview", "view");
	loadjs.done("fbill_boardview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bill_board_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bill_board_view->ExportOptions->render("body") ?>
<?php $bill_board_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bill_board_view->showPageHeader(); ?>
<?php
$bill_board_view->showMessage();
?>
<?php if (!$bill_board_view->IsModal) { ?>
<?php if (!$bill_board_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbill_boardview" id="fbill_boardview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board">
<input type="hidden" name="modal" value="<?php echo (int)$bill_board_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bill_board_view->BillBoardNo->Visible) { // BillBoardNo ?>
	<tr id="r_BillBoardNo">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BillBoardNo"><?php echo $bill_board_view->BillBoardNo->caption() ?></span></td>
		<td data-name="BillBoardNo" <?php echo $bill_board_view->BillBoardNo->cellAttributes() ?>>
<span id="el_bill_board_BillBoardNo">
<span<?php echo $bill_board_view->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_view->BillBoardNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->BoardStandNo->Visible) { // BoardStandNo ?>
	<tr id="r_BoardStandNo">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BoardStandNo"><?php echo $bill_board_view->BoardStandNo->caption() ?></span></td>
		<td data-name="BoardStandNo" <?php echo $bill_board_view->BoardStandNo->cellAttributes() ?>>
<span id="el_bill_board_BoardStandNo">
<span<?php echo $bill_board_view->BoardStandNo->viewAttributes() ?>><?php echo $bill_board_view->BoardStandNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->ClientSerNo->Visible) { // ClientSerNo ?>
	<tr id="r_ClientSerNo">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_ClientSerNo"><?php echo $bill_board_view->ClientSerNo->caption() ?></span></td>
		<td data-name="ClientSerNo" <?php echo $bill_board_view->ClientSerNo->cellAttributes() ?>>
<span id="el_bill_board_ClientSerNo">
<span<?php echo $bill_board_view->ClientSerNo->viewAttributes() ?>><?php echo $bill_board_view->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_ClientID"><?php echo $bill_board_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $bill_board_view->ClientID->cellAttributes() ?>>
<span id="el_bill_board_ClientID">
<span<?php echo $bill_board_view->ClientID->viewAttributes() ?>><?php echo $bill_board_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->BoardLength->Visible) { // BoardLength ?>
	<tr id="r_BoardLength">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BoardLength"><?php echo $bill_board_view->BoardLength->caption() ?></span></td>
		<td data-name="BoardLength" <?php echo $bill_board_view->BoardLength->cellAttributes() ?>>
<span id="el_bill_board_BoardLength">
<span<?php echo $bill_board_view->BoardLength->viewAttributes() ?>><?php echo $bill_board_view->BoardLength->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->BoardWidth->Visible) { // BoardWidth ?>
	<tr id="r_BoardWidth">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BoardWidth"><?php echo $bill_board_view->BoardWidth->caption() ?></span></td>
		<td data-name="BoardWidth" <?php echo $bill_board_view->BoardWidth->cellAttributes() ?>>
<span id="el_bill_board_BoardWidth">
<span<?php echo $bill_board_view->BoardWidth->viewAttributes() ?>><?php echo $bill_board_view->BoardWidth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->BoardSize->Visible) { // BoardSize ?>
	<tr id="r_BoardSize">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BoardSize"><?php echo $bill_board_view->BoardSize->caption() ?></span></td>
		<td data-name="BoardSize" <?php echo $bill_board_view->BoardSize->cellAttributes() ?>>
<span id="el_bill_board_BoardSize">
<span<?php echo $bill_board_view->BoardSize->viewAttributes() ?>><?php echo $bill_board_view->BoardSize->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->BoardType->Visible) { // BoardType ?>
	<tr id="r_BoardType">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BoardType"><?php echo $bill_board_view->BoardType->caption() ?></span></td>
		<td data-name="BoardType" <?php echo $bill_board_view->BoardType->cellAttributes() ?>>
<span id="el_bill_board_BoardType">
<span<?php echo $bill_board_view->BoardType->viewAttributes() ?>><?php echo $bill_board_view->BoardType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->BoardLocation->Visible) { // BoardLocation ?>
	<tr id="r_BoardLocation">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BoardLocation"><?php echo $bill_board_view->BoardLocation->caption() ?></span></td>
		<td data-name="BoardLocation" <?php echo $bill_board_view->BoardLocation->cellAttributes() ?>>
<span id="el_bill_board_BoardLocation">
<span<?php echo $bill_board_view->BoardLocation->viewAttributes() ?>><?php echo $bill_board_view->BoardLocation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->BoardStatus->Visible) { // BoardStatus ?>
	<tr id="r_BoardStatus">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_BoardStatus"><?php echo $bill_board_view->BoardStatus->caption() ?></span></td>
		<td data-name="BoardStatus" <?php echo $bill_board_view->BoardStatus->cellAttributes() ?>>
<span id="el_bill_board_BoardStatus">
<span<?php echo $bill_board_view->BoardStatus->viewAttributes() ?>><?php echo $bill_board_view->BoardStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->ExemptCode->Visible) { // ExemptCode ?>
	<tr id="r_ExemptCode">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_ExemptCode"><?php echo $bill_board_view->ExemptCode->caption() ?></span></td>
		<td data-name="ExemptCode" <?php echo $bill_board_view->ExemptCode->cellAttributes() ?>>
<span id="el_bill_board_ExemptCode">
<span<?php echo $bill_board_view->ExemptCode->viewAttributes() ?>><?php echo $bill_board_view->ExemptCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->StreetAddress->Visible) { // StreetAddress ?>
	<tr id="r_StreetAddress">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_StreetAddress"><?php echo $bill_board_view->StreetAddress->caption() ?></span></td>
		<td data-name="StreetAddress" <?php echo $bill_board_view->StreetAddress->cellAttributes() ?>>
<span id="el_bill_board_StreetAddress">
<span<?php echo $bill_board_view->StreetAddress->viewAttributes() ?>><?php echo $bill_board_view->StreetAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->Longitude->Visible) { // Longitude ?>
	<tr id="r_Longitude">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_Longitude"><?php echo $bill_board_view->Longitude->caption() ?></span></td>
		<td data-name="Longitude" <?php echo $bill_board_view->Longitude->cellAttributes() ?>>
<span id="el_bill_board_Longitude">
<span<?php echo $bill_board_view->Longitude->viewAttributes() ?>><?php echo $bill_board_view->Longitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->Latitude->Visible) { // Latitude ?>
	<tr id="r_Latitude">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_Latitude"><?php echo $bill_board_view->Latitude->caption() ?></span></td>
		<td data-name="Latitude" <?php echo $bill_board_view->Latitude->cellAttributes() ?>>
<span id="el_bill_board_Latitude">
<span<?php echo $bill_board_view->Latitude->viewAttributes() ?>><?php echo $bill_board_view->Latitude->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->Incumberance->Visible) { // Incumberance ?>
	<tr id="r_Incumberance">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_Incumberance"><?php echo $bill_board_view->Incumberance->caption() ?></span></td>
		<td data-name="Incumberance" <?php echo $bill_board_view->Incumberance->cellAttributes() ?>>
<span id="el_bill_board_Incumberance">
<span<?php echo $bill_board_view->Incumberance->viewAttributes() ?>><?php echo $bill_board_view->Incumberance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_StartDate"><?php echo $bill_board_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $bill_board_view->StartDate->cellAttributes() ?>>
<span id="el_bill_board_StartDate">
<span<?php echo $bill_board_view->StartDate->viewAttributes() ?>><?php echo $bill_board_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bill_board_view->EndDate->Visible) { // EndDate ?>
	<tr id="r_EndDate">
		<td class="<?php echo $bill_board_view->TableLeftColumnClass ?>"><span id="elh_bill_board_EndDate"><?php echo $bill_board_view->EndDate->caption() ?></span></td>
		<td data-name="EndDate" <?php echo $bill_board_view->EndDate->cellAttributes() ?>>
<span id="el_bill_board_EndDate">
<span<?php echo $bill_board_view->EndDate->viewAttributes() ?>><?php echo $bill_board_view->EndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$bill_board_view->IsModal) { ?>
<?php if (!$bill_board_view->isExport()) { ?>
<?php echo $bill_board_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("bill_board_account", explode(",", $bill_board->getCurrentDetailTable())) && $bill_board_account->DetailView) {
?>
<?php if ($bill_board->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("bill_board_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "bill_board_accountgrid.php" ?>
<?php } ?>
</form>
<?php
$bill_board_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bill_board_view->isExport()) { ?>
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
$bill_board_view->terminate();
?>