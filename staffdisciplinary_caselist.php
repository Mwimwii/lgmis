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
$staffdisciplinary_case_list = new staffdisciplinary_case_list();

// Run the page
$staffdisciplinary_case_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_case_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffdisciplinary_case_list->isExport()) { ?>
<script>
var fstaffdisciplinary_caselist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaffdisciplinary_caselist = currentForm = new ew.Form("fstaffdisciplinary_caselist", "list");
	fstaffdisciplinary_caselist.formKeyCountName = '<?php echo $staffdisciplinary_case_list->FormKeyCountName ?>';
	loadjs.done("fstaffdisciplinary_caselist");
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
<?php if (!$staffdisciplinary_case_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staffdisciplinary_case_list->TotalRecords > 0 && $staffdisciplinary_case_list->ExportOptions->visible()) { ?>
<?php $staffdisciplinary_case_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->ImportOptions->visible()) { ?>
<?php $staffdisciplinary_case_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$staffdisciplinary_case_list->isExport() || Config("EXPORT_MASTER_RECORD") && $staffdisciplinary_case_list->isExport("print")) { ?>
<?php
if ($staffdisciplinary_case_list->DbMasterFilter != "" && $staffdisciplinary_case->getCurrentMasterTable() == "staff") {
	if ($staffdisciplinary_case_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$staffdisciplinary_case_list->renderOtherOptions();
?>
<?php $staffdisciplinary_case_list->showPageHeader(); ?>
<?php
$staffdisciplinary_case_list->showMessage();
?>
<?php if ($staffdisciplinary_case_list->TotalRecords > 0 || $staffdisciplinary_case->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffdisciplinary_case_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffdisciplinary_case">
<?php if (!$staffdisciplinary_case_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staffdisciplinary_case_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_case_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_case_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaffdisciplinary_caselist" id="fstaffdisciplinary_caselist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_case">
<?php if ($staffdisciplinary_case->getCurrentMasterTable() == "staff" && $staffdisciplinary_case->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_case_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_staffdisciplinary_case" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staffdisciplinary_case_list->TotalRecords > 0 || $staffdisciplinary_case_list->isGridEdit()) { ?>
<table id="tbl_staffdisciplinary_caselist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffdisciplinary_case->RowType = ROWTYPE_HEADER;

// Render list options
$staffdisciplinary_case_list->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_case_list->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_case_list->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->CaseNo) == "") { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_case_list->CaseNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_CaseNo" class="staffdisciplinary_case_CaseNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->CaseNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_case_list->CaseNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->CaseNo) ?>', 1);"><div id="elh_staffdisciplinary_case_CaseNo" class="staffdisciplinary_case_CaseNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->CaseNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->CaseNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->OffenseCode) == "") { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_case_list->OffenseCode->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_OffenseCode" class="staffdisciplinary_case_OffenseCode"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->OffenseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_case_list->OffenseCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->OffenseCode) ?>', 1);"><div id="elh_staffdisciplinary_case_OffenseCode" class="staffdisciplinary_case_OffenseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->OffenseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->OffenseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->ActionTaken->Visible) { // ActionTaken ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->ActionTaken) == "") { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_case_list->ActionTaken->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_ActionTaken" class="staffdisciplinary_case_ActionTaken"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->ActionTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_case_list->ActionTaken->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->ActionTaken) ?>', 1);"><div id="elh_staffdisciplinary_case_ActionTaken" class="staffdisciplinary_case_ActionTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->ActionTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->ActionTaken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->ActionTaken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->OffenseDate->Visible) { // OffenseDate ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->OffenseDate) == "") { ?>
		<th data-name="OffenseDate" class="<?php echo $staffdisciplinary_case_list->OffenseDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_OffenseDate" class="staffdisciplinary_case_OffenseDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->OffenseDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseDate" class="<?php echo $staffdisciplinary_case_list->OffenseDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->OffenseDate) ?>', 1);"><div id="elh_staffdisciplinary_case_OffenseDate" class="staffdisciplinary_case_OffenseDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->OffenseDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->OffenseDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->OffenseDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->ActionDate->Visible) { // ActionDate ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->ActionDate) == "") { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_case_list->ActionDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_ActionDate" class="staffdisciplinary_case_ActionDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->ActionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_case_list->ActionDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->ActionDate) ?>', 1);"><div id="elh_staffdisciplinary_case_ActionDate" class="staffdisciplinary_case_ActionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->ActionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->ActionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->DateOfAppealLetter) == "") { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_case_list->DateOfAppealLetter->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_DateOfAppealLetter" class="staffdisciplinary_case_DateOfAppealLetter"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->DateOfAppealLetter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_case_list->DateOfAppealLetter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->DateOfAppealLetter) ?>', 1);"><div id="elh_staffdisciplinary_case_DateOfAppealLetter" class="staffdisciplinary_case_DateOfAppealLetter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->DateOfAppealLetter->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->DateOfAppealLetter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->DateOfAppealLetter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->DateAppealReceived) == "") { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_case_list->DateAppealReceived->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_DateAppealReceived" class="staffdisciplinary_case_DateAppealReceived"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->DateAppealReceived->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_case_list->DateAppealReceived->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->DateAppealReceived) ?>', 1);"><div id="elh_staffdisciplinary_case_DateAppealReceived" class="staffdisciplinary_case_DateAppealReceived">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->DateAppealReceived->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->DateAppealReceived->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->DateAppealReceived->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->DateConcluded->Visible) { // DateConcluded ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->DateConcluded) == "") { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_case_list->DateConcluded->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_DateConcluded" class="staffdisciplinary_case_DateConcluded"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->DateConcluded->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_case_list->DateConcluded->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->DateConcluded) ?>', 1);"><div id="elh_staffdisciplinary_case_DateConcluded" class="staffdisciplinary_case_DateConcluded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->DateConcluded->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->DateConcluded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->DateConcluded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_case_list->AppealStatus->Visible) { // AppealStatus ?>
	<?php if ($staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->AppealStatus) == "") { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_case_list->AppealStatus->headerCellClass() ?>"><div id="elh_staffdisciplinary_case_AppealStatus" class="staffdisciplinary_case_AppealStatus"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->AppealStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_case_list->AppealStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_case_list->SortUrl($staffdisciplinary_case_list->AppealStatus) ?>', 1);"><div id="elh_staffdisciplinary_case_AppealStatus" class="staffdisciplinary_case_AppealStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_case_list->AppealStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_case_list->AppealStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_case_list->AppealStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_case_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staffdisciplinary_case_list->ExportAll && $staffdisciplinary_case_list->isExport()) {
	$staffdisciplinary_case_list->StopRecord = $staffdisciplinary_case_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staffdisciplinary_case_list->TotalRecords > $staffdisciplinary_case_list->StartRecord + $staffdisciplinary_case_list->DisplayRecords - 1)
		$staffdisciplinary_case_list->StopRecord = $staffdisciplinary_case_list->StartRecord + $staffdisciplinary_case_list->DisplayRecords - 1;
	else
		$staffdisciplinary_case_list->StopRecord = $staffdisciplinary_case_list->TotalRecords;
}
$staffdisciplinary_case_list->RecordCount = $staffdisciplinary_case_list->StartRecord - 1;
if ($staffdisciplinary_case_list->Recordset && !$staffdisciplinary_case_list->Recordset->EOF) {
	$staffdisciplinary_case_list->Recordset->moveFirst();
	$selectLimit = $staffdisciplinary_case_list->UseSelectLimit;
	if (!$selectLimit && $staffdisciplinary_case_list->StartRecord > 1)
		$staffdisciplinary_case_list->Recordset->move($staffdisciplinary_case_list->StartRecord - 1);
} elseif (!$staffdisciplinary_case->AllowAddDeleteRow && $staffdisciplinary_case_list->StopRecord == 0) {
	$staffdisciplinary_case_list->StopRecord = $staffdisciplinary_case->GridAddRowCount;
}

