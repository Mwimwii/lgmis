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
$grand_total_income_list = new grand_total_income_list();

// Run the page
$grand_total_income_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grand_total_income_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$grand_total_income_list->isExport()) { ?>
<script>
var fgrand_total_incomelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgrand_total_incomelist = currentForm = new ew.Form("fgrand_total_incomelist", "list");
	fgrand_total_incomelist.formKeyCountName = '<?php echo $grand_total_income_list->FormKeyCountName ?>';
	loadjs.done("fgrand_total_incomelist");
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
<?php if (!$grand_total_income_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($grand_total_income_list->TotalRecords > 0 && $grand_total_income_list->ExportOptions->visible()) { ?>
<?php $grand_total_income_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($grand_total_income_list->ImportOptions->visible()) { ?>
<?php $grand_total_income_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$grand_total_income_list->renderOtherOptions();
?>
<?php $grand_total_income_list->showPageHeader(); ?>
<?php
$grand_total_income_list->showMessage();
?>
<?php if ($grand_total_income_list->TotalRecords > 0 || $grand_total_income->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($grand_total_income_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> grand_total_income">
<?php if (!$grand_total_income_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$grand_total_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grand_total_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $grand_total_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgrand_total_incomelist" id="fgrand_total_incomelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grand_total_income">
<div id="gmp_grand_total_income" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($grand_total_income_list->TotalRecords > 0 || $grand_total_income_list->isGridEdit()) { ?>
<table id="tbl_grand_total_incomelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$grand_total_income->RowType = ROWTYPE_HEADER;

// Render list options
$grand_total_income_list->renderListOptions();

// Render list options (header, left)
$grand_total_income_list->ListOptions->render("header", "left");
?>
<?php if ($grand_total_income_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($grand_total_income_list->SortUrl($grand_total_income_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $grand_total_income_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_grand_total_income_PayrollPeriod" class="grand_total_income_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $grand_total_income_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $grand_total_income_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grand_total_income_list->SortUrl($grand_total_income_list->PayrollPeriod) ?>', 1);"><div id="elh_grand_total_income_PayrollPeriod" class="grand_total_income_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grand_total_income_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($grand_total_income_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grand_total_income_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($grand_total_income_list->total_income->Visible) { // total_income ?>
	<?php if ($grand_total_income_list->SortUrl($grand_total_income_list->total_income) == "") { ?>
		<th data-name="total_income" class="<?php echo $grand_total_income_list->total_income->headerCellClass() ?>"><div id="elh_grand_total_income_total_income" class="grand_total_income_total_income"><div class="ew-table-header-caption"><?php echo $grand_total_income_list->total_income->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_income" class="<?php echo $grand_total_income_list->total_income->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grand_total_income_list->SortUrl($grand_total_income_list->total_income) ?>', 1);"><div id="elh_grand_total_income_total_income" class="grand_total_income_total_income">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grand_total_income_list->total_income->caption() ?></span><span class="ew-table-header-sort"><?php if ($grand_total_income_list->total_income->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grand_total_income_list->total_income->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$grand_total_income_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($grand_total_income_list->ExportAll && $grand_total_income_list->isExport()) {
	$grand_total_income_list->StopRecord = $grand_total_income_list->TotalRecords;
} else {

	// Set the last record to display
	if ($grand_total_income_list->TotalRecords > $grand_total_income_list->StartRecord + $grand_total_income_list->DisplayRecords - 1)
		$grand_total_income_list->StopRecord = $grand_total_income_list->StartRecord + $grand_total_income_list->DisplayRecords - 1;
	else
		$grand_total_income_list->StopRecord = $grand_total_income_list->TotalRecords;
}
$grand_total_income_list->RecordCount = $grand_total_income_list->StartRecord - 1;
if ($grand_total_income_list->Recordset && !$grand_total_income_list->Recordset->EOF) {
	$grand_total_income_list->Recordset->moveFirst();
	$selectLimit = $grand_total_income_list->UseSelectLimit;
	if (!$selectLimit && $grand_total_income_list->StartRecord > 1)
		$grand_total_income_list->Recordset->move($grand_total_income_list->StartRecord - 1);
} elseif (!$grand_total_income->AllowAddDeleteRow && $grand_total_income_list->StopRecord == 0) {
	$grand_total_income_list->StopRecord = $grand_total_income->GridAddRowCount;
}

// Initialize aggregate
$grand_total_income->RowType = ROWTYPE_AGGREGATEINIT;
$grand_total_income->resetAttributes();
$grand_total_income_list->renderRow();
while ($grand_total_income_list->RecordCount < $grand_total_income_list->StopRecord) {
	$grand_total_income_list->RecordCount++;
	if ($grand_total_income_list->RecordCount >= $grand_total_income_list->StartRecord) {
		$grand_total_income_list->RowCount++;

		// Set up key count
		$grand_total_income_list->KeyCount = $grand_total_income_list->RowIndex;

		// Init row class and style
		$grand_total_income->resetAttributes();
		$grand_total_income->CssClass = "";
		if ($grand_total_income_list->isGridAdd()) {
		} else {
			$grand_total_income_list->loadRowValues($grand_total_income_list->Recordset); // Load row values
		}
		$grand_total_income->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$grand_total_income->RowAttrs->merge(["data-rowindex" => $grand_total_income_list->RowCount, "id" => "r" . $grand_total_income_list->RowCount . "_grand_total_income", "data-rowtype" => $grand_total_income->RowType]);

		// Render row
		$grand_total_income_list->renderRow();

		// Render list options
		$grand_total_income_list->renderListOptions();
?>
	<tr <?php echo $grand_total_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$grand_total_income_list->ListOptions->render("body", "left", $grand_total_income_list->RowCount);
?>
	<?php if ($grand_total_income_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $grand_total_income_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $grand_total_income_list->RowCount ?>_grand_total_income_PayrollPeriod">
<span<?php echo $grand_total_income_list->PayrollPeriod->viewAttributes() ?>><?php echo $grand_total_income_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($grand_total_income_list->total_income->Visible) { // total_income ?>
		<td data-name="total_income" <?php echo $grand_total_income_list->total_income->cellAttributes() ?>>
<span id="el<?php echo $grand_total_income_list->RowCount ?>_grand_total_income_total_income">
<span<?php echo $grand_total_income_list->total_income->viewAttributes() ?>><?php echo $grand_total_income_list->total_income->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grand_total_income_list->ListOptions->render("body", "right", $grand_total_income_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$grand_total_income_list->isGridAdd())
		$grand_total_income_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$grand_total_income->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($grand_total_income_list->Recordset)
	$grand_total_income_list->Recordset->Close();
?>
<?php if (!$grand_total_income_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$grand_total_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grand_total_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $grand_total_income_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($grand_total_income_list->TotalRecords == 0 && !$grand_total_income->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $grand_total_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$grand_total_income_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$grand_total_income_list->isExport()) { ?>
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
$grand_total_income_list->terminate();
?>