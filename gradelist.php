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
$grade_list = new grade_list();

// Run the page
$grade_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grade_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$grade_list->isExport()) { ?>
<script>
var fgradelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgradelist = currentForm = new ew.Form("fgradelist", "list");
	fgradelist.formKeyCountName = '<?php echo $grade_list->FormKeyCountName ?>';

	// Validate form
	fgradelist.validate = function() {
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
			<?php if ($grade_list->Grade->Required) { ?>
				elm = this.getElements("x" + infix + "_Grade");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $grade_list->Grade->caption(), $grade_list->Grade->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Grade");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($grade_list->Grade->errorMessage()) ?>");
			<?php if ($grade_list->GradeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $grade_list->GradeDesc->caption(), $grade_list->GradeDesc->RequiredErrorMessage)) ?>");
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
	fgradelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Grade", false)) return false;
		if (ew.valueChanged(fobj, infix, "GradeDesc", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fgradelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgradelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgradelist");
});
var fgradelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgradelistsrch = currentSearchForm = new ew.Form("fgradelistsrch");

	// Dynamic selection lists
	// Filters

	fgradelistsrch.filterList = <?php echo $grade_list->getFilterList() ?>;

	// Init search panel as collapsed
	fgradelistsrch.initSearchPanel = true;
	loadjs.done("fgradelistsrch");
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
<?php if (!$grade_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($grade_list->TotalRecords > 0 && $grade_list->ExportOptions->visible()) { ?>
<?php $grade_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($grade_list->ImportOptions->visible()) { ?>
<?php $grade_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($grade_list->SearchOptions->visible()) { ?>
<?php $grade_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($grade_list->FilterOptions->visible()) { ?>
<?php $grade_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$grade_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$grade_list->isExport() && !$grade->CurrentAction) { ?>
<form name="fgradelistsrch" id="fgradelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgradelistsrch-search-panel" class="<?php echo $grade_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="grade">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $grade_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($grade_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($grade_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $grade_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($grade_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($grade_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($grade_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($grade_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $grade_list->showPageHeader(); ?>
<?php
$grade_list->showMessage();
?>
<?php if ($grade_list->TotalRecords > 0 || $grade->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($grade_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> grade">
<?php if (!$grade_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$grade_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grade_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $grade_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgradelist" id="fgradelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grade">
<div id="gmp_grade" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($grade_list->TotalRecords > 0 || $grade_list->isGridEdit()) { ?>
<table id="tbl_gradelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$grade->RowType = ROWTYPE_HEADER;

// Render list options
$grade_list->renderListOptions();

// Render list options (header, left)
$grade_list->ListOptions->render("header", "left");
?>
<?php if ($grade_list->Grade->Visible) { // Grade ?>
	<?php if ($grade_list->SortUrl($grade_list->Grade) == "") { ?>
		<th data-name="Grade" class="<?php echo $grade_list->Grade->headerCellClass() ?>"><div id="elh_grade_Grade" class="grade_Grade"><div class="ew-table-header-caption"><?php echo $grade_list->Grade->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Grade" class="<?php echo $grade_list->Grade->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grade_list->SortUrl($grade_list->Grade) ?>', 1);"><div id="elh_grade_Grade" class="grade_Grade">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grade_list->Grade->caption() ?></span><span class="ew-table-header-sort"><?php if ($grade_list->Grade->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grade_list->Grade->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($grade_list->GradeDesc->Visible) { // GradeDesc ?>
	<?php if ($grade_list->SortUrl($grade_list->GradeDesc) == "") { ?>
		<th data-name="GradeDesc" class="<?php echo $grade_list->GradeDesc->headerCellClass() ?>"><div id="elh_grade_GradeDesc" class="grade_GradeDesc"><div class="ew-table-header-caption"><?php echo $grade_list->GradeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GradeDesc" class="<?php echo $grade_list->GradeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grade_list->SortUrl($grade_list->GradeDesc) ?>', 1);"><div id="elh_grade_GradeDesc" class="grade_GradeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grade_list->GradeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($grade_list->GradeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grade_list->GradeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$grade_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($grade_list->ExportAll && $grade_list->isExport()) {
	$grade_list->StopRecord = $grade_list->TotalRecords;
} else {

	// Set the last record to display
	if ($grade_list->TotalRecords > $grade_list->StartRecord + $grade_list->DisplayRecords - 1)
		$grade_list->StopRecord = $grade_list->StartRecord + $grade_list->DisplayRecords - 1;
	else
		$grade_list->StopRecord = $grade_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($grade->isConfirm() || $grade_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($grade_list->FormKeyCountName) && ($grade_list->isGridAdd() || $grade_list->isGridEdit() || $grade->isConfirm())) {
		$grade_list->KeyCount = $CurrentForm->getValue($grade_list->FormKeyCountName);
		$grade_list->StopRecord = $grade_list->StartRecord + $grade_list->KeyCount - 1;
	}
}
$grade_list->RecordCount = $grade_list->StartRecord - 1;
if ($grade_list->Recordset && !$grade_list->Recordset->EOF) {
	$grade_list->Recordset->moveFirst();
	$selectLimit = $grade_list->UseSelectLimit;
	if (!$selectLimit && $grade_list->StartRecord > 1)
		$grade_list->Recordset->move($grade_list->StartRecord - 1);
} elseif (!$grade->AllowAddDeleteRow && $grade_list->StopRecord == 0) {
	$grade_list->StopRecord = $grade->GridAddRowCount;
}

// Initialize aggregate
$grade->RowType = ROWTYPE_AGGREGATEINIT;
$grade->resetAttributes();
$grade_list->renderRow();
if ($grade_list->isGridAdd())
	$grade_list->RowIndex = 0;
if ($grade_list->isGridEdit())
	$grade_list->RowIndex = 0;
while ($grade_list->RecordCount < $grade_list->StopRecord) {
	$grade_list->RecordCount++;
	if ($grade_list->RecordCount >= $grade_list->StartRecord) {
		$grade_list->RowCount++;
		if ($grade_list->isGridAdd() || $grade_list->isGridEdit() || $grade->isConfirm()) {
			$grade_list->RowIndex++;
			$CurrentForm->Index = $grade_list->RowIndex;
			if ($CurrentForm->hasValue($grade_list->FormActionName) && ($grade->isConfirm() || $grade_list->EventCancelled))
				$grade_list->RowAction = strval($CurrentForm->getValue($grade_list->FormActionName));
			elseif ($grade_list->isGridAdd())
				$grade_list->RowAction = "insert";
			else
				$grade_list->RowAction = "";
		}

		// Set up key count
		$grade_list->KeyCount = $grade_list->RowIndex;

		// Init row class and style
		$grade->resetAttributes();
		$grade->CssClass = "";
		if ($grade_list->isGridAdd()) {
			$grade_list->loadRowValues(); // Load default values
		} else {
			$grade_list->loadRowValues($grade_list->Recordset); // Load row values
		}
		$grade->RowType = ROWTYPE_VIEW; // Render view
		if ($grade_list->isGridAdd()) // Grid add
			$grade->RowType = ROWTYPE_ADD; // Render add
		if ($grade_list->isGridAdd() && $grade->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$grade_list->restoreCurrentRowFormValues($grade_list->RowIndex); // Restore form values
		if ($grade_list->isGridEdit()) { // Grid edit
			if ($grade->EventCancelled)
				$grade_list->restoreCurrentRowFormValues($grade_list->RowIndex); // Restore form values
			if ($grade_list->RowAction == "insert")
				$grade->RowType = ROWTYPE_ADD; // Render add
			else
				$grade->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($grade_list->isGridEdit() && ($grade->RowType == ROWTYPE_EDIT || $grade->RowType == ROWTYPE_ADD) && $grade->EventCancelled) // Update failed
			$grade_list->restoreCurrentRowFormValues($grade_list->RowIndex); // Restore form values
		if ($grade->RowType == ROWTYPE_EDIT) // Edit row
			$grade_list->EditRowCount++;

		// Set up row id / data-rowindex
		$grade->RowAttrs->merge(["data-rowindex" => $grade_list->RowCount, "id" => "r" . $grade_list->RowCount . "_grade", "data-rowtype" => $grade->RowType]);

		// Render row
		$grade_list->renderRow();

		// Render list options
		$grade_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($grade_list->RowAction != "delete" && $grade_list->RowAction != "insertdelete" && !($grade_list->RowAction == "insert" && $grade->isConfirm() && $grade_list->emptyRow())) {
?>
	<tr <?php echo $grade->rowAttributes() ?>>
<?php

// Render list options (body, left)
$grade_list->ListOptions->render("body", "left", $grade_list->RowCount);
?>
	<?php if ($grade_list->Grade->Visible) { // Grade ?>
		<td data-name="Grade" <?php echo $grade_list->Grade->cellAttributes() ?>>
<?php if ($grade->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $grade_list->RowCount ?>_grade_Grade" class="form-group">
<input type="text" data-table="grade" data-field="x_Grade" name="x<?php echo $grade_list->RowIndex ?>_Grade" id="x<?php echo $grade_list->RowIndex ?>_Grade" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($grade_list->Grade->getPlaceHolder()) ?>" value="<?php echo $grade_list->Grade->EditValue ?>"<?php echo $grade_list->Grade->editAttributes() ?>>
</span>
<input type="hidden" data-table="grade" data-field="x_Grade" name="o<?php echo $grade_list->RowIndex ?>_Grade" id="o<?php echo $grade_list->RowIndex ?>_Grade" value="<?php echo HtmlEncode($grade_list->Grade->OldValue) ?>">
<?php } ?>
<?php if ($grade->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="grade" data-field="x_Grade" name="x<?php echo $grade_list->RowIndex ?>_Grade" id="x<?php echo $grade_list->RowIndex ?>_Grade" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($grade_list->Grade->getPlaceHolder()) ?>" value="<?php echo $grade_list->Grade->EditValue ?>"<?php echo $grade_list->Grade->editAttributes() ?>>
<input type="hidden" data-table="grade" data-field="x_Grade" name="o<?php echo $grade_list->RowIndex ?>_Grade" id="o<?php echo $grade_list->RowIndex ?>_Grade" value="<?php echo HtmlEncode($grade_list->Grade->OldValue != null ? $grade_list->Grade->OldValue : $grade_list->Grade->CurrentValue) ?>">
<?php } ?>
<?php if ($grade->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $grade_list->RowCount ?>_grade_Grade">
<span<?php echo $grade_list->Grade->viewAttributes() ?>><?php echo $grade_list->Grade->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($grade_list->GradeDesc->Visible) { // GradeDesc ?>
		<td data-name="GradeDesc" <?php echo $grade_list->GradeDesc->cellAttributes() ?>>
<?php if ($grade->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $grade_list->RowCount ?>_grade_GradeDesc" class="form-group">
<input type="text" data-table="grade" data-field="x_GradeDesc" name="x<?php echo $grade_list->RowIndex ?>_GradeDesc" id="x<?php echo $grade_list->RowIndex ?>_GradeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($grade_list->GradeDesc->getPlaceHolder()) ?>" value="<?php echo $grade_list->GradeDesc->EditValue ?>"<?php echo $grade_list->GradeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="grade" data-field="x_GradeDesc" name="o<?php echo $grade_list->RowIndex ?>_GradeDesc" id="o<?php echo $grade_list->RowIndex ?>_GradeDesc" value="<?php echo HtmlEncode($grade_list->GradeDesc->OldValue) ?>">
<?php } ?>
<?php if ($grade->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $grade_list->RowCount ?>_grade_GradeDesc" class="form-group">
<input type="text" data-table="grade" data-field="x_GradeDesc" name="x<?php echo $grade_list->RowIndex ?>_GradeDesc" id="x<?php echo $grade_list->RowIndex ?>_GradeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($grade_list->GradeDesc->getPlaceHolder()) ?>" value="<?php echo $grade_list->GradeDesc->EditValue ?>"<?php echo $grade_list->GradeDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($grade->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $grade_list->RowCount ?>_grade_GradeDesc">
<span<?php echo $grade_list->GradeDesc->viewAttributes() ?>><?php echo $grade_list->GradeDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grade_list->ListOptions->render("body", "right", $grade_list->RowCount);
?>
	</tr>
<?php if ($grade->RowType == ROWTYPE_ADD || $grade->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgradelist", "load"], function() {
	fgradelist.updateLists(<?php echo $grade_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$grade_list->isGridAdd())
		if (!$grade_list->Recordset->EOF)
			$grade_list->Recordset->moveNext();
}
?>
<?php
	if ($grade_list->isGridAdd() || $grade_list->isGridEdit()) {
		$grade_list->RowIndex = '$rowindex$';
		$grade_list->loadRowValues();

		// Set row properties
		$grade->resetAttributes();
		$grade->RowAttrs->merge(["data-rowindex" => $grade_list->RowIndex, "id" => "r0_grade", "data-rowtype" => ROWTYPE_ADD]);
		$grade->RowAttrs->appendClass("ew-template");
		$grade->RowType = ROWTYPE_ADD;

		// Render row
		$grade_list->renderRow();

		// Render list options
		$grade_list->renderListOptions();
		$grade_list->StartRowCount = 0;
?>
	<tr <?php echo $grade->rowAttributes() ?>>
<?php

// Render list options (body, left)
$grade_list->ListOptions->render("body", "left", $grade_list->RowIndex);
?>
	<?php if ($grade_list->Grade->Visible) { // Grade ?>
		<td data-name="Grade">
<span id="el$rowindex$_grade_Grade" class="form-group grade_Grade">
<input type="text" data-table="grade" data-field="x_Grade" name="x<?php echo $grade_list->RowIndex ?>_Grade" id="x<?php echo $grade_list->RowIndex ?>_Grade" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($grade_list->Grade->getPlaceHolder()) ?>" value="<?php echo $grade_list->Grade->EditValue ?>"<?php echo $grade_list->Grade->editAttributes() ?>>
</span>
<input type="hidden" data-table="grade" data-field="x_Grade" name="o<?php echo $grade_list->RowIndex ?>_Grade" id="o<?php echo $grade_list->RowIndex ?>_Grade" value="<?php echo HtmlEncode($grade_list->Grade->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($grade_list->GradeDesc->Visible) { // GradeDesc ?>
		<td data-name="GradeDesc">
<span id="el$rowindex$_grade_GradeDesc" class="form-group grade_GradeDesc">
<input type="text" data-table="grade" data-field="x_GradeDesc" name="x<?php echo $grade_list->RowIndex ?>_GradeDesc" id="x<?php echo $grade_list->RowIndex ?>_GradeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($grade_list->GradeDesc->getPlaceHolder()) ?>" value="<?php echo $grade_list->GradeDesc->EditValue ?>"<?php echo $grade_list->GradeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="grade" data-field="x_GradeDesc" name="o<?php echo $grade_list->RowIndex ?>_GradeDesc" id="o<?php echo $grade_list->RowIndex ?>_GradeDesc" value="<?php echo HtmlEncode($grade_list->GradeDesc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grade_list->ListOptions->render("body", "right", $grade_list->RowIndex);
?>
<script>
loadjs.ready(["fgradelist", "load"], function() {
	fgradelist.updateLists(<?php echo $grade_list->RowIndex ?>);
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
<?php if ($grade_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $grade_list->FormKeyCountName ?>" id="<?php echo $grade_list->FormKeyCountName ?>" value="<?php echo $grade_list->KeyCount ?>">
<?php echo $grade_list->MultiSelectKey ?>
<?php } ?>
<?php if ($grade_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $grade_list->FormKeyCountName ?>" id="<?php echo $grade_list->FormKeyCountName ?>" value="<?php echo $grade_list->KeyCount ?>">
<?php echo $grade_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$grade->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($grade_list->Recordset)
	$grade_list->Recordset->Close();
?>
<?php if (!$grade_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$grade_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grade_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $grade_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($grade_list->TotalRecords == 0 && !$grade->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $grade_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$grade_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$grade_list->isExport()) { ?>
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
$grade_list->terminate();
?>