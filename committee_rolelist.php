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
$committee_role_list = new committee_role_list();

// Run the page
$committee_role_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_role_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$committee_role_list->isExport()) { ?>
<script>
var fcommittee_rolelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcommittee_rolelist = currentForm = new ew.Form("fcommittee_rolelist", "list");
	fcommittee_rolelist.formKeyCountName = '<?php echo $committee_role_list->FormKeyCountName ?>';
	loadjs.done("fcommittee_rolelist");
});
var fcommittee_rolelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcommittee_rolelistsrch = currentSearchForm = new ew.Form("fcommittee_rolelistsrch");

	// Dynamic selection lists
	// Filters

	fcommittee_rolelistsrch.filterList = <?php echo $committee_role_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcommittee_rolelistsrch.initSearchPanel = true;
	loadjs.done("fcommittee_rolelistsrch");
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
<?php if (!$committee_role_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($committee_role_list->TotalRecords > 0 && $committee_role_list->ExportOptions->visible()) { ?>
<?php $committee_role_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($committee_role_list->ImportOptions->visible()) { ?>
<?php $committee_role_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($committee_role_list->SearchOptions->visible()) { ?>
<?php $committee_role_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($committee_role_list->FilterOptions->visible()) { ?>
<?php $committee_role_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$committee_role_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$committee_role_list->isExport() && !$committee_role->CurrentAction) { ?>
<form name="fcommittee_rolelistsrch" id="fcommittee_rolelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcommittee_rolelistsrch-search-panel" class="<?php echo $committee_role_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="committee_role">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $committee_role_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($committee_role_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($committee_role_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $committee_role_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($committee_role_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($committee_role_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($committee_role_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($committee_role_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $committee_role_list->showPageHeader(); ?>
<?php
$committee_role_list->showMessage();
?>
<?php if ($committee_role_list->TotalRecords > 0 || $committee_role->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($committee_role_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> committee_role">
<?php if (!$committee_role_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$committee_role_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_role_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $committee_role_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcommittee_rolelist" id="fcommittee_rolelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_role">
<div id="gmp_committee_role" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($committee_role_list->TotalRecords > 0 || $committee_role_list->isGridEdit()) { ?>
<table id="tbl_committee_rolelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$committee_role->RowType = ROWTYPE_HEADER;

// Render list options
$committee_role_list->renderListOptions();

// Render list options (header, left)
$committee_role_list->ListOptions->render("header", "left");
?>
<?php if ($committee_role_list->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($committee_role_list->SortUrl($committee_role_list->CommitteeRole) == "") { ?>
		<th data-name="CommitteeRole" class="<?php echo $committee_role_list->CommitteeRole->headerCellClass() ?>"><div id="elh_committee_role_CommitteeRole" class="committee_role_CommitteeRole"><div class="ew-table-header-caption"><?php echo $committee_role_list->CommitteeRole->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeRole" class="<?php echo $committee_role_list->CommitteeRole->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $committee_role_list->SortUrl($committee_role_list->CommitteeRole) ?>', 1);"><div id="elh_committee_role_CommitteeRole" class="committee_role_CommitteeRole">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_role_list->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_role_list->CommitteeRole->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_role_list->CommitteeRole->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($committee_role_list->CommitteeRoleDesc->Visible) { // CommitteeRoleDesc ?>
	<?php if ($committee_role_list->SortUrl($committee_role_list->CommitteeRoleDesc) == "") { ?>
		<th data-name="CommitteeRoleDesc" class="<?php echo $committee_role_list->CommitteeRoleDesc->headerCellClass() ?>"><div id="elh_committee_role_CommitteeRoleDesc" class="committee_role_CommitteeRoleDesc"><div class="ew-table-header-caption"><?php echo $committee_role_list->CommitteeRoleDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeRoleDesc" class="<?php echo $committee_role_list->CommitteeRoleDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $committee_role_list->SortUrl($committee_role_list->CommitteeRoleDesc) ?>', 1);"><div id="elh_committee_role_CommitteeRoleDesc" class="committee_role_CommitteeRoleDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_role_list->CommitteeRoleDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($committee_role_list->CommitteeRoleDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_role_list->CommitteeRoleDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$committee_role_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($committee_role_list->ExportAll && $committee_role_list->isExport()) {
	$committee_role_list->StopRecord = $committee_role_list->TotalRecords;
} else {

	// Set the last record to display
	if ($committee_role_list->TotalRecords > $committee_role_list->StartRecord + $committee_role_list->DisplayRecords - 1)
		$committee_role_list->StopRecord = $committee_role_list->StartRecord + $committee_role_list->DisplayRecords - 1;
	else
		$committee_role_list->StopRecord = $committee_role_list->TotalRecords;
}
$committee_role_list->RecordCount = $committee_role_list->StartRecord - 1;
if ($committee_role_list->Recordset && !$committee_role_list->Recordset->EOF) {
	$committee_role_list->Recordset->moveFirst();
	$selectLimit = $committee_role_list->UseSelectLimit;
	if (!$selectLimit && $committee_role_list->StartRecord > 1)
		$committee_role_list->Recordset->move($committee_role_list->StartRecord - 1);
} elseif (!$committee_role->AllowAddDeleteRow && $committee_role_list->StopRecord == 0) {
	$committee_role_list->StopRecord = $committee_role->GridAddRowCount;
}

// Initialize aggregate
$committee_role->RowType = ROWTYPE_AGGREGATEINIT;
$committee_role->resetAttributes();
$committee_role_list->renderRow();
while ($committee_role_list->RecordCount < $committee_role_list->StopRecord) {
	$committee_role_list->RecordCount++;
	if ($committee_role_list->RecordCount >= $committee_role_list->StartRecord) {
		$committee_role_list->RowCount++;

		// Set up key count
		$committee_role_list->KeyCount = $committee_role_list->RowIndex;

		// Init row class and style
		$committee_role->resetAttributes();
		$committee_role->CssClass = "";
		if ($committee_role_list->isGridAdd()) {
		} else {
			$committee_role_list->loadRowValues($committee_role_list->Recordset); // Load row values
		}
		$committee_role->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$committee_role->RowAttrs->merge(["data-rowindex" => $committee_role_list->RowCount, "id" => "r" . $committee_role_list->RowCount . "_committee_role", "data-rowtype" => $committee_role->RowType]);

		// Render row
		$committee_role_list->renderRow();

		// Render list options
		$committee_role_list->renderListOptions();
?>
	<tr <?php echo $committee_role->rowAttributes() ?>>
<?php

// Render list options (body, left)
$committee_role_list->ListOptions->render("body", "left", $committee_role_list->RowCount);
?>
	<?php if ($committee_role_list->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole" <?php echo $committee_role_list->CommitteeRole->cellAttributes() ?>>
<span id="el<?php echo $committee_role_list->RowCount ?>_committee_role_CommitteeRole">
<span<?php echo $committee_role_list->CommitteeRole->viewAttributes() ?>><?php echo $committee_role_list->CommitteeRole->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($committee_role_list->CommitteeRoleDesc->Visible) { // CommitteeRoleDesc ?>
		<td data-name="CommitteeRoleDesc" <?php echo $committee_role_list->CommitteeRoleDesc->cellAttributes() ?>>
<span id="el<?php echo $committee_role_list->RowCount ?>_committee_role_CommitteeRoleDesc">
<span<?php echo $committee_role_list->CommitteeRoleDesc->viewAttributes() ?>><?php echo $committee_role_list->CommitteeRoleDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$committee_role_list->ListOptions->render("body", "right", $committee_role_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$committee_role_list->isGridAdd())
		$committee_role_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$committee_role->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($committee_role_list->Recordset)
	$committee_role_list->Recordset->Close();
?>
<?php if (!$committee_role_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$committee_role_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_role_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $committee_role_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($committee_role_list->TotalRecords == 0 && !$committee_role->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $committee_role_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$committee_role_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$committee_role_list->isExport()) { ?>
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
$committee_role_list->terminate();
?>