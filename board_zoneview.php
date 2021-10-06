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
$board_zone_view = new board_zone_view();

// Run the page
$board_zone_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_zone_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$board_zone_view->isExport()) { ?>
<script>
var fboard_zoneview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fboard_zoneview = currentForm = new ew.Form("fboard_zoneview", "view");
	loadjs.done("fboard_zoneview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$board_zone_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $board_zone_view->ExportOptions->render("body") ?>
<?php $board_zone_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $board_zone_view->showPageHeader(); ?>
<?php
$board_zone_view->showMessage();
?>
<?php if (!$board_zone_view->IsModal) { ?>
<?php if (!$board_zone_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_zone_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fboard_zoneview" id="fboard_zoneview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_zone">
<input type="hidden" name="modal" value="<?php echo (int)$board_zone_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($board_zone_view->BoardZone->Visible) { // BoardZone ?>
	<tr id="r_BoardZone">
		<td class="<?php echo $board_zone_view->TableLeftColumnClass ?>"><span id="elh_board_zone_BoardZone"><?php echo $board_zone_view->BoardZone->caption() ?></span></td>
		<td data-name="BoardZone" <?php echo $board_zone_view->BoardZone->cellAttributes() ?>>
<span id="el_board_zone_BoardZone">
<span<?php echo $board_zone_view->BoardZone->viewAttributes() ?>><?php echo $board_zone_view->BoardZone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($board_zone_view->BoardZoneDesc->Visible) { // BoardZoneDesc ?>
	<tr id="r_BoardZoneDesc">
		<td class="<?php echo $board_zone_view->TableLeftColumnClass ?>"><span id="elh_board_zone_BoardZoneDesc"><?php echo $board_zone_view->BoardZoneDesc->caption() ?></span></td>
		<td data-name="BoardZoneDesc" <?php echo $board_zone_view->BoardZoneDesc->cellAttributes() ?>>
<span id="el_board_zone_BoardZoneDesc">
<span<?php echo $board_zone_view->BoardZoneDesc->viewAttributes() ?>><?php echo $board_zone_view->BoardZoneDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($board_zone_view->IndividualCharge->Visible) { // IndividualCharge ?>
	<tr id="r_IndividualCharge">
		<td class="<?php echo $board_zone_view->TableLeftColumnClass ?>"><span id="elh_board_zone_IndividualCharge"><?php echo $board_zone_view->IndividualCharge->caption() ?></span></td>
		<td data-name="IndividualCharge" <?php echo $board_zone_view->IndividualCharge->cellAttributes() ?>>
<span id="el_board_zone_IndividualCharge">
<span<?php echo $board_zone_view->IndividualCharge->viewAttributes() ?>><?php echo $board_zone_view->IndividualCharge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($board_zone_view->AgentCharge->Visible) { // AgentCharge ?>
	<tr id="r_AgentCharge">
		<td class="<?php echo $board_zone_view->TableLeftColumnClass ?>"><span id="elh_board_zone_AgentCharge"><?php echo $board_zone_view->AgentCharge->caption() ?></span></td>
		<td data-name="AgentCharge" <?php echo $board_zone_view->AgentCharge->cellAttributes() ?>>
<span id="el_board_zone_AgentCharge">
<span<?php echo $board_zone_view->AgentCharge->viewAttributes() ?>><?php echo $board_zone_view->AgentCharge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($board_zone_view->PeriodType->Visible) { // PeriodType ?>
	<tr id="r_PeriodType">
		<td class="<?php echo $board_zone_view->TableLeftColumnClass ?>"><span id="elh_board_zone_PeriodType"><?php echo $board_zone_view->PeriodType->caption() ?></span></td>
		<td data-name="PeriodType" <?php echo $board_zone_view->PeriodType->cellAttributes() ?>>
<span id="el_board_zone_PeriodType">
<span<?php echo $board_zone_view->PeriodType->viewAttributes() ?>><?php echo $board_zone_view->PeriodType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($board_zone_view->BoardType->Visible) { // BoardType ?>
	<tr id="r_BoardType">
		<td class="<?php echo $board_zone_view->TableLeftColumnClass ?>"><span id="elh_board_zone_BoardType"><?php echo $board_zone_view->BoardType->caption() ?></span></td>
		<td data-name="BoardType" <?php echo $board_zone_view->BoardType->cellAttributes() ?>>
<span id="el_board_zone_BoardType">
<span<?php echo $board_zone_view->BoardType->viewAttributes() ?>><?php echo $board_zone_view->BoardType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$board_zone_view->IsModal) { ?>
<?php if (!$board_zone_view->isExport()) { ?>
<?php echo $board_zone_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$board_zone_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$board_zone_view->isExport()) { ?>
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
$board_zone_view->terminate();
?>