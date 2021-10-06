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
$budget_list = new budget_list();

// Run the page
$budget_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$budget_list->isExport()) { ?>
<script>
var fbudgetlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbudgetlist = currentForm = new ew.Form("fbudgetlist", "list");
	fbudgetlist.formKeyCountName = '<?php echo $budget_list->FormKeyCountName ?>';

	// Validate form
	fbudgetlist.validate = function() {
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
			<?php if ($budget_list->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->OutcomeCode->caption(), $budget_list->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->OutputCode->caption(), $budget_list->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->ActionCode->caption(), $budget_list->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->DetailedActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->DetailedActionCode->caption(), $budget_list->DetailedActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_list->DetailedActionCode->errorMessage()) ?>");
			<?php if ($budget_list->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->FinancialYear->caption(), $budget_list->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->AccountCode->caption(), $budget_list->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->MeansOfImplementation->Required) { ?>
				elm = this.getElements("x" + infix + "_MeansOfImplementation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->MeansOfImplementation->caption(), $budget_list->MeansOfImplementation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->UnitOfMeasure->caption(), $budget_list->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->Quantity->caption(), $budget_list->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_list->Quantity->errorMessage()) ?>");
			<?php if ($budget_list->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->Frequency->caption(), $budget_list->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_list->Frequency->errorMessage()) ?>");
			<?php if ($budget_list->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->UnitCost->caption(), $budget_list->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_list->UnitCost->errorMessage()) ?>");
			<?php if ($budget_list->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->BudgetEstimate->caption(), $budget_list->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_list->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->LACode->caption(), $budget_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->DepartmentCode->caption(), $budget_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->SectionCode->caption(), $budget_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->BudgetLine->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetLine");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->BudgetLine->caption(), $budget_list->BudgetLine->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->ProgramCode->caption(), $budget_list->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->SubProgramCode->caption(), $budget_list->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_list->ApprovedBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_list->ApprovedBudget->caption(), $budget_list->ApprovedBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ApprovedBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_list->ApprovedBudget->errorMessage()) ?>");

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
	fbudgetlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DetailedActionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "MeansOfImplementation", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		if (ew.valueChanged(fobj, infix, "Quantity", false)) return false;
		if (ew.valueChanged(fobj, infix, "Frequency", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitCost", false)) return false;
		if (ew.valueChanged(fobj, infix, "BudgetEstimate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ApprovedBudget", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fbudgetlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudgetlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudgetlist.lists["x_OutcomeCode"] = <?php echo $budget_list->OutcomeCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_OutcomeCode"].options = <?php echo JsonEncode($budget_list->OutcomeCode->lookupOptions()) ?>;
	fbudgetlist.lists["x_OutputCode"] = <?php echo $budget_list->OutputCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_OutputCode"].options = <?php echo JsonEncode($budget_list->OutputCode->lookupOptions()) ?>;
	fbudgetlist.lists["x_ActionCode"] = <?php echo $budget_list->ActionCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_ActionCode"].options = <?php echo JsonEncode($budget_list->ActionCode->lookupOptions()) ?>;
	fbudgetlist.lists["x_DetailedActionCode"] = <?php echo $budget_list->DetailedActionCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_DetailedActionCode"].options = <?php echo JsonEncode($budget_list->DetailedActionCode->lookupOptions()) ?>;
	fbudgetlist.autoSuggests["x_DetailedActionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetlist.lists["x_FinancialYear"] = <?php echo $budget_list->FinancialYear->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_FinancialYear"].options = <?php echo JsonEncode($budget_list->FinancialYear->lookupOptions()) ?>;
	fbudgetlist.lists["x_AccountCode"] = <?php echo $budget_list->AccountCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_AccountCode"].options = <?php echo JsonEncode($budget_list->AccountCode->lookupOptions()) ?>;
	fbudgetlist.lists["x_MeansOfImplementation"] = <?php echo $budget_list->MeansOfImplementation->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_MeansOfImplementation"].options = <?php echo JsonEncode($budget_list->MeansOfImplementation->lookupOptions()) ?>;
	fbudgetlist.lists["x_UnitOfMeasure"] = <?php echo $budget_list->UnitOfMeasure->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($budget_list->UnitOfMeasure->lookupOptions()) ?>;
	fbudgetlist.lists["x_LACode"] = <?php echo $budget_list->LACode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_LACode"].options = <?php echo JsonEncode($budget_list->LACode->lookupOptions()) ?>;
	fbudgetlist.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbudgetlist.lists["x_DepartmentCode"] = <?php echo $budget_list->DepartmentCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_list->DepartmentCode->lookupOptions()) ?>;
	fbudgetlist.lists["x_SectionCode"] = <?php echo $budget_list->SectionCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_list->SectionCode->lookupOptions()) ?>;
	fbudgetlist.lists["x_ProgramCode"] = <?php echo $budget_list->ProgramCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_ProgramCode"].options = <?php echo JsonEncode($budget_list->ProgramCode->lookupOptions()) ?>;
	fbudgetlist.lists["x_SubProgramCode"] = <?php echo $budget_list->SubProgramCode->Lookup->toClientList($budget_list) ?>;
	fbudgetlist.lists["x_SubProgramCode"].options = <?php echo JsonEncode($budget_list->SubProgramCode->lookupOptions()) ?>;
	loadjs.done("fbudgetlist");
});
var fbudgetlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbudgetlistsrch = currentSearchForm = new ew.Form("fbudgetlistsrch");

	// Dynamic selection lists
	// Filters

	fbudgetlistsrch.filterList = <?php echo $budget_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbudgetlistsrch.initSearchPanel = true;
	loadjs.done("fbudgetlistsrch");
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
<?php if (!$budget_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($budget_list->TotalRecords > 0 && $budget_list->ExportOptions->visible()) { ?>
<?php $budget_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_list->ImportOptions->visible()) { ?>
<?php $budget_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_list->SearchOptions->visible()) { ?>
<?php $budget_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($budget_list->FilterOptions->visible()) { ?>
<?php $budget_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$budget_list->isExport() || Config("EXPORT_MASTER_RECORD") && $budget_list->isExport("print")) { ?>
<?php
if ($budget_list->DbMasterFilter != "" && $budget->getCurrentMasterTable() == "detailed_action") {
	if ($budget_list->MasterRecordExists) {
		include_once "detailed_actionmaster.php";
	}
}
?>
<?php } ?>
<?php
$budget_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$budget_list->isExport() && !$budget->CurrentAction) { ?>
<form name="fbudgetlistsrch" id="fbudgetlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbudgetlistsrch-search-panel" class="<?php echo $budget_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="budget">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $budget_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($budget_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($budget_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $budget_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($budget_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($budget_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($budget_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($budget_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $budget_list->showPageHeader(); ?>
<?php
$budget_list->showMessage();
?>
<?php if ($budget_list->TotalRecords > 0 || $budget->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($budget_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> budget">
<?php if (!$budget_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$budget_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbudgetlist" id="fbudgetlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget">
<?php if ($budget->getCurrentMasterTable() == "detailed_action" && $budget->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="detailed_action">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($budget_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($budget_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($budget_list->FinancialYear->getSessionValue()) ?>">
<input type="hidden" name="fk_ActionCode" value="<?php echo HtmlEncode($budget_list->ActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($budget_list->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($budget_list->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($budget_list->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SubProgramCode" value="<?php echo HtmlEncode($budget_list->SubProgramCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_budget" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($budget_list->TotalRecords > 0 || $budget_list->isGridEdit()) { ?>
<table id="tbl_budgetlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$budget->RowType = ROWTYPE_HEADER;

// Render list options
$budget_list->renderListOptions();

// Render list options (header, left)
$budget_list->ListOptions->render("header", "left");
?>
<?php if ($budget_list->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($budget_list->SortUrl($budget_list->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $budget_list->OutcomeCode->headerCellClass() ?>"><div id="elh_budget_OutcomeCode" class="budget_OutcomeCode"><div class="ew-table-header-caption"><?php echo $budget_list->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $budget_list->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->OutcomeCode) ?>', 1);"><div id="elh_budget_OutcomeCode" class="budget_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->OutputCode->Visible) { // OutputCode ?>
	<?php if ($budget_list->SortUrl($budget_list->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $budget_list->OutputCode->headerCellClass() ?>"><div id="elh_budget_OutputCode" class="budget_OutputCode"><div class="ew-table-header-caption"><?php echo $budget_list->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $budget_list->OutputCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->OutputCode) ?>', 1);"><div id="elh_budget_OutputCode" class="budget_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->ActionCode->Visible) { // ActionCode ?>
	<?php if ($budget_list->SortUrl($budget_list->ActionCode) == "") { ?>
		<th data-name="ActionCode" class="<?php echo $budget_list->ActionCode->headerCellClass() ?>"><div id="elh_budget_ActionCode" class="budget_ActionCode"><div class="ew-table-header-caption"><?php echo $budget_list->ActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionCode" class="<?php echo $budget_list->ActionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->ActionCode) ?>', 1);"><div id="elh_budget_ActionCode" class="budget_ActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->ActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->ActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<?php if ($budget_list->SortUrl($budget_list->DetailedActionCode) == "") { ?>
		<th data-name="DetailedActionCode" class="<?php echo $budget_list->DetailedActionCode->headerCellClass() ?>"><div id="elh_budget_DetailedActionCode" class="budget_DetailedActionCode"><div class="ew-table-header-caption"><?php echo $budget_list->DetailedActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionCode" class="<?php echo $budget_list->DetailedActionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->DetailedActionCode) ?>', 1);"><div id="elh_budget_DetailedActionCode" class="budget_DetailedActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->DetailedActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->DetailedActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->DetailedActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($budget_list->SortUrl($budget_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $budget_list->FinancialYear->headerCellClass() ?>"><div id="elh_budget_FinancialYear" class="budget_FinancialYear"><div class="ew-table-header-caption"><?php echo $budget_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $budget_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->FinancialYear) ?>', 1);"><div id="elh_budget_FinancialYear" class="budget_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->AccountCode->Visible) { // AccountCode ?>
	<?php if ($budget_list->SortUrl($budget_list->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $budget_list->AccountCode->headerCellClass() ?>"><div id="elh_budget_AccountCode" class="budget_AccountCode"><div class="ew-table-header-caption"><?php echo $budget_list->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $budget_list->AccountCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->AccountCode) ?>', 1);"><div id="elh_budget_AccountCode" class="budget_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->AccountCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
	<?php if ($budget_list->SortUrl($budget_list->MeansOfImplementation) == "") { ?>
		<th data-name="MeansOfImplementation" class="<?php echo $budget_list->MeansOfImplementation->headerCellClass() ?>"><div id="elh_budget_MeansOfImplementation" class="budget_MeansOfImplementation"><div class="ew-table-header-caption"><?php echo $budget_list->MeansOfImplementation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeansOfImplementation" class="<?php echo $budget_list->MeansOfImplementation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->MeansOfImplementation) ?>', 1);"><div id="elh_budget_MeansOfImplementation" class="budget_MeansOfImplementation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->MeansOfImplementation->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->MeansOfImplementation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->MeansOfImplementation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($budget_list->SortUrl($budget_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $budget_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_budget_UnitOfMeasure" class="budget_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $budget_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $budget_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->UnitOfMeasure) ?>', 1);"><div id="elh_budget_UnitOfMeasure" class="budget_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->Quantity->Visible) { // Quantity ?>
	<?php if ($budget_list->SortUrl($budget_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $budget_list->Quantity->headerCellClass() ?>"><div id="elh_budget_Quantity" class="budget_Quantity"><div class="ew-table-header-caption"><?php echo $budget_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $budget_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->Quantity) ?>', 1);"><div id="elh_budget_Quantity" class="budget_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->Frequency->Visible) { // Frequency ?>
	<?php if ($budget_list->SortUrl($budget_list->Frequency) == "") { ?>
		<th data-name="Frequency" class="<?php echo $budget_list->Frequency->headerCellClass() ?>"><div id="elh_budget_Frequency" class="budget_Frequency"><div class="ew-table-header-caption"><?php echo $budget_list->Frequency->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Frequency" class="<?php echo $budget_list->Frequency->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->Frequency) ?>', 1);"><div id="elh_budget_Frequency" class="budget_Frequency">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->Frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->Frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->Frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->UnitCost->Visible) { // UnitCost ?>
	<?php if ($budget_list->SortUrl($budget_list->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $budget_list->UnitCost->headerCellClass() ?>"><div id="elh_budget_UnitCost" class="budget_UnitCost"><div class="ew-table-header-caption"><?php echo $budget_list->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $budget_list->UnitCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->UnitCost) ?>', 1);"><div id="elh_budget_UnitCost" class="budget_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($budget_list->SortUrl($budget_list->BudgetEstimate) == "") { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_list->BudgetEstimate->headerCellClass() ?>"><div id="elh_budget_BudgetEstimate" class="budget_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $budget_list->BudgetEstimate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_list->BudgetEstimate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->BudgetEstimate) ?>', 1);"><div id="elh_budget_BudgetEstimate" class="budget_BudgetEstimate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->LACode->Visible) { // LACode ?>
	<?php if ($budget_list->SortUrl($budget_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $budget_list->LACode->headerCellClass() ?>"><div id="elh_budget_LACode" class="budget_LACode"><div class="ew-table-header-caption"><?php echo $budget_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $budget_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->LACode) ?>', 1);"><div id="elh_budget_LACode" class="budget_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($budget_list->SortUrl($budget_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_list->DepartmentCode->headerCellClass() ?>"><div id="elh_budget_DepartmentCode" class="budget_DepartmentCode"><div class="ew-table-header-caption"><?php echo $budget_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->DepartmentCode) ?>', 1);"><div id="elh_budget_DepartmentCode" class="budget_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($budget_list->SortUrl($budget_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $budget_list->SectionCode->headerCellClass() ?>"><div id="elh_budget_SectionCode" class="budget_SectionCode"><div class="ew-table-header-caption"><?php echo $budget_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $budget_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->SectionCode) ?>', 1);"><div id="elh_budget_SectionCode" class="budget_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->BudgetLine->Visible) { // BudgetLine ?>
	<?php if ($budget_list->SortUrl($budget_list->BudgetLine) == "") { ?>
		<th data-name="BudgetLine" class="<?php echo $budget_list->BudgetLine->headerCellClass() ?>"><div id="elh_budget_BudgetLine" class="budget_BudgetLine"><div class="ew-table-header-caption"><?php echo $budget_list->BudgetLine->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetLine" class="<?php echo $budget_list->BudgetLine->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->BudgetLine) ?>', 1);"><div id="elh_budget_BudgetLine" class="budget_BudgetLine">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->BudgetLine->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->BudgetLine->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->BudgetLine->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($budget_list->SortUrl($budget_list->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $budget_list->ProgramCode->headerCellClass() ?>"><div id="elh_budget_ProgramCode" class="budget_ProgramCode"><div class="ew-table-header-caption"><?php echo $budget_list->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $budget_list->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->ProgramCode) ?>', 1);"><div id="elh_budget_ProgramCode" class="budget_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($budget_list->SortUrl($budget_list->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $budget_list->SubProgramCode->headerCellClass() ?>"><div id="elh_budget_SubProgramCode" class="budget_SubProgramCode"><div class="ew-table-header-caption"><?php echo $budget_list->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $budget_list->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->SubProgramCode) ?>', 1);"><div id="elh_budget_SubProgramCode" class="budget_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
	<?php if ($budget_list->SortUrl($budget_list->ApprovedBudget) == "") { ?>
		<th data-name="ApprovedBudget" class="<?php echo $budget_list->ApprovedBudget->headerCellClass() ?>"><div id="elh_budget_ApprovedBudget" class="budget_ApprovedBudget"><div class="ew-table-header-caption"><?php echo $budget_list->ApprovedBudget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ApprovedBudget" class="<?php echo $budget_list->ApprovedBudget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_list->SortUrl($budget_list->ApprovedBudget) ?>', 1);"><div id="elh_budget_ApprovedBudget" class="budget_ApprovedBudget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_list->ApprovedBudget->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_list->ApprovedBudget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_list->ApprovedBudget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($budget_list->ExportAll && $budget_list->isExport()) {
	$budget_list->StopRecord = $budget_list->TotalRecords;
} else {

	// Set the last record to display
	if ($budget_list->TotalRecords > $budget_list->StartRecord + $budget_list->DisplayRecords - 1)
		$budget_list->StopRecord = $budget_list->StartRecord + $budget_list->DisplayRecords - 1;
	else
		$budget_list->StopRecord = $budget_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($budget->isConfirm() || $budget_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($budget_list->FormKeyCountName) && ($budget_list->isGridAdd() || $budget_list->isGridEdit() || $budget->isConfirm())) {
		$budget_list->KeyCount = $CurrentForm->getValue($budget_list->FormKeyCountName);
		$budget_list->StopRecord = $budget_list->StartRecord + $budget_list->KeyCount - 1;
	}
}
$budget_list->RecordCount = $budget_list->StartRecord - 1;
if ($budget_list->Recordset && !$budget_list->Recordset->EOF) {
	$budget_list->Recordset->moveFirst();
	$selectLimit = $budget_list->UseSelectLimit;
	if (!$selectLimit && $budget_list->StartRecord > 1)
		$budget_list->Recordset->move($budget_list->StartRecord - 1);
} elseif (!$budget->AllowAddDeleteRow && $budget_list->StopRecord == 0) {
	$budget_list->StopRecord = $budget->GridAddRowCount;
}

// Initialize aggregate
$budget->RowType = ROWTYPE_AGGREGATEINIT;
$budget->resetAttributes();
$budget_list->renderRow();
if ($budget_list->isGridAdd())
	$budget_list->RowIndex = 0;
if ($budget_list->isGridEdit())
	$budget_list->RowIndex = 0;
while ($budget_list->RecordCount < $budget_list->StopRecord) {
	$budget_list->RecordCount++;
	if ($budget_list->RecordCount >= $budget_list->StartRecord) {
		$budget_list->RowCount++;
		if ($budget_list->isGridAdd() || $budget_list->isGridEdit() || $budget->isConfirm()) {
			$budget_list->RowIndex++;
			$CurrentForm->Index = $budget_list->RowIndex;
			if ($CurrentForm->hasValue($budget_list->FormActionName) && ($budget->isConfirm() || $budget_list->EventCancelled))
				$budget_list->RowAction = strval($CurrentForm->getValue($budget_list->FormActionName));
			elseif ($budget_list->isGridAdd())
				$budget_list->RowAction = "insert";
			else
				$budget_list->RowAction = "";
		}

		// Set up key count
		$budget_list->KeyCount = $budget_list->RowIndex;

		// Init row class and style
		$budget->resetAttributes();
		$budget->CssClass = "";
		if ($budget_list->isGridAdd()) {
			$budget_list->loadRowValues(); // Load default values
		} else {
			$budget_list->loadRowValues($budget_list->Recordset); // Load row values
		}
		$budget->RowType = ROWTYPE_VIEW; // Render view
		if ($budget_list->isGridAdd()) // Grid add
			$budget->RowType = ROWTYPE_ADD; // Render add
		if ($budget_list->isGridAdd() && $budget->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$budget_list->restoreCurrentRowFormValues($budget_list->RowIndex); // Restore form values
		if ($budget_list->isGridEdit()) { // Grid edit
			if ($budget->EventCancelled)
				$budget_list->restoreCurrentRowFormValues($budget_list->RowIndex); // Restore form values
			if ($budget_list->RowAction == "insert")
				$budget->RowType = ROWTYPE_ADD; // Render add
			else
				$budget->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($budget_list->isGridEdit() && ($budget->RowType == ROWTYPE_EDIT || $budget->RowType == ROWTYPE_ADD) && $budget->EventCancelled) // Update failed
			$budget_list->restoreCurrentRowFormValues($budget_list->RowIndex); // Restore form values
		if ($budget->RowType == ROWTYPE_EDIT) // Edit row
			$budget_list->EditRowCount++;

		// Set up row id / data-rowindex
		$budget->RowAttrs->merge(["data-rowindex" => $budget_list->RowCount, "id" => "r" . $budget_list->RowCount . "_budget", "data-rowtype" => $budget->RowType]);

		// Render row
		$budget_list->renderRow();

		// Render list options
		$budget_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($budget_list->RowAction != "delete" && $budget_list->RowAction != "insertdelete" && !($budget_list->RowAction == "insert" && $budget->isConfirm() && $budget_list->emptyRow())) {
?>
	<tr <?php echo $budget->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_list->ListOptions->render("body", "left", $budget_list->RowCount);
?>
	<?php if ($budget_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $budget_list->OutcomeCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutcomeCode" class="form-group">
<span<?php echo $budget_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" name="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutcomeCode" class="form-group">
<?php $budget_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($budget_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->OutcomeCode->ReadOnly || $budget_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->OutcomeCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo $budget_list->OutcomeCode->CurrentValue ?>"<?php echo $budget_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="o<?php echo $budget_list->RowIndex ?>_OutcomeCode" id="o<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_list->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutcomeCode" class="form-group">
<span<?php echo $budget_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" name="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutcomeCode" class="form-group">
<?php $budget_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($budget_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->OutcomeCode->ReadOnly || $budget_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->OutcomeCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo $budget_list->OutcomeCode->CurrentValue ?>"<?php echo $budget_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutcomeCode">
<span<?php echo $budget_list->OutcomeCode->viewAttributes() ?>><?php echo $budget_list->OutcomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $budget_list->OutputCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutputCode" class="form-group">
<span<?php echo $budget_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_OutputCode" name="x<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutputCode" class="form-group">
<?php $budget_list->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($budget_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->OutputCode->ReadOnly || $budget_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->OutputCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_OutputCode" id="x<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo $budget_list->OutputCode->CurrentValue ?>"<?php echo $budget_list->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="o<?php echo $budget_list->RowIndex ?>_OutputCode" id="o<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_list->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutputCode" class="form-group">
<span<?php echo $budget_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_OutputCode" name="x<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutputCode" class="form-group">
<?php $budget_list->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($budget_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->OutputCode->ReadOnly || $budget_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->OutputCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_OutputCode" id="x<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo $budget_list->OutputCode->CurrentValue ?>"<?php echo $budget_list->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_OutputCode">
<span<?php echo $budget_list->OutputCode->viewAttributes() ?>><?php echo $budget_list->OutputCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" <?php echo $budget_list->ActionCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ActionCode" class="form-group">
<span<?php echo $budget_list->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_ActionCode" name="x<?php echo $budget_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_list->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ActionCode" class="form-group">
<?php $budget_list->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_list->ActionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_ActionCode" name="x<?php echo $budget_list->RowIndex ?>_ActionCode"<?php echo $budget_list->ActionCode->editAttributes() ?>>
			<?php echo $budget_list->ActionCode->selectOptionListHtml("x{$budget_list->RowIndex}_ActionCode") ?>
		</select>
</div>
<?php echo $budget_list->ActionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_ActionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="o<?php echo $budget_list->RowIndex ?>_ActionCode" id="o<?php echo $budget_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_list->ActionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ActionCode" class="form-group">
<span<?php echo $budget_list->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_ActionCode" name="x<?php echo $budget_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_list->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ActionCode" class="form-group">
<?php $budget_list->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_list->ActionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_ActionCode" name="x<?php echo $budget_list->RowIndex ?>_ActionCode"<?php echo $budget_list->ActionCode->editAttributes() ?>>
			<?php echo $budget_list->ActionCode->selectOptionListHtml("x{$budget_list->RowIndex}_ActionCode") ?>
		</select>
</div>
<?php echo $budget_list->ActionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_ActionCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ActionCode">
<span<?php echo $budget_list->ActionCode->viewAttributes() ?>><?php echo $budget_list->ActionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode" <?php echo $budget_list->DetailedActionCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DetailedActionCode" class="form-group">
<span<?php echo $budget_list->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" name="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DetailedActionCode" class="form-group">
<?php
$onchange = $budget_list->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_list->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="sv_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo RemoveHtml($budget_list->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_list->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_list->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_list->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->DetailedActionCode->ReadOnly || $budget_list->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetlist"], function() {
	fbudgetlist.createAutoSuggest({"id":"x<?php echo $budget_list->RowIndex ?>_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_list->DetailedActionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_DetailedActionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="o<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="o<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DetailedActionCode" class="form-group">
<span<?php echo $budget_list->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" name="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DetailedActionCode" class="form-group">
<?php
$onchange = $budget_list->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_list->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="sv_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo RemoveHtml($budget_list->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_list->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_list->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_list->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->DetailedActionCode->ReadOnly || $budget_list->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetlist"], function() {
	fbudgetlist.createAutoSuggest({"id":"x<?php echo $budget_list->RowIndex ?>_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_list->DetailedActionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_DetailedActionCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DetailedActionCode">
<span<?php echo $budget_list->DetailedActionCode->viewAttributes() ?>><?php echo $budget_list->DetailedActionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $budget_list->FinancialYear->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_FinancialYear" class="form-group">
<span<?php echo $budget_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_FinancialYear" name="x<?php echo $budget_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_FinancialYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_list->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_FinancialYear" name="x<?php echo $budget_list->RowIndex ?>_FinancialYear"<?php echo $budget_list->FinancialYear->editAttributes() ?>>
			<?php echo $budget_list->FinancialYear->selectOptionListHtml("x{$budget_list->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_list->FinancialYear->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_FinancialYear") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="o<?php echo $budget_list->RowIndex ?>_FinancialYear" id="o<?php echo $budget_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_list->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_FinancialYear" class="form-group">
<span<?php echo $budget_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_FinancialYear" name="x<?php echo $budget_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_FinancialYear" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_list->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_FinancialYear" name="x<?php echo $budget_list->RowIndex ?>_FinancialYear"<?php echo $budget_list->FinancialYear->editAttributes() ?>>
			<?php echo $budget_list->FinancialYear->selectOptionListHtml("x{$budget_list->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_list->FinancialYear->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_FinancialYear") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_FinancialYear">
<span<?php echo $budget_list->FinancialYear->viewAttributes() ?>><?php echo $budget_list->FinancialYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $budget_list->AccountCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_AccountCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_AccountCode"><?php echo EmptyValue(strval($budget_list->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->AccountCode->ReadOnly || $budget_list->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->AccountCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->AccountCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_AccountCode" id="x<?php echo $budget_list->RowIndex ?>_AccountCode" value="<?php echo $budget_list->AccountCode->CurrentValue ?>"<?php echo $budget_list->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="o<?php echo $budget_list->RowIndex ?>_AccountCode" id="o<?php echo $budget_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_list->AccountCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_AccountCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_AccountCode"><?php echo EmptyValue(strval($budget_list->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->AccountCode->ReadOnly || $budget_list->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->AccountCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->AccountCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_AccountCode" id="x<?php echo $budget_list->RowIndex ?>_AccountCode" value="<?php echo $budget_list->AccountCode->CurrentValue ?>"<?php echo $budget_list->AccountCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_AccountCode">
<span<?php echo $budget_list->AccountCode->viewAttributes() ?>><?php echo $budget_list->AccountCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<td data-name="MeansOfImplementation" <?php echo $budget_list->MeansOfImplementation->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_MeansOfImplementation" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation"><?php echo EmptyValue(strval($budget_list->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->MeansOfImplementation->ReadOnly || $budget_list->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->MeansOfImplementation->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" value="<?php echo $budget_list->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_list->MeansOfImplementation->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="o<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" id="o<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_list->MeansOfImplementation->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_MeansOfImplementation" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation"><?php echo EmptyValue(strval($budget_list->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->MeansOfImplementation->ReadOnly || $budget_list->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->MeansOfImplementation->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" value="<?php echo $budget_list->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_list->MeansOfImplementation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_MeansOfImplementation">
<span<?php echo $budget_list->MeansOfImplementation->viewAttributes() ?>><?php echo $budget_list->MeansOfImplementation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $budget_list->UnitOfMeasure->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_UnitOfMeasure" name="x<?php echo $budget_list->RowIndex ?>_UnitOfMeasure"<?php echo $budget_list->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_list->UnitOfMeasure->selectOptionListHtml("x{$budget_list->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_list->UnitOfMeasure->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_UnitOfMeasure") ?>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="o<?php echo $budget_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $budget_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_list->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_UnitOfMeasure" name="x<?php echo $budget_list->RowIndex ?>_UnitOfMeasure"<?php echo $budget_list->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_list->UnitOfMeasure->selectOptionListHtml("x{$budget_list->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_list->UnitOfMeasure->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_UnitOfMeasure") ?>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_UnitOfMeasure">
<span<?php echo $budget_list->UnitOfMeasure->viewAttributes() ?>><?php echo $budget_list->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $budget_list->Quantity->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_Quantity" class="form-group">
<input type="text" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_list->RowIndex ?>_Quantity" id="x<?php echo $budget_list->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_list->Quantity->EditValue ?>"<?php echo $budget_list->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Quantity" name="o<?php echo $budget_list->RowIndex ?>_Quantity" id="o<?php echo $budget_list->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_list->Quantity->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_Quantity" class="form-group">
<input type="text" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_list->RowIndex ?>_Quantity" id="x<?php echo $budget_list->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_list->Quantity->EditValue ?>"<?php echo $budget_list->Quantity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_Quantity">
<span<?php echo $budget_list->Quantity->viewAttributes() ?>><?php echo $budget_list->Quantity->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency" <?php echo $budget_list->Frequency->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_Frequency" class="form-group">
<input type="text" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_list->RowIndex ?>_Frequency" id="x<?php echo $budget_list->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_list->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_list->Frequency->EditValue ?>"<?php echo $budget_list->Frequency->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Frequency" name="o<?php echo $budget_list->RowIndex ?>_Frequency" id="o<?php echo $budget_list->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_list->Frequency->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_Frequency" class="form-group">
<input type="text" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_list->RowIndex ?>_Frequency" id="x<?php echo $budget_list->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_list->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_list->Frequency->EditValue ?>"<?php echo $budget_list->Frequency->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_Frequency">
<span<?php echo $budget_list->Frequency->viewAttributes() ?>><?php echo $budget_list->Frequency->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $budget_list->UnitCost->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_UnitCost" class="form-group">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_list->RowIndex ?>_UnitCost" id="x<?php echo $budget_list->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_list->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_list->UnitCost->EditValue ?>"<?php echo $budget_list->UnitCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="o<?php echo $budget_list->RowIndex ?>_UnitCost" id="o<?php echo $budget_list->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_list->UnitCost->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_UnitCost" class="form-group">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_list->RowIndex ?>_UnitCost" id="x<?php echo $budget_list->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_list->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_list->UnitCost->EditValue ?>"<?php echo $budget_list->UnitCost->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_UnitCost">
<span<?php echo $budget_list->UnitCost->viewAttributes() ?>><?php echo $budget_list->UnitCost->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" <?php echo $budget_list->BudgetEstimate->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_BudgetEstimate" class="form-group">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_list->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_list->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_list->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_list->BudgetEstimate->EditValue ?>"<?php echo $budget_list->BudgetEstimate->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="o<?php echo $budget_list->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_list->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_list->BudgetEstimate->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_BudgetEstimate" class="form-group">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_list->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_list->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_list->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_list->BudgetEstimate->EditValue ?>"<?php echo $budget_list->BudgetEstimate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_BudgetEstimate">
<span<?php echo $budget_list->BudgetEstimate->viewAttributes() ?>><?php echo $budget_list->BudgetEstimate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $budget_list->LACode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_LACode" class="form-group">
<span<?php echo $budget_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_LACode" name="x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_LACode" class="form-group">
<?php
$onchange = $budget_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_list->RowIndex ?>_LACode" id="sv_x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($budget_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_list->LACode->getPlaceHolder()) ?>"<?php echo $budget_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->LACode->ReadOnly || $budget_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_LACode" id="x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetlist"], function() {
	fbudgetlist.createAutoSuggest({"id":"x<?php echo $budget_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $budget_list->LACode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_LACode" name="o<?php echo $budget_list->RowIndex ?>_LACode" id="o<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_LACode" class="form-group">
<span<?php echo $budget_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_LACode" name="x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_LACode" class="form-group">
<?php
$onchange = $budget_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_list->RowIndex ?>_LACode" id="sv_x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($budget_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_list->LACode->getPlaceHolder()) ?>"<?php echo $budget_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->LACode->ReadOnly || $budget_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_LACode" id="x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetlist"], function() {
	fbudgetlist.createAutoSuggest({"id":"x<?php echo $budget_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $budget_list->LACode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_LACode">
<span<?php echo $budget_list->LACode->viewAttributes() ?>><?php echo $budget_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $budget_list->DepartmentCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DepartmentCode" class="form-group">
<span<?php echo $budget_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DepartmentCode" class="form-group">
<?php $budget_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_list->RowIndex ?>_DepartmentCode"<?php echo $budget_list->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_list->DepartmentCode->selectOptionListHtml("x{$budget_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_list->DepartmentCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="o<?php echo $budget_list->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DepartmentCode" class="form-group">
<span<?php echo $budget_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DepartmentCode" class="form-group">
<?php $budget_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_list->RowIndex ?>_DepartmentCode"<?php echo $budget_list->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_list->DepartmentCode->selectOptionListHtml("x{$budget_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_list->DepartmentCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_DepartmentCode">
<span<?php echo $budget_list->DepartmentCode->viewAttributes() ?>><?php echo $budget_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $budget_list->SectionCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_SectionCode" name="x<?php echo $budget_list->RowIndex ?>_SectionCode"<?php echo $budget_list->SectionCode->editAttributes() ?>>
			<?php echo $budget_list->SectionCode->selectOptionListHtml("x{$budget_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_list->SectionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="o<?php echo $budget_list->RowIndex ?>_SectionCode" id="o<?php echo $budget_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_SectionCode" name="x<?php echo $budget_list->RowIndex ?>_SectionCode"<?php echo $budget_list->SectionCode->editAttributes() ?>>
			<?php echo $budget_list->SectionCode->selectOptionListHtml("x{$budget_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_list->SectionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SectionCode">
<span<?php echo $budget_list->SectionCode->viewAttributes() ?>><?php echo $budget_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->BudgetLine->Visible) { // BudgetLine ?>
		<td data-name="BudgetLine" <?php echo $budget_list->BudgetLine->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_BudgetLine" class="form-group"></span>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="o<?php echo $budget_list->RowIndex ?>_BudgetLine" id="o<?php echo $budget_list->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_list->BudgetLine->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_BudgetLine" class="form-group">
<span<?php echo $budget_list->BudgetLine->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->BudgetLine->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="x<?php echo $budget_list->RowIndex ?>_BudgetLine" id="x<?php echo $budget_list->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_list->BudgetLine->CurrentValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_BudgetLine">
<span<?php echo $budget_list->BudgetLine->viewAttributes() ?>><?php echo $budget_list->BudgetLine->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $budget_list->ProgramCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ProgramCode" class="form-group">
<span<?php echo $budget_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_ProgramCode" name="x<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ProgramCode" class="form-group">
<?php $budget_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_ProgramCode"><?php echo EmptyValue(strval($budget_list->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->ProgramCode->ReadOnly || $budget_list->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->ProgramCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_ProgramCode" id="x<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo $budget_list->ProgramCode->CurrentValue ?>"<?php echo $budget_list->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="o<?php echo $budget_list->RowIndex ?>_ProgramCode" id="o<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_list->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ProgramCode" class="form-group">
<span<?php echo $budget_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_ProgramCode" name="x<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ProgramCode" class="form-group">
<?php $budget_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_ProgramCode"><?php echo EmptyValue(strval($budget_list->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->ProgramCode->ReadOnly || $budget_list->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->ProgramCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_ProgramCode" id="x<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo $budget_list->ProgramCode->CurrentValue ?>"<?php echo $budget_list->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ProgramCode">
<span<?php echo $budget_list->ProgramCode->viewAttributes() ?>><?php echo $budget_list->ProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $budget_list->SubProgramCode->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_list->SubProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SubProgramCode" class="form-group">
<span<?php echo $budget_list->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" name="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_list->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($budget_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->SubProgramCode->ReadOnly || $budget_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->SubProgramCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo $budget_list->SubProgramCode->CurrentValue ?>"<?php echo $budget_list->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="o<?php echo $budget_list->RowIndex ?>_SubProgramCode" id="o<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_list->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_list->SubProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SubProgramCode" class="form-group">
<span<?php echo $budget_list->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" name="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_list->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($budget_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->SubProgramCode->ReadOnly || $budget_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->SubProgramCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo $budget_list->SubProgramCode->CurrentValue ?>"<?php echo $budget_list->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_SubProgramCode">
<span<?php echo $budget_list->SubProgramCode->viewAttributes() ?>><?php echo $budget_list->SubProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget" <?php echo $budget_list->ApprovedBudget->cellAttributes() ?>>
<?php if ($budget->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ApprovedBudget" class="form-group">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_list->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_list->RowIndex ?>_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_list->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_list->ApprovedBudget->EditValue ?>"<?php echo $budget_list->ApprovedBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="o<?php echo $budget_list->RowIndex ?>_ApprovedBudget" id="o<?php echo $budget_list->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_list->ApprovedBudget->OldValue) ?>">
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ApprovedBudget" class="form-group">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_list->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_list->RowIndex ?>_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_list->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_list->ApprovedBudget->EditValue ?>"<?php echo $budget_list->ApprovedBudget->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_list->RowCount ?>_budget_ApprovedBudget">
<span<?php echo $budget_list->ApprovedBudget->viewAttributes() ?>><?php echo $budget_list->ApprovedBudget->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_list->ListOptions->render("body", "right", $budget_list->RowCount);
?>
	</tr>
<?php if ($budget->RowType == ROWTYPE_ADD || $budget->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbudgetlist", "load"], function() {
	fbudgetlist.updateLists(<?php echo $budget_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$budget_list->isGridAdd())
		if (!$budget_list->Recordset->EOF)
			$budget_list->Recordset->moveNext();
}
?>
<?php
	if ($budget_list->isGridAdd() || $budget_list->isGridEdit()) {
		$budget_list->RowIndex = '$rowindex$';
		$budget_list->loadRowValues();

		// Set row properties
		$budget->resetAttributes();
		$budget->RowAttrs->merge(["data-rowindex" => $budget_list->RowIndex, "id" => "r0_budget", "data-rowtype" => ROWTYPE_ADD]);
		$budget->RowAttrs->appendClass("ew-template");
		$budget->RowType = ROWTYPE_ADD;

		// Render row
		$budget_list->renderRow();

		// Render list options
		$budget_list->renderListOptions();
		$budget_list->StartRowCount = 0;
?>
	<tr <?php echo $budget->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_list->ListOptions->render("body", "left", $budget_list->RowIndex);
?>
	<?php if ($budget_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if ($budget_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_OutcomeCode" class="form-group budget_OutcomeCode">
<span<?php echo $budget_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" name="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_OutcomeCode" class="form-group budget_OutcomeCode">
<?php $budget_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($budget_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->OutcomeCode->ReadOnly || $budget_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->OutcomeCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" id="x<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo $budget_list->OutcomeCode->CurrentValue ?>"<?php echo $budget_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutcomeCode" name="o<?php echo $budget_list->RowIndex ?>_OutcomeCode" id="o<?php echo $budget_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($budget_list->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if ($budget_list->OutputCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_OutputCode" class="form-group budget_OutputCode">
<span<?php echo $budget_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_OutputCode" name="x<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_OutputCode" class="form-group budget_OutputCode">
<?php $budget_list->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($budget_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->OutputCode->ReadOnly || $budget_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->OutputCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_OutputCode" id="x<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo $budget_list->OutputCode->CurrentValue ?>"<?php echo $budget_list->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_OutputCode" name="o<?php echo $budget_list->RowIndex ?>_OutputCode" id="o<?php echo $budget_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($budget_list->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode">
<?php if ($budget_list->ActionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_ActionCode" class="form-group budget_ActionCode">
<span<?php echo $budget_list->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_ActionCode" name="x<?php echo $budget_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_list->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_ActionCode" class="form-group budget_ActionCode">
<?php $budget_list->ActionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_ActionCode" data-value-separator="<?php echo $budget_list->ActionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_ActionCode" name="x<?php echo $budget_list->RowIndex ?>_ActionCode"<?php echo $budget_list->ActionCode->editAttributes() ?>>
			<?php echo $budget_list->ActionCode->selectOptionListHtml("x{$budget_list->RowIndex}_ActionCode") ?>
		</select>
</div>
<?php echo $budget_list->ActionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_ActionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ActionCode" name="o<?php echo $budget_list->RowIndex ?>_ActionCode" id="o<?php echo $budget_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($budget_list->ActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode">
<?php if ($budget_list->DetailedActionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_DetailedActionCode" class="form-group budget_DetailedActionCode">
<span<?php echo $budget_list->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->DetailedActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" name="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_DetailedActionCode" class="form-group budget_DetailedActionCode">
<?php
$onchange = $budget_list->DetailedActionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_list->DetailedActionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="sv_x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo RemoveHtml($budget_list->DetailedActionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_list->DetailedActionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_list->DetailedActionCode->getPlaceHolder()) ?>"<?php echo $budget_list->DetailedActionCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->DetailedActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_DetailedActionCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->DetailedActionCode->ReadOnly || $budget_list->DetailedActionCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->DetailedActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="x<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetlist"], function() {
	fbudgetlist.createAutoSuggest({"id":"x<?php echo $budget_list->RowIndex ?>_DetailedActionCode","forceSelect":false});
});
</script>
<?php echo $budget_list->DetailedActionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_DetailedActionCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DetailedActionCode" name="o<?php echo $budget_list->RowIndex ?>_DetailedActionCode" id="o<?php echo $budget_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($budget_list->DetailedActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if ($budget_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_FinancialYear" class="form-group budget_FinancialYear">
<span<?php echo $budget_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_FinancialYear" name="x<?php echo $budget_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_FinancialYear" class="form-group budget_FinancialYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_FinancialYear" data-value-separator="<?php echo $budget_list->FinancialYear->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_FinancialYear" name="x<?php echo $budget_list->RowIndex ?>_FinancialYear"<?php echo $budget_list->FinancialYear->editAttributes() ?>>
			<?php echo $budget_list->FinancialYear->selectOptionListHtml("x{$budget_list->RowIndex}_FinancialYear") ?>
		</select>
</div>
<?php echo $budget_list->FinancialYear->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_FinancialYear") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_FinancialYear" name="o<?php echo $budget_list->RowIndex ?>_FinancialYear" id="o<?php echo $budget_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($budget_list->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode">
<span id="el$rowindex$_budget_AccountCode" class="form-group budget_AccountCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_AccountCode"><?php echo EmptyValue(strval($budget_list->AccountCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->AccountCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->AccountCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->AccountCode->ReadOnly || $budget_list->AccountCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_AccountCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->AccountCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_AccountCode") ?>
<input type="hidden" data-table="budget" data-field="x_AccountCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->AccountCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_AccountCode" id="x<?php echo $budget_list->RowIndex ?>_AccountCode" value="<?php echo $budget_list->AccountCode->CurrentValue ?>"<?php echo $budget_list->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_AccountCode" name="o<?php echo $budget_list->RowIndex ?>_AccountCode" id="o<?php echo $budget_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_list->AccountCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<td data-name="MeansOfImplementation">
<span id="el$rowindex$_budget_MeansOfImplementation" class="form-group budget_MeansOfImplementation">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation"><?php echo EmptyValue(strval($budget_list->MeansOfImplementation->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->MeansOfImplementation->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->MeansOfImplementation->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->MeansOfImplementation->ReadOnly || $budget_list->MeansOfImplementation->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->MeansOfImplementation->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_MeansOfImplementation") ?>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->MeansOfImplementation->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" id="x<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" value="<?php echo $budget_list->MeansOfImplementation->CurrentValue ?>"<?php echo $budget_list->MeansOfImplementation->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_MeansOfImplementation" name="o<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" id="o<?php echo $budget_list->RowIndex ?>_MeansOfImplementation" value="<?php echo HtmlEncode($budget_list->MeansOfImplementation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<span id="el$rowindex$_budget_UnitOfMeasure" class="form-group budget_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $budget_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_UnitOfMeasure" name="x<?php echo $budget_list->RowIndex ?>_UnitOfMeasure"<?php echo $budget_list->UnitOfMeasure->editAttributes() ?>>
			<?php echo $budget_list->UnitOfMeasure->selectOptionListHtml("x{$budget_list->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $budget_list->UnitOfMeasure->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_UnitOfMeasure") ?>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitOfMeasure" name="o<?php echo $budget_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $budget_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($budget_list->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity">
<span id="el$rowindex$_budget_Quantity" class="form-group budget_Quantity">
<input type="text" data-table="budget" data-field="x_Quantity" name="x<?php echo $budget_list->RowIndex ?>_Quantity" id="x<?php echo $budget_list->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($budget_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $budget_list->Quantity->EditValue ?>"<?php echo $budget_list->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Quantity" name="o<?php echo $budget_list->RowIndex ?>_Quantity" id="o<?php echo $budget_list->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($budget_list->Quantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency">
<span id="el$rowindex$_budget_Frequency" class="form-group budget_Frequency">
<input type="text" data-table="budget" data-field="x_Frequency" name="x<?php echo $budget_list->RowIndex ?>_Frequency" id="x<?php echo $budget_list->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($budget_list->Frequency->getPlaceHolder()) ?>" value="<?php echo $budget_list->Frequency->EditValue ?>"<?php echo $budget_list->Frequency->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_Frequency" name="o<?php echo $budget_list->RowIndex ?>_Frequency" id="o<?php echo $budget_list->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($budget_list->Frequency->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost">
<span id="el$rowindex$_budget_UnitCost" class="form-group budget_UnitCost">
<input type="text" data-table="budget" data-field="x_UnitCost" name="x<?php echo $budget_list->RowIndex ?>_UnitCost" id="x<?php echo $budget_list->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($budget_list->UnitCost->getPlaceHolder()) ?>" value="<?php echo $budget_list->UnitCost->EditValue ?>"<?php echo $budget_list->UnitCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_UnitCost" name="o<?php echo $budget_list->RowIndex ?>_UnitCost" id="o<?php echo $budget_list->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($budget_list->UnitCost->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate">
<span id="el$rowindex$_budget_BudgetEstimate" class="form-group budget_BudgetEstimate">
<input type="text" data-table="budget" data-field="x_BudgetEstimate" name="x<?php echo $budget_list->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_list->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_list->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_list->BudgetEstimate->EditValue ?>"<?php echo $budget_list->BudgetEstimate->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_BudgetEstimate" name="o<?php echo $budget_list->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_list->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_list->BudgetEstimate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($budget_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_LACode" class="form-group budget_LACode">
<span<?php echo $budget_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_LACode" name="x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_LACode" class="form-group budget_LACode">
<?php
$onchange = $budget_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $budget_list->RowIndex ?>_LACode" id="sv_x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($budget_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($budget_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_list->LACode->getPlaceHolder()) ?>"<?php echo $budget_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->LACode->ReadOnly || $budget_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="budget" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_LACode" id="x<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudgetlist"], function() {
	fbudgetlist.createAutoSuggest({"id":"x<?php echo $budget_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $budget_list->LACode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_LACode" name="o<?php echo $budget_list->RowIndex ?>_LACode" id="o<?php echo $budget_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if ($budget_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_DepartmentCode" class="form-group budget_DepartmentCode">
<span<?php echo $budget_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_DepartmentCode" class="form-group budget_DepartmentCode">
<?php $budget_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_list->RowIndex ?>_DepartmentCode"<?php echo $budget_list->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_list->DepartmentCode->selectOptionListHtml("x{$budget_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_list->DepartmentCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_DepartmentCode" name="o<?php echo $budget_list->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_budget_SectionCode" class="form-group budget_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget" data-field="x_SectionCode" data-value-separator="<?php echo $budget_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_list->RowIndex ?>_SectionCode" name="x<?php echo $budget_list->RowIndex ?>_SectionCode"<?php echo $budget_list->SectionCode->editAttributes() ?>>
			<?php echo $budget_list->SectionCode->selectOptionListHtml("x{$budget_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_list->SectionCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="budget" data-field="x_SectionCode" name="o<?php echo $budget_list->RowIndex ?>_SectionCode" id="o<?php echo $budget_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->BudgetLine->Visible) { // BudgetLine ?>
		<td data-name="BudgetLine">
<span id="el$rowindex$_budget_BudgetLine" class="form-group budget_BudgetLine"></span>
<input type="hidden" data-table="budget" data-field="x_BudgetLine" name="o<?php echo $budget_list->RowIndex ?>_BudgetLine" id="o<?php echo $budget_list->RowIndex ?>_BudgetLine" value="<?php echo HtmlEncode($budget_list->BudgetLine->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if ($budget_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_ProgramCode" class="form-group budget_ProgramCode">
<span<?php echo $budget_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_ProgramCode" name="x<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_ProgramCode" class="form-group budget_ProgramCode">
<?php $budget_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_ProgramCode"><?php echo EmptyValue(strval($budget_list->ProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->ProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->ProgramCode->ReadOnly || $budget_list->ProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_ProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->ProgramCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_ProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_ProgramCode" id="x<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo $budget_list->ProgramCode->CurrentValue ?>"<?php echo $budget_list->ProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_ProgramCode" name="o<?php echo $budget_list->RowIndex ?>_ProgramCode" id="o<?php echo $budget_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($budget_list->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<?php if ($budget_list->SubProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_SubProgramCode" class="form-group budget_SubProgramCode">
<span<?php echo $budget_list->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_list->SubProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" name="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_list->SubProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_SubProgramCode" class="form-group budget_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $budget_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($budget_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $budget_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($budget_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($budget_list->SubProgramCode->ReadOnly || $budget_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $budget_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $budget_list->SubProgramCode->Lookup->getParamTag($budget_list, "p_x" . $budget_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $budget_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" id="x<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo $budget_list->SubProgramCode->CurrentValue ?>"<?php echo $budget_list->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="budget" data-field="x_SubProgramCode" name="o<?php echo $budget_list->RowIndex ?>_SubProgramCode" id="o<?php echo $budget_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($budget_list->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget">
<span id="el$rowindex$_budget_ApprovedBudget" class="form-group budget_ApprovedBudget">
<input type="text" data-table="budget" data-field="x_ApprovedBudget" name="x<?php echo $budget_list->RowIndex ?>_ApprovedBudget" id="x<?php echo $budget_list->RowIndex ?>_ApprovedBudget" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($budget_list->ApprovedBudget->getPlaceHolder()) ?>" value="<?php echo $budget_list->ApprovedBudget->EditValue ?>"<?php echo $budget_list->ApprovedBudget->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget" data-field="x_ApprovedBudget" name="o<?php echo $budget_list->RowIndex ?>_ApprovedBudget" id="o<?php echo $budget_list->RowIndex ?>_ApprovedBudget" value="<?php echo HtmlEncode($budget_list->ApprovedBudget->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_list->ListOptions->render("body", "right", $budget_list->RowIndex);
?>
<script>
loadjs.ready(["fbudgetlist", "load"], function() {
	fbudgetlist.updateLists(<?php echo $budget_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$budget->RowType = ROWTYPE_AGGREGATE;
$budget->resetAttributes();
$budget_list->renderRow();
?>
<?php if ($budget_list->TotalRecords > 0 && !$budget_list->isGridAdd() && !$budget_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$budget_list->renderListOptions();

// Render list options (footer, left)
$budget_list->ListOptions->render("footer", "left");
?>
	<?php if ($budget_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" class="<?php echo $budget_list->OutcomeCode->footerCellClass() ?>"><span id="elf_budget_OutcomeCode" class="budget_OutcomeCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" class="<?php echo $budget_list->OutputCode->footerCellClass() ?>"><span id="elf_budget_OutputCode" class="budget_OutputCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" class="<?php echo $budget_list->ActionCode->footerCellClass() ?>"><span id="elf_budget_ActionCode" class="budget_ActionCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode" class="<?php echo $budget_list->DetailedActionCode->footerCellClass() ?>"><span id="elf_budget_DetailedActionCode" class="budget_DetailedActionCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" class="<?php echo $budget_list->FinancialYear->footerCellClass() ?>"><span id="elf_budget_FinancialYear" class="budget_FinancialYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" class="<?php echo $budget_list->AccountCode->footerCellClass() ?>"><span id="elf_budget_AccountCode" class="budget_AccountCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->MeansOfImplementation->Visible) { // MeansOfImplementation ?>
		<td data-name="MeansOfImplementation" class="<?php echo $budget_list->MeansOfImplementation->footerCellClass() ?>"><span id="elf_budget_MeansOfImplementation" class="budget_MeansOfImplementation">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" class="<?php echo $budget_list->UnitOfMeasure->footerCellClass() ?>"><span id="elf_budget_UnitOfMeasure" class="budget_UnitOfMeasure">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" class="<?php echo $budget_list->Quantity->footerCellClass() ?>"><span id="elf_budget_Quantity" class="budget_Quantity">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency" class="<?php echo $budget_list->Frequency->footerCellClass() ?>"><span id="elf_budget_Frequency" class="budget_Frequency">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" class="<?php echo $budget_list->UnitCost->footerCellClass() ?>"><span id="elf_budget_UnitCost" class="budget_UnitCost">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" class="<?php echo $budget_list->BudgetEstimate->footerCellClass() ?>"><span id="elf_budget_BudgetEstimate" class="budget_BudgetEstimate">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $budget_list->BudgetEstimate->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($budget_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" class="<?php echo $budget_list->LACode->footerCellClass() ?>"><span id="elf_budget_LACode" class="budget_LACode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" class="<?php echo $budget_list->DepartmentCode->footerCellClass() ?>"><span id="elf_budget_DepartmentCode" class="budget_DepartmentCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" class="<?php echo $budget_list->SectionCode->footerCellClass() ?>"><span id="elf_budget_SectionCode" class="budget_SectionCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->BudgetLine->Visible) { // BudgetLine ?>
		<td data-name="BudgetLine" class="<?php echo $budget_list->BudgetLine->footerCellClass() ?>"><span id="elf_budget_BudgetLine" class="budget_BudgetLine">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" class="<?php echo $budget_list->ProgramCode->footerCellClass() ?>"><span id="elf_budget_ProgramCode" class="budget_ProgramCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" class="<?php echo $budget_list->SubProgramCode->footerCellClass() ?>"><span id="elf_budget_SubProgramCode" class="budget_SubProgramCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($budget_list->ApprovedBudget->Visible) { // ApprovedBudget ?>
		<td data-name="ApprovedBudget" class="<?php echo $budget_list->ApprovedBudget->footerCellClass() ?>"><span id="elf_budget_ApprovedBudget" class="budget_ApprovedBudget">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$budget_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($budget_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $budget_list->FormKeyCountName ?>" id="<?php echo $budget_list->FormKeyCountName ?>" value="<?php echo $budget_list->KeyCount ?>">
<?php echo $budget_list->MultiSelectKey ?>
<?php } ?>
<?php if ($budget_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $budget_list->FormKeyCountName ?>" id="<?php echo $budget_list->FormKeyCountName ?>" value="<?php echo $budget_list->KeyCount ?>">
<?php echo $budget_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$budget->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($budget_list->Recordset)
	$budget_list->Recordset->Close();
?>
<?php if (!$budget_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$budget_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($budget_list->TotalRecords == 0 && !$budget->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $budget_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$budget_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$budget_list->isExport()) { ?>
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
$budget_list->terminate();
?>