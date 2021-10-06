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
$contract_edit = new contract_edit();

// Run the page
$contract_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcontractedit = currentForm = new ew.Form("fcontractedit", "edit");

	// Validate form
	fcontractedit.validate = function() {
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
			<?php if ($contract_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->LACode->caption(), $contract_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->DepartmentCode->caption(), $contract_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->SectionCode->caption(), $contract_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ProjectCode->caption(), $contract_edit->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ContractNo->caption(), $contract_edit->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->ContractName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ContractName->caption(), $contract_edit->ContractName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->ContractType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ContractType->caption(), $contract_edit->ContractType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->ContractSum->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractSum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ContractSum->caption(), $contract_edit->ContractSum->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractSum");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->ContractSum->errorMessage()) ?>");
			<?php if ($contract_edit->RevisedContractSum->Required) { ?>
				elm = this.getElements("x" + infix + "_RevisedContractSum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->RevisedContractSum->caption(), $contract_edit->RevisedContractSum->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RevisedContractSum");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->RevisedContractSum->errorMessage()) ?>");
			<?php if ($contract_edit->ContractorRef->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ContractorRef->caption(), $contract_edit->ContractorRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->SigningDate->Required) { ?>
				elm = this.getElements("x" + infix + "_SigningDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->SigningDate->caption(), $contract_edit->SigningDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SigningDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->SigningDate->errorMessage()) ?>");
			<?php if ($contract_edit->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->PlannedStartDate->caption(), $contract_edit->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->PlannedStartDate->errorMessage()) ?>");
			<?php if ($contract_edit->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->PlannedEndDate->caption(), $contract_edit->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->PlannedEndDate->errorMessage()) ?>");
			<?php if ($contract_edit->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ActualStartDate->caption(), $contract_edit->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->ActualStartDate->errorMessage()) ?>");
			<?php if ($contract_edit->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ActualEndDate->caption(), $contract_edit->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->ActualEndDate->errorMessage()) ?>");
			<?php if ($contract_edit->Duration->Required) { ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->Duration->caption(), $contract_edit->Duration->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->Duration->errorMessage()) ?>");
			<?php if ($contract_edit->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->UnitOfMeasure->caption(), $contract_edit->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_edit->AdvancePaymentAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->AdvancePaymentAmount->caption(), $contract_edit->AdvancePaymentAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->AdvancePaymentAmount->errorMessage()) ?>");
			<?php if ($contract_edit->AdvancePaymentdate->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->AdvancePaymentdate->caption(), $contract_edit->AdvancePaymentdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_edit->AdvancePaymentdate->errorMessage()) ?>");
			<?php if ($contract_edit->ContractStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_edit->ContractStatus->caption(), $contract_edit->ContractStatus->RequiredErrorMessage)) ?>");
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
	fcontractedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontractedit.lists["x_LACode"] = <?php echo $contract_edit->LACode->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_LACode"].options = <?php echo JsonEncode($contract_edit->LACode->lookupOptions()) ?>;
	fcontractedit.lists["x_DepartmentCode"] = <?php echo $contract_edit->DepartmentCode->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($contract_edit->DepartmentCode->lookupOptions()) ?>;
	fcontractedit.lists["x_SectionCode"] = <?php echo $contract_edit->SectionCode->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_SectionCode"].options = <?php echo JsonEncode($contract_edit->SectionCode->lookupOptions()) ?>;
	fcontractedit.lists["x_ProjectCode"] = <?php echo $contract_edit->ProjectCode->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_ProjectCode"].options = <?php echo JsonEncode($contract_edit->ProjectCode->lookupOptions()) ?>;
	fcontractedit.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcontractedit.lists["x_ContractType"] = <?php echo $contract_edit->ContractType->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_ContractType"].options = <?php echo JsonEncode($contract_edit->ContractType->lookupOptions()) ?>;
	fcontractedit.lists["x_ContractorRef"] = <?php echo $contract_edit->ContractorRef->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_ContractorRef"].options = <?php echo JsonEncode($contract_edit->ContractorRef->lookupOptions()) ?>;
	fcontractedit.lists["x_UnitOfMeasure"] = <?php echo $contract_edit->UnitOfMeasure->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($contract_edit->UnitOfMeasure->lookupOptions()) ?>;
	fcontractedit.lists["x_ContractStatus"] = <?php echo $contract_edit->ContractStatus->Lookup->toClientList($contract_edit) ?>;
	fcontractedit.lists["x_ContractStatus"].options = <?php echo JsonEncode($contract_edit->ContractStatus->lookupOptions()) ?>;
	loadjs.done("fcontractedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_edit->showPageHeader(); ?>
<?php
$contract_edit->showMessage();
?>
<?php if (!$contract_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcontractedit" id="fcontractedit" class="<?php echo $contract_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$contract_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($contract_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_contract_LACode" for="x_LACode" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->LACode->caption() ?><?php echo $contract_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->LACode->cellAttributes() ?>>
<span id="el_contract_LACode">
<?php $contract_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contract_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_edit->LACode->ReadOnly || $contract_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_edit->LACode->Lookup->getParamTag($contract_edit, "p_x_LACode") ?>
<input type="hidden" data-table="contract" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contract_edit->LACode->CurrentValue ?>"<?php echo $contract_edit->LACode->editAttributes() ?>>
</span>
<?php echo $contract_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_contract_DepartmentCode" for="x_DepartmentCode" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->DepartmentCode->caption() ?><?php echo $contract_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_contract_DepartmentCode">
<?php $contract_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($contract_edit->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_edit->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_edit->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_edit->DepartmentCode->ReadOnly || $contract_edit->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_edit->DepartmentCode->Lookup->getParamTag($contract_edit, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="contract" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $contract_edit->DepartmentCode->CurrentValue ?>"<?php echo $contract_edit->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $contract_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_contract_SectionCode" for="x_SectionCode" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->SectionCode->caption() ?><?php echo $contract_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->SectionCode->cellAttributes() ?>>
<span id="el_contract_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_SectionCode" data-value-separator="<?php echo $contract_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $contract_edit->SectionCode->editAttributes() ?>>
			<?php echo $contract_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $contract_edit->SectionCode->Lookup->getParamTag($contract_edit, "p_x_SectionCode") ?>
</span>
<?php echo $contract_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh_contract_ProjectCode" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ProjectCode->caption() ?><?php echo $contract_edit->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ProjectCode->cellAttributes() ?>>
<span id="el_contract_ProjectCode">
<?php
$onchange = $contract_edit->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$contract_edit->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProjectCode" id="sv_x_ProjectCode" value="<?php echo RemoveHtml($contract_edit->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($contract_edit->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($contract_edit->ProjectCode->getPlaceHolder()) ?>"<?php echo $contract_edit->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_edit->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($contract_edit->ProjectCode->ReadOnly || $contract_edit->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="contract" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_edit->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo HtmlEncode($contract_edit->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcontractedit"], function() {
	fcontractedit.createAutoSuggest({"id":"x_ProjectCode","forceSelect":false});
});
</script>
<?php echo $contract_edit->ProjectCode->Lookup->getParamTag($contract_edit, "p_x_ProjectCode") ?>
</span>
<?php echo $contract_edit->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label id="elh_contract_ContractNo" for="x_ContractNo" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ContractNo->caption() ?><?php echo $contract_edit->ContractNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ContractNo->cellAttributes() ?>>
<input type="text" data-table="contract" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_edit->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_edit->ContractNo->EditValue ?>"<?php echo $contract_edit->ContractNo->editAttributes() ?>>
<input type="hidden" data-table="contract" data-field="x_ContractNo" name="o_ContractNo" id="o_ContractNo" value="<?php echo HtmlEncode($contract_edit->ContractNo->OldValue != null ? $contract_edit->ContractNo->OldValue : $contract_edit->ContractNo->CurrentValue) ?>">
<?php echo $contract_edit->ContractNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ContractName->Visible) { // ContractName ?>
	<div id="r_ContractName" class="form-group row">
		<label id="elh_contract_ContractName" for="x_ContractName" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ContractName->caption() ?><?php echo $contract_edit->ContractName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ContractName->cellAttributes() ?>>
<span id="el_contract_ContractName">
<input type="text" data-table="contract" data-field="x_ContractName" name="x_ContractName" id="x_ContractName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_edit->ContractName->getPlaceHolder()) ?>" value="<?php echo $contract_edit->ContractName->EditValue ?>"<?php echo $contract_edit->ContractName->editAttributes() ?>>
</span>
<?php echo $contract_edit->ContractName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ContractType->Visible) { // ContractType ?>
	<div id="r_ContractType" class="form-group row">
		<label id="elh_contract_ContractType" for="x_ContractType" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ContractType->caption() ?><?php echo $contract_edit->ContractType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ContractType->cellAttributes() ?>>
<span id="el_contract_ContractType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_ContractType" data-value-separator="<?php echo $contract_edit->ContractType->displayValueSeparatorAttribute() ?>" id="x_ContractType" name="x_ContractType"<?php echo $contract_edit->ContractType->editAttributes() ?>>
			<?php echo $contract_edit->ContractType->selectOptionListHtml("x_ContractType") ?>
		</select>
</div>
<?php echo $contract_edit->ContractType->Lookup->getParamTag($contract_edit, "p_x_ContractType") ?>
</span>
<?php echo $contract_edit->ContractType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ContractSum->Visible) { // ContractSum ?>
	<div id="r_ContractSum" class="form-group row">
		<label id="elh_contract_ContractSum" for="x_ContractSum" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ContractSum->caption() ?><?php echo $contract_edit->ContractSum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ContractSum->cellAttributes() ?>>
<span id="el_contract_ContractSum">
<input type="text" data-table="contract" data-field="x_ContractSum" name="x_ContractSum" id="x_ContractSum" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_edit->ContractSum->getPlaceHolder()) ?>" value="<?php echo $contract_edit->ContractSum->EditValue ?>"<?php echo $contract_edit->ContractSum->editAttributes() ?>>
</span>
<?php echo $contract_edit->ContractSum->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->RevisedContractSum->Visible) { // RevisedContractSum ?>
	<div id="r_RevisedContractSum" class="form-group row">
		<label id="elh_contract_RevisedContractSum" for="x_RevisedContractSum" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->RevisedContractSum->caption() ?><?php echo $contract_edit->RevisedContractSum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->RevisedContractSum->cellAttributes() ?>>
<span id="el_contract_RevisedContractSum">
<input type="text" data-table="contract" data-field="x_RevisedContractSum" name="x_RevisedContractSum" id="x_RevisedContractSum" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_edit->RevisedContractSum->getPlaceHolder()) ?>" value="<?php echo $contract_edit->RevisedContractSum->EditValue ?>"<?php echo $contract_edit->RevisedContractSum->editAttributes() ?>>
</span>
<?php echo $contract_edit->RevisedContractSum->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ContractorRef->Visible) { // ContractorRef ?>
	<div id="r_ContractorRef" class="form-group row">
		<label id="elh_contract_ContractorRef" for="x_ContractorRef" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ContractorRef->caption() ?><?php echo $contract_edit->ContractorRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ContractorRef->cellAttributes() ?>>
<span id="el_contract_ContractorRef">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ContractorRef"><?php echo EmptyValue(strval($contract_edit->ContractorRef->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_edit->ContractorRef->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_edit->ContractorRef->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_edit->ContractorRef->ReadOnly || $contract_edit->ContractorRef->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ContractorRef',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_edit->ContractorRef->Lookup->getParamTag($contract_edit, "p_x_ContractorRef") ?>
<input type="hidden" data-table="contract" data-field="x_ContractorRef" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_edit->ContractorRef->displayValueSeparatorAttribute() ?>" name="x_ContractorRef" id="x_ContractorRef" value="<?php echo $contract_edit->ContractorRef->CurrentValue ?>"<?php echo $contract_edit->ContractorRef->editAttributes() ?>>
</span>
<?php echo $contract_edit->ContractorRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->SigningDate->Visible) { // SigningDate ?>
	<div id="r_SigningDate" class="form-group row">
		<label id="elh_contract_SigningDate" for="x_SigningDate" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->SigningDate->caption() ?><?php echo $contract_edit->SigningDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->SigningDate->cellAttributes() ?>>
<span id="el_contract_SigningDate">
<input type="text" data-table="contract" data-field="x_SigningDate" name="x_SigningDate" id="x_SigningDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_edit->SigningDate->getPlaceHolder()) ?>" value="<?php echo $contract_edit->SigningDate->EditValue ?>"<?php echo $contract_edit->SigningDate->editAttributes() ?>>
<?php if (!$contract_edit->SigningDate->ReadOnly && !$contract_edit->SigningDate->Disabled && !isset($contract_edit->SigningDate->EditAttrs["readonly"]) && !isset($contract_edit->SigningDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractedit", "x_SigningDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_edit->SigningDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_contract_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->PlannedStartDate->caption() ?><?php echo $contract_edit->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->PlannedStartDate->cellAttributes() ?>>
<span id="el_contract_PlannedStartDate">
<input type="text" data-table="contract" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_edit->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $contract_edit->PlannedStartDate->EditValue ?>"<?php echo $contract_edit->PlannedStartDate->editAttributes() ?>>
<?php if (!$contract_edit->PlannedStartDate->ReadOnly && !$contract_edit->PlannedStartDate->Disabled && !isset($contract_edit->PlannedStartDate->EditAttrs["readonly"]) && !isset($contract_edit->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractedit", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_edit->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_contract_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->PlannedEndDate->caption() ?><?php echo $contract_edit->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->PlannedEndDate->cellAttributes() ?>>
<span id="el_contract_PlannedEndDate">
<input type="text" data-table="contract" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_edit->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $contract_edit->PlannedEndDate->EditValue ?>"<?php echo $contract_edit->PlannedEndDate->editAttributes() ?>>
<?php if (!$contract_edit->PlannedEndDate->ReadOnly && !$contract_edit->PlannedEndDate->Disabled && !isset($contract_edit->PlannedEndDate->EditAttrs["readonly"]) && !isset($contract_edit->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractedit", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_edit->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_contract_ActualStartDate" for="x_ActualStartDate" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ActualStartDate->caption() ?><?php echo $contract_edit->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ActualStartDate->cellAttributes() ?>>
<span id="el_contract_ActualStartDate">
<input type="text" data-table="contract" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_edit->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $contract_edit->ActualStartDate->EditValue ?>"<?php echo $contract_edit->ActualStartDate->editAttributes() ?>>
<?php if (!$contract_edit->ActualStartDate->ReadOnly && !$contract_edit->ActualStartDate->Disabled && !isset($contract_edit->ActualStartDate->EditAttrs["readonly"]) && !isset($contract_edit->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractedit", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_edit->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label id="elh_contract_ActualEndDate" for="x_ActualEndDate" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ActualEndDate->caption() ?><?php echo $contract_edit->ActualEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ActualEndDate->cellAttributes() ?>>
<span id="el_contract_ActualEndDate">
<input type="text" data-table="contract" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_edit->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $contract_edit->ActualEndDate->EditValue ?>"<?php echo $contract_edit->ActualEndDate->editAttributes() ?>>
<?php if (!$contract_edit->ActualEndDate->ReadOnly && !$contract_edit->ActualEndDate->Disabled && !isset($contract_edit->ActualEndDate->EditAttrs["readonly"]) && !isset($contract_edit->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractedit", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_edit->ActualEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->Duration->Visible) { // Duration ?>
	<div id="r_Duration" class="form-group row">
		<label id="elh_contract_Duration" for="x_Duration" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->Duration->caption() ?><?php echo $contract_edit->Duration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->Duration->cellAttributes() ?>>
<span id="el_contract_Duration">
<input type="text" data-table="contract" data-field="x_Duration" name="x_Duration" id="x_Duration" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_edit->Duration->getPlaceHolder()) ?>" value="<?php echo $contract_edit->Duration->EditValue ?>"<?php echo $contract_edit->Duration->editAttributes() ?>>
</span>
<?php echo $contract_edit->Duration->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_contract_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->UnitOfMeasure->caption() ?><?php echo $contract_edit->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->UnitOfMeasure->cellAttributes() ?>>
<span id="el_contract_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $contract_edit->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $contract_edit->UnitOfMeasure->editAttributes() ?>>
			<?php echo $contract_edit->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $contract_edit->UnitOfMeasure->Lookup->getParamTag($contract_edit, "p_x_UnitOfMeasure") ?>
</span>
<?php echo $contract_edit->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
	<div id="r_AdvancePaymentAmount" class="form-group row">
		<label id="elh_contract_AdvancePaymentAmount" for="x_AdvancePaymentAmount" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->AdvancePaymentAmount->caption() ?><?php echo $contract_edit->AdvancePaymentAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->AdvancePaymentAmount->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentAmount">
<input type="text" data-table="contract" data-field="x_AdvancePaymentAmount" name="x_AdvancePaymentAmount" id="x_AdvancePaymentAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_edit->AdvancePaymentAmount->getPlaceHolder()) ?>" value="<?php echo $contract_edit->AdvancePaymentAmount->EditValue ?>"<?php echo $contract_edit->AdvancePaymentAmount->editAttributes() ?>>
</span>
<?php echo $contract_edit->AdvancePaymentAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
	<div id="r_AdvancePaymentdate" class="form-group row">
		<label id="elh_contract_AdvancePaymentdate" for="x_AdvancePaymentdate" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->AdvancePaymentdate->caption() ?><?php echo $contract_edit->AdvancePaymentdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->AdvancePaymentdate->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentdate">
<input type="text" data-table="contract" data-field="x_AdvancePaymentdate" name="x_AdvancePaymentdate" id="x_AdvancePaymentdate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_edit->AdvancePaymentdate->getPlaceHolder()) ?>" value="<?php echo $contract_edit->AdvancePaymentdate->EditValue ?>"<?php echo $contract_edit->AdvancePaymentdate->editAttributes() ?>>
<?php if (!$contract_edit->AdvancePaymentdate->ReadOnly && !$contract_edit->AdvancePaymentdate->Disabled && !isset($contract_edit->AdvancePaymentdate->EditAttrs["readonly"]) && !isset($contract_edit->AdvancePaymentdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractedit", "x_AdvancePaymentdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_edit->AdvancePaymentdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_edit->ContractStatus->Visible) { // ContractStatus ?>
	<div id="r_ContractStatus" class="form-group row">
		<label id="elh_contract_ContractStatus" for="x_ContractStatus" class="<?php echo $contract_edit->LeftColumnClass ?>"><?php echo $contract_edit->ContractStatus->caption() ?><?php echo $contract_edit->ContractStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_edit->RightColumnClass ?>"><div <?php echo $contract_edit->ContractStatus->cellAttributes() ?>>
<span id="el_contract_ContractStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_ContractStatus" data-value-separator="<?php echo $contract_edit->ContractStatus->displayValueSeparatorAttribute() ?>" id="x_ContractStatus" name="x_ContractStatus"<?php echo $contract_edit->ContractStatus->editAttributes() ?>>
			<?php echo $contract_edit->ContractStatus->selectOptionListHtml("x_ContractStatus") ?>
		</select>
</div>
<?php echo $contract_edit->ContractStatus->Lookup->getParamTag($contract_edit, "p_x_ContractStatus") ?>
</span>
<?php echo $contract_edit->ContractStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($contract->getCurrentDetailTable() != "") { ?>
<?php
	$contract_edit->DetailPages->ValidKeys = explode(",", $contract->getCurrentDetailTable());
	$firstActiveDetailTable = $contract_edit->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="contract_edit_details"><!-- tabs -->
	<ul class="<?php echo $contract_edit->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("contract_variation", explode(",", $contract->getCurrentDetailTable())) && $contract_variation->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "contract_variation") {
			$firstActiveDetailTable = "contract_variation";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $contract_edit->DetailPages->pageStyle("contract_variation") ?>" href="#tab_contract_variation" data-toggle="tab"><?php echo $Language->tablePhrase("contract_variation", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("ipc_tracking", explode(",", $contract->getCurrentDetailTable())) && $ipc_tracking->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "ipc_tracking") {
			$firstActiveDetailTable = "ipc_tracking";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $contract_edit->DetailPages->pageStyle("ipc_tracking") ?>" href="#tab_ipc_tracking" data-toggle="tab"><?php echo $Language->tablePhrase("ipc_tracking", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("contract_variation", explode(",", $contract->getCurrentDetailTable())) && $contract_variation->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "contract_variation")
			$firstActiveDetailTable = "contract_variation";
?>
		<div class="tab-pane <?php echo $contract_edit->DetailPages->pageStyle("contract_variation") ?>" id="tab_contract_variation"><!-- page* -->
<?php include_once "contract_variationgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("ipc_tracking", explode(",", $contract->getCurrentDetailTable())) && $ipc_tracking->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "ipc_tracking")
			$firstActiveDetailTable = "ipc_tracking";
?>
		<div class="tab-pane <?php echo $contract_edit->DetailPages->pageStyle("ipc_tracking") ?>" id="tab_ipc_tracking"><!-- page* -->
<?php include_once "ipc_trackinggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$contract_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$contract_edit->IsModal) { ?>
<?php echo $contract_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$contract_edit->showPageFooter();
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
$contract_edit->terminate();
?>