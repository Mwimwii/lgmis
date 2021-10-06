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
$employment_trans_search = new employment_trans_search();

// Run the page
$employment_trans_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_trans_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_transsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($employment_trans_search->IsModal) { ?>
	femployment_transsearch = currentAdvancedSearchForm = new ew.Form("femployment_transsearch", "search");
	<?php } else { ?>
	femployment_transsearch = currentForm = new ew.Form("femployment_transsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	femployment_transsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ProvinceCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->ProvinceCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DepartmentCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->DepartmentCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SectionCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->SectionCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ToDept");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->ToDept->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ToSection");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->ToSection->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ActingPosition");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->ActingPosition->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfTransaction");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->DateOfTransaction->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TransactionType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->TransactionType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_TransStatus");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($employment_trans_search->TransStatus->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	femployment_transsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_transsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_transsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_trans_search->showPageHeader(); ?>
<?php
$employment_trans_search->showMessage();
?>
<form name="femployment_transsearch" id="femployment_transsearch" class="<?php echo $employment_trans_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_trans">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$employment_trans_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($employment_trans_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_EmployeeID"><?php echo $employment_trans_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->EmployeeID->cellAttributes() ?>>
			<span id="el_employment_trans_EmployeeID" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->EmployeeID->EditValue ?>"<?php echo $employment_trans_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label for="x_ProvinceCode" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_ProvinceCode"><?php echo $employment_trans_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_employment_trans_ProvinceCode" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_ProvinceCode" name="x_ProvinceCode" id="x_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->ProvinceCode->EditValue ?>"<?php echo $employment_trans_search->ProvinceCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_LACode"><?php echo $employment_trans_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->LACode->cellAttributes() ?>>
			<span id="el_employment_trans_LACode" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_search->LACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->LACode->EditValue ?>"<?php echo $employment_trans_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label for="x_DepartmentCode" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_DepartmentCode"><?php echo $employment_trans_search->DepartmentCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->DepartmentCode->cellAttributes() ?>>
			<span id="el_employment_trans_DepartmentCode" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_DepartmentCode" name="x_DepartmentCode" id="x_DepartmentCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->DepartmentCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->DepartmentCode->EditValue ?>"<?php echo $employment_trans_search->DepartmentCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label for="x_SectionCode" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_SectionCode"><?php echo $employment_trans_search->SectionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->SectionCode->cellAttributes() ?>>
			<span id="el_employment_trans_SectionCode" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_SectionCode" name="x_SectionCode" id="x_SectionCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->SectionCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->SectionCode->EditValue ?>"<?php echo $employment_trans_search->SectionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->ToLACode->Visible) { // ToLACode ?>
	<div id="r_ToLACode" class="form-group row">
		<label for="x_ToLACode" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_ToLACode"><?php echo $employment_trans_search->ToLACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ToLACode" id="z_ToLACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->ToLACode->cellAttributes() ?>>
			<span id="el_employment_trans_ToLACode" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_ToLACode" name="x_ToLACode" id="x_ToLACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_search->ToLACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->ToLACode->EditValue ?>"<?php echo $employment_trans_search->ToLACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->ToDept->Visible) { // ToDept ?>
	<div id="r_ToDept" class="form-group row">
		<label for="x_ToDept" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_ToDept"><?php echo $employment_trans_search->ToDept->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ToDept" id="z_ToDept" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->ToDept->cellAttributes() ?>>
			<span id="el_employment_trans_ToDept" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_ToDept" name="x_ToDept" id="x_ToDept" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->ToDept->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->ToDept->EditValue ?>"<?php echo $employment_trans_search->ToDept->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->ToSection->Visible) { // ToSection ?>
	<div id="r_ToSection" class="form-group row">
		<label for="x_ToSection" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_ToSection"><?php echo $employment_trans_search->ToSection->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ToSection" id="z_ToSection" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->ToSection->cellAttributes() ?>>
			<span id="el_employment_trans_ToSection" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_ToSection" name="x_ToSection" id="x_ToSection" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->ToSection->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->ToSection->EditValue ?>"<?php echo $employment_trans_search->ToSection->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->ActingPosition->Visible) { // ActingPosition ?>
	<div id="r_ActingPosition" class="form-group row">
		<label for="x_ActingPosition" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_ActingPosition"><?php echo $employment_trans_search->ActingPosition->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ActingPosition" id="z_ActingPosition" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->ActingPosition->cellAttributes() ?>>
			<span id="el_employment_trans_ActingPosition" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_ActingPosition" name="x_ActingPosition" id="x_ActingPosition" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->ActingPosition->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->ActingPosition->EditValue ?>"<?php echo $employment_trans_search->ActingPosition->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->DateOfTransaction->Visible) { // DateOfTransaction ?>
	<div id="r_DateOfTransaction" class="form-group row">
		<label for="x_DateOfTransaction" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_DateOfTransaction"><?php echo $employment_trans_search->DateOfTransaction->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfTransaction" id="z_DateOfTransaction" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->DateOfTransaction->cellAttributes() ?>>
			<span id="el_employment_trans_DateOfTransaction" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_DateOfTransaction" name="x_DateOfTransaction" id="x_DateOfTransaction" placeholder="<?php echo HtmlEncode($employment_trans_search->DateOfTransaction->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->DateOfTransaction->EditValue ?>"<?php echo $employment_trans_search->DateOfTransaction->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->TransactionType->Visible) { // TransactionType ?>
	<div id="r_TransactionType" class="form-group row">
		<label for="x_TransactionType" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_TransactionType"><?php echo $employment_trans_search->TransactionType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TransactionType" id="z_TransactionType" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->TransactionType->cellAttributes() ?>>
			<span id="el_employment_trans_TransactionType" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_TransactionType" name="x_TransactionType" id="x_TransactionType" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->TransactionType->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->TransactionType->EditValue ?>"<?php echo $employment_trans_search->TransactionType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->TransLetter->Visible) { // TransLetter ?>
	<div id="r_TransLetter" class="form-group row">
		<label for="x_TransLetter" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_TransLetter"><?php echo $employment_trans_search->TransLetter->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TransLetter" id="z_TransLetter" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->TransLetter->cellAttributes() ?>>
			<span id="el_employment_trans_TransLetter" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_TransLetter" name="x_TransLetter" id="x_TransLetter" size="35" placeholder="<?php echo HtmlEncode($employment_trans_search->TransLetter->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->TransLetter->EditValue ?>"<?php echo $employment_trans_search->TransLetter->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label for="x_SalaryScale" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_SalaryScale"><?php echo $employment_trans_search->SalaryScale->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->SalaryScale->cellAttributes() ?>>
			<span id="el_employment_trans_SalaryScale" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_search->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->SalaryScale->EditValue ?>"<?php echo $employment_trans_search->SalaryScale->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->TransStatus->Visible) { // TransStatus ?>
	<div id="r_TransStatus" class="form-group row">
		<label for="x_TransStatus" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_TransStatus"><?php echo $employment_trans_search->TransStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TransStatus" id="z_TransStatus" value="=">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->TransStatus->cellAttributes() ?>>
			<span id="el_employment_trans_TransStatus" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_TransStatus" name="x_TransStatus" id="x_TransStatus" size="30" placeholder="<?php echo HtmlEncode($employment_trans_search->TransStatus->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->TransStatus->EditValue ?>"<?php echo $employment_trans_search->TransStatus->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_search->TransReason->Visible) { // TransReason ?>
	<div id="r_TransReason" class="form-group row">
		<label for="x_TransReason" class="<?php echo $employment_trans_search->LeftColumnClass ?>"><span id="elh_employment_trans_TransReason"><?php echo $employment_trans_search->TransReason->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TransReason" id="z_TransReason" value="LIKE">
</span>
		</label>
		<div class="<?php echo $employment_trans_search->RightColumnClass ?>"><div <?php echo $employment_trans_search->TransReason->cellAttributes() ?>>
			<span id="el_employment_trans_TransReason" class="ew-search-field">
<input type="text" data-table="employment_trans" data-field="x_TransReason" name="x_TransReason" id="x_TransReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_trans_search->TransReason->getPlaceHolder()) ?>" value="<?php echo $employment_trans_search->TransReason->EditValue ?>"<?php echo $employment_trans_search->TransReason->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_trans_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_trans_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_trans_search->showPageFooter();
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
$employment_trans_search->terminate();
?>