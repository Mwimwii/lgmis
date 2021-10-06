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
$health_certificate_preview = new health_certificate_preview();

// Run the page
$health_certificate_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$health_certificate_preview->Page_Render();
?>
<?php $health_certificate_preview->showPageHeader(); ?>
<?php if ($health_certificate_preview->TotalRecords > 0) { ?>
<div class="card ew-grid health_certificate"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$health_certificate_preview->renderListOptions();

// Render list options (header, left)
$health_certificate_preview->ListOptions->render("header", "left");
?>
<?php if ($health_certificate_preview->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->HealthCertificateNo) == "") { ?>
		<th class="<?php echo $health_certificate_preview->HealthCertificateNo->headerCellClass() ?>"><?php echo $health_certificate_preview->HealthCertificateNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->HealthCertificateNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->HealthCertificateNo->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->HealthCertificateNo->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->HealthCertificateNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->HealthCertificateNo->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->LicenceNo->Visible) { // LicenceNo ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->LicenceNo) == "") { ?>
		<th class="<?php echo $health_certificate_preview->LicenceNo->headerCellClass() ?>"><?php echo $health_certificate_preview->LicenceNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->LicenceNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->LicenceNo->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->LicenceNo->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->LicenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->LicenceNo->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->BusinessNo->Visible) { // BusinessNo ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->BusinessNo) == "") { ?>
		<th class="<?php echo $health_certificate_preview->BusinessNo->headerCellClass() ?>"><?php echo $health_certificate_preview->BusinessNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->BusinessNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->BusinessNo->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->BusinessNo->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->BusinessNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->BusinessNo->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->InspectionDate->Visible) { // InspectionDate ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->InspectionDate) == "") { ?>
		<th class="<?php echo $health_certificate_preview->InspectionDate->headerCellClass() ?>"><?php echo $health_certificate_preview->InspectionDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->InspectionDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->InspectionDate->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->InspectionDate->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->InspectionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->InspectionDate->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->InspectedBy->Visible) { // InspectedBy ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->InspectedBy) == "") { ?>
		<th class="<?php echo $health_certificate_preview->InspectedBy->headerCellClass() ?>"><?php echo $health_certificate_preview->InspectedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->InspectedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->InspectedBy->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->InspectedBy->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->InspectedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->InspectedBy->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->ChargeCode) == "") { ?>
		<th class="<?php echo $health_certificate_preview->ChargeCode->headerCellClass() ?>"><?php echo $health_certificate_preview->ChargeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->ChargeCode->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->ChargeCode->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->ChargeCode->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->ChargeGroup) == "") { ?>
		<th class="<?php echo $health_certificate_preview->ChargeGroup->headerCellClass() ?>"><?php echo $health_certificate_preview->ChargeGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->ChargeGroup->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->ChargeGroup->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->ChargeGroup->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->BalanceBF) == "") { ?>
		<th class="<?php echo $health_certificate_preview->BalanceBF->headerCellClass() ?>"><?php echo $health_certificate_preview->BalanceBF->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->BalanceBF->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->BalanceBF->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->BalanceBF->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->CurrentDemand) == "") { ?>
		<th class="<?php echo $health_certificate_preview->CurrentDemand->headerCellClass() ?>"><?php echo $health_certificate_preview->CurrentDemand->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->CurrentDemand->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->CurrentDemand->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->CurrentDemand->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->VAT->Visible) { // VAT ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->VAT) == "") { ?>
		<th class="<?php echo $health_certificate_preview->VAT->headerCellClass() ?>"><?php echo $health_certificate_preview->VAT->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->VAT->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->VAT->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->VAT->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->VAT->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $health_certificate_preview->AmountPaid->headerCellClass() ?>"><?php echo $health_certificate_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->AmountPaid->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->AmountPaid->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->BillPeriod) == "") { ?>
		<th class="<?php echo $health_certificate_preview->BillPeriod->headerCellClass() ?>"><?php echo $health_certificate_preview->BillPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->BillPeriod->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->BillPeriod->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->BillPeriod->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->PeriodType->Visible) { // PeriodType ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->PeriodType) == "") { ?>
		<th class="<?php echo $health_certificate_preview->PeriodType->headerCellClass() ?>"><?php echo $health_certificate_preview->PeriodType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->PeriodType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->PeriodType->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->PeriodType->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->PeriodType->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->BillYear->Visible) { // BillYear ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->BillYear) == "") { ?>
		<th class="<?php echo $health_certificate_preview->BillYear->headerCellClass() ?>"><?php echo $health_certificate_preview->BillYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->BillYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->BillYear->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->BillYear->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->BillYear->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->StartDate) == "") { ?>
		<th class="<?php echo $health_certificate_preview->StartDate->headerCellClass() ?>"><?php echo $health_certificate_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->StartDate->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->StartDate->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->StartDate->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->EndDate) == "") { ?>
		<th class="<?php echo $health_certificate_preview->EndDate->headerCellClass() ?>"><?php echo $health_certificate_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->EndDate->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->EndDate->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->EndDate->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->LastUpdatedBy) == "") { ?>
		<th class="<?php echo $health_certificate_preview->LastUpdatedBy->headerCellClass() ?>"><?php echo $health_certificate_preview->LastUpdatedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->LastUpdatedBy->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->LastUpdatedBy->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->LastUpdatedBy->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($health_certificate->SortUrl($health_certificate_preview->LastUpdateDate) == "") { ?>
		<th class="<?php echo $health_certificate_preview->LastUpdateDate->headerCellClass() ?>"><?php echo $health_certificate_preview->LastUpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $health_certificate_preview->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($health_certificate_preview->LastUpdateDate->Name) ?>" data-sort-order="<?php echo $health_certificate_preview->SortField == $health_certificate_preview->LastUpdateDate->Name && $health_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_preview->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_preview->SortField == $health_certificate_preview->LastUpdateDate->Name) { ?><?php if ($health_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$health_certificate_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$health_certificate_preview->RecCount = 0;
$health_certificate_preview->RowCount = 0;
while ($health_certificate_preview->Recordset && !$health_certificate_preview->Recordset->EOF) {

	// Init row class and style
	$health_certificate_preview->RecCount++;
	$health_certificate_preview->RowCount++;
	$health_certificate_preview->CssStyle = "";
	$health_certificate_preview->loadListRowValues($health_certificate_preview->Recordset);

	// Render row
	$health_certificate->RowType = ROWTYPE_PREVIEW; // Preview record
	$health_certificate_preview->resetAttributes();
	$health_certificate_preview->renderListRow();

	// Render list options
	$health_certificate_preview->renderListOptions();
?>
	<tr <?php echo $health_certificate->rowAttributes() ?>>
<?php

// Render list options (body, left)
$health_certificate_preview->ListOptions->render("body", "left", $health_certificate_preview->RowCount);
?>
<?php if ($health_certificate_preview->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
		<!-- HealthCertificateNo -->
		<td<?php echo $health_certificate_preview->HealthCertificateNo->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->HealthCertificateNo->viewAttributes() ?>><?php echo $health_certificate_preview->HealthCertificateNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->LicenceNo->Visible) { // LicenceNo ?>
		<!-- LicenceNo -->
		<td<?php echo $health_certificate_preview->LicenceNo->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->LicenceNo->viewAttributes() ?>><?php echo $health_certificate_preview->LicenceNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->BusinessNo->Visible) { // BusinessNo ?>
		<!-- BusinessNo -->
		<td<?php echo $health_certificate_preview->BusinessNo->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->BusinessNo->viewAttributes() ?>><?php echo $health_certificate_preview->BusinessNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->InspectionDate->Visible) { // InspectionDate ?>
		<!-- InspectionDate -->
		<td<?php echo $health_certificate_preview->InspectionDate->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->InspectionDate->viewAttributes() ?>><?php echo $health_certificate_preview->InspectionDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->InspectedBy->Visible) { // InspectedBy ?>
		<!-- InspectedBy -->
		<td<?php echo $health_certificate_preview->InspectedBy->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->InspectedBy->viewAttributes() ?>><?php echo $health_certificate_preview->InspectedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td<?php echo $health_certificate_preview->ChargeCode->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->ChargeCode->viewAttributes() ?>><?php echo $health_certificate_preview->ChargeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td<?php echo $health_certificate_preview->ChargeGroup->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->ChargeGroup->viewAttributes() ?>><?php echo $health_certificate_preview->ChargeGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->BalanceBF->Visible) { // BalanceBF ?>
		<!-- BalanceBF -->
		<td<?php echo $health_certificate_preview->BalanceBF->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->BalanceBF->viewAttributes() ?>><?php echo $health_certificate_preview->BalanceBF->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->CurrentDemand->Visible) { // CurrentDemand ?>
		<!-- CurrentDemand -->
		<td<?php echo $health_certificate_preview->CurrentDemand->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->CurrentDemand->viewAttributes() ?>><?php echo $health_certificate_preview->CurrentDemand->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->VAT->Visible) { // VAT ?>
		<!-- VAT -->
		<td<?php echo $health_certificate_preview->VAT->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->VAT->viewAttributes() ?>><?php echo $health_certificate_preview->VAT->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $health_certificate_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->AmountPaid->viewAttributes() ?>><?php echo $health_certificate_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td<?php echo $health_certificate_preview->BillPeriod->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->BillPeriod->viewAttributes() ?>><?php echo $health_certificate_preview->BillPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->PeriodType->Visible) { // PeriodType ?>
		<!-- PeriodType -->
		<td<?php echo $health_certificate_preview->PeriodType->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->PeriodType->viewAttributes() ?>><?php echo $health_certificate_preview->PeriodType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td<?php echo $health_certificate_preview->BillYear->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->BillYear->viewAttributes() ?>><?php echo $health_certificate_preview->BillYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $health_certificate_preview->StartDate->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->StartDate->viewAttributes() ?>><?php echo $health_certificate_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $health_certificate_preview->EndDate->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->EndDate->viewAttributes() ?>><?php echo $health_certificate_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<!-- LastUpdatedBy -->
		<td<?php echo $health_certificate_preview->LastUpdatedBy->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->LastUpdatedBy->viewAttributes() ?>><?php echo $health_certificate_preview->LastUpdatedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($health_certificate_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<!-- LastUpdateDate -->
		<td<?php echo $health_certificate_preview->LastUpdateDate->cellAttributes() ?>>
<span<?php echo $health_certificate_preview->LastUpdateDate->viewAttributes() ?>><?php echo $health_certificate_preview->LastUpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$health_certificate_preview->ListOptions->render("body", "right", $health_certificate_preview->RowCount);
?>
	</tr>
<?php
	$health_certificate_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $health_certificate_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($health_certificate_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($health_certificate_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$health_certificate_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($health_certificate_preview->Recordset)
	$health_certificate_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$health_certificate_preview->terminate();
?>