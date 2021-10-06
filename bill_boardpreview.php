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
$bill_board_preview = new bill_board_preview();

// Run the page
$bill_board_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_preview->Page_Render();
?>
<?php $bill_board_preview->showPageHeader(); ?>
<?php if ($bill_board_preview->TotalRecords > 0) { ?>
<div class="card ew-grid bill_board"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$bill_board_preview->renderListOptions();

// Render list options (header, left)
$bill_board_preview->ListOptions->render("header", "left");
?>
<?php if ($bill_board_preview->BillBoardNo->Visible) { // BillBoardNo ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BillBoardNo) == "") { ?>
		<th class="<?php echo $bill_board_preview->BillBoardNo->headerCellClass() ?>"><?php echo $bill_board_preview->BillBoardNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BillBoardNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BillBoardNo->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BillBoardNo->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BillBoardNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BillBoardNo->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->BoardStandNo->Visible) { // BoardStandNo ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BoardStandNo) == "") { ?>
		<th class="<?php echo $bill_board_preview->BoardStandNo->headerCellClass() ?>"><?php echo $bill_board_preview->BoardStandNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BoardStandNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BoardStandNo->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BoardStandNo->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BoardStandNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BoardStandNo->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->ClientSerNo) == "") { ?>
		<th class="<?php echo $bill_board_preview->ClientSerNo->headerCellClass() ?>"><?php echo $bill_board_preview->ClientSerNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->ClientSerNo->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->ClientSerNo->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->ClientSerNo->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->ClientID->Visible) { // ClientID ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->ClientID) == "") { ?>
		<th class="<?php echo $bill_board_preview->ClientID->headerCellClass() ?>"><?php echo $bill_board_preview->ClientID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->ClientID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->ClientID->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->ClientID->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->ClientID->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->BoardLength->Visible) { // BoardLength ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BoardLength) == "") { ?>
		<th class="<?php echo $bill_board_preview->BoardLength->headerCellClass() ?>"><?php echo $bill_board_preview->BoardLength->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BoardLength->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BoardLength->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BoardLength->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BoardLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BoardLength->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->BoardWidth->Visible) { // BoardWidth ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BoardWidth) == "") { ?>
		<th class="<?php echo $bill_board_preview->BoardWidth->headerCellClass() ?>"><?php echo $bill_board_preview->BoardWidth->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BoardWidth->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BoardWidth->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BoardWidth->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BoardWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BoardWidth->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->BoardSize->Visible) { // BoardSize ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BoardSize) == "") { ?>
		<th class="<?php echo $bill_board_preview->BoardSize->headerCellClass() ?>"><?php echo $bill_board_preview->BoardSize->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BoardSize->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BoardSize->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BoardSize->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BoardSize->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BoardSize->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->BoardType->Visible) { // BoardType ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BoardType) == "") { ?>
		<th class="<?php echo $bill_board_preview->BoardType->headerCellClass() ?>"><?php echo $bill_board_preview->BoardType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BoardType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BoardType->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BoardType->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BoardType->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BoardType->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->BoardLocation->Visible) { // BoardLocation ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BoardLocation) == "") { ?>
		<th class="<?php echo $bill_board_preview->BoardLocation->headerCellClass() ?>"><?php echo $bill_board_preview->BoardLocation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BoardLocation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BoardLocation->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BoardLocation->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BoardLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BoardLocation->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->BoardStatus->Visible) { // BoardStatus ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->BoardStatus) == "") { ?>
		<th class="<?php echo $bill_board_preview->BoardStatus->headerCellClass() ?>"><?php echo $bill_board_preview->BoardStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->BoardStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->BoardStatus->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->BoardStatus->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->BoardStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->BoardStatus->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->ExemptCode) == "") { ?>
		<th class="<?php echo $bill_board_preview->ExemptCode->headerCellClass() ?>"><?php echo $bill_board_preview->ExemptCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->ExemptCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->ExemptCode->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->ExemptCode->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->ExemptCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->ExemptCode->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->StreetAddress->Visible) { // StreetAddress ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->StreetAddress) == "") { ?>
		<th class="<?php echo $bill_board_preview->StreetAddress->headerCellClass() ?>"><?php echo $bill_board_preview->StreetAddress->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->StreetAddress->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->StreetAddress->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->StreetAddress->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->StreetAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->StreetAddress->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->Longitude->Visible) { // Longitude ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->Longitude) == "") { ?>
		<th class="<?php echo $bill_board_preview->Longitude->headerCellClass() ?>"><?php echo $bill_board_preview->Longitude->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->Longitude->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->Longitude->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->Longitude->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->Longitude->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->Latitude->Visible) { // Latitude ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->Latitude) == "") { ?>
		<th class="<?php echo $bill_board_preview->Latitude->headerCellClass() ?>"><?php echo $bill_board_preview->Latitude->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->Latitude->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->Latitude->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->Latitude->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->Latitude->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->Incumberance->Visible) { // Incumberance ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->Incumberance) == "") { ?>
		<th class="<?php echo $bill_board_preview->Incumberance->headerCellClass() ?>"><?php echo $bill_board_preview->Incumberance->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->Incumberance->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->Incumberance->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->Incumberance->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->Incumberance->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->Incumberance->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->StartDate) == "") { ?>
		<th class="<?php echo $bill_board_preview->StartDate->headerCellClass() ?>"><?php echo $bill_board_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->StartDate->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->StartDate->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->StartDate->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($bill_board->SortUrl($bill_board_preview->EndDate) == "") { ?>
		<th class="<?php echo $bill_board_preview->EndDate->headerCellClass() ?>"><?php echo $bill_board_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bill_board_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bill_board_preview->EndDate->Name) ?>" data-sort-order="<?php echo $bill_board_preview->SortField == $bill_board_preview->EndDate->Name && $bill_board_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_preview->SortField == $bill_board_preview->EndDate->Name) { ?><?php if ($bill_board_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bill_board_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$bill_board_preview->RecCount = 0;
$bill_board_preview->RowCount = 0;
while ($bill_board_preview->Recordset && !$bill_board_preview->Recordset->EOF) {

	// Init row class and style
	$bill_board_preview->RecCount++;
	$bill_board_preview->RowCount++;
	$bill_board_preview->CssStyle = "";
	$bill_board_preview->loadListRowValues($bill_board_preview->Recordset);

	// Render row
	$bill_board->RowType = ROWTYPE_PREVIEW; // Preview record
	$bill_board_preview->resetAttributes();
	$bill_board_preview->renderListRow();

	// Render list options
	$bill_board_preview->renderListOptions();
?>
	<tr <?php echo $bill_board->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_preview->ListOptions->render("body", "left", $bill_board_preview->RowCount);
?>
<?php if ($bill_board_preview->BillBoardNo->Visible) { // BillBoardNo ?>
		<!-- BillBoardNo -->
		<td<?php echo $bill_board_preview->BillBoardNo->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_preview->BillBoardNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->BoardStandNo->Visible) { // BoardStandNo ?>
		<!-- BoardStandNo -->
		<td<?php echo $bill_board_preview->BoardStandNo->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BoardStandNo->viewAttributes() ?>><?php echo $bill_board_preview->BoardStandNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->ClientSerNo->Visible) { // ClientSerNo ?>
		<!-- ClientSerNo -->
		<td<?php echo $bill_board_preview->ClientSerNo->cellAttributes() ?>>
<span<?php echo $bill_board_preview->ClientSerNo->viewAttributes() ?>><?php echo $bill_board_preview->ClientSerNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->ClientID->Visible) { // ClientID ?>
		<!-- ClientID -->
		<td<?php echo $bill_board_preview->ClientID->cellAttributes() ?>>
<span<?php echo $bill_board_preview->ClientID->viewAttributes() ?>><?php echo $bill_board_preview->ClientID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->BoardLength->Visible) { // BoardLength ?>
		<!-- BoardLength -->
		<td<?php echo $bill_board_preview->BoardLength->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BoardLength->viewAttributes() ?>><?php echo $bill_board_preview->BoardLength->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->BoardWidth->Visible) { // BoardWidth ?>
		<!-- BoardWidth -->
		<td<?php echo $bill_board_preview->BoardWidth->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BoardWidth->viewAttributes() ?>><?php echo $bill_board_preview->BoardWidth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->BoardSize->Visible) { // BoardSize ?>
		<!-- BoardSize -->
		<td<?php echo $bill_board_preview->BoardSize->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BoardSize->viewAttributes() ?>><?php echo $bill_board_preview->BoardSize->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->BoardType->Visible) { // BoardType ?>
		<!-- BoardType -->
		<td<?php echo $bill_board_preview->BoardType->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BoardType->viewAttributes() ?>><?php echo $bill_board_preview->BoardType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->BoardLocation->Visible) { // BoardLocation ?>
		<!-- BoardLocation -->
		<td<?php echo $bill_board_preview->BoardLocation->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BoardLocation->viewAttributes() ?>><?php echo $bill_board_preview->BoardLocation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->BoardStatus->Visible) { // BoardStatus ?>
		<!-- BoardStatus -->
		<td<?php echo $bill_board_preview->BoardStatus->cellAttributes() ?>>
<span<?php echo $bill_board_preview->BoardStatus->viewAttributes() ?>><?php echo $bill_board_preview->BoardStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->ExemptCode->Visible) { // ExemptCode ?>
		<!-- ExemptCode -->
		<td<?php echo $bill_board_preview->ExemptCode->cellAttributes() ?>>
<span<?php echo $bill_board_preview->ExemptCode->viewAttributes() ?>><?php echo $bill_board_preview->ExemptCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->StreetAddress->Visible) { // StreetAddress ?>
		<!-- StreetAddress -->
		<td<?php echo $bill_board_preview->StreetAddress->cellAttributes() ?>>
<span<?php echo $bill_board_preview->StreetAddress->viewAttributes() ?>><?php echo $bill_board_preview->StreetAddress->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->Longitude->Visible) { // Longitude ?>
		<!-- Longitude -->
		<td<?php echo $bill_board_preview->Longitude->cellAttributes() ?>>
<span<?php echo $bill_board_preview->Longitude->viewAttributes() ?>><?php echo $bill_board_preview->Longitude->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->Latitude->Visible) { // Latitude ?>
		<!-- Latitude -->
		<td<?php echo $bill_board_preview->Latitude->cellAttributes() ?>>
<span<?php echo $bill_board_preview->Latitude->viewAttributes() ?>><?php echo $bill_board_preview->Latitude->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->Incumberance->Visible) { // Incumberance ?>
		<!-- Incumberance -->
		<td<?php echo $bill_board_preview->Incumberance->cellAttributes() ?>>
<span<?php echo $bill_board_preview->Incumberance->viewAttributes() ?>><?php echo $bill_board_preview->Incumberance->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $bill_board_preview->StartDate->cellAttributes() ?>>
<span<?php echo $bill_board_preview->StartDate->viewAttributes() ?>><?php echo $bill_board_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bill_board_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $bill_board_preview->EndDate->cellAttributes() ?>>
<span<?php echo $bill_board_preview->EndDate->viewAttributes() ?>><?php echo $bill_board_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$bill_board_preview->ListOptions->render("body", "right", $bill_board_preview->RowCount);
?>
	</tr>
<?php
	$bill_board_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $bill_board_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($bill_board_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($bill_board_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$bill_board_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($bill_board_preview->Recordset)
	$bill_board_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$bill_board_preview->terminate();
?>