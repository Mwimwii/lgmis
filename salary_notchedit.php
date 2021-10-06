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
$salary_notch_edit = new salary_notch_edit();

// Run the page
$salary_notch_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$salary_notch_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsalary_notchedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsalary_notchedit = currentForm = new ew.Form("fsalary_notchedit", "edit");

	// Validate form
	fsalary_notchedit.validate = function() {
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
			<?php if ($salary_notch_edit->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_edit->SalaryScale->caption(), $salary_notch_edit->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($salary_notch_edit->Notch->Required) { ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_edit->Notch->caption(), $salary_notch_edit->Notch->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Notch");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_edit->Notch->errorMessage()) ?>");
			<?php if ($salary_notch_edit->BasicMonthlySalary->Required) { ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_edit->BasicMonthlySalary->caption(), $salary_notch_edit->BasicMonthlySalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BasicMonthlySalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_edit->BasicMonthlySalary->errorMessage()) ?>");
			<?php if ($salary_notch_edit->AnnualSalary->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $salary_notch_edit->AnnualSalary->caption(), $salary_notch_edit->AnnualSalary->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualSalary");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($salary_notch_edit->AnnualSalary->errorMessage()) ?>");

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
	fsalary_notchedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsalary_notchedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsalary_notchedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $salary_notch_edit->showPageHeader(); ?>
<?php
$salary_notch_edit->showMessage();
?>
<?php if (!$salary_notch_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $salary_notch_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fsalary_notchedit" id="fsalary_notchedit" class="<?php echo $salary_notch_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="salary_notch">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$salary_notch_edit->IsModal ?>">
<?php if ($salary_notch->getCurrentMasterTable() == "salary_scale") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="salary_scale">
<input type="hidden" name="fk_SalaryScale" value="<?php echo HtmlEncode($salary_notch_edit->SalaryScale->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($salary_notch_edit->SalaryScale->Visible) { // SalaryScale ?>
	<div id="r_SalaryScale" class="form-group row">
		<label id="elh_salary_notch_SalaryScale" for="x_SalaryScale" class="<?php echo $salary_notch_edit->LeftColumnClass ?>"><?php echo $salary_notch_edit->SalaryScale->caption() ?><?php echo $salary_notch_edit->SalaryScale->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_edit->RightColumnClass ?>"><div <?php echo $salary_notch_edit->SalaryScale->cellAttributes() ?>>
<?php if ($salary_notch_edit->SalaryScale->getSessionValue() != "") { ?>

<span id="el_salary_notch_SalaryScale">
<span<?php echo $salary_notch_edit->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($salary_notch_edit->SalaryScale->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_SalaryScale" name="x_SalaryScale" value="<?php echo HtmlEncode($salary_notch_edit->SalaryScale->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="salary_notch" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($salary_notch_edit->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $salary_notch_edit->SalaryScale->EditValue ?>"<?php echo $salary_notch_edit->SalaryScale->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="salary_notch" data-field="x_SalaryScale" name="o_SalaryScale" id="o_SalaryScale" value="<?php echo HtmlEncode($salary_notch_edit->SalaryScale->OldValue != null ? $salary_notch_edit->SalaryScale->OldValue : $salary_notch_edit->SalaryScale->CurrentValue) ?>">
<?php echo $salary_notch_edit->SalaryScale->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_edit->Notch->Visible) { // Notch ?>
	<div id="r_Notch" class="form-group row">
		<label id="elh_salary_notch_Notch" for="x_Notch" class="<?php echo $salary_notch_edit->LeftColumnClass ?>"><?php echo $salary_notch_edit->Notch->caption() ?><?php echo $salary_notch_edit->Notch->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_edit->RightColumnClass ?>"><div <?php echo $salary_notch_edit->Notch->cellAttributes() ?>>
<input type="text" data-table="salary_notch" data-field="x_Notch" name="x_Notch" id="x_Notch" size="30" placeholder="<?php echo HtmlEncode($salary_notch_edit->Notch->getPlaceHolder()) ?>" value="<?php echo $salary_notch_edit->Notch->EditValue ?>"<?php echo $salary_notch_edit->Notch->editAttributes() ?>>
<input type="hidden" data-table="salary_notch" data-field="x_Notch" name="o_Notch" id="o_Notch" value="<?php echo HtmlEncode($salary_notch_edit->Notch->OldValue != null ? $salary_notch_edit->Notch->OldValue : $salary_notch_edit->Notch->CurrentValue) ?>">
<?php echo $salary_notch_edit->Notch->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_edit->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<div id="r_BasicMonthlySalary" class="form-group row">
		<label id="elh_salary_notch_BasicMonthlySalary" for="x_BasicMonthlySalary" class="<?php echo $salary_notch_edit->LeftColumnClass ?>"><?php echo $salary_notch_edit->BasicMonthlySalary->caption() ?><?php echo $salary_notch_edit->BasicMonthlySalary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_edit->RightColumnClass ?>"><div <?php echo $salary_notch_edit->BasicMonthlySalary->cellAttributes() ?>>
<span id="el_salary_notch_BasicMonthlySalary">
<input type="text" data-table="salary_notch" data-field="x_BasicMonthlySalary" name="x_BasicMonthlySalary" id="x_BasicMonthlySalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_edit->BasicMonthlySalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_edit->BasicMonthlySalary->EditValue ?>"<?php echo $salary_notch_edit->BasicMonthlySalary->editAttributes() ?>>
</span>
<?php echo $salary_notch_edit->BasicMonthlySalary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($salary_notch_edit->AnnualSalary->Visible) { // AnnualSalary ?>
	<div id="r_AnnualSalary" class="form-group row">
		<label id="elh_salary_notch_AnnualSalary" for="x_AnnualSalary" class="<?php echo $salary_notch_edit->LeftColumnClass ?>"><?php echo $salary_notch_edit->AnnualSalary->caption() ?><?php echo $salary_notch_edit->AnnualSalary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $salary_notch_edit->RightColumnClass ?>"><div <?php echo $salary_notch_edit->AnnualSalary->cellAttributes() ?>>
<span id="el_salary_notch_AnnualSalary">
<input type="text" data-table="salary_notch" data-field="x_AnnualSalary" name="x_AnnualSalary" id="x_AnnualSalary" size="30" placeholder="<?php echo HtmlEncode($salary_notch_edit->AnnualSalary->getPlaceHolder()) ?>" value="<?php echo $salary_notch_edit->AnnualSalary->EditValue ?>"<?php echo $salary_notch_edit->AnnualSalary->editAttributes() ?>>
</span>
<?php echo $salary_notch_edit->AnnualSalary->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$salary_notch_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $salary_notch_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $salary_notch_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$salary_notch_edit->IsModal) { ?>
<?php echo $salary_notch_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$salary_notch_edit->showPageFooter();
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
$salary_notch_edit->terminate();
?>