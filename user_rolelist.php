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
$user_role_list = new user_role_list();

// Run the page
$user_role_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_role_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$user_role_list->isExport()) { ?>
<script>
var fuser_rolelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fuser_rolelist = currentForm = new ew.Form("fuser_rolelist", "list");
	fuser_rolelist.formKeyCountName = '<?php echo $user_role_list->FormKeyCountName ?>';
	loadjs.done("fuser_rolelist");
});
var fuser_rolelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fuser_rolelistsrch = currentSearchForm = new ew.Form("fuser_rolelistsrch");

	// Dynamic selection lists
	// Filters

	fuser_rolelistsrch.filterList = <?php echo $user_role_list->getFilterList() ?>;

	// Init search panel as collapsed
	fuser_rolelistsrch.initSearchPanel = true;
	loadjs.done("fuser_rolelistsrch");
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
<?php if (!$user_role_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($user_role_list->TotalRecords > 0 && $user_role_list->ExportOptions->visible()) { ?>
<?php $user_role_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($user_role_list->ImportOptions->visible()) { ?>
<?php $user_role_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($user_role_list->SearchOptions->visible()) { ?>
<?php $user_role_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($user_role_list->FilterOptions->visible()) { ?>
<?php $user_role_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$user_role_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$user_role_list->isExport() && !$user_role->CurrentAction) { ?>
<form name="fuser_rolelistsrch" id="fuser_rolelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fuser_rolelistsrch-search-panel" class="<?php echo $user_role_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="user_role">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $user_role_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($user_role_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($user_role_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $user_role_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($user_role_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($user_role_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($user_role_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($user_role_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $user_role_list->showPageHeader(); ?>
<?php
$user_role_list->showMessage();
?>
<?php if ($user_role_list->TotalRecords > 0 || $user_role->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($user_role_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> user_role">
<?php if (!$user_role_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$user_role_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $user_role_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $user_role_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuser_rolelist" id="fuser_rolelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_role">
<div id="gmp_user_role" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($user_role_list->TotalRecords > 0 || $user_role_list->isGridEdit()) { ?>
<table id="tbl_user_rolelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$user_role->RowType = ROWTYPE_HEADER;

// Render list options
$user_role_list->renderListOptions();

// Render list options (header, left)
$user_role_list->ListOptions->render("header", "left");
?>
<?php if ($user_role_list->Role->Visible) { // Role ?>
	<?php if ($user_role_list->SortUrl($user_role_list->Role) == "") { ?>
		<th data-name="Role" class="<?php echo $user_role_list->Role->headerCellClass() ?>"><div id="elh_user_role_Role" class="user_role_Role"><div class="ew-table-header-caption"><?php echo $user_role_list->Role->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Role" class="<?php echo $user_role_list->Role->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_role_list->SortUrl($user_role_list->Role) ?>', 1);"><div id="elh_user_role_Role" class="user_role_Role">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_role_list->Role->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_role_list->Role->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_role_list->Role->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($user_role_list->RoleDescription->Visible) { // RoleDescription ?>
	<?php if ($user_role_list->SortUrl($user_role_list->RoleDescription) == "") { ?>
		<th data-name="RoleDescription" class="<?php echo $user_role_list->RoleDescription->headerCellClass() ?>"><div id="elh_user_role_RoleDescription" class="user_role_RoleDescription"><div class="ew-table-header-caption"><?php echo $user_role_list->RoleDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RoleDescription" class="<?php echo $user_role_list->RoleDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $user_role_list->SortUrl($user_role_list->RoleDescription) ?>', 1);"><div id="elh_user_role_RoleDescription" class="user_role_RoleDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $user_role_list->RoleDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($user_role_list->RoleDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($user_role_list->RoleDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$user_role_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($user_role_list->ExportAll && $user_role_list->isExport()) {
	$user_role_list->StopRecord = $user_role_list->TotalRecords;
} else {

	// Set the last record to display
	if ($user_role_list->TotalRecords > $user_role_list->StartRecord + $user_role_list->DisplayRecords - 1)
		$user_role_list->StopRecord = $user_role_list->StartRecord + $user_role_list->DisplayRecords - 1;
	else
		$user_role_list->StopRecord = $user_role_list->TotalRecords;
}
$user_role_list->RecordCount = $user_role_list->StartRecord - 1;
if ($user_role_list->Recordset && !$user_role_list->Recordset->EOF) {
	$user_role_list->Recordset->moveFirst();
	$selectLimit = $user_role_list->UseSelectLimit;
	if (!$selectLimit && $user_role_list->StartRecord > 1)
		$user_role_list->Recordset->move($user_role_list->StartRecord - 1);
} elseif (!$user_role->AllowAddDeleteRow && $user_role_list->StopRecord == 0) {
	$user_role_list->StopRecord = $user_role->GridAddRowCount;
}

// Initialize aggregate
$user_role->RowType = ROWTYPE_AGGREGATEINIT;
$user_role->resetAttributes();
$user_role_list->renderRow();
while ($user_role_list->RecordCount < $user_role_list->StopRecord) {
	$user_role_list->RecordCount++;
	if ($user_role_list->RecordCount >= $user_role_list->StartRecord) {
		$user_role_list->RowCount++;

		// Set up key count
		$user_role_list->KeyCount = $user_role_list->RowIndex;

		// Init row class and style
		$user_role->resetAttributes();
		$user_role->CssClass = "";
		if ($user_role_list->isGridAdd()) {
		} else {
			$user_role_list->loadRowValues($user_role_list->Recordset); // Load row values
		}
		$user_role->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$user_role->RowAttrs->merge(["data-rowindex" => $user_role_list->RowCount, "id" => "r" . $user_role_list->RowCount . "_user_role", "data-rowtype" => $user_role->RowType]);

		// Render row
		$user_role_list->renderRow();

		// Render list options
		$user_role_list->renderListOptions();
?>
	<tr <?php echo $user_role->rowAttributes() ?>>
<?php

// Render list options (body, left)
$user_role_list->ListOptions->render("body", "left", $user_role_list->RowCount);
?>
	<?php if ($user_role_list->Role->Visible) { // Role ?>
		<td data-name="Role" <?php echo $user_role_list->Role->cellAttributes() ?>>
<span id="el<?php echo $user_role_list->RowCount ?>_user_role_Role">
<span<?php echo $user_role_list->Role->viewAttributes() ?>><?php echo $user_role_list->Role->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($user_role_list->RoleDescription->Visible) { // RoleDescription ?>
		<td data-name="RoleDescription" <?php echo $user_role_list->RoleDescription->cellAttributes() ?>>
<span id="el<?php echo $user_role_list->RowCount ?>_user_role_RoleDescription">
<span<?php echo $user_role_list->RoleDescription->viewAttributes() ?>><?php echo $user_role_list->RoleDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$user_role_list->ListOptions->render("body", "right", $user_role_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$user_role_list->isGridAdd())
		$user_role_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$user_role->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($user_role_list->Recordset)
	$user_role_list->Recordset->Close();
?>
<?php if (!$user_role_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$user_role_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $user_role_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $user_role_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($user_role_list->TotalRecords == 0 && !$user_role->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $user_role_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$user_role_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$user_role_list->isExport()) { ?>
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
$user_role_list->terminate();
?>