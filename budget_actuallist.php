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
$budget_actual_list = new budget_actual_list();

// Run the page
$budget_actual_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_actual_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$budget_actual_list->isExport()) { ?>
<script>
var fbudget_actuallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbudget_actuallist = currentForm = new ew.Form("fbudget_actuallist", "list");
	fbudget_actuallist.formKeyCountName = '<?php echo $budget_actual_list->FormKeyCountName ?>';

	// Validate form
	fbudget_actuallist.validate = function() {
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
			<?php if ($budget_actual_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->LACode->caption(), $budget_actual_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->DepartmentCode->caption(), $budget_actual_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->SectionCode->caption(), $budget_actual_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_list->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->AccountCode->caption(), $budget_actual_list->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_list->PostingDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->PostingDate->caption(), $budget_actual_list->PostingDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PostingDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_list->PostingDate->errorMessage()) ?>");
			<?php if ($budget_actual_list->AccountMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->AccountMonth->caption(), $budget_actual_list->AccountMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_actual_list->AccountYear->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->AccountYear->caption(), $budget_actual_list->AccountYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_list->AccountYear->errorMessage()) ?>");
			<?php if ($budget_actual_list->BudgetEstimate->Required) { ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->BudgetEstimate->caption(), $budget_actual_list->BudgetEstimate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BudgetEstimate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_list->BudgetEstimate->errorMessage()) ?>");
			<?php if ($budget_actual_list->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->ActualAmount->caption(), $budget_actual_list->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_list->ActualAmount->errorMessage()) ?>");
			<?php if ($budget_actual_list->ForecastAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_actual_list->ForecastAmount->caption(), $budget_actual_list->ForecastAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ForecastAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_actual_list->ForecastAmount->errorMessage()) ?>");

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
	fbudget_actuallist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PostingDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountMonth", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "BudgetEstimate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "ForecastAmount", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fbudget_actuallist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudget_actuallist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudget_actuallist.lists["x_LACode"] = <?php echo $budget_actual_list->LACode->Lookup->toClientList($budget_actual_list) ?>;
	fbudget_actuallist.lists["x_LACode"].options = <?php echo JsonEncode($budget_actual_list->LACode->lookupOptions()) ?>;
	fbudget_actuallist.lists["x_DepartmentCode"] = <?php echo $budget_actual_list->DepartmentCode->Lookup->toClientList($budget_actual_list) ?>;
	fbudget_actuallist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($budget_actual_list->DepartmentCode->lookupOptions()) ?>;
	fbudget_actuallist.lists["x_SectionCode"] = <?php echo $budget_actual_list->SectionCode->Lookup->toClientList($budget_actual_list) ?>;
	fbudget_actuallist.lists["x_SectionCode"].options = <?php echo JsonEncode($budget_actual_list->SectionCode->lookupOptions()) ?>;
	fbudget_actuallist.lists["x_AccountMonth"] = <?php echo $budget_actual_list->AccountMonth->Lookup->toClientList($budget_actual_list) ?>;
	fbudget_actuallist.lists["x_AccountMonth"].options = <?php echo JsonEncode($budget_actual_list->AccountMonth->lookupOptions()) ?>;
	fbudget_actuallist.lists["x_AccountYear"] = <?php echo $budget_actual_list->AccountYear->Lookup->toClientList($budget_actual_list) ?>;
	fbudget_actuallist.lists["x_AccountYear"].options = <?php echo JsonEncode($budget_actual_list->AccountYear->lookupOptions()) ?>;
	fbudget_actuallist.autoSuggests["x_AccountYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fbudget_actuallist");
});
var fbudget_actuallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbudget_actuallistsrch = currentSearchForm = new ew.Form("fbudget_actuallistsrch");

	// Dynamic selection lists
	// Filters

	fbudget_actuallistsrch.filterList = <?php echo $budget_actual_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbudget_actuallistsrch.initSearchPanel = true;
	loadjs.done("fbudget_actuallistsrch");
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
<?php if (!$budget_actual_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($budget_actual_list->TotalRecords > 0 && $budget_actual_list->ExportOptions->visible()) { ?>
<?php $budget_actual_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_actual_list->ImportOptions->visible()) { ?>
<?php $budget_actual_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($budget_actual_list->SearchOptions->visible()) { ?>
<?php $budget_actual_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($budget_actual_list->FilterOptions->visible()) { ?>
<?php $budget_actual_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$budget_actual_list->isExport() || Config("EXPORT_MASTER_RECORD") && $budget_actual_list->isExport("print")) { ?>
<?php
if ($budget_actual_list->DbMasterFilter != "" && $budget_actual->getCurrentMasterTable() == "local_authority") {
	if ($budget_actual_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$budget_actual_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$budget_actual_list->isExport() && !$budget_actual->CurrentAction) { ?>
<form name="fbudget_actuallistsrch" id="fbudget_actuallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbudget_actuallistsrch-search-panel" class="<?php echo $budget_actual_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="budget_actual">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $budget_actual_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($budget_actual_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($budget_actual_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $budget_actual_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($budget_actual_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($budget_actual_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($budget_actual_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($budget_actual_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $budget_actual_list->showPageHeader(); ?>
<?php
$budget_actual_list->showMessage();
?>
<?php if ($budget_actual_list->TotalRecords > 0 || $budget_actual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($budget_actual_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> budget_actual">
<?php if (!$budget_actual_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$budget_actual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_actual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_actual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbudget_actuallist" id="fbudget_actuallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_actual">
<?php if ($budget_actual->getCurrentMasterTable() == "local_authority" && $budget_actual->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($budget_actual_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_budget_actual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($budget_actual_list->TotalRecords > 0 || $budget_actual_list->isGridEdit()) { ?>
<table id="tbl_budget_actuallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$budget_actual->RowType = ROWTYPE_HEADER;

// Render list options
$budget_actual_list->renderListOptions();

// Render list options (header, left)
$budget_actual_list->ListOptions->render("header", "left");
?>
<?php if ($budget_actual_list->LACode->Visible) { // LACode ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $budget_actual_list->LACode->headerCellClass() ?>"><div id="elh_budget_actual_LACode" class="budget_actual_LACode"><div class="ew-table-header-caption"><?php echo $budget_actual_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $budget_actual_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->LACode) ?>', 1);"><div id="elh_budget_actual_LACode" class="budget_actual_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_actual_list->DepartmentCode->headerCellClass() ?>"><div id="elh_budget_actual_DepartmentCode" class="budget_actual_DepartmentCode"><div class="ew-table-header-caption"><?php echo $budget_actual_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $budget_actual_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->DepartmentCode) ?>', 1);"><div id="elh_budget_actual_DepartmentCode" class="budget_actual_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $budget_actual_list->SectionCode->headerCellClass() ?>"><div id="elh_budget_actual_SectionCode" class="budget_actual_SectionCode"><div class="ew-table-header-caption"><?php echo $budget_actual_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $budget_actual_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->SectionCode) ?>', 1);"><div id="elh_budget_actual_SectionCode" class="budget_actual_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->AccountCode->Visible) { // AccountCode ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $budget_actual_list->AccountCode->headerCellClass() ?>"><div id="elh_budget_actual_AccountCode" class="budget_actual_AccountCode"><div class="ew-table-header-caption"><?php echo $budget_actual_list->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $budget_actual_list->AccountCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->AccountCode) ?>', 1);"><div id="elh_budget_actual_AccountCode" class="budget_actual_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->AccountCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->PostingDate->Visible) { // PostingDate ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->PostingDate) == "") { ?>
		<th data-name="PostingDate" class="<?php echo $budget_actual_list->PostingDate->headerCellClass() ?>"><div id="elh_budget_actual_PostingDate" class="budget_actual_PostingDate"><div class="ew-table-header-caption"><?php echo $budget_actual_list->PostingDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostingDate" class="<?php echo $budget_actual_list->PostingDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->PostingDate) ?>', 1);"><div id="elh_budget_actual_PostingDate" class="budget_actual_PostingDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->PostingDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->PostingDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->PostingDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->AccountMonth->Visible) { // AccountMonth ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->AccountMonth) == "") { ?>
		<th data-name="AccountMonth" class="<?php echo $budget_actual_list->AccountMonth->headerCellClass() ?>"><div id="elh_budget_actual_AccountMonth" class="budget_actual_AccountMonth"><div class="ew-table-header-caption"><?php echo $budget_actual_list->AccountMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountMonth" class="<?php echo $budget_actual_list->AccountMonth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->AccountMonth) ?>', 1);"><div id="elh_budget_actual_AccountMonth" class="budget_actual_AccountMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->AccountMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->AccountMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->AccountMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->AccountYear->Visible) { // AccountYear ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->AccountYear) == "") { ?>
		<th data-name="AccountYear" class="<?php echo $budget_actual_list->AccountYear->headerCellClass() ?>"><div id="elh_budget_actual_AccountYear" class="budget_actual_AccountYear"><div class="ew-table-header-caption"><?php echo $budget_actual_list->AccountYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountYear" class="<?php echo $budget_actual_list->AccountYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->AccountYear) ?>', 1);"><div id="elh_budget_actual_AccountYear" class="budget_actual_AccountYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->AccountYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->AccountYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->AccountYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->BudgetEstimate) == "") { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_actual_list->BudgetEstimate->headerCellClass() ?>"><div id="elh_budget_actual_BudgetEstimate" class="budget_actual_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $budget_actual_list->BudgetEstimate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BudgetEstimate" class="<?php echo $budget_actual_list->BudgetEstimate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->BudgetEstimate) ?>', 1);"><div id="elh_budget_actual_BudgetEstimate" class="budget_actual_BudgetEstimate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->ActualAmount) == "") { ?>
		<th data-name="ActualAmount" class="<?php echo $budget_actual_list->ActualAmount->headerCellClass() ?>"><div id="elh_budget_actual_ActualAmount" class="budget_actual_ActualAmount"><div class="ew-table-header-caption"><?php echo $budget_actual_list->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualAmount" class="<?php echo $budget_actual_list->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->ActualAmount) ?>', 1);"><div id="elh_budget_actual_ActualAmount" class="budget_actual_ActualAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($budget_actual_list->ForecastAmount->Visible) { // ForecastAmount ?>
	<?php if ($budget_actual_list->SortUrl($budget_actual_list->ForecastAmount) == "") { ?>
		<th data-name="ForecastAmount" class="<?php echo $budget_actual_list->ForecastAmount->headerCellClass() ?>"><div id="elh_budget_actual_ForecastAmount" class="budget_actual_ForecastAmount"><div class="ew-table-header-caption"><?php echo $budget_actual_list->ForecastAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ForecastAmount" class="<?php echo $budget_actual_list->ForecastAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $budget_actual_list->SortUrl($budget_actual_list->ForecastAmount) ?>', 1);"><div id="elh_budget_actual_ForecastAmount" class="budget_actual_ForecastAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $budget_actual_list->ForecastAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($budget_actual_list->ForecastAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($budget_actual_list->ForecastAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$budget_actual_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($budget_actual_list->ExportAll && $budget_actual_list->isExport()) {
	$budget_actual_list->StopRecord = $budget_actual_list->TotalRecords;
} else {

	// Set the last record to display
	if ($budget_actual_list->TotalRecords > $budget_actual_list->StartRecord + $budget_actual_list->DisplayRecords - 1)
		$budget_actual_list->StopRecord = $budget_actual_list->StartRecord + $budget_actual_list->DisplayRecords - 1;
	else
		$budget_actual_list->StopRecord = $budget_actual_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($budget_actual->isConfirm() || $budget_actual_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($budget_actual_list->FormKeyCountName) && ($budget_actual_list->isGridAdd() || $budget_actual_list->isGridEdit() || $budget_actual->isConfirm())) {
		$budget_actual_list->KeyCount = $CurrentForm->getValue($budget_actual_list->FormKeyCountName);
		$budget_actual_list->StopRecord = $budget_actual_list->StartRecord + $budget_actual_list->KeyCount - 1;
	}
}
$budget_actual_list->RecordCount = $budget_actual_list->StartRecord - 1;
if ($budget_actual_list->Recordset && !$budget_actual_list->Recordset->EOF) {
	$budget_actual_list->Recordset->moveFirst();
	$selectLimit = $budget_actual_list->UseSelectLimit;
	if (!$selectLimit && $budget_actual_list->StartRecord > 1)
		$budget_actual_list->Recordset->move($budget_actual_list->StartRecord - 1);
} elseif (!$budget_actual->AllowAddDeleteRow && $budget_actual_list->StopRecord == 0) {
	$budget_actual_list->StopRecord = $budget_actual->GridAddRowCount;
}

// Initialize aggregate
$budget_actual->RowType = ROWTYPE_AGGREGATEINIT;
$budget_actual->resetAttributes();
$budget_actual_list->renderRow();
if ($budget_actual_list->isGridAdd())
	$budget_actual_list->RowIndex = 0;
if ($budget_actual_list->isGridEdit())
	$budget_actual_list->RowIndex = 0;
while ($budget_actual_list->RecordCount < $budget_actual_list->StopRecord) {
	$budget_actual_list->RecordCount++;
	if ($budget_actual_list->RecordCount >= $budget_actual_list->StartRecord) {
		$budget_actual_list->RowCount++;
		if ($budget_actual_list->isGridAdd() || $budget_actual_list->isGridEdit() || $budget_actual->isConfirm()) {
			$budget_actual_list->RowIndex++;
			$CurrentForm->Index = $budget_actual_list->RowIndex;
			if ($CurrentForm->hasValue($budget_actual_list->FormActionName) && ($budget_actual->isConfirm() || $budget_actual_list->EventCancelled))
				$budget_actual_list->RowAction = strval($CurrentForm->getValue($budget_actual_list->FormActionName));
			elseif ($budget_actual_list->isGridAdd())
				$budget_actual_list->RowAction = "insert";
			else
				$budget_actual_list->RowAction = "";
		}

		// Set up key count
		$budget_actual_list->KeyCount = $budget_actual_list->RowIndex;

		// Init row class and style
		$budget_actual->resetAttributes();
		$budget_actual->CssClass = "";
		if ($budget_actual_list->isGridAdd()) {
			$budget_actual_list->loadRowValues(); // Load default values
		} else {
			$budget_actual_list->loadRowValues($budget_actual_list->Recordset); // Load row values
		}
		$budget_actual->RowType = ROWTYPE_VIEW; // Render view
		if ($budget_actual_list->isGridAdd()) // Grid add
			$budget_actual->RowType = ROWTYPE_ADD; // Render add
		if ($budget_actual_list->isGridAdd() && $budget_actual->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$budget_actual_list->restoreCurrentRowFormValues($budget_actual_list->RowIndex); // Restore form values
		if ($budget_actual_list->isGridEdit()) { // Grid edit
			if ($budget_actual->EventCancelled)
				$budget_actual_list->restoreCurrentRowFormValues($budget_actual_list->RowIndex); // Restore form values
			if ($budget_actual_list->RowAction == "insert")
				$budget_actual->RowType = ROWTYPE_ADD; // Render add
			else
				$budget_actual->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($budget_actual_list->isGridEdit() && ($budget_actual->RowType == ROWTYPE_EDIT || $budget_actual->RowType == ROWTYPE_ADD) && $budget_actual->EventCancelled) // Update failed
			$budget_actual_list->restoreCurrentRowFormValues($budget_actual_list->RowIndex); // Restore form values
		if ($budget_actual->RowType == ROWTYPE_EDIT) // Edit row
			$budget_actual_list->EditRowCount++;

		// Set up row id / data-rowindex
		$budget_actual->RowAttrs->merge(["data-rowindex" => $budget_actual_list->RowCount, "id" => "r" . $budget_actual_list->RowCount . "_budget_actual", "data-rowtype" => $budget_actual->RowType]);

		// Render row
		$budget_actual_list->renderRow();

		// Render list options
		$budget_actual_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($budget_actual_list->RowAction != "delete" && $budget_actual_list->RowAction != "insertdelete" && !($budget_actual_list->RowAction == "insert" && $budget_actual->isConfirm() && $budget_actual_list->emptyRow())) {
?>
	<tr <?php echo $budget_actual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_actual_list->ListOptions->render("body", "left", $budget_actual_list->RowCount);
?>
	<?php if ($budget_actual_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $budget_actual_list->LACode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($budget_actual_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_LACode" class="form-group">
<span<?php echo $budget_actual_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_actual_list->RowIndex ?>_LACode" name="x<?php echo $budget_actual_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_LACode" class="form-group">
<?php $budget_actual_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_LACode" name="x<?php echo $budget_actual_list->RowIndex ?>_LACode"<?php echo $budget_actual_list->LACode->editAttributes() ?>>
			<?php echo $budget_actual_list->LACode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_list->LACode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o<?php echo $budget_actual_list->RowIndex ?>_LACode" id="o<?php echo $budget_actual_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($budget_actual_list->LACode->getSessionValue() != "") { ?>

<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_LACode" class="form-group">
<span<?php echo $budget_actual_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_list->LACode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $budget_actual_list->RowIndex ?>_LACode" name="x<?php echo $budget_actual_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_list->LACode->CurrentValue) ?>">
<?php } else { ?>

<?php $budget_actual_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_LACode" name="x<?php echo $budget_actual_list->RowIndex ?>_LACode"<?php echo $budget_actual_list->LACode->editAttributes() ?>>
			<?php echo $budget_actual_list->LACode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_list->LACode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_LACode") ?>

<?php } ?>

<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o<?php echo $budget_actual_list->RowIndex ?>_LACode" id="o<?php echo $budget_actual_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_list->LACode->OldValue != null ? $budget_actual_list->LACode->OldValue : $budget_actual_list->LACode->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_LACode">
<span<?php echo $budget_actual_list->LACode->viewAttributes() ?>><?php echo $budget_actual_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $budget_actual_list->DepartmentCode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_DepartmentCode" class="form-group">
<?php $budget_actual_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode"<?php echo $budget_actual_list->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_list->DepartmentCode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_list->DepartmentCode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="o<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_DepartmentCode" class="form-group">
<?php $budget_actual_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode"<?php echo $budget_actual_list->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_list->DepartmentCode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_list->DepartmentCode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_DepartmentCode">
<span<?php echo $budget_actual_list->DepartmentCode->viewAttributes() ?>><?php echo $budget_actual_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $budget_actual_list->SectionCode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_SectionCode" name="x<?php echo $budget_actual_list->RowIndex ?>_SectionCode"<?php echo $budget_actual_list->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_list->SectionCode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_list->SectionCode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="o<?php echo $budget_actual_list->RowIndex ?>_SectionCode" id="o<?php echo $budget_actual_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_SectionCode" name="x<?php echo $budget_actual_list->RowIndex ?>_SectionCode"<?php echo $budget_actual_list->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_list->SectionCode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_list->SectionCode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_SectionCode">
<span<?php echo $budget_actual_list->SectionCode->viewAttributes() ?>><?php echo $budget_actual_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $budget_actual_list->AccountCode->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_AccountCode" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_list->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->AccountCode->EditValue ?>"<?php echo $budget_actual_list->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountCode" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_list->AccountCode->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_list->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->AccountCode->EditValue ?>"<?php echo $budget_actual_list->AccountCode->editAttributes() ?>>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountCode" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_list->AccountCode->OldValue != null ? $budget_actual_list->AccountCode->OldValue : $budget_actual_list->AccountCode->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_AccountCode">
<span<?php echo $budget_actual_list->AccountCode->viewAttributes() ?>><?php echo $budget_actual_list->AccountCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->PostingDate->Visible) { // PostingDate ?>
		<td data-name="PostingDate" <?php echo $budget_actual_list->PostingDate->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_PostingDate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_list->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_list->RowIndex ?>_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_list->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->PostingDate->EditValue ?>"<?php echo $budget_actual_list->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_list->PostingDate->ReadOnly && !$budget_actual_list->PostingDate->Disabled && !isset($budget_actual_list->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_list->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actuallist", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actuallist", "x<?php echo $budget_actual_list->RowIndex ?>_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="o<?php echo $budget_actual_list->RowIndex ?>_PostingDate" id="o<?php echo $budget_actual_list->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_list->PostingDate->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_PostingDate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_list->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_list->RowIndex ?>_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_list->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->PostingDate->EditValue ?>"<?php echo $budget_actual_list->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_list->PostingDate->ReadOnly && !$budget_actual_list->PostingDate->Disabled && !isset($budget_actual_list->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_list->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actuallist", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actuallist", "x<?php echo $budget_actual_list->RowIndex ?>_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_PostingDate">
<span<?php echo $budget_actual_list->PostingDate->viewAttributes() ?>><?php echo $budget_actual_list->PostingDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->AccountMonth->Visible) { // AccountMonth ?>
		<td data-name="AccountMonth" <?php echo $budget_actual_list->AccountMonth->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_AccountMonth" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_list->AccountMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountMonth"<?php echo $budget_actual_list->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_list->AccountMonth->selectOptionListHtml("x{$budget_actual_list->RowIndex}_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_list->AccountMonth->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_AccountMonth") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_list->AccountMonth->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_list->AccountMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountMonth"<?php echo $budget_actual_list->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_list->AccountMonth->selectOptionListHtml("x{$budget_actual_list->RowIndex}_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_list->AccountMonth->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_AccountMonth") ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_list->AccountMonth->OldValue != null ? $budget_actual_list->AccountMonth->OldValue : $budget_actual_list->AccountMonth->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_AccountMonth">
<span<?php echo $budget_actual_list->AccountMonth->viewAttributes() ?>><?php echo $budget_actual_list->AccountMonth->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->AccountYear->Visible) { // AccountYear ?>
		<td data-name="AccountYear" <?php echo $budget_actual_list->AccountYear->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_AccountYear" class="form-group">
<?php
$onchange = $budget_actual_list->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_list->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear">
	<input type="text" class="form-control" name="sv_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="sv_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo RemoveHtml($budget_actual_list->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_list->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_list->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_list->AccountYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_list->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actuallist"], function() {
	fbudget_actuallist.createAutoSuggest({"id":"x<?php echo $budget_actual_list->RowIndex ?>_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_list->AccountYear->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_AccountYear") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_list->AccountYear->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php
$onchange = $budget_actual_list->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_list->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear">
	<input type="text" class="form-control" name="sv_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="sv_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo RemoveHtml($budget_actual_list->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_list->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_list->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_list->AccountYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_list->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actuallist"], function() {
	fbudget_actuallist.createAutoSuggest({"id":"x<?php echo $budget_actual_list->RowIndex ?>_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_list->AccountYear->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_AccountYear") ?>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_list->AccountYear->OldValue != null ? $budget_actual_list->AccountYear->OldValue : $budget_actual_list->AccountYear->CurrentValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_AccountYear">
<span<?php echo $budget_actual_list->AccountYear->viewAttributes() ?>><?php echo $budget_actual_list->AccountYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate" <?php echo $budget_actual_list->BudgetEstimate->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_BudgetEstimate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_list->BudgetEstimate->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="o<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_list->BudgetEstimate->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_BudgetEstimate" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_list->BudgetEstimate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_BudgetEstimate">
<span<?php echo $budget_actual_list->BudgetEstimate->viewAttributes() ?>><?php echo $budget_actual_list->BudgetEstimate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount" <?php echo $budget_actual_list->ActualAmount->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_ActualAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->ActualAmount->EditValue ?>"<?php echo $budget_actual_list->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="o<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" id="o<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_list->ActualAmount->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_ActualAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->ActualAmount->EditValue ?>"<?php echo $budget_actual_list->ActualAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_ActualAmount">
<span<?php echo $budget_actual_list->ActualAmount->viewAttributes() ?>><?php echo $budget_actual_list->ActualAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($budget_actual_list->ForecastAmount->Visible) { // ForecastAmount ?>
		<td data-name="ForecastAmount" <?php echo $budget_actual_list->ForecastAmount->cellAttributes() ?>>
<?php if ($budget_actual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_ForecastAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->ForecastAmount->EditValue ?>"<?php echo $budget_actual_list->ForecastAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="o<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" id="o<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_list->ForecastAmount->OldValue) ?>">
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_ForecastAmount" class="form-group">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->ForecastAmount->EditValue ?>"<?php echo $budget_actual_list->ForecastAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($budget_actual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $budget_actual_list->RowCount ?>_budget_actual_ForecastAmount">
<span<?php echo $budget_actual_list->ForecastAmount->viewAttributes() ?>><?php echo $budget_actual_list->ForecastAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_actual_list->ListOptions->render("body", "right", $budget_actual_list->RowCount);
?>
	</tr>
<?php if ($budget_actual->RowType == ROWTYPE_ADD || $budget_actual->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbudget_actuallist", "load"], function() {
	fbudget_actuallist.updateLists(<?php echo $budget_actual_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$budget_actual_list->isGridAdd())
		if (!$budget_actual_list->Recordset->EOF)
			$budget_actual_list->Recordset->moveNext();
}
?>
<?php
	if ($budget_actual_list->isGridAdd() || $budget_actual_list->isGridEdit()) {
		$budget_actual_list->RowIndex = '$rowindex$';
		$budget_actual_list->loadRowValues();

		// Set row properties
		$budget_actual->resetAttributes();
		$budget_actual->RowAttrs->merge(["data-rowindex" => $budget_actual_list->RowIndex, "id" => "r0_budget_actual", "data-rowtype" => ROWTYPE_ADD]);
		$budget_actual->RowAttrs->appendClass("ew-template");
		$budget_actual->RowType = ROWTYPE_ADD;

		// Render row
		$budget_actual_list->renderRow();

		// Render list options
		$budget_actual_list->renderListOptions();
		$budget_actual_list->StartRowCount = 0;
?>
	<tr <?php echo $budget_actual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$budget_actual_list->ListOptions->render("body", "left", $budget_actual_list->RowIndex);
?>
	<?php if ($budget_actual_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($budget_actual_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_budget_actual_LACode" class="form-group budget_actual_LACode">
<span<?php echo $budget_actual_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($budget_actual_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $budget_actual_list->RowIndex ?>_LACode" name="x<?php echo $budget_actual_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_budget_actual_LACode" class="form-group budget_actual_LACode">
<?php $budget_actual_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_LACode" data-value-separator="<?php echo $budget_actual_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_LACode" name="x<?php echo $budget_actual_list->RowIndex ?>_LACode"<?php echo $budget_actual_list->LACode->editAttributes() ?>>
			<?php echo $budget_actual_list->LACode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $budget_actual_list->LACode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="budget_actual" data-field="x_LACode" name="o<?php echo $budget_actual_list->RowIndex ?>_LACode" id="o<?php echo $budget_actual_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($budget_actual_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_budget_actual_DepartmentCode" class="form-group budget_actual_DepartmentCode">
<?php $budget_actual_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_DepartmentCode" data-value-separator="<?php echo $budget_actual_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode" name="x<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode"<?php echo $budget_actual_list->DepartmentCode->editAttributes() ?>>
			<?php echo $budget_actual_list->DepartmentCode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $budget_actual_list->DepartmentCode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_DepartmentCode" name="o<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode" id="o<?php echo $budget_actual_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($budget_actual_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_budget_actual_SectionCode" class="form-group budget_actual_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_SectionCode" data-value-separator="<?php echo $budget_actual_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_SectionCode" name="x<?php echo $budget_actual_list->RowIndex ?>_SectionCode"<?php echo $budget_actual_list->SectionCode->editAttributes() ?>>
			<?php echo $budget_actual_list->SectionCode->selectOptionListHtml("x{$budget_actual_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $budget_actual_list->SectionCode->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_SectionCode" name="o<?php echo $budget_actual_list->RowIndex ?>_SectionCode" id="o<?php echo $budget_actual_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($budget_actual_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode">
<span id="el$rowindex$_budget_actual_AccountCode" class="form-group budget_actual_AccountCode">
<input type="text" data-table="budget_actual" data-field="x_AccountCode" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountCode" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($budget_actual_list->AccountCode->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->AccountCode->EditValue ?>"<?php echo $budget_actual_list->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountCode" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountCode" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($budget_actual_list->AccountCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->PostingDate->Visible) { // PostingDate ?>
		<td data-name="PostingDate">
<span id="el$rowindex$_budget_actual_PostingDate" class="form-group budget_actual_PostingDate">
<input type="text" data-table="budget_actual" data-field="x_PostingDate" name="x<?php echo $budget_actual_list->RowIndex ?>_PostingDate" id="x<?php echo $budget_actual_list->RowIndex ?>_PostingDate" placeholder="<?php echo HtmlEncode($budget_actual_list->PostingDate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->PostingDate->EditValue ?>"<?php echo $budget_actual_list->PostingDate->editAttributes() ?>>
<?php if (!$budget_actual_list->PostingDate->ReadOnly && !$budget_actual_list->PostingDate->Disabled && !isset($budget_actual_list->PostingDate->EditAttrs["readonly"]) && !isset($budget_actual_list->PostingDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_actuallist", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_actuallist", "x<?php echo $budget_actual_list->RowIndex ?>_PostingDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_PostingDate" name="o<?php echo $budget_actual_list->RowIndex ?>_PostingDate" id="o<?php echo $budget_actual_list->RowIndex ?>_PostingDate" value="<?php echo HtmlEncode($budget_actual_list->PostingDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->AccountMonth->Visible) { // AccountMonth ?>
		<td data-name="AccountMonth">
<span id="el$rowindex$_budget_actual_AccountMonth" class="form-group budget_actual_AccountMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_actual" data-field="x_AccountMonth" data-value-separator="<?php echo $budget_actual_list->AccountMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountMonth"<?php echo $budget_actual_list->AccountMonth->editAttributes() ?>>
			<?php echo $budget_actual_list->AccountMonth->selectOptionListHtml("x{$budget_actual_list->RowIndex}_AccountMonth") ?>
		</select>
</div>
<?php echo $budget_actual_list->AccountMonth->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_AccountMonth") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountMonth" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountMonth" value="<?php echo HtmlEncode($budget_actual_list->AccountMonth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->AccountYear->Visible) { // AccountYear ?>
		<td data-name="AccountYear">
<span id="el$rowindex$_budget_actual_AccountYear" class="form-group budget_actual_AccountYear">
<?php
$onchange = $budget_actual_list->AccountYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$budget_actual_list->AccountYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear">
	<input type="text" class="form-control" name="sv_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="sv_x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo RemoveHtml($budget_actual_list->AccountYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->AccountYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($budget_actual_list->AccountYear->getPlaceHolder()) ?>"<?php echo $budget_actual_list->AccountYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" data-value-separator="<?php echo $budget_actual_list->AccountYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="x<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_list->AccountYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbudget_actuallist"], function() {
	fbudget_actuallist.createAutoSuggest({"id":"x<?php echo $budget_actual_list->RowIndex ?>_AccountYear","forceSelect":false});
});
</script>
<?php echo $budget_actual_list->AccountYear->Lookup->getParamTag($budget_actual_list, "p_x" . $budget_actual_list->RowIndex . "_AccountYear") ?>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_AccountYear" name="o<?php echo $budget_actual_list->RowIndex ?>_AccountYear" id="o<?php echo $budget_actual_list->RowIndex ?>_AccountYear" value="<?php echo HtmlEncode($budget_actual_list->AccountYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->BudgetEstimate->Visible) { // BudgetEstimate ?>
		<td data-name="BudgetEstimate">
<span id="el$rowindex$_budget_actual_BudgetEstimate" class="form-group budget_actual_BudgetEstimate">
<input type="text" data-table="budget_actual" data-field="x_BudgetEstimate" name="x<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" id="x<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->BudgetEstimate->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->BudgetEstimate->EditValue ?>"<?php echo $budget_actual_list->BudgetEstimate->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_BudgetEstimate" name="o<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" id="o<?php echo $budget_actual_list->RowIndex ?>_BudgetEstimate" value="<?php echo HtmlEncode($budget_actual_list->BudgetEstimate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->ActualAmount->Visible) { // ActualAmount ?>
		<td data-name="ActualAmount">
<span id="el$rowindex$_budget_actual_ActualAmount" class="form-group budget_actual_ActualAmount">
<input type="text" data-table="budget_actual" data-field="x_ActualAmount" name="x<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" id="x<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->ActualAmount->EditValue ?>"<?php echo $budget_actual_list->ActualAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ActualAmount" name="o<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" id="o<?php echo $budget_actual_list->RowIndex ?>_ActualAmount" value="<?php echo HtmlEncode($budget_actual_list->ActualAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($budget_actual_list->ForecastAmount->Visible) { // ForecastAmount ?>
		<td data-name="ForecastAmount">
<span id="el$rowindex$_budget_actual_ForecastAmount" class="form-group budget_actual_ForecastAmount">
<input type="text" data-table="budget_actual" data-field="x_ForecastAmount" name="x<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" id="x<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" size="30" placeholder="<?php echo HtmlEncode($budget_actual_list->ForecastAmount->getPlaceHolder()) ?>" value="<?php echo $budget_actual_list->ForecastAmount->EditValue ?>"<?php echo $budget_actual_list->ForecastAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="budget_actual" data-field="x_ForecastAmount" name="o<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" id="o<?php echo $budget_actual_list->RowIndex ?>_ForecastAmount" value="<?php echo HtmlEncode($budget_actual_list->ForecastAmount->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$budget_actual_list->ListOptions->render("body", "right", $budget_actual_list->RowIndex);
?>
<script>
loadjs.ready(["fbudget_actuallist", "load"], function() {
	fbudget_actuallist.updateLists(<?php echo $budget_actual_list->RowIndex ?>);
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
<?php if ($budget_actual_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $budget_actual_list->FormKeyCountName ?>" id="<?php echo $budget_actual_list->FormKeyCountName ?>" value="<?php echo $budget_actual_list->KeyCount ?>">
<?php echo $budget_actual_list->MultiSelectKey ?>
<?php } ?>
<?php if ($budget_actual_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $budget_actual_list->FormKeyCountName ?>" id="<?php echo $budget_actual_list->FormKeyCountName ?>" value="<?php echo $budget_actual_list->KeyCount ?>">
<?php echo $budget_actual_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$budget_actual->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($budget_actual_list->Recordset)
	$budget_actual_list->Recordset->Close();
?>
<?php if (!$budget_actual_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$budget_actual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_actual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $budget_actual_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($budget_actual_list->TotalRecords == 0 && !$budget_actual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $budget_actual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$budget_actual_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$budget_actual_list->isExport()) { ?>
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
$budget_actual_list->terminate();
?>