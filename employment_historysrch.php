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
$employment_history_search = new employment_history_search();

// Run the page
$employment_history_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_history_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_historysearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($employment_history_search->IsModal) { ?>
	femployment_historysearch = currentAdvancedSearchForm = new ew.Form("femployment_historysearch", "search");
	<?php } else { ?>
	femployment_historysearch = currentForm = new ew.Form("femployment_historysearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	femployment_historysearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Position");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->Position->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfAppointment");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->DateOfAppointment->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfExit");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->DateOfExit->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmploymentType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->EmploymentType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmploymentStatus");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->EmploymentStatus->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ExitReason");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->ExitReason->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_RetirementType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_history_search->RetirementType->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployment_historysearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_historysearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_historysearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_history_search->showPageHeader(); ?>
<?php
$employment_history_search->showMessage();
?>
<form name="femployment_historysearch" id="femployment_historysearch" class="<?php echo $employment_history_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_history">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$employment_history_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($employment_history_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_EmployeeID"><?php echo $employment_history_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->EmployeeID->cellAttributes() ?>>
			<span id="el_employment_history_EmployeeID" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_history_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->EmployeeID->EditValue ?>"<?php echo $employment_history_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->Position->Visible) { // Position ?>
	<div id="r_Position" class="form-group row">
		<label for="x_Position" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_Position"><?php echo $employment_history_search->Position->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Position" id="z_Position" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->Position->cellAttributes() ?>>
			<span id="el_employment_history_Position" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_Position" name="x_Position" id="x_Position" size="30" placeholder="<?php echo HtmlEncode($employment_history_search->Position->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->Position->EditValue ?>"<?php echo $employment_history_search->Position->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->DateOfAppointment->Visible) { // DateOfAppointment ?>
	<div id="r_DateOfAppointment" class="form-group row">
		<label for="x_DateOfAppointment" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_DateOfAppointment"><?php echo $employment_history_search->DateOfAppointment->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfAppointment" id="z_DateOfAppointment" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->DateOfAppointment->cellAttributes() ?>>
			<span id="el_employment_history_DateOfAppointment" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_DateOfAppointment" name="x_DateOfAppointment" id="x_DateOfAppointment" placeholder="<?php echo HtmlEncode($employment_history_search->DateOfAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->DateOfAppointment->EditValue ?>"<?php echo $employment_history_search->DateOfAppointment->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->DateOfExit->Visible) { // DateOfExit ?>
	<div id="r_DateOfExit" class="form-group row">
		<label for="x_DateOfExit" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_DateOfExit"><?php echo $employment_history_search->DateOfExit->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfExit" id="z_DateOfExit" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->DateOfExit->cellAttributes() ?>>
			<span id="el_employment_history_DateOfExit" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_DateOfExit" name="x_DateOfExit" id="x_DateOfExit" placeholder="<?php echo HtmlEncode($employment_history_search->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->DateOfExit->EditValue ?>"<?php echo $employment_history_search->DateOfExit->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label for="x_SalaryScale" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_SalaryScale"><?php echo $employment_history_search->SalaryScale->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->SalaryScale->cellAttributes() ?>>
			<span id="el_employment_history_SalaryScale" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_history_search->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->SalaryScale->EditValue ?>"<?php echo $employment_history_search->SalaryScale->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->EmploymentType->Visible) { // EmploymentType ?>
	<div id="r_EmploymentType" class="form-group row">
		<label for="x_EmploymentType" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_EmploymentType"><?php echo $employment_history_search->EmploymentType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmploymentType" id="z_EmploymentType" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->EmploymentType->cellAttributes() ?>>
			<span id="el_employment_history_EmploymentType" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_EmploymentType" name="x_EmploymentType" id="x_EmploymentType" size="30" placeholder="<?php echo HtmlEncode($employment_history_search->EmploymentType->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->EmploymentType->EditValue ?>"<?php echo $employment_history_search->EmploymentType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<div id="r_EmploymentStatus" class="form-group row">
		<label for="x_EmploymentStatus" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_EmploymentStatus"><?php echo $employment_history_search->EmploymentStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmploymentStatus" id="z_EmploymentStatus" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->EmploymentStatus->cellAttributes() ?>>
			<span id="el_employment_history_EmploymentStatus" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_EmploymentStatus" name="x_EmploymentStatus" id="x_EmploymentStatus" size="30" placeholder="<?php echo HtmlEncode($employment_history_search->EmploymentStatus->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->EmploymentStatus->EditValue ?>"<?php echo $employment_history_search->EmploymentStatus->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->ExitReason->Visible) { // ExitReason ?>
	<div id="r_ExitReason" class="form-group row">
		<label for="x_ExitReason" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_ExitReason"><?php echo $employment_history_search->ExitReason->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ExitReason" id="z_ExitReason" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->ExitReason->cellAttributes() ?>>
			<span id="el_employment_history_ExitReason" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_ExitReason" name="x_ExitReason" id="x_ExitReason" size="30" placeholder="<?php echo HtmlEncode($employment_history_search->ExitReason->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->ExitReason->EditValue ?>"<?php echo $employment_history_search->ExitReason->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_history_search->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label for="x_RetirementType" class="<?php echo $employment_history_search->LeftColumnClass ?>"><span id="elh_employment_history_RetirementType"><?php echo $employment_history_search->RetirementType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RetirementType" id="z_RetirementType" value="=">
</span>
		</label>
		<div class="<?php echo $employment_history_search->RightColumnClass ?>"><div <?php echo $employment_history_search->RetirementType->cellAttributes() ?>>
			<span id="el_employment_history_RetirementType" class="ew-search-field">
<input type="text" data-table="employment_history" data-field="x_RetirementType" name="x_RetirementType" id="x_RetirementType" size="30" placeholder="<?php echo HtmlEncode($employment_history_search->RetirementType->getPlaceHolder()) ?>" value="<?php echo $employment_history_search->RetirementType->EditValue ?>"<?php echo $employment_history_search->RetirementType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_history_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_history_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_history_search->showPageFooter();
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
$employment_history_search->terminate();
?>