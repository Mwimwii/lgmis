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
$years_list = new years_list();

// Run the page
$years_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$years_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$years_list->isExport()) { ?>
<script>
var fyearslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fyearslist = currentForm = new ew.Form("fyearslist", "list");
	fyearslist.formKeyCountName = '<?php echo $years_list->FormKeyCountName ?>';

	// Validate form
	fyearslist.validate = function() {
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
			<?php if ($years_list->Year->Required) { ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $years_list->Year->caption(), $years_list->Year->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($years_list->Year->errorMessage()) ?>");

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
	fyearslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "Year", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fyearslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fyearslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fyearslist");
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
<?php if (!$years_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($years_list->TotalRecords > 0 && $years_list->ExportOptions->visible()) { ?>
<?php $years_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($years_list->ImportOptions->visible()) { ?>
<?php $years_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$years_list->renderOtherOptions();
?>
<?php $years_list->showPageHeader(); ?>
<?php
$years_list->showMessage();
?>
<?php if ($years_list->TotalRecords > 0 || $years->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($years_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> years">
<?php if (!$years_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$years_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $years_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $years_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fyearslist" id="fyearslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="years">
<div id="gmp_years" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($years_list->TotalRecords > 0 || $years_list->isGridEdit()) { ?>
<table id="tbl_yearslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$years->RowType = ROWTYPE_HEADER;

// Render list options
$years_list->renderListOptions();

// Render list options (header, left)
$years_list->ListOptions->render("header", "left");
?>
<?php if ($years_list->Year->Visible) { // Year ?>
	<?php if ($years_list->SortUrl($years_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $years_list->Year->headerCellClass() ?>"><div id="elh_years_Year" class="years_Year"><div class="ew-table-header-caption"><?php echo $years_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $years_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $years_list->SortUrl($years_list->Year) ?>', 1);"><div id="elh_years_Year" class="years_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $years_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($years_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($years_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$years_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($years_list->ExportAll && $years_list->isExport()) {
	$years_list->StopRecord = $years_list->TotalRecords;
} else {

	// Set the last record to display
	if ($years_list->TotalRecords > $years_list->StartRecord + $years_list->DisplayRecords - 1)
		$years_list->StopRecord = $years_list->StartRecord + $years_list->DisplayRecords - 1;
	else
		$years_list->StopRecord = $years_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($years->isConfirm() || $years_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($years_list->FormKeyCountName) && ($years_list->isGridAdd() || $years_list->isGridEdit() || $years->isConfirm())) {
		$years_list->KeyCount = $CurrentForm->getValue($years_list->FormKeyCountName);
		$years_list->StopRecord = $years_list->StartRecord + $years_list->KeyCount - 1;
	}
}
$years_list->RecordCount = $years_list->StartRecord - 1;
if ($years_list->Recordset && !$years_list->Recordset->EOF) {
	$years_list->Recordset->moveFirst();
	$selectLimit = $years_list->UseSelectLimit;
	if (!$selectLimit && $years_list->StartRecord > 1)
		$years_list->Recordset->move($years_list->StartRecord - 1);
} elseif (!$years->AllowAddDeleteRow && $years_list->StopRecord == 0) {
	$years_list->StopRecord = $years->GridAddRowCount;
}

// Initialize aggregate
$years->RowType = ROWTYPE_AGGREGATEINIT;
$years->resetAttributes();
$years_list->renderRow();
if ($years_list->isGridAdd())
	$years_list->RowIndex = 0;
if ($years_list->isGridEdit())
	$years_list->RowIndex = 0;
while ($years_list->RecordCount < $years_list->StopRecord) {
	$years_list->RecordCount++;
	if ($years_list->RecordCount >= $years_list->StartRecord) {
		$years_list->RowCount++;
		if ($years_list->isGridAdd() || $years_list->isGridEdit() || $years->isConfirm()) {
			$years_list->RowIndex++;
			$CurrentForm->Index = $years_list->RowIndex;
			if ($CurrentForm->hasValue($years_list->FormActionName) && ($years->isConfirm() || $years_list->EventCancelled))
				$years_list->RowAction = strval($CurrentForm->getValue($years_list->FormActionName));
			elseif ($years_list->isGridAdd())
				$years_list->RowAction = "insert";
			else
				$years_list->RowAction = "";
		}

		// Set up key count
		$years_list->KeyCount = $years_list->RowIndex;

		// Init row class and style
		$years->resetAttributes();
		$years->CssClass = "";
		if ($years_list->isGridAdd()) {
			$years_list->loadRowValues(); // Load default values
		} else {
			$years_list->loadRowValues($years_list->Recordset); // Load row values
		}
		$years->RowType = ROWTYPE_VIEW; // Render view
		if ($years_list->isGridAdd()) // Grid add
			$years->RowType = ROWTYPE_ADD; // Render add
		if ($years_list->isGridAdd() && $years->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$years_list->restoreCurrentRowFormValues($years_list->RowIndex); // Restore form values
		if ($years_list->isGridEdit()) { // Grid edit
			if ($years->EventCancelled)
				$years_list->restoreCurrentRowFormValues($years_list->RowIndex); // Restore form values
			if ($years_list->RowAction == "insert")
				$years->RowType = ROWTYPE_ADD; // Render add
			else
				$years->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($years_list->isGridEdit() && ($years->RowType == ROWTYPE_EDIT || $years->RowType == ROWTYPE_ADD) && $years->EventCancelled) // Update failed
			$years_list->restoreCurrentRowFormValues($years_list->RowIndex); // Restore form values
		if ($years->RowType == ROWTYPE_EDIT) // Edit row
			$years_list->EditRowCount++;

		// Set up row id / data-rowindex
		$years->RowAttrs->merge(["data-rowindex" => $years_list->RowCount, "id" => "r" . $years_list->RowCount . "_years", "data-rowtype" => $years->RowType]);

		// Render row
		$years_list->renderRow();

		// Render list options
		$years_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($years_list->RowAction != "delete" && $years_list->RowAction != "insertdelete" && !($years_list->RowAction == "insert" && $years->isConfirm() && $years_list->emptyRow())) {
?>
	<tr <?php echo $years->rowAttributes() ?>>
<?php

// Render list options (body, left)
$years_list->ListOptions->render("body", "left", $years_list->RowCount);
?>
	<?php if ($years_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $years_list->Year->cellAttributes() ?>>
<?php if ($years->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $years_list->RowCount ?>_years_Year" class="form-group">
<input type="text" data-table="years" data-field="x_Year" name="x<?php echo $years_list->RowIndex ?>_Year" id="x<?php echo $years_list->RowIndex ?>_Year" size="30" placeholder="<?php echo HtmlEncode($years_list->Year->getPlaceHolder()) ?>" value="<?php echo $years_list->Year->EditValue ?>"<?php echo $years_list->Year->editAttributes() ?>>
</span>
<input type="hidden" data-table="years" data-field="x_Year" name="o<?php echo $years_list->RowIndex ?>_Year" id="o<?php echo $years_list->RowIndex ?>_Year" value="<?php echo HtmlEncode($years_list->Year->OldValue) ?>">
<?php } ?>
<?php if ($years->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="years" data-field="x_Year" name="x<?php echo $years_list->RowIndex ?>_Year" id="x<?php echo $years_list->RowIndex ?>_Year" size="30" placeholder="<?php echo HtmlEncode($years_list->Year->getPlaceHolder()) ?>" value="<?php echo $years_list->Year->EditValue ?>"<?php echo $years_list->Year->editAttributes() ?>>
<input type="hidden" data-table="years" data-field="x_Year" name="o<?php echo $years_list->RowIndex ?>_Year" id="o<?php echo $years_list->RowIndex ?>_Year" value="<?php echo HtmlEncode($years_list->Year->OldValue != null ? $years_list->Year->OldValue : $years_list->Year->CurrentValue) ?>">
<?php } ?>
<?php if ($years->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $years_list->RowCount ?>_years_Year">
<span<?php echo $years_list->Year->viewAttributes() ?>><?php echo $years_list->Year->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$years_list->ListOptions->render("body", "right", $years_list->RowCount);
?>
	</tr>
<?php if ($years->RowType == ROWTYPE_ADD || $years->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fyearslist", "load"], function() {
	fyearslist.updateLists(<?php echo $years_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$years_list->isGridAdd())
		if (!$years_list->Recordset->EOF)
			$years_list->Recordset->moveNext();
}
?>
<?php
	if ($years_list->isGridAdd() || $years_list->isGridEdit()) {
		$years_list->RowIndex = '$rowindex$';
		$years_list->loadRowValues();

		// Set row properties
		$years->resetAttributes();
		$years->RowAttrs->merge(["data-rowindex" => $years_list->RowIndex, "id" => "r0_years", "data-rowtype" => ROWTYPE_ADD]);
		$years->RowAttrs->appendClass("ew-template");
		$years->RowType = ROWTYPE_ADD;

		// Render row
		$years_list->renderRow();

		// Render list options
		$years_list->renderListOptions();
		$years_list->StartRowCount = 0;
?>
	<tr <?php echo $years->rowAttributes() ?>>
<?php

// Render list options (body, left)
$years_list->ListOptions->render("body", "left", $years_list->RowIndex);
?>
	<?php if ($years_list->Year->Visible) { // Year ?>
		<td data-name="Year">
<span id="el$rowindex$_years_Year" class="form-group years_Year">
<input type="text" data-table="years" data-field="x_Year" name="x<?php echo $years_list->RowIndex ?>_Year" id="x<?php echo $years_list->RowIndex ?>_Year" size="30" placeholder="<?php echo HtmlEncode($years_list->Year->getPlaceHolder()) ?>" value="<?php echo $years_list->Year->EditValue ?>"<?php echo $years_list->Year->editAttributes() ?>>
</span>
<input type="hidden" data-table="years" data-field="x_Year" name="o<?php echo $years_list->RowIndex ?>_Year" id="o<?php echo $years_list->RowIndex ?>_Year" value="<?php echo HtmlEncode($years_list->Year->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$years_list->ListOptions->render("body", "right", $years_list->RowIndex);
?>
<script>
loadjs.ready(["fyearslist", "load"], function() {
	fyearslist.updateLists(<?php echo $years_list->RowIndex ?>);
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
<?php if ($years_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $years_list->FormKeyCountName ?>" id="<?php echo $years_list->FormKeyCountName ?>" value="<?php echo $years_list->KeyCount ?>">
<?php echo $years_list->MultiSelectKey ?>
<?php } ?>
<?php if ($years_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $years_list->FormKeyCountName ?>" id="<?php echo $years_list->FormKeyCountName ?>" value="<?php echo $years_list->KeyCount ?>">
<?php echo $years_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$years->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($years_list->Recordset)
	$years_list->Recordset->Close();
?>
<?php if (!$years_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$years_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $years_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $years_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($years_list->TotalRecords == 0 && !$years->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $years_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$years_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$years_list->isExport()) { ?>
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
$years_list->terminate();
?>