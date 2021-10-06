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
$training_record_search = new training_record_search();

// Run the page
$training_record_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$training_record_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftraining_recordsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($training_record_search->IsModal) { ?>
	ftraining_recordsearch = currentAdvancedSearchForm = new ew.Form("ftraining_recordsearch", "search");
	<?php } else { ?>
	ftraining_recordsearch = currentForm = new ew.Form("ftraining_recordsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftraining_recordsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TrainingIndex");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->TrainingIndex->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TrainingType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->TrainingType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PlannedStartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->PlannedStartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PlannedEndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->PlannedEndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualStartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->ActualStartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActualEnddate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->ActualEnddate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TrainingCost");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($training_record_search->TrainingCost->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ftraining_recordsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftraining_recordsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftraining_recordsearch.lists["x_FieldOfTraining"] = <?php echo $training_record_search->FieldOfTraining->Lookup->toClientList($training_record_search) ?>;
	ftraining_recordsearch.lists["x_FieldOfTraining"].options = <?php echo JsonEncode($training_record_search->FieldOfTraining->lookupOptions()) ?>;
	ftraining_recordsearch.lists["x_QualificationLevelObtained"] = <?php echo $training_record_search->QualificationLevelObtained->Lookup->toClientList($training_record_search) ?>;
	ftraining_recordsearch.lists["x_QualificationLevelObtained"].options = <?php echo JsonEncode($training_record_search->QualificationLevelObtained->lookupOptions()) ?>;
	ftraining_recordsearch.lists["x_FundingSource"] = <?php echo $training_record_search->FundingSource->Lookup->toClientList($training_record_search) ?>;
	ftraining_recordsearch.lists["x_FundingSource"].options = <?php echo JsonEncode($training_record_search->FundingSource->lookupOptions()) ?>;
	loadjs.done("ftraining_recordsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $training_record_search->showPageHeader(); ?>
<?php
$training_record_search->showMessage();
?>
<form name="ftraining_recordsearch" id="ftraining_recordsearch" class="<?php echo $training_record_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="training_record">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$training_record_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($training_record_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_EmployeeID"><?php echo $training_record_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->EmployeeID->cellAttributes() ?>>
			<span id="el_training_record_EmployeeID" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($training_record_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $training_record_search->EmployeeID->EditValue ?>"<?php echo $training_record_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->TrainingIndex->Visible) { // TrainingIndex ?>
	<div id="r_TrainingIndex" class="form-group row">
		<label for="x_TrainingIndex" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_TrainingIndex"><?php echo $training_record_search->TrainingIndex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TrainingIndex" id="z_TrainingIndex" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->TrainingIndex->cellAttributes() ?>>
			<span id="el_training_record_TrainingIndex" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_TrainingIndex" name="x_TrainingIndex" id="x_TrainingIndex" placeholder="<?php echo HtmlEncode($training_record_search->TrainingIndex->getPlaceHolder()) ?>" value="<?php echo $training_record_search->TrainingIndex->EditValue ?>"<?php echo $training_record_search->TrainingIndex->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->FieldOfTraining->Visible) { // FieldOfTraining ?>
	<div id="r_FieldOfTraining" class="form-group row">
		<label for="x_FieldOfTraining" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_FieldOfTraining"><?php echo $training_record_search->FieldOfTraining->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FieldOfTraining" id="z_FieldOfTraining" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->FieldOfTraining->cellAttributes() ?>>
			<span id="el_training_record_FieldOfTraining" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_FieldOfTraining"><?php echo EmptyValue(strval($training_record_search->FieldOfTraining->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_search->FieldOfTraining->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_search->FieldOfTraining->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_search->FieldOfTraining->ReadOnly || $training_record_search->FieldOfTraining->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_FieldOfTraining',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_search->FieldOfTraining->Lookup->getParamTag($training_record_search, "p_x_FieldOfTraining") ?>
<input type="hidden" data-table="training_record" data-field="x_FieldOfTraining" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_search->FieldOfTraining->displayValueSeparatorAttribute() ?>" name="x_FieldOfTraining" id="x_FieldOfTraining" value="<?php echo $training_record_search->FieldOfTraining->AdvancedSearch->SearchValue ?>"<?php echo $training_record_search->FieldOfTraining->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->TrainingType->Visible) { // TrainingType ?>
	<div id="r_TrainingType" class="form-group row">
		<label for="x_TrainingType" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_TrainingType"><?php echo $training_record_search->TrainingType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TrainingType" id="z_TrainingType" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->TrainingType->cellAttributes() ?>>
			<span id="el_training_record_TrainingType" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_TrainingType" name="x_TrainingType" id="x_TrainingType" size="30" placeholder="<?php echo HtmlEncode($training_record_search->TrainingType->getPlaceHolder()) ?>" value="<?php echo $training_record_search->TrainingType->EditValue ?>"<?php echo $training_record_search->TrainingType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<div id="r_PlannedStartDate" class="form-group row">
		<label for="x_PlannedStartDate" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_PlannedStartDate"><?php echo $training_record_search->PlannedStartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PlannedStartDate" id="z_PlannedStartDate" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->PlannedStartDate->cellAttributes() ?>>
			<span id="el_training_record_PlannedStartDate" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_PlannedStartDate" name="x_PlannedStartDate" id="x_PlannedStartDate" placeholder="<?php echo HtmlEncode($training_record_search->PlannedStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_search->PlannedStartDate->EditValue ?>"<?php echo $training_record_search->PlannedStartDate->editAttributes() ?>>
<?php if (!$training_record_search->PlannedStartDate->ReadOnly && !$training_record_search->PlannedStartDate->Disabled && !isset($training_record_search->PlannedStartDate->EditAttrs["readonly"]) && !isset($training_record_search->PlannedStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordsearch", "x_PlannedStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<div id="r_PlannedEndDate" class="form-group row">
		<label for="x_PlannedEndDate" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_PlannedEndDate"><?php echo $training_record_search->PlannedEndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PlannedEndDate" id="z_PlannedEndDate" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->PlannedEndDate->cellAttributes() ?>>
			<span id="el_training_record_PlannedEndDate" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_PlannedEndDate" data-format="2" name="x_PlannedEndDate" id="x_PlannedEndDate" size="30" placeholder="<?php echo HtmlEncode($training_record_search->PlannedEndDate->getPlaceHolder()) ?>" value="<?php echo $training_record_search->PlannedEndDate->EditValue ?>"<?php echo $training_record_search->PlannedEndDate->editAttributes() ?>>
<?php if (!$training_record_search->PlannedEndDate->ReadOnly && !$training_record_search->PlannedEndDate->Disabled && !isset($training_record_search->PlannedEndDate->EditAttrs["readonly"]) && !isset($training_record_search->PlannedEndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordsearch", "x_PlannedEndDate", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->ActualStartDate->Visible) { // ActualStartDate ?>
	<div id="r_ActualStartDate" class="form-group row">
		<label for="x_ActualStartDate" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_ActualStartDate"><?php echo $training_record_search->ActualStartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualStartDate" id="z_ActualStartDate" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->ActualStartDate->cellAttributes() ?>>
			<span id="el_training_record_ActualStartDate" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_ActualStartDate" name="x_ActualStartDate" id="x_ActualStartDate" size="30" placeholder="<?php echo HtmlEncode($training_record_search->ActualStartDate->getPlaceHolder()) ?>" value="<?php echo $training_record_search->ActualStartDate->EditValue ?>"<?php echo $training_record_search->ActualStartDate->editAttributes() ?>>
<?php if (!$training_record_search->ActualStartDate->ReadOnly && !$training_record_search->ActualStartDate->Disabled && !isset($training_record_search->ActualStartDate->EditAttrs["readonly"]) && !isset($training_record_search->ActualStartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordsearch", "x_ActualStartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->ActualEnddate->Visible) { // ActualEnddate ?>
	<div id="r_ActualEnddate" class="form-group row">
		<label for="x_ActualEnddate" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_ActualEnddate"><?php echo $training_record_search->ActualEnddate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActualEnddate" id="z_ActualEnddate" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->ActualEnddate->cellAttributes() ?>>
			<span id="el_training_record_ActualEnddate" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_ActualEnddate" name="x_ActualEnddate" id="x_ActualEnddate" size="30" placeholder="<?php echo HtmlEncode($training_record_search->ActualEnddate->getPlaceHolder()) ?>" value="<?php echo $training_record_search->ActualEnddate->EditValue ?>"<?php echo $training_record_search->ActualEnddate->editAttributes() ?>>
<?php if (!$training_record_search->ActualEnddate->ReadOnly && !$training_record_search->ActualEnddate->Disabled && !isset($training_record_search->ActualEnddate->EditAttrs["readonly"]) && !isset($training_record_search->ActualEnddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftraining_recordsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ftraining_recordsearch", "x_ActualEnddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->QualificationLevelObtained->Visible) { // QualificationLevelObtained ?>
	<div id="r_QualificationLevelObtained" class="form-group row">
		<label for="x_QualificationLevelObtained" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_QualificationLevelObtained"><?php echo $training_record_search->QualificationLevelObtained->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_QualificationLevelObtained" id="z_QualificationLevelObtained" value="LIKE">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->QualificationLevelObtained->cellAttributes() ?>>
			<span id="el_training_record_QualificationLevelObtained" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_QualificationLevelObtained"><?php echo EmptyValue(strval($training_record_search->QualificationLevelObtained->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $training_record_search->QualificationLevelObtained->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($training_record_search->QualificationLevelObtained->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($training_record_search->QualificationLevelObtained->ReadOnly || $training_record_search->QualificationLevelObtained->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_QualificationLevelObtained',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $training_record_search->QualificationLevelObtained->Lookup->getParamTag($training_record_search, "p_x_QualificationLevelObtained") ?>
<input type="hidden" data-table="training_record" data-field="x_QualificationLevelObtained" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $training_record_search->QualificationLevelObtained->displayValueSeparatorAttribute() ?>" name="x_QualificationLevelObtained" id="x_QualificationLevelObtained" value="<?php echo $training_record_search->QualificationLevelObtained->AdvancedSearch->SearchValue ?>"<?php echo $training_record_search->QualificationLevelObtained->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<div id="r_AwardingInstitution" class="form-group row">
		<label for="x_AwardingInstitution" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_AwardingInstitution"><?php echo $training_record_search->AwardingInstitution->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AwardingInstitution" id="z_AwardingInstitution" value="LIKE">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->AwardingInstitution->cellAttributes() ?>>
			<span id="el_training_record_AwardingInstitution" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_AwardingInstitution" name="x_AwardingInstitution" id="x_AwardingInstitution" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($training_record_search->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $training_record_search->AwardingInstitution->EditValue ?>"<?php echo $training_record_search->AwardingInstitution->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->FundingSource->Visible) { // FundingSource ?>
	<div id="r_FundingSource" class="form-group row">
		<label for="x_FundingSource" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_FundingSource"><?php echo $training_record_search->FundingSource->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FundingSource" id="z_FundingSource" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->FundingSource->cellAttributes() ?>>
			<span id="el_training_record_FundingSource" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="training_record" data-field="x_FundingSource" data-value-separator="<?php echo $training_record_search->FundingSource->displayValueSeparatorAttribute() ?>" id="x_FundingSource" name="x_FundingSource"<?php echo $training_record_search->FundingSource->editAttributes() ?>>
			<?php echo $training_record_search->FundingSource->selectOptionListHtml("x_FundingSource") ?>
		</select>
</div>
<?php echo $training_record_search->FundingSource->Lookup->getParamTag($training_record_search, "p_x_FundingSource") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($training_record_search->TrainingCost->Visible) { // TrainingCost ?>
	<div id="r_TrainingCost" class="form-group row">
		<label for="x_TrainingCost" class="<?php echo $training_record_search->LeftColumnClass ?>"><span id="elh_training_record_TrainingCost"><?php echo $training_record_search->TrainingCost->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TrainingCost" id="z_TrainingCost" value="=">
</span>
		</label>
		<div class="<?php echo $training_record_search->RightColumnClass ?>"><div <?php echo $training_record_search->TrainingCost->cellAttributes() ?>>
			<span id="el_training_record_TrainingCost" class="ew-search-field">
<input type="text" data-table="training_record" data-field="x_TrainingCost" name="x_TrainingCost" id="x_TrainingCost" size="30" placeholder="<?php echo HtmlEncode($training_record_search->TrainingCost->getPlaceHolder()) ?>" value="<?php echo $training_record_search->TrainingCost->EditValue ?>"<?php echo $training_record_search->TrainingCost->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$training_record_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $training_record_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$training_record_search->showPageFooter();
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
$training_record_search->terminate();
?>