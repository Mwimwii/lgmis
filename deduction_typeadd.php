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
$deduction_type_add = new deduction_type_add();

// Run the page
$deduction_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdeduction_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdeduction_typeadd = currentForm = new ew.Form("fdeduction_typeadd", "add");

	// Validate form
	fdeduction_typeadd.validate = function() {
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
			<?php if ($deduction_type_add->DeductionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->DeductionName->caption(), $deduction_type_add->DeductionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->DeductionDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->DeductionDescription->caption(), $deduction_type_add->DeductionDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->Division->caption(), $deduction_type_add->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->DeductionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->DeductionAmount->caption(), $deduction_type_add->DeductionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_add->DeductionAmount->errorMessage()) ?>");
			<?php if ($deduction_type_add->DeductionBasicRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionBasicRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->DeductionBasicRate->caption(), $deduction_type_add->DeductionBasicRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionBasicRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_add->DeductionBasicRate->errorMessage()) ?>");
			<?php if ($deduction_type_add->RemittedTo->Required) { ?>
				elm = this.getElements("x" + infix + "_RemittedTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->RemittedTo->caption(), $deduction_type_add->RemittedTo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->AccountNo->caption(), $deduction_type_add->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->BaseIncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseIncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->BaseIncomeCode->caption(), $deduction_type_add->BaseIncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->BaseDeductionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseDeductionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->BaseDeductionCode->caption(), $deduction_type_add->BaseDeductionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->TaxExempt->Required) { ?>
				elm = this.getElements("x" + infix + "_TaxExempt");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->TaxExempt->caption(), $deduction_type_add->TaxExempt->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->JobCode->caption(), $deduction_type_add->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_add->MinimumAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_MinimumAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->MinimumAmount->caption(), $deduction_type_add->MinimumAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MinimumAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_add->MinimumAmount->errorMessage()) ?>");
			<?php if ($deduction_type_add->MaximumAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_MaximumAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->MaximumAmount->caption(), $deduction_type_add->MaximumAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaximumAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_add->MaximumAmount->errorMessage()) ?>");
			<?php if ($deduction_type_add->EmployerContributionRate->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContributionRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->EmployerContributionRate->caption(), $deduction_type_add->EmployerContributionRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContributionRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_add->EmployerContributionRate->errorMessage()) ?>");
			<?php if ($deduction_type_add->EmployerContributionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContributionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->EmployerContributionAmount->caption(), $deduction_type_add->EmployerContributionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContributionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_add->EmployerContributionAmount->errorMessage()) ?>");
			<?php if ($deduction_type_add->Application->Required) { ?>
				elm = this.getElements("x" + infix + "_Application");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_add->Application->caption(), $deduction_type_add->Application->RequiredErrorMessage)) ?>");
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
	fdeduction_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdeduction_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdeduction_typeadd.lists["x_Division[]"] = <?php echo $deduction_type_add->Division->Lookup->toClientList($deduction_type_add) ?>;
	fdeduction_typeadd.lists["x_Division[]"].options = <?php echo JsonEncode($deduction_type_add->Division->lookupOptions()) ?>;
	fdeduction_typeadd.lists["x_AccountNo"] = <?php echo $deduction_type_add->AccountNo->Lookup->toClientList($deduction_type_add) ?>;
	fdeduction_typeadd.lists["x_AccountNo"].options = <?php echo JsonEncode($deduction_type_add->AccountNo->lookupOptions()) ?>;
	fdeduction_typeadd.lists["x_BaseIncomeCode"] = <?php echo $deduction_type_add->BaseIncomeCode->Lookup->toClientList($deduction_type_add) ?>;
	fdeduction_typeadd.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($deduction_type_add->BaseIncomeCode->lookupOptions()) ?>;
	fdeduction_typeadd.lists["x_BaseDeductionCode"] = <?php echo $deduction_type_add->BaseDeductionCode->Lookup->toClientList($deduction_type_add) ?>;
	fdeduction_typeadd.lists["x_BaseDeductionCode"].options = <?php echo JsonEncode($deduction_type_add->BaseDeductionCode->lookupOptions()) ?>;
	fdeduction_typeadd.lists["x_TaxExempt"] = <?php echo $deduction_type_add->TaxExempt->Lookup->toClientList($deduction_type_add) ?>;
	fdeduction_typeadd.lists["x_TaxExempt"].options = <?php echo JsonEncode($deduction_type_add->TaxExempt->lookupOptions()) ?>;
	fdeduction_typeadd.lists["x_JobCode[]"] = <?php echo $deduction_type_add->JobCode->Lookup->toClientList($deduction_type_add) ?>;
	fdeduction_typeadd.lists["x_JobCode[]"].options = <?php echo JsonEncode($deduction_type_add->JobCode->lookupOptions()) ?>;
	fdeduction_typeadd.lists["x_Application"] = <?php echo $deduction_type_add->Application->Lookup->toClientList($deduction_type_add) ?>;
	fdeduction_typeadd.lists["x_Application"].options = <?php echo JsonEncode($deduction_type_add->Application->lookupOptions()) ?>;
	loadjs.done("fdeduction_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $deduction_type_add->showPageHeader(); ?>
<?php
$deduction_type_add->showMessage();
?>
<form name="fdeduction_typeadd" id="fdeduction_typeadd" class="<?php echo $deduction_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deduction_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$deduction_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($deduction_type_add->DeductionName->Visible) { // DeductionName ?>
	<div id="r_DeductionName" class="form-group row">
		<label id="elh_deduction_type_DeductionName" for="x_DeductionName" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->DeductionName->caption() ?><?php echo $deduction_type_add->DeductionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->DeductionName->cellAttributes() ?>>
<span id="el_deduction_type_DeductionName">
<input type="text" data-table="deduction_type" data-field="x_DeductionName" name="x_DeductionName" id="x_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_add->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->DeductionName->EditValue ?>"<?php echo $deduction_type_add->DeductionName->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->DeductionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->DeductionDescription->Visible) { // DeductionDescription ?>
	<div id="r_DeductionDescription" class="form-group row">
		<label id="elh_deduction_type_DeductionDescription" for="x_DeductionDescription" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->DeductionDescription->caption() ?><?php echo $deduction_type_add->DeductionDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->DeductionDescription->cellAttributes() ?>>
<span id="el_deduction_type_DeductionDescription">
<textarea data-table="deduction_type" data-field="x_DeductionDescription" name="x_DeductionDescription" id="x_DeductionDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($deduction_type_add->DeductionDescription->getPlaceHolder()) ?>"<?php echo $deduction_type_add->DeductionDescription->editAttributes() ?>><?php echo $deduction_type_add->DeductionDescription->EditValue ?></textarea>
</span>
<?php echo $deduction_type_add->DeductionDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_deduction_type_Division" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->Division->caption() ?><?php echo $deduction_type_add->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->Division->cellAttributes() ?>>
<span id="el_deduction_type_Division">
<div id="tp_x_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="deduction_type" data-field="x_Division" data-value-separator="<?php echo $deduction_type_add->Division->displayValueSeparatorAttribute() ?>" name="x_Division[]" id="x_Division[]" value="{value}"<?php echo $deduction_type_add->Division->editAttributes() ?>></div>
<div id="dsl_x_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $deduction_type_add->Division->checkBoxListHtml(FALSE, "x_Division[]") ?>
</div></div>
<?php echo $deduction_type_add->Division->Lookup->getParamTag($deduction_type_add, "p_x_Division") ?>
</span>
<?php echo $deduction_type_add->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->DeductionAmount->Visible) { // DeductionAmount ?>
	<div id="r_DeductionAmount" class="form-group row">
		<label id="elh_deduction_type_DeductionAmount" for="x_DeductionAmount" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->DeductionAmount->caption() ?><?php echo $deduction_type_add->DeductionAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->DeductionAmount->cellAttributes() ?>>
<span id="el_deduction_type_DeductionAmount">
<input type="text" data-table="deduction_type" data-field="x_DeductionAmount" name="x_DeductionAmount" id="x_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_add->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->DeductionAmount->EditValue ?>"<?php echo $deduction_type_add->DeductionAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->DeductionAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
	<div id="r_DeductionBasicRate" class="form-group row">
		<label id="elh_deduction_type_DeductionBasicRate" for="x_DeductionBasicRate" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->DeductionBasicRate->caption() ?><?php echo $deduction_type_add->DeductionBasicRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->DeductionBasicRate->cellAttributes() ?>>
<span id="el_deduction_type_DeductionBasicRate">
<input type="text" data-table="deduction_type" data-field="x_DeductionBasicRate" name="x_DeductionBasicRate" id="x_DeductionBasicRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_add->DeductionBasicRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->DeductionBasicRate->EditValue ?>"<?php echo $deduction_type_add->DeductionBasicRate->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->DeductionBasicRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->RemittedTo->Visible) { // RemittedTo ?>
	<div id="r_RemittedTo" class="form-group row">
		<label id="elh_deduction_type_RemittedTo" for="x_RemittedTo" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->RemittedTo->caption() ?><?php echo $deduction_type_add->RemittedTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->RemittedTo->cellAttributes() ?>>
<span id="el_deduction_type_RemittedTo">
<input type="text" data-table="deduction_type" data-field="x_RemittedTo" name="x_RemittedTo" id="x_RemittedTo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_add->RemittedTo->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->RemittedTo->EditValue ?>"<?php echo $deduction_type_add->RemittedTo->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->RemittedTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label id="elh_deduction_type_AccountNo" for="x_AccountNo" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->AccountNo->caption() ?><?php echo $deduction_type_add->AccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->AccountNo->cellAttributes() ?>>
<span id="el_deduction_type_AccountNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountNo"><?php echo EmptyValue(strval($deduction_type_add->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_add->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_add->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_add->AccountNo->ReadOnly || $deduction_type_add->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_add->AccountNo->Lookup->getParamTag($deduction_type_add, "p_x_AccountNo") ?>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_add->AccountNo->displayValueSeparatorAttribute() ?>" name="x_AccountNo" id="x_AccountNo" value="<?php echo $deduction_type_add->AccountNo->CurrentValue ?>"<?php echo $deduction_type_add->AccountNo->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->AccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<div id="r_BaseIncomeCode" class="form-group row">
		<label id="elh_deduction_type_BaseIncomeCode" for="x_BaseIncomeCode" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->BaseIncomeCode->caption() ?><?php echo $deduction_type_add->BaseIncomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->BaseIncomeCode->cellAttributes() ?>>
<span id="el_deduction_type_BaseIncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseIncomeCode"><?php echo EmptyValue(strval($deduction_type_add->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_add->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_add->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_add->BaseIncomeCode->ReadOnly || $deduction_type_add->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_add->BaseIncomeCode->Lookup->getParamTag($deduction_type_add, "p_x_BaseIncomeCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_add->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x_BaseIncomeCode" id="x_BaseIncomeCode" value="<?php echo $deduction_type_add->BaseIncomeCode->CurrentValue ?>"<?php echo $deduction_type_add->BaseIncomeCode->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->BaseIncomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
	<div id="r_BaseDeductionCode" class="form-group row">
		<label id="elh_deduction_type_BaseDeductionCode" for="x_BaseDeductionCode" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->BaseDeductionCode->caption() ?><?php echo $deduction_type_add->BaseDeductionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->BaseDeductionCode->cellAttributes() ?>>
<span id="el_deduction_type_BaseDeductionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseDeductionCode"><?php echo EmptyValue(strval($deduction_type_add->BaseDeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_add->BaseDeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_add->BaseDeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_add->BaseDeductionCode->ReadOnly || $deduction_type_add->BaseDeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseDeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_add->BaseDeductionCode->Lookup->getParamTag($deduction_type_add, "p_x_BaseDeductionCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_add->BaseDeductionCode->displayValueSeparatorAttribute() ?>" name="x_BaseDeductionCode" id="x_BaseDeductionCode" value="<?php echo $deduction_type_add->BaseDeductionCode->CurrentValue ?>"<?php echo $deduction_type_add->BaseDeductionCode->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->BaseDeductionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->TaxExempt->Visible) { // TaxExempt ?>
	<div id="r_TaxExempt" class="form-group row">
		<label id="elh_deduction_type_TaxExempt" for="x_TaxExempt" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->TaxExempt->caption() ?><?php echo $deduction_type_add->TaxExempt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->TaxExempt->cellAttributes() ?>>
<span id="el_deduction_type_TaxExempt">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_TaxExempt" data-value-separator="<?php echo $deduction_type_add->TaxExempt->displayValueSeparatorAttribute() ?>" id="x_TaxExempt" name="x_TaxExempt"<?php echo $deduction_type_add->TaxExempt->editAttributes() ?>>
			<?php echo $deduction_type_add->TaxExempt->selectOptionListHtml("x_TaxExempt") ?>
		</select>
</div>
<?php echo $deduction_type_add->TaxExempt->Lookup->getParamTag($deduction_type_add, "p_x_TaxExempt") ?>
</span>
<?php echo $deduction_type_add->TaxExempt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->JobCode->Visible) { // JobCode ?>
	<div id="r_JobCode" class="form-group row">
		<label id="elh_deduction_type_JobCode" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->JobCode->caption() ?><?php echo $deduction_type_add->JobCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->JobCode->cellAttributes() ?>>
<span id="el_deduction_type_JobCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobCode"><?php echo EmptyValue(strval($deduction_type_add->JobCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_add->JobCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_add->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_add->JobCode->ReadOnly || $deduction_type_add->JobCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_add->JobCode->Lookup->getParamTag($deduction_type_add, "p_x_JobCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $deduction_type_add->JobCode->displayValueSeparatorAttribute() ?>" name="x_JobCode[]" id="x_JobCode[]" value="<?php echo $deduction_type_add->JobCode->CurrentValue ?>"<?php echo $deduction_type_add->JobCode->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->JobCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->MinimumAmount->Visible) { // MinimumAmount ?>
	<div id="r_MinimumAmount" class="form-group row">
		<label id="elh_deduction_type_MinimumAmount" for="x_MinimumAmount" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->MinimumAmount->caption() ?><?php echo $deduction_type_add->MinimumAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->MinimumAmount->cellAttributes() ?>>
<span id="el_deduction_type_MinimumAmount">
<input type="text" data-table="deduction_type" data-field="x_MinimumAmount" name="x_MinimumAmount" id="x_MinimumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_add->MinimumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->MinimumAmount->EditValue ?>"<?php echo $deduction_type_add->MinimumAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->MinimumAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->MaximumAmount->Visible) { // MaximumAmount ?>
	<div id="r_MaximumAmount" class="form-group row">
		<label id="elh_deduction_type_MaximumAmount" for="x_MaximumAmount" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->MaximumAmount->caption() ?><?php echo $deduction_type_add->MaximumAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->MaximumAmount->cellAttributes() ?>>
<span id="el_deduction_type_MaximumAmount">
<input type="text" data-table="deduction_type" data-field="x_MaximumAmount" name="x_MaximumAmount" id="x_MaximumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_add->MaximumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->MaximumAmount->EditValue ?>"<?php echo $deduction_type_add->MaximumAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->MaximumAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
	<div id="r_EmployerContributionRate" class="form-group row">
		<label id="elh_deduction_type_EmployerContributionRate" for="x_EmployerContributionRate" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->EmployerContributionRate->caption() ?><?php echo $deduction_type_add->EmployerContributionRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->EmployerContributionRate->cellAttributes() ?>>
<span id="el_deduction_type_EmployerContributionRate">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionRate" name="x_EmployerContributionRate" id="x_EmployerContributionRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_add->EmployerContributionRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->EmployerContributionRate->EditValue ?>"<?php echo $deduction_type_add->EmployerContributionRate->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->EmployerContributionRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
	<div id="r_EmployerContributionAmount" class="form-group row">
		<label id="elh_deduction_type_EmployerContributionAmount" for="x_EmployerContributionAmount" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->EmployerContributionAmount->caption() ?><?php echo $deduction_type_add->EmployerContributionAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->EmployerContributionAmount->cellAttributes() ?>>
<span id="el_deduction_type_EmployerContributionAmount">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="x_EmployerContributionAmount" id="x_EmployerContributionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_add->EmployerContributionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_add->EmployerContributionAmount->EditValue ?>"<?php echo $deduction_type_add->EmployerContributionAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_add->EmployerContributionAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_add->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label id="elh_deduction_type_Application" for="x_Application" class="<?php echo $deduction_type_add->LeftColumnClass ?>"><?php echo $deduction_type_add->Application->caption() ?><?php echo $deduction_type_add->Application->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_add->RightColumnClass ?>"><div <?php echo $deduction_type_add->Application->cellAttributes() ?>>
<span id="el_deduction_type_Application">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_Application" data-value-separator="<?php echo $deduction_type_add->Application->displayValueSeparatorAttribute() ?>" id="x_Application" name="x_Application"<?php echo $deduction_type_add->Application->editAttributes() ?>>
			<?php echo $deduction_type_add->Application->selectOptionListHtml("x_Application") ?>
		</select>
</div>
<?php echo $deduction_type_add->Application->Lookup->getParamTag($deduction_type_add, "p_x_Application") ?>
</span>
<?php echo $deduction_type_add->Application->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$deduction_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $deduction_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $deduction_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$deduction_type_add->showPageFooter();
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
$deduction_type_add->terminate();
?>