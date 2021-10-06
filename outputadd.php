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
$output_add = new output_add();

// Run the page
$output_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutputadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	foutputadd = currentForm = new ew.Form("foutputadd", "add");

	// Validate form
	foutputadd.validate = function() {
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
			<?php if ($output_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->LACode->caption(), $output_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->DepartmentCode->caption(), $output_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->SectionCode->caption(), $output_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->OutcomeCode->caption(), $output_add->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->ProgramCode->caption(), $output_add->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_add->ProgramCode->errorMessage()) ?>");
			<?php if ($output_add->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->SubProgramCode->caption(), $output_add->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->OutputType->caption(), $output_add->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->OutputName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->OutputName->caption(), $output_add->OutputName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->DeliveryDate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->DeliveryDate->caption(), $output_add->DeliveryDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_add->DeliveryDate->errorMessage()) ?>");
			<?php if ($output_add->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->FinancialYear->caption(), $output_add->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_add->FinancialYear->errorMessage()) ?>");
			<?php if ($output_add->OutputDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->OutputDescription->caption(), $output_add->OutputDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->OutputMeansOfVerification->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputMeansOfVerification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->OutputMeansOfVerification->caption(), $output_add->OutputMeansOfVerification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->ResponsibleOfficer->caption(), $output_add->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->Clients->Required) { ?>
				elm = this.getElements("x" + infix + "_Clients");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->Clients->caption(), $output_add->Clients->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->Beneficiaries->Required) { ?>
				elm = this.getElements("x" + infix + "_Beneficiaries");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->Beneficiaries->caption(), $output_add->Beneficiaries->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->OutputStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->OutputStatus->caption(), $output_add->OutputStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_add->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->TargetAmount->caption(), $output_add->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_add->TargetAmount->errorMessage()) ?>");
			<?php if ($output_add->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->ActualAmount->caption(), $output_add->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_add->ActualAmount->errorMessage()) ?>");
			<?php if ($output_add->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_add->PercentAchieved->caption(), $output_add->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_add->PercentAchieved->errorMessage()) ?>");

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
	foutputadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutputadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutputadd.lists["x_LACode"] = <?php echo $output_add->LACode->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_LACode"].options = <?php echo JsonEncode($output_add->LACode->lookupOptions()) ?>;
	foutputadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputadd.lists["x_DepartmentCode"] = <?php echo $output_add->DepartmentCode->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_add->DepartmentCode->lookupOptions()) ?>;
	foutputadd.lists["x_SectionCode"] = <?php echo $output_add->SectionCode->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_SectionCode"].options = <?php echo JsonEncode($output_add->SectionCode->lookupOptions()) ?>;
	foutputadd.lists["x_OutcomeCode"] = <?php echo $output_add->OutcomeCode->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_add->OutcomeCode->lookupOptions()) ?>;
	foutputadd.lists["x_ProgramCode"] = <?php echo $output_add->ProgramCode->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_add->ProgramCode->lookupOptions()) ?>;
	foutputadd.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputadd.lists["x_SubProgramCode"] = <?php echo $output_add->SubProgramCode->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_add->SubProgramCode->lookupOptions()) ?>;
	foutputadd.lists["x_OutputType"] = <?php echo $output_add->OutputType->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_OutputType"].options = <?php echo JsonEncode($output_add->OutputType->lookupOptions()) ?>;
	foutputadd.lists["x_OutputStatus"] = <?php echo $output_add->OutputStatus->Lookup->toClientList($output_add) ?>;
	foutputadd.lists["x_OutputStatus"].options = <?php echo JsonEncode($output_add->OutputStatus->lookupOptions()) ?>;
	loadjs.done("foutputadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_add->showPageHeader(); ?>
<?php
$output_add->showMessage();
?>
<form name="foutputadd" id="foutputadd" class="<?php echo $output_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$output_add->IsModal ?>">
<?php if ($output->getCurrentMasterTable() == "outcome") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="outcome">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($output_add->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($output_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($output_add->DepartmentCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($output_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_output_LACode" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->LACode->caption() ?><?php echo $output_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->LACode->cellAttributes() ?>>
<?php if ($output_add->LACode->getSessionValue() != "") { ?>
<span id="el_output_LACode">
<span<?php echo $output_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($output_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_output_LACode">
<?php
$onchange = $output_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($output_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_add->LACode->getPlaceHolder()) ?>"<?php echo $output_add->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_add->LACode->ReadOnly || $output_add->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($output_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputadd"], function() {
	foutputadd.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $output_add->LACode->Lookup->getParamTag($output_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $output_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_output_DepartmentCode" for="x_DepartmentCode" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->DepartmentCode->caption() ?><?php echo $output_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->DepartmentCode->cellAttributes() ?>>
<?php if ($output_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_output_DepartmentCode">
<span<?php echo $output_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($output_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_output_DepartmentCode">
<?php $output_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($output_add->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_add->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_add->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_add->DepartmentCode->ReadOnly || $output_add->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_add->DepartmentCode->Lookup->getParamTag($output_add, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $output_add->DepartmentCode->CurrentValue ?>"<?php echo $output_add->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $output_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_output_SectionCode" for="x_SectionCode" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->SectionCode->caption() ?><?php echo $output_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->SectionCode->cellAttributes() ?>>
<span id="el_output_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($output_add->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_add->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_add->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_add->SectionCode->ReadOnly || $output_add->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_add->SectionCode->Lookup->getParamTag($output_add, "p_x_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_add->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $output_add->SectionCode->CurrentValue ?>"<?php echo $output_add->SectionCode->editAttributes() ?>>
</span>
<?php echo $output_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_output_OutcomeCode" for="x_OutcomeCode" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->OutcomeCode->caption() ?><?php echo $output_add->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->OutcomeCode->cellAttributes() ?>>
<?php if ($output_add->OutcomeCode->getSessionValue() != "") { ?>
<span id="el_output_OutcomeCode">
<span<?php echo $output_add->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_add->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutcomeCode" name="x_OutcomeCode" value="<?php echo HtmlEncode($output_add->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_output_OutcomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($output_add->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_add->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_add->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_add->OutcomeCode->ReadOnly || $output_add->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_add->OutcomeCode->Lookup->getParamTag($output_add, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_add->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $output_add->OutcomeCode->CurrentValue ?>"<?php echo $output_add->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $output_add->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_output_ProgramCode" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->ProgramCode->caption() ?><?php echo $output_add->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->ProgramCode->cellAttributes() ?>>
<span id="el_output_ProgramCode">
<?php
$onchange = $output_add->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_add->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($output_add->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_add->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_add->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_add->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_add->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_add->ProgramCode->ReadOnly || $output_add->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_add->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($output_add->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputadd"], function() {
	foutputadd.createAutoSuggest({"id":"x_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_add->ProgramCode->Lookup->getParamTag($output_add, "p_x_ProgramCode") ?>
</span>
<?php echo $output_add->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_output_SubProgramCode" for="x_SubProgramCode" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->SubProgramCode->caption() ?><?php echo $output_add->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->SubProgramCode->cellAttributes() ?>>
<span id="el_output_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($output_add->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_add->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_add->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_add->SubProgramCode->ReadOnly || $output_add->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_add->SubProgramCode->Lookup->getParamTag($output_add, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_add->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $output_add->SubProgramCode->CurrentValue ?>"<?php echo $output_add->SubProgramCode->editAttributes() ?>>
</span>
<?php echo $output_add->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->OutputType->Visible) { // OutputType ?>
	<div id="r_OutputType" class="form-group row">
		<label id="elh_output_OutputType" for="x_OutputType" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->OutputType->caption() ?><?php echo $output_add->OutputType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->OutputType->cellAttributes() ?>>
<span id="el_output_OutputType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_add->OutputType->displayValueSeparatorAttribute() ?>" id="x_OutputType" name="x_OutputType"<?php echo $output_add->OutputType->editAttributes() ?>>
			<?php echo $output_add->OutputType->selectOptionListHtml("x_OutputType") ?>
		</select>
</div>
<?php echo $output_add->OutputType->Lookup->getParamTag($output_add, "p_x_OutputType") ?>
</span>
<?php echo $output_add->OutputType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->OutputName->Visible) { // OutputName ?>
	<div id="r_OutputName" class="form-group row">
		<label id="elh_output_OutputName" for="x_OutputName" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->OutputName->caption() ?><?php echo $output_add->OutputName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->OutputName->cellAttributes() ?>>
<span id="el_output_OutputName">
<textarea data-table="output" data-field="x_OutputName" name="x_OutputName" id="x_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_add->OutputName->getPlaceHolder()) ?>"<?php echo $output_add->OutputName->editAttributes() ?>><?php echo $output_add->OutputName->EditValue ?></textarea>
</span>
<?php echo $output_add->OutputName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->DeliveryDate->Visible) { // DeliveryDate ?>
	<div id="r_DeliveryDate" class="form-group row">
		<label id="elh_output_DeliveryDate" for="x_DeliveryDate" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->DeliveryDate->caption() ?><?php echo $output_add->DeliveryDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->DeliveryDate->cellAttributes() ?>>
<span id="el_output_DeliveryDate">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x_DeliveryDate" id="x_DeliveryDate" placeholder="<?php echo HtmlEncode($output_add->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_add->DeliveryDate->EditValue ?>"<?php echo $output_add->DeliveryDate->editAttributes() ?>>
<?php if (!$output_add->DeliveryDate->ReadOnly && !$output_add->DeliveryDate->Disabled && !isset($output_add->DeliveryDate->EditAttrs["readonly"]) && !isset($output_add->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputadd", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputadd", "x_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $output_add->DeliveryDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_output_FinancialYear" for="x_FinancialYear" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->FinancialYear->caption() ?><?php echo $output_add->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->FinancialYear->cellAttributes() ?>>
<span id="el_output_FinancialYear">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_add->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_add->FinancialYear->EditValue ?>"<?php echo $output_add->FinancialYear->editAttributes() ?>>
</span>
<?php echo $output_add->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->OutputDescription->Visible) { // OutputDescription ?>
	<div id="r_OutputDescription" class="form-group row">
		<label id="elh_output_OutputDescription" for="x_OutputDescription" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->OutputDescription->caption() ?><?php echo $output_add->OutputDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->OutputDescription->cellAttributes() ?>>
<span id="el_output_OutputDescription">
<textarea data-table="output" data-field="x_OutputDescription" name="x_OutputDescription" id="x_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_add->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_add->OutputDescription->editAttributes() ?>><?php echo $output_add->OutputDescription->EditValue ?></textarea>
</span>
<?php echo $output_add->OutputDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
	<div id="r_OutputMeansOfVerification" class="form-group row">
		<label id="elh_output_OutputMeansOfVerification" for="x_OutputMeansOfVerification" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->OutputMeansOfVerification->caption() ?><?php echo $output_add->OutputMeansOfVerification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->OutputMeansOfVerification->cellAttributes() ?>>
<span id="el_output_OutputMeansOfVerification">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x_OutputMeansOfVerification" id="x_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_add->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_add->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_add->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<?php echo $output_add->OutputMeansOfVerification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<div id="r_ResponsibleOfficer" class="form-group row">
		<label id="elh_output_ResponsibleOfficer" for="x_ResponsibleOfficer" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->ResponsibleOfficer->caption() ?><?php echo $output_add->ResponsibleOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_output_ResponsibleOfficer">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x_ResponsibleOfficer" id="x_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_add->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_add->ResponsibleOfficer->EditValue ?>"<?php echo $output_add->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php echo $output_add->ResponsibleOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->Clients->Visible) { // Clients ?>
	<div id="r_Clients" class="form-group row">
		<label id="elh_output_Clients" for="x_Clients" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->Clients->caption() ?><?php echo $output_add->Clients->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->Clients->cellAttributes() ?>>
<span id="el_output_Clients">
<textarea data-table="output" data-field="x_Clients" name="x_Clients" id="x_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_add->Clients->getPlaceHolder()) ?>"<?php echo $output_add->Clients->editAttributes() ?>><?php echo $output_add->Clients->EditValue ?></textarea>
</span>
<?php echo $output_add->Clients->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->Beneficiaries->Visible) { // Beneficiaries ?>
	<div id="r_Beneficiaries" class="form-group row">
		<label id="elh_output_Beneficiaries" for="x_Beneficiaries" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->Beneficiaries->caption() ?><?php echo $output_add->Beneficiaries->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->Beneficiaries->cellAttributes() ?>>
<span id="el_output_Beneficiaries">
<textarea data-table="output" data-field="x_Beneficiaries" name="x_Beneficiaries" id="x_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_add->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_add->Beneficiaries->editAttributes() ?>><?php echo $output_add->Beneficiaries->EditValue ?></textarea>
</span>
<?php echo $output_add->Beneficiaries->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->OutputStatus->Visible) { // OutputStatus ?>
	<div id="r_OutputStatus" class="form-group row">
		<label id="elh_output_OutputStatus" for="x_OutputStatus" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->OutputStatus->caption() ?><?php echo $output_add->OutputStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->OutputStatus->cellAttributes() ?>>
<span id="el_output_OutputStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_add->OutputStatus->displayValueSeparatorAttribute() ?>" id="x_OutputStatus" name="x_OutputStatus"<?php echo $output_add->OutputStatus->editAttributes() ?>>
			<?php echo $output_add->OutputStatus->selectOptionListHtml("x_OutputStatus") ?>
		</select>
</div>
<?php echo $output_add->OutputStatus->Lookup->getParamTag($output_add, "p_x_OutputStatus") ?>
</span>
<?php echo $output_add->OutputStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->TargetAmount->Visible) { // TargetAmount ?>
	<div id="r_TargetAmount" class="form-group row">
		<label id="elh_output_TargetAmount" for="x_TargetAmount" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->TargetAmount->caption() ?><?php echo $output_add->TargetAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->TargetAmount->cellAttributes() ?>>
<span id="el_output_TargetAmount">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x_TargetAmount" id="x_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_add->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_add->TargetAmount->EditValue ?>"<?php echo $output_add->TargetAmount->editAttributes() ?>>
</span>
<?php echo $output_add->TargetAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_output_ActualAmount" for="x_ActualAmount" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->ActualAmount->caption() ?><?php echo $output_add->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->ActualAmount->cellAttributes() ?>>
<span id="el_output_ActualAmount">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_add->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_add->ActualAmount->EditValue ?>"<?php echo $output_add->ActualAmount->editAttributes() ?>>
</span>
<?php echo $output_add->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_add->PercentAchieved->Visible) { // PercentAchieved ?>
	<div id="r_PercentAchieved" class="form-group row">
		<label id="elh_output_PercentAchieved" for="x_PercentAchieved" class="<?php echo $output_add->LeftColumnClass ?>"><?php echo $output_add->PercentAchieved->caption() ?><?php echo $output_add->PercentAchieved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_add->RightColumnClass ?>"><div <?php echo $output_add->PercentAchieved->cellAttributes() ?>>
<span id="el_output_PercentAchieved">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x_PercentAchieved" id="x_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_add->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_add->PercentAchieved->EditValue ?>"<?php echo $output_add->PercentAchieved->editAttributes() ?>>
</span>
<?php echo $output_add->PercentAchieved->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("_action", explode(",", $output->getCurrentDetailTable())) && $_action->DetailAdd) {
?>
<?php if ($output->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "_actiongrid.php" ?>
<?php } ?>
<?php if (!$output_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $output_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $output_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$output_add->showPageFooter();
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
$output_add->terminate();
?>