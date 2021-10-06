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
$la_bank_account_delete = new la_bank_account_delete();

// Run the page
$la_bank_account_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_bank_accountdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fla_bank_accountdelete = currentForm = new ew.Form("fla_bank_accountdelete", "delete");
	loadjs.done("fla_bank_accountdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_bank_account_delete->showPageHeader(); ?>
<?php
$la_bank_account_delete->showMessage();
?>
<form name="fla_bank_accountdelete" id="fla_bank_accountdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_bank_account">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($la_bank_account_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($la_bank_account_delete->BankCode->Visible) { // BankCode ?>
		<th class="<?php echo $la_bank_account_delete->BankCode->headerCellClass() ?>"><span id="elh_la_bank_account_BankCode" class="la_bank_account_BankCode"><?php echo $la_bank_account_delete->BankCode->caption() ?></span></th>
<?php } ?>
<?php if ($la_bank_account_delete->BranchCode->Visible) { // BranchCode ?>
		<th class="<?php echo $la_bank_account_delete->BranchCode->headerCellClass() ?>"><span id="elh_la_bank_account_BranchCode" class="la_bank_account_BranchCode"><?php echo $la_bank_account_delete->BranchCode->caption() ?></span></th>
<?php } ?>
<?php if ($la_bank_account_delete->AccountName->Visible) { // AccountName ?>
		<th class="<?php echo $la_bank_account_delete->AccountName->headerCellClass() ?>"><span id="elh_la_bank_account_AccountName" class="la_bank_account_AccountName"><?php echo $la_bank_account_delete->AccountName->caption() ?></span></th>
<?php } ?>
<?php if ($la_bank_account_delete->BankAccountNo->Visible) { // BankAccountNo ?>
		<th class="<?php echo $la_bank_account_delete->BankAccountNo->headerCellClass() ?>"><span id="elh_la_bank_account_BankAccountNo" class="la_bank_account_BankAccountNo"><?php echo $la_bank_account_delete->BankAccountNo->caption() ?></span></th>
<?php } ?>
<?php if ($la_bank_account_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $la_bank_account_delete->LACode->headerCellClass() ?>"><span id="elh_la_bank_account_LACode" class="la_bank_account_LACode"><?php echo $la_bank_account_delete->LACode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$la_bank_account_delete->RecordCount = 0;
$i = 0;
while (!$la_bank_account_delete->Recordset->EOF) {
	$la_bank_account_delete->RecordCount++;
	$la_bank_account_delete->RowCount++;

	// Set row properties
	$la_bank_account->resetAttributes();
	$la_bank_account->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$la_bank_account_delete->loadRowValues($la_bank_account_delete->Recordset);

	// Render row
	$la_bank_account_delete->renderRow();
?>
	<tr <?php echo $la_bank_account->rowAttributes() ?>>
<?php if ($la_bank_account_delete->BankCode->Visible) { // BankCode ?>
		<td <?php echo $la_bank_account_delete->BankCode->cellAttributes() ?>>
<span id="el<?php echo $la_bank_account_delete->RowCount ?>_la_bank_account_BankCode" class="la_bank_account_BankCode">
<span<?php echo $la_bank_account_delete->BankCode->viewAttributes() ?>><?php echo $la_bank_account_delete->BankCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_bank_account_delete->BranchCode->Visible) { // BranchCode ?>
		<td <?php echo $la_bank_account_delete->BranchCode->cellAttributes() ?>>
<span id="el<?php echo $la_bank_account_delete->RowCount ?>_la_bank_account_BranchCode" class="la_bank_account_BranchCode">
<span<?php echo $la_bank_account_delete->BranchCode->viewAttributes() ?>><?php echo $la_bank_account_delete->BranchCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_bank_account_delete->AccountName->Visible) { // AccountName ?>
		<td <?php echo $la_bank_account_delete->AccountName->cellAttributes() ?>>
<span id="el<?php echo $la_bank_account_delete->RowCount ?>_la_bank_account_AccountName" class="la_bank_account_AccountName">
<span<?php echo $la_bank_account_delete->AccountName->viewAttributes() ?>><?php echo $la_bank_account_delete->AccountName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_bank_account_delete->BankAccountNo->Visible) { // BankAccountNo ?>
		<td <?php echo $la_bank_account_delete->BankAccountNo->cellAttributes() ?>>
<span id="el<?php echo $la_bank_account_delete->RowCount ?>_la_bank_account_BankAccountNo" class="la_bank_account_BankAccountNo">
<span<?php echo $la_bank_account_delete->BankAccountNo->viewAttributes() ?>><?php echo $la_bank_account_delete->BankAccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($la_bank_account_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $la_bank_account_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $la_bank_account_delete->RowCount ?>_la_bank_account_LACode" class="la_bank_account_LACode">
<span<?php echo $la_bank_account_delete->LACode->viewAttributes() ?>><?php echo $la_bank_account_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$la_bank_account_delete->Recordset->moveNext();
}
$la_bank_account_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $la_bank_account_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$la_bank_account_delete->showPageFooter();
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
$la_bank_account_delete->terminate();
?>