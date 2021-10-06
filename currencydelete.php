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
$currency_delete = new currency_delete();

// Run the page
$currency_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$currency_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcurrencydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcurrencydelete = currentForm = new ew.Form("fcurrencydelete", "delete");
	loadjs.done("fcurrencydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $currency_delete->showPageHeader(); ?>
<?php
$currency_delete->showMessage();
?>
<form name="fcurrencydelete" id="fcurrencydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="currency">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($currency_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($currency_delete->CurrencyCode->Visible) { // CurrencyCode ?>
		<th class="<?php echo $currency_delete->CurrencyCode->headerCellClass() ?>"><span id="elh_currency_CurrencyCode" class="currency_CurrencyCode"><?php echo $currency_delete->CurrencyCode->caption() ?></span></th>
<?php } ?>
<?php if ($currency_delete->CurrencyName->Visible) { // CurrencyName ?>
		<th class="<?php echo $currency_delete->CurrencyName->headerCellClass() ?>"><span id="elh_currency_CurrencyName" class="currency_CurrencyName"><?php echo $currency_delete->CurrencyName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$currency_delete->RecordCount = 0;
$i = 0;
while (!$currency_delete->Recordset->EOF) {
	$currency_delete->RecordCount++;
	$currency_delete->RowCount++;

	// Set row properties
	$currency->resetAttributes();
	$currency->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$currency_delete->loadRowValues($currency_delete->Recordset);

	// Render row
	$currency_delete->renderRow();
?>
	<tr <?php echo $currency->rowAttributes() ?>>
<?php if ($currency_delete->CurrencyCode->Visible) { // CurrencyCode ?>
		<td <?php echo $currency_delete->CurrencyCode->cellAttributes() ?>>
<span id="el<?php echo $currency_delete->RowCount ?>_currency_CurrencyCode" class="currency_CurrencyCode">
<span<?php echo $currency_delete->CurrencyCode->viewAttributes() ?>><?php echo $currency_delete->CurrencyCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($currency_delete->CurrencyName->Visible) { // CurrencyName ?>
		<td <?php echo $currency_delete->CurrencyName->cellAttributes() ?>>
<span id="el<?php echo $currency_delete->RowCount ?>_currency_CurrencyName" class="currency_CurrencyName">
<span<?php echo $currency_delete->CurrencyName->viewAttributes() ?>><?php echo $currency_delete->CurrencyName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$currency_delete->Recordset->moveNext();
}
$currency_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $currency_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$currency_delete->showPageFooter();
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
$currency_delete->terminate();
?>