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
$activity_add = new activity_add();

// Run the page
$activity_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$activity_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var factivityadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	factivityadd = currentForm = new ew.Form("factivityadd", "add");

	// Validate form
	factivityadd.validate = function() {
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
			<?php if ($activity_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->LACode->caption(), $activity_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->DepartmentCode->caption(), $activity_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->SectionCode->caption(), $activity_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->ProgrammeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->ProgrammeCode->caption(), $activity_add->ProgrammeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->OucomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OucomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->OucomeCode->caption(), $activity_add->OucomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->OutputCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OutputCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->OutputCode->caption(), $activity_add->OutputCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->ProjectCode->caption(), $activity_add->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->FinancialYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FinancialYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->FinancialYear->caption(), $activity_add->FinancialYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->ActivityName->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->ActivityName->caption(), $activity_add->ActivityName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->MTEFBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->MTEFBudget->caption(), $activity_add->MTEFBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MTEFBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_add->MTEFBudget->errorMessage()) ?>");
			<?php if ($activity_add->SupplementaryBudget->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->SupplementaryBudget->caption(), $activity_add->SupplementaryBudget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplementaryBudget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($activity_add->SupplementaryBudget->errorMessage()) ?>");
			<?php if ($activity_add->ExpectedAnnualAchievement->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpectedAnnualAchievement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->ExpectedAnnualAchievement->caption(), $activity_add->ExpectedAnnualAchievement->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($activity_add->ActivityLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_ActivityLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $activity_add->ActivityLocation->caption(), $activity_add->ActivityLocation->RequiredErrorMessage)) ?>");
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
	factivityadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	factivityadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	factivityadd.lists["x_LACode"] = <?php echo $activity_add->LACode->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_LACode"].options = <?php echo JsonEncode($activity_add->LACode->lookupOptions()) ?>;
	factivityadd.lists["x_DepartmentCode"] = <?php echo $activity_add->DepartmentCode->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($activity_add->DepartmentCode->lookupOptions()) ?>;
	factivityadd.lists["x_SectionCode"] = <?php echo $activity_add->SectionCode->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_SectionCode"].options = <?php echo JsonEncode($activity_add->SectionCode->lookupOptions()) ?>;
	factivityadd.lists["x_ProgrammeCode"] = <?php echo $activity_add->ProgrammeCode->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_ProgrammeCode"].options = <?php echo JsonEncode($activity_add->ProgrammeCode->lookupOptions()) ?>;
	factivityadd.autoSuggests["x_ProgrammeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivityadd.lists["x_OucomeCode"] = <?php echo $activity_add->OucomeCode->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_OucomeCode"].options = <?php echo JsonEncode($activity_add->OucomeCode->lookupOptions()) ?>;
	factivityadd.lists["x_OutputCode"] = <?php echo $activity_add->OutputCode->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_OutputCode"].options = <?php echo JsonEncode($activity_add->OutputCode->lookupOptions()) ?>;
	factivityadd.lists["x_ProjectCode"] = <?php echo $activity_add->ProjectCode->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_ProjectCode"].options = <?php echo JsonEncode($activity_add->ProjectCode->lookupOptions()) ?>;
	factivityadd.autoSuggests["x_ProjectCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	factivityadd.lists["x_FinancialYear"] = <?php echo $activity_add->FinancialYear->Lookup->toClientList($activity_add) ?>;
	factivityadd.lists["x_FinancialYear"].options = <?php echo JsonEncode($activity_add->FinancialYear->lookupOptions()) ?>;
	loadjs.done("factivityadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $activity_add->showPageHeader(); ?>
<?php
$activity_add->showMessage();
?>
<form name="factivityadd" id="factivityadd" class="<?php echo $activity_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="activity">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$activity_add->IsModal ?>">
<?php if ($activity->getCurrentMasterTable() == "project") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="project">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($activity_add->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($activity_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($activity_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($activity_add->SectionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProjectCode" value="<?php echo HtmlEncode($activity_add->ProjectCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($activity_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_activity_LACode" for="x_LACode" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->LACode->caption() ?><?php echo $activity_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->LACode->cellAttributes() ?>>
<?php if ($activity_add->LACode->getSessionValue() != "") { ?>
<span id="el_activity_LACode">
<span<?php echo $activity_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($activity_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_LACode">
<?php $activity_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($activity_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_add->LACode->ReadOnly || $activity_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_add->LACode->Lookup->getParamTag($activity_add, "p_x_LACode") ?>
<input type="hidden" data-table="activity" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $activity_add->LACode->CurrentValue ?>"<?php echo $activity_add->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $activity_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_activity_DepartmentCode" for="x_DepartmentCode" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->DepartmentCode->caption() ?><?php echo $activity_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->DepartmentCode->cellAttributes() ?>>
<?php if ($activity_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_activity_DepartmentCode">
<span<?php echo $activity_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($activity_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_DepartmentCode">
<?php $activity_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($activity_add->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_add->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_add->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_add->DepartmentCode->ReadOnly || $activity_add->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_add->DepartmentCode->Lookup->getParamTag($activity_add, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="activity" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $activity_add->DepartmentCode->CurrentValue ?>"<?php echo $activity_add->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $activity_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_activity_SectionCode" for="x_SectionCode" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->SectionCode->caption() ?><?php echo $activity_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->SectionCode->cellAttributes() ?>>
<?php if ($activity_add->SectionCode->getSessionValue() != "") { ?>
<span id="el_activity_SectionCode">
<span<?php echo $activity_add->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_add->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SectionCode" name="x_SectionCode" value="<?php echo HtmlEncode($activity_add->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_SectionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($activity_add->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_add->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_add->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_add->SectionCode->ReadOnly || $activity_add->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_add->SectionCode->Lookup->getParamTag($activity_add, "p_x_SectionCode") ?>
<input type="hidden" data-table="activity" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_add->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $activity_add->SectionCode->CurrentValue ?>"<?php echo $activity_add->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $activity_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<div id="r_ProgrammeCode" class="form-group row">
		<label id="elh_activity_ProgrammeCode" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->ProgrammeCode->caption() ?><?php echo $activity_add->ProgrammeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->ProgrammeCode->cellAttributes() ?>>
<span id="el_activity_ProgrammeCode">
<?php
$onchange = $activity_add->ProgrammeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_add->ProgrammeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgrammeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgrammeCode" id="sv_x_ProgrammeCode" value="<?php echo RemoveHtml($activity_add->ProgrammeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($activity_add->ProgrammeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_add->ProgrammeCode->getPlaceHolder()) ?>"<?php echo $activity_add->ProgrammeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_add->ProgrammeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgrammeCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_add->ProgrammeCode->ReadOnly || $activity_add->ProgrammeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProgrammeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_add->ProgrammeCode->displayValueSeparatorAttribute() ?>" name="x_ProgrammeCode" id="x_ProgrammeCode" value="<?php echo HtmlEncode($activity_add->ProgrammeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivityadd"], function() {
	factivityadd.createAutoSuggest({"id":"x_ProgrammeCode","forceSelect":false});
});
</script>
<?php echo $activity_add->ProgrammeCode->Lookup->getParamTag($activity_add, "p_x_ProgrammeCode") ?>
</span>
<?php echo $activity_add->ProgrammeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->OucomeCode->Visible) { // OucomeCode ?>
	<div id="r_OucomeCode" class="form-group row">
		<label id="elh_activity_OucomeCode" for="x_OucomeCode" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->OucomeCode->caption() ?><?php echo $activity_add->OucomeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->OucomeCode->cellAttributes() ?>>
<span id="el_activity_OucomeCode">
<?php $activity_add->OucomeCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_OucomeCode" data-value-separator="<?php echo $activity_add->OucomeCode->displayValueSeparatorAttribute() ?>" id="x_OucomeCode" name="x_OucomeCode"<?php echo $activity_add->OucomeCode->editAttributes() ?>>
			<?php echo $activity_add->OucomeCode->selectOptionListHtml("x_OucomeCode") ?>
		</select>
</div>
<?php echo $activity_add->OucomeCode->Lookup->getParamTag($activity_add, "p_x_OucomeCode") ?>
</span>
<?php echo $activity_add->OucomeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->OutputCode->Visible) { // OutputCode ?>
	<div id="r_OutputCode" class="form-group row">
		<label id="elh_activity_OutputCode" for="x_OutputCode" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->OutputCode->caption() ?><?php echo $activity_add->OutputCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->OutputCode->cellAttributes() ?>>
<span id="el_activity_OutputCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_OutputCode"><?php echo EmptyValue(strval($activity_add->OutputCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $activity_add->OutputCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_add->OutputCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($activity_add->OutputCode->ReadOnly || $activity_add->OutputCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_OutputCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $activity_add->OutputCode->Lookup->getParamTag($activity_add, "p_x_OutputCode") ?>
<input type="hidden" data-table="activity" data-field="x_OutputCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_add->OutputCode->displayValueSeparatorAttribute() ?>" name="x_OutputCode" id="x_OutputCode" value="<?php echo $activity_add->OutputCode->CurrentValue ?>"<?php echo $activity_add->OutputCode->editAttributes() ?>>
</span>
<?php echo $activity_add->OutputCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh_activity_ProjectCode" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->ProjectCode->caption() ?><?php echo $activity_add->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->ProjectCode->cellAttributes() ?>>
<?php if ($activity_add->ProjectCode->getSessionValue() != "") { ?>
<span id="el_activity_ProjectCode">
<span<?php echo $activity_add->ProjectCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($activity_add->ProjectCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProjectCode" name="x_ProjectCode" value="<?php echo HtmlEncode($activity_add->ProjectCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_activity_ProjectCode">
<?php
$onchange = $activity_add->ProjectCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$activity_add->ProjectCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProjectCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProjectCode" id="sv_x_ProjectCode" value="<?php echo RemoveHtml($activity_add->ProjectCode->EditValue) ?>" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($activity_add->ProjectCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($activity_add->ProjectCode->getPlaceHolder()) ?>"<?php echo $activity_add->ProjectCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($activity_add->ProjectCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProjectCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($activity_add->ProjectCode->ReadOnly || $activity_add->ProjectCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="activity" data-field="x_ProjectCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $activity_add->ProjectCode->displayValueSeparatorAttribute() ?>" name="x_ProjectCode" id="x_ProjectCode" value="<?php echo HtmlEncode($activity_add->ProjectCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["factivityadd"], function() {
	factivityadd.createAutoSuggest({"id":"x_ProjectCode","forceSelect":false});
});
</script>
<?php echo $activity_add->ProjectCode->Lookup->getParamTag($activity_add, "p_x_ProjectCode") ?>
</span>
<?php } ?>
<?php echo $activity_add->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->FinancialYear->Visible) { // FinancialYear ?>
	<div id="r_FinancialYear" class="form-group row">
		<label id="elh_activity_FinancialYear" for="x_FinancialYear" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->FinancialYear->caption() ?><?php echo $activity_add->FinancialYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->FinancialYear->cellAttributes() ?>>
<span id="el_activity_FinancialYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="activity" data-field="x_FinancialYear" data-value-separator="<?php echo $activity_add->FinancialYear->displayValueSeparatorAttribute() ?>" id="x_FinancialYear" name="x_FinancialYear"<?php echo $activity_add->FinancialYear->editAttributes() ?>>
			<?php echo $activity_add->FinancialYear->selectOptionListHtml("x_FinancialYear") ?>
		</select>
</div>
<?php echo $activity_add->FinancialYear->Lookup->getParamTag($activity_add, "p_x_FinancialYear") ?>
</span>
<?php echo $activity_add->FinancialYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->ActivityName->Visible) { // ActivityName ?>
	<div id="r_ActivityName" class="form-group row">
		<label id="elh_activity_ActivityName" for="x_ActivityName" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->ActivityName->caption() ?><?php echo $activity_add->ActivityName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->ActivityName->cellAttributes() ?>>
<span id="el_activity_ActivityName">
<textarea data-table="activity" data-field="x_ActivityName" name="x_ActivityName" id="x_ActivityName" cols="35" rows="4" placeholder="<?php echo HtmlEncode($activity_add->ActivityName->getPlaceHolder()) ?>"<?php echo $activity_add->ActivityName->editAttributes() ?>><?php echo $activity_add->ActivityName->EditValue ?></textarea>
</span>
<?php echo $activity_add->ActivityName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->MTEFBudget->Visible) { // MTEFBudget ?>
	<div id="r_MTEFBudget" class="form-group row">
		<label id="elh_activity_MTEFBudget" for="x_MTEFBudget" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->MTEFBudget->caption() ?><?php echo $activity_add->MTEFBudget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->MTEFBudget->cellAttributes() ?>>
<span id="el_activity_MTEFBudget">
<input type="text" data-table="activity" data-field="x_MTEFBudget" name="x_MTEFBudget" id="x_MTEFBudget" size="30" placeholder="<?php echo HtmlEncode($activity_add->MTEFBudget->getPlaceHolder()) ?>" value="<?php echo $activity_add->MTEFBudget->EditValue ?>"<?php echo $activity_add->MTEFBudget->editAttributes() ?>>
</span>
<?php echo $activity_add->MTEFBudget->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->SupplementaryBudget->Visible) { // SupplementaryBudget ?>
	<div id="r_SupplementaryBudget" class="form-group row">
		<label id="elh_activity_SupplementaryBudget" for="x_SupplementaryBudget" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->SupplementaryBudget->caption() ?><?php echo $activity_add->SupplementaryBudget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->SupplementaryBudget->cellAttributes() ?>>
<span id="el_activity_SupplementaryBudget">
<input type="text" data-table="activity" data-field="x_SupplementaryBudget" name="x_SupplementaryBudget" id="x_SupplementaryBudget" size="30" placeholder="<?php echo HtmlEncode($activity_add->SupplementaryBudget->getPlaceHolder()) ?>" value="<?php echo $activity_add->SupplementaryBudget->EditValue ?>"<?php echo $activity_add->SupplementaryBudget->editAttributes() ?>>
</span>
<?php echo $activity_add->SupplementaryBudget->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<div id="r_ExpectedAnnualAchievement" class="form-group row">
		<label id="elh_activity_ExpectedAnnualAchievement" for="x_ExpectedAnnualAchievement" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->ExpectedAnnualAchievement->caption() ?><?php echo $activity_add->ExpectedAnnualAchievement->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->ExpectedAnnualAchievement->cellAttributes() ?>>
<span id="el_activity_ExpectedAnnualAchievement">
<input type="text" data-table="activity" data-field="x_ExpectedAnnualAchievement" name="x_ExpectedAnnualAchievement" id="x_ExpectedAnnualAchievement" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_add->ExpectedAnnualAchievement->getPlaceHolder()) ?>" value="<?php echo $activity_add->ExpectedAnnualAchievement->EditValue ?>"<?php echo $activity_add->ExpectedAnnualAchievement->editAttributes() ?>>
</span>
<?php echo $activity_add->ExpectedAnnualAchievement->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($activity_add->ActivityLocation->Visible) { // ActivityLocation ?>
	<div id="r_ActivityLocation" class="form-group row">
		<label id="elh_activity_ActivityLocation" for="x_ActivityLocation" class="<?php echo $activity_add->LeftColumnClass ?>"><?php echo $activity_add->ActivityLocation->caption() ?><?php echo $activity_add->ActivityLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $activity_add->RightColumnClass ?>"><div <?php echo $activity_add->ActivityLocation->cellAttributes() ?>>
<span id="el_activity_ActivityLocation">
<input type="text" data-table="activity" data-field="x_ActivityLocation" name="x_ActivityLocation" id="x_ActivityLocation" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($activity_add->ActivityLocation->getPlaceHolder()) ?>" value="<?php echo $activity_add->ActivityLocation->EditValue ?>"<?php echo $activity_add->ActivityLocation->editAttributes() ?>>
</span>
<?php echo $activity_add->ActivityLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($activity_add->ProvinceCode->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode(strval($activity_add->ProvinceCode->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$activity_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $activity_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $activity_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$activity_add->showPageFooter();
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
$activity_add->terminate();
?>