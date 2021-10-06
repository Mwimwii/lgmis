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
$staffdisciplinary_action_preview = new staffdisciplinary_action_preview();

// Run the page
$staffdisciplinary_action_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_preview->Page_Render();
?>
<?php $staffdisciplinary_action_preview->showPageHeader(); ?>
<?php if ($staffdisciplinary_action_preview->TotalRecords > 0) { ?>
<div class="card ew-grid staffdisciplinary_action"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$staffdisciplinary_action_preview->renderListOptions();

// Render list options (header, left)
$staffdisciplinary_action_preview->ListOptions->render("header", "left");
?>
<?php if ($staffdisciplinary_action_preview->CaseNo->Visible) { // CaseNo ?>
	<?php if ($staffdisciplinary_action->SortUrl($staffdisciplinary_action_preview->CaseNo) == "") { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->CaseNo->headerCellClass() ?>"><?php echo $staffdisciplinary_action_preview->CaseNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->CaseNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_action_preview->CaseNo->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->CaseNo->Name && $staffdisciplinary_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_preview->CaseNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->CaseNo->Name) { ?><?php if ($staffdisciplinary_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($staffdisciplinary_action->SortUrl($staffdisciplinary_action_preview->OffenseCode) == "") { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->OffenseCode->headerCellClass() ?>"><?php echo $staffdisciplinary_action_preview->OffenseCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->OffenseCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_action_preview->OffenseCode->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->OffenseCode->Name && $staffdisciplinary_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_preview->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->OffenseCode->Name) { ?><?php if ($staffdisciplinary_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->ActionTaken->Visible) { // ActionTaken ?>
	<?php if ($staffdisciplinary_action->SortUrl($staffdisciplinary_action_preview->ActionTaken) == "") { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->ActionTaken->headerCellClass() ?>"><?php echo $staffdisciplinary_action_preview->ActionTaken->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->ActionTaken->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_action_preview->ActionTaken->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->ActionTaken->Name && $staffdisciplinary_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_preview->ActionTaken->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->ActionTaken->Name) { ?><?php if ($staffdisciplinary_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->ActionDate->Visible) { // ActionDate ?>
	<?php if ($staffdisciplinary_action->SortUrl($staffdisciplinary_action_preview->ActionDate) == "") { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->ActionDate->headerCellClass() ?>"><?php echo $staffdisciplinary_action_preview->ActionDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->ActionDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_action_preview->ActionDate->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->ActionDate->Name && $staffdisciplinary_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_preview->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->ActionDate->Name) { ?><?php if ($staffdisciplinary_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->FromDate->Visible) { // FromDate ?>
	<?php if ($staffdisciplinary_action->SortUrl($staffdisciplinary_action_preview->FromDate) == "") { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->FromDate->headerCellClass() ?>"><?php echo $staffdisciplinary_action_preview->FromDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->FromDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_action_preview->FromDate->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->FromDate->Name && $staffdisciplinary_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_preview->FromDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->FromDate->Name) { ?><?php if ($staffdisciplinary_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->ToDate->Visible) { // ToDate ?>
	<?php if ($staffdisciplinary_action->SortUrl($staffdisciplinary_action_preview->ToDate) == "") { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->ToDate->headerCellClass() ?>"><?php echo $staffdisciplinary_action_preview->ToDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $staffdisciplinary_action_preview->ToDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($staffdisciplinary_action_preview->ToDate->Name) ?>" data-sort-order="<?php echo $staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->ToDate->Name && $staffdisciplinary_action_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffdisciplinary_action_preview->ToDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffdisciplinary_action_preview->SortField == $staffdisciplinary_action_preview->ToDate->Name) { ?><?php if ($staffdisciplinary_action_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffdisciplinary_action_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffdisciplinary_action_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$staffdisciplinary_action_preview->RecCount = 0;
$staffdisciplinary_action_preview->RowCount = 0;
while ($staffdisciplinary_action_preview->Recordset && !$staffdisciplinary_action_preview->Recordset->EOF) {

	// Init row class and style
	$staffdisciplinary_action_preview->RecCount++;
	$staffdisciplinary_action_preview->RowCount++;
	$staffdisciplinary_action_preview->CssStyle = "";
	$staffdisciplinary_action_preview->loadListRowValues($staffdisciplinary_action_preview->Recordset);

	// Render row
	$staffdisciplinary_action->RowType = ROWTYPE_PREVIEW; // Preview record
	$staffdisciplinary_action_preview->resetAttributes();
	$staffdisciplinary_action_preview->renderListRow();

	// Render list options
	$staffdisciplinary_action_preview->renderListOptions();
?>
	<tr <?php echo $staffdisciplinary_action->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffdisciplinary_action_preview->ListOptions->render("body", "left", $staffdisciplinary_action_preview->RowCount);
?>
<?php if ($staffdisciplinary_action_preview->CaseNo->Visible) { // CaseNo ?>
		<!-- CaseNo -->
		<td<?php echo $staffdisciplinary_action_preview->CaseNo->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_action_preview->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_action_preview->CaseNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->OffenseCode->Visible) { // OffenseCode ?>
		<!-- OffenseCode -->
		<td<?php echo $staffdisciplinary_action_preview->OffenseCode->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_action_preview->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_action_preview->OffenseCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->ActionTaken->Visible) { // ActionTaken ?>
		<!-- ActionTaken -->
		<td<?php echo $staffdisciplinary_action_preview->ActionTaken->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_action_preview->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_action_preview->ActionTaken->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->ActionDate->Visible) { // ActionDate ?>
		<!-- ActionDate -->
		<td<?php echo $staffdisciplinary_action_preview->ActionDate->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_action_preview->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_preview->ActionDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->FromDate->Visible) { // FromDate ?>
		<!-- FromDate -->
		<td<?php echo $staffdisciplinary_action_preview->FromDate->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_action_preview->FromDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_preview->FromDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($staffdisciplinary_action_preview->ToDate->Visible) { // ToDate ?>
		<!-- ToDate -->
		<td<?php echo $staffdisciplinary_action_preview->ToDate->cellAttributes() ?>>
<span<?php echo $staffdisciplinary_action_preview->ToDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_preview->ToDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$staffdisciplinary_action_preview->ListOptions->render("body", "right", $staffdisciplinary_action_preview->RowCount);
?>
	</tr>
<?php
	$staffdisciplinary_action_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $staffdisciplinary_action_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($staffdisciplinary_action_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($staffdisciplinary_action_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$staffdisciplinary_action_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($staffdisciplinary_action_preview->Recordset)
	$staffdisciplinary_action_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$staffdisciplinary_action_preview->terminate();
?>