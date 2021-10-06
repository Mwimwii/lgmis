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
$musers_delete = new musers_delete();

// Run the page
$musers_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$musers_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmusersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmusersdelete = currentForm = new ew.Form("fmusersdelete", "delete");
	loadjs.done("fmusersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $musers_delete->showPageHeader(); ?>
<?php
$musers_delete->showMessage();
?>
<form name="fmusersdelete" id="fmusersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="musers">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($musers_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($musers_delete->UserCode->Visible) { // UserCode ?>
		<th class="<?php echo $musers_delete->UserCode->headerCellClass() ?>"><span id="elh_musers_UserCode" class="musers_UserCode"><?php echo $musers_delete->UserCode->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->UserName->Visible) { // UserName ?>
		<th class="<?php echo $musers_delete->UserName->headerCellClass() ?>"><span id="elh_musers_UserName" class="musers_UserName"><?php echo $musers_delete->UserName->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Password->Visible) { // Password ?>
		<th class="<?php echo $musers_delete->Password->headerCellClass() ?>"><span id="elh_musers_Password" class="musers_Password"><?php echo $musers_delete->Password->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $musers_delete->EmployeeID->headerCellClass() ?>"><span id="elh_musers_EmployeeID" class="musers_EmployeeID"><?php echo $musers_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $musers_delete->FirstName->headerCellClass() ?>"><span id="elh_musers_FirstName" class="musers_FirstName"><?php echo $musers_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->LastName->Visible) { // LastName ?>
		<th class="<?php echo $musers_delete->LastName->headerCellClass() ?>"><span id="elh_musers_LastName" class="musers_LastName"><?php echo $musers_delete->LastName->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<th class="<?php echo $musers_delete->ProvinceCode->headerCellClass() ?>"><span id="elh_musers_ProvinceCode" class="musers_ProvinceCode"><?php echo $musers_delete->ProvinceCode->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $musers_delete->LACode->headerCellClass() ?>"><span id="elh_musers_LACode" class="musers_LACode"><?php echo $musers_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Level->Visible) { // Level ?>
		<th class="<?php echo $musers_delete->Level->headerCellClass() ?>"><span id="elh_musers_Level" class="musers_Level"><?php echo $musers_delete->Level->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Role->Visible) { // Role ?>
		<th class="<?php echo $musers_delete->Role->headerCellClass() ?>"><span id="elh_musers_Role" class="musers_Role"><?php echo $musers_delete->Role->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Clearance->Visible) { // Clearance ?>
		<th class="<?php echo $musers_delete->Clearance->headerCellClass() ?>"><span id="elh_musers_Clearance" class="musers_Clearance"><?php echo $musers_delete->Clearance->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->OrganisationLevel->Visible) { // OrganisationLevel ?>
		<th class="<?php echo $musers_delete->OrganisationLevel->headerCellClass() ?>"><span id="elh_musers_OrganisationLevel" class="musers_OrganisationLevel"><?php echo $musers_delete->OrganisationLevel->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Active->Visible) { // Active ?>
		<th class="<?php echo $musers_delete->Active->headerCellClass() ?>"><span id="elh_musers_Active" class="musers_Active"><?php echo $musers_delete->Active->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $musers_delete->_Email->headerCellClass() ?>"><span id="elh_musers__Email" class="musers__Email"><?php echo $musers_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Telephone->Visible) { // Telephone ?>
		<th class="<?php echo $musers_delete->Telephone->headerCellClass() ?>"><span id="elh_musers_Telephone" class="musers_Telephone"><?php echo $musers_delete->Telephone->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Mobile->Visible) { // Mobile ?>
		<th class="<?php echo $musers_delete->Mobile->headerCellClass() ?>"><span id="elh_musers_Mobile" class="musers_Mobile"><?php echo $musers_delete->Mobile->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->Position->Visible) { // Position ?>
		<th class="<?php echo $musers_delete->Position->headerCellClass() ?>"><span id="elh_musers_Position" class="musers_Position"><?php echo $musers_delete->Position->caption() ?></span></th>
<?php } ?>
<?php if ($musers_delete->ReportsTo->Visible) { // ReportsTo ?>
		<th class="<?php echo $musers_delete->ReportsTo->headerCellClass() ?>"><span id="elh_musers_ReportsTo" class="musers_ReportsTo"><?php echo $musers_delete->ReportsTo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$musers_delete->RecordCount = 0;
$i = 0;
while (!$musers_delete->Recordset->EOF) {
	$musers_delete->RecordCount++;
	$musers_delete->RowCount++;

	// Set row properties
	$musers->resetAttributes();
	$musers->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$musers_delete->loadRowValues($musers_delete->Recordset);

	// Render row
	$musers_delete->renderRow();
?>
	<tr <?php echo $musers->rowAttributes() ?>>
<?php if ($musers_delete->UserCode->Visible) { // UserCode ?>
		<td <?php echo $musers_delete->UserCode->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_UserCode" class="musers_UserCode">
<span<?php echo $musers_delete->UserCode->viewAttributes() ?>><?php echo $musers_delete->UserCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->UserName->Visible) { // UserName ?>
		<td <?php echo $musers_delete->UserName->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_UserName" class="musers_UserName">
<span<?php echo $musers_delete->UserName->viewAttributes() ?>><?php echo $musers_delete->UserName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Password->Visible) { // Password ?>
		<td <?php echo $musers_delete->Password->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Password" class="musers_Password">
<span<?php echo $musers_delete->Password->viewAttributes() ?>><?php echo $musers_delete->Password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $musers_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_EmployeeID" class="musers_EmployeeID">
<span<?php echo $musers_delete->EmployeeID->viewAttributes() ?>><?php echo $musers_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $musers_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_FirstName" class="musers_FirstName">
<span<?php echo $musers_delete->FirstName->viewAttributes() ?>><?php echo $musers_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->LastName->Visible) { // LastName ?>
		<td <?php echo $musers_delete->LastName->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_LastName" class="musers_LastName">
<span<?php echo $musers_delete->LastName->viewAttributes() ?>><?php echo $musers_delete->LastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->ProvinceCode->Visible) { // ProvinceCode ?>
		<td <?php echo $musers_delete->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_ProvinceCode" class="musers_ProvinceCode">
<span<?php echo $musers_delete->ProvinceCode->viewAttributes() ?>><?php echo $musers_delete->ProvinceCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $musers_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_LACode" class="musers_LACode">
<span<?php echo $musers_delete->LACode->viewAttributes() ?>><?php echo $musers_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Level->Visible) { // Level ?>
		<td <?php echo $musers_delete->Level->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Level" class="musers_Level">
<span<?php echo $musers_delete->Level->viewAttributes() ?>><?php echo $musers_delete->Level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Role->Visible) { // Role ?>
		<td <?php echo $musers_delete->Role->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Role" class="musers_Role">
<span<?php echo $musers_delete->Role->viewAttributes() ?>><?php echo $musers_delete->Role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Clearance->Visible) { // Clearance ?>
		<td <?php echo $musers_delete->Clearance->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Clearance" class="musers_Clearance">
<span<?php echo $musers_delete->Clearance->viewAttributes() ?>><?php echo $musers_delete->Clearance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->OrganisationLevel->Visible) { // OrganisationLevel ?>
		<td <?php echo $musers_delete->OrganisationLevel->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_OrganisationLevel" class="musers_OrganisationLevel">
<span<?php echo $musers_delete->OrganisationLevel->viewAttributes() ?>><?php echo $musers_delete->OrganisationLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Active->Visible) { // Active ?>
		<td <?php echo $musers_delete->Active->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Active" class="musers_Active">
<span<?php echo $musers_delete->Active->viewAttributes() ?>><?php echo $musers_delete->Active->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->_Email->Visible) { // Email ?>
		<td <?php echo $musers_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers__Email" class="musers__Email">
<span<?php echo $musers_delete->_Email->viewAttributes() ?>><?php echo $musers_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Telephone->Visible) { // Telephone ?>
		<td <?php echo $musers_delete->Telephone->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Telephone" class="musers_Telephone">
<span<?php echo $musers_delete->Telephone->viewAttributes() ?>><?php echo $musers_delete->Telephone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Mobile->Visible) { // Mobile ?>
		<td <?php echo $musers_delete->Mobile->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Mobile" class="musers_Mobile">
<span<?php echo $musers_delete->Mobile->viewAttributes() ?>><?php echo $musers_delete->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->Position->Visible) { // Position ?>
		<td <?php echo $musers_delete->Position->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_Position" class="musers_Position">
<span<?php echo $musers_delete->Position->viewAttributes() ?>><?php echo $musers_delete->Position->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($musers_delete->ReportsTo->Visible) { // ReportsTo ?>
		<td <?php echo $musers_delete->ReportsTo->cellAttributes() ?>>
<span id="el<?php echo $musers_delete->RowCount ?>_musers_ReportsTo" class="musers_ReportsTo">
<span<?php echo $musers_delete->ReportsTo->viewAttributes() ?>><?php echo $musers_delete->ReportsTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$musers_delete->Recordset->moveNext();
}
$musers_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $musers_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$musers_delete->showPageFooter();
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
$musers_delete->terminate();
?>