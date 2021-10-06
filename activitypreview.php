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
$activity_preview = new activity_preview();

// Run the page
$activity_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_preview->Page_Render();
?>
<?php $activity_preview->showPageHeader(); ?>
<?php if ($activity_preview->TotalRecords > 0) { ?>
<div class="card ew-grid activity"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$activity_preview->renderListOptions();

// Render list options (header, left)
$activity_preview->ListOptions->render("header", "left");
?>
<?php if ($activity_preview->LACode->Visible) { // LACode ?>
	<?php if ($activity->SortUrl($activity_preview->LACode) == "") { ?>
		<th class="<?php echo $activity_preview->LACode->headerCellClass() ?>"><?php echo $activity_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->LACode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->LACode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->LACode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($activity->SortUrl($activity_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $activity_preview->DepartmentCode->headerCellClass() ?>"><?php echo $activity_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->DepartmentCode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->DepartmentCode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($activity->SortUrl($activity_preview->SectionCode) == "") { ?>
		<th class="<?php echo $activity_preview->SectionCode->headerCellClass() ?>"><?php echo $activity_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->SectionCode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->SectionCode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<?php if ($activity->SortUrl($activity_preview->ProgrammeCode) == "") { ?>
		<th class="<?php echo $activity_preview->ProgrammeCode->headerCellClass() ?>"><?php echo $activity_preview->ProgrammeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->ProgrammeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->ProgrammeCode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->ProgrammeCode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->ProgrammeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->ProgrammeCode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->OucomeCode->Visible) { // OucomeCode ?>
	<?php if ($activity->SortUrl($activity_preview->OucomeCode) == "") { ?>
		<th class="<?php echo $activity_preview->OucomeCode->headerCellClass() ?>"><?php echo $activity_preview->OucomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->OucomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->OucomeCode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->OucomeCode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->OucomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->OucomeCode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->OutputCode->Visible) { // OutputCode ?>
	<?php if ($activity->SortUrl($activity_preview->OutputCode) == "") { ?>
		<th class="<?php echo $activity_preview->OutputCode->headerCellClass() ?>"><?php echo $activity_preview->OutputCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->OutputCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->OutputCode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->OutputCode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->OutputCode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($activity->SortUrl($activity_preview->ProjectCode) == "") { ?>
		<th class="<?php echo $activity_preview->ProjectCode->headerCellClass() ?>"><?php echo $activity_preview->ProjectCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->ProjectCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->ProjectCode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->ProjectCode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->ProjectCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->ProjectCode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->ActivityCode->Visible) { // ActivityCode ?>
	<?php if ($activity->SortUrl($activity_preview->ActivityCode) == "") { ?>
		<th class="<?php echo $activity_preview->ActivityCode->headerCellClass() ?>"><?php echo $activity_preview->ActivityCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->ActivityCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->ActivityCode->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->ActivityCode->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->ActivityCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->ActivityCode->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($activity->SortUrl($activity_preview->FinancialYear) == "") { ?>
		<th class="<?php echo $activity_preview->FinancialYear->headerCellClass() ?>"><?php echo $activity_preview->FinancialYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->FinancialYear->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->FinancialYear->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->FinancialYear->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->ActivityName->Visible) { // ActivityName ?>
	<?php if ($activity->SortUrl($activity_preview->ActivityName) == "") { ?>
		<th class="<?php echo $activity_preview->ActivityName->headerCellClass() ?>"><?php echo $activity_preview->ActivityName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->ActivityName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->ActivityName->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->ActivityName->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->ActivityName->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->ActivityName->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->MTEFBudget->Visible) { // MTEFBudget ?>
	<?php if ($activity->SortUrl($activity_preview->MTEFBudget) == "") { ?>
		<th class="<?php echo $activity_preview->MTEFBudget->headerCellClass() ?>"><?php echo $activity_preview->MTEFBudget->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->MTEFBudget->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->MTEFBudget->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->MTEFBudget->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->MTEFBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->MTEFBudget->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<?php if ($activity->SortUrl($activity_preview->SupplementaryBudget) == "") { ?>
		<th class="<?php echo $activity_preview->SupplementaryBudget->headerCellClass() ?>"><?php echo $activity_preview->SupplementaryBudget->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->SupplementaryBudget->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->SupplementaryBudget->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->SupplementaryBudget->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->SupplementaryBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->SupplementaryBudget->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<?php if ($activity->SortUrl($activity_preview->ExpectedAnnualAchievement) == "") { ?>
		<th class="<?php echo $activity_preview->ExpectedAnnualAchievement->headerCellClass() ?>"><?php echo $activity_preview->ExpectedAnnualAchievement->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->ExpectedAnnualAchievement->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->ExpectedAnnualAchievement->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->ExpectedAnnualAchievement->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->ExpectedAnnualAchievement->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->ExpectedAnnualAchievement->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($activity_preview->ActivityLocation->Visible) { // ActivityLocation ?>
	<?php if ($activity->SortUrl($activity_preview->ActivityLocation) == "") { ?>
		<th class="<?php echo $activity_preview->ActivityLocation->headerCellClass() ?>"><?php echo $activity_preview->ActivityLocation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $activity_preview->ActivityLocation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($activity_preview->ActivityLocation->Name) ?>" data-sort-order="<?php echo $activity_preview->SortField == $activity_preview->ActivityLocation->Name && $activity_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $activity_preview->ActivityLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($activity_preview->SortField == $activity_preview->ActivityLocation->Name) { ?><?php if ($activity_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($activity_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$activity_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$activity_preview->RecCount = 0;
$activity_preview->RowCount = 0;
while ($activity_preview->Recordset && !$activity_preview->Recordset->EOF) {

	// Init row class and style
	$activity_preview->RecCount++;
	$activity_preview->RowCount++;
	$activity_preview->CssStyle = "";
	$activity_preview->loadListRowValues($activity_preview->Recordset);

	// Render row
	$activity->RowType = ROWTYPE_PREVIEW; // Preview record
	$activity_preview->resetAttributes();
	$activity_preview->renderListRow();

	// Render list options
	$activity_preview->renderListOptions();
?>
	<tr <?php echo $activity->rowAttributes() ?>>
<?php

// Render list options (body, left)
$activity_preview->ListOptions->render("body", "left", $activity_preview->RowCount);
?>
<?php if ($activity_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $activity_preview->LACode->cellAttributes() ?>>
<span<?php echo $activity_preview->LACode->viewAttributes() ?>><?php echo $activity_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $activity_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $activity_preview->DepartmentCode->viewAttributes() ?>><?php echo $activity_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $activity_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $activity_preview->SectionCode->viewAttributes() ?>><?php echo $activity_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<!-- ProgrammeCode -->
		<td<?php echo $activity_preview->ProgrammeCode->cellAttributes() ?>>
<span<?php echo $activity_preview->ProgrammeCode->viewAttributes() ?>><?php echo $activity_preview->ProgrammeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->OucomeCode->Visible) { // OucomeCode ?>
		<!-- OucomeCode -->
		<td<?php echo $activity_preview->OucomeCode->cellAttributes() ?>>
<span<?php echo $activity_preview->OucomeCode->viewAttributes() ?>><?php echo $activity_preview->OucomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->OutputCode->Visible) { // OutputCode ?>
		<!-- OutputCode -->
		<td<?php echo $activity_preview->OutputCode->cellAttributes() ?>>
<span<?php echo $activity_preview->OutputCode->viewAttributes() ?>><?php echo $activity_preview->OutputCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->ProjectCode->Visible) { // ProjectCode ?>
		<!-- ProjectCode -->
		<td<?php echo $activity_preview->ProjectCode->cellAttributes() ?>>
<span<?php echo $activity_preview->ProjectCode->viewAttributes() ?>><?php echo $activity_preview->ProjectCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->ActivityCode->Visible) { // ActivityCode ?>
		<!-- ActivityCode -->
		<td<?php echo $activity_preview->ActivityCode->cellAttributes() ?>>
<span<?php echo $activity_preview->ActivityCode->viewAttributes() ?>><?php echo $activity_preview->ActivityCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->FinancialYear->Visible) { // FinancialYear ?>
		<!-- FinancialYear -->
		<td<?php echo $activity_preview->FinancialYear->cellAttributes() ?>>
<span<?php echo $activity_preview->FinancialYear->viewAttributes() ?>><?php echo $activity_preview->FinancialYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->ActivityName->Visible) { // ActivityName ?>
		<!-- ActivityName -->
		<td<?php echo $activity_preview->ActivityName->cellAttributes() ?>>
<span<?php echo $activity_preview->ActivityName->viewAttributes() ?>><?php echo $activity_preview->ActivityName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->MTEFBudget->Visible) { // MTEFBudget ?>
		<!-- MTEFBudget -->
		<td<?php echo $activity_preview->MTEFBudget->cellAttributes() ?>>
<span<?php echo $activity_preview->MTEFBudget->viewAttributes() ?>><?php echo $activity_preview->MTEFBudget->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
		<!-- SupplementaryBudget -->
		<td<?php echo $activity_preview->SupplementaryBudget->cellAttributes() ?>>
<span<?php echo $activity_preview->SupplementaryBudget->viewAttributes() ?>><?php echo $activity_preview->SupplementaryBudget->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<!-- ExpectedAnnualAchievement -->
		<td<?php echo $activity_preview->ExpectedAnnualAchievement->cellAttributes() ?>>
<span<?php echo $activity_preview->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $activity_preview->ExpectedAnnualAchievement->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($activity_preview->ActivityLocation->Visible) { // ActivityLocation ?>
		<!-- ActivityLocation -->
		<td<?php echo $activity_preview->ActivityLocation->cellAttributes() ?>>
<span<?php echo $activity_preview->ActivityLocation->viewAttributes() ?>><?php echo $activity_preview->ActivityLocation->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$activity_preview->ListOptions->render("body", "right", $activity_preview->RowCount);
?>
	</tr>
<?php
	$activity_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $activity_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($activity_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($activity_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$activity_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($activity_preview->Recordset)
	$activity_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$activity_preview->terminate();
?>