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
$health_certificate_search = new health_certificate_search();

// Run the page
$health_certificate_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$health_certificate_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhealth_certificatesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($health_certificate_search->IsModal) { ?>
	fhealth_certificatesearch = currentAdvancedSearchForm = new ew.Form("fhealth_certificatesearch", "search");
	<?php } else { ?>
	fhealth_certificatesearch = currentForm = new ew.Form("fhealth_certificatesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fhealth_certificatesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_HealthCertificateNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->HealthCertificateNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LicenceNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->LicenceNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BusinessNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->BusinessNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_InspectionDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->InspectionDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ChargeGroup");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->ChargeGroup->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BalanceBF");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->BalanceBF->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_CurrentDemand");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->CurrentDemand->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_VAT");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->VAT->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AmountPaid");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->AmountPaid->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->BillYear->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_StartDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->StartDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EndDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->EndDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_LastUpdateDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($health_certificate_search->LastUpdateDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fhealth_certificatesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhealth_certificatesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fhealth_certificatesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $health_certificate_search->showPageHeader(); ?>
<?php
$health_certificate_search->showMessage();
?>
<form name="fhealth_certificatesearch" id="fhealth_certificatesearch" class="<?php echo $health_certificate_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="health_certificate">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$health_certificate_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($health_certificate_search->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
	<div id="r_HealthCertificateNo" class="form-group row">
		<label for="x_HealthCertificateNo" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_HealthCertificateNo"><?php echo $health_certificate_search->HealthCertificateNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_HealthCertificateNo" id="z_HealthCertificateNo" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->HealthCertificateNo->cellAttributes() ?>>
			<span id="el_health_certificate_HealthCertificateNo" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_HealthCertificateNo" name="x_HealthCertificateNo" id="x_HealthCertificateNo" placeholder="<?php echo HtmlEncode($health_certificate_search->HealthCertificateNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->HealthCertificateNo->EditValue ?>"<?php echo $health_certificate_search->HealthCertificateNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->LicenceNo->Visible) { // LicenceNo ?>
	<div id="r_LicenceNo" class="form-group row">
		<label for="x_LicenceNo" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_LicenceNo"><?php echo $health_certificate_search->LicenceNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LicenceNo" id="z_LicenceNo" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->LicenceNo->cellAttributes() ?>>
			<span id="el_health_certificate_LicenceNo" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_LicenceNo" name="x_LicenceNo" id="x_LicenceNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->LicenceNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->LicenceNo->EditValue ?>"<?php echo $health_certificate_search->LicenceNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->BusinessNo->Visible) { // BusinessNo ?>
	<div id="r_BusinessNo" class="form-group row">
		<label for="x_BusinessNo" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_BusinessNo"><?php echo $health_certificate_search->BusinessNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BusinessNo" id="z_BusinessNo" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->BusinessNo->cellAttributes() ?>>
			<span id="el_health_certificate_BusinessNo" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_BusinessNo" name="x_BusinessNo" id="x_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->BusinessNo->EditValue ?>"<?php echo $health_certificate_search->BusinessNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->InspectionReport->Visible) { // InspectionReport ?>
	<div id="r_InspectionReport" class="form-group row">
		<label for="x_InspectionReport" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_InspectionReport"><?php echo $health_certificate_search->InspectionReport->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_InspectionReport" id="z_InspectionReport" value="LIKE">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->InspectionReport->cellAttributes() ?>>
			<span id="el_health_certificate_InspectionReport" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_InspectionReport" name="x_InspectionReport" id="x_InspectionReport" size="35" placeholder="<?php echo HtmlEncode($health_certificate_search->InspectionReport->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->InspectionReport->EditValue ?>"<?php echo $health_certificate_search->InspectionReport->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->InspectionDate->Visible) { // InspectionDate ?>
	<div id="r_InspectionDate" class="form-group row">
		<label for="x_InspectionDate" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_InspectionDate"><?php echo $health_certificate_search->InspectionDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_InspectionDate" id="z_InspectionDate" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->InspectionDate->cellAttributes() ?>>
			<span id="el_health_certificate_InspectionDate" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_InspectionDate" name="x_InspectionDate" id="x_InspectionDate" placeholder="<?php echo HtmlEncode($health_certificate_search->InspectionDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->InspectionDate->EditValue ?>"<?php echo $health_certificate_search->InspectionDate->editAttributes() ?>>
<?php if (!$health_certificate_search->InspectionDate->ReadOnly && !$health_certificate_search->InspectionDate->Disabled && !isset($health_certificate_search->InspectionDate->EditAttrs["readonly"]) && !isset($health_certificate_search->InspectionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificatesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificatesearch", "x_InspectionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->InspectedBy->Visible) { // InspectedBy ?>
	<div id="r_InspectedBy" class="form-group row">
		<label for="x_InspectedBy" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_InspectedBy"><?php echo $health_certificate_search->InspectedBy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_InspectedBy" id="z_InspectedBy" value="LIKE">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->InspectedBy->cellAttributes() ?>>
			<span id="el_health_certificate_InspectedBy" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_InspectedBy" name="x_InspectedBy" id="x_InspectedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($health_certificate_search->InspectedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->InspectedBy->EditValue ?>"<?php echo $health_certificate_search->InspectedBy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label for="x_ChargeCode" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_ChargeCode"><?php echo $health_certificate_search->ChargeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->ChargeCode->cellAttributes() ?>>
			<span id="el_health_certificate_ChargeCode" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->ChargeCode->EditValue ?>"<?php echo $health_certificate_search->ChargeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label for="x_ChargeGroup" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_ChargeGroup"><?php echo $health_certificate_search->ChargeGroup->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeGroup" id="z_ChargeGroup" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->ChargeGroup->cellAttributes() ?>>
			<span id="el_health_certificate_ChargeGroup" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->ChargeGroup->EditValue ?>"<?php echo $health_certificate_search->ChargeGroup->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label for="x_BalanceBF" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_BalanceBF"><?php echo $health_certificate_search->BalanceBF->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BalanceBF" id="z_BalanceBF" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->BalanceBF->cellAttributes() ?>>
			<span id="el_health_certificate_BalanceBF" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->BalanceBF->EditValue ?>"<?php echo $health_certificate_search->BalanceBF->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label for="x_CurrentDemand" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_CurrentDemand"><?php echo $health_certificate_search->CurrentDemand->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CurrentDemand" id="z_CurrentDemand" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->CurrentDemand->cellAttributes() ?>>
			<span id="el_health_certificate_CurrentDemand" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->CurrentDemand->EditValue ?>"<?php echo $health_certificate_search->CurrentDemand->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label for="x_VAT" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_VAT"><?php echo $health_certificate_search->VAT->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VAT" id="z_VAT" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->VAT->cellAttributes() ?>>
			<span id="el_health_certificate_VAT" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->VAT->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->VAT->EditValue ?>"<?php echo $health_certificate_search->VAT->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label for="x_AmountPaid" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_AmountPaid"><?php echo $health_certificate_search->AmountPaid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AmountPaid" id="z_AmountPaid" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->AmountPaid->cellAttributes() ?>>
			<span id="el_health_certificate_AmountPaid" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->AmountPaid->EditValue ?>"<?php echo $health_certificate_search->AmountPaid->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label for="x_BillPeriod" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_BillPeriod"><?php echo $health_certificate_search->BillPeriod->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->BillPeriod->cellAttributes() ?>>
			<span id="el_health_certificate_BillPeriod" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->BillPeriod->EditValue ?>"<?php echo $health_certificate_search->BillPeriod->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label for="x_PeriodType" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_PeriodType"><?php echo $health_certificate_search->PeriodType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PeriodType" id="z_PeriodType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->PeriodType->cellAttributes() ?>>
			<span id="el_health_certificate_PeriodType" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($health_certificate_search->PeriodType->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->PeriodType->EditValue ?>"<?php echo $health_certificate_search->PeriodType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label for="x_BillYear" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_BillYear"><?php echo $health_certificate_search->BillYear->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->BillYear->cellAttributes() ?>>
			<span id="el_health_certificate_BillYear" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($health_certificate_search->BillYear->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->BillYear->EditValue ?>"<?php echo $health_certificate_search->BillYear->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label for="x_StartDate" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_StartDate"><?php echo $health_certificate_search->StartDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_StartDate" id="z_StartDate" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->StartDate->cellAttributes() ?>>
			<span id="el_health_certificate_StartDate" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($health_certificate_search->StartDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->StartDate->EditValue ?>"<?php echo $health_certificate_search->StartDate->editAttributes() ?>>
<?php if (!$health_certificate_search->StartDate->ReadOnly && !$health_certificate_search->StartDate->Disabled && !isset($health_certificate_search->StartDate->EditAttrs["readonly"]) && !isset($health_certificate_search->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificatesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificatesearch", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label for="x_EndDate" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_EndDate"><?php echo $health_certificate_search->EndDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EndDate" id="z_EndDate" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->EndDate->cellAttributes() ?>>
			<span id="el_health_certificate_EndDate" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($health_certificate_search->EndDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->EndDate->EditValue ?>"<?php echo $health_certificate_search->EndDate->editAttributes() ?>>
<?php if (!$health_certificate_search->EndDate->ReadOnly && !$health_certificate_search->EndDate->Disabled && !isset($health_certificate_search->EndDate->EditAttrs["readonly"]) && !isset($health_certificate_search->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificatesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificatesearch", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label for="x_LastUpdatedBy" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_LastUpdatedBy"><?php echo $health_certificate_search->LastUpdatedBy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LastUpdatedBy" id="z_LastUpdatedBy" value="LIKE">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->LastUpdatedBy->cellAttributes() ?>>
			<span id="el_health_certificate_LastUpdatedBy" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($health_certificate_search->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->LastUpdatedBy->EditValue ?>"<?php echo $health_certificate_search->LastUpdatedBy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($health_certificate_search->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label for="x_LastUpdateDate" class="<?php echo $health_certificate_search->LeftColumnClass ?>"><span id="elh_health_certificate_LastUpdateDate"><?php echo $health_certificate_search->LastUpdateDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LastUpdateDate" id="z_LastUpdateDate" value="=">
</span>
		</label>
		<div class="<?php echo $health_certificate_search->RightColumnClass ?>"><div <?php echo $health_certificate_search->LastUpdateDate->cellAttributes() ?>>
			<span id="el_health_certificate_LastUpdateDate" class="ew-search-field">
<input type="text" data-table="health_certificate" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($health_certificate_search->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_search->LastUpdateDate->EditValue ?>"<?php echo $health_certificate_search->LastUpdateDate->editAttributes() ?>>
<?php if (!$health_certificate_search->LastUpdateDate->ReadOnly && !$health_certificate_search->LastUpdateDate->Disabled && !isset($health_certificate_search->LastUpdateDate->EditAttrs["readonly"]) && !isset($health_certificate_search->LastUpdateDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificatesearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificatesearch", "x_LastUpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$health_certificate_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $health_certificate_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$health_certificate_search->showPageFooter();
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
$health_certificate_search->terminate();
?>