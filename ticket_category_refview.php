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
$ticket_category_ref_view = new ticket_category_ref_view();

// Run the page
$ticket_category_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_category_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_category_ref_view->isExport()) { ?>
<script>
var fticket_category_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fticket_category_refview = currentForm = new ew.Form("fticket_category_refview", "view");
	loadjs.done("fticket_category_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ticket_category_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ticket_category_ref_view->ExportOptions->render("body") ?>
<?php $ticket_category_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ticket_category_ref_view->showPageHeader(); ?>
<?php
$ticket_category_ref_view->showMessage();
?>
<?php if (!$ticket_category_ref_view->IsModal) { ?>
<?php if (!$ticket_category_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_category_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fticket_category_refview" id="fticket_category_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_category_ref">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_category_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ticket_category_ref_view->TicketCategory->Visible) { // TicketCategory ?>
	<tr id="r_TicketCategory">
		<td class="<?php echo $ticket_category_ref_view->TableLeftColumnClass ?>"><span id="elh_ticket_category_ref_TicketCategory"><?php echo $ticket_category_ref_view->TicketCategory->caption() ?></span></td>
		<td data-name="TicketCategory" <?php echo $ticket_category_ref_view->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_category_ref_TicketCategory">
<span<?php echo $ticket_category_ref_view->TicketCategory->viewAttributes() ?>><?php echo $ticket_category_ref_view->TicketCategory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ticket_category_ref_view->TicketCategoryName->Visible) { // TicketCategoryName ?>
	<tr id="r_TicketCategoryName">
		<td class="<?php echo $ticket_category_ref_view->TableLeftColumnClass ?>"><span id="elh_ticket_category_ref_TicketCategoryName"><?php echo $ticket_category_ref_view->TicketCategoryName->caption() ?></span></td>
		<td data-name="TicketCategoryName" <?php echo $ticket_category_ref_view->TicketCategoryName->cellAttributes() ?>>
<span id="el_ticket_category_ref_TicketCategoryName">
<span<?php echo $ticket_category_ref_view->TicketCategoryName->viewAttributes() ?>><?php echo $ticket_category_ref_view->TicketCategoryName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ticket_category_ref_view->IsModal) { ?>
<?php if (!$ticket_category_ref_view->isExport()) { ?>
<?php echo $ticket_category_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ticket_category_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_category_ref_view->isExport()) { ?>
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
$ticket_category_ref_view->terminate();
?>