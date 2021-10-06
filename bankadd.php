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
$bank_add = new bank_add();

// Run the page
$bank_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbankadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbankadd = currentForm = new ew.Form("fbankadd", "add");

	// Validate form
	fbankadd.validate = function() {
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
			<?php if ($bank_add->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_add->BankCode->caption(), $bank_add->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_add->BankShortName->Required) { ?>
				elm = this.getElements("x" + infix + "_BankShortName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_add->BankShortName->caption(), $bank_add->BankShortName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bank_add->BankName->Required) { ?>
				elm = this.getElements("x" + infix + "_BankName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bank_add->BankName->caption(), $bank_add->BankName->RequiredErrorMessage)) ?>");
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
	fbankadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbankadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbankadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bank_add->showPageHeader(); ?>
<?php
$bank_add->showMessage();
?>
<form name="fbankadd" id="fbankadd" class="<?php echo $bank_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$bank_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($bank_add->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label id="elh_bank_BankCode" for="x_BankCode" class="<?php echo $bank_add->LeftColumnClass ?>"><?php echo $bank_add->BankCode->caption() ?><?php echo $bank_add->BankCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_add->RightColumnClass ?>"><div <?php echo $bank_add->BankCode->cellAttributes() ?>>
<span id="el_bank_BankCode">
<input type="text" data-table="bank" data-field="x_BankCode" name="x_BankCode" id="x_BankCode" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($bank_add->BankCode->getPlaceHolder()) ?>" value="<?php echo $bank_add->BankCode->EditValue ?>"<?php echo $bank_add->BankCode->editAttributes() ?>>
</span>
<?php echo $bank_add->BankCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_add->BankShortName->Visible) { // BankShortName ?>
	<div id="r_BankShortName" class="form-group row">
		<label id="elh_bank_BankShortName" for="x_BankShortName" class="<?php echo $bank_add->LeftColumnClass ?>"><?php echo $bank_add->BankShortName->caption() ?><?php echo $bank_add->BankShortName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_add->RightColumnClass ?>"><div <?php echo $bank_add->BankShortName->cellAttributes() ?>>
<span id="el_bank_BankShortName">
<input type="text" data-table="bank" data-field="x_BankShortName" name="x_BankShortName" id="x_BankShortName" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($bank_add->BankShortName->getPlaceHolder()) ?>" value="<?php echo $bank_add->BankShortName->EditValue ?>"<?php echo $bank_add->BankShortName->editAttributes() ?>>
</span>
<?php echo $bank_add->BankShortName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bank_add->BankName->Visible) { // BankName ?>
	<div id="r_BankName" class="form-group row">
		<label id="elh_bank_BankName" for="x_BankName" class="<?php echo $bank_add->LeftColumnClass ?>"><?php echo $bank_add->BankName->caption() ?><?php echo $bank_add->BankName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bank_add->RightColumnClass ?>"><div <?php echo $bank_add->BankName->cellAttributes() ?>>
<span id="el_bank_BankName">
<input type="text" data-table="bank" data-field="x_BankName" name="x_BankName" id="x_BankName" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($bank_add->BankName->getPlaceHolder()) ?>" value="<?php echo $bank_add->BankName->EditValue ?>"<?php echo $bank_add->BankName->editAttributes() ?>>
</span>
<?php echo $bank_add->BankName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("bank_branch", explode(",", $bank->getCurrentDetailTable())) && $bank_branch->DetailAdd) {
?>
<?php if ($bank->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("bank_branch", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "bank_branchgrid.php" ?>
<?php } ?>
<?php if (!$bank_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bank_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bank_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bank_add->showPageFooter();
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
$bank_add->terminate();
?>