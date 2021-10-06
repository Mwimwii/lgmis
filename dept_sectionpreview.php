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
$dept_section_preview = new dept_section_preview();

// Run the page
$dept_section_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dept_section_preview->Page_Render();
?>
<?php $dept_section_preview->showPageHeader(); ?>
<?php if ($dept_section_preview->TotalRecords > 0) { ?>
<div class="card ew-grid dept_section"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$dept_section_preview->renderListOptions();

// Render list options (header, left)
$dept_section_preview->ListOptions->render("header", "left");
?>
<?php if ($dept_section_preview->SectionName->Visible) { // SectionName ?>
	<?php if ($dept_section->SortUrl($dept_section_preview->SectionName) == "") { ?>
		<th class="<?php echo $dept_section_preview->SectionName->headerCellClass() ?>"><?php echo $dept_section_preview->SectionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $dept_section_preview->SectionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($dept_section_preview->SectionName->Name) ?>" data-sort-order="<?php echo $dept_section_preview->SortField == $dept_section_preview->SectionName->Name && $dept_section_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_preview->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_preview->SortField == $dept_section_preview->SectionName->Name) { ?><?php if ($dept_section_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_preview->Telephone->Visible) { // Telephone ?>
	<?php if ($dept_section->SortUrl($dept_section_preview->Telephone) == "") { ?>
		<th class="<?php echo $dept_section_preview->Telephone->headerCellClass() ?>"><?php echo $dept_section_preview->Telephone->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $dept_section_preview->Telephone->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($dept_section_preview->Telephone->Name) ?>" data-sort-order="<?php echo $dept_section_preview->SortField == $dept_section_preview->Telephone->Name && $dept_section_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_preview->Telephone->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_preview->SortField == $dept_section_preview->Telephone->Name) { ?><?php if ($dept_section_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_preview->_Email->Visible) { // Email ?>
	<?php if ($dept_section->SortUrl($dept_section_preview->_Email) == "") { ?>
		<th class="<?php echo $dept_section_preview->_Email->headerCellClass() ?>"><?php echo $dept_section_preview->_Email->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $dept_section_preview->_Email->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($dept_section_preview->_Email->Name) ?>" data-sort-order="<?php echo $dept_section_preview->SortField == $dept_section_preview->_Email->Name && $dept_section_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_preview->_Email->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_preview->SortField == $dept_section_preview->_Email->Name) { ?><?php if ($dept_section_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($dept_section->SortUrl($dept_section_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $dept_section_preview->ProvinceCode->headerCellClass() ?>"><?php echo $dept_section_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $dept_section_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($dept_section_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $dept_section_preview->SortField == $dept_section_preview->ProvinceCode->Name && $dept_section_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_preview->SortField == $dept_section_preview->ProvinceCode->Name) { ?><?php if ($dept_section_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_preview->LACode->Visible) { // LACode ?>
	<?php if ($dept_section->SortUrl($dept_section_preview->LACode) == "") { ?>
		<th class="<?php echo $dept_section_preview->LACode->headerCellClass() ?>"><?php echo $dept_section_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $dept_section_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($dept_section_preview->LACode->Name) ?>" data-sort-order="<?php echo $dept_section_preview->SortField == $dept_section_preview->LACode->Name && $dept_section_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_preview->SortField == $dept_section_preview->LACode->Name) { ?><?php if ($dept_section_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dept_section_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($dept_section->SortUrl($dept_section_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $dept_section_preview->DepartmentCode->headerCellClass() ?>"><?php echo $dept_section_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $dept_section_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($dept_section_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $dept_section_preview->SortField == $dept_section_preview->DepartmentCode->Name && $dept_section_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dept_section_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($dept_section_preview->SortField == $dept_section_preview->DepartmentCode->Name) { ?><?php if ($dept_section_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dept_section_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dept_section_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$dept_section_preview->RecCount = 0;
$dept_section_preview->RowCount = 0;
while ($dept_section_preview->Recordset && !$dept_section_preview->Recordset->EOF) {

	// Init row class and style
	$dept_section_preview->RecCount++;
	$dept_section_preview->RowCount++;
	$dept_section_preview->CssStyle = "";
	$dept_section_preview->loadListRowValues($dept_section_preview->Recordset);

	// Render row
	$dept_section->RowType = ROWTYPE_PREVIEW; // Preview record
	$dept_section_preview->resetAttributes();
	$dept_section_preview->renderListRow();

	// Render list options
	$dept_section_preview->renderListOptions();
?>
	<tr <?php echo $dept_section->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dept_section_preview->ListOptions->render("body", "left", $dept_section_preview->RowCount);
?>
<?php if ($dept_section_preview->SectionName->Visible) { // SectionName ?>
		<!-- SectionName -->
		<td<?php echo $dept_section_preview->SectionName->cellAttributes() ?>>
<span<?php echo $dept_section_preview->SectionName->viewAttributes() ?>><?php echo $dept_section_preview->SectionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($dept_section_preview->Telephone->Visible) { // Telephone ?>
		<!-- Telephone -->
		<td<?php echo $dept_section_preview->Telephone->cellAttributes() ?>>
<span<?php echo $dept_section_preview->Telephone->viewAttributes() ?>><?php echo $dept_section_preview->Telephone->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($dept_section_preview->_Email->Visible) { // Email ?>
		<!-- Email -->
		<td<?php echo $dept_section_preview->_Email->cellAttributes() ?>>
<span<?php echo $dept_section_preview->_Email->viewAttributes() ?>><?php echo $dept_section_preview->_Email->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($dept_section_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $dept_section_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $dept_section_preview->ProvinceCode->viewAttributes() ?>><?php echo $dept_section_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($dept_section_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $dept_section_preview->LACode->cellAttributes() ?>>
<span<?php echo $dept_section_preview->LACode->viewAttributes() ?>><?php echo $dept_section_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($dept_section_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $dept_section_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $dept_section_preview->DepartmentCode->viewAttributes() ?>><?php echo $dept_section_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$dept_section_preview->ListOptions->render("body", "right", $dept_section_preview->RowCount);
?>
	</tr>
<?php
	$dept_section_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $dept_section_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($dept_section_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($dept_section_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$dept_section_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($dept_section_preview->Recordset)
	$dept_section_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$dept_section_preview->terminate();
?>