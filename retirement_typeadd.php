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
$retirement_type_add = new retirement_type_add();

// Run the page
$retirement_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$retirement_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fretirement_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fretirement_typeadd = currentForm = new ew.Form("fretirement_typeadd", "add");

	// Validate form
	fretirement_typeadd.validate = function() {
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
			<?php if ($retirement_type_add->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $retirement_type_add->RetirementType->caption(), $retirement_type_add->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($retirement_type_add->ExitCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $retirement_type_add->ExitCode->caption(), $retirement_type_add->ExitCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($retirement_type_add->ExitCode->errorMessage()) ?>");

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
	fretirement_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fretirement_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fretirement_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $retirement_type_add->showPageHeader(); ?>
<?php
$retirement_type_add->showMessage();
?>
<form name="fretirement_typeadd" id="fretirement_typeadd" class="<?php echo $retirement_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="retirement_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$retirement_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($retirement_type_add->RetirementType->Visible) { // RetirementType ?>
	<div id="r_RetirementType" class="form-group row">
		<label id="elh_retirement_type_RetirementType" for="x_RetirementType" class="<?php echo $retirement_type_add->LeftColumnClass ?>"><?php echo $retirement_type_add->RetirementType->caption() ?><?php echo $retirement_type_add->RetirementType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $retirement_type_add->RightColumnClass ?>"><div <?php echo $retirement_type_add->RetirementType->cellAttributes() ?>>
<span id="el_retirement_type_RetirementType">
<input type="text" data-table="retirement_type" data-field="x_RetirementType" name="x_RetirementType" id="x_RetirementType" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($retirement_type_add->RetirementType->getPlaceHolder()) ?>" value="<?php echo $retirement_type_add->RetirementType->EditValue ?>"<?php echo $retirement_type_add->RetirementType->editAttributes() ?>>
</span>
<?php echo $retirement_type_add->RetirementType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($retirement_type_add->ExitCode->Visible) { // ExitCode ?>
	<div id="r_ExitCode" class="form-group row">
		<label id="elh_retirement_type_ExitCode" for="x_ExitCode" class="<?php echo $retirement_type_add->LeftColumnClass ?>"><?php echo $retirement_type_add->ExitCode->caption() ?><?php echo $retirement_type_add->ExitCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $retirement_type_add->RightColumnClass ?>"><div <?php echo $retirement_type_add->ExitCode->cellAttributes() ?>>
<span id="el_retirement_type_ExitCode">
<input type="text" data-table="retirement_type" data-field="x_ExitCode" name="x_ExitCode" id="x_ExitCode" size="30" placeholder="<?php echo HtmlEncode($retirement_type_add->ExitCode->getPlaceHolder()) ?>" value="<?php echo $retirement_type_add->ExitCode->EditValue ?>"<?php echo $retirement_type_add->ExitCode->editAttributes() ?>>
</span>
<?php echo $retirement_type_add->ExitCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$retirement_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $retirement_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $retirement_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$retirement_type_add->showPageFooter();
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
$retirement_type_add->terminate();
?>