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
$fire_certificate_edit = new fire_certificate_edit();

// Run the page
$fire_certificate_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fire_certificate_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffire_certificateedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ffire_certificateedit = currentForm = new ew.Form("ffire_certificateedit", "edit");

	// Validate form
	ffire_certificateedit.validate = function() {
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
			<?php if ($fire_certificate_edit->FireCertificateNo->Required) { ?>
				elm = this.getElements("x" + infix + "_FireCertificateNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->FireCertificateNo->caption(), $fire_certificate_edit->FireCertificateNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_edit->LicenceNo->Required) { ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->LicenceNo->caption(), $fire_certificate_edit->LicenceNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->LicenceNo->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->BusinessNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->BusinessNo->caption(), $fire_certificate_edit->BusinessNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->BusinessNo->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->InspectionReport->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectionReport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->InspectionReport->caption(), $fire_certificate_edit->InspectionReport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_edit->InspectionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->InspectionDate->caption(), $fire_certificate_edit->InspectionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_InspectionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->InspectionDate->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->InspectedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->InspectedBy->caption(), $fire_certificate_edit->InspectedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_edit->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->ChargeCode->caption(), $fire_certificate_edit->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->ChargeCode->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->ChargeGroup->caption(), $fire_certificate_edit->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->ChargeGroup->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->BalanceBF->caption(), $fire_certificate_edit->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->BalanceBF->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->CurrentDemand->caption(), $fire_certificate_edit->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->CurrentDemand->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->VAT->caption(), $fire_certificate_edit->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->VAT->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->AmountPaid->caption(), $fire_certificate_edit->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->AmountPaid->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->BillPeriod->caption(), $fire_certificate_edit->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->BillPeriod->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->PeriodType->caption(), $fire_certificate_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_edit->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->BillYear->caption(), $fire_certificate_edit->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->BillYear->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->StartDate->caption(), $fire_certificate_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->StartDate->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->EndDate->caption(), $fire_certificate_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->EndDate->errorMessage()) ?>");
			<?php if ($fire_certificate_edit->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->LastUpdatedBy->caption(), $fire_certificate_edit->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_edit->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_edit->LastUpdateDate->caption(), $fire_certificate_edit->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_edit->LastUpdateDate->errorMessage()) ?>");

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
	ffire_certificateedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffire_certificateedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ffire_certificateedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $fire_certificate_edit->showPageHeader(); ?>
<?php
$fire_certificate_edit->showMessage();
?>
<?php if (!$fire_certificate_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $fire_certificate_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="ffire_certificateedit" id="ffire_certificateedit" class="<?php echo $fire_certificate_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fire_certificate">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$fire_certificate_edit->IsModal ?>">
<?php if ($fire_certificate->getCurrentMasterTable() == "licence_account") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="licence_account">
<input type="hidden" name="fk_LicenceNo" value="<?php echo HtmlEncode($fire_certificate_edit->LicenceNo->getSessionValue()) ?>">
<input type="hidden" name="fk_BusinessNo" value="<?php echo HtmlEncode($fire_certificate_edit->BusinessNo->getSessionValue()) ?>">
<input type="hidden" name="fk_BillPeriod" value="<?php echo HtmlEncode($fire_certificate_edit->BillPeriod->getSessionValue()) ?>">
<input type="hidden" name="fk_PeriodType" value="<?php echo HtmlEncode($fire_certificate_edit->PeriodType->getSessionValue()) ?>">
<input type="hidden" name="fk_BillYear" value="<?php echo HtmlEncode($fire_certificate_edit->BillYear->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($fire_certificate_edit->FireCertificateNo->Visible) { // FireCertificateNo ?>
	<div id="r_FireCertificateNo" class="form-group row">
		<label id="elh_fire_certificate_FireCertificateNo" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->FireCertificateNo->caption() ?><?php echo $fire_certificate_edit->FireCertificateNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->FireCertificateNo->cellAttributes() ?>>
<span id="el_fire_certificate_FireCertificateNo">
<span<?php echo $fire_certificate_edit->FireCertificateNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_edit->FireCertificateNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="fire_certificate" data-field="x_FireCertificateNo" name="x_FireCertificateNo" id="x_FireCertificateNo" value="<?php echo HtmlEncode($fire_certificate_edit->FireCertificateNo->CurrentValue) ?>">
<?php echo $fire_certificate_edit->FireCertificateNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->LicenceNo->Visible) { // LicenceNo ?>
	<div id="r_LicenceNo" class="form-group row">
		<label id="elh_fire_certificate_LicenceNo" for="x_LicenceNo" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->LicenceNo->caption() ?><?php echo $fire_certificate_edit->LicenceNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->LicenceNo->cellAttributes() ?>>
<?php if ($fire_certificate_edit->LicenceNo->getSessionValue() != "") { ?>

<span id="el_fire_certificate_LicenceNo">
<span<?php echo $fire_certificate_edit->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_edit->LicenceNo->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_LicenceNo" name="x_LicenceNo" value="<?php echo HtmlEncode($fire_certificate_edit->LicenceNo->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="fire_certificate" data-field="x_LicenceNo" name="x_LicenceNo" id="x_LicenceNo" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->LicenceNo->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->LicenceNo->EditValue ?>"<?php echo $fire_certificate_edit->LicenceNo->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="fire_certificate" data-field="x_LicenceNo" name="o_LicenceNo" id="o_LicenceNo" value="<?php echo HtmlEncode($fire_certificate_edit->LicenceNo->OldValue != null ? $fire_certificate_edit->LicenceNo->OldValue : $fire_certificate_edit->LicenceNo->CurrentValue) ?>">
<?php echo $fire_certificate_edit->LicenceNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->BusinessNo->Visible) { // BusinessNo ?>
	<div id="r_BusinessNo" class="form-group row">
		<label id="elh_fire_certificate_BusinessNo" for="x_BusinessNo" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->BusinessNo->caption() ?><?php echo $fire_certificate_edit->BusinessNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->BusinessNo->cellAttributes() ?>>
<?php if ($fire_certificate_edit->BusinessNo->getSessionValue() != "") { ?>
<span id="el_fire_certificate_BusinessNo">
<span<?php echo $fire_certificate_edit->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_edit->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BusinessNo" name="x_BusinessNo" value="<?php echo HtmlEncode($fire_certificate_edit->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_BusinessNo">
<input type="text" data-table="fire_certificate" data-field="x_BusinessNo" name="x_BusinessNo" id="x_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->BusinessNo->EditValue ?>"<?php echo $fire_certificate_edit->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_edit->BusinessNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->InspectionReport->Visible) { // InspectionReport ?>
	<div id="r_InspectionReport" class="form-group row">
		<label id="elh_fire_certificate_InspectionReport" for="x_InspectionReport" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->InspectionReport->caption() ?><?php echo $fire_certificate_edit->InspectionReport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->InspectionReport->cellAttributes() ?>>
<span id="el_fire_certificate_InspectionReport">
<textarea data-table="fire_certificate" data-field="x_InspectionReport" name="x_InspectionReport" id="x_InspectionReport" cols="35" rows="4" placeholder="<?php echo HtmlEncode($fire_certificate_edit->InspectionReport->getPlaceHolder()) ?>"<?php echo $fire_certificate_edit->InspectionReport->editAttributes() ?>><?php echo $fire_certificate_edit->InspectionReport->EditValue ?></textarea>
</span>
<?php echo $fire_certificate_edit->InspectionReport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->InspectionDate->Visible) { // InspectionDate ?>
	<div id="r_InspectionDate" class="form-group row">
		<label id="elh_fire_certificate_InspectionDate" for="x_InspectionDate" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->InspectionDate->caption() ?><?php echo $fire_certificate_edit->InspectionDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->InspectionDate->cellAttributes() ?>>
<span id="el_fire_certificate_InspectionDate">
<input type="text" data-table="fire_certificate" data-field="x_InspectionDate" name="x_InspectionDate" id="x_InspectionDate" placeholder="<?php echo HtmlEncode($fire_certificate_edit->InspectionDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->InspectionDate->EditValue ?>"<?php echo $fire_certificate_edit->InspectionDate->editAttributes() ?>>
<?php if (!$fire_certificate_edit->InspectionDate->ReadOnly && !$fire_certificate_edit->InspectionDate->Disabled && !isset($fire_certificate_edit->InspectionDate->EditAttrs["readonly"]) && !isset($fire_certificate_edit->InspectionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateedit", "x_InspectionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_edit->InspectionDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->InspectedBy->Visible) { // InspectedBy ?>
	<div id="r_InspectedBy" class="form-group row">
		<label id="elh_fire_certificate_InspectedBy" for="x_InspectedBy" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->InspectedBy->caption() ?><?php echo $fire_certificate_edit->InspectedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->InspectedBy->cellAttributes() ?>>
<span id="el_fire_certificate_InspectedBy">
<input type="text" data-table="fire_certificate" data-field="x_InspectedBy" name="x_InspectedBy" id="x_InspectedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($fire_certificate_edit->InspectedBy->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->InspectedBy->EditValue ?>"<?php echo $fire_certificate_edit->InspectedBy->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->InspectedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_fire_certificate_ChargeCode" for="x_ChargeCode" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->ChargeCode->caption() ?><?php echo $fire_certificate_edit->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->ChargeCode->cellAttributes() ?>>
<span id="el_fire_certificate_ChargeCode">
<input type="text" data-table="fire_certificate" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->ChargeCode->EditValue ?>"<?php echo $fire_certificate_edit->ChargeCode->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_fire_certificate_ChargeGroup" for="x_ChargeGroup" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->ChargeGroup->caption() ?><?php echo $fire_certificate_edit->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->ChargeGroup->cellAttributes() ?>>
<span id="el_fire_certificate_ChargeGroup">
<input type="text" data-table="fire_certificate" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->ChargeGroup->EditValue ?>"<?php echo $fire_certificate_edit->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_fire_certificate_BalanceBF" for="x_BalanceBF" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->BalanceBF->caption() ?><?php echo $fire_certificate_edit->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->BalanceBF->cellAttributes() ?>>
<span id="el_fire_certificate_BalanceBF">
<input type="text" data-table="fire_certificate" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->BalanceBF->EditValue ?>"<?php echo $fire_certificate_edit->BalanceBF->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_fire_certificate_CurrentDemand" for="x_CurrentDemand" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->CurrentDemand->caption() ?><?php echo $fire_certificate_edit->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->CurrentDemand->cellAttributes() ?>>
<span id="el_fire_certificate_CurrentDemand">
<input type="text" data-table="fire_certificate" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->CurrentDemand->EditValue ?>"<?php echo $fire_certificate_edit->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_fire_certificate_VAT" for="x_VAT" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->VAT->caption() ?><?php echo $fire_certificate_edit->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->VAT->cellAttributes() ?>>
<span id="el_fire_certificate_VAT">
<input type="text" data-table="fire_certificate" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->VAT->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->VAT->EditValue ?>"<?php echo $fire_certificate_edit->VAT->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_fire_certificate_AmountPaid" for="x_AmountPaid" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->AmountPaid->caption() ?><?php echo $fire_certificate_edit->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->AmountPaid->cellAttributes() ?>>
<span id="el_fire_certificate_AmountPaid">
<input type="text" data-table="fire_certificate" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->AmountPaid->EditValue ?>"<?php echo $fire_certificate_edit->AmountPaid->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_fire_certificate_BillPeriod" for="x_BillPeriod" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->BillPeriod->caption() ?><?php echo $fire_certificate_edit->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->BillPeriod->cellAttributes() ?>>
<?php if ($fire_certificate_edit->BillPeriod->getSessionValue() != "") { ?>
<span id="el_fire_certificate_BillPeriod">
<span<?php echo $fire_certificate_edit->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_edit->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BillPeriod" name="x_BillPeriod" value="<?php echo HtmlEncode($fire_certificate_edit->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_BillPeriod">
<input type="text" data-table="fire_certificate" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->BillPeriod->EditValue ?>"<?php echo $fire_certificate_edit->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_edit->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_fire_certificate_PeriodType" for="x_PeriodType" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->PeriodType->caption() ?><?php echo $fire_certificate_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->PeriodType->cellAttributes() ?>>
<?php if ($fire_certificate_edit->PeriodType->getSessionValue() != "") { ?>
<span id="el_fire_certificate_PeriodType">
<span<?php echo $fire_certificate_edit->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_edit->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_PeriodType" name="x_PeriodType" value="<?php echo HtmlEncode($fire_certificate_edit->PeriodType->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_PeriodType">
<input type="text" data-table="fire_certificate" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($fire_certificate_edit->PeriodType->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->PeriodType->EditValue ?>"<?php echo $fire_certificate_edit->PeriodType->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_fire_certificate_BillYear" for="x_BillYear" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->BillYear->caption() ?><?php echo $fire_certificate_edit->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->BillYear->cellAttributes() ?>>
<?php if ($fire_certificate_edit->BillYear->getSessionValue() != "") { ?>
<span id="el_fire_certificate_BillYear">
<span<?php echo $fire_certificate_edit->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_edit->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BillYear" name="x_BillYear" value="<?php echo HtmlEncode($fire_certificate_edit->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_BillYear">
<input type="text" data-table="fire_certificate" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_edit->BillYear->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->BillYear->EditValue ?>"<?php echo $fire_certificate_edit->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_edit->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_fire_certificate_StartDate" for="x_StartDate" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->StartDate->caption() ?><?php echo $fire_certificate_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->StartDate->cellAttributes() ?>>
<span id="el_fire_certificate_StartDate">
<input type="text" data-table="fire_certificate" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($fire_certificate_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->StartDate->EditValue ?>"<?php echo $fire_certificate_edit->StartDate->editAttributes() ?>>
<?php if (!$fire_certificate_edit->StartDate->ReadOnly && !$fire_certificate_edit->StartDate->Disabled && !isset($fire_certificate_edit->StartDate->EditAttrs["readonly"]) && !isset($fire_certificate_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_fire_certificate_EndDate" for="x_EndDate" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->EndDate->caption() ?><?php echo $fire_certificate_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->EndDate->cellAttributes() ?>>
<span id="el_fire_certificate_EndDate">
<input type="text" data-table="fire_certificate" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($fire_certificate_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->EndDate->EditValue ?>"<?php echo $fire_certificate_edit->EndDate->editAttributes() ?>>
<?php if (!$fire_certificate_edit->EndDate->ReadOnly && !$fire_certificate_edit->EndDate->Disabled && !isset($fire_certificate_edit->EndDate->EditAttrs["readonly"]) && !isset($fire_certificate_edit->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateedit", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_fire_certificate_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->LastUpdatedBy->caption() ?><?php echo $fire_certificate_edit->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->LastUpdatedBy->cellAttributes() ?>>
<span id="el_fire_certificate_LastUpdatedBy">
<input type="text" data-table="fire_certificate" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($fire_certificate_edit->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->LastUpdatedBy->EditValue ?>"<?php echo $fire_certificate_edit->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $fire_certificate_edit->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_edit->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_fire_certificate_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $fire_certificate_edit->LeftColumnClass ?>"><?php echo $fire_certificate_edit->LastUpdateDate->caption() ?><?php echo $fire_certificate_edit->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_edit->RightColumnClass ?>"><div <?php echo $fire_certificate_edit->LastUpdateDate->cellAttributes() ?>>
<span id="el_fire_certificate_LastUpdateDate">
<input type="text" data-table="fire_certificate" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($fire_certificate_edit->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_edit->LastUpdateDate->EditValue ?>"<?php echo $fire_certificate_edit->LastUpdateDate->editAttributes() ?>>
<?php if (!$fire_certificate_edit->LastUpdateDate->ReadOnly && !$fire_certificate_edit->LastUpdateDate->Disabled && !isset($fire_certificate_edit->LastUpdateDate->EditAttrs["readonly"]) && !isset($fire_certificate_edit->LastUpdateDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateedit", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateedit", "x_LastUpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_edit->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$fire_certificate_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $fire_certificate_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fire_certificate_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$fire_certificate_edit->IsModal) { ?>
<?php echo $fire_certificate_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$fire_certificate_edit->showPageFooter();
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
$fire_certificate_edit->terminate();
?>