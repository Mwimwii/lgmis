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
$bank_view = new bank_view();

// Run the page
$bank_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bank_view->isExport()) { ?>
<script>
var fbankview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbankview = currentForm = new ew.Form("fbankview", "view");
	loadjs.done("fbankview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bank_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bank_view->ExportOptions->render("body") ?>
<?php $bank_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bank_view->showPageHeader(); ?>
<?php
$bank_view->showMessage();
?>
<?php if (!$bank_view->IsModal) { ?>
<?php if (!$bank_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bank_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbankview" id="fbankview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank">
<input type="hidden" name="modal" value="<?php echo (int)$bank_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bank_view->BankCode->Visible) { // BankCode ?>
	<tr id="r_BankCode">
		<td class="<?php echo $bank_view->TableLeftColumnClass ?>"><span id="elh_bank_BankCode"><?php echo $bank_view->BankCode->caption() ?></span></td>
		<td data-name="BankCode" <?php echo $bank_view->BankCode->cellAttributes() ?>>
<span id="el_bank_BankCode">
<span<?php echo $bank_view->BankCode->viewAttributes() ?>><?php echo $bank_view->BankCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_view->BankShortName->Visible) { // BankShortName ?>
	<tr id="r_BankShortName">
		<td class="<?php echo $bank_view->TableLeftColumnClass ?>"><span id="elh_bank_BankShortName"><?php echo $bank_view->BankShortName->caption() ?></span></td>
		<td data-name="BankShortName" <?php echo $bank_view->BankShortName->cellAttributes() ?>>
<span id="el_bank_BankShortName">
<span<?php echo $bank_view->BankShortName->viewAttributes() ?>><?php echo $bank_view->BankShortName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bank_view->BankName->Visible) { // BankName ?>
	<tr id="r_BankName">
		<td class="<?php echo $bank_view->TableLeftColumnClass ?>"><span id="elh_bank_BankName"><?php echo $bank_view->BankName->caption() ?></span></td>
		<td data-name="BankName" <?php echo $bank_view->BankName->cellAttributes() ?>>
<span id="el_bank_BankName">
<span<?php echo $bank_view->BankName->viewAttributes() ?>><?php echo $bank_view->BankName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$bank_view->IsModal) { ?>
<?php if (!$bank_view->isExport()) { ?>
<?php echo $bank_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("bank_branch", explode(",", $bank->getCurrentDetailTable())) && $bank_branch->DetailView) {
?>
<?php if ($bank->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("bank_branch", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "bank_branchgrid.php" ?>
<?php } ?>
</form>
<?php
$bank_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bank_view->isExport()) { ?>
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
$bank_view->terminate();
?>