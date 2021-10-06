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
$qualificationds_academic_add = new qualificationds_academic_add();

// Run the page
$qualificationds_academic_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualificationds_academic_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fqualificationds_academicadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fqualificationds_academicadd = currentForm = new ew.Form("fqualificationds_academicadd", "add");

	// Validate form
	fqualificationds_academicadd.validate = function() {
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
			<?php if ($qualificationds_academic_add->AcademicQualifications->Required) { ?>
				elm = this.getElements("x" + infix + "_AcademicQualifications");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualificationds_academic_add->AcademicQualifications->caption(), $qualificationds_academic_add->AcademicQualifications->RequiredErrorMessage)) ?>");
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
	fqualificationds_academicadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fqualificationds_academicadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fqualificationds_academicadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $qualificationds_academic_add->showPageHeader(); ?>
<?php
$qualificationds_academic_add->showMessage();
?>
<form name="fqualificationds_academicadd" id="fqualificationds_academicadd" class="<?php echo $qualificationds_academic_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualificationds_academic">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$qualificationds_academic_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($qualificationds_academic_add->AcademicQualifications->Visible) { // AcademicQualifications ?>
	<div id="r_AcademicQualifications" class="form-group row">
		<label id="elh_qualificationds_academic_AcademicQualifications" for="x_AcademicQualifications" class="<?php echo $qualificationds_academic_add->LeftColumnClass ?>"><?php echo $qualificationds_academic_add->AcademicQualifications->caption() ?><?php echo $qualificationds_academic_add->AcademicQualifications->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $qualificationds_academic_add->RightColumnClass ?>"><div <?php echo $qualificationds_academic_add->AcademicQualifications->cellAttributes() ?>>
<span id="el_qualificationds_academic_AcademicQualifications">
<input type="text" data-table="qualificationds_academic" data-field="x_AcademicQualifications" name="x_AcademicQualifications" id="x_AcademicQualifications" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($qualificationds_academic_add->AcademicQualifications->getPlaceHolder()) ?>" value="<?php echo $qualificationds_academic_add->AcademicQualifications->EditValue ?>"<?php echo $qualificationds_academic_add->AcademicQualifications->editAttributes() ?>>
</span>
<?php echo $qualificationds_academic_add->AcademicQualifications->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$qualificationds_academic_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $qualificationds_academic_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $qualificationds_academic_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$qualificationds_academic_add->showPageFooter();
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
$qualificationds_academic_add->terminate();
?>