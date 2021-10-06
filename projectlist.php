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
$project_list = new project_list();

// Run the page
$project_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$project_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$project_list->isExport()) { ?>
<script>
var fprojectlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprojectlist = currentForm = new ew.Form("fprojectlist", "list");
	fprojectlist.formKeyCountName = '<?php echo $project_list->FormKeyCountName ?>';
	loadjs.done("fprojectlist");
});
var fprojectlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprojectlistsrch = currentSearchForm = new ew.Form("fprojectlistsrch");

	// Dynamic selection lists
	// Filters

	fprojectlistsrch.filterList = <?php echo $project_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprojectlistsrch.initSearchPanel = true;
	loadjs.done("fprojectlistsrch");
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
<?php if (!$project_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($project_list->TotalRecords > 0 && $project_list->ExportOptions->visible()) { ?>
<?php $project_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($project_list->ImportOptions->visible()) { ?>
<?php $project_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($project_list->SearchOptions->visible()) { ?>
<?php $project_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($project_list->FilterOptions->visible()) { ?>
<?php $project_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$project_list->isExport() || Config("EXPORT_MASTER_RECORD") && $project_list->isExport("print")) { ?>
<?php
if ($project_list->DbMasterFilter != "" && $project->getCurrentMasterTable() == "local_authority") {
	if ($project_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$project_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$project_list->isExport() && !$project->CurrentAction) { ?>
<form name="fprojectlistsrch" id="fprojectlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprojectlistsrch-search-panel" class="<?php echo $project_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="project">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $project_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($project_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($project_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $project_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($project_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($project_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($project_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($project_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $project_list->showPageHeader(); ?>
<?php
$project_list->showMessage();
?>
<?php if ($project_list->TotalRecords > 0 || $project->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($project_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> project">
<?php if (!$project_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$project_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprojectlist" id="fprojectlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="project">
<?php if ($project->getCurrentMasterTable() == "local_authority" && $project->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($project_list->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($project_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_project" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($project_list->TotalRecords > 0 || $project_list->isGridEdit()) { ?>
<table id="tbl_projectlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$project->RowType = ROWTYPE_HEADER;

// Render list options
$project_list->renderListOptions();

// Render list options (header, left)
$project_list->ListOptions->render("header", "left");
?>
<?php if ($project_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($project_list->SortUrl($project_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $project_list->ProvinceCode->headerCellClass() ?>"><div id="elh_project_ProvinceCode" class="project_ProvinceCode"><div class="ew-table-header-caption"><?php echo $project_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $project_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ProvinceCode) ?>', 1);"><div id="elh_project_ProvinceCode" class="project_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->LACode->Visible) { // LACode ?>
	<?php if ($project_list->SortUrl($project_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $project_list->LACode->headerCellClass() ?>"><div id="elh_project_LACode" class="project_LACode"><div class="ew-table-header-caption"><?php echo $project_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $project_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->LACode) ?>', 1);"><div id="elh_project_LACode" class="project_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($project_list->SortUrl($project_list->ProjectCode) == "") { ?>
		<th data-name="ProjectCode" class="<?php echo $project_list->ProjectCode->headerCellClass() ?>"><div id="elh_project_ProjectCode" class="project_ProjectCode"><div class="ew-table-header-caption"><?php echo $project_list->ProjectCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectCode" class="<?php echo $project_list->ProjectCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ProjectCode) ?>', 1);"><div id="elh_project_ProjectCode" class="project_ProjectCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ProjectCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_list->ProjectCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ProjectCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->ProjectName->Visible) { // ProjectName ?>
	<?php if ($project_list->SortUrl($project_list->ProjectName) == "") { ?>
		<th data-name="ProjectName" class="<?php echo $project_list->ProjectName->headerCellClass() ?>"><div id="elh_project_ProjectName" class="project_ProjectName"><div class="ew-table-header-caption"><?php echo $project_list->ProjectName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectName" class="<?php echo $project_list->ProjectName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ProjectName) ?>', 1);"><div id="elh_project_ProjectName" class="project_ProjectName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ProjectName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_list->ProjectName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ProjectName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->ProjectType->Visible) { // ProjectType ?>
	<?php if ($project_list->SortUrl($project_list->ProjectType) == "") { ?>
		<th data-name="ProjectType" class="<?php echo $project_list->ProjectType->headerCellClass() ?>"><div id="elh_project_ProjectType" class="project_ProjectType"><div class="ew-table-header-caption"><?php echo $project_list->ProjectType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectType" class="<?php echo $project_list->ProjectType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ProjectType) ?>', 1);"><div id="elh_project_ProjectType" class="project_ProjectType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ProjectType->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->ProjectType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ProjectType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->ProjectSector->Visible) { // ProjectSector ?>
	<?php if ($project_list->SortUrl($project_list->ProjectSector) == "") { ?>
		<th data-name="ProjectSector" class="<?php echo $project_list->ProjectSector->headerCellClass() ?>"><div id="elh_project_ProjectSector" class="project_ProjectSector"><div class="ew-table-header-caption"><?php echo $project_list->ProjectSector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectSector" class="<?php echo $project_list->ProjectSector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ProjectSector) ?>', 1);"><div id="elh_project_ProjectSector" class="project_ProjectSector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ProjectSector->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->ProjectSector->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ProjectSector->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->Contractors->Visible) { // Contractors ?>
	<?php if ($project_list->SortUrl($project_list->Contractors) == "") { ?>
		<th data-name="Contractors" class="<?php echo $project_list->Contractors->headerCellClass() ?>"><div id="elh_project_Contractors" class="project_Contractors"><div class="ew-table-header-caption"><?php echo $project_list->Contractors->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Contractors" class="<?php echo $project_list->Contractors->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->Contractors) ?>', 1);"><div id="elh_project_Contractors" class="project_Contractors">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->Contractors->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_list->Contractors->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->Contractors->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($project_list->SortUrl($project_list->PlannedStartDate) == "") { ?>
		<th data-name="PlannedStartDate" class="<?php echo $project_list->PlannedStartDate->headerCellClass() ?>"><div id="elh_project_PlannedStartDate" class="project_PlannedStartDate"><div class="ew-table-header-caption"><?php echo $project_list->PlannedStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedStartDate" class="<?php echo $project_list->PlannedStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->PlannedStartDate) ?>', 1);"><div id="elh_project_PlannedStartDate" class="project_PlannedStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->PlannedStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->PlannedStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($project_list->SortUrl($project_list->PlannedEndDate) == "") { ?>
		<th data-name="PlannedEndDate" class="<?php echo $project_list->PlannedEndDate->headerCellClass() ?>"><div id="elh_project_PlannedEndDate" class="project_PlannedEndDate"><div class="ew-table-header-caption"><?php echo $project_list->PlannedEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedEndDate" class="<?php echo $project_list->PlannedEndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->PlannedEndDate) ?>', 1);"><div id="elh_project_PlannedEndDate" class="project_PlannedEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->PlannedEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->PlannedEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($project_list->SortUrl($project_list->ActualStartDate) == "") { ?>
		<th data-name="ActualStartDate" class="<?php echo $project_list->ActualStartDate->headerCellClass() ?>"><div id="elh_project_ActualStartDate" class="project_ActualStartDate"><div class="ew-table-header-caption"><?php echo $project_list->ActualStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualStartDate" class="<?php echo $project_list->ActualStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ActualStartDate) ?>', 1);"><div id="elh_project_ActualStartDate" class="project_ActualStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->ActualStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ActualStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->ActualEndDate->Visible) { // ActualEndDate ?>
	<?php if ($project_list->SortUrl($project_list->ActualEndDate) == "") { ?>
		<th data-name="ActualEndDate" class="<?php echo $project_list->ActualEndDate->headerCellClass() ?>"><div id="elh_project_ActualEndDate" class="project_ActualEndDate"><div class="ew-table-header-caption"><?php echo $project_list->ActualEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualEndDate" class="<?php echo $project_list->ActualEndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ActualEndDate) ?>', 1);"><div id="elh_project_ActualEndDate" class="project_ActualEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ActualEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->ActualEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ActualEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->Budget->Visible) { // Budget ?>
	<?php if ($project_list->SortUrl($project_list->Budget) == "") { ?>
		<th data-name="Budget" class="<?php echo $project_list->Budget->headerCellClass() ?>"><div id="elh_project_Budget" class="project_Budget"><div class="ew-table-header-caption"><?php echo $project_list->Budget->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Budget" class="<?php echo $project_list->Budget->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->Budget) ?>', 1);"><div id="elh_project_Budget" class="project_Budget">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->Budget->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->Budget->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->Budget->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->ProgressStatus->Visible) { // ProgressStatus ?>
	<?php if ($project_list->SortUrl($project_list->ProgressStatus) == "") { ?>
		<th data-name="ProgressStatus" class="<?php echo $project_list->ProgressStatus->headerCellClass() ?>"><div id="elh_project_ProgressStatus" class="project_ProgressStatus"><div class="ew-table-header-caption"><?php echo $project_list->ProgressStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgressStatus" class="<?php echo $project_list->ProgressStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->ProgressStatus) ?>', 1);"><div id="elh_project_ProgressStatus" class="project_ProgressStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->ProgressStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($project_list->ProgressStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->ProgressStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($project_list->OutstandingTasks->Visible) { // OutstandingTasks ?>
	<?php if ($project_list->SortUrl($project_list->OutstandingTasks) == "") { ?>
		<th data-name="OutstandingTasks" class="<?php echo $project_list->OutstandingTasks->headerCellClass() ?>"><div id="elh_project_OutstandingTasks" class="project_OutstandingTasks"><div class="ew-table-header-caption"><?php echo $project_list->OutstandingTasks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OutstandingTasks" class="<?php echo $project_list->OutstandingTasks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $project_list->SortUrl($project_list->OutstandingTasks) ?>', 1);"><div id="elh_project_OutstandingTasks" class="project_OutstandingTasks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $project_list->OutstandingTasks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($project_list->OutstandingTasks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($project_list->OutstandingTasks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$project_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($project_list->ExportAll && $project_list->isExport()) {
	$project_list->StopRecord = $project_list->TotalRecords;
} else {

	// Set the last record to display
	if ($project_list->TotalRecords > $project_list->StartRecord + $project_list->DisplayRecords - 1)
		$project_list->StopRecord = $project_list->StartRecord + $project_list->DisplayRecords - 1;
	else
		$project_list->StopRecord = $project_list->TotalRecords;
}
$project_list->RecordCount = $project_list->StartRecord - 1;
if ($project_list->Recordset && !$project_list->Recordset->EOF) {
	$project_list->Recordset->moveFirst();
	$selectLimit = $project_list->UseSelectLimit;
	if (!$selectLimit && $project_list->StartRecord > 1)
		$project_list->Recordset->move($project_list->StartRecord - 1);
} elseif (!$project->AllowAddDeleteRow && $project_list->StopRecord == 0) {
	$project_list->StopRecord = $project->GridAddRowCount;
}

// Initialize aggregate
$project->RowType = ROWTYPE_AGGREGATEINIT;
$project->resetAttributes();
$project_list->renderRow();
while ($project_list->RecordCount < $project_list->StopRecord) {
	$project_list->RecordCount++;
	if ($project_list->RecordCount >= $project_list->StartRecord) {
		$project_list->RowCount++;

		// Set up key count
		$project_list->KeyCount = $project_list->RowIndex;

		// Init row class and style
		$project->resetAttributes();
		$project->CssClass = "";
		if ($project_list->isGridAdd()) {
		} else {
			$project_list->loadRowValues($project_list->Recordset); // Load row values
		}
		$project->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$project->RowAttrs->merge(["data-rowindex" => $project_list->RowCount, "id" => "r" . $project_list->RowCount . "_project", "data-rowtype" => $project->RowType]);

		// Render row
		$project_list->renderRow();

		// Render list options
		$project_list->renderListOptions();
?>
	<tr <?php echo $project->rowAttributes() ?>>
<?php

// Render list options (body, left)
$project_list->ListOptions->render("body", "left", $project_list->RowCount);
?>
	<?php if ($project_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $project_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ProvinceCode">
<span<?php echo $project_list->ProvinceCode->viewAttributes() ?>><?php echo $project_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $project_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_LACode">
<span<?php echo $project_list->LACode->viewAttributes() ?>><?php echo $project_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode" <?php echo $project_list->ProjectCode->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ProjectCode">
<span<?php echo $project_list->ProjectCode->viewAttributes() ?>><?php echo $project_list->ProjectCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->ProjectName->Visible) { // ProjectName ?>
		<td data-name="ProjectName" <?php echo $project_list->ProjectName->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ProjectName">
<span<?php echo $project_list->ProjectName->viewAttributes() ?>><?php echo $project_list->ProjectName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->ProjectType->Visible) { // ProjectType ?>
		<td data-name="ProjectType" <?php echo $project_list->ProjectType->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ProjectType">
<span<?php echo $project_list->ProjectType->viewAttributes() ?>><?php echo $project_list->ProjectType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->ProjectSector->Visible) { // ProjectSector ?>
		<td data-name="ProjectSector" <?php echo $project_list->ProjectSector->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ProjectSector">
<span<?php echo $project_list->ProjectSector->viewAttributes() ?>><?php echo $project_list->ProjectSector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->Contractors->Visible) { // Contractors ?>
		<td data-name="Contractors" <?php echo $project_list->Contractors->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_Contractors">
<span<?php echo $project_list->Contractors->viewAttributes() ?>><?php echo $project_list->Contractors->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate" <?php echo $project_list->PlannedStartDate->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_PlannedStartDate">
<span<?php echo $project_list->PlannedStartDate->viewAttributes() ?>><?php echo $project_list->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate" <?php echo $project_list->PlannedEndDate->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_PlannedEndDate">
<span<?php echo $project_list->PlannedEndDate->viewAttributes() ?>><?php echo $project_list->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate" <?php echo $project_list->ActualStartDate->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ActualStartDate">
<span<?php echo $project_list->ActualStartDate->viewAttributes() ?>><?php echo $project_list->ActualStartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate" <?php echo $project_list->ActualEndDate->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ActualEndDate">
<span<?php echo $project_list->ActualEndDate->viewAttributes() ?>><?php echo $project_list->ActualEndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->Budget->Visible) { // Budget ?>
		<td data-name="Budget" <?php echo $project_list->Budget->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_Budget">
<span<?php echo $project_list->Budget->viewAttributes() ?>><?php echo $project_list->Budget->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->ProgressStatus->Visible) { // ProgressStatus ?>
		<td data-name="ProgressStatus" <?php echo $project_list->ProgressStatus->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_ProgressStatus">
<span<?php echo $project_list->ProgressStatus->viewAttributes() ?>><?php echo $project_list->ProgressStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($project_list->OutstandingTasks->Visible) { // OutstandingTasks ?>
		<td data-name="OutstandingTasks" <?php echo $project_list->OutstandingTasks->cellAttributes() ?>>
<span id="el<?php echo $project_list->RowCount ?>_project_OutstandingTasks">
<span<?php echo $project_list->OutstandingTasks->viewAttributes() ?>><?php echo $project_list->OutstandingTasks->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$project_list->ListOptions->render("body", "right", $project_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$project_list->isGridAdd())
		$project_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$project->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($project_list->Recordset)
	$project_list->Recordset->Close();
?>
<?php if (!$project_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$project_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $project_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $project_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($project_list->TotalRecords == 0 && !$project->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $project_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$project_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$project_list->isExport()) { ?>
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
$project_list->terminate();
?>