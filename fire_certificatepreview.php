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
$fire_certificate_preview = new fire_certificate_preview();

// Run the page
$fire_certificate_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fire_certificate_preview->Page_Render();
?>
<?php $fire_certificate_preview->showPageHeader(); ?>
<?php if ($fire_certificate_preview->TotalRecords > 0) { ?>
<div class="card ew-grid fire_certificate"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$fire_certificate_preview->renderListOptions();

// Render list options (header, left)
$fire_certificate_preview->ListOptions->render("header", "left");
?>
<?php if ($fire_certificate_preview->FireCertificateNo->Visible) { // FireCertificateNo ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->FireCertificateNo) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->FireCertificateNo->headerCellClass() ?>"><?php echo $fire_certificate_preview->FireCertificateNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->FireCertificateNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->FireCertificateNo->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->FireCertificateNo->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->FireCertificateNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->FireCertificateNo->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->LicenceNo->Visible) { // LicenceNo ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->LicenceNo) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->LicenceNo->headerCellClass() ?>"><?php echo $fire_certificate_preview->LicenceNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->LicenceNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->LicenceNo->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->LicenceNo->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->LicenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->LicenceNo->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->BusinessNo->Visible) { // BusinessNo ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->BusinessNo) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->BusinessNo->headerCellClass() ?>"><?php echo $fire_certificate_preview->BusinessNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->BusinessNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->BusinessNo->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->BusinessNo->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->BusinessNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->BusinessNo->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->InspectionDate->Visible) { // InspectionDate ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->InspectionDate) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->InspectionDate->headerCellClass() ?>"><?php echo $fire_certificate_preview->InspectionDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->InspectionDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->InspectionDate->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->InspectionDate->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->InspectionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->InspectionDate->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->InspectedBy->Visible) { // InspectedBy ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->InspectedBy) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->InspectedBy->headerCellClass() ?>"><?php echo $fire_certificate_preview->InspectedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->InspectedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->InspectedBy->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->InspectedBy->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->InspectedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->InspectedBy->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->ChargeCode) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->ChargeCode->headerCellClass() ?>"><?php echo $fire_certificate_preview->ChargeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->ChargeCode->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->ChargeCode->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->ChargeCode->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->ChargeGroup) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->ChargeGroup->headerCellClass() ?>"><?php echo $fire_certificate_preview->ChargeGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->ChargeGroup->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->ChargeGroup->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->ChargeGroup->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->BalanceBF) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->BalanceBF->headerCellClass() ?>"><?php echo $fire_certificate_preview->BalanceBF->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->BalanceBF->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->BalanceBF->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->BalanceBF->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->CurrentDemand) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->CurrentDemand->headerCellClass() ?>"><?php echo $fire_certificate_preview->CurrentDemand->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->CurrentDemand->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->CurrentDemand->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->CurrentDemand->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->VAT->Visible) { // VAT ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->VAT) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->VAT->headerCellClass() ?>"><?php echo $fire_certificate_preview->VAT->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->VAT->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->VAT->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->VAT->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->VAT->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->AmountPaid->headerCellClass() ?>"><?php echo $fire_certificate_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->AmountPaid->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->AmountPaid->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->BillPeriod) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->BillPeriod->headerCellClass() ?>"><?php echo $fire_certificate_preview->BillPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->BillPeriod->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->BillPeriod->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->BillPeriod->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->PeriodType->Visible) { // PeriodType ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->PeriodType) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->PeriodType->headerCellClass() ?>"><?php echo $fire_certificate_preview->PeriodType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->PeriodType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->PeriodType->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->PeriodType->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->PeriodType->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->BillYear->Visible) { // BillYear ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->BillYear) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->BillYear->headerCellClass() ?>"><?php echo $fire_certificate_preview->BillYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->BillYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->BillYear->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->BillYear->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->BillYear->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->StartDate) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->StartDate->headerCellClass() ?>"><?php echo $fire_certificate_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->StartDate->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->StartDate->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->StartDate->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->EndDate) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->EndDate->headerCellClass() ?>"><?php echo $fire_certificate_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->EndDate->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->EndDate->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->EndDate->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->LastUpdatedBy) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->LastUpdatedBy->headerCellClass() ?>"><?php echo $fire_certificate_preview->LastUpdatedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->LastUpdatedBy->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->LastUpdatedBy->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->LastUpdatedBy->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fire_certificate_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($fire_certificate->SortUrl($fire_certificate_preview->LastUpdateDate) == "") { ?>
		<th class="<?php echo $fire_certificate_preview->LastUpdateDate->headerCellClass() ?>"><?php echo $fire_certificate_preview->LastUpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $fire_certificate_preview->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($fire_certificate_preview->LastUpdateDate->Name) ?>" data-sort-order="<?php echo $fire_certificate_preview->SortField == $fire_certificate_preview->LastUpdateDate->Name && $fire_certificate_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fire_certificate_preview->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($fire_certificate_preview->SortField == $fire_certificate_preview->LastUpdateDate->Name) { ?><?php if ($fire_certificate_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($fire_certificate_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$fire_certificate_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$fire_certificate_preview->RecCount = 0;
$fire_certificate_preview->RowCount = 0;
while ($fire_certificate_preview->Recordset && !$fire_certificate_preview->Recordset->EOF) {

	// Init row class and style
	$fire_certificate_preview->RecCount++;
	$fire_certificate_preview->RowCount++;
	$fire_certificate_preview->CssStyle = "";
	$fire_certificate_preview->loadListRowValues($fire_certificate_preview->Recordset);

	// Render row
	$fire_certificate->RowType = ROWTYPE_PREVIEW; // Preview record
	$fire_certificate_preview->resetAttributes();
	$fire_certificate_preview->renderListRow();

	// Render list options
	$fire_certificate_preview->renderListOptions();
?>
	<tr <?php echo $fire_certificate->rowAttributes() ?>>
<?php

// Render list options (body, left)
$fire_certificate_preview->ListOptions->render("body", "left", $fire_certificate_preview->RowCount);
?>
<?php if ($fire_certificate_preview->FireCertificateNo->Visible) { // FireCertificateNo ?>
		<!-- FireCertificateNo -->
		<td<?php echo $fire_certificate_preview->FireCertificateNo->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->FireCertificateNo->viewAttributes() ?>><?php echo $fire_certificate_preview->FireCertificateNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->LicenceNo->Visible) { // LicenceNo ?>
		<!-- LicenceNo -->
		<td<?php echo $fire_certificate_preview->LicenceNo->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->LicenceNo->viewAttributes() ?>><?php echo $fire_certificate_preview->LicenceNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->BusinessNo->Visible) { // BusinessNo ?>
		<!-- BusinessNo -->
		<td<?php echo $fire_certificate_preview->BusinessNo->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->BusinessNo->viewAttributes() ?>><?php echo $fire_certificate_preview->BusinessNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->InspectionDate->Visible) { // InspectionDate ?>
		<!-- InspectionDate -->
		<td<?php echo $fire_certificate_preview->InspectionDate->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->InspectionDate->viewAttributes() ?>><?php echo $fire_certificate_preview->InspectionDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->InspectedBy->Visible) { // InspectedBy ?>
		<!-- InspectedBy -->
		<td<?php echo $fire_certificate_preview->InspectedBy->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->InspectedBy->viewAttributes() ?>><?php echo $fire_certificate_preview->InspectedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td<?php echo $fire_certificate_preview->ChargeCode->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->ChargeCode->viewAttributes() ?>><?php echo $fire_certificate_preview->ChargeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td<?php echo $fire_certificate_preview->ChargeGroup->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->ChargeGroup->viewAttributes() ?>><?php echo $fire_certificate_preview->ChargeGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->BalanceBF->Visible) { // BalanceBF ?>
		<!-- BalanceBF -->
		<td<?php echo $fire_certificate_preview->BalanceBF->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->BalanceBF->viewAttributes() ?>><?php echo $fire_certificate_preview->BalanceBF->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->CurrentDemand->Visible) { // CurrentDemand ?>
		<!-- CurrentDemand -->
		<td<?php echo $fire_certificate_preview->CurrentDemand->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->CurrentDemand->viewAttributes() ?>><?php echo $fire_certificate_preview->CurrentDemand->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->VAT->Visible) { // VAT ?>
		<!-- VAT -->
		<td<?php echo $fire_certificate_preview->VAT->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->VAT->viewAttributes() ?>><?php echo $fire_certificate_preview->VAT->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $fire_certificate_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->AmountPaid->viewAttributes() ?>><?php echo $fire_certificate_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td<?php echo $fire_certificate_preview->BillPeriod->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->BillPeriod->viewAttributes() ?>><?php echo $fire_certificate_preview->BillPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->PeriodType->Visible) { // PeriodType ?>
		<!-- PeriodType -->
		<td<?php echo $fire_certificate_preview->PeriodType->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->PeriodType->viewAttributes() ?>><?php echo $fire_certificate_preview->PeriodType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td<?php echo $fire_certificate_preview->BillYear->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->BillYear->viewAttributes() ?>><?php echo $fire_certificate_preview->BillYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $fire_certificate_preview->StartDate->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->StartDate->viewAttributes() ?>><?php echo $fire_certificate_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $fire_certificate_preview->EndDate->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->EndDate->viewAttributes() ?>><?php echo $fire_certificate_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<!-- LastUpdatedBy -->
		<td<?php echo $fire_certificate_preview->LastUpdatedBy->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->LastUpdatedBy->viewAttributes() ?>><?php echo $fire_certificate_preview->LastUpdatedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($fire_certificate_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<!-- LastUpdateDate -->
		<td<?php echo $fire_certificate_preview->LastUpdateDate->cellAttributes() ?>>
<span<?php echo $fire_certificate_preview->LastUpdateDate->viewAttributes() ?>><?php echo $fire_certificate_preview->LastUpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$fire_certificate_preview->ListOptions->render("body", "right", $fire_certificate_preview->RowCount);
?>
	</tr>
<?php
	$fire_certificate_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $fire_certificate_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($fire_certificate_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($fire_certificate_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$fire_certificate_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($fire_certificate_preview->Recordset)
	$fire_certificate_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$fire_certificate_preview->terminate();
?>