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
$Monthly_Payroll_Summary_Report_crosstab = new Monthly_Payroll_Summary_Report_crosstab();

// Run the page
$Monthly_Payroll_Summary_Report_crosstab->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Monthly_Payroll_Summary_Report_crosstab->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport() && !$Monthly_Payroll_Summary_Report_crosstab->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Monthly_Payroll_Summary_Report_crosstab->isExport() || $Monthly_Payroll_Summary_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Monthly_Payroll_Summary_Report_crosstab->DrillDownInPanel) {
	$Monthly_Payroll_Summary_Report_crosstab->ExportOptions->render("body");
	$Monthly_Payroll_Summary_Report_crosstab->SearchOptions->render("body");
	$Monthly_Payroll_Summary_Report_crosstab->FilterOptions->render("body");
}
?>
</div>
<?php $Monthly_Payroll_Summary_Report_crosstab->showPageHeader(); ?>
<?php
$Monthly_Payroll_Summary_Report_crosstab->showMessage();
?>
<?php if ((!$Monthly_Payroll_Summary_Report_crosstab->isExport() || $Monthly_Payroll_Summary_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Monthly_Payroll_Summary_Report_crosstab->isExport() || $Monthly_Payroll_Summary_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Monthly_Payroll_Summary_Report_crosstab->CenterContentClass ?>">
<?php } ?>
<!-- Crosstab report (begin) -->
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
<div id="report_crosstab">
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport() && !$Monthly_Payroll_Summary_Report_crosstab->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Monthly_Payroll_Summary_Report_crosstab->GroupCount <= count($Monthly_Payroll_Summary_Report_crosstab->GroupRecords) && $Monthly_Payroll_Summary_Report_crosstab->GroupCount <= $Monthly_Payroll_Summary_Report_crosstab->DisplayGroups) {
?>
<?php

	// Show header
	if ($Monthly_Payroll_Summary_Report_crosstab->ShowHeader) {
?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->TotalGroups > 0) { ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport() && !($Monthly_Payroll_Summary_Report_crosstab->DrillDown && $Monthly_Payroll_Summary_Report_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Monthly_Payroll_Summary_Report_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Monthly_Payroll_Summary_Report_crosstab->PageBreakContent ?>
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
<div class="<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("word") && !$Monthly_Payroll_Summary_Report_crosstab->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Monthly_Payroll_Summary_Report_crosstab->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport() && !($Monthly_Payroll_Summary_Report_crosstab->DrillDown && $Monthly_Payroll_Summary_Report_crosstab->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Monthly_Payroll_Summary_Report_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Monthly_Payroll_Summary_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Monthly_Payroll_Summary_Report_crosstab->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->GroupColumnCount > 0) { ?>
		<td class="ew-rpt-col-summary" colspan="<?php echo $Monthly_Payroll_Summary_Report_crosstab->GroupColumnCount ?>"><div><?php echo $Monthly_Payroll_Summary_Report_crosstab->renderSummaryCaptions() ?></div></td>
<?php } ?>
		<td class="ew-rpt-col-header" colspan="<?php echo @$Monthly_Payroll_Summary_Report_crosstab->ColumnSpan ?>">
			<div class="ew-table-header-btn">
				<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->PCode->caption() ?></span>
			</div>
		</td>
	</tr>
	<tr class="ew-table-header">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->DepartmentName->Visible) { ?>
	<td data-field="DepartmentName">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->DepartmentName) == "") { ?>
		<div class="ew-table-header-btn Monthly_Payroll_Summary_Report_DepartmentName">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->DepartmentName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Monthly_Payroll_Summary_Report_DepartmentName" onclick="ew.sort(event, '<?php echo $Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->DepartmentName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->DepartmentName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Payroll_Summary_Report_crosstab->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Payroll_Summary_Report_crosstab->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->EmployeeID->Visible) { ?>
	<td data-field="EmployeeID">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->EmployeeID) == "") { ?>
		<div class="ew-table-header-btn Monthly_Payroll_Summary_Report_EmployeeID">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->EmployeeID->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Monthly_Payroll_Summary_Report_EmployeeID" onclick="ew.sort(event, '<?php echo $Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->EmployeeID) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->EmployeeID->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Payroll_Summary_Report_crosstab->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Payroll_Summary_Report_crosstab->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->Surname->Visible) { ?>
	<td data-field="Surname">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->Surname) == "") { ?>
		<div class="ew-table-header-btn Monthly_Payroll_Summary_Report_Surname">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->Surname->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Monthly_Payroll_Summary_Report_Surname" onclick="ew.sort(event, '<?php echo $Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->Surname) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->Surname->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Payroll_Summary_Report_crosstab->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Payroll_Summary_Report_crosstab->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->FirstName->Visible) { ?>
	<td data-field="FirstName">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->FirstName) == "") { ?>
		<div class="ew-table-header-btn Monthly_Payroll_Summary_Report_FirstName">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->FirstName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Monthly_Payroll_Summary_Report_FirstName" onclick="ew.sort(event, '<?php echo $Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->FirstName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->FirstName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Payroll_Summary_Report_crosstab->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Payroll_Summary_Report_crosstab->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->PositionName->Visible) { ?>
	<td data-field="PositionName">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->PositionName) == "") { ?>
		<div class="ew-table-header-btn Monthly_Payroll_Summary_Report_PositionName">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->PositionName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Monthly_Payroll_Summary_Report_PositionName" onclick="ew.sort(event, '<?php echo $Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->PositionName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->PositionName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Payroll_Summary_Report_crosstab->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Payroll_Summary_Report_crosstab->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->Period->Visible) { ?>
	<td data-field="Period">
<?php if ($Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->Period) == "") { ?>
		<div class="ew-table-header-btn Monthly_Payroll_Summary_Report_Period">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->Period->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Monthly_Payroll_Summary_Report_Period" onclick="ew.sort(event, '<?php echo $Monthly_Payroll_Summary_Report_crosstab->sortUrl($Monthly_Payroll_Summary_Report_crosstab->Period) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Monthly_Payroll_Summary_Report_crosstab->Period->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Monthly_Payroll_Summary_Report_crosstab->Period->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Monthly_Payroll_Summary_Report_crosstab->Period->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntval = count($Monthly_Payroll_Summary_Report_crosstab->Columns);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($Monthly_Payroll_Summary_Report_crosstab->Columns[$iy]->Visible) {
			$Monthly_Payroll_Summary_Report_crosstab->SummaryCurrentValues[$iy-1] = $Monthly_Payroll_Summary_Report_crosstab->Columns[$iy]->Caption;
			$Monthly_Payroll_Summary_Report_crosstab->SummaryViewValues[$iy-1] = $Monthly_Payroll_Summary_Report_crosstab->SummaryCurrentValues[$iy-1];
?>
		<td class="ew-table-header"<?php echo $Monthly_Payroll_Summary_Report_crosstab->PCode->cellAttributes() ?>><div<?php echo $Monthly_Payroll_Summary_Report_crosstab->PCode->viewAttributes() ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->SummaryViewValues[$iy-1]; ?></div></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
</thead>
<tbody>
<?php
		if ($Monthly_Payroll_Summary_Report_crosstab->TotalGroups == 0)
			break; // Show header only
		$Monthly_Payroll_Summary_Report_crosstab->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Monthly_Payroll_Summary_Report_crosstab->DepartmentName, $Monthly_Payroll_Summary_Report_crosstab->getSqlFirstGroupField(), $Monthly_Payroll_Summary_Report_crosstab->DepartmentName->groupValue(), $Monthly_Payroll_Summary_Report_crosstab->Dbid);
	if ($Monthly_Payroll_Summary_Report_crosstab->PageFirstGroupFilter != "") $Monthly_Payroll_Summary_Report_crosstab->PageFirstGroupFilter .= " OR ";
	$Monthly_Payroll_Summary_Report_crosstab->PageFirstGroupFilter .= $where;
	if ($Monthly_Payroll_Summary_Report_crosstab->Filter != "")
		$where = "($Monthly_Payroll_Summary_Report_crosstab->Filter) AND ($where)";
	$sql = BuildReportSql(str_replace("{DistinctColumnFields}", $Monthly_Payroll_Summary_Report_crosstab->DistinctColumnFields, $Monthly_Payroll_Summary_Report_crosstab->getSqlSelect()), $Monthly_Payroll_Summary_Report_crosstab->getSqlWhere(), $Monthly_Payroll_Summary_Report_crosstab->getSqlGroupBy(), "", $Monthly_Payroll_Summary_Report_crosstab->getSqlOrderBy(), $where, $Monthly_Payroll_Summary_Report_crosstab->Sort);
	$rs = $Monthly_Payroll_Summary_Report_crosstab->getRecordset($sql);
	$Monthly_Payroll_Summary_Report_crosstab->DetailRecords = $rs ? $rs->getRows() : [];
	$Monthly_Payroll_Summary_Report_crosstab->DetailRecordCount = count($Monthly_Payroll_Summary_Report_crosstab->DetailRecords);

	// Load detail records
	$Monthly_Payroll_Summary_Report_crosstab->DepartmentName->Records = &$Monthly_Payroll_Summary_Report_crosstab->DetailRecords;
	$Monthly_Payroll_Summary_Report_crosstab->DepartmentName->LevelBreak = TRUE; // Set field level break
	$Monthly_Payroll_Summary_Report_crosstab->EmployeeID->getDistinctValues($Monthly_Payroll_Summary_Report_crosstab->DepartmentName->Records);
	foreach ($Monthly_Payroll_Summary_Report_crosstab->EmployeeID->DistinctValues as $EmployeeID) { // Load records for this distinct value
		$Monthly_Payroll_Summary_Report_crosstab->EmployeeID->setGroupValue($EmployeeID); // Set group value
		$Monthly_Payroll_Summary_Report_crosstab->EmployeeID->getDistinctRecords($Monthly_Payroll_Summary_Report_crosstab->DepartmentName->Records, $Monthly_Payroll_Summary_Report_crosstab->EmployeeID->groupValue());
		$Monthly_Payroll_Summary_Report_crosstab->EmployeeID->LevelBreak = TRUE; // Set field level break
	$Monthly_Payroll_Summary_Report_crosstab->Surname->getDistinctValues($Monthly_Payroll_Summary_Report_crosstab->EmployeeID->Records);
	foreach ($Monthly_Payroll_Summary_Report_crosstab->Surname->DistinctValues as $Surname) { // Load records for this distinct value
		$Monthly_Payroll_Summary_Report_crosstab->Surname->setGroupValue($Surname); // Set group value
		$Monthly_Payroll_Summary_Report_crosstab->Surname->getDistinctRecords($Monthly_Payroll_Summary_Report_crosstab->EmployeeID->Records, $Monthly_Payroll_Summary_Report_crosstab->Surname->groupValue());
		$Monthly_Payroll_Summary_Report_crosstab->Surname->LevelBreak = TRUE; // Set field level break
	$Monthly_Payroll_Summary_Report_crosstab->FirstName->getDistinctValues($Monthly_Payroll_Summary_Report_crosstab->Surname->Records);
	foreach ($Monthly_Payroll_Summary_Report_crosstab->FirstName->DistinctValues as $FirstName) { // Load records for this distinct value
		$Monthly_Payroll_Summary_Report_crosstab->FirstName->setGroupValue($FirstName); // Set group value
		$Monthly_Payroll_Summary_Report_crosstab->FirstName->getDistinctRecords($Monthly_Payroll_Summary_Report_crosstab->Surname->Records, $Monthly_Payroll_Summary_Report_crosstab->FirstName->groupValue());
		$Monthly_Payroll_Summary_Report_crosstab->FirstName->LevelBreak = TRUE; // Set field level break
	$Monthly_Payroll_Summary_Report_crosstab->PositionName->getDistinctValues($Monthly_Payroll_Summary_Report_crosstab->FirstName->Records);
	foreach ($Monthly_Payroll_Summary_Report_crosstab->PositionName->DistinctValues as $PositionName) { // Load records for this distinct value
		$Monthly_Payroll_Summary_Report_crosstab->PositionName->setGroupValue($PositionName); // Set group value
		$Monthly_Payroll_Summary_Report_crosstab->PositionName->getDistinctRecords($Monthly_Payroll_Summary_Report_crosstab->FirstName->Records, $Monthly_Payroll_Summary_Report_crosstab->PositionName->groupValue());
		$Monthly_Payroll_Summary_Report_crosstab->PositionName->LevelBreak = TRUE; // Set field level break
	$Monthly_Payroll_Summary_Report_crosstab->Period->getDistinctValues($Monthly_Payroll_Summary_Report_crosstab->PositionName->Records);
	foreach ($Monthly_Payroll_Summary_Report_crosstab->Period->DistinctValues as $Period) { // Load records for this distinct value
		$Monthly_Payroll_Summary_Report_crosstab->Period->setGroupValue($Period); // Set group value
		$Monthly_Payroll_Summary_Report_crosstab->Period->getDistinctRecords($Monthly_Payroll_Summary_Report_crosstab->PositionName->Records, $Monthly_Payroll_Summary_Report_crosstab->Period->groupValue());
		$Monthly_Payroll_Summary_Report_crosstab->Period->LevelBreak = TRUE; // Set field level break
	foreach ($Monthly_Payroll_Summary_Report_crosstab->Period->Records as $record) {
		$Monthly_Payroll_Summary_Report_crosstab->RecordCount++;
		$Monthly_Payroll_Summary_Report_crosstab->RecordIndex++;
		$Monthly_Payroll_Summary_Report_crosstab->loadRowValues($record);

		// Render row
		$Monthly_Payroll_Summary_Report_crosstab->resetAttributes();
		$Monthly_Payroll_Summary_Report_crosstab->RowType = ROWTYPE_DETAIL;
		$Monthly_Payroll_Summary_Report_crosstab->renderRow();
?>
	<tr<?php echo $Monthly_Payroll_Summary_Report_crosstab->rowAttributes(); ?>>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->DepartmentName->Visible) { ?>
		<!-- DepartmentName -->
		<td data-field="DepartmentName"<?php echo $Monthly_Payroll_Summary_Report_crosstab->DepartmentName->cellAttributes(); ?>><span<?php echo $Monthly_Payroll_Summary_Report_crosstab->DepartmentName->viewAttributes() ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->DepartmentName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->EmployeeID->Visible) { ?>
		<!-- EmployeeID -->
		<td data-field="EmployeeID"<?php echo $Monthly_Payroll_Summary_Report_crosstab->EmployeeID->cellAttributes(); ?>><span<?php echo $Monthly_Payroll_Summary_Report_crosstab->EmployeeID->viewAttributes() ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->EmployeeID->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->Surname->Visible) { ?>
		<!-- Surname -->
		<td data-field="Surname"<?php echo $Monthly_Payroll_Summary_Report_crosstab->Surname->cellAttributes(); ?>><span<?php echo $Monthly_Payroll_Summary_Report_crosstab->Surname->viewAttributes() ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->Surname->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->FirstName->Visible) { ?>
		<!-- FirstName -->
		<td data-field="FirstName"<?php echo $Monthly_Payroll_Summary_Report_crosstab->FirstName->cellAttributes(); ?>><span<?php echo $Monthly_Payroll_Summary_Report_crosstab->FirstName->viewAttributes() ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->FirstName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->PositionName->Visible) { ?>
		<!-- PositionName -->
		<td data-field="PositionName"<?php echo $Monthly_Payroll_Summary_Report_crosstab->PositionName->cellAttributes(); ?>><span<?php echo $Monthly_Payroll_Summary_Report_crosstab->PositionName->viewAttributes() ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->PositionName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->Period->Visible) { ?>
		<!-- Period -->
		<td data-field="Period"<?php echo $Monthly_Payroll_Summary_Report_crosstab->Period->cellAttributes(); ?>><span<?php echo $Monthly_Payroll_Summary_Report_crosstab->Period->viewAttributes() ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->Period->GroupViewValue ?></span></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
		$cntcol = count($Monthly_Payroll_Summary_Report_crosstab->SummaryViewValues);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$colShow = ($iy <= $Monthly_Payroll_Summary_Report_crosstab->ColumnCount) ? $Monthly_Payroll_Summary_Report_crosstab->Columns[$iy]->Visible : TRUE;
			$colDesc = ($iy <= $Monthly_Payroll_Summary_Report_crosstab->ColumnCount) ? $Monthly_Payroll_Summary_Report_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
			if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Monthly_Payroll_Summary_Report_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Monthly_Payroll_Summary_Report_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
			}
		}
?>
<!-- Dynamic columns end -->
	</tr>
<?php
	}
	} // End group level 5
	} // End group level 4
	} // End group level 3
	} // End group level 2
	} // End group level 1
