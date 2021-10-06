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
$netpay_list = new netpay_list();

// Run the page
$netpay_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$netpay_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$netpay_list->isExport()) { ?>
<script>
var fnetpaylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fnetpaylist = currentForm = new ew.Form("fnetpaylist", "list");
	fnetpaylist.formKeyCountName = '<?php echo $netpay_list->FormKeyCountName ?>';
	loadjs.done("fnetpaylist");
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
<?php if (!$netpay_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($netpay_list->TotalRecords > 0 && $netpay_list->ExportOptions->visible()) { ?>
<?php $netpay_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($netpay_list->ImportOptions->visible()) { ?>
<?php $netpay_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$netpay_list->renderOtherOptions();
?>
<?php $netpay_list->showPageHeader(); ?>
<?php
$netpay_list->showMessage();
?>
<?php if ($netpay_list->TotalRecords > 0 || $netpay->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($netpay_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> netpay">
<?php if (!$netpay_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$netpay_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $netpay_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $netpay_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fnetpaylist" id="fnetpaylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="netpay">
<div id="gmp_netpay" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($netpay_list->TotalRecords > 0 || $netpay_list->isGridEdit()) { ?>
<table id="tbl_netpaylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$netpay->RowType = ROWTYPE_HEADER;

// Render list options
$netpay_list->renderListOptions();

// Render list options (header, left)
$netpay_list->ListOptions->render("header", "left");
?>
<?php if ($netpay_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($netpay_list->SortUrl($netpay_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $netpay_list->EmployeeID->headerCellClass() ?>"><div id="elh_netpay_EmployeeID" class="netpay_EmployeeID"><div class="ew-table-header-caption"><?php echo $netpay_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $netpay_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $netpay_list->SortUrl($netpay_list->EmployeeID) ?>', 1);"><div id="elh_netpay_EmployeeID" class="netpay_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $netpay_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($netpay_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($netpay_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($netpay_list->NETPAY->Visible) { // NETPAY ?>
	<?php if ($netpay_list->SortUrl($netpay_list->NETPAY) == "") { ?>
		<th data-name="NETPAY" class="<?php echo $netpay_list->NETPAY->headerCellClass() ?>"><div id="elh_netpay_NETPAY" class="netpay_NETPAY"><div class="ew-table-header-caption"><?php echo $netpay_list->NETPAY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NETPAY" class="<?php echo $netpay_list->NETPAY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $netpay_list->SortUrl($netpay_list->NETPAY) ?>', 1);"><div id="elh_netpay_NETPAY" class="netpay_NETPAY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $netpay_list->NETPAY->caption() ?></span><span class="ew-table-header-sort"><?php if ($netpay_list->NETPAY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($netpay_list->NETPAY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$netpay_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($netpay_list->ExportAll && $netpay_list->isExport()) {
	$netpay_list->StopRecord = $netpay_list->TotalRecords;
} else {

	// Set the last record to display
	if ($netpay_list->TotalRecords > $netpay_list->StartRecord + $netpay_list->DisplayRecords - 1)
		$netpay_list->StopRecord = $netpay_list->StartRecord + $netpay_list->DisplayRecords - 1;
	else
		$netpay_list->StopRecord = $netpay_list->TotalRecords;
}
$netpay_list->RecordCount = $netpay_list->StartRecord - 1;
if ($netpay_list->Recordset && !$netpay_list->Recordset->EOF) {
	$netpay_list->Recordset->moveFirst();
	$selectLimit = $netpay_list->UseSelectLimit;
	if (!$selectLimit && $netpay_list->StartRecord > 1)
		$netpay_list->Recordset->move($netpay_list->StartRecord - 1);
} elseif (!$netpay->AllowAddDeleteRow && $netpay_list->StopRecord == 0) {
	$netpay_list->StopRecord = $netpay->GridAddRowCount;
}

// Initialize aggregate
$netpay->RowType = ROWTYPE_AGGREGATEINIT;
$netpay->resetAttributes();
$netpay_list->renderRow();
while ($netpay_list->RecordCount < $netpay_list->StopRecord) {
	$netpay_list->RecordCount++;
	if ($netpay_list->RecordCount >= $netpay_list->StartRecord) {
		$netpay_list->RowCount++;

		// Set up key count
		$netpay_list->KeyCount = $netpay_list->RowIndex;

		// Init row class and style
		$netpay->resetAttributes();
		$netpay->CssClass = "";
		if ($netpay_list->isGridAdd()) {
		} else {
			$netpay_list->loadRowValues($netpay_list->Recordset); // Load row values
		}
		$netpay->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$netpay->RowAttrs->merge(["data-rowindex" => $netpay_list->RowCount, "id" => "r" . $netpay_list->RowCount . "_netpay", "data-rowtype" => $netpay->RowType]);

		// Render row
		$netpay_list->renderRow();

		// Render list options
		$netpay_list->renderListOptions();
?>
	<tr <?php echo $netpay->rowAttributes() ?>>
<?php

// Render list options (body, left)
$netpay_list->ListOptions->render("body", "left", $netpay_list->RowCount);
?>
	<?php if ($netpay_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $netpay_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $netpay_list->RowCount ?>_netpay_EmployeeID">
<span<?php echo $netpay_list->EmployeeID->viewAttributes() ?>><?php echo $netpay_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($netpay_list->NETPAY->Visible) { // NETPAY ?>
		<td data-name="NETPAY" <?php echo $netpay_list->NETPAY->cellAttributes() ?>>
<span id="el<?php echo $netpay_list->RowCount ?>_netpay_NETPAY">
<span<?php echo $netpay_list->NETPAY->viewAttributes() ?>><?php echo $netpay_list->NETPAY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$netpay_list->ListOptions->render("body", "right", $netpay_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$netpay_list->isGridAdd())
		$netpay_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$netpay->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($netpay_list->Recordset)
	$netpay_list->Recordset->Close();
?>
<?php if (!$netpay_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$netpay_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $netpay_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $netpay_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($netpay_list->TotalRecords == 0 && !$netpay->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $netpay_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$netpay_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$netpay_list->isExport()) { ?>
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
$netpay_list->terminate();
?>