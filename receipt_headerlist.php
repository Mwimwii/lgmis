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
$receipt_header_list = new receipt_header_list();

// Run the page
$receipt_header_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_header_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$receipt_header_list->isExport()) { ?>
<script>
var freceipt_headerlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freceipt_headerlist = currentForm = new ew.Form("freceipt_headerlist", "list");
	freceipt_headerlist.formKeyCountName = '<?php echo $receipt_header_list->FormKeyCountName ?>';
	loadjs.done("freceipt_headerlist");
});
var freceipt_headerlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freceipt_headerlistsrch = currentSearchForm = new ew.Form("freceipt_headerlistsrch");

	// Validate function for search
	freceipt_headerlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_list->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_list->ReceiptNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_header_list->ReceiptDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	freceipt_headerlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceipt_headerlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceipt_headerlistsrch.lists["x_ChargeGroup"] = <?php echo $receipt_header_list->ChargeGroup->Lookup->toClientList($receipt_header_list) ?>;
	freceipt_headerlistsrch.lists["x_ChargeGroup"].options = <?php echo JsonEncode($receipt_header_list->ChargeGroup->lookupOptions()) ?>;
	freceipt_headerlistsrch.lists["x_ClientSerNo"] = <?php echo $receipt_header_list->ClientSerNo->Lookup->toClientList($receipt_header_list) ?>;
	freceipt_headerlistsrch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_header_list->ClientSerNo->lookupOptions()) ?>;
	freceipt_headerlistsrch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipt_headerlistsrch.lists["x_PaymentMethod"] = <?php echo $receipt_header_list->PaymentMethod->Lookup->toClientList($receipt_header_list) ?>;
	freceipt_headerlistsrch.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipt_header_list->PaymentMethod->lookupOptions()) ?>;

	// Filters
	freceipt_headerlistsrch.filterList = <?php echo $receipt_header_list->getFilterList() ?>;
	loadjs.done("freceipt_headerlistsrch");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
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
<?php if (!$receipt_header_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($receipt_header_list->TotalRecords > 0 && $receipt_header_list->ExportOptions->visible()) { ?>
<?php $receipt_header_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_header_list->ImportOptions->visible()) { ?>
<?php $receipt_header_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_header_list->SearchOptions->visible()) { ?>
<?php $receipt_header_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_header_list->FilterOptions->visible()) { ?>
<?php $receipt_header_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$receipt_header_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$receipt_header_list->isExport() && !$receipt_header->CurrentAction) { ?>
<form name="freceipt_headerlistsrch" id="freceipt_headerlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freceipt_headerlistsrch-search-panel" class="<?php echo $receipt_header_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="receipt_header">
	<div class="ew-extended-search">
<?php

// Render search row
$receipt_header->RowType = ROWTYPE_SEARCH;
$receipt_header->resetAttributes();
$receipt_header_list->renderRow();
?>
<?php if ($receipt_header_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php
		$receipt_header_list->SearchColumnCount++;
		if (($receipt_header_list->SearchColumnCount - 1) % $receipt_header_list->SearchFieldsPerRow == 0) {
			$receipt_header_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_header_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeGroup" class="ew-cell form-group">
		<label for="x_ChargeGroup" class="ew-search-caption ew-label"><?php echo $receipt_header_list->ChargeGroup->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		<span id="el_receipt_header_ChargeGroup" class="ew-search-field">
<?php $receipt_header_list->ChargeGroup->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGroup"><?php echo EmptyValue(strval($receipt_header_list->ChargeGroup->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_header_list->ChargeGroup->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_header_list->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_header_list->ChargeGroup->ReadOnly || $receipt_header_list->ChargeGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_header_list->ChargeGroup->Lookup->getParamTag($receipt_header_list, "p_x_ChargeGroup") ?>
<input type="hidden" data-table="receipt_header" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_header_list->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo $receipt_header_list->ChargeGroup->AdvancedSearch->SearchValue ?>"<?php echo $receipt_header_list->ChargeGroup->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_header_list->SearchColumnCount % $receipt_header_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php
		$receipt_header_list->SearchColumnCount++;
		if (($receipt_header_list->SearchColumnCount - 1) % $receipt_header_list->SearchFieldsPerRow == 0) {
			$receipt_header_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_header_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ClientSerNo" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $receipt_header_list->ClientSerNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		<span id="el_receipt_header_ClientSerNo" class="ew-search-field">
<?php
$onchange = $receipt_header_list->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_header_list->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($receipt_header_list->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_header_list->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_header_list->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipt_header_list->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt_header" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipt_header_list->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($receipt_header_list->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipt_headerlistsrch"], function() {
	freceipt_headerlistsrch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $receipt_header_list->ClientSerNo->Lookup->getParamTag($receipt_header_list, "p_x_ClientSerNo") ?>
</span>
	</div>
	<?php if ($receipt_header_list->SearchColumnCount % $receipt_header_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->Cashier->Visible) { // Cashier ?>
	<?php
		$receipt_header_list->SearchColumnCount++;
		if (($receipt_header_list->SearchColumnCount - 1) % $receipt_header_list->SearchFieldsPerRow == 0) {
			$receipt_header_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_header_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Cashier" class="ew-cell form-group">
		<label for="x_Cashier" class="ew-search-caption ew-label"><?php echo $receipt_header_list->Cashier->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Cashier" id="z_Cashier" value="LIKE">
</span>
		<span id="el_receipt_header_Cashier" class="ew-search-field">
<input type="text" data-table="receipt_header" data-field="x_Cashier" name="x_Cashier" id="x_Cashier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_header_list->Cashier->getPlaceHolder()) ?>" value="<?php echo $receipt_header_list->Cashier->EditValue ?>"<?php echo $receipt_header_list->Cashier->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_header_list->SearchColumnCount % $receipt_header_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php
		$receipt_header_list->SearchColumnCount++;
		if (($receipt_header_list->SearchColumnCount - 1) % $receipt_header_list->SearchFieldsPerRow == 0) {
			$receipt_header_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_header_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ReceiptNo" class="ew-cell form-group">
		<label for="x_ReceiptNo" class="ew-search-caption ew-label"><?php echo $receipt_header_list->ReceiptNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptNo" id="z_ReceiptNo" value="=">
</span>
		<span id="el_receipt_header_ReceiptNo" class="ew-search-field">
<input type="text" data-table="receipt_header" data-field="x_ReceiptNo" name="x_ReceiptNo" id="x_ReceiptNo" placeholder="<?php echo HtmlEncode($receipt_header_list->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_header_list->ReceiptNo->EditValue ?>"<?php echo $receipt_header_list->ReceiptNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_header_list->SearchColumnCount % $receipt_header_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php
		$receipt_header_list->SearchColumnCount++;
		if (($receipt_header_list->SearchColumnCount - 1) % $receipt_header_list->SearchFieldsPerRow == 0) {
			$receipt_header_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_header_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ReceiptDate" class="ew-cell form-group">
		<label for="x_ReceiptDate" class="ew-search-caption ew-label"><?php echo $receipt_header_list->ReceiptDate->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="BETWEEN">
</span>
		<span id="el_receipt_header_ReceiptDate" class="ew-search-field">
<input type="text" data-table="receipt_header" data-field="x_ReceiptDate" data-format="7" name="x_ReceiptDate" id="x_ReceiptDate" placeholder="<?php echo HtmlEncode($receipt_header_list->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_header_list->ReceiptDate->EditValue ?>"<?php echo $receipt_header_list->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_header_list->ReceiptDate->ReadOnly && !$receipt_header_list->ReceiptDate->Disabled && !isset($receipt_header_list->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_header_list->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipt_headerlistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipt_headerlistsrch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_receipt_header_ReceiptDate" class="ew-search-field2">
<input type="text" data-table="receipt_header" data-field="x_ReceiptDate" data-format="7" name="y_ReceiptDate" id="y_ReceiptDate" placeholder="<?php echo HtmlEncode($receipt_header_list->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_header_list->ReceiptDate->EditValue2 ?>"<?php echo $receipt_header_list->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_header_list->ReceiptDate->ReadOnly && !$receipt_header_list->ReceiptDate->Disabled && !isset($receipt_header_list->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_header_list->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipt_headerlistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipt_headerlistsrch", "y_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($receipt_header_list->SearchColumnCount % $receipt_header_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php
		$receipt_header_list->SearchColumnCount++;
		if (($receipt_header_list->SearchColumnCount - 1) % $receipt_header_list->SearchFieldsPerRow == 0) {
			$receipt_header_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_header_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PaymentMethod" class="ew-cell form-group">
		<label for="x_PaymentMethod" class="ew-search-caption ew-label"><?php echo $receipt_header_list->PaymentMethod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		<span id="el_receipt_header_PaymentMethod" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PaymentMethod"><?php echo EmptyValue(strval($receipt_header_list->PaymentMethod->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_header_list->PaymentMethod->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_header_list->PaymentMethod->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_header_list->PaymentMethod->ReadOnly || $receipt_header_list->PaymentMethod->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PaymentMethod',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_header_list->PaymentMethod->Lookup->getParamTag($receipt_header_list, "p_x_PaymentMethod") ?>
<input type="hidden" data-table="receipt_header" data-field="x_PaymentMethod" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_header_list->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x_PaymentMethod" id="x_PaymentMethod" value="<?php echo $receipt_header_list->PaymentMethod->AdvancedSearch->SearchValue ?>"<?php echo $receipt_header_list->PaymentMethod->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_header_list->SearchColumnCount % $receipt_header_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($receipt_header_list->SearchColumnCount % $receipt_header_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $receipt_header_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($receipt_header_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($receipt_header_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $receipt_header_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($receipt_header_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($receipt_header_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($receipt_header_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($receipt_header_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $receipt_header_list->showPageHeader(); ?>
<?php
$receipt_header_list->showMessage();
?>
<?php if ($receipt_header_list->TotalRecords > 0 || $receipt_header->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($receipt_header_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> receipt_header">
<?php if (!$receipt_header_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$receipt_header_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_header_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipt_header_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freceipt_headerlist" id="freceipt_headerlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_header">
<div id="gmp_receipt_header" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($receipt_header_list->TotalRecords > 0 || $receipt_header_list->isGridEdit()) { ?>
<table id="tbl_receipt_headerlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$receipt_header->RowType = ROWTYPE_HEADER;

// Render list options
$receipt_header_list->renderListOptions();

// Render list options (header, left)
$receipt_header_list->ListOptions->render("header", "left");
?>
<?php if ($receipt_header_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_header_list->ChargeGroup->headerCellClass() ?>"><div id="elh_receipt_header_ChargeGroup" class="receipt_header_ChargeGroup"><div class="ew-table-header-caption"><?php echo $receipt_header_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_header_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->ChargeGroup) ?>', 1);"><div id="elh_receipt_header_ChargeGroup" class="receipt_header_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_header_list->ClientSerNo->headerCellClass() ?>"><div id="elh_receipt_header_ClientSerNo" class="receipt_header_ClientSerNo"><div class="ew-table-header-caption"><?php echo $receipt_header_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_header_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->ClientSerNo) ?>', 1);"><div id="elh_receipt_header_ClientSerNo" class="receipt_header_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->ReceiptPrefix) == "") { ?>
		<th data-name="ReceiptPrefix" class="<?php echo $receipt_header_list->ReceiptPrefix->headerCellClass() ?>"><div id="elh_receipt_header_ReceiptPrefix" class="receipt_header_ReceiptPrefix"><div class="ew-table-header-caption"><?php echo $receipt_header_list->ReceiptPrefix->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptPrefix" class="<?php echo $receipt_header_list->ReceiptPrefix->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->ReceiptPrefix) ?>', 1);"><div id="elh_receipt_header_ReceiptPrefix" class="receipt_header_ReceiptPrefix">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->ReceiptPrefix->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->ReceiptPrefix->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->ReceiptPrefix->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->AccountBased->Visible) { // AccountBased ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->AccountBased) == "") { ?>
		<th data-name="AccountBased" class="<?php echo $receipt_header_list->AccountBased->headerCellClass() ?>"><div id="elh_receipt_header_AccountBased" class="receipt_header_AccountBased"><div class="ew-table-header-caption"><?php echo $receipt_header_list->AccountBased->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountBased" class="<?php echo $receipt_header_list->AccountBased->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->AccountBased) ?>', 1);"><div id="elh_receipt_header_AccountBased" class="receipt_header_AccountBased">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->AccountBased->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->AccountBased->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->AccountBased->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->Cashier->Visible) { // Cashier ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->Cashier) == "") { ?>
		<th data-name="Cashier" class="<?php echo $receipt_header_list->Cashier->headerCellClass() ?>"><div id="elh_receipt_header_Cashier" class="receipt_header_Cashier"><div class="ew-table-header-caption"><?php echo $receipt_header_list->Cashier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Cashier" class="<?php echo $receipt_header_list->Cashier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->Cashier) ?>', 1);"><div id="elh_receipt_header_Cashier" class="receipt_header_Cashier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->Cashier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->Cashier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->Cashier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_header_list->ReceiptNo->headerCellClass() ?>"><div id="elh_receipt_header_ReceiptNo" class="receipt_header_ReceiptNo"><div class="ew-table-header-caption"><?php echo $receipt_header_list->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_header_list->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->ReceiptNo) ?>', 1);"><div id="elh_receipt_header_ReceiptNo" class="receipt_header_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_header_list->ReceiptDate->headerCellClass() ?>"><div id="elh_receipt_header_ReceiptDate" class="receipt_header_ReceiptDate"><div class="ew-table-header-caption"><?php echo $receipt_header_list->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_header_list->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->ReceiptDate) ?>', 1);"><div id="elh_receipt_header_ReceiptDate" class="receipt_header_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_header_list->PaymentMethod->headerCellClass() ?>"><div id="elh_receipt_header_PaymentMethod" class="receipt_header_PaymentMethod"><div class="ew-table-header-caption"><?php echo $receipt_header_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_header_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->PaymentMethod) ?>', 1);"><div id="elh_receipt_header_PaymentMethod" class="receipt_header_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->PaidBy->Visible) { // PaidBy ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->PaidBy) == "") { ?>
		<th data-name="PaidBy" class="<?php echo $receipt_header_list->PaidBy->headerCellClass() ?>"><div id="elh_receipt_header_PaidBy" class="receipt_header_PaidBy"><div class="ew-table-header-caption"><?php echo $receipt_header_list->PaidBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaidBy" class="<?php echo $receipt_header_list->PaidBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->PaidBy) ?>', 1);"><div id="elh_receipt_header_PaidBy" class="receipt_header_PaidBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->PaidBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->PaidBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->PaidBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->TotalDue->Visible) { // TotalDue ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->TotalDue) == "") { ?>
		<th data-name="TotalDue" class="<?php echo $receipt_header_list->TotalDue->headerCellClass() ?>"><div id="elh_receipt_header_TotalDue" class="receipt_header_TotalDue"><div class="ew-table-header-caption"><?php echo $receipt_header_list->TotalDue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDue" class="<?php echo $receipt_header_list->TotalDue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->TotalDue) ?>', 1);"><div id="elh_receipt_header_TotalDue" class="receipt_header_TotalDue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->TotalDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->TotalDue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->TotalDue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->AmountTendered->Visible) { // AmountTendered ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->AmountTendered) == "") { ?>
		<th data-name="AmountTendered" class="<?php echo $receipt_header_list->AmountTendered->headerCellClass() ?>"><div id="elh_receipt_header_AmountTendered" class="receipt_header_AmountTendered"><div class="ew-table-header-caption"><?php echo $receipt_header_list->AmountTendered->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountTendered" class="<?php echo $receipt_header_list->AmountTendered->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->AmountTendered) ?>', 1);"><div id="elh_receipt_header_AmountTendered" class="receipt_header_AmountTendered">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->AmountTendered->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->AmountTendered->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->AmountTendered->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->Change->Visible) { // Change ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->Change) == "") { ?>
		<th data-name="Change" class="<?php echo $receipt_header_list->Change->headerCellClass() ?>"><div id="elh_receipt_header_Change" class="receipt_header_Change"><div class="ew-table-header-caption"><?php echo $receipt_header_list->Change->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Change" class="<?php echo $receipt_header_list->Change->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->Change) ?>', 1);"><div id="elh_receipt_header_Change" class="receipt_header_Change">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->Change->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->Change->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->Change->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_header_list->ClientMessage->Visible) { // ClientMessage ?>
	<?php if ($receipt_header_list->SortUrl($receipt_header_list->ClientMessage) == "") { ?>
		<th data-name="ClientMessage" class="<?php echo $receipt_header_list->ClientMessage->headerCellClass() ?>"><div id="elh_receipt_header_ClientMessage" class="receipt_header_ClientMessage"><div class="ew-table-header-caption"><?php echo $receipt_header_list->ClientMessage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientMessage" class="<?php echo $receipt_header_list->ClientMessage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_header_list->SortUrl($receipt_header_list->ClientMessage) ?>', 1);"><div id="elh_receipt_header_ClientMessage" class="receipt_header_ClientMessage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_header_list->ClientMessage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_header_list->ClientMessage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_header_list->ClientMessage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipt_header_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($receipt_header_list->ExportAll && $receipt_header_list->isExport()) {
	$receipt_header_list->StopRecord = $receipt_header_list->TotalRecords;
} else {

	// Set the last record to display
	if ($receipt_header_list->TotalRecords > $receipt_header_list->StartRecord + $receipt_header_list->DisplayRecords - 1)
		$receipt_header_list->StopRecord = $receipt_header_list->StartRecord + $receipt_header_list->DisplayRecords - 1;
	else
		$receipt_header_list->StopRecord = $receipt_header_list->TotalRecords;
}
$receipt_header_list->RecordCount = $receipt_header_list->StartRecord - 1;
if ($receipt_header_list->Recordset && !$receipt_header_list->Recordset->EOF) {
	$receipt_header_list->Recordset->moveFirst();
	$selectLimit = $receipt_header_list->UseSelectLimit;
	if (!$selectLimit && $receipt_header_list->StartRecord > 1)
		$receipt_header_list->Recordset->move($receipt_header_list->StartRecord - 1);
} elseif (!$receipt_header->AllowAddDeleteRow && $receipt_header_list->StopRecord == 0) {
	$receipt_header_list->StopRecord = $receipt_header->GridAddRowCount;
}

// Initialize aggregate
$receipt_header->RowType = ROWTYPE_AGGREGATEINIT;
$receipt_header->resetAttributes();
$receipt_header_list->renderRow();
while ($receipt_header_list->RecordCount < $receipt_header_list->StopRecord) {
	$receipt_header_list->RecordCount++;
	if ($receipt_header_list->RecordCount >= $receipt_header_list->StartRecord) {
		$receipt_header_list->RowCount++;

		// Set up key count
		$receipt_header_list->KeyCount = $receipt_header_list->RowIndex;

		// Init row class and style
		$receipt_header->resetAttributes();
		$receipt_header->CssClass = "";
		if ($receipt_header_list->isGridAdd()) {
		} else {
			$receipt_header_list->loadRowValues($receipt_header_list->Recordset); // Load row values
		}
		$receipt_header->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$receipt_header->RowAttrs->merge(["data-rowindex" => $receipt_header_list->RowCount, "id" => "r" . $receipt_header_list->RowCount . "_receipt_header", "data-rowtype" => $receipt_header->RowType]);

		// Render row
		$receipt_header_list->renderRow();

		// Render list options
		$receipt_header_list->renderListOptions();
?>
	<tr <?php echo $receipt_header->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipt_header_list->ListOptions->render("body", "left", $receipt_header_list->RowCount);
?>
	<?php if ($receipt_header_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $receipt_header_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_ChargeGroup">
<span<?php echo $receipt_header_list->ChargeGroup->viewAttributes() ?>><?php echo $receipt_header_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $receipt_header_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_ClientSerNo">
<span<?php echo $receipt_header_list->ClientSerNo->viewAttributes() ?>><?php echo $receipt_header_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->ReceiptPrefix->Visible) { // ReceiptPrefix ?>
		<td data-name="ReceiptPrefix" <?php echo $receipt_header_list->ReceiptPrefix->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_ReceiptPrefix">
<span<?php echo $receipt_header_list->ReceiptPrefix->viewAttributes() ?>><?php echo $receipt_header_list->ReceiptPrefix->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->AccountBased->Visible) { // AccountBased ?>
		<td data-name="AccountBased" <?php echo $receipt_header_list->AccountBased->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_AccountBased">
<span<?php echo $receipt_header_list->AccountBased->viewAttributes() ?>><?php echo $receipt_header_list->AccountBased->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->Cashier->Visible) { // Cashier ?>
		<td data-name="Cashier" <?php echo $receipt_header_list->Cashier->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_Cashier">
<span<?php echo $receipt_header_list->Cashier->viewAttributes() ?>><?php echo $receipt_header_list->Cashier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $receipt_header_list->ReceiptNo->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_ReceiptNo">
<span<?php echo $receipt_header_list->ReceiptNo->viewAttributes() ?>><?php echo $receipt_header_list->ReceiptNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $receipt_header_list->ReceiptDate->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_ReceiptDate">
<span<?php echo $receipt_header_list->ReceiptDate->viewAttributes() ?>><?php echo $receipt_header_list->ReceiptDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $receipt_header_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_PaymentMethod">
<span<?php echo $receipt_header_list->PaymentMethod->viewAttributes() ?>><?php echo $receipt_header_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->PaidBy->Visible) { // PaidBy ?>
		<td data-name="PaidBy" <?php echo $receipt_header_list->PaidBy->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_PaidBy">
<span<?php echo $receipt_header_list->PaidBy->viewAttributes() ?>><?php echo $receipt_header_list->PaidBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->TotalDue->Visible) { // TotalDue ?>
		<td data-name="TotalDue" <?php echo $receipt_header_list->TotalDue->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_TotalDue">
<span<?php echo $receipt_header_list->TotalDue->viewAttributes() ?>><?php echo $receipt_header_list->TotalDue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->AmountTendered->Visible) { // AmountTendered ?>
		<td data-name="AmountTendered" <?php echo $receipt_header_list->AmountTendered->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_AmountTendered">
<span<?php echo $receipt_header_list->AmountTendered->viewAttributes() ?>><?php echo $receipt_header_list->AmountTendered->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->Change->Visible) { // Change ?>
		<td data-name="Change" <?php echo $receipt_header_list->Change->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_Change">
<span<?php echo $receipt_header_list->Change->viewAttributes() ?>><?php echo $receipt_header_list->Change->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_header_list->ClientMessage->Visible) { // ClientMessage ?>
		<td data-name="ClientMessage" <?php echo $receipt_header_list->ClientMessage->cellAttributes() ?>>
<span id="el<?php echo $receipt_header_list->RowCount ?>_receipt_header_ClientMessage">
<span<?php echo $receipt_header_list->ClientMessage->viewAttributes() ?>><?php echo $receipt_header_list->ClientMessage->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipt_header_list->ListOptions->render("body", "right", $receipt_header_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$receipt_header_list->isGridAdd())
		$receipt_header_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$receipt_header->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($receipt_header_list->Recordset)
	$receipt_header_list->Recordset->Close();
?>
<?php if (!$receipt_header_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$receipt_header_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_header_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipt_header_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($receipt_header_list->TotalRecords == 0 && !$receipt_header->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $receipt_header_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$receipt_header_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$receipt_header_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$receipt_header->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_receipt_header",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$receipt_header_list->terminate();
?>