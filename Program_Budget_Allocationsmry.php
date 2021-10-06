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
$Program_Budget_Allocation_summary = new Program_Budget_Allocation_summary();

// Run the page
$Program_Budget_Allocation_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Program_Budget_Allocation_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport() && !$Program_Budget_Allocation_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Program_Budget_Allocation_summary->DrillDownInPanel) {
	$Program_Budget_Allocation_summary->ExportOptions->render("body");
	$Program_Budget_Allocation_summary->SearchOptions->render("body");
	$Program_Budget_Allocation_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Program_Budget_Allocation_summary->showPageHeader(); ?>
<?php
$Program_Budget_Allocation_summary->showMessage();
?>
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Program_Budget_Allocation_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport() && !$Program_Budget_Allocation_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Program_Budget_Allocation_summary->GroupCount <= count($Program_Budget_Allocation_summary->GroupRecords) && $Program_Budget_Allocation_summary->GroupCount <= $Program_Budget_Allocation_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Program_Budget_Allocation_summary->ShowHeader) {
?>
<?php if ($Program_Budget_Allocation_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->TotalGroups > 0) { ?>
<?php if (!$Program_Budget_Allocation_summary->isExport() && !($Program_Budget_Allocation_summary->DrillDown && $Program_Budget_Allocation_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Budget_Allocation_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<script id="tpb<?php echo $Program_Budget_Allocation_summary->GroupCount - 1 ?>_Program_Budget_Allocation" type="text/html"><?php echo $Program_Budget_Allocation_summary->PageBreakContent ?></script>
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Program_Budget_Allocation_summary->isExport("word") && !$Program_Budget_Allocation_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Program_Budget_Allocation_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport() && !($Program_Budget_Allocation_summary->DrillDown && $Program_Budget_Allocation_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Budget_Allocation_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Program_Budget_Allocation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Program_Budget_Allocation_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->ProgramName->ShowGroupHeaderAsRow) { ?>
	<th data-name="ProgramName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->ProgramName) == "") { ?>
	<th data-name="ProgramName" class="<?php echo $Program_Budget_Allocation_summary->ProgramName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_ProgramName" type="text/html"><div class="Program_Budget_Allocation_ProgramName"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->ProgramName->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="ProgramName" class="<?php echo $Program_Budget_Allocation_summary->ProgramName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_ProgramName" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->ProgramName) ?>', 1);"><div class="Program_Budget_Allocation_ProgramName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->ProgramName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->ProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->ProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SubProgramName->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->SubProgramName->ShowGroupHeaderAsRow) { ?>
	<th data-name="SubProgramName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->SubProgramName) == "") { ?>
	<th data-name="SubProgramName" class="<?php echo $Program_Budget_Allocation_summary->SubProgramName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_SubProgramName" type="text/html"><div class="Program_Budget_Allocation_SubProgramName"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->SubProgramName->caption() ?></div></div></script></th>
		<?php } else { ?>
	<th data-name="SubProgramName" class="<?php echo $Program_Budget_Allocation_summary->SubProgramName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_SubProgramName" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->SubProgramName) ?>', 1);"><div class="Program_Budget_Allocation_SubProgramName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->SubProgramName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->SubProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->SubProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->AccountGroupName) == "") { ?>
	<th data-name="AccountGroupName" class="<?php echo $Program_Budget_Allocation_summary->AccountGroupName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_AccountGroupName" type="text/html"><div class="Program_Budget_Allocation_AccountGroupName"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->AccountGroupName->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="AccountGroupName" class="<?php echo $Program_Budget_Allocation_summary->AccountGroupName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_AccountGroupName" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->AccountGroupName) ?>', 1);"><div class="Program_Budget_Allocation_AccountGroupName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->AccountGroupName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->AccountGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->AccountGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->AccountName) == "") { ?>
	<th data-name="AccountName" class="<?php echo $Program_Budget_Allocation_summary->AccountName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_AccountName" type="text/html"><div class="Program_Budget_Allocation_AccountName"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->AccountName->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="AccountName" class="<?php echo $Program_Budget_Allocation_summary->AccountName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_AccountName" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->AccountName) ?>', 1);"><div class="Program_Budget_Allocation_AccountName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->AccountName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->FinancialYear) == "") { ?>
	<th data-name="FinancialYear" class="<?php echo $Program_Budget_Allocation_summary->FinancialYear->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_FinancialYear" type="text/html"><div class="Program_Budget_Allocation_FinancialYear"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->FinancialYear->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="FinancialYear" class="<?php echo $Program_Budget_Allocation_summary->FinancialYear->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_FinancialYear" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->FinancialYear) ?>', 1);"><div class="Program_Budget_Allocation_FinancialYear">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->FinancialYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->FinancialYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->BudgetEstimate) == "") { ?>
	<th data-name="BudgetEstimate" class="<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_BudgetEstimate" type="text/html"><div class="Program_Budget_Allocation_BudgetEstimate"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="BudgetEstimate" class="<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_BudgetEstimate" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->BudgetEstimate) ?>', 1);"><div class="Program_Budget_Allocation_BudgetEstimate">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->BudgetEstimate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->BudgetEstimate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->ActualAmount) == "") { ?>
	<th data-name="ActualAmount" class="<?php echo $Program_Budget_Allocation_summary->ActualAmount->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_ActualAmount" type="text/html"><div class="Program_Budget_Allocation_ActualAmount"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->ActualAmount->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="ActualAmount" class="<?php echo $Program_Budget_Allocation_summary->ActualAmount->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_ActualAmount" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->ActualAmount) ?>', 1);"><div class="Program_Budget_Allocation_ActualAmount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->ActualAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->ActualAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->DepartmentCode) == "") { ?>
	<th data-name="DepartmentCode" class="<?php echo $Program_Budget_Allocation_summary->DepartmentCode->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_DepartmentCode" type="text/html"><div class="Program_Budget_Allocation_DepartmentCode"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->DepartmentCode->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="DepartmentCode" class="<?php echo $Program_Budget_Allocation_summary->DepartmentCode->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_DepartmentCode" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->DepartmentCode) ?>', 1);"><div class="Program_Budget_Allocation_DepartmentCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->SectionCode) == "") { ?>
	<th data-name="SectionCode" class="<?php echo $Program_Budget_Allocation_summary->SectionCode->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_SectionCode" type="text/html"><div class="Program_Budget_Allocation_SectionCode"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->SectionCode->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="SectionCode" class="<?php echo $Program_Budget_Allocation_summary->SectionCode->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_SectionCode" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->SectionCode) ?>', 1);"><div class="Program_Budget_Allocation_SectionCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->OutputCode) == "") { ?>
	<th data-name="OutputCode" class="<?php echo $Program_Budget_Allocation_summary->OutputCode->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_OutputCode" type="text/html"><div class="Program_Budget_Allocation_OutputCode"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->OutputCode->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="OutputCode" class="<?php echo $Program_Budget_Allocation_summary->OutputCode->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_OutputCode" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->OutputCode) ?>', 1);"><div class="Program_Budget_Allocation_OutputCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->OutputCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->OutputCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->OutputName) == "") { ?>
	<th data-name="OutputName" class="<?php echo $Program_Budget_Allocation_summary->OutputName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_OutputName" type="text/html"><div class="Program_Budget_Allocation_OutputName"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->OutputName->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="OutputName" class="<?php echo $Program_Budget_Allocation_summary->OutputName->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_OutputName" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->OutputName) ?>', 1);"><div class="Program_Budget_Allocation_OutputName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->OutputName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->OutputName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->OutputName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->UnitOfMeasure) == "") { ?>
	<th data-name="UnitOfMeasure" class="<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_UnitOfMeasure" type="text/html"><div class="Program_Budget_Allocation_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="UnitOfMeasure" class="<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_UnitOfMeasure" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->UnitOfMeasure) ?>', 1);"><div class="Program_Budget_Allocation_UnitOfMeasure">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->Quantity) == "") { ?>
	<th data-name="Quantity" class="<?php echo $Program_Budget_Allocation_summary->Quantity->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_Quantity" type="text/html"><div class="Program_Budget_Allocation_Quantity"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->Quantity->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Quantity" class="<?php echo $Program_Budget_Allocation_summary->Quantity->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_Quantity" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->Quantity) ?>', 1);"><div class="Program_Budget_Allocation_Quantity">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->PeriodType) == "") { ?>
	<th data-name="PeriodType" class="<?php echo $Program_Budget_Allocation_summary->PeriodType->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_PeriodType" type="text/html"><div class="Program_Budget_Allocation_PeriodType"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->PeriodType->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="PeriodType" class="<?php echo $Program_Budget_Allocation_summary->PeriodType->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_PeriodType" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->PeriodType) ?>', 1);"><div class="Program_Budget_Allocation_PeriodType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->PeriodLength) == "") { ?>
	<th data-name="PeriodLength" class="<?php echo $Program_Budget_Allocation_summary->PeriodLength->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_PeriodLength" type="text/html"><div class="Program_Budget_Allocation_PeriodLength"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->PeriodLength->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="PeriodLength" class="<?php echo $Program_Budget_Allocation_summary->PeriodLength->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_PeriodLength" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->PeriodLength) ?>', 1);"><div class="Program_Budget_Allocation_PeriodLength">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->PeriodLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->PeriodLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->PeriodLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->Frequency) == "") { ?>
	<th data-name="Frequency" class="<?php echo $Program_Budget_Allocation_summary->Frequency->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_Frequency" type="text/html"><div class="Program_Budget_Allocation_Frequency"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->Frequency->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="Frequency" class="<?php echo $Program_Budget_Allocation_summary->Frequency->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_Frequency" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->Frequency) ?>', 1);"><div class="Program_Budget_Allocation_Frequency">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->Frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->Frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->Frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->UnitCost) == "") { ?>
	<th data-name="UnitCost" class="<?php echo $Program_Budget_Allocation_summary->UnitCost->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_UnitCost" type="text/html"><div class="Program_Budget_Allocation_UnitCost"><div class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->UnitCost->caption() ?></div></div></script></th>
	<?php } else { ?>
	<th data-name="UnitCost" class="<?php echo $Program_Budget_Allocation_summary->UnitCost->headerCellClass() ?>"><script id="tpc_Program_Budget_Allocation_UnitCost" type="text/html"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->UnitCost) ?>', 1);"><div class="Program_Budget_Allocation_UnitCost">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></script></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Program_Budget_Allocation_summary->TotalGroups == 0)
			break; // Show header only
		$Program_Budget_Allocation_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Program_Budget_Allocation_summary->ProgramName, $Program_Budget_Allocation_summary->getSqlFirstGroupField(), $Program_Budget_Allocation_summary->ProgramName->groupValue(), $Program_Budget_Allocation_summary->Dbid);
	if ($Program_Budget_Allocation_summary->PageFirstGroupFilter != "") $Program_Budget_Allocation_summary->PageFirstGroupFilter .= " OR ";
	$Program_Budget_Allocation_summary->PageFirstGroupFilter .= $where;
	if ($Program_Budget_Allocation_summary->Filter != "")
		$where = "($Program_Budget_Allocation_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Program_Budget_Allocation_summary->getSqlSelect(), $Program_Budget_Allocation_summary->getSqlWhere(), $Program_Budget_Allocation_summary->getSqlGroupBy(), $Program_Budget_Allocation_summary->getSqlHaving(), $Program_Budget_Allocation_summary->getSqlOrderBy(), $where, $Program_Budget_Allocation_summary->Sort);
	$rs = $Program_Budget_Allocation_summary->getRecordset($sql);
	$Program_Budget_Allocation_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Program_Budget_Allocation_summary->DetailRecordCount = count($Program_Budget_Allocation_summary->DetailRecords);

	// Load detail records
	$Program_Budget_Allocation_summary->ProgramName->Records = &$Program_Budget_Allocation_summary->DetailRecords;
	$Program_Budget_Allocation_summary->ProgramName->LevelBreak = TRUE; // Set field level break
		$Program_Budget_Allocation_summary->GroupCounter[1] = $Program_Budget_Allocation_summary->GroupCount;
		$Program_Budget_Allocation_summary->ProgramName->getCnt($Program_Budget_Allocation_summary->ProgramName->Records); // Get record count
