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
WriteHeader(FALSE, "utf-8");

// Create page object
$strategic_objective_preview = new strategic_objective_preview();

// Run the page
$strategic_objective_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$strategic_objective_preview->Page_Render();
?>
<?php $strategic_objective_preview->showPageHeader(); ?>
<?php if ($strategic_objective_preview->TotalRecords > 0) { ?>
<div class="card ew-grid strategic_objective"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$strategic_objective_preview->renderListOptions();

// Render list options (header, left)
$strategic_objective_preview->ListOptions->render("header", "left");
?>
<?php if ($strategic_objective_preview->LACode->Visible) { // LACode ?>
	<?php if ($strategic_objective->SortUrl($strategic_objective_preview->LACode) == "") { ?>
		<th class="<?php echo $strategic_objective_preview->LACode->headerCellClass() ?>"><?php echo $strategic_objective_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $strategic_objective_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($strategic_objective_preview->LACode->Name) ?>" data-sort-order="<?php echo $strategic_objective_preview->SortField == $strategic_objective_preview->LACode->Name && $strategic_objective_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_preview->SortField == $strategic_objective_preview->LACode->Name) { ?><?php if ($strategic_objective_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($strategic_objective->SortUrl($strategic_objective_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $strategic_objective_preview->DepartmentCode->headerCellClass() ?>"><?php echo $strategic_objective_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $strategic_objective_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($strategic_objective_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $strategic_objective_preview->SortField == $strategic_objective_preview->DepartmentCode->Name && $strategic_objective_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_preview->SortField == $strategic_objective_preview->DepartmentCode->Name) { ?><?php if ($strategic_objective_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_preview->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<?php if ($strategic_objective->SortUrl($strategic_objective_preview->StrategicObjectiveCode) == "") { ?>
		<th class="<?php echo $strategic_objective_preview->StrategicObjectiveCode->headerCellClass() ?>"><?php echo $strategic_objective_preview->StrategicObjectiveCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $strategic_objective_preview->StrategicObjectiveCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($strategic_objective_preview->StrategicObjectiveCode->Name) ?>" data-sort-order="<?php echo $strategic_objective_preview->SortField == $strategic_objective_preview->StrategicObjectiveCode->Name && $strategic_objective_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_preview->StrategicObjectiveCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_preview->SortField == $strategic_objective_preview->StrategicObjectiveCode->Name) { ?><?php if ($strategic_objective_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_preview->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
	<?php if ($strategic_objective->SortUrl($strategic_objective_preview->StrategicObjectiveName) == "") { ?>
		<th class="<?php echo $strategic_objective_preview->StrategicObjectiveName->headerCellClass() ?>"><?php echo $strategic_objective_preview->StrategicObjectiveName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $strategic_objective_preview->StrategicObjectiveName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($strategic_objective_preview->StrategicObjectiveName->Name) ?>" data-sort-order="<?php echo $strategic_objective_preview->SortField == $strategic_objective_preview->StrategicObjectiveName->Name && $strategic_objective_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_preview->StrategicObjectiveName->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_preview->SortField == $strategic_objective_preview->StrategicObjectiveName->Name) { ?><?php if ($strategic_objective_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_preview->ReferencedDocs->Visible) { // ReferencedDocs ?>
	<?php if ($strategic_objective->SortUrl($strategic_objective_preview->ReferencedDocs) == "") { ?>
		<th class="<?php echo $strategic_objective_preview->ReferencedDocs->headerCellClass() ?>"><?php echo $strategic_objective_preview->ReferencedDocs->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $strategic_objective_preview->ReferencedDocs->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($strategic_objective_preview->ReferencedDocs->Name) ?>" data-sort-order="<?php echo $strategic_objective_preview->SortField == $strategic_objective_preview->ReferencedDocs->Name && $strategic_objective_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_preview->ReferencedDocs->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_preview->SortField == $strategic_objective_preview->ReferencedDocs->Name) { ?><?php if ($strategic_objective_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($strategic_objective_preview->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<?php if ($strategic_objective->SortUrl($strategic_objective_preview->ResultAreaCode) == "") { ?>
		<th class="<?php echo $strategic_objective_preview->ResultAreaCode->headerCellClass() ?>"><?php echo $strategic_objective_preview->ResultAreaCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $strategic_objective_preview->ResultAreaCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($strategic_objective_preview->ResultAreaCode->Name) ?>" data-sort-order="<?php echo $strategic_objective_preview->SortField == $strategic_objective_preview->ResultAreaCode->Name && $strategic_objective_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $strategic_objective_preview->ResultAreaCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($strategic_objective_preview->SortField == $strategic_objective_preview->ResultAreaCode->Name) { ?><?php if ($strategic_objective_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($strategic_objective_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$strategic_objective_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$strategic_objective_preview->RecCount = 0;
$strategic_objective_preview->RowCount = 0;
while ($strategic_objective_preview->Recordset && !$strategic_objective_preview->Recordset->EOF) {

	// Init row class and style
	$strategic_objective_preview->RecCount++;
	$strategic_objective_preview->RowCount++;
	$strategic_objective_preview->CssStyle = "";
	$strategic_objective_preview->loadListRowValues($strategic_objective_preview->Recordset);

	// Render row
	$strategic_objective->RowType = ROWTYPE_PREVIEW; // Preview record
	$strategic_objective_preview->resetAttributes();
	$strategic_objective_preview->renderListRow();

	// Render list options
	$strategic_objective_preview->renderListOptions();
?>
	<tr <?php echo $strategic_objective->rowAttributes() ?>>
<?php

// Render list options (body, left)
$strategic_objective_preview->ListOptions->render("body", "left", $strategic_objective_preview->RowCount);
?>
<?php if ($strategic_objective_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $strategic_objective_preview->LACode->cellAttributes() ?>>
<span<?php echo $strategic_objective_preview->LACode->viewAttributes() ?>><?php echo $strategic_objective_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($strategic_objective_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $strategic_objective_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $strategic_objective_preview->DepartmentCode->viewAttributes() ?>><?php echo $strategic_objective_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($strategic_objective_preview->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<!-- StrategicObjectiveCode -->
		<td<?php echo $strategic_objective_preview->StrategicObjectiveCode->cellAttributes() ?>>
<span<?php echo $strategic_objective_preview->StrategicObjectiveCode->viewAttributes() ?>><?php echo $strategic_objective_preview->StrategicObjectiveCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($strategic_objective_preview->StrategicObjectiveName->Visible) { // StrategicObjectiveName ?>
		<!-- StrategicObjectiveName -->
		<td<?php echo $strategic_objective_preview->StrategicObjectiveName->cellAttributes() ?>>
<span<?php echo $strategic_objective_preview->StrategicObjectiveName->viewAttributes() ?>><?php echo $strategic_objective_preview->StrategicObjectiveName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($strategic_objective_preview->ReferencedDocs->Visible) { // ReferencedDocs ?>
		<!-- ReferencedDocs -->
		<td<?php echo $strategic_objective_preview->ReferencedDocs->cellAttributes() ?>>
<span<?php echo $strategic_objective_preview->ReferencedDocs->viewAttributes() ?>><?php echo $strategic_objective_preview->ReferencedDocs->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($strategic_objective_preview->ResultAreaCode->Visible) { // ResultAreaCode ?>
		<!-- ResultAreaCode -->
		<td<?php echo $strategic_objective_preview->ResultAreaCode->cellAttributes() ?>>
<span<?php echo $strategic_objective_preview->ResultAreaCode->viewAttributes() ?>><?php echo $strategic_objective_preview->ResultAreaCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$strategic_objective_preview->ListOptions->render("body", "right", $strategic_objective_preview->RowCount);
?>
	</tr>
<?php
	$strategic_objective_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $strategic_objective_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($strategic_objective_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($strategic_objective_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$strategic_objective_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($strategic_objective_preview->Recordset)
	$strategic_objective_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$strategic_objective_preview->terminate();
?>