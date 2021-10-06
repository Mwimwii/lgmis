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
$virtual_table_list = new virtual_table_list();

// Run the page
$virtual_table_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$virtual_table_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$virtual_table_list->isExport()) { ?>
<script>
var fvirtual_tablelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fvirtual_tablelist = currentForm = new ew.Form("fvirtual_tablelist", "list");
	fvirtual_tablelist.formKeyCountName = '<?php echo $virtual_table_list->FormKeyCountName ?>';
	loadjs.done("fvirtual_tablelist");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$virtual_table_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($virtual_table_list->TotalRecords > 0 && $virtual_table_list->ExportOptions->visible()) { ?>
<?php $virtual_table_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($virtual_table_list->ImportOptions->visible()) { ?>
<?php $virtual_table_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$virtual_table_list->renderOtherOptions();
?>
<?php $virtual_table_list->showPageHeader(); ?>
<?php
$virtual_table_list->showMessage();
?>
<?php if ($virtual_table_list->TotalRecords > 0 || $virtual_table->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($virtual_table_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> virtual_table">
<?php if (!$virtual_table_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$virtual_table_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $virtual_table_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $virtual_table_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvirtual_tablelist" id="fvirtual_tablelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="virtual_table">
<div id="gmp_virtual_table" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($virtual_table_list->TotalRecords > 0 || $virtual_table_list->isGridEdit()) { ?>
<table id="tbl_virtual_tablelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$virtual_table->RowType = ROWTYPE_HEADER;

// Render list options
$virtual_table_list->renderListOptions();

// Render list options (header, left)
$virtual_table_list->ListOptions->render("header", "left");
?>
<?php if ($virtual_table_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($virtual_table_list->SortUrl($virtual_table_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $virtual_table_list->EmployeeID->headerCellClass() ?>"><div id="elh_virtual_table_EmployeeID" class="virtual_table_EmployeeID"><div class="ew-table-header-caption"><?php echo $virtual_table_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $virtual_table_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $virtual_table_list->SortUrl($virtual_table_list->EmployeeID) ?>', 1);"><div id="elh_virtual_table_EmployeeID" class="virtual_table_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $virtual_table_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($virtual_table_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($virtual_table_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($virtual_table_list->Deductions->Visible) { // Deductions ?>
	<?php if ($virtual_table_list->SortUrl($virtual_table_list->Deductions) == "") { ?>
		<th data-name="Deductions" class="<?php echo $virtual_table_list->Deductions->headerCellClass() ?>"><div id="elh_virtual_table_Deductions" class="virtual_table_Deductions"><div class="ew-table-header-caption"><?php echo $virtual_table_list->Deductions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Deductions" class="<?php echo $virtual_table_list->Deductions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $virtual_table_list->SortUrl($virtual_table_list->Deductions) ?>', 1);"><div id="elh_virtual_table_Deductions" class="virtual_table_Deductions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $virtual_table_list->Deductions->caption() ?></span><span class="ew-table-header-sort"><?php if ($virtual_table_list->Deductions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($virtual_table_list->Deductions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$virtual_table_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($virtual_table_list->ExportAll && $virtual_table_list->isExport()) {
	$virtual_table_list->StopRecord = $virtual_table_list->TotalRecords;
} else {

	// Set the last record to display
	if ($virtual_table_list->TotalRecords > $virtual_table_list->StartRecord + $virtual_table_list->DisplayRecords - 1)
		$virtual_table_list->StopRecord = $virtual_table_list->StartRecord + $virtual_table_list->DisplayRecords - 1;
	else
		$virtual_table_list->StopRecord = $virtual_table_list->TotalRecords;
}
$virtual_table_list->RecordCount = $virtual_table_list->StartRecord - 1;
if ($virtual_table_list->Recordset && !$virtual_table_list->Recordset->EOF) {
	$virtual_table_list->Recordset->moveFirst();
	$selectLimit = $virtual_table_list->UseSelectLimit;
	if (!$selectLimit && $virtual_table_list->StartRecord > 1)
		$virtual_table_list->Recordset->move($virtual_table_list->StartRecord - 1);
} elseif (!$virtual_table->AllowAddDeleteRow && $virtual_table_list->StopRecord == 0) {
	$virtual_table_list->StopRecord = $virtual_table->GridAddRowCount;
}

// Initialize aggregate
$virtual_table->RowType = ROWTYPE_AGGREGATEINIT;
$virtual_table->resetAttributes();
$virtual_table_list->renderRow();
while ($virtual_table_list->RecordCount < $virtual_table_list->StopRecord) {
	$virtual_table_list->RecordCount++;
	if ($virtual_table_list->RecordCount >= $virtual_table_list->StartRecord) {
		$virtual_table_list->RowCount++;

		// Set up key count
		$virtual_table_list->KeyCount = $virtual_table_list->RowIndex;

		// Init row class and style
		$virtual_table->resetAttributes();
		$virtual_table->CssClass = "";
		if ($virtual_table_list->isGridAdd()) {
		} else {
			$virtual_table_list->loadRowValues($virtual_table_list->Recordset); // Load row values
		}
		$virtual_table->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$virtual_table->RowAttrs->merge(["data-rowindex" => $virtual_table_list->RowCount, "id" => "r" . $virtual_table_list->RowCount . "_virtual_table", "data-rowtype" => $virtual_table->RowType]);

		// Render row
		$virtual_table_list->renderRow();

		// Render list options
		$virtual_table_list->renderListOptions();
?>
	<tr <?php echo $virtual_table->rowAttributes() ?>>
<?php

// Render list options (body, left)
$virtual_table_list->ListOptions->render("body", "left", $virtual_table_list->RowCount);
?>
	<?php if ($virtual_table_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $virtual_table_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $virtual_table_list->RowCount ?>_virtual_table_EmployeeID">
<span<?php echo $virtual_table_list->EmployeeID->viewAttributes() ?>><?php echo $virtual_table_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($virtual_table_list->Deductions->Visible) { // Deductions ?>
		<td data-name="Deductions" <?php echo $virtual_table_list->Deductions->cellAttributes() ?>>
<span id="el<?php echo $virtual_table_list->RowCount ?>_virtual_table_Deductions">
<span<?php echo $virtual_table_list->Deductions->viewAttributes() ?>><?php echo $virtual_table_list->Deductions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$virtual_table_list->ListOptions->render("body", "right", $virtual_table_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$virtual_table_list->isGridAdd())
		$virtual_table_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$virtual_table->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($virtual_table_list->Recordset)
	$virtual_table_list->Recordset->Close();
?>
<?php if (!$virtual_table_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$virtual_table_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $virtual_table_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $virtual_table_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($virtual_table_list->TotalRecords == 0 && !$virtual_table->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $virtual_table_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$virtual_table_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$virtual_table_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$virtual_table_list->terminate();
?>