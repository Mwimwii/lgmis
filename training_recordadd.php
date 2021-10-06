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
$training_record_add = new training_record_add();

// Run the page
$training_record_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$training_record_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftraining_recordadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftraining_recordadd = currentForm = new ew.Form("ftraining_recordadd", "add");

	// Validate form
	ftraining_recordadd.validate = function() {
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
			<?php if ($training_record_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->EmployeeID->caption(), $training_record_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->EmployeeID->errorMessage()) ?>");
			<?php if ($training_record_add->TrainingIndex->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingIndex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->TrainingIndex->caption(), $training_record_add->TrainingIndex->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingIndex");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->TrainingIndex->errorMessage()) ?>");
			<?php if ($training_record_add->FieldOfTraining->Required) { ?>
				elm = this.getElements("x" + infix + "_FieldOfTraining");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->FieldOfTraining->caption(), $training_record_add->FieldOfTraining->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_add->TrainingType->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->TrainingType->caption(), $training_record_add->TrainingType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->TrainingType->errorMessage()) ?>");
			<?php if ($training_record_add->PlannedStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->PlannedStartDate->caption(), $training_record_add->PlannedStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->PlannedStartDate->errorMessage()) ?>");
			<?php if ($training_record_add->PlannedEndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->PlannedEndDate->caption(), $training_record_add->PlannedEndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlannedEndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->PlannedEndDate->errorMessage()) ?>");
			<?php if ($training_record_add->ActualStartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->ActualStartDate->caption(), $training_record_add->ActualStartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualStartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->ActualStartDate->errorMessage()) ?>");
			<?php if ($training_record_add->ActualEnddate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActualEnddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->ActualEnddate->caption(), $training_record_add->ActualEnddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActualEnddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->ActualEnddate->errorMessage()) ?>");
			<?php if ($training_record_add->QualificationLevelObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationLevelObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->QualificationLevelObtained->caption(), $training_record_add->QualificationLevelObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_add->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->AwardingInstitution->caption(), $training_record_add->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_add->Certificate->Required) { ?>
				felm = this.getElements("x" + infix + "_Certificate");
				elm = this.getElements("fn_x" + infix + "_Certificate");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $training_record_add->Certificate->caption(), $training_record_add->Certificate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_add->FundingSource->Required) { ?>
				elm = this.getElements("x" + infix + "_FundingSource");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->FundingSource->caption(), $training_record_add->FundingSource->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($training_record_add->TrainingCost->Required) { ?>
				elm = this.getElements("x" + infix + "_TrainingCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $training_record_add->TrainingCost->caption(), $training_record_add->TrainingCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TrainingCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($training_record_add->TrainingCost->errorMessage()) ?>");

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
	ftraining_recordadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftraining_recordadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftraining_recordadd.lists["x_FieldOfTraining"] = <?php echo $training_record_add->FieldOfTraining->Lookup->toClientList($training_record_add) ?>;
	ftraining_recordadd.lists["x_FieldOfTraining"].options = <?php echo JsonEncode($training_record_add->FieldOfTraining->lookupOptions()) ?>;
	ftraining_recordadd.lists["x_QualificationLevelObtained"] = <?php echo $training_record_add->QualificationLevelObtained->Lookup->toClientList($training_record_add) ?>;
	ftraining_recordadd.lists["x_QualificationLevelObtained"].options = <?php echo JsonEncode($training_record_add->QualificationLevelObtained->lookupOptions()) ?>;
	ftraining_recordadd.lists["x_FundingSource"] = <?php echo $training_record_add->FundingSource->Lookup->toClientList($training_record_add) ?>;
	ftraining_recordadd.lists["x_FundingSource"].options = <?php echo JsonEncode($training_record_add->FundingSource->lookupOptions()) ?>;
	loadjs.done("ftraining_recordadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $training_record_add->showPageHeader(); ?>
<?php
$training_record_add->showMessage();
?>
<form name="ftraining_recordadd" id="ftraining_recordadd" class="<?php echo $training_record_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="training_record">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$training_record_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($training_record_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_training_record_EmployeeID" for="x_EmployeeID" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->EmployeeID->caption() ?><?php echo $training_record_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->EmployeeID->cellAttributes() ?>>
<span id="el_training_record_EmployeeID">
<input type="text" data-table="training_record" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($training_record_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $training_record_add->EmployeeID->EditValue ?>"<?php echo $training_record_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $training_record_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->TrainingIndex->Visible) { // TrainingIndex ?>
	<div id="r_TrainingIndex" class="form-group row">
		<label id="elh_training_record_TrainingIndex" for="x_TrainingIndex" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->TrainingIndex->caption() ?><?php echo $training_record_add->TrainingIndex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->TrainingIndex->cellAttributes() ?>>
<span id="el_training_record_TrainingIndex">
<input type="text" data-table="training_record" data-field="x_TrainingIndex" name="x_TrainingIndex" id="x_TrainingIndex" placeholder="<?php echo HtmlEncode($training_record_add->TrainingIndex->getPlaceHolder()) ?>" value="<?php echo $training_record_add->TrainingIndex->EditValue ?>"<?php echo $training_record_add->TrainingIndex->editAttributes() ?>>
</span>
<?php echo $training_record_add->TrainingIndex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->FieldOfTraining->Visible) { // FieldOfTraining ?>
	<div id="r_FieldOfTraining" class="form-group row">
		<label id="elh_training_record_FieldOfTraining" for="x_FieldOfTraining" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->FieldOfTraining->caption() ?><?php echo $training_record_add->FieldOfTraining->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->FieldOfTraining->cellAttributes() ?>>
<span id="el_training_record_FieldOfTraining">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_FieldOfTraining"><?php echo EmptyValue(strval($training_record_add->FieldOfTraining->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_add->FieldOfTraining->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_add->FieldOfTraining->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_add->FieldOfTraining->ReadOnly || $training_record_add->FieldOfTraining->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_FieldOfTraining',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_add->FieldOfTraining->Lookup->getParamTag($training_record_add, "p_x_FieldOfTraining") ?>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_add->FieldOfTraining->displayValueSeparatorAttribute() ?>" name="x_FieldOfTraining" id="x_FieldOfTraining" value="<?php echo $training_record_add->FieldOfTraining->CurrentValue ?>"<?php echo $training_record_add->FieldOfTraining->editAttributes() ?>>
</span>
<?php echo $training_record_add->FieldOfTraining->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->TrainingType->Visible) { // TrainingType ?>
	<div id="r_TrainingType" class="form-group row">
		<label id="elh_training_record_TrainingType" for="x_TrainingType" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->TrainingType->caption() ?><?php echo $training_record_add->TrainingType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->TrainingType->cellAttributes() ?>>
<span id="el_training_record_TrainingType">
<input type="text" data-table="training_record" data-field="x_TrainingType" name="x_TrainingType" id="x_TrainingType" size="30" placeholder="<?php echo HtmlEncode($training_record_add->TrainingType->getPlaceHolder()) ?>" value="<?php echo $training_record_add->TrainingType->EditValue ?>"<?php echo $training_record_add->TrainingType->editAttributes() ?>>
</span>
<?php echo $training_record_add->TrainingType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label id="elh_training_record_PlannedStartDate" for="x_PlannedStartDate" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->PlannedStartDate->caption() ?><?php echo $training_record_add->PlannedStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->PlannedStartDate->cellAttributes() ?>>
<span id="el_training_record_PlannedStartDate">
<input type="text" data-table="training_record" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($training_record_add->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_add->PlannedStartDate->EditValue ?>"<?php echo $training_record_add->PlannedStartDate->editAttributes() ?>>
<?php if (!$training_record_add->PlannedStartDate->ReadOnly && !$training_record_add->PlannedStartDate->Disabled && !isset($training_record_add->PlannedStartDate->EditAttrs["readonly"]) && !isset($training_record_add->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordadd", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_add->PlannedStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label id="elh_training_record_PlannedEndDate" for="x_PlannedEndDate" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->PlannedEndDate->caption() ?><?php echo $training_record_add->PlannedEndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->PlannedEndDate->cellAttributes() ?>>
<span id="el_training_record_PlannedEndDate">
<input type="text" data-table="training_record" data-field="x_PlannedEndDate" data-format="2" name="x_PlannedEndDate" id="x_PlannedEndDate" size="30" placeholder="<?php echo HtmlEncode($training_record_add->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $training_record_add->PlannedEndDate->EditValue ?>"<?php echo $training_record_add->PlannedEndDate->editAttributes() ?>>
<?php if (!$training_record_add->PlannedEndDate->ReadOnly && !$training_record_add->PlannedEndDate->Disabled && !isset($training_record_add->PlannedEndDate->EditAttrs["readonly"]) && !isset($training_record_add->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordadd", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_add->PlannedEndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label id="elh_training_record_ActualStartDate" for="x_ActualStartDate" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->ActualStartDate->caption() ?><?php echo $training_record_add->ActualStartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->ActualStartDate->cellAttributes() ?>>
<span id="el_training_record_ActualStartDate">
<input type="text" data-table="training_record" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" size="30" placeholder="<?php echo HtmlEncode($training_record_add->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_add->ActualStartDate->EditValue ?>"<?php echo $training_record_add->ActualStartDate->editAttributes() ?>>
<?php if (!$training_record_add->ActualStartDate->ReadOnly && !$training_record_add->ActualStartDate->Disabled && !isset($training_record_add->ActualStartDate->EditAttrs["readonly"]) && !isset($training_record_add->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordadd", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_add->ActualStartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->ActualEnddate->Visible) { // ActualEnddate ?>
	<div id="r_ActualEnddate" class="form-group row">
		<label id="elh_training_record_ActualEnddate" for="x_ActualEnddate" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->ActualEnddate->caption() ?><?php echo $training_record_add->ActualEnddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->ActualEnddate->cellAttributes() ?>>
<span id="el_training_record_ActualEnddate">
<input type="text" data-table="training_record" data-field="x_ActualEnddate" name="x_ActualEnddate" id="x_ActualEnddate" size="30" placeholder="<?php echo HtmlEncode($training_record_add->ActualEnddate->getPlaceHolder()) ?>" value="<?php echo $training_record_add->ActualEnddate->EditValue ?>"<?php echo $training_record_add->ActualEnddate->editAttributes() ?>>
<?php if (!$training_record_add->ActualEnddate->ReadOnly && !$training_record_add->ActualEnddate->Disabled && !isset($training_record_add->ActualEnddate->EditAttrs["readonly"]) && !isset($training_record_add->ActualEnddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordadd", "x_ActualEnddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $training_record_add->ActualEnddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
	<div id="r_QualificationLevelObtained" class="form-group row">
		<label id="elh_training_record_QualificationLevelObtained" for="x_QualificationLevelObtained" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->QualificationLevelObtained->caption() ?><?php echo $training_record_add->QualificationLevelObtained->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->QualificationLevelObtained->cellAttributes() ?>>
<span id="el_training_record_QualificationLevelObtained">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_QualificationLevelObtained"><?php echo EmptyValue(strval($training_record_add->QualificationLevelObtained->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_add->QualificationLevelObtained->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_add->QualificationLevelObtained->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_add->QualificationLevelObtained->ReadOnly || $training_record_add->QualificationLevelObtained->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_QualificationLevelObtained',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_add->QualificationLevelObtained->Lookup->getParamTag($training_record_add, "p_x_QualificationLevelObtained") ?>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_add->QualificationLevelObtained->displayValueSeparatorAttribute() ?>" name="x_QualificationLevelObtained" id="x_QualificationLevelObtained" value="<?php echo $training_record_add->QualificationLevelObtained->CurrentValue ?>"<?php echo $training_record_add->QualificationLevelObtained->editAttributes() ?>>
</span>
<?php echo $training_record_add->QualificationLevelObtained->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<div id="r_AwardingInstitution" class="form-group row">
		<label id="elh_training_record_AwardingInstitution" for="x_AwardingInstitution" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->AwardingInstitution->caption() ?><?php echo $training_record_add->AwardingInstitution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->AwardingInstitution->cellAttributes() ?>>
<span id="el_training_record_AwardingInstitution">
<input type="text" data-table="training_record" data-field="x_AwardingInstitution" name="x_AwardingInstitution" id="x_AwardingInstitution" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($training_record_add->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $training_record_add->AwardingInstitution->EditValue ?>"<?php echo $training_record_add->AwardingInstitution->editAttributes() ?>>
</span>
<?php echo $training_record_add->AwardingInstitution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->Certificate->Visible) { // Certificate ?>
	<div id="r_Certificate" class="form-group row">
		<label id="elh_training_record_Certificate" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->Certificate->caption() ?><?php echo $training_record_add->Certificate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->Certificate->cellAttributes() ?>>
<span id="el_training_record_Certificate">
<div id="fd_x_Certificate">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $training_record_add->Certificate->title() ?>" data-table="training_record" data-field="x_Certificate" name="x_Certificate" id="x_Certificate" lang="<?php echo CurrentLanguageID() ?>"<?php echo $training_record_add->Certificate->editAttributes() ?><?php if ($training_record_add->Certificate->ReadOnly || $training_record_add->Certificate->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Certificate"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Certificate" id= "fn_x_Certificate" value="<?php echo $training_record_add->Certificate->Upload->FileName ?>">
<input type="hidden" name="fa_x_Certificate" id= "fa_x_Certificate" value="0">
<input type="hidden" name="fs_x_Certificate" id= "fs_x_Certificate" value="0">
<input type="hidden" name="fx_x_Certificate" id= "fx_x_Certificate" value="<?php echo $training_record_add->Certificate->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Certificate" id= "fm_x_Certificate" value="<?php echo $training_record_add->Certificate->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Certificate" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $training_record_add->Certificate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->FundingSource->Visible) { // FundingSource ?>
	<div id="r_FundingSource" class="form-group row">
		<label id="elh_training_record_FundingSource" for="x_FundingSource" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->FundingSource->caption() ?><?php echo $training_record_add->FundingSource->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->FundingSource->cellAttributes() ?>>
<span id="el_training_record_FundingSource">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="training_record" data-field="x_FundingSource" data-value-separator="<?php echo $training_record_add->FundingSource->displayValueSeparatorAttribute() ?>" id="x_FundingSource" name="x_FundingSource"<?php echo $training_record_add->FundingSource->editAttributes() ?>>
			<?php echo $training_record_add->FundingSource->selectOptionListHtml("x_FundingSource") ?>
		</select>
</div>
<?php echo $training_record_add->FundingSource->Lookup->getParamTag($training_record_add, "p_x_FundingSource") ?>
</span>
<?php echo $training_record_add->FundingSource->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($training_record_add->TrainingCost->Visible) { // TrainingCost ?>
	<div id="r_TrainingCost" class="form-group row">
		<label id="elh_training_record_TrainingCost" for="x_TrainingCost" class="<?php echo $training_record_add->LeftColumnClass ?>"><?php echo $training_record_add->TrainingCost->caption() ?><?php echo $training_record_add->TrainingCost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $training_record_add->RightColumnClass ?>"><div <?php echo $training_record_add->TrainingCost->cellAttributes() ?>>
<span id="el_training_record_TrainingCost">
<input type="text" data-table="training_record" data-field="x_TrainingCost" name="x_TrainingCost" id="x_TrainingCost" size="30" placeholder="<?php echo HtmlEncode($training_record_add->TrainingCost->getPlaceHolder()) ?>" value="<?php echo $training_record_add->TrainingCost->EditValue ?>"<?php echo $training_record_add->TrainingCost->editAttributes() ?>>
</span>
<?php echo $training_record_add->TrainingCost->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$training_record_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $training_record_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $training_record_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$training_record_add->showPageFooter();
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
$training_record_add->terminate();
?>