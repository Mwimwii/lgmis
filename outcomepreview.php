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
$outcome_preview = new outcome_preview();

// Run the page
$outcome_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$outcome_preview->Page_Render();
?>
<?php $outcome_preview->showPageHeader(); ?>
<?php if ($outcome_preview->TotalRecords > 0) { ?>
<div class="card ew-grid outcome"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$outcome_preview->renderListOptions();

// Render list options (header, left)
$outcome_preview->ListOptions->render("header", "left");
?>
<?php if ($outcome_preview->OutcomeCode->Visible) { // OutcomeCode ?>
	<?php if ($outcome->SortUrl($outcome_preview->OutcomeCode) == "") { ?>
		<th class="<?php echo $outcome_preview->OutcomeCode->headerCellClass() ?>"><?php echo $outcome_preview->OutcomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->OutcomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->OutcomeCode->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->OutcomeCode->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->OutcomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->OutcomeCode->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->OutcomeName->Visible) { // OutcomeName ?>
	<?php if ($outcome->SortUrl($outcome_preview->OutcomeName) == "") { ?>
		<th class="<?php echo $outcome_preview->OutcomeName->headerCellClass() ?>"><?php echo $outcome_preview->OutcomeName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->OutcomeName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->OutcomeName->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->OutcomeName->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->OutcomeName->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->OutcomeName->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<?php if ($outcome->SortUrl($outcome_preview->StrategicObjectiveCode) == "") { ?>
		<th class="<?php echo $outcome_preview->StrategicObjectiveCode->headerCellClass() ?>"><?php echo $outcome_preview->StrategicObjectiveCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->StrategicObjectiveCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->StrategicObjectiveCode->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->StrategicObjectiveCode->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->StrategicObjectiveCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->StrategicObjectiveCode->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->LACode->Visible) { // LACode ?>
	<?php if ($outcome->SortUrl($outcome_preview->LACode) == "") { ?>
		<th class="<?php echo $outcome_preview->LACode->headerCellClass() ?>"><?php echo $outcome_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->LACode->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->LACode->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->LACode->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($outcome->SortUrl($outcome_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $outcome_preview->DepartmentCode->headerCellClass() ?>"><?php echo $outcome_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->DepartmentCode->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->DepartmentCode->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->OutcomeKPI->Visible) { // OutcomeKPI ?>
	<?php if ($outcome->SortUrl($outcome_preview->OutcomeKPI) == "") { ?>
		<th class="<?php echo $outcome_preview->OutcomeKPI->headerCellClass() ?>"><?php echo $outcome_preview->OutcomeKPI->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->OutcomeKPI->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->OutcomeKPI->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->OutcomeKPI->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->OutcomeKPI->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->OutcomeKPI->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->Assumptions->Visible) { // Assumptions ?>
	<?php if ($outcome->SortUrl($outcome_preview->Assumptions) == "") { ?>
		<th class="<?php echo $outcome_preview->Assumptions->headerCellClass() ?>"><?php echo $outcome_preview->Assumptions->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->Assumptions->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->Assumptions->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->Assumptions->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->Assumptions->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->Assumptions->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
	<?php if ($outcome->SortUrl($outcome_preview->ResponsibleOfficer) == "") { ?>
		<th class="<?php echo $outcome_preview->ResponsibleOfficer->headerCellClass() ?>"><?php echo $outcome_preview->ResponsibleOfficer->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->ResponsibleOfficer->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->ResponsibleOfficer->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->ResponsibleOfficer->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->ResponsibleOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->ResponsibleOfficer->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($outcome_preview->OutcomeStatus->Visible) { // OutcomeStatus ?>
	<?php if ($outcome->SortUrl($outcome_preview->OutcomeStatus) == "") { ?>
		<th class="<?php echo $outcome_preview->OutcomeStatus->headerCellClass() ?>"><?php echo $outcome_preview->OutcomeStatus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $outcome_preview->OutcomeStatus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($outcome_preview->OutcomeStatus->Name) ?>" data-sort-order="<?php echo $outcome_preview->SortField == $outcome_preview->OutcomeStatus->Name && $outcome_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $outcome_preview->OutcomeStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($outcome_preview->SortField == $outcome_preview->OutcomeStatus->Name) { ?><?php if ($outcome_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($outcome_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$outcome_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$outcome_preview->RecCount = 0;
$outcome_preview->RowCount = 0;
while ($outcome_preview->Recordset && !$outcome_preview->Recordset->EOF) {

	// Init row class and style
	$outcome_preview->RecCount++;
	$outcome_preview->RowCount++;
	$outcome_preview->CssStyle = "";
	$outcome_preview->loadListRowValues($outcome_preview->Recordset);

	// Render row
	$outcome->RowType = ROWTYPE_PREVIEW; // Preview record
	$outcome_preview->resetAttributes();
	$outcome_preview->renderListRow();

	// Render list options
	$outcome_preview->renderListOptions();
?>
	<tr <?php echo $outcome->rowAttributes() ?>>
<?php

// Render list options (body, left)
$outcome_preview->ListOptions->render("body", "left", $outcome_preview->RowCount);
?>
<?php if ($outcome_preview->OutcomeCode->Visible) { // OutcomeCode ?>
		<!-- OutcomeCode -->
		<td<?php echo $outcome_preview->OutcomeCode->cellAttributes() ?>>
<span<?php echo $outcome_preview->OutcomeCode->viewAttributes() ?>><?php echo $outcome_preview->OutcomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->OutcomeName->Visible) { // OutcomeName ?>
		<!-- OutcomeName -->
		<td<?php echo $outcome_preview->OutcomeName->cellAttributes() ?>>
<span<?php echo $outcome_preview->OutcomeName->viewAttributes() ?>><?php echo $outcome_preview->OutcomeName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<!-- StrategicObjectiveCode -->
		<td<?php echo $outcome_preview->StrategicObjectiveCode->cellAttributes() ?>>
<span<?php echo $outcome_preview->StrategicObjectiveCode->viewAttributes() ?>><?php echo $outcome_preview->StrategicObjectiveCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $outcome_preview->LACode->cellAttributes() ?>>
<span<?php echo $outcome_preview->LACode->viewAttributes() ?>><?php echo $outcome_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $outcome_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $outcome_preview->DepartmentCode->viewAttributes() ?>><?php echo $outcome_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->OutcomeKPI->Visible) { // OutcomeKPI ?>
		<!-- OutcomeKPI -->
		<td<?php echo $outcome_preview->OutcomeKPI->cellAttributes() ?>>
<span<?php echo $outcome_preview->OutcomeKPI->viewAttributes() ?>><?php echo $outcome_preview->OutcomeKPI->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->Assumptions->Visible) { // Assumptions ?>
		<!-- Assumptions -->
		<td<?php echo $outcome_preview->Assumptions->cellAttributes() ?>>
<span<?php echo $outcome_preview->Assumptions->viewAttributes() ?>><?php echo $outcome_preview->Assumptions->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->ResponsibleOfficer->Visible) { // ResponsibleOfficer ?>
		<!-- ResponsibleOfficer -->
		<td<?php echo $outcome_preview->ResponsibleOfficer->cellAttributes() ?>>
<span<?php echo $outcome_preview->ResponsibleOfficer->viewAttributes() ?>><?php echo $outcome_preview->ResponsibleOfficer->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($outcome_preview->OutcomeStatus->Visible) { // OutcomeStatus ?>
		<!-- OutcomeStatus -->
		<td<?php echo $outcome_preview->OutcomeStatus->cellAttributes() ?>>
<span<?php echo $outcome_preview->OutcomeStatus->viewAttributes() ?>><?php echo $outcome_preview->OutcomeStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$outcome_preview->ListOptions->render("body", "right", $outcome_preview->RowCount);
?>
	</tr>
<?php
	$outcome_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $outcome_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($outcome_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($outcome_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$outcome_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($outcome_preview->Recordset)
	$outcome_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$outcome_preview->terminate();
?>