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
$Payroll_Income_summary_Report_summary = new Payroll_Income_summary_Report_summary();

// Run the page
$Payroll_Income_summary_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Payroll_Income_summary_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport() && !$Payroll_Income_summary_Report_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Payroll_Income_summary_Report_summary->isExport() || $Payroll_Income_summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Payroll_Income_summary_Report_summary->DrillDownInPanel) {
	$Payroll_Income_summary_Report_summary->ExportOptions->render("body");
	$Payroll_Income_summary_Report_summary->SearchOptions->render("body");
	$Payroll_Income_summary_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Payroll_Income_summary_Report_summary->showPageHeader(); ?>
<?php
$Payroll_Income_summary_Report_summary->showMessage();
?>
<?php if ((!$Payroll_Income_summary_Report_summary->isExport() || $Payroll_Income_summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Payroll_Income_summary_Report_summary->isExport() || $Payroll_Income_summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Payroll_Income_summary_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport() && !$Payroll_Income_summary_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Payroll_Income_summary_Report_summary->GroupCount <= count($Payroll_Income_summary_Report_summary->GroupRecords) && $Payroll_Income_summary_Report_summary->GroupCount <= $Payroll_Income_summary_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Payroll_Income_summary_Report_summary->ShowHeader) {
?>
<?php if ($Payroll_Income_summary_Report_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport() && !($Payroll_Income_summary_Report_summary->DrillDown && $Payroll_Income_summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Income_summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Payroll_Income_summary_Report_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Payroll_Income_summary_Report_summary->isExport("word") && !$Payroll_Income_summary_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Payroll_Income_summary_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport() && !($Payroll_Income_summary_Report_summary->DrillDown && $Payroll_Income_summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Income_summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Payroll_Income_summary_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Payroll_Income_summary_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PayPeriod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PayPeriod) == "") { ?>
	<th data-name="PayPeriod" class="<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_PayPeriod"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PayPeriod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PayPeriod" class="<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PayPeriod) ?>', 1);"><div class="Payroll_Income_summary_Report_PayPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PayPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->PayPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->PayPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->Division->ShowGroupHeaderAsRow) { ?>
	<th data-name="Division">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Division) == "") { ?>
	<th data-name="Division" class="<?php echo $Payroll_Income_summary_Report_summary->Division->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_Division"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Division->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="Division" class="<?php echo $Payroll_Income_summary_Report_summary->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Division) ?>', 1);"><div class="Payroll_Income_summary_Report_Division">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_LocalAuthority"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->LocalAuthority) ?>', 1);"><div class="Payroll_Income_summary_Report_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
	<th data-name="DepartmentName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->DepartmentName) == "") { ?>
	<th data-name="DepartmentName" class="<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_DepartmentName"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->DepartmentName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="DepartmentName" class="<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->DepartmentName) ?>', 1);"><div class="Payroll_Income_summary_Report_DepartmentName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
	<th data-name="SectionName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->SectionName) == "") { ?>
	<th data-name="SectionName" class="<?php echo $Payroll_Income_summary_Report_summary->SectionName->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_SectionName"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->SectionName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="SectionName" class="<?php echo $Payroll_Income_summary_Report_summary->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->SectionName) ?>', 1);"><div class="Payroll_Income_summary_Report_SectionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->ShowGroupHeaderAsRow) { ?>
	<th data-name="EmployeeID">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->EmployeeID) == "") { ?>
	<th data-name="EmployeeID" class="<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_EmployeeID"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->EmployeeID->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="EmployeeID" class="<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->EmployeeID) ?>', 1);"><div class="Payroll_Income_summary_Report_EmployeeID">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Title) == "") { ?>
	<th data-name="Title" class="<?php echo $Payroll_Income_summary_Report_summary->Title->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_Title"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Title->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Title" class="<?php echo $Payroll_Income_summary_Report_summary->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Title) ?>', 1);"><div class="Payroll_Income_summary_Report_Title">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $Payroll_Income_summary_Report_summary->Surname->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_Surname"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $Payroll_Income_summary_Report_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Surname) ?>', 1);"><div class="Payroll_Income_summary_Report_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $Payroll_Income_summary_Report_summary->FirstName->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_FirstName"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $Payroll_Income_summary_Report_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->FirstName) ?>', 1);"><div class="Payroll_Income_summary_Report_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $Payroll_Income_summary_Report_summary->MiddleName->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_MiddleName"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $Payroll_Income_summary_Report_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->MiddleName) ?>', 1);"><div class="Payroll_Income_summary_Report_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Sex) == "") { ?>
	<th data-name="Sex" class="<?php echo $Payroll_Income_summary_Report_summary->Sex->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_Sex"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Sex->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Sex" class="<?php echo $Payroll_Income_summary_Report_summary->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Sex) ?>', 1);"><div class="Payroll_Income_summary_Report_Sex">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->NRC) == "") { ?>
	<th data-name="NRC" class="<?php echo $Payroll_Income_summary_Report_summary->NRC->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_NRC"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->NRC->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NRC" class="<?php echo $Payroll_Income_summary_Report_summary->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->NRC) ?>', 1);"><div class="Payroll_Income_summary_Report_NRC">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->SalaryScale) == "") { ?>
	<th data-name="SalaryScale" class="<?php echo $Payroll_Income_summary_Report_summary->SalaryScale->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_SalaryScale"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="SalaryScale" class="<?php echo $Payroll_Income_summary_Report_summary->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->SalaryScale) ?>', 1);"><div class="Payroll_Income_summary_Report_SalaryScale">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PositionName) == "") { ?>
	<th data-name="PositionName" class="<?php echo $Payroll_Income_summary_Report_summary->PositionName->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_PositionName"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PositionName" class="<?php echo $Payroll_Income_summary_Report_summary->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PositionName) ?>', 1);"><div class="Payroll_Income_summary_Report_PositionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PaymentMethod) == "") { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_PaymentMethod"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PaymentMethod) ?>', 1);"><div class="Payroll_Income_summary_Report_PaymentMethod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->BankBranchCode) == "") { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_BankBranchCode"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->BankBranchCode) ?>', 1);"><div class="Payroll_Income_summary_Report_BankBranchCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->BankAccountNo) == "") { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_BankAccountNo"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->BankAccountNo) ?>', 1);"><div class="Payroll_Income_summary_Report_BankAccountNo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PayrollPeriod) == "") { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PayrollPeriod) ?>', 1);"><div class="Payroll_Income_summary_Report_PayrollPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->pCode) == "") { ?>
	<th data-name="pCode" class="<?php echo $Payroll_Income_summary_Report_summary->pCode->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_pCode"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->pCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="pCode" class="<?php echo $Payroll_Income_summary_Report_summary->pCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->pCode) ?>', 1);"><div class="Payroll_Income_summary_Report_pCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->pCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->pCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->pCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->pName) == "") { ?>
	<th data-name="pName" class="<?php echo $Payroll_Income_summary_Report_summary->pName->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_pName"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->pName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="pName" class="<?php echo $Payroll_Income_summary_Report_summary->pName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->pName) ?>', 1);"><div class="Payroll_Income_summary_Report_pName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->pName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Amount) == "") { ?>
	<th data-name="Amount" class="<?php echo $Payroll_Income_summary_Report_summary->Amount->headerCellClass() ?>"><div class="Payroll_Income_summary_Report_Amount"><div class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Amount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Amount" class="<?php echo $Payroll_Income_summary_Report_summary->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Amount) ?>', 1);"><div class="Payroll_Income_summary_Report_Amount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Payroll_Income_summary_Report_summary->TotalGroups == 0)
			break; // Show header only
		$Payroll_Income_summary_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Payroll_Income_summary_Report_summary->PayPeriod, $Payroll_Income_summary_Report_summary->getSqlFirstGroupField(), $Payroll_Income_summary_Report_summary->PayPeriod->groupValue(), $Payroll_Income_summary_Report_summary->Dbid);
	if ($Payroll_Income_summary_Report_summary->PageFirstGroupFilter != "") $Payroll_Income_summary_Report_summary->PageFirstGroupFilter .= " OR ";
	$Payroll_Income_summary_Report_summary->PageFirstGroupFilter .= $where;
	if ($Payroll_Income_summary_Report_summary->Filter != "")
		$where = "($Payroll_Income_summary_Report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Payroll_Income_summary_Report_summary->getSqlSelect(), $Payroll_Income_summary_Report_summary->getSqlWhere(), $Payroll_Income_summary_Report_summary->getSqlGroupBy(), $Payroll_Income_summary_Report_summary->getSqlHaving(), $Payroll_Income_summary_Report_summary->getSqlOrderBy(), $where, $Payroll_Income_summary_Report_summary->Sort);
	$rs = $Payroll_Income_summary_Report_summary->getRecordset($sql);
	$Payroll_Income_summary_Report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Payroll_Income_summary_Report_summary->DetailRecordCount = count($Payroll_Income_summary_Report_summary->DetailRecords);

	// Load detail records
	$Payroll_Income_summary_Report_summary->PayPeriod->Records = &$Payroll_Income_summary_Report_summary->DetailRecords;
	$Payroll_Income_summary_Report_summary->PayPeriod->LevelBreak = TRUE; // Set field level break
		$Payroll_Income_summary_Report_summary->GroupCounter[1] = $Payroll_Income_summary_Report_summary->GroupCount;
		$Payroll_Income_summary_Report_summary->PayPeriod->getCnt($Payroll_Income_summary_Report_summary->PayPeriod->Records); // Get record count
