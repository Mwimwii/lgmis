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
$self_registration_view = new self_registration_view();

// Run the page
$self_registration_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$self_registration_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$self_registration_view->isExport()) { ?>
<script>
var fself_registrationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fself_registrationview = currentForm = new ew.Form("fself_registrationview", "view");
	loadjs.done("fself_registrationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$self_registration_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $self_registration_view->ExportOptions->render("body") ?>
<?php $self_registration_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $self_registration_view->showPageHeader(); ?>
<?php
$self_registration_view->showMessage();
?>
<?php if (!$self_registration_view->IsModal) { ?>
<?php if (!$self_registration_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $self_registration_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fself_registrationview" id="fself_registrationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="self_registration">
<input type="hidden" name="modal" value="<?php echo (int)$self_registration_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($self_registration_view->SelfRegistrationID->Visible) { // SelfRegistrationID ?>
	<tr id="r_SelfRegistrationID">
		<td class="<?php echo $self_registration_view->TableLeftColumnClass ?>"><span id="elh_self_registration_SelfRegistrationID"><?php echo $self_registration_view->SelfRegistrationID->caption() ?></span></td>
		<td data-name="SelfRegistrationID" <?php echo $self_registration_view->SelfRegistrationID->cellAttributes() ?>>
<span id="el_self_registration_SelfRegistrationID">
<span<?php echo $self_registration_view->SelfRegistrationID->viewAttributes() ?>><?php echo $self_registration_view->SelfRegistrationID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($self_registration_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $self_registration_view->TableLeftColumnClass ?>"><span id="elh_self_registration_EmployeeID"><?php echo $self_registration_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $self_registration_view->EmployeeID->cellAttributes() ?>>
<span id="el_self_registration_EmployeeID">
<span<?php echo $self_registration_view->EmployeeID->viewAttributes() ?>><?php echo $self_registration_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($self_registration_view->NRC->Visible) { // NRC ?>
	<tr id="r_NRC">
		<td class="<?php echo $self_registration_view->TableLeftColumnClass ?>"><span id="elh_self_registration_NRC"><?php echo $self_registration_view->NRC->caption() ?></span></td>
		<td data-name="NRC" <?php echo $self_registration_view->NRC->cellAttributes() ?>>
<span id="el_self_registration_NRC">
<span<?php echo $self_registration_view->NRC->viewAttributes() ?>><?php echo $self_registration_view->NRC->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($self_registration_view->Password->Visible) { // Password ?>
	<tr id="r_Password">
		<td class="<?php echo $self_registration_view->TableLeftColumnClass ?>"><span id="elh_self_registration_Password"><?php echo $self_registration_view->Password->caption() ?></span></td>
		<td data-name="Password" <?php echo $self_registration_view->Password->cellAttributes() ?>>
<span id="el_self_registration_Password">
<span<?php echo $self_registration_view->Password->viewAttributes() ?>><?php echo $self_registration_view->Password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$self_registration_view->IsModal) { ?>
<?php if (!$self_registration_view->isExport()) { ?>
<?php echo $self_registration_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$self_registration_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$self_registration_view->isExport()) { ?>
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
$self_registration_view->terminate();
?>