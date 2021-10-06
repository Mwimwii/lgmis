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
$contract_variation_view = new contract_variation_view();

// Run the page
$contract_variation_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_variation_view->isExport()) { ?>
<script>
var fcontract_variationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcontract_variationview = currentForm = new ew.Form("fcontract_variationview", "view");
	loadjs.done("fcontract_variationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contract_variation_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contract_variation_view->ExportOptions->render("body") ?>
<?php $contract_variation_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contract_variation_view->showPageHeader(); ?>
<?php
$contract_variation_view->showMessage();
?>
<?php if (!$contract_variation_view->IsModal) { ?>
<?php if (!$contract_variation_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_variation_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcontract_variationview" id="fcontract_variationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_variation">
<input type="hidden" name="modal" value="<?php echo (int)$contract_variation_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contract_variation_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_LACode"><?php echo $contract_variation_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $contract_variation_view->LACode->cellAttributes() ?>>
<span id="el_contract_variation_LACode">
<span<?php echo $contract_variation_view->LACode->viewAttributes() ?>><?php echo $contract_variation_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_variation_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_DepartmentCode"><?php echo $contract_variation_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $contract_variation_view->DepartmentCode->cellAttributes() ?>>
<span id="el_contract_variation_DepartmentCode">
<span<?php echo $contract_variation_view->DepartmentCode->viewAttributes() ?>><?php echo $contract_variation_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_variation_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_SectionCode"><?php echo $contract_variation_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $contract_variation_view->SectionCode->cellAttributes() ?>>
<span id="el_contract_variation_SectionCode">
<span<?php echo $contract_variation_view->SectionCode->viewAttributes() ?>><?php echo $contract_variation_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_variation_view->ContractNo->Visible) { // ContractNo ?>
	<tr id="r_ContractNo">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_ContractNo"><?php echo $contract_variation_view->ContractNo->caption() ?></span></td>
		<td data-name="ContractNo" <?php echo $contract_variation_view->ContractNo->cellAttributes() ?>>
<span id="el_contract_variation_ContractNo">
<span<?php echo $contract_variation_view->ContractNo->viewAttributes() ?>><?php echo $contract_variation_view->ContractNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_variation_view->VariationAmount->Visible) { // VariationAmount ?>
	<tr id="r_VariationAmount">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_VariationAmount"><?php echo $contract_variation_view->VariationAmount->caption() ?></span></td>
		<td data-name="VariationAmount" <?php echo $contract_variation_view->VariationAmount->cellAttributes() ?>>
<span id="el_contract_variation_VariationAmount">
<span<?php echo $contract_variation_view->VariationAmount->viewAttributes() ?>><?php echo $contract_variation_view->VariationAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_variation_view->VariationNo->Visible) { // VariationNo ?>
	<tr id="r_VariationNo">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_VariationNo"><?php echo $contract_variation_view->VariationNo->caption() ?></span></td>
		<td data-name="VariationNo" <?php echo $contract_variation_view->VariationNo->cellAttributes() ?>>
<span id="el_contract_variation_VariationNo">
<span<?php echo $contract_variation_view->VariationNo->viewAttributes() ?>><?php echo $contract_variation_view->VariationNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_variation_view->VariationDate->Visible) { // VariationDate ?>
	<tr id="r_VariationDate">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_VariationDate"><?php echo $contract_variation_view->VariationDate->caption() ?></span></td>
		<td data-name="VariationDate" <?php echo $contract_variation_view->VariationDate->cellAttributes() ?>>
<span id="el_contract_variation_VariationDate">
<span<?php echo $contract_variation_view->VariationDate->viewAttributes() ?>><?php echo $contract_variation_view->VariationDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_variation_view->VariationJustification->Visible) { // VariationJustification ?>
	<tr id="r_VariationJustification">
		<td class="<?php echo $contract_variation_view->TableLeftColumnClass ?>"><span id="elh_contract_variation_VariationJustification"><?php echo $contract_variation_view->VariationJustification->caption() ?></span></td>
		<td data-name="VariationJustification" <?php echo $contract_variation_view->VariationJustification->cellAttributes() ?>>
<span id="el_contract_variation_VariationJustification">
<span<?php echo $contract_variation_view->VariationJustification->viewAttributes() ?>><?php echo $contract_variation_view->VariationJustification->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$contract_variation_view->IsModal) { ?>
<?php if (!$contract_variation_view->isExport()) { ?>
<?php echo $contract_variation_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$contract_variation_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_variation_view->isExport()) { ?>
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
$contract_variation_view->terminate();
?>