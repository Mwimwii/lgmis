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
$property_use_add = new property_use_add();

// Run the page
$property_use_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_use_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_useadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproperty_useadd = currentForm = new ew.Form("fproperty_useadd", "add");

	// Validate form
	fproperty_useadd.validate = function() {
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
			<?php if ($property_use_add->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_add->PropertyUse->caption(), $property_use_add->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_use_add->UseDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_UseDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_add->UseDesc->caption(), $property_use_add->UseDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_use_add->RatesLevy->Required) { ?>
				elm = this.getElements("x" + infix + "_RatesLevy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_add->RatesLevy->caption(), $property_use_add->RatesLevy->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RatesLevy");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_use_add->RatesLevy->errorMessage()) ?>");
			<?php if ($property_use_add->DFactor->Required) { ?>
				elm = this.getElements("x" + infix + "_DFactor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_add->DFactor->caption(), $property_use_add->DFactor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DFactor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_use_add->DFactor->errorMessage()) ?>");

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
	fproperty_useadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_useadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_useadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_use_add->showPageHeader(); ?>
<?php
$property_use_add->showMessage();
?>
<form name="fproperty_useadd" id="fproperty_useadd" class="<?php echo $property_use_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_use">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$property_use_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($property_use_add->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_use_PropertyUse" for="x_PropertyUse" class="<?php echo $property_use_add->LeftColumnClass ?>"><?php echo $property_use_add->PropertyUse->caption() ?><?php echo $property_use_add->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_add->RightColumnClass ?>"><div <?php echo $property_use_add->PropertyUse->cellAttributes() ?>>
<span id="el_property_use_PropertyUse">
<input type="text" data-table="property_use" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($property_use_add->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_use_add->PropertyUse->EditValue ?>"<?php echo $property_use_add->PropertyUse->editAttributes() ?>>
</span>
<?php echo $property_use_add->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_use_add->UseDesc->Visible) { // UseDesc ?>
	<div id="r_UseDesc" class="form-group row">
		<label id="elh_property_use_UseDesc" for="x_UseDesc" class="<?php echo $property_use_add->LeftColumnClass ?>"><?php echo $property_use_add->UseDesc->caption() ?><?php echo $property_use_add->UseDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_add->RightColumnClass ?>"><div <?php echo $property_use_add->UseDesc->cellAttributes() ?>>
<span id="el_property_use_UseDesc">
<input type="text" data-table="property_use" data-field="x_UseDesc" name="x_UseDesc" id="x_UseDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_use_add->UseDesc->getPlaceHolder()) ?>" value="<?php echo $property_use_add->UseDesc->EditValue ?>"<?php echo $property_use_add->UseDesc->editAttributes() ?>>
</span>
<?php echo $property_use_add->UseDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_use_add->RatesLevy->Visible) { // RatesLevy ?>
	<div id="r_RatesLevy" class="form-group row">
		<label id="elh_property_use_RatesLevy" for="x_RatesLevy" class="<?php echo $property_use_add->LeftColumnClass ?>"><?php echo $property_use_add->RatesLevy->caption() ?><?php echo $property_use_add->RatesLevy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_add->RightColumnClass ?>"><div <?php echo $property_use_add->RatesLevy->cellAttributes() ?>>
<span id="el_property_use_RatesLevy">
<input type="text" data-table="property_use" data-field="x_RatesLevy" name="x_RatesLevy" id="x_RatesLevy" size="30" placeholder="<?php echo HtmlEncode($property_use_add->RatesLevy->getPlaceHolder()) ?>" value="<?php echo $property_use_add->RatesLevy->EditValue ?>"<?php echo $property_use_add->RatesLevy->editAttributes() ?>>
</span>
<?php echo $property_use_add->RatesLevy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_use_add->DFactor->Visible) { // DFactor ?>
	<div id="r_DFactor" class="form-group row">
		<label id="elh_property_use_DFactor" for="x_DFactor" class="<?php echo $property_use_add->LeftColumnClass ?>"><?php echo $property_use_add->DFactor->caption() ?><?php echo $property_use_add->DFactor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_add->RightColumnClass ?>"><div <?php echo $property_use_add->DFactor->cellAttributes() ?>>
<span id="el_property_use_DFactor">
<input type="text" data-table="property_use" data-field="x_DFactor" name="x_DFactor" id="x_DFactor" size="30" placeholder="<?php echo HtmlEncode($property_use_add->DFactor->getPlaceHolder()) ?>" value="<?php echo $property_use_add->DFactor->EditValue ?>"<?php echo $property_use_add->DFactor->editAttributes() ?>>
</span>
<?php echo $property_use_add->DFactor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_use_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_use_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_use_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_use_add->showPageFooter();
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
$property_use_add->terminate();
?>