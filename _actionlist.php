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
$_action_list = new _action_list();

// Run the page
$_action_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_action_list->isExport()) { ?>
<script>
var f_actionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_actionlist = currentForm = new ew.Form("f_actionlist", "list");
	f_actionlist.formKeyCountName = '<?php echo $_action_list->FormKeyCountName ?>';

	// Validate form
	f_actionlist.validate = function() {
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
			<?php if ($_action_list->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->ProgramCode->caption(), $_action_list->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->OucomeCode->caption(), $_action_list->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_list->OucomeCode->errorMessage()) ?>");
			<?php if ($_action_list->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->OutputCode->caption(), $_action_list->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_list->OutputCode->errorMessage()) ?>");
			<?php if ($_action_list->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->ProjectCode->caption(), $_action_list->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->ActionCode->caption(), $_action_list->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->ActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->ActionName->caption(), $_action_list->ActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->ActionType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->ActionType->caption(), $_action_list->ActionType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->FinancialYear->caption(), $_action_list->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_list->FinancialYear->errorMessage()) ?>");
			<?php if ($_action_list->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->ExpectedAnnualAchievement->caption(), $_action_list->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->ActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->ActionLocation->caption(), $_action_list->ActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->Latitude->caption(), $_action_list->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_list->Latitude->errorMessage()) ?>");
			<?php if ($_action_list->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->Longitude->caption(), $_action_list->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_list->Longitude->errorMessage()) ?>");
			<?php if ($_action_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->LACode->caption(), $_action_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->DepartmentCode->caption(), $_action_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_list->SectionCode->caption(), $_action_list->SectionCode->RequiredErrorMessage)) ?>");
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
	f_actionlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProgramCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OucomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "OutputCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProjectCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionType", false)) return false;
		if (ew.valueChanged(fobj, infix, "FinancialYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExpectedAnnualAchievement", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionLocation", false)) return false;
		if (ew.valueChanged(fobj, infix, "Latitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "Longitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	f_actionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_actionlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_actionlist.lists["x_ProgramCode"] = <?php echo $_action_list->ProgramCode->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_ProgramCode"].options = <?php echo JsonEncode($_action_list->ProgramCode->lookupOptions()) ?>;
	f_actionlist.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionlist.lists["x_OucomeCode"] = <?php echo $_action_list->OucomeCode->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_OucomeCode"].options = <?php echo JsonEncode($_action_list->OucomeCode->lookupOptions()) ?>;
	f_actionlist.autoSuggests["x_OucomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionlist.lists["x_OutputCode"] = <?php echo $_action_list->OutputCode->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_OutputCode"].options = <?php echo JsonEncode($_action_list->OutputCode->lookupOptions()) ?>;
	f_actionlist.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionlist.lists["x_ProjectCode"] = <?php echo $_action_list->ProjectCode->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_ProjectCode"].options = <?php echo JsonEncode($_action_list->ProjectCode->lookupOptions()) ?>;
	f_actionlist.lists["x_ActionType"] = <?php echo $_action_list->ActionType->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_ActionType"].options = <?php echo JsonEncode($_action_list->ActionType->lookupOptions()) ?>;
	f_actionlist.lists["x_LACode"] = <?php echo $_action_list->LACode->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_LACode"].options = <?php echo JsonEncode($_action_list->LACode->lookupOptions()) ?>;
	f_actionlist.lists["x_DepartmentCode"] = <?php echo $_action_list->DepartmentCode->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($_action_list->DepartmentCode->lookupOptions()) ?>;
	f_actionlist.lists["x_SectionCode"] = <?php echo $_action_list->SectionCode->Lookup->toClientList($_action_list) ?>;
	f_actionlist.lists["x_SectionCode"].options = <?php echo JsonEncode($_action_list->SectionCode->lookupOptions()) ?>;
	loadjs.done("f_actionlist");
});
var f_actionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_actionlistsrch = currentSearchForm = new ew.Form("f_actionlistsrch");

	// Dynamic selection lists
	// Filters

	f_actionlistsrch.filterList = <?php echo $_action_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_actionlistsrch.initSearchPanel = true;
	loadjs.done("f_actionlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$_action_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_action_list->TotalRecords > 0 && $_action_list->ExportOptions->visible()) { ?>
<?php $_action_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_action_list->ImportOptions->visible()) { ?>
<?php $_action_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_action_list->SearchOptions->visible()) { ?>
<?php $_action_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_action_list->FilterOptions->visible()) { ?>
<?php $_action_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$_action_list->isExport() || Config("EXPORT_MASTER_RECORD") && $_action_list->isExport("print")) { ?>
<?php
if ($_action_list->DbMasterFilter != "" && $_action->getCurrentMasterTable() == "output") {
	if ($_action_list->MasterRecordExists) {
		include_once "outputmaster.php";
	}
}
?>
<?php } ?>
<?php
$_action_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_action_list->isExport() && !$_action->CurrentAction) { ?>
<form name="f_actionlistsrch" id="f_actionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_actionlistsrch-search-panel" class="<?php echo $_action_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_action">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_action_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_action_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_action_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_action_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_action_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_action_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_action_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_action_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_action_list->showPageHeader(); ?>
<?php
$_action_list->showMessage();
?>
<?php if ($_action_list->TotalRecords > 0 || $_action->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_action_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _action">
<?php if (!$_action_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_action_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_action_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_action_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_actionlist" id="f_actionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_action">
<?php if ($_action->getCurrentMasterTable() == "output" && $_action->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="output">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($_action_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($_action_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($_action_list->FinancialYear->getSessionValue()) ?>">
<?php } ?>
<div id="gmp__action" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_action_list->TotalRecords > 0 || $_action_list->isGridEdit()) { ?>
<table id="tbl__actionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_action->RowType = ROWTYPE_HEADER;

// Render list options
$_action_list->renderListOptions();

// Render list options (header, left)
$_action_list->ListOptions->render("header", "left");
?>
<?php if ($_action_list->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($_action_list->SortUrl($_action_list->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $_action_list->ProgramCode->headerCellClass() ?>"><div id="elh__action_ProgramCode" class="_action_ProgramCode"><div class="ew-table-header-caption"><?php echo $_action_list->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $_action_list->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->ProgramCode) ?>', 1);"><div id="elh__action_ProgramCode" class="_action_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->ProgramCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_action_list->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->OucomeCode->Visible) { // OucomeCode ?>
	<?php if ($_action_list->SortUrl($_action_list->OucomeCode) == "") { ?>
		<th data-name="OucomeCode" class="<?php echo $_action_list->OucomeCode->headerCellClass() ?>"><div id="elh__action_OucomeCode" class="_action_OucomeCode"><div class="ew-table-header-caption"><?php echo $_action_list->OucomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OucomeCode" class="<?php echo $_action_list->OucomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->OucomeCode) ?>', 1);"><div id="elh__action_OucomeCode" class="_action_OucomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->OucomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->OucomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->OucomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->OutputCode->Visible) { // OutputCode ?>
	<?php if ($_action_list->SortUrl($_action_list->OutputCode) == "") { ?>
		<th data-name="OutputCode" class="<?php echo $_action_list->OutputCode->headerCellClass() ?>"><div id="elh__action_OutputCode" class="_action_OutputCode"><div class="ew-table-header-caption"><?php echo $_action_list->OutputCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutputCode" class="<?php echo $_action_list->OutputCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->OutputCode) ?>', 1);"><div id="elh__action_OutputCode" class="_action_OutputCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($_action_list->SortUrl($_action_list->ProjectCode) == "") { ?>
		<th data-name="ProjectCode" class="<?php echo $_action_list->ProjectCode->headerCellClass() ?>"><div id="elh__action_ProjectCode" class="_action_ProjectCode"><div class="ew-table-header-caption"><?php echo $_action_list->ProjectCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectCode" class="<?php echo $_action_list->ProjectCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->ProjectCode) ?>', 1);"><div id="elh__action_ProjectCode" class="_action_ProjectCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->ProjectCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->ProjectCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->ProjectCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->ActionCode->Visible) { // ActionCode ?>
	<?php if ($_action_list->SortUrl($_action_list->ActionCode) == "") { ?>
		<th data-name="ActionCode" class="<?php echo $_action_list->ActionCode->headerCellClass() ?>"><div id="elh__action_ActionCode" class="_action_ActionCode"><div class="ew-table-header-caption"><?php echo $_action_list->ActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionCode" class="<?php echo $_action_list->ActionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->ActionCode) ?>', 1);"><div id="elh__action_ActionCode" class="_action_ActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->ActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->ActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->ActionName->Visible) { // ActionName ?>
	<?php if ($_action_list->SortUrl($_action_list->ActionName) == "") { ?>
		<th data-name="ActionName" class="<?php echo $_action_list->ActionName->headerCellClass() ?>"><div id="elh__action_ActionName" class="_action_ActionName"><div class="ew-table-header-caption"><?php echo $_action_list->ActionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionName" class="<?php echo $_action_list->ActionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->ActionName) ?>', 1);"><div id="elh__action_ActionName" class="_action_ActionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->ActionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_action_list->ActionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->ActionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->ActionType->Visible) { // ActionType ?>
	<?php if ($_action_list->SortUrl($_action_list->ActionType) == "") { ?>
		<th data-name="ActionType" class="<?php echo $_action_list->ActionType->headerCellClass() ?>"><div id="elh__action_ActionType" class="_action_ActionType"><div class="ew-table-header-caption"><?php echo $_action_list->ActionType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionType" class="<?php echo $_action_list->ActionType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->ActionType) ?>', 1);"><div id="elh__action_ActionType" class="_action_ActionType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->ActionType->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->ActionType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->ActionType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($_action_list->SortUrl($_action_list->FinancialYear) == "") { ?>
		<th data-name="FinancialYear" class="<?php echo $_action_list->FinancialYear->headerCellClass() ?>"><div id="elh__action_FinancialYear" class="_action_FinancialYear"><div class="ew-table-header-caption"><?php echo $_action_list->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FinancialYear" class="<?php echo $_action_list->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->FinancialYear) ?>', 1);"><div id="elh__action_FinancialYear" class="_action_FinancialYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<?php if ($_action_list->SortUrl($_action_list->ExpectedAnnualAchievement) == "") { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $_action_list->ExpectedAnnualAchievement->headerCellClass() ?>"><div id="elh__action_ExpectedAnnualAchievement" class="_action_ExpectedAnnualAchievement"><div class="ew-table-header-caption"><?php echo $_action_list->ExpectedAnnualAchievement->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExpectedAnnualAchievement" class="<?php echo $_action_list->ExpectedAnnualAchievement->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->ExpectedAnnualAchievement) ?>', 1);"><div id="elh__action_ExpectedAnnualAchievement" class="_action_ExpectedAnnualAchievement">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->ExpectedAnnualAchievement->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_action_list->ExpectedAnnualAchievement->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->ExpectedAnnualAchievement->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->ActionLocation->Visible) { // ActionLocation ?>
	<?php if ($_action_list->SortUrl($_action_list->ActionLocation) == "") { ?>
		<th data-name="ActionLocation" class="<?php echo $_action_list->ActionLocation->headerCellClass() ?>"><div id="elh__action_ActionLocation" class="_action_ActionLocation"><div class="ew-table-header-caption"><?php echo $_action_list->ActionLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionLocation" class="<?php echo $_action_list->ActionLocation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->ActionLocation) ?>', 1);"><div id="elh__action_ActionLocation" class="_action_ActionLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->ActionLocation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_action_list->ActionLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->ActionLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->Latitude->Visible) { // Latitude ?>
	<?php if ($_action_list->SortUrl($_action_list->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $_action_list->Latitude->headerCellClass() ?>"><div id="elh__action_Latitude" class="_action_Latitude"><div class="ew-table-header-caption"><?php echo $_action_list->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $_action_list->Latitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->Latitude) ?>', 1);"><div id="elh__action_Latitude" class="_action_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->Longitude->Visible) { // Longitude ?>
	<?php if ($_action_list->SortUrl($_action_list->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $_action_list->Longitude->headerCellClass() ?>"><div id="elh__action_Longitude" class="_action_Longitude"><div class="ew-table-header-caption"><?php echo $_action_list->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $_action_list->Longitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->Longitude) ?>', 1);"><div id="elh__action_Longitude" class="_action_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->LACode->Visible) { // LACode ?>
	<?php if ($_action_list->SortUrl($_action_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $_action_list->LACode->headerCellClass() ?>"><div id="elh__action_LACode" class="_action_LACode"><div class="ew-table-header-caption"><?php echo $_action_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $_action_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->LACode) ?>', 1);"><div id="elh__action_LACode" class="_action_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($_action_list->SortUrl($_action_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $_action_list->DepartmentCode->headerCellClass() ?>"><div id="elh__action_DepartmentCode" class="_action_DepartmentCode"><div class="ew-table-header-caption"><?php echo $_action_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $_action_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->DepartmentCode) ?>', 1);"><div id="elh__action_DepartmentCode" class="_action_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($_action_list->SortUrl($_action_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $_action_list->SectionCode->headerCellClass() ?>"><div id="elh__action_SectionCode" class="_action_SectionCode"><div class="ew-table-header-caption"><?php echo $_action_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $_action_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_action_list->SortUrl($_action_list->SectionCode) ?>', 1);"><div id="elh__action_SectionCode" class="_action_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_action_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_action_list->ExportAll && $_action_list->isExport()) {
	$_action_list->StopRecord = $_action_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_action_list->TotalRecords > $_action_list->StartRecord + $_action_list->DisplayRecords - 1)
		$_action_list->StopRecord = $_action_list->StartRecord + $_action_list->DisplayRecords - 1;
	else
		$_action_list->StopRecord = $_action_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($_action->isConfirm() || $_action_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($_action_list->FormKeyCountName) && ($_action_list->isGridAdd() || $_action_list->isGridEdit() || $_action->isConfirm())) {
		$_action_list->KeyCount = $CurrentForm->getValue($_action_list->FormKeyCountName);
		$_action_list->StopRecord = $_action_list->StartRecord + $_action_list->KeyCount - 1;
	}
}
$_action_list->RecordCount = $_action_list->StartRecord - 1;
if ($_action_list->Recordset && !$_action_list->Recordset->EOF) {
	$_action_list->Recordset->moveFirst();
	$selectLimit = $_action_list->UseSelectLimit;
	if (!$selectLimit && $_action_list->StartRecord > 1)
		$_action_list->Recordset->move($_action_list->StartRecord - 1);
} elseif (!$_action->AllowAddDeleteRow && $_action_list->StopRecord == 0) {
	$_action_list->StopRecord = $_action->GridAddRowCount;
}

// Initialize aggregate
$_action->RowType = ROWTYPE_AGGREGATEINIT;
$_action->resetAttributes();
$_action_list->renderRow();
if ($_action_list->isGridAdd())
	$_action_list->RowIndex = 0;
if ($_action_list->isGridEdit())
	$_action_list->RowIndex = 0;
while ($_action_list->RecordCount < $_action_list->StopRecord) {
	$_action_list->RecordCount++;
	if ($_action_list->RecordCount >= $_action_list->StartRecord) {
		$_action_list->RowCount++;
		if ($_action_list->isGridAdd() || $_action_list->isGridEdit() || $_action->isConfirm()) {
			$_action_list->RowIndex++;
			$CurrentForm->Index = $_action_list->RowIndex;
			if ($CurrentForm->hasValue($_action_list->FormActionName) && ($_action->isConfirm() || $_action_list->EventCancelled))
				$_action_list->RowAction = strval($CurrentForm->getValue($_action_list->FormActionName));
			elseif ($_action_list->isGridAdd())
				$_action_list->RowAction = "insert";
			else
				$_action_list->RowAction = "";
		}

		// Set up key count
		$_action_list->KeyCount = $_action_list->RowIndex;

		// Init row class and style
		$_action->resetAttributes();
		$_action->CssClass = "";
		if ($_action_list->isGridAdd()) {
			$_action_list->loadRowValues(); // Load default values
		} else {
			$_action_list->loadRowValues($_action_list->Recordset); // Load row values
		}
		$_action->RowType = ROWTYPE_VIEW; // Render view
		if ($_action_list->isGridAdd()) // Grid add
			$_action->RowType = ROWTYPE_ADD; // Render add
		if ($_action_list->isGridAdd() && $_action->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$_action_list->restoreCurrentRowFormValues($_action_list->RowIndex); // Restore form values
		if ($_action_list->isGridEdit()) { // Grid edit
			if ($_action->EventCancelled)
				$_action_list->restoreCurrentRowFormValues($_action_list->RowIndex); // Restore form values
			if ($_action_list->RowAction == "insert")
				$_action->RowType = ROWTYPE_ADD; // Render add
			else
				$_action->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($_action_list->isGridEdit() && ($_action->RowType == ROWTYPE_EDIT || $_action->RowType == ROWTYPE_ADD) && $_action->EventCancelled) // Update failed
			$_action_list->restoreCurrentRowFormValues($_action_list->RowIndex); // Restore form values
		if ($_action->RowType == ROWTYPE_EDIT) // Edit row
			$_action_list->EditRowCount++;

		// Set up row id / data-rowindex
		$_action->RowAttrs->merge(["data-rowindex" => $_action_list->RowCount, "id" => "r" . $_action_list->RowCount . "__action", "data-rowtype" => $_action->RowType]);

		// Render row
		$_action_list->renderRow();

		// Render list options
		$_action_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($_action_list->RowAction != "delete" && $_action_list->RowAction != "insertdelete" && !($_action_list->RowAction == "insert" && $_action->isConfirm() && $_action_list->emptyRow())) {
?>
	<tr <?php echo $_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_action_list->ListOptions->render("body", "left", $_action_list->RowCount);
?>
	<?php if ($_action_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $_action_list->ProgramCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProgramCode" class="form-group">
<span<?php echo $_action_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProgramCode" class="form-group">
<?php
$onchange = $_action_list->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($_action_list->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_list->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->ProgramCode->ReadOnly || $_action_list->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_ProgramCode" id="x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_list->ProgramCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="o<?php echo $_action_list->RowIndex ?>_ProgramCode" id="o<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProgramCode" class="form-group">
<span<?php echo $_action_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProgramCode" class="form-group">
<?php
$onchange = $_action_list->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($_action_list->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_list->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->ProgramCode->ReadOnly || $_action_list->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_ProgramCode" id="x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_list->ProgramCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProgramCode">
<span<?php echo $_action_list->ProgramCode->viewAttributes() ?>><?php echo $_action_list->ProgramCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode" <?php echo $_action_list->OucomeCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_list->OucomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OucomeCode" class="form-group">
<span<?php echo $_action_list->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_OucomeCode" name="x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OucomeCode" class="form-group">
<?php
$onchange = $_action_list->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_OucomeCode" id="sv_x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo RemoveHtml($_action_list->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_list->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_list->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->OucomeCode->ReadOnly || $_action_list->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->OucomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_OucomeCode" id="x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_list->OucomeCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="o<?php echo $_action_list->RowIndex ?>_OucomeCode" id="o<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_list->OucomeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OucomeCode" class="form-group">
<span<?php echo $_action_list->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_OucomeCode" name="x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OucomeCode" class="form-group">
<?php
$onchange = $_action_list->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_OucomeCode" id="sv_x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo RemoveHtml($_action_list->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_list->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_list->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->OucomeCode->ReadOnly || $_action_list->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->OucomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_OucomeCode" id="x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_list->OucomeCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OucomeCode">
<span<?php echo $_action_list->OucomeCode->viewAttributes() ?>><?php echo $_action_list->OucomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode" <?php echo $_action_list->OutputCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_list->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OutputCode" class="form-group">
<span<?php echo $_action_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_OutputCode" name="x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OutputCode" class="form-group">
<?php
$onchange = $_action_list->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_OutputCode" id="sv_x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($_action_list->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_list->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_list->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->OutputCode->ReadOnly || $_action_list->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_OutputCode" id="x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_list->OutputCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="o<?php echo $_action_list->RowIndex ?>_OutputCode" id="o<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_list->OutputCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OutputCode" class="form-group">
<span<?php echo $_action_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_OutputCode" name="x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OutputCode" class="form-group">
<?php
$onchange = $_action_list->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_OutputCode" id="sv_x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($_action_list->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_list->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_list->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->OutputCode->ReadOnly || $_action_list->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_OutputCode" id="x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_list->OutputCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_OutputCode">
<span<?php echo $_action_list->OutputCode->viewAttributes() ?>><?php echo $_action_list->OutputCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode" <?php echo $_action_list->ProjectCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProjectCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_list->RowIndex ?>_ProjectCode"><?php echo EmptyValue(strval($_action_list->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_list->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->ProjectCode->ReadOnly || $_action_list->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_list->ProjectCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_ProjectCode" id="x<?php echo $_action_list->RowIndex ?>_ProjectCode" value="<?php echo $_action_list->ProjectCode->CurrentValue ?>"<?php echo $_action_list->ProjectCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="o<?php echo $_action_list->RowIndex ?>_ProjectCode" id="o<?php echo $_action_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_list->ProjectCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProjectCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_list->RowIndex ?>_ProjectCode"><?php echo EmptyValue(strval($_action_list->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_list->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->ProjectCode->ReadOnly || $_action_list->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_list->ProjectCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_ProjectCode" id="x<?php echo $_action_list->RowIndex ?>_ProjectCode" value="<?php echo $_action_list->ProjectCode->CurrentValue ?>"<?php echo $_action_list->ProjectCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ProjectCode">
<span<?php echo $_action_list->ProjectCode->viewAttributes() ?>><?php echo $_action_list->ProjectCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" <?php echo $_action_list->ActionCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionCode" class="form-group"></span>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="o<?php echo $_action_list->RowIndex ?>_ActionCode" id="o<?php echo $_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_list->ActionCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionCode" class="form-group">
<span<?php echo $_action_list->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->ActionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="x<?php echo $_action_list->RowIndex ?>_ActionCode" id="x<?php echo $_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_list->ActionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionCode">
<span<?php echo $_action_list->ActionCode->viewAttributes() ?>><?php echo $_action_list->ActionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->ActionName->Visible) { // ActionName ?>
		<td data-name="ActionName" <?php echo $_action_list->ActionName->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionName" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_list->RowIndex ?>_ActionName" id="x<?php echo $_action_list->RowIndex ?>_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_list->ActionName->EditValue ?>"<?php echo $_action_list->ActionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionName" name="o<?php echo $_action_list->RowIndex ?>_ActionName" id="o<?php echo $_action_list->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_list->ActionName->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionName" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_list->RowIndex ?>_ActionName" id="x<?php echo $_action_list->RowIndex ?>_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_list->ActionName->EditValue ?>"<?php echo $_action_list->ActionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionName">
<span<?php echo $_action_list->ActionName->viewAttributes() ?>><?php echo $_action_list->ActionName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->ActionType->Visible) { // ActionType ?>
		<td data-name="ActionType" <?php echo $_action_list->ActionType->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_list->ActionType->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_ActionType" name="x<?php echo $_action_list->RowIndex ?>_ActionType"<?php echo $_action_list->ActionType->editAttributes() ?>>
			<?php echo $_action_list->ActionType->selectOptionListHtml("x{$_action_list->RowIndex}_ActionType") ?>
		</select>
</div>
<?php echo $_action_list->ActionType->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ActionType") ?>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionType" name="o<?php echo $_action_list->RowIndex ?>_ActionType" id="o<?php echo $_action_list->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_list->ActionType->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_list->ActionType->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_ActionType" name="x<?php echo $_action_list->RowIndex ?>_ActionType"<?php echo $_action_list->ActionType->editAttributes() ?>>
			<?php echo $_action_list->ActionType->selectOptionListHtml("x{$_action_list->RowIndex}_ActionType") ?>
		</select>
</div>
<?php echo $_action_list->ActionType->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ActionType") ?>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionType">
<span<?php echo $_action_list->ActionType->viewAttributes() ?>><?php echo $_action_list->ActionType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear" <?php echo $_action_list->FinancialYear->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_FinancialYear" class="form-group">
<span<?php echo $_action_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_FinancialYear" name="x<?php echo $_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_FinancialYear" class="form-group">
<input type="text" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_list->RowIndex ?>_FinancialYear" id="x<?php echo $_action_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_list->FinancialYear->EditValue ?>"<?php echo $_action_list->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o<?php echo $_action_list->RowIndex ?>_FinancialYear" id="o<?php echo $_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_list->FinancialYear->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_list->FinancialYear->getSessionValue() != "") { ?>

<span id="el<?php echo $_action_list->RowCount ?>__action_FinancialYear" class="form-group">
<span<?php echo $_action_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->FinancialYear->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_FinancialYear" name="x<?php echo $_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_list->RowIndex ?>_FinancialYear" id="x<?php echo $_action_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_list->FinancialYear->EditValue ?>"<?php echo $_action_list->FinancialYear->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o<?php echo $_action_list->RowIndex ?>_FinancialYear" id="o<?php echo $_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_list->FinancialYear->OldValue != null ? $_action_list->FinancialYear->OldValue : $_action_list->FinancialYear->CurrentValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_FinancialYear">
<span<?php echo $_action_list->FinancialYear->viewAttributes() ?>><?php echo $_action_list->FinancialYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement" <?php echo $_action_list->ExpectedAnnualAchievement->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_list->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_list->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_list->ExpectedAnnualAchievement->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ExpectedAnnualAchievement" class="form-group">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_list->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_list->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ExpectedAnnualAchievement">
<span<?php echo $_action_list->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $_action_list->ExpectedAnnualAchievement->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->ActionLocation->Visible) { // ActionLocation ?>
		<td data-name="ActionLocation" <?php echo $_action_list->ActionLocation->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionLocation" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_list->RowIndex ?>_ActionLocation" id="x<?php echo $_action_list->RowIndex ?>_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_list->ActionLocation->EditValue ?>"<?php echo $_action_list->ActionLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="o<?php echo $_action_list->RowIndex ?>_ActionLocation" id="o<?php echo $_action_list->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_list->ActionLocation->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionLocation" class="form-group">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_list->RowIndex ?>_ActionLocation" id="x<?php echo $_action_list->RowIndex ?>_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_list->ActionLocation->EditValue ?>"<?php echo $_action_list->ActionLocation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_ActionLocation">
<span<?php echo $_action_list->ActionLocation->viewAttributes() ?>><?php echo $_action_list->ActionLocation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $_action_list->Latitude->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_Latitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_list->RowIndex ?>_Latitude" id="x<?php echo $_action_list->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_list->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_list->Latitude->EditValue ?>"<?php echo $_action_list->Latitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_Latitude" name="o<?php echo $_action_list->RowIndex ?>_Latitude" id="o<?php echo $_action_list->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_list->Latitude->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_Latitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_list->RowIndex ?>_Latitude" id="x<?php echo $_action_list->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_list->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_list->Latitude->EditValue ?>"<?php echo $_action_list->Latitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_Latitude">
<span<?php echo $_action_list->Latitude->viewAttributes() ?>><?php echo $_action_list->Latitude->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $_action_list->Longitude->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_Longitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_list->RowIndex ?>_Longitude" id="x<?php echo $_action_list->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_list->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_list->Longitude->EditValue ?>"<?php echo $_action_list->Longitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_Longitude" name="o<?php echo $_action_list->RowIndex ?>_Longitude" id="o<?php echo $_action_list->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_list->Longitude->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_Longitude" class="form-group">
<input type="text" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_list->RowIndex ?>_Longitude" id="x<?php echo $_action_list->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_list->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_list->Longitude->EditValue ?>"<?php echo $_action_list->Longitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_Longitude">
<span<?php echo $_action_list->Longitude->viewAttributes() ?>><?php echo $_action_list->Longitude->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $_action_list->LACode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_LACode" class="form-group">
<span<?php echo $_action_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_LACode" name="x<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_LACode" class="form-group">
<?php $_action_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($_action_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->LACode->ReadOnly || $_action_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_list->LACode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_LACode" id="x<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo $_action_list->LACode->CurrentValue ?>"<?php echo $_action_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_LACode" name="o<?php echo $_action_list->RowIndex ?>_LACode" id="o<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_LACode" class="form-group">
<span<?php echo $_action_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_LACode" name="x<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_LACode" class="form-group">
<?php $_action_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($_action_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->LACode->ReadOnly || $_action_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_list->LACode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_LACode" id="x<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo $_action_list->LACode->CurrentValue ?>"<?php echo $_action_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_LACode">
<span<?php echo $_action_list->LACode->viewAttributes() ?>><?php echo $_action_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $_action_list->DepartmentCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_action_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_DepartmentCode" class="form-group">
<span<?php echo $_action_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_DepartmentCode" class="form-group">
<?php $_action_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_list->RowIndex ?>_DepartmentCode"<?php echo $_action_list->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_list->DepartmentCode->selectOptionListHtml("x{$_action_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_list->DepartmentCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="o<?php echo $_action_list->RowIndex ?>_DepartmentCode" id="o<?php echo $_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_action_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_DepartmentCode" class="form-group">
<span<?php echo $_action_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_DepartmentCode" class="form-group">
<?php $_action_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_list->RowIndex ?>_DepartmentCode"<?php echo $_action_list->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_list->DepartmentCode->selectOptionListHtml("x{$_action_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_list->DepartmentCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_DepartmentCode">
<span<?php echo $_action_list->DepartmentCode->viewAttributes() ?>><?php echo $_action_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_action_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $_action_list->SectionCode->cellAttributes() ?>>
<?php if ($_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_SectionCode" name="x<?php echo $_action_list->RowIndex ?>_SectionCode"<?php echo $_action_list->SectionCode->editAttributes() ?>>
			<?php echo $_action_list->SectionCode->selectOptionListHtml("x{$_action_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $_action_list->SectionCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="o<?php echo $_action_list->RowIndex ?>_SectionCode" id="o<?php echo $_action_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_SectionCode" name="x<?php echo $_action_list->RowIndex ?>_SectionCode"<?php echo $_action_list->SectionCode->editAttributes() ?>>
			<?php echo $_action_list->SectionCode->selectOptionListHtml("x{$_action_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $_action_list->SectionCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_action_list->RowCount ?>__action_SectionCode">
<span<?php echo $_action_list->SectionCode->viewAttributes() ?>><?php echo $_action_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_action_list->ListOptions->render("body", "right", $_action_list->RowCount);
?>
	</tr>
<?php if ($_action->RowType == ROWTYPE_ADD || $_action->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["f_actionlist", "load"], function() {
	f_actionlist.updateLists(<?php echo $_action_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$_action_list->isGridAdd())
		if (!$_action_list->Recordset->EOF)
			$_action_list->Recordset->moveNext();
}
?>
<?php
	if ($_action_list->isGridAdd() || $_action_list->isGridEdit()) {
		$_action_list->RowIndex = '$rowindex$';
		$_action_list->loadRowValues();

		// Set row properties
		$_action->resetAttributes();
		$_action->RowAttrs->merge(["data-rowindex" => $_action_list->RowIndex, "id" => "r0__action", "data-rowtype" => ROWTYPE_ADD]);
		$_action->RowAttrs->appendClass("ew-template");
		$_action->RowType = ROWTYPE_ADD;

		// Render row
		$_action_list->renderRow();

		// Render list options
		$_action_list->renderListOptions();
		$_action_list->StartRowCount = 0;
?>
	<tr <?php echo $_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_action_list->ListOptions->render("body", "left", $_action_list->RowIndex);
?>
	<?php if ($_action_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode">
<?php if ($_action_list->ProgramCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_ProgramCode" class="form-group _action_ProgramCode">
<span<?php echo $_action_list->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_ProgramCode" name="x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_ProgramCode" class="form-group _action_ProgramCode">
<?php
$onchange = $_action_list->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_ProgramCode" id="sv_x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo RemoveHtml($_action_list->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_list->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_list->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->ProgramCode->ReadOnly || $_action_list->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->ProgramCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_ProgramCode" id="x<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_list->ProgramCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ProgramCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" name="o<?php echo $_action_list->RowIndex ?>_ProgramCode" id="o<?php echo $_action_list->RowIndex ?>_ProgramCode" value="<?php echo HtmlEncode($_action_list->ProgramCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->OucomeCode->Visible) { // OucomeCode ?>
		<td data-name="OucomeCode">
<?php if ($_action_list->OucomeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_OucomeCode" class="form-group _action_OucomeCode">
<span<?php echo $_action_list->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_OucomeCode" name="x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_OucomeCode" class="form-group _action_OucomeCode">
<?php
$onchange = $_action_list->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_OucomeCode" id="sv_x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo RemoveHtml($_action_list->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_list->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_list->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->OucomeCode->ReadOnly || $_action_list->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->OucomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_OucomeCode" id="x<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_list->OucomeCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_OucomeCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" name="o<?php echo $_action_list->RowIndex ?>_OucomeCode" id="o<?php echo $_action_list->RowIndex ?>_OucomeCode" value="<?php echo HtmlEncode($_action_list->OucomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->OutputCode->Visible) { // OutputCode ?>
		<td data-name="OutputCode">
<?php if ($_action_list->OutputCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_OutputCode" class="form-group _action_OutputCode">
<span<?php echo $_action_list->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_OutputCode" name="x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_OutputCode" class="form-group _action_OutputCode">
<?php
$onchange = $_action_list->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_list->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_action_list->RowIndex ?>_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_action_list->RowIndex ?>_OutputCode" id="sv_x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo RemoveHtml($_action_list->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_list->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_list->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_list->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->OutputCode->ReadOnly || $_action_list->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->OutputCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_OutputCode" id="x<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionlist"], function() {
	f_actionlist.createAutoSuggest({"id":"x<?php echo $_action_list->RowIndex ?>_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_list->OutputCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_OutputCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_OutputCode" name="o<?php echo $_action_list->RowIndex ?>_OutputCode" id="o<?php echo $_action_list->RowIndex ?>_OutputCode" value="<?php echo HtmlEncode($_action_list->OutputCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode">
<span id="el$rowindex$__action_ProjectCode" class="form-group _action_ProjectCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_list->RowIndex ?>_ProjectCode"><?php echo EmptyValue(strval($_action_list->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_list->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->ProjectCode->ReadOnly || $_action_list->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_list->ProjectCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->ProjectCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_ProjectCode" id="x<?php echo $_action_list->RowIndex ?>_ProjectCode" value="<?php echo $_action_list->ProjectCode->CurrentValue ?>"<?php echo $_action_list->ProjectCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" name="o<?php echo $_action_list->RowIndex ?>_ProjectCode" id="o<?php echo $_action_list->RowIndex ?>_ProjectCode" value="<?php echo HtmlEncode($_action_list->ProjectCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode">
<span id="el$rowindex$__action_ActionCode" class="form-group _action_ActionCode"></span>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="o<?php echo $_action_list->RowIndex ?>_ActionCode" id="o<?php echo $_action_list->RowIndex ?>_ActionCode" value="<?php echo HtmlEncode($_action_list->ActionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->ActionName->Visible) { // ActionName ?>
		<td data-name="ActionName">
<span id="el$rowindex$__action_ActionName" class="form-group _action_ActionName">
<input type="text" data-table="_action" data-field="x_ActionName" name="x<?php echo $_action_list->RowIndex ?>_ActionName" id="x<?php echo $_action_list->RowIndex ?>_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_list->ActionName->EditValue ?>"<?php echo $_action_list->ActionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionName" name="o<?php echo $_action_list->RowIndex ?>_ActionName" id="o<?php echo $_action_list->RowIndex ?>_ActionName" value="<?php echo HtmlEncode($_action_list->ActionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->ActionType->Visible) { // ActionType ?>
		<td data-name="ActionType">
<span id="el$rowindex$__action_ActionType" class="form-group _action_ActionType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_list->ActionType->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_ActionType" name="x<?php echo $_action_list->RowIndex ?>_ActionType"<?php echo $_action_list->ActionType->editAttributes() ?>>
			<?php echo $_action_list->ActionType->selectOptionListHtml("x{$_action_list->RowIndex}_ActionType") ?>
		</select>
</div>
<?php echo $_action_list->ActionType->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_ActionType") ?>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionType" name="o<?php echo $_action_list->RowIndex ?>_ActionType" id="o<?php echo $_action_list->RowIndex ?>_ActionType" value="<?php echo HtmlEncode($_action_list->ActionType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->FinancialYear->Visible) { // FinancialYear ?>
		<td data-name="FinancialYear">
<?php if ($_action_list->FinancialYear->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_FinancialYear" class="form-group _action_FinancialYear">
<span<?php echo $_action_list->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_FinancialYear" name="x<?php echo $_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_list->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_FinancialYear" class="form-group _action_FinancialYear">
<input type="text" data-table="_action" data-field="x_FinancialYear" name="x<?php echo $_action_list->RowIndex ?>_FinancialYear" id="x<?php echo $_action_list->RowIndex ?>_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_list->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_list->FinancialYear->EditValue ?>"<?php echo $_action_list->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o<?php echo $_action_list->RowIndex ?>_FinancialYear" id="o<?php echo $_action_list->RowIndex ?>_FinancialYear" value="<?php echo HtmlEncode($_action_list->FinancialYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<td data-name="ExpectedAnnualAchievement">
<span id="el$rowindex$__action_ExpectedAnnualAchievement" class="form-group _action_ExpectedAnnualAchievement">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" id="x<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_list->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_list->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="o<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" id="o<?php echo $_action_list->RowIndex ?>_ExpectedAnnualAchievement" value="<?php echo HtmlEncode($_action_list->ExpectedAnnualAchievement->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->ActionLocation->Visible) { // ActionLocation ?>
		<td data-name="ActionLocation">
<span id="el$rowindex$__action_ActionLocation" class="form-group _action_ActionLocation">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x<?php echo $_action_list->RowIndex ?>_ActionLocation" id="x<?php echo $_action_list->RowIndex ?>_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_list->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_list->ActionLocation->EditValue ?>"<?php echo $_action_list->ActionLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionLocation" name="o<?php echo $_action_list->RowIndex ?>_ActionLocation" id="o<?php echo $_action_list->RowIndex ?>_ActionLocation" value="<?php echo HtmlEncode($_action_list->ActionLocation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude">
<span id="el$rowindex$__action_Latitude" class="form-group _action_Latitude">
<input type="text" data-table="_action" data-field="x_Latitude" name="x<?php echo $_action_list->RowIndex ?>_Latitude" id="x<?php echo $_action_list->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_list->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_list->Latitude->EditValue ?>"<?php echo $_action_list->Latitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_Latitude" name="o<?php echo $_action_list->RowIndex ?>_Latitude" id="o<?php echo $_action_list->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($_action_list->Latitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude">
<span id="el$rowindex$__action_Longitude" class="form-group _action_Longitude">
<input type="text" data-table="_action" data-field="x_Longitude" name="x<?php echo $_action_list->RowIndex ?>_Longitude" id="x<?php echo $_action_list->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_list->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_list->Longitude->EditValue ?>"<?php echo $_action_list->Longitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="_action" data-field="x_Longitude" name="o<?php echo $_action_list->RowIndex ?>_Longitude" id="o<?php echo $_action_list->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($_action_list->Longitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($_action_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_LACode" class="form-group _action_LACode">
<span<?php echo $_action_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_LACode" name="x<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_LACode" class="form-group _action_LACode">
<?php $_action_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $_action_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($_action_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_list->LACode->ReadOnly || $_action_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_action_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_list->LACode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_action_list->RowIndex ?>_LACode" id="x<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo $_action_list->LACode->CurrentValue ?>"<?php echo $_action_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_LACode" name="o<?php echo $_action_list->RowIndex ?>_LACode" id="o<?php echo $_action_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($_action_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if ($_action_list->DepartmentCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__action_DepartmentCode" class="form-group _action_DepartmentCode">
<span<?php echo $_action_list->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_list->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_list->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__action_DepartmentCode" class="form-group _action_DepartmentCode">
<?php $_action_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_DepartmentCode" name="x<?php echo $_action_list->RowIndex ?>_DepartmentCode"<?php echo $_action_list->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_list->DepartmentCode->selectOptionListHtml("x{$_action_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_list->DepartmentCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_action" data-field="x_DepartmentCode" name="o<?php echo $_action_list->RowIndex ?>_DepartmentCode" id="o<?php echo $_action_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($_action_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_action_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$__action_SectionCode" class="form-group _action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $_action_list->RowIndex ?>_SectionCode" name="x<?php echo $_action_list->RowIndex ?>_SectionCode"<?php echo $_action_list->SectionCode->editAttributes() ?>>
			<?php echo $_action_list->SectionCode->selectOptionListHtml("x{$_action_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $_action_list->SectionCode->Lookup->getParamTag($_action_list, "p_x" . $_action_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="_action" data-field="x_SectionCode" name="o<?php echo $_action_list->RowIndex ?>_SectionCode" id="o<?php echo $_action_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($_action_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_action_list->ListOptions->render("body", "right", $_action_list->RowIndex);
?>
<script>
loadjs.ready(["f_actionlist", "load"], function() {
	f_actionlist.updateLists(<?php echo $_action_list->RowIndex ?>);
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
<?php if ($_action_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $_action_list->FormKeyCountName ?>" id="<?php echo $_action_list->FormKeyCountName ?>" value="<?php echo $_action_list->KeyCount ?>">
<?php echo $_action_list->MultiSelectKey ?>
<?php } ?>
<?php if ($_action_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $_action_list->FormKeyCountName ?>" id="<?php echo $_action_list->FormKeyCountName ?>" value="<?php echo $_action_list->KeyCount ?>">
<?php echo $_action_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$_action->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_action_list->Recordset)
	$_action_list->Recordset->Close();
?>
<?php if (!$_action_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_action_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_action_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_action_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_action_list->TotalRecords == 0 && !$_action->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_action_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_action_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_action_list->isExport()) { ?>
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
$_action_list->terminate();
?>