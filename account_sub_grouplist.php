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
$account_sub_group_list = new account_sub_group_list();

// Run the page
$account_sub_group_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$account_sub_group_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$account_sub_group_list->isExport()) { ?>
<script>
var faccount_sub_grouplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	faccount_sub_grouplist = currentForm = new ew.Form("faccount_sub_grouplist", "list");
	faccount_sub_grouplist.formKeyCountName = '<?php echo $account_sub_group_list->FormKeyCountName ?>';
	loadjs.done("faccount_sub_grouplist");
});
var faccount_sub_grouplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	faccount_sub_grouplistsrch = currentSearchForm = new ew.Form("faccount_sub_grouplistsrch");

	// Dynamic selection lists
	// Filters

	faccount_sub_grouplistsrch.filterList = <?php echo $account_sub_group_list->getFilterList() ?>;

	// Init search panel as collapsed
	faccount_sub_grouplistsrch.initSearchPanel = true;
	loadjs.done("faccount_sub_grouplistsrch");
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
<?php if (!$account_sub_group_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($account_sub_group_list->TotalRecords > 0 && $account_sub_group_list->ExportOptions->visible()) { ?>
<?php $account_sub_group_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($account_sub_group_list->ImportOptions->visible()) { ?>
<?php $account_sub_group_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($account_sub_group_list->SearchOptions->visible()) { ?>
<?php $account_sub_group_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($account_sub_group_list->FilterOptions->visible()) { ?>
<?php $account_sub_group_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$account_sub_group_list->isExport() || Config("EXPORT_MASTER_RECORD") && $account_sub_group_list->isExport("print")) { ?>
<?php
if ($account_sub_group_list->DbMasterFilter != "" && $account_sub_group->getCurrentMasterTable() == "accountgroup") {
	if ($account_sub_group_list->MasterRecordExists) {
		include_once "accountgroupmaster.php";
	}
}
?>
<?php } ?>
<?php
$account_sub_group_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$account_sub_group_list->isExport() && !$account_sub_group->CurrentAction) { ?>
<form name="faccount_sub_grouplistsrch" id="faccount_sub_grouplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="faccount_sub_grouplistsrch-search-panel" class="<?php echo $account_sub_group_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="account_sub_group">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $account_sub_group_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($account_sub_group_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($account_sub_group_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $account_sub_group_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($account_sub_group_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($account_sub_group_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($account_sub_group_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($account_sub_group_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $account_sub_group_list->showPageHeader(); ?>
<?php
$account_sub_group_list->showMessage();
?>
<?php if ($account_sub_group_list->TotalRecords > 0 || $account_sub_group->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($account_sub_group_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> account_sub_group">
<?php if (!$account_sub_group_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$account_sub_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $account_sub_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $account_sub_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="faccount_sub_grouplist" id="faccount_sub_grouplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="account_sub_group">
<?php if ($account_sub_group->getCurrentMasterTable() == "accountgroup" && $account_sub_group->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="accountgroup">
<input type="hidden" name="fk_AccountType" value="<?php echo HtmlEncode($account_sub_group_list->AccountType->getSessionValue()) ?>">
<input type="hidden" name="fk_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_list->AccountGroupCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_account_sub_group" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($account_sub_group_list->TotalRecords > 0 || $account_sub_group_list->isGridEdit()) { ?>
<table id="tbl_account_sub_grouplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$account_sub_group->RowType = ROWTYPE_HEADER;

// Render list options
$account_sub_group_list->renderListOptions();

// Render list options (header, left)
$account_sub_group_list->ListOptions->render("header", "left");
?>
<?php if ($account_sub_group_list->AccountType->Visible) { // AccountType ?>
	<?php if ($account_sub_group_list->SortUrl($account_sub_group_list->AccountType) == "") { ?>
		<th data-name="AccountType" class="<?php echo $account_sub_group_list->AccountType->headerCellClass() ?>"><div id="elh_account_sub_group_AccountType" class="account_sub_group_AccountType"><div class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountType" class="<?php echo $account_sub_group_list->AccountType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $account_sub_group_list->SortUrl($account_sub_group_list->AccountType) ?>', 1);"><div id="elh_account_sub_group_AccountType" class="account_sub_group_AccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_list->AccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_list->AccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($account_sub_group_list->SortUrl($account_sub_group_list->AccountGroupCode) == "") { ?>
		<th data-name="AccountGroupCode" class="<?php echo $account_sub_group_list->AccountGroupCode->headerCellClass() ?>"><div id="elh_account_sub_group_AccountGroupCode" class="account_sub_group_AccountGroupCode"><div class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupCode" class="<?php echo $account_sub_group_list->AccountGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $account_sub_group_list->SortUrl($account_sub_group_list->AccountGroupCode) ?>', 1);"><div id="elh_account_sub_group_AccountGroupCode" class="account_sub_group_AccountGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_list->AccountGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_list->AccountGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_list->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<?php if ($account_sub_group_list->SortUrl($account_sub_group_list->AccountSubGroupCode) == "") { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $account_sub_group_list->AccountSubGroupCode->headerCellClass() ?>"><div id="elh_account_sub_group_AccountSubGroupCode" class="account_sub_group_AccountSubGroupCode"><div class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountSubGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $account_sub_group_list->AccountSubGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $account_sub_group_list->SortUrl($account_sub_group_list->AccountSubGroupCode) ?>', 1);"><div id="elh_account_sub_group_AccountSubGroupCode" class="account_sub_group_AccountSubGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountSubGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_list->AccountSubGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_list->AccountSubGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_list->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
	<?php if ($account_sub_group_list->SortUrl($account_sub_group_list->AccountSubGroupName) == "") { ?>
		<th data-name="AccountSubGroupName" class="<?php echo $account_sub_group_list->AccountSubGroupName->headerCellClass() ?>"><div id="elh_account_sub_group_AccountSubGroupName" class="account_sub_group_AccountSubGroupName"><div class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountSubGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountSubGroupName" class="<?php echo $account_sub_group_list->AccountSubGroupName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $account_sub_group_list->SortUrl($account_sub_group_list->AccountSubGroupName) ?>', 1);"><div id="elh_account_sub_group_AccountSubGroupName" class="account_sub_group_AccountSubGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_list->AccountSubGroupName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_list->AccountSubGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_list->AccountSubGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$account_sub_group_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($account_sub_group_list->ExportAll && $account_sub_group_list->isExport()) {
	$account_sub_group_list->StopRecord = $account_sub_group_list->TotalRecords;
} else {

	// Set the last record to display
	if ($account_sub_group_list->TotalRecords > $account_sub_group_list->StartRecord + $account_sub_group_list->DisplayRecords - 1)
		$account_sub_group_list->StopRecord = $account_sub_group_list->StartRecord + $account_sub_group_list->DisplayRecords - 1;
	else
		$account_sub_group_list->StopRecord = $account_sub_group_list->TotalRecords;
}
$account_sub_group_list->RecordCount = $account_sub_group_list->StartRecord - 1;
if ($account_sub_group_list->Recordset && !$account_sub_group_list->Recordset->EOF) {
	$account_sub_group_list->Recordset->moveFirst();
	$selectLimit = $account_sub_group_list->UseSelectLimit;
	if (!$selectLimit && $account_sub_group_list->StartRecord > 1)
		$account_sub_group_list->Recordset->move($account_sub_group_list->StartRecord - 1);
} elseif (!$account_sub_group->AllowAddDeleteRow && $account_sub_group_list->StopRecord == 0) {
	$account_sub_group_list->StopRecord = $account_sub_group->GridAddRowCount;
}

// Initialize aggregate
$account_sub_group->RowType = ROWTYPE_AGGREGATEINIT;
$account_sub_group->resetAttributes();
$account_sub_group_list->renderRow();
while ($account_sub_group_list->RecordCount < $account_sub_group_list->StopRecord) {
	$account_sub_group_list->RecordCount++;
	if ($account_sub_group_list->RecordCount >= $account_sub_group_list->StartRecord) {
		$account_sub_group_list->RowCount++;

		// Set up key count
		$account_sub_group_list->KeyCount = $account_sub_group_list->RowIndex;

		// Init row class and style
		$account_sub_group->resetAttributes();
		$account_sub_group->CssClass = "";
		if ($account_sub_group_list->isGridAdd()) {
		} else {
			$account_sub_group_list->loadRowValues($account_sub_group_list->Recordset); // Load row values
		}
		$account_sub_group->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$account_sub_group->RowAttrs->merge(["data-rowindex" => $account_sub_group_list->RowCount, "id" => "r" . $account_sub_group_list->RowCount . "_account_sub_group", "data-rowtype" => $account_sub_group->RowType]);

		// Render row
		$account_sub_group_list->renderRow();

		// Render list options
		$account_sub_group_list->renderListOptions();
?>
	<tr <?php echo $account_sub_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$account_sub_group_list->ListOptions->render("body", "left", $account_sub_group_list->RowCount);
?>
	<?php if ($account_sub_group_list->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType" <?php echo $account_sub_group_list->AccountType->cellAttributes() ?>>
<span id="el<?php echo $account_sub_group_list->RowCount ?>_account_sub_group_AccountType">
<span<?php echo $account_sub_group_list->AccountType->viewAttributes() ?>><?php echo $account_sub_group_list->AccountType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($account_sub_group_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode" <?php echo $account_sub_group_list->AccountGroupCode->cellAttributes() ?>>
<span id="el<?php echo $account_sub_group_list->RowCount ?>_account_sub_group_AccountGroupCode">
<span<?php echo $account_sub_group_list->AccountGroupCode->viewAttributes() ?>><?php echo $account_sub_group_list->AccountGroupCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($account_sub_group_list->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<td data-name="AccountSubGroupCode" <?php echo $account_sub_group_list->AccountSubGroupCode->cellAttributes() ?>>
<span id="el<?php echo $account_sub_group_list->RowCount ?>_account_sub_group_AccountSubGroupCode">
<span<?php echo $account_sub_group_list->AccountSubGroupCode->viewAttributes() ?>><?php echo $account_sub_group_list->AccountSubGroupCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($account_sub_group_list->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
		<td data-name="AccountSubGroupName" <?php echo $account_sub_group_list->AccountSubGroupName->cellAttributes() ?>>
<span id="el<?php echo $account_sub_group_list->RowCount ?>_account_sub_group_AccountSubGroupName">
<span<?php echo $account_sub_group_list->AccountSubGroupName->viewAttributes() ?>><?php echo $account_sub_group_list->AccountSubGroupName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$account_sub_group_list->ListOptions->render("body", "right", $account_sub_group_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$account_sub_group_list->isGridAdd())
		$account_sub_group_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$account_sub_group->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($account_sub_group_list->Recordset)
	$account_sub_group_list->Recordset->Close();
?>
<?php if (!$account_sub_group_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$account_sub_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $account_sub_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $account_sub_group_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($account_sub_group_list->TotalRecords == 0 && !$account_sub_group->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $account_sub_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$account_sub_group_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$account_sub_group_list->isExport()) { ?>
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
$account_sub_group_list->terminate();
?>