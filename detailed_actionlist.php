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
$detailed_action_list = new detailed_action_list();

// Run the page
$detailed_action_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailed_action_list->isExport()) { ?>
<script>
var fdetailed_actionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailed_actionlist = currentForm = new ew.Form("fdetailed_actionlist", "list");
	fdetailed_actionlist.formKeyCountName = '<?php echo $detailed_action_list->FormKeyCountName ?>';

	// Validate form
	fdetailed_actionlist.validate = function() {
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
			<?php if ($detailed_action_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->LACode->caption(), $detailed_action_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->DepartmentCode->caption(), $detailed_action_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->SectionCode->caption(), $detailed_action_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->ProgramCode->caption(), $detailed_action_list->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->SubProgramCode->caption(), $detailed_action_list->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->OutcomeCode->caption(), $detailed_action_list->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->OutputCode->caption(), $detailed_action_list->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->ActionCode->caption(), $detailed_action_list->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->FinancialYear->caption(), $detailed_action_list->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_list->FinancialYear->errorMessage()) ?>");
			<?php if ($detailed_action_list->DetailedActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->DetailedActionCode->caption(), $detailed_action_list->DetailedActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->DetailedActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->DetailedActionName->caption(), $detailed_action_list->DetailedActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->DetailedActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->DetailedActionLocation->caption(), $detailed_action_list->DetailedActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->PlannedStartDate->caption(), $detailed_action_list->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_list->PlannedStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_list->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->PlannedEndDate->caption(), $detailed_action_list->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_list->PlannedEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_list->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->ActualStartDate->caption(), $detailed_action_list->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_list->ActualStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_list->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->ActualEndDate->caption(), $detailed_action_list->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_list->ActualEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_list->Ward->Required) { ?>
				elm = this.getElements("x" + infix + "_Ward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->Ward->caption(), $detailed_action_list->Ward->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->ExpectedResult->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedResult");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->ExpectedResult->caption(), $detailed_action_list->ExpectedResult->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->Comments->caption(), $detailed_action_list->Comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_list->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_list->ProgressStatus->caption(), $detailed_action_list->ProgressStatus->RequiredErrorMessage)) ?>");
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
	fdetailed_actionlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutcomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "DetailedActionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DetailedActionLocation", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "PlannedEndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualStartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActualEndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Ward", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExpectedResult", false)) return false;
		if (ew.valueChanged(fobj, infix, "Comments", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProgressStatus", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailed_actionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailed_actionlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailed_actionlist.lists["x_LACode"] = <?php echo $detailed_action_list->LACode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_LACode"].options = <?php echo JsonEncode($detailed_action_list->LACode->lookupOptions()) ?>;
	fdetailed_actionlist.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailed_actionlist.lists["x_DepartmentCode"] = <?php echo $detailed_action_list->DepartmentCode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($detailed_action_list->DepartmentCode->lookupOptions()) ?>;
	fdetailed_actionlist.lists["x_SectionCode"] = <?php echo $detailed_action_list->SectionCode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_SectionCode"].options = <?php echo JsonEncode($detailed_action_list->SectionCode->lookupOptions()) ?>;
	fdetailed_actionlist.lists["x_ProgramCode"] = <?php echo $detailed_action_list->ProgramCode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_ProgramCode"].options = <?php echo JsonEncode($detailed_action_list->ProgramCode->lookupOptions()) ?>;
	fdetailed_actionlist.lists["x_SubProgramCode"] = <?php echo $detailed_action_list->SubProgramCode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_SubProgramCode"].options = <?php echo JsonEncode($detailed_action_list->SubProgramCode->lookupOptions()) ?>;
	fdetailed_actionlist.lists["x_OutcomeCode"] = <?php echo $detailed_action_list->OutcomeCode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_OutcomeCode"].options = <?php echo JsonEncode($detailed_action_list->OutcomeCode->lookupOptions()) ?>;
	fdetailed_actionlist.lists["x_OutputCode"] = <?php echo $detailed_action_list->OutputCode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_OutputCode"].options = <?php echo JsonEncode($detailed_action_list->OutputCode->lookupOptions()) ?>;
	fdetailed_actionlist.lists["x_ActionCode"] = <?php echo $detailed_action_list->ActionCode->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_ActionCode"].options = <?php echo JsonEncode($detailed_action_list->ActionCode->lookupOptions()) ?>;
	fdetailed_actionlist.lists["x_ProgressStatus"] = <?php echo $detailed_action_list->ProgressStatus->Lookup->toClientList($detailed_action_list) ?>;
	fdetailed_actionlist.lists["x_ProgressStatus"].options = <?php echo JsonEncode($detailed_action_list->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fdetailed_actionlist");
});
var fdetailed_actionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailed_actionlistsrch = currentSearchForm = new ew.Form("fdetailed_actionlistsrch");

	// Dynamic selection lists
	// Filters

	fdetailed_actionlistsrch.filterList = <?php echo $detailed_action_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdetailed_actionlistsrch.initSearchPanel = true;
	loadjs.done("fdetailed_actionlistsrch");
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
<?php if (!$detailed_action_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailed_action_list->TotalRecords > 0 && $detailed_action_list->ExportOptions->visible()) { ?>
<?php $detailed_action_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailed_action_list->ImportOptions->visible()) { ?>
<?php $detailed_action_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailed_action_list->SearchOptions->visible()) { ?>
<?php $detailed_action_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailed_action_list->FilterOptions->visible()) { ?>
<?php $detailed_action_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailed_action_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailed_action_list->isExport("print")) { ?>
<?php
if ($detailed_action_list->DbMasterFilter != "" && $detailed_action->getCurrentMasterTable() == "_action") {
	if ($detailed_action_list->MasterRecordExists) {
		include_once "_actionmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailed_action_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$detailed_action_list->isExport() && !$detailed_action->CurrentAction) { ?>
<form name="fdetailed_actionlistsrch" id="fdetailed_actionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdetailed_actionlistsrch-search-panel" class="<?php echo $detailed_action_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="detailed_action">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $detailed_action_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($detailed_action_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($detailed_action_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $detailed_action_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($detailed_action_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($detailed_action_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($detailed_action_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($detailed_action_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $detailed_action_list->showPageHeader(); ?>
<?php
$detailed_action_list->showMessage();
?>
<?php if ($detailed_action_list->TotalRecords > 0 || $detailed_action->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailed_action_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailed_action">
<?php if (!$detailed_action_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailed_action_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailed_action_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailed_action_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailed_actionlist" id="fdetailed_actionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailed_action">
<?php if ($detailed_action->getCurrentMasterTable() == "_action" && $detailed_action->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="_action">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($detailed_action_list->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OucomeCode" value="<?php echo HtmlEncode($detailed_action_list->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($detailed_action_list->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ActionCode" value="<?php echo HtmlEncode($detailed_action_list->ActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($detailed_action_list->FinancialYear->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailed_action" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailed_action_list->TotalRecords > 0 || $detailed_action_list->isGridEdit()) { ?>
<table id="tbl_detailed_actionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailed_action->RowType = ROWTYPE_HEADER;

// Render list options
$detailed_action_list->renderListOptions();

// Render list options (header, left)
$detailed_action_list->ListOptions->render("header", "left");
?>
<?php if ($detailed_action_list->LACode->Visible) { // LACode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $detailed_action_list->LACode->headerCellClass() ?>"><div id="elh_detailed_action_LACode" class="detailed_action_LACode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $detailed_action_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->LACode) ?>', 1);"><div id="elh_detailed_action_LACode" class="detailed_action_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $detailed_action_list->DepartmentCode->headerCellClass() ?>"><div id="elh_detailed_action_DepartmentCode" class="detailed_action_DepartmentCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $detailed_action_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->DepartmentCode) ?>', 1);"><div id="elh_detailed_action_DepartmentCode" class="detailed_action_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $detailed_action_list->SectionCode->headerCellClass() ?>"><div id="elh_detailed_action_SectionCode" class="detailed_action_SectionCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $detailed_action_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->SectionCode) ?>', 1);"><div id="elh_detailed_action_SectionCode" class="detailed_action_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $detailed_action_list->ProgramCode->headerCellClass() ?>"><div id="elh_detailed_action_ProgramCode" class="detailed_action_ProgramCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $detailed_action_list->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->ProgramCode) ?>', 1);"><div id="elh_detailed_action_ProgramCode" class="detailed_action_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $detailed_action_list->SubProgramCode->headerCellClass() ?>"><div id="elh_detailed_action_SubProgramCode" class="detailed_action_SubProgramCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $detailed_action_list->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->SubProgramCode) ?>', 1);"><div id="elh_detailed_action_SubProgramCode" class="detailed_action_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->OutcomeCode) == "") { ?>
		<th data-name="OutcomeCode" class="<?php echo $detailed_action_list->OutcomeCode->headerCellClass() ?>"><div id="elh_detailed_action_OutcomeCode" class="detailed_action_OutcomeCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->OutcomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutcomeCode" class="<?php echo $detailed_action_list->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->OutcomeCode) ?>', 1);"><div id="elh_detailed_action_OutcomeCode" class="detailed_action_OutcomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->OutcomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->OutcomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->OutputCode->Visible) { // OutputCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $detailed_action_list->OutputCode->headerCellClass() ?>"><div id="elh_detailed_action_OutputCode" class="detailed_action_OutputCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $detailed_action_list->OutputCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->OutputCode) ?>', 1);"><div id="elh_detailed_action_OutputCode" class="detailed_action_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->ActionCode->Visible) { // ActionCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->ActionCode) == "") { ?>
		<th data-name="ActionCode" class="<?php echo $detailed_action_list->ActionCode->headerCellClass() ?>"><div id="elh_detailed_action_ActionCode" class="detailed_action_ActionCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->ActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionCode" class="<?php echo $detailed_action_list->ActionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->ActionCode) ?>', 1);"><div id="elh_detailed_action_ActionCode" class="detailed_action_ActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->ActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->ActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $detailed_action_list->FinancialYear->headerCellClass() ?>"><div id="elh_detailed_action_FinancialYear" class="detailed_action_FinancialYear"><div class="ew-table-header-caption"><?php echo $detailed_action_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $detailed_action_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->FinancialYear) ?>', 1);"><div id="elh_detailed_action_FinancialYear" class="detailed_action_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->DetailedActionCode) == "") { ?>
		<th data-name="DetailedActionCode" class="<?php echo $detailed_action_list->DetailedActionCode->headerCellClass() ?>"><div id="elh_detailed_action_DetailedActionCode" class="detailed_action_DetailedActionCode"><div class="ew-table-header-caption"><?php echo $detailed_action_list->DetailedActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionCode" class="<?php echo $detailed_action_list->DetailedActionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->DetailedActionCode) ?>', 1);"><div id="elh_detailed_action_DetailedActionCode" class="detailed_action_DetailedActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->DetailedActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->DetailedActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->DetailedActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->DetailedActionName->Visible) { // DetailedActionName ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->DetailedActionName) == "") { ?>
		<th data-name="DetailedActionName" class="<?php echo $detailed_action_list->DetailedActionName->headerCellClass() ?>"><div id="elh_detailed_action_DetailedActionName" class="detailed_action_DetailedActionName"><div class="ew-table-header-caption"><?php echo $detailed_action_list->DetailedActionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionName" class="<?php echo $detailed_action_list->DetailedActionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->DetailedActionName) ?>', 1);"><div id="elh_detailed_action_DetailedActionName" class="detailed_action_DetailedActionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->DetailedActionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->DetailedActionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->DetailedActionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->DetailedActionLocation) == "") { ?>
		<th data-name="DetailedActionLocation" class="<?php echo $detailed_action_list->DetailedActionLocation->headerCellClass() ?>"><div id="elh_detailed_action_DetailedActionLocation" class="detailed_action_DetailedActionLocation"><div class="ew-table-header-caption"><?php echo $detailed_action_list->DetailedActionLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DetailedActionLocation" class="<?php echo $detailed_action_list->DetailedActionLocation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->DetailedActionLocation) ?>', 1);"><div id="elh_detailed_action_DetailedActionLocation" class="detailed_action_DetailedActionLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->DetailedActionLocation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->DetailedActionLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->DetailedActionLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->PlannedStartDate) == "") { ?>
		<th data-name="PlannedStartDate" class="<?php echo $detailed_action_list->PlannedStartDate->headerCellClass() ?>"><div id="elh_detailed_action_PlannedStartDate" class="detailed_action_PlannedStartDate"><div class="ew-table-header-caption"><?php echo $detailed_action_list->PlannedStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedStartDate" class="<?php echo $detailed_action_list->PlannedStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->PlannedStartDate) ?>', 1);"><div id="elh_detailed_action_PlannedStartDate" class="detailed_action_PlannedStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->PlannedStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->PlannedStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->PlannedEndDate) == "") { ?>
		<th data-name="PlannedEndDate" class="<?php echo $detailed_action_list->PlannedEndDate->headerCellClass() ?>"><div id="elh_detailed_action_PlannedEndDate" class="detailed_action_PlannedEndDate"><div class="ew-table-header-caption"><?php echo $detailed_action_list->PlannedEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedEndDate" class="<?php echo $detailed_action_list->PlannedEndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->PlannedEndDate) ?>', 1);"><div id="elh_detailed_action_PlannedEndDate" class="detailed_action_PlannedEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->PlannedEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->PlannedEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->ActualStartDate) == "") { ?>
		<th data-name="ActualStartDate" class="<?php echo $detailed_action_list->ActualStartDate->headerCellClass() ?>"><div id="elh_detailed_action_ActualStartDate" class="detailed_action_ActualStartDate"><div class="ew-table-header-caption"><?php echo $detailed_action_list->ActualStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualStartDate" class="<?php echo $detailed_action_list->ActualStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->ActualStartDate) ?>', 1);"><div id="elh_detailed_action_ActualStartDate" class="detailed_action_ActualStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->ActualStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->ActualStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->ActualEndDate->Visible) { // ActualEndDate ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->ActualEndDate) == "") { ?>
		<th data-name="ActualEndDate" class="<?php echo $detailed_action_list->ActualEndDate->headerCellClass() ?>"><div id="elh_detailed_action_ActualEndDate" class="detailed_action_ActualEndDate"><div class="ew-table-header-caption"><?php echo $detailed_action_list->ActualEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualEndDate" class="<?php echo $detailed_action_list->ActualEndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->ActualEndDate) ?>', 1);"><div id="elh_detailed_action_ActualEndDate" class="detailed_action_ActualEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->ActualEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->ActualEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->ActualEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->Ward->Visible) { // Ward ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->Ward) == "") { ?>
		<th data-name="Ward" class="<?php echo $detailed_action_list->Ward->headerCellClass() ?>"><div id="elh_detailed_action_Ward" class="detailed_action_Ward"><div class="ew-table-header-caption"><?php echo $detailed_action_list->Ward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Ward" class="<?php echo $detailed_action_list->Ward->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->Ward) ?>', 1);"><div id="elh_detailed_action_Ward" class="detailed_action_Ward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->Ward->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->Ward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->Ward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->ExpectedResult->Visible) { // ExpectedResult ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->ExpectedResult) == "") { ?>
		<th data-name="ExpectedResult" class="<?php echo $detailed_action_list->ExpectedResult->headerCellClass() ?>"><div id="elh_detailed_action_ExpectedResult" class="detailed_action_ExpectedResult"><div class="ew-table-header-caption"><?php echo $detailed_action_list->ExpectedResult->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedResult" class="<?php echo $detailed_action_list->ExpectedResult->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->ExpectedResult) ?>', 1);"><div id="elh_detailed_action_ExpectedResult" class="detailed_action_ExpectedResult">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->ExpectedResult->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->ExpectedResult->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->ExpectedResult->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->Comments->Visible) { // Comments ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->Comments) == "") { ?>
		<th data-name="Comments" class="<?php echo $detailed_action_list->Comments->headerCellClass() ?>"><div id="elh_detailed_action_Comments" class="detailed_action_Comments"><div class="ew-table-header-caption"><?php echo $detailed_action_list->Comments->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comments" class="<?php echo $detailed_action_list->Comments->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->Comments) ?>', 1);"><div id="elh_detailed_action_Comments" class="detailed_action_Comments">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->Comments->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->Comments->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->Comments->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_list->ProgressStatus->Visible) { // ProgressStatus ?>
	<?php if ($detailed_action_list->SortUrl($detailed_action_list->ProgressStatus) == "") { ?>
		<th data-name="ProgressStatus" class="<?php echo $detailed_action_list->ProgressStatus->headerCellClass() ?>"><div id="elh_detailed_action_ProgressStatus" class="detailed_action_ProgressStatus"><div class="ew-table-header-caption"><?php echo $detailed_action_list->ProgressStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgressStatus" class="<?php echo $detailed_action_list->ProgressStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailed_action_list->SortUrl($detailed_action_list->ProgressStatus) ?>', 1);"><div id="elh_detailed_action_ProgressStatus" class="detailed_action_ProgressStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_list->ProgressStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_list->ProgressStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_list->ProgressStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailed_action_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailed_action_list->ExportAll && $detailed_action_list->isExport()) {
	$detailed_action_list->StopRecord = $detailed_action_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailed_action_list->TotalRecords > $detailed_action_list->StartRecord + $detailed_action_list->DisplayRecords - 1)
		$detailed_action_list->StopRecord = $detailed_action_list->StartRecord + $detailed_action_list->DisplayRecords - 1;
	else
		$detailed_action_list->StopRecord = $detailed_action_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($detailed_action->isConfirm() || $detailed_action_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailed_action_list->FormKeyCountName) && ($detailed_action_list->isGridAdd() || $detailed_action_list->isGridEdit() || $detailed_action->isConfirm())) {
		$detailed_action_list->KeyCount = $CurrentForm->getValue($detailed_action_list->FormKeyCountName);
		$detailed_action_list->StopRecord = $detailed_action_list->StartRecord + $detailed_action_list->KeyCount - 1;
	}
}
$detailed_action_list->RecordCount = $detailed_action_list->StartRecord - 1;
if ($detailed_action_list->Recordset && !$detailed_action_list->Recordset->EOF) {
	$detailed_action_list->Recordset->moveFirst();
	$selectLimit = $detailed_action_list->UseSelectLimit;
	if (!$selectLimit && $detailed_action_list->StartRecord > 1)
		$detailed_action_list->Recordset->move($detailed_action_list->StartRecord - 1);
} elseif (!$detailed_action->AllowAddDeleteRow && $detailed_action_list->StopRecord == 0) {
	$detailed_action_list->StopRecord = $detailed_action->GridAddRowCount;
}

