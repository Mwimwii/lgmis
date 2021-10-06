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
$department_preview = new department_preview();

// Run the page
$department_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_preview->Page_Render();
?>
<?php $department_preview->showPageHeader(); ?>
<?php if ($department_preview->TotalRecords > 0) { ?>
<div class="card ew-grid department"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$department_preview->renderListOptions();

// Render list options (header, left)
$department_preview->ListOptions->render("header", "left");
?>
<?php if ($department_preview->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($department->SortUrl($department_preview->DepartmentName) == "") { ?>
		<th class="<?php echo $department_preview->DepartmentName->headerCellClass() ?>"><?php echo $department_preview->DepartmentName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $department_preview->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($department_preview->DepartmentName->Name) ?>" data-sort-order="<?php echo $department_preview->SortField == $department_preview->DepartmentName->Name && $department_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_preview->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_preview->SortField == $department_preview->DepartmentName->Name) { ?><?php if ($department_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_preview->Telephone->Visible) { // Telephone ?>
	<?php if ($department->SortUrl($department_preview->Telephone) == "") { ?>
		<th class="<?php echo $department_preview->Telephone->headerCellClass() ?>"><?php echo $department_preview->Telephone->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $department_preview->Telephone->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($department_preview->Telephone->Name) ?>" data-sort-order="<?php echo $department_preview->SortField == $department_preview->Telephone->Name && $department_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_preview->Telephone->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_preview->SortField == $department_preview->Telephone->Name) { ?><?php if ($department_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_preview->_Email->Visible) { // Email ?>
	<?php if ($department->SortUrl($department_preview->_Email) == "") { ?>
		<th class="<?php echo $department_preview->_Email->headerCellClass() ?>"><?php echo $department_preview->_Email->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $department_preview->_Email->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($department_preview->_Email->Name) ?>" data-sort-order="<?php echo $department_preview->SortField == $department_preview->_Email->Name && $department_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_preview->_Email->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_preview->SortField == $department_preview->_Email->Name) { ?><?php if ($department_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_preview->LACode->Visible) { // LACode ?>
	<?php if ($department->SortUrl($department_preview->LACode) == "") { ?>
		<th class="<?php echo $department_preview->LACode->headerCellClass() ?>"><?php echo $department_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $department_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($department_preview->LACode->Name) ?>" data-sort-order="<?php echo $department_preview->SortField == $department_preview->LACode->Name && $department_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_preview->SortField == $department_preview->LACode->Name) { ?><?php if ($department_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($department_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($department->SortUrl($department_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $department_preview->ProvinceCode->headerCellClass() ?>"><?php echo $department_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $department_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($department_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $department_preview->SortField == $department_preview->ProvinceCode->Name && $department_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $department_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($department_preview->SortField == $department_preview->ProvinceCode->Name) { ?><?php if ($department_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($department_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$department_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$department_preview->RecCount = 0;
$department_preview->RowCount = 0;
while ($department_preview->Recordset && !$department_preview->Recordset->EOF) {

	// Init row class and style
	$department_preview->RecCount++;
	$department_preview->RowCount++;
	$department_preview->CssStyle = "";
	$department_preview->loadListRowValues($department_preview->Recordset);

	// Render row
	$department->RowType = ROWTYPE_PREVIEW; // Preview record
	$department_preview->resetAttributes();
	$department_preview->renderListRow();

	// Render list options
	$department_preview->renderListOptions();
?>
	<tr <?php echo $department->rowAttributes() ?>>
<?php

// Render list options (body, left)
$department_preview->ListOptions->render("body", "left", $department_preview->RowCount);
?>
<?php if ($department_preview->DepartmentName->Visible) { // DepartmentName ?>
		<!-- DepartmentName -->
		<td<?php echo $department_preview->DepartmentName->cellAttributes() ?>>
<span<?php echo $department_preview->DepartmentName->viewAttributes() ?>><?php echo $department_preview->DepartmentName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($department_preview->Telephone->Visible) { // Telephone ?>
		<!-- Telephone -->
		<td<?php echo $department_preview->Telephone->cellAttributes() ?>>
<span<?php echo $department_preview->Telephone->viewAttributes() ?>><?php echo $department_preview->Telephone->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($department_preview->_Email->Visible) { // Email ?>
		<!-- Email -->
		<td<?php echo $department_preview->_Email->cellAttributes() ?>>
<span<?php echo $department_preview->_Email->viewAttributes() ?>><?php echo $department_preview->_Email->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($department_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $department_preview->LACode->cellAttributes() ?>>
<span<?php echo $department_preview->LACode->viewAttributes() ?>><?php echo $department_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($department_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $department_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $department_preview->ProvinceCode->viewAttributes() ?>><?php echo $department_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$department_preview->ListOptions->render("body", "right", $department_preview->RowCount);
?>
	</tr>
<?php
	$department_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $department_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($department_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($department_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$department_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($department_preview->Recordset)
	$department_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$department_preview->terminate();
?>