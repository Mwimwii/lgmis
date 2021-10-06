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
$charge_type_view = new charge_type_view();

// Run the page
$charge_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charge_type_view->isExport()) { ?>
<script>
var fcharge_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcharge_typeview = currentForm = new ew.Form("fcharge_typeview", "view");
	loadjs.done("fcharge_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$charge_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $charge_type_view->ExportOptions->render("body") ?>
<?php $charge_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $charge_type_view->showPageHeader(); ?>
<?php
$charge_type_view->showMessage();
?>
<?php if (!$charge_type_view->IsModal) { ?>
<?php if (!$charge_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcharge_typeview" id="fcharge_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_type">
<input type="hidden" name="modal" value="<?php echo (int)$charge_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($charge_type_view->ChargeType->Visible) { // ChargeType ?>
	<tr id="r_ChargeType">
		<td class="<?php echo $charge_type_view->TableLeftColumnClass ?>"><span id="elh_charge_type_ChargeType"><?php echo $charge_type_view->ChargeType->caption() ?></span></td>
		<td data-name="ChargeType" <?php echo $charge_type_view->ChargeType->cellAttributes() ?>>
<span id="el_charge_type_ChargeType">
<span<?php echo $charge_type_view->ChargeType->viewAttributes() ?>><?php echo $charge_type_view->ChargeType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charge_type_view->ChargeTypeDesc->Visible) { // ChargeTypeDesc ?>
	<tr id="r_ChargeTypeDesc">
		<td class="<?php echo $charge_type_view->TableLeftColumnClass ?>"><span id="elh_charge_type_ChargeTypeDesc"><?php echo $charge_type_view->ChargeTypeDesc->caption() ?></span></td>
		<td data-name="ChargeTypeDesc" <?php echo $charge_type_view->ChargeTypeDesc->cellAttributes() ?>>
<span id="el_charge_type_ChargeTypeDesc">
<span<?php echo $charge_type_view->ChargeTypeDesc->viewAttributes() ?>><?php echo $charge_type_view->ChargeTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charge_type_view->IncomeType->Visible) { // IncomeType ?>
	<tr id="r_IncomeType">
		<td class="<?php echo $charge_type_view->TableLeftColumnClass ?>"><span id="elh_charge_type_IncomeType"><?php echo $charge_type_view->IncomeType->caption() ?></span></td>
		<td data-name="IncomeType" <?php echo $charge_type_view->IncomeType->cellAttributes() ?>>
<span id="el_charge_type_IncomeType">
<span<?php echo $charge_type_view->IncomeType->viewAttributes() ?>><?php echo $charge_type_view->IncomeType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charge_type_view->BankCode->Visible) { // BankCode ?>
	<tr id="r_BankCode">
		<td class="<?php echo $charge_type_view->TableLeftColumnClass ?>"><span id="elh_charge_type_BankCode"><?php echo $charge_type_view->BankCode->caption() ?></span></td>
		<td data-name="BankCode" <?php echo $charge_type_view->BankCode->cellAttributes() ?>>
<span id="el_charge_type_BankCode">
<span<?php echo $charge_type_view->BankCode->viewAttributes() ?>><?php echo $charge_type_view->BankCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charge_type_view->BankAccount->Visible) { // BankAccount ?>
	<tr id="r_BankAccount">
		<td class="<?php echo $charge_type_view->TableLeftColumnClass ?>"><span id="elh_charge_type_BankAccount"><?php echo $charge_type_view->BankAccount->caption() ?></span></td>
		<td data-name="BankAccount" <?php echo $charge_type_view->BankAccount->cellAttributes() ?>>
<span id="el_charge_type_BankAccount">
<span<?php echo $charge_type_view->BankAccount->viewAttributes() ?>><?php echo $charge_type_view->BankAccount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$charge_type_view->IsModal) { ?>
<?php if (!$charge_type_view->isExport()) { ?>
<?php echo $charge_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$charge_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charge_type_view->isExport()) { ?>
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
$charge_type_view->terminate();
?>