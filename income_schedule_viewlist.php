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
$income_schedule_view_list = new income_schedule_view_list();

// Run the page
$income_schedule_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_schedule_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$income_schedule_view_list->isExport()) { ?>
<script>
var fincome_schedule_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fincome_schedule_viewlist = currentForm = new ew.Form("fincome_schedule_viewlist", "list");
	fincome_schedule_viewlist.formKeyCountName = '<?php echo $income_schedule_view_list->FormKeyCountName ?>';
	loadjs.done("fincome_schedule_viewlist");
});
var fincome_schedule_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fincome_schedule_viewlistsrch = currentSearchForm = new ew.Form("fincome_schedule_viewlistsrch");

	// Validate function for search
	fincome_schedule_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fincome_schedule_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fincome_schedule_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	fincome_schedule_viewlistsrch.filterList = <?php echo $income_schedule_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fincome_schedule_viewlistsrch.initSearchPanel = true;
	loadjs.done("fincome_schedule_viewlistsrch");
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
<?php if (!$income_schedule_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($income_schedule_view_list->TotalRecords > 0 && $income_schedule_view_list->ExportOptions->visible()) { ?>
<?php $income_schedule_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($income_schedule_view_list->ImportOptions->visible()) { ?>
<?php $income_schedule_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($income_schedule_view_list->SearchOptions->visible()) { ?>
<?php $income_schedule_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($income_schedule_view_list->FilterOptions->visible()) { ?>
<?php $income_schedule_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$income_schedule_view_list->isExport() || Config("EXPORT_MASTER_RECORD") && $income_schedule_view_list->isExport("print")) { ?>
<?php
if ($income_schedule_view_list->DbMasterFilter != "" && $income_schedule_view->getCurrentMasterTable() == "payroll_period") {
	if ($income_schedule_view_list->MasterRecordExists) {
		include_once "payroll_periodmaster.php";
	}
}
?>
<?php } ?>
<?php
$income_schedule_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$income_schedule_view_list->isExport() && !$income_schedule_view->CurrentAction) { ?>
<form name="fincome_schedule_viewlistsrch" id="fincome_schedule_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fincome_schedule_viewlistsrch-search-panel" class="<?php echo $income_schedule_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="income_schedule_view">
	<div class="ew-extended-search">
<?php

// Render search row
$income_schedule_view->RowType = ROWTYPE_SEARCH;
$income_schedule_view->resetAttributes();
$income_schedule_view_list->renderRow();
?>
<?php if ($income_schedule_view_list->LAName->Visible) { // LAName ?>
	<?php
		$income_schedule_view_list->SearchColumnCount++;
		if (($income_schedule_view_list->SearchColumnCount - 1) % $income_schedule_view_list->SearchFieldsPerRow == 0) {
			$income_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $income_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LAName" class="ew-cell form-group">
		<label for="x_LAName" class="ew-search-caption ew-label"><?php echo $income_schedule_view_list->LAName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		<span id="el_income_schedule_view_LAName" class="ew-search-field">
<input type="text" data-table="income_schedule_view" data-field="x_LAName" name="x_LAName" id="x_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($income_schedule_view_list->LAName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_list->LAName->EditValue ?>"<?php echo $income_schedule_view_list->LAName->editAttributes() ?>>
</span>
	</div>
	<?php if ($income_schedule_view_list->SearchColumnCount % $income_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->NRC->Visible) { // NRC ?>
	<?php
		$income_schedule_view_list->SearchColumnCount++;
		if (($income_schedule_view_list->SearchColumnCount - 1) % $income_schedule_view_list->SearchFieldsPerRow == 0) {
			$income_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $income_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_NRC" class="ew-cell form-group">
		<label for="x_NRC" class="ew-search-caption ew-label"><?php echo $income_schedule_view_list->NRC->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		<span id="el_income_schedule_view_NRC" class="ew-search-field">
<input type="text" data-table="income_schedule_view" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($income_schedule_view_list->NRC->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_list->NRC->EditValue ?>"<?php echo $income_schedule_view_list->NRC->editAttributes() ?>>
</span>
	</div>
	<?php if ($income_schedule_view_list->SearchColumnCount % $income_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php
		$income_schedule_view_list->SearchColumnCount++;
		if (($income_schedule_view_list->SearchColumnCount - 1) % $income_schedule_view_list->SearchFieldsPerRow == 0) {
			$income_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $income_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $income_schedule_view_list->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_income_schedule_view_Surname" class="ew-search-field">
<input type="text" data-table="income_schedule_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_list->Surname->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_list->Surname->EditValue ?>"<?php echo $income_schedule_view_list->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($income_schedule_view_list->SearchColumnCount % $income_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php
		$income_schedule_view_list->SearchColumnCount++;
		if (($income_schedule_view_list->SearchColumnCount - 1) % $income_schedule_view_list->SearchFieldsPerRow == 0) {
			$income_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $income_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_FirstName" class="ew-cell form-group">
		<label for="x_FirstName" class="ew-search-caption ew-label"><?php echo $income_schedule_view_list->FirstName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		<span id="el_income_schedule_view_FirstName" class="ew-search-field">
<input type="text" data-table="income_schedule_view" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($income_schedule_view_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_list->FirstName->EditValue ?>"<?php echo $income_schedule_view_list->FirstName->editAttributes() ?>>
</span>
	</div>
	<?php if ($income_schedule_view_list->SearchColumnCount % $income_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php
		$income_schedule_view_list->SearchColumnCount++;
		if (($income_schedule_view_list->SearchColumnCount - 1) % $income_schedule_view_list->SearchFieldsPerRow == 0) {
			$income_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $income_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $income_schedule_view_list->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_income_schedule_view_PositionName" class="ew-search-field">
<input type="text" data-table="income_schedule_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_schedule_view_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $income_schedule_view_list->PositionName->EditValue ?>"<?php echo $income_schedule_view_list->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($income_schedule_view_list->SearchColumnCount % $income_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($income_schedule_view_list->SearchColumnCount % $income_schedule_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $income_schedule_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($income_schedule_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($income_schedule_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $income_schedule_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($income_schedule_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($income_schedule_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($income_schedule_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($income_schedule_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $income_schedule_view_list->showPageHeader(); ?>
<?php
$income_schedule_view_list->showMessage();
?>
<?php if ($income_schedule_view_list->TotalRecords > 0 || $income_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($income_schedule_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> income_schedule_view">
<?php if (!$income_schedule_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$income_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $income_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $income_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fincome_schedule_viewlist" id="fincome_schedule_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="income_schedule_view">
<?php if ($income_schedule_view->getCurrentMasterTable() == "payroll_period" && $income_schedule_view->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="payroll_period">
<input type="hidden" name="fk_PeriodCode" value="<?php echo HtmlEncode($income_schedule_view_list->PeriodCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_income_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($income_schedule_view_list->TotalRecords > 0 || $income_schedule_view_list->isGridEdit()) { ?>
<table id="tbl_income_schedule_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$income_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$income_schedule_view_list->renderListOptions();

// Render list options (header, left)
$income_schedule_view_list->ListOptions->render("header", "left");
?>
<?php if ($income_schedule_view_list->LAName->Visible) { // LAName ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $income_schedule_view_list->LAName->headerCellClass() ?>"><div id="elh_income_schedule_view_LAName" class="income_schedule_view_LAName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $income_schedule_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->LAName) ?>', 1);"><div id="elh_income_schedule_view_LAName" class="income_schedule_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->NRC->Visible) { // NRC ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $income_schedule_view_list->NRC->headerCellClass() ?>"><div id="elh_income_schedule_view_NRC" class="income_schedule_view_NRC"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $income_schedule_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->NRC) ?>', 1);"><div id="elh_income_schedule_view_NRC" class="income_schedule_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $income_schedule_view_list->Surname->headerCellClass() ?>"><div id="elh_income_schedule_view_Surname" class="income_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $income_schedule_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->Surname) ?>', 1);"><div id="elh_income_schedule_view_Surname" class="income_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $income_schedule_view_list->MiddleName->headerCellClass() ?>"><div id="elh_income_schedule_view_MiddleName" class="income_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $income_schedule_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->MiddleName) ?>', 1);"><div id="elh_income_schedule_view_MiddleName" class="income_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $income_schedule_view_list->FirstName->headerCellClass() ?>"><div id="elh_income_schedule_view_FirstName" class="income_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $income_schedule_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->FirstName) ?>', 1);"><div id="elh_income_schedule_view_FirstName" class="income_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $income_schedule_view_list->PositionName->headerCellClass() ?>"><div id="elh_income_schedule_view_PositionName" class="income_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $income_schedule_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->PositionName) ?>', 1);"><div id="elh_income_schedule_view_PositionName" class="income_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $income_schedule_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_income_schedule_view_EmployeeID" class="income_schedule_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $income_schedule_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->EmployeeID) ?>', 1);"><div id="elh_income_schedule_view_EmployeeID" class="income_schedule_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->PayrollDate) == "") { ?>
		<th data-name="PayrollDate" class="<?php echo $income_schedule_view_list->PayrollDate->headerCellClass() ?>"><div id="elh_income_schedule_view_PayrollDate" class="income_schedule_view_PayrollDate"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->PayrollDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDate" class="<?php echo $income_schedule_view_list->PayrollDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->PayrollDate) ?>', 1);"><div id="elh_income_schedule_view_PayrollDate" class="income_schedule_view_PayrollDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->PayrollDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->PayrollDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->PayrollDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->Income->Visible) { // Income ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->Income) == "") { ?>
		<th data-name="Income" class="<?php echo $income_schedule_view_list->Income->headerCellClass() ?>"><div id="elh_income_schedule_view_Income" class="income_schedule_view_Income"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->Income->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Income" class="<?php echo $income_schedule_view_list->Income->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->Income) ?>', 1);"><div id="elh_income_schedule_view_Income" class="income_schedule_view_Income">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->Income->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->Income->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->IncomeName->Visible) { // IncomeName ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->IncomeName) == "") { ?>
		<th data-name="IncomeName" class="<?php echo $income_schedule_view_list->IncomeName->headerCellClass() ?>"><div id="elh_income_schedule_view_IncomeName" class="income_schedule_view_IncomeName"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->IncomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeName" class="<?php echo $income_schedule_view_list->IncomeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->IncomeName) ?>', 1);"><div id="elh_income_schedule_view_IncomeName" class="income_schedule_view_IncomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->IncomeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->IncomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->IncomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($income_schedule_view_list->SortUrl($income_schedule_view_list->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $income_schedule_view_list->PeriodCode->headerCellClass() ?>"><div id="elh_income_schedule_view_PeriodCode" class="income_schedule_view_PeriodCode"><div class="ew-table-header-caption"><?php echo $income_schedule_view_list->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $income_schedule_view_list->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_schedule_view_list->SortUrl($income_schedule_view_list->PeriodCode) ?>', 1);"><div id="elh_income_schedule_view_PeriodCode" class="income_schedule_view_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_schedule_view_list->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_schedule_view_list->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_schedule_view_list->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$income_schedule_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($income_schedule_view_list->ExportAll && $income_schedule_view_list->isExport()) {
	$income_schedule_view_list->StopRecord = $income_schedule_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($income_schedule_view_list->TotalRecords > $income_schedule_view_list->StartRecord + $income_schedule_view_list->DisplayRecords - 1)
		$income_schedule_view_list->StopRecord = $income_schedule_view_list->StartRecord + $income_schedule_view_list->DisplayRecords - 1;
	else
		$income_schedule_view_list->StopRecord = $income_schedule_view_list->TotalRecords;
}
$income_schedule_view_list->RecordCount = $income_schedule_view_list->StartRecord - 1;
if ($income_schedule_view_list->Recordset && !$income_schedule_view_list->Recordset->EOF) {
	$income_schedule_view_list->Recordset->moveFirst();
	$selectLimit = $income_schedule_view_list->UseSelectLimit;
	if (!$selectLimit && $income_schedule_view_list->StartRecord > 1)
		$income_schedule_view_list->Recordset->move($income_schedule_view_list->StartRecord - 1);
} elseif (!$income_schedule_view->AllowAddDeleteRow && $income_schedule_view_list->StopRecord == 0) {
	$income_schedule_view_list->StopRecord = $income_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$income_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$income_schedule_view->resetAttributes();
$income_schedule_view_list->renderRow();
while ($income_schedule_view_list->RecordCount < $income_schedule_view_list->StopRecord) {
	$income_schedule_view_list->RecordCount++;
	if ($income_schedule_view_list->RecordCount >= $income_schedule_view_list->StartRecord) {
		$income_schedule_view_list->RowCount++;

		// Set up key count
		$income_schedule_view_list->KeyCount = $income_schedule_view_list->RowIndex;

		// Init row class and style
		$income_schedule_view->resetAttributes();
		$income_schedule_view->CssClass = "";
		if ($income_schedule_view_list->isGridAdd()) {
		} else {
			$income_schedule_view_list->loadRowValues($income_schedule_view_list->Recordset); // Load row values
		}
		$income_schedule_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$income_schedule_view->RowAttrs->merge(["data-rowindex" => $income_schedule_view_list->RowCount, "id" => "r" . $income_schedule_view_list->RowCount . "_income_schedule_view", "data-rowtype" => $income_schedule_view->RowType]);

		// Render row
		$income_schedule_view_list->renderRow();

		// Render list options
		$income_schedule_view_list->renderListOptions();
?>
	<tr <?php echo $income_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$income_schedule_view_list->ListOptions->render("body", "left", $income_schedule_view_list->RowCount);
?>
	<?php if ($income_schedule_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $income_schedule_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_LAName">
<span<?php echo $income_schedule_view_list->LAName->viewAttributes() ?>><?php echo $income_schedule_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $income_schedule_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_NRC">
<span<?php echo $income_schedule_view_list->NRC->viewAttributes() ?>><?php echo $income_schedule_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $income_schedule_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_Surname">
<span<?php echo $income_schedule_view_list->Surname->viewAttributes() ?>><?php echo $income_schedule_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $income_schedule_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_MiddleName">
<span<?php echo $income_schedule_view_list->MiddleName->viewAttributes() ?>><?php echo $income_schedule_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $income_schedule_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_FirstName">
<span<?php echo $income_schedule_view_list->FirstName->viewAttributes() ?>><?php echo $income_schedule_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $income_schedule_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_PositionName">
<span<?php echo $income_schedule_view_list->PositionName->viewAttributes() ?>><?php echo $income_schedule_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $income_schedule_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_EmployeeID">
<span<?php echo $income_schedule_view_list->EmployeeID->viewAttributes() ?>><?php echo $income_schedule_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->PayrollDate->Visible) { // PayrollDate ?>
		<td data-name="PayrollDate" <?php echo $income_schedule_view_list->PayrollDate->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_PayrollDate">
<span<?php echo $income_schedule_view_list->PayrollDate->viewAttributes() ?>><?php echo $income_schedule_view_list->PayrollDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->Income->Visible) { // Income ?>
		<td data-name="Income" <?php echo $income_schedule_view_list->Income->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_Income">
<span<?php echo $income_schedule_view_list->Income->viewAttributes() ?>><?php echo $income_schedule_view_list->Income->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName" <?php echo $income_schedule_view_list->IncomeName->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_IncomeName">
<span<?php echo $income_schedule_view_list->IncomeName->viewAttributes() ?>><?php echo $income_schedule_view_list->IncomeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($income_schedule_view_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $income_schedule_view_list->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $income_schedule_view_list->RowCount ?>_income_schedule_view_PeriodCode">
<span<?php echo $income_schedule_view_list->PeriodCode->viewAttributes() ?>><?php echo $income_schedule_view_list->PeriodCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$income_schedule_view_list->ListOptions->render("body", "right", $income_schedule_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$income_schedule_view_list->isGridAdd())
		$income_schedule_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$income_schedule_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($income_schedule_view_list->Recordset)
	$income_schedule_view_list->Recordset->Close();
?>
<?php if (!$income_schedule_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$income_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $income_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $income_schedule_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($income_schedule_view_list->TotalRecords == 0 && !$income_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $income_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$income_schedule_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$income_schedule_view_list->isExport()) { ?>
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
$income_schedule_view_list->terminate();
?>