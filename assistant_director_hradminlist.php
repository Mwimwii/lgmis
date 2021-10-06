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
$assistant_director_hradmin_list = new assistant_director_hradmin_list();

// Run the page
$assistant_director_hradmin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$assistant_director_hradmin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$assistant_director_hradmin_list->isExport()) { ?>
<script>
var fassistant_director_hradminlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fassistant_director_hradminlist = currentForm = new ew.Form("fassistant_director_hradminlist", "list");
	fassistant_director_hradminlist.formKeyCountName = '<?php echo $assistant_director_hradmin_list->FormKeyCountName ?>';
	loadjs.done("fassistant_director_hradminlist");
});
var fassistant_director_hradminlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fassistant_director_hradminlistsrch = currentSearchForm = new ew.Form("fassistant_director_hradminlistsrch");

	// Dynamic selection lists
	// Filters

	fassistant_director_hradminlistsrch.filterList = <?php echo $assistant_director_hradmin_list->getFilterList() ?>;

	// Init search panel as collapsed
	fassistant_director_hradminlistsrch.initSearchPanel = true;
	loadjs.done("fassistant_director_hradminlistsrch");
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
<?php if (!$assistant_director_hradmin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($assistant_director_hradmin_list->TotalRecords > 0 && $assistant_director_hradmin_list->ExportOptions->visible()) { ?>
<?php $assistant_director_hradmin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->ImportOptions->visible()) { ?>
<?php $assistant_director_hradmin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->SearchOptions->visible()) { ?>
<?php $assistant_director_hradmin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->FilterOptions->visible()) { ?>
<?php $assistant_director_hradmin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$assistant_director_hradmin_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$assistant_director_hradmin_list->isExport() && !$assistant_director_hradmin->CurrentAction) { ?>
<form name="fassistant_director_hradminlistsrch" id="fassistant_director_hradminlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fassistant_director_hradminlistsrch-search-panel" class="<?php echo $assistant_director_hradmin_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="assistant_director_hradmin">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $assistant_director_hradmin_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($assistant_director_hradmin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($assistant_director_hradmin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $assistant_director_hradmin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($assistant_director_hradmin_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($assistant_director_hradmin_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($assistant_director_hradmin_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($assistant_director_hradmin_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $assistant_director_hradmin_list->showPageHeader(); ?>
<?php
$assistant_director_hradmin_list->showMessage();
?>
<?php if ($assistant_director_hradmin_list->TotalRecords > 0 || $assistant_director_hradmin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($assistant_director_hradmin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> assistant_director_hradmin">
<?php if (!$assistant_director_hradmin_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$assistant_director_hradmin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $assistant_director_hradmin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $assistant_director_hradmin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fassistant_director_hradminlist" id="fassistant_director_hradminlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="assistant_director_hradmin">
<div id="gmp_assistant_director_hradmin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($assistant_director_hradmin_list->TotalRecords > 0 || $assistant_director_hradmin_list->isGridEdit()) { ?>
<table id="tbl_assistant_director_hradminlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$assistant_director_hradmin->RowType = ROWTYPE_HEADER;

// Render list options
$assistant_director_hradmin_list->renderListOptions();

// Render list options (header, left)
$assistant_director_hradmin_list->ListOptions->render("header", "left");
?>
<?php if ($assistant_director_hradmin_list->TownOrVillage->Visible) { // TownOrVillage ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->TownOrVillage) == "") { ?>
		<th data-name="TownOrVillage" class="<?php echo $assistant_director_hradmin_list->TownOrVillage->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_TownOrVillage" class="assistant_director_hradmin_TownOrVillage"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->TownOrVillage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TownOrVillage" class="<?php echo $assistant_director_hradmin_list->TownOrVillage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->TownOrVillage) ?>', 1);"><div id="elh_assistant_director_hradmin_TownOrVillage" class="assistant_director_hradmin_TownOrVillage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->TownOrVillage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->TownOrVillage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->TownOrVillage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->FirstName->Visible) { // FirstName ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $assistant_director_hradmin_list->FirstName->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_FirstName" class="assistant_director_hradmin_FirstName"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $assistant_director_hradmin_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->FirstName) ?>', 1);"><div id="elh_assistant_director_hradmin_FirstName" class="assistant_director_hradmin_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $assistant_director_hradmin_list->MiddleName->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_MiddleName" class="assistant_director_hradmin_MiddleName"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $assistant_director_hradmin_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->MiddleName) ?>', 1);"><div id="elh_assistant_director_hradmin_MiddleName" class="assistant_director_hradmin_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->Surname->Visible) { // Surname ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $assistant_director_hradmin_list->Surname->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_Surname" class="assistant_director_hradmin_Surname"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $assistant_director_hradmin_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->Surname) ?>', 1);"><div id="elh_assistant_director_hradmin_Surname" class="assistant_director_hradmin_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->Sex->Visible) { // Sex ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $assistant_director_hradmin_list->Sex->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_Sex" class="assistant_director_hradmin_Sex"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $assistant_director_hradmin_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->Sex) ?>', 1);"><div id="elh_assistant_director_hradmin_Sex" class="assistant_director_hradmin_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $assistant_director_hradmin_list->DateOfBirth->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_DateOfBirth" class="assistant_director_hradmin_DateOfBirth"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $assistant_director_hradmin_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->DateOfBirth) ?>', 1);"><div id="elh_assistant_director_hradmin_DateOfBirth" class="assistant_director_hradmin_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->DateOfCurrentAppointment) == "") { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $assistant_director_hradmin_list->DateOfCurrentAppointment->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_DateOfCurrentAppointment" class="assistant_director_hradmin_DateOfCurrentAppointment"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->DateOfCurrentAppointment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $assistant_director_hradmin_list->DateOfCurrentAppointment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->DateOfCurrentAppointment) ?>', 1);"><div id="elh_assistant_director_hradmin_DateOfCurrentAppointment" class="assistant_director_hradmin_DateOfCurrentAppointment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->DateOfCurrentAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->DateOfCurrentAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->DateOfCurrentAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->DateOfConfirmation) == "") { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $assistant_director_hradmin_list->DateOfConfirmation->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_DateOfConfirmation" class="assistant_director_hradmin_DateOfConfirmation"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->DateOfConfirmation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $assistant_director_hradmin_list->DateOfConfirmation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->DateOfConfirmation) ?>', 1);"><div id="elh_assistant_director_hradmin_DateOfConfirmation" class="assistant_director_hradmin_DateOfConfirmation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->DateOfConfirmation->caption() ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->DateOfConfirmation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->DateOfConfirmation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->AcademicQualification->Visible) { // AcademicQualification ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->AcademicQualification) == "") { ?>
		<th data-name="AcademicQualification" class="<?php echo $assistant_director_hradmin_list->AcademicQualification->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_AcademicQualification" class="assistant_director_hradmin_AcademicQualification"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->AcademicQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AcademicQualification" class="<?php echo $assistant_director_hradmin_list->AcademicQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->AcademicQualification) ?>', 1);"><div id="elh_assistant_director_hradmin_AcademicQualification" class="assistant_director_hradmin_AcademicQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->AcademicQualification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->AcademicQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->AcademicQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->ProfessionalQualification) == "") { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $assistant_director_hradmin_list->ProfessionalQualification->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_ProfessionalQualification" class="assistant_director_hradmin_ProfessionalQualification"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->ProfessionalQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $assistant_director_hradmin_list->ProfessionalQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->ProfessionalQualification) ?>', 1);"><div id="elh_assistant_director_hradmin_ProfessionalQualification" class="assistant_director_hradmin_ProfessionalQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->ProfessionalQualification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->ProfessionalQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->ProfessionalQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($assistant_director_hradmin_list->LengthOfStay->Visible) { // LengthOfStay ?>
	<?php if ($assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->LengthOfStay) == "") { ?>
		<th data-name="LengthOfStay" class="<?php echo $assistant_director_hradmin_list->LengthOfStay->headerCellClass() ?>"><div id="elh_assistant_director_hradmin_LengthOfStay" class="assistant_director_hradmin_LengthOfStay"><div class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->LengthOfStay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LengthOfStay" class="<?php echo $assistant_director_hradmin_list->LengthOfStay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $assistant_director_hradmin_list->SortUrl($assistant_director_hradmin_list->LengthOfStay) ?>', 1);"><div id="elh_assistant_director_hradmin_LengthOfStay" class="assistant_director_hradmin_LengthOfStay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $assistant_director_hradmin_list->LengthOfStay->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($assistant_director_hradmin_list->LengthOfStay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($assistant_director_hradmin_list->LengthOfStay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$assistant_director_hradmin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($assistant_director_hradmin_list->ExportAll && $assistant_director_hradmin_list->isExport()) {
	$assistant_director_hradmin_list->StopRecord = $assistant_director_hradmin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($assistant_director_hradmin_list->TotalRecords > $assistant_director_hradmin_list->StartRecord + $assistant_director_hradmin_list->DisplayRecords - 1)
		$assistant_director_hradmin_list->StopRecord = $assistant_director_hradmin_list->StartRecord + $assistant_director_hradmin_list->DisplayRecords - 1;
	else
		$assistant_director_hradmin_list->StopRecord = $assistant_director_hradmin_list->TotalRecords;
}
$assistant_director_hradmin_list->RecordCount = $assistant_director_hradmin_list->StartRecord - 1;
if ($assistant_director_hradmin_list->Recordset && !$assistant_director_hradmin_list->Recordset->EOF) {
	$assistant_director_hradmin_list->Recordset->moveFirst();
	$selectLimit = $assistant_director_hradmin_list->UseSelectLimit;
	if (!$selectLimit && $assistant_director_hradmin_list->StartRecord > 1)
		$assistant_director_hradmin_list->Recordset->move($assistant_director_hradmin_list->StartRecord - 1);
} elseif (!$assistant_director_hradmin->AllowAddDeleteRow && $assistant_director_hradmin_list->StopRecord == 0) {
	$assistant_director_hradmin_list->StopRecord = $assistant_director_hradmin->GridAddRowCount;
}

