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
$ipc_tracking_preview = new ipc_tracking_preview();

// Run the page
$ipc_tracking_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_preview->Page_Render();
?>
<?php $ipc_tracking_preview->showPageHeader(); ?>
<?php if ($ipc_tracking_preview->TotalRecords > 0) { ?>
<div class="card ew-grid ipc_tracking"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$ipc_tracking_preview->renderListOptions();

// Render list options (header, left)
$ipc_tracking_preview->ListOptions->render("header", "left");
?>
<?php if ($ipc_tracking_preview->IPCNo->Visible) { // IPCNo ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->IPCNo) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->IPCNo->headerCellClass() ?>"><?php echo $ipc_tracking_preview->IPCNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->IPCNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->IPCNo->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->IPCNo->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->IPCNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->IPCNo->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractNo->Visible) { // ContractNo ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->ContractNo) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractNo->headerCellClass() ?>"><?php echo $ipc_tracking_preview->ContractNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->ContractNo->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractNo->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->ContractNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractNo->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->ContractAuthorizedByAG) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractAuthorizedByAG->headerCellClass() ?>"><?php echo $ipc_tracking_preview->ContractAuthorizedByAG->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractAuthorizedByAG->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->ContractAuthorizedByAG->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractAuthorizedByAG->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->ContractAuthorizedByAG->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractAuthorizedByAG->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->VATApplied->Visible) { // VATApplied ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->VATApplied) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->VATApplied->headerCellClass() ?>"><?php echo $ipc_tracking_preview->VATApplied->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->VATApplied->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->VATApplied->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->VATApplied->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->VATApplied->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->VATApplied->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->ArithmeticCheckDone) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->ArithmeticCheckDone->headerCellClass() ?>"><?php echo $ipc_tracking_preview->ArithmeticCheckDone->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->ArithmeticCheckDone->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->ArithmeticCheckDone->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->ArithmeticCheckDone->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->ArithmeticCheckDone->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->ArithmeticCheckDone->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->VariationsApproved->Visible) { // VariationsApproved ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->VariationsApproved) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->VariationsApproved->headerCellClass() ?>"><?php echo $ipc_tracking_preview->VariationsApproved->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->VariationsApproved->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->VariationsApproved->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->VariationsApproved->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->VariationsApproved->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->VariationsApproved->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->PerformanceBondValidUntil) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->PerformanceBondValidUntil->headerCellClass() ?>"><?php echo $ipc_tracking_preview->PerformanceBondValidUntil->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->PerformanceBondValidUntil->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->PerformanceBondValidUntil->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->PerformanceBondValidUntil->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->PerformanceBondValidUntil->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->PerformanceBondValidUntil->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->AdvancePaymentBondValidUntil) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->AdvancePaymentBondValidUntil->headerCellClass() ?>"><?php echo $ipc_tracking_preview->AdvancePaymentBondValidUntil->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->AdvancePaymentBondValidUntil->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->AdvancePaymentBondValidUntil->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->AdvancePaymentBondValidUntil->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->AdvancePaymentBondValidUntil->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->AdvancePaymentBondValidUntil->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->RetentionDeductionClause) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->RetentionDeductionClause->headerCellClass() ?>"><?php echo $ipc_tracking_preview->RetentionDeductionClause->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->RetentionDeductionClause->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->RetentionDeductionClause->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->RetentionDeductionClause->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->RetentionDeductionClause->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->RetentionDeductionClause->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->RetentionDeducted->Visible) { // RetentionDeducted ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->RetentionDeducted) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->RetentionDeducted->headerCellClass() ?>"><?php echo $ipc_tracking_preview->RetentionDeducted->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->RetentionDeducted->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->RetentionDeducted->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->RetentionDeducted->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->RetentionDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->RetentionDeducted->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->LiquidatedDamagesDeducted) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->LiquidatedDamagesDeducted->headerCellClass() ?>"><?php echo $ipc_tracking_preview->LiquidatedDamagesDeducted->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->LiquidatedDamagesDeducted->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->LiquidatedDamagesDeducted->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->LiquidatedDamagesDeducted->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->LiquidatedDamagesDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->LiquidatedDamagesDeducted->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->AdvancedPaymentDeducted) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->AdvancedPaymentDeducted->headerCellClass() ?>"><?php echo $ipc_tracking_preview->AdvancedPaymentDeducted->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->AdvancedPaymentDeducted->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->AdvancedPaymentDeducted->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->AdvancedPaymentDeducted->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->AdvancedPaymentDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->AdvancedPaymentDeducted->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->CurrentProgressReportAttached) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->CurrentProgressReportAttached->headerCellClass() ?>"><?php echo $ipc_tracking_preview->CurrentProgressReportAttached->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->CurrentProgressReportAttached->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->CurrentProgressReportAttached->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->CurrentProgressReportAttached->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->CurrentProgressReportAttached->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->CurrentProgressReportAttached->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->DateOfSiteInspection) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->DateOfSiteInspection->headerCellClass() ?>"><?php echo $ipc_tracking_preview->DateOfSiteInspection->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->DateOfSiteInspection->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->DateOfSiteInspection->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->DateOfSiteInspection->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->DateOfSiteInspection->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->DateOfSiteInspection->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->TimeExtensionAuthorized) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->TimeExtensionAuthorized->headerCellClass() ?>"><?php echo $ipc_tracking_preview->TimeExtensionAuthorized->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->TimeExtensionAuthorized->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->TimeExtensionAuthorized->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->TimeExtensionAuthorized->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->TimeExtensionAuthorized->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->TimeExtensionAuthorized->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->LabResultsChecked->Visible) { // LabResultsChecked ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->LabResultsChecked) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->LabResultsChecked->headerCellClass() ?>"><?php echo $ipc_tracking_preview->LabResultsChecked->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->LabResultsChecked->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->LabResultsChecked->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->LabResultsChecked->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->LabResultsChecked->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->LabResultsChecked->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->TerminationNoticeGiven) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->TerminationNoticeGiven->headerCellClass() ?>"><?php echo $ipc_tracking_preview->TerminationNoticeGiven->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->TerminationNoticeGiven->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->TerminationNoticeGiven->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->TerminationNoticeGiven->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->TerminationNoticeGiven->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->TerminationNoticeGiven->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->CopiesEmailedToMLG) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->CopiesEmailedToMLG->headerCellClass() ?>"><?php echo $ipc_tracking_preview->CopiesEmailedToMLG->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->CopiesEmailedToMLG->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->CopiesEmailedToMLG->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->CopiesEmailedToMLG->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->CopiesEmailedToMLG->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->CopiesEmailedToMLG->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractStillValid->Visible) { // ContractStillValid ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->ContractStillValid) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractStillValid->headerCellClass() ?>"><?php echo $ipc_tracking_preview->ContractStillValid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractStillValid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->ContractStillValid->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractStillValid->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->ContractStillValid->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractStillValid->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->DeskOfficer->Visible) { // DeskOfficer ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->DeskOfficer) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->DeskOfficer->headerCellClass() ?>"><?php echo $ipc_tracking_preview->DeskOfficer->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->DeskOfficer->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->DeskOfficer->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->DeskOfficer->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->DeskOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->DeskOfficer->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->DeskOfficerDate) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->DeskOfficerDate->headerCellClass() ?>"><?php echo $ipc_tracking_preview->DeskOfficerDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->DeskOfficerDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->DeskOfficerDate->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->DeskOfficerDate->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->DeskOfficerDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->DeskOfficerDate->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->SupervisingEngineer) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->SupervisingEngineer->headerCellClass() ?>"><?php echo $ipc_tracking_preview->SupervisingEngineer->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->SupervisingEngineer->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->SupervisingEngineer->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->SupervisingEngineer->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->SupervisingEngineer->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->SupervisingEngineer->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->EngineerDate->Visible) { // EngineerDate ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->EngineerDate) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->EngineerDate->headerCellClass() ?>"><?php echo $ipc_tracking_preview->EngineerDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->EngineerDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->EngineerDate->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->EngineerDate->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->EngineerDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->EngineerDate->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->CouncilSecretary->Visible) { // CouncilSecretary ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->CouncilSecretary) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->CouncilSecretary->headerCellClass() ?>"><?php echo $ipc_tracking_preview->CouncilSecretary->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->CouncilSecretary->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->CouncilSecretary->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->CouncilSecretary->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->CouncilSecretary->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->CouncilSecretary->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->CSDate->Visible) { // CSDate ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->CSDate) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->CSDate->headerCellClass() ?>"><?php echo $ipc_tracking_preview->CSDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->CSDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->CSDate->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->CSDate->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->CSDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->CSDate->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractType->Visible) { // ContractType ?>
	<?php if ($ipc_tracking->SortUrl($ipc_tracking_preview->ContractType) == "") { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractType->headerCellClass() ?>"><?php echo $ipc_tracking_preview->ContractType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $ipc_tracking_preview->ContractType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($ipc_tracking_preview->ContractType->Name) ?>" data-sort-order="<?php echo $ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractType->Name && $ipc_tracking_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_preview->ContractType->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_preview->SortField == $ipc_tracking_preview->ContractType->Name) { ?><?php if ($ipc_tracking_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ipc_tracking_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$ipc_tracking_preview->RecCount = 0;
$ipc_tracking_preview->RowCount = 0;
while ($ipc_tracking_preview->Recordset && !$ipc_tracking_preview->Recordset->EOF) {

	// Init row class and style
	$ipc_tracking_preview->RecCount++;
	$ipc_tracking_preview->RowCount++;
	$ipc_tracking_preview->CssStyle = "";
	$ipc_tracking_preview->loadListRowValues($ipc_tracking_preview->Recordset);

	// Render row
	$ipc_tracking->RowType = ROWTYPE_PREVIEW; // Preview record
	$ipc_tracking_preview->resetAttributes();
	$ipc_tracking_preview->renderListRow();

	// Render list options
	$ipc_tracking_preview->renderListOptions();
?>
	<tr <?php echo $ipc_tracking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ipc_tracking_preview->ListOptions->render("body", "left", $ipc_tracking_preview->RowCount);
?>
<?php if ($ipc_tracking_preview->IPCNo->Visible) { // IPCNo ?>
		<!-- IPCNo -->
		<td<?php echo $ipc_tracking_preview->IPCNo->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->IPCNo->viewAttributes() ?>><?php echo $ipc_tracking_preview->IPCNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractNo->Visible) { // ContractNo ?>
		<!-- ContractNo -->
		<td<?php echo $ipc_tracking_preview->ContractNo->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->ContractNo->viewAttributes() ?>><?php echo $ipc_tracking_preview->ContractNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
		<!-- ContractAuthorizedByAG -->
		<td<?php echo $ipc_tracking_preview->ContractAuthorizedByAG->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->ContractAuthorizedByAG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractAuthorizedByAG" class="custom-control-input" value="<?php echo $ipc_tracking_preview->ContractAuthorizedByAG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->ContractAuthorizedByAG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractAuthorizedByAG"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->VATApplied->Visible) { // VATApplied ?>
		<!-- VATApplied -->
		<td<?php echo $ipc_tracking_preview->VATApplied->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->VATApplied->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VATApplied" class="custom-control-input" value="<?php echo $ipc_tracking_preview->VATApplied->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->VATApplied->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VATApplied"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
		<!-- ArithmeticCheckDone -->
		<td<?php echo $ipc_tracking_preview->ArithmeticCheckDone->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->ArithmeticCheckDone->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ArithmeticCheckDone" class="custom-control-input" value="<?php echo $ipc_tracking_preview->ArithmeticCheckDone->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->ArithmeticCheckDone->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ArithmeticCheckDone"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->VariationsApproved->Visible) { // VariationsApproved ?>
		<!-- VariationsApproved -->
		<td<?php echo $ipc_tracking_preview->VariationsApproved->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->VariationsApproved->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VariationsApproved" class="custom-control-input" value="<?php echo $ipc_tracking_preview->VariationsApproved->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->VariationsApproved->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VariationsApproved"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
		<!-- PerformanceBondValidUntil -->
		<td<?php echo $ipc_tracking_preview->PerformanceBondValidUntil->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->PerformanceBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_preview->PerformanceBondValidUntil->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
		<!-- AdvancePaymentBondValidUntil -->
		<td<?php echo $ipc_tracking_preview->AdvancePaymentBondValidUntil->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->AdvancePaymentBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_preview->AdvancePaymentBondValidUntil->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
		<!-- RetentionDeductionClause -->
		<td<?php echo $ipc_tracking_preview->RetentionDeductionClause->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->RetentionDeductionClause->viewAttributes() ?>><?php echo $ipc_tracking_preview->RetentionDeductionClause->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->RetentionDeducted->Visible) { // RetentionDeducted ?>
		<!-- RetentionDeducted -->
		<td<?php echo $ipc_tracking_preview->RetentionDeducted->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->RetentionDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_RetentionDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_preview->RetentionDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->RetentionDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_RetentionDeducted"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
		<!-- LiquidatedDamagesDeducted -->
		<td<?php echo $ipc_tracking_preview->LiquidatedDamagesDeducted->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->LiquidatedDamagesDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LiquidatedDamagesDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_preview->LiquidatedDamagesDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->LiquidatedDamagesDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LiquidatedDamagesDeducted"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
		<!-- AdvancedPaymentDeducted -->
		<td<?php echo $ipc_tracking_preview->AdvancedPaymentDeducted->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->AdvancedPaymentDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdvancedPaymentDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_preview->AdvancedPaymentDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->AdvancedPaymentDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdvancedPaymentDeducted"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
		<!-- CurrentProgressReportAttached -->
		<td<?php echo $ipc_tracking_preview->CurrentProgressReportAttached->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->CurrentProgressReportAttached->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CurrentProgressReportAttached" class="custom-control-input" value="<?php echo $ipc_tracking_preview->CurrentProgressReportAttached->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->CurrentProgressReportAttached->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CurrentProgressReportAttached"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
		<!-- DateOfSiteInspection -->
		<td<?php echo $ipc_tracking_preview->DateOfSiteInspection->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->DateOfSiteInspection->viewAttributes() ?>><?php echo $ipc_tracking_preview->DateOfSiteInspection->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
		<!-- TimeExtensionAuthorized -->
		<td<?php echo $ipc_tracking_preview->TimeExtensionAuthorized->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->TimeExtensionAuthorized->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TimeExtensionAuthorized" class="custom-control-input" value="<?php echo $ipc_tracking_preview->TimeExtensionAuthorized->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->TimeExtensionAuthorized->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TimeExtensionAuthorized"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->LabResultsChecked->Visible) { // LabResultsChecked ?>
		<!-- LabResultsChecked -->
		<td<?php echo $ipc_tracking_preview->LabResultsChecked->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->LabResultsChecked->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LabResultsChecked" class="custom-control-input" value="<?php echo $ipc_tracking_preview->LabResultsChecked->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->LabResultsChecked->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LabResultsChecked"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
		<!-- TerminationNoticeGiven -->
		<td<?php echo $ipc_tracking_preview->TerminationNoticeGiven->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->TerminationNoticeGiven->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TerminationNoticeGiven" class="custom-control-input" value="<?php echo $ipc_tracking_preview->TerminationNoticeGiven->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->TerminationNoticeGiven->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TerminationNoticeGiven"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
		<!-- CopiesEmailedToMLG -->
		<td<?php echo $ipc_tracking_preview->CopiesEmailedToMLG->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->CopiesEmailedToMLG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CopiesEmailedToMLG" class="custom-control-input" value="<?php echo $ipc_tracking_preview->CopiesEmailedToMLG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->CopiesEmailedToMLG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CopiesEmailedToMLG"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractStillValid->Visible) { // ContractStillValid ?>
		<!-- ContractStillValid -->
		<td<?php echo $ipc_tracking_preview->ContractStillValid->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->ContractStillValid->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractStillValid" class="custom-control-input" value="<?php echo $ipc_tracking_preview->ContractStillValid->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_preview->ContractStillValid->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractStillValid"></label></div></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->DeskOfficer->Visible) { // DeskOfficer ?>
		<!-- DeskOfficer -->
		<td<?php echo $ipc_tracking_preview->DeskOfficer->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->DeskOfficer->viewAttributes() ?>><?php echo $ipc_tracking_preview->DeskOfficer->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
		<!-- DeskOfficerDate -->
		<td<?php echo $ipc_tracking_preview->DeskOfficerDate->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->DeskOfficerDate->viewAttributes() ?>><?php echo $ipc_tracking_preview->DeskOfficerDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
		<!-- SupervisingEngineer -->
		<td<?php echo $ipc_tracking_preview->SupervisingEngineer->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->SupervisingEngineer->viewAttributes() ?>><?php echo $ipc_tracking_preview->SupervisingEngineer->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->EngineerDate->Visible) { // EngineerDate ?>
		<!-- EngineerDate -->
		<td<?php echo $ipc_tracking_preview->EngineerDate->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->EngineerDate->viewAttributes() ?>><?php echo $ipc_tracking_preview->EngineerDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->CouncilSecretary->Visible) { // CouncilSecretary ?>
		<!-- CouncilSecretary -->
		<td<?php echo $ipc_tracking_preview->CouncilSecretary->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->CouncilSecretary->viewAttributes() ?>><?php echo $ipc_tracking_preview->CouncilSecretary->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->CSDate->Visible) { // CSDate ?>
		<!-- CSDate -->
		<td<?php echo $ipc_tracking_preview->CSDate->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->CSDate->viewAttributes() ?>><?php echo $ipc_tracking_preview->CSDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($ipc_tracking_preview->ContractType->Visible) { // ContractType ?>
		<!-- ContractType -->
		<td<?php echo $ipc_tracking_preview->ContractType->cellAttributes() ?>>
<span<?php echo $ipc_tracking_preview->ContractType->viewAttributes() ?>><?php echo $ipc_tracking_preview->ContractType->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$ipc_tracking_preview->ListOptions->render("body", "right", $ipc_tracking_preview->RowCount);
?>
	</tr>
<?php
	$ipc_tracking_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $ipc_tracking_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($ipc_tracking_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($ipc_tracking_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$ipc_tracking_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($ipc_tracking_preview->Recordset)
	$ipc_tracking_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$ipc_tracking_preview->terminate();
?>