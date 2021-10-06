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
$councillorship_preview = new councillorship_preview();

// Run the page
$councillorship_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_preview->Page_Render();
?>
<?php $councillorship_preview->showPageHeader(); ?>
<?php if ($councillorship_preview->TotalRecords > 0) { ?>
<div class="card ew-grid councillorship"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$councillorship_preview->renderListOptions();

// Render list options (header, left)
$councillorship_preview->ListOptions->render("header", "left");
?>
<?php if ($councillorship_preview->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->EmployeeID) == "") { ?>
		<th class="<?php echo $councillorship_preview->EmployeeID->headerCellClass() ?>"><?php echo $councillorship_preview->EmployeeID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->EmployeeID->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->EmployeeID->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->EmployeeID->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->LACode->Visible) { // LACode ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->LACode) == "") { ?>
		<th class="<?php echo $councillorship_preview->LACode->headerCellClass() ?>"><?php echo $councillorship_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->LACode->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->LACode->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->LACode->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->PoliticalParty->Visible) { // PoliticalParty ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->PoliticalParty) == "") { ?>
		<th class="<?php echo $councillorship_preview->PoliticalParty->headerCellClass() ?>"><?php echo $councillorship_preview->PoliticalParty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->PoliticalParty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->PoliticalParty->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->PoliticalParty->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->PoliticalParty->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->PoliticalParty->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->Occupation->Visible) { // Occupation ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->Occupation) == "") { ?>
		<th class="<?php echo $councillorship_preview->Occupation->headerCellClass() ?>"><?php echo $councillorship_preview->Occupation->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->Occupation->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->Occupation->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->Occupation->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->Occupation->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->Occupation->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->PositionInCouncil) == "") { ?>
		<th class="<?php echo $councillorship_preview->PositionInCouncil->headerCellClass() ?>"><?php echo $councillorship_preview->PositionInCouncil->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->PositionInCouncil->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->PositionInCouncil->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->PositionInCouncil->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->PositionInCouncil->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->PositionInCouncil->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->Committee->Visible) { // Committee ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->Committee) == "") { ?>
		<th class="<?php echo $councillorship_preview->Committee->headerCellClass() ?>"><?php echo $councillorship_preview->Committee->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->Committee->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->Committee->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->Committee->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->Committee->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->Committee->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->CommitteeRole) == "") { ?>
		<th class="<?php echo $councillorship_preview->CommitteeRole->headerCellClass() ?>"><?php echo $councillorship_preview->CommitteeRole->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->CommitteeRole->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->CommitteeRole->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->CommitteeRole->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->CommitteeRole->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->CouncilTerm->Visible) { // CouncilTerm ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->CouncilTerm) == "") { ?>
		<th class="<?php echo $councillorship_preview->CouncilTerm->headerCellClass() ?>"><?php echo $councillorship_preview->CouncilTerm->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->CouncilTerm->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->CouncilTerm->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->CouncilTerm->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->CouncilTerm->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->CouncilTerm->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->CouncillorTypeType) == "") { ?>
		<th class="<?php echo $councillorship_preview->CouncillorTypeType->headerCellClass() ?>"><?php echo $councillorship_preview->CouncillorTypeType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->CouncillorTypeType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->CouncillorTypeType->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->CouncillorTypeType->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->CouncillorTypeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->CouncillorTypeType->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_preview->ExitReason->Visible) { // ExitReason ?>
	<?php if ($councillorship->SortUrl($councillorship_preview->ExitReason) == "") { ?>
		<th class="<?php echo $councillorship_preview->ExitReason->headerCellClass() ?>"><?php echo $councillorship_preview->ExitReason->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $councillorship_preview->ExitReason->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($councillorship_preview->ExitReason->Name) ?>" data-sort-order="<?php echo $councillorship_preview->SortField == $councillorship_preview->ExitReason->Name && $councillorship_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_preview->ExitReason->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_preview->SortField == $councillorship_preview->ExitReason->Name) { ?><?php if ($councillorship_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillorship_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$councillorship_preview->RecCount = 0;
$councillorship_preview->RowCount = 0;
while ($councillorship_preview->Recordset && !$councillorship_preview->Recordset->EOF) {

	// Init row class and style
	$councillorship_preview->RecCount++;
	$councillorship_preview->RowCount++;
	$councillorship_preview->CssStyle = "";
	$councillorship_preview->loadListRowValues($councillorship_preview->Recordset);

	// Render row
	$councillorship->RowType = ROWTYPE_PREVIEW; // Preview record
	$councillorship_preview->resetAttributes();
	$councillorship_preview->renderListRow();

	// Render list options
	$councillorship_preview->renderListOptions();
?>
	<tr <?php echo $councillorship->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillorship_preview->ListOptions->render("body", "left", $councillorship_preview->RowCount);
?>
<?php if ($councillorship_preview->EmployeeID->Visible) { // EmployeeID ?>
		<!-- EmployeeID -->
		<td<?php echo $councillorship_preview->EmployeeID->cellAttributes() ?>>
<span<?php echo $councillorship_preview->EmployeeID->viewAttributes() ?>><?php echo $councillorship_preview->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $councillorship_preview->LACode->cellAttributes() ?>>
<span<?php echo $councillorship_preview->LACode->viewAttributes() ?>><?php echo $councillorship_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->PoliticalParty->Visible) { // PoliticalParty ?>
		<!-- PoliticalParty -->
		<td<?php echo $councillorship_preview->PoliticalParty->cellAttributes() ?>>
<span<?php echo $councillorship_preview->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_preview->PoliticalParty->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->Occupation->Visible) { // Occupation ?>
		<!-- Occupation -->
		<td<?php echo $councillorship_preview->Occupation->cellAttributes() ?>>
<span<?php echo $councillorship_preview->Occupation->viewAttributes() ?>><?php echo $councillorship_preview->Occupation->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<!-- PositionInCouncil -->
		<td<?php echo $councillorship_preview->PositionInCouncil->cellAttributes() ?>>
<span<?php echo $councillorship_preview->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_preview->PositionInCouncil->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->Committee->Visible) { // Committee ?>
		<!-- Committee -->
		<td<?php echo $councillorship_preview->Committee->cellAttributes() ?>>
<span<?php echo $councillorship_preview->Committee->viewAttributes() ?>><?php echo $councillorship_preview->Committee->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->CommitteeRole->Visible) { // CommitteeRole ?>
		<!-- CommitteeRole -->
		<td<?php echo $councillorship_preview->CommitteeRole->cellAttributes() ?>>
<span<?php echo $councillorship_preview->CommitteeRole->viewAttributes() ?>><?php echo $councillorship_preview->CommitteeRole->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->CouncilTerm->Visible) { // CouncilTerm ?>
		<!-- CouncilTerm -->
		<td<?php echo $councillorship_preview->CouncilTerm->cellAttributes() ?>>
<span<?php echo $councillorship_preview->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_preview->CouncilTerm->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<!-- CouncillorTypeType -->
		<td<?php echo $councillorship_preview->CouncillorTypeType->cellAttributes() ?>>
<span<?php echo $councillorship_preview->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_preview->CouncillorTypeType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($councillorship_preview->ExitReason->Visible) { // ExitReason ?>
		<!-- ExitReason -->
		<td<?php echo $councillorship_preview->ExitReason->cellAttributes() ?>>
<span<?php echo $councillorship_preview->ExitReason->viewAttributes() ?>><?php echo $councillorship_preview->ExitReason->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$councillorship_preview->ListOptions->render("body", "right", $councillorship_preview->RowCount);
?>
	</tr>
<?php
	$councillorship_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $councillorship_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($councillorship_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($councillorship_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$councillorship_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($councillorship_preview->Recordset)
	$councillorship_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$councillorship_preview->terminate();
?>