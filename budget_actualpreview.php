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
$budget_actual_preview = new budget_actual_preview();

// Run the page
$budget_actual_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_actual_preview->Page_Render();
?>
<?php $budget_actual_preview->showPageHeader(); ?>
<?php if ($budget_actual_preview->TotalRecords > 0) { ?>
<div class="card ew-grid budget_actual"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$budget_actual_preview->renderListOptions();

// Render list options (header, left)
$budget_actual_preview->ListOptions->render("header", "left");
?>
<?php if ($budget_actual_preview->LACode->Visible) { // LACode ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->LACode) == "") { ?>
		<th class="<?php echo $budget_actual_preview->LACode->headerCellClass() ?>"><?php echo $budget_actual_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->LACode->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->LACode->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->LACode->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $budget_actual_preview->DepartmentCode->headerCellClass() ?>"><?php echo $budget_actual_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->DepartmentCode->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->DepartmentCode->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->SectionCode) == "") { ?>
		<th class="<?php echo $budget_actual_preview->SectionCode->headerCellClass() ?>"><?php echo $budget_actual_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->SectionCode->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->SectionCode->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->AccountCode->Visible) { // AccountCode ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->AccountCode) == "") { ?>
		<th class="<?php echo $budget_actual_preview->AccountCode->headerCellClass() ?>"><?php echo $budget_actual_preview->AccountCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->AccountCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->AccountCode->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->AccountCode->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->AccountCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->AccountCode->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->PostingDate->Visible) { // PostingDate ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->PostingDate) == "") { ?>
		<th class="<?php echo $budget_actual_preview->PostingDate->headerCellClass() ?>"><?php echo $budget_actual_preview->PostingDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->PostingDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->PostingDate->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->PostingDate->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->PostingDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->PostingDate->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->AccountMonth->Visible) { // AccountMonth ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->AccountMonth) == "") { ?>
		<th class="<?php echo $budget_actual_preview->AccountMonth->headerCellClass() ?>"><?php echo $budget_actual_preview->AccountMonth->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->AccountMonth->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->AccountMonth->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->AccountMonth->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->AccountMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->AccountMonth->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->AccountYear->Visible) { // AccountYear ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->AccountYear) == "") { ?>
		<th class="<?php echo $budget_actual_preview->AccountYear->headerCellClass() ?>"><?php echo $budget_actual_preview->AccountYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->AccountYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->AccountYear->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->AccountYear->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->AccountYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->AccountYear->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->BudgetEstimate) == "") { ?>
		<th class="<?php echo $budget_actual_preview->BudgetEstimate->headerCellClass() ?>"><?php echo $budget_actual_preview->BudgetEstimate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->BudgetEstimate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->BudgetEstimate->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->BudgetEstimate->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->BudgetEstimate->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->ActualAmount) == "") { ?>
		<th class="<?php echo $budget_actual_preview->ActualAmount->headerCellClass() ?>"><?php echo $budget_actual_preview->ActualAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->ActualAmount->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->ActualAmount->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->ActualAmount->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_preview->ForecastAmount->Visible) { // ForecastAmount ?>
	<?php if ($budget_actual->SortUrl($budget_actual_preview->ForecastAmount) == "") { ?>
		<th class="<?php echo $budget_actual_preview->ForecastAmount->headerCellClass() ?>"><?php echo $budget_actual_preview->ForecastAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_actual_preview->ForecastAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_actual_preview->ForecastAmount->Name) ?>" data-sort-order="<?php echo $budget_actual_preview->SortField == $budget_actual_preview->ForecastAmount->Name && $budget_actual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_preview->ForecastAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_preview->SortField == $budget_actual_preview->ForecastAmount->Name) { ?><?php if ($budget_actual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_actual_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$budget_actual_preview->RecCount = 0;
$budget_actual_preview->RowCount = 0;
while ($budget_actual_preview->Recordset && !$budget_actual_preview->Recordset->EOF) {

	// Init row class and style
	$budget_actual_preview->RecCount++;
	$budget_actual_preview->RowCount++;
	$budget_actual_preview->CssStyle = "";
	$budget_actual_preview->loadListRowValues($budget_actual_preview->Recordset);

	// Render row
	$budget_actual->RowType = ROWTYPE_PREVIEW; // Preview record
	$budget_actual_preview->resetAttributes();
	$budget_actual_preview->renderListRow();

	// Render list options
	$budget_actual_preview->renderListOptions();
?>
	<tr <?php echo $budget_actual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_actual_preview->ListOptions->render("body", "left", $budget_actual_preview->RowCount);
?>
<?php if ($budget_actual_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $budget_actual_preview->LACode->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->LACode->viewAttributes() ?>><?php echo $budget_actual_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $budget_actual_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->DepartmentCode->viewAttributes() ?>><?php echo $budget_actual_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $budget_actual_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->SectionCode->viewAttributes() ?>><?php echo $budget_actual_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->AccountCode->Visible) { // AccountCode ?>
		<!-- AccountCode -->
		<td<?php echo $budget_actual_preview->AccountCode->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->AccountCode->viewAttributes() ?>><?php echo $budget_actual_preview->AccountCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->PostingDate->Visible) { // PostingDate ?>
		<!-- PostingDate -->
		<td<?php echo $budget_actual_preview->PostingDate->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->PostingDate->viewAttributes() ?>><?php echo $budget_actual_preview->PostingDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->AccountMonth->Visible) { // AccountMonth ?>
		<!-- AccountMonth -->
		<td<?php echo $budget_actual_preview->AccountMonth->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->AccountMonth->viewAttributes() ?>><?php echo $budget_actual_preview->AccountMonth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->AccountYear->Visible) { // AccountYear ?>
		<!-- AccountYear -->
		<td<?php echo $budget_actual_preview->AccountYear->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->AccountYear->viewAttributes() ?>><?php echo $budget_actual_preview->AccountYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<!-- BudgetEstimate -->
		<td<?php echo $budget_actual_preview->BudgetEstimate->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->BudgetEstimate->viewAttributes() ?>><?php echo $budget_actual_preview->BudgetEstimate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->ActualAmount->Visible) { // ActualAmount ?>
		<!-- ActualAmount -->
		<td<?php echo $budget_actual_preview->ActualAmount->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->ActualAmount->viewAttributes() ?>><?php echo $budget_actual_preview->ActualAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_actual_preview->ForecastAmount->Visible) { // ForecastAmount ?>
		<!-- ForecastAmount -->
		<td<?php echo $budget_actual_preview->ForecastAmount->cellAttributes() ?>>
<span<?php echo $budget_actual_preview->ForecastAmount->viewAttributes() ?>><?php echo $budget_actual_preview->ForecastAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$budget_actual_preview->ListOptions->render("body", "right", $budget_actual_preview->RowCount);
?>
	</tr>
<?php
	$budget_actual_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $budget_actual_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($budget_actual_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($budget_actual_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$budget_actual_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($budget_actual_preview->Recordset)
	$budget_actual_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$budget_actual_preview->terminate();
?>