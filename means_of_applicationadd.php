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
$means_of_application_add = new means_of_application_add();

// Run the page
$means_of_application_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$means_of_application_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmeans_of_applicationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmeans_of_applicationadd = currentForm = new ew.Form("fmeans_of_applicationadd", "add");

	// Validate form
	fmeans_of_applicationadd.validate = function() {
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
			<?php if ($means_of_application_add->ChoiceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChoiceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $means_of_application_add->ChoiceCode->caption(), $means_of_application_add->ChoiceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChoiceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($means_of_application_add->ChoiceCode->errorMessage()) ?>");
			<?php if ($means_of_application_add->Application->Required) { ?>
				elm = this.getElements("x" + infix + "_Application");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $means_of_application_add->Application->caption(), $means_of_application_add->Application->RequiredErrorMessage)) ?>");
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
	fmeans_of_applicationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmeans_of_applicationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmeans_of_applicationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $means_of_application_add->showPageHeader(); ?>
<?php
$means_of_application_add->showMessage();
?>
<form name="fmeans_of_applicationadd" id="fmeans_of_applicationadd" class="<?php echo $means_of_application_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="means_of_application">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$means_of_application_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($means_of_application_add->ChoiceCode->Visible) { // ChoiceCode ?>
	<div id="r_ChoiceCode" class="form-group row">
		<label id="elh_means_of_application_ChoiceCode" for="x_ChoiceCode" class="<?php echo $means_of_application_add->LeftColumnClass ?>"><?php echo $means_of_application_add->ChoiceCode->caption() ?><?php echo $means_of_application_add->ChoiceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $means_of_application_add->RightColumnClass ?>"><div <?php echo $means_of_application_add->ChoiceCode->cellAttributes() ?>>
<span id="el_means_of_application_ChoiceCode">
<input type="text" data-table="means_of_application" data-field="x_ChoiceCode" name="x_ChoiceCode" id="x_ChoiceCode" size="30" placeholder="<?php echo HtmlEncode($means_of_application_add->ChoiceCode->getPlaceHolder()) ?>" value="<?php echo $means_of_application_add->ChoiceCode->EditValue ?>"<?php echo $means_of_application_add->ChoiceCode->editAttributes() ?>>
</span>
<?php echo $means_of_application_add->ChoiceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($means_of_application_add->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label id="elh_means_of_application_Application" for="x_Application" class="<?php echo $means_of_application_add->LeftColumnClass ?>"><?php echo $means_of_application_add->Application->caption() ?><?php echo $means_of_application_add->Application->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $means_of_application_add->RightColumnClass ?>"><div <?php echo $means_of_application_add->Application->cellAttributes() ?>>
<span id="el_means_of_application_Application">
<input type="text" data-table="means_of_application" data-field="x_Application" name="x_Application" id="x_Application" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($means_of_application_add->Application->getPlaceHolder()) ?>" value="<?php echo $means_of_application_add->Application->EditValue ?>"<?php echo $means_of_application_add->Application->editAttributes() ?>>
</span>
<?php echo $means_of_application_add->Application->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$means_of_application_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $means_of_application_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $means_of_application_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$means_of_application_add->showPageFooter();
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
$means_of_application_add->terminate();
?>