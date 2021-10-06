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
$qualification_list = new qualification_list();

// Run the page
$qualification_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualification_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$qualification_list->isExport()) { ?>
<script>
var fqualificationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fqualificationlist = currentForm = new ew.Form("fqualificationlist", "list");
	fqualificationlist.formKeyCountName = '<?php echo $qualification_list->FormKeyCountName ?>';

	// Validate form
	fqualificationlist.validate = function() {
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
			<?php if ($qualification_list->QualificationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_list->QualificationCode->caption(), $qualification_list->QualificationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($qualification_list->QualificationName->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_list->QualificationName->caption(), $qualification_list->QualificationName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($qualification_list->QualificationType->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_list->QualificationType->caption(), $qualification_list->QualificationType->RequiredErrorMessage)) ?>");
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
	fqualificationlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "QualificationName", false)) return false;
		if (ew.valueChanged(fobj, infix, "QualificationType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fqualificationlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fqualificationlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fqualificationlist.lists["x_QualificationType"] = <?php echo $qualification_list->QualificationType->Lookup->toClientList($qualification_list) ?>;
	fqualificationlist.lists["x_QualificationType"].options = <?php echo JsonEncode($qualification_list->QualificationType->lookupOptions()) ?>;
	loadjs.done("fqualificationlist");
});
var fqualificationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fqualificationlistsrch = currentSearchForm = new ew.Form("fqualificationlistsrch");

	// Dynamic selection lists
	// Filters

	fqualificationlistsrch.filterList = <?php echo $qualification_list->getFilterList() ?>;

	// Init search panel as collapsed
	fqualificationlistsrch.initSearchPanel = true;
	loadjs.done("fqualificationlistsrch");
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
<?php if (!$qualification_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($qualification_list->TotalRecords > 0 && $qualification_list->ExportOptions->visible()) { ?>
<?php $qualification_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($qualification_list->ImportOptions->visible()) { ?>
<?php $qualification_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($qualification_list->SearchOptions->visible()) { ?>
<?php $qualification_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($qualification_list->FilterOptions->visible()) { ?>
<?php $qualification_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$qualification_list->isExport() || Config("EXPORT_MASTER_RECORD") && $qualification_list->isExport("print")) { ?>
<?php
if ($qualification_list->DbMasterFilter != "" && $qualification->getCurrentMasterTable() == "qualification_type") {
	if ($qualification_list->MasterRecordExists) {
		include_once "qualification_typemaster.php";
	}
}
?>
<?php } ?>
<?php
$qualification_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$qualification_list->isExport() && !$qualification->CurrentAction) { ?>
<form name="fqualificationlistsrch" id="fqualificationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fqualificationlistsrch-search-panel" class="<?php echo $qualification_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="qualification">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $qualification_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($qualification_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($qualification_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $qualification_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($qualification_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($qualification_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($qualification_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($qualification_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $qualification_list->showPageHeader(); ?>
<?php
$qualification_list->showMessage();
?>
<?php if ($qualification_list->TotalRecords > 0 || $qualification->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($qualification_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> qualification">
<?php if (!$qualification_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$qualification_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualification_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualification_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fqualificationlist" id="fqualificationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualification">
<?php if ($qualification->getCurrentMasterTable() == "qualification_type" && $qualification->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="qualification_type">
<input type="hidden" name="fk_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_qualification" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($qualification_list->TotalRecords > 0 || $qualification_list->isAdd() || $qualification_list->isCopy() || $qualification_list->isGridEdit()) { ?>
<table id="tbl_qualificationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$qualification->RowType = ROWTYPE_HEADER;

// Render list options
$qualification_list->renderListOptions();

// Render list options (header, left)
$qualification_list->ListOptions->render("header", "left");
?>
<?php if ($qualification_list->QualificationCode->Visible) { // QualificationCode ?>
	<?php if ($qualification_list->SortUrl($qualification_list->QualificationCode) == "") { ?>
		<th data-name="QualificationCode" class="<?php echo $qualification_list->QualificationCode->headerCellClass() ?>"><div id="elh_qualification_QualificationCode" class="qualification_QualificationCode"><div class="ew-table-header-caption"><?php echo $qualification_list->QualificationCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationCode" class="<?php echo $qualification_list->QualificationCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $qualification_list->SortUrl($qualification_list->QualificationCode) ?>', 1);"><div id="elh_qualification_QualificationCode" class="qualification_QualificationCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_list->QualificationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_list->QualificationCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_list->QualificationCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($qualification_list->QualificationName->Visible) { // QualificationName ?>
	<?php if ($qualification_list->SortUrl($qualification_list->QualificationName) == "") { ?>
		<th data-name="QualificationName" class="<?php echo $qualification_list->QualificationName->headerCellClass() ?>"><div id="elh_qualification_QualificationName" class="qualification_QualificationName"><div class="ew-table-header-caption"><?php echo $qualification_list->QualificationName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationName" class="<?php echo $qualification_list->QualificationName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $qualification_list->SortUrl($qualification_list->QualificationName) ?>', 1);"><div id="elh_qualification_QualificationName" class="qualification_QualificationName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_list->QualificationName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($qualification_list->QualificationName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_list->QualificationName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($qualification_list->QualificationType->Visible) { // QualificationType ?>
	<?php if ($qualification_list->SortUrl($qualification_list->QualificationType) == "") { ?>
		<th data-name="QualificationType" class="<?php echo $qualification_list->QualificationType->headerCellClass() ?>"><div id="elh_qualification_QualificationType" class="qualification_QualificationType"><div class="ew-table-header-caption"><?php echo $qualification_list->QualificationType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationType" class="<?php echo $qualification_list->QualificationType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $qualification_list->SortUrl($qualification_list->QualificationType) ?>', 1);"><div id="elh_qualification_QualificationType" class="qualification_QualificationType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_list->QualificationType->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_list->QualificationType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_list->QualificationType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$qualification_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($qualification_list->isAdd() || $qualification_list->isCopy()) {
		$qualification_list->RowIndex = 0;
		$qualification_list->KeyCount = $qualification_list->RowIndex;
		if ($qualification_list->isAdd())
			$qualification_list->loadRowValues();
		if ($qualification->EventCancelled) // Insert failed
			$qualification_list->restoreFormValues(); // Restore form values

		// Set row properties
		$qualification->resetAttributes();
		$qualification->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_qualification", "data-rowtype" => ROWTYPE_ADD]);
		$qualification->RowType = ROWTYPE_ADD;

		// Render row
		$qualification_list->renderRow();

		// Render list options
		$qualification_list->renderListOptions();
		$qualification_list->StartRowCount = 0;
?>
	<tr <?php echo $qualification->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_list->ListOptions->render("body", "left", $qualification_list->RowCount);
?>
	<?php if ($qualification_list->QualificationCode->Visible) { // QualificationCode ?>
		<td data-name="QualificationCode">
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationCode" class="form-group qualification_QualificationCode"></span>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="o<?php echo $qualification_list->RowIndex ?>_QualificationCode" id="o<?php echo $qualification_list->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_list->QualificationCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($qualification_list->QualificationName->Visible) { // QualificationName ?>
		<td data-name="QualificationName">
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationName" class="form-group qualification_QualificationName">
<input type="text" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_list->RowIndex ?>_QualificationName" id="x<?php echo $qualification_list->RowIndex ?>_QualificationName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($qualification_list->QualificationName->getPlaceHolder()) ?>" value="<?php echo $qualification_list->QualificationName->EditValue ?>"<?php echo $qualification_list->QualificationName->editAttributes() ?>>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="o<?php echo $qualification_list->RowIndex ?>_QualificationName" id="o<?php echo $qualification_list->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_list->QualificationName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($qualification_list->QualificationType->Visible) { // QualificationType ?>
		<td data-name="QualificationType">
<?php if ($qualification_list->QualificationType->getSessionValue() != "") { ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationType" class="form-group qualification_QualificationType">
<span<?php echo $qualification_list->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_list->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationType" class="form-group qualification_QualificationType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="qualification" data-field="x_QualificationType" data-value-separator="<?php echo $qualification_list->QualificationType->displayValueSeparatorAttribute() ?>" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType"<?php echo $qualification_list->QualificationType->editAttributes() ?>>
			<?php echo $qualification_list->QualificationType->selectOptionListHtml("x{$qualification_list->RowIndex}_QualificationType") ?>
		</select>
</div>
<?php echo $qualification_list->QualificationType->Lookup->getParamTag($qualification_list, "p_x" . $qualification_list->RowIndex . "_QualificationType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="o<?php echo $qualification_list->RowIndex ?>_QualificationType" id="o<?php echo $qualification_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualification_list->ListOptions->render("body", "right", $qualification_list->RowCount);
?>
<script>
loadjs.ready(["fqualificationlist", "load"], function() {
	fqualificationlist.updateLists(<?php echo $qualification_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($qualification_list->ExportAll && $qualification_list->isExport()) {
	$qualification_list->StopRecord = $qualification_list->TotalRecords;
} else {

	// Set the last record to display
	if ($qualification_list->TotalRecords > $qualification_list->StartRecord + $qualification_list->DisplayRecords - 1)
		$qualification_list->StopRecord = $qualification_list->StartRecord + $qualification_list->DisplayRecords - 1;
	else
		$qualification_list->StopRecord = $qualification_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($qualification->isConfirm() || $qualification_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($qualification_list->FormKeyCountName) && ($qualification_list->isGridAdd() || $qualification_list->isGridEdit() || $qualification->isConfirm())) {
		$qualification_list->KeyCount = $CurrentForm->getValue($qualification_list->FormKeyCountName);
		$qualification_list->StopRecord = $qualification_list->StartRecord + $qualification_list->KeyCount - 1;
	}
}
$qualification_list->RecordCount = $qualification_list->StartRecord - 1;
if ($qualification_list->Recordset && !$qualification_list->Recordset->EOF) {
	$qualification_list->Recordset->moveFirst();
	$selectLimit = $qualification_list->UseSelectLimit;
	if (!$selectLimit && $qualification_list->StartRecord > 1)
		$qualification_list->Recordset->move($qualification_list->StartRecord - 1);
} elseif (!$qualification->AllowAddDeleteRow && $qualification_list->StopRecord == 0) {
	$qualification_list->StopRecord = $qualification->GridAddRowCount;
}

// Initialize aggregate
$qualification->RowType = ROWTYPE_AGGREGATEINIT;
$qualification->resetAttributes();
$qualification_list->renderRow();
$qualification_list->EditRowCount = 0;
if ($qualification_list->isEdit())
	$qualification_list->RowIndex = 1;
if ($qualification_list->isGridAdd())
	$qualification_list->RowIndex = 0;
if ($qualification_list->isGridEdit())
	$qualification_list->RowIndex = 0;
while ($qualification_list->RecordCount < $qualification_list->StopRecord) {
	$qualification_list->RecordCount++;
	if ($qualification_list->RecordCount >= $qualification_list->StartRecord) {
		$qualification_list->RowCount++;
		if ($qualification_list->isGridAdd() || $qualification_list->isGridEdit() || $qualification->isConfirm()) {
			$qualification_list->RowIndex++;
			$CurrentForm->Index = $qualification_list->RowIndex;
			if ($CurrentForm->hasValue($qualification_list->FormActionName) && ($qualification->isConfirm() || $qualification_list->EventCancelled))
				$qualification_list->RowAction = strval($CurrentForm->getValue($qualification_list->FormActionName));
			elseif ($qualification_list->isGridAdd())
				$qualification_list->RowAction = "insert";
			else
				$qualification_list->RowAction = "";
		}

		// Set up key count
		$qualification_list->KeyCount = $qualification_list->RowIndex;

		// Init row class and style
		$qualification->resetAttributes();
		$qualification->CssClass = "";
		if ($qualification_list->isGridAdd()) {
			$qualification_list->loadRowValues(); // Load default values
		} else {
			$qualification_list->loadRowValues($qualification_list->Recordset); // Load row values
		}
		$qualification->RowType = ROWTYPE_VIEW; // Render view
		if ($qualification_list->isGridAdd()) // Grid add
			$qualification->RowType = ROWTYPE_ADD; // Render add
		if ($qualification_list->isGridAdd() && $qualification->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$qualification_list->restoreCurrentRowFormValues($qualification_list->RowIndex); // Restore form values
		if ($qualification_list->isEdit()) {
			if ($qualification_list->checkInlineEditKey() && $qualification_list->EditRowCount == 0) { // Inline edit
				$qualification->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($qualification_list->isGridEdit()) { // Grid edit
			if ($qualification->EventCancelled)
				$qualification_list->restoreCurrentRowFormValues($qualification_list->RowIndex); // Restore form values
			if ($qualification_list->RowAction == "insert")
				$qualification->RowType = ROWTYPE_ADD; // Render add
			else
				$qualification->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($qualification_list->isEdit() && $qualification->RowType == ROWTYPE_EDIT && $qualification->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$qualification_list->restoreFormValues(); // Restore form values
		}
		if ($qualification_list->isGridEdit() && ($qualification->RowType == ROWTYPE_EDIT || $qualification->RowType == ROWTYPE_ADD) && $qualification->EventCancelled) // Update failed
			$qualification_list->restoreCurrentRowFormValues($qualification_list->RowIndex); // Restore form values
		if ($qualification->RowType == ROWTYPE_EDIT) // Edit row
			$qualification_list->EditRowCount++;

		// Set up row id / data-rowindex
		$qualification->RowAttrs->merge(["data-rowindex" => $qualification_list->RowCount, "id" => "r" . $qualification_list->RowCount . "_qualification", "data-rowtype" => $qualification->RowType]);

		// Render row
		$qualification_list->renderRow();

		// Render list options
		$qualification_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($qualification_list->RowAction != "delete" && $qualification_list->RowAction != "insertdelete" && !($qualification_list->RowAction == "insert" && $qualification->isConfirm() && $qualification_list->emptyRow())) {
?>
	<tr <?php echo $qualification->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_list->ListOptions->render("body", "left", $qualification_list->RowCount);
?>
	<?php if ($qualification_list->QualificationCode->Visible) { // QualificationCode ?>
		<td data-name="QualificationCode" <?php echo $qualification_list->QualificationCode->cellAttributes() ?>>
<?php if ($qualification->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationCode" class="form-group"></span>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="o<?php echo $qualification_list->RowIndex ?>_QualificationCode" id="o<?php echo $qualification_list->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_list->QualificationCode->OldValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationCode" class="form-group">
<span<?php echo $qualification_list->QualificationCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_list->QualificationCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="x<?php echo $qualification_list->RowIndex ?>_QualificationCode" id="x<?php echo $qualification_list->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_list->QualificationCode->CurrentValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationCode">
<span<?php echo $qualification_list->QualificationCode->viewAttributes() ?>><?php echo $qualification_list->QualificationCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($qualification_list->QualificationName->Visible) { // QualificationName ?>
		<td data-name="QualificationName" <?php echo $qualification_list->QualificationName->cellAttributes() ?>>
<?php if ($qualification->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationName" class="form-group">
<input type="text" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_list->RowIndex ?>_QualificationName" id="x<?php echo $qualification_list->RowIndex ?>_QualificationName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($qualification_list->QualificationName->getPlaceHolder()) ?>" value="<?php echo $qualification_list->QualificationName->EditValue ?>"<?php echo $qualification_list->QualificationName->editAttributes() ?>>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="o<?php echo $qualification_list->RowIndex ?>_QualificationName" id="o<?php echo $qualification_list->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_list->QualificationName->OldValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationName" class="form-group">
<input type="text" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_list->RowIndex ?>_QualificationName" id="x<?php echo $qualification_list->RowIndex ?>_QualificationName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($qualification_list->QualificationName->getPlaceHolder()) ?>" value="<?php echo $qualification_list->QualificationName->EditValue ?>"<?php echo $qualification_list->QualificationName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationName">
<span<?php echo $qualification_list->QualificationName->viewAttributes() ?>><?php echo $qualification_list->QualificationName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($qualification_list->QualificationType->Visible) { // QualificationType ?>
		<td data-name="QualificationType" <?php echo $qualification_list->QualificationType->cellAttributes() ?>>
<?php if ($qualification->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($qualification_list->QualificationType->getSessionValue() != "") { ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationType" class="form-group">
<span<?php echo $qualification_list->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_list->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="qualification" data-field="x_QualificationType" data-value-separator="<?php echo $qualification_list->QualificationType->displayValueSeparatorAttribute() ?>" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType"<?php echo $qualification_list->QualificationType->editAttributes() ?>>
			<?php echo $qualification_list->QualificationType->selectOptionListHtml("x{$qualification_list->RowIndex}_QualificationType") ?>
		</select>
</div>
<?php echo $qualification_list->QualificationType->Lookup->getParamTag($qualification_list, "p_x" . $qualification_list->RowIndex . "_QualificationType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="o<?php echo $qualification_list->RowIndex ?>_QualificationType" id="o<?php echo $qualification_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->OldValue) ?>">
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($qualification_list->QualificationType->getSessionValue() != "") { ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationType" class="form-group">
<span<?php echo $qualification_list->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_list->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="qualification" data-field="x_QualificationType" data-value-separator="<?php echo $qualification_list->QualificationType->displayValueSeparatorAttribute() ?>" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType"<?php echo $qualification_list->QualificationType->editAttributes() ?>>
			<?php echo $qualification_list->QualificationType->selectOptionListHtml("x{$qualification_list->RowIndex}_QualificationType") ?>
		</select>
</div>
<?php echo $qualification_list->QualificationType->Lookup->getParamTag($qualification_list, "p_x" . $qualification_list->RowIndex . "_QualificationType") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($qualification->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_list->RowCount ?>_qualification_QualificationType">
<span<?php echo $qualification_list->QualificationType->viewAttributes() ?>><?php echo $qualification_list->QualificationType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualification_list->ListOptions->render("body", "right", $qualification_list->RowCount);
?>
	</tr>
<?php if ($qualification->RowType == ROWTYPE_ADD || $qualification->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fqualificationlist", "load"], function() {
	fqualificationlist.updateLists(<?php echo $qualification_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$qualification_list->isGridAdd())
		if (!$qualification_list->Recordset->EOF)
			$qualification_list->Recordset->moveNext();
}
?>
<?php
	if ($qualification_list->isGridAdd() || $qualification_list->isGridEdit()) {
		$qualification_list->RowIndex = '$rowindex$';
		$qualification_list->loadRowValues();

		// Set row properties
		$qualification->resetAttributes();
		$qualification->RowAttrs->merge(["data-rowindex" => $qualification_list->RowIndex, "id" => "r0_qualification", "data-rowtype" => ROWTYPE_ADD]);
		$qualification->RowAttrs->appendClass("ew-template");
		$qualification->RowType = ROWTYPE_ADD;

		// Render row
		$qualification_list->renderRow();

		// Render list options
		$qualification_list->renderListOptions();
		$qualification_list->StartRowCount = 0;
?>
	<tr <?php echo $qualification->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_list->ListOptions->render("body", "left", $qualification_list->RowIndex);
?>
	<?php if ($qualification_list->QualificationCode->Visible) { // QualificationCode ?>
		<td data-name="QualificationCode">
<span id="el$rowindex$_qualification_QualificationCode" class="form-group qualification_QualificationCode"></span>
<input type="hidden" data-table="qualification" data-field="x_QualificationCode" name="o<?php echo $qualification_list->RowIndex ?>_QualificationCode" id="o<?php echo $qualification_list->RowIndex ?>_QualificationCode" value="<?php echo HtmlEncode($qualification_list->QualificationCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($qualification_list->QualificationName->Visible) { // QualificationName ?>
		<td data-name="QualificationName">
<span id="el$rowindex$_qualification_QualificationName" class="form-group qualification_QualificationName">
<input type="text" data-table="qualification" data-field="x_QualificationName" name="x<?php echo $qualification_list->RowIndex ?>_QualificationName" id="x<?php echo $qualification_list->RowIndex ?>_QualificationName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($qualification_list->QualificationName->getPlaceHolder()) ?>" value="<?php echo $qualification_list->QualificationName->EditValue ?>"<?php echo $qualification_list->QualificationName->editAttributes() ?>>
</span>
<input type="hidden" data-table="qualification" data-field="x_QualificationName" name="o<?php echo $qualification_list->RowIndex ?>_QualificationName" id="o<?php echo $qualification_list->RowIndex ?>_QualificationName" value="<?php echo HtmlEncode($qualification_list->QualificationName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($qualification_list->QualificationType->Visible) { // QualificationType ?>
		<td data-name="QualificationType">
<?php if ($qualification_list->QualificationType->getSessionValue() != "") { ?>
<span id="el$rowindex$_qualification_QualificationType" class="form-group qualification_QualificationType">
<span<?php echo $qualification_list->QualificationType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($qualification_list->QualificationType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_qualification_QualificationType" class="form-group qualification_QualificationType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="qualification" data-field="x_QualificationType" data-value-separator="<?php echo $qualification_list->QualificationType->displayValueSeparatorAttribute() ?>" id="x<?php echo $qualification_list->RowIndex ?>_QualificationType" name="x<?php echo $qualification_list->RowIndex ?>_QualificationType"<?php echo $qualification_list->QualificationType->editAttributes() ?>>
			<?php echo $qualification_list->QualificationType->selectOptionListHtml("x{$qualification_list->RowIndex}_QualificationType") ?>
		</select>
</div>
<?php echo $qualification_list->QualificationType->Lookup->getParamTag($qualification_list, "p_x" . $qualification_list->RowIndex . "_QualificationType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="qualification" data-field="x_QualificationType" name="o<?php echo $qualification_list->RowIndex ?>_QualificationType" id="o<?php echo $qualification_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_list->QualificationType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualification_list->ListOptions->render("body", "right", $qualification_list->RowIndex);
?>
<script>
loadjs.ready(["fqualificationlist", "load"], function() {
	fqualificationlist.updateLists(<?php echo $qualification_list->RowIndex ?>);
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
<?php if ($qualification_list->isAdd() || $qualification_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $qualification_list->FormKeyCountName ?>" id="<?php echo $qualification_list->FormKeyCountName ?>" value="<?php echo $qualification_list->KeyCount ?>">
<?php } ?>
<?php if ($qualification_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $qualification_list->FormKeyCountName ?>" id="<?php echo $qualification_list->FormKeyCountName ?>" value="<?php echo $qualification_list->KeyCount ?>">
<?php echo $qualification_list->MultiSelectKey ?>
<?php } ?>
<?php if ($qualification_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $qualification_list->FormKeyCountName ?>" id="<?php echo $qualification_list->FormKeyCountName ?>" value="<?php echo $qualification_list->KeyCount ?>">
<?php } ?>
<?php if ($qualification_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $qualification_list->FormKeyCountName ?>" id="<?php echo $qualification_list->FormKeyCountName ?>" value="<?php echo $qualification_list->KeyCount ?>">
<?php echo $qualification_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$qualification->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($qualification_list->Recordset)
	$qualification_list->Recordset->Close();
?>
<?php if (!$qualification_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$qualification_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualification_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualification_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($qualification_list->TotalRecords == 0 && !$qualification->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $qualification_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$qualification_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$qualification_list->isExport()) { ?>
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
$qualification_list->terminate();
?>