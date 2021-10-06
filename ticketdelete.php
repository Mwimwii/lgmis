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
$ticket_delete = new ticket_delete();

// Run the page
$ticket_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fticketdelete = currentForm = new ew.Form("fticketdelete", "delete");
	loadjs.done("fticketdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_delete->showPageHeader(); ?>
<?php
$ticket_delete->showMessage();
?>
<form name="fticketdelete" id="fticketdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ticket_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ticket_delete->Subject->Visible) { // Subject ?>
		<th class="<?php echo $ticket_delete->Subject->headerCellClass() ?>"><span id="elh_ticket_Subject" class="ticket_Subject"><?php echo $ticket_delete->Subject->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->TicketReportDate->Visible) { // TicketReportDate ?>
		<th class="<?php echo $ticket_delete->TicketReportDate->headerCellClass() ?>"><span id="elh_ticket_TicketReportDate" class="ticket_TicketReportDate"><?php echo $ticket_delete->TicketReportDate->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->IncidentDate->Visible) { // IncidentDate ?>
		<th class="<?php echo $ticket_delete->IncidentDate->headerCellClass() ?>"><span id="elh_ticket_IncidentDate" class="ticket_IncidentDate"><?php echo $ticket_delete->IncidentDate->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->IncidentTime->Visible) { // IncidentTime ?>
		<th class="<?php echo $ticket_delete->IncidentTime->headerCellClass() ?>"><span id="elh_ticket_IncidentTime" class="ticket_IncidentTime"><?php echo $ticket_delete->IncidentTime->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->TicketCategory->Visible) { // TicketCategory ?>
		<th class="<?php echo $ticket_delete->TicketCategory->headerCellClass() ?>"><span id="elh_ticket_TicketCategory" class="ticket_TicketCategory"><?php echo $ticket_delete->TicketCategory->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->TicketType->Visible) { // TicketType ?>
		<th class="<?php echo $ticket_delete->TicketType->headerCellClass() ?>"><span id="elh_ticket_TicketType" class="ticket_TicketType"><?php echo $ticket_delete->TicketType->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->ReportedBy->Visible) { // ReportedBy ?>
		<th class="<?php echo $ticket_delete->ReportedBy->headerCellClass() ?>"><span id="elh_ticket_ReportedBy" class="ticket_ReportedBy"><?php echo $ticket_delete->ReportedBy->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->TicketStatus->Visible) { // TicketStatus ?>
		<th class="<?php echo $ticket_delete->TicketStatus->headerCellClass() ?>"><span id="elh_ticket_TicketStatus" class="ticket_TicketStatus"><?php echo $ticket_delete->TicketStatus->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->TicketNumber->Visible) { // TicketNumber ?>
		<th class="<?php echo $ticket_delete->TicketNumber->headerCellClass() ?>"><span id="elh_ticket_TicketNumber" class="ticket_TicketNumber"><?php echo $ticket_delete->TicketNumber->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->ReporterEmail->Visible) { // ReporterEmail ?>
		<th class="<?php echo $ticket_delete->ReporterEmail->headerCellClass() ?>"><span id="elh_ticket_ReporterEmail" class="ticket_ReporterEmail"><?php echo $ticket_delete->ReporterEmail->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->ReporterMobile->Visible) { // ReporterMobile ?>
		<th class="<?php echo $ticket_delete->ReporterMobile->headerCellClass() ?>"><span id="elh_ticket_ReporterMobile" class="ticket_ReporterMobile"><?php echo $ticket_delete->ReporterMobile->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $ticket_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_ticket_ProvinceCode" class="ticket_ProvinceCode"><?php echo $ticket_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $ticket_delete->LACode->headerCellClass() ?>"><span id="elh_ticket_LACode" class="ticket_LACode"><?php echo $ticket_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<th class="<?php echo $ticket_delete->DepartmentCode->headerCellClass() ?>"><span id="elh_ticket_DepartmentCode" class="ticket_DepartmentCode"><?php echo $ticket_delete->DepartmentCode->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->DeptSection->Visible) { // DeptSection ?>
		<th class="<?php echo $ticket_delete->DeptSection->headerCellClass() ?>"><span id="elh_ticket_DeptSection" class="ticket_DeptSection"><?php echo $ticket_delete->DeptSection->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->TicketLevel->Visible) { // TicketLevel ?>
		<th class="<?php echo $ticket_delete->TicketLevel->headerCellClass() ?>"><span id="elh_ticket_TicketLevel" class="ticket_TicketLevel"><?php echo $ticket_delete->TicketLevel->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->AllocatedTo->Visible) { // AllocatedTo ?>
		<th class="<?php echo $ticket_delete->AllocatedTo->headerCellClass() ?>"><span id="elh_ticket_AllocatedTo" class="ticket_AllocatedTo"><?php echo $ticket_delete->AllocatedTo->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->EscalatedTo->Visible) { // EscalatedTo ?>
		<th class="<?php echo $ticket_delete->EscalatedTo->headerCellClass() ?>"><span id="elh_ticket_EscalatedTo" class="ticket_EscalatedTo"><?php echo $ticket_delete->EscalatedTo->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->TicketSolution->Visible) { // TicketSolution ?>
		<th class="<?php echo $ticket_delete->TicketSolution->headerCellClass() ?>"><span id="elh_ticket_TicketSolution" class="ticket_TicketSolution"><?php echo $ticket_delete->TicketSolution->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->SeverityLevel->Visible) { // SeverityLevel ?>
		<th class="<?php echo $ticket_delete->SeverityLevel->headerCellClass() ?>"><span id="elh_ticket_SeverityLevel" class="ticket_SeverityLevel"><?php echo $ticket_delete->SeverityLevel->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->Days->Visible) { // Days ?>
		<th class="<?php echo $ticket_delete->Days->headerCellClass() ?>"><span id="elh_ticket_Days" class="ticket_Days"><?php echo $ticket_delete->Days->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_delete->DataLastUpdated->Visible) { // DataLastUpdated ?>
		<th class="<?php echo $ticket_delete->DataLastUpdated->headerCellClass() ?>"><span id="elh_ticket_DataLastUpdated" class="ticket_DataLastUpdated"><?php echo $ticket_delete->DataLastUpdated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ticket_delete->RecordCount = 0;
$i = 0;
while (!$ticket_delete->Recordset->EOF) {
	$ticket_delete->RecordCount++;
	$ticket_delete->RowCount++;

	// Set row properties
	$ticket->resetAttributes();
	$ticket->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ticket_delete->loadRowValues($ticket_delete->Recordset);

	// Render row
	$ticket_delete->renderRow();
?>
	<tr <?php echo $ticket->rowAttributes() ?>>
<?php if ($ticket_delete->Subject->Visible) { // Subject ?>
		<td <?php echo $ticket_delete->Subject->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_Subject" class="ticket_Subject">
<span<?php echo $ticket_delete->Subject->viewAttributes() ?>><?php echo $ticket_delete->Subject->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->TicketReportDate->Visible) { // TicketReportDate ?>
		<td <?php echo $ticket_delete->TicketReportDate->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_TicketReportDate" class="ticket_TicketReportDate">
<span<?php echo $ticket_delete->TicketReportDate->viewAttributes() ?>><?php echo $ticket_delete->TicketReportDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->IncidentDate->Visible) { // IncidentDate ?>
		<td <?php echo $ticket_delete->IncidentDate->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_IncidentDate" class="ticket_IncidentDate">
<span<?php echo $ticket_delete->IncidentDate->viewAttributes() ?>><?php echo $ticket_delete->IncidentDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->IncidentTime->Visible) { // IncidentTime ?>
		<td <?php echo $ticket_delete->IncidentTime->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_IncidentTime" class="ticket_IncidentTime">
<span<?php echo $ticket_delete->IncidentTime->viewAttributes() ?>><?php echo $ticket_delete->IncidentTime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->TicketCategory->Visible) { // TicketCategory ?>
		<td <?php echo $ticket_delete->TicketCategory->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_TicketCategory" class="ticket_TicketCategory">
<span<?php echo $ticket_delete->TicketCategory->viewAttributes() ?>><?php echo $ticket_delete->TicketCategory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->TicketType->Visible) { // TicketType ?>
		<td <?php echo $ticket_delete->TicketType->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_TicketType" class="ticket_TicketType">
<span<?php echo $ticket_delete->TicketType->viewAttributes() ?>><?php echo $ticket_delete->TicketType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->ReportedBy->Visible) { // ReportedBy ?>
		<td <?php echo $ticket_delete->ReportedBy->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_ReportedBy" class="ticket_ReportedBy">
<span<?php echo $ticket_delete->ReportedBy->viewAttributes() ?>><?php echo $ticket_delete->ReportedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->TicketStatus->Visible) { // TicketStatus ?>
		<td <?php echo $ticket_delete->TicketStatus->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_TicketStatus" class="ticket_TicketStatus">
<span<?php echo $ticket_delete->TicketStatus->viewAttributes() ?>><?php echo $ticket_delete->TicketStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->TicketNumber->Visible) { // TicketNumber ?>
		<td <?php echo $ticket_delete->TicketNumber->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_TicketNumber" class="ticket_TicketNumber">
<span<?php echo $ticket_delete->TicketNumber->viewAttributes() ?>><?php echo $ticket_delete->TicketNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->ReporterEmail->Visible) { // ReporterEmail ?>
		<td <?php echo $ticket_delete->ReporterEmail->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_ReporterEmail" class="ticket_ReporterEmail">
<span<?php echo $ticket_delete->ReporterEmail->viewAttributes() ?>><?php echo $ticket_delete->ReporterEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->ReporterMobile->Visible) { // ReporterMobile ?>
		<td <?php echo $ticket_delete->ReporterMobile->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_ReporterMobile" class="ticket_ReporterMobile">
<span<?php echo $ticket_delete->ReporterMobile->viewAttributes() ?>><?php echo $ticket_delete->ReporterMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $ticket_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_ProvinceCode" class="ticket_ProvinceCode">
<span<?php echo $ticket_delete->ProvinceCode->viewAttributes() ?>><?php echo $ticket_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $ticket_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_LACode" class="ticket_LACode">
<span<?php echo $ticket_delete->LACode->viewAttributes() ?>><?php echo $ticket_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->DepartmentCode->Visible) { // DepartmentCode ?>
		<td <?php echo $ticket_delete->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_DepartmentCode" class="ticket_DepartmentCode">
<span<?php echo $ticket_delete->DepartmentCode->viewAttributes() ?>><?php echo $ticket_delete->DepartmentCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->DeptSection->Visible) { // DeptSection ?>
		<td <?php echo $ticket_delete->DeptSection->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_DeptSection" class="ticket_DeptSection">
<span<?php echo $ticket_delete->DeptSection->viewAttributes() ?>><?php echo $ticket_delete->DeptSection->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->TicketLevel->Visible) { // TicketLevel ?>
		<td <?php echo $ticket_delete->TicketLevel->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_TicketLevel" class="ticket_TicketLevel">
<span<?php echo $ticket_delete->TicketLevel->viewAttributes() ?>><?php echo $ticket_delete->TicketLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->AllocatedTo->Visible) { // AllocatedTo ?>
		<td <?php echo $ticket_delete->AllocatedTo->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_AllocatedTo" class="ticket_AllocatedTo">
<span<?php echo $ticket_delete->AllocatedTo->viewAttributes() ?>><?php echo $ticket_delete->AllocatedTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->EscalatedTo->Visible) { // EscalatedTo ?>
		<td <?php echo $ticket_delete->EscalatedTo->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_EscalatedTo" class="ticket_EscalatedTo">
<span<?php echo $ticket_delete->EscalatedTo->viewAttributes() ?>><?php echo $ticket_delete->EscalatedTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->TicketSolution->Visible) { // TicketSolution ?>
		<td <?php echo $ticket_delete->TicketSolution->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_TicketSolution" class="ticket_TicketSolution">
<span<?php echo $ticket_delete->TicketSolution->viewAttributes() ?>><?php echo $ticket_delete->TicketSolution->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->SeverityLevel->Visible) { // SeverityLevel ?>
		<td <?php echo $ticket_delete->SeverityLevel->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_SeverityLevel" class="ticket_SeverityLevel">
<span<?php echo $ticket_delete->SeverityLevel->viewAttributes() ?>><?php echo $ticket_delete->SeverityLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->Days->Visible) { // Days ?>
		<td <?php echo $ticket_delete->Days->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_Days" class="ticket_Days">
<span<?php echo $ticket_delete->Days->viewAttributes() ?>><?php echo $ticket_delete->Days->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_delete->DataLastUpdated->Visible) { // DataLastUpdated ?>
		<td <?php echo $ticket_delete->DataLastUpdated->cellAttributes() ?>>
<span id="el<?php echo $ticket_delete->RowCount ?>_ticket_DataLastUpdated" class="ticket_DataLastUpdated">
<span<?php echo $ticket_delete->DataLastUpdated->viewAttributes() ?>><?php echo $ticket_delete->DataLastUpdated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ticket_delete->Recordset->moveNext();
}
$ticket_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ticket_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$ticket_delete->terminate();
?>