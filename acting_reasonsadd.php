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
$acting_reasons_add = new acting_reasons_add();

// Run the page
$acting_reasons_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_reasons_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facting_reasonsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	facting_reasonsadd = currentForm = new ew.Form("facting_reasonsadd", "add");

	// Validate form
	facting_reasonsadd.validate = function() {
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
			<?php if ($acting_reasons_add->ActingReasons->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingReasons");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acting_reasons_add->ActingReasons->caption(), $acting_reasons_add->ActingReasons->RequiredErrorMessage)) ?>");
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
	facting_reasonsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	facting_reasonsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("facting_reasonsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acting_reasons_add->showPageHeader(); ?>
<?php
$acting_reasons_add->showMessage();
?>
<form name="facting_reasonsadd" id="facting_reasonsadd" class="<?php echo $acting_reasons_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_reasons">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$acting_reasons_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($acting_reasons_add->ActingReasons->Visible) { // ActingReasons ?>
	<div id="r_ActingReasons" class="form-group row">
		<label id="elh_acting_reasons_ActingReasons" for="x_ActingReasons" class="<?php echo $acting_reasons_add->LeftColumnClass ?>"><?php echo $acting_reasons_add->ActingReasons->caption() ?><?php echo $acting_reasons_add->ActingReasons->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acting_reasons_add->RightColumnClass ?>"><div <?php echo $acting_reasons_add->ActingReasons->cellAttributes() ?>>
<span id="el_acting_reasons_ActingReasons">
<input type="text" data-table="acting_reasons" data-field="x_ActingReasons" name="x_ActingReasons" id="x_ActingReasons" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($acting_reasons_add->ActingReasons->getPlaceHolder()) ?>" value="<?php echo $acting_reasons_add->ActingReasons->EditValue ?>"<?php echo $acting_reasons_add->ActingReasons->editAttributes() ?>>
</span>
<?php echo $acting_reasons_add->ActingReasons->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$acting_reasons_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $acting_reasons_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acting_reasons_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$acting_reasons_add->showPageFooter();
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
$acting_reasons_add->terminate();
?>