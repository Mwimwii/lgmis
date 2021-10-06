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
$pivot_deductions_list = new pivot_deductions_list();

// Run the page
$pivot_deductions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pivot_deductions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pivot_deductions_list->isExport()) { ?>
<script>
var fpivot_deductionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpivot_deductionslist = currentForm = new ew.Form("fpivot_deductionslist", "list");
	fpivot_deductionslist.formKeyCountName = '<?php echo $pivot_deductions_list->FormKeyCountName ?>';
	loadjs.done("fpivot_deductionslist");
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
<?php if (!$pivot_deductions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pivot_deductions_list->TotalRecords > 0 && $pivot_deductions_list->ExportOptions->visible()) { ?>
<?php $pivot_deductions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pivot_deductions_list->ImportOptions->visible()) { ?>
<?php $pivot_deductions_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pivot_deductions_list->renderOtherOptions();
?>
<?php $pivot_deductions_list->showPageHeader(); ?>
<?php
$pivot_deductions_list->showMessage();
?>
<?php if ($pivot_deductions_list->TotalRecords > 0 || $pivot_deductions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pivot_deductions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pivot_deductions">
<?php if (!$pivot_deductions_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pivot_deductions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pivot_deductions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pivot_deductions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpivot_deductionslist" id="fpivot_deductionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pivot_deductions">
<div id="gmp_pivot_deductions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pivot_deductions_list->TotalRecords > 0 || $pivot_deductions_list->isGridEdit()) { ?>
<table id="tbl_pivot_deductionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pivot_deductions->RowType = ROWTYPE_HEADER;

// Render list options
$pivot_deductions_list->renderListOptions();

// Render list options (header, left)
$pivot_deductions_list->ListOptions->render("header", "left");
?>
<?php if ($pivot_deductions_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $pivot_deductions_list->EmployeeID->headerCellClass() ?>"><div id="elh_pivot_deductions_EmployeeID" class="pivot_deductions_EmployeeID"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $pivot_deductions_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->EmployeeID) ?>', 1);"><div id="elh_pivot_deductions_EmployeeID" class="pivot_deductions_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->PAYE->Visible) { // PAYE ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->PAYE) == "") { ?>
		<th data-name="PAYE" class="<?php echo $pivot_deductions_list->PAYE->headerCellClass() ?>"><div id="elh_pivot_deductions_PAYE" class="pivot_deductions_PAYE"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->PAYE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PAYE" class="<?php echo $pivot_deductions_list->PAYE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->PAYE) ?>', 1);"><div id="elh_pivot_deductions_PAYE" class="pivot_deductions_PAYE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->PAYE->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->PAYE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->PAYE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->NAPSA->Visible) { // NAPSA ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->NAPSA) == "") { ?>
		<th data-name="NAPSA" class="<?php echo $pivot_deductions_list->NAPSA->headerCellClass() ?>"><div id="elh_pivot_deductions_NAPSA" class="pivot_deductions_NAPSA"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->NAPSA->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NAPSA" class="<?php echo $pivot_deductions_list->NAPSA->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->NAPSA) ?>', 1);"><div id="elh_pivot_deductions_NAPSA" class="pivot_deductions_NAPSA">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->NAPSA->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->NAPSA->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->NAPSA->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->Advance_Recovery->Visible) { // Advance Recovery ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->Advance_Recovery) == "") { ?>
		<th data-name="Advance_Recovery" class="<?php echo $pivot_deductions_list->Advance_Recovery->headerCellClass() ?>"><div id="elh_pivot_deductions_Advance_Recovery" class="pivot_deductions_Advance_Recovery"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->Advance_Recovery->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Advance_Recovery" class="<?php echo $pivot_deductions_list->Advance_Recovery->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->Advance_Recovery) ?>', 1);"><div id="elh_pivot_deductions_Advance_Recovery" class="pivot_deductions_Advance_Recovery">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->Advance_Recovery->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->Advance_Recovery->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->Advance_Recovery->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->Union_Contribution->Visible) { // Union Contribution ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->Union_Contribution) == "") { ?>
		<th data-name="Union_Contribution" class="<?php echo $pivot_deductions_list->Union_Contribution->headerCellClass() ?>"><div id="elh_pivot_deductions_Union_Contribution" class="pivot_deductions_Union_Contribution"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->Union_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Union_Contribution" class="<?php echo $pivot_deductions_list->Union_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->Union_Contribution) ?>', 1);"><div id="elh_pivot_deductions_Union_Contribution" class="pivot_deductions_Union_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->Union_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->Union_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->Union_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->Funeral_Scheme->Visible) { // Funeral Scheme ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->Funeral_Scheme) == "") { ?>
		<th data-name="Funeral_Scheme" class="<?php echo $pivot_deductions_list->Funeral_Scheme->headerCellClass() ?>"><div id="elh_pivot_deductions_Funeral_Scheme" class="pivot_deductions_Funeral_Scheme"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->Funeral_Scheme->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Funeral_Scheme" class="<?php echo $pivot_deductions_list->Funeral_Scheme->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->Funeral_Scheme) ?>', 1);"><div id="elh_pivot_deductions_Funeral_Scheme" class="pivot_deductions_Funeral_Scheme">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->Funeral_Scheme->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->Funeral_Scheme->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->Funeral_Scheme->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->Loan_recovery->Visible) { // Loan recovery ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->Loan_recovery) == "") { ?>
		<th data-name="Loan_recovery" class="<?php echo $pivot_deductions_list->Loan_recovery->headerCellClass() ?>"><div id="elh_pivot_deductions_Loan_recovery" class="pivot_deductions_Loan_recovery"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->Loan_recovery->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Loan_recovery" class="<?php echo $pivot_deductions_list->Loan_recovery->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->Loan_recovery) ?>', 1);"><div id="elh_pivot_deductions_Loan_recovery" class="pivot_deductions_Loan_recovery">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->Loan_recovery->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->Loan_recovery->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->Loan_recovery->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->LASF->Visible) { // LASF ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->LASF) == "") { ?>
		<th data-name="LASF" class="<?php echo $pivot_deductions_list->LASF->headerCellClass() ?>"><div id="elh_pivot_deductions_LASF" class="pivot_deductions_LASF"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->LASF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LASF" class="<?php echo $pivot_deductions_list->LASF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->LASF) ?>', 1);"><div id="elh_pivot_deductions_LASF" class="pivot_deductions_LASF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->LASF->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->LASF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->LASF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->Personal_Levy->Visible) { // Personal Levy ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->Personal_Levy) == "") { ?>
		<th data-name="Personal_Levy" class="<?php echo $pivot_deductions_list->Personal_Levy->headerCellClass() ?>"><div id="elh_pivot_deductions_Personal_Levy" class="pivot_deductions_Personal_Levy"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->Personal_Levy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Personal_Levy" class="<?php echo $pivot_deductions_list->Personal_Levy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->Personal_Levy) ?>', 1);"><div id="elh_pivot_deductions_Personal_Levy" class="pivot_deductions_Personal_Levy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->Personal_Levy->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->Personal_Levy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->Personal_Levy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->House_Rent->Visible) { // House Rent ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->House_Rent) == "") { ?>
		<th data-name="House_Rent" class="<?php echo $pivot_deductions_list->House_Rent->headerCellClass() ?>"><div id="elh_pivot_deductions_House_Rent" class="pivot_deductions_House_Rent"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->House_Rent->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="House_Rent" class="<?php echo $pivot_deductions_list->House_Rent->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->House_Rent) ?>', 1);"><div id="elh_pivot_deductions_House_Rent" class="pivot_deductions_House_Rent">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->House_Rent->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->House_Rent->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->House_Rent->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->Fire_Union_Contribution->Visible) { // Fire Union Contribution ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->Fire_Union_Contribution) == "") { ?>
		<th data-name="Fire_Union_Contribution" class="<?php echo $pivot_deductions_list->Fire_Union_Contribution->headerCellClass() ?>"><div id="elh_pivot_deductions_Fire_Union_Contribution" class="pivot_deductions_Fire_Union_Contribution"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->Fire_Union_Contribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fire_Union_Contribution" class="<?php echo $pivot_deductions_list->Fire_Union_Contribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->Fire_Union_Contribution) ?>', 1);"><div id="elh_pivot_deductions_Fire_Union_Contribution" class="pivot_deductions_Fire_Union_Contribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->Fire_Union_Contribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->Fire_Union_Contribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->Fire_Union_Contribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->OVERPAYMENT_Recovery->Visible) { // OVERPAYMENT Recovery ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->OVERPAYMENT_Recovery) == "") { ?>
		<th data-name="OVERPAYMENT_Recovery" class="<?php echo $pivot_deductions_list->OVERPAYMENT_Recovery->headerCellClass() ?>"><div id="elh_pivot_deductions_OVERPAYMENT_Recovery" class="pivot_deductions_OVERPAYMENT_Recovery"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->OVERPAYMENT_Recovery->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OVERPAYMENT_Recovery" class="<?php echo $pivot_deductions_list->OVERPAYMENT_Recovery->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->OVERPAYMENT_Recovery) ?>', 1);"><div id="elh_pivot_deductions_OVERPAYMENT_Recovery" class="pivot_deductions_OVERPAYMENT_Recovery">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->OVERPAYMENT_Recovery->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->OVERPAYMENT_Recovery->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->OVERPAYMENT_Recovery->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pivot_deductions_list->NHIS->Visible) { // NHIS ?>
	<?php if ($pivot_deductions_list->SortUrl($pivot_deductions_list->NHIS) == "") { ?>
		<th data-name="NHIS" class="<?php echo $pivot_deductions_list->NHIS->headerCellClass() ?>"><div id="elh_pivot_deductions_NHIS" class="pivot_deductions_NHIS"><div class="ew-table-header-caption"><?php echo $pivot_deductions_list->NHIS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NHIS" class="<?php echo $pivot_deductions_list->NHIS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pivot_deductions_list->SortUrl($pivot_deductions_list->NHIS) ?>', 1);"><div id="elh_pivot_deductions_NHIS" class="pivot_deductions_NHIS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pivot_deductions_list->NHIS->caption() ?></span><span class="ew-table-header-sort"><?php if ($pivot_deductions_list->NHIS->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pivot_deductions_list->NHIS->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pivot_deductions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pivot_deductions_list->ExportAll && $pivot_deductions_list->isExport()) {
	$pivot_deductions_list->StopRecord = $pivot_deductions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pivot_deductions_list->TotalRecords > $pivot_deductions_list->StartRecord + $pivot_deductions_list->DisplayRecords - 1)
		$pivot_deductions_list->StopRecord = $pivot_deductions_list->StartRecord + $pivot_deductions_list->DisplayRecords - 1;
	else
		$pivot_deductions_list->StopRecord = $pivot_deductions_list->TotalRecords;
}
$pivot_deductions_list->RecordCount = $pivot_deductions_list->StartRecord - 1;
if ($pivot_deductions_list->Recordset && !$pivot_deductions_list->Recordset->EOF) {
	$pivot_deductions_list->Recordset->moveFirst();
	$selectLimit = $pivot_deductions_list->UseSelectLimit;
	if (!$selectLimit && $pivot_deductions_list->StartRecord > 1)
		$pivot_deductions_list->Recordset->move($pivot_deductions_list->StartRecord - 1);
} elseif (!$pivot_deductions->AllowAddDeleteRow && $pivot_deductions_list->StopRecord == 0) {
	$pivot_deductions_list->StopRecord = $pivot_deductions->GridAddRowCount;
}

