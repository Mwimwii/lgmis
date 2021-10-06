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
$property_group_edit = new property_group_edit();

// Run the page
$property_group_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_group_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_groupedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproperty_groupedit = currentForm = new ew.Form("fproperty_groupedit", "edit");

	// Validate form
	fproperty_groupedit.validate = function() {
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
			<?php if ($property_group_edit->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_group_edit->PropertyGroup->caption(), $property_group_edit->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_group_edit->PropertyGroupDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroupDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_group_edit->PropertyGroupDesc->caption(), $property_group_edit->PropertyGroupDesc->RequiredErrorMessage)) ?>");
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
	fproperty_groupedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_groupedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_groupedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_group_edit->showPageHeader(); ?>
<?php
$property_group_edit->showMessage();
?>
<?php if (!$property_group_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_group_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproperty_groupedit" id="fproperty_groupedit" class="<?php echo $property_group_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_group">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$property_group_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_group_edit->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label id="elh_property_group_PropertyGroup" class="<?php echo $property_group_edit->LeftColumnClass ?>"><?php echo $property_group_edit->PropertyGroup->caption() ?><?php echo $property_group_edit->PropertyGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_group_edit->RightColumnClass ?>"><div <?php echo $property_group_edit->PropertyGroup->cellAttributes() ?>>
<span id="el_property_group_PropertyGroup">
<span<?php echo $property_group_edit->PropertyGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_group_edit->PropertyGroup->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_group" data-field="x_PropertyGroup" name="x_PropertyGroup" id="x_PropertyGroup" value="<?php echo HtmlEncode($property_group_edit->PropertyGroup->CurrentValue) ?>">
<?php echo $property_group_edit->PropertyGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_group_edit->PropertyGroupDesc->Visible) { // PropertyGroupDesc ?>
	<div id="r_PropertyGroupDesc" class="form-group row">
		<label id="elh_property_group_PropertyGroupDesc" for="x_PropertyGroupDesc" class="<?php echo $property_group_edit->LeftColumnClass ?>"><?php echo $property_group_edit->PropertyGroupDesc->caption() ?><?php echo $property_group_edit->PropertyGroupDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_group_edit->RightColumnClass ?>"><div <?php echo $property_group_edit->PropertyGroupDesc->cellAttributes() ?>>
<span id="el_property_group_PropertyGroupDesc">
<input type="text" data-table="property_group" data-field="x_PropertyGroupDesc" name="x_PropertyGroupDesc" id="x_PropertyGroupDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_group_edit->PropertyGroupDesc->getPlaceHolder()) ?>" value="<?php echo $property_group_edit->PropertyGroupDesc->EditValue ?>"<?php echo $property_group_edit->PropertyGroupDesc->editAttributes() ?>>
</span>
<?php echo $property_group_edit->PropertyGroupDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_group_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_group_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_group_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_group_edit->IsModal) { ?>
<?php echo $property_group_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$property_group_edit->showPageFooter();
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
$property_group_edit->terminate();
?>