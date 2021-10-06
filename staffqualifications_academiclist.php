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
$staffqualifications_academic_list = new staffqualifications_academic_list();

// Run the page
$staffqualifications_academic_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_academic_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffqualifications_academic_list->isExport()) { ?>
<script>
var fstaffqualifications_academiclist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaffqualifications_academiclist = currentForm = new ew.Form("fstaffqualifications_academiclist", "list");
	fstaffqualifications_academiclist.formKeyCountName = '<?php echo $staffqualifications_academic_list->FormKeyCountName ?>';

	// Validate form
	fstaffqualifications_academiclist.validate = function() {
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
			<?php if ($staffqualifications_academic_list->QualificationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_list->QualificationLevel->caption(), $staffqualifications_academic_list->QualificationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_list->QualificationRemarks->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationRemarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_list->QualificationRemarks->caption(), $staffqualifications_academic_list->QualificationRemarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_list->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_list->AwardingInstitution->caption(), $staffqualifications_academic_list->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_list->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_list->FromYear->caption(), $staffqualifications_academic_list->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_list->FromYear->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_list->YearObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_list->YearObtained->caption(), $staffqualifications_academic_list->YearObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_list->YearObtained->errorMessage()) ?>");

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
	fstaffqualifications_academiclist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "QualificationLevel", false)) return false;
		if (ew.valueChanged(fobj, infix, "QualificationRemarks", false)) return false;
		if (ew.valueChanged(fobj, infix, "AwardingInstitution", false)) return false;
		if (ew.valueChanged(fobj, infix, "FromYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "YearObtained", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffqualifications_academiclist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffqualifications_academiclist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffqualifications_academiclist.lists["x_QualificationLevel"] = <?php echo $staffqualifications_academic_list->QualificationLevel->Lookup->toClientList($staffqualifications_academic_list) ?>;
	fstaffqualifications_academiclist.lists["x_QualificationLevel"].options = <?php echo JsonEncode($staffqualifications_academic_list->QualificationLevel->lookupOptions()) ?>;
	loadjs.done("fstaffqualifications_academiclist");
});
var fstaffqualifications_academiclistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstaffqualifications_academiclistsrch = currentSearchForm = new ew.Form("fstaffqualifications_academiclistsrch");

	// Dynamic selection lists
	// Filters

	fstaffqualifications_academiclistsrch.filterList = <?php echo $staffqualifications_academic_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstaffqualifications_academiclistsrch.initSearchPanel = true;
	loadjs.done("fstaffqualifications_academiclistsrch");
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
<?php if (!$staffqualifications_academic_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staffqualifications_academic_list->TotalRecords > 0 && $staffqualifications_academic_list->ExportOptions->visible()) { ?>
<?php $staffqualifications_academic_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->ImportOptions->visible()) { ?>
<?php $staffqualifications_academic_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->SearchOptions->visible()) { ?>
<?php $staffqualifications_academic_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->FilterOptions->visible()) { ?>
<?php $staffqualifications_academic_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$staffqualifications_academic_list->isExport() || Config("EXPORT_MASTER_RECORD") && $staffqualifications_academic_list->isExport("print")) { ?>
<?php
if ($staffqualifications_academic_list->DbMasterFilter != "" && $staffqualifications_academic->getCurrentMasterTable() == "staff") {
	if ($staffqualifications_academic_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$staffqualifications_academic_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$staffqualifications_academic_list->isExport() && !$staffqualifications_academic->CurrentAction) { ?>
<form name="fstaffqualifications_academiclistsrch" id="fstaffqualifications_academiclistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstaffqualifications_academiclistsrch-search-panel" class="<?php echo $staffqualifications_academic_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="staffqualifications_academic">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $staffqualifications_academic_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($staffqualifications_academic_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($staffqualifications_academic_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $staffqualifications_academic_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($staffqualifications_academic_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($staffqualifications_academic_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($staffqualifications_academic_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($staffqualifications_academic_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $staffqualifications_academic_list->showPageHeader(); ?>
<?php
$staffqualifications_academic_list->showMessage();
?>
<?php if ($staffqualifications_academic_list->TotalRecords > 0 || $staffqualifications_academic->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffqualifications_academic_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffqualifications_academic">
<?php if (!$staffqualifications_academic_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staffqualifications_academic_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffqualifications_academic_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffqualifications_academic_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaffqualifications_academiclist" id="fstaffqualifications_academiclist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_academic">
<?php if ($staffqualifications_academic->getCurrentMasterTable() == "staff" && $staffqualifications_academic->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_staffqualifications_academic" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staffqualifications_academic_list->TotalRecords > 0 || $staffqualifications_academic_list->isGridEdit()) { ?>
<table id="tbl_staffqualifications_academiclist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffqualifications_academic->RowType = ROWTYPE_HEADER;

// Render list options
$staffqualifications_academic_list->renderListOptions();

// Render list options (header, left)
$staffqualifications_academic_list->ListOptions->render("header", "left");
?>
<?php if ($staffqualifications_academic_list->QualificationLevel->Visible) { // QualificationLevel ?>
	<?php if ($staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->QualificationLevel) == "") { ?>
		<th data-name="QualificationLevel" class="<?php echo $staffqualifications_academic_list->QualificationLevel->headerCellClass() ?>"><div id="elh_staffqualifications_academic_QualificationLevel" class="staffqualifications_academic_QualificationLevel"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->QualificationLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationLevel" class="<?php echo $staffqualifications_academic_list->QualificationLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->QualificationLevel) ?>', 1);"><div id="elh_staffqualifications_academic_QualificationLevel" class="staffqualifications_academic_QualificationLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->QualificationLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_list->QualificationLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_list->QualificationLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<?php if ($staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->QualificationRemarks) == "") { ?>
		<th data-name="QualificationRemarks" class="<?php echo $staffqualifications_academic_list->QualificationRemarks->headerCellClass() ?>"><div id="elh_staffqualifications_academic_QualificationRemarks" class="staffqualifications_academic_QualificationRemarks"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->QualificationRemarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationRemarks" class="<?php echo $staffqualifications_academic_list->QualificationRemarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->QualificationRemarks) ?>', 1);"><div id="elh_staffqualifications_academic_QualificationRemarks" class="staffqualifications_academic_QualificationRemarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->QualificationRemarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_list->QualificationRemarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_list->QualificationRemarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<?php if ($staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->AwardingInstitution) == "") { ?>
		<th data-name="AwardingInstitution" class="<?php echo $staffqualifications_academic_list->AwardingInstitution->headerCellClass() ?>"><div id="elh_staffqualifications_academic_AwardingInstitution" class="staffqualifications_academic_AwardingInstitution"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->AwardingInstitution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AwardingInstitution" class="<?php echo $staffqualifications_academic_list->AwardingInstitution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->AwardingInstitution) ?>', 1);"><div id="elh_staffqualifications_academic_AwardingInstitution" class="staffqualifications_academic_AwardingInstitution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->AwardingInstitution->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_list->AwardingInstitution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_list->AwardingInstitution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->FromYear->Visible) { // FromYear ?>
	<?php if ($staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->FromYear) == "") { ?>
		<th data-name="FromYear" class="<?php echo $staffqualifications_academic_list->FromYear->headerCellClass() ?>"><div id="elh_staffqualifications_academic_FromYear" class="staffqualifications_academic_FromYear"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->FromYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromYear" class="<?php echo $staffqualifications_academic_list->FromYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->FromYear) ?>', 1);"><div id="elh_staffqualifications_academic_FromYear" class="staffqualifications_academic_FromYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->FromYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_list->FromYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_list->FromYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->YearObtained->Visible) { // YearObtained ?>
	<?php if ($staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->YearObtained) == "") { ?>
		<th data-name="YearObtained" class="<?php echo $staffqualifications_academic_list->YearObtained->headerCellClass() ?>"><div id="elh_staffqualifications_academic_YearObtained" class="staffqualifications_academic_YearObtained"><div class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->YearObtained->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="YearObtained" class="<?php echo $staffqualifications_academic_list->YearObtained->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffqualifications_academic_list->SortUrl($staffqualifications_academic_list->YearObtained) ?>', 1);"><div id="elh_staffqualifications_academic_YearObtained" class="staffqualifications_academic_YearObtained">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_academic_list->YearObtained->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_academic_list->YearObtained->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_academic_list->YearObtained->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffqualifications_academic_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staffqualifications_academic_list->ExportAll && $staffqualifications_academic_list->isExport()) {
	$staffqualifications_academic_list->StopRecord = $staffqualifications_academic_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staffqualifications_academic_list->TotalRecords > $staffqualifications_academic_list->StartRecord + $staffqualifications_academic_list->DisplayRecords - 1)
		$staffqualifications_academic_list->StopRecord = $staffqualifications_academic_list->StartRecord + $staffqualifications_academic_list->DisplayRecords - 1;
	else
		$staffqualifications_academic_list->StopRecord = $staffqualifications_academic_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($staffqualifications_academic->isConfirm() || $staffqualifications_academic_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffqualifications_academic_list->FormKeyCountName) && ($staffqualifications_academic_list->isGridAdd() || $staffqualifications_academic_list->isGridEdit() || $staffqualifications_academic->isConfirm())) {
		$staffqualifications_academic_list->KeyCount = $CurrentForm->getValue($staffqualifications_academic_list->FormKeyCountName);
		$staffqualifications_academic_list->StopRecord = $staffqualifications_academic_list->StartRecord + $staffqualifications_academic_list->KeyCount - 1;
	}
}
$staffqualifications_academic_list->RecordCount = $staffqualifications_academic_list->StartRecord - 1;
if ($staffqualifications_academic_list->Recordset && !$staffqualifications_academic_list->Recordset->EOF) {
	$staffqualifications_academic_list->Recordset->moveFirst();
	$selectLimit = $staffqualifications_academic_list->UseSelectLimit;
	if (!$selectLimit && $staffqualifications_academic_list->StartRecord > 1)
		$staffqualifications_academic_list->Recordset->move($staffqualifications_academic_list->StartRecord - 1);
} elseif (!$staffqualifications_academic->AllowAddDeleteRow && $staffqualifications_academic_list->StopRecord == 0) {
	$staffqualifications_academic_list->StopRecord = $staffqualifications_academic->GridAddRowCount;
}

