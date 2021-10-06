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
WriteHeader(FALSE);

// Create page object
$payroll_import_list = new payroll_import_list();

// Run the page
$payroll_import_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_import_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_import_list->isExport()) { ?>
<script>
var fpayroll_importlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayroll_importlist = currentForm = new ew.Form("fpayroll_importlist", "list");
	fpayroll_importlist.formKeyCountName = '<?php echo $payroll_import_list->FormKeyCountName ?>';
	loadjs.done("fpayroll_importlist");
});
var fpayroll_importlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayroll_importlistsrch = currentSearchForm = new ew.Form("fpayroll_importlistsrch");

	// Dynamic selection lists
	// Filters

	fpayroll_importlistsrch.filterList = <?php echo $payroll_import_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayroll_importlistsrch.initSearchPanel = true;
	loadjs.done("fpayroll_importlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$payroll_import_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payroll_import_list->TotalRecords > 0 && $payroll_import_list->ExportOptions->visible()) { ?>
<?php $payroll_import_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_import_list->ImportOptions->visible()) { ?>
<?php $payroll_import_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_import_list->SearchOptions->visible()) { ?>
<?php $payroll_import_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_import_list->FilterOptions->visible()) { ?>
<?php $payroll_import_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payroll_import_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payroll_import_list->isExport() && !$payroll_import->CurrentAction) { ?>
<form name="fpayroll_importlistsrch" id="fpayroll_importlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayroll_importlistsrch-search-panel" class="<?php echo $payroll_import_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payroll_import">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payroll_import_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payroll_import_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payroll_import_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payroll_import_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payroll_import_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payroll_import_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payroll_import_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payroll_import_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payroll_import_list->showPageHeader(); ?>
<?php
$payroll_import_list->showMessage();
?>
<?php if ($payroll_import_list->TotalRecords > 0 || $payroll_import->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_import_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll_import">
<?php if (!$payroll_import_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payroll_import_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_import_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_import_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayroll_importlist" id="fpayroll_importlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_import">
<div id="gmp_payroll_import" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payroll_import_list->TotalRecords > 0 || $payroll_import_list->isGridEdit()) { ?>
<table id="tbl_payroll_importlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll_import->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_import_list->renderListOptions();

// Render list options (header, left)
$payroll_import_list->ListOptions->render("header", "left");
?>
<?php if ($payroll_import_list->FileNumber->Visible) { // FileNumber ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->FileNumber) == "") { ?>
		<th data-name="FileNumber" class="<?php echo $payroll_import_list->FileNumber->headerCellClass() ?>"><div id="elh_payroll_import_FileNumber" class="payroll_import_FileNumber"><div class="ew-table-header-caption"><?php echo $payroll_import_list->FileNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FileNumber" class="<?php echo $payroll_import_list->FileNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->FileNumber) ?>', 1);"><div id="elh_payroll_import_FileNumber" class="payroll_import_FileNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->FileNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->FileNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->FileNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->Surname->Visible) { // Surname ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $payroll_import_list->Surname->headerCellClass() ?>"><div id="elh_payroll_import_Surname" class="payroll_import_Surname"><div class="ew-table-header-caption"><?php echo $payroll_import_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $payroll_import_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->Surname) ?>', 1);"><div id="elh_payroll_import_Surname" class="payroll_import_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->FirstName->Visible) { // FirstName ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $payroll_import_list->FirstName->headerCellClass() ?>"><div id="elh_payroll_import_FirstName" class="payroll_import_FirstName"><div class="ew-table-header-caption"><?php echo $payroll_import_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $payroll_import_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->FirstName) ?>', 1);"><div id="elh_payroll_import_FirstName" class="payroll_import_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->DOB->Visible) { // DOB ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->DOB) == "") { ?>
		<th data-name="DOB" class="<?php echo $payroll_import_list->DOB->headerCellClass() ?>"><div id="elh_payroll_import_DOB" class="payroll_import_DOB"><div class="ew-table-header-caption"><?php echo $payroll_import_list->DOB->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DOB" class="<?php echo $payroll_import_list->DOB->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->DOB) ?>', 1);"><div id="elh_payroll_import_DOB" class="payroll_import_DOB">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->DOB->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->DOB->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->DOB->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->DateEmployed->Visible) { // DateEmployed ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->DateEmployed) == "") { ?>
		<th data-name="DateEmployed" class="<?php echo $payroll_import_list->DateEmployed->headerCellClass() ?>"><div id="elh_payroll_import_DateEmployed" class="payroll_import_DateEmployed"><div class="ew-table-header-caption"><?php echo $payroll_import_list->DateEmployed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateEmployed" class="<?php echo $payroll_import_list->DateEmployed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->DateEmployed) ?>', 1);"><div id="elh_payroll_import_DateEmployed" class="payroll_import_DateEmployed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->DateEmployed->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->DateEmployed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->DateEmployed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->nrc->Visible) { // nrc ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->nrc) == "") { ?>
		<th data-name="nrc" class="<?php echo $payroll_import_list->nrc->headerCellClass() ?>"><div id="elh_payroll_import_nrc" class="payroll_import_nrc"><div class="ew-table-header-caption"><?php echo $payroll_import_list->nrc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nrc" class="<?php echo $payroll_import_list->nrc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->nrc) ?>', 1);"><div id="elh_payroll_import_nrc" class="payroll_import_nrc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->nrc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->nrc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->nrc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->napsa->Visible) { // napsa ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->napsa) == "") { ?>
		<th data-name="napsa" class="<?php echo $payroll_import_list->napsa->headerCellClass() ?>"><div id="elh_payroll_import_napsa" class="payroll_import_napsa"><div class="ew-table-header-caption"><?php echo $payroll_import_list->napsa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="napsa" class="<?php echo $payroll_import_list->napsa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->napsa) ?>', 1);"><div id="elh_payroll_import_napsa" class="payroll_import_napsa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->napsa->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->napsa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->napsa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->LeaveDays->Visible) { // LeaveDays ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->LeaveDays) == "") { ?>
		<th data-name="LeaveDays" class="<?php echo $payroll_import_list->LeaveDays->headerCellClass() ?>"><div id="elh_payroll_import_LeaveDays" class="payroll_import_LeaveDays"><div class="ew-table-header-caption"><?php echo $payroll_import_list->LeaveDays->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveDays" class="<?php echo $payroll_import_list->LeaveDays->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->LeaveDays) ?>', 1);"><div id="elh_payroll_import_LeaveDays" class="payroll_import_LeaveDays">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->LeaveDays->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->LeaveDays->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->LeaveDays->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_import_list->sex->Visible) { // sex ?>
	<?php if ($payroll_import_list->SortUrl($payroll_import_list->sex) == "") { ?>
		<th data-name="sex" class="<?php echo $payroll_import_list->sex->headerCellClass() ?>"><div id="elh_payroll_import_sex" class="payroll_import_sex"><div class="ew-table-header-caption"><?php echo $payroll_import_list->sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sex" class="<?php echo $payroll_import_list->sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_import_list->SortUrl($payroll_import_list->sex) ?>', 1);"><div id="elh_payroll_import_sex" class="payroll_import_sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_import_list->sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_import_list->sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_import_list->sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_import_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payroll_import_list->ExportAll && $payroll_import_list->isExport()) {
	$payroll_import_list->StopRecord = $payroll_import_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payroll_import_list->TotalRecords > $payroll_import_list->StartRecord + $payroll_import_list->DisplayRecords - 1)
		$payroll_import_list->StopRecord = $payroll_import_list->StartRecord + $payroll_import_list->DisplayRecords - 1;
	else
		$payroll_import_list->StopRecord = $payroll_import_list->TotalRecords;
}
$payroll_import_list->RecordCount = $payroll_import_list->StartRecord - 1;
if ($payroll_import_list->Recordset && !$payroll_import_list->Recordset->EOF) {
	$payroll_import_list->Recordset->moveFirst();
	$selectLimit = $payroll_import_list->UseSelectLimit;
	if (!$selectLimit && $payroll_import_list->StartRecord > 1)
		$payroll_import_list->Recordset->move($payroll_import_list->StartRecord - 1);
} elseif (!$payroll_import->AllowAddDeleteRow && $payroll_import_list->StopRecord == 0) {
	$payroll_import_list->StopRecord = $payroll_import->GridAddRowCount;
}

