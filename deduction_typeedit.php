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
$deduction_type_edit = new deduction_type_edit();

// Run the page
$deduction_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdeduction_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdeduction_typeedit = currentForm = new ew.Form("fdeduction_typeedit", "edit");

	// Validate form
	fdeduction_typeedit.validate = function() {
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
			<?php if ($deduction_type_edit->DeductionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->DeductionCode->caption(), $deduction_type_edit->DeductionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->DeductionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->DeductionName->caption(), $deduction_type_edit->DeductionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->DeductionDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->DeductionDescription->caption(), $deduction_type_edit->DeductionDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->Division->caption(), $deduction_type_edit->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->DeductionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->DeductionAmount->caption(), $deduction_type_edit->DeductionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_edit->DeductionAmount->errorMessage()) ?>");
			<?php if ($deduction_type_edit->DeductionBasicRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionBasicRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->DeductionBasicRate->caption(), $deduction_type_edit->DeductionBasicRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionBasicRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_edit->DeductionBasicRate->errorMessage()) ?>");
			<?php if ($deduction_type_edit->RemittedTo->Required) { ?>
				elm = this.getElements("x" + infix + "_RemittedTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->RemittedTo->caption(), $deduction_type_edit->RemittedTo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->AccountNo->caption(), $deduction_type_edit->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->BaseIncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseIncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->BaseIncomeCode->caption(), $deduction_type_edit->BaseIncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->BaseDeductionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseDeductionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->BaseDeductionCode->caption(), $deduction_type_edit->BaseDeductionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->TaxExempt->Required) { ?>
				elm = this.getElements("x" + infix + "_TaxExempt");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->TaxExempt->caption(), $deduction_type_edit->TaxExempt->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->JobCode->caption(), $deduction_type_edit->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_edit->MinimumAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_MinimumAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->MinimumAmount->caption(), $deduction_type_edit->MinimumAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MinimumAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_edit->MinimumAmount->errorMessage()) ?>");
			<?php if ($deduction_type_edit->MaximumAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_MaximumAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->MaximumAmount->caption(), $deduction_type_edit->MaximumAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaximumAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_edit->MaximumAmount->errorMessage()) ?>");
			<?php if ($deduction_type_edit->EmployerContributionRate->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContributionRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->EmployerContributionRate->caption(), $deduction_type_edit->EmployerContributionRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContributionRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_edit->EmployerContributionRate->errorMessage()) ?>");
			<?php if ($deduction_type_edit->EmployerContributionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContributionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->EmployerContributionAmount->caption(), $deduction_type_edit->EmployerContributionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContributionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_edit->EmployerContributionAmount->errorMessage()) ?>");
			<?php if ($deduction_type_edit->Application->Required) { ?>
				elm = this.getElements("x" + infix + "_Application");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_edit->Application->caption(), $deduction_type_edit->Application->RequiredErrorMessage)) ?>");
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
	fdeduction_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdeduction_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdeduction_typeedit.lists["x_Division[]"] = <?php echo $deduction_type_edit->Division->Lookup->toClientList($deduction_type_edit) ?>;
	fdeduction_typeedit.lists["x_Division[]"].options = <?php echo JsonEncode($deduction_type_edit->Division->lookupOptions()) ?>;
	fdeduction_typeedit.lists["x_AccountNo"] = <?php echo $deduction_type_edit->AccountNo->Lookup->toClientList($deduction_type_edit) ?>;
	fdeduction_typeedit.lists["x_AccountNo"].options = <?php echo JsonEncode($deduction_type_edit->AccountNo->lookupOptions()) ?>;
	fdeduction_typeedit.lists["x_BaseIncomeCode"] = <?php echo $deduction_type_edit->BaseIncomeCode->Lookup->toClientList($deduction_type_edit) ?>;
	fdeduction_typeedit.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($deduction_type_edit->BaseIncomeCode->lookupOptions()) ?>;
	fdeduction_typeedit.lists["x_BaseDeductionCode"] = <?php echo $deduction_type_edit->BaseDeductionCode->Lookup->toClientList($deduction_type_edit) ?>;
	fdeduction_typeedit.lists["x_BaseDeductionCode"].options = <?php echo JsonEncode($deduction_type_edit->BaseDeductionCode->lookupOptions()) ?>;
	fdeduction_typeedit.lists["x_TaxExempt"] = <?php echo $deduction_type_edit->TaxExempt->Lookup->toClientList($deduction_type_edit) ?>;
	fdeduction_typeedit.lists["x_TaxExempt"].options = <?php echo JsonEncode($deduction_type_edit->TaxExempt->lookupOptions()) ?>;
	fdeduction_typeedit.lists["x_JobCode[]"] = <?php echo $deduction_type_edit->JobCode->Lookup->toClientList($deduction_type_edit) ?>;
	fdeduction_typeedit.lists["x_JobCode[]"].options = <?php echo JsonEncode($deduction_type_edit->JobCode->lookupOptions()) ?>;
	fdeduction_typeedit.lists["x_Application"] = <?php echo $deduction_type_edit->Application->Lookup->toClientList($deduction_type_edit) ?>;
	fdeduction_typeedit.lists["x_Application"].options = <?php echo JsonEncode($deduction_type_edit->Application->lookupOptions()) ?>;
	loadjs.done("fdeduction_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $deduction_type_edit->showPageHeader(); ?>
<?php
$deduction_type_edit->showMessage();
?>
<?php if (!$deduction_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deduction_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdeduction_typeedit" id="fdeduction_typeedit" class="<?php echo $deduction_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deduction_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$deduction_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($deduction_type_edit->DeductionCode->Visible) { // DeductionCode ?>
	<div id="r_DeductionCode" class="form-group row">
		<label id="elh_deduction_type_DeductionCode" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->DeductionCode->caption() ?><?php echo $deduction_type_edit->DeductionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->DeductionCode->cellAttributes() ?>>
<span id="el_deduction_type_DeductionCode">
<span<?php echo $deduction_type_edit->DeductionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_type_edit->DeductionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionCode" name="x_DeductionCode" id="x_DeductionCode" value="<?php echo HtmlEncode($deduction_type_edit->DeductionCode->CurrentValue) ?>">
<?php echo $deduction_type_edit->DeductionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->DeductionName->Visible) { // DeductionName ?>
	<div id="r_DeductionName" class="form-group row">
		<label id="elh_deduction_type_DeductionName" for="x_DeductionName" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->DeductionName->caption() ?><?php echo $deduction_type_edit->DeductionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->DeductionName->cellAttributes() ?>>
<span id="el_deduction_type_DeductionName">
<input type="text" data-table="deduction_type" data-field="x_DeductionName" name="x_DeductionName" id="x_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_edit->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->DeductionName->EditValue ?>"<?php echo $deduction_type_edit->DeductionName->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->DeductionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->DeductionDescription->Visible) { // DeductionDescription ?>
	<div id="r_DeductionDescription" class="form-group row">
		<label id="elh_deduction_type_DeductionDescription" for="x_DeductionDescription" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->DeductionDescription->caption() ?><?php echo $deduction_type_edit->DeductionDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->DeductionDescription->cellAttributes() ?>>
<span id="el_deduction_type_DeductionDescription">
<textarea data-table="deduction_type" data-field="x_DeductionDescription" name="x_DeductionDescription" id="x_DeductionDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($deduction_type_edit->DeductionDescription->getPlaceHolder()) ?>"<?php echo $deduction_type_edit->DeductionDescription->editAttributes() ?>><?php echo $deduction_type_edit->DeductionDescription->EditValue ?></textarea>
</span>
<?php echo $deduction_type_edit->DeductionDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_deduction_type_Division" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->Division->caption() ?><?php echo $deduction_type_edit->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->Division->cellAttributes() ?>>
<span id="el_deduction_type_Division">
<div id="tp_x_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="deduction_type" data-field="x_Division" data-value-separator="<?php echo $deduction_type_edit->Division->displayValueSeparatorAttribute() ?>" name="x_Division[]" id="x_Division[]" value="{value}"<?php echo $deduction_type_edit->Division->editAttributes() ?>></div>
<div id="dsl_x_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $deduction_type_edit->Division->checkBoxListHtml(FALSE, "x_Division[]") ?>
</div></div>
<?php echo $deduction_type_edit->Division->Lookup->getParamTag($deduction_type_edit, "p_x_Division") ?>
</span>
<?php echo $deduction_type_edit->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->DeductionAmount->Visible) { // DeductionAmount ?>
	<div id="r_DeductionAmount" class="form-group row">
		<label id="elh_deduction_type_DeductionAmount" for="x_DeductionAmount" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->DeductionAmount->caption() ?><?php echo $deduction_type_edit->DeductionAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->DeductionAmount->cellAttributes() ?>>
<span id="el_deduction_type_DeductionAmount">
<input type="text" data-table="deduction_type" data-field="x_DeductionAmount" name="x_DeductionAmount" id="x_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_edit->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->DeductionAmount->EditValue ?>"<?php echo $deduction_type_edit->DeductionAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->DeductionAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
	<div id="r_DeductionBasicRate" class="form-group row">
		<label id="elh_deduction_type_DeductionBasicRate" for="x_DeductionBasicRate" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->DeductionBasicRate->caption() ?><?php echo $deduction_type_edit->DeductionBasicRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->DeductionBasicRate->cellAttributes() ?>>
<span id="el_deduction_type_DeductionBasicRate">
<input type="text" data-table="deduction_type" data-field="x_DeductionBasicRate" name="x_DeductionBasicRate" id="x_DeductionBasicRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_edit->DeductionBasicRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->DeductionBasicRate->EditValue ?>"<?php echo $deduction_type_edit->DeductionBasicRate->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->DeductionBasicRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->RemittedTo->Visible) { // RemittedTo ?>
	<div id="r_RemittedTo" class="form-group row">
		<label id="elh_deduction_type_RemittedTo" for="x_RemittedTo" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->RemittedTo->caption() ?><?php echo $deduction_type_edit->RemittedTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->RemittedTo->cellAttributes() ?>>
<span id="el_deduction_type_RemittedTo">
<input type="text" data-table="deduction_type" data-field="x_RemittedTo" name="x_RemittedTo" id="x_RemittedTo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_edit->RemittedTo->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->RemittedTo->EditValue ?>"<?php echo $deduction_type_edit->RemittedTo->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->RemittedTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label id="elh_deduction_type_AccountNo" for="x_AccountNo" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->AccountNo->caption() ?><?php echo $deduction_type_edit->AccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->AccountNo->cellAttributes() ?>>
<span id="el_deduction_type_AccountNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountNo"><?php echo EmptyValue(strval($deduction_type_edit->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_edit->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_edit->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_edit->AccountNo->ReadOnly || $deduction_type_edit->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_edit->AccountNo->Lookup->getParamTag($deduction_type_edit, "p_x_AccountNo") ?>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_edit->AccountNo->displayValueSeparatorAttribute() ?>" name="x_AccountNo" id="x_AccountNo" value="<?php echo $deduction_type_edit->AccountNo->CurrentValue ?>"<?php echo $deduction_type_edit->AccountNo->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->AccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<div id="r_BaseIncomeCode" class="form-group row">
		<label id="elh_deduction_type_BaseIncomeCode" for="x_BaseIncomeCode" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->BaseIncomeCode->caption() ?><?php echo $deduction_type_edit->BaseIncomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->BaseIncomeCode->cellAttributes() ?>>
<span id="el_deduction_type_BaseIncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseIncomeCode"><?php echo EmptyValue(strval($deduction_type_edit->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_edit->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_edit->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_edit->BaseIncomeCode->ReadOnly || $deduction_type_edit->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_edit->BaseIncomeCode->Lookup->getParamTag($deduction_type_edit, "p_x_BaseIncomeCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_edit->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x_BaseIncomeCode" id="x_BaseIncomeCode" value="<?php echo $deduction_type_edit->BaseIncomeCode->CurrentValue ?>"<?php echo $deduction_type_edit->BaseIncomeCode->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->BaseIncomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
	<div id="r_BaseDeductionCode" class="form-group row">
		<label id="elh_deduction_type_BaseDeductionCode" for="x_BaseDeductionCode" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->BaseDeductionCode->caption() ?><?php echo $deduction_type_edit->BaseDeductionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->BaseDeductionCode->cellAttributes() ?>>
<span id="el_deduction_type_BaseDeductionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseDeductionCode"><?php echo EmptyValue(strval($deduction_type_edit->BaseDeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_edit->BaseDeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_edit->BaseDeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_edit->BaseDeductionCode->ReadOnly || $deduction_type_edit->BaseDeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseDeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_edit->BaseDeductionCode->Lookup->getParamTag($deduction_type_edit, "p_x_BaseDeductionCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_edit->BaseDeductionCode->displayValueSeparatorAttribute() ?>" name="x_BaseDeductionCode" id="x_BaseDeductionCode" value="<?php echo $deduction_type_edit->BaseDeductionCode->CurrentValue ?>"<?php echo $deduction_type_edit->BaseDeductionCode->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->BaseDeductionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->TaxExempt->Visible) { // TaxExempt ?>
	<div id="r_TaxExempt" class="form-group row">
		<label id="elh_deduction_type_TaxExempt" for="x_TaxExempt" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->TaxExempt->caption() ?><?php echo $deduction_type_edit->TaxExempt->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->TaxExempt->cellAttributes() ?>>
<span id="el_deduction_type_TaxExempt">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_TaxExempt" data-value-separator="<?php echo $deduction_type_edit->TaxExempt->displayValueSeparatorAttribute() ?>" id="x_TaxExempt" name="x_TaxExempt"<?php echo $deduction_type_edit->TaxExempt->editAttributes() ?>>
			<?php echo $deduction_type_edit->TaxExempt->selectOptionListHtml("x_TaxExempt") ?>
		</select>
</div>
<?php echo $deduction_type_edit->TaxExempt->Lookup->getParamTag($deduction_type_edit, "p_x_TaxExempt") ?>
</span>
<?php echo $deduction_type_edit->TaxExempt->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->JobCode->Visible) { // JobCode ?>
	<div id="r_JobCode" class="form-group row">
		<label id="elh_deduction_type_JobCode" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->JobCode->caption() ?><?php echo $deduction_type_edit->JobCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->JobCode->cellAttributes() ?>>
<span id="el_deduction_type_JobCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobCode"><?php echo EmptyValue(strval($deduction_type_edit->JobCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_edit->JobCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_edit->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_edit->JobCode->ReadOnly || $deduction_type_edit->JobCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_edit->JobCode->Lookup->getParamTag($deduction_type_edit, "p_x_JobCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $deduction_type_edit->JobCode->displayValueSeparatorAttribute() ?>" name="x_JobCode[]" id="x_JobCode[]" value="<?php echo $deduction_type_edit->JobCode->CurrentValue ?>"<?php echo $deduction_type_edit->JobCode->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->JobCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->MinimumAmount->Visible) { // MinimumAmount ?>
	<div id="r_MinimumAmount" class="form-group row">
		<label id="elh_deduction_type_MinimumAmount" for="x_MinimumAmount" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->MinimumAmount->caption() ?><?php echo $deduction_type_edit->MinimumAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->MinimumAmount->cellAttributes() ?>>
<span id="el_deduction_type_MinimumAmount">
<input type="text" data-table="deduction_type" data-field="x_MinimumAmount" name="x_MinimumAmount" id="x_MinimumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_edit->MinimumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->MinimumAmount->EditValue ?>"<?php echo $deduction_type_edit->MinimumAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->MinimumAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->MaximumAmount->Visible) { // MaximumAmount ?>
	<div id="r_MaximumAmount" class="form-group row">
		<label id="elh_deduction_type_MaximumAmount" for="x_MaximumAmount" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->MaximumAmount->caption() ?><?php echo $deduction_type_edit->MaximumAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->MaximumAmount->cellAttributes() ?>>
<span id="el_deduction_type_MaximumAmount">
<input type="text" data-table="deduction_type" data-field="x_MaximumAmount" name="x_MaximumAmount" id="x_MaximumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_edit->MaximumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->MaximumAmount->EditValue ?>"<?php echo $deduction_type_edit->MaximumAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->MaximumAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
	<div id="r_EmployerContributionRate" class="form-group row">
		<label id="elh_deduction_type_EmployerContributionRate" for="x_EmployerContributionRate" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->EmployerContributionRate->caption() ?><?php echo $deduction_type_edit->EmployerContributionRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->EmployerContributionRate->cellAttributes() ?>>
<span id="el_deduction_type_EmployerContributionRate">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionRate" name="x_EmployerContributionRate" id="x_EmployerContributionRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_edit->EmployerContributionRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->EmployerContributionRate->EditValue ?>"<?php echo $deduction_type_edit->EmployerContributionRate->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->EmployerContributionRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
	<div id="r_EmployerContributionAmount" class="form-group row">
		<label id="elh_deduction_type_EmployerContributionAmount" for="x_EmployerContributionAmount" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->EmployerContributionAmount->caption() ?><?php echo $deduction_type_edit->EmployerContributionAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->EmployerContributionAmount->cellAttributes() ?>>
<span id="el_deduction_type_EmployerContributionAmount">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="x_EmployerContributionAmount" id="x_EmployerContributionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_edit->EmployerContributionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_edit->EmployerContributionAmount->EditValue ?>"<?php echo $deduction_type_edit->EmployerContributionAmount->editAttributes() ?>>
</span>
<?php echo $deduction_type_edit->EmployerContributionAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($deduction_type_edit->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label id="elh_deduction_type_Application" for="x_Application" class="<?php echo $deduction_type_edit->LeftColumnClass ?>"><?php echo $deduction_type_edit->Application->caption() ?><?php echo $deduction_type_edit->Application->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $deduction_type_edit->RightColumnClass ?>"><div <?php echo $deduction_type_edit->Application->cellAttributes() ?>>
<span id="el_deduction_type_Application">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_Application" data-value-separator="<?php echo $deduction_type_edit->Application->displayValueSeparatorAttribute() ?>" id="x_Application" name="x_Application"<?php echo $deduction_type_edit->Application->editAttributes() ?>>
			<?php echo $deduction_type_edit->Application->selectOptionListHtml("x_Application") ?>
		</select>
</div>
<?php echo $deduction_type_edit->Application->Lookup->getParamTag($deduction_type_edit, "p_x_Application") ?>
</span>
<?php echo $deduction_type_edit->Application->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$deduction_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $deduction_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $deduction_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$deduction_type_edit->IsModal) { ?>
<?php echo $deduction_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$deduction_type_edit->showPageFooter();
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
$deduction_type_edit->terminate();
?>