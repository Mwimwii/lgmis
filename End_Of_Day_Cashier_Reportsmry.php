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
$End_Of_Day_Cashier_Report_summary = new End_Of_Day_Cashier_Report_summary();

// Run the page
$End_Of_Day_Cashier_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$End_Of_Day_Cashier_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport() && !$End_Of_Day_Cashier_Report_summary->DrillDown && !$DashboardReport) { ?>
<script>
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$End_Of_Day_Cashier_Report_summary->isExport() || $End_Of_Day_Cashier_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$End_Of_Day_Cashier_Report_summary->DrillDownInPanel) {
	$End_Of_Day_Cashier_Report_summary->ExportOptions->render("body");
	$End_Of_Day_Cashier_Report_summary->SearchOptions->render("body");
	$End_Of_Day_Cashier_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $End_Of_Day_Cashier_Report_summary->showPageHeader(); ?>
<?php
$End_Of_Day_Cashier_Report_summary->showMessage();
?>
<?php if ((!$End_Of_Day_Cashier_Report_summary->isExport() || $End_Of_Day_Cashier_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$End_Of_Day_Cashier_Report_summary->isExport() || $End_Of_Day_Cashier_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $End_Of_Day_Cashier_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport() && !$End_Of_Day_Cashier_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($End_Of_Day_Cashier_Report_summary->GroupCount <= count($End_Of_Day_Cashier_Report_summary->GroupRecords) && $End_Of_Day_Cashier_Report_summary->GroupCount <= $End_Of_Day_Cashier_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($End_Of_Day_Cashier_Report_summary->ShowHeader) {
?>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->TotalGroups > 0) { ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport() && !($End_Of_Day_Cashier_Report_summary->DrillDown && $End_Of_Day_Cashier_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $End_Of_Day_Cashier_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $End_Of_Day_Cashier_Report_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("word") && !$End_Of_Day_Cashier_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $End_Of_Day_Cashier_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport() && !($End_Of_Day_Cashier_Report_summary->DrillDown && $End_Of_Day_Cashier_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $End_Of_Day_Cashier_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_End_Of_Day_Cashier_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $End_Of_Day_Cashier_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
	<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
	<th data-name="ReceiptDate">&nbsp;</th>
	<?php } else { ?>
		<?php if ($End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->ReceiptDate) == "") { ?>
	<th data-name="ReceiptDate" class="<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->headerCellClass() ?>"><div class="End_Of_Day_Cashier_Report_ReceiptDate"><div class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="ReceiptDate" class="<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->ReceiptDate) ?>', 1);"><div class="End_Of_Day_Cashier_Report_ReceiptDate">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($End_Of_Day_Cashier_Report_summary->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->Visible) { ?>
	<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
	<th data-name="CashierNo">&nbsp;</th>
	<?php } else { ?>
		<?php if ($End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->CashierNo) == "") { ?>
	<th data-name="CashierNo" class="<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->headerCellClass() ?>"><div class="End_Of_Day_Cashier_Report_CashierNo"><div class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="CashierNo" class="<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->CashierNo) ?>', 1);"><div class="End_Of_Day_Cashier_Report_CashierNo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($End_Of_Day_Cashier_Report_summary->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
	<?php if ($End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->PaymentDesc) == "") { ?>
	<th data-name="PaymentDesc" class="<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->headerCellClass() ?>"><div class="End_Of_Day_Cashier_Report_PaymentDesc"><div class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PaymentDesc" class="<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->PaymentDesc) ?>', 1);"><div class="End_Of_Day_Cashier_Report_PaymentDesc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($End_Of_Day_Cashier_Report_summary->PaymentDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
	<?php if ($End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->NoOfReceipts) == "") { ?>
	<th data-name="NoOfReceipts" class="<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->headerCellClass() ?>"><div class="End_Of_Day_Cashier_Report_NoOfReceipts"><div class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NoOfReceipts" class="<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->NoOfReceipts) ?>', 1);"><div class="End_Of_Day_Cashier_Report_NoOfReceipts">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->caption() ?></span><span class="ew-table-header-sort"><?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
	<?php if ($End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount) == "") { ?>
	<th data-name="ReceiptedTotalAmount" class="<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->headerCellClass() ?>"><div class="End_Of_Day_Cashier_Report_ReceiptedTotalAmount"><div class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ReceiptedTotalAmount" class="<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount) ?>', 1);"><div class="End_Of_Day_Cashier_Report_ReceiptedTotalAmount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($End_Of_Day_Cashier_Report_summary->TotalGroups == 0)
			break; // Show header only
		$End_Of_Day_Cashier_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($End_Of_Day_Cashier_Report_summary->ReceiptDate, $End_Of_Day_Cashier_Report_summary->getSqlFirstGroupField(), $End_Of_Day_Cashier_Report_summary->ReceiptDate->groupValue(), $End_Of_Day_Cashier_Report_summary->Dbid);
	if ($End_Of_Day_Cashier_Report_summary->PageFirstGroupFilter != "") $End_Of_Day_Cashier_Report_summary->PageFirstGroupFilter .= " OR ";
	$End_Of_Day_Cashier_Report_summary->PageFirstGroupFilter .= $where;
	if ($End_Of_Day_Cashier_Report_summary->Filter != "")
		$where = "($End_Of_Day_Cashier_Report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($End_Of_Day_Cashier_Report_summary->getSqlSelect(), $End_Of_Day_Cashier_Report_summary->getSqlWhere(), $End_Of_Day_Cashier_Report_summary->getSqlGroupBy(), $End_Of_Day_Cashier_Report_summary->getSqlHaving(), $End_Of_Day_Cashier_Report_summary->getSqlOrderBy(), $where, $End_Of_Day_Cashier_Report_summary->Sort);
	$rs = $End_Of_Day_Cashier_Report_summary->getRecordset($sql);
	$End_Of_Day_Cashier_Report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$End_Of_Day_Cashier_Report_summary->DetailRecordCount = count($End_Of_Day_Cashier_Report_summary->DetailRecords);

	// Load detail records
	$End_Of_Day_Cashier_Report_summary->ReceiptDate->Records = &$End_Of_Day_Cashier_Report_summary->DetailRecords;
	$End_Of_Day_Cashier_Report_summary->ReceiptDate->LevelBreak = TRUE; // Set field level break
		$End_Of_Day_Cashier_Report_summary->GroupCounter[1] = $End_Of_Day_Cashier_Report_summary->GroupCount;
		$End_Of_Day_Cashier_Report_summary->ReceiptDate->getCnt($End_Of_Day_Cashier_Report_summary->ReceiptDate->Records); // Get record count
?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible && $End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$End_Of_Day_Cashier_Report_summary->resetAttributes();
		$End_Of_Day_Cashier_Report_summary->RowType = ROWTYPE_TOTAL;
		$End_Of_Day_Cashier_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$End_Of_Day_Cashier_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$End_Of_Day_Cashier_Report_summary->RowGroupLevel = 1;
		$End_Of_Day_Cashier_Report_summary->renderRow();
?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="ReceiptDate" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->ReceiptDate) == "") { ?>
		<span class="ew-summary-caption End_Of_Day_Cashier_Report_ReceiptDate"><span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption End_Of_Day_Cashier_Report_ReceiptDate" onclick="ew.sort(event, '<?php echo $End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->ReceiptDate) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($End_Of_Day_Cashier_Report_summary->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->ReceiptDate->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$End_Of_Day_Cashier_Report_summary->CashierNo->getDistinctValues($End_Of_Day_Cashier_Report_summary->ReceiptDate->Records);
	$End_Of_Day_Cashier_Report_summary->setGroupCount(count($End_Of_Day_Cashier_Report_summary->CashierNo->DistinctValues), $End_Of_Day_Cashier_Report_summary->GroupCounter[1]);
	$End_Of_Day_Cashier_Report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($End_Of_Day_Cashier_Report_summary->CashierNo->DistinctValues as $CashierNo) { // Load records for this distinct value
		$End_Of_Day_Cashier_Report_summary->CashierNo->setGroupValue($CashierNo); // Set group value
		$End_Of_Day_Cashier_Report_summary->CashierNo->getDistinctRecords($End_Of_Day_Cashier_Report_summary->ReceiptDate->Records, $End_Of_Day_Cashier_Report_summary->CashierNo->groupValue());
		$End_Of_Day_Cashier_Report_summary->CashierNo->LevelBreak = TRUE; // Set field level break
		$End_Of_Day_Cashier_Report_summary->GroupCounter[2]++;
		$End_Of_Day_Cashier_Report_summary->CashierNo->getCnt($End_Of_Day_Cashier_Report_summary->CashierNo->Records); // Get record count
		$End_Of_Day_Cashier_Report_summary->setGroupCount($End_Of_Day_Cashier_Report_summary->CashierNo->Count, $End_Of_Day_Cashier_Report_summary->GroupCounter[1], $End_Of_Day_Cashier_Report_summary->GroupCounter[2]);
?>
<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->Visible && $End_Of_Day_Cashier_Report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$End_Of_Day_Cashier_Report_summary->CashierNo->setDbValue($CashierNo); // Set current value for CashierNo
		$End_Of_Day_Cashier_Report_summary->resetAttributes();
		$End_Of_Day_Cashier_Report_summary->RowType = ROWTYPE_TOTAL;
		$End_Of_Day_Cashier_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$End_Of_Day_Cashier_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$End_Of_Day_Cashier_Report_summary->RowGroupLevel = 2;
		$End_Of_Day_Cashier_Report_summary->renderRow();
?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->Visible) { ?>
		<td data-field="CashierNo"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="CashierNo" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->CashierNo) == "") { ?>
		<span class="ew-summary-caption End_Of_Day_Cashier_Report_CashierNo"><span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption End_Of_Day_Cashier_Report_CashierNo" onclick="ew.sort(event, '<?php echo $End_Of_Day_Cashier_Report_summary->sortUrl($End_Of_Day_Cashier_Report_summary->CashierNo) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($End_Of_Day_Cashier_Report_summary->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->CashierNo->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$End_Of_Day_Cashier_Report_summary->RecordCount = 0; // Reset record count
	foreach ($End_Of_Day_Cashier_Report_summary->CashierNo->Records as $record) {
		$End_Of_Day_Cashier_Report_summary->RecordCount++;
		$End_Of_Day_Cashier_Report_summary->RecordIndex++;
		$End_Of_Day_Cashier_Report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$End_Of_Day_Cashier_Report_summary->resetAttributes();
		$End_Of_Day_Cashier_Report_summary->RowType = ROWTYPE_DETAIL;
		$End_Of_Day_Cashier_Report_summary->renderRow();
?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
	<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes(); ?>><span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->Visible) { ?>
	<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
		<td data-field="CashierNo"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="CashierNo"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes(); ?>><span<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($End_Of_Day_Cashier_Report_summary->TotalGroups > 0) { ?>
<?php
	$End_Of_Day_Cashier_Report_summary->NoOfReceipts->getSum($End_Of_Day_Cashier_Report_summary->CashierNo->Records); // Get Sum
	$End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->getSum($End_Of_Day_Cashier_Report_summary->CashierNo->Records); // Get Sum
	$End_Of_Day_Cashier_Report_summary->resetAttributes();
	$End_Of_Day_Cashier_Report_summary->RowType = ROWTYPE_TOTAL;
	$End_Of_Day_Cashier_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$End_Of_Day_Cashier_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$End_Of_Day_Cashier_Report_summary->RowGroupLevel = 2;
	$End_Of_Day_Cashier_Report_summary->renderRow();
?>
<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>>
	<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($End_Of_Day_Cashier_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->ReceiptDate->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->Visible) { ?>
		<td data-field="CashierNo"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>>
	<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($End_Of_Day_Cashier_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->CashierNo->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->SubGroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->SubGroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount) ?>"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$End_Of_Day_Cashier_Report_summary->CashierNo->GroupViewValue, $End_Of_Day_Cashier_Report_summary->CashierNo->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->CashierNo->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->GroupColumnCount - 1) ?>"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->CashierNo->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 1
?>
<?php if ($End_Of_Day_Cashier_Report_summary->TotalGroups > 0) { ?>
<?php
	$End_Of_Day_Cashier_Report_summary->NoOfReceipts->getSum($End_Of_Day_Cashier_Report_summary->ReceiptDate->Records); // Get Sum
	$End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->getSum($End_Of_Day_Cashier_Report_summary->ReceiptDate->Records); // Get Sum
	$End_Of_Day_Cashier_Report_summary->resetAttributes();
	$End_Of_Day_Cashier_Report_summary->RowType = ROWTYPE_TOTAL;
	$End_Of_Day_Cashier_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$End_Of_Day_Cashier_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$End_Of_Day_Cashier_Report_summary->RowGroupLevel = 1;
	$End_Of_Day_Cashier_Report_summary->renderRow();
?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->Visible) { ?>
		<td data-field="ReceiptDate"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>>
	<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($End_Of_Day_Cashier_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->ReceiptDate->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->Visible) { ?>
		<td data-field="CashierNo"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>>
	<?php if ($End_Of_Day_Cashier_Report_summary->CashierNo->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($End_Of_Day_Cashier_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->CashierNo->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->GroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount) ?>"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$End_Of_Day_Cashier_Report_summary->ReceiptDate->GroupViewValue, $End_Of_Day_Cashier_Report_summary->ReceiptDate->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->ReceiptDate->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->GroupColumnCount - 0) ?>"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptDate->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$End_Of_Day_Cashier_Report_summary->loadGroupRowValues();

	// Show header if page break
	if ($End_Of_Day_Cashier_Report_summary->isExport())
		$End_Of_Day_Cashier_Report_summary->ShowHeader = ($End_Of_Day_Cashier_Report_summary->ExportPageBreakCount == 0) ? FALSE : ($End_Of_Day_Cashier_Report_summary->GroupCount % $End_Of_Day_Cashier_Report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($End_Of_Day_Cashier_Report_summary->ShowHeader)
		$End_Of_Day_Cashier_Report_summary->Page_Breaking($End_Of_Day_Cashier_Report_summary->ShowHeader, $End_Of_Day_Cashier_Report_summary->PageBreakContent);
	$End_Of_Day_Cashier_Report_summary->GroupCount++;
} // End while
?>
<?php if ($End_Of_Day_Cashier_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($End_Of_Day_Cashier_Report_summary->StopGroup - $End_Of_Day_Cashier_Report_summary->StartGroup + 1) != $End_Of_Day_Cashier_Report_summary->TotalGroups) { ?>
<?php
	$End_Of_Day_Cashier_Report_summary->resetAttributes();
	$End_Of_Day_Cashier_Report_summary->RowType = ROWTYPE_TOTAL;
	$End_Of_Day_Cashier_Report_summary->RowTotalType = ROWTOTAL_PAGE;
	$End_Of_Day_Cashier_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$End_Of_Day_Cashier_Report_summary->RowAttrs["class"] = "ew-rpt-page-summary";
	$End_Of_Day_Cashier_Report_summary->renderRow();
?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>><td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->GroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->PageTotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $End_Of_Day_Cashier_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>><td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->GroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->PageTotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes(); ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $End_Of_Day_Cashier_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	$End_Of_Day_Cashier_Report_summary->resetAttributes();
	$End_Of_Day_Cashier_Report_summary->RowType = ROWTYPE_TOTAL;
	$End_Of_Day_Cashier_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$End_Of_Day_Cashier_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$End_Of_Day_Cashier_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$End_Of_Day_Cashier_Report_summary->renderRow();
?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptDate->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->GroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes() ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $End_Of_Day_Cashier_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($End_Of_Day_Cashier_Report_summary->GroupColumnCount + $End_Of_Day_Cashier_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($End_Of_Day_Cashier_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $End_Of_Day_Cashier_Report_summary->rowAttributes() ?>>
<?php if ($End_Of_Day_Cashier_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $End_Of_Day_Cashier_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->PaymentDesc->Visible) { ?>
		<td data-field="PaymentDesc"<?php echo $End_Of_Day_Cashier_Report_summary->PaymentDesc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->NoOfReceipts->Visible) { ?>
		<td data-field="NoOfReceipts"<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->NoOfReceipts->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->Visible) { ?>
		<td data-field="ReceiptedTotalAmount"<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->cellAttributes() ?>>
<span<?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $End_Of_Day_Cashier_Report_summary->ReceiptedTotalAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($End_Of_Day_Cashier_Report_summary->TotalGroups > 0) { ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport() && !($End_Of_Day_Cashier_Report_summary->DrillDown && $End_Of_Day_Cashier_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $End_Of_Day_Cashier_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$End_Of_Day_Cashier_Report_summary->isExport() || $End_Of_Day_Cashier_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$End_Of_Day_Cashier_Report_summary->isExport() || $End_Of_Day_Cashier_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$End_Of_Day_Cashier_Report_summary->isExport() || $End_Of_Day_Cashier_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$End_Of_Day_Cashier_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$End_Of_Day_Cashier_Report_summary->isExport() && !$End_Of_Day_Cashier_Report_summary->DrillDown && !$DashboardReport) { ?>
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
$End_Of_Day_Cashier_Report_summary->terminate();
?>