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
$professional_body_edit = new professional_body_edit();

// Run the page
$professional_body_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_body_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessional_bodyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fprofessional_bodyedit = currentForm = new ew.Form("fprofessional_bodyedit", "edit");

	// Validate form
	fprofessional_bodyedit.validate = function() {
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
			<?php if ($professional_body_edit->ProfessionalBody->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_body_edit->ProfessionalBody->caption(), $professional_body_edit->ProfessionalBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professional_body_edit->ProfessionalField->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalField");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_body_edit->ProfessionalField->caption(), $professional_body_edit->ProfessionalField->RequiredErrorMessage)) ?>");
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
	fprofessional_bodyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprofessional_bodyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprofessional_bodyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professional_body_edit->showPageHeader(); ?>
<?php
$professional_body_edit->showMessage();
?>
<?php if (!$professional_body_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_body_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fprofessional_bodyedit" id="fprofessional_bodyedit" class="<?php echo $professional_body_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_body">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$professional_body_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($professional_body_edit->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<div id="r_ProfessionalBody" class="form-group row">
		<label id="elh_professional_body_ProfessionalBody" for="x_ProfessionalBody" class="<?php echo $professional_body_edit->LeftColumnClass ?>"><?php echo $professional_body_edit->ProfessionalBody->caption() ?><?php echo $professional_body_edit->ProfessionalBody->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_body_edit->RightColumnClass ?>"><div <?php echo $professional_body_edit->ProfessionalBody->cellAttributes() ?>>
<input type="text" data-table="professional_body" data-field="x_ProfessionalBody" name="x_ProfessionalBody" id="x_ProfessionalBody" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($professional_body_edit->ProfessionalBody->getPlaceHolder()) ?>" value="<?php echo $professional_body_edit->ProfessionalBody->EditValue ?>"<?php echo $professional_body_edit->ProfessionalBody->editAttributes() ?>>
<input type="hidden" data-table="professional_body" data-field="x_ProfessionalBody" name="o_ProfessionalBody" id="o_ProfessionalBody" value="<?php echo HtmlEncode($professional_body_edit->ProfessionalBody->OldValue != null ? $professional_body_edit->ProfessionalBody->OldValue : $professional_body_edit->ProfessionalBody->CurrentValue) ?>">
<?php echo $professional_body_edit->ProfessionalBody->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professional_body_edit->ProfessionalField->Visible) { // ProfessionalField ?>
	<div id="r_ProfessionalField" class="form-group row">
		<label id="elh_professional_body_ProfessionalField" for="x_ProfessionalField" class="<?php echo $professional_body_edit->LeftColumnClass ?>"><?php echo $professional_body_edit->ProfessionalField->caption() ?><?php echo $professional_body_edit->ProfessionalField->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_body_edit->RightColumnClass ?>"><div <?php echo $professional_body_edit->ProfessionalField->cellAttributes() ?>>
<span id="el_professional_body_ProfessionalField">
<input type="text" data-table="professional_body" data-field="x_ProfessionalField" name="x_ProfessionalField" id="x_ProfessionalField" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($professional_body_edit->ProfessionalField->getPlaceHolder()) ?>" value="<?php echo $professional_body_edit->ProfessionalField->EditValue ?>"<?php echo $professional_body_edit->ProfessionalField->editAttributes() ?>>
</span>
<?php echo $professional_body_edit->ProfessionalField->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$professional_body_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $professional_body_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professional_body_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$professional_body_edit->IsModal) { ?>
<?php echo $professional_body_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$professional_body_edit->showPageFooter();
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
$professional_body_edit->terminate();
?>