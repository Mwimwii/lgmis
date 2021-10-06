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
$basic_salary_list = new basic_salary_list();

// Run the page
$basic_salary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$basic_salary_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$basic_salary_list->isExport()) { ?>
<script>
var fbasic_salarylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbasic_salarylist = currentForm = new ew.Form("fbasic_salarylist", "list");
	fbasic_salarylist.formKeyCountName = '<?php echo $basic_salary_list->FormKeyCountName ?>';
	loadjs.done("fbasic_salarylist");
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
<?php if (!$basic_salary_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($basic_salary_list->TotalRecords > 0 && $basic_salary_list->ExportOptions->visible()) { ?>
<?php $basic_salary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($basic_salary_list->ImportOptions->visible()) { ?>
<?php $basic_salary_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$basic_salary_list->renderOtherOptions();
?>
<?php $basic_salary_list->showPageHeader(); ?>
<?php
$basic_salary_list->showMessage();
?>
<?php if ($basic_salary_list->TotalRecords > 0 || $basic_salary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($basic_salary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> basic_salary">
<?php if (!$basic_salary_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$basic_salary_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $basic_salary_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $basic_salary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbasic_salarylist" id="fbasic_salarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="basic_salary">
<div id="gmp_basic_salary" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($basic_salary_list->TotalRecords > 0 || $basic_salary_list->isGridEdit()) { ?>
<table id="tbl_basic_salarylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$basic_salary->RowType = ROWTYPE_HEADER;

// Render list options
$basic_salary_list->renderListOptions();

// Render list options (header, left)
$basic_salary_list->ListOptions->render("header", "left");
?>
<?php if ($basic_salary_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($basic_salary_list->SortUrl($basic_salary_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $basic_salary_list->EmployeeID->headerCellClass() ?>"><div id="elh_basic_salary_EmployeeID" class="basic_salary_EmployeeID"><div class="ew-table-header-caption"><?php echo $basic_salary_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $basic_salary_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $basic_salary_list->SortUrl($basic_salary_list->EmployeeID) ?>', 1);"><div id="elh_basic_salary_EmployeeID" class="basic_salary_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $basic_salary_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($basic_salary_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($basic_salary_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($basic_salary_list->BasicSalary->Visible) { // BasicSalary ?>
	<?php if ($basic_salary_list->SortUrl($basic_salary_list->BasicSalary) == "") { ?>
		<th data-name="BasicSalary" class="<?php echo $basic_salary_list->BasicSalary->headerCellClass() ?>"><div id="elh_basic_salary_BasicSalary" class="basic_salary_BasicSalary"><div class="ew-table-header-caption"><?php echo $basic_salary_list->BasicSalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicSalary" class="<?php echo $basic_salary_list->BasicSalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $basic_salary_list->SortUrl($basic_salary_list->BasicSalary) ?>', 1);"><div id="elh_basic_salary_BasicSalary" class="basic_salary_BasicSalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $basic_salary_list->BasicSalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($basic_salary_list->BasicSalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($basic_salary_list->BasicSalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$basic_salary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($basic_salary_list->ExportAll && $basic_salary_list->isExport()) {
	$basic_salary_list->StopRecord = $basic_salary_list->TotalRecords;
} else {

	// Set the last record to display
	if ($basic_salary_list->TotalRecords > $basic_salary_list->StartRecord + $basic_salary_list->DisplayRecords - 1)
		$basic_salary_list->StopRecord = $basic_salary_list->StartRecord + $basic_salary_list->DisplayRecords - 1;
	else
		$basic_salary_list->StopRecord = $basic_salary_list->TotalRecords;
}
$basic_salary_list->RecordCount = $basic_salary_list->StartRecord - 1;
if ($basic_salary_list->Recordset && !$basic_salary_list->Recordset->EOF) {
	$basic_salary_list->Recordset->moveFirst();
	$selectLimit = $basic_salary_list->UseSelectLimit;
	if (!$selectLimit && $basic_salary_list->StartRecord > 1)
		$basic_salary_list->Recordset->move($basic_salary_list->StartRecord - 1);
} elseif (!$basic_salary->AllowAddDeleteRow && $basic_salary_list->StopRecord == 0) {
	$basic_salary_list->StopRecord = $basic_salary->GridAddRowCount;
}

// Initialize aggregate
$basic_salary->RowType = ROWTYPE_AGGREGATEINIT;
$basic_salary->resetAttributes();
$basic_salary_list->renderRow();
while ($basic_salary_list->RecordCount < $basic_salary_list->StopRecord) {
	$basic_salary_list->RecordCount++;
	if ($basic_salary_list->RecordCount >= $basic_salary_list->StartRecord) {
		$basic_salary_list->RowCount++;

		// Set up key count
		$basic_salary_list->KeyCount = $basic_salary_list->RowIndex;

		// Init row class and style
		$basic_salary->resetAttributes();
		$basic_salary->CssClass = "";
		if ($basic_salary_list->isGridAdd()) {
		} else {
			$basic_salary_list->loadRowValues($basic_salary_list->Recordset); // Load row values
		}
		$basic_salary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$basic_salary->RowAttrs->merge(["data-rowindex" => $basic_salary_list->RowCount, "id" => "r" . $basic_salary_list->RowCount . "_basic_salary", "data-rowtype" => $basic_salary->RowType]);

		// Render row
		$basic_salary_list->renderRow();

		// Render list options
		$basic_salary_list->renderListOptions();
?>
	<tr <?php echo $basic_salary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$basic_salary_list->ListOptions->render("body", "left", $basic_salary_list->RowCount);
?>
	<?php if ($basic_salary_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $basic_salary_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $basic_salary_list->RowCount ?>_basic_salary_EmployeeID">
<span<?php echo $basic_salary_list->EmployeeID->viewAttributes() ?>><?php echo $basic_salary_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($basic_salary_list->BasicSalary->Visible) { // BasicSalary ?>
		<td data-name="BasicSalary" <?php echo $basic_salary_list->BasicSalary->cellAttributes() ?>>
<span id="el<?php echo $basic_salary_list->RowCount ?>_basic_salary_BasicSalary">
<span<?php echo $basic_salary_list->BasicSalary->viewAttributes() ?>><?php echo $basic_salary_list->BasicSalary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$basic_salary_list->ListOptions->render("body", "right", $basic_salary_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$basic_salary_list->isGridAdd())
		$basic_salary_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$basic_salary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($basic_salary_list->Recordset)
	$basic_salary_list->Recordset->Close();
?>
<?php if (!$basic_salary_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$basic_salary_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $basic_salary_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $basic_salary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($basic_salary_list->TotalRecords == 0 && !$basic_salary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $basic_salary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$basic_salary_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$basic_salary_list->isExport()) { ?>
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
$basic_salary_list->terminate();
?>