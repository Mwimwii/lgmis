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
$deduction_schedule_view_list = new deduction_schedule_view_list();

// Run the page
$deduction_schedule_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_schedule_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$deduction_schedule_view_list->isExport()) { ?>
<script>
var fdeduction_schedule_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdeduction_schedule_viewlist = currentForm = new ew.Form("fdeduction_schedule_viewlist", "list");
	fdeduction_schedule_viewlist.formKeyCountName = '<?php echo $deduction_schedule_view_list->FormKeyCountName ?>';
	loadjs.done("fdeduction_schedule_viewlist");
});
var fdeduction_schedule_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdeduction_schedule_viewlistsrch = currentSearchForm = new ew.Form("fdeduction_schedule_viewlistsrch");

	// Validate function for search
	fdeduction_schedule_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_schedule_view_list->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PayrollDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($deduction_schedule_view_list->PayrollDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdeduction_schedule_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdeduction_schedule_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdeduction_schedule_viewlistsrch.lists["x_PeriodCode"] = <?php echo $deduction_schedule_view_list->PeriodCode->Lookup->toClientList($deduction_schedule_view_list) ?>;
	fdeduction_schedule_viewlistsrch.lists["x_PeriodCode"].options = <?php echo JsonEncode($deduction_schedule_view_list->PeriodCode->lookupOptions()) ?>;

	// Filters
	fdeduction_schedule_viewlistsrch.filterList = <?php echo $deduction_schedule_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdeduction_schedule_viewlistsrch.initSearchPanel = true;
	loadjs.done("fdeduction_schedule_viewlistsrch");
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
<?php if (!$deduction_schedule_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($deduction_schedule_view_list->TotalRecords > 0 && $deduction_schedule_view_list->ExportOptions->visible()) { ?>
<?php $deduction_schedule_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->ImportOptions->visible()) { ?>
<?php $deduction_schedule_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->SearchOptions->visible()) { ?>
<?php $deduction_schedule_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->FilterOptions->visible()) { ?>
<?php $deduction_schedule_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$deduction_schedule_view_list->isExport() || Config("EXPORT_MASTER_RECORD") && $deduction_schedule_view_list->isExport("print")) { ?>
<?php
if ($deduction_schedule_view_list->DbMasterFilter != "" && $deduction_schedule_view->getCurrentMasterTable() == "payroll_period") {
	if ($deduction_schedule_view_list->MasterRecordExists) {
		include_once "payroll_periodmaster.php";
	}
}
?>
<?php } ?>
<?php
$deduction_schedule_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$deduction_schedule_view_list->isExport() && !$deduction_schedule_view->CurrentAction) { ?>
<form name="fdeduction_schedule_viewlistsrch" id="fdeduction_schedule_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdeduction_schedule_viewlistsrch-search-panel" class="<?php echo $deduction_schedule_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="deduction_schedule_view">
	<div class="ew-extended-search">
<?php

// Render search row
$deduction_schedule_view->RowType = ROWTYPE_SEARCH;
$deduction_schedule_view->resetAttributes();
$deduction_schedule_view_list->renderRow();
?>
<?php if ($deduction_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_EmployeeID" class="ew-cell form-group">
		<label for="x_EmployeeID" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->EmployeeID->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		<span id="el_deduction_schedule_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="deduction_schedule_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($deduction_schedule_view_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_list->EmployeeID->EditValue ?>"<?php echo $deduction_schedule_view_list->EmployeeID->editAttributes() ?>>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollDate" class="ew-cell form-group">
		<label for="x_PayrollDate" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->PayrollDate->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollDate" id="z_PayrollDate" value="=">
</span>
		<span id="el_deduction_schedule_view_PayrollDate" class="ew-search-field">
<input type="text" data-table="deduction_schedule_view" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($deduction_schedule_view_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_list->PayrollDate->EditValue ?>"<?php echo $deduction_schedule_view_list->PayrollDate->editAttributes() ?>>
<?php if (!$deduction_schedule_view_list->PayrollDate->ReadOnly && !$deduction_schedule_view_list->PayrollDate->Disabled && !isset($deduction_schedule_view_list->PayrollDate->EditAttrs["readonly"]) && !isset($deduction_schedule_view_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdeduction_schedule_viewlistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fdeduction_schedule_viewlistsrch", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->LAName->Visible) { // LAName ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LAName" class="ew-cell form-group">
		<label for="x_LAName" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->LAName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		<span id="el_deduction_schedule_view_LAName" class="ew-search-field">
<input type="text" data-table="deduction_schedule_view" data-field="x_LAName" name="x_LAName" id="x_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($deduction_schedule_view_list->LAName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_list->LAName->EditValue ?>"<?php echo $deduction_schedule_view_list->LAName->editAttributes() ?>>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DeductionName" class="ew-cell form-group">
		<label for="x_DeductionName" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->DeductionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionName" id="z_DeductionName" value="LIKE">
</span>
		<span id="el_deduction_schedule_view_DeductionName" class="ew-search-field">
<input type="text" data-table="deduction_schedule_view" data-field="x_DeductionName" name="x_DeductionName" id="x_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_list->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_list->DeductionName->EditValue ?>"<?php echo $deduction_schedule_view_list->DeductionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_deduction_schedule_view_Surname" class="ew-search-field">
<input type="text" data-table="deduction_schedule_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_list->Surname->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_list->Surname->EditValue ?>"<?php echo $deduction_schedule_view_list->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_FirstName" class="ew-cell form-group">
		<label for="x_FirstName" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->FirstName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		<span id="el_deduction_schedule_view_FirstName" class="ew-search-field">
<input type="text" data-table="deduction_schedule_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($deduction_schedule_view_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_list->FirstName->EditValue ?>"<?php echo $deduction_schedule_view_list->FirstName->editAttributes() ?>>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_deduction_schedule_view_PositionName" class="ew-search-field">
<input type="text" data-table="deduction_schedule_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_schedule_view_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $deduction_schedule_view_list->PositionName->EditValue ?>"<?php echo $deduction_schedule_view_list->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php
		$deduction_schedule_view_list->SearchColumnCount++;
		if (($deduction_schedule_view_list->SearchColumnCount - 1) % $deduction_schedule_view_list->SearchFieldsPerRow == 0) {
			$deduction_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PeriodCode" class="ew-cell form-group">
		<label for="x_PeriodCode" class="ew-search-caption ew-label"><?php echo $deduction_schedule_view_list->PeriodCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PeriodCode" id="z_PeriodCode" value="=">
</span>
		<span id="el_deduction_schedule_view_PeriodCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_schedule_view" data-field="x_PeriodCode" data-value-separator="<?php echo $deduction_schedule_view_list->PeriodCode->displayValueSeparatorAttribute() ?>" id="x_PeriodCode" name="x_PeriodCode"<?php echo $deduction_schedule_view_list->PeriodCode->editAttributes() ?>>
			<?php echo $deduction_schedule_view_list->PeriodCode->selectOptionListHtml("x_PeriodCode") ?>
		</select>
</div>
<?php echo $deduction_schedule_view_list->PeriodCode->Lookup->getParamTag($deduction_schedule_view_list, "p_x_PeriodCode") ?>
</span>
	</div>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($deduction_schedule_view_list->SearchColumnCount % $deduction_schedule_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $deduction_schedule_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($deduction_schedule_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($deduction_schedule_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $deduction_schedule_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($deduction_schedule_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($deduction_schedule_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($deduction_schedule_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($deduction_schedule_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $deduction_schedule_view_list->showPageHeader(); ?>
<?php
$deduction_schedule_view_list->showMessage();
?>
<?php if ($deduction_schedule_view_list->TotalRecords > 0 || $deduction_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($deduction_schedule_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> deduction_schedule_view">
<?php if (!$deduction_schedule_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$deduction_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deduction_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deduction_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdeduction_schedule_viewlist" id="fdeduction_schedule_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deduction_schedule_view">
<?php if ($deduction_schedule_view->getCurrentMasterTable() == "payroll_period" && $deduction_schedule_view->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="payroll_period">
<input type="hidden" name="fk_PeriodCode" value="<?php echo HtmlEncode($deduction_schedule_view_list->PeriodCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_deduction_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($deduction_schedule_view_list->TotalRecords > 0 || $deduction_schedule_view_list->isGridEdit()) { ?>
<table id="tbl_deduction_schedule_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$deduction_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$deduction_schedule_view_list->renderListOptions();

// Render list options (header, left)
$deduction_schedule_view_list->ListOptions->render("header", "left");
?>
<?php if ($deduction_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $deduction_schedule_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_deduction_schedule_view_EmployeeID" class="deduction_schedule_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $deduction_schedule_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->EmployeeID) ?>', 1);"><div id="elh_deduction_schedule_view_EmployeeID" class="deduction_schedule_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $deduction_schedule_view_list->PayrollDate->headerCellClass() ?>"><div id="elh_deduction_schedule_view_PayrollDate" class="deduction_schedule_view_PayrollDate"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $deduction_schedule_view_list->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->PayrollDate) ?>', 1);"><div id="elh_deduction_schedule_view_PayrollDate" class="deduction_schedule_view_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->LAName->Visible) { // LAName ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $deduction_schedule_view_list->LAName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_LAName" class="deduction_schedule_view_LAName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $deduction_schedule_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->LAName) ?>', 1);"><div id="elh_deduction_schedule_view_LAName" class="deduction_schedule_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $deduction_schedule_view_list->DeductionName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_DeductionName" class="deduction_schedule_view_DeductionName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $deduction_schedule_view_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->DeductionName) ?>', 1);"><div id="elh_deduction_schedule_view_DeductionName" class="deduction_schedule_view_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->DeductionAmount) == "") { ?>
		<th data-name="DeductionAmount" class="<?php echo $deduction_schedule_view_list->DeductionAmount->headerCellClass() ?>"><div id="elh_deduction_schedule_view_DeductionAmount" class="deduction_schedule_view_DeductionAmount"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionAmount" class="<?php echo $deduction_schedule_view_list->DeductionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->DeductionAmount) ?>', 1);"><div id="elh_deduction_schedule_view_DeductionAmount" class="deduction_schedule_view_DeductionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->NRC->Visible) { // NRC ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $deduction_schedule_view_list->NRC->headerCellClass() ?>"><div id="elh_deduction_schedule_view_NRC" class="deduction_schedule_view_NRC"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $deduction_schedule_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->NRC) ?>', 1);"><div id="elh_deduction_schedule_view_NRC" class="deduction_schedule_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $deduction_schedule_view_list->Surname->headerCellClass() ?>"><div id="elh_deduction_schedule_view_Surname" class="deduction_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $deduction_schedule_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->Surname) ?>', 1);"><div id="elh_deduction_schedule_view_Surname" class="deduction_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $deduction_schedule_view_list->MiddleName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_MiddleName" class="deduction_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $deduction_schedule_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->MiddleName) ?>', 1);"><div id="elh_deduction_schedule_view_MiddleName" class="deduction_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $deduction_schedule_view_list->FirstName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_FirstName" class="deduction_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $deduction_schedule_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->FirstName) ?>', 1);"><div id="elh_deduction_schedule_view_FirstName" class="deduction_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $deduction_schedule_view_list->PositionName->headerCellClass() ?>"><div id="elh_deduction_schedule_view_PositionName" class="deduction_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $deduction_schedule_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->PositionName) ?>', 1);"><div id="elh_deduction_schedule_view_PositionName" class="deduction_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $deduction_schedule_view_list->PeriodCode->headerCellClass() ?>"><div id="elh_deduction_schedule_view_PeriodCode" class="deduction_schedule_view_PeriodCode"><div class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $deduction_schedule_view_list->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_schedule_view_list->SortUrl($deduction_schedule_view_list->PeriodCode) ?>', 1);"><div id="elh_deduction_schedule_view_PeriodCode" class="deduction_schedule_view_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_schedule_view_list->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_schedule_view_list->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_schedule_view_list->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$deduction_schedule_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($deduction_schedule_view_list->ExportAll && $deduction_schedule_view_list->isExport()) {
	$deduction_schedule_view_list->StopRecord = $deduction_schedule_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($deduction_schedule_view_list->TotalRecords > $deduction_schedule_view_list->StartRecord + $deduction_schedule_view_list->DisplayRecords - 1)
		$deduction_schedule_view_list->StopRecord = $deduction_schedule_view_list->StartRecord + $deduction_schedule_view_list->DisplayRecords - 1;
	else
		$deduction_schedule_view_list->StopRecord = $deduction_schedule_view_list->TotalRecords;
}
$deduction_schedule_view_list->RecordCount = $deduction_schedule_view_list->StartRecord - 1;
if ($deduction_schedule_view_list->Recordset && !$deduction_schedule_view_list->Recordset->EOF) {
	$deduction_schedule_view_list->Recordset->moveFirst();
	$selectLimit = $deduction_schedule_view_list->UseSelectLimit;
	if (!$selectLimit && $deduction_schedule_view_list->StartRecord > 1)
		$deduction_schedule_view_list->Recordset->move($deduction_schedule_view_list->StartRecord - 1);
} elseif (!$deduction_schedule_view->AllowAddDeleteRow && $deduction_schedule_view_list->StopRecord == 0) {
	$deduction_schedule_view_list->StopRecord = $deduction_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$deduction_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$deduction_schedule_view->resetAttributes();
$deduction_schedule_view_list->renderRow();
while ($deduction_schedule_view_list->RecordCount < $deduction_schedule_view_list->StopRecord) {
	$deduction_schedule_view_list->RecordCount++;
	if ($deduction_schedule_view_list->RecordCount >= $deduction_schedule_view_list->StartRecord) {
		$deduction_schedule_view_list->RowCount++;

		// Set up key count
		$deduction_schedule_view_list->KeyCount = $deduction_schedule_view_list->RowIndex;

		// Init row class and style
		$deduction_schedule_view->resetAttributes();
		$deduction_schedule_view->CssClass = "";
		if ($deduction_schedule_view_list->isGridAdd()) {
		} else {
			$deduction_schedule_view_list->loadRowValues($deduction_schedule_view_list->Recordset); // Load row values
		}
		$deduction_schedule_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$deduction_schedule_view->RowAttrs->merge(["data-rowindex" => $deduction_schedule_view_list->RowCount, "id" => "r" . $deduction_schedule_view_list->RowCount . "_deduction_schedule_view", "data-rowtype" => $deduction_schedule_view->RowType]);

		// Render row
		$deduction_schedule_view_list->renderRow();

		// Render list options
		$deduction_schedule_view_list->renderListOptions();
?>
	<tr <?php echo $deduction_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$deduction_schedule_view_list->ListOptions->render("body", "left", $deduction_schedule_view_list->RowCount);
?>
	<?php if ($deduction_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $deduction_schedule_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_EmployeeID">
<span<?php echo $deduction_schedule_view_list->EmployeeID->viewAttributes() ?>><?php echo $deduction_schedule_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $deduction_schedule_view_list->PayrollDate->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_PayrollDate">
<span<?php echo $deduction_schedule_view_list->PayrollDate->viewAttributes() ?>><?php echo $deduction_schedule_view_list->PayrollDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $deduction_schedule_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_LAName">
<span<?php echo $deduction_schedule_view_list->LAName->viewAttributes() ?>><?php echo $deduction_schedule_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $deduction_schedule_view_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_DeductionName">
<span<?php echo $deduction_schedule_view_list->DeductionName->viewAttributes() ?>><?php echo $deduction_schedule_view_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount" <?php echo $deduction_schedule_view_list->DeductionAmount->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_DeductionAmount">
<span<?php echo $deduction_schedule_view_list->DeductionAmount->viewAttributes() ?>><?php echo $deduction_schedule_view_list->DeductionAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $deduction_schedule_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_NRC">
<span<?php echo $deduction_schedule_view_list->NRC->viewAttributes() ?>><?php echo $deduction_schedule_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $deduction_schedule_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_Surname">
<span<?php echo $deduction_schedule_view_list->Surname->viewAttributes() ?>><?php echo $deduction_schedule_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $deduction_schedule_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_MiddleName">
<span<?php echo $deduction_schedule_view_list->MiddleName->viewAttributes() ?>><?php echo $deduction_schedule_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $deduction_schedule_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_FirstName">
<span<?php echo $deduction_schedule_view_list->FirstName->viewAttributes() ?>><?php echo $deduction_schedule_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $deduction_schedule_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_PositionName">
<span<?php echo $deduction_schedule_view_list->PositionName->viewAttributes() ?>><?php echo $deduction_schedule_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deduction_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $deduction_schedule_view_list->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $deduction_schedule_view_list->RowCount ?>_deduction_schedule_view_PeriodCode">
<span<?php echo $deduction_schedule_view_list->PeriodCode->viewAttributes() ?>><?php echo $deduction_schedule_view_list->PeriodCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deduction_schedule_view_list->ListOptions->render("body", "right", $deduction_schedule_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$deduction_schedule_view_list->isGridAdd())
		$deduction_schedule_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$deduction_schedule_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($deduction_schedule_view_list->Recordset)
	$deduction_schedule_view_list->Recordset->Close();
?>
<?php if (!$deduction_schedule_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$deduction_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deduction_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deduction_schedule_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($deduction_schedule_view_list->TotalRecords == 0 && !$deduction_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $deduction_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$deduction_schedule_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$deduction_schedule_view_list->isExport()) { ?>
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
$deduction_schedule_view_list->terminate();
?>