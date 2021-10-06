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
$employee_income_list = new employee_income_list();

// Run the page
$employee_income_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_income_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_income_list->isExport()) { ?>
<script>
var femployee_incomelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployee_incomelist = currentForm = new ew.Form("femployee_incomelist", "list");
	femployee_incomelist.formKeyCountName = '<?php echo $employee_income_list->FormKeyCountName ?>';

	// Validate form
	femployee_incomelist.validate = function() {
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
			<?php if ($employee_income_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->EmployeeID->caption(), $employee_income_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_income_list->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->PaidPosition->caption(), $employee_income_list->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_income_list->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->PayrollDate->caption(), $employee_income_list->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_income_list->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->PayrollPeriod->caption(), $employee_income_list->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_income_list->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->StartDate->caption(), $employee_income_list->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->StartDate->errorMessage()) ?>");
			<?php if ($employee_income_list->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->EndDate->caption(), $employee_income_list->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->EndDate->errorMessage()) ?>");
			<?php if ($employee_income_list->IncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->IncomeCode->caption(), $employee_income_list->IncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_list->Income->Required) { ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->Income->caption(), $employee_income_list->Income->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Income");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->Income->errorMessage()) ?>");
			<?php if ($employee_income_list->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->Remarks->caption(), $employee_income_list->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_income_list->Taxable->Required) { ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_income_list->Taxable->caption(), $employee_income_list->Taxable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_income_list->Taxable->errorMessage()) ?>");

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
	femployee_incomelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaidPosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "IncomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Income", false)) return false;
		if (ew.valueChanged(fobj, infix, "Remarks", false)) return false;
		if (ew.valueChanged(fobj, infix, "Taxable", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployee_incomelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_incomelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_incomelist.lists["x_PaidPosition"] = <?php echo $employee_income_list->PaidPosition->Lookup->toClientList($employee_income_list) ?>;
	femployee_incomelist.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_income_list->PaidPosition->lookupOptions()) ?>;
	femployee_incomelist.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployee_incomelist.lists["x_IncomeCode"] = <?php echo $employee_income_list->IncomeCode->Lookup->toClientList($employee_income_list) ?>;
	femployee_incomelist.lists["x_IncomeCode"].options = <?php echo JsonEncode($employee_income_list->IncomeCode->lookupOptions()) ?>;
	loadjs.done("femployee_incomelist");
});
var femployee_incomelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployee_incomelistsrch = currentSearchForm = new ew.Form("femployee_incomelistsrch");

	// Validate function for search
	femployee_incomelistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_list->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PaidPosition");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employee_income_list->PaidPosition->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployee_incomelistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_incomelistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_incomelistsrch.lists["x_PaidPosition"] = <?php echo $employee_income_list->PaidPosition->Lookup->toClientList($employee_income_list) ?>;
	femployee_incomelistsrch.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_income_list->PaidPosition->lookupOptions()) ?>;
	femployee_incomelistsrch.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployee_incomelistsrch.lists["x_IncomeCode"] = <?php echo $employee_income_list->IncomeCode->Lookup->toClientList($employee_income_list) ?>;
	femployee_incomelistsrch.lists["x_IncomeCode"].options = <?php echo JsonEncode($employee_income_list->IncomeCode->lookupOptions()) ?>;

	// Filters
	femployee_incomelistsrch.filterList = <?php echo $employee_income_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployee_incomelistsrch.initSearchPanel = true;
	loadjs.done("femployee_incomelistsrch");
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
<?php if (!$employee_income_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employee_income_list->TotalRecords > 0 && $employee_income_list->ExportOptions->visible()) { ?>
<?php $employee_income_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_income_list->ImportOptions->visible()) { ?>
<?php $employee_income_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_income_list->SearchOptions->visible()) { ?>
<?php $employee_income_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employee_income_list->FilterOptions->visible()) { ?>
<?php $employee_income_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$employee_income_list->isExport() || Config("EXPORT_MASTER_RECORD") && $employee_income_list->isExport("print")) { ?>
<?php
if ($employee_income_list->DbMasterFilter != "" && $employee_income->getCurrentMasterTable() == "employment") {
	if ($employee_income_list->MasterRecordExists) {
		include_once "employmentmaster.php";
	}
}
?>
<?php } ?>
<?php
$employee_income_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employee_income_list->isExport() && !$employee_income->CurrentAction) { ?>
<form name="femployee_incomelistsrch" id="femployee_incomelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployee_incomelistsrch-search-panel" class="<?php echo $employee_income_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employee_income">
	<div class="ew-extended-search">
<?php

// Render search row
$employee_income->RowType = ROWTYPE_SEARCH;
$employee_income->resetAttributes();
$employee_income_list->renderRow();
?>
<?php if ($employee_income_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php
		$employee_income_list->SearchColumnCount++;
		if (($employee_income_list->SearchColumnCount - 1) % $employee_income_list->SearchFieldsPerRow == 0) {
			$employee_income_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_income_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_EmployeeID" class="ew-cell form-group">
		<label for="x_EmployeeID" class="ew-search-caption ew-label"><?php echo $employee_income_list->EmployeeID->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		<span id="el_employee_income_EmployeeID" class="ew-search-field">
<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->EmployeeID->EditValue ?>"<?php echo $employee_income_list->EmployeeID->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_income_list->SearchColumnCount % $employee_income_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->PaidPosition->Visible) { // PaidPosition ?>
	<?php
		$employee_income_list->SearchColumnCount++;
		if (($employee_income_list->SearchColumnCount - 1) % $employee_income_list->SearchFieldsPerRow == 0) {
			$employee_income_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_income_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PaidPosition" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $employee_income_list->PaidPosition->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PaidPosition" id="z_PaidPosition" value="=">
</span>
		<span id="el_employee_income_PaidPosition" class="ew-search-field">
<?php
$onchange = $employee_income_list->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_list->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaidPosition">
	<input type="text" class="form-control" name="sv_x_PaidPosition" id="sv_x_PaidPosition" value="<?php echo RemoveHtml($employee_income_list->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_list->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_list->PaidPosition->displayValueSeparatorAttribute() ?>" name="x_PaidPosition" id="x_PaidPosition" value="<?php echo HtmlEncode($employee_income_list->PaidPosition->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomelistsrch"], function() {
	femployee_incomelistsrch.createAutoSuggest({"id":"x_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_list->PaidPosition->Lookup->getParamTag($employee_income_list, "p_x_PaidPosition") ?>
</span>
	</div>
	<?php if ($employee_income_list->SearchColumnCount % $employee_income_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->IncomeCode->Visible) { // IncomeCode ?>
	<?php
		$employee_income_list->SearchColumnCount++;
		if (($employee_income_list->SearchColumnCount - 1) % $employee_income_list->SearchFieldsPerRow == 0) {
			$employee_income_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $employee_income_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_IncomeCode" class="ew-cell form-group">
		<label for="x_IncomeCode" class="ew-search-caption ew-label"><?php echo $employee_income_list->IncomeCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_IncomeCode" id="z_IncomeCode" value="LIKE">
</span>
		<span id="el_employee_income_IncomeCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_IncomeCode"><?php echo EmptyValue(strval($employee_income_list->IncomeCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_list->IncomeCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_list->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_list->IncomeCode->ReadOnly || $employee_income_list->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_list->IncomeCode->Lookup->getParamTag($employee_income_list, "p_x_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_list->IncomeCode->displayValueSeparatorAttribute() ?>" name="x_IncomeCode" id="x_IncomeCode" value="<?php echo $employee_income_list->IncomeCode->AdvancedSearch->SearchValue ?>"<?php echo $employee_income_list->IncomeCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($employee_income_list->SearchColumnCount % $employee_income_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($employee_income_list->SearchColumnCount % $employee_income_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $employee_income_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employee_income_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employee_income_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employee_income_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employee_income_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employee_income_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employee_income_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employee_income_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employee_income_list->showPageHeader(); ?>
<?php
$employee_income_list->showMessage();
?>
<?php if ($employee_income_list->TotalRecords > 0 || $employee_income->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_income_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee_income">
<?php if (!$employee_income_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employee_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployee_incomelist" id="femployee_incomelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_income">
<?php if ($employee_income->getCurrentMasterTable() == "employment" && $employee_income->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employee_income_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_employee_income" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employee_income_list->TotalRecords > 0 || $employee_income_list->isGridEdit()) { ?>
<table id="tbl_employee_incomelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee_income->RowType = ROWTYPE_HEADER;

// Render list options
$employee_income_list->renderListOptions();

// Render list options (header, left)
$employee_income_list->ListOptions->render("header", "left");
?>
<?php if ($employee_income_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_income_list->EmployeeID->headerCellClass() ?>"><div id="elh_employee_income_EmployeeID" class="employee_income_EmployeeID"><div class="ew-table-header-caption"><?php echo $employee_income_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_income_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->EmployeeID) ?>', 1);"><div id="elh_employee_income_EmployeeID" class="employee_income_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->PaidPosition->Visible) { // PaidPosition ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->PaidPosition) == "") { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_income_list->PaidPosition->headerCellClass() ?>"><div id="elh_employee_income_PaidPosition" class="employee_income_PaidPosition"><div class="ew-table-header-caption"><?php echo $employee_income_list->PaidPosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaidPosition" class="<?php echo $employee_income_list->PaidPosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->PaidPosition) ?>', 1);"><div id="elh_employee_income_PaidPosition" class="employee_income_PaidPosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->PaidPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->PaidPosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->PaidPosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_income_list->PayrollDate->headerCellClass() ?>"><div id="elh_employee_income_PayrollDate" class="employee_income_PayrollDate"><div class="ew-table-header-caption"><?php echo $employee_income_list->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $employee_income_list->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->PayrollDate) ?>', 1);"><div id="elh_employee_income_PayrollDate" class="employee_income_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_income_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_employee_income_PayrollPeriod" class="employee_income_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $employee_income_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employee_income_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->PayrollPeriod) ?>', 1);"><div id="elh_employee_income_PayrollPeriod" class="employee_income_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->StartDate->Visible) { // StartDate ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $employee_income_list->StartDate->headerCellClass() ?>"><div id="elh_employee_income_StartDate" class="employee_income_StartDate"><div class="ew-table-header-caption"><?php echo $employee_income_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $employee_income_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->StartDate) ?>', 1);"><div id="elh_employee_income_StartDate" class="employee_income_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->EndDate->Visible) { // EndDate ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $employee_income_list->EndDate->headerCellClass() ?>"><div id="elh_employee_income_EndDate" class="employee_income_EndDate"><div class="ew-table-header-caption"><?php echo $employee_income_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $employee_income_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->EndDate) ?>', 1);"><div id="elh_employee_income_EndDate" class="employee_income_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->IncomeCode) == "") { ?>
		<th data-name="IncomeCode" class="<?php echo $employee_income_list->IncomeCode->headerCellClass() ?>"><div id="elh_employee_income_IncomeCode" class="employee_income_IncomeCode"><div class="ew-table-header-caption"><?php echo $employee_income_list->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeCode" class="<?php echo $employee_income_list->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->IncomeCode) ?>', 1);"><div id="elh_employee_income_IncomeCode" class="employee_income_IncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->IncomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->Income->Visible) { // Income ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->Income) == "") { ?>
		<th data-name="Income" class="<?php echo $employee_income_list->Income->headerCellClass() ?>"><div id="elh_employee_income_Income" class="employee_income_Income"><div class="ew-table-header-caption"><?php echo $employee_income_list->Income->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Income" class="<?php echo $employee_income_list->Income->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->Income) ?>', 1);"><div id="elh_employee_income_Income" class="employee_income_Income">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->Income->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->Income->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->Remarks->Visible) { // Remarks ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $employee_income_list->Remarks->headerCellClass() ?>"><div id="elh_employee_income_Remarks" class="employee_income_Remarks"><div class="ew-table-header-caption"><?php echo $employee_income_list->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $employee_income_list->Remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->Remarks) ?>', 1);"><div id="elh_employee_income_Remarks" class="employee_income_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->Remarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_income_list->Taxable->Visible) { // Taxable ?>
	<?php if ($employee_income_list->SortUrl($employee_income_list->Taxable) == "") { ?>
		<th data-name="Taxable" class="<?php echo $employee_income_list->Taxable->headerCellClass() ?>"><div id="elh_employee_income_Taxable" class="employee_income_Taxable"><div class="ew-table-header-caption"><?php echo $employee_income_list->Taxable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Taxable" class="<?php echo $employee_income_list->Taxable->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_income_list->SortUrl($employee_income_list->Taxable) ?>', 1);"><div id="elh_employee_income_Taxable" class="employee_income_Taxable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_income_list->Taxable->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_income_list->Taxable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_income_list->Taxable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_income_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employee_income_list->ExportAll && $employee_income_list->isExport()) {
	$employee_income_list->StopRecord = $employee_income_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employee_income_list->TotalRecords > $employee_income_list->StartRecord + $employee_income_list->DisplayRecords - 1)
		$employee_income_list->StopRecord = $employee_income_list->StartRecord + $employee_income_list->DisplayRecords - 1;
	else
		$employee_income_list->StopRecord = $employee_income_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employee_income->isConfirm() || $employee_income_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employee_income_list->FormKeyCountName) && ($employee_income_list->isGridAdd() || $employee_income_list->isGridEdit() || $employee_income->isConfirm())) {
		$employee_income_list->KeyCount = $CurrentForm->getValue($employee_income_list->FormKeyCountName);
		$employee_income_list->StopRecord = $employee_income_list->StartRecord + $employee_income_list->KeyCount - 1;
	}
}
$employee_income_list->RecordCount = $employee_income_list->StartRecord - 1;
if ($employee_income_list->Recordset && !$employee_income_list->Recordset->EOF) {
	$employee_income_list->Recordset->moveFirst();
	$selectLimit = $employee_income_list->UseSelectLimit;
	if (!$selectLimit && $employee_income_list->StartRecord > 1)
		$employee_income_list->Recordset->move($employee_income_list->StartRecord - 1);
} elseif (!$employee_income->AllowAddDeleteRow && $employee_income_list->StopRecord == 0) {
	$employee_income_list->StopRecord = $employee_income->GridAddRowCount;
}

// Initialize aggregate
$employee_income->RowType = ROWTYPE_AGGREGATEINIT;
$employee_income->resetAttributes();
$employee_income_list->renderRow();
if ($employee_income_list->isGridAdd())
	$employee_income_list->RowIndex = 0;
if ($employee_income_list->isGridEdit())
	$employee_income_list->RowIndex = 0;
while ($employee_income_list->RecordCount < $employee_income_list->StopRecord) {
	$employee_income_list->RecordCount++;
	if ($employee_income_list->RecordCount >= $employee_income_list->StartRecord) {
		$employee_income_list->RowCount++;
		if ($employee_income_list->isGridAdd() || $employee_income_list->isGridEdit() || $employee_income->isConfirm()) {
			$employee_income_list->RowIndex++;
			$CurrentForm->Index = $employee_income_list->RowIndex;
			if ($CurrentForm->hasValue($employee_income_list->FormActionName) && ($employee_income->isConfirm() || $employee_income_list->EventCancelled))
				$employee_income_list->RowAction = strval($CurrentForm->getValue($employee_income_list->FormActionName));
			elseif ($employee_income_list->isGridAdd())
				$employee_income_list->RowAction = "insert";
			else
				$employee_income_list->RowAction = "";
		}

		// Set up key count
		$employee_income_list->KeyCount = $employee_income_list->RowIndex;

		// Init row class and style
		$employee_income->resetAttributes();
		$employee_income->CssClass = "";
		if ($employee_income_list->isGridAdd()) {
			$employee_income_list->loadRowValues(); // Load default values
		} else {
			$employee_income_list->loadRowValues($employee_income_list->Recordset); // Load row values
		}
		$employee_income->RowType = ROWTYPE_VIEW; // Render view
		if ($employee_income_list->isGridAdd()) // Grid add
			$employee_income->RowType = ROWTYPE_ADD; // Render add
		if ($employee_income_list->isGridAdd() && $employee_income->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employee_income_list->restoreCurrentRowFormValues($employee_income_list->RowIndex); // Restore form values
		if ($employee_income_list->isGridEdit()) { // Grid edit
			if ($employee_income->EventCancelled)
				$employee_income_list->restoreCurrentRowFormValues($employee_income_list->RowIndex); // Restore form values
			if ($employee_income_list->RowAction == "insert")
				$employee_income->RowType = ROWTYPE_ADD; // Render add
			else
				$employee_income->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employee_income_list->isGridEdit() && ($employee_income->RowType == ROWTYPE_EDIT || $employee_income->RowType == ROWTYPE_ADD) && $employee_income->EventCancelled) // Update failed
			$employee_income_list->restoreCurrentRowFormValues($employee_income_list->RowIndex); // Restore form values
		if ($employee_income->RowType == ROWTYPE_EDIT) // Edit row
			$employee_income_list->EditRowCount++;

		// Set up row id / data-rowindex
		$employee_income->RowAttrs->merge(["data-rowindex" => $employee_income_list->RowCount, "id" => "r" . $employee_income_list->RowCount . "_employee_income", "data-rowtype" => $employee_income->RowType]);

		// Render row
		$employee_income_list->renderRow();

		// Render list options
		$employee_income_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employee_income_list->RowAction != "delete" && $employee_income_list->RowAction != "insertdelete" && !($employee_income_list->RowAction == "insert" && $employee_income->isConfirm() && $employee_income_list->emptyRow())) {
?>
	<tr <?php echo $employee_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_income_list->ListOptions->render("body", "left", $employee_income_list->RowCount);
?>
	<?php if ($employee_income_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employee_income_list->EmployeeID->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($employee_income_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_EmployeeID" class="form-group">
<span<?php echo $employee_income_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" name="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_EmployeeID" class="form-group">
<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->EmployeeID->EditValue ?>"<?php echo $employee_income_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o<?php echo $employee_income_list->RowIndex ?>_EmployeeID" id="o<?php echo $employee_income_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($employee_income_list->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_EmployeeID" class="form-group">
<span<?php echo $employee_income_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_list->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" name="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->EmployeeID->EditValue ?>"<?php echo $employee_income_list->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o<?php echo $employee_income_list->RowIndex ?>_EmployeeID" id="o<?php echo $employee_income_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_list->EmployeeID->OldValue != null ? $employee_income_list->EmployeeID->OldValue : $employee_income_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_EmployeeID">
<span<?php echo $employee_income_list->EmployeeID->viewAttributes() ?>><?php echo $employee_income_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition" <?php echo $employee_income_list->PaidPosition->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PaidPosition" class="form-group">
<?php
$onchange = $employee_income_list->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_list->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_income_list->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_list->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_list->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_list->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomelist"], function() {
	femployee_incomelist.createAutoSuggest({"id":"x<?php echo $employee_income_list->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_list->PaidPosition->Lookup->getParamTag($employee_income_list, "p_x" . $employee_income_list->RowIndex . "_PaidPosition") ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="o<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="o<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_list->PaidPosition->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PaidPosition" class="form-group">
<?php
$onchange = $employee_income_list->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_list->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_income_list->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_list->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_list->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_list->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomelist"], function() {
	femployee_incomelist.createAutoSuggest({"id":"x<?php echo $employee_income_list->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_list->PaidPosition->Lookup->getParamTag($employee_income_list, "p_x" . $employee_income_list->RowIndex . "_PaidPosition") ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PaidPosition">
<span<?php echo $employee_income_list->PaidPosition->viewAttributes() ?>><?php echo $employee_income_list->PaidPosition->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $employee_income_list->PayrollDate->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PayrollDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_list->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_list->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->PayrollDate->EditValue ?>"<?php echo $employee_income_list->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_list->PayrollDate->ReadOnly && !$employee_income_list->PayrollDate->Disabled && !isset($employee_income_list->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="o<?php echo $employee_income_list->RowIndex ?>_PayrollDate" id="o<?php echo $employee_income_list->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_list->PayrollDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PayrollDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_list->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_list->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->PayrollDate->EditValue ?>"<?php echo $employee_income_list->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_list->PayrollDate->ReadOnly && !$employee_income_list->PayrollDate->Disabled && !isset($employee_income_list->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PayrollDate">
<span<?php echo $employee_income_list->PayrollDate->viewAttributes() ?>><?php echo $employee_income_list->PayrollDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $employee_income_list->PayrollPeriod->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PayrollPeriod" class="form-group">
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->PayrollPeriod->EditValue ?>"<?php echo $employee_income_list->PayrollPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_list->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->PayrollPeriod->EditValue ?>"<?php echo $employee_income_list->PayrollPeriod->editAttributes() ?>>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_list->PayrollPeriod->OldValue != null ? $employee_income_list->PayrollPeriod->OldValue : $employee_income_list->PayrollPeriod->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_PayrollPeriod">
<span<?php echo $employee_income_list->PayrollPeriod->viewAttributes() ?>><?php echo $employee_income_list->PayrollPeriod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $employee_income_list->StartDate->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_StartDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_list->RowIndex ?>_StartDate" id="x<?php echo $employee_income_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_income_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->StartDate->EditValue ?>"<?php echo $employee_income_list->StartDate->editAttributes() ?>>
<?php if (!$employee_income_list->StartDate->ReadOnly && !$employee_income_list->StartDate->Disabled && !isset($employee_income_list->StartDate->EditAttrs["readonly"]) && !isset($employee_income_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="o<?php echo $employee_income_list->RowIndex ?>_StartDate" id="o<?php echo $employee_income_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_list->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_StartDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_list->RowIndex ?>_StartDate" id="x<?php echo $employee_income_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_income_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->StartDate->EditValue ?>"<?php echo $employee_income_list->StartDate->editAttributes() ?>>
<?php if (!$employee_income_list->StartDate->ReadOnly && !$employee_income_list->StartDate->Disabled && !isset($employee_income_list->StartDate->EditAttrs["readonly"]) && !isset($employee_income_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_StartDate">
<span<?php echo $employee_income_list->StartDate->viewAttributes() ?>><?php echo $employee_income_list->StartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $employee_income_list->EndDate->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_EndDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_list->RowIndex ?>_EndDate" id="x<?php echo $employee_income_list->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($employee_income_list->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->EndDate->EditValue ?>"<?php echo $employee_income_list->EndDate->editAttributes() ?>>
<?php if (!$employee_income_list->EndDate->ReadOnly && !$employee_income_list->EndDate->Disabled && !isset($employee_income_list->EndDate->EditAttrs["readonly"]) && !isset($employee_income_list->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="o<?php echo $employee_income_list->RowIndex ?>_EndDate" id="o<?php echo $employee_income_list->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_list->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_EndDate" class="form-group">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_list->RowIndex ?>_EndDate" id="x<?php echo $employee_income_list->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($employee_income_list->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->EndDate->EditValue ?>"<?php echo $employee_income_list->EndDate->editAttributes() ?>>
<?php if (!$employee_income_list->EndDate->ReadOnly && !$employee_income_list->EndDate->Disabled && !isset($employee_income_list->EndDate->EditAttrs["readonly"]) && !isset($employee_income_list->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_EndDate">
<span<?php echo $employee_income_list->EndDate->viewAttributes() ?>><?php echo $employee_income_list->EndDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode" <?php echo $employee_income_list->IncomeCode->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_IncomeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employee_income_list->RowIndex ?>_IncomeCode"><?php echo EmptyValue(strval($employee_income_list->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_list->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_list->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_list->IncomeCode->ReadOnly || $employee_income_list->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employee_income_list->RowIndex ?>_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_list->IncomeCode->Lookup->getParamTag($employee_income_list, "p_x" . $employee_income_list->RowIndex . "_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_list->IncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_list->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_list->RowIndex ?>_IncomeCode" value="<?php echo $employee_income_list->IncomeCode->CurrentValue ?>"<?php echo $employee_income_list->IncomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o<?php echo $employee_income_list->RowIndex ?>_IncomeCode" id="o<?php echo $employee_income_list->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_list->IncomeCode->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employee_income_list->RowIndex ?>_IncomeCode"><?php echo EmptyValue(strval($employee_income_list->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_list->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_list->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_list->IncomeCode->ReadOnly || $employee_income_list->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employee_income_list->RowIndex ?>_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_list->IncomeCode->Lookup->getParamTag($employee_income_list, "p_x" . $employee_income_list->RowIndex . "_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_list->IncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_list->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_list->RowIndex ?>_IncomeCode" value="<?php echo $employee_income_list->IncomeCode->CurrentValue ?>"<?php echo $employee_income_list->IncomeCode->editAttributes() ?>>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o<?php echo $employee_income_list->RowIndex ?>_IncomeCode" id="o<?php echo $employee_income_list->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_list->IncomeCode->OldValue != null ? $employee_income_list->IncomeCode->OldValue : $employee_income_list->IncomeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_IncomeCode">
<span<?php echo $employee_income_list->IncomeCode->viewAttributes() ?>><?php echo $employee_income_list->IncomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->Income->Visible) { // Income ?>
		<td data-name="Income" <?php echo $employee_income_list->Income->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Income" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_list->RowIndex ?>_Income" id="x<?php echo $employee_income_list->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->Income->EditValue ?>"<?php echo $employee_income_list->Income->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Income" name="o<?php echo $employee_income_list->RowIndex ?>_Income" id="o<?php echo $employee_income_list->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_list->Income->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Income" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_list->RowIndex ?>_Income" id="x<?php echo $employee_income_list->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->Income->EditValue ?>"<?php echo $employee_income_list->Income->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Income">
<span<?php echo $employee_income_list->Income->viewAttributes() ?>><?php echo $employee_income_list->Income->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $employee_income_list->Remarks->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Remarks" class="form-group">
<textarea data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_list->RowIndex ?>_Remarks" id="x<?php echo $employee_income_list->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_list->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_list->Remarks->editAttributes() ?>><?php echo $employee_income_list->Remarks->EditValue ?></textarea>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="o<?php echo $employee_income_list->RowIndex ?>_Remarks" id="o<?php echo $employee_income_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_list->Remarks->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Remarks" class="form-group">
<textarea data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_list->RowIndex ?>_Remarks" id="x<?php echo $employee_income_list->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_list->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_list->Remarks->editAttributes() ?>><?php echo $employee_income_list->Remarks->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Remarks">
<span<?php echo $employee_income_list->Remarks->viewAttributes() ?>><?php echo $employee_income_list->Remarks->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employee_income_list->Taxable->Visible) { // Taxable ?>
		<td data-name="Taxable" <?php echo $employee_income_list->Taxable->cellAttributes() ?>>
<?php if ($employee_income->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Taxable" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_list->RowIndex ?>_Taxable" id="x<?php echo $employee_income_list->RowIndex ?>_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->Taxable->EditValue ?>"<?php echo $employee_income_list->Taxable->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="o<?php echo $employee_income_list->RowIndex ?>_Taxable" id="o<?php echo $employee_income_list->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_list->Taxable->OldValue) ?>">
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Taxable" class="form-group">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_list->RowIndex ?>_Taxable" id="x<?php echo $employee_income_list->RowIndex ?>_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->Taxable->EditValue ?>"<?php echo $employee_income_list->Taxable->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employee_income->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employee_income_list->RowCount ?>_employee_income_Taxable">
<span<?php echo $employee_income_list->Taxable->viewAttributes() ?>><?php echo $employee_income_list->Taxable->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_income_list->ListOptions->render("body", "right", $employee_income_list->RowCount);
?>
	</tr>
<?php if ($employee_income->RowType == ROWTYPE_ADD || $employee_income->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployee_incomelist", "load"], function() {
	femployee_incomelist.updateLists(<?php echo $employee_income_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employee_income_list->isGridAdd())
		if (!$employee_income_list->Recordset->EOF)
			$employee_income_list->Recordset->moveNext();
}
?>
<?php
	if ($employee_income_list->isGridAdd() || $employee_income_list->isGridEdit()) {
		$employee_income_list->RowIndex = '$rowindex$';
		$employee_income_list->loadRowValues();

		// Set row properties
		$employee_income->resetAttributes();
		$employee_income->RowAttrs->merge(["data-rowindex" => $employee_income_list->RowIndex, "id" => "r0_employee_income", "data-rowtype" => ROWTYPE_ADD]);
		$employee_income->RowAttrs->appendClass("ew-template");
		$employee_income->RowType = ROWTYPE_ADD;

		// Render row
		$employee_income_list->renderRow();

		// Render list options
		$employee_income_list->renderListOptions();
		$employee_income_list->StartRowCount = 0;
?>
	<tr <?php echo $employee_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_income_list->ListOptions->render("body", "left", $employee_income_list->RowIndex);
?>
	<?php if ($employee_income_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if ($employee_income_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_employee_income_EmployeeID" class="form-group employee_income_EmployeeID">
<span<?php echo $employee_income_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_income_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" name="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_employee_income_EmployeeID" class="form-group employee_income_EmployeeID">
<input type="text" data-table="employee_income" data-field="x_EmployeeID" name="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" id="x<?php echo $employee_income_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->EmployeeID->EditValue ?>"<?php echo $employee_income_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="employee_income" data-field="x_EmployeeID" name="o<?php echo $employee_income_list->RowIndex ?>_EmployeeID" id="o<?php echo $employee_income_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employee_income_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->PaidPosition->Visible) { // PaidPosition ?>
		<td data-name="PaidPosition">
<span id="el$rowindex$_employee_income_PaidPosition" class="form-group employee_income_PaidPosition">
<?php
$onchange = $employee_income_list->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_income_list->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition">
	<input type="text" class="form-control" name="sv_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="sv_x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo RemoveHtml($employee_income_list->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_income_list->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_income_list->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_income_list->PaidPosition->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="x<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_list->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_incomelist"], function() {
	femployee_incomelist.createAutoSuggest({"id":"x<?php echo $employee_income_list->RowIndex ?>_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_income_list->PaidPosition->Lookup->getParamTag($employee_income_list, "p_x" . $employee_income_list->RowIndex . "_PaidPosition") ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PaidPosition" name="o<?php echo $employee_income_list->RowIndex ?>_PaidPosition" id="o<?php echo $employee_income_list->RowIndex ?>_PaidPosition" value="<?php echo HtmlEncode($employee_income_list->PaidPosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate">
<span id="el$rowindex$_employee_income_PayrollDate" class="form-group employee_income_PayrollDate">
<input type="text" data-table="employee_income" data-field="x_PayrollDate" name="x<?php echo $employee_income_list->RowIndex ?>_PayrollDate" id="x<?php echo $employee_income_list->RowIndex ?>_PayrollDate" placeholder="<?php echo HtmlEncode($employee_income_list->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->PayrollDate->EditValue ?>"<?php echo $employee_income_list->PayrollDate->editAttributes() ?>>
<?php if (!$employee_income_list->PayrollDate->ReadOnly && !$employee_income_list->PayrollDate->Disabled && !isset($employee_income_list->PayrollDate->EditAttrs["readonly"]) && !isset($employee_income_list->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollDate" name="o<?php echo $employee_income_list->RowIndex ?>_PayrollDate" id="o<?php echo $employee_income_list->RowIndex ?>_PayrollDate" value="<?php echo HtmlEncode($employee_income_list->PayrollDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod">
<span id="el$rowindex$_employee_income_PayrollPeriod" class="form-group employee_income_PayrollPeriod">
<input type="text" data-table="employee_income" data-field="x_PayrollPeriod" name="x<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" id="x<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->PayrollPeriod->EditValue ?>"<?php echo $employee_income_list->PayrollPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_PayrollPeriod" name="o<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" id="o<?php echo $employee_income_list->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($employee_income_list->PayrollPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<span id="el$rowindex$_employee_income_StartDate" class="form-group employee_income_StartDate">
<input type="text" data-table="employee_income" data-field="x_StartDate" name="x<?php echo $employee_income_list->RowIndex ?>_StartDate" id="x<?php echo $employee_income_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($employee_income_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->StartDate->EditValue ?>"<?php echo $employee_income_list->StartDate->editAttributes() ?>>
<?php if (!$employee_income_list->StartDate->ReadOnly && !$employee_income_list->StartDate->Disabled && !isset($employee_income_list->StartDate->EditAttrs["readonly"]) && !isset($employee_income_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_StartDate" name="o<?php echo $employee_income_list->RowIndex ?>_StartDate" id="o<?php echo $employee_income_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($employee_income_list->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<span id="el$rowindex$_employee_income_EndDate" class="form-group employee_income_EndDate">
<input type="text" data-table="employee_income" data-field="x_EndDate" name="x<?php echo $employee_income_list->RowIndex ?>_EndDate" id="x<?php echo $employee_income_list->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($employee_income_list->EndDate->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->EndDate->EditValue ?>"<?php echo $employee_income_list->EndDate->editAttributes() ?>>
<?php if (!$employee_income_list->EndDate->ReadOnly && !$employee_income_list->EndDate->Disabled && !isset($employee_income_list->EndDate->EditAttrs["readonly"]) && !isset($employee_income_list->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_incomelist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_incomelist", "x<?php echo $employee_income_list->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employee_income" data-field="x_EndDate" name="o<?php echo $employee_income_list->RowIndex ?>_EndDate" id="o<?php echo $employee_income_list->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($employee_income_list->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode">
<span id="el$rowindex$_employee_income_IncomeCode" class="form-group employee_income_IncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $employee_income_list->RowIndex ?>_IncomeCode"><?php echo EmptyValue(strval($employee_income_list->IncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employee_income_list->IncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employee_income_list->IncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employee_income_list->IncomeCode->ReadOnly || $employee_income_list->IncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $employee_income_list->RowIndex ?>_IncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employee_income_list->IncomeCode->Lookup->getParamTag($employee_income_list, "p_x" . $employee_income_list->RowIndex . "_IncomeCode") ?>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employee_income_list->IncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employee_income_list->RowIndex ?>_IncomeCode" id="x<?php echo $employee_income_list->RowIndex ?>_IncomeCode" value="<?php echo $employee_income_list->IncomeCode->CurrentValue ?>"<?php echo $employee_income_list->IncomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_IncomeCode" name="o<?php echo $employee_income_list->RowIndex ?>_IncomeCode" id="o<?php echo $employee_income_list->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($employee_income_list->IncomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->Income->Visible) { // Income ?>
		<td data-name="Income">
<span id="el$rowindex$_employee_income_Income" class="form-group employee_income_Income">
<input type="text" data-table="employee_income" data-field="x_Income" name="x<?php echo $employee_income_list->RowIndex ?>_Income" id="x<?php echo $employee_income_list->RowIndex ?>_Income" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->Income->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->Income->EditValue ?>"<?php echo $employee_income_list->Income->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Income" name="o<?php echo $employee_income_list->RowIndex ?>_Income" id="o<?php echo $employee_income_list->RowIndex ?>_Income" value="<?php echo HtmlEncode($employee_income_list->Income->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks">
<span id="el$rowindex$_employee_income_Remarks" class="form-group employee_income_Remarks">
<textarea data-table="employee_income" data-field="x_Remarks" name="x<?php echo $employee_income_list->RowIndex ?>_Remarks" id="x<?php echo $employee_income_list->RowIndex ?>_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_income_list->Remarks->getPlaceHolder()) ?>"<?php echo $employee_income_list->Remarks->editAttributes() ?>><?php echo $employee_income_list->Remarks->EditValue ?></textarea>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Remarks" name="o<?php echo $employee_income_list->RowIndex ?>_Remarks" id="o<?php echo $employee_income_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($employee_income_list->Remarks->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employee_income_list->Taxable->Visible) { // Taxable ?>
		<td data-name="Taxable">
<span id="el$rowindex$_employee_income_Taxable" class="form-group employee_income_Taxable">
<input type="text" data-table="employee_income" data-field="x_Taxable" name="x<?php echo $employee_income_list->RowIndex ?>_Taxable" id="x<?php echo $employee_income_list->RowIndex ?>_Taxable" size="30" placeholder="<?php echo HtmlEncode($employee_income_list->Taxable->getPlaceHolder()) ?>" value="<?php echo $employee_income_list->Taxable->EditValue ?>"<?php echo $employee_income_list->Taxable->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_income" data-field="x_Taxable" name="o<?php echo $employee_income_list->RowIndex ?>_Taxable" id="o<?php echo $employee_income_list->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($employee_income_list->Taxable->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_income_list->ListOptions->render("body", "right", $employee_income_list->RowIndex);
?>
<script>
loadjs.ready(["femployee_incomelist", "load"], function() {
	femployee_incomelist.updateLists(<?php echo $employee_income_list->RowIndex ?>);
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
<?php if ($employee_income_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employee_income_list->FormKeyCountName ?>" id="<?php echo $employee_income_list->FormKeyCountName ?>" value="<?php echo $employee_income_list->KeyCount ?>">
<?php echo $employee_income_list->MultiSelectKey ?>
<?php } ?>
<?php if ($employee_income_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $employee_income_list->FormKeyCountName ?>" id="<?php echo $employee_income_list->FormKeyCountName ?>" value="<?php echo $employee_income_list->KeyCount ?>">
<?php echo $employee_income_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employee_income->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_income_list->Recordset)
	$employee_income_list->Recordset->Close();
?>
<?php if (!$employee_income_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employee_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_income_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_income_list->TotalRecords == 0 && !$employee_income->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employee_income_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_income_list->isExport()) { ?>
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
$employee_income_list->terminate();
?>