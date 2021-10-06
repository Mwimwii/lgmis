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
$occupation_view = new occupation_view();

// Run the page
$occupation_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$occupation_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$occupation_view->isExport()) { ?>
<script>
var foccupationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	foccupationview = currentForm = new ew.Form("foccupationview", "view");
	loadjs.done("foccupationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$occupation_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $occupation_view->ExportOptions->render("body") ?>
<?php $occupation_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $occupation_view->showPageHeader(); ?>
<?php
$occupation_view->showMessage();
?>
<?php if (!$occupation_view->IsModal) { ?>
<?php if (!$occupation_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $occupation_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="foccupationview" id="foccupationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="occupation">
<input type="hidden" name="modal" value="<?php echo (int)$occupation_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($occupation_view->OccupationCode->Visible) { // OccupationCode ?>
	<tr id="r_OccupationCode">
		<td class="<?php echo $occupation_view->TableLeftColumnClass ?>"><span id="elh_occupation_OccupationCode"><?php echo $occupation_view->OccupationCode->caption() ?></span></td>
		<td data-name="OccupationCode" <?php echo $occupation_view->OccupationCode->cellAttributes() ?>>
<span id="el_occupation_OccupationCode">
<span<?php echo $occupation_view->OccupationCode->viewAttributes() ?>><?php echo $occupation_view->OccupationCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($occupation_view->OccupationName->Visible) { // OccupationName ?>
	<tr id="r_OccupationName">
		<td class="<?php echo $occupation_view->TableLeftColumnClass ?>"><span id="elh_occupation_OccupationName"><?php echo $occupation_view->OccupationName->caption() ?></span></td>
		<td data-name="OccupationName" <?php echo $occupation_view->OccupationName->cellAttributes() ?>>
<span id="el_occupation_OccupationName">
<span<?php echo $occupation_view->OccupationName->viewAttributes() ?>><?php echo $occupation_view->OccupationName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$occupation_view->IsModal) { ?>
<?php if (!$occupation_view->isExport()) { ?>
<?php echo $occupation_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$occupation_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$occupation_view->isExport()) { ?>
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
$occupation_view->terminate();
?>