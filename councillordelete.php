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
$councillor_delete = new councillor_delete();

// Run the page
$councillor_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcouncillordelete = currentForm = new ew.Form("fcouncillordelete", "delete");
	loadjs.done("fcouncillordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_delete->showPageHeader(); ?>
<?php
$councillor_delete->showMessage();
?>
<form name="fcouncillordelete" id="fcouncillordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($councillor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($councillor_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $councillor_delete->EmployeeID->headerCellClass() ?>"><span id="elh_councillor_EmployeeID" class="councillor_EmployeeID"><?php echo $councillor_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->LACode->Visible) { // LACode ?>
		<th class="<?php echo $councillor_delete->LACode->headerCellClass() ?>"><span id="elh_councillor_LACode" class="councillor_LACode"><?php echo $councillor_delete->LACode->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->NRC->Visible) { // NRC ?>
		<th class="<?php echo $councillor_delete->NRC->headerCellClass() ?>"><span id="elh_councillor_NRC" class="councillor_NRC"><?php echo $councillor_delete->NRC->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->Sex->Visible) { // Sex ?>
		<th class="<?php echo $councillor_delete->Sex->headerCellClass() ?>"><span id="elh_councillor_Sex" class="councillor_Sex"><?php echo $councillor_delete->Sex->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->Title->Visible) { // Title ?>
		<th class="<?php echo $councillor_delete->Title->headerCellClass() ?>"><span id="elh_councillor_Title" class="councillor_Title"><?php echo $councillor_delete->Title->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->Surname->Visible) { // Surname ?>
		<th class="<?php echo $councillor_delete->Surname->headerCellClass() ?>"><span id="elh_councillor_Surname" class="councillor_Surname"><?php echo $councillor_delete->Surname->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $councillor_delete->FirstName->headerCellClass() ?>"><span id="elh_councillor_FirstName" class="councillor_FirstName"><?php echo $councillor_delete->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->MiddleName->Visible) { // MiddleName ?>
		<th class="<?php echo $councillor_delete->MiddleName->headerCellClass() ?>"><span id="elh_councillor_MiddleName" class="councillor_MiddleName"><?php echo $councillor_delete->MiddleName->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<th class="<?php echo $councillor_delete->MaritalStatus->headerCellClass() ?>"><span id="elh_councillor_MaritalStatus" class="councillor_MaritalStatus"><?php echo $councillor_delete->MaritalStatus->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<th class="<?php echo $councillor_delete->DateOfBirth->headerCellClass() ?>"><span id="elh_councillor_DateOfBirth" class="councillor_DateOfBirth"><?php echo $councillor_delete->DateOfBirth->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->Mobile->Visible) { // Mobile ?>
		<th class="<?php echo $councillor_delete->Mobile->headerCellClass() ?>"><span id="elh_councillor_Mobile" class="councillor_Mobile"><?php echo $councillor_delete->Mobile->caption() ?></span></th>
<?php } ?>
<?php if ($councillor_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $councillor_delete->_Email->headerCellClass() ?>"><span id="elh_councillor__Email" class="councillor__Email"><?php echo $councillor_delete->_Email->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$councillor_delete->RecordCount = 0;
$i = 0;
while (!$councillor_delete->Recordset->EOF) {
	$councillor_delete->RecordCount++;
	$councillor_delete->RowCount++;

	// Set row properties
	$councillor->resetAttributes();
	$councillor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$councillor_delete->loadRowValues($councillor_delete->Recordset);

	// Render row
	$councillor_delete->renderRow();
?>
	<tr <?php echo $councillor->rowAttributes() ?>>
<?php if ($councillor_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $councillor_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_EmployeeID" class="councillor_EmployeeID">
<span<?php echo $councillor_delete->EmployeeID->viewAttributes() ?>><?php echo $councillor_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->LACode->Visible) { // LACode ?>
		<td <?php echo $councillor_delete->LACode->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_LACode" class="councillor_LACode">
<span<?php echo $councillor_delete->LACode->viewAttributes() ?>><?php echo $councillor_delete->LACode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->NRC->Visible) { // NRC ?>
		<td <?php echo $councillor_delete->NRC->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_NRC" class="councillor_NRC">
<span<?php echo $councillor_delete->NRC->viewAttributes() ?>><?php echo $councillor_delete->NRC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->Sex->Visible) { // Sex ?>
		<td <?php echo $councillor_delete->Sex->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_Sex" class="councillor_Sex">
<span<?php echo $councillor_delete->Sex->viewAttributes() ?>><?php echo $councillor_delete->Sex->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->Title->Visible) { // Title ?>
		<td <?php echo $councillor_delete->Title->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_Title" class="councillor_Title">
<span<?php echo $councillor_delete->Title->viewAttributes() ?>><?php echo $councillor_delete->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->Surname->Visible) { // Surname ?>
		<td <?php echo $councillor_delete->Surname->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_Surname" class="councillor_Surname">
<span<?php echo $councillor_delete->Surname->viewAttributes() ?>><?php echo $councillor_delete->Surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->FirstName->Visible) { // FirstName ?>
		<td <?php echo $councillor_delete->FirstName->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_FirstName" class="councillor_FirstName">
<span<?php echo $councillor_delete->FirstName->viewAttributes() ?>><?php echo $councillor_delete->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->MiddleName->Visible) { // MiddleName ?>
		<td <?php echo $councillor_delete->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_MiddleName" class="councillor_MiddleName">
<span<?php echo $councillor_delete->MiddleName->viewAttributes() ?>><?php echo $councillor_delete->MiddleName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->MaritalStatus->Visible) { // MaritalStatus ?>
		<td <?php echo $councillor_delete->MaritalStatus->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_MaritalStatus" class="councillor_MaritalStatus">
<span<?php echo $councillor_delete->MaritalStatus->viewAttributes() ?>><?php echo $councillor_delete->MaritalStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->DateOfBirth->Visible) { // DateOfBirth ?>
		<td <?php echo $councillor_delete->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_DateOfBirth" class="councillor_DateOfBirth">
<span<?php echo $councillor_delete->DateOfBirth->viewAttributes() ?>><?php echo $councillor_delete->DateOfBirth->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->Mobile->Visible) { // Mobile ?>
		<td <?php echo $councillor_delete->Mobile->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor_Mobile" class="councillor_Mobile">
<span<?php echo $councillor_delete->Mobile->viewAttributes() ?>><?php echo $councillor_delete->Mobile->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($councillor_delete->_Email->Visible) { // Email ?>
		<td <?php echo $councillor_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $councillor_delete->RowCount ?>_councillor__Email" class="councillor__Email">
<span<?php echo $councillor_delete->_Email->viewAttributes() ?>><?php echo $councillor_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$councillor_delete->Recordset->moveNext();
}
$councillor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$councillor_delete->showPageFooter();
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
$councillor_delete->terminate();
?>