?>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible && $Program_Budget_Allocation_summary->ProgramName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Program_Budget_Allocation_summary->resetAttributes();
		$Program_Budget_Allocation_summary->RowType = ROWTYPE_TOTAL;
		$Program_Budget_Allocation_summary->RowTotalType = ROWTOTAL_GROUP;
		$Program_Budget_Allocation_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Program_Budget_Allocation_summary->RowGroupLevel = 1;
		$Program_Budget_Allocation_summary->renderRow();
?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="ProgramName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>
<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->ProgramName) == "") { ?>
		<span class="ew-summary-caption Program_Budget_Allocation_ProgramName"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->ProgramName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Program_Budget_Allocation_ProgramName" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->ProgramName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->ProgramName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->ProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->ProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_Program_Budget_Allocation_ProgramName" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->ProgramName->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ProgramName->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->ProgramName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Program_Budget_Allocation_summary->SubProgramName->getDistinctValues($Program_Budget_Allocation_summary->ProgramName->Records);
	$Program_Budget_Allocation_summary->setGroupCount(count($Program_Budget_Allocation_summary->SubProgramName->DistinctValues), $Program_Budget_Allocation_summary->GroupCounter[1]);
	$Program_Budget_Allocation_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Program_Budget_Allocation_summary->SubProgramName->DistinctValues as $SubProgramName) { // Load records for this distinct value
		$Program_Budget_Allocation_summary->SubProgramName->setGroupValue($SubProgramName); // Set group value
		$Program_Budget_Allocation_summary->SubProgramName->getDistinctRecords($Program_Budget_Allocation_summary->ProgramName->Records, $Program_Budget_Allocation_summary->SubProgramName->groupValue());
		$Program_Budget_Allocation_summary->SubProgramName->LevelBreak = TRUE; // Set field level break
		$Program_Budget_Allocation_summary->GroupCounter[2]++;
		$Program_Budget_Allocation_summary->SubProgramName->getCnt($Program_Budget_Allocation_summary->SubProgramName->Records); // Get record count
		$Program_Budget_Allocation_summary->setGroupCount($Program_Budget_Allocation_summary->SubProgramName->Count, $Program_Budget_Allocation_summary->GroupCounter[1], $Program_Budget_Allocation_summary->GroupCounter[2]);
?>
<?php if ($Program_Budget_Allocation_summary->SubProgramName->Visible && $Program_Budget_Allocation_summary->SubProgramName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Program_Budget_Allocation_summary->SubProgramName->setDbValue($SubProgramName); // Set current value for SubProgramName
		$Program_Budget_Allocation_summary->resetAttributes();
		$Program_Budget_Allocation_summary->RowType = ROWTYPE_TOTAL;
		$Program_Budget_Allocation_summary->RowTotalType = ROWTOTAL_GROUP;
		$Program_Budget_Allocation_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Program_Budget_Allocation_summary->RowGroupLevel = 2;
		$Program_Budget_Allocation_summary->renderRow();
?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SubProgramName->Visible) { ?>
		<td data-field="SubProgramName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="SubProgramName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>
<?php if ($Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->SubProgramName) == "") { ?>
		<span class="ew-summary-caption Program_Budget_Allocation_SubProgramName"><span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->SubProgramName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Program_Budget_Allocation_SubProgramName" onclick="ew.sort(event, '<?php echo $Program_Budget_Allocation_summary->sortUrl($Program_Budget_Allocation_summary->SubProgramName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Program_Budget_Allocation_summary->SubProgramName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Program_Budget_Allocation_summary->SubProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Program_Budget_Allocation_summary->SubProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->GroupCounter[3] ?>_Program_Budget_Allocation_SubProgramName" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->SubProgramName->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->SubProgramName->GroupViewValue ?></span></script>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->SubProgramName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Program_Budget_Allocation_summary->RecordCount = 0; // Reset record count
	foreach ($Program_Budget_Allocation_summary->SubProgramName->Records as $record) {
		$Program_Budget_Allocation_summary->RecordCount++;
		$Program_Budget_Allocation_summary->RecordIndex++;
		$Program_Budget_Allocation_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Program_Budget_Allocation_summary->resetAttributes();
		$Program_Budget_Allocation_summary->RowType = ROWTYPE_DETAIL;
		$Program_Budget_Allocation_summary->renderRow();
?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->ProgramName->ShowGroupHeaderAsRow) { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_Program_Budget_Allocation_ProgramName" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->ProgramName->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ProgramName->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SubProgramName->Visible) { ?>
	<?php if ($Program_Budget_Allocation_summary->SubProgramName->ShowGroupHeaderAsRow) { ?>
		<td data-field="SubProgramName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="SubProgramName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes(); ?>><script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->GroupCounter[3] ?>_Program_Budget_Allocation_SubProgramName" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->SubProgramName->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->SubProgramName->GroupViewValue ?></span></script></td>
	<?php } ?>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->AccountGroupName->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_AccountGroupName" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->AccountGroupName->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->AccountGroupName->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->AccountName->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_AccountName" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->AccountName->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->AccountName->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->FinancialYear->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_FinancialYear" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->FinancialYear->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->FinancialYear->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_BudgetEstimate" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ActualAmount->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_ActualAmount" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->DepartmentCode->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_DepartmentCode" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->DepartmentCode->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->DepartmentCode->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->SectionCode->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_SectionCode" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->SectionCode->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->SectionCode->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->OutputCode->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_OutputCode" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->OutputCode->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->OutputCode->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->OutputName->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_OutputName" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->OutputName->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->OutputName->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_UnitOfMeasure" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->Quantity->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_Quantity" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->Quantity->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->Quantity->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->PeriodType->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_PeriodType" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->PeriodType->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->PeriodType->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->PeriodLength->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_PeriodLength" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->PeriodLength->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->PeriodLength->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->Frequency->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_Frequency" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->Frequency->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->Frequency->getViewValue() ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->UnitCost->cellAttributes() ?>>
<script id="tpx<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_<?php echo $Page->RecordCount ?>_Program_Budget_Allocation_UnitCost" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->UnitCost->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->UnitCost->getViewValue() ?></span>
</script>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Program_Budget_Allocation_summary->TotalGroups > 0) { ?>
<?php
	$Program_Budget_Allocation_summary->BudgetEstimate->getSum($Program_Budget_Allocation_summary->SubProgramName->Records); // Get Sum
	$Program_Budget_Allocation_summary->ActualAmount->getSum($Program_Budget_Allocation_summary->SubProgramName->Records); // Get Sum
	$Program_Budget_Allocation_summary->resetAttributes();
	$Program_Budget_Allocation_summary->RowType = ROWTYPE_TOTAL;
	$Program_Budget_Allocation_summary->RowTotalType = ROWTOTAL_GROUP;
	$Program_Budget_Allocation_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Program_Budget_Allocation_summary->RowGroupLevel = 2;
	$Program_Budget_Allocation_summary->renderRow();
?>
<?php if ($Program_Budget_Allocation_summary->SubProgramName->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>
	<?php if ($Program_Budget_Allocation_summary->ProgramName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Program_Budget_Allocation_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->ProgramName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SubProgramName->Visible) { ?>
		<td data-field="SubProgramName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>
	<?php if ($Program_Budget_Allocation_summary->SubProgramName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Program_Budget_Allocation_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->SubProgramName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgs<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_Program_Budget_Allocation_BudgetEstimate" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgs<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_Program_Budget_Allocation_ActualAmount" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SubGroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Program_Budget_Allocation_summary->SubGroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount) ?>"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Program_Budget_Allocation_summary->SubProgramName->GroupViewValue, $Program_Budget_Allocation_summary->SubProgramName->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Program_Budget_Allocation_summary->SubProgramName->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Program_Budget_Allocation_summary->GroupColumnCount - 1) ?>"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->cellAttributes() ?>>
<script id="tpgs<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_Program_Budget_Allocation_BudgetEstimate" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ActualAmount->cellAttributes() ?>>
<script id="tpgs<?php echo $Page->GroupCount ?>_<?php echo $Page->GroupCounter[2] ?>_Program_Budget_Allocation_ActualAmount" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->SubProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 1
?>
<?php if ($Program_Budget_Allocation_summary->TotalGroups > 0) { ?>
<?php
	$Program_Budget_Allocation_summary->BudgetEstimate->getSum($Program_Budget_Allocation_summary->ProgramName->Records); // Get Sum
	$Program_Budget_Allocation_summary->ActualAmount->getSum($Program_Budget_Allocation_summary->ProgramName->Records); // Get Sum
	$Program_Budget_Allocation_summary->resetAttributes();
	$Program_Budget_Allocation_summary->RowType = ROWTYPE_TOTAL;
	$Program_Budget_Allocation_summary->RowTotalType = ROWTOTAL_GROUP;
	$Program_Budget_Allocation_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Program_Budget_Allocation_summary->RowGroupLevel = 1;
	$Program_Budget_Allocation_summary->renderRow();
?>
<?php if ($Program_Budget_Allocation_summary->ProgramName->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->ProgramName->Visible) { ?>
		<td data-field="ProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>
	<?php if ($Program_Budget_Allocation_summary->ProgramName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Program_Budget_Allocation_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->ProgramName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SubProgramName->Visible) { ?>
		<td data-field="SubProgramName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>
	<?php if ($Program_Budget_Allocation_summary->SubProgramName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Program_Budget_Allocation_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->SubProgramName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgs<?php echo $Page->GroupCount ?>_Program_Budget_Allocation_BudgetEstimate" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpgs<?php echo $Page->GroupCount ?>_Program_Budget_Allocation_ActualAmount" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->GroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Program_Budget_Allocation_summary->GroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount) ?>"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Program_Budget_Allocation_summary->ProgramName->GroupViewValue, $Program_Budget_Allocation_summary->ProgramName->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Program_Budget_Allocation_summary->ProgramName->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Program_Budget_Allocation_summary->GroupColumnCount - 0) ?>"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->cellAttributes() ?>>
<script id="tpgs<?php echo $Page->GroupCount ?>_Program_Budget_Allocation_BudgetEstimate" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ActualAmount->cellAttributes() ?>>
<script id="tpgs<?php echo $Page->GroupCount ?>_Program_Budget_Allocation_ActualAmount" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->ProgramName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Program_Budget_Allocation_summary->loadGroupRowValues();

	// Show header if page break
	if ($Program_Budget_Allocation_summary->isExport())
		$Program_Budget_Allocation_summary->ShowHeader = ($Program_Budget_Allocation_summary->ExportPageBreakCount == 0) ? FALSE : ($Program_Budget_Allocation_summary->GroupCount % $Program_Budget_Allocation_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Program_Budget_Allocation_summary->ShowHeader)
		$Program_Budget_Allocation_summary->Page_Breaking($Program_Budget_Allocation_summary->ShowHeader, $Program_Budget_Allocation_summary->PageBreakContent);
	$Program_Budget_Allocation_summary->GroupCount++;
} // End while
?>
<?php if ($Program_Budget_Allocation_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Program_Budget_Allocation_summary->resetAttributes();
	$Program_Budget_Allocation_summary->RowType = ROWTYPE_TOTAL;
	$Program_Budget_Allocation_summary->RowTotalType = ROWTOTAL_PAGE;
	$Program_Budget_Allocation_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Program_Budget_Allocation_summary->RowAttrs["class"] = "ew-rpt-page-summary";
	$Program_Budget_Allocation_summary->renderRow();
?>
<?php if ($Program_Budget_Allocation_summary->ProgramName->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>><td colspan="<?php echo ($Program_Budget_Allocation_summary->GroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->PageTotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Program_Budget_Allocation_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->AccountGroupName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->AccountName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->FinancialYear->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpps_Program_Budget_Allocation_BudgetEstimate" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ActualAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpps_Program_Budget_Allocation_ActualAmount" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->OutputCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->OutputName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->Quantity->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->PeriodType->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->PeriodLength->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->Frequency->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->UnitCost->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>><td colspan="<?php echo ($Program_Budget_Allocation_summary->GroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Program_Budget_Allocation_summary->PageTotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes(); ?>>
<?php if ($Program_Budget_Allocation_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Program_Budget_Allocation_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->AccountGroupName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->AccountName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->FinancialYear->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->cellAttributes() ?>>
<script id="tpps_Program_Budget_Allocation_BudgetEstimate" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ActualAmount->cellAttributes() ?>>
<script id="tpps_Program_Budget_Allocation_ActualAmount" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->DepartmentCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->SectionCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->OutputCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->OutputName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->Quantity->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->PeriodType->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->PeriodLength->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->Frequency->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->UnitCost->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php
	$Program_Budget_Allocation_summary->resetAttributes();
	$Program_Budget_Allocation_summary->RowType = ROWTYPE_TOTAL;
	$Program_Budget_Allocation_summary->RowTotalType = ROWTOTAL_GRAND;
	$Program_Budget_Allocation_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Program_Budget_Allocation_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Program_Budget_Allocation_summary->renderRow();
?>
<?php if ($Program_Budget_Allocation_summary->ProgramName->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes() ?>><td colspan="<?php echo ($Program_Budget_Allocation_summary->GroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Program_Budget_Allocation_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes() ?>>
<?php if ($Program_Budget_Allocation_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Program_Budget_Allocation_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->AccountGroupName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->AccountName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->FinancialYear->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpts_Program_Budget_Allocation_BudgetEstimate" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ActualAmount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><script id="tpts_Program_Budget_Allocation_ActualAmount" type="text/html"><span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span></script></span></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->OutputCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->OutputName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->Quantity->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->PeriodType->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->PeriodLength->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->Frequency->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->UnitCost->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes() ?>><td colspan="<?php echo ($Program_Budget_Allocation_summary->GroupColumnCount + $Program_Budget_Allocation_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Program_Budget_Allocation_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Program_Budget_Allocation_summary->rowAttributes() ?>>
<?php if ($Program_Budget_Allocation_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Program_Budget_Allocation_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountGroupName->Visible) { ?>
		<td data-field="AccountGroupName"<?php echo $Program_Budget_Allocation_summary->AccountGroupName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->AccountName->Visible) { ?>
		<td data-field="AccountName"<?php echo $Program_Budget_Allocation_summary->AccountName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->FinancialYear->Visible) { ?>
		<td data-field="FinancialYear"<?php echo $Program_Budget_Allocation_summary->FinancialYear->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->BudgetEstimate->Visible) { ?>
		<td data-field="BudgetEstimate"<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->cellAttributes() ?>>
<script id="tpts_Program_Budget_Allocation_BudgetEstimate" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->BudgetEstimate->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->BudgetEstimate->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->ActualAmount->Visible) { ?>
		<td data-field="ActualAmount"<?php echo $Program_Budget_Allocation_summary->ActualAmount->cellAttributes() ?>>
<script id="tpts_Program_Budget_Allocation_ActualAmount" type="text/html">
<span<?php echo $Program_Budget_Allocation_summary->ActualAmount->viewAttributes() ?>><?php echo $Program_Budget_Allocation_summary->ActualAmount->SumViewValue ?></span>
</script>
</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Program_Budget_Allocation_summary->DepartmentCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Program_Budget_Allocation_summary->SectionCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputCode->Visible) { ?>
		<td data-field="OutputCode"<?php echo $Program_Budget_Allocation_summary->OutputCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->OutputName->Visible) { ?>
		<td data-field="OutputName"<?php echo $Program_Budget_Allocation_summary->OutputName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitOfMeasure->Visible) { ?>
		<td data-field="UnitOfMeasure"<?php echo $Program_Budget_Allocation_summary->UnitOfMeasure->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Quantity->Visible) { ?>
		<td data-field="Quantity"<?php echo $Program_Budget_Allocation_summary->Quantity->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodType->Visible) { ?>
		<td data-field="PeriodType"<?php echo $Program_Budget_Allocation_summary->PeriodType->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->PeriodLength->Visible) { ?>
		<td data-field="PeriodLength"<?php echo $Program_Budget_Allocation_summary->PeriodLength->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->Frequency->Visible) { ?>
		<td data-field="Frequency"<?php echo $Program_Budget_Allocation_summary->Frequency->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->UnitCost->Visible) { ?>
		<td data-field="UnitCost"<?php echo $Program_Budget_Allocation_summary->UnitCost->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->TotalGroups > 0) { ?>
<?php if (!$Program_Budget_Allocation_summary->isExport() && !($Program_Budget_Allocation_summary->DrillDown && $Program_Budget_Allocation_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Program_Budget_Allocation_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Program_Budget_Allocation_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<?php if ($Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->UseCustomTemplate) { ?>
<div id="tpd_Program_Budget_Allocationsummary"></div>
<script id="tpm_Program_Budget_Allocationsummary" type="text/html">
<div id="ct_Program_Budget_Allocation_summary"><p><?php echo date("F j, Y"); ?><p>
<?php
$cnt = $Page->GroupCount - 1;
for ($i = 1; $i <= $cnt; $i++) {
?>

<?php
$cnt1 = $Page->getGroupCount($i);
for ($i1 = 1; $i1 <= $cnt1; $i1++) {
?>
<p><b>Table 1 Budget Allocation by Programme</b>  </p>  
<table class="table table-striped ew-table ew-export-table" width="100%">
<tr>
<td><b><?php echo $Program_Budget_Allocation->AccountGroupName->caption() ?></b></td>
<td><b><?php echo $Program_Budget_Allocation->AccountName->caption() ?></b></td>
<td><b><?php echo $Program_Budget_Allocation->ProgramName->caption() ?></b></td>
<td><b><?php echo $Program_Budget_Allocation->SubProgramName->caption() ?></b></td>
<td><b><?php echo $Program_Budget_Allocation->BudgetEstimate->caption() ?></b></td>
</tr>
<?php
for ($j = 1; $j <= $Page->getGroupCount($i, $i1); $j++) {
?>
<tr>
<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_Program_Budget_Allocation_AccountGroupName")/}}</td>
<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_Program_Budget_Allocation_AccountName")/}}</td>
<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_Program_Budget_Allocation_ProgramName")/}}</td>
<td>{{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_Program_Budget_Allocation_SubProgramName")/}}</td>
<td> <div style="text-align: right;"> {{include tmpl=~getTemplate("#tpx<?php echo $i ?>_<?php echo $i1 ?>_<?php echo $j ?>_Program_Budget_Allocation_BudgetEstimate")/}}</td>
</tr>  
<?php
}
?>
<tr>
<td colspan="4"><div style="text-align: right;"><b>Total</b></div></td>
<td><b>{{include tmpl=~getTemplate("#tpgs<?php echo $i ?>_<?php echo $i1 ?>_Program_Budget_Allocation_BudgetEstimate")/}}</b></td>
</tr>
</table>
<?php
}
?>

<?php
if ($Page->ExportPageBreakCount > 0 && $Page->isExport()) {
if ($i % $Page->ExportPageBreakCount == 0 && $i < $cnt) {
?>
{{include tmpl=~getTemplate("#tpb<?php echo $i ?>_Program_Budget_Allocation")/}}
<?php
}
}
}
?>
</div>
</script>

<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div class="row">
	<div id="ew-bottom" class="<?php echo $Program_Budget_Allocation_summary->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($Program_Budget_Allocation_summary->isExport("print") || $Program_Budget_Allocation_summary->isExport("pdf") || $Program_Budget_Allocation_summary->isExport("email") || $Program_Budget_Allocation_summary->isExport("excel") && Config("USE_PHPEXCEL") || $Program_Budget_Allocation_summary->isExport("word") && Config("USE_PHPWORD")) && $Program_Budget_Allocation_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$Program_Budget_Allocation_summary->Page_Breaking($Program_Budget_Allocation_summary->ExportChartPageBreak, $Program_Budget_Allocation_summary->PageBreakContent);
		$Program_Budget_Allocation->Chart1->PageBreakType = "before"; // Page break type
		$Program_Budget_Allocation->Chart1->PageBreak = $Program_Budget_Allocation_summary->ExportChartPageBreak;
		$Program_Budget_Allocation->Chart1->PageBreakContent = $Program_Budget_Allocation_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$Program_Budget_Allocation->Chart1->DrillDownInPanel = $Program_Budget_Allocation_summary->DrillDownInPanel;
	$Program_Budget_Allocation->Chart1->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Program_Budget_Allocation_summary->isExport("email") && !$Program_Budget_Allocation_summary->DrillDown && $Program_Budget_Allocation->Chart1->hasData()) { ?>
<?php if (!$Program_Budget_Allocation_summary->isExport()) { ?>
<div class="mb-3"><a href="#" class="ew-top-link" onclick="$(document).scrollTop($('#top').offset().top); return false;"><?php echo $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
	</div>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if ((!$Program_Budget_Allocation_summary->isExport() || $Program_Budget_Allocation_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($Program_Budget_Allocation->Rows) ?> };
	ew.applyTemplate("tpd_Program_Budget_Allocationsummary", "tpm_Program_Budget_Allocationsummary", "Program_Budget_Allocationsummary", "<?php echo $Program_Budget_Allocation->CustomExport ?>", ew.templateData.rows[0]);
	$("script.Program_Budget_Allocationsummary_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$Program_Budget_Allocation_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Program_Budget_Allocation_summary->isExport() && !$Program_Budget_Allocation_summary->DrillDown && !$DashboardReport) { ?>
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
$Program_Budget_Allocation_summary->terminate();
?>