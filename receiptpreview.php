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
$receipt_preview = new receipt_preview();

// Run the page
$receipt_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_preview->Page_Render();
?>
<?php $receipt_preview->showPageHeader(); ?>
<?php if ($receipt_preview->TotalRecords > 0) { ?>
<div class="card ew-grid receipt"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$receipt_preview->renderListOptions();

// Render list options (header, left)
$receipt_preview->ListOptions->render("header", "left");
?>
<?php if ($receipt_preview->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipt->SortUrl($receipt_preview->ClientSerNo) == "") { ?>
		<th class="<?php echo $receipt_preview->ClientSerNo->headerCellClass() ?>"><?php echo $receipt_preview->ClientSerNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->ClientSerNo->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->ClientSerNo->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->ClientSerNo->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($receipt->SortUrl($receipt_preview->ChargeCode) == "") { ?>
		<th class="<?php echo $receipt_preview->ChargeCode->headerCellClass() ?>"><?php echo $receipt_preview->ChargeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->ChargeCode->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->ChargeCode->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->ChargeCode->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->ItemID->Visible) { // ItemID ?>
	<?php if ($receipt->SortUrl($receipt_preview->ItemID) == "") { ?>
		<th class="<?php echo $receipt_preview->ItemID->headerCellClass() ?>"><?php echo $receipt_preview->ItemID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->ItemID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->ItemID->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->ItemID->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->ItemID->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->ItemID->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->UnitCost->Visible) { // UnitCost ?>
	<?php if ($receipt->SortUrl($receipt_preview->UnitCost) == "") { ?>
		<th class="<?php echo $receipt_preview->UnitCost->headerCellClass() ?>"><?php echo $receipt_preview->UnitCost->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->UnitCost->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->UnitCost->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->UnitCost->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->UnitCost->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->Quantity->Visible) { // Quantity ?>
	<?php if ($receipt->SortUrl($receipt_preview->Quantity) == "") { ?>
		<th class="<?php echo $receipt_preview->Quantity->headerCellClass() ?>"><?php echo $receipt_preview->Quantity->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->Quantity->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->Quantity->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->Quantity->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->Quantity->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($receipt->SortUrl($receipt_preview->UnitOfMeasure) == "") { ?>
		<th class="<?php echo $receipt_preview->UnitOfMeasure->headerCellClass() ?>"><?php echo $receipt_preview->UnitOfMeasure->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->UnitOfMeasure->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->UnitOfMeasure->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->UnitOfMeasure->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($receipt->SortUrl($receipt_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $receipt_preview->AmountPaid->headerCellClass() ?>"><?php echo $receipt_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->AmountPaid->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->AmountPaid->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipt->SortUrl($receipt_preview->ReceiptNo) == "") { ?>
		<th class="<?php echo $receipt_preview->ReceiptNo->headerCellClass() ?>"><?php echo $receipt_preview->ReceiptNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->ReceiptNo->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->ReceiptNo->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->ReceiptNo->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipt->SortUrl($receipt_preview->ReceiptDate) == "") { ?>
		<th class="<?php echo $receipt_preview->ReceiptDate->headerCellClass() ?>"><?php echo $receipt_preview->ReceiptDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->ReceiptDate->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->ReceiptDate->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->ReceiptDate->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipt->SortUrl($receipt_preview->PaymentMethod) == "") { ?>
		<th class="<?php echo $receipt_preview->PaymentMethod->headerCellClass() ?>"><?php echo $receipt_preview->PaymentMethod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->PaymentMethod->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->PaymentMethod->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->PaymentMethod->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->PaymentRef->Visible) { // PaymentRef ?>
	<?php if ($receipt->SortUrl($receipt_preview->PaymentRef) == "") { ?>
		<th class="<?php echo $receipt_preview->PaymentRef->headerCellClass() ?>"><?php echo $receipt_preview->PaymentRef->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->PaymentRef->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->PaymentRef->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->PaymentRef->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->PaymentRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->PaymentRef->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->CashierNo->Visible) { // CashierNo ?>
	<?php if ($receipt->SortUrl($receipt_preview->CashierNo) == "") { ?>
		<th class="<?php echo $receipt_preview->CashierNo->headerCellClass() ?>"><?php echo $receipt_preview->CashierNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->CashierNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->CashierNo->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->CashierNo->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->CashierNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->CashierNo->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($receipt->SortUrl($receipt_preview->BillPeriod) == "") { ?>
		<th class="<?php echo $receipt_preview->BillPeriod->headerCellClass() ?>"><?php echo $receipt_preview->BillPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->BillPeriod->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->BillPeriod->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->BillPeriod->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->BillYear->Visible) { // BillYear ?>
	<?php if ($receipt->SortUrl($receipt_preview->BillYear) == "") { ?>
		<th class="<?php echo $receipt_preview->BillYear->headerCellClass() ?>"><?php echo $receipt_preview->BillYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->BillYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->BillYear->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->BillYear->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->BillYear->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipt->SortUrl($receipt_preview->ChargeGroup) == "") { ?>
		<th class="<?php echo $receipt_preview->ChargeGroup->headerCellClass() ?>"><?php echo $receipt_preview->ChargeGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->ChargeGroup->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->ChargeGroup->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->ChargeGroup->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_preview->ClientID->Visible) { // ClientID ?>
	<?php if ($receipt->SortUrl($receipt_preview->ClientID) == "") { ?>
		<th class="<?php echo $receipt_preview->ClientID->headerCellClass() ?>"><?php echo $receipt_preview->ClientID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $receipt_preview->ClientID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($receipt_preview->ClientID->Name) ?>" data-sort-order="<?php echo $receipt_preview->SortField == $receipt_preview->ClientID->Name && $receipt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_preview->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_preview->SortField == $receipt_preview->ClientID->Name) { ?><?php if ($receipt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipt_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$receipt_preview->RecCount = 0;
$receipt_preview->RowCount = 0;
while ($receipt_preview->Recordset && !$receipt_preview->Recordset->EOF) {

	// Init row class and style
	$receipt_preview->RecCount++;
	$receipt_preview->RowCount++;
	$receipt_preview->CssStyle = "";
	$receipt_preview->loadListRowValues($receipt_preview->Recordset);
	$receipt_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$receipt->RowType = ROWTYPE_PREVIEW; // Preview record
	$receipt_preview->resetAttributes();
	$receipt_preview->renderListRow();

	// Render list options
	$receipt_preview->renderListOptions();
?>
	<tr <?php echo $receipt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipt_preview->ListOptions->render("body", "left", $receipt_preview->RowCount);
?>
<?php if ($receipt_preview->ClientSerNo->Visible) { // ClientSerNo ?>
		<!-- ClientSerNo -->
		<td<?php echo $receipt_preview->ClientSerNo->cellAttributes() ?>>
<span<?php echo $receipt_preview->ClientSerNo->viewAttributes() ?>><?php echo $receipt_preview->ClientSerNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td<?php echo $receipt_preview->ChargeCode->cellAttributes() ?>>
<span<?php echo $receipt_preview->ChargeCode->viewAttributes() ?>><?php echo $receipt_preview->ChargeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->ItemID->Visible) { // ItemID ?>
		<!-- ItemID -->
		<td<?php echo $receipt_preview->ItemID->cellAttributes() ?>>
<span<?php echo $receipt_preview->ItemID->viewAttributes() ?>><?php echo $receipt_preview->ItemID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->UnitCost->Visible) { // UnitCost ?>
		<!-- UnitCost -->
		<td<?php echo $receipt_preview->UnitCost->cellAttributes() ?>>
<span<?php echo $receipt_preview->UnitCost->viewAttributes() ?>><?php echo $receipt_preview->UnitCost->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->Quantity->Visible) { // Quantity ?>
		<!-- Quantity -->
		<td<?php echo $receipt_preview->Quantity->cellAttributes() ?>>
<span<?php echo $receipt_preview->Quantity->viewAttributes() ?>><?php echo $receipt_preview->Quantity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td<?php echo $receipt_preview->UnitOfMeasure->cellAttributes() ?>>
<span<?php echo $receipt_preview->UnitOfMeasure->viewAttributes() ?>><?php echo $receipt_preview->UnitOfMeasure->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $receipt_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $receipt_preview->AmountPaid->viewAttributes() ?>><?php echo $receipt_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->ReceiptNo->Visible) { // ReceiptNo ?>
		<!-- ReceiptNo -->
		<td<?php echo $receipt_preview->ReceiptNo->cellAttributes() ?>>
<span<?php echo $receipt_preview->ReceiptNo->viewAttributes() ?>><?php echo $receipt_preview->ReceiptNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->ReceiptDate->Visible) { // ReceiptDate ?>
		<!-- ReceiptDate -->
		<td<?php echo $receipt_preview->ReceiptDate->cellAttributes() ?>>
<span<?php echo $receipt_preview->ReceiptDate->viewAttributes() ?>><?php echo $receipt_preview->ReceiptDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->PaymentMethod->Visible) { // PaymentMethod ?>
		<!-- PaymentMethod -->
		<td<?php echo $receipt_preview->PaymentMethod->cellAttributes() ?>>
<span<?php echo $receipt_preview->PaymentMethod->viewAttributes() ?>><?php echo $receipt_preview->PaymentMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->PaymentRef->Visible) { // PaymentRef ?>
		<!-- PaymentRef -->
		<td<?php echo $receipt_preview->PaymentRef->cellAttributes() ?>>
<span<?php echo $receipt_preview->PaymentRef->viewAttributes() ?>><?php echo $receipt_preview->PaymentRef->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->CashierNo->Visible) { // CashierNo ?>
		<!-- CashierNo -->
		<td<?php echo $receipt_preview->CashierNo->cellAttributes() ?>>
<span<?php echo $receipt_preview->CashierNo->viewAttributes() ?>><?php echo $receipt_preview->CashierNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td<?php echo $receipt_preview->BillPeriod->cellAttributes() ?>>
<span<?php echo $receipt_preview->BillPeriod->viewAttributes() ?>><?php echo $receipt_preview->BillPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td<?php echo $receipt_preview->BillYear->cellAttributes() ?>>
<span<?php echo $receipt_preview->BillYear->viewAttributes() ?>><?php echo $receipt_preview->BillYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td<?php echo $receipt_preview->ChargeGroup->cellAttributes() ?>>
<span<?php echo $receipt_preview->ChargeGroup->viewAttributes() ?>><?php echo $receipt_preview->ChargeGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($receipt_preview->ClientID->Visible) { // ClientID ?>
		<!-- ClientID -->
		<td<?php echo $receipt_preview->ClientID->cellAttributes() ?>>
<span<?php echo $receipt_preview->ClientID->viewAttributes() ?>><?php echo $receipt_preview->ClientID->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$receipt_preview->ListOptions->render("body", "right", $receipt_preview->RowCount);
?>
	</tr>
<?php
	$receipt_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
<?php

	// Render aggregate row
	$receipt->RowType = ROWTYPE_AGGREGATE; // Aggregate
	$receipt_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$receipt_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$receipt_preview->ListOptions->render("footer", "left");
?>
<?php if ($receipt_preview->ClientSerNo->Visible) { // ClientSerNo ?>
		<!-- ClientSerNo -->
		<td class="<?php echo $receipt_preview->ClientSerNo->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->ChargeCode->Visible) { // ChargeCode ?>
		<!-- ChargeCode -->
		<td class="<?php echo $receipt_preview->ChargeCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->ItemID->Visible) { // ItemID ?>
		<!-- ItemID -->
		<td class="<?php echo $receipt_preview->ItemID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->UnitCost->Visible) { // UnitCost ?>
		<!-- UnitCost -->
		<td class="<?php echo $receipt_preview->UnitCost->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->Quantity->Visible) { // Quantity ?>
		<!-- Quantity -->
		<td class="<?php echo $receipt_preview->Quantity->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td class="<?php echo $receipt_preview->UnitOfMeasure->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td class="<?php echo $receipt_preview->AmountPaid->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $receipt_preview->AmountPaid->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($receipt_preview->ReceiptNo->Visible) { // ReceiptNo ?>
		<!-- ReceiptNo -->
		<td class="<?php echo $receipt_preview->ReceiptNo->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->ReceiptDate->Visible) { // ReceiptDate ?>
		<!-- ReceiptDate -->
		<td class="<?php echo $receipt_preview->ReceiptDate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->PaymentMethod->Visible) { // PaymentMethod ?>
		<!-- PaymentMethod -->
		<td class="<?php echo $receipt_preview->PaymentMethod->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->PaymentRef->Visible) { // PaymentRef ?>
		<!-- PaymentRef -->
		<td class="<?php echo $receipt_preview->PaymentRef->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->CashierNo->Visible) { // CashierNo ?>
		<!-- CashierNo -->
		<td class="<?php echo $receipt_preview->CashierNo->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td class="<?php echo $receipt_preview->BillPeriod->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td class="<?php echo $receipt_preview->BillYear->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td class="<?php echo $receipt_preview->ChargeGroup->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($receipt_preview->ClientID->Visible) { // ClientID ?>
		<!-- ClientID -->
		<td class="<?php echo $receipt_preview->ClientID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$receipt_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $receipt_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($receipt_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($receipt_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$receipt_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($receipt_preview->Recordset)
	$receipt_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$receipt_preview->terminate();
?>