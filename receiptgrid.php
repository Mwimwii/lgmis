<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($receipt_grid))
	$receipt_grid = new receipt_grid();

// Run the page
$receipt_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_grid->Page_Render();
?>
<?php if (!$receipt_grid->isExport()) { ?>
<script>
var freceiptgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	freceiptgrid = new ew.Form("freceiptgrid", "grid");
	freceiptgrid.formKeyCountName = '<?php echo $receipt_grid->FormKeyCountName ?>';

	// Validate form
	freceiptgrid.validate = function() {
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
			<?php if ($receipt_grid->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->ClientSerNo->caption(), $receipt_grid->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->ChargeCode->caption(), $receipt_grid->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->ItemID->Required) { ?>
				elm = this.getElements("x" + infix + "_ItemID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->ItemID->caption(), $receipt_grid->ItemID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->UnitCost->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->UnitCost->caption(), $receipt_grid->UnitCost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_UnitCost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_grid->UnitCost->errorMessage()) ?>");
			<?php if ($receipt_grid->Quantity->Required) { ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->Quantity->caption(), $receipt_grid->Quantity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quantity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_grid->Quantity->errorMessage()) ?>");
			<?php if ($receipt_grid->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->UnitOfMeasure->caption(), $receipt_grid->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->AmountPaid->caption(), $receipt_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($receipt_grid->ReceiptNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->ReceiptNo->caption(), $receipt_grid->ReceiptNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->ReceiptDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ReceiptDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->ReceiptDate->caption(), $receipt_grid->ReceiptDate->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->PaymentMethod->caption(), $receipt_grid->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->PaymentRef->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->PaymentRef->caption(), $receipt_grid->PaymentRef->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->CashierNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CashierNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->CashierNo->caption(), $receipt_grid->CashierNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->BillPeriod->caption(), $receipt_grid->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_grid->BillPeriod->errorMessage()) ?>");
			<?php if ($receipt_grid->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->BillYear->caption(), $receipt_grid->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($receipt_grid->BillYear->errorMessage()) ?>");
			<?php if ($receipt_grid->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->ChargeGroup->caption(), $receipt_grid->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($receipt_grid->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $receipt_grid->ClientID->caption(), $receipt_grid->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	freceiptgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ClientSerNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ItemID", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitCost", false)) return false;
		if (ew.valueChanged(fobj, infix, "Quantity", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPaid", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReceiptNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentMethod", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentRef", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeGroup", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientID", false)) return false;
		return true;
	}

	// Form_CustomValidate
	freceiptgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freceiptgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freceiptgrid.lists["x_ClientSerNo"] = <?php echo $receipt_grid->ClientSerNo->Lookup->toClientList($receipt_grid) ?>;
	freceiptgrid.lists["x_ClientSerNo"].options = <?php echo JsonEncode($receipt_grid->ClientSerNo->lookupOptions()) ?>;
	freceiptgrid.lists["x_ChargeCode"] = <?php echo $receipt_grid->ChargeCode->Lookup->toClientList($receipt_grid) ?>;
	freceiptgrid.lists["x_ChargeCode"].options = <?php echo JsonEncode($receipt_grid->ChargeCode->lookupOptions()) ?>;
	freceiptgrid.autoSuggests["x_ChargeCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	freceiptgrid.lists["x_PaymentMethod"] = <?php echo $receipt_grid->PaymentMethod->Lookup->toClientList($receipt_grid) ?>;
	freceiptgrid.lists["x_PaymentMethod"].options = <?php echo JsonEncode($receipt_grid->PaymentMethod->lookupOptions()) ?>;
	loadjs.done("freceiptgrid");
});
</script>
<script>
ew.ready("head", "js/ewfixedheadertable.js", "fixedheadertable");
</script>
<?php } ?>
<?php
$receipt_grid->renderOtherOptions();
?>
<?php if ($receipt_grid->TotalRecords > 0 || $receipt->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($receipt_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> receipt">
<?php if ($receipt_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $receipt_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="freceiptgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_receipt" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_receiptgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$receipt->RowType = ROWTYPE_HEADER;

// Render list options
$receipt_grid->renderListOptions();

// Render list options (header, left)
$receipt_grid->ListOptions->render("header", "left");
?>
<?php if ($receipt_grid->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_grid->ClientSerNo->headerCellClass() ?>"><div id="elh_receipt_ClientSerNo" class="receipt_ClientSerNo"><div class="ew-table-header-caption"><?php echo $receipt_grid->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_grid->ClientSerNo->headerCellClass() ?>"><div><div id="elh_receipt_ClientSerNo" class="receipt_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $receipt_grid->ChargeCode->headerCellClass() ?>"><div id="elh_receipt_ChargeCode" class="receipt_ChargeCode"><div class="ew-table-header-caption"><?php echo $receipt_grid->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $receipt_grid->ChargeCode->headerCellClass() ?>"><div><div id="elh_receipt_ChargeCode" class="receipt_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->ItemID->Visible) { // ItemID ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->ItemID) == "") { ?>
		<th data-name="ItemID" class="<?php echo $receipt_grid->ItemID->headerCellClass() ?>"><div id="elh_receipt_ItemID" class="receipt_ItemID"><div class="ew-table-header-caption"><?php echo $receipt_grid->ItemID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemID" class="<?php echo $receipt_grid->ItemID->headerCellClass() ?>"><div><div id="elh_receipt_ItemID" class="receipt_ItemID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->ItemID->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->ItemID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->ItemID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->UnitCost->Visible) { // UnitCost ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $receipt_grid->UnitCost->headerCellClass() ?>"><div id="elh_receipt_UnitCost" class="receipt_UnitCost"><div class="ew-table-header-caption"><?php echo $receipt_grid->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $receipt_grid->UnitCost->headerCellClass() ?>"><div><div id="elh_receipt_UnitCost" class="receipt_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->Quantity->Visible) { // Quantity ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $receipt_grid->Quantity->headerCellClass() ?>"><div id="elh_receipt_Quantity" class="receipt_Quantity"><div class="ew-table-header-caption"><?php echo $receipt_grid->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $receipt_grid->Quantity->headerCellClass() ?>"><div><div id="elh_receipt_Quantity" class="receipt_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipt_grid->UnitOfMeasure->headerCellClass() ?>"><div id="elh_receipt_UnitOfMeasure" class="receipt_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $receipt_grid->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipt_grid->UnitOfMeasure->headerCellClass() ?>"><div><div id="elh_receipt_UnitOfMeasure" class="receipt_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $receipt_grid->AmountPaid->headerCellClass() ?>"><div id="elh_receipt_AmountPaid" class="receipt_AmountPaid"><div class="ew-table-header-caption"><?php echo $receipt_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $receipt_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_receipt_AmountPaid" class="receipt_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_grid->ReceiptNo->headerCellClass() ?>"><div id="elh_receipt_ReceiptNo" class="receipt_ReceiptNo"><div class="ew-table-header-caption"><?php echo $receipt_grid->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_grid->ReceiptNo->headerCellClass() ?>"><div><div id="elh_receipt_ReceiptNo" class="receipt_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_grid->ReceiptDate->headerCellClass() ?>"><div id="elh_receipt_ReceiptDate" class="receipt_ReceiptDate"><div class="ew-table-header-caption"><?php echo $receipt_grid->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_grid->ReceiptDate->headerCellClass() ?>"><div><div id="elh_receipt_ReceiptDate" class="receipt_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_grid->PaymentMethod->headerCellClass() ?>"><div id="elh_receipt_PaymentMethod" class="receipt_PaymentMethod"><div class="ew-table-header-caption"><?php echo $receipt_grid->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_grid->PaymentMethod->headerCellClass() ?>"><div><div id="elh_receipt_PaymentMethod" class="receipt_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->PaymentRef->Visible) { // PaymentRef ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->PaymentRef) == "") { ?>
		<th data-name="PaymentRef" class="<?php echo $receipt_grid->PaymentRef->headerCellClass() ?>"><div id="elh_receipt_PaymentRef" class="receipt_PaymentRef"><div class="ew-table-header-caption"><?php echo $receipt_grid->PaymentRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentRef" class="<?php echo $receipt_grid->PaymentRef->headerCellClass() ?>"><div><div id="elh_receipt_PaymentRef" class="receipt_PaymentRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->PaymentRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->PaymentRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->PaymentRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->CashierNo->Visible) { // CashierNo ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->CashierNo) == "") { ?>
		<th data-name="CashierNo" class="<?php echo $receipt_grid->CashierNo->headerCellClass() ?>"><div id="elh_receipt_CashierNo" class="receipt_CashierNo"><div class="ew-table-header-caption"><?php echo $receipt_grid->CashierNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CashierNo" class="<?php echo $receipt_grid->CashierNo->headerCellClass() ?>"><div><div id="elh_receipt_CashierNo" class="receipt_CashierNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->CashierNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $receipt_grid->BillPeriod->headerCellClass() ?>"><div id="elh_receipt_BillPeriod" class="receipt_BillPeriod"><div class="ew-table-header-caption"><?php echo $receipt_grid->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $receipt_grid->BillPeriod->headerCellClass() ?>"><div><div id="elh_receipt_BillPeriod" class="receipt_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->BillYear->Visible) { // BillYear ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $receipt_grid->BillYear->headerCellClass() ?>"><div id="elh_receipt_BillYear" class="receipt_BillYear"><div class="ew-table-header-caption"><?php echo $receipt_grid->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $receipt_grid->BillYear->headerCellClass() ?>"><div><div id="elh_receipt_BillYear" class="receipt_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_grid->ChargeGroup->headerCellClass() ?>"><div id="elh_receipt_ChargeGroup" class="receipt_ChargeGroup"><div class="ew-table-header-caption"><?php echo $receipt_grid->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_grid->ChargeGroup->headerCellClass() ?>"><div><div id="elh_receipt_ChargeGroup" class="receipt_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_grid->ClientID->Visible) { // ClientID ?>
	<?php if ($receipt_grid->SortUrl($receipt_grid->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $receipt_grid->ClientID->headerCellClass() ?>"><div id="elh_receipt_ClientID" class="receipt_ClientID"><div class="ew-table-header-caption"><?php echo $receipt_grid->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $receipt_grid->ClientID->headerCellClass() ?>"><div><div id="elh_receipt_ClientID" class="receipt_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_grid->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_grid->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_grid->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipt_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$receipt_grid->StartRecord = 1;
$receipt_grid->StopRecord = $receipt_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($receipt->isConfirm() || $receipt_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($receipt_grid->FormKeyCountName) && ($receipt_grid->isGridAdd() || $receipt_grid->isGridEdit() || $receipt->isConfirm())) {
		$receipt_grid->KeyCount = $CurrentForm->getValue($receipt_grid->FormKeyCountName);
		$receipt_grid->StopRecord = $receipt_grid->StartRecord + $receipt_grid->KeyCount - 1;
	}
}
$receipt_grid->RecordCount = $receipt_grid->StartRecord - 1;
if ($receipt_grid->Recordset && !$receipt_grid->Recordset->EOF) {
	$receipt_grid->Recordset->moveFirst();
	$selectLimit = $receipt_grid->UseSelectLimit;
	if (!$selectLimit && $receipt_grid->StartRecord > 1)
		$receipt_grid->Recordset->move($receipt_grid->StartRecord - 1);
} elseif (!$receipt->AllowAddDeleteRow && $receipt_grid->StopRecord == 0) {
	$receipt_grid->StopRecord = $receipt->GridAddRowCount;
}

// Initialize aggregate
$receipt->RowType = ROWTYPE_AGGREGATEINIT;
$receipt->resetAttributes();
$receipt_grid->renderRow();
if ($receipt_grid->isGridAdd())
	$receipt_grid->RowIndex = 0;
if ($receipt_grid->isGridEdit())
	$receipt_grid->RowIndex = 0;
while ($receipt_grid->RecordCount < $receipt_grid->StopRecord) {
	$receipt_grid->RecordCount++;
	if ($receipt_grid->RecordCount >= $receipt_grid->StartRecord) {
		$receipt_grid->RowCount++;
		if ($receipt_grid->isGridAdd() || $receipt_grid->isGridEdit() || $receipt->isConfirm()) {
			$receipt_grid->RowIndex++;
			$CurrentForm->Index = $receipt_grid->RowIndex;
			if ($CurrentForm->hasValue($receipt_grid->FormActionName) && ($receipt->isConfirm() || $receipt_grid->EventCancelled))
				$receipt_grid->RowAction = strval($CurrentForm->getValue($receipt_grid->FormActionName));
			elseif ($receipt_grid->isGridAdd())
				$receipt_grid->RowAction = "insert";
			else
				$receipt_grid->RowAction = "";
		}

		// Set up key count
		$receipt_grid->KeyCount = $receipt_grid->RowIndex;

		// Init row class and style
		$receipt->resetAttributes();
		$receipt->CssClass = "";
		if ($receipt_grid->isGridAdd()) {
			if ($receipt->CurrentMode == "copy") {
				$receipt_grid->loadRowValues($receipt_grid->Recordset); // Load row values
				$receipt_grid->setRecordKey($receipt_grid->RowOldKey, $receipt_grid->Recordset); // Set old record key
			} else {
				$receipt_grid->loadRowValues(); // Load default values
				$receipt_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$receipt_grid->loadRowValues($receipt_grid->Recordset); // Load row values
		}
		$receipt->RowType = ROWTYPE_VIEW; // Render view
		if ($receipt_grid->isGridAdd()) // Grid add
			$receipt->RowType = ROWTYPE_ADD; // Render add
		if ($receipt_grid->isGridAdd() && $receipt->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$receipt_grid->restoreCurrentRowFormValues($receipt_grid->RowIndex); // Restore form values
		if ($receipt_grid->isGridEdit()) { // Grid edit
			if ($receipt->EventCancelled)
				$receipt_grid->restoreCurrentRowFormValues($receipt_grid->RowIndex); // Restore form values
			if ($receipt_grid->RowAction == "insert")
				$receipt->RowType = ROWTYPE_ADD; // Render add
			else
				$receipt->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($receipt_grid->isGridEdit() && ($receipt->RowType == ROWTYPE_EDIT || $receipt->RowType == ROWTYPE_ADD) && $receipt->EventCancelled) // Update failed
			$receipt_grid->restoreCurrentRowFormValues($receipt_grid->RowIndex); // Restore form values
		if ($receipt->RowType == ROWTYPE_EDIT) // Edit row
			$receipt_grid->EditRowCount++;
		if ($receipt->isConfirm()) // Confirm row
			$receipt_grid->restoreCurrentRowFormValues($receipt_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$receipt->RowAttrs->merge(["data-rowindex" => $receipt_grid->RowCount, "id" => "r" . $receipt_grid->RowCount . "_receipt", "data-rowtype" => $receipt->RowType]);

		// Render row
		$receipt_grid->renderRow();

		// Render list options
		$receipt_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($receipt_grid->RowAction != "delete" && $receipt_grid->RowAction != "insertdelete" && !($receipt_grid->RowAction == "insert" && $receipt->isConfirm() && $receipt_grid->emptyRow())) {
?>
	<tr <?php echo $receipt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipt_grid->ListOptions->render("body", "left", $receipt_grid->RowCount);
?>
	<?php if ($receipt_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $receipt_grid->ClientSerNo->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ClientSerNo" class="form-group">
<span<?php echo $receipt_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ClientSerNo" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo"><?php echo EmptyValue(strval($receipt_grid->ClientSerNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_grid->ClientSerNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_grid->ClientSerNo->ReadOnly || $receipt_grid->ClientSerNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_grid->ClientSerNo->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_ClientSerNo") ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo $receipt_grid->ClientSerNo->CurrentValue ?>"<?php echo $receipt_grid->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipt_grid->ClientSerNo->getSessionValue() != "") { ?>

<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ClientSerNo" class="form-group">
<span<?php echo $receipt_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ClientSerNo->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo"><?php echo EmptyValue(strval($receipt_grid->ClientSerNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_grid->ClientSerNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_grid->ClientSerNo->ReadOnly || $receipt_grid->ClientSerNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_grid->ClientSerNo->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_ClientSerNo") ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo $receipt_grid->ClientSerNo->CurrentValue ?>"<?php echo $receipt_grid->ClientSerNo->editAttributes() ?>>
<?php } ?>

<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->OldValue != null ? $receipt_grid->ClientSerNo->OldValue : $receipt_grid->ClientSerNo->CurrentValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ClientSerNo">
<span<?php echo $receipt_grid->ClientSerNo->viewAttributes() ?>><?php echo $receipt_grid->ClientSerNo->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $receipt_grid->ChargeCode->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ChargeCode" class="form-group">
<?php
$onchange = $receipt_grid->ChargeCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_grid->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipt_grid->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_grid->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_grid->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_grid->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_grid->RowIndex ?>_ChargeCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_grid->ChargeCode->ReadOnly || $receipt_grid->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_grid->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptgrid"], function() {
	freceiptgrid.createAutoSuggest({"id":"x<?php echo $receipt_grid->RowIndex ?>_ChargeCode","forceSelect":true});
});
</script>
<?php echo $receipt_grid->ChargeCode->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_ChargeCode") ?>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php
$onchange = $receipt_grid->ChargeCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_grid->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipt_grid->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_grid->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_grid->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_grid->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_grid->RowIndex ?>_ChargeCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_grid->ChargeCode->ReadOnly || $receipt_grid->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_grid->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptgrid"], function() {
	freceiptgrid.createAutoSuggest({"id":"x<?php echo $receipt_grid->RowIndex ?>_ChargeCode","forceSelect":true});
});
</script>
<?php echo $receipt_grid->ChargeCode->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_ChargeCode") ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->OldValue != null ? $receipt_grid->ChargeCode->OldValue : $receipt_grid->ChargeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ChargeCode">
<span<?php echo $receipt_grid->ChargeCode->viewAttributes() ?>><?php echo $receipt_grid->ChargeCode->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" <?php echo $receipt_grid->ItemID->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ItemID" class="form-group">
<input type="text" data-table="receipt" data-field="x_ItemID" name="x<?php echo $receipt_grid->RowIndex ?>_ItemID" id="x<?php echo $receipt_grid->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_grid->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ItemID->EditValue ?>"<?php echo $receipt_grid->ItemID->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="o<?php echo $receipt_grid->RowIndex ?>_ItemID" id="o<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="receipt" data-field="x_ItemID" name="x<?php echo $receipt_grid->RowIndex ?>_ItemID" id="x<?php echo $receipt_grid->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_grid->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ItemID->EditValue ?>"<?php echo $receipt_grid->ItemID->editAttributes() ?>>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="o<?php echo $receipt_grid->RowIndex ?>_ItemID" id="o<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->OldValue != null ? $receipt_grid->ItemID->OldValue : $receipt_grid->ItemID->CurrentValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ItemID">
<span<?php echo $receipt_grid->ItemID->viewAttributes() ?>><?php echo $receipt_grid->ItemID->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="x<?php echo $receipt_grid->RowIndex ?>_ItemID" id="x<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="o<?php echo $receipt_grid->RowIndex ?>_ItemID" id="o<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ItemID" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ItemID" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $receipt_grid->UnitCost->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_UnitCost" class="form-group">
<input type="text" data-table="receipt" data-field="x_UnitCost" name="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->UnitCost->EditValue ?>"<?php echo $receipt_grid->UnitCost->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="o<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="o<?php echo $receipt_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_grid->UnitCost->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_UnitCost" class="form-group">
<input type="text" data-table="receipt" data-field="x_UnitCost" name="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->UnitCost->EditValue ?>"<?php echo $receipt_grid->UnitCost->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_UnitCost">
<span<?php echo $receipt_grid->UnitCost->viewAttributes() ?>><?php echo $receipt_grid->UnitCost->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_grid->UnitCost->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="o<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="o<?php echo $receipt_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_grid->UnitCost->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_grid->UnitCost->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_grid->UnitCost->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $receipt_grid->Quantity->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_Quantity" class="form-group">
<input type="text" data-table="receipt" data-field="x_Quantity" name="x<?php echo $receipt_grid->RowIndex ?>_Quantity" id="x<?php echo $receipt_grid->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->Quantity->EditValue ?>"<?php echo $receipt_grid->Quantity->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="o<?php echo $receipt_grid->RowIndex ?>_Quantity" id="o<?php echo $receipt_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_grid->Quantity->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_Quantity" class="form-group">
<input type="text" data-table="receipt" data-field="x_Quantity" name="x<?php echo $receipt_grid->RowIndex ?>_Quantity" id="x<?php echo $receipt_grid->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->Quantity->EditValue ?>"<?php echo $receipt_grid->Quantity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_Quantity">
<span<?php echo $receipt_grid->Quantity->viewAttributes() ?>><?php echo $receipt_grid->Quantity->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="x<?php echo $receipt_grid->RowIndex ?>_Quantity" id="x<?php echo $receipt_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_grid->Quantity->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="o<?php echo $receipt_grid->RowIndex ?>_Quantity" id="o<?php echo $receipt_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_grid->Quantity->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_Quantity" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_grid->Quantity->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_Quantity" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_grid->Quantity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $receipt_grid->UnitOfMeasure->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_UnitOfMeasure" class="form-group">
<input type="text" data-table="receipt" data-field="x_UnitOfMeasure" name="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->UnitOfMeasure->EditValue ?>"<?php echo $receipt_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_UnitOfMeasure" class="form-group">
<input type="text" data-table="receipt" data-field="x_UnitOfMeasure" name="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->UnitOfMeasure->EditValue ?>"<?php echo $receipt_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_UnitOfMeasure">
<span<?php echo $receipt_grid->UnitOfMeasure->viewAttributes() ?>><?php echo $receipt_grid->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $receipt_grid->AmountPaid->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_AmountPaid" class="form-group">
<input type="text" data-table="receipt" data-field="x_AmountPaid" name="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->AmountPaid->EditValue ?>"<?php echo $receipt_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_AmountPaid" class="form-group">
<input type="text" data-table="receipt" data-field="x_AmountPaid" name="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->AmountPaid->EditValue ?>"<?php echo $receipt_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_AmountPaid">
<span<?php echo $receipt_grid->AmountPaid->viewAttributes() ?>><?php echo $receipt_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $receipt_grid->ReceiptNo->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_grid->ReceiptNo->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ReceiptNo" class="form-group">
<span<?php echo $receipt_grid->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ReceiptNo" class="form-group">
<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ReceiptNo->EditValue ?>"<?php echo $receipt_grid->ReceiptNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipt_grid->ReceiptNo->getSessionValue() != "") { ?>

<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ReceiptNo" class="form-group">
<span<?php echo $receipt_grid->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ReceiptNo->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ReceiptNo->EditValue ?>"<?php echo $receipt_grid->ReceiptNo->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->OldValue != null ? $receipt_grid->ReceiptNo->OldValue : $receipt_grid->ReceiptNo->CurrentValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ReceiptNo">
<span<?php echo $receipt_grid->ReceiptNo->viewAttributes() ?>><?php echo $receipt_grid->ReceiptNo->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $receipt_grid->ReceiptDate->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" id="o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_grid->ReceiptDate->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ReceiptDate">
<span<?php echo $receipt_grid->ReceiptDate->viewAttributes() ?>><?php echo $receipt_grid->ReceiptDate->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_grid->ReceiptDate->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" id="o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_grid->ReceiptDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_grid->ReceiptDate->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_grid->ReceiptDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $receipt_grid->PaymentMethod->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_grid->PaymentMethod->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentMethod" class="form-group">
<span<?php echo $receipt_grid->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentMethod" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_grid->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod"<?php echo $receipt_grid->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_grid->PaymentMethod->selectOptionListHtml("x{$receipt_grid->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_grid->PaymentMethod->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipt_grid->PaymentMethod->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentMethod" class="form-group">
<span<?php echo $receipt_grid->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentMethod" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_grid->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod"<?php echo $receipt_grid->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_grid->PaymentMethod->selectOptionListHtml("x{$receipt_grid->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_grid->PaymentMethod->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentMethod">
<span<?php echo $receipt_grid->PaymentMethod->viewAttributes() ?>><?php echo $receipt_grid->PaymentMethod->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" <?php echo $receipt_grid->PaymentRef->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentRef" class="form-group">
<input type="text" data-table="receipt" data-field="x_PaymentRef" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_grid->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->PaymentRef->EditValue ?>"<?php echo $receipt_grid->PaymentRef->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_grid->PaymentRef->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentRef" class="form-group">
<input type="text" data-table="receipt" data-field="x_PaymentRef" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_grid->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->PaymentRef->EditValue ?>"<?php echo $receipt_grid->PaymentRef->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_PaymentRef">
<span<?php echo $receipt_grid->PaymentRef->viewAttributes() ?>><?php echo $receipt_grid->PaymentRef->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_grid->PaymentRef->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_grid->PaymentRef->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_grid->PaymentRef->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_grid->PaymentRef->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" <?php echo $receipt_grid->CashierNo->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="o<?php echo $receipt_grid->RowIndex ?>_CashierNo" id="o<?php echo $receipt_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_grid->CashierNo->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_CashierNo">
<span<?php echo $receipt_grid->CashierNo->viewAttributes() ?>><?php echo $receipt_grid->CashierNo->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="x<?php echo $receipt_grid->RowIndex ?>_CashierNo" id="x<?php echo $receipt_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_grid->CashierNo->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="o<?php echo $receipt_grid->RowIndex ?>_CashierNo" id="o<?php echo $receipt_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_grid->CashierNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_CashierNo" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_grid->CashierNo->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_CashierNo" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_grid->CashierNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $receipt_grid->BillPeriod->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_BillPeriod" class="form-group">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->BillPeriod->EditValue ?>"<?php echo $receipt_grid->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_BillPeriod" class="form-group">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->BillPeriod->EditValue ?>"<?php echo $receipt_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_BillPeriod">
<span<?php echo $receipt_grid->BillPeriod->viewAttributes() ?>><?php echo $receipt_grid->BillPeriod->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_grid->BillPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $receipt_grid->BillYear->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_BillYear" class="form-group">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x<?php echo $receipt_grid->RowIndex ?>_BillYear" id="x<?php echo $receipt_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->BillYear->EditValue ?>"<?php echo $receipt_grid->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="o<?php echo $receipt_grid->RowIndex ?>_BillYear" id="o<?php echo $receipt_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_BillYear" class="form-group">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x<?php echo $receipt_grid->RowIndex ?>_BillYear" id="x<?php echo $receipt_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->BillYear->EditValue ?>"<?php echo $receipt_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_BillYear">
<span<?php echo $receipt_grid->BillYear->viewAttributes() ?>><?php echo $receipt_grid->BillYear->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="x<?php echo $receipt_grid->RowIndex ?>_BillYear" id="x<?php echo $receipt_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="o<?php echo $receipt_grid->RowIndex ?>_BillYear" id="o<?php echo $receipt_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_grid->BillYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_BillYear" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_BillYear" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $receipt_grid->ChargeGroup->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($receipt_grid->ChargeGroup->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ChargeGroup" class="form-group">
<span<?php echo $receipt_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ChargeGroup" class="form-group">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ChargeGroup->EditValue ?>"<?php echo $receipt_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($receipt_grid->ChargeGroup->getSessionValue() != "") { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ChargeGroup" class="form-group">
<span<?php echo $receipt_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ChargeGroup" class="form-group">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ChargeGroup->EditValue ?>"<?php echo $receipt_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ChargeGroup">
<span<?php echo $receipt_grid->ChargeGroup->viewAttributes() ?>><?php echo $receipt_grid->ChargeGroup->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($receipt_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $receipt_grid->ClientID->cellAttributes() ?>>
<?php if ($receipt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ClientID" class="form-group">
<input type="text" data-table="receipt" data-field="x_ClientID" name="x<?php echo $receipt_grid->RowIndex ?>_ClientID" id="x<?php echo $receipt_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ClientID->EditValue ?>"<?php echo $receipt_grid->ClientID->editAttributes() ?>>
</span>
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="o<?php echo $receipt_grid->RowIndex ?>_ClientID" id="o<?php echo $receipt_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ClientID" class="form-group">
<input type="text" data-table="receipt" data-field="x_ClientID" name="x<?php echo $receipt_grid->RowIndex ?>_ClientID" id="x<?php echo $receipt_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ClientID->EditValue ?>"<?php echo $receipt_grid->ClientID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($receipt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $receipt_grid->RowCount ?>_receipt_ClientID">
<span<?php echo $receipt_grid->ClientID->viewAttributes() ?>><?php echo $receipt_grid->ClientID->getViewValue() ?></span>
</span>
<?php if (!$receipt->isConfirm()) { ?>
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="x<?php echo $receipt_grid->RowIndex ?>_ClientID" id="x<?php echo $receipt_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="o<?php echo $receipt_grid->RowIndex ?>_ClientID" id="o<?php echo $receipt_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_grid->ClientID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ClientID" id="freceiptgrid$x<?php echo $receipt_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ClientID" id="freceiptgrid$o<?php echo $receipt_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipt_grid->ListOptions->render("body", "right", $receipt_grid->RowCount);
?>
	</tr>
<?php if ($receipt->RowType == ROWTYPE_ADD || $receipt->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["freceiptgrid", "load"], function() {
	freceiptgrid.updateLists(<?php echo $receipt_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$receipt_grid->isGridAdd() || $receipt->CurrentMode == "copy")
		if (!$receipt_grid->Recordset->EOF)
			$receipt_grid->Recordset->moveNext();
}
?>
<?php
	if ($receipt->CurrentMode == "add" || $receipt->CurrentMode == "copy" || $receipt->CurrentMode == "edit") {
		$receipt_grid->RowIndex = '$rowindex$';
		$receipt_grid->loadRowValues();

		// Set row properties
		$receipt->resetAttributes();
		$receipt->RowAttrs->merge(["data-rowindex" => $receipt_grid->RowIndex, "id" => "r0_receipt", "data-rowtype" => ROWTYPE_ADD]);
		$receipt->RowAttrs->appendClass("ew-template");
		$receipt->RowType = ROWTYPE_ADD;

		// Render row
		$receipt_grid->renderRow();

		// Render list options
		$receipt_grid->renderListOptions();
		$receipt_grid->StartRowCount = 0;
?>
	<tr <?php echo $receipt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipt_grid->ListOptions->render("body", "left", $receipt_grid->RowIndex);
?>
	<?php if ($receipt_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo">
<?php if (!$receipt->isConfirm()) { ?>
<?php if ($receipt_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_ClientSerNo" class="form-group receipt_ClientSerNo">
<span<?php echo $receipt_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_ClientSerNo" class="form-group receipt_ClientSerNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo"><?php echo EmptyValue(strval($receipt_grid->ClientSerNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $receipt_grid->ClientSerNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_grid->ClientSerNo->ReadOnly || $receipt_grid->ClientSerNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $receipt_grid->ClientSerNo->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_ClientSerNo") ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo $receipt_grid->ClientSerNo->CurrentValue ?>"<?php echo $receipt_grid->ClientSerNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipt_ClientSerNo" class="form-group receipt_ClientSerNo">
<span<?php echo $receipt_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ClientSerNo" name="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $receipt_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($receipt_grid->ClientSerNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_ChargeCode" class="form-group receipt_ChargeCode">
<?php
$onchange = $receipt_grid->ChargeCode->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$receipt_grid->ChargeCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="sv_x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo RemoveHtml($receipt_grid->ChargeCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->ChargeCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($receipt_grid->ChargeCode->getPlaceHolder()) ?>"<?php echo $receipt_grid->ChargeCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($receipt_grid->ChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $receipt_grid->RowIndex ?>_ChargeCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($receipt_grid->ChargeCode->ReadOnly || $receipt_grid->ChargeCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $receipt_grid->ChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["freceiptgrid"], function() {
	freceiptgrid.createAutoSuggest({"id":"x<?php echo $receipt_grid->RowIndex ?>_ChargeCode","forceSelect":true});
});
</script>
<?php echo $receipt_grid->ChargeCode->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_ChargeCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_ChargeCode" class="form-group receipt_ChargeCode">
<span<?php echo $receipt_grid->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeCode" name="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" id="o<?php echo $receipt_grid->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($receipt_grid->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_ItemID" class="form-group receipt_ItemID">
<input type="text" data-table="receipt" data-field="x_ItemID" name="x<?php echo $receipt_grid->RowIndex ?>_ItemID" id="x<?php echo $receipt_grid->RowIndex ?>_ItemID" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($receipt_grid->ItemID->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ItemID->EditValue ?>"<?php echo $receipt_grid->ItemID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_ItemID" class="form-group receipt_ItemID">
<span<?php echo $receipt_grid->ItemID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ItemID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="x<?php echo $receipt_grid->RowIndex ?>_ItemID" id="x<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ItemID" name="o<?php echo $receipt_grid->RowIndex ?>_ItemID" id="o<?php echo $receipt_grid->RowIndex ?>_ItemID" value="<?php echo HtmlEncode($receipt_grid->ItemID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_UnitCost" class="form-group receipt_UnitCost">
<input type="text" data-table="receipt" data-field="x_UnitCost" name="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->UnitCost->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->UnitCost->EditValue ?>"<?php echo $receipt_grid->UnitCost->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_UnitCost" class="form-group receipt_UnitCost">
<span<?php echo $receipt_grid->UnitCost->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->UnitCost->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="x<?php echo $receipt_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_grid->UnitCost->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_UnitCost" name="o<?php echo $receipt_grid->RowIndex ?>_UnitCost" id="o<?php echo $receipt_grid->RowIndex ?>_UnitCost" value="<?php echo HtmlEncode($receipt_grid->UnitCost->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_Quantity" class="form-group receipt_Quantity">
<input type="text" data-table="receipt" data-field="x_Quantity" name="x<?php echo $receipt_grid->RowIndex ?>_Quantity" id="x<?php echo $receipt_grid->RowIndex ?>_Quantity" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->Quantity->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->Quantity->EditValue ?>"<?php echo $receipt_grid->Quantity->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_Quantity" class="form-group receipt_Quantity">
<span<?php echo $receipt_grid->Quantity->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->Quantity->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="x<?php echo $receipt_grid->RowIndex ?>_Quantity" id="x<?php echo $receipt_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_grid->Quantity->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_Quantity" name="o<?php echo $receipt_grid->RowIndex ?>_Quantity" id="o<?php echo $receipt_grid->RowIndex ?>_Quantity" value="<?php echo HtmlEncode($receipt_grid->Quantity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_UnitOfMeasure" class="form-group receipt_UnitOfMeasure">
<input type="text" data-table="receipt" data-field="x_UnitOfMeasure" name="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->UnitOfMeasure->EditValue ?>"<?php echo $receipt_grid->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_UnitOfMeasure" class="form-group receipt_UnitOfMeasure">
<span<?php echo $receipt_grid->UnitOfMeasure->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->UnitOfMeasure->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_UnitOfMeasure" name="o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $receipt_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($receipt_grid->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_AmountPaid" class="form-group receipt_AmountPaid">
<input type="text" data-table="receipt" data-field="x_AmountPaid" name="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->AmountPaid->EditValue ?>"<?php echo $receipt_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_AmountPaid" class="form-group receipt_AmountPaid">
<span<?php echo $receipt_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="x<?php echo $receipt_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_AmountPaid" name="o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" id="o<?php echo $receipt_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($receipt_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo">
<?php if (!$receipt->isConfirm()) { ?>
<?php if ($receipt_grid->ReceiptNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_ReceiptNo" class="form-group receipt_ReceiptNo">
<span<?php echo $receipt_grid->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_ReceiptNo" class="form-group receipt_ReceiptNo">
<input type="text" data-table="receipt" data-field="x_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($receipt_grid->ReceiptNo->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ReceiptNo->EditValue ?>"<?php echo $receipt_grid->ReceiptNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipt_ReceiptNo" class="form-group receipt_ReceiptNo">
<span<?php echo $receipt_grid->ReceiptNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ReceiptNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptNo" name="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" id="o<?php echo $receipt_grid->RowIndex ?>_ReceiptNo" value="<?php echo HtmlEncode($receipt_grid->ReceiptNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate">
<?php if (!$receipt->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_receipt_ReceiptDate" class="form-group receipt_ReceiptDate">
<span<?php echo $receipt_grid->ReceiptDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ReceiptDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="x<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" id="x<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_grid->ReceiptDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ReceiptDate" name="o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" id="o<?php echo $receipt_grid->RowIndex ?>_ReceiptDate" value="<?php echo HtmlEncode($receipt_grid->ReceiptDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod">
<?php if (!$receipt->isConfirm()) { ?>
<?php if ($receipt_grid->PaymentMethod->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_PaymentMethod" class="form-group receipt_PaymentMethod">
<span<?php echo $receipt_grid->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_PaymentMethod" class="form-group receipt_PaymentMethod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="receipt" data-field="x_PaymentMethod" data-value-separator="<?php echo $receipt_grid->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod"<?php echo $receipt_grid->PaymentMethod->editAttributes() ?>>
			<?php echo $receipt_grid->PaymentMethod->selectOptionListHtml("x{$receipt_grid->RowIndex}_PaymentMethod") ?>
		</select>
</div>
<?php echo $receipt_grid->PaymentMethod->Lookup->getParamTag($receipt_grid, "p_x" . $receipt_grid->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipt_PaymentMethod" class="form-group receipt_PaymentMethod">
<span<?php echo $receipt_grid->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentMethod" name="o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $receipt_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($receipt_grid->PaymentMethod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_PaymentRef" class="form-group receipt_PaymentRef">
<input type="text" data-table="receipt" data-field="x_PaymentRef" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($receipt_grid->PaymentRef->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->PaymentRef->EditValue ?>"<?php echo $receipt_grid->PaymentRef->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_PaymentRef" class="form-group receipt_PaymentRef">
<span<?php echo $receipt_grid->PaymentRef->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->PaymentRef->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="x<?php echo $receipt_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_grid->PaymentRef->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_PaymentRef" name="o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" id="o<?php echo $receipt_grid->RowIndex ?>_PaymentRef" value="<?php echo HtmlEncode($receipt_grid->PaymentRef->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo">
<?php if (!$receipt->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_receipt_CashierNo" class="form-group receipt_CashierNo">
<span<?php echo $receipt_grid->CashierNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->CashierNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="x<?php echo $receipt_grid->RowIndex ?>_CashierNo" id="x<?php echo $receipt_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_grid->CashierNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_CashierNo" name="o<?php echo $receipt_grid->RowIndex ?>_CashierNo" id="o<?php echo $receipt_grid->RowIndex ?>_CashierNo" value="<?php echo HtmlEncode($receipt_grid->CashierNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_BillPeriod" class="form-group receipt_BillPeriod">
<input type="text" data-table="receipt" data-field="x_BillPeriod" name="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->BillPeriod->EditValue ?>"<?php echo $receipt_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_BillPeriod" class="form-group receipt_BillPeriod">
<span<?php echo $receipt_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="x<?php echo $receipt_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_grid->BillPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_BillPeriod" name="o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" id="o<?php echo $receipt_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($receipt_grid->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_BillYear" class="form-group receipt_BillYear">
<input type="text" data-table="receipt" data-field="x_BillYear" name="x<?php echo $receipt_grid->RowIndex ?>_BillYear" id="x<?php echo $receipt_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($receipt_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->BillYear->EditValue ?>"<?php echo $receipt_grid->BillYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_BillYear" class="form-group receipt_BillYear">
<span<?php echo $receipt_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="x<?php echo $receipt_grid->RowIndex ?>_BillYear" id="x<?php echo $receipt_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_grid->BillYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_BillYear" name="o<?php echo $receipt_grid->RowIndex ?>_BillYear" id="o<?php echo $receipt_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($receipt_grid->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<?php if (!$receipt->isConfirm()) { ?>
<?php if ($receipt_grid->ChargeGroup->getSessionValue() != "") { ?>
<span id="el$rowindex$_receipt_ChargeGroup" class="form-group receipt_ChargeGroup">
<span<?php echo $receipt_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_receipt_ChargeGroup" class="form-group receipt_ChargeGroup">
<input type="text" data-table="receipt" data-field="x_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($receipt_grid->ChargeGroup->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ChargeGroup->EditValue ?>"<?php echo $receipt_grid->ChargeGroup->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_receipt_ChargeGroup" class="form-group receipt_ChargeGroup">
<span<?php echo $receipt_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ChargeGroup" name="o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $receipt_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($receipt_grid->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($receipt_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID">
<?php if (!$receipt->isConfirm()) { ?>
<span id="el$rowindex$_receipt_ClientID" class="form-group receipt_ClientID">
<input type="text" data-table="receipt" data-field="x_ClientID" name="x<?php echo $receipt_grid->RowIndex ?>_ClientID" id="x<?php echo $receipt_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($receipt_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $receipt_grid->ClientID->EditValue ?>"<?php echo $receipt_grid->ClientID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_receipt_ClientID" class="form-group receipt_ClientID">
<span<?php echo $receipt_grid->ClientID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($receipt_grid->ClientID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="x<?php echo $receipt_grid->RowIndex ?>_ClientID" id="x<?php echo $receipt_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_grid->ClientID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="receipt" data-field="x_ClientID" name="o<?php echo $receipt_grid->RowIndex ?>_ClientID" id="o<?php echo $receipt_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($receipt_grid->ClientID->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipt_grid->ListOptions->render("body", "right", $receipt_grid->RowIndex);
?>
<script>
loadjs.ready(["freceiptgrid", "load"], function() {
	freceiptgrid.updateLists(<?php echo $receipt_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$receipt->RowType = ROWTYPE_AGGREGATE;
$receipt->resetAttributes();
$receipt_grid->renderRow();
?>
<?php if ($receipt_grid->TotalRecords > 0 && $receipt->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$receipt_grid->renderListOptions();

// Render list options (footer, left)
$receipt_grid->ListOptions->render("footer", "left");
?>
	<?php if ($receipt_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" class="<?php echo $receipt_grid->ClientSerNo->footerCellClass() ?>"><span id="elf_receipt_ClientSerNo" class="receipt_ClientSerNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" class="<?php echo $receipt_grid->ChargeCode->footerCellClass() ?>"><span id="elf_receipt_ChargeCode" class="receipt_ChargeCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" class="<?php echo $receipt_grid->ItemID->footerCellClass() ?>"><span id="elf_receipt_ItemID" class="receipt_ItemID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" class="<?php echo $receipt_grid->UnitCost->footerCellClass() ?>"><span id="elf_receipt_UnitCost" class="receipt_UnitCost">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" class="<?php echo $receipt_grid->Quantity->footerCellClass() ?>"><span id="elf_receipt_Quantity" class="receipt_Quantity">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" class="<?php echo $receipt_grid->UnitOfMeasure->footerCellClass() ?>"><span id="elf_receipt_UnitOfMeasure" class="receipt_UnitOfMeasure">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $receipt_grid->AmountPaid->footerCellClass() ?>"><span id="elf_receipt_AmountPaid" class="receipt_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $receipt_grid->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" class="<?php echo $receipt_grid->ReceiptNo->footerCellClass() ?>"><span id="elf_receipt_ReceiptNo" class="receipt_ReceiptNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" class="<?php echo $receipt_grid->ReceiptDate->footerCellClass() ?>"><span id="elf_receipt_ReceiptDate" class="receipt_ReceiptDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" class="<?php echo $receipt_grid->PaymentMethod->footerCellClass() ?>"><span id="elf_receipt_PaymentMethod" class="receipt_PaymentMethod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" class="<?php echo $receipt_grid->PaymentRef->footerCellClass() ?>"><span id="elf_receipt_PaymentRef" class="receipt_PaymentRef">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" class="<?php echo $receipt_grid->CashierNo->footerCellClass() ?>"><span id="elf_receipt_CashierNo" class="receipt_CashierNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" class="<?php echo $receipt_grid->BillPeriod->footerCellClass() ?>"><span id="elf_receipt_BillPeriod" class="receipt_BillPeriod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" class="<?php echo $receipt_grid->BillYear->footerCellClass() ?>"><span id="elf_receipt_BillYear" class="receipt_BillYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" class="<?php echo $receipt_grid->ChargeGroup->footerCellClass() ?>"><span id="elf_receipt_ChargeGroup" class="receipt_ChargeGroup">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipt_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" class="<?php echo $receipt_grid->ClientID->footerCellClass() ?>"><span id="elf_receipt_ClientID" class="receipt_ClientID">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$receipt_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($receipt->CurrentMode == "add" || $receipt->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $receipt_grid->FormKeyCountName ?>" id="<?php echo $receipt_grid->FormKeyCountName ?>" value="<?php echo $receipt_grid->KeyCount ?>">
<?php echo $receipt_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($receipt->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $receipt_grid->FormKeyCountName ?>" id="<?php echo $receipt_grid->FormKeyCountName ?>" value="<?php echo $receipt_grid->KeyCount ?>">
<?php echo $receipt_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($receipt->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="freceiptgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($receipt_grid->Recordset)
	$receipt_grid->Recordset->Close();
?>
<?php if ($receipt_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $receipt_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($receipt_grid->TotalRecords == 0 && !$receipt->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $receipt_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$receipt_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php if (!$receipt->isExport()) { ?>
<script>
loadjs.ready("fixedheadertable", function() {
	ew.fixedHeaderTable({
		delay: 0,
		scrollbars: false,
		container: "gmp_receipt",
		width: "",
		height: ""
	});
});
</script>
<?php } ?>
<?php } ?>
<?php
$receipt_grid->terminate();
?>