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
$project_preview = new project_preview();

// Run the page
$project_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_preview->Page_Render();
?>
<?php $project_preview->showPageHeader(); ?>
<?php if ($project_preview->TotalRecords > 0) { ?>
<div class="card ew-grid project"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$project_preview->renderListOptions();

// Render list options (header, left)
$project_preview->ListOptions->render("header", "left");
?>
<?php if ($project_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($project->SortUrl($project_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $project_preview->ProvinceCode->headerCellClass() ?>"><?php echo $project_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ProvinceCode->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ProvinceCode->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->LACode->Visible) { // LACode ?>
	<?php if ($project->SortUrl($project_preview->LACode) == "") { ?>
		<th class="<?php echo $project_preview->LACode->headerCellClass() ?>"><?php echo $project_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->LACode->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->LACode->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->LACode->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($project->SortUrl($project_preview->ProjectCode) == "") { ?>
		<th class="<?php echo $project_preview->ProjectCode->headerCellClass() ?>"><?php echo $project_preview->ProjectCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ProjectCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ProjectCode->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ProjectCode->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ProjectCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ProjectCode->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->ProjectName->Visible) { // ProjectName ?>
	<?php if ($project->SortUrl($project_preview->ProjectName) == "") { ?>
		<th class="<?php echo $project_preview->ProjectName->headerCellClass() ?>"><?php echo $project_preview->ProjectName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ProjectName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ProjectName->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ProjectName->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ProjectName->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ProjectName->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->ProjectType->Visible) { // ProjectType ?>
	<?php if ($project->SortUrl($project_preview->ProjectType) == "") { ?>
		<th class="<?php echo $project_preview->ProjectType->headerCellClass() ?>"><?php echo $project_preview->ProjectType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ProjectType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ProjectType->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ProjectType->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ProjectType->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ProjectType->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->ProjectSector->Visible) { // ProjectSector ?>
	<?php if ($project->SortUrl($project_preview->ProjectSector) == "") { ?>
		<th class="<?php echo $project_preview->ProjectSector->headerCellClass() ?>"><?php echo $project_preview->ProjectSector->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ProjectSector->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ProjectSector->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ProjectSector->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ProjectSector->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ProjectSector->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->Contractors->Visible) { // Contractors ?>
	<?php if ($project->SortUrl($project_preview->Contractors) == "") { ?>
		<th class="<?php echo $project_preview->Contractors->headerCellClass() ?>"><?php echo $project_preview->Contractors->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->Contractors->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->Contractors->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->Contractors->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->Contractors->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->Contractors->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($project->SortUrl($project_preview->PlannedStartDate) == "") { ?>
		<th class="<?php echo $project_preview->PlannedStartDate->headerCellClass() ?>"><?php echo $project_preview->PlannedStartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->PlannedStartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->PlannedStartDate->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->PlannedStartDate->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->PlannedStartDate->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($project->SortUrl($project_preview->PlannedEndDate) == "") { ?>
		<th class="<?php echo $project_preview->PlannedEndDate->headerCellClass() ?>"><?php echo $project_preview->PlannedEndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->PlannedEndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->PlannedEndDate->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->PlannedEndDate->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->PlannedEndDate->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($project->SortUrl($project_preview->ActualStartDate) == "") { ?>
		<th class="<?php echo $project_preview->ActualStartDate->headerCellClass() ?>"><?php echo $project_preview->ActualStartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ActualStartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ActualStartDate->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ActualStartDate->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ActualStartDate->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->ActualEndDate->Visible) { // ActualEndDate ?>
	<?php if ($project->SortUrl($project_preview->ActualEndDate) == "") { ?>
		<th class="<?php echo $project_preview->ActualEndDate->headerCellClass() ?>"><?php echo $project_preview->ActualEndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ActualEndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ActualEndDate->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ActualEndDate->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ActualEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ActualEndDate->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->Budget->Visible) { // Budget ?>
	<?php if ($project->SortUrl($project_preview->Budget) == "") { ?>
		<th class="<?php echo $project_preview->Budget->headerCellClass() ?>"><?php echo $project_preview->Budget->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->Budget->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->Budget->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->Budget->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->Budget->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->Budget->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->ProgressStatus->Visible) { // ProgressStatus ?>
	<?php if ($project->SortUrl($project_preview->ProgressStatus) == "") { ?>
		<th class="<?php echo $project_preview->ProgressStatus->headerCellClass() ?>"><?php echo $project_preview->ProgressStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->ProgressStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->ProgressStatus->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->ProgressStatus->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->ProgressStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->ProgressStatus->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_preview->OutstandingTasks->Visible) { // OutstandingTasks ?>
	<?php if ($project->SortUrl($project_preview->OutstandingTasks) == "") { ?>
		<th class="<?php echo $project_preview->OutstandingTasks->headerCellClass() ?>"><?php echo $project_preview->OutstandingTasks->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $project_preview->OutstandingTasks->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($project_preview->OutstandingTasks->Name) ?>" data-sort-order="<?php echo $project_preview->SortField == $project_preview->OutstandingTasks->Name && $project_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_preview->OutstandingTasks->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_preview->SortField == $project_preview->OutstandingTasks->Name) { ?><?php if ($project_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$project_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$project_preview->RecCount = 0;
$project_preview->RowCount = 0;
while ($project_preview->Recordset && !$project_preview->Recordset->EOF) {

	// Init row class and style
	$project_preview->RecCount++;
	$project_preview->RowCount++;
	$project_preview->CssStyle = "";
	$project_preview->loadListRowValues($project_preview->Recordset);

	// Render row
	$project->RowType = ROWTYPE_PREVIEW; // Preview record
	$project_preview->resetAttributes();
	$project_preview->renderListRow();

	// Render list options
	$project_preview->renderListOptions();
?>
	<tr <?php echo $project->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_preview->ListOptions->render("body", "left", $project_preview->RowCount);
?>
<?php if ($project_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $project_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $project_preview->ProvinceCode->viewAttributes() ?>><?php echo $project_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $project_preview->LACode->cellAttributes() ?>>
<span<?php echo $project_preview->LACode->viewAttributes() ?>><?php echo $project_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->ProjectCode->Visible) { // ProjectCode ?>
		<!-- ProjectCode -->
		<td<?php echo $project_preview->ProjectCode->cellAttributes() ?>>
<span<?php echo $project_preview->ProjectCode->viewAttributes() ?>><?php echo $project_preview->ProjectCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->ProjectName->Visible) { // ProjectName ?>
		<!-- ProjectName -->
		<td<?php echo $project_preview->ProjectName->cellAttributes() ?>>
<span<?php echo $project_preview->ProjectName->viewAttributes() ?>><?php echo $project_preview->ProjectName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->ProjectType->Visible) { // ProjectType ?>
		<!-- ProjectType -->
		<td<?php echo $project_preview->ProjectType->cellAttributes() ?>>
<span<?php echo $project_preview->ProjectType->viewAttributes() ?>><?php echo $project_preview->ProjectType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->ProjectSector->Visible) { // ProjectSector ?>
		<!-- ProjectSector -->
		<td<?php echo $project_preview->ProjectSector->cellAttributes() ?>>
<span<?php echo $project_preview->ProjectSector->viewAttributes() ?>><?php echo $project_preview->ProjectSector->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->Contractors->Visible) { // Contractors ?>
		<!-- Contractors -->
		<td<?php echo $project_preview->Contractors->cellAttributes() ?>>
<span<?php echo $project_preview->Contractors->viewAttributes() ?>><?php echo $project_preview->Contractors->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<!-- PlannedStartDate -->
		<td<?php echo $project_preview->PlannedStartDate->cellAttributes() ?>>
<span<?php echo $project_preview->PlannedStartDate->viewAttributes() ?>><?php echo $project_preview->PlannedStartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<!-- PlannedEndDate -->
		<td<?php echo $project_preview->PlannedEndDate->cellAttributes() ?>>
<span<?php echo $project_preview->PlannedEndDate->viewAttributes() ?>><?php echo $project_preview->PlannedEndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->ActualStartDate->Visible) { // ActualStartDate ?>
		<!-- ActualStartDate -->
		<td<?php echo $project_preview->ActualStartDate->cellAttributes() ?>>
<span<?php echo $project_preview->ActualStartDate->viewAttributes() ?>><?php echo $project_preview->ActualStartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->ActualEndDate->Visible) { // ActualEndDate ?>
		<!-- ActualEndDate -->
		<td<?php echo $project_preview->ActualEndDate->cellAttributes() ?>>
<span<?php echo $project_preview->ActualEndDate->viewAttributes() ?>><?php echo $project_preview->ActualEndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->Budget->Visible) { // Budget ?>
		<!-- Budget -->
		<td<?php echo $project_preview->Budget->cellAttributes() ?>>
<span<?php echo $project_preview->Budget->viewAttributes() ?>><?php echo $project_preview->Budget->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->ProgressStatus->Visible) { // ProgressStatus ?>
		<!-- ProgressStatus -->
		<td<?php echo $project_preview->ProgressStatus->cellAttributes() ?>>
<span<?php echo $project_preview->ProgressStatus->viewAttributes() ?>><?php echo $project_preview->ProgressStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($project_preview->OutstandingTasks->Visible) { // OutstandingTasks ?>
		<!-- OutstandingTasks -->
		<td<?php echo $project_preview->OutstandingTasks->cellAttributes() ?>>
<span<?php echo $project_preview->OutstandingTasks->viewAttributes() ?>><?php echo $project_preview->OutstandingTasks->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$project_preview->ListOptions->render("body", "right", $project_preview->RowCount);
?>
	</tr>
<?php
	$project_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $project_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($project_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($project_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$project_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($project_preview->Recordset)
	$project_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$project_preview->terminate();
?>