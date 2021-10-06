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
$staffqualifications_prof_preview = new staffqualifications_prof_preview();

// Run the page
$staffqualifications_prof_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_prof_preview->Page_Render();
?>
<?php $staffqualifications_prof_preview->showPageHeader(); ?>
<?php if ($staffqualifications_prof_preview->TotalRecords > 0) { ?>
<div class="card ew-grid staffqualifications_prof"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$staffqualifications_prof_preview->renderListOptions();

// Render list options (header, left)
$staffqualifications_prof_preview->ListOptions->render("header", "left");
?>
<?php if ($staffqualifications_prof_preview->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
	<?php if ($staffqualifications_prof->SortUrl($staffqualifications_prof_preview->ProfQualificationLevel) == "") { ?>
		<th class="<?php echo $staffqualifications_prof_preview->ProfQualificationLevel->headerCellClass() ?>"><?php echo $staffqualifications_prof_preview->ProfQualificationLevel->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffqualifications_prof_preview->ProfQualificationLevel->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffqualifications_prof_preview->ProfQualificationLevel->Name) ?>" data-sort-order="<?php echo $staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->ProfQualificationLevel->Name && $staffqualifications_prof_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_preview->ProfQualificationLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->ProfQualificationLevel->Name) { ?><?php if ($staffqualifications_prof_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_preview->QualificationCode->Visible) { // QualificationCode ?>
	<?php if ($staffqualifications_prof->SortUrl($staffqualifications_prof_preview->QualificationCode) == "") { ?>
		<th class="<?php echo $staffqualifications_prof_preview->QualificationCode->headerCellClass() ?>"><?php echo $staffqualifications_prof_preview->QualificationCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffqualifications_prof_preview->QualificationCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffqualifications_prof_preview->QualificationCode->Name) ?>" data-sort-order="<?php echo $staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->QualificationCode->Name && $staffqualifications_prof_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_preview->QualificationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->QualificationCode->Name) { ?><?php if ($staffqualifications_prof_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_preview->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<?php if ($staffqualifications_prof->SortUrl($staffqualifications_prof_preview->QualificationRemarks) == "") { ?>
		<th class="<?php echo $staffqualifications_prof_preview->QualificationRemarks->headerCellClass() ?>"><?php echo $staffqualifications_prof_preview->QualificationRemarks->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffqualifications_prof_preview->QualificationRemarks->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffqualifications_prof_preview->QualificationRemarks->Name) ?>" data-sort-order="<?php echo $staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->QualificationRemarks->Name && $staffqualifications_prof_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_preview->QualificationRemarks->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->QualificationRemarks->Name) { ?><?php if ($staffqualifications_prof_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_preview->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<?php if ($staffqualifications_prof->SortUrl($staffqualifications_prof_preview->AwardingInstitution) == "") { ?>
		<th class="<?php echo $staffqualifications_prof_preview->AwardingInstitution->headerCellClass() ?>"><?php echo $staffqualifications_prof_preview->AwardingInstitution->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffqualifications_prof_preview->AwardingInstitution->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffqualifications_prof_preview->AwardingInstitution->Name) ?>" data-sort-order="<?php echo $staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->AwardingInstitution->Name && $staffqualifications_prof_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_preview->AwardingInstitution->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->AwardingInstitution->Name) { ?><?php if ($staffqualifications_prof_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_preview->FromYear->Visible) { // FromYear ?>
	<?php if ($staffqualifications_prof->SortUrl($staffqualifications_prof_preview->FromYear) == "") { ?>
		<th class="<?php echo $staffqualifications_prof_preview->FromYear->headerCellClass() ?>"><?php echo $staffqualifications_prof_preview->FromYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffqualifications_prof_preview->FromYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffqualifications_prof_preview->FromYear->Name) ?>" data-sort-order="<?php echo $staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->FromYear->Name && $staffqualifications_prof_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_preview->FromYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->FromYear->Name) { ?><?php if ($staffqualifications_prof_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffqualifications_prof_preview->YearObtained->Visible) { // YearObtained ?>
	<?php if ($staffqualifications_prof->SortUrl($staffqualifications_prof_preview->YearObtained) == "") { ?>
		<th class="<?php echo $staffqualifications_prof_preview->YearObtained->headerCellClass() ?>"><?php echo $staffqualifications_prof_preview->YearObtained->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffqualifications_prof_preview->YearObtained->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffqualifications_prof_preview->YearObtained->Name) ?>" data-sort-order="<?php echo $staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->YearObtained->Name && $staffqualifications_prof_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffqualifications_prof_preview->YearObtained->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffqualifications_prof_preview->SortField == $staffqualifications_prof_preview->YearObtained->Name) { ?><?php if ($staffqualifications_prof_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffqualifications_prof_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffqualifications_prof_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$staffqualifications_prof_preview->RecCount = 0;
$staffqualifications_prof_preview->RowCount = 0;
while ($staffqualifications_prof_preview->Recordset && !$staffqualifications_prof_preview->Recordset->EOF) {

	// Init row class and style
	$staffqualifications_prof_preview->RecCount++;
	$staffqualifications_prof_preview->RowCount++;
	$staffqualifications_prof_preview->CssStyle = "";
	$staffqualifications_prof_preview->loadListRowValues($staffqualifications_prof_preview->Recordset);

	// Render row
	$staffqualifications_prof->RowType = ROWTYPE_PREVIEW; // Preview record
	$staffqualifications_prof_preview->resetAttributes();
	$staffqualifications_prof_preview->renderListRow();

	// Render list options
	$staffqualifications_prof_preview->renderListOptions();
?>
	<tr <?php echo $staffqualifications_prof->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffqualifications_prof_preview->ListOptions->render("body", "left", $staffqualifications_prof_preview->RowCount);
?>
<?php if ($staffqualifications_prof_preview->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
		<!-- ProfQualificationLevel -->
		<td<?php echo $staffqualifications_prof_preview->ProfQualificationLevel->cellAttributes() ?>>
<span<?php echo $staffqualifications_prof_preview->ProfQualificationLevel->viewAttributes() ?>><?php echo $staffqualifications_prof_preview->ProfQualificationLevel->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_preview->QualificationCode->Visible) { // QualificationCode ?>
		<!-- QualificationCode -->
		<td<?php echo $staffqualifications_prof_preview->QualificationCode->cellAttributes() ?>>
<span<?php echo $staffqualifications_prof_preview->QualificationCode->viewAttributes() ?>><?php echo $staffqualifications_prof_preview->QualificationCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_preview->QualificationRemarks->Visible) { // QualificationRemarks ?>
		<!-- QualificationRemarks -->
		<td<?php echo $staffqualifications_prof_preview->QualificationRemarks->cellAttributes() ?>>
<span<?php echo $staffqualifications_prof_preview->QualificationRemarks->viewAttributes() ?>><?php echo $staffqualifications_prof_preview->QualificationRemarks->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_preview->AwardingInstitution->Visible) { // AwardingInstitution ?>
		<!-- AwardingInstitution -->
		<td<?php echo $staffqualifications_prof_preview->AwardingInstitution->cellAttributes() ?>>
<span<?php echo $staffqualifications_prof_preview->AwardingInstitution->viewAttributes() ?>><?php echo $staffqualifications_prof_preview->AwardingInstitution->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_preview->FromYear->Visible) { // FromYear ?>
		<!-- FromYear -->
		<td<?php echo $staffqualifications_prof_preview->FromYear->cellAttributes() ?>>
<span<?php echo $staffqualifications_prof_preview->FromYear->viewAttributes() ?>><?php echo $staffqualifications_prof_preview->FromYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffqualifications_prof_preview->YearObtained->Visible) { // YearObtained ?>
		<!-- YearObtained -->
		<td<?php echo $staffqualifications_prof_preview->YearObtained->cellAttributes() ?>>
<span<?php echo $staffqualifications_prof_preview->YearObtained->viewAttributes() ?>><?php echo $staffqualifications_prof_preview->YearObtained->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$staffqualifications_prof_preview->ListOptions->render("body", "right", $staffqualifications_prof_preview->RowCount);
?>
	</tr>
<?php
	$staffqualifications_prof_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $staffqualifications_prof_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($staffqualifications_prof_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($staffqualifications_prof_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$staffqualifications_prof_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($staffqualifications_prof_preview->Recordset)
	$staffqualifications_prof_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$staffqualifications_prof_preview->terminate();
?>