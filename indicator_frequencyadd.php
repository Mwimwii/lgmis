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
$indicator_frequency_add = new indicator_frequency_add();

// Run the page
$indicator_frequency_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_frequency_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var findicator_frequencyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	findicator_frequencyadd = currentForm = new ew.Form("findicator_frequencyadd", "add");

	// Validate form
	findicator_frequencyadd.validate = function() {
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
			<?php if ($indicator_frequency_add->indicator_frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_indicator_frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_frequency_add->indicator_frequency->caption(), $indicator_frequency_add->indicator_frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($indicator_frequency_add->frequency_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_frequency_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_frequency_add->frequency_desc->caption(), $indicator_frequency_add->frequency_desc->RequiredErrorMessage)) ?>");
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
	findicator_frequencyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	findicator_frequencyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("findicator_frequencyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $indicator_frequency_add->showPageHeader(); ?>
<?php
$indicator_frequency_add->showMessage();
?>
<form name="findicator_frequencyadd" id="findicator_frequencyadd" class="<?php echo $indicator_frequency_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_frequency">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$indicator_frequency_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($indicator_frequency_add->indicator_frequency->Visible) { // indicator_frequency ?>
	<div id="r_indicator_frequency" class="form-group row">
		<label id="elh_indicator_frequency_indicator_frequency" for="x_indicator_frequency" class="<?php echo $indicator_frequency_add->LeftColumnClass ?>"><?php echo $indicator_frequency_add->indicator_frequency->caption() ?><?php echo $indicator_frequency_add->indicator_frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_frequency_add->RightColumnClass ?>"><div <?php echo $indicator_frequency_add->indicator_frequency->cellAttributes() ?>>
<span id="el_indicator_frequency_indicator_frequency">
<input type="text" data-table="indicator_frequency" data-field="x_indicator_frequency" name="x_indicator_frequency" id="x_indicator_frequency" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($indicator_frequency_add->indicator_frequency->getPlaceHolder()) ?>" value="<?php echo $indicator_frequency_add->indicator_frequency->EditValue ?>"<?php echo $indicator_frequency_add->indicator_frequency->editAttributes() ?>>
</span>
<?php echo $indicator_frequency_add->indicator_frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_frequency_add->frequency_desc->Visible) { // frequency_desc ?>
	<div id="r_frequency_desc" class="form-group row">
		<label id="elh_indicator_frequency_frequency_desc" for="x_frequency_desc" class="<?php echo $indicator_frequency_add->LeftColumnClass ?>"><?php echo $indicator_frequency_add->frequency_desc->caption() ?><?php echo $indicator_frequency_add->frequency_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_frequency_add->RightColumnClass ?>"><div <?php echo $indicator_frequency_add->frequency_desc->cellAttributes() ?>>
<span id="el_indicator_frequency_frequency_desc">
<input type="text" data-table="indicator_frequency" data-field="x_frequency_desc" name="x_frequency_desc" id="x_frequency_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($indicator_frequency_add->frequency_desc->getPlaceHolder()) ?>" value="<?php echo $indicator_frequency_add->frequency_desc->EditValue ?>"<?php echo $indicator_frequency_add->frequency_desc->editAttributes() ?>>
</span>
<?php echo $indicator_frequency_add->frequency_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$indicator_frequency_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $indicator_frequency_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $indicator_frequency_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$indicator_frequency_add->showPageFooter();
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
$indicator_frequency_add->terminate();
?>