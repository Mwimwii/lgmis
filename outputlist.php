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
$output_list = new output_list();

// Run the page
$output_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$output_list->isExport()) { ?>
<script>
var foutputlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	foutputlist = currentForm = new ew.Form("foutputlist", "list");
	foutputlist.formKeyCountName = '<?php echo $output_list->FormKeyCountName ?>';

	// Validate form
	foutputlist.validate = function() {
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
			<?php if ($output_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->LACode->caption(), $output_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->DepartmentCode->caption(), $output_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->SectionCode->caption(), $output_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->OutcomeCode->caption(), $output_list->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->ProgramCode->caption(), $output_list->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_list->ProgramCode->errorMessage()) ?>");
			<?php if ($output_list->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->SubProgramCode->caption(), $output_list->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->OutputCode->caption(), $output_list->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->OutputType->caption(), $output_list->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->OutputName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->OutputName->caption(), $output_list->OutputName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->DeliveryDate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->DeliveryDate->caption(), $output_list->DeliveryDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_list->DeliveryDate->errorMessage()) ?>");
			<?php if ($output_list->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->FinancialYear->caption(), $output_list->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_list->FinancialYear->errorMessage()) ?>");
			<?php if ($output_list->OutputDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->OutputDescription->caption(), $output_list->OutputDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->OutputMeansOfVerification->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputMeansOfVerification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->OutputMeansOfVerification->caption(), $output_list->OutputMeansOfVerification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->ResponsibleOfficer->caption(), $output_list->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->Clients->Required) { ?>
				elm = this.getElements("x" + infix + "_Clients");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->Clients->caption(), $output_list->Clients->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->Beneficiaries->Required) { ?>
				elm = this.getElements("x" + infix + "_Beneficiaries");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->Beneficiaries->caption(), $output_list->Beneficiaries->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->OutputStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->OutputStatus->caption(), $output_list->OutputStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_list->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->TargetAmount->caption(), $output_list->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_list->TargetAmount->errorMessage()) ?>");
			<?php if ($output_list->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->ActualAmount->caption(), $output_list->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_list->ActualAmount->errorMessage()) ?>");
			<?php if ($output_list->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_list->PercentAchieved->caption(), $output_list->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_list->PercentAchieved->errorMessage()) ?>");

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
	foutputlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputType", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeliveryDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputDescription", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputMeansOfVerification", false)) return false;
		if (ew.valueChanged(fobj, infix, "ResponsibleOfficer", false)) return false;
		if (ew.valueChanged(fobj, infix, "Clients", false)) return false;
		if (ew.valueChanged(fobj, infix, "Beneficiaries", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "TargetAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "PercentAchieved", false)) return false;
		return true;
	}

	// Form_CustomValidate
	foutputlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutputlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutputlist.lists["x_LACode"] = <?php echo $output_list->LACode->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_LACode"].options = <?php echo JsonEncode($output_list->LACode->lookupOptions()) ?>;
	foutputlist.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputlist.lists["x_DepartmentCode"] = <?php echo $output_list->DepartmentCode->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_list->DepartmentCode->lookupOptions()) ?>;
	foutputlist.lists["x_SectionCode"] = <?php echo $output_list->SectionCode->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_SectionCode"].options = <?php echo JsonEncode($output_list->SectionCode->lookupOptions()) ?>;
	foutputlist.lists["x_OutcomeCode"] = <?php echo $output_list->OutcomeCode->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_list->OutcomeCode->lookupOptions()) ?>;
	foutputlist.lists["x_ProgramCode"] = <?php echo $output_list->ProgramCode->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_list->ProgramCode->lookupOptions()) ?>;
	foutputlist.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputlist.lists["x_SubProgramCode"] = <?php echo $output_list->SubProgramCode->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_list->SubProgramCode->lookupOptions()) ?>;
	foutputlist.lists["x_OutputCode"] = <?php echo $output_list->OutputCode->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_OutputCode"].options = <?php echo JsonEncode($output_list->OutputCode->lookupOptions()) ?>;
	foutputlist.lists["x_OutputType"] = <?php echo $output_list->OutputType->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_OutputType"].options = <?php echo JsonEncode($output_list->OutputType->lookupOptions()) ?>;
	foutputlist.lists["x_OutputStatus"] = <?php echo $output_list->OutputStatus->Lookup->toClientList($output_list) ?>;
	foutputlist.lists["x_OutputStatus"].options = <?php echo JsonEncode($output_list->OutputStatus->lookupOptions()) ?>;
	loadjs.done("foutputlist");
});
var foutputlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	foutputlistsrch = currentSearchForm = new ew.Form("foutputlistsrch");

	// Dynamic selection lists
	// Filters

	foutputlistsrch.filterList = <?php echo $output_list->getFilterList() ?>;

	// Init search panel as collapsed
	foutputlistsrch.initSearchPanel = true;
	loadjs.done("foutputlistsrch");
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
<?php if (!$output_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($output_list->TotalRecords > 0 && $output_list->ExportOptions->visible()) { ?>
<?php $output_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($output_list->ImportOptions->visible()) { ?>
<?php $output_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($output_list->SearchOptions->visible()) { ?>
<?php $output_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($output_list->FilterOptions->visible()) { ?>
<?php $output_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$output_list->isExport() || Config("EXPORT_MASTER_RECORD") && $output_list->isExport("print")) { ?>
<?php
if ($output_list->DbMasterFilter != "" && $output->getCurrentMasterTable() == "outcome") {
	if ($output_list->MasterRecordExists) {
		include_once "outcomemaster.php";
	}
}
?>
<?php } ?>
<?php
$output_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$output_list->isExport() && !$output->CurrentAction) { ?>
<form name="foutputlistsrch" id="foutputlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="foutputlistsrch-search-panel" class="<?php echo $output_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="output">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $output_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($output_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($output_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $output_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($output_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($output_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($output_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($output_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $output_list->showPageHeader(); ?>
<?php
$output_list->showMessage();
?>
<?php if ($output_list->TotalRecords > 0 || $output->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($output_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> output">
<?php if (!$output_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$output_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $output_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="foutputlist" id="foutputlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output">
<?php if ($output->getCurrentMasterTable() == "outcome" && $output->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="outcome">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($output_list->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($output_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($output_list->DepartmentCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_output" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($output_list->TotalRecords > 0 || $output_list->isGridEdit()) { ?>
<table id="tbl_outputlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$output->RowType = ROWTYPE_HEADER;

// Render list options
$output_list->renderListOptions();

// Render list options (header, left)
$output_list->ListOptions->render("header", "left");
?>
<?php if ($output_list->LACode->Visible) { // LACode ?>
	<?php if ($output_list->SortUrl($output_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $output_list->LACode->headerCellClass() ?>"><div id="elh_output_LACode" class="output_LACode"><div class="ew-table-header-caption"><?php echo $output_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $output_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->LACode) ?>', 1);"><div id="elh_output_LACode" class="output_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($output_list->SortUrl($output_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_list->DepartmentCode->headerCellClass() ?>"><div id="elh_output_DepartmentCode" class="output_DepartmentCode"><div class="ew-table-header-caption"><?php echo $output_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->DepartmentCode) ?>', 1);"><div id="elh_output_DepartmentCode" class="output_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($output_list->SortUrl($output_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $output_list->SectionCode->headerCellClass() ?>"><div id="elh_output_SectionCode" class="output_SectionCode"><div class="ew-table-header-caption"><?php echo $output_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $output_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->SectionCode) ?>', 1);"><div id="elh_output_SectionCode" class="output_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($output_list->SortUrl($output_list->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_list->OutcomeCode->headerCellClass() ?>"><div id="elh_output_OutcomeCode" class="output_OutcomeCode"><div class="ew-table-header-caption"><?php echo $output_list->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_list->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->OutcomeCode) ?>', 1);"><div id="elh_output_OutcomeCode" class="output_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($output_list->SortUrl($output_list->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $output_list->ProgramCode->headerCellClass() ?>"><div id="elh_output_ProgramCode" class="output_ProgramCode"><div class="ew-table-header-caption"><?php echo $output_list->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $output_list->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->ProgramCode) ?>', 1);"><div id="elh_output_ProgramCode" class="output_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($output_list->SortUrl($output_list->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_list->SubProgramCode->headerCellClass() ?>"><div id="elh_output_SubProgramCode" class="output_SubProgramCode"><div class="ew-table-header-caption"><?php echo $output_list->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_list->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->SubProgramCode) ?>', 1);"><div id="elh_output_SubProgramCode" class="output_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->OutputCode->Visible) { // OutputCode ?>
	<?php if ($output_list->SortUrl($output_list->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $output_list->OutputCode->headerCellClass() ?>"><div id="elh_output_OutputCode" class="output_OutputCode"><div class="ew-table-header-caption"><?php echo $output_list->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $output_list->OutputCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->OutputCode) ?>', 1);"><div id="elh_output_OutputCode" class="output_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->OutputType->Visible) { // OutputType ?>
	<?php if ($output_list->SortUrl($output_list->OutputType) == "") { ?>
		<th data-name="OutputType" class="<?php echo $output_list->OutputType->headerCellClass() ?>"><div id="elh_output_OutputType" class="output_OutputType"><div class="ew-table-header-caption"><?php echo $output_list->OutputType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputType" class="<?php echo $output_list->OutputType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->OutputType) ?>', 1);"><div id="elh_output_OutputType" class="output_OutputType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->OutputType->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->OutputType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->OutputType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->OutputName->Visible) { // OutputName ?>
	<?php if ($output_list->SortUrl($output_list->OutputName) == "") { ?>
		<th data-name="OutputName" class="<?php echo $output_list->OutputName->headerCellClass() ?>"><div id="elh_output_OutputName" class="output_OutputName"><div class="ew-table-header-caption"><?php echo $output_list->OutputName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputName" class="<?php echo $output_list->OutputName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->OutputName) ?>', 1);"><div id="elh_output_OutputName" class="output_OutputName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->OutputName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_list->OutputName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->OutputName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->DeliveryDate->Visible) { // DeliveryDate ?>
	<?php if ($output_list->SortUrl($output_list->DeliveryDate) == "") { ?>
		<th data-name="DeliveryDate" class="<?php echo $output_list->DeliveryDate->headerCellClass() ?>"><div id="elh_output_DeliveryDate" class="output_DeliveryDate"><div class="ew-table-header-caption"><?php echo $output_list->DeliveryDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeliveryDate" class="<?php echo $output_list->DeliveryDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->DeliveryDate) ?>', 1);"><div id="elh_output_DeliveryDate" class="output_DeliveryDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->DeliveryDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->DeliveryDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->DeliveryDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($output_list->SortUrl($output_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $output_list->FinancialYear->headerCellClass() ?>"><div id="elh_output_FinancialYear" class="output_FinancialYear"><div class="ew-table-header-caption"><?php echo $output_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $output_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->FinancialYear) ?>', 1);"><div id="elh_output_FinancialYear" class="output_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->OutputDescription->Visible) { // OutputDescription ?>
	<?php if ($output_list->SortUrl($output_list->OutputDescription) == "") { ?>
		<th data-name="OutputDescription" class="<?php echo $output_list->OutputDescription->headerCellClass() ?>"><div id="elh_output_OutputDescription" class="output_OutputDescription"><div class="ew-table-header-caption"><?php echo $output_list->OutputDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputDescription" class="<?php echo $output_list->OutputDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->OutputDescription) ?>', 1);"><div id="elh_output_OutputDescription" class="output_OutputDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->OutputDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_list->OutputDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->OutputDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
	<?php if ($output_list->SortUrl($output_list->OutputMeansOfVerification) == "") { ?>
		<th data-name="OutputMeansOfVerification" class="<?php echo $output_list->OutputMeansOfVerification->headerCellClass() ?>"><div id="elh_output_OutputMeansOfVerification" class="output_OutputMeansOfVerification"><div class="ew-table-header-caption"><?php echo $output_list->OutputMeansOfVerification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputMeansOfVerification" class="<?php echo $output_list->OutputMeansOfVerification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->OutputMeansOfVerification) ?>', 1);"><div id="elh_output_OutputMeansOfVerification" class="output_OutputMeansOfVerification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->OutputMeansOfVerification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_list->OutputMeansOfVerification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->OutputMeansOfVerification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<?php if ($output_list->SortUrl($output_list->ResponsibleOfficer) == "") { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $output_list->ResponsibleOfficer->headerCellClass() ?>"><div id="elh_output_ResponsibleOfficer" class="output_ResponsibleOfficer"><div class="ew-table-header-caption"><?php echo $output_list->ResponsibleOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResponsibleOfficer" class="<?php echo $output_list->ResponsibleOfficer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->ResponsibleOfficer) ?>', 1);"><div id="elh_output_ResponsibleOfficer" class="output_ResponsibleOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->ResponsibleOfficer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_list->ResponsibleOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->ResponsibleOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->Clients->Visible) { // Clients ?>
	<?php if ($output_list->SortUrl($output_list->Clients) == "") { ?>
		<th data-name="Clients" class="<?php echo $output_list->Clients->headerCellClass() ?>"><div id="elh_output_Clients" class="output_Clients"><div class="ew-table-header-caption"><?php echo $output_list->Clients->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Clients" class="<?php echo $output_list->Clients->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->Clients) ?>', 1);"><div id="elh_output_Clients" class="output_Clients">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->Clients->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_list->Clients->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->Clients->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->Beneficiaries->Visible) { // Beneficiaries ?>
	<?php if ($output_list->SortUrl($output_list->Beneficiaries) == "") { ?>
		<th data-name="Beneficiaries" class="<?php echo $output_list->Beneficiaries->headerCellClass() ?>"><div id="elh_output_Beneficiaries" class="output_Beneficiaries"><div class="ew-table-header-caption"><?php echo $output_list->Beneficiaries->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Beneficiaries" class="<?php echo $output_list->Beneficiaries->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->Beneficiaries) ?>', 1);"><div id="elh_output_Beneficiaries" class="output_Beneficiaries">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->Beneficiaries->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_list->Beneficiaries->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->Beneficiaries->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->OutputStatus->Visible) { // OutputStatus ?>
	<?php if ($output_list->SortUrl($output_list->OutputStatus) == "") { ?>
		<th data-name="OutputStatus" class="<?php echo $output_list->OutputStatus->headerCellClass() ?>"><div id="elh_output_OutputStatus" class="output_OutputStatus"><div class="ew-table-header-caption"><?php echo $output_list->OutputStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputStatus" class="<?php echo $output_list->OutputStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->OutputStatus) ?>', 1);"><div id="elh_output_OutputStatus" class="output_OutputStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->OutputStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->OutputStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->OutputStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->TargetAmount->Visible) { // TargetAmount ?>
	<?php if ($output_list->SortUrl($output_list->TargetAmount) == "") { ?>
		<th data-name="TargetAmount" class="<?php echo $output_list->TargetAmount->headerCellClass() ?>"><div id="elh_output_TargetAmount" class="output_TargetAmount"><div class="ew-table-header-caption"><?php echo $output_list->TargetAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TargetAmount" class="<?php echo $output_list->TargetAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->TargetAmount) ?>', 1);"><div id="elh_output_TargetAmount" class="output_TargetAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->TargetAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->TargetAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->TargetAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($output_list->SortUrl($output_list->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $output_list->ActualAmount->headerCellClass() ?>"><div id="elh_output_ActualAmount" class="output_ActualAmount"><div class="ew-table-header-caption"><?php echo $output_list->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $output_list->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->ActualAmount) ?>', 1);"><div id="elh_output_ActualAmount" class="output_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_list->PercentAchieved->Visible) { // PercentAchieved ?>
	<?php if ($output_list->SortUrl($output_list->PercentAchieved) == "") { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_list->PercentAchieved->headerCellClass() ?>"><div id="elh_output_PercentAchieved" class="output_PercentAchieved"><div class="ew-table-header-caption"><?php echo $output_list->PercentAchieved->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_list->PercentAchieved->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_list->SortUrl($output_list->PercentAchieved) ?>', 1);"><div id="elh_output_PercentAchieved" class="output_PercentAchieved">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_list->PercentAchieved->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_list->PercentAchieved->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_list->PercentAchieved->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$output_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($output_list->ExportAll && $output_list->isExport()) {
	$output_list->StopRecord = $output_list->TotalRecords;
} else {

	// Set the last record to display
	if ($output_list->TotalRecords > $output_list->StartRecord + $output_list->DisplayRecords - 1)
		$output_list->StopRecord = $output_list->StartRecord + $output_list->DisplayRecords - 1;
	else
		$output_list->StopRecord = $output_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($output->isConfirm() || $output_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($output_list->FormKeyCountName) && ($output_list->isGridAdd() || $output_list->isGridEdit() || $output->isConfirm())) {
		$output_list->KeyCount = $CurrentForm->getValue($output_list->FormKeyCountName);
		$output_list->StopRecord = $output_list->StartRecord + $output_list->KeyCount - 1;
	}
}
$output_list->RecordCount = $output_list->StartRecord - 1;
if ($output_list->Recordset && !$output_list->Recordset->EOF) {
	$output_list->Recordset->moveFirst();
	$selectLimit = $output_list->UseSelectLimit;
	if (!$selectLimit && $output_list->StartRecord > 1)
		$output_list->Recordset->move($output_list->StartRecord - 1);
} elseif (!$output->AllowAddDeleteRow && $output_list->StopRecord == 0) {
	$output_list->StopRecord = $output->GridAddRowCount;
}

// Initialize aggregate
$output->RowType = ROWTYPE_AGGREGATEINIT;
$output->resetAttributes();
$output_list->renderRow();
if ($output_list->isGridAdd())
	$output_list->RowIndex = 0;
if ($output_list->isGridEdit())
	$output_list->RowIndex = 0;
while ($output_list->RecordCount < $output_list->StopRecord) {
	$output_list->RecordCount++;
	if ($output_list->RecordCount >= $output_list->StartRecord) {
		$output_list->RowCount++;
		if ($output_list->isGridAdd() || $output_list->isGridEdit() || $output->isConfirm()) {
			$output_list->RowIndex++;
			$CurrentForm->Index = $output_list->RowIndex;
			if ($CurrentForm->hasValue($output_list->FormActionName) && ($output->isConfirm() || $output_list->EventCancelled))
				$output_list->RowAction = strval($CurrentForm->getValue($output_list->FormActionName));
			elseif ($output_list->isGridAdd())
				$output_list->RowAction = "insert";
			else
				$output_list->RowAction = "";
		}

		// Set up key count
		$output_list->KeyCount = $output_list->RowIndex;

		// Init row class and style
		$output->resetAttributes();
		$output->CssClass = "";
		if ($output_list->isGridAdd()) {
			$output_list->loadRowValues(); // Load default values
		} else {
			$output_list->loadRowValues($output_list->Recordset); // Load row values
		}
		$output->RowType = ROWTYPE_VIEW; // Render view
		if ($output_list->isGridAdd()) // Grid add
			$output->RowType = ROWTYPE_ADD; // Render add
		if ($output_list->isGridAdd() && $output->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$output_list->restoreCurrentRowFormValues($output_list->RowIndex); // Restore form values
		if ($output_list->isGridEdit()) { // Grid edit
			if ($output->EventCancelled)
				$output_list->restoreCurrentRowFormValues($output_list->RowIndex); // Restore form values
			if ($output_list->RowAction == "insert")
				$output->RowType = ROWTYPE_ADD; // Render add
			else
				$output->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($output_list->isGridEdit() && ($output->RowType == ROWTYPE_EDIT || $output->RowType == ROWTYPE_ADD) && $output->EventCancelled) // Update failed
			$output_list->restoreCurrentRowFormValues($output_list->RowIndex); // Restore form values
		if ($output->RowType == ROWTYPE_EDIT) // Edit row
			$output_list->EditRowCount++;

		// Set up row id / data-rowindex
		$output->RowAttrs->merge(["data-rowindex" => $output_list->RowCount, "id" => "r" . $output_list->RowCount . "_output", "data-rowtype" => $output->RowType]);

		// Render row
		$output_list->renderRow();

		// Render list options
		$output_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($output_list->RowAction != "delete" && $output_list->RowAction != "insertdelete" && !($output_list->RowAction == "insert" && $output->isConfirm() && $output_list->emptyRow())) {
?>
	<tr <?php echo $output->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_list->ListOptions->render("body", "left", $output_list->RowCount);
?>
	<?php if ($output_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $output_list->LACode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_LACode" class="form-group">
<span<?php echo $output_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_LACode" name="x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_LACode" class="form-group">
<?php
$onchange = $output_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_list->RowIndex ?>_LACode" id="sv_x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_list->LACode->getPlaceHolder()) ?>"<?php echo $output_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->LACode->ReadOnly || $output_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_LACode" id="x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputlist"], function() {
	foutputlist.createAutoSuggest({"id":"x<?php echo $output_list->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $output_list->LACode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_LACode" name="o<?php echo $output_list->RowIndex ?>_LACode" id="o<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_LACode" class="form-group">
<span<?php echo $output_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_LACode" name="x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_LACode" class="form-group">
<?php
$onchange = $output_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_list->RowIndex ?>_LACode" id="sv_x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_list->LACode->getPlaceHolder()) ?>"<?php echo $output_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->LACode->ReadOnly || $output_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_LACode" id="x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputlist"], function() {
	foutputlist.createAutoSuggest({"id":"x<?php echo $output_list->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $output_list->LACode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_LACode">
<span<?php echo $output_list->LACode->viewAttributes() ?>><?php echo $output_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $output_list->DepartmentCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DepartmentCode" class="form-group">
<span<?php echo $output_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_DepartmentCode" name="x<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DepartmentCode" class="form-group">
<?php $output_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($output_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->DepartmentCode->ReadOnly || $output_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->DepartmentCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_DepartmentCode" id="x<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo $output_list->DepartmentCode->CurrentValue ?>"<?php echo $output_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="o<?php echo $output_list->RowIndex ?>_DepartmentCode" id="o<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DepartmentCode" class="form-group">
<span<?php echo $output_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_DepartmentCode" name="x<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DepartmentCode" class="form-group">
<?php $output_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($output_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->DepartmentCode->ReadOnly || $output_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->DepartmentCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_DepartmentCode" id="x<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo $output_list->DepartmentCode->CurrentValue ?>"<?php echo $output_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DepartmentCode">
<span<?php echo $output_list->DepartmentCode->viewAttributes() ?>><?php echo $output_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $output_list->SectionCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($output_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->SectionCode->ReadOnly || $output_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->SectionCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_SectionCode" id="x<?php echo $output_list->RowIndex ?>_SectionCode" value="<?php echo $output_list->SectionCode->CurrentValue ?>"<?php echo $output_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_SectionCode" name="o<?php echo $output_list->RowIndex ?>_SectionCode" id="o<?php echo $output_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_SectionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($output_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->SectionCode->ReadOnly || $output_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->SectionCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_SectionCode" id="x<?php echo $output_list->RowIndex ?>_SectionCode" value="<?php echo $output_list->SectionCode->CurrentValue ?>"<?php echo $output_list->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_SectionCode">
<span<?php echo $output_list->SectionCode->viewAttributes() ?>><?php echo $output_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $output_list->OutcomeCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($output_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutcomeCode" class="form-group">
<span<?php echo $output_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_OutcomeCode" name="x<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutcomeCode" class="form-group">
<?php $output_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($output_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->OutcomeCode->ReadOnly || $output_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->OutcomeCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_OutcomeCode" id="x<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo $output_list->OutcomeCode->CurrentValue ?>"<?php echo $output_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="o<?php echo $output_list->RowIndex ?>_OutcomeCode" id="o<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_list->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($output_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutcomeCode" class="form-group">
<span<?php echo $output_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_OutcomeCode" name="x<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutcomeCode" class="form-group">
<?php $output_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($output_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->OutcomeCode->ReadOnly || $output_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->OutcomeCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_OutcomeCode" id="x<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo $output_list->OutcomeCode->CurrentValue ?>"<?php echo $output_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutcomeCode">
<span<?php echo $output_list->OutcomeCode->viewAttributes() ?>><?php echo $output_list->OutcomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $output_list->ProgramCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ProgramCode" class="form-group">
<?php
$onchange = $output_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_list->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_list->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_list->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->ProgramCode->ReadOnly || $output_list->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_ProgramCode" id="x<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputlist"], function() {
	foutputlist.createAutoSuggest({"id":"x<?php echo $output_list->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_list->ProgramCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_ProgramCode") ?>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="o<?php echo $output_list->RowIndex ?>_ProgramCode" id="o<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_list->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ProgramCode" class="form-group">
<?php
$onchange = $output_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_list->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_list->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_list->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->ProgramCode->ReadOnly || $output_list->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_ProgramCode" id="x<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputlist"], function() {
	foutputlist.createAutoSuggest({"id":"x<?php echo $output_list->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_list->ProgramCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ProgramCode">
<span<?php echo $output_list->ProgramCode->viewAttributes() ?>><?php echo $output_list->ProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $output_list->SubProgramCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($output_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->SubProgramCode->ReadOnly || $output_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->SubProgramCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_SubProgramCode" id="x<?php echo $output_list->RowIndex ?>_SubProgramCode" value="<?php echo $output_list->SubProgramCode->CurrentValue ?>"<?php echo $output_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="o<?php echo $output_list->RowIndex ?>_SubProgramCode" id="o<?php echo $output_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_list->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($output_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->SubProgramCode->ReadOnly || $output_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->SubProgramCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_SubProgramCode" id="x<?php echo $output_list->RowIndex ?>_SubProgramCode" value="<?php echo $output_list->SubProgramCode->CurrentValue ?>"<?php echo $output_list->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_SubProgramCode">
<span<?php echo $output_list->SubProgramCode->viewAttributes() ?>><?php echo $output_list->SubProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $output_list->OutputCode->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputCode" class="form-group"></span>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="o<?php echo $output_list->RowIndex ?>_OutputCode" id="o<?php echo $output_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_list->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputCode" class="form-group">
<span<?php echo $output_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->OutputCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="x<?php echo $output_list->RowIndex ?>_OutputCode" id="x<?php echo $output_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_list->OutputCode->CurrentValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputCode">
<span<?php echo $output_list->OutputCode->viewAttributes() ?>><?php echo $output_list->OutputCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType" <?php echo $output_list->OutputType->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_list->OutputType->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_list->RowIndex ?>_OutputType" name="x<?php echo $output_list->RowIndex ?>_OutputType"<?php echo $output_list->OutputType->editAttributes() ?>>
			<?php echo $output_list->OutputType->selectOptionListHtml("x{$output_list->RowIndex}_OutputType") ?>
		</select>
</div>
<?php echo $output_list->OutputType->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutputType") ?>
</span>
<input type="hidden" data-table="output" data-field="x_OutputType" name="o<?php echo $output_list->RowIndex ?>_OutputType" id="o<?php echo $output_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_list->OutputType->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_list->OutputType->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_list->RowIndex ?>_OutputType" name="x<?php echo $output_list->RowIndex ?>_OutputType"<?php echo $output_list->OutputType->editAttributes() ?>>
			<?php echo $output_list->OutputType->selectOptionListHtml("x{$output_list->RowIndex}_OutputType") ?>
		</select>
</div>
<?php echo $output_list->OutputType->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutputType") ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputType">
<span<?php echo $output_list->OutputType->viewAttributes() ?>><?php echo $output_list->OutputType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->OutputName->Visible) { // OutputName ?>
		<td data-name="OutputName" <?php echo $output_list->OutputName->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputName" class="form-group">
<textarea data-table="output" data-field="x_OutputName" name="x<?php echo $output_list->RowIndex ?>_OutputName" id="x<?php echo $output_list->RowIndex ?>_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->OutputName->getPlaceHolder()) ?>"<?php echo $output_list->OutputName->editAttributes() ?>><?php echo $output_list->OutputName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputName" name="o<?php echo $output_list->RowIndex ?>_OutputName" id="o<?php echo $output_list->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_list->OutputName->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputName" class="form-group">
<textarea data-table="output" data-field="x_OutputName" name="x<?php echo $output_list->RowIndex ?>_OutputName" id="x<?php echo $output_list->RowIndex ?>_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->OutputName->getPlaceHolder()) ?>"<?php echo $output_list->OutputName->editAttributes() ?>><?php echo $output_list->OutputName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputName">
<span<?php echo $output_list->OutputName->viewAttributes() ?>><?php echo $output_list->OutputName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->DeliveryDate->Visible) { // DeliveryDate ?>
		<td data-name="DeliveryDate" <?php echo $output_list->DeliveryDate->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DeliveryDate" class="form-group">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_list->RowIndex ?>_DeliveryDate" id="x<?php echo $output_list->RowIndex ?>_DeliveryDate" placeholder="<?php echo HtmlEncode($output_list->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_list->DeliveryDate->EditValue ?>"<?php echo $output_list->DeliveryDate->editAttributes() ?>>
<?php if (!$output_list->DeliveryDate->ReadOnly && !$output_list->DeliveryDate->Disabled && !isset($output_list->DeliveryDate->EditAttrs["readonly"]) && !isset($output_list->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputlist", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputlist", "x<?php echo $output_list->RowIndex ?>_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="o<?php echo $output_list->RowIndex ?>_DeliveryDate" id="o<?php echo $output_list->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_list->DeliveryDate->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DeliveryDate" class="form-group">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_list->RowIndex ?>_DeliveryDate" id="x<?php echo $output_list->RowIndex ?>_DeliveryDate" placeholder="<?php echo HtmlEncode($output_list->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_list->DeliveryDate->EditValue ?>"<?php echo $output_list->DeliveryDate->editAttributes() ?>>
<?php if (!$output_list->DeliveryDate->ReadOnly && !$output_list->DeliveryDate->Disabled && !isset($output_list->DeliveryDate->EditAttrs["readonly"]) && !isset($output_list->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputlist", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputlist", "x<?php echo $output_list->RowIndex ?>_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_DeliveryDate">
<span<?php echo $output_list->DeliveryDate->viewAttributes() ?>><?php echo $output_list->DeliveryDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $output_list->FinancialYear->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_FinancialYear" class="form-group">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_list->RowIndex ?>_FinancialYear" id="x<?php echo $output_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_list->FinancialYear->EditValue ?>"<?php echo $output_list->FinancialYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="o<?php echo $output_list->RowIndex ?>_FinancialYear" id="o<?php echo $output_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_list->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_FinancialYear" class="form-group">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_list->RowIndex ?>_FinancialYear" id="x<?php echo $output_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_list->FinancialYear->EditValue ?>"<?php echo $output_list->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_FinancialYear">
<span<?php echo $output_list->FinancialYear->viewAttributes() ?>><?php echo $output_list->FinancialYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->OutputDescription->Visible) { // OutputDescription ?>
		<td data-name="OutputDescription" <?php echo $output_list->OutputDescription->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputDescription" class="form-group">
<textarea data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_list->RowIndex ?>_OutputDescription" id="x<?php echo $output_list->RowIndex ?>_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_list->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_list->OutputDescription->editAttributes() ?>><?php echo $output_list->OutputDescription->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="o<?php echo $output_list->RowIndex ?>_OutputDescription" id="o<?php echo $output_list->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_list->OutputDescription->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputDescription" class="form-group">
<textarea data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_list->RowIndex ?>_OutputDescription" id="x<?php echo $output_list->RowIndex ?>_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_list->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_list->OutputDescription->editAttributes() ?>><?php echo $output_list->OutputDescription->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputDescription">
<span<?php echo $output_list->OutputDescription->viewAttributes() ?>><?php echo $output_list->OutputDescription->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
		<td data-name="OutputMeansOfVerification" <?php echo $output_list->OutputMeansOfVerification->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputMeansOfVerification" class="form-group">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_list->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_list->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_list->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="o<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" id="o<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_list->OutputMeansOfVerification->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputMeansOfVerification" class="form-group">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_list->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_list->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_list->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputMeansOfVerification">
<span<?php echo $output_list->OutputMeansOfVerification->viewAttributes() ?>><?php echo $output_list->OutputMeansOfVerification->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer" <?php echo $output_list->ResponsibleOfficer->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ResponsibleOfficer" class="form-group">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_list->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_list->ResponsibleOfficer->EditValue ?>"<?php echo $output_list->ResponsibleOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="o<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_list->ResponsibleOfficer->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ResponsibleOfficer" class="form-group">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_list->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_list->ResponsibleOfficer->EditValue ?>"<?php echo $output_list->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ResponsibleOfficer">
<span<?php echo $output_list->ResponsibleOfficer->viewAttributes() ?>><?php echo $output_list->ResponsibleOfficer->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->Clients->Visible) { // Clients ?>
		<td data-name="Clients" <?php echo $output_list->Clients->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_Clients" class="form-group">
<textarea data-table="output" data-field="x_Clients" name="x<?php echo $output_list->RowIndex ?>_Clients" id="x<?php echo $output_list->RowIndex ?>_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->Clients->getPlaceHolder()) ?>"<?php echo $output_list->Clients->editAttributes() ?>><?php echo $output_list->Clients->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_Clients" name="o<?php echo $output_list->RowIndex ?>_Clients" id="o<?php echo $output_list->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_list->Clients->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_Clients" class="form-group">
<textarea data-table="output" data-field="x_Clients" name="x<?php echo $output_list->RowIndex ?>_Clients" id="x<?php echo $output_list->RowIndex ?>_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->Clients->getPlaceHolder()) ?>"<?php echo $output_list->Clients->editAttributes() ?>><?php echo $output_list->Clients->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_Clients">
<span<?php echo $output_list->Clients->viewAttributes() ?>><?php echo $output_list->Clients->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->Beneficiaries->Visible) { // Beneficiaries ?>
		<td data-name="Beneficiaries" <?php echo $output_list->Beneficiaries->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_Beneficiaries" class="form-group">
<textarea data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_list->RowIndex ?>_Beneficiaries" id="x<?php echo $output_list->RowIndex ?>_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_list->Beneficiaries->editAttributes() ?>><?php echo $output_list->Beneficiaries->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="o<?php echo $output_list->RowIndex ?>_Beneficiaries" id="o<?php echo $output_list->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_list->Beneficiaries->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_Beneficiaries" class="form-group">
<textarea data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_list->RowIndex ?>_Beneficiaries" id="x<?php echo $output_list->RowIndex ?>_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_list->Beneficiaries->editAttributes() ?>><?php echo $output_list->Beneficiaries->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_Beneficiaries">
<span<?php echo $output_list->Beneficiaries->viewAttributes() ?>><?php echo $output_list->Beneficiaries->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->OutputStatus->Visible) { // OutputStatus ?>
		<td data-name="OutputStatus" <?php echo $output_list->OutputStatus->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_list->OutputStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_list->RowIndex ?>_OutputStatus" name="x<?php echo $output_list->RowIndex ?>_OutputStatus"<?php echo $output_list->OutputStatus->editAttributes() ?>>
			<?php echo $output_list->OutputStatus->selectOptionListHtml("x{$output_list->RowIndex}_OutputStatus") ?>
		</select>
</div>
<?php echo $output_list->OutputStatus->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutputStatus") ?>
</span>
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="o<?php echo $output_list->RowIndex ?>_OutputStatus" id="o<?php echo $output_list->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_list->OutputStatus->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_list->OutputStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_list->RowIndex ?>_OutputStatus" name="x<?php echo $output_list->RowIndex ?>_OutputStatus"<?php echo $output_list->OutputStatus->editAttributes() ?>>
			<?php echo $output_list->OutputStatus->selectOptionListHtml("x{$output_list->RowIndex}_OutputStatus") ?>
		</select>
</div>
<?php echo $output_list->OutputStatus->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutputStatus") ?>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_OutputStatus">
<span<?php echo $output_list->OutputStatus->viewAttributes() ?>><?php echo $output_list->OutputStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount" <?php echo $output_list->TargetAmount->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_TargetAmount" class="form-group">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_list->RowIndex ?>_TargetAmount" id="x<?php echo $output_list->RowIndex ?>_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_list->TargetAmount->EditValue ?>"<?php echo $output_list->TargetAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="o<?php echo $output_list->RowIndex ?>_TargetAmount" id="o<?php echo $output_list->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_list->TargetAmount->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_TargetAmount" class="form-group">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_list->RowIndex ?>_TargetAmount" id="x<?php echo $output_list->RowIndex ?>_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_list->TargetAmount->EditValue ?>"<?php echo $output_list->TargetAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_TargetAmount">
<span<?php echo $output_list->TargetAmount->viewAttributes() ?>><?php echo $output_list->TargetAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $output_list->ActualAmount->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ActualAmount" class="form-group">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_list->RowIndex ?>_ActualAmount" id="x<?php echo $output_list->RowIndex ?>_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_list->ActualAmount->EditValue ?>"<?php echo $output_list->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="o<?php echo $output_list->RowIndex ?>_ActualAmount" id="o<?php echo $output_list->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_list->ActualAmount->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ActualAmount" class="form-group">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_list->RowIndex ?>_ActualAmount" id="x<?php echo $output_list->RowIndex ?>_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_list->ActualAmount->EditValue ?>"<?php echo $output_list->ActualAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_ActualAmount">
<span<?php echo $output_list->ActualAmount->viewAttributes() ?>><?php echo $output_list->ActualAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_list->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved" <?php echo $output_list->PercentAchieved->cellAttributes() ?>>
<?php if ($output->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_PercentAchieved" class="form-group">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_list->RowIndex ?>_PercentAchieved" id="x<?php echo $output_list->RowIndex ?>_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_list->PercentAchieved->EditValue ?>"<?php echo $output_list->PercentAchieved->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="o<?php echo $output_list->RowIndex ?>_PercentAchieved" id="o<?php echo $output_list->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_list->PercentAchieved->OldValue) ?>">
<?php } ?>
<?php if ($output->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_PercentAchieved" class="form-group">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_list->RowIndex ?>_PercentAchieved" id="x<?php echo $output_list->RowIndex ?>_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_list->PercentAchieved->EditValue ?>"<?php echo $output_list->PercentAchieved->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_list->RowCount ?>_output_PercentAchieved">
<span<?php echo $output_list->PercentAchieved->viewAttributes() ?>><?php echo $output_list->PercentAchieved->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_list->ListOptions->render("body", "right", $output_list->RowCount);
?>
	</tr>
<?php if ($output->RowType == ROWTYPE_ADD || $output->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["foutputlist", "load"], function() {
	foutputlist.updateLists(<?php echo $output_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$output_list->isGridAdd())
		if (!$output_list->Recordset->EOF)
			$output_list->Recordset->moveNext();
}
?>
<?php
	if ($output_list->isGridAdd() || $output_list->isGridEdit()) {
		$output_list->RowIndex = '$rowindex$';
		$output_list->loadRowValues();

		// Set row properties
		$output->resetAttributes();
		$output->RowAttrs->merge(["data-rowindex" => $output_list->RowIndex, "id" => "r0_output", "data-rowtype" => ROWTYPE_ADD]);
		$output->RowAttrs->appendClass("ew-template");
		$output->RowType = ROWTYPE_ADD;

		// Render row
		$output_list->renderRow();

		// Render list options
		$output_list->renderListOptions();
		$output_list->StartRowCount = 0;
?>
	<tr <?php echo $output->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_list->ListOptions->render("body", "left", $output_list->RowIndex);
?>
	<?php if ($output_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($output_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_LACode" class="form-group output_LACode">
<span<?php echo $output_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_LACode" name="x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_LACode" class="form-group output_LACode">
<?php
$onchange = $output_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_list->RowIndex ?>_LACode" id="sv_x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_list->LACode->getPlaceHolder()) ?>"<?php echo $output_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->LACode->ReadOnly || $output_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_LACode" id="x<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputlist"], function() {
	foutputlist.createAutoSuggest({"id":"x<?php echo $output_list->RowIndex ?>_LACode","forceSelect":true});
});
</script>
<?php echo $output_list->LACode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_LACode" name="o<?php echo $output_list->RowIndex ?>_LACode" id="o<?php echo $output_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if ($output_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_DepartmentCode" class="form-group output_DepartmentCode">
<span<?php echo $output_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_DepartmentCode" name="x<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_DepartmentCode" class="form-group output_DepartmentCode">
<?php $output_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($output_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->DepartmentCode->ReadOnly || $output_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->DepartmentCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_DepartmentCode" id="x<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo $output_list->DepartmentCode->CurrentValue ?>"<?php echo $output_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" name="o<?php echo $output_list->RowIndex ?>_DepartmentCode" id="o<?php echo $output_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_output_SectionCode" class="form-group output_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_SectionCode"><?php echo EmptyValue(strval($output_list->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->SectionCode->ReadOnly || $output_list->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->SectionCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_SectionCode" id="x<?php echo $output_list->RowIndex ?>_SectionCode" value="<?php echo $output_list->SectionCode->CurrentValue ?>"<?php echo $output_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_SectionCode" name="o<?php echo $output_list->RowIndex ?>_SectionCode" id="o<?php echo $output_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if ($output_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_output_OutcomeCode" class="form-group output_OutcomeCode">
<span<?php echo $output_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $output_list->RowIndex ?>_OutcomeCode" name="x<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_output_OutcomeCode" class="form-group output_OutcomeCode">
<?php $output_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($output_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->OutcomeCode->ReadOnly || $output_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->OutcomeCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_OutcomeCode" id="x<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo $output_list->OutcomeCode->CurrentValue ?>"<?php echo $output_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" name="o<?php echo $output_list->RowIndex ?>_OutcomeCode" id="o<?php echo $output_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_list->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<span id="el$rowindex$_output_ProgramCode" class="form-group output_ProgramCode">
<?php
$onchange = $output_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_list->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $output_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_list->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_list->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->ProgramCode->ReadOnly || $output_list->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_ProgramCode" id="x<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputlist"], function() {
	foutputlist.createAutoSuggest({"id":"x<?php echo $output_list->RowIndex ?>_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_list->ProgramCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_ProgramCode") ?>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" name="o<?php echo $output_list->RowIndex ?>_ProgramCode" id="o<?php echo $output_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_list->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<span id="el$rowindex$_output_SubProgramCode" class="form-group output_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $output_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($output_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_list->SubProgramCode->ReadOnly || $output_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $output_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_list->SubProgramCode->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_list->RowIndex ?>_SubProgramCode" id="x<?php echo $output_list->RowIndex ?>_SubProgramCode" value="<?php echo $output_list->SubProgramCode->CurrentValue ?>"<?php echo $output_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" name="o<?php echo $output_list->RowIndex ?>_SubProgramCode" id="o<?php echo $output_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_list->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<span id="el$rowindex$_output_OutputCode" class="form-group output_OutputCode"></span>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="o<?php echo $output_list->RowIndex ?>_OutputCode" id="o<?php echo $output_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_list->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType">
<span id="el$rowindex$_output_OutputType" class="form-group output_OutputType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_list->OutputType->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_list->RowIndex ?>_OutputType" name="x<?php echo $output_list->RowIndex ?>_OutputType"<?php echo $output_list->OutputType->editAttributes() ?>>
			<?php echo $output_list->OutputType->selectOptionListHtml("x{$output_list->RowIndex}_OutputType") ?>
		</select>
</div>
<?php echo $output_list->OutputType->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutputType") ?>
</span>
<input type="hidden" data-table="output" data-field="x_OutputType" name="o<?php echo $output_list->RowIndex ?>_OutputType" id="o<?php echo $output_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_list->OutputType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->OutputName->Visible) { // OutputName ?>
		<td data-name="OutputName">
<span id="el$rowindex$_output_OutputName" class="form-group output_OutputName">
<textarea data-table="output" data-field="x_OutputName" name="x<?php echo $output_list->RowIndex ?>_OutputName" id="x<?php echo $output_list->RowIndex ?>_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->OutputName->getPlaceHolder()) ?>"<?php echo $output_list->OutputName->editAttributes() ?>><?php echo $output_list->OutputName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputName" name="o<?php echo $output_list->RowIndex ?>_OutputName" id="o<?php echo $output_list->RowIndex ?>_OutputName" value="<?php echo HtmlEncode($output_list->OutputName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->DeliveryDate->Visible) { // DeliveryDate ?>
		<td data-name="DeliveryDate">
<span id="el$rowindex$_output_DeliveryDate" class="form-group output_DeliveryDate">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x<?php echo $output_list->RowIndex ?>_DeliveryDate" id="x<?php echo $output_list->RowIndex ?>_DeliveryDate" placeholder="<?php echo HtmlEncode($output_list->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_list->DeliveryDate->EditValue ?>"<?php echo $output_list->DeliveryDate->editAttributes() ?>>
<?php if (!$output_list->DeliveryDate->ReadOnly && !$output_list->DeliveryDate->Disabled && !isset($output_list->DeliveryDate->EditAttrs["readonly"]) && !isset($output_list->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputlist", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputlist", "x<?php echo $output_list->RowIndex ?>_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="output" data-field="x_DeliveryDate" name="o<?php echo $output_list->RowIndex ?>_DeliveryDate" id="o<?php echo $output_list->RowIndex ?>_DeliveryDate" value="<?php echo HtmlEncode($output_list->DeliveryDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<span id="el$rowindex$_output_FinancialYear" class="form-group output_FinancialYear">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x<?php echo $output_list->RowIndex ?>_FinancialYear" id="x<?php echo $output_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_list->FinancialYear->EditValue ?>"<?php echo $output_list->FinancialYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_FinancialYear" name="o<?php echo $output_list->RowIndex ?>_FinancialYear" id="o<?php echo $output_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_list->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->OutputDescription->Visible) { // OutputDescription ?>
		<td data-name="OutputDescription">
<span id="el$rowindex$_output_OutputDescription" class="form-group output_OutputDescription">
<textarea data-table="output" data-field="x_OutputDescription" name="x<?php echo $output_list->RowIndex ?>_OutputDescription" id="x<?php echo $output_list->RowIndex ?>_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_list->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_list->OutputDescription->editAttributes() ?>><?php echo $output_list->OutputDescription->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputDescription" name="o<?php echo $output_list->RowIndex ?>_OutputDescription" id="o<?php echo $output_list->RowIndex ?>_OutputDescription" value="<?php echo HtmlEncode($output_list->OutputDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
		<td data-name="OutputMeansOfVerification">
<span id="el$rowindex$_output_OutputMeansOfVerification" class="form-group output_OutputMeansOfVerification">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" id="x<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_list->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_list->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_list->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_OutputMeansOfVerification" name="o<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" id="o<?php echo $output_list->RowIndex ?>_OutputMeansOfVerification" value="<?php echo HtmlEncode($output_list->OutputMeansOfVerification->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<td data-name="ResponsibleOfficer">
<span id="el$rowindex$_output_ResponsibleOfficer" class="form-group output_ResponsibleOfficer">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" id="x<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_list->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_list->ResponsibleOfficer->EditValue ?>"<?php echo $output_list->ResponsibleOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_ResponsibleOfficer" name="o<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" id="o<?php echo $output_list->RowIndex ?>_ResponsibleOfficer" value="<?php echo HtmlEncode($output_list->ResponsibleOfficer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->Clients->Visible) { // Clients ?>
		<td data-name="Clients">
<span id="el$rowindex$_output_Clients" class="form-group output_Clients">
<textarea data-table="output" data-field="x_Clients" name="x<?php echo $output_list->RowIndex ?>_Clients" id="x<?php echo $output_list->RowIndex ?>_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->Clients->getPlaceHolder()) ?>"<?php echo $output_list->Clients->editAttributes() ?>><?php echo $output_list->Clients->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_Clients" name="o<?php echo $output_list->RowIndex ?>_Clients" id="o<?php echo $output_list->RowIndex ?>_Clients" value="<?php echo HtmlEncode($output_list->Clients->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->Beneficiaries->Visible) { // Beneficiaries ?>
		<td data-name="Beneficiaries">
<span id="el$rowindex$_output_Beneficiaries" class="form-group output_Beneficiaries">
<textarea data-table="output" data-field="x_Beneficiaries" name="x<?php echo $output_list->RowIndex ?>_Beneficiaries" id="x<?php echo $output_list->RowIndex ?>_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_list->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_list->Beneficiaries->editAttributes() ?>><?php echo $output_list->Beneficiaries->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output" data-field="x_Beneficiaries" name="o<?php echo $output_list->RowIndex ?>_Beneficiaries" id="o<?php echo $output_list->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($output_list->Beneficiaries->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->OutputStatus->Visible) { // OutputStatus ?>
		<td data-name="OutputStatus">
<span id="el$rowindex$_output_OutputStatus" class="form-group output_OutputStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_list->OutputStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $output_list->RowIndex ?>_OutputStatus" name="x<?php echo $output_list->RowIndex ?>_OutputStatus"<?php echo $output_list->OutputStatus->editAttributes() ?>>
			<?php echo $output_list->OutputStatus->selectOptionListHtml("x{$output_list->RowIndex}_OutputStatus") ?>
		</select>
</div>
<?php echo $output_list->OutputStatus->Lookup->getParamTag($output_list, "p_x" . $output_list->RowIndex . "_OutputStatus") ?>
</span>
<input type="hidden" data-table="output" data-field="x_OutputStatus" name="o<?php echo $output_list->RowIndex ?>_OutputStatus" id="o<?php echo $output_list->RowIndex ?>_OutputStatus" value="<?php echo HtmlEncode($output_list->OutputStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount">
<span id="el$rowindex$_output_TargetAmount" class="form-group output_TargetAmount">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x<?php echo $output_list->RowIndex ?>_TargetAmount" id="x<?php echo $output_list->RowIndex ?>_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_list->TargetAmount->EditValue ?>"<?php echo $output_list->TargetAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_TargetAmount" name="o<?php echo $output_list->RowIndex ?>_TargetAmount" id="o<?php echo $output_list->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_list->TargetAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount">
<span id="el$rowindex$_output_ActualAmount" class="form-group output_ActualAmount">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x<?php echo $output_list->RowIndex ?>_ActualAmount" id="x<?php echo $output_list->RowIndex ?>_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_list->ActualAmount->EditValue ?>"<?php echo $output_list->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_ActualAmount" name="o<?php echo $output_list->RowIndex ?>_ActualAmount" id="o<?php echo $output_list->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_list->ActualAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_list->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved">
<span id="el$rowindex$_output_PercentAchieved" class="form-group output_PercentAchieved">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x<?php echo $output_list->RowIndex ?>_PercentAchieved" id="x<?php echo $output_list->RowIndex ?>_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_list->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_list->PercentAchieved->EditValue ?>"<?php echo $output_list->PercentAchieved->editAttributes() ?>>
</span>
<input type="hidden" data-table="output" data-field="x_PercentAchieved" name="o<?php echo $output_list->RowIndex ?>_PercentAchieved" id="o<?php echo $output_list->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_list->PercentAchieved->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_list->ListOptions->render("body", "right", $output_list->RowIndex);
?>
<script>
loadjs.ready(["foutputlist", "load"], function() {
	foutputlist.updateLists(<?php echo $output_list->RowIndex ?>);
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
<?php if ($output_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $output_list->FormKeyCountName ?>" id="<?php echo $output_list->FormKeyCountName ?>" value="<?php echo $output_list->KeyCount ?>">
<?php echo $output_list->MultiSelectKey ?>
<?php } ?>
<?php if ($output_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $output_list->FormKeyCountName ?>" id="<?php echo $output_list->FormKeyCountName ?>" value="<?php echo $output_list->KeyCount ?>">
<?php echo $output_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$output->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($output_list->Recordset)
	$output_list->Recordset->Close();
?>
<?php if (!$output_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$output_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $output_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($output_list->TotalRecords == 0 && !$output->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $output_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$output_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$output_list->isExport()) { ?>
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
$output_list->terminate();
?>