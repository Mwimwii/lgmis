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
$relationship_view = new relationship_view();

// Run the page
$relationship_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$relationship_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$relationship_view->isExport()) { ?>
<script>
var frelationshipview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frelationshipview = currentForm = new ew.Form("frelationshipview", "view");
	loadjs.done("frelationshipview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$relationship_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $relationship_view->ExportOptions->render("body") ?>
<?php $relationship_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $relationship_view->showPageHeader(); ?>
<?php
$relationship_view->showMessage();
?>
<?php if (!$relationship_view->IsModal) { ?>
<?php if (!$relationship_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $relationship_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="frelationshipview" id="frelationshipview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="relationship">
<input type="hidden" name="modal" value="<?php echo (int)$relationship_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($relationship_view->RelationshipCode->Visible) { // RelationshipCode ?>
	<tr id="r_RelationshipCode">
		<td class="<?php echo $relationship_view->TableLeftColumnClass ?>"><span id="elh_relationship_RelationshipCode"><?php echo $relationship_view->RelationshipCode->caption() ?></span></td>
		<td data-name="RelationshipCode" <?php echo $relationship_view->RelationshipCode->cellAttributes() ?>>
<span id="el_relationship_RelationshipCode">
<span<?php echo $relationship_view->RelationshipCode->viewAttributes() ?>><?php echo $relationship_view->RelationshipCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($relationship_view->Relationship->Visible) { // Relationship ?>
	<tr id="r_Relationship">
		<td class="<?php echo $relationship_view->TableLeftColumnClass ?>"><span id="elh_relationship_Relationship"><?php echo $relationship_view->Relationship->caption() ?></span></td>
		<td data-name="Relationship" <?php echo $relationship_view->Relationship->cellAttributes() ?>>
<span id="el_relationship_Relationship">
<span<?php echo $relationship_view->Relationship->viewAttributes() ?>><?php echo $relationship_view->Relationship->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($relationship_view->Comment->Visible) { // Comment ?>
	<tr id="r_Comment">
		<td class="<?php echo $relationship_view->TableLeftColumnClass ?>"><span id="elh_relationship_Comment"><?php echo $relationship_view->Comment->caption() ?></span></td>
		<td data-name="Comment" <?php echo $relationship_view->Comment->cellAttributes() ?>>
<span id="el_relationship_Comment">
<span<?php echo $relationship_view->Comment->viewAttributes() ?>><?php echo $relationship_view->Comment->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$relationship_view->IsModal) { ?>
<?php if (!$relationship_view->isExport()) { ?>
<?php echo $relationship_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$relationship_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$relationship_view->isExport()) { ?>
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
$relationship_view->terminate();
?>