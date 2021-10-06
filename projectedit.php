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
$project_edit = new project_edit();

// Run the page
$project_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprojectedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fprojectedit = currentForm = new ew.Form("fprojectedit", "edit");

	// Validate form
	fprojectedit.validate = function() {
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
			<?php if ($project_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ProvinceCode->caption(), $project_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->LACode->caption(), $project_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->DepartmentCode->caption(), $project_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->SectionCode->caption(), $project_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ProjectCode->caption(), $project_edit->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->ProjectName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ProjectName->caption(), $project_edit->ProjectName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->ProjectType->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ProjectType->caption(), $project_edit->ProjectType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->ProjectSector->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectSector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ProjectSector->caption(), $project_edit->ProjectSector->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->Contractors->Required) { ?>
				elm = this.getElements("x" + infix + "_Contractors");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->Contractors->caption(), $project_edit->Contractors->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->Projectdescription->Required) { ?>
				elm = this.getElements("x" + infix + "_Projectdescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->Projectdescription->caption(), $project_edit->Projectdescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->PlannedStartDate->caption(), $project_edit->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_edit->PlannedStartDate->errorMessage()) ?>");
			<?php if ($project_edit->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->PlannedEndDate->caption(), $project_edit->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_edit->PlannedEndDate->errorMessage()) ?>");
			<?php if ($project_edit->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ActualStartDate->caption(), $project_edit->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_edit->ActualStartDate->errorMessage()) ?>");
			<?php if ($project_edit->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ActualEndDate->caption(), $project_edit->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_edit->ActualEndDate->errorMessage()) ?>");
			<?php if ($project_edit->Budget->Required) { ?>
				elm = this.getElements("x" + infix + "_Budget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->Budget->caption(), $project_edit->Budget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Budget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_edit->Budget->errorMessage()) ?>");
			<?php if ($project_edit->ExpenditureTodate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpenditureTodate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ExpenditureTodate->caption(), $project_edit->ExpenditureTodate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExpenditureTodate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_edit->ExpenditureTodate->errorMessage()) ?>");
			<?php if ($project_edit->FundsReleased->Required) { ?>
				elm = this.getElements("x" + infix + "_FundsReleased");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->FundsReleased->caption(), $project_edit->FundsReleased->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FundsReleased");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_edit->FundsReleased->errorMessage()) ?>");
			<?php if ($project_edit->FundingSource->Required) { ?>
				elm = this.getElements("x" + infix + "_FundingSource");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->FundingSource->caption(), $project_edit->FundingSource->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->ProjectDocs->Required) { ?>
				felm = this.getElements("x" + infix + "_ProjectDocs");
				elm = this.getElements("fn_x" + infix + "_ProjectDocs");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $project_edit->ProjectDocs->caption(), $project_edit->ProjectDocs->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->ProgressStatus->caption(), $project_edit->ProgressStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->OutstandingTasks->Required) { ?>
				elm = this.getElements("x" + infix + "_OutstandingTasks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->OutstandingTasks->caption(), $project_edit->OutstandingTasks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->CommnentsOnStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_CommnentsOnStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_edit->CommnentsOnStatus->caption(), $project_edit->CommnentsOnStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_edit->MoreDocs->Required) { ?>
				felm = this.getElements("x" + infix + "_MoreDocs");
				elm = this.getElements("fn_x" + infix + "_MoreDocs");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $project_edit->MoreDocs->caption(), $project_edit->MoreDocs->RequiredErrorMessage)) ?>");
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
	fprojectedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprojectedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprojectedit.lists["x_ProvinceCode"] = <?php echo $project_edit->ProvinceCode->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($project_edit->ProvinceCode->lookupOptions()) ?>;
	fprojectedit.lists["x_LACode"] = <?php echo $project_edit->LACode->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_LACode"].options = <?php echo JsonEncode($project_edit->LACode->lookupOptions()) ?>;
	fprojectedit.lists["x_DepartmentCode"] = <?php echo $project_edit->DepartmentCode->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($project_edit->DepartmentCode->lookupOptions()) ?>;
	fprojectedit.lists["x_SectionCode"] = <?php echo $project_edit->SectionCode->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_SectionCode"].options = <?php echo JsonEncode($project_edit->SectionCode->lookupOptions()) ?>;
	fprojectedit.lists["x_ProjectType"] = <?php echo $project_edit->ProjectType->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_ProjectType"].options = <?php echo JsonEncode($project_edit->ProjectType->lookupOptions()) ?>;
	fprojectedit.lists["x_ProjectSector"] = <?php echo $project_edit->ProjectSector->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_ProjectSector"].options = <?php echo JsonEncode($project_edit->ProjectSector->lookupOptions()) ?>;
	fprojectedit.lists["x_FundingSource"] = <?php echo $project_edit->FundingSource->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_FundingSource"].options = <?php echo JsonEncode($project_edit->FundingSource->lookupOptions()) ?>;
	fprojectedit.lists["x_ProgressStatus"] = <?php echo $project_edit->ProgressStatus->Lookup->toClientList($project_edit) ?>;
	fprojectedit.lists["x_ProgressStatus"].options = <?php echo JsonEncode($project_edit->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fprojectedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_edit->showPageHeader(); ?>
<?php
$project_edit->showMessage();
?>
<?php if (!$project_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fprojectedit" id="fprojectedit" class="<?php echo $project_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$project_edit->IsModal ?>">
<?php if ($project->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($project_edit->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($project_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($project_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_project_ProvinceCode" for="x_ProvinceCode" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ProvinceCode->caption() ?><?php echo $project_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($project_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_project_ProvinceCode">
<span<?php echo $project_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($project_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_project_ProvinceCode">
<?php $project_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProvinceCode" data-value-separator="<?php echo $project_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $project_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $project_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $project_edit->ProvinceCode->Lookup->getParamTag($project_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $project_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_project_LACode" for="x_LACode" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->LACode->caption() ?><?php echo $project_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->LACode->cellAttributes() ?>>
<?php if ($project_edit->LACode->getSessionValue() != "") { ?>
<span id="el_project_LACode">
<span<?php echo $project_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($project_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_project_LACode">
<?php $project_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_LACode" data-value-separator="<?php echo $project_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $project_edit->LACode->editAttributes() ?>>
			<?php echo $project_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $project_edit->LACode->Lookup->getParamTag($project_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $project_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_project_DepartmentCode" for="x_DepartmentCode" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->DepartmentCode->caption() ?><?php echo $project_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_project_DepartmentCode">
<?php $project_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_DepartmentCode" data-value-separator="<?php echo $project_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $project_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $project_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $project_edit->DepartmentCode->Lookup->getParamTag($project_edit, "p_x_DepartmentCode") ?>
</span>
<?php echo $project_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_project_SectionCode" for="x_SectionCode" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->SectionCode->caption() ?><?php echo $project_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->SectionCode->cellAttributes() ?>>
<span id="el_project_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_SectionCode" data-value-separator="<?php echo $project_edit->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $project_edit->SectionCode->editAttributes() ?>>
			<?php echo $project_edit->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $project_edit->SectionCode->Lookup->getParamTag($project_edit, "p_x_SectionCode") ?>
</span>
<?php echo $project_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh_project_ProjectCode" for="x_ProjectCode" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ProjectCode->caption() ?><?php echo $project_edit->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ProjectCode->cellAttributes() ?>>
<input type="text" data-table="project" data-field="x_ProjectCode" name="x_ProjectCode" id="x_ProjectCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($project_edit->ProjectCode->getPlaceHolder()) ?>" value="<?php echo $project_edit->ProjectCode->EditValue ?>"<?php echo $project_edit->ProjectCode->editAttributes() ?>>
<input type="hidden" data-table="project" data-field="x_ProjectCode" name="o_ProjectCode" id="o_ProjectCode" value="<?php echo HtmlEncode($project_edit->ProjectCode->OldValue != null ? $project_edit->ProjectCode->OldValue : $project_edit->ProjectCode->CurrentValue) ?>">
<?php echo $project_edit->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ProjectName->Visible) { // ProjectName ?>
	<div id="r_ProjectName" class="form-group row">
		<label id="elh_project_ProjectName" for="x_ProjectName" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ProjectName->caption() ?><?php echo $project_edit->ProjectName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ProjectName->cellAttributes() ?>>
<span id="el_project_ProjectName">
<input type="text" data-table="project" data-field="x_ProjectName" name="x_ProjectName" id="x_ProjectName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($project_edit->ProjectName->getPlaceHolder()) ?>" value="<?php echo $project_edit->ProjectName->EditValue ?>"<?php echo $project_edit->ProjectName->editAttributes() ?>>
</span>
<?php echo $project_edit->ProjectName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ProjectType->Visible) { // ProjectType ?>
	<div id="r_ProjectType" class="form-group row">
		<label id="elh_project_ProjectType" for="x_ProjectType" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ProjectType->caption() ?><?php echo $project_edit->ProjectType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ProjectType->cellAttributes() ?>>
<span id="el_project_ProjectType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectType" data-value-separator="<?php echo $project_edit->ProjectType->displayValueSeparatorAttribute() ?>" id="x_ProjectType" name="x_ProjectType"<?php echo $project_edit->ProjectType->editAttributes() ?>>
			<?php echo $project_edit->ProjectType->selectOptionListHtml("x_ProjectType") ?>
		</select>
</div>
<?php echo $project_edit->ProjectType->Lookup->getParamTag($project_edit, "p_x_ProjectType") ?>
</span>
<?php echo $project_edit->ProjectType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ProjectSector->Visible) { // ProjectSector ?>
	<div id="r_ProjectSector" class="form-group row">
		<label id="elh_project_ProjectSector" for="x_ProjectSector" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ProjectSector->caption() ?><?php echo $project_edit->ProjectSector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ProjectSector->cellAttributes() ?>>
<span id="el_project_ProjectSector">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectSector" data-value-separator="<?php echo $project_edit->ProjectSector->displayValueSeparatorAttribute() ?>" id="x_ProjectSector" name="x_ProjectSector"<?php echo $project_edit->ProjectSector->editAttributes() ?>>
			<?php echo $project_edit->ProjectSector->selectOptionListHtml("x_ProjectSector") ?>
		</select>
</div>
<?php echo $project_edit->ProjectSector->Lookup->getParamTag($project_edit, "p_x_ProjectSector") ?>
</span>
<?php echo $project_edit->ProjectSector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->Contractors->Visible) { // Contractors ?>
	<div id="r_Contractors" class="form-group row">
		<label id="elh_project_Contractors" for="x_Contractors" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->Contractors->caption() ?><?php echo $project_edit->Contractors->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->Contractors->cellAttributes() ?>>
<span id="el_project_Contractors">
<textarea data-table="project" data-field="x_Contractors" name="x_Contractors" id="x_Contractors" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_edit->Contractors->getPlaceHolder()) ?>"<?php echo $project_edit->Contractors->editAttributes() ?>><?php echo $project_edit->Contractors->EditValue ?></textarea>
</span>
<?php echo $project_edit->Contractors->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->Projectdescription->Visible) { // Projectdescription ?>
	<div id="r_Projectdescription" class="form-group row">
		<label id="elh_project_Projectdescription" for="x_Projectdescription" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->Projectdescription->caption() ?><?php echo $project_edit->Projectdescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->Projectdescription->cellAttributes() ?>>
<span id="el_project_Projectdescription">
<textarea data-table="project" data-field="x_Projectdescription" name="x_Projectdescription" id="x_Projectdescription" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_edit->Projectdescription->getPlaceHolder()) ?>"<?php echo $project_edit->Projectdescription->editAttributes() ?>><?php echo $project_edit->Projectdescription->EditValue ?></textarea>
</span>
<?php echo $project_edit->Projectdescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_project_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->PlannedStartDate->caption() ?><?php echo $project_edit->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->PlannedStartDate->cellAttributes() ?>>
<span id="el_project_PlannedStartDate">
<input type="text" data-table="project" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($project_edit->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $project_edit->PlannedStartDate->EditValue ?>"<?php echo $project_edit->PlannedStartDate->editAttributes() ?>>
<?php if (!$project_edit->PlannedStartDate->ReadOnly && !$project_edit->PlannedStartDate->Disabled && !isset($project_edit->PlannedStartDate->EditAttrs["readonly"]) && !isset($project_edit->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectedit", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_edit->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_project_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->PlannedEndDate->caption() ?><?php echo $project_edit->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->PlannedEndDate->cellAttributes() ?>>
<span id="el_project_PlannedEndDate">
<input type="text" data-table="project" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" placeholder="<?php echo HtmlEncode($project_edit->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $project_edit->PlannedEndDate->EditValue ?>"<?php echo $project_edit->PlannedEndDate->editAttributes() ?>>
<?php if (!$project_edit->PlannedEndDate->ReadOnly && !$project_edit->PlannedEndDate->Disabled && !isset($project_edit->PlannedEndDate->EditAttrs["readonly"]) && !isset($project_edit->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectedit", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_edit->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_project_ActualStartDate" for="x_ActualStartDate" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ActualStartDate->caption() ?><?php echo $project_edit->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ActualStartDate->cellAttributes() ?>>
<span id="el_project_ActualStartDate">
<input type="text" data-table="project" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" placeholder="<?php echo HtmlEncode($project_edit->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $project_edit->ActualStartDate->EditValue ?>"<?php echo $project_edit->ActualStartDate->editAttributes() ?>>
<?php if (!$project_edit->ActualStartDate->ReadOnly && !$project_edit->ActualStartDate->Disabled && !isset($project_edit->ActualStartDate->EditAttrs["readonly"]) && !isset($project_edit->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectedit", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_edit->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label id="elh_project_ActualEndDate" for="x_ActualEndDate" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ActualEndDate->caption() ?><?php echo $project_edit->ActualEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ActualEndDate->cellAttributes() ?>>
<span id="el_project_ActualEndDate">
<input type="text" data-table="project" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" placeholder="<?php echo HtmlEncode($project_edit->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $project_edit->ActualEndDate->EditValue ?>"<?php echo $project_edit->ActualEndDate->editAttributes() ?>>
<?php if (!$project_edit->ActualEndDate->ReadOnly && !$project_edit->ActualEndDate->Disabled && !isset($project_edit->ActualEndDate->EditAttrs["readonly"]) && !isset($project_edit->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectedit", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_edit->ActualEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->Budget->Visible) { // Budget ?>
	<div id="r_Budget" class="form-group row">
		<label id="elh_project_Budget" for="x_Budget" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->Budget->caption() ?><?php echo $project_edit->Budget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->Budget->cellAttributes() ?>>
<span id="el_project_Budget">
<input type="text" data-table="project" data-field="x_Budget" name="x_Budget" id="x_Budget" size="30" placeholder="<?php echo HtmlEncode($project_edit->Budget->getPlaceHolder()) ?>" value="<?php echo $project_edit->Budget->EditValue ?>"<?php echo $project_edit->Budget->editAttributes() ?>>
</span>
<?php echo $project_edit->Budget->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ExpenditureTodate->Visible) { // ExpenditureTodate ?>
	<div id="r_ExpenditureTodate" class="form-group row">
		<label id="elh_project_ExpenditureTodate" for="x_ExpenditureTodate" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ExpenditureTodate->caption() ?><?php echo $project_edit->ExpenditureTodate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ExpenditureTodate->cellAttributes() ?>>
<span id="el_project_ExpenditureTodate">
<input type="text" data-table="project" data-field="x_ExpenditureTodate" name="x_ExpenditureTodate" id="x_ExpenditureTodate" size="30" placeholder="<?php echo HtmlEncode($project_edit->ExpenditureTodate->getPlaceHolder()) ?>" value="<?php echo $project_edit->ExpenditureTodate->EditValue ?>"<?php echo $project_edit->ExpenditureTodate->editAttributes() ?>>
</span>
<?php echo $project_edit->ExpenditureTodate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->FundsReleased->Visible) { // FundsReleased ?>
	<div id="r_FundsReleased" class="form-group row">
		<label id="elh_project_FundsReleased" for="x_FundsReleased" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->FundsReleased->caption() ?><?php echo $project_edit->FundsReleased->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->FundsReleased->cellAttributes() ?>>
<span id="el_project_FundsReleased">
<input type="text" data-table="project" data-field="x_FundsReleased" name="x_FundsReleased" id="x_FundsReleased" size="30" placeholder="<?php echo HtmlEncode($project_edit->FundsReleased->getPlaceHolder()) ?>" value="<?php echo $project_edit->FundsReleased->EditValue ?>"<?php echo $project_edit->FundsReleased->editAttributes() ?>>
</span>
<?php echo $project_edit->FundsReleased->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->FundingSource->Visible) { // FundingSource ?>
	<div id="r_FundingSource" class="form-group row">
		<label id="elh_project_FundingSource" for="x_FundingSource" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->FundingSource->caption() ?><?php echo $project_edit->FundingSource->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->FundingSource->cellAttributes() ?>>
<span id="el_project_FundingSource">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_FundingSource" data-value-separator="<?php echo $project_edit->FundingSource->displayValueSeparatorAttribute() ?>" id="x_FundingSource" name="x_FundingSource"<?php echo $project_edit->FundingSource->editAttributes() ?>>
			<?php echo $project_edit->FundingSource->selectOptionListHtml("x_FundingSource") ?>
		</select>
</div>
<?php echo $project_edit->FundingSource->Lookup->getParamTag($project_edit, "p_x_FundingSource") ?>
</span>
<?php echo $project_edit->FundingSource->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ProjectDocs->Visible) { // ProjectDocs ?>
	<div id="r_ProjectDocs" class="form-group row">
		<label id="elh_project_ProjectDocs" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ProjectDocs->caption() ?><?php echo $project_edit->ProjectDocs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ProjectDocs->cellAttributes() ?>>
<span id="el_project_ProjectDocs">
<div id="fd_x_ProjectDocs">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $project_edit->ProjectDocs->title() ?>" data-table="project" data-field="x_ProjectDocs" name="x_ProjectDocs" id="x_ProjectDocs" lang="<?php echo CurrentLanguageID() ?>"<?php echo $project_edit->ProjectDocs->editAttributes() ?><?php if ($project_edit->ProjectDocs->ReadOnly || $project_edit->ProjectDocs->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_ProjectDocs"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_ProjectDocs" id= "fn_x_ProjectDocs" value="<?php echo $project_edit->ProjectDocs->Upload->FileName ?>">
<input type="hidden" name="fa_x_ProjectDocs" id= "fa_x_ProjectDocs" value="<?php echo (Post("fa_x_ProjectDocs") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_ProjectDocs" id= "fs_x_ProjectDocs" value="0">
<input type="hidden" name="fx_x_ProjectDocs" id= "fx_x_ProjectDocs" value="<?php echo $project_edit->ProjectDocs->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ProjectDocs" id= "fm_x_ProjectDocs" value="<?php echo $project_edit->ProjectDocs->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ProjectDocs" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $project_edit->ProjectDocs->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->ProgressStatus->Visible) { // ProgressStatus ?>
	<div id="r_ProgressStatus" class="form-group row">
		<label id="elh_project_ProgressStatus" for="x_ProgressStatus" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->ProgressStatus->caption() ?><?php echo $project_edit->ProgressStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->ProgressStatus->cellAttributes() ?>>
<span id="el_project_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProgressStatus" data-value-separator="<?php echo $project_edit->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x_ProgressStatus" name="x_ProgressStatus"<?php echo $project_edit->ProgressStatus->editAttributes() ?>>
			<?php echo $project_edit->ProgressStatus->selectOptionListHtml("x_ProgressStatus") ?>
		</select>
</div>
<?php echo $project_edit->ProgressStatus->Lookup->getParamTag($project_edit, "p_x_ProgressStatus") ?>
</span>
<?php echo $project_edit->ProgressStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->OutstandingTasks->Visible) { // OutstandingTasks ?>
	<div id="r_OutstandingTasks" class="form-group row">
		<label id="elh_project_OutstandingTasks" for="x_OutstandingTasks" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->OutstandingTasks->caption() ?><?php echo $project_edit->OutstandingTasks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->OutstandingTasks->cellAttributes() ?>>
<span id="el_project_OutstandingTasks">
<textarea data-table="project" data-field="x_OutstandingTasks" name="x_OutstandingTasks" id="x_OutstandingTasks" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_edit->OutstandingTasks->getPlaceHolder()) ?>"<?php echo $project_edit->OutstandingTasks->editAttributes() ?>><?php echo $project_edit->OutstandingTasks->EditValue ?></textarea>
</span>
<?php echo $project_edit->OutstandingTasks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->CommnentsOnStatus->Visible) { // CommnentsOnStatus ?>
	<div id="r_CommnentsOnStatus" class="form-group row">
		<label id="elh_project_CommnentsOnStatus" for="x_CommnentsOnStatus" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->CommnentsOnStatus->caption() ?><?php echo $project_edit->CommnentsOnStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->CommnentsOnStatus->cellAttributes() ?>>
<span id="el_project_CommnentsOnStatus">
<textarea data-table="project" data-field="x_CommnentsOnStatus" name="x_CommnentsOnStatus" id="x_CommnentsOnStatus" cols="35" rows="4" placeholder="<?php echo HtmlEncode($project_edit->CommnentsOnStatus->getPlaceHolder()) ?>"<?php echo $project_edit->CommnentsOnStatus->editAttributes() ?>><?php echo $project_edit->CommnentsOnStatus->EditValue ?></textarea>
</span>
<?php echo $project_edit->CommnentsOnStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_edit->MoreDocs->Visible) { // MoreDocs ?>
	<div id="r_MoreDocs" class="form-group row">
		<label id="elh_project_MoreDocs" class="<?php echo $project_edit->LeftColumnClass ?>"><?php echo $project_edit->MoreDocs->caption() ?><?php echo $project_edit->MoreDocs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_edit->RightColumnClass ?>"><div <?php echo $project_edit->MoreDocs->cellAttributes() ?>>
<span id="el_project_MoreDocs">
<div id="fd_x_MoreDocs">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $project_edit->MoreDocs->title() ?>" data-table="project" data-field="x_MoreDocs" name="x_MoreDocs" id="x_MoreDocs" lang="<?php echo CurrentLanguageID() ?>"<?php echo $project_edit->MoreDocs->editAttributes() ?><?php if ($project_edit->MoreDocs->ReadOnly || $project_edit->MoreDocs->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_MoreDocs"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_MoreDocs" id= "fn_x_MoreDocs" value="<?php echo $project_edit->MoreDocs->Upload->FileName ?>">
<input type="hidden" name="fa_x_MoreDocs" id= "fa_x_MoreDocs" value="<?php echo (Post("fa_x_MoreDocs") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_MoreDocs" id= "fs_x_MoreDocs" value="0">
<input type="hidden" name="fx_x_MoreDocs" id= "fx_x_MoreDocs" value="<?php echo $project_edit->MoreDocs->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_MoreDocs" id= "fm_x_MoreDocs" value="<?php echo $project_edit->MoreDocs->UploadMaxFileSize ?>">
</div>
<table id="ft_x_MoreDocs" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $project_edit->MoreDocs->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("activity", explode(",", $project->getCurrentDetailTable())) && $activity->DetailEdit) {
?>
<?php if ($project->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("activity", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "activitygrid.php" ?>
<?php } ?>
<?php if (!$project_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $project_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$project_edit->IsModal) { ?>
<?php echo $project_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$project_edit->showPageFooter();
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
$project_edit->terminate();
?>