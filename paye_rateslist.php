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
$paye_rates_list = new paye_rates_list();

// Run the page
$paye_rates_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_rates_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$paye_rates_list->isExport()) { ?>
<script>
var fpaye_rateslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpaye_rateslist = currentForm = new ew.Form("fpaye_rateslist", "list");
	fpaye_rateslist.formKeyCountName = '<?php echo $paye_rates_list->FormKeyCountName ?>';

	// Validate form
	fpaye_rateslist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($paye_rates_list->band->Required) { ?>
				elm = this.getElements("x" + infix + "_band");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_list->band->caption(), $paye_rates_list->band->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_band");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_list->band->errorMessage()) ?>");
			<?php if ($paye_rates_list->MinimumIncome->Required) { ?>
				elm = this.getElements("x" + infix + "_MinimumIncome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_list->MinimumIncome->caption(), $paye_rates_list->MinimumIncome->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MinimumIncome");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_list->MinimumIncome->errorMessage()) ?>");
			<?php if ($paye_rates_list->MaximumIncome->Required) { ?>
				elm = this.getElements("x" + infix + "_MaximumIncome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_list->MaximumIncome->caption(), $paye_rates_list->MaximumIncome->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaximumIncome");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_list->MaximumIncome->errorMessage()) ?>");
			<?php if ($paye_rates_list->PAYERate->Required) { ?>
				elm = this.getElements("x" + infix + "_PAYERate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_list->PAYERate->caption(), $paye_rates_list->PAYERate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PAYERate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_list->PAYERate->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fpaye_rateslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "band", false)) return false;
		if (ew.valueChanged(fobj, infix, "MinimumIncome", false)) return false;
		if (ew.valueChanged(fobj, infix, "MaximumIncome", false)) return false;
		if (ew.valueChanged(fobj, infix, "PAYERate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpaye_rateslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpaye_rateslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpaye_rateslist");
});
var fpaye_rateslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpaye_rateslistsrch = currentSearchForm = new ew.Form("fpaye_rateslistsrch");

	// Dynamic selection lists
	// Filters

	fpaye_rateslistsrch.filterList = <?php echo $paye_rates_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpaye_rateslistsrch.initSearchPanel = true;
	loadjs.done("fpaye_rateslistsrch");
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
<?php if (!$paye_rates_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($paye_rates_list->TotalRecords > 0 && $paye_rates_list->ExportOptions->visible()) { ?>
<?php $paye_rates_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_rates_list->ImportOptions->visible()) { ?>
<?php $paye_rates_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_rates_list->SearchOptions->visible()) { ?>
<?php $paye_rates_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($paye_rates_list->FilterOptions->visible()) { ?>
<?php $paye_rates_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$paye_rates_list->renderOtherOptions();
?>
<?php $paye_rates_list->showPageHeader(); ?>
<?php
$paye_rates_list->showMessage();
?>
<?php if ($paye_rates_list->TotalRecords > 0 || $paye_rates->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($paye_rates_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> paye_rates">
<?php if (!$paye_rates_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$paye_rates_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_rates_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_rates_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpaye_rateslist" id="fpaye_rateslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_rates">
<div id="gmp_paye_rates" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($paye_rates_list->TotalRecords > 0 || $paye_rates_list->isGridEdit()) { ?>
<table id="tbl_paye_rateslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$paye_rates->RowType = ROWTYPE_HEADER;

// Render list options
$paye_rates_list->renderListOptions();

// Render list options (header, left)
$paye_rates_list->ListOptions->render("header", "left");
?>
<?php if ($paye_rates_list->band->Visible) { // band ?>
	<?php if ($paye_rates_list->SortUrl($paye_rates_list->band) == "") { ?>
		<th data-name="band" class="<?php echo $paye_rates_list->band->headerCellClass() ?>"><div id="elh_paye_rates_band" class="paye_rates_band"><div class="ew-table-header-caption"><?php echo $paye_rates_list->band->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="band" class="<?php echo $paye_rates_list->band->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_rates_list->SortUrl($paye_rates_list->band) ?>', 1);"><div id="elh_paye_rates_band" class="paye_rates_band">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_rates_list->band->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_rates_list->band->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_rates_list->band->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_rates_list->MinimumIncome->Visible) { // MinimumIncome ?>
	<?php if ($paye_rates_list->SortUrl($paye_rates_list->MinimumIncome) == "") { ?>
		<th data-name="MinimumIncome" class="<?php echo $paye_rates_list->MinimumIncome->headerCellClass() ?>"><div id="elh_paye_rates_MinimumIncome" class="paye_rates_MinimumIncome"><div class="ew-table-header-caption"><?php echo $paye_rates_list->MinimumIncome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MinimumIncome" class="<?php echo $paye_rates_list->MinimumIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_rates_list->SortUrl($paye_rates_list->MinimumIncome) ?>', 1);"><div id="elh_paye_rates_MinimumIncome" class="paye_rates_MinimumIncome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_rates_list->MinimumIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_rates_list->MinimumIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_rates_list->MinimumIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_rates_list->MaximumIncome->Visible) { // MaximumIncome ?>
	<?php if ($paye_rates_list->SortUrl($paye_rates_list->MaximumIncome) == "") { ?>
		<th data-name="MaximumIncome" class="<?php echo $paye_rates_list->MaximumIncome->headerCellClass() ?>"><div id="elh_paye_rates_MaximumIncome" class="paye_rates_MaximumIncome"><div class="ew-table-header-caption"><?php echo $paye_rates_list->MaximumIncome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaximumIncome" class="<?php echo $paye_rates_list->MaximumIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_rates_list->SortUrl($paye_rates_list->MaximumIncome) ?>', 1);"><div id="elh_paye_rates_MaximumIncome" class="paye_rates_MaximumIncome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_rates_list->MaximumIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_rates_list->MaximumIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_rates_list->MaximumIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_rates_list->PAYERate->Visible) { // PAYERate ?>
	<?php if ($paye_rates_list->SortUrl($paye_rates_list->PAYERate) == "") { ?>
		<th data-name="PAYERate" class="<?php echo $paye_rates_list->PAYERate->headerCellClass() ?>"><div id="elh_paye_rates_PAYERate" class="paye_rates_PAYERate"><div class="ew-table-header-caption"><?php echo $paye_rates_list->PAYERate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PAYERate" class="<?php echo $paye_rates_list->PAYERate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_rates_list->SortUrl($paye_rates_list->PAYERate) ?>', 1);"><div id="elh_paye_rates_PAYERate" class="paye_rates_PAYERate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_rates_list->PAYERate->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_rates_list->PAYERate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_rates_list->PAYERate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$paye_rates_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($paye_rates_list->ExportAll && $paye_rates_list->isExport()) {
	$paye_rates_list->StopRecord = $paye_rates_list->TotalRecords;
} else {

	// Set the last record to display
	if ($paye_rates_list->TotalRecords > $paye_rates_list->StartRecord + $paye_rates_list->DisplayRecords - 1)
		$paye_rates_list->StopRecord = $paye_rates_list->StartRecord + $paye_rates_list->DisplayRecords - 1;
	else
		$paye_rates_list->StopRecord = $paye_rates_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($paye_rates->isConfirm() || $paye_rates_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($paye_rates_list->FormKeyCountName) && ($paye_rates_list->isGridAdd() || $paye_rates_list->isGridEdit() || $paye_rates->isConfirm())) {
		$paye_rates_list->KeyCount = $CurrentForm->getValue($paye_rates_list->FormKeyCountName);
		$paye_rates_list->StopRecord = $paye_rates_list->StartRecord + $paye_rates_list->KeyCount - 1;
	}
}
$paye_rates_list->RecordCount = $paye_rates_list->StartRecord - 1;
if ($paye_rates_list->Recordset && !$paye_rates_list->Recordset->EOF) {
	$paye_rates_list->Recordset->moveFirst();
	$selectLimit = $paye_rates_list->UseSelectLimit;
	if (!$selectLimit && $paye_rates_list->StartRecord > 1)
		$paye_rates_list->Recordset->move($paye_rates_list->StartRecord - 1);
} elseif (!$paye_rates->AllowAddDeleteRow && $paye_rates_list->StopRecord == 0) {
	$paye_rates_list->StopRecord = $paye_rates->GridAddRowCount;
}

// Initialize aggregate
$paye_rates->RowType = ROWTYPE_AGGREGATEINIT;
$paye_rates->resetAttributes();
$paye_rates_list->renderRow();
if ($paye_rates_list->isGridAdd())
	$paye_rates_list->RowIndex = 0;
if ($paye_rates_list->isGridEdit())
	$paye_rates_list->RowIndex = 0;
while ($paye_rates_list->RecordCount < $paye_rates_list->StopRecord) {
	$paye_rates_list->RecordCount++;
	if ($paye_rates_list->RecordCount >= $paye_rates_list->StartRecord) {
		$paye_rates_list->RowCount++;
		if ($paye_rates_list->isGridAdd() || $paye_rates_list->isGridEdit() || $paye_rates->isConfirm()) {
			$paye_rates_list->RowIndex++;
			$CurrentForm->Index = $paye_rates_list->RowIndex;
			if ($CurrentForm->hasValue($paye_rates_list->FormActionName) && ($paye_rates->isConfirm() || $paye_rates_list->EventCancelled))
				$paye_rates_list->RowAction = strval($CurrentForm->getValue($paye_rates_list->FormActionName));
			elseif ($paye_rates_list->isGridAdd())
				$paye_rates_list->RowAction = "insert";
			else
				$paye_rates_list->RowAction = "";
		}

		// Set up key count
		$paye_rates_list->KeyCount = $paye_rates_list->RowIndex;

		// Init row class and style
		$paye_rates->resetAttributes();
		$paye_rates->CssClass = "";
		if ($paye_rates_list->isGridAdd()) {
			$paye_rates_list->loadRowValues(); // Load default values
		} else {
			$paye_rates_list->loadRowValues($paye_rates_list->Recordset); // Load row values
		}
		$paye_rates->RowType = ROWTYPE_VIEW; // Render view
		if ($paye_rates_list->isGridAdd()) // Grid add
			$paye_rates->RowType = ROWTYPE_ADD; // Render add
		if ($paye_rates_list->isGridAdd() && $paye_rates->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$paye_rates_list->restoreCurrentRowFormValues($paye_rates_list->RowIndex); // Restore form values
		if ($paye_rates_list->isGridEdit()) { // Grid edit
			if ($paye_rates->EventCancelled)
				$paye_rates_list->restoreCurrentRowFormValues($paye_rates_list->RowIndex); // Restore form values
			if ($paye_rates_list->RowAction == "insert")
				$paye_rates->RowType = ROWTYPE_ADD; // Render add
			else
				$paye_rates->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($paye_rates_list->isGridEdit() && ($paye_rates->RowType == ROWTYPE_EDIT || $paye_rates->RowType == ROWTYPE_ADD) && $paye_rates->EventCancelled) // Update failed
			$paye_rates_list->restoreCurrentRowFormValues($paye_rates_list->RowIndex); // Restore form values
		if ($paye_rates->RowType == ROWTYPE_EDIT) // Edit row
			$paye_rates_list->EditRowCount++;

		// Set up row id / data-rowindex
		$paye_rates->RowAttrs->merge(["data-rowindex" => $paye_rates_list->RowCount, "id" => "r" . $paye_rates_list->RowCount . "_paye_rates", "data-rowtype" => $paye_rates->RowType]);

		// Render row
		$paye_rates_list->renderRow();

		// Render list options
		$paye_rates_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($paye_rates_list->RowAction != "delete" && $paye_rates_list->RowAction != "insertdelete" && !($paye_rates_list->RowAction == "insert" && $paye_rates->isConfirm() && $paye_rates_list->emptyRow())) {
?>
	<tr <?php echo $paye_rates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paye_rates_list->ListOptions->render("body", "left", $paye_rates_list->RowCount);
?>
	<?php if ($paye_rates_list->band->Visible) { // band ?>
		<td data-name="band" <?php echo $paye_rates_list->band->cellAttributes() ?>>
<?php if ($paye_rates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_band" class="form-group">
<input type="text" data-table="paye_rates" data-field="x_band" name="x<?php echo $paye_rates_list->RowIndex ?>_band" id="x<?php echo $paye_rates_list->RowIndex ?>_band" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->band->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->band->EditValue ?>"<?php echo $paye_rates_list->band->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_band" name="o<?php echo $paye_rates_list->RowIndex ?>_band" id="o<?php echo $paye_rates_list->RowIndex ?>_band" value="<?php echo HtmlEncode($paye_rates_list->band->OldValue) ?>">
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="paye_rates" data-field="x_band" name="x<?php echo $paye_rates_list->RowIndex ?>_band" id="x<?php echo $paye_rates_list->RowIndex ?>_band" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->band->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->band->EditValue ?>"<?php echo $paye_rates_list->band->editAttributes() ?>>
<input type="hidden" data-table="paye_rates" data-field="x_band" name="o<?php echo $paye_rates_list->RowIndex ?>_band" id="o<?php echo $paye_rates_list->RowIndex ?>_band" value="<?php echo HtmlEncode($paye_rates_list->band->OldValue != null ? $paye_rates_list->band->OldValue : $paye_rates_list->band->CurrentValue) ?>">
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_band">
<span<?php echo $paye_rates_list->band->viewAttributes() ?>><?php echo $paye_rates_list->band->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paye_rates_list->MinimumIncome->Visible) { // MinimumIncome ?>
		<td data-name="MinimumIncome" <?php echo $paye_rates_list->MinimumIncome->cellAttributes() ?>>
<?php if ($paye_rates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_MinimumIncome" class="form-group">
<input type="text" data-table="paye_rates" data-field="x_MinimumIncome" name="x<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" id="x<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->MinimumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->MinimumIncome->EditValue ?>"<?php echo $paye_rates_list->MinimumIncome->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_MinimumIncome" name="o<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" id="o<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" value="<?php echo HtmlEncode($paye_rates_list->MinimumIncome->OldValue) ?>">
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_MinimumIncome" class="form-group">
<input type="text" data-table="paye_rates" data-field="x_MinimumIncome" name="x<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" id="x<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->MinimumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->MinimumIncome->EditValue ?>"<?php echo $paye_rates_list->MinimumIncome->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_MinimumIncome">
<span<?php echo $paye_rates_list->MinimumIncome->viewAttributes() ?>><?php echo $paye_rates_list->MinimumIncome->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paye_rates_list->MaximumIncome->Visible) { // MaximumIncome ?>
		<td data-name="MaximumIncome" <?php echo $paye_rates_list->MaximumIncome->cellAttributes() ?>>
<?php if ($paye_rates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_MaximumIncome" class="form-group">
<input type="text" data-table="paye_rates" data-field="x_MaximumIncome" name="x<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" id="x<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->MaximumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->MaximumIncome->EditValue ?>"<?php echo $paye_rates_list->MaximumIncome->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_MaximumIncome" name="o<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" id="o<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" value="<?php echo HtmlEncode($paye_rates_list->MaximumIncome->OldValue) ?>">
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_MaximumIncome" class="form-group">
<input type="text" data-table="paye_rates" data-field="x_MaximumIncome" name="x<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" id="x<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->MaximumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->MaximumIncome->EditValue ?>"<?php echo $paye_rates_list->MaximumIncome->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_MaximumIncome">
<span<?php echo $paye_rates_list->MaximumIncome->viewAttributes() ?>><?php echo $paye_rates_list->MaximumIncome->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($paye_rates_list->PAYERate->Visible) { // PAYERate ?>
		<td data-name="PAYERate" <?php echo $paye_rates_list->PAYERate->cellAttributes() ?>>
<?php if ($paye_rates->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_PAYERate" class="form-group">
<input type="text" data-table="paye_rates" data-field="x_PAYERate" name="x<?php echo $paye_rates_list->RowIndex ?>_PAYERate" id="x<?php echo $paye_rates_list->RowIndex ?>_PAYERate" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->PAYERate->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->PAYERate->EditValue ?>"<?php echo $paye_rates_list->PAYERate->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_PAYERate" name="o<?php echo $paye_rates_list->RowIndex ?>_PAYERate" id="o<?php echo $paye_rates_list->RowIndex ?>_PAYERate" value="<?php echo HtmlEncode($paye_rates_list->PAYERate->OldValue) ?>">
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_PAYERate" class="form-group">
<input type="text" data-table="paye_rates" data-field="x_PAYERate" name="x<?php echo $paye_rates_list->RowIndex ?>_PAYERate" id="x<?php echo $paye_rates_list->RowIndex ?>_PAYERate" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->PAYERate->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->PAYERate->EditValue ?>"<?php echo $paye_rates_list->PAYERate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($paye_rates->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $paye_rates_list->RowCount ?>_paye_rates_PAYERate">
<span<?php echo $paye_rates_list->PAYERate->viewAttributes() ?>><?php echo $paye_rates_list->PAYERate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paye_rates_list->ListOptions->render("body", "right", $paye_rates_list->RowCount);
?>
	</tr>
<?php if ($paye_rates->RowType == ROWTYPE_ADD || $paye_rates->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpaye_rateslist", "load"], function() {
	fpaye_rateslist.updateLists(<?php echo $paye_rates_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$paye_rates_list->isGridAdd())
		if (!$paye_rates_list->Recordset->EOF)
			$paye_rates_list->Recordset->moveNext();
}
?>
<?php
	if ($paye_rates_list->isGridAdd() || $paye_rates_list->isGridEdit()) {
		$paye_rates_list->RowIndex = '$rowindex$';
		$paye_rates_list->loadRowValues();

		// Set row properties
		$paye_rates->resetAttributes();
		$paye_rates->RowAttrs->merge(["data-rowindex" => $paye_rates_list->RowIndex, "id" => "r0_paye_rates", "data-rowtype" => ROWTYPE_ADD]);
		$paye_rates->RowAttrs->appendClass("ew-template");
		$paye_rates->RowType = ROWTYPE_ADD;

		// Render row
		$paye_rates_list->renderRow();

		// Render list options
		$paye_rates_list->renderListOptions();
		$paye_rates_list->StartRowCount = 0;
?>
	<tr <?php echo $paye_rates->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paye_rates_list->ListOptions->render("body", "left", $paye_rates_list->RowIndex);
?>
	<?php if ($paye_rates_list->band->Visible) { // band ?>
		<td data-name="band">
<span id="el$rowindex$_paye_rates_band" class="form-group paye_rates_band">
<input type="text" data-table="paye_rates" data-field="x_band" name="x<?php echo $paye_rates_list->RowIndex ?>_band" id="x<?php echo $paye_rates_list->RowIndex ?>_band" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->band->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->band->EditValue ?>"<?php echo $paye_rates_list->band->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_band" name="o<?php echo $paye_rates_list->RowIndex ?>_band" id="o<?php echo $paye_rates_list->RowIndex ?>_band" value="<?php echo HtmlEncode($paye_rates_list->band->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paye_rates_list->MinimumIncome->Visible) { // MinimumIncome ?>
		<td data-name="MinimumIncome">
<span id="el$rowindex$_paye_rates_MinimumIncome" class="form-group paye_rates_MinimumIncome">
<input type="text" data-table="paye_rates" data-field="x_MinimumIncome" name="x<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" id="x<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->MinimumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->MinimumIncome->EditValue ?>"<?php echo $paye_rates_list->MinimumIncome->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_MinimumIncome" name="o<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" id="o<?php echo $paye_rates_list->RowIndex ?>_MinimumIncome" value="<?php echo HtmlEncode($paye_rates_list->MinimumIncome->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paye_rates_list->MaximumIncome->Visible) { // MaximumIncome ?>
		<td data-name="MaximumIncome">
<span id="el$rowindex$_paye_rates_MaximumIncome" class="form-group paye_rates_MaximumIncome">
<input type="text" data-table="paye_rates" data-field="x_MaximumIncome" name="x<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" id="x<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->MaximumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->MaximumIncome->EditValue ?>"<?php echo $paye_rates_list->MaximumIncome->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_MaximumIncome" name="o<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" id="o<?php echo $paye_rates_list->RowIndex ?>_MaximumIncome" value="<?php echo HtmlEncode($paye_rates_list->MaximumIncome->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($paye_rates_list->PAYERate->Visible) { // PAYERate ?>
		<td data-name="PAYERate">
<span id="el$rowindex$_paye_rates_PAYERate" class="form-group paye_rates_PAYERate">
<input type="text" data-table="paye_rates" data-field="x_PAYERate" name="x<?php echo $paye_rates_list->RowIndex ?>_PAYERate" id="x<?php echo $paye_rates_list->RowIndex ?>_PAYERate" size="30" placeholder="<?php echo HtmlEncode($paye_rates_list->PAYERate->getPlaceHolder()) ?>" value="<?php echo $paye_rates_list->PAYERate->EditValue ?>"<?php echo $paye_rates_list->PAYERate->editAttributes() ?>>
</span>
<input type="hidden" data-table="paye_rates" data-field="x_PAYERate" name="o<?php echo $paye_rates_list->RowIndex ?>_PAYERate" id="o<?php echo $paye_rates_list->RowIndex ?>_PAYERate" value="<?php echo HtmlEncode($paye_rates_list->PAYERate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paye_rates_list->ListOptions->render("body", "right", $paye_rates_list->RowIndex);
?>
<script>
loadjs.ready(["fpaye_rateslist", "load"], function() {
	fpaye_rateslist.updateLists(<?php echo $paye_rates_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($paye_rates_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $paye_rates_list->FormKeyCountName ?>" id="<?php echo $paye_rates_list->FormKeyCountName ?>" value="<?php echo $paye_rates_list->KeyCount ?>">
<?php echo $paye_rates_list->MultiSelectKey ?>
<?php } ?>
<?php if ($paye_rates_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $paye_rates_list->FormKeyCountName ?>" id="<?php echo $paye_rates_list->FormKeyCountName ?>" value="<?php echo $paye_rates_list->KeyCount ?>">
<?php echo $paye_rates_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$paye_rates->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($paye_rates_list->Recordset)
	$paye_rates_list->Recordset->Close();
?>
<?php if (!$paye_rates_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$paye_rates_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_rates_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_rates_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($paye_rates_list->TotalRecords == 0 && !$paye_rates->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $paye_rates_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$paye_rates_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$paye_rates_list->isExport()) { ?>
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
$paye_rates_list->terminate();
?>