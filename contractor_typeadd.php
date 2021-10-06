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
$contractor_type_add = new contractor_type_add();

// Run the page
$contractor_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontractor_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcontractor_typeadd = currentForm = new ew.Form("fcontractor_typeadd", "add");

	// Validate form
	fcontractor_typeadd.validate = function() {
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
			<?php if ($contractor_type_add->ContractortypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractortypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_type_add->ContractortypeName->caption(), $contractor_type_add->ContractortypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($contractor_type_add->ContractorTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractorTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contractor_type_add->ContractorTypeDesc->caption(), $contractor_type_add->ContractorTypeDesc->RequiredErrorMessage)) ?>");
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
	fcontractor_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontractor_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcontractor_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contractor_type_add->showPageHeader(); ?>
<?php
$contractor_type_add->showMessage();
?>
<form name="fcontractor_typeadd" id="fcontractor_typeadd" class="<?php echo $contractor_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contractor_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contractor_type_add->ContractortypeName->Visible) { // ContractortypeName ?>
	<div id="r_ContractortypeName" class="form-group row">
		<label id="elh_contractor_type_ContractortypeName" for="x_ContractortypeName" class="<?php echo $contractor_type_add->LeftColumnClass ?>"><?php echo $contractor_type_add->ContractortypeName->caption() ?><?php echo $contractor_type_add->ContractortypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_type_add->RightColumnClass ?>"><div <?php echo $contractor_type_add->ContractortypeName->cellAttributes() ?>>
<span id="el_contractor_type_ContractortypeName">
<input type="text" data-table="contractor_type" data-field="x_ContractortypeName" name="x_ContractortypeName" id="x_ContractortypeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_type_add->ContractortypeName->getPlaceHolder()) ?>" value="<?php echo $contractor_type_add->ContractortypeName->EditValue ?>"<?php echo $contractor_type_add->ContractortypeName->editAttributes() ?>>
</span>
<?php echo $contractor_type_add->ContractortypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contractor_type_add->ContractorTypeDesc->Visible) { // ContractorTypeDesc ?>
	<div id="r_ContractorTypeDesc" class="form-group row">
		<label id="elh_contractor_type_ContractorTypeDesc" for="x_ContractorTypeDesc" class="<?php echo $contractor_type_add->LeftColumnClass ?>"><?php echo $contractor_type_add->ContractorTypeDesc->caption() ?><?php echo $contractor_type_add->ContractorTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contractor_type_add->RightColumnClass ?>"><div <?php echo $contractor_type_add->ContractorTypeDesc->cellAttributes() ?>>
<span id="el_contractor_type_ContractorTypeDesc">
<input type="text" data-table="contractor_type" data-field="x_ContractorTypeDesc" name="x_ContractorTypeDesc" id="x_ContractorTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contractor_type_add->ContractorTypeDesc->getPlaceHolder()) ?>" value="<?php echo $contractor_type_add->ContractorTypeDesc->EditValue ?>"<?php echo $contractor_type_add->ContractorTypeDesc->editAttributes() ?>>
</span>
<?php echo $contractor_type_add->ContractorTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contractor_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contractor_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contractor_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contractor_type_add->showPageFooter();
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
$contractor_type_add->terminate();
?>