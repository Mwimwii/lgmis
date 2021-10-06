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
$_payroll_schedule_view_list = new _payroll_schedule_view_list();

// Run the page
$_payroll_schedule_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_payroll_schedule_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_payroll_schedule_view_list->isExport()) { ?>
<script>
var f_payroll_schedule_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_payroll_schedule_viewlist = currentForm = new ew.Form("f_payroll_schedule_viewlist", "list");
	f_payroll_schedule_viewlist.formKeyCountName = '<?php echo $_payroll_schedule_view_list->FormKeyCountName ?>';
	loadjs.done("f_payroll_schedule_viewlist");
});
var f_payroll_schedule_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_payroll_schedule_viewlistsrch = currentSearchForm = new ew.Form("f_payroll_schedule_viewlistsrch");

	// Validate function for search
	f_payroll_schedule_viewlistsrch.validate = function(fobj) {
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
	f_payroll_schedule_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_payroll_schedule_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_payroll_schedule_viewlistsrch.lists["x_LocalAuthority"] = <?php echo $_payroll_schedule_view_list->LocalAuthority->Lookup->toClientList($_payroll_schedule_view_list) ?>;
	f_payroll_schedule_viewlistsrch.lists["x_LocalAuthority"].options = <?php echo JsonEncode($_payroll_schedule_view_list->LocalAuthority->lookupOptions()) ?>;
	f_payroll_schedule_viewlistsrch.lists["x_PayrollPeriod"] = <?php echo $_payroll_schedule_view_list->PayrollPeriod->Lookup->toClientList($_payroll_schedule_view_list) ?>;
	f_payroll_schedule_viewlistsrch.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($_payroll_schedule_view_list->PayrollPeriod->lookupOptions()) ?>;

	// Filters
	f_payroll_schedule_viewlistsrch.filterList = <?php echo $_payroll_schedule_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_payroll_schedule_viewlistsrch.initSearchPanel = true;
	loadjs.done("f_payroll_schedule_viewlistsrch");
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
<?php if (!$_payroll_schedule_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_payroll_schedule_view_list->TotalRecords > 0 && $_payroll_schedule_view_list->ExportOptions->visible()) { ?>
<?php $_payroll_schedule_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->ImportOptions->visible()) { ?>
<?php $_payroll_schedule_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->SearchOptions->visible()) { ?>
<?php $_payroll_schedule_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->FilterOptions->visible()) { ?>
<?php $_payroll_schedule_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_payroll_schedule_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_payroll_schedule_view_list->isExport() && !$_payroll_schedule_view->CurrentAction) { ?>
<form name="f_payroll_schedule_viewlistsrch" id="f_payroll_schedule_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_payroll_schedule_viewlistsrch-search-panel" class="<?php echo $_payroll_schedule_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_payroll_schedule_view">
	<div class="ew-extended-search">
<?php

// Render search row
$_payroll_schedule_view->RowType = ROWTYPE_SEARCH;
$_payroll_schedule_view->resetAttributes();
$_payroll_schedule_view_list->renderRow();
?>
<?php if ($_payroll_schedule_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php
		$_payroll_schedule_view_list->SearchColumnCount++;
		if (($_payroll_schedule_view_list->SearchColumnCount - 1) % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) {
			$_payroll_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_payroll_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LocalAuthority" class="ew-cell form-group">
		<label for="x_LocalAuthority" class="ew-search-caption ew-label"><?php echo $_payroll_schedule_view_list->LocalAuthority->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		<span id="el__payroll_schedule_view_LocalAuthority" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LocalAuthority"><?php echo EmptyValue(strval($_payroll_schedule_view_list->LocalAuthority->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $_payroll_schedule_view_list->LocalAuthority->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_payroll_schedule_view_list->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_payroll_schedule_view_list->LocalAuthority->ReadOnly || $_payroll_schedule_view_list->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_payroll_schedule_view_list->LocalAuthority->Lookup->getParamTag($_payroll_schedule_view_list, "p_x_LocalAuthority") ?>
<input type="hidden" data-table="_payroll_schedule_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_payroll_schedule_view_list->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x_LocalAuthority" id="x_LocalAuthority" value="<?php echo $_payroll_schedule_view_list->LocalAuthority->AdvancedSearch->SearchValue ?>"<?php echo $_payroll_schedule_view_list->LocalAuthority->editAttributes() ?>>
</span>
	</div>
	<?php if ($_payroll_schedule_view_list->SearchColumnCount % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$_payroll_schedule_view_list->SearchColumnCount++;
		if (($_payroll_schedule_view_list->SearchColumnCount - 1) % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) {
			$_payroll_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_payroll_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $_payroll_schedule_view_list->PayrollPeriod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		<span id="el__payroll_schedule_view_PayrollPeriod" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PayrollPeriod"><?php echo EmptyValue(strval($_payroll_schedule_view_list->PayrollPeriod->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $_payroll_schedule_view_list->PayrollPeriod->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_payroll_schedule_view_list->PayrollPeriod->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_payroll_schedule_view_list->PayrollPeriod->ReadOnly || $_payroll_schedule_view_list->PayrollPeriod->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PayrollPeriod',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_payroll_schedule_view_list->PayrollPeriod->Lookup->getParamTag($_payroll_schedule_view_list, "p_x_PayrollPeriod") ?>
<input type="hidden" data-table="_payroll_schedule_view" data-field="x_PayrollPeriod" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_payroll_schedule_view_list->PayrollPeriod->displayValueSeparatorAttribute() ?>" name="x_PayrollPeriod" id="x_PayrollPeriod" value="<?php echo $_payroll_schedule_view_list->PayrollPeriod->AdvancedSearch->SearchValue ?>"<?php echo $_payroll_schedule_view_list->PayrollPeriod->editAttributes() ?>>
</span>
	</div>
	<?php if ($_payroll_schedule_view_list->SearchColumnCount % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->pCode->Visible) { // pCode ?>
	<?php
		$_payroll_schedule_view_list->SearchColumnCount++;
		if (($_payroll_schedule_view_list->SearchColumnCount - 1) % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) {
			$_payroll_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_payroll_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pCode" class="ew-cell form-group">
		<label for="x_pCode" class="ew-search-caption ew-label"><?php echo $_payroll_schedule_view_list->pCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pCode" id="z_pCode" value="LIKE">
</span>
		<span id="el__payroll_schedule_view_pCode" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_pCode" name="x_pCode" id="x_pCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_list->pCode->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_list->pCode->EditValue ?>"<?php echo $_payroll_schedule_view_list->pCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($_payroll_schedule_view_list->SearchColumnCount % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->pName->Visible) { // pName ?>
	<?php
		$_payroll_schedule_view_list->SearchColumnCount++;
		if (($_payroll_schedule_view_list->SearchColumnCount - 1) % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) {
			$_payroll_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_payroll_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pName" class="ew-cell form-group">
		<label for="x_pName" class="ew-search-caption ew-label"><?php echo $_payroll_schedule_view_list->pName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pName" id="z_pName" value="LIKE">
</span>
		<span id="el__payroll_schedule_view_pName" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_pName" name="x_pName" id="x_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_list->pName->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_list->pName->EditValue ?>"<?php echo $_payroll_schedule_view_list->pName->editAttributes() ?>>
</span>
	</div>
	<?php if ($_payroll_schedule_view_list->SearchColumnCount % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php
		$_payroll_schedule_view_list->SearchColumnCount++;
		if (($_payroll_schedule_view_list->SearchColumnCount - 1) % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) {
			$_payroll_schedule_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $_payroll_schedule_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PaymentMethod" class="ew-cell form-group">
		<label for="x_PaymentMethod" class="ew-search-caption ew-label"><?php echo $_payroll_schedule_view_list->PaymentMethod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		<span id="el__payroll_schedule_view_PaymentMethod" class="ew-search-field">
<input type="text" data-table="_payroll_schedule_view" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($_payroll_schedule_view_list->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $_payroll_schedule_view_list->PaymentMethod->EditValue ?>"<?php echo $_payroll_schedule_view_list->PaymentMethod->editAttributes() ?>>
</span>
	</div>
	<?php if ($_payroll_schedule_view_list->SearchColumnCount % $_payroll_schedule_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($_payroll_schedule_view_list->SearchColumnCount % $_payroll_schedule_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $_payroll_schedule_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_payroll_schedule_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_payroll_schedule_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_payroll_schedule_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_payroll_schedule_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_payroll_schedule_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_payroll_schedule_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_payroll_schedule_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_payroll_schedule_view_list->showPageHeader(); ?>
<?php
$_payroll_schedule_view_list->showMessage();
?>
<?php if ($_payroll_schedule_view_list->TotalRecords > 0 || $_payroll_schedule_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_payroll_schedule_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _payroll_schedule_view">
<?php if (!$_payroll_schedule_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_payroll_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_payroll_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_payroll_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_payroll_schedule_viewlist" id="f_payroll_schedule_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_payroll_schedule_view">
<div id="gmp__payroll_schedule_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_payroll_schedule_view_list->TotalRecords > 0 || $_payroll_schedule_view_list->isGridEdit()) { ?>
<table id="tbl__payroll_schedule_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_payroll_schedule_view->RowType = ROWTYPE_HEADER;

// Render list options
$_payroll_schedule_view_list->renderListOptions();

// Render list options (header, left)
$_payroll_schedule_view_list->ListOptions->render("header", "left");
?>
<?php if ($_payroll_schedule_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $_payroll_schedule_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh__payroll_schedule_view_LocalAuthority" class="_payroll_schedule_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $_payroll_schedule_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->LocalAuthority) ?>', 1);"><div id="elh__payroll_schedule_view_LocalAuthority" class="_payroll_schedule_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_payroll_schedule_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh__payroll_schedule_view_PayrollPeriod" class="_payroll_schedule_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $_payroll_schedule_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->PayrollPeriod) ?>', 1);"><div id="elh__payroll_schedule_view_PayrollPeriod" class="_payroll_schedule_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->Title->Visible) { // Title ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $_payroll_schedule_view_list->Title->headerCellClass() ?>"><div id="elh__payroll_schedule_view_Title" class="_payroll_schedule_view_Title"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $_payroll_schedule_view_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->Title) ?>', 1);"><div id="elh__payroll_schedule_view_Title" class="_payroll_schedule_view_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->Surname->Visible) { // Surname ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $_payroll_schedule_view_list->Surname->headerCellClass() ?>"><div id="elh__payroll_schedule_view_Surname" class="_payroll_schedule_view_Surname"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $_payroll_schedule_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->Surname) ?>', 1);"><div id="elh__payroll_schedule_view_Surname" class="_payroll_schedule_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $_payroll_schedule_view_list->FirstName->headerCellClass() ?>"><div id="elh__payroll_schedule_view_FirstName" class="_payroll_schedule_view_FirstName"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $_payroll_schedule_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->FirstName) ?>', 1);"><div id="elh__payroll_schedule_view_FirstName" class="_payroll_schedule_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $_payroll_schedule_view_list->MiddleName->headerCellClass() ?>"><div id="elh__payroll_schedule_view_MiddleName" class="_payroll_schedule_view_MiddleName"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $_payroll_schedule_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->MiddleName) ?>', 1);"><div id="elh__payroll_schedule_view_MiddleName" class="_payroll_schedule_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $_payroll_schedule_view_list->PositionName->headerCellClass() ?>"><div id="elh__payroll_schedule_view_PositionName" class="_payroll_schedule_view_PositionName"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $_payroll_schedule_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->PositionName) ?>', 1);"><div id="elh__payroll_schedule_view_PositionName" class="_payroll_schedule_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->pCode->Visible) { // pCode ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->pCode) == "") { ?>
		<th data-name="pCode" class="<?php echo $_payroll_schedule_view_list->pCode->headerCellClass() ?>"><div id="elh__payroll_schedule_view_pCode" class="_payroll_schedule_view_pCode"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->pCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pCode" class="<?php echo $_payroll_schedule_view_list->pCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->pCode) ?>', 1);"><div id="elh__payroll_schedule_view_pCode" class="_payroll_schedule_view_pCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->pCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->pCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->pCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->pName->Visible) { // pName ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->pName) == "") { ?>
		<th data-name="pName" class="<?php echo $_payroll_schedule_view_list->pName->headerCellClass() ?>"><div id="elh__payroll_schedule_view_pName" class="_payroll_schedule_view_pName"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->pName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pName" class="<?php echo $_payroll_schedule_view_list->pName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->pName) ?>', 1);"><div id="elh__payroll_schedule_view_pName" class="_payroll_schedule_view_pName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->pName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->Amount->Visible) { // Amount ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->Amount) == "") { ?>
		<th data-name="Amount" class="<?php echo $_payroll_schedule_view_list->Amount->headerCellClass() ?>"><div id="elh__payroll_schedule_view_Amount" class="_payroll_schedule_view_Amount"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Amount" class="<?php echo $_payroll_schedule_view_list->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->Amount) ?>', 1);"><div id="elh__payroll_schedule_view_Amount" class="_payroll_schedule_view_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $_payroll_schedule_view_list->PaymentMethod->headerCellClass() ?>"><div id="elh__payroll_schedule_view_PaymentMethod" class="_payroll_schedule_view_PaymentMethod"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $_payroll_schedule_view_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->PaymentMethod) ?>', 1);"><div id="elh__payroll_schedule_view_PaymentMethod" class="_payroll_schedule_view_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->BankBranchCode) == "") { ?>
		<th data-name="BankBranchCode" class="<?php echo $_payroll_schedule_view_list->BankBranchCode->headerCellClass() ?>"><div id="elh__payroll_schedule_view_BankBranchCode" class="_payroll_schedule_view_BankBranchCode"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankBranchCode" class="<?php echo $_payroll_schedule_view_list->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->BankBranchCode) ?>', 1);"><div id="elh__payroll_schedule_view_BankBranchCode" class="_payroll_schedule_view_BankBranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->BankBranchCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $_payroll_schedule_view_list->BankAccountNo->headerCellClass() ?>"><div id="elh__payroll_schedule_view_BankAccountNo" class="_payroll_schedule_view_BankAccountNo"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $_payroll_schedule_view_list->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->BankAccountNo) ?>', 1);"><div id="elh__payroll_schedule_view_BankAccountNo" class="_payroll_schedule_view_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->BankAccountNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->ThirdPartyPayMethod->Visible) { // ThirdPartyPayMethod ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->ThirdPartyPayMethod) == "") { ?>
		<th data-name="ThirdPartyPayMethod" class="<?php echo $_payroll_schedule_view_list->ThirdPartyPayMethod->headerCellClass() ?>"><div id="elh__payroll_schedule_view_ThirdPartyPayMethod" class="_payroll_schedule_view_ThirdPartyPayMethod"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->ThirdPartyPayMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdPartyPayMethod" class="<?php echo $_payroll_schedule_view_list->ThirdPartyPayMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->ThirdPartyPayMethod) ?>', 1);"><div id="elh__payroll_schedule_view_ThirdPartyPayMethod" class="_payroll_schedule_view_ThirdPartyPayMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->ThirdPartyPayMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->ThirdPartyPayMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->ThirdPartyPayMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->ThirdPartyBank->Visible) { // ThirdPartyBank ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->ThirdPartyBank) == "") { ?>
		<th data-name="ThirdPartyBank" class="<?php echo $_payroll_schedule_view_list->ThirdPartyBank->headerCellClass() ?>"><div id="elh__payroll_schedule_view_ThirdPartyBank" class="_payroll_schedule_view_ThirdPartyBank"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->ThirdPartyBank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdPartyBank" class="<?php echo $_payroll_schedule_view_list->ThirdPartyBank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->ThirdPartyBank) ?>', 1);"><div id="elh__payroll_schedule_view_ThirdPartyBank" class="_payroll_schedule_view_ThirdPartyBank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->ThirdPartyBank->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->ThirdPartyBank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->ThirdPartyBank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_payroll_schedule_view_list->ThirdPartyAccount->Visible) { // ThirdPartyAccount ?>
	<?php if ($_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->ThirdPartyAccount) == "") { ?>
		<th data-name="ThirdPartyAccount" class="<?php echo $_payroll_schedule_view_list->ThirdPartyAccount->headerCellClass() ?>"><div id="elh__payroll_schedule_view_ThirdPartyAccount" class="_payroll_schedule_view_ThirdPartyAccount"><div class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->ThirdPartyAccount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdPartyAccount" class="<?php echo $_payroll_schedule_view_list->ThirdPartyAccount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_payroll_schedule_view_list->SortUrl($_payroll_schedule_view_list->ThirdPartyAccount) ?>', 1);"><div id="elh__payroll_schedule_view_ThirdPartyAccount" class="_payroll_schedule_view_ThirdPartyAccount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_payroll_schedule_view_list->ThirdPartyAccount->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_payroll_schedule_view_list->ThirdPartyAccount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_payroll_schedule_view_list->ThirdPartyAccount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_payroll_schedule_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_payroll_schedule_view_list->ExportAll && $_payroll_schedule_view_list->isExport()) {
	$_payroll_schedule_view_list->StopRecord = $_payroll_schedule_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_payroll_schedule_view_list->TotalRecords > $_payroll_schedule_view_list->StartRecord + $_payroll_schedule_view_list->DisplayRecords - 1)
		$_payroll_schedule_view_list->StopRecord = $_payroll_schedule_view_list->StartRecord + $_payroll_schedule_view_list->DisplayRecords - 1;
	else
		$_payroll_schedule_view_list->StopRecord = $_payroll_schedule_view_list->TotalRecords;
}
$_payroll_schedule_view_list->RecordCount = $_payroll_schedule_view_list->StartRecord - 1;
if ($_payroll_schedule_view_list->Recordset && !$_payroll_schedule_view_list->Recordset->EOF) {
	$_payroll_schedule_view_list->Recordset->moveFirst();
	$selectLimit = $_payroll_schedule_view_list->UseSelectLimit;
	if (!$selectLimit && $_payroll_schedule_view_list->StartRecord > 1)
		$_payroll_schedule_view_list->Recordset->move($_payroll_schedule_view_list->StartRecord - 1);
} elseif (!$_payroll_schedule_view->AllowAddDeleteRow && $_payroll_schedule_view_list->StopRecord == 0) {
	$_payroll_schedule_view_list->StopRecord = $_payroll_schedule_view->GridAddRowCount;
}

// Initialize aggregate
$_payroll_schedule_view->RowType = ROWTYPE_AGGREGATEINIT;
$_payroll_schedule_view->resetAttributes();
$_payroll_schedule_view_list->renderRow();
while ($_payroll_schedule_view_list->RecordCount < $_payroll_schedule_view_list->StopRecord) {
	$_payroll_schedule_view_list->RecordCount++;
	if ($_payroll_schedule_view_list->RecordCount >= $_payroll_schedule_view_list->StartRecord) {
		$_payroll_schedule_view_list->RowCount++;

		// Set up key count
		$_payroll_schedule_view_list->KeyCount = $_payroll_schedule_view_list->RowIndex;

		// Init row class and style
		$_payroll_schedule_view->resetAttributes();
		$_payroll_schedule_view->CssClass = "";
		if ($_payroll_schedule_view_list->isGridAdd()) {
		} else {
			$_payroll_schedule_view_list->loadRowValues($_payroll_schedule_view_list->Recordset); // Load row values
		}
		$_payroll_schedule_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_payroll_schedule_view->RowAttrs->merge(["data-rowindex" => $_payroll_schedule_view_list->RowCount, "id" => "r" . $_payroll_schedule_view_list->RowCount . "__payroll_schedule_view", "data-rowtype" => $_payroll_schedule_view->RowType]);

		// Render row
		$_payroll_schedule_view_list->renderRow();

		// Render list options
		$_payroll_schedule_view_list->renderListOptions();
?>
	<tr <?php echo $_payroll_schedule_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_payroll_schedule_view_list->ListOptions->render("body", "left", $_payroll_schedule_view_list->RowCount);
?>
	<?php if ($_payroll_schedule_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $_payroll_schedule_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_LocalAuthority">
<span<?php echo $_payroll_schedule_view_list->LocalAuthority->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $_payroll_schedule_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_PayrollPeriod">
<span<?php echo $_payroll_schedule_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $_payroll_schedule_view_list->Title->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_Title">
<span<?php echo $_payroll_schedule_view_list->Title->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $_payroll_schedule_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_Surname">
<span<?php echo $_payroll_schedule_view_list->Surname->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $_payroll_schedule_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_FirstName">
<span<?php echo $_payroll_schedule_view_list->FirstName->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $_payroll_schedule_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_MiddleName">
<span<?php echo $_payroll_schedule_view_list->MiddleName->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $_payroll_schedule_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_PositionName">
<span<?php echo $_payroll_schedule_view_list->PositionName->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->pCode->Visible) { // pCode ?>
		<td data-name="pCode" <?php echo $_payroll_schedule_view_list->pCode->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_pCode">
<span<?php echo $_payroll_schedule_view_list->pCode->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->pCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->pName->Visible) { // pName ?>
		<td data-name="pName" <?php echo $_payroll_schedule_view_list->pName->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_pName">
<span<?php echo $_payroll_schedule_view_list->pName->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->pName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->Amount->Visible) { // Amount ?>
		<td data-name="Amount" <?php echo $_payroll_schedule_view_list->Amount->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_Amount">
<span<?php echo $_payroll_schedule_view_list->Amount->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->Amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $_payroll_schedule_view_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_PaymentMethod">
<span<?php echo $_payroll_schedule_view_list->PaymentMethod->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode" <?php echo $_payroll_schedule_view_list->BankBranchCode->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_BankBranchCode">
<span<?php echo $_payroll_schedule_view_list->BankBranchCode->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->BankBranchCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $_payroll_schedule_view_list->BankAccountNo->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_BankAccountNo">
<span<?php echo $_payroll_schedule_view_list->BankAccountNo->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->BankAccountNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->ThirdPartyPayMethod->Visible) { // ThirdPartyPayMethod ?>
		<td data-name="ThirdPartyPayMethod" <?php echo $_payroll_schedule_view_list->ThirdPartyPayMethod->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_ThirdPartyPayMethod">
<span<?php echo $_payroll_schedule_view_list->ThirdPartyPayMethod->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->ThirdPartyPayMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->ThirdPartyBank->Visible) { // ThirdPartyBank ?>
		<td data-name="ThirdPartyBank" <?php echo $_payroll_schedule_view_list->ThirdPartyBank->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_ThirdPartyBank">
<span<?php echo $_payroll_schedule_view_list->ThirdPartyBank->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->ThirdPartyBank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_payroll_schedule_view_list->ThirdPartyAccount->Visible) { // ThirdPartyAccount ?>
		<td data-name="ThirdPartyAccount" <?php echo $_payroll_schedule_view_list->ThirdPartyAccount->cellAttributes() ?>>
<span id="el<?php echo $_payroll_schedule_view_list->RowCount ?>__payroll_schedule_view_ThirdPartyAccount">
<span<?php echo $_payroll_schedule_view_list->ThirdPartyAccount->viewAttributes() ?>><?php echo $_payroll_schedule_view_list->ThirdPartyAccount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_payroll_schedule_view_list->ListOptions->render("body", "right", $_payroll_schedule_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_payroll_schedule_view_list->isGridAdd())
		$_payroll_schedule_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_payroll_schedule_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_payroll_schedule_view_list->Recordset)
	$_payroll_schedule_view_list->Recordset->Close();
?>
<?php if (!$_payroll_schedule_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_payroll_schedule_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_payroll_schedule_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_payroll_schedule_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_payroll_schedule_view_list->TotalRecords == 0 && !$_payroll_schedule_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_payroll_schedule_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_payroll_schedule_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_payroll_schedule_view_list->isExport()) { ?>
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
$_payroll_schedule_view_list->terminate();
?>