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
$employee_total_deductions_list = new employee_total_deductions_list();

// Run the page
$employee_total_deductions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employee_total_deductions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employee_total_deductions_list->isExport()) { ?>
<script>
var femployee_total_deductionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployee_total_deductionslist = currentForm = new ew.Form("femployee_total_deductionslist", "list");
	femployee_total_deductionslist.formKeyCountName = '<?php echo $employee_total_deductions_list->FormKeyCountName ?>';
	loadjs.done("femployee_total_deductionslist");
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
<?php if (!$employee_total_deductions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employee_total_deductions_list->TotalRecords > 0 && $employee_total_deductions_list->ExportOptions->visible()) { ?>
<?php $employee_total_deductions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employee_total_deductions_list->ImportOptions->visible()) { ?>
<?php $employee_total_deductions_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employee_total_deductions_list->renderOtherOptions();
?>
<?php $employee_total_deductions_list->showPageHeader(); ?>
<?php
$employee_total_deductions_list->showMessage();
?>
<?php if ($employee_total_deductions_list->TotalRecords > 0 || $employee_total_deductions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employee_total_deductions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employee_total_deductions">
<?php if (!$employee_total_deductions_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employee_total_deductions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_total_deductions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_total_deductions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployee_total_deductionslist" id="femployee_total_deductionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employee_total_deductions">
<div id="gmp_employee_total_deductions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employee_total_deductions_list->TotalRecords > 0 || $employee_total_deductions_list->isGridEdit()) { ?>
<table id="tbl_employee_total_deductionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employee_total_deductions->RowType = ROWTYPE_HEADER;

// Render list options
$employee_total_deductions_list->renderListOptions();

// Render list options (header, left)
$employee_total_deductions_list->ListOptions->render("header", "left");
?>
<?php if ($employee_total_deductions_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employee_total_deductions_list->SortUrl($employee_total_deductions_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_total_deductions_list->EmployeeID->headerCellClass() ?>"><div id="elh_employee_total_deductions_EmployeeID" class="employee_total_deductions_EmployeeID"><div class="ew-table-header-caption"><?php echo $employee_total_deductions_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employee_total_deductions_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_total_deductions_list->SortUrl($employee_total_deductions_list->EmployeeID) ?>', 1);"><div id="elh_employee_total_deductions_EmployeeID" class="employee_total_deductions_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_total_deductions_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_total_deductions_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_total_deductions_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employee_total_deductions_list->Deductions->Visible) { // Deductions ?>
	<?php if ($employee_total_deductions_list->SortUrl($employee_total_deductions_list->Deductions) == "") { ?>
		<th data-name="Deductions" class="<?php echo $employee_total_deductions_list->Deductions->headerCellClass() ?>"><div id="elh_employee_total_deductions_Deductions" class="employee_total_deductions_Deductions"><div class="ew-table-header-caption"><?php echo $employee_total_deductions_list->Deductions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Deductions" class="<?php echo $employee_total_deductions_list->Deductions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employee_total_deductions_list->SortUrl($employee_total_deductions_list->Deductions) ?>', 1);"><div id="elh_employee_total_deductions_Deductions" class="employee_total_deductions_Deductions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employee_total_deductions_list->Deductions->caption() ?></span><span class="ew-table-header-sort"><?php if ($employee_total_deductions_list->Deductions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employee_total_deductions_list->Deductions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employee_total_deductions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employee_total_deductions_list->ExportAll && $employee_total_deductions_list->isExport()) {
	$employee_total_deductions_list->StopRecord = $employee_total_deductions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employee_total_deductions_list->TotalRecords > $employee_total_deductions_list->StartRecord + $employee_total_deductions_list->DisplayRecords - 1)
		$employee_total_deductions_list->StopRecord = $employee_total_deductions_list->StartRecord + $employee_total_deductions_list->DisplayRecords - 1;
	else
		$employee_total_deductions_list->StopRecord = $employee_total_deductions_list->TotalRecords;
}
$employee_total_deductions_list->RecordCount = $employee_total_deductions_list->StartRecord - 1;
if ($employee_total_deductions_list->Recordset && !$employee_total_deductions_list->Recordset->EOF) {
	$employee_total_deductions_list->Recordset->moveFirst();
	$selectLimit = $employee_total_deductions_list->UseSelectLimit;
	if (!$selectLimit && $employee_total_deductions_list->StartRecord > 1)
		$employee_total_deductions_list->Recordset->move($employee_total_deductions_list->StartRecord - 1);
} elseif (!$employee_total_deductions->AllowAddDeleteRow && $employee_total_deductions_list->StopRecord == 0) {
	$employee_total_deductions_list->StopRecord = $employee_total_deductions->GridAddRowCount;
}

// Initialize aggregate
$employee_total_deductions->RowType = ROWTYPE_AGGREGATEINIT;
$employee_total_deductions->resetAttributes();
$employee_total_deductions_list->renderRow();
while ($employee_total_deductions_list->RecordCount < $employee_total_deductions_list->StopRecord) {
	$employee_total_deductions_list->RecordCount++;
	if ($employee_total_deductions_list->RecordCount >= $employee_total_deductions_list->StartRecord) {
		$employee_total_deductions_list->RowCount++;

		// Set up key count
		$employee_total_deductions_list->KeyCount = $employee_total_deductions_list->RowIndex;

		// Init row class and style
		$employee_total_deductions->resetAttributes();
		$employee_total_deductions->CssClass = "";
		if ($employee_total_deductions_list->isGridAdd()) {
		} else {
			$employee_total_deductions_list->loadRowValues($employee_total_deductions_list->Recordset); // Load row values
		}
		$employee_total_deductions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employee_total_deductions->RowAttrs->merge(["data-rowindex" => $employee_total_deductions_list->RowCount, "id" => "r" . $employee_total_deductions_list->RowCount . "_employee_total_deductions", "data-rowtype" => $employee_total_deductions->RowType]);

		// Render row
		$employee_total_deductions_list->renderRow();

		// Render list options
		$employee_total_deductions_list->renderListOptions();
?>
	<tr <?php echo $employee_total_deductions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employee_total_deductions_list->ListOptions->render("body", "left", $employee_total_deductions_list->RowCount);
?>
	<?php if ($employee_total_deductions_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employee_total_deductions_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employee_total_deductions_list->RowCount ?>_employee_total_deductions_EmployeeID">
<span<?php echo $employee_total_deductions_list->EmployeeID->viewAttributes() ?>><?php echo $employee_total_deductions_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employee_total_deductions_list->Deductions->Visible) { // Deductions ?>
		<td data-name="Deductions" <?php echo $employee_total_deductions_list->Deductions->cellAttributes() ?>>
<span id="el<?php echo $employee_total_deductions_list->RowCount ?>_employee_total_deductions_Deductions">
<span<?php echo $employee_total_deductions_list->Deductions->viewAttributes() ?>><?php echo $employee_total_deductions_list->Deductions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employee_total_deductions_list->ListOptions->render("body", "right", $employee_total_deductions_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$employee_total_deductions_list->isGridAdd())
		$employee_total_deductions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$employee_total_deductions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employee_total_deductions_list->Recordset)
	$employee_total_deductions_list->Recordset->Close();
?>
<?php if (!$employee_total_deductions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employee_total_deductions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employee_total_deductions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employee_total_deductions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employee_total_deductions_list->TotalRecords == 0 && !$employee_total_deductions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employee_total_deductions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employee_total_deductions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employee_total_deductions_list->isExport()) { ?>
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
$employee_total_deductions_list->terminate();
?>