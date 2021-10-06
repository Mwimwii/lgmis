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
$payment_list_view_search = new payment_list_view_search();

// Run the page
$payment_list_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_list_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayment_list_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($payment_list_view_search->IsModal) { ?>
	fpayment_list_viewsearch = currentAdvancedSearchForm = new ew.Form("fpayment_list_viewsearch", "search");
	<?php } else { ?>
	fpayment_list_viewsearch = currentForm = new ew.Form("fpayment_list_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpayment_list_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_LandExtentInHA");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->LandExtentInHA->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LandValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->LandValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ImprovementsValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->ImprovementsValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RateableValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->RateableValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeGroup");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->ChargeGroup->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BalanceBF");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->BalanceBF->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_CurrentDemand");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->CurrentDemand->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VAT");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->VAT->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkByRegEx(elm.value, /^[10]+$/))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->BillYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_search->EndDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpayment_list_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayment_list_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpayment_list_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payment_list_view_search->showPageHeader(); ?>
<?php
$payment_list_view_search->showMessage();
?>
<form name="fpayment_list_viewsearch" id="fpayment_list_viewsearch" class="<?php echo $payment_list_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment_list_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$payment_list_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($payment_list_view_search->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label for="x_PropertyNo" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_PropertyNo"><?php echo $payment_list_view_search->PropertyNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->PropertyNo->cellAttributes() ?>>
			<span id="el_payment_list_view_PropertyNo" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payment_list_view_search->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->PropertyNo->EditValue ?>"<?php echo $payment_list_view_search->PropertyNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->ClientName->Visible) { // ClientName ?>
	<div id="r_ClientName" class="form-group row">
		<label for="x_ClientName" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_ClientName"><?php echo $payment_list_view_search->ClientName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientName" id="z_ClientName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->ClientName->cellAttributes() ?>>
			<span id="el_payment_list_view_ClientName" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payment_list_view_search->ClientName->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->ClientName->EditValue ?>"<?php echo $payment_list_view_search->ClientName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label for="x_PropertyUse" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_PropertyUse"><?php echo $payment_list_view_search->PropertyUse->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->PropertyUse->cellAttributes() ?>>
			<span id="el_payment_list_view_PropertyUse" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payment_list_view_search->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->PropertyUse->EditValue ?>"<?php echo $payment_list_view_search->PropertyUse->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<div id="r_LandExtentInHA" class="form-group row">
		<label for="x_LandExtentInHA" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_LandExtentInHA"><?php echo $payment_list_view_search->LandExtentInHA->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandExtentInHA" id="z_LandExtentInHA" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->LandExtentInHA->cellAttributes() ?>>
			<span id="el_payment_list_view_LandExtentInHA" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_LandExtentInHA" name="x_LandExtentInHA" id="x_LandExtentInHA" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->LandExtentInHA->EditValue ?>"<?php echo $payment_list_view_search->LandExtentInHA->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->LandValue->Visible) { // LandValue ?>
	<div id="r_LandValue" class="form-group row">
		<label for="x_LandValue" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_LandValue"><?php echo $payment_list_view_search->LandValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandValue" id="z_LandValue" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->LandValue->cellAttributes() ?>>
			<span id="el_payment_list_view_LandValue" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_LandValue" name="x_LandValue" id="x_LandValue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->LandValue->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->LandValue->EditValue ?>"<?php echo $payment_list_view_search->LandValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<div id="r_ImprovementsValue" class="form-group row">
		<label for="x_ImprovementsValue" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_ImprovementsValue"><?php echo $payment_list_view_search->ImprovementsValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ImprovementsValue" id="z_ImprovementsValue" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->ImprovementsValue->cellAttributes() ?>>
			<span id="el_payment_list_view_ImprovementsValue" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ImprovementsValue" name="x_ImprovementsValue" id="x_ImprovementsValue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->ImprovementsValue->EditValue ?>"<?php echo $payment_list_view_search->ImprovementsValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label for="x_RateableValue" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_RateableValue"><?php echo $payment_list_view_search->RateableValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RateableValue" id="z_RateableValue" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->RateableValue->cellAttributes() ?>>
			<span id="el_payment_list_view_RateableValue" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->RateableValue->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->RateableValue->EditValue ?>"<?php echo $payment_list_view_search->RateableValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label for="x_ChargeCode" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_ChargeCode"><?php echo $payment_list_view_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->ChargeCode->cellAttributes() ?>>
			<span id="el_payment_list_view_ChargeCode" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payment_list_view_search->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->ChargeCode->EditValue ?>"<?php echo $payment_list_view_search->ChargeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label for="x_ChargeGroup" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_ChargeGroup"><?php echo $payment_list_view_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_payment_list_view_ChargeGroup" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payment_list_view_search->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->ChargeGroup->EditValue ?>"<?php echo $payment_list_view_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label for="x_BalanceBF" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_BalanceBF"><?php echo $payment_list_view_search->BalanceBF->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BalanceBF" id="z_BalanceBF" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->BalanceBF->cellAttributes() ?>>
			<span id="el_payment_list_view_BalanceBF" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->BalanceBF->EditValue ?>"<?php echo $payment_list_view_search->BalanceBF->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label for="x_CurrentDemand" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_CurrentDemand"><?php echo $payment_list_view_search->CurrentDemand->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CurrentDemand" id="z_CurrentDemand" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->CurrentDemand->cellAttributes() ?>>
			<span id="el_payment_list_view_CurrentDemand" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->CurrentDemand->EditValue ?>"<?php echo $payment_list_view_search->CurrentDemand->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label for="x_VAT" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_VAT"><?php echo $payment_list_view_search->VAT->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VAT" id="z_VAT" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->VAT->cellAttributes() ?>>
			<span id="el_payment_list_view_VAT" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->VAT->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->VAT->EditValue ?>"<?php echo $payment_list_view_search->VAT->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_AmountPaid"><?php echo $payment_list_view_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->AmountPaid->cellAttributes() ?>>
			<span id="el_payment_list_view_AmountPaid" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($payment_list_view_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->AmountPaid->EditValue ?>"<?php echo $payment_list_view_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_BillPeriod"><?php echo $payment_list_view_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->BillPeriod->cellAttributes() ?>>
			<span id="el_payment_list_view_BillPeriod" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" maxlength="1" placeholder="<?php echo HtmlEncode($payment_list_view_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->BillPeriod->EditValue ?>"<?php echo $payment_list_view_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_BillYear"><?php echo $payment_list_view_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->BillYear->cellAttributes() ?>>
			<span id="el_payment_list_view_BillYear" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payment_list_view_search->BillYear->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->BillYear->EditValue ?>"<?php echo $payment_list_view_search->BillYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_StartDate"><?php echo $payment_list_view_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->StartDate->cellAttributes() ?>>
			<span id="el_payment_list_view_StartDate" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" maxlength="10" placeholder="<?php echo HtmlEncode($payment_list_view_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->StartDate->EditValue ?>"<?php echo $payment_list_view_search->StartDate->editAttributes() ?>>
<?php if (!$payment_list_view_search->StartDate->ReadOnly && !$payment_list_view_search->StartDate->Disabled && !isset($payment_list_view_search->StartDate->EditAttrs["readonly"]) && !isset($payment_list_view_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpayment_list_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpayment_list_viewsearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_EndDate"><?php echo $payment_list_view_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->EndDate->cellAttributes() ?>>
			<span id="el_payment_list_view_EndDate" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" maxlength="10" placeholder="<?php echo HtmlEncode($payment_list_view_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->EndDate->EditValue ?>"<?php echo $payment_list_view_search->EndDate->editAttributes() ?>>
<?php if (!$payment_list_view_search->EndDate->ReadOnly && !$payment_list_view_search->EndDate->Disabled && !isset($payment_list_view_search->EndDate->EditAttrs["readonly"]) && !isset($payment_list_view_search->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpayment_list_viewsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpayment_list_viewsearch", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($payment_list_view_search->ChargeDesc->Visible) { // ChargeDesc ?>
	<div id="r_ChargeDesc" class="form-group row">
		<label for="x_ChargeDesc" class="<?php echo $payment_list_view_search->LeftColumnClass ?>"><span id="elh_payment_list_view_ChargeDesc"><?php echo $payment_list_view_search->ChargeDesc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeDesc" id="z_ChargeDesc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $payment_list_view_search->RightColumnClass ?>"><div <?php echo $payment_list_view_search->ChargeDesc->cellAttributes() ?>>
			<span id="el_payment_list_view_ChargeDesc" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payment_list_view_search->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_search->ChargeDesc->EditValue ?>"<?php echo $payment_list_view_search->ChargeDesc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payment_list_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payment_list_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payment_list_view_search->showPageFooter();
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
$payment_list_view_search->terminate();
?>