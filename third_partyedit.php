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
$third_party_edit = new third_party_edit();

// Run the page
$third_party_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$third_party_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fthird_partyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fthird_partyedit = currentForm = new ew.Form("fthird_partyedit", "edit");

	// Validate form
	fthird_partyedit.validate = function() {
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
			<?php if ($third_party_edit->ThirdPartyName->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdPartyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->ThirdPartyName->caption(), $third_party_edit->ThirdPartyName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->DateOfEngagement->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfEngagement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->DateOfEngagement->caption(), $third_party_edit->DateOfEngagement->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfEngagement");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_edit->DateOfEngagement->errorMessage()) ?>");
			<?php if ($third_party_edit->DeductionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->DeductionCode->caption(), $third_party_edit->DeductionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->DeductionRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->DeductionRate->caption(), $third_party_edit->DeductionRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_edit->DeductionRate->errorMessage()) ?>");
			<?php if ($third_party_edit->DeductionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->DeductionAmount->caption(), $third_party_edit->DeductionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_edit->DeductionAmount->errorMessage()) ?>");
			<?php if ($third_party_edit->DeductionLimit->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionLimit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->DeductionLimit->caption(), $third_party_edit->DeductionLimit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionLimit");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_edit->DeductionLimit->errorMessage()) ?>");
			<?php if ($third_party_edit->EmployerContribution->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContribution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->EmployerContribution->caption(), $third_party_edit->EmployerContribution->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContribution");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_edit->EmployerContribution->errorMessage()) ?>");
			<?php if ($third_party_edit->DeductionDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->DeductionDescription->caption(), $third_party_edit->DeductionDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->PostalAddress->caption(), $third_party_edit->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->PhysicalAddress->caption(), $third_party_edit->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->TownOrVillage->caption(), $third_party_edit->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->Telephone->caption(), $third_party_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->Mobile->caption(), $third_party_edit->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->Fax->caption(), $third_party_edit->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->_Email->caption(), $third_party_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->BankBranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankBranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->BankBranchCode->caption(), $third_party_edit->BankBranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->BankAccountNo->caption(), $third_party_edit->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_edit->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_edit->PaymentMethod->caption(), $third_party_edit->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fthird_partyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fthird_partyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fthird_partyedit.lists["x_DeductionCode"] = <?php echo $third_party_edit->DeductionCode->Lookup->toClientList($third_party_edit) ?>;
	fthird_partyedit.lists["x_DeductionCode"].options = <?php echo JsonEncode($third_party_edit->DeductionCode->lookupOptions()) ?>;
	fthird_partyedit.lists["x_BankBranchCode"] = <?php echo $third_party_edit->BankBranchCode->Lookup->toClientList($third_party_edit) ?>;
	fthird_partyedit.lists["x_BankBranchCode"].options = <?php echo JsonEncode($third_party_edit->BankBranchCode->lookupOptions()) ?>;
	fthird_partyedit.lists["x_PaymentMethod"] = <?php echo $third_party_edit->PaymentMethod->Lookup->toClientList($third_party_edit) ?>;
	fthird_partyedit.lists["x_PaymentMethod"].options = <?php echo JsonEncode($third_party_edit->PaymentMethod->lookupOptions()) ?>;
	fthird_partyedit.autoSuggests["x_PaymentMethod"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fthird_partyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $third_party_edit->showPageHeader(); ?>
<?php
$third_party_edit->showMessage();
?>
<?php if (!$third_party_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $third_party_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fthird_partyedit" id="fthird_partyedit" class="<?php echo $third_party_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="third_party">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$third_party_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($third_party_edit->ThirdPartyName->Visible) { // ThirdPartyName ?>
	<div id="r_ThirdPartyName" class="form-group row">
		<label id="elh_third_party_ThirdPartyName" for="x_ThirdPartyName" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->ThirdPartyName->caption() ?><?php echo $third_party_edit->ThirdPartyName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->ThirdPartyName->cellAttributes() ?>>
<span id="el_third_party_ThirdPartyName">
<input type="text" data-table="third_party" data-field="x_ThirdPartyName" name="x_ThirdPartyName" id="x_ThirdPartyName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($third_party_edit->ThirdPartyName->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->ThirdPartyName->EditValue ?>"<?php echo $third_party_edit->ThirdPartyName->editAttributes() ?>>
</span>
<?php echo $third_party_edit->ThirdPartyName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->DateOfEngagement->Visible) { // DateOfEngagement ?>
	<div id="r_DateOfEngagement" class="form-group row">
		<label id="elh_third_party_DateOfEngagement" for="x_DateOfEngagement" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->DateOfEngagement->caption() ?><?php echo $third_party_edit->DateOfEngagement->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->DateOfEngagement->cellAttributes() ?>>
<span id="el_third_party_DateOfEngagement">
<input type="text" data-table="third_party" data-field="x_DateOfEngagement" name="x_DateOfEngagement" id="x_DateOfEngagement" placeholder="<?php echo HtmlEncode($third_party_edit->DateOfEngagement->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->DateOfEngagement->EditValue ?>"<?php echo $third_party_edit->DateOfEngagement->editAttributes() ?>>
<?php if (!$third_party_edit->DateOfEngagement->ReadOnly && !$third_party_edit->DateOfEngagement->Disabled && !isset($third_party_edit->DateOfEngagement->EditAttrs["readonly"]) && !isset($third_party_edit->DateOfEngagement->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fthird_partyedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fthird_partyedit", "x_DateOfEngagement", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $third_party_edit->DateOfEngagement->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->DeductionCode->Visible) { // DeductionCode ?>
	<div id="r_DeductionCode" class="form-group row">
		<label id="elh_third_party_DeductionCode" for="x_DeductionCode" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->DeductionCode->caption() ?><?php echo $third_party_edit->DeductionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->DeductionCode->cellAttributes() ?>>
<?php $third_party_edit->DeductionCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DeductionCode"><?php echo EmptyValue(strval($third_party_edit->DeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_edit->DeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_edit->DeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_edit->DeductionCode->ReadOnly || $third_party_edit->DeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_edit->DeductionCode->Lookup->getParamTag($third_party_edit, "p_x_DeductionCode") ?>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_edit->DeductionCode->displayValueSeparatorAttribute() ?>" name="x_DeductionCode" id="x_DeductionCode" value="<?php echo $third_party_edit->DeductionCode->CurrentValue ?>"<?php echo $third_party_edit->DeductionCode->editAttributes() ?>>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" name="o_DeductionCode" id="o_DeductionCode" value="<?php echo HtmlEncode($third_party_edit->DeductionCode->OldValue != null ? $third_party_edit->DeductionCode->OldValue : $third_party_edit->DeductionCode->CurrentValue) ?>">
<?php echo $third_party_edit->DeductionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->DeductionRate->Visible) { // DeductionRate ?>
	<div id="r_DeductionRate" class="form-group row">
		<label id="elh_third_party_DeductionRate" for="x_DeductionRate" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->DeductionRate->caption() ?><?php echo $third_party_edit->DeductionRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->DeductionRate->cellAttributes() ?>>
<span id="el_third_party_DeductionRate">
<input type="text" data-table="third_party" data-field="x_DeductionRate" name="x_DeductionRate" id="x_DeductionRate" size="30" placeholder="<?php echo HtmlEncode($third_party_edit->DeductionRate->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->DeductionRate->EditValue ?>"<?php echo $third_party_edit->DeductionRate->editAttributes() ?>>
</span>
<?php echo $third_party_edit->DeductionRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->DeductionAmount->Visible) { // DeductionAmount ?>
	<div id="r_DeductionAmount" class="form-group row">
		<label id="elh_third_party_DeductionAmount" for="x_DeductionAmount" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->DeductionAmount->caption() ?><?php echo $third_party_edit->DeductionAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->DeductionAmount->cellAttributes() ?>>
<span id="el_third_party_DeductionAmount">
<input type="text" data-table="third_party" data-field="x_DeductionAmount" name="x_DeductionAmount" id="x_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($third_party_edit->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->DeductionAmount->EditValue ?>"<?php echo $third_party_edit->DeductionAmount->editAttributes() ?>>
</span>
<?php echo $third_party_edit->DeductionAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->DeductionLimit->Visible) { // DeductionLimit ?>
	<div id="r_DeductionLimit" class="form-group row">
		<label id="elh_third_party_DeductionLimit" for="x_DeductionLimit" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->DeductionLimit->caption() ?><?php echo $third_party_edit->DeductionLimit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->DeductionLimit->cellAttributes() ?>>
<span id="el_third_party_DeductionLimit">
<input type="text" data-table="third_party" data-field="x_DeductionLimit" name="x_DeductionLimit" id="x_DeductionLimit" size="30" placeholder="<?php echo HtmlEncode($third_party_edit->DeductionLimit->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->DeductionLimit->EditValue ?>"<?php echo $third_party_edit->DeductionLimit->editAttributes() ?>>
</span>
<?php echo $third_party_edit->DeductionLimit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->EmployerContribution->Visible) { // EmployerContribution ?>
	<div id="r_EmployerContribution" class="form-group row">
		<label id="elh_third_party_EmployerContribution" for="x_EmployerContribution" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->EmployerContribution->caption() ?><?php echo $third_party_edit->EmployerContribution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->EmployerContribution->cellAttributes() ?>>
<span id="el_third_party_EmployerContribution">
<input type="text" data-table="third_party" data-field="x_EmployerContribution" name="x_EmployerContribution" id="x_EmployerContribution" size="30" placeholder="<?php echo HtmlEncode($third_party_edit->EmployerContribution->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->EmployerContribution->EditValue ?>"<?php echo $third_party_edit->EmployerContribution->editAttributes() ?>>
</span>
<?php echo $third_party_edit->EmployerContribution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->DeductionDescription->Visible) { // DeductionDescription ?>
	<div id="r_DeductionDescription" class="form-group row">
		<label id="elh_third_party_DeductionDescription" for="x_DeductionDescription" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->DeductionDescription->caption() ?><?php echo $third_party_edit->DeductionDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->DeductionDescription->cellAttributes() ?>>
<span id="el_third_party_DeductionDescription">
<input type="text" data-table="third_party" data-field="x_DeductionDescription" name="x_DeductionDescription" id="x_DeductionDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_edit->DeductionDescription->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->DeductionDescription->EditValue ?>"<?php echo $third_party_edit->DeductionDescription->editAttributes() ?>>
</span>
<?php echo $third_party_edit->DeductionDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_third_party_PostalAddress" for="x_PostalAddress" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->PostalAddress->caption() ?><?php echo $third_party_edit->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->PostalAddress->cellAttributes() ?>>
<span id="el_third_party_PostalAddress">
<input type="text" data-table="third_party" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_edit->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->PostalAddress->EditValue ?>"<?php echo $third_party_edit->PostalAddress->editAttributes() ?>>
</span>
<?php echo $third_party_edit->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_third_party_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->PhysicalAddress->caption() ?><?php echo $third_party_edit->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->PhysicalAddress->cellAttributes() ?>>
<span id="el_third_party_PhysicalAddress">
<input type="text" data-table="third_party" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_edit->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->PhysicalAddress->EditValue ?>"<?php echo $third_party_edit->PhysicalAddress->editAttributes() ?>>
</span>
<?php echo $third_party_edit->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_third_party_TownOrVillage" for="x_TownOrVillage" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->TownOrVillage->caption() ?><?php echo $third_party_edit->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->TownOrVillage->cellAttributes() ?>>
<span id="el_third_party_TownOrVillage">
<input type="text" data-table="third_party" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_edit->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->TownOrVillage->EditValue ?>"<?php echo $third_party_edit->TownOrVillage->editAttributes() ?>>
</span>
<?php echo $third_party_edit->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_third_party_Telephone" for="x_Telephone" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->Telephone->caption() ?><?php echo $third_party_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->Telephone->cellAttributes() ?>>
<span id="el_third_party_Telephone">
<input type="text" data-table="third_party" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->Telephone->EditValue ?>"<?php echo $third_party_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $third_party_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_third_party_Mobile" for="x_Mobile" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->Mobile->caption() ?><?php echo $third_party_edit->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->Mobile->cellAttributes() ?>>
<span id="el_third_party_Mobile">
<input type="text" data-table="third_party" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_edit->Mobile->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->Mobile->EditValue ?>"<?php echo $third_party_edit->Mobile->editAttributes() ?>>
</span>
<?php echo $third_party_edit->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_third_party_Fax" for="x_Fax" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->Fax->caption() ?><?php echo $third_party_edit->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->Fax->cellAttributes() ?>>
<span id="el_third_party_Fax">
<input type="text" data-table="third_party" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($third_party_edit->Fax->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->Fax->EditValue ?>"<?php echo $third_party_edit->Fax->editAttributes() ?>>
</span>
<?php echo $third_party_edit->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_third_party__Email" for="x__Email" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->_Email->caption() ?><?php echo $third_party_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->_Email->cellAttributes() ?>>
<span id="el_third_party__Email">
<input type="text" data-table="third_party" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->_Email->EditValue ?>"<?php echo $third_party_edit->_Email->editAttributes() ?>>
</span>
<?php echo $third_party_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->BankBranchCode->Visible) { // BankBranchCode ?>
	<div id="r_BankBranchCode" class="form-group row">
		<label id="elh_third_party_BankBranchCode" for="x_BankBranchCode" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->BankBranchCode->caption() ?><?php echo $third_party_edit->BankBranchCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->BankBranchCode->cellAttributes() ?>>
<span id="el_third_party_BankBranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BankBranchCode"><?php echo EmptyValue(strval($third_party_edit->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_edit->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_edit->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_edit->BankBranchCode->ReadOnly || $third_party_edit->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_edit->BankBranchCode->Lookup->getParamTag($third_party_edit, "p_x_BankBranchCode") ?>
<input type="hidden" data-table="third_party" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_edit->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x_BankBranchCode" id="x_BankBranchCode" value="<?php echo $third_party_edit->BankBranchCode->CurrentValue ?>"<?php echo $third_party_edit->BankBranchCode->editAttributes() ?>>
</span>
<?php echo $third_party_edit->BankBranchCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label id="elh_third_party_BankAccountNo" for="x_BankAccountNo" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->BankAccountNo->caption() ?><?php echo $third_party_edit->BankAccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->BankAccountNo->cellAttributes() ?>>
<span id="el_third_party_BankAccountNo">
<input type="text" data-table="third_party" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($third_party_edit->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $third_party_edit->BankAccountNo->EditValue ?>"<?php echo $third_party_edit->BankAccountNo->editAttributes() ?>>
</span>
<?php echo $third_party_edit->BankAccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($third_party_edit->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label id="elh_third_party_PaymentMethod" class="<?php echo $third_party_edit->LeftColumnClass ?>"><?php echo $third_party_edit->PaymentMethod->caption() ?><?php echo $third_party_edit->PaymentMethod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $third_party_edit->RightColumnClass ?>"><div <?php echo $third_party_edit->PaymentMethod->cellAttributes() ?>>
<span id="el_third_party_PaymentMethod">
<?php
$onchange = $third_party_edit->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$third_party_edit->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaymentMethod">
	<input type="text" class="form-control" name="sv_x_PaymentMethod" id="sv_x_PaymentMethod" value="<?php echo RemoveHtml($third_party_edit->PaymentMethod->EditValue) ?>" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($third_party_edit->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($third_party_edit->PaymentMethod->getPlaceHolder()) ?>"<?php echo $third_party_edit->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PaymentMethod" data-value-separator="<?php echo $third_party_edit->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x_PaymentMethod" id="x_PaymentMethod" value="<?php echo HtmlEncode($third_party_edit->PaymentMethod->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fthird_partyedit"], function() {
	fthird_partyedit.createAutoSuggest({"id":"x_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $third_party_edit->PaymentMethod->Lookup->getParamTag($third_party_edit, "p_x_PaymentMethod") ?>
</span>
<?php echo $third_party_edit->PaymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$third_party_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $third_party_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $third_party_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$third_party_edit->IsModal) { ?>
<?php echo $third_party_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$third_party_edit->showPageFooter();
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
$third_party_edit->terminate();
?>