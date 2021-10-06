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
$asset_status_edit = new asset_status_edit();

// Run the page
$asset_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fasset_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fasset_statusedit = currentForm = new ew.Form("fasset_statusedit", "edit");

	// Validate form
	fasset_statusedit.validate = function() {
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
			<?php if ($asset_status_edit->AssetStatusCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetStatusCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_status_edit->AssetStatusCode->caption(), $asset_status_edit->AssetStatusCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_status_edit->AssetStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_status_edit->AssetStatus->caption(), $asset_status_edit->AssetStatus->RequiredErrorMessage)) ?>");
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
	fasset_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fasset_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fasset_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $asset_status_edit->showPageHeader(); ?>
<?php
$asset_status_edit->showMessage();
?>
<?php if (!$asset_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fasset_statusedit" id="fasset_statusedit" class="<?php echo $asset_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$asset_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($asset_status_edit->AssetStatusCode->Visible) { // AssetStatusCode ?>
	<div id="r_AssetStatusCode" class="form-group row">
		<label id="elh_asset_status_AssetStatusCode" class="<?php echo $asset_status_edit->LeftColumnClass ?>"><?php echo $asset_status_edit->AssetStatusCode->caption() ?><?php echo $asset_status_edit->AssetStatusCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_status_edit->RightColumnClass ?>"><div <?php echo $asset_status_edit->AssetStatusCode->cellAttributes() ?>>
<span id="el_asset_status_AssetStatusCode">
<span<?php echo $asset_status_edit->AssetStatusCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_status_edit->AssetStatusCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset_status" data-field="x_AssetStatusCode" name="x_AssetStatusCode" id="x_AssetStatusCode" value="<?php echo HtmlEncode($asset_status_edit->AssetStatusCode->CurrentValue) ?>">
<?php echo $asset_status_edit->AssetStatusCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($asset_status_edit->AssetStatus->Visible) { // AssetStatus ?>
	<div id="r_AssetStatus" class="form-group row">
		<label id="elh_asset_status_AssetStatus" for="x_AssetStatus" class="<?php echo $asset_status_edit->LeftColumnClass ?>"><?php echo $asset_status_edit->AssetStatus->caption() ?><?php echo $asset_status_edit->AssetStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $asset_status_edit->RightColumnClass ?>"><div <?php echo $asset_status_edit->AssetStatus->cellAttributes() ?>>
<span id="el_asset_status_AssetStatus">
<input type="text" data-table="asset_status" data-field="x_AssetStatus" name="x_AssetStatus" id="x_AssetStatus" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_status_edit->AssetStatus->getPlaceHolder()) ?>" value="<?php echo $asset_status_edit->AssetStatus->EditValue ?>"<?php echo $asset_status_edit->AssetStatus->editAttributes() ?>>
</span>
<?php echo $asset_status_edit->AssetStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$asset_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $asset_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $asset_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$asset_status_edit->IsModal) { ?>
<?php echo $asset_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$asset_status_edit->showPageFooter();
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
$asset_status_edit->terminate();
?>