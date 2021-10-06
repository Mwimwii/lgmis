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
$termcouncil_term_list = new termcouncil_term_list();

// Run the page
$termcouncil_term_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$termcouncil_term_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$termcouncil_term_list->isExport()) { ?>
<script>
var ftermcouncil_termlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftermcouncil_termlist = currentForm = new ew.Form("ftermcouncil_termlist", "list");
	ftermcouncil_termlist.formKeyCountName = '<?php echo $termcouncil_term_list->FormKeyCountName ?>';
	loadjs.done("ftermcouncil_termlist");
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
<?php if (!$termcouncil_term_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($termcouncil_term_list->TotalRecords > 0 && $termcouncil_term_list->ExportOptions->visible()) { ?>
<?php $termcouncil_term_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($termcouncil_term_list->ImportOptions->visible()) { ?>
<?php $termcouncil_term_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$termcouncil_term_list->renderOtherOptions();
?>
<?php $termcouncil_term_list->showPageHeader(); ?>
<?php
$termcouncil_term_list->showMessage();
?>
<?php if ($termcouncil_term_list->TotalRecords > 0 || $termcouncil_term->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($termcouncil_term_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> termcouncil_term">
<?php if (!$termcouncil_term_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$termcouncil_term_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $termcouncil_term_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $termcouncil_term_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftermcouncil_termlist" id="ftermcouncil_termlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="termcouncil_term">
<div id="gmp_termcouncil_term" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($termcouncil_term_list->TotalRecords > 0 || $termcouncil_term_list->isGridEdit()) { ?>
<table id="tbl_termcouncil_termlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$termcouncil_term->RowType = ROWTYPE_HEADER;

// Render list options
$termcouncil_term_list->renderListOptions();

// Render list options (header, left)
$termcouncil_term_list->ListOptions->render("header", "left");
?>
<?php if ($termcouncil_term_list->TermStartYear->Visible) { // TermStartYear ?>
	<?php if ($termcouncil_term_list->SortUrl($termcouncil_term_list->TermStartYear) == "") { ?>
		<th data-name="TermStartYear" class="<?php echo $termcouncil_term_list->TermStartYear->headerCellClass() ?>"><div id="elh_termcouncil_term_TermStartYear" class="termcouncil_term_TermStartYear"><div class="ew-table-header-caption"><?php echo $termcouncil_term_list->TermStartYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TermStartYear" class="<?php echo $termcouncil_term_list->TermStartYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $termcouncil_term_list->SortUrl($termcouncil_term_list->TermStartYear) ?>', 1);"><div id="elh_termcouncil_term_TermStartYear" class="termcouncil_term_TermStartYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $termcouncil_term_list->TermStartYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($termcouncil_term_list->TermStartYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($termcouncil_term_list->TermStartYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($termcouncil_term_list->TermYears->Visible) { // TermYears ?>
	<?php if ($termcouncil_term_list->SortUrl($termcouncil_term_list->TermYears) == "") { ?>
		<th data-name="TermYears" class="<?php echo $termcouncil_term_list->TermYears->headerCellClass() ?>"><div id="elh_termcouncil_term_TermYears" class="termcouncil_term_TermYears"><div class="ew-table-header-caption"><?php echo $termcouncil_term_list->TermYears->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TermYears" class="<?php echo $termcouncil_term_list->TermYears->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $termcouncil_term_list->SortUrl($termcouncil_term_list->TermYears) ?>', 1);"><div id="elh_termcouncil_term_TermYears" class="termcouncil_term_TermYears">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $termcouncil_term_list->TermYears->caption() ?></span><span class="ew-table-header-sort"><?php if ($termcouncil_term_list->TermYears->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($termcouncil_term_list->TermYears->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$termcouncil_term_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($termcouncil_term_list->ExportAll && $termcouncil_term_list->isExport()) {
	$termcouncil_term_list->StopRecord = $termcouncil_term_list->TotalRecords;
} else {

	// Set the last record to display
	if ($termcouncil_term_list->TotalRecords > $termcouncil_term_list->StartRecord + $termcouncil_term_list->DisplayRecords - 1)
		$termcouncil_term_list->StopRecord = $termcouncil_term_list->StartRecord + $termcouncil_term_list->DisplayRecords - 1;
	else
		$termcouncil_term_list->StopRecord = $termcouncil_term_list->TotalRecords;
}
$termcouncil_term_list->RecordCount = $termcouncil_term_list->StartRecord - 1;
if ($termcouncil_term_list->Recordset && !$termcouncil_term_list->Recordset->EOF) {
	$termcouncil_term_list->Recordset->moveFirst();
	$selectLimit = $termcouncil_term_list->UseSelectLimit;
	if (!$selectLimit && $termcouncil_term_list->StartRecord > 1)
		$termcouncil_term_list->Recordset->move($termcouncil_term_list->StartRecord - 1);
} elseif (!$termcouncil_term->AllowAddDeleteRow && $termcouncil_term_list->StopRecord == 0) {
	$termcouncil_term_list->StopRecord = $termcouncil_term->GridAddRowCount;
}

// Initialize aggregate
$termcouncil_term->RowType = ROWTYPE_AGGREGATEINIT;
$termcouncil_term->resetAttributes();
$termcouncil_term_list->renderRow();
while ($termcouncil_term_list->RecordCount < $termcouncil_term_list->StopRecord) {
	$termcouncil_term_list->RecordCount++;
	if ($termcouncil_term_list->RecordCount >= $termcouncil_term_list->StartRecord) {
		$termcouncil_term_list->RowCount++;

		// Set up key count
		$termcouncil_term_list->KeyCount = $termcouncil_term_list->RowIndex;

		// Init row class and style
		$termcouncil_term->resetAttributes();
		$termcouncil_term->CssClass = "";
		if ($termcouncil_term_list->isGridAdd()) {
		} else {
			$termcouncil_term_list->loadRowValues($termcouncil_term_list->Recordset); // Load row values
		}
		$termcouncil_term->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$termcouncil_term->RowAttrs->merge(["data-rowindex" => $termcouncil_term_list->RowCount, "id" => "r" . $termcouncil_term_list->RowCount . "_termcouncil_term", "data-rowtype" => $termcouncil_term->RowType]);

		// Render row
		$termcouncil_term_list->renderRow();

		// Render list options
		$termcouncil_term_list->renderListOptions();
?>
	<tr <?php echo $termcouncil_term->rowAttributes() ?>>
<?php

// Render list options (body, left)
$termcouncil_term_list->ListOptions->render("body", "left", $termcouncil_term_list->RowCount);
?>
	<?php if ($termcouncil_term_list->TermStartYear->Visible) { // TermStartYear ?>
		<td data-name="TermStartYear" <?php echo $termcouncil_term_list->TermStartYear->cellAttributes() ?>>
<span id="el<?php echo $termcouncil_term_list->RowCount ?>_termcouncil_term_TermStartYear">
<span<?php echo $termcouncil_term_list->TermStartYear->viewAttributes() ?>><?php echo $termcouncil_term_list->TermStartYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($termcouncil_term_list->TermYears->Visible) { // TermYears ?>
		<td data-name="TermYears" <?php echo $termcouncil_term_list->TermYears->cellAttributes() ?>>
<span id="el<?php echo $termcouncil_term_list->RowCount ?>_termcouncil_term_TermYears">
<span<?php echo $termcouncil_term_list->TermYears->viewAttributes() ?>><?php echo $termcouncil_term_list->TermYears->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$termcouncil_term_list->ListOptions->render("body", "right", $termcouncil_term_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$termcouncil_term_list->isGridAdd())
		$termcouncil_term_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$termcouncil_term->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($termcouncil_term_list->Recordset)
	$termcouncil_term_list->Recordset->Close();
?>
<?php if (!$termcouncil_term_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$termcouncil_term_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $termcouncil_term_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $termcouncil_term_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($termcouncil_term_list->TotalRecords == 0 && !$termcouncil_term->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $termcouncil_term_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$termcouncil_term_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$termcouncil_term_list->isExport()) { ?>
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
$termcouncil_term_list->terminate();
?>