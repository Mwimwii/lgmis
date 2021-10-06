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
$employee_obligation_edit = new employee_obligation_edit();

// Run the page
$employee_obligation_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_obligation_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployee_obligationedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femployee_obligationedit = currentForm = new ew.Form("femployee_obligationedit", "edit");

	// Validate form
	femployee_obligationedit.validate = function() {
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
			<?php if ($employee_obligation_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->EmployeeID->caption(), $employee_obligation_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($employee_obligation_edit->PaidPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->PaidPosition->caption(), $employee_obligation_edit->PaidPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PaidPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_edit->PaidPosition->errorMessage()) ?>");
			<?php if ($employee_obligation_edit->PayrollDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->PayrollDate->caption(), $employee_obligation_edit->PayrollDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_edit->PayrollDate->errorMessage()) ?>");
			<?php if ($employee_obligation_edit->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->PayrollPeriod->caption(), $employee_obligation_edit->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_edit->PayrollPeriod->errorMessage()) ?>");
			<?php if ($employee_obligation_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->StartDate->caption(), $employee_obligation_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_edit->StartDate->errorMessage()) ?>");
			<?php if ($employee_obligation_edit->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->Enddate->caption(), $employee_obligation_edit->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_edit->Enddate->errorMessage()) ?>");
			<?php if ($employee_obligation_edit->ObligationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->ObligationCode->caption(), $employee_obligation_edit->ObligationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employee_obligation_edit->ObligationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->ObligationAmount->caption(), $employee_obligation_edit->ObligationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ObligationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employee_obligation_edit->ObligationAmount->errorMessage()) ?>");
			<?php if ($employee_obligation_edit->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employee_obligation_edit->Remarks->caption(), $employee_obligation_edit->Remarks->RequiredErrorMessage)) ?>");
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
	femployee_obligationedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployee_obligationedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	femployee_obligationedit.lists["x_PaidPosition"] = <?php echo $employee_obligation_edit->PaidPosition->Lookup->toClientList($employee_obligation_edit) ?>;
	femployee_obligationedit.lists["x_PaidPosition"].options = <?php echo JsonEncode($employee_obligation_edit->PaidPosition->lookupOptions()) ?>;
	femployee_obligationedit.autoSuggests["x_PaidPosition"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("femployee_obligationedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employee_obligation_edit->showPageHeader(); ?>
<?php
$employee_obligation_edit->showMessage();
?>
<?php if (!$employee_obligation_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_obligation_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="femployee_obligationedit" id="femployee_obligationedit" class="<?php echo $employee_obligation_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_obligation">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employee_obligation_edit->IsModal ?>">
<?php if ($employee_obligation->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($employee_obligation_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employee_obligation_EmployeeID" for="x_EmployeeID" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->EmployeeID->caption() ?><?php echo $employee_obligation_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->EmployeeID->cellAttributes() ?>>
<?php if ($employee_obligation_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_employee_obligation_EmployeeID">
<span<?php echo $employee_obligation_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($employee_obligation_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="employee_obligation" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_edit->EmployeeID->EditValue ?>"<?php echo $employee_obligation_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="employee_obligation" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($employee_obligation_edit->EmployeeID->OldValue != null ? $employee_obligation_edit->EmployeeID->OldValue : $employee_obligation_edit->EmployeeID->CurrentValue) ?>">
<?php echo $employee_obligation_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->PaidPosition->Visible) { // PaidPosition ?>
	<div id="r_PaidPosition" class="form-group row">
		<label id="elh_employee_obligation_PaidPosition" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->PaidPosition->caption() ?><?php echo $employee_obligation_edit->PaidPosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->PaidPosition->cellAttributes() ?>>
<span id="el_employee_obligation_PaidPosition">
<?php
$onchange = $employee_obligation_edit->PaidPosition->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$employee_obligation_edit->PaidPosition->EditAttrs["onchange"] = "";
?>
<span id="as_x_PaidPosition">
	<input type="text" class="form-control" name="sv_x_PaidPosition" id="sv_x_PaidPosition" value="<?php echo RemoveHtml($employee_obligation_edit->PaidPosition->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_edit->PaidPosition->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($employee_obligation_edit->PaidPosition->getPlaceHolder()) ?>"<?php echo $employee_obligation_edit->PaidPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employee_obligation" data-field="x_PaidPosition" data-value-separator="<?php echo $employee_obligation_edit->PaidPosition->displayValueSeparatorAttribute() ?>" name="x_PaidPosition" id="x_PaidPosition" value="<?php echo HtmlEncode($employee_obligation_edit->PaidPosition->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["femployee_obligationedit"], function() {
	femployee_obligationedit.createAutoSuggest({"id":"x_PaidPosition","forceSelect":false});
});
</script>
<?php echo $employee_obligation_edit->PaidPosition->Lookup->getParamTag($employee_obligation_edit, "p_x_PaidPosition") ?>
</span>
<?php echo $employee_obligation_edit->PaidPosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->PayrollDate->Visible) { // PayrollDate ?>
	<div id="r_PayrollDate" class="form-group row">
		<label id="elh_employee_obligation_PayrollDate" for="x_PayrollDate" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->PayrollDate->caption() ?><?php echo $employee_obligation_edit->PayrollDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->PayrollDate->cellAttributes() ?>>
<span id="el_employee_obligation_PayrollDate">
<input type="text" data-table="employee_obligation" data-field="x_PayrollDate" name="x_PayrollDate" id="x_PayrollDate" placeholder="<?php echo HtmlEncode($employee_obligation_edit->PayrollDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_edit->PayrollDate->EditValue ?>"<?php echo $employee_obligation_edit->PayrollDate->editAttributes() ?>>
<?php if (!$employee_obligation_edit->PayrollDate->ReadOnly && !$employee_obligation_edit->PayrollDate->Disabled && !isset($employee_obligation_edit->PayrollDate->EditAttrs["readonly"]) && !isset($employee_obligation_edit->PayrollDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationedit", "x_PayrollDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_obligation_edit->PayrollDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<div id="r_PayrollPeriod" class="form-group row">
		<label id="elh_employee_obligation_PayrollPeriod" for="x_PayrollPeriod" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->PayrollPeriod->caption() ?><?php echo $employee_obligation_edit->PayrollPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->PayrollPeriod->cellAttributes() ?>>
<input type="text" data-table="employee_obligation" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_edit->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_edit->PayrollPeriod->EditValue ?>"<?php echo $employee_obligation_edit->PayrollPeriod->editAttributes() ?>>
<input type="hidden" data-table="employee_obligation" data-field="x_PayrollPeriod" name="o_PayrollPeriod" id="o_PayrollPeriod" value="<?php echo HtmlEncode($employee_obligation_edit->PayrollPeriod->OldValue != null ? $employee_obligation_edit->PayrollPeriod->OldValue : $employee_obligation_edit->PayrollPeriod->CurrentValue) ?>">
<?php echo $employee_obligation_edit->PayrollPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_employee_obligation_StartDate" for="x_StartDate" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->StartDate->caption() ?><?php echo $employee_obligation_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->StartDate->cellAttributes() ?>>
<span id="el_employee_obligation_StartDate">
<input type="text" data-table="employee_obligation" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($employee_obligation_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_edit->StartDate->EditValue ?>"<?php echo $employee_obligation_edit->StartDate->editAttributes() ?>>
<?php if (!$employee_obligation_edit->StartDate->ReadOnly && !$employee_obligation_edit->StartDate->Disabled && !isset($employee_obligation_edit->StartDate->EditAttrs["readonly"]) && !isset($employee_obligation_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_obligation_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->Enddate->Visible) { // Enddate ?>
	<div id="r_Enddate" class="form-group row">
		<label id="elh_employee_obligation_Enddate" for="x_Enddate" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->Enddate->caption() ?><?php echo $employee_obligation_edit->Enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->Enddate->cellAttributes() ?>>
<span id="el_employee_obligation_Enddate">
<input type="text" data-table="employee_obligation" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" placeholder="<?php echo HtmlEncode($employee_obligation_edit->Enddate->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_edit->Enddate->EditValue ?>"<?php echo $employee_obligation_edit->Enddate->editAttributes() ?>>
<?php if (!$employee_obligation_edit->Enddate->ReadOnly && !$employee_obligation_edit->Enddate->Disabled && !isset($employee_obligation_edit->Enddate->EditAttrs["readonly"]) && !isset($employee_obligation_edit->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["femployee_obligationedit", "datetimepicker"], function() {
	ew.createDateTimePicker("femployee_obligationedit", "x_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $employee_obligation_edit->Enddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->ObligationCode->Visible) { // ObligationCode ?>
	<div id="r_ObligationCode" class="form-group row">
		<label id="elh_employee_obligation_ObligationCode" for="x_ObligationCode" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->ObligationCode->caption() ?><?php echo $employee_obligation_edit->ObligationCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->ObligationCode->cellAttributes() ?>>
<input type="text" data-table="employee_obligation" data-field="x_ObligationCode" name="x_ObligationCode" id="x_ObligationCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($employee_obligation_edit->ObligationCode->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_edit->ObligationCode->EditValue ?>"<?php echo $employee_obligation_edit->ObligationCode->editAttributes() ?>>
<input type="hidden" data-table="employee_obligation" data-field="x_ObligationCode" name="o_ObligationCode" id="o_ObligationCode" value="<?php echo HtmlEncode($employee_obligation_edit->ObligationCode->OldValue != null ? $employee_obligation_edit->ObligationCode->OldValue : $employee_obligation_edit->ObligationCode->CurrentValue) ?>">
<?php echo $employee_obligation_edit->ObligationCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->ObligationAmount->Visible) { // ObligationAmount ?>
	<div id="r_ObligationAmount" class="form-group row">
		<label id="elh_employee_obligation_ObligationAmount" for="x_ObligationAmount" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->ObligationAmount->caption() ?><?php echo $employee_obligation_edit->ObligationAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->ObligationAmount->cellAttributes() ?>>
<span id="el_employee_obligation_ObligationAmount">
<input type="text" data-table="employee_obligation" data-field="x_ObligationAmount" name="x_ObligationAmount" id="x_ObligationAmount" size="30" placeholder="<?php echo HtmlEncode($employee_obligation_edit->ObligationAmount->getPlaceHolder()) ?>" value="<?php echo $employee_obligation_edit->ObligationAmount->EditValue ?>"<?php echo $employee_obligation_edit->ObligationAmount->editAttributes() ?>>
</span>
<?php echo $employee_obligation_edit->ObligationAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employee_obligation_edit->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_employee_obligation_Remarks" for="x_Remarks" class="<?php echo $employee_obligation_edit->LeftColumnClass ?>"><?php echo $employee_obligation_edit->Remarks->caption() ?><?php echo $employee_obligation_edit->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employee_obligation_edit->RightColumnClass ?>"><div <?php echo $employee_obligation_edit->Remarks->cellAttributes() ?>>
<span id="el_employee_obligation_Remarks">
<textarea data-table="employee_obligation" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employee_obligation_edit->Remarks->getPlaceHolder()) ?>"<?php echo $employee_obligation_edit->Remarks->editAttributes() ?>><?php echo $employee_obligation_edit->Remarks->EditValue ?></textarea>
</span>
<?php echo $employee_obligation_edit->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employee_obligation_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employee_obligation_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employee_obligation_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$employee_obligation_edit->IsModal) { ?>
<?php echo $employee_obligation_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$employee_obligation_edit->showPageFooter();
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
$employee_obligation_edit->terminate();
?>