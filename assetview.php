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
$asset_view = new asset_view();

// Run the page
$asset_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$asset_view->isExport()) { ?>
<script>
var fassetview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fassetview = currentForm = new ew.Form("fassetview", "view");
	loadjs.done("fassetview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$asset_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $asset_view->ExportOptions->render("body") ?>
<?php $asset_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $asset_view->showPageHeader(); ?>
<?php
$asset_view->showMessage();
?>
<?php if (!$asset_view->IsModal) { ?>
<?php if (!$asset_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fassetview" id="fassetview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset">
<input type="hidden" name="modal" value="<?php echo (int)$asset_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($asset_view->AssetCode->Visible) { // AssetCode ?>
	<tr id="r_AssetCode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_AssetCode"><?php echo $asset_view->AssetCode->caption() ?></span></td>
		<td data-name="AssetCode" <?php echo $asset_view->AssetCode->cellAttributes() ?>>
<span id="el_asset_AssetCode">
<span<?php echo $asset_view->AssetCode->viewAttributes() ?>><?php echo $asset_view->AssetCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_ProvinceCode"><?php echo $asset_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $asset_view->ProvinceCode->cellAttributes() ?>>
<span id="el_asset_ProvinceCode">
<span<?php echo $asset_view->ProvinceCode->viewAttributes() ?>><?php echo $asset_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_LACode"><?php echo $asset_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $asset_view->LACode->cellAttributes() ?>>
<span id="el_asset_LACode">
<span<?php echo $asset_view->LACode->viewAttributes() ?>><?php echo $asset_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_DepartmentCode"><?php echo $asset_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $asset_view->DepartmentCode->cellAttributes() ?>>
<span id="el_asset_DepartmentCode">
<span<?php echo $asset_view->DepartmentCode->viewAttributes() ?>><?php echo $asset_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_SectionCode"><?php echo $asset_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $asset_view->SectionCode->cellAttributes() ?>>
<span id="el_asset_SectionCode">
<span<?php echo $asset_view->SectionCode->viewAttributes() ?>><?php echo $asset_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<tr id="r_AssetTypeCode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_AssetTypeCode"><?php echo $asset_view->AssetTypeCode->caption() ?></span></td>
		<td data-name="AssetTypeCode" <?php echo $asset_view->AssetTypeCode->cellAttributes() ?>>
<span id="el_asset_AssetTypeCode">
<span<?php echo $asset_view->AssetTypeCode->viewAttributes() ?>><?php echo $asset_view->AssetTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->Supplier->Visible) { // Supplier ?>
	<tr id="r_Supplier">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_Supplier"><?php echo $asset_view->Supplier->caption() ?></span></td>
		<td data-name="Supplier" <?php echo $asset_view->Supplier->cellAttributes() ?>>
<span id="el_asset_Supplier">
<span<?php echo $asset_view->Supplier->viewAttributes() ?>><?php echo $asset_view->Supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->PurchasePrice->Visible) { // PurchasePrice ?>
	<tr id="r_PurchasePrice">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_PurchasePrice"><?php echo $asset_view->PurchasePrice->caption() ?></span></td>
		<td data-name="PurchasePrice" <?php echo $asset_view->PurchasePrice->cellAttributes() ?>>
<span id="el_asset_PurchasePrice">
<span<?php echo $asset_view->PurchasePrice->viewAttributes() ?>><?php echo $asset_view->PurchasePrice->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->CurrencyCode->Visible) { // CurrencyCode ?>
	<tr id="r_CurrencyCode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_CurrencyCode"><?php echo $asset_view->CurrencyCode->caption() ?></span></td>
		<td data-name="CurrencyCode" <?php echo $asset_view->CurrencyCode->cellAttributes() ?>>
<span id="el_asset_CurrencyCode">
<span<?php echo $asset_view->CurrencyCode->viewAttributes() ?>><?php echo $asset_view->CurrencyCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->ConditionCode->Visible) { // ConditionCode ?>
	<tr id="r_ConditionCode">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_ConditionCode"><?php echo $asset_view->ConditionCode->caption() ?></span></td>
		<td data-name="ConditionCode" <?php echo $asset_view->ConditionCode->cellAttributes() ?>>
<span id="el_asset_ConditionCode">
<span<?php echo $asset_view->ConditionCode->viewAttributes() ?>><?php echo $asset_view->ConditionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<tr id="r_DateOfPurchase">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_DateOfPurchase"><?php echo $asset_view->DateOfPurchase->caption() ?></span></td>
		<td data-name="DateOfPurchase" <?php echo $asset_view->DateOfPurchase->cellAttributes() ?>>
<span id="el_asset_DateOfPurchase">
<span<?php echo $asset_view->DateOfPurchase->viewAttributes() ?>><?php echo $asset_view->DateOfPurchase->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->AssetCapacity->Visible) { // AssetCapacity ?>
	<tr id="r_AssetCapacity">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_AssetCapacity"><?php echo $asset_view->AssetCapacity->caption() ?></span></td>
		<td data-name="AssetCapacity" <?php echo $asset_view->AssetCapacity->cellAttributes() ?>>
<span id="el_asset_AssetCapacity">
<span<?php echo $asset_view->AssetCapacity->viewAttributes() ?>><?php echo $asset_view->AssetCapacity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<tr id="r_UnitOfMeasure">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_UnitOfMeasure"><?php echo $asset_view->UnitOfMeasure->caption() ?></span></td>
		<td data-name="UnitOfMeasure" <?php echo $asset_view->UnitOfMeasure->cellAttributes() ?>>
<span id="el_asset_UnitOfMeasure">
<span<?php echo $asset_view->UnitOfMeasure->viewAttributes() ?>><?php echo $asset_view->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->AssetDescription->Visible) { // AssetDescription ?>
	<tr id="r_AssetDescription">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_AssetDescription"><?php echo $asset_view->AssetDescription->caption() ?></span></td>
		<td data-name="AssetDescription" <?php echo $asset_view->AssetDescription->cellAttributes() ?>>
<span id="el_asset_AssetDescription">
<span<?php echo $asset_view->AssetDescription->viewAttributes() ?>><?php echo $asset_view->AssetDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<tr id="r_DateOfLastRevaluation">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_DateOfLastRevaluation"><?php echo $asset_view->DateOfLastRevaluation->caption() ?></span></td>
		<td data-name="DateOfLastRevaluation" <?php echo $asset_view->DateOfLastRevaluation->cellAttributes() ?>>
<span id="el_asset_DateOfLastRevaluation">
<span<?php echo $asset_view->DateOfLastRevaluation->viewAttributes() ?>><?php echo $asset_view->DateOfLastRevaluation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->NewValue->Visible) { // NewValue ?>
	<tr id="r_NewValue">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_NewValue"><?php echo $asset_view->NewValue->caption() ?></span></td>
		<td data-name="NewValue" <?php echo $asset_view->NewValue->cellAttributes() ?>>
<span id="el_asset_NewValue">
<span<?php echo $asset_view->NewValue->viewAttributes() ?>><?php echo $asset_view->NewValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->NameOfValuer->Visible) { // NameOfValuer ?>
	<tr id="r_NameOfValuer">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_NameOfValuer"><?php echo $asset_view->NameOfValuer->caption() ?></span></td>
		<td data-name="NameOfValuer" <?php echo $asset_view->NameOfValuer->cellAttributes() ?>>
<span id="el_asset_NameOfValuer">
<span<?php echo $asset_view->NameOfValuer->viewAttributes() ?>><?php echo $asset_view->NameOfValuer->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->BookValue->Visible) { // BookValue ?>
	<tr id="r_BookValue">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_BookValue"><?php echo $asset_view->BookValue->caption() ?></span></td>
		<td data-name="BookValue" <?php echo $asset_view->BookValue->cellAttributes() ?>>
<span id="el_asset_BookValue">
<span<?php echo $asset_view->BookValue->viewAttributes() ?>><?php echo $asset_view->BookValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<tr id="r_LastDepreciationDate">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_LastDepreciationDate"><?php echo $asset_view->LastDepreciationDate->caption() ?></span></td>
		<td data-name="LastDepreciationDate" <?php echo $asset_view->LastDepreciationDate->cellAttributes() ?>>
<span id="el_asset_LastDepreciationDate">
<span<?php echo $asset_view->LastDepreciationDate->viewAttributes() ?>><?php echo $asset_view->LastDepreciationDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<tr id="r_LastDepreciationAmount">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_LastDepreciationAmount"><?php echo $asset_view->LastDepreciationAmount->caption() ?></span></td>
		<td data-name="LastDepreciationAmount" <?php echo $asset_view->LastDepreciationAmount->cellAttributes() ?>>
<span id="el_asset_LastDepreciationAmount">
<span<?php echo $asset_view->LastDepreciationAmount->viewAttributes() ?>><?php echo $asset_view->LastDepreciationAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->DepreciationRate->Visible) { // DepreciationRate ?>
	<tr id="r_DepreciationRate">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_DepreciationRate"><?php echo $asset_view->DepreciationRate->caption() ?></span></td>
		<td data-name="DepreciationRate" <?php echo $asset_view->DepreciationRate->cellAttributes() ?>>
<span id="el_asset_DepreciationRate">
<span<?php echo $asset_view->DepreciationRate->viewAttributes() ?>><?php echo $asset_view->DepreciationRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<tr id="r_CumulativeDepreciation">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_CumulativeDepreciation"><?php echo $asset_view->CumulativeDepreciation->caption() ?></span></td>
		<td data-name="CumulativeDepreciation" <?php echo $asset_view->CumulativeDepreciation->cellAttributes() ?>>
<span id="el_asset_CumulativeDepreciation">
<span<?php echo $asset_view->CumulativeDepreciation->viewAttributes() ?>><?php echo $asset_view->CumulativeDepreciation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->AssetStatus->Visible) { // AssetStatus ?>
	<tr id="r_AssetStatus">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_AssetStatus"><?php echo $asset_view->AssetStatus->caption() ?></span></td>
		<td data-name="AssetStatus" <?php echo $asset_view->AssetStatus->cellAttributes() ?>>
<span id="el_asset_AssetStatus">
<span<?php echo $asset_view->AssetStatus->viewAttributes() ?>><?php echo $asset_view->AssetStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($asset_view->ScrapValue->Visible) { // ScrapValue ?>
	<tr id="r_ScrapValue">
		<td class="<?php echo $asset_view->TableLeftColumnClass ?>"><span id="elh_asset_ScrapValue"><?php echo $asset_view->ScrapValue->caption() ?></span></td>
		<td data-name="ScrapValue" <?php echo $asset_view->ScrapValue->cellAttributes() ?>>
<span id="el_asset_ScrapValue">
<span<?php echo $asset_view->ScrapValue->viewAttributes() ?>><?php echo $asset_view->ScrapValue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$asset_view->IsModal) { ?>
<?php if (!$asset_view->isExport()) { ?>
<?php echo $asset_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$asset_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$asset_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$asset_view->terminate();
?>