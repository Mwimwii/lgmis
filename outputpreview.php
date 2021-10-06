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
$output_preview = new output_preview();

// Run the page
$output_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_preview->Page_Render();
?>
<?php $output_preview->showPageHeader(); ?>
<?php if ($output_preview->TotalRecords > 0) { ?>
<div class="card ew-grid output"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$output_preview->renderListOptions();

// Render list options (header, left)
$output_preview->ListOptions->render("header", "left");
?>
<?php if ($output_preview->LACode->Visible) { // LACode ?>
	<?php if ($output->SortUrl($output_preview->LACode) == "") { ?>
		<th class="<?php echo $output_preview->LACode->headerCellClass() ?>"><?php echo $output_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->LACode->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->LACode->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->LACode->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($output->SortUrl($output_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $output_preview->DepartmentCode->headerCellClass() ?>"><?php echo $output_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->DepartmentCode->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->DepartmentCode->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($output->SortUrl($output_preview->SectionCode) == "") { ?>
		<th class="<?php echo $output_preview->SectionCode->headerCellClass() ?>"><?php echo $output_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->SectionCode->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->SectionCode->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($output->SortUrl($output_preview->OutcomeCode) == "") { ?>
		<th class="<?php echo $output_preview->OutcomeCode->headerCellClass() ?>"><?php echo $output_preview->OutcomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->OutcomeCode->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->OutcomeCode->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->OutcomeCode->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($output->SortUrl($output_preview->ProgramCode) == "") { ?>
		<th class="<?php echo $output_preview->ProgramCode->headerCellClass() ?>"><?php echo $output_preview->ProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->ProgramCode->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->ProgramCode->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->ProgramCode->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($output->SortUrl($output_preview->SubProgramCode) == "") { ?>
		<th class="<?php echo $output_preview->SubProgramCode->headerCellClass() ?>"><?php echo $output_preview->SubProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->SubProgramCode->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->SubProgramCode->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->SubProgramCode->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->OutputCode->Visible) { // OutputCode ?>
	<?php if ($output->SortUrl($output_preview->OutputCode) == "") { ?>
		<th class="<?php echo $output_preview->OutputCode->headerCellClass() ?>"><?php echo $output_preview->OutputCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->OutputCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->OutputCode->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->OutputCode->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->OutputCode->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->OutputType->Visible) { // OutputType ?>
	<?php if ($output->SortUrl($output_preview->OutputType) == "") { ?>
		<th class="<?php echo $output_preview->OutputType->headerCellClass() ?>"><?php echo $output_preview->OutputType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->OutputType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->OutputType->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->OutputType->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->OutputType->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->OutputType->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->OutputName->Visible) { // OutputName ?>
	<?php if ($output->SortUrl($output_preview->OutputName) == "") { ?>
		<th class="<?php echo $output_preview->OutputName->headerCellClass() ?>"><?php echo $output_preview->OutputName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->OutputName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->OutputName->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->OutputName->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->OutputName->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->OutputName->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->DeliveryDate->Visible) { // DeliveryDate ?>
	<?php if ($output->SortUrl($output_preview->DeliveryDate) == "") { ?>
		<th class="<?php echo $output_preview->DeliveryDate->headerCellClass() ?>"><?php echo $output_preview->DeliveryDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->DeliveryDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->DeliveryDate->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->DeliveryDate->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->DeliveryDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->DeliveryDate->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($output->SortUrl($output_preview->FinancialYear) == "") { ?>
		<th class="<?php echo $output_preview->FinancialYear->headerCellClass() ?>"><?php echo $output_preview->FinancialYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->FinancialYear->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->FinancialYear->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->FinancialYear->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->OutputDescription->Visible) { // OutputDescription ?>
	<?php if ($output->SortUrl($output_preview->OutputDescription) == "") { ?>
		<th class="<?php echo $output_preview->OutputDescription->headerCellClass() ?>"><?php echo $output_preview->OutputDescription->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->OutputDescription->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->OutputDescription->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->OutputDescription->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->OutputDescription->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->OutputDescription->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
	<?php if ($output->SortUrl($output_preview->OutputMeansOfVerification) == "") { ?>
		<th class="<?php echo $output_preview->OutputMeansOfVerification->headerCellClass() ?>"><?php echo $output_preview->OutputMeansOfVerification->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->OutputMeansOfVerification->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->OutputMeansOfVerification->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->OutputMeansOfVerification->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->OutputMeansOfVerification->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->OutputMeansOfVerification->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<?php if ($output->SortUrl($output_preview->ResponsibleOfficer) == "") { ?>
		<th class="<?php echo $output_preview->ResponsibleOfficer->headerCellClass() ?>"><?php echo $output_preview->ResponsibleOfficer->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->ResponsibleOfficer->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->ResponsibleOfficer->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->ResponsibleOfficer->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->ResponsibleOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->ResponsibleOfficer->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->Clients->Visible) { // Clients ?>
	<?php if ($output->SortUrl($output_preview->Clients) == "") { ?>
		<th class="<?php echo $output_preview->Clients->headerCellClass() ?>"><?php echo $output_preview->Clients->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->Clients->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->Clients->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->Clients->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->Clients->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->Clients->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->Beneficiaries->Visible) { // Beneficiaries ?>
	<?php if ($output->SortUrl($output_preview->Beneficiaries) == "") { ?>
		<th class="<?php echo $output_preview->Beneficiaries->headerCellClass() ?>"><?php echo $output_preview->Beneficiaries->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->Beneficiaries->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->Beneficiaries->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->Beneficiaries->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->Beneficiaries->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->Beneficiaries->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->OutputStatus->Visible) { // OutputStatus ?>
	<?php if ($output->SortUrl($output_preview->OutputStatus) == "") { ?>
		<th class="<?php echo $output_preview->OutputStatus->headerCellClass() ?>"><?php echo $output_preview->OutputStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->OutputStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->OutputStatus->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->OutputStatus->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->OutputStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->OutputStatus->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->TargetAmount->Visible) { // TargetAmount ?>
	<?php if ($output->SortUrl($output_preview->TargetAmount) == "") { ?>
		<th class="<?php echo $output_preview->TargetAmount->headerCellClass() ?>"><?php echo $output_preview->TargetAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->TargetAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->TargetAmount->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->TargetAmount->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->TargetAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->TargetAmount->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->ActualAmount->Visible) { // ActualAmount ?>
	<?php if ($output->SortUrl($output_preview->ActualAmount) == "") { ?>
		<th class="<?php echo $output_preview->ActualAmount->headerCellClass() ?>"><?php echo $output_preview->ActualAmount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->ActualAmount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->ActualAmount->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->ActualAmount->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->ActualAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->ActualAmount->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($output_preview->PercentAchieved->Visible) { // PercentAchieved ?>
	<?php if ($output->SortUrl($output_preview->PercentAchieved) == "") { ?>
		<th class="<?php echo $output_preview->PercentAchieved->headerCellClass() ?>"><?php echo $output_preview->PercentAchieved->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $output_preview->PercentAchieved->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($output_preview->PercentAchieved->Name) ?>" data-sort-order="<?php echo $output_preview->SortField == $output_preview->PercentAchieved->Name && $output_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $output_preview->PercentAchieved->caption() ?></span><span class="ew-table-header-sort"><?php if ($output_preview->SortField == $output_preview->PercentAchieved->Name) { ?><?php if ($output_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($output_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$output_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$output_preview->RecCount = 0;
$output_preview->RowCount = 0;
while ($output_preview->Recordset && !$output_preview->Recordset->EOF) {

	// Init row class and style
	$output_preview->RecCount++;
	$output_preview->RowCount++;
	$output_preview->CssStyle = "";
	$output_preview->loadListRowValues($output_preview->Recordset);

	// Render row
	$output->RowType = ROWTYPE_PREVIEW; // Preview record
	$output_preview->resetAttributes();
	$output_preview->renderListRow();

	// Render list options
	$output_preview->renderListOptions();
?>
	<tr <?php echo $output->rowAttributes() ?>>
<?php

// Render list options (body, left)
$output_preview->ListOptions->render("body", "left", $output_preview->RowCount);
?>
<?php if ($output_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $output_preview->LACode->cellAttributes() ?>>
<span<?php echo $output_preview->LACode->viewAttributes() ?>><?php echo $output_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $output_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $output_preview->DepartmentCode->viewAttributes() ?>><?php echo $output_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $output_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $output_preview->SectionCode->viewAttributes() ?>><?php echo $output_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->OutcomeCode->Visible) { // OutcomeCode ?>
		<!-- OutcomeCode -->
		<td<?php echo $output_preview->OutcomeCode->cellAttributes() ?>>
<span<?php echo $output_preview->OutcomeCode->viewAttributes() ?>><?php echo $output_preview->OutcomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->ProgramCode->Visible) { // ProgramCode ?>
		<!-- ProgramCode -->
		<td<?php echo $output_preview->ProgramCode->cellAttributes() ?>>
<span<?php echo $output_preview->ProgramCode->viewAttributes() ?>><?php echo $output_preview->ProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->SubProgramCode->Visible) { // SubProgramCode ?>
		<!-- SubProgramCode -->
		<td<?php echo $output_preview->SubProgramCode->cellAttributes() ?>>
<span<?php echo $output_preview->SubProgramCode->viewAttributes() ?>><?php echo $output_preview->SubProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->OutputCode->Visible) { // OutputCode ?>
		<!-- OutputCode -->
		<td<?php echo $output_preview->OutputCode->cellAttributes() ?>>
<span<?php echo $output_preview->OutputCode->viewAttributes() ?>><?php echo $output_preview->OutputCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->OutputType->Visible) { // OutputType ?>
		<!-- OutputType -->
		<td<?php echo $output_preview->OutputType->cellAttributes() ?>>
<span<?php echo $output_preview->OutputType->viewAttributes() ?>><?php echo $output_preview->OutputType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->OutputName->Visible) { // OutputName ?>
		<!-- OutputName -->
		<td<?php echo $output_preview->OutputName->cellAttributes() ?>>
<span<?php echo $output_preview->OutputName->viewAttributes() ?>><?php echo $output_preview->OutputName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->DeliveryDate->Visible) { // DeliveryDate ?>
		<!-- DeliveryDate -->
		<td<?php echo $output_preview->DeliveryDate->cellAttributes() ?>>
<span<?php echo $output_preview->DeliveryDate->viewAttributes() ?>><?php echo $output_preview->DeliveryDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->FinancialYear->Visible) { // FinancialYear ?>
		<!-- FinancialYear -->
		<td<?php echo $output_preview->FinancialYear->cellAttributes() ?>>
<span<?php echo $output_preview->FinancialYear->viewAttributes() ?>><?php echo $output_preview->FinancialYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->OutputDescription->Visible) { // OutputDescription ?>
		<!-- OutputDescription -->
		<td<?php echo $output_preview->OutputDescription->cellAttributes() ?>>
<span<?php echo $output_preview->OutputDescription->viewAttributes() ?>><?php echo $output_preview->OutputDescription->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->OutputMeansOfVerification->Visible) { // OutputMeansOfVerification ?>
		<!-- OutputMeansOfVerification -->
		<td<?php echo $output_preview->OutputMeansOfVerification->cellAttributes() ?>>
<span<?php echo $output_preview->OutputMeansOfVerification->viewAttributes() ?>><?php echo $output_preview->OutputMeansOfVerification->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<!-- ResponsibleOfficer -->
		<td<?php echo $output_preview->ResponsibleOfficer->cellAttributes() ?>>
<span<?php echo $output_preview->ResponsibleOfficer->viewAttributes() ?>><?php echo $output_preview->ResponsibleOfficer->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->Clients->Visible) { // Clients ?>
		<!-- Clients -->
		<td<?php echo $output_preview->Clients->cellAttributes() ?>>
<span<?php echo $output_preview->Clients->viewAttributes() ?>><?php echo $output_preview->Clients->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->Beneficiaries->Visible) { // Beneficiaries ?>
		<!-- Beneficiaries -->
		<td<?php echo $output_preview->Beneficiaries->cellAttributes() ?>>
<span<?php echo $output_preview->Beneficiaries->viewAttributes() ?>><?php echo $output_preview->Beneficiaries->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->OutputStatus->Visible) { // OutputStatus ?>
		<!-- OutputStatus -->
		<td<?php echo $output_preview->OutputStatus->cellAttributes() ?>>
<span<?php echo $output_preview->OutputStatus->viewAttributes() ?>><?php echo $output_preview->OutputStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->TargetAmount->Visible) { // TargetAmount ?>
		<!-- TargetAmount -->
		<td<?php echo $output_preview->TargetAmount->cellAttributes() ?>>
<span<?php echo $output_preview->TargetAmount->viewAttributes() ?>><?php echo $output_preview->TargetAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->ActualAmount->Visible) { // ActualAmount ?>
		<!-- ActualAmount -->
		<td<?php echo $output_preview->ActualAmount->cellAttributes() ?>>
<span<?php echo $output_preview->ActualAmount->viewAttributes() ?>><?php echo $output_preview->ActualAmount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($output_preview->PercentAchieved->Visible) { // PercentAchieved ?>
		<!-- PercentAchieved -->
		<td<?php echo $output_preview->PercentAchieved->cellAttributes() ?>>
<span<?php echo $output_preview->PercentAchieved->viewAttributes() ?>><?php echo $output_preview->PercentAchieved->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$output_preview->ListOptions->render("body", "right", $output_preview->RowCount);
?>
	</tr>
<?php
	$output_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $output_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($output_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($output_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$output_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($output_preview->Recordset)
	$output_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$output_preview->terminate();
?>