// Initialize aggregate
$pivot_deductions->RowType = ROWTYPE_AGGREGATEINIT;
$pivot_deductions->resetAttributes();
$pivot_deductions_list->renderRow();
while ($pivot_deductions_list->RecordCount < $pivot_deductions_list->StopRecord) {
	$pivot_deductions_list->RecordCount++;
	if ($pivot_deductions_list->RecordCount >= $pivot_deductions_list->StartRecord) {
		$pivot_deductions_list->RowCount++;

		// Set up key count
		$pivot_deductions_list->KeyCount = $pivot_deductions_list->RowIndex;

		// Init row class and style
		$pivot_deductions->resetAttributes();
		$pivot_deductions->CssClass = "";
		if ($pivot_deductions_list->isGridAdd()) {
		} else {
			$pivot_deductions_list->loadRowValues($pivot_deductions_list->Recordset); // Load row values
		}
		$pivot_deductions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pivot_deductions->RowAttrs->merge(["data-rowindex" => $pivot_deductions_list->RowCount, "id" => "r" . $pivot_deductions_list->RowCount . "_pivot_deductions", "data-rowtype" => $pivot_deductions->RowType]);

		// Render row
		$pivot_deductions_list->renderRow();

		// Render list options
		$pivot_deductions_list->renderListOptions();
?>
	<tr <?php echo $pivot_deductions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pivot_deductions_list->ListOptions->render("body", "left", $pivot_deductions_list->RowCount);
?>
	<?php if ($pivot_deductions_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $pivot_deductions_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_EmployeeID">
<span<?php echo $pivot_deductions_list->EmployeeID->viewAttributes() ?>><?php echo $pivot_deductions_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->PAYE->Visible) { // PAYE ?>
		<td data-name="PAYE" <?php echo $pivot_deductions_list->PAYE->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_PAYE">
<span<?php echo $pivot_deductions_list->PAYE->viewAttributes() ?>><?php echo $pivot_deductions_list->PAYE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->NAPSA->Visible) { // NAPSA ?>
		<td data-name="NAPSA" <?php echo $pivot_deductions_list->NAPSA->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_NAPSA">
<span<?php echo $pivot_deductions_list->NAPSA->viewAttributes() ?>><?php echo $pivot_deductions_list->NAPSA->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->Advance_Recovery->Visible) { // Advance Recovery ?>
		<td data-name="Advance_Recovery" <?php echo $pivot_deductions_list->Advance_Recovery->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_Advance_Recovery">
<span<?php echo $pivot_deductions_list->Advance_Recovery->viewAttributes() ?>><?php echo $pivot_deductions_list->Advance_Recovery->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->Union_Contribution->Visible) { // Union Contribution ?>
		<td data-name="Union_Contribution" <?php echo $pivot_deductions_list->Union_Contribution->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_Union_Contribution">
<span<?php echo $pivot_deductions_list->Union_Contribution->viewAttributes() ?>><?php echo $pivot_deductions_list->Union_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->Funeral_Scheme->Visible) { // Funeral Scheme ?>
		<td data-name="Funeral_Scheme" <?php echo $pivot_deductions_list->Funeral_Scheme->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_Funeral_Scheme">
<span<?php echo $pivot_deductions_list->Funeral_Scheme->viewAttributes() ?>><?php echo $pivot_deductions_list->Funeral_Scheme->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->Loan_recovery->Visible) { // Loan recovery ?>
		<td data-name="Loan_recovery" <?php echo $pivot_deductions_list->Loan_recovery->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_Loan_recovery">
<span<?php echo $pivot_deductions_list->Loan_recovery->viewAttributes() ?>><?php echo $pivot_deductions_list->Loan_recovery->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->LASF->Visible) { // LASF ?>
		<td data-name="LASF" <?php echo $pivot_deductions_list->LASF->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_LASF">
<span<?php echo $pivot_deductions_list->LASF->viewAttributes() ?>><?php echo $pivot_deductions_list->LASF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->Personal_Levy->Visible) { // Personal Levy ?>
		<td data-name="Personal_Levy" <?php echo $pivot_deductions_list->Personal_Levy->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_Personal_Levy">
<span<?php echo $pivot_deductions_list->Personal_Levy->viewAttributes() ?>><?php echo $pivot_deductions_list->Personal_Levy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->House_Rent->Visible) { // House Rent ?>
		<td data-name="House_Rent" <?php echo $pivot_deductions_list->House_Rent->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_House_Rent">
<span<?php echo $pivot_deductions_list->House_Rent->viewAttributes() ?>><?php echo $pivot_deductions_list->House_Rent->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->Fire_Union_Contribution->Visible) { // Fire Union Contribution ?>
		<td data-name="Fire_Union_Contribution" <?php echo $pivot_deductions_list->Fire_Union_Contribution->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_Fire_Union_Contribution">
<span<?php echo $pivot_deductions_list->Fire_Union_Contribution->viewAttributes() ?>><?php echo $pivot_deductions_list->Fire_Union_Contribution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->OVERPAYMENT_Recovery->Visible) { // OVERPAYMENT Recovery ?>
		<td data-name="OVERPAYMENT_Recovery" <?php echo $pivot_deductions_list->OVERPAYMENT_Recovery->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_OVERPAYMENT_Recovery">
<span<?php echo $pivot_deductions_list->OVERPAYMENT_Recovery->viewAttributes() ?>><?php echo $pivot_deductions_list->OVERPAYMENT_Recovery->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pivot_deductions_list->NHIS->Visible) { // NHIS ?>
		<td data-name="NHIS" <?php echo $pivot_deductions_list->NHIS->cellAttributes() ?>>
<span id="el<?php echo $pivot_deductions_list->RowCount ?>_pivot_deductions_NHIS">
<span<?php echo $pivot_deductions_list->NHIS->viewAttributes() ?>><?php echo $pivot_deductions_list->NHIS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pivot_deductions_list->ListOptions->render("body", "right", $pivot_deductions_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pivot_deductions_list->isGridAdd())
		$pivot_deductions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pivot_deductions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pivot_deductions_list->Recordset)
	$pivot_deductions_list->Recordset->Close();
?>
<?php if (!$pivot_deductions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pivot_deductions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pivot_deductions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pivot_deductions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pivot_deductions_list->TotalRecords == 0 && !$pivot_deductions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pivot_deductions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pivot_deductions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pivot_deductions_list->isExport()) { ?>
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
$pivot_deductions_list->terminate();
?>