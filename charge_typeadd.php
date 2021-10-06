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
$charge_type_add = new charge_type_add();

// Run the page
$charge_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcharge_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcharge_typeadd = currentForm = new ew.Form("fcharge_typeadd", "add");

	// Validate form
	fcharge_typeadd.validate = function() {
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
			<?php if ($charge_type_add->ChargeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_add->ChargeType->caption(), $charge_type_add->ChargeType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charge_type_add->ChargeType->errorMessage()) ?>");
			<?php if ($charge_type_add->ChargeTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_add->ChargeTypeDesc->caption(), $charge_type_add->ChargeTypeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_type_add->IncomeType->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_add->IncomeType->caption(), $charge_type_add->IncomeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_type_add->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_add->BankCode->caption(), $charge_type_add->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_type_add->BankAccount->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_add->BankAccount->caption(), $charge_type_add->BankAccount->RequiredErrorMessage)) ?>");
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
	fcharge_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcharge_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcharge_typeadd.lists["x_BankCode"] = <?php echo $charge_type_add->BankCode->Lookup->toClientList($charge_type_add) ?>;
	fcharge_typeadd.lists["x_BankCode"].options = <?php echo JsonEncode($charge_type_add->BankCode->lookupOptions()) ?>;
	loadjs.done("fcharge_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charge_type_add->showPageHeader(); ?>
<?php
$charge_type_add->showMessage();
?>
<form name="fcharge_typeadd" id="fcharge_typeadd" class="<?php echo $charge_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$charge_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($charge_type_add->ChargeType->Visible) { // ChargeType ?>
	<div id="r_ChargeType" class="form-group row">
		<label id="elh_charge_type_ChargeType" for="x_ChargeType" class="<?php echo $charge_type_add->LeftColumnClass ?>"><?php echo $charge_type_add->ChargeType->caption() ?><?php echo $charge_type_add->ChargeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_add->RightColumnClass ?>"><div <?php echo $charge_type_add->ChargeType->cellAttributes() ?>>
<span id="el_charge_type_ChargeType">
<input type="text" data-table="charge_type" data-field="x_ChargeType" name="x_ChargeType" id="x_ChargeType" placeholder="<?php echo HtmlEncode($charge_type_add->ChargeType->getPlaceHolder()) ?>" value="<?php echo $charge_type_add->ChargeType->EditValue ?>"<?php echo $charge_type_add->ChargeType->editAttributes() ?>>
</span>
<?php echo $charge_type_add->ChargeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_add->ChargeTypeDesc->Visible) { // ChargeTypeDesc ?>
	<div id="r_ChargeTypeDesc" class="form-group row">
		<label id="elh_charge_type_ChargeTypeDesc" for="x_ChargeTypeDesc" class="<?php echo $charge_type_add->LeftColumnClass ?>"><?php echo $charge_type_add->ChargeTypeDesc->caption() ?><?php echo $charge_type_add->ChargeTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_add->RightColumnClass ?>"><div <?php echo $charge_type_add->ChargeTypeDesc->cellAttributes() ?>>
<span id="el_charge_type_ChargeTypeDesc">
<input type="text" data-table="charge_type" data-field="x_ChargeTypeDesc" name="x_ChargeTypeDesc" id="x_ChargeTypeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charge_type_add->ChargeTypeDesc->getPlaceHolder()) ?>" value="<?php echo $charge_type_add->ChargeTypeDesc->EditValue ?>"<?php echo $charge_type_add->ChargeTypeDesc->editAttributes() ?>>
</span>
<?php echo $charge_type_add->ChargeTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_add->IncomeType->Visible) { // IncomeType ?>
	<div id="r_IncomeType" class="form-group row">
		<label id="elh_charge_type_IncomeType" for="x_IncomeType" class="<?php echo $charge_type_add->LeftColumnClass ?>"><?php echo $charge_type_add->IncomeType->caption() ?><?php echo $charge_type_add->IncomeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_add->RightColumnClass ?>"><div <?php echo $charge_type_add->IncomeType->cellAttributes() ?>>
<span id="el_charge_type_IncomeType">
<input type="text" data-table="charge_type" data-field="x_IncomeType" name="x_IncomeType" id="x_IncomeType" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($charge_type_add->IncomeType->getPlaceHolder()) ?>" value="<?php echo $charge_type_add->IncomeType->EditValue ?>"<?php echo $charge_type_add->IncomeType->editAttributes() ?>>
</span>
<?php echo $charge_type_add->IncomeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_add->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label id="elh_charge_type_BankCode" for="x_BankCode" class="<?php echo $charge_type_add->LeftColumnClass ?>"><?php echo $charge_type_add->BankCode->caption() ?><?php echo $charge_type_add->BankCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_add->RightColumnClass ?>"><div <?php echo $charge_type_add->BankCode->cellAttributes() ?>>
<span id="el_charge_type_BankCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BankCode"><?php echo EmptyValue(strval($charge_type_add->BankCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charge_type_add->BankCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charge_type_add->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charge_type_add->BankCode->ReadOnly || $charge_type_add->BankCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BankCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charge_type_add->BankCode->Lookup->getParamTag($charge_type_add, "p_x_BankCode") ?>
<input type="hidden" data-table="charge_type" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charge_type_add->BankCode->displayValueSeparatorAttribute() ?>" name="x_BankCode" id="x_BankCode" value="<?php echo $charge_type_add->BankCode->CurrentValue ?>"<?php echo $charge_type_add->BankCode->editAttributes() ?>>
</span>
<?php echo $charge_type_add->BankCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_add->BankAccount->Visible) { // BankAccount ?>
	<div id="r_BankAccount" class="form-group row">
		<label id="elh_charge_type_BankAccount" for="x_BankAccount" class="<?php echo $charge_type_add->LeftColumnClass ?>"><?php echo $charge_type_add->BankAccount->caption() ?><?php echo $charge_type_add->BankAccount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_add->RightColumnClass ?>"><div <?php echo $charge_type_add->BankAccount->cellAttributes() ?>>
<span id="el_charge_type_BankAccount">
<input type="text" data-table="charge_type" data-field="x_BankAccount" name="x_BankAccount" id="x_BankAccount" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($charge_type_add->BankAccount->getPlaceHolder()) ?>" value="<?php echo $charge_type_add->BankAccount->EditValue ?>"<?php echo $charge_type_add->BankAccount->editAttributes() ?>>
</span>
<?php echo $charge_type_add->BankAccount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charge_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charge_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charge_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$charge_type_add->showPageFooter();
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
$charge_type_add->terminate();
?>