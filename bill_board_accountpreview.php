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
$bill_board_account_preview = new bill_board_account_preview();

// Run the page
$bill_board_account_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_account_preview->Page_Render();
?>
<?php $bill_board_account_preview->showPageHeader(); ?>
<?php if ($bill_board_account_preview->TotalRecords > 0) { ?>
<div class="card ew-grid bill_board_account"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$bill_board_account_preview->renderListOptions();

// Render list options (header, left)
$bill_board_account_preview->ListOptions->render("header", "left");
?>
<?php if ($bill_board_account_preview->AccountNo->Visible) { // AccountNo ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->AccountNo) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->AccountNo->headerCellClass() ?>"><?php echo $bill_board_account_preview->AccountNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->AccountNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->AccountNo->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->AccountNo->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->AccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->AccountNo->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->BillBoardNo->Visible) { // BillBoardNo ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->BillBoardNo) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->BillBoardNo->headerCellClass() ?>"><?php echo $bill_board_account_preview->BillBoardNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->BillBoardNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->BillBoardNo->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->BillBoardNo->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->BillBoardNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->BillBoardNo->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->ClientID->Visible) { // ClientID ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->ClientID) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->ClientID->headerCellClass() ?>"><?php echo $bill_board_account_preview->ClientID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->ClientID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->ClientID->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->ClientID->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->ClientID->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->BalanceBF) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->BalanceBF->headerCellClass() ?>"><?php echo $bill_board_account_preview->BalanceBF->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->BalanceBF->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->BalanceBF->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->BalanceBF->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->CurrentDemand) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->CurrentDemand->headerCellClass() ?>"><?php echo $bill_board_account_preview->CurrentDemand->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->CurrentDemand->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->CurrentDemand->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->CurrentDemand->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->VAT->Visible) { // VAT ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->VAT) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->VAT->headerCellClass() ?>"><?php echo $bill_board_account_preview->VAT->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->VAT->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->VAT->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->VAT->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->VAT->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->AmountPaid->headerCellClass() ?>"><?php echo $bill_board_account_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->AmountPaid->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->AmountPaid->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->BillPeriod) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->BillPeriod->headerCellClass() ?>"><?php echo $bill_board_account_preview->BillPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->BillPeriod->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->BillPeriod->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->BillPeriod->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->PeriodType->Visible) { // PeriodType ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->PeriodType) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->PeriodType->headerCellClass() ?>"><?php echo $bill_board_account_preview->PeriodType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->PeriodType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->PeriodType->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->PeriodType->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->PeriodType->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->BillYear->Visible) { // BillYear ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->BillYear) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->BillYear->headerCellClass() ?>"><?php echo $bill_board_account_preview->BillYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->BillYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->BillYear->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->BillYear->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->BillYear->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->StartDate) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->StartDate->headerCellClass() ?>"><?php echo $bill_board_account_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->StartDate->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->StartDate->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->StartDate->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->EndDate) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->EndDate->headerCellClass() ?>"><?php echo $bill_board_account_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->EndDate->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->EndDate->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->EndDate->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($bill_board_account->SortUrl($bill_board_account_preview->LastUpdatedBy) == "") { ?>
		<th class="<?php echo $bill_board_account_preview->LastUpdatedBy->headerCellClass() ?>"><?php echo $bill_board_account_preview->LastUpdatedBy->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_account_preview->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_account_preview->LastUpdatedBy->Name) ?>" data-sort-order="<?php echo $bill_board_account_preview->SortField == $bill_board_account_preview->LastUpdatedBy->Name && $bill_board_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_preview->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_preview->SortField == $bill_board_account_preview->LastUpdatedBy->Name) { ?><?php if ($bill_board_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bill_board_account_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$bill_board_account_preview->RecCount = 0;
$bill_board_account_preview->RowCount = 0;
while ($bill_board_account_preview->Recordset && !$bill_board_account_preview->Recordset->EOF) {

	// Init row class and style
	$bill_board_account_preview->RecCount++;
	$bill_board_account_preview->RowCount++;
	$bill_board_account_preview->CssStyle = "";
	$bill_board_account_preview->loadListRowValues($bill_board_account_preview->Recordset);

	// Render row
	$bill_board_account->RowType = ROWTYPE_PREVIEW; // Preview record
	$bill_board_account_preview->resetAttributes();
	$bill_board_account_preview->renderListRow();

	// Render list options
	$bill_board_account_preview->renderListOptions();
?>
	<tr <?php echo $bill_board_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_account_preview->ListOptions->render("body", "left", $bill_board_account_preview->RowCount);
?>
<?php if ($bill_board_account_preview->AccountNo->Visible) { // AccountNo ?>
		<!-- AccountNo -->
		<td<?php echo $bill_board_account_preview->AccountNo->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->AccountNo->viewAttributes() ?>><?php echo $bill_board_account_preview->AccountNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->BillBoardNo->Visible) { // BillBoardNo ?>
		<!-- BillBoardNo -->
		<td<?php echo $bill_board_account_preview->BillBoardNo->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_account_preview->BillBoardNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->ClientID->Visible) { // ClientID ?>
		<!-- ClientID -->
		<td<?php echo $bill_board_account_preview->ClientID->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->ClientID->viewAttributes() ?>><?php echo $bill_board_account_preview->ClientID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->BalanceBF->Visible) { // BalanceBF ?>
		<!-- BalanceBF -->
		<td<?php echo $bill_board_account_preview->BalanceBF->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->BalanceBF->viewAttributes() ?>><?php echo $bill_board_account_preview->BalanceBF->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->CurrentDemand->Visible) { // CurrentDemand ?>
		<!-- CurrentDemand -->
		<td<?php echo $bill_board_account_preview->CurrentDemand->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->CurrentDemand->viewAttributes() ?>><?php echo $bill_board_account_preview->CurrentDemand->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->VAT->Visible) { // VAT ?>
		<!-- VAT -->
		<td<?php echo $bill_board_account_preview->VAT->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->VAT->viewAttributes() ?>><?php echo $bill_board_account_preview->VAT->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $bill_board_account_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->AmountPaid->viewAttributes() ?>><?php echo $bill_board_account_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->BillPeriod->Visible) { // BillPeriod ?>
		<!-- BillPeriod -->
		<td<?php echo $bill_board_account_preview->BillPeriod->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->BillPeriod->viewAttributes() ?>><?php echo $bill_board_account_preview->BillPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->PeriodType->Visible) { // PeriodType ?>
		<!-- PeriodType -->
		<td<?php echo $bill_board_account_preview->PeriodType->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->PeriodType->viewAttributes() ?>><?php echo $bill_board_account_preview->PeriodType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->BillYear->Visible) { // BillYear ?>
		<!-- BillYear -->
		<td<?php echo $bill_board_account_preview->BillYear->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->BillYear->viewAttributes() ?>><?php echo $bill_board_account_preview->BillYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $bill_board_account_preview->StartDate->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->StartDate->viewAttributes() ?>><?php echo $bill_board_account_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $bill_board_account_preview->EndDate->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->EndDate->viewAttributes() ?>><?php echo $bill_board_account_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_account_preview->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<!-- LastUpdatedBy -->
		<td<?php echo $bill_board_account_preview->LastUpdatedBy->cellAttributes() ?>>
<span<?php echo $bill_board_account_preview->LastUpdatedBy->viewAttributes() ?>><?php echo $bill_board_account_preview->LastUpdatedBy->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$bill_board_account_preview->ListOptions->render("body", "right", $bill_board_account_preview->RowCount);
?>
	</tr>
<?php
	$bill_board_account_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $bill_board_account_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($bill_board_account_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($bill_board_account_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$bill_board_account_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($bill_board_account_preview->Recordset)
	$bill_board_account_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$bill_board_account_preview->terminate();
?>