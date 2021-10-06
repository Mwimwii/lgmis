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
$account_sub_type_add = new account_sub_type_add();

// Run the page
$account_sub_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$account_sub_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faccount_sub_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	faccount_sub_typeadd = currentForm = new ew.Form("faccount_sub_typeadd", "add");

	// Validate form
	faccount_sub_typeadd.validate = function() {
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
			<?php if ($account_sub_type_add->AccountSubTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountSubTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_sub_type_add->AccountSubTypeCode->caption(), $account_sub_type_add->AccountSubTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountSubTypeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($account_sub_type_add->AccountSubTypeCode->errorMessage()) ?>");
			<?php if ($account_sub_type_add->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_sub_type_add->AccountType->caption(), $account_sub_type_add->AccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($account_sub_type_add->AccountSubTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountSubTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_sub_type_add->AccountSubTypeName->caption(), $account_sub_type_add->AccountSubTypeName->RequiredErrorMessage)) ?>");
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
	faccount_sub_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccount_sub_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccount_sub_typeadd.lists["x_AccountType"] = <?php echo $account_sub_type_add->AccountType->Lookup->toClientList($account_sub_type_add) ?>;
	faccount_sub_typeadd.lists["x_AccountType"].options = <?php echo JsonEncode($account_sub_type_add->AccountType->lookupOptions()) ?>;
	loadjs.done("faccount_sub_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $account_sub_type_add->showPageHeader(); ?>
<?php
$account_sub_type_add->showMessage();
?>
<form name="faccount_sub_typeadd" id="faccount_sub_typeadd" class="<?php echo $account_sub_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="account_sub_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$account_sub_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($account_sub_type_add->AccountSubTypeCode->Visible) { // AccountSubTypeCode ?>
	<div id="r_AccountSubTypeCode" class="form-group row">
		<label id="elh_account_sub_type_AccountSubTypeCode" for="x_AccountSubTypeCode" class="<?php echo $account_sub_type_add->LeftColumnClass ?>"><?php echo $account_sub_type_add->AccountSubTypeCode->caption() ?><?php echo $account_sub_type_add->AccountSubTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $account_sub_type_add->RightColumnClass ?>"><div <?php echo $account_sub_type_add->AccountSubTypeCode->cellAttributes() ?>>
<span id="el_account_sub_type_AccountSubTypeCode">
<input type="text" data-table="account_sub_type" data-field="x_AccountSubTypeCode" name="x_AccountSubTypeCode" id="x_AccountSubTypeCode" placeholder="<?php echo HtmlEncode($account_sub_type_add->AccountSubTypeCode->getPlaceHolder()) ?>" value="<?php echo $account_sub_type_add->AccountSubTypeCode->EditValue ?>"<?php echo $account_sub_type_add->AccountSubTypeCode->editAttributes() ?>>
</span>
<?php echo $account_sub_type_add->AccountSubTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($account_sub_type_add->AccountType->Visible) { // AccountType ?>
	<div id="r_AccountType" class="form-group row">
		<label id="elh_account_sub_type_AccountType" for="x_AccountType" class="<?php echo $account_sub_type_add->LeftColumnClass ?>"><?php echo $account_sub_type_add->AccountType->caption() ?><?php echo $account_sub_type_add->AccountType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $account_sub_type_add->RightColumnClass ?>"><div <?php echo $account_sub_type_add->AccountType->cellAttributes() ?>>
<span id="el_account_sub_type_AccountType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="account_sub_type" data-field="x_AccountType" data-value-separator="<?php echo $account_sub_type_add->AccountType->displayValueSeparatorAttribute() ?>" id="x_AccountType" name="x_AccountType"<?php echo $account_sub_type_add->AccountType->editAttributes() ?>>
			<?php echo $account_sub_type_add->AccountType->selectOptionListHtml("x_AccountType") ?>
		</select>
</div>
<?php echo $account_sub_type_add->AccountType->Lookup->getParamTag($account_sub_type_add, "p_x_AccountType") ?>
</span>
<?php echo $account_sub_type_add->AccountType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($account_sub_type_add->AccountSubTypeName->Visible) { // AccountSubTypeName ?>
	<div id="r_AccountSubTypeName" class="form-group row">
		<label id="elh_account_sub_type_AccountSubTypeName" for="x_AccountSubTypeName" class="<?php echo $account_sub_type_add->LeftColumnClass ?>"><?php echo $account_sub_type_add->AccountSubTypeName->caption() ?><?php echo $account_sub_type_add->AccountSubTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $account_sub_type_add->RightColumnClass ?>"><div <?php echo $account_sub_type_add->AccountSubTypeName->cellAttributes() ?>>
<span id="el_account_sub_type_AccountSubTypeName">
<input type="text" data-table="account_sub_type" data-field="x_AccountSubTypeName" name="x_AccountSubTypeName" id="x_AccountSubTypeName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($account_sub_type_add->AccountSubTypeName->getPlaceHolder()) ?>" value="<?php echo $account_sub_type_add->AccountSubTypeName->EditValue ?>"<?php echo $account_sub_type_add->AccountSubTypeName->editAttributes() ?>>
</span>
<?php echo $account_sub_type_add->AccountSubTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$account_sub_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $account_sub_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $account_sub_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$account_sub_type_add->showPageFooter();
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
$account_sub_type_add->terminate();
?>