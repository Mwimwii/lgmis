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
$job_preview = new job_preview();

// Run the page
$job_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$job_preview->Page_Render();
?>
<?php $job_preview->showPageHeader(); ?>
<?php if ($job_preview->TotalRecords > 0) { ?>
<div class="card ew-grid job"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$job_preview->renderListOptions();

// Render list options (header, left)
$job_preview->ListOptions->render("header", "left");
?>
<?php if ($job_preview->JobCode->Visible) { // JobCode ?>
	<?php if ($job->SortUrl($job_preview->JobCode) == "") { ?>
		<th class="<?php echo $job_preview->JobCode->headerCellClass() ?>"><?php echo $job_preview->JobCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $job_preview->JobCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($job_preview->JobCode->Name) ?>" data-sort-order="<?php echo $job_preview->SortField == $job_preview->JobCode->Name && $job_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_preview->JobCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_preview->SortField == $job_preview->JobCode->Name) { ?><?php if ($job_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_preview->JobName->Visible) { // JobName ?>
	<?php if ($job->SortUrl($job_preview->JobName) == "") { ?>
		<th class="<?php echo $job_preview->JobName->headerCellClass() ?>"><?php echo $job_preview->JobName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $job_preview->JobName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($job_preview->JobName->Name) ?>" data-sort-order="<?php echo $job_preview->SortField == $job_preview->JobName->Name && $job_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_preview->JobName->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_preview->SortField == $job_preview->JobName->Name) { ?><?php if ($job_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_preview->JobGroupCode->Visible) { // JobGroupCode ?>
	<?php if ($job->SortUrl($job_preview->JobGroupCode) == "") { ?>
		<th class="<?php echo $job_preview->JobGroupCode->headerCellClass() ?>"><?php echo $job_preview->JobGroupCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $job_preview->JobGroupCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($job_preview->JobGroupCode->Name) ?>" data-sort-order="<?php echo $job_preview->SortField == $job_preview->JobGroupCode->Name && $job_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_preview->JobGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_preview->SortField == $job_preview->JobGroupCode->Name) { ?><?php if ($job_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_preview->Division->Visible) { // Division ?>
	<?php if ($job->SortUrl($job_preview->Division) == "") { ?>
		<th class="<?php echo $job_preview->Division->headerCellClass() ?>"><?php echo $job_preview->Division->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $job_preview->Division->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($job_preview->Division->Name) ?>" data-sort-order="<?php echo $job_preview->SortField == $job_preview->Division->Name && $job_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_preview->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_preview->SortField == $job_preview->Division->Name) { ?><?php if ($job_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_preview->CouncilType->Visible) { // CouncilType ?>
	<?php if ($job->SortUrl($job_preview->CouncilType) == "") { ?>
		<th class="<?php echo $job_preview->CouncilType->headerCellClass() ?>"><?php echo $job_preview->CouncilType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $job_preview->CouncilType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($job_preview->CouncilType->Name) ?>" data-sort-order="<?php echo $job_preview->SortField == $job_preview->CouncilType->Name && $job_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_preview->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_preview->SortField == $job_preview->CouncilType->Name) { ?><?php if ($job_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_preview->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($job->SortUrl($job_preview->SalaryScale) == "") { ?>
		<th class="<?php echo $job_preview->SalaryScale->headerCellClass() ?>"><?php echo $job_preview->SalaryScale->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $job_preview->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($job_preview->SalaryScale->Name) ?>" data-sort-order="<?php echo $job_preview->SortField == $job_preview->SalaryScale->Name && $job_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_preview->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_preview->SortField == $job_preview->SalaryScale->Name) { ?><?php if ($job_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$job_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$job_preview->RecCount = 0;
$job_preview->RowCount = 0;
while ($job_preview->Recordset && !$job_preview->Recordset->EOF) {

	// Init row class and style
	$job_preview->RecCount++;
	$job_preview->RowCount++;
	$job_preview->CssStyle = "";
	$job_preview->loadListRowValues($job_preview->Recordset);

	// Render row
	$job->RowType = ROWTYPE_PREVIEW; // Preview record
	$job_preview->resetAttributes();
	$job_preview->renderListRow();

	// Render list options
	$job_preview->renderListOptions();
?>
	<tr <?php echo $job->rowAttributes() ?>>
<?php

// Render list options (body, left)
$job_preview->ListOptions->render("body", "left", $job_preview->RowCount);
?>
<?php if ($job_preview->JobCode->Visible) { // JobCode ?>
		<!-- JobCode -->
		<td<?php echo $job_preview->JobCode->cellAttributes() ?>>
<span<?php echo $job_preview->JobCode->viewAttributes() ?>><?php echo $job_preview->JobCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($job_preview->JobName->Visible) { // JobName ?>
		<!-- JobName -->
		<td<?php echo $job_preview->JobName->cellAttributes() ?>>
<span<?php echo $job_preview->JobName->viewAttributes() ?>><?php echo $job_preview->JobName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($job_preview->JobGroupCode->Visible) { // JobGroupCode ?>
		<!-- JobGroupCode -->
		<td<?php echo $job_preview->JobGroupCode->cellAttributes() ?>>
<span<?php echo $job_preview->JobGroupCode->viewAttributes() ?>><?php echo $job_preview->JobGroupCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($job_preview->Division->Visible) { // Division ?>
		<!-- Division -->
		<td<?php echo $job_preview->Division->cellAttributes() ?>>
<span<?php echo $job_preview->Division->viewAttributes() ?>><?php echo $job_preview->Division->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($job_preview->CouncilType->Visible) { // CouncilType ?>
		<!-- CouncilType -->
		<td<?php echo $job_preview->CouncilType->cellAttributes() ?>>
<span<?php echo $job_preview->CouncilType->viewAttributes() ?>><?php echo $job_preview->CouncilType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($job_preview->SalaryScale->Visible) { // SalaryScale ?>
		<!-- SalaryScale -->
		<td<?php echo $job_preview->SalaryScale->cellAttributes() ?>>
<span<?php echo $job_preview->SalaryScale->viewAttributes() ?>><?php echo $job_preview->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$job_preview->ListOptions->render("body", "right", $job_preview->RowCount);
?>
	</tr>
<?php
	$job_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $job_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($job_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($job_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$job_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($job_preview->Recordset)
	$job_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$job_preview->terminate();
?>