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
$deduction_type_delete = new deduction_type_delete();

// Run the page
$deduction_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdeduction_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdeduction_typedelete = currentForm = new ew.Form("fdeduction_typedelete", "delete");
	loadjs.done("fdeduction_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $deduction_type_delete->showPageHeader(); ?>
<?php
$deduction_type_delete->showMessage();
?>
<form name="fdeduction_typedelete" id="fdeduction_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deduction_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($deduction_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($deduction_type_delete->DeductionCode->Visible) { // DeductionCode ?>
		<th class="<?php echo $deduction_type_delete->DeductionCode->headerCellClass() ?>"><span id="elh_deduction_type_DeductionCode" class="deduction_type_DeductionCode"><?php echo $deduction_type_delete->DeductionCode->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->DeductionName->Visible) { // DeductionName ?>
		<th class="<?php echo $deduction_type_delete->DeductionName->headerCellClass() ?>"><span id="elh_deduction_type_DeductionName" class="deduction_type_DeductionName"><?php echo $deduction_type_delete->DeductionName->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->DeductionDescription->Visible) { // DeductionDescription ?>
		<th class="<?php echo $deduction_type_delete->DeductionDescription->headerCellClass() ?>"><span id="elh_deduction_type_DeductionDescription" class="deduction_type_DeductionDescription"><?php echo $deduction_type_delete->DeductionDescription->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->Division->Visible) { // Division ?>
		<th class="<?php echo $deduction_type_delete->Division->headerCellClass() ?>"><span id="elh_deduction_type_Division" class="deduction_type_Division"><?php echo $deduction_type_delete->Division->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->DeductionAmount->Visible) { // DeductionAmount ?>
		<th class="<?php echo $deduction_type_delete->DeductionAmount->headerCellClass() ?>"><span id="elh_deduction_type_DeductionAmount" class="deduction_type_DeductionAmount"><?php echo $deduction_type_delete->DeductionAmount->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
		<th class="<?php echo $deduction_type_delete->DeductionBasicRate->headerCellClass() ?>"><span id="elh_deduction_type_DeductionBasicRate" class="deduction_type_DeductionBasicRate"><?php echo $deduction_type_delete->DeductionBasicRate->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->RemittedTo->Visible) { // RemittedTo ?>
		<th class="<?php echo $deduction_type_delete->RemittedTo->headerCellClass() ?>"><span id="elh_deduction_type_RemittedTo" class="deduction_type_RemittedTo"><?php echo $deduction_type_delete->RemittedTo->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->AccountNo->Visible) { // AccountNo ?>
		<th class="<?php echo $deduction_type_delete->AccountNo->headerCellClass() ?>"><span id="elh_deduction_type_AccountNo" class="deduction_type_AccountNo"><?php echo $deduction_type_delete->AccountNo->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<th class="<?php echo $deduction_type_delete->BaseIncomeCode->headerCellClass() ?>"><span id="elh_deduction_type_BaseIncomeCode" class="deduction_type_BaseIncomeCode"><?php echo $deduction_type_delete->BaseIncomeCode->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
		<th class="<?php echo $deduction_type_delete->BaseDeductionCode->headerCellClass() ?>"><span id="elh_deduction_type_BaseDeductionCode" class="deduction_type_BaseDeductionCode"><?php echo $deduction_type_delete->BaseDeductionCode->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->TaxExempt->Visible) { // TaxExempt ?>
		<th class="<?php echo $deduction_type_delete->TaxExempt->headerCellClass() ?>"><span id="elh_deduction_type_TaxExempt" class="deduction_type_TaxExempt"><?php echo $deduction_type_delete->TaxExempt->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->JobCode->Visible) { // JobCode ?>
		<th class="<?php echo $deduction_type_delete->JobCode->headerCellClass() ?>"><span id="elh_deduction_type_JobCode" class="deduction_type_JobCode"><?php echo $deduction_type_delete->JobCode->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->MinimumAmount->Visible) { // MinimumAmount ?>
		<th class="<?php echo $deduction_type_delete->MinimumAmount->headerCellClass() ?>"><span id="elh_deduction_type_MinimumAmount" class="deduction_type_MinimumAmount"><?php echo $deduction_type_delete->MinimumAmount->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->MaximumAmount->Visible) { // MaximumAmount ?>
		<th class="<?php echo $deduction_type_delete->MaximumAmount->headerCellClass() ?>"><span id="elh_deduction_type_MaximumAmount" class="deduction_type_MaximumAmount"><?php echo $deduction_type_delete->MaximumAmount->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
		<th class="<?php echo $deduction_type_delete->EmployerContributionRate->headerCellClass() ?>"><span id="elh_deduction_type_EmployerContributionRate" class="deduction_type_EmployerContributionRate"><?php echo $deduction_type_delete->EmployerContributionRate->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
		<th class="<?php echo $deduction_type_delete->EmployerContributionAmount->headerCellClass() ?>"><span id="elh_deduction_type_EmployerContributionAmount" class="deduction_type_EmployerContributionAmount"><?php echo $deduction_type_delete->EmployerContributionAmount->caption() ?></span></th>
<?php } ?>
<?php if ($deduction_type_delete->Application->Visible) { // Application ?>
		<th class="<?php echo $deduction_type_delete->Application->headerCellClass() ?>"><span id="elh_deduction_type_Application" class="deduction_type_Application"><?php echo $deduction_type_delete->Application->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$deduction_type_delete->RecordCount = 0;
$i = 0;
while (!$deduction_type_delete->Recordset->EOF) {
	$deduction_type_delete->RecordCount++;
	$deduction_type_delete->RowCount++;

	// Set row properties
	$deduction_type->resetAttributes();
	$deduction_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$deduction_type_delete->loadRowValues($deduction_type_delete->Recordset);

	// Render row
	$deduction_type_delete->renderRow();
?>
	<tr <?php echo $deduction_type->rowAttributes() ?>>
<?php if ($deduction_type_delete->DeductionCode->Visible) { // DeductionCode ?>
		<td <?php echo $deduction_type_delete->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_DeductionCode" class="deduction_type_DeductionCode">
<span<?php echo $deduction_type_delete->DeductionCode->viewAttributes() ?>><?php echo $deduction_type_delete->DeductionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->DeductionName->Visible) { // DeductionName ?>
		<td <?php echo $deduction_type_delete->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_DeductionName" class="deduction_type_DeductionName">
<span<?php echo $deduction_type_delete->DeductionName->viewAttributes() ?>><?php echo $deduction_type_delete->DeductionName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->DeductionDescription->Visible) { // DeductionDescription ?>
		<td <?php echo $deduction_type_delete->DeductionDescription->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_DeductionDescription" class="deduction_type_DeductionDescription">
<span<?php echo $deduction_type_delete->DeductionDescription->viewAttributes() ?>><?php echo $deduction_type_delete->DeductionDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->Division->Visible) { // Division ?>
		<td <?php echo $deduction_type_delete->Division->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_Division" class="deduction_type_Division">
<span<?php echo $deduction_type_delete->Division->viewAttributes() ?>><?php echo $deduction_type_delete->Division->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->DeductionAmount->Visible) { // DeductionAmount ?>
		<td <?php echo $deduction_type_delete->DeductionAmount->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_DeductionAmount" class="deduction_type_DeductionAmount">
<span<?php echo $deduction_type_delete->DeductionAmount->viewAttributes() ?>><?php echo $deduction_type_delete->DeductionAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
		<td <?php echo $deduction_type_delete->DeductionBasicRate->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_DeductionBasicRate" class="deduction_type_DeductionBasicRate">
<span<?php echo $deduction_type_delete->DeductionBasicRate->viewAttributes() ?>><?php echo $deduction_type_delete->DeductionBasicRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->RemittedTo->Visible) { // RemittedTo ?>
		<td <?php echo $deduction_type_delete->RemittedTo->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_RemittedTo" class="deduction_type_RemittedTo">
<span<?php echo $deduction_type_delete->RemittedTo->viewAttributes() ?>><?php echo $deduction_type_delete->RemittedTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->AccountNo->Visible) { // AccountNo ?>
		<td <?php echo $deduction_type_delete->AccountNo->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_AccountNo" class="deduction_type_AccountNo">
<span<?php echo $deduction_type_delete->AccountNo->viewAttributes() ?>><?php echo $deduction_type_delete->AccountNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<td <?php echo $deduction_type_delete->BaseIncomeCode->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_BaseIncomeCode" class="deduction_type_BaseIncomeCode">
<span<?php echo $deduction_type_delete->BaseIncomeCode->viewAttributes() ?>><?php echo $deduction_type_delete->BaseIncomeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
		<td <?php echo $deduction_type_delete->BaseDeductionCode->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_BaseDeductionCode" class="deduction_type_BaseDeductionCode">
<span<?php echo $deduction_type_delete->BaseDeductionCode->viewAttributes() ?>><?php echo $deduction_type_delete->BaseDeductionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->TaxExempt->Visible) { // TaxExempt ?>
		<td <?php echo $deduction_type_delete->TaxExempt->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_TaxExempt" class="deduction_type_TaxExempt">
<span<?php echo $deduction_type_delete->TaxExempt->viewAttributes() ?>><?php echo $deduction_type_delete->TaxExempt->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->JobCode->Visible) { // JobCode ?>
		<td <?php echo $deduction_type_delete->JobCode->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_JobCode" class="deduction_type_JobCode">
<span<?php echo $deduction_type_delete->JobCode->viewAttributes() ?>><?php echo $deduction_type_delete->JobCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->MinimumAmount->Visible) { // MinimumAmount ?>
		<td <?php echo $deduction_type_delete->MinimumAmount->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_MinimumAmount" class="deduction_type_MinimumAmount">
<span<?php echo $deduction_type_delete->MinimumAmount->viewAttributes() ?>><?php echo $deduction_type_delete->MinimumAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->MaximumAmount->Visible) { // MaximumAmount ?>
		<td <?php echo $deduction_type_delete->MaximumAmount->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_MaximumAmount" class="deduction_type_MaximumAmount">
<span<?php echo $deduction_type_delete->MaximumAmount->viewAttributes() ?>><?php echo $deduction_type_delete->MaximumAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
		<td <?php echo $deduction_type_delete->EmployerContributionRate->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_EmployerContributionRate" class="deduction_type_EmployerContributionRate">
<span<?php echo $deduction_type_delete->EmployerContributionRate->viewAttributes() ?>><?php echo $deduction_type_delete->EmployerContributionRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
		<td <?php echo $deduction_type_delete->EmployerContributionAmount->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_EmployerContributionAmount" class="deduction_type_EmployerContributionAmount">
<span<?php echo $deduction_type_delete->EmployerContributionAmount->viewAttributes() ?>><?php echo $deduction_type_delete->EmployerContributionAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($deduction_type_delete->Application->Visible) { // Application ?>
		<td <?php echo $deduction_type_delete->Application->cellAttributes() ?>>
<span id="el<?php echo $deduction_type_delete->RowCount ?>_deduction_type_Application" class="deduction_type_Application">
<span<?php echo $deduction_type_delete->Application->viewAttributes() ?>><?php echo $deduction_type_delete->Application->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$deduction_type_delete->Recordset->moveNext();
}
$deduction_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $deduction_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$deduction_type_delete->showPageFooter();
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
$deduction_type_delete->terminate();
?>