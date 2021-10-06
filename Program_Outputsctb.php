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
$Program_Outputs_crosstab = new Program_Outputs_crosstab();

// Run the page
$Program_Outputs_crosstab->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Program_Outputs_crosstab->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Program_Outputs_crosstab->isExport() && !$Program_Outputs_crosstab->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Program_Outputs_crosstab->isExport() || $Program_Outputs_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Program_Outputs_crosstab->DrillDownInPanel) {
	$Program_Outputs_crosstab->ExportOptions->render("body");
	$Program_Outputs_crosstab->SearchOptions->render("body");
	$Program_Outputs_crosstab->FilterOptions->render("body");
}
?>
</div>
<?php $Program_Outputs_crosstab->showPageHeader(); ?>
<?php
$Program_Outputs_crosstab->showMessage();
?>
<?php if ((!$Program_Outputs_crosstab->isExport() || $Program_Outputs_crosstab->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Program_Outputs_crosstab->isExport() || $Program_Outputs_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Program_Outputs_crosstab->CenterContentClass ?>">
<?php } ?>
<!-- Crosstab report (begin) -->
<div id="report_crosstab">
<?php if (!$Program_Outputs_crosstab->isExport() && !$Program_Outputs_crosstab->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Program_Outputs_crosstab->GroupCount <= count($Program_Outputs_crosstab->GroupRecords) && $Program_Outputs_crosstab->GroupCount <= $Program_Outputs_crosstab->DisplayGroups) {
?>
<?php

	// Show header
	if ($Program_Outputs_crosstab->ShowHeader) {
?>
<?php if ($Program_Outputs_crosstab->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Program_Outputs_crosstab->TotalGroups > 0) { ?>
<?php if (!$Program_Outputs_crosstab->isExport() && !($Program_Outputs_crosstab->DrillDown && $Program_Outputs_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Outputs_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Program_Outputs_crosstab->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Program_Outputs_crosstab->isExport("word") && !$Program_Outputs_crosstab->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Program_Outputs_crosstab->ReportTableStyle ?>>
<?php if (!$Program_Outputs_crosstab->isExport() && !($Program_Outputs_crosstab->DrillDown && $Program_Outputs_crosstab->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Outputs_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Program_Outputs" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Program_Outputs_crosstab->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Program_Outputs_crosstab->GroupColumnCount > 0) { ?>
		<td class="ew-rpt-col-summary" colspan="<?php echo $Program_Outputs_crosstab->GroupColumnCount ?>"><div><?php echo $Program_Outputs_crosstab->renderSummaryCaptions() ?></div></td>
<?php } ?>
		<td class="ew-rpt-col-header" colspan="<?php echo @$Program_Outputs_crosstab->ColumnSpan ?>">
			<div class="ew-table-header-btn">
				<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->FinancialYear->caption() ?></span>
			</div>
		</td>
	</tr>
	<tr class="ew-table-header">
<?php if ($Program_Outputs_crosstab->LAName->Visible) { ?>
	<td data-field="LAName">
<?php if ($Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->LAName) == "") { ?>
		<div class="ew-table-header-btn Program_Outputs_LAName">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->LAName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Program_Outputs_LAName" onclick="ew.sort(event, '<?php echo $Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->LAName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->LAName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Outputs_crosstab->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Outputs_crosstab->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Program_Outputs_crosstab->ProgramName->Visible) { ?>
	<td data-field="ProgramName">
<?php if ($Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->ProgramName) == "") { ?>
		<div class="ew-table-header-btn Program_Outputs_ProgramName">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->ProgramName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Program_Outputs_ProgramName" onclick="ew.sort(event, '<?php echo $Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->ProgramName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->ProgramName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Outputs_crosstab->ProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Outputs_crosstab->ProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Program_Outputs_crosstab->ProgramPurpose->Visible) { ?>
	<td data-field="ProgramPurpose">
<?php if ($Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->ProgramPurpose) == "") { ?>
		<div class="ew-table-header-btn Program_Outputs_ProgramPurpose">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->ProgramPurpose->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Program_Outputs_ProgramPurpose" onclick="ew.sort(event, '<?php echo $Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->ProgramPurpose) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->ProgramPurpose->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Outputs_crosstab->ProgramPurpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Outputs_crosstab->ProgramPurpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Program_Outputs_crosstab->OutputIndicatorName->Visible) { ?>
	<td data-field="OutputIndicatorName">
<?php if ($Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->OutputIndicatorName) == "") { ?>
		<div class="ew-table-header-btn Program_Outputs_OutputIndicatorName">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->OutputIndicatorName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Program_Outputs_OutputIndicatorName" onclick="ew.sort(event, '<?php echo $Program_Outputs_crosstab->sortUrl($Program_Outputs_crosstab->OutputIndicatorName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Outputs_crosstab->OutputIndicatorName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Outputs_crosstab->OutputIndicatorName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Outputs_crosstab->OutputIndicatorName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntval = count($Program_Outputs_crosstab->Columns);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($Program_Outputs_crosstab->Columns[$iy]->Visible) {
			$Program_Outputs_crosstab->SummaryCurrentValues[$iy-1] = $Program_Outputs_crosstab->Columns[$iy]->Caption;
			$Program_Outputs_crosstab->SummaryViewValues[$iy-1] = $Program_Outputs_crosstab->SummaryCurrentValues[$iy-1];
?>
		<td class="ew-table-header"<?php echo $Program_Outputs_crosstab->FinancialYear->cellAttributes() ?>><div<?php echo $Program_Outputs_crosstab->FinancialYear->viewAttributes() ?>><?php echo $Program_Outputs_crosstab->SummaryViewValues[$iy-1]; ?></div></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
		<td class="ew-table-header"<?php echo $Program_Outputs_crosstab->FinancialYear->cellAttributes() ?>><div<?php echo $Program_Outputs_crosstab->FinancialYear->viewAttributes() ?>><?php echo $Program_Outputs_crosstab->renderSummaryCaptions() ?></div></td>
	</tr>
</thead>
<tbody>
<?php
		if ($Program_Outputs_crosstab->TotalGroups == 0)
			break; // Show header only
		$Program_Outputs_crosstab->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Program_Outputs_crosstab->LAName, $Program_Outputs_crosstab->getSqlFirstGroupField(), $Program_Outputs_crosstab->LAName->groupValue(), $Program_Outputs_crosstab->Dbid);
	if ($Program_Outputs_crosstab->PageFirstGroupFilter != "") $Program_Outputs_crosstab->PageFirstGroupFilter .= " OR ";
	$Program_Outputs_crosstab->PageFirstGroupFilter .= $where;
	if ($Program_Outputs_crosstab->Filter != "")
		$where = "($Program_Outputs_crosstab->Filter) AND ($where)";
	$sql = BuildReportSql(str_replace("{DistinctColumnFields}", $Program_Outputs_crosstab->DistinctColumnFields, $Program_Outputs_crosstab->getSqlSelect()), $Program_Outputs_crosstab->getSqlWhere(), $Program_Outputs_crosstab->getSqlGroupBy(), "", $Program_Outputs_crosstab->getSqlOrderBy(), $where, $Program_Outputs_crosstab->Sort);
	$rs = $Program_Outputs_crosstab->getRecordset($sql);
	$Program_Outputs_crosstab->DetailRecords = $rs ? $rs->getRows() : [];
	$Program_Outputs_crosstab->DetailRecordCount = count($Program_Outputs_crosstab->DetailRecords);

	// Load detail records
	$Program_Outputs_crosstab->LAName->Records = &$Program_Outputs_crosstab->DetailRecords;
	$Program_Outputs_crosstab->LAName->LevelBreak = TRUE; // Set field level break
	$Program_Outputs_crosstab->ProgramName->getDistinctValues($Program_Outputs_crosstab->LAName->Records);
	foreach ($Program_Outputs_crosstab->ProgramName->DistinctValues as $ProgramName) { // Load records for this distinct value
		$Program_Outputs_crosstab->ProgramName->setGroupValue($ProgramName); // Set group value
		$Program_Outputs_crosstab->ProgramName->getDistinctRecords($Program_Outputs_crosstab->LAName->Records, $Program_Outputs_crosstab->ProgramName->groupValue());
		$Program_Outputs_crosstab->ProgramName->LevelBreak = TRUE; // Set field level break
	$Program_Outputs_crosstab->ProgramPurpose->getDistinctValues($Program_Outputs_crosstab->ProgramName->Records);
	foreach ($Program_Outputs_crosstab->ProgramPurpose->DistinctValues as $ProgramPurpose) { // Load records for this distinct value
		$Program_Outputs_crosstab->ProgramPurpose->setGroupValue($ProgramPurpose); // Set group value
		$Program_Outputs_crosstab->ProgramPurpose->getDistinctRecords($Program_Outputs_crosstab->ProgramName->Records, $Program_Outputs_crosstab->ProgramPurpose->groupValue());
		$Program_Outputs_crosstab->ProgramPurpose->LevelBreak = TRUE; // Set field level break
	$Program_Outputs_crosstab->OutputIndicatorName->getDistinctValues($Program_Outputs_crosstab->ProgramPurpose->Records);
	foreach ($Program_Outputs_crosstab->OutputIndicatorName->DistinctValues as $OutputIndicatorName) { // Load records for this distinct value
		$Program_Outputs_crosstab->OutputIndicatorName->setGroupValue($OutputIndicatorName); // Set group value
		$Program_Outputs_crosstab->OutputIndicatorName->getDistinctRecords($Program_Outputs_crosstab->ProgramPurpose->Records, $Program_Outputs_crosstab->OutputIndicatorName->groupValue());
		$Program_Outputs_crosstab->OutputIndicatorName->LevelBreak = TRUE; // Set field level break
	foreach ($Program_Outputs_crosstab->OutputIndicatorName->Records as $record) {
		$Program_Outputs_crosstab->RecordCount++;
		$Program_Outputs_crosstab->RecordIndex++;
		$Program_Outputs_crosstab->loadRowValues($record);

		// Render row
		$Program_Outputs_crosstab->resetAttributes();
		$Program_Outputs_crosstab->RowType = ROWTYPE_DETAIL;
		$Program_Outputs_crosstab->renderRow();
?>
	<tr<?php echo $Program_Outputs_crosstab->rowAttributes(); ?>>
<?php if ($Program_Outputs_crosstab->LAName->Visible) { ?>
		<!-- LAName -->
		<td data-field="LAName"<?php echo $Program_Outputs_crosstab->LAName->cellAttributes(); ?>><span<?php echo $Program_Outputs_crosstab->LAName->viewAttributes() ?>><?php echo $Program_Outputs_crosstab->LAName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Program_Outputs_crosstab->ProgramName->Visible) { ?>
		<!-- ProgramName -->
		<td data-field="ProgramName"<?php echo $Program_Outputs_crosstab->ProgramName->cellAttributes(); ?>><span<?php echo $Program_Outputs_crosstab->ProgramName->viewAttributes() ?>><?php echo $Program_Outputs_crosstab->ProgramName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Program_Outputs_crosstab->ProgramPurpose->Visible) { ?>
		<!-- ProgramPurpose -->
		<td data-field="ProgramPurpose"<?php echo $Program_Outputs_crosstab->ProgramPurpose->cellAttributes(); ?>><span<?php echo $Program_Outputs_crosstab->ProgramPurpose->viewAttributes() ?>><?php echo $Program_Outputs_crosstab->ProgramPurpose->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Program_Outputs_crosstab->OutputIndicatorName->Visible) { ?>
		<!-- OutputIndicatorName -->
		<td data-field="OutputIndicatorName"<?php echo $Program_Outputs_crosstab->OutputIndicatorName->cellAttributes(); ?>><span<?php echo $Program_Outputs_crosstab->OutputIndicatorName->viewAttributes() ?>><?php echo $Program_Outputs_crosstab->OutputIndicatorName->GroupViewValue ?></span></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
		$cntcol = count($Program_Outputs_crosstab->SummaryViewValues);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$colShow = ($iy <= $Program_Outputs_crosstab->ColumnCount) ? $Program_Outputs_crosstab->Columns[$iy]->Visible : TRUE;
			$colDesc = ($iy <= $Program_Outputs_crosstab->ColumnCount) ? $Program_Outputs_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
			if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Program_Outputs_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Program_Outputs_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
			}
		}
?>
<!-- Dynamic columns end -->
	</tr>
<?php
	}
	} // End group level 3
	} // End group level 2
	} // End group level 1
?>
<?php

	// Next group
	$Program_Outputs_crosstab->loadGroupRowValues();

	// Show header if page break
	if ($Program_Outputs_crosstab->isExport())
		$Program_Outputs_crosstab->ShowHeader = ($Program_Outputs_crosstab->ExportPageBreakCount == 0) ? FALSE : ($Program_Outputs_crosstab->GroupCount % $Program_Outputs_crosstab->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Program_Outputs_crosstab->ShowHeader)
		$Program_Outputs_crosstab->Page_Breaking($Program_Outputs_crosstab->ShowHeader, $Program_Outputs_crosstab->PageBreakContent);
	$Program_Outputs_crosstab->GroupCount++;
} // End while
?>
<?php if ($Program_Outputs_crosstab->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Program_Outputs_crosstab->TotalGroups > 0) { ?>
<?php if (!$Program_Outputs_crosstab->isExport() && !($Program_Outputs_crosstab->DrillDown && $Program_Outputs_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Outputs_crosstab->Pager->render() ?>
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
<?php if ((!$Program_Outputs_crosstab->isExport() || $Program_Outputs_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Program_Outputs_crosstab->isExport() || $Program_Outputs_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Program_Outputs_crosstab->isExport() || $Program_Outputs_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Program_Outputs_crosstab->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Program_Outputs_crosstab->isExport() && !$Program_Outputs_crosstab->DrillDown && !$DashboardReport) { ?>
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
$Program_Outputs_crosstab->terminate();
?>