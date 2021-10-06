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
$grand_total_deduction_list = new grand_total_deduction_list();

// Run the page
$grand_total_deduction_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grand_total_deduction_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$grand_total_deduction_list->isExport()) { ?>
<script>
var fgrand_total_deductionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgrand_total_deductionlist = currentForm = new ew.Form("fgrand_total_deductionlist", "list");
	fgrand_total_deductionlist.formKeyCountName = '<?php echo $grand_total_deduction_list->FormKeyCountName ?>';
	loadjs.done("fgrand_total_deductionlist");
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
<?php if (!$grand_total_deduction_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($grand_total_deduction_list->TotalRecords > 0 && $grand_total_deduction_list->ExportOptions->visible()) { ?>
<?php $grand_total_deduction_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($grand_total_deduction_list->ImportOptions->visible()) { ?>
<?php $grand_total_deduction_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$grand_total_deduction_list->renderOtherOptions();
?>
<?php $grand_total_deduction_list->showPageHeader(); ?>
<?php
$grand_total_deduction_list->showMessage();
?>
<?php if ($grand_total_deduction_list->TotalRecords > 0 || $grand_total_deduction->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($grand_total_deduction_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> grand_total_deduction">
<?php if (!$grand_total_deduction_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$grand_total_deduction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grand_total_deduction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $grand_total_deduction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgrand_total_deductionlist" id="fgrand_total_deductionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grand_total_deduction">
<div id="gmp_grand_total_deduction" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($grand_total_deduction_list->TotalRecords > 0 || $grand_total_deduction_list->isGridEdit()) { ?>
<table id="tbl_grand_total_deductionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$grand_total_deduction->RowType = ROWTYPE_HEADER;

// Render list options
$grand_total_deduction_list->renderListOptions();

// Render list options (header, left)
$grand_total_deduction_list->ListOptions->render("header", "left");
?>
<?php if ($grand_total_deduction_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($grand_total_deduction_list->SortUrl($grand_total_deduction_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $grand_total_deduction_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_grand_total_deduction_PayrollPeriod" class="grand_total_deduction_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $grand_total_deduction_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $grand_total_deduction_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grand_total_deduction_list->SortUrl($grand_total_deduction_list->PayrollPeriod) ?>', 1);"><div id="elh_grand_total_deduction_PayrollPeriod" class="grand_total_deduction_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grand_total_deduction_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($grand_total_deduction_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grand_total_deduction_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($grand_total_deduction_list->total_deduction->Visible) { // total_deduction ?>
	<?php if ($grand_total_deduction_list->SortUrl($grand_total_deduction_list->total_deduction) == "") { ?>
		<th data-name="total_deduction" class="<?php echo $grand_total_deduction_list->total_deduction->headerCellClass() ?>"><div id="elh_grand_total_deduction_total_deduction" class="grand_total_deduction_total_deduction"><div class="ew-table-header-caption"><?php echo $grand_total_deduction_list->total_deduction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_deduction" class="<?php echo $grand_total_deduction_list->total_deduction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grand_total_deduction_list->SortUrl($grand_total_deduction_list->total_deduction) ?>', 1);"><div id="elh_grand_total_deduction_total_deduction" class="grand_total_deduction_total_deduction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grand_total_deduction_list->total_deduction->caption() ?></span><span class="ew-table-header-sort"><?php if ($grand_total_deduction_list->total_deduction->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grand_total_deduction_list->total_deduction->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$grand_total_deduction_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($grand_total_deduction_list->ExportAll && $grand_total_deduction_list->isExport()) {
	$grand_total_deduction_list->StopRecord = $grand_total_deduction_list->TotalRecords;
} else {

	// Set the last record to display
	if ($grand_total_deduction_list->TotalRecords > $grand_total_deduction_list->StartRecord + $grand_total_deduction_list->DisplayRecords - 1)
		$grand_total_deduction_list->StopRecord = $grand_total_deduction_list->StartRecord + $grand_total_deduction_list->DisplayRecords - 1;
	else
		$grand_total_deduction_list->StopRecord = $grand_total_deduction_list->TotalRecords;
}
$grand_total_deduction_list->RecordCount = $grand_total_deduction_list->StartRecord - 1;
if ($grand_total_deduction_list->Recordset && !$grand_total_deduction_list->Recordset->EOF) {
	$grand_total_deduction_list->Recordset->moveFirst();
	$selectLimit = $grand_total_deduction_list->UseSelectLimit;
	if (!$selectLimit && $grand_total_deduction_list->StartRecord > 1)
		$grand_total_deduction_list->Recordset->move($grand_total_deduction_list->StartRecord - 1);
} elseif (!$grand_total_deduction->AllowAddDeleteRow && $grand_total_deduction_list->StopRecord == 0) {
	$grand_total_deduction_list->StopRecord = $grand_total_deduction->GridAddRowCount;
}

// Initialize aggregate
$grand_total_deduction->RowType = ROWTYPE_AGGREGATEINIT;
$grand_total_deduction->resetAttributes();
$grand_total_deduction_list->renderRow();
while ($grand_total_deduction_list->RecordCount < $grand_total_deduction_list->StopRecord) {
	$grand_total_deduction_list->RecordCount++;
	if ($grand_total_deduction_list->RecordCount >= $grand_total_deduction_list->StartRecord) {
		$grand_total_deduction_list->RowCount++;

		// Set up key count
		$grand_total_deduction_list->KeyCount = $grand_total_deduction_list->RowIndex;

		// Init row class and style
		$grand_total_deduction->resetAttributes();
		$grand_total_deduction->CssClass = "";
		if ($grand_total_deduction_list->isGridAdd()) {
		} else {
			$grand_total_deduction_list->loadRowValues($grand_total_deduction_list->Recordset); // Load row values
		}
		$grand_total_deduction->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$grand_total_deduction->RowAttrs->merge(["data-rowindex" => $grand_total_deduction_list->RowCount, "id" => "r" . $grand_total_deduction_list->RowCount . "_grand_total_deduction", "data-rowtype" => $grand_total_deduction->RowType]);

		// Render row
		$grand_total_deduction_list->renderRow();

		// Render list options
		$grand_total_deduction_list->renderListOptions();
?>
	<tr <?php echo $grand_total_deduction->rowAttributes() ?>>
<?php

// Render list options (body, left)
$grand_total_deduction_list->ListOptions->render("body", "left", $grand_total_deduction_list->RowCount);
?>
	<?php if ($grand_total_deduction_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $grand_total_deduction_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $grand_total_deduction_list->RowCount ?>_grand_total_deduction_PayrollPeriod">
<span<?php echo $grand_total_deduction_list->PayrollPeriod->viewAttributes() ?>><?php echo $grand_total_deduction_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($grand_total_deduction_list->total_deduction->Visible) { // total_deduction ?>
		<td data-name="total_deduction" <?php echo $grand_total_deduction_list->total_deduction->cellAttributes() ?>>
<span id="el<?php echo $grand_total_deduction_list->RowCount ?>_grand_total_deduction_total_deduction">
<span<?php echo $grand_total_deduction_list->total_deduction->viewAttributes() ?>><?php echo $grand_total_deduction_list->total_deduction->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grand_total_deduction_list->ListOptions->render("body", "right", $grand_total_deduction_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$grand_total_deduction_list->isGridAdd())
		$grand_total_deduction_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$grand_total_deduction->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($grand_total_deduction_list->Recordset)
	$grand_total_deduction_list->Recordset->Close();
?>
<?php if (!$grand_total_deduction_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$grand_total_deduction_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grand_total_deduction_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $grand_total_deduction_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($grand_total_deduction_list->TotalRecords == 0 && !$grand_total_deduction->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $grand_total_deduction_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$grand_total_deduction_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$grand_total_deduction_list->isExport()) { ?>
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
$grand_total_deduction_list->terminate();
?>