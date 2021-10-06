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
$asset_type_add = new asset_type_add();

// Run the page
$asset_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fasset_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fasset_typeadd = currentForm = new ew.Form("fasset_typeadd", "add");

	// Validate form
	fasset_typeadd.validate = function() {
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
			<?php if ($asset_type_add->AssetTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_type_add->AssetTypeName->caption(), $asset_type_add->AssetTypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_type_add->AssetsTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetsTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_type_add->AssetsTypeDesc->caption(), $asset_type_add->AssetsTypeDesc->RequiredErrorMessage)) ?>");
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
	fasset_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fasset_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fasset_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_type_add->showPageHeader(); ?>
<?php
$asset_type_add->showMessage();
?>
<form name="fasset_typeadd" id="fasset_typeadd" class="<?php echo $asset_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$asset_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($asset_type_add->AssetTypeName->Visible) { // AssetTypeName ?>
	<div id="r_AssetTypeName" class="form-group row">
		<label id="elh_asset_type_AssetTypeName" for="x_AssetTypeName" class="<?php echo $asset_type_add->LeftColumnClass ?>"><?php echo $asset_type_add->AssetTypeName->caption() ?><?php echo $asset_type_add->AssetTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_type_add->RightColumnClass ?>"><div <?php echo $asset_type_add->AssetTypeName->cellAttributes() ?>>
<span id="el_asset_type_AssetTypeName">
<input type="text" data-table="asset_type" data-field="x_AssetTypeName" name="x_AssetTypeName" id="x_AssetTypeName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_type_add->AssetTypeName->getPlaceHolder()) ?>" value="<?php echo $asset_type_add->AssetTypeName->EditValue ?>"<?php echo $asset_type_add->AssetTypeName->editAttributes() ?>>
</span>
<?php echo $asset_type_add->AssetTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_type_add->AssetsTypeDesc->Visible) { // AssetsTypeDesc ?>
	<div id="r_AssetsTypeDesc" class="form-group row">
		<label id="elh_asset_type_AssetsTypeDesc" for="x_AssetsTypeDesc" class="<?php echo $asset_type_add->LeftColumnClass ?>"><?php echo $asset_type_add->AssetsTypeDesc->caption() ?><?php echo $asset_type_add->AssetsTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_type_add->RightColumnClass ?>"><div <?php echo $asset_type_add->AssetsTypeDesc->cellAttributes() ?>>
<span id="el_asset_type_AssetsTypeDesc">
<input type="text" data-table="asset_type" data-field="x_AssetsTypeDesc" name="x_AssetsTypeDesc" id="x_AssetsTypeDesc" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_type_add->AssetsTypeDesc->getPlaceHolder()) ?>" value="<?php echo $asset_type_add->AssetsTypeDesc->EditValue ?>"<?php echo $asset_type_add->AssetsTypeDesc->editAttributes() ?>>
</span>
<?php echo $asset_type_add->AssetsTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$asset_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $asset_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$asset_type_add->showPageFooter();
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
$asset_type_add->terminate();
?>