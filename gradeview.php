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
$grade_view = new grade_view();

// Run the page
$grade_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grade_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$grade_view->isExport()) { ?>
<script>
var fgradeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgradeview = currentForm = new ew.Form("fgradeview", "view");
	loadjs.done("fgradeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$grade_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $grade_view->ExportOptions->render("body") ?>
<?php $grade_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $grade_view->showPageHeader(); ?>
<?php
$grade_view->showMessage();
?>
<?php if (!$grade_view->IsModal) { ?>
<?php if (!$grade_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grade_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fgradeview" id="fgradeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grade">
<input type="hidden" name="modal" value="<?php echo (int)$grade_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($grade_view->Grade->Visible) { // Grade ?>
	<tr id="r_Grade">
		<td class="<?php echo $grade_view->TableLeftColumnClass ?>"><span id="elh_grade_Grade"><?php echo $grade_view->Grade->caption() ?></span></td>
		<td data-name="Grade" <?php echo $grade_view->Grade->cellAttributes() ?>>
<span id="el_grade_Grade">
<span<?php echo $grade_view->Grade->viewAttributes() ?>><?php echo $grade_view->Grade->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($grade_view->GradeDesc->Visible) { // GradeDesc ?>
	<tr id="r_GradeDesc">
		<td class="<?php echo $grade_view->TableLeftColumnClass ?>"><span id="elh_grade_GradeDesc"><?php echo $grade_view->GradeDesc->caption() ?></span></td>
		<td data-name="GradeDesc" <?php echo $grade_view->GradeDesc->cellAttributes() ?>>
<span id="el_grade_GradeDesc">
<span<?php echo $grade_view->GradeDesc->viewAttributes() ?>><?php echo $grade_view->GradeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$grade_view->IsModal) { ?>
<?php if (!$grade_view->isExport()) { ?>
<?php echo $grade_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$grade_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$grade_view->isExport()) { ?>
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
$grade_view->terminate();
?>