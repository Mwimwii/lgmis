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
$taxable_income_list = new taxable_income_list();

// Run the page
$taxable_income_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$taxable_income_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$taxable_income_list->isExport()) { ?>
<script>
var ftaxable_incomelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftaxable_incomelist = currentForm = new ew.Form("ftaxable_incomelist", "list");
	ftaxable_incomelist.formKeyCountName = '<?php echo $taxable_income_list->FormKeyCountName ?>';
	loadjs.done("ftaxable_incomelist");
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
<?php if (!$taxable_income_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($taxable_income_list->TotalRecords > 0 && $taxable_income_list->ExportOptions->visible()) { ?>
<?php $taxable_income_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($taxable_income_list->ImportOptions->visible()) { ?>
<?php $taxable_income_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$taxable_income_list->renderOtherOptions();
?>
<?php $taxable_income_list->showPageHeader(); ?>
<?php
$taxable_income_list->showMessage();
?>
<?php if ($taxable_income_list->TotalRecords > 0 || $taxable_income->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($taxable_income_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> taxable_income">
<?php if (!$taxable_income_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$taxable_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $taxable_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $taxable_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftaxable_incomelist" id="ftaxable_incomelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="taxable_income">
<div id="gmp_taxable_income" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($taxable_income_list->TotalRecords > 0 || $taxable_income_list->isGridEdit()) { ?>
<table id="tbl_taxable_incomelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$taxable_income->RowType = ROWTYPE_HEADER;

// Render list options
$taxable_income_list->renderListOptions();

// Render list options (header, left)
$taxable_income_list->ListOptions->render("header", "left");
?>
<?php if ($taxable_income_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($taxable_income_list->SortUrl($taxable_income_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $taxable_income_list->EmployeeID->headerCellClass() ?>"><div id="elh_taxable_income_EmployeeID" class="taxable_income_EmployeeID"><div class="ew-table-header-caption"><?php echo $taxable_income_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $taxable_income_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $taxable_income_list->SortUrl($taxable_income_list->EmployeeID) ?>', 1);"><div id="elh_taxable_income_EmployeeID" class="taxable_income_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $taxable_income_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($taxable_income_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($taxable_income_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($taxable_income_list->Gross->Visible) { // Gross ?>
	<?php if ($taxable_income_list->SortUrl($taxable_income_list->Gross) == "") { ?>
		<th data-name="Gross" class="<?php echo $taxable_income_list->Gross->headerCellClass() ?>"><div id="elh_taxable_income_Gross" class="taxable_income_Gross"><div class="ew-table-header-caption"><?php echo $taxable_income_list->Gross->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Gross" class="<?php echo $taxable_income_list->Gross->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $taxable_income_list->SortUrl($taxable_income_list->Gross) ?>', 1);"><div id="elh_taxable_income_Gross" class="taxable_income_Gross">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $taxable_income_list->Gross->caption() ?></span><span class="ew-table-header-sort"><?php if ($taxable_income_list->Gross->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($taxable_income_list->Gross->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$taxable_income_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($taxable_income_list->ExportAll && $taxable_income_list->isExport()) {
	$taxable_income_list->StopRecord = $taxable_income_list->TotalRecords;
} else {

	// Set the last record to display
	if ($taxable_income_list->TotalRecords > $taxable_income_list->StartRecord + $taxable_income_list->DisplayRecords - 1)
		$taxable_income_list->StopRecord = $taxable_income_list->StartRecord + $taxable_income_list->DisplayRecords - 1;
	else
		$taxable_income_list->StopRecord = $taxable_income_list->TotalRecords;
}
$taxable_income_list->RecordCount = $taxable_income_list->StartRecord - 1;
if ($taxable_income_list->Recordset && !$taxable_income_list->Recordset->EOF) {
	$taxable_income_list->Recordset->moveFirst();
	$selectLimit = $taxable_income_list->UseSelectLimit;
	if (!$selectLimit && $taxable_income_list->StartRecord > 1)
		$taxable_income_list->Recordset->move($taxable_income_list->StartRecord - 1);
} elseif (!$taxable_income->AllowAddDeleteRow && $taxable_income_list->StopRecord == 0) {
	$taxable_income_list->StopRecord = $taxable_income->GridAddRowCount;
}

// Initialize aggregate
$taxable_income->RowType = ROWTYPE_AGGREGATEINIT;
$taxable_income->resetAttributes();
$taxable_income_list->renderRow();
while ($taxable_income_list->RecordCount < $taxable_income_list->StopRecord) {
	$taxable_income_list->RecordCount++;
	if ($taxable_income_list->RecordCount >= $taxable_income_list->StartRecord) {
		$taxable_income_list->RowCount++;

		// Set up key count
		$taxable_income_list->KeyCount = $taxable_income_list->RowIndex;

		// Init row class and style
		$taxable_income->resetAttributes();
		$taxable_income->CssClass = "";
		if ($taxable_income_list->isGridAdd()) {
		} else {
			$taxable_income_list->loadRowValues($taxable_income_list->Recordset); // Load row values
		}
		$taxable_income->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$taxable_income->RowAttrs->merge(["data-rowindex" => $taxable_income_list->RowCount, "id" => "r" . $taxable_income_list->RowCount . "_taxable_income", "data-rowtype" => $taxable_income->RowType]);

		// Render row
		$taxable_income_list->renderRow();

		// Render list options
		$taxable_income_list->renderListOptions();
?>
	<tr <?php echo $taxable_income->rowAttributes() ?>>
<?php

// Render list options (body, left)
$taxable_income_list->ListOptions->render("body", "left", $taxable_income_list->RowCount);
?>
	<?php if ($taxable_income_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $taxable_income_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $taxable_income_list->RowCount ?>_taxable_income_EmployeeID">
<span<?php echo $taxable_income_list->EmployeeID->viewAttributes() ?>><?php echo $taxable_income_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($taxable_income_list->Gross->Visible) { // Gross ?>
		<td data-name="Gross" <?php echo $taxable_income_list->Gross->cellAttributes() ?>>
<span id="el<?php echo $taxable_income_list->RowCount ?>_taxable_income_Gross">
<span<?php echo $taxable_income_list->Gross->viewAttributes() ?>><?php echo $taxable_income_list->Gross->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$taxable_income_list->ListOptions->render("body", "right", $taxable_income_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$taxable_income_list->isGridAdd())
		$taxable_income_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$taxable_income->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($taxable_income_list->Recordset)
	$taxable_income_list->Recordset->Close();
?>
<?php if (!$taxable_income_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$taxable_income_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $taxable_income_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $taxable_income_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($taxable_income_list->TotalRecords == 0 && !$taxable_income->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $taxable_income_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$taxable_income_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$taxable_income_list->isExport()) { ?>
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
$taxable_income_list->terminate();
?>