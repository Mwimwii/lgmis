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
$paye_list = new paye_list();

// Run the page
$paye_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$paye_list->isExport()) { ?>
<script>
var fpayelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayelist = currentForm = new ew.Form("fpayelist", "list");
	fpayelist.formKeyCountName = '<?php echo $paye_list->FormKeyCountName ?>';
	loadjs.done("fpayelist");
});
var fpayelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayelistsrch = currentSearchForm = new ew.Form("fpayelistsrch");

	// Dynamic selection lists
	// Filters

	fpayelistsrch.filterList = <?php echo $paye_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayelistsrch.initSearchPanel = true;
	loadjs.done("fpayelistsrch");
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
<?php if (!$paye_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($paye_list->TotalRecords > 0 && $paye_list->ExportOptions->visible()) { ?>
<?php $paye_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_list->ImportOptions->visible()) { ?>
<?php $paye_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_list->SearchOptions->visible()) { ?>
<?php $paye_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($paye_list->FilterOptions->visible()) { ?>
<?php $paye_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$paye_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$paye_list->isExport() && !$paye->CurrentAction) { ?>
<form name="fpayelistsrch" id="fpayelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayelistsrch-search-panel" class="<?php echo $paye_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="paye">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $paye_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($paye_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($paye_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $paye_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($paye_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($paye_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($paye_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($paye_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $paye_list->showPageHeader(); ?>
<?php
$paye_list->showMessage();
?>
<?php if ($paye_list->TotalRecords > 0 || $paye->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($paye_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> paye">
<?php if (!$paye_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$paye_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayelist" id="fpayelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye">
<div id="gmp_paye" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($paye_list->TotalRecords > 0 || $paye_list->isGridEdit()) { ?>
<table id="tbl_payelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$paye->RowType = ROWTYPE_HEADER;

// Render list options
$paye_list->renderListOptions();

// Render list options (header, left)
$paye_list->ListOptions->render("header", "left");
?>
<?php if ($paye_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($paye_list->SortUrl($paye_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_list->EmployeeID->headerCellClass() ?>"><div id="elh_paye_EmployeeID" class="paye_EmployeeID"><div class="ew-table-header-caption"><?php echo $paye_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->EmployeeID) ?>', 1);"><div id="elh_paye_EmployeeID" class="paye_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->FirstName->Visible) { // FirstName ?>
	<?php if ($paye_list->SortUrl($paye_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $paye_list->FirstName->headerCellClass() ?>"><div id="elh_paye_FirstName" class="paye_FirstName"><div class="ew-table-header-caption"><?php echo $paye_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $paye_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->FirstName) ?>', 1);"><div id="elh_paye_FirstName" class="paye_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($paye_list->SortUrl($paye_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $paye_list->MiddleName->headerCellClass() ?>"><div id="elh_paye_MiddleName" class="paye_MiddleName"><div class="ew-table-header-caption"><?php echo $paye_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $paye_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->MiddleName) ?>', 1);"><div id="elh_paye_MiddleName" class="paye_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->Surname->Visible) { // Surname ?>
	<?php if ($paye_list->SortUrl($paye_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $paye_list->Surname->headerCellClass() ?>"><div id="elh_paye_Surname" class="paye_Surname"><div class="ew-table-header-caption"><?php echo $paye_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $paye_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->Surname) ?>', 1);"><div id="elh_paye_Surname" class="paye_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->ID_TYPE->Visible) { // ID TYPE ?>
	<?php if ($paye_list->SortUrl($paye_list->ID_TYPE) == "") { ?>
		<th data-name="ID_TYPE" class="<?php echo $paye_list->ID_TYPE->headerCellClass() ?>"><div id="elh_paye_ID_TYPE" class="paye_ID_TYPE"><div class="ew-table-header-caption"><?php echo $paye_list->ID_TYPE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_TYPE" class="<?php echo $paye_list->ID_TYPE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->ID_TYPE) ?>', 1);"><div id="elh_paye_ID_TYPE" class="paye_ID_TYPE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->ID_TYPE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->ID_TYPE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->ID_TYPE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->ID_NUMBER->Visible) { // ID NUMBER ?>
	<?php if ($paye_list->SortUrl($paye_list->ID_NUMBER) == "") { ?>
		<th data-name="ID_NUMBER" class="<?php echo $paye_list->ID_NUMBER->headerCellClass() ?>"><div id="elh_paye_ID_NUMBER" class="paye_ID_NUMBER"><div class="ew-table-header-caption"><?php echo $paye_list->ID_NUMBER->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_NUMBER" class="<?php echo $paye_list->ID_NUMBER->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->ID_NUMBER) ?>', 1);"><div id="elh_paye_ID_NUMBER" class="paye_ID_NUMBER">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->ID_NUMBER->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->ID_NUMBER->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->ID_NUMBER->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->NATURE->Visible) { // NATURE ?>
	<?php if ($paye_list->SortUrl($paye_list->NATURE) == "") { ?>
		<th data-name="NATURE" class="<?php echo $paye_list->NATURE->headerCellClass() ?>"><div id="elh_paye_NATURE" class="paye_NATURE"><div class="ew-table-header-caption"><?php echo $paye_list->NATURE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NATURE" class="<?php echo $paye_list->NATURE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->NATURE) ?>', 1);"><div id="elh_paye_NATURE" class="paye_NATURE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->NATURE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->NATURE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->NATURE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->GROSS->Visible) { // GROSS ?>
	<?php if ($paye_list->SortUrl($paye_list->GROSS) == "") { ?>
		<th data-name="GROSS" class="<?php echo $paye_list->GROSS->headerCellClass() ?>"><div id="elh_paye_GROSS" class="paye_GROSS"><div class="ew-table-header-caption"><?php echo $paye_list->GROSS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GROSS" class="<?php echo $paye_list->GROSS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->GROSS) ?>', 1);"><div id="elh_paye_GROSS" class="paye_GROSS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->GROSS->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_list->GROSS->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->GROSS->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->TAXABLE->Visible) { // TAXABLE ?>
	<?php if ($paye_list->SortUrl($paye_list->TAXABLE) == "") { ?>
		<th data-name="TAXABLE" class="<?php echo $paye_list->TAXABLE->headerCellClass() ?>"><div id="elh_paye_TAXABLE" class="paye_TAXABLE"><div class="ew-table-header-caption"><?php echo $paye_list->TAXABLE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TAXABLE" class="<?php echo $paye_list->TAXABLE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->TAXABLE) ?>', 1);"><div id="elh_paye_TAXABLE" class="paye_TAXABLE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->TAXABLE->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_list->TAXABLE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->TAXABLE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->TAX_CREDIT->Visible) { // TAX CREDIT ?>
	<?php if ($paye_list->SortUrl($paye_list->TAX_CREDIT) == "") { ?>
		<th data-name="TAX_CREDIT" class="<?php echo $paye_list->TAX_CREDIT->headerCellClass() ?>"><div id="elh_paye_TAX_CREDIT" class="paye_TAX_CREDIT"><div class="ew-table-header-caption"><?php echo $paye_list->TAX_CREDIT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TAX_CREDIT" class="<?php echo $paye_list->TAX_CREDIT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->TAX_CREDIT) ?>', 1);"><div id="elh_paye_TAX_CREDIT" class="paye_TAX_CREDIT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->TAX_CREDIT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->TAX_CREDIT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->TAX_CREDIT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<?php if ($paye_list->SortUrl($paye_list->SocialSecurityNo) == "") { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $paye_list->SocialSecurityNo->headerCellClass() ?>"><div id="elh_paye_SocialSecurityNo" class="paye_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $paye_list->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $paye_list->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->SocialSecurityNo) ?>', 1);"><div id="elh_paye_SocialSecurityNo" class="paye_SocialSecurityNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->SocialSecurityNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->RunDescription->Visible) { // RunDescription ?>
	<?php if ($paye_list->SortUrl($paye_list->RunDescription) == "") { ?>
		<th data-name="RunDescription" class="<?php echo $paye_list->RunDescription->headerCellClass() ?>"><div id="elh_paye_RunDescription" class="paye_RunDescription"><div class="ew-table-header-caption"><?php echo $paye_list->RunDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunDescription" class="<?php echo $paye_list->RunDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->RunDescription) ?>', 1);"><div id="elh_paye_RunDescription" class="paye_RunDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->RunDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->RunDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->RunDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($paye_list->SortUrl($paye_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $paye_list->DeductionCode->headerCellClass() ?>"><div id="elh_paye_DeductionCode" class="paye_DeductionCode"><div class="ew-table-header-caption"><?php echo $paye_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $paye_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->DeductionCode) ?>', 1);"><div id="elh_paye_DeductionCode" class="paye_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($paye_list->SortUrl($paye_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $paye_list->DeductionName->headerCellClass() ?>"><div id="elh_paye_DeductionName" class="paye_DeductionName"><div class="ew-table-header-caption"><?php echo $paye_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $paye_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->DeductionName) ?>', 1);"><div id="elh_paye_DeductionName" class="paye_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->TAX_DEDUCTED->Visible) { // TAX DEDUCTED ?>
	<?php if ($paye_list->SortUrl($paye_list->TAX_DEDUCTED) == "") { ?>
		<th data-name="TAX_DEDUCTED" class="<?php echo $paye_list->TAX_DEDUCTED->headerCellClass() ?>"><div id="elh_paye_TAX_DEDUCTED" class="paye_TAX_DEDUCTED"><div class="ew-table-header-caption"><?php echo $paye_list->TAX_DEDUCTED->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TAX_DEDUCTED" class="<?php echo $paye_list->TAX_DEDUCTED->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->TAX_DEDUCTED) ?>', 1);"><div id="elh_paye_TAX_DEDUCTED" class="paye_TAX_DEDUCTED">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->TAX_DEDUCTED->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_list->TAX_DEDUCTED->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->TAX_DEDUCTED->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($paye_list->SortUrl($paye_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $paye_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_paye_PayrollPeriod" class="paye_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $paye_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $paye_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->PayrollPeriod) ?>', 1);"><div id="elh_paye_PayrollPeriod" class="paye_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->PositionName->Visible) { // PositionName ?>
	<?php if ($paye_list->SortUrl($paye_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $paye_list->PositionName->headerCellClass() ?>"><div id="elh_paye_PositionName" class="paye_PositionName"><div class="ew-table-header-caption"><?php echo $paye_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $paye_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->PositionName) ?>', 1);"><div id="elh_paye_PositionName" class="paye_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_list->ADJUSTIMENT->Visible) { // ADJUSTIMENT ?>
	<?php if ($paye_list->SortUrl($paye_list->ADJUSTIMENT) == "") { ?>
		<th data-name="ADJUSTIMENT" class="<?php echo $paye_list->ADJUSTIMENT->headerCellClass() ?>"><div id="elh_paye_ADJUSTIMENT" class="paye_ADJUSTIMENT"><div class="ew-table-header-caption"><?php echo $paye_list->ADJUSTIMENT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ADJUSTIMENT" class="<?php echo $paye_list->ADJUSTIMENT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_list->SortUrl($paye_list->ADJUSTIMENT) ?>', 1);"><div id="elh_paye_ADJUSTIMENT" class="paye_ADJUSTIMENT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_list->ADJUSTIMENT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_list->ADJUSTIMENT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_list->ADJUSTIMENT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$paye_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($paye_list->ExportAll && $paye_list->isExport()) {
	$paye_list->StopRecord = $paye_list->TotalRecords;
} else {

	// Set the last record to display
	if ($paye_list->TotalRecords > $paye_list->StartRecord + $paye_list->DisplayRecords - 1)
		$paye_list->StopRecord = $paye_list->StartRecord + $paye_list->DisplayRecords - 1;
	else
		$paye_list->StopRecord = $paye_list->TotalRecords;
}
$paye_list->RecordCount = $paye_list->StartRecord - 1;
if ($paye_list->Recordset && !$paye_list->Recordset->EOF) {
	$paye_list->Recordset->moveFirst();
	$selectLimit = $paye_list->UseSelectLimit;
	if (!$selectLimit && $paye_list->StartRecord > 1)
		$paye_list->Recordset->move($paye_list->StartRecord - 1);
} elseif (!$paye->AllowAddDeleteRow && $paye_list->StopRecord == 0) {
	$paye_list->StopRecord = $paye->GridAddRowCount;
}

// Initialize aggregate
$paye->RowType = ROWTYPE_AGGREGATEINIT;
$paye->resetAttributes();
$paye_list->renderRow();
while ($paye_list->RecordCount < $paye_list->StopRecord) {
	$paye_list->RecordCount++;
	if ($paye_list->RecordCount >= $paye_list->StartRecord) {
		$paye_list->RowCount++;

		// Set up key count
		$paye_list->KeyCount = $paye_list->RowIndex;

		// Init row class and style
		$paye->resetAttributes();
		$paye->CssClass = "";
		if ($paye_list->isGridAdd()) {
		} else {
			$paye_list->loadRowValues($paye_list->Recordset); // Load row values
		}
		$paye->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$paye->RowAttrs->merge(["data-rowindex" => $paye_list->RowCount, "id" => "r" . $paye_list->RowCount . "_paye", "data-rowtype" => $paye->RowType]);

		// Render row
		$paye_list->renderRow();

		// Render list options
		$paye_list->renderListOptions();
?>
	<tr <?php echo $paye->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paye_list->ListOptions->render("body", "left", $paye_list->RowCount);
?>
	<?php if ($paye_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $paye_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_EmployeeID">
<span<?php echo $paye_list->EmployeeID->viewAttributes() ?>><?php echo $paye_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $paye_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_FirstName">
<span<?php echo $paye_list->FirstName->viewAttributes() ?>><?php echo $paye_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $paye_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_MiddleName">
<span<?php echo $paye_list->MiddleName->viewAttributes() ?>><?php echo $paye_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $paye_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_Surname">
<span<?php echo $paye_list->Surname->viewAttributes() ?>><?php echo $paye_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->ID_TYPE->Visible) { // ID TYPE ?>
		<td data-name="ID_TYPE" <?php echo $paye_list->ID_TYPE->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_ID_TYPE">
<span<?php echo $paye_list->ID_TYPE->viewAttributes() ?>><?php echo $paye_list->ID_TYPE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->ID_NUMBER->Visible) { // ID NUMBER ?>
		<td data-name="ID_NUMBER" <?php echo $paye_list->ID_NUMBER->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_ID_NUMBER">
<span<?php echo $paye_list->ID_NUMBER->viewAttributes() ?>><?php echo $paye_list->ID_NUMBER->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->NATURE->Visible) { // NATURE ?>
		<td data-name="NATURE" <?php echo $paye_list->NATURE->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_NATURE">
<span<?php echo $paye_list->NATURE->viewAttributes() ?>><?php echo $paye_list->NATURE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->GROSS->Visible) { // GROSS ?>
		<td data-name="GROSS" <?php echo $paye_list->GROSS->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_GROSS">
<span<?php echo $paye_list->GROSS->viewAttributes() ?>><?php echo $paye_list->GROSS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->TAXABLE->Visible) { // TAXABLE ?>
		<td data-name="TAXABLE" <?php echo $paye_list->TAXABLE->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_TAXABLE">
<span<?php echo $paye_list->TAXABLE->viewAttributes() ?>><?php echo $paye_list->TAXABLE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->TAX_CREDIT->Visible) { // TAX CREDIT ?>
		<td data-name="TAX_CREDIT" <?php echo $paye_list->TAX_CREDIT->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_TAX_CREDIT">
<span<?php echo $paye_list->TAX_CREDIT->viewAttributes() ?>><?php echo $paye_list->TAX_CREDIT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo" <?php echo $paye_list->SocialSecurityNo->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_SocialSecurityNo">
<span<?php echo $paye_list->SocialSecurityNo->viewAttributes() ?>><?php echo $paye_list->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->RunDescription->Visible) { // RunDescription ?>
		<td data-name="RunDescription" <?php echo $paye_list->RunDescription->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_RunDescription">
<span<?php echo $paye_list->RunDescription->viewAttributes() ?>><?php echo $paye_list->RunDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $paye_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_DeductionCode">
<span<?php echo $paye_list->DeductionCode->viewAttributes() ?>><?php echo $paye_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $paye_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_DeductionName">
<span<?php echo $paye_list->DeductionName->viewAttributes() ?>><?php echo $paye_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->TAX_DEDUCTED->Visible) { // TAX DEDUCTED ?>
		<td data-name="TAX_DEDUCTED" <?php echo $paye_list->TAX_DEDUCTED->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_TAX_DEDUCTED">
<span<?php echo $paye_list->TAX_DEDUCTED->viewAttributes() ?>><?php echo $paye_list->TAX_DEDUCTED->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $paye_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_PayrollPeriod">
<span<?php echo $paye_list->PayrollPeriod->viewAttributes() ?>><?php echo $paye_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $paye_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_PositionName">
<span<?php echo $paye_list->PositionName->viewAttributes() ?>><?php echo $paye_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_list->ADJUSTIMENT->Visible) { // ADJUSTIMENT ?>
		<td data-name="ADJUSTIMENT" <?php echo $paye_list->ADJUSTIMENT->cellAttributes() ?>>
<span id="el<?php echo $paye_list->RowCount ?>_paye_ADJUSTIMENT">
<span<?php echo $paye_list->ADJUSTIMENT->viewAttributes() ?>><?php echo $paye_list->ADJUSTIMENT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paye_list->ListOptions->render("body", "right", $paye_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$paye_list->isGridAdd())
		$paye_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$paye->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($paye_list->Recordset)
	$paye_list->Recordset->Close();
?>
<?php if (!$paye_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$paye_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($paye_list->TotalRecords == 0 && !$paye->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $paye_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$paye_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$paye_list->isExport()) { ?>
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
$paye_list->terminate();
?>