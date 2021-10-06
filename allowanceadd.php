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
$allowance_add = new allowance_add();

// Run the page
$allowance_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$allowance_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fallowanceadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fallowanceadd = currentForm = new ew.Form("fallowanceadd", "add");

	// Validate form
	fallowanceadd.validate = function() {
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
			<?php if ($allowance_add->AllowanceName->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $allowance_add->AllowanceName->caption(), $allowance_add->AllowanceName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($allowance_add->AllowanceAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $allowance_add->AllowanceAmount->caption(), $allowance_add->AllowanceAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($allowance_add->AllowanceAmount->errorMessage()) ?>");

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
	fallowanceadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fallowanceadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fallowanceadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $allowance_add->showPageHeader(); ?>
<?php
$allowance_add->showMessage();
?>
<form name="fallowanceadd" id="fallowanceadd" class="<?php echo $allowance_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="allowance">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$allowance_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($allowance_add->AllowanceName->Visible) { // AllowanceName ?>
	<div id="r_AllowanceName" class="form-group row">
		<label id="elh_allowance_AllowanceName" for="x_AllowanceName" class="<?php echo $allowance_add->LeftColumnClass ?>"><?php echo $allowance_add->AllowanceName->caption() ?><?php echo $allowance_add->AllowanceName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $allowance_add->RightColumnClass ?>"><div <?php echo $allowance_add->AllowanceName->cellAttributes() ?>>
<span id="el_allowance_AllowanceName">
<input type="text" data-table="allowance" data-field="x_AllowanceName" name="x_AllowanceName" id="x_AllowanceName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($allowance_add->AllowanceName->getPlaceHolder()) ?>" value="<?php echo $allowance_add->AllowanceName->EditValue ?>"<?php echo $allowance_add->AllowanceName->editAttributes() ?>>
</span>
<?php echo $allowance_add->AllowanceName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($allowance_add->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<div id="r_AllowanceAmount" class="form-group row">
		<label id="elh_allowance_AllowanceAmount" for="x_AllowanceAmount" class="<?php echo $allowance_add->LeftColumnClass ?>"><?php echo $allowance_add->AllowanceAmount->caption() ?><?php echo $allowance_add->AllowanceAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $allowance_add->RightColumnClass ?>"><div <?php echo $allowance_add->AllowanceAmount->cellAttributes() ?>>
<span id="el_allowance_AllowanceAmount">
<input type="text" data-table="allowance" data-field="x_AllowanceAmount" name="x_AllowanceAmount" id="x_AllowanceAmount" size="30" placeholder="<?php echo HtmlEncode($allowance_add->AllowanceAmount->getPlaceHolder()) ?>" value="<?php echo $allowance_add->AllowanceAmount->EditValue ?>"<?php echo $allowance_add->AllowanceAmount->editAttributes() ?>>
</span>
<?php echo $allowance_add->AllowanceAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$allowance_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $allowance_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $allowance_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$allowance_add->showPageFooter();
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
$allowance_add->terminate();
?>