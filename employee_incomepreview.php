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
$employee_income_preview = new employee_income_preview();

// Run the page
$employee_income_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_preview->Page_Render();
?>
<?php $employee_income_preview->showPageHeader(); ?>
<?php if ($employee_income_preview->TotalRecords > 0) { ?>
<div class="card ew-grid employee_income"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$employee_income_preview->renderListOptions();

// Render list options (header, left)
$employee_income_preview->ListOptions->render("header", "left");
?>
<?php if ($employee_income_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $employee_income_preview->EmployeeID->headerCellClass() ?>"><?php echo $employee_income_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->EmployeeID->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->EmployeeID->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->PaidPosition->Visible) { // PaidPosition ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->PaidPosition) == "") { ?>
		<th class="<?php echo $employee_income_preview->PaidPosition->headerCellClass() ?>"><?php echo $employee_income_preview->PaidPosition->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->PaidPosition->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->PaidPosition->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->PaidPosition->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->PaidPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->PaidPosition->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->PayrollDate) == "") { ?>
		<th class="<?php echo $employee_income_preview->PayrollDate->headerCellClass() ?>"><?php echo $employee_income_preview->PayrollDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->PayrollDate->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->PayrollDate->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->PayrollDate->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->PayrollPeriod) == "") { ?>
		<th class="<?php echo $employee_income_preview->PayrollPeriod->headerCellClass() ?>"><?php echo $employee_income_preview->PayrollPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->PayrollPeriod->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->PayrollPeriod->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->PayrollPeriod->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->StartDate) == "") { ?>
		<th class="<?php echo $employee_income_preview->StartDate->headerCellClass() ?>"><?php echo $employee_income_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->StartDate->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->StartDate->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->StartDate->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->EndDate->Visible) { // EndDate ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->EndDate) == "") { ?>
		<th class="<?php echo $employee_income_preview->EndDate->headerCellClass() ?>"><?php echo $employee_income_preview->EndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->EndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->EndDate->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->EndDate->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->EndDate->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->IncomeCode) == "") { ?>
		<th class="<?php echo $employee_income_preview->IncomeCode->headerCellClass() ?>"><?php echo $employee_income_preview->IncomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->IncomeCode->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->IncomeCode->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->IncomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->IncomeCode->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->Income->Visible) { // Income ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->Income) == "") { ?>
		<th class="<?php echo $employee_income_preview->Income->headerCellClass() ?>"><?php echo $employee_income_preview->Income->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->Income->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->Income->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->Income->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->Income->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->Remarks->Visible) { // Remarks ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->Remarks) == "") { ?>
		<th class="<?php echo $employee_income_preview->Remarks->headerCellClass() ?>"><?php echo $employee_income_preview->Remarks->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->Remarks->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->Remarks->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->Remarks->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->Remarks->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_preview->Taxable->Visible) { // Taxable ?>
	<?php if ($employee_income->SortUrl($employee_income_preview->Taxable) == "") { ?>
		<th class="<?php echo $employee_income_preview->Taxable->headerCellClass() ?>"><?php echo $employee_income_preview->Taxable->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_income_preview->Taxable->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_income_preview->Taxable->Name) ?>" data-sort-order="<?php echo $employee_income_preview->SortField == $employee_income_preview->Taxable->Name && $employee_income_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_preview->Taxable->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_preview->SortField == $employee_income_preview->Taxable->Name) { ?><?php if ($employee_income_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_income_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$employee_income_preview->RecCount = 0;
$employee_income_preview->RowCount = 0;
while ($employee_income_preview->Recordset && !$employee_income_preview->Recordset->EOF) {

	// Init row class and style
	$employee_income_preview->RecCount++;
	$employee_income_preview->RowCount++;
	$employee_income_preview->CssStyle = "";
	$employee_income_preview->loadListRowValues($employee_income_preview->Recordset);

	// Render row
	$employee_income->RowType = ROWTYPE_PREVIEW; // Preview record
	$employee_income_preview->resetAttributes();
	$employee_income_preview->renderListRow();

	// Render list options
	$employee_income_preview->renderListOptions();
?>
	<tr <?php echo $employee_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_income_preview->ListOptions->render("body", "left", $employee_income_preview->RowCount);
?>
<?php if ($employee_income_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $employee_income_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $employee_income_preview->EmployeeID->viewAttributes() ?>><?php echo $employee_income_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->PaidPosition->Visible) { // PaidPosition ?>
		<!-- PaidPosition -->
		<td<?php echo $employee_income_preview->PaidPosition->cellAttributes() ?>>
<span<?php echo $employee_income_preview->PaidPosition->viewAttributes() ?>><?php echo $employee_income_preview->PaidPosition->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->PayrollDate->Visible) { // PayrollDate ?>
		<!-- PayrollDate -->
		<td<?php echo $employee_income_preview->PayrollDate->cellAttributes() ?>>
<span<?php echo $employee_income_preview->PayrollDate->viewAttributes() ?>><?php echo $employee_income_preview->PayrollDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<!-- PayrollPeriod -->
		<td<?php echo $employee_income_preview->PayrollPeriod->cellAttributes() ?>>
<span<?php echo $employee_income_preview->PayrollPeriod->viewAttributes() ?>><?php echo $employee_income_preview->PayrollPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $employee_income_preview->StartDate->cellAttributes() ?>>
<span<?php echo $employee_income_preview->StartDate->viewAttributes() ?>><?php echo $employee_income_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->EndDate->Visible) { // EndDate ?>
		<!-- EndDate -->
		<td<?php echo $employee_income_preview->EndDate->cellAttributes() ?>>
<span<?php echo $employee_income_preview->EndDate->viewAttributes() ?>><?php echo $employee_income_preview->EndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->IncomeCode->Visible) { // IncomeCode ?>
		<!-- IncomeCode -->
		<td<?php echo $employee_income_preview->IncomeCode->cellAttributes() ?>>
<span<?php echo $employee_income_preview->IncomeCode->viewAttributes() ?>><?php echo $employee_income_preview->IncomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->Income->Visible) { // Income ?>
		<!-- Income -->
		<td<?php echo $employee_income_preview->Income->cellAttributes() ?>>
<span<?php echo $employee_income_preview->Income->viewAttributes() ?>><?php echo $employee_income_preview->Income->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->Remarks->Visible) { // Remarks ?>
		<!-- Remarks -->
		<td<?php echo $employee_income_preview->Remarks->cellAttributes() ?>>
<span<?php echo $employee_income_preview->Remarks->viewAttributes() ?>><?php echo $employee_income_preview->Remarks->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_income_preview->Taxable->Visible) { // Taxable ?>
		<!-- Taxable -->
		<td<?php echo $employee_income_preview->Taxable->cellAttributes() ?>>
<span<?php echo $employee_income_preview->Taxable->viewAttributes() ?>><?php echo $employee_income_preview->Taxable->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$employee_income_preview->ListOptions->render("body", "right", $employee_income_preview->RowCount);
?>
	</tr>
<?php
	$employee_income_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $employee_income_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($employee_income_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($employee_income_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$employee_income_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($employee_income_preview->Recordset)
	$employee_income_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$employee_income_preview->terminate();
?>