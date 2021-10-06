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
$professional_body_add = new professional_body_add();

// Run the page
$professional_body_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_body_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessional_bodyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fprofessional_bodyadd = currentForm = new ew.Form("fprofessional_bodyadd", "add");

	// Validate form
	fprofessional_bodyadd.validate = function() {
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
			<?php if ($professional_body_add->ProfessionalBody->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_body_add->ProfessionalBody->caption(), $professional_body_add->ProfessionalBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professional_body_add->ProfessionalField->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalField");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_body_add->ProfessionalField->caption(), $professional_body_add->ProfessionalField->RequiredErrorMessage)) ?>");
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
	fprofessional_bodyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprofessional_bodyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprofessional_bodyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professional_body_add->showPageHeader(); ?>
<?php
$professional_body_add->showMessage();
?>
<form name="fprofessional_bodyadd" id="fprofessional_bodyadd" class="<?php echo $professional_body_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_body">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$professional_body_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($professional_body_add->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<div id="r_ProfessionalBody" class="form-group row">
		<label id="elh_professional_body_ProfessionalBody" for="x_ProfessionalBody" class="<?php echo $professional_body_add->LeftColumnClass ?>"><?php echo $professional_body_add->ProfessionalBody->caption() ?><?php echo $professional_body_add->ProfessionalBody->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_body_add->RightColumnClass ?>"><div <?php echo $professional_body_add->ProfessionalBody->cellAttributes() ?>>
<span id="el_professional_body_ProfessionalBody">
<input type="text" data-table="professional_body" data-field="x_ProfessionalBody" name="x_ProfessionalBody" id="x_ProfessionalBody" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($professional_body_add->ProfessionalBody->getPlaceHolder()) ?>" value="<?php echo $professional_body_add->ProfessionalBody->EditValue ?>"<?php echo $professional_body_add->ProfessionalBody->editAttributes() ?>>
</span>
<?php echo $professional_body_add->ProfessionalBody->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professional_body_add->ProfessionalField->Visible) { // ProfessionalField ?>
	<div id="r_ProfessionalField" class="form-group row">
		<label id="elh_professional_body_ProfessionalField" for="x_ProfessionalField" class="<?php echo $professional_body_add->LeftColumnClass ?>"><?php echo $professional_body_add->ProfessionalField->caption() ?><?php echo $professional_body_add->ProfessionalField->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_body_add->RightColumnClass ?>"><div <?php echo $professional_body_add->ProfessionalField->cellAttributes() ?>>
<span id="el_professional_body_ProfessionalField">
<input type="text" data-table="professional_body" data-field="x_ProfessionalField" name="x_ProfessionalField" id="x_ProfessionalField" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($professional_body_add->ProfessionalField->getPlaceHolder()) ?>" value="<?php echo $professional_body_add->ProfessionalField->EditValue ?>"<?php echo $professional_body_add->ProfessionalField->editAttributes() ?>>
</span>
<?php echo $professional_body_add->ProfessionalField->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$professional_body_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $professional_body_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professional_body_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$professional_body_add->showPageFooter();
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
$professional_body_add->terminate();
?>