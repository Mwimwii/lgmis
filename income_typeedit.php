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
$income_type_edit = new income_type_edit();

// Run the page
$income_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fincome_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fincome_typeedit = currentForm = new ew.Form("fincome_typeedit", "edit");

	// Validate form
	fincome_typeedit.validate = function() {
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
			<?php if ($income_type_edit->IncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->IncomeCode->caption(), $income_type_edit->IncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->IncomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->IncomeName->caption(), $income_type_edit->IncomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->IncomeDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->IncomeDescription->caption(), $income_type_edit->IncomeDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->Division->caption(), $income_type_edit->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->IncomeAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->IncomeAmount->caption(), $income_type_edit->IncomeAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncomeAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_type_edit->IncomeAmount->errorMessage()) ?>");
			<?php if ($income_type_edit->IncomeBasicRate->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeBasicRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->IncomeBasicRate->caption(), $income_type_edit->IncomeBasicRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncomeBasicRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_type_edit->IncomeBasicRate->errorMessage()) ?>");
			<?php if ($income_type_edit->BaseIncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseIncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->BaseIncomeCode->caption(), $income_type_edit->BaseIncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->Taxable->Required) { ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->Taxable->caption(), $income_type_edit->Taxable->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->AccountNo->caption(), $income_type_edit->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->JobIncluded->Required) { ?>
				elm = this.getElements("x" + infix + "_JobIncluded[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->JobIncluded->caption(), $income_type_edit->JobIncluded->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->Application->Required) { ?>
				elm = this.getElements("x" + infix + "_Application");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->Application->caption(), $income_type_edit->Application->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_edit->JobExcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_JobExcluded[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_edit->JobExcluded->caption(), $income_type_edit->JobExcluded->RequiredErrorMessage)) ?>");
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
	fincome_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fincome_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fincome_typeedit.lists["x_Division[]"] = <?php echo $income_type_edit->Division->Lookup->toClientList($income_type_edit) ?>;
	fincome_typeedit.lists["x_Division[]"].options = <?php echo JsonEncode($income_type_edit->Division->lookupOptions()) ?>;
	fincome_typeedit.lists["x_BaseIncomeCode"] = <?php echo $income_type_edit->BaseIncomeCode->Lookup->toClientList($income_type_edit) ?>;
	fincome_typeedit.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($income_type_edit->BaseIncomeCode->lookupOptions()) ?>;
	fincome_typeedit.lists["x_Taxable"] = <?php echo $income_type_edit->Taxable->Lookup->toClientList($income_type_edit) ?>;
	fincome_typeedit.lists["x_Taxable"].options = <?php echo JsonEncode($income_type_edit->Taxable->lookupOptions()) ?>;
	fincome_typeedit.lists["x_AccountNo"] = <?php echo $income_type_edit->AccountNo->Lookup->toClientList($income_type_edit) ?>;
	fincome_typeedit.lists["x_AccountNo"].options = <?php echo JsonEncode($income_type_edit->AccountNo->lookupOptions()) ?>;
	fincome_typeedit.lists["x_JobIncluded[]"] = <?php echo $income_type_edit->JobIncluded->Lookup->toClientList($income_type_edit) ?>;
	fincome_typeedit.lists["x_JobIncluded[]"].options = <?php echo JsonEncode($income_type_edit->JobIncluded->lookupOptions()) ?>;
	fincome_typeedit.lists["x_Application"] = <?php echo $income_type_edit->Application->Lookup->toClientList($income_type_edit) ?>;
	fincome_typeedit.lists["x_Application"].options = <?php echo JsonEncode($income_type_edit->Application->lookupOptions()) ?>;
	fincome_typeedit.lists["x_JobExcluded[]"] = <?php echo $income_type_edit->JobExcluded->Lookup->toClientList($income_type_edit) ?>;
	fincome_typeedit.lists["x_JobExcluded[]"].options = <?php echo JsonEncode($income_type_edit->JobExcluded->lookupOptions()) ?>;
	loadjs.done("fincome_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $income_type_edit->showPageHeader(); ?>
<?php
$income_type_edit->showMessage();
?>
<?php if (!$income_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $income_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fincome_typeedit" id="fincome_typeedit" class="<?php echo $income_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="income_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$income_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($income_type_edit->IncomeCode->Visible) { // IncomeCode ?>
	<div id="r_IncomeCode" class="form-group row">
		<label id="elh_income_type_IncomeCode" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->IncomeCode->caption() ?><?php echo $income_type_edit->IncomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->IncomeCode->cellAttributes() ?>>
<span id="el_income_type_IncomeCode">
<span<?php echo $income_type_edit->IncomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_type_edit->IncomeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeCode" name="x_IncomeCode" id="x_IncomeCode" value="<?php echo HtmlEncode($income_type_edit->IncomeCode->CurrentValue) ?>">
<?php echo $income_type_edit->IncomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->IncomeName->Visible) { // IncomeName ?>
	<div id="r_IncomeName" class="form-group row">
		<label id="elh_income_type_IncomeName" for="x_IncomeName" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->IncomeName->caption() ?><?php echo $income_type_edit->IncomeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->IncomeName->cellAttributes() ?>>
<span id="el_income_type_IncomeName">
<input type="text" data-table="income_type" data-field="x_IncomeName" name="x_IncomeName" id="x_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_edit->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_type_edit->IncomeName->EditValue ?>"<?php echo $income_type_edit->IncomeName->editAttributes() ?>>
</span>
<?php echo $income_type_edit->IncomeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->IncomeDescription->Visible) { // IncomeDescription ?>
	<div id="r_IncomeDescription" class="form-group row">
		<label id="elh_income_type_IncomeDescription" for="x_IncomeDescription" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->IncomeDescription->caption() ?><?php echo $income_type_edit->IncomeDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->IncomeDescription->cellAttributes() ?>>
<span id="el_income_type_IncomeDescription">
<input type="text" data-table="income_type" data-field="x_IncomeDescription" name="x_IncomeDescription" id="x_IncomeDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_edit->IncomeDescription->getPlaceHolder()) ?>" value="<?php echo $income_type_edit->IncomeDescription->EditValue ?>"<?php echo $income_type_edit->IncomeDescription->editAttributes() ?>>
</span>
<?php echo $income_type_edit->IncomeDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_income_type_Division" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->Division->caption() ?><?php echo $income_type_edit->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->Division->cellAttributes() ?>>
<span id="el_income_type_Division">
<div id="tp_x_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="income_type" data-field="x_Division" data-value-separator="<?php echo $income_type_edit->Division->displayValueSeparatorAttribute() ?>" name="x_Division[]" id="x_Division[]" value="{value}"<?php echo $income_type_edit->Division->editAttributes() ?>></div>
<div id="dsl_x_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $income_type_edit->Division->checkBoxListHtml(FALSE, "x_Division[]") ?>
</div></div>
<?php echo $income_type_edit->Division->Lookup->getParamTag($income_type_edit, "p_x_Division") ?>
</span>
<?php echo $income_type_edit->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->IncomeAmount->Visible) { // IncomeAmount ?>
	<div id="r_IncomeAmount" class="form-group row">
		<label id="elh_income_type_IncomeAmount" for="x_IncomeAmount" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->IncomeAmount->caption() ?><?php echo $income_type_edit->IncomeAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->IncomeAmount->cellAttributes() ?>>
<span id="el_income_type_IncomeAmount">
<input type="text" data-table="income_type" data-field="x_IncomeAmount" name="x_IncomeAmount" id="x_IncomeAmount" size="30" placeholder="<?php echo HtmlEncode($income_type_edit->IncomeAmount->getPlaceHolder()) ?>" value="<?php echo $income_type_edit->IncomeAmount->EditValue ?>"<?php echo $income_type_edit->IncomeAmount->editAttributes() ?>>
</span>
<?php echo $income_type_edit->IncomeAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
	<div id="r_IncomeBasicRate" class="form-group row">
		<label id="elh_income_type_IncomeBasicRate" for="x_IncomeBasicRate" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->IncomeBasicRate->caption() ?><?php echo $income_type_edit->IncomeBasicRate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->IncomeBasicRate->cellAttributes() ?>>
<span id="el_income_type_IncomeBasicRate">
<input type="text" data-table="income_type" data-field="x_IncomeBasicRate" name="x_IncomeBasicRate" id="x_IncomeBasicRate" size="30" placeholder="<?php echo HtmlEncode($income_type_edit->IncomeBasicRate->getPlaceHolder()) ?>" value="<?php echo $income_type_edit->IncomeBasicRate->EditValue ?>"<?php echo $income_type_edit->IncomeBasicRate->editAttributes() ?>>
</span>
<?php echo $income_type_edit->IncomeBasicRate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<div id="r_BaseIncomeCode" class="form-group row">
		<label id="elh_income_type_BaseIncomeCode" for="x_BaseIncomeCode" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->BaseIncomeCode->caption() ?><?php echo $income_type_edit->BaseIncomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->BaseIncomeCode->cellAttributes() ?>>
<span id="el_income_type_BaseIncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BaseIncomeCode"><?php echo EmptyValue(strval($income_type_edit->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_edit->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_edit->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_edit->BaseIncomeCode->ReadOnly || $income_type_edit->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_edit->BaseIncomeCode->Lookup->getParamTag($income_type_edit, "p_x_BaseIncomeCode") ?>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_edit->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x_BaseIncomeCode" id="x_BaseIncomeCode" value="<?php echo $income_type_edit->BaseIncomeCode->CurrentValue ?>"<?php echo $income_type_edit->BaseIncomeCode->editAttributes() ?>>
</span>
<?php echo $income_type_edit->BaseIncomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->Taxable->Visible) { // Taxable ?>
	<div id="r_Taxable" class="form-group row">
		<label id="elh_income_type_Taxable" for="x_Taxable" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->Taxable->caption() ?><?php echo $income_type_edit->Taxable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->Taxable->cellAttributes() ?>>
<span id="el_income_type_Taxable">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Taxable" data-value-separator="<?php echo $income_type_edit->Taxable->displayValueSeparatorAttribute() ?>" id="x_Taxable" name="x_Taxable"<?php echo $income_type_edit->Taxable->editAttributes() ?>>
			<?php echo $income_type_edit->Taxable->selectOptionListHtml("x_Taxable") ?>
		</select>
</div>
<?php echo $income_type_edit->Taxable->Lookup->getParamTag($income_type_edit, "p_x_Taxable") ?>
</span>
<?php echo $income_type_edit->Taxable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label id="elh_income_type_AccountNo" for="x_AccountNo" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->AccountNo->caption() ?><?php echo $income_type_edit->AccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->AccountNo->cellAttributes() ?>>
<span id="el_income_type_AccountNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AccountNo"><?php echo EmptyValue(strval($income_type_edit->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_edit->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_edit->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_edit->AccountNo->ReadOnly || $income_type_edit->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_edit->AccountNo->Lookup->getParamTag($income_type_edit, "p_x_AccountNo") ?>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_edit->AccountNo->displayValueSeparatorAttribute() ?>" name="x_AccountNo" id="x_AccountNo" value="<?php echo $income_type_edit->AccountNo->CurrentValue ?>"<?php echo $income_type_edit->AccountNo->editAttributes() ?>>
</span>
<?php echo $income_type_edit->AccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->JobIncluded->Visible) { // JobIncluded ?>
	<div id="r_JobIncluded" class="form-group row">
		<label id="elh_income_type_JobIncluded" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->JobIncluded->caption() ?><?php echo $income_type_edit->JobIncluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->JobIncluded->cellAttributes() ?>>
<span id="el_income_type_JobIncluded">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobIncluded"><?php echo EmptyValue(strval($income_type_edit->JobIncluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_edit->JobIncluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_edit->JobIncluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_edit->JobIncluded->ReadOnly || $income_type_edit->JobIncluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobIncluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_edit->JobIncluded->Lookup->getParamTag($income_type_edit, "p_x_JobIncluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_edit->JobIncluded->displayValueSeparatorAttribute() ?>" name="x_JobIncluded[]" id="x_JobIncluded[]" value="<?php echo $income_type_edit->JobIncluded->CurrentValue ?>"<?php echo $income_type_edit->JobIncluded->editAttributes() ?>>
</span>
<?php echo $income_type_edit->JobIncluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label id="elh_income_type_Application" for="x_Application" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->Application->caption() ?><?php echo $income_type_edit->Application->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->Application->cellAttributes() ?>>
<span id="el_income_type_Application">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Application" data-value-separator="<?php echo $income_type_edit->Application->displayValueSeparatorAttribute() ?>" id="x_Application" name="x_Application"<?php echo $income_type_edit->Application->editAttributes() ?>>
			<?php echo $income_type_edit->Application->selectOptionListHtml("x_Application") ?>
		</select>
</div>
<?php echo $income_type_edit->Application->Lookup->getParamTag($income_type_edit, "p_x_Application") ?>
</span>
<?php echo $income_type_edit->Application->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($income_type_edit->JobExcluded->Visible) { // JobExcluded ?>
	<div id="r_JobExcluded" class="form-group row">
		<label id="elh_income_type_JobExcluded" class="<?php echo $income_type_edit->LeftColumnClass ?>"><?php echo $income_type_edit->JobExcluded->caption() ?><?php echo $income_type_edit->JobExcluded->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $income_type_edit->RightColumnClass ?>"><div <?php echo $income_type_edit->JobExcluded->cellAttributes() ?>>
<span id="el_income_type_JobExcluded">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_JobExcluded"><?php echo EmptyValue(strval($income_type_edit->JobExcluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_edit->JobExcluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_edit->JobExcluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_edit->JobExcluded->ReadOnly || $income_type_edit->JobExcluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_JobExcluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_edit->JobExcluded->Lookup->getParamTag($income_type_edit, "p_x_JobExcluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_edit->JobExcluded->displayValueSeparatorAttribute() ?>" name="x_JobExcluded[]" id="x_JobExcluded[]" value="<?php echo $income_type_edit->JobExcluded->CurrentValue ?>"<?php echo $income_type_edit->JobExcluded->editAttributes() ?>>
</span>
<?php echo $income_type_edit->JobExcluded->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$income_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $income_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $income_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$income_type_edit->IsModal) { ?>
<?php echo $income_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$income_type_edit->showPageFooter();
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
$income_type_edit->terminate();
?>