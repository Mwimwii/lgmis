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
$ipc_tracking_list = new ipc_tracking_list();

// Run the page
$ipc_tracking_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ipc_tracking_list->isExport()) { ?>
<script>
var fipc_trackinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fipc_trackinglist = currentForm = new ew.Form("fipc_trackinglist", "list");
	fipc_trackinglist.formKeyCountName = '<?php echo $ipc_tracking_list->FormKeyCountName ?>';
	loadjs.done("fipc_trackinglist");
});
var fipc_trackinglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fipc_trackinglistsrch = currentSearchForm = new ew.Form("fipc_trackinglistsrch");

	// Dynamic selection lists
	// Filters

	fipc_trackinglistsrch.filterList = <?php echo $ipc_tracking_list->getFilterList() ?>;

	// Init search panel as collapsed
	fipc_trackinglistsrch.initSearchPanel = true;
	loadjs.done("fipc_trackinglistsrch");
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
<?php if (!$ipc_tracking_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ipc_tracking_list->TotalRecords > 0 && $ipc_tracking_list->ExportOptions->visible()) { ?>
<?php $ipc_tracking_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ipc_tracking_list->ImportOptions->visible()) { ?>
<?php $ipc_tracking_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ipc_tracking_list->SearchOptions->visible()) { ?>
<?php $ipc_tracking_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ipc_tracking_list->FilterOptions->visible()) { ?>
<?php $ipc_tracking_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ipc_tracking_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ipc_tracking_list->isExport("print")) { ?>
<?php
if ($ipc_tracking_list->DbMasterFilter != "" && $ipc_tracking->getCurrentMasterTable() == "contract") {
	if ($ipc_tracking_list->MasterRecordExists) {
		include_once "contractmaster.php";
	}
}
?>
<?php } ?>
<?php
$ipc_tracking_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ipc_tracking_list->isExport() && !$ipc_tracking->CurrentAction) { ?>
<form name="fipc_trackinglistsrch" id="fipc_trackinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fipc_trackinglistsrch-search-panel" class="<?php echo $ipc_tracking_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ipc_tracking">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ipc_tracking_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ipc_tracking_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ipc_tracking_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ipc_tracking_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ipc_tracking_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ipc_tracking_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ipc_tracking_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ipc_tracking_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ipc_tracking_list->showPageHeader(); ?>
<?php
$ipc_tracking_list->showMessage();
?>
<?php if ($ipc_tracking_list->TotalRecords > 0 || $ipc_tracking->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ipc_tracking_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ipc_tracking">
<?php if (!$ipc_tracking_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ipc_tracking_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ipc_tracking_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ipc_tracking_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fipc_trackinglist" id="fipc_trackinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ipc_tracking">
<?php if ($ipc_tracking->getCurrentMasterTable() == "contract" && $ipc_tracking->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contract">
<input type="hidden" name="fk_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_list->ContractNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ipc_tracking" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ipc_tracking_list->TotalRecords > 0 || $ipc_tracking_list->isGridEdit()) { ?>
<table id="tbl_ipc_trackinglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ipc_tracking->RowType = ROWTYPE_HEADER;

// Render list options
$ipc_tracking_list->renderListOptions();

// Render list options (header, left)
$ipc_tracking_list->ListOptions->render("header", "left");
?>
<?php if ($ipc_tracking_list->IPCNo->Visible) { // IPCNo ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->IPCNo) == "") { ?>
		<th data-name="IPCNo" class="<?php echo $ipc_tracking_list->IPCNo->headerCellClass() ?>"><div id="elh_ipc_tracking_IPCNo" class="ipc_tracking_IPCNo"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->IPCNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IPCNo" class="<?php echo $ipc_tracking_list->IPCNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->IPCNo) ?>', 1);"><div id="elh_ipc_tracking_IPCNo" class="ipc_tracking_IPCNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->IPCNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->IPCNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->IPCNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->ContractNo->Visible) { // ContractNo ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->ContractNo) == "") { ?>
		<th data-name="ContractNo" class="<?php echo $ipc_tracking_list->ContractNo->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractNo" class="ipc_tracking_ContractNo"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractNo" class="<?php echo $ipc_tracking_list->ContractNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->ContractNo) ?>', 1);"><div id="elh_ipc_tracking_ContractNo" class="ipc_tracking_ContractNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->ContractNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->ContractNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->ContractAuthorizedByAG) == "") { ?>
		<th data-name="ContractAuthorizedByAG" class="<?php echo $ipc_tracking_list->ContractAuthorizedByAG->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractAuthorizedByAG" class="ipc_tracking_ContractAuthorizedByAG"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractAuthorizedByAG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractAuthorizedByAG" class="<?php echo $ipc_tracking_list->ContractAuthorizedByAG->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->ContractAuthorizedByAG) ?>', 1);"><div id="elh_ipc_tracking_ContractAuthorizedByAG" class="ipc_tracking_ContractAuthorizedByAG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractAuthorizedByAG->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->ContractAuthorizedByAG->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->ContractAuthorizedByAG->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->VATApplied->Visible) { // VATApplied ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->VATApplied) == "") { ?>
		<th data-name="VATApplied" class="<?php echo $ipc_tracking_list->VATApplied->headerCellClass() ?>"><div id="elh_ipc_tracking_VATApplied" class="ipc_tracking_VATApplied"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->VATApplied->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VATApplied" class="<?php echo $ipc_tracking_list->VATApplied->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->VATApplied) ?>', 1);"><div id="elh_ipc_tracking_VATApplied" class="ipc_tracking_VATApplied">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->VATApplied->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->VATApplied->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->VATApplied->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->ArithmeticCheckDone) == "") { ?>
		<th data-name="ArithmeticCheckDone" class="<?php echo $ipc_tracking_list->ArithmeticCheckDone->headerCellClass() ?>"><div id="elh_ipc_tracking_ArithmeticCheckDone" class="ipc_tracking_ArithmeticCheckDone"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->ArithmeticCheckDone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ArithmeticCheckDone" class="<?php echo $ipc_tracking_list->ArithmeticCheckDone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->ArithmeticCheckDone) ?>', 1);"><div id="elh_ipc_tracking_ArithmeticCheckDone" class="ipc_tracking_ArithmeticCheckDone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->ArithmeticCheckDone->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->ArithmeticCheckDone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->ArithmeticCheckDone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->VariationsApproved->Visible) { // VariationsApproved ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->VariationsApproved) == "") { ?>
		<th data-name="VariationsApproved" class="<?php echo $ipc_tracking_list->VariationsApproved->headerCellClass() ?>"><div id="elh_ipc_tracking_VariationsApproved" class="ipc_tracking_VariationsApproved"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->VariationsApproved->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationsApproved" class="<?php echo $ipc_tracking_list->VariationsApproved->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->VariationsApproved) ?>', 1);"><div id="elh_ipc_tracking_VariationsApproved" class="ipc_tracking_VariationsApproved">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->VariationsApproved->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->VariationsApproved->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->VariationsApproved->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->PerformanceBondValidUntil) == "") { ?>
		<th data-name="PerformanceBondValidUntil" class="<?php echo $ipc_tracking_list->PerformanceBondValidUntil->headerCellClass() ?>"><div id="elh_ipc_tracking_PerformanceBondValidUntil" class="ipc_tracking_PerformanceBondValidUntil"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->PerformanceBondValidUntil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PerformanceBondValidUntil" class="<?php echo $ipc_tracking_list->PerformanceBondValidUntil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->PerformanceBondValidUntil) ?>', 1);"><div id="elh_ipc_tracking_PerformanceBondValidUntil" class="ipc_tracking_PerformanceBondValidUntil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->PerformanceBondValidUntil->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->PerformanceBondValidUntil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->PerformanceBondValidUntil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->AdvancePaymentBondValidUntil) == "") { ?>
		<th data-name="AdvancePaymentBondValidUntil" class="<?php echo $ipc_tracking_list->AdvancePaymentBondValidUntil->headerCellClass() ?>"><div id="elh_ipc_tracking_AdvancePaymentBondValidUntil" class="ipc_tracking_AdvancePaymentBondValidUntil"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->AdvancePaymentBondValidUntil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdvancePaymentBondValidUntil" class="<?php echo $ipc_tracking_list->AdvancePaymentBondValidUntil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->AdvancePaymentBondValidUntil) ?>', 1);"><div id="elh_ipc_tracking_AdvancePaymentBondValidUntil" class="ipc_tracking_AdvancePaymentBondValidUntil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->AdvancePaymentBondValidUntil->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->AdvancePaymentBondValidUntil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->AdvancePaymentBondValidUntil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->RetentionDeductionClause) == "") { ?>
		<th data-name="RetentionDeductionClause" class="<?php echo $ipc_tracking_list->RetentionDeductionClause->headerCellClass() ?>"><div id="elh_ipc_tracking_RetentionDeductionClause" class="ipc_tracking_RetentionDeductionClause"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->RetentionDeductionClause->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetentionDeductionClause" class="<?php echo $ipc_tracking_list->RetentionDeductionClause->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->RetentionDeductionClause) ?>', 1);"><div id="elh_ipc_tracking_RetentionDeductionClause" class="ipc_tracking_RetentionDeductionClause">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->RetentionDeductionClause->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->RetentionDeductionClause->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->RetentionDeductionClause->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->RetentionDeducted->Visible) { // RetentionDeducted ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->RetentionDeducted) == "") { ?>
		<th data-name="RetentionDeducted" class="<?php echo $ipc_tracking_list->RetentionDeducted->headerCellClass() ?>"><div id="elh_ipc_tracking_RetentionDeducted" class="ipc_tracking_RetentionDeducted"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->RetentionDeducted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetentionDeducted" class="<?php echo $ipc_tracking_list->RetentionDeducted->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->RetentionDeducted) ?>', 1);"><div id="elh_ipc_tracking_RetentionDeducted" class="ipc_tracking_RetentionDeducted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->RetentionDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->RetentionDeducted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->RetentionDeducted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->LiquidatedDamagesDeducted) == "") { ?>
		<th data-name="LiquidatedDamagesDeducted" class="<?php echo $ipc_tracking_list->LiquidatedDamagesDeducted->headerCellClass() ?>"><div id="elh_ipc_tracking_LiquidatedDamagesDeducted" class="ipc_tracking_LiquidatedDamagesDeducted"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->LiquidatedDamagesDeducted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LiquidatedDamagesDeducted" class="<?php echo $ipc_tracking_list->LiquidatedDamagesDeducted->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->LiquidatedDamagesDeducted) ?>', 1);"><div id="elh_ipc_tracking_LiquidatedDamagesDeducted" class="ipc_tracking_LiquidatedDamagesDeducted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->LiquidatedDamagesDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->LiquidatedDamagesDeducted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->LiquidatedDamagesDeducted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->AdvancedPaymentDeducted) == "") { ?>
		<th data-name="AdvancedPaymentDeducted" class="<?php echo $ipc_tracking_list->AdvancedPaymentDeducted->headerCellClass() ?>"><div id="elh_ipc_tracking_AdvancedPaymentDeducted" class="ipc_tracking_AdvancedPaymentDeducted"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->AdvancedPaymentDeducted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdvancedPaymentDeducted" class="<?php echo $ipc_tracking_list->AdvancedPaymentDeducted->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->AdvancedPaymentDeducted) ?>', 1);"><div id="elh_ipc_tracking_AdvancedPaymentDeducted" class="ipc_tracking_AdvancedPaymentDeducted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->AdvancedPaymentDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->AdvancedPaymentDeducted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->AdvancedPaymentDeducted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->CurrentProgressReportAttached) == "") { ?>
		<th data-name="CurrentProgressReportAttached" class="<?php echo $ipc_tracking_list->CurrentProgressReportAttached->headerCellClass() ?>"><div id="elh_ipc_tracking_CurrentProgressReportAttached" class="ipc_tracking_CurrentProgressReportAttached"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->CurrentProgressReportAttached->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentProgressReportAttached" class="<?php echo $ipc_tracking_list->CurrentProgressReportAttached->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->CurrentProgressReportAttached) ?>', 1);"><div id="elh_ipc_tracking_CurrentProgressReportAttached" class="ipc_tracking_CurrentProgressReportAttached">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->CurrentProgressReportAttached->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->CurrentProgressReportAttached->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->CurrentProgressReportAttached->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->DateOfSiteInspection) == "") { ?>
		<th data-name="DateOfSiteInspection" class="<?php echo $ipc_tracking_list->DateOfSiteInspection->headerCellClass() ?>"><div id="elh_ipc_tracking_DateOfSiteInspection" class="ipc_tracking_DateOfSiteInspection"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->DateOfSiteInspection->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfSiteInspection" class="<?php echo $ipc_tracking_list->DateOfSiteInspection->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->DateOfSiteInspection) ?>', 1);"><div id="elh_ipc_tracking_DateOfSiteInspection" class="ipc_tracking_DateOfSiteInspection">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->DateOfSiteInspection->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->DateOfSiteInspection->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->DateOfSiteInspection->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->TimeExtensionAuthorized) == "") { ?>
		<th data-name="TimeExtensionAuthorized" class="<?php echo $ipc_tracking_list->TimeExtensionAuthorized->headerCellClass() ?>"><div id="elh_ipc_tracking_TimeExtensionAuthorized" class="ipc_tracking_TimeExtensionAuthorized"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->TimeExtensionAuthorized->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TimeExtensionAuthorized" class="<?php echo $ipc_tracking_list->TimeExtensionAuthorized->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->TimeExtensionAuthorized) ?>', 1);"><div id="elh_ipc_tracking_TimeExtensionAuthorized" class="ipc_tracking_TimeExtensionAuthorized">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->TimeExtensionAuthorized->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->TimeExtensionAuthorized->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->TimeExtensionAuthorized->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->LabResultsChecked->Visible) { // LabResultsChecked ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->LabResultsChecked) == "") { ?>
		<th data-name="LabResultsChecked" class="<?php echo $ipc_tracking_list->LabResultsChecked->headerCellClass() ?>"><div id="elh_ipc_tracking_LabResultsChecked" class="ipc_tracking_LabResultsChecked"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->LabResultsChecked->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LabResultsChecked" class="<?php echo $ipc_tracking_list->LabResultsChecked->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->LabResultsChecked) ?>', 1);"><div id="elh_ipc_tracking_LabResultsChecked" class="ipc_tracking_LabResultsChecked">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->LabResultsChecked->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->LabResultsChecked->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->LabResultsChecked->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->TerminationNoticeGiven) == "") { ?>
		<th data-name="TerminationNoticeGiven" class="<?php echo $ipc_tracking_list->TerminationNoticeGiven->headerCellClass() ?>"><div id="elh_ipc_tracking_TerminationNoticeGiven" class="ipc_tracking_TerminationNoticeGiven"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->TerminationNoticeGiven->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TerminationNoticeGiven" class="<?php echo $ipc_tracking_list->TerminationNoticeGiven->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->TerminationNoticeGiven) ?>', 1);"><div id="elh_ipc_tracking_TerminationNoticeGiven" class="ipc_tracking_TerminationNoticeGiven">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->TerminationNoticeGiven->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->TerminationNoticeGiven->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->TerminationNoticeGiven->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->CopiesEmailedToMLG) == "") { ?>
		<th data-name="CopiesEmailedToMLG" class="<?php echo $ipc_tracking_list->CopiesEmailedToMLG->headerCellClass() ?>"><div id="elh_ipc_tracking_CopiesEmailedToMLG" class="ipc_tracking_CopiesEmailedToMLG"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->CopiesEmailedToMLG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CopiesEmailedToMLG" class="<?php echo $ipc_tracking_list->CopiesEmailedToMLG->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->CopiesEmailedToMLG) ?>', 1);"><div id="elh_ipc_tracking_CopiesEmailedToMLG" class="ipc_tracking_CopiesEmailedToMLG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->CopiesEmailedToMLG->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->CopiesEmailedToMLG->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->CopiesEmailedToMLG->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->ContractStillValid->Visible) { // ContractStillValid ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->ContractStillValid) == "") { ?>
		<th data-name="ContractStillValid" class="<?php echo $ipc_tracking_list->ContractStillValid->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractStillValid" class="ipc_tracking_ContractStillValid"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractStillValid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractStillValid" class="<?php echo $ipc_tracking_list->ContractStillValid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->ContractStillValid) ?>', 1);"><div id="elh_ipc_tracking_ContractStillValid" class="ipc_tracking_ContractStillValid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractStillValid->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->ContractStillValid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->ContractStillValid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->DeskOfficer->Visible) { // DeskOfficer ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->DeskOfficer) == "") { ?>
		<th data-name="DeskOfficer" class="<?php echo $ipc_tracking_list->DeskOfficer->headerCellClass() ?>"><div id="elh_ipc_tracking_DeskOfficer" class="ipc_tracking_DeskOfficer"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->DeskOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeskOfficer" class="<?php echo $ipc_tracking_list->DeskOfficer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->DeskOfficer) ?>', 1);"><div id="elh_ipc_tracking_DeskOfficer" class="ipc_tracking_DeskOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->DeskOfficer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->DeskOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->DeskOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->DeskOfficerDate) == "") { ?>
		<th data-name="DeskOfficerDate" class="<?php echo $ipc_tracking_list->DeskOfficerDate->headerCellClass() ?>"><div id="elh_ipc_tracking_DeskOfficerDate" class="ipc_tracking_DeskOfficerDate"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->DeskOfficerDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeskOfficerDate" class="<?php echo $ipc_tracking_list->DeskOfficerDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->DeskOfficerDate) ?>', 1);"><div id="elh_ipc_tracking_DeskOfficerDate" class="ipc_tracking_DeskOfficerDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->DeskOfficerDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->DeskOfficerDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->DeskOfficerDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->SupervisingEngineer) == "") { ?>
		<th data-name="SupervisingEngineer" class="<?php echo $ipc_tracking_list->SupervisingEngineer->headerCellClass() ?>"><div id="elh_ipc_tracking_SupervisingEngineer" class="ipc_tracking_SupervisingEngineer"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->SupervisingEngineer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupervisingEngineer" class="<?php echo $ipc_tracking_list->SupervisingEngineer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->SupervisingEngineer) ?>', 1);"><div id="elh_ipc_tracking_SupervisingEngineer" class="ipc_tracking_SupervisingEngineer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->SupervisingEngineer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->SupervisingEngineer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->SupervisingEngineer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->EngineerDate->Visible) { // EngineerDate ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->EngineerDate) == "") { ?>
		<th data-name="EngineerDate" class="<?php echo $ipc_tracking_list->EngineerDate->headerCellClass() ?>"><div id="elh_ipc_tracking_EngineerDate" class="ipc_tracking_EngineerDate"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->EngineerDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EngineerDate" class="<?php echo $ipc_tracking_list->EngineerDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->EngineerDate) ?>', 1);"><div id="elh_ipc_tracking_EngineerDate" class="ipc_tracking_EngineerDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->EngineerDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->EngineerDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->EngineerDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->CouncilSecretary->Visible) { // CouncilSecretary ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->CouncilSecretary) == "") { ?>
		<th data-name="CouncilSecretary" class="<?php echo $ipc_tracking_list->CouncilSecretary->headerCellClass() ?>"><div id="elh_ipc_tracking_CouncilSecretary" class="ipc_tracking_CouncilSecretary"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->CouncilSecretary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilSecretary" class="<?php echo $ipc_tracking_list->CouncilSecretary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->CouncilSecretary) ?>', 1);"><div id="elh_ipc_tracking_CouncilSecretary" class="ipc_tracking_CouncilSecretary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->CouncilSecretary->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->CouncilSecretary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->CouncilSecretary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->CSDate->Visible) { // CSDate ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->CSDate) == "") { ?>
		<th data-name="CSDate" class="<?php echo $ipc_tracking_list->CSDate->headerCellClass() ?>"><div id="elh_ipc_tracking_CSDate" class="ipc_tracking_CSDate"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->CSDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CSDate" class="<?php echo $ipc_tracking_list->CSDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->CSDate) ?>', 1);"><div id="elh_ipc_tracking_CSDate" class="ipc_tracking_CSDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->CSDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->CSDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->CSDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_list->ContractType->Visible) { // ContractType ?>
	<?php if ($ipc_tracking_list->SortUrl($ipc_tracking_list->ContractType) == "") { ?>
		<th data-name="ContractType" class="<?php echo $ipc_tracking_list->ContractType->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractType" class="ipc_tracking_ContractType"><div class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractType" class="<?php echo $ipc_tracking_list->ContractType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ipc_tracking_list->SortUrl($ipc_tracking_list->ContractType) ?>', 1);"><div id="elh_ipc_tracking_ContractType" class="ipc_tracking_ContractType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_list->ContractType->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_list->ContractType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_list->ContractType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ipc_tracking_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ipc_tracking_list->ExportAll && $ipc_tracking_list->isExport()) {
	$ipc_tracking_list->StopRecord = $ipc_tracking_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ipc_tracking_list->TotalRecords > $ipc_tracking_list->StartRecord + $ipc_tracking_list->DisplayRecords - 1)
		$ipc_tracking_list->StopRecord = $ipc_tracking_list->StartRecord + $ipc_tracking_list->DisplayRecords - 1;
	else
		$ipc_tracking_list->StopRecord = $ipc_tracking_list->TotalRecords;
}
$ipc_tracking_list->RecordCount = $ipc_tracking_list->StartRecord - 1;
if ($ipc_tracking_list->Recordset && !$ipc_tracking_list->Recordset->EOF) {
	$ipc_tracking_list->Recordset->moveFirst();
	$selectLimit = $ipc_tracking_list->UseSelectLimit;
	if (!$selectLimit && $ipc_tracking_list->StartRecord > 1)
		$ipc_tracking_list->Recordset->move($ipc_tracking_list->StartRecord - 1);
} elseif (!$ipc_tracking->AllowAddDeleteRow && $ipc_tracking_list->StopRecord == 0) {
	$ipc_tracking_list->StopRecord = $ipc_tracking->GridAddRowCount;
}

