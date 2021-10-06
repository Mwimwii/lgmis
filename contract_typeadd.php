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
$contract_type_add = new contract_type_add();

// Run the page
$contract_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcontract_typeadd = currentForm = new ew.Form("fcontract_typeadd", "add");

	// Validate form
	fcontract_typeadd.validate = function() {
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
			<?php if ($contract_type_add->ContractType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_type_add->ContractType->caption(), $contract_type_add->ContractType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_type_add->ContractType->errorMessage()) ?>");
			<?php if ($contract_type_add->ContractTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_type_add->ContractTypeDesc->caption(), $contract_type_add->ContractTypeDesc->RequiredErrorMessage)) ?>");
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
	fcontract_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcontract_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_type_add->showPageHeader(); ?>
<?php
$contract_type_add->showMessage();
?>
<form name="fcontract_typeadd" id="fcontract_typeadd" class="<?php echo $contract_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contract_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contract_type_add->ContractType->Visible) { // ContractType ?>
	<div id="r_ContractType" class="form-group row">
		<label id="elh_contract_type_ContractType" for="x_ContractType" class="<?php echo $contract_type_add->LeftColumnClass ?>"><?php echo $contract_type_add->ContractType->caption() ?><?php echo $contract_type_add->ContractType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_type_add->RightColumnClass ?>"><div <?php echo $contract_type_add->ContractType->cellAttributes() ?>>
<span id="el_contract_type_ContractType">
<input type="text" data-table="contract_type" data-field="x_ContractType" name="x_ContractType" id="x_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_type_add->ContractType->getPlaceHolder()) ?>" value="<?php echo $contract_type_add->ContractType->EditValue ?>"<?php echo $contract_type_add->ContractType->editAttributes() ?>>
</span>
<?php echo $contract_type_add->ContractType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_type_add->ContractTypeDesc->Visible) { // ContractTypeDesc ?>
	<div id="r_ContractTypeDesc" class="form-group row">
		<label id="elh_contract_type_ContractTypeDesc" for="x_ContractTypeDesc" class="<?php echo $contract_type_add->LeftColumnClass ?>"><?php echo $contract_type_add->ContractTypeDesc->caption() ?><?php echo $contract_type_add->ContractTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_type_add->RightColumnClass ?>"><div <?php echo $contract_type_add->ContractTypeDesc->cellAttributes() ?>>
<span id="el_contract_type_ContractTypeDesc">
<input type="text" data-table="contract_type" data-field="x_ContractTypeDesc" name="x_ContractTypeDesc" id="x_ContractTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_type_add->ContractTypeDesc->getPlaceHolder()) ?>" value="<?php echo $contract_type_add->ContractTypeDesc->EditValue ?>"<?php echo $contract_type_add->ContractTypeDesc->editAttributes() ?>>
</span>
<?php echo $contract_type_add->ContractTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contract_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contract_type_add->showPageFooter();
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
$contract_type_add->terminate();
?>