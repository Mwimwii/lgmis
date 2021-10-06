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
$employee_obligation_list = new employee_obligation_list();

// Run the page
$employee_obligation_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_obligation_list->isExport()) { ?>
<script>
var femployee_obligationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployee_obligationlist = currentForm = new ew.Form("femployee_obligationlist", "list");
	femployee_obligationlist.formKeyCountName = '<?php echo $employee_obligation_list->FormKeyCountName ?>';

	// Validate form
	femployee_obligationlist.validate = function() {
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
			<?php if ($employee_obligation_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->EmployeeID->caption(), $employee_obligation_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_list->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_obligation_list->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->PaidPosition->caption(), $employee_obligation_list->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_list->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_obligation_list->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->PayrollDate->caption(), $employee_obligation_list->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_list->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_obligation_list->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->PayrollPeriod->caption(), $employee_obligation_list->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_list->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_obligation_list->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->StartDate->caption(), $employee_obligation_list->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_list->StartDate->errorMessage()) ?>");
			<?php if ($employee_obligation_list->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->Enddate->caption(), $employee_obligation_list->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_list->Enddate->errorMessage()) ?>");
			<?php if ($employee_obligation_list->ObligationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->ObligationCode->caption(), $employee_obligation_list->ObligationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_obligation_list->ObligationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->ObligationAmount->caption(), $employee_obligation_list->ObligationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_list->ObligationAmount->errorMessage()) ?>");
			<?php if ($employee_obligation_list->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_list->Remarks->caption(), $employee_obligation_list->Remarks->RequiredErrorMessage)) ?>");
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
	femployee_obligationlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaidPosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Enddate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ObligationCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ObligationAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "Remarks", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployee_obligationlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_obligationlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_obligationlist.lists["x_PaidPosition"] = <?php echo $employee_obligation_list->PaidPosition->Lookup->toClientList($employee_obligation_list) ?>;
	femployee_obligationlist.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_obligation_list->PaidPosition->lookupOptions()) ?>;
	femployee_obligationlist.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("femployee_obligationlist");
});
var femployee_obligationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployee_obligationlistsrch = currentSearchForm = new ew.Form("femployee_obligationlistsrch");

	// Dynamic selection lists
	// Filters

	femployee_obligationlistsrch.filterList = <?php echo $employee_obligation_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployee_obligationlistsrch.initSearchPanel = true;
	loadjs.done("femployee_obligationlistsrch");
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
<?php if (!$employee_obligation_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employee_obligation_list->TotalRecords > 0 && $employee_obligation_list->ExportOptions->visible()) { ?>
<?php $employee_obligation_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_obligation_list->ImportOptions->visible()) { ?>
<?php $employee_obligation_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_obligation_list->SearchOptions->visible()) { ?>
<?php $employee_obligation_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employee_obligation_list->FilterOptions->visible()) { ?>
<?php $employee_obligation_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$employee_obligation_list->isExport() || Config("EXPORT_MASTER_RECORD") && $employee_obligation_list->isExport("print")) { ?>
<?php
if ($employee_obligation_list->DbMasterFilter != "" && $employee_obligation->getCurrentMasterTable() == "employment") {
	if ($employee_obligation_list->MasterRecordExists) {
		include_once "employmentmaster.php";
	}
}
?>
<?php } ?>
<?php
$employee_obligation_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employee_obligation_list->isExport() && !$employee_obligation->CurrentAction) { ?>
<form name="femployee_obligationlistsrch" id="femployee_obligationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployee_obligationlistsrch-search-panel" class="<?php echo $employee_obligation_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employee_obligation">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employee_obligation_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employee_obligation_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employee_obligation_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employee_obligation_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employee_obligation_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employee_obligation_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employee_obligation_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employee_obligation_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employee_obligation_list->showPageHeader(); ?>
<?php
$employee_obligation_list->showMessage();
?>
<?php if ($employee_obligation_list->TotalRecords > 0 || $employee_obligation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_obligation_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee_obligation">
<?php if (!$employee_obligation_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employee_obligation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_obligation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_obligation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployee_obligationlist" id="femployee_obligationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_obligation">
<?php if ($employee_obligation->getCurrentMasterTable() == "employment" && $employee_obligation->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_employee_obligation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employee_obligation_list->TotalRecords > 0 || $employee_obligation_list->isGridEdit()) { ?>
<table id="tbl_employee_obligationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee_obligation->RowType = ROWTYPE_HEADER;

// Render list options
$employee_obligation_list->renderListOptions();

// Render list options (header, left)
$employee_obligation_list->ListOptions->render("header", "left");
?>
<?php if ($employee_obligation_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_obligation_list->EmployeeID->headerCellClass() ?>"><div id="elh_employee_obligation_EmployeeID" class="employee_obligation_EmployeeID"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_obligation_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->EmployeeID) ?>', 1);"><div id="elh_employee_obligation_EmployeeID" class="employee_obligation_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->PaidPosition->Visible) { // PaidPosition ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->PaidPosition) == "") { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_obligation_list->PaidPosition->headerCellClass() ?>"><div id="elh_employee_obligation_PaidPosition" class="employee_obligation_PaidPosition"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->PaidPosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_obligation_list->PaidPosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->PaidPosition) ?>', 1);"><div id="elh_employee_obligation_PaidPosition" class="employee_obligation_PaidPosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->PaidPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->PaidPosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->PaidPosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_obligation_list->PayrollDate->headerCellClass() ?>"><div id="elh_employee_obligation_PayrollDate" class="employee_obligation_PayrollDate"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_obligation_list->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->PayrollDate) ?>', 1);"><div id="elh_employee_obligation_PayrollDate" class="employee_obligation_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_obligation_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_employee_obligation_PayrollPeriod" class="employee_obligation_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_obligation_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->PayrollPeriod) ?>', 1);"><div id="elh_employee_obligation_PayrollPeriod" class="employee_obligation_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->StartDate->Visible) { // StartDate ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $employee_obligation_list->StartDate->headerCellClass() ?>"><div id="elh_employee_obligation_StartDate" class="employee_obligation_StartDate"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $employee_obligation_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->StartDate) ?>', 1);"><div id="elh_employee_obligation_StartDate" class="employee_obligation_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->Enddate->Visible) { // Enddate ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->Enddate) == "") { ?>
		<th data-name="Enddate" class="<?php echo $employee_obligation_list->Enddate->headerCellClass() ?>"><div id="elh_employee_obligation_Enddate" class="employee_obligation_Enddate"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->Enddate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Enddate" class="<?php echo $employee_obligation_list->Enddate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->Enddate) ?>', 1);"><div id="elh_employee_obligation_Enddate" class="employee_obligation_Enddate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->Enddate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->Enddate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->Enddate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->ObligationCode->Visible) { // ObligationCode ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->ObligationCode) == "") { ?>
		<th data-name="ObligationCode" class="<?php echo $employee_obligation_list->ObligationCode->headerCellClass() ?>"><div id="elh_employee_obligation_ObligationCode" class="employee_obligation_ObligationCode"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->ObligationCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ObligationCode" class="<?php echo $employee_obligation_list->ObligationCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->ObligationCode) ?>', 1);"><div id="elh_employee_obligation_ObligationCode" class="employee_obligation_ObligationCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->ObligationCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->ObligationCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->ObligationCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->ObligationAmount->Visible) { // ObligationAmount ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->ObligationAmount) == "") { ?>
		<th data-name="ObligationAmount" class="<?php echo $employee_obligation_list->ObligationAmount->headerCellClass() ?>"><div id="elh_employee_obligation_ObligationAmount" class="employee_obligation_ObligationAmount"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->ObligationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ObligationAmount" class="<?php echo $employee_obligation_list->ObligationAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->ObligationAmount) ?>', 1);"><div id="elh_employee_obligation_ObligationAmount" class="employee_obligation_ObligationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->ObligationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->ObligationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->ObligationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_obligation_list->Remarks->Visible) { // Remarks ?>
	<?php if ($employee_obligation_list->SortUrl($employee_obligation_list->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $employee_obligation_list->Remarks->headerCellClass() ?>"><div id="elh_employee_obligation_Remarks" class="employee_obligation_Remarks"><div class="ew-table-header-caption"><?php echo $employee_obligation_list->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $employee_obligation_list->Remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_obligation_list->SortUrl($employee_obligation_list->Remarks) ?>', 1);"><div id="elh_employee_obligation_Remarks" class="employee_obligation_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_obligation_list->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_obligation_list->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_obligation_list->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_obligation_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employee_obligation_list->ExportAll && $employee_obligation_list->isExport()) {
	$employee_obligation_list->StopRecord = $employee_obligation_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employee_obligation_list->TotalRecords > $employee_obligation_list->StartRecord + $employee_obligation_list->DisplayRecords - 1)
		$employee_obligation_list->StopRecord = $employee_obligation_list->StartRecord + $employee_obligation_list->DisplayRecords - 1;
	else
		$employee_obligation_list->StopRecord = $employee_obligation_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employee_obligation->isConfirm() || $employee_obligation_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employee_obligation_list->FormKeyCountName) && ($employee_obligation_list->isGridAdd() || $employee_obligation_list->isGridEdit() || $employee_obligation->isConfirm())) {
		$employee_obligation_list->KeyCount = $CurrentForm->getValue($employee_obligation_list->FormKeyCountName);
		$employee_obligation_list->StopRecord = $employee_obligation_list->StartRecord + $employee_obligation_list->KeyCount - 1;
	}
}
$employee_obligation_list->RecordCount = $employee_obligation_list->StartRecord - 1;
if ($employee_obligation_list->Recordset && !$employee_obligation_list->Recordset->EOF) {
	$employee_obligation_list->Recordset->moveFirst();
	$selectLimit = $employee_obligation_list->UseSelectLimit;
	if (!$selectLimit && $employee_obligation_list->StartRecord > 1)
		$employee_obligation_list->Recordset->move($employee_obligation_list->StartRecord - 1);
} elseif (!$employee_obligation->AllowAddDeleteRow && $employee_obligation_list->StopRecord == 0) {
	$employee_obligation_list->StopRecord = $employee_obligation->GridAddRowCount;
}

