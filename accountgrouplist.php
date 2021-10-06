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
$accountgroup_list = new accountgroup_list();

// Run the page
$accountgroup_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accountgroup_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$accountgroup_list->isExport()) { ?>
<script>
var faccountgrouplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	faccountgrouplist = currentForm = new ew.Form("faccountgrouplist", "list");
	faccountgrouplist.formKeyCountName = '<?php echo $accountgroup_list->FormKeyCountName ?>';

	// Validate form
	faccountgrouplist.validate = function() {
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
			<?php if ($accountgroup_list->AccountGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_list->AccountGroupCode->caption(), $accountgroup_list->AccountGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accountgroup_list->AccountGroupCode->errorMessage()) ?>");
			<?php if ($accountgroup_list->AccountGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_list->AccountGroupName->caption(), $accountgroup_list->AccountGroupName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accountgroup_list->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_list->AccountType->caption(), $accountgroup_list->AccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accountgroup_list->AccountType->errorMessage()) ?>");

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
	faccountgrouplist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AccountGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountGroupName", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	faccountgrouplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccountgrouplist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccountgrouplist.lists["x_AccountType"] = <?php echo $accountgroup_list->AccountType->Lookup->toClientList($accountgroup_list) ?>;
	faccountgrouplist.lists["x_AccountType"].options = <?php echo JsonEncode($accountgroup_list->AccountType->lookupOptions()) ?>;
	faccountgrouplist.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("faccountgrouplist");
});
var faccountgrouplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	faccountgrouplistsrch = currentSearchForm = new ew.Form("faccountgrouplistsrch");

	// Dynamic selection lists
	// Filters

	faccountgrouplistsrch.filterList = <?php echo $accountgroup_list->getFilterList() ?>;

	// Init search panel as collapsed
	faccountgrouplistsrch.initSearchPanel = true;
	loadjs.done("faccountgrouplistsrch");
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
<?php if (!$accountgroup_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($accountgroup_list->TotalRecords > 0 && $accountgroup_list->ExportOptions->visible()) { ?>
<?php $accountgroup_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($accountgroup_list->ImportOptions->visible()) { ?>
<?php $accountgroup_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($accountgroup_list->SearchOptions->visible()) { ?>
<?php $accountgroup_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($accountgroup_list->FilterOptions->visible()) { ?>
<?php $accountgroup_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$accountgroup_list->isExport() || Config("EXPORT_MASTER_RECORD") && $accountgroup_list->isExport("print")) { ?>
<?php
if ($accountgroup_list->DbMasterFilter != "" && $accountgroup->getCurrentMasterTable() == "account_type") {
	if ($accountgroup_list->MasterRecordExists) {
		include_once "account_typemaster.php";
	}
}
?>
<?php } ?>
<?php
$accountgroup_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$accountgroup_list->isExport() && !$accountgroup->CurrentAction) { ?>
<form name="faccountgrouplistsrch" id="faccountgrouplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="faccountgrouplistsrch-search-panel" class="<?php echo $accountgroup_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="accountgroup">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $accountgroup_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($accountgroup_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($accountgroup_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $accountgroup_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($accountgroup_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($accountgroup_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($accountgroup_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($accountgroup_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $accountgroup_list->showPageHeader(); ?>
<?php
$accountgroup_list->showMessage();
?>
<?php if ($accountgroup_list->TotalRecords > 0 || $accountgroup->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($accountgroup_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> accountgroup">
<?php if (!$accountgroup_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$accountgroup_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $accountgroup_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $accountgroup_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="faccountgrouplist" id="faccountgrouplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="accountgroup">
<?php if ($accountgroup->getCurrentMasterTable() == "account_type" && $accountgroup->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="account_type">
<input type="hidden" name="fk_AccountTypeCode" value="<?php echo HtmlEncode($accountgroup_list->AccountType->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_accountgroup" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($accountgroup_list->TotalRecords > 0 || $accountgroup_list->isGridEdit()) { ?>
<table id="tbl_accountgrouplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$accountgroup->RowType = ROWTYPE_HEADER;

// Render list options
$accountgroup_list->renderListOptions();

// Render list options (header, left)
$accountgroup_list->ListOptions->render("header", "left");
?>
<?php if ($accountgroup_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($accountgroup_list->SortUrl($accountgroup_list->AccountGroupCode) == "") { ?>
		<th data-name="AccountGroupCode" class="<?php echo $accountgroup_list->AccountGroupCode->headerCellClass() ?>"><div id="elh_accountgroup_AccountGroupCode" class="accountgroup_AccountGroupCode"><div class="ew-table-header-caption"><?php echo $accountgroup_list->AccountGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupCode" class="<?php echo $accountgroup_list->AccountGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accountgroup_list->SortUrl($accountgroup_list->AccountGroupCode) ?>', 1);"><div id="elh_accountgroup_AccountGroupCode" class="accountgroup_AccountGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_list->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_list->AccountGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_list->AccountGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accountgroup_list->AccountGroupName->Visible) { // AccountGroupName ?>
	<?php if ($accountgroup_list->SortUrl($accountgroup_list->AccountGroupName) == "") { ?>
		<th data-name="AccountGroupName" class="<?php echo $accountgroup_list->AccountGroupName->headerCellClass() ?>"><div id="elh_accountgroup_AccountGroupName" class="accountgroup_AccountGroupName"><div class="ew-table-header-caption"><?php echo $accountgroup_list->AccountGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupName" class="<?php echo $accountgroup_list->AccountGroupName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accountgroup_list->SortUrl($accountgroup_list->AccountGroupName) ?>', 1);"><div id="elh_accountgroup_AccountGroupName" class="accountgroup_AccountGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_list->AccountGroupName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_list->AccountGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_list->AccountGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accountgroup_list->AccountType->Visible) { // AccountType ?>
	<?php if ($accountgroup_list->SortUrl($accountgroup_list->AccountType) == "") { ?>
		<th data-name="AccountType" class="<?php echo $accountgroup_list->AccountType->headerCellClass() ?>"><div id="elh_accountgroup_AccountType" class="accountgroup_AccountType"><div class="ew-table-header-caption"><?php echo $accountgroup_list->AccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountType" class="<?php echo $accountgroup_list->AccountType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $accountgroup_list->SortUrl($accountgroup_list->AccountType) ?>', 1);"><div id="elh_accountgroup_AccountType" class="accountgroup_AccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_list->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_list->AccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_list->AccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$accountgroup_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($accountgroup_list->ExportAll && $accountgroup_list->isExport()) {
	$accountgroup_list->StopRecord = $accountgroup_list->TotalRecords;
} else {

	// Set the last record to display
	if ($accountgroup_list->TotalRecords > $accountgroup_list->StartRecord + $accountgroup_list->DisplayRecords - 1)
		$accountgroup_list->StopRecord = $accountgroup_list->StartRecord + $accountgroup_list->DisplayRecords - 1;
	else
		$accountgroup_list->StopRecord = $accountgroup_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($accountgroup->isConfirm() || $accountgroup_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($accountgroup_list->FormKeyCountName) && ($accountgroup_list->isGridAdd() || $accountgroup_list->isGridEdit() || $accountgroup->isConfirm())) {
		$accountgroup_list->KeyCount = $CurrentForm->getValue($accountgroup_list->FormKeyCountName);
		$accountgroup_list->StopRecord = $accountgroup_list->StartRecord + $accountgroup_list->KeyCount - 1;
	}
}
$accountgroup_list->RecordCount = $accountgroup_list->StartRecord - 1;
if ($accountgroup_list->Recordset && !$accountgroup_list->Recordset->EOF) {
	$accountgroup_list->Recordset->moveFirst();
	$selectLimit = $accountgroup_list->UseSelectLimit;
	if (!$selectLimit && $accountgroup_list->StartRecord > 1)
		$accountgroup_list->Recordset->move($accountgroup_list->StartRecord - 1);
} elseif (!$accountgroup->AllowAddDeleteRow && $accountgroup_list->StopRecord == 0) {
	$accountgroup_list->StopRecord = $accountgroup->GridAddRowCount;
}

// Initialize aggregate
$accountgroup->RowType = ROWTYPE_AGGREGATEINIT;
$accountgroup->resetAttributes();
$accountgroup_list->renderRow();
if ($accountgroup_list->isGridAdd())
	$accountgroup_list->RowIndex = 0;
while ($accountgroup_list->RecordCount < $accountgroup_list->StopRecord) {
	$accountgroup_list->RecordCount++;
	if ($accountgroup_list->RecordCount >= $accountgroup_list->StartRecord) {
		$accountgroup_list->RowCount++;
		if ($accountgroup_list->isGridAdd() || $accountgroup_list->isGridEdit() || $accountgroup->isConfirm()) {
			$accountgroup_list->RowIndex++;
			$CurrentForm->Index = $accountgroup_list->RowIndex;
			if ($CurrentForm->hasValue($accountgroup_list->FormActionName) && ($accountgroup->isConfirm() || $accountgroup_list->EventCancelled))
				$accountgroup_list->RowAction = strval($CurrentForm->getValue($accountgroup_list->FormActionName));
			elseif ($accountgroup_list->isGridAdd())
				$accountgroup_list->RowAction = "insert";
			else
				$accountgroup_list->RowAction = "";
		}

		// Set up key count
		$accountgroup_list->KeyCount = $accountgroup_list->RowIndex;

		// Init row class and style
		$accountgroup->resetAttributes();
		$accountgroup->CssClass = "";
		if ($accountgroup_list->isGridAdd()) {
			$accountgroup_list->loadRowValues(); // Load default values
		} else {
			$accountgroup_list->loadRowValues($accountgroup_list->Recordset); // Load row values
		}
		$accountgroup->RowType = ROWTYPE_VIEW; // Render view
		if ($accountgroup_list->isGridAdd()) // Grid add
			$accountgroup->RowType = ROWTYPE_ADD; // Render add
		if ($accountgroup_list->isGridAdd() && $accountgroup->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$accountgroup_list->restoreCurrentRowFormValues($accountgroup_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$accountgroup->RowAttrs->merge(["data-rowindex" => $accountgroup_list->RowCount, "id" => "r" . $accountgroup_list->RowCount . "_accountgroup", "data-rowtype" => $accountgroup->RowType]);

		// Render row
		$accountgroup_list->renderRow();

		// Render list options
		$accountgroup_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($accountgroup_list->RowAction != "delete" && $accountgroup_list->RowAction != "insertdelete" && !($accountgroup_list->RowAction == "insert" && $accountgroup->isConfirm() && $accountgroup_list->emptyRow())) {
?>
	<tr <?php echo $accountgroup->rowAttributes() ?>>
<?php

// Render list options (body, left)
$accountgroup_list->ListOptions->render("body", "left", $accountgroup_list->RowCount);
?>
	<?php if ($accountgroup_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode" <?php echo $accountgroup_list->AccountGroupCode->cellAttributes() ?>>
<?php if ($accountgroup->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $accountgroup_list->RowCount ?>_accountgroup_AccountGroupCode" class="form-group">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupCode" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" size="30" placeholder="<?php echo HtmlEncode($accountgroup_list->AccountGroupCode->getPlaceHolder()) ?>" value="<?php echo $accountgroup_list->AccountGroupCode->EditValue ?>"<?php echo $accountgroup_list->AccountGroupCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" id="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_list->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $accountgroup_list->RowCount ?>_accountgroup_AccountGroupCode">
<span<?php echo $accountgroup_list->AccountGroupCode->viewAttributes() ?>><?php echo $accountgroup_list->AccountGroupCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($accountgroup_list->AccountGroupName->Visible) { // AccountGroupName ?>
		<td data-name="AccountGroupName" <?php echo $accountgroup_list->AccountGroupName->cellAttributes() ?>>
<?php if ($accountgroup->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $accountgroup_list->RowCount ?>_accountgroup_AccountGroupName" class="form-group">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupName" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($accountgroup_list->AccountGroupName->getPlaceHolder()) ?>" value="<?php echo $accountgroup_list->AccountGroupName->EditValue ?>"<?php echo $accountgroup_list->AccountGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" id="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_list->AccountGroupName->OldValue) ?>">
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $accountgroup_list->RowCount ?>_accountgroup_AccountGroupName">
<span<?php echo $accountgroup_list->AccountGroupName->viewAttributes() ?>><?php echo $accountgroup_list->AccountGroupName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($accountgroup_list->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType" <?php echo $accountgroup_list->AccountType->cellAttributes() ?>>
<?php if ($accountgroup->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($accountgroup_list->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $accountgroup_list->RowCount ?>_accountgroup_AccountType" class="form-group">
<span<?php echo $accountgroup_list->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_list->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_list->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $accountgroup_list->RowCount ?>_accountgroup_AccountType" class="form-group">
<?php
$onchange = $accountgroup_list->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$accountgroup_list->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $accountgroup_list->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $accountgroup_list->RowIndex ?>_AccountType" id="sv_x<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($accountgroup_list->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($accountgroup_list->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($accountgroup_list->AccountType->getPlaceHolder()) ?>"<?php echo $accountgroup_list->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($accountgroup_list->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $accountgroup_list->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($accountgroup_list->AccountType->ReadOnly || $accountgroup_list->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $accountgroup_list->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_list->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccountgrouplist"], function() {
	faccountgrouplist.createAutoSuggest({"id":"x<?php echo $accountgroup_list->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $accountgroup_list->AccountType->Lookup->getParamTag($accountgroup_list, "p_x" . $accountgroup_list->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="o<?php echo $accountgroup_list->RowIndex ?>_AccountType" id="o<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_list->AccountType->OldValue) ?>">
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $accountgroup_list->RowCount ?>_accountgroup_AccountType">
<span<?php echo $accountgroup_list->AccountType->viewAttributes() ?>><?php echo $accountgroup_list->AccountType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$accountgroup_list->ListOptions->render("body", "right", $accountgroup_list->RowCount);
?>
	</tr>
<?php if ($accountgroup->RowType == ROWTYPE_ADD || $accountgroup->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["faccountgrouplist", "load"], function() {
	faccountgrouplist.updateLists(<?php echo $accountgroup_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$accountgroup_list->isGridAdd())
		if (!$accountgroup_list->Recordset->EOF)
			$accountgroup_list->Recordset->moveNext();
}
?>
<?php
	if ($accountgroup_list->isGridAdd() || $accountgroup_list->isGridEdit()) {
		$accountgroup_list->RowIndex = '$rowindex$';
		$accountgroup_list->loadRowValues();

		// Set row properties
		$accountgroup->resetAttributes();
		$accountgroup->RowAttrs->merge(["data-rowindex" => $accountgroup_list->RowIndex, "id" => "r0_accountgroup", "data-rowtype" => ROWTYPE_ADD]);
		$accountgroup->RowAttrs->appendClass("ew-template");
		$accountgroup->RowType = ROWTYPE_ADD;

		// Render row
		$accountgroup_list->renderRow();

		// Render list options
		$accountgroup_list->renderListOptions();
		$accountgroup_list->StartRowCount = 0;
?>
	<tr <?php echo $accountgroup->rowAttributes() ?>>
<?php

// Render list options (body, left)
$accountgroup_list->ListOptions->render("body", "left", $accountgroup_list->RowIndex);
?>
	<?php if ($accountgroup_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode">
<span id="el$rowindex$_accountgroup_AccountGroupCode" class="form-group accountgroup_AccountGroupCode">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupCode" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" size="30" placeholder="<?php echo HtmlEncode($accountgroup_list->AccountGroupCode->getPlaceHolder()) ?>" value="<?php echo $accountgroup_list->AccountGroupCode->EditValue ?>"<?php echo $accountgroup_list->AccountGroupCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" id="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_list->AccountGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($accountgroup_list->AccountGroupName->Visible) { // AccountGroupName ?>
		<td data-name="AccountGroupName">
<span id="el$rowindex$_accountgroup_AccountGroupName" class="form-group accountgroup_AccountGroupName">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupName" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($accountgroup_list->AccountGroupName->getPlaceHolder()) ?>" value="<?php echo $accountgroup_list->AccountGroupName->EditValue ?>"<?php echo $accountgroup_list->AccountGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" id="o<?php echo $accountgroup_list->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_list->AccountGroupName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($accountgroup_list->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType">
<?php if ($accountgroup_list->AccountType->getSessionValue() != "") { ?>
<span id="el$rowindex$_accountgroup_AccountType" class="form-group accountgroup_AccountType">
<span<?php echo $accountgroup_list->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_list->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_list->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_accountgroup_AccountType" class="form-group accountgroup_AccountType">
<?php
$onchange = $accountgroup_list->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$accountgroup_list->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $accountgroup_list->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $accountgroup_list->RowIndex ?>_AccountType" id="sv_x<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($accountgroup_list->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($accountgroup_list->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($accountgroup_list->AccountType->getPlaceHolder()) ?>"<?php echo $accountgroup_list->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($accountgroup_list->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $accountgroup_list->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($accountgroup_list->AccountType->ReadOnly || $accountgroup_list->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $accountgroup_list->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" id="x<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_list->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccountgrouplist"], function() {
	faccountgrouplist.createAutoSuggest({"id":"x<?php echo $accountgroup_list->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $accountgroup_list->AccountType->Lookup->getParamTag($accountgroup_list, "p_x" . $accountgroup_list->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="o<?php echo $accountgroup_list->RowIndex ?>_AccountType" id="o<?php echo $accountgroup_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_list->AccountType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$accountgroup_list->ListOptions->render("body", "right", $accountgroup_list->RowIndex);
?>
<script>
loadjs.ready(["faccountgrouplist", "load"], function() {
	faccountgrouplist.updateLists(<?php echo $accountgroup_list->RowIndex ?>);
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
<?php if ($accountgroup_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $accountgroup_list->FormKeyCountName ?>" id="<?php echo $accountgroup_list->FormKeyCountName ?>" value="<?php echo $accountgroup_list->KeyCount ?>">
<?php echo $accountgroup_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$accountgroup->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($accountgroup_list->Recordset)
	$accountgroup_list->Recordset->Close();
?>
<?php if (!$accountgroup_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$accountgroup_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $accountgroup_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $accountgroup_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($accountgroup_list->TotalRecords == 0 && !$accountgroup->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $accountgroup_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$accountgroup_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$accountgroup_list->isExport()) { ?>
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
$accountgroup_list->terminate();
?>