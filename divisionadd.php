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
$division_add = new division_add();

// Run the page
$division_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdivisionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdivisionadd = currentForm = new ew.Form("fdivisionadd", "add");

	// Validate form
	fdivisionadd.validate = function() {
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
			<?php if ($division_add->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_add->Division->caption(), $division_add->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($division_add->Division->errorMessage()) ?>");
			<?php if ($division_add->DivisionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DivisionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_add->DivisionName->caption(), $division_add->DivisionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($division_add->Comments->Required) { ?>
				elm = this.getElements("x" + infix + "_Comments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $division_add->Comments->caption(), $division_add->Comments->RequiredErrorMessage)) ?>");
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
	fdivisionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdivisionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdivisionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $division_add->showPageHeader(); ?>
<?php
$division_add->showMessage();
?>
<form name="fdivisionadd" id="fdivisionadd" class="<?php echo $division_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$division_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($division_add->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_division_Division" for="x_Division" class="<?php echo $division_add->LeftColumnClass ?>"><?php echo $division_add->Division->caption() ?><?php echo $division_add->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_add->RightColumnClass ?>"><div <?php echo $division_add->Division->cellAttributes() ?>>
<span id="el_division_Division">
<input type="text" data-table="division" data-field="x_Division" name="x_Division" id="x_Division" size="30" placeholder="<?php echo HtmlEncode($division_add->Division->getPlaceHolder()) ?>" value="<?php echo $division_add->Division->EditValue ?>"<?php echo $division_add->Division->editAttributes() ?>>
</span>
<?php echo $division_add->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($division_add->DivisionName->Visible) { // DivisionName ?>
	<div id="r_DivisionName" class="form-group row">
		<label id="elh_division_DivisionName" for="x_DivisionName" class="<?php echo $division_add->LeftColumnClass ?>"><?php echo $division_add->DivisionName->caption() ?><?php echo $division_add->DivisionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_add->RightColumnClass ?>"><div <?php echo $division_add->DivisionName->cellAttributes() ?>>
<span id="el_division_DivisionName">
<input type="text" data-table="division" data-field="x_DivisionName" name="x_DivisionName" id="x_DivisionName" size="100" maxlength="255" placeholder="<?php echo HtmlEncode($division_add->DivisionName->getPlaceHolder()) ?>" value="<?php echo $division_add->DivisionName->EditValue ?>"<?php echo $division_add->DivisionName->editAttributes() ?>>
</span>
<?php echo $division_add->DivisionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($division_add->Comments->Visible) { // Comments ?>
	<div id="r_Comments" class="form-group row">
		<label id="elh_division_Comments" for="x_Comments" class="<?php echo $division_add->LeftColumnClass ?>"><?php echo $division_add->Comments->caption() ?><?php echo $division_add->Comments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $division_add->RightColumnClass ?>"><div <?php echo $division_add->Comments->cellAttributes() ?>>
<span id="el_division_Comments">
<textarea data-table="division" data-field="x_Comments" name="x_Comments" id="x_Comments" cols="100" rows="2" placeholder="<?php echo HtmlEncode($division_add->Comments->getPlaceHolder()) ?>"<?php echo $division_add->Comments->editAttributes() ?>><?php echo $division_add->Comments->EditValue ?></textarea>
</span>
<?php echo $division_add->Comments->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("job", explode(",", $division->getCurrentDetailTable())) && $job->DetailAdd) {
?>
<?php if ($division->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("job", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "jobgrid.php" ?>
<?php } ?>
<?php
	if (in_array("salary_scale", explode(",", $division->getCurrentDetailTable())) && $salary_scale->DetailAdd) {
?>
<?php if ($division->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("salary_scale", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "salary_scalegrid.php" ?>
<?php } ?>
<?php if (!$division_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $division_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $division_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$division_add->showPageFooter();
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
$division_add->terminate();
?>