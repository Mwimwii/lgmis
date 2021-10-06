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
$job_list = new job_list();

// Run the page
$job_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$job_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$job_list->isExport()) { ?>
<script>
var fjoblist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjoblist = currentForm = new ew.Form("fjoblist", "list");
	fjoblist.formKeyCountName = '<?php echo $job_list->FormKeyCountName ?>';

	// Validate form
	fjoblist.validate = function() {
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
			<?php if ($job_list->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_list->JobCode->caption(), $job_list->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_list->JobName->Required) { ?>
				elm = this.getElements("x" + infix + "_JobName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_list->JobName->caption(), $job_list->JobName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_list->JobGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_list->JobGroupCode->caption(), $job_list->JobGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_list->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_list->Division->caption(), $job_list->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($job_list->Division->errorMessage()) ?>");
			<?php if ($job_list->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_list->CouncilType->caption(), $job_list->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_list->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_list->SalaryScale->caption(), $job_list->SalaryScale->RequiredErrorMessage)) ?>");
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
	fjoblist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "JobName", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Division", false)) return false;
		if (ew.valueChanged(fobj, infix, "CouncilType", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fjoblist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjoblist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjoblist.lists["x_JobGroupCode"] = <?php echo $job_list->JobGroupCode->Lookup->toClientList($job_list) ?>;
	fjoblist.lists["x_JobGroupCode"].options = <?php echo JsonEncode($job_list->JobGroupCode->lookupOptions()) ?>;
	fjoblist.lists["x_CouncilType"] = <?php echo $job_list->CouncilType->Lookup->toClientList($job_list) ?>;
	fjoblist.lists["x_CouncilType"].options = <?php echo JsonEncode($job_list->CouncilType->lookupOptions()) ?>;
	fjoblist.lists["x_SalaryScale"] = <?php echo $job_list->SalaryScale->Lookup->toClientList($job_list) ?>;
	fjoblist.lists["x_SalaryScale"].options = <?php echo JsonEncode($job_list->SalaryScale->lookupOptions()) ?>;
	loadjs.done("fjoblist");
});
var fjoblistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjoblistsrch = currentSearchForm = new ew.Form("fjoblistsrch");

	// Validate function for search
	fjoblistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_JobCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($job_list->JobCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Division");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($job_list->Division->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fjoblistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjoblistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fjoblistsrch.lists["x_CouncilType"] = <?php echo $job_list->CouncilType->Lookup->toClientList($job_list) ?>;
	fjoblistsrch.lists["x_CouncilType"].options = <?php echo JsonEncode($job_list->CouncilType->lookupOptions()) ?>;
	fjoblistsrch.lists["x_SalaryScale"] = <?php echo $job_list->SalaryScale->Lookup->toClientList($job_list) ?>;
	fjoblistsrch.lists["x_SalaryScale"].options = <?php echo JsonEncode($job_list->SalaryScale->lookupOptions()) ?>;

	// Filters
	fjoblistsrch.filterList = <?php echo $job_list->getFilterList() ?>;

	// Init search panel as collapsed
	fjoblistsrch.initSearchPanel = true;
	loadjs.done("fjoblistsrch");
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
<?php if (!$job_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($job_list->TotalRecords > 0 && $job_list->ExportOptions->visible()) { ?>
<?php $job_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($job_list->ImportOptions->visible()) { ?>
<?php $job_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($job_list->SearchOptions->visible()) { ?>
<?php $job_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($job_list->FilterOptions->visible()) { ?>
<?php $job_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$job_list->isExport() || Config("EXPORT_MASTER_RECORD") && $job_list->isExport("print")) { ?>
<?php
if ($job_list->DbMasterFilter != "" && $job->getCurrentMasterTable() == "job_group") {
	if ($job_list->MasterRecordExists) {
		include_once "job_groupmaster.php";
	}
}
?>
<?php
if ($job_list->DbMasterFilter != "" && $job->getCurrentMasterTable() == "division") {
	if ($job_list->MasterRecordExists) {
		include_once "divisionmaster.php";
	}
}
?>
<?php } ?>
<?php
$job_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$job_list->isExport() && !$job->CurrentAction) { ?>
<form name="fjoblistsrch" id="fjoblistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjoblistsrch-search-panel" class="<?php echo $job_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="job">
	<div class="ew-extended-search">
<?php

// Render search row
$job->RowType = ROWTYPE_SEARCH;
$job->resetAttributes();
$job_list->renderRow();
?>
<?php if ($job_list->JobCode->Visible) { // JobCode ?>
	<?php
		$job_list->SearchColumnCount++;
		if (($job_list->SearchColumnCount - 1) % $job_list->SearchFieldsPerRow == 0) {
			$job_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $job_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_JobCode" class="ew-cell form-group">
		<label for="x_JobCode" class="ew-search-caption ew-label"><?php echo $job_list->JobCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_JobCode" id="z_JobCode" value="=">
</span>
		<span id="el_job_JobCode" class="ew-search-field">
<input type="text" data-table="job" data-field="x_JobCode" name="x_JobCode" id="x_JobCode" placeholder="<?php echo HtmlEncode($job_list->JobCode->getPlaceHolder()) ?>" value="<?php echo $job_list->JobCode->EditValue ?>"<?php echo $job_list->JobCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($job_list->SearchColumnCount % $job_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($job_list->JobName->Visible) { // JobName ?>
	<?php
		$job_list->SearchColumnCount++;
		if (($job_list->SearchColumnCount - 1) % $job_list->SearchFieldsPerRow == 0) {
			$job_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $job_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_JobName" class="ew-cell form-group">
		<label for="x_JobName" class="ew-search-caption ew-label"><?php echo $job_list->JobName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_JobName" id="z_JobName" value="LIKE">
</span>
		<span id="el_job_JobName" class="ew-search-field">
<input type="text" data-table="job" data-field="x_JobName" name="x_JobName" id="x_JobName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_list->JobName->getPlaceHolder()) ?>" value="<?php echo $job_list->JobName->EditValue ?>"<?php echo $job_list->JobName->editAttributes() ?>>
</span>
	</div>
	<?php if ($job_list->SearchColumnCount % $job_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($job_list->Division->Visible) { // Division ?>
	<?php
		$job_list->SearchColumnCount++;
		if (($job_list->SearchColumnCount - 1) % $job_list->SearchFieldsPerRow == 0) {
			$job_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $job_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Division" class="ew-cell form-group">
		<label for="x_Division" class="ew-search-caption ew-label"><?php echo $job_list->Division->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Division" id="z_Division" value="=">
</span>
		<span id="el_job_Division" class="ew-search-field">
<input type="text" data-table="job" data-field="x_Division" name="x_Division" id="x_Division" size="30" placeholder="<?php echo HtmlEncode($job_list->Division->getPlaceHolder()) ?>" value="<?php echo $job_list->Division->EditValue ?>"<?php echo $job_list->Division->editAttributes() ?>>
</span>
	</div>
	<?php if ($job_list->SearchColumnCount % $job_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($job_list->CouncilType->Visible) { // CouncilType ?>
	<?php
		$job_list->SearchColumnCount++;
		if (($job_list->SearchColumnCount - 1) % $job_list->SearchFieldsPerRow == 0) {
			$job_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $job_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_CouncilType" class="ew-cell form-group">
		<label for="x_CouncilType" class="ew-search-caption ew-label"><?php echo $job_list->CouncilType->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CouncilType" id="z_CouncilType" value="=">
</span>
		<span id="el_job_CouncilType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_CouncilType" data-value-separator="<?php echo $job_list->CouncilType->displayValueSeparatorAttribute() ?>" id="x_CouncilType" name="x_CouncilType"<?php echo $job_list->CouncilType->editAttributes() ?>>
			<?php echo $job_list->CouncilType->selectOptionListHtml("x_CouncilType") ?>
		</select>
</div>
<?php echo $job_list->CouncilType->Lookup->getParamTag($job_list, "p_x_CouncilType") ?>
</span>
	</div>
	<?php if ($job_list->SearchColumnCount % $job_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($job_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php
		$job_list->SearchColumnCount++;
		if (($job_list->SearchColumnCount - 1) % $job_list->SearchFieldsPerRow == 0) {
			$job_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $job_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_SalaryScale" class="ew-cell form-group">
		<label for="x_SalaryScale" class="ew-search-caption ew-label"><?php echo $job_list->SalaryScale->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		<span id="el_job_SalaryScale" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_SalaryScale" data-value-separator="<?php echo $job_list->SalaryScale->displayValueSeparatorAttribute() ?>" id="x_SalaryScale" name="x_SalaryScale"<?php echo $job_list->SalaryScale->editAttributes() ?>>
			<?php echo $job_list->SalaryScale->selectOptionListHtml("x_SalaryScale") ?>
		</select>
</div>
<?php echo $job_list->SalaryScale->Lookup->getParamTag($job_list, "p_x_SalaryScale") ?>
</span>
	</div>
	<?php if ($job_list->SearchColumnCount % $job_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($job_list->SearchColumnCount % $job_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $job_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($job_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($job_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $job_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($job_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($job_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($job_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($job_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $job_list->showPageHeader(); ?>
<?php
$job_list->showMessage();
?>
<?php if ($job_list->TotalRecords > 0 || $job->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($job_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> job">
<?php if (!$job_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$job_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $job_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $job_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjoblist" id="fjoblist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="job">
<?php if ($job->getCurrentMasterTable() == "job_group" && $job->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="job_group">
<input type="hidden" name="fk_JobGroupCode" value="<?php echo HtmlEncode($job_list->JobGroupCode->getSessionValue()) ?>">
<?php } ?>
<?php if ($job->getCurrentMasterTable() == "division" && $job->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="division">
<input type="hidden" name="fk_Division" value="<?php echo HtmlEncode($job_list->Division->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_job" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($job_list->TotalRecords > 0 || $job_list->isGridEdit()) { ?>
<table id="tbl_joblist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$job->RowType = ROWTYPE_HEADER;

// Render list options
$job_list->renderListOptions();

// Render list options (header, left)
$job_list->ListOptions->render("header", "left");
?>
<?php if ($job_list->JobCode->Visible) { // JobCode ?>
	<?php if ($job_list->SortUrl($job_list->JobCode) == "") { ?>
		<th data-name="JobCode" class="<?php echo $job_list->JobCode->headerCellClass() ?>"><div id="elh_job_JobCode" class="job_JobCode"><div class="ew-table-header-caption"><?php echo $job_list->JobCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobCode" class="<?php echo $job_list->JobCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_list->SortUrl($job_list->JobCode) ?>', 1);"><div id="elh_job_JobCode" class="job_JobCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_list->JobCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_list->JobCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_list->JobCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_list->JobName->Visible) { // JobName ?>
	<?php if ($job_list->SortUrl($job_list->JobName) == "") { ?>
		<th data-name="JobName" class="<?php echo $job_list->JobName->headerCellClass() ?>"><div id="elh_job_JobName" class="job_JobName"><div class="ew-table-header-caption"><?php echo $job_list->JobName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobName" class="<?php echo $job_list->JobName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_list->SortUrl($job_list->JobName) ?>', 1);"><div id="elh_job_JobName" class="job_JobName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_list->JobName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($job_list->JobName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_list->JobName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_list->JobGroupCode->Visible) { // JobGroupCode ?>
	<?php if ($job_list->SortUrl($job_list->JobGroupCode) == "") { ?>
		<th data-name="JobGroupCode" class="<?php echo $job_list->JobGroupCode->headerCellClass() ?>"><div id="elh_job_JobGroupCode" class="job_JobGroupCode"><div class="ew-table-header-caption"><?php echo $job_list->JobGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobGroupCode" class="<?php echo $job_list->JobGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_list->SortUrl($job_list->JobGroupCode) ?>', 1);"><div id="elh_job_JobGroupCode" class="job_JobGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_list->JobGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_list->JobGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_list->JobGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_list->Division->Visible) { // Division ?>
	<?php if ($job_list->SortUrl($job_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $job_list->Division->headerCellClass() ?>"><div id="elh_job_Division" class="job_Division"><div class="ew-table-header-caption"><?php echo $job_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $job_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_list->SortUrl($job_list->Division) ?>', 1);"><div id="elh_job_Division" class="job_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_list->CouncilType->Visible) { // CouncilType ?>
	<?php if ($job_list->SortUrl($job_list->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $job_list->CouncilType->headerCellClass() ?>"><div id="elh_job_CouncilType" class="job_CouncilType"><div class="ew-table-header-caption"><?php echo $job_list->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $job_list->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_list->SortUrl($job_list->CouncilType) ?>', 1);"><div id="elh_job_CouncilType" class="job_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_list->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_list->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_list->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($job_list->SortUrl($job_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $job_list->SalaryScale->headerCellClass() ?>"><div id="elh_job_SalaryScale" class="job_SalaryScale"><div class="ew-table-header-caption"><?php echo $job_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $job_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_list->SortUrl($job_list->SalaryScale) ?>', 1);"><div id="elh_job_SalaryScale" class="job_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_list->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$job_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($job_list->ExportAll && $job_list->isExport()) {
	$job_list->StopRecord = $job_list->TotalRecords;
} else {

	// Set the last record to display
	if ($job_list->TotalRecords > $job_list->StartRecord + $job_list->DisplayRecords - 1)
		$job_list->StopRecord = $job_list->StartRecord + $job_list->DisplayRecords - 1;
	else
		$job_list->StopRecord = $job_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($job->isConfirm() || $job_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($job_list->FormKeyCountName) && ($job_list->isGridAdd() || $job_list->isGridEdit() || $job->isConfirm())) {
		$job_list->KeyCount = $CurrentForm->getValue($job_list->FormKeyCountName);
		$job_list->StopRecord = $job_list->StartRecord + $job_list->KeyCount - 1;
	}
}
$job_list->RecordCount = $job_list->StartRecord - 1;
if ($job_list->Recordset && !$job_list->Recordset->EOF) {
	$job_list->Recordset->moveFirst();
	$selectLimit = $job_list->UseSelectLimit;
	if (!$selectLimit && $job_list->StartRecord > 1)
		$job_list->Recordset->move($job_list->StartRecord - 1);
} elseif (!$job->AllowAddDeleteRow && $job_list->StopRecord == 0) {
	$job_list->StopRecord = $job->GridAddRowCount;
}

// Initialize aggregate
$job->RowType = ROWTYPE_AGGREGATEINIT;
$job->resetAttributes();
$job_list->renderRow();
if ($job_list->isGridAdd())
	$job_list->RowIndex = 0;
if ($job_list->isGridEdit())
	$job_list->RowIndex = 0;
while ($job_list->RecordCount < $job_list->StopRecord) {
	$job_list->RecordCount++;
	if ($job_list->RecordCount >= $job_list->StartRecord) {
		$job_list->RowCount++;
		if ($job_list->isGridAdd() || $job_list->isGridEdit() || $job->isConfirm()) {
			$job_list->RowIndex++;
			$CurrentForm->Index = $job_list->RowIndex;
			if ($CurrentForm->hasValue($job_list->FormActionName) && ($job->isConfirm() || $job_list->EventCancelled))
				$job_list->RowAction = strval($CurrentForm->getValue($job_list->FormActionName));
			elseif ($job_list->isGridAdd())
				$job_list->RowAction = "insert";
			else
				$job_list->RowAction = "";
		}

		// Set up key count
		$job_list->KeyCount = $job_list->RowIndex;

		// Init row class and style
		$job->resetAttributes();
		$job->CssClass = "";
		if ($job_list->isGridAdd()) {
			$job_list->loadRowValues(); // Load default values
		} else {
			$job_list->loadRowValues($job_list->Recordset); // Load row values
		}
		$job->RowType = ROWTYPE_VIEW; // Render view
		if ($job_list->isGridAdd()) // Grid add
			$job->RowType = ROWTYPE_ADD; // Render add
		if ($job_list->isGridAdd() && $job->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$job_list->restoreCurrentRowFormValues($job_list->RowIndex); // Restore form values
		if ($job_list->isGridEdit()) { // Grid edit
			if ($job->EventCancelled)
				$job_list->restoreCurrentRowFormValues($job_list->RowIndex); // Restore form values
			if ($job_list->RowAction == "insert")
				$job->RowType = ROWTYPE_ADD; // Render add
			else
				$job->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($job_list->isGridEdit() && ($job->RowType == ROWTYPE_EDIT || $job->RowType == ROWTYPE_ADD) && $job->EventCancelled) // Update failed
			$job_list->restoreCurrentRowFormValues($job_list->RowIndex); // Restore form values
		if ($job->RowType == ROWTYPE_EDIT) // Edit row
			$job_list->EditRowCount++;

		// Set up row id / data-rowindex
		$job->RowAttrs->merge(["data-rowindex" => $job_list->RowCount, "id" => "r" . $job_list->RowCount . "_job", "data-rowtype" => $job->RowType]);

		// Render row
		$job_list->renderRow();

		// Render list options
		$job_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($job_list->RowAction != "delete" && $job_list->RowAction != "insertdelete" && !($job_list->RowAction == "insert" && $job->isConfirm() && $job_list->emptyRow())) {
?>
	<tr <?php echo $job->rowAttributes() ?>>
<?php

// Render list options (body, left)
$job_list->ListOptions->render("body", "left", $job_list->RowCount);
?>
	<?php if ($job_list->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode" <?php echo $job_list->JobCode->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobCode" class="form-group"></span>
<input type="hidden" data-table="job" data-field="x_JobCode" name="o<?php echo $job_list->RowIndex ?>_JobCode" id="o<?php echo $job_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_list->JobCode->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobCode" class="form-group">
<span<?php echo $job_list->JobCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_list->JobCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="job" data-field="x_JobCode" name="x<?php echo $job_list->RowIndex ?>_JobCode" id="x<?php echo $job_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_list->JobCode->CurrentValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobCode">
<span<?php echo $job_list->JobCode->viewAttributes() ?>><?php echo $job_list->JobCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_list->JobName->Visible) { // JobName ?>
		<td data-name="JobName" <?php echo $job_list->JobName->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobName" class="form-group">
<input type="text" data-table="job" data-field="x_JobName" name="x<?php echo $job_list->RowIndex ?>_JobName" id="x<?php echo $job_list->RowIndex ?>_JobName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_list->JobName->getPlaceHolder()) ?>" value="<?php echo $job_list->JobName->EditValue ?>"<?php echo $job_list->JobName->editAttributes() ?>>
</span>
<input type="hidden" data-table="job" data-field="x_JobName" name="o<?php echo $job_list->RowIndex ?>_JobName" id="o<?php echo $job_list->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_list->JobName->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobName" class="form-group">
<input type="text" data-table="job" data-field="x_JobName" name="x<?php echo $job_list->RowIndex ?>_JobName" id="x<?php echo $job_list->RowIndex ?>_JobName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_list->JobName->getPlaceHolder()) ?>" value="<?php echo $job_list->JobName->EditValue ?>"<?php echo $job_list->JobName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobName">
<span<?php echo $job_list->JobName->viewAttributes() ?>><?php echo $job_list->JobName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_list->JobGroupCode->Visible) { // JobGroupCode ?>
		<td data-name="JobGroupCode" <?php echo $job_list->JobGroupCode->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($job_list->JobGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobGroupCode" class="form-group">
<span<?php echo $job_list->JobGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_list->JobGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_list->RowIndex ?>_JobGroupCode" name="x<?php echo $job_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_list->JobGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobGroupCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_JobGroupCode" data-value-separator="<?php echo $job_list->JobGroupCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_JobGroupCode" name="x<?php echo $job_list->RowIndex ?>_JobGroupCode"<?php echo $job_list->JobGroupCode->editAttributes() ?>>
			<?php echo $job_list->JobGroupCode->selectOptionListHtml("x{$job_list->RowIndex}_JobGroupCode") ?>
		</select>
</div>
<?php echo $job_list->JobGroupCode->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_JobGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="o<?php echo $job_list->RowIndex ?>_JobGroupCode" id="o<?php echo $job_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_list->JobGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($job_list->JobGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobGroupCode" class="form-group">
<span<?php echo $job_list->JobGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_list->JobGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_list->RowIndex ?>_JobGroupCode" name="x<?php echo $job_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_list->JobGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobGroupCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_JobGroupCode" data-value-separator="<?php echo $job_list->JobGroupCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_JobGroupCode" name="x<?php echo $job_list->RowIndex ?>_JobGroupCode"<?php echo $job_list->JobGroupCode->editAttributes() ?>>
			<?php echo $job_list->JobGroupCode->selectOptionListHtml("x{$job_list->RowIndex}_JobGroupCode") ?>
		</select>
</div>
<?php echo $job_list->JobGroupCode->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_JobGroupCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_JobGroupCode">
<span<?php echo $job_list->JobGroupCode->viewAttributes() ?>><?php echo $job_list->JobGroupCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $job_list->Division->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($job_list->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_Division" class="form-group">
<span<?php echo $job_list->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_list->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_list->RowIndex ?>_Division" name="x<?php echo $job_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_list->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_Division" class="form-group">
<input type="text" data-table="job" data-field="x_Division" name="x<?php echo $job_list->RowIndex ?>_Division" id="x<?php echo $job_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($job_list->Division->getPlaceHolder()) ?>" value="<?php echo $job_list->Division->EditValue ?>"<?php echo $job_list->Division->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="job" data-field="x_Division" name="o<?php echo $job_list->RowIndex ?>_Division" id="o<?php echo $job_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_list->Division->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($job_list->Division->getSessionValue() != "") { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_Division" class="form-group">
<span<?php echo $job_list->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_list->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_list->RowIndex ?>_Division" name="x<?php echo $job_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_list->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $job_list->RowCount ?>_job_Division" class="form-group">
<input type="text" data-table="job" data-field="x_Division" name="x<?php echo $job_list->RowIndex ?>_Division" id="x<?php echo $job_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($job_list->Division->getPlaceHolder()) ?>" value="<?php echo $job_list->Division->EditValue ?>"<?php echo $job_list->Division->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_Division">
<span<?php echo $job_list->Division->viewAttributes() ?>><?php echo $job_list->Division->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $job_list->CouncilType->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_CouncilType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_CouncilType" data-value-separator="<?php echo $job_list->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_CouncilType" name="x<?php echo $job_list->RowIndex ?>_CouncilType"<?php echo $job_list->CouncilType->editAttributes() ?>>
			<?php echo $job_list->CouncilType->selectOptionListHtml("x{$job_list->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $job_list->CouncilType->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_CouncilType") ?>
</span>
<input type="hidden" data-table="job" data-field="x_CouncilType" name="o<?php echo $job_list->RowIndex ?>_CouncilType" id="o<?php echo $job_list->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_list->CouncilType->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_CouncilType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_CouncilType" data-value-separator="<?php echo $job_list->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_CouncilType" name="x<?php echo $job_list->RowIndex ?>_CouncilType"<?php echo $job_list->CouncilType->editAttributes() ?>>
			<?php echo $job_list->CouncilType->selectOptionListHtml("x{$job_list->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $job_list->CouncilType->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_CouncilType") ?>
</span>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_CouncilType">
<span<?php echo $job_list->CouncilType->viewAttributes() ?>><?php echo $job_list->CouncilType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $job_list->SalaryScale->cellAttributes() ?>>
<?php if ($job->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_SalaryScale" data-value-separator="<?php echo $job_list->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_SalaryScale" name="x<?php echo $job_list->RowIndex ?>_SalaryScale"<?php echo $job_list->SalaryScale->editAttributes() ?>>
			<?php echo $job_list->SalaryScale->selectOptionListHtml("x{$job_list->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $job_list->SalaryScale->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_SalaryScale") ?>
</span>
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="o<?php echo $job_list->RowIndex ?>_SalaryScale" id="o<?php echo $job_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_list->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($job->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_SalaryScale" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_SalaryScale" data-value-separator="<?php echo $job_list->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_SalaryScale" name="x<?php echo $job_list->RowIndex ?>_SalaryScale"<?php echo $job_list->SalaryScale->editAttributes() ?>>
			<?php echo $job_list->SalaryScale->selectOptionListHtml("x{$job_list->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $job_list->SalaryScale->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_SalaryScale") ?>
</span>
<?php } ?>
<?php if ($job->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_list->RowCount ?>_job_SalaryScale">
<span<?php echo $job_list->SalaryScale->viewAttributes() ?>><?php echo $job_list->SalaryScale->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$job_list->ListOptions->render("body", "right", $job_list->RowCount);
?>
	</tr>
<?php if ($job->RowType == ROWTYPE_ADD || $job->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fjoblist", "load"], function() {
	fjoblist.updateLists(<?php echo $job_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$job_list->isGridAdd())
		if (!$job_list->Recordset->EOF)
			$job_list->Recordset->moveNext();
}
?>
<?php
	if ($job_list->isGridAdd() || $job_list->isGridEdit()) {
		$job_list->RowIndex = '$rowindex$';
		$job_list->loadRowValues();

		// Set row properties
		$job->resetAttributes();
		$job->RowAttrs->merge(["data-rowindex" => $job_list->RowIndex, "id" => "r0_job", "data-rowtype" => ROWTYPE_ADD]);
		$job->RowAttrs->appendClass("ew-template");
		$job->RowType = ROWTYPE_ADD;

		// Render row
		$job_list->renderRow();

		// Render list options
		$job_list->renderListOptions();
		$job_list->StartRowCount = 0;
?>
	<tr <?php echo $job->rowAttributes() ?>>
<?php

// Render list options (body, left)
$job_list->ListOptions->render("body", "left", $job_list->RowIndex);
?>
	<?php if ($job_list->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode">
<span id="el$rowindex$_job_JobCode" class="form-group job_JobCode"></span>
<input type="hidden" data-table="job" data-field="x_JobCode" name="o<?php echo $job_list->RowIndex ?>_JobCode" id="o<?php echo $job_list->RowIndex ?>_JobCode" value="<?php echo HtmlEncode($job_list->JobCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_list->JobName->Visible) { // JobName ?>
		<td data-name="JobName">
<span id="el$rowindex$_job_JobName" class="form-group job_JobName">
<input type="text" data-table="job" data-field="x_JobName" name="x<?php echo $job_list->RowIndex ?>_JobName" id="x<?php echo $job_list->RowIndex ?>_JobName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_list->JobName->getPlaceHolder()) ?>" value="<?php echo $job_list->JobName->EditValue ?>"<?php echo $job_list->JobName->editAttributes() ?>>
</span>
<input type="hidden" data-table="job" data-field="x_JobName" name="o<?php echo $job_list->RowIndex ?>_JobName" id="o<?php echo $job_list->RowIndex ?>_JobName" value="<?php echo HtmlEncode($job_list->JobName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_list->JobGroupCode->Visible) { // JobGroupCode ?>
		<td data-name="JobGroupCode">
<?php if ($job_list->JobGroupCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_job_JobGroupCode" class="form-group job_JobGroupCode">
<span<?php echo $job_list->JobGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_list->JobGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_list->RowIndex ?>_JobGroupCode" name="x<?php echo $job_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_list->JobGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_job_JobGroupCode" class="form-group job_JobGroupCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_JobGroupCode" data-value-separator="<?php echo $job_list->JobGroupCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_JobGroupCode" name="x<?php echo $job_list->RowIndex ?>_JobGroupCode"<?php echo $job_list->JobGroupCode->editAttributes() ?>>
			<?php echo $job_list->JobGroupCode->selectOptionListHtml("x{$job_list->RowIndex}_JobGroupCode") ?>
		</select>
</div>
<?php echo $job_list->JobGroupCode->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_JobGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="job" data-field="x_JobGroupCode" name="o<?php echo $job_list->RowIndex ?>_JobGroupCode" id="o<?php echo $job_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_list->JobGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_list->Division->Visible) { // Division ?>
		<td data-name="Division">
<?php if ($job_list->Division->getSessionValue() != "") { ?>
<span id="el$rowindex$_job_Division" class="form-group job_Division">
<span<?php echo $job_list->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($job_list->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $job_list->RowIndex ?>_Division" name="x<?php echo $job_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_list->Division->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_job_Division" class="form-group job_Division">
<input type="text" data-table="job" data-field="x_Division" name="x<?php echo $job_list->RowIndex ?>_Division" id="x<?php echo $job_list->RowIndex ?>_Division" size="30" placeholder="<?php echo HtmlEncode($job_list->Division->getPlaceHolder()) ?>" value="<?php echo $job_list->Division->EditValue ?>"<?php echo $job_list->Division->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="job" data-field="x_Division" name="o<?php echo $job_list->RowIndex ?>_Division" id="o<?php echo $job_list->RowIndex ?>_Division" value="<?php echo HtmlEncode($job_list->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType">
<span id="el$rowindex$_job_CouncilType" class="form-group job_CouncilType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_CouncilType" data-value-separator="<?php echo $job_list->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_CouncilType" name="x<?php echo $job_list->RowIndex ?>_CouncilType"<?php echo $job_list->CouncilType->editAttributes() ?>>
			<?php echo $job_list->CouncilType->selectOptionListHtml("x{$job_list->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $job_list->CouncilType->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_CouncilType") ?>
</span>
<input type="hidden" data-table="job" data-field="x_CouncilType" name="o<?php echo $job_list->RowIndex ?>_CouncilType" id="o<?php echo $job_list->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($job_list->CouncilType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<span id="el$rowindex$_job_SalaryScale" class="form-group job_SalaryScale">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="job" data-field="x_SalaryScale" data-value-separator="<?php echo $job_list->SalaryScale->displayValueSeparatorAttribute() ?>" id="x<?php echo $job_list->RowIndex ?>_SalaryScale" name="x<?php echo $job_list->RowIndex ?>_SalaryScale"<?php echo $job_list->SalaryScale->editAttributes() ?>>
			<?php echo $job_list->SalaryScale->selectOptionListHtml("x{$job_list->RowIndex}_SalaryScale") ?>
		</select>
</div>
<?php echo $job_list->SalaryScale->Lookup->getParamTag($job_list, "p_x" . $job_list->RowIndex . "_SalaryScale") ?>
</span>
<input type="hidden" data-table="job" data-field="x_SalaryScale" name="o<?php echo $job_list->RowIndex ?>_SalaryScale" id="o<?php echo $job_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($job_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$job_list->ListOptions->render("body", "right", $job_list->RowIndex);
?>
<script>
loadjs.ready(["fjoblist", "load"], function() {
	fjoblist.updateLists(<?php echo $job_list->RowIndex ?>);
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
<?php if ($job_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $job_list->FormKeyCountName ?>" id="<?php echo $job_list->FormKeyCountName ?>" value="<?php echo $job_list->KeyCount ?>">
<?php echo $job_list->MultiSelectKey ?>
<?php } ?>
<?php if ($job_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $job_list->FormKeyCountName ?>" id="<?php echo $job_list->FormKeyCountName ?>" value="<?php echo $job_list->KeyCount ?>">
<?php echo $job_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$job->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($job_list->Recordset)
	$job_list->Recordset->Close();
?>
<?php if (!$job_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$job_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $job_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $job_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($job_list->TotalRecords == 0 && !$job->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $job_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$job_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$job_list->isExport()) { ?>
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
$job_list->terminate();
?>