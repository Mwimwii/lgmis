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
$bill_list = new bill_list();

// Run the page
$bill_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bill_list->isExport()) { ?>
<script>
var fbilllist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbilllist = currentForm = new ew.Form("fbilllist", "list");
	fbilllist.formKeyCountName = '<?php echo $bill_list->FormKeyCountName ?>';
	loadjs.done("fbilllist");
});
var fbilllistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbilllistsrch = currentSearchForm = new ew.Form("fbilllistsrch");

	// Validate function for search
	fbilllistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_list->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_list->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_list->BillYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_list->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountDue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($bill_list->AmountDue->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fbilllistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbilllistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbilllistsrch.lists["x_ClientSerNo"] = <?php echo $bill_list->ClientSerNo->Lookup->toClientList($bill_list) ?>;
	fbilllistsrch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($bill_list->ClientSerNo->lookupOptions()) ?>;
	fbilllistsrch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbilllistsrch.lists["x_ChargeCode"] = <?php echo $bill_list->ChargeCode->Lookup->toClientList($bill_list) ?>;
	fbilllistsrch.lists["x_ChargeCode"].options = <?php echo JsonEncode($bill_list->ChargeCode->lookupOptions()) ?>;
	fbilllistsrch.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbilllistsrch.lists["x_ChargeGroup"] = <?php echo $bill_list->ChargeGroup->Lookup->toClientList($bill_list) ?>;
	fbilllistsrch.lists["x_ChargeGroup"].options = <?php echo JsonEncode($bill_list->ChargeGroup->lookupOptions()) ?>;
	fbilllistsrch.autoSuggests["x_ChargeGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbilllistsrch.lists["x_BillYear"] = <?php echo $bill_list->BillYear->Lookup->toClientList($bill_list) ?>;
	fbilllistsrch.lists["x_BillYear"].options = <?php echo JsonEncode($bill_list->BillYear->lookupOptions()) ?>;
	fbilllistsrch.autoSuggests["x_BillYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbilllistsrch.lists["x_BillPeriod"] = <?php echo $bill_list->BillPeriod->Lookup->toClientList($bill_list) ?>;
	fbilllistsrch.lists["x_BillPeriod"].options = <?php echo JsonEncode($bill_list->BillPeriod->lookupOptions()) ?>;
	fbilllistsrch.autoSuggests["x_BillPeriod"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fbilllistsrch.filterList = <?php echo $bill_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbilllistsrch.initSearchPanel = true;
	loadjs.done("fbilllistsrch");
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
<?php if (!$bill_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bill_list->TotalRecords > 0 && $bill_list->ExportOptions->visible()) { ?>
<?php $bill_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bill_list->ImportOptions->visible()) { ?>
<?php $bill_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bill_list->SearchOptions->visible()) { ?>
<?php $bill_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bill_list->FilterOptions->visible()) { ?>
<?php $bill_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$bill_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bill_list->isExport() && !$bill->CurrentAction) { ?>
<form name="fbilllistsrch" id="fbilllistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbilllistsrch-search-panel" class="<?php echo $bill_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bill">
	<div class="ew-extended-search">
<?php

// Render search row
$bill->RowType = ROWTYPE_SEARCH;
$bill->resetAttributes();
$bill_list->renderRow();
?>
<?php if ($bill_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php
		$bill_list->SearchColumnCount++;
		if (($bill_list->SearchColumnCount - 1) % $bill_list->SearchFieldsPerRow == 0) {
			$bill_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bill_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ClientSerNo" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $bill_list->ClientSerNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		<span id="el_bill_ClientSerNo" class="ew-search-field">
<?php
$onchange = $bill_list->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_list->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($bill_list->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_list->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_list->ClientSerNo->getPlaceHolder()) ?>"<?php echo $bill_list->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_list->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_list->ClientSerNo->ReadOnly || $bill_list->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_list->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($bill_list->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbilllistsrch"], function() {
	fbilllistsrch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $bill_list->ClientSerNo->Lookup->getParamTag($bill_list, "p_x_ClientSerNo") ?>
</span>
	</div>
	<?php if ($bill_list->SearchColumnCount % $bill_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php
		$bill_list->SearchColumnCount++;
		if (($bill_list->SearchColumnCount - 1) % $bill_list->SearchFieldsPerRow == 0) {
			$bill_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bill_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $bill_list->ChargeCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		<span id="el_bill_ChargeCode" class="ew-search-field">
<?php
$onchange = $bill_list->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_list->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($bill_list->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_list->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_list->ChargeCode->getPlaceHolder()) ?>"<?php echo $bill_list->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_list->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_list->ChargeCode->ReadOnly || $bill_list->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_list->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($bill_list->ChargeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbilllistsrch"], function() {
	fbilllistsrch.createAutoSuggest({"id":"x_ChargeCode","forceSelect":false});
});
</script>
<?php echo $bill_list->ChargeCode->Lookup->getParamTag($bill_list, "p_x_ChargeCode") ?>
</span>
	</div>
	<?php if ($bill_list->SearchColumnCount % $bill_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php
		$bill_list->SearchColumnCount++;
		if (($bill_list->SearchColumnCount - 1) % $bill_list->SearchFieldsPerRow == 0) {
			$bill_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bill_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeGroup" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $bill_list->ChargeGroup->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		<span id="el_bill_ChargeGroup" class="ew-search-field">
<?php
$onchange = $bill_list->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_list->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeGroup" id="sv_x_ChargeGroup" value="<?php echo RemoveHtml($bill_list->ChargeGroup->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($bill_list->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_list->ChargeGroup->getPlaceHolder()) ?>"<?php echo $bill_list->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_list->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_list->ChargeGroup->ReadOnly || $bill_list->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_list->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($bill_list->ChargeGroup->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbilllistsrch"], function() {
	fbilllistsrch.createAutoSuggest({"id":"x_ChargeGroup","forceSelect":false});
});
</script>
<?php echo $bill_list->ChargeGroup->Lookup->getParamTag($bill_list, "p_x_ChargeGroup") ?>
</span>
	</div>
	<?php if ($bill_list->SearchColumnCount % $bill_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->BillYear->Visible) { // BillYear ?>
	<?php
		$bill_list->SearchColumnCount++;
		if (($bill_list->SearchColumnCount - 1) % $bill_list->SearchFieldsPerRow == 0) {
			$bill_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bill_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BillYear" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $bill_list->BillYear->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		<span id="el_bill_BillYear" class="ew-search-field">
<?php
$onchange = $bill_list->BillYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_list->BillYear->EditAttrs["onchange"] = "";
?>
<span id="as_x_BillYear">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_BillYear" id="sv_x_BillYear" value="<?php echo RemoveHtml($bill_list->BillYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_list->BillYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_list->BillYear->getPlaceHolder()) ?>"<?php echo $bill_list->BillYear->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_list->BillYear->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_BillYear',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_list->BillYear->ReadOnly || $bill_list->BillYear->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill" data-field="x_BillYear" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_list->BillYear->displayValueSeparatorAttribute() ?>" name="x_BillYear" id="x_BillYear" value="<?php echo HtmlEncode($bill_list->BillYear->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbilllistsrch"], function() {
	fbilllistsrch.createAutoSuggest({"id":"x_BillYear","forceSelect":false});
});
</script>
<?php echo $bill_list->BillYear->Lookup->getParamTag($bill_list, "p_x_BillYear") ?>
</span>
	</div>
	<?php if ($bill_list->SearchColumnCount % $bill_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php
		$bill_list->SearchColumnCount++;
		if (($bill_list->SearchColumnCount - 1) % $bill_list->SearchFieldsPerRow == 0) {
			$bill_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bill_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BillPeriod" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $bill_list->BillPeriod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		<span id="el_bill_BillPeriod" class="ew-search-field">
<?php
$onchange = $bill_list->BillPeriod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_list->BillPeriod->EditAttrs["onchange"] = "";
?>
<span id="as_x_BillPeriod">
	<input type="text" class="form-control" name="sv_x_BillPeriod" id="sv_x_BillPeriod" value="<?php echo RemoveHtml($bill_list->BillPeriod->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_list->BillPeriod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_list->BillPeriod->getPlaceHolder()) ?>"<?php echo $bill_list->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill" data-field="x_BillPeriod" data-value-separator="<?php echo $bill_list->BillPeriod->displayValueSeparatorAttribute() ?>" name="x_BillPeriod" id="x_BillPeriod" value="<?php echo HtmlEncode($bill_list->BillPeriod->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbilllistsrch"], function() {
	fbilllistsrch.createAutoSuggest({"id":"x_BillPeriod","forceSelect":false});
});
</script>
<?php echo $bill_list->BillPeriod->Lookup->getParamTag($bill_list, "p_x_BillPeriod") ?>
</span>
	</div>
	<?php if ($bill_list->SearchColumnCount % $bill_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->AmountDue->Visible) { // AmountDue ?>
	<?php
		$bill_list->SearchColumnCount++;
		if (($bill_list->SearchColumnCount - 1) % $bill_list->SearchFieldsPerRow == 0) {
			$bill_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bill_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_AmountDue" class="ew-cell form-group">
		<label for="x_AmountDue" class="ew-search-caption ew-label"><?php echo $bill_list->AmountDue->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_AmountDue" id="z_AmountDue" value="BETWEEN">
</span>
		<span id="el_bill_AmountDue" class="ew-search-field">
<input type="text" data-table="bill" data-field="x_AmountDue" name="x_AmountDue" id="x_AmountDue" size="30" placeholder="<?php echo HtmlEncode($bill_list->AmountDue->getPlaceHolder()) ?>" value="<?php echo $bill_list->AmountDue->EditValue ?>"<?php echo $bill_list->AmountDue->editAttributes() ?>>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_bill_AmountDue" class="ew-search-field2">
<input type="text" data-table="bill" data-field="x_AmountDue" name="y_AmountDue" id="y_AmountDue" size="30" placeholder="<?php echo HtmlEncode($bill_list->AmountDue->getPlaceHolder()) ?>" value="<?php echo $bill_list->AmountDue->EditValue2 ?>"<?php echo $bill_list->AmountDue->editAttributes() ?>>
</span>
	</div>
	<?php if ($bill_list->SearchColumnCount % $bill_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($bill_list->SearchColumnCount % $bill_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $bill_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bill_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bill_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bill_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bill_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bill_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bill_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bill_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $bill_list->showPageHeader(); ?>
<?php
$bill_list->showMessage();
?>
<?php if ($bill_list->TotalRecords > 0 || $bill->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bill_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bill">
<?php if (!$bill_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bill_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bill_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbilllist" id="fbilllist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill">
<div id="gmp_bill" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bill_list->TotalRecords > 0 || $bill_list->isGridEdit()) { ?>
<table id="tbl_billlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bill->RowType = ROWTYPE_HEADER;

// Render list options
$bill_list->renderListOptions();

// Render list options (header, left)
$bill_list->ListOptions->render("header", "left");
?>
<?php if ($bill_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($bill_list->SortUrl($bill_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $bill_list->ClientSerNo->headerCellClass() ?>"><div id="elh_bill_ClientSerNo" class="bill_ClientSerNo"><div class="ew-table-header-caption"><?php echo $bill_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $bill_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->ClientSerNo) ?>', 1);"><div id="elh_bill_ClientSerNo" class="bill_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($bill_list->SortUrl($bill_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $bill_list->ChargeCode->headerCellClass() ?>"><div id="elh_bill_ChargeCode" class="bill_ChargeCode"><div class="ew-table-header-caption"><?php echo $bill_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $bill_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->ChargeCode) ?>', 1);"><div id="elh_bill_ChargeCode" class="bill_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($bill_list->SortUrl($bill_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $bill_list->ChargeGroup->headerCellClass() ?>"><div id="elh_bill_ChargeGroup" class="bill_ChargeGroup"><div class="ew-table-header-caption"><?php echo $bill_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $bill_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->ChargeGroup) ?>', 1);"><div id="elh_bill_ChargeGroup" class="bill_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->ChargeGroup->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->ClientID->Visible) { // ClientID ?>
	<?php if ($bill_list->SortUrl($bill_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $bill_list->ClientID->headerCellClass() ?>"><div id="elh_bill_ClientID" class="bill_ClientID"><div class="ew-table-header-caption"><?php echo $bill_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $bill_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->ClientID) ?>', 1);"><div id="elh_bill_ClientID" class="bill_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->ChargeRef->Visible) { // ChargeRef ?>
	<?php if ($bill_list->SortUrl($bill_list->ChargeRef) == "") { ?>
		<th data-name="ChargeRef" class="<?php echo $bill_list->ChargeRef->headerCellClass() ?>"><div id="elh_bill_ChargeRef" class="bill_ChargeRef"><div class="ew-table-header-caption"><?php echo $bill_list->ChargeRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeRef" class="<?php echo $bill_list->ChargeRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->ChargeRef) ?>', 1);"><div id="elh_bill_ChargeRef" class="bill_ChargeRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->ChargeRef->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_list->ChargeRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->ChargeRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->BillYear->Visible) { // BillYear ?>
	<?php if ($bill_list->SortUrl($bill_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $bill_list->BillYear->headerCellClass() ?>"><div id="elh_bill_BillYear" class="bill_BillYear"><div class="ew-table-header-caption"><?php echo $bill_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $bill_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->BillYear) ?>', 1);"><div id="elh_bill_BillYear" class="bill_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($bill_list->SortUrl($bill_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $bill_list->BillPeriod->headerCellClass() ?>"><div id="elh_bill_BillPeriod" class="bill_BillPeriod"><div class="ew-table-header-caption"><?php echo $bill_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $bill_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->BillPeriod) ?>', 1);"><div id="elh_bill_BillPeriod" class="bill_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->StartDate->Visible) { // StartDate ?>
	<?php if ($bill_list->SortUrl($bill_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $bill_list->StartDate->headerCellClass() ?>"><div id="elh_bill_StartDate" class="bill_StartDate"><div class="ew-table-header-caption"><?php echo $bill_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $bill_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->StartDate) ?>', 1);"><div id="elh_bill_StartDate" class="bill_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->EndDate->Visible) { // EndDate ?>
	<?php if ($bill_list->SortUrl($bill_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $bill_list->EndDate->headerCellClass() ?>"><div id="elh_bill_EndDate" class="bill_EndDate"><div class="ew-table-header-caption"><?php echo $bill_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $bill_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->EndDate) ?>', 1);"><div id="elh_bill_EndDate" class="bill_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($bill_list->SortUrl($bill_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $bill_list->BalanceBF->headerCellClass() ?>"><div id="elh_bill_BalanceBF" class="bill_BalanceBF"><div class="ew-table-header-caption"><?php echo $bill_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $bill_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->BalanceBF) ?>', 1);"><div id="elh_bill_BalanceBF" class="bill_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->AmountDue->Visible) { // AmountDue ?>
	<?php if ($bill_list->SortUrl($bill_list->AmountDue) == "") { ?>
		<th data-name="AmountDue" class="<?php echo $bill_list->AmountDue->headerCellClass() ?>"><div id="elh_bill_AmountDue" class="bill_AmountDue"><div class="ew-table-header-caption"><?php echo $bill_list->AmountDue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountDue" class="<?php echo $bill_list->AmountDue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->AmountDue) ?>', 1);"><div id="elh_bill_AmountDue" class="bill_AmountDue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->AmountDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->AmountDue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->AmountDue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->VAT->Visible) { // VAT ?>
	<?php if ($bill_list->SortUrl($bill_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $bill_list->VAT->headerCellClass() ?>"><div id="elh_bill_VAT" class="bill_VAT"><div class="ew-table-header-caption"><?php echo $bill_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $bill_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->VAT) ?>', 1);"><div id="elh_bill_VAT" class="bill_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->SalesTax->Visible) { // SalesTax ?>
	<?php if ($bill_list->SortUrl($bill_list->SalesTax) == "") { ?>
		<th data-name="SalesTax" class="<?php echo $bill_list->SalesTax->headerCellClass() ?>"><div id="elh_bill_SalesTax" class="bill_SalesTax"><div class="ew-table-header-caption"><?php echo $bill_list->SalesTax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalesTax" class="<?php echo $bill_list->SalesTax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->SalesTax) ?>', 1);"><div id="elh_bill_SalesTax" class="bill_SalesTax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->SalesTax->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->SalesTax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->SalesTax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($bill_list->SortUrl($bill_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $bill_list->AmountPaid->headerCellClass() ?>"><div id="elh_bill_AmountPaid" class="bill_AmountPaid"><div class="ew-table-header-caption"><?php echo $bill_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $bill_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->AmountPaid) ?>', 1);"><div id="elh_bill_AmountPaid" class="bill_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_list->ReferenceNo->Visible) { // ReferenceNo ?>
	<?php if ($bill_list->SortUrl($bill_list->ReferenceNo) == "") { ?>
		<th data-name="ReferenceNo" class="<?php echo $bill_list->ReferenceNo->headerCellClass() ?>"><div id="elh_bill_ReferenceNo" class="bill_ReferenceNo"><div class="ew-table-header-caption"><?php echo $bill_list->ReferenceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReferenceNo" class="<?php echo $bill_list->ReferenceNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_list->SortUrl($bill_list->ReferenceNo) ?>', 1);"><div id="elh_bill_ReferenceNo" class="bill_ReferenceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_list->ReferenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_list->ReferenceNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_list->ReferenceNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bill_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bill_list->ExportAll && $bill_list->isExport()) {
	$bill_list->StopRecord = $bill_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bill_list->TotalRecords > $bill_list->StartRecord + $bill_list->DisplayRecords - 1)
		$bill_list->StopRecord = $bill_list->StartRecord + $bill_list->DisplayRecords - 1;
	else
		$bill_list->StopRecord = $bill_list->TotalRecords;
}
$bill_list->RecordCount = $bill_list->StartRecord - 1;
if ($bill_list->Recordset && !$bill_list->Recordset->EOF) {
	$bill_list->Recordset->moveFirst();
	$selectLimit = $bill_list->UseSelectLimit;
	if (!$selectLimit && $bill_list->StartRecord > 1)
		$bill_list->Recordset->move($bill_list->StartRecord - 1);
} elseif (!$bill->AllowAddDeleteRow && $bill_list->StopRecord == 0) {
	$bill_list->StopRecord = $bill->GridAddRowCount;
}

// Initialize aggregate
$bill->RowType = ROWTYPE_AGGREGATEINIT;
$bill->resetAttributes();
$bill_list->renderRow();
while ($bill_list->RecordCount < $bill_list->StopRecord) {
	$bill_list->RecordCount++;
	if ($bill_list->RecordCount >= $bill_list->StartRecord) {
		$bill_list->RowCount++;

		// Set up key count
		$bill_list->KeyCount = $bill_list->RowIndex;

		// Init row class and style
		$bill->resetAttributes();
		$bill->CssClass = "";
		if ($bill_list->isGridAdd()) {
		} else {
			$bill_list->loadRowValues($bill_list->Recordset); // Load row values
		}
		$bill->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bill->RowAttrs->merge(["data-rowindex" => $bill_list->RowCount, "id" => "r" . $bill_list->RowCount . "_bill", "data-rowtype" => $bill->RowType]);

		// Render row
		$bill_list->renderRow();

		// Render list options
		$bill_list->renderListOptions();
?>
	<tr <?php echo $bill->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_list->ListOptions->render("body", "left", $bill_list->RowCount);
?>
	<?php if ($bill_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $bill_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_ClientSerNo">
<span<?php echo $bill_list->ClientSerNo->viewAttributes() ?>><?php echo $bill_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $bill_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_ChargeCode">
<span<?php echo $bill_list->ChargeCode->viewAttributes() ?>><?php echo $bill_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $bill_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_ChargeGroup">
<span<?php echo $bill_list->ChargeGroup->viewAttributes() ?>><?php echo $bill_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $bill_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_ClientID">
<span<?php echo $bill_list->ClientID->viewAttributes() ?>><?php echo $bill_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->ChargeRef->Visible) { // ChargeRef ?>
		<td data-name="ChargeRef" <?php echo $bill_list->ChargeRef->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_ChargeRef">
<span<?php echo $bill_list->ChargeRef->viewAttributes() ?>><?php echo $bill_list->ChargeRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $bill_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_BillYear">
<span<?php echo $bill_list->BillYear->viewAttributes() ?>><?php echo $bill_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $bill_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_BillPeriod">
<span<?php echo $bill_list->BillPeriod->viewAttributes() ?>><?php echo $bill_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $bill_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_StartDate">
<span<?php echo $bill_list->StartDate->viewAttributes() ?>><?php echo $bill_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $bill_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_EndDate">
<span<?php echo $bill_list->EndDate->viewAttributes() ?>><?php echo $bill_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $bill_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_BalanceBF">
<span<?php echo $bill_list->BalanceBF->viewAttributes() ?>><?php echo $bill_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" <?php echo $bill_list->AmountDue->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_AmountDue">
<span<?php echo $bill_list->AmountDue->viewAttributes() ?>><?php echo $bill_list->AmountDue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $bill_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_VAT">
<span<?php echo $bill_list->VAT->viewAttributes() ?>><?php echo $bill_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->SalesTax->Visible) { // SalesTax ?>
		<td data-name="SalesTax" <?php echo $bill_list->SalesTax->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_SalesTax">
<span<?php echo $bill_list->SalesTax->viewAttributes() ?>><?php echo $bill_list->SalesTax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $bill_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_AmountPaid">
<span<?php echo $bill_list->AmountPaid->viewAttributes() ?>><?php echo $bill_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_list->ReferenceNo->Visible) { // ReferenceNo ?>
		<td data-name="ReferenceNo" <?php echo $bill_list->ReferenceNo->cellAttributes() ?>>
<span id="el<?php echo $bill_list->RowCount ?>_bill_ReferenceNo">
<span<?php echo $bill_list->ReferenceNo->viewAttributes() ?>><?php echo $bill_list->ReferenceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bill_list->ListOptions->render("body", "right", $bill_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bill_list->isGridAdd())
		$bill_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bill->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bill_list->Recordset)
	$bill_list->Recordset->Close();
?>
<?php if (!$bill_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bill_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bill_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bill_list->TotalRecords == 0 && !$bill->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bill_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bill_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bill_list->isExport()) { ?>
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
$bill_list->terminate();
?>