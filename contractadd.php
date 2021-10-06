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
$contract_add = new contract_add();

// Run the page
$contract_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcontractadd = currentForm = new ew.Form("fcontractadd", "add");

	// Validate form
	fcontractadd.validate = function() {
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
			<?php if ($contract_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->LACode->caption(), $contract_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->DepartmentCode->caption(), $contract_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->SectionCode->caption(), $contract_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ProjectCode->caption(), $contract_add->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ContractNo->caption(), $contract_add->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->ContractName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ContractName->caption(), $contract_add->ContractName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->ContractType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ContractType->caption(), $contract_add->ContractType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->ContractSum->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractSum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ContractSum->caption(), $contract_add->ContractSum->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractSum");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->ContractSum->errorMessage()) ?>");
			<?php if ($contract_add->RevisedContractSum->Required) { ?>
				elm = this.getElements("x" + infix + "_RevisedContractSum");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->RevisedContractSum->caption(), $contract_add->RevisedContractSum->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RevisedContractSum");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->RevisedContractSum->errorMessage()) ?>");
			<?php if ($contract_add->ContractorRef->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ContractorRef->caption(), $contract_add->ContractorRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->SigningDate->Required) { ?>
				elm = this.getElements("x" + infix + "_SigningDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->SigningDate->caption(), $contract_add->SigningDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SigningDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->SigningDate->errorMessage()) ?>");
			<?php if ($contract_add->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->PlannedStartDate->caption(), $contract_add->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->PlannedStartDate->errorMessage()) ?>");
			<?php if ($contract_add->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->PlannedEndDate->caption(), $contract_add->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->PlannedEndDate->errorMessage()) ?>");
			<?php if ($contract_add->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ActualStartDate->caption(), $contract_add->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->ActualStartDate->errorMessage()) ?>");
			<?php if ($contract_add->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ActualEndDate->caption(), $contract_add->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->ActualEndDate->errorMessage()) ?>");
			<?php if ($contract_add->Duration->Required) { ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->Duration->caption(), $contract_add->Duration->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Duration");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->Duration->errorMessage()) ?>");
			<?php if ($contract_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->UnitOfMeasure->caption(), $contract_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contract_add->AdvancePaymentAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->AdvancePaymentAmount->caption(), $contract_add->AdvancePaymentAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->AdvancePaymentAmount->errorMessage()) ?>");
			<?php if ($contract_add->AdvancePaymentdate->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentdate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->AdvancePaymentdate->caption(), $contract_add->AdvancePaymentdate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentdate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_add->AdvancePaymentdate->errorMessage()) ?>");
			<?php if ($contract_add->ContractStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_add->ContractStatus->caption(), $contract_add->ContractStatus->RequiredErrorMessage)) ?>");
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
	fcontractadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcontractadd.lists["x_LACode"] = <?php echo $contract_add->LACode->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_LACode"].options = <?php echo JsonEncode($contract_add->LACode->lookupOptions()) ?>;
	fcontractadd.lists["x_DepartmentCode"] = <?php echo $contract_add->DepartmentCode->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($contract_add->DepartmentCode->lookupOptions()) ?>;
	fcontractadd.lists["x_SectionCode"] = <?php echo $contract_add->SectionCode->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_SectionCode"].options = <?php echo JsonEncode($contract_add->SectionCode->lookupOptions()) ?>;
	fcontractadd.lists["x_ProjectCode"] = <?php echo $contract_add->ProjectCode->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_ProjectCode"].options = <?php echo JsonEncode($contract_add->ProjectCode->lookupOptions()) ?>;
	fcontractadd.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcontractadd.lists["x_ContractType"] = <?php echo $contract_add->ContractType->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_ContractType"].options = <?php echo JsonEncode($contract_add->ContractType->lookupOptions()) ?>;
	fcontractadd.lists["x_ContractorRef"] = <?php echo $contract_add->ContractorRef->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_ContractorRef"].options = <?php echo JsonEncode($contract_add->ContractorRef->lookupOptions()) ?>;
	fcontractadd.lists["x_UnitOfMeasure"] = <?php echo $contract_add->UnitOfMeasure->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($contract_add->UnitOfMeasure->lookupOptions()) ?>;
	fcontractadd.lists["x_ContractStatus"] = <?php echo $contract_add->ContractStatus->Lookup->toClientList($contract_add) ?>;
	fcontractadd.lists["x_ContractStatus"].options = <?php echo JsonEncode($contract_add->ContractStatus->lookupOptions()) ?>;
	loadjs.done("fcontractadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_add->showPageHeader(); ?>
<?php
$contract_add->showMessage();
?>
<form name="fcontractadd" id="fcontractadd" class="<?php echo $contract_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contract_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contract_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_contract_LACode" for="x_LACode" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->LACode->caption() ?><?php echo $contract_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->LACode->cellAttributes() ?>>
<span id="el_contract_LACode">
<?php $contract_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($contract_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_add->LACode->ReadOnly || $contract_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_add->LACode->Lookup->getParamTag($contract_add, "p_x_LACode") ?>
<input type="hidden" data-table="contract" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $contract_add->LACode->CurrentValue ?>"<?php echo $contract_add->LACode->editAttributes() ?>>
</span>
<?php echo $contract_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_contract_DepartmentCode" for="x_DepartmentCode" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->DepartmentCode->caption() ?><?php echo $contract_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->DepartmentCode->cellAttributes() ?>>
<span id="el_contract_DepartmentCode">
<?php $contract_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($contract_add->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_add->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_add->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_add->DepartmentCode->ReadOnly || $contract_add->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_add->DepartmentCode->Lookup->getParamTag($contract_add, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="contract" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $contract_add->DepartmentCode->CurrentValue ?>"<?php echo $contract_add->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $contract_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_contract_SectionCode" for="x_SectionCode" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->SectionCode->caption() ?><?php echo $contract_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->SectionCode->cellAttributes() ?>>
<span id="el_contract_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_SectionCode" data-value-separator="<?php echo $contract_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $contract_add->SectionCode->editAttributes() ?>>
			<?php echo $contract_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $contract_add->SectionCode->Lookup->getParamTag($contract_add, "p_x_SectionCode") ?>
</span>
<?php echo $contract_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh_contract_ProjectCode" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ProjectCode->caption() ?><?php echo $contract_add->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ProjectCode->cellAttributes() ?>>
<span id="el_contract_ProjectCode">
<?php
$onchange = $contract_add->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$contract_add->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProjectCode" id="sv_x_ProjectCode" value="<?php echo RemoveHtml($contract_add->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($contract_add->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($contract_add->ProjectCode->getPlaceHolder()) ?>"<?php echo $contract_add->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_add->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($contract_add->ProjectCode->ReadOnly || $contract_add->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="contract" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_add->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo HtmlEncode($contract_add->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcontractadd"], function() {
	fcontractadd.createAutoSuggest({"id":"x_ProjectCode","forceSelect":false});
});
</script>
<?php echo $contract_add->ProjectCode->Lookup->getParamTag($contract_add, "p_x_ProjectCode") ?>
</span>
<?php echo $contract_add->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label id="elh_contract_ContractNo" for="x_ContractNo" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ContractNo->caption() ?><?php echo $contract_add->ContractNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ContractNo->cellAttributes() ?>>
<span id="el_contract_ContractNo">
<input type="text" data-table="contract" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($contract_add->ContractNo->getPlaceHolder()) ?>" value="<?php echo $contract_add->ContractNo->EditValue ?>"<?php echo $contract_add->ContractNo->editAttributes() ?>>
</span>
<?php echo $contract_add->ContractNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ContractName->Visible) { // ContractName ?>
	<div id="r_ContractName" class="form-group row">
		<label id="elh_contract_ContractName" for="x_ContractName" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ContractName->caption() ?><?php echo $contract_add->ContractName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ContractName->cellAttributes() ?>>
<span id="el_contract_ContractName">
<input type="text" data-table="contract" data-field="x_ContractName" name="x_ContractName" id="x_ContractName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_add->ContractName->getPlaceHolder()) ?>" value="<?php echo $contract_add->ContractName->EditValue ?>"<?php echo $contract_add->ContractName->editAttributes() ?>>
</span>
<?php echo $contract_add->ContractName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ContractType->Visible) { // ContractType ?>
	<div id="r_ContractType" class="form-group row">
		<label id="elh_contract_ContractType" for="x_ContractType" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ContractType->caption() ?><?php echo $contract_add->ContractType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ContractType->cellAttributes() ?>>
<span id="el_contract_ContractType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_ContractType" data-value-separator="<?php echo $contract_add->ContractType->displayValueSeparatorAttribute() ?>" id="x_ContractType" name="x_ContractType"<?php echo $contract_add->ContractType->editAttributes() ?>>
			<?php echo $contract_add->ContractType->selectOptionListHtml("x_ContractType") ?>
		</select>
</div>
<?php echo $contract_add->ContractType->Lookup->getParamTag($contract_add, "p_x_ContractType") ?>
</span>
<?php echo $contract_add->ContractType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ContractSum->Visible) { // ContractSum ?>
	<div id="r_ContractSum" class="form-group row">
		<label id="elh_contract_ContractSum" for="x_ContractSum" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ContractSum->caption() ?><?php echo $contract_add->ContractSum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ContractSum->cellAttributes() ?>>
<span id="el_contract_ContractSum">
<input type="text" data-table="contract" data-field="x_ContractSum" name="x_ContractSum" id="x_ContractSum" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_add->ContractSum->getPlaceHolder()) ?>" value="<?php echo $contract_add->ContractSum->EditValue ?>"<?php echo $contract_add->ContractSum->editAttributes() ?>>
</span>
<?php echo $contract_add->ContractSum->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->RevisedContractSum->Visible) { // RevisedContractSum ?>
	<div id="r_RevisedContractSum" class="form-group row">
		<label id="elh_contract_RevisedContractSum" for="x_RevisedContractSum" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->RevisedContractSum->caption() ?><?php echo $contract_add->RevisedContractSum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->RevisedContractSum->cellAttributes() ?>>
<span id="el_contract_RevisedContractSum">
<input type="text" data-table="contract" data-field="x_RevisedContractSum" name="x_RevisedContractSum" id="x_RevisedContractSum" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_add->RevisedContractSum->getPlaceHolder()) ?>" value="<?php echo $contract_add->RevisedContractSum->EditValue ?>"<?php echo $contract_add->RevisedContractSum->editAttributes() ?>>
</span>
<?php echo $contract_add->RevisedContractSum->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ContractorRef->Visible) { // ContractorRef ?>
	<div id="r_ContractorRef" class="form-group row">
		<label id="elh_contract_ContractorRef" for="x_ContractorRef" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ContractorRef->caption() ?><?php echo $contract_add->ContractorRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ContractorRef->cellAttributes() ?>>
<span id="el_contract_ContractorRef">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ContractorRef"><?php echo EmptyValue(strval($contract_add->ContractorRef->ViewValue)) ? $Language->phrase("PleaseSelect") : $contract_add->ContractorRef->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($contract_add->ContractorRef->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($contract_add->ContractorRef->ReadOnly || $contract_add->ContractorRef->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ContractorRef',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $contract_add->ContractorRef->Lookup->getParamTag($contract_add, "p_x_ContractorRef") ?>
<input type="hidden" data-table="contract" data-field="x_ContractorRef" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $contract_add->ContractorRef->displayValueSeparatorAttribute() ?>" name="x_ContractorRef" id="x_ContractorRef" value="<?php echo $contract_add->ContractorRef->CurrentValue ?>"<?php echo $contract_add->ContractorRef->editAttributes() ?>>
</span>
<?php echo $contract_add->ContractorRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->SigningDate->Visible) { // SigningDate ?>
	<div id="r_SigningDate" class="form-group row">
		<label id="elh_contract_SigningDate" for="x_SigningDate" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->SigningDate->caption() ?><?php echo $contract_add->SigningDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->SigningDate->cellAttributes() ?>>
<span id="el_contract_SigningDate">
<input type="text" data-table="contract" data-field="x_SigningDate" name="x_SigningDate" id="x_SigningDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_add->SigningDate->getPlaceHolder()) ?>" value="<?php echo $contract_add->SigningDate->EditValue ?>"<?php echo $contract_add->SigningDate->editAttributes() ?>>
<?php if (!$contract_add->SigningDate->ReadOnly && !$contract_add->SigningDate->Disabled && !isset($contract_add->SigningDate->EditAttrs["readonly"]) && !isset($contract_add->SigningDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractadd", "x_SigningDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_add->SigningDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_contract_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->PlannedStartDate->caption() ?><?php echo $contract_add->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->PlannedStartDate->cellAttributes() ?>>
<span id="el_contract_PlannedStartDate">
<input type="text" data-table="contract" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_add->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $contract_add->PlannedStartDate->EditValue ?>"<?php echo $contract_add->PlannedStartDate->editAttributes() ?>>
<?php if (!$contract_add->PlannedStartDate->ReadOnly && !$contract_add->PlannedStartDate->Disabled && !isset($contract_add->PlannedStartDate->EditAttrs["readonly"]) && !isset($contract_add->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractadd", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_add->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_contract_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->PlannedEndDate->caption() ?><?php echo $contract_add->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->PlannedEndDate->cellAttributes() ?>>
<span id="el_contract_PlannedEndDate">
<input type="text" data-table="contract" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_add->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $contract_add->PlannedEndDate->EditValue ?>"<?php echo $contract_add->PlannedEndDate->editAttributes() ?>>
<?php if (!$contract_add->PlannedEndDate->ReadOnly && !$contract_add->PlannedEndDate->Disabled && !isset($contract_add->PlannedEndDate->EditAttrs["readonly"]) && !isset($contract_add->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractadd", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_add->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_contract_ActualStartDate" for="x_ActualStartDate" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ActualStartDate->caption() ?><?php echo $contract_add->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ActualStartDate->cellAttributes() ?>>
<span id="el_contract_ActualStartDate">
<input type="text" data-table="contract" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_add->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $contract_add->ActualStartDate->EditValue ?>"<?php echo $contract_add->ActualStartDate->editAttributes() ?>>
<?php if (!$contract_add->ActualStartDate->ReadOnly && !$contract_add->ActualStartDate->Disabled && !isset($contract_add->ActualStartDate->EditAttrs["readonly"]) && !isset($contract_add->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractadd", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_add->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label id="elh_contract_ActualEndDate" for="x_ActualEndDate" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ActualEndDate->caption() ?><?php echo $contract_add->ActualEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ActualEndDate->cellAttributes() ?>>
<span id="el_contract_ActualEndDate">
<input type="text" data-table="contract" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_add->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $contract_add->ActualEndDate->EditValue ?>"<?php echo $contract_add->ActualEndDate->editAttributes() ?>>
<?php if (!$contract_add->ActualEndDate->ReadOnly && !$contract_add->ActualEndDate->Disabled && !isset($contract_add->ActualEndDate->EditAttrs["readonly"]) && !isset($contract_add->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractadd", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_add->ActualEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->Duration->Visible) { // Duration ?>
	<div id="r_Duration" class="form-group row">
		<label id="elh_contract_Duration" for="x_Duration" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->Duration->caption() ?><?php echo $contract_add->Duration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->Duration->cellAttributes() ?>>
<span id="el_contract_Duration">
<input type="text" data-table="contract" data-field="x_Duration" name="x_Duration" id="x_Duration" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_add->Duration->getPlaceHolder()) ?>" value="<?php echo $contract_add->Duration->EditValue ?>"<?php echo $contract_add->Duration->editAttributes() ?>>
</span>
<?php echo $contract_add->Duration->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_contract_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->UnitOfMeasure->caption() ?><?php echo $contract_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->UnitOfMeasure->cellAttributes() ?>>
<span id="el_contract_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $contract_add->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $contract_add->UnitOfMeasure->editAttributes() ?>>
			<?php echo $contract_add->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $contract_add->UnitOfMeasure->Lookup->getParamTag($contract_add, "p_x_UnitOfMeasure") ?>
</span>
<?php echo $contract_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
	<div id="r_AdvancePaymentAmount" class="form-group row">
		<label id="elh_contract_AdvancePaymentAmount" for="x_AdvancePaymentAmount" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->AdvancePaymentAmount->caption() ?><?php echo $contract_add->AdvancePaymentAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->AdvancePaymentAmount->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentAmount">
<input type="text" data-table="contract" data-field="x_AdvancePaymentAmount" name="x_AdvancePaymentAmount" id="x_AdvancePaymentAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($contract_add->AdvancePaymentAmount->getPlaceHolder()) ?>" value="<?php echo $contract_add->AdvancePaymentAmount->EditValue ?>"<?php echo $contract_add->AdvancePaymentAmount->editAttributes() ?>>
</span>
<?php echo $contract_add->AdvancePaymentAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
	<div id="r_AdvancePaymentdate" class="form-group row">
		<label id="elh_contract_AdvancePaymentdate" for="x_AdvancePaymentdate" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->AdvancePaymentdate->caption() ?><?php echo $contract_add->AdvancePaymentdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->AdvancePaymentdate->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentdate">
<input type="text" data-table="contract" data-field="x_AdvancePaymentdate" name="x_AdvancePaymentdate" id="x_AdvancePaymentdate" maxlength="10" placeholder="<?php echo HtmlEncode($contract_add->AdvancePaymentdate->getPlaceHolder()) ?>" value="<?php echo $contract_add->AdvancePaymentdate->EditValue ?>"<?php echo $contract_add->AdvancePaymentdate->editAttributes() ?>>
<?php if (!$contract_add->AdvancePaymentdate->ReadOnly && !$contract_add->AdvancePaymentdate->Disabled && !isset($contract_add->AdvancePaymentdate->EditAttrs["readonly"]) && !isset($contract_add->AdvancePaymentdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcontractadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcontractadd", "x_AdvancePaymentdate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $contract_add->AdvancePaymentdate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_add->ContractStatus->Visible) { // ContractStatus ?>
	<div id="r_ContractStatus" class="form-group row">
		<label id="elh_contract_ContractStatus" for="x_ContractStatus" class="<?php echo $contract_add->LeftColumnClass ?>"><?php echo $contract_add->ContractStatus->caption() ?><?php echo $contract_add->ContractStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_add->RightColumnClass ?>"><div <?php echo $contract_add->ContractStatus->cellAttributes() ?>>
<span id="el_contract_ContractStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="contract" data-field="x_ContractStatus" data-value-separator="<?php echo $contract_add->ContractStatus->displayValueSeparatorAttribute() ?>" id="x_ContractStatus" name="x_ContractStatus"<?php echo $contract_add->ContractStatus->editAttributes() ?>>
			<?php echo $contract_add->ContractStatus->selectOptionListHtml("x_ContractStatus") ?>
		</select>
</div>
<?php echo $contract_add->ContractStatus->Lookup->getParamTag($contract_add, "p_x_ContractStatus") ?>
</span>
<?php echo $contract_add->ContractStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($contract->getCurrentDetailTable() != "") { ?>
<?php
	$contract_add->DetailPages->ValidKeys = explode(",", $contract->getCurrentDetailTable());
	$firstActiveDetailTable = $contract_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="contract_add_details"><!-- tabs -->
	<ul class="<?php echo $contract_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("contract_variation", explode(",", $contract->getCurrentDetailTable())) && $contract_variation->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "contract_variation") {
			$firstActiveDetailTable = "contract_variation";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $contract_add->DetailPages->pageStyle("contract_variation") ?>" href="#tab_contract_variation" data-toggle="tab"><?php echo $Language->tablePhrase("contract_variation", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("ipc_tracking", explode(",", $contract->getCurrentDetailTable())) && $ipc_tracking->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "ipc_tracking") {
			$firstActiveDetailTable = "ipc_tracking";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $contract_add->DetailPages->pageStyle("ipc_tracking") ?>" href="#tab_ipc_tracking" data-toggle="tab"><?php echo $Language->tablePhrase("ipc_tracking", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("contract_variation", explode(",", $contract->getCurrentDetailTable())) && $contract_variation->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "contract_variation")
			$firstActiveDetailTable = "contract_variation";
?>
		<div class="tab-pane <?php echo $contract_add->DetailPages->pageStyle("contract_variation") ?>" id="tab_contract_variation"><!-- page* -->
<?php include_once "contract_variationgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("ipc_tracking", explode(",", $contract->getCurrentDetailTable())) && $ipc_tracking->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "ipc_tracking")
			$firstActiveDetailTable = "ipc_tracking";
?>
		<div class="tab-pane <?php echo $contract_add->DetailPages->pageStyle("ipc_tracking") ?>" id="tab_ipc_tracking"><!-- page* -->
<?php include_once "ipc_trackinggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$contract_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contract_add->showPageFooter();
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
$contract_add->terminate();
?>