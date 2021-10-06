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
$means_of_application_delete = new means_of_application_delete();

// Run the page
$means_of_application_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$means_of_application_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmeans_of_applicationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmeans_of_applicationdelete = currentForm = new ew.Form("fmeans_of_applicationdelete", "delete");
	loadjs.done("fmeans_of_applicationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $means_of_application_delete->showPageHeader(); ?>
<?php
$means_of_application_delete->showMessage();
?>
<form name="fmeans_of_applicationdelete" id="fmeans_of_applicationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="means_of_application">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($means_of_application_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($means_of_application_delete->ChoiceCode->Visible) { // ChoiceCode ?>
		<th class="<?php echo $means_of_application_delete->ChoiceCode->headerCellClass() ?>"><span id="elh_means_of_application_ChoiceCode" class="means_of_application_ChoiceCode"><?php echo $means_of_application_delete->ChoiceCode->caption() ?></span></th>
<?php } ?>
<?php if ($means_of_application_delete->Application->Visible) { // Application ?>
		<th class="<?php echo $means_of_application_delete->Application->headerCellClass() ?>"><span id="elh_means_of_application_Application" class="means_of_application_Application"><?php echo $means_of_application_delete->Application->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$means_of_application_delete->RecordCount = 0;
$i = 0;
while (!$means_of_application_delete->Recordset->EOF) {
	$means_of_application_delete->RecordCount++;
	$means_of_application_delete->RowCount++;

	// Set row properties
	$means_of_application->resetAttributes();
	$means_of_application->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$means_of_application_delete->loadRowValues($means_of_application_delete->Recordset);

	// Render row
	$means_of_application_delete->renderRow();
?>
	<tr <?php echo $means_of_application->rowAttributes() ?>>
<?php if ($means_of_application_delete->ChoiceCode->Visible) { // ChoiceCode ?>
		<td <?php echo $means_of_application_delete->ChoiceCode->cellAttributes() ?>>
<span id="el<?php echo $means_of_application_delete->RowCount ?>_means_of_application_ChoiceCode" class="means_of_application_ChoiceCode">
<span<?php echo $means_of_application_delete->ChoiceCode->viewAttributes() ?>><?php echo $means_of_application_delete->ChoiceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($means_of_application_delete->Application->Visible) { // Application ?>
		<td <?php echo $means_of_application_delete->Application->cellAttributes() ?>>
<span id="el<?php echo $means_of_application_delete->RowCount ?>_means_of_application_Application" class="means_of_application_Application">
<span<?php echo $means_of_application_delete->Application->viewAttributes() ?>><?php echo $means_of_application_delete->Application->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$means_of_application_delete->Recordset->moveNext();
}
$means_of_application_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $means_of_application_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$means_of_application_delete->showPageFooter();
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
$means_of_application_delete->terminate();
?>