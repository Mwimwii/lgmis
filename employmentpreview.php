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
WriteHeader(FALSE, "utf-8");

// Create page object
$employment_preview = new employment_preview();

// Run the page
$employment_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_preview->Page_Render();
?>
<?php $employment_preview->showPageHeader(); ?>
<?php if ($employment_preview->TotalRecords > 0) { ?>
<div class="card ew-grid employment"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$employment_preview->renderListOptions();

// Render list options (header, left)
$employment_preview->ListOptions->render("header", "left");
?>
<?php if ($employment_preview->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($employment->SortUrl($employment_preview->ProvinceCode) == "") { ?>
		<th class="<?php echo $employment_preview->ProvinceCode->headerCellClass() ?>"><?php echo $employment_preview->ProvinceCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->ProvinceCode->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->ProvinceCode->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->ProvinceCode->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->LACode->Visible) { // LACode ?>
	<?php if ($employment->SortUrl($employment_preview->LACode) == "") { ?>
		<th class="<?php echo $employment_preview->LACode->headerCellClass() ?>"><?php echo $employment_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->LACode->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->LACode->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->LACode->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($employment->SortUrl($employment_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $employment_preview->DepartmentCode->headerCellClass() ?>"><?php echo $employment_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->DepartmentCode->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->DepartmentCode->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($employment->SortUrl($employment_preview->SectionCode) == "") { ?>
		<th class="<?php echo $employment_preview->SectionCode->headerCellClass() ?>"><?php echo $employment_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->SectionCode->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->SectionCode->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->SubstantivePosition->Visible) { // SubstantivePosition ?>
	<?php if ($employment->SortUrl($employment_preview->SubstantivePosition) == "") { ?>
		<th class="<?php echo $employment_preview->SubstantivePosition->headerCellClass() ?>"><?php echo $employment_preview->SubstantivePosition->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->SubstantivePosition->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->SubstantivePosition->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->SubstantivePosition->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->SubstantivePosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->SubstantivePosition->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<?php if ($employment->SortUrl($employment_preview->DateOfCurrentAppointment) == "") { ?>
		<th class="<?php echo $employment_preview->DateOfCurrentAppointment->headerCellClass() ?>"><?php echo $employment_preview->DateOfCurrentAppointment->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->DateOfCurrentAppointment->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->DateOfCurrentAppointment->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->DateOfCurrentAppointment->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->DateOfCurrentAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->DateOfCurrentAppointment->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
	<?php if ($employment->SortUrl($employment_preview->LastAppraisalDate) == "") { ?>
		<th class="<?php echo $employment_preview->LastAppraisalDate->headerCellClass() ?>"><?php echo $employment_preview->LastAppraisalDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->LastAppraisalDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->LastAppraisalDate->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->LastAppraisalDate->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->LastAppraisalDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->LastAppraisalDate->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->AppraisalStatus->Visible) { // AppraisalStatus ?>
	<?php if ($employment->SortUrl($employment_preview->AppraisalStatus) == "") { ?>
		<th class="<?php echo $employment_preview->AppraisalStatus->headerCellClass() ?>"><?php echo $employment_preview->AppraisalStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->AppraisalStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->AppraisalStatus->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->AppraisalStatus->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->AppraisalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->AppraisalStatus->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->DateOfExit->Visible) { // DateOfExit ?>
	<?php if ($employment->SortUrl($employment_preview->DateOfExit) == "") { ?>
		<th class="<?php echo $employment_preview->DateOfExit->headerCellClass() ?>"><?php echo $employment_preview->DateOfExit->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->DateOfExit->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->DateOfExit->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->DateOfExit->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->DateOfExit->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->EmploymentType->Visible) { // EmploymentType ?>
	<?php if ($employment->SortUrl($employment_preview->EmploymentType) == "") { ?>
		<th class="<?php echo $employment_preview->EmploymentType->headerCellClass() ?>"><?php echo $employment_preview->EmploymentType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->EmploymentType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->EmploymentType->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->EmploymentType->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->EmploymentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->EmploymentType->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<?php if ($employment->SortUrl($employment_preview->EmploymentStatus) == "") { ?>
		<th class="<?php echo $employment_preview->EmploymentStatus->headerCellClass() ?>"><?php echo $employment_preview->EmploymentStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->EmploymentStatus->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->EmploymentStatus->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->EmploymentStatus->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->EmployeeNumber->Visible) { // EmployeeNumber ?>
	<?php if ($employment->SortUrl($employment_preview->EmployeeNumber) == "") { ?>
		<th class="<?php echo $employment_preview->EmployeeNumber->headerCellClass() ?>"><?php echo $employment_preview->EmployeeNumber->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->EmployeeNumber->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->EmployeeNumber->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->EmployeeNumber->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->EmployeeNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->EmployeeNumber->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->SalaryNotch->Visible) { // SalaryNotch ?>
	<?php if ($employment->SortUrl($employment_preview->SalaryNotch) == "") { ?>
		<th class="<?php echo $employment_preview->SalaryNotch->headerCellClass() ?>"><?php echo $employment_preview->SalaryNotch->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->SalaryNotch->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->SalaryNotch->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->SalaryNotch->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->SalaryNotch->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->SalaryNotch->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
	<?php if ($employment->SortUrl($employment_preview->BasicMonthlySalary) == "") { ?>
		<th class="<?php echo $employment_preview->BasicMonthlySalary->headerCellClass() ?>"><?php echo $employment_preview->BasicMonthlySalary->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->BasicMonthlySalary->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->BasicMonthlySalary->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->BasicMonthlySalary->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->BasicMonthlySalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->BasicMonthlySalary->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->ThirdParties->Visible) { // ThirdParties ?>
	<?php if ($employment->SortUrl($employment_preview->ThirdParties) == "") { ?>
		<th class="<?php echo $employment_preview->ThirdParties->headerCellClass() ?>"><?php echo $employment_preview->ThirdParties->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->ThirdParties->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->ThirdParties->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->ThirdParties->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->ThirdParties->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->ThirdParties->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->PayrollCode->Visible) { // PayrollCode ?>
	<?php if ($employment->SortUrl($employment_preview->PayrollCode) == "") { ?>
		<th class="<?php echo $employment_preview->PayrollCode->headerCellClass() ?>"><?php echo $employment_preview->PayrollCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->PayrollCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->PayrollCode->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->PayrollCode->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->PayrollCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->PayrollCode->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_preview->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<?php if ($employment->SortUrl($employment_preview->DateOfConfirmation) == "") { ?>
		<th class="<?php echo $employment_preview->DateOfConfirmation->headerCellClass() ?>"><?php echo $employment_preview->DateOfConfirmation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $employment_preview->DateOfConfirmation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($employment_preview->DateOfConfirmation->Name) ?>" data-sort-order="<?php echo $employment_preview->SortField == $employment_preview->DateOfConfirmation->Name && $employment_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_preview->DateOfConfirmation->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_preview->SortField == $employment_preview->DateOfConfirmation->Name) { ?><?php if ($employment_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$employment_preview->RecCount = 0;
$employment_preview->RowCount = 0;
while ($employment_preview->Recordset && !$employment_preview->Recordset->EOF) {

	// Init row class and style
	$employment_preview->RecCount++;
	$employment_preview->RowCount++;
	$employment_preview->CssStyle = "";
	$employment_preview->loadListRowValues($employment_preview->Recordset);

	// Render row
	$employment->RowType = ROWTYPE_PREVIEW; // Preview record
	$employment_preview->resetAttributes();
	$employment_preview->renderListRow();

	// Render list options
	$employment_preview->renderListOptions();
?>
	<tr <?php echo $employment->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_preview->ListOptions->render("body", "left", $employment_preview->RowCount);
?>
<?php if ($employment_preview->ProvinceCode->Visible) { // ProvinceCode ?>
		<!-- ProvinceCode -->
		<td<?php echo $employment_preview->ProvinceCode->cellAttributes() ?>>
<span<?php echo $employment_preview->ProvinceCode->viewAttributes() ?>><?php echo $employment_preview->ProvinceCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $employment_preview->LACode->cellAttributes() ?>>
<span<?php echo $employment_preview->LACode->viewAttributes() ?>><?php echo $employment_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $employment_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $employment_preview->DepartmentCode->viewAttributes() ?>><?php echo $employment_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $employment_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $employment_preview->SectionCode->viewAttributes() ?>><?php echo $employment_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->SubstantivePosition->Visible) { // SubstantivePosition ?>
		<!-- SubstantivePosition -->
		<td<?php echo $employment_preview->SubstantivePosition->cellAttributes() ?>>
<span<?php echo $employment_preview->SubstantivePosition->viewAttributes() ?>><?php echo $employment_preview->SubstantivePosition->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<!-- DateOfCurrentAppointment -->
		<td<?php echo $employment_preview->DateOfCurrentAppointment->cellAttributes() ?>>
<span<?php echo $employment_preview->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $employment_preview->DateOfCurrentAppointment->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->LastAppraisalDate->Visible) { // LastAppraisalDate ?>
		<!-- LastAppraisalDate -->
		<td<?php echo $employment_preview->LastAppraisalDate->cellAttributes() ?>>
<span<?php echo $employment_preview->LastAppraisalDate->viewAttributes() ?>><?php echo $employment_preview->LastAppraisalDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->AppraisalStatus->Visible) { // AppraisalStatus ?>
		<!-- AppraisalStatus -->
		<td<?php echo $employment_preview->AppraisalStatus->cellAttributes() ?>>
<span<?php echo $employment_preview->AppraisalStatus->viewAttributes() ?>><?php echo $employment_preview->AppraisalStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->DateOfExit->Visible) { // DateOfExit ?>
		<!-- DateOfExit -->
		<td<?php echo $employment_preview->DateOfExit->cellAttributes() ?>>
<span<?php echo $employment_preview->DateOfExit->viewAttributes() ?>><?php echo $employment_preview->DateOfExit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->EmploymentType->Visible) { // EmploymentType ?>
		<!-- EmploymentType -->
		<td<?php echo $employment_preview->EmploymentType->cellAttributes() ?>>
<span<?php echo $employment_preview->EmploymentType->viewAttributes() ?>><?php echo $employment_preview->EmploymentType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<!-- EmploymentStatus -->
		<td<?php echo $employment_preview->EmploymentStatus->cellAttributes() ?>>
<span<?php echo $employment_preview->EmploymentStatus->viewAttributes() ?>><?php echo $employment_preview->EmploymentStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->EmployeeNumber->Visible) { // EmployeeNumber ?>
		<!-- EmployeeNumber -->
		<td<?php echo $employment_preview->EmployeeNumber->cellAttributes() ?>>
<span<?php echo $employment_preview->EmployeeNumber->viewAttributes() ?>><?php echo $employment_preview->EmployeeNumber->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->SalaryNotch->Visible) { // SalaryNotch ?>
		<!-- SalaryNotch -->
		<td<?php echo $employment_preview->SalaryNotch->cellAttributes() ?>>
<span<?php echo $employment_preview->SalaryNotch->viewAttributes() ?>><?php echo $employment_preview->SalaryNotch->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->BasicMonthlySalary->Visible) { // BasicMonthlySalary ?>
		<!-- BasicMonthlySalary -->
		<td<?php echo $employment_preview->BasicMonthlySalary->cellAttributes() ?>>
<span<?php echo $employment_preview->BasicMonthlySalary->viewAttributes() ?>><?php echo $employment_preview->BasicMonthlySalary->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->ThirdParties->Visible) { // ThirdParties ?>
		<!-- ThirdParties -->
		<td<?php echo $employment_preview->ThirdParties->cellAttributes() ?>>
<span<?php echo $employment_preview->ThirdParties->viewAttributes() ?>><?php echo $employment_preview->ThirdParties->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->PayrollCode->Visible) { // PayrollCode ?>
		<!-- PayrollCode -->
		<td<?php echo $employment_preview->PayrollCode->cellAttributes() ?>>
<span<?php echo $employment_preview->PayrollCode->viewAttributes() ?>><?php echo $employment_preview->PayrollCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($employment_preview->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<!-- DateOfConfirmation -->
		<td<?php echo $employment_preview->DateOfConfirmation->cellAttributes() ?>>
<span<?php echo $employment_preview->DateOfConfirmation->viewAttributes() ?>><?php echo $employment_preview->DateOfConfirmation->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$employment_preview->ListOptions->render("body", "right", $employment_preview->RowCount);
?>
	</tr>
<?php
	$employment_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $employment_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($employment_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($employment_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$employment_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($employment_preview->Recordset)
	$employment_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$employment_preview->terminate();
?>