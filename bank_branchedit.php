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
$bank_branch_edit = new bank_branch_edit();

// Run the page
$bank_branch_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_branch_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbank_branchedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbank_branchedit = currentForm = new ew.Form("fbank_branchedit", "edit");

	// Validate form
	fbank_branchedit.validate = function() {
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
			<?php if ($bank_branch_edit->BranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BranchCode->caption(), $bank_branch_edit->BranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->BranchName->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BranchName->caption(), $bank_branch_edit->BranchName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BankCode->caption(), $bank_branch_edit->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->AreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->AreaCode->caption(), $bank_branch_edit->AreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->BranchNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BranchNo->caption(), $bank_branch_edit->BranchNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->BranchAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BranchAddress->caption(), $bank_branch_edit->BranchAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->BranchTel->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchTel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BranchTel->caption(), $bank_branch_edit->BranchTel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->BranchEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BranchEmail->caption(), $bank_branch_edit->BranchEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->BranchFax->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchFax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->BranchFax->caption(), $bank_branch_edit->BranchFax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->SWIFT->Required) { ?>
				elm = this.getElements("x" + infix + "_SWIFT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->SWIFT->caption(), $bank_branch_edit->SWIFT->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_edit->IBAN->Required) { ?>
				elm = this.getElements("x" + infix + "_IBAN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_edit->IBAN->caption(), $bank_branch_edit->IBAN->RequiredErrorMessage)) ?>");
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
	fbank_branchedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbank_branchedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbank_branchedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bank_branch_edit->showPageHeader(); ?>
<?php
$bank_branch_edit->showMessage();
?>
<?php if (!$bank_branch_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bank_branch_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbank_branchedit" id="fbank_branchedit" class="<?php echo $bank_branch_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank_branch">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$bank_branch_edit->IsModal ?>">
<?php if ($bank_branch->getCurrentMasterTable() == "bank") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="bank">
<input type="hidden" name="fk_BankCode" value="<?php echo HtmlEncode($bank_branch_edit->BankCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($bank_branch_edit->BranchCode->Visible) { // BranchCode ?>
	<div id="r_BranchCode" class="form-group row">
		<label id="elh_bank_branch_BranchCode" for="x_BranchCode" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BranchCode->caption() ?><?php echo $bank_branch_edit->BranchCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BranchCode->cellAttributes() ?>>
<input type="text" data-table="bank_branch" data-field="x_BranchCode" name="x_BranchCode" id="x_BranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($bank_branch_edit->BranchCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BranchCode->EditValue ?>"<?php echo $bank_branch_edit->BranchCode->editAttributes() ?>>
<input type="hidden" data-table="bank_branch" data-field="x_BranchCode" name="o_BranchCode" id="o_BranchCode" value="<?php echo HtmlEncode($bank_branch_edit->BranchCode->OldValue != null ? $bank_branch_edit->BranchCode->OldValue : $bank_branch_edit->BranchCode->CurrentValue) ?>">
<?php echo $bank_branch_edit->BranchCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->BranchName->Visible) { // BranchName ?>
	<div id="r_BranchName" class="form-group row">
		<label id="elh_bank_branch_BranchName" for="x_BranchName" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BranchName->caption() ?><?php echo $bank_branch_edit->BranchName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BranchName->cellAttributes() ?>>
<span id="el_bank_branch_BranchName">
<input type="text" data-table="bank_branch" data-field="x_BranchName" name="x_BranchName" id="x_BranchName" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($bank_branch_edit->BranchName->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BranchName->EditValue ?>"<?php echo $bank_branch_edit->BranchName->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->BranchName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label id="elh_bank_branch_BankCode" for="x_BankCode" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BankCode->caption() ?><?php echo $bank_branch_edit->BankCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BankCode->cellAttributes() ?>>
<?php if ($bank_branch_edit->BankCode->getSessionValue() != "") { ?>
<span id="el_bank_branch_BankCode">
<span<?php echo $bank_branch_edit->BankCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_edit->BankCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BankCode" name="x_BankCode" value="<?php echo HtmlEncode($bank_branch_edit->BankCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bank_branch_BankCode">
<input type="text" data-table="bank_branch" data-field="x_BankCode" name="x_BankCode" id="x_BankCode" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_edit->BankCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BankCode->EditValue ?>"<?php echo $bank_branch_edit->BankCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $bank_branch_edit->BankCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->AreaCode->Visible) { // AreaCode ?>
	<div id="r_AreaCode" class="form-group row">
		<label id="elh_bank_branch_AreaCode" for="x_AreaCode" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->AreaCode->caption() ?><?php echo $bank_branch_edit->AreaCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->AreaCode->cellAttributes() ?>>
<span id="el_bank_branch_AreaCode">
<input type="text" data-table="bank_branch" data-field="x_AreaCode" name="x_AreaCode" id="x_AreaCode" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($bank_branch_edit->AreaCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->AreaCode->EditValue ?>"<?php echo $bank_branch_edit->AreaCode->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->AreaCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->BranchNo->Visible) { // BranchNo ?>
	<div id="r_BranchNo" class="form-group row">
		<label id="elh_bank_branch_BranchNo" for="x_BranchNo" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BranchNo->caption() ?><?php echo $bank_branch_edit->BranchNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BranchNo->cellAttributes() ?>>
<span id="el_bank_branch_BranchNo">
<input type="text" data-table="bank_branch" data-field="x_BranchNo" name="x_BranchNo" id="x_BranchNo" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_edit->BranchNo->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BranchNo->EditValue ?>"<?php echo $bank_branch_edit->BranchNo->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->BranchNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->BranchAddress->Visible) { // BranchAddress ?>
	<div id="r_BranchAddress" class="form-group row">
		<label id="elh_bank_branch_BranchAddress" for="x_BranchAddress" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BranchAddress->caption() ?><?php echo $bank_branch_edit->BranchAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BranchAddress->cellAttributes() ?>>
<span id="el_bank_branch_BranchAddress">
<input type="text" data-table="bank_branch" data-field="x_BranchAddress" name="x_BranchAddress" id="x_BranchAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bank_branch_edit->BranchAddress->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BranchAddress->EditValue ?>"<?php echo $bank_branch_edit->BranchAddress->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->BranchAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->BranchTel->Visible) { // BranchTel ?>
	<div id="r_BranchTel" class="form-group row">
		<label id="elh_bank_branch_BranchTel" for="x_BranchTel" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BranchTel->caption() ?><?php echo $bank_branch_edit->BranchTel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BranchTel->cellAttributes() ?>>
<span id="el_bank_branch_BranchTel">
<input type="text" data-table="bank_branch" data-field="x_BranchTel" name="x_BranchTel" id="x_BranchTel" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_edit->BranchTel->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BranchTel->EditValue ?>"<?php echo $bank_branch_edit->BranchTel->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->BranchTel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->BranchEmail->Visible) { // BranchEmail ?>
	<div id="r_BranchEmail" class="form-group row">
		<label id="elh_bank_branch_BranchEmail" for="x_BranchEmail" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BranchEmail->caption() ?><?php echo $bank_branch_edit->BranchEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BranchEmail->cellAttributes() ?>>
<span id="el_bank_branch_BranchEmail">
<input type="text" data-table="bank_branch" data-field="x_BranchEmail" name="x_BranchEmail" id="x_BranchEmail" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_edit->BranchEmail->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BranchEmail->EditValue ?>"<?php echo $bank_branch_edit->BranchEmail->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->BranchEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->BranchFax->Visible) { // BranchFax ?>
	<div id="r_BranchFax" class="form-group row">
		<label id="elh_bank_branch_BranchFax" for="x_BranchFax" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->BranchFax->caption() ?><?php echo $bank_branch_edit->BranchFax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->BranchFax->cellAttributes() ?>>
<span id="el_bank_branch_BranchFax">
<input type="text" data-table="bank_branch" data-field="x_BranchFax" name="x_BranchFax" id="x_BranchFax" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_edit->BranchFax->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->BranchFax->EditValue ?>"<?php echo $bank_branch_edit->BranchFax->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->BranchFax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->SWIFT->Visible) { // SWIFT ?>
	<div id="r_SWIFT" class="form-group row">
		<label id="elh_bank_branch_SWIFT" for="x_SWIFT" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->SWIFT->caption() ?><?php echo $bank_branch_edit->SWIFT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->SWIFT->cellAttributes() ?>>
<span id="el_bank_branch_SWIFT">
<input type="text" data-table="bank_branch" data-field="x_SWIFT" name="x_SWIFT" id="x_SWIFT" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_edit->SWIFT->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->SWIFT->EditValue ?>"<?php echo $bank_branch_edit->SWIFT->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->SWIFT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_edit->IBAN->Visible) { // IBAN ?>
	<div id="r_IBAN" class="form-group row">
		<label id="elh_bank_branch_IBAN" for="x_IBAN" class="<?php echo $bank_branch_edit->LeftColumnClass ?>"><?php echo $bank_branch_edit->IBAN->caption() ?><?php echo $bank_branch_edit->IBAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_edit->RightColumnClass ?>"><div <?php echo $bank_branch_edit->IBAN->cellAttributes() ?>>
<span id="el_bank_branch_IBAN">
<input type="text" data-table="bank_branch" data-field="x_IBAN" name="x_IBAN" id="x_IBAN" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_edit->IBAN->getPlaceHolder()) ?>" value="<?php echo $bank_branch_edit->IBAN->EditValue ?>"<?php echo $bank_branch_edit->IBAN->editAttributes() ?>>
</span>
<?php echo $bank_branch_edit->IBAN->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bank_branch_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bank_branch_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bank_branch_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$bank_branch_edit->IsModal) { ?>
<?php echo $bank_branch_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$bank_branch_edit->showPageFooter();
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
$bank_branch_edit->terminate();
?>