// Initialize aggregate
$staffdisciplinary_case->RowType = ROWTYPE_AGGREGATEINIT;
$staffdisciplinary_case->resetAttributes();
$staffdisciplinary_case_list->renderRow();
while ($staffdisciplinary_case_list->RecordCount < $staffdisciplinary_case_list->StopRecord) {
	$staffdisciplinary_case_list->RecordCount++;
	if ($staffdisciplinary_case_list->RecordCount >= $staffdisciplinary_case_list->StartRecord) {
		$staffdisciplinary_case_list->RowCount++;

		// Set up key count
		$staffdisciplinary_case_list->KeyCount = $staffdisciplinary_case_list->RowIndex;

		// Init row class and style
		$staffdisciplinary_case->resetAttributes();
		$staffdisciplinary_case->CssClass = "";
		if ($staffdisciplinary_case_list->isGridAdd()) {
		} else {
			$staffdisciplinary_case_list->loadRowValues($staffdisciplinary_case_list->Recordset); // Load row values
		}
		$staffdisciplinary_case->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$staffdisciplinary_case->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_case_list->RowCount, "id" => "r" . $staffdisciplinary_case_list->RowCount . "_staffdisciplinary_case", "data-rowtype" => $staffdisciplinary_case->RowType]);

		// Render row
		$staffdisciplinary_case_list->renderRow();

		// Render list options
		$staffdisciplinary_case_list->renderListOptions();
