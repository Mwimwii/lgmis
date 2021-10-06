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
$meansofimplement_add = new meansofimplement_add();

// Run the page
$meansofimplement_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$meansofimplement_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmeansofimplementadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmeansofimplementadd = currentForm = new ew.Form("fmeansofimplementadd", "add");

	// Validate form
	fmeansofimplementadd.validate = function() {
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
			<?php if ($meansofimplement_add->moimp_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_moimp_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $meansofimplement_add->moimp_desc->caption(), $meansofimplement_add->moimp_desc->RequiredErrorMessage)) ?>");
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
	fmeansofimplementadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmeansofimplementadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmeansofimplementadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $meansofimplement_add->showPageHeader(); ?>
<?php
$meansofimplement_add->showMessage();
?>
<form name="fmeansofimplementadd" id="fmeansofimplementadd" class="<?php echo $meansofimplement_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="meansofimplement">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$meansofimplement_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($meansofimplement_add->moimp_desc->Visible) { // moimp_desc ?>
	<div id="r_moimp_desc" class="form-group row">
		<label id="elh_meansofimplement_moimp_desc" for="x_moimp_desc" class="<?php echo $meansofimplement_add->LeftColumnClass ?>"><?php echo $meansofimplement_add->moimp_desc->caption() ?><?php echo $meansofimplement_add->moimp_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $meansofimplement_add->RightColumnClass ?>"><div <?php echo $meansofimplement_add->moimp_desc->cellAttributes() ?>>
<span id="el_meansofimplement_moimp_desc">
<input type="text" data-table="meansofimplement" data-field="x_moimp_desc" name="x_moimp_desc" id="x_moimp_desc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($meansofimplement_add->moimp_desc->getPlaceHolder()) ?>" value="<?php echo $meansofimplement_add->moimp_desc->EditValue ?>"<?php echo $meansofimplement_add->moimp_desc->editAttributes() ?>>
</span>
<?php echo $meansofimplement_add->moimp_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$meansofimplement_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $meansofimplement_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $meansofimplement_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$meansofimplement_add->showPageFooter();
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
$meansofimplement_add->terminate();
?>