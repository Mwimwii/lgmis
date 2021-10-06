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
$employee_obligation_add = new employee_obligation_add();

// Run the page
$employee_obligation_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_obligationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femployee_obligationadd = currentForm = new ew.Form("femployee_obligationadd", "add");

	// Validate form
	femployee_obligationadd.validate = function() {
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
			<?php if ($employee_obligation_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->EmployeeID->caption(), $employee_obligation_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_add->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_obligation_add->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->PaidPosition->caption(), $employee_obligation_add->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_add->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_obligation_add->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->PayrollDate->caption(), $employee_obligation_add->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_add->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_obligation_add->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->PayrollPeriod->caption(), $employee_obligation_add->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_add->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_obligation_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->StartDate->caption(), $employee_obligation_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_add->StartDate->errorMessage()) ?>");
			<?php if ($employee_obligation_add->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->Enddate->caption(), $employee_obligation_add->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_add->Enddate->errorMessage()) ?>");
			<?php if ($employee_obligation_add->ObligationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->ObligationCode->caption(), $employee_obligation_add->ObligationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_obligation_add->ObligationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->ObligationAmount->caption(), $employee_obligation_add->ObligationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_add->ObligationAmount->errorMessage()) ?>");
			<?php if ($employee_obligation_add->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_add->Remarks->caption(), $employee_obligation_add->Remarks->RequiredErrorMessage)) ?>");
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
	femployee_obligationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_obligationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_obligationadd.lists["x_PaidPosition"] = <?php echo $employee_obligation_add->PaidPosition->Lookup->toClientList($employee_obligation_add) ?>;
	femployee_obligationadd.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_obligation_add->PaidPosition->lookupOptions()) ?>;
	femployee_obligationadd.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("femployee_obligationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_obligation_add->showPageHeader(); ?>
<?php
$employee_obligation_add->showMessage();
?>
<form name="femployee_obligationadd" id="femployee_obligationadd" class="<?php echo $employee_obligation_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_obligation">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employee_obligation_add->IsModal ?>">
<?php if ($employee_obligation->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($employee_obligation_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employee_obligation_EmployeeID" for="x_EmployeeID" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->EmployeeID->caption() ?><?php echo $employee_obligation_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->EmployeeID->cellAttributes() ?>>
<?php if ($employee_obligation_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_employee_obligation_EmployeeID">
<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_add->EmployeeID->EditValue ?>"<?php echo $employee_obligation_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $employee_obligation_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->PaidPosition->Visible) { // PaidPosition ?>
	<div id="r_PaidPosition" class="form-group row">
		<label id="elh_employee_obligation_PaidPosition" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->PaidPosition->caption() ?><?php echo $employee_obligation_add->PaidPosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->PaidPosition->cellAttributes() ?>>
<span id="el_employee_obligation_PaidPosition">
<?php
$onchange = $employee_obligation_add->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_add->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaidPosition">
	<input type="text" class="form-control" name="sv_x_PaidPosition" id="sv_x_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_add->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_add->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_add->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_add->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_add->PaidPosition->displayValueSeparatorAttribute() ?>" name="x_PaidPosition" id="x_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_add->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationadd"], function() {
	femployee_obligationadd.createAutoSuggest({"id":"x_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_add->PaidPosition->Lookup->getParamTag($employee_obligation_add, "p_x_PaidPosition") ?>
</span>
<?php echo $employee_obligation_add->PaidPosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->PayrollDate->Visible) { // PayrollDate ?>
	<div id="r_PayrollDate" class="form-group row">
		<label id="elh_employee_obligation_PayrollDate" for="x_PayrollDate" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->PayrollDate->caption() ?><?php echo $employee_obligation_add->PayrollDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->PayrollDate->cellAttributes() ?>>
<span id="el_employee_obligation_PayrollDate">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_add->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_add->PayrollDate->EditValue ?>"<?php echo $employee_obligation_add->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_add->PayrollDate->ReadOnly && !$employee_obligation_add->PayrollDate->Disabled && !isset($employee_obligation_add->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_add->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationadd", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_obligation_add->PayrollDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label id="elh_employee_obligation_PayrollPeriod" for="x_PayrollPeriod" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->PayrollPeriod->caption() ?><?php echo $employee_obligation_add->PayrollPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->PayrollPeriod->cellAttributes() ?>>
<span id="el_employee_obligation_PayrollPeriod">
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_add->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_add->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_add->PayrollPeriod->editAttributes() ?>>
</span>
<?php echo $employee_obligation_add->PayrollPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_employee_obligation_StartDate" for="x_StartDate" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->StartDate->caption() ?><?php echo $employee_obligation_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->StartDate->cellAttributes() ?>>
<span id="el_employee_obligation_StartDate">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_add->StartDate->EditValue ?>"<?php echo $employee_obligation_add->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_add->StartDate->ReadOnly && !$employee_obligation_add->StartDate->Disabled && !isset($employee_obligation_add->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_obligation_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->Enddate->Visible) { // Enddate ?>
	<div id="r_Enddate" class="form-group row">
		<label id="elh_employee_obligation_Enddate" for="x_Enddate" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->Enddate->caption() ?><?php echo $employee_obligation_add->Enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->Enddate->cellAttributes() ?>>
<span id="el_employee_obligation_Enddate">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_add->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_add->Enddate->EditValue ?>"<?php echo $employee_obligation_add->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_add->Enddate->ReadOnly && !$employee_obligation_add->Enddate->Disabled && !isset($employee_obligation_add->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_add->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationadd", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationadd", "x_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_obligation_add->Enddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->ObligationCode->Visible) { // ObligationCode ?>
	<div id="r_ObligationCode" class="form-group row">
		<label id="elh_employee_obligation_ObligationCode" for="x_ObligationCode" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->ObligationCode->caption() ?><?php echo $employee_obligation_add->ObligationCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->ObligationCode->cellAttributes() ?>>
<span id="el_employee_obligation_ObligationCode">
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x_ObligationCode" id="x_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_add->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_add->ObligationCode->EditValue ?>"<?php echo $employee_obligation_add->ObligationCode->editAttributes() ?>>
</span>
<?php echo $employee_obligation_add->ObligationCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->ObligationAmount->Visible) { // ObligationAmount ?>
	<div id="r_ObligationAmount" class="form-group row">
		<label id="elh_employee_obligation_ObligationAmount" for="x_ObligationAmount" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->ObligationAmount->caption() ?><?php echo $employee_obligation_add->ObligationAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->ObligationAmount->cellAttributes() ?>>
<span id="el_employee_obligation_ObligationAmount">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x_ObligationAmount" id="x_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_add->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_add->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_add->ObligationAmount->editAttributes() ?>>
</span>
<?php echo $employee_obligation_add->ObligationAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_add->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_employee_obligation_Remarks" for="x_Remarks" class="<?php echo $employee_obligation_add->LeftColumnClass ?>"><?php echo $employee_obligation_add->Remarks->caption() ?><?php echo $employee_obligation_add->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_add->RightColumnClass ?>"><div <?php echo $employee_obligation_add->Remarks->cellAttributes() ?>>
<span id="el_employee_obligation_Remarks">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_add->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_add->Remarks->editAttributes() ?>><?php echo $employee_obligation_add->Remarks->EditValue ?></textarea>
</span>
<?php echo $employee_obligation_add->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_obligation_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_obligation_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_obligation_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employee_obligation_add->showPageFooter();
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
$employee_obligation_add->terminate();
?>