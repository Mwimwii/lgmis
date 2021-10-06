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
$employment_add = new employment_add();

// Run the page
$employment_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femploymentadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femploymentadd = currentForm = new ew.Form("femploymentadd", "add");

	// Validate form
	femploymentadd.validate = function() {
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
			<?php if ($employment_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->EmployeeID->caption(), $employment_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_add->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->ProvinceCode->caption(), $employment_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->LACode->caption(), $employment_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->DepartmentCode->caption(), $employment_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->SectionCode->caption(), $employment_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->SubstantivePosition->Required) { ?>
				elm = this.getElements("x" + infix + "_SubstantivePosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->SubstantivePosition->caption(), $employment_add->SubstantivePosition->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->DateOfCurrentAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->DateOfCurrentAppointment->caption(), $employment_add->DateOfCurrentAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfCurrentAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_add->DateOfCurrentAppointment->errorMessage()) ?>");
			<?php if ($employment_add->LastAppraisalDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->LastAppraisalDate->caption(), $employment_add->LastAppraisalDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAppraisalDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_add->LastAppraisalDate->errorMessage()) ?>");
			<?php if ($employment_add->AppraisalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AppraisalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->AppraisalStatus->caption(), $employment_add->AppraisalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->DateOfExit->caption(), $employment_add->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_add->DateOfExit->errorMessage()) ?>");
			<?php if ($employment_add->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->SalaryScale->caption(), $employment_add->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->EmploymentType->caption(), $employment_add->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->EmploymentStatus->caption(), $employment_add->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->ExitReason->caption(), $employment_add->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->RetirementType->caption(), $employment_add->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->EmployeeNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->EmployeeNumber->caption(), $employment_add->EmployeeNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->SalaryNotch->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryNotch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->SalaryNotch->caption(), $employment_add->SalaryNotch->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->BasicMonthlySalary->caption(), $employment_add->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_add->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($employment_add->ThirdParties->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdParties[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->ThirdParties->caption(), $employment_add->ThirdParties->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_add->PayrollCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->PayrollCode->caption(), $employment_add->PayrollCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_add->PayrollCode->errorMessage()) ?>");
			<?php if ($employment_add->DateOfConfirmation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_add->DateOfConfirmation->caption(), $employment_add->DateOfConfirmation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfConfirmation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_add->DateOfConfirmation->errorMessage()) ?>");

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
	femploymentadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femploymentadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femploymentadd.lists["x_ProvinceCode"] = <?php echo $employment_add->ProvinceCode->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($employment_add->ProvinceCode->lookupOptions()) ?>;
	femploymentadd.lists["x_LACode"] = <?php echo $employment_add->LACode->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_LACode"].options = <?php echo JsonEncode($employment_add->LACode->lookupOptions()) ?>;
	femploymentadd.lists["x_DepartmentCode"] = <?php echo $employment_add->DepartmentCode->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($employment_add->DepartmentCode->lookupOptions()) ?>;
	femploymentadd.lists["x_SectionCode"] = <?php echo $employment_add->SectionCode->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_SectionCode"].options = <?php echo JsonEncode($employment_add->SectionCode->lookupOptions()) ?>;
	femploymentadd.lists["x_SubstantivePosition"] = <?php echo $employment_add->SubstantivePosition->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_SubstantivePosition"].options = <?php echo JsonEncode($employment_add->SubstantivePosition->lookupOptions()) ?>;
	femploymentadd.lists["x_AppraisalStatus"] = <?php echo $employment_add->AppraisalStatus->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_AppraisalStatus"].options = <?php echo JsonEncode($employment_add->AppraisalStatus->lookupOptions()) ?>;
	femploymentadd.lists["x_SalaryScale"] = <?php echo $employment_add->SalaryScale->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_SalaryScale"].options = <?php echo JsonEncode($employment_add->SalaryScale->lookupOptions()) ?>;
	femploymentadd.autoSuggests["x_SalaryScale"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	femploymentadd.lists["x_EmploymentType"] = <?php echo $employment_add->EmploymentType->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_EmploymentType"].options = <?php echo JsonEncode($employment_add->EmploymentType->lookupOptions()) ?>;
	femploymentadd.lists["x_EmploymentStatus"] = <?php echo $employment_add->EmploymentStatus->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_EmploymentStatus"].options = <?php echo JsonEncode($employment_add->EmploymentStatus->lookupOptions()) ?>;
	femploymentadd.lists["x_ExitReason"] = <?php echo $employment_add->ExitReason->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_ExitReason"].options = <?php echo JsonEncode($employment_add->ExitReason->lookupOptions()) ?>;
	femploymentadd.lists["x_RetirementType"] = <?php echo $employment_add->RetirementType->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_RetirementType"].options = <?php echo JsonEncode($employment_add->RetirementType->lookupOptions()) ?>;
	femploymentadd.lists["x_SalaryNotch"] = <?php echo $employment_add->SalaryNotch->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_SalaryNotch"].options = <?php echo JsonEncode($employment_add->SalaryNotch->lookupOptions()) ?>;
	femploymentadd.lists["x_ThirdParties[]"] = <?php echo $employment_add->ThirdParties->Lookup->toClientList($employment_add) ?>;
	femploymentadd.lists["x_ThirdParties[]"].options = <?php echo JsonEncode($employment_add->ThirdParties->lookupOptions()) ?>;
	loadjs.done("femploymentadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_add->showPageHeader(); ?>
<?php
$employment_add->showMessage();
?>
<form name="femploymentadd" id="femploymentadd" class="<?php echo $employment_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employment_add->IsModal ?>">
<?php if ($employment->getCurrentMasterTable() == "position_ref") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="position_ref">
<input type="hidden" name="fk_PositionCode" value="<?php echo HtmlEncode($employment_add->SubstantivePosition->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($employment_add->SectionCode->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($employment_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($employment_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($employment_add->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_SalaryScale" value="<?php echo HtmlEncode($employment_add->SalaryScale->getSessionValue()) ?>">
<?php } ?>
<?php if ($employment->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employment_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($employment_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employment_EmployeeID" for="x_EmployeeID" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->EmployeeID->caption() ?><?php echo $employment_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->EmployeeID->cellAttributes() ?>>
<?php if ($employment_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_employment_EmployeeID">
<span<?php echo $employment_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($employment_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_EmployeeID">
<input type="text" data-table="employment" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_add->EmployeeID->EditValue ?>"<?php echo $employment_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_employment_ProvinceCode" for="x_ProvinceCode" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->ProvinceCode->caption() ?><?php echo $employment_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->ProvinceCode->cellAttributes() ?>>
<?php if ($employment_add->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_employment_ProvinceCode">
<span<?php echo $employment_add->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_add->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($employment_add->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_ProvinceCode">
<?php $employment_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ProvinceCode" data-value-separator="<?php echo $employment_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $employment_add->ProvinceCode->editAttributes() ?>>
			<?php echo $employment_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $employment_add->ProvinceCode->Lookup->getParamTag($employment_add, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $employment_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_employment_LACode" for="x_LACode" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->LACode->caption() ?><?php echo $employment_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->LACode->cellAttributes() ?>>
<?php if ($employment_add->LACode->getSessionValue() != "") { ?>
<span id="el_employment_LACode">
<span<?php echo $employment_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($employment_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_LACode">
<?php $employment_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($employment_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_add->LACode->ReadOnly || $employment_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_add->LACode->Lookup->getParamTag($employment_add, "p_x_LACode") ?>
<input type="hidden" data-table="employment" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $employment_add->LACode->CurrentValue ?>"<?php echo $employment_add->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_employment_DepartmentCode" for="x_DepartmentCode" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->DepartmentCode->caption() ?><?php echo $employment_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->DepartmentCode->cellAttributes() ?>>
<?php if ($employment_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_employment_DepartmentCode">
<span<?php echo $employment_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($employment_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_DepartmentCode">
<?php $employment_add->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($employment_add->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_add->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_add->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_add->DepartmentCode->ReadOnly || $employment_add->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_add->DepartmentCode->Lookup->getParamTag($employment_add, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="employment" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $employment_add->DepartmentCode->CurrentValue ?>"<?php echo $employment_add->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_employment_SectionCode" for="x_SectionCode" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->SectionCode->caption() ?><?php echo $employment_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->SectionCode->cellAttributes() ?>>
<?php if ($employment_add->SectionCode->getSessionValue() != "") { ?>
<span id="el_employment_SectionCode">
<span<?php echo $employment_add->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_add->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SectionCode" name="x_SectionCode" value="<?php echo HtmlEncode($employment_add->SectionCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_SectionCode">
<?php $employment_add->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SectionCode"><?php echo EmptyValue(strval($employment_add->SectionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_add->SectionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_add->SectionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_add->SectionCode->ReadOnly || $employment_add->SectionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SectionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_add->SectionCode->Lookup->getParamTag($employment_add, "p_x_SectionCode") ?>
<input type="hidden" data-table="employment" data-field="x_SectionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_add->SectionCode->displayValueSeparatorAttribute() ?>" name="x_SectionCode" id="x_SectionCode" value="<?php echo $employment_add->SectionCode->CurrentValue ?>"<?php echo $employment_add->SectionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<div id="r_SubstantivePosition" class="form-group row">
		<label id="elh_employment_SubstantivePosition" for="x_SubstantivePosition" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->SubstantivePosition->caption() ?><?php echo $employment_add->SubstantivePosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->SubstantivePosition->cellAttributes() ?>>
<?php if ($employment_add->SubstantivePosition->getSessionValue() != "") { ?>
<span id="el_employment_SubstantivePosition">
<span<?php echo $employment_add->SubstantivePosition->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_add->SubstantivePosition->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SubstantivePosition" name="x_SubstantivePosition" value="<?php echo HtmlEncode($employment_add->SubstantivePosition->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_SubstantivePosition">
<?php $employment_add->SubstantivePosition->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SubstantivePosition"><?php echo EmptyValue(strval($employment_add->SubstantivePosition->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_add->SubstantivePosition->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_add->SubstantivePosition->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_add->SubstantivePosition->ReadOnly || $employment_add->SubstantivePosition->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SubstantivePosition',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_add->SubstantivePosition->Lookup->getParamTag($employment_add, "p_x_SubstantivePosition") ?>
<input type="hidden" data-table="employment" data-field="x_SubstantivePosition" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_add->SubstantivePosition->displayValueSeparatorAttribute() ?>" name="x_SubstantivePosition" id="x_SubstantivePosition" value="<?php echo $employment_add->SubstantivePosition->CurrentValue ?>"<?php echo $employment_add->SubstantivePosition->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employment_add->SubstantivePosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<div id="r_DateOfCurrentAppointment" class="form-group row">
		<label id="elh_employment_DateOfCurrentAppointment" for="x_DateOfCurrentAppointment" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->DateOfCurrentAppointment->caption() ?><?php echo $employment_add->DateOfCurrentAppointment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el_employment_DateOfCurrentAppointment">
<input type="text" data-table="employment" data-field="x_DateOfCurrentAppointment" name="x_DateOfCurrentAppointment" id="x_DateOfCurrentAppointment" placeholder="<?php echo HtmlEncode($employment_add->DateOfCurrentAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_add->DateOfCurrentAppointment->EditValue ?>"<?php echo $employment_add->DateOfCurrentAppointment->editAttributes() ?>>
<?php if (!$employment_add->DateOfCurrentAppointment->ReadOnly && !$employment_add->DateOfCurrentAppointment->Disabled && !isset($employment_add->DateOfCurrentAppointment->EditAttrs["readonly"]) && !isset($employment_add->DateOfCurrentAppointment->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentadd", "x_DateOfCurrentAppointment", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_add->DateOfCurrentAppointment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
	<div id="r_LastAppraisalDate" class="form-group row">
		<label id="elh_employment_LastAppraisalDate" for="x_LastAppraisalDate" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->LastAppraisalDate->caption() ?><?php echo $employment_add->LastAppraisalDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->LastAppraisalDate->cellAttributes() ?>>
<span id="el_employment_LastAppraisalDate">
<input type="text" data-table="employment" data-field="x_LastAppraisalDate" name="x_LastAppraisalDate" id="x_LastAppraisalDate" placeholder="<?php echo HtmlEncode($employment_add->LastAppraisalDate->getPlaceHolder()) ?>" value="<?php echo $employment_add->LastAppraisalDate->EditValue ?>"<?php echo $employment_add->LastAppraisalDate->editAttributes() ?>>
<?php if (!$employment_add->LastAppraisalDate->ReadOnly && !$employment_add->LastAppraisalDate->Disabled && !isset($employment_add->LastAppraisalDate->EditAttrs["readonly"]) && !isset($employment_add->LastAppraisalDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentadd", "x_LastAppraisalDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_add->LastAppraisalDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<div id="r_AppraisalStatus" class="form-group row">
		<label id="elh_employment_AppraisalStatus" for="x_AppraisalStatus" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->AppraisalStatus->caption() ?><?php echo $employment_add->AppraisalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->AppraisalStatus->cellAttributes() ?>>
<span id="el_employment_AppraisalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_AppraisalStatus" data-value-separator="<?php echo $employment_add->AppraisalStatus->displayValueSeparatorAttribute() ?>" id="x_AppraisalStatus" name="x_AppraisalStatus"<?php echo $employment_add->AppraisalStatus->editAttributes() ?>>
			<?php echo $employment_add->AppraisalStatus->selectOptionListHtml("x_AppraisalStatus") ?>
		</select>
</div>
<?php echo $employment_add->AppraisalStatus->Lookup->getParamTag($employment_add, "p_x_AppraisalStatus") ?>
</span>
<?php echo $employment_add->AppraisalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_employment_DateOfExit" for="x_DateOfExit" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->DateOfExit->caption() ?><?php echo $employment_add->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->DateOfExit->cellAttributes() ?>>
<span id="el_employment_DateOfExit">
<input type="text" data-table="employment" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($employment_add->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_add->DateOfExit->EditValue ?>"<?php echo $employment_add->DateOfExit->editAttributes() ?>>
<?php if (!$employment_add->DateOfExit->ReadOnly && !$employment_add->DateOfExit->Disabled && !isset($employment_add->DateOfExit->EditAttrs["readonly"]) && !isset($employment_add->DateOfExit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentadd", "x_DateOfExit", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_add->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_employment_SalaryScale" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->SalaryScale->caption() ?><?php echo $employment_add->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->SalaryScale->cellAttributes() ?>>
<?php if ($employment_add->SalaryScale->getSessionValue() != "") { ?>
<span id="el_employment_SalaryScale">
<span<?php echo $employment_add->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employment_add->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SalaryScale" name="x_SalaryScale" value="<?php echo HtmlEncode($employment_add->SalaryScale->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employment_SalaryScale">
<?php
$onchange = $employment_add->SalaryScale->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employment_add->SalaryScale->EditAttrs["onchange"] = "";
?>
<span id="as_x_SalaryScale">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_SalaryScale" id="sv_x_SalaryScale" value="<?php echo RemoveHtml($employment_add->SalaryScale->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_add->SalaryScale->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employment_add->SalaryScale->getPlaceHolder()) ?>"<?php echo $employment_add->SalaryScale->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_add->SalaryScale->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_SalaryScale',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($employment_add->SalaryScale->ReadOnly || $employment_add->SalaryScale->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="employment" data-field="x_SalaryScale" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_add->SalaryScale->displayValueSeparatorAttribute() ?>" name="x_SalaryScale" id="x_SalaryScale" value="<?php echo HtmlEncode($employment_add->SalaryScale->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femploymentadd"], function() {
	femploymentadd.createAutoSuggest({"id":"x_SalaryScale","forceSelect":true});
});
</script>
<?php echo $employment_add->SalaryScale->Lookup->getParamTag($employment_add, "p_x_SalaryScale") ?>
</span>
<?php } ?>
<?php echo $employment_add->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->EmploymentType->Visible) { // EmploymentType ?>
	<div id="r_EmploymentType" class="form-group row">
		<label id="elh_employment_EmploymentType" for="x_EmploymentType" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->EmploymentType->caption() ?><?php echo $employment_add->EmploymentType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->EmploymentType->cellAttributes() ?>>
<span id="el_employment_EmploymentType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentType" data-value-separator="<?php echo $employment_add->EmploymentType->displayValueSeparatorAttribute() ?>" id="x_EmploymentType" name="x_EmploymentType"<?php echo $employment_add->EmploymentType->editAttributes() ?>>
			<?php echo $employment_add->EmploymentType->selectOptionListHtml("x_EmploymentType") ?>
		</select>
</div>
<?php echo $employment_add->EmploymentType->Lookup->getParamTag($employment_add, "p_x_EmploymentType") ?>
</span>
<?php echo $employment_add->EmploymentType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<div id="r_EmploymentStatus" class="form-group row">
		<label id="elh_employment_EmploymentStatus" for="x_EmploymentStatus" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->EmploymentStatus->caption() ?><?php echo $employment_add->EmploymentStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->EmploymentStatus->cellAttributes() ?>>
<span id="el_employment_EmploymentStatus">
<?php $employment_add->EmploymentStatus->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_EmploymentStatus" data-value-separator="<?php echo $employment_add->EmploymentStatus->displayValueSeparatorAttribute() ?>" id="x_EmploymentStatus" name="x_EmploymentStatus"<?php echo $employment_add->EmploymentStatus->editAttributes() ?>>
			<?php echo $employment_add->EmploymentStatus->selectOptionListHtml("x_EmploymentStatus") ?>
		</select>
</div>
<?php echo $employment_add->EmploymentStatus->Lookup->getParamTag($employment_add, "p_x_EmploymentStatus") ?>
</span>
<?php echo $employment_add->EmploymentStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_employment_ExitReason" for="x_ExitReason" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->ExitReason->caption() ?><?php echo $employment_add->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->ExitReason->cellAttributes() ?>>
<span id="el_employment_ExitReason">
<?php $employment_add->ExitReason->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_ExitReason" data-value-separator="<?php echo $employment_add->ExitReason->displayValueSeparatorAttribute() ?>" id="x_ExitReason" name="x_ExitReason"<?php echo $employment_add->ExitReason->editAttributes() ?>>
			<?php echo $employment_add->ExitReason->selectOptionListHtml("x_ExitReason") ?>
		</select>
</div>
<?php echo $employment_add->ExitReason->Lookup->getParamTag($employment_add, "p_x_ExitReason") ?>
</span>
<?php echo $employment_add->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_employment_RetirementType" for="x_RetirementType" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->RetirementType->caption() ?><?php echo $employment_add->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->RetirementType->cellAttributes() ?>>
<span id="el_employment_RetirementType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="employment" data-field="x_RetirementType" data-value-separator="<?php echo $employment_add->RetirementType->displayValueSeparatorAttribute() ?>" id="x_RetirementType" name="x_RetirementType"<?php echo $employment_add->RetirementType->editAttributes() ?>>
			<?php echo $employment_add->RetirementType->selectOptionListHtml("x_RetirementType") ?>
		</select>
</div>
<?php echo $employment_add->RetirementType->Lookup->getParamTag($employment_add, "p_x_RetirementType") ?>
</span>
<?php echo $employment_add->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->EmployeeNumber->Visible) { // EmployeeNumber ?>
	<div id="r_EmployeeNumber" class="form-group row">
		<label id="elh_employment_EmployeeNumber" for="x_EmployeeNumber" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->EmployeeNumber->caption() ?><?php echo $employment_add->EmployeeNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->EmployeeNumber->cellAttributes() ?>>
<span id="el_employment_EmployeeNumber">
<input type="text" data-table="employment" data-field="x_EmployeeNumber" name="x_EmployeeNumber" id="x_EmployeeNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employment_add->EmployeeNumber->getPlaceHolder()) ?>" value="<?php echo $employment_add->EmployeeNumber->EditValue ?>"<?php echo $employment_add->EmployeeNumber->editAttributes() ?>>
</span>
<?php echo $employment_add->EmployeeNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->SalaryNotch->Visible) { // SalaryNotch ?>
	<div id="r_SalaryNotch" class="form-group row">
		<label id="elh_employment_SalaryNotch" for="x_SalaryNotch" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->SalaryNotch->caption() ?><?php echo $employment_add->SalaryNotch->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->SalaryNotch->cellAttributes() ?>>
<span id="el_employment_SalaryNotch">
<?php $employment_add->SalaryNotch->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_SalaryNotch"><?php echo EmptyValue(strval($employment_add->SalaryNotch->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_add->SalaryNotch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_add->SalaryNotch->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_add->SalaryNotch->ReadOnly || $employment_add->SalaryNotch->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_SalaryNotch',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_add->SalaryNotch->Lookup->getParamTag($employment_add, "p_x_SalaryNotch") ?>
<input type="hidden" data-table="employment" data-field="x_SalaryNotch" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $employment_add->SalaryNotch->displayValueSeparatorAttribute() ?>" name="x_SalaryNotch" id="x_SalaryNotch" value="<?php echo $employment_add->SalaryNotch->CurrentValue ?>"<?php echo $employment_add->SalaryNotch->editAttributes() ?>>
</span>
<?php echo $employment_add->SalaryNotch->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<div id="r_BasicMonthlySalary" class="form-group row">
		<label id="elh_employment_BasicMonthlySalary" for="x_BasicMonthlySalary" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->BasicMonthlySalary->caption() ?><?php echo $employment_add->BasicMonthlySalary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->BasicMonthlySalary->cellAttributes() ?>>
<span id="el_employment_BasicMonthlySalary">
<input type="text" data-table="employment" data-field="x_BasicMonthlySalary" name="x_BasicMonthlySalary" id="x_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($employment_add->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $employment_add->BasicMonthlySalary->EditValue ?>"<?php echo $employment_add->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php echo $employment_add->BasicMonthlySalary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->ThirdParties->Visible) { // ThirdParties ?>
	<div id="r_ThirdParties" class="form-group row">
		<label id="elh_employment_ThirdParties" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->ThirdParties->caption() ?><?php echo $employment_add->ThirdParties->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->ThirdParties->cellAttributes() ?>>
<span id="el_employment_ThirdParties">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ThirdParties"><?php echo EmptyValue(strval($employment_add->ThirdParties->ViewValue)) ? $Language->phrase("PleaseSelect") : $employment_add->ThirdParties->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($employment_add->ThirdParties->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($employment_add->ThirdParties->ReadOnly || $employment_add->ThirdParties->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ThirdParties[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $employment_add->ThirdParties->Lookup->getParamTag($employment_add, "p_x_ThirdParties") ?>
<input type="hidden" data-table="employment" data-field="x_ThirdParties" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $employment_add->ThirdParties->displayValueSeparatorAttribute() ?>" name="x_ThirdParties[]" id="x_ThirdParties[]" value="<?php echo $employment_add->ThirdParties->CurrentValue ?>"<?php echo $employment_add->ThirdParties->editAttributes() ?>>
</span>
<?php echo $employment_add->ThirdParties->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->PayrollCode->Visible) { // PayrollCode ?>
	<div id="r_PayrollCode" class="form-group row">
		<label id="elh_employment_PayrollCode" for="x_PayrollCode" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->PayrollCode->caption() ?><?php echo $employment_add->PayrollCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->PayrollCode->cellAttributes() ?>>
<span id="el_employment_PayrollCode">
<input type="text" data-table="employment" data-field="x_PayrollCode" name="x_PayrollCode" id="x_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($employment_add->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $employment_add->PayrollCode->EditValue ?>"<?php echo $employment_add->PayrollCode->editAttributes() ?>>
</span>
<?php echo $employment_add->PayrollCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_add->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<div id="r_DateOfConfirmation" class="form-group row">
		<label id="elh_employment_DateOfConfirmation" for="x_DateOfConfirmation" class="<?php echo $employment_add->LeftColumnClass ?>"><?php echo $employment_add->DateOfConfirmation->caption() ?><?php echo $employment_add->DateOfConfirmation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_add->RightColumnClass ?>"><div <?php echo $employment_add->DateOfConfirmation->cellAttributes() ?>>
<span id="el_employment_DateOfConfirmation">
<input type="text" data-table="employment" data-field="x_DateOfConfirmation" name="x_DateOfConfirmation" id="x_DateOfConfirmation" maxlength="10" placeholder="<?php echo HtmlEncode($employment_add->DateOfConfirmation->getPlaceHolder()) ?>" value="<?php echo $employment_add->DateOfConfirmation->EditValue ?>"<?php echo $employment_add->DateOfConfirmation->editAttributes() ?>>
<?php if (!$employment_add->DateOfConfirmation->ReadOnly && !$employment_add->DateOfConfirmation->Disabled && !isset($employment_add->DateOfConfirmation->EditAttrs["readonly"]) && !isset($employment_add->DateOfConfirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femploymentadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femploymentadd", "x_DateOfConfirmation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employment_add->DateOfConfirmation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("leave_record", explode(",", $employment->getCurrentDetailTable())) && $leave_record->DetailAdd) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("leave_record", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "leave_recordgrid.php" ?>
<?php } ?>
<?php
	if (in_array("leave_taken", explode(",", $employment->getCurrentDetailTable())) && $leave_taken->DetailAdd) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("leave_taken", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "leave_takengrid.php" ?>
<?php } ?>
<?php
	if (in_array("employee_obligation", explode(",", $employment->getCurrentDetailTable())) && $employee_obligation->DetailAdd) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_obligation", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_obligationgrid.php" ?>
<?php } ?>
<?php
	if (in_array("employee_income", explode(",", $employment->getCurrentDetailTable())) && $employee_income->DetailAdd) {
?>
<?php if ($employment->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_income", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_incomegrid.php" ?>
<?php } ?>
<?php if (!$employment_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_add->showPageFooter();
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
$employment_add->terminate();
?>