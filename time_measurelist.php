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
$time_measure_list = new time_measure_list();

// Run the page
$time_measure_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$time_measure_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$time_measure_list->isExport()) { ?>
<script>
var ftime_measurelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftime_measurelist = currentForm = new ew.Form("ftime_measurelist", "list");
	ftime_measurelist.formKeyCountName = '<?php echo $time_measure_list->FormKeyCountName ?>';

	// Validate form
	ftime_measurelist.validate = function() {
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
			<?php if ($time_measure_list->Unit_of_measure->Required) { ?>
				elm = this.getElements("x" + infix + "_Unit_of_measure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $time_measure_list->Unit_of_measure->caption(), $time_measure_list->Unit_of_measure->RequiredErrorMessage)) ?>");
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
	ftime_measurelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Unit_of_measure", false)) return false;
		return true;
	}

	// Form_CustomValidate
	ftime_measurelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftime_measurelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftime_measurelist");
});
var ftime_measurelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftime_measurelistsrch = currentSearchForm = new ew.Form("ftime_measurelistsrch");

	// Dynamic selection lists
	// Filters

	ftime_measurelistsrch.filterList = <?php echo $time_measure_list->getFilterList() ?>;

	// Init search panel as collapsed
	ftime_measurelistsrch.initSearchPanel = true;
	loadjs.done("ftime_measurelistsrch");
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
<?php if (!$time_measure_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($time_measure_list->TotalRecords > 0 && $time_measure_list->ExportOptions->visible()) { ?>
<?php $time_measure_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($time_measure_list->ImportOptions->visible()) { ?>
<?php $time_measure_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($time_measure_list->SearchOptions->visible()) { ?>
<?php $time_measure_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($time_measure_list->FilterOptions->visible()) { ?>
<?php $time_measure_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$time_measure_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$time_measure_list->isExport() && !$time_measure->CurrentAction) { ?>
<form name="ftime_measurelistsrch" id="ftime_measurelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftime_measurelistsrch-search-panel" class="<?php echo $time_measure_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="time_measure">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $time_measure_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($time_measure_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($time_measure_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $time_measure_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($time_measure_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($time_measure_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($time_measure_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($time_measure_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $time_measure_list->showPageHeader(); ?>
<?php
$time_measure_list->showMessage();
?>
<?php if ($time_measure_list->TotalRecords > 0 || $time_measure->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($time_measure_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> time_measure">
<?php if (!$time_measure_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$time_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $time_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $time_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftime_measurelist" id="ftime_measurelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="time_measure">
<div id="gmp_time_measure" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($time_measure_list->TotalRecords > 0 || $time_measure_list->isGridEdit()) { ?>
<table id="tbl_time_measurelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$time_measure->RowType = ROWTYPE_HEADER;

// Render list options
$time_measure_list->renderListOptions();

// Render list options (header, left)
$time_measure_list->ListOptions->render("header", "left");
?>
<?php if ($time_measure_list->Unit_of_measure->Visible) { // Unit_of_measure ?>
	<?php if ($time_measure_list->SortUrl($time_measure_list->Unit_of_measure) == "") { ?>
		<th data-name="Unit_of_measure" class="<?php echo $time_measure_list->Unit_of_measure->headerCellClass() ?>"><div id="elh_time_measure_Unit_of_measure" class="time_measure_Unit_of_measure"><div class="ew-table-header-caption"><?php echo $time_measure_list->Unit_of_measure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Unit_of_measure" class="<?php echo $time_measure_list->Unit_of_measure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $time_measure_list->SortUrl($time_measure_list->Unit_of_measure) ?>', 1);"><div id="elh_time_measure_Unit_of_measure" class="time_measure_Unit_of_measure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $time_measure_list->Unit_of_measure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($time_measure_list->Unit_of_measure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($time_measure_list->Unit_of_measure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$time_measure_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($time_measure_list->ExportAll && $time_measure_list->isExport()) {
	$time_measure_list->StopRecord = $time_measure_list->TotalRecords;
} else {

	// Set the last record to display
	if ($time_measure_list->TotalRecords > $time_measure_list->StartRecord + $time_measure_list->DisplayRecords - 1)
		$time_measure_list->StopRecord = $time_measure_list->StartRecord + $time_measure_list->DisplayRecords - 1;
	else
		$time_measure_list->StopRecord = $time_measure_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($time_measure->isConfirm() || $time_measure_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($time_measure_list->FormKeyCountName) && ($time_measure_list->isGridAdd() || $time_measure_list->isGridEdit() || $time_measure->isConfirm())) {
		$time_measure_list->KeyCount = $CurrentForm->getValue($time_measure_list->FormKeyCountName);
		$time_measure_list->StopRecord = $time_measure_list->StartRecord + $time_measure_list->KeyCount - 1;
	}
}
$time_measure_list->RecordCount = $time_measure_list->StartRecord - 1;
if ($time_measure_list->Recordset && !$time_measure_list->Recordset->EOF) {
	$time_measure_list->Recordset->moveFirst();
	$selectLimit = $time_measure_list->UseSelectLimit;
	if (!$selectLimit && $time_measure_list->StartRecord > 1)
		$time_measure_list->Recordset->move($time_measure_list->StartRecord - 1);
} elseif (!$time_measure->AllowAddDeleteRow && $time_measure_list->StopRecord == 0) {
	$time_measure_list->StopRecord = $time_measure->GridAddRowCount;
}

// Initialize aggregate
$time_measure->RowType = ROWTYPE_AGGREGATEINIT;
$time_measure->resetAttributes();
$time_measure_list->renderRow();
if ($time_measure_list->isGridAdd())
	$time_measure_list->RowIndex = 0;
while ($time_measure_list->RecordCount < $time_measure_list->StopRecord) {
	$time_measure_list->RecordCount++;
	if ($time_measure_list->RecordCount >= $time_measure_list->StartRecord) {
		$time_measure_list->RowCount++;
		if ($time_measure_list->isGridAdd() || $time_measure_list->isGridEdit() || $time_measure->isConfirm()) {
			$time_measure_list->RowIndex++;
			$CurrentForm->Index = $time_measure_list->RowIndex;
			if ($CurrentForm->hasValue($time_measure_list->FormActionName) && ($time_measure->isConfirm() || $time_measure_list->EventCancelled))
				$time_measure_list->RowAction = strval($CurrentForm->getValue($time_measure_list->FormActionName));
			elseif ($time_measure_list->isGridAdd())
				$time_measure_list->RowAction = "insert";
			else
				$time_measure_list->RowAction = "";
		}

		// Set up key count
		$time_measure_list->KeyCount = $time_measure_list->RowIndex;

		// Init row class and style
		$time_measure->resetAttributes();
		$time_measure->CssClass = "";
		if ($time_measure_list->isGridAdd()) {
			$time_measure_list->loadRowValues(); // Load default values
		} else {
			$time_measure_list->loadRowValues($time_measure_list->Recordset); // Load row values
		}
		$time_measure->RowType = ROWTYPE_VIEW; // Render view
		if ($time_measure_list->isGridAdd()) // Grid add
			$time_measure->RowType = ROWTYPE_ADD; // Render add
		if ($time_measure_list->isGridAdd() && $time_measure->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$time_measure_list->restoreCurrentRowFormValues($time_measure_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$time_measure->RowAttrs->merge(["data-rowindex" => $time_measure_list->RowCount, "id" => "r" . $time_measure_list->RowCount . "_time_measure", "data-rowtype" => $time_measure->RowType]);

		// Render row
		$time_measure_list->renderRow();

		// Render list options
		$time_measure_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($time_measure_list->RowAction != "delete" && $time_measure_list->RowAction != "insertdelete" && !($time_measure_list->RowAction == "insert" && $time_measure->isConfirm() && $time_measure_list->emptyRow())) {
?>
	<tr <?php echo $time_measure->rowAttributes() ?>>
<?php

// Render list options (body, left)
$time_measure_list->ListOptions->render("body", "left", $time_measure_list->RowCount);
?>
	<?php if ($time_measure_list->Unit_of_measure->Visible) { // Unit_of_measure ?>
		<td data-name="Unit_of_measure" <?php echo $time_measure_list->Unit_of_measure->cellAttributes() ?>>
<?php if ($time_measure->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $time_measure_list->RowCount ?>_time_measure_Unit_of_measure" class="form-group">
<input type="text" data-table="time_measure" data-field="x_Unit_of_measure" name="x<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" id="x<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($time_measure_list->Unit_of_measure->getPlaceHolder()) ?>" value="<?php echo $time_measure_list->Unit_of_measure->EditValue ?>"<?php echo $time_measure_list->Unit_of_measure->editAttributes() ?>>
</span>
<input type="hidden" data-table="time_measure" data-field="x_Unit_of_measure" name="o<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" id="o<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" value="<?php echo HtmlEncode($time_measure_list->Unit_of_measure->OldValue) ?>">
<?php } ?>
<?php if ($time_measure->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $time_measure_list->RowCount ?>_time_measure_Unit_of_measure">
<span<?php echo $time_measure_list->Unit_of_measure->viewAttributes() ?>><?php echo $time_measure_list->Unit_of_measure->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$time_measure_list->ListOptions->render("body", "right", $time_measure_list->RowCount);
?>
	</tr>
<?php if ($time_measure->RowType == ROWTYPE_ADD || $time_measure->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ftime_measurelist", "load"], function() {
	ftime_measurelist.updateLists(<?php echo $time_measure_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$time_measure_list->isGridAdd())
		if (!$time_measure_list->Recordset->EOF)
			$time_measure_list->Recordset->moveNext();
}
?>
<?php
	if ($time_measure_list->isGridAdd() || $time_measure_list->isGridEdit()) {
		$time_measure_list->RowIndex = '$rowindex$';
		$time_measure_list->loadRowValues();

		// Set row properties
		$time_measure->resetAttributes();
		$time_measure->RowAttrs->merge(["data-rowindex" => $time_measure_list->RowIndex, "id" => "r0_time_measure", "data-rowtype" => ROWTYPE_ADD]);
		$time_measure->RowAttrs->appendClass("ew-template");
		$time_measure->RowType = ROWTYPE_ADD;

		// Render row
		$time_measure_list->renderRow();

		// Render list options
		$time_measure_list->renderListOptions();
		$time_measure_list->StartRowCount = 0;
?>
	<tr <?php echo $time_measure->rowAttributes() ?>>
<?php

// Render list options (body, left)
$time_measure_list->ListOptions->render("body", "left", $time_measure_list->RowIndex);
?>
	<?php if ($time_measure_list->Unit_of_measure->Visible) { // Unit_of_measure ?>
		<td data-name="Unit_of_measure">
<span id="el$rowindex$_time_measure_Unit_of_measure" class="form-group time_measure_Unit_of_measure">
<input type="text" data-table="time_measure" data-field="x_Unit_of_measure" name="x<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" id="x<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($time_measure_list->Unit_of_measure->getPlaceHolder()) ?>" value="<?php echo $time_measure_list->Unit_of_measure->EditValue ?>"<?php echo $time_measure_list->Unit_of_measure->editAttributes() ?>>
</span>
<input type="hidden" data-table="time_measure" data-field="x_Unit_of_measure" name="o<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" id="o<?php echo $time_measure_list->RowIndex ?>_Unit_of_measure" value="<?php echo HtmlEncode($time_measure_list->Unit_of_measure->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$time_measure_list->ListOptions->render("body", "right", $time_measure_list->RowIndex);
?>
<script>
loadjs.ready(["ftime_measurelist", "load"], function() {
	ftime_measurelist.updateLists(<?php echo $time_measure_list->RowIndex ?>);
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
<?php if ($time_measure_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $time_measure_list->FormKeyCountName ?>" id="<?php echo $time_measure_list->FormKeyCountName ?>" value="<?php echo $time_measure_list->KeyCount ?>">
<?php echo $time_measure_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$time_measure->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($time_measure_list->Recordset)
	$time_measure_list->Recordset->Close();
?>
<?php if (!$time_measure_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$time_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $time_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $time_measure_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($time_measure_list->TotalRecords == 0 && !$time_measure->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $time_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$time_measure_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$time_measure_list->isExport()) { ?>
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
$time_measure_list->terminate();
?>