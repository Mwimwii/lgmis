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
$salary_notch_list = new salary_notch_list();

// Run the page
$salary_notch_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$salary_notch_list->isExport()) { ?>
<script>
var fsalary_notchlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsalary_notchlist = currentForm = new ew.Form("fsalary_notchlist", "list");
	fsalary_notchlist.formKeyCountName = '<?php echo $salary_notch_list->FormKeyCountName ?>';

	// Validate form
	fsalary_notchlist.validate = function() {
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
			<?php if ($salary_notch_list->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_list->SalaryScale->caption(), $salary_notch_list->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($salary_notch_list->Notch->Required) { ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_list->Notch->caption(), $salary_notch_list->Notch->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_list->Notch->errorMessage()) ?>");
			<?php if ($salary_notch_list->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_list->BasicMonthlySalary->caption(), $salary_notch_list->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_list->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($salary_notch_list->AnnualSalary->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_list->AnnualSalary->caption(), $salary_notch_list->AnnualSalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_list->AnnualSalary->errorMessage()) ?>");

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
	fsalary_notchlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "Notch", false)) return false;
		if (ew.valueChanged(fobj, infix, "BasicMonthlySalary", false)) return false;
		if (ew.valueChanged(fobj, infix, "AnnualSalary", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fsalary_notchlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsalary_notchlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsalary_notchlist");
});
var fsalary_notchlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsalary_notchlistsrch = currentSearchForm = new ew.Form("fsalary_notchlistsrch");

	// Dynamic selection lists
	// Filters

	fsalary_notchlistsrch.filterList = <?php echo $salary_notch_list->getFilterList() ?>;

	// Init search panel as collapsed
	fsalary_notchlistsrch.initSearchPanel = true;
	loadjs.done("fsalary_notchlistsrch");
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
<?php if (!$salary_notch_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($salary_notch_list->TotalRecords > 0 && $salary_notch_list->ExportOptions->visible()) { ?>
<?php $salary_notch_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($salary_notch_list->ImportOptions->visible()) { ?>
<?php $salary_notch_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($salary_notch_list->SearchOptions->visible()) { ?>
<?php $salary_notch_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($salary_notch_list->FilterOptions->visible()) { ?>
<?php $salary_notch_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$salary_notch_list->isExport() || Config("EXPORT_MASTER_RECORD") && $salary_notch_list->isExport("print")) { ?>
<?php
if ($salary_notch_list->DbMasterFilter != "" && $salary_notch->getCurrentMasterTable() == "salary_scale") {
	if ($salary_notch_list->MasterRecordExists) {
		include_once "salary_scalemaster.php";
	}
}
?>
<?php } ?>
<?php
$salary_notch_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$salary_notch_list->isExport() && !$salary_notch->CurrentAction) { ?>
<form name="fsalary_notchlistsrch" id="fsalary_notchlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsalary_notchlistsrch-search-panel" class="<?php echo $salary_notch_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="salary_notch">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $salary_notch_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($salary_notch_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($salary_notch_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $salary_notch_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($salary_notch_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($salary_notch_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($salary_notch_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($salary_notch_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $salary_notch_list->showPageHeader(); ?>
<?php
$salary_notch_list->showMessage();
?>
<?php if ($salary_notch_list->TotalRecords > 0 || $salary_notch->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($salary_notch_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> salary_notch">
<?php if (!$salary_notch_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$salary_notch_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $salary_notch_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $salary_notch_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsalary_notchlist" id="fsalary_notchlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="salary_notch">
<?php if ($salary_notch->getCurrentMasterTable() == "salary_scale" && $salary_notch->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="salary_scale">
<input type="hidden" name="fk_SalaryScale" value="<?php echo HtmlEncode($salary_notch_list->SalaryScale->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_salary_notch" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($salary_notch_list->TotalRecords > 0 || $salary_notch_list->isGridEdit()) { ?>
<table id="tbl_salary_notchlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$salary_notch->RowType = ROWTYPE_HEADER;

// Render list options
$salary_notch_list->renderListOptions();

// Render list options (header, left)
$salary_notch_list->ListOptions->render("header", "left");
?>
<?php if ($salary_notch_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($salary_notch_list->SortUrl($salary_notch_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_notch_list->SalaryScale->headerCellClass() ?>"><div id="elh_salary_notch_SalaryScale" class="salary_notch_SalaryScale"><div class="ew-table-header-caption"><?php echo $salary_notch_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $salary_notch_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $salary_notch_list->SortUrl($salary_notch_list->SalaryScale) ?>', 1);"><div id="elh_salary_notch_SalaryScale" class="salary_notch_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_list->Notch->Visible) { // Notch ?>
	<?php if ($salary_notch_list->SortUrl($salary_notch_list->Notch) == "") { ?>
		<th data-name="Notch" class="<?php echo $salary_notch_list->Notch->headerCellClass() ?>"><div id="elh_salary_notch_Notch" class="salary_notch_Notch"><div class="ew-table-header-caption"><?php echo $salary_notch_list->Notch->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Notch" class="<?php echo $salary_notch_list->Notch->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $salary_notch_list->SortUrl($salary_notch_list->Notch) ?>', 1);"><div id="elh_salary_notch_Notch" class="salary_notch_Notch">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_list->Notch->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_list->Notch->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_list->Notch->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($salary_notch_list->SortUrl($salary_notch_list->BasicMonthlySalary) == "") { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $salary_notch_list->BasicMonthlySalary->headerCellClass() ?>"><div id="elh_salary_notch_BasicMonthlySalary" class="salary_notch_BasicMonthlySalary"><div class="ew-table-header-caption"><?php echo $salary_notch_list->BasicMonthlySalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $salary_notch_list->BasicMonthlySalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $salary_notch_list->SortUrl($salary_notch_list->BasicMonthlySalary) ?>', 1);"><div id="elh_salary_notch_BasicMonthlySalary" class="salary_notch_BasicMonthlySalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_list->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_list->BasicMonthlySalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_list->BasicMonthlySalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($salary_notch_list->AnnualSalary->Visible) { // AnnualSalary ?>
	<?php if ($salary_notch_list->SortUrl($salary_notch_list->AnnualSalary) == "") { ?>
		<th data-name="AnnualSalary" class="<?php echo $salary_notch_list->AnnualSalary->headerCellClass() ?>"><div id="elh_salary_notch_AnnualSalary" class="salary_notch_AnnualSalary"><div class="ew-table-header-caption"><?php echo $salary_notch_list->AnnualSalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AnnualSalary" class="<?php echo $salary_notch_list->AnnualSalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $salary_notch_list->SortUrl($salary_notch_list->AnnualSalary) ?>', 1);"><div id="elh_salary_notch_AnnualSalary" class="salary_notch_AnnualSalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $salary_notch_list->AnnualSalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($salary_notch_list->AnnualSalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($salary_notch_list->AnnualSalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$salary_notch_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($salary_notch_list->ExportAll && $salary_notch_list->isExport()) {
	$salary_notch_list->StopRecord = $salary_notch_list->TotalRecords;
} else {

	// Set the last record to display
	if ($salary_notch_list->TotalRecords > $salary_notch_list->StartRecord + $salary_notch_list->DisplayRecords - 1)
		$salary_notch_list->StopRecord = $salary_notch_list->StartRecord + $salary_notch_list->DisplayRecords - 1;
	else
		$salary_notch_list->StopRecord = $salary_notch_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($salary_notch->isConfirm() || $salary_notch_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($salary_notch_list->FormKeyCountName) && ($salary_notch_list->isGridAdd() || $salary_notch_list->isGridEdit() || $salary_notch->isConfirm())) {
		$salary_notch_list->KeyCount = $CurrentForm->getValue($salary_notch_list->FormKeyCountName);
		$salary_notch_list->StopRecord = $salary_notch_list->StartRecord + $salary_notch_list->KeyCount - 1;
	}
}
$salary_notch_list->RecordCount = $salary_notch_list->StartRecord - 1;
if ($salary_notch_list->Recordset && !$salary_notch_list->Recordset->EOF) {
	$salary_notch_list->Recordset->moveFirst();
	$selectLimit = $salary_notch_list->UseSelectLimit;
	if (!$selectLimit && $salary_notch_list->StartRecord > 1)
		$salary_notch_list->Recordset->move($salary_notch_list->StartRecord - 1);
} elseif (!$salary_notch->AllowAddDeleteRow && $salary_notch_list->StopRecord == 0) {
	$salary_notch_list->StopRecord = $salary_notch->GridAddRowCount;
}

// Initialize aggregate
$salary_notch->RowType = ROWTYPE_AGGREGATEINIT;
$salary_notch->resetAttributes();
$salary_notch_list->renderRow();
if ($salary_notch_list->isGridAdd())
	$salary_notch_list->RowIndex = 0;
if ($salary_notch_list->isGridEdit())
	$salary_notch_list->RowIndex = 0;
while ($salary_notch_list->RecordCount < $salary_notch_list->StopRecord) {
	$salary_notch_list->RecordCount++;
	if ($salary_notch_list->RecordCount >= $salary_notch_list->StartRecord) {
		$salary_notch_list->RowCount++;
		if ($salary_notch_list->isGridAdd() || $salary_notch_list->isGridEdit() || $salary_notch->isConfirm()) {
			$salary_notch_list->RowIndex++;
			$CurrentForm->Index = $salary_notch_list->RowIndex;
			if ($CurrentForm->hasValue($salary_notch_list->FormActionName) && ($salary_notch->isConfirm() || $salary_notch_list->EventCancelled))
				$salary_notch_list->RowAction = strval($CurrentForm->getValue($salary_notch_list->FormActionName));
			elseif ($salary_notch_list->isGridAdd())
				$salary_notch_list->RowAction = "insert";
			else
				$salary_notch_list->RowAction = "";
		}

		// Set up key count
		$salary_notch_list->KeyCount = $salary_notch_list->RowIndex;

		// Init row class and style
		$salary_notch->resetAttributes();
		$salary_notch->CssClass = "";
		if ($salary_notch_list->isGridAdd()) {
			$salary_notch_list->loadRowValues(); // Load default values
		} else {
			$salary_notch_list->loadRowValues($salary_notch_list->Recordset); // Load row values
		}
		$salary_notch->RowType = ROWTYPE_VIEW; // Render view
		if ($salary_notch_list->isGridAdd()) // Grid add
			$salary_notch->RowType = ROWTYPE_ADD; // Render add
		if ($salary_notch_list->isGridAdd() && $salary_notch->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$salary_notch_list->restoreCurrentRowFormValues($salary_notch_list->RowIndex); // Restore form values
		if ($salary_notch_list->isGridEdit()) { // Grid edit
			if ($salary_notch->EventCancelled)
				$salary_notch_list->restoreCurrentRowFormValues($salary_notch_list->RowIndex); // Restore form values
			if ($salary_notch_list->RowAction == "insert")
				$salary_notch->RowType = ROWTYPE_ADD; // Render add
			else
				$salary_notch->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($salary_notch_list->isGridEdit() && ($salary_notch->RowType == ROWTYPE_EDIT || $salary_notch->RowType == ROWTYPE_ADD) && $salary_notch->EventCancelled) // Update failed
			$salary_notch_list->restoreCurrentRowFormValues($salary_notch_list->RowIndex); // Restore form values
		if ($salary_notch->RowType == ROWTYPE_EDIT) // Edit row
			$salary_notch_list->EditRowCount++;

		// Set up row id / data-rowindex
		$salary_notch->RowAttrs->merge(["data-rowindex" => $salary_notch_list->RowCount, "id" => "r" . $salary_notch_list->RowCount . "_salary_notch", "data-rowtype" => $salary_notch->RowType]);

		// Render row
		$salary_notch_list->renderRow();

		// Render list options
		$salary_notch_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($salary_notch_list->RowAction != "delete" && $salary_notch_list->RowAction != "insertdelete" && !($salary_notch_list->RowAction == "insert" && $salary_notch->isConfirm() && $salary_notch_list->emptyRow())) {
?>
	<tr <?php echo $salary_notch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_notch_list->ListOptions->render("body", "left", $salary_notch_list->RowCount);
?>
	<?php if ($salary_notch_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $salary_notch_list->SalaryScale->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($salary_notch_list->SalaryScale->getSessionValue() != "") { ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_SalaryScale" class="form-group">
<span<?php echo $salary_notch_list->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_list->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" name="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_list->SalaryScale->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_SalaryScale" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->SalaryScale->EditValue ?>"<?php echo $salary_notch_list->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" id="o<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_list->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($salary_notch_list->SalaryScale->getSessionValue() != "") { ?>

<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_SalaryScale" class="form-group">
<span<?php echo $salary_notch_list->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_list->SalaryScale->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" name="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_list->SalaryScale->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->SalaryScale->EditValue ?>"<?php echo $salary_notch_list->SalaryScale->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" id="o<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_list->SalaryScale->OldValue != null ? $salary_notch_list->SalaryScale->OldValue : $salary_notch_list->SalaryScale->CurrentValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_SalaryScale">
<span<?php echo $salary_notch_list->SalaryScale->viewAttributes() ?>><?php echo $salary_notch_list->SalaryScale->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_notch_list->Notch->Visible) { // Notch ?>
		<td data-name="Notch" <?php echo $salary_notch_list->Notch->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_Notch" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_list->RowIndex ?>_Notch" id="x<?php echo $salary_notch_list->RowIndex ?>_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->Notch->EditValue ?>"<?php echo $salary_notch_list->Notch->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o<?php echo $salary_notch_list->RowIndex ?>_Notch" id="o<?php echo $salary_notch_list->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_list->Notch->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_list->RowIndex ?>_Notch" id="x<?php echo $salary_notch_list->RowIndex ?>_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->Notch->EditValue ?>"<?php echo $salary_notch_list->Notch->editAttributes() ?>>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o<?php echo $salary_notch_list->RowIndex ?>_Notch" id="o<?php echo $salary_notch_list->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_list->Notch->OldValue != null ? $salary_notch_list->Notch->OldValue : $salary_notch_list->Notch->CurrentValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_Notch">
<span<?php echo $salary_notch_list->Notch->viewAttributes() ?>><?php echo $salary_notch_list->Notch->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_notch_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary" <?php echo $salary_notch_list->BasicMonthlySalary->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_BasicMonthlySalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_list->BasicMonthlySalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="o<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_list->BasicMonthlySalary->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_BasicMonthlySalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_list->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_BasicMonthlySalary">
<span<?php echo $salary_notch_list->BasicMonthlySalary->viewAttributes() ?>><?php echo $salary_notch_list->BasicMonthlySalary->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($salary_notch_list->AnnualSalary->Visible) { // AnnualSalary ?>
		<td data-name="AnnualSalary" <?php echo $salary_notch_list->AnnualSalary->cellAttributes() ?>>
<?php if ($salary_notch->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_AnnualSalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->AnnualSalary->EditValue ?>"<?php echo $salary_notch_list->AnnualSalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="o<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" id="o<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_list->AnnualSalary->OldValue) ?>">
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_AnnualSalary" class="form-group">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->AnnualSalary->EditValue ?>"<?php echo $salary_notch_list->AnnualSalary->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($salary_notch->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $salary_notch_list->RowCount ?>_salary_notch_AnnualSalary">
<span<?php echo $salary_notch_list->AnnualSalary->viewAttributes() ?>><?php echo $salary_notch_list->AnnualSalary->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_notch_list->ListOptions->render("body", "right", $salary_notch_list->RowCount);
?>
	</tr>
<?php if ($salary_notch->RowType == ROWTYPE_ADD || $salary_notch->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fsalary_notchlist", "load"], function() {
	fsalary_notchlist.updateLists(<?php echo $salary_notch_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$salary_notch_list->isGridAdd())
		if (!$salary_notch_list->Recordset->EOF)
			$salary_notch_list->Recordset->moveNext();
}
?>
<?php
	if ($salary_notch_list->isGridAdd() || $salary_notch_list->isGridEdit()) {
		$salary_notch_list->RowIndex = '$rowindex$';
		$salary_notch_list->loadRowValues();

		// Set row properties
		$salary_notch->resetAttributes();
		$salary_notch->RowAttrs->merge(["data-rowindex" => $salary_notch_list->RowIndex, "id" => "r0_salary_notch", "data-rowtype" => ROWTYPE_ADD]);
		$salary_notch->RowAttrs->appendClass("ew-template");
		$salary_notch->RowType = ROWTYPE_ADD;

		// Render row
		$salary_notch_list->renderRow();

		// Render list options
		$salary_notch_list->renderListOptions();
		$salary_notch_list->StartRowCount = 0;
?>
	<tr <?php echo $salary_notch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$salary_notch_list->ListOptions->render("body", "left", $salary_notch_list->RowIndex);
?>
	<?php if ($salary_notch_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<?php if ($salary_notch_list->SalaryScale->getSessionValue() != "") { ?>
<span id="el$rowindex$_salary_notch_SalaryScale" class="form-group salary_notch_SalaryScale">
<span<?php echo $salary_notch_list->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_list->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" name="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_list->SalaryScale->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_salary_notch_SalaryScale" class="form-group salary_notch_SalaryScale">
<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" id="x<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->SalaryScale->EditValue ?>"<?php echo $salary_notch_list->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" id="o<?php echo $salary_notch_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($salary_notch_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_notch_list->Notch->Visible) { // Notch ?>
		<td data-name="Notch">
<span id="el$rowindex$_salary_notch_Notch" class="form-group salary_notch_Notch">
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x<?php echo $salary_notch_list->RowIndex ?>_Notch" id="x<?php echo $salary_notch_list->RowIndex ?>_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->Notch->EditValue ?>"<?php echo $salary_notch_list->Notch->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o<?php echo $salary_notch_list->RowIndex ?>_Notch" id="o<?php echo $salary_notch_list->RowIndex ?>_Notch" value="<?php echo HtmlEncode($salary_notch_list->Notch->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_notch_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary">
<span id="el$rowindex$_salary_notch_BasicMonthlySalary" class="form-group salary_notch_BasicMonthlySalary">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_list->BasicMonthlySalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="o<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $salary_notch_list->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($salary_notch_list->BasicMonthlySalary->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($salary_notch_list->AnnualSalary->Visible) { // AnnualSalary ?>
		<td data-name="AnnualSalary">
<span id="el$rowindex$_salary_notch_AnnualSalary" class="form-group salary_notch_AnnualSalary">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" id="x<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_list->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_list->AnnualSalary->EditValue ?>"<?php echo $salary_notch_list->AnnualSalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="salary_notch" data-field="x_AnnualSalary" name="o<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" id="o<?php echo $salary_notch_list->RowIndex ?>_AnnualSalary" value="<?php echo HtmlEncode($salary_notch_list->AnnualSalary->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$salary_notch_list->ListOptions->render("body", "right", $salary_notch_list->RowIndex);
?>
<script>
loadjs.ready(["fsalary_notchlist", "load"], function() {
	fsalary_notchlist.updateLists(<?php echo $salary_notch_list->RowIndex ?>);
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
<?php if ($salary_notch_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $salary_notch_list->FormKeyCountName ?>" id="<?php echo $salary_notch_list->FormKeyCountName ?>" value="<?php echo $salary_notch_list->KeyCount ?>">
<?php echo $salary_notch_list->MultiSelectKey ?>
<?php } ?>
<?php if ($salary_notch_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $salary_notch_list->FormKeyCountName ?>" id="<?php echo $salary_notch_list->FormKeyCountName ?>" value="<?php echo $salary_notch_list->KeyCount ?>">
<?php echo $salary_notch_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$salary_notch->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($salary_notch_list->Recordset)
	$salary_notch_list->Recordset->Close();
?>
<?php if (!$salary_notch_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$salary_notch_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $salary_notch_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $salary_notch_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($salary_notch_list->TotalRecords == 0 && !$salary_notch->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $salary_notch_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$salary_notch_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$salary_notch_list->isExport()) { ?>
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
$salary_notch_list->terminate();
?>