?>
	<tr <?php echo $staffdisciplinary_case->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_case_list->ListOptions->render("body", "left", $staffdisciplinary_case_list->RowCount);
?>
	<?php if ($staffdisciplinary_case_list->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_case_list->CaseNo->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_CaseNo">
<span<?php echo $staffdisciplinary_case_list->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->CaseNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_case_list->OffenseCode->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_OffenseCode">
<span<?php echo $staffdisciplinary_case_list->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->OffenseCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->ActionTaken->Visible) { // ActionTaken ?>
		<td data-name="ActionTaken" <?php echo $staffdisciplinary_case_list->ActionTaken->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_ActionTaken">
<span<?php echo $staffdisciplinary_case_list->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->ActionTaken->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->OffenseDate->Visible) { // OffenseDate ?>
		<td data-name="OffenseDate" <?php echo $staffdisciplinary_case_list->OffenseDate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_OffenseDate">
<span<?php echo $staffdisciplinary_case_list->OffenseDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->OffenseDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate" <?php echo $staffdisciplinary_case_list->ActionDate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_ActionDate">
<span<?php echo $staffdisciplinary_case_list->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->ActionDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td data-name="DateOfAppealLetter" <?php echo $staffdisciplinary_case_list->DateOfAppealLetter->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_case_list->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->DateOfAppealLetter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td data-name="DateAppealReceived" <?php echo $staffdisciplinary_case_list->DateAppealReceived->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_DateAppealReceived">
<span<?php echo $staffdisciplinary_case_list->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->DateAppealReceived->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->DateConcluded->Visible) { // DateConcluded ?>
		<td data-name="DateConcluded" <?php echo $staffdisciplinary_case_list->DateConcluded->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_DateConcluded">
<span<?php echo $staffdisciplinary_case_list->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->DateConcluded->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_case_list->AppealStatus->Visible) { // AppealStatus ?>
		<td data-name="AppealStatus" <?php echo $staffdisciplinary_case_list->AppealStatus->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_case_list->RowCount ?>_staffdisciplinary_case_AppealStatus">
<span<?php echo $staffdisciplinary_case_list->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_case_list->AppealStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_case_list->ListOptions->render("body", "right", $staffdisciplinary_case_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$staffdisciplinary_case_list->isGridAdd())
		$staffdisciplinary_case_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$staffdisciplinary_case->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffdisciplinary_case_list->Recordset)
	$staffdisciplinary_case_list->Recordset->Close();
?>
<?php if (!$staffdisciplinary_case_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staffdisciplinary_case_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_case_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_case_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffdisciplinary_case_list->TotalRecords == 0 && !$staffdisciplinary_case->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_case_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staffdisciplinary_case_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffdisciplinary_case_list->isExport()) { ?>
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
$staffdisciplinary_case_list->terminate();
?>