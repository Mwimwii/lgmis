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
$deputy_council_secretary_list = new deputy_council_secretary_list();

// Run the page
$deputy_council_secretary_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deputy_council_secretary_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$deputy_council_secretary_list->isExport()) { ?>
<script>
var fdeputy_council_secretarylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdeputy_council_secretarylist = currentForm = new ew.Form("fdeputy_council_secretarylist", "list");
	fdeputy_council_secretarylist.formKeyCountName = '<?php echo $deputy_council_secretary_list->FormKeyCountName ?>';
	loadjs.done("fdeputy_council_secretarylist");
});
var fdeputy_council_secretarylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdeputy_council_secretarylistsrch = currentSearchForm = new ew.Form("fdeputy_council_secretarylistsrch");

	// Dynamic selection lists
	// Filters

	fdeputy_council_secretarylistsrch.filterList = <?php echo $deputy_council_secretary_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdeputy_council_secretarylistsrch.initSearchPanel = true;
	loadjs.done("fdeputy_council_secretarylistsrch");
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
<?php if (!$deputy_council_secretary_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($deputy_council_secretary_list->TotalRecords > 0 && $deputy_council_secretary_list->ExportOptions->visible()) { ?>
<?php $deputy_council_secretary_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->ImportOptions->visible()) { ?>
<?php $deputy_council_secretary_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->SearchOptions->visible()) { ?>
<?php $deputy_council_secretary_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->FilterOptions->visible()) { ?>
<?php $deputy_council_secretary_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$deputy_council_secretary_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$deputy_council_secretary_list->isExport() && !$deputy_council_secretary->CurrentAction) { ?>
<form name="fdeputy_council_secretarylistsrch" id="fdeputy_council_secretarylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdeputy_council_secretarylistsrch-search-panel" class="<?php echo $deputy_council_secretary_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="deputy_council_secretary">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $deputy_council_secretary_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($deputy_council_secretary_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($deputy_council_secretary_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $deputy_council_secretary_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($deputy_council_secretary_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($deputy_council_secretary_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($deputy_council_secretary_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($deputy_council_secretary_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $deputy_council_secretary_list->showPageHeader(); ?>
<?php
$deputy_council_secretary_list->showMessage();
?>
<?php if ($deputy_council_secretary_list->TotalRecords > 0 || $deputy_council_secretary->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($deputy_council_secretary_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> deputy_council_secretary">
<?php if (!$deputy_council_secretary_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$deputy_council_secretary_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deputy_council_secretary_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deputy_council_secretary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdeputy_council_secretarylist" id="fdeputy_council_secretarylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deputy_council_secretary">
<div id="gmp_deputy_council_secretary" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($deputy_council_secretary_list->TotalRecords > 0 || $deputy_council_secretary_list->isGridEdit()) { ?>
<table id="tbl_deputy_council_secretarylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$deputy_council_secretary->RowType = ROWTYPE_HEADER;

// Render list options
$deputy_council_secretary_list->renderListOptions();

// Render list options (header, left)
$deputy_council_secretary_list->ListOptions->render("header", "left");
?>
<?php if ($deputy_council_secretary_list->TownOrVillage->Visible) { // TownOrVillage ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->TownOrVillage) == "") { ?>
		<th data-name="TownOrVillage" class="<?php echo $deputy_council_secretary_list->TownOrVillage->headerCellClass() ?>"><div id="elh_deputy_council_secretary_TownOrVillage" class="deputy_council_secretary_TownOrVillage"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->TownOrVillage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TownOrVillage" class="<?php echo $deputy_council_secretary_list->TownOrVillage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->TownOrVillage) ?>', 1);"><div id="elh_deputy_council_secretary_TownOrVillage" class="deputy_council_secretary_TownOrVillage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->TownOrVillage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->TownOrVillage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->TownOrVillage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->FirstName->Visible) { // FirstName ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $deputy_council_secretary_list->FirstName->headerCellClass() ?>"><div id="elh_deputy_council_secretary_FirstName" class="deputy_council_secretary_FirstName"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $deputy_council_secretary_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->FirstName) ?>', 1);"><div id="elh_deputy_council_secretary_FirstName" class="deputy_council_secretary_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $deputy_council_secretary_list->MiddleName->headerCellClass() ?>"><div id="elh_deputy_council_secretary_MiddleName" class="deputy_council_secretary_MiddleName"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $deputy_council_secretary_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->MiddleName) ?>', 1);"><div id="elh_deputy_council_secretary_MiddleName" class="deputy_council_secretary_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->Surname->Visible) { // Surname ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $deputy_council_secretary_list->Surname->headerCellClass() ?>"><div id="elh_deputy_council_secretary_Surname" class="deputy_council_secretary_Surname"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $deputy_council_secretary_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->Surname) ?>', 1);"><div id="elh_deputy_council_secretary_Surname" class="deputy_council_secretary_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->Sex->Visible) { // Sex ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $deputy_council_secretary_list->Sex->headerCellClass() ?>"><div id="elh_deputy_council_secretary_Sex" class="deputy_council_secretary_Sex"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $deputy_council_secretary_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->Sex) ?>', 1);"><div id="elh_deputy_council_secretary_Sex" class="deputy_council_secretary_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $deputy_council_secretary_list->DateOfBirth->headerCellClass() ?>"><div id="elh_deputy_council_secretary_DateOfBirth" class="deputy_council_secretary_DateOfBirth"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $deputy_council_secretary_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->DateOfBirth) ?>', 1);"><div id="elh_deputy_council_secretary_DateOfBirth" class="deputy_council_secretary_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->DateOfCurrentAppointment) == "") { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $deputy_council_secretary_list->DateOfCurrentAppointment->headerCellClass() ?>"><div id="elh_deputy_council_secretary_DateOfCurrentAppointment" class="deputy_council_secretary_DateOfCurrentAppointment"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->DateOfCurrentAppointment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfCurrentAppointment" class="<?php echo $deputy_council_secretary_list->DateOfCurrentAppointment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->DateOfCurrentAppointment) ?>', 1);"><div id="elh_deputy_council_secretary_DateOfCurrentAppointment" class="deputy_council_secretary_DateOfCurrentAppointment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->DateOfCurrentAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->DateOfCurrentAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->DateOfCurrentAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->DateOfConfirmation) == "") { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $deputy_council_secretary_list->DateOfConfirmation->headerCellClass() ?>"><div id="elh_deputy_council_secretary_DateOfConfirmation" class="deputy_council_secretary_DateOfConfirmation"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->DateOfConfirmation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfConfirmation" class="<?php echo $deputy_council_secretary_list->DateOfConfirmation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->DateOfConfirmation) ?>', 1);"><div id="elh_deputy_council_secretary_DateOfConfirmation" class="deputy_council_secretary_DateOfConfirmation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->DateOfConfirmation->caption() ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->DateOfConfirmation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->DateOfConfirmation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->AcademicQualification->Visible) { // AcademicQualification ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->AcademicQualification) == "") { ?>
		<th data-name="AcademicQualification" class="<?php echo $deputy_council_secretary_list->AcademicQualification->headerCellClass() ?>"><div id="elh_deputy_council_secretary_AcademicQualification" class="deputy_council_secretary_AcademicQualification"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->AcademicQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AcademicQualification" class="<?php echo $deputy_council_secretary_list->AcademicQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->AcademicQualification) ?>', 1);"><div id="elh_deputy_council_secretary_AcademicQualification" class="deputy_council_secretary_AcademicQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->AcademicQualification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->AcademicQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->AcademicQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->ProfessionalQualification) == "") { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $deputy_council_secretary_list->ProfessionalQualification->headerCellClass() ?>"><div id="elh_deputy_council_secretary_ProfessionalQualification" class="deputy_council_secretary_ProfessionalQualification"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->ProfessionalQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalQualification" class="<?php echo $deputy_council_secretary_list->ProfessionalQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->ProfessionalQualification) ?>', 1);"><div id="elh_deputy_council_secretary_ProfessionalQualification" class="deputy_council_secretary_ProfessionalQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->ProfessionalQualification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->ProfessionalQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->ProfessionalQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deputy_council_secretary_list->LengthOfStay->Visible) { // LengthOfStay ?>
	<?php if ($deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->LengthOfStay) == "") { ?>
		<th data-name="LengthOfStay" class="<?php echo $deputy_council_secretary_list->LengthOfStay->headerCellClass() ?>"><div id="elh_deputy_council_secretary_LengthOfStay" class="deputy_council_secretary_LengthOfStay"><div class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->LengthOfStay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LengthOfStay" class="<?php echo $deputy_council_secretary_list->LengthOfStay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deputy_council_secretary_list->SortUrl($deputy_council_secretary_list->LengthOfStay) ?>', 1);"><div id="elh_deputy_council_secretary_LengthOfStay" class="deputy_council_secretary_LengthOfStay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deputy_council_secretary_list->LengthOfStay->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deputy_council_secretary_list->LengthOfStay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deputy_council_secretary_list->LengthOfStay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$deputy_council_secretary_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($deputy_council_secretary_list->ExportAll && $deputy_council_secretary_list->isExport()) {
	$deputy_council_secretary_list->StopRecord = $deputy_council_secretary_list->TotalRecords;
} else {

	// Set the last record to display
	if ($deputy_council_secretary_list->TotalRecords > $deputy_council_secretary_list->StartRecord + $deputy_council_secretary_list->DisplayRecords - 1)
		$deputy_council_secretary_list->StopRecord = $deputy_council_secretary_list->StartRecord + $deputy_council_secretary_list->DisplayRecords - 1;
	else
		$deputy_council_secretary_list->StopRecord = $deputy_council_secretary_list->TotalRecords;
}
$deputy_council_secretary_list->RecordCount = $deputy_council_secretary_list->StartRecord - 1;
if ($deputy_council_secretary_list->Recordset && !$deputy_council_secretary_list->Recordset->EOF) {
	$deputy_council_secretary_list->Recordset->moveFirst();
	$selectLimit = $deputy_council_secretary_list->UseSelectLimit;
	if (!$selectLimit && $deputy_council_secretary_list->StartRecord > 1)
		$deputy_council_secretary_list->Recordset->move($deputy_council_secretary_list->StartRecord - 1);
} elseif (!$deputy_council_secretary->AllowAddDeleteRow && $deputy_council_secretary_list->StopRecord == 0) {
	$deputy_council_secretary_list->StopRecord = $deputy_council_secretary->GridAddRowCount;
}

