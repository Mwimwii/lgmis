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
$employment_history_add = new employment_history_add();

// Run the page
$employment_history_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_history_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_historyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femployment_historyadd = currentForm = new ew.Form("femployment_historyadd", "add");

	// Validate form
	femployment_historyadd.validate = function() {
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
			<?php if ($employment_history_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->EmployeeID->caption(), $employment_history_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_history_add->Position->Required) { ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->Position->caption(), $employment_history_add->Position->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->Position->errorMessage()) ?>");
			<?php if ($employment_history_add->DateOfAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->DateOfAppointment->caption(), $employment_history_add->DateOfAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->DateOfAppointment->errorMessage()) ?>");
			<?php if ($employment_history_add->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->DateOfExit->caption(), $employment_history_add->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->DateOfExit->errorMessage()) ?>");
			<?php if ($employment_history_add->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->SalaryScale->caption(), $employment_history_add->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_history_add->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->EmploymentType->caption(), $employment_history_add->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->EmploymentType->errorMessage()) ?>");
			<?php if ($employment_history_add->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->EmploymentStatus->caption(), $employment_history_add->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->EmploymentStatus->errorMessage()) ?>");
			<?php if ($employment_history_add->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->ExitReason->caption(), $employment_history_add->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->ExitReason->errorMessage()) ?>");
			<?php if ($employment_history_add->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_add->RetirementType->caption(), $employment_history_add->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_add->RetirementType->errorMessage()) ?>");

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
	femployment_historyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_historyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_historyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_history_add->showPageHeader(); ?>
<?php
$employment_history_add->showMessage();
?>
<form name="femployment_historyadd" id="femployment_historyadd" class="<?php echo $employment_history_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_history">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employment_history_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($employment_history_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employment_history_EmployeeID" for="x_EmployeeID" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->EmployeeID->caption() ?><?php echo $employment_history_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->EmployeeID->cellAttributes() ?>>
<span id="el_employment_history_EmployeeID">
<input type="text" data-table="employment_history" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_history_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->EmployeeID->EditValue ?>"<?php echo $employment_history_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $employment_history_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->Position->Visible) { // Position ?>
	<div id="r_Position" class="form-group row">
		<label id="elh_employment_history_Position" for="x_Position" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->Position->caption() ?><?php echo $employment_history_add->Position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->Position->cellAttributes() ?>>
<span id="el_employment_history_Position">
<input type="text" data-table="employment_history" data-field="x_Position" name="x_Position" id="x_Position" size="30" placeholder="<?php echo HtmlEncode($employment_history_add->Position->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->Position->EditValue ?>"<?php echo $employment_history_add->Position->editAttributes() ?>>
</span>
<?php echo $employment_history_add->Position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->DateOfAppointment->Visible) { // DateOfAppointment ?>
	<div id="r_DateOfAppointment" class="form-group row">
		<label id="elh_employment_history_DateOfAppointment" for="x_DateOfAppointment" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->DateOfAppointment->caption() ?><?php echo $employment_history_add->DateOfAppointment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->DateOfAppointment->cellAttributes() ?>>
<span id="el_employment_history_DateOfAppointment">
<input type="text" data-table="employment_history" data-field="x_DateOfAppointment" name="x_DateOfAppointment" id="x_DateOfAppointment" placeholder="<?php echo HtmlEncode($employment_history_add->DateOfAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->DateOfAppointment->EditValue ?>"<?php echo $employment_history_add->DateOfAppointment->editAttributes() ?>>
</span>
<?php echo $employment_history_add->DateOfAppointment->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label id="elh_employment_history_DateOfExit" for="x_DateOfExit" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->DateOfExit->caption() ?><?php echo $employment_history_add->DateOfExit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->DateOfExit->cellAttributes() ?>>
<span id="el_employment_history_DateOfExit">
<input type="text" data-table="employment_history" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($employment_history_add->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->DateOfExit->EditValue ?>"<?php echo $employment_history_add->DateOfExit->editAttributes() ?>>
</span>
<?php echo $employment_history_add->DateOfExit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_employment_history_SalaryScale" for="x_SalaryScale" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->SalaryScale->caption() ?><?php echo $employment_history_add->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->SalaryScale->cellAttributes() ?>>
<span id="el_employment_history_SalaryScale">
<input type="text" data-table="employment_history" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_history_add->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->SalaryScale->EditValue ?>"<?php echo $employment_history_add->SalaryScale->editAttributes() ?>>
</span>
<?php echo $employment_history_add->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->EmploymentType->Visible) { // EmploymentType ?>
	<div id="r_EmploymentType" class="form-group row">
		<label id="elh_employment_history_EmploymentType" for="x_EmploymentType" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->EmploymentType->caption() ?><?php echo $employment_history_add->EmploymentType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->EmploymentType->cellAttributes() ?>>
<span id="el_employment_history_EmploymentType">
<input type="text" data-table="employment_history" data-field="x_EmploymentType" name="x_EmploymentType" id="x_EmploymentType" size="30" placeholder="<?php echo HtmlEncode($employment_history_add->EmploymentType->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->EmploymentType->EditValue ?>"<?php echo $employment_history_add->EmploymentType->editAttributes() ?>>
</span>
<?php echo $employment_history_add->EmploymentType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<div id="r_EmploymentStatus" class="form-group row">
		<label id="elh_employment_history_EmploymentStatus" for="x_EmploymentStatus" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->EmploymentStatus->caption() ?><?php echo $employment_history_add->EmploymentStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->EmploymentStatus->cellAttributes() ?>>
<span id="el_employment_history_EmploymentStatus">
<input type="text" data-table="employment_history" data-field="x_EmploymentStatus" name="x_EmploymentStatus" id="x_EmploymentStatus" size="30" placeholder="<?php echo HtmlEncode($employment_history_add->EmploymentStatus->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->EmploymentStatus->EditValue ?>"<?php echo $employment_history_add->EmploymentStatus->editAttributes() ?>>
</span>
<?php echo $employment_history_add->EmploymentStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label id="elh_employment_history_ExitReason" for="x_ExitReason" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->ExitReason->caption() ?><?php echo $employment_history_add->ExitReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->ExitReason->cellAttributes() ?>>
<span id="el_employment_history_ExitReason">
<input type="text" data-table="employment_history" data-field="x_ExitReason" name="x_ExitReason" id="x_ExitReason" size="30" placeholder="<?php echo HtmlEncode($employment_history_add->ExitReason->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->ExitReason->EditValue ?>"<?php echo $employment_history_add->ExitReason->editAttributes() ?>>
</span>
<?php echo $employment_history_add->ExitReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_history_add->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_employment_history_RetirementType" for="x_RetirementType" class="<?php echo $employment_history_add->LeftColumnClass ?>"><?php echo $employment_history_add->RetirementType->caption() ?><?php echo $employment_history_add->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_history_add->RightColumnClass ?>"><div <?php echo $employment_history_add->RetirementType->cellAttributes() ?>>
<span id="el_employment_history_RetirementType">
<input type="text" data-table="employment_history" data-field="x_RetirementType" name="x_RetirementType" id="x_RetirementType" size="30" placeholder="<?php echo HtmlEncode($employment_history_add->RetirementType->getPlaceHolder()) ?>" value="<?php echo $employment_history_add->RetirementType->EditValue ?>"<?php echo $employment_history_add->RetirementType->editAttributes() ?>>
</span>
<?php echo $employment_history_add->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_history_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_history_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_history_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_history_add->showPageFooter();
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
$employment_history_add->terminate();
?>