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
$assistant_accountants_list = new assistant_accountants_list();

// Run the page
$assistant_accountants_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$assistant_accountants_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$assistant_accountants_list->isExport()) { ?>
<script>
var fassistant_accountantslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fassistant_accountantslist = currentForm = new ew.Form("fassistant_accountantslist", "list");
	fassistant_accountantslist.formKeyCountName = '<?php echo $assistant_accountants_list->FormKeyCountName ?>';
	loadjs.done("fassistant_accountantslist");
});
var fassistant_accountantslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fassistant_accountantslistsrch = currentSearchForm = new ew.Form("fassistant_accountantslistsrch");

	// Dynamic selection lists
	// Filters

	fassistant_accountantslistsrch.filterList = <?php echo $assistant_accountants_list->getFilterList() ?>;

	// Init search panel as collapsed
	fassistant_accountantslistsrch.initSearchPanel = true;
	loadjs.done("fassistant_accountantslistsrch");
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
<?php if (!$assistant_accountants_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($assistant_accountants_list->TotalRecords > 0 && $assistant_accountants_list->ExportOptions->visible()) { ?>
<?php $assistant_accountants_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($assistant_accountants_list->ImportOptions->visible()) { ?>
<?php $assistant_accountants_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($assistant_accountants_list->SearchOptions->visible()) { ?>
<?php $assistant_accountants_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($assistant_accountants_list->FilterOptions->visible()) { ?>
<?php $assistant_accountants_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$assistant_accountants_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$assistant_accountants_list->isExport() && !$assistant_accountants->CurrentAction) { ?>
<form name="fassistant_accountantslistsrch" id="fassistant_accountantslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fassistant_accountantslistsrch-search-panel" class="<?php echo $assistant_accountants_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="assistant_accountants">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $assistant_accountants_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($assistant_accountants_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($assistant_accountants_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $assistant_accountants_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($assistant_accountants_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($assistant_accountants_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($assistant_accountants_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($assistant_accountants_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $assistant_accountants_list->showPageHeader(); ?>
<?php
$assistant_accountants_list->showMessage();
?>
<?php if ($assistant_accountants_list->TotalRecords > 0 || $assistant_accountants->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($assistant_accountants_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> assistant_accountants">
<?php if (!$assistant_accountants_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$assistant_accountants_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $assistant_accountants_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $assistant_accountants_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fassistant_accountantslist" id="fassistant_accountantslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="assistant_accountants">
<div id="gmp_assistant_accountants" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($assistant_accountants_list->TotalRecords > 0 || $assistant_accountants_list->isGridEdit()) { ?>
<table id="tbl_assistant_accountantslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$assistant_accountants->RowType = ROWTYPE_HEADER;

// Render list options
$assistant_accountants_list->renderListOptions();

// Render list options (header, left)
$assistant_accountants_list->ListOptions->render("header", "left");
?>
<?php if ($assistant_accountants_list->LOCAL_AUTHORITY->Visible) { // LOCAL AUTHORITY ?>
	<?php if ($assistant_accountants_list->SortUrl($assistant_accountants_list->LOCAL_AUTHORITY) == "") { ?>
		<th data-name="LOCAL_AUTHORITY" class="<?php echo $assistant_accountants_list->LOCAL_AUTHORITY->headerCellClass() ?>"><div id="elh_assistant_accountants_LOCAL_AUTHORITY" class="assistant_accountants_LOCAL_AUTHORITY"><div class="ew-table-header-caption"><?php echo $assistant_accountants_list->LOCAL_AUTHORITY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LOCAL_AUTHORITY" class="<?php echo $assistant_accountants_list->LOCAL_AUTHORITY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_accountants_list->SortUrl($assistant_accountants_list->LOCAL_AUTHORITY) ?>', 1);"><div id="elh_assistant_accountants_LOCAL_AUTHORITY" class="assistant_accountants_LOCAL_AUTHORITY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_accountants_list->LOCAL_AUTHORITY->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_accountants_list->LOCAL_AUTHORITY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_accountants_list->LOCAL_AUTHORITY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_accountants_list->FULL_NAME->Visible) { // FULL NAME ?>
	<?php if ($assistant_accountants_list->SortUrl($assistant_accountants_list->FULL_NAME) == "") { ?>
		<th data-name="FULL_NAME" class="<?php echo $assistant_accountants_list->FULL_NAME->headerCellClass() ?>"><div id="elh_assistant_accountants_FULL_NAME" class="assistant_accountants_FULL_NAME"><div class="ew-table-header-caption"><?php echo $assistant_accountants_list->FULL_NAME->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FULL_NAME" class="<?php echo $assistant_accountants_list->FULL_NAME->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_accountants_list->SortUrl($assistant_accountants_list->FULL_NAME) ?>', 1);"><div id="elh_assistant_accountants_FULL_NAME" class="assistant_accountants_FULL_NAME">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_accountants_list->FULL_NAME->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_accountants_list->FULL_NAME->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_accountants_list->FULL_NAME->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_accountants_list->SEX->Visible) { // SEX ?>
	<?php if ($assistant_accountants_list->SortUrl($assistant_accountants_list->SEX) == "") { ?>
		<th data-name="SEX" class="<?php echo $assistant_accountants_list->SEX->headerCellClass() ?>"><div id="elh_assistant_accountants_SEX" class="assistant_accountants_SEX"><div class="ew-table-header-caption"><?php echo $assistant_accountants_list->SEX->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SEX" class="<?php echo $assistant_accountants_list->SEX->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_accountants_list->SortUrl($assistant_accountants_list->SEX) ?>', 1);"><div id="elh_assistant_accountants_SEX" class="assistant_accountants_SEX">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_accountants_list->SEX->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_accountants_list->SEX->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_accountants_list->SEX->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_accountants_list->DATE_OF_BIRTH->Visible) { // DATE OF BIRTH ?>
	<?php if ($assistant_accountants_list->SortUrl($assistant_accountants_list->DATE_OF_BIRTH) == "") { ?>
		<th data-name="DATE_OF_BIRTH" class="<?php echo $assistant_accountants_list->DATE_OF_BIRTH->headerCellClass() ?>"><div id="elh_assistant_accountants_DATE_OF_BIRTH" class="assistant_accountants_DATE_OF_BIRTH"><div class="ew-table-header-caption"><?php echo $assistant_accountants_list->DATE_OF_BIRTH->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DATE_OF_BIRTH" class="<?php echo $assistant_accountants_list->DATE_OF_BIRTH->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_accountants_list->SortUrl($assistant_accountants_list->DATE_OF_BIRTH) ?>', 1);"><div id="elh_assistant_accountants_DATE_OF_BIRTH" class="assistant_accountants_DATE_OF_BIRTH">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_accountants_list->DATE_OF_BIRTH->caption() ?></span><span class="ew-table-header-sort"><?php if ($assistant_accountants_list->DATE_OF_BIRTH->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_accountants_list->DATE_OF_BIRTH->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_accountants_list->POSITION_NAME->Visible) { // POSITION NAME ?>
	<?php if ($assistant_accountants_list->SortUrl($assistant_accountants_list->POSITION_NAME) == "") { ?>
		<th data-name="POSITION_NAME" class="<?php echo $assistant_accountants_list->POSITION_NAME->headerCellClass() ?>"><div id="elh_assistant_accountants_POSITION_NAME" class="assistant_accountants_POSITION_NAME"><div class="ew-table-header-caption"><?php echo $assistant_accountants_list->POSITION_NAME->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="POSITION_NAME" class="<?php echo $assistant_accountants_list->POSITION_NAME->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_accountants_list->SortUrl($assistant_accountants_list->POSITION_NAME) ?>', 1);"><div id="elh_assistant_accountants_POSITION_NAME" class="assistant_accountants_POSITION_NAME">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_accountants_list->POSITION_NAME->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_accountants_list->POSITION_NAME->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_accountants_list->POSITION_NAME->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->Visible) { // DATE OF FIRST APPOINTMENT ?>
	<?php if ($assistant_accountants_list->SortUrl($assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT) == "") { ?>
		<th data-name="DATE_OF_FIRST_APPOINTMENT" class="<?php echo $assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->headerCellClass() ?>"><div id="elh_assistant_accountants_DATE_OF_FIRST_APPOINTMENT" class="assistant_accountants_DATE_OF_FIRST_APPOINTMENT"><div class="ew-table-header-caption"><?php echo $assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DATE_OF_FIRST_APPOINTMENT" class="<?php echo $assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_accountants_list->SortUrl($assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT) ?>', 1);"><div id="elh_assistant_accountants_DATE_OF_FIRST_APPOINTMENT" class="assistant_accountants_DATE_OF_FIRST_APPOINTMENT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->caption() ?></span><span class="ew-table-header-sort"><?php if ($assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_accountants_list->LENGTH_OF_STAY->Visible) { // LENGTH OF STAY ?>
	<?php if ($assistant_accountants_list->SortUrl($assistant_accountants_list->LENGTH_OF_STAY) == "") { ?>
		<th data-name="LENGTH_OF_STAY" class="<?php echo $assistant_accountants_list->LENGTH_OF_STAY->headerCellClass() ?>"><div id="elh_assistant_accountants_LENGTH_OF_STAY" class="assistant_accountants_LENGTH_OF_STAY"><div class="ew-table-header-caption"><?php echo $assistant_accountants_list->LENGTH_OF_STAY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LENGTH_OF_STAY" class="<?php echo $assistant_accountants_list->LENGTH_OF_STAY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_accountants_list->SortUrl($assistant_accountants_list->LENGTH_OF_STAY) ?>', 1);"><div id="elh_assistant_accountants_LENGTH_OF_STAY" class="assistant_accountants_LENGTH_OF_STAY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_accountants_list->LENGTH_OF_STAY->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_accountants_list->LENGTH_OF_STAY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_accountants_list->LENGTH_OF_STAY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$assistant_accountants_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($assistant_accountants_list->ExportAll && $assistant_accountants_list->isExport()) {
	$assistant_accountants_list->StopRecord = $assistant_accountants_list->TotalRecords;
} else {

	// Set the last record to display
	if ($assistant_accountants_list->TotalRecords > $assistant_accountants_list->StartRecord + $assistant_accountants_list->DisplayRecords - 1)
		$assistant_accountants_list->StopRecord = $assistant_accountants_list->StartRecord + $assistant_accountants_list->DisplayRecords - 1;
	else
		$assistant_accountants_list->StopRecord = $assistant_accountants_list->TotalRecords;
}
$assistant_accountants_list->RecordCount = $assistant_accountants_list->StartRecord - 1;
if ($assistant_accountants_list->Recordset && !$assistant_accountants_list->Recordset->EOF) {
	$assistant_accountants_list->Recordset->moveFirst();
	$selectLimit = $assistant_accountants_list->UseSelectLimit;
	if (!$selectLimit && $assistant_accountants_list->StartRecord > 1)
		$assistant_accountants_list->Recordset->move($assistant_accountants_list->StartRecord - 1);
} elseif (!$assistant_accountants->AllowAddDeleteRow && $assistant_accountants_list->StopRecord == 0) {
	$assistant_accountants_list->StopRecord = $assistant_accountants->GridAddRowCount;
}

// Initialize aggregate
$assistant_accountants->RowType = ROWTYPE_AGGREGATEINIT;
$assistant_accountants->resetAttributes();
$assistant_accountants_list->renderRow();
while ($assistant_accountants_list->RecordCount < $assistant_accountants_list->StopRecord) {
	$assistant_accountants_list->RecordCount++;
	if ($assistant_accountants_list->RecordCount >= $assistant_accountants_list->StartRecord) {
		$assistant_accountants_list->RowCount++;

		// Set up key count
		$assistant_accountants_list->KeyCount = $assistant_accountants_list->RowIndex;

		// Init row class and style
		$assistant_accountants->resetAttributes();
		$assistant_accountants->CssClass = "";
		if ($assistant_accountants_list->isGridAdd()) {
		} else {
			$assistant_accountants_list->loadRowValues($assistant_accountants_list->Recordset); // Load row values
		}
		$assistant_accountants->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$assistant_accountants->RowAttrs->merge(["data-rowindex" => $assistant_accountants_list->RowCount, "id" => "r" . $assistant_accountants_list->RowCount . "_assistant_accountants", "data-rowtype" => $assistant_accountants->RowType]);

		// Render row
		$assistant_accountants_list->renderRow();

		// Render list options
		$assistant_accountants_list->renderListOptions();
?>
	<tr <?php echo $assistant_accountants->rowAttributes() ?>>
<?php

// Render list options (body, left)
$assistant_accountants_list->ListOptions->render("body", "left", $assistant_accountants_list->RowCount);
?>
	<?php if ($assistant_accountants_list->LOCAL_AUTHORITY->Visible) { // LOCAL AUTHORITY ?>
		<td data-name="LOCAL_AUTHORITY" <?php echo $assistant_accountants_list->LOCAL_AUTHORITY->cellAttributes() ?>>
<span id="el<?php echo $assistant_accountants_list->RowCount ?>_assistant_accountants_LOCAL_AUTHORITY">
<span<?php echo $assistant_accountants_list->LOCAL_AUTHORITY->viewAttributes() ?>><?php echo $assistant_accountants_list->LOCAL_AUTHORITY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_accountants_list->FULL_NAME->Visible) { // FULL NAME ?>
		<td data-name="FULL_NAME" <?php echo $assistant_accountants_list->FULL_NAME->cellAttributes() ?>>
<span id="el<?php echo $assistant_accountants_list->RowCount ?>_assistant_accountants_FULL_NAME">
<span<?php echo $assistant_accountants_list->FULL_NAME->viewAttributes() ?>><?php echo $assistant_accountants_list->FULL_NAME->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_accountants_list->SEX->Visible) { // SEX ?>
		<td data-name="SEX" <?php echo $assistant_accountants_list->SEX->cellAttributes() ?>>
<span id="el<?php echo $assistant_accountants_list->RowCount ?>_assistant_accountants_SEX">
<span<?php echo $assistant_accountants_list->SEX->viewAttributes() ?>><?php echo $assistant_accountants_list->SEX->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_accountants_list->DATE_OF_BIRTH->Visible) { // DATE OF BIRTH ?>
		<td data-name="DATE_OF_BIRTH" <?php echo $assistant_accountants_list->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?php echo $assistant_accountants_list->RowCount ?>_assistant_accountants_DATE_OF_BIRTH">
<span<?php echo $assistant_accountants_list->DATE_OF_BIRTH->viewAttributes() ?>><?php echo $assistant_accountants_list->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_accountants_list->POSITION_NAME->Visible) { // POSITION NAME ?>
		<td data-name="POSITION_NAME" <?php echo $assistant_accountants_list->POSITION_NAME->cellAttributes() ?>>
<span id="el<?php echo $assistant_accountants_list->RowCount ?>_assistant_accountants_POSITION_NAME">
<span<?php echo $assistant_accountants_list->POSITION_NAME->viewAttributes() ?>><?php echo $assistant_accountants_list->POSITION_NAME->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->Visible) { // DATE OF FIRST APPOINTMENT ?>
		<td data-name="DATE_OF_FIRST_APPOINTMENT" <?php echo $assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->cellAttributes() ?>>
<span id="el<?php echo $assistant_accountants_list->RowCount ?>_assistant_accountants_DATE_OF_FIRST_APPOINTMENT">
<span<?php echo $assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->viewAttributes() ?>><?php echo $assistant_accountants_list->DATE_OF_FIRST_APPOINTMENT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_accountants_list->LENGTH_OF_STAY->Visible) { // LENGTH OF STAY ?>
		<td data-name="LENGTH_OF_STAY" <?php echo $assistant_accountants_list->LENGTH_OF_STAY->cellAttributes() ?>>
<span id="el<?php echo $assistant_accountants_list->RowCount ?>_assistant_accountants_LENGTH_OF_STAY">
<span<?php echo $assistant_accountants_list->LENGTH_OF_STAY->viewAttributes() ?>><?php echo $assistant_accountants_list->LENGTH_OF_STAY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$assistant_accountants_list->ListOptions->render("body", "right", $assistant_accountants_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$assistant_accountants_list->isGridAdd())
		$assistant_accountants_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$assistant_accountants->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($assistant_accountants_list->Recordset)
	$assistant_accountants_list->Recordset->Close();
?>
<?php if (!$assistant_accountants_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$assistant_accountants_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $assistant_accountants_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $assistant_accountants_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($assistant_accountants_list->TotalRecords == 0 && !$assistant_accountants->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $assistant_accountants_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$assistant_accountants_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$assistant_accountants_list->isExport()) { ?>
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
$assistant_accountants_list->terminate();
?>