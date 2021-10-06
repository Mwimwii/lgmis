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
$output_indicator_add = new output_indicator_add();

// Run the page
$output_indicator_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_indicator_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutput_indicatoradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	foutput_indicatoradd = currentForm = new ew.Form("foutput_indicatoradd", "add");

	// Validate form
	foutput_indicatoradd.validate = function() {
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
			<?php if ($output_indicator_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->LACode->caption(), $output_indicator_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->DepartmentCode->caption(), $output_indicator_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->DepartmentCode->errorMessage()) ?>");
			<?php if ($output_indicator_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->SectionCode->caption(), $output_indicator_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->SectionCode->errorMessage()) ?>");
			<?php if ($output_indicator_add->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->OutputCode->caption(), $output_indicator_add->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->OutputCode->errorMessage()) ?>");
			<?php if ($output_indicator_add->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->OutcomeCode->caption(), $output_indicator_add->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->OutcomeCode->errorMessage()) ?>");
			<?php if ($output_indicator_add->OutputType->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->OutputType->caption(), $output_indicator_add->OutputType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_add->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->ProgramCode->caption(), $output_indicator_add->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->ProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_add->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->SubProgramCode->caption(), $output_indicator_add->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->SubProgramCode->errorMessage()) ?>");
			<?php if ($output_indicator_add->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->FinancialYear->caption(), $output_indicator_add->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->FinancialYear->errorMessage()) ?>");
			<?php if ($output_indicator_add->OutputIndicatorName->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputIndicatorName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->OutputIndicatorName->caption(), $output_indicator_add->OutputIndicatorName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($output_indicator_add->TargetAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->TargetAmount->caption(), $output_indicator_add->TargetAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TargetAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->TargetAmount->errorMessage()) ?>");
			<?php if ($output_indicator_add->ActualAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->ActualAmount->caption(), $output_indicator_add->ActualAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->ActualAmount->errorMessage()) ?>");
			<?php if ($output_indicator_add->PercentAchieved->Required) { ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $output_indicator_add->PercentAchieved->caption(), $output_indicator_add->PercentAchieved->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PercentAchieved");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($output_indicator_add->PercentAchieved->errorMessage()) ?>");

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
	foutput_indicatoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutput_indicatoradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	foutput_indicatoradd.lists["x_LACode"] = <?php echo $output_indicator_add->LACode->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_LACode"].options = <?php echo JsonEncode($output_indicator_add->LACode->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoradd.lists["x_DepartmentCode"] = <?php echo $output_indicator_add->DepartmentCode->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($output_indicator_add->DepartmentCode->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_DepartmentCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoradd.lists["x_SectionCode"] = <?php echo $output_indicator_add->SectionCode->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_SectionCode"].options = <?php echo JsonEncode($output_indicator_add->SectionCode->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_SectionCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoradd.lists["x_OutputCode"] = <?php echo $output_indicator_add->OutputCode->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_OutputCode"].options = <?php echo JsonEncode($output_indicator_add->OutputCode->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoradd.lists["x_OutcomeCode"] = <?php echo $output_indicator_add->OutcomeCode->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_OutcomeCode"].options = <?php echo JsonEncode($output_indicator_add->OutcomeCode->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_OutcomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoradd.lists["x_OutputType"] = <?php echo $output_indicator_add->OutputType->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_OutputType"].options = <?php echo JsonEncode($output_indicator_add->OutputType->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_OutputType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoradd.lists["x_ProgramCode"] = <?php echo $output_indicator_add->ProgramCode->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_ProgramCode"].options = <?php echo JsonEncode($output_indicator_add->ProgramCode->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	foutput_indicatoradd.lists["x_SubProgramCode"] = <?php echo $output_indicator_add->SubProgramCode->Lookup->toClientList($output_indicator_add) ?>;
	foutput_indicatoradd.lists["x_SubProgramCode"].options = <?php echo JsonEncode($output_indicator_add->SubProgramCode->lookupOptions()) ?>;
	foutput_indicatoradd.autoSuggests["x_SubProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("foutput_indicatoradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_indicator_add->showPageHeader(); ?>
<?php
$output_indicator_add->showMessage();
?>
<form name="foutput_indicatoradd" id="foutput_indicatoradd" class="<?php echo $output_indicator_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_indicator">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$output_indicator_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($output_indicator_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_output_indicator_LACode" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->LACode->caption() ?><?php echo $output_indicator_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->LACode->cellAttributes() ?>>
<span id="el_output_indicator_LACode">
<?php
$onchange = $output_indicator_add->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($output_indicator_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($output_indicator_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->LACode->getPlaceHolder()) ?>"<?php echo $output_indicator_add->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_LACode" data-value-separator="<?php echo $output_indicator_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($output_indicator_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->LACode->Lookup->getParamTag($output_indicator_add, "p_x_LACode") ?>
</span>
<?php echo $output_indicator_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_output_indicator_DepartmentCode" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->DepartmentCode->caption() ?><?php echo $output_indicator_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->DepartmentCode->cellAttributes() ?>>
<span id="el_output_indicator_DepartmentCode">
<?php
$onchange = $output_indicator_add->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_DepartmentCode">
	<input type="text" class="form-control" name="sv_x_DepartmentCode" id="sv_x_DepartmentCode" value="<?php echo RemoveHtml($output_indicator_add->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->DepartmentCode->getPlaceHolder()) ?>"<?php echo $output_indicator_add->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_DepartmentCode" data-value-separator="<?php echo $output_indicator_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo HtmlEncode($output_indicator_add->DepartmentCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->DepartmentCode->Lookup->getParamTag($output_indicator_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $output_indicator_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_output_indicator_SectionCode" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->SectionCode->caption() ?><?php echo $output_indicator_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->SectionCode->cellAttributes() ?>>
<span id="el_output_indicator_SectionCode">
<?php
$onchange = $output_indicator_add->SectionCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->SectionCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_SectionCode">
	<input type="text" class="form-control" name="sv_x_SectionCode" id="sv_x_SectionCode" value="<?php echo RemoveHtml($output_indicator_add->SectionCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->SectionCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->SectionCode->getPlaceHolder()) ?>"<?php echo $output_indicator_add->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SectionCode" data-value-separator="<?php echo $output_indicator_add->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo HtmlEncode($output_indicator_add->SectionCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_SectionCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->SectionCode->Lookup->getParamTag($output_indicator_add, "p_x_SectionCode") ?>
</span>
<?php echo $output_indicator_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_output_indicator_OutputCode" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->OutputCode->caption() ?><?php echo $output_indicator_add->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->OutputCode->cellAttributes() ?>>
<span id="el_output_indicator_OutputCode">
<?php
$onchange = $output_indicator_add->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputCode">
	<input type="text" class="form-control" name="sv_x_OutputCode" id="sv_x_OutputCode" value="<?php echo RemoveHtml($output_indicator_add->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->OutputCode->getPlaceHolder()) ?>"<?php echo $output_indicator_add->OutputCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputCode" data-value-separator="<?php echo $output_indicator_add->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo HtmlEncode($output_indicator_add->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_OutputCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->OutputCode->Lookup->getParamTag($output_indicator_add, "p_x_OutputCode") ?>
</span>
<?php echo $output_indicator_add->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_output_indicator_OutcomeCode" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->OutcomeCode->caption() ?><?php echo $output_indicator_add->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->OutcomeCode->cellAttributes() ?>>
<span id="el_output_indicator_OutcomeCode">
<?php
$onchange = $output_indicator_add->OutcomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->OutcomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutcomeCode">
	<input type="text" class="form-control" name="sv_x_OutcomeCode" id="sv_x_OutcomeCode" value="<?php echo RemoveHtml($output_indicator_add->OutcomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->OutcomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->OutcomeCode->getPlaceHolder()) ?>"<?php echo $output_indicator_add->OutcomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutcomeCode" data-value-separator="<?php echo $output_indicator_add->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo HtmlEncode($output_indicator_add->OutcomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_OutcomeCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->OutcomeCode->Lookup->getParamTag($output_indicator_add, "p_x_OutcomeCode") ?>
</span>
<?php echo $output_indicator_add->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->OutputType->Visible) { // OutputType ?>
	<div id="r_OutputType" class="form-group row">
		<label id="elh_output_indicator_OutputType" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->OutputType->caption() ?><?php echo $output_indicator_add->OutputType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->OutputType->cellAttributes() ?>>
<span id="el_output_indicator_OutputType">
<?php
$onchange = $output_indicator_add->OutputType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->OutputType->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputType">
	<input type="text" class="form-control" name="sv_x_OutputType" id="sv_x_OutputType" value="<?php echo RemoveHtml($output_indicator_add->OutputType->EditValue) ?>" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($output_indicator_add->OutputType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->OutputType->getPlaceHolder()) ?>"<?php echo $output_indicator_add->OutputType->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_OutputType" data-value-separator="<?php echo $output_indicator_add->OutputType->displayValueSeparatorAttribute() ?>" name="x_OutputType" id="x_OutputType" value="<?php echo HtmlEncode($output_indicator_add->OutputType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_OutputType","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->OutputType->Lookup->getParamTag($output_indicator_add, "p_x_OutputType") ?>
</span>
<?php echo $output_indicator_add->OutputType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_output_indicator_ProgramCode" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->ProgramCode->caption() ?><?php echo $output_indicator_add->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->ProgramCode->cellAttributes() ?>>
<span id="el_output_indicator_ProgramCode">
<?php
$onchange = $output_indicator_add->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($output_indicator_add->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->ProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_add->ProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_ProgramCode" data-value-separator="<?php echo $output_indicator_add->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($output_indicator_add->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_ProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->ProgramCode->Lookup->getParamTag($output_indicator_add, "p_x_ProgramCode") ?>
</span>
<?php echo $output_indicator_add->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_output_indicator_SubProgramCode" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->SubProgramCode->caption() ?><?php echo $output_indicator_add->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->SubProgramCode->cellAttributes() ?>>
<span id="el_output_indicator_SubProgramCode">
<?php
$onchange = $output_indicator_add->SubProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$output_indicator_add->SubProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_SubProgramCode">
	<input type="text" class="form-control" name="sv_x_SubProgramCode" id="sv_x_SubProgramCode" value="<?php echo RemoveHtml($output_indicator_add->SubProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->SubProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($output_indicator_add->SubProgramCode->getPlaceHolder()) ?>"<?php echo $output_indicator_add->SubProgramCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="output_indicator" data-field="x_SubProgramCode" data-value-separator="<?php echo $output_indicator_add->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo HtmlEncode($output_indicator_add->SubProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["foutput_indicatoradd"], function() {
	foutput_indicatoradd.createAutoSuggest({"id":"x_SubProgramCode","forceSelect":false});
});
</script>
<?php echo $output_indicator_add->SubProgramCode->Lookup->getParamTag($output_indicator_add, "p_x_SubProgramCode") ?>
</span>
<?php echo $output_indicator_add->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_output_indicator_FinancialYear" for="x_FinancialYear" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->FinancialYear->caption() ?><?php echo $output_indicator_add->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->FinancialYear->cellAttributes() ?>>
<span id="el_output_indicator_FinancialYear">
<input type="text" data-table="output_indicator" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $output_indicator_add->FinancialYear->EditValue ?>"<?php echo $output_indicator_add->FinancialYear->editAttributes() ?>>
</span>
<?php echo $output_indicator_add->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->OutputIndicatorName->Visible) { // OutputIndicatorName ?>
	<div id="r_OutputIndicatorName" class="form-group row">
		<label id="elh_output_indicator_OutputIndicatorName" for="x_OutputIndicatorName" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->OutputIndicatorName->caption() ?><?php echo $output_indicator_add->OutputIndicatorName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->OutputIndicatorName->cellAttributes() ?>>
<span id="el_output_indicator_OutputIndicatorName">
<textarea data-table="output_indicator" data-field="x_OutputIndicatorName" name="x_OutputIndicatorName" id="x_OutputIndicatorName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($output_indicator_add->OutputIndicatorName->getPlaceHolder()) ?>"<?php echo $output_indicator_add->OutputIndicatorName->editAttributes() ?>><?php echo $output_indicator_add->OutputIndicatorName->EditValue ?></textarea>
</span>
<?php echo $output_indicator_add->OutputIndicatorName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->TargetAmount->Visible) { // TargetAmount ?>
	<div id="r_TargetAmount" class="form-group row">
		<label id="elh_output_indicator_TargetAmount" for="x_TargetAmount" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->TargetAmount->caption() ?><?php echo $output_indicator_add->TargetAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->TargetAmount->cellAttributes() ?>>
<span id="el_output_indicator_TargetAmount">
<input type="text" data-table="output_indicator" data-field="x_TargetAmount" name="x_TargetAmount" id="x_TargetAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->TargetAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_add->TargetAmount->EditValue ?>"<?php echo $output_indicator_add->TargetAmount->editAttributes() ?>>
</span>
<?php echo $output_indicator_add->TargetAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->ActualAmount->Visible) { // ActualAmount ?>
	<div id="r_ActualAmount" class="form-group row">
		<label id="elh_output_indicator_ActualAmount" for="x_ActualAmount" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->ActualAmount->caption() ?><?php echo $output_indicator_add->ActualAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->ActualAmount->cellAttributes() ?>>
<span id="el_output_indicator_ActualAmount">
<input type="text" data-table="output_indicator" data-field="x_ActualAmount" name="x_ActualAmount" id="x_ActualAmount" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->ActualAmount->getPlaceHolder()) ?>" value="<?php echo $output_indicator_add->ActualAmount->EditValue ?>"<?php echo $output_indicator_add->ActualAmount->editAttributes() ?>>
</span>
<?php echo $output_indicator_add->ActualAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($output_indicator_add->PercentAchieved->Visible) { // PercentAchieved ?>
	<div id="r_PercentAchieved" class="form-group row">
		<label id="elh_output_indicator_PercentAchieved" for="x_PercentAchieved" class="<?php echo $output_indicator_add->LeftColumnClass ?>"><?php echo $output_indicator_add->PercentAchieved->caption() ?><?php echo $output_indicator_add->PercentAchieved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $output_indicator_add->RightColumnClass ?>"><div <?php echo $output_indicator_add->PercentAchieved->cellAttributes() ?>>
<span id="el_output_indicator_PercentAchieved">
<input type="text" data-table="output_indicator" data-field="x_PercentAchieved" name="x_PercentAchieved" id="x_PercentAchieved" size="30" placeholder="<?php echo HtmlEncode($output_indicator_add->PercentAchieved->getPlaceHolder()) ?>" value="<?php echo $output_indicator_add->PercentAchieved->EditValue ?>"<?php echo $output_indicator_add->PercentAchieved->editAttributes() ?>>
</span>
<?php echo $output_indicator_add->PercentAchieved->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$output_indicator_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $output_indicator_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $output_indicator_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$output_indicator_add->showPageFooter();
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
$output_indicator_add->terminate();
?>