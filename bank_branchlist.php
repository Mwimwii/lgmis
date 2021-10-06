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
$bank_branch_list = new bank_branch_list();

// Run the page
$bank_branch_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_branch_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bank_branch_list->isExport()) { ?>
<script>
var fbank_branchlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbank_branchlist = currentForm = new ew.Form("fbank_branchlist", "list");
	fbank_branchlist.formKeyCountName = '<?php echo $bank_branch_list->FormKeyCountName ?>';
	loadjs.done("fbank_branchlist");
});
var fbank_branchlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbank_branchlistsrch = currentSearchForm = new ew.Form("fbank_branchlistsrch");

	// Dynamic selection lists
	// Filters

	fbank_branchlistsrch.filterList = <?php echo $bank_branch_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbank_branchlistsrch.initSearchPanel = true;
	loadjs.done("fbank_branchlistsrch");
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
<?php if (!$bank_branch_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bank_branch_list->TotalRecords > 0 && $bank_branch_list->ExportOptions->visible()) { ?>
<?php $bank_branch_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bank_branch_list->ImportOptions->visible()) { ?>
<?php $bank_branch_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bank_branch_list->SearchOptions->visible()) { ?>
<?php $bank_branch_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bank_branch_list->FilterOptions->visible()) { ?>
<?php $bank_branch_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$bank_branch_list->isExport() || Config("EXPORT_MASTER_RECORD") && $bank_branch_list->isExport("print")) { ?>
<?php
if ($bank_branch_list->DbMasterFilter != "" && $bank_branch->getCurrentMasterTable() == "bank") {
	if ($bank_branch_list->MasterRecordExists) {
		include_once "bankmaster.php";
	}
}
?>
<?php } ?>
<?php
$bank_branch_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bank_branch_list->isExport() && !$bank_branch->CurrentAction) { ?>
<form name="fbank_branchlistsrch" id="fbank_branchlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbank_branchlistsrch-search-panel" class="<?php echo $bank_branch_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bank_branch">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $bank_branch_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bank_branch_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bank_branch_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bank_branch_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bank_branch_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bank_branch_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bank_branch_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bank_branch_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $bank_branch_list->showPageHeader(); ?>
<?php
$bank_branch_list->showMessage();
?>
<?php if ($bank_branch_list->TotalRecords > 0 || $bank_branch->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bank_branch_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bank_branch">
<?php if (!$bank_branch_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bank_branch_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bank_branch_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bank_branch_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbank_branchlist" id="fbank_branchlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank_branch">
<?php if ($bank_branch->getCurrentMasterTable() == "bank" && $bank_branch->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="bank">
<input type="hidden" name="fk_BankCode" value="<?php echo HtmlEncode($bank_branch_list->BankCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_bank_branch" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bank_branch_list->TotalRecords > 0 || $bank_branch_list->isGridEdit()) { ?>
<table id="tbl_bank_branchlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bank_branch->RowType = ROWTYPE_HEADER;

// Render list options
$bank_branch_list->renderListOptions();

// Render list options (header, left)
$bank_branch_list->ListOptions->render("header", "left");
?>
<?php if ($bank_branch_list->BranchCode->Visible) { // BranchCode ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BranchCode) == "") { ?>
		<th data-name="BranchCode" class="<?php echo $bank_branch_list->BranchCode->headerCellClass() ?>"><div id="elh_bank_branch_BranchCode" class="bank_branch_BranchCode"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchCode" class="<?php echo $bank_branch_list->BranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BranchCode) ?>', 1);"><div id="elh_bank_branch_BranchCode" class="bank_branch_BranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BranchCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->BranchName->Visible) { // BranchName ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BranchName) == "") { ?>
		<th data-name="BranchName" class="<?php echo $bank_branch_list->BranchName->headerCellClass() ?>"><div id="elh_bank_branch_BranchName" class="bank_branch_BranchName"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BranchName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchName" class="<?php echo $bank_branch_list->BranchName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BranchName) ?>', 1);"><div id="elh_bank_branch_BranchName" class="bank_branch_BranchName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BranchName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BranchName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BranchName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->BankCode->Visible) { // BankCode ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BankCode) == "") { ?>
		<th data-name="BankCode" class="<?php echo $bank_branch_list->BankCode->headerCellClass() ?>"><div id="elh_bank_branch_BankCode" class="bank_branch_BankCode"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BankCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankCode" class="<?php echo $bank_branch_list->BankCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BankCode) ?>', 1);"><div id="elh_bank_branch_BankCode" class="bank_branch_BankCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BankCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BankCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BankCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->AreaCode->Visible) { // AreaCode ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->AreaCode) == "") { ?>
		<th data-name="AreaCode" class="<?php echo $bank_branch_list->AreaCode->headerCellClass() ?>"><div id="elh_bank_branch_AreaCode" class="bank_branch_AreaCode"><div class="ew-table-header-caption"><?php echo $bank_branch_list->AreaCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AreaCode" class="<?php echo $bank_branch_list->AreaCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->AreaCode) ?>', 1);"><div id="elh_bank_branch_AreaCode" class="bank_branch_AreaCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->AreaCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->AreaCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->AreaCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->BranchNo->Visible) { // BranchNo ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BranchNo) == "") { ?>
		<th data-name="BranchNo" class="<?php echo $bank_branch_list->BranchNo->headerCellClass() ?>"><div id="elh_bank_branch_BranchNo" class="bank_branch_BranchNo"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BranchNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchNo" class="<?php echo $bank_branch_list->BranchNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BranchNo) ?>', 1);"><div id="elh_bank_branch_BranchNo" class="bank_branch_BranchNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BranchNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BranchNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BranchNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->BranchAddress->Visible) { // BranchAddress ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BranchAddress) == "") { ?>
		<th data-name="BranchAddress" class="<?php echo $bank_branch_list->BranchAddress->headerCellClass() ?>"><div id="elh_bank_branch_BranchAddress" class="bank_branch_BranchAddress"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BranchAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchAddress" class="<?php echo $bank_branch_list->BranchAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BranchAddress) ?>', 1);"><div id="elh_bank_branch_BranchAddress" class="bank_branch_BranchAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BranchAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BranchAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BranchAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->BranchTel->Visible) { // BranchTel ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BranchTel) == "") { ?>
		<th data-name="BranchTel" class="<?php echo $bank_branch_list->BranchTel->headerCellClass() ?>"><div id="elh_bank_branch_BranchTel" class="bank_branch_BranchTel"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BranchTel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchTel" class="<?php echo $bank_branch_list->BranchTel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BranchTel) ?>', 1);"><div id="elh_bank_branch_BranchTel" class="bank_branch_BranchTel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BranchTel->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BranchTel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BranchTel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->BranchEmail->Visible) { // BranchEmail ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BranchEmail) == "") { ?>
		<th data-name="BranchEmail" class="<?php echo $bank_branch_list->BranchEmail->headerCellClass() ?>"><div id="elh_bank_branch_BranchEmail" class="bank_branch_BranchEmail"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BranchEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchEmail" class="<?php echo $bank_branch_list->BranchEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BranchEmail) ?>', 1);"><div id="elh_bank_branch_BranchEmail" class="bank_branch_BranchEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BranchEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BranchEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BranchEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->BranchFax->Visible) { // BranchFax ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->BranchFax) == "") { ?>
		<th data-name="BranchFax" class="<?php echo $bank_branch_list->BranchFax->headerCellClass() ?>"><div id="elh_bank_branch_BranchFax" class="bank_branch_BranchFax"><div class="ew-table-header-caption"><?php echo $bank_branch_list->BranchFax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchFax" class="<?php echo $bank_branch_list->BranchFax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->BranchFax) ?>', 1);"><div id="elh_bank_branch_BranchFax" class="bank_branch_BranchFax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->BranchFax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->BranchFax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->BranchFax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->SWIFT->Visible) { // SWIFT ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->SWIFT) == "") { ?>
		<th data-name="SWIFT" class="<?php echo $bank_branch_list->SWIFT->headerCellClass() ?>"><div id="elh_bank_branch_SWIFT" class="bank_branch_SWIFT"><div class="ew-table-header-caption"><?php echo $bank_branch_list->SWIFT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SWIFT" class="<?php echo $bank_branch_list->SWIFT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->SWIFT) ?>', 1);"><div id="elh_bank_branch_SWIFT" class="bank_branch_SWIFT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->SWIFT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->SWIFT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->SWIFT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_list->IBAN->Visible) { // IBAN ?>
	<?php if ($bank_branch_list->SortUrl($bank_branch_list->IBAN) == "") { ?>
		<th data-name="IBAN" class="<?php echo $bank_branch_list->IBAN->headerCellClass() ?>"><div id="elh_bank_branch_IBAN" class="bank_branch_IBAN"><div class="ew-table-header-caption"><?php echo $bank_branch_list->IBAN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IBAN" class="<?php echo $bank_branch_list->IBAN->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_branch_list->SortUrl($bank_branch_list->IBAN) ?>', 1);"><div id="elh_bank_branch_IBAN" class="bank_branch_IBAN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_list->IBAN->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_list->IBAN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_list->IBAN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bank_branch_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bank_branch_list->ExportAll && $bank_branch_list->isExport()) {
	$bank_branch_list->StopRecord = $bank_branch_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bank_branch_list->TotalRecords > $bank_branch_list->StartRecord + $bank_branch_list->DisplayRecords - 1)
		$bank_branch_list->StopRecord = $bank_branch_list->StartRecord + $bank_branch_list->DisplayRecords - 1;
	else
		$bank_branch_list->StopRecord = $bank_branch_list->TotalRecords;
}
$bank_branch_list->RecordCount = $bank_branch_list->StartRecord - 1;
if ($bank_branch_list->Recordset && !$bank_branch_list->Recordset->EOF) {
	$bank_branch_list->Recordset->moveFirst();
	$selectLimit = $bank_branch_list->UseSelectLimit;
	if (!$selectLimit && $bank_branch_list->StartRecord > 1)
		$bank_branch_list->Recordset->move($bank_branch_list->StartRecord - 1);
} elseif (!$bank_branch->AllowAddDeleteRow && $bank_branch_list->StopRecord == 0) {
	$bank_branch_list->StopRecord = $bank_branch->GridAddRowCount;
}

