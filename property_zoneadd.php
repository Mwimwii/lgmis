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
$property_zone_add = new property_zone_add();

// Run the page
$property_zone_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_zone_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_zoneadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproperty_zoneadd = currentForm = new ew.Form("fproperty_zoneadd", "add");

	// Validate form
	fproperty_zoneadd.validate = function() {
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
			<?php if ($property_zone_add->AreaName->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_zone_add->AreaName->caption(), $property_zone_add->AreaName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_zone_add->AreaType->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_zone_add->AreaType->caption(), $property_zone_add->AreaType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_zone_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_zone_add->LACode->caption(), $property_zone_add->LACode->RequiredErrorMessage)) ?>");
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
	fproperty_zoneadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_zoneadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_zoneadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_zone_add->showPageHeader(); ?>
<?php
$property_zone_add->showMessage();
?>
<form name="fproperty_zoneadd" id="fproperty_zoneadd" class="<?php echo $property_zone_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_zone">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$property_zone_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($property_zone_add->AreaName->Visible) { // AreaName ?>
	<div id="r_AreaName" class="form-group row">
		<label id="elh_property_zone_AreaName" for="x_AreaName" class="<?php echo $property_zone_add->LeftColumnClass ?>"><?php echo $property_zone_add->AreaName->caption() ?><?php echo $property_zone_add->AreaName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_zone_add->RightColumnClass ?>"><div <?php echo $property_zone_add->AreaName->cellAttributes() ?>>
<span id="el_property_zone_AreaName">
<input type="text" data-table="property_zone" data-field="x_AreaName" name="x_AreaName" id="x_AreaName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_zone_add->AreaName->getPlaceHolder()) ?>" value="<?php echo $property_zone_add->AreaName->EditValue ?>"<?php echo $property_zone_add->AreaName->editAttributes() ?>>
</span>
<?php echo $property_zone_add->AreaName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_zone_add->AreaType->Visible) { // AreaType ?>
	<div id="r_AreaType" class="form-group row">
		<label id="elh_property_zone_AreaType" for="x_AreaType" class="<?php echo $property_zone_add->LeftColumnClass ?>"><?php echo $property_zone_add->AreaType->caption() ?><?php echo $property_zone_add->AreaType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_zone_add->RightColumnClass ?>"><div <?php echo $property_zone_add->AreaType->cellAttributes() ?>>
<span id="el_property_zone_AreaType">
<input type="text" data-table="property_zone" data-field="x_AreaType" name="x_AreaType" id="x_AreaType" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_zone_add->AreaType->getPlaceHolder()) ?>" value="<?php echo $property_zone_add->AreaType->EditValue ?>"<?php echo $property_zone_add->AreaType->editAttributes() ?>>
</span>
<?php echo $property_zone_add->AreaType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_zone_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_property_zone_LACode" for="x_LACode" class="<?php echo $property_zone_add->LeftColumnClass ?>"><?php echo $property_zone_add->LACode->caption() ?><?php echo $property_zone_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_zone_add->RightColumnClass ?>"><div <?php echo $property_zone_add->LACode->cellAttributes() ?>>
<span id="el_property_zone_LACode">
<input type="text" data-table="property_zone" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_zone_add->LACode->getPlaceHolder()) ?>" value="<?php echo $property_zone_add->LACode->EditValue ?>"<?php echo $property_zone_add->LACode->editAttributes() ?>>
</span>
<?php echo $property_zone_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_zone_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_zone_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_zone_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_zone_add->showPageFooter();
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
$property_zone_add->terminate();
?>