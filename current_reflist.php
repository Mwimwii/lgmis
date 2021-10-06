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
$current_ref_list = new current_ref_list();

// Run the page
$current_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$current_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$current_ref_list->isExport()) { ?>
<script>
var fcurrent_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcurrent_reflist = currentForm = new ew.Form("fcurrent_reflist", "list");
	fcurrent_reflist.formKeyCountName = '<?php echo $current_ref_list->FormKeyCountName ?>';
	loadjs.done("fcurrent_reflist");
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
<?php if (!$current_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($current_ref_list->TotalRecords > 0 && $current_ref_list->ExportOptions->visible()) { ?>
<?php $current_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($current_ref_list->ImportOptions->visible()) { ?>
<?php $current_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$current_ref_list->renderOtherOptions();
?>
<?php $current_ref_list->showPageHeader(); ?>
<?php
$current_ref_list->showMessage();
?>
<?php if ($current_ref_list->TotalRecords > 0 || $current_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($current_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> current_ref">
<?php if (!$current_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$current_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $current_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $current_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcurrent_reflist" id="fcurrent_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="current_ref">
<div id="gmp_current_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($current_ref_list->TotalRecords > 0 || $current_ref_list->isGridEdit()) { ?>
<table id="tbl_current_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$current_ref->RowType = ROWTYPE_HEADER;

// Render list options
$current_ref_list->renderListOptions();

// Render list options (header, left)
$current_ref_list->ListOptions->render("header", "left");
?>
<?php if ($current_ref_list->PlanYear->Visible) { // PlanYear ?>
	<?php if ($current_ref_list->SortUrl($current_ref_list->PlanYear) == "") { ?>
		<th data-name="PlanYear" class="<?php echo $current_ref_list->PlanYear->headerCellClass() ?>"><div id="elh_current_ref_PlanYear" class="current_ref_PlanYear"><div class="ew-table-header-caption"><?php echo $current_ref_list->PlanYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlanYear" class="<?php echo $current_ref_list->PlanYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_ref_list->SortUrl($current_ref_list->PlanYear) ?>', 1);"><div id="elh_current_ref_PlanYear" class="current_ref_PlanYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_ref_list->PlanYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($current_ref_list->PlanYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_ref_list->PlanYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($current_ref_list->DaysAfterMonthEnd->Visible) { // DaysAfterMonthEnd ?>
	<?php if ($current_ref_list->SortUrl($current_ref_list->DaysAfterMonthEnd) == "") { ?>
		<th data-name="DaysAfterMonthEnd" class="<?php echo $current_ref_list->DaysAfterMonthEnd->headerCellClass() ?>"><div id="elh_current_ref_DaysAfterMonthEnd" class="current_ref_DaysAfterMonthEnd"><div class="ew-table-header-caption"><?php echo $current_ref_list->DaysAfterMonthEnd->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DaysAfterMonthEnd" class="<?php echo $current_ref_list->DaysAfterMonthEnd->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_ref_list->SortUrl($current_ref_list->DaysAfterMonthEnd) ?>', 1);"><div id="elh_current_ref_DaysAfterMonthEnd" class="current_ref_DaysAfterMonthEnd">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_ref_list->DaysAfterMonthEnd->caption() ?></span><span class="ew-table-header-sort"><?php if ($current_ref_list->DaysAfterMonthEnd->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_ref_list->DaysAfterMonthEnd->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($current_ref_list->PlanClosingDate->Visible) { // PlanClosingDate ?>
	<?php if ($current_ref_list->SortUrl($current_ref_list->PlanClosingDate) == "") { ?>
		<th data-name="PlanClosingDate" class="<?php echo $current_ref_list->PlanClosingDate->headerCellClass() ?>"><div id="elh_current_ref_PlanClosingDate" class="current_ref_PlanClosingDate"><div class="ew-table-header-caption"><?php echo $current_ref_list->PlanClosingDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlanClosingDate" class="<?php echo $current_ref_list->PlanClosingDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_ref_list->SortUrl($current_ref_list->PlanClosingDate) ?>', 1);"><div id="elh_current_ref_PlanClosingDate" class="current_ref_PlanClosingDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_ref_list->PlanClosingDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($current_ref_list->PlanClosingDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_ref_list->PlanClosingDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($current_ref_list->CurrentMonthClosingDate->Visible) { // CurrentMonthClosingDate ?>
	<?php if ($current_ref_list->SortUrl($current_ref_list->CurrentMonthClosingDate) == "") { ?>
		<th data-name="CurrentMonthClosingDate" class="<?php echo $current_ref_list->CurrentMonthClosingDate->headerCellClass() ?>"><div id="elh_current_ref_CurrentMonthClosingDate" class="current_ref_CurrentMonthClosingDate"><div class="ew-table-header-caption"><?php echo $current_ref_list->CurrentMonthClosingDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentMonthClosingDate" class="<?php echo $current_ref_list->CurrentMonthClosingDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_ref_list->SortUrl($current_ref_list->CurrentMonthClosingDate) ?>', 1);"><div id="elh_current_ref_CurrentMonthClosingDate" class="current_ref_CurrentMonthClosingDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_ref_list->CurrentMonthClosingDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($current_ref_list->CurrentMonthClosingDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_ref_list->CurrentMonthClosingDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$current_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($current_ref_list->ExportAll && $current_ref_list->isExport()) {
	$current_ref_list->StopRecord = $current_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($current_ref_list->TotalRecords > $current_ref_list->StartRecord + $current_ref_list->DisplayRecords - 1)
		$current_ref_list->StopRecord = $current_ref_list->StartRecord + $current_ref_list->DisplayRecords - 1;
	else
		$current_ref_list->StopRecord = $current_ref_list->TotalRecords;
}
$current_ref_list->RecordCount = $current_ref_list->StartRecord - 1;
if ($current_ref_list->Recordset && !$current_ref_list->Recordset->EOF) {
	$current_ref_list->Recordset->moveFirst();
	$selectLimit = $current_ref_list->UseSelectLimit;
	if (!$selectLimit && $current_ref_list->StartRecord > 1)
		$current_ref_list->Recordset->move($current_ref_list->StartRecord - 1);
} elseif (!$current_ref->AllowAddDeleteRow && $current_ref_list->StopRecord == 0) {
	$current_ref_list->StopRecord = $current_ref->GridAddRowCount;
}

// Initialize aggregate
$current_ref->RowType = ROWTYPE_AGGREGATEINIT;
$current_ref->resetAttributes();
$current_ref_list->renderRow();
while ($current_ref_list->RecordCount < $current_ref_list->StopRecord) {
	$current_ref_list->RecordCount++;
	if ($current_ref_list->RecordCount >= $current_ref_list->StartRecord) {
		$current_ref_list->RowCount++;

		// Set up key count
		$current_ref_list->KeyCount = $current_ref_list->RowIndex;

		// Init row class and style
		$current_ref->resetAttributes();
		$current_ref->CssClass = "";
		if ($current_ref_list->isGridAdd()) {
		} else {
			$current_ref_list->loadRowValues($current_ref_list->Recordset); // Load row values
		}
		$current_ref->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$current_ref->RowAttrs->merge(["data-rowindex" => $current_ref_list->RowCount, "id" => "r" . $current_ref_list->RowCount . "_current_ref", "data-rowtype" => $current_ref->RowType]);

		// Render row
		$current_ref_list->renderRow();

		// Render list options
		$current_ref_list->renderListOptions();
?>
	<tr <?php echo $current_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$current_ref_list->ListOptions->render("body", "left", $current_ref_list->RowCount);
?>
	<?php if ($current_ref_list->PlanYear->Visible) { // PlanYear ?>
		<td data-name="PlanYear" <?php echo $current_ref_list->PlanYear->cellAttributes() ?>>
<span id="el<?php echo $current_ref_list->RowCount ?>_current_ref_PlanYear">
<span<?php echo $current_ref_list->PlanYear->viewAttributes() ?>><?php echo $current_ref_list->PlanYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($current_ref_list->DaysAfterMonthEnd->Visible) { // DaysAfterMonthEnd ?>
		<td data-name="DaysAfterMonthEnd" <?php echo $current_ref_list->DaysAfterMonthEnd->cellAttributes() ?>>
<span id="el<?php echo $current_ref_list->RowCount ?>_current_ref_DaysAfterMonthEnd">
<span<?php echo $current_ref_list->DaysAfterMonthEnd->viewAttributes() ?>><?php echo $current_ref_list->DaysAfterMonthEnd->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($current_ref_list->PlanClosingDate->Visible) { // PlanClosingDate ?>
		<td data-name="PlanClosingDate" <?php echo $current_ref_list->PlanClosingDate->cellAttributes() ?>>
<span id="el<?php echo $current_ref_list->RowCount ?>_current_ref_PlanClosingDate">
<span<?php echo $current_ref_list->PlanClosingDate->viewAttributes() ?>><?php echo $current_ref_list->PlanClosingDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($current_ref_list->CurrentMonthClosingDate->Visible) { // CurrentMonthClosingDate ?>
		<td data-name="CurrentMonthClosingDate" <?php echo $current_ref_list->CurrentMonthClosingDate->cellAttributes() ?>>
<span id="el<?php echo $current_ref_list->RowCount ?>_current_ref_CurrentMonthClosingDate">
<span<?php echo $current_ref_list->CurrentMonthClosingDate->viewAttributes() ?>><?php echo $current_ref_list->CurrentMonthClosingDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$current_ref_list->ListOptions->render("body", "right", $current_ref_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$current_ref_list->isGridAdd())
		$current_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$current_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($current_ref_list->Recordset)
	$current_ref_list->Recordset->Close();
?>
<?php if (!$current_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$current_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $current_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $current_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($current_ref_list->TotalRecords == 0 && !$current_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $current_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$current_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$current_ref_list->isExport()) { ?>
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
$current_ref_list->terminate();
?>