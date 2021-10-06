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
$salary_notch_preview = new salary_notch_preview();

// Run the page
$salary_notch_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_preview->Page_Render();
?>
<?php $salary_notch_preview->showPageHeader(); ?>
<?php if ($salary_notch_preview->TotalRecords > 0) { ?>
<div class="card ew-grid salary_notch"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$salary_notch_preview->renderListOptions();

// Render list options (header, left)
$salary_notch_preview->ListOptions->render("header", "left");
?>
<?php if ($salary_notch_preview->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($salary_notch->SortUrl($salary_notch_preview->SalaryScale) == "") { ?>
		<th class="<?php echo $salary_notch_preview->SalaryScale->headerCellClass() ?>"><?php echo $salary_notch_preview->SalaryScale->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $salary_notch_preview->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($salary_notch_preview->SalaryScale->Name) ?>" data-sort-order="<?php echo $salary_notch_preview->SortField == $salary_notch_preview->SalaryScale->Name && $salary_notch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_preview->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_preview->SortField == $salary_notch_preview->SalaryScale->Name) { ?><?php if ($salary_notch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_preview->Notch->Visible) { // Notch ?>
	<?php if ($salary_notch->SortUrl($salary_notch_preview->Notch) == "") { ?>
		<th class="<?php echo $salary_notch_preview->Notch->headerCellClass() ?>"><?php echo $salary_notch_preview->Notch->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $salary_notch_preview->Notch->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($salary_notch_preview->Notch->Name) ?>" data-sort-order="<?php echo $salary_notch_preview->SortField == $salary_notch_preview->Notch->Name && $salary_notch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_preview->Notch->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_preview->SortField == $salary_notch_preview->Notch->Name) { ?><?php if ($salary_notch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_preview->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($salary_notch->SortUrl($salary_notch_preview->BasicMonthlySalary) == "") { ?>
		<th class="<?php echo $salary_notch_preview->BasicMonthlySalary->headerCellClass() ?>"><?php echo $salary_notch_preview->BasicMonthlySalary->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $salary_notch_preview->BasicMonthlySalary->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($salary_notch_preview->BasicMonthlySalary->Name) ?>" data-sort-order="<?php echo $salary_notch_preview->SortField == $salary_notch_preview->BasicMonthlySalary->Name && $salary_notch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_preview->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_preview->SortField == $salary_notch_preview->BasicMonthlySalary->Name) { ?><?php if ($salary_notch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_preview->AnnualSalary->Visible) { // AnnualSalary ?>
	<?php if ($salary_notch->SortUrl($salary_notch_preview->AnnualSalary) == "") { ?>
		<th class="<?php echo $salary_notch_preview->AnnualSalary->headerCellClass() ?>"><?php echo $salary_notch_preview->AnnualSalary->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $salary_notch_preview->AnnualSalary->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($salary_notch_preview->AnnualSalary->Name) ?>" data-sort-order="<?php echo $salary_notch_preview->SortField == $salary_notch_preview->AnnualSalary->Name && $salary_notch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_preview->AnnualSalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_preview->SortField == $salary_notch_preview->AnnualSalary->Name) { ?><?php if ($salary_notch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$salary_notch_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$salary_notch_preview->RecCount = 0;
$salary_notch_preview->RowCount = 0;
while ($salary_notch_preview->Recordset && !$salary_notch_preview->Recordset->EOF) {

	// Init row class and style
	$salary_notch_preview->RecCount++;
	$salary_notch_preview->RowCount++;
	$salary_notch_preview->CssStyle = "";
	$salary_notch_preview->loadListRowValues($salary_notch_preview->Recordset);

	// Render row
	$salary_notch->RowType = ROWTYPE_PREVIEW; // Preview record
	$salary_notch_preview->resetAttributes();
	$salary_notch_preview->renderListRow();

	// Render list options
	$salary_notch_preview->renderListOptions();
?>
	<tr <?php echo $salary_notch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_notch_preview->ListOptions->render("body", "left", $salary_notch_preview->RowCount);
?>
<?php if ($salary_notch_preview->SalaryScale->Visible) { // SalaryScale ?>
		<!-- SalaryScale -->
		<td<?php echo $salary_notch_preview->SalaryScale->cellAttributes() ?>>
<span<?php echo $salary_notch_preview->SalaryScale->viewAttributes() ?>><?php echo $salary_notch_preview->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($salary_notch_preview->Notch->Visible) { // Notch ?>
		<!-- Notch -->
		<td<?php echo $salary_notch_preview->Notch->cellAttributes() ?>>
<span<?php echo $salary_notch_preview->Notch->viewAttributes() ?>><?php echo $salary_notch_preview->Notch->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($salary_notch_preview->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<!-- BasicMonthlySalary -->
		<td<?php echo $salary_notch_preview->BasicMonthlySalary->cellAttributes() ?>>
<span<?php echo $salary_notch_preview->BasicMonthlySalary->viewAttributes() ?>><?php echo $salary_notch_preview->BasicMonthlySalary->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($salary_notch_preview->AnnualSalary->Visible) { // AnnualSalary ?>
		<!-- AnnualSalary -->
		<td<?php echo $salary_notch_preview->AnnualSalary->cellAttributes() ?>>
<span<?php echo $salary_notch_preview->AnnualSalary->viewAttributes() ?>><?php echo $salary_notch_preview->AnnualSalary->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$salary_notch_preview->ListOptions->render("body", "right", $salary_notch_preview->RowCount);
?>
	</tr>
<?php
	$salary_notch_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $salary_notch_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($salary_notch_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($salary_notch_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$salary_notch_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($salary_notch_preview->Recordset)
	$salary_notch_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$salary_notch_preview->terminate();
?>