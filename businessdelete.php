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
$business_delete = new business_delete();

// Run the page
$business_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusinessdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbusinessdelete = currentForm = new ew.Form("fbusinessdelete", "delete");
	loadjs.done("fbusinessdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_delete->showPageHeader(); ?>
<?php
$business_delete->showMessage();
?>
<form name="fbusinessdelete" id="fbusinessdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($business_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($business_delete->BusinessID->Visible) { // BusinessID ?>
		<th class="<?php echo $business_delete->BusinessID->headerCellClass() ?>"><span id="elh_business_BusinessID" class="business_BusinessID"><?php echo $business_delete->BusinessID->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->PACRANo->Visible) { // PACRANo ?>
		<th class="<?php echo $business_delete->PACRANo->headerCellClass() ?>"><span id="elh_business_PACRANo" class="business_PACRANo"><?php echo $business_delete->PACRANo->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->TPIN->Visible) { // TPIN ?>
		<th class="<?php echo $business_delete->TPIN->headerCellClass() ?>"><span id="elh_business_TPIN" class="business_TPIN"><?php echo $business_delete->TPIN->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->BusinessName->Visible) { // BusinessName ?>
		<th class="<?php echo $business_delete->BusinessName->headerCellClass() ?>"><span id="elh_business_BusinessName" class="business_BusinessName"><?php echo $business_delete->BusinessName->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $business_delete->ClientID->headerCellClass() ?>"><span id="elh_business_ClientID" class="business_ClientID"><?php echo $business_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->BusinessSector->Visible) { // BusinessSector ?>
		<th class="<?php echo $business_delete->BusinessSector->headerCellClass() ?>"><span id="elh_business_BusinessSector" class="business_BusinessSector"><?php echo $business_delete->BusinessSector->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->BusinessType->Visible) { // BusinessType ?>
		<th class="<?php echo $business_delete->BusinessType->headerCellClass() ?>"><span id="elh_business_BusinessType" class="business_BusinessType"><?php echo $business_delete->BusinessType->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->Location->Visible) { // Location ?>
		<th class="<?php echo $business_delete->Location->headerCellClass() ?>"><span id="elh_business_Location" class="business_Location"><?php echo $business_delete->Location->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->Turnover->Visible) { // Turnover ?>
		<th class="<?php echo $business_delete->Turnover->headerCellClass() ?>"><span id="elh_business_Turnover" class="business_Turnover"><?php echo $business_delete->Turnover->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->Branches->Visible) { // Branches ?>
		<th class="<?php echo $business_delete->Branches->headerCellClass() ?>"><span id="elh_business_Branches" class="business_Branches"><?php echo $business_delete->Branches->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->NewImprovements->Visible) { // NewImprovements ?>
		<th class="<?php echo $business_delete->NewImprovements->headerCellClass() ?>"><span id="elh_business_NewImprovements" class="business_NewImprovements"><?php echo $business_delete->NewImprovements->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->Longitude->Visible) { // Longitude ?>
		<th class="<?php echo $business_delete->Longitude->headerCellClass() ?>"><span id="elh_business_Longitude" class="business_Longitude"><?php echo $business_delete->Longitude->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->Latitude->Visible) { // Latitude ?>
		<th class="<?php echo $business_delete->Latitude->headerCellClass() ?>"><span id="elh_business_Latitude" class="business_Latitude"><?php echo $business_delete->Latitude->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->DateOpened->Visible) { // DateOpened ?>
		<th class="<?php echo $business_delete->DateOpened->headerCellClass() ?>"><span id="elh_business_DateOpened" class="business_DateOpened"><?php echo $business_delete->DateOpened->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->BusinessDesc->Visible) { // BusinessDesc ?>
		<th class="<?php echo $business_delete->BusinessDesc->headerCellClass() ?>"><span id="elh_business_BusinessDesc" class="business_BusinessDesc"><?php echo $business_delete->BusinessDesc->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<th class="<?php echo $business_delete->LastUpdatedBy->headerCellClass() ?>"><span id="elh_business_LastUpdatedBy" class="business_LastUpdatedBy"><?php echo $business_delete->LastUpdatedBy->caption() ?></span></th>
<?php } ?>
<?php if ($business_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<th class="<?php echo $business_delete->LastUpdateDate->headerCellClass() ?>"><span id="elh_business_LastUpdateDate" class="business_LastUpdateDate"><?php echo $business_delete->LastUpdateDate->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$business_delete->RecordCount = 0;
$i = 0;
while (!$business_delete->Recordset->EOF) {
	$business_delete->RecordCount++;
	$business_delete->RowCount++;

	// Set row properties
	$business->resetAttributes();
	$business->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$business_delete->loadRowValues($business_delete->Recordset);

	// Render row
	$business_delete->renderRow();
?>
	<tr <?php echo $business->rowAttributes() ?>>
<?php if ($business_delete->BusinessID->Visible) { // BusinessID ?>
		<td <?php echo $business_delete->BusinessID->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_BusinessID" class="business_BusinessID">
<span<?php echo $business_delete->BusinessID->viewAttributes() ?>><?php echo $business_delete->BusinessID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->PACRANo->Visible) { // PACRANo ?>
		<td <?php echo $business_delete->PACRANo->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_PACRANo" class="business_PACRANo">
<span<?php echo $business_delete->PACRANo->viewAttributes() ?>><?php echo $business_delete->PACRANo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->TPIN->Visible) { // TPIN ?>
		<td <?php echo $business_delete->TPIN->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_TPIN" class="business_TPIN">
<span<?php echo $business_delete->TPIN->viewAttributes() ?>><?php echo $business_delete->TPIN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->BusinessName->Visible) { // BusinessName ?>
		<td <?php echo $business_delete->BusinessName->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_BusinessName" class="business_BusinessName">
<span<?php echo $business_delete->BusinessName->viewAttributes() ?>><?php echo $business_delete->BusinessName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $business_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_ClientID" class="business_ClientID">
<span<?php echo $business_delete->ClientID->viewAttributes() ?>><?php echo $business_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->BusinessSector->Visible) { // BusinessSector ?>
		<td <?php echo $business_delete->BusinessSector->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_BusinessSector" class="business_BusinessSector">
<span<?php echo $business_delete->BusinessSector->viewAttributes() ?>><?php echo $business_delete->BusinessSector->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->BusinessType->Visible) { // BusinessType ?>
		<td <?php echo $business_delete->BusinessType->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_BusinessType" class="business_BusinessType">
<span<?php echo $business_delete->BusinessType->viewAttributes() ?>><?php echo $business_delete->BusinessType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->Location->Visible) { // Location ?>
		<td <?php echo $business_delete->Location->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_Location" class="business_Location">
<span<?php echo $business_delete->Location->viewAttributes() ?>><?php echo $business_delete->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->Turnover->Visible) { // Turnover ?>
		<td <?php echo $business_delete->Turnover->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_Turnover" class="business_Turnover">
<span<?php echo $business_delete->Turnover->viewAttributes() ?>><?php echo $business_delete->Turnover->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->Branches->Visible) { // Branches ?>
		<td <?php echo $business_delete->Branches->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_Branches" class="business_Branches">
<span<?php echo $business_delete->Branches->viewAttributes() ?>><?php echo $business_delete->Branches->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->NewImprovements->Visible) { // NewImprovements ?>
		<td <?php echo $business_delete->NewImprovements->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_NewImprovements" class="business_NewImprovements">
<span<?php echo $business_delete->NewImprovements->viewAttributes() ?>><?php echo $business_delete->NewImprovements->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->Longitude->Visible) { // Longitude ?>
		<td <?php echo $business_delete->Longitude->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_Longitude" class="business_Longitude">
<span<?php echo $business_delete->Longitude->viewAttributes() ?>><?php echo $business_delete->Longitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->Latitude->Visible) { // Latitude ?>
		<td <?php echo $business_delete->Latitude->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_Latitude" class="business_Latitude">
<span<?php echo $business_delete->Latitude->viewAttributes() ?>><?php echo $business_delete->Latitude->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->DateOpened->Visible) { // DateOpened ?>
		<td <?php echo $business_delete->DateOpened->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_DateOpened" class="business_DateOpened">
<span<?php echo $business_delete->DateOpened->viewAttributes() ?>><?php echo $business_delete->DateOpened->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->BusinessDesc->Visible) { // BusinessDesc ?>
		<td <?php echo $business_delete->BusinessDesc->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_BusinessDesc" class="business_BusinessDesc">
<span<?php echo $business_delete->BusinessDesc->viewAttributes() ?>><?php echo $business_delete->BusinessDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td <?php echo $business_delete->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_LastUpdatedBy" class="business_LastUpdatedBy">
<span<?php echo $business_delete->LastUpdatedBy->viewAttributes() ?>><?php echo $business_delete->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_delete->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td <?php echo $business_delete->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $business_delete->RowCount ?>_business_LastUpdateDate" class="business_LastUpdateDate">
<span<?php echo $business_delete->LastUpdateDate->viewAttributes() ?>><?php echo $business_delete->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$business_delete->Recordset->moveNext();
}
$business_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$business_delete->showPageFooter();
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
$business_delete->terminate();
?>