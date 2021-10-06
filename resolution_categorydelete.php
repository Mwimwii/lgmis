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
$resolution_category_delete = new resolution_category_delete();

// Run the page
$resolution_category_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$resolution_category_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresolution_categorydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fresolution_categorydelete = currentForm = new ew.Form("fresolution_categorydelete", "delete");
	loadjs.done("fresolution_categorydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $resolution_category_delete->showPageHeader(); ?>
<?php
$resolution_category_delete->showMessage();
?>
<form name="fresolution_categorydelete" id="fresolution_categorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="resolution_category">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($resolution_category_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($resolution_category_delete->ResolutionCategoryCode->Visible) { // ResolutionCategoryCode ?>
		<th class="<?php echo $resolution_category_delete->ResolutionCategoryCode->headerCellClass() ?>"><span id="elh_resolution_category_ResolutionCategoryCode" class="resolution_category_ResolutionCategoryCode"><?php echo $resolution_category_delete->ResolutionCategoryCode->caption() ?></span></th>
<?php } ?>
<?php if ($resolution_category_delete->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
		<th class="<?php echo $resolution_category_delete->ResolutionCategoryName->headerCellClass() ?>"><span id="elh_resolution_category_ResolutionCategoryName" class="resolution_category_ResolutionCategoryName"><?php echo $resolution_category_delete->ResolutionCategoryName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$resolution_category_delete->RecordCount = 0;
$i = 0;
while (!$resolution_category_delete->Recordset->EOF) {
	$resolution_category_delete->RecordCount++;
	$resolution_category_delete->RowCount++;

	// Set row properties
	$resolution_category->resetAttributes();
	$resolution_category->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$resolution_category_delete->loadRowValues($resolution_category_delete->Recordset);

	// Render row
	$resolution_category_delete->renderRow();
?>
	<tr <?php echo $resolution_category->rowAttributes() ?>>
<?php if ($resolution_category_delete->ResolutionCategoryCode->Visible) { // ResolutionCategoryCode ?>
		<td <?php echo $resolution_category_delete->ResolutionCategoryCode->cellAttributes() ?>>
<span id="el<?php echo $resolution_category_delete->RowCount ?>_resolution_category_ResolutionCategoryCode" class="resolution_category_ResolutionCategoryCode">
<span<?php echo $resolution_category_delete->ResolutionCategoryCode->viewAttributes() ?>><?php echo $resolution_category_delete->ResolutionCategoryCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($resolution_category_delete->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
		<td <?php echo $resolution_category_delete->ResolutionCategoryName->cellAttributes() ?>>
<span id="el<?php echo $resolution_category_delete->RowCount ?>_resolution_category_ResolutionCategoryName" class="resolution_category_ResolutionCategoryName">
<span<?php echo $resolution_category_delete->ResolutionCategoryName->viewAttributes() ?>><?php echo $resolution_category_delete->ResolutionCategoryName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$resolution_category_delete->Recordset->moveNext();
}
$resolution_category_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $resolution_category_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$resolution_category_delete->showPageFooter();
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
$resolution_category_delete->terminate();
?>