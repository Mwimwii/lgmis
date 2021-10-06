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
$property_group_add = new property_group_add();

// Run the page
$property_group_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_group_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_groupadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproperty_groupadd = currentForm = new ew.Form("fproperty_groupadd", "add");

	// Validate form
	fproperty_groupadd.validate = function() {
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
			<?php if ($property_group_add->PropertyGroupDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroupDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_group_add->PropertyGroupDesc->caption(), $property_group_add->PropertyGroupDesc->RequiredErrorMessage)) ?>");
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
	fproperty_groupadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_groupadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_groupadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_group_add->showPageHeader(); ?>
<?php
$property_group_add->showMessage();
?>
<form name="fproperty_groupadd" id="fproperty_groupadd" class="<?php echo $property_group_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_group">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$property_group_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($property_group_add->PropertyGroupDesc->Visible) { // PropertyGroupDesc ?>
	<div id="r_PropertyGroupDesc" class="form-group row">
		<label id="elh_property_group_PropertyGroupDesc" for="x_PropertyGroupDesc" class="<?php echo $property_group_add->LeftColumnClass ?>"><?php echo $property_group_add->PropertyGroupDesc->caption() ?><?php echo $property_group_add->PropertyGroupDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_group_add->RightColumnClass ?>"><div <?php echo $property_group_add->PropertyGroupDesc->cellAttributes() ?>>
<span id="el_property_group_PropertyGroupDesc">
<input type="text" data-table="property_group" data-field="x_PropertyGroupDesc" name="x_PropertyGroupDesc" id="x_PropertyGroupDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_group_add->PropertyGroupDesc->getPlaceHolder()) ?>" value="<?php echo $property_group_add->PropertyGroupDesc->EditValue ?>"<?php echo $property_group_add->PropertyGroupDesc->editAttributes() ?>>
</span>
<?php echo $property_group_add->PropertyGroupDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_group_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_group_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_group_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_group_add->showPageFooter();
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
$property_group_add->terminate();
?>