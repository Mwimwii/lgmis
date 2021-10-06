<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($licence_account_grid))
	$licence_account_grid = new licence_account_grid();

// Run the page
$licence_account_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$licence_account_grid->Page_Render();
?>
<?php if (!$licence_account_grid->isExport()) { ?>
<script>
var flicence_accountgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	flicence_accountgrid = new ew.Form("flicence_accountgrid", "grid");
	flicence_accountgrid.formKeyCountName = '<?php echo $licence_account_grid->FormKeyCountName ?>';

	// Validate form
	flicence_accountgrid.validate = function() {
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
			<?php if ($licence_account_grid->LicenceNo->Required) { ?>
				elm = this.getElements("x" + infix + "_LicenceNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->LicenceNo->caption(), $licence_account_grid->LicenceNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_grid->BusinessNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->BusinessNo->caption(), $licence_account_grid->BusinessNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BusinessNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->BusinessNo->errorMessage()) ?>");
			<?php if ($licence_account_grid->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->ClientID->caption(), $licence_account_grid->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_grid->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->ChargeCode->caption(), $licence_account_grid->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->ChargeCode->errorMessage()) ?>");
			<?php if ($licence_account_grid->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->ChargeGroup->caption(), $licence_account_grid->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->ChargeGroup->errorMessage()) ?>");
			<?php if ($licence_account_grid->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->BalanceBF->caption(), $licence_account_grid->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->BalanceBF->errorMessage()) ?>");
			<?php if ($licence_account_grid->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->CurrentDemand->caption(), $licence_account_grid->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->CurrentDemand->errorMessage()) ?>");
			<?php if ($licence_account_grid->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->VAT->caption(), $licence_account_grid->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->VAT->errorMessage()) ?>");
			<?php if ($licence_account_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->AmountPaid->caption(), $licence_account_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($licence_account_grid->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->BillPeriod->caption(), $licence_account_grid->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->BillPeriod->errorMessage()) ?>");
			<?php if ($licence_account_grid->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->PeriodType->caption(), $licence_account_grid->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->PeriodType->errorMessage()) ?>");
			<?php if ($licence_account_grid->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->BillYear->caption(), $licence_account_grid->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->BillYear->errorMessage()) ?>");
			<?php if ($licence_account_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->StartDate->caption(), $licence_account_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->StartDate->errorMessage()) ?>");
			<?php if ($licence_account_grid->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->EndDate->caption(), $licence_account_grid->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->EndDate->errorMessage()) ?>");
			<?php if ($licence_account_grid->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->LastUpdatedBy->caption(), $licence_account_grid->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($licence_account_grid->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $licence_account_grid->LastUpdateDate->caption(), $licence_account_grid->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($licence_account_grid->LastUpdateDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	flicence_accountgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "BusinessNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientID", false)) return false;
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
	flicence_accountgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flicence_accountgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flicence_accountgrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$licence_account_grid->renderOtherOptions();
?>
<?php if ($licence_account_grid->TotalRecords > 0 || $licence_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($licence_account_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> licence_account">
<?php if ($licence_account_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $licence_account_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="flicence_accountgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_licence_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_licence_accountgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$licence_account->RowType = ROWTYPE_HEADER;

// Render list options
$licence_account_grid->renderListOptions();

// Render list options (header, left)
$licence_account_grid->ListOptions->render("header", "left");
?>
<?php if ($licence_account_grid->LicenceNo->Visible) { // LicenceNo ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->LicenceNo) == "") { ?>
		<th data-name="LicenceNo" class="<?php echo $licence_account_grid->LicenceNo->headerCellClass() ?>"><div id="elh_licence_account_LicenceNo" class="licence_account_LicenceNo"><div class="ew-table-header-caption"><?php echo $licence_account_grid->LicenceNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LicenceNo" class="<?php echo $licence_account_grid->LicenceNo->headerCellClass() ?>"><div><div id="elh_licence_account_LicenceNo" class="licence_account_LicenceNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->LicenceNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->LicenceNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->LicenceNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->BusinessNo->Visible) { // BusinessNo ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->BusinessNo) == "") { ?>
		<th data-name="BusinessNo" class="<?php echo $licence_account_grid->BusinessNo->headerCellClass() ?>"><div id="elh_licence_account_BusinessNo" class="licence_account_BusinessNo"><div class="ew-table-header-caption"><?php echo $licence_account_grid->BusinessNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessNo" class="<?php echo $licence_account_grid->BusinessNo->headerCellClass() ?>"><div><div id="elh_licence_account_BusinessNo" class="licence_account_BusinessNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->BusinessNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->BusinessNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->BusinessNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->ClientID->Visible) { // ClientID ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $licence_account_grid->ClientID->headerCellClass() ?>"><div id="elh_licence_account_ClientID" class="licence_account_ClientID"><div class="ew-table-header-caption"><?php echo $licence_account_grid->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $licence_account_grid->ClientID->headerCellClass() ?>"><div><div id="elh_licence_account_ClientID" class="licence_account_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $licence_account_grid->ChargeCode->headerCellClass() ?>"><div id="elh_licence_account_ChargeCode" class="licence_account_ChargeCode"><div class="ew-table-header-caption"><?php echo $licence_account_grid->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $licence_account_grid->ChargeCode->headerCellClass() ?>"><div><div id="elh_licence_account_ChargeCode" class="licence_account_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $licence_account_grid->ChargeGroup->headerCellClass() ?>"><div id="elh_licence_account_ChargeGroup" class="licence_account_ChargeGroup"><div class="ew-table-header-caption"><?php echo $licence_account_grid->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $licence_account_grid->ChargeGroup->headerCellClass() ?>"><div><div id="elh_licence_account_ChargeGroup" class="licence_account_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $licence_account_grid->BalanceBF->headerCellClass() ?>"><div id="elh_licence_account_BalanceBF" class="licence_account_BalanceBF"><div class="ew-table-header-caption"><?php echo $licence_account_grid->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $licence_account_grid->BalanceBF->headerCellClass() ?>"><div><div id="elh_licence_account_BalanceBF" class="licence_account_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $licence_account_grid->CurrentDemand->headerCellClass() ?>"><div id="elh_licence_account_CurrentDemand" class="licence_account_CurrentDemand"><div class="ew-table-header-caption"><?php echo $licence_account_grid->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $licence_account_grid->CurrentDemand->headerCellClass() ?>"><div><div id="elh_licence_account_CurrentDemand" class="licence_account_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->VAT->Visible) { // VAT ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $licence_account_grid->VAT->headerCellClass() ?>"><div id="elh_licence_account_VAT" class="licence_account_VAT"><div class="ew-table-header-caption"><?php echo $licence_account_grid->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $licence_account_grid->VAT->headerCellClass() ?>"><div><div id="elh_licence_account_VAT" class="licence_account_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $licence_account_grid->AmountPaid->headerCellClass() ?>"><div id="elh_licence_account_AmountPaid" class="licence_account_AmountPaid"><div class="ew-table-header-caption"><?php echo $licence_account_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $licence_account_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_licence_account_AmountPaid" class="licence_account_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $licence_account_grid->BillPeriod->headerCellClass() ?>"><div id="elh_licence_account_BillPeriod" class="licence_account_BillPeriod"><div class="ew-table-header-caption"><?php echo $licence_account_grid->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $licence_account_grid->BillPeriod->headerCellClass() ?>"><div><div id="elh_licence_account_BillPeriod" class="licence_account_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->PeriodType->Visible) { // PeriodType ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $licence_account_grid->PeriodType->headerCellClass() ?>"><div id="elh_licence_account_PeriodType" class="licence_account_PeriodType"><div class="ew-table-header-caption"><?php echo $licence_account_grid->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $licence_account_grid->PeriodType->headerCellClass() ?>"><div><div id="elh_licence_account_PeriodType" class="licence_account_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->BillYear->Visible) { // BillYear ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $licence_account_grid->BillYear->headerCellClass() ?>"><div id="elh_licence_account_BillYear" class="licence_account_BillYear"><div class="ew-table-header-caption"><?php echo $licence_account_grid->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $licence_account_grid->BillYear->headerCellClass() ?>"><div><div id="elh_licence_account_BillYear" class="licence_account_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $licence_account_grid->StartDate->headerCellClass() ?>"><div id="elh_licence_account_StartDate" class="licence_account_StartDate"><div class="ew-table-header-caption"><?php echo $licence_account_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $licence_account_grid->StartDate->headerCellClass() ?>"><div><div id="elh_licence_account_StartDate" class="licence_account_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->EndDate->Visible) { // EndDate ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $licence_account_grid->EndDate->headerCellClass() ?>"><div id="elh_licence_account_EndDate" class="licence_account_EndDate"><div class="ew-table-header-caption"><?php echo $licence_account_grid->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $licence_account_grid->EndDate->headerCellClass() ?>"><div><div id="elh_licence_account_EndDate" class="licence_account_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $licence_account_grid->LastUpdatedBy->headerCellClass() ?>"><div id="elh_licence_account_LastUpdatedBy" class="licence_account_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $licence_account_grid->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $licence_account_grid->LastUpdatedBy->headerCellClass() ?>"><div><div id="elh_licence_account_LastUpdatedBy" class="licence_account_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($licence_account_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($licence_account_grid->SortUrl($licence_account_grid->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $licence_account_grid->LastUpdateDate->headerCellClass() ?>"><div id="elh_licence_account_LastUpdateDate" class="licence_account_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $licence_account_grid->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $licence_account_grid->LastUpdateDate->headerCellClass() ?>"><div><div id="elh_licence_account_LastUpdateDate" class="licence_account_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $licence_account_grid->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($licence_account_grid->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($licence_account_grid->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$licence_account_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$licence_account_grid->StartRecord = 1;
$licence_account_grid->StopRecord = $licence_account_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($licence_account->isConfirm() || $licence_account_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($licence_account_grid->FormKeyCountName) && ($licence_account_grid->isGridAdd() || $licence_account_grid->isGridEdit() || $licence_account->isConfirm())) {
		$licence_account_grid->KeyCount = $CurrentForm->getValue($licence_account_grid->FormKeyCountName);
		$licence_account_grid->StopRecord = $licence_account_grid->StartRecord + $licence_account_grid->KeyCount - 1;
	}
}
$licence_account_grid->RecordCount = $licence_account_grid->StartRecord - 1;
if ($licence_account_grid->Recordset && !$licence_account_grid->Recordset->EOF) {
	$licence_account_grid->Recordset->moveFirst();
	$selectLimit = $licence_account_grid->UseSelectLimit;
	if (!$selectLimit && $licence_account_grid->StartRecord > 1)
		$licence_account_grid->Recordset->move($licence_account_grid->StartRecord - 1);
} elseif (!$licence_account->AllowAddDeleteRow && $licence_account_grid->StopRecord == 0) {
	$licence_account_grid->StopRecord = $licence_account->GridAddRowCount;
}

// Initialize aggregate
$licence_account->RowType = ROWTYPE_AGGREGATEINIT;
$licence_account->resetAttributes();
$licence_account_grid->renderRow();
if ($licence_account_grid->isGridAdd())
	$licence_account_grid->RowIndex = 0;
if ($licence_account_grid->isGridEdit())
	$licence_account_grid->RowIndex = 0;
while ($licence_account_grid->RecordCount < $licence_account_grid->StopRecord) {
	$licence_account_grid->RecordCount++;
	if ($licence_account_grid->RecordCount >= $licence_account_grid->StartRecord) {
		$licence_account_grid->RowCount++;
		if ($licence_account_grid->isGridAdd() || $licence_account_grid->isGridEdit() || $licence_account->isConfirm()) {
			$licence_account_grid->RowIndex++;
			$CurrentForm->Index = $licence_account_grid->RowIndex;
			if ($CurrentForm->hasValue($licence_account_grid->FormActionName) && ($licence_account->isConfirm() || $licence_account_grid->EventCancelled))
				$licence_account_grid->RowAction = strval($CurrentForm->getValue($licence_account_grid->FormActionName));
			elseif ($licence_account_grid->isGridAdd())
				$licence_account_grid->RowAction = "insert";
			else
				$licence_account_grid->RowAction = "";
		}

		// Set up key count
		$licence_account_grid->KeyCount = $licence_account_grid->RowIndex;

		// Init row class and style
		$licence_account->resetAttributes();
		$licence_account->CssClass = "";
		if ($licence_account_grid->isGridAdd()) {
			if ($licence_account->CurrentMode == "copy") {
				$licence_account_grid->loadRowValues($licence_account_grid->Recordset); // Load row values
				$licence_account_grid->setRecordKey($licence_account_grid->RowOldKey, $licence_account_grid->Recordset); // Set old record key
			} else {
				$licence_account_grid->loadRowValues(); // Load default values
				$licence_account_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$licence_account_grid->loadRowValues($licence_account_grid->Recordset); // Load row values
		}
		$licence_account->RowType = ROWTYPE_VIEW; // Render view
		if ($licence_account_grid->isGridAdd()) // Grid add
			$licence_account->RowType = ROWTYPE_ADD; // Render add
		if ($licence_account_grid->isGridAdd() && $licence_account->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$licence_account_grid->restoreCurrentRowFormValues($licence_account_grid->RowIndex); // Restore form values
		if ($licence_account_grid->isGridEdit()) { // Grid edit
			if ($licence_account->EventCancelled)
				$licence_account_grid->restoreCurrentRowFormValues($licence_account_grid->RowIndex); // Restore form values
			if ($licence_account_grid->RowAction == "insert")
				$licence_account->RowType = ROWTYPE_ADD; // Render add
			else
				$licence_account->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($licence_account_grid->isGridEdit() && ($licence_account->RowType == ROWTYPE_EDIT || $licence_account->RowType == ROWTYPE_ADD) && $licence_account->EventCancelled) // Update failed
			$licence_account_grid->restoreCurrentRowFormValues($licence_account_grid->RowIndex); // Restore form values
		if ($licence_account->RowType == ROWTYPE_EDIT) // Edit row
			$licence_account_grid->EditRowCount++;
		if ($licence_account->isConfirm()) // Confirm row
			$licence_account_grid->restoreCurrentRowFormValues($licence_account_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$licence_account->RowAttrs->merge(["data-rowindex" => $licence_account_grid->RowCount, "id" => "r" . $licence_account_grid->RowCount . "_licence_account", "data-rowtype" => $licence_account->RowType]);

		// Render row
		$licence_account_grid->renderRow();

		// Render list options
		$licence_account_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($licence_account_grid->RowAction != "delete" && $licence_account_grid->RowAction != "insertdelete" && !($licence_account_grid->RowAction == "insert" && $licence_account->isConfirm() && $licence_account_grid->emptyRow())) {
?>
	<tr <?php echo $licence_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$licence_account_grid->ListOptions->render("body", "left", $licence_account_grid->RowCount);
?>
	<?php if ($licence_account_grid->LicenceNo->Visible) { // LicenceNo ?>
		<td data-name="LicenceNo" <?php echo $licence_account_grid->LicenceNo->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LicenceNo" class="form-group"></span>
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LicenceNo" class="form-group">
<span<?php echo $licence_account_grid->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->LicenceNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->CurrentValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LicenceNo">
<span<?php echo $licence_account_grid->LicenceNo->viewAttributes() ?>><?php echo $licence_account_grid->LicenceNo->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BusinessNo->Visible) { // BusinessNo ?>
		<td data-name="BusinessNo" <?php echo $licence_account_grid->BusinessNo->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($licence_account_grid->BusinessNo->getSessionValue() != "") { ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BusinessNo" class="form-group">
<span<?php echo $licence_account_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BusinessNo" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BusinessNo->EditValue ?>"<?php echo $licence_account_grid->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_BusinessNo" name="o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($licence_account_grid->BusinessNo->getSessionValue() != "") { ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BusinessNo" class="form-group">
<span<?php echo $licence_account_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BusinessNo" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BusinessNo->EditValue ?>"<?php echo $licence_account_grid->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BusinessNo">
<span<?php echo $licence_account_grid->BusinessNo->viewAttributes() ?>><?php echo $licence_account_grid->BusinessNo->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BusinessNo" name="o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_BusinessNo" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BusinessNo" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $licence_account_grid->ClientID->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ClientID" class="form-group">
<input type="text" data-table="licence_account" data-field="x_ClientID" name="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($licence_account_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ClientID->EditValue ?>"<?php echo $licence_account_grid->ClientID->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_ClientID" name="o<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="o<?php echo $licence_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($licence_account_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ClientID" class="form-group">
<input type="text" data-table="licence_account" data-field="x_ClientID" name="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($licence_account_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ClientID->EditValue ?>"<?php echo $licence_account_grid->ClientID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ClientID">
<span<?php echo $licence_account_grid->ClientID->viewAttributes() ?>><?php echo $licence_account_grid->ClientID->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_ClientID" name="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($licence_account_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_ClientID" name="o<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="o<?php echo $licence_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($licence_account_grid->ClientID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_ClientID" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($licence_account_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_ClientID" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($licence_account_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $licence_account_grid->ChargeCode->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ChargeCode" class="form-group">
<input type="text" data-table="licence_account" data-field="x_ChargeCode" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ChargeCode->EditValue ?>"<?php echo $licence_account_grid->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_ChargeCode" name="o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($licence_account_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ChargeCode" class="form-group">
<input type="text" data-table="licence_account" data-field="x_ChargeCode" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ChargeCode->EditValue ?>"<?php echo $licence_account_grid->ChargeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ChargeCode">
<span<?php echo $licence_account_grid->ChargeCode->viewAttributes() ?>><?php echo $licence_account_grid->ChargeCode->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_ChargeCode" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($licence_account_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_ChargeCode" name="o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($licence_account_grid->ChargeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_ChargeCode" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($licence_account_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_ChargeCode" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($licence_account_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $licence_account_grid->ChargeGroup->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ChargeGroup" class="form-group">
<input type="text" data-table="licence_account" data-field="x_ChargeGroup" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ChargeGroup->EditValue ?>"<?php echo $licence_account_grid->ChargeGroup->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_ChargeGroup" name="o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ChargeGroup" class="form-group">
<input type="text" data-table="licence_account" data-field="x_ChargeGroup" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ChargeGroup->EditValue ?>"<?php echo $licence_account_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_ChargeGroup">
<span<?php echo $licence_account_grid->ChargeGroup->viewAttributes() ?>><?php echo $licence_account_grid->ChargeGroup->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_ChargeGroup" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_ChargeGroup" name="o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_ChargeGroup" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_ChargeGroup" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $licence_account_grid->BalanceBF->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BalanceBF" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BalanceBF" name="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BalanceBF->EditValue ?>"<?php echo $licence_account_grid->BalanceBF->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_BalanceBF" name="o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($licence_account_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BalanceBF" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BalanceBF" name="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BalanceBF->EditValue ?>"<?php echo $licence_account_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BalanceBF">
<span<?php echo $licence_account_grid->BalanceBF->viewAttributes() ?>><?php echo $licence_account_grid->BalanceBF->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_BalanceBF" name="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($licence_account_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BalanceBF" name="o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($licence_account_grid->BalanceBF->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_BalanceBF" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($licence_account_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BalanceBF" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($licence_account_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $licence_account_grid->CurrentDemand->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_CurrentDemand" class="form-group">
<input type="text" data-table="licence_account" data-field="x_CurrentDemand" name="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->CurrentDemand->EditValue ?>"<?php echo $licence_account_grid->CurrentDemand->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_CurrentDemand" name="o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_CurrentDemand" class="form-group">
<input type="text" data-table="licence_account" data-field="x_CurrentDemand" name="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->CurrentDemand->EditValue ?>"<?php echo $licence_account_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_CurrentDemand">
<span<?php echo $licence_account_grid->CurrentDemand->viewAttributes() ?>><?php echo $licence_account_grid->CurrentDemand->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_CurrentDemand" name="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_CurrentDemand" name="o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_CurrentDemand" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_CurrentDemand" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $licence_account_grid->VAT->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_VAT" class="form-group">
<input type="text" data-table="licence_account" data-field="x_VAT" name="x<?php echo $licence_account_grid->RowIndex ?>_VAT" id="x<?php echo $licence_account_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->VAT->EditValue ?>"<?php echo $licence_account_grid->VAT->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_VAT" name="o<?php echo $licence_account_grid->RowIndex ?>_VAT" id="o<?php echo $licence_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($licence_account_grid->VAT->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_VAT" class="form-group">
<input type="text" data-table="licence_account" data-field="x_VAT" name="x<?php echo $licence_account_grid->RowIndex ?>_VAT" id="x<?php echo $licence_account_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->VAT->EditValue ?>"<?php echo $licence_account_grid->VAT->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_VAT">
<span<?php echo $licence_account_grid->VAT->viewAttributes() ?>><?php echo $licence_account_grid->VAT->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_VAT" name="x<?php echo $licence_account_grid->RowIndex ?>_VAT" id="x<?php echo $licence_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($licence_account_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_VAT" name="o<?php echo $licence_account_grid->RowIndex ?>_VAT" id="o<?php echo $licence_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($licence_account_grid->VAT->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_VAT" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_VAT" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($licence_account_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_VAT" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_VAT" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($licence_account_grid->VAT->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $licence_account_grid->AmountPaid->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_AmountPaid" class="form-group">
<input type="text" data-table="licence_account" data-field="x_AmountPaid" name="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->AmountPaid->EditValue ?>"<?php echo $licence_account_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_AmountPaid" name="o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($licence_account_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_AmountPaid" class="form-group">
<input type="text" data-table="licence_account" data-field="x_AmountPaid" name="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->AmountPaid->EditValue ?>"<?php echo $licence_account_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_AmountPaid">
<span<?php echo $licence_account_grid->AmountPaid->viewAttributes() ?>><?php echo $licence_account_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_AmountPaid" name="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($licence_account_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_AmountPaid" name="o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($licence_account_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_AmountPaid" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($licence_account_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_AmountPaid" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($licence_account_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $licence_account_grid->BillPeriod->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BillPeriod" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BillPeriod" name="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BillPeriod->EditValue ?>"<?php echo $licence_account_grid->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_BillPeriod" name="o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($licence_account_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BillPeriod" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BillPeriod" name="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BillPeriod->EditValue ?>"<?php echo $licence_account_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BillPeriod">
<span<?php echo $licence_account_grid->BillPeriod->viewAttributes() ?>><?php echo $licence_account_grid->BillPeriod->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_BillPeriod" name="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($licence_account_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BillPeriod" name="o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($licence_account_grid->BillPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_BillPeriod" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($licence_account_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BillPeriod" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($licence_account_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $licence_account_grid->PeriodType->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_PeriodType" class="form-group">
<input type="text" data-table="licence_account" data-field="x_PeriodType" name="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->PeriodType->EditValue ?>"<?php echo $licence_account_grid->PeriodType->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_PeriodType" name="o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($licence_account_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_PeriodType" class="form-group">
<input type="text" data-table="licence_account" data-field="x_PeriodType" name="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->PeriodType->EditValue ?>"<?php echo $licence_account_grid->PeriodType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_PeriodType">
<span<?php echo $licence_account_grid->PeriodType->viewAttributes() ?>><?php echo $licence_account_grid->PeriodType->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_PeriodType" name="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($licence_account_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_PeriodType" name="o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($licence_account_grid->PeriodType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_PeriodType" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($licence_account_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_PeriodType" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($licence_account_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $licence_account_grid->BillYear->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BillYear" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BillYear" name="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BillYear->EditValue ?>"<?php echo $licence_account_grid->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_BillYear" name="o<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="o<?php echo $licence_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($licence_account_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BillYear" class="form-group">
<input type="text" data-table="licence_account" data-field="x_BillYear" name="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BillYear->EditValue ?>"<?php echo $licence_account_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_BillYear">
<span<?php echo $licence_account_grid->BillYear->viewAttributes() ?>><?php echo $licence_account_grid->BillYear->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_BillYear" name="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($licence_account_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BillYear" name="o<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="o<?php echo $licence_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($licence_account_grid->BillYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_BillYear" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($licence_account_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_BillYear" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($licence_account_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $licence_account_grid->StartDate->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_StartDate" class="form-group">
<input type="text" data-table="licence_account" data-field="x_StartDate" name="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($licence_account_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->StartDate->EditValue ?>"<?php echo $licence_account_grid->StartDate->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_StartDate" name="o<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="o<?php echo $licence_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($licence_account_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_StartDate" class="form-group">
<input type="text" data-table="licence_account" data-field="x_StartDate" name="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($licence_account_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->StartDate->EditValue ?>"<?php echo $licence_account_grid->StartDate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_StartDate">
<span<?php echo $licence_account_grid->StartDate->viewAttributes() ?>><?php echo $licence_account_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_StartDate" name="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($licence_account_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_StartDate" name="o<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="o<?php echo $licence_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($licence_account_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_StartDate" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($licence_account_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_StartDate" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($licence_account_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $licence_account_grid->EndDate->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_EndDate" class="form-group">
<input type="text" data-table="licence_account" data-field="x_EndDate" name="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($licence_account_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->EndDate->EditValue ?>"<?php echo $licence_account_grid->EndDate->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_EndDate" name="o<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="o<?php echo $licence_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($licence_account_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_EndDate" class="form-group">
<input type="text" data-table="licence_account" data-field="x_EndDate" name="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($licence_account_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->EndDate->EditValue ?>"<?php echo $licence_account_grid->EndDate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_EndDate">
<span<?php echo $licence_account_grid->EndDate->viewAttributes() ?>><?php echo $licence_account_grid->EndDate->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_EndDate" name="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($licence_account_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_EndDate" name="o<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="o<?php echo $licence_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($licence_account_grid->EndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_EndDate" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($licence_account_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_EndDate" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($licence_account_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $licence_account_grid->LastUpdatedBy->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LastUpdatedBy" class="form-group">
<input type="text" data-table="licence_account" data-field="x_LastUpdatedBy" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->LastUpdatedBy->EditValue ?>"<?php echo $licence_account_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdatedBy" name="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LastUpdatedBy" class="form-group">
<input type="text" data-table="licence_account" data-field="x_LastUpdatedBy" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->LastUpdatedBy->EditValue ?>"<?php echo $licence_account_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LastUpdatedBy">
<span<?php echo $licence_account_grid->LastUpdatedBy->viewAttributes() ?>><?php echo $licence_account_grid->LastUpdatedBy->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdatedBy" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_LastUpdatedBy" name="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdatedBy" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_LastUpdatedBy" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($licence_account_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $licence_account_grid->LastUpdateDate->cellAttributes() ?>>
<?php if ($licence_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LastUpdateDate" class="form-group">
<input type="text" data-table="licence_account" data-field="x_LastUpdateDate" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->LastUpdateDate->EditValue ?>"<?php echo $licence_account_grid->LastUpdateDate->editAttributes() ?>>
</span>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdateDate" name="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LastUpdateDate" class="form-group">
<input type="text" data-table="licence_account" data-field="x_LastUpdateDate" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->LastUpdateDate->EditValue ?>"<?php echo $licence_account_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($licence_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $licence_account_grid->RowCount ?>_licence_account_LastUpdateDate">
<span<?php echo $licence_account_grid->LastUpdateDate->viewAttributes() ?>><?php echo $licence_account_grid->LastUpdateDate->getViewValue() ?></span>
</span>
<?php if (!$licence_account->isConfirm()) { ?>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdateDate" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_LastUpdateDate" name="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdateDate" name="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="flicence_accountgrid$x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="licence_account" data-field="x_LastUpdateDate" name="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="flicence_accountgrid$o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$licence_account_grid->ListOptions->render("body", "right", $licence_account_grid->RowCount);
?>
	</tr>
<?php if ($licence_account->RowType == ROWTYPE_ADD || $licence_account->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["flicence_accountgrid", "load"], function() {
	flicence_accountgrid.updateLists(<?php echo $licence_account_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$licence_account_grid->isGridAdd() || $licence_account->CurrentMode == "copy")
		if (!$licence_account_grid->Recordset->EOF)
			$licence_account_grid->Recordset->moveNext();
}
?>
<?php
	if ($licence_account->CurrentMode == "add" || $licence_account->CurrentMode == "copy" || $licence_account->CurrentMode == "edit") {
		$licence_account_grid->RowIndex = '$rowindex$';
		$licence_account_grid->loadRowValues();

		// Set row properties
		$licence_account->resetAttributes();
		$licence_account->RowAttrs->merge(["data-rowindex" => $licence_account_grid->RowIndex, "id" => "r0_licence_account", "data-rowtype" => ROWTYPE_ADD]);
		$licence_account->RowAttrs->appendClass("ew-template");
		$licence_account->RowType = ROWTYPE_ADD;

		// Render row
		$licence_account_grid->renderRow();

		// Render list options
		$licence_account_grid->renderListOptions();
		$licence_account_grid->StartRowCount = 0;
?>
	<tr <?php echo $licence_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$licence_account_grid->ListOptions->render("body", "left", $licence_account_grid->RowIndex);
?>
	<?php if ($licence_account_grid->LicenceNo->Visible) { // LicenceNo ?>
		<td data-name="LicenceNo">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_LicenceNo" class="form-group licence_account_LicenceNo"></span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_LicenceNo" class="form-group licence_account_LicenceNo">
<span<?php echo $licence_account_grid->LicenceNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->LicenceNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="x<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_LicenceNo" name="o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" id="o<?php echo $licence_account_grid->RowIndex ?>_LicenceNo" value="<?php echo HtmlEncode($licence_account_grid->LicenceNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BusinessNo->Visible) { // BusinessNo ?>
		<td data-name="BusinessNo">
<?php if (!$licence_account->isConfirm()) { ?>
<?php if ($licence_account_grid->BusinessNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_licence_account_BusinessNo" class="form-group licence_account_BusinessNo">
<span<?php echo $licence_account_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_licence_account_BusinessNo" class="form-group licence_account_BusinessNo">
<input type="text" data-table="licence_account" data-field="x_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BusinessNo->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BusinessNo->EditValue ?>"<?php echo $licence_account_grid->BusinessNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_licence_account_BusinessNo" class="form-group licence_account_BusinessNo">
<span<?php echo $licence_account_grid->BusinessNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->BusinessNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_BusinessNo" name="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="x<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_BusinessNo" name="o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" id="o<?php echo $licence_account_grid->RowIndex ?>_BusinessNo" value="<?php echo HtmlEncode($licence_account_grid->BusinessNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_ClientID" class="form-group licence_account_ClientID">
<input type="text" data-table="licence_account" data-field="x_ClientID" name="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($licence_account_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ClientID->EditValue ?>"<?php echo $licence_account_grid->ClientID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_ClientID" class="form-group licence_account_ClientID">
<span<?php echo $licence_account_grid->ClientID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->ClientID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_ClientID" name="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="x<?php echo $licence_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($licence_account_grid->ClientID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_ClientID" name="o<?php echo $licence_account_grid->RowIndex ?>_ClientID" id="o<?php echo $licence_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($licence_account_grid->ClientID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_ChargeCode" class="form-group licence_account_ChargeCode">
<input type="text" data-table="licence_account" data-field="x_ChargeCode" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ChargeCode->EditValue ?>"<?php echo $licence_account_grid->ChargeCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_ChargeCode" class="form-group licence_account_ChargeCode">
<span<?php echo $licence_account_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_ChargeCode" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($licence_account_grid->ChargeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_ChargeCode" name="o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" id="o<?php echo $licence_account_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($licence_account_grid->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_ChargeGroup" class="form-group licence_account_ChargeGroup">
<input type="text" data-table="licence_account" data-field="x_ChargeGroup" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->ChargeGroup->EditValue ?>"<?php echo $licence_account_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_ChargeGroup" class="form-group licence_account_ChargeGroup">
<span<?php echo $licence_account_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_ChargeGroup" name="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_ChargeGroup" name="o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $licence_account_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($licence_account_grid->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_BalanceBF" class="form-group licence_account_BalanceBF">
<input type="text" data-table="licence_account" data-field="x_BalanceBF" name="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BalanceBF->EditValue ?>"<?php echo $licence_account_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_BalanceBF" class="form-group licence_account_BalanceBF">
<span<?php echo $licence_account_grid->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->BalanceBF->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_BalanceBF" name="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($licence_account_grid->BalanceBF->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_BalanceBF" name="o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" id="o<?php echo $licence_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($licence_account_grid->BalanceBF->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_CurrentDemand" class="form-group licence_account_CurrentDemand">
<input type="text" data-table="licence_account" data-field="x_CurrentDemand" name="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->CurrentDemand->EditValue ?>"<?php echo $licence_account_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_CurrentDemand" class="form-group licence_account_CurrentDemand">
<span<?php echo $licence_account_grid->CurrentDemand->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->CurrentDemand->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_CurrentDemand" name="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_CurrentDemand" name="o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $licence_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($licence_account_grid->CurrentDemand->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_VAT" class="form-group licence_account_VAT">
<input type="text" data-table="licence_account" data-field="x_VAT" name="x<?php echo $licence_account_grid->RowIndex ?>_VAT" id="x<?php echo $licence_account_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->VAT->EditValue ?>"<?php echo $licence_account_grid->VAT->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_VAT" class="form-group licence_account_VAT">
<span<?php echo $licence_account_grid->VAT->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->VAT->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_VAT" name="x<?php echo $licence_account_grid->RowIndex ?>_VAT" id="x<?php echo $licence_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($licence_account_grid->VAT->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_VAT" name="o<?php echo $licence_account_grid->RowIndex ?>_VAT" id="o<?php echo $licence_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($licence_account_grid->VAT->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_AmountPaid" class="form-group licence_account_AmountPaid">
<input type="text" data-table="licence_account" data-field="x_AmountPaid" name="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->AmountPaid->EditValue ?>"<?php echo $licence_account_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_AmountPaid" class="form-group licence_account_AmountPaid">
<span<?php echo $licence_account_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_AmountPaid" name="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($licence_account_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_AmountPaid" name="o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" id="o<?php echo $licence_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($licence_account_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_BillPeriod" class="form-group licence_account_BillPeriod">
<input type="text" data-table="licence_account" data-field="x_BillPeriod" name="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BillPeriod->EditValue ?>"<?php echo $licence_account_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_BillPeriod" class="form-group licence_account_BillPeriod">
<span<?php echo $licence_account_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_BillPeriod" name="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($licence_account_grid->BillPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_BillPeriod" name="o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" id="o<?php echo $licence_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($licence_account_grid->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_PeriodType" class="form-group licence_account_PeriodType">
<input type="text" data-table="licence_account" data-field="x_PeriodType" name="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->PeriodType->EditValue ?>"<?php echo $licence_account_grid->PeriodType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_PeriodType" class="form-group licence_account_PeriodType">
<span<?php echo $licence_account_grid->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_PeriodType" name="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="x<?php echo $licence_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($licence_account_grid->PeriodType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_PeriodType" name="o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" id="o<?php echo $licence_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($licence_account_grid->PeriodType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_BillYear" class="form-group licence_account_BillYear">
<input type="text" data-table="licence_account" data-field="x_BillYear" name="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($licence_account_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->BillYear->EditValue ?>"<?php echo $licence_account_grid->BillYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_BillYear" class="form-group licence_account_BillYear">
<span<?php echo $licence_account_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_BillYear" name="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="x<?php echo $licence_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($licence_account_grid->BillYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_BillYear" name="o<?php echo $licence_account_grid->RowIndex ?>_BillYear" id="o<?php echo $licence_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($licence_account_grid->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_StartDate" class="form-group licence_account_StartDate">
<input type="text" data-table="licence_account" data-field="x_StartDate" name="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($licence_account_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->StartDate->EditValue ?>"<?php echo $licence_account_grid->StartDate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_StartDate" class="form-group licence_account_StartDate">
<span<?php echo $licence_account_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_StartDate" name="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="x<?php echo $licence_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($licence_account_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_StartDate" name="o<?php echo $licence_account_grid->RowIndex ?>_StartDate" id="o<?php echo $licence_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($licence_account_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_EndDate" class="form-group licence_account_EndDate">
<input type="text" data-table="licence_account" data-field="x_EndDate" name="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($licence_account_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->EndDate->EditValue ?>"<?php echo $licence_account_grid->EndDate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_EndDate" class="form-group licence_account_EndDate">
<span<?php echo $licence_account_grid->EndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->EndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_EndDate" name="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="x<?php echo $licence_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($licence_account_grid->EndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_EndDate" name="o<?php echo $licence_account_grid->RowIndex ?>_EndDate" id="o<?php echo $licence_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($licence_account_grid->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_LastUpdatedBy" class="form-group licence_account_LastUpdatedBy">
<input type="text" data-table="licence_account" data-field="x_LastUpdatedBy" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->LastUpdatedBy->EditValue ?>"<?php echo $licence_account_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_LastUpdatedBy" class="form-group licence_account_LastUpdatedBy">
<span<?php echo $licence_account_grid->LastUpdatedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->LastUpdatedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdatedBy" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdatedBy" name="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($licence_account_grid->LastUpdatedBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($licence_account_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate">
<?php if (!$licence_account->isConfirm()) { ?>
<span id="el$rowindex$_licence_account_LastUpdateDate" class="form-group licence_account_LastUpdateDate">
<input type="text" data-table="licence_account" data-field="x_LastUpdateDate" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $licence_account_grid->LastUpdateDate->EditValue ?>"<?php echo $licence_account_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_licence_account_LastUpdateDate" class="form-group licence_account_LastUpdateDate">
<span<?php echo $licence_account_grid->LastUpdateDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($licence_account_grid->LastUpdateDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdateDate" name="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="licence_account" data-field="x_LastUpdateDate" name="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $licence_account_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($licence_account_grid->LastUpdateDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$licence_account_grid->ListOptions->render("body", "right", $licence_account_grid->RowIndex);
?>
<script>
loadjs.ready(["flicence_accountgrid", "load"], function() {
	flicence_accountgrid.updateLists(<?php echo $licence_account_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($licence_account->CurrentMode == "add" || $licence_account->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $licence_account_grid->FormKeyCountName ?>" id="<?php echo $licence_account_grid->FormKeyCountName ?>" value="<?php echo $licence_account_grid->KeyCount ?>">
<?php echo $licence_account_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($licence_account->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $licence_account_grid->FormKeyCountName ?>" id="<?php echo $licence_account_grid->FormKeyCountName ?>" value="<?php echo $licence_account_grid->KeyCount ?>">
<?php echo $licence_account_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($licence_account->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="flicence_accountgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($licence_account_grid->Recordset)
	$licence_account_grid->Recordset->Close();
?>
<?php if ($licence_account_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $licence_account_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($licence_account_grid->TotalRecords == 0 && !$licence_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $licence_account_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$licence_account_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$licence_account->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_licence_account",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$licence_account_grid->terminate();
?>