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
$dont_pay_paye_list = new dont_pay_paye_list();

// Run the page
$dont_pay_paye_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dont_pay_paye_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dont_pay_paye_list->isExport()) { ?>
<script>
var fdont_pay_payelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdont_pay_payelist = currentForm = new ew.Form("fdont_pay_payelist", "list");
	fdont_pay_payelist.formKeyCountName = '<?php echo $dont_pay_paye_list->FormKeyCountName ?>';
	loadjs.done("fdont_pay_payelist");
});
var fdont_pay_payelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdont_pay_payelistsrch = currentSearchForm = new ew.Form("fdont_pay_payelistsrch");

	// Dynamic selection lists
	// Filters

	fdont_pay_payelistsrch.filterList = <?php echo $dont_pay_paye_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdont_pay_payelistsrch.initSearchPanel = true;
	loadjs.done("fdont_pay_payelistsrch");
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
<?php if (!$dont_pay_paye_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($dont_pay_paye_list->TotalRecords > 0 && $dont_pay_paye_list->ExportOptions->visible()) { ?>
<?php $dont_pay_paye_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($dont_pay_paye_list->ImportOptions->visible()) { ?>
<?php $dont_pay_paye_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($dont_pay_paye_list->SearchOptions->visible()) { ?>
<?php $dont_pay_paye_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($dont_pay_paye_list->FilterOptions->visible()) { ?>
<?php $dont_pay_paye_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$dont_pay_paye_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$dont_pay_paye_list->isExport() && !$dont_pay_paye->CurrentAction) { ?>
<form name="fdont_pay_payelistsrch" id="fdont_pay_payelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdont_pay_payelistsrch-search-panel" class="<?php echo $dont_pay_paye_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="dont_pay_paye">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $dont_pay_paye_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($dont_pay_paye_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($dont_pay_paye_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $dont_pay_paye_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($dont_pay_paye_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($dont_pay_paye_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($dont_pay_paye_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($dont_pay_paye_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $dont_pay_paye_list->showPageHeader(); ?>
<?php
$dont_pay_paye_list->showMessage();
?>
<?php if ($dont_pay_paye_list->TotalRecords > 0 || $dont_pay_paye->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dont_pay_paye_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dont_pay_paye">
<?php if (!$dont_pay_paye_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$dont_pay_paye_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dont_pay_paye_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dont_pay_paye_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdont_pay_payelist" id="fdont_pay_payelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dont_pay_paye">
<div id="gmp_dont_pay_paye" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($dont_pay_paye_list->TotalRecords > 0 || $dont_pay_paye_list->isGridEdit()) { ?>
<table id="tbl_dont_pay_payelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dont_pay_paye->RowType = ROWTYPE_HEADER;

// Render list options
$dont_pay_paye_list->renderListOptions();

// Render list options (header, left)
$dont_pay_paye_list->ListOptions->render("header", "left");
?>
<?php if ($dont_pay_paye_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $dont_pay_paye_list->EmployeeID->headerCellClass() ?>"><div id="elh_dont_pay_paye_EmployeeID" class="dont_pay_paye_EmployeeID"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $dont_pay_paye_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->EmployeeID) ?>', 1);"><div id="elh_dont_pay_paye_EmployeeID" class="dont_pay_paye_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->FirstName->Visible) { // FirstName ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $dont_pay_paye_list->FirstName->headerCellClass() ?>"><div id="elh_dont_pay_paye_FirstName" class="dont_pay_paye_FirstName"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $dont_pay_paye_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->FirstName) ?>', 1);"><div id="elh_dont_pay_paye_FirstName" class="dont_pay_paye_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $dont_pay_paye_list->MiddleName->headerCellClass() ?>"><div id="elh_dont_pay_paye_MiddleName" class="dont_pay_paye_MiddleName"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $dont_pay_paye_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->MiddleName) ?>', 1);"><div id="elh_dont_pay_paye_MiddleName" class="dont_pay_paye_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->surName->Visible) { // surName ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->surName) == "") { ?>
		<th data-name="surName" class="<?php echo $dont_pay_paye_list->surName->headerCellClass() ?>"><div id="elh_dont_pay_paye_surName" class="dont_pay_paye_surName"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->surName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="surName" class="<?php echo $dont_pay_paye_list->surName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->surName) ?>', 1);"><div id="elh_dont_pay_paye_surName" class="dont_pay_paye_surName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->surName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->surName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->surName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->ID_TYPE->Visible) { // ID TYPE ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->ID_TYPE) == "") { ?>
		<th data-name="ID_TYPE" class="<?php echo $dont_pay_paye_list->ID_TYPE->headerCellClass() ?>"><div id="elh_dont_pay_paye_ID_TYPE" class="dont_pay_paye_ID_TYPE"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->ID_TYPE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_TYPE" class="<?php echo $dont_pay_paye_list->ID_TYPE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->ID_TYPE) ?>', 1);"><div id="elh_dont_pay_paye_ID_TYPE" class="dont_pay_paye_ID_TYPE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->ID_TYPE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->ID_TYPE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->ID_TYPE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->ID_NUMBER->Visible) { // ID NUMBER ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->ID_NUMBER) == "") { ?>
		<th data-name="ID_NUMBER" class="<?php echo $dont_pay_paye_list->ID_NUMBER->headerCellClass() ?>"><div id="elh_dont_pay_paye_ID_NUMBER" class="dont_pay_paye_ID_NUMBER"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->ID_NUMBER->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_NUMBER" class="<?php echo $dont_pay_paye_list->ID_NUMBER->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->ID_NUMBER) ?>', 1);"><div id="elh_dont_pay_paye_ID_NUMBER" class="dont_pay_paye_ID_NUMBER">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->ID_NUMBER->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->ID_NUMBER->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->ID_NUMBER->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->NAMES->Visible) { // NAMES ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->NAMES) == "") { ?>
		<th data-name="NAMES" class="<?php echo $dont_pay_paye_list->NAMES->headerCellClass() ?>"><div id="elh_dont_pay_paye_NAMES" class="dont_pay_paye_NAMES"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->NAMES->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NAMES" class="<?php echo $dont_pay_paye_list->NAMES->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->NAMES) ?>', 1);"><div id="elh_dont_pay_paye_NAMES" class="dont_pay_paye_NAMES">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->NAMES->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->NAMES->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->NAMES->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->NATURE->Visible) { // NATURE ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->NATURE) == "") { ?>
		<th data-name="NATURE" class="<?php echo $dont_pay_paye_list->NATURE->headerCellClass() ?>"><div id="elh_dont_pay_paye_NATURE" class="dont_pay_paye_NATURE"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->NATURE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NATURE" class="<?php echo $dont_pay_paye_list->NATURE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->NATURE) ?>', 1);"><div id="elh_dont_pay_paye_NATURE" class="dont_pay_paye_NATURE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->NATURE->caption() ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->NATURE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->NATURE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->GROSS->Visible) { // GROSS ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->GROSS) == "") { ?>
		<th data-name="GROSS" class="<?php echo $dont_pay_paye_list->GROSS->headerCellClass() ?>"><div id="elh_dont_pay_paye_GROSS" class="dont_pay_paye_GROSS"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->GROSS->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GROSS" class="<?php echo $dont_pay_paye_list->GROSS->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->GROSS) ?>', 1);"><div id="elh_dont_pay_paye_GROSS" class="dont_pay_paye_GROSS">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->GROSS->caption() ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->GROSS->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->GROSS->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->TAXABLE->Visible) { // TAXABLE ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->TAXABLE) == "") { ?>
		<th data-name="TAXABLE" class="<?php echo $dont_pay_paye_list->TAXABLE->headerCellClass() ?>"><div id="elh_dont_pay_paye_TAXABLE" class="dont_pay_paye_TAXABLE"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->TAXABLE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TAXABLE" class="<?php echo $dont_pay_paye_list->TAXABLE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->TAXABLE) ?>', 1);"><div id="elh_dont_pay_paye_TAXABLE" class="dont_pay_paye_TAXABLE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->TAXABLE->caption() ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->TAXABLE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->TAXABLE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->TAX_CREDIT->Visible) { // TAX CREDIT ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->TAX_CREDIT) == "") { ?>
		<th data-name="TAX_CREDIT" class="<?php echo $dont_pay_paye_list->TAX_CREDIT->headerCellClass() ?>"><div id="elh_dont_pay_paye_TAX_CREDIT" class="dont_pay_paye_TAX_CREDIT"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->TAX_CREDIT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TAX_CREDIT" class="<?php echo $dont_pay_paye_list->TAX_CREDIT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->TAX_CREDIT) ?>', 1);"><div id="elh_dont_pay_paye_TAX_CREDIT" class="dont_pay_paye_TAX_CREDIT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->TAX_CREDIT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->TAX_CREDIT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->TAX_CREDIT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->SocialSecurityNo) == "") { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $dont_pay_paye_list->SocialSecurityNo->headerCellClass() ?>"><div id="elh_dont_pay_paye_SocialSecurityNo" class="dont_pay_paye_SocialSecurityNo"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->SocialSecurityNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SocialSecurityNo" class="<?php echo $dont_pay_paye_list->SocialSecurityNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->SocialSecurityNo) ?>', 1);"><div id="elh_dont_pay_paye_SocialSecurityNo" class="dont_pay_paye_SocialSecurityNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->SocialSecurityNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->SocialSecurityNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->SocialSecurityNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->TAX_DEDUCTED->Visible) { // TAX DEDUCTED ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->TAX_DEDUCTED) == "") { ?>
		<th data-name="TAX_DEDUCTED" class="<?php echo $dont_pay_paye_list->TAX_DEDUCTED->headerCellClass() ?>"><div id="elh_dont_pay_paye_TAX_DEDUCTED" class="dont_pay_paye_TAX_DEDUCTED"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->TAX_DEDUCTED->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TAX_DEDUCTED" class="<?php echo $dont_pay_paye_list->TAX_DEDUCTED->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->TAX_DEDUCTED) ?>', 1);"><div id="elh_dont_pay_paye_TAX_DEDUCTED" class="dont_pay_paye_TAX_DEDUCTED">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->TAX_DEDUCTED->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->TAX_DEDUCTED->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->TAX_DEDUCTED->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dont_pay_paye_list->ADJUSTIMENT->Visible) { // ADJUSTIMENT ?>
	<?php if ($dont_pay_paye_list->SortUrl($dont_pay_paye_list->ADJUSTIMENT) == "") { ?>
		<th data-name="ADJUSTIMENT" class="<?php echo $dont_pay_paye_list->ADJUSTIMENT->headerCellClass() ?>"><div id="elh_dont_pay_paye_ADJUSTIMENT" class="dont_pay_paye_ADJUSTIMENT"><div class="ew-table-header-caption"><?php echo $dont_pay_paye_list->ADJUSTIMENT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ADJUSTIMENT" class="<?php echo $dont_pay_paye_list->ADJUSTIMENT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dont_pay_paye_list->SortUrl($dont_pay_paye_list->ADJUSTIMENT) ?>', 1);"><div id="elh_dont_pay_paye_ADJUSTIMENT" class="dont_pay_paye_ADJUSTIMENT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dont_pay_paye_list->ADJUSTIMENT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dont_pay_paye_list->ADJUSTIMENT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dont_pay_paye_list->ADJUSTIMENT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dont_pay_paye_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($dont_pay_paye_list->ExportAll && $dont_pay_paye_list->isExport()) {
	$dont_pay_paye_list->StopRecord = $dont_pay_paye_list->TotalRecords;
} else {

	// Set the last record to display
	if ($dont_pay_paye_list->TotalRecords > $dont_pay_paye_list->StartRecord + $dont_pay_paye_list->DisplayRecords - 1)
		$dont_pay_paye_list->StopRecord = $dont_pay_paye_list->StartRecord + $dont_pay_paye_list->DisplayRecords - 1;
	else
		$dont_pay_paye_list->StopRecord = $dont_pay_paye_list->TotalRecords;
}
$dont_pay_paye_list->RecordCount = $dont_pay_paye_list->StartRecord - 1;
if ($dont_pay_paye_list->Recordset && !$dont_pay_paye_list->Recordset->EOF) {
	$dont_pay_paye_list->Recordset->moveFirst();
	$selectLimit = $dont_pay_paye_list->UseSelectLimit;
	if (!$selectLimit && $dont_pay_paye_list->StartRecord > 1)
		$dont_pay_paye_list->Recordset->move($dont_pay_paye_list->StartRecord - 1);
} elseif (!$dont_pay_paye->AllowAddDeleteRow && $dont_pay_paye_list->StopRecord == 0) {
	$dont_pay_paye_list->StopRecord = $dont_pay_paye->GridAddRowCount;
}

