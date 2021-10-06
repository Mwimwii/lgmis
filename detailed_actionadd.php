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
$detailed_action_add = new detailed_action_add();

// Run the page
$detailed_action_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailed_actionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailed_actionadd = currentForm = new ew.Form("fdetailed_actionadd", "add");

	// Validate form
	fdetailed_actionadd.validate = function() {
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
			<?php if ($detailed_action_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->LACode->caption(), $detailed_action_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->DepartmentCode->caption(), $detailed_action_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->SectionCode->caption(), $detailed_action_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->ProgramCode->caption(), $detailed_action_add->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->SubProgramCode->caption(), $detailed_action_add->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->OutcomeCode->caption(), $detailed_action_add->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->OutputCode->caption(), $detailed_action_add->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->ActionCode->caption(), $detailed_action_add->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->FinancialYear->caption(), $detailed_action_add->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_add->FinancialYear->errorMessage()) ?>");
			<?php if ($detailed_action_add->DetailedActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->DetailedActionName->caption(), $detailed_action_add->DetailedActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->DetailedActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->DetailedActionLocation->caption(), $detailed_action_add->DetailedActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->PlannedStartDate->caption(), $detailed_action_add->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_add->PlannedStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_add->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->PlannedEndDate->caption(), $detailed_action_add->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_add->PlannedEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_add->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->ActualStartDate->caption(), $detailed_action_add->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_add->ActualStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_add->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->ActualEndDate->caption(), $detailed_action_add->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_add->ActualEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_add->Ward->Required) { ?>
				elm = this.getElements("x" + infix + "_Ward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->Ward->caption(), $detailed_action_add->Ward->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->ExpectedResult->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedResult");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->ExpectedResult->caption(), $detailed_action_add->ExpectedResult->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->Comments->caption(), $detailed_action_add->Comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_add->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_add->ProgressStatus->caption(), $detailed_action_add->ProgressStatus->RequiredErrorMessage)) ?>");
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
	fdetailed_actionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailed_actionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailed_actionadd.lists["x_LACode"] = <?php echo $detailed_action_add->LACode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_LACode"].options = <?php echo JsonEncode($detailed_action_add->LACode->lookupOptions()) ?>;
	fdetailed_actionadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailed_actionadd.lists["x_DepartmentCode"] = <?php echo $detailed_action_add->DepartmentCode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($detailed_action_add->DepartmentCode->lookupOptions()) ?>;
	fdetailed_actionadd.lists["x_SectionCode"] = <?php echo $detailed_action_add->SectionCode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_SectionCode"].options = <?php echo JsonEncode($detailed_action_add->SectionCode->lookupOptions()) ?>;
	fdetailed_actionadd.lists["x_ProgramCode"] = <?php echo $detailed_action_add->ProgramCode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_ProgramCode"].options = <?php echo JsonEncode($detailed_action_add->ProgramCode->lookupOptions()) ?>;
	fdetailed_actionadd.lists["x_SubProgramCode"] = <?php echo $detailed_action_add->SubProgramCode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_SubProgramCode"].options = <?php echo JsonEncode($detailed_action_add->SubProgramCode->lookupOptions()) ?>;
	fdetailed_actionadd.lists["x_OutcomeCode"] = <?php echo $detailed_action_add->OutcomeCode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_OutcomeCode"].options = <?php echo JsonEncode($detailed_action_add->OutcomeCode->lookupOptions()) ?>;
	fdetailed_actionadd.lists["x_OutputCode"] = <?php echo $detailed_action_add->OutputCode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_OutputCode"].options = <?php echo JsonEncode($detailed_action_add->OutputCode->lookupOptions()) ?>;
	fdetailed_actionadd.lists["x_ActionCode"] = <?php echo $detailed_action_add->ActionCode->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_ActionCode"].options = <?php echo JsonEncode($detailed_action_add->ActionCode->lookupOptions()) ?>;
	fdetailed_actionadd.lists["x_ProgressStatus"] = <?php echo $detailed_action_add->ProgressStatus->Lookup->toClientList($detailed_action_add) ?>;
	fdetailed_actionadd.lists["x_ProgressStatus"].options = <?php echo JsonEncode($detailed_action_add->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fdetailed_actionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailed_action_add->showPageHeader(); ?>
<?php
$detailed_action_add->showMessage();
?>
<form name="fdetailed_actionadd" id="fdetailed_actionadd" class="<?php echo $detailed_action_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailed_action">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailed_action_add->IsModal ?>">
<?php if ($detailed_action->getCurrentMasterTable() == "_action") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="_action">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($detailed_action_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($detailed_action_add->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OucomeCode" value="<?php echo HtmlEncode($detailed_action_add->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($detailed_action_add->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ActionCode" value="<?php echo HtmlEncode($detailed_action_add->ActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($detailed_action_add->FinancialYear->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailed_action_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_detailed_action_LACode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->LACode->caption() ?><?php echo $detailed_action_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->LACode->cellAttributes() ?>>
<?php if ($detailed_action_add->LACode->getSessionValue() != "") { ?>
<span id="el_detailed_action_LACode">
<span<?php echo $detailed_action_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($detailed_action_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_LACode">
<?php
$onchange = $detailed_action_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($detailed_action_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_add->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_add->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_add->LACode->ReadOnly || $detailed_action_add->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($detailed_action_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actionadd"], function() {
	fdetailed_actionadd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_add->LACode->Lookup->getParamTag($detailed_action_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $detailed_action_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_detailed_action_DepartmentCode" for="x_DepartmentCode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->DepartmentCode->caption() ?><?php echo $detailed_action_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->DepartmentCode->cellAttributes() ?>>
<?php if ($detailed_action_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_DepartmentCode">
<span<?php echo $detailed_action_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_DepartmentCode">
<?php $detailed_action_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $detailed_action_add->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_add->DepartmentCode->Lookup->getParamTag($detailed_action_add, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $detailed_action_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_detailed_action_SectionCode" for="x_SectionCode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->SectionCode->caption() ?><?php echo $detailed_action_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->SectionCode->cellAttributes() ?>>
<span id="el_detailed_action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $detailed_action_add->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_add->SectionCode->Lookup->getParamTag($detailed_action_add, "p_x_SectionCode") ?>
</span>
<?php echo $detailed_action_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_detailed_action_ProgramCode" for="x_ProgramCode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->ProgramCode->caption() ?><?php echo $detailed_action_add->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->ProgramCode->cellAttributes() ?>>
<?php if ($detailed_action_add->ProgramCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_ProgramCode">
<span<?php echo $detailed_action_add->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_add->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProgramCode" name="x_ProgramCode" value="<?php echo HtmlEncode($detailed_action_add->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_ProgramCode">
<?php $detailed_action_add->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_add->ProgramCode->displayValueSeparatorAttribute() ?>" id="x_ProgramCode" name="x_ProgramCode"<?php echo $detailed_action_add->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_add->ProgramCode->selectOptionListHtml("x_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_add->ProgramCode->Lookup->getParamTag($detailed_action_add, "p_x_ProgramCode") ?>
</span>
<?php } ?>
<?php echo $detailed_action_add->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_detailed_action_SubProgramCode" for="x_SubProgramCode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->SubProgramCode->caption() ?><?php echo $detailed_action_add->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->SubProgramCode->cellAttributes() ?>>
<span id="el_detailed_action_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_add->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_add->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_add->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_add->SubProgramCode->ReadOnly || $detailed_action_add->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_add->SubProgramCode->Lookup->getParamTag($detailed_action_add, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_add->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $detailed_action_add->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_add->SubProgramCode->editAttributes() ?>>
</span>
<?php echo $detailed_action_add->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_detailed_action_OutcomeCode" for="x_OutcomeCode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->OutcomeCode->caption() ?><?php echo $detailed_action_add->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->OutcomeCode->cellAttributes() ?>>
<?php if ($detailed_action_add->OutcomeCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_OutcomeCode">
<span<?php echo $detailed_action_add->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_add->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutcomeCode" name="x_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_add->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_OutcomeCode">
<?php $detailed_action_add->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_add->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_add->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_add->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_add->OutcomeCode->ReadOnly || $detailed_action_add->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_add->OutcomeCode->Lookup->getParamTag($detailed_action_add, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_add->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $detailed_action_add->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_add->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_add->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_detailed_action_OutputCode" for="x_OutputCode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->OutputCode->caption() ?><?php echo $detailed_action_add->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->OutputCode->cellAttributes() ?>>
<?php if ($detailed_action_add->OutputCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_OutputCode">
<span<?php echo $detailed_action_add->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_add->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutputCode" name="x_OutputCode" value="<?php echo HtmlEncode($detailed_action_add->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_OutputCode">
<?php $detailed_action_add->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($detailed_action_add->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_add->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_add->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_add->OutputCode->ReadOnly || $detailed_action_add->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_add->OutputCode->Lookup->getParamTag($detailed_action_add, "p_x_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_add->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $detailed_action_add->OutputCode->CurrentValue ?>"<?php echo $detailed_action_add->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_add->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label id="elh_detailed_action_ActionCode" for="x_ActionCode" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->ActionCode->caption() ?><?php echo $detailed_action_add->ActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->ActionCode->cellAttributes() ?>>
<?php if ($detailed_action_add->ActionCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_ActionCode">
<span<?php echo $detailed_action_add->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_add->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ActionCode" name="x_ActionCode" value="<?php echo HtmlEncode($detailed_action_add->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_ActionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ActionCode"><?php echo EmptyValue(strval($detailed_action_add->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_add->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_add->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_add->ActionCode->ReadOnly || $detailed_action_add->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_add->ActionCode->Lookup->getParamTag($detailed_action_add, "p_x_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_add->ActionCode->displayValueSeparatorAttribute() ?>" name="x_ActionCode" id="x_ActionCode" value="<?php echo $detailed_action_add->ActionCode->CurrentValue ?>"<?php echo $detailed_action_add->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_add->ActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_detailed_action_FinancialYear" for="x_FinancialYear" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->FinancialYear->caption() ?><?php echo $detailed_action_add->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->FinancialYear->cellAttributes() ?>>
<?php if ($detailed_action_add->FinancialYear->getSessionValue() != "") { ?>
<span id="el_detailed_action_FinancialYear">
<span<?php echo $detailed_action_add->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_add->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_FinancialYear" name="x_FinancialYear" value="<?php echo HtmlEncode($detailed_action_add->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_FinancialYear">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_add->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->FinancialYear->EditValue ?>"<?php echo $detailed_action_add->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_add->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->DetailedActionName->Visible) { // DetailedActionName ?>
	<div id="r_DetailedActionName" class="form-group row">
		<label id="elh_detailed_action_DetailedActionName" for="x_DetailedActionName" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->DetailedActionName->caption() ?><?php echo $detailed_action_add->DetailedActionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->DetailedActionName->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionName">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x_DetailedActionName" id="x_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_add->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->DetailedActionName->EditValue ?>"<?php echo $detailed_action_add->DetailedActionName->editAttributes() ?>>
</span>
<?php echo $detailed_action_add->DetailedActionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
	<div id="r_DetailedActionLocation" class="form-group row">
		<label id="elh_detailed_action_DetailedActionLocation" for="x_DetailedActionLocation" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->DetailedActionLocation->caption() ?><?php echo $detailed_action_add->DetailedActionLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->DetailedActionLocation->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionLocation">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x_DetailedActionLocation" id="x_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_add->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_add->DetailedActionLocation->editAttributes() ?>>
</span>
<?php echo $detailed_action_add->DetailedActionLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_detailed_action_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->PlannedStartDate->caption() ?><?php echo $detailed_action_add->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->PlannedStartDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedStartDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_add->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_add->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_add->PlannedStartDate->ReadOnly && !$detailed_action_add->PlannedStartDate->Disabled && !isset($detailed_action_add->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_add->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionadd", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_add->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_detailed_action_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->PlannedEndDate->caption() ?><?php echo $detailed_action_add->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->PlannedEndDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedEndDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_add->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_add->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_add->PlannedEndDate->ReadOnly && !$detailed_action_add->PlannedEndDate->Disabled && !isset($detailed_action_add->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_add->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionadd", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_add->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_detailed_action_ActualStartDate" for="x_ActualStartDate" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->ActualStartDate->caption() ?><?php echo $detailed_action_add->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->ActualStartDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualStartDate">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_add->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->ActualStartDate->EditValue ?>"<?php echo $detailed_action_add->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_add->ActualStartDate->ReadOnly && !$detailed_action_add->ActualStartDate->Disabled && !isset($detailed_action_add->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_add->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionadd", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_add->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label id="elh_detailed_action_ActualEndDate" for="x_ActualEndDate" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->ActualEndDate->caption() ?><?php echo $detailed_action_add->ActualEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->ActualEndDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualEndDate">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_add->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->ActualEndDate->EditValue ?>"<?php echo $detailed_action_add->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_add->ActualEndDate->ReadOnly && !$detailed_action_add->ActualEndDate->Disabled && !isset($detailed_action_add->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_add->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionadd", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_add->ActualEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->Ward->Visible) { // Ward ?>
	<div id="r_Ward" class="form-group row">
		<label id="elh_detailed_action_Ward" for="x_Ward" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->Ward->caption() ?><?php echo $detailed_action_add->Ward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->Ward->cellAttributes() ?>>
<span id="el_detailed_action_Ward">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x_Ward" id="x_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_add->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_add->Ward->EditValue ?>"<?php echo $detailed_action_add->Ward->editAttributes() ?>>
</span>
<?php echo $detailed_action_add->Ward->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->ExpectedResult->Visible) { // ExpectedResult ?>
	<div id="r_ExpectedResult" class="form-group row">
		<label id="elh_detailed_action_ExpectedResult" for="x_ExpectedResult" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->ExpectedResult->caption() ?><?php echo $detailed_action_add->ExpectedResult->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->ExpectedResult->cellAttributes() ?>>
<span id="el_detailed_action_ExpectedResult">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x_ExpectedResult" id="x_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_add->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_add->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_add->ExpectedResult->EditValue ?></textarea>
</span>
<?php echo $detailed_action_add->ExpectedResult->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label id="elh_detailed_action_Comments" for="x_Comments" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->Comments->caption() ?><?php echo $detailed_action_add->Comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->Comments->cellAttributes() ?>>
<span id="el_detailed_action_Comments">
<textarea data-table="detailed_action" data-field="x_Comments" name="x_Comments" id="x_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_add->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_add->Comments->editAttributes() ?>><?php echo $detailed_action_add->Comments->EditValue ?></textarea>
</span>
<?php echo $detailed_action_add->Comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_add->ProgressStatus->Visible) { // ProgressStatus ?>
	<div id="r_ProgressStatus" class="form-group row">
		<label id="elh_detailed_action_ProgressStatus" for="x_ProgressStatus" class="<?php echo $detailed_action_add->LeftColumnClass ?>"><?php echo $detailed_action_add->ProgressStatus->caption() ?><?php echo $detailed_action_add->ProgressStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_add->RightColumnClass ?>"><div <?php echo $detailed_action_add->ProgressStatus->cellAttributes() ?>>
<span id="el_detailed_action_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_add->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x_ProgressStatus" name="x_ProgressStatus"<?php echo $detailed_action_add->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_add->ProgressStatus->selectOptionListHtml("x_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_add->ProgressStatus->Lookup->getParamTag($detailed_action_add, "p_x_ProgressStatus") ?>
</span>
<?php echo $detailed_action_add->ProgressStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("budget", explode(",", $detailed_action->getCurrentDetailTable())) && $budget->DetailAdd) {
?>
<?php if ($detailed_action->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("budget", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "budgetgrid.php" ?>
<?php } ?>
<?php if (!$detailed_action_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailed_action_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailed_action_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailed_action_add->showPageFooter();
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
$detailed_action_add->terminate();
?>