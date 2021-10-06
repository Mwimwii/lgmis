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
$Training_Report_summary = new Training_Report_summary();

// Run the page
$Training_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Training_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Training_Report_summary->isExport() && !$Training_Report_summary->DrillDown && !$DashboardReport) { ?>
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
<?php if ((!$Training_Report_summary->isExport() || $Training_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Training_Report_summary->DrillDownInPanel) {
	$Training_Report_summary->ExportOptions->render("body");
	$Training_Report_summary->SearchOptions->render("body");
	$Training_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Training_Report_summary->showPageHeader(); ?>
<?php
$Training_Report_summary->showMessage();
?>
<?php if ((!$Training_Report_summary->isExport() || $Training_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Training_Report_summary->isExport() || $Training_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Training_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Training_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Training_Report_summary->isExport() && !$Training_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Training_Report_summary->RecordCount < count($Training_Report_summary->DetailRecords) && $Training_Report_summary->RecordCount < $Training_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Training_Report_summary->ShowHeader) {
?>
<?php if (!$Training_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Training_Report_summary->isExport("word") && !$Training_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Training_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Training_Report_summary->isExport() && !($Training_Report_summary->DrillDown && $Training_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Training_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Training_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Training_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Training_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Training_Report_summary->FormerFileNumber->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->FormerFileNumber) == "") { ?>
	<th data-name="FormerFileNumber" class="<?php echo $Training_Report_summary->FormerFileNumber->headerCellClass() ?>"><div class="Training_Report_FormerFileNumber"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->FormerFileNumber->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FormerFileNumber" class="<?php echo $Training_Report_summary->FormerFileNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->FormerFileNumber) ?>', 1);"><div class="Training_Report_FormerFileNumber">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->FormerFileNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->FormerFileNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->FormerFileNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->NRC->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->NRC) == "") { ?>
	<th data-name="NRC" class="<?php echo $Training_Report_summary->NRC->headerCellClass() ?>"><div class="Training_Report_NRC"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->NRC->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NRC" class="<?php echo $Training_Report_summary->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->NRC) ?>', 1);"><div class="Training_Report_NRC">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->Title->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->Title) == "") { ?>
	<th data-name="Title" class="<?php echo $Training_Report_summary->Title->headerCellClass() ?>"><div class="Training_Report_Title"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->Title->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Title" class="<?php echo $Training_Report_summary->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->Title) ?>', 1);"><div class="Training_Report_Title">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->Surname->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $Training_Report_summary->Surname->headerCellClass() ?>"><div class="Training_Report_Surname"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $Training_Report_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->Surname) ?>', 1);"><div class="Training_Report_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->FirstName->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $Training_Report_summary->FirstName->headerCellClass() ?>"><div class="Training_Report_FirstName"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $Training_Report_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->FirstName) ?>', 1);"><div class="Training_Report_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->MiddleName->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $Training_Report_summary->MiddleName->headerCellClass() ?>"><div class="Training_Report_MiddleName"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $Training_Report_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->MiddleName) ?>', 1);"><div class="Training_Report_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->Sex->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->Sex) == "") { ?>
	<th data-name="Sex" class="<?php echo $Training_Report_summary->Sex->headerCellClass() ?>"><div class="Training_Report_Sex"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->Sex->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Sex" class="<?php echo $Training_Report_summary->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->Sex) ?>', 1);"><div class="Training_Report_Sex">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->MaritalStatus->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->MaritalStatus) == "") { ?>
	<th data-name="MaritalStatus" class="<?php echo $Training_Report_summary->MaritalStatus->headerCellClass() ?>"><div class="Training_Report_MaritalStatus"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MaritalStatus" class="<?php echo $Training_Report_summary->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->MaritalStatus) ?>', 1);"><div class="Training_Report_MaritalStatus">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->MaritalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->DateOfBirth->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->DateOfBirth) == "") { ?>
	<th data-name="DateOfBirth" class="<?php echo $Training_Report_summary->DateOfBirth->headerCellClass() ?>"><div class="Training_Report_DateOfBirth"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DateOfBirth" class="<?php echo $Training_Report_summary->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->DateOfBirth) ?>', 1);"><div class="Training_Report_DateOfBirth">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->AcademicQualification->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->AcademicQualification) == "") { ?>
	<th data-name="AcademicQualification" class="<?php echo $Training_Report_summary->AcademicQualification->headerCellClass() ?>"><div class="Training_Report_AcademicQualification"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->AcademicQualification->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="AcademicQualification" class="<?php echo $Training_Report_summary->AcademicQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->AcademicQualification) ?>', 1);"><div class="Training_Report_AcademicQualification">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->AcademicQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->AcademicQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->AcademicQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->ProfessionalQualification->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->ProfessionalQualification) == "") { ?>
	<th data-name="ProfessionalQualification" class="<?php echo $Training_Report_summary->ProfessionalQualification->headerCellClass() ?>"><div class="Training_Report_ProfessionalQualification"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->ProfessionalQualification->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ProfessionalQualification" class="<?php echo $Training_Report_summary->ProfessionalQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->ProfessionalQualification) ?>', 1);"><div class="Training_Report_ProfessionalQualification">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->ProfessionalQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->ProfessionalQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->ProfessionalQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->MedicalCondition->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->MedicalCondition) == "") { ?>
	<th data-name="MedicalCondition" class="<?php echo $Training_Report_summary->MedicalCondition->headerCellClass() ?>"><div class="Training_Report_MedicalCondition"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->MedicalCondition->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MedicalCondition" class="<?php echo $Training_Report_summary->MedicalCondition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->MedicalCondition) ?>', 1);"><div class="Training_Report_MedicalCondition">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->MedicalCondition->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->MedicalCondition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->MedicalCondition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->OtherMedicalConditions->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->OtherMedicalConditions) == "") { ?>
	<th data-name="OtherMedicalConditions" class="<?php echo $Training_Report_summary->OtherMedicalConditions->headerCellClass() ?>"><div class="Training_Report_OtherMedicalConditions"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->OtherMedicalConditions->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="OtherMedicalConditions" class="<?php echo $Training_Report_summary->OtherMedicalConditions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->OtherMedicalConditions) ?>', 1);"><div class="Training_Report_OtherMedicalConditions">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->OtherMedicalConditions->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->OtherMedicalConditions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->OtherMedicalConditions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->PhysicalChallenge->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->PhysicalChallenge) == "") { ?>
	<th data-name="PhysicalChallenge" class="<?php echo $Training_Report_summary->PhysicalChallenge->headerCellClass() ?>"><div class="Training_Report_PhysicalChallenge"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->PhysicalChallenge->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PhysicalChallenge" class="<?php echo $Training_Report_summary->PhysicalChallenge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->PhysicalChallenge) ?>', 1);"><div class="Training_Report_PhysicalChallenge">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->PhysicalChallenge->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->PhysicalChallenge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->PhysicalChallenge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->ProvinceCode->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->ProvinceCode) == "") { ?>
	<th data-name="ProvinceCode" class="<?php echo $Training_Report_summary->ProvinceCode->headerCellClass() ?>"><div class="Training_Report_ProvinceCode"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ProvinceCode" class="<?php echo $Training_Report_summary->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->ProvinceCode) ?>', 1);"><div class="Training_Report_ProvinceCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->LACode->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->LACode) == "") { ?>
	<th data-name="LACode" class="<?php echo $Training_Report_summary->LACode->headerCellClass() ?>"><div class="Training_Report_LACode"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->LACode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="LACode" class="<?php echo $Training_Report_summary->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->LACode) ?>', 1);"><div class="Training_Report_LACode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->DepartmentCode->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->DepartmentCode) == "") { ?>
	<th data-name="DepartmentCode" class="<?php echo $Training_Report_summary->DepartmentCode->headerCellClass() ?>"><div class="Training_Report_DepartmentCode"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DepartmentCode" class="<?php echo $Training_Report_summary->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->DepartmentCode) ?>', 1);"><div class="Training_Report_DepartmentCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->SectionCode->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->SectionCode) == "") { ?>
	<th data-name="SectionCode" class="<?php echo $Training_Report_summary->SectionCode->headerCellClass() ?>"><div class="Training_Report_SectionCode"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="SectionCode" class="<?php echo $Training_Report_summary->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->SectionCode) ?>', 1);"><div class="Training_Report_SectionCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->SubstantivePosition->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->SubstantivePosition) == "") { ?>
	<th data-name="SubstantivePosition" class="<?php echo $Training_Report_summary->SubstantivePosition->headerCellClass() ?>"><div class="Training_Report_SubstantivePosition"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->SubstantivePosition->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="SubstantivePosition" class="<?php echo $Training_Report_summary->SubstantivePosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->SubstantivePosition) ?>', 1);"><div class="Training_Report_SubstantivePosition">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->SubstantivePosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->SubstantivePosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->SubstantivePosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->DateOfCurrentAppointment->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->DateOfCurrentAppointment) == "") { ?>
	<th data-name="DateOfCurrentAppointment" class="<?php echo $Training_Report_summary->DateOfCurrentAppointment->headerCellClass() ?>"><div class="Training_Report_DateOfCurrentAppointment"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->DateOfCurrentAppointment->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DateOfCurrentAppointment" class="<?php echo $Training_Report_summary->DateOfCurrentAppointment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->DateOfCurrentAppointment) ?>', 1);"><div class="Training_Report_DateOfCurrentAppointment">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->DateOfCurrentAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->DateOfCurrentAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->DateOfCurrentAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->YearsOfService->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->YearsOfService) == "") { ?>
	<th data-name="YearsOfService" class="<?php echo $Training_Report_summary->YearsOfService->headerCellClass() ?>"><div class="Training_Report_YearsOfService"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->YearsOfService->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="YearsOfService" class="<?php echo $Training_Report_summary->YearsOfService->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->YearsOfService) ?>', 1);"><div class="Training_Report_YearsOfService">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->YearsOfService->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->YearsOfService->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->YearsOfService->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->DateOfExit->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->DateOfExit) == "") { ?>
	<th data-name="DateOfExit" class="<?php echo $Training_Report_summary->DateOfExit->headerCellClass() ?>"><div class="Training_Report_DateOfExit"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->DateOfExit->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DateOfExit" class="<?php echo $Training_Report_summary->DateOfExit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->DateOfExit) ?>', 1);"><div class="Training_Report_DateOfExit">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->DateOfExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->DateOfExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->SalaryScale->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->SalaryScale) == "") { ?>
	<th data-name="SalaryScale" class="<?php echo $Training_Report_summary->SalaryScale->headerCellClass() ?>"><div class="Training_Report_SalaryScale"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="SalaryScale" class="<?php echo $Training_Report_summary->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->SalaryScale) ?>', 1);"><div class="Training_Report_SalaryScale">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->EmploymentType->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->EmploymentType) == "") { ?>
	<th data-name="EmploymentType" class="<?php echo $Training_Report_summary->EmploymentType->headerCellClass() ?>"><div class="Training_Report_EmploymentType"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->EmploymentType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmploymentType" class="<?php echo $Training_Report_summary->EmploymentType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->EmploymentType) ?>', 1);"><div class="Training_Report_EmploymentType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->EmploymentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->EmploymentType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->EmploymentType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->EmploymentStatus->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->EmploymentStatus) == "") { ?>
	<th data-name="EmploymentStatus" class="<?php echo $Training_Report_summary->EmploymentStatus->headerCellClass() ?>"><div class="Training_Report_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmploymentStatus" class="<?php echo $Training_Report_summary->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->EmploymentStatus) ?>', 1);"><div class="Training_Report_EmploymentStatus">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->CouncilType->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->CouncilType) == "") { ?>
	<th data-name="CouncilType" class="<?php echo $Training_Report_summary->CouncilType->headerCellClass() ?>"><div class="Training_Report_CouncilType"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="CouncilType" class="<?php echo $Training_Report_summary->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->CouncilType) ?>', 1);"><div class="Training_Report_CouncilType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->FundingSource->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->FundingSource) == "") { ?>
	<th data-name="FundingSource" class="<?php echo $Training_Report_summary->FundingSource->headerCellClass() ?>"><div class="Training_Report_FundingSource"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->FundingSource->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FundingSource" class="<?php echo $Training_Report_summary->FundingSource->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->FundingSource) ?>', 1);"><div class="Training_Report_FundingSource">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->FundingSource->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->FundingSource->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->FundingSource->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->TrainingCost->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->TrainingCost) == "") { ?>
	<th data-name="TrainingCost" class="<?php echo $Training_Report_summary->TrainingCost->headerCellClass() ?>"><div class="Training_Report_TrainingCost"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->TrainingCost->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="TrainingCost" class="<?php echo $Training_Report_summary->TrainingCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->TrainingCost) ?>', 1);"><div class="Training_Report_TrainingCost">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->TrainingCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->TrainingCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->TrainingCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->ActualStartDate->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->ActualStartDate) == "") { ?>
	<th data-name="ActualStartDate" class="<?php echo $Training_Report_summary->ActualStartDate->headerCellClass() ?>"><div class="Training_Report_ActualStartDate"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->ActualStartDate->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ActualStartDate" class="<?php echo $Training_Report_summary->ActualStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->ActualStartDate) ?>', 1);"><div class="Training_Report_ActualStartDate">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->ActualStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->ActualStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->TrainingType->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->TrainingType) == "") { ?>
	<th data-name="TrainingType" class="<?php echo $Training_Report_summary->TrainingType->headerCellClass() ?>"><div class="Training_Report_TrainingType"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->TrainingType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="TrainingType" class="<?php echo $Training_Report_summary->TrainingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->TrainingType) ?>', 1);"><div class="Training_Report_TrainingType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->TrainingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->TrainingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->TrainingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Training_Report_summary->FieldOfTraining->Visible) { ?>
	<?php if ($Training_Report_summary->sortUrl($Training_Report_summary->FieldOfTraining) == "") { ?>
	<th data-name="FieldOfTraining" class="<?php echo $Training_Report_summary->FieldOfTraining->headerCellClass() ?>"><div class="Training_Report_FieldOfTraining"><div class="ew-table-header-caption"><?php echo $Training_Report_summary->FieldOfTraining->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FieldOfTraining" class="<?php echo $Training_Report_summary->FieldOfTraining->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Training_Report_summary->sortUrl($Training_Report_summary->FieldOfTraining) ?>', 1);"><div class="Training_Report_FieldOfTraining">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Training_Report_summary->FieldOfTraining->caption() ?></span><span class="ew-table-header-sort"><?php if ($Training_Report_summary->FieldOfTraining->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Training_Report_summary->FieldOfTraining->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Training_Report_summary->TotalGroups == 0)
			break; // Show header only
		$Training_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php
	$Training_Report_summary->loadRowValues($Training_Report_summary->DetailRecords[$Training_Report_summary->RecordCount]);
	$Training_Report_summary->RecordCount++;
	$Training_Report_summary->RecordIndex++;
?>
<?php

		// Render detail row
		$Training_Report_summary->resetAttributes();
		$Training_Report_summary->RowType = ROWTYPE_DETAIL;
		$Training_Report_summary->renderRow();
?>
	<tr<?php echo $Training_Report_summary->rowAttributes(); ?>>
<?php if ($Training_Report_summary->FormerFileNumber->Visible) { ?>
		<td data-field="FormerFileNumber"<?php echo $Training_Report_summary->FormerFileNumber->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->FormerFileNumber->viewAttributes() ?>><?php echo $Training_Report_summary->FormerFileNumber->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->NRC->Visible) { ?>
		<td data-field="NRC"<?php echo $Training_Report_summary->NRC->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->NRC->viewAttributes() ?>><?php echo $Training_Report_summary->NRC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Training_Report_summary->Title->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->Title->viewAttributes() ?>><?php echo $Training_Report_summary->Title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Training_Report_summary->Surname->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->Surname->viewAttributes() ?>><?php echo $Training_Report_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Training_Report_summary->FirstName->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->FirstName->viewAttributes() ?>><?php echo $Training_Report_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Training_Report_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->MiddleName->viewAttributes() ?>><?php echo $Training_Report_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->Sex->Visible) { ?>
		<td data-field="Sex"<?php echo $Training_Report_summary->Sex->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->Sex->viewAttributes() ?>><?php echo $Training_Report_summary->Sex->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->MaritalStatus->Visible) { ?>
		<td data-field="MaritalStatus"<?php echo $Training_Report_summary->MaritalStatus->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->MaritalStatus->viewAttributes() ?>><?php echo $Training_Report_summary->MaritalStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->DateOfBirth->Visible) { ?>
		<td data-field="DateOfBirth"<?php echo $Training_Report_summary->DateOfBirth->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->DateOfBirth->viewAttributes() ?>><?php echo $Training_Report_summary->DateOfBirth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->AcademicQualification->Visible) { ?>
		<td data-field="AcademicQualification"<?php echo $Training_Report_summary->AcademicQualification->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->AcademicQualification->viewAttributes() ?>><?php echo $Training_Report_summary->AcademicQualification->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->ProfessionalQualification->Visible) { ?>
		<td data-field="ProfessionalQualification"<?php echo $Training_Report_summary->ProfessionalQualification->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->ProfessionalQualification->viewAttributes() ?>><?php echo $Training_Report_summary->ProfessionalQualification->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->MedicalCondition->Visible) { ?>
		<td data-field="MedicalCondition"<?php echo $Training_Report_summary->MedicalCondition->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->MedicalCondition->viewAttributes() ?>><?php echo $Training_Report_summary->MedicalCondition->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->OtherMedicalConditions->Visible) { ?>
		<td data-field="OtherMedicalConditions"<?php echo $Training_Report_summary->OtherMedicalConditions->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->OtherMedicalConditions->viewAttributes() ?>><?php echo $Training_Report_summary->OtherMedicalConditions->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->PhysicalChallenge->Visible) { ?>
		<td data-field="PhysicalChallenge"<?php echo $Training_Report_summary->PhysicalChallenge->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->PhysicalChallenge->viewAttributes() ?>><?php echo $Training_Report_summary->PhysicalChallenge->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Training_Report_summary->ProvinceCode->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->ProvinceCode->viewAttributes() ?>><?php echo $Training_Report_summary->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Training_Report_summary->LACode->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->LACode->viewAttributes() ?>><?php echo $Training_Report_summary->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Training_Report_summary->DepartmentCode->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->DepartmentCode->viewAttributes() ?>><?php echo $Training_Report_summary->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Training_Report_summary->SectionCode->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->SectionCode->viewAttributes() ?>><?php echo $Training_Report_summary->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->SubstantivePosition->Visible) { ?>
		<td data-field="SubstantivePosition"<?php echo $Training_Report_summary->SubstantivePosition->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->SubstantivePosition->viewAttributes() ?>><?php echo $Training_Report_summary->SubstantivePosition->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->DateOfCurrentAppointment->Visible) { ?>
		<td data-field="DateOfCurrentAppointment"<?php echo $Training_Report_summary->DateOfCurrentAppointment->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $Training_Report_summary->DateOfCurrentAppointment->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->YearsOfService->Visible) { ?>
		<td data-field="YearsOfService"<?php echo $Training_Report_summary->YearsOfService->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->YearsOfService->viewAttributes() ?>><?php echo $Training_Report_summary->YearsOfService->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->DateOfExit->Visible) { ?>
		<td data-field="DateOfExit"<?php echo $Training_Report_summary->DateOfExit->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->DateOfExit->viewAttributes() ?>><?php echo $Training_Report_summary->DateOfExit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Training_Report_summary->SalaryScale->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->SalaryScale->viewAttributes() ?>><?php echo $Training_Report_summary->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->EmploymentType->Visible) { ?>
		<td data-field="EmploymentType"<?php echo $Training_Report_summary->EmploymentType->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->EmploymentType->viewAttributes() ?>><?php echo $Training_Report_summary->EmploymentType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->EmploymentStatus->Visible) { ?>
		<td data-field="EmploymentStatus"<?php echo $Training_Report_summary->EmploymentStatus->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->EmploymentStatus->viewAttributes() ?>><?php echo $Training_Report_summary->EmploymentStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->CouncilType->Visible) { ?>
		<td data-field="CouncilType"<?php echo $Training_Report_summary->CouncilType->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->CouncilType->viewAttributes() ?>><?php echo $Training_Report_summary->CouncilType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->FundingSource->Visible) { ?>
		<td data-field="FundingSource"<?php echo $Training_Report_summary->FundingSource->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->FundingSource->viewAttributes() ?>><?php echo $Training_Report_summary->FundingSource->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->TrainingCost->Visible) { ?>
		<td data-field="TrainingCost"<?php echo $Training_Report_summary->TrainingCost->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->TrainingCost->viewAttributes() ?>><?php echo $Training_Report_summary->TrainingCost->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->ActualStartDate->Visible) { ?>
		<td data-field="ActualStartDate"<?php echo $Training_Report_summary->ActualStartDate->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->ActualStartDate->viewAttributes() ?>><?php echo $Training_Report_summary->ActualStartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->TrainingType->Visible) { ?>
		<td data-field="TrainingType"<?php echo $Training_Report_summary->TrainingType->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->TrainingType->viewAttributes() ?>><?php echo $Training_Report_summary->TrainingType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Training_Report_summary->FieldOfTraining->Visible) { ?>
		<td data-field="FieldOfTraining"<?php echo $Training_Report_summary->FieldOfTraining->cellAttributes() ?>>
<span<?php echo $Training_Report_summary->FieldOfTraining->viewAttributes() ?>><?php echo $Training_Report_summary->FieldOfTraining->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
} // End while
?>
<?php if ($Training_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Training_Report_summary->resetAttributes();
	$Training_Report_summary->RowType = ROWTYPE_TOTAL;
	$Training_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$Training_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Training_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Training_Report_summary->renderRow();
?>
<?php if ($Training_Report_summary->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Training_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Training_Report_summary->GroupColumnCount + $Training_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Training_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Training_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Training_Report_summary->GroupColumnCount + $Training_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Training_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Training_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Training_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Training_Report_summary->isExport() && !($Training_Report_summary->DrillDown && $Training_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Training_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Training_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Training_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Training_Report_summary->isExport() || $Training_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Training_Report_summary->isExport() || $Training_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Training_Report_summary->isExport() || $Training_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Training_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Training_Report_summary->isExport() && !$Training_Report_summary->DrillDown && !$DashboardReport) { ?>
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
$Training_Report_summary->terminate();
?>