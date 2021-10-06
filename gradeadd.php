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
$grade_add = new grade_add();

// Run the page
$grade_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grade_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgradeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgradeadd = currentForm = new ew.Form("fgradeadd", "add");

	// Validate form
	fgradeadd.validate = function() {
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
			<?php if ($grade_add->Grade->Required) { ?>
				elm = this.getElements("x" + infix + "_Grade");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $grade_add->Grade->caption(), $grade_add->Grade->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Grade");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($grade_add->Grade->errorMessage()) ?>");
			<?php if ($grade_add->GradeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $grade_add->GradeDesc->caption(), $grade_add->GradeDesc->RequiredErrorMessage)) ?>");
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
	fgradeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgradeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgradeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $grade_add->showPageHeader(); ?>
<?php
$grade_add->showMessage();
?>
<form name="fgradeadd" id="fgradeadd" class="<?php echo $grade_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$grade_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($grade_add->Grade->Visible) { // Grade ?>
	<div id="r_Grade" class="form-group row">
		<label id="elh_grade_Grade" for="x_Grade" class="<?php echo $grade_add->LeftColumnClass ?>"><?php echo $grade_add->Grade->caption() ?><?php echo $grade_add->Grade->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $grade_add->RightColumnClass ?>"><div <?php echo $grade_add->Grade->cellAttributes() ?>>
<span id="el_grade_Grade">
<input type="text" data-table="grade" data-field="x_Grade" name="x_Grade" id="x_Grade" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($grade_add->Grade->getPlaceHolder()) ?>" value="<?php echo $grade_add->Grade->EditValue ?>"<?php echo $grade_add->Grade->editAttributes() ?>>
</span>
<?php echo $grade_add->Grade->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($grade_add->GradeDesc->Visible) { // GradeDesc ?>
	<div id="r_GradeDesc" class="form-group row">
		<label id="elh_grade_GradeDesc" for="x_GradeDesc" class="<?php echo $grade_add->LeftColumnClass ?>"><?php echo $grade_add->GradeDesc->caption() ?><?php echo $grade_add->GradeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $grade_add->RightColumnClass ?>"><div <?php echo $grade_add->GradeDesc->cellAttributes() ?>>
<span id="el_grade_GradeDesc">
<input type="text" data-table="grade" data-field="x_GradeDesc" name="x_GradeDesc" id="x_GradeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($grade_add->GradeDesc->getPlaceHolder()) ?>" value="<?php echo $grade_add->GradeDesc->EditValue ?>"<?php echo $grade_add->GradeDesc->editAttributes() ?>>
</span>
<?php echo $grade_add->GradeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$grade_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $grade_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $grade_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$grade_add->showPageFooter();
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
$grade_add->terminate();
?>