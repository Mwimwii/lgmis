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
$payroll_add = new payroll_add();

// Run the page
$payroll_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayrolladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpayrolladd = currentForm = new ew.Form("fpayrolladd", "add");

	// Validate form
	fpayrolladd.validate = function() {
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
			<?php if ($payroll_add->PayrollName->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_add->PayrollName->caption(), $payroll_add->PayrollName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_add->PayrollDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_add->PayrollDescription->caption(), $payroll_add->PayrollDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_add->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_add->Division->caption(), $payroll_add->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_add->Division->errorMessage()) ?>");
			<?php if ($payroll_add->LAcode->Required) { ?>
				elm = this.getElements("x" + infix + "_LAcode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_add->LAcode->caption(), $payroll_add->LAcode->RequiredErrorMessage)) ?>");
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
	fpayrolladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayrolladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpayrolladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_add->showPageHeader(); ?>
<?php
$payroll_add->showMessage();
?>
<form name="fpayrolladd" id="fpayrolladd" class="<?php echo $payroll_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($payroll_add->PayrollName->Visible) { // PayrollName ?>
	<div id="r_PayrollName" class="form-group row">
		<label id="elh_payroll_PayrollName" for="x_PayrollName" class="<?php echo $payroll_add->LeftColumnClass ?>"><?php echo $payroll_add->PayrollName->caption() ?><?php echo $payroll_add->PayrollName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_add->RightColumnClass ?>"><div <?php echo $payroll_add->PayrollName->cellAttributes() ?>>
<span id="el_payroll_PayrollName">
<input type="text" data-table="payroll" data-field="x_PayrollName" name="x_PayrollName" id="x_PayrollName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_add->PayrollName->getPlaceHolder()) ?>" value="<?php echo $payroll_add->PayrollName->EditValue ?>"<?php echo $payroll_add->PayrollName->editAttributes() ?>>
</span>
<?php echo $payroll_add->PayrollName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_add->PayrollDescription->Visible) { // PayrollDescription ?>
	<div id="r_PayrollDescription" class="form-group row">
		<label id="elh_payroll_PayrollDescription" for="x_PayrollDescription" class="<?php echo $payroll_add->LeftColumnClass ?>"><?php echo $payroll_add->PayrollDescription->caption() ?><?php echo $payroll_add->PayrollDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_add->RightColumnClass ?>"><div <?php echo $payroll_add->PayrollDescription->cellAttributes() ?>>
<span id="el_payroll_PayrollDescription">
<input type="text" data-table="payroll" data-field="x_PayrollDescription" name="x_PayrollDescription" id="x_PayrollDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_add->PayrollDescription->getPlaceHolder()) ?>" value="<?php echo $payroll_add->PayrollDescription->EditValue ?>"<?php echo $payroll_add->PayrollDescription->editAttributes() ?>>
</span>
<?php echo $payroll_add->PayrollDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_add->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_payroll_Division" for="x_Division" class="<?php echo $payroll_add->LeftColumnClass ?>"><?php echo $payroll_add->Division->caption() ?><?php echo $payroll_add->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_add->RightColumnClass ?>"><div <?php echo $payroll_add->Division->cellAttributes() ?>>
<span id="el_payroll_Division">
<input type="text" data-table="payroll" data-field="x_Division" name="x_Division" id="x_Division" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($payroll_add->Division->getPlaceHolder()) ?>" value="<?php echo $payroll_add->Division->EditValue ?>"<?php echo $payroll_add->Division->editAttributes() ?>>
</span>
<?php echo $payroll_add->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_add->LAcode->Visible) { // LAcode ?>
	<div id="r_LAcode" class="form-group row">
		<label id="elh_payroll_LAcode" for="x_LAcode" class="<?php echo $payroll_add->LeftColumnClass ?>"><?php echo $payroll_add->LAcode->caption() ?><?php echo $payroll_add->LAcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_add->RightColumnClass ?>"><div <?php echo $payroll_add->LAcode->cellAttributes() ?>>
<span id="el_payroll_LAcode">
<input type="text" data-table="payroll" data-field="x_LAcode" name="x_LAcode" id="x_LAcode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_add->LAcode->getPlaceHolder()) ?>" value="<?php echo $payroll_add->LAcode->EditValue ?>"<?php echo $payroll_add->LAcode->editAttributes() ?>>
</span>
<?php echo $payroll_add->LAcode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payroll_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payroll_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payroll_add->showPageFooter();
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
$payroll_add->terminate();
?>