// Initialize aggregate
$staffqualifications_academic->RowType = ROWTYPE_AGGREGATEINIT;
$staffqualifications_academic->resetAttributes();
$staffqualifications_academic_list->renderRow();
if ($staffqualifications_academic_list->isGridAdd())
	$staffqualifications_academic_list->RowIndex = 0;
if ($staffqualifications_academic_list->isGridEdit())
	$staffqualifications_academic_list->RowIndex = 0;
while ($staffqualifications_academic_list->RecordCount < $staffqualifications_academic_list->StopRecord) {
	$staffqualifications_academic_list->RecordCount++;
	if ($staffqualifications_academic_list->RecordCount >= $staffqualifications_academic_list->StartRecord) {
		$staffqualifications_academic_list->RowCount++;
		if ($staffqualifications_academic_list->isGridAdd() || $staffqualifications_academic_list->isGridEdit() || $staffqualifications_academic->isConfirm()) {
			$staffqualifications_academic_list->RowIndex++;
			$CurrentForm->Index = $staffqualifications_academic_list->RowIndex;
			if ($CurrentForm->hasValue($staffqualifications_academic_list->FormActionName) && ($staffqualifications_academic->isConfirm() || $staffqualifications_academic_list->EventCancelled))
				$staffqualifications_academic_list->RowAction = strval($CurrentForm->getValue($staffqualifications_academic_list->FormActionName));
			elseif ($staffqualifications_academic_list->isGridAdd())
				$staffqualifications_academic_list->RowAction = "insert";
			else
				$staffqualifications_academic_list->RowAction = "";
		}

		// Set up key count
		$staffqualifications_academic_list->KeyCount = $staffqualifications_academic_list->RowIndex;

		// Init row class and style
		$staffqualifications_academic->resetAttributes();
		$staffqualifications_academic->CssClass = "";
		if ($staffqualifications_academic_list->isGridAdd()) {
			$staffqualifications_academic_list->loadRowValues(); // Load default values
		} else {
			$staffqualifications_academic_list->loadRowValues($staffqualifications_academic_list->Recordset); // Load row values
		}
		$staffqualifications_academic->RowType = ROWTYPE_VIEW; // Render view
		if ($staffqualifications_academic_list->isGridAdd()) // Grid add
			$staffqualifications_academic->RowType = ROWTYPE_ADD; // Render add
		if ($staffqualifications_academic_list->isGridAdd() && $staffqualifications_academic->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffqualifications_academic_list->restoreCurrentRowFormValues($staffqualifications_academic_list->RowIndex); // Restore form values
		if ($staffqualifications_academic_list->isGridEdit()) { // Grid edit
			if ($staffqualifications_academic->EventCancelled)
				$staffqualifications_academic_list->restoreCurrentRowFormValues($staffqualifications_academic_list->RowIndex); // Restore form values
			if ($staffqualifications_academic_list->RowAction == "insert")
				$staffqualifications_academic->RowType = ROWTYPE_ADD; // Render add
			else
				$staffqualifications_academic->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffqualifications_academic_list->isGridEdit() && ($staffqualifications_academic->RowType == ROWTYPE_EDIT || $staffqualifications_academic->RowType == ROWTYPE_ADD) && $staffqualifications_academic->EventCancelled) // Update failed
			$staffqualifications_academic_list->restoreCurrentRowFormValues($staffqualifications_academic_list->RowIndex); // Restore form values
		if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) // Edit row
			$staffqualifications_academic_list->EditRowCount++;

		// Set up row id / data-rowindex
		$staffqualifications_academic->RowAttrs->merge(["data-rowindex" => $staffqualifications_academic_list->RowCount, "id" => "r" . $staffqualifications_academic_list->RowCount . "_staffqualifications_academic", "data-rowtype" => $staffqualifications_academic->RowType]);

		// Render row
		$staffqualifications_academic_list->renderRow();

		// Render list options
		$staffqualifications_academic_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffqualifications_academic_list->RowAction != "delete" && $staffqualifications_academic_list->RowAction != "insertdelete" && !($staffqualifications_academic_list->RowAction == "insert" && $staffqualifications_academic->isConfirm() && $staffqualifications_academic_list->emptyRow())) {
?>
	<tr <?php echo $staffqualifications_academic->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffqualifications_academic_list->ListOptions->render("body", "left", $staffqualifications_academic_list->RowCount);
?>
	<?php if ($staffqualifications_academic_list->QualificationLevel->Visible) { // QualificationLevel ?>
		<td data-name="QualificationLevel" <?php echo $staffqualifications_academic_list->QualificationLevel->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_QualificationLevel" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_list->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_list->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_list->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_list->QualificationLevel->ReadOnly || $staffqualifications_academic_list->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_list->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_list, "p_x" . $staffqualifications_academic_list->RowIndex . "_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_list->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" value="<?php echo $staffqualifications_academic_list->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_list->QualificationLevel->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationLevel->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_list->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_list->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_list->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_list->QualificationLevel->ReadOnly || $staffqualifications_academic_list->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_list->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_list, "p_x" . $staffqualifications_academic_list->RowIndex . "_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_list->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" value="<?php echo $staffqualifications_academic_list->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_list->QualificationLevel->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationLevel->OldValue != null ? $staffqualifications_academic_list->QualificationLevel->OldValue : $staffqualifications_academic_list->QualificationLevel->CurrentValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_QualificationLevel">
<span<?php echo $staffqualifications_academic_list->QualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_academic_list->QualificationLevel->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_list->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_EmployeeID" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT || $staffqualifications_academic->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffqualifications_academic_list->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td data-name="QualificationRemarks" <?php echo $staffqualifications_academic_list->QualificationRemarks->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_QualificationRemarks" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_list->QualificationRemarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationRemarks->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_QualificationRemarks" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_list->QualificationRemarks->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_QualificationRemarks">
<span<?php echo $staffqualifications_academic_list->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_academic_list->QualificationRemarks->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_list->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution" <?php echo $staffqualifications_academic_list->AwardingInstitution->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_AwardingInstitution" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_list->AwardingInstitution->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_list->AwardingInstitution->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_AwardingInstitution" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_list->AwardingInstitution->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_AwardingInstitution">
<span<?php echo $staffqualifications_academic_list->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_academic_list->AwardingInstitution->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_list->FromYear->Visible) { // FromYear ?>
		<td data-name="FromYear" <?php echo $staffqualifications_academic_list->FromYear->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_FromYear" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_list->FromYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_list->FromYear->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_FromYear" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_list->FromYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_FromYear">
<span<?php echo $staffqualifications_academic_list->FromYear->viewAttributes() ?>><?php echo $staffqualifications_academic_list->FromYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_list->YearObtained->Visible) { // YearObtained ?>
		<td data-name="YearObtained" <?php echo $staffqualifications_academic_list->YearObtained->cellAttributes() ?>>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_YearObtained" class="form-group">
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_list->YearObtained->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_list->YearObtained->OldValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_list->YearObtained->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_list->YearObtained->OldValue != null ? $staffqualifications_academic_list->YearObtained->OldValue : $staffqualifications_academic_list->YearObtained->CurrentValue) ?>">
<?php } ?>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffqualifications_academic_list->RowCount ?>_staffqualifications_academic_YearObtained">
<span<?php echo $staffqualifications_academic_list->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_academic_list->YearObtained->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffqualifications_academic_list->ListOptions->render("body", "right", $staffqualifications_academic_list->RowCount);
?>
	</tr>
<?php if ($staffqualifications_academic->RowType == ROWTYPE_ADD || $staffqualifications_academic->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffqualifications_academiclist", "load"], function() {
	fstaffqualifications_academiclist.updateLists(<?php echo $staffqualifications_academic_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffqualifications_academic_list->isGridAdd())
		if (!$staffqualifications_academic_list->Recordset->EOF)
			$staffqualifications_academic_list->Recordset->moveNext();
}
?>
<?php
	if ($staffqualifications_academic_list->isGridAdd() || $staffqualifications_academic_list->isGridEdit()) {
		$staffqualifications_academic_list->RowIndex = '$rowindex$';
		$staffqualifications_academic_list->loadRowValues();

		// Set row properties
		$staffqualifications_academic->resetAttributes();
		$staffqualifications_academic->RowAttrs->merge(["data-rowindex" => $staffqualifications_academic_list->RowIndex, "id" => "r0_staffqualifications_academic", "data-rowtype" => ROWTYPE_ADD]);
		$staffqualifications_academic->RowAttrs->appendClass("ew-template");
		$staffqualifications_academic->RowType = ROWTYPE_ADD;

		// Render row
		$staffqualifications_academic_list->renderRow();

		// Render list options
		$staffqualifications_academic_list->renderListOptions();
		$staffqualifications_academic_list->StartRowCount = 0;
?>
	<tr <?php echo $staffqualifications_academic->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffqualifications_academic_list->ListOptions->render("body", "left", $staffqualifications_academic_list->RowIndex);
?>
	<?php if ($staffqualifications_academic_list->QualificationLevel->Visible) { // QualificationLevel ?>
		<td data-name="QualificationLevel">
<span id="el$rowindex$_staffqualifications_academic_QualificationLevel" class="form-group staffqualifications_academic_QualificationLevel">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_list->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_list->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_list->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_list->QualificationLevel->ReadOnly || $staffqualifications_academic_list->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_list->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_list, "p_x" . $staffqualifications_academic_list->RowIndex . "_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_list->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" value="<?php echo $staffqualifications_academic_list->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_list->QualificationLevel->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationLevel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_list->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<td data-name="QualificationRemarks">
<span id="el$rowindex$_staffqualifications_academic_QualificationRemarks" class="form-group staffqualifications_academic_QualificationRemarks">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_list->QualificationRemarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_QualificationRemarks" value="<?php echo HtmlEncode($staffqualifications_academic_list->QualificationRemarks->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_list->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<td data-name="AwardingInstitution">
<span id="el$rowindex$_staffqualifications_academic_AwardingInstitution" class="form-group staffqualifications_academic_AwardingInstitution">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_list->AwardingInstitution->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_AwardingInstitution" value="<?php echo HtmlEncode($staffqualifications_academic_list->AwardingInstitution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_list->FromYear->Visible) { // FromYear ?>
		<td data-name="FromYear">
<span id="el$rowindex$_staffqualifications_academic_FromYear" class="form-group staffqualifications_academic_FromYear">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_list->FromYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_FromYear" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_FromYear" value="<?php echo HtmlEncode($staffqualifications_academic_list->FromYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffqualifications_academic_list->YearObtained->Visible) { // YearObtained ?>
		<td data-name="YearObtained">
<span id="el$rowindex$_staffqualifications_academic_YearObtained" class="form-group staffqualifications_academic_YearObtained">
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" id="x<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_list->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_list->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_list->YearObtained->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" id="o<?php echo $staffqualifications_academic_list->RowIndex ?>_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_list->YearObtained->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffqualifications_academic_list->ListOptions->render("body", "right", $staffqualifications_academic_list->RowIndex);
?>
<script>
loadjs.ready(["fstaffqualifications_academiclist", "load"], function() {
	fstaffqualifications_academiclist.updateLists(<?php echo $staffqualifications_academic_list->RowIndex ?>);
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
<?php if ($staffqualifications_academic_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $staffqualifications_academic_list->FormKeyCountName ?>" id="<?php echo $staffqualifications_academic_list->FormKeyCountName ?>" value="<?php echo $staffqualifications_academic_list->KeyCount ?>">
<?php echo $staffqualifications_academic_list->MultiSelectKey ?>
<?php } ?>
<?php if ($staffqualifications_academic_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $staffqualifications_academic_list->FormKeyCountName ?>" id="<?php echo $staffqualifications_academic_list->FormKeyCountName ?>" value="<?php echo $staffqualifications_academic_list->KeyCount ?>">
<?php echo $staffqualifications_academic_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$staffqualifications_academic->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffqualifications_academic_list->Recordset)
	$staffqualifications_academic_list->Recordset->Close();
?>
<?php if (!$staffqualifications_academic_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staffqualifications_academic_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffqualifications_academic_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffqualifications_academic_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffqualifications_academic_list->TotalRecords == 0 && !$staffqualifications_academic->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffqualifications_academic_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staffqualifications_academic_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffqualifications_academic_list->isExport()) { ?>
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
$staffqualifications_academic_list->terminate();
?>