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
$physical_challenge_delete = new physical_challenge_delete();

// Run the page
$physical_challenge_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$physical_challenge_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fphysical_challengedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fphysical_challengedelete = currentForm = new ew.Form("fphysical_challengedelete", "delete");
	loadjs.done("fphysical_challengedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $physical_challenge_delete->showPageHeader(); ?>
<?php
$physical_challenge_delete->showMessage();
?>
<form name="fphysical_challengedelete" id="fphysical_challengedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="physical_challenge">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($physical_challenge_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($physical_challenge_delete->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<th class="<?php echo $physical_challenge_delete->PhysicalChallenge->headerCellClass() ?>"><span id="elh_physical_challenge_PhysicalChallenge" class="physical_challenge_PhysicalChallenge"><?php echo $physical_challenge_delete->PhysicalChallenge->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$physical_challenge_delete->RecordCount = 0;
$i = 0;
while (!$physical_challenge_delete->Recordset->EOF) {
	$physical_challenge_delete->RecordCount++;
	$physical_challenge_delete->RowCount++;

	// Set row properties
	$physical_challenge->resetAttributes();
	$physical_challenge->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$physical_challenge_delete->loadRowValues($physical_challenge_delete->Recordset);

	// Render row
	$physical_challenge_delete->renderRow();
?>
	<tr <?php echo $physical_challenge->rowAttributes() ?>>
<?php if ($physical_challenge_delete->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<td <?php echo $physical_challenge_delete->PhysicalChallenge->cellAttributes() ?>>
<span id="el<?php echo $physical_challenge_delete->RowCount ?>_physical_challenge_PhysicalChallenge" class="physical_challenge_PhysicalChallenge">
<span<?php echo $physical_challenge_delete->PhysicalChallenge->viewAttributes() ?>><?php echo $physical_challenge_delete->PhysicalChallenge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$physical_challenge_delete->Recordset->moveNext();
}
$physical_challenge_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $physical_challenge_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$physical_challenge_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$physical_challenge_delete->terminate();
?>