?>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible && $Payroll_Income_summary_Report_summary->PayPeriod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Income_summary_Report_summary->resetAttributes();
		$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Income_summary_Report_summary->RowGroupLevel = 1;
		$Payroll_Income_summary_Report_summary->renderRow();
?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PayPeriod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PayPeriod) == "") { ?>
		<span class="ew-summary-caption Payroll_Income_summary_Report_PayPeriod"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PayPeriod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Income_summary_Report_PayPeriod" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->PayPeriod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->PayPeriod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->PayPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->PayPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->PayPeriod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->PayPeriod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Income_summary_Report_summary->Division->getDistinctValues($Payroll_Income_summary_Report_summary->PayPeriod->Records);
	$Payroll_Income_summary_Report_summary->setGroupCount(count($Payroll_Income_summary_Report_summary->Division->DistinctValues), $Payroll_Income_summary_Report_summary->GroupCounter[1]);
	$Payroll_Income_summary_Report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Payroll_Income_summary_Report_summary->Division->DistinctValues as $Division) { // Load records for this distinct value
		$Payroll_Income_summary_Report_summary->Division->setGroupValue($Division); // Set group value
		$Payroll_Income_summary_Report_summary->Division->getDistinctRecords($Payroll_Income_summary_Report_summary->PayPeriod->Records, $Payroll_Income_summary_Report_summary->Division->groupValue());
		$Payroll_Income_summary_Report_summary->Division->LevelBreak = TRUE; // Set field level break
		$Payroll_Income_summary_Report_summary->GroupCounter[2]++;
		$Payroll_Income_summary_Report_summary->Division->getCnt($Payroll_Income_summary_Report_summary->Division->Records); // Get record count
?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible && $Payroll_Income_summary_Report_summary->Division->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Income_summary_Report_summary->Division->setDbValue($Division); // Set current value for Division
		$Payroll_Income_summary_Report_summary->resetAttributes();
		$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Income_summary_Report_summary->RowGroupLevel = 2;
		$Payroll_Income_summary_Report_summary->renderRow();
?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="Division" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Division) == "") { ?>
		<span class="ew-summary-caption Payroll_Income_summary_Report_Division"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Division->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Income_summary_Report_Division" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->Division) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->Division->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Income_summary_Report_summary->Division->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Division->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->Division->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Income_summary_Report_summary->LocalAuthority->getDistinctValues($Payroll_Income_summary_Report_summary->Division->Records);
	$Payroll_Income_summary_Report_summary->setGroupCount(count($Payroll_Income_summary_Report_summary->LocalAuthority->DistinctValues), $Payroll_Income_summary_Report_summary->GroupCounter[1], $Payroll_Income_summary_Report_summary->GroupCounter[2]);
	$Payroll_Income_summary_Report_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($Payroll_Income_summary_Report_summary->LocalAuthority->DistinctValues as $LocalAuthority) { // Load records for this distinct value
		$Payroll_Income_summary_Report_summary->LocalAuthority->setGroupValue($LocalAuthority); // Set group value
		$Payroll_Income_summary_Report_summary->LocalAuthority->getDistinctRecords($Payroll_Income_summary_Report_summary->Division->Records, $Payroll_Income_summary_Report_summary->LocalAuthority->groupValue());
		$Payroll_Income_summary_Report_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$Payroll_Income_summary_Report_summary->GroupCounter[3]++;
		$Payroll_Income_summary_Report_summary->LocalAuthority->getCnt($Payroll_Income_summary_Report_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible && $Payroll_Income_summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Income_summary_Report_summary->LocalAuthority->setDbValue($LocalAuthority); // Set current value for LocalAuthority
		$Payroll_Income_summary_Report_summary->resetAttributes();
		$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Income_summary_Report_summary->RowGroupLevel = 3;
		$Payroll_Income_summary_Report_summary->renderRow();
?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption Payroll_Income_summary_Report_LocalAuthority"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Income_summary_Report_LocalAuthority" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Income_summary_Report_summary->DepartmentName->getDistinctValues($Payroll_Income_summary_Report_summary->LocalAuthority->Records);
	$Payroll_Income_summary_Report_summary->setGroupCount(count($Payroll_Income_summary_Report_summary->DepartmentName->DistinctValues), $Payroll_Income_summary_Report_summary->GroupCounter[1], $Payroll_Income_summary_Report_summary->GroupCounter[2], $Payroll_Income_summary_Report_summary->GroupCounter[3]);
	$Payroll_Income_summary_Report_summary->GroupCounter[4] = 0; // Init group count index
	foreach ($Payroll_Income_summary_Report_summary->DepartmentName->DistinctValues as $DepartmentName) { // Load records for this distinct value
		$Payroll_Income_summary_Report_summary->DepartmentName->setGroupValue($DepartmentName); // Set group value
		$Payroll_Income_summary_Report_summary->DepartmentName->getDistinctRecords($Payroll_Income_summary_Report_summary->LocalAuthority->Records, $Payroll_Income_summary_Report_summary->DepartmentName->groupValue());
		$Payroll_Income_summary_Report_summary->DepartmentName->LevelBreak = TRUE; // Set field level break
		$Payroll_Income_summary_Report_summary->GroupCounter[4]++;
		$Payroll_Income_summary_Report_summary->DepartmentName->getCnt($Payroll_Income_summary_Report_summary->DepartmentName->Records); // Get record count
?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible && $Payroll_Income_summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Income_summary_Report_summary->DepartmentName->setDbValue($DepartmentName); // Set current value for DepartmentName
		$Payroll_Income_summary_Report_summary->resetAttributes();
		$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Income_summary_Report_summary->RowGroupLevel = 4;
		$Payroll_Income_summary_Report_summary->renderRow();
?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="DepartmentName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 4) ?>"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->DepartmentName) == "") { ?>
		<span class="ew-summary-caption Payroll_Income_summary_Report_DepartmentName"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->DepartmentName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Income_summary_Report_DepartmentName" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->DepartmentName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->DepartmentName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->DepartmentName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->DepartmentName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Income_summary_Report_summary->SectionName->getDistinctValues($Payroll_Income_summary_Report_summary->DepartmentName->Records);
	$Payroll_Income_summary_Report_summary->setGroupCount(count($Payroll_Income_summary_Report_summary->SectionName->DistinctValues), $Payroll_Income_summary_Report_summary->GroupCounter[1], $Payroll_Income_summary_Report_summary->GroupCounter[2], $Payroll_Income_summary_Report_summary->GroupCounter[3], $Payroll_Income_summary_Report_summary->GroupCounter[4]);
	$Payroll_Income_summary_Report_summary->GroupCounter[5] = 0; // Init group count index
	foreach ($Payroll_Income_summary_Report_summary->SectionName->DistinctValues as $SectionName) { // Load records for this distinct value
		$Payroll_Income_summary_Report_summary->SectionName->setGroupValue($SectionName); // Set group value
		$Payroll_Income_summary_Report_summary->SectionName->getDistinctRecords($Payroll_Income_summary_Report_summary->DepartmentName->Records, $Payroll_Income_summary_Report_summary->SectionName->groupValue());
		$Payroll_Income_summary_Report_summary->SectionName->LevelBreak = TRUE; // Set field level break
		$Payroll_Income_summary_Report_summary->GroupCounter[5]++;
		$Payroll_Income_summary_Report_summary->SectionName->getCnt($Payroll_Income_summary_Report_summary->SectionName->Records); // Get record count
?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible && $Payroll_Income_summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Income_summary_Report_summary->SectionName->setDbValue($SectionName); // Set current value for SectionName
		$Payroll_Income_summary_Report_summary->resetAttributes();
		$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Income_summary_Report_summary->RowGroupLevel = 5;
		$Payroll_Income_summary_Report_summary->renderRow();
?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="SectionName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 5) ?>"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->SectionName) == "") { ?>
		<span class="ew-summary-caption Payroll_Income_summary_Report_SectionName"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->SectionName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Income_summary_Report_SectionName" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->SectionName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->SectionName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Income_summary_Report_summary->SectionName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->SectionName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->SectionName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Income_summary_Report_summary->EmployeeID->getDistinctValues($Payroll_Income_summary_Report_summary->SectionName->Records);
	$Payroll_Income_summary_Report_summary->setGroupCount(count($Payroll_Income_summary_Report_summary->EmployeeID->DistinctValues), $Payroll_Income_summary_Report_summary->GroupCounter[1], $Payroll_Income_summary_Report_summary->GroupCounter[2], $Payroll_Income_summary_Report_summary->GroupCounter[3], $Payroll_Income_summary_Report_summary->GroupCounter[4], $Payroll_Income_summary_Report_summary->GroupCounter[5]);
	$Payroll_Income_summary_Report_summary->GroupCounter[6] = 0; // Init group count index
	foreach ($Payroll_Income_summary_Report_summary->EmployeeID->DistinctValues as $EmployeeID) { // Load records for this distinct value
		$Payroll_Income_summary_Report_summary->EmployeeID->setGroupValue($EmployeeID); // Set group value
		$Payroll_Income_summary_Report_summary->EmployeeID->getDistinctRecords($Payroll_Income_summary_Report_summary->SectionName->Records, $Payroll_Income_summary_Report_summary->EmployeeID->groupValue());
		$Payroll_Income_summary_Report_summary->EmployeeID->LevelBreak = TRUE; // Set field level break
		$Payroll_Income_summary_Report_summary->GroupCounter[6]++;
		$Payroll_Income_summary_Report_summary->EmployeeID->getCnt($Payroll_Income_summary_Report_summary->EmployeeID->Records); // Get record count
		$Payroll_Income_summary_Report_summary->setGroupCount($Payroll_Income_summary_Report_summary->EmployeeID->Count, $Payroll_Income_summary_Report_summary->GroupCounter[1], $Payroll_Income_summary_Report_summary->GroupCounter[2], $Payroll_Income_summary_Report_summary->GroupCounter[3], $Payroll_Income_summary_Report_summary->GroupCounter[4], $Payroll_Income_summary_Report_summary->GroupCounter[5], $Payroll_Income_summary_Report_summary->GroupCounter[6]);
?>
<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->Visible && $Payroll_Income_summary_Report_summary->EmployeeID->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Income_summary_Report_summary->EmployeeID->setDbValue($EmployeeID); // Set current value for EmployeeID
		$Payroll_Income_summary_Report_summary->resetAttributes();
		$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Income_summary_Report_summary->RowGroupLevel = 6;
		$Payroll_Income_summary_Report_summary->renderRow();
?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="EmployeeID" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 6) ?>"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->EmployeeID) == "") { ?>
		<span class="ew-summary-caption Payroll_Income_summary_Report_EmployeeID"><span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->EmployeeID->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Income_summary_Report_EmployeeID" onclick="ew.sort(event, '<?php echo $Payroll_Income_summary_Report_summary->sortUrl($Payroll_Income_summary_Report_summary->EmployeeID) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Income_summary_Report_summary->EmployeeID->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Income_summary_Report_summary->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Income_summary_Report_summary->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->EmployeeID->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->EmployeeID->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Income_summary_Report_summary->RecordCount = 0; // Reset record count
	foreach ($Payroll_Income_summary_Report_summary->EmployeeID->Records as $record) {
		$Payroll_Income_summary_Report_summary->RecordCount++;
		$Payroll_Income_summary_Report_summary->RecordIndex++;
		$Payroll_Income_summary_Report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Payroll_Income_summary_Report_summary->resetAttributes();
		$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_DETAIL;
		$Payroll_Income_summary_Report_summary->renderRow();
?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->ShowGroupHeaderAsRow) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes(); ?>><span<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->PayPeriod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->Division->ShowGroupHeaderAsRow) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes(); ?>><span<?php echo $Payroll_Income_summary_Report_summary->Division->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Division->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes(); ?>><span<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->DepartmentName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes(); ?>><span<?php echo $Payroll_Income_summary_Report_summary->SectionName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->SectionName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->Visible) { ?>
	<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->ShowGroupHeaderAsRow) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes(); ?>><span<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->EmployeeID->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Income_summary_Report_summary->Title->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->Title->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Income_summary_Report_summary->Surname->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->Surname->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Income_summary_Report_summary->FirstName->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->FirstName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Income_summary_Report_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->MiddleName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Payroll_Income_summary_Report_summary->Sex->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->Sex->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Sex->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Payroll_Income_summary_Report_summary->NRC->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->NRC->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->NRC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Payroll_Income_summary_Report_summary->SalaryScale->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->SalaryScale->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Income_summary_Report_summary->PositionName->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->PositionName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Income_summary_Report_summary->pCode->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->pCode->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->pCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Income_summary_Report_summary->pName->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->pName->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->pName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Income_summary_Report_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Amount->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Payroll_Income_summary_Report_summary->TotalGroups > 0) { ?>
<?php
	$Payroll_Income_summary_Report_summary->Amount->getSum($Payroll_Income_summary_Report_summary->EmployeeID->Records); // Get Sum
	$Payroll_Income_summary_Report_summary->resetAttributes();
	$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
	$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payroll_Income_summary_Report_summary->RowGroupLevel = 6;
	$Payroll_Income_summary_Report_summary->renderRow();
?>
<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->PayPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->Division->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->Division->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->DepartmentName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 5) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->SectionName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 6) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->EmployeeID->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payroll_Income_summary_Report_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SubGroupColumnCount + $Payroll_Income_summary_Report_summary->DetailColumnCount - 4 > 0) { ?>
		<td colspan="<?php echo ($Payroll_Income_summary_Report_summary->SubGroupColumnCount + $Payroll_Income_summary_Report_summary->DetailColumnCount - 4) ?>"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Payroll_Income_summary_Report_summary->EmployeeID->GroupViewValue, $Payroll_Income_summary_Report_summary->EmployeeID->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Payroll_Income_summary_Report_summary->EmployeeID->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->DepartmentName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->SectionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Payroll_Income_summary_Report_summary->GroupColumnCount - 5) ?>"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Income_summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Income_summary_Report_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 5
	} // End group level 4
	} // End group level 3
	} // End group level 2
