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
$gross_deduction_list = new gross_deduction_list();

// Run the page
$gross_deduction_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gross_deduction_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gross_deduction_list->isExport()) { ?>
<script>
var fgross_deductionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgross_deductionlist = currentForm = new ew.Form("fgross_deductionlist", "list");
	fgross_deductionlist.formKeyCountName = '<?php echo $gross_deduction_list->FormKeyCountName ?>';
	loadjs.done("fgross_deductionlist");
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
<?php if (!$gross_deduction_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gross_deduction_list->TotalRecords > 0 && $gross_deduction_list->ExportOptions->visible()) { ?>
<?php $gross_deduction_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gross_deduction_list->ImportOptions->visible()) { ?>
<?php $gross_deduction_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gross_deduction_list->renderOtherOptions();
?>
<?php $gross_deduction_list->showPageHeader(); ?>
<?php
$gross_deduction_list->showMessage();
?>
<?php if ($gross_deduction_list->TotalRecords > 0 || $gross_deduction->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gross_deduction_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gross_deduction">
<?php if (!$gross_deduction_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gross_deduction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gross_deduction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gross_deduction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgross_deductionlist" id="fgross_deductionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gross_deduction">
<div id="gmp_gross_deduction" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gross_deduction_list->TotalRecords > 0 || $gross_deduction_list->isGridEdit()) { ?>
<table id="tbl_gross_deductionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gross_deduction->RowType = ROWTYPE_HEADER;

// Render list options
$gross_deduction_list->renderListOptions();

// Render list options (header, left)
$gross_deduction_list->ListOptions->render("header", "left");
?>
<?php if ($gross_deduction_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($gross_deduction_list->SortUrl($gross_deduction_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $gross_deduction_list->EmployeeID->headerCellClass() ?>"><div id="elh_gross_deduction_EmployeeID" class="gross_deduction_EmployeeID"><div class="ew-table-header-caption"><?php echo $gross_deduction_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $gross_deduction_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gross_deduction_list->SortUrl($gross_deduction_list->EmployeeID) ?>', 1);"><div id="elh_gross_deduction_EmployeeID" class="gross_deduction_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gross_deduction_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($gross_deduction_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gross_deduction_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gross_deduction_list->total_deduction->Visible) { // total_deduction ?>
	<?php if ($gross_deduction_list->SortUrl($gross_deduction_list->total_deduction) == "") { ?>
		<th data-name="total_deduction" class="<?php echo $gross_deduction_list->total_deduction->headerCellClass() ?>"><div id="elh_gross_deduction_total_deduction" class="gross_deduction_total_deduction"><div class="ew-table-header-caption"><?php echo $gross_deduction_list->total_deduction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_deduction" class="<?php echo $gross_deduction_list->total_deduction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gross_deduction_list->SortUrl($gross_deduction_list->total_deduction) ?>', 1);"><div id="elh_gross_deduction_total_deduction" class="gross_deduction_total_deduction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gross_deduction_list->total_deduction->caption() ?></span><span class="ew-table-header-sort"><?php if ($gross_deduction_list->total_deduction->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gross_deduction_list->total_deduction->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gross_deduction_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gross_deduction_list->ExportAll && $gross_deduction_list->isExport()) {
	$gross_deduction_list->StopRecord = $gross_deduction_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gross_deduction_list->TotalRecords > $gross_deduction_list->StartRecord + $gross_deduction_list->DisplayRecords - 1)
		$gross_deduction_list->StopRecord = $gross_deduction_list->StartRecord + $gross_deduction_list->DisplayRecords - 1;
	else
		$gross_deduction_list->StopRecord = $gross_deduction_list->TotalRecords;
}
$gross_deduction_list->RecordCount = $gross_deduction_list->StartRecord - 1;
if ($gross_deduction_list->Recordset && !$gross_deduction_list->Recordset->EOF) {
	$gross_deduction_list->Recordset->moveFirst();
	$selectLimit = $gross_deduction_list->UseSelectLimit;
	if (!$selectLimit && $gross_deduction_list->StartRecord > 1)
		$gross_deduction_list->Recordset->move($gross_deduction_list->StartRecord - 1);
} elseif (!$gross_deduction->AllowAddDeleteRow && $gross_deduction_list->StopRecord == 0) {
	$gross_deduction_list->StopRecord = $gross_deduction->GridAddRowCount;
}

// Initialize aggregate
$gross_deduction->RowType = ROWTYPE_AGGREGATEINIT;
$gross_deduction->resetAttributes();
$gross_deduction_list->renderRow();
while ($gross_deduction_list->RecordCount < $gross_deduction_list->StopRecord) {
	$gross_deduction_list->RecordCount++;
	if ($gross_deduction_list->RecordCount >= $gross_deduction_list->StartRecord) {
		$gross_deduction_list->RowCount++;

		// Set up key count
		$gross_deduction_list->KeyCount = $gross_deduction_list->RowIndex;

		// Init row class and style
		$gross_deduction->resetAttributes();
		$gross_deduction->CssClass = "";
		if ($gross_deduction_list->isGridAdd()) {
		} else {
			$gross_deduction_list->loadRowValues($gross_deduction_list->Recordset); // Load row values
		}
		$gross_deduction->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gross_deduction->RowAttrs->merge(["data-rowindex" => $gross_deduction_list->RowCount, "id" => "r" . $gross_deduction_list->RowCount . "_gross_deduction", "data-rowtype" => $gross_deduction->RowType]);

		// Render row
		$gross_deduction_list->renderRow();

		// Render list options
		$gross_deduction_list->renderListOptions();
?>
	<tr <?php echo $gross_deduction->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gross_deduction_list->ListOptions->render("body", "left", $gross_deduction_list->RowCount);
?>
	<?php if ($gross_deduction_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $gross_deduction_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $gross_deduction_list->RowCount ?>_gross_deduction_EmployeeID">
<span<?php echo $gross_deduction_list->EmployeeID->viewAttributes() ?>><?php echo $gross_deduction_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gross_deduction_list->total_deduction->Visible) { // total_deduction ?>
		<td data-name="total_deduction" <?php echo $gross_deduction_list->total_deduction->cellAttributes() ?>>
<span id="el<?php echo $gross_deduction_list->RowCount ?>_gross_deduction_total_deduction">
<span<?php echo $gross_deduction_list->total_deduction->viewAttributes() ?>><?php echo $gross_deduction_list->total_deduction->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gross_deduction_list->ListOptions->render("body", "right", $gross_deduction_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gross_deduction_list->isGridAdd())
		$gross_deduction_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gross_deduction->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gross_deduction_list->Recordset)
	$gross_deduction_list->Recordset->Close();
?>
<?php if (!$gross_deduction_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gross_deduction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gross_deduction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gross_deduction_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gross_deduction_list->TotalRecords == 0 && !$gross_deduction->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gross_deduction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gross_deduction_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gross_deduction_list->isExport()) { ?>
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
$gross_deduction_list->terminate();
?>