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
$yesno_delete = new yesno_delete();

// Run the page
$yesno_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$yesno_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fyesnodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fyesnodelete = currentForm = new ew.Form("fyesnodelete", "delete");
	loadjs.done("fyesnodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $yesno_delete->showPageHeader(); ?>
<?php
$yesno_delete->showMessage();
?>
<form name="fyesnodelete" id="fyesnodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="yesno">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($yesno_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($yesno_delete->ChoiceCode->Visible) { // ChoiceCode ?>
		<th class="<?php echo $yesno_delete->ChoiceCode->headerCellClass() ?>"><span id="elh_yesno_ChoiceCode" class="yesno_ChoiceCode"><?php echo $yesno_delete->ChoiceCode->caption() ?></span></th>
<?php } ?>
<?php if ($yesno_delete->YesNo->Visible) { // YesNo ?>
		<th class="<?php echo $yesno_delete->YesNo->headerCellClass() ?>"><span id="elh_yesno_YesNo" class="yesno_YesNo"><?php echo $yesno_delete->YesNo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$yesno_delete->RecordCount = 0;
$i = 0;
while (!$yesno_delete->Recordset->EOF) {
	$yesno_delete->RecordCount++;
	$yesno_delete->RowCount++;

	// Set row properties
	$yesno->resetAttributes();
	$yesno->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$yesno_delete->loadRowValues($yesno_delete->Recordset);

	// Render row
	$yesno_delete->renderRow();
?>
	<tr <?php echo $yesno->rowAttributes() ?>>
<?php if ($yesno_delete->ChoiceCode->Visible) { // ChoiceCode ?>
		<td <?php echo $yesno_delete->ChoiceCode->cellAttributes() ?>>
<span id="el<?php echo $yesno_delete->RowCount ?>_yesno_ChoiceCode" class="yesno_ChoiceCode">
<span<?php echo $yesno_delete->ChoiceCode->viewAttributes() ?>><?php echo $yesno_delete->ChoiceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($yesno_delete->YesNo->Visible) { // YesNo ?>
		<td <?php echo $yesno_delete->YesNo->cellAttributes() ?>>
<span id="el<?php echo $yesno_delete->RowCount ?>_yesno_YesNo" class="yesno_YesNo">
<span<?php echo $yesno_delete->YesNo->viewAttributes() ?>><?php echo $yesno_delete->YesNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$yesno_delete->Recordset->moveNext();
}
$yesno_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $yesno_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$yesno_delete->showPageFooter();
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
$yesno_delete->terminate();
?>