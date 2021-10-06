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
$_property_account_view_search = new _property_account_view_search();

// Run the page
$_property_account_view_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_property_account_view_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_property_account_viewsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($_property_account_view_search->IsModal) { ?>
	f_property_account_viewsearch = currentAdvancedSearchForm = new ew.Form("f_property_account_viewsearch", "search");
	<?php } else { ?>
	f_property_account_viewsearch = currentForm = new ew.Form("f_property_account_viewsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	f_property_account_viewsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ValuationNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->ValuationNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LandValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->LandValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ImprovementsValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->ImprovementsValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RateableValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->RateableValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SupplementaryValue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->SupplementaryValue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LandExtentInHA");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->LandExtentInHA->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BalanceBF");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->BalanceBF->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_CurrentDemand");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->CurrentDemand->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VAT");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->VAT->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkByRegEx(elm.value, /^[10]+$/))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->BillYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountDue");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->AmountDue->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_property_account_view_search->ChargeCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	f_property_account_viewsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_property_account_viewsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("f_property_account_viewsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_property_account_view_search->showPageHeader(); ?>
<?php
$_property_account_view_search->showMessage();
?>
<form name="f_property_account_viewsearch" id="f_property_account_viewsearch" class="<?php echo $_property_account_view_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_property_account_view">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$_property_account_view_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($_property_account_view_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label for="x_ClientSerNo" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_ClientSerNo"><?php echo $_property_account_view_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->ClientSerNo->cellAttributes() ?>>
			<span id="el__property_account_view_ClientSerNo" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_ClientSerNo" name="x_ClientSerNo" id="x_ClientSerNo" maxlength="11" placeholder="<?php echo HtmlEncode($_property_account_view_search->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->ClientSerNo->EditValue ?>"<?php echo $_property_account_view_search->ClientSerNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->ClientName->Visible) { // ClientName ?>
	<div id="r_ClientName" class="form-group row">
		<label for="x_ClientName" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_ClientName"><?php echo $_property_account_view_search->ClientName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientName" id="z_ClientName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->ClientName->cellAttributes() ?>>
			<span id="el__property_account_view_ClientName" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_property_account_view_search->ClientName->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->ClientName->EditValue ?>"<?php echo $_property_account_view_search->ClientName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label for="x_PostalAddress" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_PostalAddress"><?php echo $_property_account_view_search->PostalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PostalAddress" id="z_PostalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->PostalAddress->cellAttributes() ?>>
			<span id="el__property_account_view_PostalAddress" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_property_account_view_search->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->PostalAddress->EditValue ?>"<?php echo $_property_account_view_search->PostalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label for="x_PhysicalAddress" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_PhysicalAddress"><?php echo $_property_account_view_search->PhysicalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PhysicalAddress" id="z_PhysicalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->PhysicalAddress->cellAttributes() ?>>
			<span id="el__property_account_view_PhysicalAddress" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_property_account_view_search->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->PhysicalAddress->EditValue ?>"<?php echo $_property_account_view_search->PhysicalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label for="x_Mobile" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_Mobile"><?php echo $_property_account_view_search->Mobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Mobile" id="z_Mobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->Mobile->cellAttributes() ?>>
			<span id="el__property_account_view_Mobile" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_property_account_view_search->Mobile->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->Mobile->EditValue ?>"<?php echo $_property_account_view_search->Mobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->ValuationNo->Visible) { // ValuationNo ?>
	<div id="r_ValuationNo" class="form-group row">
		<label for="x_ValuationNo" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_ValuationNo"><?php echo $_property_account_view_search->ValuationNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ValuationNo" id="z_ValuationNo" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->ValuationNo->cellAttributes() ?>>
			<span id="el__property_account_view_ValuationNo" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_ValuationNo" name="x_ValuationNo" id="x_ValuationNo" maxlength="11" placeholder="<?php echo HtmlEncode($_property_account_view_search->ValuationNo->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->ValuationNo->EditValue ?>"<?php echo $_property_account_view_search->ValuationNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label for="x_PropertyNo" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_PropertyNo"><?php echo $_property_account_view_search->PropertyNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->PropertyNo->cellAttributes() ?>>
			<span id="el__property_account_view_PropertyNo" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_property_account_view_search->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->PropertyNo->EditValue ?>"<?php echo $_property_account_view_search->PropertyNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label for="x_Location" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_Location"><?php echo $_property_account_view_search->Location->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Location" id="z_Location" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->Location->cellAttributes() ?>>
			<span id="el__property_account_view_Location" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_property_account_view_search->Location->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->Location->EditValue ?>"<?php echo $_property_account_view_search->Location->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->LandValue->Visible) { // LandValue ?>
	<div id="r_LandValue" class="form-group row">
		<label for="x_LandValue" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_LandValue"><?php echo $_property_account_view_search->LandValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandValue" id="z_LandValue" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->LandValue->cellAttributes() ?>>
			<span id="el__property_account_view_LandValue" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_LandValue" name="x_LandValue" id="x_LandValue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->LandValue->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->LandValue->EditValue ?>"<?php echo $_property_account_view_search->LandValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<div id="r_ImprovementsValue" class="form-group row">
		<label for="x_ImprovementsValue" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_ImprovementsValue"><?php echo $_property_account_view_search->ImprovementsValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ImprovementsValue" id="z_ImprovementsValue" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->ImprovementsValue->cellAttributes() ?>>
			<span id="el__property_account_view_ImprovementsValue" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_ImprovementsValue" name="x_ImprovementsValue" id="x_ImprovementsValue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->ImprovementsValue->EditValue ?>"<?php echo $_property_account_view_search->ImprovementsValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->RateableValue->Visible) { // RateableValue ?>
	<div id="r_RateableValue" class="form-group row">
		<label for="x_RateableValue" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_RateableValue"><?php echo $_property_account_view_search->RateableValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RateableValue" id="z_RateableValue" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->RateableValue->cellAttributes() ?>>
			<span id="el__property_account_view_RateableValue" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_RateableValue" name="x_RateableValue" id="x_RateableValue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->RateableValue->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->RateableValue->EditValue ?>"<?php echo $_property_account_view_search->RateableValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<div id="r_SupplementaryValue" class="form-group row">
		<label for="x_SupplementaryValue" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_SupplementaryValue"><?php echo $_property_account_view_search->SupplementaryValue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SupplementaryValue" id="z_SupplementaryValue" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->SupplementaryValue->cellAttributes() ?>>
			<span id="el__property_account_view_SupplementaryValue" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_SupplementaryValue" name="x_SupplementaryValue" id="x_SupplementaryValue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->SupplementaryValue->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->SupplementaryValue->EditValue ?>"<?php echo $_property_account_view_search->SupplementaryValue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->Improvements->Visible) { // Improvements ?>
	<div id="r_Improvements" class="form-group row">
		<label for="x_Improvements" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_Improvements"><?php echo $_property_account_view_search->Improvements->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Improvements" id="z_Improvements" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->Improvements->cellAttributes() ?>>
			<span id="el__property_account_view_Improvements" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_Improvements" name="x_Improvements" id="x_Improvements" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_property_account_view_search->Improvements->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->Improvements->EditValue ?>"<?php echo $_property_account_view_search->Improvements->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<div id="r_LandExtentInHA" class="form-group row">
		<label for="x_LandExtentInHA" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_LandExtentInHA"><?php echo $_property_account_view_search->LandExtentInHA->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LandExtentInHA" id="z_LandExtentInHA" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->LandExtentInHA->cellAttributes() ?>>
			<span id="el__property_account_view_LandExtentInHA" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_LandExtentInHA" name="x_LandExtentInHA" id="x_LandExtentInHA" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->LandExtentInHA->EditValue ?>"<?php echo $_property_account_view_search->LandExtentInHA->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label for="x_BalanceBF" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_BalanceBF"><?php echo $_property_account_view_search->BalanceBF->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BalanceBF" id="z_BalanceBF" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->BalanceBF->cellAttributes() ?>>
			<span id="el__property_account_view_BalanceBF" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->BalanceBF->EditValue ?>"<?php echo $_property_account_view_search->BalanceBF->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label for="x_CurrentDemand" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_CurrentDemand"><?php echo $_property_account_view_search->CurrentDemand->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CurrentDemand" id="z_CurrentDemand" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->CurrentDemand->cellAttributes() ?>>
			<span id="el__property_account_view_CurrentDemand" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->CurrentDemand->EditValue ?>"<?php echo $_property_account_view_search->CurrentDemand->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label for="x_VAT" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_VAT"><?php echo $_property_account_view_search->VAT->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VAT" id="z_VAT" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->VAT->cellAttributes() ?>>
			<span id="el__property_account_view_VAT" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->VAT->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->VAT->EditValue ?>"<?php echo $_property_account_view_search->VAT->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_AmountPaid"><?php echo $_property_account_view_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->AmountPaid->cellAttributes() ?>>
			<span id="el__property_account_view_AmountPaid" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->AmountPaid->EditValue ?>"<?php echo $_property_account_view_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_BillPeriod"><?php echo $_property_account_view_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->BillPeriod->cellAttributes() ?>>
			<span id="el__property_account_view_BillPeriod" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" maxlength="1" placeholder="<?php echo HtmlEncode($_property_account_view_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->BillPeriod->EditValue ?>"<?php echo $_property_account_view_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_BillYear"><?php echo $_property_account_view_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->BillYear->cellAttributes() ?>>
			<span id="el__property_account_view_BillYear" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($_property_account_view_search->BillYear->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->BillYear->EditValue ?>"<?php echo $_property_account_view_search->BillYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->AmountDue->Visible) { // AmountDue ?>
	<div id="r_AmountDue" class="form-group row">
		<label for="x_AmountDue" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_AmountDue"><?php echo $_property_account_view_search->AmountDue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountDue" id="z_AmountDue" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->AmountDue->cellAttributes() ?>>
			<span id="el__property_account_view_AmountDue" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_AmountDue" name="x_AmountDue" id="x_AmountDue" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($_property_account_view_search->AmountDue->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->AmountDue->EditValue ?>"<?php echo $_property_account_view_search->AmountDue->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_property_account_view_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label for="x_ChargeCode" class="<?php echo $_property_account_view_search->LeftColumnClass ?>"><span id="elh__property_account_view_ChargeCode"><?php echo $_property_account_view_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $_property_account_view_search->RightColumnClass ?>"><div <?php echo $_property_account_view_search->ChargeCode->cellAttributes() ?>>
			<span id="el__property_account_view_ChargeCode" class="ew-search-field">
<input type="text" data-table="_property_account_view" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_property_account_view_search->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $_property_account_view_search->ChargeCode->EditValue ?>"<?php echo $_property_account_view_search->ChargeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_property_account_view_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_property_account_view_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_property_account_view_search->showPageFooter();
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
$_property_account_view_search->terminate();
?>