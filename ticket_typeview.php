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
$ticket_type_view = new ticket_type_view();

// Run the page
$ticket_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_type_view->isExport()) { ?>
<script>
var fticket_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fticket_typeview = currentForm = new ew.Form("fticket_typeview", "view");
	loadjs.done("fticket_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticket_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ticket_type_view->ExportOptions->render("body") ?>
<?php $ticket_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ticket_type_view->showPageHeader(); ?>
<?php
$ticket_type_view->showMessage();
?>
<?php if (!$ticket_type_view->IsModal) { ?>
<?php if (!$ticket_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fticket_typeview" id="fticket_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_type">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ticket_type_view->TicketType->Visible) { // TicketType ?>
	<tr id="r_TicketType">
		<td class="<?php echo $ticket_type_view->TableLeftColumnClass ?>"><span id="elh_ticket_type_TicketType"><?php echo $ticket_type_view->TicketType->caption() ?></span></td>
		<td data-name="TicketType" <?php echo $ticket_type_view->TicketType->cellAttributes() ?>>
<span id="el_ticket_type_TicketType">
<span<?php echo $ticket_type_view->TicketType->viewAttributes() ?>><?php echo $ticket_type_view->TicketType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_type_view->TicketTypeDesc->Visible) { // TicketTypeDesc ?>
	<tr id="r_TicketTypeDesc">
		<td class="<?php echo $ticket_type_view->TableLeftColumnClass ?>"><span id="elh_ticket_type_TicketTypeDesc"><?php echo $ticket_type_view->TicketTypeDesc->caption() ?></span></td>
		<td data-name="TicketTypeDesc" <?php echo $ticket_type_view->TicketTypeDesc->cellAttributes() ?>>
<span id="el_ticket_type_TicketTypeDesc">
<span<?php echo $ticket_type_view->TicketTypeDesc->viewAttributes() ?>><?php echo $ticket_type_view->TicketTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_type_view->TicketCategory->Visible) { // TicketCategory ?>
	<tr id="r_TicketCategory">
		<td class="<?php echo $ticket_type_view->TableLeftColumnClass ?>"><span id="elh_ticket_type_TicketCategory"><?php echo $ticket_type_view->TicketCategory->caption() ?></span></td>
		<td data-name="TicketCategory" <?php echo $ticket_type_view->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_type_TicketCategory">
<span<?php echo $ticket_type_view->TicketCategory->viewAttributes() ?>><?php echo $ticket_type_view->TicketCategory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ticket_type_view->IsModal) { ?>
<?php if (!$ticket_type_view->isExport()) { ?>
<?php echo $ticket_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ticket_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_type_view->isExport()) { ?>
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
$ticket_type_view->terminate();
?>