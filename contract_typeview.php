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
$contract_type_view = new contract_type_view();

// Run the page
$contract_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_type_view->isExport()) { ?>
<script>
var fcontract_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcontract_typeview = currentForm = new ew.Form("fcontract_typeview", "view");
	loadjs.done("fcontract_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contract_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contract_type_view->ExportOptions->render("body") ?>
<?php $contract_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contract_type_view->showPageHeader(); ?>
<?php
$contract_type_view->showMessage();
?>
<?php if (!$contract_type_view->IsModal) { ?>
<?php if (!$contract_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcontract_typeview" id="fcontract_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_type">
<input type="hidden" name="modal" value="<?php echo (int)$contract_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contract_type_view->ContractType->Visible) { // ContractType ?>
	<tr id="r_ContractType">
		<td class="<?php echo $contract_type_view->TableLeftColumnClass ?>"><span id="elh_contract_type_ContractType"><?php echo $contract_type_view->ContractType->caption() ?></span></td>
		<td data-name="ContractType" <?php echo $contract_type_view->ContractType->cellAttributes() ?>>
<span id="el_contract_type_ContractType">
<span<?php echo $contract_type_view->ContractType->viewAttributes() ?>><?php echo $contract_type_view->ContractType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_type_view->ContractTypeDesc->Visible) { // ContractTypeDesc ?>
	<tr id="r_ContractTypeDesc">
		<td class="<?php echo $contract_type_view->TableLeftColumnClass ?>"><span id="elh_contract_type_ContractTypeDesc"><?php echo $contract_type_view->ContractTypeDesc->caption() ?></span></td>
		<td data-name="ContractTypeDesc" <?php echo $contract_type_view->ContractTypeDesc->cellAttributes() ?>>
<span id="el_contract_type_ContractTypeDesc">
<span<?php echo $contract_type_view->ContractTypeDesc->viewAttributes() ?>><?php echo $contract_type_view->ContractTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$contract_type_view->IsModal) { ?>
<?php if (!$contract_type_view->isExport()) { ?>
<?php echo $contract_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$contract_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_type_view->isExport()) { ?>
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
$contract_type_view->terminate();
?>