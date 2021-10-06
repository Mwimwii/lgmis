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
$rent_account_edit = new rent_account_edit();

// Run the page
$rent_account_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_account_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frent_accountedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	frent_accountedit = currentForm = new ew.Form("frent_accountedit", "edit");

	// Validate form
	frent_accountedit.validate = function() {
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
			<?php if ($rent_account_edit->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->AccountNo->caption(), $rent_account_edit->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_edit->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->PropertyNo->caption(), $rent_account_edit->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->PropertyNo->errorMessage()) ?>");
			<?php if ($rent_account_edit->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->ClientSerNo->caption(), $rent_account_edit->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->ClientSerNo->errorMessage()) ?>");
			<?php if ($rent_account_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->ClientID->caption(), $rent_account_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_edit->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->ChargeCode->caption(), $rent_account_edit->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->ChargeCode->errorMessage()) ?>");
			<?php if ($rent_account_edit->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->ChargeGroup->caption(), $rent_account_edit->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->ChargeGroup->errorMessage()) ?>");
			<?php if ($rent_account_edit->Securitydeposit->Required) { ?>
				elm = this.getElements("x" + infix + "_Securitydeposit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->Securitydeposit->caption(), $rent_account_edit->Securitydeposit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Securitydeposit");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->Securitydeposit->errorMessage()) ?>");
			<?php if ($rent_account_edit->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->BalanceBF->caption(), $rent_account_edit->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->BalanceBF->errorMessage()) ?>");
			<?php if ($rent_account_edit->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->CurrentDemand->caption(), $rent_account_edit->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->CurrentDemand->errorMessage()) ?>");
			<?php if ($rent_account_edit->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->VAT->caption(), $rent_account_edit->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->VAT->errorMessage()) ?>");
			<?php if ($rent_account_edit->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->AmountPaid->caption(), $rent_account_edit->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->AmountPaid->errorMessage()) ?>");
			<?php if ($rent_account_edit->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->BillPeriod->caption(), $rent_account_edit->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->BillPeriod->errorMessage()) ?>");
			<?php if ($rent_account_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->PeriodType->caption(), $rent_account_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_edit->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->BillYear->caption(), $rent_account_edit->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->BillYear->errorMessage()) ?>");
			<?php if ($rent_account_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->StartDate->caption(), $rent_account_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->StartDate->errorMessage()) ?>");
			<?php if ($rent_account_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->EndDate->caption(), $rent_account_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->EndDate->errorMessage()) ?>");
			<?php if ($rent_account_edit->LeaseDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaseDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->LeaseDesc->caption(), $rent_account_edit->LeaseDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_edit->Rent->Required) { ?>
				elm = this.getElements("x" + infix + "_Rent");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->Rent->caption(), $rent_account_edit->Rent->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rent");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->Rent->errorMessage()) ?>");
			<?php if ($rent_account_edit->Period_type->Required) { ?>
				elm = this.getElements("x" + infix + "_Period_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->Period_type->caption(), $rent_account_edit->Period_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_edit->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->LastUpdatedBy->caption(), $rent_account_edit->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_edit->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_edit->LastUpdateDate->caption(), $rent_account_edit->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_edit->LastUpdateDate->errorMessage()) ?>");

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
	frent_accountedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frent_accountedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("frent_accountedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rent_account_edit->showPageHeader(); ?>
<?php
$rent_account_edit->showMessage();
?>
<?php if (!$rent_account_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rent_account_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frent_accountedit" id="frent_accountedit" class="<?php echo $rent_account_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_account">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$rent_account_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($rent_account_edit->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label id="elh_rent_account_AccountNo" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->AccountNo->caption() ?><?php echo $rent_account_edit->AccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->AccountNo->cellAttributes() ?>>
<span id="el_rent_account_AccountNo">
<span<?php echo $rent_account_edit->AccountNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rent_account_edit->AccountNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="rent_account" data-field="x_AccountNo" name="x_AccountNo" id="x_AccountNo" value="<?php echo HtmlEncode($rent_account_edit->AccountNo->CurrentValue) ?>">
<?php echo $rent_account_edit->AccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label id="elh_rent_account_PropertyNo" for="x_PropertyNo" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->PropertyNo->caption() ?><?php echo $rent_account_edit->PropertyNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->PropertyNo->cellAttributes() ?>>
<span id="el_rent_account_PropertyNo">
<input type="text" data-table="rent_account" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->PropertyNo->EditValue ?>"<?php echo $rent_account_edit->PropertyNo->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->PropertyNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_rent_account_ClientSerNo" for="x_ClientSerNo" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->ClientSerNo->caption() ?><?php echo $rent_account_edit->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->ClientSerNo->cellAttributes() ?>>
<span id="el_rent_account_ClientSerNo">
<input type="text" data-table="rent_account" data-field="x_ClientSerNo" name="x_ClientSerNo" id="x_ClientSerNo" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->ClientSerNo->EditValue ?>"<?php echo $rent_account_edit->ClientSerNo->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_rent_account_ClientID" for="x_ClientID" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->ClientID->caption() ?><?php echo $rent_account_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->ClientID->cellAttributes() ?>>
<span id="el_rent_account_ClientID">
<input type="text" data-table="rent_account" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($rent_account_edit->ClientID->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->ClientID->EditValue ?>"<?php echo $rent_account_edit->ClientID->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_rent_account_ChargeCode" for="x_ChargeCode" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->ChargeCode->caption() ?><?php echo $rent_account_edit->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->ChargeCode->cellAttributes() ?>>
<span id="el_rent_account_ChargeCode">
<input type="text" data-table="rent_account" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->ChargeCode->EditValue ?>"<?php echo $rent_account_edit->ChargeCode->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_rent_account_ChargeGroup" for="x_ChargeGroup" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->ChargeGroup->caption() ?><?php echo $rent_account_edit->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->ChargeGroup->cellAttributes() ?>>
<span id="el_rent_account_ChargeGroup">
<input type="text" data-table="rent_account" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->ChargeGroup->EditValue ?>"<?php echo $rent_account_edit->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->Securitydeposit->Visible) { // Securitydeposit ?>
	<div id="r_Securitydeposit" class="form-group row">
		<label id="elh_rent_account_Securitydeposit" for="x_Securitydeposit" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->Securitydeposit->caption() ?><?php echo $rent_account_edit->Securitydeposit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->Securitydeposit->cellAttributes() ?>>
<span id="el_rent_account_Securitydeposit">
<input type="text" data-table="rent_account" data-field="x_Securitydeposit" name="x_Securitydeposit" id="x_Securitydeposit" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->Securitydeposit->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->Securitydeposit->EditValue ?>"<?php echo $rent_account_edit->Securitydeposit->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->Securitydeposit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_rent_account_BalanceBF" for="x_BalanceBF" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->BalanceBF->caption() ?><?php echo $rent_account_edit->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->BalanceBF->cellAttributes() ?>>
<span id="el_rent_account_BalanceBF">
<input type="text" data-table="rent_account" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->BalanceBF->EditValue ?>"<?php echo $rent_account_edit->BalanceBF->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_rent_account_CurrentDemand" for="x_CurrentDemand" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->CurrentDemand->caption() ?><?php echo $rent_account_edit->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->CurrentDemand->cellAttributes() ?>>
<span id="el_rent_account_CurrentDemand">
<input type="text" data-table="rent_account" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->CurrentDemand->EditValue ?>"<?php echo $rent_account_edit->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_rent_account_VAT" for="x_VAT" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->VAT->caption() ?><?php echo $rent_account_edit->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->VAT->cellAttributes() ?>>
<span id="el_rent_account_VAT">
<input type="text" data-table="rent_account" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->VAT->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->VAT->EditValue ?>"<?php echo $rent_account_edit->VAT->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_rent_account_AmountPaid" for="x_AmountPaid" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->AmountPaid->caption() ?><?php echo $rent_account_edit->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->AmountPaid->cellAttributes() ?>>
<span id="el_rent_account_AmountPaid">
<input type="text" data-table="rent_account" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->AmountPaid->EditValue ?>"<?php echo $rent_account_edit->AmountPaid->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_rent_account_BillPeriod" for="x_BillPeriod" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->BillPeriod->caption() ?><?php echo $rent_account_edit->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->BillPeriod->cellAttributes() ?>>
<span id="el_rent_account_BillPeriod">
<input type="text" data-table="rent_account" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->BillPeriod->EditValue ?>"<?php echo $rent_account_edit->BillPeriod->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_rent_account_PeriodType" for="x_PeriodType" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->PeriodType->caption() ?><?php echo $rent_account_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->PeriodType->cellAttributes() ?>>
<span id="el_rent_account_PeriodType">
<input type="text" data-table="rent_account" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($rent_account_edit->PeriodType->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->PeriodType->EditValue ?>"<?php echo $rent_account_edit->PeriodType->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_rent_account_BillYear" for="x_BillYear" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->BillYear->caption() ?><?php echo $rent_account_edit->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->BillYear->cellAttributes() ?>>
<span id="el_rent_account_BillYear">
<input type="text" data-table="rent_account" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->BillYear->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->BillYear->EditValue ?>"<?php echo $rent_account_edit->BillYear->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_rent_account_StartDate" for="x_StartDate" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->StartDate->caption() ?><?php echo $rent_account_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->StartDate->cellAttributes() ?>>
<span id="el_rent_account_StartDate">
<input type="text" data-table="rent_account" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($rent_account_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->StartDate->EditValue ?>"<?php echo $rent_account_edit->StartDate->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_rent_account_EndDate" for="x_EndDate" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->EndDate->caption() ?><?php echo $rent_account_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->EndDate->cellAttributes() ?>>
<span id="el_rent_account_EndDate">
<input type="text" data-table="rent_account" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($rent_account_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->EndDate->EditValue ?>"<?php echo $rent_account_edit->EndDate->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->LeaseDesc->Visible) { // LeaseDesc ?>
	<div id="r_LeaseDesc" class="form-group row">
		<label id="elh_rent_account_LeaseDesc" for="x_LeaseDesc" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->LeaseDesc->caption() ?><?php echo $rent_account_edit->LeaseDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->LeaseDesc->cellAttributes() ?>>
<span id="el_rent_account_LeaseDesc">
<input type="text" data-table="rent_account" data-field="x_LeaseDesc" name="x_LeaseDesc" id="x_LeaseDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($rent_account_edit->LeaseDesc->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->LeaseDesc->EditValue ?>"<?php echo $rent_account_edit->LeaseDesc->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->LeaseDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->Rent->Visible) { // Rent ?>
	<div id="r_Rent" class="form-group row">
		<label id="elh_rent_account_Rent" for="x_Rent" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->Rent->caption() ?><?php echo $rent_account_edit->Rent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->Rent->cellAttributes() ?>>
<span id="el_rent_account_Rent">
<input type="text" data-table="rent_account" data-field="x_Rent" name="x_Rent" id="x_Rent" size="30" placeholder="<?php echo HtmlEncode($rent_account_edit->Rent->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->Rent->EditValue ?>"<?php echo $rent_account_edit->Rent->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->Rent->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->Period_type->Visible) { // Period_type ?>
	<div id="r_Period_type" class="form-group row">
		<label id="elh_rent_account_Period_type" for="x_Period_type" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->Period_type->caption() ?><?php echo $rent_account_edit->Period_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->Period_type->cellAttributes() ?>>
<span id="el_rent_account_Period_type">
<input type="text" data-table="rent_account" data-field="x_Period_type" name="x_Period_type" id="x_Period_type" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($rent_account_edit->Period_type->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->Period_type->EditValue ?>"<?php echo $rent_account_edit->Period_type->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->Period_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_rent_account_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->LastUpdatedBy->caption() ?><?php echo $rent_account_edit->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->LastUpdatedBy->cellAttributes() ?>>
<span id="el_rent_account_LastUpdatedBy">
<input type="text" data-table="rent_account" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rent_account_edit->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->LastUpdatedBy->EditValue ?>"<?php echo $rent_account_edit->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_edit->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_rent_account_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $rent_account_edit->LeftColumnClass ?>"><?php echo $rent_account_edit->LastUpdateDate->caption() ?><?php echo $rent_account_edit->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_edit->RightColumnClass ?>"><div <?php echo $rent_account_edit->LastUpdateDate->cellAttributes() ?>>
<span id="el_rent_account_LastUpdateDate">
<input type="text" data-table="rent_account" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($rent_account_edit->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $rent_account_edit->LastUpdateDate->EditValue ?>"<?php echo $rent_account_edit->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $rent_account_edit->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rent_account_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rent_account_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rent_account_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$rent_account_edit->IsModal) { ?>
<?php echo $rent_account_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$rent_account_edit->showPageFooter();
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
$rent_account_edit->terminate();
?>