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
$leave_accrual_ref_list = new leave_accrual_ref_list();

// Run the page
$leave_accrual_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_accrual_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_accrual_ref_list->isExport()) { ?>
<script>
var fleave_accrual_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fleave_accrual_reflist = currentForm = new ew.Form("fleave_accrual_reflist", "list");
	fleave_accrual_reflist.formKeyCountName = '<?php echo $leave_accrual_ref_list->FormKeyCountName ?>';
	loadjs.done("fleave_accrual_reflist");
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
<?php if (!$leave_accrual_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($leave_accrual_ref_list->TotalRecords > 0 && $leave_accrual_ref_list->ExportOptions->visible()) { ?>
<?php $leave_accrual_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_accrual_ref_list->ImportOptions->visible()) { ?>
<?php $leave_accrual_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$leave_accrual_ref_list->renderOtherOptions();
?>
<?php $leave_accrual_ref_list->showPageHeader(); ?>
<?php
$leave_accrual_ref_list->showMessage();
?>
<?php if ($leave_accrual_ref_list->TotalRecords > 0 || $leave_accrual_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_accrual_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_accrual_ref">
<?php if (!$leave_accrual_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$leave_accrual_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_accrual_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_accrual_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fleave_accrual_reflist" id="fleave_accrual_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_accrual_ref">
<div id="gmp_leave_accrual_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($leave_accrual_ref_list->TotalRecords > 0 || $leave_accrual_ref_list->isGridEdit()) { ?>
<table id="tbl_leave_accrual_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_accrual_ref->RowType = ROWTYPE_HEADER;

// Render list options
$leave_accrual_ref_list->renderListOptions();

// Render list options (header, left)
$leave_accrual_ref_list->ListOptions->render("header", "left");
?>
<?php if ($leave_accrual_ref_list->Division->Visible) { // Division ?>
	<?php if ($leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $leave_accrual_ref_list->Division->headerCellClass() ?>"><div id="elh_leave_accrual_ref_Division" class="leave_accrual_ref_Division"><div class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $leave_accrual_ref_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->Division) ?>', 1);"><div id="elh_leave_accrual_ref_Division" class="leave_accrual_ref_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrual_ref_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrual_ref_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrual_ref_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_accrual_ref_list->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_accrual_ref_LeaveTypeCode" class="leave_accrual_ref_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_accrual_ref_list->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->LeaveTypeCode) ?>', 1);"><div id="elh_leave_accrual_ref_LeaveTypeCode" class="leave_accrual_ref_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrual_ref_list->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrual_ref_list->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrual_ref_list->AnnualEntitled->Visible) { // AnnualEntitled ?>
	<?php if ($leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->AnnualEntitled) == "") { ?>
		<th data-name="AnnualEntitled" class="<?php echo $leave_accrual_ref_list->AnnualEntitled->headerCellClass() ?>"><div id="elh_leave_accrual_ref_AnnualEntitled" class="leave_accrual_ref_AnnualEntitled"><div class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->AnnualEntitled->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AnnualEntitled" class="<?php echo $leave_accrual_ref_list->AnnualEntitled->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->AnnualEntitled) ?>', 1);"><div id="elh_leave_accrual_ref_AnnualEntitled" class="leave_accrual_ref_AnnualEntitled">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->AnnualEntitled->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrual_ref_list->AnnualEntitled->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrual_ref_list->AnnualEntitled->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrual_ref_list->AnnualCarryover->Visible) { // AnnualCarryover ?>
	<?php if ($leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->AnnualCarryover) == "") { ?>
		<th data-name="AnnualCarryover" class="<?php echo $leave_accrual_ref_list->AnnualCarryover->headerCellClass() ?>"><div id="elh_leave_accrual_ref_AnnualCarryover" class="leave_accrual_ref_AnnualCarryover"><div class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->AnnualCarryover->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AnnualCarryover" class="<?php echo $leave_accrual_ref_list->AnnualCarryover->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->AnnualCarryover) ?>', 1);"><div id="elh_leave_accrual_ref_AnnualCarryover" class="leave_accrual_ref_AnnualCarryover">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->AnnualCarryover->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrual_ref_list->AnnualCarryover->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrual_ref_list->AnnualCarryover->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrual_ref_list->MaxLeaveTaken->Visible) { // MaxLeaveTaken ?>
	<?php if ($leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->MaxLeaveTaken) == "") { ?>
		<th data-name="MaxLeaveTaken" class="<?php echo $leave_accrual_ref_list->MaxLeaveTaken->headerCellClass() ?>"><div id="elh_leave_accrual_ref_MaxLeaveTaken" class="leave_accrual_ref_MaxLeaveTaken"><div class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->MaxLeaveTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaxLeaveTaken" class="<?php echo $leave_accrual_ref_list->MaxLeaveTaken->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrual_ref_list->SortUrl($leave_accrual_ref_list->MaxLeaveTaken) ?>', 1);"><div id="elh_leave_accrual_ref_MaxLeaveTaken" class="leave_accrual_ref_MaxLeaveTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrual_ref_list->MaxLeaveTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrual_ref_list->MaxLeaveTaken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrual_ref_list->MaxLeaveTaken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_accrual_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($leave_accrual_ref_list->ExportAll && $leave_accrual_ref_list->isExport()) {
	$leave_accrual_ref_list->StopRecord = $leave_accrual_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($leave_accrual_ref_list->TotalRecords > $leave_accrual_ref_list->StartRecord + $leave_accrual_ref_list->DisplayRecords - 1)
		$leave_accrual_ref_list->StopRecord = $leave_accrual_ref_list->StartRecord + $leave_accrual_ref_list->DisplayRecords - 1;
	else
		$leave_accrual_ref_list->StopRecord = $leave_accrual_ref_list->TotalRecords;
}
$leave_accrual_ref_list->RecordCount = $leave_accrual_ref_list->StartRecord - 1;
if ($leave_accrual_ref_list->Recordset && !$leave_accrual_ref_list->Recordset->EOF) {
	$leave_accrual_ref_list->Recordset->moveFirst();
	$selectLimit = $leave_accrual_ref_list->UseSelectLimit;
	if (!$selectLimit && $leave_accrual_ref_list->StartRecord > 1)
		$leave_accrual_ref_list->Recordset->move($leave_accrual_ref_list->StartRecord - 1);
} elseif (!$leave_accrual_ref->AllowAddDeleteRow && $leave_accrual_ref_list->StopRecord == 0) {
	$leave_accrual_ref_list->StopRecord = $leave_accrual_ref->GridAddRowCount;
}

// Initialize aggregate
$leave_accrual_ref->RowType = ROWTYPE_AGGREGATEINIT;
$leave_accrual_ref->resetAttributes();
$leave_accrual_ref_list->renderRow();
while ($leave_accrual_ref_list->RecordCount < $leave_accrual_ref_list->StopRecord) {
	$leave_accrual_ref_list->RecordCount++;
	if ($leave_accrual_ref_list->RecordCount >= $leave_accrual_ref_list->StartRecord) {
		$leave_accrual_ref_list->RowCount++;

		// Set up key count
		$leave_accrual_ref_list->KeyCount = $leave_accrual_ref_list->RowIndex;

		// Init row class and style
		$leave_accrual_ref->resetAttributes();
		$leave_accrual_ref->CssClass = "";
		if ($leave_accrual_ref_list->isGridAdd()) {
		} else {
			$leave_accrual_ref_list->loadRowValues($leave_accrual_ref_list->Recordset); // Load row values
		}
		$leave_accrual_ref->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$leave_accrual_ref->RowAttrs->merge(["data-rowindex" => $leave_accrual_ref_list->RowCount, "id" => "r" . $leave_accrual_ref_list->RowCount . "_leave_accrual_ref", "data-rowtype" => $leave_accrual_ref->RowType]);

		// Render row
		$leave_accrual_ref_list->renderRow();

		// Render list options
		$leave_accrual_ref_list->renderListOptions();
?>
	<tr <?php echo $leave_accrual_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_accrual_ref_list->ListOptions->render("body", "left", $leave_accrual_ref_list->RowCount);
?>
	<?php if ($leave_accrual_ref_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $leave_accrual_ref_list->Division->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_list->RowCount ?>_leave_accrual_ref_Division">
<span<?php echo $leave_accrual_ref_list->Division->viewAttributes() ?>><?php echo $leave_accrual_ref_list->Division->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrual_ref_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_accrual_ref_list->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_list->RowCount ?>_leave_accrual_ref_LeaveTypeCode">
<span<?php echo $leave_accrual_ref_list->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_accrual_ref_list->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrual_ref_list->AnnualEntitled->Visible) { // AnnualEntitled ?>
		<td data-name="AnnualEntitled" <?php echo $leave_accrual_ref_list->AnnualEntitled->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_list->RowCount ?>_leave_accrual_ref_AnnualEntitled">
<span<?php echo $leave_accrual_ref_list->AnnualEntitled->viewAttributes() ?>><?php echo $leave_accrual_ref_list->AnnualEntitled->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrual_ref_list->AnnualCarryover->Visible) { // AnnualCarryover ?>
		<td data-name="AnnualCarryover" <?php echo $leave_accrual_ref_list->AnnualCarryover->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_list->RowCount ?>_leave_accrual_ref_AnnualCarryover">
<span<?php echo $leave_accrual_ref_list->AnnualCarryover->viewAttributes() ?>><?php echo $leave_accrual_ref_list->AnnualCarryover->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrual_ref_list->MaxLeaveTaken->Visible) { // MaxLeaveTaken ?>
		<td data-name="MaxLeaveTaken" <?php echo $leave_accrual_ref_list->MaxLeaveTaken->cellAttributes() ?>>
<span id="el<?php echo $leave_accrual_ref_list->RowCount ?>_leave_accrual_ref_MaxLeaveTaken">
<span<?php echo $leave_accrual_ref_list->MaxLeaveTaken->viewAttributes() ?>><?php echo $leave_accrual_ref_list->MaxLeaveTaken->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_accrual_ref_list->ListOptions->render("body", "right", $leave_accrual_ref_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$leave_accrual_ref_list->isGridAdd())
		$leave_accrual_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$leave_accrual_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_accrual_ref_list->Recordset)
	$leave_accrual_ref_list->Recordset->Close();
?>
<?php if (!$leave_accrual_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$leave_accrual_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_accrual_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_accrual_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_accrual_ref_list->TotalRecords == 0 && !$leave_accrual_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_accrual_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$leave_accrual_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_accrual_ref_list->isExport()) { ?>
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
$leave_accrual_ref_list->terminate();
?>