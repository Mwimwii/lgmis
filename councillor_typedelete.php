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
$councillor_type_delete = new councillor_type_delete();

// Run the page
$councillor_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillor_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncillor_typedelete = currentForm = new ew.Form("fcouncillor_typedelete", "delete");
	loadjs.done("fcouncillor_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_type_delete->showPageHeader(); ?>
<?php
$councillor_type_delete->showMessage();
?>
<form name="fcouncillor_typedelete" id="fcouncillor_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($councillor_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($councillor_type_delete->CouncillorType->Visible) { // CouncillorType ?>
		<th class="<?php echo $councillor_type_delete->CouncillorType->headerCellClass() ?>"><span id="elh_councillor_type_CouncillorType" class="councillor_type_CouncillorType"><?php echo $councillor_type_delete->CouncillorType->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_type_delete->CouncillorTYpeName->Visible) { // CouncillorTYpeName ?>
		<th class="<?php echo $councillor_type_delete->CouncillorTYpeName->headerCellClass() ?>"><span id="elh_councillor_type_CouncillorTYpeName" class="councillor_type_CouncillorTYpeName"><?php echo $councillor_type_delete->CouncillorTYpeName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$councillor_type_delete->RecordCount = 0;
$i = 0;
while (!$councillor_type_delete->Recordset->EOF) {
	$councillor_type_delete->RecordCount++;
	$councillor_type_delete->RowCount++;

	// Set row properties
	$councillor_type->resetAttributes();
	$councillor_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$councillor_type_delete->loadRowValues($councillor_type_delete->Recordset);

	// Render row
	$councillor_type_delete->renderRow();
?>
	<tr <?php echo $councillor_type->rowAttributes() ?>>
<?php if ($councillor_type_delete->CouncillorType->Visible) { // CouncillorType ?>
		<td <?php echo $councillor_type_delete->CouncillorType->cellAttributes() ?>>
<span id="el<?php echo $councillor_type_delete->RowCount ?>_councillor_type_CouncillorType" class="councillor_type_CouncillorType">
<span<?php echo $councillor_type_delete->CouncillorType->viewAttributes() ?>><?php echo $councillor_type_delete->CouncillorType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_type_delete->CouncillorTYpeName->Visible) { // CouncillorTYpeName ?>
		<td <?php echo $councillor_type_delete->CouncillorTYpeName->cellAttributes() ?>>
<span id="el<?php echo $councillor_type_delete->RowCount ?>_councillor_type_CouncillorTYpeName" class="councillor_type_CouncillorTYpeName">
<span<?php echo $councillor_type_delete->CouncillorTYpeName->viewAttributes() ?>><?php echo $councillor_type_delete->CouncillorTYpeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$councillor_type_delete->Recordset->moveNext();
}
$councillor_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$councillor_type_delete->showPageFooter();
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
$councillor_type_delete->terminate();
?>