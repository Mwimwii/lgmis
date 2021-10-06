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
$payment_method_edit = new payment_method_edit();

// Run the page
$payment_method_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_method_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayment_methodedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpayment_methodedit = currentForm = new ew.Form("fpayment_methodedit", "edit");

	// Validate form
	fpayment_methodedit.validate = function() {
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
			<?php if ($payment_method_edit->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_method_edit->PaymentMethod->caption(), $payment_method_edit->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payment_method_edit->PaymentDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payment_method_edit->PaymentDesc->caption(), $payment_method_edit->PaymentDesc->RequiredErrorMessage)) ?>");
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
	fpayment_methodedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayment_methodedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpayment_methodedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payment_method_edit->showPageHeader(); ?>
<?php
$payment_method_edit->showMessage();
?>
<?php if (!$payment_method_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payment_method_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fpayment_methodedit" id="fpayment_methodedit" class="<?php echo $payment_method_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment_method">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$payment_method_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($payment_method_edit->PaymentMethod->Visible) { // PaymentMethod ?>
	<div id="r_PaymentMethod" class="form-group row">
		<label id="elh_payment_method_PaymentMethod" for="x_PaymentMethod" class="<?php echo $payment_method_edit->LeftColumnClass ?>"><?php echo $payment_method_edit->PaymentMethod->caption() ?><?php echo $payment_method_edit->PaymentMethod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_method_edit->RightColumnClass ?>"><div <?php echo $payment_method_edit->PaymentMethod->cellAttributes() ?>>
<input type="text" data-table="payment_method" data-field="x_PaymentMethod" name="x_PaymentMethod" id="x_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($payment_method_edit->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $payment_method_edit->PaymentMethod->EditValue ?>"<?php echo $payment_method_edit->PaymentMethod->editAttributes() ?>>
<input type="hidden" data-table="payment_method" data-field="x_PaymentMethod" name="o_PaymentMethod" id="o_PaymentMethod" value="<?php echo HtmlEncode($payment_method_edit->PaymentMethod->OldValue != null ? $payment_method_edit->PaymentMethod->OldValue : $payment_method_edit->PaymentMethod->CurrentValue) ?>">
<?php echo $payment_method_edit->PaymentMethod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payment_method_edit->PaymentDesc->Visible) { // PaymentDesc ?>
	<div id="r_PaymentDesc" class="form-group row">
		<label id="elh_payment_method_PaymentDesc" for="x_PaymentDesc" class="<?php echo $payment_method_edit->LeftColumnClass ?>"><?php echo $payment_method_edit->PaymentDesc->caption() ?><?php echo $payment_method_edit->PaymentDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payment_method_edit->RightColumnClass ?>"><div <?php echo $payment_method_edit->PaymentDesc->cellAttributes() ?>>
<span id="el_payment_method_PaymentDesc">
<input type="text" data-table="payment_method" data-field="x_PaymentDesc" name="x_PaymentDesc" id="x_PaymentDesc" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($payment_method_edit->PaymentDesc->getPlaceHolder()) ?>" value="<?php echo $payment_method_edit->PaymentDesc->EditValue ?>"<?php echo $payment_method_edit->PaymentDesc->editAttributes() ?>>
</span>
<?php echo $payment_method_edit->PaymentDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payment_method_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payment_method_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payment_method_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$payment_method_edit->IsModal) { ?>
<?php echo $payment_method_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$payment_method_edit->showPageFooter();
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
$payment_method_edit->terminate();
?>