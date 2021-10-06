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
$_action_edit = new _action_edit();

// Run the page
$_action_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_actionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	f_actionedit = currentForm = new ew.Form("f_actionedit", "edit");

	// Validate form
	f_actionedit.validate = function() {
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
			<?php if ($_action_edit->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->ProgramCode->caption(), $_action_edit->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->OucomeCode->caption(), $_action_edit->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_edit->OucomeCode->errorMessage()) ?>");
			<?php if ($_action_edit->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->OutputCode->caption(), $_action_edit->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_edit->OutputCode->errorMessage()) ?>");
			<?php if ($_action_edit->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->ProjectCode->caption(), $_action_edit->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->ActionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->ActionCode->caption(), $_action_edit->ActionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->ActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->ActionName->caption(), $_action_edit->ActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->ActionType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->ActionType->caption(), $_action_edit->ActionType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->FinancialYear->caption(), $_action_edit->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_edit->FinancialYear->errorMessage()) ?>");
			<?php if ($_action_edit->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->ExpectedAnnualAchievement->caption(), $_action_edit->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->ActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->ActionLocation->caption(), $_action_edit->ActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->Latitude->caption(), $_action_edit->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_edit->Latitude->errorMessage()) ?>");
			<?php if ($_action_edit->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->Longitude->caption(), $_action_edit->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_edit->Longitude->errorMessage()) ?>");
			<?php if ($_action_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->LACode->caption(), $_action_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->DepartmentCode->caption(), $_action_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_edit->SectionCode->caption(), $_action_edit->SectionCode->RequiredErrorMessage)) ?>");
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
	f_actionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_actionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_actionedit.lists["x_ProgramCode"] = <?php echo $_action_edit->ProgramCode->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_ProgramCode"].options = <?php echo JsonEncode($_action_edit->ProgramCode->lookupOptions()) ?>;
	f_actionedit.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionedit.lists["x_OucomeCode"] = <?php echo $_action_edit->OucomeCode->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_OucomeCode"].options = <?php echo JsonEncode($_action_edit->OucomeCode->lookupOptions()) ?>;
	f_actionedit.autoSuggests["x_OucomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionedit.lists["x_OutputCode"] = <?php echo $_action_edit->OutputCode->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_OutputCode"].options = <?php echo JsonEncode($_action_edit->OutputCode->lookupOptions()) ?>;
	f_actionedit.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionedit.lists["x_ProjectCode"] = <?php echo $_action_edit->ProjectCode->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_ProjectCode"].options = <?php echo JsonEncode($_action_edit->ProjectCode->lookupOptions()) ?>;
	f_actionedit.lists["x_ActionType"] = <?php echo $_action_edit->ActionType->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_ActionType"].options = <?php echo JsonEncode($_action_edit->ActionType->lookupOptions()) ?>;
	f_actionedit.lists["x_LACode"] = <?php echo $_action_edit->LACode->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_LACode"].options = <?php echo JsonEncode($_action_edit->LACode->lookupOptions()) ?>;
	f_actionedit.lists["x_DepartmentCode"] = <?php echo $_action_edit->DepartmentCode->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($_action_edit->DepartmentCode->lookupOptions()) ?>;
	f_actionedit.lists["x_SectionCode"] = <?php echo $_action_edit->SectionCode->Lookup->toClientList($_action_edit) ?>;
	f_actionedit.lists["x_SectionCode"].options = <?php echo JsonEncode($_action_edit->SectionCode->lookupOptions()) ?>;
	loadjs.done("f_actionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_action_edit->showPageHeader(); ?>
<?php
$_action_edit->showMessage();
?>
<?php if (!$_action_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_action_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="f_actionedit" id="f_actionedit" class="<?php echo $_action_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_action">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$_action_edit->IsModal ?>">
<?php if ($_action->getCurrentMasterTable() == "output") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="output">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($_action_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($_action_edit->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($_action_edit->OucomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($_action_edit->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($_action_edit->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($_action_edit->FinancialYear->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($_action_edit->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh__action_ProgramCode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->ProgramCode->caption() ?><?php echo $_action_edit->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->ProgramCode->cellAttributes() ?>>
<?php if ($_action_edit->ProgramCode->getSessionValue() != "") { ?>
<span id="el__action_ProgramCode">
<span<?php echo $_action_edit->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_edit->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProgramCode" name="x_ProgramCode" value="<?php echo HtmlEncode($_action_edit->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_ProgramCode">
<?php
$onchange = $_action_edit->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_edit->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($_action_edit->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_edit->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_edit->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_edit->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_edit->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_edit->ProgramCode->ReadOnly || $_action_edit->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_edit->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($_action_edit->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionedit"], function() {
	f_actionedit.createAutoSuggest({"id":"x_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_edit->ProgramCode->Lookup->getParamTag($_action_edit, "p_x_ProgramCode") ?>
</span>
<?php } ?>
<?php echo $_action_edit->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->OucomeCode->Visible) { // OucomeCode ?>
	<div id="r_OucomeCode" class="form-group row">
		<label id="elh__action_OucomeCode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->OucomeCode->caption() ?><?php echo $_action_edit->OucomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->OucomeCode->cellAttributes() ?>>
<?php if ($_action_edit->OucomeCode->getSessionValue() != "") { ?>
<span id="el__action_OucomeCode">
<span<?php echo $_action_edit->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_edit->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OucomeCode" name="x_OucomeCode" value="<?php echo HtmlEncode($_action_edit->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_OucomeCode">
<?php
$onchange = $_action_edit->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_edit->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_OucomeCode" id="sv_x_OucomeCode" value="<?php echo RemoveHtml($_action_edit->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_edit->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_edit->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_edit->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_edit->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_edit->OucomeCode->ReadOnly || $_action_edit->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_edit->OucomeCode->displayValueSeparatorAttribute() ?>" name="x_OucomeCode" id="x_OucomeCode" value="<?php echo HtmlEncode($_action_edit->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionedit"], function() {
	f_actionedit.createAutoSuggest({"id":"x_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_edit->OucomeCode->Lookup->getParamTag($_action_edit, "p_x_OucomeCode") ?>
</span>
<?php } ?>
<?php echo $_action_edit->OucomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh__action_OutputCode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->OutputCode->caption() ?><?php echo $_action_edit->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->OutputCode->cellAttributes() ?>>
<?php if ($_action_edit->OutputCode->getSessionValue() != "") { ?>
<span id="el__action_OutputCode">
<span<?php echo $_action_edit->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_edit->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutputCode" name="x_OutputCode" value="<?php echo HtmlEncode($_action_edit->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_OutputCode">
<?php
$onchange = $_action_edit->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_edit->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_OutputCode" id="sv_x_OutputCode" value="<?php echo RemoveHtml($_action_edit->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_edit->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_edit->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_edit->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_edit->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_edit->OutputCode->ReadOnly || $_action_edit->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_edit->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo HtmlEncode($_action_edit->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionedit"], function() {
	f_actionedit.createAutoSuggest({"id":"x_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_edit->OutputCode->Lookup->getParamTag($_action_edit, "p_x_OutputCode") ?>
</span>
<?php } ?>
<?php echo $_action_edit->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh__action_ProjectCode" for="x_ProjectCode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->ProjectCode->caption() ?><?php echo $_action_edit->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->ProjectCode->cellAttributes() ?>>
<span id="el__action_ProjectCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProjectCode"><?php echo EmptyValue(strval($_action_edit->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_edit->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_edit->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_edit->ProjectCode->ReadOnly || $_action_edit->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_edit->ProjectCode->Lookup->getParamTag($_action_edit, "p_x_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_edit->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo $_action_edit->ProjectCode->CurrentValue ?>"<?php echo $_action_edit->ProjectCode->editAttributes() ?>>
</span>
<?php echo $_action_edit->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->ActionCode->Visible) { // ActionCode ?>
	<div id="r_ActionCode" class="form-group row">
		<label id="elh__action_ActionCode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->ActionCode->caption() ?><?php echo $_action_edit->ActionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->ActionCode->cellAttributes() ?>>
<span id="el__action_ActionCode">
<span<?php echo $_action_edit->ActionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_edit->ActionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="_action" data-field="x_ActionCode" name="x_ActionCode" id="x_ActionCode" value="<?php echo HtmlEncode($_action_edit->ActionCode->CurrentValue) ?>">
<?php echo $_action_edit->ActionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->ActionName->Visible) { // ActionName ?>
	<div id="r_ActionName" class="form-group row">
		<label id="elh__action_ActionName" for="x_ActionName" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->ActionName->caption() ?><?php echo $_action_edit->ActionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->ActionName->cellAttributes() ?>>
<span id="el__action_ActionName">
<input type="text" data-table="_action" data-field="x_ActionName" name="x_ActionName" id="x_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_edit->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_edit->ActionName->EditValue ?>"<?php echo $_action_edit->ActionName->editAttributes() ?>>
</span>
<?php echo $_action_edit->ActionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->ActionType->Visible) { // ActionType ?>
	<div id="r_ActionType" class="form-group row">
		<label id="elh__action_ActionType" for="x_ActionType" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->ActionType->caption() ?><?php echo $_action_edit->ActionType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->ActionType->cellAttributes() ?>>
<span id="el__action_ActionType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_edit->ActionType->displayValueSeparatorAttribute() ?>" id="x_ActionType" name="x_ActionType"<?php echo $_action_edit->ActionType->editAttributes() ?>>
			<?php echo $_action_edit->ActionType->selectOptionListHtml("x_ActionType") ?>
		</select>
</div>
<?php echo $_action_edit->ActionType->Lookup->getParamTag($_action_edit, "p_x_ActionType") ?>
</span>
<?php echo $_action_edit->ActionType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh__action_FinancialYear" for="x_FinancialYear" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->FinancialYear->caption() ?><?php echo $_action_edit->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->FinancialYear->cellAttributes() ?>>
<?php if ($_action_edit->FinancialYear->getSessionValue() != "") { ?>

<span id="el__action_FinancialYear">
<span<?php echo $_action_edit->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_edit->FinancialYear->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_FinancialYear" name="x_FinancialYear" value="<?php echo HtmlEncode($_action_edit->FinancialYear->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="_action" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_edit->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_edit->FinancialYear->EditValue ?>"<?php echo $_action_edit->FinancialYear->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="_action" data-field="x_FinancialYear" name="o_FinancialYear" id="o_FinancialYear" value="<?php echo HtmlEncode($_action_edit->FinancialYear->OldValue != null ? $_action_edit->FinancialYear->OldValue : $_action_edit->FinancialYear->CurrentValue) ?>">
<?php echo $_action_edit->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<div id="r_ExpectedAnnualAchievement" class="form-group row">
		<label id="elh__action_ExpectedAnnualAchievement" for="x_ExpectedAnnualAchievement" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->ExpectedAnnualAchievement->caption() ?><?php echo $_action_edit->ExpectedAnnualAchievement->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el__action_ExpectedAnnualAchievement">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x_ExpectedAnnualAchievement" id="x_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_edit->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_edit->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_edit->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php echo $_action_edit->ExpectedAnnualAchievement->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->ActionLocation->Visible) { // ActionLocation ?>
	<div id="r_ActionLocation" class="form-group row">
		<label id="elh__action_ActionLocation" for="x_ActionLocation" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->ActionLocation->caption() ?><?php echo $_action_edit->ActionLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->ActionLocation->cellAttributes() ?>>
<span id="el__action_ActionLocation">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x_ActionLocation" id="x_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_edit->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_edit->ActionLocation->EditValue ?>"<?php echo $_action_edit->ActionLocation->editAttributes() ?>>
</span>
<?php echo $_action_edit->ActionLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh__action_Latitude" for="x_Latitude" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->Latitude->caption() ?><?php echo $_action_edit->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->Latitude->cellAttributes() ?>>
<span id="el__action_Latitude">
<input type="text" data-table="_action" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_edit->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_edit->Latitude->EditValue ?>"<?php echo $_action_edit->Latitude->editAttributes() ?>>
</span>
<?php echo $_action_edit->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh__action_Longitude" for="x_Longitude" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->Longitude->caption() ?><?php echo $_action_edit->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->Longitude->cellAttributes() ?>>
<span id="el__action_Longitude">
<input type="text" data-table="_action" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_edit->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_edit->Longitude->EditValue ?>"<?php echo $_action_edit->Longitude->editAttributes() ?>>
</span>
<?php echo $_action_edit->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh__action_LACode" for="x_LACode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->LACode->caption() ?><?php echo $_action_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->LACode->cellAttributes() ?>>
<?php if ($_action_edit->LACode->getSessionValue() != "") { ?>
<span id="el__action_LACode">
<span<?php echo $_action_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($_action_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_LACode">
<?php $_action_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($_action_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_edit->LACode->ReadOnly || $_action_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_edit->LACode->Lookup->getParamTag($_action_edit, "p_x_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $_action_edit->LACode->CurrentValue ?>"<?php echo $_action_edit->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $_action_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh__action_DepartmentCode" for="x_DepartmentCode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->DepartmentCode->caption() ?><?php echo $_action_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($_action_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el__action_DepartmentCode">
<span<?php echo $_action_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($_action_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_DepartmentCode">
<?php $_action_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $_action_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_edit->DepartmentCode->Lookup->getParamTag($_action_edit, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $_action_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh__action_SectionCode" for="x_SectionCode" class="<?php echo $_action_edit->LeftColumnClass ?>"><?php echo $_action_edit->SectionCode->caption() ?><?php echo $_action_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_edit->RightColumnClass ?>"><div <?php echo $_action_edit->SectionCode->cellAttributes() ?>>
<span id="el__action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $_action_edit->SectionCode->editAttributes() ?>>
			<?php echo $_action_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $_action_edit->SectionCode->Lookup->getParamTag($_action_edit, "p_x_SectionCode") ?>
</span>
<?php echo $_action_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailed_action", explode(",", $_action->getCurrentDetailTable())) && $detailed_action->DetailEdit) {
?>
<?php if ($_action->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailed_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailed_actiongrid.php" ?>
<?php } ?>
<?php if (!$_action_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_action_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $_action_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$_action_edit->IsModal) { ?>
<?php echo $_action_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$_action_edit->showPageFooter();
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
$_action_edit->terminate();
?>