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
$payroll_summary_view_preview = new payroll_summary_view_preview();

// Run the page
$payroll_summary_view_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_summary_view_preview->Page_Render();
?>
<?php $payroll_summary_view_preview->showPageHeader(); ?>
<?php if ($payroll_summary_view_preview->TotalRecords > 0) { ?>
<div class="card ew-grid payroll_summary_view"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$payroll_summary_view_preview->renderListOptions();

// Render list options (header, left)
$payroll_summary_view_preview->ListOptions->render("header", "left");
?>
<?php if ($payroll_summary_view_preview->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->LocalAuthority) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->LocalAuthority->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->LocalAuthority->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->LocalAuthority->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->LocalAuthority->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->LocalAuthority->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->DepartmentName) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->DepartmentName->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->DepartmentName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->DepartmentName->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->DepartmentName->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->DepartmentName->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->SectionName->Visible) { // SectionName ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->SectionName) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->SectionName->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->SectionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->SectionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->SectionName->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->SectionName->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->SectionName->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->EmployeeID->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->EmployeeID->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->EmployeeID->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->Title->Visible) { // Title ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->Title) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->Title->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->Title->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->Title->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->Title->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Title->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Title->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->Surname->Visible) { // Surname ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->Surname) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->Surname->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->Surname->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->Surname->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->Surname->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Surname->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Surname->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->FirstName->Visible) { // FirstName ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->FirstName) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->FirstName->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->FirstName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->FirstName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->FirstName->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->FirstName->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->FirstName->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->MiddleName->Visible) { // MiddleName ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->MiddleName) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->MiddleName->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->MiddleName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->MiddleName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->MiddleName->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->MiddleName->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->MiddleName->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->Sex->Visible) { // Sex ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->Sex) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->Sex->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->Sex->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->Sex->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->Sex->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Sex->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Sex->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->NRC->Visible) { // NRC ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->NRC) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->NRC->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->NRC->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->NRC->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->NRC->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->NRC->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->NRC->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->PositionName->Visible) { // PositionName ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->PositionName) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->PositionName->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->PositionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->PositionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->PositionName->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PositionName->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PositionName->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->PayrollPeriod) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->PayrollPeriod->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->PayrollPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->PayrollPeriod->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PayrollPeriod->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PayrollPeriod->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->pCode->Visible) { // pCode ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->pCode) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->pCode->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->pCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->pCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->pCode->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->pCode->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->pCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->pCode->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->pName->Visible) { // pName ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->pName) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->pName->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->pName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->pName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->pName->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->pName->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->pName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->pName->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->Amount->Visible) { // Amount ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->Amount) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->Amount->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->Amount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->Amount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->Amount->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Amount->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Amount->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->PayPeriod->Visible) { // PayPeriod ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->PayPeriod) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->PayPeriod->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->PayPeriod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->PayPeriod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->PayPeriod->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PayPeriod->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->PayPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PayPeriod->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->SalaryScale) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->SalaryScale->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->SalaryScale->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->SalaryScale->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->SalaryScale->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->SalaryScale->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->Division->Visible) { // Division ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->Division) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->Division->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->Division->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->Division->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->Division->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Division->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->Division->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->PaymentMethod) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->PaymentMethod->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->PaymentMethod->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->PaymentMethod->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PaymentMethod->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->PaymentMethod->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->BankBranchCode) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->BankBranchCode->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->BankBranchCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->BankBranchCode->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->BankBranchCode->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->BankBranchCode->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_preview->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($payroll_summary_view->SortUrl($payroll_summary_view_preview->BankAccountNo) == "") { ?>
		<th class="<?php echo $payroll_summary_view_preview->BankAccountNo->headerCellClass() ?>"><?php echo $payroll_summary_view_preview->BankAccountNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $payroll_summary_view_preview->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($payroll_summary_view_preview->BankAccountNo->Name) ?>" data-sort-order="<?php echo $payroll_summary_view_preview->SortField == $payroll_summary_view_preview->BankAccountNo->Name && $payroll_summary_view_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_preview->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_preview->SortField == $payroll_summary_view_preview->BankAccountNo->Name) { ?><?php if ($payroll_summary_view_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_summary_view_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$payroll_summary_view_preview->RecCount = 0;
$payroll_summary_view_preview->RowCount = 0;
while ($payroll_summary_view_preview->Recordset && !$payroll_summary_view_preview->Recordset->EOF) {

	// Init row class and style
	$payroll_summary_view_preview->RecCount++;
	$payroll_summary_view_preview->RowCount++;
	$payroll_summary_view_preview->CssStyle = "";
	$payroll_summary_view_preview->loadListRowValues($payroll_summary_view_preview->Recordset);

	// Render row
	$payroll_summary_view->RowType = ROWTYPE_PREVIEW; // Preview record
	$payroll_summary_view_preview->resetAttributes();
	$payroll_summary_view_preview->renderListRow();

	// Render list options
	$payroll_summary_view_preview->renderListOptions();
?>
	<tr <?php echo $payroll_summary_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_summary_view_preview->ListOptions->render("body", "left", $payroll_summary_view_preview->RowCount);
?>
<?php if ($payroll_summary_view_preview->LocalAuthority->Visible) { // LocalAuthority ?>
		<!-- LocalAuthority -->
		<td<?php echo $payroll_summary_view_preview->LocalAuthority->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->LocalAuthority->viewAttributes() ?>><?php echo $payroll_summary_view_preview->LocalAuthority->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->DepartmentName->Visible) { // DepartmentName ?>
		<!-- DepartmentName -->
		<td<?php echo $payroll_summary_view_preview->DepartmentName->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->DepartmentName->viewAttributes() ?>><?php echo $payroll_summary_view_preview->DepartmentName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->SectionName->Visible) { // SectionName ?>
		<!-- SectionName -->
		<td<?php echo $payroll_summary_view_preview->SectionName->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->SectionName->viewAttributes() ?>><?php echo $payroll_summary_view_preview->SectionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $payroll_summary_view_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->EmployeeID->viewAttributes() ?>><?php echo $payroll_summary_view_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->Title->Visible) { // Title ?>
		<!-- Title -->
		<td<?php echo $payroll_summary_view_preview->Title->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->Title->viewAttributes() ?>><?php echo $payroll_summary_view_preview->Title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->Surname->Visible) { // Surname ?>
		<!-- Surname -->
		<td<?php echo $payroll_summary_view_preview->Surname->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->Surname->viewAttributes() ?>><?php echo $payroll_summary_view_preview->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->FirstName->Visible) { // FirstName ?>
		<!-- FirstName -->
		<td<?php echo $payroll_summary_view_preview->FirstName->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->FirstName->viewAttributes() ?>><?php echo $payroll_summary_view_preview->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->MiddleName->Visible) { // MiddleName ?>
		<!-- MiddleName -->
		<td<?php echo $payroll_summary_view_preview->MiddleName->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->MiddleName->viewAttributes() ?>><?php echo $payroll_summary_view_preview->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->Sex->Visible) { // Sex ?>
		<!-- Sex -->
		<td<?php echo $payroll_summary_view_preview->Sex->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->Sex->viewAttributes() ?>><?php echo $payroll_summary_view_preview->Sex->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->NRC->Visible) { // NRC ?>
		<!-- NRC -->
		<td<?php echo $payroll_summary_view_preview->NRC->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->NRC->viewAttributes() ?>><?php echo $payroll_summary_view_preview->NRC->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->PositionName->Visible) { // PositionName ?>
		<!-- PositionName -->
		<td<?php echo $payroll_summary_view_preview->PositionName->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->PositionName->viewAttributes() ?>><?php echo $payroll_summary_view_preview->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<!-- PayrollPeriod -->
		<td<?php echo $payroll_summary_view_preview->PayrollPeriod->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->PayrollPeriod->viewAttributes() ?>><?php echo $payroll_summary_view_preview->PayrollPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->pCode->Visible) { // pCode ?>
		<!-- pCode -->
		<td<?php echo $payroll_summary_view_preview->pCode->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->pCode->viewAttributes() ?>><?php echo $payroll_summary_view_preview->pCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->pName->Visible) { // pName ?>
		<!-- pName -->
		<td<?php echo $payroll_summary_view_preview->pName->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->pName->viewAttributes() ?>><?php echo $payroll_summary_view_preview->pName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->Amount->Visible) { // Amount ?>
		<!-- Amount -->
		<td<?php echo $payroll_summary_view_preview->Amount->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->Amount->viewAttributes() ?>><?php echo $payroll_summary_view_preview->Amount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->PayPeriod->Visible) { // PayPeriod ?>
		<!-- PayPeriod -->
		<td<?php echo $payroll_summary_view_preview->PayPeriod->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->PayPeriod->viewAttributes() ?>><?php echo $payroll_summary_view_preview->PayPeriod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->SalaryScale->Visible) { // SalaryScale ?>
		<!-- SalaryScale -->
		<td<?php echo $payroll_summary_view_preview->SalaryScale->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->SalaryScale->viewAttributes() ?>><?php echo $payroll_summary_view_preview->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->Division->Visible) { // Division ?>
		<!-- Division -->
		<td<?php echo $payroll_summary_view_preview->Division->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->Division->viewAttributes() ?>><?php echo $payroll_summary_view_preview->Division->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->PaymentMethod->Visible) { // PaymentMethod ?>
		<!-- PaymentMethod -->
		<td<?php echo $payroll_summary_view_preview->PaymentMethod->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->PaymentMethod->viewAttributes() ?>><?php echo $payroll_summary_view_preview->PaymentMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->BankBranchCode->Visible) { // BankBranchCode ?>
		<!-- BankBranchCode -->
		<td<?php echo $payroll_summary_view_preview->BankBranchCode->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->BankBranchCode->viewAttributes() ?>><?php echo $payroll_summary_view_preview->BankBranchCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($payroll_summary_view_preview->BankAccountNo->Visible) { // BankAccountNo ?>
		<!-- BankAccountNo -->
		<td<?php echo $payroll_summary_view_preview->BankAccountNo->cellAttributes() ?>>
<span<?php echo $payroll_summary_view_preview->BankAccountNo->viewAttributes() ?>><?php echo $payroll_summary_view_preview->BankAccountNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$payroll_summary_view_preview->ListOptions->render("body", "right", $payroll_summary_view_preview->RowCount);
?>
	</tr>
<?php
	$payroll_summary_view_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $payroll_summary_view_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($payroll_summary_view_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($payroll_summary_view_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$payroll_summary_view_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($payroll_summary_view_preview->Recordset)
	$payroll_summary_view_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$payroll_summary_view_preview->terminate();
?>