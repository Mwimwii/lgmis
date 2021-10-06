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
$currency_view = new currency_view();

// Run the page
$currency_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$currency_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$currency_view->isExport()) { ?>
<script>
var fcurrencyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcurrencyview = currentForm = new ew.Form("fcurrencyview", "view");
	loadjs.done("fcurrencyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$currency_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $currency_view->ExportOptions->render("body") ?>
<?php $currency_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $currency_view->showPageHeader(); ?>
<?php
$currency_view->showMessage();
?>
<?php if (!$currency_view->IsModal) { ?>
<?php if (!$currency_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $currency_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcurrencyview" id="fcurrencyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="currency">
<input type="hidden" name="modal" value="<?php echo (int)$currency_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($currency_view->CurrencyCode->Visible) { // CurrencyCode ?>
	<tr id="r_CurrencyCode">
		<td class="<?php echo $currency_view->TableLeftColumnClass ?>"><span id="elh_currency_CurrencyCode"><?php echo $currency_view->CurrencyCode->caption() ?></span></td>
		<td data-name="CurrencyCode" <?php echo $currency_view->CurrencyCode->cellAttributes() ?>>
<span id="el_currency_CurrencyCode">
<span<?php echo $currency_view->CurrencyCode->viewAttributes() ?>><?php echo $currency_view->CurrencyCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($currency_view->CurrencyName->Visible) { // CurrencyName ?>
	<tr id="r_CurrencyName">
		<td class="<?php echo $currency_view->TableLeftColumnClass ?>"><span id="elh_currency_CurrencyName"><?php echo $currency_view->CurrencyName->caption() ?></span></td>
		<td data-name="CurrencyName" <?php echo $currency_view->CurrencyName->cellAttributes() ?>>
<span id="el_currency_CurrencyName">
<span<?php echo $currency_view->CurrencyName->viewAttributes() ?>><?php echo $currency_view->CurrencyName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$currency_view->IsModal) { ?>
<?php if (!$currency_view->isExport()) { ?>
<?php echo $currency_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$currency_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$currency_view->isExport()) { ?>
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
$currency_view->terminate();
?>