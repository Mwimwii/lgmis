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
$grade_edit = new grade_edit();

// Run the page
$grade_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grade_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgradeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgradeedit = currentForm = new ew.Form("fgradeedit", "edit");

	// Validate form
	fgradeedit.validate = function() {
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
			<?php if ($grade_edit->Grade->Required) { ?>
				elm = this.getElements("x" + infix + "_Grade");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $grade_edit->Grade->caption(), $grade_edit->Grade->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Grade");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($grade_edit->Grade->errorMessage()) ?>");
			<?php if ($grade_edit->GradeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_GradeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $grade_edit->GradeDesc->caption(), $grade_edit->GradeDesc->RequiredErrorMessage)) ?>");
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
	fgradeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgradeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgradeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $grade_edit->showPageHeader(); ?>
<?php
$grade_edit->showMessage();
?>
<?php if (!$grade_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grade_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fgradeedit" id="fgradeedit" class="<?php echo $grade_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$grade_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($grade_edit->Grade->Visible) { // Grade ?>
	<div id="r_Grade" class="form-group row">
		<label id="elh_grade_Grade" for="x_Grade" class="<?php echo $grade_edit->LeftColumnClass ?>"><?php echo $grade_edit->Grade->caption() ?><?php echo $grade_edit->Grade->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $grade_edit->RightColumnClass ?>"><div <?php echo $grade_edit->Grade->cellAttributes() ?>>
<input type="text" data-table="grade" data-field="x_Grade" name="x_Grade" id="x_Grade" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($grade_edit->Grade->getPlaceHolder()) ?>" value="<?php echo $grade_edit->Grade->EditValue ?>"<?php echo $grade_edit->Grade->editAttributes() ?>>
<input type="hidden" data-table="grade" data-field="x_Grade" name="o_Grade" id="o_Grade" value="<?php echo HtmlEncode($grade_edit->Grade->OldValue != null ? $grade_edit->Grade->OldValue : $grade_edit->Grade->CurrentValue) ?>">
<?php echo $grade_edit->Grade->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($grade_edit->GradeDesc->Visible) { // GradeDesc ?>
	<div id="r_GradeDesc" class="form-group row">
		<label id="elh_grade_GradeDesc" for="x_GradeDesc" class="<?php echo $grade_edit->LeftColumnClass ?>"><?php echo $grade_edit->GradeDesc->caption() ?><?php echo $grade_edit->GradeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $grade_edit->RightColumnClass ?>"><div <?php echo $grade_edit->GradeDesc->cellAttributes() ?>>
<span id="el_grade_GradeDesc">
<input type="text" data-table="grade" data-field="x_GradeDesc" name="x_GradeDesc" id="x_GradeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($grade_edit->GradeDesc->getPlaceHolder()) ?>" value="<?php echo $grade_edit->GradeDesc->EditValue ?>"<?php echo $grade_edit->GradeDesc->editAttributes() ?>>
</span>
<?php echo $grade_edit->GradeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$grade_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $grade_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $grade_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$grade_edit->IsModal) { ?>
<?php echo $grade_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$grade_edit->showPageFooter();
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
$grade_edit->terminate();
?>