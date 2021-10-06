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
$detailed_action_preview = new detailed_action_preview();

// Run the page
$detailed_action_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailed_action_preview->Page_Render();
?>
<?php $detailed_action_preview->showPageHeader(); ?>
<?php if ($detailed_action_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailed_action"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailed_action_preview->renderListOptions();

// Render list options (header, left)
$detailed_action_preview->ListOptions->render("header", "left");
?>
<?php if ($detailed_action_preview->LACode->Visible) { // LACode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->LACode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->LACode->headerCellClass() ?>"><?php echo $detailed_action_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->LACode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->LACode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->LACode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->DepartmentCode->headerCellClass() ?>"><?php echo $detailed_action_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->DepartmentCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->DepartmentCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->SectionCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->SectionCode->headerCellClass() ?>"><?php echo $detailed_action_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->SectionCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->SectionCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->ProgramCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->ProgramCode->headerCellClass() ?>"><?php echo $detailed_action_preview->ProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->ProgramCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->ProgramCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->ProgramCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->SubProgramCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->SubProgramCode->headerCellClass() ?>"><?php echo $detailed_action_preview->SubProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->SubProgramCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->SubProgramCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->SubProgramCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->OutcomeCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->OutcomeCode->headerCellClass() ?>"><?php echo $detailed_action_preview->OutcomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->OutcomeCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->OutcomeCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->OutcomeCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->OutputCode->Visible) { // OutputCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->OutputCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->OutputCode->headerCellClass() ?>"><?php echo $detailed_action_preview->OutputCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->OutputCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->OutputCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->OutputCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->OutputCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->ActionCode->Visible) { // ActionCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->ActionCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->ActionCode->headerCellClass() ?>"><?php echo $detailed_action_preview->ActionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->ActionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->ActionCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->ActionCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->ActionCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->FinancialYear) == "") { ?>
		<th class="<?php echo $detailed_action_preview->FinancialYear->headerCellClass() ?>"><?php echo $detailed_action_preview->FinancialYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->FinancialYear->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->FinancialYear->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->FinancialYear->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->DetailedActionCode->Visible) { // DetailedActionCode ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->DetailedActionCode) == "") { ?>
		<th class="<?php echo $detailed_action_preview->DetailedActionCode->headerCellClass() ?>"><?php echo $detailed_action_preview->DetailedActionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->DetailedActionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->DetailedActionCode->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->DetailedActionCode->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->DetailedActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->DetailedActionCode->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->DetailedActionName->Visible) { // DetailedActionName ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->DetailedActionName) == "") { ?>
		<th class="<?php echo $detailed_action_preview->DetailedActionName->headerCellClass() ?>"><?php echo $detailed_action_preview->DetailedActionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->DetailedActionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->DetailedActionName->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->DetailedActionName->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->DetailedActionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->DetailedActionName->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->DetailedActionLocation) == "") { ?>
		<th class="<?php echo $detailed_action_preview->DetailedActionLocation->headerCellClass() ?>"><?php echo $detailed_action_preview->DetailedActionLocation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->DetailedActionLocation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->DetailedActionLocation->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->DetailedActionLocation->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->DetailedActionLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->DetailedActionLocation->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->PlannedStartDate) == "") { ?>
		<th class="<?php echo $detailed_action_preview->PlannedStartDate->headerCellClass() ?>"><?php echo $detailed_action_preview->PlannedStartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->PlannedStartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->PlannedStartDate->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->PlannedStartDate->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->PlannedStartDate->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->PlannedEndDate) == "") { ?>
		<th class="<?php echo $detailed_action_preview->PlannedEndDate->headerCellClass() ?>"><?php echo $detailed_action_preview->PlannedEndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->PlannedEndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->PlannedEndDate->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->PlannedEndDate->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->PlannedEndDate->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->ActualStartDate) == "") { ?>
		<th class="<?php echo $detailed_action_preview->ActualStartDate->headerCellClass() ?>"><?php echo $detailed_action_preview->ActualStartDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->ActualStartDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->ActualStartDate->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->ActualStartDate->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->ActualStartDate->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->ActualEndDate->Visible) { // ActualEndDate ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->ActualEndDate) == "") { ?>
		<th class="<?php echo $detailed_action_preview->ActualEndDate->headerCellClass() ?>"><?php echo $detailed_action_preview->ActualEndDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->ActualEndDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->ActualEndDate->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->ActualEndDate->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->ActualEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->ActualEndDate->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->Ward->Visible) { // Ward ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->Ward) == "") { ?>
		<th class="<?php echo $detailed_action_preview->Ward->headerCellClass() ?>"><?php echo $detailed_action_preview->Ward->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->Ward->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->Ward->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->Ward->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->Ward->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->Ward->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->ExpectedResult->Visible) { // ExpectedResult ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->ExpectedResult) == "") { ?>
		<th class="<?php echo $detailed_action_preview->ExpectedResult->headerCellClass() ?>"><?php echo $detailed_action_preview->ExpectedResult->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->ExpectedResult->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->ExpectedResult->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->ExpectedResult->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->ExpectedResult->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->ExpectedResult->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->Comments->Visible) { // Comments ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->Comments) == "") { ?>
		<th class="<?php echo $detailed_action_preview->Comments->headerCellClass() ?>"><?php echo $detailed_action_preview->Comments->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->Comments->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->Comments->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->Comments->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->Comments->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->Comments->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailed_action_preview->ProgressStatus->Visible) { // ProgressStatus ?>
	<?php if ($detailed_action->SortUrl($detailed_action_preview->ProgressStatus) == "") { ?>
		<th class="<?php echo $detailed_action_preview->ProgressStatus->headerCellClass() ?>"><?php echo $detailed_action_preview->ProgressStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailed_action_preview->ProgressStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailed_action_preview->ProgressStatus->Name) ?>" data-sort-order="<?php echo $detailed_action_preview->SortField == $detailed_action_preview->ProgressStatus->Name && $detailed_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailed_action_preview->ProgressStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailed_action_preview->SortField == $detailed_action_preview->ProgressStatus->Name) { ?><?php if ($detailed_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailed_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailed_action_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailed_action_preview->RecCount = 0;
$detailed_action_preview->RowCount = 0;
while ($detailed_action_preview->Recordset && !$detailed_action_preview->Recordset->EOF) {

	// Init row class and style
	$detailed_action_preview->RecCount++;
	$detailed_action_preview->RowCount++;
	$detailed_action_preview->CssStyle = "";
	$detailed_action_preview->loadListRowValues($detailed_action_preview->Recordset);

	// Render row
	$detailed_action->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailed_action_preview->resetAttributes();
	$detailed_action_preview->renderListRow();

	// Render list options
	$detailed_action_preview->renderListOptions();
?>
	<tr <?php echo $detailed_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailed_action_preview->ListOptions->render("body", "left", $detailed_action_preview->RowCount);
?>
<?php if ($detailed_action_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $detailed_action_preview->LACode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->LACode->viewAttributes() ?>><?php echo $detailed_action_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $detailed_action_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->DepartmentCode->viewAttributes() ?>><?php echo $detailed_action_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $detailed_action_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->SectionCode->viewAttributes() ?>><?php echo $detailed_action_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->ProgramCode->Visible) { // ProgramCode ?>
		<!-- ProgramCode -->
		<td<?php echo $detailed_action_preview->ProgramCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->ProgramCode->viewAttributes() ?>><?php echo $detailed_action_preview->ProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->SubProgramCode->Visible) { // SubProgramCode ?>
		<!-- SubProgramCode -->
		<td<?php echo $detailed_action_preview->SubProgramCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->SubProgramCode->viewAttributes() ?>><?php echo $detailed_action_preview->SubProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->OutcomeCode->Visible) { // OutcomeCode ?>
		<!-- OutcomeCode -->
		<td<?php echo $detailed_action_preview->OutcomeCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->OutcomeCode->viewAttributes() ?>><?php echo $detailed_action_preview->OutcomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->OutputCode->Visible) { // OutputCode ?>
		<!-- OutputCode -->
		<td<?php echo $detailed_action_preview->OutputCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->OutputCode->viewAttributes() ?>><?php echo $detailed_action_preview->OutputCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->ActionCode->Visible) { // ActionCode ?>
		<!-- ActionCode -->
		<td<?php echo $detailed_action_preview->ActionCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->ActionCode->viewAttributes() ?>><?php echo $detailed_action_preview->ActionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->FinancialYear->Visible) { // FinancialYear ?>
		<!-- FinancialYear -->
		<td<?php echo $detailed_action_preview->FinancialYear->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->FinancialYear->viewAttributes() ?>><?php echo $detailed_action_preview->FinancialYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->DetailedActionCode->Visible) { // DetailedActionCode ?>
		<!-- DetailedActionCode -->
		<td<?php echo $detailed_action_preview->DetailedActionCode->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->DetailedActionCode->viewAttributes() ?>><?php echo $detailed_action_preview->DetailedActionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->DetailedActionName->Visible) { // DetailedActionName ?>
		<!-- DetailedActionName -->
		<td<?php echo $detailed_action_preview->DetailedActionName->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->DetailedActionName->viewAttributes() ?>><?php echo $detailed_action_preview->DetailedActionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->DetailedActionLocation->Visible) { // DetailedActionLocation ?>
		<!-- DetailedActionLocation -->
		<td<?php echo $detailed_action_preview->DetailedActionLocation->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->DetailedActionLocation->viewAttributes() ?>><?php echo $detailed_action_preview->DetailedActionLocation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<!-- PlannedStartDate -->
		<td<?php echo $detailed_action_preview->PlannedStartDate->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->PlannedStartDate->viewAttributes() ?>><?php echo $detailed_action_preview->PlannedStartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<!-- PlannedEndDate -->
		<td<?php echo $detailed_action_preview->PlannedEndDate->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->PlannedEndDate->viewAttributes() ?>><?php echo $detailed_action_preview->PlannedEndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->ActualStartDate->Visible) { // ActualStartDate ?>
		<!-- ActualStartDate -->
		<td<?php echo $detailed_action_preview->ActualStartDate->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->ActualStartDate->viewAttributes() ?>><?php echo $detailed_action_preview->ActualStartDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->ActualEndDate->Visible) { // ActualEndDate ?>
		<!-- ActualEndDate -->
		<td<?php echo $detailed_action_preview->ActualEndDate->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->ActualEndDate->viewAttributes() ?>><?php echo $detailed_action_preview->ActualEndDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->Ward->Visible) { // Ward ?>
		<!-- Ward -->
		<td<?php echo $detailed_action_preview->Ward->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->Ward->viewAttributes() ?>><?php echo $detailed_action_preview->Ward->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->ExpectedResult->Visible) { // ExpectedResult ?>
		<!-- ExpectedResult -->
		<td<?php echo $detailed_action_preview->ExpectedResult->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->ExpectedResult->viewAttributes() ?>><?php echo $detailed_action_preview->ExpectedResult->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->Comments->Visible) { // Comments ?>
		<!-- Comments -->
		<td<?php echo $detailed_action_preview->Comments->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->Comments->viewAttributes() ?>><?php echo $detailed_action_preview->Comments->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailed_action_preview->ProgressStatus->Visible) { // ProgressStatus ?>
		<!-- ProgressStatus -->
		<td<?php echo $detailed_action_preview->ProgressStatus->cellAttributes() ?>>
<span<?php echo $detailed_action_preview->ProgressStatus->viewAttributes() ?>><?php echo $detailed_action_preview->ProgressStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailed_action_preview->ListOptions->render("body", "right", $detailed_action_preview->RowCount);
?>
	</tr>
<?php
	$detailed_action_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailed_action_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailed_action_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailed_action_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailed_action_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailed_action_preview->Recordset)
	$detailed_action_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailed_action_preview->terminate();
?>