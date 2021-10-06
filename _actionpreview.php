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
$_action_preview = new _action_preview();

// Run the page
$_action_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_action_preview->Page_Render();
?>
<?php $_action_preview->showPageHeader(); ?>
<?php if ($_action_preview->TotalRecords > 0) { ?>
<div class="card ew-grid _action"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$_action_preview->renderListOptions();

// Render list options (header, left)
$_action_preview->ListOptions->render("header", "left");
?>
<?php if ($_action_preview->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($_action->SortUrl($_action_preview->ProgramCode) == "") { ?>
		<th class="<?php echo $_action_preview->ProgramCode->headerCellClass() ?>"><?php echo $_action_preview->ProgramCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->ProgramCode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->ProgramCode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->ProgramCode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->OucomeCode->Visible) { // OucomeCode ?>
	<?php if ($_action->SortUrl($_action_preview->OucomeCode) == "") { ?>
		<th class="<?php echo $_action_preview->OucomeCode->headerCellClass() ?>"><?php echo $_action_preview->OucomeCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->OucomeCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->OucomeCode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->OucomeCode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->OucomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->OucomeCode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->OutputCode->Visible) { // OutputCode ?>
	<?php if ($_action->SortUrl($_action_preview->OutputCode) == "") { ?>
		<th class="<?php echo $_action_preview->OutputCode->headerCellClass() ?>"><?php echo $_action_preview->OutputCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->OutputCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->OutputCode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->OutputCode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->OutputCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->OutputCode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($_action->SortUrl($_action_preview->ProjectCode) == "") { ?>
		<th class="<?php echo $_action_preview->ProjectCode->headerCellClass() ?>"><?php echo $_action_preview->ProjectCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->ProjectCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->ProjectCode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->ProjectCode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->ProjectCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->ProjectCode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->ActionCode->Visible) { // ActionCode ?>
	<?php if ($_action->SortUrl($_action_preview->ActionCode) == "") { ?>
		<th class="<?php echo $_action_preview->ActionCode->headerCellClass() ?>"><?php echo $_action_preview->ActionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->ActionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->ActionCode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->ActionCode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->ActionCode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->ActionName->Visible) { // ActionName ?>
	<?php if ($_action->SortUrl($_action_preview->ActionName) == "") { ?>
		<th class="<?php echo $_action_preview->ActionName->headerCellClass() ?>"><?php echo $_action_preview->ActionName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->ActionName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->ActionName->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->ActionName->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->ActionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->ActionName->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->ActionType->Visible) { // ActionType ?>
	<?php if ($_action->SortUrl($_action_preview->ActionType) == "") { ?>
		<th class="<?php echo $_action_preview->ActionType->headerCellClass() ?>"><?php echo $_action_preview->ActionType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->ActionType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->ActionType->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->ActionType->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->ActionType->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->ActionType->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->FinancialYear->Visible) { // FinancialYear ?>
	<?php if ($_action->SortUrl($_action_preview->FinancialYear) == "") { ?>
		<th class="<?php echo $_action_preview->FinancialYear->headerCellClass() ?>"><?php echo $_action_preview->FinancialYear->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->FinancialYear->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->FinancialYear->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->FinancialYear->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->FinancialYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->FinancialYear->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
	<?php if ($_action->SortUrl($_action_preview->ExpectedAnnualAchievement) == "") { ?>
		<th class="<?php echo $_action_preview->ExpectedAnnualAchievement->headerCellClass() ?>"><?php echo $_action_preview->ExpectedAnnualAchievement->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->ExpectedAnnualAchievement->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->ExpectedAnnualAchievement->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->ExpectedAnnualAchievement->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->ExpectedAnnualAchievement->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->ExpectedAnnualAchievement->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->ActionLocation->Visible) { // ActionLocation ?>
	<?php if ($_action->SortUrl($_action_preview->ActionLocation) == "") { ?>
		<th class="<?php echo $_action_preview->ActionLocation->headerCellClass() ?>"><?php echo $_action_preview->ActionLocation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->ActionLocation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->ActionLocation->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->ActionLocation->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->ActionLocation->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->ActionLocation->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->Latitude->Visible) { // Latitude ?>
	<?php if ($_action->SortUrl($_action_preview->Latitude) == "") { ?>
		<th class="<?php echo $_action_preview->Latitude->headerCellClass() ?>"><?php echo $_action_preview->Latitude->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->Latitude->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->Latitude->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->Latitude->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->Latitude->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->Longitude->Visible) { // Longitude ?>
	<?php if ($_action->SortUrl($_action_preview->Longitude) == "") { ?>
		<th class="<?php echo $_action_preview->Longitude->headerCellClass() ?>"><?php echo $_action_preview->Longitude->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->Longitude->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->Longitude->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->Longitude->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->Longitude->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->LACode->Visible) { // LACode ?>
	<?php if ($_action->SortUrl($_action_preview->LACode) == "") { ?>
		<th class="<?php echo $_action_preview->LACode->headerCellClass() ?>"><?php echo $_action_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->LACode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->LACode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->LACode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($_action->SortUrl($_action_preview->DepartmentCode) == "") { ?>
		<th class="<?php echo $_action_preview->DepartmentCode->headerCellClass() ?>"><?php echo $_action_preview->DepartmentCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->DepartmentCode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->DepartmentCode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->DepartmentCode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_action_preview->SectionCode->Visible) { // SectionCode ?>
	<?php if ($_action->SortUrl($_action_preview->SectionCode) == "") { ?>
		<th class="<?php echo $_action_preview->SectionCode->headerCellClass() ?>"><?php echo $_action_preview->SectionCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_action_preview->SectionCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_action_preview->SectionCode->Name) ?>" data-sort-order="<?php echo $_action_preview->SortField == $_action_preview->SectionCode->Name && $_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_action_preview->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_action_preview->SortField == $_action_preview->SectionCode->Name) { ?><?php if ($_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_action_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$_action_preview->RecCount = 0;
$_action_preview->RowCount = 0;
while ($_action_preview->Recordset && !$_action_preview->Recordset->EOF) {

	// Init row class and style
	$_action_preview->RecCount++;
	$_action_preview->RowCount++;
	$_action_preview->CssStyle = "";
	$_action_preview->loadListRowValues($_action_preview->Recordset);

	// Render row
	$_action->RowType = ROWTYPE_PREVIEW; // Preview record
	$_action_preview->resetAttributes();
	$_action_preview->renderListRow();

	// Render list options
	$_action_preview->renderListOptions();
?>
	<tr <?php echo $_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_action_preview->ListOptions->render("body", "left", $_action_preview->RowCount);
?>
<?php if ($_action_preview->ProgramCode->Visible) { // ProgramCode ?>
		<!-- ProgramCode -->
		<td<?php echo $_action_preview->ProgramCode->cellAttributes() ?>>
<span<?php echo $_action_preview->ProgramCode->viewAttributes() ?>><?php echo $_action_preview->ProgramCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->OucomeCode->Visible) { // OucomeCode ?>
		<!-- OucomeCode -->
		<td<?php echo $_action_preview->OucomeCode->cellAttributes() ?>>
<span<?php echo $_action_preview->OucomeCode->viewAttributes() ?>><?php echo $_action_preview->OucomeCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->OutputCode->Visible) { // OutputCode ?>
		<!-- OutputCode -->
		<td<?php echo $_action_preview->OutputCode->cellAttributes() ?>>
<span<?php echo $_action_preview->OutputCode->viewAttributes() ?>><?php echo $_action_preview->OutputCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->ProjectCode->Visible) { // ProjectCode ?>
		<!-- ProjectCode -->
		<td<?php echo $_action_preview->ProjectCode->cellAttributes() ?>>
<span<?php echo $_action_preview->ProjectCode->viewAttributes() ?>><?php echo $_action_preview->ProjectCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->ActionCode->Visible) { // ActionCode ?>
		<!-- ActionCode -->
		<td<?php echo $_action_preview->ActionCode->cellAttributes() ?>>
<span<?php echo $_action_preview->ActionCode->viewAttributes() ?>><?php echo $_action_preview->ActionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->ActionName->Visible) { // ActionName ?>
		<!-- ActionName -->
		<td<?php echo $_action_preview->ActionName->cellAttributes() ?>>
<span<?php echo $_action_preview->ActionName->viewAttributes() ?>><?php echo $_action_preview->ActionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->ActionType->Visible) { // ActionType ?>
		<!-- ActionType -->
		<td<?php echo $_action_preview->ActionType->cellAttributes() ?>>
<span<?php echo $_action_preview->ActionType->viewAttributes() ?>><?php echo $_action_preview->ActionType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->FinancialYear->Visible) { // FinancialYear ?>
		<!-- FinancialYear -->
		<td<?php echo $_action_preview->FinancialYear->cellAttributes() ?>>
<span<?php echo $_action_preview->FinancialYear->viewAttributes() ?>><?php echo $_action_preview->FinancialYear->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->ExpectedAnnualAchievement->Visible) { // ExpectedAnnualAchievement ?>
		<!-- ExpectedAnnualAchievement -->
		<td<?php echo $_action_preview->ExpectedAnnualAchievement->cellAttributes() ?>>
<span<?php echo $_action_preview->ExpectedAnnualAchievement->viewAttributes() ?>><?php echo $_action_preview->ExpectedAnnualAchievement->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->ActionLocation->Visible) { // ActionLocation ?>
		<!-- ActionLocation -->
		<td<?php echo $_action_preview->ActionLocation->cellAttributes() ?>>
<span<?php echo $_action_preview->ActionLocation->viewAttributes() ?>><?php echo $_action_preview->ActionLocation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->Latitude->Visible) { // Latitude ?>
		<!-- Latitude -->
		<td<?php echo $_action_preview->Latitude->cellAttributes() ?>>
<span<?php echo $_action_preview->Latitude->viewAttributes() ?>><?php echo $_action_preview->Latitude->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->Longitude->Visible) { // Longitude ?>
		<!-- Longitude -->
		<td<?php echo $_action_preview->Longitude->cellAttributes() ?>>
<span<?php echo $_action_preview->Longitude->viewAttributes() ?>><?php echo $_action_preview->Longitude->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $_action_preview->LACode->cellAttributes() ?>>
<span<?php echo $_action_preview->LACode->viewAttributes() ?>><?php echo $_action_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->DepartmentCode->Visible) { // DepartmentCode ?>
		<!-- DepartmentCode -->
		<td<?php echo $_action_preview->DepartmentCode->cellAttributes() ?>>
<span<?php echo $_action_preview->DepartmentCode->viewAttributes() ?>><?php echo $_action_preview->DepartmentCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_action_preview->SectionCode->Visible) { // SectionCode ?>
		<!-- SectionCode -->
		<td<?php echo $_action_preview->SectionCode->cellAttributes() ?>>
<span<?php echo $_action_preview->SectionCode->viewAttributes() ?>><?php echo $_action_preview->SectionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$_action_preview->ListOptions->render("body", "right", $_action_preview->RowCount);
?>
	</tr>
<?php
	$_action_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $_action_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($_action_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($_action_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$_action_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($_action_preview->Recordset)
	$_action_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$_action_preview->terminate();
?>