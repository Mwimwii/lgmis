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
$board_type_delete = new board_type_delete();

// Run the page
$board_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fboard_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fboard_typedelete = currentForm = new ew.Form("fboard_typedelete", "delete");
	loadjs.done("fboard_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $board_type_delete->showPageHeader(); ?>
<?php
$board_type_delete->showMessage();
?>
<form name="fboard_typedelete" id="fboard_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($board_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($board_type_delete->BoardType->Visible) { // BoardType ?>
		<th class="<?php echo $board_type_delete->BoardType->headerCellClass() ?>"><span id="elh_board_type_BoardType" class="board_type_BoardType"><?php echo $board_type_delete->BoardType->caption() ?></span></th>
<?php } ?>
<?php if ($board_type_delete->BoardTypeDesc->Visible) { // BoardTypeDesc ?>
		<th class="<?php echo $board_type_delete->BoardTypeDesc->headerCellClass() ?>"><span id="elh_board_type_BoardTypeDesc" class="board_type_BoardTypeDesc"><?php echo $board_type_delete->BoardTypeDesc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$board_type_delete->RecordCount = 0;
$i = 0;
while (!$board_type_delete->Recordset->EOF) {
	$board_type_delete->RecordCount++;
	$board_type_delete->RowCount++;

	// Set row properties
	$board_type->resetAttributes();
	$board_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$board_type_delete->loadRowValues($board_type_delete->Recordset);

	// Render row
	$board_type_delete->renderRow();
?>
	<tr <?php echo $board_type->rowAttributes() ?>>
<?php if ($board_type_delete->BoardType->Visible) { // BoardType ?>
		<td <?php echo $board_type_delete->BoardType->cellAttributes() ?>>
<span id="el<?php echo $board_type_delete->RowCount ?>_board_type_BoardType" class="board_type_BoardType">
<span<?php echo $board_type_delete->BoardType->viewAttributes() ?>><?php echo $board_type_delete->BoardType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($board_type_delete->BoardTypeDesc->Visible) { // BoardTypeDesc ?>
		<td <?php echo $board_type_delete->BoardTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $board_type_delete->RowCount ?>_board_type_BoardTypeDesc" class="board_type_BoardTypeDesc">
<span<?php echo $board_type_delete->BoardTypeDesc->viewAttributes() ?>><?php echo $board_type_delete->BoardTypeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$board_type_delete->Recordset->moveNext();
}
$board_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $board_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$board_type_delete->showPageFooter();
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
$board_type_delete->terminate();
?>