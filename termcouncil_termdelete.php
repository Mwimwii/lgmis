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
$termcouncil_term_delete = new termcouncil_term_delete();

// Run the page
$termcouncil_term_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$termcouncil_term_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftermcouncil_termdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftermcouncil_termdelete = currentForm = new ew.Form("ftermcouncil_termdelete", "delete");
	loadjs.done("ftermcouncil_termdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $termcouncil_term_delete->showPageHeader(); ?>
<?php
$termcouncil_term_delete->showMessage();
?>
<form name="ftermcouncil_termdelete" id="ftermcouncil_termdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="termcouncil_term">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($termcouncil_term_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($termcouncil_term_delete->TermStartYear->Visible) { // TermStartYear ?>
		<th class="<?php echo $termcouncil_term_delete->TermStartYear->headerCellClass() ?>"><span id="elh_termcouncil_term_TermStartYear" class="termcouncil_term_TermStartYear"><?php echo $termcouncil_term_delete->TermStartYear->caption() ?></span></th>
<?php } ?>
<?php if ($termcouncil_term_delete->TermYears->Visible) { // TermYears ?>
		<th class="<?php echo $termcouncil_term_delete->TermYears->headerCellClass() ?>"><span id="elh_termcouncil_term_TermYears" class="termcouncil_term_TermYears"><?php echo $termcouncil_term_delete->TermYears->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$termcouncil_term_delete->RecordCount = 0;
$i = 0;
while (!$termcouncil_term_delete->Recordset->EOF) {
	$termcouncil_term_delete->RecordCount++;
	$termcouncil_term_delete->RowCount++;

	// Set row properties
	$termcouncil_term->resetAttributes();
	$termcouncil_term->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$termcouncil_term_delete->loadRowValues($termcouncil_term_delete->Recordset);

	// Render row
	$termcouncil_term_delete->renderRow();
?>
	<tr <?php echo $termcouncil_term->rowAttributes() ?>>
<?php if ($termcouncil_term_delete->TermStartYear->Visible) { // TermStartYear ?>
		<td <?php echo $termcouncil_term_delete->TermStartYear->cellAttributes() ?>>
<span id="el<?php echo $termcouncil_term_delete->RowCount ?>_termcouncil_term_TermStartYear" class="termcouncil_term_TermStartYear">
<span<?php echo $termcouncil_term_delete->TermStartYear->viewAttributes() ?>><?php echo $termcouncil_term_delete->TermStartYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($termcouncil_term_delete->TermYears->Visible) { // TermYears ?>
		<td <?php echo $termcouncil_term_delete->TermYears->cellAttributes() ?>>
<span id="el<?php echo $termcouncil_term_delete->RowCount ?>_termcouncil_term_TermYears" class="termcouncil_term_TermYears">
<span<?php echo $termcouncil_term_delete->TermYears->viewAttributes() ?>><?php echo $termcouncil_term_delete->TermYears->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$termcouncil_term_delete->Recordset->moveNext();
}
$termcouncil_term_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $termcouncil_term_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$termcouncil_term_delete->showPageFooter();
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
$termcouncil_term_delete->terminate();
?>