// Initialize aggregate
$employee_obligation->RowType = ROWTYPE_AGGREGATEINIT;
$employee_obligation->resetAttributes();
$employee_obligation_list->renderRow();
if ($employee_obligation_list->isGridAdd())
	$employee_obligation_list->RowIndex = 0;
if ($employee_obligation_list->isGridEdit())
	$employee_obligation_list->RowIndex = 0;
while ($employee_obligation_list->RecordCount < $employee_obligation_list->StopRecord) {
	$employee_obligation_list->RecordCount++;
	if ($employee_obligation_list->RecordCount >= $employee_obligation_list->StartRecord) {
		$employee_obligation_list->RowCount++;
		if ($employee_obligation_list->isGridAdd() || $employee_obligation_list->isGridEdit() || $employee_obligation->isConfirm()) {
			$employee_obligation_list->RowIndex++;
			$CurrentForm->Index = $employee_obligation_list->RowIndex;
			if ($CurrentForm->hasValue($employee_obligation_list->FormActionName) && ($employee_obligation->isConfirm() || $employee_obligation_list->EventCancelled))
				$employee_obligation_list->RowAction = strval($CurrentForm->getValue($employee_obligation_list->FormActionName));
			elseif ($employee_obligation_list->isGridAdd())
				$employee_obligation_list->RowAction = "insert";
			else
				$employee_obligation_list->RowAction = "";
		}

		// Set up key count
		$employee_obligation_list->KeyCount = $employee_obligation_list->RowIndex;

		// Init row class and style
		$employee_obligation->resetAttributes();
		$employee_obligation->CssClass = "";
		if ($employee_obligation_list->isGridAdd()) {
			$employee_obligation_list->loadRowValues(); // Load default values
		} else {
			$employee_obligation_list->loadRowValues($employee_obligation_list->Recordset); // Load row values
		}
		$employee_obligation->RowType = ROWTYPE_VIEW; // Render view
		if ($employee_obligation_list->isGridAdd()) // Grid add
			$employee_obligation->RowType = ROWTYPE_ADD; // Render add
		if ($employee_obligation_list->isGridAdd() && $employee_obligation->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employee_obligation_list->restoreCurrentRowFormValues($employee_obligation_list->RowIndex); // Restore form values
		if ($employee_obligation_list->isGridEdit()) { // Grid edit
			if ($employee_obligation->EventCancelled)
				$employee_obligation_list->restoreCurrentRowFormValues($employee_obligation_list->RowIndex); // Restore form values
			if ($employee_obligation_list->RowAction == "insert")
				$employee_obligation->RowType = ROWTYPE_ADD; // Render add
			else
				$employee_obligation->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employee_obligation_list->isGridEdit() && ($employee_obligation->RowType == ROWTYPE_EDIT || $employee_obligation->RowType == ROWTYPE_ADD) && $employee_obligation->EventCancelled) // Update failed
			$employee_obligation_list->restoreCurrentRowFormValues($employee_obligation_list->RowIndex); // Restore form values
		if ($employee_obligation->RowType == ROWTYPE_EDIT) // Edit row
			$employee_obligation_list->EditRowCount++;

		// Set up row id / data-rowindex
		$employee_obligation->RowAttrs->merge(["data-rowindex" => $employee_obligation_list->RowCount, "id" => "r" . $employee_obligation_list->RowCount . "_employee_obligation", "data-rowtype" => $employee_obligation->RowType]);

		// Render row
		$employee_obligation_list->renderRow();

		// Render list options
		$employee_obligation_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employee_obligation_list->RowAction != "delete" && $employee_obligation_list->RowAction != "insertdelete" && !($employee_obligation_list->RowAction == "insert" && $employee_obligation->isConfirm() && $employee_obligation_list->emptyRow())) {
?>
	<tr <?php echo $employee_obligation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_obligation_list->ListOptions->render("body", "left", $employee_obligation_list->RowCount);
?>
	<?php if ($employee_obligation_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employee_obligation_list->EmployeeID->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employee_obligation_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_EmployeeID" class="form-group">
<span<?php echo $employee_obligation_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" name="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_EmployeeID" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->EmployeeID->EditValue ?>"<?php echo $employee_obligation_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" id="o<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employee_obligation_list->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_EmployeeID" class="form-group">
<span<?php echo $employee_obligation_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_list->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" name="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->EmployeeID->EditValue ?>"<?php echo $employee_obligation_list->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" id="o<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->OldValue != null ? $employee_obligation_list->EmployeeID->OldValue : $employee_obligation_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_list->EmployeeID->viewAttributes() ?>><?php echo $employee_obligation_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition" <?php echo $employee_obligation_list->PaidPosition->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PaidPosition" class="form-group">
<?php
$onchange = $employee_obligation_list->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_list->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_list->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_list->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_list->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationlist"], function() {
	femployee_obligationlist.createAutoSuggest({"id":"x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_list->PaidPosition->Lookup->getParamTag($employee_obligation_list, "p_x" . $employee_obligation_list->RowIndex . "_PaidPosition") ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="o<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="o<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PaidPosition" class="form-group">
<?php
$onchange = $employee_obligation_list->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_list->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_list->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_list->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_list->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationlist"], function() {
	femployee_obligationlist.createAutoSuggest({"id":"x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_list->PaidPosition->Lookup->getParamTag($employee_obligation_list, "p_x" . $employee_obligation_list->RowIndex . "_PaidPosition") ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PaidPosition">
<span<?php echo $employee_obligation_list->PaidPosition->viewAttributes() ?>><?php echo $employee_obligation_list->PaidPosition->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $employee_obligation_list->PayrollDate->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PayrollDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->PayrollDate->EditValue ?>"<?php echo $employee_obligation_list->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_list->PayrollDate->ReadOnly && !$employee_obligation_list->PayrollDate->Disabled && !isset($employee_obligation_list->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" id="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_list->PayrollDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PayrollDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->PayrollDate->EditValue ?>"<?php echo $employee_obligation_list->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_list->PayrollDate->ReadOnly && !$employee_obligation_list->PayrollDate->Disabled && !isset($employee_obligation_list->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PayrollDate">
<span<?php echo $employee_obligation_list->PayrollDate->viewAttributes() ?>><?php echo $employee_obligation_list->PayrollDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $employee_obligation_list->PayrollPeriod->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PayrollPeriod" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_list->PayrollPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_list->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_list->PayrollPeriod->editAttributes() ?>>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_list->PayrollPeriod->OldValue != null ? $employee_obligation_list->PayrollPeriod->OldValue : $employee_obligation_list->PayrollPeriod->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_PayrollPeriod">
<span<?php echo $employee_obligation_list->PayrollPeriod->viewAttributes() ?>><?php echo $employee_obligation_list->PayrollPeriod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $employee_obligation_list->StartDate->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_StartDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_list->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->StartDate->EditValue ?>"<?php echo $employee_obligation_list->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_list->StartDate->ReadOnly && !$employee_obligation_list->StartDate->Disabled && !isset($employee_obligation_list->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="o<?php echo $employee_obligation_list->RowIndex ?>_StartDate" id="o<?php echo $employee_obligation_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_list->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_StartDate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_list->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->StartDate->EditValue ?>"<?php echo $employee_obligation_list->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_list->StartDate->ReadOnly && !$employee_obligation_list->StartDate->Disabled && !isset($employee_obligation_list->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_StartDate">
<span<?php echo $employee_obligation_list->StartDate->viewAttributes() ?>><?php echo $employee_obligation_list->StartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->Enddate->Visible) { // Enddate ?>
		<td data-name="Enddate" <?php echo $employee_obligation_list->Enddate->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_Enddate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_list->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_list->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_list->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->Enddate->EditValue ?>"<?php echo $employee_obligation_list->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_list->Enddate->ReadOnly && !$employee_obligation_list->Enddate->Disabled && !isset($employee_obligation_list->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_list->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="o<?php echo $employee_obligation_list->RowIndex ?>_Enddate" id="o<?php echo $employee_obligation_list->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_list->Enddate->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_Enddate" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_list->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_list->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_list->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->Enddate->EditValue ?>"<?php echo $employee_obligation_list->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_list->Enddate->ReadOnly && !$employee_obligation_list->Enddate->Disabled && !isset($employee_obligation_list->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_list->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_Enddate">
<span<?php echo $employee_obligation_list->Enddate->viewAttributes() ?>><?php echo $employee_obligation_list->Enddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->ObligationCode->Visible) { // ObligationCode ?>
		<td data-name="ObligationCode" <?php echo $employee_obligation_list->ObligationCode->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_ObligationCode" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_list->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->ObligationCode->EditValue ?>"<?php echo $employee_obligation_list->ObligationCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" id="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_list->ObligationCode->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_list->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->ObligationCode->EditValue ?>"<?php echo $employee_obligation_list->ObligationCode->editAttributes() ?>>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" id="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_list->ObligationCode->OldValue != null ? $employee_obligation_list->ObligationCode->OldValue : $employee_obligation_list->ObligationCode->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_ObligationCode">
<span<?php echo $employee_obligation_list->ObligationCode->viewAttributes() ?>><?php echo $employee_obligation_list->ObligationCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount" <?php echo $employee_obligation_list->ObligationAmount->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_ObligationAmount" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_list->ObligationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" id="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_list->ObligationAmount->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_ObligationAmount" class="form-group">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_list->ObligationAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_ObligationAmount">
<span<?php echo $employee_obligation_list->ObligationAmount->viewAttributes() ?>><?php echo $employee_obligation_list->ObligationAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $employee_obligation_list->Remarks->cellAttributes() ?>>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_Remarks" class="form-group">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_list->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_list->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_list->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_list->Remarks->editAttributes() ?>><?php echo $employee_obligation_list->Remarks->EditValue ?></textarea>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="o<?php echo $employee_obligation_list->RowIndex ?>_Remarks" id="o<?php echo $employee_obligation_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_list->Remarks->OldValue) ?>">
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_Remarks" class="form-group">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_list->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_list->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_list->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_list->Remarks->editAttributes() ?>><?php echo $employee_obligation_list->Remarks->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($employee_obligation->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_obligation_list->RowCount ?>_employee_obligation_Remarks">
<span<?php echo $employee_obligation_list->Remarks->viewAttributes() ?>><?php echo $employee_obligation_list->Remarks->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_obligation_list->ListOptions->render("body", "right", $employee_obligation_list->RowCount);
?>
	</tr>
<?php if ($employee_obligation->RowType == ROWTYPE_ADD || $employee_obligation->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "load"], function() {
	femployee_obligationlist.updateLists(<?php echo $employee_obligation_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employee_obligation_list->isGridAdd())
		if (!$employee_obligation_list->Recordset->EOF)
			$employee_obligation_list->Recordset->moveNext();
}
?>
<?php
	if ($employee_obligation_list->isGridAdd() || $employee_obligation_list->isGridEdit()) {
		$employee_obligation_list->RowIndex = '$rowindex$';
		$employee_obligation_list->loadRowValues();

		// Set row properties
		$employee_obligation->resetAttributes();
		$employee_obligation->RowAttrs->merge(["data-rowindex" => $employee_obligation_list->RowIndex, "id" => "r0_employee_obligation", "data-rowtype" => ROWTYPE_ADD]);
		$employee_obligation->RowAttrs->appendClass("ew-template");
		$employee_obligation->RowType = ROWTYPE_ADD;

		// Render row
		$employee_obligation_list->renderRow();

		// Render list options
		$employee_obligation_list->renderListOptions();
		$employee_obligation_list->StartRowCount = 0;
?>
	<tr <?php echo $employee_obligation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_obligation_list->ListOptions->render("body", "left", $employee_obligation_list->RowIndex);
?>
	<?php if ($employee_obligation_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if ($employee_obligation_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_employee_obligation_EmployeeID" class="form-group employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" name="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employee_obligation_EmployeeID" class="form-group employee_obligation_EmployeeID">
<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" id="x<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->EmployeeID->EditValue ?>"<?php echo $employee_obligation_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" id="o<?php echo $employee_obligation_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition">
<span id="el$rowindex$_employee_obligation_PaidPosition" class="form-group employee_obligation_PaidPosition">
<?php
$onchange = $employee_obligation_list->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_list->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_list->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_list->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_list->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationlist"], function() {
	femployee_obligationlist.createAutoSuggest({"id":"x<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_list->PaidPosition->Lookup->getParamTag($employee_obligation_list, "p_x" . $employee_obligation_list->RowIndex . "_PaidPosition") ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" name="o<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" id="o<?php echo $employee_obligation_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_list->PaidPosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate">
<span id="el$rowindex$_employee_obligation_PayrollDate" class="form-group employee_obligation_PayrollDate">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" id="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->PayrollDate->EditValue ?>"<?php echo $employee_obligation_list->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_list->PayrollDate->ReadOnly && !$employee_obligation_list->PayrollDate->Disabled && !isset($employee_obligation_list->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollDate" name="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" id="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_obligation_list->PayrollDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod">
<span id="el$rowindex$_employee_obligation_PayrollPeriod" class="form-group employee_obligation_PayrollPeriod">
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_list->PayrollPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_obligation_list->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_list->PayrollPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<span id="el$rowindex$_employee_obligation_StartDate" class="form-group employee_obligation_StartDate">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x<?php echo $employee_obligation_list->RowIndex ?>_StartDate" id="x<?php echo $employee_obligation_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->StartDate->EditValue ?>"<?php echo $employee_obligation_list->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_list->StartDate->ReadOnly && !$employee_obligation_list->StartDate->Disabled && !isset($employee_obligation_list->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_StartDate" name="o<?php echo $employee_obligation_list->RowIndex ?>_StartDate" id="o<?php echo $employee_obligation_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_obligation_list->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->Enddate->Visible) { // Enddate ?>
		<td data-name="Enddate">
<span id="el$rowindex$_employee_obligation_Enddate" class="form-group employee_obligation_Enddate">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x<?php echo $employee_obligation_list->RowIndex ?>_Enddate" id="x<?php echo $employee_obligation_list->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_list->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->Enddate->EditValue ?>"<?php echo $employee_obligation_list->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_list->Enddate->ReadOnly && !$employee_obligation_list->Enddate->Disabled && !isset($employee_obligation_list->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_list->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationlist", "x<?php echo $employee_obligation_list->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Enddate" name="o<?php echo $employee_obligation_list->RowIndex ?>_Enddate" id="o<?php echo $employee_obligation_list->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($employee_obligation_list->Enddate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->ObligationCode->Visible) { // ObligationCode ?>
		<td data-name="ObligationCode">
<span id="el$rowindex$_employee_obligation_ObligationCode" class="form-group employee_obligation_ObligationCode">
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" id="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_list->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->ObligationCode->EditValue ?>"<?php echo $employee_obligation_list->ObligationCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" id="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_list->ObligationCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount">
<span id="el$rowindex$_employee_obligation_ObligationAmount" class="form-group employee_obligation_ObligationAmount">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" id="x<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_list->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_list->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_list->ObligationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationAmount" name="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" id="o<?php echo $employee_obligation_list->RowIndex ?>_ObligationAmount" value="<?php echo HtmlEncode($employee_obligation_list->ObligationAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_obligation_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks">
<span id="el$rowindex$_employee_obligation_Remarks" class="form-group employee_obligation_Remarks">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x<?php echo $employee_obligation_list->RowIndex ?>_Remarks" id="x<?php echo $employee_obligation_list->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_list->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_list->Remarks->editAttributes() ?>><?php echo $employee_obligation_list->Remarks->EditValue ?></textarea>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_Remarks" name="o<?php echo $employee_obligation_list->RowIndex ?>_Remarks" id="o<?php echo $employee_obligation_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_obligation_list->Remarks->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_obligation_list->ListOptions->render("body", "right", $employee_obligation_list->RowIndex);
?>
<script>
loadjs.ready(["femployee_obligationlist", "load"], function() {
	femployee_obligationlist.updateLists(<?php echo $employee_obligation_list->RowIndex ?>);
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
<?php if ($employee_obligation_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employee_obligation_list->FormKeyCountName ?>" id="<?php echo $employee_obligation_list->FormKeyCountName ?>" value="<?php echo $employee_obligation_list->KeyCount ?>">
<?php echo $employee_obligation_list->MultiSelectKey ?>
<?php } ?>
<?php if ($employee_obligation_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $employee_obligation_list->FormKeyCountName ?>" id="<?php echo $employee_obligation_list->FormKeyCountName ?>" value="<?php echo $employee_obligation_list->KeyCount ?>">
<?php echo $employee_obligation_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employee_obligation->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_obligation_list->Recordset)
	$employee_obligation_list->Recordset->Close();
?>
<?php if (!$employee_obligation_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employee_obligation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_obligation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_obligation_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_obligation_list->TotalRecords == 0 && !$employee_obligation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_obligation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employee_obligation_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_obligation_list->isExport()) { ?>
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
$employee_obligation_list->terminate();
?>