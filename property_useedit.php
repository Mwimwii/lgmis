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
$property_use_edit = new property_use_edit();

// Run the page
$property_use_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_use_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_useedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproperty_useedit = currentForm = new ew.Form("fproperty_useedit", "edit");

	// Validate form
	fproperty_useedit.validate = function() {
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
			<?php if ($property_use_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_edit->PropertyUse->caption(), $property_use_edit->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_use_edit->UseDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_UseDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_edit->UseDesc->caption(), $property_use_edit->UseDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_use_edit->RatesLevy->Required) { ?>
				elm = this.getElements("x" + infix + "_RatesLevy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_edit->RatesLevy->caption(), $property_use_edit->RatesLevy->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RatesLevy");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_use_edit->RatesLevy->errorMessage()) ?>");
			<?php if ($property_use_edit->DFactor->Required) { ?>
				elm = this.getElements("x" + infix + "_DFactor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_use_edit->DFactor->caption(), $property_use_edit->DFactor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DFactor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_use_edit->DFactor->errorMessage()) ?>");

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
	fproperty_useedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_useedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_useedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_use_edit->showPageHeader(); ?>
<?php
$property_use_edit->showMessage();
?>
<?php if (!$property_use_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_use_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproperty_useedit" id="fproperty_useedit" class="<?php echo $property_use_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_use">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$property_use_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_use_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_use_PropertyUse" for="x_PropertyUse" class="<?php echo $property_use_edit->LeftColumnClass ?>"><?php echo $property_use_edit->PropertyUse->caption() ?><?php echo $property_use_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_edit->RightColumnClass ?>"><div <?php echo $property_use_edit->PropertyUse->cellAttributes() ?>>
<input type="text" data-table="property_use" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($property_use_edit->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_use_edit->PropertyUse->EditValue ?>"<?php echo $property_use_edit->PropertyUse->editAttributes() ?>>
<input type="hidden" data-table="property_use" data-field="x_PropertyUse" name="o_PropertyUse" id="o_PropertyUse" value="<?php echo HtmlEncode($property_use_edit->PropertyUse->OldValue != null ? $property_use_edit->PropertyUse->OldValue : $property_use_edit->PropertyUse->CurrentValue) ?>">
<?php echo $property_use_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_use_edit->UseDesc->Visible) { // UseDesc ?>
	<div id="r_UseDesc" class="form-group row">
		<label id="elh_property_use_UseDesc" for="x_UseDesc" class="<?php echo $property_use_edit->LeftColumnClass ?>"><?php echo $property_use_edit->UseDesc->caption() ?><?php echo $property_use_edit->UseDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_edit->RightColumnClass ?>"><div <?php echo $property_use_edit->UseDesc->cellAttributes() ?>>
<span id="el_property_use_UseDesc">
<input type="text" data-table="property_use" data-field="x_UseDesc" name="x_UseDesc" id="x_UseDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_use_edit->UseDesc->getPlaceHolder()) ?>" value="<?php echo $property_use_edit->UseDesc->EditValue ?>"<?php echo $property_use_edit->UseDesc->editAttributes() ?>>
</span>
<?php echo $property_use_edit->UseDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_use_edit->RatesLevy->Visible) { // RatesLevy ?>
	<div id="r_RatesLevy" class="form-group row">
		<label id="elh_property_use_RatesLevy" for="x_RatesLevy" class="<?php echo $property_use_edit->LeftColumnClass ?>"><?php echo $property_use_edit->RatesLevy->caption() ?><?php echo $property_use_edit->RatesLevy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_edit->RightColumnClass ?>"><div <?php echo $property_use_edit->RatesLevy->cellAttributes() ?>>
<span id="el_property_use_RatesLevy">
<input type="text" data-table="property_use" data-field="x_RatesLevy" name="x_RatesLevy" id="x_RatesLevy" size="30" placeholder="<?php echo HtmlEncode($property_use_edit->RatesLevy->getPlaceHolder()) ?>" value="<?php echo $property_use_edit->RatesLevy->EditValue ?>"<?php echo $property_use_edit->RatesLevy->editAttributes() ?>>
</span>
<?php echo $property_use_edit->RatesLevy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_use_edit->DFactor->Visible) { // DFactor ?>
	<div id="r_DFactor" class="form-group row">
		<label id="elh_property_use_DFactor" for="x_DFactor" class="<?php echo $property_use_edit->LeftColumnClass ?>"><?php echo $property_use_edit->DFactor->caption() ?><?php echo $property_use_edit->DFactor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_use_edit->RightColumnClass ?>"><div <?php echo $property_use_edit->DFactor->cellAttributes() ?>>
<span id="el_property_use_DFactor">
<input type="text" data-table="property_use" data-field="x_DFactor" name="x_DFactor" id="x_DFactor" size="30" placeholder="<?php echo HtmlEncode($property_use_edit->DFactor->getPlaceHolder()) ?>" value="<?php echo $property_use_edit->DFactor->EditValue ?>"<?php echo $property_use_edit->DFactor->editAttributes() ?>>
</span>
<?php echo $property_use_edit->DFactor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_use_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_use_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_use_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_use_edit->IsModal) { ?>
<?php echo $property_use_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$property_use_edit->showPageFooter();
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
$property_use_edit->terminate();
?>