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
$_asset_view_list = new _asset_view_list();

// Run the page
$_asset_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_asset_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_asset_view_list->isExport()) { ?>
<script>
var f_asset_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_asset_viewlist = currentForm = new ew.Form("f_asset_viewlist", "list");
	f_asset_viewlist.formKeyCountName = '<?php echo $_asset_view_list->FormKeyCountName ?>';
	loadjs.done("f_asset_viewlist");
});
var f_asset_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_asset_viewlistsrch = currentSearchForm = new ew.Form("f_asset_viewlistsrch");

	// Validate function for search
	f_asset_viewlistsrch.validate = function(fobj) {
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
	f_asset_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_asset_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_asset_viewlistsrch.lists["x_ProvinceCode"] = <?php echo $_asset_view_list->ProvinceCode->Lookup->toClientList($_asset_view_list) ?>;
	f_asset_viewlistsrch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($_asset_view_list->ProvinceCode->lookupOptions()) ?>;

	// Filters
	f_asset_viewlistsrch.filterList = <?php echo $_asset_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_asset_viewlistsrch.initSearchPanel = true;
	loadjs.done("f_asset_viewlistsrch");
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
<?php if (!$_asset_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_asset_view_list->TotalRecords > 0 && $_asset_view_list->ExportOptions->visible()) { ?>
<?php $_asset_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_asset_view_list->ImportOptions->visible()) { ?>
<?php $_asset_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_asset_view_list->SearchOptions->visible()) { ?>
<?php $_asset_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_asset_view_list->FilterOptions->visible()) { ?>
<?php $_asset_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_asset_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_asset_view_list->isExport() && !$_asset_view->CurrentAction) { ?>
<form name="f_asset_viewlistsrch" id="f_asset_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_asset_viewlistsrch-search-panel" class="<?php echo $_asset_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_asset_view">
	<div class="ew-extended-search">
<?php

// Render search row
$_asset_view->RowType = ROWTYPE_SEARCH;
$_asset_view->resetAttributes();
$_asset_view_list->renderRow();
?>
<?php if ($_asset_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php
		$_asset_view_list->SearchColumnCount++;
		if (($_asset_view_list->SearchColumnCount - 1) % $_asset_view_list->SearchFieldsPerRow == 0) {
			$_asset_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_asset_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ProvinceCode" class="ew-cell form-group">
		<label for="x_ProvinceCode" class="ew-search-caption ew-label"><?php echo $_asset_view_list->ProvinceCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		<span id="el__asset_view_ProvinceCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_asset_view" data-field="x_ProvinceCode" data-value-separator="<?php echo $_asset_view_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $_asset_view_list->ProvinceCode->editAttributes() ?>>
			<?php echo $_asset_view_list->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $_asset_view_list->ProvinceCode->Lookup->getParamTag($_asset_view_list, "p_x_ProvinceCode") ?>
</span>
	</div>
	<?php if ($_asset_view_list->SearchColumnCount % $_asset_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->ProvinceName->Visible) { // ProvinceName ?>
	<?php
		$_asset_view_list->SearchColumnCount++;
		if (($_asset_view_list->SearchColumnCount - 1) % $_asset_view_list->SearchFieldsPerRow == 0) {
			$_asset_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_asset_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ProvinceName" class="ew-cell form-group">
		<label for="x_ProvinceName" class="ew-search-caption ew-label"><?php echo $_asset_view_list->ProvinceName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProvinceName" id="z_ProvinceName" value="LIKE">
</span>
		<span id="el__asset_view_ProvinceName" class="ew-search-field">
<input type="text" data-table="_asset_view" data-field="x_ProvinceName" name="x_ProvinceName" id="x_ProvinceName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($_asset_view_list->ProvinceName->getPlaceHolder()) ?>" value="<?php echo $_asset_view_list->ProvinceName->EditValue ?>"<?php echo $_asset_view_list->ProvinceName->editAttributes() ?>>
</span>
	</div>
	<?php if ($_asset_view_list->SearchColumnCount % $_asset_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->LAName->Visible) { // LAName ?>
	<?php
		$_asset_view_list->SearchColumnCount++;
		if (($_asset_view_list->SearchColumnCount - 1) % $_asset_view_list->SearchFieldsPerRow == 0) {
			$_asset_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_asset_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LAName" class="ew-cell form-group">
		<label for="x_LAName" class="ew-search-caption ew-label"><?php echo $_asset_view_list->LAName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		<span id="el__asset_view_LAName" class="ew-search-field">
<input type="text" data-table="_asset_view" data-field="x_LAName" name="x_LAName" id="x_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($_asset_view_list->LAName->getPlaceHolder()) ?>" value="<?php echo $_asset_view_list->LAName->EditValue ?>"<?php echo $_asset_view_list->LAName->editAttributes() ?>>
</span>
	</div>
	<?php if ($_asset_view_list->SearchColumnCount % $_asset_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->AssetTypeName->Visible) { // AssetTypeName ?>
	<?php
		$_asset_view_list->SearchColumnCount++;
		if (($_asset_view_list->SearchColumnCount - 1) % $_asset_view_list->SearchFieldsPerRow == 0) {
			$_asset_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_asset_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_AssetTypeName" class="ew-cell form-group">
		<label for="x_AssetTypeName" class="ew-search-caption ew-label"><?php echo $_asset_view_list->AssetTypeName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AssetTypeName" id="z_AssetTypeName" value="LIKE">
</span>
		<span id="el__asset_view_AssetTypeName" class="ew-search-field">
<input type="text" data-table="_asset_view" data-field="x_AssetTypeName" name="x_AssetTypeName" id="x_AssetTypeName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($_asset_view_list->AssetTypeName->getPlaceHolder()) ?>" value="<?php echo $_asset_view_list->AssetTypeName->EditValue ?>"<?php echo $_asset_view_list->AssetTypeName->editAttributes() ?>>
</span>
	</div>
	<?php if ($_asset_view_list->SearchColumnCount % $_asset_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->ConditionDesc->Visible) { // ConditionDesc ?>
	<?php
		$_asset_view_list->SearchColumnCount++;
		if (($_asset_view_list->SearchColumnCount - 1) % $_asset_view_list->SearchFieldsPerRow == 0) {
			$_asset_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_asset_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ConditionDesc" class="ew-cell form-group">
		<label for="x_ConditionDesc" class="ew-search-caption ew-label"><?php echo $_asset_view_list->ConditionDesc->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ConditionDesc" id="z_ConditionDesc" value="LIKE">
</span>
		<span id="el__asset_view_ConditionDesc" class="ew-search-field">
<input type="text" data-table="_asset_view" data-field="x_ConditionDesc" name="x_ConditionDesc" id="x_ConditionDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_asset_view_list->ConditionDesc->getPlaceHolder()) ?>" value="<?php echo $_asset_view_list->ConditionDesc->EditValue ?>"<?php echo $_asset_view_list->ConditionDesc->editAttributes() ?>>
</span>
	</div>
	<?php if ($_asset_view_list->SearchColumnCount % $_asset_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($_asset_view_list->SearchColumnCount % $_asset_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $_asset_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_asset_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_asset_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_asset_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_asset_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_asset_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_asset_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_asset_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_asset_view_list->showPageHeader(); ?>
<?php
$_asset_view_list->showMessage();
?>
<?php if ($_asset_view_list->TotalRecords > 0 || $_asset_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_asset_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _asset_view">
<?php if (!$_asset_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_asset_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_asset_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_asset_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_asset_viewlist" id="f_asset_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_asset_view">
<div id="gmp__asset_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_asset_view_list->TotalRecords > 0 || $_asset_view_list->isGridEdit()) { ?>
<table id="tbl__asset_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_asset_view->RowType = ROWTYPE_HEADER;

// Render list options
$_asset_view_list->renderListOptions();

// Render list options (header, left)
$_asset_view_list->ListOptions->render("header", "left");
?>
<?php if ($_asset_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $_asset_view_list->ProvinceCode->headerCellClass() ?>"><div id="elh__asset_view_ProvinceCode" class="_asset_view_ProvinceCode"><div class="ew-table-header-caption"><?php echo $_asset_view_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $_asset_view_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->ProvinceCode) ?>', 1);"><div id="elh__asset_view_ProvinceCode" class="_asset_view_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->ProvinceName->Visible) { // ProvinceName ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->ProvinceName) == "") { ?>
		<th data-name="ProvinceName" class="<?php echo $_asset_view_list->ProvinceName->headerCellClass() ?>"><div id="elh__asset_view_ProvinceName" class="_asset_view_ProvinceName"><div class="ew-table-header-caption"><?php echo $_asset_view_list->ProvinceName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceName" class="<?php echo $_asset_view_list->ProvinceName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->ProvinceName) ?>', 1);"><div id="elh__asset_view_ProvinceName" class="_asset_view_ProvinceName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->ProvinceName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->ProvinceName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->ProvinceName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->LAName->Visible) { // LAName ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $_asset_view_list->LAName->headerCellClass() ?>"><div id="elh__asset_view_LAName" class="_asset_view_LAName"><div class="ew-table-header-caption"><?php echo $_asset_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $_asset_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->LAName) ?>', 1);"><div id="elh__asset_view_LAName" class="_asset_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $_asset_view_list->DepartmentCode->headerCellClass() ?>"><div id="elh__asset_view_DepartmentCode" class="_asset_view_DepartmentCode"><div class="ew-table-header-caption"><?php echo $_asset_view_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $_asset_view_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->DepartmentCode) ?>', 1);"><div id="elh__asset_view_DepartmentCode" class="_asset_view_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->AssetTypeName->Visible) { // AssetTypeName ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->AssetTypeName) == "") { ?>
		<th data-name="AssetTypeName" class="<?php echo $_asset_view_list->AssetTypeName->headerCellClass() ?>"><div id="elh__asset_view_AssetTypeName" class="_asset_view_AssetTypeName"><div class="ew-table-header-caption"><?php echo $_asset_view_list->AssetTypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetTypeName" class="<?php echo $_asset_view_list->AssetTypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->AssetTypeName) ?>', 1);"><div id="elh__asset_view_AssetTypeName" class="_asset_view_AssetTypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->AssetTypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->AssetTypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->AssetTypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->Supplier->Visible) { // Supplier ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->Supplier) == "") { ?>
		<th data-name="Supplier" class="<?php echo $_asset_view_list->Supplier->headerCellClass() ?>"><div id="elh__asset_view_Supplier" class="_asset_view_Supplier"><div class="ew-table-header-caption"><?php echo $_asset_view_list->Supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Supplier" class="<?php echo $_asset_view_list->Supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->Supplier) ?>', 1);"><div id="elh__asset_view_Supplier" class="_asset_view_Supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->Supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->Supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->Supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->PurchasePrice->Visible) { // PurchasePrice ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->PurchasePrice) == "") { ?>
		<th data-name="PurchasePrice" class="<?php echo $_asset_view_list->PurchasePrice->headerCellClass() ?>"><div id="elh__asset_view_PurchasePrice" class="_asset_view_PurchasePrice"><div class="ew-table-header-caption"><?php echo $_asset_view_list->PurchasePrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PurchasePrice" class="<?php echo $_asset_view_list->PurchasePrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->PurchasePrice) ?>', 1);"><div id="elh__asset_view_PurchasePrice" class="_asset_view_PurchasePrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->PurchasePrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->PurchasePrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->PurchasePrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->CurrencyCode->Visible) { // CurrencyCode ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->CurrencyCode) == "") { ?>
		<th data-name="CurrencyCode" class="<?php echo $_asset_view_list->CurrencyCode->headerCellClass() ?>"><div id="elh__asset_view_CurrencyCode" class="_asset_view_CurrencyCode"><div class="ew-table-header-caption"><?php echo $_asset_view_list->CurrencyCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrencyCode" class="<?php echo $_asset_view_list->CurrencyCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->CurrencyCode) ?>', 1);"><div id="elh__asset_view_CurrencyCode" class="_asset_view_CurrencyCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->CurrencyCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->CurrencyCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->CurrencyCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->ConditionDesc->Visible) { // ConditionDesc ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->ConditionDesc) == "") { ?>
		<th data-name="ConditionDesc" class="<?php echo $_asset_view_list->ConditionDesc->headerCellClass() ?>"><div id="elh__asset_view_ConditionDesc" class="_asset_view_ConditionDesc"><div class="ew-table-header-caption"><?php echo $_asset_view_list->ConditionDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ConditionDesc" class="<?php echo $_asset_view_list->ConditionDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->ConditionDesc) ?>', 1);"><div id="elh__asset_view_ConditionDesc" class="_asset_view_ConditionDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->ConditionDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->ConditionDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->ConditionDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->DateOfPurchase) == "") { ?>
		<th data-name="DateOfPurchase" class="<?php echo $_asset_view_list->DateOfPurchase->headerCellClass() ?>"><div id="elh__asset_view_DateOfPurchase" class="_asset_view_DateOfPurchase"><div class="ew-table-header-caption"><?php echo $_asset_view_list->DateOfPurchase->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfPurchase" class="<?php echo $_asset_view_list->DateOfPurchase->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->DateOfPurchase) ?>', 1);"><div id="elh__asset_view_DateOfPurchase" class="_asset_view_DateOfPurchase">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->DateOfPurchase->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->DateOfPurchase->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->DateOfPurchase->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->AssetCapacity->Visible) { // AssetCapacity ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->AssetCapacity) == "") { ?>
		<th data-name="AssetCapacity" class="<?php echo $_asset_view_list->AssetCapacity->headerCellClass() ?>"><div id="elh__asset_view_AssetCapacity" class="_asset_view_AssetCapacity"><div class="ew-table-header-caption"><?php echo $_asset_view_list->AssetCapacity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetCapacity" class="<?php echo $_asset_view_list->AssetCapacity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->AssetCapacity) ?>', 1);"><div id="elh__asset_view_AssetCapacity" class="_asset_view_AssetCapacity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->AssetCapacity->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->AssetCapacity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->AssetCapacity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $_asset_view_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh__asset_view_UnitOfMeasure" class="_asset_view_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $_asset_view_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $_asset_view_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->UnitOfMeasure) ?>', 1);"><div id="elh__asset_view_UnitOfMeasure" class="_asset_view_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->AssetDescription->Visible) { // AssetDescription ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->AssetDescription) == "") { ?>
		<th data-name="AssetDescription" class="<?php echo $_asset_view_list->AssetDescription->headerCellClass() ?>"><div id="elh__asset_view_AssetDescription" class="_asset_view_AssetDescription"><div class="ew-table-header-caption"><?php echo $_asset_view_list->AssetDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetDescription" class="<?php echo $_asset_view_list->AssetDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->AssetDescription) ?>', 1);"><div id="elh__asset_view_AssetDescription" class="_asset_view_AssetDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->AssetDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->AssetDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->AssetDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->DateOfLastRevaluation) == "") { ?>
		<th data-name="DateOfLastRevaluation" class="<?php echo $_asset_view_list->DateOfLastRevaluation->headerCellClass() ?>"><div id="elh__asset_view_DateOfLastRevaluation" class="_asset_view_DateOfLastRevaluation"><div class="ew-table-header-caption"><?php echo $_asset_view_list->DateOfLastRevaluation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfLastRevaluation" class="<?php echo $_asset_view_list->DateOfLastRevaluation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->DateOfLastRevaluation) ?>', 1);"><div id="elh__asset_view_DateOfLastRevaluation" class="_asset_view_DateOfLastRevaluation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->DateOfLastRevaluation->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->DateOfLastRevaluation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->DateOfLastRevaluation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->NewValue->Visible) { // NewValue ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->NewValue) == "") { ?>
		<th data-name="NewValue" class="<?php echo $_asset_view_list->NewValue->headerCellClass() ?>"><div id="elh__asset_view_NewValue" class="_asset_view_NewValue"><div class="ew-table-header-caption"><?php echo $_asset_view_list->NewValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewValue" class="<?php echo $_asset_view_list->NewValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->NewValue) ?>', 1);"><div id="elh__asset_view_NewValue" class="_asset_view_NewValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->NewValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->NewValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->NewValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->NameOfValuer->Visible) { // NameOfValuer ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->NameOfValuer) == "") { ?>
		<th data-name="NameOfValuer" class="<?php echo $_asset_view_list->NameOfValuer->headerCellClass() ?>"><div id="elh__asset_view_NameOfValuer" class="_asset_view_NameOfValuer"><div class="ew-table-header-caption"><?php echo $_asset_view_list->NameOfValuer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NameOfValuer" class="<?php echo $_asset_view_list->NameOfValuer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->NameOfValuer) ?>', 1);"><div id="elh__asset_view_NameOfValuer" class="_asset_view_NameOfValuer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->NameOfValuer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->NameOfValuer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->NameOfValuer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->BookValue->Visible) { // BookValue ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->BookValue) == "") { ?>
		<th data-name="BookValue" class="<?php echo $_asset_view_list->BookValue->headerCellClass() ?>"><div id="elh__asset_view_BookValue" class="_asset_view_BookValue"><div class="ew-table-header-caption"><?php echo $_asset_view_list->BookValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BookValue" class="<?php echo $_asset_view_list->BookValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->BookValue) ?>', 1);"><div id="elh__asset_view_BookValue" class="_asset_view_BookValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->BookValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->BookValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->BookValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->LastDepreciationDate) == "") { ?>
		<th data-name="LastDepreciationDate" class="<?php echo $_asset_view_list->LastDepreciationDate->headerCellClass() ?>"><div id="elh__asset_view_LastDepreciationDate" class="_asset_view_LastDepreciationDate"><div class="ew-table-header-caption"><?php echo $_asset_view_list->LastDepreciationDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastDepreciationDate" class="<?php echo $_asset_view_list->LastDepreciationDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->LastDepreciationDate) ?>', 1);"><div id="elh__asset_view_LastDepreciationDate" class="_asset_view_LastDepreciationDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->LastDepreciationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->LastDepreciationDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->LastDepreciationDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->LastDepreciationAmount) == "") { ?>
		<th data-name="LastDepreciationAmount" class="<?php echo $_asset_view_list->LastDepreciationAmount->headerCellClass() ?>"><div id="elh__asset_view_LastDepreciationAmount" class="_asset_view_LastDepreciationAmount"><div class="ew-table-header-caption"><?php echo $_asset_view_list->LastDepreciationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastDepreciationAmount" class="<?php echo $_asset_view_list->LastDepreciationAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->LastDepreciationAmount) ?>', 1);"><div id="elh__asset_view_LastDepreciationAmount" class="_asset_view_LastDepreciationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->LastDepreciationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->LastDepreciationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->LastDepreciationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->DepreciationRate->Visible) { // DepreciationRate ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->DepreciationRate) == "") { ?>
		<th data-name="DepreciationRate" class="<?php echo $_asset_view_list->DepreciationRate->headerCellClass() ?>"><div id="elh__asset_view_DepreciationRate" class="_asset_view_DepreciationRate"><div class="ew-table-header-caption"><?php echo $_asset_view_list->DepreciationRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepreciationRate" class="<?php echo $_asset_view_list->DepreciationRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->DepreciationRate) ?>', 1);"><div id="elh__asset_view_DepreciationRate" class="_asset_view_DepreciationRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->DepreciationRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->DepreciationRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->DepreciationRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->CumulativeDepreciation) == "") { ?>
		<th data-name="CumulativeDepreciation" class="<?php echo $_asset_view_list->CumulativeDepreciation->headerCellClass() ?>"><div id="elh__asset_view_CumulativeDepreciation" class="_asset_view_CumulativeDepreciation"><div class="ew-table-header-caption"><?php echo $_asset_view_list->CumulativeDepreciation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CumulativeDepreciation" class="<?php echo $_asset_view_list->CumulativeDepreciation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->CumulativeDepreciation) ?>', 1);"><div id="elh__asset_view_CumulativeDepreciation" class="_asset_view_CumulativeDepreciation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->CumulativeDepreciation->caption() ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->CumulativeDepreciation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->CumulativeDepreciation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_asset_view_list->AssetStatus->Visible) { // AssetStatus ?>
	<?php if ($_asset_view_list->SortUrl($_asset_view_list->AssetStatus) == "") { ?>
		<th data-name="AssetStatus" class="<?php echo $_asset_view_list->AssetStatus->headerCellClass() ?>"><div id="elh__asset_view_AssetStatus" class="_asset_view_AssetStatus"><div class="ew-table-header-caption"><?php echo $_asset_view_list->AssetStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetStatus" class="<?php echo $_asset_view_list->AssetStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_asset_view_list->SortUrl($_asset_view_list->AssetStatus) ?>', 1);"><div id="elh__asset_view_AssetStatus" class="_asset_view_AssetStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_asset_view_list->AssetStatus->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_asset_view_list->AssetStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_asset_view_list->AssetStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_asset_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_asset_view_list->ExportAll && $_asset_view_list->isExport()) {
	$_asset_view_list->StopRecord = $_asset_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_asset_view_list->TotalRecords > $_asset_view_list->StartRecord + $_asset_view_list->DisplayRecords - 1)
		$_asset_view_list->StopRecord = $_asset_view_list->StartRecord + $_asset_view_list->DisplayRecords - 1;
	else
		$_asset_view_list->StopRecord = $_asset_view_list->TotalRecords;
}
$_asset_view_list->RecordCount = $_asset_view_list->StartRecord - 1;
if ($_asset_view_list->Recordset && !$_asset_view_list->Recordset->EOF) {
	$_asset_view_list->Recordset->moveFirst();
	$selectLimit = $_asset_view_list->UseSelectLimit;
	if (!$selectLimit && $_asset_view_list->StartRecord > 1)
		$_asset_view_list->Recordset->move($_asset_view_list->StartRecord - 1);
} elseif (!$_asset_view->AllowAddDeleteRow && $_asset_view_list->StopRecord == 0) {
	$_asset_view_list->StopRecord = $_asset_view->GridAddRowCount;
}

