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
$country_delete = new country_delete();

// Run the page
$country_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcountrydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcountrydelete = currentForm = new ew.Form("fcountrydelete", "delete");
	loadjs.done("fcountrydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $country_delete->showPageHeader(); ?>
<?php
$country_delete->showMessage();
?>
<form name="fcountrydelete" id="fcountrydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($country_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($country_delete->CountryName->Visible) { // CountryName ?>
		<th class="<?php echo $country_delete->CountryName->headerCellClass() ?>"><span id="elh_country_CountryName" class="country_CountryName"><?php echo $country_delete->CountryName->caption() ?></span></th>
<?php } ?>
<?php if ($country_delete->CurrencyCode->Visible) { // CurrencyCode ?>
		<th class="<?php echo $country_delete->CurrencyCode->headerCellClass() ?>"><span id="elh_country_CurrencyCode" class="country_CurrencyCode"><?php echo $country_delete->CurrencyCode->caption() ?></span></th>
<?php } ?>
<?php if ($country_delete->ExchangeRate->Visible) { // ExchangeRate ?>
		<th class="<?php echo $country_delete->ExchangeRate->headerCellClass() ?>"><span id="elh_country_ExchangeRate" class="country_ExchangeRate"><?php echo $country_delete->ExchangeRate->caption() ?></span></th>
<?php } ?>
<?php if ($country_delete->CountryCode->Visible) { // CountryCode ?>
		<th class="<?php echo $country_delete->CountryCode->headerCellClass() ?>"><span id="elh_country_CountryCode" class="country_CountryCode"><?php echo $country_delete->CountryCode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$country_delete->RecordCount = 0;
$i = 0;
while (!$country_delete->Recordset->EOF) {
	$country_delete->RecordCount++;
	$country_delete->RowCount++;

	// Set row properties
	$country->resetAttributes();
	$country->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$country_delete->loadRowValues($country_delete->Recordset);

	// Render row
	$country_delete->renderRow();
?>
	<tr <?php echo $country->rowAttributes() ?>>
<?php if ($country_delete->CountryName->Visible) { // CountryName ?>
		<td <?php echo $country_delete->CountryName->cellAttributes() ?>>
<span id="el<?php echo $country_delete->RowCount ?>_country_CountryName" class="country_CountryName">
<span<?php echo $country_delete->CountryName->viewAttributes() ?>><?php echo $country_delete->CountryName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($country_delete->CurrencyCode->Visible) { // CurrencyCode ?>
		<td <?php echo $country_delete->CurrencyCode->cellAttributes() ?>>
<span id="el<?php echo $country_delete->RowCount ?>_country_CurrencyCode" class="country_CurrencyCode">
<span<?php echo $country_delete->CurrencyCode->viewAttributes() ?>><?php echo $country_delete->CurrencyCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($country_delete->ExchangeRate->Visible) { // ExchangeRate ?>
		<td <?php echo $country_delete->ExchangeRate->cellAttributes() ?>>
<span id="el<?php echo $country_delete->RowCount ?>_country_ExchangeRate" class="country_ExchangeRate">
<span<?php echo $country_delete->ExchangeRate->viewAttributes() ?>><?php echo $country_delete->ExchangeRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($country_delete->CountryCode->Visible) { // CountryCode ?>
		<td <?php echo $country_delete->CountryCode->cellAttributes() ?>>
<span id="el<?php echo $country_delete->RowCount ?>_country_CountryCode" class="country_CountryCode">
<span<?php echo $country_delete->CountryCode->viewAttributes() ?>><?php echo $country_delete->CountryCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$country_delete->Recordset->moveNext();
}
$country_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $country_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$country_delete->showPageFooter();
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
$country_delete->terminate();
?>