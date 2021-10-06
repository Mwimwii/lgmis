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
$salary_scale_list = new salary_scale_list();

// Run the page
$salary_scale_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_scale_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$salary_scale_list->isExport()) { ?>
<script>
var fsalary_scalelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsalary_scalelist = currentForm = new ew.Form("fsalary_scalelist", "list");
	fsalary_scalelist.formKeyCountName = '<?php echo $salary_scale_list->FormKeyCountName ?>';

	// Validate form
	fsalary_scalelist.validate = function() {
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
			<?php if ($salary_scale_list->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_scale_list->Division->caption(), $salary_scale_list->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_scale_list->Division->errorMessage()) ?>");
			<?php if ($salary_scale_list->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_scale_list->SalaryScale->caption(), $salary_scale_list->SalaryScale->RequiredErrorMessage)) ?>");
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
	fsalary_scalelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Division", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fsalary_scalelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsalary_scalelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsalary_scalelist");
});
var fsalary_scalelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsalary_scalelistsrch = currentSearchForm = new ew.Form("fsalary_scalelistsrch");

	// Dynamic selection lists
	// Filters

	fsalary_scalelistsrch.filterList = <?php echo $salary_scale_list->getFilterList() ?>;

	// Init search panel as collapsed
	fsalary_scalelistsrch.initSearchPanel = true;
	loadjs.done("fsalary_scalelistsrch");
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
<?php if (!$salary_scale_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($salary_scale_list->TotalRecords > 0 && $salary_scale_list->ExportOptions->visible()) { ?>
<?php $salary_scale_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($salary_scale_list->ImportOptions->visible()) { ?>
<?php $salary_scale_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($salary_scale_list->SearchOptions->visible()) { ?>
<?php $salary_scale_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($salary_scale_list->FilterOptions->visible()) { ?>
<?php $salary_scale_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$salary_scale_list->isExport() || Config("EXPORT_MASTER_RECORD") && $salary_scale_list->isExport("print")) { ?>
<?php
if ($salary_scale_list->DbMasterFilter != "" && $salary_scale->getCurrentMasterTable() == "division") {
	if ($salary_scale_list->MasterRecordExists) {
		include_once "divisionmaster.php";
	}
}
?>
<?php } ?>
<?php
$salary_scale_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$salary_scale_list->isExport() && !$salary_scale->CurrentAction) { ?>
<form name="fsalary_scalelistsrch" id="fsalary_scalelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsalary_scalelistsrch-search-panel" class="<?php echo $salary_scale_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="salary_scale">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $salary_scale_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($salary_scale_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($salary_scale_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $salary_scale_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($salary_scale_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($salary_scale_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($salary_scale_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($salary_scale_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $salary_scale_list->showPageHeader(); ?>
<?php
$salary_scale_list->showMessage();
?>
<?php if ($salary_scale_list->TotalRecords > 0 || $salary_scale->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($salary_scale_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> salary_scale">
<?php if (!$salary_scale_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$salary_scale_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $salary_scale_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $salary_scale_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsalary_scalelist" id="fsalary_scalelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="salary_scale">
<?php if ($salary_scale->getCurrentMasterTable() == "division" && $salary_scale->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="division">
<input type="hidden" name="fk_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_salary_scale" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($salary_scale_list->TotalRecords > 0 || $salary_scale_list->isAdd() || $salary_scale_list->isCopy() || $salary_scale_list->isGridEdit()) { ?>
<table id="tbl_salary_scalelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$salary_scale->RowType = ROWTYPE_HEADER;

// Render list options
$salary_scale_list->renderListOptions();

// Render list options (header, left)
$salary_scale_list->ListOptions->render("header", "left");
?>
<?php if ($salary_scale_list->Division->Visible) { // Division ?>
	<?php if ($salary_scale_list->SortUrl($salary_scale_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $salary_scale_list->Division->headerCellClass() ?>"><div id="elh_salary_scale_Division" class="salary_scale_Division"><div class="ew-table-header-caption"><?php echo $salary_scale_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $salary_scale_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $salary_scale_list->SortUrl($salary_scale_list->Division) ?>', 1);"><div id="elh_salary_scale_Division" class="salary_scale_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_scale_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_scale_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_scale_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_scale_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($salary_scale_list->SortUrl($salary_scale_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_scale_list->SalaryScale->headerCellClass() ?>"><div id="elh_salary_scale_SalaryScale" class="salary_scale_SalaryScale"><div class="ew-table-header-caption"><?php echo $salary_scale_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_scale_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $salary_scale_list->SortUrl($salary_scale_list->SalaryScale) ?>', 1);"><div id="elh_salary_scale_SalaryScale" class="salary_scale_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_scale_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($salary_scale_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_scale_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$salary_scale_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($salary_scale_list->isAdd() || $salary_scale_list->isCopy()) {
		$salary_scale_list->RowIndex = 0;
		$salary_scale_list->KeyCount = $salary_scale_list->RowIndex;
		if ($salary_scale_list->isAdd())
			$salary_scale_list->loadRowValues();
		if ($salary_scale->EventCancelled) // Insert failed
			$salary_scale_list->restoreFormValues(); // Restore form values

		// Set row properties
		$salary_scale->resetAttributes();
		$salary_scale->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_salary_scale", "data-rowtype" => ROWTYPE_ADD]);
		$salary_scale->RowType = ROWTYPE_ADD;

		// Render row
		$salary_scale_list->renderRow();

		// Render list options
		$salary_scale_list->renderListOptions();
		$salary_scale_list->StartRowCount = 0;
?>
	<tr <?php echo $salary_scale->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_scale_list->ListOptions->render("body", "left", $salary_scale_list->RowCount);
?>
	<?php if ($salary_scale_list->Division->Visible) { // Division ?>
		<td data-name="Division">
<?php if ($salary_scale_list->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_Division" class="form-group salary_scale_Division">
<span<?php echo $salary_scale_list->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_list->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_Division" class="form-group salary_scale_Division">
<input type="text" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($salary_scale_list->Division->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->Division->EditValue ?>"<?php echo $salary_scale_list->Division->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="o<?php echo $salary_scale_list->RowIndex ?>_Division" id="o<?php echo $salary_scale_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_scale_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_SalaryScale" class="form-group salary_scale_SalaryScale">
<input type="text" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($salary_scale_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->SalaryScale->EditValue ?>"<?php echo $salary_scale_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_scale_list->ListOptions->render("body", "right", $salary_scale_list->RowCount);
?>
<script>
loadjs.ready(["fsalary_scalelist", "load"], function() {
	fsalary_scalelist.updateLists(<?php echo $salary_scale_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($salary_scale_list->ExportAll && $salary_scale_list->isExport()) {
	$salary_scale_list->StopRecord = $salary_scale_list->TotalRecords;
} else {

	// Set the last record to display
	if ($salary_scale_list->TotalRecords > $salary_scale_list->StartRecord + $salary_scale_list->DisplayRecords - 1)
		$salary_scale_list->StopRecord = $salary_scale_list->StartRecord + $salary_scale_list->DisplayRecords - 1;
	else
		$salary_scale_list->StopRecord = $salary_scale_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($salary_scale->isConfirm() || $salary_scale_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($salary_scale_list->FormKeyCountName) && ($salary_scale_list->isGridAdd() || $salary_scale_list->isGridEdit() || $salary_scale->isConfirm())) {
		$salary_scale_list->KeyCount = $CurrentForm->getValue($salary_scale_list->FormKeyCountName);
		$salary_scale_list->StopRecord = $salary_scale_list->StartRecord + $salary_scale_list->KeyCount - 1;
	}
}
$salary_scale_list->RecordCount = $salary_scale_list->StartRecord - 1;
if ($salary_scale_list->Recordset && !$salary_scale_list->Recordset->EOF) {
	$salary_scale_list->Recordset->moveFirst();
	$selectLimit = $salary_scale_list->UseSelectLimit;
	if (!$selectLimit && $salary_scale_list->StartRecord > 1)
		$salary_scale_list->Recordset->move($salary_scale_list->StartRecord - 1);
} elseif (!$salary_scale->AllowAddDeleteRow && $salary_scale_list->StopRecord == 0) {
	$salary_scale_list->StopRecord = $salary_scale->GridAddRowCount;
}

// Initialize aggregate
$salary_scale->RowType = ROWTYPE_AGGREGATEINIT;
$salary_scale->resetAttributes();
$salary_scale_list->renderRow();
$salary_scale_list->EditRowCount = 0;
if ($salary_scale_list->isEdit())
	$salary_scale_list->RowIndex = 1;
if ($salary_scale_list->isGridAdd())
	$salary_scale_list->RowIndex = 0;
if ($salary_scale_list->isGridEdit())
	$salary_scale_list->RowIndex = 0;
while ($salary_scale_list->RecordCount < $salary_scale_list->StopRecord) {
	$salary_scale_list->RecordCount++;
	if ($salary_scale_list->RecordCount >= $salary_scale_list->StartRecord) {
		$salary_scale_list->RowCount++;
		if ($salary_scale_list->isGridAdd() || $salary_scale_list->isGridEdit() || $salary_scale->isConfirm()) {
			$salary_scale_list->RowIndex++;
			$CurrentForm->Index = $salary_scale_list->RowIndex;
			if ($CurrentForm->hasValue($salary_scale_list->FormActionName) && ($salary_scale->isConfirm() || $salary_scale_list->EventCancelled))
				$salary_scale_list->RowAction = strval($CurrentForm->getValue($salary_scale_list->FormActionName));
			elseif ($salary_scale_list->isGridAdd())
				$salary_scale_list->RowAction = "insert";
			else
				$salary_scale_list->RowAction = "";
		}

		// Set up key count
		$salary_scale_list->KeyCount = $salary_scale_list->RowIndex;

		// Init row class and style
		$salary_scale->resetAttributes();
		$salary_scale->CssClass = "";
		if ($salary_scale_list->isGridAdd()) {
			$salary_scale_list->loadRowValues(); // Load default values
		} else {
			$salary_scale_list->loadRowValues($salary_scale_list->Recordset); // Load row values
		}
		$salary_scale->RowType = ROWTYPE_VIEW; // Render view
		if ($salary_scale_list->isGridAdd()) // Grid add
			$salary_scale->RowType = ROWTYPE_ADD; // Render add
		if ($salary_scale_list->isGridAdd() && $salary_scale->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$salary_scale_list->restoreCurrentRowFormValues($salary_scale_list->RowIndex); // Restore form values
		if ($salary_scale_list->isEdit()) {
			if ($salary_scale_list->checkInlineEditKey() && $salary_scale_list->EditRowCount == 0) { // Inline edit
				$salary_scale->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($salary_scale_list->isGridEdit()) { // Grid edit
			if ($salary_scale->EventCancelled)
				$salary_scale_list->restoreCurrentRowFormValues($salary_scale_list->RowIndex); // Restore form values
			if ($salary_scale_list->RowAction == "insert")
				$salary_scale->RowType = ROWTYPE_ADD; // Render add
			else
				$salary_scale->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($salary_scale_list->isEdit() && $salary_scale->RowType == ROWTYPE_EDIT && $salary_scale->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$salary_scale_list->restoreFormValues(); // Restore form values
		}
		if ($salary_scale_list->isGridEdit() && ($salary_scale->RowType == ROWTYPE_EDIT || $salary_scale->RowType == ROWTYPE_ADD) && $salary_scale->EventCancelled) // Update failed
			$salary_scale_list->restoreCurrentRowFormValues($salary_scale_list->RowIndex); // Restore form values
		if ($salary_scale->RowType == ROWTYPE_EDIT) // Edit row
			$salary_scale_list->EditRowCount++;

		// Set up row id / data-rowindex
		$salary_scale->RowAttrs->merge(["data-rowindex" => $salary_scale_list->RowCount, "id" => "r" . $salary_scale_list->RowCount . "_salary_scale", "data-rowtype" => $salary_scale->RowType]);

		// Render row
		$salary_scale_list->renderRow();

		// Render list options
		$salary_scale_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($salary_scale_list->RowAction != "delete" && $salary_scale_list->RowAction != "insertdelete" && !($salary_scale_list->RowAction == "insert" && $salary_scale->isConfirm() && $salary_scale_list->emptyRow())) {
?>
	<tr <?php echo $salary_scale->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_scale_list->ListOptions->render("body", "left", $salary_scale_list->RowCount);
?>
	<?php if ($salary_scale_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $salary_scale_list->Division->cellAttributes() ?>>
<?php if ($salary_scale->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($salary_scale_list->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_Division" class="form-group">
<span<?php echo $salary_scale_list->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_list->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_Division" class="form-group">
<input type="text" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($salary_scale_list->Division->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->Division->EditValue ?>"<?php echo $salary_scale_list->Division->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="o<?php echo $salary_scale_list->RowIndex ?>_Division" id="o<?php echo $salary_scale_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->OldValue) ?>">
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($salary_scale_list->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_Division" class="form-group">
<span<?php echo $salary_scale_list->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_list->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_Division" class="form-group">
<input type="text" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($salary_scale_list->Division->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->Division->EditValue ?>"<?php echo $salary_scale_list->Division->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_Division">
<span<?php echo $salary_scale_list->Division->viewAttributes() ?>><?php echo $salary_scale_list->Division->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_scale_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $salary_scale_list->SalaryScale->cellAttributes() ?>>
<?php if ($salary_scale->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_SalaryScale" class="form-group">
<input type="text" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($salary_scale_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->SalaryScale->EditValue ?>"<?php echo $salary_scale_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_list->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($salary_scale_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->SalaryScale->EditValue ?>"<?php echo $salary_scale_list->SalaryScale->editAttributes() ?>>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_list->SalaryScale->OldValue != null ? $salary_scale_list->SalaryScale->OldValue : $salary_scale_list->SalaryScale->CurrentValue) ?>">
<?php } ?>
<?php if ($salary_scale->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_scale_list->RowCount ?>_salary_scale_SalaryScale">
<span<?php echo $salary_scale_list->SalaryScale->viewAttributes() ?>><?php echo $salary_scale_list->SalaryScale->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_scale_list->ListOptions->render("body", "right", $salary_scale_list->RowCount);
?>
	</tr>
<?php if ($salary_scale->RowType == ROWTYPE_ADD || $salary_scale->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fsalary_scalelist", "load"], function() {
	fsalary_scalelist.updateLists(<?php echo $salary_scale_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$salary_scale_list->isGridAdd())
		if (!$salary_scale_list->Recordset->EOF)
			$salary_scale_list->Recordset->moveNext();
}
?>
<?php
	if ($salary_scale_list->isGridAdd() || $salary_scale_list->isGridEdit()) {
		$salary_scale_list->RowIndex = '$rowindex$';
		$salary_scale_list->loadRowValues();

		// Set row properties
		$salary_scale->resetAttributes();
		$salary_scale->RowAttrs->merge(["data-rowindex" => $salary_scale_list->RowIndex, "id" => "r0_salary_scale", "data-rowtype" => ROWTYPE_ADD]);
		$salary_scale->RowAttrs->appendClass("ew-template");
		$salary_scale->RowType = ROWTYPE_ADD;

		// Render row
		$salary_scale_list->renderRow();

		// Render list options
		$salary_scale_list->renderListOptions();
		$salary_scale_list->StartRowCount = 0;
?>
	<tr <?php echo $salary_scale->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_scale_list->ListOptions->render("body", "left", $salary_scale_list->RowIndex);
?>
	<?php if ($salary_scale_list->Division->Visible) { // Division ?>
		<td data-name="Division">
<?php if ($salary_scale_list->Division->getSessionValue() != "") { ?>
<span id="el$rowindex$_salary_scale_Division" class="form-group salary_scale_Division">
<span<?php echo $salary_scale_list->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_scale_list->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_salary_scale_Division" class="form-group salary_scale_Division">
<input type="text" data-table="salary_scale" data-field="x_Division" name="x<?php echo $salary_scale_list->RowIndex ?>_Division" id="x<?php echo $salary_scale_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($salary_scale_list->Division->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->Division->EditValue ?>"<?php echo $salary_scale_list->Division->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="salary_scale" data-field="x_Division" name="o<?php echo $salary_scale_list->RowIndex ?>_Division" id="o<?php echo $salary_scale_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($salary_scale_list->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_scale_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<span id="el$rowindex$_salary_scale_SalaryScale" class="form-group salary_scale_SalaryScale">
<input type="text" data-table="salary_scale" data-field="x_SalaryScale" name="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="x<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($salary_scale_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_scale_list->SalaryScale->EditValue ?>"<?php echo $salary_scale_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_scale" data-field="x_SalaryScale" name="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" id="o<?php echo $salary_scale_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_scale_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_scale_list->ListOptions->render("body", "right", $salary_scale_list->RowIndex);
?>
<script>
loadjs.ready(["fsalary_scalelist", "load"], function() {
	fsalary_scalelist.updateLists(<?php echo $salary_scale_list->RowIndex ?>);
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
<?php if ($salary_scale_list->isAdd() || $salary_scale_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $salary_scale_list->FormKeyCountName ?>" id="<?php echo $salary_scale_list->FormKeyCountName ?>" value="<?php echo $salary_scale_list->KeyCount ?>">
<?php } ?>
<?php if ($salary_scale_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $salary_scale_list->FormKeyCountName ?>" id="<?php echo $salary_scale_list->FormKeyCountName ?>" value="<?php echo $salary_scale_list->KeyCount ?>">
<?php echo $salary_scale_list->MultiSelectKey ?>
<?php } ?>
<?php if ($salary_scale_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $salary_scale_list->FormKeyCountName ?>" id="<?php echo $salary_scale_list->FormKeyCountName ?>" value="<?php echo $salary_scale_list->KeyCount ?>">
<?php } ?>
<?php if ($salary_scale_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $salary_scale_list->FormKeyCountName ?>" id="<?php echo $salary_scale_list->FormKeyCountName ?>" value="<?php echo $salary_scale_list->KeyCount ?>">
<?php echo $salary_scale_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$salary_scale->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($salary_scale_list->Recordset)
	$salary_scale_list->Recordset->Close();
?>
<?php if (!$salary_scale_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$salary_scale_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $salary_scale_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $salary_scale_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($salary_scale_list->TotalRecords == 0 && !$salary_scale->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $salary_scale_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$salary_scale_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$salary_scale_list->isExport()) { ?>
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
$salary_scale_list->terminate();
?>