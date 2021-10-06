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
$indicator_direction_add = new indicator_direction_add();

// Run the page
$indicator_direction_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_direction_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var findicator_directionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	findicator_directionadd = currentForm = new ew.Form("findicator_directionadd", "add");

	// Validate form
	findicator_directionadd.validate = function() {
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
			<?php if ($indicator_direction_add->indicator_direction->Required) { ?>
				elm = this.getElements("x" + infix + "_indicator_direction");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_direction_add->indicator_direction->caption(), $indicator_direction_add->indicator_direction->RequiredErrorMessage)) ?>");
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
	findicator_directionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	findicator_directionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("findicator_directionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $indicator_direction_add->showPageHeader(); ?>
<?php
$indicator_direction_add->showMessage();
?>
<form name="findicator_directionadd" id="findicator_directionadd" class="<?php echo $indicator_direction_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_direction">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$indicator_direction_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($indicator_direction_add->indicator_direction->Visible) { // indicator_direction ?>
	<div id="r_indicator_direction" class="form-group row">
		<label id="elh_indicator_direction_indicator_direction" for="x_indicator_direction" class="<?php echo $indicator_direction_add->LeftColumnClass ?>"><?php echo $indicator_direction_add->indicator_direction->caption() ?><?php echo $indicator_direction_add->indicator_direction->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_direction_add->RightColumnClass ?>"><div <?php echo $indicator_direction_add->indicator_direction->cellAttributes() ?>>
<span id="el_indicator_direction_indicator_direction">
<input type="text" data-table="indicator_direction" data-field="x_indicator_direction" name="x_indicator_direction" id="x_indicator_direction" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($indicator_direction_add->indicator_direction->getPlaceHolder()) ?>" value="<?php echo $indicator_direction_add->indicator_direction->EditValue ?>"<?php echo $indicator_direction_add->indicator_direction->editAttributes() ?>>
</span>
<?php echo $indicator_direction_add->indicator_direction->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$indicator_direction_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $indicator_direction_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $indicator_direction_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$indicator_direction_add->showPageFooter();
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
$indicator_direction_add->terminate();
?>