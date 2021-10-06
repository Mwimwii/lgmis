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
$political_party_delete = new political_party_delete();

// Run the page
$political_party_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$political_party_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpolitical_partydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpolitical_partydelete = currentForm = new ew.Form("fpolitical_partydelete", "delete");
	loadjs.done("fpolitical_partydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $political_party_delete->showPageHeader(); ?>
<?php
$political_party_delete->showMessage();
?>
<form name="fpolitical_partydelete" id="fpolitical_partydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="political_party">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($political_party_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($political_party_delete->PoliticalParty->Visible) { // PoliticalParty ?>
		<th class="<?php echo $political_party_delete->PoliticalParty->headerCellClass() ?>"><span id="elh_political_party_PoliticalParty" class="political_party_PoliticalParty"><?php echo $political_party_delete->PoliticalParty->caption() ?></span></th>
<?php } ?>
<?php if ($political_party_delete->Remarks->Visible) { // Remarks ?>
		<th class="<?php echo $political_party_delete->Remarks->headerCellClass() ?>"><span id="elh_political_party_Remarks" class="political_party_Remarks"><?php echo $political_party_delete->Remarks->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$political_party_delete->RecordCount = 0;
$i = 0;
while (!$political_party_delete->Recordset->EOF) {
	$political_party_delete->RecordCount++;
	$political_party_delete->RowCount++;

	// Set row properties
	$political_party->resetAttributes();
	$political_party->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$political_party_delete->loadRowValues($political_party_delete->Recordset);

	// Render row
	$political_party_delete->renderRow();
?>
	<tr <?php echo $political_party->rowAttributes() ?>>
<?php if ($political_party_delete->PoliticalParty->Visible) { // PoliticalParty ?>
		<td <?php echo $political_party_delete->PoliticalParty->cellAttributes() ?>>
<span id="el<?php echo $political_party_delete->RowCount ?>_political_party_PoliticalParty" class="political_party_PoliticalParty">
<span<?php echo $political_party_delete->PoliticalParty->viewAttributes() ?>><?php echo $political_party_delete->PoliticalParty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($political_party_delete->Remarks->Visible) { // Remarks ?>
		<td <?php echo $political_party_delete->Remarks->cellAttributes() ?>>
<span id="el<?php echo $political_party_delete->RowCount ?>_political_party_Remarks" class="political_party_Remarks">
<span<?php echo $political_party_delete->Remarks->viewAttributes() ?>><?php echo $political_party_delete->Remarks->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$political_party_delete->Recordset->moveNext();
}
$political_party_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $political_party_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$political_party_delete->showPageFooter();
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
$political_party_delete->terminate();
?>