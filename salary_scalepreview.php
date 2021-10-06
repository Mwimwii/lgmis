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
$salary_scale_preview = new salary_scale_preview();

// Run the page
$salary_scale_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_scale_preview->Page_Render();
?>
<?php $salary_scale_preview->showPageHeader(); ?>
<?php if ($salary_scale_preview->TotalRecords > 0) { ?>
<div class="card ew-grid salary_scale"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$salary_scale_preview->renderListOptions();

// Render list options (header, left)
$salary_scale_preview->ListOptions->render("header", "left");
?>
<?php if ($salary_scale_preview->Division->Visible) { // Division ?>
	<?php if ($salary_scale->SortUrl($salary_scale_preview->Division) == "") { ?>
		<th class="<?php echo $salary_scale_preview->Division->headerCellClass() ?>"><?php echo $salary_scale_preview->Division->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $salary_scale_preview->Division->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($salary_scale_preview->Division->Name) ?>" data-sort-order="<?php echo $salary_scale_preview->SortField == $salary_scale_preview->Division->Name && $salary_scale_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_scale_preview->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_scale_preview->SortField == $salary_scale_preview->Division->Name) { ?><?php if ($salary_scale_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_scale_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_scale_preview->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($salary_scale->SortUrl($salary_scale_preview->SalaryScale) == "") { ?>
		<th class="<?php echo $salary_scale_preview->SalaryScale->headerCellClass() ?>"><?php echo $salary_scale_preview->SalaryScale->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $salary_scale_preview->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($salary_scale_preview->SalaryScale->Name) ?>" data-sort-order="<?php echo $salary_scale_preview->SortField == $salary_scale_preview->SalaryScale->Name && $salary_scale_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_scale_preview->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_scale_preview->SortField == $salary_scale_preview->SalaryScale->Name) { ?><?php if ($salary_scale_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_scale_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$salary_scale_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$salary_scale_preview->RecCount = 0;
$salary_scale_preview->RowCount = 0;
while ($salary_scale_preview->Recordset && !$salary_scale_preview->Recordset->EOF) {

	// Init row class and style
	$salary_scale_preview->RecCount++;
	$salary_scale_preview->RowCount++;
	$salary_scale_preview->CssStyle = "";
	$salary_scale_preview->loadListRowValues($salary_scale_preview->Recordset);

	// Render row
	$salary_scale->RowType = ROWTYPE_PREVIEW; // Preview record
	$salary_scale_preview->resetAttributes();
	$salary_scale_preview->renderListRow();

	// Render list options
	$salary_scale_preview->renderListOptions();
?>
	<tr <?php echo $salary_scale->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_scale_preview->ListOptions->render("body", "left", $salary_scale_preview->RowCount);
?>
<?php if ($salary_scale_preview->Division->Visible) { // Division ?>
		<!-- Division -->
		<td<?php echo $salary_scale_preview->Division->cellAttributes() ?>>
<span<?php echo $salary_scale_preview->Division->viewAttributes() ?>><?php echo $salary_scale_preview->Division->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($salary_scale_preview->SalaryScale->Visible) { // SalaryScale ?>
		<!-- SalaryScale -->
		<td<?php echo $salary_scale_preview->SalaryScale->cellAttributes() ?>>
<span<?php echo $salary_scale_preview->SalaryScale->viewAttributes() ?>><?php echo $salary_scale_preview->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$salary_scale_preview->ListOptions->render("body", "right", $salary_scale_preview->RowCount);
?>
	</tr>
<?php
	$salary_scale_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $salary_scale_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($salary_scale_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($salary_scale_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$salary_scale_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($salary_scale_preview->Recordset)
	$salary_scale_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$salary_scale_preview->terminate();
?>