<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($receipts_view_grid))
	$receipts_view_grid = new receipts_view_grid();

// Run the page
$receipts_view_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipts_view_grid->Page_Render();
?>
<?php if (!$receipts_view_grid->isExport()) { ?>
<script>
var freceipts_viewgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	freceipts_viewgrid = new ew.Form("freceipts_viewgrid", "grid");
	freceipts_viewgrid.formKeyCountName = '<?php echo $receipts_view_grid->FormKeyCountName ?>';

	// Validate form
	freceipts_viewgrid.validate = function() {
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
			<?php if ($receipts_view_grid->ReceiptNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->ReceiptNo->caption(), $receipts_view_grid->ReceiptNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->ReceiptNo->errorMessage()) ?>");
			<?php if ($receipts_view_grid->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->ClientSerNo->caption(), $receipts_view_grid->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->ClientSerNo->errorMessage()) ?>");
			<?php if ($receipts_view_grid->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->ChargeCode->caption(), $receipts_view_grid->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->ChargeCode->errorMessage()) ?>");
			<?php if ($receipts_view_grid->ReceiptDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->ReceiptDate->caption(), $receipts_view_grid->ReceiptDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->ReceiptDate->errorMessage()) ?>");
			<?php if ($receipts_view_grid->ItemID->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->ItemID->caption(), $receipts_view_grid->ItemID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipts_view_grid->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->UnitCost->caption(), $receipts_view_grid->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->UnitCost->errorMessage()) ?>");
			<?php if ($receipts_view_grid->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->Quantity->caption(), $receipts_view_grid->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->Quantity->errorMessage()) ?>");
			<?php if ($receipts_view_grid->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->UnitOfMeasure->caption(), $receipts_view_grid->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipts_view_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->AmountPaid->caption(), $receipts_view_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($receipts_view_grid->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->PaymentMethod->caption(), $receipts_view_grid->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipts_view_grid->PaymentRef->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->PaymentRef->caption(), $receipts_view_grid->PaymentRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipts_view_grid->CashierNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CashierNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->CashierNo->caption(), $receipts_view_grid->CashierNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipts_view_grid->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->BillPeriod->caption(), $receipts_view_grid->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->BillPeriod->errorMessage()) ?>");
			<?php if ($receipts_view_grid->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->BillYear->caption(), $receipts_view_grid->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipts_view_grid->BillYear->errorMessage()) ?>");
			<?php if ($receipts_view_grid->PaymentFor->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentFor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->PaymentFor->caption(), $receipts_view_grid->PaymentFor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipts_view_grid->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipts_view_grid->ChargeGroup->caption(), $receipts_view_grid->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	freceipts_viewgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ReceiptNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientSerNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReceiptDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ItemID", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitCost", false)) return false;
		if (ew.valueChanged(fobj, infix, "Quantity", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPaid", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentMethod", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentRef", false)) return false;
		if (ew.valueChanged(fobj, infix, "CashierNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentFor", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeGroup", false)) return false;
		return true;
	}

	// Form_CustomValidate
	freceipts_viewgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceipts_viewgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceipts_viewgrid.lists["x_ClientSerNo"] = <?php echo $receipts_view_grid->ClientSerNo->Lookup->toClientList($receipts_view_grid) ?>;
	freceipts_viewgrid.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipts_view_grid->ClientSerNo->lookupOptions()) ?>;
	freceipts_viewgrid.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipts_viewgrid.lists["x_ChargeCode"] = <?php echo $receipts_view_grid->ChargeCode->Lookup->toClientList($receipts_view_grid) ?>;
	freceipts_viewgrid.lists["x_ChargeCode"].options = <?php echo JsonEncode($receipts_view_grid->ChargeCode->lookupOptions()) ?>;
	freceipts_viewgrid.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceipts_viewgrid.lists["x_PaymentMethod"] = <?php echo $receipts_view_grid->PaymentMethod->Lookup->toClientList($receipts_view_grid) ?>;
	freceipts_viewgrid.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipts_view_grid->PaymentMethod->lookupOptions()) ?>;
	freceipts_viewgrid.autoSuggests["x_PaymentMethod"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("freceipts_viewgrid");
});
</script>
<?php } ?>
<?php
$receipts_view_grid->renderOtherOptions();
?>
<?php if ($receipts_view_grid->TotalRecords > 0 || $receipts_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($receipts_view_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> receipts_view">
<?php if ($receipts_view_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $receipts_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="freceipts_viewgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_receipts_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_receipts_viewgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$receipts_view->RowType = ROWTYPE_HEADER;

// Render list options
$receipts_view_grid->renderListOptions();

// Render list options (header, left)
$receipts_view_grid->ListOptions->render("header", "left");
?>
<?php if ($receipts_view_grid->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipts_view_grid->ReceiptNo->headerCellClass() ?>"><div id="elh_receipts_view_ReceiptNo" class="receipts_view_ReceiptNo"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipts_view_grid->ReceiptNo->headerCellClass() ?>"><div><div id="elh_receipts_view_ReceiptNo" class="receipts_view_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipts_view_grid->ClientSerNo->headerCellClass() ?>"><div id="elh_receipts_view_ClientSerNo" class="receipts_view_ClientSerNo"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipts_view_grid->ClientSerNo->headerCellClass() ?>"><div><div id="elh_receipts_view_ClientSerNo" class="receipts_view_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $receipts_view_grid->ChargeCode->headerCellClass() ?>"><div id="elh_receipts_view_ChargeCode" class="receipts_view_ChargeCode"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $receipts_view_grid->ChargeCode->headerCellClass() ?>"><div><div id="elh_receipts_view_ChargeCode" class="receipts_view_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipts_view_grid->ReceiptDate->headerCellClass() ?>"><div id="elh_receipts_view_ReceiptDate" class="receipts_view_ReceiptDate"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipts_view_grid->ReceiptDate->headerCellClass() ?>"><div><div id="elh_receipts_view_ReceiptDate" class="receipts_view_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->ItemID->Visible) { // ItemID ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->ItemID) == "") { ?>
		<th data-name="ItemID" class="<?php echo $receipts_view_grid->ItemID->headerCellClass() ?>"><div id="elh_receipts_view_ItemID" class="receipts_view_ItemID"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->ItemID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemID" class="<?php echo $receipts_view_grid->ItemID->headerCellClass() ?>"><div><div id="elh_receipts_view_ItemID" class="receipts_view_ItemID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->ItemID->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->ItemID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->ItemID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->UnitCost->Visible) { // UnitCost ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $receipts_view_grid->UnitCost->headerCellClass() ?>"><div id="elh_receipts_view_UnitCost" class="receipts_view_UnitCost"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $receipts_view_grid->UnitCost->headerCellClass() ?>"><div><div id="elh_receipts_view_UnitCost" class="receipts_view_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->Quantity->Visible) { // Quantity ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $receipts_view_grid->Quantity->headerCellClass() ?>"><div id="elh_receipts_view_Quantity" class="receipts_view_Quantity"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $receipts_view_grid->Quantity->headerCellClass() ?>"><div><div id="elh_receipts_view_Quantity" class="receipts_view_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipts_view_grid->UnitOfMeasure->headerCellClass() ?>"><div id="elh_receipts_view_UnitOfMeasure" class="receipts_view_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipts_view_grid->UnitOfMeasure->headerCellClass() ?>"><div><div id="elh_receipts_view_UnitOfMeasure" class="receipts_view_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $receipts_view_grid->AmountPaid->headerCellClass() ?>"><div id="elh_receipts_view_AmountPaid" class="receipts_view_AmountPaid"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $receipts_view_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_receipts_view_AmountPaid" class="receipts_view_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipts_view_grid->PaymentMethod->headerCellClass() ?>"><div id="elh_receipts_view_PaymentMethod" class="receipts_view_PaymentMethod"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipts_view_grid->PaymentMethod->headerCellClass() ?>"><div><div id="elh_receipts_view_PaymentMethod" class="receipts_view_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->PaymentRef->Visible) { // PaymentRef ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->PaymentRef) == "") { ?>
		<th data-name="PaymentRef" class="<?php echo $receipts_view_grid->PaymentRef->headerCellClass() ?>"><div id="elh_receipts_view_PaymentRef" class="receipts_view_PaymentRef"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->PaymentRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentRef" class="<?php echo $receipts_view_grid->PaymentRef->headerCellClass() ?>"><div><div id="elh_receipts_view_PaymentRef" class="receipts_view_PaymentRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->PaymentRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->PaymentRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->PaymentRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->CashierNo->Visible) { // CashierNo ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->CashierNo) == "") { ?>
		<th data-name="CashierNo" class="<?php echo $receipts_view_grid->CashierNo->headerCellClass() ?>"><div id="elh_receipts_view_CashierNo" class="receipts_view_CashierNo"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->CashierNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CashierNo" class="<?php echo $receipts_view_grid->CashierNo->headerCellClass() ?>"><div><div id="elh_receipts_view_CashierNo" class="receipts_view_CashierNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->CashierNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $receipts_view_grid->BillPeriod->headerCellClass() ?>"><div id="elh_receipts_view_BillPeriod" class="receipts_view_BillPeriod"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $receipts_view_grid->BillPeriod->headerCellClass() ?>"><div><div id="elh_receipts_view_BillPeriod" class="receipts_view_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->BillYear->Visible) { // BillYear ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $receipts_view_grid->BillYear->headerCellClass() ?>"><div id="elh_receipts_view_BillYear" class="receipts_view_BillYear"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $receipts_view_grid->BillYear->headerCellClass() ?>"><div><div id="elh_receipts_view_BillYear" class="receipts_view_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->PaymentFor->Visible) { // PaymentFor ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->PaymentFor) == "") { ?>
		<th data-name="PaymentFor" class="<?php echo $receipts_view_grid->PaymentFor->headerCellClass() ?>"><div id="elh_receipts_view_PaymentFor" class="receipts_view_PaymentFor"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->PaymentFor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentFor" class="<?php echo $receipts_view_grid->PaymentFor->headerCellClass() ?>"><div><div id="elh_receipts_view_PaymentFor" class="receipts_view_PaymentFor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->PaymentFor->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->PaymentFor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->PaymentFor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_grid->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipts_view_grid->SortUrl($receipts_view_grid->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipts_view_grid->ChargeGroup->headerCellClass() ?>"><div id="elh_receipts_view_ChargeGroup" class="receipts_view_ChargeGroup"><div class="ew-table-header-caption"><?php echo $receipts_view_grid->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipts_view_grid->ChargeGroup->headerCellClass() ?>"><div><div id="elh_receipts_view_ChargeGroup" class="receipts_view_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_grid->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_grid->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_grid->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipts_view_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$receipts_view_grid->StartRecord = 1;
$receipts_view_grid->StopRecord = $receipts_view_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($receipts_view->isConfirm() || $receipts_view_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($receipts_view_grid->FormKeyCountName) && ($receipts_view_grid->isGridAdd() || $receipts_view_grid->isGridEdit() || $receipts_view->isConfirm())) {
		$receipts_view_grid->KeyCount = $CurrentForm->getValue($receipts_view_grid->FormKeyCountName);
		$receipts_view_grid->StopRecord = $receipts_view_grid->StartRecord + $receipts_view_grid->KeyCount - 1;
	}
}
$receipts_view_grid->RecordCount = $receipts_view_grid->StartRecord - 1;
if ($receipts_view_grid->Recordset && !$receipts_view_grid->Recordset->EOF) {
	$receipts_view_grid->Recordset->moveFirst();
	$selectLimit = $receipts_view_grid->UseSelectLimit;
	if (!$selectLimit && $receipts_view_grid->StartRecord > 1)
		$receipts_view_grid->Recordset->move($receipts_view_grid->StartRecord - 1);
} elseif (!$receipts_view->AllowAddDeleteRow && $receipts_view_grid->StopRecord == 0) {
	$receipts_view_grid->StopRecord = $receipts_view->GridAddRowCount;
}

// Initialize aggregate
$receipts_view->RowType = ROWTYPE_AGGREGATEINIT;
$receipts_view->resetAttributes();
$receipts_view_grid->renderRow();
if ($receipts_view_grid->isGridAdd())
	$receipts_view_grid->RowIndex = 0;
if ($receipts_view_grid->isGridEdit())
	$receipts_view_grid->RowIndex = 0;
while ($receipts_view_grid->RecordCount < $receipts_view_grid->StopRecord) {
	$receipts_view_grid->RecordCount++;
	if ($receipts_view_grid->RecordCount >= $receipts_view_grid->StartRecord) {
		$receipts_view_grid->RowCount++;
		if ($receipts_view_grid->isGridAdd() || $receipts_view_grid->isGridEdit() || $receipts_view->isConfirm()) {
			$receipts_view_grid->RowIndex++;
			$CurrentForm->Index = $receipts_view_grid->RowIndex;
			if ($CurrentForm->hasValue($receipts_view_grid->FormActionName) && ($receipts_view->isConfirm() || $receipts_view_grid->EventCancelled))
				$receipts_view_grid->RowAction = strval($CurrentForm->getValue($receipts_view_grid->FormActionName));
			elseif ($receipts_view_grid->isGridAdd())
				$receipts_view_grid->RowAction = "insert";
			else
				$receipts_view_grid->RowAction = "";
		}

		// Set up key count
		$receipts_view_grid->KeyCount = $receipts_view_grid->RowIndex;

		// Init row class and style
		$receipts_view->resetAttributes();
		$receipts_view->CssClass = "";
		if ($receipts_view_grid->isGridAdd()) {
			if ($receipts_view->CurrentMode == "copy") {
				$receipts_view_grid->loadRowValues($receipts_view_grid->Recordset); // Load row values
				$receipts_view_grid->setRecordKey($receipts_view_grid->RowOldKey, $receipts_view_grid->Recordset); // Set old record key
			} else {
				$receipts_view_grid->loadRowValues(); // Load default values
				$receipts_view_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$receipts_view_grid->loadRowValues($receipts_view_grid->Recordset); // Load row values
		}
		$receipts_view->RowType = ROWTYPE_VIEW; // Render view
		if ($receipts_view_grid->isGridAdd()) // Grid add
			$receipts_view->RowType = ROWTYPE_ADD; // Render add
		if ($receipts_view_grid->isGridAdd() && $receipts_view->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$receipts_view_grid->restoreCurrentRowFormValues($receipts_view_grid->RowIndex); // Restore form values
		if ($receipts_view_grid->isGridEdit()) { // Grid edit
			if ($receipts_view->EventCancelled)
				$receipts_view_grid->restoreCurrentRowFormValues($receipts_view_grid->RowIndex); // Restore form values
			if ($receipts_view_grid->RowAction == "insert")
				$receipts_view->RowType = ROWTYPE_ADD; // Render add
			else
				$receipts_view->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($receipts_view_grid->isGridEdit() && ($receipts_view->RowType == ROWTYPE_EDIT || $receipts_view->RowType == ROWTYPE_ADD) && $receipts_view->EventCancelled) // Update failed
			$receipts_view_grid->restoreCurrentRowFormValues($receipts_view_grid->RowIndex); // Restore form values
		if ($receipts_view->RowType == ROWTYPE_EDIT) // Edit row
			$receipts_view_grid->EditRowCount++;
		if ($receipts_view->isConfirm()) // Confirm row
			$receipts_view_grid->restoreCurrentRowFormValues($receipts_view_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$receipts_view->RowAttrs->merge(["data-rowindex" => $receipts_view_grid->RowCount, "id" => "r" . $receipts_view_grid->RowCount . "_receipts_view", "data-rowtype" => $receipts_view->RowType]);

		// Render row
		$receipts_view_grid->renderRow();

		// Render list options
		$receipts_view_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($receipts_view_grid->RowAction != "delete" && $receipts_view_grid->RowAction != "insertdelete" && !($receipts_view_grid->RowAction == "insert" && $receipts_view->isConfirm() && $receipts_view_grid->emptyRow())) {
?>
	<tr <?php echo $receipts_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipts_view_grid->ListOptions->render("body", "left", $receipts_view_grid->RowCount);
?>
	<?php if ($receipts_view_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $receipts_view_grid->ReceiptNo->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ReceiptNo" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_ReceiptNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ReceiptNo->EditValue ?>"<?php echo $receipts_view_grid->ReceiptNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="receipts_view" data-field="x_ReceiptNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ReceiptNo->EditValue ?>"<?php echo $receipts_view_grid->ReceiptNo->editAttributes() ?>>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->OldValue != null ? $receipts_view_grid->ReceiptNo->OldValue : $receipts_view_grid->ReceiptNo->CurrentValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ReceiptNo">
<span<?php echo $receipts_view_grid->ReceiptNo->viewAttributes() ?>><?php echo $receipts_view_grid->ReceiptNo->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $receipts_view_grid->ClientSerNo->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipts_view_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ClientSerNo" class="form-group">
<span<?php echo $receipts_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ClientSerNo" class="form-group">
<?php
$onchange = $receipts_view_grid->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($receipts_view_grid->ClientSerNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipts_view_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->ClientSerNo->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipts_view_grid->ClientSerNo->getSessionValue() != "") { ?>

<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ClientSerNo" class="form-group">
<span<?php echo $receipts_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ClientSerNo->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>

<?php
$onchange = $receipts_view_grid->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($receipts_view_grid->ClientSerNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipts_view_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->ClientSerNo->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_ClientSerNo") ?>

<?php } ?>

<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->OldValue != null ? $receipts_view_grid->ClientSerNo->OldValue : $receipts_view_grid->ClientSerNo->CurrentValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ClientSerNo">
<span<?php echo $receipts_view_grid->ClientSerNo->viewAttributes() ?>><?php echo $receipts_view_grid->ClientSerNo->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $receipts_view_grid->ChargeCode->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipts_view_grid->ChargeCode->getSessionValue() != "") { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ChargeCode" class="form-group">
<span<?php echo $receipts_view_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ChargeCode" class="form-group">
<?php
$onchange = $receipts_view_grid->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipts_view_grid->ChargeCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" data-value-separator="<?php echo $receipts_view_grid->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->ChargeCode->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_ChargeCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipts_view_grid->ChargeCode->getSessionValue() != "") { ?>

<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ChargeCode" class="form-group">
<span<?php echo $receipts_view_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ChargeCode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->CurrentValue) ?>">
<?php } else { ?>

<?php
$onchange = $receipts_view_grid->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipts_view_grid->ChargeCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" data-value-separator="<?php echo $receipts_view_grid->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->ChargeCode->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_ChargeCode") ?>

<?php } ?>

<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->OldValue != null ? $receipts_view_grid->ChargeCode->OldValue : $receipts_view_grid->ChargeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ChargeCode">
<span<?php echo $receipts_view_grid->ChargeCode->viewAttributes() ?>><?php echo $receipts_view_grid->ChargeCode->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $receipts_view_grid->ReceiptDate->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ReceiptDate" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_ReceiptDate" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ReceiptDate->EditValue ?>"<?php echo $receipts_view_grid->ReceiptDate->editAttributes() ?>>
<?php if (!$receipts_view_grid->ReceiptDate->ReadOnly && !$receipts_view_grid->ReceiptDate->Disabled && !isset($receipts_view_grid->ReceiptDate->EditAttrs["readonly"]) && !isset($receipts_view_grid->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipts_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipts_viewgrid", "x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptDate" name="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ReceiptDate" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_ReceiptDate" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ReceiptDate->EditValue ?>"<?php echo $receipts_view_grid->ReceiptDate->editAttributes() ?>>
<?php if (!$receipts_view_grid->ReceiptDate->ReadOnly && !$receipts_view_grid->ReceiptDate->Disabled && !isset($receipts_view_grid->ReceiptDate->EditAttrs["readonly"]) && !isset($receipts_view_grid->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipts_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipts_viewgrid", "x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ReceiptDate">
<span<?php echo $receipts_view_grid->ReceiptDate->viewAttributes() ?>><?php echo $receipts_view_grid->ReceiptDate->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptDate" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptDate" name="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptDate" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptDate" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" <?php echo $receipts_view_grid->ItemID->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipts_view_grid->ItemID->getSessionValue() != "") { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ItemID" class="form-group">
<span<?php echo $receipts_view_grid->ItemID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ItemID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ItemID" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_grid->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ItemID->EditValue ?>"<?php echo $receipts_view_grid->ItemID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipts_view_grid->ItemID->getSessionValue() != "") { ?>

<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ItemID" class="form-group">
<span<?php echo $receipts_view_grid->ItemID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ItemID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="receipts_view" data-field="x_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_grid->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ItemID->EditValue ?>"<?php echo $receipts_view_grid->ItemID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->OldValue != null ? $receipts_view_grid->ItemID->OldValue : $receipts_view_grid->ItemID->CurrentValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ItemID">
<span<?php echo $receipts_view_grid->ItemID->viewAttributes() ?>><?php echo $receipts_view_grid->ItemID->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $receipts_view_grid->UnitCost->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_UnitCost" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_UnitCost" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->UnitCost->EditValue ?>"<?php echo $receipts_view_grid->UnitCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_UnitCost" name="o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipts_view_grid->UnitCost->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_UnitCost" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_UnitCost" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->UnitCost->EditValue ?>"<?php echo $receipts_view_grid->UnitCost->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_UnitCost">
<span<?php echo $receipts_view_grid->UnitCost->viewAttributes() ?>><?php echo $receipts_view_grid->UnitCost->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_UnitCost" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipts_view_grid->UnitCost->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_UnitCost" name="o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipts_view_grid->UnitCost->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_UnitCost" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipts_view_grid->UnitCost->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_UnitCost" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipts_view_grid->UnitCost->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $receipts_view_grid->Quantity->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_Quantity" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_Quantity" name="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->Quantity->EditValue ?>"<?php echo $receipts_view_grid->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_Quantity" name="o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipts_view_grid->Quantity->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_Quantity" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_Quantity" name="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->Quantity->EditValue ?>"<?php echo $receipts_view_grid->Quantity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_Quantity">
<span<?php echo $receipts_view_grid->Quantity->viewAttributes() ?>><?php echo $receipts_view_grid->Quantity->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_Quantity" name="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipts_view_grid->Quantity->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_Quantity" name="o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipts_view_grid->Quantity->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_Quantity" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipts_view_grid->Quantity->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_Quantity" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipts_view_grid->Quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $receipts_view_grid->UnitOfMeasure->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_UnitOfMeasure" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_UnitOfMeasure" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->UnitOfMeasure->EditValue ?>"<?php echo $receipts_view_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_UnitOfMeasure" name="o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_UnitOfMeasure" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_UnitOfMeasure" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->UnitOfMeasure->EditValue ?>"<?php echo $receipts_view_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_UnitOfMeasure">
<span<?php echo $receipts_view_grid->UnitOfMeasure->viewAttributes() ?>><?php echo $receipts_view_grid->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_UnitOfMeasure" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_UnitOfMeasure" name="o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_UnitOfMeasure" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_UnitOfMeasure" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $receipts_view_grid->AmountPaid->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_AmountPaid" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_AmountPaid" name="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->AmountPaid->EditValue ?>"<?php echo $receipts_view_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_AmountPaid" name="o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_AmountPaid" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_AmountPaid" name="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->AmountPaid->EditValue ?>"<?php echo $receipts_view_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_AmountPaid">
<span<?php echo $receipts_view_grid->AmountPaid->viewAttributes() ?>><?php echo $receipts_view_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_AmountPaid" name="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_AmountPaid" name="o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_AmountPaid" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_AmountPaid" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $receipts_view_grid->PaymentMethod->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentMethod" class="form-group">
<?php
$onchange = $receipts_view_grid->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo RemoveHtml($receipts_view_grid->PaymentMethod->EditValue) ?>" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipts_view_grid->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->PaymentMethod->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_PaymentMethod") ?>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentMethod" class="form-group">
<?php
$onchange = $receipts_view_grid->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo RemoveHtml($receipts_view_grid->PaymentMethod->EditValue) ?>" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipts_view_grid->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->PaymentMethod->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentMethod">
<span<?php echo $receipts_view_grid->PaymentMethod->viewAttributes() ?>><?php echo $receipts_view_grid->PaymentMethod->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" <?php echo $receipts_view_grid->PaymentRef->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentRef" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_PaymentRef" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->PaymentRef->EditValue ?>"<?php echo $receipts_view_grid->PaymentRef->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentRef" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentRef" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_PaymentRef" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->PaymentRef->EditValue ?>"<?php echo $receipts_view_grid->PaymentRef->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentRef">
<span<?php echo $receipts_view_grid->PaymentRef->viewAttributes() ?>><?php echo $receipts_view_grid->PaymentRef->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentRef" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_PaymentRef" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentRef" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_PaymentRef" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" <?php echo $receipts_view_grid->CashierNo->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_CashierNo" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_CashierNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_grid->CashierNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->CashierNo->EditValue ?>"<?php echo $receipts_view_grid->CashierNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_CashierNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipts_view_grid->CashierNo->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_CashierNo" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_CashierNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_grid->CashierNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->CashierNo->EditValue ?>"<?php echo $receipts_view_grid->CashierNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_CashierNo">
<span<?php echo $receipts_view_grid->CashierNo->viewAttributes() ?>><?php echo $receipts_view_grid->CashierNo->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_CashierNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipts_view_grid->CashierNo->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_CashierNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipts_view_grid->CashierNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_CashierNo" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipts_view_grid->CashierNo->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_CashierNo" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipts_view_grid->CashierNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $receipts_view_grid->BillPeriod->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipts_view_grid->BillPeriod->getSessionValue() != "") { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillPeriod" class="form-group">
<span<?php echo $receipts_view_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillPeriod" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->BillPeriod->EditValue ?>"<?php echo $receipts_view_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillPeriod" name="o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipts_view_grid->BillPeriod->getSessionValue() != "") { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillPeriod" class="form-group">
<span<?php echo $receipts_view_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillPeriod" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->BillPeriod->EditValue ?>"<?php echo $receipts_view_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillPeriod">
<span<?php echo $receipts_view_grid->BillPeriod->viewAttributes() ?>><?php echo $receipts_view_grid->BillPeriod->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_BillPeriod" name="o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillPeriod" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_BillPeriod" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $receipts_view_grid->BillYear->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipts_view_grid->BillYear->getSessionValue() != "") { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillYear" class="form-group">
<span<?php echo $receipts_view_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillYear" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->BillYear->EditValue ?>"<?php echo $receipts_view_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillYear" name="o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipts_view_grid->BillYear->getSessionValue() != "") { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillYear" class="form-group">
<span<?php echo $receipts_view_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillYear" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->BillYear->EditValue ?>"<?php echo $receipts_view_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_BillYear">
<span<?php echo $receipts_view_grid->BillYear->viewAttributes() ?>><?php echo $receipts_view_grid->BillYear->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_BillYear" name="o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillYear" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_BillYear" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentFor->Visible) { // PaymentFor ?>
		<td data-name="PaymentFor" <?php echo $receipts_view_grid->PaymentFor->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentFor" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_PaymentFor" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->PaymentFor->EditValue ?>"<?php echo $receipts_view_grid->PaymentFor->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentFor" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" value="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentFor" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_PaymentFor" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->PaymentFor->EditValue ?>"<?php echo $receipts_view_grid->PaymentFor->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_PaymentFor">
<span<?php echo $receipts_view_grid->PaymentFor->viewAttributes() ?>><?php echo $receipts_view_grid->PaymentFor->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentFor" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" value="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_PaymentFor" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" value="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentFor" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" value="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_PaymentFor" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" value="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $receipts_view_grid->ChargeGroup->cellAttributes() ?>>
<?php if ($receipts_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ChargeGroup" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_ChargeGroup" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ChargeGroup->EditValue ?>"<?php echo $receipts_view_grid->ChargeGroup->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeGroup" name="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ChargeGroup" class="form-group">
<input type="text" data-table="receipts_view" data-field="x_ChargeGroup" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ChargeGroup->EditValue ?>"<?php echo $receipts_view_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipts_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipts_view_grid->RowCount ?>_receipts_view_ChargeGroup">
<span<?php echo $receipts_view_grid->ChargeGroup->viewAttributes() ?>><?php echo $receipts_view_grid->ChargeGroup->getViewValue() ?></span>
</span>
<?php if (!$receipts_view->isConfirm()) { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeGroup" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ChargeGroup" name="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeGroup" name="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="freceipts_viewgrid$x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="receipts_view" data-field="x_ChargeGroup" name="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="freceipts_viewgrid$o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipts_view_grid->ListOptions->render("body", "right", $receipts_view_grid->RowCount);
?>
	</tr>
<?php if ($receipts_view->RowType == ROWTYPE_ADD || $receipts_view->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["freceipts_viewgrid", "load"], function() {
	freceipts_viewgrid.updateLists(<?php echo $receipts_view_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$receipts_view_grid->isGridAdd() || $receipts_view->CurrentMode == "copy")
		if (!$receipts_view_grid->Recordset->EOF)
			$receipts_view_grid->Recordset->moveNext();
}
?>
<?php
	if ($receipts_view->CurrentMode == "add" || $receipts_view->CurrentMode == "copy" || $receipts_view->CurrentMode == "edit") {
		$receipts_view_grid->RowIndex = '$rowindex$';
		$receipts_view_grid->loadRowValues();

		// Set row properties
		$receipts_view->resetAttributes();
		$receipts_view->RowAttrs->merge(["data-rowindex" => $receipts_view_grid->RowIndex, "id" => "r0_receipts_view", "data-rowtype" => ROWTYPE_ADD]);
		$receipts_view->RowAttrs->appendClass("ew-template");
		$receipts_view->RowType = ROWTYPE_ADD;

		// Render row
		$receipts_view_grid->renderRow();

		// Render list options
		$receipts_view_grid->renderListOptions();
		$receipts_view_grid->StartRowCount = 0;
?>
	<tr <?php echo $receipts_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipts_view_grid->ListOptions->render("body", "left", $receipts_view_grid->RowIndex);
?>
	<?php if ($receipts_view_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_ReceiptNo" class="form-group receipts_view_ReceiptNo">
<input type="text" data-table="receipts_view" data-field="x_ReceiptNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ReceiptNo->EditValue ?>"<?php echo $receipts_view_grid->ReceiptNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ReceiptNo" class="form-group receipts_view_ReceiptNo">
<span<?php echo $receipts_view_grid->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo">
<?php if (!$receipts_view->isConfirm()) { ?>
<?php if ($receipts_view_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipts_view_ClientSerNo" class="form-group receipts_view_ClientSerNo">
<span<?php echo $receipts_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ClientSerNo" class="form-group receipts_view_ClientSerNo">
<?php
$onchange = $receipts_view_grid->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($receipts_view_grid->ClientSerNo->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->ClientSerNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" data-value-separator="<?php echo $receipts_view_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->ClientSerNo->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ClientSerNo" class="form-group receipts_view_ClientSerNo">
<span<?php echo $receipts_view_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ClientSerNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_grid->ClientSerNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<?php if (!$receipts_view->isConfirm()) { ?>
<?php if ($receipts_view_grid->ChargeCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipts_view_ChargeCode" class="form-group receipts_view_ChargeCode">
<span<?php echo $receipts_view_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ChargeCode" class="form-group receipts_view_ChargeCode">
<?php
$onchange = $receipts_view_grid->ChargeCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipts_view_grid->ChargeCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->ChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" data-value-separator="<?php echo $receipts_view_grid->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->ChargeCode->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_ChargeCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ChargeCode" class="form-group receipts_view_ChargeCode">
<span<?php echo $receipts_view_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeCode" name="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipts_view_grid->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_ReceiptDate" class="form-group receipts_view_ReceiptDate">
<input type="text" data-table="receipts_view" data-field="x_ReceiptDate" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ReceiptDate->EditValue ?>"<?php echo $receipts_view_grid->ReceiptDate->editAttributes() ?>>
<?php if (!$receipts_view_grid->ReceiptDate->ReadOnly && !$receipts_view_grid->ReceiptDate->Disabled && !isset($receipts_view_grid->ReceiptDate->EditAttrs["readonly"]) && !isset($receipts_view_grid->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freceipts_viewgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("freceipts_viewgrid", "x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ReceiptDate" class="form-group receipts_view_ReceiptDate">
<span<?php echo $receipts_view_grid->ReceiptDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ReceiptDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptDate" name="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="x<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ReceiptDate" name="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" id="o<?php echo $receipts_view_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipts_view_grid->ReceiptDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID">
<?php if (!$receipts_view->isConfirm()) { ?>
<?php if ($receipts_view_grid->ItemID->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipts_view_ItemID" class="form-group receipts_view_ItemID">
<span<?php echo $receipts_view_grid->ItemID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ItemID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ItemID" class="form-group receipts_view_ItemID">
<input type="text" data-table="receipts_view" data-field="x_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_grid->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ItemID->EditValue ?>"<?php echo $receipts_view_grid->ItemID->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ItemID" class="form-group receipts_view_ItemID">
<span<?php echo $receipts_view_grid->ItemID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ItemID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="x<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ItemID" name="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" id="o<?php echo $receipts_view_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipts_view_grid->ItemID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_UnitCost" class="form-group receipts_view_UnitCost">
<input type="text" data-table="receipts_view" data-field="x_UnitCost" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->UnitCost->EditValue ?>"<?php echo $receipts_view_grid->UnitCost->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_UnitCost" class="form-group receipts_view_UnitCost">
<span<?php echo $receipts_view_grid->UnitCost->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->UnitCost->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_UnitCost" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipts_view_grid->UnitCost->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_UnitCost" name="o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" id="o<?php echo $receipts_view_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipts_view_grid->UnitCost->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_Quantity" class="form-group receipts_view_Quantity">
<input type="text" data-table="receipts_view" data-field="x_Quantity" name="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($receipts_view_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->Quantity->EditValue ?>"<?php echo $receipts_view_grid->Quantity->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_Quantity" class="form-group receipts_view_Quantity">
<span<?php echo $receipts_view_grid->Quantity->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->Quantity->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_Quantity" name="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="x<?php echo $receipts_view_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipts_view_grid->Quantity->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_Quantity" name="o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" id="o<?php echo $receipts_view_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipts_view_grid->Quantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_UnitOfMeasure" class="form-group receipts_view_UnitOfMeasure">
<input type="text" data-table="receipts_view" data-field="x_UnitOfMeasure" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->UnitOfMeasure->EditValue ?>"<?php echo $receipts_view_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_UnitOfMeasure" class="form-group receipts_view_UnitOfMeasure">
<span<?php echo $receipts_view_grid->UnitOfMeasure->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->UnitOfMeasure->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_UnitOfMeasure" name="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_UnitOfMeasure" name="o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipts_view_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipts_view_grid->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_AmountPaid" class="form-group receipts_view_AmountPaid">
<input type="text" data-table="receipts_view" data-field="x_AmountPaid" name="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" size="30" maxlength="23" placeholder="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->AmountPaid->EditValue ?>"<?php echo $receipts_view_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_AmountPaid" class="form-group receipts_view_AmountPaid">
<span<?php echo $receipts_view_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_AmountPaid" name="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_AmountPaid" name="o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" id="o<?php echo $receipts_view_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipts_view_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_PaymentMethod" class="form-group receipts_view_PaymentMethod">
<?php
$onchange = $receipts_view_grid->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipts_view_grid->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod">
	<input type="text" class="form-control" name="sv_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="sv_x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo RemoveHtml($receipts_view_grid->PaymentMethod->EditValue) ?>" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->getPlaceHolder()) ?>"<?php echo $receipts_view_grid->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipts_view_grid->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceipts_viewgrid"], function() {
	freceipts_viewgrid.createAutoSuggest({"id":"x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $receipts_view_grid->PaymentMethod->Lookup->getParamTag($receipts_view_grid, "p_x" . $receipts_view_grid->RowIndex . "_PaymentMethod") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_PaymentMethod" class="form-group receipts_view_PaymentMethod">
<span<?php echo $receipts_view_grid->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentMethod" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipts_view_grid->PaymentMethod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_PaymentRef" class="form-group receipts_view_PaymentRef">
<input type="text" data-table="receipts_view" data-field="x_PaymentRef" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->PaymentRef->EditValue ?>"<?php echo $receipts_view_grid->PaymentRef->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_PaymentRef" class="form-group receipts_view_PaymentRef">
<span<?php echo $receipts_view_grid->PaymentRef->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->PaymentRef->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentRef" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentRef" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipts_view_grid->PaymentRef->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_CashierNo" class="form-group receipts_view_CashierNo">
<input type="text" data-table="receipts_view" data-field="x_CashierNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipts_view_grid->CashierNo->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->CashierNo->EditValue ?>"<?php echo $receipts_view_grid->CashierNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_CashierNo" class="form-group receipts_view_CashierNo">
<span<?php echo $receipts_view_grid->CashierNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->CashierNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_CashierNo" name="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="x<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipts_view_grid->CashierNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_CashierNo" name="o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" id="o<?php echo $receipts_view_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipts_view_grid->CashierNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<?php if (!$receipts_view->isConfirm()) { ?>
<?php if ($receipts_view_grid->BillPeriod->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipts_view_BillPeriod" class="form-group receipts_view_BillPeriod">
<span<?php echo $receipts_view_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipts_view_BillPeriod" class="form-group receipts_view_BillPeriod">
<input type="text" data-table="receipts_view" data-field="x_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->BillPeriod->EditValue ?>"<?php echo $receipts_view_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_BillPeriod" class="form-group receipts_view_BillPeriod">
<span<?php echo $receipts_view_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_BillPeriod" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillPeriod" name="o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" id="o<?php echo $receipts_view_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipts_view_grid->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<?php if (!$receipts_view->isConfirm()) { ?>
<?php if ($receipts_view_grid->BillYear->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipts_view_BillYear" class="form-group receipts_view_BillYear">
<span<?php echo $receipts_view_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipts_view_BillYear" class="form-group receipts_view_BillYear">
<input type="text" data-table="receipts_view" data-field="x_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($receipts_view_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->BillYear->EditValue ?>"<?php echo $receipts_view_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_BillYear" class="form-group receipts_view_BillYear">
<span<?php echo $receipts_view_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_BillYear" name="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="x<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_BillYear" name="o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" id="o<?php echo $receipts_view_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipts_view_grid->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentFor->Visible) { // PaymentFor ?>
		<td data-name="PaymentFor">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_PaymentFor" class="form-group receipts_view_PaymentFor">
<input type="text" data-table="receipts_view" data-field="x_PaymentFor" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->PaymentFor->EditValue ?>"<?php echo $receipts_view_grid->PaymentFor->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_PaymentFor" class="form-group receipts_view_PaymentFor">
<span<?php echo $receipts_view_grid->PaymentFor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->PaymentFor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentFor" name="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="x<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" value="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_PaymentFor" name="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" id="o<?php echo $receipts_view_grid->RowIndex ?>_PaymentFor" value="<?php echo HtmlEncode($receipts_view_grid->PaymentFor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipts_view_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<?php if (!$receipts_view->isConfirm()) { ?>
<span id="el$rowindex$_receipts_view_ChargeGroup" class="form-group receipts_view_ChargeGroup">
<input type="text" data-table="receipts_view" data-field="x_ChargeGroup" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipts_view_grid->ChargeGroup->EditValue ?>"<?php echo $receipts_view_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipts_view_ChargeGroup" class="form-group receipts_view_ChargeGroup">
<span<?php echo $receipts_view_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipts_view_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeGroup" name="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipts_view" data-field="x_ChargeGroup" name="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $receipts_view_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipts_view_grid->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipts_view_grid->ListOptions->render("body", "right", $receipts_view_grid->RowIndex);
?>
<script>
loadjs.ready(["freceipts_viewgrid", "load"], function() {
	freceipts_viewgrid.updateLists(<?php echo $receipts_view_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$receipts_view->RowType = ROWTYPE_AGGREGATE;
$receipts_view->resetAttributes();
$receipts_view_grid->renderRow();
?>
<?php if ($receipts_view_grid->TotalRecords > 0 && $receipts_view->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$receipts_view_grid->renderListOptions();

// Render list options (footer, left)
$receipts_view_grid->ListOptions->render("footer", "left");
?>
	<?php if ($receipts_view_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" class="<?php echo $receipts_view_grid->ReceiptNo->footerCellClass() ?>"><span id="elf_receipts_view_ReceiptNo" class="receipts_view_ReceiptNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" class="<?php echo $receipts_view_grid->ClientSerNo->footerCellClass() ?>"><span id="elf_receipts_view_ClientSerNo" class="receipts_view_ClientSerNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" class="<?php echo $receipts_view_grid->ChargeCode->footerCellClass() ?>"><span id="elf_receipts_view_ChargeCode" class="receipts_view_ChargeCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" class="<?php echo $receipts_view_grid->ReceiptDate->footerCellClass() ?>"><span id="elf_receipts_view_ReceiptDate" class="receipts_view_ReceiptDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" class="<?php echo $receipts_view_grid->ItemID->footerCellClass() ?>"><span id="elf_receipts_view_ItemID" class="receipts_view_ItemID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" class="<?php echo $receipts_view_grid->UnitCost->footerCellClass() ?>"><span id="elf_receipts_view_UnitCost" class="receipts_view_UnitCost">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" class="<?php echo $receipts_view_grid->Quantity->footerCellClass() ?>"><span id="elf_receipts_view_Quantity" class="receipts_view_Quantity">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" class="<?php echo $receipts_view_grid->UnitOfMeasure->footerCellClass() ?>"><span id="elf_receipts_view_UnitOfMeasure" class="receipts_view_UnitOfMeasure">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $receipts_view_grid->AmountPaid->footerCellClass() ?>"><span id="elf_receipts_view_AmountPaid" class="receipts_view_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $receipts_view_grid->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" class="<?php echo $receipts_view_grid->PaymentMethod->footerCellClass() ?>"><span id="elf_receipts_view_PaymentMethod" class="receipts_view_PaymentMethod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" class="<?php echo $receipts_view_grid->PaymentRef->footerCellClass() ?>"><span id="elf_receipts_view_PaymentRef" class="receipts_view_PaymentRef">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" class="<?php echo $receipts_view_grid->CashierNo->footerCellClass() ?>"><span id="elf_receipts_view_CashierNo" class="receipts_view_CashierNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" class="<?php echo $receipts_view_grid->BillPeriod->footerCellClass() ?>"><span id="elf_receipts_view_BillPeriod" class="receipts_view_BillPeriod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" class="<?php echo $receipts_view_grid->BillYear->footerCellClass() ?>"><span id="elf_receipts_view_BillYear" class="receipts_view_BillYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->PaymentFor->Visible) { // PaymentFor ?>
		<td data-name="PaymentFor" class="<?php echo $receipts_view_grid->PaymentFor->footerCellClass() ?>"><span id="elf_receipts_view_PaymentFor" class="receipts_view_PaymentFor">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" class="<?php echo $receipts_view_grid->ChargeGroup->footerCellClass() ?>"><span id="elf_receipts_view_ChargeGroup" class="receipts_view_ChargeGroup">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$receipts_view_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($receipts_view->CurrentMode == "add" || $receipts_view->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $receipts_view_grid->FormKeyCountName ?>" id="<?php echo $receipts_view_grid->FormKeyCountName ?>" value="<?php echo $receipts_view_grid->KeyCount ?>">
<?php echo $receipts_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($receipts_view->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $receipts_view_grid->FormKeyCountName ?>" id="<?php echo $receipts_view_grid->FormKeyCountName ?>" value="<?php echo $receipts_view_grid->KeyCount ?>">
<?php echo $receipts_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($receipts_view->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="freceipts_viewgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($receipts_view_grid->Recordset)
	$receipts_view_grid->Recordset->Close();
?>
<?php if ($receipts_view_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $receipts_view_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($receipts_view_grid->TotalRecords == 0 && !$receipts_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $receipts_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$receipts_view_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$receipts_view_grid->terminate();
?>