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
$ticketmessage_view = new ticketmessage_view();

// Run the page
$ticketmessage_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticketmessage_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticketmessage_view->isExport()) { ?>
<script>
var fticketmessageview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fticketmessageview = currentForm = new ew.Form("fticketmessageview", "view");
	loadjs.done("fticketmessageview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticketmessage_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ticketmessage_view->ExportOptions->render("body") ?>
<?php $ticketmessage_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ticketmessage_view->showPageHeader(); ?>
<?php
$ticketmessage_view->showMessage();
?>
<?php if (!$ticketmessage_view->IsModal) { ?>
<?php if (!$ticketmessage_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticketmessage_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fticketmessageview" id="fticketmessageview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticketmessage">
<input type="hidden" name="modal" value="<?php echo (int)$ticketmessage_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ticketmessage_view->TicketNumber->Visible) { // TicketNumber ?>
	<tr id="r_TicketNumber">
		<td class="<?php echo $ticketmessage_view->TableLeftColumnClass ?>"><span id="elh_ticketmessage_TicketNumber"><?php echo $ticketmessage_view->TicketNumber->caption() ?></span></td>
		<td data-name="TicketNumber" <?php echo $ticketmessage_view->TicketNumber->cellAttributes() ?>>
<span id="el_ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_view->TicketNumber->viewAttributes() ?>><?php echo $ticketmessage_view->TicketNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticketmessage_view->MessageNumber->Visible) { // MessageNumber ?>
	<tr id="r_MessageNumber">
		<td class="<?php echo $ticketmessage_view->TableLeftColumnClass ?>"><span id="elh_ticketmessage_MessageNumber"><?php echo $ticketmessage_view->MessageNumber->caption() ?></span></td>
		<td data-name="MessageNumber" <?php echo $ticketmessage_view->MessageNumber->cellAttributes() ?>>
<span id="el_ticketmessage_MessageNumber">
<span<?php echo $ticketmessage_view->MessageNumber->viewAttributes() ?>><?php echo $ticketmessage_view->MessageNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticketmessage_view->MessageBy->Visible) { // MessageBy ?>
	<tr id="r_MessageBy">
		<td class="<?php echo $ticketmessage_view->TableLeftColumnClass ?>"><span id="elh_ticketmessage_MessageBy"><?php echo $ticketmessage_view->MessageBy->caption() ?></span></td>
		<td data-name="MessageBy" <?php echo $ticketmessage_view->MessageBy->cellAttributes() ?>>
<span id="el_ticketmessage_MessageBy">
<span<?php echo $ticketmessage_view->MessageBy->viewAttributes() ?>><?php echo $ticketmessage_view->MessageBy->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticketmessage_view->Subject->Visible) { // Subject ?>
	<tr id="r_Subject">
		<td class="<?php echo $ticketmessage_view->TableLeftColumnClass ?>"><span id="elh_ticketmessage_Subject"><?php echo $ticketmessage_view->Subject->caption() ?></span></td>
		<td data-name="Subject" <?php echo $ticketmessage_view->Subject->cellAttributes() ?>>
<span id="el_ticketmessage_Subject">
<span<?php echo $ticketmessage_view->Subject->viewAttributes() ?>><?php echo $ticketmessage_view->Subject->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticketmessage_view->Message->Visible) { // Message ?>
	<tr id="r_Message">
		<td class="<?php echo $ticketmessage_view->TableLeftColumnClass ?>"><span id="elh_ticketmessage_Message"><?php echo $ticketmessage_view->Message->caption() ?></span></td>
		<td data-name="Message" <?php echo $ticketmessage_view->Message->cellAttributes() ?>>
<span id="el_ticketmessage_Message">
<span<?php echo $ticketmessage_view->Message->viewAttributes() ?>><?php echo $ticketmessage_view->Message->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticketmessage_view->MessageDate->Visible) { // MessageDate ?>
	<tr id="r_MessageDate">
		<td class="<?php echo $ticketmessage_view->TableLeftColumnClass ?>"><span id="elh_ticketmessage_MessageDate"><?php echo $ticketmessage_view->MessageDate->caption() ?></span></td>
		<td data-name="MessageDate" <?php echo $ticketmessage_view->MessageDate->cellAttributes() ?>>
<span id="el_ticketmessage_MessageDate">
<span<?php echo $ticketmessage_view->MessageDate->viewAttributes() ?>><?php echo $ticketmessage_view->MessageDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticketmessage_view->Attachment->Visible) { // Attachment ?>
	<tr id="r_Attachment">
		<td class="<?php echo $ticketmessage_view->TableLeftColumnClass ?>"><span id="elh_ticketmessage_Attachment"><?php echo $ticketmessage_view->Attachment->caption() ?></span></td>
		<td data-name="Attachment" <?php echo $ticketmessage_view->Attachment->cellAttributes() ?>>
<span id="el_ticketmessage_Attachment">
<span<?php echo $ticketmessage_view->Attachment->viewAttributes() ?>><?php echo GetFileViewTag($ticketmessage_view->Attachment, $ticketmessage_view->Attachment->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ticketmessage_view->IsModal) { ?>
<?php if (!$ticketmessage_view->isExport()) { ?>
<?php echo $ticketmessage_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ticketmessage_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticketmessage_view->isExport()) { ?>
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
$ticketmessage_view->terminate();
?>