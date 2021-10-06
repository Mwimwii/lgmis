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
$income_type_add = new income_type_add();

// Run the page
$income_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fincome_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fincome_typeadd = currentForm = new ew.Form("fincome_typeadd", "add");

	// Validate form
	fincome_typeadd.validate = function() {
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
			<?php if ($income_type_add->IncomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->IncomeName->caption(), $income_type_add->IncomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->IncomeDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->IncomeDescription->caption(), $income_type_add->IncomeDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->Division->caption(), $income_type_add->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->IncomeAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->IncomeAmount->caption(), $income_type_add->IncomeAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncomeAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_type_add->IncomeAmount->errorMessage()) ?>");
			<?php if ($income_type_add->IncomeBasicRate->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeBasicRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->IncomeBasicRate->caption(), $income_type_add->IncomeBasicRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncomeBasicRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_type_add->IncomeBasicRate->errorMessage()) ?>");
			<?php if ($income_type_add->BaseIncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseIncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->BaseIncomeCode->caption(), $income_type_add->BaseIncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->Taxable->Required) { ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->Taxable->caption(), $income_type_add->Taxable->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->AccountNo->caption(), $income_type_add->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->JobIncluded->Required) { ?>
				elm = this.getElements("x" + infix + "_JobIncluded[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->JobIncluded->caption(), $income_type_add->JobIncluded->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->Application->Required) { ?>
				elm = this.getElements("x" + infix + "_Application");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->Application->caption(), $income_type_add->Application->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_add->JobExcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_JobExcluded[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_add->JobExcluded->caption(), $income_type_add->JobExcluded->RequiredErrorMessage)) ?>");
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
	fincome_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fincome_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fincome_typeadd.lists["x_Division[]"] = <?php echo $income_type_add->Division->Lookup->toClientList($income_type_add) ?>;
	fincome_typeadd.lists["x_Division[]"].options = <?php echo JsonEncode($income_type_add->Division->lookupOptions()) ?>;
	fincome_typeadd.lists["x_BaseIncomeCode"] = <?php echo $income_type_add->BaseIncomeCode->Lookup->toClientList($income_type_add) ?>;
	fincome_typeadd.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($income_type_add->BaseIncomeCode->lookupOptions()) ?>;
	fincome_typeadd.lists["x_Taxable"] = <?php echo $income_type_add->Taxable->Lookup->toClientList($income_type_add) ?>;
	fincome_typeadd.lists["x_Taxable"].options = <?php echo JsonEncode($income_type_add->Taxable->lookupOptions()) ?>;
	fincome_typeadd.lists["x_AccountNo"] = <?php echo $income_type_add->AccountNo->Lookup->toClientList($income_type_add) ?>;
	fincome_typeadd.lists["x_AccountNo"].options = <?php echo JsonEncode($income_type_add->AccountNo->lookupOptions()) ?>;
	fincome_typeadd.lists["x_JobIncluded[]"] = <?php echo $income_type_add->JobIncluded->Lookup->toClientList($income_type_add) ?>;
	fincome_typeadd.lists["x_JobIncluded[]"].options = <?php echo JsonEncode($income_type_add->JobIncluded->lookupOptions()) ?>;
	fincome_typeadd.lists["x_Application"] = <?php echo $income_type_add->Application->Lookup->toClientList($income_type_add) ?>;
	fincome_typeadd.lists["x_Application"].options = <?php echo JsonEncode($income_type_add->Application->lookupOptions()) ?>;
	fincome_typeadd.lists["x_JobExcluded[]"] = <?php echo $income_type_add->JobExcluded->Lookup->toClientList($income_type_add) ?>;
	fincome_typeadd.lists["x_JobExcluded[]"].options = <?php echo JsonEncode($income_type_add->JobExcluded->lookupOptions()) ?>;
	loadjs.done("fincome_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $income_type_add->showPageHeader(); ?>
<?php
$income_type_add->showMessage();
?>
<form name="fincome_typeadd" id="fincome_typeadd" class="<?php echo $income_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="income_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$income_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($income_type_add->IncomeName->Visible) { // IncomeName ?>
	<div id="r_IncomeName" class="form-group row">
		<label id="elh_income_type_IncomeName" for="x_IncomeName" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->IncomeName->caption() ?><?php echo $income_type_add->IncomeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->IncomeName->cellAttributes() ?>>
<span id="el_income_type_IncomeName">
<input type="text" data-table="income_type" data-field="x_IncomeName" name="x_IncomeName" id="x_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_add->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_type_add->IncomeName->EditValue ?>"<?php echo $income_type_add->IncomeName->editAttributes() ?>>
</span>
<?php echo $income_type_add->IncomeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->IncomeDescription->Visible) { // IncomeDescription ?>
	<div id="r_IncomeDescription" class="form-group row">
		<label id="elh_income_type_IncomeDescription" for="x_IncomeDescription" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->IncomeDescription->caption() ?><?php echo $income_type_add->IncomeDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->IncomeDescription->cellAttributes() ?>>
<span id="el_income_type_IncomeDescription">
<input type="text" data-table="income_type" data-field="x_IncomeDescription" name="x_IncomeDescription" id="x_IncomeDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_add->IncomeDescription->getPlaceHolder()) ?>" value="<?php echo $income_type_add->IncomeDescription->EditValue ?>"<?php echo $income_type_add->IncomeDescription->editAttributes() ?>>
</span>
<?php echo $income_type_add->IncomeDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_income_type_Division" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->Division->caption() ?><?php echo $income_type_add->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->Division->cellAttributes() ?>>
<span id="el_income_type_Division">
<div id="tp_x_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="income_type" data-field="x_Division" data-value-separator="<?php echo $income_type_add->Division->displayValueSeparatorAttribute() ?>" name="x_Division[]" id="x_Division[]" value="{value}"<?php echo $income_type_add->Division->editAttributes() ?>></div>
<div id="dsl_x_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $income_type_add->Division->checkBoxListHtml(FALSE, "x_Division[]") ?>
</div></div>
<?php echo $income_type_add->Division->Lookup->getParamTag($income_type_add, "p_x_Division") ?>
</span>
<?php echo $income_type_add->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->IncomeAmount->Visible) { // IncomeAmount ?>
	<div id="r_IncomeAmount" class="form-group row">
		<label id="elh_income_type_IncomeAmount" for="x_IncomeAmount" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->IncomeAmount->caption() ?><?php echo $income_type_add->IncomeAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->IncomeAmount->cellAttributes() ?>>
<span id="el_income_type_IncomeAmount">
<input type="text" data-table="income_type" data-field="x_IncomeAmount" name="x_IncomeAmount" id="x_IncomeAmount" size="30" placeholder="<?php echo HtmlEncode($income_type_add->IncomeAmount->getPlaceHolder()) ?>" value="<?php echo $income_type_add->IncomeAmount->EditValue ?>"<?php echo $income_type_add->IncomeAmount->editAttributes() ?>>
</span>
<?php echo $income_type_add->IncomeAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
	<div id="r_IncomeBasicRate" class="form-group row">
		<label id="elh_income_type_IncomeBasicRate" for="x_IncomeBasicRate" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->IncomeBasicRate->caption() ?><?php echo $income_type_add->IncomeBasicRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->IncomeBasicRate->cellAttributes() ?>>
<span id="el_income_type_IncomeBasicRate">
<input type="text" data-table="income_type" data-field="x_IncomeBasicRate" name="x_IncomeBasicRate" id="x_IncomeBasicRate" size="30" placeholder="<?php echo HtmlEncode($income_type_add->IncomeBasicRate->getPlaceHolder()) ?>" value="<?php echo $income_type_add->IncomeBasicRate->EditValue ?>"<?php echo $income_type_add->IncomeBasicRate->editAttributes() ?>>
</span>
<?php echo $income_type_add->IncomeBasicRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<div id="r_BaseIncomeCode" class="form-group row">
		<label id="elh_income_type_BaseIncomeCode" for="x_BaseIncomeCode" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->BaseIncomeCode->caption() ?><?php echo $income_type_add->BaseIncomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->BaseIncomeCode->cellAttributes() ?>>
<span id="el_income_type_BaseIncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseIncomeCode"><?php echo EmptyValue(strval($income_type_add->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_add->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_add->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_add->BaseIncomeCode->ReadOnly || $income_type_add->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_add->BaseIncomeCode->Lookup->getParamTag($income_type_add, "p_x_BaseIncomeCode") ?>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_add->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x_BaseIncomeCode" id="x_BaseIncomeCode" value="<?php echo $income_type_add->BaseIncomeCode->CurrentValue ?>"<?php echo $income_type_add->BaseIncomeCode->editAttributes() ?>>
</span>
<?php echo $income_type_add->BaseIncomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->Taxable->Visible) { // Taxable ?>
	<div id="r_Taxable" class="form-group row">
		<label id="elh_income_type_Taxable" for="x_Taxable" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->Taxable->caption() ?><?php echo $income_type_add->Taxable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->Taxable->cellAttributes() ?>>
<span id="el_income_type_Taxable">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Taxable" data-value-separator="<?php echo $income_type_add->Taxable->displayValueSeparatorAttribute() ?>" id="x_Taxable" name="x_Taxable"<?php echo $income_type_add->Taxable->editAttributes() ?>>
			<?php echo $income_type_add->Taxable->selectOptionListHtml("x_Taxable") ?>
		</select>
</div>
<?php echo $income_type_add->Taxable->Lookup->getParamTag($income_type_add, "p_x_Taxable") ?>
</span>
<?php echo $income_type_add->Taxable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label id="elh_income_type_AccountNo" for="x_AccountNo" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->AccountNo->caption() ?><?php echo $income_type_add->AccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->AccountNo->cellAttributes() ?>>
<span id="el_income_type_AccountNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountNo"><?php echo EmptyValue(strval($income_type_add->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_add->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_add->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_add->AccountNo->ReadOnly || $income_type_add->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_add->AccountNo->Lookup->getParamTag($income_type_add, "p_x_AccountNo") ?>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_add->AccountNo->displayValueSeparatorAttribute() ?>" name="x_AccountNo" id="x_AccountNo" value="<?php echo $income_type_add->AccountNo->CurrentValue ?>"<?php echo $income_type_add->AccountNo->editAttributes() ?>>
</span>
<?php echo $income_type_add->AccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->JobIncluded->Visible) { // JobIncluded ?>
	<div id="r_JobIncluded" class="form-group row">
		<label id="elh_income_type_JobIncluded" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->JobIncluded->caption() ?><?php echo $income_type_add->JobIncluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->JobIncluded->cellAttributes() ?>>
<span id="el_income_type_JobIncluded">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobIncluded"><?php echo EmptyValue(strval($income_type_add->JobIncluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_add->JobIncluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_add->JobIncluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_add->JobIncluded->ReadOnly || $income_type_add->JobIncluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobIncluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_add->JobIncluded->Lookup->getParamTag($income_type_add, "p_x_JobIncluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_add->JobIncluded->displayValueSeparatorAttribute() ?>" name="x_JobIncluded[]" id="x_JobIncluded[]" value="<?php echo $income_type_add->JobIncluded->CurrentValue ?>"<?php echo $income_type_add->JobIncluded->editAttributes() ?>>
</span>
<?php echo $income_type_add->JobIncluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label id="elh_income_type_Application" for="x_Application" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->Application->caption() ?><?php echo $income_type_add->Application->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->Application->cellAttributes() ?>>
<span id="el_income_type_Application">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Application" data-value-separator="<?php echo $income_type_add->Application->displayValueSeparatorAttribute() ?>" id="x_Application" name="x_Application"<?php echo $income_type_add->Application->editAttributes() ?>>
			<?php echo $income_type_add->Application->selectOptionListHtml("x_Application") ?>
		</select>
</div>
<?php echo $income_type_add->Application->Lookup->getParamTag($income_type_add, "p_x_Application") ?>
</span>
<?php echo $income_type_add->Application->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_add->JobExcluded->Visible) { // JobExcluded ?>
	<div id="r_JobExcluded" class="form-group row">
		<label id="elh_income_type_JobExcluded" class="<?php echo $income_type_add->LeftColumnClass ?>"><?php echo $income_type_add->JobExcluded->caption() ?><?php echo $income_type_add->JobExcluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_add->RightColumnClass ?>"><div <?php echo $income_type_add->JobExcluded->cellAttributes() ?>>
<span id="el_income_type_JobExcluded">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobExcluded"><?php echo EmptyValue(strval($income_type_add->JobExcluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_add->JobExcluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_add->JobExcluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_add->JobExcluded->ReadOnly || $income_type_add->JobExcluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobExcluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_add->JobExcluded->Lookup->getParamTag($income_type_add, "p_x_JobExcluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_add->JobExcluded->displayValueSeparatorAttribute() ?>" name="x_JobExcluded[]" id="x_JobExcluded[]" value="<?php echo $income_type_add->JobExcluded->CurrentValue ?>"<?php echo $income_type_add->JobExcluded->editAttributes() ?>>
</span>
<?php echo $income_type_add->JobExcluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$income_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $income_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $income_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$income_type_add->showPageFooter();
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
$income_type_add->terminate();
?>