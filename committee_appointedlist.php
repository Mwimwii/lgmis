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
$committee_appointed_list = new committee_appointed_list();

// Run the page
$committee_appointed_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_appointed_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$committee_appointed_list->isExport()) { ?>
<script>
var fcommittee_appointedlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcommittee_appointedlist = currentForm = new ew.Form("fcommittee_appointedlist", "list");
	fcommittee_appointedlist.formKeyCountName = '<?php echo $committee_appointed_list->FormKeyCountName ?>';
	loadjs.done("fcommittee_appointedlist");
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
<?php if (!$committee_appointed_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($committee_appointed_list->TotalRecords > 0 && $committee_appointed_list->ExportOptions->visible()) { ?>
<?php $committee_appointed_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($committee_appointed_list->ImportOptions->visible()) { ?>
<?php $committee_appointed_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$committee_appointed_list->isExport() || Config("EXPORT_MASTER_RECORD") && $committee_appointed_list->isExport("print")) { ?>
<?php
if ($committee_appointed_list->DbMasterFilter != "" && $committee_appointed->getCurrentMasterTable() == "councillorship") {
	if ($committee_appointed_list->MasterRecordExists) {
		include_once "councillorshipmaster.php";
	}
}
?>
<?php } ?>
<?php
$committee_appointed_list->renderOtherOptions();
?>
<?php $committee_appointed_list->showPageHeader(); ?>
<?php
$committee_appointed_list->showMessage();
?>
<?php if ($committee_appointed_list->TotalRecords > 0 || $committee_appointed->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($committee_appointed_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> committee_appointed">
<?php if (!$committee_appointed_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$committee_appointed_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_appointed_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $committee_appointed_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcommittee_appointedlist" id="fcommittee_appointedlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee_appointed">
<?php if ($committee_appointed->getCurrentMasterTable() == "councillorship" && $committee_appointed->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillorship">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($committee_appointed_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_committee_appointed" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($committee_appointed_list->TotalRecords > 0 || $committee_appointed_list->isGridEdit()) { ?>
<table id="tbl_committee_appointedlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$committee_appointed->RowType = ROWTYPE_HEADER;

// Render list options
$committee_appointed_list->renderListOptions();

// Render list options (header, left)
$committee_appointed_list->ListOptions->render("header", "left");
?>
<?php if ($committee_appointed_list->CommitteCode->Visible) { // CommitteCode ?>
	<?php if ($committee_appointed_list->SortUrl($committee_appointed_list->CommitteCode) == "") { ?>
		<th data-name="CommitteCode" class="<?php echo $committee_appointed_list->CommitteCode->headerCellClass() ?>"><div id="elh_committee_appointed_CommitteCode" class="committee_appointed_CommitteCode"><div class="ew-table-header-caption"><?php echo $committee_appointed_list->CommitteCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteCode" class="<?php echo $committee_appointed_list->CommitteCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $committee_appointed_list->SortUrl($committee_appointed_list->CommitteCode) ?>', 1);"><div id="elh_committee_appointed_CommitteCode" class="committee_appointed_CommitteCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_appointed_list->CommitteCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_appointed_list->CommitteCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_appointed_list->CommitteCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($committee_appointed_list->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($committee_appointed_list->SortUrl($committee_appointed_list->CommitteeRole) == "") { ?>
		<th data-name="CommitteeRole" class="<?php echo $committee_appointed_list->CommitteeRole->headerCellClass() ?>"><div id="elh_committee_appointed_CommitteeRole" class="committee_appointed_CommitteeRole"><div class="ew-table-header-caption"><?php echo $committee_appointed_list->CommitteeRole->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeRole" class="<?php echo $committee_appointed_list->CommitteeRole->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $committee_appointed_list->SortUrl($committee_appointed_list->CommitteeRole) ?>', 1);"><div id="elh_committee_appointed_CommitteeRole" class="committee_appointed_CommitteeRole">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_appointed_list->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_appointed_list->CommitteeRole->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_appointed_list->CommitteeRole->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$committee_appointed_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($committee_appointed_list->ExportAll && $committee_appointed_list->isExport()) {
	$committee_appointed_list->StopRecord = $committee_appointed_list->TotalRecords;
} else {

	// Set the last record to display
	if ($committee_appointed_list->TotalRecords > $committee_appointed_list->StartRecord + $committee_appointed_list->DisplayRecords - 1)
		$committee_appointed_list->StopRecord = $committee_appointed_list->StartRecord + $committee_appointed_list->DisplayRecords - 1;
	else
		$committee_appointed_list->StopRecord = $committee_appointed_list->TotalRecords;
}
$committee_appointed_list->RecordCount = $committee_appointed_list->StartRecord - 1;
if ($committee_appointed_list->Recordset && !$committee_appointed_list->Recordset->EOF) {
	$committee_appointed_list->Recordset->moveFirst();
	$selectLimit = $committee_appointed_list->UseSelectLimit;
	if (!$selectLimit && $committee_appointed_list->StartRecord > 1)
		$committee_appointed_list->Recordset->move($committee_appointed_list->StartRecord - 1);
} elseif (!$committee_appointed->AllowAddDeleteRow && $committee_appointed_list->StopRecord == 0) {
	$committee_appointed_list->StopRecord = $committee_appointed->GridAddRowCount;
}

// Initialize aggregate
$committee_appointed->RowType = ROWTYPE_AGGREGATEINIT;
$committee_appointed->resetAttributes();
$committee_appointed_list->renderRow();
while ($committee_appointed_list->RecordCount < $committee_appointed_list->StopRecord) {
	$committee_appointed_list->RecordCount++;
	if ($committee_appointed_list->RecordCount >= $committee_appointed_list->StartRecord) {
		$committee_appointed_list->RowCount++;

		// Set up key count
		$committee_appointed_list->KeyCount = $committee_appointed_list->RowIndex;

		// Init row class and style
		$committee_appointed->resetAttributes();
		$committee_appointed->CssClass = "";
		if ($committee_appointed_list->isGridAdd()) {
		} else {
			$committee_appointed_list->loadRowValues($committee_appointed_list->Recordset); // Load row values
		}
		$committee_appointed->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$committee_appointed->RowAttrs->merge(["data-rowindex" => $committee_appointed_list->RowCount, "id" => "r" . $committee_appointed_list->RowCount . "_committee_appointed", "data-rowtype" => $committee_appointed->RowType]);

		// Render row
		$committee_appointed_list->renderRow();

		// Render list options
		$committee_appointed_list->renderListOptions();
?>
	<tr <?php echo $committee_appointed->rowAttributes() ?>>
<?php

// Render list options (body, left)
$committee_appointed_list->ListOptions->render("body", "left", $committee_appointed_list->RowCount);
?>
	<?php if ($committee_appointed_list->CommitteCode->Visible) { // CommitteCode ?>
		<td data-name="CommitteCode" <?php echo $committee_appointed_list->CommitteCode->cellAttributes() ?>>
<span id="el<?php echo $committee_appointed_list->RowCount ?>_committee_appointed_CommitteCode">
<span<?php echo $committee_appointed_list->CommitteCode->viewAttributes() ?>><?php echo $committee_appointed_list->CommitteCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($committee_appointed_list->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole" <?php echo $committee_appointed_list->CommitteeRole->cellAttributes() ?>>
<span id="el<?php echo $committee_appointed_list->RowCount ?>_committee_appointed_CommitteeRole">
<span<?php echo $committee_appointed_list->CommitteeRole->viewAttributes() ?>><?php echo $committee_appointed_list->CommitteeRole->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$committee_appointed_list->ListOptions->render("body", "right", $committee_appointed_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$committee_appointed_list->isGridAdd())
		$committee_appointed_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$committee_appointed->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($committee_appointed_list->Recordset)
	$committee_appointed_list->Recordset->Close();
?>
<?php if (!$committee_appointed_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$committee_appointed_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_appointed_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $committee_appointed_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($committee_appointed_list->TotalRecords == 0 && !$committee_appointed->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $committee_appointed_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$committee_appointed_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$committee_appointed_list->isExport()) { ?>
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
$committee_appointed_list->terminate();
?>