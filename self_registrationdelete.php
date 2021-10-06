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
$self_registration_delete = new self_registration_delete();

// Run the page
$self_registration_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$self_registration_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fself_registrationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fself_registrationdelete = currentForm = new ew.Form("fself_registrationdelete", "delete");
	loadjs.done("fself_registrationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $self_registration_delete->showPageHeader(); ?>
<?php
$self_registration_delete->showMessage();
?>
<form name="fself_registrationdelete" id="fself_registrationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="self_registration">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($self_registration_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($self_registration_delete->SelfRegistrationID->Visible) { // SelfRegistrationID ?>
		<th class="<?php echo $self_registration_delete->SelfRegistrationID->headerCellClass() ?>"><span id="elh_self_registration_SelfRegistrationID" class="self_registration_SelfRegistrationID"><?php echo $self_registration_delete->SelfRegistrationID->caption() ?></span></th>
<?php } ?>
<?php if ($self_registration_delete->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $self_registration_delete->EmployeeID->headerCellClass() ?>"><span id="elh_self_registration_EmployeeID" class="self_registration_EmployeeID"><?php echo $self_registration_delete->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($self_registration_delete->NRC->Visible) { // NRC ?>
		<th class="<?php echo $self_registration_delete->NRC->headerCellClass() ?>"><span id="elh_self_registration_NRC" class="self_registration_NRC"><?php echo $self_registration_delete->NRC->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$self_registration_delete->RecordCount = 0;
$i = 0;
while (!$self_registration_delete->Recordset->EOF) {
	$self_registration_delete->RecordCount++;
	$self_registration_delete->RowCount++;

	// Set row properties
	$self_registration->resetAttributes();
	$self_registration->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$self_registration_delete->loadRowValues($self_registration_delete->Recordset);

	// Render row
	$self_registration_delete->renderRow();
?>
	<tr <?php echo $self_registration->rowAttributes() ?>>
<?php if ($self_registration_delete->SelfRegistrationID->Visible) { // SelfRegistrationID ?>
		<td <?php echo $self_registration_delete->SelfRegistrationID->cellAttributes() ?>>
<span id="el<?php echo $self_registration_delete->RowCount ?>_self_registration_SelfRegistrationID" class="self_registration_SelfRegistrationID">
<span<?php echo $self_registration_delete->SelfRegistrationID->viewAttributes() ?>><?php echo $self_registration_delete->SelfRegistrationID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($self_registration_delete->EmployeeID->Visible) { // EmployeeID ?>
		<td <?php echo $self_registration_delete->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $self_registration_delete->RowCount ?>_self_registration_EmployeeID" class="self_registration_EmployeeID">
<span<?php echo $self_registration_delete->EmployeeID->viewAttributes() ?>><?php echo $self_registration_delete->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($self_registration_delete->NRC->Visible) { // NRC ?>
		<td <?php echo $self_registration_delete->NRC->cellAttributes() ?>>
<span id="el<?php echo $self_registration_delete->RowCount ?>_self_registration_NRC" class="self_registration_NRC">
<span<?php echo $self_registration_delete->NRC->viewAttributes() ?>><?php echo $self_registration_delete->NRC->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$self_registration_delete->Recordset->moveNext();
}
$self_registration_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $self_registration_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$self_registration_delete->showPageFooter();
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
$self_registration_delete->terminate();
?>