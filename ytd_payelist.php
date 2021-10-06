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
$ytd_paye_list = new ytd_paye_list();

// Run the page
$ytd_paye_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ytd_paye_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ytd_paye_list->isExport()) { ?>
<script>
var fytd_payelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fytd_payelist = currentForm = new ew.Form("fytd_payelist", "list");
	fytd_payelist.formKeyCountName = '<?php echo $ytd_paye_list->FormKeyCountName ?>';
	loadjs.done("fytd_payelist");
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
<?php if (!$ytd_paye_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ytd_paye_list->TotalRecords > 0 && $ytd_paye_list->ExportOptions->visible()) { ?>
<?php $ytd_paye_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ytd_paye_list->ImportOptions->visible()) { ?>
<?php $ytd_paye_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ytd_paye_list->renderOtherOptions();
?>
<?php $ytd_paye_list->showPageHeader(); ?>
<?php
$ytd_paye_list->showMessage();
?>
<?php if ($ytd_paye_list->TotalRecords > 0 || $ytd_paye->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ytd_paye_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ytd_paye">
<?php if (!$ytd_paye_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ytd_paye_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ytd_paye_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ytd_paye_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fytd_payelist" id="fytd_payelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ytd_paye">
<div id="gmp_ytd_paye" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ytd_paye_list->TotalRecords > 0 || $ytd_paye_list->isGridEdit()) { ?>
<table id="tbl_ytd_payelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ytd_paye->RowType = ROWTYPE_HEADER;

// Render list options
$ytd_paye_list->renderListOptions();

// Render list options (header, left)
$ytd_paye_list->ListOptions->render("header", "left");
?>
<?php if ($ytd_paye_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($ytd_paye_list->SortUrl($ytd_paye_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $ytd_paye_list->EmployeeID->headerCellClass() ?>"><div id="elh_ytd_paye_EmployeeID" class="ytd_paye_EmployeeID"><div class="ew-table-header-caption"><?php echo $ytd_paye_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $ytd_paye_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ytd_paye_list->SortUrl($ytd_paye_list->EmployeeID) ?>', 1);"><div id="elh_ytd_paye_EmployeeID" class="ytd_paye_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ytd_paye_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($ytd_paye_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ytd_paye_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ytd_paye_list->ytd_pay->Visible) { // ytd_pay ?>
	<?php if ($ytd_paye_list->SortUrl($ytd_paye_list->ytd_pay) == "") { ?>
		<th data-name="ytd_pay" class="<?php echo $ytd_paye_list->ytd_pay->headerCellClass() ?>"><div id="elh_ytd_paye_ytd_pay" class="ytd_paye_ytd_pay"><div class="ew-table-header-caption"><?php echo $ytd_paye_list->ytd_pay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ytd_pay" class="<?php echo $ytd_paye_list->ytd_pay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ytd_paye_list->SortUrl($ytd_paye_list->ytd_pay) ?>', 1);"><div id="elh_ytd_paye_ytd_pay" class="ytd_paye_ytd_pay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ytd_paye_list->ytd_pay->caption() ?></span><span class="ew-table-header-sort"><?php if ($ytd_paye_list->ytd_pay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ytd_paye_list->ytd_pay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ytd_paye_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ytd_paye_list->ExportAll && $ytd_paye_list->isExport()) {
	$ytd_paye_list->StopRecord = $ytd_paye_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ytd_paye_list->TotalRecords > $ytd_paye_list->StartRecord + $ytd_paye_list->DisplayRecords - 1)
		$ytd_paye_list->StopRecord = $ytd_paye_list->StartRecord + $ytd_paye_list->DisplayRecords - 1;
	else
		$ytd_paye_list->StopRecord = $ytd_paye_list->TotalRecords;
}
$ytd_paye_list->RecordCount = $ytd_paye_list->StartRecord - 1;
if ($ytd_paye_list->Recordset && !$ytd_paye_list->Recordset->EOF) {
	$ytd_paye_list->Recordset->moveFirst();
	$selectLimit = $ytd_paye_list->UseSelectLimit;
	if (!$selectLimit && $ytd_paye_list->StartRecord > 1)
		$ytd_paye_list->Recordset->move($ytd_paye_list->StartRecord - 1);
} elseif (!$ytd_paye->AllowAddDeleteRow && $ytd_paye_list->StopRecord == 0) {
	$ytd_paye_list->StopRecord = $ytd_paye->GridAddRowCount;
}

// Initialize aggregate
$ytd_paye->RowType = ROWTYPE_AGGREGATEINIT;
$ytd_paye->resetAttributes();
$ytd_paye_list->renderRow();
while ($ytd_paye_list->RecordCount < $ytd_paye_list->StopRecord) {
	$ytd_paye_list->RecordCount++;
	if ($ytd_paye_list->RecordCount >= $ytd_paye_list->StartRecord) {
		$ytd_paye_list->RowCount++;

		// Set up key count
		$ytd_paye_list->KeyCount = $ytd_paye_list->RowIndex;

		// Init row class and style
		$ytd_paye->resetAttributes();
		$ytd_paye->CssClass = "";
		if ($ytd_paye_list->isGridAdd()) {
		} else {
			$ytd_paye_list->loadRowValues($ytd_paye_list->Recordset); // Load row values
		}
		$ytd_paye->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ytd_paye->RowAttrs->merge(["data-rowindex" => $ytd_paye_list->RowCount, "id" => "r" . $ytd_paye_list->RowCount . "_ytd_paye", "data-rowtype" => $ytd_paye->RowType]);

		// Render row
		$ytd_paye_list->renderRow();

		// Render list options
		$ytd_paye_list->renderListOptions();
?>
	<tr <?php echo $ytd_paye->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ytd_paye_list->ListOptions->render("body", "left", $ytd_paye_list->RowCount);
?>
	<?php if ($ytd_paye_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $ytd_paye_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $ytd_paye_list->RowCount ?>_ytd_paye_EmployeeID">
<span<?php echo $ytd_paye_list->EmployeeID->viewAttributes() ?>><?php echo $ytd_paye_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ytd_paye_list->ytd_pay->Visible) { // ytd_pay ?>
		<td data-name="ytd_pay" <?php echo $ytd_paye_list->ytd_pay->cellAttributes() ?>>
<span id="el<?php echo $ytd_paye_list->RowCount ?>_ytd_paye_ytd_pay">
<span<?php echo $ytd_paye_list->ytd_pay->viewAttributes() ?>><?php echo $ytd_paye_list->ytd_pay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ytd_paye_list->ListOptions->render("body", "right", $ytd_paye_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ytd_paye_list->isGridAdd())
		$ytd_paye_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ytd_paye->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ytd_paye_list->Recordset)
	$ytd_paye_list->Recordset->Close();
?>
<?php if (!$ytd_paye_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ytd_paye_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ytd_paye_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ytd_paye_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ytd_paye_list->TotalRecords == 0 && !$ytd_paye->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ytd_paye_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ytd_paye_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ytd_paye_list->isExport()) { ?>
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
$ytd_paye_list->terminate();
?>