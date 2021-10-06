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
$core_function_view = new core_function_view();

// Run the page
$core_function_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$core_function_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$core_function_view->isExport()) { ?>
<script>
var fcore_functionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcore_functionview = currentForm = new ew.Form("fcore_functionview", "view");
	loadjs.done("fcore_functionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$core_function_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $core_function_view->ExportOptions->render("body") ?>
<?php $core_function_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $core_function_view->showPageHeader(); ?>
<?php
$core_function_view->showMessage();
?>
<?php if (!$core_function_view->IsModal) { ?>
<?php if (!$core_function_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $core_function_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcore_functionview" id="fcore_functionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="core_function">
<input type="hidden" name="modal" value="<?php echo (int)$core_function_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($core_function_view->functioncode->Visible) { // functioncode ?>
	<tr id="r_functioncode">
		<td class="<?php echo $core_function_view->TableLeftColumnClass ?>"><span id="elh_core_function_functioncode"><?php echo $core_function_view->functioncode->caption() ?></span></td>
		<td data-name="functioncode" <?php echo $core_function_view->functioncode->cellAttributes() ?>>
<span id="el_core_function_functioncode">
<span<?php echo $core_function_view->functioncode->viewAttributes() ?>><?php echo $core_function_view->functioncode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($core_function_view->FunctionName->Visible) { // FunctionName ?>
	<tr id="r_FunctionName">
		<td class="<?php echo $core_function_view->TableLeftColumnClass ?>"><span id="elh_core_function_FunctionName"><?php echo $core_function_view->FunctionName->caption() ?></span></td>
		<td data-name="FunctionName" <?php echo $core_function_view->FunctionName->cellAttributes() ?>>
<span id="el_core_function_FunctionName">
<span<?php echo $core_function_view->FunctionName->viewAttributes() ?>><?php echo $core_function_view->FunctionName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$core_function_view->IsModal) { ?>
<?php if (!$core_function_view->isExport()) { ?>
<?php echo $core_function_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$core_function_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$core_function_view->isExport()) { ?>
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
$core_function_view->terminate();
?>