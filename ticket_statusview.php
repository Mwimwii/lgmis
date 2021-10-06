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
$ticket_status_view = new ticket_status_view();

// Run the page
$ticket_status_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_status_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_status_view->isExport()) { ?>
<script>
var fticket_statusview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fticket_statusview = currentForm = new ew.Form("fticket_statusview", "view");
	loadjs.done("fticket_statusview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticket_status_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ticket_status_view->ExportOptions->render("body") ?>
<?php $ticket_status_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ticket_status_view->showPageHeader(); ?>
<?php
$ticket_status_view->showMessage();
?>
<?php if (!$ticket_status_view->IsModal) { ?>
<?php if (!$ticket_status_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_status_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fticket_statusview" id="fticket_statusview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_status">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_status_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ticket_status_view->StatusCode->Visible) { // StatusCode ?>
	<tr id="r_StatusCode">
		<td class="<?php echo $ticket_status_view->TableLeftColumnClass ?>"><span id="elh_ticket_status_StatusCode"><?php echo $ticket_status_view->StatusCode->caption() ?></span></td>
		<td data-name="StatusCode" <?php echo $ticket_status_view->StatusCode->cellAttributes() ?>>
<span id="el_ticket_status_StatusCode">
<span<?php echo $ticket_status_view->StatusCode->viewAttributes() ?>><?php echo $ticket_status_view->StatusCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_status_view->TicketStatus->Visible) { // TicketStatus ?>
	<tr id="r_TicketStatus">
		<td class="<?php echo $ticket_status_view->TableLeftColumnClass ?>"><span id="elh_ticket_status_TicketStatus"><?php echo $ticket_status_view->TicketStatus->caption() ?></span></td>
		<td data-name="TicketStatus" <?php echo $ticket_status_view->TicketStatus->cellAttributes() ?>>
<span id="el_ticket_status_TicketStatus">
<span<?php echo $ticket_status_view->TicketStatus->viewAttributes() ?>><?php echo $ticket_status_view->TicketStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ticket_status_view->IsModal) { ?>
<?php if (!$ticket_status_view->isExport()) { ?>
<?php echo $ticket_status_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ticket_status_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_status_view->isExport()) { ?>
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
$ticket_status_view->terminate();
?>