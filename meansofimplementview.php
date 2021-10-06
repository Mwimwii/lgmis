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
$meansofimplement_view = new meansofimplement_view();

// Run the page
$meansofimplement_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$meansofimplement_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$meansofimplement_view->isExport()) { ?>
<script>
var fmeansofimplementview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmeansofimplementview = currentForm = new ew.Form("fmeansofimplementview", "view");
	loadjs.done("fmeansofimplementview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$meansofimplement_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $meansofimplement_view->ExportOptions->render("body") ?>
<?php $meansofimplement_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $meansofimplement_view->showPageHeader(); ?>
<?php
$meansofimplement_view->showMessage();
?>
<?php if (!$meansofimplement_view->IsModal) { ?>
<?php if (!$meansofimplement_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $meansofimplement_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmeansofimplementview" id="fmeansofimplementview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="meansofimplement">
<input type="hidden" name="modal" value="<?php echo (int)$meansofimplement_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($meansofimplement_view->moimp_code->Visible) { // moimp_code ?>
	<tr id="r_moimp_code">
		<td class="<?php echo $meansofimplement_view->TableLeftColumnClass ?>"><span id="elh_meansofimplement_moimp_code"><?php echo $meansofimplement_view->moimp_code->caption() ?></span></td>
		<td data-name="moimp_code" <?php echo $meansofimplement_view->moimp_code->cellAttributes() ?>>
<span id="el_meansofimplement_moimp_code">
<span<?php echo $meansofimplement_view->moimp_code->viewAttributes() ?>><?php echo $meansofimplement_view->moimp_code->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($meansofimplement_view->moimp_desc->Visible) { // moimp_desc ?>
	<tr id="r_moimp_desc">
		<td class="<?php echo $meansofimplement_view->TableLeftColumnClass ?>"><span id="elh_meansofimplement_moimp_desc"><?php echo $meansofimplement_view->moimp_desc->caption() ?></span></td>
		<td data-name="moimp_desc" <?php echo $meansofimplement_view->moimp_desc->cellAttributes() ?>>
<span id="el_meansofimplement_moimp_desc">
<span<?php echo $meansofimplement_view->moimp_desc->viewAttributes() ?>><?php echo $meansofimplement_view->moimp_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$meansofimplement_view->IsModal) { ?>
<?php if (!$meansofimplement_view->isExport()) { ?>
<?php echo $meansofimplement_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$meansofimplement_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$meansofimplement_view->isExport()) { ?>
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
$meansofimplement_view->terminate();
?>