<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($bill_board_account_grid))
	$bill_board_account_grid = new bill_board_account_grid();

// Run the page
$bill_board_account_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_account_grid->Page_Render();
?>
<?php if (!$bill_board_account_grid->isExport()) { ?>
<script>
var fbill_board_accountgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fbill_board_accountgrid = new ew.Form("fbill_board_accountgrid", "grid");
	fbill_board_accountgrid.formKeyCountName = '<?php echo $bill_board_account_grid->FormKeyCountName ?>';

	// Validate form
	fbill_board_accountgrid.validate = function() {
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
			<?php if ($bill_board_account_grid->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->AccountNo->caption(), $bill_board_account_grid->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_grid->BillBoardNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->BillBoardNo->caption(), $bill_board_account_grid->BillBoardNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->BillBoardNo->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->ClientID->caption(), $bill_board_account_grid->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_grid->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->BalanceBF->caption(), $bill_board_account_grid->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->BalanceBF->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->CurrentDemand->caption(), $bill_board_account_grid->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->CurrentDemand->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->VAT->caption(), $bill_board_account_grid->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->VAT->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->AmountPaid->caption(), $bill_board_account_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->BillPeriod->caption(), $bill_board_account_grid->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->BillPeriod->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->PeriodType->caption(), $bill_board_account_grid->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_grid->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->BillYear->caption(), $bill_board_account_grid->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->BillYear->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->StartDate->caption(), $bill_board_account_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->StartDate->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->EndDate->caption(), $bill_board_account_grid->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_grid->EndDate->errorMessage()) ?>");
			<?php if ($bill_board_account_grid->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_grid->LastUpdatedBy->caption(), $bill_board_account_grid->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fbill_board_accountgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "BillBoardNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientID", false)) return false;
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
		return true;
	}

	// Form_CustomValidate
	fbill_board_accountgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbill_board_accountgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbill_board_accountgrid.lists["x_PeriodType"] = <?php echo $bill_board_account_grid->PeriodType->Lookup->toClientList($bill_board_account_grid) ?>;
	fbill_board_accountgrid.lists["x_PeriodType"].options = <?php echo JsonEncode($bill_board_account_grid->PeriodType->lookupOptions()) ?>;
	loadjs.done("fbill_board_accountgrid");
});
</script>
<?php } ?>
<?php
$bill_board_account_grid->renderOtherOptions();
?>
<?php if ($bill_board_account_grid->TotalRecords > 0 || $bill_board_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bill_board_account_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bill_board_account">
<?php if ($bill_board_account_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $bill_board_account_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fbill_board_accountgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_bill_board_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_bill_board_accountgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bill_board_account->RowType = ROWTYPE_HEADER;

// Render list options
$bill_board_account_grid->renderListOptions();

// Render list options (header, left)
$bill_board_account_grid->ListOptions->render("header", "left");
?>
<?php if ($bill_board_account_grid->AccountNo->Visible) { // AccountNo ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->AccountNo) == "") { ?>
		<th data-name="AccountNo" class="<?php echo $bill_board_account_grid->AccountNo->headerCellClass() ?>"><div id="elh_bill_board_account_AccountNo" class="bill_board_account_AccountNo"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->AccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountNo" class="<?php echo $bill_board_account_grid->AccountNo->headerCellClass() ?>"><div><div id="elh_bill_board_account_AccountNo" class="bill_board_account_AccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->AccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->AccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->AccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->BillBoardNo->Visible) { // BillBoardNo ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->BillBoardNo) == "") { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_account_grid->BillBoardNo->headerCellClass() ?>"><div id="elh_bill_board_account_BillBoardNo" class="bill_board_account_BillBoardNo"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->BillBoardNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_account_grid->BillBoardNo->headerCellClass() ?>"><div><div id="elh_bill_board_account_BillBoardNo" class="bill_board_account_BillBoardNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->BillBoardNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->BillBoardNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->BillBoardNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->ClientID->Visible) { // ClientID ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_account_grid->ClientID->headerCellClass() ?>"><div id="elh_bill_board_account_ClientID" class="bill_board_account_ClientID"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_account_grid->ClientID->headerCellClass() ?>"><div><div id="elh_bill_board_account_ClientID" class="bill_board_account_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $bill_board_account_grid->BalanceBF->headerCellClass() ?>"><div id="elh_bill_board_account_BalanceBF" class="bill_board_account_BalanceBF"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $bill_board_account_grid->BalanceBF->headerCellClass() ?>"><div><div id="elh_bill_board_account_BalanceBF" class="bill_board_account_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $bill_board_account_grid->CurrentDemand->headerCellClass() ?>"><div id="elh_bill_board_account_CurrentDemand" class="bill_board_account_CurrentDemand"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $bill_board_account_grid->CurrentDemand->headerCellClass() ?>"><div><div id="elh_bill_board_account_CurrentDemand" class="bill_board_account_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->VAT->Visible) { // VAT ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $bill_board_account_grid->VAT->headerCellClass() ?>"><div id="elh_bill_board_account_VAT" class="bill_board_account_VAT"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $bill_board_account_grid->VAT->headerCellClass() ?>"><div><div id="elh_bill_board_account_VAT" class="bill_board_account_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $bill_board_account_grid->AmountPaid->headerCellClass() ?>"><div id="elh_bill_board_account_AmountPaid" class="bill_board_account_AmountPaid"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $bill_board_account_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_bill_board_account_AmountPaid" class="bill_board_account_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $bill_board_account_grid->BillPeriod->headerCellClass() ?>"><div id="elh_bill_board_account_BillPeriod" class="bill_board_account_BillPeriod"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $bill_board_account_grid->BillPeriod->headerCellClass() ?>"><div><div id="elh_bill_board_account_BillPeriod" class="bill_board_account_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->PeriodType->Visible) { // PeriodType ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $bill_board_account_grid->PeriodType->headerCellClass() ?>"><div id="elh_bill_board_account_PeriodType" class="bill_board_account_PeriodType"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $bill_board_account_grid->PeriodType->headerCellClass() ?>"><div><div id="elh_bill_board_account_PeriodType" class="bill_board_account_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->BillYear->Visible) { // BillYear ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $bill_board_account_grid->BillYear->headerCellClass() ?>"><div id="elh_bill_board_account_BillYear" class="bill_board_account_BillYear"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $bill_board_account_grid->BillYear->headerCellClass() ?>"><div><div id="elh_bill_board_account_BillYear" class="bill_board_account_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_account_grid->StartDate->headerCellClass() ?>"><div id="elh_bill_board_account_StartDate" class="bill_board_account_StartDate"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_account_grid->StartDate->headerCellClass() ?>"><div><div id="elh_bill_board_account_StartDate" class="bill_board_account_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->EndDate->Visible) { // EndDate ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_account_grid->EndDate->headerCellClass() ?>"><div id="elh_bill_board_account_EndDate" class="bill_board_account_EndDate"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_account_grid->EndDate->headerCellClass() ?>"><div><div id="elh_bill_board_account_EndDate" class="bill_board_account_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_account_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($bill_board_account_grid->SortUrl($bill_board_account_grid->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $bill_board_account_grid->LastUpdatedBy->headerCellClass() ?>"><div id="elh_bill_board_account_LastUpdatedBy" class="bill_board_account_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $bill_board_account_grid->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $bill_board_account_grid->LastUpdatedBy->headerCellClass() ?>"><div><div id="elh_bill_board_account_LastUpdatedBy" class="bill_board_account_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_account_grid->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_account_grid->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_account_grid->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bill_board_account_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$bill_board_account_grid->StartRecord = 1;
$bill_board_account_grid->StopRecord = $bill_board_account_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($bill_board_account->isConfirm() || $bill_board_account_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($bill_board_account_grid->FormKeyCountName) && ($bill_board_account_grid->isGridAdd() || $bill_board_account_grid->isGridEdit() || $bill_board_account->isConfirm())) {
		$bill_board_account_grid->KeyCount = $CurrentForm->getValue($bill_board_account_grid->FormKeyCountName);
		$bill_board_account_grid->StopRecord = $bill_board_account_grid->StartRecord + $bill_board_account_grid->KeyCount - 1;
	}
}
$bill_board_account_grid->RecordCount = $bill_board_account_grid->StartRecord - 1;
if ($bill_board_account_grid->Recordset && !$bill_board_account_grid->Recordset->EOF) {
	$bill_board_account_grid->Recordset->moveFirst();
	$selectLimit = $bill_board_account_grid->UseSelectLimit;
	if (!$selectLimit && $bill_board_account_grid->StartRecord > 1)
		$bill_board_account_grid->Recordset->move($bill_board_account_grid->StartRecord - 1);
} elseif (!$bill_board_account->AllowAddDeleteRow && $bill_board_account_grid->StopRecord == 0) {
	$bill_board_account_grid->StopRecord = $bill_board_account->GridAddRowCount;
}

// Initialize aggregate
$bill_board_account->RowType = ROWTYPE_AGGREGATEINIT;
$bill_board_account->resetAttributes();
$bill_board_account_grid->renderRow();
if ($bill_board_account_grid->isGridAdd())
	$bill_board_account_grid->RowIndex = 0;
if ($bill_board_account_grid->isGridEdit())
	$bill_board_account_grid->RowIndex = 0;
while ($bill_board_account_grid->RecordCount < $bill_board_account_grid->StopRecord) {
	$bill_board_account_grid->RecordCount++;
	if ($bill_board_account_grid->RecordCount >= $bill_board_account_grid->StartRecord) {
		$bill_board_account_grid->RowCount++;
		if ($bill_board_account_grid->isGridAdd() || $bill_board_account_grid->isGridEdit() || $bill_board_account->isConfirm()) {
			$bill_board_account_grid->RowIndex++;
			$CurrentForm->Index = $bill_board_account_grid->RowIndex;
			if ($CurrentForm->hasValue($bill_board_account_grid->FormActionName) && ($bill_board_account->isConfirm() || $bill_board_account_grid->EventCancelled))
				$bill_board_account_grid->RowAction = strval($CurrentForm->getValue($bill_board_account_grid->FormActionName));
			elseif ($bill_board_account_grid->isGridAdd())
				$bill_board_account_grid->RowAction = "insert";
			else
				$bill_board_account_grid->RowAction = "";
		}

		// Set up key count
		$bill_board_account_grid->KeyCount = $bill_board_account_grid->RowIndex;

		// Init row class and style
		$bill_board_account->resetAttributes();
		$bill_board_account->CssClass = "";
		if ($bill_board_account_grid->isGridAdd()) {
			if ($bill_board_account->CurrentMode == "copy") {
				$bill_board_account_grid->loadRowValues($bill_board_account_grid->Recordset); // Load row values
				$bill_board_account_grid->setRecordKey($bill_board_account_grid->RowOldKey, $bill_board_account_grid->Recordset); // Set old record key
			} else {
				$bill_board_account_grid->loadRowValues(); // Load default values
				$bill_board_account_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$bill_board_account_grid->loadRowValues($bill_board_account_grid->Recordset); // Load row values
		}
		$bill_board_account->RowType = ROWTYPE_VIEW; // Render view
		if ($bill_board_account_grid->isGridAdd()) // Grid add
			$bill_board_account->RowType = ROWTYPE_ADD; // Render add
		if ($bill_board_account_grid->isGridAdd() && $bill_board_account->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$bill_board_account_grid->restoreCurrentRowFormValues($bill_board_account_grid->RowIndex); // Restore form values
		if ($bill_board_account_grid->isGridEdit()) { // Grid edit
			if ($bill_board_account->EventCancelled)
				$bill_board_account_grid->restoreCurrentRowFormValues($bill_board_account_grid->RowIndex); // Restore form values
			if ($bill_board_account_grid->RowAction == "insert")
				$bill_board_account->RowType = ROWTYPE_ADD; // Render add
			else
				$bill_board_account->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($bill_board_account_grid->isGridEdit() && ($bill_board_account->RowType == ROWTYPE_EDIT || $bill_board_account->RowType == ROWTYPE_ADD) && $bill_board_account->EventCancelled) // Update failed
			$bill_board_account_grid->restoreCurrentRowFormValues($bill_board_account_grid->RowIndex); // Restore form values
		if ($bill_board_account->RowType == ROWTYPE_EDIT) // Edit row
			$bill_board_account_grid->EditRowCount++;
		if ($bill_board_account->isConfirm()) // Confirm row
			$bill_board_account_grid->restoreCurrentRowFormValues($bill_board_account_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$bill_board_account->RowAttrs->merge(["data-rowindex" => $bill_board_account_grid->RowCount, "id" => "r" . $bill_board_account_grid->RowCount . "_bill_board_account", "data-rowtype" => $bill_board_account->RowType]);

		// Render row
		$bill_board_account_grid->renderRow();

		// Render list options
		$bill_board_account_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($bill_board_account_grid->RowAction != "delete" && $bill_board_account_grid->RowAction != "insertdelete" && !($bill_board_account_grid->RowAction == "insert" && $bill_board_account->isConfirm() && $bill_board_account_grid->emptyRow())) {
?>
	<tr <?php echo $bill_board_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_account_grid->ListOptions->render("body", "left", $bill_board_account_grid->RowCount);
?>
	<?php if ($bill_board_account_grid->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo" <?php echo $bill_board_account_grid->AccountNo->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_AccountNo" class="form-group"></span>
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_AccountNo" class="form-group">
<span<?php echo $bill_board_account_grid->AccountNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->AccountNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->CurrentValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_AccountNo">
<span<?php echo $bill_board_account_grid->AccountNo->viewAttributes() ?>><?php echo $bill_board_account_grid->AccountNo->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BillBoardNo->Visible) { // BillBoardNo ?>
		<td data-name="BillBoardNo" <?php echo $bill_board_account_grid->BillBoardNo->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($bill_board_account_grid->BillBoardNo->getSessionValue() != "") { ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillBoardNo" class="form-group">
<span<?php echo $bill_board_account_grid->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->BillBoardNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillBoardNo" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillBoardNo->EditValue ?>"<?php echo $bill_board_account_grid->BillBoardNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillBoardNo" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($bill_board_account_grid->BillBoardNo->getSessionValue() != "") { ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillBoardNo" class="form-group">
<span<?php echo $bill_board_account_grid->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->BillBoardNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillBoardNo" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillBoardNo->EditValue ?>"<?php echo $bill_board_account_grid->BillBoardNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_grid->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_account_grid->BillBoardNo->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BillBoardNo" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillBoardNo" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BillBoardNo" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $bill_board_account_grid->ClientID->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_ClientID" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_ClientID" name="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_account_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->ClientID->EditValue ?>"<?php echo $bill_board_account_grid->ClientID->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_ClientID" name="o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_account_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_ClientID" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_ClientID" name="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_account_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->ClientID->EditValue ?>"<?php echo $bill_board_account_grid->ClientID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_ClientID">
<span<?php echo $bill_board_account_grid->ClientID->viewAttributes() ?>><?php echo $bill_board_account_grid->ClientID->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_ClientID" name="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_account_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_ClientID" name="o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_account_grid->ClientID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_ClientID" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_account_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_ClientID" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_account_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $bill_board_account_grid->BalanceBF->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BalanceBF" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BalanceBF" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BalanceBF->EditValue ?>"<?php echo $bill_board_account_grid->BalanceBF->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_BalanceBF" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BalanceBF" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BalanceBF" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BalanceBF->EditValue ?>"<?php echo $bill_board_account_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BalanceBF">
<span<?php echo $bill_board_account_grid->BalanceBF->viewAttributes() ?>><?php echo $bill_board_account_grid->BalanceBF->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BalanceBF" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BalanceBF" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BalanceBF" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BalanceBF" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $bill_board_account_grid->CurrentDemand->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_CurrentDemand" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_CurrentDemand" name="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->CurrentDemand->EditValue ?>"<?php echo $bill_board_account_grid->CurrentDemand->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_CurrentDemand" name="o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_CurrentDemand" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_CurrentDemand" name="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->CurrentDemand->EditValue ?>"<?php echo $bill_board_account_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_CurrentDemand">
<span<?php echo $bill_board_account_grid->CurrentDemand->viewAttributes() ?>><?php echo $bill_board_account_grid->CurrentDemand->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_CurrentDemand" name="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_CurrentDemand" name="o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_CurrentDemand" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_CurrentDemand" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $bill_board_account_grid->VAT->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_VAT" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_VAT" name="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->VAT->EditValue ?>"<?php echo $bill_board_account_grid->VAT->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_VAT" name="o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($bill_board_account_grid->VAT->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_VAT" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_VAT" name="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->VAT->EditValue ?>"<?php echo $bill_board_account_grid->VAT->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_VAT">
<span<?php echo $bill_board_account_grid->VAT->viewAttributes() ?>><?php echo $bill_board_account_grid->VAT->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_VAT" name="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($bill_board_account_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_VAT" name="o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($bill_board_account_grid->VAT->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_VAT" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($bill_board_account_grid->VAT->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_VAT" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($bill_board_account_grid->VAT->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $bill_board_account_grid->AmountPaid->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_AmountPaid" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_AmountPaid" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->AmountPaid->EditValue ?>"<?php echo $bill_board_account_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_AmountPaid" name="o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_AmountPaid" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_AmountPaid" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->AmountPaid->EditValue ?>"<?php echo $bill_board_account_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_AmountPaid">
<span<?php echo $bill_board_account_grid->AmountPaid->viewAttributes() ?>><?php echo $bill_board_account_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_AmountPaid" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_AmountPaid" name="o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_AmountPaid" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_AmountPaid" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $bill_board_account_grid->BillPeriod->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillPeriod" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BillPeriod" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillPeriod->EditValue ?>"<?php echo $bill_board_account_grid->BillPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_BillPeriod" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillPeriod" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BillPeriod" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillPeriod->EditValue ?>"<?php echo $bill_board_account_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillPeriod">
<span<?php echo $bill_board_account_grid->BillPeriod->viewAttributes() ?>><?php echo $bill_board_account_grid->BillPeriod->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillPeriod" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BillPeriod" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillPeriod" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BillPeriod" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $bill_board_account_grid->PeriodType->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_PeriodType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board_account" data-field="x_PeriodType" data-value-separator="<?php echo $bill_board_account_grid->PeriodType->displayValueSeparatorAttribute() ?>" id="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" name="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType"<?php echo $bill_board_account_grid->PeriodType->editAttributes() ?>>
			<?php echo $bill_board_account_grid->PeriodType->selectOptionListHtml("x{$bill_board_account_grid->RowIndex}_PeriodType") ?>
		</select>
</div>
<?php echo $bill_board_account_grid->PeriodType->Lookup->getParamTag($bill_board_account_grid, "p_x" . $bill_board_account_grid->RowIndex . "_PeriodType") ?>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_PeriodType" name="o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" id="o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($bill_board_account_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_PeriodType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board_account" data-field="x_PeriodType" data-value-separator="<?php echo $bill_board_account_grid->PeriodType->displayValueSeparatorAttribute() ?>" id="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" name="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType"<?php echo $bill_board_account_grid->PeriodType->editAttributes() ?>>
			<?php echo $bill_board_account_grid->PeriodType->selectOptionListHtml("x{$bill_board_account_grid->RowIndex}_PeriodType") ?>
		</select>
</div>
<?php echo $bill_board_account_grid->PeriodType->Lookup->getParamTag($bill_board_account_grid, "p_x" . $bill_board_account_grid->RowIndex . "_PeriodType") ?>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_PeriodType">
<span<?php echo $bill_board_account_grid->PeriodType->viewAttributes() ?>><?php echo $bill_board_account_grid->PeriodType->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_PeriodType" name="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" id="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($bill_board_account_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_PeriodType" name="o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" id="o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($bill_board_account_grid->PeriodType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_PeriodType" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($bill_board_account_grid->PeriodType->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_PeriodType" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($bill_board_account_grid->PeriodType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $bill_board_account_grid->BillYear->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillYear" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BillYear" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillYear->EditValue ?>"<?php echo $bill_board_account_grid->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_BillYear" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($bill_board_account_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillYear" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_BillYear" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillYear->EditValue ?>"<?php echo $bill_board_account_grid->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_BillYear">
<span<?php echo $bill_board_account_grid->BillYear->viewAttributes() ?>><?php echo $bill_board_account_grid->BillYear->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillYear" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($bill_board_account_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BillYear" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($bill_board_account_grid->BillYear->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillYear" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($bill_board_account_grid->BillYear->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_BillYear" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($bill_board_account_grid->BillYear->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $bill_board_account_grid->StartDate->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_StartDate" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_StartDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($bill_board_account_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->StartDate->EditValue ?>"<?php echo $bill_board_account_grid->StartDate->editAttributes() ?>>
<?php if (!$bill_board_account_grid->StartDate->ReadOnly && !$bill_board_account_grid->StartDate->Disabled && !isset($bill_board_account_grid->StartDate->EditAttrs["readonly"]) && !isset($bill_board_account_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountgrid", "x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_StartDate" name="o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_account_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_StartDate" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_StartDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($bill_board_account_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->StartDate->EditValue ?>"<?php echo $bill_board_account_grid->StartDate->editAttributes() ?>>
<?php if (!$bill_board_account_grid->StartDate->ReadOnly && !$bill_board_account_grid->StartDate->Disabled && !isset($bill_board_account_grid->StartDate->EditAttrs["readonly"]) && !isset($bill_board_account_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountgrid", "x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_StartDate">
<span<?php echo $bill_board_account_grid->StartDate->viewAttributes() ?>><?php echo $bill_board_account_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_StartDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_account_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_StartDate" name="o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_account_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_StartDate" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_account_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_StartDate" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_account_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $bill_board_account_grid->EndDate->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_EndDate" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_EndDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($bill_board_account_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->EndDate->EditValue ?>"<?php echo $bill_board_account_grid->EndDate->editAttributes() ?>>
<?php if (!$bill_board_account_grid->EndDate->ReadOnly && !$bill_board_account_grid->EndDate->Disabled && !isset($bill_board_account_grid->EndDate->EditAttrs["readonly"]) && !isset($bill_board_account_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountgrid", "x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_EndDate" name="o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_account_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_EndDate" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_EndDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($bill_board_account_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->EndDate->EditValue ?>"<?php echo $bill_board_account_grid->EndDate->editAttributes() ?>>
<?php if (!$bill_board_account_grid->EndDate->ReadOnly && !$bill_board_account_grid->EndDate->Disabled && !isset($bill_board_account_grid->EndDate->EditAttrs["readonly"]) && !isset($bill_board_account_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountgrid", "x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_EndDate">
<span<?php echo $bill_board_account_grid->EndDate->viewAttributes() ?>><?php echo $bill_board_account_grid->EndDate->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_EndDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_account_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_EndDate" name="o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_account_grid->EndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_EndDate" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_account_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_EndDate" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_account_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $bill_board_account_grid->LastUpdatedBy->cellAttributes() ?>>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_LastUpdatedBy" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->LastUpdatedBy->EditValue ?>"<?php echo $bill_board_account_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_LastUpdatedBy" class="form-group">
<input type="text" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->LastUpdatedBy->EditValue ?>"<?php echo $bill_board_account_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_account_grid->RowCount ?>_bill_board_account_LastUpdatedBy">
<span<?php echo $bill_board_account_grid->LastUpdatedBy->viewAttributes() ?>><?php echo $bill_board_account_grid->LastUpdatedBy->getViewValue() ?></span>
</span>
<?php if (!$bill_board_account->isConfirm()) { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="fbill_board_accountgrid$x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="fbill_board_accountgrid$o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bill_board_account_grid->ListOptions->render("body", "right", $bill_board_account_grid->RowCount);
?>
	</tr>
<?php if ($bill_board_account->RowType == ROWTYPE_ADD || $bill_board_account->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbill_board_accountgrid", "load"], function() {
	fbill_board_accountgrid.updateLists(<?php echo $bill_board_account_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$bill_board_account_grid->isGridAdd() || $bill_board_account->CurrentMode == "copy")
		if (!$bill_board_account_grid->Recordset->EOF)
			$bill_board_account_grid->Recordset->moveNext();
}
?>
<?php
	if ($bill_board_account->CurrentMode == "add" || $bill_board_account->CurrentMode == "copy" || $bill_board_account->CurrentMode == "edit") {
		$bill_board_account_grid->RowIndex = '$rowindex$';
		$bill_board_account_grid->loadRowValues();

		// Set row properties
		$bill_board_account->resetAttributes();
		$bill_board_account->RowAttrs->merge(["data-rowindex" => $bill_board_account_grid->RowIndex, "id" => "r0_bill_board_account", "data-rowtype" => ROWTYPE_ADD]);
		$bill_board_account->RowAttrs->appendClass("ew-template");
		$bill_board_account->RowType = ROWTYPE_ADD;

		// Render row
		$bill_board_account_grid->renderRow();

		// Render list options
		$bill_board_account_grid->renderListOptions();
		$bill_board_account_grid->StartRowCount = 0;
?>
	<tr <?php echo $bill_board_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_account_grid->ListOptions->render("body", "left", $bill_board_account_grid->RowIndex);
?>
	<?php if ($bill_board_account_grid->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_AccountNo" class="form-group bill_board_account_AccountNo"></span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_AccountNo" class="form-group bill_board_account_AccountNo">
<span<?php echo $bill_board_account_grid->AccountNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->AccountNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" id="o<?php echo $bill_board_account_grid->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($bill_board_account_grid->AccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BillBoardNo->Visible) { // BillBoardNo ?>
		<td data-name="BillBoardNo">
<?php if (!$bill_board_account->isConfirm()) { ?>
<?php if ($bill_board_account_grid->BillBoardNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_bill_board_account_BillBoardNo" class="form-group bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_grid->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->BillBoardNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_BillBoardNo" class="form-group bill_board_account_BillBoardNo">
<input type="text" data-table="bill_board_account" data-field="x_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillBoardNo->EditValue ?>"<?php echo $bill_board_account_grid->BillBoardNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_BillBoardNo" class="form-group bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_grid->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->BillBoardNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_BillBoardNo" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillBoardNo" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_grid->BillBoardNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_ClientID" class="form-group bill_board_account_ClientID">
<input type="text" data-table="bill_board_account" data-field="x_ClientID" name="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_account_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->ClientID->EditValue ?>"<?php echo $bill_board_account_grid->ClientID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_ClientID" class="form-group bill_board_account_ClientID">
<span<?php echo $bill_board_account_grid->ClientID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->ClientID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_ClientID" name="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_account_grid->ClientID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_ClientID" name="o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" id="o<?php echo $bill_board_account_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_account_grid->ClientID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_BalanceBF" class="form-group bill_board_account_BalanceBF">
<input type="text" data-table="bill_board_account" data-field="x_BalanceBF" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BalanceBF->EditValue ?>"<?php echo $bill_board_account_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_BalanceBF" class="form-group bill_board_account_BalanceBF">
<span<?php echo $bill_board_account_grid->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->BalanceBF->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_BalanceBF" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BalanceBF" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($bill_board_account_grid->BalanceBF->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_CurrentDemand" class="form-group bill_board_account_CurrentDemand">
<input type="text" data-table="bill_board_account" data-field="x_CurrentDemand" name="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->CurrentDemand->EditValue ?>"<?php echo $bill_board_account_grid->CurrentDemand->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_CurrentDemand" class="form-group bill_board_account_CurrentDemand">
<span<?php echo $bill_board_account_grid->CurrentDemand->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->CurrentDemand->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_CurrentDemand" name="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="x<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_CurrentDemand" name="o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" id="o<?php echo $bill_board_account_grid->RowIndex ?>_CurrentDemand" value="<?php echo HtmlEncode($bill_board_account_grid->CurrentDemand->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->VAT->Visible) { // VAT ?>
		<td data-name="VAT">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_VAT" class="form-group bill_board_account_VAT">
<input type="text" data-table="bill_board_account" data-field="x_VAT" name="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->VAT->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->VAT->EditValue ?>"<?php echo $bill_board_account_grid->VAT->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_VAT" class="form-group bill_board_account_VAT">
<span<?php echo $bill_board_account_grid->VAT->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->VAT->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_VAT" name="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="x<?php echo $bill_board_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($bill_board_account_grid->VAT->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_VAT" name="o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" id="o<?php echo $bill_board_account_grid->RowIndex ?>_VAT" value="<?php echo HtmlEncode($bill_board_account_grid->VAT->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_AmountPaid" class="form-group bill_board_account_AmountPaid">
<input type="text" data-table="bill_board_account" data-field="x_AmountPaid" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->AmountPaid->EditValue ?>"<?php echo $bill_board_account_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_AmountPaid" class="form-group bill_board_account_AmountPaid">
<span<?php echo $bill_board_account_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_AmountPaid" name="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="x<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_AmountPaid" name="o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" id="o<?php echo $bill_board_account_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($bill_board_account_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_BillPeriod" class="form-group bill_board_account_BillPeriod">
<input type="text" data-table="bill_board_account" data-field="x_BillPeriod" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillPeriod->EditValue ?>"<?php echo $bill_board_account_grid->BillPeriod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_BillPeriod" class="form-group bill_board_account_BillPeriod">
<span<?php echo $bill_board_account_grid->BillPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->BillPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_BillPeriod" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillPeriod" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillPeriod" value="<?php echo HtmlEncode($bill_board_account_grid->BillPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_PeriodType" class="form-group bill_board_account_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board_account" data-field="x_PeriodType" data-value-separator="<?php echo $bill_board_account_grid->PeriodType->displayValueSeparatorAttribute() ?>" id="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" name="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType"<?php echo $bill_board_account_grid->PeriodType->editAttributes() ?>>
			<?php echo $bill_board_account_grid->PeriodType->selectOptionListHtml("x{$bill_board_account_grid->RowIndex}_PeriodType") ?>
		</select>
</div>
<?php echo $bill_board_account_grid->PeriodType->Lookup->getParamTag($bill_board_account_grid, "p_x" . $bill_board_account_grid->RowIndex . "_PeriodType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_PeriodType" class="form-group bill_board_account_PeriodType">
<span<?php echo $bill_board_account_grid->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_PeriodType" name="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" id="x<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($bill_board_account_grid->PeriodType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_PeriodType" name="o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" id="o<?php echo $bill_board_account_grid->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($bill_board_account_grid->PeriodType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_BillYear" class="form-group bill_board_account_BillYear">
<input type="text" data-table="bill_board_account" data-field="x_BillYear" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_grid->BillYear->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->BillYear->EditValue ?>"<?php echo $bill_board_account_grid->BillYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_BillYear" class="form-group bill_board_account_BillYear">
<span<?php echo $bill_board_account_grid->BillYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->BillYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_BillYear" name="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="x<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($bill_board_account_grid->BillYear->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_BillYear" name="o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" id="o<?php echo $bill_board_account_grid->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($bill_board_account_grid->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_StartDate" class="form-group bill_board_account_StartDate">
<input type="text" data-table="bill_board_account" data-field="x_StartDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($bill_board_account_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->StartDate->EditValue ?>"<?php echo $bill_board_account_grid->StartDate->editAttributes() ?>>
<?php if (!$bill_board_account_grid->StartDate->ReadOnly && !$bill_board_account_grid->StartDate->Disabled && !isset($bill_board_account_grid->StartDate->EditAttrs["readonly"]) && !isset($bill_board_account_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountgrid", "x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_StartDate" class="form-group bill_board_account_StartDate">
<span<?php echo $bill_board_account_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_StartDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_account_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_StartDate" name="o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" id="o<?php echo $bill_board_account_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_account_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_EndDate" class="form-group bill_board_account_EndDate">
<input type="text" data-table="bill_board_account" data-field="x_EndDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($bill_board_account_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->EndDate->EditValue ?>"<?php echo $bill_board_account_grid->EndDate->editAttributes() ?>>
<?php if (!$bill_board_account_grid->EndDate->ReadOnly && !$bill_board_account_grid->EndDate->Disabled && !isset($bill_board_account_grid->EndDate->EditAttrs["readonly"]) && !isset($bill_board_account_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountgrid", "x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_EndDate" class="form-group bill_board_account_EndDate">
<span<?php echo $bill_board_account_grid->EndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->EndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_EndDate" name="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_account_grid->EndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_EndDate" name="o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" id="o<?php echo $bill_board_account_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_account_grid->EndDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_account_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy">
<?php if (!$bill_board_account->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_account_LastUpdatedBy" class="form-group bill_board_account_LastUpdatedBy">
<input type="text" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_grid->LastUpdatedBy->EditValue ?>"<?php echo $bill_board_account_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_account_LastUpdatedBy" class="form-group bill_board_account_LastUpdatedBy">
<span<?php echo $bill_board_account_grid->LastUpdatedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_grid->LastUpdatedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $bill_board_account_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($bill_board_account_grid->LastUpdatedBy->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bill_board_account_grid->ListOptions->render("body", "right", $bill_board_account_grid->RowIndex);
?>
<script>
loadjs.ready(["fbill_board_accountgrid", "load"], function() {
	fbill_board_accountgrid.updateLists(<?php echo $bill_board_account_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($bill_board_account->CurrentMode == "add" || $bill_board_account->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $bill_board_account_grid->FormKeyCountName ?>" id="<?php echo $bill_board_account_grid->FormKeyCountName ?>" value="<?php echo $bill_board_account_grid->KeyCount ?>">
<?php echo $bill_board_account_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bill_board_account->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $bill_board_account_grid->FormKeyCountName ?>" id="<?php echo $bill_board_account_grid->FormKeyCountName ?>" value="<?php echo $bill_board_account_grid->KeyCount ?>">
<?php echo $bill_board_account_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bill_board_account->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fbill_board_accountgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bill_board_account_grid->Recordset)
	$bill_board_account_grid->Recordset->Close();
?>
<?php if ($bill_board_account_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $bill_board_account_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bill_board_account_grid->TotalRecords == 0 && !$bill_board_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bill_board_account_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$bill_board_account_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$bill_board_account_grid->terminate();
?>