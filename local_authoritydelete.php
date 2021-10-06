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
$local_authority_delete = new local_authority_delete();

// Run the page
$local_authority_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$local_authority_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flocal_authoritydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flocal_authoritydelete = currentForm = new ew.Form("flocal_authoritydelete", "delete");
	loadjs.done("flocal_authoritydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $local_authority_delete->showPageHeader(); ?>
<?php
$local_authority_delete->showMessage();
?>
<form name="flocal_authoritydelete" id="flocal_authoritydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="local_authority">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($local_authority_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($local_authority_delete->LAName->Visible) { // LAName ?>
		<th class="<?php echo $local_authority_delete->LAName->headerCellClass() ?>"><span id="elh_local_authority_LAName" class="local_authority_LAName"><?php echo $local_authority_delete->LAName->caption() ?></span></th>
<?php } ?>
<?php if ($local_authority_delete->CouncilType->Visible) { // CouncilType ?>
		<th class="<?php echo $local_authority_delete->CouncilType->headerCellClass() ?>"><span id="elh_local_authority_CouncilType" class="local_authority_CouncilType"><?php echo $local_authority_delete->CouncilType->caption() ?></span></th>
<?php } ?>
<?php if ($local_authority_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $local_authority_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_local_authority_ProvinceCode" class="local_authority_ProvinceCode"><?php echo $local_authority_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($local_authority_delete->Clients->Visible) { // Clients ?>
		<th class="<?php echo $local_authority_delete->Clients->headerCellClass() ?>"><span id="elh_local_authority_Clients" class="local_authority_Clients"><?php echo $local_authority_delete->Clients->caption() ?></span></th>
<?php } ?>
<?php if ($local_authority_delete->Beneficiaries->Visible) { // Beneficiaries ?>
		<th class="<?php echo $local_authority_delete->Beneficiaries->headerCellClass() ?>"><span id="elh_local_authority_Beneficiaries" class="local_authority_Beneficiaries"><?php echo $local_authority_delete->Beneficiaries->caption() ?></span></th>
<?php } ?>
<?php if ($local_authority_delete->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
		<th class="<?php echo $local_authority_delete->ExecutiveAuthority->headerCellClass() ?>"><span id="elh_local_authority_ExecutiveAuthority" class="local_authority_ExecutiveAuthority"><?php echo $local_authority_delete->ExecutiveAuthority->caption() ?></span></th>
<?php } ?>
<?php if ($local_authority_delete->ControllingOfficer->Visible) { // ControllingOfficer ?>
		<th class="<?php echo $local_authority_delete->ControllingOfficer->headerCellClass() ?>"><span id="elh_local_authority_ControllingOfficer" class="local_authority_ControllingOfficer"><?php echo $local_authority_delete->ControllingOfficer->caption() ?></span></th>
<?php } ?>
<?php if ($local_authority_delete->Comment->Visible) { // Comment ?>
		<th class="<?php echo $local_authority_delete->Comment->headerCellClass() ?>"><span id="elh_local_authority_Comment" class="local_authority_Comment"><?php echo $local_authority_delete->Comment->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$local_authority_delete->RecordCount = 0;
$i = 0;
while (!$local_authority_delete->Recordset->EOF) {
	$local_authority_delete->RecordCount++;
	$local_authority_delete->RowCount++;

	// Set row properties
	$local_authority->resetAttributes();
	$local_authority->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$local_authority_delete->loadRowValues($local_authority_delete->Recordset);

	// Render row
	$local_authority_delete->renderRow();
?>
	<tr <?php echo $local_authority->rowAttributes() ?>>
<?php if ($local_authority_delete->LAName->Visible) { // LAName ?>
		<td <?php echo $local_authority_delete->LAName->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_LAName" class="local_authority_LAName">
<span<?php echo $local_authority_delete->LAName->viewAttributes() ?>><?php echo $local_authority_delete->LAName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority_delete->CouncilType->Visible) { // CouncilType ?>
		<td <?php echo $local_authority_delete->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_CouncilType" class="local_authority_CouncilType">
<span<?php echo $local_authority_delete->CouncilType->viewAttributes() ?>><?php echo $local_authority_delete->CouncilType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $local_authority_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_ProvinceCode" class="local_authority_ProvinceCode">
<span<?php echo $local_authority_delete->ProvinceCode->viewAttributes() ?>><?php echo $local_authority_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority_delete->Clients->Visible) { // Clients ?>
		<td <?php echo $local_authority_delete->Clients->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_Clients" class="local_authority_Clients">
<span<?php echo $local_authority_delete->Clients->viewAttributes() ?>><?php echo $local_authority_delete->Clients->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority_delete->Beneficiaries->Visible) { // Beneficiaries ?>
		<td <?php echo $local_authority_delete->Beneficiaries->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_Beneficiaries" class="local_authority_Beneficiaries">
<span<?php echo $local_authority_delete->Beneficiaries->viewAttributes() ?>><?php echo $local_authority_delete->Beneficiaries->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority_delete->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
		<td <?php echo $local_authority_delete->ExecutiveAuthority->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_ExecutiveAuthority" class="local_authority_ExecutiveAuthority">
<span<?php echo $local_authority_delete->ExecutiveAuthority->viewAttributes() ?>><?php echo $local_authority_delete->ExecutiveAuthority->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority_delete->ControllingOfficer->Visible) { // ControllingOfficer ?>
		<td <?php echo $local_authority_delete->ControllingOfficer->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_ControllingOfficer" class="local_authority_ControllingOfficer">
<span<?php echo $local_authority_delete->ControllingOfficer->viewAttributes() ?>><?php echo $local_authority_delete->ControllingOfficer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($local_authority_delete->Comment->Visible) { // Comment ?>
		<td <?php echo $local_authority_delete->Comment->cellAttributes() ?>>
<span id="el<?php echo $local_authority_delete->RowCount ?>_local_authority_Comment" class="local_authority_Comment">
<span<?php echo $local_authority_delete->Comment->viewAttributes() ?>><?php echo $local_authority_delete->Comment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$local_authority_delete->Recordset->moveNext();
}
$local_authority_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $local_authority_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$local_authority_delete->showPageFooter();
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
$local_authority_delete->terminate();
?>