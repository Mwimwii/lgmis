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
$property_zone_edit = new property_zone_edit();

// Run the page
$property_zone_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_zone_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_zoneedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproperty_zoneedit = currentForm = new ew.Form("fproperty_zoneedit", "edit");

	// Validate form
	fproperty_zoneedit.validate = function() {
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
			<?php if ($property_zone_edit->AreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_zone_edit->AreaCode->caption(), $property_zone_edit->AreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_zone_edit->AreaName->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_zone_edit->AreaName->caption(), $property_zone_edit->AreaName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_zone_edit->AreaType->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_zone_edit->AreaType->caption(), $property_zone_edit->AreaType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_zone_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_zone_edit->LACode->caption(), $property_zone_edit->LACode->RequiredErrorMessage)) ?>");
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
	fproperty_zoneedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_zoneedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_zoneedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_zone_edit->showPageHeader(); ?>
<?php
$property_zone_edit->showMessage();
?>
<?php if (!$property_zone_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_zone_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproperty_zoneedit" id="fproperty_zoneedit" class="<?php echo $property_zone_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_zone">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$property_zone_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_zone_edit->AreaCode->Visible) { // AreaCode ?>
	<div id="r_AreaCode" class="form-group row">
		<label id="elh_property_zone_AreaCode" class="<?php echo $property_zone_edit->LeftColumnClass ?>"><?php echo $property_zone_edit->AreaCode->caption() ?><?php echo $property_zone_edit->AreaCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_zone_edit->RightColumnClass ?>"><div <?php echo $property_zone_edit->AreaCode->cellAttributes() ?>>
<span id="el_property_zone_AreaCode">
<span<?php echo $property_zone_edit->AreaCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_zone_edit->AreaCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_zone" data-field="x_AreaCode" name="x_AreaCode" id="x_AreaCode" value="<?php echo HtmlEncode($property_zone_edit->AreaCode->CurrentValue) ?>">
<?php echo $property_zone_edit->AreaCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_zone_edit->AreaName->Visible) { // AreaName ?>
	<div id="r_AreaName" class="form-group row">
		<label id="elh_property_zone_AreaName" for="x_AreaName" class="<?php echo $property_zone_edit->LeftColumnClass ?>"><?php echo $property_zone_edit->AreaName->caption() ?><?php echo $property_zone_edit->AreaName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_zone_edit->RightColumnClass ?>"><div <?php echo $property_zone_edit->AreaName->cellAttributes() ?>>
<span id="el_property_zone_AreaName">
<input type="text" data-table="property_zone" data-field="x_AreaName" name="x_AreaName" id="x_AreaName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_zone_edit->AreaName->getPlaceHolder()) ?>" value="<?php echo $property_zone_edit->AreaName->EditValue ?>"<?php echo $property_zone_edit->AreaName->editAttributes() ?>>
</span>
<?php echo $property_zone_edit->AreaName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_zone_edit->AreaType->Visible) { // AreaType ?>
	<div id="r_AreaType" class="form-group row">
		<label id="elh_property_zone_AreaType" for="x_AreaType" class="<?php echo $property_zone_edit->LeftColumnClass ?>"><?php echo $property_zone_edit->AreaType->caption() ?><?php echo $property_zone_edit->AreaType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_zone_edit->RightColumnClass ?>"><div <?php echo $property_zone_edit->AreaType->cellAttributes() ?>>
<span id="el_property_zone_AreaType">
<input type="text" data-table="property_zone" data-field="x_AreaType" name="x_AreaType" id="x_AreaType" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_zone_edit->AreaType->getPlaceHolder()) ?>" value="<?php echo $property_zone_edit->AreaType->EditValue ?>"<?php echo $property_zone_edit->AreaType->editAttributes() ?>>
</span>
<?php echo $property_zone_edit->AreaType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_zone_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_property_zone_LACode" for="x_LACode" class="<?php echo $property_zone_edit->LeftColumnClass ?>"><?php echo $property_zone_edit->LACode->caption() ?><?php echo $property_zone_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_zone_edit->RightColumnClass ?>"><div <?php echo $property_zone_edit->LACode->cellAttributes() ?>>
<span id="el_property_zone_LACode">
<input type="text" data-table="property_zone" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_zone_edit->LACode->getPlaceHolder()) ?>" value="<?php echo $property_zone_edit->LACode->EditValue ?>"<?php echo $property_zone_edit->LACode->editAttributes() ?>>
</span>
<?php echo $property_zone_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_zone_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_zone_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_zone_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_zone_edit->IsModal) { ?>
<?php echo $property_zone_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$property_zone_edit->showPageFooter();
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
$property_zone_edit->terminate();
?>