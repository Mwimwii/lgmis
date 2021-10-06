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
$security_matrix_preview = new security_matrix_preview();

// Run the page
$security_matrix_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$security_matrix_preview->Page_Render();
?>
<?php $security_matrix_preview->showPageHeader(); ?>
<?php if ($security_matrix_preview->TotalRecords > 0) { ?>
<div class="card ew-grid security_matrix"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$security_matrix_preview->renderListOptions();

// Render list options (header, left)
$security_matrix_preview->ListOptions->render("header", "left");
?>
<?php if ($security_matrix_preview->UserCode->Visible) { // UserCode ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->UserCode) == "") { ?>
		<th class="<?php echo $security_matrix_preview->UserCode->headerCellClass() ?>"><?php echo $security_matrix_preview->UserCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->UserCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->UserCode->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->UserCode->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->UserCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->UserCode->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->PeriodCode) == "") { ?>
		<th class="<?php echo $security_matrix_preview->PeriodCode->headerCellClass() ?>"><?php echo $security_matrix_preview->PeriodCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->PeriodCode->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->PeriodCode->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->PeriodCode->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $security_matrix_preview->ProvinceCode->headerCellClass() ?>"><?php echo $security_matrix_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->ProvinceCode->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->ProvinceCode->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->LACode->Visible) { // LACode ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->LACode) == "") { ?>
		<th class="<?php echo $security_matrix_preview->LACode->headerCellClass() ?>"><?php echo $security_matrix_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->LACode->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->LACode->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->LACode->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $security_matrix_preview->DepartmentCode->headerCellClass() ?>"><?php echo $security_matrix_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->DepartmentCode->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->DepartmentCode->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->SectionCode) == "") { ?>
		<th class="<?php echo $security_matrix_preview->SectionCode->headerCellClass() ?>"><?php echo $security_matrix_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->SectionCode->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->SectionCode->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->SecurityNumber->Visible) { // SecurityNumber ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->SecurityNumber) == "") { ?>
		<th class="<?php echo $security_matrix_preview->SecurityNumber->headerCellClass() ?>"><?php echo $security_matrix_preview->SecurityNumber->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->SecurityNumber->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->SecurityNumber->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->SecurityNumber->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->SecurityNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->SecurityNumber->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->ValidFrom->Visible) { // ValidFrom ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->ValidFrom) == "") { ?>
		<th class="<?php echo $security_matrix_preview->ValidFrom->headerCellClass() ?>"><?php echo $security_matrix_preview->ValidFrom->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->ValidFrom->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->ValidFrom->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->ValidFrom->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->ValidFrom->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->ValidFrom->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->ValidTo->Visible) { // ValidTo ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->ValidTo) == "") { ?>
		<th class="<?php echo $security_matrix_preview->ValidTo->headerCellClass() ?>"><?php echo $security_matrix_preview->ValidTo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->ValidTo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->ValidTo->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->ValidTo->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->ValidTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->ValidTo->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->ApproveLevel->Visible) { // ApproveLevel ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->ApproveLevel) == "") { ?>
		<th class="<?php echo $security_matrix_preview->ApproveLevel->headerCellClass() ?>"><?php echo $security_matrix_preview->ApproveLevel->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->ApproveLevel->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->ApproveLevel->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->ApproveLevel->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->ApproveLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->ApproveLevel->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($security_matrix_preview->ActivityCode->Visible) { // ActivityCode ?>
	<?php if ($security_matrix->SortUrl($security_matrix_preview->ActivityCode) == "") { ?>
		<th class="<?php echo $security_matrix_preview->ActivityCode->headerCellClass() ?>"><?php echo $security_matrix_preview->ActivityCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $security_matrix_preview->ActivityCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($security_matrix_preview->ActivityCode->Name) ?>" data-sort-order="<?php echo $security_matrix_preview->SortField == $security_matrix_preview->ActivityCode->Name && $security_matrix_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $security_matrix_preview->ActivityCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($security_matrix_preview->SortField == $security_matrix_preview->ActivityCode->Name) { ?><?php if ($security_matrix_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($security_matrix_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$security_matrix_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$security_matrix_preview->RecCount = 0;
$security_matrix_preview->RowCount = 0;
while ($security_matrix_preview->Recordset && !$security_matrix_preview->Recordset->EOF) {

	// Init row class and style
	$security_matrix_preview->RecCount++;
	$security_matrix_preview->RowCount++;
	$security_matrix_preview->CssStyle = "";
	$security_matrix_preview->loadListRowValues($security_matrix_preview->Recordset);

	// Render row
	$security_matrix->RowType = ROWTYPE_PREVIEW; // Preview record
	$security_matrix_preview->resetAttributes();
	$security_matrix_preview->renderListRow();

	// Render list options
	$security_matrix_preview->renderListOptions();
?>
	<tr <?php echo $security_matrix->rowAttributes() ?>>
<?php

// Render list options (body, left)
$security_matrix_preview->ListOptions->render("body", "left", $security_matrix_preview->RowCount);
?>
<?php if ($security_matrix_preview->UserCode->Visible) { // UserCode ?>
		<!-- UserCode -->
		<td<?php echo $security_matrix_preview->UserCode->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->UserCode->viewAttributes() ?>><?php echo $security_matrix_preview->UserCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->PeriodCode->Visible) { // PeriodCode ?>
		<!-- PeriodCode -->
		<td<?php echo $security_matrix_preview->PeriodCode->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->PeriodCode->viewAttributes() ?>><?php echo $security_matrix_preview->PeriodCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $security_matrix_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->ProvinceCode->viewAttributes() ?>><?php echo $security_matrix_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $security_matrix_preview->LACode->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->LACode->viewAttributes() ?>><?php echo $security_matrix_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $security_matrix_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->DepartmentCode->viewAttributes() ?>><?php echo $security_matrix_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $security_matrix_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->SectionCode->viewAttributes() ?>><?php echo $security_matrix_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->SecurityNumber->Visible) { // SecurityNumber ?>
		<!-- SecurityNumber -->
		<td<?php echo $security_matrix_preview->SecurityNumber->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->SecurityNumber->viewAttributes() ?>><?php echo $security_matrix_preview->SecurityNumber->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->ValidFrom->Visible) { // ValidFrom ?>
		<!-- ValidFrom -->
		<td<?php echo $security_matrix_preview->ValidFrom->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->ValidFrom->viewAttributes() ?>><?php echo $security_matrix_preview->ValidFrom->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->ValidTo->Visible) { // ValidTo ?>
		<!-- ValidTo -->
		<td<?php echo $security_matrix_preview->ValidTo->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->ValidTo->viewAttributes() ?>><?php echo $security_matrix_preview->ValidTo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->ApproveLevel->Visible) { // ApproveLevel ?>
		<!-- ApproveLevel -->
		<td<?php echo $security_matrix_preview->ApproveLevel->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->ApproveLevel->viewAttributes() ?>><?php echo $security_matrix_preview->ApproveLevel->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($security_matrix_preview->ActivityCode->Visible) { // ActivityCode ?>
		<!-- ActivityCode -->
		<td<?php echo $security_matrix_preview->ActivityCode->cellAttributes() ?>>
<span<?php echo $security_matrix_preview->ActivityCode->viewAttributes() ?>><?php echo $security_matrix_preview->ActivityCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$security_matrix_preview->ListOptions->render("body", "right", $security_matrix_preview->RowCount);
?>
	</tr>
<?php
	$security_matrix_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $security_matrix_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($security_matrix_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($security_matrix_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$security_matrix_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($security_matrix_preview->Recordset)
	$security_matrix_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$security_matrix_preview->terminate();
?>