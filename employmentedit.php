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
$employment_edit = new employment_edit();

// Run the page
$employment_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femploymentedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femploymentedit = currentForm = new ew.Form("femploymentedit", "edit");

	// Validate form
	femploymentedit.validate = function() {
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
			<?php if ($employment_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->EmployeeID->caption(), $employment_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->ProvinceCode->caption(), $employment_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->LACode->caption(), $employment_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->DepartmentCode->caption(), $employment_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->SectionCode->caption(), $employment_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->SubstantivePosition->Required) { ?>
				elm = this.getElements("x" + infix + "_SubstantivePosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->SubstantivePosition->caption(), $employment_edit->SubstantivePosition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->DateOfCurrentAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->DateOfCurrentAppointment->caption(), $employment_edit->DateOfCurrentAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_edit->DateOfCurrentAppointment->errorMessage()) ?>");
			<?php if ($employment_edit->LastAppraisalDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->LastAppraisalDate->caption(), $employment_edit->LastAppraisalDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_edit->LastAppraisalDate->errorMessage()) ?>");
			<?php if ($employment_edit->AppraisalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppraisalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->AppraisalStatus->caption(), $employment_edit->AppraisalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->DateOfExit->caption(), $employment_edit->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_edit->DateOfExit->errorMessage()) ?>");
			<?php if ($employment_edit->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->SalaryScale->caption(), $employment_edit->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->EmploymentType->caption(), $employment_edit->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->EmploymentStatus->caption(), $employment_edit->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->ExitReason->caption(), $employment_edit->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->RetirementType->caption(), $employment_edit->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->EmployeeNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->EmployeeNumber->caption(), $employment_edit->EmployeeNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->SalaryNotch->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryNotch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->SalaryNotch->caption(), $employment_edit->SalaryNotch->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->BasicMonthlySalary->caption(), $employment_edit->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_edit->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($employment_edit->ThirdParties->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdParties[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->ThirdParties->caption(), $employment_edit->ThirdParties->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_edit->PayrollCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->PayrollCode->caption(), $employment_edit->PayrollCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_edit->PayrollCode->errorMessage()) ?>");
			<?php if ($employment_edit->DateOfConfirmation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_edit->DateOfConfirmation->caption(), $employment_edit->DateOfConfirmation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_edit->DateOfConfirmation->errorMessage()) ?>");

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
	femploymentedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femploymentedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femploymentedit.lists["x_ProvinceCode"] = <?php echo $employment_edit->ProvinceCode->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_edit->ProvinceCode->lookupOptions()) ?>;
	femploymentedit.lists["x_LACode"] = <?php echo $employment_edit->LACode->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_LACode"].options = <?php echo JsonEncode($employment_edit->LACode->lookupOptions()) ?>;
	femploymentedit.lists["x_DepartmentCode"] = <?php echo $employment_edit->DepartmentCode->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_edit->DepartmentCode->lookupOptions()) ?>;
	femploymentedit.lists["x_SectionCode"] = <?php echo $employment_edit->SectionCode->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_edit->SectionCode->lookupOptions()) ?>;
	femploymentedit.lists["x_SubstantivePosition"] = <?php echo $employment_edit->SubstantivePosition->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_SubstantivePosition"].options = <?php echo JsonEncode($employment_edit->SubstantivePosition->lookupOptions()) ?>;
	femploymentedit.lists["x_AppraisalStatus"] = <?php echo $employment_edit->AppraisalStatus->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_AppraisalStatus"].options = <?php echo JsonEncode($employment_edit->AppraisalStatus->lookupOptions()) ?>;
	femploymentedit.lists["x_SalaryScale"] = <?php echo $employment_edit->SalaryScale->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_SalaryScale"].options = <?php echo JsonEncode($employment_edit->SalaryScale->lookupOptions()) ?>;
	femploymentedit.autoSuggests["x_SalaryScale"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femploymentedit.lists["x_EmploymentType"] = <?php echo $employment_edit->EmploymentType->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_EmploymentType"].options = <?php echo JsonEncode($employment_edit->EmploymentType->lookupOptions()) ?>;
	femploymentedit.lists["x_EmploymentStatus"] = <?php echo $employment_edit->EmploymentStatus->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_EmploymentStatus"].options = <?php echo JsonEncode($employment_edit->EmploymentStatus->lookupOptions()) ?>;
	femploymentedit.lists["x_ExitReason"] = <?php echo $employment_edit->ExitReason->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_ExitReason"].options = <?php echo JsonEncode($employment_edit->ExitReason->lookupOptions()) ?>;
	femploymentedit.lists["x_RetirementType"] = <?php echo $employment_edit->RetirementType->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_RetirementType"].options = <?php echo JsonEncode($employment_edit->RetirementType->lookupOptions()) ?>;
	femploymentedit.lists["x_SalaryNotch"] = <?php echo $employment_edit->SalaryNotch->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_SalaryNotch"].options = <?php echo JsonEncode($employment_edit->SalaryNotch->lookupOptions()) ?>;
	femploymentedit.lists["x_ThirdParties[]"] = <?php echo $employment_edit->ThirdParties->Lookup->toClientList($employment_edit) ?>;
	femploymentedit.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($employment_edit->ThirdParties->lookupOptions()) ?>;
	loadjs.done("femploymentedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_edit->showPageHeader(); ?>
<?php
$employment_edit->showMessage();
?>
<?php if (!$employment_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="femploymentedit" id="femploymentedit" class="<?php echo $employment_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employment_edit->IsModal ?>">
<?php if ($employment->getCurrentMasterTable() == "position_ref") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="position_ref">
<input type="hidden" name="fk_PositionCode" value="<?php echo HtmlEncode($employment_edit->SubstantivePosition->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($employment_edit->SectionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($employment_edit->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($employment_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($employment_edit->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SalaryScale" value="<?php echo HtmlEncode($employment_edit->SalaryScale->getSessionValue()) ?>">
<?php } ?>
<?php if ($employment->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employment_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($employment_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employment_EmployeeID" for="x_EmployeeID" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->EmployeeID->caption() ?><?php echo $employment_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->EmployeeID->cellAttributes() ?>>
<?php if ($employment_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_employment_EmployeeID">
<span<?php echo $employment_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($employment_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="employment" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_edit->EmployeeID->EditValue ?>"<?php echo $employment_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="employment" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($employment_edit->EmployeeID->OldValue != null ? $employment_edit->EmployeeID->OldValue : $employment_edit->EmployeeID->CurrentValue) ?>">
<?php echo $employment_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_employment_ProvinceCode" for="x_ProvinceCode" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->ProvinceCode->caption() ?><?php echo $employment_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($employment_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_employment_ProvinceCode">
<span<?php echo $employment_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($employment_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_ProvinceCode">
<?php $employment_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $employment_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_edit->ProvinceCode->Lookup->getParamTag($employment_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $employment_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_employment_LACode" for="x_LACode" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->LACode->caption() ?><?php echo $employment_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->LACode->cellAttributes() ?>>
<?php if ($employment_edit->LACode->getSessionValue() != "") { ?>
<span id="el_employment_LACode">
<span<?php echo $employment_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($employment_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_LACode">
<?php $employment_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($employment_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_edit->LACode->ReadOnly || $employment_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_edit->LACode->Lookup->getParamTag($employment_edit, "p_x_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $employment_edit->LACode->CurrentValue ?>"<?php echo $employment_edit->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_employment_DepartmentCode" for="x_DepartmentCode" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->DepartmentCode->caption() ?><?php echo $employment_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($employment_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_employment_DepartmentCode">
<span<?php echo $employment_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($employment_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_DepartmentCode">
<?php $employment_edit->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($employment_edit->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_edit->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_edit->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_edit->DepartmentCode->ReadOnly || $employment_edit->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_edit->DepartmentCode->Lookup->getParamTag($employment_edit, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $employment_edit->DepartmentCode->CurrentValue ?>"<?php echo $employment_edit->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_employment_SectionCode" for="x_SectionCode" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->SectionCode->caption() ?><?php echo $employment_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->SectionCode->cellAttributes() ?>>
<?php if ($employment_edit->SectionCode->getSessionValue() != "") { ?>
<span id="el_employment_SectionCode">
<span<?php echo $employment_edit->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_edit->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SectionCode" name="x_SectionCode" value="<?php echo HtmlEncode($employment_edit->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_SectionCode">
<?php $employment_edit->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($employment_edit->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_edit->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_edit->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_edit->SectionCode->ReadOnly || $employment_edit->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_edit->SectionCode->Lookup->getParamTag($employment_edit, "p_x_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_edit->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $employment_edit->SectionCode->CurrentValue ?>"<?php echo $employment_edit->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<div id="r_SubstantivePosition" class="form-group row">
		<label id="elh_employment_SubstantivePosition" for="x_SubstantivePosition" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->SubstantivePosition->caption() ?><?php echo $employment_edit->SubstantivePosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->SubstantivePosition->cellAttributes() ?>>
<?php if ($employment_edit->SubstantivePosition->getSessionValue() != "") { ?>

<span id="el_employment_SubstantivePosition">
<span<?php echo $employment_edit->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_edit->SubstantivePosition->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_SubstantivePosition" name="x_SubstantivePosition" value="<?php echo HtmlEncode($employment_edit->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>

<?php $employment_edit->SubstantivePosition->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubstantivePosition"><?php echo EmptyValue(strval($employment_edit->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_edit->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_edit->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_edit->SubstantivePosition->ReadOnly || $employment_edit->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_edit->SubstantivePosition->Lookup->getParamTag($employment_edit, "p_x_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_edit->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x_SubstantivePosition" id="x_SubstantivePosition" value="<?php echo $employment_edit->SubstantivePosition->CurrentValue ?>"<?php echo $employment_edit->SubstantivePosition->editAttributes() ?>>
<?php } ?>

<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" name="o_SubstantivePosition" id="o_SubstantivePosition" value="<?php echo HtmlEncode($employment_edit->SubstantivePosition->OldValue != null ? $employment_edit->SubstantivePosition->OldValue : $employment_edit->SubstantivePosition->CurrentValue) ?>">
<?php echo $employment_edit->SubstantivePosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<div id="r_DateOfCurrentAppointment" class="form-group row">
		<label id="elh_employment_DateOfCurrentAppointment" for="x_DateOfCurrentAppointment" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->DateOfCurrentAppointment->caption() ?><?php echo $employment_edit->DateOfCurrentAppointment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el_employment_DateOfCurrentAppointment">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x_DateOfCurrentAppointment" id="x_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_edit->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_edit->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_edit->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_edit->DateOfCurrentAppointment->ReadOnly && !$employment_edit->DateOfCurrentAppointment->Disabled && !isset($employment_edit->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_edit->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentedit", "x_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_edit->DateOfCurrentAppointment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
	<div id="r_LastAppraisalDate" class="form-group row">
		<label id="elh_employment_LastAppraisalDate" for="x_LastAppraisalDate" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->LastAppraisalDate->caption() ?><?php echo $employment_edit->LastAppraisalDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->LastAppraisalDate->cellAttributes() ?>>
<span id="el_employment_LastAppraisalDate">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x_LastAppraisalDate" id="x_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_edit->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_edit->LastAppraisalDate->EditValue ?>"<?php echo $employment_edit->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_edit->LastAppraisalDate->ReadOnly && !$employment_edit->LastAppraisalDate->Disabled && !isset($employment_edit->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_edit->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentedit", "x_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_edit->LastAppraisalDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<div id="r_AppraisalStatus" class="form-group row">
		<label id="elh_employment_AppraisalStatus" for="x_AppraisalStatus" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->AppraisalStatus->caption() ?><?php echo $employment_edit->AppraisalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->AppraisalStatus->cellAttributes() ?>>
<span id="el_employment_AppraisalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_edit->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x_AppraisalStatus" name="x_AppraisalStatus"<?php echo $employment_edit->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_edit->AppraisalStatus->selectOptionListHtml("x_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_edit->AppraisalStatus->Lookup->getParamTag($employment_edit, "p_x_AppraisalStatus") ?>
</span>
<?php echo $employment_edit->AppraisalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_employment_DateOfExit" for="x_DateOfExit" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->DateOfExit->caption() ?><?php echo $employment_edit->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->DateOfExit->cellAttributes() ?>>
<span id="el_employment_DateOfExit">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($employment_edit->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_edit->DateOfExit->EditValue ?>"<?php echo $employment_edit->DateOfExit->editAttributes() ?>>
<?php if (!$employment_edit->DateOfExit->ReadOnly && !$employment_edit->DateOfExit->Disabled && !isset($employment_edit->DateOfExit->EditAttrs["readonly"]) && !isset($employment_edit->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentedit", "x_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_edit->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_employment_SalaryScale" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->SalaryScale->caption() ?><?php echo $employment_edit->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->SalaryScale->cellAttributes() ?>>
<?php if ($employment_edit->SalaryScale->getSessionValue() != "") { ?>
<span id="el_employment_SalaryScale">
<span<?php echo $employment_edit->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_edit->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SalaryScale" name="x_SalaryScale" value="<?php echo HtmlEncode($employment_edit->SalaryScale->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_SalaryScale">
<?php
$onchange = $employment_edit->SalaryScale->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_edit->SalaryScale->EditAttrs["onchange"] = "";
?>
<span id="as_x_SalaryScale">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_SalaryScale" id="sv_x_SalaryScale" value="<?php echo RemoveHtml($employment_edit->SalaryScale->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_edit->SalaryScale->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_edit->SalaryScale->getPlaceHolder()) ?>"<?php echo $employment_edit->SalaryScale->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_edit->SalaryScale->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_SalaryScale',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($employment_edit->SalaryScale->ReadOnly || $employment_edit->SalaryScale->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="employment" data-field="x_SalaryScale" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_edit->SalaryScale->displayValueSeparatorAttribute() ?>" name="x_SalaryScale" id="x_SalaryScale" value="<?php echo HtmlEncode($employment_edit->SalaryScale->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femploymentedit"], function() {
	femploymentedit.createAutoSuggest({"id":"x_SalaryScale","forceSelect":true});
});
</script>
<?php echo $employment_edit->SalaryScale->Lookup->getParamTag($employment_edit, "p_x_SalaryScale") ?>
</span>
<?php } ?>
<?php echo $employment_edit->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->EmploymentType->Visible) { // EmploymentType ?>
	<div id="r_EmploymentType" class="form-group row">
		<label id="elh_employment_EmploymentType" for="x_EmploymentType" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->EmploymentType->caption() ?><?php echo $employment_edit->EmploymentType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->EmploymentType->cellAttributes() ?>>
<span id="el_employment_EmploymentType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_edit->EmploymentType->displayValueSeparatorAttribute() ?>" id="x_EmploymentType" name="x_EmploymentType"<?php echo $employment_edit->EmploymentType->editAttributes() ?>>
			<?php echo $employment_edit->EmploymentType->selectOptionListHtml("x_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_edit->EmploymentType->Lookup->getParamTag($employment_edit, "p_x_EmploymentType") ?>
</span>
<?php echo $employment_edit->EmploymentType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<div id="r_EmploymentStatus" class="form-group row">
		<label id="elh_employment_EmploymentStatus" for="x_EmploymentStatus" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->EmploymentStatus->caption() ?><?php echo $employment_edit->EmploymentStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->EmploymentStatus->cellAttributes() ?>>
<span id="el_employment_EmploymentStatus">
<?php $employment_edit->EmploymentStatus->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_edit->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x_EmploymentStatus" name="x_EmploymentStatus"<?php echo $employment_edit->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_edit->EmploymentStatus->selectOptionListHtml("x_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_edit->EmploymentStatus->Lookup->getParamTag($employment_edit, "p_x_EmploymentStatus") ?>
</span>
<?php echo $employment_edit->EmploymentStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_employment_ExitReason" for="x_ExitReason" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->ExitReason->caption() ?><?php echo $employment_edit->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->ExitReason->cellAttributes() ?>>
<span id="el_employment_ExitReason">
<?php $employment_edit->ExitReason->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ExitReason" data-value-separator="<?php echo $employment_edit->ExitReason->displayValueSeparatorAttribute() ?>" id="x_ExitReason" name="x_ExitReason"<?php echo $employment_edit->ExitReason->editAttributes() ?>>
			<?php echo $employment_edit->ExitReason->selectOptionListHtml("x_ExitReason") ?>
		</select>
</div>
<?php echo $employment_edit->ExitReason->Lookup->getParamTag($employment_edit, "p_x_ExitReason") ?>
</span>
<?php echo $employment_edit->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_employment_RetirementType" for="x_RetirementType" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->RetirementType->caption() ?><?php echo $employment_edit->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->RetirementType->cellAttributes() ?>>
<span id="el_employment_RetirementType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_RetirementType" data-value-separator="<?php echo $employment_edit->RetirementType->displayValueSeparatorAttribute() ?>" id="x_RetirementType" name="x_RetirementType"<?php echo $employment_edit->RetirementType->editAttributes() ?>>
			<?php echo $employment_edit->RetirementType->selectOptionListHtml("x_RetirementType") ?>
		</select>
</div>
<?php echo $employment_edit->RetirementType->Lookup->getParamTag($employment_edit, "p_x_RetirementType") ?>
</span>
<?php echo $employment_edit->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->EmployeeNumber->Visible) { // EmployeeNumber ?>
	<div id="r_EmployeeNumber" class="form-group row">
		<label id="elh_employment_EmployeeNumber" for="x_EmployeeNumber" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->EmployeeNumber->caption() ?><?php echo $employment_edit->EmployeeNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->EmployeeNumber->cellAttributes() ?>>
<span id="el_employment_EmployeeNumber">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x_EmployeeNumber" id="x_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_edit->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_edit->EmployeeNumber->EditValue ?>"<?php echo $employment_edit->EmployeeNumber->editAttributes() ?>>
</span>
<?php echo $employment_edit->EmployeeNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->SalaryNotch->Visible) { // SalaryNotch ?>
	<div id="r_SalaryNotch" class="form-group row">
		<label id="elh_employment_SalaryNotch" for="x_SalaryNotch" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->SalaryNotch->caption() ?><?php echo $employment_edit->SalaryNotch->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->SalaryNotch->cellAttributes() ?>>
<span id="el_employment_SalaryNotch">
<?php $employment_edit->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SalaryNotch"><?php echo EmptyValue(strval($employment_edit->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_edit->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_edit->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_edit->SalaryNotch->ReadOnly || $employment_edit->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_edit->SalaryNotch->Lookup->getParamTag($employment_edit, "p_x_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_edit->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x_SalaryNotch" id="x_SalaryNotch" value="<?php echo $employment_edit->SalaryNotch->CurrentValue ?>"<?php echo $employment_edit->SalaryNotch->editAttributes() ?>>
</span>
<?php echo $employment_edit->SalaryNotch->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<div id="r_BasicMonthlySalary" class="form-group row">
		<label id="elh_employment_BasicMonthlySalary" for="x_BasicMonthlySalary" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->BasicMonthlySalary->caption() ?><?php echo $employment_edit->BasicMonthlySalary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->BasicMonthlySalary->cellAttributes() ?>>
<span id="el_employment_BasicMonthlySalary">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x_BasicMonthlySalary" id="x_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_edit->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_edit->BasicMonthlySalary->EditValue ?>"<?php echo $employment_edit->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php echo $employment_edit->BasicMonthlySalary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->ThirdParties->Visible) { // ThirdParties ?>
	<div id="r_ThirdParties" class="form-group row">
		<label id="elh_employment_ThirdParties" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->ThirdParties->caption() ?><?php echo $employment_edit->ThirdParties->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->ThirdParties->cellAttributes() ?>>
<span id="el_employment_ThirdParties">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ThirdParties"><?php echo EmptyValue(strval($employment_edit->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_edit->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_edit->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_edit->ThirdParties->ReadOnly || $employment_edit->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_edit->ThirdParties->Lookup->getParamTag($employment_edit, "p_x_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_edit->ThirdParties->displayValueSeparatorAttribute() ?>" name="x_ThirdParties[]" id="x_ThirdParties[]" value="<?php echo $employment_edit->ThirdParties->CurrentValue ?>"<?php echo $employment_edit->ThirdParties->editAttributes() ?>>
</span>
<?php echo $employment_edit->ThirdParties->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->PayrollCode->Visible) { // PayrollCode ?>
	<div id="r_PayrollCode" class="form-group row">
		<label id="elh_employment_PayrollCode" for="x_PayrollCode" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->PayrollCode->caption() ?><?php echo $employment_edit->PayrollCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->PayrollCode->cellAttributes() ?>>
<span id="el_employment_PayrollCode">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x_PayrollCode" id="x_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_edit->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_edit->PayrollCode->EditValue ?>"<?php echo $employment_edit->PayrollCode->editAttributes() ?>>
</span>
<?php echo $employment_edit->PayrollCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_edit->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<div id="r_DateOfConfirmation" class="form-group row">
		<label id="elh_employment_DateOfConfirmation" for="x_DateOfConfirmation" class="<?php echo $employment_edit->LeftColumnClass ?>"><?php echo $employment_edit->DateOfConfirmation->caption() ?><?php echo $employment_edit->DateOfConfirmation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_edit->RightColumnClass ?>"><div <?php echo $employment_edit->DateOfConfirmation->cellAttributes() ?>>
<span id="el_employment_DateOfConfirmation">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x_DateOfConfirmation" id="x_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_edit->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_edit->DateOfConfirmation->EditValue ?>"<?php echo $employment_edit->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_edit->DateOfConfirmation->ReadOnly && !$employment_edit->DateOfConfirmation->Disabled && !isset($employment_edit->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_edit->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentedit", "x_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_edit->DateOfConfirmation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("leave_record", explode(",", $employment->getCurrentDetailTable())) && $leave_record->DetailEdit) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("leave_record", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "leave_recordgrid.php" ?>
<?php } ?>
<?php
	if (in_array("leave_taken", explode(",", $employment->getCurrentDetailTable())) && $leave_taken->DetailEdit) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("leave_taken", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "leave_takengrid.php" ?>
<?php } ?>
<?php
	if (in_array("employee_obligation", explode(",", $employment->getCurrentDetailTable())) && $employee_obligation->DetailEdit) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_obligation", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_obligationgrid.php" ?>
<?php } ?>
<?php
	if (in_array("employee_income", explode(",", $employment->getCurrentDetailTable())) && $employee_income->DetailEdit) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_income", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_incomegrid.php" ?>
<?php } ?>
<?php if (!$employment_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$employment_edit->IsModal) { ?>
<?php echo $employment_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$employment_edit->showPageFooter();
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
$employment_edit->terminate();
?>