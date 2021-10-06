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
$employee_obligation_preview = new employee_obligation_preview();

// Run the page
$employee_obligation_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_preview->Page_Render();
?>
<?php $employee_obligation_preview->showPageHeader(); ?>
<?php if ($employee_obligation_preview->TotalRecords > 0) { ?>
<div class="card ew-grid employee_obligation"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$employee_obligation_preview->renderListOptions();

// Render list options (header, left)
$employee_obligation_preview->ListOptions->render("header", "left");
?>
<?php if ($employee_obligation_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->EmployeeID->headerCellClass() ?>"><?php echo $employee_obligation_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->EmployeeID->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->EmployeeID->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->PaidPosition->Visible) { // PaidPosition ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->PaidPosition) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->PaidPosition->headerCellClass() ?>"><?php echo $employee_obligation_preview->PaidPosition->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->PaidPosition->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->PaidPosition->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->PaidPosition->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->PaidPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->PaidPosition->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->PayrollDate) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->PayrollDate->headerCellClass() ?>"><?php echo $employee_obligation_preview->PayrollDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->PayrollDate->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->PayrollDate->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->PayrollDate->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->PayrollPeriod) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->PayrollPeriod->headerCellClass() ?>"><?php echo $employee_obligation_preview->PayrollPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->PayrollPeriod->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->PayrollPeriod->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->PayrollPeriod->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->StartDate->Visible) { // StartDate ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->StartDate) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->StartDate->headerCellClass() ?>"><?php echo $employee_obligation_preview->StartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->StartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->StartDate->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->StartDate->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->StartDate->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->Enddate->Visible) { // Enddate ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->Enddate) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->Enddate->headerCellClass() ?>"><?php echo $employee_obligation_preview->Enddate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->Enddate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->Enddate->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->Enddate->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->Enddate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->Enddate->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->ObligationCode->Visible) { // ObligationCode ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->ObligationCode) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->ObligationCode->headerCellClass() ?>"><?php echo $employee_obligation_preview->ObligationCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->ObligationCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->ObligationCode->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->ObligationCode->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->ObligationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->ObligationCode->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->ObligationAmount->Visible) { // ObligationAmount ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->ObligationAmount) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->ObligationAmount->headerCellClass() ?>"><?php echo $employee_obligation_preview->ObligationAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->ObligationAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->ObligationAmount->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->ObligationAmount->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->ObligationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->ObligationAmount->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_preview->Remarks->Visible) { // Remarks ?>
	<?php if ($employee_obligation->SortUrl($employee_obligation_preview->Remarks) == "") { ?>
		<th class="<?php echo $employee_obligation_preview->Remarks->headerCellClass() ?>"><?php echo $employee_obligation_preview->Remarks->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employee_obligation_preview->Remarks->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employee_obligation_preview->Remarks->Name) ?>" data-sort-order="<?php echo $employee_obligation_preview->SortField == $employee_obligation_preview->Remarks->Name && $employee_obligation_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_preview->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_preview->SortField == $employee_obligation_preview->Remarks->Name) { ?><?php if ($employee_obligation_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_obligation_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$employee_obligation_preview->RecCount = 0;
$employee_obligation_preview->RowCount = 0;
while ($employee_obligation_preview->Recordset && !$employee_obligation_preview->Recordset->EOF) {

	// Init row class and style
	$employee_obligation_preview->RecCount++;
	$employee_obligation_preview->RowCount++;
	$employee_obligation_preview->CssStyle = "";
	$employee_obligation_preview->loadListRowValues($employee_obligation_preview->Recordset);

	// Render row
	$employee_obligation->RowType = ROWTYPE_PREVIEW; // Preview record
	$employee_obligation_preview->resetAttributes();
	$employee_obligation_preview->renderListRow();

	// Render list options
	$employee_obligation_preview->renderListOptions();
?>
	<tr <?php echo $employee_obligation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_obligation_preview->ListOptions->render("body", "left", $employee_obligation_preview->RowCount);
?>
<?php if ($employee_obligation_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $employee_obligation_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->EmployeeID->viewAttributes() ?>><?php echo $employee_obligation_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->PaidPosition->Visible) { // PaidPosition ?>
		<!-- PaidPosition -->
		<td<?php echo $employee_obligation_preview->PaidPosition->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->PaidPosition->viewAttributes() ?>><?php echo $employee_obligation_preview->PaidPosition->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->PayrollDate->Visible) { // PayrollDate ?>
		<!-- PayrollDate -->
		<td<?php echo $employee_obligation_preview->PayrollDate->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->PayrollDate->viewAttributes() ?>><?php echo $employee_obligation_preview->PayrollDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<!-- PayrollPeriod -->
		<td<?php echo $employee_obligation_preview->PayrollPeriod->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->PayrollPeriod->viewAttributes() ?>><?php echo $employee_obligation_preview->PayrollPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->StartDate->Visible) { // StartDate ?>
		<!-- StartDate -->
		<td<?php echo $employee_obligation_preview->StartDate->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->StartDate->viewAttributes() ?>><?php echo $employee_obligation_preview->StartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->Enddate->Visible) { // Enddate ?>
		<!-- Enddate -->
		<td<?php echo $employee_obligation_preview->Enddate->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->Enddate->viewAttributes() ?>><?php echo $employee_obligation_preview->Enddate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->ObligationCode->Visible) { // ObligationCode ?>
		<!-- ObligationCode -->
		<td<?php echo $employee_obligation_preview->ObligationCode->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->ObligationCode->viewAttributes() ?>><?php echo $employee_obligation_preview->ObligationCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->ObligationAmount->Visible) { // ObligationAmount ?>
		<!-- ObligationAmount -->
		<td<?php echo $employee_obligation_preview->ObligationAmount->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->ObligationAmount->viewAttributes() ?>><?php echo $employee_obligation_preview->ObligationAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employee_obligation_preview->Remarks->Visible) { // Remarks ?>
		<!-- Remarks -->
		<td<?php echo $employee_obligation_preview->Remarks->cellAttributes() ?>>
<span<?php echo $employee_obligation_preview->Remarks->viewAttributes() ?>><?php echo $employee_obligation_preview->Remarks->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$employee_obligation_preview->ListOptions->render("body", "right", $employee_obligation_preview->RowCount);
?>
	</tr>
<?php
	$employee_obligation_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $employee_obligation_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($employee_obligation_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($employee_obligation_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$employee_obligation_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($employee_obligation_preview->Recordset)
	$employee_obligation_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$employee_obligation_preview->terminate();
?>