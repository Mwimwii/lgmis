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
$contract_status_view = new contract_status_view();

// Run the page
$contract_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_status_view->isExport()) { ?>
<script>
var fcontract_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcontract_statusview = currentForm = new ew.Form("fcontract_statusview", "view");
	loadjs.done("fcontract_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contract_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contract_status_view->ExportOptions->render("body") ?>
<?php $contract_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contract_status_view->showPageHeader(); ?>
<?php
$contract_status_view->showMessage();
?>
<?php if (!$contract_status_view->IsModal) { ?>
<?php if (!$contract_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcontract_statusview" id="fcontract_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_status">
<input type="hidden" name="modal" value="<?php echo (int)$contract_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contract_status_view->ContractStatus->Visible) { // ContractStatus ?>
	<tr id="r_ContractStatus">
		<td class="<?php echo $contract_status_view->TableLeftColumnClass ?>"><span id="elh_contract_status_ContractStatus"><?php echo $contract_status_view->ContractStatus->caption() ?></span></td>
		<td data-name="ContractStatus" <?php echo $contract_status_view->ContractStatus->cellAttributes() ?>>
<span id="el_contract_status_ContractStatus">
<span<?php echo $contract_status_view->ContractStatus->viewAttributes() ?>><?php echo $contract_status_view->ContractStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_status_view->ContractStatusDesc->Visible) { // ContractStatusDesc ?>
	<tr id="r_ContractStatusDesc">
		<td class="<?php echo $contract_status_view->TableLeftColumnClass ?>"><span id="elh_contract_status_ContractStatusDesc"><?php echo $contract_status_view->ContractStatusDesc->caption() ?></span></td>
		<td data-name="ContractStatusDesc" <?php echo $contract_status_view->ContractStatusDesc->cellAttributes() ?>>
<span id="el_contract_status_ContractStatusDesc">
<span<?php echo $contract_status_view->ContractStatusDesc->viewAttributes() ?>><?php echo $contract_status_view->ContractStatusDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$contract_status_view->IsModal) { ?>
<?php if (!$contract_status_view->isExport()) { ?>
<?php echo $contract_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$contract_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_status_view->isExport()) { ?>
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
$contract_status_view->terminate();
?>