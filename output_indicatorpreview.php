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
$output_indicator_preview = new output_indicator_preview();

// Run the page
$output_indicator_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_preview->Page_Render();
?>
<?php $output_indicator_preview->showPageHeader(); ?>
<?php if ($output_indicator_preview->TotalRecords > 0) { ?>
<div class="card ew-grid output_indicator"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$output_indicator_preview->renderListOptions();

// Render list options (header, left)
$output_indicator_preview->ListOptions->render("header", "left");
?>
<?php if ($output_indicator_preview->IndicatorNo->Visible) { // IndicatorNo ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->IndicatorNo) == "") { ?>
		<th class="<?php echo $output_indicator_preview->IndicatorNo->headerCellClass() ?>"><?php echo $output_indicator_preview->IndicatorNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->IndicatorNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->IndicatorNo->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->IndicatorNo->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->IndicatorNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->IndicatorNo->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->LACode->Visible) { // LACode ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->LACode) == "") { ?>
		<th class="<?php echo $output_indicator_preview->LACode->headerCellClass() ?>"><?php echo $output_indicator_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->LACode->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->LACode->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->LACode->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $output_indicator_preview->DepartmentCode->headerCellClass() ?>"><?php echo $output_indicator_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->DepartmentCode->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->DepartmentCode->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->SectionCode) == "") { ?>
		<th class="<?php echo $output_indicator_preview->SectionCode->headerCellClass() ?>"><?php echo $output_indicator_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->SectionCode->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->SectionCode->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->OutputCode->Visible) { // OutputCode ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->OutputCode) == "") { ?>
		<th class="<?php echo $output_indicator_preview->OutputCode->headerCellClass() ?>"><?php echo $output_indicator_preview->OutputCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->OutputCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->OutputCode->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->OutputCode->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->OutputCode->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->OutcomeCode) == "") { ?>
		<th class="<?php echo $output_indicator_preview->OutcomeCode->headerCellClass() ?>"><?php echo $output_indicator_preview->OutcomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->OutcomeCode->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->OutcomeCode->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->OutcomeCode->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->OutputType->Visible) { // OutputType ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->OutputType) == "") { ?>
		<th class="<?php echo $output_indicator_preview->OutputType->headerCellClass() ?>"><?php echo $output_indicator_preview->OutputType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->OutputType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->OutputType->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->OutputType->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->OutputType->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->OutputType->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->ProgramCode) == "") { ?>
		<th class="<?php echo $output_indicator_preview->ProgramCode->headerCellClass() ?>"><?php echo $output_indicator_preview->ProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->ProgramCode->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->ProgramCode->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->ProgramCode->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->SubProgramCode) == "") { ?>
		<th class="<?php echo $output_indicator_preview->SubProgramCode->headerCellClass() ?>"><?php echo $output_indicator_preview->SubProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->SubProgramCode->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->SubProgramCode->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->SubProgramCode->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->FinancialYear) == "") { ?>
		<th class="<?php echo $output_indicator_preview->FinancialYear->headerCellClass() ?>"><?php echo $output_indicator_preview->FinancialYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->FinancialYear->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->FinancialYear->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->FinancialYear->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->OutputIndicatorName) == "") { ?>
		<th class="<?php echo $output_indicator_preview->OutputIndicatorName->headerCellClass() ?>"><?php echo $output_indicator_preview->OutputIndicatorName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->OutputIndicatorName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->OutputIndicatorName->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->OutputIndicatorName->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->OutputIndicatorName->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->OutputIndicatorName->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->TargetAmount->Visible) { // TargetAmount ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->TargetAmount) == "") { ?>
		<th class="<?php echo $output_indicator_preview->TargetAmount->headerCellClass() ?>"><?php echo $output_indicator_preview->TargetAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->TargetAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->TargetAmount->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->TargetAmount->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->TargetAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->TargetAmount->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->ActualAmount) == "") { ?>
		<th class="<?php echo $output_indicator_preview->ActualAmount->headerCellClass() ?>"><?php echo $output_indicator_preview->ActualAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->ActualAmount->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->ActualAmount->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->ActualAmount->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_preview->PercentAchieved->Visible) { // PercentAchieved ?>
	<?php if ($output_indicator->SortUrl($output_indicator_preview->PercentAchieved) == "") { ?>
		<th class="<?php echo $output_indicator_preview->PercentAchieved->headerCellClass() ?>"><?php echo $output_indicator_preview->PercentAchieved->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_indicator_preview->PercentAchieved->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_indicator_preview->PercentAchieved->Name) ?>" data-sort-order="<?php echo $output_indicator_preview->SortField == $output_indicator_preview->PercentAchieved->Name && $output_indicator_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_preview->PercentAchieved->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_preview->SortField == $output_indicator_preview->PercentAchieved->Name) { ?><?php if ($output_indicator_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$output_indicator_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$output_indicator_preview->RecCount = 0;
$output_indicator_preview->RowCount = 0;
while ($output_indicator_preview->Recordset && !$output_indicator_preview->Recordset->EOF) {

	// Init row class and style
	$output_indicator_preview->RecCount++;
	$output_indicator_preview->RowCount++;
	$output_indicator_preview->CssStyle = "";
	$output_indicator_preview->loadListRowValues($output_indicator_preview->Recordset);

	// Render row
	$output_indicator->RowType = ROWTYPE_PREVIEW; // Preview record
	$output_indicator_preview->resetAttributes();
	$output_indicator_preview->renderListRow();

	// Render list options
	$output_indicator_preview->renderListOptions();
?>
	<tr <?php echo $output_indicator->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_indicator_preview->ListOptions->render("body", "left", $output_indicator_preview->RowCount);
?>
<?php if ($output_indicator_preview->IndicatorNo->Visible) { // IndicatorNo ?>
		<!-- IndicatorNo -->
		<td<?php echo $output_indicator_preview->IndicatorNo->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->IndicatorNo->viewAttributes() ?>><?php echo $output_indicator_preview->IndicatorNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $output_indicator_preview->LACode->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->LACode->viewAttributes() ?>><?php echo $output_indicator_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $output_indicator_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->DepartmentCode->viewAttributes() ?>><?php echo $output_indicator_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $output_indicator_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->SectionCode->viewAttributes() ?>><?php echo $output_indicator_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->OutputCode->Visible) { // OutputCode ?>
		<!-- OutputCode -->
		<td<?php echo $output_indicator_preview->OutputCode->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->OutputCode->viewAttributes() ?>><?php echo $output_indicator_preview->OutputCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->OutcomeCode->Visible) { // OutcomeCode ?>
		<!-- OutcomeCode -->
		<td<?php echo $output_indicator_preview->OutcomeCode->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->OutcomeCode->viewAttributes() ?>><?php echo $output_indicator_preview->OutcomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->OutputType->Visible) { // OutputType ?>
		<!-- OutputType -->
		<td<?php echo $output_indicator_preview->OutputType->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->OutputType->viewAttributes() ?>><?php echo $output_indicator_preview->OutputType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->ProgramCode->Visible) { // ProgramCode ?>
		<!-- ProgramCode -->
		<td<?php echo $output_indicator_preview->ProgramCode->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->ProgramCode->viewAttributes() ?>><?php echo $output_indicator_preview->ProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->SubProgramCode->Visible) { // SubProgramCode ?>
		<!-- SubProgramCode -->
		<td<?php echo $output_indicator_preview->SubProgramCode->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->SubProgramCode->viewAttributes() ?>><?php echo $output_indicator_preview->SubProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->FinancialYear->Visible) { // FinancialYear ?>
		<!-- FinancialYear -->
		<td<?php echo $output_indicator_preview->FinancialYear->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->FinancialYear->viewAttributes() ?>><?php echo $output_indicator_preview->FinancialYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<!-- OutputIndicatorName -->
		<td<?php echo $output_indicator_preview->OutputIndicatorName->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->OutputIndicatorName->viewAttributes() ?>><?php echo $output_indicator_preview->OutputIndicatorName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->TargetAmount->Visible) { // TargetAmount ?>
		<!-- TargetAmount -->
		<td<?php echo $output_indicator_preview->TargetAmount->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->TargetAmount->viewAttributes() ?>><?php echo $output_indicator_preview->TargetAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->ActualAmount->Visible) { // ActualAmount ?>
		<!-- ActualAmount -->
		<td<?php echo $output_indicator_preview->ActualAmount->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->ActualAmount->viewAttributes() ?>><?php echo $output_indicator_preview->ActualAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_indicator_preview->PercentAchieved->Visible) { // PercentAchieved ?>
		<!-- PercentAchieved -->
		<td<?php echo $output_indicator_preview->PercentAchieved->cellAttributes() ?>>
<span<?php echo $output_indicator_preview->PercentAchieved->viewAttributes() ?>><?php echo $output_indicator_preview->PercentAchieved->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$output_indicator_preview->ListOptions->render("body", "right", $output_indicator_preview->RowCount);
?>
	</tr>
<?php
	$output_indicator_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $output_indicator_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($output_indicator_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($output_indicator_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$output_indicator_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($output_indicator_preview->Recordset)
	$output_indicator_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$output_indicator_preview->terminate();
?>