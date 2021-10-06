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
$_action_add = new _action_add();

// Run the page
$_action_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_actionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	f_actionadd = currentForm = new ew.Form("f_actionadd", "add");

	// Validate form
	f_actionadd.validate = function() {
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
			<?php if ($_action_add->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->ProgramCode->caption(), $_action_add->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->OucomeCode->caption(), $_action_add->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_add->OucomeCode->errorMessage()) ?>");
			<?php if ($_action_add->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->OutputCode->caption(), $_action_add->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_add->OutputCode->errorMessage()) ?>");
			<?php if ($_action_add->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->ProjectCode->caption(), $_action_add->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->ActionName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->ActionName->caption(), $_action_add->ActionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->ActionType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->ActionType->caption(), $_action_add->ActionType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->FinancialYear->caption(), $_action_add->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_add->FinancialYear->errorMessage()) ?>");
			<?php if ($_action_add->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->ExpectedAnnualAchievement->caption(), $_action_add->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->ActionLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->ActionLocation->caption(), $_action_add->ActionLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->Latitude->caption(), $_action_add->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_add->Latitude->errorMessage()) ?>");
			<?php if ($_action_add->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->Longitude->caption(), $_action_add->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_action_add->Longitude->errorMessage()) ?>");
			<?php if ($_action_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->LACode->caption(), $_action_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->DepartmentCode->caption(), $_action_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_action_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_action_add->SectionCode->caption(), $_action_add->SectionCode->RequiredErrorMessage)) ?>");
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
	f_actionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_actionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_actionadd.lists["x_ProgramCode"] = <?php echo $_action_add->ProgramCode->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_ProgramCode"].options = <?php echo JsonEncode($_action_add->ProgramCode->lookupOptions()) ?>;
	f_actionadd.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionadd.lists["x_OucomeCode"] = <?php echo $_action_add->OucomeCode->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_OucomeCode"].options = <?php echo JsonEncode($_action_add->OucomeCode->lookupOptions()) ?>;
	f_actionadd.autoSuggests["x_OucomeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionadd.lists["x_OutputCode"] = <?php echo $_action_add->OutputCode->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_OutputCode"].options = <?php echo JsonEncode($_action_add->OutputCode->lookupOptions()) ?>;
	f_actionadd.autoSuggests["x_OutputCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_actionadd.lists["x_ProjectCode"] = <?php echo $_action_add->ProjectCode->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_ProjectCode"].options = <?php echo JsonEncode($_action_add->ProjectCode->lookupOptions()) ?>;
	f_actionadd.lists["x_ActionType"] = <?php echo $_action_add->ActionType->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_ActionType"].options = <?php echo JsonEncode($_action_add->ActionType->lookupOptions()) ?>;
	f_actionadd.lists["x_LACode"] = <?php echo $_action_add->LACode->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_LACode"].options = <?php echo JsonEncode($_action_add->LACode->lookupOptions()) ?>;
	f_actionadd.lists["x_DepartmentCode"] = <?php echo $_action_add->DepartmentCode->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($_action_add->DepartmentCode->lookupOptions()) ?>;
	f_actionadd.lists["x_SectionCode"] = <?php echo $_action_add->SectionCode->Lookup->toClientList($_action_add) ?>;
	f_actionadd.lists["x_SectionCode"].options = <?php echo JsonEncode($_action_add->SectionCode->lookupOptions()) ?>;
	loadjs.done("f_actionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_action_add->showPageHeader(); ?>
<?php
$_action_add->showMessage();
?>
<form name="f_actionadd" id="f_actionadd" class="<?php echo $_action_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_action">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$_action_add->IsModal ?>">
<?php if ($_action->getCurrentMasterTable() == "output") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="output">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($_action_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($_action_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutcomeCode" value="<?php echo HtmlEncode($_action_add->OucomeCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($_action_add->ProgramCode->getSessionValue()) ?>">
<input type="hidden" name="fk_OutputCode" value="<?php echo HtmlEncode($_action_add->OutputCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FinancialYear" value="<?php echo HtmlEncode($_action_add->FinancialYear->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($_action_add->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh__action_ProgramCode" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->ProgramCode->caption() ?><?php echo $_action_add->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->ProgramCode->cellAttributes() ?>>
<?php if ($_action_add->ProgramCode->getSessionValue() != "") { ?>
<span id="el__action_ProgramCode">
<span<?php echo $_action_add->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_add->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProgramCode" name="x_ProgramCode" value="<?php echo HtmlEncode($_action_add->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_ProgramCode">
<?php
$onchange = $_action_add->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_add->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($_action_add->ProgramCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($_action_add->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_add->ProgramCode->getPlaceHolder()) ?>"<?php echo $_action_add->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_add->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_add->ProgramCode->ReadOnly || $_action_add->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_add->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($_action_add->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionadd"], function() {
	f_actionadd.createAutoSuggest({"id":"x_ProgramCode","forceSelect":false});
});
</script>
<?php echo $_action_add->ProgramCode->Lookup->getParamTag($_action_add, "p_x_ProgramCode") ?>
</span>
<?php } ?>
<?php echo $_action_add->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->OucomeCode->Visible) { // OucomeCode ?>
	<div id="r_OucomeCode" class="form-group row">
		<label id="elh__action_OucomeCode" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->OucomeCode->caption() ?><?php echo $_action_add->OucomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->OucomeCode->cellAttributes() ?>>
<?php if ($_action_add->OucomeCode->getSessionValue() != "") { ?>
<span id="el__action_OucomeCode">
<span<?php echo $_action_add->OucomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_add->OucomeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OucomeCode" name="x_OucomeCode" value="<?php echo HtmlEncode($_action_add->OucomeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_OucomeCode">
<?php
$onchange = $_action_add->OucomeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_add->OucomeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OucomeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_OucomeCode" id="sv_x_OucomeCode" value="<?php echo RemoveHtml($_action_add->OucomeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_add->OucomeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_add->OucomeCode->getPlaceHolder()) ?>"<?php echo $_action_add->OucomeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_add->OucomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_OucomeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_add->OucomeCode->ReadOnly || $_action_add->OucomeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OucomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_add->OucomeCode->displayValueSeparatorAttribute() ?>" name="x_OucomeCode" id="x_OucomeCode" value="<?php echo HtmlEncode($_action_add->OucomeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionadd"], function() {
	f_actionadd.createAutoSuggest({"id":"x_OucomeCode","forceSelect":false});
});
</script>
<?php echo $_action_add->OucomeCode->Lookup->getParamTag($_action_add, "p_x_OucomeCode") ?>
</span>
<?php } ?>
<?php echo $_action_add->OucomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh__action_OutputCode" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->OutputCode->caption() ?><?php echo $_action_add->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->OutputCode->cellAttributes() ?>>
<?php if ($_action_add->OutputCode->getSessionValue() != "") { ?>
<span id="el__action_OutputCode">
<span<?php echo $_action_add->OutputCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_add->OutputCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_OutputCode" name="x_OutputCode" value="<?php echo HtmlEncode($_action_add->OutputCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_OutputCode">
<?php
$onchange = $_action_add->OutputCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_action_add->OutputCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_OutputCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_OutputCode" id="sv_x_OutputCode" value="<?php echo RemoveHtml($_action_add->OutputCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_action_add->OutputCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_action_add->OutputCode->getPlaceHolder()) ?>"<?php echo $_action_add->OutputCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_add->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_action_add->OutputCode->ReadOnly || $_action_add->OutputCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_action" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_add->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo HtmlEncode($_action_add->OutputCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_actionadd"], function() {
	f_actionadd.createAutoSuggest({"id":"x_OutputCode","forceSelect":false});
});
</script>
<?php echo $_action_add->OutputCode->Lookup->getParamTag($_action_add, "p_x_OutputCode") ?>
</span>
<?php } ?>
<?php echo $_action_add->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh__action_ProjectCode" for="x_ProjectCode" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->ProjectCode->caption() ?><?php echo $_action_add->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->ProjectCode->cellAttributes() ?>>
<span id="el__action_ProjectCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProjectCode"><?php echo EmptyValue(strval($_action_add->ProjectCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_add->ProjectCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_add->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_add->ProjectCode->ReadOnly || $_action_add->ProjectCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_add->ProjectCode->Lookup->getParamTag($_action_add, "p_x_ProjectCode") ?>
<input type="hidden" data-table="_action" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_add->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo $_action_add->ProjectCode->CurrentValue ?>"<?php echo $_action_add->ProjectCode->editAttributes() ?>>
</span>
<?php echo $_action_add->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->ActionName->Visible) { // ActionName ?>
	<div id="r_ActionName" class="form-group row">
		<label id="elh__action_ActionName" for="x_ActionName" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->ActionName->caption() ?><?php echo $_action_add->ActionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->ActionName->cellAttributes() ?>>
<span id="el__action_ActionName">
<input type="text" data-table="_action" data-field="x_ActionName" name="x_ActionName" id="x_ActionName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_add->ActionName->getPlaceHolder()) ?>" value="<?php echo $_action_add->ActionName->EditValue ?>"<?php echo $_action_add->ActionName->editAttributes() ?>>
</span>
<?php echo $_action_add->ActionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->ActionType->Visible) { // ActionType ?>
	<div id="r_ActionType" class="form-group row">
		<label id="elh__action_ActionType" for="x_ActionType" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->ActionType->caption() ?><?php echo $_action_add->ActionType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->ActionType->cellAttributes() ?>>
<span id="el__action_ActionType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_ActionType" data-value-separator="<?php echo $_action_add->ActionType->displayValueSeparatorAttribute() ?>" id="x_ActionType" name="x_ActionType"<?php echo $_action_add->ActionType->editAttributes() ?>>
			<?php echo $_action_add->ActionType->selectOptionListHtml("x_ActionType") ?>
		</select>
</div>
<?php echo $_action_add->ActionType->Lookup->getParamTag($_action_add, "p_x_ActionType") ?>
</span>
<?php echo $_action_add->ActionType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh__action_FinancialYear" for="x_FinancialYear" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->FinancialYear->caption() ?><?php echo $_action_add->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->FinancialYear->cellAttributes() ?>>
<?php if ($_action_add->FinancialYear->getSessionValue() != "") { ?>
<span id="el__action_FinancialYear">
<span<?php echo $_action_add->FinancialYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_add->FinancialYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_FinancialYear" name="x_FinancialYear" value="<?php echo HtmlEncode($_action_add->FinancialYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_FinancialYear">
<input type="text" data-table="_action" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" placeholder="<?php echo HtmlEncode($_action_add->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $_action_add->FinancialYear->EditValue ?>"<?php echo $_action_add->FinancialYear->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $_action_add->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<div id="r_ExpectedAnnualAchievement" class="form-group row">
		<label id="elh__action_ExpectedAnnualAchievement" for="x_ExpectedAnnualAchievement" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->ExpectedAnnualAchievement->caption() ?><?php echo $_action_add->ExpectedAnnualAchievement->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el__action_ExpectedAnnualAchievement">
<input type="text" data-table="_action" data-field="x_ExpectedAnnualAchievement" name="x_ExpectedAnnualAchievement" id="x_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($_action_add->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $_action_add->ExpectedAnnualAchievement->EditValue ?>"<?php echo $_action_add->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php echo $_action_add->ExpectedAnnualAchievement->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->ActionLocation->Visible) { // ActionLocation ?>
	<div id="r_ActionLocation" class="form-group row">
		<label id="elh__action_ActionLocation" for="x_ActionLocation" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->ActionLocation->caption() ?><?php echo $_action_add->ActionLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->ActionLocation->cellAttributes() ?>>
<span id="el__action_ActionLocation">
<input type="text" data-table="_action" data-field="x_ActionLocation" name="x_ActionLocation" id="x_ActionLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_action_add->ActionLocation->getPlaceHolder()) ?>" value="<?php echo $_action_add->ActionLocation->EditValue ?>"<?php echo $_action_add->ActionLocation->editAttributes() ?>>
</span>
<?php echo $_action_add->ActionLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh__action_Latitude" for="x_Latitude" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->Latitude->caption() ?><?php echo $_action_add->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->Latitude->cellAttributes() ?>>
<span id="el__action_Latitude">
<input type="text" data-table="_action" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($_action_add->Latitude->getPlaceHolder()) ?>" value="<?php echo $_action_add->Latitude->EditValue ?>"<?php echo $_action_add->Latitude->editAttributes() ?>>
</span>
<?php echo $_action_add->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh__action_Longitude" for="x_Longitude" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->Longitude->caption() ?><?php echo $_action_add->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->Longitude->cellAttributes() ?>>
<span id="el__action_Longitude">
<input type="text" data-table="_action" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($_action_add->Longitude->getPlaceHolder()) ?>" value="<?php echo $_action_add->Longitude->EditValue ?>"<?php echo $_action_add->Longitude->editAttributes() ?>>
</span>
<?php echo $_action_add->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh__action_LACode" for="x_LACode" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->LACode->caption() ?><?php echo $_action_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->LACode->cellAttributes() ?>>
<?php if ($_action_add->LACode->getSessionValue() != "") { ?>
<span id="el__action_LACode">
<span<?php echo $_action_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($_action_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_LACode">
<?php $_action_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($_action_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $_action_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_action_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($_action_add->LACode->ReadOnly || $_action_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $_action_add->LACode->Lookup->getParamTag($_action_add, "p_x_LACode") ?>
<input type="hidden" data-table="_action" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_action_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $_action_add->LACode->CurrentValue ?>"<?php echo $_action_add->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $_action_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh__action_DepartmentCode" for="x_DepartmentCode" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->DepartmentCode->caption() ?><?php echo $_action_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->DepartmentCode->cellAttributes() ?>>
<?php if ($_action_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el__action_DepartmentCode">
<span<?php echo $_action_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_action_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($_action_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el__action_DepartmentCode">
<?php $_action_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_DepartmentCode" data-value-separator="<?php echo $_action_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $_action_add->DepartmentCode->editAttributes() ?>>
			<?php echo $_action_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $_action_add->DepartmentCode->Lookup->getParamTag($_action_add, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $_action_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($_action_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh__action_SectionCode" for="x_SectionCode" class="<?php echo $_action_add->LeftColumnClass ?>"><?php echo $_action_add->SectionCode->caption() ?><?php echo $_action_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $_action_add->RightColumnClass ?>"><div <?php echo $_action_add->SectionCode->cellAttributes() ?>>
<span id="el__action_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="_action" data-field="x_SectionCode" data-value-separator="<?php echo $_action_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $_action_add->SectionCode->editAttributes() ?>>
			<?php echo $_action_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $_action_add->SectionCode->Lookup->getParamTag($_action_add, "p_x_SectionCode") ?>
</span>
<?php echo $_action_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailed_action", explode(",", $_action->getCurrentDetailTable())) && $detailed_action->DetailAdd) {
?>
<?php if ($_action->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailed_action", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailed_actiongrid.php" ?>
<?php } ?>
<?php if (!$_action_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_action_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $_action_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_action_add->showPageFooter();
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
$_action_add->terminate();
?>