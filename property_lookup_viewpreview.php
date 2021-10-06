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
$property_lookup_view_preview = new property_lookup_view_preview();

// Run the page
$property_lookup_view_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_lookup_view_preview->Page_Render();
?>
<?php $property_lookup_view_preview->showPageHeader(); ?>
<?php if ($property_lookup_view_preview->TotalRecords > 0) { ?>
<div class="card ew-grid property_lookup_view"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$property_lookup_view_preview->renderListOptions();

// Render list options (header, left)
$property_lookup_view_preview->ListOptions->render("header", "left");
?>
<?php if ($property_lookup_view_preview->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->ValuationNo) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->ValuationNo->headerCellClass() ?>"><?php echo $property_lookup_view_preview->ValuationNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->ValuationNo->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->ValuationNo->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->ValuationNo->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->PropertyNo) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->PropertyNo->headerCellClass() ?>"><?php echo $property_lookup_view_preview->PropertyNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->PropertyNo->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->PropertyNo->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->PropertyNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->PropertyNo->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->ClientSerNo) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->ClientSerNo->headerCellClass() ?>"><?php echo $property_lookup_view_preview->ClientSerNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->ClientSerNo->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->ClientSerNo->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->ClientSerNo->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->PropertyUse) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->PropertyUse->headerCellClass() ?>"><?php echo $property_lookup_view_preview->PropertyUse->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->PropertyUse->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->PropertyUse->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->PropertyUse->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->Location->Visible) { // Location ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->Location) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->Location->headerCellClass() ?>"><?php echo $property_lookup_view_preview->Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->Location->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->Location->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->Location->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->ChargeCode) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->ChargeCode->headerCellClass() ?>"><?php echo $property_lookup_view_preview->ChargeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->ChargeCode->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->ChargeCode->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->ChargeCode->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->ChargeGroup) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->ChargeGroup->headerCellClass() ?>"><?php echo $property_lookup_view_preview->ChargeGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->ChargeGroup->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->ChargeGroup->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->ChargeGroup->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->BalanceBF) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->BalanceBF->headerCellClass() ?>"><?php echo $property_lookup_view_preview->BalanceBF->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->BalanceBF->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->BalanceBF->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->BalanceBF->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->CurrentDemand) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->CurrentDemand->headerCellClass() ?>"><?php echo $property_lookup_view_preview->CurrentDemand->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->CurrentDemand->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->CurrentDemand->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->CurrentDemand->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->VAT->Visible) { // VAT ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->VAT) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->VAT->headerCellClass() ?>"><?php echo $property_lookup_view_preview->VAT->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->VAT->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->VAT->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->VAT->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->VAT->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->AmountPaid->headerCellClass() ?>"><?php echo $property_lookup_view_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->AmountPaid->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->AmountPaid->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->BillPeriod) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->BillPeriod->headerCellClass() ?>"><?php echo $property_lookup_view_preview->BillPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->BillPeriod->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->BillPeriod->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->BillPeriod->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->PeriodType->Visible) { // PeriodType ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->PeriodType) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->PeriodType->headerCellClass() ?>"><?php echo $property_lookup_view_preview->PeriodType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->PeriodType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->PeriodType->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->PeriodType->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->PeriodType->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->BillYear->Visible) { // BillYear ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->BillYear) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->BillYear->headerCellClass() ?>"><?php echo $property_lookup_view_preview->BillYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->BillYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->BillYear->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->BillYear->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->BillYear->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->StartDate) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->StartDate->headerCellClass() ?>"><?php echo $property_lookup_view_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->StartDate->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->StartDate->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->StartDate->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->EndDate) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->EndDate->headerCellClass() ?>"><?php echo $property_lookup_view_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->EndDate->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->EndDate->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->EndDate->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->ChargeDesc) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->ChargeDesc->headerCellClass() ?>"><?php echo $property_lookup_view_preview->ChargeDesc->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->ChargeDesc->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->ChargeDesc->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->ChargeDesc->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->ChargeDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->ChargeDesc->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->Fee->Visible) { // Fee ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->Fee) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->Fee->headerCellClass() ?>"><?php echo $property_lookup_view_preview->Fee->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->Fee->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->Fee->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->Fee->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->Fee->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->Fee->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($property_lookup_view->SortUrl($property_lookup_view_preview->UnitOfMeasure) == "") { ?>
		<th class="<?php echo $property_lookup_view_preview->UnitOfMeasure->headerCellClass() ?>"><?php echo $property_lookup_view_preview->UnitOfMeasure->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_lookup_view_preview->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_lookup_view_preview->UnitOfMeasure->Name) ?>" data-sort-order="<?php echo $property_lookup_view_preview->SortField == $property_lookup_view_preview->UnitOfMeasure->Name && $property_lookup_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_preview->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_preview->SortField == $property_lookup_view_preview->UnitOfMeasure->Name) { ?><?php if ($property_lookup_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_lookup_view_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$property_lookup_view_preview->RecCount = 0;
$property_lookup_view_preview->RowCount = 0;
while ($property_lookup_view_preview->Recordset && !$property_lookup_view_preview->Recordset->EOF) {

	// Init row class and style
	$property_lookup_view_preview->RecCount++;
	$property_lookup_view_preview->RowCount++;
	$property_lookup_view_preview->CssStyle = "";
	$property_lookup_view_preview->loadListRowValues($property_lookup_view_preview->Recordset);

	// Render row
	$property_lookup_view->RowType = ROWTYPE_PREVIEW; // Preview record
	$property_lookup_view_preview->resetAttributes();
	$property_lookup_view_preview->renderListRow();

	// Render list options
	$property_lookup_view_preview->renderListOptions();
?>
	<tr <?php echo $property_lookup_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_lookup_view_preview->ListOptions->render("body", "left", $property_lookup_view_preview->RowCount);
?>
<?php if ($property_lookup_view_preview->ValuationNo->Visible) { // ValuationNo ?>
		<!-- ValuationNo -->
		<td<?php echo $property_lookup_view_preview->ValuationNo->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->ValuationNo->viewAttributes() ?>><?php echo $property_lookup_view_preview->ValuationNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->PropertyNo->Visible) { // PropertyNo ?>
		<!-- PropertyNo -->
		<td<?php echo $property_lookup_view_preview->PropertyNo->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->PropertyNo->viewAttributes() ?>><?php echo $property_lookup_view_preview->PropertyNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->ClientSerNo->Visible) { // ClientSerNo ?>
		<!-- ClientSerNo -->
		<td<?php echo $property_lookup_view_preview->ClientSerNo->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->ClientSerNo->viewAttributes() ?>><?php echo $property_lookup_view_preview->ClientSerNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->PropertyUse->Visible) { // PropertyUse ?>
		<!-- PropertyUse -->
		<td<?php echo $property_lookup_view_preview->PropertyUse->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->PropertyUse->viewAttributes() ?>><?php echo $property_lookup_view_preview->PropertyUse->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->Location->Visible) { // Location ?>
		<!-- Location -->
		<td<?php echo $property_lookup_view_preview->Location->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->Location->viewAttributes() ?>><?php echo $property_lookup_view_preview->Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td<?php echo $property_lookup_view_preview->ChargeCode->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->ChargeCode->viewAttributes() ?>><?php echo $property_lookup_view_preview->ChargeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td<?php echo $property_lookup_view_preview->ChargeGroup->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->ChargeGroup->viewAttributes() ?>><?php echo $property_lookup_view_preview->ChargeGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->BalanceBF->Visible) { // BalanceBF ?>
		<!-- BalanceBF -->
		<td<?php echo $property_lookup_view_preview->BalanceBF->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->BalanceBF->viewAttributes() ?>><?php echo $property_lookup_view_preview->BalanceBF->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->CurrentDemand->Visible) { // CurrentDemand ?>
		<!-- CurrentDemand -->
		<td<?php echo $property_lookup_view_preview->CurrentDemand->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->CurrentDemand->viewAttributes() ?>><?php echo $property_lookup_view_preview->CurrentDemand->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->VAT->Visible) { // VAT ?>
		<!-- VAT -->
		<td<?php echo $property_lookup_view_preview->VAT->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->VAT->viewAttributes() ?>><?php echo $property_lookup_view_preview->VAT->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $property_lookup_view_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->AmountPaid->viewAttributes() ?>><?php echo $property_lookup_view_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td<?php echo $property_lookup_view_preview->BillPeriod->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->BillPeriod->viewAttributes() ?>><?php echo $property_lookup_view_preview->BillPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->PeriodType->Visible) { // PeriodType ?>
		<!-- PeriodType -->
		<td<?php echo $property_lookup_view_preview->PeriodType->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->PeriodType->viewAttributes() ?>><?php echo $property_lookup_view_preview->PeriodType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td<?php echo $property_lookup_view_preview->BillYear->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->BillYear->viewAttributes() ?>><?php echo $property_lookup_view_preview->BillYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $property_lookup_view_preview->StartDate->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->StartDate->viewAttributes() ?>><?php echo $property_lookup_view_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $property_lookup_view_preview->EndDate->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->EndDate->viewAttributes() ?>><?php echo $property_lookup_view_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->ChargeDesc->Visible) { // ChargeDesc ?>
		<!-- ChargeDesc -->
		<td<?php echo $property_lookup_view_preview->ChargeDesc->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->ChargeDesc->viewAttributes() ?>><?php echo $property_lookup_view_preview->ChargeDesc->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->Fee->Visible) { // Fee ?>
		<!-- Fee -->
		<td<?php echo $property_lookup_view_preview->Fee->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->Fee->viewAttributes() ?>><?php echo $property_lookup_view_preview->Fee->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_lookup_view_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td<?php echo $property_lookup_view_preview->UnitOfMeasure->cellAttributes() ?>>
<span<?php echo $property_lookup_view_preview->UnitOfMeasure->viewAttributes() ?>><?php echo $property_lookup_view_preview->UnitOfMeasure->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$property_lookup_view_preview->ListOptions->render("body", "right", $property_lookup_view_preview->RowCount);
?>
	</tr>
<?php
	$property_lookup_view_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $property_lookup_view_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($property_lookup_view_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($property_lookup_view_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$property_lookup_view_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($property_lookup_view_preview->Recordset)
	$property_lookup_view_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$property_lookup_view_preview->terminate();
?>