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
$ticket_type_delete = new ticket_type_delete();

// Run the page
$ticket_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fticket_typedelete = currentForm = new ew.Form("fticket_typedelete", "delete");
	loadjs.done("fticket_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_type_delete->showPageHeader(); ?>
<?php
$ticket_type_delete->showMessage();
?>
<form name="fticket_typedelete" id="fticket_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ticket_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ticket_type_delete->TicketType->Visible) { // TicketType ?>
		<th class="<?php echo $ticket_type_delete->TicketType->headerCellClass() ?>"><span id="elh_ticket_type_TicketType" class="ticket_type_TicketType"><?php echo $ticket_type_delete->TicketType->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_type_delete->TicketTypeDesc->Visible) { // TicketTypeDesc ?>
		<th class="<?php echo $ticket_type_delete->TicketTypeDesc->headerCellClass() ?>"><span id="elh_ticket_type_TicketTypeDesc" class="ticket_type_TicketTypeDesc"><?php echo $ticket_type_delete->TicketTypeDesc->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_type_delete->TicketCategory->Visible) { // TicketCategory ?>
		<th class="<?php echo $ticket_type_delete->TicketCategory->headerCellClass() ?>"><span id="elh_ticket_type_TicketCategory" class="ticket_type_TicketCategory"><?php echo $ticket_type_delete->TicketCategory->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ticket_type_delete->RecordCount = 0;
$i = 0;
while (!$ticket_type_delete->Recordset->EOF) {
	$ticket_type_delete->RecordCount++;
	$ticket_type_delete->RowCount++;

	// Set row properties
	$ticket_type->resetAttributes();
	$ticket_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ticket_type_delete->loadRowValues($ticket_type_delete->Recordset);

	// Render row
	$ticket_type_delete->renderRow();
?>
	<tr <?php echo $ticket_type->rowAttributes() ?>>
<?php if ($ticket_type_delete->TicketType->Visible) { // TicketType ?>
		<td <?php echo $ticket_type_delete->TicketType->cellAttributes() ?>>
<span id="el<?php echo $ticket_type_delete->RowCount ?>_ticket_type_TicketType" class="ticket_type_TicketType">
<span<?php echo $ticket_type_delete->TicketType->viewAttributes() ?>><?php echo $ticket_type_delete->TicketType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_type_delete->TicketTypeDesc->Visible) { // TicketTypeDesc ?>
		<td <?php echo $ticket_type_delete->TicketTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $ticket_type_delete->RowCount ?>_ticket_type_TicketTypeDesc" class="ticket_type_TicketTypeDesc">
<span<?php echo $ticket_type_delete->TicketTypeDesc->viewAttributes() ?>><?php echo $ticket_type_delete->TicketTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_type_delete->TicketCategory->Visible) { // TicketCategory ?>
		<td <?php echo $ticket_type_delete->TicketCategory->cellAttributes() ?>>
<span id="el<?php echo $ticket_type_delete->RowCount ?>_ticket_type_TicketCategory" class="ticket_type_TicketCategory">
<span<?php echo $ticket_type_delete->TicketCategory->viewAttributes() ?>><?php echo $ticket_type_delete->TicketCategory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ticket_type_delete->Recordset->moveNext();
}
$ticket_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ticket_type_delete->showPageFooter();
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
$ticket_type_delete->terminate();
?>