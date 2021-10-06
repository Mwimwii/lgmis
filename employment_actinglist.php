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
$employment_acting_list = new employment_acting_list();

// Run the page
$employment_acting_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_acting_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_acting_list->isExport()) { ?>
<script>
var femployment_actinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployment_actinglist = currentForm = new ew.Form("femployment_actinglist", "list");
	femployment_actinglist.formKeyCountName = '<?php echo $employment_acting_list->FormKeyCountName ?>';

	// Validate form
	femployment_actinglist.validate = function() {
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
			<?php if ($employment_acting_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->EmployeeID->caption(), $employment_acting_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_list->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_acting_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->ProvinceCode->caption(), $employment_acting_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_list->ProvinceCode->errorMessage()) ?>");
			<?php if ($employment_acting_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->LACode->caption(), $employment_acting_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->DepartmentCode->caption(), $employment_acting_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->SectionCode->caption(), $employment_acting_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_list->ActingPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->ActingPosition->caption(), $employment_acting_list->ActingPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_list->DateOfActingAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfActingAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->DateOfActingAppointment->caption(), $employment_acting_list->DateOfActingAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfActingAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_list->DateOfActingAppointment->errorMessage()) ?>");
			<?php if ($employment_acting_list->EndDateOfActingPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDateOfActingPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->EndDateOfActingPeriod->caption(), $employment_acting_list->EndDateOfActingPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDateOfActingPeriod");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_acting_list->EndDateOfActingPeriod->errorMessage()) ?>");
			<?php if ($employment_acting_list->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->SalaryScale->caption(), $employment_acting_list->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_list->ActingType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->ActingType->caption(), $employment_acting_list->ActingType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_list->ActingStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->ActingStatus->caption(), $employment_acting_list->ActingStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_acting_list->ActingReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_acting_list->ActingReason->caption(), $employment_acting_list->ActingReason->RequiredErrorMessage)) ?>");
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
	femployment_actinglist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActingPosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfActingAppointment", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndDateOfActingPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActingType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActingStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActingReason", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployment_actinglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_actinglist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployment_actinglist.lists["x_ProvinceCode"] = <?php echo $employment_acting_list->ProvinceCode->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_acting_list->ProvinceCode->lookupOptions()) ?>;
	femployment_actinglist.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femployment_actinglist.lists["x_LACode"] = <?php echo $employment_acting_list->LACode->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_LACode"].options = <?php echo JsonEncode($employment_acting_list->LACode->lookupOptions()) ?>;
	femployment_actinglist.lists["x_DepartmentCode"] = <?php echo $employment_acting_list->DepartmentCode->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_acting_list->DepartmentCode->lookupOptions()) ?>;
	femployment_actinglist.lists["x_SectionCode"] = <?php echo $employment_acting_list->SectionCode->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_acting_list->SectionCode->lookupOptions()) ?>;
	femployment_actinglist.lists["x_ActingPosition"] = <?php echo $employment_acting_list->ActingPosition->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_ActingPosition"].options = <?php echo JsonEncode($employment_acting_list->ActingPosition->lookupOptions()) ?>;
	femployment_actinglist.lists["x_ActingType"] = <?php echo $employment_acting_list->ActingType->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_ActingType"].options = <?php echo JsonEncode($employment_acting_list->ActingType->lookupOptions()) ?>;
	femployment_actinglist.lists["x_ActingStatus"] = <?php echo $employment_acting_list->ActingStatus->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_ActingStatus"].options = <?php echo JsonEncode($employment_acting_list->ActingStatus->lookupOptions()) ?>;
	femployment_actinglist.lists["x_ActingReason"] = <?php echo $employment_acting_list->ActingReason->Lookup->toClientList($employment_acting_list) ?>;
	femployment_actinglist.lists["x_ActingReason"].options = <?php echo JsonEncode($employment_acting_list->ActingReason->lookupOptions()) ?>;
	loadjs.done("femployment_actinglist");
});
var femployment_actinglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployment_actinglistsrch = currentSearchForm = new ew.Form("femployment_actinglistsrch");

	// Dynamic selection lists
	// Filters

	femployment_actinglistsrch.filterList = <?php echo $employment_acting_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployment_actinglistsrch.initSearchPanel = true;
	loadjs.done("femployment_actinglistsrch");
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
<?php if (!$employment_acting_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employment_acting_list->TotalRecords > 0 && $employment_acting_list->ExportOptions->visible()) { ?>
<?php $employment_acting_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_acting_list->ImportOptions->visible()) { ?>
<?php $employment_acting_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_acting_list->SearchOptions->visible()) { ?>
<?php $employment_acting_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employment_acting_list->FilterOptions->visible()) { ?>
<?php $employment_acting_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employment_acting_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employment_acting_list->isExport() && !$employment_acting->CurrentAction) { ?>
<form name="femployment_actinglistsrch" id="femployment_actinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployment_actinglistsrch-search-panel" class="<?php echo $employment_acting_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employment_acting">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employment_acting_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employment_acting_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employment_acting_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employment_acting_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employment_acting_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employment_acting_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employment_acting_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employment_acting_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employment_acting_list->showPageHeader(); ?>
<?php
$employment_acting_list->showMessage();
?>
<?php if ($employment_acting_list->TotalRecords > 0 || $employment_acting->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employment_acting_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employment_acting">
<?php if (!$employment_acting_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employment_acting_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_acting_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_acting_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployment_actinglist" id="femployment_actinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_acting">
<div id="gmp_employment_acting" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employment_acting_list->TotalRecords > 0 || $employment_acting_list->isGridEdit()) { ?>
<table id="tbl_employment_actinglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employment_acting->RowType = ROWTYPE_HEADER;

// Render list options
$employment_acting_list->renderListOptions();

// Render list options (header, left)
$employment_acting_list->ListOptions->render("header", "left");
?>
<?php if ($employment_acting_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employment_acting_list->EmployeeID->headerCellClass() ?>"><div id="elh_employment_acting_EmployeeID" class="employment_acting_EmployeeID"><div class="ew-table-header-caption"><?php echo $employment_acting_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employment_acting_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->EmployeeID) ?>', 1);"><div id="elh_employment_acting_EmployeeID" class="employment_acting_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_acting_list->ProvinceCode->headerCellClass() ?>"><div id="elh_employment_acting_ProvinceCode" class="employment_acting_ProvinceCode"><div class="ew-table-header-caption"><?php echo $employment_acting_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_acting_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->ProvinceCode) ?>', 1);"><div id="elh_employment_acting_ProvinceCode" class="employment_acting_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->LACode->Visible) { // LACode ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $employment_acting_list->LACode->headerCellClass() ?>"><div id="elh_employment_acting_LACode" class="employment_acting_LACode"><div class="ew-table-header-caption"><?php echo $employment_acting_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $employment_acting_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->LACode) ?>', 1);"><div id="elh_employment_acting_LACode" class="employment_acting_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_acting_list->DepartmentCode->headerCellClass() ?>"><div id="elh_employment_acting_DepartmentCode" class="employment_acting_DepartmentCode"><div class="ew-table-header-caption"><?php echo $employment_acting_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_acting_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->DepartmentCode) ?>', 1);"><div id="elh_employment_acting_DepartmentCode" class="employment_acting_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $employment_acting_list->SectionCode->headerCellClass() ?>"><div id="elh_employment_acting_SectionCode" class="employment_acting_SectionCode"><div class="ew-table-header-caption"><?php echo $employment_acting_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $employment_acting_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->SectionCode) ?>', 1);"><div id="elh_employment_acting_SectionCode" class="employment_acting_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->ActingPosition->Visible) { // ActingPosition ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->ActingPosition) == "") { ?>
		<th data-name="ActingPosition" class="<?php echo $employment_acting_list->ActingPosition->headerCellClass() ?>"><div id="elh_employment_acting_ActingPosition" class="employment_acting_ActingPosition"><div class="ew-table-header-caption"><?php echo $employment_acting_list->ActingPosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingPosition" class="<?php echo $employment_acting_list->ActingPosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->ActingPosition) ?>', 1);"><div id="elh_employment_acting_ActingPosition" class="employment_acting_ActingPosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->ActingPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->ActingPosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->ActingPosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->DateOfActingAppointment) == "") { ?>
		<th data-name="DateOfActingAppointment" class="<?php echo $employment_acting_list->DateOfActingAppointment->headerCellClass() ?>"><div id="elh_employment_acting_DateOfActingAppointment" class="employment_acting_DateOfActingAppointment"><div class="ew-table-header-caption"><?php echo $employment_acting_list->DateOfActingAppointment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfActingAppointment" class="<?php echo $employment_acting_list->DateOfActingAppointment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->DateOfActingAppointment) ?>', 1);"><div id="elh_employment_acting_DateOfActingAppointment" class="employment_acting_DateOfActingAppointment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->DateOfActingAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->DateOfActingAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->DateOfActingAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->EndDateOfActingPeriod) == "") { ?>
		<th data-name="EndDateOfActingPeriod" class="<?php echo $employment_acting_list->EndDateOfActingPeriod->headerCellClass() ?>"><div id="elh_employment_acting_EndDateOfActingPeriod" class="employment_acting_EndDateOfActingPeriod"><div class="ew-table-header-caption"><?php echo $employment_acting_list->EndDateOfActingPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDateOfActingPeriod" class="<?php echo $employment_acting_list->EndDateOfActingPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->EndDateOfActingPeriod) ?>', 1);"><div id="elh_employment_acting_EndDateOfActingPeriod" class="employment_acting_EndDateOfActingPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->EndDateOfActingPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->EndDateOfActingPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->EndDateOfActingPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $employment_acting_list->SalaryScale->headerCellClass() ?>"><div id="elh_employment_acting_SalaryScale" class="employment_acting_SalaryScale"><div class="ew-table-header-caption"><?php echo $employment_acting_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $employment_acting_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->SalaryScale) ?>', 1);"><div id="elh_employment_acting_SalaryScale" class="employment_acting_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->ActingType->Visible) { // ActingType ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->ActingType) == "") { ?>
		<th data-name="ActingType" class="<?php echo $employment_acting_list->ActingType->headerCellClass() ?>"><div id="elh_employment_acting_ActingType" class="employment_acting_ActingType"><div class="ew-table-header-caption"><?php echo $employment_acting_list->ActingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingType" class="<?php echo $employment_acting_list->ActingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->ActingType) ?>', 1);"><div id="elh_employment_acting_ActingType" class="employment_acting_ActingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->ActingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->ActingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->ActingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->ActingStatus->Visible) { // ActingStatus ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->ActingStatus) == "") { ?>
		<th data-name="ActingStatus" class="<?php echo $employment_acting_list->ActingStatus->headerCellClass() ?>"><div id="elh_employment_acting_ActingStatus" class="employment_acting_ActingStatus"><div class="ew-table-header-caption"><?php echo $employment_acting_list->ActingStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingStatus" class="<?php echo $employment_acting_list->ActingStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->ActingStatus) ?>', 1);"><div id="elh_employment_acting_ActingStatus" class="employment_acting_ActingStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->ActingStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->ActingStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->ActingStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_acting_list->ActingReason->Visible) { // ActingReason ?>
	<?php if ($employment_acting_list->SortUrl($employment_acting_list->ActingReason) == "") { ?>
		<th data-name="ActingReason" class="<?php echo $employment_acting_list->ActingReason->headerCellClass() ?>"><div id="elh_employment_acting_ActingReason" class="employment_acting_ActingReason"><div class="ew-table-header-caption"><?php echo $employment_acting_list->ActingReason->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingReason" class="<?php echo $employment_acting_list->ActingReason->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_acting_list->SortUrl($employment_acting_list->ActingReason) ?>', 1);"><div id="elh_employment_acting_ActingReason" class="employment_acting_ActingReason">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_acting_list->ActingReason->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_acting_list->ActingReason->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_acting_list->ActingReason->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_acting_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employment_acting_list->ExportAll && $employment_acting_list->isExport()) {
	$employment_acting_list->StopRecord = $employment_acting_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employment_acting_list->TotalRecords > $employment_acting_list->StartRecord + $employment_acting_list->DisplayRecords - 1)
		$employment_acting_list->StopRecord = $employment_acting_list->StartRecord + $employment_acting_list->DisplayRecords - 1;
	else
		$employment_acting_list->StopRecord = $employment_acting_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employment_acting->isConfirm() || $employment_acting_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employment_acting_list->FormKeyCountName) && ($employment_acting_list->isGridAdd() || $employment_acting_list->isGridEdit() || $employment_acting->isConfirm())) {
		$employment_acting_list->KeyCount = $CurrentForm->getValue($employment_acting_list->FormKeyCountName);
		$employment_acting_list->StopRecord = $employment_acting_list->StartRecord + $employment_acting_list->KeyCount - 1;
	}
}
$employment_acting_list->RecordCount = $employment_acting_list->StartRecord - 1;
if ($employment_acting_list->Recordset && !$employment_acting_list->Recordset->EOF) {
	$employment_acting_list->Recordset->moveFirst();
	$selectLimit = $employment_acting_list->UseSelectLimit;
	if (!$selectLimit && $employment_acting_list->StartRecord > 1)
		$employment_acting_list->Recordset->move($employment_acting_list->StartRecord - 1);
} elseif (!$employment_acting->AllowAddDeleteRow && $employment_acting_list->StopRecord == 0) {
	$employment_acting_list->StopRecord = $employment_acting->GridAddRowCount;
}

