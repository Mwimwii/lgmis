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
$fire_certificate_add = new fire_certificate_add();

// Run the page
$fire_certificate_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fire_certificate_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffire_certificateadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ffire_certificateadd = currentForm = new ew.Form("ffire_certificateadd", "add");

	// Validate form
	ffire_certificateadd.validate = function() {
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
			<?php if ($fire_certificate_add->LicenceNo->Required) { ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->LicenceNo->caption(), $fire_certificate_add->LicenceNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->LicenceNo->errorMessage()) ?>");
			<?php if ($fire_certificate_add->BusinessNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->BusinessNo->caption(), $fire_certificate_add->BusinessNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->BusinessNo->errorMessage()) ?>");
			<?php if ($fire_certificate_add->InspectionReport->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectionReport");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->InspectionReport->caption(), $fire_certificate_add->InspectionReport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_add->InspectionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->InspectionDate->caption(), $fire_certificate_add->InspectionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_InspectionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->InspectionDate->errorMessage()) ?>");
			<?php if ($fire_certificate_add->InspectedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->InspectedBy->caption(), $fire_certificate_add->InspectedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_add->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->ChargeCode->caption(), $fire_certificate_add->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->ChargeCode->errorMessage()) ?>");
			<?php if ($fire_certificate_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->ChargeGroup->caption(), $fire_certificate_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->ChargeGroup->errorMessage()) ?>");
			<?php if ($fire_certificate_add->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->BalanceBF->caption(), $fire_certificate_add->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->BalanceBF->errorMessage()) ?>");
			<?php if ($fire_certificate_add->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->CurrentDemand->caption(), $fire_certificate_add->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->CurrentDemand->errorMessage()) ?>");
			<?php if ($fire_certificate_add->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->VAT->caption(), $fire_certificate_add->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->VAT->errorMessage()) ?>");
			<?php if ($fire_certificate_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->AmountPaid->caption(), $fire_certificate_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->AmountPaid->errorMessage()) ?>");
			<?php if ($fire_certificate_add->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->BillPeriod->caption(), $fire_certificate_add->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->BillPeriod->errorMessage()) ?>");
			<?php if ($fire_certificate_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->PeriodType->caption(), $fire_certificate_add->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_add->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->BillYear->caption(), $fire_certificate_add->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->BillYear->errorMessage()) ?>");
			<?php if ($fire_certificate_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->StartDate->caption(), $fire_certificate_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->StartDate->errorMessage()) ?>");
			<?php if ($fire_certificate_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->EndDate->caption(), $fire_certificate_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->EndDate->errorMessage()) ?>");
			<?php if ($fire_certificate_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->LastUpdatedBy->caption(), $fire_certificate_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($fire_certificate_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fire_certificate_add->LastUpdateDate->caption(), $fire_certificate_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($fire_certificate_add->LastUpdateDate->errorMessage()) ?>");

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
	ffire_certificateadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffire_certificateadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ffire_certificateadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $fire_certificate_add->showPageHeader(); ?>
<?php
$fire_certificate_add->showMessage();
?>
<form name="ffire_certificateadd" id="ffire_certificateadd" class="<?php echo $fire_certificate_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fire_certificate">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$fire_certificate_add->IsModal ?>">
<?php if ($fire_certificate->getCurrentMasterTable() == "licence_account") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="licence_account">
<input type="hidden" name="fk_LicenceNo" value="<?php echo HtmlEncode($fire_certificate_add->LicenceNo->getSessionValue()) ?>">
<input type="hidden" name="fk_BusinessNo" value="<?php echo HtmlEncode($fire_certificate_add->BusinessNo->getSessionValue()) ?>">
<input type="hidden" name="fk_BillPeriod" value="<?php echo HtmlEncode($fire_certificate_add->BillPeriod->getSessionValue()) ?>">
<input type="hidden" name="fk_PeriodType" value="<?php echo HtmlEncode($fire_certificate_add->PeriodType->getSessionValue()) ?>">
<input type="hidden" name="fk_BillYear" value="<?php echo HtmlEncode($fire_certificate_add->BillYear->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($fire_certificate_add->LicenceNo->Visible) { // LicenceNo ?>
	<div id="r_LicenceNo" class="form-group row">
		<label id="elh_fire_certificate_LicenceNo" for="x_LicenceNo" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->LicenceNo->caption() ?><?php echo $fire_certificate_add->LicenceNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->LicenceNo->cellAttributes() ?>>
<?php if ($fire_certificate_add->LicenceNo->getSessionValue() != "") { ?>
<span id="el_fire_certificate_LicenceNo">
<span<?php echo $fire_certificate_add->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_add->LicenceNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LicenceNo" name="x_LicenceNo" value="<?php echo HtmlEncode($fire_certificate_add->LicenceNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_LicenceNo">
<input type="text" data-table="fire_certificate" data-field="x_LicenceNo" name="x_LicenceNo" id="x_LicenceNo" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->LicenceNo->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->LicenceNo->EditValue ?>"<?php echo $fire_certificate_add->LicenceNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_add->LicenceNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->BusinessNo->Visible) { // BusinessNo ?>
	<div id="r_BusinessNo" class="form-group row">
		<label id="elh_fire_certificate_BusinessNo" for="x_BusinessNo" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->BusinessNo->caption() ?><?php echo $fire_certificate_add->BusinessNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->BusinessNo->cellAttributes() ?>>
<?php if ($fire_certificate_add->BusinessNo->getSessionValue() != "") { ?>
<span id="el_fire_certificate_BusinessNo">
<span<?php echo $fire_certificate_add->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_add->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BusinessNo" name="x_BusinessNo" value="<?php echo HtmlEncode($fire_certificate_add->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_BusinessNo">
<input type="text" data-table="fire_certificate" data-field="x_BusinessNo" name="x_BusinessNo" id="x_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->BusinessNo->EditValue ?>"<?php echo $fire_certificate_add->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_add->BusinessNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->InspectionReport->Visible) { // InspectionReport ?>
	<div id="r_InspectionReport" class="form-group row">
		<label id="elh_fire_certificate_InspectionReport" for="x_InspectionReport" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->InspectionReport->caption() ?><?php echo $fire_certificate_add->InspectionReport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->InspectionReport->cellAttributes() ?>>
<span id="el_fire_certificate_InspectionReport">
<textarea data-table="fire_certificate" data-field="x_InspectionReport" name="x_InspectionReport" id="x_InspectionReport" cols="35" rows="4" placeholder="<?php echo HtmlEncode($fire_certificate_add->InspectionReport->getPlaceHolder()) ?>"<?php echo $fire_certificate_add->InspectionReport->editAttributes() ?>><?php echo $fire_certificate_add->InspectionReport->EditValue ?></textarea>
</span>
<?php echo $fire_certificate_add->InspectionReport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->InspectionDate->Visible) { // InspectionDate ?>
	<div id="r_InspectionDate" class="form-group row">
		<label id="elh_fire_certificate_InspectionDate" for="x_InspectionDate" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->InspectionDate->caption() ?><?php echo $fire_certificate_add->InspectionDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->InspectionDate->cellAttributes() ?>>
<span id="el_fire_certificate_InspectionDate">
<input type="text" data-table="fire_certificate" data-field="x_InspectionDate" name="x_InspectionDate" id="x_InspectionDate" placeholder="<?php echo HtmlEncode($fire_certificate_add->InspectionDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->InspectionDate->EditValue ?>"<?php echo $fire_certificate_add->InspectionDate->editAttributes() ?>>
<?php if (!$fire_certificate_add->InspectionDate->ReadOnly && !$fire_certificate_add->InspectionDate->Disabled && !isset($fire_certificate_add->InspectionDate->EditAttrs["readonly"]) && !isset($fire_certificate_add->InspectionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateadd", "x_InspectionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_add->InspectionDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->InspectedBy->Visible) { // InspectedBy ?>
	<div id="r_InspectedBy" class="form-group row">
		<label id="elh_fire_certificate_InspectedBy" for="x_InspectedBy" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->InspectedBy->caption() ?><?php echo $fire_certificate_add->InspectedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->InspectedBy->cellAttributes() ?>>
<span id="el_fire_certificate_InspectedBy">
<input type="text" data-table="fire_certificate" data-field="x_InspectedBy" name="x_InspectedBy" id="x_InspectedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($fire_certificate_add->InspectedBy->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->InspectedBy->EditValue ?>"<?php echo $fire_certificate_add->InspectedBy->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->InspectedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_fire_certificate_ChargeCode" for="x_ChargeCode" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->ChargeCode->caption() ?><?php echo $fire_certificate_add->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->ChargeCode->cellAttributes() ?>>
<span id="el_fire_certificate_ChargeCode">
<input type="text" data-table="fire_certificate" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->ChargeCode->EditValue ?>"<?php echo $fire_certificate_add->ChargeCode->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_fire_certificate_ChargeGroup" for="x_ChargeGroup" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->ChargeGroup->caption() ?><?php echo $fire_certificate_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->ChargeGroup->cellAttributes() ?>>
<span id="el_fire_certificate_ChargeGroup">
<input type="text" data-table="fire_certificate" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->ChargeGroup->EditValue ?>"<?php echo $fire_certificate_add->ChargeGroup->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_fire_certificate_BalanceBF" for="x_BalanceBF" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->BalanceBF->caption() ?><?php echo $fire_certificate_add->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->BalanceBF->cellAttributes() ?>>
<span id="el_fire_certificate_BalanceBF">
<input type="text" data-table="fire_certificate" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->BalanceBF->EditValue ?>"<?php echo $fire_certificate_add->BalanceBF->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_fire_certificate_CurrentDemand" for="x_CurrentDemand" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->CurrentDemand->caption() ?><?php echo $fire_certificate_add->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->CurrentDemand->cellAttributes() ?>>
<span id="el_fire_certificate_CurrentDemand">
<input type="text" data-table="fire_certificate" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->CurrentDemand->EditValue ?>"<?php echo $fire_certificate_add->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_fire_certificate_VAT" for="x_VAT" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->VAT->caption() ?><?php echo $fire_certificate_add->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->VAT->cellAttributes() ?>>
<span id="el_fire_certificate_VAT">
<input type="text" data-table="fire_certificate" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->VAT->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->VAT->EditValue ?>"<?php echo $fire_certificate_add->VAT->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_fire_certificate_AmountPaid" for="x_AmountPaid" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->AmountPaid->caption() ?><?php echo $fire_certificate_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->AmountPaid->cellAttributes() ?>>
<span id="el_fire_certificate_AmountPaid">
<input type="text" data-table="fire_certificate" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->AmountPaid->EditValue ?>"<?php echo $fire_certificate_add->AmountPaid->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_fire_certificate_BillPeriod" for="x_BillPeriod" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->BillPeriod->caption() ?><?php echo $fire_certificate_add->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->BillPeriod->cellAttributes() ?>>
<?php if ($fire_certificate_add->BillPeriod->getSessionValue() != "") { ?>
<span id="el_fire_certificate_BillPeriod">
<span<?php echo $fire_certificate_add->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_add->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BillPeriod" name="x_BillPeriod" value="<?php echo HtmlEncode($fire_certificate_add->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_BillPeriod">
<input type="text" data-table="fire_certificate" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->BillPeriod->EditValue ?>"<?php echo $fire_certificate_add->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_add->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_fire_certificate_PeriodType" for="x_PeriodType" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->PeriodType->caption() ?><?php echo $fire_certificate_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->PeriodType->cellAttributes() ?>>
<?php if ($fire_certificate_add->PeriodType->getSessionValue() != "") { ?>
<span id="el_fire_certificate_PeriodType">
<span<?php echo $fire_certificate_add->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_add->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_PeriodType" name="x_PeriodType" value="<?php echo HtmlEncode($fire_certificate_add->PeriodType->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_PeriodType">
<input type="text" data-table="fire_certificate" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($fire_certificate_add->PeriodType->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->PeriodType->EditValue ?>"<?php echo $fire_certificate_add->PeriodType->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_fire_certificate_BillYear" for="x_BillYear" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->BillYear->caption() ?><?php echo $fire_certificate_add->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->BillYear->cellAttributes() ?>>
<?php if ($fire_certificate_add->BillYear->getSessionValue() != "") { ?>
<span id="el_fire_certificate_BillYear">
<span<?php echo $fire_certificate_add->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($fire_certificate_add->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BillYear" name="x_BillYear" value="<?php echo HtmlEncode($fire_certificate_add->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el_fire_certificate_BillYear">
<input type="text" data-table="fire_certificate" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($fire_certificate_add->BillYear->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->BillYear->EditValue ?>"<?php echo $fire_certificate_add->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $fire_certificate_add->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_fire_certificate_StartDate" for="x_StartDate" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->StartDate->caption() ?><?php echo $fire_certificate_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->StartDate->cellAttributes() ?>>
<span id="el_fire_certificate_StartDate">
<input type="text" data-table="fire_certificate" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($fire_certificate_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->StartDate->EditValue ?>"<?php echo $fire_certificate_add->StartDate->editAttributes() ?>>
<?php if (!$fire_certificate_add->StartDate->ReadOnly && !$fire_certificate_add->StartDate->Disabled && !isset($fire_certificate_add->StartDate->EditAttrs["readonly"]) && !isset($fire_certificate_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_fire_certificate_EndDate" for="x_EndDate" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->EndDate->caption() ?><?php echo $fire_certificate_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->EndDate->cellAttributes() ?>>
<span id="el_fire_certificate_EndDate">
<input type="text" data-table="fire_certificate" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($fire_certificate_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->EndDate->EditValue ?>"<?php echo $fire_certificate_add->EndDate->editAttributes() ?>>
<?php if (!$fire_certificate_add->EndDate->ReadOnly && !$fire_certificate_add->EndDate->Disabled && !isset($fire_certificate_add->EndDate->EditAttrs["readonly"]) && !isset($fire_certificate_add->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateadd", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_fire_certificate_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->LastUpdatedBy->caption() ?><?php echo $fire_certificate_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_fire_certificate_LastUpdatedBy">
<input type="text" data-table="fire_certificate" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($fire_certificate_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->LastUpdatedBy->EditValue ?>"<?php echo $fire_certificate_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $fire_certificate_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fire_certificate_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_fire_certificate_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $fire_certificate_add->LeftColumnClass ?>"><?php echo $fire_certificate_add->LastUpdateDate->caption() ?><?php echo $fire_certificate_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fire_certificate_add->RightColumnClass ?>"><div <?php echo $fire_certificate_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_fire_certificate_LastUpdateDate">
<input type="text" data-table="fire_certificate" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($fire_certificate_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $fire_certificate_add->LastUpdateDate->EditValue ?>"<?php echo $fire_certificate_add->LastUpdateDate->editAttributes() ?>>
<?php if (!$fire_certificate_add->LastUpdateDate->ReadOnly && !$fire_certificate_add->LastUpdateDate->Disabled && !isset($fire_certificate_add->LastUpdateDate->EditAttrs["readonly"]) && !isset($fire_certificate_add->LastUpdateDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffire_certificateadd", "datetimepicker"], function() {
	ew.createDateTimePicker("ffire_certificateadd", "x_LastUpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $fire_certificate_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$fire_certificate_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $fire_certificate_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fire_certificate_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$fire_certificate_add->showPageFooter();
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
$fire_certificate_add->terminate();
?>