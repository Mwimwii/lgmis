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
$employment_status_list = new employment_status_list();

// Run the page
$employment_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_status_list->isExport()) { ?>
<script>
var femployment_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployment_statuslist = currentForm = new ew.Form("femployment_statuslist", "list");
	femployment_statuslist.formKeyCountName = '<?php echo $employment_status_list->FormKeyCountName ?>';

	// Validate form
	femployment_statuslist.validate = function() {
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
			<?php if ($employment_status_list->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_status_list->EmploymentStatus->caption(), $employment_status_list->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_status_list->EmploymentStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_status_list->EmploymentStatusDesc->caption(), $employment_status_list->EmploymentStatusDesc->RequiredErrorMessage)) ?>");
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
	femployment_statuslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmploymentStatusDesc", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployment_statuslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_statuslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_statuslist");
});
var femployment_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployment_statuslistsrch = currentSearchForm = new ew.Form("femployment_statuslistsrch");

	// Dynamic selection lists
	// Filters

	femployment_statuslistsrch.filterList = <?php echo $employment_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployment_statuslistsrch.initSearchPanel = true;
	loadjs.done("femployment_statuslistsrch");
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
<?php if (!$employment_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employment_status_list->TotalRecords > 0 && $employment_status_list->ExportOptions->visible()) { ?>
<?php $employment_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_status_list->ImportOptions->visible()) { ?>
<?php $employment_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_status_list->SearchOptions->visible()) { ?>
<?php $employment_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employment_status_list->FilterOptions->visible()) { ?>
<?php $employment_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employment_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employment_status_list->isExport() && !$employment_status->CurrentAction) { ?>
<form name="femployment_statuslistsrch" id="femployment_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployment_statuslistsrch-search-panel" class="<?php echo $employment_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employment_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employment_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employment_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employment_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employment_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employment_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employment_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employment_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employment_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employment_status_list->showPageHeader(); ?>
<?php
$employment_status_list->showMessage();
?>
<?php if ($employment_status_list->TotalRecords > 0 || $employment_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employment_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employment_status">
<?php if (!$employment_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employment_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployment_statuslist" id="femployment_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_status">
<div id="gmp_employment_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employment_status_list->TotalRecords > 0 || $employment_status_list->isAdd() || $employment_status_list->isCopy() || $employment_status_list->isGridEdit()) { ?>
<table id="tbl_employment_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employment_status->RowType = ROWTYPE_HEADER;

// Render list options
$employment_status_list->renderListOptions();

// Render list options (header, left)
$employment_status_list->ListOptions->render("header", "left");
?>
<?php if ($employment_status_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<?php if ($employment_status_list->SortUrl($employment_status_list->EmploymentStatus) == "") { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_status_list->EmploymentStatus->headerCellClass() ?>"><div id="elh_employment_status_EmploymentStatus" class="employment_status_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $employment_status_list->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_status_list->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_status_list->SortUrl($employment_status_list->EmploymentStatus) ?>', 1);"><div id="elh_employment_status_EmploymentStatus" class="employment_status_EmploymentStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_status_list->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_status_list->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_status_list->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_status_list->EmploymentStatusDesc->Visible) { // EmploymentStatusDesc ?>
	<?php if ($employment_status_list->SortUrl($employment_status_list->EmploymentStatusDesc) == "") { ?>
		<th data-name="EmploymentStatusDesc" class="<?php echo $employment_status_list->EmploymentStatusDesc->headerCellClass() ?>"><div id="elh_employment_status_EmploymentStatusDesc" class="employment_status_EmploymentStatusDesc"><div class="ew-table-header-caption"><?php echo $employment_status_list->EmploymentStatusDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentStatusDesc" class="<?php echo $employment_status_list->EmploymentStatusDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_status_list->SortUrl($employment_status_list->EmploymentStatusDesc) ?>', 1);"><div id="elh_employment_status_EmploymentStatusDesc" class="employment_status_EmploymentStatusDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_status_list->EmploymentStatusDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_status_list->EmploymentStatusDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_status_list->EmploymentStatusDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($employment_status_list->isAdd() || $employment_status_list->isCopy()) {
		$employment_status_list->RowIndex = 0;
		$employment_status_list->KeyCount = $employment_status_list->RowIndex;
		if ($employment_status_list->isAdd())
			$employment_status_list->loadRowValues();
		if ($employment_status->EventCancelled) // Insert failed
			$employment_status_list->restoreFormValues(); // Restore form values

		// Set row properties
		$employment_status->resetAttributes();
		$employment_status->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_employment_status", "data-rowtype" => ROWTYPE_ADD]);
		$employment_status->RowType = ROWTYPE_ADD;

		// Render row
		$employment_status_list->renderRow();

		// Render list options
		$employment_status_list->renderListOptions();
		$employment_status_list->StartRowCount = 0;
?>
	<tr <?php echo $employment_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_status_list->ListOptions->render("body", "left", $employment_status_list->RowCount);
?>
	<?php if ($employment_status_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus">
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatus" class="form-group employment_status_EmploymentStatus"></span>
<input type="hidden" data-table="employment_status" data-field="x_EmploymentStatus" name="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_status_list->EmploymentStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_status_list->EmploymentStatusDesc->Visible) { // EmploymentStatusDesc ?>
		<td data-name="EmploymentStatusDesc">
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatusDesc" class="form-group employment_status_EmploymentStatusDesc">
<input type="text" data-table="employment_status" data-field="x_EmploymentStatusDesc" name="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" id="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_status_list->EmploymentStatusDesc->getPlaceHolder()) ?>" value="<?php echo $employment_status_list->EmploymentStatusDesc->EditValue ?>"<?php echo $employment_status_list->EmploymentStatusDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_status" data-field="x_EmploymentStatusDesc" name="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" id="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" value="<?php echo HtmlEncode($employment_status_list->EmploymentStatusDesc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_status_list->ListOptions->render("body", "right", $employment_status_list->RowCount);
?>
<script>
loadjs.ready(["femployment_statuslist", "load"], function() {
	femployment_statuslist.updateLists(<?php echo $employment_status_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($employment_status_list->ExportAll && $employment_status_list->isExport()) {
	$employment_status_list->StopRecord = $employment_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employment_status_list->TotalRecords > $employment_status_list->StartRecord + $employment_status_list->DisplayRecords - 1)
		$employment_status_list->StopRecord = $employment_status_list->StartRecord + $employment_status_list->DisplayRecords - 1;
	else
		$employment_status_list->StopRecord = $employment_status_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employment_status->isConfirm() || $employment_status_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employment_status_list->FormKeyCountName) && ($employment_status_list->isGridAdd() || $employment_status_list->isGridEdit() || $employment_status->isConfirm())) {
		$employment_status_list->KeyCount = $CurrentForm->getValue($employment_status_list->FormKeyCountName);
		$employment_status_list->StopRecord = $employment_status_list->StartRecord + $employment_status_list->KeyCount - 1;
	}
}
$employment_status_list->RecordCount = $employment_status_list->StartRecord - 1;
if ($employment_status_list->Recordset && !$employment_status_list->Recordset->EOF) {
	$employment_status_list->Recordset->moveFirst();
	$selectLimit = $employment_status_list->UseSelectLimit;
	if (!$selectLimit && $employment_status_list->StartRecord > 1)
		$employment_status_list->Recordset->move($employment_status_list->StartRecord - 1);
} elseif (!$employment_status->AllowAddDeleteRow && $employment_status_list->StopRecord == 0) {
	$employment_status_list->StopRecord = $employment_status->GridAddRowCount;
}

// Initialize aggregate
$employment_status->RowType = ROWTYPE_AGGREGATEINIT;
$employment_status->resetAttributes();
$employment_status_list->renderRow();
$employment_status_list->EditRowCount = 0;
if ($employment_status_list->isEdit())
	$employment_status_list->RowIndex = 1;
if ($employment_status_list->isGridAdd())
	$employment_status_list->RowIndex = 0;
if ($employment_status_list->isGridEdit())
	$employment_status_list->RowIndex = 0;
while ($employment_status_list->RecordCount < $employment_status_list->StopRecord) {
	$employment_status_list->RecordCount++;
	if ($employment_status_list->RecordCount >= $employment_status_list->StartRecord) {
		$employment_status_list->RowCount++;
		if ($employment_status_list->isGridAdd() || $employment_status_list->isGridEdit() || $employment_status->isConfirm()) {
			$employment_status_list->RowIndex++;
			$CurrentForm->Index = $employment_status_list->RowIndex;
			if ($CurrentForm->hasValue($employment_status_list->FormActionName) && ($employment_status->isConfirm() || $employment_status_list->EventCancelled))
				$employment_status_list->RowAction = strval($CurrentForm->getValue($employment_status_list->FormActionName));
			elseif ($employment_status_list->isGridAdd())
				$employment_status_list->RowAction = "insert";
			else
				$employment_status_list->RowAction = "";
		}

		// Set up key count
		$employment_status_list->KeyCount = $employment_status_list->RowIndex;

		// Init row class and style
		$employment_status->resetAttributes();
		$employment_status->CssClass = "";
		if ($employment_status_list->isGridAdd()) {
			$employment_status_list->loadRowValues(); // Load default values
		} else {
			$employment_status_list->loadRowValues($employment_status_list->Recordset); // Load row values
		}
		$employment_status->RowType = ROWTYPE_VIEW; // Render view
		if ($employment_status_list->isGridAdd()) // Grid add
			$employment_status->RowType = ROWTYPE_ADD; // Render add
		if ($employment_status_list->isGridAdd() && $employment_status->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employment_status_list->restoreCurrentRowFormValues($employment_status_list->RowIndex); // Restore form values
		if ($employment_status_list->isEdit()) {
			if ($employment_status_list->checkInlineEditKey() && $employment_status_list->EditRowCount == 0) { // Inline edit
				$employment_status->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($employment_status_list->isGridEdit()) { // Grid edit
			if ($employment_status->EventCancelled)
				$employment_status_list->restoreCurrentRowFormValues($employment_status_list->RowIndex); // Restore form values
			if ($employment_status_list->RowAction == "insert")
				$employment_status->RowType = ROWTYPE_ADD; // Render add
			else
				$employment_status->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employment_status_list->isEdit() && $employment_status->RowType == ROWTYPE_EDIT && $employment_status->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$employment_status_list->restoreFormValues(); // Restore form values
		}
		if ($employment_status_list->isGridEdit() && ($employment_status->RowType == ROWTYPE_EDIT || $employment_status->RowType == ROWTYPE_ADD) && $employment_status->EventCancelled) // Update failed
			$employment_status_list->restoreCurrentRowFormValues($employment_status_list->RowIndex); // Restore form values
		if ($employment_status->RowType == ROWTYPE_EDIT) // Edit row
			$employment_status_list->EditRowCount++;

		// Set up row id / data-rowindex
		$employment_status->RowAttrs->merge(["data-rowindex" => $employment_status_list->RowCount, "id" => "r" . $employment_status_list->RowCount . "_employment_status", "data-rowtype" => $employment_status->RowType]);

		// Render row
		$employment_status_list->renderRow();

		// Render list options
		$employment_status_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employment_status_list->RowAction != "delete" && $employment_status_list->RowAction != "insertdelete" && !($employment_status_list->RowAction == "insert" && $employment_status->isConfirm() && $employment_status_list->emptyRow())) {
?>
	<tr <?php echo $employment_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_status_list->ListOptions->render("body", "left", $employment_status_list->RowCount);
?>
	<?php if ($employment_status_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus" <?php echo $employment_status_list->EmploymentStatus->cellAttributes() ?>>
<?php if ($employment_status->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatus" class="form-group"></span>
<input type="hidden" data-table="employment_status" data-field="x_EmploymentStatus" name="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_status_list->EmploymentStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment_status->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatus" class="form-group">
<span<?php echo $employment_status_list->EmploymentStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_status_list->EmploymentStatus->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="employment_status" data-field="x_EmploymentStatus" name="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" id="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_status_list->EmploymentStatus->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_status->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatus">
<span<?php echo $employment_status_list->EmploymentStatus->viewAttributes() ?>><?php echo $employment_status_list->EmploymentStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_status_list->EmploymentStatusDesc->Visible) { // EmploymentStatusDesc ?>
		<td data-name="EmploymentStatusDesc" <?php echo $employment_status_list->EmploymentStatusDesc->cellAttributes() ?>>
<?php if ($employment_status->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatusDesc" class="form-group">
<input type="text" data-table="employment_status" data-field="x_EmploymentStatusDesc" name="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" id="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_status_list->EmploymentStatusDesc->getPlaceHolder()) ?>" value="<?php echo $employment_status_list->EmploymentStatusDesc->EditValue ?>"<?php echo $employment_status_list->EmploymentStatusDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_status" data-field="x_EmploymentStatusDesc" name="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" id="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" value="<?php echo HtmlEncode($employment_status_list->EmploymentStatusDesc->OldValue) ?>">
<?php } ?>
<?php if ($employment_status->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatusDesc" class="form-group">
<input type="text" data-table="employment_status" data-field="x_EmploymentStatusDesc" name="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" id="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_status_list->EmploymentStatusDesc->getPlaceHolder()) ?>" value="<?php echo $employment_status_list->EmploymentStatusDesc->EditValue ?>"<?php echo $employment_status_list->EmploymentStatusDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_status->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_status_list->RowCount ?>_employment_status_EmploymentStatusDesc">
<span<?php echo $employment_status_list->EmploymentStatusDesc->viewAttributes() ?>><?php echo $employment_status_list->EmploymentStatusDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_status_list->ListOptions->render("body", "right", $employment_status_list->RowCount);
?>
	</tr>
<?php if ($employment_status->RowType == ROWTYPE_ADD || $employment_status->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployment_statuslist", "load"], function() {
	femployment_statuslist.updateLists(<?php echo $employment_status_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employment_status_list->isGridAdd())
		if (!$employment_status_list->Recordset->EOF)
			$employment_status_list->Recordset->moveNext();
}
?>
<?php
	if ($employment_status_list->isGridAdd() || $employment_status_list->isGridEdit()) {
		$employment_status_list->RowIndex = '$rowindex$';
		$employment_status_list->loadRowValues();

		// Set row properties
		$employment_status->resetAttributes();
		$employment_status->RowAttrs->merge(["data-rowindex" => $employment_status_list->RowIndex, "id" => "r0_employment_status", "data-rowtype" => ROWTYPE_ADD]);
		$employment_status->RowAttrs->appendClass("ew-template");
		$employment_status->RowType = ROWTYPE_ADD;

		// Render row
		$employment_status_list->renderRow();

		// Render list options
		$employment_status_list->renderListOptions();
		$employment_status_list->StartRowCount = 0;
?>
	<tr <?php echo $employment_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_status_list->ListOptions->render("body", "left", $employment_status_list->RowIndex);
?>
	<?php if ($employment_status_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus">
<span id="el$rowindex$_employment_status_EmploymentStatus" class="form-group employment_status_EmploymentStatus"></span>
<input type="hidden" data-table="employment_status" data-field="x_EmploymentStatus" name="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_status_list->EmploymentStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_status_list->EmploymentStatusDesc->Visible) { // EmploymentStatusDesc ?>
		<td data-name="EmploymentStatusDesc">
<span id="el$rowindex$_employment_status_EmploymentStatusDesc" class="form-group employment_status_EmploymentStatusDesc">
<input type="text" data-table="employment_status" data-field="x_EmploymentStatusDesc" name="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" id="x<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_status_list->EmploymentStatusDesc->getPlaceHolder()) ?>" value="<?php echo $employment_status_list->EmploymentStatusDesc->EditValue ?>"<?php echo $employment_status_list->EmploymentStatusDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_status" data-field="x_EmploymentStatusDesc" name="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" id="o<?php echo $employment_status_list->RowIndex ?>_EmploymentStatusDesc" value="<?php echo HtmlEncode($employment_status_list->EmploymentStatusDesc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_status_list->ListOptions->render("body", "right", $employment_status_list->RowIndex);
?>
<script>
loadjs.ready(["femployment_statuslist", "load"], function() {
	femployment_statuslist.updateLists(<?php echo $employment_status_list->RowIndex ?>);
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
<?php if ($employment_status_list->isAdd() || $employment_status_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $employment_status_list->FormKeyCountName ?>" id="<?php echo $employment_status_list->FormKeyCountName ?>" value="<?php echo $employment_status_list->KeyCount ?>">
<?php } ?>
<?php if ($employment_status_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employment_status_list->FormKeyCountName ?>" id="<?php echo $employment_status_list->FormKeyCountName ?>" value="<?php echo $employment_status_list->KeyCount ?>">
<?php echo $employment_status_list->MultiSelectKey ?>
<?php } ?>
<?php if ($employment_status_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $employment_status_list->FormKeyCountName ?>" id="<?php echo $employment_status_list->FormKeyCountName ?>" value="<?php echo $employment_status_list->KeyCount ?>">
<?php } ?>
<?php if ($employment_status_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $employment_status_list->FormKeyCountName ?>" id="<?php echo $employment_status_list->FormKeyCountName ?>" value="<?php echo $employment_status_list->KeyCount ?>">
<?php echo $employment_status_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employment_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employment_status_list->Recordset)
	$employment_status_list->Recordset->Close();
?>
<?php if (!$employment_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employment_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employment_status_list->TotalRecords == 0 && !$employment_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employment_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employment_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_status_list->isExport()) { ?>
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
$employment_status_list->terminate();
?>