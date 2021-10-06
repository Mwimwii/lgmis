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
$salary_notch_add = new salary_notch_add();

// Run the page
$salary_notch_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsalary_notchadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsalary_notchadd = currentForm = new ew.Form("fsalary_notchadd", "add");

	// Validate form
	fsalary_notchadd.validate = function() {
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
			<?php if ($salary_notch_add->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_add->SalaryScale->caption(), $salary_notch_add->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($salary_notch_add->Notch->Required) { ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_add->Notch->caption(), $salary_notch_add->Notch->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_add->Notch->errorMessage()) ?>");
			<?php if ($salary_notch_add->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_add->BasicMonthlySalary->caption(), $salary_notch_add->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_add->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($salary_notch_add->AnnualSalary->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_add->AnnualSalary->caption(), $salary_notch_add->AnnualSalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_add->AnnualSalary->errorMessage()) ?>");

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
	fsalary_notchadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsalary_notchadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsalary_notchadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $salary_notch_add->showPageHeader(); ?>
<?php
$salary_notch_add->showMessage();
?>
<form name="fsalary_notchadd" id="fsalary_notchadd" class="<?php echo $salary_notch_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="salary_notch">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$salary_notch_add->IsModal ?>">
<?php if ($salary_notch->getCurrentMasterTable() == "salary_scale") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="salary_scale">
<input type="hidden" name="fk_SalaryScale" value="<?php echo HtmlEncode($salary_notch_add->SalaryScale->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($salary_notch_add->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_salary_notch_SalaryScale" for="x_SalaryScale" class="<?php echo $salary_notch_add->LeftColumnClass ?>"><?php echo $salary_notch_add->SalaryScale->caption() ?><?php echo $salary_notch_add->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_add->RightColumnClass ?>"><div <?php echo $salary_notch_add->SalaryScale->cellAttributes() ?>>
<?php if ($salary_notch_add->SalaryScale->getSessionValue() != "") { ?>
<span id="el_salary_notch_SalaryScale">
<span<?php echo $salary_notch_add->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_add->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_SalaryScale" name="x_SalaryScale" value="<?php echo HtmlEncode($salary_notch_add->SalaryScale->CurrentValue) ?>">
<?php } else { ?>
<span id="el_salary_notch_SalaryScale">
<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_add->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_add->SalaryScale->EditValue ?>"<?php echo $salary_notch_add->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $salary_notch_add->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_add->Notch->Visible) { // Notch ?>
	<div id="r_Notch" class="form-group row">
		<label id="elh_salary_notch_Notch" for="x_Notch" class="<?php echo $salary_notch_add->LeftColumnClass ?>"><?php echo $salary_notch_add->Notch->caption() ?><?php echo $salary_notch_add->Notch->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_add->RightColumnClass ?>"><div <?php echo $salary_notch_add->Notch->cellAttributes() ?>>
<span id="el_salary_notch_Notch">
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x_Notch" id="x_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_add->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_add->Notch->EditValue ?>"<?php echo $salary_notch_add->Notch->editAttributes() ?>>
</span>
<?php echo $salary_notch_add->Notch->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_add->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<div id="r_BasicMonthlySalary" class="form-group row">
		<label id="elh_salary_notch_BasicMonthlySalary" for="x_BasicMonthlySalary" class="<?php echo $salary_notch_add->LeftColumnClass ?>"><?php echo $salary_notch_add->BasicMonthlySalary->caption() ?><?php echo $salary_notch_add->BasicMonthlySalary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_add->RightColumnClass ?>"><div <?php echo $salary_notch_add->BasicMonthlySalary->cellAttributes() ?>>
<span id="el_salary_notch_BasicMonthlySalary">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x_BasicMonthlySalary" id="x_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_add->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_add->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_add->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php echo $salary_notch_add->BasicMonthlySalary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_add->AnnualSalary->Visible) { // AnnualSalary ?>
	<div id="r_AnnualSalary" class="form-group row">
		<label id="elh_salary_notch_AnnualSalary" for="x_AnnualSalary" class="<?php echo $salary_notch_add->LeftColumnClass ?>"><?php echo $salary_notch_add->AnnualSalary->caption() ?><?php echo $salary_notch_add->AnnualSalary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_add->RightColumnClass ?>"><div <?php echo $salary_notch_add->AnnualSalary->cellAttributes() ?>>
<span id="el_salary_notch_AnnualSalary">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x_AnnualSalary" id="x_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_add->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_add->AnnualSalary->EditValue ?>"<?php echo $salary_notch_add->AnnualSalary->editAttributes() ?>>
</span>
<?php echo $salary_notch_add->AnnualSalary->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$salary_notch_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $salary_notch_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $salary_notch_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$salary_notch_add->showPageFooter();
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
$salary_notch_add->terminate();
?>