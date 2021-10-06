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
$Program_Budget_By_Economic_Classification_crosstab = new Program_Budget_By_Economic_Classification_crosstab();

// Run the page
$Program_Budget_By_Economic_Classification_crosstab->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Program_Budget_By_Economic_Classification_crosstab->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Program_Budget_By_Economic_Classification_crosstab->isExport() && !$Program_Budget_By_Economic_Classification_crosstab->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Program_Budget_By_Economic_Classification_crosstab->isExport() || $Program_Budget_By_Economic_Classification_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Program_Budget_By_Economic_Classification_crosstab->DrillDownInPanel) {
	$Program_Budget_By_Economic_Classification_crosstab->ExportOptions->render("body");
	$Program_Budget_By_Economic_Classification_crosstab->SearchOptions->render("body");
	$Program_Budget_By_Economic_Classification_crosstab->FilterOptions->render("body");
}
?>
</div>
<?php $Program_Budget_By_Economic_Classification_crosstab->showPageHeader(); ?>
<?php
$Program_Budget_By_Economic_Classification_crosstab->showMessage();
?>
<?php if ((!$Program_Budget_By_Economic_Classification_crosstab->isExport() || $Program_Budget_By_Economic_Classification_crosstab->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Program_Budget_By_Economic_Classification_crosstab->isExport() || $Program_Budget_By_Economic_Classification_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Program_Budget_By_Economic_Classification_crosstab->CenterContentClass ?>">
<?php } ?>
<!-- Crosstab report (begin) -->
<div id="report_crosstab">
<?php if (!$Program_Budget_By_Economic_Classification_crosstab->isExport() && !$Program_Budget_By_Economic_Classification_crosstab->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Program_Budget_By_Economic_Classification_crosstab->GroupCount <= count($Program_Budget_By_Economic_Classification_crosstab->GroupRecords) && $Program_Budget_By_Economic_Classification_crosstab->GroupCount <= $Program_Budget_By_Economic_Classification_crosstab->DisplayGroups) {
?>
<?php

	// Show header
	if ($Program_Budget_By_Economic_Classification_crosstab->ShowHeader) {
?>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Program_Budget_By_Economic_Classification_crosstab->TotalGroups > 0) { ?>
<?php if (!$Program_Budget_By_Economic_Classification_crosstab->isExport() && !($Program_Budget_By_Economic_Classification_crosstab->DrillDown && $Program_Budget_By_Economic_Classification_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Budget_By_Economic_Classification_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Program_Budget_By_Economic_Classification_crosstab->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Program_Budget_By_Economic_Classification_crosstab->isExport("word") && !$Program_Budget_By_Economic_Classification_crosstab->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Program_Budget_By_Economic_Classification_crosstab->ReportTableStyle ?>>
<?php if (!$Program_Budget_By_Economic_Classification_crosstab->isExport() && !($Program_Budget_By_Economic_Classification_crosstab->DrillDown && $Program_Budget_By_Economic_Classification_crosstab->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Budget_By_Economic_Classification_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Program_Budget_By_Economic_Classification" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Program_Budget_By_Economic_Classification_crosstab->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Program_Budget_By_Economic_Classification_crosstab->GroupColumnCount > 0) { ?>
		<td class="ew-rpt-col-summary" colspan="<?php echo $Program_Budget_By_Economic_Classification_crosstab->GroupColumnCount ?>"><div><?php echo $Program_Budget_By_Economic_Classification_crosstab->renderSummaryCaptions() ?></div></td>
<?php } ?>
		<td class="ew-rpt-col-header" colspan="<?php echo @$Program_Budget_By_Economic_Classification_crosstab->ColumnSpan ?>">
			<div class="ew-table-header-btn">
				<span class="ew-table-header-caption"><?php echo $Program_Budget_By_Economic_Classification_crosstab->FinancialYear->caption() ?></span>
			</div>
		</td>
	</tr>
	<tr class="ew-table-header">
<?php if ($Program_Budget_By_Economic_Classification_crosstab->ProgramName->Visible) { ?>
	<td data-field="ProgramName">
<?php if ($Program_Budget_By_Economic_Classification_crosstab->sortUrl($Program_Budget_By_Economic_Classification_crosstab->ProgramName) == "") { ?>
		<div class="ew-table-header-btn Program_Budget_By_Economic_Classification_ProgramName">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_By_Economic_Classification_crosstab->ProgramName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Program_Budget_By_Economic_Classification_ProgramName" onclick="ew.sort(event, '<?php echo $Program_Budget_By_Economic_Classification_crosstab->sortUrl($Program_Budget_By_Economic_Classification_crosstab->ProgramName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_By_Economic_Classification_crosstab->ProgramName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Budget_By_Economic_Classification_crosstab->ProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_By_Economic_Classification_crosstab->ProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->Visible) { ?>
	<td data-field="AccountGroupName">
<?php if ($Program_Budget_By_Economic_Classification_crosstab->sortUrl($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName) == "") { ?>
		<div class="ew-table-header-btn Program_Budget_By_Economic_Classification_AccountGroupName">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Program_Budget_By_Economic_Classification_AccountGroupName" onclick="ew.sort(event, '<?php echo $Program_Budget_By_Economic_Classification_crosstab->sortUrl($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->AccountName->Visible) { ?>
	<td data-field="AccountName">
<?php if ($Program_Budget_By_Economic_Classification_crosstab->sortUrl($Program_Budget_By_Economic_Classification_crosstab->AccountName) == "") { ?>
		<div class="ew-table-header-btn Program_Budget_By_Economic_Classification_AccountName">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Program_Budget_By_Economic_Classification_AccountName" onclick="ew.sort(event, '<?php echo $Program_Budget_By_Economic_Classification_crosstab->sortUrl($Program_Budget_By_Economic_Classification_crosstab->AccountName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Budget_By_Economic_Classification_crosstab->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_By_Economic_Classification_crosstab->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntval = count($Program_Budget_By_Economic_Classification_crosstab->Columns);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($Program_Budget_By_Economic_Classification_crosstab->Columns[$iy]->Visible) {
			$Program_Budget_By_Economic_Classification_crosstab->SummaryCurrentValues[$iy-1] = $Program_Budget_By_Economic_Classification_crosstab->Columns[$iy]->Caption;
			$Program_Budget_By_Economic_Classification_crosstab->SummaryViewValues[$iy-1] = $Program_Budget_By_Economic_Classification_crosstab->SummaryCurrentValues[$iy-1];
?>
		<td class="ew-table-header"<?php echo $Program_Budget_By_Economic_Classification_crosstab->FinancialYear->cellAttributes() ?>><div<?php echo $Program_Budget_By_Economic_Classification_crosstab->FinancialYear->viewAttributes() ?>><?php echo $Program_Budget_By_Economic_Classification_crosstab->SummaryViewValues[$iy-1]; ?></div></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
		<td class="ew-table-header"<?php echo $Program_Budget_By_Economic_Classification_crosstab->FinancialYear->cellAttributes() ?>><div<?php echo $Program_Budget_By_Economic_Classification_crosstab->FinancialYear->viewAttributes() ?>><?php echo $Program_Budget_By_Economic_Classification_crosstab->renderSummaryCaptions() ?></div></td>
	</tr>
</thead>
<tbody>
<?php
		if ($Program_Budget_By_Economic_Classification_crosstab->TotalGroups == 0)
			break; // Show header only
		$Program_Budget_By_Economic_Classification_crosstab->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Program_Budget_By_Economic_Classification_crosstab->ProgramName, $Program_Budget_By_Economic_Classification_crosstab->getSqlFirstGroupField(), $Program_Budget_By_Economic_Classification_crosstab->ProgramName->groupValue(), $Program_Budget_By_Economic_Classification_crosstab->Dbid);
	if ($Program_Budget_By_Economic_Classification_crosstab->PageFirstGroupFilter != "") $Program_Budget_By_Economic_Classification_crosstab->PageFirstGroupFilter .= " OR ";
	$Program_Budget_By_Economic_Classification_crosstab->PageFirstGroupFilter .= $where;
	if ($Program_Budget_By_Economic_Classification_crosstab->Filter != "")
		$where = "($Program_Budget_By_Economic_Classification_crosstab->Filter) AND ($where)";
	$sql = BuildReportSql(str_replace("{DistinctColumnFields}", $Program_Budget_By_Economic_Classification_crosstab->DistinctColumnFields, $Program_Budget_By_Economic_Classification_crosstab->getSqlSelect()), $Program_Budget_By_Economic_Classification_crosstab->getSqlWhere(), $Program_Budget_By_Economic_Classification_crosstab->getSqlGroupBy(), "", $Program_Budget_By_Economic_Classification_crosstab->getSqlOrderBy(), $where, $Program_Budget_By_Economic_Classification_crosstab->Sort);
	$rs = $Program_Budget_By_Economic_Classification_crosstab->getRecordset($sql);
	$Program_Budget_By_Economic_Classification_crosstab->DetailRecords = $rs ? $rs->getRows() : [];
	$Program_Budget_By_Economic_Classification_crosstab->DetailRecordCount = count($Program_Budget_By_Economic_Classification_crosstab->DetailRecords);

	// Load detail records
	$Program_Budget_By_Economic_Classification_crosstab->ProgramName->Records = &$Program_Budget_By_Economic_Classification_crosstab->DetailRecords;
	$Program_Budget_By_Economic_Classification_crosstab->ProgramName->LevelBreak = TRUE; // Set field level break
	$Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->getDistinctValues($Program_Budget_By_Economic_Classification_crosstab->ProgramName->Records);
	foreach ($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->DistinctValues as $AccountGroupName) { // Load records for this distinct value
		$Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->setGroupValue($AccountGroupName); // Set group value
		$Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->getDistinctRecords($Program_Budget_By_Economic_Classification_crosstab->ProgramName->Records, $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->groupValue());
		$Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->LevelBreak = TRUE; // Set field level break
	$Program_Budget_By_Economic_Classification_crosstab->AccountName->getDistinctValues($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->Records);
	foreach ($Program_Budget_By_Economic_Classification_crosstab->AccountName->DistinctValues as $AccountName) { // Load records for this distinct value
		$Program_Budget_By_Economic_Classification_crosstab->AccountName->setGroupValue($AccountName); // Set group value
		$Program_Budget_By_Economic_Classification_crosstab->AccountName->getDistinctRecords($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->Records, $Program_Budget_By_Economic_Classification_crosstab->AccountName->groupValue());
		$Program_Budget_By_Economic_Classification_crosstab->AccountName->LevelBreak = TRUE; // Set field level break
	foreach ($Program_Budget_By_Economic_Classification_crosstab->AccountName->Records as $record) {
		$Program_Budget_By_Economic_Classification_crosstab->RecordCount++;
		$Program_Budget_By_Economic_Classification_crosstab->RecordIndex++;
		$Program_Budget_By_Economic_Classification_crosstab->loadRowValues($record);

		// Render row
		$Program_Budget_By_Economic_Classification_crosstab->resetAttributes();
		$Program_Budget_By_Economic_Classification_crosstab->RowType = ROWTYPE_DETAIL;
		$Program_Budget_By_Economic_Classification_crosstab->renderRow();
?>
	<tr<?php echo $Program_Budget_By_Economic_Classification_crosstab->rowAttributes(); ?>>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->ProgramName->Visible) { ?>
		<!-- ProgramName -->
		<td data-field="ProgramName"<?php echo $Program_Budget_By_Economic_Classification_crosstab->ProgramName->cellAttributes(); ?>><span<?php echo $Program_Budget_By_Economic_Classification_crosstab->ProgramName->viewAttributes() ?>><?php echo $Program_Budget_By_Economic_Classification_crosstab->ProgramName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->Visible) { ?>
		<!-- AccountGroupName -->
		<td data-field="AccountGroupName"<?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->cellAttributes(); ?>><span<?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->viewAttributes() ?>><?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->AccountName->Visible) { ?>
		<!-- AccountName -->
		<td data-field="AccountName"<?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountName->cellAttributes(); ?>><span<?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountName->viewAttributes() ?>><?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountName->GroupViewValue ?></span></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
		$cntcol = count($Program_Budget_By_Economic_Classification_crosstab->SummaryViewValues);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$colShow = ($iy <= $Program_Budget_By_Economic_Classification_crosstab->ColumnCount) ? $Program_Budget_By_Economic_Classification_crosstab->Columns[$iy]->Visible : TRUE;
			$colDesc = ($iy <= $Program_Budget_By_Economic_Classification_crosstab->ColumnCount) ? $Program_Budget_By_Economic_Classification_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
			if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Program_Budget_By_Economic_Classification_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Program_Budget_By_Economic_Classification_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
			}
		}
?>
<!-- Dynamic columns end -->
	</tr>
<?php
	}
	} // End group level 2
?>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->TotalGroups > 0) { ?>
<?php
	$Program_Budget_By_Economic_Classification_crosstab->getSummaryValues($Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->Records); // Get crosstab summaries from records
	$Program_Budget_By_Economic_Classification_crosstab->resetAttributes();
	$Program_Budget_By_Economic_Classification_crosstab->RowType = ROWTYPE_TOTAL;
	$Program_Budget_By_Economic_Classification_crosstab->RowTotalType = ROWTOTAL_GROUP;
	$Program_Budget_By_Economic_Classification_crosstab->RowTotalSubType = ROWTOTAL_FOOTER;
	$Program_Budget_By_Economic_Classification_crosstab->RowGroupLevel = 2;
	$Program_Budget_By_Economic_Classification_crosstab->renderRow();
?>
	<!-- Summary AccountGroupName (level 2) -->
	<tr<?php echo $Program_Budget_By_Economic_Classification_crosstab->rowAttributes(); ?>>
		<td data-field="ProgramName"<?php echo $Program_Budget_By_Economic_Classification_crosstab->ProgramName->cellAttributes() ?>>&nbsp;</td>
		<td colspan="<?php echo ($Program_Budget_By_Economic_Classification_crosstab->GroupColumnCount - 1) ?>"<?php echo $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->GroupViewValue, $Program_Budget_By_Economic_Classification_crosstab->AccountGroupName->caption()], $Language->phrase("CtbSumHead")) ?></td>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Program_Budget_By_Economic_Classification_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Program_Budget_By_Economic_Classification_crosstab->ColumnCount) ? $Program_Budget_By_Economic_Classification_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Program_Budget_By_Economic_Classification_crosstab->ColumnCount) ? $Program_Budget_By_Economic_Classification_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Program_Budget_By_Economic_Classification_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Program_Budget_By_Economic_Classification_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
<?php } ?>
<?php
	} // End group level 1
?>
<?php

	// Next group
	$Program_Budget_By_Economic_Classification_crosstab->loadGroupRowValues();

	// Show header if page break
	if ($Program_Budget_By_Economic_Classification_crosstab->isExport())
		$Program_Budget_By_Economic_Classification_crosstab->ShowHeader = ($Program_Budget_By_Economic_Classification_crosstab->ExportPageBreakCount == 0) ? FALSE : ($Program_Budget_By_Economic_Classification_crosstab->GroupCount % $Program_Budget_By_Economic_Classification_crosstab->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Program_Budget_By_Economic_Classification_crosstab->ShowHeader)
		$Program_Budget_By_Economic_Classification_crosstab->Page_Breaking($Program_Budget_By_Economic_Classification_crosstab->ShowHeader, $Program_Budget_By_Economic_Classification_crosstab->PageBreakContent);
	$Program_Budget_By_Economic_Classification_crosstab->GroupCount++;
} // End while
?>
<?php if ($Program_Budget_By_Economic_Classification_crosstab->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Program_Budget_By_Economic_Classification_crosstab->TotalGroups > 0) { ?>
<?php if (!$Program_Budget_By_Economic_Classification_crosstab->isExport() && !($Program_Budget_By_Economic_Classification_crosstab->DrillDown && $Program_Budget_By_Economic_Classification_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Budget_By_Economic_Classification_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-crosstab -->
<!-- Crosstab report (end) -->
<?php if ((!$Program_Budget_By_Economic_Classification_crosstab->isExport() || $Program_Budget_By_Economic_Classification_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Program_Budget_By_Economic_Classification_crosstab->isExport() || $Program_Budget_By_Economic_Classification_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Program_Budget_By_Economic_Classification_crosstab->isExport() || $Program_Budget_By_Economic_Classification_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Program_Budget_By_Economic_Classification_crosstab->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Program_Budget_By_Economic_Classification_crosstab->isExport() && !$Program_Budget_By_Economic_Classification_crosstab->DrillDown && !$DashboardReport) { ?>
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
$Program_Budget_By_Economic_Classification_crosstab->terminate();
?>