// Initialize aggregate
$bank_branch->RowType = ROWTYPE_AGGREGATEINIT;
$bank_branch->resetAttributes();
$bank_branch_list->renderRow();
while ($bank_branch_list->RecordCount < $bank_branch_list->StopRecord) {
	$bank_branch_list->RecordCount++;
	if ($bank_branch_list->RecordCount >= $bank_branch_list->StartRecord) {
		$bank_branch_list->RowCount++;

		// Set up key count
		$bank_branch_list->KeyCount = $bank_branch_list->RowIndex;

		// Init row class and style
		$bank_branch->resetAttributes();
		$bank_branch->CssClass = "";
		if ($bank_branch_list->isGridAdd()) {
		} else {
			$bank_branch_list->loadRowValues($bank_branch_list->Recordset); // Load row values
		}
		$bank_branch->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bank_branch->RowAttrs->merge(["data-rowindex" => $bank_branch_list->RowCount, "id" => "r" . $bank_branch_list->RowCount . "_bank_branch", "data-rowtype" => $bank_branch->RowType]);

		// Render row
		$bank_branch_list->renderRow();

		// Render list options
		$bank_branch_list->renderListOptions();
?>
	<tr <?php echo $bank_branch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bank_branch_list->ListOptions->render("body", "left", $bank_branch_list->RowCount);
?>
	<?php if ($bank_branch_list->BranchCode->Visible) { // BranchCode ?>
		<td data-name="BranchCode" <?php echo $bank_branch_list->BranchCode->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BranchCode">
<span<?php echo $bank_branch_list->BranchCode->viewAttributes() ?>><?php echo $bank_branch_list->BranchCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->BranchName->Visible) { // BranchName ?>
		<td data-name="BranchName" <?php echo $bank_branch_list->BranchName->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BranchName">
<span<?php echo $bank_branch_list->BranchName->viewAttributes() ?>><?php echo $bank_branch_list->BranchName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode" <?php echo $bank_branch_list->BankCode->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BankCode">
<span<?php echo $bank_branch_list->BankCode->viewAttributes() ?>><?php echo $bank_branch_list->BankCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->AreaCode->Visible) { // AreaCode ?>
		<td data-name="AreaCode" <?php echo $bank_branch_list->AreaCode->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_AreaCode">
<span<?php echo $bank_branch_list->AreaCode->viewAttributes() ?>><?php echo $bank_branch_list->AreaCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->BranchNo->Visible) { // BranchNo ?>
		<td data-name="BranchNo" <?php echo $bank_branch_list->BranchNo->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BranchNo">
<span<?php echo $bank_branch_list->BranchNo->viewAttributes() ?>><?php echo $bank_branch_list->BranchNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->BranchAddress->Visible) { // BranchAddress ?>
		<td data-name="BranchAddress" <?php echo $bank_branch_list->BranchAddress->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BranchAddress">
<span<?php echo $bank_branch_list->BranchAddress->viewAttributes() ?>><?php echo $bank_branch_list->BranchAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->BranchTel->Visible) { // BranchTel ?>
		<td data-name="BranchTel" <?php echo $bank_branch_list->BranchTel->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BranchTel">
<span<?php echo $bank_branch_list->BranchTel->viewAttributes() ?>><?php echo $bank_branch_list->BranchTel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->BranchEmail->Visible) { // BranchEmail ?>
		<td data-name="BranchEmail" <?php echo $bank_branch_list->BranchEmail->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BranchEmail">
<span<?php echo $bank_branch_list->BranchEmail->viewAttributes() ?>><?php echo $bank_branch_list->BranchEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->BranchFax->Visible) { // BranchFax ?>
		<td data-name="BranchFax" <?php echo $bank_branch_list->BranchFax->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_BranchFax">
<span<?php echo $bank_branch_list->BranchFax->viewAttributes() ?>><?php echo $bank_branch_list->BranchFax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->SWIFT->Visible) { // SWIFT ?>
		<td data-name="SWIFT" <?php echo $bank_branch_list->SWIFT->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_SWIFT">
<span<?php echo $bank_branch_list->SWIFT->viewAttributes() ?>><?php echo $bank_branch_list->SWIFT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_branch_list->IBAN->Visible) { // IBAN ?>
		<td data-name="IBAN" <?php echo $bank_branch_list->IBAN->cellAttributes() ?>>
<span id="el<?php echo $bank_branch_list->RowCount ?>_bank_branch_IBAN">
<span<?php echo $bank_branch_list->IBAN->viewAttributes() ?>><?php echo $bank_branch_list->IBAN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bank_branch_list->ListOptions->render("body", "right", $bank_branch_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bank_branch_list->isGridAdd())
		$bank_branch_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bank_branch->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bank_branch_list->Recordset)
	$bank_branch_list->Recordset->Close();
?>
<?php if (!$bank_branch_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bank_branch_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bank_branch_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bank_branch_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bank_branch_list->TotalRecords == 0 && !$bank_branch->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bank_branch_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bank_branch_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bank_branch_list->isExport()) { ?>
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
$bank_branch_list->terminate();
?>