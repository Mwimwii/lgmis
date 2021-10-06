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
$councillor_allowance_list = new councillor_allowance_list();

// Run the page
$councillor_allowance_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_allowance_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillor_allowance_list->isExport()) { ?>
<script>
var fcouncillor_allowancelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncillor_allowancelist = currentForm = new ew.Form("fcouncillor_allowancelist", "list");
	fcouncillor_allowancelist.formKeyCountName = '<?php echo $councillor_allowance_list->FormKeyCountName ?>';
	loadjs.done("fcouncillor_allowancelist");
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
<?php if (!$councillor_allowance_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($councillor_allowance_list->TotalRecords > 0 && $councillor_allowance_list->ExportOptions->visible()) { ?>
<?php $councillor_allowance_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($councillor_allowance_list->ImportOptions->visible()) { ?>
<?php $councillor_allowance_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$councillor_allowance_list->isExport() || Config("EXPORT_MASTER_RECORD") && $councillor_allowance_list->isExport("print")) { ?>
<?php
if ($councillor_allowance_list->DbMasterFilter != "" && $councillor_allowance->getCurrentMasterTable() == "councillorship") {
	if ($councillor_allowance_list->MasterRecordExists) {
		include_once "councillorshipmaster.php";
	}
}
?>
<?php } ?>
<?php
$councillor_allowance_list->renderOtherOptions();
?>
<?php $councillor_allowance_list->showPageHeader(); ?>
<?php
$councillor_allowance_list->showMessage();
?>
<?php if ($councillor_allowance_list->TotalRecords > 0 || $councillor_allowance->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillor_allowance_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillor_allowance">
<?php if (!$councillor_allowance_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$councillor_allowance_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_allowance_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillor_allowance_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncillor_allowancelist" id="fcouncillor_allowancelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_allowance">
<?php if ($councillor_allowance->getCurrentMasterTable() == "councillorship" && $councillor_allowance->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillorship">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_councillor_allowance" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($councillor_allowance_list->TotalRecords > 0 || $councillor_allowance_list->isGridEdit()) { ?>
<table id="tbl_councillor_allowancelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillor_allowance->RowType = ROWTYPE_HEADER;

// Render list options
$councillor_allowance_list->renderListOptions();

// Render list options (header, left)
$councillor_allowance_list->ListOptions->render("header", "left");
?>
<?php if ($councillor_allowance_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillor_allowance_list->SortUrl($councillor_allowance_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $councillor_allowance_list->EmployeeID->headerCellClass() ?>"><div id="elh_councillor_allowance_EmployeeID" class="councillor_allowance_EmployeeID"><div class="ew-table-header-caption"><?php echo $councillor_allowance_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $councillor_allowance_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_allowance_list->SortUrl($councillor_allowance_list->EmployeeID) ?>', 1);"><div id="elh_councillor_allowance_EmployeeID" class="councillor_allowance_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_allowance_list->AllowanceCode->Visible) { // AllowanceCode ?>
	<?php if ($councillor_allowance_list->SortUrl($councillor_allowance_list->AllowanceCode) == "") { ?>
		<th data-name="AllowanceCode" class="<?php echo $councillor_allowance_list->AllowanceCode->headerCellClass() ?>"><div id="elh_councillor_allowance_AllowanceCode" class="councillor_allowance_AllowanceCode"><div class="ew-table-header-caption"><?php echo $councillor_allowance_list->AllowanceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowanceCode" class="<?php echo $councillor_allowance_list->AllowanceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_allowance_list->SortUrl($councillor_allowance_list->AllowanceCode) ?>', 1);"><div id="elh_councillor_allowance_AllowanceCode" class="councillor_allowance_AllowanceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_list->AllowanceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_list->AllowanceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_list->AllowanceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_allowance_list->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<?php if ($councillor_allowance_list->SortUrl($councillor_allowance_list->AllowanceAmount) == "") { ?>
		<th data-name="AllowanceAmount" class="<?php echo $councillor_allowance_list->AllowanceAmount->headerCellClass() ?>"><div id="elh_councillor_allowance_AllowanceAmount" class="councillor_allowance_AllowanceAmount"><div class="ew-table-header-caption"><?php echo $councillor_allowance_list->AllowanceAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowanceAmount" class="<?php echo $councillor_allowance_list->AllowanceAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_allowance_list->SortUrl($councillor_allowance_list->AllowanceAmount) ?>', 1);"><div id="elh_councillor_allowance_AllowanceAmount" class="councillor_allowance_AllowanceAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_allowance_list->AllowanceAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_allowance_list->AllowanceAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_allowance_list->AllowanceAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillor_allowance_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($councillor_allowance_list->ExportAll && $councillor_allowance_list->isExport()) {
	$councillor_allowance_list->StopRecord = $councillor_allowance_list->TotalRecords;
} else {

	// Set the last record to display
	if ($councillor_allowance_list->TotalRecords > $councillor_allowance_list->StartRecord + $councillor_allowance_list->DisplayRecords - 1)
		$councillor_allowance_list->StopRecord = $councillor_allowance_list->StartRecord + $councillor_allowance_list->DisplayRecords - 1;
	else
		$councillor_allowance_list->StopRecord = $councillor_allowance_list->TotalRecords;
}
$councillor_allowance_list->RecordCount = $councillor_allowance_list->StartRecord - 1;
if ($councillor_allowance_list->Recordset && !$councillor_allowance_list->Recordset->EOF) {
	$councillor_allowance_list->Recordset->moveFirst();
	$selectLimit = $councillor_allowance_list->UseSelectLimit;
	if (!$selectLimit && $councillor_allowance_list->StartRecord > 1)
		$councillor_allowance_list->Recordset->move($councillor_allowance_list->StartRecord - 1);
} elseif (!$councillor_allowance->AllowAddDeleteRow && $councillor_allowance_list->StopRecord == 0) {
	$councillor_allowance_list->StopRecord = $councillor_allowance->GridAddRowCount;
}

// Initialize aggregate
$councillor_allowance->RowType = ROWTYPE_AGGREGATEINIT;
$councillor_allowance->resetAttributes();
$councillor_allowance_list->renderRow();
while ($councillor_allowance_list->RecordCount < $councillor_allowance_list->StopRecord) {
	$councillor_allowance_list->RecordCount++;
	if ($councillor_allowance_list->RecordCount >= $councillor_allowance_list->StartRecord) {
		$councillor_allowance_list->RowCount++;

		// Set up key count
		$councillor_allowance_list->KeyCount = $councillor_allowance_list->RowIndex;

		// Init row class and style
		$councillor_allowance->resetAttributes();
		$councillor_allowance->CssClass = "";
		if ($councillor_allowance_list->isGridAdd()) {
		} else {
			$councillor_allowance_list->loadRowValues($councillor_allowance_list->Recordset); // Load row values
		}
		$councillor_allowance->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$councillor_allowance->RowAttrs->merge(["data-rowindex" => $councillor_allowance_list->RowCount, "id" => "r" . $councillor_allowance_list->RowCount . "_councillor_allowance", "data-rowtype" => $councillor_allowance->RowType]);

		// Render row
		$councillor_allowance_list->renderRow();

		// Render list options
		$councillor_allowance_list->renderListOptions();
?>
	<tr <?php echo $councillor_allowance->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillor_allowance_list->ListOptions->render("body", "left", $councillor_allowance_list->RowCount);
?>
	<?php if ($councillor_allowance_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $councillor_allowance_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $councillor_allowance_list->RowCount ?>_councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_list->EmployeeID->viewAttributes() ?>><?php echo $councillor_allowance_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillor_allowance_list->AllowanceCode->Visible) { // AllowanceCode ?>
		<td data-name="AllowanceCode" <?php echo $councillor_allowance_list->AllowanceCode->cellAttributes() ?>>
<span id="el<?php echo $councillor_allowance_list->RowCount ?>_councillor_allowance_AllowanceCode">
<span<?php echo $councillor_allowance_list->AllowanceCode->viewAttributes() ?>><?php echo $councillor_allowance_list->AllowanceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillor_allowance_list->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<td data-name="AllowanceAmount" <?php echo $councillor_allowance_list->AllowanceAmount->cellAttributes() ?>>
<span id="el<?php echo $councillor_allowance_list->RowCount ?>_councillor_allowance_AllowanceAmount">
<span<?php echo $councillor_allowance_list->AllowanceAmount->viewAttributes() ?>><?php echo $councillor_allowance_list->AllowanceAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillor_allowance_list->ListOptions->render("body", "right", $councillor_allowance_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$councillor_allowance_list->isGridAdd())
		$councillor_allowance_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$councillor_allowance->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillor_allowance_list->Recordset)
	$councillor_allowance_list->Recordset->Close();
?>
<?php if (!$councillor_allowance_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$councillor_allowance_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_allowance_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillor_allowance_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillor_allowance_list->TotalRecords == 0 && !$councillor_allowance->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillor_allowance_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$councillor_allowance_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillor_allowance_list->isExport()) { ?>
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
$councillor_allowance_list->terminate();
?>