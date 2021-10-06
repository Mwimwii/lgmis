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
$la_bank_account_list = new la_bank_account_list();

// Run the page
$la_bank_account_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$la_bank_account_list->isExport()) { ?>
<script>
var fla_bank_accountlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fla_bank_accountlist = currentForm = new ew.Form("fla_bank_accountlist", "list");
	fla_bank_accountlist.formKeyCountName = '<?php echo $la_bank_account_list->FormKeyCountName ?>';

	// Validate form
	fla_bank_accountlist.validate = function() {
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
			<?php if ($la_bank_account_list->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_list->BankCode->caption(), $la_bank_account_list->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_list->BranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_list->BranchCode->caption(), $la_bank_account_list->BranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_list->AccountName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_list->AccountName->caption(), $la_bank_account_list->AccountName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_list->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_list->BankAccountNo->caption(), $la_bank_account_list->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_list->LACode->caption(), $la_bank_account_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fla_bank_accountlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "BankCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountName", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankAccountNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fla_bank_accountlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_bank_accountlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_bank_accountlist.lists["x_BankCode"] = <?php echo $la_bank_account_list->BankCode->Lookup->toClientList($la_bank_account_list) ?>;
	fla_bank_accountlist.lists["x_BankCode"].options = <?php echo JsonEncode($la_bank_account_list->BankCode->lookupOptions()) ?>;
	fla_bank_accountlist.autoSuggests["x_BankCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fla_bank_accountlist.lists["x_BranchCode"] = <?php echo $la_bank_account_list->BranchCode->Lookup->toClientList($la_bank_account_list) ?>;
	fla_bank_accountlist.lists["x_BranchCode"].options = <?php echo JsonEncode($la_bank_account_list->BranchCode->lookupOptions()) ?>;
	fla_bank_accountlist.lists["x_LACode"] = <?php echo $la_bank_account_list->LACode->Lookup->toClientList($la_bank_account_list) ?>;
	fla_bank_accountlist.lists["x_LACode"].options = <?php echo JsonEncode($la_bank_account_list->LACode->lookupOptions()) ?>;
	fla_bank_accountlist.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_bank_accountlist");
});
var fla_bank_accountlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fla_bank_accountlistsrch = currentSearchForm = new ew.Form("fla_bank_accountlistsrch");

	// Dynamic selection lists
	// Filters

	fla_bank_accountlistsrch.filterList = <?php echo $la_bank_account_list->getFilterList() ?>;

	// Init search panel as collapsed
	fla_bank_accountlistsrch.initSearchPanel = true;
	loadjs.done("fla_bank_accountlistsrch");
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
<?php if (!$la_bank_account_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($la_bank_account_list->TotalRecords > 0 && $la_bank_account_list->ExportOptions->visible()) { ?>
<?php $la_bank_account_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($la_bank_account_list->ImportOptions->visible()) { ?>
<?php $la_bank_account_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($la_bank_account_list->SearchOptions->visible()) { ?>
<?php $la_bank_account_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($la_bank_account_list->FilterOptions->visible()) { ?>
<?php $la_bank_account_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$la_bank_account_list->isExport() || Config("EXPORT_MASTER_RECORD") && $la_bank_account_list->isExport("print")) { ?>
<?php
if ($la_bank_account_list->DbMasterFilter != "" && $la_bank_account->getCurrentMasterTable() == "local_authority") {
	if ($la_bank_account_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$la_bank_account_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$la_bank_account_list->isExport() && !$la_bank_account->CurrentAction) { ?>
<form name="fla_bank_accountlistsrch" id="fla_bank_accountlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fla_bank_accountlistsrch-search-panel" class="<?php echo $la_bank_account_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="la_bank_account">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $la_bank_account_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($la_bank_account_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($la_bank_account_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $la_bank_account_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($la_bank_account_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($la_bank_account_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($la_bank_account_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($la_bank_account_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $la_bank_account_list->showPageHeader(); ?>
<?php
$la_bank_account_list->showMessage();
?>
<?php if ($la_bank_account_list->TotalRecords > 0 || $la_bank_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($la_bank_account_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> la_bank_account">
<?php if (!$la_bank_account_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$la_bank_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_bank_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $la_bank_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fla_bank_accountlist" id="fla_bank_accountlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_bank_account">
<?php if ($la_bank_account->getCurrentMasterTable() == "local_authority" && $la_bank_account->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_la_bank_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($la_bank_account_list->TotalRecords > 0 || $la_bank_account_list->isGridEdit()) { ?>
<table id="tbl_la_bank_accountlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$la_bank_account->RowType = ROWTYPE_HEADER;

// Render list options
$la_bank_account_list->renderListOptions();

// Render list options (header, left)
$la_bank_account_list->ListOptions->render("header", "left");
?>
<?php if ($la_bank_account_list->BankCode->Visible) { // BankCode ?>
	<?php if ($la_bank_account_list->SortUrl($la_bank_account_list->BankCode) == "") { ?>
		<th data-name="BankCode" class="<?php echo $la_bank_account_list->BankCode->headerCellClass() ?>"><div id="elh_la_bank_account_BankCode" class="la_bank_account_BankCode"><div class="ew-table-header-caption"><?php echo $la_bank_account_list->BankCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankCode" class="<?php echo $la_bank_account_list->BankCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_bank_account_list->SortUrl($la_bank_account_list->BankCode) ?>', 1);"><div id="elh_la_bank_account_BankCode" class="la_bank_account_BankCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_list->BankCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_list->BankCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_list->BankCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_list->BranchCode->Visible) { // BranchCode ?>
	<?php if ($la_bank_account_list->SortUrl($la_bank_account_list->BranchCode) == "") { ?>
		<th data-name="BranchCode" class="<?php echo $la_bank_account_list->BranchCode->headerCellClass() ?>"><div id="elh_la_bank_account_BranchCode" class="la_bank_account_BranchCode"><div class="ew-table-header-caption"><?php echo $la_bank_account_list->BranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchCode" class="<?php echo $la_bank_account_list->BranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_bank_account_list->SortUrl($la_bank_account_list->BranchCode) ?>', 1);"><div id="elh_la_bank_account_BranchCode" class="la_bank_account_BranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_list->BranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_list->BranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_list->BranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_list->AccountName->Visible) { // AccountName ?>
	<?php if ($la_bank_account_list->SortUrl($la_bank_account_list->AccountName) == "") { ?>
		<th data-name="AccountName" class="<?php echo $la_bank_account_list->AccountName->headerCellClass() ?>"><div id="elh_la_bank_account_AccountName" class="la_bank_account_AccountName"><div class="ew-table-header-caption"><?php echo $la_bank_account_list->AccountName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountName" class="<?php echo $la_bank_account_list->AccountName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_bank_account_list->SortUrl($la_bank_account_list->AccountName) ?>', 1);"><div id="elh_la_bank_account_AccountName" class="la_bank_account_AccountName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_list->AccountName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_list->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_list->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_list->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($la_bank_account_list->SortUrl($la_bank_account_list->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $la_bank_account_list->BankAccountNo->headerCellClass() ?>"><div id="elh_la_bank_account_BankAccountNo" class="la_bank_account_BankAccountNo"><div class="ew-table-header-caption"><?php echo $la_bank_account_list->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $la_bank_account_list->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_bank_account_list->SortUrl($la_bank_account_list->BankAccountNo) ?>', 1);"><div id="elh_la_bank_account_BankAccountNo" class="la_bank_account_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_list->BankAccountNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_list->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_list->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_list->LACode->Visible) { // LACode ?>
	<?php if ($la_bank_account_list->SortUrl($la_bank_account_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $la_bank_account_list->LACode->headerCellClass() ?>"><div id="elh_la_bank_account_LACode" class="la_bank_account_LACode"><div class="ew-table-header-caption"><?php echo $la_bank_account_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $la_bank_account_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_bank_account_list->SortUrl($la_bank_account_list->LACode) ?>', 1);"><div id="elh_la_bank_account_LACode" class="la_bank_account_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$la_bank_account_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($la_bank_account_list->ExportAll && $la_bank_account_list->isExport()) {
	$la_bank_account_list->StopRecord = $la_bank_account_list->TotalRecords;
} else {

	// Set the last record to display
	if ($la_bank_account_list->TotalRecords > $la_bank_account_list->StartRecord + $la_bank_account_list->DisplayRecords - 1)
		$la_bank_account_list->StopRecord = $la_bank_account_list->StartRecord + $la_bank_account_list->DisplayRecords - 1;
	else
		$la_bank_account_list->StopRecord = $la_bank_account_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($la_bank_account->isConfirm() || $la_bank_account_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($la_bank_account_list->FormKeyCountName) && ($la_bank_account_list->isGridAdd() || $la_bank_account_list->isGridEdit() || $la_bank_account->isConfirm())) {
		$la_bank_account_list->KeyCount = $CurrentForm->getValue($la_bank_account_list->FormKeyCountName);
		$la_bank_account_list->StopRecord = $la_bank_account_list->StartRecord + $la_bank_account_list->KeyCount - 1;
	}
}
$la_bank_account_list->RecordCount = $la_bank_account_list->StartRecord - 1;
if ($la_bank_account_list->Recordset && !$la_bank_account_list->Recordset->EOF) {
	$la_bank_account_list->Recordset->moveFirst();
	$selectLimit = $la_bank_account_list->UseSelectLimit;
	if (!$selectLimit && $la_bank_account_list->StartRecord > 1)
		$la_bank_account_list->Recordset->move($la_bank_account_list->StartRecord - 1);
} elseif (!$la_bank_account->AllowAddDeleteRow && $la_bank_account_list->StopRecord == 0) {
	$la_bank_account_list->StopRecord = $la_bank_account->GridAddRowCount;
}

// Initialize aggregate
$la_bank_account->RowType = ROWTYPE_AGGREGATEINIT;
$la_bank_account->resetAttributes();
$la_bank_account_list->renderRow();
if ($la_bank_account_list->isGridAdd())
	$la_bank_account_list->RowIndex = 0;
if ($la_bank_account_list->isGridEdit())
	$la_bank_account_list->RowIndex = 0;
while ($la_bank_account_list->RecordCount < $la_bank_account_list->StopRecord) {
	$la_bank_account_list->RecordCount++;
	if ($la_bank_account_list->RecordCount >= $la_bank_account_list->StartRecord) {
		$la_bank_account_list->RowCount++;
		if ($la_bank_account_list->isGridAdd() || $la_bank_account_list->isGridEdit() || $la_bank_account->isConfirm()) {
			$la_bank_account_list->RowIndex++;
			$CurrentForm->Index = $la_bank_account_list->RowIndex;
			if ($CurrentForm->hasValue($la_bank_account_list->FormActionName) && ($la_bank_account->isConfirm() || $la_bank_account_list->EventCancelled))
				$la_bank_account_list->RowAction = strval($CurrentForm->getValue($la_bank_account_list->FormActionName));
			elseif ($la_bank_account_list->isGridAdd())
				$la_bank_account_list->RowAction = "insert";
			else
				$la_bank_account_list->RowAction = "";
		}

		// Set up key count
		$la_bank_account_list->KeyCount = $la_bank_account_list->RowIndex;

		// Init row class and style
		$la_bank_account->resetAttributes();
		$la_bank_account->CssClass = "";
		if ($la_bank_account_list->isGridAdd()) {
			$la_bank_account_list->loadRowValues(); // Load default values
		} else {
			$la_bank_account_list->loadRowValues($la_bank_account_list->Recordset); // Load row values
		}
		$la_bank_account->RowType = ROWTYPE_VIEW; // Render view
		if ($la_bank_account_list->isGridAdd()) // Grid add
			$la_bank_account->RowType = ROWTYPE_ADD; // Render add
		if ($la_bank_account_list->isGridAdd() && $la_bank_account->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$la_bank_account_list->restoreCurrentRowFormValues($la_bank_account_list->RowIndex); // Restore form values
		if ($la_bank_account_list->isGridEdit()) { // Grid edit
			if ($la_bank_account->EventCancelled)
				$la_bank_account_list->restoreCurrentRowFormValues($la_bank_account_list->RowIndex); // Restore form values
			if ($la_bank_account_list->RowAction == "insert")
				$la_bank_account->RowType = ROWTYPE_ADD; // Render add
			else
				$la_bank_account->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($la_bank_account_list->isGridEdit() && ($la_bank_account->RowType == ROWTYPE_EDIT || $la_bank_account->RowType == ROWTYPE_ADD) && $la_bank_account->EventCancelled) // Update failed
			$la_bank_account_list->restoreCurrentRowFormValues($la_bank_account_list->RowIndex); // Restore form values
		if ($la_bank_account->RowType == ROWTYPE_EDIT) // Edit row
			$la_bank_account_list->EditRowCount++;

		// Set up row id / data-rowindex
		$la_bank_account->RowAttrs->merge(["data-rowindex" => $la_bank_account_list->RowCount, "id" => "r" . $la_bank_account_list->RowCount . "_la_bank_account", "data-rowtype" => $la_bank_account->RowType]);

		// Render row
		$la_bank_account_list->renderRow();

		// Render list options
		$la_bank_account_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($la_bank_account_list->RowAction != "delete" && $la_bank_account_list->RowAction != "insertdelete" && !($la_bank_account_list->RowAction == "insert" && $la_bank_account->isConfirm() && $la_bank_account_list->emptyRow())) {
?>
	<tr <?php echo $la_bank_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_bank_account_list->ListOptions->render("body", "left", $la_bank_account_list->RowCount);
?>
	<?php if ($la_bank_account_list->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode" <?php echo $la_bank_account_list->BankCode->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BankCode" class="form-group">
<?php
$onchange = $la_bank_account_list->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_list->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="sv_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo RemoveHtml($la_bank_account_list->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_list->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_list->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_list->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_list->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_list->RowIndex ?>_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_list->BankCode->ReadOnly || $la_bank_account_list->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_list->BankCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_list->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountlist"], function() {
	fla_bank_accountlist.createAutoSuggest({"id":"x<?php echo $la_bank_account_list->RowIndex ?>_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_list->BankCode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_BankCode") ?>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="o<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="o<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_list->BankCode->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BankCode" class="form-group">
<?php
$onchange = $la_bank_account_list->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_list->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="sv_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo RemoveHtml($la_bank_account_list->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_list->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_list->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_list->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_list->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_list->RowIndex ?>_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_list->BankCode->ReadOnly || $la_bank_account_list->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_list->BankCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_list->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountlist"], function() {
	fla_bank_accountlist.createAutoSuggest({"id":"x<?php echo $la_bank_account_list->RowIndex ?>_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_list->BankCode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_BankCode") ?>
</span>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BankCode">
<span<?php echo $la_bank_account_list->BankCode->viewAttributes() ?>><?php echo $la_bank_account_list->BankCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->BranchCode->Visible) { // BranchCode ?>
		<td data-name="BranchCode" <?php echo $la_bank_account_list->BranchCode->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode"><?php echo EmptyValue(strval($la_bank_account_list->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_list->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_list->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_list->BranchCode->ReadOnly || $la_bank_account_list->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_list->BranchCode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_list->BranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" value="<?php echo $la_bank_account_list->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_list->BranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="o<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" id="o<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_list->BranchCode->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode"><?php echo EmptyValue(strval($la_bank_account_list->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_list->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_list->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_list->BranchCode->ReadOnly || $la_bank_account_list->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_list->BranchCode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_list->BranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" value="<?php echo $la_bank_account_list->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_list->BranchCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BranchCode">
<span<?php echo $la_bank_account_list->BranchCode->viewAttributes() ?>><?php echo $la_bank_account_list->BranchCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName" <?php echo $la_bank_account_list->AccountName->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_AccountName" class="form-group">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_list->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_list->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_list->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_list->AccountName->EditValue ?>"<?php echo $la_bank_account_list->AccountName->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="o<?php echo $la_bank_account_list->RowIndex ?>_AccountName" id="o<?php echo $la_bank_account_list->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_list->AccountName->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_AccountName" class="form-group">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_list->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_list->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_list->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_list->AccountName->EditValue ?>"<?php echo $la_bank_account_list->AccountName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_AccountName">
<span<?php echo $la_bank_account_list->AccountName->viewAttributes() ?>><?php echo $la_bank_account_list->AccountName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $la_bank_account_list->BankAccountNo->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BankAccountNo" class="form-group">
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_list->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_list->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" id="o<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_list->BankAccountNo->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_list->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_list->BankAccountNo->editAttributes() ?>>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" id="o<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_list->BankAccountNo->OldValue != null ? $la_bank_account_list->BankAccountNo->OldValue : $la_bank_account_list->BankAccountNo->CurrentValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_BankAccountNo">
<span<?php echo $la_bank_account_list->BankAccountNo->viewAttributes() ?>><?php echo $la_bank_account_list->BankAccountNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $la_bank_account_list->LACode->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($la_bank_account_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_LACode" class="form-group">
<span<?php echo $la_bank_account_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" name="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_LACode" class="form-group">
<?php
$onchange = $la_bank_account_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="sv_x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($la_bank_account_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_list->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountlist"], function() {
	fla_bank_accountlist.createAutoSuggest({"id":"x<?php echo $la_bank_account_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_list->LACode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="o<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="o<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($la_bank_account_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_LACode" class="form-group">
<span<?php echo $la_bank_account_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" name="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_LACode" class="form-group">
<?php
$onchange = $la_bank_account_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="sv_x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($la_bank_account_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_list->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountlist"], function() {
	fla_bank_accountlist.createAutoSuggest({"id":"x<?php echo $la_bank_account_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_list->LACode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_list->RowCount ?>_la_bank_account_LACode">
<span<?php echo $la_bank_account_list->LACode->viewAttributes() ?>><?php echo $la_bank_account_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_bank_account_list->ListOptions->render("body", "right", $la_bank_account_list->RowCount);
?>
	</tr>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD || $la_bank_account->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fla_bank_accountlist", "load"], function() {
	fla_bank_accountlist.updateLists(<?php echo $la_bank_account_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$la_bank_account_list->isGridAdd())
		if (!$la_bank_account_list->Recordset->EOF)
			$la_bank_account_list->Recordset->moveNext();
}
?>
<?php
	if ($la_bank_account_list->isGridAdd() || $la_bank_account_list->isGridEdit()) {
		$la_bank_account_list->RowIndex = '$rowindex$';
		$la_bank_account_list->loadRowValues();

		// Set row properties
		$la_bank_account->resetAttributes();
		$la_bank_account->RowAttrs->merge(["data-rowindex" => $la_bank_account_list->RowIndex, "id" => "r0_la_bank_account", "data-rowtype" => ROWTYPE_ADD]);
		$la_bank_account->RowAttrs->appendClass("ew-template");
		$la_bank_account->RowType = ROWTYPE_ADD;

		// Render row
		$la_bank_account_list->renderRow();

		// Render list options
		$la_bank_account_list->renderListOptions();
		$la_bank_account_list->StartRowCount = 0;
?>
	<tr <?php echo $la_bank_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_bank_account_list->ListOptions->render("body", "left", $la_bank_account_list->RowIndex);
?>
	<?php if ($la_bank_account_list->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode">
<span id="el$rowindex$_la_bank_account_BankCode" class="form-group la_bank_account_BankCode">
<?php
$onchange = $la_bank_account_list->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_list->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="sv_x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo RemoveHtml($la_bank_account_list->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_list->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_list->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_list->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_list->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_list->RowIndex ?>_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_list->BankCode->ReadOnly || $la_bank_account_list->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_list->BankCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_list->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountlist"], function() {
	fla_bank_accountlist.createAutoSuggest({"id":"x<?php echo $la_bank_account_list->RowIndex ?>_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_list->BankCode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_BankCode") ?>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="o<?php echo $la_bank_account_list->RowIndex ?>_BankCode" id="o<?php echo $la_bank_account_list->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_list->BankCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->BranchCode->Visible) { // BranchCode ?>
		<td data-name="BranchCode">
<span id="el$rowindex$_la_bank_account_BranchCode" class="form-group la_bank_account_BranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode"><?php echo EmptyValue(strval($la_bank_account_list->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_list->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_list->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_list->BranchCode->ReadOnly || $la_bank_account_list->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_list->BranchCode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_list->BranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" value="<?php echo $la_bank_account_list->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_list->BranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="o<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" id="o<?php echo $la_bank_account_list->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_list->BranchCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName">
<span id="el$rowindex$_la_bank_account_AccountName" class="form-group la_bank_account_AccountName">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_list->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_list->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_list->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_list->AccountName->EditValue ?>"<?php echo $la_bank_account_list->AccountName->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="o<?php echo $la_bank_account_list->RowIndex ?>_AccountName" id="o<?php echo $la_bank_account_list->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_list->AccountName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo">
<span id="el$rowindex$_la_bank_account_BankAccountNo" class="form-group la_bank_account_BankAccountNo">
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_list->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_list->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" id="o<?php echo $la_bank_account_list->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_list->BankAccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($la_bank_account_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_la_bank_account_LACode" class="form-group la_bank_account_LACode">
<span<?php echo $la_bank_account_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" name="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_la_bank_account_LACode" class="form-group la_bank_account_LACode">
<?php
$onchange = $la_bank_account_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="sv_x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($la_bank_account_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_list->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountlist"], function() {
	fla_bank_accountlist.createAutoSuggest({"id":"x<?php echo $la_bank_account_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_list->LACode->Lookup->getParamTag($la_bank_account_list, "p_x" . $la_bank_account_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="o<?php echo $la_bank_account_list->RowIndex ?>_LACode" id="o<?php echo $la_bank_account_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_bank_account_list->ListOptions->render("body", "right", $la_bank_account_list->RowIndex);
?>
<script>
loadjs.ready(["fla_bank_accountlist", "load"], function() {
	fla_bank_accountlist.updateLists(<?php echo $la_bank_account_list->RowIndex ?>);
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
<?php if ($la_bank_account_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $la_bank_account_list->FormKeyCountName ?>" id="<?php echo $la_bank_account_list->FormKeyCountName ?>" value="<?php echo $la_bank_account_list->KeyCount ?>">
<?php echo $la_bank_account_list->MultiSelectKey ?>
<?php } ?>
<?php if ($la_bank_account_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $la_bank_account_list->FormKeyCountName ?>" id="<?php echo $la_bank_account_list->FormKeyCountName ?>" value="<?php echo $la_bank_account_list->KeyCount ?>">
<?php echo $la_bank_account_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$la_bank_account->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($la_bank_account_list->Recordset)
	$la_bank_account_list->Recordset->Close();
?>
<?php if (!$la_bank_account_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$la_bank_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_bank_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $la_bank_account_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($la_bank_account_list->TotalRecords == 0 && !$la_bank_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $la_bank_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$la_bank_account_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$la_bank_account_list->isExport()) { ?>
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
$la_bank_account_list->terminate();
?>