<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($health_certificate_grid))
	$health_certificate_grid = new health_certificate_grid();

// Run the page
$health_certificate_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$health_certificate_grid->Page_Render();
?>
<?php if (!$health_certificate_grid->isExport()) { ?>
<script>
var fhealth_certificategrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fhealth_certificategrid = new ew.Form("fhealth_certificategrid", "grid");
	fhealth_certificategrid.formKeyCountName = '<?php echo $health_certificate_grid->FormKeyCountName ?>';

	// Validate form
	fhealth_certificategrid.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($health_certificate_grid->HealthCertificateNo->Required) { ?>
				elm = this.getElements("x" + infix + "_HealthCertificateNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->HealthCertificateNo->caption(), $health_certificate_grid->HealthCertificateNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($health_certificate_grid->LicenceNo->Required) { ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->LicenceNo->caption(), $health_certificate_grid->LicenceNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->LicenceNo->errorMessage()) ?>");
			<?php if ($health_certificate_grid->BusinessNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->BusinessNo->caption(), $health_certificate_grid->BusinessNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->BusinessNo->errorMessage()) ?>");
			<?php if ($health_certificate_grid->InspectionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->InspectionDate->caption(), $health_certificate_grid->InspectionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_InspectionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->InspectionDate->errorMessage()) ?>");
			<?php if ($health_certificate_grid->InspectedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_InspectedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->InspectedBy->caption(), $health_certificate_grid->InspectedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($health_certificate_grid->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->ChargeCode->caption(), $health_certificate_grid->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->ChargeCode->errorMessage()) ?>");
			<?php if ($health_certificate_grid->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->ChargeGroup->caption(), $health_certificate_grid->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->ChargeGroup->errorMessage()) ?>");
			<?php if ($health_certificate_grid->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->BalanceBF->caption(), $health_certificate_grid->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->BalanceBF->errorMessage()) ?>");
			<?php if ($health_certificate_grid->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->CurrentDemand->caption(), $health_certificate_grid->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->CurrentDemand->errorMessage()) ?>");
			<?php if ($health_certificate_grid->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->VAT->caption(), $health_certificate_grid->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->VAT->errorMessage()) ?>");
			<?php if ($health_certificate_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->AmountPaid->caption(), $health_certificate_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($health_certificate_grid->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->BillPeriod->caption(), $health_certificate_grid->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->BillPeriod->errorMessage()) ?>");
			<?php if ($health_certificate_grid->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->PeriodType->caption(), $health_certificate_grid->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($health_certificate_grid->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->BillYear->caption(), $health_certificate_grid->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->BillYear->errorMessage()) ?>");
			<?php if ($health_certificate_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->StartDate->caption(), $health_certificate_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->StartDate->errorMessage()) ?>");
			<?php if ($health_certificate_grid->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->EndDate->caption(), $health_certificate_grid->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->EndDate->errorMessage()) ?>");
			<?php if ($health_certificate_grid->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->LastUpdatedBy->caption(), $health_certificate_grid->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($health_certificate_grid->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $health_certificate_grid->LastUpdateDate->caption(), $health_certificate_grid->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($health_certificate_grid->LastUpdateDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fhealth_certificategrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LicenceNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "BusinessNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "InspectionDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "InspectedBy", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeGroup", false)) return false;
		if (ew.valueChanged(fobj, infix, "BalanceBF", false)) return false;
		if (ew.valueChanged(fobj, infix, "CurrentDemand", false)) return false;
		if (ew.valueChanged(fobj, infix, "VAT", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPaid", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "PeriodType", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdatedBy", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdateDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fhealth_certificategrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhealth_certificategrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fhealth_certificategrid");
});
</script>
<?php } ?>
<?php
$health_certificate_grid->renderOtherOptions();
?>
<?php if ($health_certificate_grid->TotalRecords > 0 || $health_certificate->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($health_certificate_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> health_certificate">
<?php if ($health_certificate_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $health_certificate_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fhealth_certificategrid" class="ew-form ew-list-form form-inline">
<div id="gmp_health_certificate" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_health_certificategrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$health_certificate->RowType = ROWTYPE_HEADER;

// Render list options
$health_certificate_grid->renderListOptions();

// Render list options (header, left)
$health_certificate_grid->ListOptions->render("header", "left");
?>
<?php if ($health_certificate_grid->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->HealthCertificateNo) == "") { ?>
		<th data-name="HealthCertificateNo" class="<?php echo $health_certificate_grid->HealthCertificateNo->headerCellClass() ?>"><div id="elh_health_certificate_HealthCertificateNo" class="health_certificate_HealthCertificateNo"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->HealthCertificateNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="HealthCertificateNo" class="<?php echo $health_certificate_grid->HealthCertificateNo->headerCellClass() ?>"><div><div id="elh_health_certificate_HealthCertificateNo" class="health_certificate_HealthCertificateNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->HealthCertificateNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->HealthCertificateNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->HealthCertificateNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->LicenceNo->Visible) { // LicenceNo ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->LicenceNo) == "") { ?>
		<th data-name="LicenceNo" class="<?php echo $health_certificate_grid->LicenceNo->headerCellClass() ?>"><div id="elh_health_certificate_LicenceNo" class="health_certificate_LicenceNo"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->LicenceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LicenceNo" class="<?php echo $health_certificate_grid->LicenceNo->headerCellClass() ?>"><div><div id="elh_health_certificate_LicenceNo" class="health_certificate_LicenceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->LicenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->LicenceNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->LicenceNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->BusinessNo->Visible) { // BusinessNo ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->BusinessNo) == "") { ?>
		<th data-name="BusinessNo" class="<?php echo $health_certificate_grid->BusinessNo->headerCellClass() ?>"><div id="elh_health_certificate_BusinessNo" class="health_certificate_BusinessNo"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->BusinessNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessNo" class="<?php echo $health_certificate_grid->BusinessNo->headerCellClass() ?>"><div><div id="elh_health_certificate_BusinessNo" class="health_certificate_BusinessNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->BusinessNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->BusinessNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->BusinessNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->InspectionDate->Visible) { // InspectionDate ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->InspectionDate) == "") { ?>
		<th data-name="InspectionDate" class="<?php echo $health_certificate_grid->InspectionDate->headerCellClass() ?>"><div id="elh_health_certificate_InspectionDate" class="health_certificate_InspectionDate"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->InspectionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InspectionDate" class="<?php echo $health_certificate_grid->InspectionDate->headerCellClass() ?>"><div><div id="elh_health_certificate_InspectionDate" class="health_certificate_InspectionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->InspectionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->InspectionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->InspectionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->InspectedBy->Visible) { // InspectedBy ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->InspectedBy) == "") { ?>
		<th data-name="InspectedBy" class="<?php echo $health_certificate_grid->InspectedBy->headerCellClass() ?>"><div id="elh_health_certificate_InspectedBy" class="health_certificate_InspectedBy"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->InspectedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="InspectedBy" class="<?php echo $health_certificate_grid->InspectedBy->headerCellClass() ?>"><div><div id="elh_health_certificate_InspectedBy" class="health_certificate_InspectedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->InspectedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->InspectedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->InspectedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $health_certificate_grid->ChargeCode->headerCellClass() ?>"><div id="elh_health_certificate_ChargeCode" class="health_certificate_ChargeCode"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $health_certificate_grid->ChargeCode->headerCellClass() ?>"><div><div id="elh_health_certificate_ChargeCode" class="health_certificate_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $health_certificate_grid->ChargeGroup->headerCellClass() ?>"><div id="elh_health_certificate_ChargeGroup" class="health_certificate_ChargeGroup"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $health_certificate_grid->ChargeGroup->headerCellClass() ?>"><div><div id="elh_health_certificate_ChargeGroup" class="health_certificate_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $health_certificate_grid->BalanceBF->headerCellClass() ?>"><div id="elh_health_certificate_BalanceBF" class="health_certificate_BalanceBF"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $health_certificate_grid->BalanceBF->headerCellClass() ?>"><div><div id="elh_health_certificate_BalanceBF" class="health_certificate_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $health_certificate_grid->CurrentDemand->headerCellClass() ?>"><div id="elh_health_certificate_CurrentDemand" class="health_certificate_CurrentDemand"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $health_certificate_grid->CurrentDemand->headerCellClass() ?>"><div><div id="elh_health_certificate_CurrentDemand" class="health_certificate_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->VAT->Visible) { // VAT ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $health_certificate_grid->VAT->headerCellClass() ?>"><div id="elh_health_certificate_VAT" class="health_certificate_VAT"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $health_certificate_grid->VAT->headerCellClass() ?>"><div><div id="elh_health_certificate_VAT" class="health_certificate_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $health_certificate_grid->AmountPaid->headerCellClass() ?>"><div id="elh_health_certificate_AmountPaid" class="health_certificate_AmountPaid"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $health_certificate_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_health_certificate_AmountPaid" class="health_certificate_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $health_certificate_grid->BillPeriod->headerCellClass() ?>"><div id="elh_health_certificate_BillPeriod" class="health_certificate_BillPeriod"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $health_certificate_grid->BillPeriod->headerCellClass() ?>"><div><div id="elh_health_certificate_BillPeriod" class="health_certificate_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->PeriodType->Visible) { // PeriodType ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $health_certificate_grid->PeriodType->headerCellClass() ?>"><div id="elh_health_certificate_PeriodType" class="health_certificate_PeriodType"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $health_certificate_grid->PeriodType->headerCellClass() ?>"><div><div id="elh_health_certificate_PeriodType" class="health_certificate_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->BillYear->Visible) { // BillYear ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $health_certificate_grid->BillYear->headerCellClass() ?>"><div id="elh_health_certificate_BillYear" class="health_certificate_BillYear"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $health_certificate_grid->BillYear->headerCellClass() ?>"><div><div id="elh_health_certificate_BillYear" class="health_certificate_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $health_certificate_grid->StartDate->headerCellClass() ?>"><div id="elh_health_certificate_StartDate" class="health_certificate_StartDate"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $health_certificate_grid->StartDate->headerCellClass() ?>"><div><div id="elh_health_certificate_StartDate" class="health_certificate_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->EndDate->Visible) { // EndDate ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $health_certificate_grid->EndDate->headerCellClass() ?>"><div id="elh_health_certificate_EndDate" class="health_certificate_EndDate"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $health_certificate_grid->EndDate->headerCellClass() ?>"><div><div id="elh_health_certificate_EndDate" class="health_certificate_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $health_certificate_grid->LastUpdatedBy->headerCellClass() ?>"><div id="elh_health_certificate_LastUpdatedBy" class="health_certificate_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $health_certificate_grid->LastUpdatedBy->headerCellClass() ?>"><div><div id="elh_health_certificate_LastUpdatedBy" class="health_certificate_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($health_certificate_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($health_certificate_grid->SortUrl($health_certificate_grid->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $health_certificate_grid->LastUpdateDate->headerCellClass() ?>"><div id="elh_health_certificate_LastUpdateDate" class="health_certificate_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $health_certificate_grid->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $health_certificate_grid->LastUpdateDate->headerCellClass() ?>"><div><div id="elh_health_certificate_LastUpdateDate" class="health_certificate_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $health_certificate_grid->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($health_certificate_grid->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($health_certificate_grid->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$health_certificate_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$health_certificate_grid->StartRecord = 1;
$health_certificate_grid->StopRecord = $health_certificate_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($health_certificate->isConfirm() || $health_certificate_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($health_certificate_grid->FormKeyCountName) && ($health_certificate_grid->isGridAdd() || $health_certificate_grid->isGridEdit() || $health_certificate->isConfirm())) {
		$health_certificate_grid->KeyCount = $CurrentForm->getValue($health_certificate_grid->FormKeyCountName);
		$health_certificate_grid->StopRecord = $health_certificate_grid->StartRecord + $health_certificate_grid->KeyCount - 1;
	}
}
$health_certificate_grid->RecordCount = $health_certificate_grid->StartRecord - 1;
if ($health_certificate_grid->Recordset && !$health_certificate_grid->Recordset->EOF) {
	$health_certificate_grid->Recordset->moveFirst();
	$selectLimit = $health_certificate_grid->UseSelectLimit;
	if (!$selectLimit && $health_certificate_grid->StartRecord > 1)
		$health_certificate_grid->Recordset->move($health_certificate_grid->StartRecord - 1);
} elseif (!$health_certificate->AllowAddDeleteRow && $health_certificate_grid->StopRecord == 0) {
	$health_certificate_grid->StopRecord = $health_certificate->GridAddRowCount;
}

// Initialize aggregate
$health_certificate->RowType = ROWTYPE_AGGREGATEINIT;
$health_certificate->resetAttributes();
$health_certificate_grid->renderRow();
if ($health_certificate_grid->isGridAdd())
	$health_certificate_grid->RowIndex = 0;
if ($health_certificate_grid->isGridEdit())
	$health_certificate_grid->RowIndex = 0;
while ($health_certificate_grid->RecordCount < $health_certificate_grid->StopRecord) {
	$health_certificate_grid->RecordCount++;
	if ($health_certificate_grid->RecordCount >= $health_certificate_grid->StartRecord) {
		$health_certificate_grid->RowCount++;
		if ($health_certificate_grid->isGridAdd() || $health_certificate_grid->isGridEdit() || $health_certificate->isConfirm()) {
			$health_certificate_grid->RowIndex++;
			$CurrentForm->Index = $health_certificate_grid->RowIndex;
			if ($CurrentForm->hasValue($health_certificate_grid->FormActionName) && ($health_certificate->isConfirm() || $health_certificate_grid->EventCancelled))
				$health_certificate_grid->RowAction = strval($CurrentForm->getValue($health_certificate_grid->FormActionName));
			elseif ($health_certificate_grid->isGridAdd())
				$health_certificate_grid->RowAction = "insert";
			else
				$health_certificate_grid->RowAction = "";
		}

		// Set up key count
		$health_certificate_grid->KeyCount = $health_certificate_grid->RowIndex;

		// Init row class and style
		$health_certificate->resetAttributes();
		$health_certificate->CssClass = "";
		if ($health_certificate_grid->isGridAdd()) {
			if ($health_certificate->CurrentMode == "copy") {
				$health_certificate_grid->loadRowValues($health_certificate_grid->Recordset); // Load row values
				$health_certificate_grid->setRecordKey($health_certificate_grid->RowOldKey, $health_certificate_grid->Recordset); // Set old record key
			} else {
				$health_certificate_grid->loadRowValues(); // Load default values
				$health_certificate_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$health_certificate_grid->loadRowValues($health_certificate_grid->Recordset); // Load row values
		}
		$health_certificate->RowType = ROWTYPE_VIEW; // Render view
		if ($health_certificate_grid->isGridAdd()) // Grid add
			$health_certificate->RowType = ROWTYPE_ADD; // Render add
		if ($health_certificate_grid->isGridAdd() && $health_certificate->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$health_certificate_grid->restoreCurrentRowFormValues($health_certificate_grid->RowIndex); // Restore form values
		if ($health_certificate_grid->isGridEdit()) { // Grid edit
			if ($health_certificate->EventCancelled)
				$health_certificate_grid->restoreCurrentRowFormValues($health_certificate_grid->RowIndex); // Restore form values
			if ($health_certificate_grid->RowAction == "insert")
				$health_certificate->RowType = ROWTYPE_ADD; // Render add
			else
				$health_certificate->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($health_certificate_grid->isGridEdit() && ($health_certificate->RowType == ROWTYPE_EDIT || $health_certificate->RowType == ROWTYPE_ADD) && $health_certificate->EventCancelled) // Update failed
			$health_certificate_grid->restoreCurrentRowFormValues($health_certificate_grid->RowIndex); // Restore form values
		if ($health_certificate->RowType == ROWTYPE_EDIT) // Edit row
			$health_certificate_grid->EditRowCount++;
		if ($health_certificate->isConfirm()) // Confirm row
			$health_certificate_grid->restoreCurrentRowFormValues($health_certificate_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$health_certificate->RowAttrs->merge(["data-rowindex" => $health_certificate_grid->RowCount, "id" => "r" . $health_certificate_grid->RowCount . "_health_certificate", "data-rowtype" => $health_certificate->RowType]);

		// Render row
		$health_certificate_grid->renderRow();

		// Render list options
		$health_certificate_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($health_certificate_grid->RowAction != "delete" && $health_certificate_grid->RowAction != "insertdelete" && !($health_certificate_grid->RowAction == "insert" && $health_certificate->isConfirm() && $health_certificate_grid->emptyRow())) {
?>
	<tr <?php echo $health_certificate->rowAttributes() ?>>
<?php

// Render list options (body, left)
$health_certificate_grid->ListOptions->render("body", "left", $health_certificate_grid->RowCount);
?>
	<?php if ($health_certificate_grid->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
		<td data-name="HealthCertificateNo" <?php echo $health_certificate_grid->HealthCertificateNo->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_HealthCertificateNo" class="form-group"></span>
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_HealthCertificateNo" class="form-group">
<span<?php echo $health_certificate_grid->HealthCertificateNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->HealthCertificateNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->CurrentValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_HealthCertificateNo">
<span<?php echo $health_certificate_grid->HealthCertificateNo->viewAttributes() ?>><?php echo $health_certificate_grid->HealthCertificateNo->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->LicenceNo->Visible) { // LicenceNo ?>
		<td data-name="LicenceNo" <?php echo $health_certificate_grid->LicenceNo->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($health_certificate_grid->LicenceNo->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LicenceNo" class="form-group">
<span<?php echo $health_certificate_grid->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->LicenceNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LicenceNo" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LicenceNo->EditValue ?>"<?php echo $health_certificate_grid->LicenceNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($health_certificate_grid->LicenceNo->getSessionValue() != "") { ?>

<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LicenceNo" class="form-group">
<span<?php echo $health_certificate_grid->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->LicenceNo->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="health_certificate" data-field="x_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LicenceNo->EditValue ?>"<?php echo $health_certificate_grid->LicenceNo->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->OldValue != null ? $health_certificate_grid->LicenceNo->OldValue : $health_certificate_grid->LicenceNo->CurrentValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LicenceNo">
<span<?php echo $health_certificate_grid->LicenceNo->viewAttributes() ?>><?php echo $health_certificate_grid->LicenceNo->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BusinessNo->Visible) { // BusinessNo ?>
		<td data-name="BusinessNo" <?php echo $health_certificate_grid->BusinessNo->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($health_certificate_grid->BusinessNo->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BusinessNo" class="form-group">
<span<?php echo $health_certificate_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BusinessNo" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BusinessNo->EditValue ?>"<?php echo $health_certificate_grid->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_BusinessNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($health_certificate_grid->BusinessNo->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BusinessNo" class="form-group">
<span<?php echo $health_certificate_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BusinessNo" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BusinessNo->EditValue ?>"<?php echo $health_certificate_grid->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BusinessNo">
<span<?php echo $health_certificate_grid->BusinessNo->viewAttributes() ?>><?php echo $health_certificate_grid->BusinessNo->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BusinessNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BusinessNo" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BusinessNo" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->InspectionDate->Visible) { // InspectionDate ?>
		<td data-name="InspectionDate" <?php echo $health_certificate_grid->InspectionDate->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_InspectionDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_InspectionDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->InspectionDate->EditValue ?>"<?php echo $health_certificate_grid->InspectionDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->InspectionDate->ReadOnly && !$health_certificate_grid->InspectionDate->Disabled && !isset($health_certificate_grid->InspectionDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->InspectionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_InspectionDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" value="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_InspectionDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_InspectionDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->InspectionDate->EditValue ?>"<?php echo $health_certificate_grid->InspectionDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->InspectionDate->ReadOnly && !$health_certificate_grid->InspectionDate->Disabled && !isset($health_certificate_grid->InspectionDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->InspectionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_InspectionDate">
<span<?php echo $health_certificate_grid->InspectionDate->viewAttributes() ?>><?php echo $health_certificate_grid->InspectionDate->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_InspectionDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" value="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_InspectionDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" value="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_InspectionDate" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" value="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_InspectionDate" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" value="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->InspectedBy->Visible) { // InspectedBy ?>
		<td data-name="InspectedBy" <?php echo $health_certificate_grid->InspectedBy->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_InspectedBy" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_InspectedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->InspectedBy->EditValue ?>"<?php echo $health_certificate_grid->InspectedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_InspectedBy" name="o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" value="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_InspectedBy" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_InspectedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->InspectedBy->EditValue ?>"<?php echo $health_certificate_grid->InspectedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_InspectedBy">
<span<?php echo $health_certificate_grid->InspectedBy->viewAttributes() ?>><?php echo $health_certificate_grid->InspectedBy->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_InspectedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" value="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_InspectedBy" name="o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" value="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_InspectedBy" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" value="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_InspectedBy" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" value="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $health_certificate_grid->ChargeCode->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_ChargeCode" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_ChargeCode" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->ChargeCode->EditValue ?>"<?php echo $health_certificate_grid->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeCode" name="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_ChargeCode" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_ChargeCode" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->ChargeCode->EditValue ?>"<?php echo $health_certificate_grid->ChargeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_ChargeCode">
<span<?php echo $health_certificate_grid->ChargeCode->viewAttributes() ?>><?php echo $health_certificate_grid->ChargeCode->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeCode" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_ChargeCode" name="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeCode" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_ChargeCode" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $health_certificate_grid->ChargeGroup->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_ChargeGroup" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_ChargeGroup" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->ChargeGroup->EditValue ?>"<?php echo $health_certificate_grid->ChargeGroup->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeGroup" name="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_ChargeGroup" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_ChargeGroup" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->ChargeGroup->EditValue ?>"<?php echo $health_certificate_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_ChargeGroup">
<span<?php echo $health_certificate_grid->ChargeGroup->viewAttributes() ?>><?php echo $health_certificate_grid->ChargeGroup->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeGroup" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_ChargeGroup" name="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeGroup" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_ChargeGroup" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $health_certificate_grid->BalanceBF->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BalanceBF" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BalanceBF" name="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BalanceBF->EditValue ?>"<?php echo $health_certificate_grid->BalanceBF->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_BalanceBF" name="o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BalanceBF" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BalanceBF" name="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BalanceBF->EditValue ?>"<?php echo $health_certificate_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BalanceBF">
<span<?php echo $health_certificate_grid->BalanceBF->viewAttributes() ?>><?php echo $health_certificate_grid->BalanceBF->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BalanceBF" name="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BalanceBF" name="o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BalanceBF" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BalanceBF" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $health_certificate_grid->CurrentDemand->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_CurrentDemand" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_CurrentDemand" name="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->CurrentDemand->EditValue ?>"<?php echo $health_certificate_grid->CurrentDemand->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_CurrentDemand" name="o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_CurrentDemand" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_CurrentDemand" name="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->CurrentDemand->EditValue ?>"<?php echo $health_certificate_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_CurrentDemand">
<span<?php echo $health_certificate_grid->CurrentDemand->viewAttributes() ?>><?php echo $health_certificate_grid->CurrentDemand->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_CurrentDemand" name="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_CurrentDemand" name="o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_CurrentDemand" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_CurrentDemand" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $health_certificate_grid->VAT->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_VAT" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_VAT" name="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->VAT->EditValue ?>"<?php echo $health_certificate_grid->VAT->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_VAT" name="o<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="o<?php echo $health_certificate_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($health_certificate_grid->VAT->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_VAT" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_VAT" name="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->VAT->EditValue ?>"<?php echo $health_certificate_grid->VAT->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_VAT">
<span<?php echo $health_certificate_grid->VAT->viewAttributes() ?>><?php echo $health_certificate_grid->VAT->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_VAT" name="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($health_certificate_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_VAT" name="o<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="o<?php echo $health_certificate_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($health_certificate_grid->VAT->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_VAT" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($health_certificate_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_VAT" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($health_certificate_grid->VAT->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $health_certificate_grid->AmountPaid->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_AmountPaid" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_AmountPaid" name="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->AmountPaid->EditValue ?>"<?php echo $health_certificate_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_AmountPaid" name="o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_AmountPaid" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_AmountPaid" name="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->AmountPaid->EditValue ?>"<?php echo $health_certificate_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_AmountPaid">
<span<?php echo $health_certificate_grid->AmountPaid->viewAttributes() ?>><?php echo $health_certificate_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_AmountPaid" name="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_AmountPaid" name="o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_AmountPaid" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_AmountPaid" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $health_certificate_grid->BillPeriod->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($health_certificate_grid->BillPeriod->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillPeriod" class="form-group">
<span<?php echo $health_certificate_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillPeriod" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BillPeriod->EditValue ?>"<?php echo $health_certificate_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillPeriod" name="o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($health_certificate_grid->BillPeriod->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillPeriod" class="form-group">
<span<?php echo $health_certificate_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillPeriod" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BillPeriod->EditValue ?>"<?php echo $health_certificate_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillPeriod">
<span<?php echo $health_certificate_grid->BillPeriod->viewAttributes() ?>><?php echo $health_certificate_grid->BillPeriod->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BillPeriod" name="o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillPeriod" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BillPeriod" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $health_certificate_grid->PeriodType->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($health_certificate_grid->PeriodType->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_PeriodType" class="form-group">
<span<?php echo $health_certificate_grid->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_PeriodType" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($health_certificate_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->PeriodType->EditValue ?>"<?php echo $health_certificate_grid->PeriodType->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_PeriodType" name="o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($health_certificate_grid->PeriodType->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_PeriodType" class="form-group">
<span<?php echo $health_certificate_grid->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_PeriodType" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($health_certificate_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->PeriodType->EditValue ?>"<?php echo $health_certificate_grid->PeriodType->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_PeriodType">
<span<?php echo $health_certificate_grid->PeriodType->viewAttributes() ?>><?php echo $health_certificate_grid->PeriodType->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_PeriodType" name="o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_PeriodType" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_PeriodType" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $health_certificate_grid->BillYear->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($health_certificate_grid->BillYear->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillYear" class="form-group">
<span<?php echo $health_certificate_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillYear" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BillYear->EditValue ?>"<?php echo $health_certificate_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillYear" name="o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($health_certificate_grid->BillYear->getSessionValue() != "") { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillYear" class="form-group">
<span<?php echo $health_certificate_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillYear" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BillYear->EditValue ?>"<?php echo $health_certificate_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_BillYear">
<span<?php echo $health_certificate_grid->BillYear->viewAttributes() ?>><?php echo $health_certificate_grid->BillYear->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BillYear" name="o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillYear" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_BillYear" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $health_certificate_grid->StartDate->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_StartDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_StartDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->StartDate->EditValue ?>"<?php echo $health_certificate_grid->StartDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->StartDate->ReadOnly && !$health_certificate_grid->StartDate->Disabled && !isset($health_certificate_grid->StartDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_StartDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($health_certificate_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_StartDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_StartDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->StartDate->EditValue ?>"<?php echo $health_certificate_grid->StartDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->StartDate->ReadOnly && !$health_certificate_grid->StartDate->Disabled && !isset($health_certificate_grid->StartDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_StartDate">
<span<?php echo $health_certificate_grid->StartDate->viewAttributes() ?>><?php echo $health_certificate_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_StartDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($health_certificate_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_StartDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($health_certificate_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_StartDate" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($health_certificate_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_StartDate" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($health_certificate_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $health_certificate_grid->EndDate->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_EndDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_EndDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->EndDate->EditValue ?>"<?php echo $health_certificate_grid->EndDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->EndDate->ReadOnly && !$health_certificate_grid->EndDate->Disabled && !isset($health_certificate_grid->EndDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_EndDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($health_certificate_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_EndDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_EndDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->EndDate->EditValue ?>"<?php echo $health_certificate_grid->EndDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->EndDate->ReadOnly && !$health_certificate_grid->EndDate->Disabled && !isset($health_certificate_grid->EndDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_EndDate">
<span<?php echo $health_certificate_grid->EndDate->viewAttributes() ?>><?php echo $health_certificate_grid->EndDate->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_EndDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($health_certificate_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_EndDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($health_certificate_grid->EndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_EndDate" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($health_certificate_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_EndDate" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($health_certificate_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $health_certificate_grid->LastUpdatedBy->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LastUpdatedBy" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_LastUpdatedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LastUpdatedBy->EditValue ?>"<?php echo $health_certificate_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdatedBy" name="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LastUpdatedBy" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_LastUpdatedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LastUpdatedBy->EditValue ?>"<?php echo $health_certificate_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LastUpdatedBy">
<span<?php echo $health_certificate_grid->LastUpdatedBy->viewAttributes() ?>><?php echo $health_certificate_grid->LastUpdatedBy->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdatedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdatedBy" name="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdatedBy" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdatedBy" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $health_certificate_grid->LastUpdateDate->cellAttributes() ?>>
<?php if ($health_certificate->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LastUpdateDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_LastUpdateDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LastUpdateDate->EditValue ?>"<?php echo $health_certificate_grid->LastUpdateDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->LastUpdateDate->ReadOnly && !$health_certificate_grid->LastUpdateDate->Disabled && !isset($health_certificate_grid->LastUpdateDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->LastUpdateDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdateDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LastUpdateDate" class="form-group">
<input type="text" data-table="health_certificate" data-field="x_LastUpdateDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LastUpdateDate->EditValue ?>"<?php echo $health_certificate_grid->LastUpdateDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->LastUpdateDate->ReadOnly && !$health_certificate_grid->LastUpdateDate->Disabled && !isset($health_certificate_grid->LastUpdateDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->LastUpdateDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($health_certificate->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $health_certificate_grid->RowCount ?>_health_certificate_LastUpdateDate">
<span<?php echo $health_certificate_grid->LastUpdateDate->viewAttributes() ?>><?php echo $health_certificate_grid->LastUpdateDate->getViewValue() ?></span>
</span>
<?php if (!$health_certificate->isConfirm()) { ?>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdateDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdateDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdateDate" name="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="fhealth_certificategrid$x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdateDate" name="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="fhealth_certificategrid$o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$health_certificate_grid->ListOptions->render("body", "right", $health_certificate_grid->RowCount);
?>
	</tr>
<?php if ($health_certificate->RowType == ROWTYPE_ADD || $health_certificate->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "load"], function() {
	fhealth_certificategrid.updateLists(<?php echo $health_certificate_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$health_certificate_grid->isGridAdd() || $health_certificate->CurrentMode == "copy")
		if (!$health_certificate_grid->Recordset->EOF)
			$health_certificate_grid->Recordset->moveNext();
}
?>
<?php
	if ($health_certificate->CurrentMode == "add" || $health_certificate->CurrentMode == "copy" || $health_certificate->CurrentMode == "edit") {
		$health_certificate_grid->RowIndex = '$rowindex$';
		$health_certificate_grid->loadRowValues();

		// Set row properties
		$health_certificate->resetAttributes();
		$health_certificate->RowAttrs->merge(["data-rowindex" => $health_certificate_grid->RowIndex, "id" => "r0_health_certificate", "data-rowtype" => ROWTYPE_ADD]);
		$health_certificate->RowAttrs->appendClass("ew-template");
		$health_certificate->RowType = ROWTYPE_ADD;

		// Render row
		$health_certificate_grid->renderRow();

		// Render list options
		$health_certificate_grid->renderListOptions();
		$health_certificate_grid->StartRowCount = 0;
?>
	<tr <?php echo $health_certificate->rowAttributes() ?>>
<?php

// Render list options (body, left)
$health_certificate_grid->ListOptions->render("body", "left", $health_certificate_grid->RowIndex);
?>
	<?php if ($health_certificate_grid->HealthCertificateNo->Visible) { // HealthCertificateNo ?>
		<td data-name="HealthCertificateNo">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_HealthCertificateNo" class="form-group health_certificate_HealthCertificateNo"></span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_HealthCertificateNo" class="form-group health_certificate_HealthCertificateNo">
<span<?php echo $health_certificate_grid->HealthCertificateNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->HealthCertificateNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_HealthCertificateNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_HealthCertificateNo" value="<?php echo HtmlEncode($health_certificate_grid->HealthCertificateNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->LicenceNo->Visible) { // LicenceNo ?>
		<td data-name="LicenceNo">
<?php if (!$health_certificate->isConfirm()) { ?>
<?php if ($health_certificate_grid->LicenceNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_health_certificate_LicenceNo" class="form-group health_certificate_LicenceNo">
<span<?php echo $health_certificate_grid->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->LicenceNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_health_certificate_LicenceNo" class="form-group health_certificate_LicenceNo">
<input type="text" data-table="health_certificate" data-field="x_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LicenceNo->EditValue ?>"<?php echo $health_certificate_grid->LicenceNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_LicenceNo" class="form-group health_certificate_LicenceNo">
<span<?php echo $health_certificate_grid->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->LicenceNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_LicenceNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($health_certificate_grid->LicenceNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BusinessNo->Visible) { // BusinessNo ?>
		<td data-name="BusinessNo">
<?php if (!$health_certificate->isConfirm()) { ?>
<?php if ($health_certificate_grid->BusinessNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_health_certificate_BusinessNo" class="form-group health_certificate_BusinessNo">
<span<?php echo $health_certificate_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_health_certificate_BusinessNo" class="form-group health_certificate_BusinessNo">
<input type="text" data-table="health_certificate" data-field="x_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BusinessNo->EditValue ?>"<?php echo $health_certificate_grid->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_BusinessNo" class="form-group health_certificate_BusinessNo">
<span<?php echo $health_certificate_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_BusinessNo" name="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="x<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_BusinessNo" name="o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" id="o<?php echo $health_certificate_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($health_certificate_grid->BusinessNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->InspectionDate->Visible) { // InspectionDate ?>
		<td data-name="InspectionDate">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_InspectionDate" class="form-group health_certificate_InspectionDate">
<input type="text" data-table="health_certificate" data-field="x_InspectionDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->InspectionDate->EditValue ?>"<?php echo $health_certificate_grid->InspectionDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->InspectionDate->ReadOnly && !$health_certificate_grid->InspectionDate->Disabled && !isset($health_certificate_grid->InspectionDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->InspectionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_InspectionDate" class="form-group health_certificate_InspectionDate">
<span<?php echo $health_certificate_grid->InspectionDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->InspectionDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_InspectionDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" value="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_InspectionDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_InspectionDate" value="<?php echo HtmlEncode($health_certificate_grid->InspectionDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->InspectedBy->Visible) { // InspectedBy ?>
		<td data-name="InspectedBy">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_InspectedBy" class="form-group health_certificate_InspectedBy">
<input type="text" data-table="health_certificate" data-field="x_InspectedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->InspectedBy->EditValue ?>"<?php echo $health_certificate_grid->InspectedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_InspectedBy" class="form-group health_certificate_InspectedBy">
<span<?php echo $health_certificate_grid->InspectedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->InspectedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_InspectedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" value="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_InspectedBy" name="o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" id="o<?php echo $health_certificate_grid->RowIndex ?>_InspectedBy" value="<?php echo HtmlEncode($health_certificate_grid->InspectedBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_ChargeCode" class="form-group health_certificate_ChargeCode">
<input type="text" data-table="health_certificate" data-field="x_ChargeCode" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->ChargeCode->EditValue ?>"<?php echo $health_certificate_grid->ChargeCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_ChargeCode" class="form-group health_certificate_ChargeCode">
<span<?php echo $health_certificate_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeCode" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeCode" name="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" id="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($health_certificate_grid->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_ChargeGroup" class="form-group health_certificate_ChargeGroup">
<input type="text" data-table="health_certificate" data-field="x_ChargeGroup" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->ChargeGroup->EditValue ?>"<?php echo $health_certificate_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_ChargeGroup" class="form-group health_certificate_ChargeGroup">
<span<?php echo $health_certificate_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeGroup" name="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_ChargeGroup" name="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $health_certificate_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($health_certificate_grid->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_BalanceBF" class="form-group health_certificate_BalanceBF">
<input type="text" data-table="health_certificate" data-field="x_BalanceBF" name="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BalanceBF->EditValue ?>"<?php echo $health_certificate_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_BalanceBF" class="form-group health_certificate_BalanceBF">
<span<?php echo $health_certificate_grid->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BalanceBF->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_BalanceBF" name="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="x<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_BalanceBF" name="o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" id="o<?php echo $health_certificate_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($health_certificate_grid->BalanceBF->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_CurrentDemand" class="form-group health_certificate_CurrentDemand">
<input type="text" data-table="health_certificate" data-field="x_CurrentDemand" name="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->CurrentDemand->EditValue ?>"<?php echo $health_certificate_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_CurrentDemand" class="form-group health_certificate_CurrentDemand">
<span<?php echo $health_certificate_grid->CurrentDemand->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->CurrentDemand->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_CurrentDemand" name="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_CurrentDemand" name="o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $health_certificate_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($health_certificate_grid->CurrentDemand->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_VAT" class="form-group health_certificate_VAT">
<input type="text" data-table="health_certificate" data-field="x_VAT" name="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->VAT->EditValue ?>"<?php echo $health_certificate_grid->VAT->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_VAT" class="form-group health_certificate_VAT">
<span<?php echo $health_certificate_grid->VAT->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->VAT->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_VAT" name="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="x<?php echo $health_certificate_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($health_certificate_grid->VAT->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_VAT" name="o<?php echo $health_certificate_grid->RowIndex ?>_VAT" id="o<?php echo $health_certificate_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($health_certificate_grid->VAT->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_AmountPaid" class="form-group health_certificate_AmountPaid">
<input type="text" data-table="health_certificate" data-field="x_AmountPaid" name="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->AmountPaid->EditValue ?>"<?php echo $health_certificate_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_AmountPaid" class="form-group health_certificate_AmountPaid">
<span<?php echo $health_certificate_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_AmountPaid" name="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="x<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_AmountPaid" name="o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" id="o<?php echo $health_certificate_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($health_certificate_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<?php if (!$health_certificate->isConfirm()) { ?>
<?php if ($health_certificate_grid->BillPeriod->getSessionValue() != "") { ?>
<span id="el$rowindex$_health_certificate_BillPeriod" class="form-group health_certificate_BillPeriod">
<span<?php echo $health_certificate_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_health_certificate_BillPeriod" class="form-group health_certificate_BillPeriod">
<input type="text" data-table="health_certificate" data-field="x_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BillPeriod->EditValue ?>"<?php echo $health_certificate_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_BillPeriod" class="form-group health_certificate_BillPeriod">
<span<?php echo $health_certificate_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_BillPeriod" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillPeriod" name="o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" id="o<?php echo $health_certificate_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($health_certificate_grid->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType">
<?php if (!$health_certificate->isConfirm()) { ?>
<?php if ($health_certificate_grid->PeriodType->getSessionValue() != "") { ?>
<span id="el$rowindex$_health_certificate_PeriodType" class="form-group health_certificate_PeriodType">
<span<?php echo $health_certificate_grid->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_health_certificate_PeriodType" class="form-group health_certificate_PeriodType">
<input type="text" data-table="health_certificate" data-field="x_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($health_certificate_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->PeriodType->EditValue ?>"<?php echo $health_certificate_grid->PeriodType->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_PeriodType" class="form-group health_certificate_PeriodType">
<span<?php echo $health_certificate_grid->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_PeriodType" name="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="x<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_PeriodType" name="o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" id="o<?php echo $health_certificate_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($health_certificate_grid->PeriodType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<?php if (!$health_certificate->isConfirm()) { ?>
<?php if ($health_certificate_grid->BillYear->getSessionValue() != "") { ?>
<span id="el$rowindex$_health_certificate_BillYear" class="form-group health_certificate_BillYear">
<span<?php echo $health_certificate_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_health_certificate_BillYear" class="form-group health_certificate_BillYear">
<input type="text" data-table="health_certificate" data-field="x_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($health_certificate_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->BillYear->EditValue ?>"<?php echo $health_certificate_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_BillYear" class="form-group health_certificate_BillYear">
<span<?php echo $health_certificate_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_BillYear" name="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="x<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_BillYear" name="o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" id="o<?php echo $health_certificate_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($health_certificate_grid->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_StartDate" class="form-group health_certificate_StartDate">
<input type="text" data-table="health_certificate" data-field="x_StartDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->StartDate->EditValue ?>"<?php echo $health_certificate_grid->StartDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->StartDate->ReadOnly && !$health_certificate_grid->StartDate->Disabled && !isset($health_certificate_grid->StartDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_StartDate" class="form-group health_certificate_StartDate">
<span<?php echo $health_certificate_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_StartDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($health_certificate_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_StartDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($health_certificate_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_EndDate" class="form-group health_certificate_EndDate">
<input type="text" data-table="health_certificate" data-field="x_EndDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->EndDate->EditValue ?>"<?php echo $health_certificate_grid->EndDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->EndDate->ReadOnly && !$health_certificate_grid->EndDate->Disabled && !isset($health_certificate_grid->EndDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_EndDate" class="form-group health_certificate_EndDate">
<span<?php echo $health_certificate_grid->EndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->EndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_EndDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($health_certificate_grid->EndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_EndDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($health_certificate_grid->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_LastUpdatedBy" class="form-group health_certificate_LastUpdatedBy">
<input type="text" data-table="health_certificate" data-field="x_LastUpdatedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LastUpdatedBy->EditValue ?>"<?php echo $health_certificate_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_LastUpdatedBy" class="form-group health_certificate_LastUpdatedBy">
<span<?php echo $health_certificate_grid->LastUpdatedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->LastUpdatedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdatedBy" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdatedBy" name="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdatedBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($health_certificate_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate">
<?php if (!$health_certificate->isConfirm()) { ?>
<span id="el$rowindex$_health_certificate_LastUpdateDate" class="form-group health_certificate_LastUpdateDate">
<input type="text" data-table="health_certificate" data-field="x_LastUpdateDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $health_certificate_grid->LastUpdateDate->EditValue ?>"<?php echo $health_certificate_grid->LastUpdateDate->editAttributes() ?>>
<?php if (!$health_certificate_grid->LastUpdateDate->ReadOnly && !$health_certificate_grid->LastUpdateDate->Disabled && !isset($health_certificate_grid->LastUpdateDate->EditAttrs["readonly"]) && !isset($health_certificate_grid->LastUpdateDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhealth_certificategrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fhealth_certificategrid", "x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_health_certificate_LastUpdateDate" class="form-group health_certificate_LastUpdateDate">
<span<?php echo $health_certificate_grid->LastUpdateDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($health_certificate_grid->LastUpdateDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdateDate" name="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="health_certificate" data-field="x_LastUpdateDate" name="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $health_certificate_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($health_certificate_grid->LastUpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$health_certificate_grid->ListOptions->render("body", "right", $health_certificate_grid->RowIndex);
?>
<script>
loadjs.ready(["fhealth_certificategrid", "load"], function() {
	fhealth_certificategrid.updateLists(<?php echo $health_certificate_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($health_certificate->CurrentMode == "add" || $health_certificate->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $health_certificate_grid->FormKeyCountName ?>" id="<?php echo $health_certificate_grid->FormKeyCountName ?>" value="<?php echo $health_certificate_grid->KeyCount ?>">
<?php echo $health_certificate_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($health_certificate->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $health_certificate_grid->FormKeyCountName ?>" id="<?php echo $health_certificate_grid->FormKeyCountName ?>" value="<?php echo $health_certificate_grid->KeyCount ?>">
<?php echo $health_certificate_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($health_certificate->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fhealth_certificategrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($health_certificate_grid->Recordset)
	$health_certificate_grid->Recordset->Close();
?>
<?php if ($health_certificate_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $health_certificate_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($health_certificate_grid->TotalRecords == 0 && !$health_certificate->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $health_certificate_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$health_certificate_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$health_certificate_grid->terminate();
?>