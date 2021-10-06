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
$meansofimplement_list = new meansofimplement_list();

// Run the page
$meansofimplement_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$meansofimplement_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$meansofimplement_list->isExport()) { ?>
<script>
var fmeansofimplementlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmeansofimplementlist = currentForm = new ew.Form("fmeansofimplementlist", "list");
	fmeansofimplementlist.formKeyCountName = '<?php echo $meansofimplement_list->FormKeyCountName ?>';

	// Validate form
	fmeansofimplementlist.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($meansofimplement_list->moimp_code->Required) { ?>
				elm = this.getElements("x" + infix + "_moimp_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $meansofimplement_list->moimp_code->caption(), $meansofimplement_list->moimp_code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($meansofimplement_list->moimp_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_moimp_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $meansofimplement_list->moimp_desc->caption(), $meansofimplement_list->moimp_desc->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fmeansofimplementlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "moimp_desc", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fmeansofimplementlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmeansofimplementlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmeansofimplementlist");
});
var fmeansofimplementlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmeansofimplementlistsrch = currentSearchForm = new ew.Form("fmeansofimplementlistsrch");

	// Dynamic selection lists
	// Filters

	fmeansofimplementlistsrch.filterList = <?php echo $meansofimplement_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmeansofimplementlistsrch.initSearchPanel = true;
	loadjs.done("fmeansofimplementlistsrch");
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
<?php if (!$meansofimplement_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($meansofimplement_list->TotalRecords > 0 && $meansofimplement_list->ExportOptions->visible()) { ?>
<?php $meansofimplement_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($meansofimplement_list->ImportOptions->visible()) { ?>
<?php $meansofimplement_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($meansofimplement_list->SearchOptions->visible()) { ?>
<?php $meansofimplement_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($meansofimplement_list->FilterOptions->visible()) { ?>
<?php $meansofimplement_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$meansofimplement_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$meansofimplement_list->isExport() && !$meansofimplement->CurrentAction) { ?>
<form name="fmeansofimplementlistsrch" id="fmeansofimplementlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmeansofimplementlistsrch-search-panel" class="<?php echo $meansofimplement_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="meansofimplement">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $meansofimplement_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($meansofimplement_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($meansofimplement_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $meansofimplement_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($meansofimplement_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($meansofimplement_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($meansofimplement_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($meansofimplement_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $meansofimplement_list->showPageHeader(); ?>
<?php
$meansofimplement_list->showMessage();
?>
<?php if ($meansofimplement_list->TotalRecords > 0 || $meansofimplement->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($meansofimplement_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> meansofimplement">
<?php if (!$meansofimplement_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$meansofimplement_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $meansofimplement_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $meansofimplement_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmeansofimplementlist" id="fmeansofimplementlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="meansofimplement">
<div id="gmp_meansofimplement" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($meansofimplement_list->TotalRecords > 0 || $meansofimplement_list->isGridEdit()) { ?>
<table id="tbl_meansofimplementlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$meansofimplement->RowType = ROWTYPE_HEADER;

// Render list options
$meansofimplement_list->renderListOptions();

// Render list options (header, left)
$meansofimplement_list->ListOptions->render("header", "left");
?>
<?php if ($meansofimplement_list->moimp_code->Visible) { // moimp_code ?>
	<?php if ($meansofimplement_list->SortUrl($meansofimplement_list->moimp_code) == "") { ?>
		<th data-name="moimp_code" class="<?php echo $meansofimplement_list->moimp_code->headerCellClass() ?>"><div id="elh_meansofimplement_moimp_code" class="meansofimplement_moimp_code"><div class="ew-table-header-caption"><?php echo $meansofimplement_list->moimp_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="moimp_code" class="<?php echo $meansofimplement_list->moimp_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $meansofimplement_list->SortUrl($meansofimplement_list->moimp_code) ?>', 1);"><div id="elh_meansofimplement_moimp_code" class="meansofimplement_moimp_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $meansofimplement_list->moimp_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($meansofimplement_list->moimp_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($meansofimplement_list->moimp_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($meansofimplement_list->moimp_desc->Visible) { // moimp_desc ?>
	<?php if ($meansofimplement_list->SortUrl($meansofimplement_list->moimp_desc) == "") { ?>
		<th data-name="moimp_desc" class="<?php echo $meansofimplement_list->moimp_desc->headerCellClass() ?>"><div id="elh_meansofimplement_moimp_desc" class="meansofimplement_moimp_desc"><div class="ew-table-header-caption"><?php echo $meansofimplement_list->moimp_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="moimp_desc" class="<?php echo $meansofimplement_list->moimp_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $meansofimplement_list->SortUrl($meansofimplement_list->moimp_desc) ?>', 1);"><div id="elh_meansofimplement_moimp_desc" class="meansofimplement_moimp_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $meansofimplement_list->moimp_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($meansofimplement_list->moimp_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($meansofimplement_list->moimp_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$meansofimplement_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($meansofimplement_list->ExportAll && $meansofimplement_list->isExport()) {
	$meansofimplement_list->StopRecord = $meansofimplement_list->TotalRecords;
} else {

	// Set the last record to display
	if ($meansofimplement_list->TotalRecords > $meansofimplement_list->StartRecord + $meansofimplement_list->DisplayRecords - 1)
		$meansofimplement_list->StopRecord = $meansofimplement_list->StartRecord + $meansofimplement_list->DisplayRecords - 1;
	else
		$meansofimplement_list->StopRecord = $meansofimplement_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($meansofimplement->isConfirm() || $meansofimplement_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($meansofimplement_list->FormKeyCountName) && ($meansofimplement_list->isGridAdd() || $meansofimplement_list->isGridEdit() || $meansofimplement->isConfirm())) {
		$meansofimplement_list->KeyCount = $CurrentForm->getValue($meansofimplement_list->FormKeyCountName);
		$meansofimplement_list->StopRecord = $meansofimplement_list->StartRecord + $meansofimplement_list->KeyCount - 1;
	}
}
$meansofimplement_list->RecordCount = $meansofimplement_list->StartRecord - 1;
if ($meansofimplement_list->Recordset && !$meansofimplement_list->Recordset->EOF) {
	$meansofimplement_list->Recordset->moveFirst();
	$selectLimit = $meansofimplement_list->UseSelectLimit;
	if (!$selectLimit && $meansofimplement_list->StartRecord > 1)
		$meansofimplement_list->Recordset->move($meansofimplement_list->StartRecord - 1);
} elseif (!$meansofimplement->AllowAddDeleteRow && $meansofimplement_list->StopRecord == 0) {
	$meansofimplement_list->StopRecord = $meansofimplement->GridAddRowCount;
}

// Initialize aggregate
$meansofimplement->RowType = ROWTYPE_AGGREGATEINIT;
$meansofimplement->resetAttributes();
$meansofimplement_list->renderRow();
if ($meansofimplement_list->isGridAdd())
	$meansofimplement_list->RowIndex = 0;
if ($meansofimplement_list->isGridEdit())
	$meansofimplement_list->RowIndex = 0;
while ($meansofimplement_list->RecordCount < $meansofimplement_list->StopRecord) {
	$meansofimplement_list->RecordCount++;
	if ($meansofimplement_list->RecordCount >= $meansofimplement_list->StartRecord) {
		$meansofimplement_list->RowCount++;
		if ($meansofimplement_list->isGridAdd() || $meansofimplement_list->isGridEdit() || $meansofimplement->isConfirm()) {
			$meansofimplement_list->RowIndex++;
			$CurrentForm->Index = $meansofimplement_list->RowIndex;
			if ($CurrentForm->hasValue($meansofimplement_list->FormActionName) && ($meansofimplement->isConfirm() || $meansofimplement_list->EventCancelled))
				$meansofimplement_list->RowAction = strval($CurrentForm->getValue($meansofimplement_list->FormActionName));
			elseif ($meansofimplement_list->isGridAdd())
				$meansofimplement_list->RowAction = "insert";
			else
				$meansofimplement_list->RowAction = "";
		}

		// Set up key count
		$meansofimplement_list->KeyCount = $meansofimplement_list->RowIndex;

		// Init row class and style
		$meansofimplement->resetAttributes();
		$meansofimplement->CssClass = "";
		if ($meansofimplement_list->isGridAdd()) {
			$meansofimplement_list->loadRowValues(); // Load default values
		} else {
			$meansofimplement_list->loadRowValues($meansofimplement_list->Recordset); // Load row values
		}
		$meansofimplement->RowType = ROWTYPE_VIEW; // Render view
		if ($meansofimplement_list->isGridAdd()) // Grid add
			$meansofimplement->RowType = ROWTYPE_ADD; // Render add
		if ($meansofimplement_list->isGridAdd() && $meansofimplement->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$meansofimplement_list->restoreCurrentRowFormValues($meansofimplement_list->RowIndex); // Restore form values
		if ($meansofimplement_list->isGridEdit()) { // Grid edit
			if ($meansofimplement->EventCancelled)
				$meansofimplement_list->restoreCurrentRowFormValues($meansofimplement_list->RowIndex); // Restore form values
			if ($meansofimplement_list->RowAction == "insert")
				$meansofimplement->RowType = ROWTYPE_ADD; // Render add
			else
				$meansofimplement->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($meansofimplement_list->isGridEdit() && ($meansofimplement->RowType == ROWTYPE_EDIT || $meansofimplement->RowType == ROWTYPE_ADD) && $meansofimplement->EventCancelled) // Update failed
			$meansofimplement_list->restoreCurrentRowFormValues($meansofimplement_list->RowIndex); // Restore form values
		if ($meansofimplement->RowType == ROWTYPE_EDIT) // Edit row
			$meansofimplement_list->EditRowCount++;

		// Set up row id / data-rowindex
		$meansofimplement->RowAttrs->merge(["data-rowindex" => $meansofimplement_list->RowCount, "id" => "r" . $meansofimplement_list->RowCount . "_meansofimplement", "data-rowtype" => $meansofimplement->RowType]);

		// Render row
		$meansofimplement_list->renderRow();

		// Render list options
		$meansofimplement_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($meansofimplement_list->RowAction != "delete" && $meansofimplement_list->RowAction != "insertdelete" && !($meansofimplement_list->RowAction == "insert" && $meansofimplement->isConfirm() && $meansofimplement_list->emptyRow())) {
?>
	<tr <?php echo $meansofimplement->rowAttributes() ?>>
<?php

// Render list options (body, left)
$meansofimplement_list->ListOptions->render("body", "left", $meansofimplement_list->RowCount);
?>
	<?php if ($meansofimplement_list->moimp_code->Visible) { // moimp_code ?>
		<td data-name="moimp_code" <?php echo $meansofimplement_list->moimp_code->cellAttributes() ?>>
<?php if ($meansofimplement->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $meansofimplement_list->RowCount ?>_meansofimplement_moimp_code" class="form-group"></span>
<input type="hidden" data-table="meansofimplement" data-field="x_moimp_code" name="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_code" id="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_code" value="<?php echo HtmlEncode($meansofimplement_list->moimp_code->OldValue) ?>">
<?php } ?>
<?php if ($meansofimplement->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $meansofimplement_list->RowCount ?>_meansofimplement_moimp_code" class="form-group">
<span<?php echo $meansofimplement_list->moimp_code->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($meansofimplement_list->moimp_code->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="meansofimplement" data-field="x_moimp_code" name="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_code" id="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_code" value="<?php echo HtmlEncode($meansofimplement_list->moimp_code->CurrentValue) ?>">
<?php } ?>
<?php if ($meansofimplement->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $meansofimplement_list->RowCount ?>_meansofimplement_moimp_code">
<span<?php echo $meansofimplement_list->moimp_code->viewAttributes() ?>><?php echo $meansofimplement_list->moimp_code->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($meansofimplement_list->moimp_desc->Visible) { // moimp_desc ?>
		<td data-name="moimp_desc" <?php echo $meansofimplement_list->moimp_desc->cellAttributes() ?>>
<?php if ($meansofimplement->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $meansofimplement_list->RowCount ?>_meansofimplement_moimp_desc" class="form-group">
<input type="text" data-table="meansofimplement" data-field="x_moimp_desc" name="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" id="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($meansofimplement_list->moimp_desc->getPlaceHolder()) ?>" value="<?php echo $meansofimplement_list->moimp_desc->EditValue ?>"<?php echo $meansofimplement_list->moimp_desc->editAttributes() ?>>
</span>
<input type="hidden" data-table="meansofimplement" data-field="x_moimp_desc" name="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" id="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" value="<?php echo HtmlEncode($meansofimplement_list->moimp_desc->OldValue) ?>">
<?php } ?>
<?php if ($meansofimplement->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $meansofimplement_list->RowCount ?>_meansofimplement_moimp_desc" class="form-group">
<input type="text" data-table="meansofimplement" data-field="x_moimp_desc" name="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" id="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($meansofimplement_list->moimp_desc->getPlaceHolder()) ?>" value="<?php echo $meansofimplement_list->moimp_desc->EditValue ?>"<?php echo $meansofimplement_list->moimp_desc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($meansofimplement->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $meansofimplement_list->RowCount ?>_meansofimplement_moimp_desc">
<span<?php echo $meansofimplement_list->moimp_desc->viewAttributes() ?>><?php echo $meansofimplement_list->moimp_desc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$meansofimplement_list->ListOptions->render("body", "right", $meansofimplement_list->RowCount);
?>
	</tr>
<?php if ($meansofimplement->RowType == ROWTYPE_ADD || $meansofimplement->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmeansofimplementlist", "load"], function() {
	fmeansofimplementlist.updateLists(<?php echo $meansofimplement_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$meansofimplement_list->isGridAdd())
		if (!$meansofimplement_list->Recordset->EOF)
			$meansofimplement_list->Recordset->moveNext();
}
?>
<?php
	if ($meansofimplement_list->isGridAdd() || $meansofimplement_list->isGridEdit()) {
		$meansofimplement_list->RowIndex = '$rowindex$';
		$meansofimplement_list->loadRowValues();

		// Set row properties
		$meansofimplement->resetAttributes();
		$meansofimplement->RowAttrs->merge(["data-rowindex" => $meansofimplement_list->RowIndex, "id" => "r0_meansofimplement", "data-rowtype" => ROWTYPE_ADD]);
		$meansofimplement->RowAttrs->appendClass("ew-template");
		$meansofimplement->RowType = ROWTYPE_ADD;

		// Render row
		$meansofimplement_list->renderRow();

		// Render list options
		$meansofimplement_list->renderListOptions();
		$meansofimplement_list->StartRowCount = 0;
?>
	<tr <?php echo $meansofimplement->rowAttributes() ?>>
<?php

// Render list options (body, left)
$meansofimplement_list->ListOptions->render("body", "left", $meansofimplement_list->RowIndex);
?>
	<?php if ($meansofimplement_list->moimp_code->Visible) { // moimp_code ?>
		<td data-name="moimp_code">
<span id="el$rowindex$_meansofimplement_moimp_code" class="form-group meansofimplement_moimp_code"></span>
<input type="hidden" data-table="meansofimplement" data-field="x_moimp_code" name="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_code" id="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_code" value="<?php echo HtmlEncode($meansofimplement_list->moimp_code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($meansofimplement_list->moimp_desc->Visible) { // moimp_desc ?>
		<td data-name="moimp_desc">
<span id="el$rowindex$_meansofimplement_moimp_desc" class="form-group meansofimplement_moimp_desc">
<input type="text" data-table="meansofimplement" data-field="x_moimp_desc" name="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" id="x<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($meansofimplement_list->moimp_desc->getPlaceHolder()) ?>" value="<?php echo $meansofimplement_list->moimp_desc->EditValue ?>"<?php echo $meansofimplement_list->moimp_desc->editAttributes() ?>>
</span>
<input type="hidden" data-table="meansofimplement" data-field="x_moimp_desc" name="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" id="o<?php echo $meansofimplement_list->RowIndex ?>_moimp_desc" value="<?php echo HtmlEncode($meansofimplement_list->moimp_desc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$meansofimplement_list->ListOptions->render("body", "right", $meansofimplement_list->RowIndex);
?>
<script>
loadjs.ready(["fmeansofimplementlist", "load"], function() {
	fmeansofimplementlist.updateLists(<?php echo $meansofimplement_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($meansofimplement_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $meansofimplement_list->FormKeyCountName ?>" id="<?php echo $meansofimplement_list->FormKeyCountName ?>" value="<?php echo $meansofimplement_list->KeyCount ?>">
<?php echo $meansofimplement_list->MultiSelectKey ?>
<?php } ?>
<?php if ($meansofimplement_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $meansofimplement_list->FormKeyCountName ?>" id="<?php echo $meansofimplement_list->FormKeyCountName ?>" value="<?php echo $meansofimplement_list->KeyCount ?>">
<?php echo $meansofimplement_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$meansofimplement->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($meansofimplement_list->Recordset)
	$meansofimplement_list->Recordset->Close();
?>
<?php if (!$meansofimplement_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$meansofimplement_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $meansofimplement_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $meansofimplement_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($meansofimplement_list->TotalRecords == 0 && !$meansofimplement->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $meansofimplement_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$meansofimplement_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$meansofimplement_list->isExport()) { ?>
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
$meansofimplement_list->terminate();
?>