// Initialize aggregate
$deputy_council_secretary->RowType = ROWTYPE_AGGREGATEINIT;
$deputy_council_secretary->resetAttributes();
$deputy_council_secretary_list->renderRow();
while ($deputy_council_secretary_list->RecordCount < $deputy_council_secretary_list->StopRecord) {
	$deputy_council_secretary_list->RecordCount++;
	if ($deputy_council_secretary_list->RecordCount >= $deputy_council_secretary_list->StartRecord) {
		$deputy_council_secretary_list->RowCount++;

		// Set up key count
		$deputy_council_secretary_list->KeyCount = $deputy_council_secretary_list->RowIndex;

		// Init row class and style
		$deputy_council_secretary->resetAttributes();
		$deputy_council_secretary->CssClass = "";
		if ($deputy_council_secretary_list->isGridAdd()) {
		} else {
			$deputy_council_secretary_list->loadRowValues($deputy_council_secretary_list->Recordset); // Load row values
		}
		$deputy_council_secretary->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$deputy_council_secretary->RowAttrs->merge(["data-rowindex" => $deputy_council_secretary_list->RowCount, "id" => "r" . $deputy_council_secretary_list->RowCount . "_deputy_council_secretary", "data-rowtype" => $deputy_council_secretary->RowType]);

		// Render row
		$deputy_council_secretary_list->renderRow();

		// Render list options
		$deputy_council_secretary_list->renderListOptions();
?>
	<tr <?php echo $deputy_council_secretary->rowAttributes() ?>>
<?php

// Render list options (body, left)
$deputy_council_secretary_list->ListOptions->render("body", "left", $deputy_council_secretary_list->RowCount);
?>
	<?php if ($deputy_council_secretary_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage" <?php echo $deputy_council_secretary_list->TownOrVillage->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_TownOrVillage">
<span<?php echo $deputy_council_secretary_list->TownOrVillage->viewAttributes() ?>><?php echo $deputy_council_secretary_list->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $deputy_council_secretary_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_FirstName">
<span<?php echo $deputy_council_secretary_list->FirstName->viewAttributes() ?>><?php echo $deputy_council_secretary_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $deputy_council_secretary_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_MiddleName">
<span<?php echo $deputy_council_secretary_list->MiddleName->viewAttributes() ?>><?php echo $deputy_council_secretary_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $deputy_council_secretary_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_Surname">
<span<?php echo $deputy_council_secretary_list->Surname->viewAttributes() ?>><?php echo $deputy_council_secretary_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $deputy_council_secretary_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_Sex">
<span<?php echo $deputy_council_secretary_list->Sex->viewAttributes() ?>><?php echo $deputy_council_secretary_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $deputy_council_secretary_list->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_DateOfBirth">
<span<?php echo $deputy_council_secretary_list->DateOfBirth->viewAttributes() ?>><?php echo $deputy_council_secretary_list->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->DateOfCurrentAppointment->Visible) { // DateOfCurrentAppointment ?>
		<td data-name="DateOfCurrentAppointment" <?php echo $deputy_council_secretary_list->DateOfCurrentAppointment->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_DateOfCurrentAppointment">
<span<?php echo $deputy_council_secretary_list->DateOfCurrentAppointment->viewAttributes() ?>><?php echo $deputy_council_secretary_list->DateOfCurrentAppointment->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->DateOfConfirmation->Visible) { // DateOfConfirmation ?>
		<td data-name="DateOfConfirmation" <?php echo $deputy_council_secretary_list->DateOfConfirmation->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_DateOfConfirmation">
<span<?php echo $deputy_council_secretary_list->DateOfConfirmation->viewAttributes() ?>><?php echo $deputy_council_secretary_list->DateOfConfirmation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->AcademicQualification->Visible) { // AcademicQualification ?>
		<td data-name="AcademicQualification" <?php echo $deputy_council_secretary_list->AcademicQualification->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_AcademicQualification">
<span<?php echo $deputy_council_secretary_list->AcademicQualification->viewAttributes() ?>><?php echo $deputy_council_secretary_list->AcademicQualification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
		<td data-name="ProfessionalQualification" <?php echo $deputy_council_secretary_list->ProfessionalQualification->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_ProfessionalQualification">
<span<?php echo $deputy_council_secretary_list->ProfessionalQualification->viewAttributes() ?>><?php echo $deputy_council_secretary_list->ProfessionalQualification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deputy_council_secretary_list->LengthOfStay->Visible) { // LengthOfStay ?>
		<td data-name="LengthOfStay" <?php echo $deputy_council_secretary_list->LengthOfStay->cellAttributes() ?>>
<span id="el<?php echo $deputy_council_secretary_list->RowCount ?>_deputy_council_secretary_LengthOfStay">
<span<?php echo $deputy_council_secretary_list->LengthOfStay->viewAttributes() ?>><?php echo $deputy_council_secretary_list->LengthOfStay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deputy_council_secretary_list->ListOptions->render("body", "right", $deputy_council_secretary_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$deputy_council_secretary_list->isGridAdd())
		$deputy_council_secretary_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$deputy_council_secretary->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($deputy_council_secretary_list->Recordset)
	$deputy_council_secretary_list->Recordset->Close();
?>
<?php if (!$deputy_council_secretary_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$deputy_council_secretary_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deputy_council_secretary_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deputy_council_secretary_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($deputy_council_secretary_list->TotalRecords == 0 && !$deputy_council_secretary->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $deputy_council_secretary_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$deputy_council_secretary_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$deputy_council_secretary_list->isExport()) { ?>
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
$deputy_council_secretary_list->terminate();
?>