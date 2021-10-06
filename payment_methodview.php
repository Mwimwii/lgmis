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
$payment_method_view = new payment_method_view();

// Run the page
$payment_method_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_method_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payment_method_view->isExport()) { ?>
<script>
var fpayment_methodview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpayment_methodview = currentForm = new ew.Form("fpayment_methodview", "view");
	loadjs.done("fpayment_methodview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$payment_method_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $payment_method_view->ExportOptions->render("body") ?>
<?php $payment_method_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $payment_method_view->showPageHeader(); ?>
<?php
$payment_method_view->showMessage();
?>
<?php if (!$payment_method_view->IsModal) { ?>
<?php if (!$payment_method_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payment_method_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpayment_methodview" id="fpayment_methodview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment_method">
<input type="hidden" name="modal" value="<?php echo (int)$payment_method_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($payment_method_view->PaymentMethod->Visible) { // PaymentMethod ?>
	<tr id="r_PaymentMethod">
		<td class="<?php echo $payment_method_view->TableLeftColumnClass ?>"><span id="elh_payment_method_PaymentMethod"><?php echo $payment_method_view->PaymentMethod->caption() ?></span></td>
		<td data-name="PaymentMethod" <?php echo $payment_method_view->PaymentMethod->cellAttributes() ?>>
<span id="el_payment_method_PaymentMethod">
<span<?php echo $payment_method_view->PaymentMethod->viewAttributes() ?>><?php echo $payment_method_view->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payment_method_view->PaymentDesc->Visible) { // PaymentDesc ?>
	<tr id="r_PaymentDesc">
		<td class="<?php echo $payment_method_view->TableLeftColumnClass ?>"><span id="elh_payment_method_PaymentDesc"><?php echo $payment_method_view->PaymentDesc->caption() ?></span></td>
		<td data-name="PaymentDesc" <?php echo $payment_method_view->PaymentDesc->cellAttributes() ?>>
<span id="el_payment_method_PaymentDesc">
<span<?php echo $payment_method_view->PaymentDesc->viewAttributes() ?>><?php echo $payment_method_view->PaymentDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$payment_method_view->IsModal) { ?>
<?php if (!$payment_method_view->isExport()) { ?>
<?php echo $payment_method_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$payment_method_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payment_method_view->isExport()) { ?>
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
$payment_method_view->terminate();
?>