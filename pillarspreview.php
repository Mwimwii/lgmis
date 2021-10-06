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
$pillars_preview = new pillars_preview();

// Run the page
$pillars_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_preview->Page_Render();
?>
<?php $pillars_preview->showPageHeader(); ?>
<?php if ($pillars_preview->TotalRecords > 0) { ?>
<div class="card ew-grid pillars"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$pillars_preview->renderListOptions();

// Render list options (header, left)
$pillars_preview->ListOptions->render("header", "left");
?>
<?php if ($pillars_preview->NDP->Visible) { // NDP ?>
	<?php if ($pillars->SortUrl($pillars_preview->NDP) == "") { ?>
		<th class="<?php echo $pillars_preview->NDP->headerCellClass() ?>"><?php echo $pillars_preview->NDP->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $pillars_preview->NDP->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($pillars_preview->NDP->Name) ?>" data-sort-order="<?php echo $pillars_preview->SortField == $pillars_preview->NDP->Name && $pillars_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_preview->NDP->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_preview->SortField == $pillars_preview->NDP->Name) { ?><?php if ($pillars_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pillars_preview->PillarNo->Visible) { // PillarNo ?>
	<?php if ($pillars->SortUrl($pillars_preview->PillarNo) == "") { ?>
		<th class="<?php echo $pillars_preview->PillarNo->headerCellClass() ?>"><?php echo $pillars_preview->PillarNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $pillars_preview->PillarNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($pillars_preview->PillarNo->Name) ?>" data-sort-order="<?php echo $pillars_preview->SortField == $pillars_preview->PillarNo->Name && $pillars_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_preview->PillarNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_preview->SortField == $pillars_preview->PillarNo->Name) { ?><?php if ($pillars_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pillars_preview->PillarName->Visible) { // PillarName ?>
	<?php if ($pillars->SortUrl($pillars_preview->PillarName) == "") { ?>
		<th class="<?php echo $pillars_preview->PillarName->headerCellClass() ?>"><?php echo $pillars_preview->PillarName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $pillars_preview->PillarName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($pillars_preview->PillarName->Name) ?>" data-sort-order="<?php echo $pillars_preview->SortField == $pillars_preview->PillarName->Name && $pillars_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pillars_preview->PillarName->caption() ?></span><span class="ew-table-header-sort"><?php if ($pillars_preview->SortField == $pillars_preview->PillarName->Name) { ?><?php if ($pillars_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pillars_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pillars_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$pillars_preview->RecCount = 0;
$pillars_preview->RowCount = 0;
while ($pillars_preview->Recordset && !$pillars_preview->Recordset->EOF) {

	// Init row class and style
	$pillars_preview->RecCount++;
	$pillars_preview->RowCount++;
	$pillars_preview->CssStyle = "";
	$pillars_preview->loadListRowValues($pillars_preview->Recordset);

	// Render row
	$pillars->RowType = ROWTYPE_PREVIEW; // Preview record
	$pillars_preview->resetAttributes();
	$pillars_preview->renderListRow();

	// Render list options
	$pillars_preview->renderListOptions();
?>
	<tr <?php echo $pillars->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pillars_preview->ListOptions->render("body", "left", $pillars_preview->RowCount);
?>
<?php if ($pillars_preview->NDP->Visible) { // NDP ?>
		<!-- NDP -->
		<td<?php echo $pillars_preview->NDP->cellAttributes() ?>>
<span<?php echo $pillars_preview->NDP->viewAttributes() ?>><?php echo $pillars_preview->NDP->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($pillars_preview->PillarNo->Visible) { // PillarNo ?>
		<!-- PillarNo -->
		<td<?php echo $pillars_preview->PillarNo->cellAttributes() ?>>
<span<?php echo $pillars_preview->PillarNo->viewAttributes() ?>><?php echo $pillars_preview->PillarNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($pillars_preview->PillarName->Visible) { // PillarName ?>
		<!-- PillarName -->
		<td<?php echo $pillars_preview->PillarName->cellAttributes() ?>>
<span<?php echo $pillars_preview->PillarName->viewAttributes() ?>><?php echo $pillars_preview->PillarName->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$pillars_preview->ListOptions->render("body", "right", $pillars_preview->RowCount);
?>
	</tr>
<?php
	$pillars_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $pillars_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($pillars_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($pillars_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$pillars_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($pillars_preview->Recordset)
	$pillars_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$pillars_preview->terminate();
?>