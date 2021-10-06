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
$property_preview = new property_preview();

// Run the page
$property_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_preview->Page_Render();
?>
<?php $property_preview->showPageHeader(); ?>
<?php if ($property_preview->TotalRecords > 0) { ?>
<div class="card ew-grid property"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$property_preview->renderListOptions();

// Render list options (header, left)
$property_preview->ListOptions->render("header", "left");
?>
<?php if ($property_preview->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property->SortUrl($property_preview->PropertyNo) == "") { ?>
		<th class="<?php echo $property_preview->PropertyNo->headerCellClass() ?>"><?php echo $property_preview->PropertyNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->PropertyNo->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->PropertyNo->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->PropertyNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->PropertyNo->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property->SortUrl($property_preview->ClientSerNo) == "") { ?>
		<th class="<?php echo $property_preview->ClientSerNo->headerCellClass() ?>"><?php echo $property_preview->ClientSerNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ClientSerNo->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ClientSerNo->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ClientSerNo->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ClientID->Visible) { // ClientID ?>
	<?php if ($property->SortUrl($property_preview->ClientID) == "") { ?>
		<th class="<?php echo $property_preview->ClientID->headerCellClass() ?>"><?php echo $property_preview->ClientID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ClientID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ClientID->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ClientID->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ClientID->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($property->SortUrl($property_preview->PropertyGroup) == "") { ?>
		<th class="<?php echo $property_preview->PropertyGroup->headerCellClass() ?>"><?php echo $property_preview->PropertyGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->PropertyGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->PropertyGroup->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->PropertyGroup->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->PropertyGroup->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->PropertyType->Visible) { // PropertyType ?>
	<?php if ($property->SortUrl($property_preview->PropertyType) == "") { ?>
		<th class="<?php echo $property_preview->PropertyType->headerCellClass() ?>"><?php echo $property_preview->PropertyType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->PropertyType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->PropertyType->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->PropertyType->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->PropertyType->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->PropertyType->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Location->Visible) { // Location ?>
	<?php if ($property->SortUrl($property_preview->Location) == "") { ?>
		<th class="<?php echo $property_preview->Location->headerCellClass() ?>"><?php echo $property_preview->Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Location->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Location->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Location->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->PropertyStatus->Visible) { // PropertyStatus ?>
	<?php if ($property->SortUrl($property_preview->PropertyStatus) == "") { ?>
		<th class="<?php echo $property_preview->PropertyStatus->headerCellClass() ?>"><?php echo $property_preview->PropertyStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->PropertyStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->PropertyStatus->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->PropertyStatus->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->PropertyStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->PropertyStatus->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property->SortUrl($property_preview->PropertyUse) == "") { ?>
		<th class="<?php echo $property_preview->PropertyUse->headerCellClass() ?>"><?php echo $property_preview->PropertyUse->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->PropertyUse->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->PropertyUse->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->PropertyUse->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<?php if ($property->SortUrl($property_preview->LandExtentInHA) == "") { ?>
		<th class="<?php echo $property_preview->LandExtentInHA->headerCellClass() ?>"><?php echo $property_preview->LandExtentInHA->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->LandExtentInHA->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->LandExtentInHA->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->LandExtentInHA->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->LandExtentInHA->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->LandExtentInHA->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->RateableValue->Visible) { // RateableValue ?>
	<?php if ($property->SortUrl($property_preview->RateableValue) == "") { ?>
		<th class="<?php echo $property_preview->RateableValue->headerCellClass() ?>"><?php echo $property_preview->RateableValue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->RateableValue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->RateableValue->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->RateableValue->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->RateableValue->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<?php if ($property->SortUrl($property_preview->SupplementaryValue) == "") { ?>
		<th class="<?php echo $property_preview->SupplementaryValue->headerCellClass() ?>"><?php echo $property_preview->SupplementaryValue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->SupplementaryValue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->SupplementaryValue->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->SupplementaryValue->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->SupplementaryValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->SupplementaryValue->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($property->SortUrl($property_preview->ExemptCode) == "") { ?>
		<th class="<?php echo $property_preview->ExemptCode->headerCellClass() ?>"><?php echo $property_preview->ExemptCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ExemptCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ExemptCode->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ExemptCode->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ExemptCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ExemptCode->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Improvements->Visible) { // Improvements ?>
	<?php if ($property->SortUrl($property_preview->Improvements) == "") { ?>
		<th class="<?php echo $property_preview->Improvements->headerCellClass() ?>"><?php echo $property_preview->Improvements->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Improvements->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Improvements->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Improvements->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Improvements->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Improvements->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->StreetAddress->Visible) { // StreetAddress ?>
	<?php if ($property->SortUrl($property_preview->StreetAddress) == "") { ?>
		<th class="<?php echo $property_preview->StreetAddress->headerCellClass() ?>"><?php echo $property_preview->StreetAddress->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->StreetAddress->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->StreetAddress->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->StreetAddress->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->StreetAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->StreetAddress->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Longitude->Visible) { // Longitude ?>
	<?php if ($property->SortUrl($property_preview->Longitude) == "") { ?>
		<th class="<?php echo $property_preview->Longitude->headerCellClass() ?>"><?php echo $property_preview->Longitude->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Longitude->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Longitude->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Longitude->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Longitude->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Latitude->Visible) { // Latitude ?>
	<?php if ($property->SortUrl($property_preview->Latitude) == "") { ?>
		<th class="<?php echo $property_preview->Latitude->headerCellClass() ?>"><?php echo $property_preview->Latitude->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Latitude->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Latitude->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Latitude->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Latitude->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Incumberance->Visible) { // Incumberance ?>
	<?php if ($property->SortUrl($property_preview->Incumberance) == "") { ?>
		<th class="<?php echo $property_preview->Incumberance->headerCellClass() ?>"><?php echo $property_preview->Incumberance->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Incumberance->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Incumberance->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Incumberance->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Incumberance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Incumberance->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<?php if ($property->SortUrl($property_preview->SubDivisionOf) == "") { ?>
		<th class="<?php echo $property_preview->SubDivisionOf->headerCellClass() ?>"><?php echo $property_preview->SubDivisionOf->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->SubDivisionOf->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->SubDivisionOf->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->SubDivisionOf->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->SubDivisionOf->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->SubDivisionOf->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($property->SortUrl($property_preview->LastUpdatedBy) == "") { ?>
		<th class="<?php echo $property_preview->LastUpdatedBy->headerCellClass() ?>"><?php echo $property_preview->LastUpdatedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->LastUpdatedBy->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->LastUpdatedBy->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->LastUpdatedBy->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($property->SortUrl($property_preview->LastUpdateDate) == "") { ?>
		<th class="<?php echo $property_preview->LastUpdateDate->headerCellClass() ?>"><?php echo $property_preview->LastUpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->LastUpdateDate->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->LastUpdateDate->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->LastUpdateDate->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property->SortUrl($property_preview->ValuationNo) == "") { ?>
		<th class="<?php echo $property_preview->ValuationNo->headerCellClass() ?>"><?php echo $property_preview->ValuationNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ValuationNo->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ValuationNo->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ValuationNo->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->LandValue->Visible) { // LandValue ?>
	<?php if ($property->SortUrl($property_preview->LandValue) == "") { ?>
		<th class="<?php echo $property_preview->LandValue->headerCellClass() ?>"><?php echo $property_preview->LandValue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->LandValue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->LandValue->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->LandValue->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->LandValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->LandValue->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<?php if ($property->SortUrl($property_preview->ImprovementsValue) == "") { ?>
		<th class="<?php echo $property_preview->ImprovementsValue->headerCellClass() ?>"><?php echo $property_preview->ImprovementsValue->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ImprovementsValue->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ImprovementsValue->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ImprovementsValue->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ImprovementsValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ImprovementsValue->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$property_preview->RecCount = 0;
$property_preview->RowCount = 0;
while ($property_preview->Recordset && !$property_preview->Recordset->EOF) {

	// Init row class and style
	$property_preview->RecCount++;
	$property_preview->RowCount++;
	$property_preview->CssStyle = "";
	$property_preview->loadListRowValues($property_preview->Recordset);

	// Render row
	$property->RowType = ROWTYPE_PREVIEW; // Preview record
	$property_preview->resetAttributes();
	$property_preview->renderListRow();

	// Render list options
	$property_preview->renderListOptions();
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_preview->ListOptions->render("body", "left", $property_preview->RowCount);
?>
<?php if ($property_preview->PropertyNo->Visible) { // PropertyNo ?>
		<!-- PropertyNo -->
		<td<?php echo $property_preview->PropertyNo->cellAttributes() ?>>
<span<?php echo $property_preview->PropertyNo->viewAttributes() ?>><?php echo $property_preview->PropertyNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ClientSerNo->Visible) { // ClientSerNo ?>
		<!-- ClientSerNo -->
		<td<?php echo $property_preview->ClientSerNo->cellAttributes() ?>>
<span<?php echo $property_preview->ClientSerNo->viewAttributes() ?>><?php echo $property_preview->ClientSerNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ClientID->Visible) { // ClientID ?>
		<!-- ClientID -->
		<td<?php echo $property_preview->ClientID->cellAttributes() ?>>
<span<?php echo $property_preview->ClientID->viewAttributes() ?>><?php echo $property_preview->ClientID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->PropertyGroup->Visible) { // PropertyGroup ?>
		<!-- PropertyGroup -->
		<td<?php echo $property_preview->PropertyGroup->cellAttributes() ?>>
<span<?php echo $property_preview->PropertyGroup->viewAttributes() ?>><?php echo $property_preview->PropertyGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->PropertyType->Visible) { // PropertyType ?>
		<!-- PropertyType -->
		<td<?php echo $property_preview->PropertyType->cellAttributes() ?>>
<span<?php echo $property_preview->PropertyType->viewAttributes() ?>><?php echo $property_preview->PropertyType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Location->Visible) { // Location ?>
		<!-- Location -->
		<td<?php echo $property_preview->Location->cellAttributes() ?>>
<span<?php echo $property_preview->Location->viewAttributes() ?>><?php echo $property_preview->Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->PropertyStatus->Visible) { // PropertyStatus ?>
		<!-- PropertyStatus -->
		<td<?php echo $property_preview->PropertyStatus->cellAttributes() ?>>
<span<?php echo $property_preview->PropertyStatus->viewAttributes() ?>><?php echo $property_preview->PropertyStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->PropertyUse->Visible) { // PropertyUse ?>
		<!-- PropertyUse -->
		<td<?php echo $property_preview->PropertyUse->cellAttributes() ?>>
<span<?php echo $property_preview->PropertyUse->viewAttributes() ?>><?php echo $property_preview->PropertyUse->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<!-- LandExtentInHA -->
		<td<?php echo $property_preview->LandExtentInHA->cellAttributes() ?>>
<span<?php echo $property_preview->LandExtentInHA->viewAttributes() ?>><?php echo $property_preview->LandExtentInHA->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->RateableValue->Visible) { // RateableValue ?>
		<!-- RateableValue -->
		<td<?php echo $property_preview->RateableValue->cellAttributes() ?>>
<span<?php echo $property_preview->RateableValue->viewAttributes() ?>><?php echo $property_preview->RateableValue->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<!-- SupplementaryValue -->
		<td<?php echo $property_preview->SupplementaryValue->cellAttributes() ?>>
<span<?php echo $property_preview->SupplementaryValue->viewAttributes() ?>><?php echo $property_preview->SupplementaryValue->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ExemptCode->Visible) { // ExemptCode ?>
		<!-- ExemptCode -->
		<td<?php echo $property_preview->ExemptCode->cellAttributes() ?>>
<span<?php echo $property_preview->ExemptCode->viewAttributes() ?>><?php echo $property_preview->ExemptCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Improvements->Visible) { // Improvements ?>
		<!-- Improvements -->
		<td<?php echo $property_preview->Improvements->cellAttributes() ?>>
<span<?php echo $property_preview->Improvements->viewAttributes() ?>><?php echo $property_preview->Improvements->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->StreetAddress->Visible) { // StreetAddress ?>
		<!-- StreetAddress -->
		<td<?php echo $property_preview->StreetAddress->cellAttributes() ?>>
<span<?php echo $property_preview->StreetAddress->viewAttributes() ?>><?php echo $property_preview->StreetAddress->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Longitude->Visible) { // Longitude ?>
		<!-- Longitude -->
		<td<?php echo $property_preview->Longitude->cellAttributes() ?>>
<span<?php echo $property_preview->Longitude->viewAttributes() ?>><?php echo $property_preview->Longitude->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Latitude->Visible) { // Latitude ?>
		<!-- Latitude -->
		<td<?php echo $property_preview->Latitude->cellAttributes() ?>>
<span<?php echo $property_preview->Latitude->viewAttributes() ?>><?php echo $property_preview->Latitude->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Incumberance->Visible) { // Incumberance ?>
		<!-- Incumberance -->
		<td<?php echo $property_preview->Incumberance->cellAttributes() ?>>
<span<?php echo $property_preview->Incumberance->viewAttributes() ?>><?php echo $property_preview->Incumberance->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->SubDivisionOf->Visible) { // SubDivisionOf ?>
		<!-- SubDivisionOf -->
		<td<?php echo $property_preview->SubDivisionOf->cellAttributes() ?>>
<span<?php echo $property_preview->SubDivisionOf->viewAttributes() ?>><?php echo $property_preview->SubDivisionOf->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<!-- LastUpdatedBy -->
		<td<?php echo $property_preview->LastUpdatedBy->cellAttributes() ?>>
<span<?php echo $property_preview->LastUpdatedBy->viewAttributes() ?>><?php echo $property_preview->LastUpdatedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<!-- LastUpdateDate -->
		<td<?php echo $property_preview->LastUpdateDate->cellAttributes() ?>>
<span<?php echo $property_preview->LastUpdateDate->viewAttributes() ?>><?php echo $property_preview->LastUpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ValuationNo->Visible) { // ValuationNo ?>
		<!-- ValuationNo -->
		<td<?php echo $property_preview->ValuationNo->cellAttributes() ?>>
<span<?php echo $property_preview->ValuationNo->viewAttributes() ?>><?php echo $property_preview->ValuationNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->LandValue->Visible) { // LandValue ?>
		<!-- LandValue -->
		<td<?php echo $property_preview->LandValue->cellAttributes() ?>>
<span<?php echo $property_preview->LandValue->viewAttributes() ?>><?php echo $property_preview->LandValue->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<!-- ImprovementsValue -->
		<td<?php echo $property_preview->ImprovementsValue->cellAttributes() ?>>
<span<?php echo $property_preview->ImprovementsValue->viewAttributes() ?>><?php echo $property_preview->ImprovementsValue->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$property_preview->ListOptions->render("body", "right", $property_preview->RowCount);
?>
	</tr>
<?php
	$property_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $property_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($property_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($property_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$property_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($property_preview->Recordset)
	$property_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$property_preview->terminate();
?>