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
$ticket_view = new ticket_view();

// Run the page
$ticket_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_view->isExport()) { ?>
<script>
var fticketview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fticketview = currentForm = new ew.Form("fticketview", "view");
	loadjs.done("fticketview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticket_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ticket_view->ExportOptions->render("body") ?>
<?php $ticket_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ticket_view->showPageHeader(); ?>
<?php
$ticket_view->showMessage();
?>
<?php if (!$ticket_view->IsModal) { ?>
<?php if (!$ticket_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fticketview" id="fticketview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ticket_view->Subject->Visible) { // Subject ?>
	<tr id="r_Subject">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_Subject"><?php echo $ticket_view->Subject->caption() ?></span></td>
		<td data-name="Subject" <?php echo $ticket_view->Subject->cellAttributes() ?>>
<span id="el_ticket_Subject">
<span<?php echo $ticket_view->Subject->viewAttributes() ?>><?php echo $ticket_view->Subject->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketReportDate->Visible) { // TicketReportDate ?>
	<tr id="r_TicketReportDate">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketReportDate"><?php echo $ticket_view->TicketReportDate->caption() ?></span></td>
		<td data-name="TicketReportDate" <?php echo $ticket_view->TicketReportDate->cellAttributes() ?>>
<span id="el_ticket_TicketReportDate">
<span<?php echo $ticket_view->TicketReportDate->viewAttributes() ?>><?php echo $ticket_view->TicketReportDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->IncidentDate->Visible) { // IncidentDate ?>
	<tr id="r_IncidentDate">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_IncidentDate"><?php echo $ticket_view->IncidentDate->caption() ?></span></td>
		<td data-name="IncidentDate" <?php echo $ticket_view->IncidentDate->cellAttributes() ?>>
<span id="el_ticket_IncidentDate">
<span<?php echo $ticket_view->IncidentDate->viewAttributes() ?>><?php echo $ticket_view->IncidentDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->IncidentTime->Visible) { // IncidentTime ?>
	<tr id="r_IncidentTime">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_IncidentTime"><?php echo $ticket_view->IncidentTime->caption() ?></span></td>
		<td data-name="IncidentTime" <?php echo $ticket_view->IncidentTime->cellAttributes() ?>>
<span id="el_ticket_IncidentTime">
<span<?php echo $ticket_view->IncidentTime->viewAttributes() ?>><?php echo $ticket_view->IncidentTime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketDescription->Visible) { // TicketDescription ?>
	<tr id="r_TicketDescription">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketDescription"><?php echo $ticket_view->TicketDescription->caption() ?></span></td>
		<td data-name="TicketDescription" <?php echo $ticket_view->TicketDescription->cellAttributes() ?>>
<span id="el_ticket_TicketDescription">
<span<?php echo $ticket_view->TicketDescription->viewAttributes() ?>><?php echo $ticket_view->TicketDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketCategory->Visible) { // TicketCategory ?>
	<tr id="r_TicketCategory">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketCategory"><?php echo $ticket_view->TicketCategory->caption() ?></span></td>
		<td data-name="TicketCategory" <?php echo $ticket_view->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_TicketCategory">
<span<?php echo $ticket_view->TicketCategory->viewAttributes() ?>><?php echo $ticket_view->TicketCategory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketType->Visible) { // TicketType ?>
	<tr id="r_TicketType">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketType"><?php echo $ticket_view->TicketType->caption() ?></span></td>
		<td data-name="TicketType" <?php echo $ticket_view->TicketType->cellAttributes() ?>>
<span id="el_ticket_TicketType">
<span<?php echo $ticket_view->TicketType->viewAttributes() ?>><?php echo $ticket_view->TicketType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->ReportedBy->Visible) { // ReportedBy ?>
	<tr id="r_ReportedBy">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_ReportedBy"><?php echo $ticket_view->ReportedBy->caption() ?></span></td>
		<td data-name="ReportedBy" <?php echo $ticket_view->ReportedBy->cellAttributes() ?>>
<span id="el_ticket_ReportedBy">
<span<?php echo $ticket_view->ReportedBy->viewAttributes() ?>><?php echo $ticket_view->ReportedBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketStatus->Visible) { // TicketStatus ?>
	<tr id="r_TicketStatus">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketStatus"><?php echo $ticket_view->TicketStatus->caption() ?></span></td>
		<td data-name="TicketStatus" <?php echo $ticket_view->TicketStatus->cellAttributes() ?>>
<span id="el_ticket_TicketStatus">
<span<?php echo $ticket_view->TicketStatus->viewAttributes() ?>><?php echo $ticket_view->TicketStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketNumber->Visible) { // TicketNumber ?>
	<tr id="r_TicketNumber">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketNumber"><?php echo $ticket_view->TicketNumber->caption() ?></span></td>
		<td data-name="TicketNumber" <?php echo $ticket_view->TicketNumber->cellAttributes() ?>>
<span id="el_ticket_TicketNumber">
<span<?php echo $ticket_view->TicketNumber->viewAttributes() ?>><?php echo $ticket_view->TicketNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->ReporterEmail->Visible) { // ReporterEmail ?>
	<tr id="r_ReporterEmail">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_ReporterEmail"><?php echo $ticket_view->ReporterEmail->caption() ?></span></td>
		<td data-name="ReporterEmail" <?php echo $ticket_view->ReporterEmail->cellAttributes() ?>>
<span id="el_ticket_ReporterEmail">
<span<?php echo $ticket_view->ReporterEmail->viewAttributes() ?>><?php echo $ticket_view->ReporterEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->ReporterMobile->Visible) { // ReporterMobile ?>
	<tr id="r_ReporterMobile">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_ReporterMobile"><?php echo $ticket_view->ReporterMobile->caption() ?></span></td>
		<td data-name="ReporterMobile" <?php echo $ticket_view->ReporterMobile->cellAttributes() ?>>
<span id="el_ticket_ReporterMobile">
<span<?php echo $ticket_view->ReporterMobile->viewAttributes() ?>><?php echo $ticket_view->ReporterMobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_ProvinceCode"><?php echo $ticket_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $ticket_view->ProvinceCode->cellAttributes() ?>>
<span id="el_ticket_ProvinceCode">
<span<?php echo $ticket_view->ProvinceCode->viewAttributes() ?>><?php echo $ticket_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_LACode"><?php echo $ticket_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $ticket_view->LACode->cellAttributes() ?>>
<span id="el_ticket_LACode">
<span<?php echo $ticket_view->LACode->viewAttributes() ?>><?php echo $ticket_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->DepartmentCode->Visible) { // DepartmentCode ?>
	<tr id="r_DepartmentCode">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_DepartmentCode"><?php echo $ticket_view->DepartmentCode->caption() ?></span></td>
		<td data-name="DepartmentCode" <?php echo $ticket_view->DepartmentCode->cellAttributes() ?>>
<span id="el_ticket_DepartmentCode">
<span<?php echo $ticket_view->DepartmentCode->viewAttributes() ?>><?php echo $ticket_view->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->DeptSection->Visible) { // DeptSection ?>
	<tr id="r_DeptSection">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_DeptSection"><?php echo $ticket_view->DeptSection->caption() ?></span></td>
		<td data-name="DeptSection" <?php echo $ticket_view->DeptSection->cellAttributes() ?>>
<span id="el_ticket_DeptSection">
<span<?php echo $ticket_view->DeptSection->viewAttributes() ?>><?php echo $ticket_view->DeptSection->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketLevel->Visible) { // TicketLevel ?>
	<tr id="r_TicketLevel">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketLevel"><?php echo $ticket_view->TicketLevel->caption() ?></span></td>
		<td data-name="TicketLevel" <?php echo $ticket_view->TicketLevel->cellAttributes() ?>>
<span id="el_ticket_TicketLevel">
<span<?php echo $ticket_view->TicketLevel->viewAttributes() ?>><?php echo $ticket_view->TicketLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->AllocatedTo->Visible) { // AllocatedTo ?>
	<tr id="r_AllocatedTo">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_AllocatedTo"><?php echo $ticket_view->AllocatedTo->caption() ?></span></td>
		<td data-name="AllocatedTo" <?php echo $ticket_view->AllocatedTo->cellAttributes() ?>>
<span id="el_ticket_AllocatedTo">
<span<?php echo $ticket_view->AllocatedTo->viewAttributes() ?>><?php echo $ticket_view->AllocatedTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->EscalatedTo->Visible) { // EscalatedTo ?>
	<tr id="r_EscalatedTo">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_EscalatedTo"><?php echo $ticket_view->EscalatedTo->caption() ?></span></td>
		<td data-name="EscalatedTo" <?php echo $ticket_view->EscalatedTo->cellAttributes() ?>>
<span id="el_ticket_EscalatedTo">
<span<?php echo $ticket_view->EscalatedTo->viewAttributes() ?>><?php echo $ticket_view->EscalatedTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->TicketSolution->Visible) { // TicketSolution ?>
	<tr id="r_TicketSolution">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_TicketSolution"><?php echo $ticket_view->TicketSolution->caption() ?></span></td>
		<td data-name="TicketSolution" <?php echo $ticket_view->TicketSolution->cellAttributes() ?>>
<span id="el_ticket_TicketSolution">
<span<?php echo $ticket_view->TicketSolution->viewAttributes() ?>><?php echo $ticket_view->TicketSolution->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->Evidence->Visible) { // Evidence ?>
	<tr id="r_Evidence">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_Evidence"><?php echo $ticket_view->Evidence->caption() ?></span></td>
		<td data-name="Evidence" <?php echo $ticket_view->Evidence->cellAttributes() ?>>
<span id="el_ticket_Evidence">
<span<?php echo $ticket_view->Evidence->viewAttributes() ?>><?php echo GetFileViewTag($ticket_view->Evidence, $ticket_view->Evidence->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->SeverityLevel->Visible) { // SeverityLevel ?>
	<tr id="r_SeverityLevel">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_SeverityLevel"><?php echo $ticket_view->SeverityLevel->caption() ?></span></td>
		<td data-name="SeverityLevel" <?php echo $ticket_view->SeverityLevel->cellAttributes() ?>>
<span id="el_ticket_SeverityLevel">
<span<?php echo $ticket_view->SeverityLevel->viewAttributes() ?>><?php echo $ticket_view->SeverityLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->Days->Visible) { // Days ?>
	<tr id="r_Days">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_Days"><?php echo $ticket_view->Days->caption() ?></span></td>
		<td data-name="Days" <?php echo $ticket_view->Days->cellAttributes() ?>>
<span id="el_ticket_Days">
<span<?php echo $ticket_view->Days->viewAttributes() ?>><?php echo $ticket_view->Days->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_view->DataLastUpdated->Visible) { // DataLastUpdated ?>
	<tr id="r_DataLastUpdated">
		<td class="<?php echo $ticket_view->TableLeftColumnClass ?>"><span id="elh_ticket_DataLastUpdated"><?php echo $ticket_view->DataLastUpdated->caption() ?></span></td>
		<td data-name="DataLastUpdated" <?php echo $ticket_view->DataLastUpdated->cellAttributes() ?>>
<span id="el_ticket_DataLastUpdated">
<span<?php echo $ticket_view->DataLastUpdated->viewAttributes() ?>><?php echo $ticket_view->DataLastUpdated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ticket_view->IsModal) { ?>
<?php if (!$ticket_view->isExport()) { ?>
<?php echo $ticket_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("ticketmessage", explode(",", $ticket->getCurrentDetailTable())) && $ticketmessage->DetailView) {
?>
<?php if ($ticket->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ticketmessage", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ticketmessagegrid.php" ?>
<?php } ?>
</form>
<?php
$ticket_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_view->isExport()) { ?>
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
$ticket_view->terminate();
?>