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
$detailed_action_edit = new detailed_action_edit();

// Run the page
$detailed_action_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailed_actionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailed_actionedit = currentForm = new ew.Form("fdetailed_actionedit", "edit");

	// Validate form
	fdetailed_actionedit.validate = function() {
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
			<?php if ($detailed_action_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->LACode->caption(), $detailed_action_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->DepartmentCode->caption(), $detailed_action_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->SectionCode->caption(), $detailed_action_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->ProgramCode->caption(), $detailed_action_edit->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->SubProgramCode->caption(), $detailed_action_edit->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->OutcomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutcomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->OutcomeCode->caption(), $detailed_action_edit->OutcomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->OutputCode->caption(), $detailed_action_edit->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->ActionCode->caption(), $detailed_action_edit->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->FinancialYear->caption(), $detailed_action_edit->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_edit->FinancialYear->errorMessage()) ?>");
			<?php if ($detailed_action_edit->DetailedActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->DetailedActionCode->caption(), $detailed_action_edit->DetailedActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->DetailedActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->DetailedActionName->caption(), $detailed_action_edit->DetailedActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->DetailedActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_DetailedActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->DetailedActionLocation->caption(), $detailed_action_edit->DetailedActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->PlannedStartDate->caption(), $detailed_action_edit->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_edit->PlannedStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_edit->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->PlannedEndDate->caption(), $detailed_action_edit->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_edit->PlannedEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_edit->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->ActualStartDate->caption(), $detailed_action_edit->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_edit->ActualStartDate->errorMessage()) ?>");
			<?php if ($detailed_action_edit->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->ActualEndDate->caption(), $detailed_action_edit->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailed_action_edit->ActualEndDate->errorMessage()) ?>");
			<?php if ($detailed_action_edit->Ward->Required) { ?>
				elm = this.getElements("x" + infix + "_Ward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->Ward->caption(), $detailed_action_edit->Ward->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->ExpectedResult->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedResult");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->ExpectedResult->caption(), $detailed_action_edit->ExpectedResult->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->Comments->caption(), $detailed_action_edit->Comments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailed_action_edit->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailed_action_edit->ProgressStatus->caption(), $detailed_action_edit->ProgressStatus->RequiredErrorMessage)) ?>");
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
	fdetailed_actionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailed_actionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailed_actionedit.lists["x_LACode"] = <?php echo $detailed_action_edit->LACode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_LACode"].options = <?php echo JsonEncode($detailed_action_edit->LACode->lookupOptions()) ?>;
	fdetailed_actionedit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailed_actionedit.lists["x_DepartmentCode"] = <?php echo $detailed_action_edit->DepartmentCode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($detailed_action_edit->DepartmentCode->lookupOptions()) ?>;
	fdetailed_actionedit.lists["x_SectionCode"] = <?php echo $detailed_action_edit->SectionCode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_SectionCode"].options = <?php echo JsonEncode($detailed_action_edit->SectionCode->lookupOptions()) ?>;
	fdetailed_actionedit.lists["x_ProgramCode"] = <?php echo $detailed_action_edit->ProgramCode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_ProgramCode"].options = <?php echo JsonEncode($detailed_action_edit->ProgramCode->lookupOptions()) ?>;
	fdetailed_actionedit.lists["x_SubProgramCode"] = <?php echo $detailed_action_edit->SubProgramCode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_SubProgramCode"].options = <?php echo JsonEncode($detailed_action_edit->SubProgramCode->lookupOptions()) ?>;
	fdetailed_actionedit.lists["x_OutcomeCode"] = <?php echo $detailed_action_edit->OutcomeCode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_OutcomeCode"].options = <?php echo JsonEncode($detailed_action_edit->OutcomeCode->lookupOptions()) ?>;
	fdetailed_actionedit.lists["x_OutputCode"] = <?php echo $detailed_action_edit->OutputCode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_OutputCode"].options = <?php echo JsonEncode($detailed_action_edit->OutputCode->lookupOptions()) ?>;
	fdetailed_actionedit.lists["x_ActionCode"] = <?php echo $detailed_action_edit->ActionCode->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_ActionCode"].options = <?php echo JsonEncode($detailed_action_edit->ActionCode->lookupOptions()) ?>;
	fdetailed_actionedit.lists["x_ProgressStatus"] = <?php echo $detailed_action_edit->ProgressStatus->Lookup->toClientList($detailed_action_edit) ?>;
	fdetailed_actionedit.lists["x_ProgressStatus"].options = <?php echo JsonEncode($detailed_action_edit->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fdetailed_actionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailed_action_edit->showPageHeader(); ?>
<?php
$detailed_action_edit->showMessage();
?>
<?php if (!$detailed_action_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailed_action_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdetailed_actionedit" id="fdetailed_actionedit" class="<?php echo $detailed_action_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailed_action">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailed_action_edit->IsModal ?>">
<?php if ($detailed_action->getCurrentMasterTable() == "_action") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="_action">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($detailed_action_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_edit->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($detailed_action_edit->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OucomeCode" value="<?php echo HtmlEncode($detailed_action_edit->OutcomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($detailed_action_edit->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ActionCode" value="<?php echo HtmlEncode($detailed_action_edit->ActionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($detailed_action_edit->FinancialYear->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailed_action_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_detailed_action_LACode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->LACode->caption() ?><?php echo $detailed_action_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->LACode->cellAttributes() ?>>
<?php if ($detailed_action_edit->LACode->getSessionValue() != "") { ?>
<span id="el_detailed_action_LACode">
<span<?php echo $detailed_action_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($detailed_action_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_LACode">
<?php
$onchange = $detailed_action_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailed_action_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($detailed_action_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($detailed_action_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailed_action_edit->LACode->getPlaceHolder()) ?>"<?php echo $detailed_action_edit->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_edit->LACode->ReadOnly || $detailed_action_edit->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($detailed_action_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailed_actionedit"], function() {
	fdetailed_actionedit.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $detailed_action_edit->LACode->Lookup->getParamTag($detailed_action_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $detailed_action_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_detailed_action_DepartmentCode" for="x_DepartmentCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->DepartmentCode->caption() ?><?php echo $detailed_action_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($detailed_action_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_DepartmentCode">
<span<?php echo $detailed_action_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($detailed_action_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_DepartmentCode">
<?php $detailed_action_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $detailed_action_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $detailed_action_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $detailed_action_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $detailed_action_edit->DepartmentCode->Lookup->getParamTag($detailed_action_edit, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $detailed_action_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_detailed_action_SectionCode" for="x_SectionCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->SectionCode->caption() ?><?php echo $detailed_action_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->SectionCode->cellAttributes() ?>>
<span id="el_detailed_action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_SectionCode" data-value-separator="<?php echo $detailed_action_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $detailed_action_edit->SectionCode->editAttributes() ?>>
			<?php echo $detailed_action_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $detailed_action_edit->SectionCode->Lookup->getParamTag($detailed_action_edit, "p_x_SectionCode") ?>
</span>
<?php echo $detailed_action_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_detailed_action_ProgramCode" for="x_ProgramCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->ProgramCode->caption() ?><?php echo $detailed_action_edit->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->ProgramCode->cellAttributes() ?>>
<?php if ($detailed_action_edit->ProgramCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_ProgramCode">
<span<?php echo $detailed_action_edit->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProgramCode" name="x_ProgramCode" value="<?php echo HtmlEncode($detailed_action_edit->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_ProgramCode">
<?php $detailed_action_edit->ProgramCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgramCode" data-value-separator="<?php echo $detailed_action_edit->ProgramCode->displayValueSeparatorAttribute() ?>" id="x_ProgramCode" name="x_ProgramCode"<?php echo $detailed_action_edit->ProgramCode->editAttributes() ?>>
			<?php echo $detailed_action_edit->ProgramCode->selectOptionListHtml("x_ProgramCode") ?>
		</select>
</div>
<?php echo $detailed_action_edit->ProgramCode->Lookup->getParamTag($detailed_action_edit, "p_x_ProgramCode") ?>
</span>
<?php } ?>
<?php echo $detailed_action_edit->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_detailed_action_SubProgramCode" for="x_SubProgramCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->SubProgramCode->caption() ?><?php echo $detailed_action_edit->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->SubProgramCode->cellAttributes() ?>>
<span id="el_detailed_action_SubProgramCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubProgramCode"><?php echo EmptyValue(strval($detailed_action_edit->SubProgramCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_edit->SubProgramCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_edit->SubProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_edit->SubProgramCode->ReadOnly || $detailed_action_edit->SubProgramCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubProgramCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_edit->SubProgramCode->Lookup->getParamTag($detailed_action_edit, "p_x_SubProgramCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_SubProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_edit->SubProgramCode->displayValueSeparatorAttribute() ?>" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo $detailed_action_edit->SubProgramCode->CurrentValue ?>"<?php echo $detailed_action_edit->SubProgramCode->editAttributes() ?>>
</span>
<?php echo $detailed_action_edit->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->OutcomeCode->Visible) { // OutcomeCode ?>
	<div id="r_OutcomeCode" class="form-group row">
		<label id="elh_detailed_action_OutcomeCode" for="x_OutcomeCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->OutcomeCode->caption() ?><?php echo $detailed_action_edit->OutcomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->OutcomeCode->cellAttributes() ?>>
<?php if ($detailed_action_edit->OutcomeCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_OutcomeCode">
<span<?php echo $detailed_action_edit->OutcomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->OutcomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutcomeCode" name="x_OutcomeCode" value="<?php echo HtmlEncode($detailed_action_edit->OutcomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_OutcomeCode">
<?php $detailed_action_edit->OutcomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutcomeCode"><?php echo EmptyValue(strval($detailed_action_edit->OutcomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_edit->OutcomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_edit->OutcomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_edit->OutcomeCode->ReadOnly || $detailed_action_edit->OutcomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutcomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_edit->OutcomeCode->Lookup->getParamTag($detailed_action_edit, "p_x_OutcomeCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutcomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_edit->OutcomeCode->displayValueSeparatorAttribute() ?>" name="x_OutcomeCode" id="x_OutcomeCode" value="<?php echo $detailed_action_edit->OutcomeCode->CurrentValue ?>"<?php echo $detailed_action_edit->OutcomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_edit->OutcomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_detailed_action_OutputCode" for="x_OutputCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->OutputCode->caption() ?><?php echo $detailed_action_edit->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->OutputCode->cellAttributes() ?>>
<?php if ($detailed_action_edit->OutputCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_OutputCode">
<span<?php echo $detailed_action_edit->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutputCode" name="x_OutputCode" value="<?php echo HtmlEncode($detailed_action_edit->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_OutputCode">
<?php $detailed_action_edit->OutputCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($detailed_action_edit->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_edit->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_edit->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_edit->OutputCode->ReadOnly || $detailed_action_edit->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_edit->OutputCode->Lookup->getParamTag($detailed_action_edit, "p_x_OutputCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_edit->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $detailed_action_edit->OutputCode->CurrentValue ?>"<?php echo $detailed_action_edit->OutputCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_edit->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label id="elh_detailed_action_ActionCode" for="x_ActionCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->ActionCode->caption() ?><?php echo $detailed_action_edit->ActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->ActionCode->cellAttributes() ?>>
<?php if ($detailed_action_edit->ActionCode->getSessionValue() != "") { ?>
<span id="el_detailed_action_ActionCode">
<span<?php echo $detailed_action_edit->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->ActionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ActionCode" name="x_ActionCode" value="<?php echo HtmlEncode($detailed_action_edit->ActionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_ActionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ActionCode"><?php echo EmptyValue(strval($detailed_action_edit->ActionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailed_action_edit->ActionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailed_action_edit->ActionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailed_action_edit->ActionCode->ReadOnly || $detailed_action_edit->ActionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ActionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailed_action_edit->ActionCode->Lookup->getParamTag($detailed_action_edit, "p_x_ActionCode") ?>
<input type="hidden" data-table="detailed_action" data-field="x_ActionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailed_action_edit->ActionCode->displayValueSeparatorAttribute() ?>" name="x_ActionCode" id="x_ActionCode" value="<?php echo $detailed_action_edit->ActionCode->CurrentValue ?>"<?php echo $detailed_action_edit->ActionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_edit->ActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_detailed_action_FinancialYear" for="x_FinancialYear" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->FinancialYear->caption() ?><?php echo $detailed_action_edit->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->FinancialYear->cellAttributes() ?>>
<?php if ($detailed_action_edit->FinancialYear->getSessionValue() != "") { ?>
<span id="el_detailed_action_FinancialYear">
<span<?php echo $detailed_action_edit->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_FinancialYear" name="x_FinancialYear" value="<?php echo HtmlEncode($detailed_action_edit->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailed_action_FinancialYear">
<input type="text" data-table="detailed_action" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($detailed_action_edit->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->FinancialYear->EditValue ?>"<?php echo $detailed_action_edit->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailed_action_edit->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<div id="r_DetailedActionCode" class="form-group row">
		<label id="elh_detailed_action_DetailedActionCode" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->DetailedActionCode->caption() ?><?php echo $detailed_action_edit->DetailedActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->DetailedActionCode->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionCode">
<span<?php echo $detailed_action_edit->DetailedActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailed_action_edit->DetailedActionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailed_action" data-field="x_DetailedActionCode" name="x_DetailedActionCode" id="x_DetailedActionCode" value="<?php echo HtmlEncode($detailed_action_edit->DetailedActionCode->CurrentValue) ?>">
<?php echo $detailed_action_edit->DetailedActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->DetailedActionName->Visible) { // DetailedActionName ?>
	<div id="r_DetailedActionName" class="form-group row">
		<label id="elh_detailed_action_DetailedActionName" for="x_DetailedActionName" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->DetailedActionName->caption() ?><?php echo $detailed_action_edit->DetailedActionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->DetailedActionName->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionName">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionName" name="x_DetailedActionName" id="x_DetailedActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_edit->DetailedActionName->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->DetailedActionName->EditValue ?>"<?php echo $detailed_action_edit->DetailedActionName->editAttributes() ?>>
</span>
<?php echo $detailed_action_edit->DetailedActionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
	<div id="r_DetailedActionLocation" class="form-group row">
		<label id="elh_detailed_action_DetailedActionLocation" for="x_DetailedActionLocation" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->DetailedActionLocation->caption() ?><?php echo $detailed_action_edit->DetailedActionLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->DetailedActionLocation->cellAttributes() ?>>
<span id="el_detailed_action_DetailedActionLocation">
<input type="text" data-table="detailed_action" data-field="x_DetailedActionLocation" name="x_DetailedActionLocation" id="x_DetailedActionLocation" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($detailed_action_edit->DetailedActionLocation->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->DetailedActionLocation->EditValue ?>"<?php echo $detailed_action_edit->DetailedActionLocation->editAttributes() ?>>
</span>
<?php echo $detailed_action_edit->DetailedActionLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_detailed_action_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->PlannedStartDate->caption() ?><?php echo $detailed_action_edit->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->PlannedStartDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedStartDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($detailed_action_edit->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->PlannedStartDate->EditValue ?>"<?php echo $detailed_action_edit->PlannedStartDate->editAttributes() ?>>
<?php if (!$detailed_action_edit->PlannedStartDate->ReadOnly && !$detailed_action_edit->PlannedStartDate->Disabled && !isset($detailed_action_edit->PlannedStartDate->EditAttrs["readonly"]) && !isset($detailed_action_edit->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionedit", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_edit->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_detailed_action_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->PlannedEndDate->caption() ?><?php echo $detailed_action_edit->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->PlannedEndDate->cellAttributes() ?>>
<span id="el_detailed_action_PlannedEndDate">
<input type="text" data-table="detailed_action" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" placeholder="<?php echo HtmlEncode($detailed_action_edit->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->PlannedEndDate->EditValue ?>"<?php echo $detailed_action_edit->PlannedEndDate->editAttributes() ?>>
<?php if (!$detailed_action_edit->PlannedEndDate->ReadOnly && !$detailed_action_edit->PlannedEndDate->Disabled && !isset($detailed_action_edit->PlannedEndDate->EditAttrs["readonly"]) && !isset($detailed_action_edit->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionedit", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_edit->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_detailed_action_ActualStartDate" for="x_ActualStartDate" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->ActualStartDate->caption() ?><?php echo $detailed_action_edit->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->ActualStartDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualStartDate">
<input type="text" data-table="detailed_action" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" placeholder="<?php echo HtmlEncode($detailed_action_edit->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->ActualStartDate->EditValue ?>"<?php echo $detailed_action_edit->ActualStartDate->editAttributes() ?>>
<?php if (!$detailed_action_edit->ActualStartDate->ReadOnly && !$detailed_action_edit->ActualStartDate->Disabled && !isset($detailed_action_edit->ActualStartDate->EditAttrs["readonly"]) && !isset($detailed_action_edit->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionedit", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_edit->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label id="elh_detailed_action_ActualEndDate" for="x_ActualEndDate" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->ActualEndDate->caption() ?><?php echo $detailed_action_edit->ActualEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->ActualEndDate->cellAttributes() ?>>
<span id="el_detailed_action_ActualEndDate">
<input type="text" data-table="detailed_action" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" placeholder="<?php echo HtmlEncode($detailed_action_edit->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->ActualEndDate->EditValue ?>"<?php echo $detailed_action_edit->ActualEndDate->editAttributes() ?>>
<?php if (!$detailed_action_edit->ActualEndDate->ReadOnly && !$detailed_action_edit->ActualEndDate->Disabled && !isset($detailed_action_edit->ActualEndDate->EditAttrs["readonly"]) && !isset($detailed_action_edit->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdetailed_actionedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fdetailed_actionedit", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $detailed_action_edit->ActualEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->Ward->Visible) { // Ward ?>
	<div id="r_Ward" class="form-group row">
		<label id="elh_detailed_action_Ward" for="x_Ward" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->Ward->caption() ?><?php echo $detailed_action_edit->Ward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->Ward->cellAttributes() ?>>
<span id="el_detailed_action_Ward">
<input type="text" data-table="detailed_action" data-field="x_Ward" name="x_Ward" id="x_Ward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($detailed_action_edit->Ward->getPlaceHolder()) ?>" value="<?php echo $detailed_action_edit->Ward->EditValue ?>"<?php echo $detailed_action_edit->Ward->editAttributes() ?>>
</span>
<?php echo $detailed_action_edit->Ward->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->ExpectedResult->Visible) { // ExpectedResult ?>
	<div id="r_ExpectedResult" class="form-group row">
		<label id="elh_detailed_action_ExpectedResult" for="x_ExpectedResult" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->ExpectedResult->caption() ?><?php echo $detailed_action_edit->ExpectedResult->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->ExpectedResult->cellAttributes() ?>>
<span id="el_detailed_action_ExpectedResult">
<textarea data-table="detailed_action" data-field="x_ExpectedResult" name="x_ExpectedResult" id="x_ExpectedResult" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_edit->ExpectedResult->getPlaceHolder()) ?>"<?php echo $detailed_action_edit->ExpectedResult->editAttributes() ?>><?php echo $detailed_action_edit->ExpectedResult->EditValue ?></textarea>
</span>
<?php echo $detailed_action_edit->ExpectedResult->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label id="elh_detailed_action_Comments" for="x_Comments" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->Comments->caption() ?><?php echo $detailed_action_edit->Comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->Comments->cellAttributes() ?>>
<span id="el_detailed_action_Comments">
<textarea data-table="detailed_action" data-field="x_Comments" name="x_Comments" id="x_Comments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($detailed_action_edit->Comments->getPlaceHolder()) ?>"<?php echo $detailed_action_edit->Comments->editAttributes() ?>><?php echo $detailed_action_edit->Comments->EditValue ?></textarea>
</span>
<?php echo $detailed_action_edit->Comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailed_action_edit->ProgressStatus->Visible) { // ProgressStatus ?>
	<div id="r_ProgressStatus" class="form-group row">
		<label id="elh_detailed_action_ProgressStatus" for="x_ProgressStatus" class="<?php echo $detailed_action_edit->LeftColumnClass ?>"><?php echo $detailed_action_edit->ProgressStatus->caption() ?><?php echo $detailed_action_edit->ProgressStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailed_action_edit->RightColumnClass ?>"><div <?php echo $detailed_action_edit->ProgressStatus->cellAttributes() ?>>
<span id="el_detailed_action_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailed_action" data-field="x_ProgressStatus" data-value-separator="<?php echo $detailed_action_edit->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x_ProgressStatus" name="x_ProgressStatus"<?php echo $detailed_action_edit->ProgressStatus->editAttributes() ?>>
			<?php echo $detailed_action_edit->ProgressStatus->selectOptionListHtml("x_ProgressStatus") ?>
		</select>
</div>
<?php echo $detailed_action_edit->ProgressStatus->Lookup->getParamTag($detailed_action_edit, "p_x_ProgressStatus") ?>
</span>
<?php echo $detailed_action_edit->ProgressStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("budget", explode(",", $detailed_action->getCurrentDetailTable())) && $budget->DetailEdit) {
?>
<?php if ($detailed_action->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("budget", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "budgetgrid.php" ?>
<?php } ?>
<?php if (!$detailed_action_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailed_action_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailed_action_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$detailed_action_edit->IsModal) { ?>
<?php echo $detailed_action_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$detailed_action_edit->showPageFooter();
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
$detailed_action_edit->terminate();
?>