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
$budget_preview = new budget_preview();

// Run the page
$budget_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_preview->Page_Render();
?>
<?php $budget_preview->showPageHeader(); ?>
<?php if ($budget_preview->TotalRecords > 0) { ?>
<div class="card ew-grid budget"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$budget_preview->renderListOptions();

// Render list options (header, left)
$budget_preview->ListOptions->render("header", "left");
?>
<?php if ($budget_preview->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($budget->SortUrl($budget_preview->OutcomeCode) == "") { ?>
		<th class="<?php echo $budget_preview->OutcomeCode->headerCellClass() ?>"><?php echo $budget_preview->OutcomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->OutcomeCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->OutcomeCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->OutcomeCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->OutputCode->Visible) { // OutputCode ?>
	<?php if ($budget->SortUrl($budget_preview->OutputCode) == "") { ?>
		<th class="<?php echo $budget_preview->OutputCode->headerCellClass() ?>"><?php echo $budget_preview->OutputCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->OutputCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->OutputCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->OutputCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->OutputCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->ActionCode->Visible) { // ActionCode ?>
	<?php if ($budget->SortUrl($budget_preview->ActionCode) == "") { ?>
		<th class="<?php echo $budget_preview->ActionCode->headerCellClass() ?>"><?php echo $budget_preview->ActionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->ActionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->ActionCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->ActionCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->ActionCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<?php if ($budget->SortUrl($budget_preview->DetailedActionCode) == "") { ?>
		<th class="<?php echo $budget_preview->DetailedActionCode->headerCellClass() ?>"><?php echo $budget_preview->DetailedActionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->DetailedActionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->DetailedActionCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->DetailedActionCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->DetailedActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->DetailedActionCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($budget->SortUrl($budget_preview->FinancialYear) == "") { ?>
		<th class="<?php echo $budget_preview->FinancialYear->headerCellClass() ?>"><?php echo $budget_preview->FinancialYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->FinancialYear->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->FinancialYear->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->FinancialYear->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->AccountCode->Visible) { // AccountCode ?>
	<?php if ($budget->SortUrl($budget_preview->AccountCode) == "") { ?>
		<th class="<?php echo $budget_preview->AccountCode->headerCellClass() ?>"><?php echo $budget_preview->AccountCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->AccountCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->AccountCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->AccountCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->AccountCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->AccountCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
	<?php if ($budget->SortUrl($budget_preview->MeansOfImplementation) == "") { ?>
		<th class="<?php echo $budget_preview->MeansOfImplementation->headerCellClass() ?>"><?php echo $budget_preview->MeansOfImplementation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->MeansOfImplementation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->MeansOfImplementation->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->MeansOfImplementation->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->MeansOfImplementation->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->MeansOfImplementation->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($budget->SortUrl($budget_preview->UnitOfMeasure) == "") { ?>
		<th class="<?php echo $budget_preview->UnitOfMeasure->headerCellClass() ?>"><?php echo $budget_preview->UnitOfMeasure->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->UnitOfMeasure->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->UnitOfMeasure->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->UnitOfMeasure->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->Quantity->Visible) { // Quantity ?>
	<?php if ($budget->SortUrl($budget_preview->Quantity) == "") { ?>
		<th class="<?php echo $budget_preview->Quantity->headerCellClass() ?>"><?php echo $budget_preview->Quantity->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->Quantity->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->Quantity->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->Quantity->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->Quantity->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->Frequency->Visible) { // Frequency ?>
	<?php if ($budget->SortUrl($budget_preview->Frequency) == "") { ?>
		<th class="<?php echo $budget_preview->Frequency->headerCellClass() ?>"><?php echo $budget_preview->Frequency->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->Frequency->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->Frequency->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->Frequency->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->Frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->Frequency->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->UnitCost->Visible) { // UnitCost ?>
	<?php if ($budget->SortUrl($budget_preview->UnitCost) == "") { ?>
		<th class="<?php echo $budget_preview->UnitCost->headerCellClass() ?>"><?php echo $budget_preview->UnitCost->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->UnitCost->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->UnitCost->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->UnitCost->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->UnitCost->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($budget->SortUrl($budget_preview->BudgetEstimate) == "") { ?>
		<th class="<?php echo $budget_preview->BudgetEstimate->headerCellClass() ?>"><?php echo $budget_preview->BudgetEstimate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->BudgetEstimate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->BudgetEstimate->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->BudgetEstimate->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->BudgetEstimate->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->LACode->Visible) { // LACode ?>
	<?php if ($budget->SortUrl($budget_preview->LACode) == "") { ?>
		<th class="<?php echo $budget_preview->LACode->headerCellClass() ?>"><?php echo $budget_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->LACode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->LACode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->LACode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($budget->SortUrl($budget_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $budget_preview->DepartmentCode->headerCellClass() ?>"><?php echo $budget_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->DepartmentCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->DepartmentCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($budget->SortUrl($budget_preview->SectionCode) == "") { ?>
		<th class="<?php echo $budget_preview->SectionCode->headerCellClass() ?>"><?php echo $budget_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->SectionCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->SectionCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->BudgetLine->Visible) { // BudgetLine ?>
	<?php if ($budget->SortUrl($budget_preview->BudgetLine) == "") { ?>
		<th class="<?php echo $budget_preview->BudgetLine->headerCellClass() ?>"><?php echo $budget_preview->BudgetLine->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->BudgetLine->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->BudgetLine->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->BudgetLine->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->BudgetLine->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->BudgetLine->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($budget->SortUrl($budget_preview->ProgramCode) == "") { ?>
		<th class="<?php echo $budget_preview->ProgramCode->headerCellClass() ?>"><?php echo $budget_preview->ProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->ProgramCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->ProgramCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->ProgramCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($budget->SortUrl($budget_preview->SubProgramCode) == "") { ?>
		<th class="<?php echo $budget_preview->SubProgramCode->headerCellClass() ?>"><?php echo $budget_preview->SubProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->SubProgramCode->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->SubProgramCode->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->SubProgramCode->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_preview->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<?php if ($budget->SortUrl($budget_preview->ApprovedBudget) == "") { ?>
		<th class="<?php echo $budget_preview->ApprovedBudget->headerCellClass() ?>"><?php echo $budget_preview->ApprovedBudget->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $budget_preview->ApprovedBudget->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($budget_preview->ApprovedBudget->Name) ?>" data-sort-order="<?php echo $budget_preview->SortField == $budget_preview->ApprovedBudget->Name && $budget_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_preview->ApprovedBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_preview->SortField == $budget_preview->ApprovedBudget->Name) { ?><?php if ($budget_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$budget_preview->RecCount = 0;
$budget_preview->RowCount = 0;
while ($budget_preview->Recordset && !$budget_preview->Recordset->EOF) {

	// Init row class and style
	$budget_preview->RecCount++;
	$budget_preview->RowCount++;
	$budget_preview->CssStyle = "";
	$budget_preview->loadListRowValues($budget_preview->Recordset);
	$budget_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$budget->RowType = ROWTYPE_PREVIEW; // Preview record
	$budget_preview->resetAttributes();
	$budget_preview->renderListRow();

	// Render list options
	$budget_preview->renderListOptions();
?>
	<tr <?php echo $budget->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_preview->ListOptions->render("body", "left", $budget_preview->RowCount);
?>
<?php if ($budget_preview->OutcomeCode->Visible) { // OutcomeCode ?>
		<!-- OutcomeCode -->
		<td<?php echo $budget_preview->OutcomeCode->cellAttributes() ?>>
<span<?php echo $budget_preview->OutcomeCode->viewAttributes() ?>><?php echo $budget_preview->OutcomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->OutputCode->Visible) { // OutputCode ?>
		<!-- OutputCode -->
		<td<?php echo $budget_preview->OutputCode->cellAttributes() ?>>
<span<?php echo $budget_preview->OutputCode->viewAttributes() ?>><?php echo $budget_preview->OutputCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->ActionCode->Visible) { // ActionCode ?>
		<!-- ActionCode -->
		<td<?php echo $budget_preview->ActionCode->cellAttributes() ?>>
<span<?php echo $budget_preview->ActionCode->viewAttributes() ?>><?php echo $budget_preview->ActionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<!-- DetailedActionCode -->
		<td<?php echo $budget_preview->DetailedActionCode->cellAttributes() ?>>
<span<?php echo $budget_preview->DetailedActionCode->viewAttributes() ?>><?php echo $budget_preview->DetailedActionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->FinancialYear->Visible) { // FinancialYear ?>
		<!-- FinancialYear -->
		<td<?php echo $budget_preview->FinancialYear->cellAttributes() ?>>
<span<?php echo $budget_preview->FinancialYear->viewAttributes() ?>><?php echo $budget_preview->FinancialYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->AccountCode->Visible) { // AccountCode ?>
		<!-- AccountCode -->
		<td<?php echo $budget_preview->AccountCode->cellAttributes() ?>>
<span<?php echo $budget_preview->AccountCode->viewAttributes() ?>><?php echo $budget_preview->AccountCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<!-- MeansOfImplementation -->
		<td<?php echo $budget_preview->MeansOfImplementation->cellAttributes() ?>>
<span<?php echo $budget_preview->MeansOfImplementation->viewAttributes() ?>><?php echo $budget_preview->MeansOfImplementation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td<?php echo $budget_preview->UnitOfMeasure->cellAttributes() ?>>
<span<?php echo $budget_preview->UnitOfMeasure->viewAttributes() ?>><?php echo $budget_preview->UnitOfMeasure->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->Quantity->Visible) { // Quantity ?>
		<!-- Quantity -->
		<td<?php echo $budget_preview->Quantity->cellAttributes() ?>>
<span<?php echo $budget_preview->Quantity->viewAttributes() ?>><?php echo $budget_preview->Quantity->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->Frequency->Visible) { // Frequency ?>
		<!-- Frequency -->
		<td<?php echo $budget_preview->Frequency->cellAttributes() ?>>
<span<?php echo $budget_preview->Frequency->viewAttributes() ?>><?php echo $budget_preview->Frequency->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->UnitCost->Visible) { // UnitCost ?>
		<!-- UnitCost -->
		<td<?php echo $budget_preview->UnitCost->cellAttributes() ?>>
<span<?php echo $budget_preview->UnitCost->viewAttributes() ?>><?php echo $budget_preview->UnitCost->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<!-- BudgetEstimate -->
		<td<?php echo $budget_preview->BudgetEstimate->cellAttributes() ?>>
<span<?php echo $budget_preview->BudgetEstimate->viewAttributes() ?>><?php echo $budget_preview->BudgetEstimate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $budget_preview->LACode->cellAttributes() ?>>
<span<?php echo $budget_preview->LACode->viewAttributes() ?>><?php echo $budget_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $budget_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $budget_preview->DepartmentCode->viewAttributes() ?>><?php echo $budget_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $budget_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $budget_preview->SectionCode->viewAttributes() ?>><?php echo $budget_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->BudgetLine->Visible) { // BudgetLine ?>
		<!-- BudgetLine -->
		<td<?php echo $budget_preview->BudgetLine->cellAttributes() ?>>
<span<?php echo $budget_preview->BudgetLine->viewAttributes() ?>><?php echo $budget_preview->BudgetLine->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->ProgramCode->Visible) { // ProgramCode ?>
		<!-- ProgramCode -->
		<td<?php echo $budget_preview->ProgramCode->cellAttributes() ?>>
<span<?php echo $budget_preview->ProgramCode->viewAttributes() ?>><?php echo $budget_preview->ProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->SubProgramCode->Visible) { // SubProgramCode ?>
		<!-- SubProgramCode -->
		<td<?php echo $budget_preview->SubProgramCode->cellAttributes() ?>>
<span<?php echo $budget_preview->SubProgramCode->viewAttributes() ?>><?php echo $budget_preview->SubProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($budget_preview->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<!-- ApprovedBudget -->
		<td<?php echo $budget_preview->ApprovedBudget->cellAttributes() ?>>
<span<?php echo $budget_preview->ApprovedBudget->viewAttributes() ?>><?php echo $budget_preview->ApprovedBudget->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$budget_preview->ListOptions->render("body", "right", $budget_preview->RowCount);
?>
	</tr>
<?php
	$budget_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
<?php

	// Render aggregate row
	$budget->RowType = ROWTYPE_AGGREGATE; // Aggregate
	$budget_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$budget_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$budget_preview->ListOptions->render("footer", "left");
?>
<?php if ($budget_preview->OutcomeCode->Visible) { // OutcomeCode ?>
		<!-- OutcomeCode -->
		<td class="<?php echo $budget_preview->OutcomeCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->OutputCode->Visible) { // OutputCode ?>
		<!-- OutputCode -->
		<td class="<?php echo $budget_preview->OutputCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->ActionCode->Visible) { // ActionCode ?>
		<!-- ActionCode -->
		<td class="<?php echo $budget_preview->ActionCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<!-- DetailedActionCode -->
		<td class="<?php echo $budget_preview->DetailedActionCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->FinancialYear->Visible) { // FinancialYear ?>
		<!-- FinancialYear -->
		<td class="<?php echo $budget_preview->FinancialYear->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->AccountCode->Visible) { // AccountCode ?>
		<!-- AccountCode -->
		<td class="<?php echo $budget_preview->AccountCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<!-- MeansOfImplementation -->
		<td class="<?php echo $budget_preview->MeansOfImplementation->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<!-- UnitOfMeasure -->
		<td class="<?php echo $budget_preview->UnitOfMeasure->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->Quantity->Visible) { // Quantity ?>
		<!-- Quantity -->
		<td class="<?php echo $budget_preview->Quantity->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->Frequency->Visible) { // Frequency ?>
		<!-- Frequency -->
		<td class="<?php echo $budget_preview->Frequency->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->UnitCost->Visible) { // UnitCost ?>
		<!-- UnitCost -->
		<td class="<?php echo $budget_preview->UnitCost->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<!-- BudgetEstimate -->
		<td class="<?php echo $budget_preview->BudgetEstimate->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $budget_preview->BudgetEstimate->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($budget_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td class="<?php echo $budget_preview->LACode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td class="<?php echo $budget_preview->DepartmentCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td class="<?php echo $budget_preview->SectionCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->BudgetLine->Visible) { // BudgetLine ?>
		<!-- BudgetLine -->
		<td class="<?php echo $budget_preview->BudgetLine->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->ProgramCode->Visible) { // ProgramCode ?>
		<!-- ProgramCode -->
		<td class="<?php echo $budget_preview->ProgramCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->SubProgramCode->Visible) { // SubProgramCode ?>
		<!-- SubProgramCode -->
		<td class="<?php echo $budget_preview->SubProgramCode->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($budget_preview->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<!-- ApprovedBudget -->
		<td class="<?php echo $budget_preview->ApprovedBudget->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$budget_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $budget_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($budget_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($budget_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$budget_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($budget_preview->Recordset)
	$budget_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$budget_preview->terminate();
?>