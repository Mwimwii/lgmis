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
$pillars_list = new pillars_list();

// Run the page
$pillars_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pillars_list->isExport()) { ?>
<script>
var fpillarslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpillarslist = currentForm = new ew.Form("fpillarslist", "list");
	fpillarslist.formKeyCountName = '<?php echo $pillars_list->FormKeyCountName ?>';

	// Validate form
	fpillarslist.validate = function() {
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
			<?php if ($pillars_list->NDP->Required) { ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_list->NDP->caption(), $pillars_list->NDP->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NDP");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_list->NDP->errorMessage()) ?>");
			<?php if ($pillars_list->PillarNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_list->PillarNo->caption(), $pillars_list->PillarNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PillarNo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pillars_list->PillarNo->errorMessage()) ?>");
			<?php if ($pillars_list->PillarName->Required) { ?>
				elm = this.getElements("x" + infix + "_PillarName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pillars_list->PillarName->caption(), $pillars_list->PillarName->RequiredErrorMessage)) ?>");
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
	fpillarslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "NDP", false)) return false;
		if (ew.valueChanged(fobj, infix, "PillarNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "PillarName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpillarslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpillarslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpillarslist");
});
var fpillarslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpillarslistsrch = currentSearchForm = new ew.Form("fpillarslistsrch");

	// Dynamic selection lists
	// Filters

	fpillarslistsrch.filterList = <?php echo $pillars_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpillarslistsrch.initSearchPanel = true;
	loadjs.done("fpillarslistsrch");
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
<?php if (!$pillars_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pillars_list->TotalRecords > 0 && $pillars_list->ExportOptions->visible()) { ?>
<?php $pillars_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pillars_list->ImportOptions->visible()) { ?>
<?php $pillars_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pillars_list->SearchOptions->visible()) { ?>
<?php $pillars_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pillars_list->FilterOptions->visible()) { ?>
<?php $pillars_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$pillars_list->isExport() || Config("EXPORT_MASTER_RECORD") && $pillars_list->isExport("print")) { ?>
<?php
if ($pillars_list->DbMasterFilter != "" && $pillars->getCurrentMasterTable() == "ndp") {
	if ($pillars_list->MasterRecordExists) {
		include_once "ndpmaster.php";
	}
}
?>
<?php } ?>
<?php
$pillars_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pillars_list->isExport() && !$pillars->CurrentAction) { ?>
<form name="fpillarslistsrch" id="fpillarslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpillarslistsrch-search-panel" class="<?php echo $pillars_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pillars">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pillars_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pillars_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pillars_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pillars_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pillars_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pillars_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pillars_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pillars_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pillars_list->showPageHeader(); ?>
<?php
$pillars_list->showMessage();
?>
<?php if ($pillars_list->TotalRecords > 0 || $pillars->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pillars_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pillars">
<?php if (!$pillars_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pillars_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pillars_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pillars_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpillarslist" id="fpillarslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pillars">
<?php if ($pillars->getCurrentMasterTable() == "ndp" && $pillars->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ndp">
<input type="hidden" name="fk_NDP" value="<?php echo HtmlEncode($pillars_list->NDP->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_pillars" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pillars_list->TotalRecords > 0 || $pillars_list->isGridEdit()) { ?>
<table id="tbl_pillarslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pillars->RowType = ROWTYPE_HEADER;

// Render list options
$pillars_list->renderListOptions();

// Render list options (header, left)
$pillars_list->ListOptions->render("header", "left");
?>
<?php if ($pillars_list->NDP->Visible) { // NDP ?>
	<?php if ($pillars_list->SortUrl($pillars_list->NDP) == "") { ?>
		<th data-name="NDP" class="<?php echo $pillars_list->NDP->headerCellClass() ?>"><div id="elh_pillars_NDP" class="pillars_NDP"><div class="ew-table-header-caption"><?php echo $pillars_list->NDP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NDP" class="<?php echo $pillars_list->NDP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pillars_list->SortUrl($pillars_list->NDP) ?>', 1);"><div id="elh_pillars_NDP" class="pillars_NDP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_list->NDP->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_list->NDP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_list->NDP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pillars_list->PillarNo->Visible) { // PillarNo ?>
	<?php if ($pillars_list->SortUrl($pillars_list->PillarNo) == "") { ?>
		<th data-name="PillarNo" class="<?php echo $pillars_list->PillarNo->headerCellClass() ?>"><div id="elh_pillars_PillarNo" class="pillars_PillarNo"><div class="ew-table-header-caption"><?php echo $pillars_list->PillarNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PillarNo" class="<?php echo $pillars_list->PillarNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pillars_list->SortUrl($pillars_list->PillarNo) ?>', 1);"><div id="elh_pillars_PillarNo" class="pillars_PillarNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_list->PillarNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_list->PillarNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_list->PillarNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pillars_list->PillarName->Visible) { // PillarName ?>
	<?php if ($pillars_list->SortUrl($pillars_list->PillarName) == "") { ?>
		<th data-name="PillarName" class="<?php echo $pillars_list->PillarName->headerCellClass() ?>"><div id="elh_pillars_PillarName" class="pillars_PillarName"><div class="ew-table-header-caption"><?php echo $pillars_list->PillarName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PillarName" class="<?php echo $pillars_list->PillarName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pillars_list->SortUrl($pillars_list->PillarName) ?>', 1);"><div id="elh_pillars_PillarName" class="pillars_PillarName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_list->PillarName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pillars_list->PillarName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_list->PillarName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pillars_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pillars_list->ExportAll && $pillars_list->isExport()) {
	$pillars_list->StopRecord = $pillars_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pillars_list->TotalRecords > $pillars_list->StartRecord + $pillars_list->DisplayRecords - 1)
		$pillars_list->StopRecord = $pillars_list->StartRecord + $pillars_list->DisplayRecords - 1;
	else
		$pillars_list->StopRecord = $pillars_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($pillars->isConfirm() || $pillars_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($pillars_list->FormKeyCountName) && ($pillars_list->isGridAdd() || $pillars_list->isGridEdit() || $pillars->isConfirm())) {
		$pillars_list->KeyCount = $CurrentForm->getValue($pillars_list->FormKeyCountName);
		$pillars_list->StopRecord = $pillars_list->StartRecord + $pillars_list->KeyCount - 1;
	}
}
$pillars_list->RecordCount = $pillars_list->StartRecord - 1;
if ($pillars_list->Recordset && !$pillars_list->Recordset->EOF) {
	$pillars_list->Recordset->moveFirst();
	$selectLimit = $pillars_list->UseSelectLimit;
	if (!$selectLimit && $pillars_list->StartRecord > 1)
		$pillars_list->Recordset->move($pillars_list->StartRecord - 1);
} elseif (!$pillars->AllowAddDeleteRow && $pillars_list->StopRecord == 0) {
	$pillars_list->StopRecord = $pillars->GridAddRowCount;
}

// Initialize aggregate
$pillars->RowType = ROWTYPE_AGGREGATEINIT;
$pillars->resetAttributes();
$pillars_list->renderRow();
if ($pillars_list->isGridAdd())
	$pillars_list->RowIndex = 0;
if ($pillars_list->isGridEdit())
	$pillars_list->RowIndex = 0;
while ($pillars_list->RecordCount < $pillars_list->StopRecord) {
	$pillars_list->RecordCount++;
	if ($pillars_list->RecordCount >= $pillars_list->StartRecord) {
		$pillars_list->RowCount++;
		if ($pillars_list->isGridAdd() || $pillars_list->isGridEdit() || $pillars->isConfirm()) {
			$pillars_list->RowIndex++;
			$CurrentForm->Index = $pillars_list->RowIndex;
			if ($CurrentForm->hasValue($pillars_list->FormActionName) && ($pillars->isConfirm() || $pillars_list->EventCancelled))
				$pillars_list->RowAction = strval($CurrentForm->getValue($pillars_list->FormActionName));
			elseif ($pillars_list->isGridAdd())
				$pillars_list->RowAction = "insert";
			else
				$pillars_list->RowAction = "";
		}

		// Set up key count
		$pillars_list->KeyCount = $pillars_list->RowIndex;

		// Init row class and style
		$pillars->resetAttributes();
		$pillars->CssClass = "";
		if ($pillars_list->isGridAdd()) {
			$pillars_list->loadRowValues(); // Load default values
		} else {
			$pillars_list->loadRowValues($pillars_list->Recordset); // Load row values
		}
		$pillars->RowType = ROWTYPE_VIEW; // Render view
		if ($pillars_list->isGridAdd()) // Grid add
			$pillars->RowType = ROWTYPE_ADD; // Render add
		if ($pillars_list->isGridAdd() && $pillars->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$pillars_list->restoreCurrentRowFormValues($pillars_list->RowIndex); // Restore form values
		if ($pillars_list->isGridEdit()) { // Grid edit
			if ($pillars->EventCancelled)
				$pillars_list->restoreCurrentRowFormValues($pillars_list->RowIndex); // Restore form values
			if ($pillars_list->RowAction == "insert")
				$pillars->RowType = ROWTYPE_ADD; // Render add
			else
				$pillars->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($pillars_list->isGridEdit() && ($pillars->RowType == ROWTYPE_EDIT || $pillars->RowType == ROWTYPE_ADD) && $pillars->EventCancelled) // Update failed
			$pillars_list->restoreCurrentRowFormValues($pillars_list->RowIndex); // Restore form values
		if ($pillars->RowType == ROWTYPE_EDIT) // Edit row
			$pillars_list->EditRowCount++;

		// Set up row id / data-rowindex
		$pillars->RowAttrs->merge(["data-rowindex" => $pillars_list->RowCount, "id" => "r" . $pillars_list->RowCount . "_pillars", "data-rowtype" => $pillars->RowType]);

		// Render row
		$pillars_list->renderRow();

		// Render list options
		$pillars_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($pillars_list->RowAction != "delete" && $pillars_list->RowAction != "insertdelete" && !($pillars_list->RowAction == "insert" && $pillars->isConfirm() && $pillars_list->emptyRow())) {
?>
	<tr <?php echo $pillars->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pillars_list->ListOptions->render("body", "left", $pillars_list->RowCount);
?>
	<?php if ($pillars_list->NDP->Visible) { // NDP ?>
		<td data-name="NDP" <?php echo $pillars_list->NDP->cellAttributes() ?>>
<?php if ($pillars->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($pillars_list->NDP->getSessionValue() != "") { ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_NDP" class="form-group">
<span<?php echo $pillars_list->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_list->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pillars_list->RowIndex ?>_NDP" name="x<?php echo $pillars_list->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_list->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_NDP" class="form-group">
<input type="text" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_list->RowIndex ?>_NDP" id="x<?php echo $pillars_list->RowIndex ?>_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_list->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_list->NDP->EditValue ?>"<?php echo $pillars_list->NDP->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pillars" data-field="x_NDP" name="o<?php echo $pillars_list->RowIndex ?>_NDP" id="o<?php echo $pillars_list->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_list->NDP->OldValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($pillars_list->NDP->getSessionValue() != "") { ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_NDP" class="form-group">
<span<?php echo $pillars_list->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_list->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pillars_list->RowIndex ?>_NDP" name="x<?php echo $pillars_list->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_list->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_NDP" class="form-group">
<input type="text" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_list->RowIndex ?>_NDP" id="x<?php echo $pillars_list->RowIndex ?>_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_list->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_list->NDP->EditValue ?>"<?php echo $pillars_list->NDP->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_NDP">
<span<?php echo $pillars_list->NDP->viewAttributes() ?>><?php echo $pillars_list->NDP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pillars_list->PillarNo->Visible) { // PillarNo ?>
		<td data-name="PillarNo" <?php echo $pillars_list->PillarNo->cellAttributes() ?>>
<?php if ($pillars->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_PillarNo" class="form-group">
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_list->RowIndex ?>_PillarNo" id="x<?php echo $pillars_list->RowIndex ?>_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_list->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_list->PillarNo->EditValue ?>"<?php echo $pillars_list->PillarNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o<?php echo $pillars_list->RowIndex ?>_PillarNo" id="o<?php echo $pillars_list->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_list->PillarNo->OldValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_list->RowIndex ?>_PillarNo" id="x<?php echo $pillars_list->RowIndex ?>_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_list->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_list->PillarNo->EditValue ?>"<?php echo $pillars_list->PillarNo->editAttributes() ?>>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o<?php echo $pillars_list->RowIndex ?>_PillarNo" id="o<?php echo $pillars_list->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_list->PillarNo->OldValue != null ? $pillars_list->PillarNo->OldValue : $pillars_list->PillarNo->CurrentValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_PillarNo">
<span<?php echo $pillars_list->PillarNo->viewAttributes() ?>><?php echo $pillars_list->PillarNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pillars_list->PillarName->Visible) { // PillarName ?>
		<td data-name="PillarName" <?php echo $pillars_list->PillarName->cellAttributes() ?>>
<?php if ($pillars->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_PillarName" class="form-group">
<textarea data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_list->RowIndex ?>_PillarName" id="x<?php echo $pillars_list->RowIndex ?>_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_list->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_list->PillarName->editAttributes() ?>><?php echo $pillars_list->PillarName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="o<?php echo $pillars_list->RowIndex ?>_PillarName" id="o<?php echo $pillars_list->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_list->PillarName->OldValue) ?>">
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_PillarName" class="form-group">
<textarea data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_list->RowIndex ?>_PillarName" id="x<?php echo $pillars_list->RowIndex ?>_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_list->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_list->PillarName->editAttributes() ?>><?php echo $pillars_list->PillarName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($pillars->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pillars_list->RowCount ?>_pillars_PillarName">
<span<?php echo $pillars_list->PillarName->viewAttributes() ?>><?php echo $pillars_list->PillarName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pillars_list->ListOptions->render("body", "right", $pillars_list->RowCount);
?>
	</tr>
<?php if ($pillars->RowType == ROWTYPE_ADD || $pillars->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpillarslist", "load"], function() {
	fpillarslist.updateLists(<?php echo $pillars_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$pillars_list->isGridAdd())
		if (!$pillars_list->Recordset->EOF)
			$pillars_list->Recordset->moveNext();
}
?>
<?php
	if ($pillars_list->isGridAdd() || $pillars_list->isGridEdit()) {
		$pillars_list->RowIndex = '$rowindex$';
		$pillars_list->loadRowValues();

		// Set row properties
		$pillars->resetAttributes();
		$pillars->RowAttrs->merge(["data-rowindex" => $pillars_list->RowIndex, "id" => "r0_pillars", "data-rowtype" => ROWTYPE_ADD]);
		$pillars->RowAttrs->appendClass("ew-template");
		$pillars->RowType = ROWTYPE_ADD;

		// Render row
		$pillars_list->renderRow();

		// Render list options
		$pillars_list->renderListOptions();
		$pillars_list->StartRowCount = 0;
?>
	<tr <?php echo $pillars->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pillars_list->ListOptions->render("body", "left", $pillars_list->RowIndex);
?>
	<?php if ($pillars_list->NDP->Visible) { // NDP ?>
		<td data-name="NDP">
<?php if ($pillars_list->NDP->getSessionValue() != "") { ?>
<span id="el$rowindex$_pillars_NDP" class="form-group pillars_NDP">
<span<?php echo $pillars_list->NDP->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pillars_list->NDP->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pillars_list->RowIndex ?>_NDP" name="x<?php echo $pillars_list->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_list->NDP->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pillars_NDP" class="form-group pillars_NDP">
<input type="text" data-table="pillars" data-field="x_NDP" name="x<?php echo $pillars_list->RowIndex ?>_NDP" id="x<?php echo $pillars_list->RowIndex ?>_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_list->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_list->NDP->EditValue ?>"<?php echo $pillars_list->NDP->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pillars" data-field="x_NDP" name="o<?php echo $pillars_list->RowIndex ?>_NDP" id="o<?php echo $pillars_list->RowIndex ?>_NDP" value="<?php echo HtmlEncode($pillars_list->NDP->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pillars_list->PillarNo->Visible) { // PillarNo ?>
		<td data-name="PillarNo">
<span id="el$rowindex$_pillars_PillarNo" class="form-group pillars_PillarNo">
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x<?php echo $pillars_list->RowIndex ?>_PillarNo" id="x<?php echo $pillars_list->RowIndex ?>_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_list->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_list->PillarNo->EditValue ?>"<?php echo $pillars_list->PillarNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarNo" name="o<?php echo $pillars_list->RowIndex ?>_PillarNo" id="o<?php echo $pillars_list->RowIndex ?>_PillarNo" value="<?php echo HtmlEncode($pillars_list->PillarNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pillars_list->PillarName->Visible) { // PillarName ?>
		<td data-name="PillarName">
<span id="el$rowindex$_pillars_PillarName" class="form-group pillars_PillarName">
<textarea data-table="pillars" data-field="x_PillarName" name="x<?php echo $pillars_list->RowIndex ?>_PillarName" id="x<?php echo $pillars_list->RowIndex ?>_PillarName" cols="35" rows="2" placeholder="<?php echo HtmlEncode($pillars_list->PillarName->getPlaceHolder()) ?>"<?php echo $pillars_list->PillarName->editAttributes() ?>><?php echo $pillars_list->PillarName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="pillars" data-field="x_PillarName" name="o<?php echo $pillars_list->RowIndex ?>_PillarName" id="o<?php echo $pillars_list->RowIndex ?>_PillarName" value="<?php echo HtmlEncode($pillars_list->PillarName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pillars_list->ListOptions->render("body", "right", $pillars_list->RowIndex);
?>
<script>
loadjs.ready(["fpillarslist", "load"], function() {
	fpillarslist.updateLists(<?php echo $pillars_list->RowIndex ?>);
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
<?php if ($pillars_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $pillars_list->FormKeyCountName ?>" id="<?php echo $pillars_list->FormKeyCountName ?>" value="<?php echo $pillars_list->KeyCount ?>">
<?php echo $pillars_list->MultiSelectKey ?>
<?php } ?>
<?php if ($pillars_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $pillars_list->FormKeyCountName ?>" id="<?php echo $pillars_list->FormKeyCountName ?>" value="<?php echo $pillars_list->KeyCount ?>">
<?php echo $pillars_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$pillars->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pillars_list->Recordset)
	$pillars_list->Recordset->Close();
?>
<?php if (!$pillars_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pillars_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pillars_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pillars_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pillars_list->TotalRecords == 0 && !$pillars->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pillars_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pillars_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pillars_list->isExport()) { ?>
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
$pillars_list->terminate();
?>