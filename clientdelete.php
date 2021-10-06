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
$client_delete = new client_delete();

// Run the page
$client_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fclientdelete = currentForm = new ew.Form("fclientdelete", "delete");
	loadjs.done("fclientdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_delete->showPageHeader(); ?>
<?php
$client_delete->showMessage();
?>
<form name="fclientdelete" id="fclientdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($client_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($client_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<th class="<?php echo $client_delete->ClientSerNo->headerCellClass() ?>"><span id="elh_client_ClientSerNo" class="client_ClientSerNo"><?php echo $client_delete->ClientSerNo->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->ClientID->Visible) { // ClientID ?>
		<th class="<?php echo $client_delete->ClientID->headerCellClass() ?>"><span id="elh_client_ClientID" class="client_ClientID"><?php echo $client_delete->ClientID->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->ClientType->Visible) { // ClientType ?>
		<th class="<?php echo $client_delete->ClientType->headerCellClass() ?>"><span id="elh_client_ClientType" class="client_ClientType"><?php echo $client_delete->ClientType->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->IdentityType->Visible) { // IdentityType ?>
		<th class="<?php echo $client_delete->IdentityType->headerCellClass() ?>"><span id="elh_client_IdentityType" class="client_IdentityType"><?php echo $client_delete->IdentityType->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->PrivilegeCode->Visible) { // PrivilegeCode ?>
		<th class="<?php echo $client_delete->PrivilegeCode->headerCellClass() ?>"><span id="elh_client_PrivilegeCode" class="client_PrivilegeCode"><?php echo $client_delete->PrivilegeCode->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->ClientName->Visible) { // ClientName ?>
		<th class="<?php echo $client_delete->ClientName->headerCellClass() ?>"><span id="elh_client_ClientName" class="client_ClientName"><?php echo $client_delete->ClientName->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->Title->Visible) { // Title ?>
		<th class="<?php echo $client_delete->Title->headerCellClass() ?>"><span id="elh_client_Title" class="client_Title"><?php echo $client_delete->Title->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->Surname->Visible) { // Surname ?>
		<th class="<?php echo $client_delete->Surname->headerCellClass() ?>"><span id="elh_client_Surname" class="client_Surname"><?php echo $client_delete->Surname->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $client_delete->FirstName->headerCellClass() ?>"><span id="elh_client_FirstName" class="client_FirstName"><?php echo $client_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->MiddleName->Visible) { // MiddleName ?>
		<th class="<?php echo $client_delete->MiddleName->headerCellClass() ?>"><span id="elh_client_MiddleName" class="client_MiddleName"><?php echo $client_delete->MiddleName->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->Sex->Visible) { // Sex ?>
		<th class="<?php echo $client_delete->Sex->headerCellClass() ?>"><span id="elh_client_Sex" class="client_Sex"><?php echo $client_delete->Sex->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<th class="<?php echo $client_delete->MaritalStatus->headerCellClass() ?>"><span id="elh_client_MaritalStatus" class="client_MaritalStatus"><?php echo $client_delete->MaritalStatus->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<th class="<?php echo $client_delete->DateOfBirth->headerCellClass() ?>"><span id="elh_client_DateOfBirth" class="client_DateOfBirth"><?php echo $client_delete->DateOfBirth->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->PostalAddress->Visible) { // PostalAddress ?>
		<th class="<?php echo $client_delete->PostalAddress->headerCellClass() ?>"><span id="elh_client_PostalAddress" class="client_PostalAddress"><?php echo $client_delete->PostalAddress->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<th class="<?php echo $client_delete->PhysicalAddress->headerCellClass() ?>"><span id="elh_client_PhysicalAddress" class="client_PhysicalAddress"><?php echo $client_delete->PhysicalAddress->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->TownOrVillage->Visible) { // TownOrVillage ?>
		<th class="<?php echo $client_delete->TownOrVillage->headerCellClass() ?>"><span id="elh_client_TownOrVillage" class="client_TownOrVillage"><?php echo $client_delete->TownOrVillage->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->Telephone->Visible) { // Telephone ?>
		<th class="<?php echo $client_delete->Telephone->headerCellClass() ?>"><span id="elh_client_Telephone" class="client_Telephone"><?php echo $client_delete->Telephone->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->Mobile->Visible) { // Mobile ?>
		<th class="<?php echo $client_delete->Mobile->headerCellClass() ?>"><span id="elh_client_Mobile" class="client_Mobile"><?php echo $client_delete->Mobile->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->Fax->Visible) { // Fax ?>
		<th class="<?php echo $client_delete->Fax->headerCellClass() ?>"><span id="elh_client_Fax" class="client_Fax"><?php echo $client_delete->Fax->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $client_delete->_Email->headerCellClass() ?>"><span id="elh_client__Email" class="client__Email"><?php echo $client_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->NextOfKin->Visible) { // NextOfKin ?>
		<th class="<?php echo $client_delete->NextOfKin->headerCellClass() ?>"><span id="elh_client_NextOfKin" class="client_NextOfKin"><?php echo $client_delete->NextOfKin->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->RelationshipCode->Visible) { // RelationshipCode ?>
		<th class="<?php echo $client_delete->RelationshipCode->headerCellClass() ?>"><span id="elh_client_RelationshipCode" class="client_RelationshipCode"><?php echo $client_delete->RelationshipCode->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<th class="<?php echo $client_delete->NextOfKinMobile->headerCellClass() ?>"><span id="elh_client_NextOfKinMobile" class="client_NextOfKinMobile"><?php echo $client_delete->NextOfKinMobile->caption() ?></span></th>
<?php } ?>
<?php if ($client_delete->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<th class="<?php echo $client_delete->NextOfKinEmail->headerCellClass() ?>"><span id="elh_client_NextOfKinEmail" class="client_NextOfKinEmail"><?php echo $client_delete->NextOfKinEmail->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$client_delete->RecordCount = 0;
$i = 0;
while (!$client_delete->Recordset->EOF) {
	$client_delete->RecordCount++;
	$client_delete->RowCount++;

	// Set row properties
	$client->resetAttributes();
	$client->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$client_delete->loadRowValues($client_delete->Recordset);

	// Render row
	$client_delete->renderRow();
?>
	<tr <?php echo $client->rowAttributes() ?>>
<?php if ($client_delete->ClientSerNo->Visible) { // ClientSerNo ?>
		<td <?php echo $client_delete->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_ClientSerNo" class="client_ClientSerNo">
<span<?php echo $client_delete->ClientSerNo->viewAttributes() ?>><?php echo $client_delete->ClientSerNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->ClientID->Visible) { // ClientID ?>
		<td <?php echo $client_delete->ClientID->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_ClientID" class="client_ClientID">
<span<?php echo $client_delete->ClientID->viewAttributes() ?>><?php echo $client_delete->ClientID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->ClientType->Visible) { // ClientType ?>
		<td <?php echo $client_delete->ClientType->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_ClientType" class="client_ClientType">
<span<?php echo $client_delete->ClientType->viewAttributes() ?>><?php echo $client_delete->ClientType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->IdentityType->Visible) { // IdentityType ?>
		<td <?php echo $client_delete->IdentityType->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_IdentityType" class="client_IdentityType">
<span<?php echo $client_delete->IdentityType->viewAttributes() ?>><?php echo $client_delete->IdentityType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->PrivilegeCode->Visible) { // PrivilegeCode ?>
		<td <?php echo $client_delete->PrivilegeCode->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_PrivilegeCode" class="client_PrivilegeCode">
<span<?php echo $client_delete->PrivilegeCode->viewAttributes() ?>><?php echo $client_delete->PrivilegeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->ClientName->Visible) { // ClientName ?>
		<td <?php echo $client_delete->ClientName->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_ClientName" class="client_ClientName">
<span<?php echo $client_delete->ClientName->viewAttributes() ?>><?php echo $client_delete->ClientName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->Title->Visible) { // Title ?>
		<td <?php echo $client_delete->Title->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_Title" class="client_Title">
<span<?php echo $client_delete->Title->viewAttributes() ?>><?php echo $client_delete->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->Surname->Visible) { // Surname ?>
		<td <?php echo $client_delete->Surname->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_Surname" class="client_Surname">
<span<?php echo $client_delete->Surname->viewAttributes() ?>><?php echo $client_delete->Surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $client_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_FirstName" class="client_FirstName">
<span<?php echo $client_delete->FirstName->viewAttributes() ?>><?php echo $client_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->MiddleName->Visible) { // MiddleName ?>
		<td <?php echo $client_delete->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_MiddleName" class="client_MiddleName">
<span<?php echo $client_delete->MiddleName->viewAttributes() ?>><?php echo $client_delete->MiddleName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->Sex->Visible) { // Sex ?>
		<td <?php echo $client_delete->Sex->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_Sex" class="client_Sex">
<span<?php echo $client_delete->Sex->viewAttributes() ?>><?php echo $client_delete->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<td <?php echo $client_delete->MaritalStatus->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_MaritalStatus" class="client_MaritalStatus">
<span<?php echo $client_delete->MaritalStatus->viewAttributes() ?>><?php echo $client_delete->MaritalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<td <?php echo $client_delete->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_DateOfBirth" class="client_DateOfBirth">
<span<?php echo $client_delete->DateOfBirth->viewAttributes() ?>><?php echo $client_delete->DateOfBirth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->PostalAddress->Visible) { // PostalAddress ?>
		<td <?php echo $client_delete->PostalAddress->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_PostalAddress" class="client_PostalAddress">
<span<?php echo $client_delete->PostalAddress->viewAttributes() ?>><?php echo $client_delete->PostalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td <?php echo $client_delete->PhysicalAddress->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_PhysicalAddress" class="client_PhysicalAddress">
<span<?php echo $client_delete->PhysicalAddress->viewAttributes() ?>><?php echo $client_delete->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->TownOrVillage->Visible) { // TownOrVillage ?>
		<td <?php echo $client_delete->TownOrVillage->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_TownOrVillage" class="client_TownOrVillage">
<span<?php echo $client_delete->TownOrVillage->viewAttributes() ?>><?php echo $client_delete->TownOrVillage->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->Telephone->Visible) { // Telephone ?>
		<td <?php echo $client_delete->Telephone->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_Telephone" class="client_Telephone">
<span<?php echo $client_delete->Telephone->viewAttributes() ?>><?php echo $client_delete->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->Mobile->Visible) { // Mobile ?>
		<td <?php echo $client_delete->Mobile->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_Mobile" class="client_Mobile">
<span<?php echo $client_delete->Mobile->viewAttributes() ?>><?php echo $client_delete->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->Fax->Visible) { // Fax ?>
		<td <?php echo $client_delete->Fax->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_Fax" class="client_Fax">
<span<?php echo $client_delete->Fax->viewAttributes() ?>><?php echo $client_delete->Fax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->_Email->Visible) { // Email ?>
		<td <?php echo $client_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client__Email" class="client__Email">
<span<?php echo $client_delete->_Email->viewAttributes() ?>><?php echo $client_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->NextOfKin->Visible) { // NextOfKin ?>
		<td <?php echo $client_delete->NextOfKin->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_NextOfKin" class="client_NextOfKin">
<span<?php echo $client_delete->NextOfKin->viewAttributes() ?>><?php echo $client_delete->NextOfKin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->RelationshipCode->Visible) { // RelationshipCode ?>
		<td <?php echo $client_delete->RelationshipCode->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_RelationshipCode" class="client_RelationshipCode">
<span<?php echo $client_delete->RelationshipCode->viewAttributes() ?>><?php echo $client_delete->RelationshipCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<td <?php echo $client_delete->NextOfKinMobile->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_NextOfKinMobile" class="client_NextOfKinMobile">
<span<?php echo $client_delete->NextOfKinMobile->viewAttributes() ?>><?php echo $client_delete->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_delete->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<td <?php echo $client_delete->NextOfKinEmail->cellAttributes() ?>>
<span id="el<?php echo $client_delete->RowCount ?>_client_NextOfKinEmail" class="client_NextOfKinEmail">
<span<?php echo $client_delete->NextOfKinEmail->viewAttributes() ?>><?php echo $client_delete->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$client_delete->Recordset->moveNext();
}
$client_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$client_delete->showPageFooter();
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
$client_delete->terminate();
?>