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
$staffexperience_delete = new staffexperience_delete();

// Run the page
$staffexperience_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffexperiencedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffexperiencedelete = currentForm = new ew.Form("fstaffexperiencedelete", "delete");
	loadjs.done("fstaffexperiencedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffexperience_delete->showPageHeader(); ?>
<?php
$staffexperience_delete->showMessage();
?>
<form name="fstaffexperiencedelete" id="fstaffexperiencedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffexperience">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffexperience_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffexperience_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $staffexperience_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_staffexperience_ProvinceCode" class="staffexperience_ProvinceCode"><?php echo $staffexperience_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($staffexperience_delete->LAcode->Visible) { // LAcode ?>
		<th class="<?php echo $staffexperience_delete->LAcode->headerCellClass() ?>"><span id="elh_staffexperience_LAcode" class="staffexperience_LAcode"><?php echo $staffexperience_delete->LAcode->caption() ?></span></th>
<?php } ?>
<?php if ($staffexperience_delete->PositionCode->Visible) { // PositionCode ?>
		<th class="<?php echo $staffexperience_delete->PositionCode->headerCellClass() ?>"><span id="elh_staffexperience_PositionCode" class="staffexperience_PositionCode"><?php echo $staffexperience_delete->PositionCode->caption() ?></span></th>
<?php } ?>
<?php if ($staffexperience_delete->FromDate->Visible) { // FromDate ?>
		<th class="<?php echo $staffexperience_delete->FromDate->headerCellClass() ?>"><span id="elh_staffexperience_FromDate" class="staffexperience_FromDate"><?php echo $staffexperience_delete->FromDate->caption() ?></span></th>
<?php } ?>
<?php if ($staffexperience_delete->ExitDate->Visible) { // ExitDate ?>
		<th class="<?php echo $staffexperience_delete->ExitDate->headerCellClass() ?>"><span id="elh_staffexperience_ExitDate" class="staffexperience_ExitDate"><?php echo $staffexperience_delete->ExitDate->caption() ?></span></th>
<?php } ?>
<?php if ($staffexperience_delete->ReasonForExit->Visible) { // ReasonForExit ?>
		<th class="<?php echo $staffexperience_delete->ReasonForExit->headerCellClass() ?>"><span id="elh_staffexperience_ReasonForExit" class="staffexperience_ReasonForExit"><?php echo $staffexperience_delete->ReasonForExit->caption() ?></span></th>
<?php } ?>
<?php if ($staffexperience_delete->RetirementType->Visible) { // RetirementType ?>
		<th class="<?php echo $staffexperience_delete->RetirementType->headerCellClass() ?>"><span id="elh_staffexperience_RetirementType" class="staffexperience_RetirementType"><?php echo $staffexperience_delete->RetirementType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffexperience_delete->RecordCount = 0;
$i = 0;
while (!$staffexperience_delete->Recordset->EOF) {
	$staffexperience_delete->RecordCount++;
	$staffexperience_delete->RowCount++;

	// Set row properties
	$staffexperience->resetAttributes();
	$staffexperience->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffexperience_delete->loadRowValues($staffexperience_delete->Recordset);

	// Render row
	$staffexperience_delete->renderRow();
?>
	<tr <?php echo $staffexperience->rowAttributes() ?>>
<?php if ($staffexperience_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $staffexperience_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $staffexperience_delete->RowCount ?>_staffexperience_ProvinceCode" class="staffexperience_ProvinceCode">
<span<?php echo $staffexperience_delete->ProvinceCode->viewAttributes() ?>><?php echo $staffexperience_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffexperience_delete->LAcode->Visible) { // LAcode ?>
		<td <?php echo $staffexperience_delete->LAcode->cellAttributes() ?>>
<span id="el<?php echo $staffexperience_delete->RowCount ?>_staffexperience_LAcode" class="staffexperience_LAcode">
<span<?php echo $staffexperience_delete->LAcode->viewAttributes() ?>><?php echo $staffexperience_delete->LAcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffexperience_delete->PositionCode->Visible) { // PositionCode ?>
		<td <?php echo $staffexperience_delete->PositionCode->cellAttributes() ?>>
<span id="el<?php echo $staffexperience_delete->RowCount ?>_staffexperience_PositionCode" class="staffexperience_PositionCode">
<span<?php echo $staffexperience_delete->PositionCode->viewAttributes() ?>><?php echo $staffexperience_delete->PositionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffexperience_delete->FromDate->Visible) { // FromDate ?>
		<td <?php echo $staffexperience_delete->FromDate->cellAttributes() ?>>
<span id="el<?php echo $staffexperience_delete->RowCount ?>_staffexperience_FromDate" class="staffexperience_FromDate">
<span<?php echo $staffexperience_delete->FromDate->viewAttributes() ?>><?php echo $staffexperience_delete->FromDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffexperience_delete->ExitDate->Visible) { // ExitDate ?>
		<td <?php echo $staffexperience_delete->ExitDate->cellAttributes() ?>>
<span id="el<?php echo $staffexperience_delete->RowCount ?>_staffexperience_ExitDate" class="staffexperience_ExitDate">
<span<?php echo $staffexperience_delete->ExitDate->viewAttributes() ?>><?php echo $staffexperience_delete->ExitDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffexperience_delete->ReasonForExit->Visible) { // ReasonForExit ?>
		<td <?php echo $staffexperience_delete->ReasonForExit->cellAttributes() ?>>
<span id="el<?php echo $staffexperience_delete->RowCount ?>_staffexperience_ReasonForExit" class="staffexperience_ReasonForExit">
<span<?php echo $staffexperience_delete->ReasonForExit->viewAttributes() ?>><?php echo $staffexperience_delete->ReasonForExit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffexperience_delete->RetirementType->Visible) { // RetirementType ?>
		<td <?php echo $staffexperience_delete->RetirementType->cellAttributes() ?>>
<span id="el<?php echo $staffexperience_delete->RowCount ?>_staffexperience_RetirementType" class="staffexperience_RetirementType">
<span<?php echo $staffexperience_delete->RetirementType->viewAttributes() ?>><?php echo $staffexperience_delete->RetirementType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffexperience_delete->Recordset->moveNext();
}
$staffexperience_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffexperience_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffexperience_delete->showPageFooter();
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
$staffexperience_delete->terminate();
?>