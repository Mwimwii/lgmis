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
$bank_branch_delete = new bank_branch_delete();

// Run the page
$bank_branch_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_branch_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbank_branchdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbank_branchdelete = currentForm = new ew.Form("fbank_branchdelete", "delete");
	loadjs.done("fbank_branchdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bank_branch_delete->showPageHeader(); ?>
<?php
$bank_branch_delete->showMessage();
?>
<form name="fbank_branchdelete" id="fbank_branchdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank_branch">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bank_branch_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bank_branch_delete->BranchCode->Visible) { // BranchCode ?>
		<th class="<?php echo $bank_branch_delete->BranchCode->headerCellClass() ?>"><span id="elh_bank_branch_BranchCode" class="bank_branch_BranchCode"><?php echo $bank_branch_delete->BranchCode->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->BranchName->Visible) { // BranchName ?>
		<th class="<?php echo $bank_branch_delete->BranchName->headerCellClass() ?>"><span id="elh_bank_branch_BranchName" class="bank_branch_BranchName"><?php echo $bank_branch_delete->BranchName->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->BankCode->Visible) { // BankCode ?>
		<th class="<?php echo $bank_branch_delete->BankCode->headerCellClass() ?>"><span id="elh_bank_branch_BankCode" class="bank_branch_BankCode"><?php echo $bank_branch_delete->BankCode->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->AreaCode->Visible) { // AreaCode ?>
		<th class="<?php echo $bank_branch_delete->AreaCode->headerCellClass() ?>"><span id="elh_bank_branch_AreaCode" class="bank_branch_AreaCode"><?php echo $bank_branch_delete->AreaCode->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->BranchNo->Visible) { // BranchNo ?>
		<th class="<?php echo $bank_branch_delete->BranchNo->headerCellClass() ?>"><span id="elh_bank_branch_BranchNo" class="bank_branch_BranchNo"><?php echo $bank_branch_delete->BranchNo->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->BranchAddress->Visible) { // BranchAddress ?>
		<th class="<?php echo $bank_branch_delete->BranchAddress->headerCellClass() ?>"><span id="elh_bank_branch_BranchAddress" class="bank_branch_BranchAddress"><?php echo $bank_branch_delete->BranchAddress->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->BranchTel->Visible) { // BranchTel ?>
		<th class="<?php echo $bank_branch_delete->BranchTel->headerCellClass() ?>"><span id="elh_bank_branch_BranchTel" class="bank_branch_BranchTel"><?php echo $bank_branch_delete->BranchTel->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->BranchEmail->Visible) { // BranchEmail ?>
		<th class="<?php echo $bank_branch_delete->BranchEmail->headerCellClass() ?>"><span id="elh_bank_branch_BranchEmail" class="bank_branch_BranchEmail"><?php echo $bank_branch_delete->BranchEmail->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->BranchFax->Visible) { // BranchFax ?>
		<th class="<?php echo $bank_branch_delete->BranchFax->headerCellClass() ?>"><span id="elh_bank_branch_BranchFax" class="bank_branch_BranchFax"><?php echo $bank_branch_delete->BranchFax->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->SWIFT->Visible) { // SWIFT ?>
		<th class="<?php echo $bank_branch_delete->SWIFT->headerCellClass() ?>"><span id="elh_bank_branch_SWIFT" class="bank_branch_SWIFT"><?php echo $bank_branch_delete->SWIFT->caption() ?></span></th>
<?php } ?>
<?php if ($bank_branch_delete->IBAN->Visible) { // IBAN ?>
		<th class="<?php echo $bank_branch_delete->IBAN->headerCellClass() ?>"><span id="elh_bank_branch_IBAN" class="bank_branch_IBAN"><?php echo $bank_branch_delete->IBAN->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bank_branch_delete->RecordCount = 0;
$i = 0;
while (!$bank_branch_delete->Recordset->EOF) {
	$bank_branch_delete->RecordCount++;
	$bank_branch_delete->RowCount++;

	// Set row properties
	$bank_branch->resetAttributes();
	$bank_branch->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bank_branch_delete->loadRowValues($bank_branch_delete->Recordset);

	// Render row
	$bank_branch_delete->renderRow();
?>
	<tr <?php echo $bank_branch->rowAttributes() ?>>
<?php if ($bank_branch_delete->BranchCode->Visible) { // BranchCode ?>
		<td <?php echo $bank_branch_delete->BranchCode->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BranchCode" class="bank_branch_BranchCode">
<span<?php echo $bank_branch_delete->BranchCode->viewAttributes() ?>><?php echo $bank_branch_delete->BranchCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->BranchName->Visible) { // BranchName ?>
		<td <?php echo $bank_branch_delete->BranchName->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BranchName" class="bank_branch_BranchName">
<span<?php echo $bank_branch_delete->BranchName->viewAttributes() ?>><?php echo $bank_branch_delete->BranchName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->BankCode->Visible) { // BankCode ?>
		<td <?php echo $bank_branch_delete->BankCode->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BankCode" class="bank_branch_BankCode">
<span<?php echo $bank_branch_delete->BankCode->viewAttributes() ?>><?php echo $bank_branch_delete->BankCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->AreaCode->Visible) { // AreaCode ?>
		<td <?php echo $bank_branch_delete->AreaCode->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_AreaCode" class="bank_branch_AreaCode">
<span<?php echo $bank_branch_delete->AreaCode->viewAttributes() ?>><?php echo $bank_branch_delete->AreaCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->BranchNo->Visible) { // BranchNo ?>
		<td <?php echo $bank_branch_delete->BranchNo->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BranchNo" class="bank_branch_BranchNo">
<span<?php echo $bank_branch_delete->BranchNo->viewAttributes() ?>><?php echo $bank_branch_delete->BranchNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->BranchAddress->Visible) { // BranchAddress ?>
		<td <?php echo $bank_branch_delete->BranchAddress->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BranchAddress" class="bank_branch_BranchAddress">
<span<?php echo $bank_branch_delete->BranchAddress->viewAttributes() ?>><?php echo $bank_branch_delete->BranchAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->BranchTel->Visible) { // BranchTel ?>
		<td <?php echo $bank_branch_delete->BranchTel->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BranchTel" class="bank_branch_BranchTel">
<span<?php echo $bank_branch_delete->BranchTel->viewAttributes() ?>><?php echo $bank_branch_delete->BranchTel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->BranchEmail->Visible) { // BranchEmail ?>
		<td <?php echo $bank_branch_delete->BranchEmail->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BranchEmail" class="bank_branch_BranchEmail">
<span<?php echo $bank_branch_delete->BranchEmail->viewAttributes() ?>><?php echo $bank_branch_delete->BranchEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->BranchFax->Visible) { // BranchFax ?>
		<td <?php echo $bank_branch_delete->BranchFax->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_BranchFax" class="bank_branch_BranchFax">
<span<?php echo $bank_branch_delete->BranchFax->viewAttributes() ?>><?php echo $bank_branch_delete->BranchFax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->SWIFT->Visible) { // SWIFT ?>
		<td <?php echo $bank_branch_delete->SWIFT->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_SWIFT" class="bank_branch_SWIFT">
<span<?php echo $bank_branch_delete->SWIFT->viewAttributes() ?>><?php echo $bank_branch_delete->SWIFT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_branch_delete->IBAN->Visible) { // IBAN ?>
		<td <?php echo $bank_branch_delete->IBAN->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_delete->RowCount ?>_bank_branch_IBAN" class="bank_branch_IBAN">
<span<?php echo $bank_branch_delete->IBAN->viewAttributes() ?>><?php echo $bank_branch_delete->IBAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bank_branch_delete->Recordset->moveNext();
}
$bank_branch_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bank_branch_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bank_branch_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$bank_branch_delete->terminate();
?>