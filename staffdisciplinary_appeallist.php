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
$staffdisciplinary_appeal_list = new staffdisciplinary_appeal_list();

// Run the page
$staffdisciplinary_appeal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_appeal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffdisciplinary_appeal_list->isExport()) { ?>
<script>
var fstaffdisciplinary_appeallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaffdisciplinary_appeallist = currentForm = new ew.Form("fstaffdisciplinary_appeallist", "list");
	fstaffdisciplinary_appeallist.formKeyCountName = '<?php echo $staffdisciplinary_appeal_list->FormKeyCountName ?>';
	loadjs.done("fstaffdisciplinary_appeallist");
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
<?php if (!$staffdisciplinary_appeal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staffdisciplinary_appeal_list->TotalRecords > 0 && $staffdisciplinary_appeal_list->ExportOptions->visible()) { ?>
<?php $staffdisciplinary_appeal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->ImportOptions->visible()) { ?>
<?php $staffdisciplinary_appeal_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$staffdisciplinary_appeal_list->isExport() || Config("EXPORT_MASTER_RECORD") && $staffdisciplinary_appeal_list->isExport("print")) { ?>
<?php
if ($staffdisciplinary_appeal_list->DbMasterFilter != "" && $staffdisciplinary_appeal->getCurrentMasterTable() == "staffdisciplinary_case") {
	if ($staffdisciplinary_appeal_list->MasterRecordExists) {
		include_once "staffdisciplinary_casemaster.php";
	}
}
?>
<?php
if ($staffdisciplinary_appeal_list->DbMasterFilter != "" && $staffdisciplinary_appeal->getCurrentMasterTable() == "staff") {
	if ($staffdisciplinary_appeal_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$staffdisciplinary_appeal_list->renderOtherOptions();
?>
<?php $staffdisciplinary_appeal_list->showPageHeader(); ?>
<?php
$staffdisciplinary_appeal_list->showMessage();
?>
<?php if ($staffdisciplinary_appeal_list->TotalRecords > 0 || $staffdisciplinary_appeal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffdisciplinary_appeal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffdisciplinary_appeal">
<?php if (!$staffdisciplinary_appeal_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staffdisciplinary_appeal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_appeal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_appeal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaffdisciplinary_appeallist" id="fstaffdisciplinary_appeallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_appeal">
<?php if ($staffdisciplinary_appeal->getCurrentMasterTable() == "staffdisciplinary_case" && $staffdisciplinary_appeal->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staffdisciplinary_case">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_list->EmployeeID->getSessionValue()) ?>">
<input type="hidden" name="fk_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_appeal_list->CaseNo->getSessionValue()) ?>">
<input type="hidden" name="fk_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_appeal_list->OffenseCode->getSessionValue()) ?>">
<?php } ?>
<?php if ($staffdisciplinary_appeal->getCurrentMasterTable() == "staff" && $staffdisciplinary_appeal->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_appeal_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_staffdisciplinary_appeal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staffdisciplinary_appeal_list->TotalRecords > 0 || $staffdisciplinary_appeal_list->isGridEdit()) { ?>
<table id="tbl_staffdisciplinary_appeallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffdisciplinary_appeal->RowType = ROWTYPE_HEADER;

// Render list options
$staffdisciplinary_appeal_list->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_appeal_list->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_appeal_list->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->CaseNo) == "") { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_appeal_list->CaseNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_CaseNo" class="staffdisciplinary_appeal_CaseNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->CaseNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_appeal_list->CaseNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->CaseNo) ?>', 1);"><div id="elh_staffdisciplinary_appeal_CaseNo" class="staffdisciplinary_appeal_CaseNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->CaseNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->CaseNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->OffenseCode) == "") { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_appeal_list->OffenseCode->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_OffenseCode" class="staffdisciplinary_appeal_OffenseCode"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->OffenseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_appeal_list->OffenseCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->OffenseCode) ?>', 1);"><div id="elh_staffdisciplinary_appeal_OffenseCode" class="staffdisciplinary_appeal_OffenseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->OffenseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->OffenseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->AppealNo->Visible) { // AppealNo ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->AppealNo) == "") { ?>
		<th data-name="AppealNo" class="<?php echo $staffdisciplinary_appeal_list->AppealNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_AppealNo" class="staffdisciplinary_appeal_AppealNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->AppealNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealNo" class="<?php echo $staffdisciplinary_appeal_list->AppealNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->AppealNo) ?>', 1);"><div id="elh_staffdisciplinary_appeal_AppealNo" class="staffdisciplinary_appeal_AppealNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->AppealNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->AppealNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->AppealNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->DateOfAppealLetter) == "") { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_appeal_list->DateOfAppealLetter->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_DateOfAppealLetter" class="staffdisciplinary_appeal_DateOfAppealLetter"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->DateOfAppealLetter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfAppealLetter" class="<?php echo $staffdisciplinary_appeal_list->DateOfAppealLetter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->DateOfAppealLetter) ?>', 1);"><div id="elh_staffdisciplinary_appeal_DateOfAppealLetter" class="staffdisciplinary_appeal_DateOfAppealLetter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->DateOfAppealLetter->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->DateOfAppealLetter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->DateOfAppealLetter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->DateAppealReceived) == "") { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_appeal_list->DateAppealReceived->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_DateAppealReceived" class="staffdisciplinary_appeal_DateAppealReceived"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->DateAppealReceived->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateAppealReceived" class="<?php echo $staffdisciplinary_appeal_list->DateAppealReceived->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->DateAppealReceived) ?>', 1);"><div id="elh_staffdisciplinary_appeal_DateAppealReceived" class="staffdisciplinary_appeal_DateAppealReceived">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->DateAppealReceived->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->DateAppealReceived->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->DateAppealReceived->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->DateConcluded->Visible) { // DateConcluded ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->DateConcluded) == "") { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_appeal_list->DateConcluded->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_DateConcluded" class="staffdisciplinary_appeal_DateConcluded"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->DateConcluded->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateConcluded" class="<?php echo $staffdisciplinary_appeal_list->DateConcluded->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->DateConcluded) ?>', 1);"><div id="elh_staffdisciplinary_appeal_DateConcluded" class="staffdisciplinary_appeal_DateConcluded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->DateConcluded->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->DateConcluded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->DateConcluded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->AppealStatus->Visible) { // AppealStatus ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->AppealStatus) == "") { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_appeal_list->AppealStatus->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_AppealStatus" class="staffdisciplinary_appeal_AppealStatus"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->AppealStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppealStatus" class="<?php echo $staffdisciplinary_appeal_list->AppealStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->AppealStatus) ?>', 1);"><div id="elh_staffdisciplinary_appeal_AppealStatus" class="staffdisciplinary_appeal_AppealStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->AppealStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->AppealStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->AppealStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->LastUpdate->Visible) { // LastUpdate ?>
	<?php if ($staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->LastUpdate) == "") { ?>
		<th data-name="LastUpdate" class="<?php echo $staffdisciplinary_appeal_list->LastUpdate->headerCellClass() ?>"><div id="elh_staffdisciplinary_appeal_LastUpdate" class="staffdisciplinary_appeal_LastUpdate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->LastUpdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdate" class="<?php echo $staffdisciplinary_appeal_list->LastUpdate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_appeal_list->SortUrl($staffdisciplinary_appeal_list->LastUpdate) ?>', 1);"><div id="elh_staffdisciplinary_appeal_LastUpdate" class="staffdisciplinary_appeal_LastUpdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_appeal_list->LastUpdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_appeal_list->LastUpdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_appeal_list->LastUpdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_appeal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staffdisciplinary_appeal_list->ExportAll && $staffdisciplinary_appeal_list->isExport()) {
	$staffdisciplinary_appeal_list->StopRecord = $staffdisciplinary_appeal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staffdisciplinary_appeal_list->TotalRecords > $staffdisciplinary_appeal_list->StartRecord + $staffdisciplinary_appeal_list->DisplayRecords - 1)
		$staffdisciplinary_appeal_list->StopRecord = $staffdisciplinary_appeal_list->StartRecord + $staffdisciplinary_appeal_list->DisplayRecords - 1;
	else
		$staffdisciplinary_appeal_list->StopRecord = $staffdisciplinary_appeal_list->TotalRecords;
}
$staffdisciplinary_appeal_list->RecordCount = $staffdisciplinary_appeal_list->StartRecord - 1;
if ($staffdisciplinary_appeal_list->Recordset && !$staffdisciplinary_appeal_list->Recordset->EOF) {
	$staffdisciplinary_appeal_list->Recordset->moveFirst();
	$selectLimit = $staffdisciplinary_appeal_list->UseSelectLimit;
	if (!$selectLimit && $staffdisciplinary_appeal_list->StartRecord > 1)
		$staffdisciplinary_appeal_list->Recordset->move($staffdisciplinary_appeal_list->StartRecord - 1);
} elseif (!$staffdisciplinary_appeal->AllowAddDeleteRow && $staffdisciplinary_appeal_list->StopRecord == 0) {
	$staffdisciplinary_appeal_list->StopRecord = $staffdisciplinary_appeal->GridAddRowCount;
}

