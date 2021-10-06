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
$NAPSA_Summary_Report_summary = new NAPSA_Summary_Report_summary();

// Run the page
$NAPSA_Summary_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$NAPSA_Summary_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport() && !$NAPSA_Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$NAPSA_Summary_Report_summary->isExport() || $NAPSA_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$NAPSA_Summary_Report_summary->DrillDownInPanel) {
	$NAPSA_Summary_Report_summary->ExportOptions->render("body");
	$NAPSA_Summary_Report_summary->SearchOptions->render("body");
	$NAPSA_Summary_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $NAPSA_Summary_Report_summary->showPageHeader(); ?>
<?php
$NAPSA_Summary_Report_summary->showMessage();
?>
<?php if ((!$NAPSA_Summary_Report_summary->isExport() || $NAPSA_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$NAPSA_Summary_Report_summary->isExport() || $NAPSA_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $NAPSA_Summary_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport() && !$NAPSA_Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($NAPSA_Summary_Report_summary->GroupCount <= count($NAPSA_Summary_Report_summary->GroupRecords) && $NAPSA_Summary_Report_summary->GroupCount <= $NAPSA_Summary_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($NAPSA_Summary_Report_summary->ShowHeader) {
?>
<?php if ($NAPSA_Summary_Report_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->TotalGroups > 0) { ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport() && !($NAPSA_Summary_Report_summary->DrillDown && $NAPSA_Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $NAPSA_Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $NAPSA_Summary_Report_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$NAPSA_Summary_Report_summary->isExport("word") && !$NAPSA_Summary_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $NAPSA_Summary_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport() && !($NAPSA_Summary_Report_summary->DrillDown && $NAPSA_Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $NAPSA_Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_NAPSA_Summary_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $NAPSA_Summary_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="NAPSA_Summary_Report_LocalAuthority"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->LocalAuthority) ?>', 1);"><div class="NAPSA_Summary_Report_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DepartmentName->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
	<th data-name="DepartmentName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->DepartmentName) == "") { ?>
	<th data-name="DepartmentName" class="<?php echo $NAPSA_Summary_Report_summary->DepartmentName->headerCellClass() ?>"><div class="NAPSA_Summary_Report_DepartmentName"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->DepartmentName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="DepartmentName" class="<?php echo $NAPSA_Summary_Report_summary->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->DepartmentName) ?>', 1);"><div class="NAPSA_Summary_Report_DepartmentName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SectionName->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
	<th data-name="SectionName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->SectionName) == "") { ?>
	<th data-name="SectionName" class="<?php echo $NAPSA_Summary_Report_summary->SectionName->headerCellClass() ?>"><div class="NAPSA_Summary_Report_SectionName"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->SectionName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="SectionName" class="<?php echo $NAPSA_Summary_Report_summary->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->SectionName) ?>', 1);"><div class="NAPSA_Summary_Report_SectionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PayrollPeriod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->PayrollPeriod) == "") { ?>
	<th data-name="PayrollPeriod" class="<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->headerCellClass() ?>"><div class="NAPSA_Summary_Report_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PayrollPeriod" class="<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->PayrollPeriod) ?>', 1);"><div class="NAPSA_Summary_Report_PayrollPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeID->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->EmployeeID) == "") { ?>
	<th data-name="EmployeeID" class="<?php echo $NAPSA_Summary_Report_summary->EmployeeID->headerCellClass() ?>"><div class="NAPSA_Summary_Report_EmployeeID"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmployeeID" class="<?php echo $NAPSA_Summary_Report_summary->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->EmployeeID) ?>', 1);"><div class="NAPSA_Summary_Report_EmployeeID">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Surname->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $NAPSA_Summary_Report_summary->Surname->headerCellClass() ?>"><div class="NAPSA_Summary_Report_Surname"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $NAPSA_Summary_Report_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->Surname) ?>', 1);"><div class="NAPSA_Summary_Report_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->FirstName->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $NAPSA_Summary_Report_summary->FirstName->headerCellClass() ?>"><div class="NAPSA_Summary_Report_FirstName"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $NAPSA_Summary_Report_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->FirstName) ?>', 1);"><div class="NAPSA_Summary_Report_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MiddleName->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $NAPSA_Summary_Report_summary->MiddleName->headerCellClass() ?>"><div class="NAPSA_Summary_Report_MiddleName"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $NAPSA_Summary_Report_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->MiddleName) ?>', 1);"><div class="NAPSA_Summary_Report_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DateOfBirth->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->DateOfBirth) == "") { ?>
	<th data-name="DateOfBirth" class="<?php echo $NAPSA_Summary_Report_summary->DateOfBirth->headerCellClass() ?>"><div class="NAPSA_Summary_Report_DateOfBirth"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DateOfBirth" class="<?php echo $NAPSA_Summary_Report_summary->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->DateOfBirth) ?>', 1);"><div class="NAPSA_Summary_Report_DateOfBirth">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->NRC->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->NRC) == "") { ?>
	<th data-name="NRC" class="<?php echo $NAPSA_Summary_Report_summary->NRC->headerCellClass() ?>"><div class="NAPSA_Summary_Report_NRC"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->NRC->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NRC" class="<?php echo $NAPSA_Summary_Report_summary->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->NRC) ?>', 1);"><div class="NAPSA_Summary_Report_NRC">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SocialSecurityNo->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->SocialSecurityNo) == "") { ?>
	<th data-name="SocialSecurityNo" class="<?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->headerCellClass() ?>"><div class="NAPSA_Summary_Report_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="SocialSecurityNo" class="<?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->SocialSecurityNo) ?>', 1);"><div class="NAPSA_Summary_Report_SocialSecurityNo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MonthShort->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->MonthShort) == "") { ?>
	<th data-name="MonthShort" class="<?php echo $NAPSA_Summary_Report_summary->MonthShort->headerCellClass() ?>"><div class="NAPSA_Summary_Report_MonthShort"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->MonthShort->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MonthShort" class="<?php echo $NAPSA_Summary_Report_summary->MonthShort->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->MonthShort) ?>', 1);"><div class="NAPSA_Summary_Report_MonthShort">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->MonthShort->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->MonthShort->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->MonthShort->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Year->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->Year) == "") { ?>
	<th data-name="Year" class="<?php echo $NAPSA_Summary_Report_summary->Year->headerCellClass() ?>"><div class="NAPSA_Summary_Report_Year"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->Year->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Year" class="<?php echo $NAPSA_Summary_Report_summary->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->Year) ?>', 1);"><div class="NAPSA_Summary_Report_Year">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->GrossIncome->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->GrossIncome) == "") { ?>
	<th data-name="GrossIncome" class="<?php echo $NAPSA_Summary_Report_summary->GrossIncome->headerCellClass() ?>"><div class="NAPSA_Summary_Report_GrossIncome"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->GrossIncome->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="GrossIncome" class="<?php echo $NAPSA_Summary_Report_summary->GrossIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->GrossIncome) ?>', 1);"><div class="NAPSA_Summary_Report_GrossIncome">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->GrossIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->GrossIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->GrossIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeContribution->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->EmployeeContribution) == "") { ?>
	<th data-name="EmployeeContribution" class="<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->headerCellClass() ?>"><div class="NAPSA_Summary_Report_EmployeeContribution"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmployeeContribution" class="<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->EmployeeContribution) ?>', 1);"><div class="NAPSA_Summary_Report_EmployeeContribution">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->EmployeeContribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->EmployeeContribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployerContribution->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->EmployerContribution) == "") { ?>
	<th data-name="EmployerContribution" class="<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->headerCellClass() ?>"><div class="NAPSA_Summary_Report_EmployerContribution"><div class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->EmployerContribution->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmployerContribution" class="<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->EmployerContribution) ?>', 1);"><div class="NAPSA_Summary_Report_EmployerContribution">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->EmployerContribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->EmployerContribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->EmployerContribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($NAPSA_Summary_Report_summary->TotalGroups == 0)
			break; // Show header only
		$NAPSA_Summary_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($NAPSA_Summary_Report_summary->LocalAuthority, $NAPSA_Summary_Report_summary->getSqlFirstGroupField(), $NAPSA_Summary_Report_summary->LocalAuthority->groupValue(), $NAPSA_Summary_Report_summary->Dbid);
	if ($NAPSA_Summary_Report_summary->PageFirstGroupFilter != "") $NAPSA_Summary_Report_summary->PageFirstGroupFilter .= " OR ";
	$NAPSA_Summary_Report_summary->PageFirstGroupFilter .= $where;
	if ($NAPSA_Summary_Report_summary->Filter != "")
		$where = "($NAPSA_Summary_Report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($NAPSA_Summary_Report_summary->getSqlSelect(), $NAPSA_Summary_Report_summary->getSqlWhere(), $NAPSA_Summary_Report_summary->getSqlGroupBy(), $NAPSA_Summary_Report_summary->getSqlHaving(), $NAPSA_Summary_Report_summary->getSqlOrderBy(), $where, $NAPSA_Summary_Report_summary->Sort);
	$rs = $NAPSA_Summary_Report_summary->getRecordset($sql);
	$NAPSA_Summary_Report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$NAPSA_Summary_Report_summary->DetailRecordCount = count($NAPSA_Summary_Report_summary->DetailRecords);

	// Load detail records
	$NAPSA_Summary_Report_summary->LocalAuthority->Records = &$NAPSA_Summary_Report_summary->DetailRecords;
	$NAPSA_Summary_Report_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$NAPSA_Summary_Report_summary->GroupCounter[1] = $NAPSA_Summary_Report_summary->GroupCount;
		$NAPSA_Summary_Report_summary->LocalAuthority->getCnt($NAPSA_Summary_Report_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->Visible && $NAPSA_Summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$NAPSA_Summary_Report_summary->resetAttributes();
		$NAPSA_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$NAPSA_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$NAPSA_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$NAPSA_Summary_Report_summary->RowGroupLevel = 1;
		$NAPSA_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption NAPSA_Summary_Report_LocalAuthority"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption NAPSA_Summary_Report_LocalAuthority" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($NAPSA_Summary_Report_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$NAPSA_Summary_Report_summary->DepartmentName->getDistinctValues($NAPSA_Summary_Report_summary->LocalAuthority->Records);
	$NAPSA_Summary_Report_summary->setGroupCount(count($NAPSA_Summary_Report_summary->DepartmentName->DistinctValues), $NAPSA_Summary_Report_summary->GroupCounter[1]);
	$NAPSA_Summary_Report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($NAPSA_Summary_Report_summary->DepartmentName->DistinctValues as $DepartmentName) { // Load records for this distinct value
		$NAPSA_Summary_Report_summary->DepartmentName->setGroupValue($DepartmentName); // Set group value
		$NAPSA_Summary_Report_summary->DepartmentName->getDistinctRecords($NAPSA_Summary_Report_summary->LocalAuthority->Records, $NAPSA_Summary_Report_summary->DepartmentName->groupValue());
		$NAPSA_Summary_Report_summary->DepartmentName->LevelBreak = TRUE; // Set field level break
		$NAPSA_Summary_Report_summary->GroupCounter[2]++;
		$NAPSA_Summary_Report_summary->DepartmentName->getCnt($NAPSA_Summary_Report_summary->DepartmentName->Records); // Get record count
?>
<?php if ($NAPSA_Summary_Report_summary->DepartmentName->Visible && $NAPSA_Summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$NAPSA_Summary_Report_summary->DepartmentName->setDbValue($DepartmentName); // Set current value for DepartmentName
		$NAPSA_Summary_Report_summary->resetAttributes();
		$NAPSA_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$NAPSA_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$NAPSA_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$NAPSA_Summary_Report_summary->RowGroupLevel = 2;
		$NAPSA_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $NAPSA_Summary_Report_summary->DepartmentName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="DepartmentName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $NAPSA_Summary_Report_summary->DepartmentName->cellAttributes() ?>>
<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->DepartmentName) == "") { ?>
		<span class="ew-summary-caption NAPSA_Summary_Report_DepartmentName"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->DepartmentName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption NAPSA_Summary_Report_DepartmentName" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->DepartmentName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->DepartmentName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $NAPSA_Summary_Report_summary->DepartmentName->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->DepartmentName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($NAPSA_Summary_Report_summary->DepartmentName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$NAPSA_Summary_Report_summary->SectionName->getDistinctValues($NAPSA_Summary_Report_summary->DepartmentName->Records);
	$NAPSA_Summary_Report_summary->setGroupCount(count($NAPSA_Summary_Report_summary->SectionName->DistinctValues), $NAPSA_Summary_Report_summary->GroupCounter[1], $NAPSA_Summary_Report_summary->GroupCounter[2]);
	$NAPSA_Summary_Report_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($NAPSA_Summary_Report_summary->SectionName->DistinctValues as $SectionName) { // Load records for this distinct value
		$NAPSA_Summary_Report_summary->SectionName->setGroupValue($SectionName); // Set group value
		$NAPSA_Summary_Report_summary->SectionName->getDistinctRecords($NAPSA_Summary_Report_summary->DepartmentName->Records, $NAPSA_Summary_Report_summary->SectionName->groupValue());
		$NAPSA_Summary_Report_summary->SectionName->LevelBreak = TRUE; // Set field level break
		$NAPSA_Summary_Report_summary->GroupCounter[3]++;
		$NAPSA_Summary_Report_summary->SectionName->getCnt($NAPSA_Summary_Report_summary->SectionName->Records); // Get record count
?>
<?php if ($NAPSA_Summary_Report_summary->SectionName->Visible && $NAPSA_Summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$NAPSA_Summary_Report_summary->SectionName->setDbValue($SectionName); // Set current value for SectionName
		$NAPSA_Summary_Report_summary->resetAttributes();
		$NAPSA_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$NAPSA_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$NAPSA_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$NAPSA_Summary_Report_summary->RowGroupLevel = 3;
		$NAPSA_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $NAPSA_Summary_Report_summary->DepartmentName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $NAPSA_Summary_Report_summary->SectionName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="SectionName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $NAPSA_Summary_Report_summary->SectionName->cellAttributes() ?>>
<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->SectionName) == "") { ?>
		<span class="ew-summary-caption NAPSA_Summary_Report_SectionName"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->SectionName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption NAPSA_Summary_Report_SectionName" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->SectionName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->SectionName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $NAPSA_Summary_Report_summary->SectionName->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->SectionName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($NAPSA_Summary_Report_summary->SectionName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$NAPSA_Summary_Report_summary->PayrollPeriod->getDistinctValues($NAPSA_Summary_Report_summary->SectionName->Records);
	$NAPSA_Summary_Report_summary->setGroupCount(count($NAPSA_Summary_Report_summary->PayrollPeriod->DistinctValues), $NAPSA_Summary_Report_summary->GroupCounter[1], $NAPSA_Summary_Report_summary->GroupCounter[2], $NAPSA_Summary_Report_summary->GroupCounter[3]);
	$NAPSA_Summary_Report_summary->GroupCounter[4] = 0; // Init group count index
	foreach ($NAPSA_Summary_Report_summary->PayrollPeriod->DistinctValues as $PayrollPeriod) { // Load records for this distinct value
		$NAPSA_Summary_Report_summary->PayrollPeriod->setGroupValue($PayrollPeriod); // Set group value
		$NAPSA_Summary_Report_summary->PayrollPeriod->getDistinctRecords($NAPSA_Summary_Report_summary->SectionName->Records, $NAPSA_Summary_Report_summary->PayrollPeriod->groupValue());
		$NAPSA_Summary_Report_summary->PayrollPeriod->LevelBreak = TRUE; // Set field level break
		$NAPSA_Summary_Report_summary->GroupCounter[4]++;
		$NAPSA_Summary_Report_summary->PayrollPeriod->getCnt($NAPSA_Summary_Report_summary->PayrollPeriod->Records); // Get record count
		$NAPSA_Summary_Report_summary->setGroupCount($NAPSA_Summary_Report_summary->PayrollPeriod->Count, $NAPSA_Summary_Report_summary->GroupCounter[1], $NAPSA_Summary_Report_summary->GroupCounter[2], $NAPSA_Summary_Report_summary->GroupCounter[3], $NAPSA_Summary_Report_summary->GroupCounter[4]);
?>
<?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->Visible && $NAPSA_Summary_Report_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$NAPSA_Summary_Report_summary->PayrollPeriod->setDbValue($PayrollPeriod); // Set current value for PayrollPeriod
		$NAPSA_Summary_Report_summary->resetAttributes();
		$NAPSA_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
		$NAPSA_Summary_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$NAPSA_Summary_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$NAPSA_Summary_Report_summary->RowGroupLevel = 4;
		$NAPSA_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $NAPSA_Summary_Report_summary->DepartmentName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $NAPSA_Summary_Report_summary->SectionName->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PayrollPeriod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 4) ?>"<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->cellAttributes() ?>>
<?php if ($NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->PayrollPeriod) == "") { ?>
		<span class="ew-summary-caption NAPSA_Summary_Report_PayrollPeriod"><span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption NAPSA_Summary_Report_PayrollPeriod" onclick="ew.sort(event, '<?php echo $NAPSA_Summary_Report_summary->sortUrl($NAPSA_Summary_Report_summary->PayrollPeriod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($NAPSA_Summary_Report_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($NAPSA_Summary_Report_summary->PayrollPeriod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$NAPSA_Summary_Report_summary->RecordCount = 0; // Reset record count
	foreach ($NAPSA_Summary_Report_summary->PayrollPeriod->Records as $record) {
		$NAPSA_Summary_Report_summary->RecordCount++;
		$NAPSA_Summary_Report_summary->RecordIndex++;
		$NAPSA_Summary_Report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$NAPSA_Summary_Report_summary->resetAttributes();
		$NAPSA_Summary_Report_summary->RowType = ROWTYPE_DETAIL;
		$NAPSA_Summary_Report_summary->renderRow();
?>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes(); ?>>
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $NAPSA_Summary_Report_summary->LocalAuthority->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DepartmentName->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->DepartmentName->ShowGroupHeaderAsRow) { ?>
		<td data-field="DepartmentName"<?php echo $NAPSA_Summary_Report_summary->DepartmentName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="DepartmentName"<?php echo $NAPSA_Summary_Report_summary->DepartmentName->cellAttributes(); ?>><span<?php echo $NAPSA_Summary_Report_summary->DepartmentName->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->DepartmentName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SectionName->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->SectionName->ShowGroupHeaderAsRow) { ?>
		<td data-field="SectionName"<?php echo $NAPSA_Summary_Report_summary->SectionName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="SectionName"<?php echo $NAPSA_Summary_Report_summary->SectionName->cellAttributes(); ?>><span<?php echo $NAPSA_Summary_Report_summary->SectionName->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->SectionName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->Visible) { ?>
	<?php if ($NAPSA_Summary_Report_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		<td data-field="PayrollPeriod"<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="PayrollPeriod"<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->cellAttributes(); ?>><span<?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->PayrollPeriod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $NAPSA_Summary_Report_summary->EmployeeID->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->EmployeeID->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $NAPSA_Summary_Report_summary->Surname->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->Surname->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $NAPSA_Summary_Report_summary->FirstName->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->FirstName->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $NAPSA_Summary_Report_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->MiddleName->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DateOfBirth->Visible) { ?>
		<td data-field="DateOfBirth"<?php echo $NAPSA_Summary_Report_summary->DateOfBirth->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->DateOfBirth->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->DateOfBirth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $NAPSA_Summary_Report_summary->NRC->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->NRC->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->NRC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SocialSecurityNo->Visible) { ?>
		<td data-field="SocialSecurityNo"<?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MonthShort->Visible) { ?>
		<td data-field="MonthShort"<?php echo $NAPSA_Summary_Report_summary->MonthShort->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->MonthShort->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->MonthShort->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Year->Visible) { ?>
		<td data-field="Year"<?php echo $NAPSA_Summary_Report_summary->Year->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->Year->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->Year->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->GrossIncome->Visible) { ?>
		<td data-field="GrossIncome"<?php echo $NAPSA_Summary_Report_summary->GrossIncome->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->GrossIncome->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->GrossIncome->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeContribution->Visible) { ?>
		<td data-field="EmployeeContribution"<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployerContribution->Visible) { ?>
		<td data-field="EmployerContribution"<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->EmployerContribution->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
	} // End group level 3
	} // End group level 2
	} // End group level 1
?>
<?php

	// Next group
	$NAPSA_Summary_Report_summary->loadGroupRowValues();

	// Show header if page break
	if ($NAPSA_Summary_Report_summary->isExport())
		$NAPSA_Summary_Report_summary->ShowHeader = ($NAPSA_Summary_Report_summary->ExportPageBreakCount == 0) ? FALSE : ($NAPSA_Summary_Report_summary->GroupCount % $NAPSA_Summary_Report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($NAPSA_Summary_Report_summary->ShowHeader)
		$NAPSA_Summary_Report_summary->Page_Breaking($NAPSA_Summary_Report_summary->ShowHeader, $NAPSA_Summary_Report_summary->PageBreakContent);
	$NAPSA_Summary_Report_summary->GroupCount++;
} // End while
?>
<?php if ($NAPSA_Summary_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$NAPSA_Summary_Report_summary->resetAttributes();
	$NAPSA_Summary_Report_summary->RowType = ROWTYPE_TOTAL;
	$NAPSA_Summary_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$NAPSA_Summary_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$NAPSA_Summary_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$NAPSA_Summary_Report_summary->renderRow();
?>
<?php if ($NAPSA_Summary_Report_summary->LocalAuthority->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($NAPSA_Summary_Report_summary->GroupColumnCount + $NAPSA_Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($NAPSA_Summary_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes() ?>>
<?php if ($NAPSA_Summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $NAPSA_Summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $NAPSA_Summary_Report_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $NAPSA_Summary_Report_summary->Surname->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $NAPSA_Summary_Report_summary->FirstName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $NAPSA_Summary_Report_summary->MiddleName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DateOfBirth->Visible) { ?>
		<td data-field="DateOfBirth"<?php echo $NAPSA_Summary_Report_summary->DateOfBirth->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $NAPSA_Summary_Report_summary->NRC->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SocialSecurityNo->Visible) { ?>
		<td data-field="SocialSecurityNo"<?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MonthShort->Visible) { ?>
		<td data-field="MonthShort"<?php echo $NAPSA_Summary_Report_summary->MonthShort->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Year->Visible) { ?>
		<td data-field="Year"<?php echo $NAPSA_Summary_Report_summary->Year->cellAttributes() ?>></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->GrossIncome->Visible) { ?>
		<td data-field="GrossIncome"<?php echo $NAPSA_Summary_Report_summary->GrossIncome->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $NAPSA_Summary_Report_summary->GrossIncome->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->GrossIncome->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeContribution->Visible) { ?>
		<td data-field="EmployeeContribution"<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployerContribution->Visible) { ?>
		<td data-field="EmployerContribution"<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->EmployerContribution->SumViewValue ?></span></span></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($NAPSA_Summary_Report_summary->GroupColumnCount + $NAPSA_Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($NAPSA_Summary_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $NAPSA_Summary_Report_summary->rowAttributes() ?>>
<?php if ($NAPSA_Summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $NAPSA_Summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $NAPSA_Summary_Report_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $NAPSA_Summary_Report_summary->Surname->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $NAPSA_Summary_Report_summary->FirstName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $NAPSA_Summary_Report_summary->MiddleName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->DateOfBirth->Visible) { ?>
		<td data-field="DateOfBirth"<?php echo $NAPSA_Summary_Report_summary->DateOfBirth->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $NAPSA_Summary_Report_summary->NRC->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->SocialSecurityNo->Visible) { ?>
		<td data-field="SocialSecurityNo"<?php echo $NAPSA_Summary_Report_summary->SocialSecurityNo->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->MonthShort->Visible) { ?>
		<td data-field="MonthShort"<?php echo $NAPSA_Summary_Report_summary->MonthShort->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->Year->Visible) { ?>
		<td data-field="Year"<?php echo $NAPSA_Summary_Report_summary->Year->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->GrossIncome->Visible) { ?>
		<td data-field="GrossIncome"<?php echo $NAPSA_Summary_Report_summary->GrossIncome->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->GrossIncome->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->GrossIncome->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployeeContribution->Visible) { ?>
		<td data-field="EmployeeContribution"<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->EmployeeContribution->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->EmployerContribution->Visible) { ?>
		<td data-field="EmployerContribution"<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->cellAttributes() ?>>
<span<?php echo $NAPSA_Summary_Report_summary->EmployerContribution->viewAttributes() ?>><?php echo $NAPSA_Summary_Report_summary->EmployerContribution->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($NAPSA_Summary_Report_summary->TotalGroups > 0) { ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport() && !($NAPSA_Summary_Report_summary->DrillDown && $NAPSA_Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $NAPSA_Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$NAPSA_Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$NAPSA_Summary_Report_summary->isExport() || $NAPSA_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$NAPSA_Summary_Report_summary->isExport() || $NAPSA_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$NAPSA_Summary_Report_summary->isExport() || $NAPSA_Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$NAPSA_Summary_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$NAPSA_Summary_Report_summary->isExport() && !$NAPSA_Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
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
$NAPSA_Summary_Report_summary->terminate();
?>