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
$staffprofbodies_delete = new staffprofbodies_delete();

// Run the page
$staffprofbodies_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffprofbodiesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstaffprofbodiesdelete = currentForm = new ew.Form("fstaffprofbodiesdelete", "delete");
	loadjs.done("fstaffprofbodiesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffprofbodies_delete->showPageHeader(); ?>
<?php
$staffprofbodies_delete->showMessage();
?>
<form name="fstaffprofbodiesdelete" id="fstaffprofbodiesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffprofbodies">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($staffprofbodies_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($staffprofbodies_delete->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<th class="<?php echo $staffprofbodies_delete->ProfessionalBody->headerCellClass() ?>"><span id="elh_staffprofbodies_ProfessionalBody" class="staffprofbodies_ProfessionalBody"><?php echo $staffprofbodies_delete->ProfessionalBody->caption() ?></span></th>
<?php } ?>
<?php if ($staffprofbodies_delete->MembershipNo->Visible) { // MembershipNo ?>
		<th class="<?php echo $staffprofbodies_delete->MembershipNo->headerCellClass() ?>"><span id="elh_staffprofbodies_MembershipNo" class="staffprofbodies_MembershipNo"><?php echo $staffprofbodies_delete->MembershipNo->caption() ?></span></th>
<?php } ?>
<?php if ($staffprofbodies_delete->DateJoined->Visible) { // DateJoined ?>
		<th class="<?php echo $staffprofbodies_delete->DateJoined->headerCellClass() ?>"><span id="elh_staffprofbodies_DateJoined" class="staffprofbodies_DateJoined"><?php echo $staffprofbodies_delete->DateJoined->caption() ?></span></th>
<?php } ?>
<?php if ($staffprofbodies_delete->DateRenewed->Visible) { // DateRenewed ?>
		<th class="<?php echo $staffprofbodies_delete->DateRenewed->headerCellClass() ?>"><span id="elh_staffprofbodies_DateRenewed" class="staffprofbodies_DateRenewed"><?php echo $staffprofbodies_delete->DateRenewed->caption() ?></span></th>
<?php } ?>
<?php if ($staffprofbodies_delete->ValidTo->Visible) { // ValidTo ?>
		<th class="<?php echo $staffprofbodies_delete->ValidTo->headerCellClass() ?>"><span id="elh_staffprofbodies_ValidTo" class="staffprofbodies_ValidTo"><?php echo $staffprofbodies_delete->ValidTo->caption() ?></span></th>
<?php } ?>
<?php if ($staffprofbodies_delete->MemberStatus->Visible) { // MemberStatus ?>
		<th class="<?php echo $staffprofbodies_delete->MemberStatus->headerCellClass() ?>"><span id="elh_staffprofbodies_MemberStatus" class="staffprofbodies_MemberStatus"><?php echo $staffprofbodies_delete->MemberStatus->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$staffprofbodies_delete->RecordCount = 0;
$i = 0;
while (!$staffprofbodies_delete->Recordset->EOF) {
	$staffprofbodies_delete->RecordCount++;
	$staffprofbodies_delete->RowCount++;

	// Set row properties
	$staffprofbodies->resetAttributes();
	$staffprofbodies->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$staffprofbodies_delete->loadRowValues($staffprofbodies_delete->Recordset);

	// Render row
	$staffprofbodies_delete->renderRow();
?>
	<tr <?php echo $staffprofbodies->rowAttributes() ?>>
<?php if ($staffprofbodies_delete->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<td <?php echo $staffprofbodies_delete->ProfessionalBody->cellAttributes() ?>>
<span id="el<?php echo $staffprofbodies_delete->RowCount ?>_staffprofbodies_ProfessionalBody" class="staffprofbodies_ProfessionalBody">
<span<?php echo $staffprofbodies_delete->ProfessionalBody->viewAttributes() ?>><?php echo $staffprofbodies_delete->ProfessionalBody->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffprofbodies_delete->MembershipNo->Visible) { // MembershipNo ?>
		<td <?php echo $staffprofbodies_delete->MembershipNo->cellAttributes() ?>>
<span id="el<?php echo $staffprofbodies_delete->RowCount ?>_staffprofbodies_MembershipNo" class="staffprofbodies_MembershipNo">
<span<?php echo $staffprofbodies_delete->MembershipNo->viewAttributes() ?>><?php echo $staffprofbodies_delete->MembershipNo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffprofbodies_delete->DateJoined->Visible) { // DateJoined ?>
		<td <?php echo $staffprofbodies_delete->DateJoined->cellAttributes() ?>>
<span id="el<?php echo $staffprofbodies_delete->RowCount ?>_staffprofbodies_DateJoined" class="staffprofbodies_DateJoined">
<span<?php echo $staffprofbodies_delete->DateJoined->viewAttributes() ?>><?php echo $staffprofbodies_delete->DateJoined->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffprofbodies_delete->DateRenewed->Visible) { // DateRenewed ?>
		<td <?php echo $staffprofbodies_delete->DateRenewed->cellAttributes() ?>>
<span id="el<?php echo $staffprofbodies_delete->RowCount ?>_staffprofbodies_DateRenewed" class="staffprofbodies_DateRenewed">
<span<?php echo $staffprofbodies_delete->DateRenewed->viewAttributes() ?>><?php echo $staffprofbodies_delete->DateRenewed->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffprofbodies_delete->ValidTo->Visible) { // ValidTo ?>
		<td <?php echo $staffprofbodies_delete->ValidTo->cellAttributes() ?>>
<span id="el<?php echo $staffprofbodies_delete->RowCount ?>_staffprofbodies_ValidTo" class="staffprofbodies_ValidTo">
<span<?php echo $staffprofbodies_delete->ValidTo->viewAttributes() ?>><?php echo $staffprofbodies_delete->ValidTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($staffprofbodies_delete->MemberStatus->Visible) { // MemberStatus ?>
		<td <?php echo $staffprofbodies_delete->MemberStatus->cellAttributes() ?>>
<span id="el<?php echo $staffprofbodies_delete->RowCount ?>_staffprofbodies_MemberStatus" class="staffprofbodies_MemberStatus">
<span<?php echo $staffprofbodies_delete->MemberStatus->viewAttributes() ?>><?php echo $staffprofbodies_delete->MemberStatus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$staffprofbodies_delete->Recordset->moveNext();
}
$staffprofbodies_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffprofbodies_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$staffprofbodies_delete->showPageFooter();
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
$staffprofbodies_delete->terminate();
?>