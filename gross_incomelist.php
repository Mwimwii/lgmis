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
$gross_income_list = new gross_income_list();

// Run the page
$gross_income_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gross_income_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gross_income_list->isExport()) { ?>
<script>
var fgross_incomelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgross_incomelist = currentForm = new ew.Form("fgross_incomelist", "list");
	fgross_incomelist.formKeyCountName = '<?php echo $gross_income_list->FormKeyCountName ?>';
	loadjs.done("fgross_incomelist");
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
<?php if (!$gross_income_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gross_income_list->TotalRecords > 0 && $gross_income_list->ExportOptions->visible()) { ?>
<?php $gross_income_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gross_income_list->ImportOptions->visible()) { ?>
<?php $gross_income_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gross_income_list->renderOtherOptions();
?>
<?php $gross_income_list->showPageHeader(); ?>
<?php
$gross_income_list->showMessage();
?>
<?php if ($gross_income_list->TotalRecords > 0 || $gross_income->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gross_income_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gross_income">
<?php if (!$gross_income_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gross_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gross_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gross_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgross_incomelist" id="fgross_incomelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gross_income">
<div id="gmp_gross_income" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gross_income_list->TotalRecords > 0 || $gross_income_list->isGridEdit()) { ?>
<table id="tbl_gross_incomelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gross_income->RowType = ROWTYPE_HEADER;

// Render list options
$gross_income_list->renderListOptions();

// Render list options (header, left)
$gross_income_list->ListOptions->render("header", "left");
?>
<?php if ($gross_income_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($gross_income_list->SortUrl($gross_income_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $gross_income_list->EmployeeID->headerCellClass() ?>"><div id="elh_gross_income_EmployeeID" class="gross_income_EmployeeID"><div class="ew-table-header-caption"><?php echo $gross_income_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $gross_income_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gross_income_list->SortUrl($gross_income_list->EmployeeID) ?>', 1);"><div id="elh_gross_income_EmployeeID" class="gross_income_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gross_income_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($gross_income_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gross_income_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gross_income_list->Gross->Visible) { // Gross ?>
	<?php if ($gross_income_list->SortUrl($gross_income_list->Gross) == "") { ?>
		<th data-name="Gross" class="<?php echo $gross_income_list->Gross->headerCellClass() ?>"><div id="elh_gross_income_Gross" class="gross_income_Gross"><div class="ew-table-header-caption"><?php echo $gross_income_list->Gross->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Gross" class="<?php echo $gross_income_list->Gross->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gross_income_list->SortUrl($gross_income_list->Gross) ?>', 1);"><div id="elh_gross_income_Gross" class="gross_income_Gross">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gross_income_list->Gross->caption() ?></span><span class="ew-table-header-sort"><?php if ($gross_income_list->Gross->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gross_income_list->Gross->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gross_income_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gross_income_list->ExportAll && $gross_income_list->isExport()) {
	$gross_income_list->StopRecord = $gross_income_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gross_income_list->TotalRecords > $gross_income_list->StartRecord + $gross_income_list->DisplayRecords - 1)
		$gross_income_list->StopRecord = $gross_income_list->StartRecord + $gross_income_list->DisplayRecords - 1;
	else
		$gross_income_list->StopRecord = $gross_income_list->TotalRecords;
}
$gross_income_list->RecordCount = $gross_income_list->StartRecord - 1;
if ($gross_income_list->Recordset && !$gross_income_list->Recordset->EOF) {
	$gross_income_list->Recordset->moveFirst();
	$selectLimit = $gross_income_list->UseSelectLimit;
	if (!$selectLimit && $gross_income_list->StartRecord > 1)
		$gross_income_list->Recordset->move($gross_income_list->StartRecord - 1);
} elseif (!$gross_income->AllowAddDeleteRow && $gross_income_list->StopRecord == 0) {
	$gross_income_list->StopRecord = $gross_income->GridAddRowCount;
}

// Initialize aggregate
$gross_income->RowType = ROWTYPE_AGGREGATEINIT;
$gross_income->resetAttributes();
$gross_income_list->renderRow();
while ($gross_income_list->RecordCount < $gross_income_list->StopRecord) {
	$gross_income_list->RecordCount++;
	if ($gross_income_list->RecordCount >= $gross_income_list->StartRecord) {
		$gross_income_list->RowCount++;

		// Set up key count
		$gross_income_list->KeyCount = $gross_income_list->RowIndex;

		// Init row class and style
		$gross_income->resetAttributes();
		$gross_income->CssClass = "";
		if ($gross_income_list->isGridAdd()) {
		} else {
			$gross_income_list->loadRowValues($gross_income_list->Recordset); // Load row values
		}
		$gross_income->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gross_income->RowAttrs->merge(["data-rowindex" => $gross_income_list->RowCount, "id" => "r" . $gross_income_list->RowCount . "_gross_income", "data-rowtype" => $gross_income->RowType]);

		// Render row
		$gross_income_list->renderRow();

		// Render list options
		$gross_income_list->renderListOptions();
?>
	<tr <?php echo $gross_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gross_income_list->ListOptions->render("body", "left", $gross_income_list->RowCount);
?>
	<?php if ($gross_income_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $gross_income_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $gross_income_list->RowCount ?>_gross_income_EmployeeID">
<span<?php echo $gross_income_list->EmployeeID->viewAttributes() ?>><?php echo $gross_income_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gross_income_list->Gross->Visible) { // Gross ?>
		<td data-name="Gross" <?php echo $gross_income_list->Gross->cellAttributes() ?>>
<span id="el<?php echo $gross_income_list->RowCount ?>_gross_income_Gross">
<span<?php echo $gross_income_list->Gross->viewAttributes() ?>><?php echo $gross_income_list->Gross->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gross_income_list->ListOptions->render("body", "right", $gross_income_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gross_income_list->isGridAdd())
		$gross_income_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gross_income->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gross_income_list->Recordset)
	$gross_income_list->Recordset->Close();
?>
<?php if (!$gross_income_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gross_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gross_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gross_income_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gross_income_list->TotalRecords == 0 && !$gross_income->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gross_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gross_income_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gross_income_list->isExport()) { ?>
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
$gross_income_list->terminate();
?>