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
$property_list = new property_list();

// Run the page
$property_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_list->isExport()) { ?>
<script>
var fpropertylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpropertylist = currentForm = new ew.Form("fpropertylist", "list");
	fpropertylist.formKeyCountName = '<?php echo $property_list->FormKeyCountName ?>';
	loadjs.done("fpropertylist");
});
var fpropertylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpropertylistsrch = currentSearchForm = new ew.Form("fpropertylistsrch");

	// Validate function for search
	fpropertylistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_list->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RateableValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_list->RateableValue->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpropertylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertylistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertylistsrch.lists["x_ClientSerNo"] = <?php echo $property_list->ClientSerNo->Lookup->toClientList($property_list) ?>;
	fpropertylistsrch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($property_list->ClientSerNo->lookupOptions()) ?>;
	fpropertylistsrch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertylistsrch.lists["x_PropertyGroup"] = <?php echo $property_list->PropertyGroup->Lookup->toClientList($property_list) ?>;
	fpropertylistsrch.lists["x_PropertyGroup"].options = <?php echo JsonEncode($property_list->PropertyGroup->lookupOptions()) ?>;
	fpropertylistsrch.lists["x_Location[]"] = <?php echo $property_list->Location->Lookup->toClientList($property_list) ?>;
	fpropertylistsrch.lists["x_Location[]"].options = <?php echo JsonEncode($property_list->Location->lookupOptions()) ?>;
	fpropertylistsrch.lists["x_PropertyUse[]"] = <?php echo $property_list->PropertyUse->Lookup->toClientList($property_list) ?>;
	fpropertylistsrch.lists["x_PropertyUse[]"].options = <?php echo JsonEncode($property_list->PropertyUse->lookupOptions()) ?>;

	// Filters
	fpropertylistsrch.filterList = <?php echo $property_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpropertylistsrch.initSearchPanel = true;
	loadjs.done("fpropertylistsrch");
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
<?php if (!$property_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_list->TotalRecords > 0 && $property_list->ExportOptions->visible()) { ?>
<?php $property_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_list->ImportOptions->visible()) { ?>
<?php $property_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_list->SearchOptions->visible()) { ?>
<?php $property_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_list->FilterOptions->visible()) { ?>
<?php $property_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$property_list->isExport() || Config("EXPORT_MASTER_RECORD") && $property_list->isExport("print")) { ?>
<?php
if ($property_list->DbMasterFilter != "" && $property->getCurrentMasterTable() == "client") {
	if ($property_list->MasterRecordExists) {
		include_once "clientmaster.php";
	}
}
?>
<?php } ?>
<?php
$property_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_list->isExport() && !$property->CurrentAction) { ?>
<form name="fpropertylistsrch" id="fpropertylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpropertylistsrch-search-panel" class="<?php echo $property_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property">
	<div class="ew-extended-search">
<?php

// Render search row
$property->RowType = ROWTYPE_SEARCH;
$property->resetAttributes();
$property_list->renderRow();
?>
<?php if ($property_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php
		$property_list->SearchColumnCount++;
		if (($property_list->SearchColumnCount - 1) % $property_list->SearchFieldsPerRow == 0) {
			$property_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $property_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyNo" class="ew-cell form-group">
		<label for="x_PropertyNo" class="ew-search-caption ew-label"><?php echo $property_list->PropertyNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		<span id="el_property_PropertyNo" class="ew-search-field">
<input type="text" data-table="property" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_list->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_list->PropertyNo->EditValue ?>"<?php echo $property_list->PropertyNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($property_list->SearchColumnCount % $property_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php
		$property_list->SearchColumnCount++;
		if (($property_list->SearchColumnCount - 1) % $property_list->SearchFieldsPerRow == 0) {
			$property_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $property_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ClientSerNo" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $property_list->ClientSerNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		<span id="el_property_ClientSerNo" class="ew-search-field">
<?php
$onchange = $property_list->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_list->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($property_list->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_list->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_list->ClientSerNo->getPlaceHolder()) ?>"<?php echo $property_list->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_list->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_list->ClientSerNo->ReadOnly || $property_list->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_list->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($property_list->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertylistsrch"], function() {
	fpropertylistsrch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $property_list->ClientSerNo->Lookup->getParamTag($property_list, "p_x_ClientSerNo") ?>
</span>
	</div>
	<?php if ($property_list->SearchColumnCount % $property_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php
		$property_list->SearchColumnCount++;
		if (($property_list->SearchColumnCount - 1) % $property_list->SearchFieldsPerRow == 0) {
			$property_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $property_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyGroup" class="ew-cell form-group">
		<label for="x_PropertyGroup" class="ew-search-caption ew-label"><?php echo $property_list->PropertyGroup->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyGroup" id="z_PropertyGroup" value="=">
</span>
		<span id="el_property_PropertyGroup" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PropertyGroup" data-value-separator="<?php echo $property_list->PropertyGroup->displayValueSeparatorAttribute() ?>" id="x_PropertyGroup" name="x_PropertyGroup"<?php echo $property_list->PropertyGroup->editAttributes() ?>>
			<?php echo $property_list->PropertyGroup->selectOptionListHtml("x_PropertyGroup") ?>
		</select>
</div>
<?php echo $property_list->PropertyGroup->Lookup->getParamTag($property_list, "p_x_PropertyGroup") ?>
</span>
	</div>
	<?php if ($property_list->SearchColumnCount % $property_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Location->Visible) { // Location ?>
	<?php
		$property_list->SearchColumnCount++;
		if (($property_list->SearchColumnCount - 1) % $property_list->SearchFieldsPerRow == 0) {
			$property_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $property_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Location" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $property_list->Location->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		<span id="el_property_Location" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Location"><?php echo EmptyValue(strval($property_list->Location->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_list->Location->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_list->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_list->Location->ReadOnly || $property_list->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_list->Location->Lookup->getParamTag($property_list, "p_x_Location") ?>
<input type="hidden" data-table="property" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_list->Location->displayValueSeparatorAttribute() ?>" name="x_Location[]" id="x_Location[]" value="<?php echo $property_list->Location->AdvancedSearch->SearchValue ?>"<?php echo $property_list->Location->editAttributes() ?>>
</span>
	</div>
	<?php if ($property_list->SearchColumnCount % $property_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php
		$property_list->SearchColumnCount++;
		if (($property_list->SearchColumnCount - 1) % $property_list->SearchFieldsPerRow == 0) {
			$property_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $property_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyUse" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $property_list->PropertyUse->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="=">
</span>
		<span id="el_property_PropertyUse" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($property_list->PropertyUse->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_list->PropertyUse->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_list->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_list->PropertyUse->ReadOnly || $property_list->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_list->PropertyUse->Lookup->getParamTag($property_list, "p_x_PropertyUse") ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_list->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse[]" id="x_PropertyUse[]" value="<?php echo $property_list->PropertyUse->AdvancedSearch->SearchValue ?>"<?php echo $property_list->PropertyUse->editAttributes() ?>>
</span>
	</div>
	<?php if ($property_list->SearchColumnCount % $property_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($property_list->RateableValue->Visible) { // RateableValue ?>
	<?php
		$property_list->SearchColumnCount++;
		if (($property_list->SearchColumnCount - 1) % $property_list->SearchFieldsPerRow == 0) {
			$property_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $property_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_RateableValue" class="ew-cell form-group">
		<label for="x_RateableValue" class="ew-search-caption ew-label"><?php echo $property_list->RateableValue->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_RateableValue" id="z_RateableValue" value="BETWEEN">
</span>
		<span id="el_property_RateableValue" class="ew-search-field">
<input type="text" data-table="property" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_list->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_list->RateableValue->EditValue ?>"<?php echo $property_list->RateableValue->editAttributes() ?>>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_property_RateableValue" class="ew-search-field2">
<input type="text" data-table="property" data-field="x_RateableValue" name="y_RateableValue" id="y_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_list->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_list->RateableValue->EditValue2 ?>"<?php echo $property_list->RateableValue->editAttributes() ?>>
</span>
	</div>
	<?php if ($property_list->SearchColumnCount % $property_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($property_list->SearchColumnCount % $property_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $property_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_list->showPageHeader(); ?>
<?php
$property_list->showMessage();
?>
<?php if ($property_list->TotalRecords > 0 || $property->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property">
<?php if (!$property_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpropertylist" id="fpropertylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<?php if ($property->getCurrentMasterTable() == "client" && $property->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($property_list->ClientSerNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_property" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_list->TotalRecords > 0 || $property_list->isGridEdit()) { ?>
<table id="tbl_propertylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property->RowType = ROWTYPE_HEADER;

// Render list options
$property_list->renderListOptions();

// Render list options (header, left)
$property_list->ListOptions->render("header", "left");
?>
<?php if ($property_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property_list->SortUrl($property_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $property_list->PropertyNo->headerCellClass() ?>"><div id="elh_property_PropertyNo" class="property_PropertyNo"><div class="ew-table-header-caption"><?php echo $property_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $property_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->PropertyNo) ?>', 1);"><div id="elh_property_PropertyNo" class="property_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->PropertyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property_list->SortUrl($property_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_list->ClientSerNo->headerCellClass() ?>"><div id="elh_property_ClientSerNo" class="property_ClientSerNo"><div class="ew-table-header-caption"><?php echo $property_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ClientSerNo) ?>', 1);"><div id="elh_property_ClientSerNo" class="property_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ClientID->Visible) { // ClientID ?>
	<?php if ($property_list->SortUrl($property_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $property_list->ClientID->headerCellClass() ?>"><div id="elh_property_ClientID" class="property_ClientID"><div class="ew-table-header-caption"><?php echo $property_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $property_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ClientID) ?>', 1);"><div id="elh_property_ClientID" class="property_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($property_list->SortUrl($property_list->PropertyGroup) == "") { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_list->PropertyGroup->headerCellClass() ?>"><div id="elh_property_PropertyGroup" class="property_PropertyGroup"><div class="ew-table-header-caption"><?php echo $property_list->PropertyGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_list->PropertyGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->PropertyGroup) ?>', 1);"><div id="elh_property_PropertyGroup" class="property_PropertyGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->PropertyGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->PropertyGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyType->Visible) { // PropertyType ?>
	<?php if ($property_list->SortUrl($property_list->PropertyType) == "") { ?>
		<th data-name="PropertyType" class="<?php echo $property_list->PropertyType->headerCellClass() ?>"><div id="elh_property_PropertyType" class="property_PropertyType"><div class="ew-table-header-caption"><?php echo $property_list->PropertyType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyType" class="<?php echo $property_list->PropertyType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->PropertyType) ?>', 1);"><div id="elh_property_PropertyType" class="property_PropertyType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->PropertyType->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->PropertyType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->PropertyType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Location->Visible) { // Location ?>
	<?php if ($property_list->SortUrl($property_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_list->Location->headerCellClass() ?>"><div id="elh_property_Location" class="property_Location"><div class="ew-table-header-caption"><?php echo $property_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Location) ?>', 1);"><div id="elh_property_Location" class="property_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyStatus->Visible) { // PropertyStatus ?>
	<?php if ($property_list->SortUrl($property_list->PropertyStatus) == "") { ?>
		<th data-name="PropertyStatus" class="<?php echo $property_list->PropertyStatus->headerCellClass() ?>"><div id="elh_property_PropertyStatus" class="property_PropertyStatus"><div class="ew-table-header-caption"><?php echo $property_list->PropertyStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyStatus" class="<?php echo $property_list->PropertyStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->PropertyStatus) ?>', 1);"><div id="elh_property_PropertyStatus" class="property_PropertyStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->PropertyStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->PropertyStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->PropertyStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_list->SortUrl($property_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_PropertyUse" class="property_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->PropertyUse) ?>', 1);"><div id="elh_property_PropertyUse" class="property_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<?php if ($property_list->SortUrl($property_list->LandExtentInHA) == "") { ?>
		<th data-name="LandExtentInHA" class="<?php echo $property_list->LandExtentInHA->headerCellClass() ?>"><div id="elh_property_LandExtentInHA" class="property_LandExtentInHA"><div class="ew-table-header-caption"><?php echo $property_list->LandExtentInHA->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandExtentInHA" class="<?php echo $property_list->LandExtentInHA->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->LandExtentInHA) ?>', 1);"><div id="elh_property_LandExtentInHA" class="property_LandExtentInHA">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->LandExtentInHA->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->LandExtentInHA->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->LandExtentInHA->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->RateableValue->Visible) { // RateableValue ?>
	<?php if ($property_list->SortUrl($property_list->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $property_list->RateableValue->headerCellClass() ?>"><div id="elh_property_RateableValue" class="property_RateableValue"><div class="ew-table-header-caption"><?php echo $property_list->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $property_list->RateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->RateableValue) ?>', 1);"><div id="elh_property_RateableValue" class="property_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<?php if ($property_list->SortUrl($property_list->SupplementaryValue) == "") { ?>
		<th data-name="SupplementaryValue" class="<?php echo $property_list->SupplementaryValue->headerCellClass() ?>"><div id="elh_property_SupplementaryValue" class="property_SupplementaryValue"><div class="ew-table-header-caption"><?php echo $property_list->SupplementaryValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplementaryValue" class="<?php echo $property_list->SupplementaryValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->SupplementaryValue) ?>', 1);"><div id="elh_property_SupplementaryValue" class="property_SupplementaryValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->SupplementaryValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->SupplementaryValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->SupplementaryValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($property_list->SortUrl($property_list->ExemptCode) == "") { ?>
		<th data-name="ExemptCode" class="<?php echo $property_list->ExemptCode->headerCellClass() ?>"><div id="elh_property_ExemptCode" class="property_ExemptCode"><div class="ew-table-header-caption"><?php echo $property_list->ExemptCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExemptCode" class="<?php echo $property_list->ExemptCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ExemptCode) ?>', 1);"><div id="elh_property_ExemptCode" class="property_ExemptCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ExemptCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ExemptCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ExemptCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Improvements->Visible) { // Improvements ?>
	<?php if ($property_list->SortUrl($property_list->Improvements) == "") { ?>
		<th data-name="Improvements" class="<?php echo $property_list->Improvements->headerCellClass() ?>"><div id="elh_property_Improvements" class="property_Improvements"><div class="ew-table-header-caption"><?php echo $property_list->Improvements->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Improvements" class="<?php echo $property_list->Improvements->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Improvements) ?>', 1);"><div id="elh_property_Improvements" class="property_Improvements">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Improvements->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->Improvements->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Improvements->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->StreetAddress->Visible) { // StreetAddress ?>
	<?php if ($property_list->SortUrl($property_list->StreetAddress) == "") { ?>
		<th data-name="StreetAddress" class="<?php echo $property_list->StreetAddress->headerCellClass() ?>"><div id="elh_property_StreetAddress" class="property_StreetAddress"><div class="ew-table-header-caption"><?php echo $property_list->StreetAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StreetAddress" class="<?php echo $property_list->StreetAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->StreetAddress) ?>', 1);"><div id="elh_property_StreetAddress" class="property_StreetAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->StreetAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->StreetAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->StreetAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Longitude->Visible) { // Longitude ?>
	<?php if ($property_list->SortUrl($property_list->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $property_list->Longitude->headerCellClass() ?>"><div id="elh_property_Longitude" class="property_Longitude"><div class="ew-table-header-caption"><?php echo $property_list->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $property_list->Longitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Longitude) ?>', 1);"><div id="elh_property_Longitude" class="property_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Latitude->Visible) { // Latitude ?>
	<?php if ($property_list->SortUrl($property_list->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $property_list->Latitude->headerCellClass() ?>"><div id="elh_property_Latitude" class="property_Latitude"><div class="ew-table-header-caption"><?php echo $property_list->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $property_list->Latitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Latitude) ?>', 1);"><div id="elh_property_Latitude" class="property_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Incumberance->Visible) { // Incumberance ?>
	<?php if ($property_list->SortUrl($property_list->Incumberance) == "") { ?>
		<th data-name="Incumberance" class="<?php echo $property_list->Incumberance->headerCellClass() ?>"><div id="elh_property_Incumberance" class="property_Incumberance"><div class="ew-table-header-caption"><?php echo $property_list->Incumberance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Incumberance" class="<?php echo $property_list->Incumberance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Incumberance) ?>', 1);"><div id="elh_property_Incumberance" class="property_Incumberance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Incumberance->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->Incumberance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Incumberance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<?php if ($property_list->SortUrl($property_list->SubDivisionOf) == "") { ?>
		<th data-name="SubDivisionOf" class="<?php echo $property_list->SubDivisionOf->headerCellClass() ?>"><div id="elh_property_SubDivisionOf" class="property_SubDivisionOf"><div class="ew-table-header-caption"><?php echo $property_list->SubDivisionOf->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubDivisionOf" class="<?php echo $property_list->SubDivisionOf->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->SubDivisionOf) ?>', 1);"><div id="elh_property_SubDivisionOf" class="property_SubDivisionOf">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->SubDivisionOf->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->SubDivisionOf->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->SubDivisionOf->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($property_list->SortUrl($property_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_property_LastUpdatedBy" class="property_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $property_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->LastUpdatedBy) ?>', 1);"><div id="elh_property_LastUpdatedBy" class="property_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($property_list->SortUrl($property_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_property_LastUpdateDate" class="property_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $property_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->LastUpdateDate) ?>', 1);"><div id="elh_property_LastUpdateDate" class="property_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_list->SortUrl($property_list->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $property_list->ValuationNo->headerCellClass() ?>"><div id="elh_property_ValuationNo" class="property_ValuationNo"><div class="ew-table-header-caption"><?php echo $property_list->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $property_list->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ValuationNo) ?>', 1);"><div id="elh_property_ValuationNo" class="property_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->LandValue->Visible) { // LandValue ?>
	<?php if ($property_list->SortUrl($property_list->LandValue) == "") { ?>
		<th data-name="LandValue" class="<?php echo $property_list->LandValue->headerCellClass() ?>"><div id="elh_property_LandValue" class="property_LandValue"><div class="ew-table-header-caption"><?php echo $property_list->LandValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandValue" class="<?php echo $property_list->LandValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->LandValue) ?>', 1);"><div id="elh_property_LandValue" class="property_LandValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->LandValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->LandValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->LandValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<?php if ($property_list->SortUrl($property_list->ImprovementsValue) == "") { ?>
		<th data-name="ImprovementsValue" class="<?php echo $property_list->ImprovementsValue->headerCellClass() ?>"><div id="elh_property_ImprovementsValue" class="property_ImprovementsValue"><div class="ew-table-header-caption"><?php echo $property_list->ImprovementsValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ImprovementsValue" class="<?php echo $property_list->ImprovementsValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ImprovementsValue) ?>', 1);"><div id="elh_property_ImprovementsValue" class="property_ImprovementsValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ImprovementsValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ImprovementsValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ImprovementsValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_list->ExportAll && $property_list->isExport()) {
	$property_list->StopRecord = $property_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_list->TotalRecords > $property_list->StartRecord + $property_list->DisplayRecords - 1)
		$property_list->StopRecord = $property_list->StartRecord + $property_list->DisplayRecords - 1;
	else
		$property_list->StopRecord = $property_list->TotalRecords;
}
$property_list->RecordCount = $property_list->StartRecord - 1;
if ($property_list->Recordset && !$property_list->Recordset->EOF) {
	$property_list->Recordset->moveFirst();
	$selectLimit = $property_list->UseSelectLimit;
	if (!$selectLimit && $property_list->StartRecord > 1)
		$property_list->Recordset->move($property_list->StartRecord - 1);
} elseif (!$property->AllowAddDeleteRow && $property_list->StopRecord == 0) {
	$property_list->StopRecord = $property->GridAddRowCount;
}

// Initialize aggregate
$property->RowType = ROWTYPE_AGGREGATEINIT;
$property->resetAttributes();
$property_list->renderRow();
while ($property_list->RecordCount < $property_list->StopRecord) {
	$property_list->RecordCount++;
	if ($property_list->RecordCount >= $property_list->StartRecord) {
		$property_list->RowCount++;

		// Set up key count
		$property_list->KeyCount = $property_list->RowIndex;

		// Init row class and style
		$property->resetAttributes();
		$property->CssClass = "";
		if ($property_list->isGridAdd()) {
		} else {
			$property_list->loadRowValues($property_list->Recordset); // Load row values
		}
		$property->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property->RowAttrs->merge(["data-rowindex" => $property_list->RowCount, "id" => "r" . $property_list->RowCount . "_property", "data-rowtype" => $property->RowType]);

		// Render row
		$property_list->renderRow();

		// Render list options
		$property_list->renderListOptions();
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_list->ListOptions->render("body", "left", $property_list->RowCount);
?>
	<?php if ($property_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $property_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_PropertyNo">
<span<?php echo $property_list->PropertyNo->viewAttributes() ?>><?php echo $property_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $property_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ClientSerNo">
<span<?php echo $property_list->ClientSerNo->viewAttributes() ?>><?php echo $property_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $property_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ClientID">
<span<?php echo $property_list->ClientID->viewAttributes() ?>><?php echo $property_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup" <?php echo $property_list->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_PropertyGroup">
<span<?php echo $property_list->PropertyGroup->viewAttributes() ?>><?php echo $property_list->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType" <?php echo $property_list->PropertyType->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_PropertyType">
<span<?php echo $property_list->PropertyType->viewAttributes() ?>><?php echo $property_list->PropertyType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_list->Location->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Location">
<span<?php echo $property_list->Location->viewAttributes() ?>><?php echo $property_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->PropertyStatus->Visible) { // PropertyStatus ?>
		<td data-name="PropertyStatus" <?php echo $property_list->PropertyStatus->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_PropertyStatus">
<span<?php echo $property_list->PropertyStatus->viewAttributes() ?>><?php echo $property_list->PropertyStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_PropertyUse">
<span<?php echo $property_list->PropertyUse->viewAttributes() ?>><?php echo $property_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td data-name="LandExtentInHA" <?php echo $property_list->LandExtentInHA->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_LandExtentInHA">
<span<?php echo $property_list->LandExtentInHA->viewAttributes() ?>><?php echo $property_list->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $property_list->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_RateableValue">
<span<?php echo $property_list->RateableValue->viewAttributes() ?>><?php echo $property_list->RateableValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<td data-name="SupplementaryValue" <?php echo $property_list->SupplementaryValue->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_SupplementaryValue">
<span<?php echo $property_list->SupplementaryValue->viewAttributes() ?>><?php echo $property_list->SupplementaryValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode" <?php echo $property_list->ExemptCode->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ExemptCode">
<span<?php echo $property_list->ExemptCode->viewAttributes() ?>><?php echo $property_list->ExemptCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Improvements->Visible) { // Improvements ?>
		<td data-name="Improvements" <?php echo $property_list->Improvements->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Improvements">
<span<?php echo $property_list->Improvements->viewAttributes() ?>><?php echo $property_list->Improvements->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->StreetAddress->Visible) { // StreetAddress ?>
		<td data-name="StreetAddress" <?php echo $property_list->StreetAddress->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_StreetAddress">
<span<?php echo $property_list->StreetAddress->viewAttributes() ?>><?php echo $property_list->StreetAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $property_list->Longitude->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Longitude">
<span<?php echo $property_list->Longitude->viewAttributes() ?>><?php echo $property_list->Longitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $property_list->Latitude->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Latitude">
<span<?php echo $property_list->Latitude->viewAttributes() ?>><?php echo $property_list->Latitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Incumberance->Visible) { // Incumberance ?>
		<td data-name="Incumberance" <?php echo $property_list->Incumberance->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Incumberance">
<span<?php echo $property_list->Incumberance->viewAttributes() ?>><?php echo $property_list->Incumberance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->SubDivisionOf->Visible) { // SubDivisionOf ?>
		<td data-name="SubDivisionOf" <?php echo $property_list->SubDivisionOf->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_SubDivisionOf">
<span<?php echo $property_list->SubDivisionOf->viewAttributes() ?>><?php echo $property_list->SubDivisionOf->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $property_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_LastUpdatedBy">
<span<?php echo $property_list->LastUpdatedBy->viewAttributes() ?>><?php echo $property_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $property_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_LastUpdateDate">
<span<?php echo $property_list->LastUpdateDate->viewAttributes() ?>><?php echo $property_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $property_list->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ValuationNo">
<span<?php echo $property_list->ValuationNo->viewAttributes() ?>><?php echo $property_list->ValuationNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue" <?php echo $property_list->LandValue->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_LandValue">
<span<?php echo $property_list->LandValue->viewAttributes() ?>><?php echo $property_list->LandValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue" <?php echo $property_list->ImprovementsValue->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ImprovementsValue">
<span<?php echo $property_list->ImprovementsValue->viewAttributes() ?>><?php echo $property_list->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_list->ListOptions->render("body", "right", $property_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_list->isGridAdd())
		$property_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_list->Recordset)
	$property_list->Recordset->Close();
?>
<?php if (!$property_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_list->TotalRecords == 0 && !$property->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_list->isExport()) { ?>
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
$property_list->terminate();
?>