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
$id_type_edit = new id_type_edit();

// Run the page
$id_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$id_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fid_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fid_typeedit = currentForm = new ew.Form("fid_typeedit", "edit");

	// Validate form
	fid_typeedit.validate = function() {
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
			<?php if ($id_type_edit->IDType->Required) { ?>
				elm = this.getElements("x" + infix + "_IDType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $id_type_edit->IDType->caption(), $id_type_edit->IDType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($id_type_edit->IDTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_IDTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $id_type_edit->IDTypeName->caption(), $id_type_edit->IDTypeName->RequiredErrorMessage)) ?>");
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
	fid_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fid_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fid_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $id_type_edit->showPageHeader(); ?>
<?php
$id_type_edit->showMessage();
?>
<?php if (!$id_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $id_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fid_typeedit" id="fid_typeedit" class="<?php echo $id_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="id_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$id_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($id_type_edit->IDType->Visible) { // IDType ?>
	<div id="r_IDType" class="form-group row">
		<label id="elh_id_type_IDType" class="<?php echo $id_type_edit->LeftColumnClass ?>"><?php echo $id_type_edit->IDType->caption() ?><?php echo $id_type_edit->IDType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $id_type_edit->RightColumnClass ?>"><div <?php echo $id_type_edit->IDType->cellAttributes() ?>>
<span id="el_id_type_IDType">
<span<?php echo $id_type_edit->IDType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($id_type_edit->IDType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="id_type" data-field="x_IDType" name="x_IDType" id="x_IDType" value="<?php echo HtmlEncode($id_type_edit->IDType->CurrentValue) ?>">
<?php echo $id_type_edit->IDType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($id_type_edit->IDTypeName->Visible) { // IDTypeName ?>
	<div id="r_IDTypeName" class="form-group row">
		<label id="elh_id_type_IDTypeName" for="x_IDTypeName" class="<?php echo $id_type_edit->LeftColumnClass ?>"><?php echo $id_type_edit->IDTypeName->caption() ?><?php echo $id_type_edit->IDTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $id_type_edit->RightColumnClass ?>"><div <?php echo $id_type_edit->IDTypeName->cellAttributes() ?>>
<span id="el_id_type_IDTypeName">
<input type="text" data-table="id_type" data-field="x_IDTypeName" name="x_IDTypeName" id="x_IDTypeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($id_type_edit->IDTypeName->getPlaceHolder()) ?>" value="<?php echo $id_type_edit->IDTypeName->EditValue ?>"<?php echo $id_type_edit->IDTypeName->editAttributes() ?>>
</span>
<?php echo $id_type_edit->IDTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$id_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $id_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $id_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$id_type_edit->IsModal) { ?>
<?php echo $id_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$id_type_edit->showPageFooter();
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
$id_type_edit->terminate();
?>