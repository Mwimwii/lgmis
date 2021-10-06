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
$licence_account_add = new licence_account_add();

// Run the page
$licence_account_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$licence_account_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flicence_accountadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flicence_accountadd = currentForm = new ew.Form("flicence_accountadd", "add");

	// Validate form
	flicence_accountadd.validate = function() {
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
			<?php if ($licence_account_add->BusinessNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->BusinessNo->caption(), $licence_account_add->BusinessNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->BusinessNo->errorMessage()) ?>");
			<?php if ($licence_account_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->ClientID->caption(), $licence_account_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_add->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->ChargeCode->caption(), $licence_account_add->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->ChargeCode->errorMessage()) ?>");
			<?php if ($licence_account_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->ChargeGroup->caption(), $licence_account_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->ChargeGroup->errorMessage()) ?>");
			<?php if ($licence_account_add->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->BalanceBF->caption(), $licence_account_add->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->BalanceBF->errorMessage()) ?>");
			<?php if ($licence_account_add->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->CurrentDemand->caption(), $licence_account_add->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->CurrentDemand->errorMessage()) ?>");
			<?php if ($licence_account_add->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->VAT->caption(), $licence_account_add->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->VAT->errorMessage()) ?>");
			<?php if ($licence_account_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->AmountPaid->caption(), $licence_account_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->AmountPaid->errorMessage()) ?>");
			<?php if ($licence_account_add->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->BillPeriod->caption(), $licence_account_add->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->BillPeriod->errorMessage()) ?>");
			<?php if ($licence_account_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->PeriodType->caption(), $licence_account_add->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->PeriodType->errorMessage()) ?>");
			<?php if ($licence_account_add->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->BillYear->caption(), $licence_account_add->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->BillYear->errorMessage()) ?>");
			<?php if ($licence_account_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->StartDate->caption(), $licence_account_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->StartDate->errorMessage()) ?>");
			<?php if ($licence_account_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->EndDate->caption(), $licence_account_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->EndDate->errorMessage()) ?>");
			<?php if ($licence_account_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->LastUpdatedBy->caption(), $licence_account_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_add->LastUpdateDate->caption(), $licence_account_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_add->LastUpdateDate->errorMessage()) ?>");

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
	flicence_accountadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flicence_accountadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flicence_accountadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $licence_account_add->showPageHeader(); ?>
<?php
$licence_account_add->showMessage();
?>
<form name="flicence_accountadd" id="flicence_accountadd" class="<?php echo $licence_account_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="licence_account">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$licence_account_add->IsModal ?>">
<?php if ($licence_account->getCurrentMasterTable() == "business") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="business">
<input type="hidden" name="fk_BusinessID" value="<?php echo HtmlEncode($licence_account_add->BusinessNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($licence_account_add->BusinessNo->Visible) { // BusinessNo ?>
	<div id="r_BusinessNo" class="form-group row">
		<label id="elh_licence_account_BusinessNo" for="x_BusinessNo" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->BusinessNo->caption() ?><?php echo $licence_account_add->BusinessNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->BusinessNo->cellAttributes() ?>>
<?php if ($licence_account_add->BusinessNo->getSessionValue() != "") { ?>
<span id="el_licence_account_BusinessNo">
<span<?php echo $licence_account_add->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_add->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BusinessNo" name="x_BusinessNo" value="<?php echo HtmlEncode($licence_account_add->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_licence_account_BusinessNo">
<input type="text" data-table="licence_account" data-field="x_BusinessNo" name="x_BusinessNo" id="x_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->BusinessNo->EditValue ?>"<?php echo $licence_account_add->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $licence_account_add->BusinessNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_licence_account_ClientID" for="x_ClientID" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->ClientID->caption() ?><?php echo $licence_account_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->ClientID->cellAttributes() ?>>
<span id="el_licence_account_ClientID">
<input type="text" data-table="licence_account" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($licence_account_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->ClientID->EditValue ?>"<?php echo $licence_account_add->ClientID->editAttributes() ?>>
</span>
<?php echo $licence_account_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_licence_account_ChargeCode" for="x_ChargeCode" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->ChargeCode->caption() ?><?php echo $licence_account_add->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->ChargeCode->cellAttributes() ?>>
<span id="el_licence_account_ChargeCode">
<input type="text" data-table="licence_account" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->ChargeCode->EditValue ?>"<?php echo $licence_account_add->ChargeCode->editAttributes() ?>>
</span>
<?php echo $licence_account_add->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_licence_account_ChargeGroup" for="x_ChargeGroup" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->ChargeGroup->caption() ?><?php echo $licence_account_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->ChargeGroup->cellAttributes() ?>>
<span id="el_licence_account_ChargeGroup">
<input type="text" data-table="licence_account" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->ChargeGroup->EditValue ?>"<?php echo $licence_account_add->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $licence_account_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_licence_account_BalanceBF" for="x_BalanceBF" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->BalanceBF->caption() ?><?php echo $licence_account_add->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->BalanceBF->cellAttributes() ?>>
<span id="el_licence_account_BalanceBF">
<input type="text" data-table="licence_account" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->BalanceBF->EditValue ?>"<?php echo $licence_account_add->BalanceBF->editAttributes() ?>>
</span>
<?php echo $licence_account_add->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_licence_account_CurrentDemand" for="x_CurrentDemand" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->CurrentDemand->caption() ?><?php echo $licence_account_add->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->CurrentDemand->cellAttributes() ?>>
<span id="el_licence_account_CurrentDemand">
<input type="text" data-table="licence_account" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->CurrentDemand->EditValue ?>"<?php echo $licence_account_add->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $licence_account_add->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_licence_account_VAT" for="x_VAT" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->VAT->caption() ?><?php echo $licence_account_add->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->VAT->cellAttributes() ?>>
<span id="el_licence_account_VAT">
<input type="text" data-table="licence_account" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->VAT->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->VAT->EditValue ?>"<?php echo $licence_account_add->VAT->editAttributes() ?>>
</span>
<?php echo $licence_account_add->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_licence_account_AmountPaid" for="x_AmountPaid" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->AmountPaid->caption() ?><?php echo $licence_account_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->AmountPaid->cellAttributes() ?>>
<span id="el_licence_account_AmountPaid">
<input type="text" data-table="licence_account" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->AmountPaid->EditValue ?>"<?php echo $licence_account_add->AmountPaid->editAttributes() ?>>
</span>
<?php echo $licence_account_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_licence_account_BillPeriod" for="x_BillPeriod" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->BillPeriod->caption() ?><?php echo $licence_account_add->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->BillPeriod->cellAttributes() ?>>
<span id="el_licence_account_BillPeriod">
<input type="text" data-table="licence_account" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->BillPeriod->EditValue ?>"<?php echo $licence_account_add->BillPeriod->editAttributes() ?>>
</span>
<?php echo $licence_account_add->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_licence_account_PeriodType" for="x_PeriodType" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->PeriodType->caption() ?><?php echo $licence_account_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->PeriodType->cellAttributes() ?>>
<span id="el_licence_account_PeriodType">
<input type="text" data-table="licence_account" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->PeriodType->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->PeriodType->EditValue ?>"<?php echo $licence_account_add->PeriodType->editAttributes() ?>>
</span>
<?php echo $licence_account_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_licence_account_BillYear" for="x_BillYear" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->BillYear->caption() ?><?php echo $licence_account_add->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->BillYear->cellAttributes() ?>>
<span id="el_licence_account_BillYear">
<input type="text" data-table="licence_account" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($licence_account_add->BillYear->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->BillYear->EditValue ?>"<?php echo $licence_account_add->BillYear->editAttributes() ?>>
</span>
<?php echo $licence_account_add->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_licence_account_StartDate" for="x_StartDate" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->StartDate->caption() ?><?php echo $licence_account_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->StartDate->cellAttributes() ?>>
<span id="el_licence_account_StartDate">
<input type="text" data-table="licence_account" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($licence_account_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->StartDate->EditValue ?>"<?php echo $licence_account_add->StartDate->editAttributes() ?>>
</span>
<?php echo $licence_account_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_licence_account_EndDate" for="x_EndDate" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->EndDate->caption() ?><?php echo $licence_account_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->EndDate->cellAttributes() ?>>
<span id="el_licence_account_EndDate">
<input type="text" data-table="licence_account" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($licence_account_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->EndDate->EditValue ?>"<?php echo $licence_account_add->EndDate->editAttributes() ?>>
</span>
<?php echo $licence_account_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_licence_account_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->LastUpdatedBy->caption() ?><?php echo $licence_account_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_licence_account_LastUpdatedBy">
<input type="text" data-table="licence_account" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($licence_account_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->LastUpdatedBy->EditValue ?>"<?php echo $licence_account_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $licence_account_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_licence_account_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $licence_account_add->LeftColumnClass ?>"><?php echo $licence_account_add->LastUpdateDate->caption() ?><?php echo $licence_account_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_add->RightColumnClass ?>"><div <?php echo $licence_account_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_licence_account_LastUpdateDate">
<input type="text" data-table="licence_account" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($licence_account_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_add->LastUpdateDate->EditValue ?>"<?php echo $licence_account_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $licence_account_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($licence_account->getCurrentDetailTable() != "") { ?>
<?php
	$licence_account_add->DetailPages->ValidKeys = explode(",", $licence_account->getCurrentDetailTable());
	$firstActiveDetailTable = $licence_account_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="licence_account_add_details"><!-- tabs -->
	<ul class="<?php echo $licence_account_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("health_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $health_certificate->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "health_certificate") {
			$firstActiveDetailTable = "health_certificate";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $licence_account_add->DetailPages->pageStyle("health_certificate") ?>" href="#tab_health_certificate" data-toggle="tab"><?php echo $Language->tablePhrase("health_certificate", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("fire_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $fire_certificate->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "fire_certificate") {
			$firstActiveDetailTable = "fire_certificate";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $licence_account_add->DetailPages->pageStyle("fire_certificate") ?>" href="#tab_fire_certificate" data-toggle="tab"><?php echo $Language->tablePhrase("fire_certificate", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("health_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $health_certificate->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "health_certificate")
			$firstActiveDetailTable = "health_certificate";
?>
		<div class="tab-pane <?php echo $licence_account_add->DetailPages->pageStyle("health_certificate") ?>" id="tab_health_certificate"><!-- page* -->
<?php include_once "health_certificategrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("fire_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $fire_certificate->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "fire_certificate")
			$firstActiveDetailTable = "fire_certificate";
?>
		<div class="tab-pane <?php echo $licence_account_add->DetailPages->pageStyle("fire_certificate") ?>" id="tab_fire_certificate"><!-- page* -->
<?php include_once "fire_certificategrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$licence_account_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $licence_account_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $licence_account_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$licence_account_add->showPageFooter();
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
$licence_account_add->terminate();
?>