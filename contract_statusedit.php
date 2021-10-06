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
$contract_status_edit = new contract_status_edit();

// Run the page
$contract_status_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_status_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcontract_statusedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcontract_statusedit = currentForm = new ew.Form("fcontract_statusedit", "edit");

	// Validate form
	fcontract_statusedit.validate = function() {
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
			<?php if ($contract_status_edit->ContractStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_status_edit->ContractStatus->caption(), $contract_status_edit->ContractStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_status_edit->ContractStatus->errorMessage()) ?>");
			<?php if ($contract_status_edit->ContractStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_status_edit->ContractStatusDesc->caption(), $contract_status_edit->ContractStatusDesc->RequiredErrorMessage)) ?>");
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
	fcontract_statusedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_statusedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcontract_statusedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $contract_status_edit->showPageHeader(); ?>
<?php
$contract_status_edit->showMessage();
?>
<?php if (!$contract_status_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_status_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcontract_statusedit" id="fcontract_statusedit" class="<?php echo $contract_status_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_status">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$contract_status_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($contract_status_edit->ContractStatus->Visible) { // ContractStatus ?>
	<div id="r_ContractStatus" class="form-group row">
		<label id="elh_contract_status_ContractStatus" for="x_ContractStatus" class="<?php echo $contract_status_edit->LeftColumnClass ?>"><?php echo $contract_status_edit->ContractStatus->caption() ?><?php echo $contract_status_edit->ContractStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_status_edit->RightColumnClass ?>"><div <?php echo $contract_status_edit->ContractStatus->cellAttributes() ?>>
<input type="text" data-table="contract_status" data-field="x_ContractStatus" name="x_ContractStatus" id="x_ContractStatus" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_status_edit->ContractStatus->getPlaceHolder()) ?>" value="<?php echo $contract_status_edit->ContractStatus->EditValue ?>"<?php echo $contract_status_edit->ContractStatus->editAttributes() ?>>
<input type="hidden" data-table="contract_status" data-field="x_ContractStatus" name="o_ContractStatus" id="o_ContractStatus" value="<?php echo HtmlEncode($contract_status_edit->ContractStatus->OldValue != null ? $contract_status_edit->ContractStatus->OldValue : $contract_status_edit->ContractStatus->CurrentValue) ?>">
<?php echo $contract_status_edit->ContractStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contract_status_edit->ContractStatusDesc->Visible) { // ContractStatusDesc ?>
	<div id="r_ContractStatusDesc" class="form-group row">
		<label id="elh_contract_status_ContractStatusDesc" for="x_ContractStatusDesc" class="<?php echo $contract_status_edit->LeftColumnClass ?>"><?php echo $contract_status_edit->ContractStatusDesc->caption() ?><?php echo $contract_status_edit->ContractStatusDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contract_status_edit->RightColumnClass ?>"><div <?php echo $contract_status_edit->ContractStatusDesc->cellAttributes() ?>>
<span id="el_contract_status_ContractStatusDesc">
<input type="text" data-table="contract_status" data-field="x_ContractStatusDesc" name="x_ContractStatusDesc" id="x_ContractStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_status_edit->ContractStatusDesc->getPlaceHolder()) ?>" value="<?php echo $contract_status_edit->ContractStatusDesc->EditValue ?>"<?php echo $contract_status_edit->ContractStatusDesc->editAttributes() ?>>
</span>
<?php echo $contract_status_edit->ContractStatusDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contract_status_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contract_status_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contract_status_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$contract_status_edit->IsModal) { ?>
<?php echo $contract_status_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$contract_status_edit->showPageFooter();
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
$contract_status_edit->terminate();
?>