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
$Programme_Outputs_summary = new Programme_Outputs_summary();

// Run the page
$Programme_Outputs_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Programme_Outputs_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport() && !$Programme_Outputs_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Programme_Outputs_summary->isExport() || $Programme_Outputs_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Programme_Outputs_summary->DrillDownInPanel) {
	$Programme_Outputs_summary->ExportOptions->render("body");
	$Programme_Outputs_summary->SearchOptions->render("body");
	$Programme_Outputs_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Programme_Outputs_summary->showPageHeader(); ?>
<?php
$Programme_Outputs_summary->showMessage();
?>
<?php if ((!$Programme_Outputs_summary->isExport() || $Programme_Outputs_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Programme_Outputs_summary->isExport() || $Programme_Outputs_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Programme_Outputs_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport() && !$Programme_Outputs_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Programme_Outputs_summary->GroupCount <= count($Programme_Outputs_summary->GroupRecords) && $Programme_Outputs_summary->GroupCount <= $Programme_Outputs_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Programme_Outputs_summary->ShowHeader) {
?>
<?php if ($Programme_Outputs_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Programme_Outputs_summary->TotalGroups > 0) { ?>
<?php if (!$Programme_Outputs_summary->isExport() && !($Programme_Outputs_summary->DrillDown && $Programme_Outputs_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Programme_Outputs_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Programme_Outputs_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Programme_Outputs_summary->isExport("word") && !$Programme_Outputs_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Programme_Outputs_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport() && !($Programme_Outputs_summary->DrillDown && $Programme_Outputs_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Programme_Outputs_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Programme_Outputs" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Programme_Outputs_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
	<?php if ($Programme_Outputs_summary->LAName->ShowGroupHeaderAsRow) { ?>
	<th data-name="LAName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->LAName) == "") { ?>
	<th data-name="LAName" class="<?php echo $Programme_Outputs_summary->LAName->headerCellClass() ?>"><div class="Programme_Outputs_LAName"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->LAName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LAName" class="<?php echo $Programme_Outputs_summary->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->LAName) ?>', 1);"><div class="Programme_Outputs_LAName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramPurpose->Visible) { ?>
	<?php if ($Programme_Outputs_summary->ProgramPurpose->ShowGroupHeaderAsRow) { ?>
	<th data-name="ProgramPurpose">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ProgramPurpose) == "") { ?>
	<th data-name="ProgramPurpose" class="<?php echo $Programme_Outputs_summary->ProgramPurpose->headerCellClass() ?>"><div class="Programme_Outputs_ProgramPurpose"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ProgramPurpose->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="ProgramPurpose" class="<?php echo $Programme_Outputs_summary->ProgramPurpose->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ProgramPurpose) ?>', 1);"><div class="Programme_Outputs_ProgramPurpose">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ProgramPurpose->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->ProgramPurpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->ProgramPurpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ProgramName) == "") { ?>
	<th data-name="ProgramName" class="<?php echo $Programme_Outputs_summary->ProgramName->headerCellClass() ?>"><div class="Programme_Outputs_ProgramName"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ProgramName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ProgramName" class="<?php echo $Programme_Outputs_summary->ProgramName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ProgramName) ?>', 1);"><div class="Programme_Outputs_ProgramName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ProgramName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->ProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->ProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->OutputName) == "") { ?>
	<th data-name="OutputName" class="<?php echo $Programme_Outputs_summary->OutputName->headerCellClass() ?>"><div class="Programme_Outputs_OutputName"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->OutputName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="OutputName" class="<?php echo $Programme_Outputs_summary->OutputName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->OutputName) ?>', 1);"><div class="Programme_Outputs_OutputName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->OutputName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->OutputName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->OutputName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->OutputType) == "") { ?>
	<th data-name="OutputType" class="<?php echo $Programme_Outputs_summary->OutputType->headerCellClass() ?>"><div class="Programme_Outputs_OutputType"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->OutputType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="OutputType" class="<?php echo $Programme_Outputs_summary->OutputType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->OutputType) ?>', 1);"><div class="Programme_Outputs_OutputType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->OutputType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->OutputType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->OutputType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->FinancialYear) == "") { ?>
	<th data-name="FinancialYear" class="<?php echo $Programme_Outputs_summary->FinancialYear->headerCellClass() ?>"><div class="Programme_Outputs_FinancialYear"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->FinancialYear->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FinancialYear" class="<?php echo $Programme_Outputs_summary->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->FinancialYear) ?>', 1);"><div class="Programme_Outputs_FinancialYear">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->OutputIndicatorName) == "") { ?>
	<th data-name="OutputIndicatorName" class="<?php echo $Programme_Outputs_summary->OutputIndicatorName->headerCellClass() ?>"><div class="Programme_Outputs_OutputIndicatorName"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->OutputIndicatorName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="OutputIndicatorName" class="<?php echo $Programme_Outputs_summary->OutputIndicatorName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->OutputIndicatorName) ?>', 1);"><div class="Programme_Outputs_OutputIndicatorName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->OutputIndicatorName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->OutputIndicatorName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->OutputIndicatorName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->TargetAmount) == "") { ?>
	<th data-name="TargetAmount" class="<?php echo $Programme_Outputs_summary->TargetAmount->headerCellClass() ?>"><div class="Programme_Outputs_TargetAmount"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->TargetAmount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="TargetAmount" class="<?php echo $Programme_Outputs_summary->TargetAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->TargetAmount) ?>', 1);"><div class="Programme_Outputs_TargetAmount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->TargetAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->TargetAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->TargetAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ActualAmount) == "") { ?>
	<th data-name="ActualAmount" class="<?php echo $Programme_Outputs_summary->ActualAmount->headerCellClass() ?>"><div class="Programme_Outputs_ActualAmount"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ActualAmount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ActualAmount" class="<?php echo $Programme_Outputs_summary->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ActualAmount) ?>', 1);"><div class="Programme_Outputs_ActualAmount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
	<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->PercentAchieved) == "") { ?>
	<th data-name="PercentAchieved" class="<?php echo $Programme_Outputs_summary->PercentAchieved->headerCellClass() ?>"><div class="Programme_Outputs_PercentAchieved"><div class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->PercentAchieved->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PercentAchieved" class="<?php echo $Programme_Outputs_summary->PercentAchieved->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->PercentAchieved) ?>', 1);"><div class="Programme_Outputs_PercentAchieved">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->PercentAchieved->caption() ?></span><span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->PercentAchieved->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->PercentAchieved->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Programme_Outputs_summary->TotalGroups == 0)
			break; // Show header only
		$Programme_Outputs_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Programme_Outputs_summary->LAName, $Programme_Outputs_summary->getSqlFirstGroupField(), $Programme_Outputs_summary->LAName->groupValue(), $Programme_Outputs_summary->Dbid);
	if ($Programme_Outputs_summary->PageFirstGroupFilter != "") $Programme_Outputs_summary->PageFirstGroupFilter .= " OR ";
	$Programme_Outputs_summary->PageFirstGroupFilter .= $where;
	if ($Programme_Outputs_summary->Filter != "")
		$where = "($Programme_Outputs_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Programme_Outputs_summary->getSqlSelect(), $Programme_Outputs_summary->getSqlWhere(), $Programme_Outputs_summary->getSqlGroupBy(), $Programme_Outputs_summary->getSqlHaving(), $Programme_Outputs_summary->getSqlOrderBy(), $where, $Programme_Outputs_summary->Sort);
	$rs = $Programme_Outputs_summary->getRecordset($sql);
	$Programme_Outputs_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Programme_Outputs_summary->DetailRecordCount = count($Programme_Outputs_summary->DetailRecords);

	// Load detail records
	$Programme_Outputs_summary->LAName->Records = &$Programme_Outputs_summary->DetailRecords;
	$Programme_Outputs_summary->LAName->LevelBreak = TRUE; // Set field level break
		$Programme_Outputs_summary->GroupCounter[1] = $Programme_Outputs_summary->GroupCount;
		$Programme_Outputs_summary->LAName->getCnt($Programme_Outputs_summary->LAName->Records); // Get record count
