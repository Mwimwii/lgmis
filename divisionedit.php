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
$division_edit = new division_edit();

// Run the page
$division_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdivisionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdivisionedit = currentForm = new ew.Form("fdivisionedit", "edit");

	// Validate form
	fdivisionedit.validate = function() {
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
			<?php if ($division_edit->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_edit->Division->caption(), $division_edit->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($division_edit->Division->errorMessage()) ?>");
			<?php if ($division_edit->DivisionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DivisionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_edit->DivisionName->caption(), $division_edit->DivisionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($division_edit->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_edit->Comments->caption(), $division_edit->Comments->RequiredErrorMessage)) ?>");
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
	fdivisionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdivisionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdivisionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $division_edit->showPageHeader(); ?>
<?php
$division_edit->showMessage();
?>
<?php if (!$division_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $division_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdivisionedit" id="fdivisionedit" class="<?php echo $division_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$division_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($division_edit->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_division_Division" for="x_Division" class="<?php echo $division_edit->LeftColumnClass ?>"><?php echo $division_edit->Division->caption() ?><?php echo $division_edit->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_edit->RightColumnClass ?>"><div <?php echo $division_edit->Division->cellAttributes() ?>>
<input type="text" data-table="division" data-field="x_Division" name="x_Division" id="x_Division" size="30" placeholder="<?php echo HtmlEncode($division_edit->Division->getPlaceHolder()) ?>" value="<?php echo $division_edit->Division->EditValue ?>"<?php echo $division_edit->Division->editAttributes() ?>>
<input type="hidden" data-table="division" data-field="x_Division" name="o_Division" id="o_Division" value="<?php echo HtmlEncode($division_edit->Division->OldValue != null ? $division_edit->Division->OldValue : $division_edit->Division->CurrentValue) ?>">
<?php echo $division_edit->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($division_edit->DivisionName->Visible) { // DivisionName ?>
	<div id="r_DivisionName" class="form-group row">
		<label id="elh_division_DivisionName" for="x_DivisionName" class="<?php echo $division_edit->LeftColumnClass ?>"><?php echo $division_edit->DivisionName->caption() ?><?php echo $division_edit->DivisionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_edit->RightColumnClass ?>"><div <?php echo $division_edit->DivisionName->cellAttributes() ?>>
<span id="el_division_DivisionName">
<input type="text" data-table="division" data-field="x_DivisionName" name="x_DivisionName" id="x_DivisionName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($division_edit->DivisionName->getPlaceHolder()) ?>" value="<?php echo $division_edit->DivisionName->EditValue ?>"<?php echo $division_edit->DivisionName->editAttributes() ?>>
</span>
<?php echo $division_edit->DivisionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($division_edit->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label id="elh_division_Comments" for="x_Comments" class="<?php echo $division_edit->LeftColumnClass ?>"><?php echo $division_edit->Comments->caption() ?><?php echo $division_edit->Comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_edit->RightColumnClass ?>"><div <?php echo $division_edit->Comments->cellAttributes() ?>>
<span id="el_division_Comments">
<textarea data-table="division" data-field="x_Comments" name="x_Comments" id="x_Comments" cols="100" rows="2" placeholder="<?php echo HtmlEncode($division_edit->Comments->getPlaceHolder()) ?>"<?php echo $division_edit->Comments->editAttributes() ?>><?php echo $division_edit->Comments->EditValue ?></textarea>
</span>
<?php echo $division_edit->Comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("job", explode(",", $division->getCurrentDetailTable())) && $job->DetailEdit) {
?>
<?php if ($division->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("job", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "jobgrid.php" ?>
<?php } ?>
<?php
	if (in_array("salary_scale", explode(",", $division->getCurrentDetailTable())) && $salary_scale->DetailEdit) {
?>
<?php if ($division->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("salary_scale", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "salary_scalegrid.php" ?>
<?php } ?>
<?php if (!$division_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $division_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $division_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$division_edit->IsModal) { ?>
<?php echo $division_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$division_edit->showPageFooter();
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
$division_edit->terminate();
?>