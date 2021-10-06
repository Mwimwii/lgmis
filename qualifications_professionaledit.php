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
$qualifications_professional_edit = new qualifications_professional_edit();

// Run the page
$qualifications_professional_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualifications_professional_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fqualifications_professionaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fqualifications_professionaledit = currentForm = new ew.Form("fqualifications_professionaledit", "edit");

	// Validate form
	fqualifications_professionaledit.validate = function() {
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
			<?php if ($qualifications_professional_edit->ProfessionalQualifications->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalQualifications");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualifications_professional_edit->ProfessionalQualifications->caption(), $qualifications_professional_edit->ProfessionalQualifications->RequiredErrorMessage)) ?>");
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
	fqualifications_professionaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fqualifications_professionaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fqualifications_professionaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $qualifications_professional_edit->showPageHeader(); ?>
<?php
$qualifications_professional_edit->showMessage();
?>
<?php if (!$qualifications_professional_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualifications_professional_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fqualifications_professionaledit" id="fqualifications_professionaledit" class="<?php echo $qualifications_professional_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualifications_professional">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$qualifications_professional_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($qualifications_professional_edit->ProfessionalQualifications->Visible) { // ProfessionalQualifications ?>
	<div id="r_ProfessionalQualifications" class="form-group row">
		<label id="elh_qualifications_professional_ProfessionalQualifications" for="x_ProfessionalQualifications" class="<?php echo $qualifications_professional_edit->LeftColumnClass ?>"><?php echo $qualifications_professional_edit->ProfessionalQualifications->caption() ?><?php echo $qualifications_professional_edit->ProfessionalQualifications->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $qualifications_professional_edit->RightColumnClass ?>"><div <?php echo $qualifications_professional_edit->ProfessionalQualifications->cellAttributes() ?>>
<input type="text" data-table="qualifications_professional" data-field="x_ProfessionalQualifications" name="x_ProfessionalQualifications" id="x_ProfessionalQualifications" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($qualifications_professional_edit->ProfessionalQualifications->getPlaceHolder()) ?>" value="<?php echo $qualifications_professional_edit->ProfessionalQualifications->EditValue ?>"<?php echo $qualifications_professional_edit->ProfessionalQualifications->editAttributes() ?>>
<input type="hidden" data-table="qualifications_professional" data-field="x_ProfessionalQualifications" name="o_ProfessionalQualifications" id="o_ProfessionalQualifications" value="<?php echo HtmlEncode($qualifications_professional_edit->ProfessionalQualifications->OldValue != null ? $qualifications_professional_edit->ProfessionalQualifications->OldValue : $qualifications_professional_edit->ProfessionalQualifications->CurrentValue) ?>">
<?php echo $qualifications_professional_edit->ProfessionalQualifications->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$qualifications_professional_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $qualifications_professional_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $qualifications_professional_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$qualifications_professional_edit->IsModal) { ?>
<?php echo $qualifications_professional_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$qualifications_professional_edit->showPageFooter();
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
$qualifications_professional_edit->terminate();
?>