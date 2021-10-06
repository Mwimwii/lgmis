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
$employment_list = new employment_list();

// Run the page
$employment_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_list->isExport()) { ?>
<script>
var femploymentlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femploymentlist = currentForm = new ew.Form("femploymentlist", "list");
	femploymentlist.formKeyCountName = '<?php echo $employment_list->FormKeyCountName ?>';

	// Validate form
	femploymentlist.validate = function() {
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
			<?php if ($employment_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->ProvinceCode->caption(), $employment_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->LACode->caption(), $employment_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->DepartmentCode->caption(), $employment_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->SectionCode->caption(), $employment_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->SubstantivePosition->Required) { ?>
				elm = this.getElements("x" + infix + "_SubstantivePosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->SubstantivePosition->caption(), $employment_list->SubstantivePosition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->DateOfCurrentAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->DateOfCurrentAppointment->caption(), $employment_list->DateOfCurrentAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_list->DateOfCurrentAppointment->errorMessage()) ?>");
			<?php if ($employment_list->LastAppraisalDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->LastAppraisalDate->caption(), $employment_list->LastAppraisalDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_list->LastAppraisalDate->errorMessage()) ?>");
			<?php if ($employment_list->AppraisalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppraisalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->AppraisalStatus->caption(), $employment_list->AppraisalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->DateOfExit->caption(), $employment_list->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_list->DateOfExit->errorMessage()) ?>");
			<?php if ($employment_list->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->EmploymentType->caption(), $employment_list->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->EmploymentStatus->caption(), $employment_list->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->EmployeeNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->EmployeeNumber->caption(), $employment_list->EmployeeNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->SalaryNotch->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryNotch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->SalaryNotch->caption(), $employment_list->SalaryNotch->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->BasicMonthlySalary->caption(), $employment_list->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_list->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($employment_list->ThirdParties->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdParties[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->ThirdParties->caption(), $employment_list->ThirdParties->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_list->PayrollCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->PayrollCode->caption(), $employment_list->PayrollCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_list->PayrollCode->errorMessage()) ?>");
			<?php if ($employment_list->DateOfConfirmation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_list->DateOfConfirmation->caption(), $employment_list->DateOfConfirmation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_list->DateOfConfirmation->errorMessage()) ?>");

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
	femploymentlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubstantivePosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfCurrentAppointment", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastAppraisalDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "AppraisalStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfExit", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmploymentType", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmploymentStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployeeNumber", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryNotch", false)) return false;
		if (ew.valueChanged(fobj, infix, "BasicMonthlySalary", false)) return false;
		if (ew.valueChanged(fobj, infix, "ThirdParties[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfConfirmation", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femploymentlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femploymentlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femploymentlist.lists["x_ProvinceCode"] = <?php echo $employment_list->ProvinceCode->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_list->ProvinceCode->lookupOptions()) ?>;
	femploymentlist.lists["x_LACode"] = <?php echo $employment_list->LACode->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_LACode"].options = <?php echo JsonEncode($employment_list->LACode->lookupOptions()) ?>;
	femploymentlist.lists["x_DepartmentCode"] = <?php echo $employment_list->DepartmentCode->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_list->DepartmentCode->lookupOptions()) ?>;
	femploymentlist.lists["x_SectionCode"] = <?php echo $employment_list->SectionCode->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_list->SectionCode->lookupOptions()) ?>;
	femploymentlist.lists["x_SubstantivePosition"] = <?php echo $employment_list->SubstantivePosition->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_SubstantivePosition"].options = <?php echo JsonEncode($employment_list->SubstantivePosition->lookupOptions()) ?>;
	femploymentlist.lists["x_AppraisalStatus"] = <?php echo $employment_list->AppraisalStatus->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_AppraisalStatus"].options = <?php echo JsonEncode($employment_list->AppraisalStatus->lookupOptions()) ?>;
	femploymentlist.lists["x_EmploymentType"] = <?php echo $employment_list->EmploymentType->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_EmploymentType"].options = <?php echo JsonEncode($employment_list->EmploymentType->lookupOptions()) ?>;
	femploymentlist.lists["x_EmploymentStatus"] = <?php echo $employment_list->EmploymentStatus->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_EmploymentStatus"].options = <?php echo JsonEncode($employment_list->EmploymentStatus->lookupOptions()) ?>;
	femploymentlist.lists["x_SalaryNotch"] = <?php echo $employment_list->SalaryNotch->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_SalaryNotch"].options = <?php echo JsonEncode($employment_list->SalaryNotch->lookupOptions()) ?>;
	femploymentlist.lists["x_ThirdParties[]"] = <?php echo $employment_list->ThirdParties->Lookup->toClientList($employment_list) ?>;
	femploymentlist.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($employment_list->ThirdParties->lookupOptions()) ?>;
	loadjs.done("femploymentlist");
});
var femploymentlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femploymentlistsrch = currentSearchForm = new ew.Form("femploymentlistsrch");

	// Dynamic selection lists
	// Filters

	femploymentlistsrch.filterList = <?php echo $employment_list->getFilterList() ?>;

	// Init search panel as collapsed
	femploymentlistsrch.initSearchPanel = true;
	loadjs.done("femploymentlistsrch");
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
<?php if (!$employment_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employment_list->TotalRecords > 0 && $employment_list->ExportOptions->visible()) { ?>
<?php $employment_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_list->ImportOptions->visible()) { ?>
<?php $employment_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_list->SearchOptions->visible()) { ?>
<?php $employment_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employment_list->FilterOptions->visible()) { ?>
<?php $employment_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$employment_list->isExport() || Config("EXPORT_MASTER_RECORD") && $employment_list->isExport("print")) { ?>
<?php
if ($employment_list->DbMasterFilter != "" && $employment->getCurrentMasterTable() == "position_ref") {
	if ($employment_list->MasterRecordExists) {
		include_once "position_refmaster.php";
	}
}
?>
<?php
if ($employment_list->DbMasterFilter != "" && $employment->getCurrentMasterTable() == "staff") {
	if ($employment_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$employment_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employment_list->isExport() && !$employment->CurrentAction) { ?>
<form name="femploymentlistsrch" id="femploymentlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femploymentlistsrch-search-panel" class="<?php echo $employment_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employment">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employment_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employment_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employment_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employment_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employment_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employment_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employment_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employment_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employment_list->showPageHeader(); ?>
<?php
$employment_list->showMessage();
?>
<?php if ($employment_list->TotalRecords > 0 || $employment->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employment_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employment">
<?php if (!$employment_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employment_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femploymentlist" id="femploymentlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment">
<?php if ($employment->getCurrentMasterTable() == "position_ref" && $employment->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="position_ref">
<input type="hidden" name="fk_PositionCode" value="<?php echo HtmlEncode($employment_list->SubstantivePosition->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($employment_list->SectionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($employment_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($employment_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($employment_list->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SalaryScale" value="<?php echo HtmlEncode($employment_list->SalaryScale->getSessionValue()) ?>">
<?php } ?>
<?php if ($employment->getCurrentMasterTable() == "staff" && $employment->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employment_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_employment" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employment_list->TotalRecords > 0 || $employment_list->isGridEdit()) { ?>
<table id="tbl_employmentlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employment->RowType = ROWTYPE_HEADER;

// Render list options
$employment_list->renderListOptions();

// Render list options (header, left)
$employment_list->ListOptions->render("header", "left");
?>
<?php if ($employment_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($employment_list->SortUrl($employment_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_list->ProvinceCode->headerCellClass() ?>"><div id="elh_employment_ProvinceCode" class="employment_ProvinceCode"><div class="ew-table-header-caption"><?php echo $employment_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->ProvinceCode) ?>', 1);"><div id="elh_employment_ProvinceCode" class="employment_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->LACode->Visible) { // LACode ?>
	<?php if ($employment_list->SortUrl($employment_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $employment_list->LACode->headerCellClass() ?>"><div id="elh_employment_LACode" class="employment_LACode"><div class="ew-table-header-caption"><?php echo $employment_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $employment_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->LACode) ?>', 1);"><div id="elh_employment_LACode" class="employment_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($employment_list->SortUrl($employment_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_list->DepartmentCode->headerCellClass() ?>"><div id="elh_employment_DepartmentCode" class="employment_DepartmentCode"><div class="ew-table-header-caption"><?php echo $employment_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->DepartmentCode) ?>', 1);"><div id="elh_employment_DepartmentCode" class="employment_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($employment_list->SortUrl($employment_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $employment_list->SectionCode->headerCellClass() ?>"><div id="elh_employment_SectionCode" class="employment_SectionCode"><div class="ew-table-header-caption"><?php echo $employment_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $employment_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->SectionCode) ?>', 1);"><div id="elh_employment_SectionCode" class="employment_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<?php if ($employment_list->SortUrl($employment_list->SubstantivePosition) == "") { ?>
		<th data-name="SubstantivePosition" class="<?php echo $employment_list->SubstantivePosition->headerCellClass() ?>"><div id="elh_employment_SubstantivePosition" class="employment_SubstantivePosition"><div class="ew-table-header-caption"><?php echo $employment_list->SubstantivePosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubstantivePosition" class="<?php echo $employment_list->SubstantivePosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->SubstantivePosition) ?>', 1);"><div id="elh_employment_SubstantivePosition" class="employment_SubstantivePosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->SubstantivePosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->SubstantivePosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->SubstantivePosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<?php if ($employment_list->SortUrl($employment_list->DateOfCurrentAppointment) == "") { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $employment_list->DateOfCurrentAppointment->headerCellClass() ?>"><div id="elh_employment_DateOfCurrentAppointment" class="employment_DateOfCurrentAppointment"><div class="ew-table-header-caption"><?php echo $employment_list->DateOfCurrentAppointment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $employment_list->DateOfCurrentAppointment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->DateOfCurrentAppointment) ?>', 1);"><div id="elh_employment_DateOfCurrentAppointment" class="employment_DateOfCurrentAppointment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->DateOfCurrentAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->DateOfCurrentAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->DateOfCurrentAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
	<?php if ($employment_list->SortUrl($employment_list->LastAppraisalDate) == "") { ?>
		<th data-name="LastAppraisalDate" class="<?php echo $employment_list->LastAppraisalDate->headerCellClass() ?>"><div id="elh_employment_LastAppraisalDate" class="employment_LastAppraisalDate"><div class="ew-table-header-caption"><?php echo $employment_list->LastAppraisalDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastAppraisalDate" class="<?php echo $employment_list->LastAppraisalDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->LastAppraisalDate) ?>', 1);"><div id="elh_employment_LastAppraisalDate" class="employment_LastAppraisalDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->LastAppraisalDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->LastAppraisalDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->LastAppraisalDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<?php if ($employment_list->SortUrl($employment_list->AppraisalStatus) == "") { ?>
		<th data-name="AppraisalStatus" class="<?php echo $employment_list->AppraisalStatus->headerCellClass() ?>"><div id="elh_employment_AppraisalStatus" class="employment_AppraisalStatus"><div class="ew-table-header-caption"><?php echo $employment_list->AppraisalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppraisalStatus" class="<?php echo $employment_list->AppraisalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->AppraisalStatus) ?>', 1);"><div id="elh_employment_AppraisalStatus" class="employment_AppraisalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->AppraisalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->AppraisalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->AppraisalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->DateOfExit->Visible) { // DateOfExit ?>
	<?php if ($employment_list->SortUrl($employment_list->DateOfExit) == "") { ?>
		<th data-name="DateOfExit" class="<?php echo $employment_list->DateOfExit->headerCellClass() ?>"><div id="elh_employment_DateOfExit" class="employment_DateOfExit"><div class="ew-table-header-caption"><?php echo $employment_list->DateOfExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfExit" class="<?php echo $employment_list->DateOfExit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->DateOfExit) ?>', 1);"><div id="elh_employment_DateOfExit" class="employment_DateOfExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->DateOfExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->DateOfExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->EmploymentType->Visible) { // EmploymentType ?>
	<?php if ($employment_list->SortUrl($employment_list->EmploymentType) == "") { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_list->EmploymentType->headerCellClass() ?>"><div id="elh_employment_EmploymentType" class="employment_EmploymentType"><div class="ew-table-header-caption"><?php echo $employment_list->EmploymentType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_list->EmploymentType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->EmploymentType) ?>', 1);"><div id="elh_employment_EmploymentType" class="employment_EmploymentType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->EmploymentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->EmploymentType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->EmploymentType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<?php if ($employment_list->SortUrl($employment_list->EmploymentStatus) == "") { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_list->EmploymentStatus->headerCellClass() ?>"><div id="elh_employment_EmploymentStatus" class="employment_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $employment_list->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_list->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->EmploymentStatus) ?>', 1);"><div id="elh_employment_EmploymentStatus" class="employment_EmploymentStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->EmployeeNumber->Visible) { // EmployeeNumber ?>
	<?php if ($employment_list->SortUrl($employment_list->EmployeeNumber) == "") { ?>
		<th data-name="EmployeeNumber" class="<?php echo $employment_list->EmployeeNumber->headerCellClass() ?>"><div id="elh_employment_EmployeeNumber" class="employment_EmployeeNumber"><div class="ew-table-header-caption"><?php echo $employment_list->EmployeeNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeNumber" class="<?php echo $employment_list->EmployeeNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->EmployeeNumber) ?>', 1);"><div id="elh_employment_EmployeeNumber" class="employment_EmployeeNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->EmployeeNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_list->EmployeeNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->EmployeeNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->SalaryNotch->Visible) { // SalaryNotch ?>
	<?php if ($employment_list->SortUrl($employment_list->SalaryNotch) == "") { ?>
		<th data-name="SalaryNotch" class="<?php echo $employment_list->SalaryNotch->headerCellClass() ?>"><div id="elh_employment_SalaryNotch" class="employment_SalaryNotch"><div class="ew-table-header-caption"><?php echo $employment_list->SalaryNotch->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryNotch" class="<?php echo $employment_list->SalaryNotch->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->SalaryNotch) ?>', 1);"><div id="elh_employment_SalaryNotch" class="employment_SalaryNotch">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->SalaryNotch->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->SalaryNotch->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->SalaryNotch->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($employment_list->SortUrl($employment_list->BasicMonthlySalary) == "") { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $employment_list->BasicMonthlySalary->headerCellClass() ?>"><div id="elh_employment_BasicMonthlySalary" class="employment_BasicMonthlySalary"><div class="ew-table-header-caption"><?php echo $employment_list->BasicMonthlySalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicMonthlySalary" class="<?php echo $employment_list->BasicMonthlySalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->BasicMonthlySalary) ?>', 1);"><div id="elh_employment_BasicMonthlySalary" class="employment_BasicMonthlySalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->BasicMonthlySalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->BasicMonthlySalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->ThirdParties->Visible) { // ThirdParties ?>
	<?php if ($employment_list->SortUrl($employment_list->ThirdParties) == "") { ?>
		<th data-name="ThirdParties" class="<?php echo $employment_list->ThirdParties->headerCellClass() ?>"><div id="elh_employment_ThirdParties" class="employment_ThirdParties"><div class="ew-table-header-caption"><?php echo $employment_list->ThirdParties->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdParties" class="<?php echo $employment_list->ThirdParties->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->ThirdParties) ?>', 1);"><div id="elh_employment_ThirdParties" class="employment_ThirdParties">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->ThirdParties->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->ThirdParties->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->ThirdParties->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->PayrollCode->Visible) { // PayrollCode ?>
	<?php if ($employment_list->SortUrl($employment_list->PayrollCode) == "") { ?>
		<th data-name="PayrollCode" class="<?php echo $employment_list->PayrollCode->headerCellClass() ?>"><div id="elh_employment_PayrollCode" class="employment_PayrollCode"><div class="ew-table-header-caption"><?php echo $employment_list->PayrollCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollCode" class="<?php echo $employment_list->PayrollCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->PayrollCode) ?>', 1);"><div id="elh_employment_PayrollCode" class="employment_PayrollCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->PayrollCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->PayrollCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->PayrollCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_list->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<?php if ($employment_list->SortUrl($employment_list->DateOfConfirmation) == "") { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $employment_list->DateOfConfirmation->headerCellClass() ?>"><div id="elh_employment_DateOfConfirmation" class="employment_DateOfConfirmation"><div class="ew-table-header-caption"><?php echo $employment_list->DateOfConfirmation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $employment_list->DateOfConfirmation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_list->SortUrl($employment_list->DateOfConfirmation) ?>', 1);"><div id="elh_employment_DateOfConfirmation" class="employment_DateOfConfirmation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_list->DateOfConfirmation->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_list->DateOfConfirmation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_list->DateOfConfirmation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employment_list->ExportAll && $employment_list->isExport()) {
	$employment_list->StopRecord = $employment_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employment_list->TotalRecords > $employment_list->StartRecord + $employment_list->DisplayRecords - 1)
		$employment_list->StopRecord = $employment_list->StartRecord + $employment_list->DisplayRecords - 1;
	else
		$employment_list->StopRecord = $employment_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employment->isConfirm() || $employment_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employment_list->FormKeyCountName) && ($employment_list->isGridAdd() || $employment_list->isGridEdit() || $employment->isConfirm())) {
		$employment_list->KeyCount = $CurrentForm->getValue($employment_list->FormKeyCountName);
		$employment_list->StopRecord = $employment_list->StartRecord + $employment_list->KeyCount - 1;
	}
}
$employment_list->RecordCount = $employment_list->StartRecord - 1;
if ($employment_list->Recordset && !$employment_list->Recordset->EOF) {
	$employment_list->Recordset->moveFirst();
	$selectLimit = $employment_list->UseSelectLimit;
	if (!$selectLimit && $employment_list->StartRecord > 1)
		$employment_list->Recordset->move($employment_list->StartRecord - 1);
} elseif (!$employment->AllowAddDeleteRow && $employment_list->StopRecord == 0) {
	$employment_list->StopRecord = $employment->GridAddRowCount;
}

// Initialize aggregate
$employment->RowType = ROWTYPE_AGGREGATEINIT;
$employment->resetAttributes();
$employment_list->renderRow();
if ($employment_list->isGridAdd())
	$employment_list->RowIndex = 0;
if ($employment_list->isGridEdit())
	$employment_list->RowIndex = 0;
while ($employment_list->RecordCount < $employment_list->StopRecord) {
	$employment_list->RecordCount++;
	if ($employment_list->RecordCount >= $employment_list->StartRecord) {
		$employment_list->RowCount++;
		if ($employment_list->isGridAdd() || $employment_list->isGridEdit() || $employment->isConfirm()) {
			$employment_list->RowIndex++;
			$CurrentForm->Index = $employment_list->RowIndex;
			if ($CurrentForm->hasValue($employment_list->FormActionName) && ($employment->isConfirm() || $employment_list->EventCancelled))
				$employment_list->RowAction = strval($CurrentForm->getValue($employment_list->FormActionName));
			elseif ($employment_list->isGridAdd())
				$employment_list->RowAction = "insert";
			else
				$employment_list->RowAction = "";
		}

		// Set up key count
		$employment_list->KeyCount = $employment_list->RowIndex;

		// Init row class and style
		$employment->resetAttributes();
		$employment->CssClass = "";
		if ($employment_list->isGridAdd()) {
			$employment_list->loadRowValues(); // Load default values
		} else {
			$employment_list->loadRowValues($employment_list->Recordset); // Load row values
		}
		$employment->RowType = ROWTYPE_VIEW; // Render view
		if ($employment_list->isGridAdd()) // Grid add
			$employment->RowType = ROWTYPE_ADD; // Render add
		if ($employment_list->isGridAdd() && $employment->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employment_list->restoreCurrentRowFormValues($employment_list->RowIndex); // Restore form values
		if ($employment_list->isGridEdit()) { // Grid edit
			if ($employment->EventCancelled)
				$employment_list->restoreCurrentRowFormValues($employment_list->RowIndex); // Restore form values
			if ($employment_list->RowAction == "insert")
				$employment->RowType = ROWTYPE_ADD; // Render add
			else
				$employment->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employment_list->isGridEdit() && ($employment->RowType == ROWTYPE_EDIT || $employment->RowType == ROWTYPE_ADD) && $employment->EventCancelled) // Update failed
			$employment_list->restoreCurrentRowFormValues($employment_list->RowIndex); // Restore form values
		if ($employment->RowType == ROWTYPE_EDIT) // Edit row
			$employment_list->EditRowCount++;

		// Set up row id / data-rowindex
		$employment->RowAttrs->merge(["data-rowindex" => $employment_list->RowCount, "id" => "r" . $employment_list->RowCount . "_employment", "data-rowtype" => $employment->RowType]);

		// Render row
		$employment_list->renderRow();

		// Render list options
		$employment_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employment_list->RowAction != "delete" && $employment_list->RowAction != "insertdelete" && !($employment_list->RowAction == "insert" && $employment->isConfirm() && $employment_list->emptyRow())) {
?>
	<tr <?php echo $employment->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_list->ListOptions->render("body", "left", $employment_list->RowCount);
?>
	<?php if ($employment_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $employment_list->ProvinceCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ProvinceCode" class="form-group">
<span<?php echo $employment_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ProvinceCode" class="form-group">
<?php $employment_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_list->RowIndex ?>_ProvinceCode"<?php echo $employment_list->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_list->ProvinceCode->selectOptionListHtml("x{$employment_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_list->ProvinceCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="o<?php echo $employment_list->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ProvinceCode" class="form-group">
<span<?php echo $employment_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ProvinceCode" class="form-group">
<?php $employment_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_list->RowIndex ?>_ProvinceCode"<?php echo $employment_list->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_list->ProvinceCode->selectOptionListHtml("x{$employment_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_list->ProvinceCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ProvinceCode">
<span<?php echo $employment_list->ProvinceCode->viewAttributes() ?>><?php echo $employment_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="employment" data-field="x_EmployeeID" name="x<?php echo $employment_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_list->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="employment" data-field="x_EmployeeID" name="o<?php echo $employment_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT || $employment->CurrentMode == "edit") { ?>
<input type="hidden" data-table="employment" data-field="x_EmployeeID" name="x<?php echo $employment_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($employment_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $employment_list->LACode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LACode" class="form-group">
<span<?php echo $employment_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_LACode" name="x<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LACode" class="form-group">
<?php $employment_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($employment_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->LACode->ReadOnly || $employment_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->LACode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_LACode" id="x<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo $employment_list->LACode->CurrentValue ?>"<?php echo $employment_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_LACode" name="o<?php echo $employment_list->RowIndex ?>_LACode" id="o<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LACode" class="form-group">
<span<?php echo $employment_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_LACode" name="x<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LACode" class="form-group">
<?php $employment_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($employment_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->LACode->ReadOnly || $employment_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->LACode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_LACode" id="x<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo $employment_list->LACode->CurrentValue ?>"<?php echo $employment_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LACode">
<span<?php echo $employment_list->LACode->viewAttributes() ?>><?php echo $employment_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $employment_list->DepartmentCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DepartmentCode" class="form-group">
<span<?php echo $employment_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DepartmentCode" class="form-group">
<?php $employment_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($employment_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->DepartmentCode->ReadOnly || $employment_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->DepartmentCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo $employment_list->DepartmentCode->CurrentValue ?>"<?php echo $employment_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="o<?php echo $employment_list->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DepartmentCode" class="form-group">
<span<?php echo $employment_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DepartmentCode" class="form-group">
<?php $employment_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($employment_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->DepartmentCode->ReadOnly || $employment_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->DepartmentCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo $employment_list->DepartmentCode->CurrentValue ?>"<?php echo $employment_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DepartmentCode">
<span<?php echo $employment_list->DepartmentCode->viewAttributes() ?>><?php echo $employment_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $employment_list->SectionCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_list->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SectionCode" class="form-group">
<span<?php echo $employment_list->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_SectionCode" name="x<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_list->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SectionCode" class="form-group">
<?php $employment_list->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($employment_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SectionCode->ReadOnly || $employment_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SectionCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SectionCode" id="x<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo $employment_list->SectionCode->CurrentValue ?>"<?php echo $employment_list->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="o<?php echo $employment_list->RowIndex ?>_SectionCode" id="o<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_list->SectionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SectionCode" class="form-group">
<span<?php echo $employment_list->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_SectionCode" name="x<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_list->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SectionCode" class="form-group">
<?php $employment_list->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($employment_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SectionCode->ReadOnly || $employment_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SectionCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SectionCode" id="x<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo $employment_list->SectionCode->CurrentValue ?>"<?php echo $employment_list->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SectionCode">
<span<?php echo $employment_list->SectionCode->viewAttributes() ?>><?php echo $employment_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<td data-name="SubstantivePosition" <?php echo $employment_list->SubstantivePosition->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employment_list->SubstantivePosition->getSessionValue() != "") { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SubstantivePosition" class="form-group">
<span<?php echo $employment_list->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->SubstantivePosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" name="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_list->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SubstantivePosition" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SubstantivePosition"><?php echo EmptyValue(strval($employment_list->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SubstantivePosition->ReadOnly || $employment_list->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SubstantivePosition->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo $employment_list->SubstantivePosition->CurrentValue ?>"<?php echo $employment_list->SubstantivePosition->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o<?php echo $employment_list->RowIndex ?>_SubstantivePosition" id="o<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_list->SubstantivePosition->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employment_list->SubstantivePosition->getSessionValue() != "") { ?>

<span id="el<?php echo $employment_list->RowCount ?>_employment_SubstantivePosition" class="form-group">
<span<?php echo $employment_list->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->SubstantivePosition->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" name="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_list->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SubstantivePosition"><?php echo EmptyValue(strval($employment_list->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SubstantivePosition->ReadOnly || $employment_list->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SubstantivePosition->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo $employment_list->SubstantivePosition->CurrentValue ?>"<?php echo $employment_list->SubstantivePosition->editAttributes() ?>>
<?php } ?>

<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o<?php echo $employment_list->RowIndex ?>_SubstantivePosition" id="o<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_list->SubstantivePosition->OldValue != null ? $employment_list->SubstantivePosition->OldValue : $employment_list->SubstantivePosition->CurrentValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SubstantivePosition">
<span<?php echo $employment_list->SubstantivePosition->viewAttributes() ?>><?php echo $employment_list->SubstantivePosition->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td data-name="DateOfCurrentAppointment" <?php echo $employment_list->DateOfCurrentAppointment->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfCurrentAppointment" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_list->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_list->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_list->DateOfCurrentAppointment->ReadOnly && !$employment_list->DateOfCurrentAppointment->Disabled && !isset($employment_list->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_list->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="o<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" id="o<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_list->DateOfCurrentAppointment->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfCurrentAppointment" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_list->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_list->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_list->DateOfCurrentAppointment->ReadOnly && !$employment_list->DateOfCurrentAppointment->Disabled && !isset($employment_list->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_list->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfCurrentAppointment">
<span<?php echo $employment_list->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $employment_list->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
		<td data-name="LastAppraisalDate" <?php echo $employment_list->LastAppraisalDate->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LastAppraisalDate" class="form-group">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_list->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_list->LastAppraisalDate->EditValue ?>"<?php echo $employment_list->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_list->LastAppraisalDate->ReadOnly && !$employment_list->LastAppraisalDate->Disabled && !isset($employment_list->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_list->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="o<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" id="o<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_list->LastAppraisalDate->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LastAppraisalDate" class="form-group">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_list->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_list->LastAppraisalDate->EditValue ?>"<?php echo $employment_list->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_list->LastAppraisalDate->ReadOnly && !$employment_list->LastAppraisalDate->Disabled && !isset($employment_list->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_list->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_LastAppraisalDate">
<span<?php echo $employment_list->LastAppraisalDate->viewAttributes() ?>><?php echo $employment_list->LastAppraisalDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<td data-name="AppraisalStatus" <?php echo $employment_list->AppraisalStatus->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_AppraisalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_list->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_AppraisalStatus" name="x<?php echo $employment_list->RowIndex ?>_AppraisalStatus"<?php echo $employment_list->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_list->AppraisalStatus->selectOptionListHtml("x{$employment_list->RowIndex}_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_list->AppraisalStatus->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_AppraisalStatus") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="o<?php echo $employment_list->RowIndex ?>_AppraisalStatus" id="o<?php echo $employment_list->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_list->AppraisalStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_AppraisalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_list->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_AppraisalStatus" name="x<?php echo $employment_list->RowIndex ?>_AppraisalStatus"<?php echo $employment_list->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_list->AppraisalStatus->selectOptionListHtml("x{$employment_list->RowIndex}_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_list->AppraisalStatus->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_AppraisalStatus") ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_AppraisalStatus">
<span<?php echo $employment_list->AppraisalStatus->viewAttributes() ?>><?php echo $employment_list->AppraisalStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit" <?php echo $employment_list->DateOfExit->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfExit" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_list->RowIndex ?>_DateOfExit" id="x<?php echo $employment_list->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_list->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfExit->EditValue ?>"<?php echo $employment_list->DateOfExit->editAttributes() ?>>
<?php if (!$employment_list->DateOfExit->ReadOnly && !$employment_list->DateOfExit->Disabled && !isset($employment_list->DateOfExit->EditAttrs["readonly"]) && !isset($employment_list->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="o<?php echo $employment_list->RowIndex ?>_DateOfExit" id="o<?php echo $employment_list->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_list->DateOfExit->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfExit" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_list->RowIndex ?>_DateOfExit" id="x<?php echo $employment_list->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_list->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfExit->EditValue ?>"<?php echo $employment_list->DateOfExit->editAttributes() ?>>
<?php if (!$employment_list->DateOfExit->ReadOnly && !$employment_list->DateOfExit->Disabled && !isset($employment_list->DateOfExit->EditAttrs["readonly"]) && !isset($employment_list->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfExit">
<span<?php echo $employment_list->DateOfExit->viewAttributes() ?>><?php echo $employment_list->DateOfExit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType" <?php echo $employment_list->EmploymentType->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmploymentType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_list->EmploymentType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_EmploymentType" name="x<?php echo $employment_list->RowIndex ?>_EmploymentType"<?php echo $employment_list->EmploymentType->editAttributes() ?>>
			<?php echo $employment_list->EmploymentType->selectOptionListHtml("x{$employment_list->RowIndex}_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_list->EmploymentType->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_EmploymentType") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="o<?php echo $employment_list->RowIndex ?>_EmploymentType" id="o<?php echo $employment_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_list->EmploymentType->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmploymentType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_list->EmploymentType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_EmploymentType" name="x<?php echo $employment_list->RowIndex ?>_EmploymentType"<?php echo $employment_list->EmploymentType->editAttributes() ?>>
			<?php echo $employment_list->EmploymentType->selectOptionListHtml("x{$employment_list->RowIndex}_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_list->EmploymentType->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_EmploymentType") ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmploymentType">
<span<?php echo $employment_list->EmploymentType->viewAttributes() ?>><?php echo $employment_list->EmploymentType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus" <?php echo $employment_list->EmploymentStatus->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmploymentStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_list->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_EmploymentStatus" name="x<?php echo $employment_list->RowIndex ?>_EmploymentStatus"<?php echo $employment_list->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_list->EmploymentStatus->selectOptionListHtml("x{$employment_list->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_list->EmploymentStatus->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_EmploymentStatus") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="o<?php echo $employment_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_list->EmploymentStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmploymentStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_list->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_EmploymentStatus" name="x<?php echo $employment_list->RowIndex ?>_EmploymentStatus"<?php echo $employment_list->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_list->EmploymentStatus->selectOptionListHtml("x{$employment_list->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_list->EmploymentStatus->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_EmploymentStatus") ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmploymentStatus">
<span<?php echo $employment_list->EmploymentStatus->viewAttributes() ?>><?php echo $employment_list->EmploymentStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->EmployeeNumber->Visible) { // EmployeeNumber ?>
		<td data-name="EmployeeNumber" <?php echo $employment_list->EmployeeNumber->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmployeeNumber" class="form-group">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_list->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_list->RowIndex ?>_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_list->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_list->EmployeeNumber->EditValue ?>"<?php echo $employment_list->EmployeeNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="o<?php echo $employment_list->RowIndex ?>_EmployeeNumber" id="o<?php echo $employment_list->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_list->EmployeeNumber->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmployeeNumber" class="form-group">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_list->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_list->RowIndex ?>_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_list->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_list->EmployeeNumber->EditValue ?>"<?php echo $employment_list->EmployeeNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_EmployeeNumber">
<span<?php echo $employment_list->EmployeeNumber->viewAttributes() ?>><?php echo $employment_list->EmployeeNumber->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->SalaryNotch->Visible) { // SalaryNotch ?>
		<td data-name="SalaryNotch" <?php echo $employment_list->SalaryNotch->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SalaryNotch" class="form-group">
<?php $employment_list->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SalaryNotch"><?php echo EmptyValue(strval($employment_list->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SalaryNotch->ReadOnly || $employment_list->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SalaryNotch->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_list->RowIndex ?>_SalaryNotch" value="<?php echo $employment_list->SalaryNotch->CurrentValue ?>"<?php echo $employment_list->SalaryNotch->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="o<?php echo $employment_list->RowIndex ?>_SalaryNotch" id="o<?php echo $employment_list->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_list->SalaryNotch->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SalaryNotch" class="form-group">
<?php $employment_list->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SalaryNotch"><?php echo EmptyValue(strval($employment_list->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SalaryNotch->ReadOnly || $employment_list->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SalaryNotch->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_list->RowIndex ?>_SalaryNotch" value="<?php echo $employment_list->SalaryNotch->CurrentValue ?>"<?php echo $employment_list->SalaryNotch->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_SalaryNotch">
<span<?php echo $employment_list->SalaryNotch->viewAttributes() ?>><?php echo $employment_list->SalaryNotch->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary" <?php echo $employment_list->BasicMonthlySalary->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_BasicMonthlySalary" class="form-group">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_list->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_list->BasicMonthlySalary->EditValue ?>"<?php echo $employment_list->BasicMonthlySalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="o<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_list->BasicMonthlySalary->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_BasicMonthlySalary" class="form-group">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_list->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_list->BasicMonthlySalary->EditValue ?>"<?php echo $employment_list->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_BasicMonthlySalary">
<span<?php echo $employment_list->BasicMonthlySalary->viewAttributes() ?>><?php echo $employment_list->BasicMonthlySalary->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->ThirdParties->Visible) { // ThirdParties ?>
		<td data-name="ThirdParties" <?php echo $employment_list->ThirdParties->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ThirdParties" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($employment_list->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->ThirdParties->ReadOnly || $employment_list->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->ThirdParties->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_list->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_ThirdParties[]" id="x<?php echo $employment_list->RowIndex ?>_ThirdParties[]" value="<?php echo $employment_list->ThirdParties->CurrentValue ?>"<?php echo $employment_list->ThirdParties->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="o<?php echo $employment_list->RowIndex ?>_ThirdParties[]" id="o<?php echo $employment_list->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($employment_list->ThirdParties->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ThirdParties" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($employment_list->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->ThirdParties->ReadOnly || $employment_list->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->ThirdParties->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_list->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_ThirdParties[]" id="x<?php echo $employment_list->RowIndex ?>_ThirdParties[]" value="<?php echo $employment_list->ThirdParties->CurrentValue ?>"<?php echo $employment_list->ThirdParties->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_ThirdParties">
<span<?php echo $employment_list->ThirdParties->viewAttributes() ?>><?php echo $employment_list->ThirdParties->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode" <?php echo $employment_list->PayrollCode->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_PayrollCode" class="form-group">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_list->RowIndex ?>_PayrollCode" id="x<?php echo $employment_list->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_list->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_list->PayrollCode->EditValue ?>"<?php echo $employment_list->PayrollCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="o<?php echo $employment_list->RowIndex ?>_PayrollCode" id="o<?php echo $employment_list->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_list->PayrollCode->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_PayrollCode" class="form-group">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_list->RowIndex ?>_PayrollCode" id="x<?php echo $employment_list->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_list->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_list->PayrollCode->EditValue ?>"<?php echo $employment_list->PayrollCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_PayrollCode">
<span<?php echo $employment_list->PayrollCode->viewAttributes() ?>><?php echo $employment_list->PayrollCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_list->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<td data-name="DateOfConfirmation" <?php echo $employment_list->DateOfConfirmation->cellAttributes() ?>>
<?php if ($employment->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfConfirmation" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_list->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfConfirmation->EditValue ?>"<?php echo $employment_list->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_list->DateOfConfirmation->ReadOnly && !$employment_list->DateOfConfirmation->Disabled && !isset($employment_list->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_list->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="o<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" id="o<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_list->DateOfConfirmation->OldValue) ?>">
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfConfirmation" class="form-group">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_list->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfConfirmation->EditValue ?>"<?php echo $employment_list->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_list->DateOfConfirmation->ReadOnly && !$employment_list->DateOfConfirmation->Disabled && !isset($employment_list->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_list->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_list->RowCount ?>_employment_DateOfConfirmation">
<span<?php echo $employment_list->DateOfConfirmation->viewAttributes() ?>><?php echo $employment_list->DateOfConfirmation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_list->ListOptions->render("body", "right", $employment_list->RowCount);
?>
	</tr>
<?php if ($employment->RowType == ROWTYPE_ADD || $employment->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femploymentlist", "load"], function() {
	femploymentlist.updateLists(<?php echo $employment_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employment_list->isGridAdd())
		if (!$employment_list->Recordset->EOF)
			$employment_list->Recordset->moveNext();
}
?>
<?php
	if ($employment_list->isGridAdd() || $employment_list->isGridEdit()) {
		$employment_list->RowIndex = '$rowindex$';
		$employment_list->loadRowValues();

		// Set row properties
		$employment->resetAttributes();
		$employment->RowAttrs->merge(["data-rowindex" => $employment_list->RowIndex, "id" => "r0_employment", "data-rowtype" => ROWTYPE_ADD]);
		$employment->RowAttrs->appendClass("ew-template");
		$employment->RowType = ROWTYPE_ADD;

		// Render row
		$employment_list->renderRow();

		// Render list options
		$employment_list->renderListOptions();
		$employment_list->StartRowCount = 0;
?>
	<tr <?php echo $employment->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_list->ListOptions->render("body", "left", $employment_list->RowIndex);
?>
	<?php if ($employment_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if ($employment_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_ProvinceCode" class="form-group employment_ProvinceCode">
<span<?php echo $employment_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_ProvinceCode" class="form-group employment_ProvinceCode">
<?php $employment_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_ProvinceCode" name="x<?php echo $employment_list->RowIndex ?>_ProvinceCode"<?php echo $employment_list->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_list->ProvinceCode->selectOptionListHtml("x{$employment_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_list->ProvinceCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_ProvinceCode" name="o<?php echo $employment_list->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($employment_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_LACode" class="form-group employment_LACode">
<span<?php echo $employment_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_LACode" name="x<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_LACode" class="form-group employment_LACode">
<?php $employment_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($employment_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->LACode->ReadOnly || $employment_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->LACode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_LACode" id="x<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo $employment_list->LACode->CurrentValue ?>"<?php echo $employment_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_LACode" name="o<?php echo $employment_list->RowIndex ?>_LACode" id="o<?php echo $employment_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if ($employment_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_DepartmentCode" class="form-group employment_DepartmentCode">
<span<?php echo $employment_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_DepartmentCode" class="form-group employment_DepartmentCode">
<?php $employment_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($employment_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->DepartmentCode->ReadOnly || $employment_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->DepartmentCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo $employment_list->DepartmentCode->CurrentValue ?>"<?php echo $employment_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" name="o<?php echo $employment_list->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if ($employment_list->SectionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_SectionCode" class="form-group employment_SectionCode">
<span<?php echo $employment_list->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_SectionCode" name="x<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_list->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_SectionCode" class="form-group employment_SectionCode">
<?php $employment_list->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($employment_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SectionCode->ReadOnly || $employment_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SectionCode->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SectionCode" id="x<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo $employment_list->SectionCode->CurrentValue ?>"<?php echo $employment_list->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" name="o<?php echo $employment_list->RowIndex ?>_SectionCode" id="o<?php echo $employment_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<td data-name="SubstantivePosition">
<?php if ($employment_list->SubstantivePosition->getSessionValue() != "") { ?>
<span id="el$rowindex$_employment_SubstantivePosition" class="form-group employment_SubstantivePosition">
<span<?php echo $employment_list->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_list->SubstantivePosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" name="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_list->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employment_SubstantivePosition" class="form-group employment_SubstantivePosition">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SubstantivePosition"><?php echo EmptyValue(strval($employment_list->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SubstantivePosition->ReadOnly || $employment_list->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SubstantivePosition->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" id="x<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo $employment_list->SubstantivePosition->CurrentValue ?>"<?php echo $employment_list->SubstantivePosition->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o<?php echo $employment_list->RowIndex ?>_SubstantivePosition" id="o<?php echo $employment_list->RowIndex ?>_SubstantivePosition" value="<?php echo HtmlEncode($employment_list->SubstantivePosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td data-name="DateOfCurrentAppointment">
<span id="el$rowindex$_employment_DateOfCurrentAppointment" class="form-group employment_DateOfCurrentAppointment">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" id="x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_list->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_list->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_list->DateOfCurrentAppointment->ReadOnly && !$employment_list->DateOfCurrentAppointment->Disabled && !isset($employment_list->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_list->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfCurrentAppointment" name="o<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" id="o<?php echo $employment_list->RowIndex ?>_DateOfCurrentAppointment" value="<?php echo HtmlEncode($employment_list->DateOfCurrentAppointment->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
		<td data-name="LastAppraisalDate">
<span id="el$rowindex$_employment_LastAppraisalDate" class="form-group employment_LastAppraisalDate">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" id="x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_list->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_list->LastAppraisalDate->EditValue ?>"<?php echo $employment_list->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_list->LastAppraisalDate->ReadOnly && !$employment_list->LastAppraisalDate->Disabled && !isset($employment_list->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_list->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_LastAppraisalDate" name="o<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" id="o<?php echo $employment_list->RowIndex ?>_LastAppraisalDate" value="<?php echo HtmlEncode($employment_list->LastAppraisalDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<td data-name="AppraisalStatus">
<span id="el$rowindex$_employment_AppraisalStatus" class="form-group employment_AppraisalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_list->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_AppraisalStatus" name="x<?php echo $employment_list->RowIndex ?>_AppraisalStatus"<?php echo $employment_list->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_list->AppraisalStatus->selectOptionListHtml("x{$employment_list->RowIndex}_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_list->AppraisalStatus->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_AppraisalStatus") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_AppraisalStatus" name="o<?php echo $employment_list->RowIndex ?>_AppraisalStatus" id="o<?php echo $employment_list->RowIndex ?>_AppraisalStatus" value="<?php echo HtmlEncode($employment_list->AppraisalStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit">
<span id="el$rowindex$_employment_DateOfExit" class="form-group employment_DateOfExit">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x<?php echo $employment_list->RowIndex ?>_DateOfExit" id="x<?php echo $employment_list->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_list->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfExit->EditValue ?>"<?php echo $employment_list->DateOfExit->editAttributes() ?>>
<?php if (!$employment_list->DateOfExit->ReadOnly && !$employment_list->DateOfExit->Disabled && !isset($employment_list->DateOfExit->EditAttrs["readonly"]) && !isset($employment_list->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfExit" name="o<?php echo $employment_list->RowIndex ?>_DateOfExit" id="o<?php echo $employment_list->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_list->DateOfExit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType">
<span id="el$rowindex$_employment_EmploymentType" class="form-group employment_EmploymentType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_list->EmploymentType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_EmploymentType" name="x<?php echo $employment_list->RowIndex ?>_EmploymentType"<?php echo $employment_list->EmploymentType->editAttributes() ?>>
			<?php echo $employment_list->EmploymentType->selectOptionListHtml("x{$employment_list->RowIndex}_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_list->EmploymentType->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_EmploymentType") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentType" name="o<?php echo $employment_list->RowIndex ?>_EmploymentType" id="o<?php echo $employment_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_list->EmploymentType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus">
<span id="el$rowindex$_employment_EmploymentStatus" class="form-group employment_EmploymentStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_list->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_list->RowIndex ?>_EmploymentStatus" name="x<?php echo $employment_list->RowIndex ?>_EmploymentStatus"<?php echo $employment_list->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_list->EmploymentStatus->selectOptionListHtml("x{$employment_list->RowIndex}_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_list->EmploymentStatus->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_EmploymentStatus") ?>
</span>
<input type="hidden" data-table="employment" data-field="x_EmploymentStatus" name="o<?php echo $employment_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_list->EmploymentStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->EmployeeNumber->Visible) { // EmployeeNumber ?>
		<td data-name="EmployeeNumber">
<span id="el$rowindex$_employment_EmployeeNumber" class="form-group employment_EmployeeNumber">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x<?php echo $employment_list->RowIndex ?>_EmployeeNumber" id="x<?php echo $employment_list->RowIndex ?>_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_list->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_list->EmployeeNumber->EditValue ?>"<?php echo $employment_list->EmployeeNumber->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_EmployeeNumber" name="o<?php echo $employment_list->RowIndex ?>_EmployeeNumber" id="o<?php echo $employment_list->RowIndex ?>_EmployeeNumber" value="<?php echo HtmlEncode($employment_list->EmployeeNumber->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->SalaryNotch->Visible) { // SalaryNotch ?>
		<td data-name="SalaryNotch">
<span id="el$rowindex$_employment_SalaryNotch" class="form-group employment_SalaryNotch">
<?php $employment_list->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_SalaryNotch"><?php echo EmptyValue(strval($employment_list->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->SalaryNotch->ReadOnly || $employment_list->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->SalaryNotch->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_list->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_SalaryNotch" id="x<?php echo $employment_list->RowIndex ?>_SalaryNotch" value="<?php echo $employment_list->SalaryNotch->CurrentValue ?>"<?php echo $employment_list->SalaryNotch->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" name="o<?php echo $employment_list->RowIndex ?>_SalaryNotch" id="o<?php echo $employment_list->RowIndex ?>_SalaryNotch" value="<?php echo HtmlEncode($employment_list->SalaryNotch->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<td data-name="BasicMonthlySalary">
<span id="el$rowindex$_employment_BasicMonthlySalary" class="form-group employment_BasicMonthlySalary">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" id="x<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_list->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_list->BasicMonthlySalary->EditValue ?>"<?php echo $employment_list->BasicMonthlySalary->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_BasicMonthlySalary" name="o<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" id="o<?php echo $employment_list->RowIndex ?>_BasicMonthlySalary" value="<?php echo HtmlEncode($employment_list->BasicMonthlySalary->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->ThirdParties->Visible) { // ThirdParties ?>
		<td data-name="ThirdParties">
<span id="el$rowindex$_employment_ThirdParties" class="form-group employment_ThirdParties">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employment_list->RowIndex ?>_ThirdParties"><?php echo EmptyValue(strval($employment_list->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_list->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_list->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_list->ThirdParties->ReadOnly || $employment_list->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employment_list->RowIndex ?>_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_list->ThirdParties->Lookup->getParamTag($employment_list, "p_x" . $employment_list->RowIndex . "_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_list->ThirdParties->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_list->RowIndex ?>_ThirdParties[]" id="x<?php echo $employment_list->RowIndex ?>_ThirdParties[]" value="<?php echo $employment_list->ThirdParties->CurrentValue ?>"<?php echo $employment_list->ThirdParties->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" name="o<?php echo $employment_list->RowIndex ?>_ThirdParties[]" id="o<?php echo $employment_list->RowIndex ?>_ThirdParties[]" value="<?php echo HtmlEncode($employment_list->ThirdParties->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode">
<span id="el$rowindex$_employment_PayrollCode" class="form-group employment_PayrollCode">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x<?php echo $employment_list->RowIndex ?>_PayrollCode" id="x<?php echo $employment_list->RowIndex ?>_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_list->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_list->PayrollCode->EditValue ?>"<?php echo $employment_list->PayrollCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment" data-field="x_PayrollCode" name="o<?php echo $employment_list->RowIndex ?>_PayrollCode" id="o<?php echo $employment_list->RowIndex ?>_PayrollCode" value="<?php echo HtmlEncode($employment_list->PayrollCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_list->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<td data-name="DateOfConfirmation">
<span id="el$rowindex$_employment_DateOfConfirmation" class="form-group employment_DateOfConfirmation">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" id="x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_list->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_list->DateOfConfirmation->EditValue ?>"<?php echo $employment_list->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_list->DateOfConfirmation->ReadOnly && !$employment_list->DateOfConfirmation->Disabled && !isset($employment_list->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_list->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentlist", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentlist", "x<?php echo $employment_list->RowIndex ?>_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment" data-field="x_DateOfConfirmation" name="o<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" id="o<?php echo $employment_list->RowIndex ?>_DateOfConfirmation" value="<?php echo HtmlEncode($employment_list->DateOfConfirmation->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_list->ListOptions->render("body", "right", $employment_list->RowIndex);
?>
<script>
loadjs.ready(["femploymentlist", "load"], function() {
	femploymentlist.updateLists(<?php echo $employment_list->RowIndex ?>);
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
<?php if ($employment_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employment_list->FormKeyCountName ?>" id="<?php echo $employment_list->FormKeyCountName ?>" value="<?php echo $employment_list->KeyCount ?>">
<?php echo $employment_list->MultiSelectKey ?>
<?php } ?>
<?php if ($employment_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $employment_list->FormKeyCountName ?>" id="<?php echo $employment_list->FormKeyCountName ?>" value="<?php echo $employment_list->KeyCount ?>">
<?php echo $employment_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employment->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employment_list->Recordset)
	$employment_list->Recordset->Close();
?>
<?php if (!$employment_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employment_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employment_list->TotalRecords == 0 && !$employment->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employment_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employment_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_list->isExport()) { ?>
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
$employment_list->terminate();
?>