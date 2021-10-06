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
$staffexperience_list = new staffexperience_list();

// Run the page
$staffexperience_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffexperience_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffexperience_list->isExport()) { ?>
<script>
var fstaffexperiencelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaffexperiencelist = currentForm = new ew.Form("fstaffexperiencelist", "list");
	fstaffexperiencelist.formKeyCountName = '<?php echo $staffexperience_list->FormKeyCountName ?>';

	// Validate form
	fstaffexperiencelist.validate = function() {
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
			<?php if ($staffexperience_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_list->ProvinceCode->caption(), $staffexperience_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_list->LAcode->Required) { ?>
				elm = this.getElements("x" + infix + "_LAcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_list->LAcode->caption(), $staffexperience_list->LAcode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_list->PositionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_list->PositionCode->caption(), $staffexperience_list->PositionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_list->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_list->FromDate->caption(), $staffexperience_list->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_list->FromDate->errorMessage()) ?>");
			<?php if ($staffexperience_list->ExitDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_list->ExitDate->caption(), $staffexperience_list->ExitDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffexperience_list->ExitDate->errorMessage()) ?>");
			<?php if ($staffexperience_list->ReasonForExit->Required) { ?>
				elm = this.getElements("x" + infix + "_ReasonForExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_list->ReasonForExit->caption(), $staffexperience_list->ReasonForExit->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffexperience_list->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffexperience_list->RetirementType->caption(), $staffexperience_list->RetirementType->RequiredErrorMessage)) ?>");
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
	fstaffexperiencelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LAcode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PositionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "FromDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExitDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReasonForExit", false)) return false;
		if (ew.valueChanged(fobj, infix, "RetirementType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffexperiencelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffexperiencelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffexperiencelist.lists["x_ProvinceCode"] = <?php echo $staffexperience_list->ProvinceCode->Lookup->toClientList($staffexperience_list) ?>;
	fstaffexperiencelist.lists["x_ProvinceCode"].options = <?php echo JsonEncode($staffexperience_list->ProvinceCode->lookupOptions()) ?>;
	fstaffexperiencelist.lists["x_LAcode"] = <?php echo $staffexperience_list->LAcode->Lookup->toClientList($staffexperience_list) ?>;
	fstaffexperiencelist.lists["x_LAcode"].options = <?php echo JsonEncode($staffexperience_list->LAcode->lookupOptions()) ?>;
	fstaffexperiencelist.lists["x_PositionCode"] = <?php echo $staffexperience_list->PositionCode->Lookup->toClientList($staffexperience_list) ?>;
	fstaffexperiencelist.lists["x_PositionCode"].options = <?php echo JsonEncode($staffexperience_list->PositionCode->lookupOptions()) ?>;
	fstaffexperiencelist.lists["x_ReasonForExit"] = <?php echo $staffexperience_list->ReasonForExit->Lookup->toClientList($staffexperience_list) ?>;
	fstaffexperiencelist.lists["x_ReasonForExit"].options = <?php echo JsonEncode($staffexperience_list->ReasonForExit->lookupOptions()) ?>;
	fstaffexperiencelist.lists["x_RetirementType"] = <?php echo $staffexperience_list->RetirementType->Lookup->toClientList($staffexperience_list) ?>;
	fstaffexperiencelist.lists["x_RetirementType"].options = <?php echo JsonEncode($staffexperience_list->RetirementType->lookupOptions()) ?>;
	loadjs.done("fstaffexperiencelist");
});
var fstaffexperiencelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstaffexperiencelistsrch = currentSearchForm = new ew.Form("fstaffexperiencelistsrch");

	// Dynamic selection lists
	// Filters

	fstaffexperiencelistsrch.filterList = <?php echo $staffexperience_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstaffexperiencelistsrch.initSearchPanel = true;
	loadjs.done("fstaffexperiencelistsrch");
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
<?php if (!$staffexperience_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staffexperience_list->TotalRecords > 0 && $staffexperience_list->ExportOptions->visible()) { ?>
<?php $staffexperience_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staffexperience_list->ImportOptions->visible()) { ?>
<?php $staffexperience_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($staffexperience_list->SearchOptions->visible()) { ?>
<?php $staffexperience_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($staffexperience_list->FilterOptions->visible()) { ?>
<?php $staffexperience_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$staffexperience_list->isExport() || Config("EXPORT_MASTER_RECORD") && $staffexperience_list->isExport("print")) { ?>
<?php
if ($staffexperience_list->DbMasterFilter != "" && $staffexperience->getCurrentMasterTable() == "staff") {
	if ($staffexperience_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$staffexperience_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$staffexperience_list->isExport() && !$staffexperience->CurrentAction) { ?>
<form name="fstaffexperiencelistsrch" id="fstaffexperiencelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstaffexperiencelistsrch-search-panel" class="<?php echo $staffexperience_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="staffexperience">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $staffexperience_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($staffexperience_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($staffexperience_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $staffexperience_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($staffexperience_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($staffexperience_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($staffexperience_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($staffexperience_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $staffexperience_list->showPageHeader(); ?>
<?php
$staffexperience_list->showMessage();
?>
<?php if ($staffexperience_list->TotalRecords > 0 || $staffexperience->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffexperience_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffexperience">
<?php if (!$staffexperience_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staffexperience_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffexperience_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffexperience_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaffexperiencelist" id="fstaffexperiencelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffexperience">
<?php if ($staffexperience->getCurrentMasterTable() == "staff" && $staffexperience->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffexperience_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_staffexperience" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staffexperience_list->TotalRecords > 0 || $staffexperience_list->isGridEdit()) { ?>
<table id="tbl_staffexperiencelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffexperience->RowType = ROWTYPE_HEADER;

// Render list options
$staffexperience_list->renderListOptions();

// Render list options (header, left)
$staffexperience_list->ListOptions->render("header", "left");
?>
<?php if ($staffexperience_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($staffexperience_list->SortUrl($staffexperience_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $staffexperience_list->ProvinceCode->headerCellClass() ?>"><div id="elh_staffexperience_ProvinceCode" class="staffexperience_ProvinceCode"><div class="ew-table-header-caption"><?php echo $staffexperience_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $staffexperience_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffexperience_list->SortUrl($staffexperience_list->ProvinceCode) ?>', 1);"><div id="elh_staffexperience_ProvinceCode" class="staffexperience_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_list->LAcode->Visible) { // LAcode ?>
	<?php if ($staffexperience_list->SortUrl($staffexperience_list->LAcode) == "") { ?>
		<th data-name="LAcode" class="<?php echo $staffexperience_list->LAcode->headerCellClass() ?>"><div id="elh_staffexperience_LAcode" class="staffexperience_LAcode"><div class="ew-table-header-caption"><?php echo $staffexperience_list->LAcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAcode" class="<?php echo $staffexperience_list->LAcode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffexperience_list->SortUrl($staffexperience_list->LAcode) ?>', 1);"><div id="elh_staffexperience_LAcode" class="staffexperience_LAcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_list->LAcode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_list->LAcode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_list->LAcode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_list->PositionCode->Visible) { // PositionCode ?>
	<?php if ($staffexperience_list->SortUrl($staffexperience_list->PositionCode) == "") { ?>
		<th data-name="PositionCode" class="<?php echo $staffexperience_list->PositionCode->headerCellClass() ?>"><div id="elh_staffexperience_PositionCode" class="staffexperience_PositionCode"><div class="ew-table-header-caption"><?php echo $staffexperience_list->PositionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionCode" class="<?php echo $staffexperience_list->PositionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffexperience_list->SortUrl($staffexperience_list->PositionCode) ?>', 1);"><div id="elh_staffexperience_PositionCode" class="staffexperience_PositionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_list->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_list->PositionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_list->PositionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_list->FromDate->Visible) { // FromDate ?>
	<?php if ($staffexperience_list->SortUrl($staffexperience_list->FromDate) == "") { ?>
		<th data-name="FromDate" class="<?php echo $staffexperience_list->FromDate->headerCellClass() ?>"><div id="elh_staffexperience_FromDate" class="staffexperience_FromDate"><div class="ew-table-header-caption"><?php echo $staffexperience_list->FromDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromDate" class="<?php echo $staffexperience_list->FromDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffexperience_list->SortUrl($staffexperience_list->FromDate) ?>', 1);"><div id="elh_staffexperience_FromDate" class="staffexperience_FromDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_list->FromDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_list->FromDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_list->FromDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_list->ExitDate->Visible) { // ExitDate ?>
	<?php if ($staffexperience_list->SortUrl($staffexperience_list->ExitDate) == "") { ?>
		<th data-name="ExitDate" class="<?php echo $staffexperience_list->ExitDate->headerCellClass() ?>"><div id="elh_staffexperience_ExitDate" class="staffexperience_ExitDate"><div class="ew-table-header-caption"><?php echo $staffexperience_list->ExitDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitDate" class="<?php echo $staffexperience_list->ExitDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffexperience_list->SortUrl($staffexperience_list->ExitDate) ?>', 1);"><div id="elh_staffexperience_ExitDate" class="staffexperience_ExitDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_list->ExitDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_list->ExitDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_list->ExitDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_list->ReasonForExit->Visible) { // ReasonForExit ?>
	<?php if ($staffexperience_list->SortUrl($staffexperience_list->ReasonForExit) == "") { ?>
		<th data-name="ReasonForExit" class="<?php echo $staffexperience_list->ReasonForExit->headerCellClass() ?>"><div id="elh_staffexperience_ReasonForExit" class="staffexperience_ReasonForExit"><div class="ew-table-header-caption"><?php echo $staffexperience_list->ReasonForExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReasonForExit" class="<?php echo $staffexperience_list->ReasonForExit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffexperience_list->SortUrl($staffexperience_list->ReasonForExit) ?>', 1);"><div id="elh_staffexperience_ReasonForExit" class="staffexperience_ReasonForExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_list->ReasonForExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_list->ReasonForExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_list->ReasonForExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffexperience_list->RetirementType->Visible) { // RetirementType ?>
	<?php if ($staffexperience_list->SortUrl($staffexperience_list->RetirementType) == "") { ?>
		<th data-name="RetirementType" class="<?php echo $staffexperience_list->RetirementType->headerCellClass() ?>"><div id="elh_staffexperience_RetirementType" class="staffexperience_RetirementType"><div class="ew-table-header-caption"><?php echo $staffexperience_list->RetirementType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetirementType" class="<?php echo $staffexperience_list->RetirementType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffexperience_list->SortUrl($staffexperience_list->RetirementType) ?>', 1);"><div id="elh_staffexperience_RetirementType" class="staffexperience_RetirementType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffexperience_list->RetirementType->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffexperience_list->RetirementType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffexperience_list->RetirementType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffexperience_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staffexperience_list->ExportAll && $staffexperience_list->isExport()) {
	$staffexperience_list->StopRecord = $staffexperience_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staffexperience_list->TotalRecords > $staffexperience_list->StartRecord + $staffexperience_list->DisplayRecords - 1)
		$staffexperience_list->StopRecord = $staffexperience_list->StartRecord + $staffexperience_list->DisplayRecords - 1;
	else
		$staffexperience_list->StopRecord = $staffexperience_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($staffexperience->isConfirm() || $staffexperience_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffexperience_list->FormKeyCountName) && ($staffexperience_list->isGridAdd() || $staffexperience_list->isGridEdit() || $staffexperience->isConfirm())) {
		$staffexperience_list->KeyCount = $CurrentForm->getValue($staffexperience_list->FormKeyCountName);
		$staffexperience_list->StopRecord = $staffexperience_list->StartRecord + $staffexperience_list->KeyCount - 1;
	}
}
$staffexperience_list->RecordCount = $staffexperience_list->StartRecord - 1;
if ($staffexperience_list->Recordset && !$staffexperience_list->Recordset->EOF) {
	$staffexperience_list->Recordset->moveFirst();
	$selectLimit = $staffexperience_list->UseSelectLimit;
	if (!$selectLimit && $staffexperience_list->StartRecord > 1)
		$staffexperience_list->Recordset->move($staffexperience_list->StartRecord - 1);
} elseif (!$staffexperience->AllowAddDeleteRow && $staffexperience_list->StopRecord == 0) {
	$staffexperience_list->StopRecord = $staffexperience->GridAddRowCount;
}

// Initialize aggregate
$staffexperience->RowType = ROWTYPE_AGGREGATEINIT;
$staffexperience->resetAttributes();
$staffexperience_list->renderRow();
if ($staffexperience_list->isGridAdd())
	$staffexperience_list->RowIndex = 0;
if ($staffexperience_list->isGridEdit())
	$staffexperience_list->RowIndex = 0;
while ($staffexperience_list->RecordCount < $staffexperience_list->StopRecord) {
	$staffexperience_list->RecordCount++;
	if ($staffexperience_list->RecordCount >= $staffexperience_list->StartRecord) {
		$staffexperience_list->RowCount++;
		if ($staffexperience_list->isGridAdd() || $staffexperience_list->isGridEdit() || $staffexperience->isConfirm()) {
			$staffexperience_list->RowIndex++;
			$CurrentForm->Index = $staffexperience_list->RowIndex;
			if ($CurrentForm->hasValue($staffexperience_list->FormActionName) && ($staffexperience->isConfirm() || $staffexperience_list->EventCancelled))
				$staffexperience_list->RowAction = strval($CurrentForm->getValue($staffexperience_list->FormActionName));
			elseif ($staffexperience_list->isGridAdd())
				$staffexperience_list->RowAction = "insert";
			else
				$staffexperience_list->RowAction = "";
		}

		// Set up key count
		$staffexperience_list->KeyCount = $staffexperience_list->RowIndex;

		// Init row class and style
		$staffexperience->resetAttributes();
		$staffexperience->CssClass = "";
		if ($staffexperience_list->isGridAdd()) {
			$staffexperience_list->loadRowValues(); // Load default values
		} else {
			$staffexperience_list->loadRowValues($staffexperience_list->Recordset); // Load row values
		}
		$staffexperience->RowType = ROWTYPE_VIEW; // Render view
		if ($staffexperience_list->isGridAdd()) // Grid add
			$staffexperience->RowType = ROWTYPE_ADD; // Render add
		if ($staffexperience_list->isGridAdd() && $staffexperience->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffexperience_list->restoreCurrentRowFormValues($staffexperience_list->RowIndex); // Restore form values
		if ($staffexperience_list->isGridEdit()) { // Grid edit
			if ($staffexperience->EventCancelled)
				$staffexperience_list->restoreCurrentRowFormValues($staffexperience_list->RowIndex); // Restore form values
			if ($staffexperience_list->RowAction == "insert")
				$staffexperience->RowType = ROWTYPE_ADD; // Render add
			else
				$staffexperience->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffexperience_list->isGridEdit() && ($staffexperience->RowType == ROWTYPE_EDIT || $staffexperience->RowType == ROWTYPE_ADD) && $staffexperience->EventCancelled) // Update failed
			$staffexperience_list->restoreCurrentRowFormValues($staffexperience_list->RowIndex); // Restore form values
		if ($staffexperience->RowType == ROWTYPE_EDIT) // Edit row
			$staffexperience_list->EditRowCount++;

		// Set up row id / data-rowindex
		$staffexperience->RowAttrs->merge(["data-rowindex" => $staffexperience_list->RowCount, "id" => "r" . $staffexperience_list->RowCount . "_staffexperience", "data-rowtype" => $staffexperience->RowType]);

		// Render row
		$staffexperience_list->renderRow();

		// Render list options
		$staffexperience_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffexperience_list->RowAction != "delete" && $staffexperience_list->RowAction != "insertdelete" && !($staffexperience_list->RowAction == "insert" && $staffexperience->isConfirm() && $staffexperience_list->emptyRow())) {
?>
	<tr <?php echo $staffexperience->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffexperience_list->ListOptions->render("body", "left", $staffexperience_list->RowCount);
?>
	<?php if ($staffexperience_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $staffexperience_list->ProvinceCode->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ProvinceCode" class="form-group">
<?php $staffexperience_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode" name="x<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode"<?php echo $staffexperience_list->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_list->ProvinceCode->selectOptionListHtml("x{$staffexperience_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_list->ProvinceCode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="o<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode" id="o<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ProvinceCode" class="form-group">
<?php $staffexperience_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode" name="x<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode"<?php echo $staffexperience_list->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_list->ProvinceCode->selectOptionListHtml("x{$staffexperience_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_list->ProvinceCode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ProvinceCode">
<span<?php echo $staffexperience_list->ProvinceCode->viewAttributes() ?>><?php echo $staffexperience_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffexperience" data-field="x_EmployeeID" name="x<?php echo $staffexperience_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffexperience_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffexperience_list->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_EmployeeID" name="o<?php echo $staffexperience_list->RowIndex ?>_EmployeeID" id="o<?php echo $staffexperience_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffexperience_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT || $staffexperience->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffexperience" data-field="x_EmployeeID" name="x<?php echo $staffexperience_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffexperience_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffexperience_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffexperience" data-field="x_IndexNo" name="x<?php echo $staffexperience_list->RowIndex ?>_IndexNo" id="x<?php echo $staffexperience_list->RowIndex ?>_IndexNo" value="<?php echo HtmlEncode($staffexperience_list->IndexNo->CurrentValue) ?>">
<input type="hidden" data-table="staffexperience" data-field="x_IndexNo" name="o<?php echo $staffexperience_list->RowIndex ?>_IndexNo" id="o<?php echo $staffexperience_list->RowIndex ?>_IndexNo" value="<?php echo HtmlEncode($staffexperience_list->IndexNo->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT || $staffexperience->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffexperience" data-field="x_IndexNo" name="x<?php echo $staffexperience_list->RowIndex ?>_IndexNo" id="x<?php echo $staffexperience_list->RowIndex ?>_IndexNo" value="<?php echo HtmlEncode($staffexperience_list->IndexNo->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffexperience_list->LAcode->Visible) { // LAcode ?>
		<td data-name="LAcode" <?php echo $staffexperience_list->LAcode->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_LAcode" class="form-group">
<?php $staffexperience_list->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_list->RowIndex ?>_LAcode"><?php echo EmptyValue(strval($staffexperience_list->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_list->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_list->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_list->LAcode->ReadOnly || $staffexperience_list->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_list->RowIndex ?>_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_list->LAcode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_list->LAcode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_list->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_list->RowIndex ?>_LAcode" value="<?php echo $staffexperience_list->LAcode->CurrentValue ?>"<?php echo $staffexperience_list->LAcode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="o<?php echo $staffexperience_list->RowIndex ?>_LAcode" id="o<?php echo $staffexperience_list->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_list->LAcode->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_LAcode" class="form-group">
<?php $staffexperience_list->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_list->RowIndex ?>_LAcode"><?php echo EmptyValue(strval($staffexperience_list->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_list->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_list->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_list->LAcode->ReadOnly || $staffexperience_list->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_list->RowIndex ?>_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_list->LAcode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_list->LAcode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_list->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_list->RowIndex ?>_LAcode" value="<?php echo $staffexperience_list->LAcode->CurrentValue ?>"<?php echo $staffexperience_list->LAcode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_LAcode">
<span<?php echo $staffexperience_list->LAcode->viewAttributes() ?>><?php echo $staffexperience_list->LAcode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_list->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode" <?php echo $staffexperience_list->PositionCode->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_PositionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_list->RowIndex ?>_PositionCode"><?php echo EmptyValue(strval($staffexperience_list->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_list->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_list->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_list->PositionCode->ReadOnly || $staffexperience_list->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_list->RowIndex ?>_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_list->PositionCode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_list->PositionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_list->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_list->RowIndex ?>_PositionCode" value="<?php echo $staffexperience_list->PositionCode->CurrentValue ?>"<?php echo $staffexperience_list->PositionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="o<?php echo $staffexperience_list->RowIndex ?>_PositionCode" id="o<?php echo $staffexperience_list->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_list->PositionCode->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_PositionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_list->RowIndex ?>_PositionCode"><?php echo EmptyValue(strval($staffexperience_list->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_list->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_list->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_list->PositionCode->ReadOnly || $staffexperience_list->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_list->RowIndex ?>_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_list->PositionCode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_list->PositionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_list->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_list->RowIndex ?>_PositionCode" value="<?php echo $staffexperience_list->PositionCode->CurrentValue ?>"<?php echo $staffexperience_list->PositionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_PositionCode">
<span<?php echo $staffexperience_list->PositionCode->viewAttributes() ?>><?php echo $staffexperience_list->PositionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_list->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate" <?php echo $staffexperience_list->FromDate->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_FromDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_list->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_list->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_list->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_list->FromDate->EditValue ?>"<?php echo $staffexperience_list->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_list->FromDate->ReadOnly && !$staffexperience_list->FromDate->Disabled && !isset($staffexperience_list->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_list->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencelist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencelist", "x<?php echo $staffexperience_list->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="o<?php echo $staffexperience_list->RowIndex ?>_FromDate" id="o<?php echo $staffexperience_list->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_list->FromDate->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_FromDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_list->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_list->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_list->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_list->FromDate->EditValue ?>"<?php echo $staffexperience_list->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_list->FromDate->ReadOnly && !$staffexperience_list->FromDate->Disabled && !isset($staffexperience_list->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_list->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencelist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencelist", "x<?php echo $staffexperience_list->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_FromDate">
<span<?php echo $staffexperience_list->FromDate->viewAttributes() ?>><?php echo $staffexperience_list->FromDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_list->ExitDate->Visible) { // ExitDate ?>
		<td data-name="ExitDate" <?php echo $staffexperience_list->ExitDate->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ExitDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_list->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_list->RowIndex ?>_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_list->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_list->ExitDate->EditValue ?>"<?php echo $staffexperience_list->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_list->ExitDate->ReadOnly && !$staffexperience_list->ExitDate->Disabled && !isset($staffexperience_list->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_list->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencelist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencelist", "x<?php echo $staffexperience_list->RowIndex ?>_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="o<?php echo $staffexperience_list->RowIndex ?>_ExitDate" id="o<?php echo $staffexperience_list->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_list->ExitDate->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ExitDate" class="form-group">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_list->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_list->RowIndex ?>_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_list->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_list->ExitDate->EditValue ?>"<?php echo $staffexperience_list->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_list->ExitDate->ReadOnly && !$staffexperience_list->ExitDate->Disabled && !isset($staffexperience_list->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_list->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencelist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencelist", "x<?php echo $staffexperience_list->RowIndex ?>_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ExitDate">
<span<?php echo $staffexperience_list->ExitDate->viewAttributes() ?>><?php echo $staffexperience_list->ExitDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_list->ReasonForExit->Visible) { // ReasonForExit ?>
		<td data-name="ReasonForExit" <?php echo $staffexperience_list->ReasonForExit->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ReasonForExit" class="form-group">
<?php $staffexperience_list->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_list->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit" name="x<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit"<?php echo $staffexperience_list->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_list->ReasonForExit->selectOptionListHtml("x{$staffexperience_list->RowIndex}_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_list->ReasonForExit->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_ReasonForExit") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="o<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit" id="o<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_list->ReasonForExit->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ReasonForExit" class="form-group">
<?php $staffexperience_list->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_list->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit" name="x<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit"<?php echo $staffexperience_list->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_list->ReasonForExit->selectOptionListHtml("x{$staffexperience_list->RowIndex}_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_list->ReasonForExit->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_ReasonForExit") ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_ReasonForExit">
<span<?php echo $staffexperience_list->ReasonForExit->viewAttributes() ?>><?php echo $staffexperience_list->ReasonForExit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffexperience_list->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType" <?php echo $staffexperience_list->RetirementType->cellAttributes() ?>>
<?php if ($staffexperience->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_RetirementType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_list->RetirementType->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_RetirementType" name="x<?php echo $staffexperience_list->RowIndex ?>_RetirementType"<?php echo $staffexperience_list->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_list->RetirementType->selectOptionListHtml("x{$staffexperience_list->RowIndex}_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_list->RetirementType->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_RetirementType") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="o<?php echo $staffexperience_list->RowIndex ?>_RetirementType" id="o<?php echo $staffexperience_list->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_list->RetirementType->OldValue) ?>">
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_RetirementType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_list->RetirementType->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_RetirementType" name="x<?php echo $staffexperience_list->RowIndex ?>_RetirementType"<?php echo $staffexperience_list->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_list->RetirementType->selectOptionListHtml("x{$staffexperience_list->RowIndex}_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_list->RetirementType->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_RetirementType") ?>
</span>
<?php } ?>
<?php if ($staffexperience->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffexperience_list->RowCount ?>_staffexperience_RetirementType">
<span<?php echo $staffexperience_list->RetirementType->viewAttributes() ?>><?php echo $staffexperience_list->RetirementType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffexperience_list->ListOptions->render("body", "right", $staffexperience_list->RowCount);
?>
	</tr>
<?php if ($staffexperience->RowType == ROWTYPE_ADD || $staffexperience->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffexperiencelist", "load"], function() {
	fstaffexperiencelist.updateLists(<?php echo $staffexperience_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffexperience_list->isGridAdd())
		if (!$staffexperience_list->Recordset->EOF)
			$staffexperience_list->Recordset->moveNext();
}
?>
<?php
	if ($staffexperience_list->isGridAdd() || $staffexperience_list->isGridEdit()) {
		$staffexperience_list->RowIndex = '$rowindex$';
		$staffexperience_list->loadRowValues();

		// Set row properties
		$staffexperience->resetAttributes();
		$staffexperience->RowAttrs->merge(["data-rowindex" => $staffexperience_list->RowIndex, "id" => "r0_staffexperience", "data-rowtype" => ROWTYPE_ADD]);
		$staffexperience->RowAttrs->appendClass("ew-template");
		$staffexperience->RowType = ROWTYPE_ADD;

		// Render row
		$staffexperience_list->renderRow();

		// Render list options
		$staffexperience_list->renderListOptions();
		$staffexperience_list->StartRowCount = 0;
?>
	<tr <?php echo $staffexperience->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffexperience_list->ListOptions->render("body", "left", $staffexperience_list->RowIndex);
?>
	<?php if ($staffexperience_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<span id="el$rowindex$_staffexperience_ProvinceCode" class="form-group staffexperience_ProvinceCode">
<?php $staffexperience_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ProvinceCode" data-value-separator="<?php echo $staffexperience_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode" name="x<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode"<?php echo $staffexperience_list->ProvinceCode->editAttributes() ?>>
			<?php echo $staffexperience_list->ProvinceCode->selectOptionListHtml("x{$staffexperience_list->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $staffexperience_list->ProvinceCode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_ProvinceCode") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ProvinceCode" name="o<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode" id="o<?php echo $staffexperience_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($staffexperience_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_list->LAcode->Visible) { // LAcode ?>
		<td data-name="LAcode">
<span id="el$rowindex$_staffexperience_LAcode" class="form-group staffexperience_LAcode">
<?php $staffexperience_list->LAcode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_list->RowIndex ?>_LAcode"><?php echo EmptyValue(strval($staffexperience_list->LAcode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_list->LAcode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_list->LAcode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_list->LAcode->ReadOnly || $staffexperience_list->LAcode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_list->RowIndex ?>_LAcode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_list->LAcode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_LAcode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_list->LAcode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_list->RowIndex ?>_LAcode" id="x<?php echo $staffexperience_list->RowIndex ?>_LAcode" value="<?php echo $staffexperience_list->LAcode->CurrentValue ?>"<?php echo $staffexperience_list->LAcode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_LAcode" name="o<?php echo $staffexperience_list->RowIndex ?>_LAcode" id="o<?php echo $staffexperience_list->RowIndex ?>_LAcode" value="<?php echo HtmlEncode($staffexperience_list->LAcode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_list->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode">
<span id="el$rowindex$_staffexperience_PositionCode" class="form-group staffexperience_PositionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffexperience_list->RowIndex ?>_PositionCode"><?php echo EmptyValue(strval($staffexperience_list->PositionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffexperience_list->PositionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffexperience_list->PositionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffexperience_list->PositionCode->ReadOnly || $staffexperience_list->PositionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffexperience_list->RowIndex ?>_PositionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffexperience_list->PositionCode->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_PositionCode") ?>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffexperience_list->PositionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffexperience_list->RowIndex ?>_PositionCode" id="x<?php echo $staffexperience_list->RowIndex ?>_PositionCode" value="<?php echo $staffexperience_list->PositionCode->CurrentValue ?>"<?php echo $staffexperience_list->PositionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_PositionCode" name="o<?php echo $staffexperience_list->RowIndex ?>_PositionCode" id="o<?php echo $staffexperience_list->RowIndex ?>_PositionCode" value="<?php echo HtmlEncode($staffexperience_list->PositionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_list->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate">
<span id="el$rowindex$_staffexperience_FromDate" class="form-group staffexperience_FromDate">
<input type="text" data-table="staffexperience" data-field="x_FromDate" name="x<?php echo $staffexperience_list->RowIndex ?>_FromDate" id="x<?php echo $staffexperience_list->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffexperience_list->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_list->FromDate->EditValue ?>"<?php echo $staffexperience_list->FromDate->editAttributes() ?>>
<?php if (!$staffexperience_list->FromDate->ReadOnly && !$staffexperience_list->FromDate->Disabled && !isset($staffexperience_list->FromDate->EditAttrs["readonly"]) && !isset($staffexperience_list->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencelist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencelist", "x<?php echo $staffexperience_list->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_FromDate" name="o<?php echo $staffexperience_list->RowIndex ?>_FromDate" id="o<?php echo $staffexperience_list->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffexperience_list->FromDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_list->ExitDate->Visible) { // ExitDate ?>
		<td data-name="ExitDate">
<span id="el$rowindex$_staffexperience_ExitDate" class="form-group staffexperience_ExitDate">
<input type="text" data-table="staffexperience" data-field="x_ExitDate" name="x<?php echo $staffexperience_list->RowIndex ?>_ExitDate" id="x<?php echo $staffexperience_list->RowIndex ?>_ExitDate" placeholder="<?php echo HtmlEncode($staffexperience_list->ExitDate->getPlaceHolder()) ?>" value="<?php echo $staffexperience_list->ExitDate->EditValue ?>"<?php echo $staffexperience_list->ExitDate->editAttributes() ?>>
<?php if (!$staffexperience_list->ExitDate->ReadOnly && !$staffexperience_list->ExitDate->Disabled && !isset($staffexperience_list->ExitDate->EditAttrs["readonly"]) && !isset($staffexperience_list->ExitDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffexperiencelist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffexperiencelist", "x<?php echo $staffexperience_list->RowIndex ?>_ExitDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ExitDate" name="o<?php echo $staffexperience_list->RowIndex ?>_ExitDate" id="o<?php echo $staffexperience_list->RowIndex ?>_ExitDate" value="<?php echo HtmlEncode($staffexperience_list->ExitDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_list->ReasonForExit->Visible) { // ReasonForExit ?>
		<td data-name="ReasonForExit">
<span id="el$rowindex$_staffexperience_ReasonForExit" class="form-group staffexperience_ReasonForExit">
<?php $staffexperience_list->ReasonForExit->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_ReasonForExit" data-value-separator="<?php echo $staffexperience_list->ReasonForExit->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit" name="x<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit"<?php echo $staffexperience_list->ReasonForExit->editAttributes() ?>>
			<?php echo $staffexperience_list->ReasonForExit->selectOptionListHtml("x{$staffexperience_list->RowIndex}_ReasonForExit") ?>
		</select>
</div>
<?php echo $staffexperience_list->ReasonForExit->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_ReasonForExit") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_ReasonForExit" name="o<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit" id="o<?php echo $staffexperience_list->RowIndex ?>_ReasonForExit" value="<?php echo HtmlEncode($staffexperience_list->ReasonForExit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffexperience_list->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType">
<span id="el$rowindex$_staffexperience_RetirementType" class="form-group staffexperience_RetirementType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffexperience" data-field="x_RetirementType" data-value-separator="<?php echo $staffexperience_list->RetirementType->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffexperience_list->RowIndex ?>_RetirementType" name="x<?php echo $staffexperience_list->RowIndex ?>_RetirementType"<?php echo $staffexperience_list->RetirementType->editAttributes() ?>>
			<?php echo $staffexperience_list->RetirementType->selectOptionListHtml("x{$staffexperience_list->RowIndex}_RetirementType") ?>
		</select>
</div>
<?php echo $staffexperience_list->RetirementType->Lookup->getParamTag($staffexperience_list, "p_x" . $staffexperience_list->RowIndex . "_RetirementType") ?>
</span>
<input type="hidden" data-table="staffexperience" data-field="x_RetirementType" name="o<?php echo $staffexperience_list->RowIndex ?>_RetirementType" id="o<?php echo $staffexperience_list->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($staffexperience_list->RetirementType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffexperience_list->ListOptions->render("body", "right", $staffexperience_list->RowIndex);
?>
<script>
loadjs.ready(["fstaffexperiencelist", "load"], function() {
	fstaffexperiencelist.updateLists(<?php echo $staffexperience_list->RowIndex ?>);
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
<?php if ($staffexperience_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $staffexperience_list->FormKeyCountName ?>" id="<?php echo $staffexperience_list->FormKeyCountName ?>" value="<?php echo $staffexperience_list->KeyCount ?>">
<?php echo $staffexperience_list->MultiSelectKey ?>
<?php } ?>
<?php if ($staffexperience_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $staffexperience_list->FormKeyCountName ?>" id="<?php echo $staffexperience_list->FormKeyCountName ?>" value="<?php echo $staffexperience_list->KeyCount ?>">
<?php echo $staffexperience_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$staffexperience->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffexperience_list->Recordset)
	$staffexperience_list->Recordset->Close();
?>
<?php if (!$staffexperience_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staffexperience_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffexperience_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffexperience_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffexperience_list->TotalRecords == 0 && !$staffexperience->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffexperience_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staffexperience_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffexperience_list->isExport()) { ?>
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
$staffexperience_list->terminate();
?>