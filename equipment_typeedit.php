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
$equipment_type_edit = new equipment_type_edit();

// Run the page
$equipment_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$equipment_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fequipment_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fequipment_typeedit = currentForm = new ew.Form("fequipment_typeedit", "edit");

	// Validate form
	fequipment_typeedit.validate = function() {
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
			<?php if ($equipment_type_edit->EquipmentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EquipmentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $equipment_type_edit->EquipmentType->caption(), $equipment_type_edit->EquipmentType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($equipment_type_edit->EquipmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_EquipmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $equipment_type_edit->EquipmentName->caption(), $equipment_type_edit->EquipmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($equipment_type_edit->EquipmentDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_EquipmentDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $equipment_type_edit->EquipmentDesc->caption(), $equipment_type_edit->EquipmentDesc->RequiredErrorMessage)) ?>");
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
	fequipment_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fequipment_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fequipment_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $equipment_type_edit->showPageHeader(); ?>
<?php
$equipment_type_edit->showMessage();
?>
<?php if (!$equipment_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $equipment_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fequipment_typeedit" id="fequipment_typeedit" class="<?php echo $equipment_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="equipment_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$equipment_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($equipment_type_edit->EquipmentType->Visible) { // EquipmentType ?>
	<div id="r_EquipmentType" class="form-group row">
		<label id="elh_equipment_type_EquipmentType" class="<?php echo $equipment_type_edit->LeftColumnClass ?>"><?php echo $equipment_type_edit->EquipmentType->caption() ?><?php echo $equipment_type_edit->EquipmentType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $equipment_type_edit->RightColumnClass ?>"><div <?php echo $equipment_type_edit->EquipmentType->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentType">
<span<?php echo $equipment_type_edit->EquipmentType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($equipment_type_edit->EquipmentType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="equipment_type" data-field="x_EquipmentType" name="x_EquipmentType" id="x_EquipmentType" value="<?php echo HtmlEncode($equipment_type_edit->EquipmentType->CurrentValue) ?>">
<?php echo $equipment_type_edit->EquipmentType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($equipment_type_edit->EquipmentName->Visible) { // EquipmentName ?>
	<div id="r_EquipmentName" class="form-group row">
		<label id="elh_equipment_type_EquipmentName" for="x_EquipmentName" class="<?php echo $equipment_type_edit->LeftColumnClass ?>"><?php echo $equipment_type_edit->EquipmentName->caption() ?><?php echo $equipment_type_edit->EquipmentName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $equipment_type_edit->RightColumnClass ?>"><div <?php echo $equipment_type_edit->EquipmentName->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentName">
<input type="text" data-table="equipment_type" data-field="x_EquipmentName" name="x_EquipmentName" id="x_EquipmentName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($equipment_type_edit->EquipmentName->getPlaceHolder()) ?>" value="<?php echo $equipment_type_edit->EquipmentName->EditValue ?>"<?php echo $equipment_type_edit->EquipmentName->editAttributes() ?>>
</span>
<?php echo $equipment_type_edit->EquipmentName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($equipment_type_edit->EquipmentDesc->Visible) { // EquipmentDesc ?>
	<div id="r_EquipmentDesc" class="form-group row">
		<label id="elh_equipment_type_EquipmentDesc" for="x_EquipmentDesc" class="<?php echo $equipment_type_edit->LeftColumnClass ?>"><?php echo $equipment_type_edit->EquipmentDesc->caption() ?><?php echo $equipment_type_edit->EquipmentDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $equipment_type_edit->RightColumnClass ?>"><div <?php echo $equipment_type_edit->EquipmentDesc->cellAttributes() ?>>
<span id="el_equipment_type_EquipmentDesc">
<input type="text" data-table="equipment_type" data-field="x_EquipmentDesc" name="x_EquipmentDesc" id="x_EquipmentDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($equipment_type_edit->EquipmentDesc->getPlaceHolder()) ?>" value="<?php echo $equipment_type_edit->EquipmentDesc->EditValue ?>"<?php echo $equipment_type_edit->EquipmentDesc->editAttributes() ?>>
</span>
<?php echo $equipment_type_edit->EquipmentDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$equipment_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $equipment_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $equipment_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$equipment_type_edit->IsModal) { ?>
<?php echo $equipment_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$equipment_type_edit->showPageFooter();
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
$equipment_type_edit->terminate();
?>