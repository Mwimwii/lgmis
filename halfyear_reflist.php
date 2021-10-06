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
$halfyear_ref_list = new halfyear_ref_list();

// Run the page
$halfyear_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$halfyear_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$halfyear_ref_list->isExport()) { ?>
<script>
var fhalfyear_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fhalfyear_reflist = currentForm = new ew.Form("fhalfyear_reflist", "list");
	fhalfyear_reflist.formKeyCountName = '<?php echo $halfyear_ref_list->FormKeyCountName ?>';

	// Validate form
	fhalfyear_reflist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($halfyear_ref_list->HalfYear->Required) { ?>
				elm = this.getElements("x" + infix + "_HalfYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_list->HalfYear->caption(), $halfyear_ref_list->HalfYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_list->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_list->BillYear->caption(), $halfyear_ref_list->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_list->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_list->PropertyGroup->caption(), $halfyear_ref_list->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_list->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_list->StartDate->caption(), $halfyear_ref_list->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($halfyear_ref_list->StartDate->errorMessage()) ?>");
			<?php if ($halfyear_ref_list->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_list->Enddate->caption(), $halfyear_ref_list->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($halfyear_ref_list->Enddate->errorMessage()) ?>");
			<?php if ($halfyear_ref_list->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_list->ID->caption(), $halfyear_ref_list->ID->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fhalfyear_reflist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhalfyear_reflist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fhalfyear_reflist.lists["x_HalfYear"] = <?php echo $halfyear_ref_list->HalfYear->Lookup->toClientList($halfyear_ref_list) ?>;
	fhalfyear_reflist.lists["x_HalfYear"].options = <?php echo JsonEncode($halfyear_ref_list->HalfYear->options(FALSE, TRUE)) ?>;
	fhalfyear_reflist.lists["x_BillYear"] = <?php echo $halfyear_ref_list->BillYear->Lookup->toClientList($halfyear_ref_list) ?>;
	fhalfyear_reflist.lists["x_BillYear"].options = <?php echo JsonEncode($halfyear_ref_list->BillYear->lookupOptions()) ?>;
	fhalfyear_reflist.lists["x_PropertyGroup"] = <?php echo $halfyear_ref_list->PropertyGroup->Lookup->toClientList($halfyear_ref_list) ?>;
	fhalfyear_reflist.lists["x_PropertyGroup"].options = <?php echo JsonEncode($halfyear_ref_list->PropertyGroup->lookupOptions()) ?>;
	loadjs.done("fhalfyear_reflist");
});
var fhalfyear_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fhalfyear_reflistsrch = currentSearchForm = new ew.Form("fhalfyear_reflistsrch");

	// Dynamic selection lists
	// Filters

	fhalfyear_reflistsrch.filterList = <?php echo $halfyear_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	fhalfyear_reflistsrch.initSearchPanel = true;
	loadjs.done("fhalfyear_reflistsrch");
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
<?php if (!$halfyear_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($halfyear_ref_list->TotalRecords > 0 && $halfyear_ref_list->ExportOptions->visible()) { ?>
<?php $halfyear_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($halfyear_ref_list->ImportOptions->visible()) { ?>
<?php $halfyear_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($halfyear_ref_list->SearchOptions->visible()) { ?>
<?php $halfyear_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($halfyear_ref_list->FilterOptions->visible()) { ?>
<?php $halfyear_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$halfyear_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$halfyear_ref_list->isExport() && !$halfyear_ref->CurrentAction) { ?>
<form name="fhalfyear_reflistsrch" id="fhalfyear_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fhalfyear_reflistsrch-search-panel" class="<?php echo $halfyear_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="halfyear_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $halfyear_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($halfyear_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($halfyear_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $halfyear_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($halfyear_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($halfyear_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($halfyear_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($halfyear_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $halfyear_ref_list->showPageHeader(); ?>
<?php
$halfyear_ref_list->showMessage();
?>
<?php if ($halfyear_ref_list->TotalRecords > 0 || $halfyear_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($halfyear_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> halfyear_ref">
<?php if (!$halfyear_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$halfyear_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $halfyear_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $halfyear_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fhalfyear_reflist" id="fhalfyear_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="halfyear_ref">
<div id="gmp_halfyear_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($halfyear_ref_list->TotalRecords > 0 || $halfyear_ref_list->isGridEdit()) { ?>
<table id="tbl_halfyear_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$halfyear_ref->RowType = ROWTYPE_HEADER;

// Render list options
$halfyear_ref_list->renderListOptions();

// Render list options (header, left)
$halfyear_ref_list->ListOptions->render("header", "left");
?>
<?php if ($halfyear_ref_list->HalfYear->Visible) { // HalfYear ?>
	<?php if ($halfyear_ref_list->SortUrl($halfyear_ref_list->HalfYear) == "") { ?>
		<th data-name="HalfYear" class="<?php echo $halfyear_ref_list->HalfYear->headerCellClass() ?>"><div id="elh_halfyear_ref_HalfYear" class="halfyear_ref_HalfYear"><div class="ew-table-header-caption"><?php echo $halfyear_ref_list->HalfYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HalfYear" class="<?php echo $halfyear_ref_list->HalfYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $halfyear_ref_list->SortUrl($halfyear_ref_list->HalfYear) ?>', 1);"><div id="elh_halfyear_ref_HalfYear" class="halfyear_ref_HalfYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $halfyear_ref_list->HalfYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($halfyear_ref_list->HalfYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($halfyear_ref_list->HalfYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($halfyear_ref_list->BillYear->Visible) { // BillYear ?>
	<?php if ($halfyear_ref_list->SortUrl($halfyear_ref_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $halfyear_ref_list->BillYear->headerCellClass() ?>"><div id="elh_halfyear_ref_BillYear" class="halfyear_ref_BillYear"><div class="ew-table-header-caption"><?php echo $halfyear_ref_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $halfyear_ref_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $halfyear_ref_list->SortUrl($halfyear_ref_list->BillYear) ?>', 1);"><div id="elh_halfyear_ref_BillYear" class="halfyear_ref_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $halfyear_ref_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($halfyear_ref_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($halfyear_ref_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($halfyear_ref_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($halfyear_ref_list->SortUrl($halfyear_ref_list->PropertyGroup) == "") { ?>
		<th data-name="PropertyGroup" class="<?php echo $halfyear_ref_list->PropertyGroup->headerCellClass() ?>"><div id="elh_halfyear_ref_PropertyGroup" class="halfyear_ref_PropertyGroup"><div class="ew-table-header-caption"><?php echo $halfyear_ref_list->PropertyGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroup" class="<?php echo $halfyear_ref_list->PropertyGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $halfyear_ref_list->SortUrl($halfyear_ref_list->PropertyGroup) ?>', 1);"><div id="elh_halfyear_ref_PropertyGroup" class="halfyear_ref_PropertyGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $halfyear_ref_list->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($halfyear_ref_list->PropertyGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($halfyear_ref_list->PropertyGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($halfyear_ref_list->StartDate->Visible) { // StartDate ?>
	<?php if ($halfyear_ref_list->SortUrl($halfyear_ref_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $halfyear_ref_list->StartDate->headerCellClass() ?>"><div id="elh_halfyear_ref_StartDate" class="halfyear_ref_StartDate"><div class="ew-table-header-caption"><?php echo $halfyear_ref_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $halfyear_ref_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $halfyear_ref_list->SortUrl($halfyear_ref_list->StartDate) ?>', 1);"><div id="elh_halfyear_ref_StartDate" class="halfyear_ref_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $halfyear_ref_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($halfyear_ref_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($halfyear_ref_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($halfyear_ref_list->Enddate->Visible) { // Enddate ?>
	<?php if ($halfyear_ref_list->SortUrl($halfyear_ref_list->Enddate) == "") { ?>
		<th data-name="Enddate" class="<?php echo $halfyear_ref_list->Enddate->headerCellClass() ?>"><div id="elh_halfyear_ref_Enddate" class="halfyear_ref_Enddate"><div class="ew-table-header-caption"><?php echo $halfyear_ref_list->Enddate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Enddate" class="<?php echo $halfyear_ref_list->Enddate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $halfyear_ref_list->SortUrl($halfyear_ref_list->Enddate) ?>', 1);"><div id="elh_halfyear_ref_Enddate" class="halfyear_ref_Enddate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $halfyear_ref_list->Enddate->caption() ?></span><span class="ew-table-header-sort"><?php if ($halfyear_ref_list->Enddate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($halfyear_ref_list->Enddate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($halfyear_ref_list->ID->Visible) { // ID ?>
	<?php if ($halfyear_ref_list->SortUrl($halfyear_ref_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $halfyear_ref_list->ID->headerCellClass() ?>"><div id="elh_halfyear_ref_ID" class="halfyear_ref_ID"><div class="ew-table-header-caption"><?php echo $halfyear_ref_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $halfyear_ref_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $halfyear_ref_list->SortUrl($halfyear_ref_list->ID) ?>', 1);"><div id="elh_halfyear_ref_ID" class="halfyear_ref_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $halfyear_ref_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($halfyear_ref_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($halfyear_ref_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$halfyear_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($halfyear_ref_list->ExportAll && $halfyear_ref_list->isExport()) {
	$halfyear_ref_list->StopRecord = $halfyear_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($halfyear_ref_list->TotalRecords > $halfyear_ref_list->StartRecord + $halfyear_ref_list->DisplayRecords - 1)
		$halfyear_ref_list->StopRecord = $halfyear_ref_list->StartRecord + $halfyear_ref_list->DisplayRecords - 1;
	else
		$halfyear_ref_list->StopRecord = $halfyear_ref_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($halfyear_ref->isConfirm() || $halfyear_ref_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($halfyear_ref_list->FormKeyCountName) && ($halfyear_ref_list->isGridAdd() || $halfyear_ref_list->isGridEdit() || $halfyear_ref->isConfirm())) {
		$halfyear_ref_list->KeyCount = $CurrentForm->getValue($halfyear_ref_list->FormKeyCountName);
		$halfyear_ref_list->StopRecord = $halfyear_ref_list->StartRecord + $halfyear_ref_list->KeyCount - 1;
	}
}
$halfyear_ref_list->RecordCount = $halfyear_ref_list->StartRecord - 1;
if ($halfyear_ref_list->Recordset && !$halfyear_ref_list->Recordset->EOF) {
	$halfyear_ref_list->Recordset->moveFirst();
	$selectLimit = $halfyear_ref_list->UseSelectLimit;
	if (!$selectLimit && $halfyear_ref_list->StartRecord > 1)
		$halfyear_ref_list->Recordset->move($halfyear_ref_list->StartRecord - 1);
} elseif (!$halfyear_ref->AllowAddDeleteRow && $halfyear_ref_list->StopRecord == 0) {
	$halfyear_ref_list->StopRecord = $halfyear_ref->GridAddRowCount;
}

// Initialize aggregate
$halfyear_ref->RowType = ROWTYPE_AGGREGATEINIT;
$halfyear_ref->resetAttributes();
$halfyear_ref_list->renderRow();
$halfyear_ref_list->EditRowCount = 0;
if ($halfyear_ref_list->isEdit())
	$halfyear_ref_list->RowIndex = 1;
while ($halfyear_ref_list->RecordCount < $halfyear_ref_list->StopRecord) {
	$halfyear_ref_list->RecordCount++;
	if ($halfyear_ref_list->RecordCount >= $halfyear_ref_list->StartRecord) {
		$halfyear_ref_list->RowCount++;

		// Set up key count
		$halfyear_ref_list->KeyCount = $halfyear_ref_list->RowIndex;

		// Init row class and style
		$halfyear_ref->resetAttributes();
		$halfyear_ref->CssClass = "";
		if ($halfyear_ref_list->isGridAdd()) {
			$halfyear_ref_list->loadRowValues(); // Load default values
		} else {
			$halfyear_ref_list->loadRowValues($halfyear_ref_list->Recordset); // Load row values
		}
		$halfyear_ref->RowType = ROWTYPE_VIEW; // Render view
		if ($halfyear_ref_list->isEdit()) {
			if ($halfyear_ref_list->checkInlineEditKey() && $halfyear_ref_list->EditRowCount == 0) { // Inline edit
				$halfyear_ref->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($halfyear_ref_list->isEdit() && $halfyear_ref->RowType == ROWTYPE_EDIT && $halfyear_ref->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$halfyear_ref_list->restoreFormValues(); // Restore form values
		}
		if ($halfyear_ref->RowType == ROWTYPE_EDIT) // Edit row
			$halfyear_ref_list->EditRowCount++;

		// Set up row id / data-rowindex
		$halfyear_ref->RowAttrs->merge(["data-rowindex" => $halfyear_ref_list->RowCount, "id" => "r" . $halfyear_ref_list->RowCount . "_halfyear_ref", "data-rowtype" => $halfyear_ref->RowType]);

		// Render row
		$halfyear_ref_list->renderRow();

		// Render list options
		$halfyear_ref_list->renderListOptions();
?>
	<tr <?php echo $halfyear_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$halfyear_ref_list->ListOptions->render("body", "left", $halfyear_ref_list->RowCount);
?>
	<?php if ($halfyear_ref_list->HalfYear->Visible) { // HalfYear ?>
		<td data-name="HalfYear" <?php echo $halfyear_ref_list->HalfYear->cellAttributes() ?>>
<?php if ($halfyear_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_HalfYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="halfyear_ref" data-field="x_HalfYear" data-value-separator="<?php echo $halfyear_ref_list->HalfYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $halfyear_ref_list->RowIndex ?>_HalfYear" name="x<?php echo $halfyear_ref_list->RowIndex ?>_HalfYear"<?php echo $halfyear_ref_list->HalfYear->editAttributes() ?>>
			<?php echo $halfyear_ref_list->HalfYear->selectOptionListHtml("x{$halfyear_ref_list->RowIndex}_HalfYear") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($halfyear_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_HalfYear">
<span<?php echo $halfyear_ref_list->HalfYear->viewAttributes() ?>><?php echo $halfyear_ref_list->HalfYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($halfyear_ref_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $halfyear_ref_list->BillYear->cellAttributes() ?>>
<?php if ($halfyear_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_BillYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="halfyear_ref" data-field="x_BillYear" data-value-separator="<?php echo $halfyear_ref_list->BillYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $halfyear_ref_list->RowIndex ?>_BillYear" name="x<?php echo $halfyear_ref_list->RowIndex ?>_BillYear"<?php echo $halfyear_ref_list->BillYear->editAttributes() ?>>
			<?php echo $halfyear_ref_list->BillYear->selectOptionListHtml("x{$halfyear_ref_list->RowIndex}_BillYear") ?>
		</select>
</div>
<?php echo $halfyear_ref_list->BillYear->Lookup->getParamTag($halfyear_ref_list, "p_x" . $halfyear_ref_list->RowIndex . "_BillYear") ?>
</span>
<?php } ?>
<?php if ($halfyear_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_BillYear">
<span<?php echo $halfyear_ref_list->BillYear->viewAttributes() ?>><?php echo $halfyear_ref_list->BillYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($halfyear_ref_list->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup" <?php echo $halfyear_ref_list->PropertyGroup->cellAttributes() ?>>
<?php if ($halfyear_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_PropertyGroup" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $halfyear_ref_list->RowIndex ?>_PropertyGroup"><?php echo EmptyValue(strval($halfyear_ref_list->PropertyGroup->ViewValue)) ? $Language->phrase("PleaseSelect") : $halfyear_ref_list->PropertyGroup->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($halfyear_ref_list->PropertyGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($halfyear_ref_list->PropertyGroup->ReadOnly || $halfyear_ref_list->PropertyGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $halfyear_ref_list->RowIndex ?>_PropertyGroup',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $halfyear_ref_list->PropertyGroup->Lookup->getParamTag($halfyear_ref_list, "p_x" . $halfyear_ref_list->RowIndex . "_PropertyGroup") ?>
<input type="hidden" data-table="halfyear_ref" data-field="x_PropertyGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $halfyear_ref_list->PropertyGroup->displayValueSeparatorAttribute() ?>" name="x<?php echo $halfyear_ref_list->RowIndex ?>_PropertyGroup" id="x<?php echo $halfyear_ref_list->RowIndex ?>_PropertyGroup" value="<?php echo $halfyear_ref_list->PropertyGroup->CurrentValue ?>"<?php echo $halfyear_ref_list->PropertyGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($halfyear_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_PropertyGroup">
<span<?php echo $halfyear_ref_list->PropertyGroup->viewAttributes() ?>><?php echo $halfyear_ref_list->PropertyGroup->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($halfyear_ref_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $halfyear_ref_list->StartDate->cellAttributes() ?>>
<?php if ($halfyear_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_StartDate" class="form-group">
<input type="text" data-table="halfyear_ref" data-field="x_StartDate" name="x<?php echo $halfyear_ref_list->RowIndex ?>_StartDate" id="x<?php echo $halfyear_ref_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($halfyear_ref_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $halfyear_ref_list->StartDate->EditValue ?>"<?php echo $halfyear_ref_list->StartDate->editAttributes() ?>>
<?php if (!$halfyear_ref_list->StartDate->ReadOnly && !$halfyear_ref_list->StartDate->Disabled && !isset($halfyear_ref_list->StartDate->EditAttrs["readonly"]) && !isset($halfyear_ref_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhalfyear_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fhalfyear_reflist", "x<?php echo $halfyear_ref_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($halfyear_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_StartDate">
<span<?php echo $halfyear_ref_list->StartDate->viewAttributes() ?>><?php echo $halfyear_ref_list->StartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($halfyear_ref_list->Enddate->Visible) { // Enddate ?>
		<td data-name="Enddate" <?php echo $halfyear_ref_list->Enddate->cellAttributes() ?>>
<?php if ($halfyear_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_Enddate" class="form-group">
<input type="text" data-table="halfyear_ref" data-field="x_Enddate" name="x<?php echo $halfyear_ref_list->RowIndex ?>_Enddate" id="x<?php echo $halfyear_ref_list->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($halfyear_ref_list->Enddate->getPlaceHolder()) ?>" value="<?php echo $halfyear_ref_list->Enddate->EditValue ?>"<?php echo $halfyear_ref_list->Enddate->editAttributes() ?>>
<?php if (!$halfyear_ref_list->Enddate->ReadOnly && !$halfyear_ref_list->Enddate->Disabled && !isset($halfyear_ref_list->Enddate->EditAttrs["readonly"]) && !isset($halfyear_ref_list->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhalfyear_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fhalfyear_reflist", "x<?php echo $halfyear_ref_list->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($halfyear_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_Enddate">
<span<?php echo $halfyear_ref_list->Enddate->viewAttributes() ?>><?php echo $halfyear_ref_list->Enddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($halfyear_ref_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $halfyear_ref_list->ID->cellAttributes() ?>>
<?php if ($halfyear_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_ID" class="form-group">
<span<?php echo $halfyear_ref_list->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($halfyear_ref_list->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="halfyear_ref" data-field="x_ID" name="x<?php echo $halfyear_ref_list->RowIndex ?>_ID" id="x<?php echo $halfyear_ref_list->RowIndex ?>_ID" value="<?php echo HtmlEncode($halfyear_ref_list->ID->CurrentValue) ?>">
<?php } ?>
<?php if ($halfyear_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $halfyear_ref_list->RowCount ?>_halfyear_ref_ID">
<span<?php echo $halfyear_ref_list->ID->viewAttributes() ?>><?php echo $halfyear_ref_list->ID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$halfyear_ref_list->ListOptions->render("body", "right", $halfyear_ref_list->RowCount);
?>
	</tr>
<?php if ($halfyear_ref->RowType == ROWTYPE_ADD || $halfyear_ref->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fhalfyear_reflist", "load"], function() {
	fhalfyear_reflist.updateLists(<?php echo $halfyear_ref_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$halfyear_ref_list->isGridAdd())
		$halfyear_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($halfyear_ref_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $halfyear_ref_list->FormKeyCountName ?>" id="<?php echo $halfyear_ref_list->FormKeyCountName ?>" value="<?php echo $halfyear_ref_list->KeyCount ?>">
<?php } ?>
<?php if (!$halfyear_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($halfyear_ref_list->Recordset)
	$halfyear_ref_list->Recordset->Close();
?>
<?php if (!$halfyear_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$halfyear_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $halfyear_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $halfyear_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($halfyear_ref_list->TotalRecords == 0 && !$halfyear_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $halfyear_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$halfyear_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$halfyear_ref_list->isExport()) { ?>
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
$halfyear_ref_list->terminate();
?>