// Initialize aggregate
$dont_pay_paye->RowType = ROWTYPE_AGGREGATEINIT;
$dont_pay_paye->resetAttributes();
$dont_pay_paye_list->renderRow();
while ($dont_pay_paye_list->RecordCount < $dont_pay_paye_list->StopRecord) {
	$dont_pay_paye_list->RecordCount++;
	if ($dont_pay_paye_list->RecordCount >= $dont_pay_paye_list->StartRecord) {
		$dont_pay_paye_list->RowCount++;

		// Set up key count
		$dont_pay_paye_list->KeyCount = $dont_pay_paye_list->RowIndex;

		// Init row class and style
		$dont_pay_paye->resetAttributes();
		$dont_pay_paye->CssClass = "";
		if ($dont_pay_paye_list->isGridAdd()) {
		} else {
			$dont_pay_paye_list->loadRowValues($dont_pay_paye_list->Recordset); // Load row values
		}
		$dont_pay_paye->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$dont_pay_paye->RowAttrs->merge(["data-rowindex" => $dont_pay_paye_list->RowCount, "id" => "r" . $dont_pay_paye_list->RowCount . "_dont_pay_paye", "data-rowtype" => $dont_pay_paye->RowType]);

		// Render row
		$dont_pay_paye_list->renderRow();

		// Render list options
		$dont_pay_paye_list->renderListOptions();
?>
	<tr <?php echo $dont_pay_paye->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dont_pay_paye_list->ListOptions->render("body", "left", $dont_pay_paye_list->RowCount);
?>
	<?php if ($dont_pay_paye_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $dont_pay_paye_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_EmployeeID">
<span<?php echo $dont_pay_paye_list->EmployeeID->viewAttributes() ?>><?php echo $dont_pay_paye_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $dont_pay_paye_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_FirstName">
<span<?php echo $dont_pay_paye_list->FirstName->viewAttributes() ?>><?php echo $dont_pay_paye_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $dont_pay_paye_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_MiddleName">
<span<?php echo $dont_pay_paye_list->MiddleName->viewAttributes() ?>><?php echo $dont_pay_paye_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->surName->Visible) { // surName ?>
		<td data-name="surName" <?php echo $dont_pay_paye_list->surName->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_surName">
<span<?php echo $dont_pay_paye_list->surName->viewAttributes() ?>><?php echo $dont_pay_paye_list->surName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->ID_TYPE->Visible) { // ID TYPE ?>
		<td data-name="ID_TYPE" <?php echo $dont_pay_paye_list->ID_TYPE->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_ID_TYPE">
<span<?php echo $dont_pay_paye_list->ID_TYPE->viewAttributes() ?>><?php echo $dont_pay_paye_list->ID_TYPE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->ID_NUMBER->Visible) { // ID NUMBER ?>
		<td data-name="ID_NUMBER" <?php echo $dont_pay_paye_list->ID_NUMBER->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_ID_NUMBER">
<span<?php echo $dont_pay_paye_list->ID_NUMBER->viewAttributes() ?>><?php echo $dont_pay_paye_list->ID_NUMBER->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->NAMES->Visible) { // NAMES ?>
		<td data-name="NAMES" <?php echo $dont_pay_paye_list->NAMES->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_NAMES">
<span<?php echo $dont_pay_paye_list->NAMES->viewAttributes() ?>><?php echo $dont_pay_paye_list->NAMES->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->NATURE->Visible) { // NATURE ?>
		<td data-name="NATURE" <?php echo $dont_pay_paye_list->NATURE->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_NATURE">
<span<?php echo $dont_pay_paye_list->NATURE->viewAttributes() ?>><?php echo $dont_pay_paye_list->NATURE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->GROSS->Visible) { // GROSS ?>
		<td data-name="GROSS" <?php echo $dont_pay_paye_list->GROSS->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_GROSS">
<span<?php echo $dont_pay_paye_list->GROSS->viewAttributes() ?>><?php echo $dont_pay_paye_list->GROSS->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->TAXABLE->Visible) { // TAXABLE ?>
		<td data-name="TAXABLE" <?php echo $dont_pay_paye_list->TAXABLE->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_TAXABLE">
<span<?php echo $dont_pay_paye_list->TAXABLE->viewAttributes() ?>><?php echo $dont_pay_paye_list->TAXABLE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->TAX_CREDIT->Visible) { // TAX CREDIT ?>
		<td data-name="TAX_CREDIT" <?php echo $dont_pay_paye_list->TAX_CREDIT->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_TAX_CREDIT">
<span<?php echo $dont_pay_paye_list->TAX_CREDIT->viewAttributes() ?>><?php echo $dont_pay_paye_list->TAX_CREDIT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->SocialSecurityNo->Visible) { // SocialSecurityNo ?>
		<td data-name="SocialSecurityNo" <?php echo $dont_pay_paye_list->SocialSecurityNo->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_SocialSecurityNo">
<span<?php echo $dont_pay_paye_list->SocialSecurityNo->viewAttributes() ?>><?php echo $dont_pay_paye_list->SocialSecurityNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->TAX_DEDUCTED->Visible) { // TAX DEDUCTED ?>
		<td data-name="TAX_DEDUCTED" <?php echo $dont_pay_paye_list->TAX_DEDUCTED->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_TAX_DEDUCTED">
<span<?php echo $dont_pay_paye_list->TAX_DEDUCTED->viewAttributes() ?>><?php echo $dont_pay_paye_list->TAX_DEDUCTED->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dont_pay_paye_list->ADJUSTIMENT->Visible) { // ADJUSTIMENT ?>
		<td data-name="ADJUSTIMENT" <?php echo $dont_pay_paye_list->ADJUSTIMENT->cellAttributes() ?>>
<span id="el<?php echo $dont_pay_paye_list->RowCount ?>_dont_pay_paye_ADJUSTIMENT">
<span<?php echo $dont_pay_paye_list->ADJUSTIMENT->viewAttributes() ?>><?php echo $dont_pay_paye_list->ADJUSTIMENT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dont_pay_paye_list->ListOptions->render("body", "right", $dont_pay_paye_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$dont_pay_paye_list->isGridAdd())
		$dont_pay_paye_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$dont_pay_paye->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dont_pay_paye_list->Recordset)
	$dont_pay_paye_list->Recordset->Close();
?>
<?php if (!$dont_pay_paye_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$dont_pay_paye_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dont_pay_paye_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dont_pay_paye_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dont_pay_paye_list->TotalRecords == 0 && !$dont_pay_paye->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $dont_pay_paye_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$dont_pay_paye_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dont_pay_paye_list->isExport()) { ?>
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
$dont_pay_paye_list->terminate();
?>