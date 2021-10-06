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
$output_indicator_list = new output_indicator_list();

// Run the page
$output_indicator_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$output_indicator_list->isExport()) { ?>
<script>
var foutput_indicatorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	foutput_indicatorlist = currentForm = new ew.Form("foutput_indicatorlist", "list");
	foutput_indicatorlist.formKeyCountName = '<?php echo $output_indicator_list->FormKeyCountName ?>';

	// Validate form
	foutput_indicatorlist.validate = function() {
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
			<?php if ($output_indicator_list->IndicatorNo->Required) { ?>
				elm = this.getElements("x" + infix + "_IndicatorNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->IndicatorNo->caption(), $output_indicator_list->IndicatorNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->LACode->caption(), $output_indicator_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->DepartmentCode->caption(), $output_indicator_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->DepartmentCode->errorMessage()) ?>");
			<?php if ($output_indicator_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->SectionCode->caption(), $output_indicator_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->SectionCode->errorMessage()) ?>");
			<?php if ($output_indicator_list->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->OutputCode->caption(), $output_indicator_list->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->OutputCode->errorMessage()) ?>");
			<?php if ($output_indicator_list->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->OutcomeCode->caption(), $output_indicator_list->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->OutcomeCode->errorMessage()) ?>");
			<?php if ($output_indicator_list->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->OutputType->caption(), $output_indicator_list->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_list->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->ProgramCode->caption(), $output_indicator_list->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->ProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_list->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->SubProgramCode->caption(), $output_indicator_list->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->SubProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_list->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->FinancialYear->caption(), $output_indicator_list->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->FinancialYear->errorMessage()) ?>");
			<?php if ($output_indicator_list->OutputIndicatorName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputIndicatorName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->OutputIndicatorName->caption(), $output_indicator_list->OutputIndicatorName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_list->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->TargetAmount->caption(), $output_indicator_list->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->TargetAmount->errorMessage()) ?>");
			<?php if ($output_indicator_list->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->ActualAmount->caption(), $output_indicator_list->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->ActualAmount->errorMessage()) ?>");
			<?php if ($output_indicator_list->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_list->PercentAchieved->caption(), $output_indicator_list->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_list->PercentAchieved->errorMessage()) ?>");

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
	foutput_indicatorlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputIndicatorName", false)) return false;
		if (ew.valueChanged(fobj, infix, "TargetAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "PercentAchieved", false)) return false;
		return true;
	}

	// Form_CustomValidate
	foutput_indicatorlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutput_indicatorlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutput_indicatorlist.lists["x_LACode"] = <?php echo $output_indicator_list->LACode->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_LACode"].options = <?php echo JsonEncode($output_indicator_list->LACode->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorlist.lists["x_DepartmentCode"] = <?php echo $output_indicator_list->DepartmentCode->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_indicator_list->DepartmentCode->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_DepartmentCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorlist.lists["x_SectionCode"] = <?php echo $output_indicator_list->SectionCode->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_SectionCode"].options = <?php echo JsonEncode($output_indicator_list->SectionCode->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_SectionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorlist.lists["x_OutputCode"] = <?php echo $output_indicator_list->OutputCode->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_OutputCode"].options = <?php echo JsonEncode($output_indicator_list->OutputCode->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorlist.lists["x_OutcomeCode"] = <?php echo $output_indicator_list->OutcomeCode->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_indicator_list->OutcomeCode->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_OutcomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorlist.lists["x_OutputType"] = <?php echo $output_indicator_list->OutputType->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_OutputType"].options = <?php echo JsonEncode($output_indicator_list->OutputType->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_OutputType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorlist.lists["x_ProgramCode"] = <?php echo $output_indicator_list->ProgramCode->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_indicator_list->ProgramCode->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatorlist.lists["x_SubProgramCode"] = <?php echo $output_indicator_list->SubProgramCode->Lookup->toClientList($output_indicator_list) ?>;
	foutput_indicatorlist.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_indicator_list->SubProgramCode->lookupOptions()) ?>;
	foutput_indicatorlist.autoSuggests["x_SubProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("foutput_indicatorlist");
});
var foutput_indicatorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	foutput_indicatorlistsrch = currentSearchForm = new ew.Form("foutput_indicatorlistsrch");

	// Dynamic selection lists
	// Filters

	foutput_indicatorlistsrch.filterList = <?php echo $output_indicator_list->getFilterList() ?>;

	// Init search panel as collapsed
	foutput_indicatorlistsrch.initSearchPanel = true;
	loadjs.done("foutput_indicatorlistsrch");
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
<?php if (!$output_indicator_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($output_indicator_list->TotalRecords > 0 && $output_indicator_list->ExportOptions->visible()) { ?>
<?php $output_indicator_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($output_indicator_list->ImportOptions->visible()) { ?>
<?php $output_indicator_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($output_indicator_list->SearchOptions->visible()) { ?>
<?php $output_indicator_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($output_indicator_list->FilterOptions->visible()) { ?>
<?php $output_indicator_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$output_indicator_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$output_indicator_list->isExport() && !$output_indicator->CurrentAction) { ?>
<form name="foutput_indicatorlistsrch" id="foutput_indicatorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="foutput_indicatorlistsrch-search-panel" class="<?php echo $output_indicator_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="output_indicator">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $output_indicator_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($output_indicator_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($output_indicator_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $output_indicator_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($output_indicator_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($output_indicator_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($output_indicator_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($output_indicator_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $output_indicator_list->showPageHeader(); ?>
<?php
$output_indicator_list->showMessage();
?>
<?php if ($output_indicator_list->TotalRecords > 0 || $output_indicator->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($output_indicator_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> output_indicator">
<?php if (!$output_indicator_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$output_indicator_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_indicator_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $output_indicator_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="foutput_indicatorlist" id="foutput_indicatorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_indicator">
<div id="gmp_output_indicator" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($output_indicator_list->TotalRecords > 0 || $output_indicator_list->isAdd() || $output_indicator_list->isCopy() || $output_indicator_list->isGridEdit()) { ?>
<table id="tbl_output_indicatorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$output_indicator->RowType = ROWTYPE_HEADER;

// Render list options
$output_indicator_list->renderListOptions();

// Render list options (header, left)
$output_indicator_list->ListOptions->render("header", "left");
?>
<?php if ($output_indicator_list->IndicatorNo->Visible) { // IndicatorNo ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->IndicatorNo) == "") { ?>
		<th data-name="IndicatorNo" class="<?php echo $output_indicator_list->IndicatorNo->headerCellClass() ?>"><div id="elh_output_indicator_IndicatorNo" class="output_indicator_IndicatorNo"><div class="ew-table-header-caption"><?php echo $output_indicator_list->IndicatorNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IndicatorNo" class="<?php echo $output_indicator_list->IndicatorNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->IndicatorNo) ?>', 1);"><div id="elh_output_indicator_IndicatorNo" class="output_indicator_IndicatorNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->IndicatorNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->IndicatorNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->IndicatorNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->LACode->Visible) { // LACode ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $output_indicator_list->LACode->headerCellClass() ?>"><div id="elh_output_indicator_LACode" class="output_indicator_LACode"><div class="ew-table-header-caption"><?php echo $output_indicator_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $output_indicator_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->LACode) ?>', 1);"><div id="elh_output_indicator_LACode" class="output_indicator_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_indicator_list->DepartmentCode->headerCellClass() ?>"><div id="elh_output_indicator_DepartmentCode" class="output_indicator_DepartmentCode"><div class="ew-table-header-caption"><?php echo $output_indicator_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $output_indicator_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->DepartmentCode) ?>', 1);"><div id="elh_output_indicator_DepartmentCode" class="output_indicator_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $output_indicator_list->SectionCode->headerCellClass() ?>"><div id="elh_output_indicator_SectionCode" class="output_indicator_SectionCode"><div class="ew-table-header-caption"><?php echo $output_indicator_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $output_indicator_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->SectionCode) ?>', 1);"><div id="elh_output_indicator_SectionCode" class="output_indicator_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->OutputCode->Visible) { // OutputCode ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $output_indicator_list->OutputCode->headerCellClass() ?>"><div id="elh_output_indicator_OutputCode" class="output_indicator_OutputCode"><div class="ew-table-header-caption"><?php echo $output_indicator_list->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $output_indicator_list->OutputCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->OutputCode) ?>', 1);"><div id="elh_output_indicator_OutputCode" class="output_indicator_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_indicator_list->OutcomeCode->headerCellClass() ?>"><div id="elh_output_indicator_OutcomeCode" class="output_indicator_OutcomeCode"><div class="ew-table-header-caption"><?php echo $output_indicator_list->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $output_indicator_list->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->OutcomeCode) ?>', 1);"><div id="elh_output_indicator_OutcomeCode" class="output_indicator_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->OutputType->Visible) { // OutputType ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->OutputType) == "") { ?>
		<th data-name="OutputType" class="<?php echo $output_indicator_list->OutputType->headerCellClass() ?>"><div id="elh_output_indicator_OutputType" class="output_indicator_OutputType"><div class="ew-table-header-caption"><?php echo $output_indicator_list->OutputType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputType" class="<?php echo $output_indicator_list->OutputType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->OutputType) ?>', 1);"><div id="elh_output_indicator_OutputType" class="output_indicator_OutputType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->OutputType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->OutputType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->OutputType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $output_indicator_list->ProgramCode->headerCellClass() ?>"><div id="elh_output_indicator_ProgramCode" class="output_indicator_ProgramCode"><div class="ew-table-header-caption"><?php echo $output_indicator_list->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $output_indicator_list->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->ProgramCode) ?>', 1);"><div id="elh_output_indicator_ProgramCode" class="output_indicator_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_indicator_list->SubProgramCode->headerCellClass() ?>"><div id="elh_output_indicator_SubProgramCode" class="output_indicator_SubProgramCode"><div class="ew-table-header-caption"><?php echo $output_indicator_list->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $output_indicator_list->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->SubProgramCode) ?>', 1);"><div id="elh_output_indicator_SubProgramCode" class="output_indicator_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $output_indicator_list->FinancialYear->headerCellClass() ?>"><div id="elh_output_indicator_FinancialYear" class="output_indicator_FinancialYear"><div class="ew-table-header-caption"><?php echo $output_indicator_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $output_indicator_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->FinancialYear) ?>', 1);"><div id="elh_output_indicator_FinancialYear" class="output_indicator_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->OutputIndicatorName) == "") { ?>
		<th data-name="OutputIndicatorName" class="<?php echo $output_indicator_list->OutputIndicatorName->headerCellClass() ?>"><div id="elh_output_indicator_OutputIndicatorName" class="output_indicator_OutputIndicatorName"><div class="ew-table-header-caption"><?php echo $output_indicator_list->OutputIndicatorName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputIndicatorName" class="<?php echo $output_indicator_list->OutputIndicatorName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->OutputIndicatorName) ?>', 1);"><div id="elh_output_indicator_OutputIndicatorName" class="output_indicator_OutputIndicatorName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->OutputIndicatorName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->OutputIndicatorName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->OutputIndicatorName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->TargetAmount->Visible) { // TargetAmount ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->TargetAmount) == "") { ?>
		<th data-name="TargetAmount" class="<?php echo $output_indicator_list->TargetAmount->headerCellClass() ?>"><div id="elh_output_indicator_TargetAmount" class="output_indicator_TargetAmount"><div class="ew-table-header-caption"><?php echo $output_indicator_list->TargetAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TargetAmount" class="<?php echo $output_indicator_list->TargetAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->TargetAmount) ?>', 1);"><div id="elh_output_indicator_TargetAmount" class="output_indicator_TargetAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->TargetAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->TargetAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->TargetAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $output_indicator_list->ActualAmount->headerCellClass() ?>"><div id="elh_output_indicator_ActualAmount" class="output_indicator_ActualAmount"><div class="ew-table-header-caption"><?php echo $output_indicator_list->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $output_indicator_list->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->ActualAmount) ?>', 1);"><div id="elh_output_indicator_ActualAmount" class="output_indicator_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_indicator_list->PercentAchieved->Visible) { // PercentAchieved ?>
	<?php if ($output_indicator_list->SortUrl($output_indicator_list->PercentAchieved) == "") { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_indicator_list->PercentAchieved->headerCellClass() ?>"><div id="elh_output_indicator_PercentAchieved" class="output_indicator_PercentAchieved"><div class="ew-table-header-caption"><?php echo $output_indicator_list->PercentAchieved->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PercentAchieved" class="<?php echo $output_indicator_list->PercentAchieved->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $output_indicator_list->SortUrl($output_indicator_list->PercentAchieved) ?>', 1);"><div id="elh_output_indicator_PercentAchieved" class="output_indicator_PercentAchieved">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_indicator_list->PercentAchieved->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_indicator_list->PercentAchieved->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_indicator_list->PercentAchieved->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$output_indicator_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($output_indicator_list->isAdd() || $output_indicator_list->isCopy()) {
		$output_indicator_list->RowIndex = 0;
		$output_indicator_list->KeyCount = $output_indicator_list->RowIndex;
		if ($output_indicator_list->isCopy() && !$output_indicator_list->loadRow())
			$output_indicator->CurrentAction = "add";
		if ($output_indicator_list->isAdd())
			$output_indicator_list->loadRowValues();
		if ($output_indicator->EventCancelled) // Insert failed
			$output_indicator_list->restoreFormValues(); // Restore form values

		// Set row properties
		$output_indicator->resetAttributes();
		$output_indicator->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_output_indicator", "data-rowtype" => ROWTYPE_ADD]);
		$output_indicator->RowType = ROWTYPE_ADD;

		// Render row
		$output_indicator_list->renderRow();

		// Render list options
		$output_indicator_list->renderListOptions();
		$output_indicator_list->StartRowCount = 0;
?>
	<tr <?php echo $output_indicator->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_indicator_list->ListOptions->render("body", "left", $output_indicator_list->RowCount);
?>
	<?php if ($output_indicator_list->IndicatorNo->Visible) { // IndicatorNo ?>
		<td data-name="IndicatorNo">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_IndicatorNo" class="form-group output_indicator_IndicatorNo"></span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="o<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" id="o<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_list->IndicatorNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_LACode" class="form-group output_indicator_LACode">
<?php
$onchange = $output_indicator_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_indicator_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->LACode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="o<?php echo $output_indicator_list->RowIndex ?>_LACode" id="o<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_DepartmentCode" class="form-group output_indicator_DepartmentCode">
<?php
$onchange = $output_indicator_list->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_list->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->DepartmentCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="o<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="o<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SectionCode" class="form-group output_indicator_SectionCode">
<?php
$onchange = $output_indicator_list->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo RemoveHtml($output_indicator_list->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_list->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SectionCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="o<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="o<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputCode" class="form-group output_indicator_OutputCode">
<?php
$onchange = $output_indicator_list->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($output_indicator_list->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_list->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_list->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutcomeCode" class="form-group output_indicator_OutcomeCode">
<?php
$onchange = $output_indicator_list->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_list->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutcomeCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutcomeCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="o<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="o<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputType" class="form-group output_indicator_OutputType">
<?php
$onchange = $output_indicator_list->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputType">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo RemoveHtml($output_indicator_list->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_list->OutputType->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_list->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputType->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputType") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_list->OutputType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ProgramCode" class="form-group output_indicator_ProgramCode">
<?php
$onchange = $output_indicator_list->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_indicator_list->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->ProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_ProgramCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="o<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="o<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_list->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SubProgramCode" class="form-group output_indicator_SubProgramCode">
<?php
$onchange = $output_indicator_list->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_list->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SubProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SubProgramCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="o<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="o<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_FinancialYear" class="form-group output_indicator_FinancialYear">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->FinancialYear->EditValue ?>"<?php echo $output_indicator_list->FinancialYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="o<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" id="o<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_list->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<td data-name="OutputIndicatorName">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputIndicatorName" class="form-group output_indicator_OutputIndicatorName">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_list->OutputIndicatorName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_list->OutputIndicatorName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_TargetAmount" class="form-group output_indicator_TargetAmount">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->TargetAmount->EditValue ?>"<?php echo $output_indicator_list->TargetAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="o<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" id="o<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_list->TargetAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ActualAmount" class="form-group output_indicator_ActualAmount">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->ActualAmount->EditValue ?>"<?php echo $output_indicator_list->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="o<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" id="o<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_list->ActualAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved">
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_PercentAchieved" class="form-group output_indicator_PercentAchieved">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->PercentAchieved->EditValue ?>"<?php echo $output_indicator_list->PercentAchieved->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="o<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" id="o<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_list->PercentAchieved->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_indicator_list->ListOptions->render("body", "right", $output_indicator_list->RowCount);
?>
<script>
loadjs.ready(["foutput_indicatorlist", "load"], function() {
	foutput_indicatorlist.updateLists(<?php echo $output_indicator_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($output_indicator_list->ExportAll && $output_indicator_list->isExport()) {
	$output_indicator_list->StopRecord = $output_indicator_list->TotalRecords;
} else {

	// Set the last record to display
	if ($output_indicator_list->TotalRecords > $output_indicator_list->StartRecord + $output_indicator_list->DisplayRecords - 1)
		$output_indicator_list->StopRecord = $output_indicator_list->StartRecord + $output_indicator_list->DisplayRecords - 1;
	else
		$output_indicator_list->StopRecord = $output_indicator_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($output_indicator->isConfirm() || $output_indicator_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($output_indicator_list->FormKeyCountName) && ($output_indicator_list->isGridAdd() || $output_indicator_list->isGridEdit() || $output_indicator->isConfirm())) {
		$output_indicator_list->KeyCount = $CurrentForm->getValue($output_indicator_list->FormKeyCountName);
		$output_indicator_list->StopRecord = $output_indicator_list->StartRecord + $output_indicator_list->KeyCount - 1;
	}
}
$output_indicator_list->RecordCount = $output_indicator_list->StartRecord - 1;
if ($output_indicator_list->Recordset && !$output_indicator_list->Recordset->EOF) {
	$output_indicator_list->Recordset->moveFirst();
	$selectLimit = $output_indicator_list->UseSelectLimit;
	if (!$selectLimit && $output_indicator_list->StartRecord > 1)
		$output_indicator_list->Recordset->move($output_indicator_list->StartRecord - 1);
} elseif (!$output_indicator->AllowAddDeleteRow && $output_indicator_list->StopRecord == 0) {
	$output_indicator_list->StopRecord = $output_indicator->GridAddRowCount;
}

// Initialize aggregate
$output_indicator->RowType = ROWTYPE_AGGREGATEINIT;
$output_indicator->resetAttributes();
$output_indicator_list->renderRow();
$output_indicator_list->EditRowCount = 0;
if ($output_indicator_list->isEdit())
	$output_indicator_list->RowIndex = 1;
if ($output_indicator_list->isGridAdd())
	$output_indicator_list->RowIndex = 0;
if ($output_indicator_list->isGridEdit())
	$output_indicator_list->RowIndex = 0;
while ($output_indicator_list->RecordCount < $output_indicator_list->StopRecord) {
	$output_indicator_list->RecordCount++;
	if ($output_indicator_list->RecordCount >= $output_indicator_list->StartRecord) {
		$output_indicator_list->RowCount++;
		if ($output_indicator_list->isGridAdd() || $output_indicator_list->isGridEdit() || $output_indicator->isConfirm()) {
			$output_indicator_list->RowIndex++;
			$CurrentForm->Index = $output_indicator_list->RowIndex;
			if ($CurrentForm->hasValue($output_indicator_list->FormActionName) && ($output_indicator->isConfirm() || $output_indicator_list->EventCancelled))
				$output_indicator_list->RowAction = strval($CurrentForm->getValue($output_indicator_list->FormActionName));
			elseif ($output_indicator_list->isGridAdd())
				$output_indicator_list->RowAction = "insert";
			else
				$output_indicator_list->RowAction = "";
		}

		// Set up key count
		$output_indicator_list->KeyCount = $output_indicator_list->RowIndex;

		// Init row class and style
		$output_indicator->resetAttributes();
		$output_indicator->CssClass = "";
		if ($output_indicator_list->isGridAdd()) {
			$output_indicator_list->loadRowValues(); // Load default values
		} else {
			$output_indicator_list->loadRowValues($output_indicator_list->Recordset); // Load row values
		}
		$output_indicator->RowType = ROWTYPE_VIEW; // Render view
		if ($output_indicator_list->isGridAdd()) // Grid add
			$output_indicator->RowType = ROWTYPE_ADD; // Render add
		if ($output_indicator_list->isGridAdd() && $output_indicator->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$output_indicator_list->restoreCurrentRowFormValues($output_indicator_list->RowIndex); // Restore form values
		if ($output_indicator_list->isEdit()) {
			if ($output_indicator_list->checkInlineEditKey() && $output_indicator_list->EditRowCount == 0) { // Inline edit
				$output_indicator->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($output_indicator_list->isGridEdit()) { // Grid edit
			if ($output_indicator->EventCancelled)
				$output_indicator_list->restoreCurrentRowFormValues($output_indicator_list->RowIndex); // Restore form values
			if ($output_indicator_list->RowAction == "insert")
				$output_indicator->RowType = ROWTYPE_ADD; // Render add
			else
				$output_indicator->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($output_indicator_list->isEdit() && $output_indicator->RowType == ROWTYPE_EDIT && $output_indicator->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$output_indicator_list->restoreFormValues(); // Restore form values
		}
		if ($output_indicator_list->isGridEdit() && ($output_indicator->RowType == ROWTYPE_EDIT || $output_indicator->RowType == ROWTYPE_ADD) && $output_indicator->EventCancelled) // Update failed
			$output_indicator_list->restoreCurrentRowFormValues($output_indicator_list->RowIndex); // Restore form values
		if ($output_indicator->RowType == ROWTYPE_EDIT) // Edit row
			$output_indicator_list->EditRowCount++;

		// Set up row id / data-rowindex
		$output_indicator->RowAttrs->merge(["data-rowindex" => $output_indicator_list->RowCount, "id" => "r" . $output_indicator_list->RowCount . "_output_indicator", "data-rowtype" => $output_indicator->RowType]);

		// Render row
		$output_indicator_list->renderRow();

		// Render list options
		$output_indicator_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($output_indicator_list->RowAction != "delete" && $output_indicator_list->RowAction != "insertdelete" && !($output_indicator_list->RowAction == "insert" && $output_indicator->isConfirm() && $output_indicator_list->emptyRow())) {
?>
	<tr <?php echo $output_indicator->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_indicator_list->ListOptions->render("body", "left", $output_indicator_list->RowCount);
?>
	<?php if ($output_indicator_list->IndicatorNo->Visible) { // IndicatorNo ?>
		<td data-name="IndicatorNo" <?php echo $output_indicator_list->IndicatorNo->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_IndicatorNo" class="form-group"></span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="o<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" id="o<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_list->IndicatorNo->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_IndicatorNo" class="form-group">
<span<?php echo $output_indicator_list->IndicatorNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_list->IndicatorNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="x<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" id="x<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_list->IndicatorNo->CurrentValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_IndicatorNo">
<span<?php echo $output_indicator_list->IndicatorNo->viewAttributes() ?>><?php echo $output_indicator_list->IndicatorNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $output_indicator_list->LACode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_LACode" class="form-group">
<?php
$onchange = $output_indicator_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_indicator_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->LACode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="o<?php echo $output_indicator_list->RowIndex ?>_LACode" id="o<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_LACode" class="form-group">
<?php
$onchange = $output_indicator_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_indicator_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->LACode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_LACode">
<span<?php echo $output_indicator_list->LACode->viewAttributes() ?>><?php echo $output_indicator_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $output_indicator_list->DepartmentCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_DepartmentCode" class="form-group">
<?php
$onchange = $output_indicator_list->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_list->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->DepartmentCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="o<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="o<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_DepartmentCode" class="form-group">
<?php
$onchange = $output_indicator_list->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_list->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->DepartmentCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_DepartmentCode">
<span<?php echo $output_indicator_list->DepartmentCode->viewAttributes() ?>><?php echo $output_indicator_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $output_indicator_list->SectionCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SectionCode" class="form-group">
<?php
$onchange = $output_indicator_list->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo RemoveHtml($output_indicator_list->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_list->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SectionCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="o<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="o<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SectionCode" class="form-group">
<?php
$onchange = $output_indicator_list->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo RemoveHtml($output_indicator_list->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_list->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SectionCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SectionCode">
<span<?php echo $output_indicator_list->SectionCode->viewAttributes() ?>><?php echo $output_indicator_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $output_indicator_list->OutputCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputCode" class="form-group">
<?php
$onchange = $output_indicator_list->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($output_indicator_list->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_list->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_list->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputCode" class="form-group">
<?php
$onchange = $output_indicator_list->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($output_indicator_list->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_list->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputCode">
<span<?php echo $output_indicator_list->OutputCode->viewAttributes() ?>><?php echo $output_indicator_list->OutputCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $output_indicator_list->OutcomeCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutcomeCode" class="form-group">
<?php
$onchange = $output_indicator_list->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_list->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutcomeCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutcomeCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="o<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="o<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutcomeCode" class="form-group">
<?php
$onchange = $output_indicator_list->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_list->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutcomeCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutcomeCode") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutcomeCode">
<span<?php echo $output_indicator_list->OutcomeCode->viewAttributes() ?>><?php echo $output_indicator_list->OutcomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType" <?php echo $output_indicator_list->OutputType->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputType" class="form-group">
<?php
$onchange = $output_indicator_list->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputType">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo RemoveHtml($output_indicator_list->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_list->OutputType->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_list->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputType->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputType") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_list->OutputType->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputType" class="form-group">
<?php
$onchange = $output_indicator_list->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputType">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo RemoveHtml($output_indicator_list->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_list->OutputType->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_list->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputType->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputType") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputType">
<span<?php echo $output_indicator_list->OutputType->viewAttributes() ?>><?php echo $output_indicator_list->OutputType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $output_indicator_list->ProgramCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ProgramCode" class="form-group">
<?php
$onchange = $output_indicator_list->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_indicator_list->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->ProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_ProgramCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="o<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="o<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_list->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ProgramCode" class="form-group">
<?php
$onchange = $output_indicator_list->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_indicator_list->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->ProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ProgramCode">
<span<?php echo $output_indicator_list->ProgramCode->viewAttributes() ?>><?php echo $output_indicator_list->ProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $output_indicator_list->SubProgramCode->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SubProgramCode" class="form-group">
<?php
$onchange = $output_indicator_list->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_list->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SubProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SubProgramCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="o<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="o<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SubProgramCode" class="form-group">
<?php
$onchange = $output_indicator_list->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_list->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SubProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SubProgramCode") ?>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_SubProgramCode">
<span<?php echo $output_indicator_list->SubProgramCode->viewAttributes() ?>><?php echo $output_indicator_list->SubProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $output_indicator_list->FinancialYear->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_FinancialYear" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->FinancialYear->EditValue ?>"<?php echo $output_indicator_list->FinancialYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="o<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" id="o<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_list->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_FinancialYear" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->FinancialYear->EditValue ?>"<?php echo $output_indicator_list->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_FinancialYear">
<span<?php echo $output_indicator_list->FinancialYear->viewAttributes() ?>><?php echo $output_indicator_list->FinancialYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<td data-name="OutputIndicatorName" <?php echo $output_indicator_list->OutputIndicatorName->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputIndicatorName" class="form-group">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_list->OutputIndicatorName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_list->OutputIndicatorName->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputIndicatorName" class="form-group">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_list->OutputIndicatorName->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_OutputIndicatorName">
<span<?php echo $output_indicator_list->OutputIndicatorName->viewAttributes() ?>><?php echo $output_indicator_list->OutputIndicatorName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount" <?php echo $output_indicator_list->TargetAmount->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_TargetAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->TargetAmount->EditValue ?>"<?php echo $output_indicator_list->TargetAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="o<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" id="o<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_list->TargetAmount->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_TargetAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->TargetAmount->EditValue ?>"<?php echo $output_indicator_list->TargetAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_TargetAmount">
<span<?php echo $output_indicator_list->TargetAmount->viewAttributes() ?>><?php echo $output_indicator_list->TargetAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $output_indicator_list->ActualAmount->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ActualAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->ActualAmount->EditValue ?>"<?php echo $output_indicator_list->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="o<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" id="o<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_list->ActualAmount->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ActualAmount" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->ActualAmount->EditValue ?>"<?php echo $output_indicator_list->ActualAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_ActualAmount">
<span<?php echo $output_indicator_list->ActualAmount->viewAttributes() ?>><?php echo $output_indicator_list->ActualAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($output_indicator_list->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved" <?php echo $output_indicator_list->PercentAchieved->cellAttributes() ?>>
<?php if ($output_indicator->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_PercentAchieved" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->PercentAchieved->EditValue ?>"<?php echo $output_indicator_list->PercentAchieved->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="o<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" id="o<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_list->PercentAchieved->OldValue) ?>">
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_PercentAchieved" class="form-group">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->PercentAchieved->EditValue ?>"<?php echo $output_indicator_list->PercentAchieved->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($output_indicator->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $output_indicator_list->RowCount ?>_output_indicator_PercentAchieved">
<span<?php echo $output_indicator_list->PercentAchieved->viewAttributes() ?>><?php echo $output_indicator_list->PercentAchieved->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_indicator_list->ListOptions->render("body", "right", $output_indicator_list->RowCount);
?>
	</tr>
<?php if ($output_indicator->RowType == ROWTYPE_ADD || $output_indicator->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["foutput_indicatorlist", "load"], function() {
	foutput_indicatorlist.updateLists(<?php echo $output_indicator_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$output_indicator_list->isGridAdd())
		if (!$output_indicator_list->Recordset->EOF)
			$output_indicator_list->Recordset->moveNext();
}
?>
<?php
	if ($output_indicator_list->isGridAdd() || $output_indicator_list->isGridEdit()) {
		$output_indicator_list->RowIndex = '$rowindex$';
		$output_indicator_list->loadRowValues();

		// Set row properties
		$output_indicator->resetAttributes();
		$output_indicator->RowAttrs->merge(["data-rowindex" => $output_indicator_list->RowIndex, "id" => "r0_output_indicator", "data-rowtype" => ROWTYPE_ADD]);
		$output_indicator->RowAttrs->appendClass("ew-template");
		$output_indicator->RowType = ROWTYPE_ADD;

		// Render row
		$output_indicator_list->renderRow();

		// Render list options
		$output_indicator_list->renderListOptions();
		$output_indicator_list->StartRowCount = 0;
?>
	<tr <?php echo $output_indicator->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_indicator_list->ListOptions->render("body", "left", $output_indicator_list->RowIndex);
?>
	<?php if ($output_indicator_list->IndicatorNo->Visible) { // IndicatorNo ?>
		<td data-name="IndicatorNo">
<span id="el$rowindex$_output_indicator_IndicatorNo" class="form-group output_indicator_IndicatorNo"></span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="o<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" id="o<?php echo $output_indicator_list->RowIndex ?>_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_list->IndicatorNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el$rowindex$_output_indicator_LACode" class="form-group output_indicator_LACode">
<?php
$onchange = $output_indicator_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($output_indicator_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_LACode" id="x<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->LACode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" name="o<?php echo $output_indicator_list->RowIndex ?>_LACode" id="o<?php echo $output_indicator_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($output_indicator_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_output_indicator_DepartmentCode" class="form-group output_indicator_DepartmentCode">
<?php
$onchange = $output_indicator_list->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_list->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->DepartmentCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" name="o<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" id="o<?php echo $output_indicator_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_output_indicator_SectionCode" class="form-group output_indicator_SectionCode">
<?php
$onchange = $output_indicator_list->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo RemoveHtml($output_indicator_list->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_list->SectionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_list->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SectionCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" name="o<?php echo $output_indicator_list->RowIndex ?>_SectionCode" id="o<?php echo $output_indicator_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($output_indicator_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<span id="el$rowindex$_output_indicator_OutputCode" class="form-group output_indicator_OutputCode">
<?php
$onchange = $output_indicator_list->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($output_indicator_list->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_list->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputCode" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($output_indicator_list->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<span id="el$rowindex$_output_indicator_OutcomeCode" class="form-group output_indicator_OutcomeCode">
<?php
$onchange = $output_indicator_list->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_list->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutcomeCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutcomeCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" name="o<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" id="o<?php echo $output_indicator_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_list->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputType->Visible) { // OutputType ?>
		<td data-name="OutputType">
<span id="el$rowindex$_output_indicator_OutputType" class="form-group output_indicator_OutputType">
<?php
$onchange = $output_indicator_list->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_OutputType">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo RemoveHtml($output_indicator_list->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_list->OutputType->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_list->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->OutputType->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_OutputType") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputType" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputType" value="<?php echo HtmlEncode($output_indicator_list->OutputType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<span id="el$rowindex$_output_indicator_ProgramCode" class="form-group output_indicator_ProgramCode">
<?php
$onchange = $output_indicator_list->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($output_indicator_list->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->ProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_ProgramCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" name="o<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" id="o<?php echo $output_indicator_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($output_indicator_list->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<span id="el$rowindex$_output_indicator_SubProgramCode" class="form-group output_indicator_SubProgramCode">
<?php
$onchange = $output_indicator_list->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_list->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode">
	<input type="text" class="form-control" name="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="sv_x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_list->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatorlist"], function() {
	foutput_indicatorlist.createAutoSuggest({"id":"x<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_list->SubProgramCode->Lookup->getParamTag($output_indicator_list, "p_x" . $output_indicator_list->RowIndex . "_SubProgramCode") ?>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" name="o<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" id="o<?php echo $output_indicator_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_list->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<span id="el$rowindex$_output_indicator_FinancialYear" class="form-group output_indicator_FinancialYear">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" id="x<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->FinancialYear->EditValue ?>"<?php echo $output_indicator_list->FinancialYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_FinancialYear" name="o<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" id="o<?php echo $output_indicator_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($output_indicator_list->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
		<td data-name="OutputIndicatorName">
<span id="el$rowindex$_output_indicator_OutputIndicatorName" class="form-group output_indicator_OutputIndicatorName">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" id="x<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_list->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_list->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_list->OutputIndicatorName->EditValue ?></textarea>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputIndicatorName" name="o<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" id="o<?php echo $output_indicator_list->RowIndex ?>_OutputIndicatorName" value="<?php echo HtmlEncode($output_indicator_list->OutputIndicatorName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->TargetAmount->Visible) { // TargetAmount ?>
		<td data-name="TargetAmount">
<span id="el$rowindex$_output_indicator_TargetAmount" class="form-group output_indicator_TargetAmount">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->TargetAmount->EditValue ?>"<?php echo $output_indicator_list->TargetAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_TargetAmount" name="o<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" id="o<?php echo $output_indicator_list->RowIndex ?>_TargetAmount" value="<?php echo HtmlEncode($output_indicator_list->TargetAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount">
<span id="el$rowindex$_output_indicator_ActualAmount" class="form-group output_indicator_ActualAmount">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" id="x<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->ActualAmount->EditValue ?>"<?php echo $output_indicator_list->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ActualAmount" name="o<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" id="o<?php echo $output_indicator_list->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($output_indicator_list->ActualAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($output_indicator_list->PercentAchieved->Visible) { // PercentAchieved ?>
		<td data-name="PercentAchieved">
<span id="el$rowindex$_output_indicator_PercentAchieved" class="form-group output_indicator_PercentAchieved">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" id="x<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_list->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_list->PercentAchieved->EditValue ?>"<?php echo $output_indicator_list->PercentAchieved->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_PercentAchieved" name="o<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" id="o<?php echo $output_indicator_list->RowIndex ?>_PercentAchieved" value="<?php echo HtmlEncode($output_indicator_list->PercentAchieved->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$output_indicator_list->ListOptions->render("body", "right", $output_indicator_list->RowIndex);
?>
<script>
loadjs.ready(["foutput_indicatorlist", "load"], function() {
	foutput_indicatorlist.updateLists(<?php echo $output_indicator_list->RowIndex ?>);
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
<?php if ($output_indicator_list->isAdd() || $output_indicator_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $output_indicator_list->FormKeyCountName ?>" id="<?php echo $output_indicator_list->FormKeyCountName ?>" value="<?php echo $output_indicator_list->KeyCount ?>">
<?php } ?>
<?php if ($output_indicator_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $output_indicator_list->FormKeyCountName ?>" id="<?php echo $output_indicator_list->FormKeyCountName ?>" value="<?php echo $output_indicator_list->KeyCount ?>">
<?php echo $output_indicator_list->MultiSelectKey ?>
<?php } ?>
<?php if ($output_indicator_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $output_indicator_list->FormKeyCountName ?>" id="<?php echo $output_indicator_list->FormKeyCountName ?>" value="<?php echo $output_indicator_list->KeyCount ?>">
<?php } ?>
<?php if ($output_indicator_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $output_indicator_list->FormKeyCountName ?>" id="<?php echo $output_indicator_list->FormKeyCountName ?>" value="<?php echo $output_indicator_list->KeyCount ?>">
<?php echo $output_indicator_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$output_indicator->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($output_indicator_list->Recordset)
	$output_indicator_list->Recordset->Close();
?>
<?php if (!$output_indicator_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$output_indicator_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_indicator_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $output_indicator_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($output_indicator_list->TotalRecords == 0 && !$output_indicator->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $output_indicator_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$output_indicator_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$output_indicator_list->isExport()) { ?>
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
$output_indicator_list->terminate();
?>