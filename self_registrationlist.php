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
$self_registration_list = new self_registration_list();

// Run the page
$self_registration_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$self_registration_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$self_registration_list->isExport()) { ?>
<script>
var fself_registrationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fself_registrationlist = currentForm = new ew.Form("fself_registrationlist", "list");
	fself_registrationlist.formKeyCountName = '<?php echo $self_registration_list->FormKeyCountName ?>';
	loadjs.done("fself_registrationlist");
});
var fself_registrationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fself_registrationlistsrch = currentSearchForm = new ew.Form("fself_registrationlistsrch");

	// Dynamic selection lists
	// Filters

	fself_registrationlistsrch.filterList = <?php echo $self_registration_list->getFilterList() ?>;

	// Init search panel as collapsed
	fself_registrationlistsrch.initSearchPanel = true;
	loadjs.done("fself_registrationlistsrch");
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
<?php if (!$self_registration_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($self_registration_list->TotalRecords > 0 && $self_registration_list->ExportOptions->visible()) { ?>
<?php $self_registration_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($self_registration_list->ImportOptions->visible()) { ?>
<?php $self_registration_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($self_registration_list->SearchOptions->visible()) { ?>
<?php $self_registration_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($self_registration_list->FilterOptions->visible()) { ?>
<?php $self_registration_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$self_registration_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$self_registration_list->isExport() && !$self_registration->CurrentAction) { ?>
<form name="fself_registrationlistsrch" id="fself_registrationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fself_registrationlistsrch-search-panel" class="<?php echo $self_registration_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="self_registration">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $self_registration_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($self_registration_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($self_registration_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $self_registration_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($self_registration_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($self_registration_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($self_registration_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($self_registration_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $self_registration_list->showPageHeader(); ?>
<?php
$self_registration_list->showMessage();
?>
<?php if ($self_registration_list->TotalRecords > 0 || $self_registration->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($self_registration_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> self_registration">
<?php if (!$self_registration_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$self_registration_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $self_registration_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $self_registration_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fself_registrationlist" id="fself_registrationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="self_registration">
<div id="gmp_self_registration" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($self_registration_list->TotalRecords > 0 || $self_registration_list->isGridEdit()) { ?>
<table id="tbl_self_registrationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$self_registration->RowType = ROWTYPE_HEADER;

// Render list options
$self_registration_list->renderListOptions();

// Render list options (header, left)
$self_registration_list->ListOptions->render("header", "left");
?>
<?php if ($self_registration_list->SelfRegistrationID->Visible) { // SelfRegistrationID ?>
	<?php if ($self_registration_list->SortUrl($self_registration_list->SelfRegistrationID) == "") { ?>
		<th data-name="SelfRegistrationID" class="<?php echo $self_registration_list->SelfRegistrationID->headerCellClass() ?>"><div id="elh_self_registration_SelfRegistrationID" class="self_registration_SelfRegistrationID"><div class="ew-table-header-caption"><?php echo $self_registration_list->SelfRegistrationID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SelfRegistrationID" class="<?php echo $self_registration_list->SelfRegistrationID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $self_registration_list->SortUrl($self_registration_list->SelfRegistrationID) ?>', 1);"><div id="elh_self_registration_SelfRegistrationID" class="self_registration_SelfRegistrationID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $self_registration_list->SelfRegistrationID->caption() ?></span><span class="ew-table-header-sort"><?php if ($self_registration_list->SelfRegistrationID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($self_registration_list->SelfRegistrationID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($self_registration_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($self_registration_list->SortUrl($self_registration_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $self_registration_list->EmployeeID->headerCellClass() ?>"><div id="elh_self_registration_EmployeeID" class="self_registration_EmployeeID"><div class="ew-table-header-caption"><?php echo $self_registration_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $self_registration_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $self_registration_list->SortUrl($self_registration_list->EmployeeID) ?>', 1);"><div id="elh_self_registration_EmployeeID" class="self_registration_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $self_registration_list->EmployeeID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($self_registration_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($self_registration_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($self_registration_list->NRC->Visible) { // NRC ?>
	<?php if ($self_registration_list->SortUrl($self_registration_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $self_registration_list->NRC->headerCellClass() ?>"><div id="elh_self_registration_NRC" class="self_registration_NRC"><div class="ew-table-header-caption"><?php echo $self_registration_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $self_registration_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $self_registration_list->SortUrl($self_registration_list->NRC) ?>', 1);"><div id="elh_self_registration_NRC" class="self_registration_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $self_registration_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($self_registration_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($self_registration_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$self_registration_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($self_registration_list->ExportAll && $self_registration_list->isExport()) {
	$self_registration_list->StopRecord = $self_registration_list->TotalRecords;
} else {

	// Set the last record to display
	if ($self_registration_list->TotalRecords > $self_registration_list->StartRecord + $self_registration_list->DisplayRecords - 1)
		$self_registration_list->StopRecord = $self_registration_list->StartRecord + $self_registration_list->DisplayRecords - 1;
	else
		$self_registration_list->StopRecord = $self_registration_list->TotalRecords;
}
$self_registration_list->RecordCount = $self_registration_list->StartRecord - 1;
if ($self_registration_list->Recordset && !$self_registration_list->Recordset->EOF) {
	$self_registration_list->Recordset->moveFirst();
	$selectLimit = $self_registration_list->UseSelectLimit;
	if (!$selectLimit && $self_registration_list->StartRecord > 1)
		$self_registration_list->Recordset->move($self_registration_list->StartRecord - 1);
} elseif (!$self_registration->AllowAddDeleteRow && $self_registration_list->StopRecord == 0) {
	$self_registration_list->StopRecord = $self_registration->GridAddRowCount;
}

// Initialize aggregate
$self_registration->RowType = ROWTYPE_AGGREGATEINIT;
$self_registration->resetAttributes();
$self_registration_list->renderRow();
while ($self_registration_list->RecordCount < $self_registration_list->StopRecord) {
	$self_registration_list->RecordCount++;
	if ($self_registration_list->RecordCount >= $self_registration_list->StartRecord) {
		$self_registration_list->RowCount++;

		// Set up key count
		$self_registration_list->KeyCount = $self_registration_list->RowIndex;

		// Init row class and style
		$self_registration->resetAttributes();
		$self_registration->CssClass = "";
		if ($self_registration_list->isGridAdd()) {
		} else {
			$self_registration_list->loadRowValues($self_registration_list->Recordset); // Load row values
		}
		$self_registration->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$self_registration->RowAttrs->merge(["data-rowindex" => $self_registration_list->RowCount, "id" => "r" . $self_registration_list->RowCount . "_self_registration", "data-rowtype" => $self_registration->RowType]);

		// Render row
		$self_registration_list->renderRow();

		// Render list options
		$self_registration_list->renderListOptions();
?>
	<tr <?php echo $self_registration->rowAttributes() ?>>
<?php

// Render list options (body, left)
$self_registration_list->ListOptions->render("body", "left", $self_registration_list->RowCount);
?>
	<?php if ($self_registration_list->SelfRegistrationID->Visible) { // SelfRegistrationID ?>
		<td data-name="SelfRegistrationID" <?php echo $self_registration_list->SelfRegistrationID->cellAttributes() ?>>
<span id="el<?php echo $self_registration_list->RowCount ?>_self_registration_SelfRegistrationID">
<span<?php echo $self_registration_list->SelfRegistrationID->viewAttributes() ?>><?php echo $self_registration_list->SelfRegistrationID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($self_registration_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $self_registration_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $self_registration_list->RowCount ?>_self_registration_EmployeeID">
<span<?php echo $self_registration_list->EmployeeID->viewAttributes() ?>><?php echo $self_registration_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($self_registration_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $self_registration_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $self_registration_list->RowCount ?>_self_registration_NRC">
<span<?php echo $self_registration_list->NRC->viewAttributes() ?>><?php echo $self_registration_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$self_registration_list->ListOptions->render("body", "right", $self_registration_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$self_registration_list->isGridAdd())
		$self_registration_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$self_registration->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($self_registration_list->Recordset)
	$self_registration_list->Recordset->Close();
?>
<?php if (!$self_registration_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$self_registration_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $self_registration_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $self_registration_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($self_registration_list->TotalRecords == 0 && !$self_registration->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $self_registration_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$self_registration_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$self_registration_list->isExport()) { ?>
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
$self_registration_list->terminate();
?>