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
$ticketmessage_delete = new ticketmessage_delete();

// Run the page
$ticketmessage_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticketmessage_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketmessagedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fticketmessagedelete = currentForm = new ew.Form("fticketmessagedelete", "delete");
	loadjs.done("fticketmessagedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticketmessage_delete->showPageHeader(); ?>
<?php
$ticketmessage_delete->showMessage();
?>
<form name="fticketmessagedelete" id="fticketmessagedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticketmessage">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ticketmessage_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ticketmessage_delete->TicketNumber->Visible) { // TicketNumber ?>
		<th class="<?php echo $ticketmessage_delete->TicketNumber->headerCellClass() ?>"><span id="elh_ticketmessage_TicketNumber" class="ticketmessage_TicketNumber"><?php echo $ticketmessage_delete->TicketNumber->caption() ?></span></th>
<?php } ?>
<?php if ($ticketmessage_delete->MessageNumber->Visible) { // MessageNumber ?>
		<th class="<?php echo $ticketmessage_delete->MessageNumber->headerCellClass() ?>"><span id="elh_ticketmessage_MessageNumber" class="ticketmessage_MessageNumber"><?php echo $ticketmessage_delete->MessageNumber->caption() ?></span></th>
<?php } ?>
<?php if ($ticketmessage_delete->MessageBy->Visible) { // MessageBy ?>
		<th class="<?php echo $ticketmessage_delete->MessageBy->headerCellClass() ?>"><span id="elh_ticketmessage_MessageBy" class="ticketmessage_MessageBy"><?php echo $ticketmessage_delete->MessageBy->caption() ?></span></th>
<?php } ?>
<?php if ($ticketmessage_delete->Subject->Visible) { // Subject ?>
		<th class="<?php echo $ticketmessage_delete->Subject->headerCellClass() ?>"><span id="elh_ticketmessage_Subject" class="ticketmessage_Subject"><?php echo $ticketmessage_delete->Subject->caption() ?></span></th>
<?php } ?>
<?php if ($ticketmessage_delete->Message->Visible) { // Message ?>
		<th class="<?php echo $ticketmessage_delete->Message->headerCellClass() ?>"><span id="elh_ticketmessage_Message" class="ticketmessage_Message"><?php echo $ticketmessage_delete->Message->caption() ?></span></th>
<?php } ?>
<?php if ($ticketmessage_delete->MessageDate->Visible) { // MessageDate ?>
		<th class="<?php echo $ticketmessage_delete->MessageDate->headerCellClass() ?>"><span id="elh_ticketmessage_MessageDate" class="ticketmessage_MessageDate"><?php echo $ticketmessage_delete->MessageDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ticketmessage_delete->RecordCount = 0;
$i = 0;
while (!$ticketmessage_delete->Recordset->EOF) {
	$ticketmessage_delete->RecordCount++;
	$ticketmessage_delete->RowCount++;

	// Set row properties
	$ticketmessage->resetAttributes();
	$ticketmessage->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ticketmessage_delete->loadRowValues($ticketmessage_delete->Recordset);

	// Render row
	$ticketmessage_delete->renderRow();
?>
	<tr <?php echo $ticketmessage->rowAttributes() ?>>
<?php if ($ticketmessage_delete->TicketNumber->Visible) { // TicketNumber ?>
		<td <?php echo $ticketmessage_delete->TicketNumber->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_delete->RowCount ?>_ticketmessage_TicketNumber" class="ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_delete->TicketNumber->viewAttributes() ?>><?php echo $ticketmessage_delete->TicketNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticketmessage_delete->MessageNumber->Visible) { // MessageNumber ?>
		<td <?php echo $ticketmessage_delete->MessageNumber->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_delete->RowCount ?>_ticketmessage_MessageNumber" class="ticketmessage_MessageNumber">
<span<?php echo $ticketmessage_delete->MessageNumber->viewAttributes() ?>><?php echo $ticketmessage_delete->MessageNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticketmessage_delete->MessageBy->Visible) { // MessageBy ?>
		<td <?php echo $ticketmessage_delete->MessageBy->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_delete->RowCount ?>_ticketmessage_MessageBy" class="ticketmessage_MessageBy">
<span<?php echo $ticketmessage_delete->MessageBy->viewAttributes() ?>><?php echo $ticketmessage_delete->MessageBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticketmessage_delete->Subject->Visible) { // Subject ?>
		<td <?php echo $ticketmessage_delete->Subject->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_delete->RowCount ?>_ticketmessage_Subject" class="ticketmessage_Subject">
<span<?php echo $ticketmessage_delete->Subject->viewAttributes() ?>><?php echo $ticketmessage_delete->Subject->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticketmessage_delete->Message->Visible) { // Message ?>
		<td <?php echo $ticketmessage_delete->Message->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_delete->RowCount ?>_ticketmessage_Message" class="ticketmessage_Message">
<span<?php echo $ticketmessage_delete->Message->viewAttributes() ?>><?php echo $ticketmessage_delete->Message->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticketmessage_delete->MessageDate->Visible) { // MessageDate ?>
		<td <?php echo $ticketmessage_delete->MessageDate->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_delete->RowCount ?>_ticketmessage_MessageDate" class="ticketmessage_MessageDate">
<span<?php echo $ticketmessage_delete->MessageDate->viewAttributes() ?>><?php echo $ticketmessage_delete->MessageDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ticketmessage_delete->Recordset->moveNext();
}
$ticketmessage_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticketmessage_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ticketmessage_delete->showPageFooter();
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
$ticketmessage_delete->terminate();
?>