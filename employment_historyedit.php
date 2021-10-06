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
$employment_history_edit = new employment_history_edit();

// Run the page
$employment_history_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_history_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_historyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	femployment_historyedit = currentForm = new ew.Form("femployment_historyedit", "edit");

	// Validate form
	femployment_historyedit.validate = function() {
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
			<?php if ($employment_history_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->EmployeeID->caption(), $employment_history_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_history_edit->Position->Required) { ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->Position->caption(), $employment_history_edit->Position->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->Position->errorMessage()) ?>");
			<?php if ($employment_history_edit->DateOfAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->DateOfAppointment->caption(), $employment_history_edit->DateOfAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->DateOfAppointment->errorMessage()) ?>");
			<?php if ($employment_history_edit->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->DateOfExit->caption(), $employment_history_edit->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->DateOfExit->errorMessage()) ?>");
			<?php if ($employment_history_edit->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->SalaryScale->caption(), $employment_history_edit->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_history_edit->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->EmploymentType->caption(), $employment_history_edit->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->EmploymentType->errorMessage()) ?>");
			<?php if ($employment_history_edit->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->EmploymentStatus->caption(), $employment_history_edit->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->EmploymentStatus->errorMessage()) ?>");
			<?php if ($employment_history_edit->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->ExitReason->caption(), $employment_history_edit->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->ExitReason->errorMessage()) ?>");
			<?php if ($employment_history_edit->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_edit->RetirementType->caption(), $employment_history_edit->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_edit->RetirementType->errorMessage()) ?>");

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
	femployment_historyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_historyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_historyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_history_edit->showPageHeader(); ?>
<?php
$employment_history_edit->showMessage();
?>
<?php if (!$employment_history_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_history_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="femployment_historyedit" id="femployment_historyedit" class="<?php echo $employment_history_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_history">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employment_history_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($employment_history_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employment_history_EmployeeID" for="x_EmployeeID" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->EmployeeID->caption() ?><?php echo $employment_history_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->EmployeeID->cellAttributes() ?>>
<input type="text" data-table="employment_history" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_history_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->EmployeeID->EditValue ?>"<?php echo $employment_history_edit->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="employment_history" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($employment_history_edit->EmployeeID->OldValue != null ? $employment_history_edit->EmployeeID->OldValue : $employment_history_edit->EmployeeID->CurrentValue) ?>">
<?php echo $employment_history_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->Position->Visible) { // Position ?>
	<div id="r_Position" class="form-group row">
		<label id="elh_employment_history_Position" for="x_Position" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->Position->caption() ?><?php echo $employment_history_edit->Position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->Position->cellAttributes() ?>>
<input type="text" data-table="employment_history" data-field="x_Position" name="x_Position" id="x_Position" size="30" placeholder="<?php echo HtmlEncode($employment_history_edit->Position->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->Position->EditValue ?>"<?php echo $employment_history_edit->Position->editAttributes() ?>>
<input type="hidden" data-table="employment_history" data-field="x_Position" name="o_Position" id="o_Position" value="<?php echo HtmlEncode($employment_history_edit->Position->OldValue != null ? $employment_history_edit->Position->OldValue : $employment_history_edit->Position->CurrentValue) ?>">
<?php echo $employment_history_edit->Position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->DateOfAppointment->Visible) { // DateOfAppointment ?>
	<div id="r_DateOfAppointment" class="form-group row">
		<label id="elh_employment_history_DateOfAppointment" for="x_DateOfAppointment" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->DateOfAppointment->caption() ?><?php echo $employment_history_edit->DateOfAppointment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->DateOfAppointment->cellAttributes() ?>>
<input type="text" data-table="employment_history" data-field="x_DateOfAppointment" name="x_DateOfAppointment" id="x_DateOfAppointment" placeholder="<?php echo HtmlEncode($employment_history_edit->DateOfAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->DateOfAppointment->EditValue ?>"<?php echo $employment_history_edit->DateOfAppointment->editAttributes() ?>>
<input type="hidden" data-table="employment_history" data-field="x_DateOfAppointment" name="o_DateOfAppointment" id="o_DateOfAppointment" value="<?php echo HtmlEncode($employment_history_edit->DateOfAppointment->OldValue != null ? $employment_history_edit->DateOfAppointment->OldValue : $employment_history_edit->DateOfAppointment->CurrentValue) ?>">
<?php echo $employment_history_edit->DateOfAppointment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_employment_history_DateOfExit" for="x_DateOfExit" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->DateOfExit->caption() ?><?php echo $employment_history_edit->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->DateOfExit->cellAttributes() ?>>
<span id="el_employment_history_DateOfExit">
<input type="text" data-table="employment_history" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($employment_history_edit->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->DateOfExit->EditValue ?>"<?php echo $employment_history_edit->DateOfExit->editAttributes() ?>>
</span>
<?php echo $employment_history_edit->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_employment_history_SalaryScale" for="x_SalaryScale" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->SalaryScale->caption() ?><?php echo $employment_history_edit->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->SalaryScale->cellAttributes() ?>>
<span id="el_employment_history_SalaryScale">
<input type="text" data-table="employment_history" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_history_edit->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->SalaryScale->EditValue ?>"<?php echo $employment_history_edit->SalaryScale->editAttributes() ?>>
</span>
<?php echo $employment_history_edit->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->EmploymentType->Visible) { // EmploymentType ?>
	<div id="r_EmploymentType" class="form-group row">
		<label id="elh_employment_history_EmploymentType" for="x_EmploymentType" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->EmploymentType->caption() ?><?php echo $employment_history_edit->EmploymentType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->EmploymentType->cellAttributes() ?>>
<span id="el_employment_history_EmploymentType">
<input type="text" data-table="employment_history" data-field="x_EmploymentType" name="x_EmploymentType" id="x_EmploymentType" size="30" placeholder="<?php echo HtmlEncode($employment_history_edit->EmploymentType->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->EmploymentType->EditValue ?>"<?php echo $employment_history_edit->EmploymentType->editAttributes() ?>>
</span>
<?php echo $employment_history_edit->EmploymentType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<div id="r_EmploymentStatus" class="form-group row">
		<label id="elh_employment_history_EmploymentStatus" for="x_EmploymentStatus" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->EmploymentStatus->caption() ?><?php echo $employment_history_edit->EmploymentStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->EmploymentStatus->cellAttributes() ?>>
<span id="el_employment_history_EmploymentStatus">
<input type="text" data-table="employment_history" data-field="x_EmploymentStatus" name="x_EmploymentStatus" id="x_EmploymentStatus" size="30" placeholder="<?php echo HtmlEncode($employment_history_edit->EmploymentStatus->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->EmploymentStatus->EditValue ?>"<?php echo $employment_history_edit->EmploymentStatus->editAttributes() ?>>
</span>
<?php echo $employment_history_edit->EmploymentStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_employment_history_ExitReason" for="x_ExitReason" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->ExitReason->caption() ?><?php echo $employment_history_edit->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->ExitReason->cellAttributes() ?>>
<span id="el_employment_history_ExitReason">
<input type="text" data-table="employment_history" data-field="x_ExitReason" name="x_ExitReason" id="x_ExitReason" size="30" placeholder="<?php echo HtmlEncode($employment_history_edit->ExitReason->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->ExitReason->EditValue ?>"<?php echo $employment_history_edit->ExitReason->editAttributes() ?>>
</span>
<?php echo $employment_history_edit->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_edit->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_employment_history_RetirementType" for="x_RetirementType" class="<?php echo $employment_history_edit->LeftColumnClass ?>"><?php echo $employment_history_edit->RetirementType->caption() ?><?php echo $employment_history_edit->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_edit->RightColumnClass ?>"><div <?php echo $employment_history_edit->RetirementType->cellAttributes() ?>>
<span id="el_employment_history_RetirementType">
<input type="text" data-table="employment_history" data-field="x_RetirementType" name="x_RetirementType" id="x_RetirementType" size="30" placeholder="<?php echo HtmlEncode($employment_history_edit->RetirementType->getPlaceHolder()) ?>" value="<?php echo $employment_history_edit->RetirementType->EditValue ?>"<?php echo $employment_history_edit->RetirementType->editAttributes() ?>>
</span>
<?php echo $employment_history_edit->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_history_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_history_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_history_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$employment_history_edit->IsModal) { ?>
<?php echo $employment_history_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$employment_history_edit->showPageFooter();
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
$employment_history_edit->terminate();
?>