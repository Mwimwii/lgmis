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
$ticket_status_delete = new ticket_status_delete();

// Run the page
$ticket_status_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fticket_statusdelete = currentForm = new ew.Form("fticket_statusdelete", "delete");
	loadjs.done("fticket_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_status_delete->showPageHeader(); ?>
<?php
$ticket_status_delete->showMessage();
?>
<form name="fticket_statusdelete" id="fticket_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ticket_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ticket_status_delete->StatusCode->Visible) { // StatusCode ?>
		<th class="<?php echo $ticket_status_delete->StatusCode->headerCellClass() ?>"><span id="elh_ticket_status_StatusCode" class="ticket_status_StatusCode"><?php echo $ticket_status_delete->StatusCode->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_status_delete->TicketStatus->Visible) { // TicketStatus ?>
		<th class="<?php echo $ticket_status_delete->TicketStatus->headerCellClass() ?>"><span id="elh_ticket_status_TicketStatus" class="ticket_status_TicketStatus"><?php echo $ticket_status_delete->TicketStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ticket_status_delete->RecordCount = 0;
$i = 0;
while (!$ticket_status_delete->Recordset->EOF) {
	$ticket_status_delete->RecordCount++;
	$ticket_status_delete->RowCount++;

	// Set row properties
	$ticket_status->resetAttributes();
	$ticket_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ticket_status_delete->loadRowValues($ticket_status_delete->Recordset);

	// Render row
	$ticket_status_delete->renderRow();
?>
	<tr <?php echo $ticket_status->rowAttributes() ?>>
<?php if ($ticket_status_delete->StatusCode->Visible) { // StatusCode ?>
		<td <?php echo $ticket_status_delete->StatusCode->cellAttributes() ?>>
<span id="el<?php echo $ticket_status_delete->RowCount ?>_ticket_status_StatusCode" class="ticket_status_StatusCode">
<span<?php echo $ticket_status_delete->StatusCode->viewAttributes() ?>><?php echo $ticket_status_delete->StatusCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_status_delete->TicketStatus->Visible) { // TicketStatus ?>
		<td <?php echo $ticket_status_delete->TicketStatus->cellAttributes() ?>>
<span id="el<?php echo $ticket_status_delete->RowCount ?>_ticket_status_TicketStatus" class="ticket_status_TicketStatus">
<span<?php echo $ticket_status_delete->TicketStatus->viewAttributes() ?>><?php echo $ticket_status_delete->TicketStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ticket_status_delete->Recordset->moveNext();
}
$ticket_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ticket_status_delete->showPageFooter();
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
$ticket_status_delete->terminate();
?>