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
$output_edit = new output_edit();

// Run the page
$output_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutputedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	foutputedit = currentForm = new ew.Form("foutputedit", "edit");

	// Validate form
	foutputedit.validate = function() {
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
			<?php if ($output_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->LACode->caption(), $output_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->DepartmentCode->caption(), $output_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->SectionCode->caption(), $output_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->OutcomeCode->caption(), $output_edit->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->ProgramCode->caption(), $output_edit->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_edit->ProgramCode->errorMessage()) ?>");
			<?php if ($output_edit->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->SubProgramCode->caption(), $output_edit->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->OutputCode->caption(), $output_edit->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->OutputType->caption(), $output_edit->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->OutputName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->OutputName->caption(), $output_edit->OutputName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->DeliveryDate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->DeliveryDate->caption(), $output_edit->DeliveryDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeliveryDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_edit->DeliveryDate->errorMessage()) ?>");
			<?php if ($output_edit->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->FinancialYear->caption(), $output_edit->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_edit->FinancialYear->errorMessage()) ?>");
			<?php if ($output_edit->OutputDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->OutputDescription->caption(), $output_edit->OutputDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->OutputMeansOfVerification->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputMeansOfVerification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->OutputMeansOfVerification->caption(), $output_edit->OutputMeansOfVerification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->ResponsibleOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponsibleOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->ResponsibleOfficer->caption(), $output_edit->ResponsibleOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->Clients->Required) { ?>
				elm = this.getElements("x" + infix + "_Clients");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->Clients->caption(), $output_edit->Clients->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->Beneficiaries->Required) { ?>
				elm = this.getElements("x" + infix + "_Beneficiaries");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->Beneficiaries->caption(), $output_edit->Beneficiaries->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->OutputStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->OutputStatus->caption(), $output_edit->OutputStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_edit->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->TargetAmount->caption(), $output_edit->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_edit->TargetAmount->errorMessage()) ?>");
			<?php if ($output_edit->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->ActualAmount->caption(), $output_edit->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_edit->ActualAmount->errorMessage()) ?>");
			<?php if ($output_edit->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_edit->PercentAchieved->caption(), $output_edit->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_edit->PercentAchieved->errorMessage()) ?>");

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
	foutputedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutputedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutputedit.lists["x_LACode"] = <?php echo $output_edit->LACode->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_LACode"].options = <?php echo JsonEncode($output_edit->LACode->lookupOptions()) ?>;
	foutputedit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputedit.lists["x_DepartmentCode"] = <?php echo $output_edit->DepartmentCode->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_edit->DepartmentCode->lookupOptions()) ?>;
	foutputedit.lists["x_SectionCode"] = <?php echo $output_edit->SectionCode->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_SectionCode"].options = <?php echo JsonEncode($output_edit->SectionCode->lookupOptions()) ?>;
	foutputedit.lists["x_OutcomeCode"] = <?php echo $output_edit->OutcomeCode->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_edit->OutcomeCode->lookupOptions()) ?>;
	foutputedit.lists["x_ProgramCode"] = <?php echo $output_edit->ProgramCode->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_edit->ProgramCode->lookupOptions()) ?>;
	foutputedit.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutputedit.lists["x_SubProgramCode"] = <?php echo $output_edit->SubProgramCode->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_edit->SubProgramCode->lookupOptions()) ?>;
	foutputedit.lists["x_OutputCode"] = <?php echo $output_edit->OutputCode->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_OutputCode"].options = <?php echo JsonEncode($output_edit->OutputCode->lookupOptions()) ?>;
	foutputedit.lists["x_OutputType"] = <?php echo $output_edit->OutputType->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_OutputType"].options = <?php echo JsonEncode($output_edit->OutputType->lookupOptions()) ?>;
	foutputedit.lists["x_OutputStatus"] = <?php echo $output_edit->OutputStatus->Lookup->toClientList($output_edit) ?>;
	foutputedit.lists["x_OutputStatus"].options = <?php echo JsonEncode($output_edit->OutputStatus->lookupOptions()) ?>;
	loadjs.done("foutputedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_edit->showPageHeader(); ?>
<?php
$output_edit->showMessage();
?>
<?php if (!$output_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="foutputedit" id="foutputedit" class="<?php echo $output_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$output_edit->IsModal ?>">
<?php if ($output->getCurrentMasterTable() == "outcome") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="outcome">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($output_edit->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($output_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($output_edit->DepartmentCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($output_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_output_LACode" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->LACode->caption() ?><?php echo $output_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->LACode->cellAttributes() ?>>
<?php if ($output_edit->LACode->getSessionValue() != "") { ?>
<span id="el_output_LACode">
<span<?php echo $output_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($output_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_output_LACode">
<?php
$onchange = $output_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($output_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_edit->LACode->getPlaceHolder()) ?>"<?php echo $output_edit->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_edit->LACode->ReadOnly || $output_edit->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($output_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputedit"], function() {
	foutputedit.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $output_edit->LACode->Lookup->getParamTag($output_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $output_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_output_DepartmentCode" for="x_DepartmentCode" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->DepartmentCode->caption() ?><?php echo $output_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($output_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_output_DepartmentCode">
<span<?php echo $output_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($output_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_output_DepartmentCode">
<?php $output_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($output_edit->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_edit->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_edit->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_edit->DepartmentCode->ReadOnly || $output_edit->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_edit->DepartmentCode->Lookup->getParamTag($output_edit, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="output" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $output_edit->DepartmentCode->CurrentValue ?>"<?php echo $output_edit->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $output_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_output_SectionCode" for="x_SectionCode" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->SectionCode->caption() ?><?php echo $output_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->SectionCode->cellAttributes() ?>>
<span id="el_output_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($output_edit->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_edit->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_edit->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_edit->SectionCode->ReadOnly || $output_edit->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_edit->SectionCode->Lookup->getParamTag($output_edit, "p_x_SectionCode") ?>
<input type="hidden" data-table="output" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_edit->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $output_edit->SectionCode->CurrentValue ?>"<?php echo $output_edit->SectionCode->editAttributes() ?>>
</span>
<?php echo $output_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_output_OutcomeCode" for="x_OutcomeCode" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->OutcomeCode->caption() ?><?php echo $output_edit->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->OutcomeCode->cellAttributes() ?>>
<?php if ($output_edit->OutcomeCode->getSessionValue() != "") { ?>
<span id="el_output_OutcomeCode">
<span<?php echo $output_edit->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_edit->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutcomeCode" name="x_OutcomeCode" value="<?php echo HtmlEncode($output_edit->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_output_OutcomeCode">
<?php $output_edit->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($output_edit->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_edit->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_edit->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_edit->OutcomeCode->ReadOnly || $output_edit->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_edit->OutcomeCode->Lookup->getParamTag($output_edit, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="output" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_edit->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $output_edit->OutcomeCode->CurrentValue ?>"<?php echo $output_edit->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $output_edit->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_output_ProgramCode" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->ProgramCode->caption() ?><?php echo $output_edit->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->ProgramCode->cellAttributes() ?>>
<span id="el_output_ProgramCode">
<?php
$onchange = $output_edit->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_edit->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($output_edit->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_edit->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_edit->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_edit->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_edit->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($output_edit->ProgramCode->ReadOnly || $output_edit->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="output" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_edit->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($output_edit->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutputedit"], function() {
	foutputedit.createAutoSuggest({"id":"x_ProgramCode","forceSelect":true});
});
</script>
<?php echo $output_edit->ProgramCode->Lookup->getParamTag($output_edit, "p_x_ProgramCode") ?>
</span>
<?php echo $output_edit->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_output_SubProgramCode" for="x_SubProgramCode" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->SubProgramCode->caption() ?><?php echo $output_edit->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->SubProgramCode->cellAttributes() ?>>
<span id="el_output_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($output_edit->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $output_edit->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($output_edit->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($output_edit->SubProgramCode->ReadOnly || $output_edit->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $output_edit->SubProgramCode->Lookup->getParamTag($output_edit, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="output" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $output_edit->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $output_edit->SubProgramCode->CurrentValue ?>"<?php echo $output_edit->SubProgramCode->editAttributes() ?>>
</span>
<?php echo $output_edit->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_output_OutputCode" for="x_OutputCode" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->OutputCode->caption() ?><?php echo $output_edit->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->OutputCode->cellAttributes() ?>>
<span id="el_output_OutputCode">
<span<?php echo $output_edit->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_edit->OutputCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="output" data-field="x_OutputCode" name="x_OutputCode" id="x_OutputCode" value="<?php echo HtmlEncode($output_edit->OutputCode->CurrentValue) ?>">
<?php echo $output_edit->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->OutputType->Visible) { // OutputType ?>
	<div id="r_OutputType" class="form-group row">
		<label id="elh_output_OutputType" for="x_OutputType" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->OutputType->caption() ?><?php echo $output_edit->OutputType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->OutputType->cellAttributes() ?>>
<span id="el_output_OutputType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputType" data-value-separator="<?php echo $output_edit->OutputType->displayValueSeparatorAttribute() ?>" id="x_OutputType" name="x_OutputType"<?php echo $output_edit->OutputType->editAttributes() ?>>
			<?php echo $output_edit->OutputType->selectOptionListHtml("x_OutputType") ?>
		</select>
</div>
<?php echo $output_edit->OutputType->Lookup->getParamTag($output_edit, "p_x_OutputType") ?>
</span>
<?php echo $output_edit->OutputType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->OutputName->Visible) { // OutputName ?>
	<div id="r_OutputName" class="form-group row">
		<label id="elh_output_OutputName" for="x_OutputName" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->OutputName->caption() ?><?php echo $output_edit->OutputName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->OutputName->cellAttributes() ?>>
<span id="el_output_OutputName">
<textarea data-table="output" data-field="x_OutputName" name="x_OutputName" id="x_OutputName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_edit->OutputName->getPlaceHolder()) ?>"<?php echo $output_edit->OutputName->editAttributes() ?>><?php echo $output_edit->OutputName->EditValue ?></textarea>
</span>
<?php echo $output_edit->OutputName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->DeliveryDate->Visible) { // DeliveryDate ?>
	<div id="r_DeliveryDate" class="form-group row">
		<label id="elh_output_DeliveryDate" for="x_DeliveryDate" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->DeliveryDate->caption() ?><?php echo $output_edit->DeliveryDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->DeliveryDate->cellAttributes() ?>>
<span id="el_output_DeliveryDate">
<input type="text" data-table="output" data-field="x_DeliveryDate" name="x_DeliveryDate" id="x_DeliveryDate" placeholder="<?php echo HtmlEncode($output_edit->DeliveryDate->getPlaceHolder()) ?>" value="<?php echo $output_edit->DeliveryDate->EditValue ?>"<?php echo $output_edit->DeliveryDate->editAttributes() ?>>
<?php if (!$output_edit->DeliveryDate->ReadOnly && !$output_edit->DeliveryDate->Disabled && !isset($output_edit->DeliveryDate->EditAttrs["readonly"]) && !isset($output_edit->DeliveryDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["foutputedit", "datetimepicker"], function() {
	ew.createDateTimePicker("foutputedit", "x_DeliveryDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $output_edit->DeliveryDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_output_FinancialYear" for="x_FinancialYear" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->FinancialYear->caption() ?><?php echo $output_edit->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->FinancialYear->cellAttributes() ?>>
<span id="el_output_FinancialYear">
<input type="text" data-table="output" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_edit->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_edit->FinancialYear->EditValue ?>"<?php echo $output_edit->FinancialYear->editAttributes() ?>>
</span>
<?php echo $output_edit->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->OutputDescription->Visible) { // OutputDescription ?>
	<div id="r_OutputDescription" class="form-group row">
		<label id="elh_output_OutputDescription" for="x_OutputDescription" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->OutputDescription->caption() ?><?php echo $output_edit->OutputDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->OutputDescription->cellAttributes() ?>>
<span id="el_output_OutputDescription">
<textarea data-table="output" data-field="x_OutputDescription" name="x_OutputDescription" id="x_OutputDescription" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_edit->OutputDescription->getPlaceHolder()) ?>"<?php echo $output_edit->OutputDescription->editAttributes() ?>><?php echo $output_edit->OutputDescription->EditValue ?></textarea>
</span>
<?php echo $output_edit->OutputDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
	<div id="r_OutputMeansOfVerification" class="form-group row">
		<label id="elh_output_OutputMeansOfVerification" for="x_OutputMeansOfVerification" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->OutputMeansOfVerification->caption() ?><?php echo $output_edit->OutputMeansOfVerification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->OutputMeansOfVerification->cellAttributes() ?>>
<span id="el_output_OutputMeansOfVerification">
<textarea data-table="output" data-field="x_OutputMeansOfVerification" name="x_OutputMeansOfVerification" id="x_OutputMeansOfVerification" cols="50" rows="2" placeholder="<?php echo HtmlEncode($output_edit->OutputMeansOfVerification->getPlaceHolder()) ?>"<?php echo $output_edit->OutputMeansOfVerification->editAttributes() ?>><?php echo $output_edit->OutputMeansOfVerification->EditValue ?></textarea>
</span>
<?php echo $output_edit->OutputMeansOfVerification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<div id="r_ResponsibleOfficer" class="form-group row">
		<label id="elh_output_ResponsibleOfficer" for="x_ResponsibleOfficer" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->ResponsibleOfficer->caption() ?><?php echo $output_edit->ResponsibleOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->ResponsibleOfficer->cellAttributes() ?>>
<span id="el_output_ResponsibleOfficer">
<input type="text" data-table="output" data-field="x_ResponsibleOfficer" name="x_ResponsibleOfficer" id="x_ResponsibleOfficer" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($output_edit->ResponsibleOfficer->getPlaceHolder()) ?>" value="<?php echo $output_edit->ResponsibleOfficer->EditValue ?>"<?php echo $output_edit->ResponsibleOfficer->editAttributes() ?>>
</span>
<?php echo $output_edit->ResponsibleOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->Clients->Visible) { // Clients ?>
	<div id="r_Clients" class="form-group row">
		<label id="elh_output_Clients" for="x_Clients" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->Clients->caption() ?><?php echo $output_edit->Clients->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->Clients->cellAttributes() ?>>
<span id="el_output_Clients">
<textarea data-table="output" data-field="x_Clients" name="x_Clients" id="x_Clients" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_edit->Clients->getPlaceHolder()) ?>"<?php echo $output_edit->Clients->editAttributes() ?>><?php echo $output_edit->Clients->EditValue ?></textarea>
</span>
<?php echo $output_edit->Clients->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->Beneficiaries->Visible) { // Beneficiaries ?>
	<div id="r_Beneficiaries" class="form-group row">
		<label id="elh_output_Beneficiaries" for="x_Beneficiaries" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->Beneficiaries->caption() ?><?php echo $output_edit->Beneficiaries->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->Beneficiaries->cellAttributes() ?>>
<span id="el_output_Beneficiaries">
<textarea data-table="output" data-field="x_Beneficiaries" name="x_Beneficiaries" id="x_Beneficiaries" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_edit->Beneficiaries->getPlaceHolder()) ?>"<?php echo $output_edit->Beneficiaries->editAttributes() ?>><?php echo $output_edit->Beneficiaries->EditValue ?></textarea>
</span>
<?php echo $output_edit->Beneficiaries->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->OutputStatus->Visible) { // OutputStatus ?>
	<div id="r_OutputStatus" class="form-group row">
		<label id="elh_output_OutputStatus" for="x_OutputStatus" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->OutputStatus->caption() ?><?php echo $output_edit->OutputStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->OutputStatus->cellAttributes() ?>>
<span id="el_output_OutputStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="output" data-field="x_OutputStatus" data-value-separator="<?php echo $output_edit->OutputStatus->displayValueSeparatorAttribute() ?>" id="x_OutputStatus" name="x_OutputStatus"<?php echo $output_edit->OutputStatus->editAttributes() ?>>
			<?php echo $output_edit->OutputStatus->selectOptionListHtml("x_OutputStatus") ?>
		</select>
</div>
<?php echo $output_edit->OutputStatus->Lookup->getParamTag($output_edit, "p_x_OutputStatus") ?>
</span>
<?php echo $output_edit->OutputStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->TargetAmount->Visible) { // TargetAmount ?>
	<div id="r_TargetAmount" class="form-group row">
		<label id="elh_output_TargetAmount" for="x_TargetAmount" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->TargetAmount->caption() ?><?php echo $output_edit->TargetAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->TargetAmount->cellAttributes() ?>>
<span id="el_output_TargetAmount">
<input type="text" data-table="output" data-field="x_TargetAmount" name="x_TargetAmount" id="x_TargetAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_edit->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_edit->TargetAmount->EditValue ?>"<?php echo $output_edit->TargetAmount->editAttributes() ?>>
</span>
<?php echo $output_edit->TargetAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_output_ActualAmount" for="x_ActualAmount" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->ActualAmount->caption() ?><?php echo $output_edit->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->ActualAmount->cellAttributes() ?>>
<span id="el_output_ActualAmount">
<input type="text" data-table="output" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_edit->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_edit->ActualAmount->EditValue ?>"<?php echo $output_edit->ActualAmount->editAttributes() ?>>
</span>
<?php echo $output_edit->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_edit->PercentAchieved->Visible) { // PercentAchieved ?>
	<div id="r_PercentAchieved" class="form-group row">
		<label id="elh_output_PercentAchieved" for="x_PercentAchieved" class="<?php echo $output_edit->LeftColumnClass ?>"><?php echo $output_edit->PercentAchieved->caption() ?><?php echo $output_edit->PercentAchieved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_edit->RightColumnClass ?>"><div <?php echo $output_edit->PercentAchieved->cellAttributes() ?>>
<span id="el_output_PercentAchieved">
<input type="text" data-table="output" data-field="x_PercentAchieved" name="x_PercentAchieved" id="x_PercentAchieved" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($output_edit->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_edit->PercentAchieved->EditValue ?>"<?php echo $output_edit->PercentAchieved->editAttributes() ?>>
</span>
<?php echo $output_edit->PercentAchieved->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("_action", explode(",", $output->getCurrentDetailTable())) && $_action->DetailEdit) {
?>
<?php if ($output->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "_actiongrid.php" ?>
<?php } ?>
<?php if (!$output_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $output_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $output_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$output_edit->IsModal) { ?>
<?php echo $output_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$output_edit->showPageFooter();
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
$output_edit->terminate();
?>