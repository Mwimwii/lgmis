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
$quarter_ref_list = new quarter_ref_list();

// Run the page
$quarter_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quarter_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$quarter_ref_list->isExport()) { ?>
<script>
var fquarter_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fquarter_reflist = currentForm = new ew.Form("fquarter_reflist", "list");
	fquarter_reflist.formKeyCountName = '<?php echo $quarter_ref_list->FormKeyCountName ?>';

	// Validate form
	fquarter_reflist.validate = function() {
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
			<?php if ($quarter_ref_list->Quarter->Required) { ?>
				elm = this.getElements("x" + infix + "_Quarter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_list->Quarter->caption(), $quarter_ref_list->Quarter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quarter");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_list->Quarter->errorMessage()) ?>");
			<?php if ($quarter_ref_list->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_list->BillYear->caption(), $quarter_ref_list->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_list->BillYear->errorMessage()) ?>");
			<?php if ($quarter_ref_list->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_list->StartDate->caption(), $quarter_ref_list->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_list->StartDate->errorMessage()) ?>");
			<?php if ($quarter_ref_list->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_list->Enddate->caption(), $quarter_ref_list->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_list->Enddate->errorMessage()) ?>");

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
	fquarter_reflist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Quarter", false)) return false;
		if (ew.valueChanged(fobj, infix, "BillYear", false)) return false;
		if (ew.valueChanged(fobj, infix, "StartDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "Enddate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fquarter_reflist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquarter_reflist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fquarter_reflist");
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
<?php if (!$quarter_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($quarter_ref_list->TotalRecords > 0 && $quarter_ref_list->ExportOptions->visible()) { ?>
<?php $quarter_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($quarter_ref_list->ImportOptions->visible()) { ?>
<?php $quarter_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$quarter_ref_list->renderOtherOptions();
?>
<?php $quarter_ref_list->showPageHeader(); ?>
<?php
$quarter_ref_list->showMessage();
?>
<?php if ($quarter_ref_list->TotalRecords > 0 || $quarter_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($quarter_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> quarter_ref">
<?php if (!$quarter_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$quarter_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $quarter_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $quarter_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fquarter_reflist" id="fquarter_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quarter_ref">
<div id="gmp_quarter_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($quarter_ref_list->TotalRecords > 0 || $quarter_ref_list->isGridEdit()) { ?>
<table id="tbl_quarter_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$quarter_ref->RowType = ROWTYPE_HEADER;

// Render list options
$quarter_ref_list->renderListOptions();

// Render list options (header, left)
$quarter_ref_list->ListOptions->render("header", "left");
?>
<?php if ($quarter_ref_list->Quarter->Visible) { // Quarter ?>
	<?php if ($quarter_ref_list->SortUrl($quarter_ref_list->Quarter) == "") { ?>
		<th data-name="Quarter" class="<?php echo $quarter_ref_list->Quarter->headerCellClass() ?>"><div id="elh_quarter_ref_Quarter" class="quarter_ref_Quarter"><div class="ew-table-header-caption"><?php echo $quarter_ref_list->Quarter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quarter" class="<?php echo $quarter_ref_list->Quarter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quarter_ref_list->SortUrl($quarter_ref_list->Quarter) ?>', 1);"><div id="elh_quarter_ref_Quarter" class="quarter_ref_Quarter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quarter_ref_list->Quarter->caption() ?></span><span class="ew-table-header-sort"><?php if ($quarter_ref_list->Quarter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quarter_ref_list->Quarter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quarter_ref_list->BillYear->Visible) { // BillYear ?>
	<?php if ($quarter_ref_list->SortUrl($quarter_ref_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $quarter_ref_list->BillYear->headerCellClass() ?>"><div id="elh_quarter_ref_BillYear" class="quarter_ref_BillYear"><div class="ew-table-header-caption"><?php echo $quarter_ref_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $quarter_ref_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quarter_ref_list->SortUrl($quarter_ref_list->BillYear) ?>', 1);"><div id="elh_quarter_ref_BillYear" class="quarter_ref_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quarter_ref_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($quarter_ref_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quarter_ref_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quarter_ref_list->StartDate->Visible) { // StartDate ?>
	<?php if ($quarter_ref_list->SortUrl($quarter_ref_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $quarter_ref_list->StartDate->headerCellClass() ?>"><div id="elh_quarter_ref_StartDate" class="quarter_ref_StartDate"><div class="ew-table-header-caption"><?php echo $quarter_ref_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $quarter_ref_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quarter_ref_list->SortUrl($quarter_ref_list->StartDate) ?>', 1);"><div id="elh_quarter_ref_StartDate" class="quarter_ref_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quarter_ref_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($quarter_ref_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quarter_ref_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($quarter_ref_list->Enddate->Visible) { // Enddate ?>
	<?php if ($quarter_ref_list->SortUrl($quarter_ref_list->Enddate) == "") { ?>
		<th data-name="Enddate" class="<?php echo $quarter_ref_list->Enddate->headerCellClass() ?>"><div id="elh_quarter_ref_Enddate" class="quarter_ref_Enddate"><div class="ew-table-header-caption"><?php echo $quarter_ref_list->Enddate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Enddate" class="<?php echo $quarter_ref_list->Enddate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $quarter_ref_list->SortUrl($quarter_ref_list->Enddate) ?>', 1);"><div id="elh_quarter_ref_Enddate" class="quarter_ref_Enddate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $quarter_ref_list->Enddate->caption() ?></span><span class="ew-table-header-sort"><?php if ($quarter_ref_list->Enddate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($quarter_ref_list->Enddate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$quarter_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($quarter_ref_list->ExportAll && $quarter_ref_list->isExport()) {
	$quarter_ref_list->StopRecord = $quarter_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($quarter_ref_list->TotalRecords > $quarter_ref_list->StartRecord + $quarter_ref_list->DisplayRecords - 1)
		$quarter_ref_list->StopRecord = $quarter_ref_list->StartRecord + $quarter_ref_list->DisplayRecords - 1;
	else
		$quarter_ref_list->StopRecord = $quarter_ref_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($quarter_ref->isConfirm() || $quarter_ref_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($quarter_ref_list->FormKeyCountName) && ($quarter_ref_list->isGridAdd() || $quarter_ref_list->isGridEdit() || $quarter_ref->isConfirm())) {
		$quarter_ref_list->KeyCount = $CurrentForm->getValue($quarter_ref_list->FormKeyCountName);
		$quarter_ref_list->StopRecord = $quarter_ref_list->StartRecord + $quarter_ref_list->KeyCount - 1;
	}
}
$quarter_ref_list->RecordCount = $quarter_ref_list->StartRecord - 1;
if ($quarter_ref_list->Recordset && !$quarter_ref_list->Recordset->EOF) {
	$quarter_ref_list->Recordset->moveFirst();
	$selectLimit = $quarter_ref_list->UseSelectLimit;
	if (!$selectLimit && $quarter_ref_list->StartRecord > 1)
		$quarter_ref_list->Recordset->move($quarter_ref_list->StartRecord - 1);
} elseif (!$quarter_ref->AllowAddDeleteRow && $quarter_ref_list->StopRecord == 0) {
	$quarter_ref_list->StopRecord = $quarter_ref->GridAddRowCount;
}

// Initialize aggregate
$quarter_ref->RowType = ROWTYPE_AGGREGATEINIT;
$quarter_ref->resetAttributes();
$quarter_ref_list->renderRow();
if ($quarter_ref_list->isGridAdd())
	$quarter_ref_list->RowIndex = 0;
if ($quarter_ref_list->isGridEdit())
	$quarter_ref_list->RowIndex = 0;
while ($quarter_ref_list->RecordCount < $quarter_ref_list->StopRecord) {
	$quarter_ref_list->RecordCount++;
	if ($quarter_ref_list->RecordCount >= $quarter_ref_list->StartRecord) {
		$quarter_ref_list->RowCount++;
		if ($quarter_ref_list->isGridAdd() || $quarter_ref_list->isGridEdit() || $quarter_ref->isConfirm()) {
			$quarter_ref_list->RowIndex++;
			$CurrentForm->Index = $quarter_ref_list->RowIndex;
			if ($CurrentForm->hasValue($quarter_ref_list->FormActionName) && ($quarter_ref->isConfirm() || $quarter_ref_list->EventCancelled))
				$quarter_ref_list->RowAction = strval($CurrentForm->getValue($quarter_ref_list->FormActionName));
			elseif ($quarter_ref_list->isGridAdd())
				$quarter_ref_list->RowAction = "insert";
			else
				$quarter_ref_list->RowAction = "";
		}

		// Set up key count
		$quarter_ref_list->KeyCount = $quarter_ref_list->RowIndex;

		// Init row class and style
		$quarter_ref->resetAttributes();
		$quarter_ref->CssClass = "";
		if ($quarter_ref_list->isGridAdd()) {
			$quarter_ref_list->loadRowValues(); // Load default values
		} else {
			$quarter_ref_list->loadRowValues($quarter_ref_list->Recordset); // Load row values
		}
		$quarter_ref->RowType = ROWTYPE_VIEW; // Render view
		if ($quarter_ref_list->isGridAdd()) // Grid add
			$quarter_ref->RowType = ROWTYPE_ADD; // Render add
		if ($quarter_ref_list->isGridAdd() && $quarter_ref->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$quarter_ref_list->restoreCurrentRowFormValues($quarter_ref_list->RowIndex); // Restore form values
		if ($quarter_ref_list->isGridEdit()) { // Grid edit
			if ($quarter_ref->EventCancelled)
				$quarter_ref_list->restoreCurrentRowFormValues($quarter_ref_list->RowIndex); // Restore form values
			if ($quarter_ref_list->RowAction == "insert")
				$quarter_ref->RowType = ROWTYPE_ADD; // Render add
			else
				$quarter_ref->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($quarter_ref_list->isGridEdit() && ($quarter_ref->RowType == ROWTYPE_EDIT || $quarter_ref->RowType == ROWTYPE_ADD) && $quarter_ref->EventCancelled) // Update failed
			$quarter_ref_list->restoreCurrentRowFormValues($quarter_ref_list->RowIndex); // Restore form values
		if ($quarter_ref->RowType == ROWTYPE_EDIT) // Edit row
			$quarter_ref_list->EditRowCount++;

		// Set up row id / data-rowindex
		$quarter_ref->RowAttrs->merge(["data-rowindex" => $quarter_ref_list->RowCount, "id" => "r" . $quarter_ref_list->RowCount . "_quarter_ref", "data-rowtype" => $quarter_ref->RowType]);

		// Render row
		$quarter_ref_list->renderRow();

		// Render list options
		$quarter_ref_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($quarter_ref_list->RowAction != "delete" && $quarter_ref_list->RowAction != "insertdelete" && !($quarter_ref_list->RowAction == "insert" && $quarter_ref->isConfirm() && $quarter_ref_list->emptyRow())) {
?>
	<tr <?php echo $quarter_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$quarter_ref_list->ListOptions->render("body", "left", $quarter_ref_list->RowCount);
?>
	<?php if ($quarter_ref_list->Quarter->Visible) { // Quarter ?>
		<td data-name="Quarter" <?php echo $quarter_ref_list->Quarter->cellAttributes() ?>>
<?php if ($quarter_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_Quarter" class="form-group">
<input type="text" data-table="quarter_ref" data-field="x_Quarter" name="x<?php echo $quarter_ref_list->RowIndex ?>_Quarter" id="x<?php echo $quarter_ref_list->RowIndex ?>_Quarter" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_list->Quarter->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->Quarter->EditValue ?>"<?php echo $quarter_ref_list->Quarter->editAttributes() ?>>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_Quarter" name="o<?php echo $quarter_ref_list->RowIndex ?>_Quarter" id="o<?php echo $quarter_ref_list->RowIndex ?>_Quarter" value="<?php echo HtmlEncode($quarter_ref_list->Quarter->OldValue) ?>">
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="quarter_ref" data-field="x_Quarter" name="x<?php echo $quarter_ref_list->RowIndex ?>_Quarter" id="x<?php echo $quarter_ref_list->RowIndex ?>_Quarter" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_list->Quarter->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->Quarter->EditValue ?>"<?php echo $quarter_ref_list->Quarter->editAttributes() ?>>
<input type="hidden" data-table="quarter_ref" data-field="x_Quarter" name="o<?php echo $quarter_ref_list->RowIndex ?>_Quarter" id="o<?php echo $quarter_ref_list->RowIndex ?>_Quarter" value="<?php echo HtmlEncode($quarter_ref_list->Quarter->OldValue != null ? $quarter_ref_list->Quarter->OldValue : $quarter_ref_list->Quarter->CurrentValue) ?>">
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_Quarter">
<span<?php echo $quarter_ref_list->Quarter->viewAttributes() ?>><?php echo $quarter_ref_list->Quarter->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($quarter_ref_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $quarter_ref_list->BillYear->cellAttributes() ?>>
<?php if ($quarter_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_BillYear" class="form-group">
<input type="text" data-table="quarter_ref" data-field="x_BillYear" name="x<?php echo $quarter_ref_list->RowIndex ?>_BillYear" id="x<?php echo $quarter_ref_list->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->BillYear->EditValue ?>"<?php echo $quarter_ref_list->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_BillYear" name="o<?php echo $quarter_ref_list->RowIndex ?>_BillYear" id="o<?php echo $quarter_ref_list->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($quarter_ref_list->BillYear->OldValue) ?>">
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_BillYear" class="form-group">
<input type="text" data-table="quarter_ref" data-field="x_BillYear" name="x<?php echo $quarter_ref_list->RowIndex ?>_BillYear" id="x<?php echo $quarter_ref_list->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->BillYear->EditValue ?>"<?php echo $quarter_ref_list->BillYear->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_BillYear">
<span<?php echo $quarter_ref_list->BillYear->viewAttributes() ?>><?php echo $quarter_ref_list->BillYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($quarter_ref_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $quarter_ref_list->StartDate->cellAttributes() ?>>
<?php if ($quarter_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_StartDate" class="form-group">
<input type="text" data-table="quarter_ref" data-field="x_StartDate" name="x<?php echo $quarter_ref_list->RowIndex ?>_StartDate" id="x<?php echo $quarter_ref_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($quarter_ref_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->StartDate->EditValue ?>"<?php echo $quarter_ref_list->StartDate->editAttributes() ?>>
<?php if (!$quarter_ref_list->StartDate->ReadOnly && !$quarter_ref_list->StartDate->Disabled && !isset($quarter_ref_list->StartDate->EditAttrs["readonly"]) && !isset($quarter_ref_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_reflist", "x<?php echo $quarter_ref_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_StartDate" name="o<?php echo $quarter_ref_list->RowIndex ?>_StartDate" id="o<?php echo $quarter_ref_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($quarter_ref_list->StartDate->OldValue) ?>">
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_StartDate" class="form-group">
<input type="text" data-table="quarter_ref" data-field="x_StartDate" name="x<?php echo $quarter_ref_list->RowIndex ?>_StartDate" id="x<?php echo $quarter_ref_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($quarter_ref_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->StartDate->EditValue ?>"<?php echo $quarter_ref_list->StartDate->editAttributes() ?>>
<?php if (!$quarter_ref_list->StartDate->ReadOnly && !$quarter_ref_list->StartDate->Disabled && !isset($quarter_ref_list->StartDate->EditAttrs["readonly"]) && !isset($quarter_ref_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_reflist", "x<?php echo $quarter_ref_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_StartDate">
<span<?php echo $quarter_ref_list->StartDate->viewAttributes() ?>><?php echo $quarter_ref_list->StartDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($quarter_ref_list->Enddate->Visible) { // Enddate ?>
		<td data-name="Enddate" <?php echo $quarter_ref_list->Enddate->cellAttributes() ?>>
<?php if ($quarter_ref->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_Enddate" class="form-group">
<input type="text" data-table="quarter_ref" data-field="x_Enddate" name="x<?php echo $quarter_ref_list->RowIndex ?>_Enddate" id="x<?php echo $quarter_ref_list->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($quarter_ref_list->Enddate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->Enddate->EditValue ?>"<?php echo $quarter_ref_list->Enddate->editAttributes() ?>>
<?php if (!$quarter_ref_list->Enddate->ReadOnly && !$quarter_ref_list->Enddate->Disabled && !isset($quarter_ref_list->Enddate->EditAttrs["readonly"]) && !isset($quarter_ref_list->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_reflist", "x<?php echo $quarter_ref_list->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_Enddate" name="o<?php echo $quarter_ref_list->RowIndex ?>_Enddate" id="o<?php echo $quarter_ref_list->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($quarter_ref_list->Enddate->OldValue) ?>">
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_Enddate" class="form-group">
<input type="text" data-table="quarter_ref" data-field="x_Enddate" name="x<?php echo $quarter_ref_list->RowIndex ?>_Enddate" id="x<?php echo $quarter_ref_list->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($quarter_ref_list->Enddate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->Enddate->EditValue ?>"<?php echo $quarter_ref_list->Enddate->editAttributes() ?>>
<?php if (!$quarter_ref_list->Enddate->ReadOnly && !$quarter_ref_list->Enddate->Disabled && !isset($quarter_ref_list->Enddate->EditAttrs["readonly"]) && !isset($quarter_ref_list->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_reflist", "x<?php echo $quarter_ref_list->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($quarter_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $quarter_ref_list->RowCount ?>_quarter_ref_Enddate">
<span<?php echo $quarter_ref_list->Enddate->viewAttributes() ?>><?php echo $quarter_ref_list->Enddate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$quarter_ref_list->ListOptions->render("body", "right", $quarter_ref_list->RowCount);
?>
	</tr>
<?php if ($quarter_ref->RowType == ROWTYPE_ADD || $quarter_ref->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fquarter_reflist", "load"], function() {
	fquarter_reflist.updateLists(<?php echo $quarter_ref_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$quarter_ref_list->isGridAdd())
		if (!$quarter_ref_list->Recordset->EOF)
			$quarter_ref_list->Recordset->moveNext();
}
?>
<?php
	if ($quarter_ref_list->isGridAdd() || $quarter_ref_list->isGridEdit()) {
		$quarter_ref_list->RowIndex = '$rowindex$';
		$quarter_ref_list->loadRowValues();

		// Set row properties
		$quarter_ref->resetAttributes();
		$quarter_ref->RowAttrs->merge(["data-rowindex" => $quarter_ref_list->RowIndex, "id" => "r0_quarter_ref", "data-rowtype" => ROWTYPE_ADD]);
		$quarter_ref->RowAttrs->appendClass("ew-template");
		$quarter_ref->RowType = ROWTYPE_ADD;

		// Render row
		$quarter_ref_list->renderRow();

		// Render list options
		$quarter_ref_list->renderListOptions();
		$quarter_ref_list->StartRowCount = 0;
?>
	<tr <?php echo $quarter_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$quarter_ref_list->ListOptions->render("body", "left", $quarter_ref_list->RowIndex);
?>
	<?php if ($quarter_ref_list->Quarter->Visible) { // Quarter ?>
		<td data-name="Quarter">
<span id="el$rowindex$_quarter_ref_Quarter" class="form-group quarter_ref_Quarter">
<input type="text" data-table="quarter_ref" data-field="x_Quarter" name="x<?php echo $quarter_ref_list->RowIndex ?>_Quarter" id="x<?php echo $quarter_ref_list->RowIndex ?>_Quarter" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_list->Quarter->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->Quarter->EditValue ?>"<?php echo $quarter_ref_list->Quarter->editAttributes() ?>>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_Quarter" name="o<?php echo $quarter_ref_list->RowIndex ?>_Quarter" id="o<?php echo $quarter_ref_list->RowIndex ?>_Quarter" value="<?php echo HtmlEncode($quarter_ref_list->Quarter->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($quarter_ref_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear">
<span id="el$rowindex$_quarter_ref_BillYear" class="form-group quarter_ref_BillYear">
<input type="text" data-table="quarter_ref" data-field="x_BillYear" name="x<?php echo $quarter_ref_list->RowIndex ?>_BillYear" id="x<?php echo $quarter_ref_list->RowIndex ?>_BillYear" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->BillYear->EditValue ?>"<?php echo $quarter_ref_list->BillYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_BillYear" name="o<?php echo $quarter_ref_list->RowIndex ?>_BillYear" id="o<?php echo $quarter_ref_list->RowIndex ?>_BillYear" value="<?php echo HtmlEncode($quarter_ref_list->BillYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($quarter_ref_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate">
<span id="el$rowindex$_quarter_ref_StartDate" class="form-group quarter_ref_StartDate">
<input type="text" data-table="quarter_ref" data-field="x_StartDate" name="x<?php echo $quarter_ref_list->RowIndex ?>_StartDate" id="x<?php echo $quarter_ref_list->RowIndex ?>_StartDate" placeholder="<?php echo HtmlEncode($quarter_ref_list->StartDate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->StartDate->EditValue ?>"<?php echo $quarter_ref_list->StartDate->editAttributes() ?>>
<?php if (!$quarter_ref_list->StartDate->ReadOnly && !$quarter_ref_list->StartDate->Disabled && !isset($quarter_ref_list->StartDate->EditAttrs["readonly"]) && !isset($quarter_ref_list->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_reflist", "x<?php echo $quarter_ref_list->RowIndex ?>_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_StartDate" name="o<?php echo $quarter_ref_list->RowIndex ?>_StartDate" id="o<?php echo $quarter_ref_list->RowIndex ?>_StartDate" value="<?php echo HtmlEncode($quarter_ref_list->StartDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($quarter_ref_list->Enddate->Visible) { // Enddate ?>
		<td data-name="Enddate">
<span id="el$rowindex$_quarter_ref_Enddate" class="form-group quarter_ref_Enddate">
<input type="text" data-table="quarter_ref" data-field="x_Enddate" name="x<?php echo $quarter_ref_list->RowIndex ?>_Enddate" id="x<?php echo $quarter_ref_list->RowIndex ?>_Enddate" placeholder="<?php echo HtmlEncode($quarter_ref_list->Enddate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_list->Enddate->EditValue ?>"<?php echo $quarter_ref_list->Enddate->editAttributes() ?>>
<?php if (!$quarter_ref_list->Enddate->ReadOnly && !$quarter_ref_list->Enddate->Disabled && !isset($quarter_ref_list->Enddate->EditAttrs["readonly"]) && !isset($quarter_ref_list->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_reflist", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_reflist", "x<?php echo $quarter_ref_list->RowIndex ?>_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="quarter_ref" data-field="x_Enddate" name="o<?php echo $quarter_ref_list->RowIndex ?>_Enddate" id="o<?php echo $quarter_ref_list->RowIndex ?>_Enddate" value="<?php echo HtmlEncode($quarter_ref_list->Enddate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$quarter_ref_list->ListOptions->render("body", "right", $quarter_ref_list->RowIndex);
?>
<script>
loadjs.ready(["fquarter_reflist", "load"], function() {
	fquarter_reflist.updateLists(<?php echo $quarter_ref_list->RowIndex ?>);
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
<?php if ($quarter_ref_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $quarter_ref_list->FormKeyCountName ?>" id="<?php echo $quarter_ref_list->FormKeyCountName ?>" value="<?php echo $quarter_ref_list->KeyCount ?>">
<?php echo $quarter_ref_list->MultiSelectKey ?>
<?php } ?>
<?php if ($quarter_ref_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $quarter_ref_list->FormKeyCountName ?>" id="<?php echo $quarter_ref_list->FormKeyCountName ?>" value="<?php echo $quarter_ref_list->KeyCount ?>">
<?php echo $quarter_ref_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$quarter_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($quarter_ref_list->Recordset)
	$quarter_ref_list->Recordset->Close();
?>
<?php if (!$quarter_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$quarter_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $quarter_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $quarter_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($quarter_ref_list->TotalRecords == 0 && !$quarter_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $quarter_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$quarter_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$quarter_ref_list->isExport()) { ?>
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
$quarter_ref_list->terminate();
?>