// Initialize aggregate
$staffdisciplinary_appeal->RowType = ROWTYPE_AGGREGATEINIT;
$staffdisciplinary_appeal->resetAttributes();
$staffdisciplinary_appeal_list->renderRow();
while ($staffdisciplinary_appeal_list->RecordCount < $staffdisciplinary_appeal_list->StopRecord) {
	$staffdisciplinary_appeal_list->RecordCount++;
	if ($staffdisciplinary_appeal_list->RecordCount >= $staffdisciplinary_appeal_list->StartRecord) {
		$staffdisciplinary_appeal_list->RowCount++;

		// Set up key count
		$staffdisciplinary_appeal_list->KeyCount = $staffdisciplinary_appeal_list->RowIndex;

		// Init row class and style
		$staffdisciplinary_appeal->resetAttributes();
		$staffdisciplinary_appeal->CssClass = "";
		if ($staffdisciplinary_appeal_list->isGridAdd()) {
		} else {
			$staffdisciplinary_appeal_list->loadRowValues($staffdisciplinary_appeal_list->Recordset); // Load row values
		}
		$staffdisciplinary_appeal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$staffdisciplinary_appeal->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_appeal_list->RowCount, "id" => "r" . $staffdisciplinary_appeal_list->RowCount . "_staffdisciplinary_appeal", "data-rowtype" => $staffdisciplinary_appeal->RowType]);

		// Render row
		$staffdisciplinary_appeal_list->renderRow();

		// Render list options
		$staffdisciplinary_appeal_list->renderListOptions();
