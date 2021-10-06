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
$rent_account_add = new rent_account_add();

// Run the page
$rent_account_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rent_account_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frent_accountadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	frent_accountadd = currentForm = new ew.Form("frent_accountadd", "add");

	// Validate form
	frent_accountadd.validate = function() {
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
			<?php if ($rent_account_add->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->PropertyNo->caption(), $rent_account_add->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->PropertyNo->errorMessage()) ?>");
			<?php if ($rent_account_add->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->ClientSerNo->caption(), $rent_account_add->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->ClientSerNo->errorMessage()) ?>");
			<?php if ($rent_account_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->ClientID->caption(), $rent_account_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_add->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->ChargeCode->caption(), $rent_account_add->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->ChargeCode->errorMessage()) ?>");
			<?php if ($rent_account_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->ChargeGroup->caption(), $rent_account_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->ChargeGroup->errorMessage()) ?>");
			<?php if ($rent_account_add->Securitydeposit->Required) { ?>
				elm = this.getElements("x" + infix + "_Securitydeposit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->Securitydeposit->caption(), $rent_account_add->Securitydeposit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Securitydeposit");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->Securitydeposit->errorMessage()) ?>");
			<?php if ($rent_account_add->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->BalanceBF->caption(), $rent_account_add->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->BalanceBF->errorMessage()) ?>");
			<?php if ($rent_account_add->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->CurrentDemand->caption(), $rent_account_add->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->CurrentDemand->errorMessage()) ?>");
			<?php if ($rent_account_add->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->VAT->caption(), $rent_account_add->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->VAT->errorMessage()) ?>");
			<?php if ($rent_account_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->AmountPaid->caption(), $rent_account_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->AmountPaid->errorMessage()) ?>");
			<?php if ($rent_account_add->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->BillPeriod->caption(), $rent_account_add->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->BillPeriod->errorMessage()) ?>");
			<?php if ($rent_account_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->PeriodType->caption(), $rent_account_add->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_add->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->BillYear->caption(), $rent_account_add->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->BillYear->errorMessage()) ?>");
			<?php if ($rent_account_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->StartDate->caption(), $rent_account_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->StartDate->errorMessage()) ?>");
			<?php if ($rent_account_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->EndDate->caption(), $rent_account_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->EndDate->errorMessage()) ?>");
			<?php if ($rent_account_add->LeaseDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaseDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->LeaseDesc->caption(), $rent_account_add->LeaseDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_add->Rent->Required) { ?>
				elm = this.getElements("x" + infix + "_Rent");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->Rent->caption(), $rent_account_add->Rent->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Rent");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->Rent->errorMessage()) ?>");
			<?php if ($rent_account_add->Period_type->Required) { ?>
				elm = this.getElements("x" + infix + "_Period_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->Period_type->caption(), $rent_account_add->Period_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->LastUpdatedBy->caption(), $rent_account_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rent_account_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rent_account_add->LastUpdateDate->caption(), $rent_account_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rent_account_add->LastUpdateDate->errorMessage()) ?>");

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
	frent_accountadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frent_accountadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("frent_accountadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rent_account_add->showPageHeader(); ?>
<?php
$rent_account_add->showMessage();
?>
<form name="frent_accountadd" id="frent_accountadd" class="<?php echo $rent_account_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rent_account">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$rent_account_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($rent_account_add->PropertyNo->Visible) { // PropertyNo ?>
	<div id="r_PropertyNo" class="form-group row">
		<label id="elh_rent_account_PropertyNo" for="x_PropertyNo" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->PropertyNo->caption() ?><?php echo $rent_account_add->PropertyNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->PropertyNo->cellAttributes() ?>>
<span id="el_rent_account_PropertyNo">
<input type="text" data-table="rent_account" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->PropertyNo->EditValue ?>"<?php echo $rent_account_add->PropertyNo->editAttributes() ?>>
</span>
<?php echo $rent_account_add->PropertyNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_rent_account_ClientSerNo" for="x_ClientSerNo" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->ClientSerNo->caption() ?><?php echo $rent_account_add->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->ClientSerNo->cellAttributes() ?>>
<span id="el_rent_account_ClientSerNo">
<input type="text" data-table="rent_account" data-field="x_ClientSerNo" name="x_ClientSerNo" id="x_ClientSerNo" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->ClientSerNo->EditValue ?>"<?php echo $rent_account_add->ClientSerNo->editAttributes() ?>>
</span>
<?php echo $rent_account_add->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_rent_account_ClientID" for="x_ClientID" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->ClientID->caption() ?><?php echo $rent_account_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->ClientID->cellAttributes() ?>>
<span id="el_rent_account_ClientID">
<input type="text" data-table="rent_account" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($rent_account_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->ClientID->EditValue ?>"<?php echo $rent_account_add->ClientID->editAttributes() ?>>
</span>
<?php echo $rent_account_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_rent_account_ChargeCode" for="x_ChargeCode" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->ChargeCode->caption() ?><?php echo $rent_account_add->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->ChargeCode->cellAttributes() ?>>
<span id="el_rent_account_ChargeCode">
<input type="text" data-table="rent_account" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->ChargeCode->EditValue ?>"<?php echo $rent_account_add->ChargeCode->editAttributes() ?>>
</span>
<?php echo $rent_account_add->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_rent_account_ChargeGroup" for="x_ChargeGroup" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->ChargeGroup->caption() ?><?php echo $rent_account_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->ChargeGroup->cellAttributes() ?>>
<span id="el_rent_account_ChargeGroup">
<input type="text" data-table="rent_account" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->ChargeGroup->EditValue ?>"<?php echo $rent_account_add->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $rent_account_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->Securitydeposit->Visible) { // Securitydeposit ?>
	<div id="r_Securitydeposit" class="form-group row">
		<label id="elh_rent_account_Securitydeposit" for="x_Securitydeposit" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->Securitydeposit->caption() ?><?php echo $rent_account_add->Securitydeposit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->Securitydeposit->cellAttributes() ?>>
<span id="el_rent_account_Securitydeposit">
<input type="text" data-table="rent_account" data-field="x_Securitydeposit" name="x_Securitydeposit" id="x_Securitydeposit" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->Securitydeposit->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->Securitydeposit->EditValue ?>"<?php echo $rent_account_add->Securitydeposit->editAttributes() ?>>
</span>
<?php echo $rent_account_add->Securitydeposit->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_rent_account_BalanceBF" for="x_BalanceBF" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->BalanceBF->caption() ?><?php echo $rent_account_add->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->BalanceBF->cellAttributes() ?>>
<span id="el_rent_account_BalanceBF">
<input type="text" data-table="rent_account" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->BalanceBF->EditValue ?>"<?php echo $rent_account_add->BalanceBF->editAttributes() ?>>
</span>
<?php echo $rent_account_add->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_rent_account_CurrentDemand" for="x_CurrentDemand" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->CurrentDemand->caption() ?><?php echo $rent_account_add->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->CurrentDemand->cellAttributes() ?>>
<span id="el_rent_account_CurrentDemand">
<input type="text" data-table="rent_account" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->CurrentDemand->EditValue ?>"<?php echo $rent_account_add->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $rent_account_add->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_rent_account_VAT" for="x_VAT" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->VAT->caption() ?><?php echo $rent_account_add->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->VAT->cellAttributes() ?>>
<span id="el_rent_account_VAT">
<input type="text" data-table="rent_account" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->VAT->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->VAT->EditValue ?>"<?php echo $rent_account_add->VAT->editAttributes() ?>>
</span>
<?php echo $rent_account_add->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_rent_account_AmountPaid" for="x_AmountPaid" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->AmountPaid->caption() ?><?php echo $rent_account_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->AmountPaid->cellAttributes() ?>>
<span id="el_rent_account_AmountPaid">
<input type="text" data-table="rent_account" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->AmountPaid->EditValue ?>"<?php echo $rent_account_add->AmountPaid->editAttributes() ?>>
</span>
<?php echo $rent_account_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_rent_account_BillPeriod" for="x_BillPeriod" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->BillPeriod->caption() ?><?php echo $rent_account_add->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->BillPeriod->cellAttributes() ?>>
<span id="el_rent_account_BillPeriod">
<input type="text" data-table="rent_account" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->BillPeriod->EditValue ?>"<?php echo $rent_account_add->BillPeriod->editAttributes() ?>>
</span>
<?php echo $rent_account_add->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_rent_account_PeriodType" for="x_PeriodType" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->PeriodType->caption() ?><?php echo $rent_account_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->PeriodType->cellAttributes() ?>>
<span id="el_rent_account_PeriodType">
<input type="text" data-table="rent_account" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($rent_account_add->PeriodType->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->PeriodType->EditValue ?>"<?php echo $rent_account_add->PeriodType->editAttributes() ?>>
</span>
<?php echo $rent_account_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_rent_account_BillYear" for="x_BillYear" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->BillYear->caption() ?><?php echo $rent_account_add->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->BillYear->cellAttributes() ?>>
<span id="el_rent_account_BillYear">
<input type="text" data-table="rent_account" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->BillYear->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->BillYear->EditValue ?>"<?php echo $rent_account_add->BillYear->editAttributes() ?>>
</span>
<?php echo $rent_account_add->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_rent_account_StartDate" for="x_StartDate" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->StartDate->caption() ?><?php echo $rent_account_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->StartDate->cellAttributes() ?>>
<span id="el_rent_account_StartDate">
<input type="text" data-table="rent_account" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($rent_account_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->StartDate->EditValue ?>"<?php echo $rent_account_add->StartDate->editAttributes() ?>>
</span>
<?php echo $rent_account_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_rent_account_EndDate" for="x_EndDate" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->EndDate->caption() ?><?php echo $rent_account_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->EndDate->cellAttributes() ?>>
<span id="el_rent_account_EndDate">
<input type="text" data-table="rent_account" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($rent_account_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->EndDate->EditValue ?>"<?php echo $rent_account_add->EndDate->editAttributes() ?>>
</span>
<?php echo $rent_account_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->LeaseDesc->Visible) { // LeaseDesc ?>
	<div id="r_LeaseDesc" class="form-group row">
		<label id="elh_rent_account_LeaseDesc" for="x_LeaseDesc" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->LeaseDesc->caption() ?><?php echo $rent_account_add->LeaseDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->LeaseDesc->cellAttributes() ?>>
<span id="el_rent_account_LeaseDesc">
<input type="text" data-table="rent_account" data-field="x_LeaseDesc" name="x_LeaseDesc" id="x_LeaseDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($rent_account_add->LeaseDesc->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->LeaseDesc->EditValue ?>"<?php echo $rent_account_add->LeaseDesc->editAttributes() ?>>
</span>
<?php echo $rent_account_add->LeaseDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->Rent->Visible) { // Rent ?>
	<div id="r_Rent" class="form-group row">
		<label id="elh_rent_account_Rent" for="x_Rent" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->Rent->caption() ?><?php echo $rent_account_add->Rent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->Rent->cellAttributes() ?>>
<span id="el_rent_account_Rent">
<input type="text" data-table="rent_account" data-field="x_Rent" name="x_Rent" id="x_Rent" size="30" placeholder="<?php echo HtmlEncode($rent_account_add->Rent->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->Rent->EditValue ?>"<?php echo $rent_account_add->Rent->editAttributes() ?>>
</span>
<?php echo $rent_account_add->Rent->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->Period_type->Visible) { // Period_type ?>
	<div id="r_Period_type" class="form-group row">
		<label id="elh_rent_account_Period_type" for="x_Period_type" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->Period_type->caption() ?><?php echo $rent_account_add->Period_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->Period_type->cellAttributes() ?>>
<span id="el_rent_account_Period_type">
<input type="text" data-table="rent_account" data-field="x_Period_type" name="x_Period_type" id="x_Period_type" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($rent_account_add->Period_type->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->Period_type->EditValue ?>"<?php echo $rent_account_add->Period_type->editAttributes() ?>>
</span>
<?php echo $rent_account_add->Period_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_rent_account_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->LastUpdatedBy->caption() ?><?php echo $rent_account_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_rent_account_LastUpdatedBy">
<input type="text" data-table="rent_account" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rent_account_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->LastUpdatedBy->EditValue ?>"<?php echo $rent_account_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $rent_account_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rent_account_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_rent_account_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $rent_account_add->LeftColumnClass ?>"><?php echo $rent_account_add->LastUpdateDate->caption() ?><?php echo $rent_account_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rent_account_add->RightColumnClass ?>"><div <?php echo $rent_account_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_rent_account_LastUpdateDate">
<input type="text" data-table="rent_account" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($rent_account_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $rent_account_add->LastUpdateDate->EditValue ?>"<?php echo $rent_account_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $rent_account_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rent_account_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rent_account_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rent_account_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rent_account_add->showPageFooter();
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
$rent_account_add->terminate();
?>