?>
<?php

	// Next group
	$Monthly_Payroll_Summary_Report_crosstab->loadGroupRowValues();

	// Show header if page break
	if ($Monthly_Payroll_Summary_Report_crosstab->isExport())
		$Monthly_Payroll_Summary_Report_crosstab->ShowHeader = ($Monthly_Payroll_Summary_Report_crosstab->ExportPageBreakCount == 0) ? FALSE : ($Monthly_Payroll_Summary_Report_crosstab->GroupCount % $Monthly_Payroll_Summary_Report_crosstab->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Monthly_Payroll_Summary_Report_crosstab->ShowHeader)
		$Monthly_Payroll_Summary_Report_crosstab->Page_Breaking($Monthly_Payroll_Summary_Report_crosstab->ShowHeader, $Monthly_Payroll_Summary_Report_crosstab->PageBreakContent);
	$Monthly_Payroll_Summary_Report_crosstab->GroupCount++;
} // End while
?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Monthly_Payroll_Summary_Report_crosstab->TotalGroups > 0) { ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport() && !($Monthly_Payroll_Summary_Report_crosstab->DrillDown && $Monthly_Payroll_Summary_Report_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Monthly_Payroll_Summary_Report_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport("pdf")) { ?>
</div>
<!-- /#report-crosstab -->
<?php } ?>
<!-- Crosstab report (end) -->
<?php if ((!$Monthly_Payroll_Summary_Report_crosstab->isExport() || $Monthly_Payroll_Summary_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Monthly_Payroll_Summary_Report_crosstab->isExport() || $Monthly_Payroll_Summary_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Monthly_Payroll_Summary_Report_crosstab->isExport() || $Monthly_Payroll_Summary_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Monthly_Payroll_Summary_Report_crosstab->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Monthly_Payroll_Summary_Report_crosstab->isExport() && !$Monthly_Payroll_Summary_Report_crosstab->DrillDown && !$DashboardReport) { ?>
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
$Monthly_Payroll_Summary_Report_crosstab->terminate();
?>