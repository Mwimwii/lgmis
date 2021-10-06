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
$council_type_view = new council_type_view();

// Run the page
$council_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$council_type_view->isExport()) { ?>
<script>
var fcouncil_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncil_typeview = currentForm = new ew.Form("fcouncil_typeview", "view");
	loadjs.done("fcouncil_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$council_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $council_type_view->ExportOptions->render("body") ?>
<?php $council_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $council_type_view->showPageHeader(); ?>
<?php
$council_type_view->showMessage();
?>
<?php if (!$council_type_view->IsModal) { ?>
<?php if (!$council_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncil_typeview" id="fcouncil_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_type">
<input type="hidden" name="modal" value="<?php echo (int)$council_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($council_type_view->CouncilType->Visible) { // CouncilType ?>
	<tr id="r_CouncilType">
		<td class="<?php echo $council_type_view->TableLeftColumnClass ?>"><span id="elh_council_type_CouncilType"><?php echo $council_type_view->CouncilType->caption() ?></span></td>
		<td data-name="CouncilType" <?php echo $council_type_view->CouncilType->cellAttributes() ?>>
<span id="el_council_type_CouncilType">
<span<?php echo $council_type_view->CouncilType->viewAttributes() ?>><?php echo $council_type_view->CouncilType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_type_view->CouncilTYpeName->Visible) { // CouncilTYpeName ?>
	<tr id="r_CouncilTYpeName">
		<td class="<?php echo $council_type_view->TableLeftColumnClass ?>"><span id="elh_council_type_CouncilTYpeName"><?php echo $council_type_view->CouncilTYpeName->caption() ?></span></td>
		<td data-name="CouncilTYpeName" <?php echo $council_type_view->CouncilTYpeName->cellAttributes() ?>>
<span id="el_council_type_CouncilTYpeName">
<span<?php echo $council_type_view->CouncilTYpeName->viewAttributes() ?>><?php echo $council_type_view->CouncilTYpeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$council_type_view->IsModal) { ?>
<?php if (!$council_type_view->isExport()) { ?>
<?php echo $council_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$council_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$council_type_view->isExport()) { ?>
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
$council_type_view->terminate();
?>