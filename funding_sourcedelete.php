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
$funding_source_delete = new funding_source_delete();

// Run the page
$funding_source_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$funding_source_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffunding_sourcedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ffunding_sourcedelete = currentForm = new ew.Form("ffunding_sourcedelete", "delete");
	loadjs.done("ffunding_sourcedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $funding_source_delete->showPageHeader(); ?>
<?php
$funding_source_delete->showMessage();
?>
<form name="ffunding_sourcedelete" id="ffunding_sourcedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="funding_source">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($funding_source_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($funding_source_delete->FundingSource->Visible) { // FundingSource ?>
		<th class="<?php echo $funding_source_delete->FundingSource->headerCellClass() ?>"><span id="elh_funding_source_FundingSource" class="funding_source_FundingSource"><?php echo $funding_source_delete->FundingSource->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$funding_source_delete->RecordCount = 0;
$i = 0;
while (!$funding_source_delete->Recordset->EOF) {
	$funding_source_delete->RecordCount++;
	$funding_source_delete->RowCount++;

	// Set row properties
	$funding_source->resetAttributes();
	$funding_source->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$funding_source_delete->loadRowValues($funding_source_delete->Recordset);

	// Render row
	$funding_source_delete->renderRow();
?>
	<tr <?php echo $funding_source->rowAttributes() ?>>
<?php if ($funding_source_delete->FundingSource->Visible) { // FundingSource ?>
		<td <?php echo $funding_source_delete->FundingSource->cellAttributes() ?>>
<span id="el<?php echo $funding_source_delete->RowCount ?>_funding_source_FundingSource" class="funding_source_FundingSource">
<span<?php echo $funding_source_delete->FundingSource->viewAttributes() ?>><?php echo $funding_source_delete->FundingSource->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$funding_source_delete->Recordset->moveNext();
}
$funding_source_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $funding_source_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$funding_source_delete->showPageFooter();
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
$funding_source_delete->terminate();
?>