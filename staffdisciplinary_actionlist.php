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
$staffdisciplinary_action_list = new staffdisciplinary_action_list();

// Run the page
$staffdisciplinary_action_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffdisciplinary_action_list->isExport()) { ?>
<script>
var fstaffdisciplinary_actionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaffdisciplinary_actionlist = currentForm = new ew.Form("fstaffdisciplinary_actionlist", "list");
	fstaffdisciplinary_actionlist.formKeyCountName = '<?php echo $staffdisciplinary_action_list->FormKeyCountName ?>';

	// Validate form
	fstaffdisciplinary_actionlist.validate = function() {
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
			<?php if ($staffdisciplinary_action_list->CaseNo->Required) { ?>
				elm = this.getElements("x" + infix + "_CaseNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_list->CaseNo->caption(), $staffdisciplinary_action_list->CaseNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_list->OffenseCode->Required) { ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_list->OffenseCode->caption(), $staffdisciplinary_action_list->OffenseCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OffenseCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_list->OffenseCode->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_list->ActionTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_list->ActionTaken->caption(), $staffdisciplinary_action_list->ActionTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffdisciplinary_action_list->ActionDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_list->ActionDate->caption(), $staffdisciplinary_action_list->ActionDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActionDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_list->ActionDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_list->FromDate->Required) { ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_list->FromDate->caption(), $staffdisciplinary_action_list->FromDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_list->FromDate->errorMessage()) ?>");
			<?php if ($staffdisciplinary_action_list->ToDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffdisciplinary_action_list->ToDate->caption(), $staffdisciplinary_action_list->ToDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffdisciplinary_action_list->ToDate->errorMessage()) ?>");

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
	fstaffdisciplinary_actionlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "OffenseCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionTaken", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActionDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "FromDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ToDate", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffdisciplinary_actionlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffdisciplinary_actionlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffdisciplinary_actionlist.lists["x_ActionTaken"] = <?php echo $staffdisciplinary_action_list->ActionTaken->Lookup->toClientList($staffdisciplinary_action_list) ?>;
	fstaffdisciplinary_actionlist.lists["x_ActionTaken"].options = <?php echo JsonEncode($staffdisciplinary_action_list->ActionTaken->lookupOptions()) ?>;
	loadjs.done("fstaffdisciplinary_actionlist");
});
var fstaffdisciplinary_actionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstaffdisciplinary_actionlistsrch = currentSearchForm = new ew.Form("fstaffdisciplinary_actionlistsrch");

	// Dynamic selection lists
	// Filters

	fstaffdisciplinary_actionlistsrch.filterList = <?php echo $staffdisciplinary_action_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstaffdisciplinary_actionlistsrch.initSearchPanel = true;
	loadjs.done("fstaffdisciplinary_actionlistsrch");
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
<?php if (!$staffdisciplinary_action_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staffdisciplinary_action_list->TotalRecords > 0 && $staffdisciplinary_action_list->ExportOptions->visible()) { ?>
<?php $staffdisciplinary_action_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->ImportOptions->visible()) { ?>
<?php $staffdisciplinary_action_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->SearchOptions->visible()) { ?>
<?php $staffdisciplinary_action_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->FilterOptions->visible()) { ?>
<?php $staffdisciplinary_action_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$staffdisciplinary_action_list->isExport() || Config("EXPORT_MASTER_RECORD") && $staffdisciplinary_action_list->isExport("print")) { ?>
<?php
if ($staffdisciplinary_action_list->DbMasterFilter != "" && $staffdisciplinary_action->getCurrentMasterTable() == "staffdisciplinary_case") {
	if ($staffdisciplinary_action_list->MasterRecordExists) {
		include_once "staffdisciplinary_casemaster.php";
	}
}
?>
<?php
if ($staffdisciplinary_action_list->DbMasterFilter != "" && $staffdisciplinary_action->getCurrentMasterTable() == "staff") {
	if ($staffdisciplinary_action_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$staffdisciplinary_action_list->renderOtherOptions();
?>
<?php $staffdisciplinary_action_list->showPageHeader(); ?>
<?php
$staffdisciplinary_action_list->showMessage();
?>
<?php if ($staffdisciplinary_action_list->TotalRecords > 0 || $staffdisciplinary_action->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffdisciplinary_action_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffdisciplinary_action">
<?php if (!$staffdisciplinary_action_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staffdisciplinary_action_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_action_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_action_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaffdisciplinary_actionlist" id="fstaffdisciplinary_actionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_action">
<?php if ($staffdisciplinary_action->getCurrentMasterTable() == "staffdisciplinary_case" && $staffdisciplinary_action->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staffdisciplinary_case">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_list->EmployeeID->getSessionValue()) ?>">
<input type="hidden" name="fk_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_list->CaseNo->getSessionValue()) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->getCurrentMasterTable() == "staff" && $staffdisciplinary_action->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_staffdisciplinary_action" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staffdisciplinary_action_list->TotalRecords > 0 || $staffdisciplinary_action_list->isGridEdit()) { ?>
<table id="tbl_staffdisciplinary_actionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffdisciplinary_action->RowType = ROWTYPE_HEADER;

// Render list options
$staffdisciplinary_action_list->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_action_list->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_action_list->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->CaseNo) == "") { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_action_list->CaseNo->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_CaseNo" class="staffdisciplinary_action_CaseNo"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->CaseNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CaseNo" class="<?php echo $staffdisciplinary_action_list->CaseNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->CaseNo) ?>', 1);"><div id="elh_staffdisciplinary_action_CaseNo" class="staffdisciplinary_action_CaseNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_list->CaseNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_list->CaseNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->OffenseCode) == "") { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_action_list->OffenseCode->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_OffenseCode" class="staffdisciplinary_action_OffenseCode"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->OffenseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCode" class="<?php echo $staffdisciplinary_action_list->OffenseCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->OffenseCode) ?>', 1);"><div id="elh_staffdisciplinary_action_OffenseCode" class="staffdisciplinary_action_OffenseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_list->OffenseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_list->OffenseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->ActionTaken->Visible) { // ActionTaken ?>
	<?php if ($staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->ActionTaken) == "") { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_action_list->ActionTaken->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_ActionTaken" class="staffdisciplinary_action_ActionTaken"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->ActionTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionTaken" class="<?php echo $staffdisciplinary_action_list->ActionTaken->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->ActionTaken) ?>', 1);"><div id="elh_staffdisciplinary_action_ActionTaken" class="staffdisciplinary_action_ActionTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->ActionTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_list->ActionTaken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_list->ActionTaken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->ActionDate->Visible) { // ActionDate ?>
	<?php if ($staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->ActionDate) == "") { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_action_list->ActionDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_ActionDate" class="staffdisciplinary_action_ActionDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->ActionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDate" class="<?php echo $staffdisciplinary_action_list->ActionDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->ActionDate) ?>', 1);"><div id="elh_staffdisciplinary_action_ActionDate" class="staffdisciplinary_action_ActionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_list->ActionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_list->ActionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->FromDate->Visible) { // FromDate ?>
	<?php if ($staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->FromDate) == "") { ?>
		<th data-name="FromDate" class="<?php echo $staffdisciplinary_action_list->FromDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_FromDate" class="staffdisciplinary_action_FromDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->FromDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromDate" class="<?php echo $staffdisciplinary_action_list->FromDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->FromDate) ?>', 1);"><div id="elh_staffdisciplinary_action_FromDate" class="staffdisciplinary_action_FromDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->FromDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_list->FromDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_list->FromDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->ToDate->Visible) { // ToDate ?>
	<?php if ($staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->ToDate) == "") { ?>
		<th data-name="ToDate" class="<?php echo $staffdisciplinary_action_list->ToDate->headerCellClass() ?>"><div id="elh_staffdisciplinary_action_ToDate" class="staffdisciplinary_action_ToDate"><div class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->ToDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ToDate" class="<?php echo $staffdisciplinary_action_list->ToDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffdisciplinary_action_list->SortUrl($staffdisciplinary_action_list->ToDate) ?>', 1);"><div id="elh_staffdisciplinary_action_ToDate" class="staffdisciplinary_action_ToDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_list->ToDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_list->ToDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_list->ToDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_action_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staffdisciplinary_action_list->ExportAll && $staffdisciplinary_action_list->isExport()) {
	$staffdisciplinary_action_list->StopRecord = $staffdisciplinary_action_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staffdisciplinary_action_list->TotalRecords > $staffdisciplinary_action_list->StartRecord + $staffdisciplinary_action_list->DisplayRecords - 1)
		$staffdisciplinary_action_list->StopRecord = $staffdisciplinary_action_list->StartRecord + $staffdisciplinary_action_list->DisplayRecords - 1;
	else
		$staffdisciplinary_action_list->StopRecord = $staffdisciplinary_action_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($staffdisciplinary_action->isConfirm() || $staffdisciplinary_action_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffdisciplinary_action_list->FormKeyCountName) && ($staffdisciplinary_action_list->isGridAdd() || $staffdisciplinary_action_list->isGridEdit() || $staffdisciplinary_action->isConfirm())) {
		$staffdisciplinary_action_list->KeyCount = $CurrentForm->getValue($staffdisciplinary_action_list->FormKeyCountName);
		$staffdisciplinary_action_list->StopRecord = $staffdisciplinary_action_list->StartRecord + $staffdisciplinary_action_list->KeyCount - 1;
	}
}
$staffdisciplinary_action_list->RecordCount = $staffdisciplinary_action_list->StartRecord - 1;
if ($staffdisciplinary_action_list->Recordset && !$staffdisciplinary_action_list->Recordset->EOF) {
	$staffdisciplinary_action_list->Recordset->moveFirst();
	$selectLimit = $staffdisciplinary_action_list->UseSelectLimit;
	if (!$selectLimit && $staffdisciplinary_action_list->StartRecord > 1)
		$staffdisciplinary_action_list->Recordset->move($staffdisciplinary_action_list->StartRecord - 1);
} elseif (!$staffdisciplinary_action->AllowAddDeleteRow && $staffdisciplinary_action_list->StopRecord == 0) {
	$staffdisciplinary_action_list->StopRecord = $staffdisciplinary_action->GridAddRowCount;
}

// Initialize aggregate
$staffdisciplinary_action->RowType = ROWTYPE_AGGREGATEINIT;
$staffdisciplinary_action->resetAttributes();
$staffdisciplinary_action_list->renderRow();
if ($staffdisciplinary_action_list->isGridAdd())
	$staffdisciplinary_action_list->RowIndex = 0;
if ($staffdisciplinary_action_list->isGridEdit())
	$staffdisciplinary_action_list->RowIndex = 0;
while ($staffdisciplinary_action_list->RecordCount < $staffdisciplinary_action_list->StopRecord) {
	$staffdisciplinary_action_list->RecordCount++;
	if ($staffdisciplinary_action_list->RecordCount >= $staffdisciplinary_action_list->StartRecord) {
		$staffdisciplinary_action_list->RowCount++;
		if ($staffdisciplinary_action_list->isGridAdd() || $staffdisciplinary_action_list->isGridEdit() || $staffdisciplinary_action->isConfirm()) {
			$staffdisciplinary_action_list->RowIndex++;
			$CurrentForm->Index = $staffdisciplinary_action_list->RowIndex;
			if ($CurrentForm->hasValue($staffdisciplinary_action_list->FormActionName) && ($staffdisciplinary_action->isConfirm() || $staffdisciplinary_action_list->EventCancelled))
				$staffdisciplinary_action_list->RowAction = strval($CurrentForm->getValue($staffdisciplinary_action_list->FormActionName));
			elseif ($staffdisciplinary_action_list->isGridAdd())
				$staffdisciplinary_action_list->RowAction = "insert";
			else
				$staffdisciplinary_action_list->RowAction = "";
		}

		// Set up key count
		$staffdisciplinary_action_list->KeyCount = $staffdisciplinary_action_list->RowIndex;

		// Init row class and style
		$staffdisciplinary_action->resetAttributes();
		$staffdisciplinary_action->CssClass = "";
		if ($staffdisciplinary_action_list->isGridAdd()) {
			$staffdisciplinary_action_list->loadRowValues(); // Load default values
		} else {
			$staffdisciplinary_action_list->loadRowValues($staffdisciplinary_action_list->Recordset); // Load row values
		}
		$staffdisciplinary_action->RowType = ROWTYPE_VIEW; // Render view
		if ($staffdisciplinary_action_list->isGridAdd()) // Grid add
			$staffdisciplinary_action->RowType = ROWTYPE_ADD; // Render add
		if ($staffdisciplinary_action_list->isGridAdd() && $staffdisciplinary_action->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffdisciplinary_action_list->restoreCurrentRowFormValues($staffdisciplinary_action_list->RowIndex); // Restore form values
		if ($staffdisciplinary_action_list->isGridEdit()) { // Grid edit
			if ($staffdisciplinary_action->EventCancelled)
				$staffdisciplinary_action_list->restoreCurrentRowFormValues($staffdisciplinary_action_list->RowIndex); // Restore form values
			if ($staffdisciplinary_action_list->RowAction == "insert")
				$staffdisciplinary_action->RowType = ROWTYPE_ADD; // Render add
			else
				$staffdisciplinary_action->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffdisciplinary_action_list->isGridEdit() && ($staffdisciplinary_action->RowType == ROWTYPE_EDIT || $staffdisciplinary_action->RowType == ROWTYPE_ADD) && $staffdisciplinary_action->EventCancelled) // Update failed
			$staffdisciplinary_action_list->restoreCurrentRowFormValues($staffdisciplinary_action_list->RowIndex); // Restore form values
		if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) // Edit row
			$staffdisciplinary_action_list->EditRowCount++;

		// Set up row id / data-rowindex
		$staffdisciplinary_action->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_action_list->RowCount, "id" => "r" . $staffdisciplinary_action_list->RowCount . "_staffdisciplinary_action", "data-rowtype" => $staffdisciplinary_action->RowType]);

		// Render row
		$staffdisciplinary_action_list->renderRow();

		// Render list options
		$staffdisciplinary_action_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffdisciplinary_action_list->RowAction != "delete" && $staffdisciplinary_action_list->RowAction != "insertdelete" && !($staffdisciplinary_action_list->RowAction == "insert" && $staffdisciplinary_action->isConfirm() && $staffdisciplinary_action_list->emptyRow())) {
?>
	<tr <?php echo $staffdisciplinary_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_action_list->ListOptions->render("body", "left", $staffdisciplinary_action_list->RowCount);
?>
	<?php if ($staffdisciplinary_action_list->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_action_list->CaseNo->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_CaseNo" class="form-group"></span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_list->CaseNo->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_CaseNo" class="form-group">
<span<?php echo $staffdisciplinary_action_list->CaseNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffdisciplinary_action_list->CaseNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_CaseNo" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_list->CaseNo->CurrentValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_CaseNo">
<span<?php echo $staffdisciplinary_action_list->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_action_list->CaseNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_list->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_EmployeeID" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT || $staffdisciplinary_action->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_EmployeeID" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffdisciplinary_action_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffdisciplinary_action_list->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_action_list->OffenseCode->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_OffenseCode" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_list->OffenseCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_list->OffenseCode->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_OffenseCode" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_list->OffenseCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_OffenseCode">
<span<?php echo $staffdisciplinary_action_list->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_action_list->OffenseCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->ActionTaken->Visible) { // ActionTaken ?>
		<td data-name="ActionTaken" <?php echo $staffdisciplinary_action_list->ActionTaken->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ActionTaken" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_list->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_action_list->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_list->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_action_list->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_list->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_list, "p_x" . $staffdisciplinary_action_list->RowIndex . "_ActionTaken") ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_list->ActionTaken->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ActionTaken" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_list->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_action_list->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_list->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_action_list->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_list->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_list, "p_x" . $staffdisciplinary_action_list->RowIndex . "_ActionTaken") ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ActionTaken">
<span<?php echo $staffdisciplinary_action_list->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_action_list->ActionTaken->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate" <?php echo $staffdisciplinary_action_list->ActionDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ActionDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->ActionDate->ReadOnly && !$staffdisciplinary_action_list->ActionDate->Disabled && !isset($staffdisciplinary_action_list->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_list->ActionDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ActionDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->ActionDate->ReadOnly && !$staffdisciplinary_action_list->ActionDate->Disabled && !isset($staffdisciplinary_action_list->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ActionDate">
<span<?php echo $staffdisciplinary_action_list->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_list->ActionDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate" <?php echo $staffdisciplinary_action_list->FromDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_FromDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->FromDate->ReadOnly && !$staffdisciplinary_action_list->FromDate->Disabled && !isset($staffdisciplinary_action_list->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_list->FromDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_FromDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->FromDate->ReadOnly && !$staffdisciplinary_action_list->FromDate->Disabled && !isset($staffdisciplinary_action_list->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_FromDate">
<span<?php echo $staffdisciplinary_action_list->FromDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_list->FromDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->ToDate->Visible) { // ToDate ?>
		<td data-name="ToDate" <?php echo $staffdisciplinary_action_list->ToDate->cellAttributes() ?>>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ToDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->ToDate->ReadOnly && !$staffdisciplinary_action_list->ToDate->Disabled && !isset($staffdisciplinary_action_list->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_list->ToDate->OldValue) ?>">
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ToDate" class="form-group">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->ToDate->ReadOnly && !$staffdisciplinary_action_list->ToDate->Disabled && !isset($staffdisciplinary_action_list->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffdisciplinary_action_list->RowCount ?>_staffdisciplinary_action_ToDate">
<span<?php echo $staffdisciplinary_action_list->ToDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_list->ToDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_action_list->ListOptions->render("body", "right", $staffdisciplinary_action_list->RowCount);
?>
	</tr>
<?php if ($staffdisciplinary_action->RowType == ROWTYPE_ADD || $staffdisciplinary_action->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "load"], function() {
	fstaffdisciplinary_actionlist.updateLists(<?php echo $staffdisciplinary_action_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffdisciplinary_action_list->isGridAdd())
		if (!$staffdisciplinary_action_list->Recordset->EOF)
			$staffdisciplinary_action_list->Recordset->moveNext();
}
?>
<?php
	if ($staffdisciplinary_action_list->isGridAdd() || $staffdisciplinary_action_list->isGridEdit()) {
		$staffdisciplinary_action_list->RowIndex = '$rowindex$';
		$staffdisciplinary_action_list->loadRowValues();

		// Set row properties
		$staffdisciplinary_action->resetAttributes();
		$staffdisciplinary_action->RowAttrs->merge(["data-rowindex" => $staffdisciplinary_action_list->RowIndex, "id" => "r0_staffdisciplinary_action", "data-rowtype" => ROWTYPE_ADD]);
		$staffdisciplinary_action->RowAttrs->appendClass("ew-template");
		$staffdisciplinary_action->RowType = ROWTYPE_ADD;

		// Render row
		$staffdisciplinary_action_list->renderRow();

		// Render list options
		$staffdisciplinary_action_list->renderListOptions();
		$staffdisciplinary_action_list->StartRowCount = 0;
?>
	<tr <?php echo $staffdisciplinary_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_action_list->ListOptions->render("body", "left", $staffdisciplinary_action_list->RowIndex);
?>
	<?php if ($staffdisciplinary_action_list->CaseNo->Visible) { // CaseNo ?>
		<td data-name="CaseNo">
<span id="el$rowindex$_staffdisciplinary_action_CaseNo" class="form-group staffdisciplinary_action_CaseNo"></span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_CaseNo" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_CaseNo" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_CaseNo" value="<?php echo HtmlEncode($staffdisciplinary_action_list->CaseNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode">
<span id="el$rowindex$_staffdisciplinary_action_OffenseCode" class="form-group staffdisciplinary_action_OffenseCode">
<input type="text" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" size="30" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->OffenseCode->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->OffenseCode->EditValue ?>"<?php echo $staffdisciplinary_action_list->OffenseCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_OffenseCode" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_OffenseCode" value="<?php echo HtmlEncode($staffdisciplinary_action_list->OffenseCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->ActionTaken->Visible) { // ActionTaken ?>
		<td data-name="ActionTaken">
<span id="el$rowindex$_staffdisciplinary_action_ActionTaken" class="form-group staffdisciplinary_action_ActionTaken">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffdisciplinary_action" data-field="x_ActionTaken" data-value-separator="<?php echo $staffdisciplinary_action_list->ActionTaken->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken"<?php echo $staffdisciplinary_action_list->ActionTaken->editAttributes() ?>>
			<?php echo $staffdisciplinary_action_list->ActionTaken->selectOptionListHtml("x{$staffdisciplinary_action_list->RowIndex}_ActionTaken") ?>
		</select>
</div>
<?php echo $staffdisciplinary_action_list->ActionTaken->Lookup->getParamTag($staffdisciplinary_action_list, "p_x" . $staffdisciplinary_action_list->RowIndex . "_ActionTaken") ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionTaken" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionTaken" value="<?php echo HtmlEncode($staffdisciplinary_action_list->ActionTaken->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate">
<span id="el$rowindex$_staffdisciplinary_action_ActionDate" class="form-group staffdisciplinary_action_ActionDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->ActionDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->ActionDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->ActionDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->ActionDate->ReadOnly && !$staffdisciplinary_action_list->ActionDate->Disabled && !isset($staffdisciplinary_action_list->ActionDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->ActionDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ActionDate" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ActionDate" value="<?php echo HtmlEncode($staffdisciplinary_action_list->ActionDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->FromDate->Visible) { // FromDate ?>
		<td data-name="FromDate">
<span id="el$rowindex$_staffdisciplinary_action_FromDate" class="form-group staffdisciplinary_action_FromDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_FromDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->FromDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->FromDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->FromDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->FromDate->ReadOnly && !$staffdisciplinary_action_list->FromDate->Disabled && !isset($staffdisciplinary_action_list->FromDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->FromDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_FromDate" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_FromDate" value="<?php echo HtmlEncode($staffdisciplinary_action_list->FromDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffdisciplinary_action_list->ToDate->Visible) { // ToDate ?>
		<td data-name="ToDate">
<span id="el$rowindex$_staffdisciplinary_action_ToDate" class="form-group staffdisciplinary_action_ToDate">
<input type="text" data-table="staffdisciplinary_action" data-field="x_ToDate" name="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" id="x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" placeholder="<?php echo HtmlEncode($staffdisciplinary_action_list->ToDate->getPlaceHolder()) ?>" value="<?php echo $staffdisciplinary_action_list->ToDate->EditValue ?>"<?php echo $staffdisciplinary_action_list->ToDate->editAttributes() ?>>
<?php if (!$staffdisciplinary_action_list->ToDate->ReadOnly && !$staffdisciplinary_action_list->ToDate->Disabled && !isset($staffdisciplinary_action_list->ToDate->EditAttrs["readonly"]) && !isset($staffdisciplinary_action_list->ToDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffdisciplinary_actionlist", "x<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffdisciplinary_action" data-field="x_ToDate" name="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" id="o<?php echo $staffdisciplinary_action_list->RowIndex ?>_ToDate" value="<?php echo HtmlEncode($staffdisciplinary_action_list->ToDate->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_action_list->ListOptions->render("body", "right", $staffdisciplinary_action_list->RowIndex);
?>
<script>
loadjs.ready(["fstaffdisciplinary_actionlist", "load"], function() {
	fstaffdisciplinary_actionlist.updateLists(<?php echo $staffdisciplinary_action_list->RowIndex ?>);
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
<?php if ($staffdisciplinary_action_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $staffdisciplinary_action_list->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_action_list->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_action_list->KeyCount ?>">
<?php echo $staffdisciplinary_action_list->MultiSelectKey ?>
<?php } ?>
<?php if ($staffdisciplinary_action_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $staffdisciplinary_action_list->FormKeyCountName ?>" id="<?php echo $staffdisciplinary_action_list->FormKeyCountName ?>" value="<?php echo $staffdisciplinary_action_list->KeyCount ?>">
<?php echo $staffdisciplinary_action_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$staffdisciplinary_action->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffdisciplinary_action_list->Recordset)
	$staffdisciplinary_action_list->Recordset->Close();
?>
<?php if (!$staffdisciplinary_action_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staffdisciplinary_action_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_action_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_action_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffdisciplinary_action_list->TotalRecords == 0 && !$staffdisciplinary_action->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffdisciplinary_action_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staffdisciplinary_action_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffdisciplinary_action_list->isExport()) { ?>
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
$staffdisciplinary_action_list->terminate();
?>