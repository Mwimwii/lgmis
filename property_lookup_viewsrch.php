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
$property_lookup_view_search = new property_lookup_view_search();

// Run the page
$property_lookup_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_lookup_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_lookup_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($property_lookup_view_search->IsModal) { ?>
	fproperty_lookup_viewsearch = currentAdvancedSearchForm = new ew.Form("fproperty_lookup_viewsearch", "search");
	<?php } else { ?>
	fproperty_lookup_viewsearch = currentForm = new ew.Form("fproperty_lookup_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fproperty_lookup_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ValuationNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->ValuationNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeGroup");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->ChargeGroup->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BalanceBF");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->BalanceBF->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_CurrentDemand");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->CurrentDemand->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VAT");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->VAT->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->BillYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->EndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Fee");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($property_lookup_view_search->Fee->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fproperty_lookup_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_lookup_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_lookup_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_lookup_view_search->showPageHeader(); ?>
<?php
$property_lookup_view_search->showMessage();
?>
<form name="fproperty_lookup_viewsearch" id="fproperty_lookup_viewsearch" class="<?php echo $property_lookup_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_lookup_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$property_lookup_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($property_lookup_view_search->ValuationNo->Visible) { // ValuationNo ?>
	<div id="r_ValuationNo" class="form-group row">
		<label for="x_ValuationNo" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_ValuationNo"><?php echo $property_lookup_view_search->ValuationNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ValuationNo" id="z_ValuationNo" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->ValuationNo->cellAttributes() ?>>
			<span id="el_property_lookup_view_ValuationNo" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_ValuationNo" name="x_ValuationNo" id="x_ValuationNo" placeholder="<?php echo HtmlEncode($property_lookup_view_search->ValuationNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->ValuationNo->EditValue ?>"<?php echo $property_lookup_view_search->ValuationNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label for="x_PropertyNo" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_PropertyNo"><?php echo $property_lookup_view_search->PropertyNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->PropertyNo->cellAttributes() ?>>
			<span id="el_property_lookup_view_PropertyNo" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_search->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->PropertyNo->EditValue ?>"<?php echo $property_lookup_view_search->PropertyNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label for="x_ClientSerNo" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_ClientSerNo"><?php echo $property_lookup_view_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_property_lookup_view_ClientSerNo" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_ClientSerNo" name="x_ClientSerNo" id="x_ClientSerNo" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->ClientSerNo->EditValue ?>"<?php echo $property_lookup_view_search->ClientSerNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label for="x_PropertyUse" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_PropertyUse"><?php echo $property_lookup_view_search->PropertyUse->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->PropertyUse->cellAttributes() ?>>
			<span id="el_property_lookup_view_PropertyUse" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($property_lookup_view_search->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->PropertyUse->EditValue ?>"<?php echo $property_lookup_view_search->PropertyUse->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label for="x_Location" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_Location"><?php echo $property_lookup_view_search->Location->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->Location->cellAttributes() ?>>
			<span id="el_property_lookup_view_Location" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_search->Location->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->Location->EditValue ?>"<?php echo $property_lookup_view_search->Location->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label for="x_ChargeCode" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_ChargeCode"><?php echo $property_lookup_view_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->ChargeCode->cellAttributes() ?>>
			<span id="el_property_lookup_view_ChargeCode" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->ChargeCode->EditValue ?>"<?php echo $property_lookup_view_search->ChargeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label for="x_ChargeGroup" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_ChargeGroup"><?php echo $property_lookup_view_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_property_lookup_view_ChargeGroup" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->ChargeGroup->EditValue ?>"<?php echo $property_lookup_view_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label for="x_BalanceBF" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_BalanceBF"><?php echo $property_lookup_view_search->BalanceBF->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BalanceBF" id="z_BalanceBF" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->BalanceBF->cellAttributes() ?>>
			<span id="el_property_lookup_view_BalanceBF" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->BalanceBF->EditValue ?>"<?php echo $property_lookup_view_search->BalanceBF->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label for="x_CurrentDemand" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_CurrentDemand"><?php echo $property_lookup_view_search->CurrentDemand->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CurrentDemand" id="z_CurrentDemand" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->CurrentDemand->cellAttributes() ?>>
			<span id="el_property_lookup_view_CurrentDemand" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->CurrentDemand->EditValue ?>"<?php echo $property_lookup_view_search->CurrentDemand->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label for="x_VAT" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_VAT"><?php echo $property_lookup_view_search->VAT->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VAT" id="z_VAT" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->VAT->cellAttributes() ?>>
			<span id="el_property_lookup_view_VAT" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->VAT->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->VAT->EditValue ?>"<?php echo $property_lookup_view_search->VAT->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_AmountPaid"><?php echo $property_lookup_view_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->AmountPaid->cellAttributes() ?>>
			<span id="el_property_lookup_view_AmountPaid" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->AmountPaid->EditValue ?>"<?php echo $property_lookup_view_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_BillPeriod"><?php echo $property_lookup_view_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->BillPeriod->cellAttributes() ?>>
			<span id="el_property_lookup_view_BillPeriod" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->BillPeriod->EditValue ?>"<?php echo $property_lookup_view_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label for="x_PeriodType" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_PeriodType"><?php echo $property_lookup_view_search->PeriodType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PeriodType" id="z_PeriodType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->PeriodType->cellAttributes() ?>>
			<span id="el_property_lookup_view_PeriodType" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_lookup_view_search->PeriodType->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->PeriodType->EditValue ?>"<?php echo $property_lookup_view_search->PeriodType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_BillYear"><?php echo $property_lookup_view_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->BillYear->cellAttributes() ?>>
			<span id="el_property_lookup_view_BillYear" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->BillYear->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->BillYear->EditValue ?>"<?php echo $property_lookup_view_search->BillYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_StartDate"><?php echo $property_lookup_view_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->StartDate->cellAttributes() ?>>
			<span id="el_property_lookup_view_StartDate" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($property_lookup_view_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->StartDate->EditValue ?>"<?php echo $property_lookup_view_search->StartDate->editAttributes() ?>>
<?php if (!$property_lookup_view_search->StartDate->ReadOnly && !$property_lookup_view_search->StartDate->Disabled && !isset($property_lookup_view_search->StartDate->EditAttrs["readonly"]) && !isset($property_lookup_view_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewsearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_EndDate"><?php echo $property_lookup_view_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->EndDate->cellAttributes() ?>>
			<span id="el_property_lookup_view_EndDate" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($property_lookup_view_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->EndDate->EditValue ?>"<?php echo $property_lookup_view_search->EndDate->editAttributes() ?>>
<?php if (!$property_lookup_view_search->EndDate->ReadOnly && !$property_lookup_view_search->EndDate->Disabled && !isset($property_lookup_view_search->EndDate->EditAttrs["readonly"]) && !isset($property_lookup_view_search->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewsearch", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->ChargeDesc->Visible) { // ChargeDesc ?>
	<div id="r_ChargeDesc" class="form-group row">
		<label for="x_ChargeDesc" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_ChargeDesc"><?php echo $property_lookup_view_search->ChargeDesc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeDesc" id="z_ChargeDesc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->ChargeDesc->cellAttributes() ?>>
			<span id="el_property_lookup_view_ChargeDesc" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_search->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->ChargeDesc->EditValue ?>"<?php echo $property_lookup_view_search->ChargeDesc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->Fee->Visible) { // Fee ?>
	<div id="r_Fee" class="form-group row">
		<label for="x_Fee" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_Fee"><?php echo $property_lookup_view_search->Fee->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Fee" id="z_Fee" value="=">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->Fee->cellAttributes() ?>>
			<span id="el_property_lookup_view_Fee" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_Fee" name="x_Fee" id="x_Fee" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->Fee->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->Fee->EditValue ?>"<?php echo $property_lookup_view_search->Fee->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($property_lookup_view_search->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label for="x_UnitOfMeasure" class="<?php echo $property_lookup_view_search->LeftColumnClass ?>"><span id="elh_property_lookup_view_UnitOfMeasure"><?php echo $property_lookup_view_search->UnitOfMeasure->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UnitOfMeasure" id="z_UnitOfMeasure" value="LIKE">
</span>
		</label>
		<div class="<?php echo $property_lookup_view_search->RightColumnClass ?>"><div <?php echo $property_lookup_view_search->UnitOfMeasure->cellAttributes() ?>>
			<span id="el_property_lookup_view_UnitOfMeasure" class="ew-search-field">
<input type="text" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($property_lookup_view_search->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_search->UnitOfMeasure->EditValue ?>"<?php echo $property_lookup_view_search->UnitOfMeasure->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_lookup_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_lookup_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_lookup_view_search->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$property_lookup_view_search->terminate();
?>