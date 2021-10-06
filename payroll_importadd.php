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
$payroll_import_add = new payroll_import_add();

// Run the page
$payroll_import_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_import_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_importadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpayroll_importadd = currentForm = new ew.Form("fpayroll_importadd", "add");

	// Validate form
	fpayroll_importadd.validate = function() {
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
			<?php if ($payroll_import_add->FileNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_FileNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->FileNumber->caption(), $payroll_import_add->FileNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_import_add->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->Surname->caption(), $payroll_import_add->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_import_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->FirstName->caption(), $payroll_import_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_import_add->DOB->Required) { ?>
				elm = this.getElements("x" + infix + "_DOB");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->DOB->caption(), $payroll_import_add->DOB->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_import_add->DateEmployed->Required) { ?>
				elm = this.getElements("x" + infix + "_DateEmployed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->DateEmployed->caption(), $payroll_import_add->DateEmployed->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_import_add->nrc->Required) { ?>
				elm = this.getElements("x" + infix + "_nrc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->nrc->caption(), $payroll_import_add->nrc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_import_add->napsa->Required) { ?>
				elm = this.getElements("x" + infix + "_napsa");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->napsa->caption(), $payroll_import_add->napsa->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_import_add->LeaveDays->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->LeaveDays->caption(), $payroll_import_add->LeaveDays->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_import_add->LeaveDays->errorMessage()) ?>");
			<?php if ($payroll_import_add->sex->Required) { ?>
				elm = this.getElements("x" + infix + "_sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_import_add->sex->caption(), $payroll_import_add->sex->RequiredErrorMessage)) ?>");
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
	fpayroll_importadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_importadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpayroll_importadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_import_add->showPageHeader(); ?>
<?php
$payroll_import_add->showMessage();
?>
<form name="fpayroll_importadd" id="fpayroll_importadd" class="<?php echo $payroll_import_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_import">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_import_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($payroll_import_add->FileNumber->Visible) { // FileNumber ?>
	<div id="r_FileNumber" class="form-group row">
		<label id="elh_payroll_import_FileNumber" for="x_FileNumber" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->FileNumber->caption() ?><?php echo $payroll_import_add->FileNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->FileNumber->cellAttributes() ?>>
<span id="el_payroll_import_FileNumber">
<input type="text" data-table="payroll_import" data-field="x_FileNumber" name="x_FileNumber" id="x_FileNumber" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($payroll_import_add->FileNumber->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->FileNumber->EditValue ?>"<?php echo $payroll_import_add->FileNumber->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->FileNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_payroll_import_Surname" for="x_Surname" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->Surname->caption() ?><?php echo $payroll_import_add->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->Surname->cellAttributes() ?>>
<span id="el_payroll_import_Surname">
<input type="text" data-table="payroll_import" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payroll_import_add->Surname->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->Surname->EditValue ?>"<?php echo $payroll_import_add->Surname->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_payroll_import_FirstName" for="x_FirstName" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->FirstName->caption() ?><?php echo $payroll_import_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->FirstName->cellAttributes() ?>>
<span id="el_payroll_import_FirstName">
<input type="text" data-table="payroll_import" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payroll_import_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->FirstName->EditValue ?>"<?php echo $payroll_import_add->FirstName->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->DOB->Visible) { // DOB ?>
	<div id="r_DOB" class="form-group row">
		<label id="elh_payroll_import_DOB" for="x_DOB" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->DOB->caption() ?><?php echo $payroll_import_add->DOB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->DOB->cellAttributes() ?>>
<span id="el_payroll_import_DOB">
<input type="text" data-table="payroll_import" data-field="x_DOB" name="x_DOB" id="x_DOB" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payroll_import_add->DOB->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->DOB->EditValue ?>"<?php echo $payroll_import_add->DOB->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->DOB->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->DateEmployed->Visible) { // DateEmployed ?>
	<div id="r_DateEmployed" class="form-group row">
		<label id="elh_payroll_import_DateEmployed" for="x_DateEmployed" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->DateEmployed->caption() ?><?php echo $payroll_import_add->DateEmployed->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->DateEmployed->cellAttributes() ?>>
<span id="el_payroll_import_DateEmployed">
<input type="text" data-table="payroll_import" data-field="x_DateEmployed" name="x_DateEmployed" id="x_DateEmployed" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($payroll_import_add->DateEmployed->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->DateEmployed->EditValue ?>"<?php echo $payroll_import_add->DateEmployed->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->DateEmployed->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->nrc->Visible) { // nrc ?>
	<div id="r_nrc" class="form-group row">
		<label id="elh_payroll_import_nrc" for="x_nrc" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->nrc->caption() ?><?php echo $payroll_import_add->nrc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->nrc->cellAttributes() ?>>
<span id="el_payroll_import_nrc">
<input type="text" data-table="payroll_import" data-field="x_nrc" name="x_nrc" id="x_nrc" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($payroll_import_add->nrc->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->nrc->EditValue ?>"<?php echo $payroll_import_add->nrc->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->nrc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->napsa->Visible) { // napsa ?>
	<div id="r_napsa" class="form-group row">
		<label id="elh_payroll_import_napsa" for="x_napsa" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->napsa->caption() ?><?php echo $payroll_import_add->napsa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->napsa->cellAttributes() ?>>
<span id="el_payroll_import_napsa">
<input type="text" data-table="payroll_import" data-field="x_napsa" name="x_napsa" id="x_napsa" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($payroll_import_add->napsa->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->napsa->EditValue ?>"<?php echo $payroll_import_add->napsa->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->napsa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->LeaveDays->Visible) { // LeaveDays ?>
	<div id="r_LeaveDays" class="form-group row">
		<label id="elh_payroll_import_LeaveDays" for="x_LeaveDays" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->LeaveDays->caption() ?><?php echo $payroll_import_add->LeaveDays->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->LeaveDays->cellAttributes() ?>>
<span id="el_payroll_import_LeaveDays">
<input type="text" data-table="payroll_import" data-field="x_LeaveDays" name="x_LeaveDays" id="x_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($payroll_import_add->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->LeaveDays->EditValue ?>"<?php echo $payroll_import_add->LeaveDays->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->LeaveDays->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_import_add->sex->Visible) { // sex ?>
	<div id="r_sex" class="form-group row">
		<label id="elh_payroll_import_sex" for="x_sex" class="<?php echo $payroll_import_add->LeftColumnClass ?>"><?php echo $payroll_import_add->sex->caption() ?><?php echo $payroll_import_add->sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_import_add->RightColumnClass ?>"><div <?php echo $payroll_import_add->sex->cellAttributes() ?>>
<span id="el_payroll_import_sex">
<input type="text" data-table="payroll_import" data-field="x_sex" name="x_sex" id="x_sex" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_import_add->sex->getPlaceHolder()) ?>" value="<?php echo $payroll_import_add->sex->EditValue ?>"<?php echo $payroll_import_add->sex->editAttributes() ?>>
</span>
<?php echo $payroll_import_add->sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payroll_import_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_import_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payroll_import_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payroll_import_add->showPageFooter();
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
$payroll_import_add->terminate();
?>