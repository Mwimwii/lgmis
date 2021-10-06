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
$output_type_list = new output_type_list();

// Run the page
$output_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$output_type_list->isExport()) { ?>
<script>
var foutput_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	foutput_typelist = currentForm = new ew.Form("foutput_typelist", "list");
	foutput_typelist.formKeyCountName = '<?php echo $output_type_list->FormKeyCountName ?>';

	// Validate form
	foutput_typelist.validate = function() {
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
			<?php if ($output_type_list->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_type_list->OutputType->caption(), $output_type_list->OutputType->RequiredErrorMessage)) ?>");
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
	foutput_typelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OutputType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	foutput_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutput_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("foutput_typelist");
});
var foutput_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	foutput_typelistsrch = currentSearchForm = new ew.Form("foutput_typelistsrch");

	// Dynamic selection lists
	// Filters

	foutput_typelistsrch.filterList = <?php echo $output_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	foutput_typelistsrch.initSearchPanel = true;
	loadjs.done("foutput_typelistsrch");
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
<?php if (!$output_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($output_type_list->TotalRecords > 0 && $output_type_list->ExportOptions->visible()) { ?>
<?php $output_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($output_type_list->ImportOptions->visible()) { ?>
<?php $output_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($output_type_list->SearchOptions->visible()) { ?>
<?php $output_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($output_type_list->FilterOptions->visible()) { ?>
<?php $output_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$output_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$output_type_list->isExport() && !$output_type->CurrentAction) { ?>
<form name="foutput_typelistsrch" id="foutput_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="foutput_typelistsrch-search-panel" class="<?php echo $output_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="output_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $output_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($output_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($output_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $output_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($output_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($output_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($output_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($output_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $output_type_list->showPageHeader(); ?>
<?php
$output_type_list->showMessage();
?>
<?php if ($output_type_list->TotalRecords > 0 || $output_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($output_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> output_type">
<?php if (!$output_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$output_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $output_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="foutput_typelist" id="foutput_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_type">
<div id="gmp_output_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($output_type_list->TotalRecords > 0 || $output_type_list->isAdd() || $output_type_list->isCopy() || $output_type_list->isGridEdit()) { ?>
<table id="tbl_output_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$output_type->RowType = ROWTYPE_HEADER;

// Render list options
$output_type_list->renderListOptions();

// Render list options (header, left)
$output_type_list->ListOptions->render("header", "left");
?>
<?php if ($output_type_list->OutputType->Visible) { // OutputType ?>
	<?php if ($output_type_list->SortUrl($output_type_list->OutputType) == "") { ?>
		<th data-name="OutputType" class="<?php echo $output_type_list->OutputType->headerCellClass() ?>"><div id="elh_output_type_OutputType" class="output_type_OutputType"><div class="ew-table-header-caption"><?php echo $output_type_list->OutputType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputType" class="<?php echo $output_type_list->OutputType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_type_list->SortUrl($output_type_list->OutputType) ?>', 1);"><div id="elh_output_type_OutputType" class="output_type_OutputType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_type_list->OutputType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_type_list->OutputType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_type_list->OutputType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$output_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($output_type_list->isAdd() || $output_type_list->isCopy()) {
		$output_type_list->RowIndex = 0;
		$output_type_list->KeyCount = $output_type_list->RowIndex;
		if ($output_type_list->isAdd())
			$output_type_list->loadRowValues();
		if ($output_type->EventCancelled) // Insert failed
			$output_type_list->restoreFormValues(); // Restore form values

		// Set row properties
		$output_type->resetAttributes();
		$output_type->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_output_type", "data-rowtype" => ROWTYPE_ADD]);
		$output_type->RowType = ROWTYPE_ADD;

		// Render row
		$output_type_list->renderRow();

		// Render list options
		$output_type_list->renderListOptions();
		$output_type_list->StartRowCount = 0;
?>
	<tr <?php echo $output_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_type_list->ListOptions->render("body", "left", $output_type_list->RowCount);
?>
	<?php if ($output_type_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType">
<span id="el<?php echo $output_type_list->RowCount ?>_output_type_OutputType" class="form-group output_type_OutputType">
<input type="text" data-table="output_type" data-field="x_OutputType" name="x<?php echo $output_type_list->RowIndex ?>_OutputType" id="x<?php echo $output_type_list->RowIndex ?>_OutputType" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($output_type_list->OutputType->getPlaceHolder()) ?>" value="<?php echo $output_type_list->OutputType->EditValue ?>"<?php echo $output_type_list->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_type" data-field="x_OutputType" name="o<?php echo $output_type_list->RowIndex ?>_OutputType" id="o<?php echo $output_type_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_type_list->OutputType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_type_list->ListOptions->render("body", "right", $output_type_list->RowCount);
?>
<script>
loadjs.ready(["foutput_typelist", "load"], function() {
	foutput_typelist.updateLists(<?php echo $output_type_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($output_type_list->ExportAll && $output_type_list->isExport()) {
	$output_type_list->StopRecord = $output_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($output_type_list->TotalRecords > $output_type_list->StartRecord + $output_type_list->DisplayRecords - 1)
		$output_type_list->StopRecord = $output_type_list->StartRecord + $output_type_list->DisplayRecords - 1;
	else
		$output_type_list->StopRecord = $output_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($output_type->isConfirm() || $output_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($output_type_list->FormKeyCountName) && ($output_type_list->isGridAdd() || $output_type_list->isGridEdit() || $output_type->isConfirm())) {
		$output_type_list->KeyCount = $CurrentForm->getValue($output_type_list->FormKeyCountName);
		$output_type_list->StopRecord = $output_type_list->StartRecord + $output_type_list->KeyCount - 1;
	}
}
$output_type_list->RecordCount = $output_type_list->StartRecord - 1;
if ($output_type_list->Recordset && !$output_type_list->Recordset->EOF) {
	$output_type_list->Recordset->moveFirst();
	$selectLimit = $output_type_list->UseSelectLimit;
	if (!$selectLimit && $output_type_list->StartRecord > 1)
		$output_type_list->Recordset->move($output_type_list->StartRecord - 1);
} elseif (!$output_type->AllowAddDeleteRow && $output_type_list->StopRecord == 0) {
	$output_type_list->StopRecord = $output_type->GridAddRowCount;
}

// Initialize aggregate
$output_type->RowType = ROWTYPE_AGGREGATEINIT;
$output_type->resetAttributes();
$output_type_list->renderRow();
$output_type_list->EditRowCount = 0;
if ($output_type_list->isEdit())
	$output_type_list->RowIndex = 1;
if ($output_type_list->isGridAdd())
	$output_type_list->RowIndex = 0;
if ($output_type_list->isGridEdit())
	$output_type_list->RowIndex = 0;
while ($output_type_list->RecordCount < $output_type_list->StopRecord) {
	$output_type_list->RecordCount++;
	if ($output_type_list->RecordCount >= $output_type_list->StartRecord) {
		$output_type_list->RowCount++;
		if ($output_type_list->isGridAdd() || $output_type_list->isGridEdit() || $output_type->isConfirm()) {
			$output_type_list->RowIndex++;
			$CurrentForm->Index = $output_type_list->RowIndex;
			if ($CurrentForm->hasValue($output_type_list->FormActionName) && ($output_type->isConfirm() || $output_type_list->EventCancelled))
				$output_type_list->RowAction = strval($CurrentForm->getValue($output_type_list->FormActionName));
			elseif ($output_type_list->isGridAdd())
				$output_type_list->RowAction = "insert";
			else
				$output_type_list->RowAction = "";
		}

		// Set up key count
		$output_type_list->KeyCount = $output_type_list->RowIndex;

		// Init row class and style
		$output_type->resetAttributes();
		$output_type->CssClass = "";
		if ($output_type_list->isGridAdd()) {
			$output_type_list->loadRowValues(); // Load default values
		} else {
			$output_type_list->loadRowValues($output_type_list->Recordset); // Load row values
		}
		$output_type->RowType = ROWTYPE_VIEW; // Render view
		if ($output_type_list->isGridAdd()) // Grid add
			$output_type->RowType = ROWTYPE_ADD; // Render add
		if ($output_type_list->isGridAdd() && $output_type->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$output_type_list->restoreCurrentRowFormValues($output_type_list->RowIndex); // Restore form values
		if ($output_type_list->isEdit()) {
			if ($output_type_list->checkInlineEditKey() && $output_type_list->EditRowCount == 0) { // Inline edit
				$output_type->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($output_type_list->isGridEdit()) { // Grid edit
			if ($output_type->EventCancelled)
				$output_type_list->restoreCurrentRowFormValues($output_type_list->RowIndex); // Restore form values
			if ($output_type_list->RowAction == "insert")
				$output_type->RowType = ROWTYPE_ADD; // Render add
			else
				$output_type->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($output_type_list->isEdit() && $output_type->RowType == ROWTYPE_EDIT && $output_type->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$output_type_list->restoreFormValues(); // Restore form values
		}
		if ($output_type_list->isGridEdit() && ($output_type->RowType == ROWTYPE_EDIT || $output_type->RowType == ROWTYPE_ADD) && $output_type->EventCancelled) // Update failed
			$output_type_list->restoreCurrentRowFormValues($output_type_list->RowIndex); // Restore form values
		if ($output_type->RowType == ROWTYPE_EDIT) // Edit row
			$output_type_list->EditRowCount++;

		// Set up row id / data-rowindex
		$output_type->RowAttrs->merge(["data-rowindex" => $output_type_list->RowCount, "id" => "r" . $output_type_list->RowCount . "_output_type", "data-rowtype" => $output_type->RowType]);

		// Render row
		$output_type_list->renderRow();

		// Render list options
		$output_type_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($output_type_list->RowAction != "delete" && $output_type_list->RowAction != "insertdelete" && !($output_type_list->RowAction == "insert" && $output_type->isConfirm() && $output_type_list->emptyRow())) {
?>
	<tr <?php echo $output_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_type_list->ListOptions->render("body", "left", $output_type_list->RowCount);
?>
	<?php if ($output_type_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType" <?php echo $output_type_list->OutputType->cellAttributes() ?>>
<?php if ($output_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_type_list->RowCount ?>_output_type_OutputType" class="form-group">
<input type="text" data-table="output_type" data-field="x_OutputType" name="x<?php echo $output_type_list->RowIndex ?>_OutputType" id="x<?php echo $output_type_list->RowIndex ?>_OutputType" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($output_type_list->OutputType->getPlaceHolder()) ?>" value="<?php echo $output_type_list->OutputType->EditValue ?>"<?php echo $output_type_list->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_type" data-field="x_OutputType" name="o<?php echo $output_type_list->RowIndex ?>_OutputType" id="o<?php echo $output_type_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_type_list->OutputType->OldValue) ?>">
<?php } ?>
<?php if ($output_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="output_type" data-field="x_OutputType" name="x<?php echo $output_type_list->RowIndex ?>_OutputType" id="x<?php echo $output_type_list->RowIndex ?>_OutputType" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($output_type_list->OutputType->getPlaceHolder()) ?>" value="<?php echo $output_type_list->OutputType->EditValue ?>"<?php echo $output_type_list->OutputType->editAttributes() ?>>
<input type="hidden" data-table="output_type" data-field="x_OutputType" name="o<?php echo $output_type_list->RowIndex ?>_OutputType" id="o<?php echo $output_type_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_type_list->OutputType->OldValue != null ? $output_type_list->OutputType->OldValue : $output_type_list->OutputType->CurrentValue) ?>">
<?php } ?>
<?php if ($output_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_type_list->RowCount ?>_output_type_OutputType">
<span<?php echo $output_type_list->OutputType->viewAttributes() ?>><?php echo $output_type_list->OutputType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_type_list->ListOptions->render("body", "right", $output_type_list->RowCount);
?>
	</tr>
<?php if ($output_type->RowType == ROWTYPE_ADD || $output_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["foutput_typelist", "load"], function() {
	foutput_typelist.updateLists(<?php echo $output_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$output_type_list->isGridAdd())
		if (!$output_type_list->Recordset->EOF)
			$output_type_list->Recordset->moveNext();
}
?>
<?php
	if ($output_type_list->isGridAdd() || $output_type_list->isGridEdit()) {
		$output_type_list->RowIndex = '$rowindex$';
		$output_type_list->loadRowValues();

		// Set row properties
		$output_type->resetAttributes();
		$output_type->RowAttrs->merge(["data-rowindex" => $output_type_list->RowIndex, "id" => "r0_output_type", "data-rowtype" => ROWTYPE_ADD]);
		$output_type->RowAttrs->appendClass("ew-template");
		$output_type->RowType = ROWTYPE_ADD;

		// Render row
		$output_type_list->renderRow();

		// Render list options
		$output_type_list->renderListOptions();
		$output_type_list->StartRowCount = 0;
?>
	<tr <?php echo $output_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_type_list->ListOptions->render("body", "left", $output_type_list->RowIndex);
?>
	<?php if ($output_type_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType">
<span id="el$rowindex$_output_type_OutputType" class="form-group output_type_OutputType">
<input type="text" data-table="output_type" data-field="x_OutputType" name="x<?php echo $output_type_list->RowIndex ?>_OutputType" id="x<?php echo $output_type_list->RowIndex ?>_OutputType" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($output_type_list->OutputType->getPlaceHolder()) ?>" value="<?php echo $output_type_list->OutputType->EditValue ?>"<?php echo $output_type_list->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_type" data-field="x_OutputType" name="o<?php echo $output_type_list->RowIndex ?>_OutputType" id="o<?php echo $output_type_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_type_list->OutputType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_type_list->ListOptions->render("body", "right", $output_type_list->RowIndex);
?>
<script>
loadjs.ready(["foutput_typelist", "load"], function() {
	foutput_typelist.updateLists(<?php echo $output_type_list->RowIndex ?>);
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
<?php if ($output_type_list->isAdd() || $output_type_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $output_type_list->FormKeyCountName ?>" id="<?php echo $output_type_list->FormKeyCountName ?>" value="<?php echo $output_type_list->KeyCount ?>">
<?php } ?>
<?php if ($output_type_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $output_type_list->FormKeyCountName ?>" id="<?php echo $output_type_list->FormKeyCountName ?>" value="<?php echo $output_type_list->KeyCount ?>">
<?php echo $output_type_list->MultiSelectKey ?>
<?php } ?>
<?php if ($output_type_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $output_type_list->FormKeyCountName ?>" id="<?php echo $output_type_list->FormKeyCountName ?>" value="<?php echo $output_type_list->KeyCount ?>">
<?php } ?>
<?php if ($output_type_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $output_type_list->FormKeyCountName ?>" id="<?php echo $output_type_list->FormKeyCountName ?>" value="<?php echo $output_type_list->KeyCount ?>">
<?php echo $output_type_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$output_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($output_type_list->Recordset)
	$output_type_list->Recordset->Close();
?>
<?php if (!$output_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$output_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $output_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($output_type_list->TotalRecords == 0 && !$output_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $output_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$output_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$output_type_list->isExport()) { ?>
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
$output_type_list->terminate();
?>