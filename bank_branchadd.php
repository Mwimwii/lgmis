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
$bank_branch_add = new bank_branch_add();

// Run the page
$bank_branch_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_branch_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbank_branchadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbank_branchadd = currentForm = new ew.Form("fbank_branchadd", "add");

	// Validate form
	fbank_branchadd.validate = function() {
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
			<?php if ($bank_branch_add->BranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BranchCode->caption(), $bank_branch_add->BranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->BranchName->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BranchName->caption(), $bank_branch_add->BranchName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BankCode->caption(), $bank_branch_add->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->AreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->AreaCode->caption(), $bank_branch_add->AreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->BranchNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BranchNo->caption(), $bank_branch_add->BranchNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->BranchAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BranchAddress->caption(), $bank_branch_add->BranchAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->BranchTel->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchTel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BranchTel->caption(), $bank_branch_add->BranchTel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->BranchEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BranchEmail->caption(), $bank_branch_add->BranchEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->BranchFax->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchFax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->BranchFax->caption(), $bank_branch_add->BranchFax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->SWIFT->Required) { ?>
				elm = this.getElements("x" + infix + "_SWIFT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->SWIFT->caption(), $bank_branch_add->SWIFT->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_branch_add->IBAN->Required) { ?>
				elm = this.getElements("x" + infix + "_IBAN");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_branch_add->IBAN->caption(), $bank_branch_add->IBAN->RequiredErrorMessage)) ?>");
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
	fbank_branchadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbank_branchadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbank_branchadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bank_branch_add->showPageHeader(); ?>
<?php
$bank_branch_add->showMessage();
?>
<form name="fbank_branchadd" id="fbank_branchadd" class="<?php echo $bank_branch_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank_branch">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$bank_branch_add->IsModal ?>">
<?php if ($bank_branch->getCurrentMasterTable() == "bank") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="bank">
<input type="hidden" name="fk_BankCode" value="<?php echo HtmlEncode($bank_branch_add->BankCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($bank_branch_add->BranchCode->Visible) { // BranchCode ?>
	<div id="r_BranchCode" class="form-group row">
		<label id="elh_bank_branch_BranchCode" for="x_BranchCode" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BranchCode->caption() ?><?php echo $bank_branch_add->BranchCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BranchCode->cellAttributes() ?>>
<span id="el_bank_branch_BranchCode">
<input type="text" data-table="bank_branch" data-field="x_BranchCode" name="x_BranchCode" id="x_BranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($bank_branch_add->BranchCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BranchCode->EditValue ?>"<?php echo $bank_branch_add->BranchCode->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->BranchCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->BranchName->Visible) { // BranchName ?>
	<div id="r_BranchName" class="form-group row">
		<label id="elh_bank_branch_BranchName" for="x_BranchName" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BranchName->caption() ?><?php echo $bank_branch_add->BranchName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BranchName->cellAttributes() ?>>
<span id="el_bank_branch_BranchName">
<input type="text" data-table="bank_branch" data-field="x_BranchName" name="x_BranchName" id="x_BranchName" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($bank_branch_add->BranchName->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BranchName->EditValue ?>"<?php echo $bank_branch_add->BranchName->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->BranchName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label id="elh_bank_branch_BankCode" for="x_BankCode" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BankCode->caption() ?><?php echo $bank_branch_add->BankCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BankCode->cellAttributes() ?>>
<?php if ($bank_branch_add->BankCode->getSessionValue() != "") { ?>
<span id="el_bank_branch_BankCode">
<span<?php echo $bank_branch_add->BankCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bank_branch_add->BankCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BankCode" name="x_BankCode" value="<?php echo HtmlEncode($bank_branch_add->BankCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bank_branch_BankCode">
<input type="text" data-table="bank_branch" data-field="x_BankCode" name="x_BankCode" id="x_BankCode" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_add->BankCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BankCode->EditValue ?>"<?php echo $bank_branch_add->BankCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $bank_branch_add->BankCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->AreaCode->Visible) { // AreaCode ?>
	<div id="r_AreaCode" class="form-group row">
		<label id="elh_bank_branch_AreaCode" for="x_AreaCode" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->AreaCode->caption() ?><?php echo $bank_branch_add->AreaCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->AreaCode->cellAttributes() ?>>
<span id="el_bank_branch_AreaCode">
<input type="text" data-table="bank_branch" data-field="x_AreaCode" name="x_AreaCode" id="x_AreaCode" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($bank_branch_add->AreaCode->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->AreaCode->EditValue ?>"<?php echo $bank_branch_add->AreaCode->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->AreaCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->BranchNo->Visible) { // BranchNo ?>
	<div id="r_BranchNo" class="form-group row">
		<label id="elh_bank_branch_BranchNo" for="x_BranchNo" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BranchNo->caption() ?><?php echo $bank_branch_add->BranchNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BranchNo->cellAttributes() ?>>
<span id="el_bank_branch_BranchNo">
<input type="text" data-table="bank_branch" data-field="x_BranchNo" name="x_BranchNo" id="x_BranchNo" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_branch_add->BranchNo->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BranchNo->EditValue ?>"<?php echo $bank_branch_add->BranchNo->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->BranchNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->BranchAddress->Visible) { // BranchAddress ?>
	<div id="r_BranchAddress" class="form-group row">
		<label id="elh_bank_branch_BranchAddress" for="x_BranchAddress" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BranchAddress->caption() ?><?php echo $bank_branch_add->BranchAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BranchAddress->cellAttributes() ?>>
<span id="el_bank_branch_BranchAddress">
<input type="text" data-table="bank_branch" data-field="x_BranchAddress" name="x_BranchAddress" id="x_BranchAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bank_branch_add->BranchAddress->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BranchAddress->EditValue ?>"<?php echo $bank_branch_add->BranchAddress->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->BranchAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->BranchTel->Visible) { // BranchTel ?>
	<div id="r_BranchTel" class="form-group row">
		<label id="elh_bank_branch_BranchTel" for="x_BranchTel" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BranchTel->caption() ?><?php echo $bank_branch_add->BranchTel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BranchTel->cellAttributes() ?>>
<span id="el_bank_branch_BranchTel">
<input type="text" data-table="bank_branch" data-field="x_BranchTel" name="x_BranchTel" id="x_BranchTel" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_add->BranchTel->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BranchTel->EditValue ?>"<?php echo $bank_branch_add->BranchTel->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->BranchTel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->BranchEmail->Visible) { // BranchEmail ?>
	<div id="r_BranchEmail" class="form-group row">
		<label id="elh_bank_branch_BranchEmail" for="x_BranchEmail" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BranchEmail->caption() ?><?php echo $bank_branch_add->BranchEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BranchEmail->cellAttributes() ?>>
<span id="el_bank_branch_BranchEmail">
<input type="text" data-table="bank_branch" data-field="x_BranchEmail" name="x_BranchEmail" id="x_BranchEmail" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_add->BranchEmail->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BranchEmail->EditValue ?>"<?php echo $bank_branch_add->BranchEmail->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->BranchEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->BranchFax->Visible) { // BranchFax ?>
	<div id="r_BranchFax" class="form-group row">
		<label id="elh_bank_branch_BranchFax" for="x_BranchFax" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->BranchFax->caption() ?><?php echo $bank_branch_add->BranchFax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->BranchFax->cellAttributes() ?>>
<span id="el_bank_branch_BranchFax">
<input type="text" data-table="bank_branch" data-field="x_BranchFax" name="x_BranchFax" id="x_BranchFax" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_add->BranchFax->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->BranchFax->EditValue ?>"<?php echo $bank_branch_add->BranchFax->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->BranchFax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->SWIFT->Visible) { // SWIFT ?>
	<div id="r_SWIFT" class="form-group row">
		<label id="elh_bank_branch_SWIFT" for="x_SWIFT" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->SWIFT->caption() ?><?php echo $bank_branch_add->SWIFT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->SWIFT->cellAttributes() ?>>
<span id="el_bank_branch_SWIFT">
<input type="text" data-table="bank_branch" data-field="x_SWIFT" name="x_SWIFT" id="x_SWIFT" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_add->SWIFT->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->SWIFT->EditValue ?>"<?php echo $bank_branch_add->SWIFT->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->SWIFT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_branch_add->IBAN->Visible) { // IBAN ?>
	<div id="r_IBAN" class="form-group row">
		<label id="elh_bank_branch_IBAN" for="x_IBAN" class="<?php echo $bank_branch_add->LeftColumnClass ?>"><?php echo $bank_branch_add->IBAN->caption() ?><?php echo $bank_branch_add->IBAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_branch_add->RightColumnClass ?>"><div <?php echo $bank_branch_add->IBAN->cellAttributes() ?>>
<span id="el_bank_branch_IBAN">
<input type="text" data-table="bank_branch" data-field="x_IBAN" name="x_IBAN" id="x_IBAN" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bank_branch_add->IBAN->getPlaceHolder()) ?>" value="<?php echo $bank_branch_add->IBAN->EditValue ?>"<?php echo $bank_branch_add->IBAN->editAttributes() ?>>
</span>
<?php echo $bank_branch_add->IBAN->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bank_branch_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bank_branch_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bank_branch_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bank_branch_add->showPageFooter();
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
$bank_branch_add->terminate();
?>