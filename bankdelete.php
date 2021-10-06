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
$bank_delete = new bank_delete();

// Run the page
$bank_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbankdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbankdelete = currentForm = new ew.Form("fbankdelete", "delete");
	loadjs.done("fbankdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bank_delete->showPageHeader(); ?>
<?php
$bank_delete->showMessage();
?>
<form name="fbankdelete" id="fbankdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bank_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bank_delete->BankCode->Visible) { // BankCode ?>
		<th class="<?php echo $bank_delete->BankCode->headerCellClass() ?>"><span id="elh_bank_BankCode" class="bank_BankCode"><?php echo $bank_delete->BankCode->caption() ?></span></th>
<?php } ?>
<?php if ($bank_delete->BankShortName->Visible) { // BankShortName ?>
		<th class="<?php echo $bank_delete->BankShortName->headerCellClass() ?>"><span id="elh_bank_BankShortName" class="bank_BankShortName"><?php echo $bank_delete->BankShortName->caption() ?></span></th>
<?php } ?>
<?php if ($bank_delete->BankName->Visible) { // BankName ?>
		<th class="<?php echo $bank_delete->BankName->headerCellClass() ?>"><span id="elh_bank_BankName" class="bank_BankName"><?php echo $bank_delete->BankName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bank_delete->RecordCount = 0;
$i = 0;
while (!$bank_delete->Recordset->EOF) {
	$bank_delete->RecordCount++;
	$bank_delete->RowCount++;

	// Set row properties
	$bank->resetAttributes();
	$bank->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bank_delete->loadRowValues($bank_delete->Recordset);

	// Render row
	$bank_delete->renderRow();
?>
	<tr <?php echo $bank->rowAttributes() ?>>
<?php if ($bank_delete->BankCode->Visible) { // BankCode ?>
		<td <?php echo $bank_delete->BankCode->cellAttributes() ?>>
<span id="el<?php echo $bank_delete->RowCount ?>_bank_BankCode" class="bank_BankCode">
<span<?php echo $bank_delete->BankCode->viewAttributes() ?>><?php echo $bank_delete->BankCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_delete->BankShortName->Visible) { // BankShortName ?>
		<td <?php echo $bank_delete->BankShortName->cellAttributes() ?>>
<span id="el<?php echo $bank_delete->RowCount ?>_bank_BankShortName" class="bank_BankShortName">
<span<?php echo $bank_delete->BankShortName->viewAttributes() ?>><?php echo $bank_delete->BankShortName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bank_delete->BankName->Visible) { // BankName ?>
		<td <?php echo $bank_delete->BankName->cellAttributes() ?>>
<span id="el<?php echo $bank_delete->RowCount ?>_bank_BankName" class="bank_BankName">
<span<?php echo $bank_delete->BankName->viewAttributes() ?>><?php echo $bank_delete->BankName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bank_delete->Recordset->moveNext();
}
$bank_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bank_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bank_delete->showPageFooter();
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
$bank_delete->terminate();
?>