// Initialize aggregate
$ipc_tracking->RowType = ROWTYPE_AGGREGATEINIT;
$ipc_tracking->resetAttributes();
$ipc_tracking_list->renderRow();
while ($ipc_tracking_list->RecordCount < $ipc_tracking_list->StopRecord) {
	$ipc_tracking_list->RecordCount++;
	if ($ipc_tracking_list->RecordCount >= $ipc_tracking_list->StartRecord) {
		$ipc_tracking_list->RowCount++;

		// Set up key count
		$ipc_tracking_list->KeyCount = $ipc_tracking_list->RowIndex;

		// Init row class and style
		$ipc_tracking->resetAttributes();
		$ipc_tracking->CssClass = "";
		if ($ipc_tracking_list->isGridAdd()) {
		} else {
			$ipc_tracking_list->loadRowValues($ipc_tracking_list->Recordset); // Load row values
		}
		$ipc_tracking->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ipc_tracking->RowAttrs->merge(["data-rowindex" => $ipc_tracking_list->RowCount, "id" => "r" . $ipc_tracking_list->RowCount . "_ipc_tracking", "data-rowtype" => $ipc_tracking->RowType]);

		// Render row
		$ipc_tracking_list->renderRow();

		// Render list options
		$ipc_tracking_list->renderListOptions();
?>
	<tr <?php echo $ipc_tracking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ipc_tracking_list->ListOptions->render("body", "left", $ipc_tracking_list->RowCount);
?>
	<?php if ($ipc_tracking_list->IPCNo->Visible) { // IPCNo ?>
		<td data-name="IPCNo" <?php echo $ipc_tracking_list->IPCNo->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_IPCNo">
<span<?php echo $ipc_tracking_list->IPCNo->viewAttributes() ?>><?php echo $ipc_tracking_list->IPCNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->ContractNo->Visible) { // ContractNo ?>
		<td data-name="ContractNo" <?php echo $ipc_tracking_list->ContractNo->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_list->ContractNo->viewAttributes() ?>><?php echo $ipc_tracking_list->ContractNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
		<td data-name="ContractAuthorizedByAG" <?php echo $ipc_tracking_list->ContractAuthorizedByAG->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_ContractAuthorizedByAG">
<span<?php echo $ipc_tracking_list->ContractAuthorizedByAG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractAuthorizedByAG" class="custom-control-input" value="<?php echo $ipc_tracking_list->ContractAuthorizedByAG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->ContractAuthorizedByAG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractAuthorizedByAG"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->VATApplied->Visible) { // VATApplied ?>
		<td data-name="VATApplied" <?php echo $ipc_tracking_list->VATApplied->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_VATApplied">
<span<?php echo $ipc_tracking_list->VATApplied->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VATApplied" class="custom-control-input" value="<?php echo $ipc_tracking_list->VATApplied->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->VATApplied->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VATApplied"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
		<td data-name="ArithmeticCheckDone" <?php echo $ipc_tracking_list->ArithmeticCheckDone->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_ArithmeticCheckDone">
<span<?php echo $ipc_tracking_list->ArithmeticCheckDone->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ArithmeticCheckDone" class="custom-control-input" value="<?php echo $ipc_tracking_list->ArithmeticCheckDone->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->ArithmeticCheckDone->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ArithmeticCheckDone"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->VariationsApproved->Visible) { // VariationsApproved ?>
		<td data-name="VariationsApproved" <?php echo $ipc_tracking_list->VariationsApproved->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_VariationsApproved">
<span<?php echo $ipc_tracking_list->VariationsApproved->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VariationsApproved" class="custom-control-input" value="<?php echo $ipc_tracking_list->VariationsApproved->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->VariationsApproved->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VariationsApproved"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
		<td data-name="PerformanceBondValidUntil" <?php echo $ipc_tracking_list->PerformanceBondValidUntil->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_PerformanceBondValidUntil">
<span<?php echo $ipc_tracking_list->PerformanceBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_list->PerformanceBondValidUntil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
		<td data-name="AdvancePaymentBondValidUntil" <?php echo $ipc_tracking_list->AdvancePaymentBondValidUntil->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_AdvancePaymentBondValidUntil">
<span<?php echo $ipc_tracking_list->AdvancePaymentBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_list->AdvancePaymentBondValidUntil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
		<td data-name="RetentionDeductionClause" <?php echo $ipc_tracking_list->RetentionDeductionClause->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_RetentionDeductionClause">
<span<?php echo $ipc_tracking_list->RetentionDeductionClause->viewAttributes() ?>><?php echo $ipc_tracking_list->RetentionDeductionClause->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->RetentionDeducted->Visible) { // RetentionDeducted ?>
		<td data-name="RetentionDeducted" <?php echo $ipc_tracking_list->RetentionDeducted->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_RetentionDeducted">
<span<?php echo $ipc_tracking_list->RetentionDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_RetentionDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_list->RetentionDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->RetentionDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_RetentionDeducted"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
		<td data-name="LiquidatedDamagesDeducted" <?php echo $ipc_tracking_list->LiquidatedDamagesDeducted->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_LiquidatedDamagesDeducted">
<span<?php echo $ipc_tracking_list->LiquidatedDamagesDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LiquidatedDamagesDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_list->LiquidatedDamagesDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->LiquidatedDamagesDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LiquidatedDamagesDeducted"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
		<td data-name="AdvancedPaymentDeducted" <?php echo $ipc_tracking_list->AdvancedPaymentDeducted->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_AdvancedPaymentDeducted">
<span<?php echo $ipc_tracking_list->AdvancedPaymentDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdvancedPaymentDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_list->AdvancedPaymentDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->AdvancedPaymentDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdvancedPaymentDeducted"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
		<td data-name="CurrentProgressReportAttached" <?php echo $ipc_tracking_list->CurrentProgressReportAttached->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_CurrentProgressReportAttached">
<span<?php echo $ipc_tracking_list->CurrentProgressReportAttached->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CurrentProgressReportAttached" class="custom-control-input" value="<?php echo $ipc_tracking_list->CurrentProgressReportAttached->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->CurrentProgressReportAttached->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CurrentProgressReportAttached"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
		<td data-name="DateOfSiteInspection" <?php echo $ipc_tracking_list->DateOfSiteInspection->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_DateOfSiteInspection">
<span<?php echo $ipc_tracking_list->DateOfSiteInspection->viewAttributes() ?>><?php echo $ipc_tracking_list->DateOfSiteInspection->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
		<td data-name="TimeExtensionAuthorized" <?php echo $ipc_tracking_list->TimeExtensionAuthorized->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_TimeExtensionAuthorized">
<span<?php echo $ipc_tracking_list->TimeExtensionAuthorized->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TimeExtensionAuthorized" class="custom-control-input" value="<?php echo $ipc_tracking_list->TimeExtensionAuthorized->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->TimeExtensionAuthorized->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TimeExtensionAuthorized"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->LabResultsChecked->Visible) { // LabResultsChecked ?>
		<td data-name="LabResultsChecked" <?php echo $ipc_tracking_list->LabResultsChecked->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_LabResultsChecked">
<span<?php echo $ipc_tracking_list->LabResultsChecked->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LabResultsChecked" class="custom-control-input" value="<?php echo $ipc_tracking_list->LabResultsChecked->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->LabResultsChecked->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LabResultsChecked"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
		<td data-name="TerminationNoticeGiven" <?php echo $ipc_tracking_list->TerminationNoticeGiven->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_TerminationNoticeGiven">
<span<?php echo $ipc_tracking_list->TerminationNoticeGiven->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TerminationNoticeGiven" class="custom-control-input" value="<?php echo $ipc_tracking_list->TerminationNoticeGiven->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->TerminationNoticeGiven->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TerminationNoticeGiven"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
		<td data-name="CopiesEmailedToMLG" <?php echo $ipc_tracking_list->CopiesEmailedToMLG->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_CopiesEmailedToMLG">
<span<?php echo $ipc_tracking_list->CopiesEmailedToMLG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CopiesEmailedToMLG" class="custom-control-input" value="<?php echo $ipc_tracking_list->CopiesEmailedToMLG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->CopiesEmailedToMLG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CopiesEmailedToMLG"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->ContractStillValid->Visible) { // ContractStillValid ?>
		<td data-name="ContractStillValid" <?php echo $ipc_tracking_list->ContractStillValid->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_ContractStillValid">
<span<?php echo $ipc_tracking_list->ContractStillValid->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractStillValid" class="custom-control-input" value="<?php echo $ipc_tracking_list->ContractStillValid->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_list->ContractStillValid->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractStillValid"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->DeskOfficer->Visible) { // DeskOfficer ?>
		<td data-name="DeskOfficer" <?php echo $ipc_tracking_list->DeskOfficer->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_DeskOfficer">
<span<?php echo $ipc_tracking_list->DeskOfficer->viewAttributes() ?>><?php echo $ipc_tracking_list->DeskOfficer->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
		<td data-name="DeskOfficerDate" <?php echo $ipc_tracking_list->DeskOfficerDate->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_DeskOfficerDate">
<span<?php echo $ipc_tracking_list->DeskOfficerDate->viewAttributes() ?>><?php echo $ipc_tracking_list->DeskOfficerDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
		<td data-name="SupervisingEngineer" <?php echo $ipc_tracking_list->SupervisingEngineer->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_SupervisingEngineer">
<span<?php echo $ipc_tracking_list->SupervisingEngineer->viewAttributes() ?>><?php echo $ipc_tracking_list->SupervisingEngineer->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->EngineerDate->Visible) { // EngineerDate ?>
		<td data-name="EngineerDate" <?php echo $ipc_tracking_list->EngineerDate->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_EngineerDate">
<span<?php echo $ipc_tracking_list->EngineerDate->viewAttributes() ?>><?php echo $ipc_tracking_list->EngineerDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->CouncilSecretary->Visible) { // CouncilSecretary ?>
		<td data-name="CouncilSecretary" <?php echo $ipc_tracking_list->CouncilSecretary->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_CouncilSecretary">
<span<?php echo $ipc_tracking_list->CouncilSecretary->viewAttributes() ?>><?php echo $ipc_tracking_list->CouncilSecretary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->CSDate->Visible) { // CSDate ?>
		<td data-name="CSDate" <?php echo $ipc_tracking_list->CSDate->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_CSDate">
<span<?php echo $ipc_tracking_list->CSDate->viewAttributes() ?>><?php echo $ipc_tracking_list->CSDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_list->ContractType->Visible) { // ContractType ?>
		<td data-name="ContractType" <?php echo $ipc_tracking_list->ContractType->cellAttributes() ?>>
<span id="el<?php echo $ipc_tracking_list->RowCount ?>_ipc_tracking_ContractType">
<span<?php echo $ipc_tracking_list->ContractType->viewAttributes() ?>><?php echo $ipc_tracking_list->ContractType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ipc_tracking_list->ListOptions->render("body", "right", $ipc_tracking_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ipc_tracking_list->isGridAdd())
		$ipc_tracking_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ipc_tracking->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ipc_tracking_list->Recordset)
	$ipc_tracking_list->Recordset->Close();
?>
<?php if (!$ipc_tracking_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ipc_tracking_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ipc_tracking_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ipc_tracking_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ipc_tracking_list->TotalRecords == 0 && !$ipc_tracking->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ipc_tracking_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ipc_tracking_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ipc_tracking_list->isExport()) { ?>
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
$ipc_tracking_list->terminate();
?>