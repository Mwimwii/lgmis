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
$indicator_measure_add = new indicator_measure_add();

// Run the page
$indicator_measure_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_measure_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var findicator_measureadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	findicator_measureadd = currentForm = new ew.Form("findicator_measureadd", "add");

	// Validate form
	findicator_measureadd.validate = function() {
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
			<?php if ($indicator_measure_add->Indicator_measure->Required) { ?>
				elm = this.getElements("x" + infix + "_Indicator_measure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_measure_add->Indicator_measure->caption(), $indicator_measure_add->Indicator_measure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($indicator_measure_add->measure_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_measure_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_measure_add->measure_desc->caption(), $indicator_measure_add->measure_desc->RequiredErrorMessage)) ?>");
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
	findicator_measureadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	findicator_measureadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("findicator_measureadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $indicator_measure_add->showPageHeader(); ?>
<?php
$indicator_measure_add->showMessage();
?>
<form name="findicator_measureadd" id="findicator_measureadd" class="<?php echo $indicator_measure_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_measure">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$indicator_measure_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($indicator_measure_add->Indicator_measure->Visible) { // Indicator_measure ?>
	<div id="r_Indicator_measure" class="form-group row">
		<label id="elh_indicator_measure_Indicator_measure" for="x_Indicator_measure" class="<?php echo $indicator_measure_add->LeftColumnClass ?>"><?php echo $indicator_measure_add->Indicator_measure->caption() ?><?php echo $indicator_measure_add->Indicator_measure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_measure_add->RightColumnClass ?>"><div <?php echo $indicator_measure_add->Indicator_measure->cellAttributes() ?>>
<span id="el_indicator_measure_Indicator_measure">
<input type="text" data-table="indicator_measure" data-field="x_Indicator_measure" name="x_Indicator_measure" id="x_Indicator_measure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($indicator_measure_add->Indicator_measure->getPlaceHolder()) ?>" value="<?php echo $indicator_measure_add->Indicator_measure->EditValue ?>"<?php echo $indicator_measure_add->Indicator_measure->editAttributes() ?>>
</span>
<?php echo $indicator_measure_add->Indicator_measure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_measure_add->measure_desc->Visible) { // measure_desc ?>
	<div id="r_measure_desc" class="form-group row">
		<label id="elh_indicator_measure_measure_desc" for="x_measure_desc" class="<?php echo $indicator_measure_add->LeftColumnClass ?>"><?php echo $indicator_measure_add->measure_desc->caption() ?><?php echo $indicator_measure_add->measure_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_measure_add->RightColumnClass ?>"><div <?php echo $indicator_measure_add->measure_desc->cellAttributes() ?>>
<span id="el_indicator_measure_measure_desc">
<input type="text" data-table="indicator_measure" data-field="x_measure_desc" name="x_measure_desc" id="x_measure_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($indicator_measure_add->measure_desc->getPlaceHolder()) ?>" value="<?php echo $indicator_measure_add->measure_desc->EditValue ?>"<?php echo $indicator_measure_add->measure_desc->editAttributes() ?>>
</span>
<?php echo $indicator_measure_add->measure_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$indicator_measure_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $indicator_measure_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $indicator_measure_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$indicator_measure_add->showPageFooter();
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
$indicator_measure_add->terminate();
?>