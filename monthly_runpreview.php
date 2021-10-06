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
$monthly_run_preview = new monthly_run_preview();

// Run the page
$monthly_run_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_run_preview->Page_Render();
?>
<?php $monthly_run_preview->showPageHeader(); ?>
<?php if ($monthly_run_preview->TotalRecords > 0) { ?>
<div class="card ew-grid monthly_run"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$monthly_run_preview->renderListOptions();

// Render list options (header, left)
$monthly_run_preview->ListOptions->render("header", "left");
?>
<?php if ($monthly_run_preview->LACode->Visible) { // LACode ?>
	<?php if ($monthly_run->SortUrl($monthly_run_preview->LACode) == "") { ?>
		<th class="<?php echo $monthly_run_preview->LACode->headerCellClass() ?>"><?php echo $monthly_run_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $monthly_run_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($monthly_run_preview->LACode->Name) ?>" data-sort-order="<?php echo $monthly_run_preview->SortField == $monthly_run_preview->LACode->Name && $monthly_run_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_preview->SortField == $monthly_run_preview->LACode->Name) { ?><?php if ($monthly_run_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_preview->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($monthly_run->SortUrl($monthly_run_preview->PeriodCode) == "") { ?>
		<th class="<?php echo $monthly_run_preview->PeriodCode->headerCellClass() ?>"><?php echo $monthly_run_preview->PeriodCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $monthly_run_preview->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($monthly_run_preview->PeriodCode->Name) ?>" data-sort-order="<?php echo $monthly_run_preview->SortField == $monthly_run_preview->PeriodCode->Name && $monthly_run_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_preview->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_preview->SortField == $monthly_run_preview->PeriodCode->Name) { ?><?php if ($monthly_run_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_preview->RunDate->Visible) { // RunDate ?>
	<?php if ($monthly_run->SortUrl($monthly_run_preview->RunDate) == "") { ?>
		<th class="<?php echo $monthly_run_preview->RunDate->headerCellClass() ?>"><?php echo $monthly_run_preview->RunDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $monthly_run_preview->RunDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($monthly_run_preview->RunDate->Name) ?>" data-sort-order="<?php echo $monthly_run_preview->SortField == $monthly_run_preview->RunDate->Name && $monthly_run_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_preview->RunDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_preview->SortField == $monthly_run_preview->RunDate->Name) { ?><?php if ($monthly_run_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_preview->Description->Visible) { // Description ?>
	<?php if ($monthly_run->SortUrl($monthly_run_preview->Description) == "") { ?>
		<th class="<?php echo $monthly_run_preview->Description->headerCellClass() ?>"><?php echo $monthly_run_preview->Description->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $monthly_run_preview->Description->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($monthly_run_preview->Description->Name) ?>" data-sort-order="<?php echo $monthly_run_preview->SortField == $monthly_run_preview->Description->Name && $monthly_run_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_preview->Description->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_preview->SortField == $monthly_run_preview->Description->Name) { ?><?php if ($monthly_run_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_preview->Year->Visible) { // Year ?>
	<?php if ($monthly_run->SortUrl($monthly_run_preview->Year) == "") { ?>
		<th class="<?php echo $monthly_run_preview->Year->headerCellClass() ?>"><?php echo $monthly_run_preview->Year->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $monthly_run_preview->Year->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($monthly_run_preview->Year->Name) ?>" data-sort-order="<?php echo $monthly_run_preview->SortField == $monthly_run_preview->Year->Name && $monthly_run_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_preview->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_preview->SortField == $monthly_run_preview->Year->Name) { ?><?php if ($monthly_run_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_preview->RunMonth->Visible) { // RunMonth ?>
	<?php if ($monthly_run->SortUrl($monthly_run_preview->RunMonth) == "") { ?>
		<th class="<?php echo $monthly_run_preview->RunMonth->headerCellClass() ?>"><?php echo $monthly_run_preview->RunMonth->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $monthly_run_preview->RunMonth->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($monthly_run_preview->RunMonth->Name) ?>" data-sort-order="<?php echo $monthly_run_preview->SortField == $monthly_run_preview->RunMonth->Name && $monthly_run_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_preview->RunMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_preview->SortField == $monthly_run_preview->RunMonth->Name) { ?><?php if ($monthly_run_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_preview->PayrollCode->Visible) { // PayrollCode ?>
	<?php if ($monthly_run->SortUrl($monthly_run_preview->PayrollCode) == "") { ?>
		<th class="<?php echo $monthly_run_preview->PayrollCode->headerCellClass() ?>"><?php echo $monthly_run_preview->PayrollCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $monthly_run_preview->PayrollCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($monthly_run_preview->PayrollCode->Name) ?>" data-sort-order="<?php echo $monthly_run_preview->SortField == $monthly_run_preview->PayrollCode->Name && $monthly_run_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_preview->PayrollCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_preview->SortField == $monthly_run_preview->PayrollCode->Name) { ?><?php if ($monthly_run_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$monthly_run_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$monthly_run_preview->RecCount = 0;
$monthly_run_preview->RowCount = 0;
while ($monthly_run_preview->Recordset && !$monthly_run_preview->Recordset->EOF) {

	// Init row class and style
	$monthly_run_preview->RecCount++;
	$monthly_run_preview->RowCount++;
	$monthly_run_preview->CssStyle = "";
	$monthly_run_preview->loadListRowValues($monthly_run_preview->Recordset);

	// Render row
	$monthly_run->RowType = ROWTYPE_PREVIEW; // Preview record
	$monthly_run_preview->resetAttributes();
	$monthly_run_preview->renderListRow();

	// Render list options
	$monthly_run_preview->renderListOptions();
?>
	<tr <?php echo $monthly_run->rowAttributes() ?>>
<?php

// Render list options (body, left)
$monthly_run_preview->ListOptions->render("body", "left", $monthly_run_preview->RowCount);
?>
<?php if ($monthly_run_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $monthly_run_preview->LACode->cellAttributes() ?>>
<span<?php echo $monthly_run_preview->LACode->viewAttributes() ?>><?php echo $monthly_run_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($monthly_run_preview->PeriodCode->Visible) { // PeriodCode ?>
		<!-- PeriodCode -->
		<td<?php echo $monthly_run_preview->PeriodCode->cellAttributes() ?>>
<span<?php echo $monthly_run_preview->PeriodCode->viewAttributes() ?>><?php echo $monthly_run_preview->PeriodCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($monthly_run_preview->RunDate->Visible) { // RunDate ?>
		<!-- RunDate -->
		<td<?php echo $monthly_run_preview->RunDate->cellAttributes() ?>>
<span<?php echo $monthly_run_preview->RunDate->viewAttributes() ?>><?php echo $monthly_run_preview->RunDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($monthly_run_preview->Description->Visible) { // Description ?>
		<!-- Description -->
		<td<?php echo $monthly_run_preview->Description->cellAttributes() ?>>
<span<?php echo $monthly_run_preview->Description->viewAttributes() ?>><?php echo $monthly_run_preview->Description->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($monthly_run_preview->Year->Visible) { // Year ?>
		<!-- Year -->
		<td<?php echo $monthly_run_preview->Year->cellAttributes() ?>>
<span<?php echo $monthly_run_preview->Year->viewAttributes() ?>><?php echo $monthly_run_preview->Year->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($monthly_run_preview->RunMonth->Visible) { // RunMonth ?>
		<!-- RunMonth -->
		<td<?php echo $monthly_run_preview->RunMonth->cellAttributes() ?>>
<span<?php echo $monthly_run_preview->RunMonth->viewAttributes() ?>><?php echo $monthly_run_preview->RunMonth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($monthly_run_preview->PayrollCode->Visible) { // PayrollCode ?>
		<!-- PayrollCode -->
		<td<?php echo $monthly_run_preview->PayrollCode->cellAttributes() ?>>
<span<?php echo $monthly_run_preview->PayrollCode->viewAttributes() ?>><?php echo $monthly_run_preview->PayrollCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$monthly_run_preview->ListOptions->render("body", "right", $monthly_run_preview->RowCount);
?>
	</tr>
<?php
	$monthly_run_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $monthly_run_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($monthly_run_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($monthly_run_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$monthly_run_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($monthly_run_preview->Recordset)
	$monthly_run_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$monthly_run_preview->terminate();
?>