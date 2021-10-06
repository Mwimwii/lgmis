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
$_account_ref_master_list = new _account_ref_master_list();

// Run the page
$_account_ref_master_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_account_ref_master_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_account_ref_master_list->isExport()) { ?>
<script>
var f_account_ref_masterlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_account_ref_masterlist = currentForm = new ew.Form("f_account_ref_masterlist", "list");
	f_account_ref_masterlist.formKeyCountName = '<?php echo $_account_ref_master_list->FormKeyCountName ?>';

	// Validate form
	f_account_ref_masterlist.validate = function() {
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
			<?php if ($_account_ref_master_list->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_list->AccountCode->caption(), $_account_ref_master_list->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_account_ref_master_list->AccountName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_list->AccountName->caption(), $_account_ref_master_list->AccountName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_account_ref_master_list->AccountGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_list->AccountGroupCode->caption(), $_account_ref_master_list->AccountGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_list->AccountGroupCode->errorMessage()) ?>");
			<?php if ($_account_ref_master_list->AccountDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_list->AccountDesc->caption(), $_account_ref_master_list->AccountDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_account_ref_master_list->Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_list->Amount->caption(), $_account_ref_master_list->Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_list->Amount->errorMessage()) ?>");
			<?php if ($_account_ref_master_list->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_list->AccountType->caption(), $_account_ref_master_list->AccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_list->AccountType->errorMessage()) ?>");
			<?php if ($_account_ref_master_list->AccountSubGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountSubGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_list->AccountSubGroupCode->caption(), $_account_ref_master_list->AccountSubGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountSubGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_list->AccountSubGroupCode->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	f_account_ref_masterlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_account_ref_masterlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_account_ref_masterlist.lists["x_AccountGroupCode"] = <?php echo $_account_ref_master_list->AccountGroupCode->Lookup->toClientList($_account_ref_master_list) ?>;
	f_account_ref_masterlist.lists["x_AccountGroupCode"].options = <?php echo JsonEncode($_account_ref_master_list->AccountGroupCode->lookupOptions()) ?>;
	f_account_ref_masterlist.autoSuggests["x_AccountGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_account_ref_masterlist.lists["x_AccountType"] = <?php echo $_account_ref_master_list->AccountType->Lookup->toClientList($_account_ref_master_list) ?>;
	f_account_ref_masterlist.lists["x_AccountType"].options = <?php echo JsonEncode($_account_ref_master_list->AccountType->lookupOptions()) ?>;
	f_account_ref_masterlist.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_account_ref_masterlist.lists["x_AccountSubGroupCode"] = <?php echo $_account_ref_master_list->AccountSubGroupCode->Lookup->toClientList($_account_ref_master_list) ?>;
	f_account_ref_masterlist.lists["x_AccountSubGroupCode"].options = <?php echo JsonEncode($_account_ref_master_list->AccountSubGroupCode->lookupOptions()) ?>;
	f_account_ref_masterlist.autoSuggests["x_AccountSubGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("f_account_ref_masterlist");
});
var f_account_ref_masterlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_account_ref_masterlistsrch = currentSearchForm = new ew.Form("f_account_ref_masterlistsrch");

	// Dynamic selection lists
	// Filters

	f_account_ref_masterlistsrch.filterList = <?php echo $_account_ref_master_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_account_ref_masterlistsrch.initSearchPanel = true;
	loadjs.done("f_account_ref_masterlistsrch");
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
<?php if (!$_account_ref_master_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_account_ref_master_list->TotalRecords > 0 && $_account_ref_master_list->ExportOptions->visible()) { ?>
<?php $_account_ref_master_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_account_ref_master_list->ImportOptions->visible()) { ?>
<?php $_account_ref_master_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_account_ref_master_list->SearchOptions->visible()) { ?>
<?php $_account_ref_master_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_account_ref_master_list->FilterOptions->visible()) { ?>
<?php $_account_ref_master_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$_account_ref_master_list->isExport() || Config("EXPORT_MASTER_RECORD") && $_account_ref_master_list->isExport("print")) { ?>
<?php
if ($_account_ref_master_list->DbMasterFilter != "" && $_account_ref_master->getCurrentMasterTable() == "account_sub_group") {
	if ($_account_ref_master_list->MasterRecordExists) {
		include_once "account_sub_groupmaster.php";
	}
}
?>
<?php } ?>
<?php
$_account_ref_master_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_account_ref_master_list->isExport() && !$_account_ref_master->CurrentAction) { ?>
<form name="f_account_ref_masterlistsrch" id="f_account_ref_masterlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_account_ref_masterlistsrch-search-panel" class="<?php echo $_account_ref_master_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_account_ref_master">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_account_ref_master_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_account_ref_master_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_account_ref_master_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_account_ref_master_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_account_ref_master_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_account_ref_master_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_account_ref_master_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_account_ref_master_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_account_ref_master_list->showPageHeader(); ?>
<?php
$_account_ref_master_list->showMessage();
?>
<?php if ($_account_ref_master_list->TotalRecords > 0 || $_account_ref_master->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_account_ref_master_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _account_ref_master">
<?php if (!$_account_ref_master_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_account_ref_master_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_account_ref_master_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_account_ref_master_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_account_ref_masterlist" id="f_account_ref_masterlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_account_ref_master">
<?php if ($_account_ref_master->getCurrentMasterTable() == "account_sub_group" && $_account_ref_master->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="account_sub_group">
<input type="hidden" name="fk_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->getSessionValue()) ?>">
<input type="hidden" name="fk_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->getSessionValue()) ?>">
<input type="hidden" name="fk_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp__account_ref_master" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_account_ref_master_list->TotalRecords > 0 || $_account_ref_master_list->isGridEdit()) { ?>
<table id="tbl__account_ref_masterlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_account_ref_master->RowType = ROWTYPE_HEADER;

// Render list options
$_account_ref_master_list->renderListOptions();

// Render list options (header, left)
$_account_ref_master_list->ListOptions->render("header", "left");
?>
<?php if ($_account_ref_master_list->AccountCode->Visible) { // AccountCode ?>
	<?php if ($_account_ref_master_list->SortUrl($_account_ref_master_list->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $_account_ref_master_list->AccountCode->headerCellClass() ?>"><div id="elh__account_ref_master_AccountCode" class="_account_ref_master_AccountCode"><div class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $_account_ref_master_list->AccountCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_account_ref_master_list->SortUrl($_account_ref_master_list->AccountCode) ?>', 1);"><div id="elh__account_ref_master_AccountCode" class="_account_ref_master_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_list->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_list->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_list->AccountName->Visible) { // AccountName ?>
	<?php if ($_account_ref_master_list->SortUrl($_account_ref_master_list->AccountName) == "") { ?>
		<th data-name="AccountName" class="<?php echo $_account_ref_master_list->AccountName->headerCellClass() ?>"><div id="elh__account_ref_master_AccountName" class="_account_ref_master_AccountName"><div class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountName" class="<?php echo $_account_ref_master_list->AccountName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_account_ref_master_list->SortUrl($_account_ref_master_list->AccountName) ?>', 1);"><div id="elh__account_ref_master_AccountName" class="_account_ref_master_AccountName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_list->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_list->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($_account_ref_master_list->SortUrl($_account_ref_master_list->AccountGroupCode) == "") { ?>
		<th data-name="AccountGroupCode" class="<?php echo $_account_ref_master_list->AccountGroupCode->headerCellClass() ?>"><div id="elh__account_ref_master_AccountGroupCode" class="_account_ref_master_AccountGroupCode"><div class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupCode" class="<?php echo $_account_ref_master_list->AccountGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_account_ref_master_list->SortUrl($_account_ref_master_list->AccountGroupCode) ?>', 1);"><div id="elh__account_ref_master_AccountGroupCode" class="_account_ref_master_AccountGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_list->AccountGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_list->AccountGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_list->AccountDesc->Visible) { // AccountDesc ?>
	<?php if ($_account_ref_master_list->SortUrl($_account_ref_master_list->AccountDesc) == "") { ?>
		<th data-name="AccountDesc" class="<?php echo $_account_ref_master_list->AccountDesc->headerCellClass() ?>"><div id="elh__account_ref_master_AccountDesc" class="_account_ref_master_AccountDesc"><div class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountDesc" class="<?php echo $_account_ref_master_list->AccountDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_account_ref_master_list->SortUrl($_account_ref_master_list->AccountDesc) ?>', 1);"><div id="elh__account_ref_master_AccountDesc" class="_account_ref_master_AccountDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_list->AccountDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_list->AccountDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_list->Amount->Visible) { // Amount ?>
	<?php if ($_account_ref_master_list->SortUrl($_account_ref_master_list->Amount) == "") { ?>
		<th data-name="Amount" class="<?php echo $_account_ref_master_list->Amount->headerCellClass() ?>"><div id="elh__account_ref_master_Amount" class="_account_ref_master_Amount"><div class="ew-table-header-caption"><?php echo $_account_ref_master_list->Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Amount" class="<?php echo $_account_ref_master_list->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_account_ref_master_list->SortUrl($_account_ref_master_list->Amount) ?>', 1);"><div id="elh__account_ref_master_Amount" class="_account_ref_master_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_list->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_list->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_list->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_list->AccountType->Visible) { // AccountType ?>
	<?php if ($_account_ref_master_list->SortUrl($_account_ref_master_list->AccountType) == "") { ?>
		<th data-name="AccountType" class="<?php echo $_account_ref_master_list->AccountType->headerCellClass() ?>"><div id="elh__account_ref_master_AccountType" class="_account_ref_master_AccountType"><div class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountType" class="<?php echo $_account_ref_master_list->AccountType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_account_ref_master_list->SortUrl($_account_ref_master_list->AccountType) ?>', 1);"><div id="elh__account_ref_master_AccountType" class="_account_ref_master_AccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_list->AccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_list->AccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_list->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<?php if ($_account_ref_master_list->SortUrl($_account_ref_master_list->AccountSubGroupCode) == "") { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $_account_ref_master_list->AccountSubGroupCode->headerCellClass() ?>"><div id="elh__account_ref_master_AccountSubGroupCode" class="_account_ref_master_AccountSubGroupCode"><div class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountSubGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $_account_ref_master_list->AccountSubGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_account_ref_master_list->SortUrl($_account_ref_master_list->AccountSubGroupCode) ?>', 1);"><div id="elh__account_ref_master_AccountSubGroupCode" class="_account_ref_master_AccountSubGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_list->AccountSubGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_list->AccountSubGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_list->AccountSubGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_account_ref_master_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_account_ref_master_list->ExportAll && $_account_ref_master_list->isExport()) {
	$_account_ref_master_list->StopRecord = $_account_ref_master_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_account_ref_master_list->TotalRecords > $_account_ref_master_list->StartRecord + $_account_ref_master_list->DisplayRecords - 1)
		$_account_ref_master_list->StopRecord = $_account_ref_master_list->StartRecord + $_account_ref_master_list->DisplayRecords - 1;
	else
		$_account_ref_master_list->StopRecord = $_account_ref_master_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($_account_ref_master->isConfirm() || $_account_ref_master_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($_account_ref_master_list->FormKeyCountName) && ($_account_ref_master_list->isGridAdd() || $_account_ref_master_list->isGridEdit() || $_account_ref_master->isConfirm())) {
		$_account_ref_master_list->KeyCount = $CurrentForm->getValue($_account_ref_master_list->FormKeyCountName);
		$_account_ref_master_list->StopRecord = $_account_ref_master_list->StartRecord + $_account_ref_master_list->KeyCount - 1;
	}
}
$_account_ref_master_list->RecordCount = $_account_ref_master_list->StartRecord - 1;
if ($_account_ref_master_list->Recordset && !$_account_ref_master_list->Recordset->EOF) {
	$_account_ref_master_list->Recordset->moveFirst();
	$selectLimit = $_account_ref_master_list->UseSelectLimit;
	if (!$selectLimit && $_account_ref_master_list->StartRecord > 1)
		$_account_ref_master_list->Recordset->move($_account_ref_master_list->StartRecord - 1);
} elseif (!$_account_ref_master->AllowAddDeleteRow && $_account_ref_master_list->StopRecord == 0) {
	$_account_ref_master_list->StopRecord = $_account_ref_master->GridAddRowCount;
}

// Initialize aggregate
$_account_ref_master->RowType = ROWTYPE_AGGREGATEINIT;
$_account_ref_master->resetAttributes();
$_account_ref_master_list->renderRow();
$_account_ref_master_list->EditRowCount = 0;
if ($_account_ref_master_list->isEdit())
	$_account_ref_master_list->RowIndex = 1;
if ($_account_ref_master_list->isGridEdit())
	$_account_ref_master_list->RowIndex = 0;
while ($_account_ref_master_list->RecordCount < $_account_ref_master_list->StopRecord) {
	$_account_ref_master_list->RecordCount++;
	if ($_account_ref_master_list->RecordCount >= $_account_ref_master_list->StartRecord) {
		$_account_ref_master_list->RowCount++;
		if ($_account_ref_master_list->isGridAdd() || $_account_ref_master_list->isGridEdit() || $_account_ref_master->isConfirm()) {
			$_account_ref_master_list->RowIndex++;
			$CurrentForm->Index = $_account_ref_master_list->RowIndex;
			if ($CurrentForm->hasValue($_account_ref_master_list->FormActionName) && ($_account_ref_master->isConfirm() || $_account_ref_master_list->EventCancelled))
				$_account_ref_master_list->RowAction = strval($CurrentForm->getValue($_account_ref_master_list->FormActionName));
			elseif ($_account_ref_master_list->isGridAdd())
				$_account_ref_master_list->RowAction = "insert";
			else
				$_account_ref_master_list->RowAction = "";
		}

		// Set up key count
		$_account_ref_master_list->KeyCount = $_account_ref_master_list->RowIndex;

		// Init row class and style
		$_account_ref_master->resetAttributes();
		$_account_ref_master->CssClass = "";
		if ($_account_ref_master_list->isGridAdd()) {
			$_account_ref_master_list->loadRowValues(); // Load default values
		} else {
			$_account_ref_master_list->loadRowValues($_account_ref_master_list->Recordset); // Load row values
		}
		$_account_ref_master->RowType = ROWTYPE_VIEW; // Render view
		if ($_account_ref_master_list->isEdit()) {
			if ($_account_ref_master_list->checkInlineEditKey() && $_account_ref_master_list->EditRowCount == 0) { // Inline edit
				$_account_ref_master->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($_account_ref_master_list->isGridEdit()) { // Grid edit
			if ($_account_ref_master->EventCancelled)
				$_account_ref_master_list->restoreCurrentRowFormValues($_account_ref_master_list->RowIndex); // Restore form values
			if ($_account_ref_master_list->RowAction == "insert")
				$_account_ref_master->RowType = ROWTYPE_ADD; // Render add
			else
				$_account_ref_master->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($_account_ref_master_list->isEdit() && $_account_ref_master->RowType == ROWTYPE_EDIT && $_account_ref_master->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$_account_ref_master_list->restoreFormValues(); // Restore form values
		}
		if ($_account_ref_master_list->isGridEdit() && ($_account_ref_master->RowType == ROWTYPE_EDIT || $_account_ref_master->RowType == ROWTYPE_ADD) && $_account_ref_master->EventCancelled) // Update failed
			$_account_ref_master_list->restoreCurrentRowFormValues($_account_ref_master_list->RowIndex); // Restore form values
		if ($_account_ref_master->RowType == ROWTYPE_EDIT) // Edit row
			$_account_ref_master_list->EditRowCount++;

		// Set up row id / data-rowindex
		$_account_ref_master->RowAttrs->merge(["data-rowindex" => $_account_ref_master_list->RowCount, "id" => "r" . $_account_ref_master_list->RowCount . "__account_ref_master", "data-rowtype" => $_account_ref_master->RowType]);

		// Render row
		$_account_ref_master_list->renderRow();

		// Render list options
		$_account_ref_master_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($_account_ref_master_list->RowAction != "delete" && $_account_ref_master_list->RowAction != "insertdelete" && !($_account_ref_master_list->RowAction == "insert" && $_account_ref_master->isConfirm() && $_account_ref_master_list->emptyRow())) {
?>
	<tr <?php echo $_account_ref_master->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_account_ref_master_list->ListOptions->render("body", "left", $_account_ref_master_list->RowCount);
?>
	<?php if ($_account_ref_master_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $_account_ref_master_list->AccountCode->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountCode" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountCode->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountCode->EditValue ?>"<?php echo $_account_ref_master_list->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountCode->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountCode->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountCode->EditValue ?>"<?php echo $_account_ref_master_list->AccountCode->editAttributes() ?>>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountCode->OldValue != null ? $_account_ref_master_list->AccountCode->OldValue : $_account_ref_master_list->AccountCode->CurrentValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountCode">
<span<?php echo $_account_ref_master_list->AccountCode->viewAttributes() ?>><?php echo $_account_ref_master_list->AccountCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName" <?php echo $_account_ref_master_list->AccountName->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountName" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountName->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountName->EditValue ?>"<?php echo $_account_ref_master_list->AccountName->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_list->AccountName->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountName" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountName->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountName->EditValue ?>"<?php echo $_account_ref_master_list->AccountName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountName">
<span<?php echo $_account_ref_master_list->AccountName->viewAttributes() ?>><?php echo $_account_ref_master_list->AccountName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode" <?php echo $_account_ref_master_list->AccountGroupCode->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_account_ref_master_list->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<span<?php echo $_account_ref_master_list->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_list->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($_account_ref_master_list->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountGroupCode->ReadOnly || $_account_ref_master_list->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountGroupCode->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_account_ref_master_list->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<span<?php echo $_account_ref_master_list->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_list->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($_account_ref_master_list->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountGroupCode->ReadOnly || $_account_ref_master_list->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountGroupCode->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountGroupCode">
<span<?php echo $_account_ref_master_list->AccountGroupCode->viewAttributes() ?>><?php echo $_account_ref_master_list->AccountGroupCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountDesc->Visible) { // AccountDesc ?>
		<td data-name="AccountDesc" <?php echo $_account_ref_master_list->AccountDesc->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountDesc" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountDesc->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountDesc->EditValue ?>"<?php echo $_account_ref_master_list->AccountDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_list->AccountDesc->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountDesc" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountDesc->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountDesc->EditValue ?>"<?php echo $_account_ref_master_list->AccountDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountDesc">
<span<?php echo $_account_ref_master_list->AccountDesc->viewAttributes() ?>><?php echo $_account_ref_master_list->AccountDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->Amount->Visible) { // Amount ?>
		<td data-name="Amount" <?php echo $_account_ref_master_list->Amount->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_Amount" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_list->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_list->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->Amount->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->Amount->EditValue ?>"<?php echo $_account_ref_master_list->Amount->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="o<?php echo $_account_ref_master_list->RowIndex ?>_Amount" id="o<?php echo $_account_ref_master_list->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_list->Amount->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_Amount" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_list->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_list->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->Amount->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->Amount->EditValue ?>"<?php echo $_account_ref_master_list->Amount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_Amount">
<span<?php echo $_account_ref_master_list->Amount->viewAttributes() ?>><?php echo $_account_ref_master_list->Amount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType" <?php echo $_account_ref_master_list->AccountType->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_account_ref_master_list->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountType" class="form-group">
<span<?php echo $_account_ref_master_list->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountType" class="form-group">
<?php
$onchange = $_account_ref_master_list->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($_account_ref_master_list->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountType->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountType->ReadOnly || $_account_ref_master_list->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountType->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_account_ref_master_list->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountType" class="form-group">
<span<?php echo $_account_ref_master_list->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountType" class="form-group">
<?php
$onchange = $_account_ref_master_list->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($_account_ref_master_list->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountType->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountType->ReadOnly || $_account_ref_master_list->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountType->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountType">
<span<?php echo $_account_ref_master_list->AccountType->viewAttributes() ?>><?php echo $_account_ref_master_list->AccountType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<td data-name="AccountSubGroupCode" <?php echo $_account_ref_master_list->AccountSubGroupCode->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_account_ref_master_list->AccountSubGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<span<?php echo $_account_ref_master_list->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_list->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($_account_ref_master_list->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountSubGroupCode->ReadOnly || $_account_ref_master_list->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountSubGroupCode->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_account_ref_master_list->AccountSubGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<span<?php echo $_account_ref_master_list->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_list->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($_account_ref_master_list->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountSubGroupCode->ReadOnly || $_account_ref_master_list->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountSubGroupCode->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_list->RowCount ?>__account_ref_master_AccountSubGroupCode">
<span<?php echo $_account_ref_master_list->AccountSubGroupCode->viewAttributes() ?>><?php echo $_account_ref_master_list->AccountSubGroupCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_account_ref_master_list->ListOptions->render("body", "right", $_account_ref_master_list->RowCount);
?>
	</tr>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD || $_account_ref_master->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["f_account_ref_masterlist", "load"], function() {
	f_account_ref_masterlist.updateLists(<?php echo $_account_ref_master_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$_account_ref_master_list->isGridAdd())
		if (!$_account_ref_master_list->Recordset->EOF)
			$_account_ref_master_list->Recordset->moveNext();
}
?>
<?php
	if ($_account_ref_master_list->isGridAdd() || $_account_ref_master_list->isGridEdit()) {
		$_account_ref_master_list->RowIndex = '$rowindex$';
		$_account_ref_master_list->loadRowValues();

		// Set row properties
		$_account_ref_master->resetAttributes();
		$_account_ref_master->RowAttrs->merge(["data-rowindex" => $_account_ref_master_list->RowIndex, "id" => "r0__account_ref_master", "data-rowtype" => ROWTYPE_ADD]);
		$_account_ref_master->RowAttrs->appendClass("ew-template");
		$_account_ref_master->RowType = ROWTYPE_ADD;

		// Render row
		$_account_ref_master_list->renderRow();

		// Render list options
		$_account_ref_master_list->renderListOptions();
		$_account_ref_master_list->StartRowCount = 0;
?>
	<tr <?php echo $_account_ref_master->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_account_ref_master_list->ListOptions->render("body", "left", $_account_ref_master_list->RowIndex);
?>
	<?php if ($_account_ref_master_list->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode">
<span id="el$rowindex$__account_ref_master_AccountCode" class="form-group _account_ref_master_AccountCode">
<input type="text" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountCode->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountCode->EditValue ?>"<?php echo $_account_ref_master_list->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName">
<span id="el$rowindex$__account_ref_master_AccountName" class="form-group _account_ref_master_AccountName">
<input type="text" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountName->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountName->EditValue ?>"<?php echo $_account_ref_master_list->AccountName->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_list->AccountName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode">
<?php if ($_account_ref_master_list->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__account_ref_master_AccountGroupCode" class="form-group _account_ref_master_AccountGroupCode">
<span<?php echo $_account_ref_master_list->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountGroupCode" class="form-group _account_ref_master_AccountGroupCode">
<?php
$onchange = $_account_ref_master_list->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($_account_ref_master_list->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountGroupCode->ReadOnly || $_account_ref_master_list->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountGroupCode->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountDesc->Visible) { // AccountDesc ?>
		<td data-name="AccountDesc">
<span id="el$rowindex$__account_ref_master_AccountDesc" class="form-group _account_ref_master_AccountDesc">
<input type="text" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountDesc->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->AccountDesc->EditValue ?>"<?php echo $_account_ref_master_list->AccountDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_list->AccountDesc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->Amount->Visible) { // Amount ?>
		<td data-name="Amount">
<span id="el$rowindex$__account_ref_master_Amount" class="form-group _account_ref_master_Amount">
<input type="text" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_list->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_list->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->Amount->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_list->Amount->EditValue ?>"<?php echo $_account_ref_master_list->Amount->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="o<?php echo $_account_ref_master_list->RowIndex ?>_Amount" id="o<?php echo $_account_ref_master_list->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_list->Amount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType">
<?php if ($_account_ref_master_list->AccountType->getSessionValue() != "") { ?>
<span id="el$rowindex$__account_ref_master_AccountType" class="form-group _account_ref_master_AccountType">
<span<?php echo $_account_ref_master_list->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountType" class="form-group _account_ref_master_AccountType">
<?php
$onchange = $_account_ref_master_list->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($_account_ref_master_list->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountType->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountType->ReadOnly || $_account_ref_master_list->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountType->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_list->AccountType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_list->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<td data-name="AccountSubGroupCode">
<?php if ($_account_ref_master_list->AccountSubGroupCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__account_ref_master_AccountSubGroupCode" class="form-group _account_ref_master_AccountSubGroupCode">
<span<?php echo $_account_ref_master_list->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_list->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountSubGroupCode" class="form-group _account_ref_master_AccountSubGroupCode">
<?php
$onchange = $_account_ref_master_list->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_list->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($_account_ref_master_list->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_list->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_list->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_list->AccountSubGroupCode->ReadOnly || $_account_ref_master_list->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_list->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_masterlist"], function() {
	f_account_ref_masterlist.createAutoSuggest({"id":"x<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_list->AccountSubGroupCode->Lookup->getParamTag($_account_ref_master_list, "p_x" . $_account_ref_master_list->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $_account_ref_master_list->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_list->AccountSubGroupCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_account_ref_master_list->ListOptions->render("body", "right", $_account_ref_master_list->RowIndex);
?>
<script>
loadjs.ready(["f_account_ref_masterlist", "load"], function() {
	f_account_ref_masterlist.updateLists(<?php echo $_account_ref_master_list->RowIndex ?>);
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
<?php if ($_account_ref_master_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $_account_ref_master_list->FormKeyCountName ?>" id="<?php echo $_account_ref_master_list->FormKeyCountName ?>" value="<?php echo $_account_ref_master_list->KeyCount ?>">
<?php } ?>
<?php if ($_account_ref_master_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $_account_ref_master_list->FormKeyCountName ?>" id="<?php echo $_account_ref_master_list->FormKeyCountName ?>" value="<?php echo $_account_ref_master_list->KeyCount ?>">
<?php echo $_account_ref_master_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$_account_ref_master->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_account_ref_master_list->Recordset)
	$_account_ref_master_list->Recordset->Close();
?>
<?php if (!$_account_ref_master_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_account_ref_master_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_account_ref_master_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_account_ref_master_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_account_ref_master_list->TotalRecords == 0 && !$_account_ref_master->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_account_ref_master_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_account_ref_master_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_account_ref_master_list->isExport()) { ?>
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
$_account_ref_master_list->terminate();
?>