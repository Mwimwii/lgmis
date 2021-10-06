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
$meansofimplement_edit = new meansofimplement_edit();

// Run the page
$meansofimplement_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$meansofimplement_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmeansofimplementedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmeansofimplementedit = currentForm = new ew.Form("fmeansofimplementedit", "edit");

	// Validate form
	fmeansofimplementedit.validate = function() {
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
			<?php if ($meansofimplement_edit->moimp_code->Required) { ?>
				elm = this.getElements("x" + infix + "_moimp_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $meansofimplement_edit->moimp_code->caption(), $meansofimplement_edit->moimp_code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($meansofimplement_edit->moimp_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_moimp_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $meansofimplement_edit->moimp_desc->caption(), $meansofimplement_edit->moimp_desc->RequiredErrorMessage)) ?>");
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
	fmeansofimplementedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmeansofimplementedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmeansofimplementedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $meansofimplement_edit->showPageHeader(); ?>
<?php
$meansofimplement_edit->showMessage();
?>
<?php if (!$meansofimplement_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $meansofimplement_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fmeansofimplementedit" id="fmeansofimplementedit" class="<?php echo $meansofimplement_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="meansofimplement">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$meansofimplement_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($meansofimplement_edit->moimp_code->Visible) { // moimp_code ?>
	<div id="r_moimp_code" class="form-group row">
		<label id="elh_meansofimplement_moimp_code" class="<?php echo $meansofimplement_edit->LeftColumnClass ?>"><?php echo $meansofimplement_edit->moimp_code->caption() ?><?php echo $meansofimplement_edit->moimp_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $meansofimplement_edit->RightColumnClass ?>"><div <?php echo $meansofimplement_edit->moimp_code->cellAttributes() ?>>
<span id="el_meansofimplement_moimp_code">
<span<?php echo $meansofimplement_edit->moimp_code->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($meansofimplement_edit->moimp_code->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="meansofimplement" data-field="x_moimp_code" name="x_moimp_code" id="x_moimp_code" value="<?php echo HtmlEncode($meansofimplement_edit->moimp_code->CurrentValue) ?>">
<?php echo $meansofimplement_edit->moimp_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($meansofimplement_edit->moimp_desc->Visible) { // moimp_desc ?>
	<div id="r_moimp_desc" class="form-group row">
		<label id="elh_meansofimplement_moimp_desc" for="x_moimp_desc" class="<?php echo $meansofimplement_edit->LeftColumnClass ?>"><?php echo $meansofimplement_edit->moimp_desc->caption() ?><?php echo $meansofimplement_edit->moimp_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $meansofimplement_edit->RightColumnClass ?>"><div <?php echo $meansofimplement_edit->moimp_desc->cellAttributes() ?>>
<span id="el_meansofimplement_moimp_desc">
<input type="text" data-table="meansofimplement" data-field="x_moimp_desc" name="x_moimp_desc" id="x_moimp_desc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($meansofimplement_edit->moimp_desc->getPlaceHolder()) ?>" value="<?php echo $meansofimplement_edit->moimp_desc->EditValue ?>"<?php echo $meansofimplement_edit->moimp_desc->editAttributes() ?>>
</span>
<?php echo $meansofimplement_edit->moimp_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$meansofimplement_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $meansofimplement_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $meansofimplement_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$meansofimplement_edit->IsModal) { ?>
<?php echo $meansofimplement_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$meansofimplement_edit->showPageFooter();
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
$meansofimplement_edit->terminate();
?>