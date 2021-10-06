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
$equipment_type_add = new equipment_type_add();

// Run the page
$equipment_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$equipment_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fequipment_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fequipment_typeadd = currentForm = new ew.Form("fequipment_typeadd", "add");

	// Validate form
	fequipment_typeadd.validate = function() {
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
			<?php if ($equipment_type_add->EquipmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_EquipmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $equipment_type_add->EquipmentName->caption(), $equipment_type_add->EquipmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($equipment_type_add->EquipmentDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_EquipmentDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $equipment_type_add->EquipmentDesc->caption(), $equipment_type_add->EquipmentDesc->RequiredErrorMessage)) ?>");
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
	fequipment_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fequipment_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fequipment_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $equipment_type_add->showPageHeader(); ?>
<?php
$equipment_type_add->showMessage();
?>
<form name="fequipment_typeadd" id="fequipment_typeadd" class="<?php echo $equipment_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="equipment_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$equipment_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($equipment_type_add->EquipmentName->Visible) { // EquipmentName ?>
	<div id="r_EquipmentName" class="form-group row">
		<label id="elh_equipment_type_EquipmentName" for="x_EquipmentName" class="<?php echo $equipment_type_add->LeftColumnClass ?>"><?php echo $equipment_type_add->EquipmentName->caption() ?><?php echo $equipment_type_add->EquipmentName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $equipment_type_add->RightColumnClass ?>"><div <?php echo $equipment_type_add->EquipmentName->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentName">
<input type="text" data-table="equipment_type" data-field="x_EquipmentName" name="x_EquipmentName" id="x_EquipmentName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($equipment_type_add->EquipmentName->getPlaceHolder()) ?>" value="<?php echo $equipment_type_add->EquipmentName->EditValue ?>"<?php echo $equipment_type_add->EquipmentName->editAttributes() ?>>
</span>
<?php echo $equipment_type_add->EquipmentName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($equipment_type_add->EquipmentDesc->Visible) { // EquipmentDesc ?>
	<div id="r_EquipmentDesc" class="form-group row">
		<label id="elh_equipment_type_EquipmentDesc" for="x_EquipmentDesc" class="<?php echo $equipment_type_add->LeftColumnClass ?>"><?php echo $equipment_type_add->EquipmentDesc->caption() ?><?php echo $equipment_type_add->EquipmentDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $equipment_type_add->RightColumnClass ?>"><div <?php echo $equipment_type_add->EquipmentDesc->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentDesc">
<input type="text" data-table="equipment_type" data-field="x_EquipmentDesc" name="x_EquipmentDesc" id="x_EquipmentDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($equipment_type_add->EquipmentDesc->getPlaceHolder()) ?>" value="<?php echo $equipment_type_add->EquipmentDesc->EditValue ?>"<?php echo $equipment_type_add->EquipmentDesc->editAttributes() ?>>
</span>
<?php echo $equipment_type_add->EquipmentDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$equipment_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $equipment_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $equipment_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$equipment_type_add->showPageFooter();
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
$equipment_type_add->terminate();
?>