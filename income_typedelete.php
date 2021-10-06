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
$income_type_delete = new income_type_delete();

// Run the page
$income_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fincome_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fincome_typedelete = currentForm = new ew.Form("fincome_typedelete", "delete");
	loadjs.done("fincome_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $income_type_delete->showPageHeader(); ?>
<?php
$income_type_delete->showMessage();
?>
<form name="fincome_typedelete" id="fincome_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="income_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($income_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($income_type_delete->IncomeCode->Visible) { // IncomeCode ?>
		<th class="<?php echo $income_type_delete->IncomeCode->headerCellClass() ?>"><span id="elh_income_type_IncomeCode" class="income_type_IncomeCode"><?php echo $income_type_delete->IncomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->IncomeName->Visible) { // IncomeName ?>
		<th class="<?php echo $income_type_delete->IncomeName->headerCellClass() ?>"><span id="elh_income_type_IncomeName" class="income_type_IncomeName"><?php echo $income_type_delete->IncomeName->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->IncomeDescription->Visible) { // IncomeDescription ?>
		<th class="<?php echo $income_type_delete->IncomeDescription->headerCellClass() ?>"><span id="elh_income_type_IncomeDescription" class="income_type_IncomeDescription"><?php echo $income_type_delete->IncomeDescription->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->Division->Visible) { // Division ?>
		<th class="<?php echo $income_type_delete->Division->headerCellClass() ?>"><span id="elh_income_type_Division" class="income_type_Division"><?php echo $income_type_delete->Division->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->IncomeAmount->Visible) { // IncomeAmount ?>
		<th class="<?php echo $income_type_delete->IncomeAmount->headerCellClass() ?>"><span id="elh_income_type_IncomeAmount" class="income_type_IncomeAmount"><?php echo $income_type_delete->IncomeAmount->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
		<th class="<?php echo $income_type_delete->IncomeBasicRate->headerCellClass() ?>"><span id="elh_income_type_IncomeBasicRate" class="income_type_IncomeBasicRate"><?php echo $income_type_delete->IncomeBasicRate->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<th class="<?php echo $income_type_delete->BaseIncomeCode->headerCellClass() ?>"><span id="elh_income_type_BaseIncomeCode" class="income_type_BaseIncomeCode"><?php echo $income_type_delete->BaseIncomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->Taxable->Visible) { // Taxable ?>
		<th class="<?php echo $income_type_delete->Taxable->headerCellClass() ?>"><span id="elh_income_type_Taxable" class="income_type_Taxable"><?php echo $income_type_delete->Taxable->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->AccountNo->Visible) { // AccountNo ?>
		<th class="<?php echo $income_type_delete->AccountNo->headerCellClass() ?>"><span id="elh_income_type_AccountNo" class="income_type_AccountNo"><?php echo $income_type_delete->AccountNo->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->JobIncluded->Visible) { // JobIncluded ?>
		<th class="<?php echo $income_type_delete->JobIncluded->headerCellClass() ?>"><span id="elh_income_type_JobIncluded" class="income_type_JobIncluded"><?php echo $income_type_delete->JobIncluded->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->Application->Visible) { // Application ?>
		<th class="<?php echo $income_type_delete->Application->headerCellClass() ?>"><span id="elh_income_type_Application" class="income_type_Application"><?php echo $income_type_delete->Application->caption() ?></span></th>
<?php } ?>
<?php if ($income_type_delete->JobExcluded->Visible) { // JobExcluded ?>
		<th class="<?php echo $income_type_delete->JobExcluded->headerCellClass() ?>"><span id="elh_income_type_JobExcluded" class="income_type_JobExcluded"><?php echo $income_type_delete->JobExcluded->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$income_type_delete->RecordCount = 0;
$i = 0;
while (!$income_type_delete->Recordset->EOF) {
	$income_type_delete->RecordCount++;
	$income_type_delete->RowCount++;

	// Set row properties
	$income_type->resetAttributes();
	$income_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$income_type_delete->loadRowValues($income_type_delete->Recordset);

	// Render row
	$income_type_delete->renderRow();
?>
	<tr <?php echo $income_type->rowAttributes() ?>>
<?php if ($income_type_delete->IncomeCode->Visible) { // IncomeCode ?>
		<td <?php echo $income_type_delete->IncomeCode->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_IncomeCode" class="income_type_IncomeCode">
<span<?php echo $income_type_delete->IncomeCode->viewAttributes() ?>><?php echo $income_type_delete->IncomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->IncomeName->Visible) { // IncomeName ?>
		<td <?php echo $income_type_delete->IncomeName->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_IncomeName" class="income_type_IncomeName">
<span<?php echo $income_type_delete->IncomeName->viewAttributes() ?>><?php echo $income_type_delete->IncomeName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->IncomeDescription->Visible) { // IncomeDescription ?>
		<td <?php echo $income_type_delete->IncomeDescription->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_IncomeDescription" class="income_type_IncomeDescription">
<span<?php echo $income_type_delete->IncomeDescription->viewAttributes() ?>><?php echo $income_type_delete->IncomeDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->Division->Visible) { // Division ?>
		<td <?php echo $income_type_delete->Division->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_Division" class="income_type_Division">
<span<?php echo $income_type_delete->Division->viewAttributes() ?>><?php echo $income_type_delete->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->IncomeAmount->Visible) { // IncomeAmount ?>
		<td <?php echo $income_type_delete->IncomeAmount->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_IncomeAmount" class="income_type_IncomeAmount">
<span<?php echo $income_type_delete->IncomeAmount->viewAttributes() ?>><?php echo $income_type_delete->IncomeAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
		<td <?php echo $income_type_delete->IncomeBasicRate->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_IncomeBasicRate" class="income_type_IncomeBasicRate">
<span<?php echo $income_type_delete->IncomeBasicRate->viewAttributes() ?>><?php echo $income_type_delete->IncomeBasicRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<td <?php echo $income_type_delete->BaseIncomeCode->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_BaseIncomeCode" class="income_type_BaseIncomeCode">
<span<?php echo $income_type_delete->BaseIncomeCode->viewAttributes() ?>><?php echo $income_type_delete->BaseIncomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->Taxable->Visible) { // Taxable ?>
		<td <?php echo $income_type_delete->Taxable->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_Taxable" class="income_type_Taxable">
<span<?php echo $income_type_delete->Taxable->viewAttributes() ?>><?php echo $income_type_delete->Taxable->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->AccountNo->Visible) { // AccountNo ?>
		<td <?php echo $income_type_delete->AccountNo->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_AccountNo" class="income_type_AccountNo">
<span<?php echo $income_type_delete->AccountNo->viewAttributes() ?>><?php echo $income_type_delete->AccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->JobIncluded->Visible) { // JobIncluded ?>
		<td <?php echo $income_type_delete->JobIncluded->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_JobIncluded" class="income_type_JobIncluded">
<span<?php echo $income_type_delete->JobIncluded->viewAttributes() ?>><?php echo $income_type_delete->JobIncluded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->Application->Visible) { // Application ?>
		<td <?php echo $income_type_delete->Application->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_Application" class="income_type_Application">
<span<?php echo $income_type_delete->Application->viewAttributes() ?>><?php echo $income_type_delete->Application->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($income_type_delete->JobExcluded->Visible) { // JobExcluded ?>
		<td <?php echo $income_type_delete->JobExcluded->cellAttributes() ?>>
<span id="el<?php echo $income_type_delete->RowCount ?>_income_type_JobExcluded" class="income_type_JobExcluded">
<span<?php echo $income_type_delete->JobExcluded->viewAttributes() ?>><?php echo $income_type_delete->JobExcluded->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$income_type_delete->Recordset->moveNext();
}
$income_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $income_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$income_type_delete->showPageFooter();
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
$income_type_delete->terminate();
?>