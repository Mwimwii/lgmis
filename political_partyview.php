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
$political_party_view = new political_party_view();

// Run the page
$political_party_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$political_party_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$political_party_view->isExport()) { ?>
<script>
var fpolitical_partyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpolitical_partyview = currentForm = new ew.Form("fpolitical_partyview", "view");
	loadjs.done("fpolitical_partyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$political_party_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $political_party_view->ExportOptions->render("body") ?>
<?php $political_party_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $political_party_view->showPageHeader(); ?>
<?php
$political_party_view->showMessage();
?>
<?php if (!$political_party_view->IsModal) { ?>
<?php if (!$political_party_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $political_party_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpolitical_partyview" id="fpolitical_partyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="political_party">
<input type="hidden" name="modal" value="<?php echo (int)$political_party_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($political_party_view->PoliticalParty->Visible) { // PoliticalParty ?>
	<tr id="r_PoliticalParty">
		<td class="<?php echo $political_party_view->TableLeftColumnClass ?>"><span id="elh_political_party_PoliticalParty"><?php echo $political_party_view->PoliticalParty->caption() ?></span></td>
		<td data-name="PoliticalParty" <?php echo $political_party_view->PoliticalParty->cellAttributes() ?>>
<span id="el_political_party_PoliticalParty">
<span<?php echo $political_party_view->PoliticalParty->viewAttributes() ?>><?php echo $political_party_view->PoliticalParty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($political_party_view->Remarks->Visible) { // Remarks ?>
	<tr id="r_Remarks">
		<td class="<?php echo $political_party_view->TableLeftColumnClass ?>"><span id="elh_political_party_Remarks"><?php echo $political_party_view->Remarks->caption() ?></span></td>
		<td data-name="Remarks" <?php echo $political_party_view->Remarks->cellAttributes() ?>>
<span id="el_political_party_Remarks">
<span<?php echo $political_party_view->Remarks->viewAttributes() ?>><?php echo $political_party_view->Remarks->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$political_party_view->IsModal) { ?>
<?php if (!$political_party_view->isExport()) { ?>
<?php echo $political_party_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$political_party_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$political_party_view->isExport()) { ?>
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
$political_party_view->terminate();
?>