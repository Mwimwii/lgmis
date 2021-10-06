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
$receipts_view_preview = new receipts_view_preview();

// Run the page
$receipts_view_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipts_view_preview->Page_Render();
?>
<?php $receipts_view_preview->showPageHeader(); ?>
<?php if ($receipts_view_preview->TotalRecords > 0) { ?>
<div class="card ew-grid receipts_view"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$receipts_view_preview->renderListOptions();

// Render list options (header, left)
$receipts_view_preview->ListOptions->render("header", "left");
?>
<?php if ($receipts_view_preview->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->ReceiptNo) == "") { ?>
		<th class="<?php echo $receipts_view_preview->ReceiptNo->headerCellClass() ?>"><?php echo $receipts_view_preview->ReceiptNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->ReceiptNo->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->ReceiptNo->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->ReceiptNo->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->ClientSerNo) == "") { ?>
		<th class="<?php echo $receipts_view_preview->ClientSerNo->headerCellClass() ?>"><?php echo $receipts_view_preview->ClientSerNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->ClientSerNo->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->ClientSerNo->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->ClientSerNo->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->ChargeCode) == "") { ?>
		<th class="<?php echo $receipts_view_preview->ChargeCode->headerCellClass() ?>"><?php echo $receipts_view_preview->ChargeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->ChargeCode->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->ChargeCode->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->ChargeCode->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->ReceiptDate) == "") { ?>
		<th class="<?php echo $receipts_view_preview->ReceiptDate->headerCellClass() ?>"><?php echo $receipts_view_preview->ReceiptDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->ReceiptDate->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->ReceiptDate->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->ReceiptDate->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->ItemID->Visible) { // ItemID ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->ItemID) == "") { ?>
		<th class="<?php echo $receipts_view_preview->ItemID->headerCellClass() ?>"><?php echo $receipts_view_preview->ItemID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->ItemID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->ItemID->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->ItemID->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->ItemID->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->ItemID->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->UnitCost->Visible) { // UnitCost ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->UnitCost) == "") { ?>
		<th class="<?php echo $receipts_view_preview->UnitCost->headerCellClass() ?>"><?php echo $receipts_view_preview->UnitCost->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->UnitCost->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->UnitCost->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->UnitCost->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->UnitCost->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->Quantity->Visible) { // Quantity ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->Quantity) == "") { ?>
		<th class="<?php echo $receipts_view_preview->Quantity->headerCellClass() ?>"><?php echo $receipts_view_preview->Quantity->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->Quantity->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->Quantity->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->Quantity->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->Quantity->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->UnitOfMeasure) == "") { ?>
		<th class="<?php echo $receipts_view_preview->UnitOfMeasure->headerCellClass() ?>"><?php echo $receipts_view_preview->UnitOfMeasure->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->UnitOfMeasure->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->UnitOfMeasure->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->UnitOfMeasure->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $receipts_view_preview->AmountPaid->headerCellClass() ?>"><?php echo $receipts_view_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->AmountPaid->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->AmountPaid->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->PaymentMethod) == "") { ?>
		<th class="<?php echo $receipts_view_preview->PaymentMethod->headerCellClass() ?>"><?php echo $receipts_view_preview->PaymentMethod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->PaymentMethod->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->PaymentMethod->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->PaymentMethod->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->PaymentRef->Visible) { // PaymentRef ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->PaymentRef) == "") { ?>
		<th class="<?php echo $receipts_view_preview->PaymentRef->headerCellClass() ?>"><?php echo $receipts_view_preview->PaymentRef->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->PaymentRef->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->PaymentRef->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->PaymentRef->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->PaymentRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->PaymentRef->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->CashierNo->Visible) { // CashierNo ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->CashierNo) == "") { ?>
		<th class="<?php echo $receipts_view_preview->CashierNo->headerCellClass() ?>"><?php echo $receipts_view_preview->CashierNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->CashierNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->CashierNo->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->CashierNo->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->CashierNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->CashierNo->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->BillPeriod) == "") { ?>
		<th class="<?php echo $receipts_view_preview->BillPeriod->headerCellClass() ?>"><?php echo $receipts_view_preview->BillPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->BillPeriod->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->BillPeriod->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->BillPeriod->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->BillYear->Visible) { // BillYear ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->BillYear) == "") { ?>
		<th class="<?php echo $receipts_view_preview->BillYear->headerCellClass() ?>"><?php echo $receipts_view_preview->BillYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->BillYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->BillYear->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->BillYear->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->BillYear->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->PaymentFor->Visible) { // PaymentFor ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->PaymentFor) == "") { ?>
		<th class="<?php echo $receipts_view_preview->PaymentFor->headerCellClass() ?>"><?php echo $receipts_view_preview->PaymentFor->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->PaymentFor->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->PaymentFor->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->PaymentFor->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->PaymentFor->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->PaymentFor->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_preview->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipts_view->SortUrl($receipts_view_preview->ChargeGroup) == "") { ?>
		<th class="<?php echo $receipts_view_preview->ChargeGroup->headerCellClass() ?>"><?php echo $receipts_view_preview->ChargeGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipts_view_preview->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipts_view_preview->ChargeGroup->Name) ?>" data-sort-order="<?php echo $receipts_view_preview->SortField == $receipts_view_preview->ChargeGroup->Name && $receipts_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_preview->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_preview->SortField == $receipts_view_preview->ChargeGroup->Name) { ?><?php if ($receipts_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipts_view_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$receipts_view_preview->RecCount = 0;
$receipts_view_preview->RowCount = 0;
while ($receipts_view_preview->Recordset && !$receipts_view_preview->Recordset->EOF) {

	// Init row class and style
	$receipts_view_preview->RecCount++;
	$receipts_view_preview->RowCount++;
	$receipts_view_preview->CssStyle = "";
	$receipts_view_preview->loadListRowValues($receipts_view_preview->Recordset);
	$receipts_view_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$receipts_view->RowType = ROWTYPE_PREVIEW; // Preview record
	$receipts_view_preview->resetAttributes();
	$receipts_view_preview->renderListRow();

	// Render list options
	$receipts_view_preview->renderListOptions();
?>
	<tr <?php echo $receipts_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipts_view_preview->ListOptions->render("body", "left", $receipts_view_preview->RowCount);
?>
<?php if ($receipts_view_preview->ReceiptNo->Visible) { // ReceiptNo ?>
		<!-- ReceiptNo -->
		<td<?php echo $receipts_view_preview->ReceiptNo->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->ReceiptNo->viewAttributes() ?>><?php echo $receipts_view_preview->ReceiptNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->ClientSerNo->Visible) { // ClientSerNo ?>
		<!-- ClientSerNo -->
		<td<?php echo $receipts_view_preview->ClientSerNo->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->ClientSerNo->viewAttributes() ?>><?php echo $receipts_view_preview->ClientSerNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td<?php echo $receipts_view_preview->ChargeCode->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->ChargeCode->viewAttributes() ?>><?php echo $receipts_view_preview->ChargeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->ReceiptDate->Visible) { // ReceiptDate ?>
		<!-- ReceiptDate -->
		<td<?php echo $receipts_view_preview->ReceiptDate->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->ReceiptDate->viewAttributes() ?>><?php echo $receipts_view_preview->ReceiptDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->ItemID->Visible) { // ItemID ?>
		<!-- ItemID -->
		<td<?php echo $receipts_view_preview->ItemID->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->ItemID->viewAttributes() ?>><?php echo $receipts_view_preview->ItemID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->UnitCost->Visible) { // UnitCost ?>
		<!-- UnitCost -->
		<td<?php echo $receipts_view_preview->UnitCost->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->UnitCost->viewAttributes() ?>><?php echo $receipts_view_preview->UnitCost->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->Quantity->Visible) { // Quantity ?>
		<!-- Quantity -->
		<td<?php echo $receipts_view_preview->Quantity->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->Quantity->viewAttributes() ?>><?php echo $receipts_view_preview->Quantity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td<?php echo $receipts_view_preview->UnitOfMeasure->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->UnitOfMeasure->viewAttributes() ?>><?php echo $receipts_view_preview->UnitOfMeasure->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $receipts_view_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->AmountPaid->viewAttributes() ?>><?php echo $receipts_view_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->PaymentMethod->Visible) { // PaymentMethod ?>
		<!-- PaymentMethod -->
		<td<?php echo $receipts_view_preview->PaymentMethod->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->PaymentMethod->viewAttributes() ?>><?php echo $receipts_view_preview->PaymentMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->PaymentRef->Visible) { // PaymentRef ?>
		<!-- PaymentRef -->
		<td<?php echo $receipts_view_preview->PaymentRef->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->PaymentRef->viewAttributes() ?>><?php echo $receipts_view_preview->PaymentRef->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->CashierNo->Visible) { // CashierNo ?>
		<!-- CashierNo -->
		<td<?php echo $receipts_view_preview->CashierNo->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->CashierNo->viewAttributes() ?>><?php echo $receipts_view_preview->CashierNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td<?php echo $receipts_view_preview->BillPeriod->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->BillPeriod->viewAttributes() ?>><?php echo $receipts_view_preview->BillPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td<?php echo $receipts_view_preview->BillYear->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->BillYear->viewAttributes() ?>><?php echo $receipts_view_preview->BillYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->PaymentFor->Visible) { // PaymentFor ?>
		<!-- PaymentFor -->
		<td<?php echo $receipts_view_preview->PaymentFor->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->PaymentFor->viewAttributes() ?>><?php echo $receipts_view_preview->PaymentFor->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipts_view_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td<?php echo $receipts_view_preview->ChargeGroup->cellAttributes() ?>>
<span<?php echo $receipts_view_preview->ChargeGroup->viewAttributes() ?>><?php echo $receipts_view_preview->ChargeGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$receipts_view_preview->ListOptions->render("body", "right", $receipts_view_preview->RowCount);
?>
	</tr>
<?php
	$receipts_view_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
<?php

	// Render aggregate row
	$receipts_view->RowType = ROWTYPE_AGGREGATE; // Aggregate
	$receipts_view_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$receipts_view_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$receipts_view_preview->ListOptions->render("footer", "left");
?>
<?php if ($receipts_view_preview->ReceiptNo->Visible) { // ReceiptNo ?>
		<!-- ReceiptNo -->
		<td class="<?php echo $receipts_view_preview->ReceiptNo->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->ClientSerNo->Visible) { // ClientSerNo ?>
		<!-- ClientSerNo -->
		<td class="<?php echo $receipts_view_preview->ClientSerNo->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td class="<?php echo $receipts_view_preview->ChargeCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->ReceiptDate->Visible) { // ReceiptDate ?>
		<!-- ReceiptDate -->
		<td class="<?php echo $receipts_view_preview->ReceiptDate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->ItemID->Visible) { // ItemID ?>
		<!-- ItemID -->
		<td class="<?php echo $receipts_view_preview->ItemID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->UnitCost->Visible) { // UnitCost ?>
		<!-- UnitCost -->
		<td class="<?php echo $receipts_view_preview->UnitCost->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->Quantity->Visible) { // Quantity ?>
		<!-- Quantity -->
		<td class="<?php echo $receipts_view_preview->Quantity->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td class="<?php echo $receipts_view_preview->UnitOfMeasure->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td class="<?php echo $receipts_view_preview->AmountPaid->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $receipts_view_preview->AmountPaid->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($receipts_view_preview->PaymentMethod->Visible) { // PaymentMethod ?>
		<!-- PaymentMethod -->
		<td class="<?php echo $receipts_view_preview->PaymentMethod->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->PaymentRef->Visible) { // PaymentRef ?>
		<!-- PaymentRef -->
		<td class="<?php echo $receipts_view_preview->PaymentRef->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->CashierNo->Visible) { // CashierNo ?>
		<!-- CashierNo -->
		<td class="<?php echo $receipts_view_preview->CashierNo->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td class="<?php echo $receipts_view_preview->BillPeriod->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td class="<?php echo $receipts_view_preview->BillYear->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->PaymentFor->Visible) { // PaymentFor ?>
		<!-- PaymentFor -->
		<td class="<?php echo $receipts_view_preview->PaymentFor->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipts_view_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td class="<?php echo $receipts_view_preview->ChargeGroup->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$receipts_view_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $receipts_view_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($receipts_view_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($receipts_view_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$receipts_view_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($receipts_view_preview->Recordset)
	$receipts_view_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$receipts_view_preview->terminate();
?>