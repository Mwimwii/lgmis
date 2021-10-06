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
$position_ref_preview = new position_ref_preview();

// Run the page
$position_ref_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_ref_preview->Page_Render();
?>
<?php $position_ref_preview->showPageHeader(); ?>
<?php if ($position_ref_preview->TotalRecords > 0) { ?>
<div class="card ew-grid position_ref"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$position_ref_preview->renderListOptions();

// Render list options (header, left)
$position_ref_preview->ListOptions->render("header", "left");
?>
<?php if ($position_ref_preview->PositionCode->Visible) { // PositionCode ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->PositionCode) == "") { ?>
		<th class="<?php echo $position_ref_preview->PositionCode->headerCellClass() ?>"><?php echo $position_ref_preview->PositionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->PositionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->PositionCode->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->PositionCode->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->PositionCode->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->PositionName->Visible) { // PositionName ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->PositionName) == "") { ?>
		<th class="<?php echo $position_ref_preview->PositionName->headerCellClass() ?>"><?php echo $position_ref_preview->PositionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->PositionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->PositionName->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->PositionName->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->PositionName->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->RequisiteQualification->Visible) { // RequisiteQualification ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->RequisiteQualification) == "") { ?>
		<th class="<?php echo $position_ref_preview->RequisiteQualification->headerCellClass() ?>"><?php echo $position_ref_preview->RequisiteQualification->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->RequisiteQualification->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->RequisiteQualification->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->RequisiteQualification->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->RequisiteQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->RequisiteQualification->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->JobCode->Visible) { // JobCode ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->JobCode) == "") { ?>
		<th class="<?php echo $position_ref_preview->JobCode->headerCellClass() ?>"><?php echo $position_ref_preview->JobCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->JobCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->JobCode->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->JobCode->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->JobCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->JobCode->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->SalaryScale) == "") { ?>
		<th class="<?php echo $position_ref_preview->SalaryScale->headerCellClass() ?>"><?php echo $position_ref_preview->SalaryScale->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->SalaryScale->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->SalaryScale->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->SalaryScale->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $position_ref_preview->ProvinceCode->headerCellClass() ?>"><?php echo $position_ref_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->ProvinceCode->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->ProvinceCode->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->LACode->Visible) { // LACode ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->LACode) == "") { ?>
		<th class="<?php echo $position_ref_preview->LACode->headerCellClass() ?>"><?php echo $position_ref_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->LACode->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->LACode->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->LACode->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $position_ref_preview->DepartmentCode->headerCellClass() ?>"><?php echo $position_ref_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->DepartmentCode->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->DepartmentCode->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_ref_preview->FieldQualified->Visible) { // FieldQualified ?>
	<?php if ($position_ref->SortUrl($position_ref_preview->FieldQualified) == "") { ?>
		<th class="<?php echo $position_ref_preview->FieldQualified->headerCellClass() ?>"><?php echo $position_ref_preview->FieldQualified->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $position_ref_preview->FieldQualified->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($position_ref_preview->FieldQualified->Name) ?>" data-sort-order="<?php echo $position_ref_preview->SortField == $position_ref_preview->FieldQualified->Name && $position_ref_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_ref_preview->FieldQualified->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_ref_preview->SortField == $position_ref_preview->FieldQualified->Name) { ?><?php if ($position_ref_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_ref_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$position_ref_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$position_ref_preview->RecCount = 0;
$position_ref_preview->RowCount = 0;
while ($position_ref_preview->Recordset && !$position_ref_preview->Recordset->EOF) {

	// Init row class and style
	$position_ref_preview->RecCount++;
	$position_ref_preview->RowCount++;
	$position_ref_preview->CssStyle = "";
	$position_ref_preview->loadListRowValues($position_ref_preview->Recordset);

	// Render row
	$position_ref->RowType = ROWTYPE_PREVIEW; // Preview record
	$position_ref_preview->resetAttributes();
	$position_ref_preview->renderListRow();

	// Render list options
	$position_ref_preview->renderListOptions();
?>
	<tr <?php echo $position_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$position_ref_preview->ListOptions->render("body", "left", $position_ref_preview->RowCount);
?>
<?php if ($position_ref_preview->PositionCode->Visible) { // PositionCode ?>
		<!-- PositionCode -->
		<td<?php echo $position_ref_preview->PositionCode->cellAttributes() ?>>
<span<?php echo $position_ref_preview->PositionCode->viewAttributes() ?>><?php echo $position_ref_preview->PositionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->PositionName->Visible) { // PositionName ?>
		<!-- PositionName -->
		<td<?php echo $position_ref_preview->PositionName->cellAttributes() ?>>
<span<?php echo $position_ref_preview->PositionName->viewAttributes() ?>><?php echo $position_ref_preview->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<!-- RequisiteQualification -->
		<td<?php echo $position_ref_preview->RequisiteQualification->cellAttributes() ?>>
<span<?php echo $position_ref_preview->RequisiteQualification->viewAttributes() ?>><?php echo $position_ref_preview->RequisiteQualification->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->JobCode->Visible) { // JobCode ?>
		<!-- JobCode -->
		<td<?php echo $position_ref_preview->JobCode->cellAttributes() ?>>
<span<?php echo $position_ref_preview->JobCode->viewAttributes() ?>><?php echo $position_ref_preview->JobCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->SalaryScale->Visible) { // SalaryScale ?>
		<!-- SalaryScale -->
		<td<?php echo $position_ref_preview->SalaryScale->cellAttributes() ?>>
<span<?php echo $position_ref_preview->SalaryScale->viewAttributes() ?>><?php echo $position_ref_preview->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $position_ref_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $position_ref_preview->ProvinceCode->viewAttributes() ?>><?php echo $position_ref_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $position_ref_preview->LACode->cellAttributes() ?>>
<span<?php echo $position_ref_preview->LACode->viewAttributes() ?>><?php echo $position_ref_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $position_ref_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $position_ref_preview->DepartmentCode->viewAttributes() ?>><?php echo $position_ref_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($position_ref_preview->FieldQualified->Visible) { // FieldQualified ?>
		<!-- FieldQualified -->
		<td<?php echo $position_ref_preview->FieldQualified->cellAttributes() ?>>
<span<?php echo $position_ref_preview->FieldQualified->viewAttributes() ?>><?php echo $position_ref_preview->FieldQualified->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$position_ref_preview->ListOptions->render("body", "right", $position_ref_preview->RowCount);
?>
	</tr>
<?php
	$position_ref_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $position_ref_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($position_ref_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($position_ref_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$position_ref_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($position_ref_preview->Recordset)
	$position_ref_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$position_ref_preview->terminate();
?>