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
$province_delete = new province_delete();

// Run the page
$province_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$province_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprovincedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprovincedelete = currentForm = new ew.Form("fprovincedelete", "delete");
	loadjs.done("fprovincedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $province_delete->showPageHeader(); ?>
<?php
$province_delete->showMessage();
?>
<form name="fprovincedelete" id="fprovincedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="province">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($province_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($province_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $province_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_province_ProvinceCode" class="province_ProvinceCode"><?php echo $province_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($province_delete->ProvinceName->Visible) { // ProvinceName ?>
		<th class="<?php echo $province_delete->ProvinceName->headerCellClass() ?>"><span id="elh_province_ProvinceName" class="province_ProvinceName"><?php echo $province_delete->ProvinceName->caption() ?></span></th>
<?php } ?>
<?php if ($province_delete->Comment->Visible) { // Comment ?>
		<th class="<?php echo $province_delete->Comment->headerCellClass() ?>"><span id="elh_province_Comment" class="province_Comment"><?php echo $province_delete->Comment->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$province_delete->RecordCount = 0;
$i = 0;
while (!$province_delete->Recordset->EOF) {
	$province_delete->RecordCount++;
	$province_delete->RowCount++;

	// Set row properties
	$province->resetAttributes();
	$province->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$province_delete->loadRowValues($province_delete->Recordset);

	// Render row
	$province_delete->renderRow();
?>
	<tr <?php echo $province->rowAttributes() ?>>
<?php if ($province_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $province_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $province_delete->RowCount ?>_province_ProvinceCode" class="province_ProvinceCode">
<span<?php echo $province_delete->ProvinceCode->viewAttributes() ?>><?php echo $province_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($province_delete->ProvinceName->Visible) { // ProvinceName ?>
		<td <?php echo $province_delete->ProvinceName->cellAttributes() ?>>
<span id="el<?php echo $province_delete->RowCount ?>_province_ProvinceName" class="province_ProvinceName">
<span<?php echo $province_delete->ProvinceName->viewAttributes() ?>><?php echo $province_delete->ProvinceName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($province_delete->Comment->Visible) { // Comment ?>
		<td <?php echo $province_delete->Comment->cellAttributes() ?>>
<span id="el<?php echo $province_delete->RowCount ?>_province_Comment" class="province_Comment">
<span<?php echo $province_delete->Comment->viewAttributes() ?>><?php echo $province_delete->Comment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$province_delete->Recordset->moveNext();
}
$province_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $province_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$province_delete->showPageFooter();
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
$province_delete->terminate();
?>