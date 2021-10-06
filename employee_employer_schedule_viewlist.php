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
$employee_employer_schedule_view_list = new employee_employer_schedule_view_list();

// Run the page
$employee_employer_schedule_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_employer_schedule_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_employer_schedule_view_list->isExport()) { ?>
<script>
var femployee_employer_schedule_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployee_employer_schedule_viewlist = currentForm = new ew.Form("femployee_employer_schedule_viewlist", "list");
	femployee_employer_schedule_viewlist.formKeyCountName = '<?php echo $employee_employer_schedule_view_list->FormKeyCountName ?>';
	loadjs.done("femployee_employer_schedule_viewlist");
});
var femployee_employer_schedule_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployee_employer_schedule_viewlistsrch = currentSearchForm = new ew.Form("femployee_employer_schedule_viewlistsrch");

	// Validate function for search
	femployee_employer_schedule_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_employer_schedule_view_list->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_employer_schedule_view_list->PayrollDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployee_employer_schedule_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_employer_schedule_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	femployee_employer_schedule_viewlistsrch.filterList = <?php echo $employee_employer_schedule_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployee_employer_schedule_viewlistsrch.initSearchPanel = true;
	loadjs.done("femployee_employer_schedule_viewlistsrch");
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
<?php if (!$employee_employer_schedule_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employee_employer_schedule_view_list->TotalRecords > 0 && $employee_employer_schedule_view_list->ExportOptions->visible()) { ?>
<?php $employee_employer_schedule_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->ImportOptions->visible()) { ?>
<?php $employee_employer_schedule_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->SearchOptions->visible()) { ?>
<?php $employee_employer_schedule_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->FilterOptions->visible()) { ?>
<?php $employee_employer_schedule_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$employee_employer_schedule_view_list->isExport() || Config("EXPORT_MASTER_RECORD") && $employee_employer_schedule_view_list->isExport("print")) { ?>
<?php
if ($employee_employer_schedule_view_list->DbMasterFilter != "" && $employee_employer_schedule_view->getCurrentMasterTable() == "payroll_period") {
	if ($employee_employer_schedule_view_list->MasterRecordExists) {
		include_once "payroll_periodmaster.php";
	}
}
?>
<?php } ?>
<?php
$employee_employer_schedule_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employee_employer_schedule_view_list->isExport() && !$employee_employer_schedule_view->CurrentAction) { ?>
<form name="femployee_employer_schedule_viewlistsrch" id="femployee_employer_schedule_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployee_employer_schedule_viewlistsrch-search-panel" class="<?php echo $employee_employer_schedule_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employee_employer_schedule_view">
	<div class="ew-extended-search">
<?php

// Render search row
$employee_employer_schedule_view->RowType = ROWTYPE_SEARCH;
$employee_employer_schedule_view->resetAttributes();
$employee_employer_schedule_view_list->renderRow();
?>
<?php if ($employee_employer_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php
		$employee_employer_schedule_view_list->SearchColumnCount++;
		if (($employee_employer_schedule_view_list->SearchColumnCount - 1) % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) {
			$employee_employer_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_EmployeeID" class="ew-cell form-group">
		<label for="x_EmployeeID" class="ew-search-caption ew-label"><?php echo $employee_employer_schedule_view_list->EmployeeID->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		<span id="el_employee_employer_schedule_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_list->EmployeeID->EditValue ?>"<?php echo $employee_employer_schedule_view_list->EmployeeID->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php
		$employee_employer_schedule_view_list->SearchColumnCount++;
		if (($employee_employer_schedule_view_list->SearchColumnCount - 1) % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) {
			$employee_employer_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollDate" class="ew-cell form-group">
		<label for="x_PayrollDate" class="ew-search-caption ew-label"><?php echo $employee_employer_schedule_view_list->PayrollDate->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollDate" id="z_PayrollDate" value="=">
</span>
		<span id="el_employee_employer_schedule_view_PayrollDate" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_list->PayrollDate->EditValue ?>"<?php echo $employee_employer_schedule_view_list->PayrollDate->editAttributes() ?>>
<?php if (!$employee_employer_schedule_view_list->PayrollDate->ReadOnly && !$employee_employer_schedule_view_list->PayrollDate->Disabled && !isset($employee_employer_schedule_view_list->PayrollDate->EditAttrs["readonly"]) && !isset($employee_employer_schedule_view_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_employer_schedule_viewlistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_employer_schedule_viewlistsrch", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->LAName->Visible) { // LAName ?>
	<?php
		$employee_employer_schedule_view_list->SearchColumnCount++;
		if (($employee_employer_schedule_view_list->SearchColumnCount - 1) % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) {
			$employee_employer_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LAName" class="ew-cell form-group">
		<label for="x_LAName" class="ew-search-caption ew-label"><?php echo $employee_employer_schedule_view_list->LAName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		<span id="el_employee_employer_schedule_view_LAName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_LAName" name="x_LAName" id="x_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_list->LAName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_list->LAName->EditValue ?>"<?php echo $employee_employer_schedule_view_list->LAName->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
	<?php
		$employee_employer_schedule_view_list->SearchColumnCount++;
		if (($employee_employer_schedule_view_list->SearchColumnCount - 1) % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) {
			$employee_employer_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DeductionName" class="ew-cell form-group">
		<label for="x_DeductionName" class="ew-search-caption ew-label"><?php echo $employee_employer_schedule_view_list->DeductionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionName" id="z_DeductionName" value="LIKE">
</span>
		<span id="el_employee_employer_schedule_view_DeductionName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_DeductionName" name="x_DeductionName" id="x_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_list->DeductionName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_list->DeductionName->EditValue ?>"<?php echo $employee_employer_schedule_view_list->DeductionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php
		$employee_employer_schedule_view_list->SearchColumnCount++;
		if (($employee_employer_schedule_view_list->SearchColumnCount - 1) % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) {
			$employee_employer_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $employee_employer_schedule_view_list->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_employee_employer_schedule_view_Surname" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_list->Surname->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_list->Surname->EditValue ?>"<?php echo $employee_employer_schedule_view_list->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php
		$employee_employer_schedule_view_list->SearchColumnCount++;
		if (($employee_employer_schedule_view_list->SearchColumnCount - 1) % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) {
			$employee_employer_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_FirstName" class="ew-cell form-group">
		<label for="x_FirstName" class="ew-search-caption ew-label"><?php echo $employee_employer_schedule_view_list->FirstName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		<span id="el_employee_employer_schedule_view_FirstName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_list->FirstName->EditValue ?>"<?php echo $employee_employer_schedule_view_list->FirstName->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php
		$employee_employer_schedule_view_list->SearchColumnCount++;
		if (($employee_employer_schedule_view_list->SearchColumnCount - 1) % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) {
			$employee_employer_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $employee_employer_schedule_view_list->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_employee_employer_schedule_view_PositionName" class="ew-search-field">
<input type="text" data-table="employee_employer_schedule_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employee_employer_schedule_view_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $employee_employer_schedule_view_list->PositionName->EditValue ?>"<?php echo $employee_employer_schedule_view_list->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($employee_employer_schedule_view_list->SearchColumnCount % $employee_employer_schedule_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $employee_employer_schedule_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employee_employer_schedule_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employee_employer_schedule_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employee_employer_schedule_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employee_employer_schedule_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employee_employer_schedule_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employee_employer_schedule_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employee_employer_schedule_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employee_employer_schedule_view_list->showPageHeader(); ?>
<?php
$employee_employer_schedule_view_list->showMessage();
?>
<?php if ($employee_employer_schedule_view_list->TotalRecords > 0 || $employee_employer_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_employer_schedule_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee_employer_schedule_view">
<?php if (!$employee_employer_schedule_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employee_employer_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_employer_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_employer_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployee_employer_schedule_viewlist" id="femployee_employer_schedule_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_employer_schedule_view">
<?php if ($employee_employer_schedule_view->getCurrentMasterTable() == "payroll_period" && $employee_employer_schedule_view->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="payroll_period">
<input type="hidden" name="fk_PeriodCode" value="<?php echo HtmlEncode($employee_employer_schedule_view_list->PeriodCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_employee_employer_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employee_employer_schedule_view_list->TotalRecords > 0 || $employee_employer_schedule_view_list->isGridEdit()) { ?>
<table id="tbl_employee_employer_schedule_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee_employer_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$employee_employer_schedule_view_list->renderListOptions();

// Render list options (header, left)
$employee_employer_schedule_view_list->ListOptions->render("header", "left");
?>
<?php if ($employee_employer_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_employer_schedule_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_EmployeeID" class="employee_employer_schedule_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_employer_schedule_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->EmployeeID) ?>', 1);"><div id="elh_employee_employer_schedule_view_EmployeeID" class="employee_employer_schedule_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_employer_schedule_view_list->PayrollDate->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_PayrollDate" class="employee_employer_schedule_view_PayrollDate"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_employer_schedule_view_list->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->PayrollDate) ?>', 1);"><div id="elh_employee_employer_schedule_view_PayrollDate" class="employee_employer_schedule_view_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->LAName->Visible) { // LAName ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $employee_employer_schedule_view_list->LAName->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_LAName" class="employee_employer_schedule_view_LAName"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $employee_employer_schedule_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->LAName) ?>', 1);"><div id="elh_employee_employer_schedule_view_LAName" class="employee_employer_schedule_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $employee_employer_schedule_view_list->DeductionName->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_DeductionName" class="employee_employer_schedule_view_DeductionName"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $employee_employer_schedule_view_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->DeductionName) ?>', 1);"><div id="elh_employee_employer_schedule_view_DeductionName" class="employee_employer_schedule_view_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->DeductionAmount) == "") { ?>
		<th data-name="DeductionAmount" class="<?php echo $employee_employer_schedule_view_list->DeductionAmount->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_DeductionAmount" class="employee_employer_schedule_view_DeductionAmount"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionAmount" class="<?php echo $employee_employer_schedule_view_list->DeductionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->DeductionAmount) ?>', 1);"><div id="elh_employee_employer_schedule_view_DeductionAmount" class="employee_employer_schedule_view_DeductionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->ObligationAmount->Visible) { // ObligationAmount ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->ObligationAmount) == "") { ?>
		<th data-name="ObligationAmount" class="<?php echo $employee_employer_schedule_view_list->ObligationAmount->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_ObligationAmount" class="employee_employer_schedule_view_ObligationAmount"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->ObligationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ObligationAmount" class="<?php echo $employee_employer_schedule_view_list->ObligationAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->ObligationAmount) ?>', 1);"><div id="elh_employee_employer_schedule_view_ObligationAmount" class="employee_employer_schedule_view_ObligationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->ObligationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->ObligationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->ObligationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->NRC->Visible) { // NRC ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $employee_employer_schedule_view_list->NRC->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_NRC" class="employee_employer_schedule_view_NRC"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $employee_employer_schedule_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->NRC) ?>', 1);"><div id="elh_employee_employer_schedule_view_NRC" class="employee_employer_schedule_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $employee_employer_schedule_view_list->Surname->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_Surname" class="employee_employer_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $employee_employer_schedule_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->Surname) ?>', 1);"><div id="elh_employee_employer_schedule_view_Surname" class="employee_employer_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $employee_employer_schedule_view_list->MiddleName->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_MiddleName" class="employee_employer_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $employee_employer_schedule_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->MiddleName) ?>', 1);"><div id="elh_employee_employer_schedule_view_MiddleName" class="employee_employer_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $employee_employer_schedule_view_list->FirstName->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_FirstName" class="employee_employer_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $employee_employer_schedule_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->FirstName) ?>', 1);"><div id="elh_employee_employer_schedule_view_FirstName" class="employee_employer_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $employee_employer_schedule_view_list->PositionName->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_PositionName" class="employee_employer_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $employee_employer_schedule_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->PositionName) ?>', 1);"><div id="elh_employee_employer_schedule_view_PositionName" class="employee_employer_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_employer_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $employee_employer_schedule_view_list->PeriodCode->headerCellClass() ?>"><div id="elh_employee_employer_schedule_view_PeriodCode" class="employee_employer_schedule_view_PeriodCode"><div class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $employee_employer_schedule_view_list->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_employer_schedule_view_list->SortUrl($employee_employer_schedule_view_list->PeriodCode) ?>', 1);"><div id="elh_employee_employer_schedule_view_PeriodCode" class="employee_employer_schedule_view_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_employer_schedule_view_list->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_employer_schedule_view_list->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_employer_schedule_view_list->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_employer_schedule_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employee_employer_schedule_view_list->ExportAll && $employee_employer_schedule_view_list->isExport()) {
	$employee_employer_schedule_view_list->StopRecord = $employee_employer_schedule_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employee_employer_schedule_view_list->TotalRecords > $employee_employer_schedule_view_list->StartRecord + $employee_employer_schedule_view_list->DisplayRecords - 1)
		$employee_employer_schedule_view_list->StopRecord = $employee_employer_schedule_view_list->StartRecord + $employee_employer_schedule_view_list->DisplayRecords - 1;
	else
		$employee_employer_schedule_view_list->StopRecord = $employee_employer_schedule_view_list->TotalRecords;
}
$employee_employer_schedule_view_list->RecordCount = $employee_employer_schedule_view_list->StartRecord - 1;
if ($employee_employer_schedule_view_list->Recordset && !$employee_employer_schedule_view_list->Recordset->EOF) {
	$employee_employer_schedule_view_list->Recordset->moveFirst();
	$selectLimit = $employee_employer_schedule_view_list->UseSelectLimit;
	if (!$selectLimit && $employee_employer_schedule_view_list->StartRecord > 1)
		$employee_employer_schedule_view_list->Recordset->move($employee_employer_schedule_view_list->StartRecord - 1);
} elseif (!$employee_employer_schedule_view->AllowAddDeleteRow && $employee_employer_schedule_view_list->StopRecord == 0) {
	$employee_employer_schedule_view_list->StopRecord = $employee_employer_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$employee_employer_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$employee_employer_schedule_view->resetAttributes();
$employee_employer_schedule_view_list->renderRow();
while ($employee_employer_schedule_view_list->RecordCount < $employee_employer_schedule_view_list->StopRecord) {
	$employee_employer_schedule_view_list->RecordCount++;
	if ($employee_employer_schedule_view_list->RecordCount >= $employee_employer_schedule_view_list->StartRecord) {
		$employee_employer_schedule_view_list->RowCount++;

		// Set up key count
		$employee_employer_schedule_view_list->KeyCount = $employee_employer_schedule_view_list->RowIndex;

		// Init row class and style
		$employee_employer_schedule_view->resetAttributes();
		$employee_employer_schedule_view->CssClass = "";
		if ($employee_employer_schedule_view_list->isGridAdd()) {
		} else {
			$employee_employer_schedule_view_list->loadRowValues($employee_employer_schedule_view_list->Recordset); // Load row values
		}
		$employee_employer_schedule_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employee_employer_schedule_view->RowAttrs->merge(["data-rowindex" => $employee_employer_schedule_view_list->RowCount, "id" => "r" . $employee_employer_schedule_view_list->RowCount . "_employee_employer_schedule_view", "data-rowtype" => $employee_employer_schedule_view->RowType]);

		// Render row
		$employee_employer_schedule_view_list->renderRow();

		// Render list options
		$employee_employer_schedule_view_list->renderListOptions();
?>
	<tr <?php echo $employee_employer_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_employer_schedule_view_list->ListOptions->render("body", "left", $employee_employer_schedule_view_list->RowCount);
?>
	<?php if ($employee_employer_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employee_employer_schedule_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_EmployeeID">
<span<?php echo $employee_employer_schedule_view_list->EmployeeID->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $employee_employer_schedule_view_list->PayrollDate->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_PayrollDate">
<span<?php echo $employee_employer_schedule_view_list->PayrollDate->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->PayrollDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $employee_employer_schedule_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_LAName">
<span<?php echo $employee_employer_schedule_view_list->LAName->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $employee_employer_schedule_view_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_DeductionName">
<span<?php echo $employee_employer_schedule_view_list->DeductionName->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount" <?php echo $employee_employer_schedule_view_list->DeductionAmount->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_DeductionAmount">
<span<?php echo $employee_employer_schedule_view_list->DeductionAmount->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->DeductionAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->ObligationAmount->Visible) { // ObligationAmount ?>
		<td data-name="ObligationAmount" <?php echo $employee_employer_schedule_view_list->ObligationAmount->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_ObligationAmount">
<span<?php echo $employee_employer_schedule_view_list->ObligationAmount->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->ObligationAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $employee_employer_schedule_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_NRC">
<span<?php echo $employee_employer_schedule_view_list->NRC->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $employee_employer_schedule_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_Surname">
<span<?php echo $employee_employer_schedule_view_list->Surname->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $employee_employer_schedule_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_MiddleName">
<span<?php echo $employee_employer_schedule_view_list->MiddleName->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $employee_employer_schedule_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_FirstName">
<span<?php echo $employee_employer_schedule_view_list->FirstName->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $employee_employer_schedule_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_PositionName">
<span<?php echo $employee_employer_schedule_view_list->PositionName->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_employer_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $employee_employer_schedule_view_list->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $employee_employer_schedule_view_list->RowCount ?>_employee_employer_schedule_view_PeriodCode">
<span<?php echo $employee_employer_schedule_view_list->PeriodCode->viewAttributes() ?>><?php echo $employee_employer_schedule_view_list->PeriodCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_employer_schedule_view_list->ListOptions->render("body", "right", $employee_employer_schedule_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$employee_employer_schedule_view_list->isGridAdd())
		$employee_employer_schedule_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$employee_employer_schedule_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_employer_schedule_view_list->Recordset)
	$employee_employer_schedule_view_list->Recordset->Close();
?>
<?php if (!$employee_employer_schedule_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employee_employer_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_employer_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_employer_schedule_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_employer_schedule_view_list->TotalRecords == 0 && !$employee_employer_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_employer_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employee_employer_schedule_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_employer_schedule_view_list->isExport()) { ?>
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
$employee_employer_schedule_view_list->terminate();
?>