?>
<?php if ($Payroll_Income_summary_Report_summary->TotalGroups > 0) { ?>
<?php
	$Payroll_Income_summary_Report_summary->Amount->getSum($Payroll_Income_summary_Report_summary->Division->Records); // Get Sum
	$Payroll_Income_summary_Report_summary->resetAttributes();
	$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
	$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payroll_Income_summary_Report_summary->RowGroupLevel = 2;
	$Payroll_Income_summary_Report_summary->renderRow();
?>
<?php if ($Payroll_Income_summary_Report_summary->Division->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->PayPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->Division->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->Division->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->DepartmentName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 5) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->SectionName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>
	<?php if ($Payroll_Income_summary_Report_summary->EmployeeID->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Income_summary_Report_summary->RowGroupLevel != 6) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->EmployeeID->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payroll_Income_summary_Report_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SubGroupColumnCount + $Payroll_Income_summary_Report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Payroll_Income_summary_Report_summary->SubGroupColumnCount + $Payroll_Income_summary_Report_summary->DetailColumnCount) ?>"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Payroll_Income_summary_Report_summary->Division->GroupViewValue, $Payroll_Income_summary_Report_summary->Division->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Payroll_Income_summary_Report_summary->Division->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes(); ?>>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Payroll_Income_summary_Report_summary->GroupColumnCount - 1) ?>"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Income_summary_Report_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Income_summary_Report_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Amount->SumViewValue ?></span>
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
	$Payroll_Income_summary_Report_summary->loadGroupRowValues();

	// Show header if page break
	if ($Payroll_Income_summary_Report_summary->isExport())
		$Payroll_Income_summary_Report_summary->ShowHeader = ($Payroll_Income_summary_Report_summary->ExportPageBreakCount == 0) ? FALSE : ($Payroll_Income_summary_Report_summary->GroupCount % $Payroll_Income_summary_Report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Payroll_Income_summary_Report_summary->ShowHeader)
		$Payroll_Income_summary_Report_summary->Page_Breaking($Payroll_Income_summary_Report_summary->ShowHeader, $Payroll_Income_summary_Report_summary->PageBreakContent);
	$Payroll_Income_summary_Report_summary->GroupCount++;
} // End while
?>
<?php if ($Payroll_Income_summary_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Payroll_Income_summary_Report_summary->resetAttributes();
	$Payroll_Income_summary_Report_summary->RowType = ROWTYPE_TOTAL;
	$Payroll_Income_summary_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$Payroll_Income_summary_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payroll_Income_summary_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Payroll_Income_summary_Report_summary->renderRow();
?>
<?php if ($Payroll_Income_summary_Report_summary->PayPeriod->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Payroll_Income_summary_Report_summary->GroupColumnCount + $Payroll_Income_summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Income_summary_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payroll_Income_summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Income_summary_Report_summary->Title->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Income_summary_Report_summary->Surname->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Income_summary_Report_summary->FirstName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Income_summary_Report_summary->MiddleName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Payroll_Income_summary_Report_summary->Sex->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Payroll_Income_summary_Report_summary->NRC->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Payroll_Income_summary_Report_summary->SalaryScale->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Income_summary_Report_summary->PositionName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Income_summary_Report_summary->pCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Income_summary_Report_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Income_summary_Report_summary->Amount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payroll_Income_summary_Report_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Payroll_Income_summary_Report_summary->GroupColumnCount + $Payroll_Income_summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Payroll_Income_summary_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Payroll_Income_summary_Report_summary->rowAttributes() ?>>
<?php if ($Payroll_Income_summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payroll_Income_summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Income_summary_Report_summary->Title->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Income_summary_Report_summary->Surname->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Income_summary_Report_summary->FirstName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Income_summary_Report_summary->MiddleName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Payroll_Income_summary_Report_summary->Sex->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Payroll_Income_summary_Report_summary->NRC->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Payroll_Income_summary_Report_summary->SalaryScale->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Income_summary_Report_summary->PositionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Income_summary_Report_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Income_summary_Report_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Income_summary_Report_summary->BankAccountNo->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Income_summary_Report_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Income_summary_Report_summary->pCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Income_summary_Report_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Income_summary_Report_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payroll_Income_summary_Report_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Income_summary_Report_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payroll_Income_summary_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport() && !($Payroll_Income_summary_Report_summary->DrillDown && $Payroll_Income_summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Income_summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Payroll_Income_summary_Report_summary->isExport() || $Payroll_Income_summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Payroll_Income_summary_Report_summary->isExport() || $Payroll_Income_summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Payroll_Income_summary_Report_summary->isExport() || $Payroll_Income_summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Payroll_Income_summary_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Payroll_Income_summary_Report_summary->isExport() && !$Payroll_Income_summary_Report_summary->DrillDown && !$DashboardReport) { ?>
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
$Payroll_Income_summary_Report_summary->terminate();
?>