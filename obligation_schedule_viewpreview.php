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
$obligation_schedule_view_preview = new obligation_schedule_view_preview();

// Run the page
$obligation_schedule_view_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$obligation_schedule_view_preview->Page_Render();
?>
<?php $obligation_schedule_view_preview->showPageHeader(); ?>
<?php if ($obligation_schedule_view_preview->TotalRecords > 0) { ?>
<div class="card ew-grid obligation_schedule_view"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$obligation_schedule_view_preview->renderListOptions();

// Render list options (header, left)
$obligation_schedule_view_preview->ListOptions->render("header", "left");
?>
<?php if ($obligation_schedule_view_preview->LAName->Visible) { // LAName ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->LAName) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->LAName->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->LAName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->LAName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->LAName->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->LAName->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->LAName->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->NRC->Visible) { // NRC ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->NRC) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->NRC->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->NRC->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->NRC->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->NRC->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->NRC->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->NRC->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->Surname->Visible) { // Surname ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->Surname) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->Surname->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->Surname->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->Surname->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->Surname->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->Surname->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->Surname->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->MiddleName->Visible) { // MiddleName ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->MiddleName) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->MiddleName->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->MiddleName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->MiddleName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->MiddleName->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->MiddleName->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->MiddleName->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->FirstName->Visible) { // FirstName ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->FirstName) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->FirstName->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->FirstName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->FirstName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->FirstName->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->FirstName->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->FirstName->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->PositionName->Visible) { // PositionName ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->PositionName) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->PositionName->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->PositionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->PositionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->PositionName->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->PositionName->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->PositionName->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->EmployeeID->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->EmployeeID->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->EmployeeID->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->PayrollDate) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->PayrollDate->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->PayrollDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->PayrollDate->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->PayrollDate->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->PayrollDate->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->ObligationAmount->Visible) { // ObligationAmount ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->ObligationAmount) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->ObligationAmount->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->ObligationAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->ObligationAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->ObligationAmount->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->ObligationAmount->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->ObligationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->ObligationAmount->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->DeductionName->Visible) { // DeductionName ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->DeductionName) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->DeductionName->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->DeductionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->DeductionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->DeductionName->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->DeductionName->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->DeductionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->DeductionName->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($obligation_schedule_view_preview->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($obligation_schedule_view->SortUrl($obligation_schedule_view_preview->PeriodCode) == "") { ?>
		<th class="<?php echo $obligation_schedule_view_preview->PeriodCode->headerCellClass() ?>"><?php echo $obligation_schedule_view_preview->PeriodCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $obligation_schedule_view_preview->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($obligation_schedule_view_preview->PeriodCode->Name) ?>" data-sort-order="<?php echo $obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->PeriodCode->Name && $obligation_schedule_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $obligation_schedule_view_preview->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($obligation_schedule_view_preview->SortField == $obligation_schedule_view_preview->PeriodCode->Name) { ?><?php if ($obligation_schedule_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($obligation_schedule_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$obligation_schedule_view_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$obligation_schedule_view_preview->RecCount = 0;
$obligation_schedule_view_preview->RowCount = 0;
while ($obligation_schedule_view_preview->Recordset && !$obligation_schedule_view_preview->Recordset->EOF) {

	// Init row class and style
	$obligation_schedule_view_preview->RecCount++;
	$obligation_schedule_view_preview->RowCount++;
	$obligation_schedule_view_preview->CssStyle = "";
	$obligation_schedule_view_preview->loadListRowValues($obligation_schedule_view_preview->Recordset);

	// Render row
	$obligation_schedule_view->RowType = ROWTYPE_PREVIEW; // Preview record
	$obligation_schedule_view_preview->resetAttributes();
	$obligation_schedule_view_preview->renderListRow();

	// Render list options
	$obligation_schedule_view_preview->renderListOptions();
?>
	<tr <?php echo $obligation_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$obligation_schedule_view_preview->ListOptions->render("body", "left", $obligation_schedule_view_preview->RowCount);
?>
<?php if ($obligation_schedule_view_preview->LAName->Visible) { // LAName ?>
		<!-- LAName -->
		<td<?php echo $obligation_schedule_view_preview->LAName->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->LAName->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->LAName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->NRC->Visible) { // NRC ?>
		<!-- NRC -->
		<td<?php echo $obligation_schedule_view_preview->NRC->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->NRC->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->NRC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->Surname->Visible) { // Surname ?>
		<!-- Surname -->
		<td<?php echo $obligation_schedule_view_preview->Surname->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->Surname->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->MiddleName->Visible) { // MiddleName ?>
		<!-- MiddleName -->
		<td<?php echo $obligation_schedule_view_preview->MiddleName->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->MiddleName->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->FirstName->Visible) { // FirstName ?>
		<!-- FirstName -->
		<td<?php echo $obligation_schedule_view_preview->FirstName->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->FirstName->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->PositionName->Visible) { // PositionName ?>
		<!-- PositionName -->
		<td<?php echo $obligation_schedule_view_preview->PositionName->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->PositionName->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $obligation_schedule_view_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->EmployeeID->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->PayrollDate->Visible) { // PayrollDate ?>
		<!-- PayrollDate -->
		<td<?php echo $obligation_schedule_view_preview->PayrollDate->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->PayrollDate->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->PayrollDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->ObligationAmount->Visible) { // ObligationAmount ?>
		<!-- ObligationAmount -->
		<td<?php echo $obligation_schedule_view_preview->ObligationAmount->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->ObligationAmount->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->ObligationAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->DeductionName->Visible) { // DeductionName ?>
		<!-- DeductionName -->
		<td<?php echo $obligation_schedule_view_preview->DeductionName->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->DeductionName->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->DeductionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($obligation_schedule_view_preview->PeriodCode->Visible) { // PeriodCode ?>
		<!-- PeriodCode -->
		<td<?php echo $obligation_schedule_view_preview->PeriodCode->cellAttributes() ?>>
<span<?php echo $obligation_schedule_view_preview->PeriodCode->viewAttributes() ?>><?php echo $obligation_schedule_view_preview->PeriodCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$obligation_schedule_view_preview->ListOptions->render("body", "right", $obligation_schedule_view_preview->RowCount);
?>
	</tr>
<?php
	$obligation_schedule_view_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $obligation_schedule_view_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($obligation_schedule_view_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($obligation_schedule_view_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$obligation_schedule_view_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($obligation_schedule_view_preview->Recordset)
	$obligation_schedule_view_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$obligation_schedule_view_preview->terminate();
?>