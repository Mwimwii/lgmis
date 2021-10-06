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
$PAYE_Summary_Report_summary = new PAYE_Summary_Report_summary();

// Run the page
$PAYE_Summary_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$PAYE_Summary_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport() && !$PAYE_Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$PAYE_Summary_Report_summary->isExport() || $PAYE_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$PAYE_Summary_Report_summary->DrillDownInPanel) {
	$PAYE_Summary_Report_summary->ExportOptions->render("body");
	$PAYE_Summary_Report_summary->SearchOptions->render("body");
	$PAYE_Summary_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $PAYE_Summary_Report_summary->showPageHeader(); ?>
<?php
$PAYE_Summary_Report_summary->showMessage();
?>
<?php if ((!$PAYE_Summary_Report_summary->isExport() || $PAYE_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$PAYE_Summary_Report_summary->isExport() || $PAYE_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $PAYE_Summary_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport() && !$PAYE_Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($PAYE_Summary_Report_summary->GroupCount <= count($PAYE_Summary_Report_summary->GroupRecords) && $PAYE_Summary_Report_summary->GroupCount <= $PAYE_Summary_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($PAYE_Summary_Report_summary->ShowHeader) {
?>
<?php if ($PAYE_Summary_Report_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TotalGroups > 0) { ?>
<?php if (!$PAYE_Summary_Report_summary->isExport() && !($PAYE_Summary_Report_summary->DrillDown && $PAYE_Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PAYE_Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $PAYE_Summary_Report_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$PAYE_Summary_Report_summary->isExport("word") && !$PAYE_Summary_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $PAYE_Summary_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport() && !($PAYE_Summary_Report_summary->DrillDown && $PAYE_Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PAYE_Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_PAYE_Summary_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $PAYE_Summary_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $PAYE_Summary_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="PAYE_Summary_Report_LocalAuthority"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $PAYE_Summary_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->LocalAuthority) ?>', 1);"><div class="PAYE_Summary_Report_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->DepartmentName->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
	<th data-name="DepartmentName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->DepartmentName) == "") { ?>
	<th data-name="DepartmentName" class="<?php echo $PAYE_Summary_Report_summary->DepartmentName->headerCellClass() ?>"><div class="PAYE_Summary_Report_DepartmentName"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->DepartmentName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="DepartmentName" class="<?php echo $PAYE_Summary_Report_summary->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->DepartmentName) ?>', 1);"><div class="PAYE_Summary_Report_DepartmentName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->SectionName->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
	<th data-name="SectionName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->SectionName) == "") { ?>
	<th data-name="SectionName" class="<?php echo $PAYE_Summary_Report_summary->SectionName->headerCellClass() ?>"><div class="PAYE_Summary_Report_SectionName"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->SectionName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="SectionName" class="<?php echo $PAYE_Summary_Report_summary->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->SectionName) ?>', 1);"><div class="PAYE_Summary_Report_SectionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Year->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->Year->ShowGroupHeaderAsRow) { ?>
	<th data-name="Year">&nbsp;</th>
	<?php } else { ?>
		<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->Year) == "") { ?>
	<th data-name="Year" class="<?php echo $PAYE_Summary_Report_summary->Year->headerCellClass() ?>"><div class="PAYE_Summary_Report_Year"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->Year->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="Year" class="<?php echo $PAYE_Summary_Report_summary->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->Year) ?>', 1);"><div class="PAYE_Summary_Report_Year">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->MonthShort->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->MonthShort->ShowGroupHeaderAsRow) { ?>
	<th data-name="MonthShort">&nbsp;</th>
	<?php } else { ?>
		<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->MonthShort) == "") { ?>
	<th data-name="MonthShort" class="<?php echo $PAYE_Summary_Report_summary->MonthShort->headerCellClass() ?>"><div class="PAYE_Summary_Report_MonthShort"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->MonthShort->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="MonthShort" class="<?php echo $PAYE_Summary_Report_summary->MonthShort->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->MonthShort) ?>', 1);"><div class="PAYE_Summary_Report_MonthShort">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->MonthShort->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->MonthShort->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->MonthShort->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeID->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->EmployeeID) == "") { ?>
	<th data-name="EmployeeID" class="<?php echo $PAYE_Summary_Report_summary->EmployeeID->headerCellClass() ?>"><div class="PAYE_Summary_Report_EmployeeID"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmployeeID" class="<?php echo $PAYE_Summary_Report_summary->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->EmployeeID) ?>', 1);"><div class="PAYE_Summary_Report_EmployeeID">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeNames->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->EmployeeNames) == "") { ?>
	<th data-name="EmployeeNames" class="<?php echo $PAYE_Summary_Report_summary->EmployeeNames->headerCellClass() ?>"><div class="PAYE_Summary_Report_EmployeeNames"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->EmployeeNames->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmployeeNames" class="<?php echo $PAYE_Summary_Report_summary->EmployeeNames->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->EmployeeNames) ?>', 1);"><div class="PAYE_Summary_Report_EmployeeNames">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->EmployeeNames->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->EmployeeNames->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->EmployeeNames->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmploymentTypeDesc->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->EmploymentTypeDesc) == "") { ?>
	<th data-name="EmploymentTypeDesc" class="<?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->headerCellClass() ?>"><div class="PAYE_Summary_Report_EmploymentTypeDesc"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmploymentTypeDesc" class="<?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->EmploymentTypeDesc) ?>', 1);"><div class="PAYE_Summary_Report_EmploymentTypeDesc">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->EmploymentTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->EmploymentTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->NRC->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->NRC) == "") { ?>
	<th data-name="NRC" class="<?php echo $PAYE_Summary_Report_summary->NRC->headerCellClass() ?>"><div class="PAYE_Summary_Report_NRC"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->NRC->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NRC" class="<?php echo $PAYE_Summary_Report_summary->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->NRC) ?>', 1);"><div class="PAYE_Summary_Report_NRC">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->GrossIncome->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->GrossIncome) == "") { ?>
	<th data-name="GrossIncome" class="<?php echo $PAYE_Summary_Report_summary->GrossIncome->headerCellClass() ?>"><div class="PAYE_Summary_Report_GrossIncome"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->GrossIncome->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="GrossIncome" class="<?php echo $PAYE_Summary_Report_summary->GrossIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->GrossIncome) ?>', 1);"><div class="PAYE_Summary_Report_GrossIncome">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->GrossIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->GrossIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->GrossIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxableIncome->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->TaxableIncome) == "") { ?>
	<th data-name="TaxableIncome" class="<?php echo $PAYE_Summary_Report_summary->TaxableIncome->headerCellClass() ?>"><div class="PAYE_Summary_Report_TaxableIncome"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->TaxableIncome->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="TaxableIncome" class="<?php echo $PAYE_Summary_Report_summary->TaxableIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->TaxableIncome) ?>', 1);"><div class="PAYE_Summary_Report_TaxableIncome">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->TaxableIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->TaxableIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->TaxableIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->PAYE->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->PAYE) == "") { ?>
	<th data-name="PAYE" class="<?php echo $PAYE_Summary_Report_summary->PAYE->headerCellClass() ?>"><div class="PAYE_Summary_Report_PAYE"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->PAYE->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PAYE" class="<?php echo $PAYE_Summary_Report_summary->PAYE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->PAYE) ?>', 1);"><div class="PAYE_Summary_Report_PAYE">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->PAYE->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->PAYE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->PAYE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxCredit->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->TaxCredit) == "") { ?>
	<th data-name="TaxCredit" class="<?php echo $PAYE_Summary_Report_summary->TaxCredit->headerCellClass() ?>"><div class="PAYE_Summary_Report_TaxCredit"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->TaxCredit->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="TaxCredit" class="<?php echo $PAYE_Summary_Report_summary->TaxCredit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->TaxCredit) ?>', 1);"><div class="PAYE_Summary_Report_TaxCredit">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->TaxCredit->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->TaxCredit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->TaxCredit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Adjustment->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->Adjustment) == "") { ?>
	<th data-name="Adjustment" class="<?php echo $PAYE_Summary_Report_summary->Adjustment->headerCellClass() ?>"><div class="PAYE_Summary_Report_Adjustment"><div class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->Adjustment->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Adjustment" class="<?php echo $PAYE_Summary_Report_summary->Adjustment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->Adjustment) ?>', 1);"><div class="PAYE_Summary_Report_Adjustment">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->Adjustment->caption() ?></span><span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->Adjustment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->Adjustment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($PAYE_Summary_Report_summary->TotalGroups == 0)
			break; // Show header only
		$PAYE_Summary_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($PAYE_Summary_Report_summary->LocalAuthority, $PAYE_Summary_Report_summary->getSqlFirstGroupField(), $PAYE_Summary_Report_summary->LocalAuthority->groupValue(), $PAYE_Summary_Report_summary->Dbid);
	if ($PAYE_Summary_Report_summary->PageFirstGroupFilter != "") $PAYE_Summary_Report_summary->PageFirstGroupFilter .= " OR ";
	$PAYE_Summary_Report_summary->PageFirstGroupFilter .= $where;
	if ($PAYE_Summary_Report_summary->Filter != "")
		$where = "($PAYE_Summary_Report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($PAYE_Summary_Report_summary->getSqlSelect(), $PAYE_Summary_Report_summary->getSqlWhere(), $PAYE_Summary_Report_summary->getSqlGroupBy(), $PAYE_Summary_Report_summary->getSqlHaving(), $PAYE_Summary_Report_summary->getSqlOrderBy(), $where, $PAYE_Summary_Report_summary->Sort);
	$rs = $PAYE_Summary_Report_summary->getRecordset($sql);
	$PAYE_Summary_Report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$PAYE_Summary_Report_summary->DetailRecordCount = count($PAYE_Summary_Report_summary->DetailRecords);

	// Load detail records
	$PAYE_Summary_Report_summary->LocalAuthority->Records = &$PAYE_Summary_Report_summary->DetailRecords;
	$PAYE_Summary_Report_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$PAYE_Summary_Report_summary->GroupCounter[1] = $PAYE_Summary_Report_summary->GroupCount;
		$PAYE_Summary_Report_summary->LocalAuthority->getCnt($PAYE_Summary_Report_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible && $PAYE_Summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$PAYE_Summary_Report_summary->resetAttributes();
		$PAYE_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$PAYE_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$PAYE_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$PAYE_Summary_Report_summary->RowGroupLevel = 1;
		$PAYE_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption PAYE_Summary_Report_LocalAuthority"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption PAYE_Summary_Report_LocalAuthority" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $PAYE_Summary_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($PAYE_Summary_Report_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$PAYE_Summary_Report_summary->DepartmentName->getDistinctValues($PAYE_Summary_Report_summary->LocalAuthority->Records);
	$PAYE_Summary_Report_summary->setGroupCount(count($PAYE_Summary_Report_summary->DepartmentName->DistinctValues), $PAYE_Summary_Report_summary->GroupCounter[1]);
	$PAYE_Summary_Report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($PAYE_Summary_Report_summary->DepartmentName->DistinctValues as $DepartmentName) { // Load records for this distinct value
		$PAYE_Summary_Report_summary->DepartmentName->setGroupValue($DepartmentName); // Set group value
		$PAYE_Summary_Report_summary->DepartmentName->getDistinctRecords($PAYE_Summary_Report_summary->LocalAuthority->Records, $PAYE_Summary_Report_summary->DepartmentName->groupValue());
		$PAYE_Summary_Report_summary->DepartmentName->LevelBreak = TRUE; // Set field level break
		$PAYE_Summary_Report_summary->GroupCounter[2]++;
		$PAYE_Summary_Report_summary->DepartmentName->getCnt($PAYE_Summary_Report_summary->DepartmentName->Records); // Get record count
?>
<?php if ($PAYE_Summary_Report_summary->DepartmentName->Visible && $PAYE_Summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$PAYE_Summary_Report_summary->DepartmentName->setDbValue($DepartmentName); // Set current value for DepartmentName
		$PAYE_Summary_Report_summary->resetAttributes();
		$PAYE_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$PAYE_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$PAYE_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$PAYE_Summary_Report_summary->RowGroupLevel = 2;
		$PAYE_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $PAYE_Summary_Report_summary->DepartmentName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="DepartmentName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $PAYE_Summary_Report_summary->DepartmentName->cellAttributes() ?>>
<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->DepartmentName) == "") { ?>
		<span class="ew-summary-caption PAYE_Summary_Report_DepartmentName"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->DepartmentName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption PAYE_Summary_Report_DepartmentName" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->DepartmentName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->DepartmentName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $PAYE_Summary_Report_summary->DepartmentName->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->DepartmentName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($PAYE_Summary_Report_summary->DepartmentName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$PAYE_Summary_Report_summary->SectionName->getDistinctValues($PAYE_Summary_Report_summary->DepartmentName->Records);
	$PAYE_Summary_Report_summary->setGroupCount(count($PAYE_Summary_Report_summary->SectionName->DistinctValues), $PAYE_Summary_Report_summary->GroupCounter[1], $PAYE_Summary_Report_summary->GroupCounter[2]);
	$PAYE_Summary_Report_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($PAYE_Summary_Report_summary->SectionName->DistinctValues as $SectionName) { // Load records for this distinct value
		$PAYE_Summary_Report_summary->SectionName->setGroupValue($SectionName); // Set group value
		$PAYE_Summary_Report_summary->SectionName->getDistinctRecords($PAYE_Summary_Report_summary->DepartmentName->Records, $PAYE_Summary_Report_summary->SectionName->groupValue());
		$PAYE_Summary_Report_summary->SectionName->LevelBreak = TRUE; // Set field level break
		$PAYE_Summary_Report_summary->GroupCounter[3]++;
		$PAYE_Summary_Report_summary->SectionName->getCnt($PAYE_Summary_Report_summary->SectionName->Records); // Get record count
?>
<?php if ($PAYE_Summary_Report_summary->SectionName->Visible && $PAYE_Summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$PAYE_Summary_Report_summary->SectionName->setDbValue($SectionName); // Set current value for SectionName
		$PAYE_Summary_Report_summary->resetAttributes();
		$PAYE_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$PAYE_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$PAYE_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$PAYE_Summary_Report_summary->RowGroupLevel = 3;
		$PAYE_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $PAYE_Summary_Report_summary->DepartmentName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $PAYE_Summary_Report_summary->SectionName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="SectionName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $PAYE_Summary_Report_summary->SectionName->cellAttributes() ?>>
<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->SectionName) == "") { ?>
		<span class="ew-summary-caption PAYE_Summary_Report_SectionName"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->SectionName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption PAYE_Summary_Report_SectionName" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->SectionName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->SectionName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $PAYE_Summary_Report_summary->SectionName->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->SectionName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($PAYE_Summary_Report_summary->SectionName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$PAYE_Summary_Report_summary->Year->getDistinctValues($PAYE_Summary_Report_summary->SectionName->Records);
	$PAYE_Summary_Report_summary->setGroupCount(count($PAYE_Summary_Report_summary->Year->DistinctValues), $PAYE_Summary_Report_summary->GroupCounter[1], $PAYE_Summary_Report_summary->GroupCounter[2], $PAYE_Summary_Report_summary->GroupCounter[3]);
	$PAYE_Summary_Report_summary->GroupCounter[4] = 0; // Init group count index
	foreach ($PAYE_Summary_Report_summary->Year->DistinctValues as $Year) { // Load records for this distinct value
		$PAYE_Summary_Report_summary->Year->setGroupValue($Year); // Set group value
		$PAYE_Summary_Report_summary->Year->getDistinctRecords($PAYE_Summary_Report_summary->SectionName->Records, $PAYE_Summary_Report_summary->Year->groupValue());
		$PAYE_Summary_Report_summary->Year->LevelBreak = TRUE; // Set field level break
		$PAYE_Summary_Report_summary->GroupCounter[4]++;
		$PAYE_Summary_Report_summary->Year->getCnt($PAYE_Summary_Report_summary->Year->Records); // Get record count
?>
<?php if ($PAYE_Summary_Report_summary->Year->Visible && $PAYE_Summary_Report_summary->Year->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$PAYE_Summary_Report_summary->Year->setDbValue($Year); // Set current value for Year
		$PAYE_Summary_Report_summary->resetAttributes();
		$PAYE_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$PAYE_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$PAYE_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$PAYE_Summary_Report_summary->RowGroupLevel = 4;
		$PAYE_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $PAYE_Summary_Report_summary->DepartmentName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $PAYE_Summary_Report_summary->SectionName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Year->Visible) { ?>
		<td data-field="Year"<?php echo $PAYE_Summary_Report_summary->Year->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="Year" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 4) ?>"<?php echo $PAYE_Summary_Report_summary->Year->cellAttributes() ?>>
<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->Year) == "") { ?>
		<span class="ew-summary-caption PAYE_Summary_Report_Year"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->Year->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption PAYE_Summary_Report_Year" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->Year) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->Year->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $PAYE_Summary_Report_summary->Year->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->Year->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($PAYE_Summary_Report_summary->Year->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$PAYE_Summary_Report_summary->MonthShort->getDistinctValues($PAYE_Summary_Report_summary->Year->Records);
	$PAYE_Summary_Report_summary->setGroupCount(count($PAYE_Summary_Report_summary->MonthShort->DistinctValues), $PAYE_Summary_Report_summary->GroupCounter[1], $PAYE_Summary_Report_summary->GroupCounter[2], $PAYE_Summary_Report_summary->GroupCounter[3], $PAYE_Summary_Report_summary->GroupCounter[4]);
	$PAYE_Summary_Report_summary->GroupCounter[5] = 0; // Init group count index
	foreach ($PAYE_Summary_Report_summary->MonthShort->DistinctValues as $MonthShort) { // Load records for this distinct value
		$PAYE_Summary_Report_summary->MonthShort->setGroupValue($MonthShort); // Set group value
		$PAYE_Summary_Report_summary->MonthShort->getDistinctRecords($PAYE_Summary_Report_summary->Year->Records, $PAYE_Summary_Report_summary->MonthShort->groupValue());
		$PAYE_Summary_Report_summary->MonthShort->LevelBreak = TRUE; // Set field level break
		$PAYE_Summary_Report_summary->GroupCounter[5]++;
		$PAYE_Summary_Report_summary->MonthShort->getCnt($PAYE_Summary_Report_summary->MonthShort->Records); // Get record count
		$PAYE_Summary_Report_summary->setGroupCount($PAYE_Summary_Report_summary->MonthShort->Count, $PAYE_Summary_Report_summary->GroupCounter[1], $PAYE_Summary_Report_summary->GroupCounter[2], $PAYE_Summary_Report_summary->GroupCounter[3], $PAYE_Summary_Report_summary->GroupCounter[4], $PAYE_Summary_Report_summary->GroupCounter[5]);
?>
<?php if ($PAYE_Summary_Report_summary->MonthShort->Visible && $PAYE_Summary_Report_summary->MonthShort->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$PAYE_Summary_Report_summary->MonthShort->setDbValue($MonthShort); // Set current value for MonthShort
		$PAYE_Summary_Report_summary->resetAttributes();
		$PAYE_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$PAYE_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$PAYE_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$PAYE_Summary_Report_summary->RowGroupLevel = 5;
		$PAYE_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $PAYE_Summary_Report_summary->DepartmentName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $PAYE_Summary_Report_summary->SectionName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Year->Visible) { ?>
		<td data-field="Year"<?php echo $PAYE_Summary_Report_summary->Year->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->MonthShort->Visible) { ?>
		<td data-field="MonthShort"<?php echo $PAYE_Summary_Report_summary->MonthShort->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="MonthShort" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 5) ?>"<?php echo $PAYE_Summary_Report_summary->MonthShort->cellAttributes() ?>>
<?php if ($PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->MonthShort) == "") { ?>
		<span class="ew-summary-caption PAYE_Summary_Report_MonthShort"><span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->MonthShort->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption PAYE_Summary_Report_MonthShort" onclick="ew.sort(event, '<?php echo $PAYE_Summary_Report_summary->sortUrl($PAYE_Summary_Report_summary->MonthShort) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $PAYE_Summary_Report_summary->MonthShort->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($PAYE_Summary_Report_summary->MonthShort->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($PAYE_Summary_Report_summary->MonthShort->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $PAYE_Summary_Report_summary->MonthShort->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->MonthShort->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($PAYE_Summary_Report_summary->MonthShort->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$PAYE_Summary_Report_summary->RecordCount = 0; // Reset record count
	foreach ($PAYE_Summary_Report_summary->MonthShort->Records as $record) {
		$PAYE_Summary_Report_summary->RecordCount++;
		$PAYE_Summary_Report_summary->RecordIndex++;
		$PAYE_Summary_Report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$PAYE_Summary_Report_summary->resetAttributes();
		$PAYE_Summary_Report_summary->RowType = ROWTYPE_DETAIL;
		$PAYE_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $PAYE_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $PAYE_Summary_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->DepartmentName->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
		<td data-field="DepartmentName"<?php echo $PAYE_Summary_Report_summary->DepartmentName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="DepartmentName"<?php echo $PAYE_Summary_Report_summary->DepartmentName->cellAttributes(); ?>><span<?php echo $PAYE_Summary_Report_summary->DepartmentName->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->DepartmentName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->SectionName->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
		<td data-field="SectionName"<?php echo $PAYE_Summary_Report_summary->SectionName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="SectionName"<?php echo $PAYE_Summary_Report_summary->SectionName->cellAttributes(); ?>><span<?php echo $PAYE_Summary_Report_summary->SectionName->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->SectionName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Year->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->Year->ShowGroupHeaderAsRow) { ?>
		<td data-field="Year"<?php echo $PAYE_Summary_Report_summary->Year->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="Year"<?php echo $PAYE_Summary_Report_summary->Year->cellAttributes(); ?>><span<?php echo $PAYE_Summary_Report_summary->Year->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->Year->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->MonthShort->Visible) { ?>
	<?php if ($PAYE_Summary_Report_summary->MonthShort->ShowGroupHeaderAsRow) { ?>
		<td data-field="MonthShort"<?php echo $PAYE_Summary_Report_summary->MonthShort->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="MonthShort"<?php echo $PAYE_Summary_Report_summary->MonthShort->cellAttributes(); ?>><span<?php echo $PAYE_Summary_Report_summary->MonthShort->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->MonthShort->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $PAYE_Summary_Report_summary->EmployeeID->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->EmployeeID->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeNames->Visible) { ?>
		<td data-field="EmployeeNames"<?php echo $PAYE_Summary_Report_summary->EmployeeNames->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->EmployeeNames->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->EmployeeNames->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmploymentTypeDesc->Visible) { ?>
		<td data-field="EmploymentTypeDesc"<?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $PAYE_Summary_Report_summary->NRC->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->NRC->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->NRC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->GrossIncome->Visible) { ?>
		<td data-field="GrossIncome"<?php echo $PAYE_Summary_Report_summary->GrossIncome->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->GrossIncome->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->GrossIncome->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxableIncome->Visible) { ?>
		<td data-field="TaxableIncome"<?php echo $PAYE_Summary_Report_summary->TaxableIncome->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->TaxableIncome->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->TaxableIncome->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->PAYE->Visible) { ?>
		<td data-field="PAYE"<?php echo $PAYE_Summary_Report_summary->PAYE->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->PAYE->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->PAYE->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxCredit->Visible) { ?>
		<td data-field="TaxCredit"<?php echo $PAYE_Summary_Report_summary->TaxCredit->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->TaxCredit->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->TaxCredit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Adjustment->Visible) { ?>
		<td data-field="Adjustment"<?php echo $PAYE_Summary_Report_summary->Adjustment->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->Adjustment->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->Adjustment->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
	} // End group level 4
	} // End group level 3
	} // End group level 2
	} // End group level 1
?>
<?php

	// Next group
	$PAYE_Summary_Report_summary->loadGroupRowValues();

	// Show header if page break
	if ($PAYE_Summary_Report_summary->isExport())
		$PAYE_Summary_Report_summary->ShowHeader = ($PAYE_Summary_Report_summary->ExportPageBreakCount == 0) ? FALSE : ($PAYE_Summary_Report_summary->GroupCount % $PAYE_Summary_Report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($PAYE_Summary_Report_summary->ShowHeader)
		$PAYE_Summary_Report_summary->Page_Breaking($PAYE_Summary_Report_summary->ShowHeader, $PAYE_Summary_Report_summary->PageBreakContent);
	$PAYE_Summary_Report_summary->GroupCount++;
} // End while
?>
<?php if ($PAYE_Summary_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$PAYE_Summary_Report_summary->resetAttributes();
	$PAYE_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
	$PAYE_Summary_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$PAYE_Summary_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$PAYE_Summary_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$PAYE_Summary_Report_summary->renderRow();
?>
<?php if ($PAYE_Summary_Report_summary->LocalAuthority->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($PAYE_Summary_Report_summary->GroupColumnCount + $PAYE_Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($PAYE_Summary_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes() ?>>
<?php if ($PAYE_Summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $PAYE_Summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $PAYE_Summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeNames->Visible) { ?>
		<td data-field="EmployeeNames"<?php echo $PAYE_Summary_Report_summary->EmployeeNames->cellAttributes() ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmploymentTypeDesc->Visible) { ?>
		<td data-field="EmploymentTypeDesc"<?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->cellAttributes() ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $PAYE_Summary_Report_summary->NRC->cellAttributes() ?>></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->GrossIncome->Visible) { ?>
		<td data-field="GrossIncome"<?php echo $PAYE_Summary_Report_summary->GrossIncome->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $PAYE_Summary_Report_summary->GrossIncome->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->GrossIncome->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxableIncome->Visible) { ?>
		<td data-field="TaxableIncome"<?php echo $PAYE_Summary_Report_summary->TaxableIncome->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $PAYE_Summary_Report_summary->TaxableIncome->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->TaxableIncome->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->PAYE->Visible) { ?>
		<td data-field="PAYE"<?php echo $PAYE_Summary_Report_summary->PAYE->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $PAYE_Summary_Report_summary->PAYE->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->PAYE->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxCredit->Visible) { ?>
		<td data-field="TaxCredit"<?php echo $PAYE_Summary_Report_summary->TaxCredit->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $PAYE_Summary_Report_summary->TaxCredit->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->TaxCredit->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Adjustment->Visible) { ?>
		<td data-field="Adjustment"<?php echo $PAYE_Summary_Report_summary->Adjustment->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $PAYE_Summary_Report_summary->Adjustment->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->Adjustment->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($PAYE_Summary_Report_summary->GroupColumnCount + $PAYE_Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($PAYE_Summary_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $PAYE_Summary_Report_summary->rowAttributes() ?>>
<?php if ($PAYE_Summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $PAYE_Summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $PAYE_Summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmployeeNames->Visible) { ?>
		<td data-field="EmployeeNames"<?php echo $PAYE_Summary_Report_summary->EmployeeNames->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->EmploymentTypeDesc->Visible) { ?>
		<td data-field="EmploymentTypeDesc"<?php echo $PAYE_Summary_Report_summary->EmploymentTypeDesc->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $PAYE_Summary_Report_summary->NRC->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->GrossIncome->Visible) { ?>
		<td data-field="GrossIncome"<?php echo $PAYE_Summary_Report_summary->GrossIncome->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->GrossIncome->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->GrossIncome->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxableIncome->Visible) { ?>
		<td data-field="TaxableIncome"<?php echo $PAYE_Summary_Report_summary->TaxableIncome->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->TaxableIncome->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->TaxableIncome->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->PAYE->Visible) { ?>
		<td data-field="PAYE"<?php echo $PAYE_Summary_Report_summary->PAYE->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->PAYE->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->PAYE->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TaxCredit->Visible) { ?>
		<td data-field="TaxCredit"<?php echo $PAYE_Summary_Report_summary->TaxCredit->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->TaxCredit->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->TaxCredit->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->Adjustment->Visible) { ?>
		<td data-field="Adjustment"<?php echo $PAYE_Summary_Report_summary->Adjustment->cellAttributes() ?>>
<span<?php echo $PAYE_Summary_Report_summary->Adjustment->viewAttributes() ?>><?php echo $PAYE_Summary_Report_summary->Adjustment->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($PAYE_Summary_Report_summary->TotalGroups > 0) { ?>
<?php if (!$PAYE_Summary_Report_summary->isExport() && !($PAYE_Summary_Report_summary->DrillDown && $PAYE_Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $PAYE_Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$PAYE_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$PAYE_Summary_Report_summary->isExport() || $PAYE_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$PAYE_Summary_Report_summary->isExport() || $PAYE_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$PAYE_Summary_Report_summary->isExport() || $PAYE_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$PAYE_Summary_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$PAYE_Summary_Report_summary->isExport() && !$PAYE_Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
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
$PAYE_Summary_Report_summary->terminate();
?>