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
$licence_account_edit = new licence_account_edit();

// Run the page
$licence_account_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$licence_account_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flicence_accountedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	flicence_accountedit = currentForm = new ew.Form("flicence_accountedit", "edit");

	// Validate form
	flicence_accountedit.validate = function() {
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
			<?php if ($licence_account_edit->LicenceNo->Required) { ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->LicenceNo->caption(), $licence_account_edit->LicenceNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_edit->BusinessNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->BusinessNo->caption(), $licence_account_edit->BusinessNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->BusinessNo->errorMessage()) ?>");
			<?php if ($licence_account_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->ClientID->caption(), $licence_account_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_edit->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->ChargeCode->caption(), $licence_account_edit->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->ChargeCode->errorMessage()) ?>");
			<?php if ($licence_account_edit->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->ChargeGroup->caption(), $licence_account_edit->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->ChargeGroup->errorMessage()) ?>");
			<?php if ($licence_account_edit->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->BalanceBF->caption(), $licence_account_edit->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->BalanceBF->errorMessage()) ?>");
			<?php if ($licence_account_edit->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->CurrentDemand->caption(), $licence_account_edit->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->CurrentDemand->errorMessage()) ?>");
			<?php if ($licence_account_edit->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->VAT->caption(), $licence_account_edit->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->VAT->errorMessage()) ?>");
			<?php if ($licence_account_edit->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->AmountPaid->caption(), $licence_account_edit->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->AmountPaid->errorMessage()) ?>");
			<?php if ($licence_account_edit->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->BillPeriod->caption(), $licence_account_edit->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->BillPeriod->errorMessage()) ?>");
			<?php if ($licence_account_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->PeriodType->caption(), $licence_account_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->PeriodType->errorMessage()) ?>");
			<?php if ($licence_account_edit->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->BillYear->caption(), $licence_account_edit->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->BillYear->errorMessage()) ?>");
			<?php if ($licence_account_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->StartDate->caption(), $licence_account_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->StartDate->errorMessage()) ?>");
			<?php if ($licence_account_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->EndDate->caption(), $licence_account_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->EndDate->errorMessage()) ?>");
			<?php if ($licence_account_edit->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->LastUpdatedBy->caption(), $licence_account_edit->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_edit->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_edit->LastUpdateDate->caption(), $licence_account_edit->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_edit->LastUpdateDate->errorMessage()) ?>");

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
	flicence_accountedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flicence_accountedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flicence_accountedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $licence_account_edit->showPageHeader(); ?>
<?php
$licence_account_edit->showMessage();
?>
<?php if (!$licence_account_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $licence_account_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="flicence_accountedit" id="flicence_accountedit" class="<?php echo $licence_account_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="licence_account">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$licence_account_edit->IsModal ?>">
<?php if ($licence_account->getCurrentMasterTable() == "business") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="business">
<input type="hidden" name="fk_BusinessID" value="<?php echo HtmlEncode($licence_account_edit->BusinessNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($licence_account_edit->LicenceNo->Visible) { // LicenceNo ?>
	<div id="r_LicenceNo" class="form-group row">
		<label id="elh_licence_account_LicenceNo" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->LicenceNo->caption() ?><?php echo $licence_account_edit->LicenceNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->LicenceNo->cellAttributes() ?>>
<span id="el_licence_account_LicenceNo">
<span<?php echo $licence_account_edit->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_edit->LicenceNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="x_LicenceNo" id="x_LicenceNo" value="<?php echo HtmlEncode($licence_account_edit->LicenceNo->CurrentValue) ?>">
<?php echo $licence_account_edit->LicenceNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->BusinessNo->Visible) { // BusinessNo ?>
	<div id="r_BusinessNo" class="form-group row">
		<label id="elh_licence_account_BusinessNo" for="x_BusinessNo" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->BusinessNo->caption() ?><?php echo $licence_account_edit->BusinessNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->BusinessNo->cellAttributes() ?>>
<?php if ($licence_account_edit->BusinessNo->getSessionValue() != "") { ?>
<span id="el_licence_account_BusinessNo">
<span<?php echo $licence_account_edit->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_edit->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BusinessNo" name="x_BusinessNo" value="<?php echo HtmlEncode($licence_account_edit->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_licence_account_BusinessNo">
<input type="text" data-table="licence_account" data-field="x_BusinessNo" name="x_BusinessNo" id="x_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->BusinessNo->EditValue ?>"<?php echo $licence_account_edit->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $licence_account_edit->BusinessNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_licence_account_ClientID" for="x_ClientID" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->ClientID->caption() ?><?php echo $licence_account_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->ClientID->cellAttributes() ?>>
<span id="el_licence_account_ClientID">
<input type="text" data-table="licence_account" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($licence_account_edit->ClientID->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->ClientID->EditValue ?>"<?php echo $licence_account_edit->ClientID->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_licence_account_ChargeCode" for="x_ChargeCode" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->ChargeCode->caption() ?><?php echo $licence_account_edit->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->ChargeCode->cellAttributes() ?>>
<span id="el_licence_account_ChargeCode">
<input type="text" data-table="licence_account" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->ChargeCode->EditValue ?>"<?php echo $licence_account_edit->ChargeCode->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_licence_account_ChargeGroup" for="x_ChargeGroup" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->ChargeGroup->caption() ?><?php echo $licence_account_edit->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->ChargeGroup->cellAttributes() ?>>
<span id="el_licence_account_ChargeGroup">
<input type="text" data-table="licence_account" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->ChargeGroup->EditValue ?>"<?php echo $licence_account_edit->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_licence_account_BalanceBF" for="x_BalanceBF" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->BalanceBF->caption() ?><?php echo $licence_account_edit->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->BalanceBF->cellAttributes() ?>>
<span id="el_licence_account_BalanceBF">
<input type="text" data-table="licence_account" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->BalanceBF->EditValue ?>"<?php echo $licence_account_edit->BalanceBF->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_licence_account_CurrentDemand" for="x_CurrentDemand" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->CurrentDemand->caption() ?><?php echo $licence_account_edit->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->CurrentDemand->cellAttributes() ?>>
<span id="el_licence_account_CurrentDemand">
<input type="text" data-table="licence_account" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->CurrentDemand->EditValue ?>"<?php echo $licence_account_edit->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_licence_account_VAT" for="x_VAT" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->VAT->caption() ?><?php echo $licence_account_edit->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->VAT->cellAttributes() ?>>
<span id="el_licence_account_VAT">
<input type="text" data-table="licence_account" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->VAT->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->VAT->EditValue ?>"<?php echo $licence_account_edit->VAT->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_licence_account_AmountPaid" for="x_AmountPaid" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->AmountPaid->caption() ?><?php echo $licence_account_edit->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->AmountPaid->cellAttributes() ?>>
<span id="el_licence_account_AmountPaid">
<input type="text" data-table="licence_account" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->AmountPaid->EditValue ?>"<?php echo $licence_account_edit->AmountPaid->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_licence_account_BillPeriod" for="x_BillPeriod" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->BillPeriod->caption() ?><?php echo $licence_account_edit->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->BillPeriod->cellAttributes() ?>>
<span id="el_licence_account_BillPeriod">
<input type="text" data-table="licence_account" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->BillPeriod->EditValue ?>"<?php echo $licence_account_edit->BillPeriod->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_licence_account_PeriodType" for="x_PeriodType" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->PeriodType->caption() ?><?php echo $licence_account_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->PeriodType->cellAttributes() ?>>
<span id="el_licence_account_PeriodType">
<input type="text" data-table="licence_account" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->PeriodType->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->PeriodType->EditValue ?>"<?php echo $licence_account_edit->PeriodType->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_licence_account_BillYear" for="x_BillYear" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->BillYear->caption() ?><?php echo $licence_account_edit->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->BillYear->cellAttributes() ?>>
<span id="el_licence_account_BillYear">
<input type="text" data-table="licence_account" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($licence_account_edit->BillYear->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->BillYear->EditValue ?>"<?php echo $licence_account_edit->BillYear->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_licence_account_StartDate" for="x_StartDate" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->StartDate->caption() ?><?php echo $licence_account_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->StartDate->cellAttributes() ?>>
<span id="el_licence_account_StartDate">
<input type="text" data-table="licence_account" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($licence_account_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->StartDate->EditValue ?>"<?php echo $licence_account_edit->StartDate->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_licence_account_EndDate" for="x_EndDate" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->EndDate->caption() ?><?php echo $licence_account_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->EndDate->cellAttributes() ?>>
<span id="el_licence_account_EndDate">
<input type="text" data-table="licence_account" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($licence_account_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->EndDate->EditValue ?>"<?php echo $licence_account_edit->EndDate->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_licence_account_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->LastUpdatedBy->caption() ?><?php echo $licence_account_edit->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->LastUpdatedBy->cellAttributes() ?>>
<span id="el_licence_account_LastUpdatedBy">
<input type="text" data-table="licence_account" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($licence_account_edit->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->LastUpdatedBy->EditValue ?>"<?php echo $licence_account_edit->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($licence_account_edit->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_licence_account_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $licence_account_edit->LeftColumnClass ?>"><?php echo $licence_account_edit->LastUpdateDate->caption() ?><?php echo $licence_account_edit->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $licence_account_edit->RightColumnClass ?>"><div <?php echo $licence_account_edit->LastUpdateDate->cellAttributes() ?>>
<span id="el_licence_account_LastUpdateDate">
<input type="text" data-table="licence_account" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($licence_account_edit->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_edit->LastUpdateDate->EditValue ?>"<?php echo $licence_account_edit->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $licence_account_edit->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($licence_account->getCurrentDetailTable() != "") { ?>
<?php
	$licence_account_edit->DetailPages->ValidKeys = explode(",", $licence_account->getCurrentDetailTable());
	$firstActiveDetailTable = $licence_account_edit->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="licence_account_edit_details"><!-- tabs -->
	<ul class="<?php echo $licence_account_edit->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("health_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $health_certificate->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "health_certificate") {
			$firstActiveDetailTable = "health_certificate";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $licence_account_edit->DetailPages->pageStyle("health_certificate") ?>" href="#tab_health_certificate" data-toggle="tab"><?php echo $Language->tablePhrase("health_certificate", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("fire_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $fire_certificate->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "fire_certificate") {
			$firstActiveDetailTable = "fire_certificate";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $licence_account_edit->DetailPages->pageStyle("fire_certificate") ?>" href="#tab_fire_certificate" data-toggle="tab"><?php echo $Language->tablePhrase("fire_certificate", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("health_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $health_certificate->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "health_certificate")
			$firstActiveDetailTable = "health_certificate";
?>
		<div class="tab-pane <?php echo $licence_account_edit->DetailPages->pageStyle("health_certificate") ?>" id="tab_health_certificate"><!-- page* -->
<?php include_once "health_certificategrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("fire_certificate", explode(",", $licence_account->getCurrentDetailTable())) && $fire_certificate->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "fire_certificate")
			$firstActiveDetailTable = "fire_certificate";
?>
		<div class="tab-pane <?php echo $licence_account_edit->DetailPages->pageStyle("fire_certificate") ?>" id="tab_fire_certificate"><!-- page* -->
<?php include_once "fire_certificategrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$licence_account_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $licence_account_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $licence_account_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$licence_account_edit->IsModal) { ?>
<?php echo $licence_account_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$licence_account_edit->showPageFooter();
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
$licence_account_edit->terminate();
?>