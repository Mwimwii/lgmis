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
$output_indicator_edit = new output_indicator_edit();

// Run the page
$output_indicator_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutput_indicatoredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	foutput_indicatoredit = currentForm = new ew.Form("foutput_indicatoredit", "edit");

	// Validate form
	foutput_indicatoredit.validate = function() {
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
			<?php if ($output_indicator_edit->IndicatorNo->Required) { ?>
				elm = this.getElements("x" + infix + "_IndicatorNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->IndicatorNo->caption(), $output_indicator_edit->IndicatorNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->LACode->caption(), $output_indicator_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->DepartmentCode->caption(), $output_indicator_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->DepartmentCode->errorMessage()) ?>");
			<?php if ($output_indicator_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->SectionCode->caption(), $output_indicator_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->SectionCode->errorMessage()) ?>");
			<?php if ($output_indicator_edit->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->OutputCode->caption(), $output_indicator_edit->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->OutputCode->errorMessage()) ?>");
			<?php if ($output_indicator_edit->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->OutcomeCode->caption(), $output_indicator_edit->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->OutcomeCode->errorMessage()) ?>");
			<?php if ($output_indicator_edit->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->OutputType->caption(), $output_indicator_edit->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_edit->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->ProgramCode->caption(), $output_indicator_edit->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->ProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_edit->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->SubProgramCode->caption(), $output_indicator_edit->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->SubProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_edit->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->FinancialYear->caption(), $output_indicator_edit->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->FinancialYear->errorMessage()) ?>");
			<?php if ($output_indicator_edit->OutputIndicatorName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputIndicatorName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->OutputIndicatorName->caption(), $output_indicator_edit->OutputIndicatorName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_edit->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->TargetAmount->caption(), $output_indicator_edit->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->TargetAmount->errorMessage()) ?>");
			<?php if ($output_indicator_edit->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->ActualAmount->caption(), $output_indicator_edit->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->ActualAmount->errorMessage()) ?>");
			<?php if ($output_indicator_edit->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_edit->PercentAchieved->caption(), $output_indicator_edit->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_edit->PercentAchieved->errorMessage()) ?>");

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
	foutput_indicatoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutput_indicatoredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutput_indicatoredit.lists["x_LACode"] = <?php echo $output_indicator_edit->LACode->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_LACode"].options = <?php echo JsonEncode($output_indicator_edit->LACode->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoredit.lists["x_DepartmentCode"] = <?php echo $output_indicator_edit->DepartmentCode->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_indicator_edit->DepartmentCode->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_DepartmentCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoredit.lists["x_SectionCode"] = <?php echo $output_indicator_edit->SectionCode->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_SectionCode"].options = <?php echo JsonEncode($output_indicator_edit->SectionCode->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_SectionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoredit.lists["x_OutputCode"] = <?php echo $output_indicator_edit->OutputCode->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_OutputCode"].options = <?php echo JsonEncode($output_indicator_edit->OutputCode->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoredit.lists["x_OutcomeCode"] = <?php echo $output_indicator_edit->OutcomeCode->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_indicator_edit->OutcomeCode->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_OutcomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoredit.lists["x_OutputType"] = <?php echo $output_indicator_edit->OutputType->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_OutputType"].options = <?php echo JsonEncode($output_indicator_edit->OutputType->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_OutputType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoredit.lists["x_ProgramCode"] = <?php echo $output_indicator_edit->ProgramCode->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_indicator_edit->ProgramCode->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoredit.lists["x_SubProgramCode"] = <?php echo $output_indicator_edit->SubProgramCode->Lookup->toClientList($output_indicator_edit) ?>;
	foutput_indicatoredit.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_indicator_edit->SubProgramCode->lookupOptions()) ?>;
	foutput_indicatoredit.autoSuggests["x_SubProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("foutput_indicatoredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_indicator_edit->showPageHeader(); ?>
<?php
$output_indicator_edit->showMessage();
?>
<?php if (!$output_indicator_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $output_indicator_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="foutput_indicatoredit" id="foutput_indicatoredit" class="<?php echo $output_indicator_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_indicator">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$output_indicator_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($output_indicator_edit->IndicatorNo->Visible) { // IndicatorNo ?>
	<div id="r_IndicatorNo" class="form-group row">
		<label id="elh_output_indicator_IndicatorNo" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->IndicatorNo->caption() ?><?php echo $output_indicator_edit->IndicatorNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->IndicatorNo->cellAttributes() ?>>
<span id="el_output_indicator_IndicatorNo">
<span<?php echo $output_indicator_edit->IndicatorNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($output_indicator_edit->IndicatorNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_IndicatorNo" name="x_IndicatorNo" id="x_IndicatorNo" value="<?php echo HtmlEncode($output_indicator_edit->IndicatorNo->CurrentValue) ?>">
<?php echo $output_indicator_edit->IndicatorNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_output_indicator_LACode" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->LACode->caption() ?><?php echo $output_indicator_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->LACode->cellAttributes() ?>>
<span id="el_output_indicator_LACode">
<?php
$onchange = $output_indicator_edit->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($output_indicator_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($output_indicator_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->LACode->Lookup->getParamTag($output_indicator_edit, "p_x_LACode") ?>
</span>
<?php echo $output_indicator_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_output_indicator_DepartmentCode" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->DepartmentCode->caption() ?><?php echo $output_indicator_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_output_indicator_DepartmentCode">
<?php
$onchange = $output_indicator_edit->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_DepartmentCode">
	<input type="text" class="form-control" name="sv_x_DepartmentCode" id="sv_x_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_edit->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_edit->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->DepartmentCode->Lookup->getParamTag($output_indicator_edit, "p_x_DepartmentCode") ?>
</span>
<?php echo $output_indicator_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_output_indicator_SectionCode" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->SectionCode->caption() ?><?php echo $output_indicator_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->SectionCode->cellAttributes() ?>>
<span id="el_output_indicator_SectionCode">
<?php
$onchange = $output_indicator_edit->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_SectionCode">
	<input type="text" class="form-control" name="sv_x_SectionCode" id="sv_x_SectionCode" value="<?php echo RemoveHtml($output_indicator_edit->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_edit->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo HtmlEncode($output_indicator_edit->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->SectionCode->Lookup->getParamTag($output_indicator_edit, "p_x_SectionCode") ?>
</span>
<?php echo $output_indicator_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_output_indicator_OutputCode" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->OutputCode->caption() ?><?php echo $output_indicator_edit->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->OutputCode->cellAttributes() ?>>
<span id="el_output_indicator_OutputCode">
<?php
$onchange = $output_indicator_edit->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputCode">
	<input type="text" class="form-control" name="sv_x_OutputCode" id="sv_x_OutputCode" value="<?php echo RemoveHtml($output_indicator_edit->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_edit->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo HtmlEncode($output_indicator_edit->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->OutputCode->Lookup->getParamTag($output_indicator_edit, "p_x_OutputCode") ?>
</span>
<?php echo $output_indicator_edit->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_output_indicator_OutcomeCode" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->OutcomeCode->caption() ?><?php echo $output_indicator_edit->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->OutcomeCode->cellAttributes() ?>>
<span id="el_output_indicator_OutcomeCode">
<?php
$onchange = $output_indicator_edit->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutcomeCode">
	<input type="text" class="form-control" name="sv_x_OutcomeCode" id="sv_x_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_edit->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_edit->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_edit->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->OutcomeCode->Lookup->getParamTag($output_indicator_edit, "p_x_OutcomeCode") ?>
</span>
<?php echo $output_indicator_edit->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->OutputType->Visible) { // OutputType ?>
	<div id="r_OutputType" class="form-group row">
		<label id="elh_output_indicator_OutputType" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->OutputType->caption() ?><?php echo $output_indicator_edit->OutputType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->OutputType->cellAttributes() ?>>
<span id="el_output_indicator_OutputType">
<?php
$onchange = $output_indicator_edit->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputType">
	<input type="text" class="form-control" name="sv_x_OutputType" id="sv_x_OutputType" value="<?php echo RemoveHtml($output_indicator_edit->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_edit->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_edit->OutputType->displayValueSeparatorAttribute() ?>" name="x_OutputType" id="x_OutputType" value="<?php echo HtmlEncode($output_indicator_edit->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->OutputType->Lookup->getParamTag($output_indicator_edit, "p_x_OutputType") ?>
</span>
<?php echo $output_indicator_edit->OutputType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_output_indicator_ProgramCode" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->ProgramCode->caption() ?><?php echo $output_indicator_edit->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->ProgramCode->cellAttributes() ?>>
<span id="el_output_indicator_ProgramCode">
<?php
$onchange = $output_indicator_edit->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($output_indicator_edit->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_edit->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($output_indicator_edit->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->ProgramCode->Lookup->getParamTag($output_indicator_edit, "p_x_ProgramCode") ?>
</span>
<?php echo $output_indicator_edit->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_output_indicator_SubProgramCode" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->SubProgramCode->caption() ?><?php echo $output_indicator_edit->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->SubProgramCode->cellAttributes() ?>>
<span id="el_output_indicator_SubProgramCode">
<?php
$onchange = $output_indicator_edit->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_edit->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_SubProgramCode">
	<input type="text" class="form-control" name="sv_x_SubProgramCode" id="sv_x_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_edit->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_edit->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_edit->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_edit->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoredit"], function() {
	foutput_indicatoredit.createAutoSuggest({"id":"x_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_edit->SubProgramCode->Lookup->getParamTag($output_indicator_edit, "p_x_SubProgramCode") ?>
</span>
<?php echo $output_indicator_edit->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_output_indicator_FinancialYear" for="x_FinancialYear" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->FinancialYear->caption() ?><?php echo $output_indicator_edit->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->FinancialYear->cellAttributes() ?>>
<span id="el_output_indicator_FinancialYear">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_edit->FinancialYear->EditValue ?>"<?php echo $output_indicator_edit->FinancialYear->editAttributes() ?>>
</span>
<?php echo $output_indicator_edit->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
	<div id="r_OutputIndicatorName" class="form-group row">
		<label id="elh_output_indicator_OutputIndicatorName" for="x_OutputIndicatorName" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->OutputIndicatorName->caption() ?><?php echo $output_indicator_edit->OutputIndicatorName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->OutputIndicatorName->cellAttributes() ?>>
<span id="el_output_indicator_OutputIndicatorName">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x_OutputIndicatorName" id="x_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_edit->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_edit->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_edit->OutputIndicatorName->EditValue ?></textarea>
</span>
<?php echo $output_indicator_edit->OutputIndicatorName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->TargetAmount->Visible) { // TargetAmount ?>
	<div id="r_TargetAmount" class="form-group row">
		<label id="elh_output_indicator_TargetAmount" for="x_TargetAmount" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->TargetAmount->caption() ?><?php echo $output_indicator_edit->TargetAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->TargetAmount->cellAttributes() ?>>
<span id="el_output_indicator_TargetAmount">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x_TargetAmount" id="x_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_edit->TargetAmount->EditValue ?>"<?php echo $output_indicator_edit->TargetAmount->editAttributes() ?>>
</span>
<?php echo $output_indicator_edit->TargetAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_output_indicator_ActualAmount" for="x_ActualAmount" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->ActualAmount->caption() ?><?php echo $output_indicator_edit->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->ActualAmount->cellAttributes() ?>>
<span id="el_output_indicator_ActualAmount">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_edit->ActualAmount->EditValue ?>"<?php echo $output_indicator_edit->ActualAmount->editAttributes() ?>>
</span>
<?php echo $output_indicator_edit->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_edit->PercentAchieved->Visible) { // PercentAchieved ?>
	<div id="r_PercentAchieved" class="form-group row">
		<label id="elh_output_indicator_PercentAchieved" for="x_PercentAchieved" class="<?php echo $output_indicator_edit->LeftColumnClass ?>"><?php echo $output_indicator_edit->PercentAchieved->caption() ?><?php echo $output_indicator_edit->PercentAchieved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_edit->RightColumnClass ?>"><div <?php echo $output_indicator_edit->PercentAchieved->cellAttributes() ?>>
<span id="el_output_indicator_PercentAchieved">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x_PercentAchieved" id="x_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_edit->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_edit->PercentAchieved->EditValue ?>"<?php echo $output_indicator_edit->PercentAchieved->editAttributes() ?>>
</span>
<?php echo $output_indicator_edit->PercentAchieved->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$output_indicator_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $output_indicator_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $output_indicator_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$output_indicator_edit->IsModal) { ?>
<?php echo $output_indicator_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$output_indicator_edit->showPageFooter();
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
$output_indicator_edit->terminate();
?>