// Initialize aggregate
$_asset_view->RowType = ROWTYPE_AGGREGATEINIT;
$_asset_view->resetAttributes();
$_asset_view_list->renderRow();
while ($_asset_view_list->RecordCount < $_asset_view_list->StopRecord) {
	$_asset_view_list->RecordCount++;
	if ($_asset_view_list->RecordCount >= $_asset_view_list->StartRecord) {
		$_asset_view_list->RowCount++;

		// Set up key count
		$_asset_view_list->KeyCount = $_asset_view_list->RowIndex;

		// Init row class and style
		$_asset_view->resetAttributes();
		$_asset_view->CssClass = "";
		if ($_asset_view_list->isGridAdd()) {
		} else {
			$_asset_view_list->loadRowValues($_asset_view_list->Recordset); // Load row values
		}
		$_asset_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_asset_view->RowAttrs->merge(["data-rowindex" => $_asset_view_list->RowCount, "id" => "r" . $_asset_view_list->RowCount . "__asset_view", "data-rowtype" => $_asset_view->RowType]);

		// Render row
		$_asset_view_list->renderRow();

		// Render list options
		$_asset_view_list->renderListOptions();
?>
	<tr <?php echo $_asset_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_asset_view_list->ListOptions->render("body", "left", $_asset_view_list->RowCount);
?>
	<?php if ($_asset_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $_asset_view_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_ProvinceCode">
<span<?php echo $_asset_view_list->ProvinceCode->viewAttributes() ?>><?php echo $_asset_view_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->ProvinceName->Visible) { // ProvinceName ?>
		<td data-name="ProvinceName" <?php echo $_asset_view_list->ProvinceName->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_ProvinceName">
<span<?php echo $_asset_view_list->ProvinceName->viewAttributes() ?>><?php echo $_asset_view_list->ProvinceName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $_asset_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_LAName">
<span<?php echo $_asset_view_list->LAName->viewAttributes() ?>><?php echo $_asset_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $_asset_view_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_DepartmentCode">
<span<?php echo $_asset_view_list->DepartmentCode->viewAttributes() ?>><?php echo $_asset_view_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->AssetTypeName->Visible) { // AssetTypeName ?>
		<td data-name="AssetTypeName" <?php echo $_asset_view_list->AssetTypeName->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_AssetTypeName">
<span<?php echo $_asset_view_list->AssetTypeName->viewAttributes() ?>><?php echo $_asset_view_list->AssetTypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->Supplier->Visible) { // Supplier ?>
		<td data-name="Supplier" <?php echo $_asset_view_list->Supplier->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_Supplier">
<span<?php echo $_asset_view_list->Supplier->viewAttributes() ?>><?php echo $_asset_view_list->Supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->PurchasePrice->Visible) { // PurchasePrice ?>
		<td data-name="PurchasePrice" <?php echo $_asset_view_list->PurchasePrice->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_PurchasePrice">
<span<?php echo $_asset_view_list->PurchasePrice->viewAttributes() ?>><?php echo $_asset_view_list->PurchasePrice->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->CurrencyCode->Visible) { // CurrencyCode ?>
		<td data-name="CurrencyCode" <?php echo $_asset_view_list->CurrencyCode->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_CurrencyCode">
<span<?php echo $_asset_view_list->CurrencyCode->viewAttributes() ?>><?php echo $_asset_view_list->CurrencyCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->ConditionDesc->Visible) { // ConditionDesc ?>
		<td data-name="ConditionDesc" <?php echo $_asset_view_list->ConditionDesc->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_ConditionDesc">
<span<?php echo $_asset_view_list->ConditionDesc->viewAttributes() ?>><?php echo $_asset_view_list->ConditionDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<td data-name="DateOfPurchase" <?php echo $_asset_view_list->DateOfPurchase->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_DateOfPurchase">
<span<?php echo $_asset_view_list->DateOfPurchase->viewAttributes() ?>><?php echo $_asset_view_list->DateOfPurchase->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->AssetCapacity->Visible) { // AssetCapacity ?>
		<td data-name="AssetCapacity" <?php echo $_asset_view_list->AssetCapacity->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_AssetCapacity">
<span<?php echo $_asset_view_list->AssetCapacity->viewAttributes() ?>><?php echo $_asset_view_list->AssetCapacity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $_asset_view_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_UnitOfMeasure">
<span<?php echo $_asset_view_list->UnitOfMeasure->viewAttributes() ?>><?php echo $_asset_view_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->AssetDescription->Visible) { // AssetDescription ?>
		<td data-name="AssetDescription" <?php echo $_asset_view_list->AssetDescription->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_AssetDescription">
<span<?php echo $_asset_view_list->AssetDescription->viewAttributes() ?>><?php echo $_asset_view_list->AssetDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<td data-name="DateOfLastRevaluation" <?php echo $_asset_view_list->DateOfLastRevaluation->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_DateOfLastRevaluation">
<span<?php echo $_asset_view_list->DateOfLastRevaluation->viewAttributes() ?>><?php echo $_asset_view_list->DateOfLastRevaluation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->NewValue->Visible) { // NewValue ?>
		<td data-name="NewValue" <?php echo $_asset_view_list->NewValue->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_NewValue">
<span<?php echo $_asset_view_list->NewValue->viewAttributes() ?>><?php echo $_asset_view_list->NewValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->NameOfValuer->Visible) { // NameOfValuer ?>
		<td data-name="NameOfValuer" <?php echo $_asset_view_list->NameOfValuer->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_NameOfValuer">
<span<?php echo $_asset_view_list->NameOfValuer->viewAttributes() ?>><?php echo $_asset_view_list->NameOfValuer->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->BookValue->Visible) { // BookValue ?>
		<td data-name="BookValue" <?php echo $_asset_view_list->BookValue->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_BookValue">
<span<?php echo $_asset_view_list->BookValue->viewAttributes() ?>><?php echo $_asset_view_list->BookValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<td data-name="LastDepreciationDate" <?php echo $_asset_view_list->LastDepreciationDate->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_LastDepreciationDate">
<span<?php echo $_asset_view_list->LastDepreciationDate->viewAttributes() ?>><?php echo $_asset_view_list->LastDepreciationDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<td data-name="LastDepreciationAmount" <?php echo $_asset_view_list->LastDepreciationAmount->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_LastDepreciationAmount">
<span<?php echo $_asset_view_list->LastDepreciationAmount->viewAttributes() ?>><?php echo $_asset_view_list->LastDepreciationAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->DepreciationRate->Visible) { // DepreciationRate ?>
		<td data-name="DepreciationRate" <?php echo $_asset_view_list->DepreciationRate->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_DepreciationRate">
<span<?php echo $_asset_view_list->DepreciationRate->viewAttributes() ?>><?php echo $_asset_view_list->DepreciationRate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<td data-name="CumulativeDepreciation" <?php echo $_asset_view_list->CumulativeDepreciation->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_CumulativeDepreciation">
<span<?php echo $_asset_view_list->CumulativeDepreciation->viewAttributes() ?>><?php echo $_asset_view_list->CumulativeDepreciation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_asset_view_list->AssetStatus->Visible) { // AssetStatus ?>
		<td data-name="AssetStatus" <?php echo $_asset_view_list->AssetStatus->cellAttributes() ?>>
<span id="el<?php echo $_asset_view_list->RowCount ?>__asset_view_AssetStatus">
<span<?php echo $_asset_view_list->AssetStatus->viewAttributes() ?>><?php echo $_asset_view_list->AssetStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_asset_view_list->ListOptions->render("body", "right", $_asset_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_asset_view_list->isGridAdd())
		$_asset_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_asset_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_asset_view_list->Recordset)
	$_asset_view_list->Recordset->Close();
?>
<?php if (!$_asset_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_asset_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_asset_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_asset_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_asset_view_list->TotalRecords == 0 && !$_asset_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_asset_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_asset_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_asset_view_list->isExport()) { ?>
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
$_asset_view_list->terminate();
?>