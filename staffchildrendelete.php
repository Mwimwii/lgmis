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
$staffchildren_delete = new staffchildren_delete();

// Run the page
$staffchildren_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffchildren_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffchildrendelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffchildrendelete = currentForm = new ew.Form("fstaffchildrendelete", "delete");
	loadjs.done("fstaffchildrendelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffchildren_delete->showPageHeader(); ?>
<?php
$staffchildren_delete->showMessage();
?>
<form name="fstaffchildrendelete" id="fstaffchildrendelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffchildren">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffchildren_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffchildren_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $staffchildren_delete->FirstName->headerCellClass() ?>"><span id="elh_staffchildren_FirstName" class="staffchildren_FirstName"><?php echo $staffchildren_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($staffchildren_delete->MiddleName->Visible) { // MiddleName ?>
		<th class="<?php echo $staffchildren_delete->MiddleName->headerCellClass() ?>"><span id="elh_staffchildren_MiddleName" class="staffchildren_MiddleName"><?php echo $staffchildren_delete->MiddleName->caption() ?></span></th>
<?php } ?>
<?php if ($staffchildren_delete->Surname->Visible) { // Surname ?>
		<th class="<?php echo $staffchildren_delete->Surname->headerCellClass() ?>"><span id="elh_staffchildren_Surname" class="staffchildren_Surname"><?php echo $staffchildren_delete->Surname->caption() ?></span></th>
<?php } ?>
<?php if ($staffchildren_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<th class="<?php echo $staffchildren_delete->DateOfBirth->headerCellClass() ?>"><span id="elh_staffchildren_DateOfBirth" class="staffchildren_DateOfBirth"><?php echo $staffchildren_delete->DateOfBirth->caption() ?></span></th>
<?php } ?>
<?php if ($staffchildren_delete->Sex->Visible) { // Sex ?>
		<th class="<?php echo $staffchildren_delete->Sex->headerCellClass() ?>"><span id="elh_staffchildren_Sex" class="staffchildren_Sex"><?php echo $staffchildren_delete->Sex->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffchildren_delete->RecordCount = 0;
$i = 0;
while (!$staffchildren_delete->Recordset->EOF) {
	$staffchildren_delete->RecordCount++;
	$staffchildren_delete->RowCount++;

	// Set row properties
	$staffchildren->resetAttributes();
	$staffchildren->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffchildren_delete->loadRowValues($staffchildren_delete->Recordset);

	// Render row
	$staffchildren_delete->renderRow();
?>
	<tr <?php echo $staffchildren->rowAttributes() ?>>
<?php if ($staffchildren_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $staffchildren_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $staffchildren_delete->RowCount ?>_staffchildren_FirstName" class="staffchildren_FirstName">
<span<?php echo $staffchildren_delete->FirstName->viewAttributes() ?>><?php echo $staffchildren_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffchildren_delete->MiddleName->Visible) { // MiddleName ?>
		<td <?php echo $staffchildren_delete->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $staffchildren_delete->RowCount ?>_staffchildren_MiddleName" class="staffchildren_MiddleName">
<span<?php echo $staffchildren_delete->MiddleName->viewAttributes() ?>><?php echo $staffchildren_delete->MiddleName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffchildren_delete->Surname->Visible) { // Surname ?>
		<td <?php echo $staffchildren_delete->Surname->cellAttributes() ?>>
<span id="el<?php echo $staffchildren_delete->RowCount ?>_staffchildren_Surname" class="staffchildren_Surname">
<span<?php echo $staffchildren_delete->Surname->viewAttributes() ?>><?php echo $staffchildren_delete->Surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffchildren_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<td <?php echo $staffchildren_delete->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $staffchildren_delete->RowCount ?>_staffchildren_DateOfBirth" class="staffchildren_DateOfBirth">
<span<?php echo $staffchildren_delete->DateOfBirth->viewAttributes() ?>><?php echo $staffchildren_delete->DateOfBirth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffchildren_delete->Sex->Visible) { // Sex ?>
		<td <?php echo $staffchildren_delete->Sex->cellAttributes() ?>>
<span id="el<?php echo $staffchildren_delete->RowCount ?>_staffchildren_Sex" class="staffchildren_Sex">
<span<?php echo $staffchildren_delete->Sex->viewAttributes() ?>><?php echo $staffchildren_delete->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffchildren_delete->Recordset->moveNext();
}
$staffchildren_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffchildren_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffchildren_delete->showPageFooter();
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
$staffchildren_delete->terminate();
?>