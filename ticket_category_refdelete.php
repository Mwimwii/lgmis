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
$ticket_category_ref_delete = new ticket_category_ref_delete();

// Run the page
$ticket_category_ref_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_category_ref_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_category_refdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fticket_category_refdelete = currentForm = new ew.Form("fticket_category_refdelete", "delete");
	loadjs.done("fticket_category_refdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_category_ref_delete->showPageHeader(); ?>
<?php
$ticket_category_ref_delete->showMessage();
?>
<form name="fticket_category_refdelete" id="fticket_category_refdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_category_ref">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ticket_category_ref_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ticket_category_ref_delete->TicketCategory->Visible) { // TicketCategory ?>
		<th class="<?php echo $ticket_category_ref_delete->TicketCategory->headerCellClass() ?>"><span id="elh_ticket_category_ref_TicketCategory" class="ticket_category_ref_TicketCategory"><?php echo $ticket_category_ref_delete->TicketCategory->caption() ?></span></th>
<?php } ?>
<?php if ($ticket_category_ref_delete->TicketCategoryName->Visible) { // TicketCategoryName ?>
		<th class="<?php echo $ticket_category_ref_delete->TicketCategoryName->headerCellClass() ?>"><span id="elh_ticket_category_ref_TicketCategoryName" class="ticket_category_ref_TicketCategoryName"><?php echo $ticket_category_ref_delete->TicketCategoryName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ticket_category_ref_delete->RecordCount = 0;
$i = 0;
while (!$ticket_category_ref_delete->Recordset->EOF) {
	$ticket_category_ref_delete->RecordCount++;
	$ticket_category_ref_delete->RowCount++;

	// Set row properties
	$ticket_category_ref->resetAttributes();
	$ticket_category_ref->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ticket_category_ref_delete->loadRowValues($ticket_category_ref_delete->Recordset);

	// Render row
	$ticket_category_ref_delete->renderRow();
?>
	<tr <?php echo $ticket_category_ref->rowAttributes() ?>>
<?php if ($ticket_category_ref_delete->TicketCategory->Visible) { // TicketCategory ?>
		<td <?php echo $ticket_category_ref_delete->TicketCategory->cellAttributes() ?>>
<span id="el<?php echo $ticket_category_ref_delete->RowCount ?>_ticket_category_ref_TicketCategory" class="ticket_category_ref_TicketCategory">
<span<?php echo $ticket_category_ref_delete->TicketCategory->viewAttributes() ?>><?php echo $ticket_category_ref_delete->TicketCategory->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ticket_category_ref_delete->TicketCategoryName->Visible) { // TicketCategoryName ?>
		<td <?php echo $ticket_category_ref_delete->TicketCategoryName->cellAttributes() ?>>
<span id="el<?php echo $ticket_category_ref_delete->RowCount ?>_ticket_category_ref_TicketCategoryName" class="ticket_category_ref_TicketCategoryName">
<span<?php echo $ticket_category_ref_delete->TicketCategoryName->viewAttributes() ?>><?php echo $ticket_category_ref_delete->TicketCategoryName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ticket_category_ref_delete->Recordset->moveNext();
}
$ticket_category_ref_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_category_ref_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ticket_category_ref_delete->showPageFooter();
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
$ticket_category_ref_delete->terminate();
?>