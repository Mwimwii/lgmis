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
$ytd_gross_list = new ytd_gross_list();

// Run the page
$ytd_gross_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ytd_gross_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ytd_gross_list->isExport()) { ?>
<script>
var fytd_grosslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fytd_grosslist = currentForm = new ew.Form("fytd_grosslist", "list");
	fytd_grosslist.formKeyCountName = '<?php echo $ytd_gross_list->FormKeyCountName ?>';
	loadjs.done("fytd_grosslist");
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
<?php if (!$ytd_gross_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ytd_gross_list->TotalRecords > 0 && $ytd_gross_list->ExportOptions->visible()) { ?>
<?php $ytd_gross_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ytd_gross_list->ImportOptions->visible()) { ?>
<?php $ytd_gross_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ytd_gross_list->renderOtherOptions();
?>
<?php $ytd_gross_list->showPageHeader(); ?>
<?php
$ytd_gross_list->showMessage();
?>
<?php if ($ytd_gross_list->TotalRecords > 0 || $ytd_gross->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ytd_gross_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ytd_gross">
<?php if (!$ytd_gross_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ytd_gross_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ytd_gross_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ytd_gross_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fytd_grosslist" id="fytd_grosslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ytd_gross">
<div id="gmp_ytd_gross" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ytd_gross_list->TotalRecords > 0 || $ytd_gross_list->isGridEdit()) { ?>
<table id="tbl_ytd_grosslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ytd_gross->RowType = ROWTYPE_HEADER;

// Render list options
$ytd_gross_list->renderListOptions();

// Render list options (header, left)
$ytd_gross_list->ListOptions->render("header", "left");
?>
<?php if ($ytd_gross_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($ytd_gross_list->SortUrl($ytd_gross_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $ytd_gross_list->EmployeeID->headerCellClass() ?>"><div id="elh_ytd_gross_EmployeeID" class="ytd_gross_EmployeeID"><div class="ew-table-header-caption"><?php echo $ytd_gross_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $ytd_gross_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ytd_gross_list->SortUrl($ytd_gross_list->EmployeeID) ?>', 1);"><div id="elh_ytd_gross_EmployeeID" class="ytd_gross_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ytd_gross_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($ytd_gross_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ytd_gross_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ytd_gross_list->ytd_gross->Visible) { // ytd_gross ?>
	<?php if ($ytd_gross_list->SortUrl($ytd_gross_list->ytd_gross) == "") { ?>
		<th data-name="ytd_gross" class="<?php echo $ytd_gross_list->ytd_gross->headerCellClass() ?>"><div id="elh_ytd_gross_ytd_gross" class="ytd_gross_ytd_gross"><div class="ew-table-header-caption"><?php echo $ytd_gross_list->ytd_gross->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ytd_gross" class="<?php echo $ytd_gross_list->ytd_gross->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ytd_gross_list->SortUrl($ytd_gross_list->ytd_gross) ?>', 1);"><div id="elh_ytd_gross_ytd_gross" class="ytd_gross_ytd_gross">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ytd_gross_list->ytd_gross->caption() ?></span><span class="ew-table-header-sort"><?php if ($ytd_gross_list->ytd_gross->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ytd_gross_list->ytd_gross->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ytd_gross_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ytd_gross_list->ExportAll && $ytd_gross_list->isExport()) {
	$ytd_gross_list->StopRecord = $ytd_gross_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ytd_gross_list->TotalRecords > $ytd_gross_list->StartRecord + $ytd_gross_list->DisplayRecords - 1)
		$ytd_gross_list->StopRecord = $ytd_gross_list->StartRecord + $ytd_gross_list->DisplayRecords - 1;
	else
		$ytd_gross_list->StopRecord = $ytd_gross_list->TotalRecords;
}
$ytd_gross_list->RecordCount = $ytd_gross_list->StartRecord - 1;
if ($ytd_gross_list->Recordset && !$ytd_gross_list->Recordset->EOF) {
	$ytd_gross_list->Recordset->moveFirst();
	$selectLimit = $ytd_gross_list->UseSelectLimit;
	if (!$selectLimit && $ytd_gross_list->StartRecord > 1)
		$ytd_gross_list->Recordset->move($ytd_gross_list->StartRecord - 1);
} elseif (!$ytd_gross->AllowAddDeleteRow && $ytd_gross_list->StopRecord == 0) {
	$ytd_gross_list->StopRecord = $ytd_gross->GridAddRowCount;
}

// Initialize aggregate
$ytd_gross->RowType = ROWTYPE_AGGREGATEINIT;
$ytd_gross->resetAttributes();
$ytd_gross_list->renderRow();
while ($ytd_gross_list->RecordCount < $ytd_gross_list->StopRecord) {
	$ytd_gross_list->RecordCount++;
	if ($ytd_gross_list->RecordCount >= $ytd_gross_list->StartRecord) {
		$ytd_gross_list->RowCount++;

		// Set up key count
		$ytd_gross_list->KeyCount = $ytd_gross_list->RowIndex;

		// Init row class and style
		$ytd_gross->resetAttributes();
		$ytd_gross->CssClass = "";
		if ($ytd_gross_list->isGridAdd()) {
		} else {
			$ytd_gross_list->loadRowValues($ytd_gross_list->Recordset); // Load row values
		}
		$ytd_gross->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ytd_gross->RowAttrs->merge(["data-rowindex" => $ytd_gross_list->RowCount, "id" => "r" . $ytd_gross_list->RowCount . "_ytd_gross", "data-rowtype" => $ytd_gross->RowType]);

		// Render row
		$ytd_gross_list->renderRow();

		// Render list options
		$ytd_gross_list->renderListOptions();
?>
	<tr <?php echo $ytd_gross->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ytd_gross_list->ListOptions->render("body", "left", $ytd_gross_list->RowCount);
?>
	<?php if ($ytd_gross_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $ytd_gross_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $ytd_gross_list->RowCount ?>_ytd_gross_EmployeeID">
<span<?php echo $ytd_gross_list->EmployeeID->viewAttributes() ?>><?php echo $ytd_gross_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ytd_gross_list->ytd_gross->Visible) { // ytd_gross ?>
		<td data-name="ytd_gross" <?php echo $ytd_gross_list->ytd_gross->cellAttributes() ?>>
<span id="el<?php echo $ytd_gross_list->RowCount ?>_ytd_gross_ytd_gross">
<span<?php echo $ytd_gross_list->ytd_gross->viewAttributes() ?>><?php echo $ytd_gross_list->ytd_gross->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ytd_gross_list->ListOptions->render("body", "right", $ytd_gross_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ytd_gross_list->isGridAdd())
		$ytd_gross_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ytd_gross->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ytd_gross_list->Recordset)
	$ytd_gross_list->Recordset->Close();
?>
<?php if (!$ytd_gross_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ytd_gross_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ytd_gross_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ytd_gross_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ytd_gross_list->TotalRecords == 0 && !$ytd_gross->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ytd_gross_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ytd_gross_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ytd_gross_list->isExport()) { ?>
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
$ytd_gross_list->terminate();
?>