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
$division_list = new division_list();

// Run the page
$division_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$division_list->isExport()) { ?>
<script>
var fdivisionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdivisionlist = currentForm = new ew.Form("fdivisionlist", "list");
	fdivisionlist.formKeyCountName = '<?php echo $division_list->FormKeyCountName ?>';

	// Validate form
	fdivisionlist.validate = function() {
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
			<?php if ($division_list->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_list->Division->caption(), $division_list->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($division_list->Division->errorMessage()) ?>");
			<?php if ($division_list->DivisionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DivisionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_list->DivisionName->caption(), $division_list->DivisionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($division_list->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_list->Comments->caption(), $division_list->Comments->RequiredErrorMessage)) ?>");
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
	fdivisionlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Division", false)) return false;
		if (ew.valueChanged(fobj, infix, "DivisionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Comments", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdivisionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdivisionlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdivisionlist");
});
var fdivisionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdivisionlistsrch = currentSearchForm = new ew.Form("fdivisionlistsrch");

	// Dynamic selection lists
	// Filters

	fdivisionlistsrch.filterList = <?php echo $division_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdivisionlistsrch.initSearchPanel = true;
	loadjs.done("fdivisionlistsrch");
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
<?php if (!$division_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($division_list->TotalRecords > 0 && $division_list->ExportOptions->visible()) { ?>
<?php $division_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($division_list->ImportOptions->visible()) { ?>
<?php $division_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($division_list->SearchOptions->visible()) { ?>
<?php $division_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($division_list->FilterOptions->visible()) { ?>
<?php $division_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$division_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$division_list->isExport() && !$division->CurrentAction) { ?>
<form name="fdivisionlistsrch" id="fdivisionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdivisionlistsrch-search-panel" class="<?php echo $division_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="division">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $division_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($division_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($division_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $division_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($division_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $division_list->showPageHeader(); ?>
<?php
$division_list->showMessage();
?>
<?php if ($division_list->TotalRecords > 0 || $division->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($division_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> division">
<?php if (!$division_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$division_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $division_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $division_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdivisionlist" id="fdivisionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<div id="gmp_division" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($division_list->TotalRecords > 0 || $division_list->isGridEdit()) { ?>
<table id="tbl_divisionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$division->RowType = ROWTYPE_HEADER;

// Render list options
$division_list->renderListOptions();

// Render list options (header, left)
$division_list->ListOptions->render("header", "left");
?>
<?php if ($division_list->Division->Visible) { // Division ?>
	<?php if ($division_list->SortUrl($division_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $division_list->Division->headerCellClass() ?>"><div id="elh_division_Division" class="division_Division"><div class="ew-table-header-caption"><?php echo $division_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $division_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $division_list->SortUrl($division_list->Division) ?>', 1);"><div id="elh_division_Division" class="division_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $division_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($division_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($division_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($division_list->DivisionName->Visible) { // DivisionName ?>
	<?php if ($division_list->SortUrl($division_list->DivisionName) == "") { ?>
		<th data-name="DivisionName" class="<?php echo $division_list->DivisionName->headerCellClass() ?>"><div id="elh_division_DivisionName" class="division_DivisionName"><div class="ew-table-header-caption"><?php echo $division_list->DivisionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DivisionName" class="<?php echo $division_list->DivisionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $division_list->SortUrl($division_list->DivisionName) ?>', 1);"><div id="elh_division_DivisionName" class="division_DivisionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $division_list->DivisionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($division_list->DivisionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($division_list->DivisionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($division_list->Comments->Visible) { // Comments ?>
	<?php if ($division_list->SortUrl($division_list->Comments) == "") { ?>
		<th data-name="Comments" class="<?php echo $division_list->Comments->headerCellClass() ?>"><div id="elh_division_Comments" class="division_Comments"><div class="ew-table-header-caption"><?php echo $division_list->Comments->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comments" class="<?php echo $division_list->Comments->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $division_list->SortUrl($division_list->Comments) ?>', 1);"><div id="elh_division_Comments" class="division_Comments">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $division_list->Comments->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($division_list->Comments->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($division_list->Comments->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$division_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($division_list->ExportAll && $division_list->isExport()) {
	$division_list->StopRecord = $division_list->TotalRecords;
} else {

	// Set the last record to display
	if ($division_list->TotalRecords > $division_list->StartRecord + $division_list->DisplayRecords - 1)
		$division_list->StopRecord = $division_list->StartRecord + $division_list->DisplayRecords - 1;
	else
		$division_list->StopRecord = $division_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($division->isConfirm() || $division_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($division_list->FormKeyCountName) && ($division_list->isGridAdd() || $division_list->isGridEdit() || $division->isConfirm())) {
		$division_list->KeyCount = $CurrentForm->getValue($division_list->FormKeyCountName);
		$division_list->StopRecord = $division_list->StartRecord + $division_list->KeyCount - 1;
	}
}
$division_list->RecordCount = $division_list->StartRecord - 1;
if ($division_list->Recordset && !$division_list->Recordset->EOF) {
	$division_list->Recordset->moveFirst();
	$selectLimit = $division_list->UseSelectLimit;
	if (!$selectLimit && $division_list->StartRecord > 1)
		$division_list->Recordset->move($division_list->StartRecord - 1);
} elseif (!$division->AllowAddDeleteRow && $division_list->StopRecord == 0) {
	$division_list->StopRecord = $division->GridAddRowCount;
}

// Initialize aggregate
$division->RowType = ROWTYPE_AGGREGATEINIT;
$division->resetAttributes();
$division_list->renderRow();
if ($division_list->isGridAdd())
	$division_list->RowIndex = 0;
if ($division_list->isGridEdit())
	$division_list->RowIndex = 0;
while ($division_list->RecordCount < $division_list->StopRecord) {
	$division_list->RecordCount++;
	if ($division_list->RecordCount >= $division_list->StartRecord) {
		$division_list->RowCount++;
		if ($division_list->isGridAdd() || $division_list->isGridEdit() || $division->isConfirm()) {
			$division_list->RowIndex++;
			$CurrentForm->Index = $division_list->RowIndex;
			if ($CurrentForm->hasValue($division_list->FormActionName) && ($division->isConfirm() || $division_list->EventCancelled))
				$division_list->RowAction = strval($CurrentForm->getValue($division_list->FormActionName));
			elseif ($division_list->isGridAdd())
				$division_list->RowAction = "insert";
			else
				$division_list->RowAction = "";
		}

		// Set up key count
		$division_list->KeyCount = $division_list->RowIndex;

		// Init row class and style
		$division->resetAttributes();
		$division->CssClass = "";
		if ($division_list->isGridAdd()) {
			$division_list->loadRowValues(); // Load default values
		} else {
			$division_list->loadRowValues($division_list->Recordset); // Load row values
		}
		$division->RowType = ROWTYPE_VIEW; // Render view
		if ($division_list->isGridAdd()) // Grid add
			$division->RowType = ROWTYPE_ADD; // Render add
		if ($division_list->isGridAdd() && $division->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$division_list->restoreCurrentRowFormValues($division_list->RowIndex); // Restore form values
		if ($division_list->isGridEdit()) { // Grid edit
			if ($division->EventCancelled)
				$division_list->restoreCurrentRowFormValues($division_list->RowIndex); // Restore form values
			if ($division_list->RowAction == "insert")
				$division->RowType = ROWTYPE_ADD; // Render add
			else
				$division->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($division_list->isGridEdit() && ($division->RowType == ROWTYPE_EDIT || $division->RowType == ROWTYPE_ADD) && $division->EventCancelled) // Update failed
			$division_list->restoreCurrentRowFormValues($division_list->RowIndex); // Restore form values
		if ($division->RowType == ROWTYPE_EDIT) // Edit row
			$division_list->EditRowCount++;

		// Set up row id / data-rowindex
		$division->RowAttrs->merge(["data-rowindex" => $division_list->RowCount, "id" => "r" . $division_list->RowCount . "_division", "data-rowtype" => $division->RowType]);

		// Render row
		$division_list->renderRow();

		// Render list options
		$division_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($division_list->RowAction != "delete" && $division_list->RowAction != "insertdelete" && !($division_list->RowAction == "insert" && $division->isConfirm() && $division_list->emptyRow())) {
?>
	<tr <?php echo $division->rowAttributes() ?>>
<?php

// Render list options (body, left)
$division_list->ListOptions->render("body", "left", $division_list->RowCount);
?>
	<?php if ($division_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $division_list->Division->cellAttributes() ?>>
<?php if ($division->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_Division" class="form-group">
<input type="text" data-table="division" data-field="x_Division" name="x<?php echo $division_list->RowIndex ?>_Division" id="x<?php echo $division_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($division_list->Division->getPlaceHolder()) ?>" value="<?php echo $division_list->Division->EditValue ?>"<?php echo $division_list->Division->editAttributes() ?>>
</span>
<input type="hidden" data-table="division" data-field="x_Division" name="o<?php echo $division_list->RowIndex ?>_Division" id="o<?php echo $division_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($division_list->Division->OldValue) ?>">
<?php } ?>
<?php if ($division->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="division" data-field="x_Division" name="x<?php echo $division_list->RowIndex ?>_Division" id="x<?php echo $division_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($division_list->Division->getPlaceHolder()) ?>" value="<?php echo $division_list->Division->EditValue ?>"<?php echo $division_list->Division->editAttributes() ?>>
<input type="hidden" data-table="division" data-field="x_Division" name="o<?php echo $division_list->RowIndex ?>_Division" id="o<?php echo $division_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($division_list->Division->OldValue != null ? $division_list->Division->OldValue : $division_list->Division->CurrentValue) ?>">
<?php } ?>
<?php if ($division->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_Division">
<span<?php echo $division_list->Division->viewAttributes() ?>><?php echo $division_list->Division->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($division_list->DivisionName->Visible) { // DivisionName ?>
		<td data-name="DivisionName" <?php echo $division_list->DivisionName->cellAttributes() ?>>
<?php if ($division->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_DivisionName" class="form-group">
<input type="text" data-table="division" data-field="x_DivisionName" name="x<?php echo $division_list->RowIndex ?>_DivisionName" id="x<?php echo $division_list->RowIndex ?>_DivisionName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($division_list->DivisionName->getPlaceHolder()) ?>" value="<?php echo $division_list->DivisionName->EditValue ?>"<?php echo $division_list->DivisionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="division" data-field="x_DivisionName" name="o<?php echo $division_list->RowIndex ?>_DivisionName" id="o<?php echo $division_list->RowIndex ?>_DivisionName" value="<?php echo HtmlEncode($division_list->DivisionName->OldValue) ?>">
<?php } ?>
<?php if ($division->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_DivisionName" class="form-group">
<input type="text" data-table="division" data-field="x_DivisionName" name="x<?php echo $division_list->RowIndex ?>_DivisionName" id="x<?php echo $division_list->RowIndex ?>_DivisionName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($division_list->DivisionName->getPlaceHolder()) ?>" value="<?php echo $division_list->DivisionName->EditValue ?>"<?php echo $division_list->DivisionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($division->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_DivisionName">
<span<?php echo $division_list->DivisionName->viewAttributes() ?>><?php echo $division_list->DivisionName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($division_list->Comments->Visible) { // Comments ?>
		<td data-name="Comments" <?php echo $division_list->Comments->cellAttributes() ?>>
<?php if ($division->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_Comments" class="form-group">
<textarea data-table="division" data-field="x_Comments" name="x<?php echo $division_list->RowIndex ?>_Comments" id="x<?php echo $division_list->RowIndex ?>_Comments" cols="100" rows="2" placeholder="<?php echo HtmlEncode($division_list->Comments->getPlaceHolder()) ?>"<?php echo $division_list->Comments->editAttributes() ?>><?php echo $division_list->Comments->EditValue ?></textarea>
</span>
<input type="hidden" data-table="division" data-field="x_Comments" name="o<?php echo $division_list->RowIndex ?>_Comments" id="o<?php echo $division_list->RowIndex ?>_Comments" value="<?php echo HtmlEncode($division_list->Comments->OldValue) ?>">
<?php } ?>
<?php if ($division->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_Comments" class="form-group">
<textarea data-table="division" data-field="x_Comments" name="x<?php echo $division_list->RowIndex ?>_Comments" id="x<?php echo $division_list->RowIndex ?>_Comments" cols="100" rows="2" placeholder="<?php echo HtmlEncode($division_list->Comments->getPlaceHolder()) ?>"<?php echo $division_list->Comments->editAttributes() ?>><?php echo $division_list->Comments->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($division->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $division_list->RowCount ?>_division_Comments">
<span<?php echo $division_list->Comments->viewAttributes() ?>><?php echo $division_list->Comments->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$division_list->ListOptions->render("body", "right", $division_list->RowCount);
?>
	</tr>
<?php if ($division->RowType == ROWTYPE_ADD || $division->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdivisionlist", "load"], function() {
	fdivisionlist.updateLists(<?php echo $division_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$division_list->isGridAdd())
		if (!$division_list->Recordset->EOF)
			$division_list->Recordset->moveNext();
}
?>
<?php
	if ($division_list->isGridAdd() || $division_list->isGridEdit()) {
		$division_list->RowIndex = '$rowindex$';
		$division_list->loadRowValues();

		// Set row properties
		$division->resetAttributes();
		$division->RowAttrs->merge(["data-rowindex" => $division_list->RowIndex, "id" => "r0_division", "data-rowtype" => ROWTYPE_ADD]);
		$division->RowAttrs->appendClass("ew-template");
		$division->RowType = ROWTYPE_ADD;

		// Render row
		$division_list->renderRow();

		// Render list options
		$division_list->renderListOptions();
		$division_list->StartRowCount = 0;
?>
	<tr <?php echo $division->rowAttributes() ?>>
<?php

// Render list options (body, left)
$division_list->ListOptions->render("body", "left", $division_list->RowIndex);
?>
	<?php if ($division_list->Division->Visible) { // Division ?>
		<td data-name="Division">
<span id="el$rowindex$_division_Division" class="form-group division_Division">
<input type="text" data-table="division" data-field="x_Division" name="x<?php echo $division_list->RowIndex ?>_Division" id="x<?php echo $division_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($division_list->Division->getPlaceHolder()) ?>" value="<?php echo $division_list->Division->EditValue ?>"<?php echo $division_list->Division->editAttributes() ?>>
</span>
<input type="hidden" data-table="division" data-field="x_Division" name="o<?php echo $division_list->RowIndex ?>_Division" id="o<?php echo $division_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($division_list->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($division_list->DivisionName->Visible) { // DivisionName ?>
		<td data-name="DivisionName">
<span id="el$rowindex$_division_DivisionName" class="form-group division_DivisionName">
<input type="text" data-table="division" data-field="x_DivisionName" name="x<?php echo $division_list->RowIndex ?>_DivisionName" id="x<?php echo $division_list->RowIndex ?>_DivisionName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($division_list->DivisionName->getPlaceHolder()) ?>" value="<?php echo $division_list->DivisionName->EditValue ?>"<?php echo $division_list->DivisionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="division" data-field="x_DivisionName" name="o<?php echo $division_list->RowIndex ?>_DivisionName" id="o<?php echo $division_list->RowIndex ?>_DivisionName" value="<?php echo HtmlEncode($division_list->DivisionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($division_list->Comments->Visible) { // Comments ?>
		<td data-name="Comments">
<span id="el$rowindex$_division_Comments" class="form-group division_Comments">
<textarea data-table="division" data-field="x_Comments" name="x<?php echo $division_list->RowIndex ?>_Comments" id="x<?php echo $division_list->RowIndex ?>_Comments" cols="100" rows="2" placeholder="<?php echo HtmlEncode($division_list->Comments->getPlaceHolder()) ?>"<?php echo $division_list->Comments->editAttributes() ?>><?php echo $division_list->Comments->EditValue ?></textarea>
</span>
<input type="hidden" data-table="division" data-field="x_Comments" name="o<?php echo $division_list->RowIndex ?>_Comments" id="o<?php echo $division_list->RowIndex ?>_Comments" value="<?php echo HtmlEncode($division_list->Comments->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$division_list->ListOptions->render("body", "right", $division_list->RowIndex);
?>
<script>
loadjs.ready(["fdivisionlist", "load"], function() {
	fdivisionlist.updateLists(<?php echo $division_list->RowIndex ?>);
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
<?php if ($division_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $division_list->FormKeyCountName ?>" id="<?php echo $division_list->FormKeyCountName ?>" value="<?php echo $division_list->KeyCount ?>">
<?php echo $division_list->MultiSelectKey ?>
<?php } ?>
<?php if ($division_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $division_list->FormKeyCountName ?>" id="<?php echo $division_list->FormKeyCountName ?>" value="<?php echo $division_list->KeyCount ?>">
<?php echo $division_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$division->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($division_list->Recordset)
	$division_list->Recordset->Close();
?>
<?php if (!$division_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$division_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $division_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $division_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($division_list->TotalRecords == 0 && !$division->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $division_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$division_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$division_list->isExport()) { ?>
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
$division_list->terminate();
?>