// Initialize aggregate
$employment_acting->RowType = ROWTYPE_AGGREGATEINIT;
$employment_acting->resetAttributes();
$employment_acting_list->renderRow();
if ($employment_acting_list->isGridAdd())
	$employment_acting_list->RowIndex = 0;
if ($employment_acting_list->isGridEdit())
	$employment_acting_list->RowIndex = 0;
while ($employment_acting_list->RecordCount < $employment_acting_list->StopRecord) {
	$employment_acting_list->RecordCount++;
	if ($employment_acting_list->RecordCount >= $employment_acting_list->StartRecord) {
		$employment_acting_list->RowCount++;
		if ($employment_acting_list->isGridAdd() || $employment_acting_list->isGridEdit() || $employment_acting->isConfirm()) {
			$employment_acting_list->RowIndex++;
			$CurrentForm->Index = $employment_acting_list->RowIndex;
			if ($CurrentForm->hasValue($employment_acting_list->FormActionName) && ($employment_acting->isConfirm() || $employment_acting_list->EventCancelled))
				$employment_acting_list->RowAction = strval($CurrentForm->getValue($employment_acting_list->FormActionName));
			elseif ($employment_acting_list->isGridAdd())
				$employment_acting_list->RowAction = "insert";
			else
				$employment_acting_list->RowAction = "";
		}

		// Set up key count
		$employment_acting_list->KeyCount = $employment_acting_list->RowIndex;

		// Init row class and style
		$employment_acting->resetAttributes();
		$employment_acting->CssClass = "";
		if ($employment_acting_list->isGridAdd()) {
			$employment_acting_list->loadRowValues(); // Load default values
		} else {
			$employment_acting_list->loadRowValues($employment_acting_list->Recordset); // Load row values
		}
		$employment_acting->RowType = ROWTYPE_VIEW; // Render view
		if ($employment_acting_list->isGridAdd()) // Grid add
			$employment_acting->RowType = ROWTYPE_ADD; // Render add
		if ($employment_acting_list->isGridAdd() && $employment_acting->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employment_acting_list->restoreCurrentRowFormValues($employment_acting_list->RowIndex); // Restore form values
		if ($employment_acting_list->isGridEdit()) { // Grid edit
			if ($employment_acting->EventCancelled)
				$employment_acting_list->restoreCurrentRowFormValues($employment_acting_list->RowIndex); // Restore form values
			if ($employment_acting_list->RowAction == "insert")
				$employment_acting->RowType = ROWTYPE_ADD; // Render add
			else
				$employment_acting->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employment_acting_list->isGridEdit() && ($employment_acting->RowType == ROWTYPE_EDIT || $employment_acting->RowType == ROWTYPE_ADD) && $employment_acting->EventCancelled) // Update failed
			$employment_acting_list->restoreCurrentRowFormValues($employment_acting_list->RowIndex); // Restore form values
		if ($employment_acting->RowType == ROWTYPE_EDIT) // Edit row
			$employment_acting_list->EditRowCount++;

		// Set up row id / data-rowindex
		$employment_acting->RowAttrs->merge(["data-rowindex" => $employment_acting_list->RowCount, "id" => "r" . $employment_acting_list->RowCount . "_employment_acting", "data-rowtype" => $employment_acting->RowType]);

		// Render row
		$employment_acting_list->renderRow();

		// Render list options
		$employment_acting_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employment_acting_list->RowAction != "delete" && $employment_acting_list->RowAction != "insertdelete" && !($employment_acting_list->RowAction == "insert" && $employment_acting->isConfirm() && $employment_acting_list->emptyRow())) {
?>
	<tr <?php echo $employment_acting->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_acting_list->ListOptions->render("body", "left", $employment_acting_list->RowCount);
?>
	<?php if ($employment_acting_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employment_acting_list->EmployeeID->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_EmployeeID" class="form-group">
<input type="text" data-table="employment_acting" data-field="x_EmployeeID" name="x<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_acting_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->EmployeeID->EditValue ?>"<?php echo $employment_acting_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_EmployeeID" name="o<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_acting_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employment_acting" data-field="x_EmployeeID" name="x<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_acting_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->EmployeeID->EditValue ?>"<?php echo $employment_acting_list->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="employment_acting" data-field="x_EmployeeID" name="o<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_acting_list->EmployeeID->OldValue != null ? $employment_acting_list->EmployeeID->OldValue : $employment_acting_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_EmployeeID">
<span<?php echo $employment_acting_list->EmployeeID->viewAttributes() ?>><?php echo $employment_acting_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $employment_acting_list->ProvinceCode->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ProvinceCode" class="form-group">
<?php
$onchange = $employment_acting_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_acting_list->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($employment_acting_list->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->getPlaceHolder()) ?>"<?php echo $employment_acting_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_acting_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployment_actinglist"], function() {
	femployment_actinglist.createAutoSuggest({"id":"x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $employment_acting_list->ProvinceCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" name="o<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ProvinceCode" class="form-group">
<?php
$onchange = $employment_acting_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_acting_list->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($employment_acting_list->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->getPlaceHolder()) ?>"<?php echo $employment_acting_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_acting_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployment_actinglist"], function() {
	femployment_actinglist.createAutoSuggest({"id":"x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $employment_acting_list->ProvinceCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ProvinceCode">
<span<?php echo $employment_acting_list->ProvinceCode->viewAttributes() ?>><?php echo $employment_acting_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $employment_acting_list->LACode->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_LACode" class="form-group">
<?php $employment_acting_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_LACode" data-value-separator="<?php echo $employment_acting_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_LACode" name="x<?php echo $employment_acting_list->RowIndex ?>_LACode"<?php echo $employment_acting_list->LACode->editAttributes() ?>>
			<?php echo $employment_acting_list->LACode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $employment_acting_list->LACode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_LACode" name="o<?php echo $employment_acting_list->RowIndex ?>_LACode" id="o<?php echo $employment_acting_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_acting_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_LACode" class="form-group">
<?php $employment_acting_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_LACode" data-value-separator="<?php echo $employment_acting_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_LACode" name="x<?php echo $employment_acting_list->RowIndex ?>_LACode"<?php echo $employment_acting_list->LACode->editAttributes() ?>>
			<?php echo $employment_acting_list->LACode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $employment_acting_list->LACode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_LACode">
<span<?php echo $employment_acting_list->LACode->viewAttributes() ?>><?php echo $employment_acting_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $employment_acting_list->DepartmentCode->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_DepartmentCode" class="form-group">
<?php $employment_acting_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_DepartmentCode" data-value-separator="<?php echo $employment_acting_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode"<?php echo $employment_acting_list->DepartmentCode->editAttributes() ?>>
			<?php echo $employment_acting_list->DepartmentCode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $employment_acting_list->DepartmentCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_DepartmentCode" name="o<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_acting_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_DepartmentCode" class="form-group">
<?php $employment_acting_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_DepartmentCode" data-value-separator="<?php echo $employment_acting_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode"<?php echo $employment_acting_list->DepartmentCode->editAttributes() ?>>
			<?php echo $employment_acting_list->DepartmentCode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $employment_acting_list->DepartmentCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_DepartmentCode">
<span<?php echo $employment_acting_list->DepartmentCode->viewAttributes() ?>><?php echo $employment_acting_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $employment_acting_list->SectionCode->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_SectionCode" class="form-group">
<?php $employment_acting_list->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_SectionCode" data-value-separator="<?php echo $employment_acting_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_SectionCode" name="x<?php echo $employment_acting_list->RowIndex ?>_SectionCode"<?php echo $employment_acting_list->SectionCode->editAttributes() ?>>
			<?php echo $employment_acting_list->SectionCode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $employment_acting_list->SectionCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_SectionCode" name="o<?php echo $employment_acting_list->RowIndex ?>_SectionCode" id="o<?php echo $employment_acting_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_acting_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_SectionCode" class="form-group">
<?php $employment_acting_list->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_SectionCode" data-value-separator="<?php echo $employment_acting_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_SectionCode" name="x<?php echo $employment_acting_list->RowIndex ?>_SectionCode"<?php echo $employment_acting_list->SectionCode->editAttributes() ?>>
			<?php echo $employment_acting_list->SectionCode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $employment_acting_list->SectionCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_SectionCode">
<span<?php echo $employment_acting_list->SectionCode->viewAttributes() ?>><?php echo $employment_acting_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingPosition->Visible) { // ActingPosition ?>
		<td data-name="ActingPosition" <?php echo $employment_acting_list->ActingPosition->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingPosition" class="form-group">
<?php $employment_acting_list->ActingPosition->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingPosition" data-value-separator="<?php echo $employment_acting_list->ActingPosition->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingPosition"<?php echo $employment_acting_list->ActingPosition->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingPosition->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingPosition") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingPosition->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingPosition") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingPosition" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" value="<?php echo HtmlEncode($employment_acting_list->ActingPosition->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php $employment_acting_list->ActingPosition->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingPosition" data-value-separator="<?php echo $employment_acting_list->ActingPosition->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingPosition"<?php echo $employment_acting_list->ActingPosition->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingPosition->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingPosition") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingPosition->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingPosition") ?>
<input type="hidden" data-table="employment_acting" data-field="x_ActingPosition" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" value="<?php echo HtmlEncode($employment_acting_list->ActingPosition->OldValue != null ? $employment_acting_list->ActingPosition->OldValue : $employment_acting_list->ActingPosition->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingPosition">
<span<?php echo $employment_acting_list->ActingPosition->viewAttributes() ?>><?php echo $employment_acting_list->ActingPosition->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
		<td data-name="DateOfActingAppointment" <?php echo $employment_acting_list->DateOfActingAppointment->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_DateOfActingAppointment" class="form-group">
<input type="text" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" id="x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" placeholder="<?php echo HtmlEncode($employment_acting_list->DateOfActingAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->DateOfActingAppointment->EditValue ?>"<?php echo $employment_acting_list->DateOfActingAppointment->editAttributes() ?>>
<?php if (!$employment_acting_list->DateOfActingAppointment->ReadOnly && !$employment_acting_list->DateOfActingAppointment->Disabled && !isset($employment_acting_list->DateOfActingAppointment->EditAttrs["readonly"]) && !isset($employment_acting_list->DateOfActingAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actinglist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actinglist", "x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="o<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" id="o<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" value="<?php echo HtmlEncode($employment_acting_list->DateOfActingAppointment->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" id="x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" placeholder="<?php echo HtmlEncode($employment_acting_list->DateOfActingAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->DateOfActingAppointment->EditValue ?>"<?php echo $employment_acting_list->DateOfActingAppointment->editAttributes() ?>>
<?php if (!$employment_acting_list->DateOfActingAppointment->ReadOnly && !$employment_acting_list->DateOfActingAppointment->Disabled && !isset($employment_acting_list->DateOfActingAppointment->EditAttrs["readonly"]) && !isset($employment_acting_list->DateOfActingAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actinglist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actinglist", "x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
<input type="hidden" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="o<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" id="o<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" value="<?php echo HtmlEncode($employment_acting_list->DateOfActingAppointment->OldValue != null ? $employment_acting_list->DateOfActingAppointment->OldValue : $employment_acting_list->DateOfActingAppointment->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_DateOfActingAppointment">
<span<?php echo $employment_acting_list->DateOfActingAppointment->viewAttributes() ?>><?php echo $employment_acting_list->DateOfActingAppointment->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
		<td data-name="EndDateOfActingPeriod" <?php echo $employment_acting_list->EndDateOfActingPeriod->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_EndDateOfActingPeriod" class="form-group">
<input type="text" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" id="x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" placeholder="<?php echo HtmlEncode($employment_acting_list->EndDateOfActingPeriod->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->EndDateOfActingPeriod->EditValue ?>"<?php echo $employment_acting_list->EndDateOfActingPeriod->editAttributes() ?>>
<?php if (!$employment_acting_list->EndDateOfActingPeriod->ReadOnly && !$employment_acting_list->EndDateOfActingPeriod->Disabled && !isset($employment_acting_list->EndDateOfActingPeriod->EditAttrs["readonly"]) && !isset($employment_acting_list->EndDateOfActingPeriod->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actinglist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actinglist", "x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="o<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" id="o<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" value="<?php echo HtmlEncode($employment_acting_list->EndDateOfActingPeriod->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_EndDateOfActingPeriod" class="form-group">
<input type="text" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" id="x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" placeholder="<?php echo HtmlEncode($employment_acting_list->EndDateOfActingPeriod->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->EndDateOfActingPeriod->EditValue ?>"<?php echo $employment_acting_list->EndDateOfActingPeriod->editAttributes() ?>>
<?php if (!$employment_acting_list->EndDateOfActingPeriod->ReadOnly && !$employment_acting_list->EndDateOfActingPeriod->Disabled && !isset($employment_acting_list->EndDateOfActingPeriod->EditAttrs["readonly"]) && !isset($employment_acting_list->EndDateOfActingPeriod->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actinglist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actinglist", "x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_EndDateOfActingPeriod">
<span<?php echo $employment_acting_list->EndDateOfActingPeriod->viewAttributes() ?>><?php echo $employment_acting_list->EndDateOfActingPeriod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $employment_acting_list->SalaryScale->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_SalaryScale" class="form-group">
<input type="text" data-table="employment_acting" data-field="x_SalaryScale" name="x<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_acting_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->SalaryScale->EditValue ?>"<?php echo $employment_acting_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_SalaryScale" name="o<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" id="o<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($employment_acting_list->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_SalaryScale" class="form-group">
<input type="text" data-table="employment_acting" data-field="x_SalaryScale" name="x<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_acting_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->SalaryScale->EditValue ?>"<?php echo $employment_acting_list->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_SalaryScale">
<span<?php echo $employment_acting_list->SalaryScale->viewAttributes() ?>><?php echo $employment_acting_list->SalaryScale->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingType->Visible) { // ActingType ?>
		<td data-name="ActingType" <?php echo $employment_acting_list->ActingType->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingType" data-value-separator="<?php echo $employment_acting_list->ActingType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingType" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingType"<?php echo $employment_acting_list->ActingType->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingType->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingType") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingType->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingType") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingType" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingType" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingType" value="<?php echo HtmlEncode($employment_acting_list->ActingType->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingType" data-value-separator="<?php echo $employment_acting_list->ActingType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingType" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingType"<?php echo $employment_acting_list->ActingType->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingType->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingType") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingType->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingType") ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingType">
<span<?php echo $employment_acting_list->ActingType->viewAttributes() ?>><?php echo $employment_acting_list->ActingType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingStatus->Visible) { // ActingStatus ?>
		<td data-name="ActingStatus" <?php echo $employment_acting_list->ActingStatus->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingStatus" data-value-separator="<?php echo $employment_acting_list->ActingStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingStatus" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingStatus"<?php echo $employment_acting_list->ActingStatus->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingStatus->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingStatus") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingStatus->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingStatus") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingStatus" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingStatus" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingStatus" value="<?php echo HtmlEncode($employment_acting_list->ActingStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingStatus" data-value-separator="<?php echo $employment_acting_list->ActingStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingStatus" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingStatus"<?php echo $employment_acting_list->ActingStatus->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingStatus->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingStatus") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingStatus->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingStatus") ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingStatus">
<span<?php echo $employment_acting_list->ActingStatus->viewAttributes() ?>><?php echo $employment_acting_list->ActingStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingReason->Visible) { // ActingReason ?>
		<td data-name="ActingReason" <?php echo $employment_acting_list->ActingReason->cellAttributes() ?>>
<?php if ($employment_acting->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingReason" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingReason" data-value-separator="<?php echo $employment_acting_list->ActingReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingReason" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingReason"<?php echo $employment_acting_list->ActingReason->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingReason->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingReason") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingReason->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingReason") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingReason" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingReason" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingReason" value="<?php echo HtmlEncode($employment_acting_list->ActingReason->OldValue) ?>">
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingReason" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingReason" data-value-separator="<?php echo $employment_acting_list->ActingReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingReason" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingReason"<?php echo $employment_acting_list->ActingReason->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingReason->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingReason") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingReason->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingReason") ?>
</span>
<?php } ?>
<?php if ($employment_acting->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_acting_list->RowCount ?>_employment_acting_ActingReason">
<span<?php echo $employment_acting_list->ActingReason->viewAttributes() ?>><?php echo $employment_acting_list->ActingReason->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_acting_list->ListOptions->render("body", "right", $employment_acting_list->RowCount);
?>
	</tr>
<?php if ($employment_acting->RowType == ROWTYPE_ADD || $employment_acting->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployment_actinglist", "load"], function() {
	femployment_actinglist.updateLists(<?php echo $employment_acting_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employment_acting_list->isGridAdd())
		if (!$employment_acting_list->Recordset->EOF)
			$employment_acting_list->Recordset->moveNext();
}
?>
<?php
	if ($employment_acting_list->isGridAdd() || $employment_acting_list->isGridEdit()) {
		$employment_acting_list->RowIndex = '$rowindex$';
		$employment_acting_list->loadRowValues();

		// Set row properties
		$employment_acting->resetAttributes();
		$employment_acting->RowAttrs->merge(["data-rowindex" => $employment_acting_list->RowIndex, "id" => "r0_employment_acting", "data-rowtype" => ROWTYPE_ADD]);
		$employment_acting->RowAttrs->appendClass("ew-template");
		$employment_acting->RowType = ROWTYPE_ADD;

		// Render row
		$employment_acting_list->renderRow();

		// Render list options
		$employment_acting_list->renderListOptions();
		$employment_acting_list->StartRowCount = 0;
?>
	<tr <?php echo $employment_acting->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_acting_list->ListOptions->render("body", "left", $employment_acting_list->RowIndex);
?>
	<?php if ($employment_acting_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<span id="el$rowindex$_employment_acting_EmployeeID" class="form-group employment_acting_EmployeeID">
<input type="text" data-table="employment_acting" data-field="x_EmployeeID" name="x<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_acting_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->EmployeeID->EditValue ?>"<?php echo $employment_acting_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_EmployeeID" name="o<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_acting_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_acting_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<span id="el$rowindex$_employment_acting_ProvinceCode" class="form-group employment_acting_ProvinceCode">
<?php
$onchange = $employment_acting_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_acting_list->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($employment_acting_list->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->getPlaceHolder()) ?>"<?php echo $employment_acting_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_acting_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployment_actinglist"], function() {
	femployment_actinglist.createAutoSuggest({"id":"x<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $employment_acting_list->ProvinceCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ProvinceCode" name="o<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_acting_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_acting_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el$rowindex$_employment_acting_LACode" class="form-group employment_acting_LACode">
<?php $employment_acting_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_LACode" data-value-separator="<?php echo $employment_acting_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_LACode" name="x<?php echo $employment_acting_list->RowIndex ?>_LACode"<?php echo $employment_acting_list->LACode->editAttributes() ?>>
			<?php echo $employment_acting_list->LACode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $employment_acting_list->LACode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_LACode" name="o<?php echo $employment_acting_list->RowIndex ?>_LACode" id="o<?php echo $employment_acting_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_acting_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_employment_acting_DepartmentCode" class="form-group employment_acting_DepartmentCode">
<?php $employment_acting_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_DepartmentCode" data-value-separator="<?php echo $employment_acting_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode" name="x<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode"<?php echo $employment_acting_list->DepartmentCode->editAttributes() ?>>
			<?php echo $employment_acting_list->DepartmentCode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $employment_acting_list->DepartmentCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_DepartmentCode" name="o<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_acting_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_acting_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_employment_acting_SectionCode" class="form-group employment_acting_SectionCode">
<?php $employment_acting_list->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_SectionCode" data-value-separator="<?php echo $employment_acting_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_SectionCode" name="x<?php echo $employment_acting_list->RowIndex ?>_SectionCode"<?php echo $employment_acting_list->SectionCode->editAttributes() ?>>
			<?php echo $employment_acting_list->SectionCode->selectOptionListHtml("x{$employment_acting_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $employment_acting_list->SectionCode->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_SectionCode" name="o<?php echo $employment_acting_list->RowIndex ?>_SectionCode" id="o<?php echo $employment_acting_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_acting_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingPosition->Visible) { // ActingPosition ?>
		<td data-name="ActingPosition">
<span id="el$rowindex$_employment_acting_ActingPosition" class="form-group employment_acting_ActingPosition">
<?php $employment_acting_list->ActingPosition->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingPosition" data-value-separator="<?php echo $employment_acting_list->ActingPosition->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingPosition"<?php echo $employment_acting_list->ActingPosition->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingPosition->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingPosition") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingPosition->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingPosition") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingPosition" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingPosition" value="<?php echo HtmlEncode($employment_acting_list->ActingPosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->DateOfActingAppointment->Visible) { // DateOfActingAppointment ?>
		<td data-name="DateOfActingAppointment">
<span id="el$rowindex$_employment_acting_DateOfActingAppointment" class="form-group employment_acting_DateOfActingAppointment">
<input type="text" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" id="x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" placeholder="<?php echo HtmlEncode($employment_acting_list->DateOfActingAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->DateOfActingAppointment->EditValue ?>"<?php echo $employment_acting_list->DateOfActingAppointment->editAttributes() ?>>
<?php if (!$employment_acting_list->DateOfActingAppointment->ReadOnly && !$employment_acting_list->DateOfActingAppointment->Disabled && !isset($employment_acting_list->DateOfActingAppointment->EditAttrs["readonly"]) && !isset($employment_acting_list->DateOfActingAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actinglist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actinglist", "x<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_DateOfActingAppointment" name="o<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" id="o<?php echo $employment_acting_list->RowIndex ?>_DateOfActingAppointment" value="<?php echo HtmlEncode($employment_acting_list->DateOfActingAppointment->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->EndDateOfActingPeriod->Visible) { // EndDateOfActingPeriod ?>
		<td data-name="EndDateOfActingPeriod">
<span id="el$rowindex$_employment_acting_EndDateOfActingPeriod" class="form-group employment_acting_EndDateOfActingPeriod">
<input type="text" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" id="x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" placeholder="<?php echo HtmlEncode($employment_acting_list->EndDateOfActingPeriod->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->EndDateOfActingPeriod->EditValue ?>"<?php echo $employment_acting_list->EndDateOfActingPeriod->editAttributes() ?>>
<?php if (!$employment_acting_list->EndDateOfActingPeriod->ReadOnly && !$employment_acting_list->EndDateOfActingPeriod->Disabled && !isset($employment_acting_list->EndDateOfActingPeriod->EditAttrs["readonly"]) && !isset($employment_acting_list->EndDateOfActingPeriod->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployment_actinglist", "datetimepicker"], function() {
	ew.createDateTimePicker("femployment_actinglist", "x<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_EndDateOfActingPeriod" name="o<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" id="o<?php echo $employment_acting_list->RowIndex ?>_EndDateOfActingPeriod" value="<?php echo HtmlEncode($employment_acting_list->EndDateOfActingPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<span id="el$rowindex$_employment_acting_SalaryScale" class="form-group employment_acting_SalaryScale">
<input type="text" data-table="employment_acting" data-field="x_SalaryScale" name="x<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_acting_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_acting_list->SalaryScale->EditValue ?>"<?php echo $employment_acting_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_SalaryScale" name="o<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" id="o<?php echo $employment_acting_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($employment_acting_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingType->Visible) { // ActingType ?>
		<td data-name="ActingType">
<span id="el$rowindex$_employment_acting_ActingType" class="form-group employment_acting_ActingType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingType" data-value-separator="<?php echo $employment_acting_list->ActingType->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingType" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingType"<?php echo $employment_acting_list->ActingType->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingType->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingType") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingType->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingType") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingType" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingType" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingType" value="<?php echo HtmlEncode($employment_acting_list->ActingType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingStatus->Visible) { // ActingStatus ?>
		<td data-name="ActingStatus">
<span id="el$rowindex$_employment_acting_ActingStatus" class="form-group employment_acting_ActingStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingStatus" data-value-separator="<?php echo $employment_acting_list->ActingStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingStatus" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingStatus"<?php echo $employment_acting_list->ActingStatus->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingStatus->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingStatus") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingStatus->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingStatus") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingStatus" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingStatus" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingStatus" value="<?php echo HtmlEncode($employment_acting_list->ActingStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_acting_list->ActingReason->Visible) { // ActingReason ?>
		<td data-name="ActingReason">
<span id="el$rowindex$_employment_acting_ActingReason" class="form-group employment_acting_ActingReason">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment_acting" data-field="x_ActingReason" data-value-separator="<?php echo $employment_acting_list->ActingReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $employment_acting_list->RowIndex ?>_ActingReason" name="x<?php echo $employment_acting_list->RowIndex ?>_ActingReason"<?php echo $employment_acting_list->ActingReason->editAttributes() ?>>
			<?php echo $employment_acting_list->ActingReason->selectOptionListHtml("x{$employment_acting_list->RowIndex}_ActingReason") ?>
		</select>
</div>
<?php echo $employment_acting_list->ActingReason->Lookup->getParamTag($employment_acting_list, "p_x" . $employment_acting_list->RowIndex . "_ActingReason") ?>
</span>
<input type="hidden" data-table="employment_acting" data-field="x_ActingReason" name="o<?php echo $employment_acting_list->RowIndex ?>_ActingReason" id="o<?php echo $employment_acting_list->RowIndex ?>_ActingReason" value="<?php echo HtmlEncode($employment_acting_list->ActingReason->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_acting_list->ListOptions->render("body", "right", $employment_acting_list->RowIndex);
?>
<script>
loadjs.ready(["femployment_actinglist", "load"], function() {
	femployment_actinglist.updateLists(<?php echo $employment_acting_list->RowIndex ?>);
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
<?php if ($employment_acting_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employment_acting_list->FormKeyCountName ?>" id="<?php echo $employment_acting_list->FormKeyCountName ?>" value="<?php echo $employment_acting_list->KeyCount ?>">
<?php echo $employment_acting_list->MultiSelectKey ?>
<?php } ?>
<?php if ($employment_acting_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $employment_acting_list->FormKeyCountName ?>" id="<?php echo $employment_acting_list->FormKeyCountName ?>" value="<?php echo $employment_acting_list->KeyCount ?>">
<?php echo $employment_acting_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employment_acting->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employment_acting_list->Recordset)
	$employment_acting_list->Recordset->Close();
?>
<?php if (!$employment_acting_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employment_acting_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_acting_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_acting_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employment_acting_list->TotalRecords == 0 && !$employment_acting->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employment_acting_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employment_acting_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_acting_list->isExport()) { ?>
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
$employment_acting_list->terminate();
?>