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
$staffprofbodies_view = new staffprofbodies_view();

// Run the page
$staffprofbodies_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffprofbodies_view->isExport()) { ?>
<script>
var fstaffprofbodiesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffprofbodiesview = currentForm = new ew.Form("fstaffprofbodiesview", "view");
	loadjs.done("fstaffprofbodiesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffprofbodies_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffprofbodies_view->ExportOptions->render("body") ?>
<?php $staffprofbodies_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffprofbodies_view->showPageHeader(); ?>
<?php
$staffprofbodies_view->showMessage();
?>
<?php if (!$staffprofbodies_view->IsModal) { ?>
<?php if (!$staffprofbodies_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffprofbodies_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffprofbodiesview" id="fstaffprofbodiesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffprofbodies">
<input type="hidden" name="modal" value="<?php echo (int)$staffprofbodies_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffprofbodies_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffprofbodies_view->TableLeftColumnClass ?>"><span id="elh_staffprofbodies_EmployeeID"><?php echo $staffprofbodies_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffprofbodies_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffprofbodies_EmployeeID">
<span<?php echo $staffprofbodies_view->EmployeeID->viewAttributes() ?>><?php echo $staffprofbodies_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffprofbodies_view->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<tr id="r_ProfessionalBody">
		<td class="<?php echo $staffprofbodies_view->TableLeftColumnClass ?>"><span id="elh_staffprofbodies_ProfessionalBody"><?php echo $staffprofbodies_view->ProfessionalBody->caption() ?></span></td>
		<td data-name="ProfessionalBody" <?php echo $staffprofbodies_view->ProfessionalBody->cellAttributes() ?>>
<span id="el_staffprofbodies_ProfessionalBody">
<span<?php echo $staffprofbodies_view->ProfessionalBody->viewAttributes() ?>><?php echo $staffprofbodies_view->ProfessionalBody->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffprofbodies_view->MembershipNo->Visible) { // MembershipNo ?>
	<tr id="r_MembershipNo">
		<td class="<?php echo $staffprofbodies_view->TableLeftColumnClass ?>"><span id="elh_staffprofbodies_MembershipNo"><?php echo $staffprofbodies_view->MembershipNo->caption() ?></span></td>
		<td data-name="MembershipNo" <?php echo $staffprofbodies_view->MembershipNo->cellAttributes() ?>>
<span id="el_staffprofbodies_MembershipNo">
<span<?php echo $staffprofbodies_view->MembershipNo->viewAttributes() ?>><?php echo $staffprofbodies_view->MembershipNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffprofbodies_view->DateJoined->Visible) { // DateJoined ?>
	<tr id="r_DateJoined">
		<td class="<?php echo $staffprofbodies_view->TableLeftColumnClass ?>"><span id="elh_staffprofbodies_DateJoined"><?php echo $staffprofbodies_view->DateJoined->caption() ?></span></td>
		<td data-name="DateJoined" <?php echo $staffprofbodies_view->DateJoined->cellAttributes() ?>>
<span id="el_staffprofbodies_DateJoined">
<span<?php echo $staffprofbodies_view->DateJoined->viewAttributes() ?>><?php echo $staffprofbodies_view->DateJoined->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffprofbodies_view->DateRenewed->Visible) { // DateRenewed ?>
	<tr id="r_DateRenewed">
		<td class="<?php echo $staffprofbodies_view->TableLeftColumnClass ?>"><span id="elh_staffprofbodies_DateRenewed"><?php echo $staffprofbodies_view->DateRenewed->caption() ?></span></td>
		<td data-name="DateRenewed" <?php echo $staffprofbodies_view->DateRenewed->cellAttributes() ?>>
<span id="el_staffprofbodies_DateRenewed">
<span<?php echo $staffprofbodies_view->DateRenewed->viewAttributes() ?>><?php echo $staffprofbodies_view->DateRenewed->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffprofbodies_view->ValidTo->Visible) { // ValidTo ?>
	<tr id="r_ValidTo">
		<td class="<?php echo $staffprofbodies_view->TableLeftColumnClass ?>"><span id="elh_staffprofbodies_ValidTo"><?php echo $staffprofbodies_view->ValidTo->caption() ?></span></td>
		<td data-name="ValidTo" <?php echo $staffprofbodies_view->ValidTo->cellAttributes() ?>>
<span id="el_staffprofbodies_ValidTo">
<span<?php echo $staffprofbodies_view->ValidTo->viewAttributes() ?>><?php echo $staffprofbodies_view->ValidTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffprofbodies_view->MemberStatus->Visible) { // MemberStatus ?>
	<tr id="r_MemberStatus">
		<td class="<?php echo $staffprofbodies_view->TableLeftColumnClass ?>"><span id="elh_staffprofbodies_MemberStatus"><?php echo $staffprofbodies_view->MemberStatus->caption() ?></span></td>
		<td data-name="MemberStatus" <?php echo $staffprofbodies_view->MemberStatus->cellAttributes() ?>>
<span id="el_staffprofbodies_MemberStatus">
<span<?php echo $staffprofbodies_view->MemberStatus->viewAttributes() ?>><?php echo $staffprofbodies_view->MemberStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffprofbodies_view->IsModal) { ?>
<?php if (!$staffprofbodies_view->isExport()) { ?>
<?php echo $staffprofbodies_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$staffprofbodies_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffprofbodies_view->isExport()) { ?>
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
$staffprofbodies_view->terminate();
?>