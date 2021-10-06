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
$employment_trans_add = new employment_trans_add();

// Run the page
$employment_trans_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_trans_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployment_transadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	femployment_transadd = currentForm = new ew.Form("femployment_transadd", "add");

	// Validate form
	femployment_transadd.validate = function() {
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
			<?php if ($employment_trans_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->EmployeeID->caption(), $employment_trans_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_trans_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->ProvinceCode->caption(), $employment_trans_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->ProvinceCode->errorMessage()) ?>");
			<?php if ($employment_trans_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->LACode->caption(), $employment_trans_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_trans_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->DepartmentCode->caption(), $employment_trans_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->DepartmentCode->errorMessage()) ?>");
			<?php if ($employment_trans_add->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->SectionCode->caption(), $employment_trans_add->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->SectionCode->errorMessage()) ?>");
			<?php if ($employment_trans_add->ToLACode->Required) { ?>
				elm = this.getElements("x" + infix + "_ToLACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->ToLACode->caption(), $employment_trans_add->ToLACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_trans_add->ToDept->Required) { ?>
				elm = this.getElements("x" + infix + "_ToDept");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->ToDept->caption(), $employment_trans_add->ToDept->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToDept");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->ToDept->errorMessage()) ?>");
			<?php if ($employment_trans_add->ToSection->Required) { ?>
				elm = this.getElements("x" + infix + "_ToSection");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->ToSection->caption(), $employment_trans_add->ToSection->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToSection");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->ToSection->errorMessage()) ?>");
			<?php if ($employment_trans_add->ActingPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->ActingPosition->caption(), $employment_trans_add->ActingPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActingPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->ActingPosition->errorMessage()) ?>");
			<?php if ($employment_trans_add->DateOfTransaction->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfTransaction");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->DateOfTransaction->caption(), $employment_trans_add->DateOfTransaction->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfTransaction");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->DateOfTransaction->errorMessage()) ?>");
			<?php if ($employment_trans_add->TransactionType->Required) { ?>
				elm = this.getElements("x" + infix + "_TransactionType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->TransactionType->caption(), $employment_trans_add->TransactionType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TransactionType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->TransactionType->errorMessage()) ?>");
			<?php if ($employment_trans_add->TransLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_TransLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->TransLetter->caption(), $employment_trans_add->TransLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_trans_add->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->SalaryScale->caption(), $employment_trans_add->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_trans_add->TransStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_TransStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->TransStatus->caption(), $employment_trans_add->TransStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TransStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_add->TransStatus->errorMessage()) ?>");
			<?php if ($employment_trans_add->TransReason->Required) { ?>
				elm = this.getElements("x" + infix + "_TransReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_add->TransReason->caption(), $employment_trans_add->TransReason->RequiredErrorMessage)) ?>");
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
	femployment_transadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_transadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_transadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employment_trans_add->showPageHeader(); ?>
<?php
$employment_trans_add->showMessage();
?>
<form name="femployment_transadd" id="femployment_transadd" class="<?php echo $employment_trans_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_trans">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$employment_trans_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($employment_trans_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_employment_trans_EmployeeID" for="x_EmployeeID" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->EmployeeID->caption() ?><?php echo $employment_trans_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->EmployeeID->cellAttributes() ?>>
<span id="el_employment_trans_EmployeeID">
<input type="text" data-table="employment_trans" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->EmployeeID->EditValue ?>"<?php echo $employment_trans_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_employment_trans_ProvinceCode" for="x_ProvinceCode" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->ProvinceCode->caption() ?><?php echo $employment_trans_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->ProvinceCode->cellAttributes() ?>>
<span id="el_employment_trans_ProvinceCode">
<input type="text" data-table="employment_trans" data-field="x_ProvinceCode" name="x_ProvinceCode" id="x_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->ProvinceCode->EditValue ?>"<?php echo $employment_trans_add->ProvinceCode->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_employment_trans_LACode" for="x_LACode" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->LACode->caption() ?><?php echo $employment_trans_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->LACode->cellAttributes() ?>>
<span id="el_employment_trans_LACode">
<input type="text" data-table="employment_trans" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_add->LACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->LACode->EditValue ?>"<?php echo $employment_trans_add->LACode->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_employment_trans_DepartmentCode" for="x_DepartmentCode" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->DepartmentCode->caption() ?><?php echo $employment_trans_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->DepartmentCode->cellAttributes() ?>>
<span id="el_employment_trans_DepartmentCode">
<input type="text" data-table="employment_trans" data-field="x_DepartmentCode" name="x_DepartmentCode" id="x_DepartmentCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->DepartmentCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->DepartmentCode->EditValue ?>"<?php echo $employment_trans_add->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_employment_trans_SectionCode" for="x_SectionCode" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->SectionCode->caption() ?><?php echo $employment_trans_add->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->SectionCode->cellAttributes() ?>>
<span id="el_employment_trans_SectionCode">
<input type="text" data-table="employment_trans" data-field="x_SectionCode" name="x_SectionCode" id="x_SectionCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->SectionCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->SectionCode->EditValue ?>"<?php echo $employment_trans_add->SectionCode->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->ToLACode->Visible) { // ToLACode ?>
	<div id="r_ToLACode" class="form-group row">
		<label id="elh_employment_trans_ToLACode" for="x_ToLACode" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->ToLACode->caption() ?><?php echo $employment_trans_add->ToLACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->ToLACode->cellAttributes() ?>>
<span id="el_employment_trans_ToLACode">
<input type="text" data-table="employment_trans" data-field="x_ToLACode" name="x_ToLACode" id="x_ToLACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_add->ToLACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->ToLACode->EditValue ?>"<?php echo $employment_trans_add->ToLACode->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->ToLACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->ToDept->Visible) { // ToDept ?>
	<div id="r_ToDept" class="form-group row">
		<label id="elh_employment_trans_ToDept" for="x_ToDept" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->ToDept->caption() ?><?php echo $employment_trans_add->ToDept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->ToDept->cellAttributes() ?>>
<span id="el_employment_trans_ToDept">
<input type="text" data-table="employment_trans" data-field="x_ToDept" name="x_ToDept" id="x_ToDept" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->ToDept->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->ToDept->EditValue ?>"<?php echo $employment_trans_add->ToDept->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->ToDept->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->ToSection->Visible) { // ToSection ?>
	<div id="r_ToSection" class="form-group row">
		<label id="elh_employment_trans_ToSection" for="x_ToSection" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->ToSection->caption() ?><?php echo $employment_trans_add->ToSection->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->ToSection->cellAttributes() ?>>
<span id="el_employment_trans_ToSection">
<input type="text" data-table="employment_trans" data-field="x_ToSection" name="x_ToSection" id="x_ToSection" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->ToSection->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->ToSection->EditValue ?>"<?php echo $employment_trans_add->ToSection->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->ToSection->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->ActingPosition->Visible) { // ActingPosition ?>
	<div id="r_ActingPosition" class="form-group row">
		<label id="elh_employment_trans_ActingPosition" for="x_ActingPosition" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->ActingPosition->caption() ?><?php echo $employment_trans_add->ActingPosition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->ActingPosition->cellAttributes() ?>>
<span id="el_employment_trans_ActingPosition">
<input type="text" data-table="employment_trans" data-field="x_ActingPosition" name="x_ActingPosition" id="x_ActingPosition" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->ActingPosition->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->ActingPosition->EditValue ?>"<?php echo $employment_trans_add->ActingPosition->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->ActingPosition->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->DateOfTransaction->Visible) { // DateOfTransaction ?>
	<div id="r_DateOfTransaction" class="form-group row">
		<label id="elh_employment_trans_DateOfTransaction" for="x_DateOfTransaction" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->DateOfTransaction->caption() ?><?php echo $employment_trans_add->DateOfTransaction->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->DateOfTransaction->cellAttributes() ?>>
<span id="el_employment_trans_DateOfTransaction">
<input type="text" data-table="employment_trans" data-field="x_DateOfTransaction" name="x_DateOfTransaction" id="x_DateOfTransaction" placeholder="<?php echo HtmlEncode($employment_trans_add->DateOfTransaction->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->DateOfTransaction->EditValue ?>"<?php echo $employment_trans_add->DateOfTransaction->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->DateOfTransaction->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->TransactionType->Visible) { // TransactionType ?>
	<div id="r_TransactionType" class="form-group row">
		<label id="elh_employment_trans_TransactionType" for="x_TransactionType" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->TransactionType->caption() ?><?php echo $employment_trans_add->TransactionType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->TransactionType->cellAttributes() ?>>
<span id="el_employment_trans_TransactionType">
<input type="text" data-table="employment_trans" data-field="x_TransactionType" name="x_TransactionType" id="x_TransactionType" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->TransactionType->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->TransactionType->EditValue ?>"<?php echo $employment_trans_add->TransactionType->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->TransactionType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->TransLetter->Visible) { // TransLetter ?>
	<div id="r_TransLetter" class="form-group row">
		<label id="elh_employment_trans_TransLetter" for="x_TransLetter" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->TransLetter->caption() ?><?php echo $employment_trans_add->TransLetter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->TransLetter->cellAttributes() ?>>
<span id="el_employment_trans_TransLetter">
<textarea data-table="employment_trans" data-field="x_TransLetter" name="x_TransLetter" id="x_TransLetter" cols="35" rows="4" placeholder="<?php echo HtmlEncode($employment_trans_add->TransLetter->getPlaceHolder()) ?>"<?php echo $employment_trans_add->TransLetter->editAttributes() ?>><?php echo $employment_trans_add->TransLetter->EditValue ?></textarea>
</span>
<?php echo $employment_trans_add->TransLetter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_employment_trans_SalaryScale" for="x_SalaryScale" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->SalaryScale->caption() ?><?php echo $employment_trans_add->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->SalaryScale->cellAttributes() ?>>
<span id="el_employment_trans_SalaryScale">
<input type="text" data-table="employment_trans" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_add->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->SalaryScale->EditValue ?>"<?php echo $employment_trans_add->SalaryScale->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->TransStatus->Visible) { // TransStatus ?>
	<div id="r_TransStatus" class="form-group row">
		<label id="elh_employment_trans_TransStatus" for="x_TransStatus" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->TransStatus->caption() ?><?php echo $employment_trans_add->TransStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->TransStatus->cellAttributes() ?>>
<span id="el_employment_trans_TransStatus">
<input type="text" data-table="employment_trans" data-field="x_TransStatus" name="x_TransStatus" id="x_TransStatus" size="30" placeholder="<?php echo HtmlEncode($employment_trans_add->TransStatus->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->TransStatus->EditValue ?>"<?php echo $employment_trans_add->TransStatus->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->TransStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employment_trans_add->TransReason->Visible) { // TransReason ?>
	<div id="r_TransReason" class="form-group row">
		<label id="elh_employment_trans_TransReason" for="x_TransReason" class="<?php echo $employment_trans_add->LeftColumnClass ?>"><?php echo $employment_trans_add->TransReason->caption() ?><?php echo $employment_trans_add->TransReason->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employment_trans_add->RightColumnClass ?>"><div <?php echo $employment_trans_add->TransReason->cellAttributes() ?>>
<span id="el_employment_trans_TransReason">
<input type="text" data-table="employment_trans" data-field="x_TransReason" name="x_TransReason" id="x_TransReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_trans_add->TransReason->getPlaceHolder()) ?>" value="<?php echo $employment_trans_add->TransReason->EditValue ?>"<?php echo $employment_trans_add->TransReason->editAttributes() ?>>
</span>
<?php echo $employment_trans_add->TransReason->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employment_trans_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employment_trans_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employment_trans_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employment_trans_add->showPageFooter();
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
$employment_trans_add->terminate();
?>