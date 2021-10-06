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
$appeal_status_delete = new appeal_status_delete();

// Run the page
$appeal_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$appeal_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fappeal_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fappeal_statusdelete = currentForm = new ew.Form("fappeal_statusdelete", "delete");
	loadjs.done("fappeal_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $appeal_status_delete->showPageHeader(); ?>
<?php
$appeal_status_delete->showMessage();
?>
<form name="fappeal_statusdelete" id="fappeal_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="appeal_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($appeal_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($appeal_status_delete->AppealStatusCode->Visible) { // AppealStatusCode ?>
		<th class="<?php echo $appeal_status_delete->AppealStatusCode->headerCellClass() ?>"><span id="elh_appeal_status_AppealStatusCode" class="appeal_status_AppealStatusCode"><?php echo $appeal_status_delete->AppealStatusCode->caption() ?></span></th>
<?php } ?>
<?php if ($appeal_status_delete->AppealStatus->Visible) { // AppealStatus ?>
		<th class="<?php echo $appeal_status_delete->AppealStatus->headerCellClass() ?>"><span id="elh_appeal_status_AppealStatus" class="appeal_status_AppealStatus"><?php echo $appeal_status_delete->AppealStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$appeal_status_delete->RecordCount = 0;
$i = 0;
while (!$appeal_status_delete->Recordset->EOF) {
	$appeal_status_delete->RecordCount++;
	$appeal_status_delete->RowCount++;

	// Set row properties
	$appeal_status->resetAttributes();
	$appeal_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$appeal_status_delete->loadRowValues($appeal_status_delete->Recordset);

	// Render row
	$appeal_status_delete->renderRow();
?>
	<tr <?php echo $appeal_status->rowAttributes() ?>>
<?php if ($appeal_status_delete->AppealStatusCode->Visible) { // AppealStatusCode ?>
		<td <?php echo $appeal_status_delete->AppealStatusCode->cellAttributes() ?>>
<span id="el<?php echo $appeal_status_delete->RowCount ?>_appeal_status_AppealStatusCode" class="appeal_status_AppealStatusCode">
<span<?php echo $appeal_status_delete->AppealStatusCode->viewAttributes() ?>><?php echo $appeal_status_delete->AppealStatusCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($appeal_status_delete->AppealStatus->Visible) { // AppealStatus ?>
		<td <?php echo $appeal_status_delete->AppealStatus->cellAttributes() ?>>
<span id="el<?php echo $appeal_status_delete->RowCount ?>_appeal_status_AppealStatus" class="appeal_status_AppealStatus">
<span<?php echo $appeal_status_delete->AppealStatus->viewAttributes() ?>><?php echo $appeal_status_delete->AppealStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$appeal_status_delete->Recordset->moveNext();
}
$appeal_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $appeal_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$appeal_status_delete->showPageFooter();
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
$appeal_status_delete->terminate();
?>