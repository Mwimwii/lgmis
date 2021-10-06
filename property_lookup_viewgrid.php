<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($property_lookup_view_grid))
	$property_lookup_view_grid = new property_lookup_view_grid();

// Run the page
$property_lookup_view_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_lookup_view_grid->Page_Render();
?>
<?php if (!$property_lookup_view_grid->isExport()) { ?>
<script>
var fproperty_lookup_viewgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fproperty_lookup_viewgrid = new ew.Form("fproperty_lookup_viewgrid", "grid");
	fproperty_lookup_viewgrid.formKeyCountName = '<?php echo $property_lookup_view_grid->FormKeyCountName ?>';

	// Validate form
	fproperty_lookup_viewgrid.validate = function() {
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
			<?php if ($property_lookup_view_grid->ValuationNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValuationNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->ValuationNo->caption(), $property_lookup_view_grid->ValuationNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_lookup_view_grid->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->PropertyNo->caption(), $property_lookup_view_grid->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_lookup_view_grid->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->ClientSerNo->caption(), $property_lookup_view_grid->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->ClientSerNo->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->PropertyUse->caption(), $property_lookup_view_grid->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_lookup_view_grid->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->Location->caption(), $property_lookup_view_grid->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_lookup_view_grid->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->ChargeCode->caption(), $property_lookup_view_grid->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->ChargeCode->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->ChargeGroup->caption(), $property_lookup_view_grid->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->ChargeGroup->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->BalanceBF->caption(), $property_lookup_view_grid->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->BalanceBF->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->CurrentDemand->caption(), $property_lookup_view_grid->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->CurrentDemand->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->VAT->caption(), $property_lookup_view_grid->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->VAT->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->AmountPaid->caption(), $property_lookup_view_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->BillPeriod->caption(), $property_lookup_view_grid->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->BillPeriod->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->PeriodType->caption(), $property_lookup_view_grid->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_lookup_view_grid->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->BillYear->caption(), $property_lookup_view_grid->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->BillYear->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->StartDate->caption(), $property_lookup_view_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->StartDate->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->EndDate->caption(), $property_lookup_view_grid->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->EndDate->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->ChargeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->ChargeDesc->caption(), $property_lookup_view_grid->ChargeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_lookup_view_grid->Fee->Required) { ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->Fee->caption(), $property_lookup_view_grid->Fee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_lookup_view_grid->Fee->errorMessage()) ?>");
			<?php if ($property_lookup_view_grid->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_lookup_view_grid->UnitOfMeasure->caption(), $property_lookup_view_grid->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fproperty_lookup_viewgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "PropertyNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientSerNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyUse", false)) return false;
		if (ew.valueChanged(fobj, infix, "Location", false)) return false;
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
		if (ew.valueChanged(fobj, infix, "ChargeDesc", false)) return false;
		if (ew.valueChanged(fobj, infix, "Fee", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fproperty_lookup_viewgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_lookup_viewgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_lookup_viewgrid");
});
</script>
<?php } ?>
<?php
$property_lookup_view_grid->renderOtherOptions();
?>
<?php if ($property_lookup_view_grid->TotalRecords > 0 || $property_lookup_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_lookup_view_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_lookup_view">
<?php if ($property_lookup_view_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $property_lookup_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fproperty_lookup_viewgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_property_lookup_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_property_lookup_viewgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_lookup_view->RowType = ROWTYPE_HEADER;

// Render list options
$property_lookup_view_grid->renderListOptions();

// Render list options (header, left)
$property_lookup_view_grid->ListOptions->render("header", "left");
?>
<?php if ($property_lookup_view_grid->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $property_lookup_view_grid->ValuationNo->headerCellClass() ?>"><div id="elh_property_lookup_view_ValuationNo" class="property_lookup_view_ValuationNo"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $property_lookup_view_grid->ValuationNo->headerCellClass() ?>"><div><div id="elh_property_lookup_view_ValuationNo" class="property_lookup_view_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $property_lookup_view_grid->PropertyNo->headerCellClass() ?>"><div id="elh_property_lookup_view_PropertyNo" class="property_lookup_view_PropertyNo"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $property_lookup_view_grid->PropertyNo->headerCellClass() ?>"><div><div id="elh_property_lookup_view_PropertyNo" class="property_lookup_view_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->PropertyNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_lookup_view_grid->ClientSerNo->headerCellClass() ?>"><div id="elh_property_lookup_view_ClientSerNo" class="property_lookup_view_ClientSerNo"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_lookup_view_grid->ClientSerNo->headerCellClass() ?>"><div><div id="elh_property_lookup_view_ClientSerNo" class="property_lookup_view_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_lookup_view_grid->PropertyUse->headerCellClass() ?>"><div id="elh_property_lookup_view_PropertyUse" class="property_lookup_view_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_lookup_view_grid->PropertyUse->headerCellClass() ?>"><div><div id="elh_property_lookup_view_PropertyUse" class="property_lookup_view_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->Location->Visible) { // Location ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_lookup_view_grid->Location->headerCellClass() ?>"><div id="elh_property_lookup_view_Location" class="property_lookup_view_Location"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_lookup_view_grid->Location->headerCellClass() ?>"><div><div id="elh_property_lookup_view_Location" class="property_lookup_view_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $property_lookup_view_grid->ChargeCode->headerCellClass() ?>"><div id="elh_property_lookup_view_ChargeCode" class="property_lookup_view_ChargeCode"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $property_lookup_view_grid->ChargeCode->headerCellClass() ?>"><div><div id="elh_property_lookup_view_ChargeCode" class="property_lookup_view_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_lookup_view_grid->ChargeGroup->headerCellClass() ?>"><div id="elh_property_lookup_view_ChargeGroup" class="property_lookup_view_ChargeGroup"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_lookup_view_grid->ChargeGroup->headerCellClass() ?>"><div><div id="elh_property_lookup_view_ChargeGroup" class="property_lookup_view_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $property_lookup_view_grid->BalanceBF->headerCellClass() ?>"><div id="elh_property_lookup_view_BalanceBF" class="property_lookup_view_BalanceBF"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $property_lookup_view_grid->BalanceBF->headerCellClass() ?>"><div><div id="elh_property_lookup_view_BalanceBF" class="property_lookup_view_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $property_lookup_view_grid->CurrentDemand->headerCellClass() ?>"><div id="elh_property_lookup_view_CurrentDemand" class="property_lookup_view_CurrentDemand"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $property_lookup_view_grid->CurrentDemand->headerCellClass() ?>"><div><div id="elh_property_lookup_view_CurrentDemand" class="property_lookup_view_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->VAT->Visible) { // VAT ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $property_lookup_view_grid->VAT->headerCellClass() ?>"><div id="elh_property_lookup_view_VAT" class="property_lookup_view_VAT"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $property_lookup_view_grid->VAT->headerCellClass() ?>"><div><div id="elh_property_lookup_view_VAT" class="property_lookup_view_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_lookup_view_grid->AmountPaid->headerCellClass() ?>"><div id="elh_property_lookup_view_AmountPaid" class="property_lookup_view_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_lookup_view_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_property_lookup_view_AmountPaid" class="property_lookup_view_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $property_lookup_view_grid->BillPeriod->headerCellClass() ?>"><div id="elh_property_lookup_view_BillPeriod" class="property_lookup_view_BillPeriod"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $property_lookup_view_grid->BillPeriod->headerCellClass() ?>"><div><div id="elh_property_lookup_view_BillPeriod" class="property_lookup_view_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->PeriodType->Visible) { // PeriodType ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $property_lookup_view_grid->PeriodType->headerCellClass() ?>"><div id="elh_property_lookup_view_PeriodType" class="property_lookup_view_PeriodType"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $property_lookup_view_grid->PeriodType->headerCellClass() ?>"><div><div id="elh_property_lookup_view_PeriodType" class="property_lookup_view_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->BillYear->Visible) { // BillYear ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $property_lookup_view_grid->BillYear->headerCellClass() ?>"><div id="elh_property_lookup_view_BillYear" class="property_lookup_view_BillYear"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $property_lookup_view_grid->BillYear->headerCellClass() ?>"><div><div id="elh_property_lookup_view_BillYear" class="property_lookup_view_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $property_lookup_view_grid->StartDate->headerCellClass() ?>"><div id="elh_property_lookup_view_StartDate" class="property_lookup_view_StartDate"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $property_lookup_view_grid->StartDate->headerCellClass() ?>"><div><div id="elh_property_lookup_view_StartDate" class="property_lookup_view_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->EndDate->Visible) { // EndDate ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $property_lookup_view_grid->EndDate->headerCellClass() ?>"><div id="elh_property_lookup_view_EndDate" class="property_lookup_view_EndDate"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $property_lookup_view_grid->EndDate->headerCellClass() ?>"><div><div id="elh_property_lookup_view_EndDate" class="property_lookup_view_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->ChargeDesc) == "") { ?>
		<th data-name="ChargeDesc" class="<?php echo $property_lookup_view_grid->ChargeDesc->headerCellClass() ?>"><div id="elh_property_lookup_view_ChargeDesc" class="property_lookup_view_ChargeDesc"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ChargeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeDesc" class="<?php echo $property_lookup_view_grid->ChargeDesc->headerCellClass() ?>"><div><div id="elh_property_lookup_view_ChargeDesc" class="property_lookup_view_ChargeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->ChargeDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->ChargeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->ChargeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->Fee->Visible) { // Fee ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->Fee) == "") { ?>
		<th data-name="Fee" class="<?php echo $property_lookup_view_grid->Fee->headerCellClass() ?>"><div id="elh_property_lookup_view_Fee" class="property_lookup_view_Fee"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->Fee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fee" class="<?php echo $property_lookup_view_grid->Fee->headerCellClass() ?>"><div><div id="elh_property_lookup_view_Fee" class="property_lookup_view_Fee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->Fee->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->Fee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->Fee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($property_lookup_view_grid->SortUrl($property_lookup_view_grid->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $property_lookup_view_grid->UnitOfMeasure->headerCellClass() ?>"><div id="elh_property_lookup_view_UnitOfMeasure" class="property_lookup_view_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $property_lookup_view_grid->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $property_lookup_view_grid->UnitOfMeasure->headerCellClass() ?>"><div><div id="elh_property_lookup_view_UnitOfMeasure" class="property_lookup_view_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_grid->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_grid->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_grid->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_lookup_view_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$property_lookup_view_grid->StartRecord = 1;
$property_lookup_view_grid->StopRecord = $property_lookup_view_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($property_lookup_view->isConfirm() || $property_lookup_view_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($property_lookup_view_grid->FormKeyCountName) && ($property_lookup_view_grid->isGridAdd() || $property_lookup_view_grid->isGridEdit() || $property_lookup_view->isConfirm())) {
		$property_lookup_view_grid->KeyCount = $CurrentForm->getValue($property_lookup_view_grid->FormKeyCountName);
		$property_lookup_view_grid->StopRecord = $property_lookup_view_grid->StartRecord + $property_lookup_view_grid->KeyCount - 1;
	}
}
$property_lookup_view_grid->RecordCount = $property_lookup_view_grid->StartRecord - 1;
if ($property_lookup_view_grid->Recordset && !$property_lookup_view_grid->Recordset->EOF) {
	$property_lookup_view_grid->Recordset->moveFirst();
	$selectLimit = $property_lookup_view_grid->UseSelectLimit;
	if (!$selectLimit && $property_lookup_view_grid->StartRecord > 1)
		$property_lookup_view_grid->Recordset->move($property_lookup_view_grid->StartRecord - 1);
} elseif (!$property_lookup_view->AllowAddDeleteRow && $property_lookup_view_grid->StopRecord == 0) {
	$property_lookup_view_grid->StopRecord = $property_lookup_view->GridAddRowCount;
}

// Initialize aggregate
$property_lookup_view->RowType = ROWTYPE_AGGREGATEINIT;
$property_lookup_view->resetAttributes();
$property_lookup_view_grid->renderRow();
if ($property_lookup_view_grid->isGridAdd())
	$property_lookup_view_grid->RowIndex = 0;
if ($property_lookup_view_grid->isGridEdit())
	$property_lookup_view_grid->RowIndex = 0;
while ($property_lookup_view_grid->RecordCount < $property_lookup_view_grid->StopRecord) {
	$property_lookup_view_grid->RecordCount++;
	if ($property_lookup_view_grid->RecordCount >= $property_lookup_view_grid->StartRecord) {
		$property_lookup_view_grid->RowCount++;
		if ($property_lookup_view_grid->isGridAdd() || $property_lookup_view_grid->isGridEdit() || $property_lookup_view->isConfirm()) {
			$property_lookup_view_grid->RowIndex++;
			$CurrentForm->Index = $property_lookup_view_grid->RowIndex;
			if ($CurrentForm->hasValue($property_lookup_view_grid->FormActionName) && ($property_lookup_view->isConfirm() || $property_lookup_view_grid->EventCancelled))
				$property_lookup_view_grid->RowAction = strval($CurrentForm->getValue($property_lookup_view_grid->FormActionName));
			elseif ($property_lookup_view_grid->isGridAdd())
				$property_lookup_view_grid->RowAction = "insert";
			else
				$property_lookup_view_grid->RowAction = "";
		}

		// Set up key count
		$property_lookup_view_grid->KeyCount = $property_lookup_view_grid->RowIndex;

		// Init row class and style
		$property_lookup_view->resetAttributes();
		$property_lookup_view->CssClass = "";
		if ($property_lookup_view_grid->isGridAdd()) {
			if ($property_lookup_view->CurrentMode == "copy") {
				$property_lookup_view_grid->loadRowValues($property_lookup_view_grid->Recordset); // Load row values
				$property_lookup_view_grid->setRecordKey($property_lookup_view_grid->RowOldKey, $property_lookup_view_grid->Recordset); // Set old record key
			} else {
				$property_lookup_view_grid->loadRowValues(); // Load default values
				$property_lookup_view_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$property_lookup_view_grid->loadRowValues($property_lookup_view_grid->Recordset); // Load row values
		}
		$property_lookup_view->RowType = ROWTYPE_VIEW; // Render view
		if ($property_lookup_view_grid->isGridAdd()) // Grid add
			$property_lookup_view->RowType = ROWTYPE_ADD; // Render add
		if ($property_lookup_view_grid->isGridAdd() && $property_lookup_view->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$property_lookup_view_grid->restoreCurrentRowFormValues($property_lookup_view_grid->RowIndex); // Restore form values
		if ($property_lookup_view_grid->isGridEdit()) { // Grid edit
			if ($property_lookup_view->EventCancelled)
				$property_lookup_view_grid->restoreCurrentRowFormValues($property_lookup_view_grid->RowIndex); // Restore form values
			if ($property_lookup_view_grid->RowAction == "insert")
				$property_lookup_view->RowType = ROWTYPE_ADD; // Render add
			else
				$property_lookup_view->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($property_lookup_view_grid->isGridEdit() && ($property_lookup_view->RowType == ROWTYPE_EDIT || $property_lookup_view->RowType == ROWTYPE_ADD) && $property_lookup_view->EventCancelled) // Update failed
			$property_lookup_view_grid->restoreCurrentRowFormValues($property_lookup_view_grid->RowIndex); // Restore form values
		if ($property_lookup_view->RowType == ROWTYPE_EDIT) // Edit row
			$property_lookup_view_grid->EditRowCount++;
		if ($property_lookup_view->isConfirm()) // Confirm row
			$property_lookup_view_grid->restoreCurrentRowFormValues($property_lookup_view_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$property_lookup_view->RowAttrs->merge(["data-rowindex" => $property_lookup_view_grid->RowCount, "id" => "r" . $property_lookup_view_grid->RowCount . "_property_lookup_view", "data-rowtype" => $property_lookup_view->RowType]);

		// Render row
		$property_lookup_view_grid->renderRow();

		// Render list options
		$property_lookup_view_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($property_lookup_view_grid->RowAction != "delete" && $property_lookup_view_grid->RowAction != "insertdelete" && !($property_lookup_view_grid->RowAction == "insert" && $property_lookup_view->isConfirm() && $property_lookup_view_grid->emptyRow())) {
?>
	<tr <?php echo $property_lookup_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_lookup_view_grid->ListOptions->render("body", "left", $property_lookup_view_grid->RowCount);
?>
	<?php if ($property_lookup_view_grid->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $property_lookup_view_grid->ValuationNo->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ValuationNo" class="form-group"></span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ValuationNo" class="form-group">
<span<?php echo $property_lookup_view_grid->ValuationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ValuationNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->CurrentValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ValuationNo">
<span<?php echo $property_lookup_view_grid->ValuationNo->viewAttributes() ?>><?php echo $property_lookup_view_grid->ValuationNo->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $property_lookup_view_grid->PropertyNo->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PropertyNo" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PropertyNo->EditValue ?>"<?php echo $property_lookup_view_grid->PropertyNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PropertyNo" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PropertyNo->EditValue ?>"<?php echo $property_lookup_view_grid->PropertyNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PropertyNo">
<span<?php echo $property_lookup_view_grid->PropertyNo->viewAttributes() ?>><?php echo $property_lookup_view_grid->PropertyNo->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyNo" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyNo" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $property_lookup_view_grid->ClientSerNo->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($property_lookup_view_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ClientSerNo" class="form-group">
<span<?php echo $property_lookup_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ClientSerNo" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ClientSerNo->EditValue ?>"<?php echo $property_lookup_view_grid->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ClientSerNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($property_lookup_view_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ClientSerNo" class="form-group">
<span<?php echo $property_lookup_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ClientSerNo" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ClientSerNo->EditValue ?>"<?php echo $property_lookup_view_grid->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ClientSerNo">
<span<?php echo $property_lookup_view_grid->ClientSerNo->viewAttributes() ?>><?php echo $property_lookup_view_grid->ClientSerNo->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ClientSerNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ClientSerNo" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ClientSerNo" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_lookup_view_grid->PropertyUse->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PropertyUse" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyUse" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PropertyUse->EditValue ?>"<?php echo $property_lookup_view_grid->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyUse" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PropertyUse" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyUse" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PropertyUse->EditValue ?>"<?php echo $property_lookup_view_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PropertyUse">
<span<?php echo $property_lookup_view_grid->PropertyUse->viewAttributes() ?>><?php echo $property_lookup_view_grid->PropertyUse->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyUse" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyUse" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyUse" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyUse" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_lookup_view_grid->Location->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_Location" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_Location" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->Location->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->Location->EditValue ?>"<?php echo $property_lookup_view_grid->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_Location" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_lookup_view_grid->Location->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_Location" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_Location" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->Location->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->Location->EditValue ?>"<?php echo $property_lookup_view_grid->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_Location">
<span<?php echo $property_lookup_view_grid->Location->viewAttributes() ?>><?php echo $property_lookup_view_grid->Location->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_Location" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_lookup_view_grid->Location->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_Location" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_lookup_view_grid->Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_Location" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_lookup_view_grid->Location->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_Location" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_lookup_view_grid->Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $property_lookup_view_grid->ChargeCode->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeCode" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeCode" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeCode->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeCode" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeCode" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeCode" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeCode->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeCode">
<span<?php echo $property_lookup_view_grid->ChargeCode->viewAttributes() ?>><?php echo $property_lookup_view_grid->ChargeCode->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeCode" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeCode" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeCode" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeCode" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $property_lookup_view_grid->ChargeGroup->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeGroup" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeGroup" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeGroup->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeGroup->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeGroup" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeGroup" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeGroup" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeGroup->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeGroup">
<span<?php echo $property_lookup_view_grid->ChargeGroup->viewAttributes() ?>><?php echo $property_lookup_view_grid->ChargeGroup->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeGroup" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeGroup" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeGroup" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeGroup" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $property_lookup_view_grid->BalanceBF->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BalanceBF" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_BalanceBF" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BalanceBF->EditValue ?>"<?php echo $property_lookup_view_grid->BalanceBF->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_BalanceBF" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BalanceBF" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_BalanceBF" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BalanceBF->EditValue ?>"<?php echo $property_lookup_view_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BalanceBF">
<span<?php echo $property_lookup_view_grid->BalanceBF->viewAttributes() ?>><?php echo $property_lookup_view_grid->BalanceBF->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BalanceBF" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_BalanceBF" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BalanceBF" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_BalanceBF" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $property_lookup_view_grid->CurrentDemand->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_CurrentDemand" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_CurrentDemand" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->CurrentDemand->EditValue ?>"<?php echo $property_lookup_view_grid->CurrentDemand->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_CurrentDemand" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_CurrentDemand" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_CurrentDemand" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->CurrentDemand->EditValue ?>"<?php echo $property_lookup_view_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_CurrentDemand">
<span<?php echo $property_lookup_view_grid->CurrentDemand->viewAttributes() ?>><?php echo $property_lookup_view_grid->CurrentDemand->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_CurrentDemand" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_CurrentDemand" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_CurrentDemand" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_CurrentDemand" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $property_lookup_view_grid->VAT->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_VAT" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_VAT" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->VAT->EditValue ?>"<?php echo $property_lookup_view_grid->VAT->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_VAT" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_lookup_view_grid->VAT->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_VAT" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_VAT" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->VAT->EditValue ?>"<?php echo $property_lookup_view_grid->VAT->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_VAT">
<span<?php echo $property_lookup_view_grid->VAT->viewAttributes() ?>><?php echo $property_lookup_view_grid->VAT->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_VAT" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_lookup_view_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_VAT" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_lookup_view_grid->VAT->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_VAT" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_lookup_view_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_VAT" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_lookup_view_grid->VAT->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_lookup_view_grid->AmountPaid->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_AmountPaid" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_AmountPaid" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->AmountPaid->EditValue ?>"<?php echo $property_lookup_view_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_AmountPaid" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_AmountPaid" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_AmountPaid" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->AmountPaid->EditValue ?>"<?php echo $property_lookup_view_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_AmountPaid">
<span<?php echo $property_lookup_view_grid->AmountPaid->viewAttributes() ?>><?php echo $property_lookup_view_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_AmountPaid" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_AmountPaid" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_AmountPaid" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_AmountPaid" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $property_lookup_view_grid->BillPeriod->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BillPeriod" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_BillPeriod" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BillPeriod->EditValue ?>"<?php echo $property_lookup_view_grid->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillPeriod" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BillPeriod" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_BillPeriod" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BillPeriod->EditValue ?>"<?php echo $property_lookup_view_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BillPeriod">
<span<?php echo $property_lookup_view_grid->BillPeriod->viewAttributes() ?>><?php echo $property_lookup_view_grid->BillPeriod->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillPeriod" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_BillPeriod" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillPeriod" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_BillPeriod" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $property_lookup_view_grid->PeriodType->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PeriodType" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_PeriodType" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PeriodType->EditValue ?>"<?php echo $property_lookup_view_grid->PeriodType->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_PeriodType" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PeriodType" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_PeriodType" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PeriodType->EditValue ?>"<?php echo $property_lookup_view_grid->PeriodType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_PeriodType">
<span<?php echo $property_lookup_view_grid->PeriodType->viewAttributes() ?>><?php echo $property_lookup_view_grid->PeriodType->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PeriodType" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_PeriodType" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PeriodType" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_PeriodType" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $property_lookup_view_grid->BillYear->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BillYear" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_BillYear" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BillYear->EditValue ?>"<?php echo $property_lookup_view_grid->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillYear" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BillYear" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_BillYear" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BillYear->EditValue ?>"<?php echo $property_lookup_view_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_BillYear">
<span<?php echo $property_lookup_view_grid->BillYear->viewAttributes() ?>><?php echo $property_lookup_view_grid->BillYear->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillYear" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_BillYear" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillYear" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_BillYear" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $property_lookup_view_grid->StartDate->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_StartDate" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_StartDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->StartDate->EditValue ?>"<?php echo $property_lookup_view_grid->StartDate->editAttributes() ?>>
<?php if (!$property_lookup_view_grid->StartDate->ReadOnly && !$property_lookup_view_grid->StartDate->Disabled && !isset($property_lookup_view_grid->StartDate->EditAttrs["readonly"]) && !isset($property_lookup_view_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewgrid", "x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_StartDate" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_StartDate" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_StartDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->StartDate->EditValue ?>"<?php echo $property_lookup_view_grid->StartDate->editAttributes() ?>>
<?php if (!$property_lookup_view_grid->StartDate->ReadOnly && !$property_lookup_view_grid->StartDate->Disabled && !isset($property_lookup_view_grid->StartDate->EditAttrs["readonly"]) && !isset($property_lookup_view_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewgrid", "x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_StartDate">
<span<?php echo $property_lookup_view_grid->StartDate->viewAttributes() ?>><?php echo $property_lookup_view_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_StartDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_StartDate" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_StartDate" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_StartDate" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $property_lookup_view_grid->EndDate->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_EndDate" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_EndDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->EndDate->EditValue ?>"<?php echo $property_lookup_view_grid->EndDate->editAttributes() ?>>
<?php if (!$property_lookup_view_grid->EndDate->ReadOnly && !$property_lookup_view_grid->EndDate->Disabled && !isset($property_lookup_view_grid->EndDate->EditAttrs["readonly"]) && !isset($property_lookup_view_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewgrid", "x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_EndDate" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_EndDate" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_EndDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->EndDate->EditValue ?>"<?php echo $property_lookup_view_grid->EndDate->editAttributes() ?>>
<?php if (!$property_lookup_view_grid->EndDate->ReadOnly && !$property_lookup_view_grid->EndDate->Disabled && !isset($property_lookup_view_grid->EndDate->EditAttrs["readonly"]) && !isset($property_lookup_view_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewgrid", "x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_EndDate">
<span<?php echo $property_lookup_view_grid->EndDate->viewAttributes() ?>><?php echo $property_lookup_view_grid->EndDate->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_EndDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_EndDate" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_EndDate" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_EndDate" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc" <?php echo $property_lookup_view_grid->ChargeDesc->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeDesc" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeDesc" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeDesc->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeDesc" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeDesc" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeDesc" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeDesc->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_ChargeDesc">
<span<?php echo $property_lookup_view_grid->ChargeDesc->viewAttributes() ?>><?php echo $property_lookup_view_grid->ChargeDesc->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeDesc" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeDesc" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeDesc" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeDesc" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->Fee->Visible) { // Fee ?>
		<td data-name="Fee" <?php echo $property_lookup_view_grid->Fee->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_Fee" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_Fee" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->Fee->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->Fee->EditValue ?>"<?php echo $property_lookup_view_grid->Fee->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_Fee" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" value="<?php echo HtmlEncode($property_lookup_view_grid->Fee->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_Fee" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_Fee" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->Fee->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->Fee->EditValue ?>"<?php echo $property_lookup_view_grid->Fee->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_Fee">
<span<?php echo $property_lookup_view_grid->Fee->viewAttributes() ?>><?php echo $property_lookup_view_grid->Fee->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_Fee" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" value="<?php echo HtmlEncode($property_lookup_view_grid->Fee->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_Fee" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" value="<?php echo HtmlEncode($property_lookup_view_grid->Fee->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_Fee" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" value="<?php echo HtmlEncode($property_lookup_view_grid->Fee->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_Fee" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" value="<?php echo HtmlEncode($property_lookup_view_grid->Fee->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $property_lookup_view_grid->UnitOfMeasure->cellAttributes() ?>>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_UnitOfMeasure" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->UnitOfMeasure->EditValue ?>"<?php echo $property_lookup_view_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_UnitOfMeasure" class="form-group">
<input type="text" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->UnitOfMeasure->EditValue ?>"<?php echo $property_lookup_view_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_lookup_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_lookup_view_grid->RowCount ?>_property_lookup_view_UnitOfMeasure">
<span<?php echo $property_lookup_view_grid->UnitOfMeasure->viewAttributes() ?>><?php echo $property_lookup_view_grid->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php if (!$property_lookup_view->isConfirm()) { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="fproperty_lookup_viewgrid$x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="fproperty_lookup_viewgrid$o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_lookup_view_grid->ListOptions->render("body", "right", $property_lookup_view_grid->RowCount);
?>
	</tr>
<?php if ($property_lookup_view->RowType == ROWTYPE_ADD || $property_lookup_view->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "load"], function() {
	fproperty_lookup_viewgrid.updateLists(<?php echo $property_lookup_view_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$property_lookup_view_grid->isGridAdd() || $property_lookup_view->CurrentMode == "copy")
		if (!$property_lookup_view_grid->Recordset->EOF)
			$property_lookup_view_grid->Recordset->moveNext();
}
?>
<?php
	if ($property_lookup_view->CurrentMode == "add" || $property_lookup_view->CurrentMode == "copy" || $property_lookup_view->CurrentMode == "edit") {
		$property_lookup_view_grid->RowIndex = '$rowindex$';
		$property_lookup_view_grid->loadRowValues();

		// Set row properties
		$property_lookup_view->resetAttributes();
		$property_lookup_view->RowAttrs->merge(["data-rowindex" => $property_lookup_view_grid->RowIndex, "id" => "r0_property_lookup_view", "data-rowtype" => ROWTYPE_ADD]);
		$property_lookup_view->RowAttrs->appendClass("ew-template");
		$property_lookup_view->RowType = ROWTYPE_ADD;

		// Render row
		$property_lookup_view_grid->renderRow();

		// Render list options
		$property_lookup_view_grid->renderListOptions();
		$property_lookup_view_grid->StartRowCount = 0;
?>
	<tr <?php echo $property_lookup_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_lookup_view_grid->ListOptions->render("body", "left", $property_lookup_view_grid->RowIndex);
?>
	<?php if ($property_lookup_view_grid->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_ValuationNo" class="form-group property_lookup_view_ValuationNo"></span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_ValuationNo" class="form-group property_lookup_view_ValuationNo">
<span<?php echo $property_lookup_view_grid->ValuationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ValuationNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ValuationNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ValuationNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_PropertyNo" class="form-group property_lookup_view_PropertyNo">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PropertyNo->EditValue ?>"<?php echo $property_lookup_view_grid->PropertyNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_PropertyNo" class="form-group property_lookup_view_PropertyNo">
<span<?php echo $property_lookup_view_grid->PropertyNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->PropertyNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<?php if ($property_lookup_view_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_property_lookup_view_ClientSerNo" class="form-group property_lookup_view_ClientSerNo">
<span<?php echo $property_lookup_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_ClientSerNo" class="form-group property_lookup_view_ClientSerNo">
<input type="text" data-table="property_lookup_view" data-field="x_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ClientSerNo->EditValue ?>"<?php echo $property_lookup_view_grid->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_ClientSerNo" class="form-group property_lookup_view_ClientSerNo">
<span<?php echo $property_lookup_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ClientSerNo" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ClientSerNo" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_grid->ClientSerNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_PropertyUse" class="form-group property_lookup_view_PropertyUse">
<input type="text" data-table="property_lookup_view" data-field="x_PropertyUse" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PropertyUse->EditValue ?>"<?php echo $property_lookup_view_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_PropertyUse" class="form-group property_lookup_view_PropertyUse">
<span<?php echo $property_lookup_view_grid->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyUse" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PropertyUse" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_lookup_view_grid->PropertyUse->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->Location->Visible) { // Location ?>
		<td data-name="Location">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_Location" class="form-group property_lookup_view_Location">
<input type="text" data-table="property_lookup_view" data-field="x_Location" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->Location->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->Location->EditValue ?>"<?php echo $property_lookup_view_grid->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_Location" class="form-group property_lookup_view_Location">
<span<?php echo $property_lookup_view_grid->Location->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->Location->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_Location" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_lookup_view_grid->Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_Location" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_lookup_view_grid->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_ChargeCode" class="form-group property_lookup_view_ChargeCode">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeCode" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeCode->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_ChargeCode" class="form-group property_lookup_view_ChargeCode">
<span<?php echo $property_lookup_view_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeCode" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeCode" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_ChargeGroup" class="form-group property_lookup_view_ChargeGroup">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeGroup" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeGroup->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_ChargeGroup" class="form-group property_lookup_view_ChargeGroup">
<span<?php echo $property_lookup_view_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeGroup" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeGroup" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_BalanceBF" class="form-group property_lookup_view_BalanceBF">
<input type="text" data-table="property_lookup_view" data-field="x_BalanceBF" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BalanceBF->EditValue ?>"<?php echo $property_lookup_view_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_BalanceBF" class="form-group property_lookup_view_BalanceBF">
<span<?php echo $property_lookup_view_grid->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->BalanceBF->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_BalanceBF" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BalanceBF" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_lookup_view_grid->BalanceBF->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_CurrentDemand" class="form-group property_lookup_view_CurrentDemand">
<input type="text" data-table="property_lookup_view" data-field="x_CurrentDemand" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->CurrentDemand->EditValue ?>"<?php echo $property_lookup_view_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_CurrentDemand" class="form-group property_lookup_view_CurrentDemand">
<span<?php echo $property_lookup_view_grid->CurrentDemand->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->CurrentDemand->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_CurrentDemand" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_CurrentDemand" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($property_lookup_view_grid->CurrentDemand->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_VAT" class="form-group property_lookup_view_VAT">
<input type="text" data-table="property_lookup_view" data-field="x_VAT" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->VAT->EditValue ?>"<?php echo $property_lookup_view_grid->VAT->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_VAT" class="form-group property_lookup_view_VAT">
<span<?php echo $property_lookup_view_grid->VAT->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->VAT->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_VAT" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_lookup_view_grid->VAT->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_VAT" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($property_lookup_view_grid->VAT->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_AmountPaid" class="form-group property_lookup_view_AmountPaid">
<input type="text" data-table="property_lookup_view" data-field="x_AmountPaid" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->AmountPaid->EditValue ?>"<?php echo $property_lookup_view_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_AmountPaid" class="form-group property_lookup_view_AmountPaid">
<span<?php echo $property_lookup_view_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_AmountPaid" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_AmountPaid" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_lookup_view_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_BillPeriod" class="form-group property_lookup_view_BillPeriod">
<input type="text" data-table="property_lookup_view" data-field="x_BillPeriod" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BillPeriod->EditValue ?>"<?php echo $property_lookup_view_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_BillPeriod" class="form-group property_lookup_view_BillPeriod">
<span<?php echo $property_lookup_view_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillPeriod" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillPeriod" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($property_lookup_view_grid->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_PeriodType" class="form-group property_lookup_view_PeriodType">
<input type="text" data-table="property_lookup_view" data-field="x_PeriodType" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->PeriodType->EditValue ?>"<?php echo $property_lookup_view_grid->PeriodType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_PeriodType" class="form-group property_lookup_view_PeriodType">
<span<?php echo $property_lookup_view_grid->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_PeriodType" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_PeriodType" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($property_lookup_view_grid->PeriodType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_BillYear" class="form-group property_lookup_view_BillYear">
<input type="text" data-table="property_lookup_view" data-field="x_BillYear" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->BillYear->EditValue ?>"<?php echo $property_lookup_view_grid->BillYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_BillYear" class="form-group property_lookup_view_BillYear">
<span<?php echo $property_lookup_view_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillYear" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_BillYear" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($property_lookup_view_grid->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_StartDate" class="form-group property_lookup_view_StartDate">
<input type="text" data-table="property_lookup_view" data-field="x_StartDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->StartDate->EditValue ?>"<?php echo $property_lookup_view_grid->StartDate->editAttributes() ?>>
<?php if (!$property_lookup_view_grid->StartDate->ReadOnly && !$property_lookup_view_grid->StartDate->Disabled && !isset($property_lookup_view_grid->StartDate->EditAttrs["readonly"]) && !isset($property_lookup_view_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewgrid", "x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_StartDate" class="form-group property_lookup_view_StartDate">
<span<?php echo $property_lookup_view_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_StartDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_StartDate" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($property_lookup_view_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_EndDate" class="form-group property_lookup_view_EndDate">
<input type="text" data-table="property_lookup_view" data-field="x_EndDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->EndDate->EditValue ?>"<?php echo $property_lookup_view_grid->EndDate->editAttributes() ?>>
<?php if (!$property_lookup_view_grid->EndDate->ReadOnly && !$property_lookup_view_grid->EndDate->Disabled && !isset($property_lookup_view_grid->EndDate->EditAttrs["readonly"]) && !isset($property_lookup_view_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_lookup_viewgrid", "x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_EndDate" class="form-group property_lookup_view_EndDate">
<span<?php echo $property_lookup_view_grid->EndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->EndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_EndDate" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_EndDate" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($property_lookup_view_grid->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_ChargeDesc" class="form-group property_lookup_view_ChargeDesc">
<input type="text" data-table="property_lookup_view" data-field="x_ChargeDesc" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->ChargeDesc->EditValue ?>"<?php echo $property_lookup_view_grid->ChargeDesc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_ChargeDesc" class="form-group property_lookup_view_ChargeDesc">
<span<?php echo $property_lookup_view_grid->ChargeDesc->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->ChargeDesc->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeDesc" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_ChargeDesc" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($property_lookup_view_grid->ChargeDesc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->Fee->Visible) { // Fee ?>
		<td data-name="Fee">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_Fee" class="form-group property_lookup_view_Fee">
<input type="text" data-table="property_lookup_view" data-field="x_Fee" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" size="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->Fee->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->Fee->EditValue ?>"<?php echo $property_lookup_view_grid->Fee->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_Fee" class="form-group property_lookup_view_Fee">
<span<?php echo $property_lookup_view_grid->Fee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->Fee->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_Fee" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" value="<?php echo HtmlEncode($property_lookup_view_grid->Fee->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_Fee" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_Fee" value="<?php echo HtmlEncode($property_lookup_view_grid->Fee->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_lookup_view_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<?php if (!$property_lookup_view->isConfirm()) { ?>
<span id="el$rowindex$_property_lookup_view_UnitOfMeasure" class="form-group property_lookup_view_UnitOfMeasure">
<input type="text" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $property_lookup_view_grid->UnitOfMeasure->EditValue ?>"<?php echo $property_lookup_view_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_lookup_view_UnitOfMeasure" class="form-group property_lookup_view_UnitOfMeasure">
<span<?php echo $property_lookup_view_grid->UnitOfMeasure->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_lookup_view_grid->UnitOfMeasure->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_lookup_view" data-field="x_UnitOfMeasure" name="o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $property_lookup_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($property_lookup_view_grid->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_lookup_view_grid->ListOptions->render("body", "right", $property_lookup_view_grid->RowIndex);
?>
<script>
loadjs.ready(["fproperty_lookup_viewgrid", "load"], function() {
	fproperty_lookup_viewgrid.updateLists(<?php echo $property_lookup_view_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($property_lookup_view->CurrentMode == "add" || $property_lookup_view->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $property_lookup_view_grid->FormKeyCountName ?>" id="<?php echo $property_lookup_view_grid->FormKeyCountName ?>" value="<?php echo $property_lookup_view_grid->KeyCount ?>">
<?php echo $property_lookup_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property_lookup_view->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $property_lookup_view_grid->FormKeyCountName ?>" id="<?php echo $property_lookup_view_grid->FormKeyCountName ?>" value="<?php echo $property_lookup_view_grid->KeyCount ?>">
<?php echo $property_lookup_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property_lookup_view->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fproperty_lookup_viewgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_lookup_view_grid->Recordset)
	$property_lookup_view_grid->Recordset->Close();
?>
<?php if ($property_lookup_view_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $property_lookup_view_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_lookup_view_grid->TotalRecords == 0 && !$property_lookup_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_lookup_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$property_lookup_view_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$property_lookup_view_grid->terminate();
?>