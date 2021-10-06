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
$committee_appointed_preview = new committee_appointed_preview();

// Run the page
$committee_appointed_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_appointed_preview->Page_Render();
?>
<?php $committee_appointed_preview->showPageHeader(); ?>
<?php if ($committee_appointed_preview->TotalRecords > 0) { ?>
<div class="card ew-grid committee_appointed"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$committee_appointed_preview->renderListOptions();

// Render list options (header, left)
$committee_appointed_preview->ListOptions->render("header", "left");
?>
<?php if ($committee_appointed_preview->CommitteCode->Visible) { // CommitteCode ?>
	<?php if ($committee_appointed->SortUrl($committee_appointed_preview->CommitteCode) == "") { ?>
		<th class="<?php echo $committee_appointed_preview->CommitteCode->headerCellClass() ?>"><?php echo $committee_appointed_preview->CommitteCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $committee_appointed_preview->CommitteCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($committee_appointed_preview->CommitteCode->Name) ?>" data-sort-order="<?php echo $committee_appointed_preview->SortField == $committee_appointed_preview->CommitteCode->Name && $committee_appointed_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_appointed_preview->CommitteCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_appointed_preview->SortField == $committee_appointed_preview->CommitteCode->Name) { ?><?php if ($committee_appointed_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_appointed_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($committee_appointed_preview->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($committee_appointed->SortUrl($committee_appointed_preview->CommitteeRole) == "") { ?>
		<th class="<?php echo $committee_appointed_preview->CommitteeRole->headerCellClass() ?>"><?php echo $committee_appointed_preview->CommitteeRole->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $committee_appointed_preview->CommitteeRole->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($committee_appointed_preview->CommitteeRole->Name) ?>" data-sort-order="<?php echo $committee_appointed_preview->SortField == $committee_appointed_preview->CommitteeRole->Name && $committee_appointed_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_appointed_preview->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_appointed_preview->SortField == $committee_appointed_preview->CommitteeRole->Name) { ?><?php if ($committee_appointed_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_appointed_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$committee_appointed_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$committee_appointed_preview->RecCount = 0;
$committee_appointed_preview->RowCount = 0;
while ($committee_appointed_preview->Recordset && !$committee_appointed_preview->Recordset->EOF) {

	// Init row class and style
	$committee_appointed_preview->RecCount++;
	$committee_appointed_preview->RowCount++;
	$committee_appointed_preview->CssStyle = "";
	$committee_appointed_preview->loadListRowValues($committee_appointed_preview->Recordset);

	// Render row
	$committee_appointed->RowType = ROWTYPE_PREVIEW; // Preview record
	$committee_appointed_preview->resetAttributes();
	$committee_appointed_preview->renderListRow();

	// Render list options
	$committee_appointed_preview->renderListOptions();
?>
	<tr <?php echo $committee_appointed->rowAttributes() ?>>
<?php

// Render list options (body, left)
$committee_appointed_preview->ListOptions->render("body", "left", $committee_appointed_preview->RowCount);
?>
<?php if ($committee_appointed_preview->CommitteCode->Visible) { // CommitteCode ?>
		<!-- CommitteCode -->
		<td<?php echo $committee_appointed_preview->CommitteCode->cellAttributes() ?>>
<span<?php echo $committee_appointed_preview->CommitteCode->viewAttributes() ?>><?php echo $committee_appointed_preview->CommitteCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($committee_appointed_preview->CommitteeRole->Visible) { // CommitteeRole ?>
		<!-- CommitteeRole -->
		<td<?php echo $committee_appointed_preview->CommitteeRole->cellAttributes() ?>>
<span<?php echo $committee_appointed_preview->CommitteeRole->viewAttributes() ?>><?php echo $committee_appointed_preview->CommitteeRole->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$committee_appointed_preview->ListOptions->render("body", "right", $committee_appointed_preview->RowCount);
?>
	</tr>
<?php
	$committee_appointed_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $committee_appointed_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($committee_appointed_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($committee_appointed_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$committee_appointed_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($committee_appointed_preview->Recordset)
	$committee_appointed_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$committee_appointed_preview->terminate();
?>