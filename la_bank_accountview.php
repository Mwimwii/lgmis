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
$la_bank_account_view = new la_bank_account_view();

// Run the page
$la_bank_account_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$la_bank_account_view->isExport()) { ?>
<script>
var fla_bank_accountview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fla_bank_accountview = currentForm = new ew.Form("fla_bank_accountview", "view");
	loadjs.done("fla_bank_accountview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$la_bank_account_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $la_bank_account_view->ExportOptions->render("body") ?>
<?php $la_bank_account_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $la_bank_account_view->showPageHeader(); ?>
<?php
$la_bank_account_view->showMessage();
?>
<?php if (!$la_bank_account_view->IsModal) { ?>
<?php if (!$la_bank_account_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_bank_account_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fla_bank_accountview" id="fla_bank_accountview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_bank_account">
<input type="hidden" name="modal" value="<?php echo (int)$la_bank_account_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($la_bank_account_view->BankCode->Visible) { // BankCode ?>
	<tr id="r_BankCode">
		<td class="<?php echo $la_bank_account_view->TableLeftColumnClass ?>"><span id="elh_la_bank_account_BankCode"><?php echo $la_bank_account_view->BankCode->caption() ?></span></td>
		<td data-name="BankCode" <?php echo $la_bank_account_view->BankCode->cellAttributes() ?>>
<span id="el_la_bank_account_BankCode">
<span<?php echo $la_bank_account_view->BankCode->viewAttributes() ?>><?php echo $la_bank_account_view->BankCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($la_bank_account_view->BranchCode->Visible) { // BranchCode ?>
	<tr id="r_BranchCode">
		<td class="<?php echo $la_bank_account_view->TableLeftColumnClass ?>"><span id="elh_la_bank_account_BranchCode"><?php echo $la_bank_account_view->BranchCode->caption() ?></span></td>
		<td data-name="BranchCode" <?php echo $la_bank_account_view->BranchCode->cellAttributes() ?>>
<span id="el_la_bank_account_BranchCode">
<span<?php echo $la_bank_account_view->BranchCode->viewAttributes() ?>><?php echo $la_bank_account_view->BranchCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($la_bank_account_view->AccountName->Visible) { // AccountName ?>
	<tr id="r_AccountName">
		<td class="<?php echo $la_bank_account_view->TableLeftColumnClass ?>"><span id="elh_la_bank_account_AccountName"><?php echo $la_bank_account_view->AccountName->caption() ?></span></td>
		<td data-name="AccountName" <?php echo $la_bank_account_view->AccountName->cellAttributes() ?>>
<span id="el_la_bank_account_AccountName">
<span<?php echo $la_bank_account_view->AccountName->viewAttributes() ?>><?php echo $la_bank_account_view->AccountName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($la_bank_account_view->BankAccountNo->Visible) { // BankAccountNo ?>
	<tr id="r_BankAccountNo">
		<td class="<?php echo $la_bank_account_view->TableLeftColumnClass ?>"><span id="elh_la_bank_account_BankAccountNo"><?php echo $la_bank_account_view->BankAccountNo->caption() ?></span></td>
		<td data-name="BankAccountNo" <?php echo $la_bank_account_view->BankAccountNo->cellAttributes() ?>>
<span id="el_la_bank_account_BankAccountNo">
<span<?php echo $la_bank_account_view->BankAccountNo->viewAttributes() ?>><?php echo $la_bank_account_view->BankAccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($la_bank_account_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $la_bank_account_view->TableLeftColumnClass ?>"><span id="elh_la_bank_account_LACode"><?php echo $la_bank_account_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $la_bank_account_view->LACode->cellAttributes() ?>>
<span id="el_la_bank_account_LACode">
<span<?php echo $la_bank_account_view->LACode->viewAttributes() ?>><?php echo $la_bank_account_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$la_bank_account_view->IsModal) { ?>
<?php if (!$la_bank_account_view->isExport()) { ?>
<?php echo $la_bank_account_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$la_bank_account_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$la_bank_account_view->isExport()) { ?>
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
$la_bank_account_view->terminate();
?>