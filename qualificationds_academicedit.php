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
$qualificationds_academic_edit = new qualificationds_academic_edit();

// Run the page
$qualificationds_academic_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualificationds_academic_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fqualificationds_academicedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fqualificationds_academicedit = currentForm = new ew.Form("fqualificationds_academicedit", "edit");

	// Validate form
	fqualificationds_academicedit.validate = function() {
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
			<?php if ($qualificationds_academic_edit->AcademicQualifications->Required) { ?>
				elm = this.getElements("x" + infix + "_AcademicQualifications");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualificationds_academic_edit->AcademicQualifications->caption(), $qualificationds_academic_edit->AcademicQualifications->RequiredErrorMessage)) ?>");
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
	fqualificationds_academicedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fqualificationds_academicedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fqualificationds_academicedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $qualificationds_academic_edit->showPageHeader(); ?>
<?php
$qualificationds_academic_edit->showMessage();
?>
<?php if (!$qualificationds_academic_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualificationds_academic_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fqualificationds_academicedit" id="fqualificationds_academicedit" class="<?php echo $qualificationds_academic_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualificationds_academic">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$qualificationds_academic_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($qualificationds_academic_edit->AcademicQualifications->Visible) { // AcademicQualifications ?>
	<div id="r_AcademicQualifications" class="form-group row">
		<label id="elh_qualificationds_academic_AcademicQualifications" for="x_AcademicQualifications" class="<?php echo $qualificationds_academic_edit->LeftColumnClass ?>"><?php echo $qualificationds_academic_edit->AcademicQualifications->caption() ?><?php echo $qualificationds_academic_edit->AcademicQualifications->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $qualificationds_academic_edit->RightColumnClass ?>"><div <?php echo $qualificationds_academic_edit->AcademicQualifications->cellAttributes() ?>>
<input type="text" data-table="qualificationds_academic" data-field="x_AcademicQualifications" name="x_AcademicQualifications" id="x_AcademicQualifications" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($qualificationds_academic_edit->AcademicQualifications->getPlaceHolder()) ?>" value="<?php echo $qualificationds_academic_edit->AcademicQualifications->EditValue ?>"<?php echo $qualificationds_academic_edit->AcademicQualifications->editAttributes() ?>>
<input type="hidden" data-table="qualificationds_academic" data-field="x_AcademicQualifications" name="o_AcademicQualifications" id="o_AcademicQualifications" value="<?php echo HtmlEncode($qualificationds_academic_edit->AcademicQualifications->OldValue != null ? $qualificationds_academic_edit->AcademicQualifications->OldValue : $qualificationds_academic_edit->AcademicQualifications->CurrentValue) ?>">
<?php echo $qualificationds_academic_edit->AcademicQualifications->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$qualificationds_academic_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $qualificationds_academic_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $qualificationds_academic_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$qualificationds_academic_edit->IsModal) { ?>
<?php echo $qualificationds_academic_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$qualificationds_academic_edit->showPageFooter();
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
$qualificationds_academic_edit->terminate();
?>