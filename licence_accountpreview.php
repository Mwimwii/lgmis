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
$licence_account_preview = new licence_account_preview();

// Run the page
$licence_account_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$licence_account_preview->Page_Render();
?>
<?php $licence_account_preview->showPageHeader(); ?>
<?php if ($licence_account_preview->TotalRecords > 0) { ?>
<div class="card ew-grid licence_account"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$licence_account_preview->renderListOptions();

// Render list options (header, left)
$licence_account_preview->ListOptions->render("header", "left");
?>
<?php if ($licence_account_preview->LicenceNo->Visible) { // LicenceNo ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->LicenceNo) == "") { ?>
		<th class="<?php echo $licence_account_preview->LicenceNo->headerCellClass() ?>"><?php echo $licence_account_preview->LicenceNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->LicenceNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->LicenceNo->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->LicenceNo->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->LicenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->LicenceNo->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->BusinessNo->Visible) { // BusinessNo ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->BusinessNo) == "") { ?>
		<th class="<?php echo $licence_account_preview->BusinessNo->headerCellClass() ?>"><?php echo $licence_account_preview->BusinessNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->BusinessNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->BusinessNo->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->BusinessNo->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->BusinessNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->BusinessNo->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->ClientID->Visible) { // ClientID ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->ClientID) == "") { ?>
		<th class="<?php echo $licence_account_preview->ClientID->headerCellClass() ?>"><?php echo $licence_account_preview->ClientID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->ClientID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->ClientID->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->ClientID->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->ClientID->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->ChargeCode) == "") { ?>
		<th class="<?php echo $licence_account_preview->ChargeCode->headerCellClass() ?>"><?php echo $licence_account_preview->ChargeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->ChargeCode->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->ChargeCode->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->ChargeCode->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->ChargeGroup) == "") { ?>
		<th class="<?php echo $licence_account_preview->ChargeGroup->headerCellClass() ?>"><?php echo $licence_account_preview->ChargeGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->ChargeGroup->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->ChargeGroup->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->ChargeGroup->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->BalanceBF) == "") { ?>
		<th class="<?php echo $licence_account_preview->BalanceBF->headerCellClass() ?>"><?php echo $licence_account_preview->BalanceBF->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->BalanceBF->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->BalanceBF->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->BalanceBF->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->CurrentDemand) == "") { ?>
		<th class="<?php echo $licence_account_preview->CurrentDemand->headerCellClass() ?>"><?php echo $licence_account_preview->CurrentDemand->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->CurrentDemand->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->CurrentDemand->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->CurrentDemand->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->VAT->Visible) { // VAT ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->VAT) == "") { ?>
		<th class="<?php echo $licence_account_preview->VAT->headerCellClass() ?>"><?php echo $licence_account_preview->VAT->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->VAT->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->VAT->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->VAT->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->VAT->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $licence_account_preview->AmountPaid->headerCellClass() ?>"><?php echo $licence_account_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->AmountPaid->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->AmountPaid->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->BillPeriod) == "") { ?>
		<th class="<?php echo $licence_account_preview->BillPeriod->headerCellClass() ?>"><?php echo $licence_account_preview->BillPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->BillPeriod->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->BillPeriod->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->BillPeriod->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->PeriodType->Visible) { // PeriodType ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->PeriodType) == "") { ?>
		<th class="<?php echo $licence_account_preview->PeriodType->headerCellClass() ?>"><?php echo $licence_account_preview->PeriodType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->PeriodType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->PeriodType->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->PeriodType->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->PeriodType->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->BillYear->Visible) { // BillYear ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->BillYear) == "") { ?>
		<th class="<?php echo $licence_account_preview->BillYear->headerCellClass() ?>"><?php echo $licence_account_preview->BillYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->BillYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->BillYear->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->BillYear->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->BillYear->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->StartDate) == "") { ?>
		<th class="<?php echo $licence_account_preview->StartDate->headerCellClass() ?>"><?php echo $licence_account_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->StartDate->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->StartDate->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->StartDate->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->EndDate) == "") { ?>
		<th class="<?php echo $licence_account_preview->EndDate->headerCellClass() ?>"><?php echo $licence_account_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->EndDate->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->EndDate->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->EndDate->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->LastUpdatedBy) == "") { ?>
		<th class="<?php echo $licence_account_preview->LastUpdatedBy->headerCellClass() ?>"><?php echo $licence_account_preview->LastUpdatedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->LastUpdatedBy->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->LastUpdatedBy->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->LastUpdatedBy->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($licence_account->SortUrl($licence_account_preview->LastUpdateDate) == "") { ?>
		<th class="<?php echo $licence_account_preview->LastUpdateDate->headerCellClass() ?>"><?php echo $licence_account_preview->LastUpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $licence_account_preview->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($licence_account_preview->LastUpdateDate->Name) ?>" data-sort-order="<?php echo $licence_account_preview->SortField == $licence_account_preview->LastUpdateDate->Name && $licence_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_preview->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_preview->SortField == $licence_account_preview->LastUpdateDate->Name) { ?><?php if ($licence_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$licence_account_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$licence_account_preview->RecCount = 0;
$licence_account_preview->RowCount = 0;
while ($licence_account_preview->Recordset && !$licence_account_preview->Recordset->EOF) {

	// Init row class and style
	$licence_account_preview->RecCount++;
	$licence_account_preview->RowCount++;
	$licence_account_preview->CssStyle = "";
	$licence_account_preview->loadListRowValues($licence_account_preview->Recordset);

	// Render row
	$licence_account->RowType = ROWTYPE_PREVIEW; // Preview record
	$licence_account_preview->resetAttributes();
	$licence_account_preview->renderListRow();

	// Render list options
	$licence_account_preview->renderListOptions();
?>
	<tr <?php echo $licence_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$licence_account_preview->ListOptions->render("body", "left", $licence_account_preview->RowCount);
?>
<?php if ($licence_account_preview->LicenceNo->Visible) { // LicenceNo ?>
		<!-- LicenceNo -->
		<td<?php echo $licence_account_preview->LicenceNo->cellAttributes() ?>>
<span<?php echo $licence_account_preview->LicenceNo->viewAttributes() ?>><?php echo $licence_account_preview->LicenceNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->BusinessNo->Visible) { // BusinessNo ?>
		<!-- BusinessNo -->
		<td<?php echo $licence_account_preview->BusinessNo->cellAttributes() ?>>
<span<?php echo $licence_account_preview->BusinessNo->viewAttributes() ?>><?php echo $licence_account_preview->BusinessNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->ClientID->Visible) { // ClientID ?>
		<!-- ClientID -->
		<td<?php echo $licence_account_preview->ClientID->cellAttributes() ?>>
<span<?php echo $licence_account_preview->ClientID->viewAttributes() ?>><?php echo $licence_account_preview->ClientID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td<?php echo $licence_account_preview->ChargeCode->cellAttributes() ?>>
<span<?php echo $licence_account_preview->ChargeCode->viewAttributes() ?>><?php echo $licence_account_preview->ChargeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td<?php echo $licence_account_preview->ChargeGroup->cellAttributes() ?>>
<span<?php echo $licence_account_preview->ChargeGroup->viewAttributes() ?>><?php echo $licence_account_preview->ChargeGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->BalanceBF->Visible) { // BalanceBF ?>
		<!-- BalanceBF -->
		<td<?php echo $licence_account_preview->BalanceBF->cellAttributes() ?>>
<span<?php echo $licence_account_preview->BalanceBF->viewAttributes() ?>><?php echo $licence_account_preview->BalanceBF->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->CurrentDemand->Visible) { // CurrentDemand ?>
		<!-- CurrentDemand -->
		<td<?php echo $licence_account_preview->CurrentDemand->cellAttributes() ?>>
<span<?php echo $licence_account_preview->CurrentDemand->viewAttributes() ?>><?php echo $licence_account_preview->CurrentDemand->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->VAT->Visible) { // VAT ?>
		<!-- VAT -->
		<td<?php echo $licence_account_preview->VAT->cellAttributes() ?>>
<span<?php echo $licence_account_preview->VAT->viewAttributes() ?>><?php echo $licence_account_preview->VAT->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $licence_account_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $licence_account_preview->AmountPaid->viewAttributes() ?>><?php echo $licence_account_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td<?php echo $licence_account_preview->BillPeriod->cellAttributes() ?>>
<span<?php echo $licence_account_preview->BillPeriod->viewAttributes() ?>><?php echo $licence_account_preview->BillPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->PeriodType->Visible) { // PeriodType ?>
		<!-- PeriodType -->
		<td<?php echo $licence_account_preview->PeriodType->cellAttributes() ?>>
<span<?php echo $licence_account_preview->PeriodType->viewAttributes() ?>><?php echo $licence_account_preview->PeriodType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td<?php echo $licence_account_preview->BillYear->cellAttributes() ?>>
<span<?php echo $licence_account_preview->BillYear->viewAttributes() ?>><?php echo $licence_account_preview->BillYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $licence_account_preview->StartDate->cellAttributes() ?>>
<span<?php echo $licence_account_preview->StartDate->viewAttributes() ?>><?php echo $licence_account_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $licence_account_preview->EndDate->cellAttributes() ?>>
<span<?php echo $licence_account_preview->EndDate->viewAttributes() ?>><?php echo $licence_account_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<!-- LastUpdatedBy -->
		<td<?php echo $licence_account_preview->LastUpdatedBy->cellAttributes() ?>>
<span<?php echo $licence_account_preview->LastUpdatedBy->viewAttributes() ?>><?php echo $licence_account_preview->LastUpdatedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($licence_account_preview->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<!-- LastUpdateDate -->
		<td<?php echo $licence_account_preview->LastUpdateDate->cellAttributes() ?>>
<span<?php echo $licence_account_preview->LastUpdateDate->viewAttributes() ?>><?php echo $licence_account_preview->LastUpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$licence_account_preview->ListOptions->render("body", "right", $licence_account_preview->RowCount);
?>
	</tr>
<?php
	$licence_account_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $licence_account_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($licence_account_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($licence_account_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$licence_account_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($licence_account_preview->Recordset)
	$licence_account_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$licence_account_preview->terminate();
?>