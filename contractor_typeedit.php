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
$contractor_type_edit = new contractor_type_edit();

// Run the page
$contractor_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractor_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcontractor_typeedit = currentForm = new ew.Form("fcontractor_typeedit", "edit");

	// Validate form
	fcontractor_typeedit.validate = function() {
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
			<?php if ($contractor_type_edit->ContractorTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_type_edit->ContractorTypeCode->caption(), $contractor_type_edit->ContractorTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_type_edit->ContractortypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractortypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_type_edit->ContractortypeName->caption(), $contractor_type_edit->ContractortypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_type_edit->ContractorTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_type_edit->ContractorTypeDesc->caption(), $contractor_type_edit->ContractorTypeDesc->RequiredErrorMessage)) ?>");
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
	fcontractor_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractor_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcontractor_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contractor_type_edit->showPageHeader(); ?>
<?php
$contractor_type_edit->showMessage();
?>
<?php if (!$contractor_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcontractor_typeedit" id="fcontractor_typeedit" class="<?php echo $contractor_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$contractor_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($contractor_type_edit->ContractorTypeCode->Visible) { // ContractorTypeCode ?>
	<div id="r_ContractorTypeCode" class="form-group row">
		<label id="elh_contractor_type_ContractorTypeCode" class="<?php echo $contractor_type_edit->LeftColumnClass ?>"><?php echo $contractor_type_edit->ContractorTypeCode->caption() ?><?php echo $contractor_type_edit->ContractorTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_type_edit->RightColumnClass ?>"><div <?php echo $contractor_type_edit->ContractorTypeCode->cellAttributes() ?>>
<span id="el_contractor_type_ContractorTypeCode">
<span<?php echo $contractor_type_edit->ContractorTypeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($contractor_type_edit->ContractorTypeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="contractor_type" data-field="x_ContractorTypeCode" name="x_ContractorTypeCode" id="x_ContractorTypeCode" value="<?php echo HtmlEncode($contractor_type_edit->ContractorTypeCode->CurrentValue) ?>">
<?php echo $contractor_type_edit->ContractorTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_type_edit->ContractortypeName->Visible) { // ContractortypeName ?>
	<div id="r_ContractortypeName" class="form-group row">
		<label id="elh_contractor_type_ContractortypeName" for="x_ContractortypeName" class="<?php echo $contractor_type_edit->LeftColumnClass ?>"><?php echo $contractor_type_edit->ContractortypeName->caption() ?><?php echo $contractor_type_edit->ContractortypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_type_edit->RightColumnClass ?>"><div <?php echo $contractor_type_edit->ContractortypeName->cellAttributes() ?>>
<span id="el_contractor_type_ContractortypeName">
<input type="text" data-table="contractor_type" data-field="x_ContractortypeName" name="x_ContractortypeName" id="x_ContractortypeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_type_edit->ContractortypeName->getPlaceHolder()) ?>" value="<?php echo $contractor_type_edit->ContractortypeName->EditValue ?>"<?php echo $contractor_type_edit->ContractortypeName->editAttributes() ?>>
</span>
<?php echo $contractor_type_edit->ContractortypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_type_edit->ContractorTypeDesc->Visible) { // ContractorTypeDesc ?>
	<div id="r_ContractorTypeDesc" class="form-group row">
		<label id="elh_contractor_type_ContractorTypeDesc" for="x_ContractorTypeDesc" class="<?php echo $contractor_type_edit->LeftColumnClass ?>"><?php echo $contractor_type_edit->ContractorTypeDesc->caption() ?><?php echo $contractor_type_edit->ContractorTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_type_edit->RightColumnClass ?>"><div <?php echo $contractor_type_edit->ContractorTypeDesc->cellAttributes() ?>>
<span id="el_contractor_type_ContractorTypeDesc">
<input type="text" data-table="contractor_type" data-field="x_ContractorTypeDesc" name="x_ContractorTypeDesc" id="x_ContractorTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_type_edit->ContractorTypeDesc->getPlaceHolder()) ?>" value="<?php echo $contractor_type_edit->ContractorTypeDesc->EditValue ?>"<?php echo $contractor_type_edit->ContractorTypeDesc->editAttributes() ?>>
</span>
<?php echo $contractor_type_edit->ContractorTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contractor_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contractor_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contractor_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$contractor_type_edit->IsModal) { ?>
<?php echo $contractor_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$contractor_type_edit->showPageFooter();
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
$contractor_type_edit->terminate();
?>