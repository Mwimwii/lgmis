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
$asset_type_edit = new asset_type_edit();

// Run the page
$asset_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fasset_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fasset_typeedit = currentForm = new ew.Form("fasset_typeedit", "edit");

	// Validate form
	fasset_typeedit.validate = function() {
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
			<?php if ($asset_type_edit->AssetTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_type_edit->AssetTypeCode->caption(), $asset_type_edit->AssetTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_type_edit->AssetTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_type_edit->AssetTypeName->caption(), $asset_type_edit->AssetTypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_type_edit->AssetsTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetsTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_type_edit->AssetsTypeDesc->caption(), $asset_type_edit->AssetsTypeDesc->RequiredErrorMessage)) ?>");
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
	fasset_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fasset_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fasset_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_type_edit->showPageHeader(); ?>
<?php
$asset_type_edit->showMessage();
?>
<?php if (!$asset_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fasset_typeedit" id="fasset_typeedit" class="<?php echo $asset_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$asset_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($asset_type_edit->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<div id="r_AssetTypeCode" class="form-group row">
		<label id="elh_asset_type_AssetTypeCode" class="<?php echo $asset_type_edit->LeftColumnClass ?>"><?php echo $asset_type_edit->AssetTypeCode->caption() ?><?php echo $asset_type_edit->AssetTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_type_edit->RightColumnClass ?>"><div <?php echo $asset_type_edit->AssetTypeCode->cellAttributes() ?>>
<span id="el_asset_type_AssetTypeCode">
<span<?php echo $asset_type_edit->AssetTypeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_type_edit->AssetTypeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset_type" data-field="x_AssetTypeCode" name="x_AssetTypeCode" id="x_AssetTypeCode" value="<?php echo HtmlEncode($asset_type_edit->AssetTypeCode->CurrentValue) ?>">
<?php echo $asset_type_edit->AssetTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_type_edit->AssetTypeName->Visible) { // AssetTypeName ?>
	<div id="r_AssetTypeName" class="form-group row">
		<label id="elh_asset_type_AssetTypeName" for="x_AssetTypeName" class="<?php echo $asset_type_edit->LeftColumnClass ?>"><?php echo $asset_type_edit->AssetTypeName->caption() ?><?php echo $asset_type_edit->AssetTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_type_edit->RightColumnClass ?>"><div <?php echo $asset_type_edit->AssetTypeName->cellAttributes() ?>>
<span id="el_asset_type_AssetTypeName">
<input type="text" data-table="asset_type" data-field="x_AssetTypeName" name="x_AssetTypeName" id="x_AssetTypeName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_type_edit->AssetTypeName->getPlaceHolder()) ?>" value="<?php echo $asset_type_edit->AssetTypeName->EditValue ?>"<?php echo $asset_type_edit->AssetTypeName->editAttributes() ?>>
</span>
<?php echo $asset_type_edit->AssetTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_type_edit->AssetsTypeDesc->Visible) { // AssetsTypeDesc ?>
	<div id="r_AssetsTypeDesc" class="form-group row">
		<label id="elh_asset_type_AssetsTypeDesc" for="x_AssetsTypeDesc" class="<?php echo $asset_type_edit->LeftColumnClass ?>"><?php echo $asset_type_edit->AssetsTypeDesc->caption() ?><?php echo $asset_type_edit->AssetsTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_type_edit->RightColumnClass ?>"><div <?php echo $asset_type_edit->AssetsTypeDesc->cellAttributes() ?>>
<span id="el_asset_type_AssetsTypeDesc">
<input type="text" data-table="asset_type" data-field="x_AssetsTypeDesc" name="x_AssetsTypeDesc" id="x_AssetsTypeDesc" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_type_edit->AssetsTypeDesc->getPlaceHolder()) ?>" value="<?php echo $asset_type_edit->AssetsTypeDesc->EditValue ?>"<?php echo $asset_type_edit->AssetsTypeDesc->editAttributes() ?>>
</span>
<?php echo $asset_type_edit->AssetsTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$asset_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $asset_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$asset_type_edit->IsModal) { ?>
<?php echo $asset_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$asset_type_edit->showPageFooter();
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
$asset_type_edit->terminate();
?>