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
$asset_delete = new asset_delete();

// Run the page
$asset_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fassetdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fassetdelete = currentForm = new ew.Form("fassetdelete", "delete");
	loadjs.done("fassetdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_delete->showPageHeader(); ?>
<?php
$asset_delete->showMessage();
?>
<form name="fassetdelete" id="fassetdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($asset_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($asset_delete->AssetCode->Visible) { // AssetCode ?>
		<th class="<?php echo $asset_delete->AssetCode->headerCellClass() ?>"><span id="elh_asset_AssetCode" class="asset_AssetCode"><?php echo $asset_delete->AssetCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $asset_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_asset_ProvinceCode" class="asset_ProvinceCode"><?php echo $asset_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $asset_delete->LACode->headerCellClass() ?>"><span id="elh_asset_LACode" class="asset_LACode"><?php echo $asset_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $asset_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_asset_DepartmentCode" class="asset_DepartmentCode"><?php echo $asset_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->SectionCode->Visible) { // SectionCode ?>
		<th class="<?php echo $asset_delete->SectionCode->headerCellClass() ?>"><span id="elh_asset_SectionCode" class="asset_SectionCode"><?php echo $asset_delete->SectionCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<th class="<?php echo $asset_delete->AssetTypeCode->headerCellClass() ?>"><span id="elh_asset_AssetTypeCode" class="asset_AssetTypeCode"><?php echo $asset_delete->AssetTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->Supplier->Visible) { // Supplier ?>
		<th class="<?php echo $asset_delete->Supplier->headerCellClass() ?>"><span id="elh_asset_Supplier" class="asset_Supplier"><?php echo $asset_delete->Supplier->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->PurchasePrice->Visible) { // PurchasePrice ?>
		<th class="<?php echo $asset_delete->PurchasePrice->headerCellClass() ?>"><span id="elh_asset_PurchasePrice" class="asset_PurchasePrice"><?php echo $asset_delete->PurchasePrice->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->CurrencyCode->Visible) { // CurrencyCode ?>
		<th class="<?php echo $asset_delete->CurrencyCode->headerCellClass() ?>"><span id="elh_asset_CurrencyCode" class="asset_CurrencyCode"><?php echo $asset_delete->CurrencyCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->ConditionCode->Visible) { // ConditionCode ?>
		<th class="<?php echo $asset_delete->ConditionCode->headerCellClass() ?>"><span id="elh_asset_ConditionCode" class="asset_ConditionCode"><?php echo $asset_delete->ConditionCode->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<th class="<?php echo $asset_delete->DateOfPurchase->headerCellClass() ?>"><span id="elh_asset_DateOfPurchase" class="asset_DateOfPurchase"><?php echo $asset_delete->DateOfPurchase->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->AssetCapacity->Visible) { // AssetCapacity ?>
		<th class="<?php echo $asset_delete->AssetCapacity->headerCellClass() ?>"><span id="elh_asset_AssetCapacity" class="asset_AssetCapacity"><?php echo $asset_delete->AssetCapacity->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<th class="<?php echo $asset_delete->UnitOfMeasure->headerCellClass() ?>"><span id="elh_asset_UnitOfMeasure" class="asset_UnitOfMeasure"><?php echo $asset_delete->UnitOfMeasure->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->AssetDescription->Visible) { // AssetDescription ?>
		<th class="<?php echo $asset_delete->AssetDescription->headerCellClass() ?>"><span id="elh_asset_AssetDescription" class="asset_AssetDescription"><?php echo $asset_delete->AssetDescription->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<th class="<?php echo $asset_delete->DateOfLastRevaluation->headerCellClass() ?>"><span id="elh_asset_DateOfLastRevaluation" class="asset_DateOfLastRevaluation"><?php echo $asset_delete->DateOfLastRevaluation->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->NewValue->Visible) { // NewValue ?>
		<th class="<?php echo $asset_delete->NewValue->headerCellClass() ?>"><span id="elh_asset_NewValue" class="asset_NewValue"><?php echo $asset_delete->NewValue->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->NameOfValuer->Visible) { // NameOfValuer ?>
		<th class="<?php echo $asset_delete->NameOfValuer->headerCellClass() ?>"><span id="elh_asset_NameOfValuer" class="asset_NameOfValuer"><?php echo $asset_delete->NameOfValuer->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->BookValue->Visible) { // BookValue ?>
		<th class="<?php echo $asset_delete->BookValue->headerCellClass() ?>"><span id="elh_asset_BookValue" class="asset_BookValue"><?php echo $asset_delete->BookValue->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<th class="<?php echo $asset_delete->LastDepreciationDate->headerCellClass() ?>"><span id="elh_asset_LastDepreciationDate" class="asset_LastDepreciationDate"><?php echo $asset_delete->LastDepreciationDate->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<th class="<?php echo $asset_delete->LastDepreciationAmount->headerCellClass() ?>"><span id="elh_asset_LastDepreciationAmount" class="asset_LastDepreciationAmount"><?php echo $asset_delete->LastDepreciationAmount->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->DepreciationRate->Visible) { // DepreciationRate ?>
		<th class="<?php echo $asset_delete->DepreciationRate->headerCellClass() ?>"><span id="elh_asset_DepreciationRate" class="asset_DepreciationRate"><?php echo $asset_delete->DepreciationRate->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<th class="<?php echo $asset_delete->CumulativeDepreciation->headerCellClass() ?>"><span id="elh_asset_CumulativeDepreciation" class="asset_CumulativeDepreciation"><?php echo $asset_delete->CumulativeDepreciation->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->AssetStatus->Visible) { // AssetStatus ?>
		<th class="<?php echo $asset_delete->AssetStatus->headerCellClass() ?>"><span id="elh_asset_AssetStatus" class="asset_AssetStatus"><?php echo $asset_delete->AssetStatus->caption() ?></span></th>
<?php } ?>
<?php if ($asset_delete->ScrapValue->Visible) { // ScrapValue ?>
		<th class="<?php echo $asset_delete->ScrapValue->headerCellClass() ?>"><span id="elh_asset_ScrapValue" class="asset_ScrapValue"><?php echo $asset_delete->ScrapValue->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$asset_delete->RecordCount = 0;
$i = 0;
while (!$asset_delete->Recordset->EOF) {
	$asset_delete->RecordCount++;
	$asset_delete->RowCount++;

	// Set row properties
	$asset->resetAttributes();
	$asset->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$asset_delete->loadRowValues($asset_delete->Recordset);

	// Render row
	$asset_delete->renderRow();
?>
	<tr <?php echo $asset->rowAttributes() ?>>
<?php if ($asset_delete->AssetCode->Visible) { // AssetCode ?>
		<td <?php echo $asset_delete->AssetCode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_AssetCode" class="asset_AssetCode">
<span<?php echo $asset_delete->AssetCode->viewAttributes() ?>><?php echo $asset_delete->AssetCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $asset_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_ProvinceCode" class="asset_ProvinceCode">
<span<?php echo $asset_delete->ProvinceCode->viewAttributes() ?>><?php echo $asset_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $asset_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_LACode" class="asset_LACode">
<span<?php echo $asset_delete->LACode->viewAttributes() ?>><?php echo $asset_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $asset_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_DepartmentCode" class="asset_DepartmentCode">
<span<?php echo $asset_delete->DepartmentCode->viewAttributes() ?>><?php echo $asset_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->SectionCode->Visible) { // SectionCode ?>
		<td <?php echo $asset_delete->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_SectionCode" class="asset_SectionCode">
<span<?php echo $asset_delete->SectionCode->viewAttributes() ?>><?php echo $asset_delete->SectionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<td <?php echo $asset_delete->AssetTypeCode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_AssetTypeCode" class="asset_AssetTypeCode">
<span<?php echo $asset_delete->AssetTypeCode->viewAttributes() ?>><?php echo $asset_delete->AssetTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->Supplier->Visible) { // Supplier ?>
		<td <?php echo $asset_delete->Supplier->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_Supplier" class="asset_Supplier">
<span<?php echo $asset_delete->Supplier->viewAttributes() ?>><?php echo $asset_delete->Supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->PurchasePrice->Visible) { // PurchasePrice ?>
		<td <?php echo $asset_delete->PurchasePrice->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_PurchasePrice" class="asset_PurchasePrice">
<span<?php echo $asset_delete->PurchasePrice->viewAttributes() ?>><?php echo $asset_delete->PurchasePrice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->CurrencyCode->Visible) { // CurrencyCode ?>
		<td <?php echo $asset_delete->CurrencyCode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_CurrencyCode" class="asset_CurrencyCode">
<span<?php echo $asset_delete->CurrencyCode->viewAttributes() ?>><?php echo $asset_delete->CurrencyCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->ConditionCode->Visible) { // ConditionCode ?>
		<td <?php echo $asset_delete->ConditionCode->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_ConditionCode" class="asset_ConditionCode">
<span<?php echo $asset_delete->ConditionCode->viewAttributes() ?>><?php echo $asset_delete->ConditionCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<td <?php echo $asset_delete->DateOfPurchase->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_DateOfPurchase" class="asset_DateOfPurchase">
<span<?php echo $asset_delete->DateOfPurchase->viewAttributes() ?>><?php echo $asset_delete->DateOfPurchase->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->AssetCapacity->Visible) { // AssetCapacity ?>
		<td <?php echo $asset_delete->AssetCapacity->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_AssetCapacity" class="asset_AssetCapacity">
<span<?php echo $asset_delete->AssetCapacity->viewAttributes() ?>><?php echo $asset_delete->AssetCapacity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td <?php echo $asset_delete->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_UnitOfMeasure" class="asset_UnitOfMeasure">
<span<?php echo $asset_delete->UnitOfMeasure->viewAttributes() ?>><?php echo $asset_delete->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->AssetDescription->Visible) { // AssetDescription ?>
		<td <?php echo $asset_delete->AssetDescription->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_AssetDescription" class="asset_AssetDescription">
<span<?php echo $asset_delete->AssetDescription->viewAttributes() ?>><?php echo $asset_delete->AssetDescription->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<td <?php echo $asset_delete->DateOfLastRevaluation->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_DateOfLastRevaluation" class="asset_DateOfLastRevaluation">
<span<?php echo $asset_delete->DateOfLastRevaluation->viewAttributes() ?>><?php echo $asset_delete->DateOfLastRevaluation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->NewValue->Visible) { // NewValue ?>
		<td <?php echo $asset_delete->NewValue->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_NewValue" class="asset_NewValue">
<span<?php echo $asset_delete->NewValue->viewAttributes() ?>><?php echo $asset_delete->NewValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->NameOfValuer->Visible) { // NameOfValuer ?>
		<td <?php echo $asset_delete->NameOfValuer->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_NameOfValuer" class="asset_NameOfValuer">
<span<?php echo $asset_delete->NameOfValuer->viewAttributes() ?>><?php echo $asset_delete->NameOfValuer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->BookValue->Visible) { // BookValue ?>
		<td <?php echo $asset_delete->BookValue->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_BookValue" class="asset_BookValue">
<span<?php echo $asset_delete->BookValue->viewAttributes() ?>><?php echo $asset_delete->BookValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<td <?php echo $asset_delete->LastDepreciationDate->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_LastDepreciationDate" class="asset_LastDepreciationDate">
<span<?php echo $asset_delete->LastDepreciationDate->viewAttributes() ?>><?php echo $asset_delete->LastDepreciationDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<td <?php echo $asset_delete->LastDepreciationAmount->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_LastDepreciationAmount" class="asset_LastDepreciationAmount">
<span<?php echo $asset_delete->LastDepreciationAmount->viewAttributes() ?>><?php echo $asset_delete->LastDepreciationAmount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->DepreciationRate->Visible) { // DepreciationRate ?>
		<td <?php echo $asset_delete->DepreciationRate->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_DepreciationRate" class="asset_DepreciationRate">
<span<?php echo $asset_delete->DepreciationRate->viewAttributes() ?>><?php echo $asset_delete->DepreciationRate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<td <?php echo $asset_delete->CumulativeDepreciation->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_CumulativeDepreciation" class="asset_CumulativeDepreciation">
<span<?php echo $asset_delete->CumulativeDepreciation->viewAttributes() ?>><?php echo $asset_delete->CumulativeDepreciation->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->AssetStatus->Visible) { // AssetStatus ?>
		<td <?php echo $asset_delete->AssetStatus->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_AssetStatus" class="asset_AssetStatus">
<span<?php echo $asset_delete->AssetStatus->viewAttributes() ?>><?php echo $asset_delete->AssetStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($asset_delete->ScrapValue->Visible) { // ScrapValue ?>
		<td <?php echo $asset_delete->ScrapValue->cellAttributes() ?>>
<span id="el<?php echo $asset_delete->RowCount ?>_asset_ScrapValue" class="asset_ScrapValue">
<span<?php echo $asset_delete->ScrapValue->viewAttributes() ?>><?php echo $asset_delete->ScrapValue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$asset_delete->Recordset->moveNext();
}
$asset_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$asset_delete->showPageFooter();
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
$asset_delete->terminate();
?>