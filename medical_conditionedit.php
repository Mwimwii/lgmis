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
$medical_condition_edit = new medical_condition_edit();

// Run the page
$medical_condition_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medical_condition_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmedical_conditionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmedical_conditionedit = currentForm = new ew.Form("fmedical_conditionedit", "edit");

	// Validate form
	fmedical_conditionedit.validate = function() {
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
			<?php if ($medical_condition_edit->MedicalCondition->Required) { ?>
				elm = this.getElements("x" + infix + "_MedicalCondition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medical_condition_edit->MedicalCondition->caption(), $medical_condition_edit->MedicalCondition->RequiredErrorMessage)) ?>");
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
	fmedical_conditionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmedical_conditionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmedical_conditionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $medical_condition_edit->showPageHeader(); ?>
<?php
$medical_condition_edit->showMessage();
?>
<?php if (!$medical_condition_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $medical_condition_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fmedical_conditionedit" id="fmedical_conditionedit" class="<?php echo $medical_condition_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medical_condition">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$medical_condition_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($medical_condition_edit->MedicalCondition->Visible) { // MedicalCondition ?>
	<div id="r_MedicalCondition" class="form-group row">
		<label id="elh_medical_condition_MedicalCondition" for="x_MedicalCondition" class="<?php echo $medical_condition_edit->LeftColumnClass ?>"><?php echo $medical_condition_edit->MedicalCondition->caption() ?><?php echo $medical_condition_edit->MedicalCondition->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medical_condition_edit->RightColumnClass ?>"><div <?php echo $medical_condition_edit->MedicalCondition->cellAttributes() ?>>
<input type="text" data-table="medical_condition" data-field="x_MedicalCondition" name="x_MedicalCondition" id="x_MedicalCondition" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($medical_condition_edit->MedicalCondition->getPlaceHolder()) ?>" value="<?php echo $medical_condition_edit->MedicalCondition->EditValue ?>"<?php echo $medical_condition_edit->MedicalCondition->editAttributes() ?>>
<input type="hidden" data-table="medical_condition" data-field="x_MedicalCondition" name="o_MedicalCondition" id="o_MedicalCondition" value="<?php echo HtmlEncode($medical_condition_edit->MedicalCondition->OldValue != null ? $medical_condition_edit->MedicalCondition->OldValue : $medical_condition_edit->MedicalCondition->CurrentValue) ?>">
<?php echo $medical_condition_edit->MedicalCondition->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$medical_condition_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $medical_condition_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $medical_condition_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$medical_condition_edit->IsModal) { ?>
<?php echo $medical_condition_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$medical_condition_edit->showPageFooter();
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
$medical_condition_edit->terminate();
?>