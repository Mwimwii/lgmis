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
$Cashier_Summary_report_summary = new Cashier_Summary_report_summary();

// Run the page
$Cashier_Summary_report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Cashier_Summary_report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport() && !$Cashier_Summary_report_summary->DrillDown && !$DashboardReport) { ?>
<script>
var fsummary, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fsummary = currentForm = new ew.Form("fsummary", "summary");
	currentPageID = ew.PAGE_ID = "summary";

	// Validate function for search
	fsummary.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Cashier_Summary_report_summary->ReceiptDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fsummary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsummary.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsummary.lists["x_ChargeDesc[]"] = <?php echo $Cashier_Summary_report_summary->ChargeDesc->Lookup->toClientList($Cashier_Summary_report_summary) ?>;
	fsummary.lists["x_ChargeDesc[]"].options = <?php echo JsonEncode($Cashier_Summary_report_summary->ChargeDesc->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Cashier_Summary_report_summary->getFilterList() ?>;

	// Init search panel as collapsed
	fsummary.initSearchPanel = true;
	loadjs.done("fsummary");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Cashier_Summary_report_summary->isExport() || $Cashier_Summary_report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ShowCurrentFilter) { ?>
<?php $Cashier_Summary_report_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Cashier_Summary_report_summary->DrillDownInPanel) {
	$Cashier_Summary_report_summary->ExportOptions->render("body");
	$Cashier_Summary_report_summary->SearchOptions->render("body");
	$Cashier_Summary_report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Cashier_Summary_report_summary->showPageHeader(); ?>
<?php
$Cashier_Summary_report_summary->showMessage();
?>
<?php if ((!$Cashier_Summary_report_summary->isExport() || $Cashier_Summary_report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Cashier_Summary_report_summary->isExport() || $Cashier_Summary_report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Cashier_Summary_report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport() && !$Cashier_Summary_report_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Cashier_Summary_report_summary->isExport() && !$Cashier_Summary_report->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Cashier_Summary_report_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Cashier_Summary_report">
	<div class="ew-extended-search">
<?php

// Render search row
$Cashier_Summary_report->RowType = ROWTYPE_SEARCH;
$Cashier_Summary_report->resetAttributes();
$Cashier_Summary_report_summary->renderRow();
?>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php
		$Cashier_Summary_report_summary->SearchColumnCount++;
		if (($Cashier_Summary_report_summary->SearchColumnCount - 1) % $Cashier_Summary_report_summary->SearchFieldsPerRow == 0) {
			$Cashier_Summary_report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Cashier_Summary_report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ReceiptDate" class="ew-cell form-group">
		<label for="x_ReceiptDate" class="ew-search-caption ew-label"><?php echo $Cashier_Summary_report_summary->ReceiptDate->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="BETWEEN">
</span>
		<span id="el_Cashier_Summary_report_ReceiptDate" class="ew-search-field">
<input type="text" data-table="Cashier_Summary_report" data-field="x_ReceiptDate" data-format="7" name="x_ReceiptDate" id="x_ReceiptDate" placeholder="<?php echo HtmlEncode($Cashier_Summary_report_summary->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $Cashier_Summary_report_summary->ReceiptDate->EditValue ?>"<?php echo $Cashier_Summary_report_summary->ReceiptDate->editAttributes() ?>>
<?php if (!$Cashier_Summary_report_summary->ReceiptDate->ReadOnly && !$Cashier_Summary_report_summary->ReceiptDate->Disabled && !isset($Cashier_Summary_report_summary->ReceiptDate->EditAttrs["readonly"]) && !isset($Cashier_Summary_report_summary->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_Cashier_Summary_report_ReceiptDate" class="ew-search-field2">
<input type="text" data-table="Cashier_Summary_report" data-field="x_ReceiptDate" data-format="7" name="y_ReceiptDate" id="y_ReceiptDate" placeholder="<?php echo HtmlEncode($Cashier_Summary_report_summary->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $Cashier_Summary_report_summary->ReceiptDate->EditValue2 ?>"<?php echo $Cashier_Summary_report_summary->ReceiptDate->editAttributes() ?>>
<?php if (!$Cashier_Summary_report_summary->ReceiptDate->ReadOnly && !$Cashier_Summary_report_summary->ReceiptDate->Disabled && !isset($Cashier_Summary_report_summary->ReceiptDate->EditAttrs["readonly"]) && !isset($Cashier_Summary_report_summary->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fsummary", "datetimepicker"], function() {
	ew.createDateTimePicker("fsummary", "y_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($Cashier_Summary_report_summary->SearchColumnCount % $Cashier_Summary_report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->CashierNo->Visible) { // CashierNo ?>
	<?php
		$Cashier_Summary_report_summary->SearchColumnCount++;
		if (($Cashier_Summary_report_summary->SearchColumnCount - 1) % $Cashier_Summary_report_summary->SearchFieldsPerRow == 0) {
			$Cashier_Summary_report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Cashier_Summary_report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_CashierNo" class="ew-cell form-group">
		<label for="x_CashierNo" class="ew-search-caption ew-label"><?php echo $Cashier_Summary_report_summary->CashierNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CashierNo" id="z_CashierNo" value="LIKE">
</span>
		<span id="el_Cashier_Summary_report_CashierNo" class="ew-search-field">
<input type="text" data-table="Cashier_Summary_report" data-field="x_CashierNo" name="x_CashierNo" id="x_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Cashier_Summary_report_summary->CashierNo->getPlaceHolder()) ?>" value="<?php echo $Cashier_Summary_report_summary->CashierNo->EditValue ?>"<?php echo $Cashier_Summary_report_summary->CashierNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($Cashier_Summary_report_summary->SearchColumnCount % $Cashier_Summary_report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php
		$Cashier_Summary_report_summary->SearchColumnCount++;
		if (($Cashier_Summary_report_summary->SearchColumnCount - 1) % $Cashier_Summary_report_summary->SearchFieldsPerRow == 0) {
			$Cashier_Summary_report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Cashier_Summary_report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeDesc" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Cashier_Summary_report_summary->ChargeDesc->caption() ?></label>
		<span id="el_Cashier_Summary_report_ChargeDesc" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeDesc"><?php echo EmptyValue(strval($Cashier_Summary_report_summary->ChargeDesc->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Cashier_Summary_report_summary->ChargeDesc->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Cashier_Summary_report_summary->ChargeDesc->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Cashier_Summary_report_summary->ChargeDesc->ReadOnly || $Cashier_Summary_report_summary->ChargeDesc->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeDesc[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Cashier_Summary_report_summary->ChargeDesc->Lookup->getParamTag($Cashier_Summary_report_summary, "p_x_ChargeDesc") ?>
<input type="hidden" data-table="Cashier_Summary_report" data-field="x_ChargeDesc" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $Cashier_Summary_report_summary->ChargeDesc->displayValueSeparatorAttribute() ?>" name="x_ChargeDesc[]" id="x_ChargeDesc[]" value="<?php echo $Cashier_Summary_report_summary->ChargeDesc->AdvancedSearch->SearchValue ?>"<?php echo $Cashier_Summary_report_summary->ChargeDesc->editAttributes() ?>>
</span>
	</div>
	<?php if ($Cashier_Summary_report_summary->SearchColumnCount % $Cashier_Summary_report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Cashier_Summary_report_summary->SearchColumnCount % $Cashier_Summary_report_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Cashier_Summary_report_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Cashier_Summary_report_summary->GroupCount <= count($Cashier_Summary_report_summary->GroupRecords) && $Cashier_Summary_report_summary->GroupCount <= $Cashier_Summary_report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Cashier_Summary_report_summary->ShowHeader) {
?>
<?php if ($Cashier_Summary_report_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Cashier_Summary_report_summary->TotalGroups > 0) { ?>
<?php if (!$Cashier_Summary_report_summary->isExport() && !($Cashier_Summary_report_summary->DrillDown && $Cashier_Summary_report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Cashier_Summary_report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Cashier_Summary_report_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Cashier_Summary_report_summary->isExport("word") && !$Cashier_Summary_report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Cashier_Summary_report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport() && !($Cashier_Summary_report_summary->DrillDown && $Cashier_Summary_report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Cashier_Summary_report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Cashier_Summary_report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Cashier_Summary_report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
	<?php if ($Cashier_Summary_report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
	<th data-name="ReceiptDate">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ReceiptDate) == "") { ?>
	<th data-name="ReceiptDate" class="<?php echo $Cashier_Summary_report_summary->ReceiptDate->headerCellClass() ?>"><div class="Cashier_Summary_report_ReceiptDate"><div class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ReceiptDate->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="ReceiptDate" class="<?php echo $Cashier_Summary_report_summary->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ReceiptDate) ?>', 1);"><div class="Cashier_Summary_report_ReceiptDate">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cashier_Summary_report_summary->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cashier_Summary_report_summary->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->CashierNo->Visible) { ?>
	<?php if ($Cashier_Summary_report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
	<th data-name="CashierNo">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->CashierNo) == "") { ?>
	<th data-name="CashierNo" class="<?php echo $Cashier_Summary_report_summary->CashierNo->headerCellClass() ?>"><div class="Cashier_Summary_report_CashierNo"><div class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->CashierNo->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="CashierNo" class="<?php echo $Cashier_Summary_report_summary->CashierNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->CashierNo) ?>', 1);"><div class="Cashier_Summary_report_CashierNo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->CashierNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cashier_Summary_report_summary->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cashier_Summary_report_summary->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
	<?php if ($Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ChargeDesc) == "") { ?>
	<th data-name="ChargeDesc" class="<?php echo $Cashier_Summary_report_summary->ChargeDesc->headerCellClass() ?>"><div class="Cashier_Summary_report_ChargeDesc"><div class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ChargeDesc->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ChargeDesc" class="<?php echo $Cashier_Summary_report_summary->ChargeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ChargeDesc) ?>', 1);"><div class="Cashier_Summary_report_ChargeDesc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ChargeDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cashier_Summary_report_summary->ChargeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cashier_Summary_report_summary->ChargeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
	<?php if ($Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->NoOfReceipts) == "") { ?>
	<th data-name="NoOfReceipts" class="<?php echo $Cashier_Summary_report_summary->NoOfReceipts->headerCellClass() ?>"><div class="Cashier_Summary_report_NoOfReceipts"><div class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->NoOfReceipts->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NoOfReceipts" class="<?php echo $Cashier_Summary_report_summary->NoOfReceipts->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->NoOfReceipts) ?>', 1);"><div class="Cashier_Summary_report_NoOfReceipts">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->NoOfReceipts->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cashier_Summary_report_summary->NoOfReceipts->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cashier_Summary_report_summary->NoOfReceipts->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
	<?php if ($Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ReceiptedTotalAmount) == "") { ?>
	<th data-name="ReceiptedTotalAmount" class="<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->headerCellClass() ?>"><div class="Cashier_Summary_report_ReceiptedTotalAmount"><div class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ReceiptedTotalAmount" class="<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ReceiptedTotalAmount) ?>', 1);"><div class="Cashier_Summary_report_ReceiptedTotalAmount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cashier_Summary_report_summary->ReceiptedTotalAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Cashier_Summary_report_summary->TotalGroups == 0)
			break; // Show header only
		$Cashier_Summary_report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Cashier_Summary_report_summary->ReceiptDate, $Cashier_Summary_report_summary->getSqlFirstGroupField(), $Cashier_Summary_report_summary->ReceiptDate->groupValue(), $Cashier_Summary_report_summary->Dbid);
	if ($Cashier_Summary_report_summary->PageFirstGroupFilter != "") $Cashier_Summary_report_summary->PageFirstGroupFilter .= " OR ";
	$Cashier_Summary_report_summary->PageFirstGroupFilter .= $where;
	if ($Cashier_Summary_report_summary->Filter != "")
		$where = "($Cashier_Summary_report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Cashier_Summary_report_summary->getSqlSelect(), $Cashier_Summary_report_summary->getSqlWhere(), $Cashier_Summary_report_summary->getSqlGroupBy(), $Cashier_Summary_report_summary->getSqlHaving(), $Cashier_Summary_report_summary->getSqlOrderBy(), $where, $Cashier_Summary_report_summary->Sort);
	$rs = $Cashier_Summary_report_summary->getRecordset($sql);
	$Cashier_Summary_report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Cashier_Summary_report_summary->DetailRecordCount = count($Cashier_Summary_report_summary->DetailRecords);

	// Load detail records
	$Cashier_Summary_report_summary->ReceiptDate->Records = &$Cashier_Summary_report_summary->DetailRecords;
	$Cashier_Summary_report_summary->ReceiptDate->LevelBreak = TRUE; // Set field level break
		$Cashier_Summary_report_summary->GroupCounter[1] = $Cashier_Summary_report_summary->GroupCount;
		$Cashier_Summary_report_summary->ReceiptDate->getCnt($Cashier_Summary_report_summary->ReceiptDate->Records); // Get record count
?>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible && $Cashier_Summary_report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Cashier_Summary_report_summary->resetAttributes();
		$Cashier_Summary_report_summary->RowType = ROWTYPE_TOTAL;
		$Cashier_Summary_report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Cashier_Summary_report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Cashier_Summary_report_summary->RowGroupLevel = 1;
		$Cashier_Summary_report_summary->renderRow();
?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="ReceiptDate" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>>
<?php if ($Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ReceiptDate) == "") { ?>
		<span class="ew-summary-caption Cashier_Summary_report_ReceiptDate"><span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ReceiptDate->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Cashier_Summary_report_ReceiptDate" onclick="ew.sort(event, '<?php echo $Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->ReceiptDate) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->ReceiptDate->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Cashier_Summary_report_summary->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cashier_Summary_report_summary->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Cashier_Summary_report_summary->ReceiptDate->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptDate->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->ReceiptDate->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Cashier_Summary_report_summary->CashierNo->getDistinctValues($Cashier_Summary_report_summary->ReceiptDate->Records);
	$Cashier_Summary_report_summary->setGroupCount(count($Cashier_Summary_report_summary->CashierNo->DistinctValues), $Cashier_Summary_report_summary->GroupCounter[1]);
	$Cashier_Summary_report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Cashier_Summary_report_summary->CashierNo->DistinctValues as $CashierNo) { // Load records for this distinct value
		$Cashier_Summary_report_summary->CashierNo->setGroupValue($CashierNo); // Set group value
		$Cashier_Summary_report_summary->CashierNo->getDistinctRecords($Cashier_Summary_report_summary->ReceiptDate->Records, $Cashier_Summary_report_summary->CashierNo->groupValue());
		$Cashier_Summary_report_summary->CashierNo->LevelBreak = TRUE; // Set field level break
		$Cashier_Summary_report_summary->GroupCounter[2]++;
		$Cashier_Summary_report_summary->CashierNo->getCnt($Cashier_Summary_report_summary->CashierNo->Records); // Get record count
		$Cashier_Summary_report_summary->setGroupCount($Cashier_Summary_report_summary->CashierNo->Count, $Cashier_Summary_report_summary->GroupCounter[1], $Cashier_Summary_report_summary->GroupCounter[2]);
?>
<?php if ($Cashier_Summary_report_summary->CashierNo->Visible && $Cashier_Summary_report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Cashier_Summary_report_summary->CashierNo->setDbValue($CashierNo); // Set current value for CashierNo
		$Cashier_Summary_report_summary->resetAttributes();
		$Cashier_Summary_report_summary->RowType = ROWTYPE_TOTAL;
		$Cashier_Summary_report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Cashier_Summary_report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Cashier_Summary_report_summary->RowGroupLevel = 2;
		$Cashier_Summary_report_summary->renderRow();
?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->CashierNo->Visible) { ?>
		<td data-field="CashierNo"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="CashierNo" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>>
<?php if ($Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->CashierNo) == "") { ?>
		<span class="ew-summary-caption Cashier_Summary_report_CashierNo"><span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->CashierNo->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Cashier_Summary_report_CashierNo" onclick="ew.sort(event, '<?php echo $Cashier_Summary_report_summary->sortUrl($Cashier_Summary_report_summary->CashierNo) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Cashier_Summary_report_summary->CashierNo->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Cashier_Summary_report_summary->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Cashier_Summary_report_summary->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Cashier_Summary_report_summary->CashierNo->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->CashierNo->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->CashierNo->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Cashier_Summary_report_summary->RecordCount = 0; // Reset record count
	foreach ($Cashier_Summary_report_summary->CashierNo->Records as $record) {
		$Cashier_Summary_report_summary->RecordCount++;
		$Cashier_Summary_report_summary->RecordIndex++;
		$Cashier_Summary_report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Cashier_Summary_report_summary->resetAttributes();
		$Cashier_Summary_report_summary->RowType = ROWTYPE_DETAIL;
		$Cashier_Summary_report_summary->renderRow();
?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
	<?php if ($Cashier_Summary_report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes(); ?>><span<?php echo $Cashier_Summary_report_summary->ReceiptDate->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptDate->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->CashierNo->Visible) { ?>
	<?php if ($Cashier_Summary_report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
		<td data-field="CashierNo"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="CashierNo"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes(); ?>><span<?php echo $Cashier_Summary_report_summary->CashierNo->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->CashierNo->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->ChargeDesc->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->ChargeDesc->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ChargeDesc->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Cashier_Summary_report_summary->TotalGroups > 0) { ?>
<?php
	$Cashier_Summary_report_summary->NoOfReceipts->getSum($Cashier_Summary_report_summary->CashierNo->Records); // Get Sum
	$Cashier_Summary_report_summary->ReceiptedTotalAmount->getSum($Cashier_Summary_report_summary->CashierNo->Records); // Get Sum
	$Cashier_Summary_report_summary->resetAttributes();
	$Cashier_Summary_report_summary->RowType = ROWTYPE_TOTAL;
	$Cashier_Summary_report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Cashier_Summary_report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Cashier_Summary_report_summary->RowGroupLevel = 2;
	$Cashier_Summary_report_summary->renderRow();
?>
<?php if ($Cashier_Summary_report_summary->CashierNo->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>>
	<?php if ($Cashier_Summary_report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Cashier_Summary_report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->ReceiptDate->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->CashierNo->Visible) { ?>
		<td data-field="CashierNo"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>>
	<?php if ($Cashier_Summary_report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Cashier_Summary_report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->CashierNo->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->SubGroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Cashier_Summary_report_summary->SubGroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount) ?>"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Cashier_Summary_report_summary->CashierNo->GroupViewValue, $Cashier_Summary_report_summary->CashierNo->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Cashier_Summary_report_summary->CashierNo->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Cashier_Summary_report_summary->GroupColumnCount - 1) ?>"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->CashierNo->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 1
?>
<?php if ($Cashier_Summary_report_summary->TotalGroups > 0) { ?>
<?php
	$Cashier_Summary_report_summary->NoOfReceipts->getSum($Cashier_Summary_report_summary->ReceiptDate->Records); // Get Sum
	$Cashier_Summary_report_summary->ReceiptedTotalAmount->getSum($Cashier_Summary_report_summary->ReceiptDate->Records); // Get Sum
	$Cashier_Summary_report_summary->resetAttributes();
	$Cashier_Summary_report_summary->RowType = ROWTYPE_TOTAL;
	$Cashier_Summary_report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Cashier_Summary_report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Cashier_Summary_report_summary->RowGroupLevel = 1;
	$Cashier_Summary_report_summary->renderRow();
?>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>>
	<?php if ($Cashier_Summary_report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Cashier_Summary_report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->ReceiptDate->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->CashierNo->Visible) { ?>
		<td data-field="CashierNo"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>>
	<?php if ($Cashier_Summary_report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Cashier_Summary_report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->CashierNo->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->GroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Cashier_Summary_report_summary->GroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount) ?>"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Cashier_Summary_report_summary->ReceiptDate->GroupViewValue, $Cashier_Summary_report_summary->ReceiptDate->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Cashier_Summary_report_summary->ReceiptDate->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Cashier_Summary_report_summary->GroupColumnCount - 0) ?>"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->ReceiptDate->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Cashier_Summary_report_summary->loadGroupRowValues();

	// Show header if page break
	if ($Cashier_Summary_report_summary->isExport())
		$Cashier_Summary_report_summary->ShowHeader = ($Cashier_Summary_report_summary->ExportPageBreakCount == 0) ? FALSE : ($Cashier_Summary_report_summary->GroupCount % $Cashier_Summary_report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Cashier_Summary_report_summary->ShowHeader)
		$Cashier_Summary_report_summary->Page_Breaking($Cashier_Summary_report_summary->ShowHeader, $Cashier_Summary_report_summary->PageBreakContent);
	$Cashier_Summary_report_summary->GroupCount++;
} // End while
?>
<?php if ($Cashier_Summary_report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($Cashier_Summary_report_summary->StopGroup - $Cashier_Summary_report_summary->StartGroup + 1) != $Cashier_Summary_report_summary->TotalGroups) { ?>
<?php
	$Cashier_Summary_report_summary->resetAttributes();
	$Cashier_Summary_report_summary->RowType = ROWTYPE_TOTAL;
	$Cashier_Summary_report_summary->RowTotalType = ROWTOTAL_PAGE;
	$Cashier_Summary_report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Cashier_Summary_report_summary->RowAttrs["class"] = "ew-rpt-page-summary";
	$Cashier_Summary_report_summary->renderRow();
?>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>><td colspan="<?php echo ($Cashier_Summary_report_summary->GroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->PageTotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Cashier_Summary_report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->ChargeDesc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->NoOfReceipts->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>><td colspan="<?php echo ($Cashier_Summary_report_summary->GroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Cashier_Summary_report_summary->PageTotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes(); ?>>
<?php if ($Cashier_Summary_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Cashier_Summary_report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->ChargeDesc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	$Cashier_Summary_report_summary->resetAttributes();
	$Cashier_Summary_report_summary->RowType = ROWTYPE_TOTAL;
	$Cashier_Summary_report_summary->RowTotalType = ROWTOTAL_GRAND;
	$Cashier_Summary_report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Cashier_Summary_report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Cashier_Summary_report_summary->renderRow();
?>
<?php if ($Cashier_Summary_report_summary->ReceiptDate->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes() ?>><td colspan="<?php echo ($Cashier_Summary_report_summary->GroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Cashier_Summary_report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes() ?>>
<?php if ($Cashier_Summary_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Cashier_Summary_report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->ChargeDesc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->NoOfReceipts->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes() ?>><td colspan="<?php echo ($Cashier_Summary_report_summary->GroupColumnCount + $Cashier_Summary_report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Cashier_Summary_report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Cashier_Summary_report_summary->rowAttributes() ?>>
<?php if ($Cashier_Summary_report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Cashier_Summary_report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ChargeDesc->Visible) { ?>
		<td data-field="ChargeDesc"<?php echo $Cashier_Summary_report_summary->ChargeDesc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $Cashier_Summary_report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Cashier_Summary_report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $Cashier_Summary_report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Cashier_Summary_report_summary->TotalGroups > 0) { ?>
<?php if (!$Cashier_Summary_report_summary->isExport() && !($Cashier_Summary_report_summary->DrillDown && $Cashier_Summary_report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Cashier_Summary_report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Cashier_Summary_report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Cashier_Summary_report_summary->isExport() || $Cashier_Summary_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Cashier_Summary_report_summary->isExport() || $Cashier_Summary_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Cashier_Summary_report_summary->isExport() || $Cashier_Summary_report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Cashier_Summary_report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Cashier_Summary_report_summary->isExport() && !$Cashier_Summary_report_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$Cashier_Summary_report_summary->terminate();
?>