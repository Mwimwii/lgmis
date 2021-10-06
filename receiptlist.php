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
$receipt_list = new receipt_list();

// Run the page
$receipt_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$receipt_list->isExport()) { ?>
<script>
var freceiptlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freceiptlist = currentForm = new ew.Form("freceiptlist", "list");
	freceiptlist.formKeyCountName = '<?php echo $receipt_list->FormKeyCountName ?>';

	// Validate form
	freceiptlist.validate = function() {
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
			<?php if ($receipt_list->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->ClientSerNo->caption(), $receipt_list->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->ChargeCode->caption(), $receipt_list->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->ItemID->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->ItemID->caption(), $receipt_list->ItemID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->UnitCost->caption(), $receipt_list->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_list->UnitCost->errorMessage()) ?>");
			<?php if ($receipt_list->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->Quantity->caption(), $receipt_list->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_list->Quantity->errorMessage()) ?>");
			<?php if ($receipt_list->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->UnitOfMeasure->caption(), $receipt_list->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->AmountPaid->caption(), $receipt_list->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_list->AmountPaid->errorMessage()) ?>");
			<?php if ($receipt_list->ReceiptNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->ReceiptNo->caption(), $receipt_list->ReceiptNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->ReceiptDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->ReceiptDate->caption(), $receipt_list->ReceiptDate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->PaymentMethod->caption(), $receipt_list->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->PaymentRef->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->PaymentRef->caption(), $receipt_list->PaymentRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->CashierNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CashierNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->CashierNo->caption(), $receipt_list->CashierNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->BillPeriod->caption(), $receipt_list->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_list->BillPeriod->errorMessage()) ?>");
			<?php if ($receipt_list->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->BillYear->caption(), $receipt_list->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_list->BillYear->errorMessage()) ?>");
			<?php if ($receipt_list->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->ChargeGroup->caption(), $receipt_list->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_list->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_list->ClientID->caption(), $receipt_list->ClientID->RequiredErrorMessage)) ?>");
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
	freceiptlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ClientSerNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ItemID", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitCost", false)) return false;
		if (ew.valueChanged(fobj, infix, "Quantity", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPaid", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReceiptNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentMethod", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentRef", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeGroup", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientID", false)) return false;
		return true;
	}

	// Form_CustomValidate
	freceiptlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceiptlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceiptlist.lists["x_ClientSerNo"] = <?php echo $receipt_list->ClientSerNo->Lookup->toClientList($receipt_list) ?>;
	freceiptlist.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_list->ClientSerNo->lookupOptions()) ?>;
	freceiptlist.lists["x_ChargeCode"] = <?php echo $receipt_list->ChargeCode->Lookup->toClientList($receipt_list) ?>;
	freceiptlist.lists["x_ChargeCode"].options = <?php echo JsonEncode($receipt_list->ChargeCode->lookupOptions()) ?>;
	freceiptlist.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceiptlist.lists["x_PaymentMethod"] = <?php echo $receipt_list->PaymentMethod->Lookup->toClientList($receipt_list) ?>;
	freceiptlist.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipt_list->PaymentMethod->lookupOptions()) ?>;
	loadjs.done("freceiptlist");
});
var freceiptlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freceiptlistsrch = currentSearchForm = new ew.Form("freceiptlistsrch");

	// Validate function for search
	freceiptlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_list->ReceiptDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_list->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($receipt_list->BillYear->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	freceiptlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceiptlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceiptlistsrch.lists["x_ChargeCode"] = <?php echo $receipt_list->ChargeCode->Lookup->toClientList($receipt_list) ?>;
	freceiptlistsrch.lists["x_ChargeCode"].options = <?php echo JsonEncode($receipt_list->ChargeCode->lookupOptions()) ?>;
	freceiptlistsrch.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceiptlistsrch.lists["x_PaymentMethod"] = <?php echo $receipt_list->PaymentMethod->Lookup->toClientList($receipt_list) ?>;
	freceiptlistsrch.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipt_list->PaymentMethod->lookupOptions()) ?>;

	// Filters
	freceiptlistsrch.filterList = <?php echo $receipt_list->getFilterList() ?>;

	// Init search panel as collapsed
	freceiptlistsrch.initSearchPanel = true;
	loadjs.done("freceiptlistsrch");
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
<?php if (!$receipt_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($receipt_list->TotalRecords > 0 && $receipt_list->ExportOptions->visible()) { ?>
<?php $receipt_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_list->ImportOptions->visible()) { ?>
<?php $receipt_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_list->SearchOptions->visible()) { ?>
<?php $receipt_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_list->FilterOptions->visible()) { ?>
<?php $receipt_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$receipt_list->isExport() || Config("EXPORT_MASTER_RECORD") && $receipt_list->isExport("print")) { ?>
<?php
if ($receipt_list->DbMasterFilter != "" && $receipt->getCurrentMasterTable() == "receipt_header") {
	if ($receipt_list->MasterRecordExists) {
		include_once "receipt_headermaster.php";
	}
}
?>
<?php } ?>
<?php
$receipt_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$receipt_list->isExport() && !$receipt->CurrentAction) { ?>
<form name="freceiptlistsrch" id="freceiptlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freceiptlistsrch-search-panel" class="<?php echo $receipt_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="receipt">
	<div class="ew-extended-search">
<?php

// Render search row
$receipt->RowType = ROWTYPE_SEARCH;
$receipt->resetAttributes();
$receipt_list->renderRow();
?>
<?php if ($receipt_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $receipt_list->ChargeCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		<span id="el_receipt_ChargeCode" class="ew-search-field">
<?php
$onchange = $receipt_list->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_list->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeCode" id="sv_x_ChargeCode" value="<?php echo RemoveHtml($receipt_list->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_list->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_list->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_list->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_list->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_list->ChargeCode->ReadOnly || $receipt_list->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_list->ChargeCode->displayValueSeparatorAttribute() ?>" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($receipt_list->ChargeCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptlistsrch"], function() {
	freceiptlistsrch.createAutoSuggest({"id":"x_ChargeCode","forceSelect":false});
});
</script>
<?php echo $receipt_list->ChargeCode->Lookup->getParamTag($receipt_list, "p_x_ChargeCode") ?>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ReceiptNo" class="ew-cell form-group">
		<label for="x_ReceiptNo" class="ew-search-caption ew-label"><?php echo $receipt_list->ReceiptNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ReceiptNo" id="z_ReceiptNo" value="LIKE">
</span>
		<span id="el_receipt_ReceiptNo" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x_ReceiptNo" id="x_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_list->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ReceiptNo->EditValue ?>"<?php echo $receipt_list->ReceiptNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ReceiptDate" class="ew-cell form-group">
		<label for="x_ReceiptDate" class="ew-search-caption ew-label"><?php echo $receipt_list->ReceiptDate->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="BETWEEN">
</span>
		<span id="el_receipt_ReceiptDate" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ReceiptDate" data-format="7" name="x_ReceiptDate" id="x_ReceiptDate" placeholder="<?php echo HtmlEncode($receipt_list->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ReceiptDate->EditValue ?>"<?php echo $receipt_list->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_list->ReceiptDate->ReadOnly && !$receipt_list->ReceiptDate->Disabled && !isset($receipt_list->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_list->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceiptlistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceiptlistsrch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_receipt_ReceiptDate" class="ew-search-field2">
<input type="text" data-table="receipt" data-field="x_ReceiptDate" data-format="7" name="y_ReceiptDate" id="y_ReceiptDate" placeholder="<?php echo HtmlEncode($receipt_list->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ReceiptDate->EditValue2 ?>"<?php echo $receipt_list->ReceiptDate->editAttributes() ?>>
<?php if (!$receipt_list->ReceiptDate->ReadOnly && !$receipt_list->ReceiptDate->Disabled && !isset($receipt_list->ReceiptDate->EditAttrs["readonly"]) && !isset($receipt_list->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceiptlistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("freceiptlistsrch", "y_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PaymentMethod" class="ew-cell form-group">
		<label for="x_PaymentMethod" class="ew-search-caption ew-label"><?php echo $receipt_list->PaymentMethod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		<span id="el_receipt_PaymentMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_list->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $receipt_list->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_list->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_list->PaymentMethod->Lookup->getParamTag($receipt_list, "p_x_PaymentMethod") ?>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->CashierNo->Visible) { // CashierNo ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_CashierNo" class="ew-cell form-group">
		<label for="x_CashierNo" class="ew-search-caption ew-label"><?php echo $receipt_list->CashierNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CashierNo" id="z_CashierNo" value="=">
</span>
		<span id="el_receipt_CashierNo" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_CashierNo" name="x_CashierNo" id="x_CashierNo" size="30" placeholder="<?php echo HtmlEncode($receipt_list->CashierNo->getPlaceHolder()) ?>" value="<?php echo $receipt_list->CashierNo->EditValue ?>"<?php echo $receipt_list->CashierNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BillPeriod" class="ew-cell form-group">
		<label for="x_BillPeriod" class="ew-search-caption ew-label"><?php echo $receipt_list->BillPeriod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		<span id="el_receipt_BillPeriod" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_list->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_list->BillPeriod->EditValue ?>"<?php echo $receipt_list->BillPeriod->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->BillYear->Visible) { // BillYear ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BillYear" class="ew-cell form-group">
		<label for="x_BillYear" class="ew-search-caption ew-label"><?php echo $receipt_list->BillYear->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		<span id="el_receipt_BillYear" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_list->BillYear->EditValue ?>"<?php echo $receipt_list->BillYear->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php
		$receipt_list->SearchColumnCount++;
		if (($receipt_list->SearchColumnCount - 1) % $receipt_list->SearchFieldsPerRow == 0) {
			$receipt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeGroup" class="ew-cell form-group">
		<label for="x_ChargeGroup" class="ew-search-caption ew-label"><?php echo $receipt_list->ChargeGroup->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="LIKE">
</span>
		<span id="el_receipt_ChargeGroup" class="ew-search-field">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_list->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ChargeGroup->EditValue ?>"<?php echo $receipt_list->ChargeGroup->editAttributes() ?>>
</span>
	</div>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($receipt_list->SearchColumnCount % $receipt_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $receipt_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($receipt_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($receipt_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $receipt_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($receipt_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($receipt_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($receipt_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($receipt_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $receipt_list->showPageHeader(); ?>
<?php
$receipt_list->showMessage();
?>
<?php if ($receipt_list->TotalRecords > 0 || $receipt->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($receipt_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> receipt">
<?php if (!$receipt_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$receipt_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipt_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freceiptlist" id="freceiptlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt">
<?php if ($receipt->getCurrentMasterTable() == "receipt_header" && $receipt->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="receipt_header">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($receipt_list->ClientSerNo->getSessionValue()) ?>">
<input type="hidden" name="fk_ReceiptNo" value="<?php echo HtmlEncode($receipt_list->ReceiptNo->getSessionValue()) ?>">
<input type="hidden" name="fk_PaymentMethod" value="<?php echo HtmlEncode($receipt_list->PaymentMethod->getSessionValue()) ?>">
<input type="hidden" name="fk_ChargeGroup" value="<?php echo HtmlEncode($receipt_list->ChargeGroup->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_receipt" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($receipt_list->TotalRecords > 0 || $receipt_list->isGridEdit()) { ?>
<table id="tbl_receiptlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$receipt->RowType = ROWTYPE_HEADER;

// Render list options
$receipt_list->renderListOptions();

// Render list options (header, left)
$receipt_list->ListOptions->render("header", "left");
?>
<?php if ($receipt_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipt_list->SortUrl($receipt_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_list->ClientSerNo->headerCellClass() ?>"><div id="elh_receipt_ClientSerNo" class="receipt_ClientSerNo"><div class="ew-table-header-caption"><?php echo $receipt_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->ClientSerNo) ?>', 1);"><div id="elh_receipt_ClientSerNo" class="receipt_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($receipt_list->SortUrl($receipt_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $receipt_list->ChargeCode->headerCellClass() ?>"><div id="elh_receipt_ChargeCode" class="receipt_ChargeCode"><div class="ew-table-header-caption"><?php echo $receipt_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $receipt_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->ChargeCode) ?>', 1);"><div id="elh_receipt_ChargeCode" class="receipt_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ItemID->Visible) { // ItemID ?>
	<?php if ($receipt_list->SortUrl($receipt_list->ItemID) == "") { ?>
		<th data-name="ItemID" class="<?php echo $receipt_list->ItemID->headerCellClass() ?>"><div id="elh_receipt_ItemID" class="receipt_ItemID"><div class="ew-table-header-caption"><?php echo $receipt_list->ItemID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemID" class="<?php echo $receipt_list->ItemID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->ItemID) ?>', 1);"><div id="elh_receipt_ItemID" class="receipt_ItemID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->ItemID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->ItemID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->ItemID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->UnitCost->Visible) { // UnitCost ?>
	<?php if ($receipt_list->SortUrl($receipt_list->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $receipt_list->UnitCost->headerCellClass() ?>"><div id="elh_receipt_UnitCost" class="receipt_UnitCost"><div class="ew-table-header-caption"><?php echo $receipt_list->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $receipt_list->UnitCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->UnitCost) ?>', 1);"><div id="elh_receipt_UnitCost" class="receipt_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->Quantity->Visible) { // Quantity ?>
	<?php if ($receipt_list->SortUrl($receipt_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $receipt_list->Quantity->headerCellClass() ?>"><div id="elh_receipt_Quantity" class="receipt_Quantity"><div class="ew-table-header-caption"><?php echo $receipt_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $receipt_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->Quantity) ?>', 1);"><div id="elh_receipt_Quantity" class="receipt_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($receipt_list->SortUrl($receipt_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipt_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_receipt_UnitOfMeasure" class="receipt_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $receipt_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipt_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->UnitOfMeasure) ?>', 1);"><div id="elh_receipt_UnitOfMeasure" class="receipt_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($receipt_list->SortUrl($receipt_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $receipt_list->AmountPaid->headerCellClass() ?>"><div id="elh_receipt_AmountPaid" class="receipt_AmountPaid"><div class="ew-table-header-caption"><?php echo $receipt_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $receipt_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->AmountPaid) ?>', 1);"><div id="elh_receipt_AmountPaid" class="receipt_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipt_list->SortUrl($receipt_list->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_list->ReceiptNo->headerCellClass() ?>"><div id="elh_receipt_ReceiptNo" class="receipt_ReceiptNo"><div class="ew-table-header-caption"><?php echo $receipt_list->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_list->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->ReceiptNo) ?>', 1);"><div id="elh_receipt_ReceiptNo" class="receipt_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->ReceiptNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipt_list->SortUrl($receipt_list->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_list->ReceiptDate->headerCellClass() ?>"><div id="elh_receipt_ReceiptDate" class="receipt_ReceiptDate"><div class="ew-table-header-caption"><?php echo $receipt_list->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_list->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->ReceiptDate) ?>', 1);"><div id="elh_receipt_ReceiptDate" class="receipt_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipt_list->SortUrl($receipt_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_list->PaymentMethod->headerCellClass() ?>"><div id="elh_receipt_PaymentMethod" class="receipt_PaymentMethod"><div class="ew-table-header-caption"><?php echo $receipt_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->PaymentMethod) ?>', 1);"><div id="elh_receipt_PaymentMethod" class="receipt_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->PaymentRef->Visible) { // PaymentRef ?>
	<?php if ($receipt_list->SortUrl($receipt_list->PaymentRef) == "") { ?>
		<th data-name="PaymentRef" class="<?php echo $receipt_list->PaymentRef->headerCellClass() ?>"><div id="elh_receipt_PaymentRef" class="receipt_PaymentRef"><div class="ew-table-header-caption"><?php echo $receipt_list->PaymentRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentRef" class="<?php echo $receipt_list->PaymentRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->PaymentRef) ?>', 1);"><div id="elh_receipt_PaymentRef" class="receipt_PaymentRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->PaymentRef->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->PaymentRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->PaymentRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->CashierNo->Visible) { // CashierNo ?>
	<?php if ($receipt_list->SortUrl($receipt_list->CashierNo) == "") { ?>
		<th data-name="CashierNo" class="<?php echo $receipt_list->CashierNo->headerCellClass() ?>"><div id="elh_receipt_CashierNo" class="receipt_CashierNo"><div class="ew-table-header-caption"><?php echo $receipt_list->CashierNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CashierNo" class="<?php echo $receipt_list->CashierNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->CashierNo) ?>', 1);"><div id="elh_receipt_CashierNo" class="receipt_CashierNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->CashierNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($receipt_list->SortUrl($receipt_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $receipt_list->BillPeriod->headerCellClass() ?>"><div id="elh_receipt_BillPeriod" class="receipt_BillPeriod"><div class="ew-table-header-caption"><?php echo $receipt_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $receipt_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->BillPeriod) ?>', 1);"><div id="elh_receipt_BillPeriod" class="receipt_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->BillYear->Visible) { // BillYear ?>
	<?php if ($receipt_list->SortUrl($receipt_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $receipt_list->BillYear->headerCellClass() ?>"><div id="elh_receipt_BillYear" class="receipt_BillYear"><div class="ew-table-header-caption"><?php echo $receipt_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $receipt_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->BillYear) ?>', 1);"><div id="elh_receipt_BillYear" class="receipt_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipt_list->SortUrl($receipt_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_list->ChargeGroup->headerCellClass() ?>"><div id="elh_receipt_ChargeGroup" class="receipt_ChargeGroup"><div class="ew-table-header-caption"><?php echo $receipt_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->ChargeGroup) ?>', 1);"><div id="elh_receipt_ChargeGroup" class="receipt_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->ChargeGroup->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_list->ClientID->Visible) { // ClientID ?>
	<?php if ($receipt_list->SortUrl($receipt_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $receipt_list->ClientID->headerCellClass() ?>"><div id="elh_receipt_ClientID" class="receipt_ClientID"><div class="ew-table-header-caption"><?php echo $receipt_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $receipt_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_list->SortUrl($receipt_list->ClientID) ?>', 1);"><div id="elh_receipt_ClientID" class="receipt_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipt_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($receipt_list->ExportAll && $receipt_list->isExport()) {
	$receipt_list->StopRecord = $receipt_list->TotalRecords;
} else {

	// Set the last record to display
	if ($receipt_list->TotalRecords > $receipt_list->StartRecord + $receipt_list->DisplayRecords - 1)
		$receipt_list->StopRecord = $receipt_list->StartRecord + $receipt_list->DisplayRecords - 1;
	else
		$receipt_list->StopRecord = $receipt_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($receipt->isConfirm() || $receipt_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($receipt_list->FormKeyCountName) && ($receipt_list->isGridAdd() || $receipt_list->isGridEdit() || $receipt->isConfirm())) {
		$receipt_list->KeyCount = $CurrentForm->getValue($receipt_list->FormKeyCountName);
		$receipt_list->StopRecord = $receipt_list->StartRecord + $receipt_list->KeyCount - 1;
	}
}
$receipt_list->RecordCount = $receipt_list->StartRecord - 1;
if ($receipt_list->Recordset && !$receipt_list->Recordset->EOF) {
	$receipt_list->Recordset->moveFirst();
	$selectLimit = $receipt_list->UseSelectLimit;
	if (!$selectLimit && $receipt_list->StartRecord > 1)
		$receipt_list->Recordset->move($receipt_list->StartRecord - 1);
} elseif (!$receipt->AllowAddDeleteRow && $receipt_list->StopRecord == 0) {
	$receipt_list->StopRecord = $receipt->GridAddRowCount;
}

// Initialize aggregate
$receipt->RowType = ROWTYPE_AGGREGATEINIT;
$receipt->resetAttributes();
$receipt_list->renderRow();
if ($receipt_list->isGridAdd())
	$receipt_list->RowIndex = 0;
while ($receipt_list->RecordCount < $receipt_list->StopRecord) {
	$receipt_list->RecordCount++;
	if ($receipt_list->RecordCount >= $receipt_list->StartRecord) {
		$receipt_list->RowCount++;
		if ($receipt_list->isGridAdd() || $receipt_list->isGridEdit() || $receipt->isConfirm()) {
			$receipt_list->RowIndex++;
			$CurrentForm->Index = $receipt_list->RowIndex;
			if ($CurrentForm->hasValue($receipt_list->FormActionName) && ($receipt->isConfirm() || $receipt_list->EventCancelled))
				$receipt_list->RowAction = strval($CurrentForm->getValue($receipt_list->FormActionName));
			elseif ($receipt_list->isGridAdd())
				$receipt_list->RowAction = "insert";
			else
				$receipt_list->RowAction = "";
		}

		// Set up key count
		$receipt_list->KeyCount = $receipt_list->RowIndex;

		// Init row class and style
		$receipt->resetAttributes();
		$receipt->CssClass = "";
		if ($receipt_list->isGridAdd()) {
			$receipt_list->loadRowValues(); // Load default values
		} else {
			$receipt_list->loadRowValues($receipt_list->Recordset); // Load row values
		}
		$receipt->RowType = ROWTYPE_VIEW; // Render view
		if ($receipt_list->isGridAdd()) // Grid add
			$receipt->RowType = ROWTYPE_ADD; // Render add
		if ($receipt_list->isGridAdd() && $receipt->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$receipt_list->restoreCurrentRowFormValues($receipt_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$receipt->RowAttrs->merge(["data-rowindex" => $receipt_list->RowCount, "id" => "r" . $receipt_list->RowCount . "_receipt", "data-rowtype" => $receipt->RowType]);

		// Render row
		$receipt_list->renderRow();

		// Render list options
		$receipt_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($receipt_list->RowAction != "delete" && $receipt_list->RowAction != "insertdelete" && !($receipt_list->RowAction == "insert" && $receipt->isConfirm() && $receipt_list->emptyRow())) {
?>
	<tr <?php echo $receipt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipt_list->ListOptions->render("body", "left", $receipt_list->RowCount);
?>
	<?php if ($receipt_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $receipt_list->ClientSerNo->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_list->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ClientSerNo" class="form-group">
<span<?php echo $receipt_list->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" name="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_list->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ClientSerNo" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $receipt_list->RowIndex ?>_ClientSerNo"><?php echo EmptyValue(strval($receipt_list->ClientSerNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_list->ClientSerNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_list->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_list->ClientSerNo->ReadOnly || $receipt_list->ClientSerNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_list->RowIndex ?>_ClientSerNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_list->ClientSerNo->Lookup->getParamTag($receipt_list, "p_x" . $receipt_list->RowIndex . "_ClientSerNo") ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_list->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" id="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" value="<?php echo $receipt_list->ClientSerNo->CurrentValue ?>"<?php echo $receipt_list->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="o<?php echo $receipt_list->RowIndex ?>_ClientSerNo" id="o<?php echo $receipt_list->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_list->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ClientSerNo">
<span<?php echo $receipt_list->ClientSerNo->viewAttributes() ?>><?php echo $receipt_list->ClientSerNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $receipt_list->ChargeCode->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ChargeCode" class="form-group">
<?php
$onchange = $receipt_list->ChargeCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_list->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipt_list->RowIndex ?>_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $receipt_list->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipt_list->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipt_list->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_list->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_list->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_list->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_list->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_list->RowIndex ?>_ChargeCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_list->ChargeCode->ReadOnly || $receipt_list->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_list->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_list->RowIndex ?>_ChargeCode" id="x<?php echo $receipt_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_list->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptlist"], function() {
	freceiptlist.createAutoSuggest({"id":"x<?php echo $receipt_list->RowIndex ?>_ChargeCode","forceSelect":true});
});
</script>
<?php echo $receipt_list->ChargeCode->Lookup->getParamTag($receipt_list, "p_x" . $receipt_list->RowIndex . "_ChargeCode") ?>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="o<?php echo $receipt_list->RowIndex ?>_ChargeCode" id="o<?php echo $receipt_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_list->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ChargeCode">
<span<?php echo $receipt_list->ChargeCode->viewAttributes() ?>><?php echo $receipt_list->ChargeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" <?php echo $receipt_list->ItemID->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ItemID" class="form-group">
<input type="text" data-table="receipt" data-field="x_ItemID" name="x<?php echo $receipt_list->RowIndex ?>_ItemID" id="x<?php echo $receipt_list->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_list->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ItemID->EditValue ?>"<?php echo $receipt_list->ItemID->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="o<?php echo $receipt_list->RowIndex ?>_ItemID" id="o<?php echo $receipt_list->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_list->ItemID->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ItemID">
<span<?php echo $receipt_list->ItemID->viewAttributes() ?>><?php echo $receipt_list->ItemID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $receipt_list->UnitCost->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_UnitCost" class="form-group">
<input type="text" data-table="receipt" data-field="x_UnitCost" name="x<?php echo $receipt_list->RowIndex ?>_UnitCost" id="x<?php echo $receipt_list->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($receipt_list->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_list->UnitCost->EditValue ?>"<?php echo $receipt_list->UnitCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="o<?php echo $receipt_list->RowIndex ?>_UnitCost" id="o<?php echo $receipt_list->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_list->UnitCost->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_UnitCost">
<span<?php echo $receipt_list->UnitCost->viewAttributes() ?>><?php echo $receipt_list->UnitCost->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $receipt_list->Quantity->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_Quantity" class="form-group">
<input type="text" data-table="receipt" data-field="x_Quantity" name="x<?php echo $receipt_list->RowIndex ?>_Quantity" id="x<?php echo $receipt_list->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($receipt_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_list->Quantity->EditValue ?>"<?php echo $receipt_list->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="o<?php echo $receipt_list->RowIndex ?>_Quantity" id="o<?php echo $receipt_list->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_list->Quantity->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_Quantity">
<span<?php echo $receipt_list->Quantity->viewAttributes() ?>><?php echo $receipt_list->Quantity->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $receipt_list->UnitOfMeasure->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_UnitOfMeasure" class="form-group">
<input type="text" data-table="receipt" data-field="x_UnitOfMeasure" name="x<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_list->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_list->UnitOfMeasure->EditValue ?>"<?php echo $receipt_list->UnitOfMeasure->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="o<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_list->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_UnitOfMeasure">
<span<?php echo $receipt_list->UnitOfMeasure->viewAttributes() ?>><?php echo $receipt_list->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $receipt_list->AmountPaid->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_AmountPaid" class="form-group">
<input type="text" data-table="receipt" data-field="x_AmountPaid" name="x<?php echo $receipt_list->RowIndex ?>_AmountPaid" id="x<?php echo $receipt_list->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($receipt_list->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_list->AmountPaid->EditValue ?>"<?php echo $receipt_list->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="o<?php echo $receipt_list->RowIndex ?>_AmountPaid" id="o<?php echo $receipt_list->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_list->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_AmountPaid">
<span<?php echo $receipt_list->AmountPaid->viewAttributes() ?>><?php echo $receipt_list->AmountPaid->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $receipt_list->ReceiptNo->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_list->ReceiptNo->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ReceiptNo" class="form-group">
<span<?php echo $receipt_list->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" name="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_list->ReceiptNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ReceiptNo" class="form-group">
<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" id="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_list->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ReceiptNo->EditValue ?>"<?php echo $receipt_list->ReceiptNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="o<?php echo $receipt_list->RowIndex ?>_ReceiptNo" id="o<?php echo $receipt_list->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_list->ReceiptNo->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ReceiptNo">
<span<?php echo $receipt_list->ReceiptNo->viewAttributes() ?>><?php echo $receipt_list->ReceiptNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $receipt_list->ReceiptDate->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="o<?php echo $receipt_list->RowIndex ?>_ReceiptDate" id="o<?php echo $receipt_list->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_list->ReceiptDate->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ReceiptDate">
<span<?php echo $receipt_list->ReceiptDate->viewAttributes() ?>><?php echo $receipt_list->ReceiptDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $receipt_list->PaymentMethod->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_list->PaymentMethod->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_PaymentMethod" class="form-group">
<span<?php echo $receipt_list->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_list->PaymentMethod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_PaymentMethod" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_list->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod"<?php echo $receipt_list->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_list->PaymentMethod->selectOptionListHtml("x{$receipt_list->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_list->PaymentMethod->Lookup->getParamTag($receipt_list, "p_x" . $receipt_list->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="o<?php echo $receipt_list->RowIndex ?>_PaymentMethod" id="o<?php echo $receipt_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_list->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_PaymentMethod">
<span<?php echo $receipt_list->PaymentMethod->viewAttributes() ?>><?php echo $receipt_list->PaymentMethod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" <?php echo $receipt_list->PaymentRef->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_PaymentRef" class="form-group">
<input type="text" data-table="receipt" data-field="x_PaymentRef" name="x<?php echo $receipt_list->RowIndex ?>_PaymentRef" id="x<?php echo $receipt_list->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_list->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_list->PaymentRef->EditValue ?>"<?php echo $receipt_list->PaymentRef->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="o<?php echo $receipt_list->RowIndex ?>_PaymentRef" id="o<?php echo $receipt_list->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_list->PaymentRef->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_PaymentRef">
<span<?php echo $receipt_list->PaymentRef->viewAttributes() ?>><?php echo $receipt_list->PaymentRef->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" <?php echo $receipt_list->CashierNo->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="o<?php echo $receipt_list->RowIndex ?>_CashierNo" id="o<?php echo $receipt_list->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_list->CashierNo->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_CashierNo">
<span<?php echo $receipt_list->CashierNo->viewAttributes() ?>><?php echo $receipt_list->CashierNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $receipt_list->BillPeriod->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_BillPeriod" class="form-group">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x<?php echo $receipt_list->RowIndex ?>_BillPeriod" id="x<?php echo $receipt_list->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_list->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_list->BillPeriod->EditValue ?>"<?php echo $receipt_list->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="o<?php echo $receipt_list->RowIndex ?>_BillPeriod" id="o<?php echo $receipt_list->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_list->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_BillPeriod">
<span<?php echo $receipt_list->BillPeriod->viewAttributes() ?>><?php echo $receipt_list->BillPeriod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $receipt_list->BillYear->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_BillYear" class="form-group">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x<?php echo $receipt_list->RowIndex ?>_BillYear" id="x<?php echo $receipt_list->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_list->BillYear->EditValue ?>"<?php echo $receipt_list->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="o<?php echo $receipt_list->RowIndex ?>_BillYear" id="o<?php echo $receipt_list->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_list->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_BillYear">
<span<?php echo $receipt_list->BillYear->viewAttributes() ?>><?php echo $receipt_list->BillYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $receipt_list->ChargeGroup->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_list->ChargeGroup->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ChargeGroup" class="form-group">
<span<?php echo $receipt_list->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" name="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_list->ChargeGroup->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ChargeGroup" class="form-group">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" id="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_list->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ChargeGroup->EditValue ?>"<?php echo $receipt_list->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="o<?php echo $receipt_list->RowIndex ?>_ChargeGroup" id="o<?php echo $receipt_list->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_list->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ChargeGroup">
<span<?php echo $receipt_list->ChargeGroup->viewAttributes() ?>><?php echo $receipt_list->ChargeGroup->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $receipt_list->ClientID->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ClientID" class="form-group">
<input type="text" data-table="receipt" data-field="x_ClientID" name="x<?php echo $receipt_list->RowIndex ?>_ClientID" id="x<?php echo $receipt_list->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_list->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ClientID->EditValue ?>"<?php echo $receipt_list->ClientID->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="o<?php echo $receipt_list->RowIndex ?>_ClientID" id="o<?php echo $receipt_list->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_list->ClientID->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_list->RowCount ?>_receipt_ClientID">
<span<?php echo $receipt_list->ClientID->viewAttributes() ?>><?php echo $receipt_list->ClientID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipt_list->ListOptions->render("body", "right", $receipt_list->RowCount);
?>
	</tr>
<?php if ($receipt->RowType == ROWTYPE_ADD || $receipt->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["freceiptlist", "load"], function() {
	freceiptlist.updateLists(<?php echo $receipt_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$receipt_list->isGridAdd())
		if (!$receipt_list->Recordset->EOF)
			$receipt_list->Recordset->moveNext();
}
?>
<?php
	if ($receipt_list->isGridAdd() || $receipt_list->isGridEdit()) {
		$receipt_list->RowIndex = '$rowindex$';
		$receipt_list->loadRowValues();

		// Set row properties
		$receipt->resetAttributes();
		$receipt->RowAttrs->merge(["data-rowindex" => $receipt_list->RowIndex, "id" => "r0_receipt", "data-rowtype" => ROWTYPE_ADD]);
		$receipt->RowAttrs->appendClass("ew-template");
		$receipt->RowType = ROWTYPE_ADD;

		// Render row
		$receipt_list->renderRow();

		// Render list options
		$receipt_list->renderListOptions();
		$receipt_list->StartRowCount = 0;
?>
	<tr <?php echo $receipt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipt_list->ListOptions->render("body", "left", $receipt_list->RowIndex);
?>
	<?php if ($receipt_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo">
<?php if ($receipt_list->ClientSerNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_ClientSerNo" class="form-group receipt_ClientSerNo">
<span<?php echo $receipt_list->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" name="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_list->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_ClientSerNo" class="form-group receipt_ClientSerNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $receipt_list->RowIndex ?>_ClientSerNo"><?php echo EmptyValue(strval($receipt_list->ClientSerNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_list->ClientSerNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_list->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_list->ClientSerNo->ReadOnly || $receipt_list->ClientSerNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_list->RowIndex ?>_ClientSerNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_list->ClientSerNo->Lookup->getParamTag($receipt_list, "p_x" . $receipt_list->RowIndex . "_ClientSerNo") ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_list->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" id="x<?php echo $receipt_list->RowIndex ?>_ClientSerNo" value="<?php echo $receipt_list->ClientSerNo->CurrentValue ?>"<?php echo $receipt_list->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="o<?php echo $receipt_list->RowIndex ?>_ClientSerNo" id="o<?php echo $receipt_list->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_list->ClientSerNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<span id="el$rowindex$_receipt_ChargeCode" class="form-group receipt_ChargeCode">
<?php
$onchange = $receipt_list->ChargeCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_list->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipt_list->RowIndex ?>_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $receipt_list->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipt_list->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipt_list->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_list->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_list->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_list->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_list->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_list->RowIndex ?>_ChargeCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_list->ChargeCode->ReadOnly || $receipt_list->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_list->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_list->RowIndex ?>_ChargeCode" id="x<?php echo $receipt_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_list->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptlist"], function() {
	freceiptlist.createAutoSuggest({"id":"x<?php echo $receipt_list->RowIndex ?>_ChargeCode","forceSelect":true});
});
</script>
<?php echo $receipt_list->ChargeCode->Lookup->getParamTag($receipt_list, "p_x" . $receipt_list->RowIndex . "_ChargeCode") ?>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="o<?php echo $receipt_list->RowIndex ?>_ChargeCode" id="o<?php echo $receipt_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_list->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID">
<span id="el$rowindex$_receipt_ItemID" class="form-group receipt_ItemID">
<input type="text" data-table="receipt" data-field="x_ItemID" name="x<?php echo $receipt_list->RowIndex ?>_ItemID" id="x<?php echo $receipt_list->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_list->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ItemID->EditValue ?>"<?php echo $receipt_list->ItemID->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="o<?php echo $receipt_list->RowIndex ?>_ItemID" id="o<?php echo $receipt_list->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_list->ItemID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost">
<span id="el$rowindex$_receipt_UnitCost" class="form-group receipt_UnitCost">
<input type="text" data-table="receipt" data-field="x_UnitCost" name="x<?php echo $receipt_list->RowIndex ?>_UnitCost" id="x<?php echo $receipt_list->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($receipt_list->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_list->UnitCost->EditValue ?>"<?php echo $receipt_list->UnitCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="o<?php echo $receipt_list->RowIndex ?>_UnitCost" id="o<?php echo $receipt_list->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_list->UnitCost->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity">
<span id="el$rowindex$_receipt_Quantity" class="form-group receipt_Quantity">
<input type="text" data-table="receipt" data-field="x_Quantity" name="x<?php echo $receipt_list->RowIndex ?>_Quantity" id="x<?php echo $receipt_list->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($receipt_list->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_list->Quantity->EditValue ?>"<?php echo $receipt_list->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="o<?php echo $receipt_list->RowIndex ?>_Quantity" id="o<?php echo $receipt_list->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_list->Quantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<span id="el$rowindex$_receipt_UnitOfMeasure" class="form-group receipt_UnitOfMeasure">
<input type="text" data-table="receipt" data-field="x_UnitOfMeasure" name="x<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_list->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_list->UnitOfMeasure->EditValue ?>"<?php echo $receipt_list->UnitOfMeasure->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="o<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipt_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_list->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<span id="el$rowindex$_receipt_AmountPaid" class="form-group receipt_AmountPaid">
<input type="text" data-table="receipt" data-field="x_AmountPaid" name="x<?php echo $receipt_list->RowIndex ?>_AmountPaid" id="x<?php echo $receipt_list->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($receipt_list->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_list->AmountPaid->EditValue ?>"<?php echo $receipt_list->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="o<?php echo $receipt_list->RowIndex ?>_AmountPaid" id="o<?php echo $receipt_list->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_list->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo">
<?php if ($receipt_list->ReceiptNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_ReceiptNo" class="form-group receipt_ReceiptNo">
<span<?php echo $receipt_list->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" name="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_list->ReceiptNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_ReceiptNo" class="form-group receipt_ReceiptNo">
<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" id="x<?php echo $receipt_list->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_list->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ReceiptNo->EditValue ?>"<?php echo $receipt_list->ReceiptNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="o<?php echo $receipt_list->RowIndex ?>_ReceiptNo" id="o<?php echo $receipt_list->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_list->ReceiptNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate">
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="o<?php echo $receipt_list->RowIndex ?>_ReceiptDate" id="o<?php echo $receipt_list->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_list->ReceiptDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod">
<?php if ($receipt_list->PaymentMethod->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_PaymentMethod" class="form-group receipt_PaymentMethod">
<span<?php echo $receipt_list->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_list->PaymentMethod->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_PaymentMethod" class="form-group receipt_PaymentMethod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_list->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_list->RowIndex ?>_PaymentMethod"<?php echo $receipt_list->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_list->PaymentMethod->selectOptionListHtml("x{$receipt_list->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_list->PaymentMethod->Lookup->getParamTag($receipt_list, "p_x" . $receipt_list->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="o<?php echo $receipt_list->RowIndex ?>_PaymentMethod" id="o<?php echo $receipt_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_list->PaymentMethod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef">
<span id="el$rowindex$_receipt_PaymentRef" class="form-group receipt_PaymentRef">
<input type="text" data-table="receipt" data-field="x_PaymentRef" name="x<?php echo $receipt_list->RowIndex ?>_PaymentRef" id="x<?php echo $receipt_list->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_list->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_list->PaymentRef->EditValue ?>"<?php echo $receipt_list->PaymentRef->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="o<?php echo $receipt_list->RowIndex ?>_PaymentRef" id="o<?php echo $receipt_list->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_list->PaymentRef->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo">
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="o<?php echo $receipt_list->RowIndex ?>_CashierNo" id="o<?php echo $receipt_list->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_list->CashierNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<span id="el$rowindex$_receipt_BillPeriod" class="form-group receipt_BillPeriod">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x<?php echo $receipt_list->RowIndex ?>_BillPeriod" id="x<?php echo $receipt_list->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_list->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_list->BillPeriod->EditValue ?>"<?php echo $receipt_list->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="o<?php echo $receipt_list->RowIndex ?>_BillPeriod" id="o<?php echo $receipt_list->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_list->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<span id="el$rowindex$_receipt_BillYear" class="form-group receipt_BillYear">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x<?php echo $receipt_list->RowIndex ?>_BillYear" id="x<?php echo $receipt_list->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_list->BillYear->EditValue ?>"<?php echo $receipt_list->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="o<?php echo $receipt_list->RowIndex ?>_BillYear" id="o<?php echo $receipt_list->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_list->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<?php if ($receipt_list->ChargeGroup->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_ChargeGroup" class="form-group receipt_ChargeGroup">
<span<?php echo $receipt_list->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_list->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" name="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_list->ChargeGroup->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_ChargeGroup" class="form-group receipt_ChargeGroup">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" id="x<?php echo $receipt_list->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_list->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ChargeGroup->EditValue ?>"<?php echo $receipt_list->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="o<?php echo $receipt_list->RowIndex ?>_ChargeGroup" id="o<?php echo $receipt_list->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_list->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID">
<span id="el$rowindex$_receipt_ClientID" class="form-group receipt_ClientID">
<input type="text" data-table="receipt" data-field="x_ClientID" name="x<?php echo $receipt_list->RowIndex ?>_ClientID" id="x<?php echo $receipt_list->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_list->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_list->ClientID->EditValue ?>"<?php echo $receipt_list->ClientID->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="o<?php echo $receipt_list->RowIndex ?>_ClientID" id="o<?php echo $receipt_list->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_list->ClientID->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipt_list->ListOptions->render("body", "right", $receipt_list->RowIndex);
?>
<script>
loadjs.ready(["freceiptlist", "load"], function() {
	freceiptlist.updateLists(<?php echo $receipt_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$receipt->RowType = ROWTYPE_AGGREGATE;
$receipt->resetAttributes();
$receipt_list->renderRow();
?>
<?php if ($receipt_list->TotalRecords > 0 && !$receipt_list->isGridAdd() && !$receipt_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$receipt_list->renderListOptions();

// Render list options (footer, left)
$receipt_list->ListOptions->render("footer", "left");
?>
	<?php if ($receipt_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" class="<?php echo $receipt_list->ClientSerNo->footerCellClass() ?>"><span id="elf_receipt_ClientSerNo" class="receipt_ClientSerNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" class="<?php echo $receipt_list->ChargeCode->footerCellClass() ?>"><span id="elf_receipt_ChargeCode" class="receipt_ChargeCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" class="<?php echo $receipt_list->ItemID->footerCellClass() ?>"><span id="elf_receipt_ItemID" class="receipt_ItemID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" class="<?php echo $receipt_list->UnitCost->footerCellClass() ?>"><span id="elf_receipt_UnitCost" class="receipt_UnitCost">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" class="<?php echo $receipt_list->Quantity->footerCellClass() ?>"><span id="elf_receipt_Quantity" class="receipt_Quantity">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" class="<?php echo $receipt_list->UnitOfMeasure->footerCellClass() ?>"><span id="elf_receipt_UnitOfMeasure" class="receipt_UnitOfMeasure">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $receipt_list->AmountPaid->footerCellClass() ?>"><span id="elf_receipt_AmountPaid" class="receipt_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $receipt_list->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" class="<?php echo $receipt_list->ReceiptNo->footerCellClass() ?>"><span id="elf_receipt_ReceiptNo" class="receipt_ReceiptNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" class="<?php echo $receipt_list->ReceiptDate->footerCellClass() ?>"><span id="elf_receipt_ReceiptDate" class="receipt_ReceiptDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" class="<?php echo $receipt_list->PaymentMethod->footerCellClass() ?>"><span id="elf_receipt_PaymentMethod" class="receipt_PaymentMethod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" class="<?php echo $receipt_list->PaymentRef->footerCellClass() ?>"><span id="elf_receipt_PaymentRef" class="receipt_PaymentRef">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" class="<?php echo $receipt_list->CashierNo->footerCellClass() ?>"><span id="elf_receipt_CashierNo" class="receipt_CashierNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" class="<?php echo $receipt_list->BillPeriod->footerCellClass() ?>"><span id="elf_receipt_BillPeriod" class="receipt_BillPeriod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" class="<?php echo $receipt_list->BillYear->footerCellClass() ?>"><span id="elf_receipt_BillYear" class="receipt_BillYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" class="<?php echo $receipt_list->ChargeGroup->footerCellClass() ?>"><span id="elf_receipt_ChargeGroup" class="receipt_ChargeGroup">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" class="<?php echo $receipt_list->ClientID->footerCellClass() ?>"><span id="elf_receipt_ClientID" class="receipt_ClientID">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$receipt_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($receipt_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $receipt_list->FormKeyCountName ?>" id="<?php echo $receipt_list->FormKeyCountName ?>" value="<?php echo $receipt_list->KeyCount ?>">
<?php echo $receipt_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$receipt->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($receipt_list->Recordset)
	$receipt_list->Recordset->Close();
?>
<?php if (!$receipt_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$receipt_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipt_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($receipt_list->TotalRecords == 0 && !$receipt->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $receipt_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$receipt_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$receipt_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$receipt->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_receipt",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$receipt_list->terminate();
?>