?>
	<tr <?php echo $staffdisciplinary_appeal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_appeal_list->ListOptions->render("body", "left", $staffdisciplinary_appeal_list->RowCount);
?>
	<?php if ($staffdisciplinary_appeal_list->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_appeal_list->CaseNo->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_CaseNo">
<span<?php echo $staffdisciplinary_appeal_list->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->CaseNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_list->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_appeal_list->OffenseCode->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_list->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->OffenseCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_list->AppealNo->Visible) { // AppealNo ?>
		<td data-name="AppealNo" <?php echo $staffdisciplinary_appeal_list->AppealNo->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_AppealNo">
<span<?php echo $staffdisciplinary_appeal_list->AppealNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->AppealNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_list->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
		<td data-name="DateOfAppealLetter" <?php echo $staffdisciplinary_appeal_list->DateOfAppealLetter->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_appeal_list->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->DateOfAppealLetter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_list->DateAppealReceived->Visible) { // DateAppealReceived ?>
		<td data-name="DateAppealReceived" <?php echo $staffdisciplinary_appeal_list->DateAppealReceived->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_DateAppealReceived">
<span<?php echo $staffdisciplinary_appeal_list->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->DateAppealReceived->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_list->DateConcluded->Visible) { // DateConcluded ?>
		<td data-name="DateConcluded" <?php echo $staffdisciplinary_appeal_list->DateConcluded->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_DateConcluded">
<span<?php echo $staffdisciplinary_appeal_list->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->DateConcluded->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_list->AppealStatus->Visible) { // AppealStatus ?>
		<td data-name="AppealStatus" <?php echo $staffdisciplinary_appeal_list->AppealStatus->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_AppealStatus">
<span<?php echo $staffdisciplinary_appeal_list->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->AppealStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_appeal_list->LastUpdate->Visible) { // LastUpdate ?>
		<td data-name="LastUpdate" <?php echo $staffdisciplinary_appeal_list->LastUpdate->cellAttributes() ?>>
<span id="el<?php echo $staffdisciplinary_appeal_list->RowCount ?>_staffdisciplinary_appeal_LastUpdate">
<span<?php echo $staffdisciplinary_appeal_list->LastUpdate->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_list->LastUpdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_appeal_list->ListOptions->render("body", "right", $staffdisciplinary_appeal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$staffdisciplinary_appeal_list->isGridAdd())
		$staffdisciplinary_appeal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$staffdisciplinary_appeal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffdisciplinary_appeal_list->Recordset)
	$staffdisciplinary_appeal_list->Recordset->Close();
?>
<?php if (!$staffdisciplinary_appeal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staffdisciplinary_appeal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_appeal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_appeal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffdisciplinary_appeal_list->TotalRecords == 0 && !$staffdisciplinary_appeal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_appeal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staffdisciplinary_appeal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffdisciplinary_appeal_list->isExport()) { ?>
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
$staffdisciplinary_appeal_list->terminate();
?>