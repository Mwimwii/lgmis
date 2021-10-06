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
$disciplinary_action_ref_view = new disciplinary_action_ref_view();

// Run the page
$disciplinary_action_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$disciplinary_action_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$disciplinary_action_ref_view->isExport()) { ?>
<script>
var fdisciplinary_action_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdisciplinary_action_refview = currentForm = new ew.Form("fdisciplinary_action_refview", "view");
	loadjs.done("fdisciplinary_action_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$disciplinary_action_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $disciplinary_action_ref_view->ExportOptions->render("body") ?>
<?php $disciplinary_action_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $disciplinary_action_ref_view->showPageHeader(); ?>
<?php
$disciplinary_action_ref_view->showMessage();
?>
<?php if (!$disciplinary_action_ref_view->IsModal) { ?>
<?php if (!$disciplinary_action_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $disciplinary_action_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdisciplinary_action_refview" id="fdisciplinary_action_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="disciplinary_action_ref">
<input type="hidden" name="modal" value="<?php echo (int)$disciplinary_action_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($disciplinary_action_ref_view->ActionCode->Visible) { // ActionCode ?>
	<tr id="r_ActionCode">
		<td class="<?php echo $disciplinary_action_ref_view->TableLeftColumnClass ?>"><span id="elh_disciplinary_action_ref_ActionCode"><?php echo $disciplinary_action_ref_view->ActionCode->caption() ?></span></td>
		<td data-name="ActionCode" <?php echo $disciplinary_action_ref_view->ActionCode->cellAttributes() ?>>
<span id="el_disciplinary_action_ref_ActionCode">
<span<?php echo $disciplinary_action_ref_view->ActionCode->viewAttributes() ?>><?php echo $disciplinary_action_ref_view->ActionCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($disciplinary_action_ref_view->ActionDesc->Visible) { // ActionDesc ?>
	<tr id="r_ActionDesc">
		<td class="<?php echo $disciplinary_action_ref_view->TableLeftColumnClass ?>"><span id="elh_disciplinary_action_ref_ActionDesc"><?php echo $disciplinary_action_ref_view->ActionDesc->caption() ?></span></td>
		<td data-name="ActionDesc" <?php echo $disciplinary_action_ref_view->ActionDesc->cellAttributes() ?>>
<span id="el_disciplinary_action_ref_ActionDesc">
<span<?php echo $disciplinary_action_ref_view->ActionDesc->viewAttributes() ?>><?php echo $disciplinary_action_ref_view->ActionDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($disciplinary_action_ref_view->Authority->Visible) { // Authority ?>
	<tr id="r_Authority">
		<td class="<?php echo $disciplinary_action_ref_view->TableLeftColumnClass ?>"><span id="elh_disciplinary_action_ref_Authority"><?php echo $disciplinary_action_ref_view->Authority->caption() ?></span></td>
		<td data-name="Authority" <?php echo $disciplinary_action_ref_view->Authority->cellAttributes() ?>>
<span id="el_disciplinary_action_ref_Authority">
<span<?php echo $disciplinary_action_ref_view->Authority->viewAttributes() ?>><?php echo $disciplinary_action_ref_view->Authority->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$disciplinary_action_ref_view->IsModal) { ?>
<?php if (!$disciplinary_action_ref_view->isExport()) { ?>
<?php echo $disciplinary_action_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$disciplinary_action_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$disciplinary_action_ref_view->isExport()) { ?>
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
$disciplinary_action_ref_view->terminate();
?>