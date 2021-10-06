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
$print_bill_view_list = new print_bill_view_list();

// Run the page
$print_bill_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$print_bill_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$print_bill_view_list->isExport()) { ?>
<script>
var fprint_bill_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprint_bill_viewlist = currentForm = new ew.Form("fprint_bill_viewlist", "list");
	fprint_bill_viewlist.formKeyCountName = '<?php echo $print_bill_view_list->FormKeyCountName ?>';
	loadjs.done("fprint_bill_viewlist");
});
var fprint_bill_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprint_bill_viewlistsrch = currentSearchForm = new ew.Form("fprint_bill_viewlistsrch");

	// Validate function for search
	fprint_bill_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ValuationNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_list->ValuationNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PropertyGroup");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_list->PropertyGroup->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RateableValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_list->RateableValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($print_bill_view_list->ChargeCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fprint_bill_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprint_bill_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprint_bill_viewlistsrch.lists["x_ClientSerNo"] = <?php echo $print_bill_view_list->ClientSerNo->Lookup->toClientList($print_bill_view_list) ?>;
	fprint_bill_viewlistsrch.lists["x_ClientSerNo"].options = <?php echo JsonEncode($print_bill_view_list->ClientSerNo->lookupOptions()) ?>;
	fprint_bill_viewlistsrch.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprint_bill_viewlistsrch.lists["x_PropertyGroup"] = <?php echo $print_bill_view_list->PropertyGroup->Lookup->toClientList($print_bill_view_list) ?>;
	fprint_bill_viewlistsrch.lists["x_PropertyGroup"].options = <?php echo JsonEncode($print_bill_view_list->PropertyGroup->lookupOptions()) ?>;
	fprint_bill_viewlistsrch.autoSuggests["x_PropertyGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprint_bill_viewlistsrch.lists["x_Location[]"] = <?php echo $print_bill_view_list->Location->Lookup->toClientList($print_bill_view_list) ?>;
	fprint_bill_viewlistsrch.lists["x_Location[]"].options = <?php echo JsonEncode($print_bill_view_list->Location->lookupOptions()) ?>;
	fprint_bill_viewlistsrch.lists["x_PropertyUse[]"] = <?php echo $print_bill_view_list->PropertyUse->Lookup->toClientList($print_bill_view_list) ?>;
	fprint_bill_viewlistsrch.lists["x_PropertyUse[]"].options = <?php echo JsonEncode($print_bill_view_list->PropertyUse->lookupOptions()) ?>;
	fprint_bill_viewlistsrch.lists["x_ChargeCode"] = <?php echo $print_bill_view_list->ChargeCode->Lookup->toClientList($print_bill_view_list) ?>;
	fprint_bill_viewlistsrch.lists["x_ChargeCode"].options = <?php echo JsonEncode($print_bill_view_list->ChargeCode->lookupOptions()) ?>;
	fprint_bill_viewlistsrch.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fprint_bill_viewlistsrch.lists["x_BillYear"] = <?php echo $print_bill_view_list->BillYear->Lookup->toClientList($print_bill_view_list) ?>;
	fprint_bill_viewlistsrch.lists["x_BillYear"].options = <?php echo JsonEncode($print_bill_view_list->BillYear->lookupOptions()) ?>;

	// Filters
	fprint_bill_viewlistsrch.filterList = <?php echo $print_bill_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprint_bill_viewlistsrch.initSearchPanel = true;
	loadjs.done("fprint_bill_viewlistsrch");
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
<?php if (!$print_bill_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($print_bill_view_list->TotalRecords > 0 && $print_bill_view_list->ExportOptions->visible()) { ?>
<?php $print_bill_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($print_bill_view_list->ImportOptions->visible()) { ?>
<?php $print_bill_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($print_bill_view_list->SearchOptions->visible()) { ?>
<?php $print_bill_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($print_bill_view_list->FilterOptions->visible()) { ?>
<?php $print_bill_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$print_bill_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$print_bill_view_list->isExport() && !$print_bill_view->CurrentAction) { ?>
<form name="fprint_bill_viewlistsrch" id="fprint_bill_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprint_bill_viewlistsrch-search-panel" class="<?php echo $print_bill_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="print_bill_view">
	<div class="ew-extended-search">
<?php

// Render search row
$print_bill_view->RowType = ROWTYPE_SEARCH;
$print_bill_view->resetAttributes();
$print_bill_view_list->renderRow();
?>
<?php if ($print_bill_view_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ValuationNo" class="ew-cell form-group">
		<label for="x_ValuationNo" class="ew-search-caption ew-label"><?php echo $print_bill_view_list->ValuationNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ValuationNo" id="z_ValuationNo" value="=">
</span>
		<span id="el_print_bill_view_ValuationNo" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_ValuationNo" name="x_ValuationNo" id="x_ValuationNo" placeholder="<?php echo HtmlEncode($print_bill_view_list->ValuationNo->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_list->ValuationNo->EditValue ?>"<?php echo $print_bill_view_list->ValuationNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyNo" class="ew-cell form-group">
		<label for="x_PropertyNo" class="ew-search-caption ew-label"><?php echo $print_bill_view_list->PropertyNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		<span id="el_print_bill_view_PropertyNo" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($print_bill_view_list->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_list->PropertyNo->EditValue ?>"<?php echo $print_bill_view_list->PropertyNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ClientSerNo" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $print_bill_view_list->ClientSerNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		<span id="el_print_bill_view_ClientSerNo" class="ew-search-field">
<?php
$onchange = $print_bill_view_list->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$print_bill_view_list->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($print_bill_view_list->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_list->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($print_bill_view_list->ClientSerNo->getPlaceHolder()) ?>"<?php echo $print_bill_view_list->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_list->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_list->ClientSerNo->ReadOnly || $print_bill_view_list->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="print_bill_view" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $print_bill_view_list->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($print_bill_view_list->ClientSerNo->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprint_bill_viewlistsrch"], function() {
	fprint_bill_viewlistsrch.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $print_bill_view_list->ClientSerNo->Lookup->getParamTag($print_bill_view_list, "p_x_ClientSerNo") ?>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyGroup" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $print_bill_view_list->PropertyGroup->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PropertyGroup" id="z_PropertyGroup" value="=">
</span>
		<span id="el_print_bill_view_PropertyGroup" class="ew-search-field">
<?php
$onchange = $print_bill_view_list->PropertyGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$print_bill_view_list->PropertyGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_PropertyGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_PropertyGroup" id="sv_x_PropertyGroup" value="<?php echo RemoveHtml($print_bill_view_list->PropertyGroup->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_list->PropertyGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($print_bill_view_list->PropertyGroup->getPlaceHolder()) ?>"<?php echo $print_bill_view_list->PropertyGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_list->PropertyGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyGroup',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_list->PropertyGroup->ReadOnly || $print_bill_view_list->PropertyGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="print_bill_view" data-field="x_PropertyGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $print_bill_view_list->PropertyGroup->displayValueSeparatorAttribute() ?>" name="x_PropertyGroup" id="x_PropertyGroup" value="<?php echo HtmlEncode($print_bill_view_list->PropertyGroup->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprint_bill_viewlistsrch"], function() {
	fprint_bill_viewlistsrch.createAutoSuggest({"id":"x_PropertyGroup","forceSelect":false});
});
</script>
<?php echo $print_bill_view_list->PropertyGroup->Lookup->getParamTag($print_bill_view_list, "p_x_PropertyGroup") ?>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->Location->Visible) { // Location ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Location" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $print_bill_view_list->Location->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		<span id="el_print_bill_view_Location" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_Location"><?php echo EmptyValue(strval($print_bill_view_list->Location->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $print_bill_view_list->Location->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_list->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_list->Location->ReadOnly || $print_bill_view_list->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $print_bill_view_list->Location->Lookup->getParamTag($print_bill_view_list, "p_x_Location") ?>
<input type="hidden" data-table="print_bill_view" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $print_bill_view_list->Location->displayValueSeparatorAttribute() ?>" name="x_Location[]" id="x_Location[]" value="<?php echo $print_bill_view_list->Location->AdvancedSearch->SearchValue ?>"<?php echo $print_bill_view_list->Location->editAttributes() ?>>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyUse" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $print_bill_view_list->PropertyUse->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="LIKE">
</span>
		<span id="el_print_bill_view_PropertyUse" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($print_bill_view_list->PropertyUse->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $print_bill_view_list->PropertyUse->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_list->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_list->PropertyUse->ReadOnly || $print_bill_view_list->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $print_bill_view_list->PropertyUse->Lookup->getParamTag($print_bill_view_list, "p_x_PropertyUse") ?>
<input type="hidden" data-table="print_bill_view" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $print_bill_view_list->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse[]" id="x_PropertyUse[]" value="<?php echo $print_bill_view_list->PropertyUse->AdvancedSearch->SearchValue ?>"<?php echo $print_bill_view_list->PropertyUse->editAttributes() ?>>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->RateableValue->Visible) { // RateableValue ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_RateableValue" class="ew-cell form-group">
		<label for="x_RateableValue" class="ew-search-caption ew-label"><?php echo $print_bill_view_list->RateableValue->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RateableValue" id="z_RateableValue" value="=">
</span>
		<span id="el_print_bill_view_RateableValue" class="ew-search-field">
<input type="text" data-table="print_bill_view" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_list->RateableValue->getPlaceHolder()) ?>" value="<?php echo $print_bill_view_list->RateableValue->EditValue ?>"<?php echo $print_bill_view_list->RateableValue->editAttributes() ?>>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $print_bill_view_list->ChargeCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		<span id="el_print_bill_view_ChargeCode" class="ew-search-field">
<?php
$onchange = $print_bill_view_list->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$print_bill_view_list->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($print_bill_view_list->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($print_bill_view_list->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($print_bill_view_list->ChargeCode->getPlaceHolder()) ?>"<?php echo $print_bill_view_list->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($print_bill_view_list->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($print_bill_view_list->ChargeCode->ReadOnly || $print_bill_view_list->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="print_bill_view" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $print_bill_view_list->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($print_bill_view_list->ChargeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fprint_bill_viewlistsrch"], function() {
	fprint_bill_viewlistsrch.createAutoSuggest({"id":"x_ChargeCode","forceSelect":false});
});
</script>
<?php echo $print_bill_view_list->ChargeCode->Lookup->getParamTag($print_bill_view_list, "p_x_ChargeCode") ?>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->BillYear->Visible) { // BillYear ?>
	<?php
		$print_bill_view_list->SearchColumnCount++;
		if (($print_bill_view_list->SearchColumnCount - 1) % $print_bill_view_list->SearchFieldsPerRow == 0) {
			$print_bill_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BillYear" class="ew-cell form-group">
		<label for="x_BillYear" class="ew-search-caption ew-label"><?php echo $print_bill_view_list->BillYear->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		<span id="el_print_bill_view_BillYear" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="print_bill_view" data-field="x_BillYear" data-value-separator="<?php echo $print_bill_view_list->BillYear->displayValueSeparatorAttribute() ?>" id="x_BillYear" name="x_BillYear"<?php echo $print_bill_view_list->BillYear->editAttributes() ?>>
			<?php echo $print_bill_view_list->BillYear->selectOptionListHtml("x_BillYear") ?>
		</select>
</div>
<?php echo $print_bill_view_list->BillYear->Lookup->getParamTag($print_bill_view_list, "p_x_BillYear") ?>
</span>
	</div>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($print_bill_view_list->SearchColumnCount % $print_bill_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $print_bill_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($print_bill_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($print_bill_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $print_bill_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($print_bill_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($print_bill_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($print_bill_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($print_bill_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $print_bill_view_list->showPageHeader(); ?>
<?php
$print_bill_view_list->showMessage();
?>
<?php if ($print_bill_view_list->TotalRecords > 0 || $print_bill_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($print_bill_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> print_bill_view">
<?php if (!$print_bill_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$print_bill_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $print_bill_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $print_bill_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprint_bill_viewlist" id="fprint_bill_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="print_bill_view">
<div id="gmp_print_bill_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($print_bill_view_list->TotalRecords > 0 || $print_bill_view_list->isGridEdit()) { ?>
<table id="tbl_print_bill_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$print_bill_view->RowType = ROWTYPE_HEADER;

// Render list options
$print_bill_view_list->renderListOptions();

// Render list options (header, left)
$print_bill_view_list->ListOptions->render("header", "left");
?>
<?php if ($print_bill_view_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $print_bill_view_list->ValuationNo->headerCellClass() ?>"><div id="elh_print_bill_view_ValuationNo" class="print_bill_view_ValuationNo"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $print_bill_view_list->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->ValuationNo) ?>', 1);"><div id="elh_print_bill_view_ValuationNo" class="print_bill_view_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $print_bill_view_list->PropertyNo->headerCellClass() ?>"><div id="elh_print_bill_view_PropertyNo" class="print_bill_view_PropertyNo"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $print_bill_view_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->PropertyNo) ?>', 1);"><div id="elh_print_bill_view_PropertyNo" class="print_bill_view_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->PropertyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $print_bill_view_list->ClientSerNo->headerCellClass() ?>"><div id="elh_print_bill_view_ClientSerNo" class="print_bill_view_ClientSerNo"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $print_bill_view_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->ClientSerNo) ?>', 1);"><div id="elh_print_bill_view_ClientSerNo" class="print_bill_view_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->PropertyGroup) == "") { ?>
		<th data-name="PropertyGroup" class="<?php echo $print_bill_view_list->PropertyGroup->headerCellClass() ?>"><div id="elh_print_bill_view_PropertyGroup" class="print_bill_view_PropertyGroup"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->PropertyGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroup" class="<?php echo $print_bill_view_list->PropertyGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->PropertyGroup) ?>', 1);"><div id="elh_print_bill_view_PropertyGroup" class="print_bill_view_PropertyGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->PropertyGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->PropertyGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->Location->Visible) { // Location ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $print_bill_view_list->Location->headerCellClass() ?>"><div id="elh_print_bill_view_Location" class="print_bill_view_Location"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $print_bill_view_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->Location) ?>', 1);"><div id="elh_print_bill_view_Location" class="print_bill_view_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $print_bill_view_list->PropertyUse->headerCellClass() ?>"><div id="elh_print_bill_view_PropertyUse" class="print_bill_view_PropertyUse"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $print_bill_view_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->PropertyUse) ?>', 1);"><div id="elh_print_bill_view_PropertyUse" class="print_bill_view_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->RateableValue->Visible) { // RateableValue ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $print_bill_view_list->RateableValue->headerCellClass() ?>"><div id="elh_print_bill_view_RateableValue" class="print_bill_view_RateableValue"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $print_bill_view_list->RateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->RateableValue) ?>', 1);"><div id="elh_print_bill_view_RateableValue" class="print_bill_view_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->ReferenceNo->Visible) { // ReferenceNo ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->ReferenceNo) == "") { ?>
		<th data-name="ReferenceNo" class="<?php echo $print_bill_view_list->ReferenceNo->headerCellClass() ?>"><div id="elh_print_bill_view_ReferenceNo" class="print_bill_view_ReferenceNo"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->ReferenceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReferenceNo" class="<?php echo $print_bill_view_list->ReferenceNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->ReferenceNo) ?>', 1);"><div id="elh_print_bill_view_ReferenceNo" class="print_bill_view_ReferenceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->ReferenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->ReferenceNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->ReferenceNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $print_bill_view_list->ChargeCode->headerCellClass() ?>"><div id="elh_print_bill_view_ChargeCode" class="print_bill_view_ChargeCode"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $print_bill_view_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->ChargeCode) ?>', 1);"><div id="elh_print_bill_view_ChargeCode" class="print_bill_view_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $print_bill_view_list->ChargeGroup->headerCellClass() ?>"><div id="elh_print_bill_view_ChargeGroup" class="print_bill_view_ChargeGroup"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $print_bill_view_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->ChargeGroup) ?>', 1);"><div id="elh_print_bill_view_ChargeGroup" class="print_bill_view_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->ClientID->Visible) { // ClientID ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $print_bill_view_list->ClientID->headerCellClass() ?>"><div id="elh_print_bill_view_ClientID" class="print_bill_view_ClientID"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $print_bill_view_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->ClientID) ?>', 1);"><div id="elh_print_bill_view_ClientID" class="print_bill_view_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->BillYear->Visible) { // BillYear ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $print_bill_view_list->BillYear->headerCellClass() ?>"><div id="elh_print_bill_view_BillYear" class="print_bill_view_BillYear"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $print_bill_view_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->BillYear) ?>', 1);"><div id="elh_print_bill_view_BillYear" class="print_bill_view_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $print_bill_view_list->BillPeriod->headerCellClass() ?>"><div id="elh_print_bill_view_BillPeriod" class="print_bill_view_BillPeriod"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $print_bill_view_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->BillPeriod) ?>', 1);"><div id="elh_print_bill_view_BillPeriod" class="print_bill_view_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->StartDate->Visible) { // StartDate ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $print_bill_view_list->StartDate->headerCellClass() ?>"><div id="elh_print_bill_view_StartDate" class="print_bill_view_StartDate"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $print_bill_view_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->StartDate) ?>', 1);"><div id="elh_print_bill_view_StartDate" class="print_bill_view_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->EndDate->Visible) { // EndDate ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $print_bill_view_list->EndDate->headerCellClass() ?>"><div id="elh_print_bill_view_EndDate" class="print_bill_view_EndDate"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $print_bill_view_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->EndDate) ?>', 1);"><div id="elh_print_bill_view_EndDate" class="print_bill_view_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $print_bill_view_list->BalanceBF->headerCellClass() ?>"><div id="elh_print_bill_view_BalanceBF" class="print_bill_view_BalanceBF"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $print_bill_view_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->BalanceBF) ?>', 1);"><div id="elh_print_bill_view_BalanceBF" class="print_bill_view_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->AmountDue->Visible) { // AmountDue ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->AmountDue) == "") { ?>
		<th data-name="AmountDue" class="<?php echo $print_bill_view_list->AmountDue->headerCellClass() ?>"><div id="elh_print_bill_view_AmountDue" class="print_bill_view_AmountDue"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->AmountDue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountDue" class="<?php echo $print_bill_view_list->AmountDue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->AmountDue) ?>', 1);"><div id="elh_print_bill_view_AmountDue" class="print_bill_view_AmountDue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->AmountDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->AmountDue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->AmountDue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->VAT->Visible) { // VAT ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $print_bill_view_list->VAT->headerCellClass() ?>"><div id="elh_print_bill_view_VAT" class="print_bill_view_VAT"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $print_bill_view_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->VAT) ?>', 1);"><div id="elh_print_bill_view_VAT" class="print_bill_view_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->SalesTax->Visible) { // SalesTax ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->SalesTax) == "") { ?>
		<th data-name="SalesTax" class="<?php echo $print_bill_view_list->SalesTax->headerCellClass() ?>"><div id="elh_print_bill_view_SalesTax" class="print_bill_view_SalesTax"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->SalesTax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalesTax" class="<?php echo $print_bill_view_list->SalesTax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->SalesTax) ?>', 1);"><div id="elh_print_bill_view_SalesTax" class="print_bill_view_SalesTax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->SalesTax->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->SalesTax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->SalesTax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($print_bill_view_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($print_bill_view_list->SortUrl($print_bill_view_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $print_bill_view_list->AmountPaid->headerCellClass() ?>"><div id="elh_print_bill_view_AmountPaid" class="print_bill_view_AmountPaid"><div class="ew-table-header-caption"><?php echo $print_bill_view_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $print_bill_view_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $print_bill_view_list->SortUrl($print_bill_view_list->AmountPaid) ?>', 1);"><div id="elh_print_bill_view_AmountPaid" class="print_bill_view_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $print_bill_view_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($print_bill_view_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($print_bill_view_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$print_bill_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($print_bill_view_list->ExportAll && $print_bill_view_list->isExport()) {
	$print_bill_view_list->StopRecord = $print_bill_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($print_bill_view_list->TotalRecords > $print_bill_view_list->StartRecord + $print_bill_view_list->DisplayRecords - 1)
		$print_bill_view_list->StopRecord = $print_bill_view_list->StartRecord + $print_bill_view_list->DisplayRecords - 1;
	else
		$print_bill_view_list->StopRecord = $print_bill_view_list->TotalRecords;
}
$print_bill_view_list->RecordCount = $print_bill_view_list->StartRecord - 1;
if ($print_bill_view_list->Recordset && !$print_bill_view_list->Recordset->EOF) {
	$print_bill_view_list->Recordset->moveFirst();
	$selectLimit = $print_bill_view_list->UseSelectLimit;
	if (!$selectLimit && $print_bill_view_list->StartRecord > 1)
		$print_bill_view_list->Recordset->move($print_bill_view_list->StartRecord - 1);
} elseif (!$print_bill_view->AllowAddDeleteRow && $print_bill_view_list->StopRecord == 0) {
	$print_bill_view_list->StopRecord = $print_bill_view->GridAddRowCount;
}

// Initialize aggregate
$print_bill_view->RowType = ROWTYPE_AGGREGATEINIT;
$print_bill_view->resetAttributes();
$print_bill_view_list->renderRow();
while ($print_bill_view_list->RecordCount < $print_bill_view_list->StopRecord) {
	$print_bill_view_list->RecordCount++;
	if ($print_bill_view_list->RecordCount >= $print_bill_view_list->StartRecord) {
		$print_bill_view_list->RowCount++;

		// Set up key count
		$print_bill_view_list->KeyCount = $print_bill_view_list->RowIndex;

		// Init row class and style
		$print_bill_view->resetAttributes();
		$print_bill_view->CssClass = "";
		if ($print_bill_view_list->isGridAdd()) {
		} else {
			$print_bill_view_list->loadRowValues($print_bill_view_list->Recordset); // Load row values
		}
		$print_bill_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$print_bill_view->RowAttrs->merge(["data-rowindex" => $print_bill_view_list->RowCount, "id" => "r" . $print_bill_view_list->RowCount . "_print_bill_view", "data-rowtype" => $print_bill_view->RowType]);

		// Render row
		$print_bill_view_list->renderRow();

		// Render list options
		$print_bill_view_list->renderListOptions();
?>
	<tr <?php echo $print_bill_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$print_bill_view_list->ListOptions->render("body", "left", $print_bill_view_list->RowCount);
?>
	<?php if ($print_bill_view_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $print_bill_view_list->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_ValuationNo">
<span<?php echo $print_bill_view_list->ValuationNo->viewAttributes() ?>><?php echo $print_bill_view_list->ValuationNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $print_bill_view_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_PropertyNo">
<span<?php echo $print_bill_view_list->PropertyNo->viewAttributes() ?>><?php echo $print_bill_view_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $print_bill_view_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_ClientSerNo">
<span<?php echo $print_bill_view_list->ClientSerNo->viewAttributes() ?>><?php echo $print_bill_view_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup" <?php echo $print_bill_view_list->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_PropertyGroup">
<span<?php echo $print_bill_view_list->PropertyGroup->viewAttributes() ?>><?php echo $print_bill_view_list->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $print_bill_view_list->Location->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_Location">
<span<?php echo $print_bill_view_list->Location->viewAttributes() ?>><?php echo $print_bill_view_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $print_bill_view_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_PropertyUse">
<span<?php echo $print_bill_view_list->PropertyUse->viewAttributes() ?>><?php echo $print_bill_view_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $print_bill_view_list->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_RateableValue">
<span<?php echo $print_bill_view_list->RateableValue->viewAttributes() ?>><?php echo $print_bill_view_list->RateableValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->ReferenceNo->Visible) { // ReferenceNo ?>
		<td data-name="ReferenceNo" <?php echo $print_bill_view_list->ReferenceNo->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_ReferenceNo">
<span<?php echo $print_bill_view_list->ReferenceNo->viewAttributes() ?>><?php echo $print_bill_view_list->ReferenceNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $print_bill_view_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_ChargeCode">
<span<?php echo $print_bill_view_list->ChargeCode->viewAttributes() ?>><?php echo $print_bill_view_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $print_bill_view_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_ChargeGroup">
<span<?php echo $print_bill_view_list->ChargeGroup->viewAttributes() ?>><?php echo $print_bill_view_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $print_bill_view_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_ClientID">
<span<?php echo $print_bill_view_list->ClientID->viewAttributes() ?>><?php echo $print_bill_view_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $print_bill_view_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_BillYear">
<span<?php echo $print_bill_view_list->BillYear->viewAttributes() ?>><?php echo $print_bill_view_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $print_bill_view_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_BillPeriod">
<span<?php echo $print_bill_view_list->BillPeriod->viewAttributes() ?>><?php echo $print_bill_view_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $print_bill_view_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_StartDate">
<span<?php echo $print_bill_view_list->StartDate->viewAttributes() ?>><?php echo $print_bill_view_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $print_bill_view_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_EndDate">
<span<?php echo $print_bill_view_list->EndDate->viewAttributes() ?>><?php echo $print_bill_view_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $print_bill_view_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_BalanceBF">
<span<?php echo $print_bill_view_list->BalanceBF->viewAttributes() ?>><?php echo $print_bill_view_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" <?php echo $print_bill_view_list->AmountDue->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_AmountDue">
<span<?php echo $print_bill_view_list->AmountDue->viewAttributes() ?>><?php echo $print_bill_view_list->AmountDue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $print_bill_view_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_VAT">
<span<?php echo $print_bill_view_list->VAT->viewAttributes() ?>><?php echo $print_bill_view_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->SalesTax->Visible) { // SalesTax ?>
		<td data-name="SalesTax" <?php echo $print_bill_view_list->SalesTax->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_SalesTax">
<span<?php echo $print_bill_view_list->SalesTax->viewAttributes() ?>><?php echo $print_bill_view_list->SalesTax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($print_bill_view_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $print_bill_view_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $print_bill_view_list->RowCount ?>_print_bill_view_AmountPaid">
<span<?php echo $print_bill_view_list->AmountPaid->viewAttributes() ?>><?php echo $print_bill_view_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$print_bill_view_list->ListOptions->render("body", "right", $print_bill_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$print_bill_view_list->isGridAdd())
		$print_bill_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$print_bill_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($print_bill_view_list->Recordset)
	$print_bill_view_list->Recordset->Close();
?>
<?php if (!$print_bill_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$print_bill_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $print_bill_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $print_bill_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($print_bill_view_list->TotalRecords == 0 && !$print_bill_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $print_bill_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$print_bill_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$print_bill_view_list->isExport()) { ?>
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
$print_bill_view_list->terminate();
?>