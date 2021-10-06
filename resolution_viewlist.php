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
$resolution_view_list = new resolution_view_list();

// Run the page
$resolution_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$resolution_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$resolution_view_list->isExport()) { ?>
<script>
var fresolution_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fresolution_viewlist = currentForm = new ew.Form("fresolution_viewlist", "list");
	fresolution_viewlist.formKeyCountName = '<?php echo $resolution_view_list->FormKeyCountName ?>';
	loadjs.done("fresolution_viewlist");
});
var fresolution_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fresolution_viewlistsrch = currentSearchForm = new ew.Form("fresolution_viewlistsrch");

	// Validate function for search
	fresolution_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_MeetingType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($resolution_view_list->MeetingType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($resolution_view_list->ActualDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fresolution_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fresolution_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fresolution_viewlistsrch.lists["x_ProvinceCode"] = <?php echo $resolution_view_list->ProvinceCode->Lookup->toClientList($resolution_view_list) ?>;
	fresolution_viewlistsrch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($resolution_view_list->ProvinceCode->lookupOptions()) ?>;

	// Filters
	fresolution_viewlistsrch.filterList = <?php echo $resolution_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fresolution_viewlistsrch.initSearchPanel = true;
	loadjs.done("fresolution_viewlistsrch");
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
<?php if (!$resolution_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($resolution_view_list->TotalRecords > 0 && $resolution_view_list->ExportOptions->visible()) { ?>
<?php $resolution_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($resolution_view_list->ImportOptions->visible()) { ?>
<?php $resolution_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($resolution_view_list->SearchOptions->visible()) { ?>
<?php $resolution_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($resolution_view_list->FilterOptions->visible()) { ?>
<?php $resolution_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$resolution_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$resolution_view_list->isExport() && !$resolution_view->CurrentAction) { ?>
<form name="fresolution_viewlistsrch" id="fresolution_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fresolution_viewlistsrch-search-panel" class="<?php echo $resolution_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="resolution_view">
	<div class="ew-extended-search">
<?php

// Render search row
$resolution_view->RowType = ROWTYPE_SEARCH;
$resolution_view->resetAttributes();
$resolution_view_list->renderRow();
?>
<?php if ($resolution_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ProvinceCode" class="ew-cell form-group">
		<label for="x_ProvinceCode" class="ew-search-caption ew-label"><?php echo $resolution_view_list->ProvinceCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		<span id="el_resolution_view_ProvinceCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="resolution_view" data-field="x_ProvinceCode" data-value-separator="<?php echo $resolution_view_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $resolution_view_list->ProvinceCode->editAttributes() ?>>
			<?php echo $resolution_view_list->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $resolution_view_list->ProvinceCode->Lookup->getParamTag($resolution_view_list, "p_x_ProvinceCode") ?>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->LAName->Visible) { // LAName ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LAName" class="ew-cell form-group">
		<label for="x_LAName" class="ew-search-caption ew-label"><?php echo $resolution_view_list->LAName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		<span id="el_resolution_view_LAName" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_LAName" name="x_LAName" id="x_LAName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($resolution_view_list->LAName->getPlaceHolder()) ?>" value="<?php echo $resolution_view_list->LAName->EditValue ?>"<?php echo $resolution_view_list->LAName->editAttributes() ?>>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MeetingType->Visible) { // MeetingType ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_MeetingType" class="ew-cell form-group">
		<label for="x_MeetingType" class="ew-search-caption ew-label"><?php echo $resolution_view_list->MeetingType->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MeetingType" id="z_MeetingType" value="=">
</span>
		<span id="el_resolution_view_MeetingType" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MeetingType" name="x_MeetingType" id="x_MeetingType" size="30" placeholder="<?php echo HtmlEncode($resolution_view_list->MeetingType->getPlaceHolder()) ?>" value="<?php echo $resolution_view_list->MeetingType->EditValue ?>"<?php echo $resolution_view_list->MeetingType->editAttributes() ?>>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->ActualDate->Visible) { // ActualDate ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ActualDate" class="ew-cell form-group">
		<label for="x_ActualDate" class="ew-search-caption ew-label"><?php echo $resolution_view_list->ActualDate->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualDate" id="z_ActualDate" value="=">
</span>
		<span id="el_resolution_view_ActualDate" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_ActualDate" name="x_ActualDate" id="x_ActualDate" placeholder="<?php echo HtmlEncode($resolution_view_list->ActualDate->getPlaceHolder()) ?>" value="<?php echo $resolution_view_list->ActualDate->EditValue ?>"<?php echo $resolution_view_list->ActualDate->editAttributes() ?>>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MeetingTypeName->Visible) { // MeetingTypeName ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_MeetingTypeName" class="ew-cell form-group">
		<label for="x_MeetingTypeName" class="ew-search-caption ew-label"><?php echo $resolution_view_list->MeetingTypeName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MeetingTypeName" id="z_MeetingTypeName" value="LIKE">
</span>
		<span id="el_resolution_view_MeetingTypeName" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MeetingTypeName" name="x_MeetingTypeName" id="x_MeetingTypeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_view_list->MeetingTypeName->getPlaceHolder()) ?>" value="<?php echo $resolution_view_list->MeetingTypeName->EditValue ?>"<?php echo $resolution_view_list->MeetingTypeName->editAttributes() ?>>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ResolutionCategoryName" class="ew-cell form-group">
		<label for="x_ResolutionCategoryName" class="ew-search-caption ew-label"><?php echo $resolution_view_list->ResolutionCategoryName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ResolutionCategoryName" id="z_ResolutionCategoryName" value="LIKE">
</span>
		<span id="el_resolution_view_ResolutionCategoryName" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_ResolutionCategoryName" name="x_ResolutionCategoryName" id="x_ResolutionCategoryName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_view_list->ResolutionCategoryName->getPlaceHolder()) ?>" value="<?php echo $resolution_view_list->ResolutionCategoryName->EditValue ?>"<?php echo $resolution_view_list->ResolutionCategoryName->editAttributes() ?>>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MinuteNumber->Visible) { // MinuteNumber ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_MinuteNumber" class="ew-cell form-group">
		<label for="x_MinuteNumber" class="ew-search-caption ew-label"><?php echo $resolution_view_list->MinuteNumber->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MinuteNumber" id="z_MinuteNumber" value="LIKE">
</span>
		<span id="el_resolution_view_MinuteNumber" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_MinuteNumber" name="x_MinuteNumber" id="x_MinuteNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($resolution_view_list->MinuteNumber->getPlaceHolder()) ?>" value="<?php echo $resolution_view_list->MinuteNumber->EditValue ?>"<?php echo $resolution_view_list->MinuteNumber->editAttributes() ?>>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->Subject->Visible) { // Subject ?>
	<?php
		$resolution_view_list->SearchColumnCount++;
		if (($resolution_view_list->SearchColumnCount - 1) % $resolution_view_list->SearchFieldsPerRow == 0) {
			$resolution_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Subject" class="ew-cell form-group">
		<label for="x_Subject" class="ew-search-caption ew-label"><?php echo $resolution_view_list->Subject->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Subject" id="z_Subject" value="LIKE">
</span>
		<span id="el_resolution_view_Subject" class="ew-search-field">
<input type="text" data-table="resolution_view" data-field="x_Subject" name="x_Subject" id="x_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($resolution_view_list->Subject->getPlaceHolder()) ?>" value="<?php echo $resolution_view_list->Subject->EditValue ?>"<?php echo $resolution_view_list->Subject->editAttributes() ?>>
</span>
	</div>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($resolution_view_list->SearchColumnCount % $resolution_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $resolution_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($resolution_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($resolution_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $resolution_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($resolution_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($resolution_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($resolution_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($resolution_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $resolution_view_list->showPageHeader(); ?>
<?php
$resolution_view_list->showMessage();
?>
<?php if ($resolution_view_list->TotalRecords > 0 || $resolution_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($resolution_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> resolution_view">
<?php if (!$resolution_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$resolution_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $resolution_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $resolution_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fresolution_viewlist" id="fresolution_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="resolution_view">
<div id="gmp_resolution_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($resolution_view_list->TotalRecords > 0 || $resolution_view_list->isGridEdit()) { ?>
<table id="tbl_resolution_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$resolution_view->RowType = ROWTYPE_HEADER;

// Render list options
$resolution_view_list->renderListOptions();

// Render list options (header, left)
$resolution_view_list->ListOptions->render("header", "left");
?>
<?php if ($resolution_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $resolution_view_list->ProvinceCode->headerCellClass() ?>"><div id="elh_resolution_view_ProvinceCode" class="resolution_view_ProvinceCode"><div class="ew-table-header-caption"><?php echo $resolution_view_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $resolution_view_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->ProvinceCode) ?>', 1);"><div id="elh_resolution_view_ProvinceCode" class="resolution_view_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->LAName->Visible) { // LAName ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $resolution_view_list->LAName->headerCellClass() ?>"><div id="elh_resolution_view_LAName" class="resolution_view_LAName"><div class="ew-table-header-caption"><?php echo $resolution_view_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $resolution_view_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->LAName) ?>', 1);"><div id="elh_resolution_view_LAName" class="resolution_view_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MeetingNo->Visible) { // MeetingNo ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->MeetingNo) == "") { ?>
		<th data-name="MeetingNo" class="<?php echo $resolution_view_list->MeetingNo->headerCellClass() ?>"><div id="elh_resolution_view_MeetingNo" class="resolution_view_MeetingNo"><div class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingNo" class="<?php echo $resolution_view_list->MeetingNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->MeetingNo) ?>', 1);"><div id="elh_resolution_view_MeetingNo" class="resolution_view_MeetingNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->MeetingNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->MeetingNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MeetingRef->Visible) { // MeetingRef ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->MeetingRef) == "") { ?>
		<th data-name="MeetingRef" class="<?php echo $resolution_view_list->MeetingRef->headerCellClass() ?>"><div id="elh_resolution_view_MeetingRef" class="resolution_view_MeetingRef"><div class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingRef" class="<?php echo $resolution_view_list->MeetingRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->MeetingRef) ?>', 1);"><div id="elh_resolution_view_MeetingRef" class="resolution_view_MeetingRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingRef->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->MeetingRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->MeetingRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MeetingType->Visible) { // MeetingType ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->MeetingType) == "") { ?>
		<th data-name="MeetingType" class="<?php echo $resolution_view_list->MeetingType->headerCellClass() ?>"><div id="elh_resolution_view_MeetingType" class="resolution_view_MeetingType"><div class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingType" class="<?php echo $resolution_view_list->MeetingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->MeetingType) ?>', 1);"><div id="elh_resolution_view_MeetingType" class="resolution_view_MeetingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->MeetingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->MeetingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->ActualDate->Visible) { // ActualDate ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->ActualDate) == "") { ?>
		<th data-name="ActualDate" class="<?php echo $resolution_view_list->ActualDate->headerCellClass() ?>"><div id="elh_resolution_view_ActualDate" class="resolution_view_ActualDate"><div class="ew-table-header-caption"><?php echo $resolution_view_list->ActualDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualDate" class="<?php echo $resolution_view_list->ActualDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->ActualDate) ?>', 1);"><div id="elh_resolution_view_ActualDate" class="resolution_view_ActualDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->ActualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->ActualDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->ActualDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MeetingTypeName->Visible) { // MeetingTypeName ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->MeetingTypeName) == "") { ?>
		<th data-name="MeetingTypeName" class="<?php echo $resolution_view_list->MeetingTypeName->headerCellClass() ?>"><div id="elh_resolution_view_MeetingTypeName" class="resolution_view_MeetingTypeName"><div class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingTypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingTypeName" class="<?php echo $resolution_view_list->MeetingTypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->MeetingTypeName) ?>', 1);"><div id="elh_resolution_view_MeetingTypeName" class="resolution_view_MeetingTypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->MeetingTypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->MeetingTypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->MeetingTypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->ResolutionNo->Visible) { // ResolutionNo ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->ResolutionNo) == "") { ?>
		<th data-name="ResolutionNo" class="<?php echo $resolution_view_list->ResolutionNo->headerCellClass() ?>"><div id="elh_resolution_view_ResolutionNo" class="resolution_view_ResolutionNo"><div class="ew-table-header-caption"><?php echo $resolution_view_list->ResolutionNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResolutionNo" class="<?php echo $resolution_view_list->ResolutionNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->ResolutionNo) ?>', 1);"><div id="elh_resolution_view_ResolutionNo" class="resolution_view_ResolutionNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->ResolutionNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->ResolutionNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->ResolutionNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->Responsibility->Visible) { // Responsibility ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->Responsibility) == "") { ?>
		<th data-name="Responsibility" class="<?php echo $resolution_view_list->Responsibility->headerCellClass() ?>"><div id="elh_resolution_view_Responsibility" class="resolution_view_Responsibility"><div class="ew-table-header-caption"><?php echo $resolution_view_list->Responsibility->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Responsibility" class="<?php echo $resolution_view_list->Responsibility->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->Responsibility) ?>', 1);"><div id="elh_resolution_view_Responsibility" class="resolution_view_Responsibility">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->Responsibility->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->Responsibility->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->Responsibility->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->ActionDate->Visible) { // ActionDate ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->ActionDate) == "") { ?>
		<th data-name="ActionDate" class="<?php echo $resolution_view_list->ActionDate->headerCellClass() ?>"><div id="elh_resolution_view_ActionDate" class="resolution_view_ActionDate"><div class="ew-table-header-caption"><?php echo $resolution_view_list->ActionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDate" class="<?php echo $resolution_view_list->ActionDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->ActionDate) ?>', 1);"><div id="elh_resolution_view_ActionDate" class="resolution_view_ActionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->ActionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->ActionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->ResolutionCategoryName) == "") { ?>
		<th data-name="ResolutionCategoryName" class="<?php echo $resolution_view_list->ResolutionCategoryName->headerCellClass() ?>"><div id="elh_resolution_view_ResolutionCategoryName" class="resolution_view_ResolutionCategoryName"><div class="ew-table-header-caption"><?php echo $resolution_view_list->ResolutionCategoryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResolutionCategoryName" class="<?php echo $resolution_view_list->ResolutionCategoryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->ResolutionCategoryName) ?>', 1);"><div id="elh_resolution_view_ResolutionCategoryName" class="resolution_view_ResolutionCategoryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->ResolutionCategoryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->ResolutionCategoryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->ResolutionCategoryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->MinuteNumber->Visible) { // MinuteNumber ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->MinuteNumber) == "") { ?>
		<th data-name="MinuteNumber" class="<?php echo $resolution_view_list->MinuteNumber->headerCellClass() ?>"><div id="elh_resolution_view_MinuteNumber" class="resolution_view_MinuteNumber"><div class="ew-table-header-caption"><?php echo $resolution_view_list->MinuteNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MinuteNumber" class="<?php echo $resolution_view_list->MinuteNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->MinuteNumber) ?>', 1);"><div id="elh_resolution_view_MinuteNumber" class="resolution_view_MinuteNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->MinuteNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->MinuteNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->MinuteNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($resolution_view_list->Subject->Visible) { // Subject ?>
	<?php if ($resolution_view_list->SortUrl($resolution_view_list->Subject) == "") { ?>
		<th data-name="Subject" class="<?php echo $resolution_view_list->Subject->headerCellClass() ?>"><div id="elh_resolution_view_Subject" class="resolution_view_Subject"><div class="ew-table-header-caption"><?php echo $resolution_view_list->Subject->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Subject" class="<?php echo $resolution_view_list->Subject->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $resolution_view_list->SortUrl($resolution_view_list->Subject) ?>', 1);"><div id="elh_resolution_view_Subject" class="resolution_view_Subject">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $resolution_view_list->Subject->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($resolution_view_list->Subject->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($resolution_view_list->Subject->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$resolution_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($resolution_view_list->ExportAll && $resolution_view_list->isExport()) {
	$resolution_view_list->StopRecord = $resolution_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($resolution_view_list->TotalRecords > $resolution_view_list->StartRecord + $resolution_view_list->DisplayRecords - 1)
		$resolution_view_list->StopRecord = $resolution_view_list->StartRecord + $resolution_view_list->DisplayRecords - 1;
	else
		$resolution_view_list->StopRecord = $resolution_view_list->TotalRecords;
}
$resolution_view_list->RecordCount = $resolution_view_list->StartRecord - 1;
if ($resolution_view_list->Recordset && !$resolution_view_list->Recordset->EOF) {
	$resolution_view_list->Recordset->moveFirst();
	$selectLimit = $resolution_view_list->UseSelectLimit;
	if (!$selectLimit && $resolution_view_list->StartRecord > 1)
		$resolution_view_list->Recordset->move($resolution_view_list->StartRecord - 1);
} elseif (!$resolution_view->AllowAddDeleteRow && $resolution_view_list->StopRecord == 0) {
	$resolution_view_list->StopRecord = $resolution_view->GridAddRowCount;
}

// Initialize aggregate
$resolution_view->RowType = ROWTYPE_AGGREGATEINIT;
$resolution_view->resetAttributes();
$resolution_view_list->renderRow();
while ($resolution_view_list->RecordCount < $resolution_view_list->StopRecord) {
	$resolution_view_list->RecordCount++;
	if ($resolution_view_list->RecordCount >= $resolution_view_list->StartRecord) {
		$resolution_view_list->RowCount++;

		// Set up key count
		$resolution_view_list->KeyCount = $resolution_view_list->RowIndex;

		// Init row class and style
		$resolution_view->resetAttributes();
		$resolution_view->CssClass = "";
		if ($resolution_view_list->isGridAdd()) {
		} else {
			$resolution_view_list->loadRowValues($resolution_view_list->Recordset); // Load row values
		}
		$resolution_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$resolution_view->RowAttrs->merge(["data-rowindex" => $resolution_view_list->RowCount, "id" => "r" . $resolution_view_list->RowCount . "_resolution_view", "data-rowtype" => $resolution_view->RowType]);

		// Render row
		$resolution_view_list->renderRow();

		// Render list options
		$resolution_view_list->renderListOptions();
?>
	<tr <?php echo $resolution_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$resolution_view_list->ListOptions->render("body", "left", $resolution_view_list->RowCount);
?>
	<?php if ($resolution_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $resolution_view_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_ProvinceCode">
<span<?php echo $resolution_view_list->ProvinceCode->viewAttributes() ?>><?php echo $resolution_view_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $resolution_view_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_LAName">
<span<?php echo $resolution_view_list->LAName->viewAttributes() ?>><?php echo $resolution_view_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->MeetingNo->Visible) { // MeetingNo ?>
		<td data-name="MeetingNo" <?php echo $resolution_view_list->MeetingNo->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_MeetingNo">
<span<?php echo $resolution_view_list->MeetingNo->viewAttributes() ?>><?php echo $resolution_view_list->MeetingNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->MeetingRef->Visible) { // MeetingRef ?>
		<td data-name="MeetingRef" <?php echo $resolution_view_list->MeetingRef->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_MeetingRef">
<span<?php echo $resolution_view_list->MeetingRef->viewAttributes() ?>><?php echo $resolution_view_list->MeetingRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->MeetingType->Visible) { // MeetingType ?>
		<td data-name="MeetingType" <?php echo $resolution_view_list->MeetingType->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_MeetingType">
<span<?php echo $resolution_view_list->MeetingType->viewAttributes() ?>><?php echo $resolution_view_list->MeetingType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->ActualDate->Visible) { // ActualDate ?>
		<td data-name="ActualDate" <?php echo $resolution_view_list->ActualDate->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_ActualDate">
<span<?php echo $resolution_view_list->ActualDate->viewAttributes() ?>><?php echo $resolution_view_list->ActualDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->MeetingTypeName->Visible) { // MeetingTypeName ?>
		<td data-name="MeetingTypeName" <?php echo $resolution_view_list->MeetingTypeName->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_MeetingTypeName">
<span<?php echo $resolution_view_list->MeetingTypeName->viewAttributes() ?>><?php echo $resolution_view_list->MeetingTypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->ResolutionNo->Visible) { // ResolutionNo ?>
		<td data-name="ResolutionNo" <?php echo $resolution_view_list->ResolutionNo->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_ResolutionNo">
<span<?php echo $resolution_view_list->ResolutionNo->viewAttributes() ?>><?php echo $resolution_view_list->ResolutionNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->Responsibility->Visible) { // Responsibility ?>
		<td data-name="Responsibility" <?php echo $resolution_view_list->Responsibility->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_Responsibility">
<span<?php echo $resolution_view_list->Responsibility->viewAttributes() ?>><?php echo $resolution_view_list->Responsibility->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate" <?php echo $resolution_view_list->ActionDate->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_ActionDate">
<span<?php echo $resolution_view_list->ActionDate->viewAttributes() ?>><?php echo $resolution_view_list->ActionDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
		<td data-name="ResolutionCategoryName" <?php echo $resolution_view_list->ResolutionCategoryName->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_ResolutionCategoryName">
<span<?php echo $resolution_view_list->ResolutionCategoryName->viewAttributes() ?>><?php echo $resolution_view_list->ResolutionCategoryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->MinuteNumber->Visible) { // MinuteNumber ?>
		<td data-name="MinuteNumber" <?php echo $resolution_view_list->MinuteNumber->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_MinuteNumber">
<span<?php echo $resolution_view_list->MinuteNumber->viewAttributes() ?>><?php echo $resolution_view_list->MinuteNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($resolution_view_list->Subject->Visible) { // Subject ?>
		<td data-name="Subject" <?php echo $resolution_view_list->Subject->cellAttributes() ?>>
<span id="el<?php echo $resolution_view_list->RowCount ?>_resolution_view_Subject">
<span<?php echo $resolution_view_list->Subject->viewAttributes() ?>><?php echo $resolution_view_list->Subject->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$resolution_view_list->ListOptions->render("body", "right", $resolution_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$resolution_view_list->isGridAdd())
		$resolution_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$resolution_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($resolution_view_list->Recordset)
	$resolution_view_list->Recordset->Close();
?>
<?php if (!$resolution_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$resolution_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $resolution_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $resolution_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($resolution_view_list->TotalRecords == 0 && !$resolution_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $resolution_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$resolution_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$resolution_view_list->isExport()) { ?>
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
$resolution_view_list->terminate();
?>