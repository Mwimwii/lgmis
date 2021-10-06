<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($bill_board_grid))
	$bill_board_grid = new bill_board_grid();

// Run the page
$bill_board_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_grid->Page_Render();
?>
<?php if (!$bill_board_grid->isExport()) { ?>
<script>
var fbill_boardgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fbill_boardgrid = new ew.Form("fbill_boardgrid", "grid");
	fbill_boardgrid.formKeyCountName = '<?php echo $bill_board_grid->FormKeyCountName ?>';

	// Validate form
	fbill_boardgrid.validate = function() {
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
			<?php if ($bill_board_grid->BillBoardNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BillBoardNo->caption(), $bill_board_grid->BillBoardNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_grid->BoardStandNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardStandNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BoardStandNo->caption(), $bill_board_grid->BoardStandNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_grid->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->ClientSerNo->caption(), $bill_board_grid->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->ClientSerNo->errorMessage()) ?>");
			<?php if ($bill_board_grid->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->ClientID->caption(), $bill_board_grid->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_grid->BoardLength->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BoardLength->caption(), $bill_board_grid->BoardLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardLength");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->BoardLength->errorMessage()) ?>");
			<?php if ($bill_board_grid->BoardWidth->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardWidth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BoardWidth->caption(), $bill_board_grid->BoardWidth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardWidth");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->BoardWidth->errorMessage()) ?>");
			<?php if ($bill_board_grid->BoardSize->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardSize");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BoardSize->caption(), $bill_board_grid->BoardSize->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardSize");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->BoardSize->errorMessage()) ?>");
			<?php if ($bill_board_grid->BoardType->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BoardType->caption(), $bill_board_grid->BoardType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_grid->BoardLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BoardLocation->caption(), $bill_board_grid->BoardLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_grid->BoardStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->BoardStatus->caption(), $bill_board_grid->BoardStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->BoardStatus->errorMessage()) ?>");
			<?php if ($bill_board_grid->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->ExemptCode->caption(), $bill_board_grid->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->ExemptCode->errorMessage()) ?>");
			<?php if ($bill_board_grid->StreetAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_StreetAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->StreetAddress->caption(), $bill_board_grid->StreetAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_grid->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->Longitude->caption(), $bill_board_grid->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->Longitude->errorMessage()) ?>");
			<?php if ($bill_board_grid->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->Latitude->caption(), $bill_board_grid->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->Latitude->errorMessage()) ?>");
			<?php if ($bill_board_grid->Incumberance->Required) { ?>
				elm = this.getElements("x" + infix + "_Incumberance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->Incumberance->caption(), $bill_board_grid->Incumberance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_grid->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->StartDate->caption(), $bill_board_grid->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->StartDate->errorMessage()) ?>");
			<?php if ($bill_board_grid->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_grid->EndDate->caption(), $bill_board_grid->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_grid->EndDate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fbill_boardgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "BoardStandNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientSerNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientID", false)) return false;
		if (ew.valueChanged(fobj, infix, "BoardLength", false)) return false;
		if (ew.valueChanged(fobj, infix, "BoardWidth", false)) return false;
		if (ew.valueChanged(fobj, infix, "BoardSize", false)) return false;
		if (ew.valueChanged(fobj, infix, "BoardType", false)) return false;
		if (ew.valueChanged(fobj, infix, "BoardLocation", false)) return false;
		if (ew.valueChanged(fobj, infix, "BoardStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExemptCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "StreetAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "Longitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "Latitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "Incumberance", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "EndDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fbill_boardgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbill_boardgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbill_boardgrid.lists["x_ClientSerNo"] = <?php echo $bill_board_grid->ClientSerNo->Lookup->toClientList($bill_board_grid) ?>;
	fbill_boardgrid.lists["x_ClientSerNo"].options = <?php echo JsonEncode($bill_board_grid->ClientSerNo->lookupOptions()) ?>;
	fbill_boardgrid.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbill_boardgrid.lists["x_BoardType"] = <?php echo $bill_board_grid->BoardType->Lookup->toClientList($bill_board_grid) ?>;
	fbill_boardgrid.lists["x_BoardType"].options = <?php echo JsonEncode($bill_board_grid->BoardType->lookupOptions()) ?>;
	loadjs.done("fbill_boardgrid");
});
</script>
<?php } ?>
<?php
$bill_board_grid->renderOtherOptions();
?>
<?php if ($bill_board_grid->TotalRecords > 0 || $bill_board->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bill_board_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bill_board">
<?php if ($bill_board_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $bill_board_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fbill_boardgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_bill_board" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_bill_boardgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bill_board->RowType = ROWTYPE_HEADER;

// Render list options
$bill_board_grid->renderListOptions();

// Render list options (header, left)
$bill_board_grid->ListOptions->render("header", "left");
?>
<?php if ($bill_board_grid->BillBoardNo->Visible) { // BillBoardNo ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BillBoardNo) == "") { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_grid->BillBoardNo->headerCellClass() ?>"><div id="elh_bill_board_BillBoardNo" class="bill_board_BillBoardNo"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BillBoardNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_grid->BillBoardNo->headerCellClass() ?>"><div><div id="elh_bill_board_BillBoardNo" class="bill_board_BillBoardNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BillBoardNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BillBoardNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BillBoardNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->BoardStandNo->Visible) { // BoardStandNo ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BoardStandNo) == "") { ?>
		<th data-name="BoardStandNo" class="<?php echo $bill_board_grid->BoardStandNo->headerCellClass() ?>"><div id="elh_bill_board_BoardStandNo" class="bill_board_BoardStandNo"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BoardStandNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardStandNo" class="<?php echo $bill_board_grid->BoardStandNo->headerCellClass() ?>"><div><div id="elh_bill_board_BoardStandNo" class="bill_board_BoardStandNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BoardStandNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BoardStandNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BoardStandNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $bill_board_grid->ClientSerNo->headerCellClass() ?>"><div id="elh_bill_board_ClientSerNo" class="bill_board_ClientSerNo"><div class="ew-table-header-caption"><?php echo $bill_board_grid->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $bill_board_grid->ClientSerNo->headerCellClass() ?>"><div><div id="elh_bill_board_ClientSerNo" class="bill_board_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->ClientID->Visible) { // ClientID ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_grid->ClientID->headerCellClass() ?>"><div id="elh_bill_board_ClientID" class="bill_board_ClientID"><div class="ew-table-header-caption"><?php echo $bill_board_grid->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_grid->ClientID->headerCellClass() ?>"><div><div id="elh_bill_board_ClientID" class="bill_board_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->BoardLength->Visible) { // BoardLength ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BoardLength) == "") { ?>
		<th data-name="BoardLength" class="<?php echo $bill_board_grid->BoardLength->headerCellClass() ?>"><div id="elh_bill_board_BoardLength" class="bill_board_BoardLength"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BoardLength->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardLength" class="<?php echo $bill_board_grid->BoardLength->headerCellClass() ?>"><div><div id="elh_bill_board_BoardLength" class="bill_board_BoardLength">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BoardLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BoardLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BoardLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->BoardWidth->Visible) { // BoardWidth ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BoardWidth) == "") { ?>
		<th data-name="BoardWidth" class="<?php echo $bill_board_grid->BoardWidth->headerCellClass() ?>"><div id="elh_bill_board_BoardWidth" class="bill_board_BoardWidth"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BoardWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardWidth" class="<?php echo $bill_board_grid->BoardWidth->headerCellClass() ?>"><div><div id="elh_bill_board_BoardWidth" class="bill_board_BoardWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BoardWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BoardWidth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BoardWidth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->BoardSize->Visible) { // BoardSize ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BoardSize) == "") { ?>
		<th data-name="BoardSize" class="<?php echo $bill_board_grid->BoardSize->headerCellClass() ?>"><div id="elh_bill_board_BoardSize" class="bill_board_BoardSize"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BoardSize->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardSize" class="<?php echo $bill_board_grid->BoardSize->headerCellClass() ?>"><div><div id="elh_bill_board_BoardSize" class="bill_board_BoardSize">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BoardSize->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BoardSize->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BoardSize->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->BoardType->Visible) { // BoardType ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BoardType) == "") { ?>
		<th data-name="BoardType" class="<?php echo $bill_board_grid->BoardType->headerCellClass() ?>"><div id="elh_bill_board_BoardType" class="bill_board_BoardType"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BoardType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardType" class="<?php echo $bill_board_grid->BoardType->headerCellClass() ?>"><div><div id="elh_bill_board_BoardType" class="bill_board_BoardType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BoardType->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BoardType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BoardType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->BoardLocation->Visible) { // BoardLocation ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BoardLocation) == "") { ?>
		<th data-name="BoardLocation" class="<?php echo $bill_board_grid->BoardLocation->headerCellClass() ?>"><div id="elh_bill_board_BoardLocation" class="bill_board_BoardLocation"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BoardLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardLocation" class="<?php echo $bill_board_grid->BoardLocation->headerCellClass() ?>"><div><div id="elh_bill_board_BoardLocation" class="bill_board_BoardLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BoardLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BoardLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BoardLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->BoardStatus->Visible) { // BoardStatus ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->BoardStatus) == "") { ?>
		<th data-name="BoardStatus" class="<?php echo $bill_board_grid->BoardStatus->headerCellClass() ?>"><div id="elh_bill_board_BoardStatus" class="bill_board_BoardStatus"><div class="ew-table-header-caption"><?php echo $bill_board_grid->BoardStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardStatus" class="<?php echo $bill_board_grid->BoardStatus->headerCellClass() ?>"><div><div id="elh_bill_board_BoardStatus" class="bill_board_BoardStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->BoardStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->BoardStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->BoardStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->ExemptCode) == "") { ?>
		<th data-name="ExemptCode" class="<?php echo $bill_board_grid->ExemptCode->headerCellClass() ?>"><div id="elh_bill_board_ExemptCode" class="bill_board_ExemptCode"><div class="ew-table-header-caption"><?php echo $bill_board_grid->ExemptCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExemptCode" class="<?php echo $bill_board_grid->ExemptCode->headerCellClass() ?>"><div><div id="elh_bill_board_ExemptCode" class="bill_board_ExemptCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->ExemptCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->ExemptCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->ExemptCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->StreetAddress->Visible) { // StreetAddress ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->StreetAddress) == "") { ?>
		<th data-name="StreetAddress" class="<?php echo $bill_board_grid->StreetAddress->headerCellClass() ?>"><div id="elh_bill_board_StreetAddress" class="bill_board_StreetAddress"><div class="ew-table-header-caption"><?php echo $bill_board_grid->StreetAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StreetAddress" class="<?php echo $bill_board_grid->StreetAddress->headerCellClass() ?>"><div><div id="elh_bill_board_StreetAddress" class="bill_board_StreetAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->StreetAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->StreetAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->StreetAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->Longitude->Visible) { // Longitude ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $bill_board_grid->Longitude->headerCellClass() ?>"><div id="elh_bill_board_Longitude" class="bill_board_Longitude"><div class="ew-table-header-caption"><?php echo $bill_board_grid->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $bill_board_grid->Longitude->headerCellClass() ?>"><div><div id="elh_bill_board_Longitude" class="bill_board_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->Latitude->Visible) { // Latitude ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $bill_board_grid->Latitude->headerCellClass() ?>"><div id="elh_bill_board_Latitude" class="bill_board_Latitude"><div class="ew-table-header-caption"><?php echo $bill_board_grid->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $bill_board_grid->Latitude->headerCellClass() ?>"><div><div id="elh_bill_board_Latitude" class="bill_board_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->Incumberance->Visible) { // Incumberance ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->Incumberance) == "") { ?>
		<th data-name="Incumberance" class="<?php echo $bill_board_grid->Incumberance->headerCellClass() ?>"><div id="elh_bill_board_Incumberance" class="bill_board_Incumberance"><div class="ew-table-header-caption"><?php echo $bill_board_grid->Incumberance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Incumberance" class="<?php echo $bill_board_grid->Incumberance->headerCellClass() ?>"><div><div id="elh_bill_board_Incumberance" class="bill_board_Incumberance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->Incumberance->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->Incumberance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->Incumberance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->StartDate->Visible) { // StartDate ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_grid->StartDate->headerCellClass() ?>"><div id="elh_bill_board_StartDate" class="bill_board_StartDate"><div class="ew-table-header-caption"><?php echo $bill_board_grid->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_grid->StartDate->headerCellClass() ?>"><div><div id="elh_bill_board_StartDate" class="bill_board_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_grid->EndDate->Visible) { // EndDate ?>
	<?php if ($bill_board_grid->SortUrl($bill_board_grid->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_grid->EndDate->headerCellClass() ?>"><div id="elh_bill_board_EndDate" class="bill_board_EndDate"><div class="ew-table-header-caption"><?php echo $bill_board_grid->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_grid->EndDate->headerCellClass() ?>"><div><div id="elh_bill_board_EndDate" class="bill_board_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_grid->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_grid->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_grid->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bill_board_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$bill_board_grid->StartRecord = 1;
$bill_board_grid->StopRecord = $bill_board_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($bill_board->isConfirm() || $bill_board_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($bill_board_grid->FormKeyCountName) && ($bill_board_grid->isGridAdd() || $bill_board_grid->isGridEdit() || $bill_board->isConfirm())) {
		$bill_board_grid->KeyCount = $CurrentForm->getValue($bill_board_grid->FormKeyCountName);
		$bill_board_grid->StopRecord = $bill_board_grid->StartRecord + $bill_board_grid->KeyCount - 1;
	}
}
$bill_board_grid->RecordCount = $bill_board_grid->StartRecord - 1;
if ($bill_board_grid->Recordset && !$bill_board_grid->Recordset->EOF) {
	$bill_board_grid->Recordset->moveFirst();
	$selectLimit = $bill_board_grid->UseSelectLimit;
	if (!$selectLimit && $bill_board_grid->StartRecord > 1)
		$bill_board_grid->Recordset->move($bill_board_grid->StartRecord - 1);
} elseif (!$bill_board->AllowAddDeleteRow && $bill_board_grid->StopRecord == 0) {
	$bill_board_grid->StopRecord = $bill_board->GridAddRowCount;
}

// Initialize aggregate
$bill_board->RowType = ROWTYPE_AGGREGATEINIT;
$bill_board->resetAttributes();
$bill_board_grid->renderRow();
if ($bill_board_grid->isGridAdd())
	$bill_board_grid->RowIndex = 0;
if ($bill_board_grid->isGridEdit())
	$bill_board_grid->RowIndex = 0;
while ($bill_board_grid->RecordCount < $bill_board_grid->StopRecord) {
	$bill_board_grid->RecordCount++;
	if ($bill_board_grid->RecordCount >= $bill_board_grid->StartRecord) {
		$bill_board_grid->RowCount++;
		if ($bill_board_grid->isGridAdd() || $bill_board_grid->isGridEdit() || $bill_board->isConfirm()) {
			$bill_board_grid->RowIndex++;
			$CurrentForm->Index = $bill_board_grid->RowIndex;
			if ($CurrentForm->hasValue($bill_board_grid->FormActionName) && ($bill_board->isConfirm() || $bill_board_grid->EventCancelled))
				$bill_board_grid->RowAction = strval($CurrentForm->getValue($bill_board_grid->FormActionName));
			elseif ($bill_board_grid->isGridAdd())
				$bill_board_grid->RowAction = "insert";
			else
				$bill_board_grid->RowAction = "";
		}

		// Set up key count
		$bill_board_grid->KeyCount = $bill_board_grid->RowIndex;

		// Init row class and style
		$bill_board->resetAttributes();
		$bill_board->CssClass = "";
		if ($bill_board_grid->isGridAdd()) {
			if ($bill_board->CurrentMode == "copy") {
				$bill_board_grid->loadRowValues($bill_board_grid->Recordset); // Load row values
				$bill_board_grid->setRecordKey($bill_board_grid->RowOldKey, $bill_board_grid->Recordset); // Set old record key
			} else {
				$bill_board_grid->loadRowValues(); // Load default values
				$bill_board_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$bill_board_grid->loadRowValues($bill_board_grid->Recordset); // Load row values
		}
		$bill_board->RowType = ROWTYPE_VIEW; // Render view
		if ($bill_board_grid->isGridAdd()) // Grid add
			$bill_board->RowType = ROWTYPE_ADD; // Render add
		if ($bill_board_grid->isGridAdd() && $bill_board->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$bill_board_grid->restoreCurrentRowFormValues($bill_board_grid->RowIndex); // Restore form values
		if ($bill_board_grid->isGridEdit()) { // Grid edit
			if ($bill_board->EventCancelled)
				$bill_board_grid->restoreCurrentRowFormValues($bill_board_grid->RowIndex); // Restore form values
			if ($bill_board_grid->RowAction == "insert")
				$bill_board->RowType = ROWTYPE_ADD; // Render add
			else
				$bill_board->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($bill_board_grid->isGridEdit() && ($bill_board->RowType == ROWTYPE_EDIT || $bill_board->RowType == ROWTYPE_ADD) && $bill_board->EventCancelled) // Update failed
			$bill_board_grid->restoreCurrentRowFormValues($bill_board_grid->RowIndex); // Restore form values
		if ($bill_board->RowType == ROWTYPE_EDIT) // Edit row
			$bill_board_grid->EditRowCount++;
		if ($bill_board->isConfirm()) // Confirm row
			$bill_board_grid->restoreCurrentRowFormValues($bill_board_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$bill_board->RowAttrs->merge(["data-rowindex" => $bill_board_grid->RowCount, "id" => "r" . $bill_board_grid->RowCount . "_bill_board", "data-rowtype" => $bill_board->RowType]);

		// Render row
		$bill_board_grid->renderRow();

		// Render list options
		$bill_board_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($bill_board_grid->RowAction != "delete" && $bill_board_grid->RowAction != "insertdelete" && !($bill_board_grid->RowAction == "insert" && $bill_board->isConfirm() && $bill_board_grid->emptyRow())) {
?>
	<tr <?php echo $bill_board->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_grid->ListOptions->render("body", "left", $bill_board_grid->RowCount);
?>
	<?php if ($bill_board_grid->BillBoardNo->Visible) { // BillBoardNo ?>
		<td data-name="BillBoardNo" <?php echo $bill_board_grid->BillBoardNo->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BillBoardNo" class="form-group"></span>
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BillBoardNo" class="form-group">
<span<?php echo $bill_board_grid->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BillBoardNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->CurrentValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BillBoardNo">
<span<?php echo $bill_board_grid->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_grid->BillBoardNo->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardStandNo->Visible) { // BoardStandNo ?>
		<td data-name="BoardStandNo" <?php echo $bill_board_grid->BoardStandNo->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardStandNo" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardStandNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardStandNo->EditValue ?>"<?php echo $bill_board_grid->BoardStandNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardStandNo" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" value="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardStandNo" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardStandNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardStandNo->EditValue ?>"<?php echo $bill_board_grid->BoardStandNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardStandNo">
<span<?php echo $bill_board_grid->BoardStandNo->viewAttributes() ?>><?php echo $bill_board_grid->BoardStandNo->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardStandNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" value="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardStandNo" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" value="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardStandNo" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" value="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardStandNo" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" value="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $bill_board_grid->ClientSerNo->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($bill_board_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientSerNo" class="form-group">
<span<?php echo $bill_board_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientSerNo" class="form-group">
<?php
$onchange = $bill_board_grid->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_board_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($bill_board_grid->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $bill_board_grid->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_board_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_board_grid->ClientSerNo->ReadOnly || $bill_board_grid->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_board_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbill_boardgrid"], function() {
	fbill_boardgrid.createAutoSuggest({"id":"x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $bill_board_grid->ClientSerNo->Lookup->getParamTag($bill_board_grid, "p_x" . $bill_board_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" name="o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($bill_board_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientSerNo" class="form-group">
<span<?php echo $bill_board_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientSerNo" class="form-group">
<?php
$onchange = $bill_board_grid->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_board_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($bill_board_grid->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $bill_board_grid->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_board_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_board_grid->ClientSerNo->ReadOnly || $bill_board_grid->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_board_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbill_boardgrid"], function() {
	fbill_boardgrid.createAutoSuggest({"id":"x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $bill_board_grid->ClientSerNo->Lookup->getParamTag($bill_board_grid, "p_x" . $bill_board_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientSerNo">
<span<?php echo $bill_board_grid->ClientSerNo->viewAttributes() ?>><?php echo $bill_board_grid->ClientSerNo->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" name="o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $bill_board_grid->ClientID->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientID" class="form-group">
<input type="text" data-table="bill_board" data-field="x_ClientID" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->ClientID->EditValue ?>"<?php echo $bill_board_grid->ClientID->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientID" name="o<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="o<?php echo $bill_board_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientID" class="form-group">
<input type="text" data-table="bill_board" data-field="x_ClientID" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->ClientID->EditValue ?>"<?php echo $bill_board_grid->ClientID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ClientID">
<span<?php echo $bill_board_grid->ClientID->viewAttributes() ?>><?php echo $bill_board_grid->ClientID->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_ClientID" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_ClientID" name="o<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="o<?php echo $bill_board_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_grid->ClientID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_ClientID" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_ClientID" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardLength->Visible) { // BoardLength ?>
		<td data-name="BoardLength" <?php echo $bill_board_grid->BoardLength->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardLength" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardLength" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardLength->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardLength->EditValue ?>"<?php echo $bill_board_grid->BoardLength->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardLength" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" value="<?php echo HtmlEncode($bill_board_grid->BoardLength->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardLength" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardLength" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardLength->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardLength->EditValue ?>"<?php echo $bill_board_grid->BoardLength->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardLength">
<span<?php echo $bill_board_grid->BoardLength->viewAttributes() ?>><?php echo $bill_board_grid->BoardLength->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardLength" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" value="<?php echo HtmlEncode($bill_board_grid->BoardLength->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardLength" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" value="<?php echo HtmlEncode($bill_board_grid->BoardLength->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardLength" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" value="<?php echo HtmlEncode($bill_board_grid->BoardLength->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardLength" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" value="<?php echo HtmlEncode($bill_board_grid->BoardLength->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardWidth->Visible) { // BoardWidth ?>
		<td data-name="BoardWidth" <?php echo $bill_board_grid->BoardWidth->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardWidth" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardWidth" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardWidth->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardWidth->EditValue ?>"<?php echo $bill_board_grid->BoardWidth->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardWidth" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" value="<?php echo HtmlEncode($bill_board_grid->BoardWidth->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardWidth" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardWidth" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardWidth->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardWidth->EditValue ?>"<?php echo $bill_board_grid->BoardWidth->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardWidth">
<span<?php echo $bill_board_grid->BoardWidth->viewAttributes() ?>><?php echo $bill_board_grid->BoardWidth->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardWidth" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" value="<?php echo HtmlEncode($bill_board_grid->BoardWidth->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardWidth" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" value="<?php echo HtmlEncode($bill_board_grid->BoardWidth->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardWidth" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" value="<?php echo HtmlEncode($bill_board_grid->BoardWidth->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardWidth" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" value="<?php echo HtmlEncode($bill_board_grid->BoardWidth->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardSize->Visible) { // BoardSize ?>
		<td data-name="BoardSize" <?php echo $bill_board_grid->BoardSize->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardSize" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardSize" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardSize->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardSize->EditValue ?>"<?php echo $bill_board_grid->BoardSize->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardSize" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" value="<?php echo HtmlEncode($bill_board_grid->BoardSize->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardSize" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardSize" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardSize->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardSize->EditValue ?>"<?php echo $bill_board_grid->BoardSize->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardSize">
<span<?php echo $bill_board_grid->BoardSize->viewAttributes() ?>><?php echo $bill_board_grid->BoardSize->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardSize" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" value="<?php echo HtmlEncode($bill_board_grid->BoardSize->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardSize" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" value="<?php echo HtmlEncode($bill_board_grid->BoardSize->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardSize" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" value="<?php echo HtmlEncode($bill_board_grid->BoardSize->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardSize" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" value="<?php echo HtmlEncode($bill_board_grid->BoardSize->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardType->Visible) { // BoardType ?>
		<td data-name="BoardType" <?php echo $bill_board_grid->BoardType->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board" data-field="x_BoardType" data-value-separator="<?php echo $bill_board_grid->BoardType->displayValueSeparatorAttribute() ?>" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardType" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardType"<?php echo $bill_board_grid->BoardType->editAttributes() ?>>
			<?php echo $bill_board_grid->BoardType->selectOptionListHtml("x{$bill_board_grid->RowIndex}_BoardType") ?>
		</select>
</div>
<?php echo $bill_board_grid->BoardType->Lookup->getParamTag($bill_board_grid, "p_x" . $bill_board_grid->RowIndex . "_BoardType") ?>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardType" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardType" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardType" value="<?php echo HtmlEncode($bill_board_grid->BoardType->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board" data-field="x_BoardType" data-value-separator="<?php echo $bill_board_grid->BoardType->displayValueSeparatorAttribute() ?>" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardType" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardType"<?php echo $bill_board_grid->BoardType->editAttributes() ?>>
			<?php echo $bill_board_grid->BoardType->selectOptionListHtml("x{$bill_board_grid->RowIndex}_BoardType") ?>
		</select>
</div>
<?php echo $bill_board_grid->BoardType->Lookup->getParamTag($bill_board_grid, "p_x" . $bill_board_grid->RowIndex . "_BoardType") ?>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardType">
<span<?php echo $bill_board_grid->BoardType->viewAttributes() ?>><?php echo $bill_board_grid->BoardType->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardType" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardType" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardType" value="<?php echo HtmlEncode($bill_board_grid->BoardType->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardType" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardType" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardType" value="<?php echo HtmlEncode($bill_board_grid->BoardType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardType" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardType" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardType" value="<?php echo HtmlEncode($bill_board_grid->BoardType->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardType" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardType" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardType" value="<?php echo HtmlEncode($bill_board_grid->BoardType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardLocation->Visible) { // BoardLocation ?>
		<td data-name="BoardLocation" <?php echo $bill_board_grid->BoardLocation->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardLocation" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardLocation" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardLocation->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardLocation->EditValue ?>"<?php echo $bill_board_grid->BoardLocation->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardLocation" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" value="<?php echo HtmlEncode($bill_board_grid->BoardLocation->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardLocation" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardLocation" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardLocation->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardLocation->EditValue ?>"<?php echo $bill_board_grid->BoardLocation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardLocation">
<span<?php echo $bill_board_grid->BoardLocation->viewAttributes() ?>><?php echo $bill_board_grid->BoardLocation->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardLocation" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" value="<?php echo HtmlEncode($bill_board_grid->BoardLocation->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardLocation" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" value="<?php echo HtmlEncode($bill_board_grid->BoardLocation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardLocation" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" value="<?php echo HtmlEncode($bill_board_grid->BoardLocation->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardLocation" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" value="<?php echo HtmlEncode($bill_board_grid->BoardLocation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardStatus->Visible) { // BoardStatus ?>
		<td data-name="BoardStatus" <?php echo $bill_board_grid->BoardStatus->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardStatus" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardStatus" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardStatus->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardStatus->EditValue ?>"<?php echo $bill_board_grid->BoardStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardStatus" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" value="<?php echo HtmlEncode($bill_board_grid->BoardStatus->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardStatus" class="form-group">
<input type="text" data-table="bill_board" data-field="x_BoardStatus" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardStatus->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardStatus->EditValue ?>"<?php echo $bill_board_grid->BoardStatus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_BoardStatus">
<span<?php echo $bill_board_grid->BoardStatus->viewAttributes() ?>><?php echo $bill_board_grid->BoardStatus->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardStatus" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" value="<?php echo HtmlEncode($bill_board_grid->BoardStatus->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardStatus" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" value="<?php echo HtmlEncode($bill_board_grid->BoardStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardStatus" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" value="<?php echo HtmlEncode($bill_board_grid->BoardStatus->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_BoardStatus" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" value="<?php echo HtmlEncode($bill_board_grid->BoardStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode" <?php echo $bill_board_grid->ExemptCode->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ExemptCode" class="form-group">
<input type="text" data-table="bill_board" data-field="x_ExemptCode" name="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->ExemptCode->EditValue ?>"<?php echo $bill_board_grid->ExemptCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ExemptCode" name="o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($bill_board_grid->ExemptCode->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ExemptCode" class="form-group">
<input type="text" data-table="bill_board" data-field="x_ExemptCode" name="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->ExemptCode->EditValue ?>"<?php echo $bill_board_grid->ExemptCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_ExemptCode">
<span<?php echo $bill_board_grid->ExemptCode->viewAttributes() ?>><?php echo $bill_board_grid->ExemptCode->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_ExemptCode" name="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($bill_board_grid->ExemptCode->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_ExemptCode" name="o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($bill_board_grid->ExemptCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_ExemptCode" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($bill_board_grid->ExemptCode->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_ExemptCode" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($bill_board_grid->ExemptCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->StreetAddress->Visible) { // StreetAddress ?>
		<td data-name="StreetAddress" <?php echo $bill_board_grid->StreetAddress->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_StreetAddress" class="form-group">
<input type="text" data-table="bill_board" data-field="x_StreetAddress" name="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->StreetAddress->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->StreetAddress->EditValue ?>"<?php echo $bill_board_grid->StreetAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_StreetAddress" name="o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($bill_board_grid->StreetAddress->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_StreetAddress" class="form-group">
<input type="text" data-table="bill_board" data-field="x_StreetAddress" name="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->StreetAddress->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->StreetAddress->EditValue ?>"<?php echo $bill_board_grid->StreetAddress->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_StreetAddress">
<span<?php echo $bill_board_grid->StreetAddress->viewAttributes() ?>><?php echo $bill_board_grid->StreetAddress->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_StreetAddress" name="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($bill_board_grid->StreetAddress->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_StreetAddress" name="o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($bill_board_grid->StreetAddress->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_StreetAddress" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($bill_board_grid->StreetAddress->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_StreetAddress" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($bill_board_grid->StreetAddress->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $bill_board_grid->Longitude->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Longitude" class="form-group">
<input type="text" data-table="bill_board" data-field="x_Longitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Longitude->EditValue ?>"<?php echo $bill_board_grid->Longitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_Longitude" name="o<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="o<?php echo $bill_board_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($bill_board_grid->Longitude->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Longitude" class="form-group">
<input type="text" data-table="bill_board" data-field="x_Longitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Longitude->EditValue ?>"<?php echo $bill_board_grid->Longitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Longitude">
<span<?php echo $bill_board_grid->Longitude->viewAttributes() ?>><?php echo $bill_board_grid->Longitude->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_Longitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($bill_board_grid->Longitude->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_Longitude" name="o<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="o<?php echo $bill_board_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($bill_board_grid->Longitude->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_Longitude" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($bill_board_grid->Longitude->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_Longitude" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($bill_board_grid->Longitude->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $bill_board_grid->Latitude->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Latitude" class="form-group">
<input type="text" data-table="bill_board" data-field="x_Latitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Latitude->EditValue ?>"<?php echo $bill_board_grid->Latitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_Latitude" name="o<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="o<?php echo $bill_board_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($bill_board_grid->Latitude->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Latitude" class="form-group">
<input type="text" data-table="bill_board" data-field="x_Latitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Latitude->EditValue ?>"<?php echo $bill_board_grid->Latitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Latitude">
<span<?php echo $bill_board_grid->Latitude->viewAttributes() ?>><?php echo $bill_board_grid->Latitude->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_Latitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($bill_board_grid->Latitude->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_Latitude" name="o<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="o<?php echo $bill_board_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($bill_board_grid->Latitude->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_Latitude" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($bill_board_grid->Latitude->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_Latitude" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($bill_board_grid->Latitude->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->Incumberance->Visible) { // Incumberance ?>
		<td data-name="Incumberance" <?php echo $bill_board_grid->Incumberance->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Incumberance" class="form-group">
<input type="text" data-table="bill_board" data-field="x_Incumberance" name="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($bill_board_grid->Incumberance->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Incumberance->EditValue ?>"<?php echo $bill_board_grid->Incumberance->editAttributes() ?>>
</span>
<input type="hidden" data-table="bill_board" data-field="x_Incumberance" name="o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($bill_board_grid->Incumberance->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Incumberance" class="form-group">
<input type="text" data-table="bill_board" data-field="x_Incumberance" name="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($bill_board_grid->Incumberance->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Incumberance->EditValue ?>"<?php echo $bill_board_grid->Incumberance->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_Incumberance">
<span<?php echo $bill_board_grid->Incumberance->viewAttributes() ?>><?php echo $bill_board_grid->Incumberance->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_Incumberance" name="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($bill_board_grid->Incumberance->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_Incumberance" name="o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($bill_board_grid->Incumberance->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_Incumberance" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($bill_board_grid->Incumberance->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_Incumberance" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($bill_board_grid->Incumberance->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $bill_board_grid->StartDate->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_StartDate" class="form-group">
<input type="text" data-table="bill_board" data-field="x_StartDate" name="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($bill_board_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->StartDate->EditValue ?>"<?php echo $bill_board_grid->StartDate->editAttributes() ?>>
<?php if (!$bill_board_grid->StartDate->ReadOnly && !$bill_board_grid->StartDate->Disabled && !isset($bill_board_grid->StartDate->EditAttrs["readonly"]) && !isset($bill_board_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardgrid", "x<?php echo $bill_board_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bill_board" data-field="x_StartDate" name="o<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="o<?php echo $bill_board_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_StartDate" class="form-group">
<input type="text" data-table="bill_board" data-field="x_StartDate" name="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($bill_board_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->StartDate->EditValue ?>"<?php echo $bill_board_grid->StartDate->editAttributes() ?>>
<?php if (!$bill_board_grid->StartDate->ReadOnly && !$bill_board_grid->StartDate->Disabled && !isset($bill_board_grid->StartDate->EditAttrs["readonly"]) && !isset($bill_board_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardgrid", "x<?php echo $bill_board_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_StartDate">
<span<?php echo $bill_board_grid->StartDate->viewAttributes() ?>><?php echo $bill_board_grid->StartDate->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_StartDate" name="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_StartDate" name="o<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="o<?php echo $bill_board_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_grid->StartDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_StartDate" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_grid->StartDate->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_StartDate" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_grid->StartDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bill_board_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $bill_board_grid->EndDate->cellAttributes() ?>>
<?php if ($bill_board->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_EndDate" class="form-group">
<input type="text" data-table="bill_board" data-field="x_EndDate" name="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($bill_board_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->EndDate->EditValue ?>"<?php echo $bill_board_grid->EndDate->editAttributes() ?>>
<?php if (!$bill_board_grid->EndDate->ReadOnly && !$bill_board_grid->EndDate->Disabled && !isset($bill_board_grid->EndDate->EditAttrs["readonly"]) && !isset($bill_board_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardgrid", "x<?php echo $bill_board_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="bill_board" data-field="x_EndDate" name="o<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="o<?php echo $bill_board_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_EndDate" class="form-group">
<input type="text" data-table="bill_board" data-field="x_EndDate" name="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($bill_board_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->EndDate->EditValue ?>"<?php echo $bill_board_grid->EndDate->editAttributes() ?>>
<?php if (!$bill_board_grid->EndDate->ReadOnly && !$bill_board_grid->EndDate->Disabled && !isset($bill_board_grid->EndDate->EditAttrs["readonly"]) && !isset($bill_board_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardgrid", "x<?php echo $bill_board_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($bill_board->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bill_board_grid->RowCount ?>_bill_board_EndDate">
<span<?php echo $bill_board_grid->EndDate->viewAttributes() ?>><?php echo $bill_board_grid->EndDate->getViewValue() ?></span>
</span>
<?php if (!$bill_board->isConfirm()) { ?>
<input type="hidden" data-table="bill_board" data-field="x_EndDate" name="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_EndDate" name="o<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="o<?php echo $bill_board_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_grid->EndDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bill_board" data-field="x_EndDate" name="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="fbill_boardgrid$x<?php echo $bill_board_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_grid->EndDate->FormValue) ?>">
<input type="hidden" data-table="bill_board" data-field="x_EndDate" name="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="fbill_boardgrid$o<?php echo $bill_board_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_grid->EndDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bill_board_grid->ListOptions->render("body", "right", $bill_board_grid->RowCount);
?>
	</tr>
<?php if ($bill_board->RowType == ROWTYPE_ADD || $bill_board->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbill_boardgrid", "load"], function() {
	fbill_boardgrid.updateLists(<?php echo $bill_board_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$bill_board_grid->isGridAdd() || $bill_board->CurrentMode == "copy")
		if (!$bill_board_grid->Recordset->EOF)
			$bill_board_grid->Recordset->moveNext();
}
?>
<?php
	if ($bill_board->CurrentMode == "add" || $bill_board->CurrentMode == "copy" || $bill_board->CurrentMode == "edit") {
		$bill_board_grid->RowIndex = '$rowindex$';
		$bill_board_grid->loadRowValues();

		// Set row properties
		$bill_board->resetAttributes();
		$bill_board->RowAttrs->merge(["data-rowindex" => $bill_board_grid->RowIndex, "id" => "r0_bill_board", "data-rowtype" => ROWTYPE_ADD]);
		$bill_board->RowAttrs->appendClass("ew-template");
		$bill_board->RowType = ROWTYPE_ADD;

		// Render row
		$bill_board_grid->renderRow();

		// Render list options
		$bill_board_grid->renderListOptions();
		$bill_board_grid->StartRowCount = 0;
?>
	<tr <?php echo $bill_board->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_grid->ListOptions->render("body", "left", $bill_board_grid->RowIndex);
?>
	<?php if ($bill_board_grid->BillBoardNo->Visible) { // BillBoardNo ?>
		<td data-name="BillBoardNo">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BillBoardNo" class="form-group bill_board_BillBoardNo"></span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BillBoardNo" class="form-group bill_board_BillBoardNo">
<span<?php echo $bill_board_grid->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BillBoardNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" id="o<?php echo $bill_board_grid->RowIndex ?>_BillBoardNo" value="<?php echo HtmlEncode($bill_board_grid->BillBoardNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardStandNo->Visible) { // BoardStandNo ?>
		<td data-name="BoardStandNo">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BoardStandNo" class="form-group bill_board_BoardStandNo">
<input type="text" data-table="bill_board" data-field="x_BoardStandNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardStandNo->EditValue ?>"<?php echo $bill_board_grid->BoardStandNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BoardStandNo" class="form-group bill_board_BoardStandNo">
<span<?php echo $bill_board_grid->BoardStandNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BoardStandNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardStandNo" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" value="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardStandNo" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardStandNo" value="<?php echo HtmlEncode($bill_board_grid->BoardStandNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo">
<?php if (!$bill_board->isConfirm()) { ?>
<?php if ($bill_board_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_bill_board_ClientSerNo" class="form-group bill_board_ClientSerNo">
<span<?php echo $bill_board_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_bill_board_ClientSerNo" class="form-group bill_board_ClientSerNo">
<?php
$onchange = $bill_board_grid->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_board_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($bill_board_grid->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $bill_board_grid->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_board_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_board_grid->ClientSerNo->ReadOnly || $bill_board_grid->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_board_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbill_boardgrid"], function() {
	fbill_boardgrid.createAutoSuggest({"id":"x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $bill_board_grid->ClientSerNo->Lookup->getParamTag($bill_board_grid, "p_x" . $bill_board_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_bill_board_ClientSerNo" class="form-group bill_board_ClientSerNo">
<span<?php echo $bill_board_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" name="o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $bill_board_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($bill_board_grid->ClientSerNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_ClientID" class="form-group bill_board_ClientID">
<input type="text" data-table="bill_board" data-field="x_ClientID" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_grid->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->ClientID->EditValue ?>"<?php echo $bill_board_grid->ClientID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_ClientID" class="form-group bill_board_ClientID">
<span<?php echo $bill_board_grid->ClientID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->ClientID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientID" name="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="x<?php echo $bill_board_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_grid->ClientID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_ClientID" name="o<?php echo $bill_board_grid->RowIndex ?>_ClientID" id="o<?php echo $bill_board_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($bill_board_grid->ClientID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardLength->Visible) { // BoardLength ?>
		<td data-name="BoardLength">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BoardLength" class="form-group bill_board_BoardLength">
<input type="text" data-table="bill_board" data-field="x_BoardLength" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardLength->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardLength->EditValue ?>"<?php echo $bill_board_grid->BoardLength->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BoardLength" class="form-group bill_board_BoardLength">
<span<?php echo $bill_board_grid->BoardLength->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BoardLength->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardLength" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLength" value="<?php echo HtmlEncode($bill_board_grid->BoardLength->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardLength" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardLength" value="<?php echo HtmlEncode($bill_board_grid->BoardLength->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardWidth->Visible) { // BoardWidth ?>
		<td data-name="BoardWidth">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BoardWidth" class="form-group bill_board_BoardWidth">
<input type="text" data-table="bill_board" data-field="x_BoardWidth" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardWidth->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardWidth->EditValue ?>"<?php echo $bill_board_grid->BoardWidth->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BoardWidth" class="form-group bill_board_BoardWidth">
<span<?php echo $bill_board_grid->BoardWidth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BoardWidth->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardWidth" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" value="<?php echo HtmlEncode($bill_board_grid->BoardWidth->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardWidth" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardWidth" value="<?php echo HtmlEncode($bill_board_grid->BoardWidth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardSize->Visible) { // BoardSize ?>
		<td data-name="BoardSize">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BoardSize" class="form-group bill_board_BoardSize">
<input type="text" data-table="bill_board" data-field="x_BoardSize" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardSize->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardSize->EditValue ?>"<?php echo $bill_board_grid->BoardSize->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BoardSize" class="form-group bill_board_BoardSize">
<span<?php echo $bill_board_grid->BoardSize->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BoardSize->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardSize" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardSize" value="<?php echo HtmlEncode($bill_board_grid->BoardSize->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardSize" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardSize" value="<?php echo HtmlEncode($bill_board_grid->BoardSize->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardType->Visible) { // BoardType ?>
		<td data-name="BoardType">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BoardType" class="form-group bill_board_BoardType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board" data-field="x_BoardType" data-value-separator="<?php echo $bill_board_grid->BoardType->displayValueSeparatorAttribute() ?>" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardType" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardType"<?php echo $bill_board_grid->BoardType->editAttributes() ?>>
			<?php echo $bill_board_grid->BoardType->selectOptionListHtml("x{$bill_board_grid->RowIndex}_BoardType") ?>
		</select>
</div>
<?php echo $bill_board_grid->BoardType->Lookup->getParamTag($bill_board_grid, "p_x" . $bill_board_grid->RowIndex . "_BoardType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BoardType" class="form-group bill_board_BoardType">
<span<?php echo $bill_board_grid->BoardType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BoardType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardType" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardType" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardType" value="<?php echo HtmlEncode($bill_board_grid->BoardType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardType" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardType" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardType" value="<?php echo HtmlEncode($bill_board_grid->BoardType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardLocation->Visible) { // BoardLocation ?>
		<td data-name="BoardLocation">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BoardLocation" class="form-group bill_board_BoardLocation">
<input type="text" data-table="bill_board" data-field="x_BoardLocation" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardLocation->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardLocation->EditValue ?>"<?php echo $bill_board_grid->BoardLocation->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BoardLocation" class="form-group bill_board_BoardLocation">
<span<?php echo $bill_board_grid->BoardLocation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BoardLocation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardLocation" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" value="<?php echo HtmlEncode($bill_board_grid->BoardLocation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardLocation" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardLocation" value="<?php echo HtmlEncode($bill_board_grid->BoardLocation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->BoardStatus->Visible) { // BoardStatus ?>
		<td data-name="BoardStatus">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_BoardStatus" class="form-group bill_board_BoardStatus">
<input type="text" data-table="bill_board" data-field="x_BoardStatus" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->BoardStatus->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->BoardStatus->EditValue ?>"<?php echo $bill_board_grid->BoardStatus->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_BoardStatus" class="form-group bill_board_BoardStatus">
<span<?php echo $bill_board_grid->BoardStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->BoardStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BoardStatus" name="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="x<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" value="<?php echo HtmlEncode($bill_board_grid->BoardStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_BoardStatus" name="o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" id="o<?php echo $bill_board_grid->RowIndex ?>_BoardStatus" value="<?php echo HtmlEncode($bill_board_grid->BoardStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_ExemptCode" class="form-group bill_board_ExemptCode">
<input type="text" data-table="bill_board" data-field="x_ExemptCode" name="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->ExemptCode->EditValue ?>"<?php echo $bill_board_grid->ExemptCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_ExemptCode" class="form-group bill_board_ExemptCode">
<span<?php echo $bill_board_grid->ExemptCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->ExemptCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ExemptCode" name="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="x<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($bill_board_grid->ExemptCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_ExemptCode" name="o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" id="o<?php echo $bill_board_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($bill_board_grid->ExemptCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->StreetAddress->Visible) { // StreetAddress ?>
		<td data-name="StreetAddress">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_StreetAddress" class="form-group bill_board_StreetAddress">
<input type="text" data-table="bill_board" data-field="x_StreetAddress" name="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_grid->StreetAddress->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->StreetAddress->EditValue ?>"<?php echo $bill_board_grid->StreetAddress->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_StreetAddress" class="form-group bill_board_StreetAddress">
<span<?php echo $bill_board_grid->StreetAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->StreetAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_StreetAddress" name="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="x<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($bill_board_grid->StreetAddress->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_StreetAddress" name="o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" id="o<?php echo $bill_board_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($bill_board_grid->StreetAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_Longitude" class="form-group bill_board_Longitude">
<input type="text" data-table="bill_board" data-field="x_Longitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Longitude->EditValue ?>"<?php echo $bill_board_grid->Longitude->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_Longitude" class="form-group bill_board_Longitude">
<span<?php echo $bill_board_grid->Longitude->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->Longitude->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_Longitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($bill_board_grid->Longitude->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_Longitude" name="o<?php echo $bill_board_grid->RowIndex ?>_Longitude" id="o<?php echo $bill_board_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($bill_board_grid->Longitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_Latitude" class="form-group bill_board_Latitude">
<input type="text" data-table="bill_board" data-field="x_Latitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Latitude->EditValue ?>"<?php echo $bill_board_grid->Latitude->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_Latitude" class="form-group bill_board_Latitude">
<span<?php echo $bill_board_grid->Latitude->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->Latitude->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_Latitude" name="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="x<?php echo $bill_board_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($bill_board_grid->Latitude->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_Latitude" name="o<?php echo $bill_board_grid->RowIndex ?>_Latitude" id="o<?php echo $bill_board_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($bill_board_grid->Latitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->Incumberance->Visible) { // Incumberance ?>
		<td data-name="Incumberance">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_Incumberance" class="form-group bill_board_Incumberance">
<input type="text" data-table="bill_board" data-field="x_Incumberance" name="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($bill_board_grid->Incumberance->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->Incumberance->EditValue ?>"<?php echo $bill_board_grid->Incumberance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_Incumberance" class="form-group bill_board_Incumberance">
<span<?php echo $bill_board_grid->Incumberance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->Incumberance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_Incumberance" name="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="x<?php echo $bill_board_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($bill_board_grid->Incumberance->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_Incumberance" name="o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" id="o<?php echo $bill_board_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($bill_board_grid->Incumberance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_StartDate" class="form-group bill_board_StartDate">
<input type="text" data-table="bill_board" data-field="x_StartDate" name="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($bill_board_grid->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->StartDate->EditValue ?>"<?php echo $bill_board_grid->StartDate->editAttributes() ?>>
<?php if (!$bill_board_grid->StartDate->ReadOnly && !$bill_board_grid->StartDate->Disabled && !isset($bill_board_grid->StartDate->EditAttrs["readonly"]) && !isset($bill_board_grid->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardgrid", "x<?php echo $bill_board_grid->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_StartDate" class="form-group bill_board_StartDate">
<span<?php echo $bill_board_grid->StartDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->StartDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_StartDate" name="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="x<?php echo $bill_board_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_grid->StartDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_StartDate" name="o<?php echo $bill_board_grid->RowIndex ?>_StartDate" id="o<?php echo $bill_board_grid->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($bill_board_grid->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bill_board_grid->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate">
<?php if (!$bill_board->isConfirm()) { ?>
<span id="el$rowindex$_bill_board_EndDate" class="form-group bill_board_EndDate">
<input type="text" data-table="bill_board" data-field="x_EndDate" name="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" placeholder="<?php echo HtmlEncode($bill_board_grid->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_grid->EndDate->EditValue ?>"<?php echo $bill_board_grid->EndDate->editAttributes() ?>>
<?php if (!$bill_board_grid->EndDate->ReadOnly && !$bill_board_grid->EndDate->Disabled && !isset($bill_board_grid->EndDate->EditAttrs["readonly"]) && !isset($bill_board_grid->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardgrid", "x<?php echo $bill_board_grid->RowIndex ?>_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_bill_board_EndDate" class="form-group bill_board_EndDate">
<span<?php echo $bill_board_grid->EndDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_grid->EndDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_EndDate" name="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="x<?php echo $bill_board_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_grid->EndDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bill_board" data-field="x_EndDate" name="o<?php echo $bill_board_grid->RowIndex ?>_EndDate" id="o<?php echo $bill_board_grid->RowIndex ?>_EndDate" value="<?php echo HtmlEncode($bill_board_grid->EndDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bill_board_grid->ListOptions->render("body", "right", $bill_board_grid->RowIndex);
?>
<script>
loadjs.ready(["fbill_boardgrid", "load"], function() {
	fbill_boardgrid.updateLists(<?php echo $bill_board_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($bill_board->CurrentMode == "add" || $bill_board->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $bill_board_grid->FormKeyCountName ?>" id="<?php echo $bill_board_grid->FormKeyCountName ?>" value="<?php echo $bill_board_grid->KeyCount ?>">
<?php echo $bill_board_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bill_board->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $bill_board_grid->FormKeyCountName ?>" id="<?php echo $bill_board_grid->FormKeyCountName ?>" value="<?php echo $bill_board_grid->KeyCount ?>">
<?php echo $bill_board_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bill_board->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fbill_boardgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bill_board_grid->Recordset)
	$bill_board_grid->Recordset->Close();
?>
<?php if ($bill_board_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $bill_board_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bill_board_grid->TotalRecords == 0 && !$bill_board->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bill_board_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$bill_board_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$bill_board_grid->terminate();
?>