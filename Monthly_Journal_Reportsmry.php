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
$Monthly_Journal_Report_summary = new Monthly_Journal_Report_summary();

// Run the page
$Monthly_Journal_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Monthly_Journal_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport() && !$Monthly_Journal_Report_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Monthly_Journal_Report_summary->isExport() || $Monthly_Journal_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Monthly_Journal_Report_summary->DrillDownInPanel) {
	$Monthly_Journal_Report_summary->ExportOptions->render("body");
	$Monthly_Journal_Report_summary->SearchOptions->render("body");
	$Monthly_Journal_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Monthly_Journal_Report_summary->showPageHeader(); ?>
<?php
$Monthly_Journal_Report_summary->showMessage();
?>
<?php if ((!$Monthly_Journal_Report_summary->isExport() || $Monthly_Journal_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Monthly_Journal_Report_summary->isExport() || $Monthly_Journal_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Monthly_Journal_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport() && !$Monthly_Journal_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Monthly_Journal_Report_summary->GroupCount <= count($Monthly_Journal_Report_summary->GroupRecords) && $Monthly_Journal_Report_summary->GroupCount <= $Monthly_Journal_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Monthly_Journal_Report_summary->ShowHeader) {
?>
<?php if ($Monthly_Journal_Report_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Monthly_Journal_Report_summary->isExport() && !($Monthly_Journal_Report_summary->DrillDown && $Monthly_Journal_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Monthly_Journal_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Monthly_Journal_Report_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Monthly_Journal_Report_summary->isExport("word") && !$Monthly_Journal_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Monthly_Journal_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport() && !($Monthly_Journal_Report_summary->DrillDown && $Monthly_Journal_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Monthly_Journal_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Monthly_Journal_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Monthly_Journal_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Monthly_Journal_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $Monthly_Journal_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="Monthly_Journal_Report_LocalAuthority"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $Monthly_Journal_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->LocalAuthority) ?>', 1);"><div class="Monthly_Journal_Report_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->Period->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->Period->ShowGroupHeaderAsRow) { ?>
	<th data-name="Period">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->Period) == "") { ?>
	<th data-name="Period" class="<?php echo $Monthly_Journal_Report_summary->Period->headerCellClass() ?>"><div class="Monthly_Journal_Report_Period"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->Period->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="Period" class="<?php echo $Monthly_Journal_Report_summary->Period->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->Period) ?>', 1);"><div class="Monthly_Journal_Report_Period">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->Period->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->Period->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->Period->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->AmtType->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->AmtType) == "") { ?>
	<th data-name="AmtType" class="<?php echo $Monthly_Journal_Report_summary->AmtType->headerCellClass() ?>"><div class="Monthly_Journal_Report_AmtType"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->AmtType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="AmtType" class="<?php echo $Monthly_Journal_Report_summary->AmtType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->AmtType) ?>', 1);"><div class="Monthly_Journal_Report_AmtType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->AmtType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->AmtType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->AmtType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeCode->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->IncomeCode) == "") { ?>
	<th data-name="IncomeCode" class="<?php echo $Monthly_Journal_Report_summary->IncomeCode->headerCellClass() ?>"><div class="Monthly_Journal_Report_IncomeCode"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="IncomeCode" class="<?php echo $Monthly_Journal_Report_summary->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->IncomeCode) ?>', 1);"><div class="Monthly_Journal_Report_IncomeCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->IncomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeName->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->IncomeName) == "") { ?>
	<th data-name="IncomeName" class="<?php echo $Monthly_Journal_Report_summary->IncomeName->headerCellClass() ?>"><div class="Monthly_Journal_Report_IncomeName"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->IncomeName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="IncomeName" class="<?php echo $Monthly_Journal_Report_summary->IncomeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->IncomeName) ?>', 1);"><div class="Monthly_Journal_Report_IncomeName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->IncomeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->IncomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->IncomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeAmount->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->IncomeAmount) == "") { ?>
	<th data-name="IncomeAmount" class="<?php echo $Monthly_Journal_Report_summary->IncomeAmount->headerCellClass() ?>"><div class="Monthly_Journal_Report_IncomeAmount"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->IncomeAmount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="IncomeAmount" class="<?php echo $Monthly_Journal_Report_summary->IncomeAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->IncomeAmount) ?>', 1);"><div class="Monthly_Journal_Report_IncomeAmount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->IncomeAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->IncomeAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->IncomeAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionCode->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->DeductionCode) == "") { ?>
	<th data-name="DeductionCode" class="<?php echo $Monthly_Journal_Report_summary->DeductionCode->headerCellClass() ?>"><div class="Monthly_Journal_Report_DeductionCode"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DeductionCode" class="<?php echo $Monthly_Journal_Report_summary->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->DeductionCode) ?>', 1);"><div class="Monthly_Journal_Report_DeductionCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->DeductionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionName->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->DeductionName) == "") { ?>
	<th data-name="DeductionName" class="<?php echo $Monthly_Journal_Report_summary->DeductionName->headerCellClass() ?>"><div class="Monthly_Journal_Report_DeductionName"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DeductionName" class="<?php echo $Monthly_Journal_Report_summary->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->DeductionName) ?>', 1);"><div class="Monthly_Journal_Report_DeductionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->DeductionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionAmount->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->DeductionAmount) == "") { ?>
	<th data-name="DeductionAmount" class="<?php echo $Monthly_Journal_Report_summary->DeductionAmount->headerCellClass() ?>"><div class="Monthly_Journal_Report_DeductionAmount"><div class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DeductionAmount" class="<?php echo $Monthly_Journal_Report_summary->DeductionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->DeductionAmount) ?>', 1);"><div class="Monthly_Journal_Report_DeductionAmount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Monthly_Journal_Report_summary->TotalGroups == 0)
			break; // Show header only
		$Monthly_Journal_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Monthly_Journal_Report_summary->LocalAuthority, $Monthly_Journal_Report_summary->getSqlFirstGroupField(), $Monthly_Journal_Report_summary->LocalAuthority->groupValue(), $Monthly_Journal_Report_summary->Dbid);
	if ($Monthly_Journal_Report_summary->PageFirstGroupFilter != "") $Monthly_Journal_Report_summary->PageFirstGroupFilter .= " OR ";
	$Monthly_Journal_Report_summary->PageFirstGroupFilter .= $where;
	if ($Monthly_Journal_Report_summary->Filter != "")
		$where = "($Monthly_Journal_Report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Monthly_Journal_Report_summary->getSqlSelect(), $Monthly_Journal_Report_summary->getSqlWhere(), $Monthly_Journal_Report_summary->getSqlGroupBy(), $Monthly_Journal_Report_summary->getSqlHaving(), $Monthly_Journal_Report_summary->getSqlOrderBy(), $where, $Monthly_Journal_Report_summary->Sort);
	$rs = $Monthly_Journal_Report_summary->getRecordset($sql);
	$Monthly_Journal_Report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Monthly_Journal_Report_summary->DetailRecordCount = count($Monthly_Journal_Report_summary->DetailRecords);

	// Load detail records
	$Monthly_Journal_Report_summary->LocalAuthority->Records = &$Monthly_Journal_Report_summary->DetailRecords;
	$Monthly_Journal_Report_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$Monthly_Journal_Report_summary->GroupCounter[1] = $Monthly_Journal_Report_summary->GroupCount;
		$Monthly_Journal_Report_summary->LocalAuthority->getCnt($Monthly_Journal_Report_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($Monthly_Journal_Report_summary->LocalAuthority->Visible && $Monthly_Journal_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Monthly_Journal_Report_summary->resetAttributes();
		$Monthly_Journal_Report_summary->RowType = ROWTYPE_TOTAL;
		$Monthly_Journal_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Monthly_Journal_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Monthly_Journal_Report_summary->RowGroupLevel = 1;
		$Monthly_Journal_Report_summary->renderRow();
?>
	<tr<?php echo $Monthly_Journal_Report_summary->rowAttributes(); ?>>
<?php if ($Monthly_Journal_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Monthly_Journal_Report_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Monthly_Journal_Report_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption Monthly_Journal_Report_LocalAuthority"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Monthly_Journal_Report_LocalAuthority" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Monthly_Journal_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Monthly_Journal_Report_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Monthly_Journal_Report_summary->Period->getDistinctValues($Monthly_Journal_Report_summary->LocalAuthority->Records);
	$Monthly_Journal_Report_summary->setGroupCount(count($Monthly_Journal_Report_summary->Period->DistinctValues), $Monthly_Journal_Report_summary->GroupCounter[1]);
	$Monthly_Journal_Report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Monthly_Journal_Report_summary->Period->DistinctValues as $Period) { // Load records for this distinct value
		$Monthly_Journal_Report_summary->Period->setGroupValue($Period); // Set group value
		$Monthly_Journal_Report_summary->Period->getDistinctRecords($Monthly_Journal_Report_summary->LocalAuthority->Records, $Monthly_Journal_Report_summary->Period->groupValue());
		$Monthly_Journal_Report_summary->Period->LevelBreak = TRUE; // Set field level break
		$Monthly_Journal_Report_summary->GroupCounter[2]++;
		$Monthly_Journal_Report_summary->Period->getCnt($Monthly_Journal_Report_summary->Period->Records); // Get record count
		$Monthly_Journal_Report_summary->setGroupCount($Monthly_Journal_Report_summary->Period->Count, $Monthly_Journal_Report_summary->GroupCounter[1], $Monthly_Journal_Report_summary->GroupCounter[2]);
?>
<?php if ($Monthly_Journal_Report_summary->Period->Visible && $Monthly_Journal_Report_summary->Period->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Monthly_Journal_Report_summary->Period->setDbValue($Period); // Set current value for Period
		$Monthly_Journal_Report_summary->resetAttributes();
		$Monthly_Journal_Report_summary->RowType = ROWTYPE_TOTAL;
		$Monthly_Journal_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Monthly_Journal_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Monthly_Journal_Report_summary->RowGroupLevel = 2;
		$Monthly_Journal_Report_summary->renderRow();
?>
	<tr<?php echo $Monthly_Journal_Report_summary->rowAttributes(); ?>>
<?php if ($Monthly_Journal_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Monthly_Journal_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->Period->Visible) { ?>
		<td data-field="Period"<?php echo $Monthly_Journal_Report_summary->Period->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="Period" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Monthly_Journal_Report_summary->Period->cellAttributes() ?>>
<?php if ($Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->Period) == "") { ?>
		<span class="ew-summary-caption Monthly_Journal_Report_Period"><span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->Period->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Monthly_Journal_Report_Period" onclick="ew.sort(event, '<?php echo $Monthly_Journal_Report_summary->sortUrl($Monthly_Journal_Report_summary->Period) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Journal_Report_summary->Period->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Journal_Report_summary->Period->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Journal_Report_summary->Period->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Monthly_Journal_Report_summary->Period->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->Period->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Monthly_Journal_Report_summary->Period->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Monthly_Journal_Report_summary->RecordCount = 0; // Reset record count
	foreach ($Monthly_Journal_Report_summary->Period->Records as $record) {
		$Monthly_Journal_Report_summary->RecordCount++;
		$Monthly_Journal_Report_summary->RecordIndex++;
		$Monthly_Journal_Report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Monthly_Journal_Report_summary->resetAttributes();
		$Monthly_Journal_Report_summary->RowType = ROWTYPE_DETAIL;
		$Monthly_Journal_Report_summary->renderRow();
?>
	<tr<?php echo $Monthly_Journal_Report_summary->rowAttributes(); ?>>
<?php if ($Monthly_Journal_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $Monthly_Journal_Report_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $Monthly_Journal_Report_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $Monthly_Journal_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->Period->Visible) { ?>
	<?php if ($Monthly_Journal_Report_summary->Period->ShowGroupHeaderAsRow) { ?>
		<td data-field="Period"<?php echo $Monthly_Journal_Report_summary->Period->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="Period"<?php echo $Monthly_Journal_Report_summary->Period->cellAttributes(); ?>><span<?php echo $Monthly_Journal_Report_summary->Period->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->Period->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->AmtType->Visible) { ?>
		<td data-field="AmtType"<?php echo $Monthly_Journal_Report_summary->AmtType->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->AmtType->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->AmtType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeCode->Visible) { ?>
		<td data-field="IncomeCode"<?php echo $Monthly_Journal_Report_summary->IncomeCode->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->IncomeCode->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->IncomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeName->Visible) { ?>
		<td data-field="IncomeName"<?php echo $Monthly_Journal_Report_summary->IncomeName->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->IncomeName->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->IncomeName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeAmount->Visible) { ?>
		<td data-field="IncomeAmount"<?php echo $Monthly_Journal_Report_summary->IncomeAmount->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->IncomeAmount->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->IncomeAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionCode->Visible) { ?>
		<td data-field="DeductionCode"<?php echo $Monthly_Journal_Report_summary->DeductionCode->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->DeductionCode->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->DeductionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionName->Visible) { ?>
		<td data-field="DeductionName"<?php echo $Monthly_Journal_Report_summary->DeductionName->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->DeductionName->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->DeductionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionAmount->Visible) { ?>
		<td data-field="DeductionAmount"<?php echo $Monthly_Journal_Report_summary->DeductionAmount->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->DeductionAmount->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->DeductionAmount->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
	} // End group level 1
?>
<?php

	// Next group
	$Monthly_Journal_Report_summary->loadGroupRowValues();

	// Show header if page break
	if ($Monthly_Journal_Report_summary->isExport())
		$Monthly_Journal_Report_summary->ShowHeader = ($Monthly_Journal_Report_summary->ExportPageBreakCount == 0) ? FALSE : ($Monthly_Journal_Report_summary->GroupCount % $Monthly_Journal_Report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Monthly_Journal_Report_summary->ShowHeader)
		$Monthly_Journal_Report_summary->Page_Breaking($Monthly_Journal_Report_summary->ShowHeader, $Monthly_Journal_Report_summary->PageBreakContent);
	$Monthly_Journal_Report_summary->GroupCount++;
} // End while
?>
<?php if ($Monthly_Journal_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Monthly_Journal_Report_summary->resetAttributes();
	$Monthly_Journal_Report_summary->RowType = ROWTYPE_TOTAL;
	$Monthly_Journal_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$Monthly_Journal_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Monthly_Journal_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Monthly_Journal_Report_summary->renderRow();
?>
<?php if ($Monthly_Journal_Report_summary->LocalAuthority->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Monthly_Journal_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Monthly_Journal_Report_summary->GroupColumnCount + $Monthly_Journal_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Monthly_Journal_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Monthly_Journal_Report_summary->rowAttributes() ?>>
<?php if ($Monthly_Journal_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Monthly_Journal_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->AmtType->Visible) { ?>
		<td data-field="AmtType"<?php echo $Monthly_Journal_Report_summary->AmtType->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeCode->Visible) { ?>
		<td data-field="IncomeCode"<?php echo $Monthly_Journal_Report_summary->IncomeCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeName->Visible) { ?>
		<td data-field="IncomeName"<?php echo $Monthly_Journal_Report_summary->IncomeName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeAmount->Visible) { ?>
		<td data-field="IncomeAmount"<?php echo $Monthly_Journal_Report_summary->IncomeAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Monthly_Journal_Report_summary->IncomeAmount->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->IncomeAmount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionCode->Visible) { ?>
		<td data-field="DeductionCode"<?php echo $Monthly_Journal_Report_summary->DeductionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionName->Visible) { ?>
		<td data-field="DeductionName"<?php echo $Monthly_Journal_Report_summary->DeductionName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionAmount->Visible) { ?>
		<td data-field="DeductionAmount"<?php echo $Monthly_Journal_Report_summary->DeductionAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Monthly_Journal_Report_summary->DeductionAmount->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->DeductionAmount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Monthly_Journal_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Monthly_Journal_Report_summary->GroupColumnCount + $Monthly_Journal_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Monthly_Journal_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Monthly_Journal_Report_summary->rowAttributes() ?>>
<?php if ($Monthly_Journal_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Monthly_Journal_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->AmtType->Visible) { ?>
		<td data-field="AmtType"<?php echo $Monthly_Journal_Report_summary->AmtType->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeCode->Visible) { ?>
		<td data-field="IncomeCode"<?php echo $Monthly_Journal_Report_summary->IncomeCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeName->Visible) { ?>
		<td data-field="IncomeName"<?php echo $Monthly_Journal_Report_summary->IncomeName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->IncomeAmount->Visible) { ?>
		<td data-field="IncomeAmount"<?php echo $Monthly_Journal_Report_summary->IncomeAmount->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->IncomeAmount->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->IncomeAmount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionCode->Visible) { ?>
		<td data-field="DeductionCode"<?php echo $Monthly_Journal_Report_summary->DeductionCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionName->Visible) { ?>
		<td data-field="DeductionName"<?php echo $Monthly_Journal_Report_summary->DeductionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->DeductionAmount->Visible) { ?>
		<td data-field="DeductionAmount"<?php echo $Monthly_Journal_Report_summary->DeductionAmount->cellAttributes() ?>>
<span<?php echo $Monthly_Journal_Report_summary->DeductionAmount->viewAttributes() ?>><?php echo $Monthly_Journal_Report_summary->DeductionAmount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Monthly_Journal_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Monthly_Journal_Report_summary->isExport() && !($Monthly_Journal_Report_summary->DrillDown && $Monthly_Journal_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Monthly_Journal_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Monthly_Journal_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Monthly_Journal_Report_summary->isExport() || $Monthly_Journal_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Monthly_Journal_Report_summary->isExport() || $Monthly_Journal_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Monthly_Journal_Report_summary->isExport() || $Monthly_Journal_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Monthly_Journal_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Monthly_Journal_Report_summary->isExport() && !$Monthly_Journal_Report_summary->DrillDown && !$DashboardReport) { ?>
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
$Monthly_Journal_Report_summary->terminate();
?>