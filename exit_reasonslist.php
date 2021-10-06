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
$exit_reasons_list = new exit_reasons_list();

// Run the page
$exit_reasons_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$exit_reasons_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$exit_reasons_list->isExport()) { ?>
<script>
var fexit_reasonslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fexit_reasonslist = currentForm = new ew.Form("fexit_reasonslist", "list");
	fexit_reasonslist.formKeyCountName = '<?php echo $exit_reasons_list->FormKeyCountName ?>';

	// Validate form
	fexit_reasonslist.validate = function() {
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
			<?php if ($exit_reasons_list->ExitCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $exit_reasons_list->ExitCode->caption(), $exit_reasons_list->ExitCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($exit_reasons_list->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $exit_reasons_list->ExitReason->caption(), $exit_reasons_list->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($exit_reasons_list->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $exit_reasons_list->EmploymentStatus->caption(), $exit_reasons_list->EmploymentStatus->RequiredErrorMessage)) ?>");
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
	fexit_reasonslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ExitReason", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmploymentStatus", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fexit_reasonslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fexit_reasonslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fexit_reasonslist.lists["x_EmploymentStatus"] = <?php echo $exit_reasons_list->EmploymentStatus->Lookup->toClientList($exit_reasons_list) ?>;
	fexit_reasonslist.lists["x_EmploymentStatus"].options = <?php echo JsonEncode($exit_reasons_list->EmploymentStatus->lookupOptions()) ?>;
	loadjs.done("fexit_reasonslist");
});
var fexit_reasonslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fexit_reasonslistsrch = currentSearchForm = new ew.Form("fexit_reasonslistsrch");

	// Dynamic selection lists
	// Filters

	fexit_reasonslistsrch.filterList = <?php echo $exit_reasons_list->getFilterList() ?>;

	// Init search panel as collapsed
	fexit_reasonslistsrch.initSearchPanel = true;
	loadjs.done("fexit_reasonslistsrch");
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
<?php if (!$exit_reasons_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($exit_reasons_list->TotalRecords > 0 && $exit_reasons_list->ExportOptions->visible()) { ?>
<?php $exit_reasons_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($exit_reasons_list->ImportOptions->visible()) { ?>
<?php $exit_reasons_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($exit_reasons_list->SearchOptions->visible()) { ?>
<?php $exit_reasons_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($exit_reasons_list->FilterOptions->visible()) { ?>
<?php $exit_reasons_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$exit_reasons_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$exit_reasons_list->isExport() && !$exit_reasons->CurrentAction) { ?>
<form name="fexit_reasonslistsrch" id="fexit_reasonslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fexit_reasonslistsrch-search-panel" class="<?php echo $exit_reasons_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="exit_reasons">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $exit_reasons_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($exit_reasons_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($exit_reasons_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $exit_reasons_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($exit_reasons_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($exit_reasons_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($exit_reasons_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($exit_reasons_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $exit_reasons_list->showPageHeader(); ?>
<?php
$exit_reasons_list->showMessage();
?>
<?php if ($exit_reasons_list->TotalRecords > 0 || $exit_reasons->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($exit_reasons_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> exit_reasons">
<?php if (!$exit_reasons_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$exit_reasons_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $exit_reasons_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $exit_reasons_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fexit_reasonslist" id="fexit_reasonslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="exit_reasons">
<div id="gmp_exit_reasons" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($exit_reasons_list->TotalRecords > 0 || $exit_reasons_list->isAdd() || $exit_reasons_list->isCopy() || $exit_reasons_list->isGridEdit()) { ?>
<table id="tbl_exit_reasonslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$exit_reasons->RowType = ROWTYPE_HEADER;

// Render list options
$exit_reasons_list->renderListOptions();

// Render list options (header, left)
$exit_reasons_list->ListOptions->render("header", "left");
?>
<?php if ($exit_reasons_list->ExitCode->Visible) { // ExitCode ?>
	<?php if ($exit_reasons_list->SortUrl($exit_reasons_list->ExitCode) == "") { ?>
		<th data-name="ExitCode" class="<?php echo $exit_reasons_list->ExitCode->headerCellClass() ?>"><div id="elh_exit_reasons_ExitCode" class="exit_reasons_ExitCode"><div class="ew-table-header-caption"><?php echo $exit_reasons_list->ExitCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitCode" class="<?php echo $exit_reasons_list->ExitCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $exit_reasons_list->SortUrl($exit_reasons_list->ExitCode) ?>', 1);"><div id="elh_exit_reasons_ExitCode" class="exit_reasons_ExitCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $exit_reasons_list->ExitCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($exit_reasons_list->ExitCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($exit_reasons_list->ExitCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($exit_reasons_list->ExitReason->Visible) { // ExitReason ?>
	<?php if ($exit_reasons_list->SortUrl($exit_reasons_list->ExitReason) == "") { ?>
		<th data-name="ExitReason" class="<?php echo $exit_reasons_list->ExitReason->headerCellClass() ?>"><div id="elh_exit_reasons_ExitReason" class="exit_reasons_ExitReason"><div class="ew-table-header-caption"><?php echo $exit_reasons_list->ExitReason->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitReason" class="<?php echo $exit_reasons_list->ExitReason->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $exit_reasons_list->SortUrl($exit_reasons_list->ExitReason) ?>', 1);"><div id="elh_exit_reasons_ExitReason" class="exit_reasons_ExitReason">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $exit_reasons_list->ExitReason->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($exit_reasons_list->ExitReason->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($exit_reasons_list->ExitReason->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($exit_reasons_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<?php if ($exit_reasons_list->SortUrl($exit_reasons_list->EmploymentStatus) == "") { ?>
		<th data-name="EmploymentStatus" class="<?php echo $exit_reasons_list->EmploymentStatus->headerCellClass() ?>"><div id="elh_exit_reasons_EmploymentStatus" class="exit_reasons_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $exit_reasons_list->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentStatus" class="<?php echo $exit_reasons_list->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $exit_reasons_list->SortUrl($exit_reasons_list->EmploymentStatus) ?>', 1);"><div id="elh_exit_reasons_EmploymentStatus" class="exit_reasons_EmploymentStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $exit_reasons_list->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($exit_reasons_list->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($exit_reasons_list->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$exit_reasons_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($exit_reasons_list->isAdd() || $exit_reasons_list->isCopy()) {
		$exit_reasons_list->RowIndex = 0;
		$exit_reasons_list->KeyCount = $exit_reasons_list->RowIndex;
		if ($exit_reasons_list->isAdd())
			$exit_reasons_list->loadRowValues();
		if ($exit_reasons->EventCancelled) // Insert failed
			$exit_reasons_list->restoreFormValues(); // Restore form values

		// Set row properties
		$exit_reasons->resetAttributes();
		$exit_reasons->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_exit_reasons", "data-rowtype" => ROWTYPE_ADD]);
		$exit_reasons->RowType = ROWTYPE_ADD;

		// Render row
		$exit_reasons_list->renderRow();

		// Render list options
		$exit_reasons_list->renderListOptions();
		$exit_reasons_list->StartRowCount = 0;
?>
	<tr <?php echo $exit_reasons->rowAttributes() ?>>
<?php

// Render list options (body, left)
$exit_reasons_list->ListOptions->render("body", "left", $exit_reasons_list->RowCount);
?>
	<?php if ($exit_reasons_list->ExitCode->Visible) { // ExitCode ?>
		<td data-name="ExitCode">
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitCode" class="form-group exit_reasons_ExitCode"></span>
<input type="hidden" data-table="exit_reasons" data-field="x_ExitCode" name="o<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" id="o<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" value="<?php echo HtmlEncode($exit_reasons_list->ExitCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($exit_reasons_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason">
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitReason" class="form-group exit_reasons_ExitReason">
<input type="text" data-table="exit_reasons" data-field="x_ExitReason" name="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" id="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($exit_reasons_list->ExitReason->getPlaceHolder()) ?>" value="<?php echo $exit_reasons_list->ExitReason->EditValue ?>"<?php echo $exit_reasons_list->ExitReason->editAttributes() ?>>
</span>
<input type="hidden" data-table="exit_reasons" data-field="x_ExitReason" name="o<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" id="o<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($exit_reasons_list->ExitReason->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($exit_reasons_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus">
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_EmploymentStatus" class="form-group exit_reasons_EmploymentStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="exit_reasons" data-field="x_EmploymentStatus" data-value-separator="<?php echo $exit_reasons_list->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" name="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus"<?php echo $exit_reasons_list->EmploymentStatus->editAttributes() ?>>
			<?php echo $exit_reasons_list->EmploymentStatus->selectOptionListHtml("x{$exit_reasons_list->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $exit_reasons_list->EmploymentStatus->Lookup->getParamTag($exit_reasons_list, "p_x" . $exit_reasons_list->RowIndex . "_EmploymentStatus") ?>
</span>
<input type="hidden" data-table="exit_reasons" data-field="x_EmploymentStatus" name="o<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($exit_reasons_list->EmploymentStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$exit_reasons_list->ListOptions->render("body", "right", $exit_reasons_list->RowCount);
?>
<script>
loadjs.ready(["fexit_reasonslist", "load"], function() {
	fexit_reasonslist.updateLists(<?php echo $exit_reasons_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($exit_reasons_list->ExportAll && $exit_reasons_list->isExport()) {
	$exit_reasons_list->StopRecord = $exit_reasons_list->TotalRecords;
} else {

	// Set the last record to display
	if ($exit_reasons_list->TotalRecords > $exit_reasons_list->StartRecord + $exit_reasons_list->DisplayRecords - 1)
		$exit_reasons_list->StopRecord = $exit_reasons_list->StartRecord + $exit_reasons_list->DisplayRecords - 1;
	else
		$exit_reasons_list->StopRecord = $exit_reasons_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($exit_reasons->isConfirm() || $exit_reasons_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($exit_reasons_list->FormKeyCountName) && ($exit_reasons_list->isGridAdd() || $exit_reasons_list->isGridEdit() || $exit_reasons->isConfirm())) {
		$exit_reasons_list->KeyCount = $CurrentForm->getValue($exit_reasons_list->FormKeyCountName);
		$exit_reasons_list->StopRecord = $exit_reasons_list->StartRecord + $exit_reasons_list->KeyCount - 1;
	}
}
$exit_reasons_list->RecordCount = $exit_reasons_list->StartRecord - 1;
if ($exit_reasons_list->Recordset && !$exit_reasons_list->Recordset->EOF) {
	$exit_reasons_list->Recordset->moveFirst();
	$selectLimit = $exit_reasons_list->UseSelectLimit;
	if (!$selectLimit && $exit_reasons_list->StartRecord > 1)
		$exit_reasons_list->Recordset->move($exit_reasons_list->StartRecord - 1);
} elseif (!$exit_reasons->AllowAddDeleteRow && $exit_reasons_list->StopRecord == 0) {
	$exit_reasons_list->StopRecord = $exit_reasons->GridAddRowCount;
}

// Initialize aggregate
$exit_reasons->RowType = ROWTYPE_AGGREGATEINIT;
$exit_reasons->resetAttributes();
$exit_reasons_list->renderRow();
$exit_reasons_list->EditRowCount = 0;
if ($exit_reasons_list->isEdit())
	$exit_reasons_list->RowIndex = 1;
if ($exit_reasons_list->isGridAdd())
	$exit_reasons_list->RowIndex = 0;
if ($exit_reasons_list->isGridEdit())
	$exit_reasons_list->RowIndex = 0;
while ($exit_reasons_list->RecordCount < $exit_reasons_list->StopRecord) {
	$exit_reasons_list->RecordCount++;
	if ($exit_reasons_list->RecordCount >= $exit_reasons_list->StartRecord) {
		$exit_reasons_list->RowCount++;
		if ($exit_reasons_list->isGridAdd() || $exit_reasons_list->isGridEdit() || $exit_reasons->isConfirm()) {
			$exit_reasons_list->RowIndex++;
			$CurrentForm->Index = $exit_reasons_list->RowIndex;
			if ($CurrentForm->hasValue($exit_reasons_list->FormActionName) && ($exit_reasons->isConfirm() || $exit_reasons_list->EventCancelled))
				$exit_reasons_list->RowAction = strval($CurrentForm->getValue($exit_reasons_list->FormActionName));
			elseif ($exit_reasons_list->isGridAdd())
				$exit_reasons_list->RowAction = "insert";
			else
				$exit_reasons_list->RowAction = "";
		}

		// Set up key count
		$exit_reasons_list->KeyCount = $exit_reasons_list->RowIndex;

		// Init row class and style
		$exit_reasons->resetAttributes();
		$exit_reasons->CssClass = "";
		if ($exit_reasons_list->isGridAdd()) {
			$exit_reasons_list->loadRowValues(); // Load default values
		} else {
			$exit_reasons_list->loadRowValues($exit_reasons_list->Recordset); // Load row values
		}
		$exit_reasons->RowType = ROWTYPE_VIEW; // Render view
		if ($exit_reasons_list->isGridAdd()) // Grid add
			$exit_reasons->RowType = ROWTYPE_ADD; // Render add
		if ($exit_reasons_list->isGridAdd() && $exit_reasons->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$exit_reasons_list->restoreCurrentRowFormValues($exit_reasons_list->RowIndex); // Restore form values
		if ($exit_reasons_list->isEdit()) {
			if ($exit_reasons_list->checkInlineEditKey() && $exit_reasons_list->EditRowCount == 0) { // Inline edit
				$exit_reasons->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($exit_reasons_list->isGridEdit()) { // Grid edit
			if ($exit_reasons->EventCancelled)
				$exit_reasons_list->restoreCurrentRowFormValues($exit_reasons_list->RowIndex); // Restore form values
			if ($exit_reasons_list->RowAction == "insert")
				$exit_reasons->RowType = ROWTYPE_ADD; // Render add
			else
				$exit_reasons->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($exit_reasons_list->isEdit() && $exit_reasons->RowType == ROWTYPE_EDIT && $exit_reasons->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$exit_reasons_list->restoreFormValues(); // Restore form values
		}
		if ($exit_reasons_list->isGridEdit() && ($exit_reasons->RowType == ROWTYPE_EDIT || $exit_reasons->RowType == ROWTYPE_ADD) && $exit_reasons->EventCancelled) // Update failed
			$exit_reasons_list->restoreCurrentRowFormValues($exit_reasons_list->RowIndex); // Restore form values
		if ($exit_reasons->RowType == ROWTYPE_EDIT) // Edit row
			$exit_reasons_list->EditRowCount++;

		// Set up row id / data-rowindex
		$exit_reasons->RowAttrs->merge(["data-rowindex" => $exit_reasons_list->RowCount, "id" => "r" . $exit_reasons_list->RowCount . "_exit_reasons", "data-rowtype" => $exit_reasons->RowType]);

		// Render row
		$exit_reasons_list->renderRow();

		// Render list options
		$exit_reasons_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($exit_reasons_list->RowAction != "delete" && $exit_reasons_list->RowAction != "insertdelete" && !($exit_reasons_list->RowAction == "insert" && $exit_reasons->isConfirm() && $exit_reasons_list->emptyRow())) {
?>
	<tr <?php echo $exit_reasons->rowAttributes() ?>>
<?php

// Render list options (body, left)
$exit_reasons_list->ListOptions->render("body", "left", $exit_reasons_list->RowCount);
?>
	<?php if ($exit_reasons_list->ExitCode->Visible) { // ExitCode ?>
		<td data-name="ExitCode" <?php echo $exit_reasons_list->ExitCode->cellAttributes() ?>>
<?php if ($exit_reasons->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitCode" class="form-group"></span>
<input type="hidden" data-table="exit_reasons" data-field="x_ExitCode" name="o<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" id="o<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" value="<?php echo HtmlEncode($exit_reasons_list->ExitCode->OldValue) ?>">
<?php } ?>
<?php if ($exit_reasons->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitCode" class="form-group">
<span<?php echo $exit_reasons_list->ExitCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($exit_reasons_list->ExitCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="exit_reasons" data-field="x_ExitCode" name="x<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" id="x<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" value="<?php echo HtmlEncode($exit_reasons_list->ExitCode->CurrentValue) ?>">
<?php } ?>
<?php if ($exit_reasons->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitCode">
<span<?php echo $exit_reasons_list->ExitCode->viewAttributes() ?>><?php echo $exit_reasons_list->ExitCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($exit_reasons_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason" <?php echo $exit_reasons_list->ExitReason->cellAttributes() ?>>
<?php if ($exit_reasons->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitReason" class="form-group">
<input type="text" data-table="exit_reasons" data-field="x_ExitReason" name="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" id="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($exit_reasons_list->ExitReason->getPlaceHolder()) ?>" value="<?php echo $exit_reasons_list->ExitReason->EditValue ?>"<?php echo $exit_reasons_list->ExitReason->editAttributes() ?>>
</span>
<input type="hidden" data-table="exit_reasons" data-field="x_ExitReason" name="o<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" id="o<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($exit_reasons_list->ExitReason->OldValue) ?>">
<?php } ?>
<?php if ($exit_reasons->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitReason" class="form-group">
<input type="text" data-table="exit_reasons" data-field="x_ExitReason" name="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" id="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($exit_reasons_list->ExitReason->getPlaceHolder()) ?>" value="<?php echo $exit_reasons_list->ExitReason->EditValue ?>"<?php echo $exit_reasons_list->ExitReason->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($exit_reasons->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_ExitReason">
<span<?php echo $exit_reasons_list->ExitReason->viewAttributes() ?>><?php echo $exit_reasons_list->ExitReason->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($exit_reasons_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus" <?php echo $exit_reasons_list->EmploymentStatus->cellAttributes() ?>>
<?php if ($exit_reasons->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_EmploymentStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="exit_reasons" data-field="x_EmploymentStatus" data-value-separator="<?php echo $exit_reasons_list->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" name="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus"<?php echo $exit_reasons_list->EmploymentStatus->editAttributes() ?>>
			<?php echo $exit_reasons_list->EmploymentStatus->selectOptionListHtml("x{$exit_reasons_list->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $exit_reasons_list->EmploymentStatus->Lookup->getParamTag($exit_reasons_list, "p_x" . $exit_reasons_list->RowIndex . "_EmploymentStatus") ?>
</span>
<input type="hidden" data-table="exit_reasons" data-field="x_EmploymentStatus" name="o<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($exit_reasons_list->EmploymentStatus->OldValue) ?>">
<?php } ?>
<?php if ($exit_reasons->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_EmploymentStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="exit_reasons" data-field="x_EmploymentStatus" data-value-separator="<?php echo $exit_reasons_list->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" name="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus"<?php echo $exit_reasons_list->EmploymentStatus->editAttributes() ?>>
			<?php echo $exit_reasons_list->EmploymentStatus->selectOptionListHtml("x{$exit_reasons_list->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $exit_reasons_list->EmploymentStatus->Lookup->getParamTag($exit_reasons_list, "p_x" . $exit_reasons_list->RowIndex . "_EmploymentStatus") ?>
</span>
<?php } ?>
<?php if ($exit_reasons->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $exit_reasons_list->RowCount ?>_exit_reasons_EmploymentStatus">
<span<?php echo $exit_reasons_list->EmploymentStatus->viewAttributes() ?>><?php echo $exit_reasons_list->EmploymentStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$exit_reasons_list->ListOptions->render("body", "right", $exit_reasons_list->RowCount);
?>
	</tr>
<?php if ($exit_reasons->RowType == ROWTYPE_ADD || $exit_reasons->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fexit_reasonslist", "load"], function() {
	fexit_reasonslist.updateLists(<?php echo $exit_reasons_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$exit_reasons_list->isGridAdd())
		if (!$exit_reasons_list->Recordset->EOF)
			$exit_reasons_list->Recordset->moveNext();
}
?>
<?php
	if ($exit_reasons_list->isGridAdd() || $exit_reasons_list->isGridEdit()) {
		$exit_reasons_list->RowIndex = '$rowindex$';
		$exit_reasons_list->loadRowValues();

		// Set row properties
		$exit_reasons->resetAttributes();
		$exit_reasons->RowAttrs->merge(["data-rowindex" => $exit_reasons_list->RowIndex, "id" => "r0_exit_reasons", "data-rowtype" => ROWTYPE_ADD]);
		$exit_reasons->RowAttrs->appendClass("ew-template");
		$exit_reasons->RowType = ROWTYPE_ADD;

		// Render row
		$exit_reasons_list->renderRow();

		// Render list options
		$exit_reasons_list->renderListOptions();
		$exit_reasons_list->StartRowCount = 0;
?>
	<tr <?php echo $exit_reasons->rowAttributes() ?>>
<?php

// Render list options (body, left)
$exit_reasons_list->ListOptions->render("body", "left", $exit_reasons_list->RowIndex);
?>
	<?php if ($exit_reasons_list->ExitCode->Visible) { // ExitCode ?>
		<td data-name="ExitCode">
<span id="el$rowindex$_exit_reasons_ExitCode" class="form-group exit_reasons_ExitCode"></span>
<input type="hidden" data-table="exit_reasons" data-field="x_ExitCode" name="o<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" id="o<?php echo $exit_reasons_list->RowIndex ?>_ExitCode" value="<?php echo HtmlEncode($exit_reasons_list->ExitCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($exit_reasons_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason">
<span id="el$rowindex$_exit_reasons_ExitReason" class="form-group exit_reasons_ExitReason">
<input type="text" data-table="exit_reasons" data-field="x_ExitReason" name="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" id="x<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($exit_reasons_list->ExitReason->getPlaceHolder()) ?>" value="<?php echo $exit_reasons_list->ExitReason->EditValue ?>"<?php echo $exit_reasons_list->ExitReason->editAttributes() ?>>
</span>
<input type="hidden" data-table="exit_reasons" data-field="x_ExitReason" name="o<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" id="o<?php echo $exit_reasons_list->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($exit_reasons_list->ExitReason->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($exit_reasons_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus">
<span id="el$rowindex$_exit_reasons_EmploymentStatus" class="form-group exit_reasons_EmploymentStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="exit_reasons" data-field="x_EmploymentStatus" data-value-separator="<?php echo $exit_reasons_list->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" name="x<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus"<?php echo $exit_reasons_list->EmploymentStatus->editAttributes() ?>>
			<?php echo $exit_reasons_list->EmploymentStatus->selectOptionListHtml("x{$exit_reasons_list->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $exit_reasons_list->EmploymentStatus->Lookup->getParamTag($exit_reasons_list, "p_x" . $exit_reasons_list->RowIndex . "_EmploymentStatus") ?>
</span>
<input type="hidden" data-table="exit_reasons" data-field="x_EmploymentStatus" name="o<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $exit_reasons_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($exit_reasons_list->EmploymentStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$exit_reasons_list->ListOptions->render("body", "right", $exit_reasons_list->RowIndex);
?>
<script>
loadjs.ready(["fexit_reasonslist", "load"], function() {
	fexit_reasonslist.updateLists(<?php echo $exit_reasons_list->RowIndex ?>);
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
<?php if ($exit_reasons_list->isAdd() || $exit_reasons_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $exit_reasons_list->FormKeyCountName ?>" id="<?php echo $exit_reasons_list->FormKeyCountName ?>" value="<?php echo $exit_reasons_list->KeyCount ?>">
<?php } ?>
<?php if ($exit_reasons_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $exit_reasons_list->FormKeyCountName ?>" id="<?php echo $exit_reasons_list->FormKeyCountName ?>" value="<?php echo $exit_reasons_list->KeyCount ?>">
<?php echo $exit_reasons_list->MultiSelectKey ?>
<?php } ?>
<?php if ($exit_reasons_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $exit_reasons_list->FormKeyCountName ?>" id="<?php echo $exit_reasons_list->FormKeyCountName ?>" value="<?php echo $exit_reasons_list->KeyCount ?>">
<?php } ?>
<?php if ($exit_reasons_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $exit_reasons_list->FormKeyCountName ?>" id="<?php echo $exit_reasons_list->FormKeyCountName ?>" value="<?php echo $exit_reasons_list->KeyCount ?>">
<?php echo $exit_reasons_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$exit_reasons->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($exit_reasons_list->Recordset)
	$exit_reasons_list->Recordset->Close();
?>
<?php if (!$exit_reasons_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$exit_reasons_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $exit_reasons_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $exit_reasons_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($exit_reasons_list->TotalRecords == 0 && !$exit_reasons->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $exit_reasons_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$exit_reasons_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$exit_reasons_list->isExport()) { ?>
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
$exit_reasons_list->terminate();
?>