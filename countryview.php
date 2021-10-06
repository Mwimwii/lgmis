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
$country_view = new country_view();

// Run the page
$country_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$country_view->isExport()) { ?>
<script>
var fcountryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcountryview = currentForm = new ew.Form("fcountryview", "view");
	loadjs.done("fcountryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$country_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $country_view->ExportOptions->render("body") ?>
<?php $country_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $country_view->showPageHeader(); ?>
<?php
$country_view->showMessage();
?>
<?php if (!$country_view->IsModal) { ?>
<?php if (!$country_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $country_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcountryview" id="fcountryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<input type="hidden" name="modal" value="<?php echo (int)$country_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($country_view->CountryName->Visible) { // CountryName ?>
	<tr id="r_CountryName">
		<td class="<?php echo $country_view->TableLeftColumnClass ?>"><span id="elh_country_CountryName"><?php echo $country_view->CountryName->caption() ?></span></td>
		<td data-name="CountryName" <?php echo $country_view->CountryName->cellAttributes() ?>>
<span id="el_country_CountryName">
<span<?php echo $country_view->CountryName->viewAttributes() ?>><?php echo $country_view->CountryName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($country_view->CurrencyCode->Visible) { // CurrencyCode ?>
	<tr id="r_CurrencyCode">
		<td class="<?php echo $country_view->TableLeftColumnClass ?>"><span id="elh_country_CurrencyCode"><?php echo $country_view->CurrencyCode->caption() ?></span></td>
		<td data-name="CurrencyCode" <?php echo $country_view->CurrencyCode->cellAttributes() ?>>
<span id="el_country_CurrencyCode">
<span<?php echo $country_view->CurrencyCode->viewAttributes() ?>><?php echo $country_view->CurrencyCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($country_view->ExchangeRate->Visible) { // ExchangeRate ?>
	<tr id="r_ExchangeRate">
		<td class="<?php echo $country_view->TableLeftColumnClass ?>"><span id="elh_country_ExchangeRate"><?php echo $country_view->ExchangeRate->caption() ?></span></td>
		<td data-name="ExchangeRate" <?php echo $country_view->ExchangeRate->cellAttributes() ?>>
<span id="el_country_ExchangeRate">
<span<?php echo $country_view->ExchangeRate->viewAttributes() ?>><?php echo $country_view->ExchangeRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($country_view->CountryCode->Visible) { // CountryCode ?>
	<tr id="r_CountryCode">
		<td class="<?php echo $country_view->TableLeftColumnClass ?>"><span id="elh_country_CountryCode"><?php echo $country_view->CountryCode->caption() ?></span></td>
		<td data-name="CountryCode" <?php echo $country_view->CountryCode->cellAttributes() ?>>
<span id="el_country_CountryCode">
<span<?php echo $country_view->CountryCode->viewAttributes() ?>><?php echo $country_view->CountryCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$country_view->IsModal) { ?>
<?php if (!$country_view->isExport()) { ?>
<?php echo $country_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$country_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$country_view->isExport()) { ?>
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
$country_view->terminate();
?>