?>
<?php if ($Programme_Outputs_summary->LAName->Visible && $Programme_Outputs_summary->LAName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Programme_Outputs_summary->resetAttributes();
		$Programme_Outputs_summary->RowType = ROWTYPE_TOTAL;
		$Programme_Outputs_summary->RowTotalType = ROWTOTAL_GROUP;
		$Programme_Outputs_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Programme_Outputs_summary->RowGroupLevel = 1;
		$Programme_Outputs_summary->renderRow();
?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LAName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Programme_Outputs_summary->LAName->cellAttributes() ?>>
<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->LAName) == "") { ?>
		<span class="ew-summary-caption Programme_Outputs_LAName"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->LAName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Programme_Outputs_LAName" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->LAName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->LAName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Programme_Outputs_summary->LAName->viewAttributes() ?>><?php echo $Programme_Outputs_summary->LAName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Programme_Outputs_summary->LAName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Programme_Outputs_summary->ProgramPurpose->getDistinctValues($Programme_Outputs_summary->LAName->Records);
	$Programme_Outputs_summary->setGroupCount(count($Programme_Outputs_summary->ProgramPurpose->DistinctValues), $Programme_Outputs_summary->GroupCounter[1]);
	$Programme_Outputs_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Programme_Outputs_summary->ProgramPurpose->DistinctValues as $ProgramPurpose) { // Load records for this distinct value
		$Programme_Outputs_summary->ProgramPurpose->setGroupValue($ProgramPurpose); // Set group value
		$Programme_Outputs_summary->ProgramPurpose->getDistinctRecords($Programme_Outputs_summary->LAName->Records, $Programme_Outputs_summary->ProgramPurpose->groupValue());
		$Programme_Outputs_summary->ProgramPurpose->LevelBreak = TRUE; // Set field level break
		$Programme_Outputs_summary->GroupCounter[2]++;
		$Programme_Outputs_summary->ProgramPurpose->getCnt($Programme_Outputs_summary->ProgramPurpose->Records); // Get record count
		$Programme_Outputs_summary->setGroupCount($Programme_Outputs_summary->ProgramPurpose->Count, $Programme_Outputs_summary->GroupCounter[1], $Programme_Outputs_summary->GroupCounter[2]);
?>
<?php if ($Programme_Outputs_summary->ProgramPurpose->Visible && $Programme_Outputs_summary->ProgramPurpose->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Programme_Outputs_summary->ProgramPurpose->setDbValue($ProgramPurpose); // Set current value for ProgramPurpose
		$Programme_Outputs_summary->resetAttributes();
		$Programme_Outputs_summary->RowType = ROWTYPE_TOTAL;
		$Programme_Outputs_summary->RowTotalType = ROWTOTAL_GROUP;
		$Programme_Outputs_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Programme_Outputs_summary->RowGroupLevel = 2;
		$Programme_Outputs_summary->renderRow();
?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramPurpose->Visible) { ?>
		<td data-field="ProgramPurpose"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="ProgramPurpose" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>
<?php if ($Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ProgramPurpose) == "") { ?>
		<span class="ew-summary-caption Programme_Outputs_ProgramPurpose"><span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ProgramPurpose->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Programme_Outputs_ProgramPurpose" onclick="ew.sort(event, '<?php echo $Programme_Outputs_summary->sortUrl($Programme_Outputs_summary->ProgramPurpose) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Programme_Outputs_summary->ProgramPurpose->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Programme_Outputs_summary->ProgramPurpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Programme_Outputs_summary->ProgramPurpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Programme_Outputs_summary->ProgramPurpose->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ProgramPurpose->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Programme_Outputs_summary->ProgramPurpose->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Programme_Outputs_summary->RecordCount = 0; // Reset record count
	foreach ($Programme_Outputs_summary->ProgramPurpose->Records as $record) {
		$Programme_Outputs_summary->RecordCount++;
		$Programme_Outputs_summary->RecordIndex++;
		$Programme_Outputs_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Programme_Outputs_summary->resetAttributes();
		$Programme_Outputs_summary->RowType = ROWTYPE_DETAIL;
		$Programme_Outputs_summary->renderRow();
?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
	<?php if ($Programme_Outputs_summary->LAName->ShowGroupHeaderAsRow) { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes(); ?>><span<?php echo $Programme_Outputs_summary->LAName->viewAttributes() ?>><?php echo $Programme_Outputs_summary->LAName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramPurpose->Visible) { ?>
	<?php if ($Programme_Outputs_summary->ProgramPurpose->ShowGroupHeaderAsRow) { ?>
		<td data-field="ProgramPurpose"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="ProgramPurpose"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes(); ?>><span<?php echo $Programme_Outputs_summary->ProgramPurpose->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ProgramPurpose->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramName->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->ProgramName->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ProgramName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->OutputName->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->OutputName->viewAttributes() ?>><?php echo $Programme_Outputs_summary->OutputName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->OutputType->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->OutputType->viewAttributes() ?>><?php echo $Programme_Outputs_summary->OutputType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->FinancialYear->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->FinancialYear->viewAttributes() ?>><?php echo $Programme_Outputs_summary->FinancialYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->OutputIndicatorName->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->OutputIndicatorName->viewAttributes() ?>><?php echo $Programme_Outputs_summary->OutputIndicatorName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->TargetAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->TargetAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->ActualAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ActualAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->PercentAchieved->viewAttributes() ?>><?php echo $Programme_Outputs_summary->PercentAchieved->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Programme_Outputs_summary->TotalGroups > 0) { ?>
<?php
	$Programme_Outputs_summary->TargetAmount->getSum($Programme_Outputs_summary->ProgramPurpose->Records); // Get Sum
	$Programme_Outputs_summary->ActualAmount->getSum($Programme_Outputs_summary->ProgramPurpose->Records); // Get Sum
	$Programme_Outputs_summary->PercentAchieved->getAvg($Programme_Outputs_summary->ProgramPurpose->Records); // Get Avg
	$Programme_Outputs_summary->resetAttributes();
	$Programme_Outputs_summary->RowType = ROWTYPE_TOTAL;
	$Programme_Outputs_summary->RowTotalType = ROWTOTAL_GROUP;
	$Programme_Outputs_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Programme_Outputs_summary->RowGroupLevel = 2;
	$Programme_Outputs_summary->renderRow();
?>
<?php if ($Programme_Outputs_summary->ProgramPurpose->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes() ?>>
	<?php if ($Programme_Outputs_summary->LAName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Programme_Outputs_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Programme_Outputs_summary->LAName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramPurpose->Visible) { ?>
		<td data-field="ProgramPurpose"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>
	<?php if ($Programme_Outputs_summary->ProgramPurpose->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Programme_Outputs_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Programme_Outputs_summary->ProgramPurpose->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->TargetAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->TargetAmount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->ActualAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ActualAmount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptAvg") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->PercentAchieved->viewAttributes() ?>><?php echo $Programme_Outputs_summary->PercentAchieved->AvgViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->SubGroupColumnCount + $Programme_Outputs_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Programme_Outputs_summary->SubGroupColumnCount + $Programme_Outputs_summary->DetailColumnCount) ?>"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Programme_Outputs_summary->ProgramPurpose->GroupViewValue, $Programme_Outputs_summary->ProgramPurpose->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Programme_Outputs_summary->ProgramPurpose->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Programme_Outputs_summary->GroupColumnCount - 1) ?>"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->TargetAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->TargetAmount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->ActualAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ActualAmount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->LAName->Visible) { ?>
		<td data-field="LAName"<?php echo $Programme_Outputs_summary->LAName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Programme_Outputs_summary->GroupColumnCount - 1) ?>"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>><?php echo $Language->phrase("RptAvg") ?></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ProgramPurpose->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->PercentAchieved->viewAttributes() ?>><?php echo $Programme_Outputs_summary->PercentAchieved->AvgViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 1
?>
<?php

	// Next group
	$Programme_Outputs_summary->loadGroupRowValues();

	// Show header if page break
	if ($Programme_Outputs_summary->isExport())
		$Programme_Outputs_summary->ShowHeader = ($Programme_Outputs_summary->ExportPageBreakCount == 0) ? FALSE : ($Programme_Outputs_summary->GroupCount % $Programme_Outputs_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Programme_Outputs_summary->ShowHeader)
		$Programme_Outputs_summary->Page_Breaking($Programme_Outputs_summary->ShowHeader, $Programme_Outputs_summary->PageBreakContent);
	$Programme_Outputs_summary->GroupCount++;
} // End while
?>
<?php if ($Programme_Outputs_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($Programme_Outputs_summary->StopGroup - $Programme_Outputs_summary->StartGroup + 1) != $Programme_Outputs_summary->TotalGroups) { ?>
<?php
	$Programme_Outputs_summary->resetAttributes();
	$Programme_Outputs_summary->RowType = ROWTYPE_TOTAL;
	$Programme_Outputs_summary->RowTotalType = ROWTOTAL_PAGE;
	$Programme_Outputs_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Programme_Outputs_summary->RowAttrs["class"] = "ew-rpt-page-summary";
	$Programme_Outputs_summary->renderRow();
?>
<?php if ($Programme_Outputs_summary->LAName->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>><td colspan="<?php echo ($Programme_Outputs_summary->GroupColumnCount + $Programme_Outputs_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Programme_Outputs_summary->PageTotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Programme_Outputs_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->OutputName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->OutputType->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->FinancialYear->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->OutputIndicatorName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->TargetAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->TargetAmount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->ActualAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ActualAmount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptAvg") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->PercentAchieved->viewAttributes() ?>><?php echo $Programme_Outputs_summary->PercentAchieved->AvgViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>><td colspan="<?php echo ($Programme_Outputs_summary->GroupColumnCount + $Programme_Outputs_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Programme_Outputs_summary->PageTotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Programme_Outputs_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->OutputName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->OutputType->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->FinancialYear->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->OutputIndicatorName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->TargetAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->TargetAmount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->ActualAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ActualAmount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes(); ?>>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Programme_Outputs_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptAvg") ?></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->OutputName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->OutputType->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->FinancialYear->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->OutputIndicatorName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->PercentAchieved->viewAttributes() ?>><?php echo $Programme_Outputs_summary->PercentAchieved->AvgViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	$Programme_Outputs_summary->resetAttributes();
	$Programme_Outputs_summary->RowType = ROWTYPE_TOTAL;
	$Programme_Outputs_summary->RowTotalType = ROWTOTAL_GRAND;
	$Programme_Outputs_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Programme_Outputs_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Programme_Outputs_summary->renderRow();
?>
<?php if ($Programme_Outputs_summary->LAName->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes() ?>><td colspan="<?php echo ($Programme_Outputs_summary->GroupColumnCount + $Programme_Outputs_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Programme_Outputs_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes() ?>>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Programme_Outputs_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->OutputName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->OutputType->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->FinancialYear->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->OutputIndicatorName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->TargetAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->TargetAmount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->ActualAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ActualAmount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptAvg") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Programme_Outputs_summary->PercentAchieved->viewAttributes() ?>><?php echo $Programme_Outputs_summary->PercentAchieved->AvgViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes() ?>><td colspan="<?php echo ($Programme_Outputs_summary->GroupColumnCount + $Programme_Outputs_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Programme_Outputs_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes() ?>>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Programme_Outputs_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->OutputName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->OutputType->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->FinancialYear->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->OutputIndicatorName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->TargetAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->TargetAmount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->ActualAmount->viewAttributes() ?>><?php echo $Programme_Outputs_summary->ActualAmount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
	<tr<?php echo $Programme_Outputs_summary->rowAttributes() ?>>
<?php if ($Programme_Outputs_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Programme_Outputs_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptAvg") ?></td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Programme_Outputs_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Programme_Outputs_summary->OutputName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputType->Visible) { ?>
		<td data-field="OutputType"<?php echo $Programme_Outputs_summary->OutputType->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Programme_Outputs_summary->FinancialYear->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->OutputIndicatorName->Visible) { ?>
		<td data-field="OutputIndicatorName"<?php echo $Programme_Outputs_summary->OutputIndicatorName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->TargetAmount->Visible) { ?>
		<td data-field="TargetAmount"<?php echo $Programme_Outputs_summary->TargetAmount->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Programme_Outputs_summary->ActualAmount->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Programme_Outputs_summary->PercentAchieved->Visible) { ?>
		<td data-field="PercentAchieved"<?php echo $Programme_Outputs_summary->PercentAchieved->cellAttributes() ?>>
<span<?php echo $Programme_Outputs_summary->PercentAchieved->viewAttributes() ?>><?php echo $Programme_Outputs_summary->PercentAchieved->AvgViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Programme_Outputs_summary->TotalGroups > 0) { ?>
<?php if (!$Programme_Outputs_summary->isExport() && !($Programme_Outputs_summary->DrillDown && $Programme_Outputs_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Programme_Outputs_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Programme_Outputs_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Programme_Outputs_summary->isExport() || $Programme_Outputs_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Programme_Outputs_summary->isExport() || $Programme_Outputs_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Programme_Outputs_summary->isExport() || $Programme_Outputs_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Programme_Outputs_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Programme_Outputs_summary->isExport() && !$Programme_Outputs_summary->DrillDown && !$DashboardReport) { ?>
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
$Programme_Outputs_summary->terminate();
?>