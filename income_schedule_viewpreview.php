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
$income_schedule_view_preview = new income_schedule_view_preview();

// Run the page
$income_schedule_view_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_schedule_view_preview->Page_Render();
?>
<?php $income_schedule_view_preview->showPageHeader(); ?>
<?php if ($income_schedule_view_preview->TotalRecords > 0) { ?>
<div class="card ew-grid income_schedule_view"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$income_schedule_view_preview->renderListOptions();

// Render list options (header, left)
$income_schedule_view_preview->ListOptions->render("header", "left");
?>
<?php if ($income_schedule_view_preview->LAName->Visible) { // LAName ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->LAName) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->LAName->headerCellClass() ?>"><?php echo $income_schedule_view_preview->LAName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->LAName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->LAName->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->LAName->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->LAName->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->NRC->Visible) { // NRC ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->NRC) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->NRC->headerCellClass() ?>"><?php echo $income_schedule_view_preview->NRC->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->NRC->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->NRC->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->NRC->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->NRC->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->Surname->Visible) { // Surname ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->Surname) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->Surname->headerCellClass() ?>"><?php echo $income_schedule_view_preview->Surname->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->Surname->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->Surname->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->Surname->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->Surname->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->MiddleName->Visible) { // MiddleName ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->MiddleName) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->MiddleName->headerCellClass() ?>"><?php echo $income_schedule_view_preview->MiddleName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->MiddleName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->MiddleName->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->MiddleName->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->MiddleName->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->FirstName->Visible) { // FirstName ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->FirstName) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->FirstName->headerCellClass() ?>"><?php echo $income_schedule_view_preview->FirstName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->FirstName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->FirstName->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->FirstName->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->FirstName->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->PositionName->Visible) { // PositionName ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->PositionName) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->PositionName->headerCellClass() ?>"><?php echo $income_schedule_view_preview->PositionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->PositionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->PositionName->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->PositionName->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->PositionName->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->EmployeeID->headerCellClass() ?>"><?php echo $income_schedule_view_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->EmployeeID->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->EmployeeID->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->PayrollDate) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->PayrollDate->headerCellClass() ?>"><?php echo $income_schedule_view_preview->PayrollDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->PayrollDate->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->PayrollDate->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->PayrollDate->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->Income->Visible) { // Income ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->Income) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->Income->headerCellClass() ?>"><?php echo $income_schedule_view_preview->Income->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->Income->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->Income->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->Income->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->Income->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->IncomeName->Visible) { // IncomeName ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->IncomeName) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->IncomeName->headerCellClass() ?>"><?php echo $income_schedule_view_preview->IncomeName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->IncomeName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->IncomeName->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->IncomeName->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->IncomeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->IncomeName->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_preview->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($income_schedule_view->SortUrl($income_schedule_view_preview->PeriodCode) == "") { ?>
		<th class="<?php echo $income_schedule_view_preview->PeriodCode->headerCellClass() ?>"><?php echo $income_schedule_view_preview->PeriodCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $income_schedule_view_preview->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($income_schedule_view_preview->PeriodCode->Name) ?>" data-sort-order="<?php echo $income_schedule_view_preview->SortField == $income_schedule_view_preview->PeriodCode->Name && $income_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_preview->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_preview->SortField == $income_schedule_view_preview->PeriodCode->Name) { ?><?php if ($income_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$income_schedule_view_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$income_schedule_view_preview->RecCount = 0;
$income_schedule_view_preview->RowCount = 0;
while ($income_schedule_view_preview->Recordset && !$income_schedule_view_preview->Recordset->EOF) {

	// Init row class and style
	$income_schedule_view_preview->RecCount++;
	$income_schedule_view_preview->RowCount++;
	$income_schedule_view_preview->CssStyle = "";
	$income_schedule_view_preview->loadListRowValues($income_schedule_view_preview->Recordset);

	// Render row
	$income_schedule_view->RowType = ROWTYPE_PREVIEW; // Preview record
	$income_schedule_view_preview->resetAttributes();
	$income_schedule_view_preview->renderListRow();

	// Render list options
	$income_schedule_view_preview->renderListOptions();
?>
	<tr <?php echo $income_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$income_schedule_view_preview->ListOptions->render("body", "left", $income_schedule_view_preview->RowCount);
?>
<?php if ($income_schedule_view_preview->LAName->Visible) { // LAName ?>
		<!-- LAName -->
		<td<?php echo $income_schedule_view_preview->LAName->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->LAName->viewAttributes() ?>><?php echo $income_schedule_view_preview->LAName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->NRC->Visible) { // NRC ?>
		<!-- NRC -->
		<td<?php echo $income_schedule_view_preview->NRC->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->NRC->viewAttributes() ?>><?php echo $income_schedule_view_preview->NRC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->Surname->Visible) { // Surname ?>
		<!-- Surname -->
		<td<?php echo $income_schedule_view_preview->Surname->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->Surname->viewAttributes() ?>><?php echo $income_schedule_view_preview->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->MiddleName->Visible) { // MiddleName ?>
		<!-- MiddleName -->
		<td<?php echo $income_schedule_view_preview->MiddleName->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->MiddleName->viewAttributes() ?>><?php echo $income_schedule_view_preview->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->FirstName->Visible) { // FirstName ?>
		<!-- FirstName -->
		<td<?php echo $income_schedule_view_preview->FirstName->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->FirstName->viewAttributes() ?>><?php echo $income_schedule_view_preview->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->PositionName->Visible) { // PositionName ?>
		<!-- PositionName -->
		<td<?php echo $income_schedule_view_preview->PositionName->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->PositionName->viewAttributes() ?>><?php echo $income_schedule_view_preview->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $income_schedule_view_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->EmployeeID->viewAttributes() ?>><?php echo $income_schedule_view_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->PayrollDate->Visible) { // PayrollDate ?>
		<!-- PayrollDate -->
		<td<?php echo $income_schedule_view_preview->PayrollDate->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->PayrollDate->viewAttributes() ?>><?php echo $income_schedule_view_preview->PayrollDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->Income->Visible) { // Income ?>
		<!-- Income -->
		<td<?php echo $income_schedule_view_preview->Income->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->Income->viewAttributes() ?>><?php echo $income_schedule_view_preview->Income->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->IncomeName->Visible) { // IncomeName ?>
		<!-- IncomeName -->
		<td<?php echo $income_schedule_view_preview->IncomeName->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->IncomeName->viewAttributes() ?>><?php echo $income_schedule_view_preview->IncomeName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($income_schedule_view_preview->PeriodCode->Visible) { // PeriodCode ?>
		<!-- PeriodCode -->
		<td<?php echo $income_schedule_view_preview->PeriodCode->cellAttributes() ?>>
<span<?php echo $income_schedule_view_preview->PeriodCode->viewAttributes() ?>><?php echo $income_schedule_view_preview->PeriodCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$income_schedule_view_preview->ListOptions->render("body", "right", $income_schedule_view_preview->RowCount);
?>
	</tr>
<?php
	$income_schedule_view_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $income_schedule_view_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($income_schedule_view_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($income_schedule_view_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$income_schedule_view_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($income_schedule_view_preview->Recordset)
	$income_schedule_view_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$income_schedule_view_preview->terminate();
?>