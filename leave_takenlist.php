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
$leave_taken_list = new leave_taken_list();

// Run the page
$leave_taken_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_taken_list->isExport()) { ?>
<script>
var fleave_takenlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fleave_takenlist = currentForm = new ew.Form("fleave_takenlist", "list");
	fleave_takenlist.formKeyCountName = '<?php echo $leave_taken_list->FormKeyCountName ?>';

	// Validate form
	fleave_takenlist.validate = function() {
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
			<?php if ($leave_taken_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->EmployeeID->caption(), $leave_taken_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_list->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_taken_list->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->LeaveTypeCode->caption(), $leave_taken_list->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_list->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->StartDate->caption(), $leave_taken_list->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_list->StartDate->errorMessage()) ?>");
			<?php if ($leave_taken_list->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->EndDate->caption(), $leave_taken_list->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_list->EndDate->errorMessage()) ?>");
			<?php if ($leave_taken_list->Commuted->Required) { ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->Commuted->caption(), $leave_taken_list->Commuted->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_list->Commuted->errorMessage()) ?>");
			<?php if ($leave_taken_list->LeaveDays->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->LeaveDays->caption(), $leave_taken_list->LeaveDays->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_list->LeaveDays->errorMessage()) ?>");
			<?php if ($leave_taken_list->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->Location->caption(), $leave_taken_list->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_list->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_list->Remarks->caption(), $leave_taken_list->Remarks->RequiredErrorMessage)) ?>");
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
	fleave_takenlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveTypeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Commuted", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveDays", false)) return false;
		if (ew.valueChanged(fobj, infix, "Location", false)) return false;
		if (ew.valueChanged(fobj, infix, "Remarks", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fleave_takenlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_takenlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_takenlist.lists["x_LeaveTypeCode"] = <?php echo $leave_taken_list->LeaveTypeCode->Lookup->toClientList($leave_taken_list) ?>;
	fleave_takenlist.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_taken_list->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_takenlist");
});
var fleave_takenlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fleave_takenlistsrch = currentSearchForm = new ew.Form("fleave_takenlistsrch");

	// Dynamic selection lists
	// Filters

	fleave_takenlistsrch.filterList = <?php echo $leave_taken_list->getFilterList() ?>;

	// Init search panel as collapsed
	fleave_takenlistsrch.initSearchPanel = true;
	loadjs.done("fleave_takenlistsrch");
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
<?php if (!$leave_taken_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($leave_taken_list->TotalRecords > 0 && $leave_taken_list->ExportOptions->visible()) { ?>
<?php $leave_taken_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_taken_list->ImportOptions->visible()) { ?>
<?php $leave_taken_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_taken_list->SearchOptions->visible()) { ?>
<?php $leave_taken_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($leave_taken_list->FilterOptions->visible()) { ?>
<?php $leave_taken_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$leave_taken_list->isExport() || Config("EXPORT_MASTER_RECORD") && $leave_taken_list->isExport("print")) { ?>
<?php
if ($leave_taken_list->DbMasterFilter != "" && $leave_taken->getCurrentMasterTable() == "employment") {
	if ($leave_taken_list->MasterRecordExists) {
		include_once "employmentmaster.php";
	}
}
?>
<?php } ?>
<?php
$leave_taken_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$leave_taken_list->isExport() && !$leave_taken->CurrentAction) { ?>
<form name="fleave_takenlistsrch" id="fleave_takenlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fleave_takenlistsrch-search-panel" class="<?php echo $leave_taken_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="leave_taken">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $leave_taken_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($leave_taken_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($leave_taken_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $leave_taken_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($leave_taken_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($leave_taken_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($leave_taken_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($leave_taken_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $leave_taken_list->showPageHeader(); ?>
<?php
$leave_taken_list->showMessage();
?>
<?php if ($leave_taken_list->TotalRecords > 0 || $leave_taken->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_taken_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_taken">
<?php if (!$leave_taken_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$leave_taken_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_taken_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_taken_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fleave_takenlist" id="fleave_takenlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_taken">
<?php if ($leave_taken->getCurrentMasterTable() == "employment" && $leave_taken->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($leave_taken_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_leave_taken" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($leave_taken_list->TotalRecords > 0 || $leave_taken_list->isGridEdit()) { ?>
<table id="tbl_leave_takenlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_taken->RowType = ROWTYPE_HEADER;

// Render list options
$leave_taken_list->renderListOptions();

// Render list options (header, left)
$leave_taken_list->ListOptions->render("header", "left");
?>
<?php if ($leave_taken_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_taken_list->EmployeeID->headerCellClass() ?>"><div id="elh_leave_taken_EmployeeID" class="leave_taken_EmployeeID"><div class="ew-table-header-caption"><?php echo $leave_taken_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_taken_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->EmployeeID) ?>', 1);"><div id="elh_leave_taken_EmployeeID" class="leave_taken_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_taken_list->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_taken_LeaveTypeCode" class="leave_taken_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_taken_list->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_taken_list->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->LeaveTypeCode) ?>', 1);"><div id="elh_leave_taken_LeaveTypeCode" class="leave_taken_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_list->StartDate->Visible) { // StartDate ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $leave_taken_list->StartDate->headerCellClass() ?>"><div id="elh_leave_taken_StartDate" class="leave_taken_StartDate"><div class="ew-table-header-caption"><?php echo $leave_taken_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $leave_taken_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->StartDate) ?>', 1);"><div id="elh_leave_taken_StartDate" class="leave_taken_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_list->EndDate->Visible) { // EndDate ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $leave_taken_list->EndDate->headerCellClass() ?>"><div id="elh_leave_taken_EndDate" class="leave_taken_EndDate"><div class="ew-table-header-caption"><?php echo $leave_taken_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $leave_taken_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->EndDate) ?>', 1);"><div id="elh_leave_taken_EndDate" class="leave_taken_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_list->Commuted->Visible) { // Commuted ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->Commuted) == "") { ?>
		<th data-name="Commuted" class="<?php echo $leave_taken_list->Commuted->headerCellClass() ?>"><div id="elh_leave_taken_Commuted" class="leave_taken_Commuted"><div class="ew-table-header-caption"><?php echo $leave_taken_list->Commuted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Commuted" class="<?php echo $leave_taken_list->Commuted->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->Commuted) ?>', 1);"><div id="elh_leave_taken_Commuted" class="leave_taken_Commuted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->Commuted->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->Commuted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->Commuted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_list->LeaveDays->Visible) { // LeaveDays ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->LeaveDays) == "") { ?>
		<th data-name="LeaveDays" class="<?php echo $leave_taken_list->LeaveDays->headerCellClass() ?>"><div id="elh_leave_taken_LeaveDays" class="leave_taken_LeaveDays"><div class="ew-table-header-caption"><?php echo $leave_taken_list->LeaveDays->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveDays" class="<?php echo $leave_taken_list->LeaveDays->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->LeaveDays) ?>', 1);"><div id="elh_leave_taken_LeaveDays" class="leave_taken_LeaveDays">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->LeaveDays->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->LeaveDays->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->LeaveDays->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_list->Location->Visible) { // Location ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $leave_taken_list->Location->headerCellClass() ?>"><div id="elh_leave_taken_Location" class="leave_taken_Location"><div class="ew-table-header-caption"><?php echo $leave_taken_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $leave_taken_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->Location) ?>', 1);"><div id="elh_leave_taken_Location" class="leave_taken_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_taken_list->Remarks->Visible) { // Remarks ?>
	<?php if ($leave_taken_list->SortUrl($leave_taken_list->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $leave_taken_list->Remarks->headerCellClass() ?>"><div id="elh_leave_taken_Remarks" class="leave_taken_Remarks"><div class="ew-table-header-caption"><?php echo $leave_taken_list->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $leave_taken_list->Remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_taken_list->SortUrl($leave_taken_list->Remarks) ?>', 1);"><div id="elh_leave_taken_Remarks" class="leave_taken_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_taken_list->Remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_taken_list->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_taken_list->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_taken_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($leave_taken_list->ExportAll && $leave_taken_list->isExport()) {
	$leave_taken_list->StopRecord = $leave_taken_list->TotalRecords;
} else {

	// Set the last record to display
	if ($leave_taken_list->TotalRecords > $leave_taken_list->StartRecord + $leave_taken_list->DisplayRecords - 1)
		$leave_taken_list->StopRecord = $leave_taken_list->StartRecord + $leave_taken_list->DisplayRecords - 1;
	else
		$leave_taken_list->StopRecord = $leave_taken_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($leave_taken->isConfirm() || $leave_taken_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($leave_taken_list->FormKeyCountName) && ($leave_taken_list->isGridAdd() || $leave_taken_list->isGridEdit() || $leave_taken->isConfirm())) {
		$leave_taken_list->KeyCount = $CurrentForm->getValue($leave_taken_list->FormKeyCountName);
		$leave_taken_list->StopRecord = $leave_taken_list->StartRecord + $leave_taken_list->KeyCount - 1;
	}
}
$leave_taken_list->RecordCount = $leave_taken_list->StartRecord - 1;
if ($leave_taken_list->Recordset && !$leave_taken_list->Recordset->EOF) {
	$leave_taken_list->Recordset->moveFirst();
	$selectLimit = $leave_taken_list->UseSelectLimit;
	if (!$selectLimit && $leave_taken_list->StartRecord > 1)
		$leave_taken_list->Recordset->move($leave_taken_list->StartRecord - 1);
} elseif (!$leave_taken->AllowAddDeleteRow && $leave_taken_list->StopRecord == 0) {
	$leave_taken_list->StopRecord = $leave_taken->GridAddRowCount;
}

// Initialize aggregate
$leave_taken->RowType = ROWTYPE_AGGREGATEINIT;
$leave_taken->resetAttributes();
$leave_taken_list->renderRow();
if ($leave_taken_list->isGridAdd())
	$leave_taken_list->RowIndex = 0;
if ($leave_taken_list->isGridEdit())
	$leave_taken_list->RowIndex = 0;
while ($leave_taken_list->RecordCount < $leave_taken_list->StopRecord) {
	$leave_taken_list->RecordCount++;
	if ($leave_taken_list->RecordCount >= $leave_taken_list->StartRecord) {
		$leave_taken_list->RowCount++;
		if ($leave_taken_list->isGridAdd() || $leave_taken_list->isGridEdit() || $leave_taken->isConfirm()) {
			$leave_taken_list->RowIndex++;
			$CurrentForm->Index = $leave_taken_list->RowIndex;
			if ($CurrentForm->hasValue($leave_taken_list->FormActionName) && ($leave_taken->isConfirm() || $leave_taken_list->EventCancelled))
				$leave_taken_list->RowAction = strval($CurrentForm->getValue($leave_taken_list->FormActionName));
			elseif ($leave_taken_list->isGridAdd())
				$leave_taken_list->RowAction = "insert";
			else
				$leave_taken_list->RowAction = "";
		}

		// Set up key count
		$leave_taken_list->KeyCount = $leave_taken_list->RowIndex;

		// Init row class and style
		$leave_taken->resetAttributes();
		$leave_taken->CssClass = "";
		if ($leave_taken_list->isGridAdd()) {
			$leave_taken_list->loadRowValues(); // Load default values
		} else {
			$leave_taken_list->loadRowValues($leave_taken_list->Recordset); // Load row values
		}
		$leave_taken->RowType = ROWTYPE_VIEW; // Render view
		if ($leave_taken_list->isGridAdd()) // Grid add
			$leave_taken->RowType = ROWTYPE_ADD; // Render add
		if ($leave_taken_list->isGridAdd() && $leave_taken->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$leave_taken_list->restoreCurrentRowFormValues($leave_taken_list->RowIndex); // Restore form values
		if ($leave_taken_list->isGridEdit()) { // Grid edit
			if ($leave_taken->EventCancelled)
				$leave_taken_list->restoreCurrentRowFormValues($leave_taken_list->RowIndex); // Restore form values
			if ($leave_taken_list->RowAction == "insert")
				$leave_taken->RowType = ROWTYPE_ADD; // Render add
			else
				$leave_taken->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($leave_taken_list->isGridEdit() && ($leave_taken->RowType == ROWTYPE_EDIT || $leave_taken->RowType == ROWTYPE_ADD) && $leave_taken->EventCancelled) // Update failed
			$leave_taken_list->restoreCurrentRowFormValues($leave_taken_list->RowIndex); // Restore form values
		if ($leave_taken->RowType == ROWTYPE_EDIT) // Edit row
			$leave_taken_list->EditRowCount++;

		// Set up row id / data-rowindex
		$leave_taken->RowAttrs->merge(["data-rowindex" => $leave_taken_list->RowCount, "id" => "r" . $leave_taken_list->RowCount . "_leave_taken", "data-rowtype" => $leave_taken->RowType]);

		// Render row
		$leave_taken_list->renderRow();

		// Render list options
		$leave_taken_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($leave_taken_list->RowAction != "delete" && $leave_taken_list->RowAction != "insertdelete" && !($leave_taken_list->RowAction == "insert" && $leave_taken->isConfirm() && $leave_taken_list->emptyRow())) {
?>
	<tr <?php echo $leave_taken->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_taken_list->ListOptions->render("body", "left", $leave_taken_list->RowCount);
?>
	<?php if ($leave_taken_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $leave_taken_list->EmployeeID->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($leave_taken_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_EmployeeID" class="form-group">
<span<?php echo $leave_taken_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" name="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_EmployeeID" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->EmployeeID->EditValue ?>"<?php echo $leave_taken_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" id="o<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($leave_taken_list->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_EmployeeID" class="form-group">
<span<?php echo $leave_taken_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_list->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" name="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->EmployeeID->EditValue ?>"<?php echo $leave_taken_list->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" id="o<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_list->EmployeeID->OldValue != null ? $leave_taken_list->EmployeeID->OldValue : $leave_taken_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_EmployeeID">
<span<?php echo $leave_taken_list->EmployeeID->viewAttributes() ?>><?php echo $leave_taken_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_taken_list->LeaveTypeCode->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_LeaveTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_list->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode"<?php echo $leave_taken_list->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_list->LeaveTypeCode->selectOptionListHtml("x{$leave_taken_list->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_list->LeaveTypeCode->Lookup->getParamTag($leave_taken_list, "p_x" . $leave_taken_list->RowIndex . "_LeaveTypeCode") ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_list->LeaveTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_list->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode"<?php echo $leave_taken_list->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_list->LeaveTypeCode->selectOptionListHtml("x{$leave_taken_list->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_list->LeaveTypeCode->Lookup->getParamTag($leave_taken_list, "p_x" . $leave_taken_list->RowIndex . "_LeaveTypeCode") ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_list->LeaveTypeCode->OldValue != null ? $leave_taken_list->LeaveTypeCode->OldValue : $leave_taken_list->LeaveTypeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_LeaveTypeCode">
<span<?php echo $leave_taken_list->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_taken_list->LeaveTypeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $leave_taken_list->StartDate->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_StartDate" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_list->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->StartDate->EditValue ?>"<?php echo $leave_taken_list->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_list->StartDate->ReadOnly && !$leave_taken_list->StartDate->Disabled && !isset($leave_taken_list->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenlist", "x<?php echo $leave_taken_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o<?php echo $leave_taken_list->RowIndex ?>_StartDate" id="o<?php echo $leave_taken_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_list->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_list->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->StartDate->EditValue ?>"<?php echo $leave_taken_list->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_list->StartDate->ReadOnly && !$leave_taken_list->StartDate->Disabled && !isset($leave_taken_list->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenlist", "x<?php echo $leave_taken_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o<?php echo $leave_taken_list->RowIndex ?>_StartDate" id="o<?php echo $leave_taken_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_list->StartDate->OldValue != null ? $leave_taken_list->StartDate->OldValue : $leave_taken_list->StartDate->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_StartDate">
<span<?php echo $leave_taken_list->StartDate->viewAttributes() ?>><?php echo $leave_taken_list->StartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $leave_taken_list->EndDate->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_EndDate" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_list->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_list->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_list->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->EndDate->EditValue ?>"<?php echo $leave_taken_list->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_list->EndDate->ReadOnly && !$leave_taken_list->EndDate->Disabled && !isset($leave_taken_list->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_list->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenlist", "x<?php echo $leave_taken_list->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="o<?php echo $leave_taken_list->RowIndex ?>_EndDate" id="o<?php echo $leave_taken_list->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_list->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_EndDate" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_list->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_list->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_list->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->EndDate->EditValue ?>"<?php echo $leave_taken_list->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_list->EndDate->ReadOnly && !$leave_taken_list->EndDate->Disabled && !isset($leave_taken_list->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_list->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenlist", "x<?php echo $leave_taken_list->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_EndDate">
<span<?php echo $leave_taken_list->EndDate->viewAttributes() ?>><?php echo $leave_taken_list->EndDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_list->Commuted->Visible) { // Commuted ?>
		<td data-name="Commuted" <?php echo $leave_taken_list->Commuted->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Commuted" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_list->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_list->RowIndex ?>_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Commuted->EditValue ?>"<?php echo $leave_taken_list->Commuted->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="o<?php echo $leave_taken_list->RowIndex ?>_Commuted" id="o<?php echo $leave_taken_list->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_list->Commuted->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Commuted" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_list->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_list->RowIndex ?>_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Commuted->EditValue ?>"<?php echo $leave_taken_list->Commuted->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Commuted">
<span<?php echo $leave_taken_list->Commuted->viewAttributes() ?>><?php echo $leave_taken_list->Commuted->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_list->LeaveDays->Visible) { // LeaveDays ?>
		<td data-name="LeaveDays" <?php echo $leave_taken_list->LeaveDays->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_LeaveDays" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->LeaveDays->EditValue ?>"<?php echo $leave_taken_list->LeaveDays->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="o<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" id="o<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_list->LeaveDays->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_LeaveDays" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->LeaveDays->EditValue ?>"<?php echo $leave_taken_list->LeaveDays->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_LeaveDays">
<span<?php echo $leave_taken_list->LeaveDays->viewAttributes() ?>><?php echo $leave_taken_list->LeaveDays->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $leave_taken_list->Location->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Location" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_list->RowIndex ?>_Location" id="x<?php echo $leave_taken_list->RowIndex ?>_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_list->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Location->EditValue ?>"<?php echo $leave_taken_list->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="o<?php echo $leave_taken_list->RowIndex ?>_Location" id="o<?php echo $leave_taken_list->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_list->Location->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Location" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_list->RowIndex ?>_Location" id="x<?php echo $leave_taken_list->RowIndex ?>_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_list->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Location->EditValue ?>"<?php echo $leave_taken_list->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Location">
<span<?php echo $leave_taken_list->Location->viewAttributes() ?>><?php echo $leave_taken_list->Location->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_taken_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $leave_taken_list->Remarks->cellAttributes() ?>>
<?php if ($leave_taken->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Remarks" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_list->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_list->RowIndex ?>_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_list->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Remarks->EditValue ?>"<?php echo $leave_taken_list->Remarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="o<?php echo $leave_taken_list->RowIndex ?>_Remarks" id="o<?php echo $leave_taken_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_list->Remarks->OldValue) ?>">
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Remarks" class="form-group">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_list->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_list->RowIndex ?>_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_list->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Remarks->EditValue ?>"<?php echo $leave_taken_list->Remarks->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_taken->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_taken_list->RowCount ?>_leave_taken_Remarks">
<span<?php echo $leave_taken_list->Remarks->viewAttributes() ?>><?php echo $leave_taken_list->Remarks->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_taken_list->ListOptions->render("body", "right", $leave_taken_list->RowCount);
?>
	</tr>
<?php if ($leave_taken->RowType == ROWTYPE_ADD || $leave_taken->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fleave_takenlist", "load"], function() {
	fleave_takenlist.updateLists(<?php echo $leave_taken_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$leave_taken_list->isGridAdd())
		if (!$leave_taken_list->Recordset->EOF)
			$leave_taken_list->Recordset->moveNext();
}
?>
<?php
	if ($leave_taken_list->isGridAdd() || $leave_taken_list->isGridEdit()) {
		$leave_taken_list->RowIndex = '$rowindex$';
		$leave_taken_list->loadRowValues();

		// Set row properties
		$leave_taken->resetAttributes();
		$leave_taken->RowAttrs->merge(["data-rowindex" => $leave_taken_list->RowIndex, "id" => "r0_leave_taken", "data-rowtype" => ROWTYPE_ADD]);
		$leave_taken->RowAttrs->appendClass("ew-template");
		$leave_taken->RowType = ROWTYPE_ADD;

		// Render row
		$leave_taken_list->renderRow();

		// Render list options
		$leave_taken_list->renderListOptions();
		$leave_taken_list->StartRowCount = 0;
?>
	<tr <?php echo $leave_taken->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_taken_list->ListOptions->render("body", "left", $leave_taken_list->RowIndex);
?>
	<?php if ($leave_taken_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if ($leave_taken_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_leave_taken_EmployeeID" class="form-group leave_taken_EmployeeID">
<span<?php echo $leave_taken_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" name="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_leave_taken_EmployeeID" class="form-group leave_taken_EmployeeID">
<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" id="x<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->EmployeeID->EditValue ?>"<?php echo $leave_taken_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" id="o<?php echo $leave_taken_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_taken_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode">
<span id="el$rowindex$_leave_taken_LeaveTypeCode" class="form-group leave_taken_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_list->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode"<?php echo $leave_taken_list->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_list->LeaveTypeCode->selectOptionListHtml("x{$leave_taken_list->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_list->LeaveTypeCode->Lookup->getParamTag($leave_taken_list, "p_x" . $leave_taken_list->RowIndex . "_LeaveTypeCode") ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_taken_list->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_list->LeaveTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<span id="el$rowindex$_leave_taken_StartDate" class="form-group leave_taken_StartDate">
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x<?php echo $leave_taken_list->RowIndex ?>_StartDate" id="x<?php echo $leave_taken_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->StartDate->EditValue ?>"<?php echo $leave_taken_list->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_list->StartDate->ReadOnly && !$leave_taken_list->StartDate->Disabled && !isset($leave_taken_list->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenlist", "x<?php echo $leave_taken_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o<?php echo $leave_taken_list->RowIndex ?>_StartDate" id="o<?php echo $leave_taken_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($leave_taken_list->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<span id="el$rowindex$_leave_taken_EndDate" class="form-group leave_taken_EndDate">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x<?php echo $leave_taken_list->RowIndex ?>_EndDate" id="x<?php echo $leave_taken_list->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_list->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->EndDate->EditValue ?>"<?php echo $leave_taken_list->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_list->EndDate->ReadOnly && !$leave_taken_list->EndDate->Disabled && !isset($leave_taken_list->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_list->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenlist", "x<?php echo $leave_taken_list->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_EndDate" name="o<?php echo $leave_taken_list->RowIndex ?>_EndDate" id="o<?php echo $leave_taken_list->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($leave_taken_list->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_list->Commuted->Visible) { // Commuted ?>
		<td data-name="Commuted">
<span id="el$rowindex$_leave_taken_Commuted" class="form-group leave_taken_Commuted">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x<?php echo $leave_taken_list->RowIndex ?>_Commuted" id="x<?php echo $leave_taken_list->RowIndex ?>_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Commuted->EditValue ?>"<?php echo $leave_taken_list->Commuted->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Commuted" name="o<?php echo $leave_taken_list->RowIndex ?>_Commuted" id="o<?php echo $leave_taken_list->RowIndex ?>_Commuted" value="<?php echo HtmlEncode($leave_taken_list->Commuted->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_list->LeaveDays->Visible) { // LeaveDays ?>
		<td data-name="LeaveDays">
<span id="el$rowindex$_leave_taken_LeaveDays" class="form-group leave_taken_LeaveDays">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" id="x<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_list->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->LeaveDays->EditValue ?>"<?php echo $leave_taken_list->LeaveDays->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveDays" name="o<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" id="o<?php echo $leave_taken_list->RowIndex ?>_LeaveDays" value="<?php echo HtmlEncode($leave_taken_list->LeaveDays->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_list->Location->Visible) { // Location ?>
		<td data-name="Location">
<span id="el$rowindex$_leave_taken_Location" class="form-group leave_taken_Location">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x<?php echo $leave_taken_list->RowIndex ?>_Location" id="x<?php echo $leave_taken_list->RowIndex ?>_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_list->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Location->EditValue ?>"<?php echo $leave_taken_list->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Location" name="o<?php echo $leave_taken_list->RowIndex ?>_Location" id="o<?php echo $leave_taken_list->RowIndex ?>_Location" value="<?php echo HtmlEncode($leave_taken_list->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_taken_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks">
<span id="el$rowindex$_leave_taken_Remarks" class="form-group leave_taken_Remarks">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x<?php echo $leave_taken_list->RowIndex ?>_Remarks" id="x<?php echo $leave_taken_list->RowIndex ?>_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_list->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_list->Remarks->EditValue ?>"<?php echo $leave_taken_list->Remarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_taken" data-field="x_Remarks" name="o<?php echo $leave_taken_list->RowIndex ?>_Remarks" id="o<?php echo $leave_taken_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($leave_taken_list->Remarks->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_taken_list->ListOptions->render("body", "right", $leave_taken_list->RowIndex);
?>
<script>
loadjs.ready(["fleave_takenlist", "load"], function() {
	fleave_takenlist.updateLists(<?php echo $leave_taken_list->RowIndex ?>);
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
<?php if ($leave_taken_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $leave_taken_list->FormKeyCountName ?>" id="<?php echo $leave_taken_list->FormKeyCountName ?>" value="<?php echo $leave_taken_list->KeyCount ?>">
<?php echo $leave_taken_list->MultiSelectKey ?>
<?php } ?>
<?php if ($leave_taken_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $leave_taken_list->FormKeyCountName ?>" id="<?php echo $leave_taken_list->FormKeyCountName ?>" value="<?php echo $leave_taken_list->KeyCount ?>">
<?php echo $leave_taken_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$leave_taken->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_taken_list->Recordset)
	$leave_taken_list->Recordset->Close();
?>
<?php if (!$leave_taken_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$leave_taken_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_taken_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_taken_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_taken_list->TotalRecords == 0 && !$leave_taken->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_taken_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$leave_taken_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_taken_list->isExport()) { ?>
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
$leave_taken_list->terminate();
?>