// Initialize aggregate
$assistant_director_hradmin->RowType = ROWTYPE_AGGREGATEINIT;
$assistant_director_hradmin->resetAttributes();
$assistant_director_hradmin_list->renderRow();
while ($assistant_director_hradmin_list->RecordCount < $assistant_director_hradmin_list->StopRecord) {
	$assistant_director_hradmin_list->RecordCount++;
	if ($assistant_director_hradmin_list->RecordCount >= $assistant_director_hradmin_list->StartRecord) {
		$assistant_director_hradmin_list->RowCount++;

		// Set up key count
		$assistant_director_hradmin_list->KeyCount = $assistant_director_hradmin_list->RowIndex;

		// Init row class and style
		$assistant_director_hradmin->resetAttributes();
		$assistant_director_hradmin->CssClass = "";
		if ($assistant_director_hradmin_list->isGridAdd()) {
		} else {
			$assistant_director_hradmin_list->loadRowValues($assistant_director_hradmin_list->Recordset); // Load row values
		}
		$assistant_director_hradmin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$assistant_director_hradmin->RowAttrs->merge(["data-rowindex" => $assistant_director_hradmin_list->RowCount, "id" => "r" . $assistant_director_hradmin_list->RowCount . "_assistant_director_hradmin", "data-rowtype" => $assistant_director_hradmin->RowType]);

		// Render row
		$assistant_director_hradmin_list->renderRow();

		// Render list options
		$assistant_director_hradmin_list->renderListOptions();
?>
	<tr <?php echo $assistant_director_hradmin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$assistant_director_hradmin_list->ListOptions->render("body", "left", $assistant_director_hradmin_list->RowCount);
?>
	<?php if ($assistant_director_hradmin_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage" <?php echo $assistant_director_hradmin_list->TownOrVillage->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_TownOrVillage">
<span<?php echo $assistant_director_hradmin_list->TownOrVillage->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $assistant_director_hradmin_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_FirstName">
<span<?php echo $assistant_director_hradmin_list->FirstName->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $assistant_director_hradmin_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_MiddleName">
<span<?php echo $assistant_director_hradmin_list->MiddleName->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $assistant_director_hradmin_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_Surname">
<span<?php echo $assistant_director_hradmin_list->Surname->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $assistant_director_hradmin_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_Sex">
<span<?php echo $assistant_director_hradmin_list->Sex->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $assistant_director_hradmin_list->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_DateOfBirth">
<span<?php echo $assistant_director_hradmin_list->DateOfBirth->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td data-name="DateOfCurrentAppointment" <?php echo $assistant_director_hradmin_list->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_DateOfCurrentAppointment">
<span<?php echo $assistant_director_hradmin_list->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<td data-name="DateOfConfirmation" <?php echo $assistant_director_hradmin_list->DateOfConfirmation->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_DateOfConfirmation">
<span<?php echo $assistant_director_hradmin_list->DateOfConfirmation->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->DateOfConfirmation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->AcademicQualification->Visible) { // AcademicQualification ?>
		<td data-name="AcademicQualification" <?php echo $assistant_director_hradmin_list->AcademicQualification->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_AcademicQualification">
<span<?php echo $assistant_director_hradmin_list->AcademicQualification->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->AcademicQualification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
		<td data-name="ProfessionalQualification" <?php echo $assistant_director_hradmin_list->ProfessionalQualification->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_ProfessionalQualification">
<span<?php echo $assistant_director_hradmin_list->ProfessionalQualification->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->ProfessionalQualification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($assistant_director_hradmin_list->LengthOfStay->Visible) { // LengthOfStay ?>
		<td data-name="LengthOfStay" <?php echo $assistant_director_hradmin_list->LengthOfStay->cellAttributes() ?>>
<span id="el<?php echo $assistant_director_hradmin_list->RowCount ?>_assistant_director_hradmin_LengthOfStay">
<span<?php echo $assistant_director_hradmin_list->LengthOfStay->viewAttributes() ?>><?php echo $assistant_director_hradmin_list->LengthOfStay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$assistant_director_hradmin_list->ListOptions->render("body", "right", $assistant_director_hradmin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$assistant_director_hradmin_list->isGridAdd())
		$assistant_director_hradmin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$assistant_director_hradmin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($assistant_director_hradmin_list->Recordset)
	$assistant_director_hradmin_list->Recordset->Close();
?>
<?php if (!$assistant_director_hradmin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$assistant_director_hradmin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $assistant_director_hradmin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $assistant_director_hradmin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($assistant_director_hradmin_list->TotalRecords == 0 && !$assistant_director_hradmin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $assistant_director_hradmin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$assistant_director_hradmin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$assistant_director_hradmin_list->isExport()) { ?>
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
$assistant_director_hradmin_list->terminate();
?>