// Initialize aggregate
$payroll_import->RowType = ROWTYPE_AGGREGATEINIT;
$payroll_import->resetAttributes();
$payroll_import_list->renderRow();
while ($payroll_import_list->RecordCount < $payroll_import_list->StopRecord) {
	$payroll_import_list->RecordCount++;
	if ($payroll_import_list->RecordCount >= $payroll_import_list->StartRecord) {
		$payroll_import_list->RowCount++;

		// Set up key count
		$payroll_import_list->KeyCount = $payroll_import_list->RowIndex;

		// Init row class and style
		$payroll_import->resetAttributes();
		$payroll_import->CssClass = "";
		if ($payroll_import_list->isGridAdd()) {
		} else {
			$payroll_import_list->loadRowValues($payroll_import_list->Recordset); // Load row values
		}
		$payroll_import->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payroll_import->RowAttrs->merge(["data-rowindex" => $payroll_import_list->RowCount, "id" => "r" . $payroll_import_list->RowCount . "_payroll_import", "data-rowtype" => $payroll_import->RowType]);

		// Render row
		$payroll_import_list->renderRow();

		// Render list options
		$payroll_import_list->renderListOptions();
?>
	<tr <?php echo $payroll_import->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_import_list->ListOptions->render("body", "left", $payroll_import_list->RowCount);
?>
	<?php if ($payroll_import_list->FileNumber->Visible) { // FileNumber ?>
		<td data-name="FileNumber" <?php echo $payroll_import_list->FileNumber->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_FileNumber">
<span<?php echo $payroll_import_list->FileNumber->viewAttributes() ?>><?php echo $payroll_import_list->FileNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $payroll_import_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_Surname">
<span<?php echo $payroll_import_list->Surname->viewAttributes() ?>><?php echo $payroll_import_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $payroll_import_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_FirstName">
<span<?php echo $payroll_import_list->FirstName->viewAttributes() ?>><?php echo $payroll_import_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->DOB->Visible) { // DOB ?>
		<td data-name="DOB" <?php echo $payroll_import_list->DOB->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_DOB">
<span<?php echo $payroll_import_list->DOB->viewAttributes() ?>><?php echo $payroll_import_list->DOB->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->DateEmployed->Visible) { // DateEmployed ?>
		<td data-name="DateEmployed" <?php echo $payroll_import_list->DateEmployed->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_DateEmployed">
<span<?php echo $payroll_import_list->DateEmployed->viewAttributes() ?>><?php echo $payroll_import_list->DateEmployed->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->nrc->Visible) { // nrc ?>
		<td data-name="nrc" <?php echo $payroll_import_list->nrc->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_nrc">
<span<?php echo $payroll_import_list->nrc->viewAttributes() ?>><?php echo $payroll_import_list->nrc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->napsa->Visible) { // napsa ?>
		<td data-name="napsa" <?php echo $payroll_import_list->napsa->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_napsa">
<span<?php echo $payroll_import_list->napsa->viewAttributes() ?>><?php echo $payroll_import_list->napsa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->LeaveDays->Visible) { // LeaveDays ?>
		<td data-name="LeaveDays" <?php echo $payroll_import_list->LeaveDays->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_LeaveDays">
<span<?php echo $payroll_import_list->LeaveDays->viewAttributes() ?>><?php echo $payroll_import_list->LeaveDays->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_import_list->sex->Visible) { // sex ?>
		<td data-name="sex" <?php echo $payroll_import_list->sex->cellAttributes() ?>>
<span id="el<?php echo $payroll_import_list->RowCount ?>_payroll_import_sex">
<span<?php echo $payroll_import_list->sex->viewAttributes() ?>><?php echo $payroll_import_list->sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_import_list->ListOptions->render("body", "right", $payroll_import_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payroll_import_list->isGridAdd())
		$payroll_import_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payroll_import->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_import_list->Recordset)
	$payroll_import_list->Recordset->Close();
?>
<?php if (!$payroll_import_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payroll_import_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_import_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_import_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_import_list->TotalRecords == 0 && !$payroll_import->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_import_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payroll_import_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_import_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$payroll_import_list->terminate();
?>