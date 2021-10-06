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
$core_function_add = new core_function_add();

// Run the page
$core_function_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$core_function_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcore_functionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcore_functionadd = currentForm = new ew.Form("fcore_functionadd", "add");

	// Validate form
	fcore_functionadd.validate = function() {
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
			<?php if ($core_function_add->functioncode->Required) { ?>
				elm = this.getElements("x" + infix + "_functioncode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $core_function_add->functioncode->caption(), $core_function_add->functioncode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($core_function_add->FunctionName->Required) { ?>
				elm = this.getElements("x" + infix + "_FunctionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $core_function_add->FunctionName->caption(), $core_function_add->FunctionName->RequiredErrorMessage)) ?>");
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
	fcore_functionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcore_functionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcore_functionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $core_function_add->showPageHeader(); ?>
<?php
$core_function_add->showMessage();
?>
<form name="fcore_functionadd" id="fcore_functionadd" class="<?php echo $core_function_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="core_function">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$core_function_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($core_function_add->functioncode->Visible) { // functioncode ?>
	<div id="r_functioncode" class="form-group row">
		<label id="elh_core_function_functioncode" for="x_functioncode" class="<?php echo $core_function_add->LeftColumnClass ?>"><?php echo $core_function_add->functioncode->caption() ?><?php echo $core_function_add->functioncode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $core_function_add->RightColumnClass ?>"><div <?php echo $core_function_add->functioncode->cellAttributes() ?>>
<span id="el_core_function_functioncode">
<input type="text" data-table="core_function" data-field="x_functioncode" name="x_functioncode" id="x_functioncode" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($core_function_add->functioncode->getPlaceHolder()) ?>" value="<?php echo $core_function_add->functioncode->EditValue ?>"<?php echo $core_function_add->functioncode->editAttributes() ?>>
</span>
<?php echo $core_function_add->functioncode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($core_function_add->FunctionName->Visible) { // FunctionName ?>
	<div id="r_FunctionName" class="form-group row">
		<label id="elh_core_function_FunctionName" for="x_FunctionName" class="<?php echo $core_function_add->LeftColumnClass ?>"><?php echo $core_function_add->FunctionName->caption() ?><?php echo $core_function_add->FunctionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $core_function_add->RightColumnClass ?>"><div <?php echo $core_function_add->FunctionName->cellAttributes() ?>>
<span id="el_core_function_FunctionName">
<input type="text" data-table="core_function" data-field="x_FunctionName" name="x_FunctionName" id="x_FunctionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($core_function_add->FunctionName->getPlaceHolder()) ?>" value="<?php echo $core_function_add->FunctionName->EditValue ?>"<?php echo $core_function_add->FunctionName->editAttributes() ?>>
</span>
<?php echo $core_function_add->FunctionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$core_function_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $core_function_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $core_function_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$core_function_add->showPageFooter();
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
$core_function_add->terminate();
?>