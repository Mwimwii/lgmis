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
$core_function_list = new core_function_list();

// Run the page
$core_function_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$core_function_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$core_function_list->isExport()) { ?>
<script>
var fcore_functionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcore_functionlist = currentForm = new ew.Form("fcore_functionlist", "list");
	fcore_functionlist.formKeyCountName = '<?php echo $core_function_list->FormKeyCountName ?>';

	// Validate form
	fcore_functionlist.validate = function() {
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
			<?php if ($core_function_list->functioncode->Required) { ?>
				elm = this.getElements("x" + infix + "_functioncode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $core_function_list->functioncode->caption(), $core_function_list->functioncode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($core_function_list->FunctionName->Required) { ?>
				elm = this.getElements("x" + infix + "_FunctionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $core_function_list->FunctionName->caption(), $core_function_list->FunctionName->RequiredErrorMessage)) ?>");
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
	fcore_functionlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "functioncode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FunctionName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcore_functionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcore_functionlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcore_functionlist");
});
var fcore_functionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcore_functionlistsrch = currentSearchForm = new ew.Form("fcore_functionlistsrch");

	// Dynamic selection lists
	// Filters

	fcore_functionlistsrch.filterList = <?php echo $core_function_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcore_functionlistsrch.initSearchPanel = true;
	loadjs.done("fcore_functionlistsrch");
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
<?php if (!$core_function_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($core_function_list->TotalRecords > 0 && $core_function_list->ExportOptions->visible()) { ?>
<?php $core_function_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($core_function_list->ImportOptions->visible()) { ?>
<?php $core_function_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($core_function_list->SearchOptions->visible()) { ?>
<?php $core_function_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($core_function_list->FilterOptions->visible()) { ?>
<?php $core_function_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$core_function_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$core_function_list->isExport() && !$core_function->CurrentAction) { ?>
<form name="fcore_functionlistsrch" id="fcore_functionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcore_functionlistsrch-search-panel" class="<?php echo $core_function_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="core_function">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $core_function_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($core_function_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($core_function_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $core_function_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($core_function_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($core_function_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($core_function_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($core_function_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $core_function_list->showPageHeader(); ?>
<?php
$core_function_list->showMessage();
?>
<?php if ($core_function_list->TotalRecords > 0 || $core_function->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($core_function_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> core_function">
<?php if (!$core_function_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$core_function_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $core_function_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $core_function_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcore_functionlist" id="fcore_functionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="core_function">
<div id="gmp_core_function" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($core_function_list->TotalRecords > 0 || $core_function_list->isGridEdit()) { ?>
<table id="tbl_core_functionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$core_function->RowType = ROWTYPE_HEADER;

// Render list options
$core_function_list->renderListOptions();

// Render list options (header, left)
$core_function_list->ListOptions->render("header", "left");
?>
<?php if ($core_function_list->functioncode->Visible) { // functioncode ?>
	<?php if ($core_function_list->SortUrl($core_function_list->functioncode) == "") { ?>
		<th data-name="functioncode" class="<?php echo $core_function_list->functioncode->headerCellClass() ?>"><div id="elh_core_function_functioncode" class="core_function_functioncode"><div class="ew-table-header-caption"><?php echo $core_function_list->functioncode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="functioncode" class="<?php echo $core_function_list->functioncode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $core_function_list->SortUrl($core_function_list->functioncode) ?>', 1);"><div id="elh_core_function_functioncode" class="core_function_functioncode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $core_function_list->functioncode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($core_function_list->functioncode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($core_function_list->functioncode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($core_function_list->FunctionName->Visible) { // FunctionName ?>
	<?php if ($core_function_list->SortUrl($core_function_list->FunctionName) == "") { ?>
		<th data-name="FunctionName" class="<?php echo $core_function_list->FunctionName->headerCellClass() ?>"><div id="elh_core_function_FunctionName" class="core_function_FunctionName"><div class="ew-table-header-caption"><?php echo $core_function_list->FunctionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FunctionName" class="<?php echo $core_function_list->FunctionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $core_function_list->SortUrl($core_function_list->FunctionName) ?>', 1);"><div id="elh_core_function_FunctionName" class="core_function_FunctionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $core_function_list->FunctionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($core_function_list->FunctionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($core_function_list->FunctionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$core_function_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($core_function_list->ExportAll && $core_function_list->isExport()) {
	$core_function_list->StopRecord = $core_function_list->TotalRecords;
} else {

	// Set the last record to display
	if ($core_function_list->TotalRecords > $core_function_list->StartRecord + $core_function_list->DisplayRecords - 1)
		$core_function_list->StopRecord = $core_function_list->StartRecord + $core_function_list->DisplayRecords - 1;
	else
		$core_function_list->StopRecord = $core_function_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($core_function->isConfirm() || $core_function_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($core_function_list->FormKeyCountName) && ($core_function_list->isGridAdd() || $core_function_list->isGridEdit() || $core_function->isConfirm())) {
		$core_function_list->KeyCount = $CurrentForm->getValue($core_function_list->FormKeyCountName);
		$core_function_list->StopRecord = $core_function_list->StartRecord + $core_function_list->KeyCount - 1;
	}
}
$core_function_list->RecordCount = $core_function_list->StartRecord - 1;
if ($core_function_list->Recordset && !$core_function_list->Recordset->EOF) {
	$core_function_list->Recordset->moveFirst();
	$selectLimit = $core_function_list->UseSelectLimit;
	if (!$selectLimit && $core_function_list->StartRecord > 1)
		$core_function_list->Recordset->move($core_function_list->StartRecord - 1);
} elseif (!$core_function->AllowAddDeleteRow && $core_function_list->StopRecord == 0) {
	$core_function_list->StopRecord = $core_function->GridAddRowCount;
}

// Initialize aggregate
$core_function->RowType = ROWTYPE_AGGREGATEINIT;
$core_function->resetAttributes();
$core_function_list->renderRow();
if ($core_function_list->isGridAdd())
	$core_function_list->RowIndex = 0;
if ($core_function_list->isGridEdit())
	$core_function_list->RowIndex = 0;
while ($core_function_list->RecordCount < $core_function_list->StopRecord) {
	$core_function_list->RecordCount++;
	if ($core_function_list->RecordCount >= $core_function_list->StartRecord) {
		$core_function_list->RowCount++;
		if ($core_function_list->isGridAdd() || $core_function_list->isGridEdit() || $core_function->isConfirm()) {
			$core_function_list->RowIndex++;
			$CurrentForm->Index = $core_function_list->RowIndex;
			if ($CurrentForm->hasValue($core_function_list->FormActionName) && ($core_function->isConfirm() || $core_function_list->EventCancelled))
				$core_function_list->RowAction = strval($CurrentForm->getValue($core_function_list->FormActionName));
			elseif ($core_function_list->isGridAdd())
				$core_function_list->RowAction = "insert";
			else
				$core_function_list->RowAction = "";
		}

		// Set up key count
		$core_function_list->KeyCount = $core_function_list->RowIndex;

		// Init row class and style
		$core_function->resetAttributes();
		$core_function->CssClass = "";
		if ($core_function_list->isGridAdd()) {
			$core_function_list->loadRowValues(); // Load default values
		} else {
			$core_function_list->loadRowValues($core_function_list->Recordset); // Load row values
		}
		$core_function->RowType = ROWTYPE_VIEW; // Render view
		if ($core_function_list->isGridAdd()) // Grid add
			$core_function->RowType = ROWTYPE_ADD; // Render add
		if ($core_function_list->isGridAdd() && $core_function->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$core_function_list->restoreCurrentRowFormValues($core_function_list->RowIndex); // Restore form values
		if ($core_function_list->isGridEdit()) { // Grid edit
			if ($core_function->EventCancelled)
				$core_function_list->restoreCurrentRowFormValues($core_function_list->RowIndex); // Restore form values
			if ($core_function_list->RowAction == "insert")
				$core_function->RowType = ROWTYPE_ADD; // Render add
			else
				$core_function->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($core_function_list->isGridEdit() && ($core_function->RowType == ROWTYPE_EDIT || $core_function->RowType == ROWTYPE_ADD) && $core_function->EventCancelled) // Update failed
			$core_function_list->restoreCurrentRowFormValues($core_function_list->RowIndex); // Restore form values
		if ($core_function->RowType == ROWTYPE_EDIT) // Edit row
			$core_function_list->EditRowCount++;

		// Set up row id / data-rowindex
		$core_function->RowAttrs->merge(["data-rowindex" => $core_function_list->RowCount, "id" => "r" . $core_function_list->RowCount . "_core_function", "data-rowtype" => $core_function->RowType]);

		// Render row
		$core_function_list->renderRow();

		// Render list options
		$core_function_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($core_function_list->RowAction != "delete" && $core_function_list->RowAction != "insertdelete" && !($core_function_list->RowAction == "insert" && $core_function->isConfirm() && $core_function_list->emptyRow())) {
?>
	<tr <?php echo $core_function->rowAttributes() ?>>
<?php

// Render list options (body, left)
$core_function_list->ListOptions->render("body", "left", $core_function_list->RowCount);
?>
	<?php if ($core_function_list->functioncode->Visible) { // functioncode ?>
		<td data-name="functioncode" <?php echo $core_function_list->functioncode->cellAttributes() ?>>
<?php if ($core_function->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $core_function_list->RowCount ?>_core_function_functioncode" class="form-group">
<input type="text" data-table="core_function" data-field="x_functioncode" name="x<?php echo $core_function_list->RowIndex ?>_functioncode" id="x<?php echo $core_function_list->RowIndex ?>_functioncode" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($core_function_list->functioncode->getPlaceHolder()) ?>" value="<?php echo $core_function_list->functioncode->EditValue ?>"<?php echo $core_function_list->functioncode->editAttributes() ?>>
</span>
<input type="hidden" data-table="core_function" data-field="x_functioncode" name="o<?php echo $core_function_list->RowIndex ?>_functioncode" id="o<?php echo $core_function_list->RowIndex ?>_functioncode" value="<?php echo HtmlEncode($core_function_list->functioncode->OldValue) ?>">
<?php } ?>
<?php if ($core_function->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="core_function" data-field="x_functioncode" name="x<?php echo $core_function_list->RowIndex ?>_functioncode" id="x<?php echo $core_function_list->RowIndex ?>_functioncode" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($core_function_list->functioncode->getPlaceHolder()) ?>" value="<?php echo $core_function_list->functioncode->EditValue ?>"<?php echo $core_function_list->functioncode->editAttributes() ?>>
<input type="hidden" data-table="core_function" data-field="x_functioncode" name="o<?php echo $core_function_list->RowIndex ?>_functioncode" id="o<?php echo $core_function_list->RowIndex ?>_functioncode" value="<?php echo HtmlEncode($core_function_list->functioncode->OldValue != null ? $core_function_list->functioncode->OldValue : $core_function_list->functioncode->CurrentValue) ?>">
<?php } ?>
<?php if ($core_function->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $core_function_list->RowCount ?>_core_function_functioncode">
<span<?php echo $core_function_list->functioncode->viewAttributes() ?>><?php echo $core_function_list->functioncode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($core_function_list->FunctionName->Visible) { // FunctionName ?>
		<td data-name="FunctionName" <?php echo $core_function_list->FunctionName->cellAttributes() ?>>
<?php if ($core_function->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $core_function_list->RowCount ?>_core_function_FunctionName" class="form-group">
<input type="text" data-table="core_function" data-field="x_FunctionName" name="x<?php echo $core_function_list->RowIndex ?>_FunctionName" id="x<?php echo $core_function_list->RowIndex ?>_FunctionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($core_function_list->FunctionName->getPlaceHolder()) ?>" value="<?php echo $core_function_list->FunctionName->EditValue ?>"<?php echo $core_function_list->FunctionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="core_function" data-field="x_FunctionName" name="o<?php echo $core_function_list->RowIndex ?>_FunctionName" id="o<?php echo $core_function_list->RowIndex ?>_FunctionName" value="<?php echo HtmlEncode($core_function_list->FunctionName->OldValue) ?>">
<?php } ?>
<?php if ($core_function->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $core_function_list->RowCount ?>_core_function_FunctionName" class="form-group">
<input type="text" data-table="core_function" data-field="x_FunctionName" name="x<?php echo $core_function_list->RowIndex ?>_FunctionName" id="x<?php echo $core_function_list->RowIndex ?>_FunctionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($core_function_list->FunctionName->getPlaceHolder()) ?>" value="<?php echo $core_function_list->FunctionName->EditValue ?>"<?php echo $core_function_list->FunctionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($core_function->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $core_function_list->RowCount ?>_core_function_FunctionName">
<span<?php echo $core_function_list->FunctionName->viewAttributes() ?>><?php echo $core_function_list->FunctionName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$core_function_list->ListOptions->render("body", "right", $core_function_list->RowCount);
?>
	</tr>
<?php if ($core_function->RowType == ROWTYPE_ADD || $core_function->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcore_functionlist", "load"], function() {
	fcore_functionlist.updateLists(<?php echo $core_function_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$core_function_list->isGridAdd())
		if (!$core_function_list->Recordset->EOF)
			$core_function_list->Recordset->moveNext();
}
?>
<?php
	if ($core_function_list->isGridAdd() || $core_function_list->isGridEdit()) {
		$core_function_list->RowIndex = '$rowindex$';
		$core_function_list->loadRowValues();

		// Set row properties
		$core_function->resetAttributes();
		$core_function->RowAttrs->merge(["data-rowindex" => $core_function_list->RowIndex, "id" => "r0_core_function", "data-rowtype" => ROWTYPE_ADD]);
		$core_function->RowAttrs->appendClass("ew-template");
		$core_function->RowType = ROWTYPE_ADD;

		// Render row
		$core_function_list->renderRow();

		// Render list options
		$core_function_list->renderListOptions();
		$core_function_list->StartRowCount = 0;
?>
	<tr <?php echo $core_function->rowAttributes() ?>>
<?php

// Render list options (body, left)
$core_function_list->ListOptions->render("body", "left", $core_function_list->RowIndex);
?>
	<?php if ($core_function_list->functioncode->Visible) { // functioncode ?>
		<td data-name="functioncode">
<span id="el$rowindex$_core_function_functioncode" class="form-group core_function_functioncode">
<input type="text" data-table="core_function" data-field="x_functioncode" name="x<?php echo $core_function_list->RowIndex ?>_functioncode" id="x<?php echo $core_function_list->RowIndex ?>_functioncode" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($core_function_list->functioncode->getPlaceHolder()) ?>" value="<?php echo $core_function_list->functioncode->EditValue ?>"<?php echo $core_function_list->functioncode->editAttributes() ?>>
</span>
<input type="hidden" data-table="core_function" data-field="x_functioncode" name="o<?php echo $core_function_list->RowIndex ?>_functioncode" id="o<?php echo $core_function_list->RowIndex ?>_functioncode" value="<?php echo HtmlEncode($core_function_list->functioncode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($core_function_list->FunctionName->Visible) { // FunctionName ?>
		<td data-name="FunctionName">
<span id="el$rowindex$_core_function_FunctionName" class="form-group core_function_FunctionName">
<input type="text" data-table="core_function" data-field="x_FunctionName" name="x<?php echo $core_function_list->RowIndex ?>_FunctionName" id="x<?php echo $core_function_list->RowIndex ?>_FunctionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($core_function_list->FunctionName->getPlaceHolder()) ?>" value="<?php echo $core_function_list->FunctionName->EditValue ?>"<?php echo $core_function_list->FunctionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="core_function" data-field="x_FunctionName" name="o<?php echo $core_function_list->RowIndex ?>_FunctionName" id="o<?php echo $core_function_list->RowIndex ?>_FunctionName" value="<?php echo HtmlEncode($core_function_list->FunctionName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$core_function_list->ListOptions->render("body", "right", $core_function_list->RowIndex);
?>
<script>
loadjs.ready(["fcore_functionlist", "load"], function() {
	fcore_functionlist.updateLists(<?php echo $core_function_list->RowIndex ?>);
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
<?php if ($core_function_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $core_function_list->FormKeyCountName ?>" id="<?php echo $core_function_list->FormKeyCountName ?>" value="<?php echo $core_function_list->KeyCount ?>">
<?php echo $core_function_list->MultiSelectKey ?>
<?php } ?>
<?php if ($core_function_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $core_function_list->FormKeyCountName ?>" id="<?php echo $core_function_list->FormKeyCountName ?>" value="<?php echo $core_function_list->KeyCount ?>">
<?php echo $core_function_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$core_function->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($core_function_list->Recordset)
	$core_function_list->Recordset->Close();
?>
<?php if (!$core_function_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$core_function_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $core_function_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $core_function_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($core_function_list->TotalRecords == 0 && !$core_function->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $core_function_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$core_function_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$core_function_list->isExport()) { ?>
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
$core_function_list->terminate();
?>