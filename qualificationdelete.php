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
$qualification_delete = new qualification_delete();

// Run the page
$qualification_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualification_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fqualificationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fqualificationdelete = currentForm = new ew.Form("fqualificationdelete", "delete");
	loadjs.done("fqualificationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $qualification_delete->showPageHeader(); ?>
<?php
$qualification_delete->showMessage();
?>
<form name="fqualificationdelete" id="fqualificationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualification">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($qualification_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($qualification_delete->QualificationCode->Visible) { // QualificationCode ?>
		<th class="<?php echo $qualification_delete->QualificationCode->headerCellClass() ?>"><span id="elh_qualification_QualificationCode" class="qualification_QualificationCode"><?php echo $qualification_delete->QualificationCode->caption() ?></span></th>
<?php } ?>
<?php if ($qualification_delete->QualificationName->Visible) { // QualificationName ?>
		<th class="<?php echo $qualification_delete->QualificationName->headerCellClass() ?>"><span id="elh_qualification_QualificationName" class="qualification_QualificationName"><?php echo $qualification_delete->QualificationName->caption() ?></span></th>
<?php } ?>
<?php if ($qualification_delete->QualificationType->Visible) { // QualificationType ?>
		<th class="<?php echo $qualification_delete->QualificationType->headerCellClass() ?>"><span id="elh_qualification_QualificationType" class="qualification_QualificationType"><?php echo $qualification_delete->QualificationType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$qualification_delete->RecordCount = 0;
$i = 0;
while (!$qualification_delete->Recordset->EOF) {
	$qualification_delete->RecordCount++;
	$qualification_delete->RowCount++;

	// Set row properties
	$qualification->resetAttributes();
	$qualification->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$qualification_delete->loadRowValues($qualification_delete->Recordset);

	// Render row
	$qualification_delete->renderRow();
?>
	<tr <?php echo $qualification->rowAttributes() ?>>
<?php if ($qualification_delete->QualificationCode->Visible) { // QualificationCode ?>
		<td <?php echo $qualification_delete->QualificationCode->cellAttributes() ?>>
<span id="el<?php echo $qualification_delete->RowCount ?>_qualification_QualificationCode" class="qualification_QualificationCode">
<span<?php echo $qualification_delete->QualificationCode->viewAttributes() ?>><?php echo $qualification_delete->QualificationCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($qualification_delete->QualificationName->Visible) { // QualificationName ?>
		<td <?php echo $qualification_delete->QualificationName->cellAttributes() ?>>
<span id="el<?php echo $qualification_delete->RowCount ?>_qualification_QualificationName" class="qualification_QualificationName">
<span<?php echo $qualification_delete->QualificationName->viewAttributes() ?>><?php echo $qualification_delete->QualificationName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($qualification_delete->QualificationType->Visible) { // QualificationType ?>
		<td <?php echo $qualification_delete->QualificationType->cellAttributes() ?>>
<span id="el<?php echo $qualification_delete->RowCount ?>_qualification_QualificationType" class="qualification_QualificationType">
<span<?php echo $qualification_delete->QualificationType->viewAttributes() ?>><?php echo $qualification_delete->QualificationType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$qualification_delete->Recordset->moveNext();
}
$qualification_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $qualification_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$qualification_delete->showPageFooter();
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
$qualification_delete->terminate();
?>