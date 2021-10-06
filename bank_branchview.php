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
$bank_branch_view = new bank_branch_view();

// Run the page
$bank_branch_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_branch_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bank_branch_view->isExport()) { ?>
<script>
var fbank_branchview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbank_branchview = currentForm = new ew.Form("fbank_branchview", "view");
	loadjs.done("fbank_branchview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bank_branch_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bank_branch_view->ExportOptions->render("body") ?>
<?php $bank_branch_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bank_branch_view->showPageHeader(); ?>
<?php
$bank_branch_view->showMessage();
?>
<?php if (!$bank_branch_view->IsModal) { ?>
<?php if (!$bank_branch_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bank_branch_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbank_branchview" id="fbank_branchview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank_branch">
<input type="hidden" name="modal" value="<?php echo (int)$bank_branch_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bank_branch_view->BranchCode->Visible) { // BranchCode ?>
	<tr id="r_BranchCode">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BranchCode"><?php echo $bank_branch_view->BranchCode->caption() ?></span></td>
		<td data-name="BranchCode" <?php echo $bank_branch_view->BranchCode->cellAttributes() ?>>
<span id="el_bank_branch_BranchCode">
<span<?php echo $bank_branch_view->BranchCode->viewAttributes() ?>><?php echo $bank_branch_view->BranchCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->BranchName->Visible) { // BranchName ?>
	<tr id="r_BranchName">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BranchName"><?php echo $bank_branch_view->BranchName->caption() ?></span></td>
		<td data-name="BranchName" <?php echo $bank_branch_view->BranchName->cellAttributes() ?>>
<span id="el_bank_branch_BranchName">
<span<?php echo $bank_branch_view->BranchName->viewAttributes() ?>><?php echo $bank_branch_view->BranchName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->BankCode->Visible) { // BankCode ?>
	<tr id="r_BankCode">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BankCode"><?php echo $bank_branch_view->BankCode->caption() ?></span></td>
		<td data-name="BankCode" <?php echo $bank_branch_view->BankCode->cellAttributes() ?>>
<span id="el_bank_branch_BankCode">
<span<?php echo $bank_branch_view->BankCode->viewAttributes() ?>><?php echo $bank_branch_view->BankCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->AreaCode->Visible) { // AreaCode ?>
	<tr id="r_AreaCode">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_AreaCode"><?php echo $bank_branch_view->AreaCode->caption() ?></span></td>
		<td data-name="AreaCode" <?php echo $bank_branch_view->AreaCode->cellAttributes() ?>>
<span id="el_bank_branch_AreaCode">
<span<?php echo $bank_branch_view->AreaCode->viewAttributes() ?>><?php echo $bank_branch_view->AreaCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->BranchNo->Visible) { // BranchNo ?>
	<tr id="r_BranchNo">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BranchNo"><?php echo $bank_branch_view->BranchNo->caption() ?></span></td>
		<td data-name="BranchNo" <?php echo $bank_branch_view->BranchNo->cellAttributes() ?>>
<span id="el_bank_branch_BranchNo">
<span<?php echo $bank_branch_view->BranchNo->viewAttributes() ?>><?php echo $bank_branch_view->BranchNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->BranchAddress->Visible) { // BranchAddress ?>
	<tr id="r_BranchAddress">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BranchAddress"><?php echo $bank_branch_view->BranchAddress->caption() ?></span></td>
		<td data-name="BranchAddress" <?php echo $bank_branch_view->BranchAddress->cellAttributes() ?>>
<span id="el_bank_branch_BranchAddress">
<span<?php echo $bank_branch_view->BranchAddress->viewAttributes() ?>><?php echo $bank_branch_view->BranchAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->BranchTel->Visible) { // BranchTel ?>
	<tr id="r_BranchTel">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BranchTel"><?php echo $bank_branch_view->BranchTel->caption() ?></span></td>
		<td data-name="BranchTel" <?php echo $bank_branch_view->BranchTel->cellAttributes() ?>>
<span id="el_bank_branch_BranchTel">
<span<?php echo $bank_branch_view->BranchTel->viewAttributes() ?>><?php echo $bank_branch_view->BranchTel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->BranchEmail->Visible) { // BranchEmail ?>
	<tr id="r_BranchEmail">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BranchEmail"><?php echo $bank_branch_view->BranchEmail->caption() ?></span></td>
		<td data-name="BranchEmail" <?php echo $bank_branch_view->BranchEmail->cellAttributes() ?>>
<span id="el_bank_branch_BranchEmail">
<span<?php echo $bank_branch_view->BranchEmail->viewAttributes() ?>><?php echo $bank_branch_view->BranchEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->BranchFax->Visible) { // BranchFax ?>
	<tr id="r_BranchFax">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_BranchFax"><?php echo $bank_branch_view->BranchFax->caption() ?></span></td>
		<td data-name="BranchFax" <?php echo $bank_branch_view->BranchFax->cellAttributes() ?>>
<span id="el_bank_branch_BranchFax">
<span<?php echo $bank_branch_view->BranchFax->viewAttributes() ?>><?php echo $bank_branch_view->BranchFax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->SWIFT->Visible) { // SWIFT ?>
	<tr id="r_SWIFT">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_SWIFT"><?php echo $bank_branch_view->SWIFT->caption() ?></span></td>
		<td data-name="SWIFT" <?php echo $bank_branch_view->SWIFT->cellAttributes() ?>>
<span id="el_bank_branch_SWIFT">
<span<?php echo $bank_branch_view->SWIFT->viewAttributes() ?>><?php echo $bank_branch_view->SWIFT->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_branch_view->IBAN->Visible) { // IBAN ?>
	<tr id="r_IBAN">
		<td class="<?php echo $bank_branch_view->TableLeftColumnClass ?>"><span id="elh_bank_branch_IBAN"><?php echo $bank_branch_view->IBAN->caption() ?></span></td>
		<td data-name="IBAN" <?php echo $bank_branch_view->IBAN->cellAttributes() ?>>
<span id="el_bank_branch_IBAN">
<span<?php echo $bank_branch_view->IBAN->viewAttributes() ?>><?php echo $bank_branch_view->IBAN->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$bank_branch_view->IsModal) { ?>
<?php if (!$bank_branch_view->isExport()) { ?>
<?php echo $bank_branch_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$bank_branch_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bank_branch_view->isExport()) { ?>
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
$bank_branch_view->terminate();
?>