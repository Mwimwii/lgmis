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
$councillor_type_view = new councillor_type_view();

// Run the page
$councillor_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillor_type_view->isExport()) { ?>
<script>
var fcouncillor_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncillor_typeview = currentForm = new ew.Form("fcouncillor_typeview", "view");
	loadjs.done("fcouncillor_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$councillor_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $councillor_type_view->ExportOptions->render("body") ?>
<?php $councillor_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $councillor_type_view->showPageHeader(); ?>
<?php
$councillor_type_view->showMessage();
?>
<?php if (!$councillor_type_view->IsModal) { ?>
<?php if (!$councillor_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncillor_typeview" id="fcouncillor_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_type">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($councillor_type_view->CouncillorType->Visible) { // CouncillorType ?>
	<tr id="r_CouncillorType">
		<td class="<?php echo $councillor_type_view->TableLeftColumnClass ?>"><span id="elh_councillor_type_CouncillorType"><?php echo $councillor_type_view->CouncillorType->caption() ?></span></td>
		<td data-name="CouncillorType" <?php echo $councillor_type_view->CouncillorType->cellAttributes() ?>>
<span id="el_councillor_type_CouncillorType">
<span<?php echo $councillor_type_view->CouncillorType->viewAttributes() ?>><?php echo $councillor_type_view->CouncillorType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_type_view->CouncillorTYpeName->Visible) { // CouncillorTYpeName ?>
	<tr id="r_CouncillorTYpeName">
		<td class="<?php echo $councillor_type_view->TableLeftColumnClass ?>"><span id="elh_councillor_type_CouncillorTYpeName"><?php echo $councillor_type_view->CouncillorTYpeName->caption() ?></span></td>
		<td data-name="CouncillorTYpeName" <?php echo $councillor_type_view->CouncillorTYpeName->cellAttributes() ?>>
<span id="el_councillor_type_CouncillorTYpeName">
<span<?php echo $councillor_type_view->CouncillorTYpeName->viewAttributes() ?>><?php echo $councillor_type_view->CouncillorTYpeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$councillor_type_view->IsModal) { ?>
<?php if (!$councillor_type_view->isExport()) { ?>
<?php echo $councillor_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$councillor_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillor_type_view->isExport()) { ?>
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
$councillor_type_view->terminate();
?>