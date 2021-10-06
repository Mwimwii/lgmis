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
$grade_delete = new grade_delete();

// Run the page
$grade_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grade_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgradedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgradedelete = currentForm = new ew.Form("fgradedelete", "delete");
	loadjs.done("fgradedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $grade_delete->showPageHeader(); ?>
<?php
$grade_delete->showMessage();
?>
<form name="fgradedelete" id="fgradedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($grade_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($grade_delete->Grade->Visible) { // Grade ?>
		<th class="<?php echo $grade_delete->Grade->headerCellClass() ?>"><span id="elh_grade_Grade" class="grade_Grade"><?php echo $grade_delete->Grade->caption() ?></span></th>
<?php } ?>
<?php if ($grade_delete->GradeDesc->Visible) { // GradeDesc ?>
		<th class="<?php echo $grade_delete->GradeDesc->headerCellClass() ?>"><span id="elh_grade_GradeDesc" class="grade_GradeDesc"><?php echo $grade_delete->GradeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$grade_delete->RecordCount = 0;
$i = 0;
while (!$grade_delete->Recordset->EOF) {
	$grade_delete->RecordCount++;
	$grade_delete->RowCount++;

	// Set row properties
	$grade->resetAttributes();
	$grade->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$grade_delete->loadRowValues($grade_delete->Recordset);

	// Render row
	$grade_delete->renderRow();
?>
	<tr <?php echo $grade->rowAttributes() ?>>
<?php if ($grade_delete->Grade->Visible) { // Grade ?>
		<td <?php echo $grade_delete->Grade->cellAttributes() ?>>
<span id="el<?php echo $grade_delete->RowCount ?>_grade_Grade" class="grade_Grade">
<span<?php echo $grade_delete->Grade->viewAttributes() ?>><?php echo $grade_delete->Grade->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($grade_delete->GradeDesc->Visible) { // GradeDesc ?>
		<td <?php echo $grade_delete->GradeDesc->cellAttributes() ?>>
<span id="el<?php echo $grade_delete->RowCount ?>_grade_GradeDesc" class="grade_GradeDesc">
<span<?php echo $grade_delete->GradeDesc->viewAttributes() ?>><?php echo $grade_delete->GradeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$grade_delete->Recordset->moveNext();
}
$grade_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $grade_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$grade_delete->showPageFooter();
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
$grade_delete->terminate();
?>