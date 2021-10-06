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
$contract_view = new contract_view();

// Run the page
$contract_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_view->isExport()) { ?>
<script>
var fcontractview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcontractview = currentForm = new ew.Form("fcontractview", "view");
	loadjs.done("fcontractview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contract_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contract_view->ExportOptions->render("body") ?>
<?php $contract_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contract_view->showPageHeader(); ?>
<?php
$contract_view->showMessage();
?>
<?php if (!$contract_view->IsModal) { ?>
<?php if (!$contract_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcontractview" id="fcontractview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract">
<input type="hidden" name="modal" value="<?php echo (int)$contract_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contract_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_LACode"><?php echo $contract_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $contract_view->LACode->cellAttributes() ?>>
<span id="el_contract_LACode">
<span<?php echo $contract_view->LACode->viewAttributes() ?>><?php echo $contract_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_DepartmentCode"><?php echo $contract_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $contract_view->DepartmentCode->cellAttributes() ?>>
<span id="el_contract_DepartmentCode">
<span<?php echo $contract_view->DepartmentCode->viewAttributes() ?>><?php echo $contract_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->SectionCode->Visible) { // SectionCode ?>
	<tr id="r_SectionCode">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_SectionCode"><?php echo $contract_view->SectionCode->caption() ?></span></td>
		<td data-name="SectionCode" <?php echo $contract_view->SectionCode->cellAttributes() ?>>
<span id="el_contract_SectionCode">
<span<?php echo $contract_view->SectionCode->viewAttributes() ?>><?php echo $contract_view->SectionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ProjectCode->Visible) { // ProjectCode ?>
	<tr id="r_ProjectCode">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ProjectCode"><?php echo $contract_view->ProjectCode->caption() ?></span></td>
		<td data-name="ProjectCode" <?php echo $contract_view->ProjectCode->cellAttributes() ?>>
<span id="el_contract_ProjectCode">
<span<?php echo $contract_view->ProjectCode->viewAttributes() ?>><?php echo $contract_view->ProjectCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ContractNo->Visible) { // ContractNo ?>
	<tr id="r_ContractNo">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ContractNo"><?php echo $contract_view->ContractNo->caption() ?></span></td>
		<td data-name="ContractNo" <?php echo $contract_view->ContractNo->cellAttributes() ?>>
<span id="el_contract_ContractNo">
<span<?php echo $contract_view->ContractNo->viewAttributes() ?>><?php echo $contract_view->ContractNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ContractName->Visible) { // ContractName ?>
	<tr id="r_ContractName">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ContractName"><?php echo $contract_view->ContractName->caption() ?></span></td>
		<td data-name="ContractName" <?php echo $contract_view->ContractName->cellAttributes() ?>>
<span id="el_contract_ContractName">
<span<?php echo $contract_view->ContractName->viewAttributes() ?>><?php echo $contract_view->ContractName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ContractType->Visible) { // ContractType ?>
	<tr id="r_ContractType">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ContractType"><?php echo $contract_view->ContractType->caption() ?></span></td>
		<td data-name="ContractType" <?php echo $contract_view->ContractType->cellAttributes() ?>>
<span id="el_contract_ContractType">
<span<?php echo $contract_view->ContractType->viewAttributes() ?>><?php echo $contract_view->ContractType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ContractSum->Visible) { // ContractSum ?>
	<tr id="r_ContractSum">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ContractSum"><?php echo $contract_view->ContractSum->caption() ?></span></td>
		<td data-name="ContractSum" <?php echo $contract_view->ContractSum->cellAttributes() ?>>
<span id="el_contract_ContractSum">
<span<?php echo $contract_view->ContractSum->viewAttributes() ?>><?php echo $contract_view->ContractSum->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->RevisedContractSum->Visible) { // RevisedContractSum ?>
	<tr id="r_RevisedContractSum">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_RevisedContractSum"><?php echo $contract_view->RevisedContractSum->caption() ?></span></td>
		<td data-name="RevisedContractSum" <?php echo $contract_view->RevisedContractSum->cellAttributes() ?>>
<span id="el_contract_RevisedContractSum">
<span<?php echo $contract_view->RevisedContractSum->viewAttributes() ?>><?php echo $contract_view->RevisedContractSum->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ContractorRef->Visible) { // ContractorRef ?>
	<tr id="r_ContractorRef">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ContractorRef"><?php echo $contract_view->ContractorRef->caption() ?></span></td>
		<td data-name="ContractorRef" <?php echo $contract_view->ContractorRef->cellAttributes() ?>>
<span id="el_contract_ContractorRef">
<span<?php echo $contract_view->ContractorRef->viewAttributes() ?>><?php echo $contract_view->ContractorRef->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->SigningDate->Visible) { // SigningDate ?>
	<tr id="r_SigningDate">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_SigningDate"><?php echo $contract_view->SigningDate->caption() ?></span></td>
		<td data-name="SigningDate" <?php echo $contract_view->SigningDate->cellAttributes() ?>>
<span id="el_contract_SigningDate">
<span<?php echo $contract_view->SigningDate->viewAttributes() ?>><?php echo $contract_view->SigningDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<tr id="r_PlannedStartDate">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_PlannedStartDate"><?php echo $contract_view->PlannedStartDate->caption() ?></span></td>
		<td data-name="PlannedStartDate" <?php echo $contract_view->PlannedStartDate->cellAttributes() ?>>
<span id="el_contract_PlannedStartDate">
<span<?php echo $contract_view->PlannedStartDate->viewAttributes() ?>><?php echo $contract_view->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<tr id="r_PlannedEndDate">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_PlannedEndDate"><?php echo $contract_view->PlannedEndDate->caption() ?></span></td>
		<td data-name="PlannedEndDate" <?php echo $contract_view->PlannedEndDate->cellAttributes() ?>>
<span id="el_contract_PlannedEndDate">
<span<?php echo $contract_view->PlannedEndDate->viewAttributes() ?>><?php echo $contract_view->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ActualStartDate->Visible) { // ActualStartDate ?>
	<tr id="r_ActualStartDate">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ActualStartDate"><?php echo $contract_view->ActualStartDate->caption() ?></span></td>
		<td data-name="ActualStartDate" <?php echo $contract_view->ActualStartDate->cellAttributes() ?>>
<span id="el_contract_ActualStartDate">
<span<?php echo $contract_view->ActualStartDate->viewAttributes() ?>><?php echo $contract_view->ActualStartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ActualEndDate->Visible) { // ActualEndDate ?>
	<tr id="r_ActualEndDate">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ActualEndDate"><?php echo $contract_view->ActualEndDate->caption() ?></span></td>
		<td data-name="ActualEndDate" <?php echo $contract_view->ActualEndDate->cellAttributes() ?>>
<span id="el_contract_ActualEndDate">
<span<?php echo $contract_view->ActualEndDate->viewAttributes() ?>><?php echo $contract_view->ActualEndDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->Duration->Visible) { // Duration ?>
	<tr id="r_Duration">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_Duration"><?php echo $contract_view->Duration->caption() ?></span></td>
		<td data-name="Duration" <?php echo $contract_view->Duration->cellAttributes() ?>>
<span id="el_contract_Duration">
<span<?php echo $contract_view->Duration->viewAttributes() ?>><?php echo $contract_view->Duration->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<tr id="r_UnitOfMeasure">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_UnitOfMeasure"><?php echo $contract_view->UnitOfMeasure->caption() ?></span></td>
		<td data-name="UnitOfMeasure" <?php echo $contract_view->UnitOfMeasure->cellAttributes() ?>>
<span id="el_contract_UnitOfMeasure">
<span<?php echo $contract_view->UnitOfMeasure->viewAttributes() ?>><?php echo $contract_view->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
	<tr id="r_AdvancePaymentAmount">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_AdvancePaymentAmount"><?php echo $contract_view->AdvancePaymentAmount->caption() ?></span></td>
		<td data-name="AdvancePaymentAmount" <?php echo $contract_view->AdvancePaymentAmount->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentAmount">
<span<?php echo $contract_view->AdvancePaymentAmount->viewAttributes() ?>><?php echo $contract_view->AdvancePaymentAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
	<tr id="r_AdvancePaymentdate">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_AdvancePaymentdate"><?php echo $contract_view->AdvancePaymentdate->caption() ?></span></td>
		<td data-name="AdvancePaymentdate" <?php echo $contract_view->AdvancePaymentdate->cellAttributes() ?>>
<span id="el_contract_AdvancePaymentdate">
<span<?php echo $contract_view->AdvancePaymentdate->viewAttributes() ?>><?php echo $contract_view->AdvancePaymentdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contract_view->ContractStatus->Visible) { // ContractStatus ?>
	<tr id="r_ContractStatus">
		<td class="<?php echo $contract_view->TableLeftColumnClass ?>"><span id="elh_contract_ContractStatus"><?php echo $contract_view->ContractStatus->caption() ?></span></td>
		<td data-name="ContractStatus" <?php echo $contract_view->ContractStatus->cellAttributes() ?>>
<span id="el_contract_ContractStatus">
<span<?php echo $contract_view->ContractStatus->viewAttributes() ?>><?php echo $contract_view->ContractStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$contract_view->IsModal) { ?>
<?php if (!$contract_view->isExport()) { ?>
<?php echo $contract_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php if ($contract->getCurrentDetailTable() != "") { ?>
<?php
	$contract_view->DetailPages->ValidKeys = explode(",", $contract->getCurrentDetailTable());
	$firstActiveDetailTable = $contract_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="contract_view_details"><!-- tabs -->
	<ul class="<?php echo $contract_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("contract_variation", explode(",", $contract->getCurrentDetailTable())) && $contract_variation->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "contract_variation") {
			$firstActiveDetailTable = "contract_variation";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $contract_view->DetailPages->pageStyle("contract_variation") ?>" href="#tab_contract_variation" data-toggle="tab"><?php echo $Language->tablePhrase("contract_variation", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $contract_view->contract_variation_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("ipc_tracking", explode(",", $contract->getCurrentDetailTable())) && $ipc_tracking->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "ipc_tracking") {
			$firstActiveDetailTable = "ipc_tracking";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $contract_view->DetailPages->pageStyle("ipc_tracking") ?>" href="#tab_ipc_tracking" data-toggle="tab"><?php echo $Language->tablePhrase("ipc_tracking", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $contract_view->ipc_tracking_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("contract_variation", explode(",", $contract->getCurrentDetailTable())) && $contract_variation->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "contract_variation")
			$firstActiveDetailTable = "contract_variation";
?>
		<div class="tab-pane <?php echo $contract_view->DetailPages->pageStyle("contract_variation") ?>" id="tab_contract_variation"><!-- page* -->
<?php include_once "contract_variationgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("ipc_tracking", explode(",", $contract->getCurrentDetailTable())) && $ipc_tracking->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "ipc_tracking")
			$firstActiveDetailTable = "ipc_tracking";
?>
		<div class="tab-pane <?php echo $contract_view->DetailPages->pageStyle("ipc_tracking") ?>" id="tab_ipc_tracking"><!-- page* -->
<?php include_once "ipc_trackinggrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$contract_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$contract_view->terminate();
?>