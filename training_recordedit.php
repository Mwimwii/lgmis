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
$training_record_edit = new training_record_edit();

// Run the page
$training_record_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$training_record_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftraining_recordedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftraining_recordedit = currentForm = new ew.Form("ftraining_recordedit", "edit");

	// Validate form
	ftraining_recordedit.validate = function() {
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
			<?php if ($training_record_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->EmployeeID->caption(), $training_record_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($training_record_edit->TrainingIndex->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingIndex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->TrainingIndex->caption(), $training_record_edit->TrainingIndex->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingIndex");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->TrainingIndex->errorMessage()) ?>");
			<?php if ($training_record_edit->FieldOfTraining->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldOfTraining");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->FieldOfTraining->caption(), $training_record_edit->FieldOfTraining->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_edit->TrainingType->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->TrainingType->caption(), $training_record_edit->TrainingType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->TrainingType->errorMessage()) ?>");
			<?php if ($training_record_edit->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->PlannedStartDate->caption(), $training_record_edit->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->PlannedStartDate->errorMessage()) ?>");
			<?php if ($training_record_edit->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->PlannedEndDate->caption(), $training_record_edit->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->PlannedEndDate->errorMessage()) ?>");
			<?php if ($training_record_edit->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->ActualStartDate->caption(), $training_record_edit->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->ActualStartDate->errorMessage()) ?>");
			<?php if ($training_record_edit->ActualEnddate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEnddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->ActualEnddate->caption(), $training_record_edit->ActualEnddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEnddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->ActualEnddate->errorMessage()) ?>");
			<?php if ($training_record_edit->QualificationLevelObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationLevelObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->QualificationLevelObtained->caption(), $training_record_edit->QualificationLevelObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_edit->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->AwardingInstitution->caption(), $training_record_edit->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_edit->Certificate->Required) { ?>
				felm = this.getElements("x" + infix + "_Certificate");
				elm = this.getElements("fn_x" + infix + "_Certificate");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->Certificate->caption(), $training_record_edit->Certificate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_edit->FundingSource->Required) { ?>
				elm = this.getElements("x" + infix + "_FundingSource");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->FundingSource->caption(), $training_record_edit->FundingSource->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_edit->TrainingCost->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_edit->TrainingCost->caption(), $training_record_edit->TrainingCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_edit->TrainingCost->errorMessage()) ?>");

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
	ftraining_recordedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftraining_recordedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftraining_recordedit.lists["x_FieldOfTraining"] = <?php echo $training_record_edit->FieldOfTraining->Lookup->toClientList($training_record_edit) ?>;
	ftraining_recordedit.lists["x_FieldOfTraining"].options = <?php echo JsonEncode($training_record_edit->FieldOfTraining->lookupOptions()) ?>;
	ftraining_recordedit.lists["x_QualificationLevelObtained"] = <?php echo $training_record_edit->QualificationLevelObtained->Lookup->toClientList($training_record_edit) ?>;
	ftraining_recordedit.lists["x_QualificationLevelObtained"].options = <?php echo JsonEncode($training_record_edit->QualificationLevelObtained->lookupOptions()) ?>;
	ftraining_recordedit.lists["x_FundingSource"] = <?php echo $training_record_edit->FundingSource->Lookup->toClientList($training_record_edit) ?>;
	ftraining_recordedit.lists["x_FundingSource"].options = <?php echo JsonEncode($training_record_edit->FundingSource->lookupOptions()) ?>;
	loadjs.done("ftraining_recordedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $training_record_edit->showPageHeader(); ?>
<?php
$training_record_edit->showMessage();
?>
<?php if (!$training_record_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $training_record_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ftraining_recordedit" id="ftraining_recordedit" class="<?php echo $training_record_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="training_record">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$training_record_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($training_record_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_training_record_EmployeeID" for="x_EmployeeID" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->EmployeeID->caption() ?><?php echo $training_record_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->EmployeeID->cellAttributes() ?>>
<input type="text" data-table="training_record" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($training_record_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->EmployeeID->EditValue ?>"<?php echo $training_record_edit->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="training_record" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($training_record_edit->EmployeeID->OldValue != null ? $training_record_edit->EmployeeID->OldValue : $training_record_edit->EmployeeID->CurrentValue) ?>">
<?php echo $training_record_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->TrainingIndex->Visible) { // TrainingIndex ?>
	<div id="r_TrainingIndex" class="form-group row">
		<label id="elh_training_record_TrainingIndex" for="x_TrainingIndex" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->TrainingIndex->caption() ?><?php echo $training_record_edit->TrainingIndex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->TrainingIndex->cellAttributes() ?>>
<input type="text" data-table="training_record" data-field="x_TrainingIndex" name="x_TrainingIndex" id="x_TrainingIndex" placeholder="<?php echo HtmlEncode($training_record_edit->TrainingIndex->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->TrainingIndex->EditValue ?>"<?php echo $training_record_edit->TrainingIndex->editAttributes() ?>>
<input type="hidden" data-table="training_record" data-field="x_TrainingIndex" name="o_TrainingIndex" id="o_TrainingIndex" value="<?php echo HtmlEncode($training_record_edit->TrainingIndex->OldValue != null ? $training_record_edit->TrainingIndex->OldValue : $training_record_edit->TrainingIndex->CurrentValue) ?>">
<?php echo $training_record_edit->TrainingIndex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->FieldOfTraining->Visible) { // FieldOfTraining ?>
	<div id="r_FieldOfTraining" class="form-group row">
		<label id="elh_training_record_FieldOfTraining" for="x_FieldOfTraining" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->FieldOfTraining->caption() ?><?php echo $training_record_edit->FieldOfTraining->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->FieldOfTraining->cellAttributes() ?>>
<span id="el_training_record_FieldOfTraining">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_FieldOfTraining"><?php echo EmptyValue(strval($training_record_edit->FieldOfTraining->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_edit->FieldOfTraining->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_edit->FieldOfTraining->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_edit->FieldOfTraining->ReadOnly || $training_record_edit->FieldOfTraining->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_FieldOfTraining',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_edit->FieldOfTraining->Lookup->getParamTag($training_record_edit, "p_x_FieldOfTraining") ?>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_edit->FieldOfTraining->displayValueSeparatorAttribute() ?>" name="x_FieldOfTraining" id="x_FieldOfTraining" value="<?php echo $training_record_edit->FieldOfTraining->CurrentValue ?>"<?php echo $training_record_edit->FieldOfTraining->editAttributes() ?>>
</span>
<?php echo $training_record_edit->FieldOfTraining->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->TrainingType->Visible) { // TrainingType ?>
	<div id="r_TrainingType" class="form-group row">
		<label id="elh_training_record_TrainingType" for="x_TrainingType" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->TrainingType->caption() ?><?php echo $training_record_edit->TrainingType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->TrainingType->cellAttributes() ?>>
<span id="el_training_record_TrainingType">
<input type="text" data-table="training_record" data-field="x_TrainingType" name="x_TrainingType" id="x_TrainingType" size="30" placeholder="<?php echo HtmlEncode($training_record_edit->TrainingType->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->TrainingType->EditValue ?>"<?php echo $training_record_edit->TrainingType->editAttributes() ?>>
</span>
<?php echo $training_record_edit->TrainingType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_training_record_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->PlannedStartDate->caption() ?><?php echo $training_record_edit->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->PlannedStartDate->cellAttributes() ?>>
<span id="el_training_record_PlannedStartDate">
<input type="text" data-table="training_record" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($training_record_edit->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->PlannedStartDate->EditValue ?>"<?php echo $training_record_edit->PlannedStartDate->editAttributes() ?>>
<?php if (!$training_record_edit->PlannedStartDate->ReadOnly && !$training_record_edit->PlannedStartDate->Disabled && !isset($training_record_edit->PlannedStartDate->EditAttrs["readonly"]) && !isset($training_record_edit->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordedit", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_edit->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_training_record_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->PlannedEndDate->caption() ?><?php echo $training_record_edit->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->PlannedEndDate->cellAttributes() ?>>
<span id="el_training_record_PlannedEndDate">
<input type="text" data-table="training_record" data-field="x_PlannedEndDate" data-format="2" name="x_PlannedEndDate" id="x_PlannedEndDate" size="30" placeholder="<?php echo HtmlEncode($training_record_edit->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->PlannedEndDate->EditValue ?>"<?php echo $training_record_edit->PlannedEndDate->editAttributes() ?>>
<?php if (!$training_record_edit->PlannedEndDate->ReadOnly && !$training_record_edit->PlannedEndDate->Disabled && !isset($training_record_edit->PlannedEndDate->EditAttrs["readonly"]) && !isset($training_record_edit->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordedit", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_edit->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_training_record_ActualStartDate" for="x_ActualStartDate" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->ActualStartDate->caption() ?><?php echo $training_record_edit->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->ActualStartDate->cellAttributes() ?>>
<span id="el_training_record_ActualStartDate">
<input type="text" data-table="training_record" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" size="30" placeholder="<?php echo HtmlEncode($training_record_edit->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->ActualStartDate->EditValue ?>"<?php echo $training_record_edit->ActualStartDate->editAttributes() ?>>
<?php if (!$training_record_edit->ActualStartDate->ReadOnly && !$training_record_edit->ActualStartDate->Disabled && !isset($training_record_edit->ActualStartDate->EditAttrs["readonly"]) && !isset($training_record_edit->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordedit", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_edit->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->ActualEnddate->Visible) { // ActualEnddate ?>
	<div id="r_ActualEnddate" class="form-group row">
		<label id="elh_training_record_ActualEnddate" for="x_ActualEnddate" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->ActualEnddate->caption() ?><?php echo $training_record_edit->ActualEnddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->ActualEnddate->cellAttributes() ?>>
<span id="el_training_record_ActualEnddate">
<input type="text" data-table="training_record" data-field="x_ActualEnddate" name="x_ActualEnddate" id="x_ActualEnddate" size="30" placeholder="<?php echo HtmlEncode($training_record_edit->ActualEnddate->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->ActualEnddate->EditValue ?>"<?php echo $training_record_edit->ActualEnddate->editAttributes() ?>>
<?php if (!$training_record_edit->ActualEnddate->ReadOnly && !$training_record_edit->ActualEnddate->Disabled && !isset($training_record_edit->ActualEnddate->EditAttrs["readonly"]) && !isset($training_record_edit->ActualEnddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordedit", "x_ActualEnddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_edit->ActualEnddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
	<div id="r_QualificationLevelObtained" class="form-group row">
		<label id="elh_training_record_QualificationLevelObtained" for="x_QualificationLevelObtained" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->QualificationLevelObtained->caption() ?><?php echo $training_record_edit->QualificationLevelObtained->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->QualificationLevelObtained->cellAttributes() ?>>
<span id="el_training_record_QualificationLevelObtained">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_QualificationLevelObtained"><?php echo EmptyValue(strval($training_record_edit->QualificationLevelObtained->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_edit->QualificationLevelObtained->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_edit->QualificationLevelObtained->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_edit->QualificationLevelObtained->ReadOnly || $training_record_edit->QualificationLevelObtained->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_QualificationLevelObtained',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_edit->QualificationLevelObtained->Lookup->getParamTag($training_record_edit, "p_x_QualificationLevelObtained") ?>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_edit->QualificationLevelObtained->displayValueSeparatorAttribute() ?>" name="x_QualificationLevelObtained" id="x_QualificationLevelObtained" value="<?php echo $training_record_edit->QualificationLevelObtained->CurrentValue ?>"<?php echo $training_record_edit->QualificationLevelObtained->editAttributes() ?>>
</span>
<?php echo $training_record_edit->QualificationLevelObtained->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<div id="r_AwardingInstitution" class="form-group row">
		<label id="elh_training_record_AwardingInstitution" for="x_AwardingInstitution" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->AwardingInstitution->caption() ?><?php echo $training_record_edit->AwardingInstitution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->AwardingInstitution->cellAttributes() ?>>
<span id="el_training_record_AwardingInstitution">
<input type="text" data-table="training_record" data-field="x_AwardingInstitution" name="x_AwardingInstitution" id="x_AwardingInstitution" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($training_record_edit->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->AwardingInstitution->EditValue ?>"<?php echo $training_record_edit->AwardingInstitution->editAttributes() ?>>
</span>
<?php echo $training_record_edit->AwardingInstitution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->Certificate->Visible) { // Certificate ?>
	<div id="r_Certificate" class="form-group row">
		<label id="elh_training_record_Certificate" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->Certificate->caption() ?><?php echo $training_record_edit->Certificate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->Certificate->cellAttributes() ?>>
<span id="el_training_record_Certificate">
<div id="fd_x_Certificate">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $training_record_edit->Certificate->title() ?>" data-table="training_record" data-field="x_Certificate" name="x_Certificate" id="x_Certificate" lang="<?php echo CurrentLanguageID() ?>"<?php echo $training_record_edit->Certificate->editAttributes() ?><?php if ($training_record_edit->Certificate->ReadOnly || $training_record_edit->Certificate->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Certificate"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Certificate" id= "fn_x_Certificate" value="<?php echo $training_record_edit->Certificate->Upload->FileName ?>">
<input type="hidden" name="fa_x_Certificate" id= "fa_x_Certificate" value="<?php echo (Post("fa_x_Certificate") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Certificate" id= "fs_x_Certificate" value="0">
<input type="hidden" name="fx_x_Certificate" id= "fx_x_Certificate" value="<?php echo $training_record_edit->Certificate->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Certificate" id= "fm_x_Certificate" value="<?php echo $training_record_edit->Certificate->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Certificate" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $training_record_edit->Certificate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->FundingSource->Visible) { // FundingSource ?>
	<div id="r_FundingSource" class="form-group row">
		<label id="elh_training_record_FundingSource" for="x_FundingSource" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->FundingSource->caption() ?><?php echo $training_record_edit->FundingSource->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->FundingSource->cellAttributes() ?>>
<span id="el_training_record_FundingSource">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="training_record" data-field="x_FundingSource" data-value-separator="<?php echo $training_record_edit->FundingSource->displayValueSeparatorAttribute() ?>" id="x_FundingSource" name="x_FundingSource"<?php echo $training_record_edit->FundingSource->editAttributes() ?>>
			<?php echo $training_record_edit->FundingSource->selectOptionListHtml("x_FundingSource") ?>
		</select>
</div>
<?php echo $training_record_edit->FundingSource->Lookup->getParamTag($training_record_edit, "p_x_FundingSource") ?>
</span>
<?php echo $training_record_edit->FundingSource->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_edit->TrainingCost->Visible) { // TrainingCost ?>
	<div id="r_TrainingCost" class="form-group row">
		<label id="elh_training_record_TrainingCost" for="x_TrainingCost" class="<?php echo $training_record_edit->LeftColumnClass ?>"><?php echo $training_record_edit->TrainingCost->caption() ?><?php echo $training_record_edit->TrainingCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_edit->RightColumnClass ?>"><div <?php echo $training_record_edit->TrainingCost->cellAttributes() ?>>
<span id="el_training_record_TrainingCost">
<input type="text" data-table="training_record" data-field="x_TrainingCost" name="x_TrainingCost" id="x_TrainingCost" size="30" placeholder="<?php echo HtmlEncode($training_record_edit->TrainingCost->getPlaceHolder()) ?>" value="<?php echo $training_record_edit->TrainingCost->EditValue ?>"<?php echo $training_record_edit->TrainingCost->editAttributes() ?>>
</span>
<?php echo $training_record_edit->TrainingCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$training_record_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $training_record_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $training_record_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$training_record_edit->IsModal) { ?>
<?php echo $training_record_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$training_record_edit->showPageFooter();
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
$training_record_edit->terminate();
?>