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
$project_add = new project_add();

// Run the page
$project_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprojectadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fprojectadd = currentForm = new ew.Form("fprojectadd", "add");

	// Validate form
	fprojectadd.validate = function() {
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
			<?php if ($project_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ProvinceCode->caption(), $project_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->LACode->caption(), $project_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->DepartmentCode->caption(), $project_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->SectionCode->caption(), $project_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->ProjectCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ProjectCode->caption(), $project_add->ProjectCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->ProjectName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ProjectName->caption(), $project_add->ProjectName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->ProjectType->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ProjectType->caption(), $project_add->ProjectType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->ProjectSector->Required) { ?>
				elm = this.getElements("x" + infix + "_ProjectSector");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ProjectSector->caption(), $project_add->ProjectSector->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->Contractors->Required) { ?>
				elm = this.getElements("x" + infix + "_Contractors");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->Contractors->caption(), $project_add->Contractors->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->Projectdescription->Required) { ?>
				elm = this.getElements("x" + infix + "_Projectdescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->Projectdescription->caption(), $project_add->Projectdescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->PlannedStartDate->caption(), $project_add->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_add->PlannedStartDate->errorMessage()) ?>");
			<?php if ($project_add->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->PlannedEndDate->caption(), $project_add->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_add->PlannedEndDate->errorMessage()) ?>");
			<?php if ($project_add->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ActualStartDate->caption(), $project_add->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_add->ActualStartDate->errorMessage()) ?>");
			<?php if ($project_add->ActualEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ActualEndDate->caption(), $project_add->ActualEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_add->ActualEndDate->errorMessage()) ?>");
			<?php if ($project_add->Budget->Required) { ?>
				elm = this.getElements("x" + infix + "_Budget");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->Budget->caption(), $project_add->Budget->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Budget");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_add->Budget->errorMessage()) ?>");
			<?php if ($project_add->ExpenditureTodate->Required) { ?>
				elm = this.getElements("x" + infix + "_ExpenditureTodate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ExpenditureTodate->caption(), $project_add->ExpenditureTodate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExpenditureTodate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_add->ExpenditureTodate->errorMessage()) ?>");
			<?php if ($project_add->FundsReleased->Required) { ?>
				elm = this.getElements("x" + infix + "_FundsReleased");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->FundsReleased->caption(), $project_add->FundsReleased->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FundsReleased");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($project_add->FundsReleased->errorMessage()) ?>");
			<?php if ($project_add->FundingSource->Required) { ?>
				elm = this.getElements("x" + infix + "_FundingSource");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->FundingSource->caption(), $project_add->FundingSource->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->ProjectDocs->Required) { ?>
				felm = this.getElements("x" + infix + "_ProjectDocs");
				elm = this.getElements("fn_x" + infix + "_ProjectDocs");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $project_add->ProjectDocs->caption(), $project_add->ProjectDocs->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->ProgressStatus->caption(), $project_add->ProgressStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->OutstandingTasks->Required) { ?>
				elm = this.getElements("x" + infix + "_OutstandingTasks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->OutstandingTasks->caption(), $project_add->OutstandingTasks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->CommnentsOnStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_CommnentsOnStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $project_add->CommnentsOnStatus->caption(), $project_add->CommnentsOnStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($project_add->MoreDocs->Required) { ?>
				felm = this.getElements("x" + infix + "_MoreDocs");
				elm = this.getElements("fn_x" + infix + "_MoreDocs");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $project_add->MoreDocs->caption(), $project_add->MoreDocs->RequiredErrorMessage)) ?>");
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
	fprojectadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprojectadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprojectadd.lists["x_ProvinceCode"] = <?php echo $project_add->ProvinceCode->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($project_add->ProvinceCode->lookupOptions()) ?>;
	fprojectadd.lists["x_LACode"] = <?php echo $project_add->LACode->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_LACode"].options = <?php echo JsonEncode($project_add->LACode->lookupOptions()) ?>;
	fprojectadd.lists["x_DepartmentCode"] = <?php echo $project_add->DepartmentCode->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($project_add->DepartmentCode->lookupOptions()) ?>;
	fprojectadd.lists["x_SectionCode"] = <?php echo $project_add->SectionCode->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_SectionCode"].options = <?php echo JsonEncode($project_add->SectionCode->lookupOptions()) ?>;
	fprojectadd.lists["x_ProjectType"] = <?php echo $project_add->ProjectType->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_ProjectType"].options = <?php echo JsonEncode($project_add->ProjectType->lookupOptions()) ?>;
	fprojectadd.lists["x_ProjectSector"] = <?php echo $project_add->ProjectSector->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_ProjectSector"].options = <?php echo JsonEncode($project_add->ProjectSector->lookupOptions()) ?>;
	fprojectadd.lists["x_FundingSource"] = <?php echo $project_add->FundingSource->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_FundingSource"].options = <?php echo JsonEncode($project_add->FundingSource->lookupOptions()) ?>;
	fprojectadd.lists["x_ProgressStatus"] = <?php echo $project_add->ProgressStatus->Lookup->toClientList($project_add) ?>;
	fprojectadd.lists["x_ProgressStatus"].options = <?php echo JsonEncode($project_add->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fprojectadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $project_add->showPageHeader(); ?>
<?php
$project_add->showMessage();
?>
<form name="fprojectadd" id="fprojectadd" class="<?php echo $project_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$project_add->IsModal ?>">
<?php if ($project->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($project_add->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($project_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($project_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_project_ProvinceCode" for="x_ProvinceCode" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ProvinceCode->caption() ?><?php echo $project_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ProvinceCode->cellAttributes() ?>>
<?php if ($project_add->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_project_ProvinceCode">
<span<?php echo $project_add->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_add->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($project_add->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_project_ProvinceCode">
<?php $project_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProvinceCode" data-value-separator="<?php echo $project_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $project_add->ProvinceCode->editAttributes() ?>>
			<?php echo $project_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $project_add->ProvinceCode->Lookup->getParamTag($project_add, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $project_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_project_LACode" for="x_LACode" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->LACode->caption() ?><?php echo $project_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->LACode->cellAttributes() ?>>
<?php if ($project_add->LACode->getSessionValue() != "") { ?>
<span id="el_project_LACode">
<span<?php echo $project_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($project_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($project_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_project_LACode">
<?php $project_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_LACode" data-value-separator="<?php echo $project_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $project_add->LACode->editAttributes() ?>>
			<?php echo $project_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $project_add->LACode->Lookup->getParamTag($project_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $project_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_project_DepartmentCode" for="x_DepartmentCode" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->DepartmentCode->caption() ?><?php echo $project_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->DepartmentCode->cellAttributes() ?>>
<span id="el_project_DepartmentCode">
<?php $project_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_DepartmentCode" data-value-separator="<?php echo $project_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $project_add->DepartmentCode->editAttributes() ?>>
			<?php echo $project_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $project_add->DepartmentCode->Lookup->getParamTag($project_add, "p_x_DepartmentCode") ?>
</span>
<?php echo $project_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_project_SectionCode" for="x_SectionCode" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->SectionCode->caption() ?><?php echo $project_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->SectionCode->cellAttributes() ?>>
<span id="el_project_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_SectionCode" data-value-separator="<?php echo $project_add->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $project_add->SectionCode->editAttributes() ?>>
			<?php echo $project_add->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $project_add->SectionCode->Lookup->getParamTag($project_add, "p_x_SectionCode") ?>
</span>
<?php echo $project_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ProjectCode->Visible) { // ProjectCode ?>
	<div id="r_ProjectCode" class="form-group row">
		<label id="elh_project_ProjectCode" for="x_ProjectCode" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ProjectCode->caption() ?><?php echo $project_add->ProjectCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ProjectCode->cellAttributes() ?>>
<span id="el_project_ProjectCode">
<input type="text" data-table="project" data-field="x_ProjectCode" name="x_ProjectCode" id="x_ProjectCode" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($project_add->ProjectCode->getPlaceHolder()) ?>" value="<?php echo $project_add->ProjectCode->EditValue ?>"<?php echo $project_add->ProjectCode->editAttributes() ?>>
</span>
<?php echo $project_add->ProjectCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ProjectName->Visible) { // ProjectName ?>
	<div id="r_ProjectName" class="form-group row">
		<label id="elh_project_ProjectName" for="x_ProjectName" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ProjectName->caption() ?><?php echo $project_add->ProjectName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ProjectName->cellAttributes() ?>>
<span id="el_project_ProjectName">
<input type="text" data-table="project" data-field="x_ProjectName" name="x_ProjectName" id="x_ProjectName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($project_add->ProjectName->getPlaceHolder()) ?>" value="<?php echo $project_add->ProjectName->EditValue ?>"<?php echo $project_add->ProjectName->editAttributes() ?>>
</span>
<?php echo $project_add->ProjectName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ProjectType->Visible) { // ProjectType ?>
	<div id="r_ProjectType" class="form-group row">
		<label id="elh_project_ProjectType" for="x_ProjectType" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ProjectType->caption() ?><?php echo $project_add->ProjectType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ProjectType->cellAttributes() ?>>
<span id="el_project_ProjectType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectType" data-value-separator="<?php echo $project_add->ProjectType->displayValueSeparatorAttribute() ?>" id="x_ProjectType" name="x_ProjectType"<?php echo $project_add->ProjectType->editAttributes() ?>>
			<?php echo $project_add->ProjectType->selectOptionListHtml("x_ProjectType") ?>
		</select>
</div>
<?php echo $project_add->ProjectType->Lookup->getParamTag($project_add, "p_x_ProjectType") ?>
</span>
<?php echo $project_add->ProjectType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ProjectSector->Visible) { // ProjectSector ?>
	<div id="r_ProjectSector" class="form-group row">
		<label id="elh_project_ProjectSector" for="x_ProjectSector" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ProjectSector->caption() ?><?php echo $project_add->ProjectSector->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ProjectSector->cellAttributes() ?>>
<span id="el_project_ProjectSector">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProjectSector" data-value-separator="<?php echo $project_add->ProjectSector->displayValueSeparatorAttribute() ?>" id="x_ProjectSector" name="x_ProjectSector"<?php echo $project_add->ProjectSector->editAttributes() ?>>
			<?php echo $project_add->ProjectSector->selectOptionListHtml("x_ProjectSector") ?>
		</select>
</div>
<?php echo $project_add->ProjectSector->Lookup->getParamTag($project_add, "p_x_ProjectSector") ?>
</span>
<?php echo $project_add->ProjectSector->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->Contractors->Visible) { // Contractors ?>
	<div id="r_Contractors" class="form-group row">
		<label id="elh_project_Contractors" for="x_Contractors" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->Contractors->caption() ?><?php echo $project_add->Contractors->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->Contractors->cellAttributes() ?>>
<span id="el_project_Contractors">
<textarea data-table="project" data-field="x_Contractors" name="x_Contractors" id="x_Contractors" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_add->Contractors->getPlaceHolder()) ?>"<?php echo $project_add->Contractors->editAttributes() ?>><?php echo $project_add->Contractors->EditValue ?></textarea>
</span>
<?php echo $project_add->Contractors->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->Projectdescription->Visible) { // Projectdescription ?>
	<div id="r_Projectdescription" class="form-group row">
		<label id="elh_project_Projectdescription" for="x_Projectdescription" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->Projectdescription->caption() ?><?php echo $project_add->Projectdescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->Projectdescription->cellAttributes() ?>>
<span id="el_project_Projectdescription">
<textarea data-table="project" data-field="x_Projectdescription" name="x_Projectdescription" id="x_Projectdescription" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_add->Projectdescription->getPlaceHolder()) ?>"<?php echo $project_add->Projectdescription->editAttributes() ?>><?php echo $project_add->Projectdescription->EditValue ?></textarea>
</span>
<?php echo $project_add->Projectdescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_project_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->PlannedStartDate->caption() ?><?php echo $project_add->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->PlannedStartDate->cellAttributes() ?>>
<span id="el_project_PlannedStartDate">
<input type="text" data-table="project" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($project_add->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $project_add->PlannedStartDate->EditValue ?>"<?php echo $project_add->PlannedStartDate->editAttributes() ?>>
<?php if (!$project_add->PlannedStartDate->ReadOnly && !$project_add->PlannedStartDate->Disabled && !isset($project_add->PlannedStartDate->EditAttrs["readonly"]) && !isset($project_add->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectadd", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_add->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_project_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->PlannedEndDate->caption() ?><?php echo $project_add->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->PlannedEndDate->cellAttributes() ?>>
<span id="el_project_PlannedEndDate">
<input type="text" data-table="project" data-field="x_PlannedEndDate" name="x_PlannedEndDate" id="x_PlannedEndDate" placeholder="<?php echo HtmlEncode($project_add->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $project_add->PlannedEndDate->EditValue ?>"<?php echo $project_add->PlannedEndDate->editAttributes() ?>>
<?php if (!$project_add->PlannedEndDate->ReadOnly && !$project_add->PlannedEndDate->Disabled && !isset($project_add->PlannedEndDate->EditAttrs["readonly"]) && !isset($project_add->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectadd", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_add->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_project_ActualStartDate" for="x_ActualStartDate" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ActualStartDate->caption() ?><?php echo $project_add->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ActualStartDate->cellAttributes() ?>>
<span id="el_project_ActualStartDate">
<input type="text" data-table="project" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" placeholder="<?php echo HtmlEncode($project_add->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $project_add->ActualStartDate->EditValue ?>"<?php echo $project_add->ActualStartDate->editAttributes() ?>>
<?php if (!$project_add->ActualStartDate->ReadOnly && !$project_add->ActualStartDate->Disabled && !isset($project_add->ActualStartDate->EditAttrs["readonly"]) && !isset($project_add->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectadd", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_add->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ActualEndDate->Visible) { // ActualEndDate ?>
	<div id="r_ActualEndDate" class="form-group row">
		<label id="elh_project_ActualEndDate" for="x_ActualEndDate" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ActualEndDate->caption() ?><?php echo $project_add->ActualEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ActualEndDate->cellAttributes() ?>>
<span id="el_project_ActualEndDate">
<input type="text" data-table="project" data-field="x_ActualEndDate" name="x_ActualEndDate" id="x_ActualEndDate" placeholder="<?php echo HtmlEncode($project_add->ActualEndDate->getPlaceHolder()) ?>" value="<?php echo $project_add->ActualEndDate->EditValue ?>"<?php echo $project_add->ActualEndDate->editAttributes() ?>>
<?php if (!$project_add->ActualEndDate->ReadOnly && !$project_add->ActualEndDate->Disabled && !isset($project_add->ActualEndDate->EditAttrs["readonly"]) && !isset($project_add->ActualEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprojectadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fprojectadd", "x_ActualEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $project_add->ActualEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->Budget->Visible) { // Budget ?>
	<div id="r_Budget" class="form-group row">
		<label id="elh_project_Budget" for="x_Budget" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->Budget->caption() ?><?php echo $project_add->Budget->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->Budget->cellAttributes() ?>>
<span id="el_project_Budget">
<input type="text" data-table="project" data-field="x_Budget" name="x_Budget" id="x_Budget" size="30" placeholder="<?php echo HtmlEncode($project_add->Budget->getPlaceHolder()) ?>" value="<?php echo $project_add->Budget->EditValue ?>"<?php echo $project_add->Budget->editAttributes() ?>>
</span>
<?php echo $project_add->Budget->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ExpenditureTodate->Visible) { // ExpenditureTodate ?>
	<div id="r_ExpenditureTodate" class="form-group row">
		<label id="elh_project_ExpenditureTodate" for="x_ExpenditureTodate" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ExpenditureTodate->caption() ?><?php echo $project_add->ExpenditureTodate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ExpenditureTodate->cellAttributes() ?>>
<span id="el_project_ExpenditureTodate">
<input type="text" data-table="project" data-field="x_ExpenditureTodate" name="x_ExpenditureTodate" id="x_ExpenditureTodate" size="30" placeholder="<?php echo HtmlEncode($project_add->ExpenditureTodate->getPlaceHolder()) ?>" value="<?php echo $project_add->ExpenditureTodate->EditValue ?>"<?php echo $project_add->ExpenditureTodate->editAttributes() ?>>
</span>
<?php echo $project_add->ExpenditureTodate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->FundsReleased->Visible) { // FundsReleased ?>
	<div id="r_FundsReleased" class="form-group row">
		<label id="elh_project_FundsReleased" for="x_FundsReleased" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->FundsReleased->caption() ?><?php echo $project_add->FundsReleased->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->FundsReleased->cellAttributes() ?>>
<span id="el_project_FundsReleased">
<input type="text" data-table="project" data-field="x_FundsReleased" name="x_FundsReleased" id="x_FundsReleased" size="30" placeholder="<?php echo HtmlEncode($project_add->FundsReleased->getPlaceHolder()) ?>" value="<?php echo $project_add->FundsReleased->EditValue ?>"<?php echo $project_add->FundsReleased->editAttributes() ?>>
</span>
<?php echo $project_add->FundsReleased->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->FundingSource->Visible) { // FundingSource ?>
	<div id="r_FundingSource" class="form-group row">
		<label id="elh_project_FundingSource" for="x_FundingSource" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->FundingSource->caption() ?><?php echo $project_add->FundingSource->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->FundingSource->cellAttributes() ?>>
<span id="el_project_FundingSource">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_FundingSource" data-value-separator="<?php echo $project_add->FundingSource->displayValueSeparatorAttribute() ?>" id="x_FundingSource" name="x_FundingSource"<?php echo $project_add->FundingSource->editAttributes() ?>>
			<?php echo $project_add->FundingSource->selectOptionListHtml("x_FundingSource") ?>
		</select>
</div>
<?php echo $project_add->FundingSource->Lookup->getParamTag($project_add, "p_x_FundingSource") ?>
</span>
<?php echo $project_add->FundingSource->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ProjectDocs->Visible) { // ProjectDocs ?>
	<div id="r_ProjectDocs" class="form-group row">
		<label id="elh_project_ProjectDocs" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ProjectDocs->caption() ?><?php echo $project_add->ProjectDocs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ProjectDocs->cellAttributes() ?>>
<span id="el_project_ProjectDocs">
<div id="fd_x_ProjectDocs">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $project_add->ProjectDocs->title() ?>" data-table="project" data-field="x_ProjectDocs" name="x_ProjectDocs" id="x_ProjectDocs" lang="<?php echo CurrentLanguageID() ?>"<?php echo $project_add->ProjectDocs->editAttributes() ?><?php if ($project_add->ProjectDocs->ReadOnly || $project_add->ProjectDocs->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_ProjectDocs"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_ProjectDocs" id= "fn_x_ProjectDocs" value="<?php echo $project_add->ProjectDocs->Upload->FileName ?>">
<input type="hidden" name="fa_x_ProjectDocs" id= "fa_x_ProjectDocs" value="0">
<input type="hidden" name="fs_x_ProjectDocs" id= "fs_x_ProjectDocs" value="0">
<input type="hidden" name="fx_x_ProjectDocs" id= "fx_x_ProjectDocs" value="<?php echo $project_add->ProjectDocs->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ProjectDocs" id= "fm_x_ProjectDocs" value="<?php echo $project_add->ProjectDocs->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ProjectDocs" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $project_add->ProjectDocs->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->ProgressStatus->Visible) { // ProgressStatus ?>
	<div id="r_ProgressStatus" class="form-group row">
		<label id="elh_project_ProgressStatus" for="x_ProgressStatus" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->ProgressStatus->caption() ?><?php echo $project_add->ProgressStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->ProgressStatus->cellAttributes() ?>>
<span id="el_project_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="project" data-field="x_ProgressStatus" data-value-separator="<?php echo $project_add->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x_ProgressStatus" name="x_ProgressStatus"<?php echo $project_add->ProgressStatus->editAttributes() ?>>
			<?php echo $project_add->ProgressStatus->selectOptionListHtml("x_ProgressStatus") ?>
		</select>
</div>
<?php echo $project_add->ProgressStatus->Lookup->getParamTag($project_add, "p_x_ProgressStatus") ?>
</span>
<?php echo $project_add->ProgressStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->OutstandingTasks->Visible) { // OutstandingTasks ?>
	<div id="r_OutstandingTasks" class="form-group row">
		<label id="elh_project_OutstandingTasks" for="x_OutstandingTasks" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->OutstandingTasks->caption() ?><?php echo $project_add->OutstandingTasks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->OutstandingTasks->cellAttributes() ?>>
<span id="el_project_OutstandingTasks">
<textarea data-table="project" data-field="x_OutstandingTasks" name="x_OutstandingTasks" id="x_OutstandingTasks" cols="50" rows="4" placeholder="<?php echo HtmlEncode($project_add->OutstandingTasks->getPlaceHolder()) ?>"<?php echo $project_add->OutstandingTasks->editAttributes() ?>><?php echo $project_add->OutstandingTasks->EditValue ?></textarea>
</span>
<?php echo $project_add->OutstandingTasks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->CommnentsOnStatus->Visible) { // CommnentsOnStatus ?>
	<div id="r_CommnentsOnStatus" class="form-group row">
		<label id="elh_project_CommnentsOnStatus" for="x_CommnentsOnStatus" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->CommnentsOnStatus->caption() ?><?php echo $project_add->CommnentsOnStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->CommnentsOnStatus->cellAttributes() ?>>
<span id="el_project_CommnentsOnStatus">
<textarea data-table="project" data-field="x_CommnentsOnStatus" name="x_CommnentsOnStatus" id="x_CommnentsOnStatus" cols="35" rows="4" placeholder="<?php echo HtmlEncode($project_add->CommnentsOnStatus->getPlaceHolder()) ?>"<?php echo $project_add->CommnentsOnStatus->editAttributes() ?>><?php echo $project_add->CommnentsOnStatus->EditValue ?></textarea>
</span>
<?php echo $project_add->CommnentsOnStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($project_add->MoreDocs->Visible) { // MoreDocs ?>
	<div id="r_MoreDocs" class="form-group row">
		<label id="elh_project_MoreDocs" class="<?php echo $project_add->LeftColumnClass ?>"><?php echo $project_add->MoreDocs->caption() ?><?php echo $project_add->MoreDocs->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $project_add->RightColumnClass ?>"><div <?php echo $project_add->MoreDocs->cellAttributes() ?>>
<span id="el_project_MoreDocs">
<div id="fd_x_MoreDocs">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $project_add->MoreDocs->title() ?>" data-table="project" data-field="x_MoreDocs" name="x_MoreDocs" id="x_MoreDocs" lang="<?php echo CurrentLanguageID() ?>"<?php echo $project_add->MoreDocs->editAttributes() ?><?php if ($project_add->MoreDocs->ReadOnly || $project_add->MoreDocs->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_MoreDocs"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_MoreDocs" id= "fn_x_MoreDocs" value="<?php echo $project_add->MoreDocs->Upload->FileName ?>">
<input type="hidden" name="fa_x_MoreDocs" id= "fa_x_MoreDocs" value="0">
<input type="hidden" name="fs_x_MoreDocs" id= "fs_x_MoreDocs" value="0">
<input type="hidden" name="fx_x_MoreDocs" id= "fx_x_MoreDocs" value="<?php echo $project_add->MoreDocs->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_MoreDocs" id= "fm_x_MoreDocs" value="<?php echo $project_add->MoreDocs->UploadMaxFileSize ?>">
</div>
<table id="ft_x_MoreDocs" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $project_add->MoreDocs->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("activity", explode(",", $project->getCurrentDetailTable())) && $activity->DetailAdd) {
?>
<?php if ($project->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("activity", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "activitygrid.php" ?>
<?php } ?>
<?php if (!$project_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $project_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $project_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$project_add->showPageFooter();
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
$project_add->terminate();
?>