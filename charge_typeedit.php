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
$charge_type_edit = new charge_type_edit();

// Run the page
$charge_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcharge_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcharge_typeedit = currentForm = new ew.Form("fcharge_typeedit", "edit");

	// Validate form
	fcharge_typeedit.validate = function() {
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
			<?php if ($charge_type_edit->ChargeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_edit->ChargeType->caption(), $charge_type_edit->ChargeType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charge_type_edit->ChargeType->errorMessage()) ?>");
			<?php if ($charge_type_edit->ChargeTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_edit->ChargeTypeDesc->caption(), $charge_type_edit->ChargeTypeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_type_edit->IncomeType->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_edit->IncomeType->caption(), $charge_type_edit->IncomeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_type_edit->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_edit->BankCode->caption(), $charge_type_edit->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_type_edit->BankAccount->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_type_edit->BankAccount->caption(), $charge_type_edit->BankAccount->RequiredErrorMessage)) ?>");
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
	fcharge_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcharge_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcharge_typeedit.lists["x_BankCode"] = <?php echo $charge_type_edit->BankCode->Lookup->toClientList($charge_type_edit) ?>;
	fcharge_typeedit.lists["x_BankCode"].options = <?php echo JsonEncode($charge_type_edit->BankCode->lookupOptions()) ?>;
	loadjs.done("fcharge_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charge_type_edit->showPageHeader(); ?>
<?php
$charge_type_edit->showMessage();
?>
<?php if (!$charge_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcharge_typeedit" id="fcharge_typeedit" class="<?php echo $charge_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$charge_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($charge_type_edit->ChargeType->Visible) { // ChargeType ?>
	<div id="r_ChargeType" class="form-group row">
		<label id="elh_charge_type_ChargeType" for="x_ChargeType" class="<?php echo $charge_type_edit->LeftColumnClass ?>"><?php echo $charge_type_edit->ChargeType->caption() ?><?php echo $charge_type_edit->ChargeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_edit->RightColumnClass ?>"><div <?php echo $charge_type_edit->ChargeType->cellAttributes() ?>>
<input type="text" data-table="charge_type" data-field="x_ChargeType" name="x_ChargeType" id="x_ChargeType" placeholder="<?php echo HtmlEncode($charge_type_edit->ChargeType->getPlaceHolder()) ?>" value="<?php echo $charge_type_edit->ChargeType->EditValue ?>"<?php echo $charge_type_edit->ChargeType->editAttributes() ?>>
<input type="hidden" data-table="charge_type" data-field="x_ChargeType" name="o_ChargeType" id="o_ChargeType" value="<?php echo HtmlEncode($charge_type_edit->ChargeType->OldValue != null ? $charge_type_edit->ChargeType->OldValue : $charge_type_edit->ChargeType->CurrentValue) ?>">
<?php echo $charge_type_edit->ChargeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_edit->ChargeTypeDesc->Visible) { // ChargeTypeDesc ?>
	<div id="r_ChargeTypeDesc" class="form-group row">
		<label id="elh_charge_type_ChargeTypeDesc" for="x_ChargeTypeDesc" class="<?php echo $charge_type_edit->LeftColumnClass ?>"><?php echo $charge_type_edit->ChargeTypeDesc->caption() ?><?php echo $charge_type_edit->ChargeTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_edit->RightColumnClass ?>"><div <?php echo $charge_type_edit->ChargeTypeDesc->cellAttributes() ?>>
<span id="el_charge_type_ChargeTypeDesc">
<input type="text" data-table="charge_type" data-field="x_ChargeTypeDesc" name="x_ChargeTypeDesc" id="x_ChargeTypeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charge_type_edit->ChargeTypeDesc->getPlaceHolder()) ?>" value="<?php echo $charge_type_edit->ChargeTypeDesc->EditValue ?>"<?php echo $charge_type_edit->ChargeTypeDesc->editAttributes() ?>>
</span>
<?php echo $charge_type_edit->ChargeTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_edit->IncomeType->Visible) { // IncomeType ?>
	<div id="r_IncomeType" class="form-group row">
		<label id="elh_charge_type_IncomeType" for="x_IncomeType" class="<?php echo $charge_type_edit->LeftColumnClass ?>"><?php echo $charge_type_edit->IncomeType->caption() ?><?php echo $charge_type_edit->IncomeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_edit->RightColumnClass ?>"><div <?php echo $charge_type_edit->IncomeType->cellAttributes() ?>>
<span id="el_charge_type_IncomeType">
<input type="text" data-table="charge_type" data-field="x_IncomeType" name="x_IncomeType" id="x_IncomeType" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($charge_type_edit->IncomeType->getPlaceHolder()) ?>" value="<?php echo $charge_type_edit->IncomeType->EditValue ?>"<?php echo $charge_type_edit->IncomeType->editAttributes() ?>>
</span>
<?php echo $charge_type_edit->IncomeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_edit->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label id="elh_charge_type_BankCode" for="x_BankCode" class="<?php echo $charge_type_edit->LeftColumnClass ?>"><?php echo $charge_type_edit->BankCode->caption() ?><?php echo $charge_type_edit->BankCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_edit->RightColumnClass ?>"><div <?php echo $charge_type_edit->BankCode->cellAttributes() ?>>
<span id="el_charge_type_BankCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BankCode"><?php echo EmptyValue(strval($charge_type_edit->BankCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charge_type_edit->BankCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charge_type_edit->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charge_type_edit->BankCode->ReadOnly || $charge_type_edit->BankCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BankCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charge_type_edit->BankCode->Lookup->getParamTag($charge_type_edit, "p_x_BankCode") ?>
<input type="hidden" data-table="charge_type" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charge_type_edit->BankCode->displayValueSeparatorAttribute() ?>" name="x_BankCode" id="x_BankCode" value="<?php echo $charge_type_edit->BankCode->CurrentValue ?>"<?php echo $charge_type_edit->BankCode->editAttributes() ?>>
</span>
<?php echo $charge_type_edit->BankCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_type_edit->BankAccount->Visible) { // BankAccount ?>
	<div id="r_BankAccount" class="form-group row">
		<label id="elh_charge_type_BankAccount" for="x_BankAccount" class="<?php echo $charge_type_edit->LeftColumnClass ?>"><?php echo $charge_type_edit->BankAccount->caption() ?><?php echo $charge_type_edit->BankAccount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_type_edit->RightColumnClass ?>"><div <?php echo $charge_type_edit->BankAccount->cellAttributes() ?>>
<span id="el_charge_type_BankAccount">
<input type="text" data-table="charge_type" data-field="x_BankAccount" name="x_BankAccount" id="x_BankAccount" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($charge_type_edit->BankAccount->getPlaceHolder()) ?>" value="<?php echo $charge_type_edit->BankAccount->EditValue ?>"<?php echo $charge_type_edit->BankAccount->editAttributes() ?>>
</span>
<?php echo $charge_type_edit->BankAccount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charge_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charge_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charge_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$charge_type_edit->IsModal) { ?>
<?php echo $charge_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$charge_type_edit->showPageFooter();
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
$charge_type_edit->terminate();
?>