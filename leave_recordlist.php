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
$leave_record_list = new leave_record_list();

// Run the page
$leave_record_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_record_list->isExport()) { ?>
<script>
var fleave_recordlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fleave_recordlist = currentForm = new ew.Form("fleave_recordlist", "list");
	fleave_recordlist.formKeyCountName = '<?php echo $leave_record_list->FormKeyCountName ?>';

	// Validate form
	fleave_recordlist.validate = function() {
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
			<?php if ($leave_record_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->EmployeeID->caption(), $leave_record_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_list->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_record_list->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->LeaveTypeCode->caption(), $leave_record_list->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_record_list->EffectiveDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->EffectiveDate->caption(), $leave_record_list->EffectiveDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_list->EffectiveDate->errorMessage()) ?>");
			<?php if ($leave_record_list->OpeningBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_OpeningBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->OpeningBalance->caption(), $leave_record_list->OpeningBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OpeningBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_list->OpeningBalance->errorMessage()) ?>");
			<?php if ($leave_record_list->LeaveAccrued->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->LeaveAccrued->caption(), $leave_record_list->LeaveAccrued->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_list->LeaveAccrued->errorMessage()) ?>");
			<?php if ($leave_record_list->LastAccrualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->LastAccrualDate->caption(), $leave_record_list->LastAccrualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_list->LastAccrualDate->errorMessage()) ?>");
			<?php if ($leave_record_list->LeaveTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->LeaveTaken->caption(), $leave_record_list->LeaveTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveTaken");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_list->LeaveTaken->errorMessage()) ?>");
			<?php if ($leave_record_list->LeaveCommuted->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveCommuted");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_list->LeaveCommuted->caption(), $leave_record_list->LeaveCommuted->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveCommuted");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_list->LeaveCommuted->errorMessage()) ?>");

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
	fleave_recordlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveTypeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "EffectiveDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "OpeningBalance", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveAccrued", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastAccrualDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveTaken", false)) return false;
		if (ew.valueChanged(fobj, infix, "LeaveCommuted", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fleave_recordlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_recordlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_recordlist.lists["x_LeaveTypeCode"] = <?php echo $leave_record_list->LeaveTypeCode->Lookup->toClientList($leave_record_list) ?>;
	fleave_recordlist.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_record_list->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_recordlist");
});
var fleave_recordlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fleave_recordlistsrch = currentSearchForm = new ew.Form("fleave_recordlistsrch");

	// Dynamic selection lists
	// Filters

	fleave_recordlistsrch.filterList = <?php echo $leave_record_list->getFilterList() ?>;

	// Init search panel as collapsed
	fleave_recordlistsrch.initSearchPanel = true;
	loadjs.done("fleave_recordlistsrch");
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
<?php if (!$leave_record_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($leave_record_list->TotalRecords > 0 && $leave_record_list->ExportOptions->visible()) { ?>
<?php $leave_record_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_record_list->ImportOptions->visible()) { ?>
<?php $leave_record_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_record_list->SearchOptions->visible()) { ?>
<?php $leave_record_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($leave_record_list->FilterOptions->visible()) { ?>
<?php $leave_record_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$leave_record_list->isExport() || Config("EXPORT_MASTER_RECORD") && $leave_record_list->isExport("print")) { ?>
<?php
if ($leave_record_list->DbMasterFilter != "" && $leave_record->getCurrentMasterTable() == "employment") {
	if ($leave_record_list->MasterRecordExists) {
		include_once "employmentmaster.php";
	}
}
?>
<?php } ?>
<?php
$leave_record_list->renderOtherOptions();
?>
<?php $leave_record_list->showPageHeader(); ?>
<?php
$leave_record_list->showMessage();
?>
<?php if ($leave_record_list->TotalRecords > 0 || $leave_record->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_record_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_record">
<?php if (!$leave_record_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$leave_record_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_record_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_record_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fleave_recordlist" id="fleave_recordlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_record">
<?php if ($leave_record->getCurrentMasterTable() == "employment" && $leave_record->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($leave_record_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_leave_record" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($leave_record_list->TotalRecords > 0 || $leave_record_list->isGridEdit()) { ?>
<table id="tbl_leave_recordlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_record->RowType = ROWTYPE_HEADER;

// Render list options
$leave_record_list->renderListOptions();

// Render list options (header, left)
$leave_record_list->ListOptions->render("header", "left");
?>
<?php if ($leave_record_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_record_list->EmployeeID->headerCellClass() ?>"><div id="elh_leave_record_EmployeeID" class="leave_record_EmployeeID"><div class="ew-table-header-caption"><?php echo $leave_record_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_record_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->EmployeeID) ?>', 1);"><div id="elh_leave_record_EmployeeID" class="leave_record_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_record_list->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_record_LeaveTypeCode" class="leave_record_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_record_list->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_record_list->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->LeaveTypeCode) ?>', 1);"><div id="elh_leave_record_LeaveTypeCode" class="leave_record_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_list->EffectiveDate->Visible) { // EffectiveDate ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->EffectiveDate) == "") { ?>
		<th data-name="EffectiveDate" class="<?php echo $leave_record_list->EffectiveDate->headerCellClass() ?>"><div id="elh_leave_record_EffectiveDate" class="leave_record_EffectiveDate"><div class="ew-table-header-caption"><?php echo $leave_record_list->EffectiveDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EffectiveDate" class="<?php echo $leave_record_list->EffectiveDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->EffectiveDate) ?>', 1);"><div id="elh_leave_record_EffectiveDate" class="leave_record_EffectiveDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->EffectiveDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->EffectiveDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->EffectiveDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_list->OpeningBalance->Visible) { // OpeningBalance ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->OpeningBalance) == "") { ?>
		<th data-name="OpeningBalance" class="<?php echo $leave_record_list->OpeningBalance->headerCellClass() ?>"><div id="elh_leave_record_OpeningBalance" class="leave_record_OpeningBalance"><div class="ew-table-header-caption"><?php echo $leave_record_list->OpeningBalance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OpeningBalance" class="<?php echo $leave_record_list->OpeningBalance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->OpeningBalance) ?>', 1);"><div id="elh_leave_record_OpeningBalance" class="leave_record_OpeningBalance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->OpeningBalance->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->OpeningBalance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->OpeningBalance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_list->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->LeaveAccrued) == "") { ?>
		<th data-name="LeaveAccrued" class="<?php echo $leave_record_list->LeaveAccrued->headerCellClass() ?>"><div id="elh_leave_record_LeaveAccrued" class="leave_record_LeaveAccrued"><div class="ew-table-header-caption"><?php echo $leave_record_list->LeaveAccrued->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveAccrued" class="<?php echo $leave_record_list->LeaveAccrued->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->LeaveAccrued) ?>', 1);"><div id="elh_leave_record_LeaveAccrued" class="leave_record_LeaveAccrued">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->LeaveAccrued->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->LeaveAccrued->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->LeaveAccrued->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_list->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->LastAccrualDate) == "") { ?>
		<th data-name="LastAccrualDate" class="<?php echo $leave_record_list->LastAccrualDate->headerCellClass() ?>"><div id="elh_leave_record_LastAccrualDate" class="leave_record_LastAccrualDate"><div class="ew-table-header-caption"><?php echo $leave_record_list->LastAccrualDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastAccrualDate" class="<?php echo $leave_record_list->LastAccrualDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->LastAccrualDate) ?>', 1);"><div id="elh_leave_record_LastAccrualDate" class="leave_record_LastAccrualDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->LastAccrualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->LastAccrualDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->LastAccrualDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_list->LeaveTaken->Visible) { // LeaveTaken ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->LeaveTaken) == "") { ?>
		<th data-name="LeaveTaken" class="<?php echo $leave_record_list->LeaveTaken->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_leave_record_LeaveTaken" class="leave_record_LeaveTaken"><div class="ew-table-header-caption"><?php echo $leave_record_list->LeaveTaken->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTaken" class="<?php echo $leave_record_list->LeaveTaken->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->LeaveTaken) ?>', 1);"><div id="elh_leave_record_LeaveTaken" class="leave_record_LeaveTaken">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->LeaveTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->LeaveTaken->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->LeaveTaken->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_record_list->LeaveCommuted->Visible) { // LeaveCommuted ?>
	<?php if ($leave_record_list->SortUrl($leave_record_list->LeaveCommuted) == "") { ?>
		<th data-name="LeaveCommuted" class="<?php echo $leave_record_list->LeaveCommuted->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_leave_record_LeaveCommuted" class="leave_record_LeaveCommuted"><div class="ew-table-header-caption"><?php echo $leave_record_list->LeaveCommuted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveCommuted" class="<?php echo $leave_record_list->LeaveCommuted->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_record_list->SortUrl($leave_record_list->LeaveCommuted) ?>', 1);"><div id="elh_leave_record_LeaveCommuted" class="leave_record_LeaveCommuted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_record_list->LeaveCommuted->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_record_list->LeaveCommuted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_record_list->LeaveCommuted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_record_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($leave_record_list->ExportAll && $leave_record_list->isExport()) {
	$leave_record_list->StopRecord = $leave_record_list->TotalRecords;
} else {

	// Set the last record to display
	if ($leave_record_list->TotalRecords > $leave_record_list->StartRecord + $leave_record_list->DisplayRecords - 1)
		$leave_record_list->StopRecord = $leave_record_list->StartRecord + $leave_record_list->DisplayRecords - 1;
	else
		$leave_record_list->StopRecord = $leave_record_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($leave_record->isConfirm() || $leave_record_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($leave_record_list->FormKeyCountName) && ($leave_record_list->isGridAdd() || $leave_record_list->isGridEdit() || $leave_record->isConfirm())) {
		$leave_record_list->KeyCount = $CurrentForm->getValue($leave_record_list->FormKeyCountName);
		$leave_record_list->StopRecord = $leave_record_list->StartRecord + $leave_record_list->KeyCount - 1;
	}
}
$leave_record_list->RecordCount = $leave_record_list->StartRecord - 1;
if ($leave_record_list->Recordset && !$leave_record_list->Recordset->EOF) {
	$leave_record_list->Recordset->moveFirst();
	$selectLimit = $leave_record_list->UseSelectLimit;
	if (!$selectLimit && $leave_record_list->StartRecord > 1)
		$leave_record_list->Recordset->move($leave_record_list->StartRecord - 1);
} elseif (!$leave_record->AllowAddDeleteRow && $leave_record_list->StopRecord == 0) {
	$leave_record_list->StopRecord = $leave_record->GridAddRowCount;
}

// Initialize aggregate
$leave_record->RowType = ROWTYPE_AGGREGATEINIT;
$leave_record->resetAttributes();
$leave_record_list->renderRow();
if ($leave_record_list->isGridAdd())
	$leave_record_list->RowIndex = 0;
if ($leave_record_list->isGridEdit())
	$leave_record_list->RowIndex = 0;
while ($leave_record_list->RecordCount < $leave_record_list->StopRecord) {
	$leave_record_list->RecordCount++;
	if ($leave_record_list->RecordCount >= $leave_record_list->StartRecord) {
		$leave_record_list->RowCount++;
		if ($leave_record_list->isGridAdd() || $leave_record_list->isGridEdit() || $leave_record->isConfirm()) {
			$leave_record_list->RowIndex++;
			$CurrentForm->Index = $leave_record_list->RowIndex;
			if ($CurrentForm->hasValue($leave_record_list->FormActionName) && ($leave_record->isConfirm() || $leave_record_list->EventCancelled))
				$leave_record_list->RowAction = strval($CurrentForm->getValue($leave_record_list->FormActionName));
			elseif ($leave_record_list->isGridAdd())
				$leave_record_list->RowAction = "insert";
			else
				$leave_record_list->RowAction = "";
		}

		// Set up key count
		$leave_record_list->KeyCount = $leave_record_list->RowIndex;

		// Init row class and style
		$leave_record->resetAttributes();
		$leave_record->CssClass = "";
		if ($leave_record_list->isGridAdd()) {
			$leave_record_list->loadRowValues(); // Load default values
		} else {
			$leave_record_list->loadRowValues($leave_record_list->Recordset); // Load row values
		}
		$leave_record->RowType = ROWTYPE_VIEW; // Render view
		if ($leave_record_list->isGridAdd()) // Grid add
			$leave_record->RowType = ROWTYPE_ADD; // Render add
		if ($leave_record_list->isGridAdd() && $leave_record->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$leave_record_list->restoreCurrentRowFormValues($leave_record_list->RowIndex); // Restore form values
		if ($leave_record_list->isGridEdit()) { // Grid edit
			if ($leave_record->EventCancelled)
				$leave_record_list->restoreCurrentRowFormValues($leave_record_list->RowIndex); // Restore form values
			if ($leave_record_list->RowAction == "insert")
				$leave_record->RowType = ROWTYPE_ADD; // Render add
			else
				$leave_record->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($leave_record_list->isGridEdit() && ($leave_record->RowType == ROWTYPE_EDIT || $leave_record->RowType == ROWTYPE_ADD) && $leave_record->EventCancelled) // Update failed
			$leave_record_list->restoreCurrentRowFormValues($leave_record_list->RowIndex); // Restore form values
		if ($leave_record->RowType == ROWTYPE_EDIT) // Edit row
			$leave_record_list->EditRowCount++;

		// Set up row id / data-rowindex
		$leave_record->RowAttrs->merge(["data-rowindex" => $leave_record_list->RowCount, "id" => "r" . $leave_record_list->RowCount . "_leave_record", "data-rowtype" => $leave_record->RowType]);

		// Render row
		$leave_record_list->renderRow();

		// Render list options
		$leave_record_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($leave_record_list->RowAction != "delete" && $leave_record_list->RowAction != "insertdelete" && !($leave_record_list->RowAction == "insert" && $leave_record->isConfirm() && $leave_record_list->emptyRow())) {
?>
	<tr <?php echo $leave_record->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_record_list->ListOptions->render("body", "left", $leave_record_list->RowCount);
?>
	<?php if ($leave_record_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $leave_record_list->EmployeeID->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($leave_record_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_EmployeeID" class="form-group">
<span<?php echo $leave_record_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" name="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_EmployeeID" class="form-group">
<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->EmployeeID->EditValue ?>"<?php echo $leave_record_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o<?php echo $leave_record_list->RowIndex ?>_EmployeeID" id="o<?php echo $leave_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($leave_record_list->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_EmployeeID" class="form-group">
<span<?php echo $leave_record_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_list->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" name="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->EmployeeID->EditValue ?>"<?php echo $leave_record_list->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o<?php echo $leave_record_list->RowIndex ?>_EmployeeID" id="o<?php echo $leave_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_list->EmployeeID->OldValue != null ? $leave_record_list->EmployeeID->OldValue : $leave_record_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_EmployeeID">
<span<?php echo $leave_record_list->EmployeeID->viewAttributes() ?>><?php echo $leave_record_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_record_list->LeaveTypeCode->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_list->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode"<?php echo $leave_record_list->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_list->LeaveTypeCode->selectOptionListHtml("x{$leave_record_list->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_list->LeaveTypeCode->Lookup->getParamTag($leave_record_list, "p_x" . $leave_record_list->RowIndex . "_LeaveTypeCode") ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_list->LeaveTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_list->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode"<?php echo $leave_record_list->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_list->LeaveTypeCode->selectOptionListHtml("x{$leave_record_list->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_list->LeaveTypeCode->Lookup->getParamTag($leave_record_list, "p_x" . $leave_record_list->RowIndex . "_LeaveTypeCode") ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_list->LeaveTypeCode->OldValue != null ? $leave_record_list->LeaveTypeCode->OldValue : $leave_record_list->LeaveTypeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveTypeCode">
<span<?php echo $leave_record_list->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_record_list->LeaveTypeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_list->EffectiveDate->Visible) { // EffectiveDate ?>
		<td data-name="EffectiveDate" <?php echo $leave_record_list->EffectiveDate->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_EffectiveDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_list->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->EffectiveDate->EditValue ?>"<?php echo $leave_record_list->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_list->EffectiveDate->ReadOnly && !$leave_record_list->EffectiveDate->Disabled && !isset($leave_record_list->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_list->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordlist", "x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="o<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" id="o<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_list->EffectiveDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_EffectiveDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_list->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->EffectiveDate->EditValue ?>"<?php echo $leave_record_list->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_list->EffectiveDate->ReadOnly && !$leave_record_list->EffectiveDate->Disabled && !isset($leave_record_list->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_list->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordlist", "x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_EffectiveDate">
<span<?php echo $leave_record_list->EffectiveDate->viewAttributes() ?>><?php echo $leave_record_list->EffectiveDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_list->OpeningBalance->Visible) { // OpeningBalance ?>
		<td data-name="OpeningBalance" <?php echo $leave_record_list->OpeningBalance->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_OpeningBalance" class="form-group">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->OpeningBalance->EditValue ?>"<?php echo $leave_record_list->OpeningBalance->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="o<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" id="o<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_list->OpeningBalance->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_OpeningBalance" class="form-group">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->OpeningBalance->EditValue ?>"<?php echo $leave_record_list->OpeningBalance->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_OpeningBalance">
<span<?php echo $leave_record_list->OpeningBalance->viewAttributes() ?>><?php echo $leave_record_list->OpeningBalance->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<td data-name="LeaveAccrued" <?php echo $leave_record_list->LeaveAccrued->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveAccrued" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveAccrued->EditValue ?>"<?php echo $leave_record_list->LeaveAccrued->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_list->LeaveAccrued->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveAccrued" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveAccrued->EditValue ?>"<?php echo $leave_record_list->LeaveAccrued->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveAccrued">
<span<?php echo $leave_record_list->LeaveAccrued->viewAttributes() ?>><?php echo $leave_record_list->LeaveAccrued->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_list->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<td data-name="LastAccrualDate" <?php echo $leave_record_list->LastAccrualDate->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LastAccrualDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_list->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LastAccrualDate->EditValue ?>"<?php echo $leave_record_list->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_list->LastAccrualDate->ReadOnly && !$leave_record_list->LastAccrualDate->Disabled && !isset($leave_record_list->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_list->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordlist", "x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="o<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" id="o<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_list->LastAccrualDate->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LastAccrualDate" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_list->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LastAccrualDate->EditValue ?>"<?php echo $leave_record_list->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_list->LastAccrualDate->ReadOnly && !$leave_record_list->LastAccrualDate->Disabled && !isset($leave_record_list->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_list->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordlist", "x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LastAccrualDate">
<span<?php echo $leave_record_list->LastAccrualDate->viewAttributes() ?>><?php echo $leave_record_list->LastAccrualDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveTaken->Visible) { // LeaveTaken ?>
		<td data-name="LeaveTaken" <?php echo $leave_record_list->LeaveTaken->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveTaken" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveTaken->EditValue ?>"<?php echo $leave_record_list->LeaveTaken->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_list->LeaveTaken->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveTaken" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveTaken->EditValue ?>"<?php echo $leave_record_list->LeaveTaken->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveTaken">
<span<?php echo $leave_record_list->LeaveTaken->viewAttributes() ?>><?php echo $leave_record_list->LeaveTaken->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveCommuted->Visible) { // LeaveCommuted ?>
		<td data-name="LeaveCommuted" <?php echo $leave_record_list->LeaveCommuted->cellAttributes() ?>>
<?php if ($leave_record->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveCommuted" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveCommuted->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveCommuted->EditValue ?>"<?php echo $leave_record_list->LeaveCommuted->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_list->LeaveCommuted->OldValue) ?>">
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveCommuted" class="form-group">
<input type="text" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveCommuted->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveCommuted->EditValue ?>"<?php echo $leave_record_list->LeaveCommuted->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($leave_record->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $leave_record_list->RowCount ?>_leave_record_LeaveCommuted">
<span<?php echo $leave_record_list->LeaveCommuted->viewAttributes() ?>><?php echo $leave_record_list->LeaveCommuted->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_record_list->ListOptions->render("body", "right", $leave_record_list->RowCount);
?>
	</tr>
<?php if ($leave_record->RowType == ROWTYPE_ADD || $leave_record->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fleave_recordlist", "load"], function() {
	fleave_recordlist.updateLists(<?php echo $leave_record_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$leave_record_list->isGridAdd())
		if (!$leave_record_list->Recordset->EOF)
			$leave_record_list->Recordset->moveNext();
}
?>
<?php
	if ($leave_record_list->isGridAdd() || $leave_record_list->isGridEdit()) {
		$leave_record_list->RowIndex = '$rowindex$';
		$leave_record_list->loadRowValues();

		// Set row properties
		$leave_record->resetAttributes();
		$leave_record->RowAttrs->merge(["data-rowindex" => $leave_record_list->RowIndex, "id" => "r0_leave_record", "data-rowtype" => ROWTYPE_ADD]);
		$leave_record->RowAttrs->appendClass("ew-template");
		$leave_record->RowType = ROWTYPE_ADD;

		// Render row
		$leave_record_list->renderRow();

		// Render list options
		$leave_record_list->renderListOptions();
		$leave_record_list->StartRowCount = 0;
?>
	<tr <?php echo $leave_record->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_record_list->ListOptions->render("body", "left", $leave_record_list->RowIndex);
?>
	<?php if ($leave_record_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if ($leave_record_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_leave_record_EmployeeID" class="form-group leave_record_EmployeeID">
<span<?php echo $leave_record_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" name="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_leave_record_EmployeeID" class="form-group leave_record_EmployeeID">
<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" id="x<?php echo $leave_record_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->EmployeeID->EditValue ?>"<?php echo $leave_record_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o<?php echo $leave_record_list->RowIndex ?>_EmployeeID" id="o<?php echo $leave_record_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($leave_record_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode">
<span id="el$rowindex$_leave_record_LeaveTypeCode" class="form-group leave_record_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_list->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode"<?php echo $leave_record_list->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_list->LeaveTypeCode->selectOptionListHtml("x{$leave_record_list->RowIndex}_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_list->LeaveTypeCode->Lookup->getParamTag($leave_record_list, "p_x" . $leave_record_list->RowIndex . "_LeaveTypeCode") ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_list->LeaveTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_list->EffectiveDate->Visible) { // EffectiveDate ?>
		<td data-name="EffectiveDate">
<span id="el$rowindex$_leave_record_EffectiveDate" class="form-group leave_record_EffectiveDate">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" id="x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_list->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->EffectiveDate->EditValue ?>"<?php echo $leave_record_list->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_list->EffectiveDate->ReadOnly && !$leave_record_list->EffectiveDate->Disabled && !isset($leave_record_list->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_list->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordlist", "x<?php echo $leave_record_list->RowIndex ?>_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="o<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" id="o<?php echo $leave_record_list->RowIndex ?>_EffectiveDate" value="<?php echo HtmlEncode($leave_record_list->EffectiveDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_list->OpeningBalance->Visible) { // OpeningBalance ?>
		<td data-name="OpeningBalance">
<span id="el$rowindex$_leave_record_OpeningBalance" class="form-group leave_record_OpeningBalance">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" id="x<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->OpeningBalance->EditValue ?>"<?php echo $leave_record_list->OpeningBalance->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_OpeningBalance" name="o<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" id="o<?php echo $leave_record_list->RowIndex ?>_OpeningBalance" value="<?php echo HtmlEncode($leave_record_list->OpeningBalance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<td data-name="LeaveAccrued">
<span id="el$rowindex$_leave_record_LeaveAccrued" class="form-group leave_record_LeaveAccrued">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveAccrued->EditValue ?>"<?php echo $leave_record_list->LeaveAccrued->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_list->LeaveAccrued->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_list->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<td data-name="LastAccrualDate">
<span id="el$rowindex$_leave_record_LastAccrualDate" class="form-group leave_record_LastAccrualDate">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" id="x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_list->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LastAccrualDate->EditValue ?>"<?php echo $leave_record_list->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_list->LastAccrualDate->ReadOnly && !$leave_record_list->LastAccrualDate->Disabled && !isset($leave_record_list->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_list->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordlist", "x<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="o<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" id="o<?php echo $leave_record_list->RowIndex ?>_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_list->LastAccrualDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveTaken->Visible) { // LeaveTaken ?>
		<td data-name="LeaveTaken">
<span id="el$rowindex$_leave_record_LeaveTaken" class="form-group leave_record_LeaveTaken">
<input type="text" data-table="leave_record" data-field="x_LeaveTaken" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveTaken->EditValue ?>"<?php echo $leave_record_list->LeaveTaken->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTaken" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveTaken" value="<?php echo HtmlEncode($leave_record_list->LeaveTaken->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($leave_record_list->LeaveCommuted->Visible) { // LeaveCommuted ?>
		<td data-name="LeaveCommuted">
<span id="el$rowindex$_leave_record_LeaveCommuted" class="form-group leave_record_LeaveCommuted">
<input type="text" data-table="leave_record" data-field="x_LeaveCommuted" name="x<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" id="x<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" size="30" placeholder="<?php echo HtmlEncode($leave_record_list->LeaveCommuted->getPlaceHolder()) ?>" value="<?php echo $leave_record_list->LeaveCommuted->EditValue ?>"<?php echo $leave_record_list->LeaveCommuted->editAttributes() ?>>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveCommuted" name="o<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" id="o<?php echo $leave_record_list->RowIndex ?>_LeaveCommuted" value="<?php echo HtmlEncode($leave_record_list->LeaveCommuted->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_record_list->ListOptions->render("body", "right", $leave_record_list->RowIndex);
?>
<script>
loadjs.ready(["fleave_recordlist", "load"], function() {
	fleave_recordlist.updateLists(<?php echo $leave_record_list->RowIndex ?>);
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
<?php if ($leave_record_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $leave_record_list->FormKeyCountName ?>" id="<?php echo $leave_record_list->FormKeyCountName ?>" value="<?php echo $leave_record_list->KeyCount ?>">
<?php echo $leave_record_list->MultiSelectKey ?>
<?php } ?>
<?php if ($leave_record_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $leave_record_list->FormKeyCountName ?>" id="<?php echo $leave_record_list->FormKeyCountName ?>" value="<?php echo $leave_record_list->KeyCount ?>">
<?php echo $leave_record_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$leave_record->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_record_list->Recordset)
	$leave_record_list->Recordset->Close();
?>
<?php if (!$leave_record_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$leave_record_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_record_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_record_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_record_list->TotalRecords == 0 && !$leave_record->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_record_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$leave_record_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_record_list->isExport()) { ?>
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
$leave_record_list->terminate();
?>