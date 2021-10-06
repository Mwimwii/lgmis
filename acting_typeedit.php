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
$acting_type_edit = new acting_type_edit();

// Run the page
$acting_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facting_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	facting_typeedit = currentForm = new ew.Form("facting_typeedit", "edit");

	// Validate form
	facting_typeedit.validate = function() {
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
			<?php if ($acting_type_edit->ActingType->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acting_type_edit->ActingType->caption(), $acting_type_edit->ActingType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($acting_type_edit->ActingTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $acting_type_edit->ActingTypeDesc->caption(), $acting_type_edit->ActingTypeDesc->RequiredErrorMessage)) ?>");
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
	facting_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	facting_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("facting_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acting_type_edit->showPageHeader(); ?>
<?php
$acting_type_edit->showMessage();
?>
<?php if (!$acting_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="facting_typeedit" id="facting_typeedit" class="<?php echo $acting_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$acting_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($acting_type_edit->ActingType->Visible) { // ActingType ?>
	<div id="r_ActingType" class="form-group row">
		<label id="elh_acting_type_ActingType" class="<?php echo $acting_type_edit->LeftColumnClass ?>"><?php echo $acting_type_edit->ActingType->caption() ?><?php echo $acting_type_edit->ActingType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acting_type_edit->RightColumnClass ?>"><div <?php echo $acting_type_edit->ActingType->cellAttributes() ?>>
<span id="el_acting_type_ActingType">
<span<?php echo $acting_type_edit->ActingType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($acting_type_edit->ActingType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="acting_type" data-field="x_ActingType" name="x_ActingType" id="x_ActingType" value="<?php echo HtmlEncode($acting_type_edit->ActingType->CurrentValue) ?>">
<?php echo $acting_type_edit->ActingType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($acting_type_edit->ActingTypeDesc->Visible) { // ActingTypeDesc ?>
	<div id="r_ActingTypeDesc" class="form-group row">
		<label id="elh_acting_type_ActingTypeDesc" for="x_ActingTypeDesc" class="<?php echo $acting_type_edit->LeftColumnClass ?>"><?php echo $acting_type_edit->ActingTypeDesc->caption() ?><?php echo $acting_type_edit->ActingTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $acting_type_edit->RightColumnClass ?>"><div <?php echo $acting_type_edit->ActingTypeDesc->cellAttributes() ?>>
<span id="el_acting_type_ActingTypeDesc">
<input type="text" data-table="acting_type" data-field="x_ActingTypeDesc" name="x_ActingTypeDesc" id="x_ActingTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($acting_type_edit->ActingTypeDesc->getPlaceHolder()) ?>" value="<?php echo $acting_type_edit->ActingTypeDesc->EditValue ?>"<?php echo $acting_type_edit->ActingTypeDesc->editAttributes() ?>>
</span>
<?php echo $acting_type_edit->ActingTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$acting_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $acting_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acting_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$acting_type_edit->IsModal) { ?>
<?php echo $acting_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$acting_type_edit->showPageFooter();
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
$acting_type_edit->terminate();
?>