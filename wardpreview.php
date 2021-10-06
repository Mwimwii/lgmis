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
$ward_preview = new ward_preview();

// Run the page
$ward_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ward_preview->Page_Render();
?>
<?php $ward_preview->showPageHeader(); ?>
<?php if ($ward_preview->TotalRecords > 0) { ?>
<div class="card ew-grid ward"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$ward_preview->renderListOptions();

// Render list options (header, left)
$ward_preview->ListOptions->render("header", "left");
?>
<?php if ($ward_preview->LACode->Visible) { // LACode ?>
	<?php if ($ward->SortUrl($ward_preview->LACode) == "") { ?>
		<th class="<?php echo $ward_preview->LACode->headerCellClass() ?>"><?php echo $ward_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ward_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ward_preview->LACode->Name) ?>" data-sort-order="<?php echo $ward_preview->SortField == $ward_preview->LACode->Name && $ward_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_preview->SortField == $ward_preview->LACode->Name) { ?><?php if ($ward_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($ward->SortUrl($ward_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $ward_preview->ProvinceCode->headerCellClass() ?>"><?php echo $ward_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ward_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ward_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $ward_preview->SortField == $ward_preview->ProvinceCode->Name && $ward_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_preview->SortField == $ward_preview->ProvinceCode->Name) { ?><?php if ($ward_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_preview->WardCode->Visible) { // WardCode ?>
	<?php if ($ward->SortUrl($ward_preview->WardCode) == "") { ?>
		<th class="<?php echo $ward_preview->WardCode->headerCellClass() ?>"><?php echo $ward_preview->WardCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ward_preview->WardCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ward_preview->WardCode->Name) ?>" data-sort-order="<?php echo $ward_preview->SortField == $ward_preview->WardCode->Name && $ward_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_preview->WardCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_preview->SortField == $ward_preview->WardCode->Name) { ?><?php if ($ward_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_preview->WardName->Visible) { // WardName ?>
	<?php if ($ward->SortUrl($ward_preview->WardName) == "") { ?>
		<th class="<?php echo $ward_preview->WardName->headerCellClass() ?>"><?php echo $ward_preview->WardName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ward_preview->WardName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ward_preview->WardName->Name) ?>" data-sort-order="<?php echo $ward_preview->SortField == $ward_preview->WardName->Name && $ward_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_preview->WardName->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_preview->SortField == $ward_preview->WardName->Name) { ?><?php if ($ward_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_preview->Population->Visible) { // Population ?>
	<?php if ($ward->SortUrl($ward_preview->Population) == "") { ?>
		<th class="<?php echo $ward_preview->Population->headerCellClass() ?>"><?php echo $ward_preview->Population->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ward_preview->Population->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ward_preview->Population->Name) ?>" data-sort-order="<?php echo $ward_preview->SortField == $ward_preview->Population->Name && $ward_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_preview->Population->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_preview->SortField == $ward_preview->Population->Name) { ?><?php if ($ward_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_preview->Areas->Visible) { // Areas ?>
	<?php if ($ward->SortUrl($ward_preview->Areas) == "") { ?>
		<th class="<?php echo $ward_preview->Areas->headerCellClass() ?>"><?php echo $ward_preview->Areas->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ward_preview->Areas->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ward_preview->Areas->Name) ?>" data-sort-order="<?php echo $ward_preview->SortField == $ward_preview->Areas->Name && $ward_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_preview->Areas->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_preview->SortField == $ward_preview->Areas->Name) { ?><?php if ($ward_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ward_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$ward_preview->RecCount = 0;
$ward_preview->RowCount = 0;
while ($ward_preview->Recordset && !$ward_preview->Recordset->EOF) {

	// Init row class and style
	$ward_preview->RecCount++;
	$ward_preview->RowCount++;
	$ward_preview->CssStyle = "";
	$ward_preview->loadListRowValues($ward_preview->Recordset);

	// Render row
	$ward->RowType = ROWTYPE_PREVIEW; // Preview record
	$ward_preview->resetAttributes();
	$ward_preview->renderListRow();

	// Render list options
	$ward_preview->renderListOptions();
?>
	<tr <?php echo $ward->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ward_preview->ListOptions->render("body", "left", $ward_preview->RowCount);
?>
<?php if ($ward_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $ward_preview->LACode->cellAttributes() ?>>
<span<?php echo $ward_preview->LACode->viewAttributes() ?>><?php echo $ward_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ward_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $ward_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $ward_preview->ProvinceCode->viewAttributes() ?>><?php echo $ward_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ward_preview->WardCode->Visible) { // WardCode ?>
		<!-- WardCode -->
		<td<?php echo $ward_preview->WardCode->cellAttributes() ?>>
<span<?php echo $ward_preview->WardCode->viewAttributes() ?>><?php echo $ward_preview->WardCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ward_preview->WardName->Visible) { // WardName ?>
		<!-- WardName -->
		<td<?php echo $ward_preview->WardName->cellAttributes() ?>>
<span<?php echo $ward_preview->WardName->viewAttributes() ?>><?php echo $ward_preview->WardName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ward_preview->Population->Visible) { // Population ?>
		<!-- Population -->
		<td<?php echo $ward_preview->Population->cellAttributes() ?>>
<span<?php echo $ward_preview->Population->viewAttributes() ?>><?php echo $ward_preview->Population->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ward_preview->Areas->Visible) { // Areas ?>
		<!-- Areas -->
		<td<?php echo $ward_preview->Areas->cellAttributes() ?>>
<span<?php echo $ward_preview->Areas->viewAttributes() ?>><?php echo $ward_preview->Areas->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$ward_preview->ListOptions->render("body", "right", $ward_preview->RowCount);
?>
	</tr>
<?php
	$ward_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $ward_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($ward_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($ward_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$ward_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($ward_preview->Recordset)
	$ward_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$ward_preview->terminate();
?>