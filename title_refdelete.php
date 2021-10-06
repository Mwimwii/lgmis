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
$title_ref_delete = new title_ref_delete();

// Run the page
$title_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$title_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftitle_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftitle_refdelete = currentForm = new ew.Form("ftitle_refdelete", "delete");
	loadjs.done("ftitle_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $title_ref_delete->showPageHeader(); ?>
<?php
$title_ref_delete->showMessage();
?>
<form name="ftitle_refdelete" id="ftitle_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="title_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($title_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($title_ref_delete->Title->Visible) { // Title ?>
		<th class="<?php echo $title_ref_delete->Title->headerCellClass() ?>"><span id="elh_title_ref_Title" class="title_ref_Title"><?php echo $title_ref_delete->Title->caption() ?></span></th>
<?php } ?>
<?php if ($title_ref_delete->Sex->Visible) { // Sex ?>
		<th class="<?php echo $title_ref_delete->Sex->headerCellClass() ?>"><span id="elh_title_ref_Sex" class="title_ref_Sex"><?php echo $title_ref_delete->Sex->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$title_ref_delete->RecordCount = 0;
$i = 0;
while (!$title_ref_delete->Recordset->EOF) {
	$title_ref_delete->RecordCount++;
	$title_ref_delete->RowCount++;

	// Set row properties
	$title_ref->resetAttributes();
	$title_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$title_ref_delete->loadRowValues($title_ref_delete->Recordset);

	// Render row
	$title_ref_delete->renderRow();
?>
	<tr <?php echo $title_ref->rowAttributes() ?>>
<?php if ($title_ref_delete->Title->Visible) { // Title ?>
		<td <?php echo $title_ref_delete->Title->cellAttributes() ?>>
<span id="el<?php echo $title_ref_delete->RowCount ?>_title_ref_Title" class="title_ref_Title">
<span<?php echo $title_ref_delete->Title->viewAttributes() ?>><?php echo $title_ref_delete->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($title_ref_delete->Sex->Visible) { // Sex ?>
		<td <?php echo $title_ref_delete->Sex->cellAttributes() ?>>
<span id="el<?php echo $title_ref_delete->RowCount ?>_title_ref_Sex" class="title_ref_Sex">
<span<?php echo $title_ref_delete->Sex->viewAttributes() ?>><?php echo $title_ref_delete->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$title_ref_delete->Recordset->moveNext();
}
$title_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $title_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$title_ref_delete->showPageFooter();
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
$title_ref_delete->terminate();
?>