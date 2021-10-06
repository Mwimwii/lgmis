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
$offense_category_delete = new offense_category_delete();

// Run the page
$offense_category_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_category_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foffense_categorydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	foffense_categorydelete = currentForm = new ew.Form("foffense_categorydelete", "delete");
	loadjs.done("foffense_categorydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $offense_category_delete->showPageHeader(); ?>
<?php
$offense_category_delete->showMessage();
?>
<form name="foffense_categorydelete" id="foffense_categorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_category">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($offense_category_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($offense_category_delete->OffenseCategory->Visible) { // OffenseCategory ?>
		<th class="<?php echo $offense_category_delete->OffenseCategory->headerCellClass() ?>"><span id="elh_offense_category_OffenseCategory" class="offense_category_OffenseCategory"><?php echo $offense_category_delete->OffenseCategory->caption() ?></span></th>
<?php } ?>
<?php if ($offense_category_delete->OffenseCategoryName->Visible) { // OffenseCategoryName ?>
		<th class="<?php echo $offense_category_delete->OffenseCategoryName->headerCellClass() ?>"><span id="elh_offense_category_OffenseCategoryName" class="offense_category_OffenseCategoryName"><?php echo $offense_category_delete->OffenseCategoryName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$offense_category_delete->RecordCount = 0;
$i = 0;
while (!$offense_category_delete->Recordset->EOF) {
	$offense_category_delete->RecordCount++;
	$offense_category_delete->RowCount++;

	// Set row properties
	$offense_category->resetAttributes();
	$offense_category->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$offense_category_delete->loadRowValues($offense_category_delete->Recordset);

	// Render row
	$offense_category_delete->renderRow();
?>
	<tr <?php echo $offense_category->rowAttributes() ?>>
<?php if ($offense_category_delete->OffenseCategory->Visible) { // OffenseCategory ?>
		<td <?php echo $offense_category_delete->OffenseCategory->cellAttributes() ?>>
<span id="el<?php echo $offense_category_delete->RowCount ?>_offense_category_OffenseCategory" class="offense_category_OffenseCategory">
<span<?php echo $offense_category_delete->OffenseCategory->viewAttributes() ?>><?php echo $offense_category_delete->OffenseCategory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($offense_category_delete->OffenseCategoryName->Visible) { // OffenseCategoryName ?>
		<td <?php echo $offense_category_delete->OffenseCategoryName->cellAttributes() ?>>
<span id="el<?php echo $offense_category_delete->RowCount ?>_offense_category_OffenseCategoryName" class="offense_category_OffenseCategoryName">
<span<?php echo $offense_category_delete->OffenseCategoryName->viewAttributes() ?>><?php echo $offense_category_delete->OffenseCategoryName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$offense_category_delete->Recordset->moveNext();
}
$offense_category_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $offense_category_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$offense_category_delete->showPageFooter();
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
$offense_category_delete->terminate();
?>