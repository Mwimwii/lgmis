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
$programme_preview = new programme_preview();

// Run the page
$programme_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_preview->Page_Render();
?>
<?php $programme_preview->showPageHeader(); ?>
<?php if ($programme_preview->TotalRecords > 0) { ?>
<div class="card ew-grid programme"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$programme_preview->renderListOptions();

// Render list options (header, left)
$programme_preview->ListOptions->render("header", "left");
?>
<?php if ($programme_preview->LACode->Visible) { // LACode ?>
	<?php if ($programme->SortUrl($programme_preview->LACode) == "") { ?>
		<th class="<?php echo $programme_preview->LACode->headerCellClass() ?>"><?php echo $programme_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $programme_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($programme_preview->LACode->Name) ?>" data-sort-order="<?php echo $programme_preview->SortField == $programme_preview->LACode->Name && $programme_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_preview->SortField == $programme_preview->LACode->Name) { ?><?php if ($programme_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($programme->SortUrl($programme_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $programme_preview->DepartmentCode->headerCellClass() ?>"><?php echo $programme_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $programme_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($programme_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $programme_preview->SortField == $programme_preview->DepartmentCode->Name && $programme_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_preview->SortField == $programme_preview->DepartmentCode->Name) { ?><?php if ($programme_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($programme->SortUrl($programme_preview->SectionCode) == "") { ?>
		<th class="<?php echo $programme_preview->SectionCode->headerCellClass() ?>"><?php echo $programme_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $programme_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($programme_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $programme_preview->SortField == $programme_preview->SectionCode->Name && $programme_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_preview->SortField == $programme_preview->SectionCode->Name) { ?><?php if ($programme_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_preview->IFMISProgramme->Visible) { // IFMISProgramme ?>
	<?php if ($programme->SortUrl($programme_preview->IFMISProgramme) == "") { ?>
		<th class="<?php echo $programme_preview->IFMISProgramme->headerCellClass() ?>"><?php echo $programme_preview->IFMISProgramme->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $programme_preview->IFMISProgramme->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($programme_preview->IFMISProgramme->Name) ?>" data-sort-order="<?php echo $programme_preview->SortField == $programme_preview->IFMISProgramme->Name && $programme_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_preview->IFMISProgramme->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_preview->SortField == $programme_preview->IFMISProgramme->Name) { ?><?php if ($programme_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_preview->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<?php if ($programme->SortUrl($programme_preview->ProgrammeCode) == "") { ?>
		<th class="<?php echo $programme_preview->ProgrammeCode->headerCellClass() ?>"><?php echo $programme_preview->ProgrammeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $programme_preview->ProgrammeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($programme_preview->ProgrammeCode->Name) ?>" data-sort-order="<?php echo $programme_preview->SortField == $programme_preview->ProgrammeCode->Name && $programme_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_preview->ProgrammeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_preview->SortField == $programme_preview->ProgrammeCode->Name) { ?><?php if ($programme_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_preview->ProgrammeName->Visible) { // ProgrammeName ?>
	<?php if ($programme->SortUrl($programme_preview->ProgrammeName) == "") { ?>
		<th class="<?php echo $programme_preview->ProgrammeName->headerCellClass() ?>"><?php echo $programme_preview->ProgrammeName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $programme_preview->ProgrammeName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($programme_preview->ProgrammeName->Name) ?>" data-sort-order="<?php echo $programme_preview->SortField == $programme_preview->ProgrammeName->Name && $programme_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_preview->ProgrammeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_preview->SortField == $programme_preview->ProgrammeName->Name) { ?><?php if ($programme_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_preview->ProgrammeType->Visible) { // ProgrammeType ?>
	<?php if ($programme->SortUrl($programme_preview->ProgrammeType) == "") { ?>
		<th class="<?php echo $programme_preview->ProgrammeType->headerCellClass() ?>"><?php echo $programme_preview->ProgrammeType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $programme_preview->ProgrammeType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($programme_preview->ProgrammeType->Name) ?>" data-sort-order="<?php echo $programme_preview->SortField == $programme_preview->ProgrammeType->Name && $programme_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_preview->ProgrammeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_preview->SortField == $programme_preview->ProgrammeType->Name) { ?><?php if ($programme_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$programme_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$programme_preview->RecCount = 0;
$programme_preview->RowCount = 0;
while ($programme_preview->Recordset && !$programme_preview->Recordset->EOF) {

	// Init row class and style
	$programme_preview->RecCount++;
	$programme_preview->RowCount++;
	$programme_preview->CssStyle = "";
	$programme_preview->loadListRowValues($programme_preview->Recordset);

	// Render row
	$programme->RowType = ROWTYPE_PREVIEW; // Preview record
	$programme_preview->resetAttributes();
	$programme_preview->renderListRow();

	// Render list options
	$programme_preview->renderListOptions();
?>
	<tr <?php echo $programme->rowAttributes() ?>>
<?php

// Render list options (body, left)
$programme_preview->ListOptions->render("body", "left", $programme_preview->RowCount);
?>
<?php if ($programme_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $programme_preview->LACode->cellAttributes() ?>>
<span<?php echo $programme_preview->LACode->viewAttributes() ?>><?php echo $programme_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($programme_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $programme_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $programme_preview->DepartmentCode->viewAttributes() ?>><?php echo $programme_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($programme_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $programme_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $programme_preview->SectionCode->viewAttributes() ?>><?php echo $programme_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($programme_preview->IFMISProgramme->Visible) { // IFMISProgramme ?>
		<!-- IFMISProgramme -->
		<td<?php echo $programme_preview->IFMISProgramme->cellAttributes() ?>>
<span<?php echo $programme_preview->IFMISProgramme->viewAttributes() ?>><?php echo $programme_preview->IFMISProgramme->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($programme_preview->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<!-- ProgrammeCode -->
		<td<?php echo $programme_preview->ProgrammeCode->cellAttributes() ?>>
<span<?php echo $programme_preview->ProgrammeCode->viewAttributes() ?>><?php echo $programme_preview->ProgrammeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($programme_preview->ProgrammeName->Visible) { // ProgrammeName ?>
		<!-- ProgrammeName -->
		<td<?php echo $programme_preview->ProgrammeName->cellAttributes() ?>>
<span<?php echo $programme_preview->ProgrammeName->viewAttributes() ?>><?php echo $programme_preview->ProgrammeName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($programme_preview->ProgrammeType->Visible) { // ProgrammeType ?>
		<!-- ProgrammeType -->
		<td<?php echo $programme_preview->ProgrammeType->cellAttributes() ?>>
<span<?php echo $programme_preview->ProgrammeType->viewAttributes() ?>><?php echo $programme_preview->ProgrammeType->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$programme_preview->ListOptions->render("body", "right", $programme_preview->RowCount);
?>
	</tr>
<?php
	$programme_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $programme_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($programme_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($programme_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$programme_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($programme_preview->Recordset)
	$programme_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$programme_preview->terminate();
?>