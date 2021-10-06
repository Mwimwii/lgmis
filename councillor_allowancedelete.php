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
$councillor_allowance_delete = new councillor_allowance_delete();

// Run the page
$councillor_allowance_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_allowance_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillor_allowancedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncillor_allowancedelete = currentForm = new ew.Form("fcouncillor_allowancedelete", "delete");
	loadjs.done("fcouncillor_allowancedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_allowance_delete->showPageHeader(); ?>
<?php
$councillor_allowance_delete->showMessage();
?>
<form name="fcouncillor_allowancedelete" id="fcouncillor_allowancedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_allowance">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($councillor_allowance_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($councillor_allowance_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $councillor_allowance_delete->EmployeeID->headerCellClass() ?>"><span id="elh_councillor_allowance_EmployeeID" class="councillor_allowance_EmployeeID"><?php echo $councillor_allowance_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_allowance_delete->AllowanceCode->Visible) { // AllowanceCode ?>
		<th class="<?php echo $councillor_allowance_delete->AllowanceCode->headerCellClass() ?>"><span id="elh_councillor_allowance_AllowanceCode" class="councillor_allowance_AllowanceCode"><?php echo $councillor_allowance_delete->AllowanceCode->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_allowance_delete->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<th class="<?php echo $councillor_allowance_delete->AllowanceAmount->headerCellClass() ?>"><span id="elh_councillor_allowance_AllowanceAmount" class="councillor_allowance_AllowanceAmount"><?php echo $councillor_allowance_delete->AllowanceAmount->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$councillor_allowance_delete->RecordCount = 0;
$i = 0;
while (!$councillor_allowance_delete->Recordset->EOF) {
	$councillor_allowance_delete->RecordCount++;
	$councillor_allowance_delete->RowCount++;

	// Set row properties
	$councillor_allowance->resetAttributes();
	$councillor_allowance->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$councillor_allowance_delete->loadRowValues($councillor_allowance_delete->Recordset);

	// Render row
	$councillor_allowance_delete->renderRow();
?>
	<tr <?php echo $councillor_allowance->rowAttributes() ?>>
<?php if ($councillor_allowance_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $councillor_allowance_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $councillor_allowance_delete->RowCount ?>_councillor_allowance_EmployeeID" class="councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_delete->EmployeeID->viewAttributes() ?>><?php echo $councillor_allowance_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_allowance_delete->AllowanceCode->Visible) { // AllowanceCode ?>
		<td <?php echo $councillor_allowance_delete->AllowanceCode->cellAttributes() ?>>
<span id="el<?php echo $councillor_allowance_delete->RowCount ?>_councillor_allowance_AllowanceCode" class="councillor_allowance_AllowanceCode">
<span<?php echo $councillor_allowance_delete->AllowanceCode->viewAttributes() ?>><?php echo $councillor_allowance_delete->AllowanceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_allowance_delete->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<td <?php echo $councillor_allowance_delete->AllowanceAmount->cellAttributes() ?>>
<span id="el<?php echo $councillor_allowance_delete->RowCount ?>_councillor_allowance_AllowanceAmount" class="councillor_allowance_AllowanceAmount">
<span<?php echo $councillor_allowance_delete->AllowanceAmount->viewAttributes() ?>><?php echo $councillor_allowance_delete->AllowanceAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$councillor_allowance_delete->Recordset->moveNext();
}
$councillor_allowance_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_allowance_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$councillor_allowance_delete->showPageFooter();
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
$councillor_allowance_delete->terminate();
?>