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
$activity_edit = new activity_edit();

// Run the page
$activity_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var factivityedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	factivityedit = currentForm = new ew.Form("factivityedit", "edit");

	// Validate form
	factivityedit.validate = function() {
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
			<?php if ($activity_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->ProvinceCode->caption(), $activity_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->LACode->caption(), $activity_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->DepartmentCode->caption(), $activity_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->SectionCode->caption(), $activity_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->ProgrammeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->ProgrammeCode->caption(), $activity_edit->ProgrammeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->OucomeCode->caption(), $activity_edit->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->OutputCode->caption(), $activity_edit->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->ProjectCode->caption(), $activity_edit->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->ActivityCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->ActivityCode->caption(), $activity_edit->ActivityCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->FinancialYear->caption(), $activity_edit->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->ActivityName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->ActivityName->caption(), $activity_edit->ActivityName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->MTEFBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->MTEFBudget->caption(), $activity_edit->MTEFBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_edit->MTEFBudget->errorMessage()) ?>");
			<?php if ($activity_edit->SupplementaryBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->SupplementaryBudget->caption(), $activity_edit->SupplementaryBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_edit->SupplementaryBudget->errorMessage()) ?>");
			<?php if ($activity_edit->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->ExpectedAnnualAchievement->caption(), $activity_edit->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_edit->ActivityLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_edit->ActivityLocation->caption(), $activity_edit->ActivityLocation->RequiredErrorMessage)) ?>");
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
	factivityedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	factivityedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	factivityedit.lists["x_ProvinceCode"] = <?php echo $activity_edit->ProvinceCode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($activity_edit->ProvinceCode->lookupOptions()) ?>;
	factivityedit.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivityedit.lists["x_LACode"] = <?php echo $activity_edit->LACode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_LACode"].options = <?php echo JsonEncode($activity_edit->LACode->lookupOptions()) ?>;
	factivityedit.lists["x_DepartmentCode"] = <?php echo $activity_edit->DepartmentCode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($activity_edit->DepartmentCode->lookupOptions()) ?>;
	factivityedit.lists["x_SectionCode"] = <?php echo $activity_edit->SectionCode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_SectionCode"].options = <?php echo JsonEncode($activity_edit->SectionCode->lookupOptions()) ?>;
	factivityedit.lists["x_ProgrammeCode"] = <?php echo $activity_edit->ProgrammeCode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_ProgrammeCode"].options = <?php echo JsonEncode($activity_edit->ProgrammeCode->lookupOptions()) ?>;
	factivityedit.autoSuggests["x_ProgrammeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivityedit.lists["x_OucomeCode"] = <?php echo $activity_edit->OucomeCode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_OucomeCode"].options = <?php echo JsonEncode($activity_edit->OucomeCode->lookupOptions()) ?>;
	factivityedit.lists["x_OutputCode"] = <?php echo $activity_edit->OutputCode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_OutputCode"].options = <?php echo JsonEncode($activity_edit->OutputCode->lookupOptions()) ?>;
	factivityedit.lists["x_ProjectCode"] = <?php echo $activity_edit->ProjectCode->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_ProjectCode"].options = <?php echo JsonEncode($activity_edit->ProjectCode->lookupOptions()) ?>;
	factivityedit.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivityedit.lists["x_FinancialYear"] = <?php echo $activity_edit->FinancialYear->Lookup->toClientList($activity_edit) ?>;
	factivityedit.lists["x_FinancialYear"].options = <?php echo JsonEncode($activity_edit->FinancialYear->lookupOptions()) ?>;
	loadjs.done("factivityedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $activity_edit->showPageHeader(); ?>
<?php
$activity_edit->showMessage();
?>
<?php if (!$activity_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $activity_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="factivityedit" id="factivityedit" class="<?php echo $activity_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="activity">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$activity_edit->IsModal ?>">
<?php if ($activity->getCurrentMasterTable() == "project") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="project">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($activity_edit->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($activity_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($activity_edit->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($activity_edit->SectionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProjectCode" value="<?php echo HtmlEncode($activity_edit->ProjectCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($activity_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_activity_ProvinceCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->ProvinceCode->caption() ?><?php echo $activity_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($activity_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_activity_ProvinceCode">
<span<?php echo $activity_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($activity_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_ProvinceCode">
<?php
$onchange = $activity_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_edit->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($activity_edit->ProvinceCode->EditValue) ?>" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($activity_edit->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_edit->ProvinceCode->getPlaceHolder()) ?>"<?php echo $activity_edit->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="activity" data-field="x_ProvinceCode" data-value-separator="<?php echo $activity_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($activity_edit->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivityedit"], function() {
	factivityedit.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $activity_edit->ProvinceCode->Lookup->getParamTag($activity_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $activity_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_activity_LACode" for="x_LACode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->LACode->caption() ?><?php echo $activity_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->LACode->cellAttributes() ?>>
<?php if ($activity_edit->LACode->getSessionValue() != "") { ?>
<span id="el_activity_LACode">
<span<?php echo $activity_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($activity_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_LACode">
<?php $activity_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($activity_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_edit->LACode->ReadOnly || $activity_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_edit->LACode->Lookup->getParamTag($activity_edit, "p_x_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $activity_edit->LACode->CurrentValue ?>"<?php echo $activity_edit->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $activity_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_activity_DepartmentCode" for="x_DepartmentCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->DepartmentCode->caption() ?><?php echo $activity_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($activity_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_activity_DepartmentCode">
<span<?php echo $activity_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($activity_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_DepartmentCode">
<?php $activity_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($activity_edit->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_edit->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_edit->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_edit->DepartmentCode->ReadOnly || $activity_edit->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_edit->DepartmentCode->Lookup->getParamTag($activity_edit, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $activity_edit->DepartmentCode->CurrentValue ?>"<?php echo $activity_edit->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $activity_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_activity_SectionCode" for="x_SectionCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->SectionCode->caption() ?><?php echo $activity_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->SectionCode->cellAttributes() ?>>
<?php if ($activity_edit->SectionCode->getSessionValue() != "") { ?>
<span id="el_activity_SectionCode">
<span<?php echo $activity_edit->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_edit->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SectionCode" name="x_SectionCode" value="<?php echo HtmlEncode($activity_edit->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($activity_edit->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_edit->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_edit->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_edit->SectionCode->ReadOnly || $activity_edit->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_edit->SectionCode->Lookup->getParamTag($activity_edit, "p_x_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_edit->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $activity_edit->SectionCode->CurrentValue ?>"<?php echo $activity_edit->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $activity_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<div id="r_ProgrammeCode" class="form-group row">
		<label id="elh_activity_ProgrammeCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->ProgrammeCode->caption() ?><?php echo $activity_edit->ProgrammeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->ProgrammeCode->cellAttributes() ?>>
<span id="el_activity_ProgrammeCode">
<?php
$onchange = $activity_edit->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_edit->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgrammeCode" id="sv_x_ProgrammeCode" value="<?php echo RemoveHtml($activity_edit->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_edit->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_edit->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_edit->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_edit->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_edit->ProgrammeCode->ReadOnly || $activity_edit->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_edit->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x_ProgrammeCode" id="x_ProgrammeCode" value="<?php echo HtmlEncode($activity_edit->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivityedit"], function() {
	factivityedit.createAutoSuggest({"id":"x_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_edit->ProgrammeCode->Lookup->getParamTag($activity_edit, "p_x_ProgrammeCode") ?>
</span>
<?php echo $activity_edit->ProgrammeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->OucomeCode->Visible) { // OucomeCode ?>
	<div id="r_OucomeCode" class="form-group row">
		<label id="elh_activity_OucomeCode" for="x_OucomeCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->OucomeCode->caption() ?><?php echo $activity_edit->OucomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->OucomeCode->cellAttributes() ?>>
<span id="el_activity_OucomeCode">
<?php $activity_edit->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_edit->OucomeCode->displayValueSeparatorAttribute() ?>" id="x_OucomeCode" name="x_OucomeCode"<?php echo $activity_edit->OucomeCode->editAttributes() ?>>
			<?php echo $activity_edit->OucomeCode->selectOptionListHtml("x_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_edit->OucomeCode->Lookup->getParamTag($activity_edit, "p_x_OucomeCode") ?>
</span>
<?php echo $activity_edit->OucomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_activity_OutputCode" for="x_OutputCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->OutputCode->caption() ?><?php echo $activity_edit->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->OutputCode->cellAttributes() ?>>
<span id="el_activity_OutputCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($activity_edit->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_edit->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_edit->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_edit->OutputCode->ReadOnly || $activity_edit->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_edit->OutputCode->Lookup->getParamTag($activity_edit, "p_x_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_edit->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $activity_edit->OutputCode->CurrentValue ?>"<?php echo $activity_edit->OutputCode->editAttributes() ?>>
</span>
<?php echo $activity_edit->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh_activity_ProjectCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->ProjectCode->caption() ?><?php echo $activity_edit->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->ProjectCode->cellAttributes() ?>>
<?php if ($activity_edit->ProjectCode->getSessionValue() != "") { ?>
<span id="el_activity_ProjectCode">
<span<?php echo $activity_edit->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_edit->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProjectCode" name="x_ProjectCode" value="<?php echo HtmlEncode($activity_edit->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_ProjectCode">
<?php
$onchange = $activity_edit->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_edit->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProjectCode" id="sv_x_ProjectCode" value="<?php echo RemoveHtml($activity_edit->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_edit->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_edit->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_edit->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_edit->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_edit->ProjectCode->ReadOnly || $activity_edit->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_edit->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo HtmlEncode($activity_edit->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivityedit"], function() {
	factivityedit.createAutoSuggest({"id":"x_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_edit->ProjectCode->Lookup->getParamTag($activity_edit, "p_x_ProjectCode") ?>
</span>
<?php } ?>
<?php echo $activity_edit->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->ActivityCode->Visible) { // ActivityCode ?>
	<div id="r_ActivityCode" class="form-group row">
		<label id="elh_activity_ActivityCode" for="x_ActivityCode" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->ActivityCode->caption() ?><?php echo $activity_edit->ActivityCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->ActivityCode->cellAttributes() ?>>
<span id="el_activity_ActivityCode">
<span<?php echo $activity_edit->ActivityCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_edit->ActivityCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="activity" data-field="x_ActivityCode" name="x_ActivityCode" id="x_ActivityCode" value="<?php echo HtmlEncode($activity_edit->ActivityCode->CurrentValue) ?>">
<?php echo $activity_edit->ActivityCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_activity_FinancialYear" for="x_FinancialYear" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->FinancialYear->caption() ?><?php echo $activity_edit->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->FinancialYear->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_edit->FinancialYear->displayValueSeparatorAttribute() ?>" id="x_FinancialYear" name="x_FinancialYear"<?php echo $activity_edit->FinancialYear->editAttributes() ?>>
			<?php echo $activity_edit->FinancialYear->selectOptionListHtml("x_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_edit->FinancialYear->Lookup->getParamTag($activity_edit, "p_x_FinancialYear") ?>
<input type="hidden" data-table="activity" data-field="x_FinancialYear" name="o_FinancialYear" id="o_FinancialYear" value="<?php echo HtmlEncode($activity_edit->FinancialYear->OldValue != null ? $activity_edit->FinancialYear->OldValue : $activity_edit->FinancialYear->CurrentValue) ?>">
<?php echo $activity_edit->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->ActivityName->Visible) { // ActivityName ?>
	<div id="r_ActivityName" class="form-group row">
		<label id="elh_activity_ActivityName" for="x_ActivityName" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->ActivityName->caption() ?><?php echo $activity_edit->ActivityName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->ActivityName->cellAttributes() ?>>
<span id="el_activity_ActivityName">
<textarea data-table="activity" data-field="x_ActivityName" name="x_ActivityName" id="x_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_edit->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_edit->ActivityName->editAttributes() ?>><?php echo $activity_edit->ActivityName->EditValue ?></textarea>
</span>
<?php echo $activity_edit->ActivityName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->MTEFBudget->Visible) { // MTEFBudget ?>
	<div id="r_MTEFBudget" class="form-group row">
		<label id="elh_activity_MTEFBudget" for="x_MTEFBudget" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->MTEFBudget->caption() ?><?php echo $activity_edit->MTEFBudget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->MTEFBudget->cellAttributes() ?>>
<span id="el_activity_MTEFBudget">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x_MTEFBudget" id="x_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_edit->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_edit->MTEFBudget->EditValue ?>"<?php echo $activity_edit->MTEFBudget->editAttributes() ?>>
</span>
<?php echo $activity_edit->MTEFBudget->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<div id="r_SupplementaryBudget" class="form-group row">
		<label id="elh_activity_SupplementaryBudget" for="x_SupplementaryBudget" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->SupplementaryBudget->caption() ?><?php echo $activity_edit->SupplementaryBudget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->SupplementaryBudget->cellAttributes() ?>>
<span id="el_activity_SupplementaryBudget">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x_SupplementaryBudget" id="x_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_edit->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_edit->SupplementaryBudget->EditValue ?>"<?php echo $activity_edit->SupplementaryBudget->editAttributes() ?>>
</span>
<?php echo $activity_edit->SupplementaryBudget->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<div id="r_ExpectedAnnualAchievement" class="form-group row">
		<label id="elh_activity_ExpectedAnnualAchievement" for="x_ExpectedAnnualAchievement" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->ExpectedAnnualAchievement->caption() ?><?php echo $activity_edit->ExpectedAnnualAchievement->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el_activity_ExpectedAnnualAchievement">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x_ExpectedAnnualAchievement" id="x_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_edit->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_edit->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_edit->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php echo $activity_edit->ExpectedAnnualAchievement->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_edit->ActivityLocation->Visible) { // ActivityLocation ?>
	<div id="r_ActivityLocation" class="form-group row">
		<label id="elh_activity_ActivityLocation" for="x_ActivityLocation" class="<?php echo $activity_edit->LeftColumnClass ?>"><?php echo $activity_edit->ActivityLocation->caption() ?><?php echo $activity_edit->ActivityLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_edit->RightColumnClass ?>"><div <?php echo $activity_edit->ActivityLocation->cellAttributes() ?>>
<span id="el_activity_ActivityLocation">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x_ActivityLocation" id="x_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_edit->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_edit->ActivityLocation->EditValue ?>"<?php echo $activity_edit->ActivityLocation->editAttributes() ?>>
</span>
<?php echo $activity_edit->ActivityLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$activity_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $activity_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $activity_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$activity_edit->IsModal) { ?>
<?php echo $activity_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$activity_edit->showPageFooter();
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
$activity_edit->terminate();
?>