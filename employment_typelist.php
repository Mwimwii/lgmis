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
$employment_type_list = new employment_type_list();

// Run the page
$employment_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_type_list->isExport()) { ?>
<script>
var femployment_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployment_typelist = currentForm = new ew.Form("femployment_typelist", "list");
	femployment_typelist.formKeyCountName = '<?php echo $employment_type_list->FormKeyCountName ?>';

	// Validate form
	femployment_typelist.validate = function() {
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
			<?php if ($employment_type_list->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_type_list->EmploymentType->caption(), $employment_type_list->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_type_list->EmploymentTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_type_list->EmploymentTypeDesc->caption(), $employment_type_list->EmploymentTypeDesc->RequiredErrorMessage)) ?>");
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
	femployment_typelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmploymentTypeDesc", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployment_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_typelist");
});
var femployment_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployment_typelistsrch = currentSearchForm = new ew.Form("femployment_typelistsrch");

	// Dynamic selection lists
	// Filters

	femployment_typelistsrch.filterList = <?php echo $employment_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployment_typelistsrch.initSearchPanel = true;
	loadjs.done("femployment_typelistsrch");
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
<?php if (!$employment_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employment_type_list->TotalRecords > 0 && $employment_type_list->ExportOptions->visible()) { ?>
<?php $employment_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_type_list->ImportOptions->visible()) { ?>
<?php $employment_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_type_list->SearchOptions->visible()) { ?>
<?php $employment_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employment_type_list->FilterOptions->visible()) { ?>
<?php $employment_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employment_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employment_type_list->isExport() && !$employment_type->CurrentAction) { ?>
<form name="femployment_typelistsrch" id="femployment_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployment_typelistsrch-search-panel" class="<?php echo $employment_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employment_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employment_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employment_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employment_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employment_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employment_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employment_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employment_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employment_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employment_type_list->showPageHeader(); ?>
<?php
$employment_type_list->showMessage();
?>
<?php if ($employment_type_list->TotalRecords > 0 || $employment_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employment_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employment_type">
<?php if (!$employment_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employment_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployment_typelist" id="femployment_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_type">
<div id="gmp_employment_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employment_type_list->TotalRecords > 0 || $employment_type_list->isAdd() || $employment_type_list->isCopy() || $employment_type_list->isGridEdit()) { ?>
<table id="tbl_employment_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employment_type->RowType = ROWTYPE_HEADER;

// Render list options
$employment_type_list->renderListOptions();

// Render list options (header, left)
$employment_type_list->ListOptions->render("header", "left");
?>
<?php if ($employment_type_list->EmploymentType->Visible) { // EmploymentType ?>
	<?php if ($employment_type_list->SortUrl($employment_type_list->EmploymentType) == "") { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_type_list->EmploymentType->headerCellClass() ?>"><div id="elh_employment_type_EmploymentType" class="employment_type_EmploymentType"><div class="ew-table-header-caption"><?php echo $employment_type_list->EmploymentType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_type_list->EmploymentType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_type_list->SortUrl($employment_type_list->EmploymentType) ?>', 1);"><div id="elh_employment_type_EmploymentType" class="employment_type_EmploymentType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_type_list->EmploymentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_type_list->EmploymentType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_type_list->EmploymentType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_type_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
	<?php if ($employment_type_list->SortUrl($employment_type_list->EmploymentTypeDesc) == "") { ?>
		<th data-name="EmploymentTypeDesc" class="<?php echo $employment_type_list->EmploymentTypeDesc->headerCellClass() ?>"><div id="elh_employment_type_EmploymentTypeDesc" class="employment_type_EmploymentTypeDesc"><div class="ew-table-header-caption"><?php echo $employment_type_list->EmploymentTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentTypeDesc" class="<?php echo $employment_type_list->EmploymentTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_type_list->SortUrl($employment_type_list->EmploymentTypeDesc) ?>', 1);"><div id="elh_employment_type_EmploymentTypeDesc" class="employment_type_EmploymentTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_type_list->EmploymentTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_type_list->EmploymentTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_type_list->EmploymentTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($employment_type_list->isAdd() || $employment_type_list->isCopy()) {
		$employment_type_list->RowIndex = 0;
		$employment_type_list->KeyCount = $employment_type_list->RowIndex;
		if ($employment_type_list->isAdd())
			$employment_type_list->loadRowValues();
		if ($employment_type->EventCancelled) // Insert failed
			$employment_type_list->restoreFormValues(); // Restore form values

		// Set row properties
		$employment_type->resetAttributes();
		$employment_type->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_employment_type", "data-rowtype" => ROWTYPE_ADD]);
		$employment_type->RowType = ROWTYPE_ADD;

		// Render row
		$employment_type_list->renderRow();

		// Render list options
		$employment_type_list->renderListOptions();
		$employment_type_list->StartRowCount = 0;
?>
	<tr <?php echo $employment_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_type_list->ListOptions->render("body", "left", $employment_type_list->RowCount);
?>
	<?php if ($employment_type_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType">
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentType" class="form-group employment_type_EmploymentType"></span>
<input type="hidden" data-table="employment_type" data-field="x_EmploymentType" name="o<?php echo $employment_type_list->RowIndex ?>_EmploymentType" id="o<?php echo $employment_type_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_type_list->EmploymentType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_type_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
		<td data-name="EmploymentTypeDesc">
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentTypeDesc" class="form-group employment_type_EmploymentTypeDesc">
<input type="text" data-table="employment_type" data-field="x_EmploymentTypeDesc" name="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" id="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_type_list->EmploymentTypeDesc->getPlaceHolder()) ?>" value="<?php echo $employment_type_list->EmploymentTypeDesc->EditValue ?>"<?php echo $employment_type_list->EmploymentTypeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_type" data-field="x_EmploymentTypeDesc" name="o<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" id="o<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" value="<?php echo HtmlEncode($employment_type_list->EmploymentTypeDesc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_type_list->ListOptions->render("body", "right", $employment_type_list->RowCount);
?>
<script>
loadjs.ready(["femployment_typelist", "load"], function() {
	femployment_typelist.updateLists(<?php echo $employment_type_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($employment_type_list->ExportAll && $employment_type_list->isExport()) {
	$employment_type_list->StopRecord = $employment_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employment_type_list->TotalRecords > $employment_type_list->StartRecord + $employment_type_list->DisplayRecords - 1)
		$employment_type_list->StopRecord = $employment_type_list->StartRecord + $employment_type_list->DisplayRecords - 1;
	else
		$employment_type_list->StopRecord = $employment_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employment_type->isConfirm() || $employment_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employment_type_list->FormKeyCountName) && ($employment_type_list->isGridAdd() || $employment_type_list->isGridEdit() || $employment_type->isConfirm())) {
		$employment_type_list->KeyCount = $CurrentForm->getValue($employment_type_list->FormKeyCountName);
		$employment_type_list->StopRecord = $employment_type_list->StartRecord + $employment_type_list->KeyCount - 1;
	}
}
$employment_type_list->RecordCount = $employment_type_list->StartRecord - 1;
if ($employment_type_list->Recordset && !$employment_type_list->Recordset->EOF) {
	$employment_type_list->Recordset->moveFirst();
	$selectLimit = $employment_type_list->UseSelectLimit;
	if (!$selectLimit && $employment_type_list->StartRecord > 1)
		$employment_type_list->Recordset->move($employment_type_list->StartRecord - 1);
} elseif (!$employment_type->AllowAddDeleteRow && $employment_type_list->StopRecord == 0) {
	$employment_type_list->StopRecord = $employment_type->GridAddRowCount;
}

// Initialize aggregate
$employment_type->RowType = ROWTYPE_AGGREGATEINIT;
$employment_type->resetAttributes();
$employment_type_list->renderRow();
$employment_type_list->EditRowCount = 0;
if ($employment_type_list->isEdit())
	$employment_type_list->RowIndex = 1;
if ($employment_type_list->isGridAdd())
	$employment_type_list->RowIndex = 0;
if ($employment_type_list->isGridEdit())
	$employment_type_list->RowIndex = 0;
while ($employment_type_list->RecordCount < $employment_type_list->StopRecord) {
	$employment_type_list->RecordCount++;
	if ($employment_type_list->RecordCount >= $employment_type_list->StartRecord) {
		$employment_type_list->RowCount++;
		if ($employment_type_list->isGridAdd() || $employment_type_list->isGridEdit() || $employment_type->isConfirm()) {
			$employment_type_list->RowIndex++;
			$CurrentForm->Index = $employment_type_list->RowIndex;
			if ($CurrentForm->hasValue($employment_type_list->FormActionName) && ($employment_type->isConfirm() || $employment_type_list->EventCancelled))
				$employment_type_list->RowAction = strval($CurrentForm->getValue($employment_type_list->FormActionName));
			elseif ($employment_type_list->isGridAdd())
				$employment_type_list->RowAction = "insert";
			else
				$employment_type_list->RowAction = "";
		}

		// Set up key count
		$employment_type_list->KeyCount = $employment_type_list->RowIndex;

		// Init row class and style
		$employment_type->resetAttributes();
		$employment_type->CssClass = "";
		if ($employment_type_list->isGridAdd()) {
			$employment_type_list->loadRowValues(); // Load default values
		} else {
			$employment_type_list->loadRowValues($employment_type_list->Recordset); // Load row values
		}
		$employment_type->RowType = ROWTYPE_VIEW; // Render view
		if ($employment_type_list->isGridAdd()) // Grid add
			$employment_type->RowType = ROWTYPE_ADD; // Render add
		if ($employment_type_list->isGridAdd() && $employment_type->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employment_type_list->restoreCurrentRowFormValues($employment_type_list->RowIndex); // Restore form values
		if ($employment_type_list->isEdit()) {
			if ($employment_type_list->checkInlineEditKey() && $employment_type_list->EditRowCount == 0) { // Inline edit
				$employment_type->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($employment_type_list->isGridEdit()) { // Grid edit
			if ($employment_type->EventCancelled)
				$employment_type_list->restoreCurrentRowFormValues($employment_type_list->RowIndex); // Restore form values
			if ($employment_type_list->RowAction == "insert")
				$employment_type->RowType = ROWTYPE_ADD; // Render add
			else
				$employment_type->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employment_type_list->isEdit() && $employment_type->RowType == ROWTYPE_EDIT && $employment_type->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$employment_type_list->restoreFormValues(); // Restore form values
		}
		if ($employment_type_list->isGridEdit() && ($employment_type->RowType == ROWTYPE_EDIT || $employment_type->RowType == ROWTYPE_ADD) && $employment_type->EventCancelled) // Update failed
			$employment_type_list->restoreCurrentRowFormValues($employment_type_list->RowIndex); // Restore form values
		if ($employment_type->RowType == ROWTYPE_EDIT) // Edit row
			$employment_type_list->EditRowCount++;

		// Set up row id / data-rowindex
		$employment_type->RowAttrs->merge(["data-rowindex" => $employment_type_list->RowCount, "id" => "r" . $employment_type_list->RowCount . "_employment_type", "data-rowtype" => $employment_type->RowType]);

		// Render row
		$employment_type_list->renderRow();

		// Render list options
		$employment_type_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employment_type_list->RowAction != "delete" && $employment_type_list->RowAction != "insertdelete" && !($employment_type_list->RowAction == "insert" && $employment_type->isConfirm() && $employment_type_list->emptyRow())) {
?>
	<tr <?php echo $employment_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_type_list->ListOptions->render("body", "left", $employment_type_list->RowCount);
?>
	<?php if ($employment_type_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType" <?php echo $employment_type_list->EmploymentType->cellAttributes() ?>>
<?php if ($employment_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentType" class="form-group"></span>
<input type="hidden" data-table="employment_type" data-field="x_EmploymentType" name="o<?php echo $employment_type_list->RowIndex ?>_EmploymentType" id="o<?php echo $employment_type_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_type_list->EmploymentType->OldValue) ?>">
<?php } ?>
<?php if ($employment_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentType" class="form-group">
<span<?php echo $employment_type_list->EmploymentType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_type_list->EmploymentType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment_type" data-field="x_EmploymentType" name="x<?php echo $employment_type_list->RowIndex ?>_EmploymentType" id="x<?php echo $employment_type_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_type_list->EmploymentType->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentType">
<span<?php echo $employment_type_list->EmploymentType->viewAttributes() ?>><?php echo $employment_type_list->EmploymentType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_type_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
		<td data-name="EmploymentTypeDesc" <?php echo $employment_type_list->EmploymentTypeDesc->cellAttributes() ?>>
<?php if ($employment_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentTypeDesc" class="form-group">
<input type="text" data-table="employment_type" data-field="x_EmploymentTypeDesc" name="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" id="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_type_list->EmploymentTypeDesc->getPlaceHolder()) ?>" value="<?php echo $employment_type_list->EmploymentTypeDesc->EditValue ?>"<?php echo $employment_type_list->EmploymentTypeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_type" data-field="x_EmploymentTypeDesc" name="o<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" id="o<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" value="<?php echo HtmlEncode($employment_type_list->EmploymentTypeDesc->OldValue) ?>">
<?php } ?>
<?php if ($employment_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentTypeDesc" class="form-group">
<input type="text" data-table="employment_type" data-field="x_EmploymentTypeDesc" name="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" id="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_type_list->EmploymentTypeDesc->getPlaceHolder()) ?>" value="<?php echo $employment_type_list->EmploymentTypeDesc->EditValue ?>"<?php echo $employment_type_list->EmploymentTypeDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_type_list->RowCount ?>_employment_type_EmploymentTypeDesc">
<span<?php echo $employment_type_list->EmploymentTypeDesc->viewAttributes() ?>><?php echo $employment_type_list->EmploymentTypeDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_type_list->ListOptions->render("body", "right", $employment_type_list->RowCount);
?>
	</tr>
<?php if ($employment_type->RowType == ROWTYPE_ADD || $employment_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployment_typelist", "load"], function() {
	femployment_typelist.updateLists(<?php echo $employment_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employment_type_list->isGridAdd())
		if (!$employment_type_list->Recordset->EOF)
			$employment_type_list->Recordset->moveNext();
}
?>
<?php
	if ($employment_type_list->isGridAdd() || $employment_type_list->isGridEdit()) {
		$employment_type_list->RowIndex = '$rowindex$';
		$employment_type_list->loadRowValues();

		// Set row properties
		$employment_type->resetAttributes();
		$employment_type->RowAttrs->merge(["data-rowindex" => $employment_type_list->RowIndex, "id" => "r0_employment_type", "data-rowtype" => ROWTYPE_ADD]);
		$employment_type->RowAttrs->appendClass("ew-template");
		$employment_type->RowType = ROWTYPE_ADD;

		// Render row
		$employment_type_list->renderRow();

		// Render list options
		$employment_type_list->renderListOptions();
		$employment_type_list->StartRowCount = 0;
?>
	<tr <?php echo $employment_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_type_list->ListOptions->render("body", "left", $employment_type_list->RowIndex);
?>
	<?php if ($employment_type_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType">
<span id="el$rowindex$_employment_type_EmploymentType" class="form-group employment_type_EmploymentType"></span>
<input type="hidden" data-table="employment_type" data-field="x_EmploymentType" name="o<?php echo $employment_type_list->RowIndex ?>_EmploymentType" id="o<?php echo $employment_type_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_type_list->EmploymentType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_type_list->EmploymentTypeDesc->Visible) { // EmploymentTypeDesc ?>
		<td data-name="EmploymentTypeDesc">
<span id="el$rowindex$_employment_type_EmploymentTypeDesc" class="form-group employment_type_EmploymentTypeDesc">
<input type="text" data-table="employment_type" data-field="x_EmploymentTypeDesc" name="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" id="x<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_type_list->EmploymentTypeDesc->getPlaceHolder()) ?>" value="<?php echo $employment_type_list->EmploymentTypeDesc->EditValue ?>"<?php echo $employment_type_list->EmploymentTypeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_type" data-field="x_EmploymentTypeDesc" name="o<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" id="o<?php echo $employment_type_list->RowIndex ?>_EmploymentTypeDesc" value="<?php echo HtmlEncode($employment_type_list->EmploymentTypeDesc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_type_list->ListOptions->render("body", "right", $employment_type_list->RowIndex);
?>
<script>
loadjs.ready(["femployment_typelist", "load"], function() {
	femployment_typelist.updateLists(<?php echo $employment_type_list->RowIndex ?>);
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
<?php if ($employment_type_list->isAdd() || $employment_type_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $employment_type_list->FormKeyCountName ?>" id="<?php echo $employment_type_list->FormKeyCountName ?>" value="<?php echo $employment_type_list->KeyCount ?>">
<?php } ?>
<?php if ($employment_type_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employment_type_list->FormKeyCountName ?>" id="<?php echo $employment_type_list->FormKeyCountName ?>" value="<?php echo $employment_type_list->KeyCount ?>">
<?php echo $employment_type_list->MultiSelectKey ?>
<?php } ?>
<?php if ($employment_type_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $employment_type_list->FormKeyCountName ?>" id="<?php echo $employment_type_list->FormKeyCountName ?>" value="<?php echo $employment_type_list->KeyCount ?>">
<?php } ?>
<?php if ($employment_type_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $employment_type_list->FormKeyCountName ?>" id="<?php echo $employment_type_list->FormKeyCountName ?>" value="<?php echo $employment_type_list->KeyCount ?>">
<?php echo $employment_type_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employment_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employment_type_list->Recordset)
	$employment_type_list->Recordset->Close();
?>
<?php if (!$employment_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employment_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employment_type_list->TotalRecords == 0 && !$employment_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employment_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employment_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_type_list->isExport()) { ?>
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
$employment_type_list->terminate();
?>