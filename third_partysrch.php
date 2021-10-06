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
$third_party_search = new third_party_search();

// Run the page
$third_party_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$third_party_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fthird_partysearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($third_party_search->IsModal) { ?>
	fthird_partysearch = currentAdvancedSearchForm = new ew.Form("fthird_partysearch", "search");
	<?php } else { ?>
	fthird_partysearch = currentForm = new ew.Form("fthird_partysearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fthird_partysearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_DateOfEngagement");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($third_party_search->DateOfEngagement->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeductionRate");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($third_party_search->DeductionRate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeductionAmount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($third_party_search->DeductionAmount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeductionLimit");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($third_party_search->DeductionLimit->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmployerContribution");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($third_party_search->EmployerContribution->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fthird_partysearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fthird_partysearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fthird_partysearch.lists["x_DeductionCode"] = <?php echo $third_party_search->DeductionCode->Lookup->toClientList($third_party_search) ?>;
	fthird_partysearch.lists["x_DeductionCode"].options = <?php echo JsonEncode($third_party_search->DeductionCode->lookupOptions()) ?>;
	fthird_partysearch.lists["x_BankBranchCode"] = <?php echo $third_party_search->BankBranchCode->Lookup->toClientList($third_party_search) ?>;
	fthird_partysearch.lists["x_BankBranchCode"].options = <?php echo JsonEncode($third_party_search->BankBranchCode->lookupOptions()) ?>;
	fthird_partysearch.lists["x_PaymentMethod"] = <?php echo $third_party_search->PaymentMethod->Lookup->toClientList($third_party_search) ?>;
	fthird_partysearch.lists["x_PaymentMethod"].options = <?php echo JsonEncode($third_party_search->PaymentMethod->lookupOptions()) ?>;
	fthird_partysearch.autoSuggests["x_PaymentMethod"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fthird_partysearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $third_party_search->showPageHeader(); ?>
<?php
$third_party_search->showMessage();
?>
<form name="fthird_partysearch" id="fthird_partysearch" class="<?php echo $third_party_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="third_party">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$third_party_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($third_party_search->ThirdPartyName->Visible) { // ThirdPartyName ?>
	<div id="r_ThirdPartyName" class="form-group row">
		<label for="x_ThirdPartyName" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_ThirdPartyName"><?php echo $third_party_search->ThirdPartyName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ThirdPartyName" id="z_ThirdPartyName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->ThirdPartyName->cellAttributes() ?>>
			<span id="el_third_party_ThirdPartyName" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_ThirdPartyName" name="x_ThirdPartyName" id="x_ThirdPartyName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($third_party_search->ThirdPartyName->getPlaceHolder()) ?>" value="<?php echo $third_party_search->ThirdPartyName->EditValue ?>"<?php echo $third_party_search->ThirdPartyName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->DateOfEngagement->Visible) { // DateOfEngagement ?>
	<div id="r_DateOfEngagement" class="form-group row">
		<label for="x_DateOfEngagement" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_DateOfEngagement"><?php echo $third_party_search->DateOfEngagement->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfEngagement" id="z_DateOfEngagement" value="=">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->DateOfEngagement->cellAttributes() ?>>
			<span id="el_third_party_DateOfEngagement" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_DateOfEngagement" name="x_DateOfEngagement" id="x_DateOfEngagement" placeholder="<?php echo HtmlEncode($third_party_search->DateOfEngagement->getPlaceHolder()) ?>" value="<?php echo $third_party_search->DateOfEngagement->EditValue ?>"<?php echo $third_party_search->DateOfEngagement->editAttributes() ?>>
<?php if (!$third_party_search->DateOfEngagement->ReadOnly && !$third_party_search->DateOfEngagement->Disabled && !isset($third_party_search->DateOfEngagement->EditAttrs["readonly"]) && !isset($third_party_search->DateOfEngagement->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fthird_partysearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fthird_partysearch", "x_DateOfEngagement", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->DeductionCode->Visible) { // DeductionCode ?>
	<div id="r_DeductionCode" class="form-group row">
		<label for="x_DeductionCode" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_DeductionCode"><?php echo $third_party_search->DeductionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionCode" id="z_DeductionCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->DeductionCode->cellAttributes() ?>>
			<span id="el_third_party_DeductionCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DeductionCode"><?php echo EmptyValue(strval($third_party_search->DeductionCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_search->DeductionCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_search->DeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_search->DeductionCode->ReadOnly || $third_party_search->DeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_search->DeductionCode->Lookup->getParamTag($third_party_search, "p_x_DeductionCode") ?>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_search->DeductionCode->displayValueSeparatorAttribute() ?>" name="x_DeductionCode" id="x_DeductionCode" value="<?php echo $third_party_search->DeductionCode->AdvancedSearch->SearchValue ?>"<?php echo $third_party_search->DeductionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->DeductionRate->Visible) { // DeductionRate ?>
	<div id="r_DeductionRate" class="form-group row">
		<label for="x_DeductionRate" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_DeductionRate"><?php echo $third_party_search->DeductionRate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeductionRate" id="z_DeductionRate" value="=">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->DeductionRate->cellAttributes() ?>>
			<span id="el_third_party_DeductionRate" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_DeductionRate" name="x_DeductionRate" id="x_DeductionRate" size="30" placeholder="<?php echo HtmlEncode($third_party_search->DeductionRate->getPlaceHolder()) ?>" value="<?php echo $third_party_search->DeductionRate->EditValue ?>"<?php echo $third_party_search->DeductionRate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->DeductionAmount->Visible) { // DeductionAmount ?>
	<div id="r_DeductionAmount" class="form-group row">
		<label for="x_DeductionAmount" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_DeductionAmount"><?php echo $third_party_search->DeductionAmount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeductionAmount" id="z_DeductionAmount" value="=">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->DeductionAmount->cellAttributes() ?>>
			<span id="el_third_party_DeductionAmount" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_DeductionAmount" name="x_DeductionAmount" id="x_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($third_party_search->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $third_party_search->DeductionAmount->EditValue ?>"<?php echo $third_party_search->DeductionAmount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->DeductionLimit->Visible) { // DeductionLimit ?>
	<div id="r_DeductionLimit" class="form-group row">
		<label for="x_DeductionLimit" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_DeductionLimit"><?php echo $third_party_search->DeductionLimit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeductionLimit" id="z_DeductionLimit" value="=">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->DeductionLimit->cellAttributes() ?>>
			<span id="el_third_party_DeductionLimit" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_DeductionLimit" name="x_DeductionLimit" id="x_DeductionLimit" size="30" placeholder="<?php echo HtmlEncode($third_party_search->DeductionLimit->getPlaceHolder()) ?>" value="<?php echo $third_party_search->DeductionLimit->EditValue ?>"<?php echo $third_party_search->DeductionLimit->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->EmployerContribution->Visible) { // EmployerContribution ?>
	<div id="r_EmployerContribution" class="form-group row">
		<label for="x_EmployerContribution" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_EmployerContribution"><?php echo $third_party_search->EmployerContribution->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployerContribution" id="z_EmployerContribution" value="=">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->EmployerContribution->cellAttributes() ?>>
			<span id="el_third_party_EmployerContribution" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_EmployerContribution" name="x_EmployerContribution" id="x_EmployerContribution" size="30" placeholder="<?php echo HtmlEncode($third_party_search->EmployerContribution->getPlaceHolder()) ?>" value="<?php echo $third_party_search->EmployerContribution->EditValue ?>"<?php echo $third_party_search->EmployerContribution->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->DeductionDescription->Visible) { // DeductionDescription ?>
	<div id="r_DeductionDescription" class="form-group row">
		<label for="x_DeductionDescription" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_DeductionDescription"><?php echo $third_party_search->DeductionDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeductionDescription" id="z_DeductionDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->DeductionDescription->cellAttributes() ?>>
			<span id="el_third_party_DeductionDescription" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_DeductionDescription" name="x_DeductionDescription" id="x_DeductionDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_search->DeductionDescription->getPlaceHolder()) ?>" value="<?php echo $third_party_search->DeductionDescription->EditValue ?>"<?php echo $third_party_search->DeductionDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label for="x_PostalAddress" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_PostalAddress"><?php echo $third_party_search->PostalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PostalAddress" id="z_PostalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->PostalAddress->cellAttributes() ?>>
			<span id="el_third_party_PostalAddress" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_search->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_search->PostalAddress->EditValue ?>"<?php echo $third_party_search->PostalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label for="x_PhysicalAddress" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_PhysicalAddress"><?php echo $third_party_search->PhysicalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PhysicalAddress" id="z_PhysicalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->PhysicalAddress->cellAttributes() ?>>
			<span id="el_third_party_PhysicalAddress" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_search->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_search->PhysicalAddress->EditValue ?>"<?php echo $third_party_search->PhysicalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label for="x_TownOrVillage" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_TownOrVillage"><?php echo $third_party_search->TownOrVillage->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TownOrVillage" id="z_TownOrVillage" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->TownOrVillage->cellAttributes() ?>>
			<span id="el_third_party_TownOrVillage" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_search->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $third_party_search->TownOrVillage->EditValue ?>"<?php echo $third_party_search->TownOrVillage->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label for="x_Telephone" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_Telephone"><?php echo $third_party_search->Telephone->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Telephone" id="z_Telephone" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->Telephone->cellAttributes() ?>>
			<span id="el_third_party_Telephone" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_search->Telephone->getPlaceHolder()) ?>" value="<?php echo $third_party_search->Telephone->EditValue ?>"<?php echo $third_party_search->Telephone->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label for="x_Mobile" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_Mobile"><?php echo $third_party_search->Mobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Mobile" id="z_Mobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->Mobile->cellAttributes() ?>>
			<span id="el_third_party_Mobile" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_search->Mobile->getPlaceHolder()) ?>" value="<?php echo $third_party_search->Mobile->EditValue ?>"<?php echo $third_party_search->Mobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label for="x_Fax" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_Fax"><?php echo $third_party_search->Fax->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Fax" id="z_Fax" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->Fax->cellAttributes() ?>>
			<span id="el_third_party_Fax" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($third_party_search->Fax->getPlaceHolder()) ?>" value="<?php echo $third_party_search->Fax->EditValue ?>"<?php echo $third_party_search->Fax->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label for="x__Email" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party__Email"><?php echo $third_party_search->_Email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__Email" id="z__Email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->_Email->cellAttributes() ?>>
			<span id="el_third_party__Email" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_search->_Email->getPlaceHolder()) ?>" value="<?php echo $third_party_search->_Email->EditValue ?>"<?php echo $third_party_search->_Email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label for="x_BankBranchCode" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_BankBranchCode"><?php echo $third_party_search->BankBranchCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankBranchCode" id="z_BankBranchCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->BankBranchCode->cellAttributes() ?>>
			<span id="el_third_party_BankBranchCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BankBranchCode"><?php echo EmptyValue(strval($third_party_search->BankBranchCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_search->BankBranchCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_search->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_search->BankBranchCode->ReadOnly || $third_party_search->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_search->BankBranchCode->Lookup->getParamTag($third_party_search, "p_x_BankBranchCode") ?>
<input type="hidden" data-table="third_party" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_search->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x_BankBranchCode" id="x_BankBranchCode" value="<?php echo $third_party_search->BankBranchCode->AdvancedSearch->SearchValue ?>"<?php echo $third_party_search->BankBranchCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label for="x_BankAccountNo" class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_BankAccountNo"><?php echo $third_party_search->BankAccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankAccountNo" id="z_BankAccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->BankAccountNo->cellAttributes() ?>>
			<span id="el_third_party_BankAccountNo" class="ew-search-field">
<input type="text" data-table="third_party" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($third_party_search->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $third_party_search->BankAccountNo->EditValue ?>"<?php echo $third_party_search->BankAccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($third_party_search->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label class="<?php echo $third_party_search->LeftColumnClass ?>"><span id="elh_third_party_PaymentMethod"><?php echo $third_party_search->PaymentMethod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PaymentMethod" id="z_PaymentMethod" value="LIKE">
</span>
		</label>
		<div class="<?php echo $third_party_search->RightColumnClass ?>"><div <?php echo $third_party_search->PaymentMethod->cellAttributes() ?>>
			<span id="el_third_party_PaymentMethod" class="ew-search-field">
<?php
$onchange = $third_party_search->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$third_party_search->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaymentMethod">
	<input type="text" class="form-control" name="sv_x_PaymentMethod" id="sv_x_PaymentMethod" value="<?php echo RemoveHtml($third_party_search->PaymentMethod->EditValue) ?>" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($third_party_search->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($third_party_search->PaymentMethod->getPlaceHolder()) ?>"<?php echo $third_party_search->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PaymentMethod" data-value-separator="<?php echo $third_party_search->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x_PaymentMethod" id="x_PaymentMethod" value="<?php echo HtmlEncode($third_party_search->PaymentMethod->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fthird_partysearch"], function() {
	fthird_partysearch.createAutoSuggest({"id":"x_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $third_party_search->PaymentMethod->Lookup->getParamTag($third_party_search, "p_x_PaymentMethod") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$third_party_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $third_party_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$third_party_search->showPageFooter();
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
$third_party_search->terminate();
?>