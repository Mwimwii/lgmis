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
$transaction_type_add = new transaction_type_add();

// Run the page
$transaction_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftransaction_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftransaction_typeadd = currentForm = new ew.Form("ftransaction_typeadd", "add");

	// Validate form
	ftransaction_typeadd.validate = function() {
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
			<?php if ($transaction_type_add->TransactionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_TransactionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_type_add->TransactionCode->caption(), $transaction_type_add->TransactionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TransactionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($transaction_type_add->TransactionCode->errorMessage()) ?>");
			<?php if ($transaction_type_add->TransactionName->Required) { ?>
				elm = this.getElements("x" + infix + "_TransactionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_type_add->TransactionName->caption(), $transaction_type_add->TransactionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($transaction_type_add->StandardLetter->Required) { ?>
				elm = this.getElements("x" + infix + "_StandardLetter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_type_add->StandardLetter->caption(), $transaction_type_add->StandardLetter->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($transaction_type_add->TransDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_TransDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $transaction_type_add->TransDesc->caption(), $transaction_type_add->TransDesc->RequiredErrorMessage)) ?>");
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
	ftransaction_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftransaction_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftransaction_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $transaction_type_add->showPageHeader(); ?>
<?php
$transaction_type_add->showMessage();
?>
<form name="ftransaction_typeadd" id="ftransaction_typeadd" class="<?php echo $transaction_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$transaction_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($transaction_type_add->TransactionCode->Visible) { // TransactionCode ?>
	<div id="r_TransactionCode" class="form-group row">
		<label id="elh_transaction_type_TransactionCode" for="x_TransactionCode" class="<?php echo $transaction_type_add->LeftColumnClass ?>"><?php echo $transaction_type_add->TransactionCode->caption() ?><?php echo $transaction_type_add->TransactionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_type_add->RightColumnClass ?>"><div <?php echo $transaction_type_add->TransactionCode->cellAttributes() ?>>
<span id="el_transaction_type_TransactionCode">
<input type="text" data-table="transaction_type" data-field="x_TransactionCode" name="x_TransactionCode" id="x_TransactionCode" placeholder="<?php echo HtmlEncode($transaction_type_add->TransactionCode->getPlaceHolder()) ?>" value="<?php echo $transaction_type_add->TransactionCode->EditValue ?>"<?php echo $transaction_type_add->TransactionCode->editAttributes() ?>>
</span>
<?php echo $transaction_type_add->TransactionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($transaction_type_add->TransactionName->Visible) { // TransactionName ?>
	<div id="r_TransactionName" class="form-group row">
		<label id="elh_transaction_type_TransactionName" for="x_TransactionName" class="<?php echo $transaction_type_add->LeftColumnClass ?>"><?php echo $transaction_type_add->TransactionName->caption() ?><?php echo $transaction_type_add->TransactionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_type_add->RightColumnClass ?>"><div <?php echo $transaction_type_add->TransactionName->cellAttributes() ?>>
<span id="el_transaction_type_TransactionName">
<input type="text" data-table="transaction_type" data-field="x_TransactionName" name="x_TransactionName" id="x_TransactionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($transaction_type_add->TransactionName->getPlaceHolder()) ?>" value="<?php echo $transaction_type_add->TransactionName->EditValue ?>"<?php echo $transaction_type_add->TransactionName->editAttributes() ?>>
</span>
<?php echo $transaction_type_add->TransactionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($transaction_type_add->StandardLetter->Visible) { // StandardLetter ?>
	<div id="r_StandardLetter" class="form-group row">
		<label id="elh_transaction_type_StandardLetter" class="<?php echo $transaction_type_add->LeftColumnClass ?>"><?php echo $transaction_type_add->StandardLetter->caption() ?><?php echo $transaction_type_add->StandardLetter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_type_add->RightColumnClass ?>"><div <?php echo $transaction_type_add->StandardLetter->cellAttributes() ?>>
<span id="el_transaction_type_StandardLetter">
<?php $transaction_type_add->StandardLetter->EditAttrs->appendClass("editor"); ?>
<textarea data-table="transaction_type" data-field="x_StandardLetter" name="x_StandardLetter" id="x_StandardLetter" cols="50" rows="4" placeholder="<?php echo HtmlEncode($transaction_type_add->StandardLetter->getPlaceHolder()) ?>"<?php echo $transaction_type_add->StandardLetter->editAttributes() ?>><?php echo $transaction_type_add->StandardLetter->EditValue ?></textarea>
<script>
loadjs.ready(["ftransaction_typeadd", "editor"], function() {
	ew.createEditor("ftransaction_typeadd", "x_StandardLetter", 50, 4, <?php echo $transaction_type_add->StandardLetter->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $transaction_type_add->StandardLetter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($transaction_type_add->TransDesc->Visible) { // TransDesc ?>
	<div id="r_TransDesc" class="form-group row">
		<label id="elh_transaction_type_TransDesc" for="x_TransDesc" class="<?php echo $transaction_type_add->LeftColumnClass ?>"><?php echo $transaction_type_add->TransDesc->caption() ?><?php echo $transaction_type_add->TransDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $transaction_type_add->RightColumnClass ?>"><div <?php echo $transaction_type_add->TransDesc->cellAttributes() ?>>
<span id="el_transaction_type_TransDesc">
<input type="text" data-table="transaction_type" data-field="x_TransDesc" name="x_TransDesc" id="x_TransDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($transaction_type_add->TransDesc->getPlaceHolder()) ?>" value="<?php echo $transaction_type_add->TransDesc->EditValue ?>"<?php echo $transaction_type_add->TransDesc->editAttributes() ?>>
</span>
<?php echo $transaction_type_add->TransDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$transaction_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $transaction_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $transaction_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$transaction_type_add->showPageFooter();
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
$transaction_type_add->terminate();
?>