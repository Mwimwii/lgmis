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
WriteHeader(FALSE, "utf-8");

// Create page object
$asset_preview = new asset_preview();

// Run the page
$asset_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_preview->Page_Render();
?>
<?php $asset_preview->showPageHeader(); ?>
<?php if ($asset_preview->TotalRecords > 0) { ?>
<div class="card ew-grid asset"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$asset_preview->renderListOptions();

// Render list options (header, left)
$asset_preview->ListOptions->render("header", "left");
?>
<?php if ($asset_preview->AssetCode->Visible) { // AssetCode ?>
	<?php if ($asset->SortUrl($asset_preview->AssetCode) == "") { ?>
		<th class="<?php echo $asset_preview->AssetCode->headerCellClass() ?>"><?php echo $asset_preview->AssetCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->AssetCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->AssetCode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->AssetCode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->AssetCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->AssetCode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($asset->SortUrl($asset_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $asset_preview->ProvinceCode->headerCellClass() ?>"><?php echo $asset_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->ProvinceCode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->ProvinceCode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->LACode->Visible) { // LACode ?>
	<?php if ($asset->SortUrl($asset_preview->LACode) == "") { ?>
		<th class="<?php echo $asset_preview->LACode->headerCellClass() ?>"><?php echo $asset_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->LACode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->LACode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->LACode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($asset->SortUrl($asset_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $asset_preview->DepartmentCode->headerCellClass() ?>"><?php echo $asset_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->DepartmentCode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->DepartmentCode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($asset->SortUrl($asset_preview->SectionCode) == "") { ?>
		<th class="<?php echo $asset_preview->SectionCode->headerCellClass() ?>"><?php echo $asset_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->SectionCode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->SectionCode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<?php if ($asset->SortUrl($asset_preview->AssetTypeCode) == "") { ?>
		<th class="<?php echo $asset_preview->AssetTypeCode->headerCellClass() ?>"><?php echo $asset_preview->AssetTypeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->AssetTypeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->AssetTypeCode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->AssetTypeCode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->AssetTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->AssetTypeCode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->Supplier->Visible) { // Supplier ?>
	<?php if ($asset->SortUrl($asset_preview->Supplier) == "") { ?>
		<th class="<?php echo $asset_preview->Supplier->headerCellClass() ?>"><?php echo $asset_preview->Supplier->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->Supplier->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->Supplier->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->Supplier->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->Supplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->Supplier->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->PurchasePrice->Visible) { // PurchasePrice ?>
	<?php if ($asset->SortUrl($asset_preview->PurchasePrice) == "") { ?>
		<th class="<?php echo $asset_preview->PurchasePrice->headerCellClass() ?>"><?php echo $asset_preview->PurchasePrice->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->PurchasePrice->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->PurchasePrice->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->PurchasePrice->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->PurchasePrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->PurchasePrice->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->CurrencyCode->Visible) { // CurrencyCode ?>
	<?php if ($asset->SortUrl($asset_preview->CurrencyCode) == "") { ?>
		<th class="<?php echo $asset_preview->CurrencyCode->headerCellClass() ?>"><?php echo $asset_preview->CurrencyCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->CurrencyCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->CurrencyCode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->CurrencyCode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->CurrencyCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->CurrencyCode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->ConditionCode->Visible) { // ConditionCode ?>
	<?php if ($asset->SortUrl($asset_preview->ConditionCode) == "") { ?>
		<th class="<?php echo $asset_preview->ConditionCode->headerCellClass() ?>"><?php echo $asset_preview->ConditionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->ConditionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->ConditionCode->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->ConditionCode->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->ConditionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->ConditionCode->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<?php if ($asset->SortUrl($asset_preview->DateOfPurchase) == "") { ?>
		<th class="<?php echo $asset_preview->DateOfPurchase->headerCellClass() ?>"><?php echo $asset_preview->DateOfPurchase->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->DateOfPurchase->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->DateOfPurchase->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->DateOfPurchase->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->DateOfPurchase->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->DateOfPurchase->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->AssetCapacity->Visible) { // AssetCapacity ?>
	<?php if ($asset->SortUrl($asset_preview->AssetCapacity) == "") { ?>
		<th class="<?php echo $asset_preview->AssetCapacity->headerCellClass() ?>"><?php echo $asset_preview->AssetCapacity->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->AssetCapacity->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->AssetCapacity->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->AssetCapacity->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->AssetCapacity->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->AssetCapacity->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($asset->SortUrl($asset_preview->UnitOfMeasure) == "") { ?>
		<th class="<?php echo $asset_preview->UnitOfMeasure->headerCellClass() ?>"><?php echo $asset_preview->UnitOfMeasure->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->UnitOfMeasure->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->UnitOfMeasure->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->UnitOfMeasure->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->AssetDescription->Visible) { // AssetDescription ?>
	<?php if ($asset->SortUrl($asset_preview->AssetDescription) == "") { ?>
		<th class="<?php echo $asset_preview->AssetDescription->headerCellClass() ?>"><?php echo $asset_preview->AssetDescription->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->AssetDescription->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->AssetDescription->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->AssetDescription->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->AssetDescription->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->AssetDescription->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<?php if ($asset->SortUrl($asset_preview->DateOfLastRevaluation) == "") { ?>
		<th class="<?php echo $asset_preview->DateOfLastRevaluation->headerCellClass() ?>"><?php echo $asset_preview->DateOfLastRevaluation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->DateOfLastRevaluation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->DateOfLastRevaluation->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->DateOfLastRevaluation->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->DateOfLastRevaluation->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->DateOfLastRevaluation->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->NewValue->Visible) { // NewValue ?>
	<?php if ($asset->SortUrl($asset_preview->NewValue) == "") { ?>
		<th class="<?php echo $asset_preview->NewValue->headerCellClass() ?>"><?php echo $asset_preview->NewValue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->NewValue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->NewValue->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->NewValue->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->NewValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->NewValue->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->NameOfValuer->Visible) { // NameOfValuer ?>
	<?php if ($asset->SortUrl($asset_preview->NameOfValuer) == "") { ?>
		<th class="<?php echo $asset_preview->NameOfValuer->headerCellClass() ?>"><?php echo $asset_preview->NameOfValuer->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->NameOfValuer->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->NameOfValuer->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->NameOfValuer->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->NameOfValuer->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->NameOfValuer->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->BookValue->Visible) { // BookValue ?>
	<?php if ($asset->SortUrl($asset_preview->BookValue) == "") { ?>
		<th class="<?php echo $asset_preview->BookValue->headerCellClass() ?>"><?php echo $asset_preview->BookValue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->BookValue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->BookValue->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->BookValue->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->BookValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->BookValue->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<?php if ($asset->SortUrl($asset_preview->LastDepreciationDate) == "") { ?>
		<th class="<?php echo $asset_preview->LastDepreciationDate->headerCellClass() ?>"><?php echo $asset_preview->LastDepreciationDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->LastDepreciationDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->LastDepreciationDate->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->LastDepreciationDate->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->LastDepreciationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->LastDepreciationDate->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<?php if ($asset->SortUrl($asset_preview->LastDepreciationAmount) == "") { ?>
		<th class="<?php echo $asset_preview->LastDepreciationAmount->headerCellClass() ?>"><?php echo $asset_preview->LastDepreciationAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->LastDepreciationAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->LastDepreciationAmount->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->LastDepreciationAmount->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->LastDepreciationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->LastDepreciationAmount->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->DepreciationRate->Visible) { // DepreciationRate ?>
	<?php if ($asset->SortUrl($asset_preview->DepreciationRate) == "") { ?>
		<th class="<?php echo $asset_preview->DepreciationRate->headerCellClass() ?>"><?php echo $asset_preview->DepreciationRate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->DepreciationRate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->DepreciationRate->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->DepreciationRate->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->DepreciationRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->DepreciationRate->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<?php if ($asset->SortUrl($asset_preview->CumulativeDepreciation) == "") { ?>
		<th class="<?php echo $asset_preview->CumulativeDepreciation->headerCellClass() ?>"><?php echo $asset_preview->CumulativeDepreciation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->CumulativeDepreciation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->CumulativeDepreciation->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->CumulativeDepreciation->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->CumulativeDepreciation->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->CumulativeDepreciation->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->AssetStatus->Visible) { // AssetStatus ?>
	<?php if ($asset->SortUrl($asset_preview->AssetStatus) == "") { ?>
		<th class="<?php echo $asset_preview->AssetStatus->headerCellClass() ?>"><?php echo $asset_preview->AssetStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->AssetStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->AssetStatus->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->AssetStatus->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->AssetStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->AssetStatus->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_preview->ScrapValue->Visible) { // ScrapValue ?>
	<?php if ($asset->SortUrl($asset_preview->ScrapValue) == "") { ?>
		<th class="<?php echo $asset_preview->ScrapValue->headerCellClass() ?>"><?php echo $asset_preview->ScrapValue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $asset_preview->ScrapValue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($asset_preview->ScrapValue->Name) ?>" data-sort-order="<?php echo $asset_preview->SortField == $asset_preview->ScrapValue->Name && $asset_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_preview->ScrapValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_preview->SortField == $asset_preview->ScrapValue->Name) { ?><?php if ($asset_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$asset_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$asset_preview->RecCount = 0;
$asset_preview->RowCount = 0;
while ($asset_preview->Recordset && !$asset_preview->Recordset->EOF) {

	// Init row class and style
	$asset_preview->RecCount++;
	$asset_preview->RowCount++;
	$asset_preview->CssStyle = "";
	$asset_preview->loadListRowValues($asset_preview->Recordset);

	// Render row
	$asset->RowType = ROWTYPE_PREVIEW; // Preview record
	$asset_preview->resetAttributes();
	$asset_preview->renderListRow();

	// Render list options
	$asset_preview->renderListOptions();
?>
	<tr <?php echo $asset->rowAttributes() ?>>
<?php

// Render list options (body, left)
$asset_preview->ListOptions->render("body", "left", $asset_preview->RowCount);
?>
<?php if ($asset_preview->AssetCode->Visible) { // AssetCode ?>
		<!-- AssetCode -->
		<td<?php echo $asset_preview->AssetCode->cellAttributes() ?>>
<span<?php echo $asset_preview->AssetCode->viewAttributes() ?>><?php echo $asset_preview->AssetCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $asset_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $asset_preview->ProvinceCode->viewAttributes() ?>><?php echo $asset_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $asset_preview->LACode->cellAttributes() ?>>
<span<?php echo $asset_preview->LACode->viewAttributes() ?>><?php echo $asset_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $asset_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $asset_preview->DepartmentCode->viewAttributes() ?>><?php echo $asset_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $asset_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $asset_preview->SectionCode->viewAttributes() ?>><?php echo $asset_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<!-- AssetTypeCode -->
		<td<?php echo $asset_preview->AssetTypeCode->cellAttributes() ?>>
<span<?php echo $asset_preview->AssetTypeCode->viewAttributes() ?>><?php echo $asset_preview->AssetTypeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->Supplier->Visible) { // Supplier ?>
		<!-- Supplier -->
		<td<?php echo $asset_preview->Supplier->cellAttributes() ?>>
<span<?php echo $asset_preview->Supplier->viewAttributes() ?>><?php echo $asset_preview->Supplier->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->PurchasePrice->Visible) { // PurchasePrice ?>
		<!-- PurchasePrice -->
		<td<?php echo $asset_preview->PurchasePrice->cellAttributes() ?>>
<span<?php echo $asset_preview->PurchasePrice->viewAttributes() ?>><?php echo $asset_preview->PurchasePrice->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->CurrencyCode->Visible) { // CurrencyCode ?>
		<!-- CurrencyCode -->
		<td<?php echo $asset_preview->CurrencyCode->cellAttributes() ?>>
<span<?php echo $asset_preview->CurrencyCode->viewAttributes() ?>><?php echo $asset_preview->CurrencyCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->ConditionCode->Visible) { // ConditionCode ?>
		<!-- ConditionCode -->
		<td<?php echo $asset_preview->ConditionCode->cellAttributes() ?>>
<span<?php echo $asset_preview->ConditionCode->viewAttributes() ?>><?php echo $asset_preview->ConditionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<!-- DateOfPurchase -->
		<td<?php echo $asset_preview->DateOfPurchase->cellAttributes() ?>>
<span<?php echo $asset_preview->DateOfPurchase->viewAttributes() ?>><?php echo $asset_preview->DateOfPurchase->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->AssetCapacity->Visible) { // AssetCapacity ?>
		<!-- AssetCapacity -->
		<td<?php echo $asset_preview->AssetCapacity->cellAttributes() ?>>
<span<?php echo $asset_preview->AssetCapacity->viewAttributes() ?>><?php echo $asset_preview->AssetCapacity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td<?php echo $asset_preview->UnitOfMeasure->cellAttributes() ?>>
<span<?php echo $asset_preview->UnitOfMeasure->viewAttributes() ?>><?php echo $asset_preview->UnitOfMeasure->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->AssetDescription->Visible) { // AssetDescription ?>
		<!-- AssetDescription -->
		<td<?php echo $asset_preview->AssetDescription->cellAttributes() ?>>
<span<?php echo $asset_preview->AssetDescription->viewAttributes() ?>><?php echo $asset_preview->AssetDescription->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<!-- DateOfLastRevaluation -->
		<td<?php echo $asset_preview->DateOfLastRevaluation->cellAttributes() ?>>
<span<?php echo $asset_preview->DateOfLastRevaluation->viewAttributes() ?>><?php echo $asset_preview->DateOfLastRevaluation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->NewValue->Visible) { // NewValue ?>
		<!-- NewValue -->
		<td<?php echo $asset_preview->NewValue->cellAttributes() ?>>
<span<?php echo $asset_preview->NewValue->viewAttributes() ?>><?php echo $asset_preview->NewValue->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->NameOfValuer->Visible) { // NameOfValuer ?>
		<!-- NameOfValuer -->
		<td<?php echo $asset_preview->NameOfValuer->cellAttributes() ?>>
<span<?php echo $asset_preview->NameOfValuer->viewAttributes() ?>><?php echo $asset_preview->NameOfValuer->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->BookValue->Visible) { // BookValue ?>
		<!-- BookValue -->
		<td<?php echo $asset_preview->BookValue->cellAttributes() ?>>
<span<?php echo $asset_preview->BookValue->viewAttributes() ?>><?php echo $asset_preview->BookValue->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<!-- LastDepreciationDate -->
		<td<?php echo $asset_preview->LastDepreciationDate->cellAttributes() ?>>
<span<?php echo $asset_preview->LastDepreciationDate->viewAttributes() ?>><?php echo $asset_preview->LastDepreciationDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<!-- LastDepreciationAmount -->
		<td<?php echo $asset_preview->LastDepreciationAmount->cellAttributes() ?>>
<span<?php echo $asset_preview->LastDepreciationAmount->viewAttributes() ?>><?php echo $asset_preview->LastDepreciationAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->DepreciationRate->Visible) { // DepreciationRate ?>
		<!-- DepreciationRate -->
		<td<?php echo $asset_preview->DepreciationRate->cellAttributes() ?>>
<span<?php echo $asset_preview->DepreciationRate->viewAttributes() ?>><?php echo $asset_preview->DepreciationRate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<!-- CumulativeDepreciation -->
		<td<?php echo $asset_preview->CumulativeDepreciation->cellAttributes() ?>>
<span<?php echo $asset_preview->CumulativeDepreciation->viewAttributes() ?>><?php echo $asset_preview->CumulativeDepreciation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->AssetStatus->Visible) { // AssetStatus ?>
		<!-- AssetStatus -->
		<td<?php echo $asset_preview->AssetStatus->cellAttributes() ?>>
<span<?php echo $asset_preview->AssetStatus->viewAttributes() ?>><?php echo $asset_preview->AssetStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($asset_preview->ScrapValue->Visible) { // ScrapValue ?>
		<!-- ScrapValue -->
		<td<?php echo $asset_preview->ScrapValue->cellAttributes() ?>>
<span<?php echo $asset_preview->ScrapValue->viewAttributes() ?>><?php echo $asset_preview->ScrapValue->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$asset_preview->ListOptions->render("body", "right", $asset_preview->RowCount);
?>
	</tr>
<?php
	$asset_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $asset_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($asset_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($asset_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$asset_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($asset_preview->Recordset)
	$asset_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$asset_preview->terminate();
?>