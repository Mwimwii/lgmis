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
$councillorship_status_delete = new councillorship_status_delete();

// Run the page
$councillorship_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillorship_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncillorship_statusdelete = currentForm = new ew.Form("fcouncillorship_statusdelete", "delete");
	loadjs.done("fcouncillorship_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillorship_status_delete->showPageHeader(); ?>
<?php
$councillorship_status_delete->showMessage();
?>
<form name="fcouncillorship_statusdelete" id="fcouncillorship_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($councillorship_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($councillorship_status_delete->CouncillorsipStatus->Visible) { // CouncillorsipStatus ?>
		<th class="<?php echo $councillorship_status_delete->CouncillorsipStatus->headerCellClass() ?>"><span id="elh_councillorship_status_CouncillorsipStatus" class="councillorship_status_CouncillorsipStatus"><?php echo $councillorship_status_delete->CouncillorsipStatus->caption() ?></span></th>
<?php } ?>
<?php if ($councillorship_status_delete->CouncillorshipStatusDesc->Visible) { // CouncillorshipStatusDesc ?>
		<th class="<?php echo $councillorship_status_delete->CouncillorshipStatusDesc->headerCellClass() ?>"><span id="elh_councillorship_status_CouncillorshipStatusDesc" class="councillorship_status_CouncillorshipStatusDesc"><?php echo $councillorship_status_delete->CouncillorshipStatusDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$councillorship_status_delete->RecordCount = 0;
$i = 0;
while (!$councillorship_status_delete->Recordset->EOF) {
	$councillorship_status_delete->RecordCount++;
	$councillorship_status_delete->RowCount++;

	// Set row properties
	$councillorship_status->resetAttributes();
	$councillorship_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$councillorship_status_delete->loadRowValues($councillorship_status_delete->Recordset);

	// Render row
	$councillorship_status_delete->renderRow();
?>
	<tr <?php echo $councillorship_status->rowAttributes() ?>>
<?php if ($councillorship_status_delete->CouncillorsipStatus->Visible) { // CouncillorsipStatus ?>
		<td <?php echo $councillorship_status_delete->CouncillorsipStatus->cellAttributes() ?>>
<span id="el<?php echo $councillorship_status_delete->RowCount ?>_councillorship_status_CouncillorsipStatus" class="councillorship_status_CouncillorsipStatus">
<span<?php echo $councillorship_status_delete->CouncillorsipStatus->viewAttributes() ?>><?php echo $councillorship_status_delete->CouncillorsipStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillorship_status_delete->CouncillorshipStatusDesc->Visible) { // CouncillorshipStatusDesc ?>
		<td <?php echo $councillorship_status_delete->CouncillorshipStatusDesc->cellAttributes() ?>>
<span id="el<?php echo $councillorship_status_delete->RowCount ?>_councillorship_status_CouncillorshipStatusDesc" class="councillorship_status_CouncillorshipStatusDesc">
<span<?php echo $councillorship_status_delete->CouncillorshipStatusDesc->viewAttributes() ?>><?php echo $councillorship_status_delete->CouncillorshipStatusDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$councillorship_status_delete->Recordset->moveNext();
}
$councillorship_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillorship_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$councillorship_status_delete->showPageFooter();
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
$councillorship_status_delete->terminate();
?>