// Initialize aggregate
$detailed_action->RowType = ROWTYPE_AGGREGATEINIT;
$detailed_action->resetAttributes();
$detailed_action_list->renderRow();
if ($detailed_action_list->isGridAdd())
	$detailed_action_list->RowIndex = 0;
if ($detailed_action_list->isGridEdit())
	$detailed_action_list->RowIndex = 0;
while ($detailed_action_list->RecordCount < $detailed_action_list->StopRecord) {
	$detailed_action_list->RecordCount++;
	if ($detailed_action_list->RecordCount >= $detailed_action_list->StartRecord) {
		$detailed_action_list->RowCount++;
		if ($detailed_action_list->isGridAdd() || $detailed_action_list->isGridEdit() || $detailed_action->isConfirm()) {
			$detailed_action_list->RowIndex++;
			$CurrentForm->Index = $detailed_action_list->RowIndex;
			if ($CurrentForm->hasValue($detailed_action_list->FormActionName) && ($detailed_action->isConfirm() || $detailed_action_list->EventCancelled))
				$detailed_action_list->RowAction = strval($CurrentForm->getValue($detailed_action_list->FormActionName));
			elseif ($detailed_action_list->isGridAdd())
				$detailed_action_list->RowAction = "insert";
			else
				$detailed_action_list->RowAction = "";
		}

		// Set up key count
		$detailed_action_list->KeyCount = $detailed_action_list->RowIndex;

		// Init row class and style
		$detailed_action->resetAttributes();
		$detailed_action->CssClass = "";
		if ($detailed_action_list->isGridAdd()) {
			$detailed_action_list->loadRowValues(); // Load default values
		} else {
			$detailed_action_list->loadRowValues($detailed_action_list->Recordset); // Load row values
		}
		$detailed_action->RowType = ROWTYPE_VIEW; // Render view
		if ($detailed_action_list->isGridAdd()) // Grid add
			$detailed_action->RowType = ROWTYPE_ADD; // Render add
		if ($detailed_action_list->isGridAdd() && $detailed_action->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailed_action_list->restoreCurrentRowFormValues($detailed_action_list->RowIndex); // Restore form values
		if ($detailed_action_list->isGridEdit()) { // Grid edit
			if ($detailed_action->EventCancelled)
				$detailed_action_list->restoreCurrentRowFormValues($detailed_action_list->RowIndex); // Restore form values
			if ($detailed_action_list->RowAction == "insert")
				$detailed_action->RowType = ROWTYPE_ADD; // Render add
			else
				$detailed_action->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailed_action_list->isGridEdit() && ($detailed_action->RowType == ROWTYPE_EDIT || $detailed_action->RowType == ROWTYPE_ADD) && $detailed_action->EventCancelled) // Update failed
			$detailed_action_list->restoreCurrentRowFormValues($detailed_action_list->RowIndex); // Restore form values
		if ($detailed_action->RowType == ROWTYPE_EDIT) // Edit row
			$detailed_action_list->EditRowCount++;

		// Set up row id / data-rowindex
		$detailed_action->RowAttrs->merge(["data-rowindex" => $detailed_action_list->RowCount, "id" => "r" . $detailed_action_list->RowCount . "_detailed_action", "data-rowtype" => $detailed_action->RowType]);

		// Render row
		$detailed_action_list->renderRow();

		// Render list options
		$detailed_action_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailed_action_list->RowAction != "delete" && $detailed_action_list->RowAction != "insertdelete" && !($detailed_action_list->RowAction == "insert" && $detailed_action->isConfirm() && $detailed_action_list->emptyRow())) {
?>
	<tr <?php echo $detailed_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailed_action_list->ListOptions->render("body", "left", $detailed_action_list->RowCount);
?>
	<?php if ($detailed_action_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $detailed_action_list->LACode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_LACode" class="form-group">
<span<?php echo $detailed_action_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_LACode" name="x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_LACode" class="form-group">
<?php
$onchange = $detailed_action_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailed_action_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailed_action_list->RowIndex ?>_LACode" id="sv_x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($detailed_action_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_list->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->LACode->ReadOnly || $detailed_action_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_LACode" id="x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actionlist"], function() {
	fdetailed_actionlist.createAutoSuggest({"id":"x<?php echo $detailed_action_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_list->LACode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="o<?php echo $detailed_action_list->RowIndex ?>_LACode" id="o<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_LACode" class="form-group">
<span<?php echo $detailed_action_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_LACode" name="x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_LACode" class="form-group">
<?php
$onchange = $detailed_action_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailed_action_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailed_action_list->RowIndex ?>_LACode" id="sv_x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($detailed_action_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_list->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->LACode->ReadOnly || $detailed_action_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_LACode" id="x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actionlist"], function() {
	fdetailed_actionlist.createAutoSuggest({"id":"x<?php echo $detailed_action_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_list->LACode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_LACode">
<span<?php echo $detailed_action_list->LACode->viewAttributes() ?>><?php echo $detailed_action_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $detailed_action_list->DepartmentCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<span<?php echo $detailed_action_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<?php $detailed_action_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode"<?php echo $detailed_action_list->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_list->DepartmentCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->DepartmentCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="o<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" id="o<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<span<?php echo $detailed_action_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DepartmentCode" class="form-group">
<?php $detailed_action_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode"<?php echo $detailed_action_list->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_list->DepartmentCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->DepartmentCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DepartmentCode">
<span<?php echo $detailed_action_list->DepartmentCode->viewAttributes() ?>><?php echo $detailed_action_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $detailed_action_list->SectionCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_SectionCode" name="x<?php echo $detailed_action_list->RowIndex ?>_SectionCode"<?php echo $detailed_action_list->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_list->SectionCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->SectionCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="o<?php echo $detailed_action_list->RowIndex ?>_SectionCode" id="o<?php echo $detailed_action_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_SectionCode" name="x<?php echo $detailed_action_list->RowIndex ?>_SectionCode"<?php echo $detailed_action_list->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_list->SectionCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->SectionCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_SectionCode">
<span<?php echo $detailed_action_list->SectionCode->viewAttributes() ?>><?php echo $detailed_action_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $detailed_action_list->ProgramCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<span<?php echo $detailed_action_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<?php $detailed_action_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_list->ProgramCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode"<?php echo $detailed_action_list->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_list->ProgramCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->ProgramCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="o<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" id="o<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_list->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<span<?php echo $detailed_action_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgramCode" class="form-group">
<?php $detailed_action_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_list->ProgramCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode"<?php echo $detailed_action_list->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_list->ProgramCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->ProgramCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgramCode">
<span<?php echo $detailed_action_list->ProgramCode->viewAttributes() ?>><?php echo $detailed_action_list->ProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $detailed_action_list->SubProgramCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->SubProgramCode->ReadOnly || $detailed_action_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->SubProgramCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" value="<?php echo $detailed_action_list->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="o<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" id="o<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_list->SubProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_SubProgramCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->SubProgramCode->ReadOnly || $detailed_action_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->SubProgramCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" value="<?php echo $detailed_action_list->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_list->SubProgramCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_SubProgramCode">
<span<?php echo $detailed_action_list->SubProgramCode->viewAttributes() ?>><?php echo $detailed_action_list->SubProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode" <?php echo $detailed_action_list->OutcomeCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<span<?php echo $detailed_action_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" name="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<?php $detailed_action_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->OutcomeCode->ReadOnly || $detailed_action_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->OutcomeCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo $detailed_action_list->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="o<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" id="o<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_list->OutcomeCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<span<?php echo $detailed_action_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" name="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutcomeCode" class="form-group">
<?php $detailed_action_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->OutcomeCode->ReadOnly || $detailed_action_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->OutcomeCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo $detailed_action_list->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutcomeCode">
<span<?php echo $detailed_action_list->OutcomeCode->viewAttributes() ?>><?php echo $detailed_action_list->OutcomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $detailed_action_list->OutputCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_list->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutputCode" class="form-group">
<span<?php echo $detailed_action_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" name="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutputCode" class="form-group">
<?php $detailed_action_list->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($detailed_action_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->OutputCode->ReadOnly || $detailed_action_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->OutputCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo $detailed_action_list->OutputCode->CurrentValue ?>"<?php echo $detailed_action_list->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="o<?php echo $detailed_action_list->RowIndex ?>_OutputCode" id="o<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_list->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_list->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutputCode" class="form-group">
<span<?php echo $detailed_action_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" name="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutputCode" class="form-group">
<?php $detailed_action_list->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($detailed_action_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->OutputCode->ReadOnly || $detailed_action_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->OutputCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo $detailed_action_list->OutputCode->CurrentValue ?>"<?php echo $detailed_action_list->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_OutputCode">
<span<?php echo $detailed_action_list->OutputCode->viewAttributes() ?>><?php echo $detailed_action_list->OutputCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" <?php echo $detailed_action_list->ActionCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_list->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActionCode" class="form-group">
<span<?php echo $detailed_action_list->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_list->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_ActionCode"><?php echo EmptyValue(strval($detailed_action_list->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->ActionCode->ReadOnly || $detailed_action_list->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->ActionCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->ActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo $detailed_action_list->ActionCode->CurrentValue ?>"<?php echo $detailed_action_list->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="o<?php echo $detailed_action_list->RowIndex ?>_ActionCode" id="o<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_list->ActionCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_list->ActionCode->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActionCode" class="form-group">
<span<?php echo $detailed_action_list->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_list->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_ActionCode"><?php echo EmptyValue(strval($detailed_action_list->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->ActionCode->ReadOnly || $detailed_action_list->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->ActionCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->ActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo $detailed_action_list->ActionCode->CurrentValue ?>"<?php echo $detailed_action_list->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActionCode">
<span<?php echo $detailed_action_list->ActionCode->viewAttributes() ?>><?php echo $detailed_action_list->ActionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $detailed_action_list->FinancialYear->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailed_action_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<span<?php echo $detailed_action_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" name="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->FinancialYear->EditValue ?>"<?php echo $detailed_action_list->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="o<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" id="o<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_list->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailed_action_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<span<?php echo $detailed_action_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" name="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_FinancialYear" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->FinancialYear->EditValue ?>"<?php echo $detailed_action_list->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_FinancialYear">
<span<?php echo $detailed_action_list->FinancialYear->viewAttributes() ?>><?php echo $detailed_action_list->FinancialYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode" <?php echo $detailed_action_list->DetailedActionCode->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionCode" class="form-group"></span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionCode" id="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_list->DetailedActionCode->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionCode" class="form-group">
<span<?php echo $detailed_action_list->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->DetailedActionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionCode" id="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_list->DetailedActionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionCode">
<span<?php echo $detailed_action_list->DetailedActionCode->viewAttributes() ?>><?php echo $detailed_action_list->DetailedActionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DetailedActionName->Visible) { // DetailedActionName ?>
		<td data-name="DetailedActionName" <?php echo $detailed_action_list->DetailedActionName->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionName" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_list->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->DetailedActionName->EditValue ?>"<?php echo $detailed_action_list->DetailedActionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" id="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_list->DetailedActionName->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionName" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_list->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->DetailedActionName->EditValue ?>"<?php echo $detailed_action_list->DetailedActionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionName">
<span<?php echo $detailed_action_list->DetailedActionName->viewAttributes() ?>><?php echo $detailed_action_list->DetailedActionName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
		<td data-name="DetailedActionLocation" <?php echo $detailed_action_list->DetailedActionLocation->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionLocation" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_list->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_list->DetailedActionLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" id="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_list->DetailedActionLocation->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionLocation" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_list->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_list->DetailedActionLocation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_DetailedActionLocation">
<span<?php echo $detailed_action_list->DetailedActionLocation->viewAttributes() ?>><?php echo $detailed_action_list->DetailedActionLocation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate" <?php echo $detailed_action_list->PlannedStartDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_PlannedStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_list->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_list->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_list->PlannedStartDate->ReadOnly && !$detailed_action_list->PlannedStartDate->Disabled && !isset($detailed_action_list->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_list->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="o<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" id="o<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_list->PlannedStartDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_PlannedStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_list->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_list->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_list->PlannedStartDate->ReadOnly && !$detailed_action_list->PlannedStartDate->Disabled && !isset($detailed_action_list->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_list->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_PlannedStartDate">
<span<?php echo $detailed_action_list->PlannedStartDate->viewAttributes() ?>><?php echo $detailed_action_list->PlannedStartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate" <?php echo $detailed_action_list->PlannedEndDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_PlannedEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_list->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_list->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_list->PlannedEndDate->ReadOnly && !$detailed_action_list->PlannedEndDate->Disabled && !isset($detailed_action_list->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_list->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="o<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" id="o<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_list->PlannedEndDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_PlannedEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_list->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_list->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_list->PlannedEndDate->ReadOnly && !$detailed_action_list->PlannedEndDate->Disabled && !isset($detailed_action_list->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_list->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_PlannedEndDate">
<span<?php echo $detailed_action_list->PlannedEndDate->viewAttributes() ?>><?php echo $detailed_action_list->PlannedEndDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate" <?php echo $detailed_action_list->ActualStartDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActualStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_list->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->ActualStartDate->EditValue ?>"<?php echo $detailed_action_list->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_list->ActualStartDate->ReadOnly && !$detailed_action_list->ActualStartDate->Disabled && !isset($detailed_action_list->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_list->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="o<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" id="o<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_list->ActualStartDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActualStartDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_list->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->ActualStartDate->EditValue ?>"<?php echo $detailed_action_list->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_list->ActualStartDate->ReadOnly && !$detailed_action_list->ActualStartDate->Disabled && !isset($detailed_action_list->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_list->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActualStartDate">
<span<?php echo $detailed_action_list->ActualStartDate->viewAttributes() ?>><?php echo $detailed_action_list->ActualStartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate" <?php echo $detailed_action_list->ActualEndDate->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActualEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_list->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->ActualEndDate->EditValue ?>"<?php echo $detailed_action_list->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_list->ActualEndDate->ReadOnly && !$detailed_action_list->ActualEndDate->Disabled && !isset($detailed_action_list->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_list->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="o<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" id="o<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_list->ActualEndDate->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActualEndDate" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_list->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->ActualEndDate->EditValue ?>"<?php echo $detailed_action_list->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_list->ActualEndDate->ReadOnly && !$detailed_action_list->ActualEndDate->Disabled && !isset($detailed_action_list->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_list->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ActualEndDate">
<span<?php echo $detailed_action_list->ActualEndDate->viewAttributes() ?>><?php echo $detailed_action_list->ActualEndDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->Ward->Visible) { // Ward ?>
		<td data-name="Ward" <?php echo $detailed_action_list->Ward->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_Ward" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_list->RowIndex ?>_Ward" id="x<?php echo $detailed_action_list->RowIndex ?>_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_list->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->Ward->EditValue ?>"<?php echo $detailed_action_list->Ward->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="o<?php echo $detailed_action_list->RowIndex ?>_Ward" id="o<?php echo $detailed_action_list->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_list->Ward->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_Ward" class="form-group">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_list->RowIndex ?>_Ward" id="x<?php echo $detailed_action_list->RowIndex ?>_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_list->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->Ward->EditValue ?>"<?php echo $detailed_action_list->Ward->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_Ward">
<span<?php echo $detailed_action_list->Ward->viewAttributes() ?>><?php echo $detailed_action_list->Ward->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ExpectedResult->Visible) { // ExpectedResult ?>
		<td data-name="ExpectedResult" <?php echo $detailed_action_list->ExpectedResult->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ExpectedResult" class="form-group">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_list->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_list->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_list->ExpectedResult->EditValue ?></textarea>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="o<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" id="o<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_list->ExpectedResult->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ExpectedResult" class="form-group">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_list->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_list->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_list->ExpectedResult->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ExpectedResult">
<span<?php echo $detailed_action_list->ExpectedResult->viewAttributes() ?>><?php echo $detailed_action_list->ExpectedResult->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->Comments->Visible) { // Comments ?>
		<td data-name="Comments" <?php echo $detailed_action_list->Comments->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_Comments" class="form-group">
<textarea data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_list->RowIndex ?>_Comments" id="x<?php echo $detailed_action_list->RowIndex ?>_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_list->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_list->Comments->editAttributes() ?>><?php echo $detailed_action_list->Comments->EditValue ?></textarea>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="o<?php echo $detailed_action_list->RowIndex ?>_Comments" id="o<?php echo $detailed_action_list->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_list->Comments->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_Comments" class="form-group">
<textarea data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_list->RowIndex ?>_Comments" id="x<?php echo $detailed_action_list->RowIndex ?>_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_list->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_list->Comments->editAttributes() ?>><?php echo $detailed_action_list->Comments->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_Comments">
<span<?php echo $detailed_action_list->Comments->viewAttributes() ?>><?php echo $detailed_action_list->Comments->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus" <?php echo $detailed_action_list->ProgressStatus->cellAttributes() ?>>
<?php if ($detailed_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgressStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_list->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus"<?php echo $detailed_action_list->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_list->ProgressStatus->selectOptionListHtml("x{$detailed_action_list->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_list->ProgressStatus->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ProgressStatus") ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="o<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus" id="o<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_list->ProgressStatus->OldValue) ?>">
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgressStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_list->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus"<?php echo $detailed_action_list->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_list->ProgressStatus->selectOptionListHtml("x{$detailed_action_list->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_list->ProgressStatus->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ProgressStatus") ?>
</span>
<?php } ?>
<?php if ($detailed_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailed_action_list->RowCount ?>_detailed_action_ProgressStatus">
<span<?php echo $detailed_action_list->ProgressStatus->viewAttributes() ?>><?php echo $detailed_action_list->ProgressStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailed_action_list->ListOptions->render("body", "right", $detailed_action_list->RowCount);
?>
	</tr>
<?php if ($detailed_action->RowType == ROWTYPE_ADD || $detailed_action->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "load"], function() {
	fdetailed_actionlist.updateLists(<?php echo $detailed_action_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailed_action_list->isGridAdd())
		if (!$detailed_action_list->Recordset->EOF)
			$detailed_action_list->Recordset->moveNext();
}
?>
<?php
	if ($detailed_action_list->isGridAdd() || $detailed_action_list->isGridEdit()) {
		$detailed_action_list->RowIndex = '$rowindex$';
		$detailed_action_list->loadRowValues();

		// Set row properties
		$detailed_action->resetAttributes();
		$detailed_action->RowAttrs->merge(["data-rowindex" => $detailed_action_list->RowIndex, "id" => "r0_detailed_action", "data-rowtype" => ROWTYPE_ADD]);
		$detailed_action->RowAttrs->appendClass("ew-template");
		$detailed_action->RowType = ROWTYPE_ADD;

		// Render row
		$detailed_action_list->renderRow();

		// Render list options
		$detailed_action_list->renderListOptions();
		$detailed_action_list->StartRowCount = 0;
?>
	<tr <?php echo $detailed_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailed_action_list->ListOptions->render("body", "left", $detailed_action_list->RowIndex);
?>
	<?php if ($detailed_action_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($detailed_action_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_LACode" class="form-group detailed_action_LACode">
<span<?php echo $detailed_action_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_LACode" name="x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_LACode" class="form-group detailed_action_LACode">
<?php
$onchange = $detailed_action_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailed_action_list->RowIndex ?>_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailed_action_list->RowIndex ?>_LACode" id="sv_x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($detailed_action_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_list->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_list->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->LACode->ReadOnly || $detailed_action_list->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_LACode" id="x<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actionlist"], function() {
	fdetailed_actionlist.createAutoSuggest({"id":"x<?php echo $detailed_action_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_list->LACode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" name="o<?php echo $detailed_action_list->RowIndex ?>_LACode" id="o<?php echo $detailed_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($detailed_action_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if ($detailed_action_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_DepartmentCode" class="form-group detailed_action_DepartmentCode">
<span<?php echo $detailed_action_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_DepartmentCode" class="form-group detailed_action_DepartmentCode">
<?php $detailed_action_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode"<?php echo $detailed_action_list->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_list->DepartmentCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->DepartmentCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_DepartmentCode" name="o<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" id="o<?php echo $detailed_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_detailed_action_SectionCode" class="form-group detailed_action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_SectionCode" name="x<?php echo $detailed_action_list->RowIndex ?>_SectionCode"<?php echo $detailed_action_list->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_list->SectionCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->SectionCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SectionCode" name="o<?php echo $detailed_action_list->RowIndex ?>_SectionCode" id="o<?php echo $detailed_action_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($detailed_action_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if ($detailed_action_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_ProgramCode" class="form-group detailed_action_ProgramCode">
<span<?php echo $detailed_action_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ProgramCode" class="form-group detailed_action_ProgramCode">
<?php $detailed_action_list->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_list->ProgramCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgramCode"<?php echo $detailed_action_list->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_list->ProgramCode->selectOptionListHtml("x{$detailed_action_list->RowIndex}_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_list->ProgramCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ProgramCode" name="o<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" id="o<?php echo $detailed_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($detailed_action_list->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode">
<span id="el$rowindex$_detailed_action_SubProgramCode" class="form-group detailed_action_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_list->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->SubProgramCode->ReadOnly || $detailed_action_list->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->SubProgramCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" id="x<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" value="<?php echo $detailed_action_list->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_list->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" name="o<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" id="o<?php echo $detailed_action_list->RowIndex ?>_SubProgramCode" value="<?php echo HtmlEncode($detailed_action_list->SubProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->OutcomeCode->Visible) { // OutcomeCode ?>
		<td data-name="OutcomeCode">
<?php if ($detailed_action_list->OutcomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_OutcomeCode" class="form-group detailed_action_OutcomeCode">
<span<?php echo $detailed_action_list->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" name="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_list->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_OutcomeCode" class="form-group detailed_action_OutcomeCode">
<?php $detailed_action_list->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_list->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->OutcomeCode->ReadOnly || $detailed_action_list->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->OutcomeCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" id="x<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo $detailed_action_list->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_list->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" name="o<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" id="o<?php echo $detailed_action_list->RowIndex ?>_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_list->OutcomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if ($detailed_action_list->OutputCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_OutputCode" class="form-group detailed_action_OutputCode">
<span<?php echo $detailed_action_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" name="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_OutputCode" class="form-group detailed_action_OutputCode">
<?php $detailed_action_list->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_OutputCode"><?php echo EmptyValue(strval($detailed_action_list->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->OutputCode->ReadOnly || $detailed_action_list->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->OutputCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" id="x<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo $detailed_action_list->OutputCode->CurrentValue ?>"<?php echo $detailed_action_list->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" name="o<?php echo $detailed_action_list->RowIndex ?>_OutputCode" id="o<?php echo $detailed_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($detailed_action_list->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode">
<?php if ($detailed_action_list->ActionCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_ActionCode" class="form-group detailed_action_ActionCode">
<span<?php echo $detailed_action_list->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" name="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_list->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_ActionCode" class="form-group detailed_action_ActionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailed_action_list->RowIndex ?>_ActionCode"><?php echo EmptyValue(strval($detailed_action_list->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_list->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_list->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_list->ActionCode->ReadOnly || $detailed_action_list->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailed_action_list->RowIndex ?>_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_list->ActionCode->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_list->ActionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" id="x<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo $detailed_action_list->ActionCode->CurrentValue ?>"<?php echo $detailed_action_list->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" name="o<?php echo $detailed_action_list->RowIndex ?>_ActionCode" id="o<?php echo $detailed_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($detailed_action_list->ActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if ($detailed_action_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailed_action_FinancialYear" class="form-group detailed_action_FinancialYear">
<span<?php echo $detailed_action_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" name="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailed_action_FinancialYear" class="form-group detailed_action_FinancialYear">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" id="x<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->FinancialYear->EditValue ?>"<?php echo $detailed_action_list->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailed_action" data-field="x_FinancialYear" name="o<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" id="o<?php echo $detailed_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($detailed_action_list->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<td data-name="DetailedActionCode">
<span id="el$rowindex$_detailed_action_DetailedActionCode" class="form-group detailed_action_DetailedActionCode"></span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionCode" id="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_list->DetailedActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DetailedActionName->Visible) { // DetailedActionName ?>
		<td data-name="DetailedActionName">
<span id="el$rowindex$_detailed_action_DetailedActionName" class="form-group detailed_action_DetailedActionName">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" id="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_list->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->DetailedActionName->EditValue ?>"<?php echo $detailed_action_list->DetailedActionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionName" name="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" id="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionName" value="<?php echo HtmlEncode($detailed_action_list->DetailedActionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
		<td data-name="DetailedActionLocation">
<span id="el$rowindex$_detailed_action_DetailedActionLocation" class="form-group detailed_action_DetailedActionLocation">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" id="x<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_list->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_list->DetailedActionLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionLocation" name="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" id="o<?php echo $detailed_action_list->RowIndex ?>_DetailedActionLocation" value="<?php echo HtmlEncode($detailed_action_list->DetailedActionLocation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate">
<span id="el$rowindex$_detailed_action_PlannedStartDate" class="form-group detailed_action_PlannedStartDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" id="x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_list->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_list->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_list->PlannedStartDate->ReadOnly && !$detailed_action_list->PlannedStartDate->Disabled && !isset($detailed_action_list->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_list->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedStartDate" name="o<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" id="o<?php echo $detailed_action_list->RowIndex ?>_PlannedStartDate" value="<?php echo HtmlEncode($detailed_action_list->PlannedStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate">
<span id="el$rowindex$_detailed_action_PlannedEndDate" class="form-group detailed_action_PlannedEndDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" id="x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_list->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_list->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_list->PlannedEndDate->ReadOnly && !$detailed_action_list->PlannedEndDate->Disabled && !isset($detailed_action_list->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_list->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_PlannedEndDate" name="o<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" id="o<?php echo $detailed_action_list->RowIndex ?>_PlannedEndDate" value="<?php echo HtmlEncode($detailed_action_list->PlannedEndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate">
<span id="el$rowindex$_detailed_action_ActualStartDate" class="form-group detailed_action_ActualStartDate">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" id="x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_list->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->ActualStartDate->EditValue ?>"<?php echo $detailed_action_list->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_list->ActualStartDate->ReadOnly && !$detailed_action_list->ActualStartDate->Disabled && !isset($detailed_action_list->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_list->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualStartDate" name="o<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" id="o<?php echo $detailed_action_list->RowIndex ?>_ActualStartDate" value="<?php echo HtmlEncode($detailed_action_list->ActualStartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate">
<span id="el$rowindex$_detailed_action_ActualEndDate" class="form-group detailed_action_ActualEndDate">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" id="x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_list->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->ActualEndDate->EditValue ?>"<?php echo $detailed_action_list->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_list->ActualEndDate->ReadOnly && !$detailed_action_list->ActualEndDate->Disabled && !isset($detailed_action_list->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_list->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionlist", "x<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ActualEndDate" name="o<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" id="o<?php echo $detailed_action_list->RowIndex ?>_ActualEndDate" value="<?php echo HtmlEncode($detailed_action_list->ActualEndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->Ward->Visible) { // Ward ?>
		<td data-name="Ward">
<span id="el$rowindex$_detailed_action_Ward" class="form-group detailed_action_Ward">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x<?php echo $detailed_action_list->RowIndex ?>_Ward" id="x<?php echo $detailed_action_list->RowIndex ?>_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_list->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_list->Ward->EditValue ?>"<?php echo $detailed_action_list->Ward->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Ward" name="o<?php echo $detailed_action_list->RowIndex ?>_Ward" id="o<?php echo $detailed_action_list->RowIndex ?>_Ward" value="<?php echo HtmlEncode($detailed_action_list->Ward->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ExpectedResult->Visible) { // ExpectedResult ?>
		<td data-name="ExpectedResult">
<span id="el$rowindex$_detailed_action_ExpectedResult" class="form-group detailed_action_ExpectedResult">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" id="x<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_list->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_list->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_list->ExpectedResult->EditValue ?></textarea>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ExpectedResult" name="o<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" id="o<?php echo $detailed_action_list->RowIndex ?>_ExpectedResult" value="<?php echo HtmlEncode($detailed_action_list->ExpectedResult->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->Comments->Visible) { // Comments ?>
		<td data-name="Comments">
<span id="el$rowindex$_detailed_action_Comments" class="form-group detailed_action_Comments">
<textarea data-table="detailed_action" data-field="x_Comments" name="x<?php echo $detailed_action_list->RowIndex ?>_Comments" id="x<?php echo $detailed_action_list->RowIndex ?>_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_list->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_list->Comments->editAttributes() ?>><?php echo $detailed_action_list->Comments->EditValue ?></textarea>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_Comments" name="o<?php echo $detailed_action_list->RowIndex ?>_Comments" id="o<?php echo $detailed_action_list->RowIndex ?>_Comments" value="<?php echo HtmlEncode($detailed_action_list->Comments->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailed_action_list->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus">
<span id="el$rowindex$_detailed_action_ProgressStatus" class="form-group detailed_action_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_list->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus" name="x<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus"<?php echo $detailed_action_list->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_list->ProgressStatus->selectOptionListHtml("x{$detailed_action_list->RowIndex}_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_list->ProgressStatus->Lookup->getParamTag($detailed_action_list, "p_x" . $detailed_action_list->RowIndex . "_ProgressStatus") ?>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_ProgressStatus" name="o<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus" id="o<?php echo $detailed_action_list->RowIndex ?>_ProgressStatus" value="<?php echo HtmlEncode($detailed_action_list->ProgressStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailed_action_list->ListOptions->render("body", "right", $detailed_action_list->RowIndex);
?>
<script>
loadjs.ready(["fdetailed_actionlist", "load"], function() {
	fdetailed_actionlist.updateLists(<?php echo $detailed_action_list->RowIndex ?>);
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
<?php if ($detailed_action_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $detailed_action_list->FormKeyCountName ?>" id="<?php echo $detailed_action_list->FormKeyCountName ?>" value="<?php echo $detailed_action_list->KeyCount ?>">
<?php echo $detailed_action_list->MultiSelectKey ?>
<?php } ?>
<?php if ($detailed_action_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $detailed_action_list->FormKeyCountName ?>" id="<?php echo $detailed_action_list->FormKeyCountName ?>" value="<?php echo $detailed_action_list->KeyCount ?>">
<?php echo $detailed_action_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$detailed_action->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailed_action_list->Recordset)
	$detailed_action_list->Recordset->Close();
?>
<?php if (!$detailed_action_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailed_action_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailed_action_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailed_action_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailed_action_list->TotalRecords == 0 && !$detailed_action->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailed_action_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailed_action_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailed_action_list->isExport()) { ?>
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
$detailed_action_list->terminate();
?>