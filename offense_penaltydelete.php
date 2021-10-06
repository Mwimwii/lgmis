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
$offense_penalty_delete = new offense_penalty_delete();

// Run the page
$offense_penalty_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_penalty_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foffense_penaltydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	foffense_penaltydelete = currentForm = new ew.Form("foffense_penaltydelete", "delete");
	loadjs.done("foffense_penaltydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $offense_penalty_delete->showPageHeader(); ?>
<?php
$offense_penalty_delete->showMessage();
?>
<form name="foffense_penaltydelete" id="foffense_penaltydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_penalty">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($offense_penalty_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($offense_penalty_delete->OffenseCode->Visible) { // OffenseCode ?>
		<th class="<?php echo $offense_penalty_delete->OffenseCode->headerCellClass() ?>"><span id="elh_offense_penalty_OffenseCode" class="offense_penalty_OffenseCode"><?php echo $offense_penalty_delete->OffenseCode->caption() ?></span></th>
<?php } ?>
<?php if ($offense_penalty_delete->OffenseCategory->Visible) { // OffenseCategory ?>
		<th class="<?php echo $offense_penalty_delete->OffenseCategory->headerCellClass() ?>"><span id="elh_offense_penalty_OffenseCategory" class="offense_penalty_OffenseCategory"><?php echo $offense_penalty_delete->OffenseCategory->caption() ?></span></th>
<?php } ?>
<?php if ($offense_penalty_delete->OffenseName->Visible) { // OffenseName ?>
		<th class="<?php echo $offense_penalty_delete->OffenseName->headerCellClass() ?>"><span id="elh_offense_penalty_OffenseName" class="offense_penalty_OffenseName"><?php echo $offense_penalty_delete->OffenseName->caption() ?></span></th>
<?php } ?>
<?php if ($offense_penalty_delete->Frequency->Visible) { // Frequency ?>
		<th class="<?php echo $offense_penalty_delete->Frequency->headerCellClass() ?>"><span id="elh_offense_penalty_Frequency" class="offense_penalty_Frequency"><?php echo $offense_penalty_delete->Frequency->caption() ?></span></th>
<?php } ?>
<?php if ($offense_penalty_delete->AppropriateAction->Visible) { // AppropriateAction ?>
		<th class="<?php echo $offense_penalty_delete->AppropriateAction->headerCellClass() ?>"><span id="elh_offense_penalty_AppropriateAction" class="offense_penalty_AppropriateAction"><?php echo $offense_penalty_delete->AppropriateAction->caption() ?></span></th>
<?php } ?>
<?php if ($offense_penalty_delete->Authority->Visible) { // Authority ?>
		<th class="<?php echo $offense_penalty_delete->Authority->headerCellClass() ?>"><span id="elh_offense_penalty_Authority" class="offense_penalty_Authority"><?php echo $offense_penalty_delete->Authority->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$offense_penalty_delete->RecordCount = 0;
$i = 0;
while (!$offense_penalty_delete->Recordset->EOF) {
	$offense_penalty_delete->RecordCount++;
	$offense_penalty_delete->RowCount++;

	// Set row properties
	$offense_penalty->resetAttributes();
	$offense_penalty->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$offense_penalty_delete->loadRowValues($offense_penalty_delete->Recordset);

	// Render row
	$offense_penalty_delete->renderRow();
?>
	<tr <?php echo $offense_penalty->rowAttributes() ?>>
<?php if ($offense_penalty_delete->OffenseCode->Visible) { // OffenseCode ?>
		<td <?php echo $offense_penalty_delete->OffenseCode->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_delete->RowCount ?>_offense_penalty_OffenseCode" class="offense_penalty_OffenseCode">
<span<?php echo $offense_penalty_delete->OffenseCode->viewAttributes() ?>><?php echo $offense_penalty_delete->OffenseCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($offense_penalty_delete->OffenseCategory->Visible) { // OffenseCategory ?>
		<td <?php echo $offense_penalty_delete->OffenseCategory->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_delete->RowCount ?>_offense_penalty_OffenseCategory" class="offense_penalty_OffenseCategory">
<span<?php echo $offense_penalty_delete->OffenseCategory->viewAttributes() ?>><?php echo $offense_penalty_delete->OffenseCategory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($offense_penalty_delete->OffenseName->Visible) { // OffenseName ?>
		<td <?php echo $offense_penalty_delete->OffenseName->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_delete->RowCount ?>_offense_penalty_OffenseName" class="offense_penalty_OffenseName">
<span<?php echo $offense_penalty_delete->OffenseName->viewAttributes() ?>><?php echo $offense_penalty_delete->OffenseName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($offense_penalty_delete->Frequency->Visible) { // Frequency ?>
		<td <?php echo $offense_penalty_delete->Frequency->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_delete->RowCount ?>_offense_penalty_Frequency" class="offense_penalty_Frequency">
<span<?php echo $offense_penalty_delete->Frequency->viewAttributes() ?>><?php echo $offense_penalty_delete->Frequency->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($offense_penalty_delete->AppropriateAction->Visible) { // AppropriateAction ?>
		<td <?php echo $offense_penalty_delete->AppropriateAction->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_delete->RowCount ?>_offense_penalty_AppropriateAction" class="offense_penalty_AppropriateAction">
<span<?php echo $offense_penalty_delete->AppropriateAction->viewAttributes() ?>><?php echo $offense_penalty_delete->AppropriateAction->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($offense_penalty_delete->Authority->Visible) { // Authority ?>
		<td <?php echo $offense_penalty_delete->Authority->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_delete->RowCount ?>_offense_penalty_Authority" class="offense_penalty_Authority">
<span<?php echo $offense_penalty_delete->Authority->viewAttributes() ?>><?php echo $offense_penalty_delete->Authority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$offense_penalty_delete->Recordset->moveNext();
}
$offense_penalty_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $offense_penalty_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$offense_penalty_delete->showPageFooter();
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
$offense_penalty_delete->terminate();
?>