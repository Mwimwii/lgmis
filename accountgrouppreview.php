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
$accountgroup_preview = new accountgroup_preview();

// Run the page
$accountgroup_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accountgroup_preview->Page_Render();
?>
<?php $accountgroup_preview->showPageHeader(); ?>
<?php if ($accountgroup_preview->TotalRecords > 0) { ?>
<div class="card ew-grid accountgroup"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$accountgroup_preview->renderListOptions();

// Render list options (header, left)
$accountgroup_preview->ListOptions->render("header", "left");
?>
<?php if ($accountgroup_preview->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($accountgroup->SortUrl($accountgroup_preview->AccountGroupCode) == "") { ?>
		<th class="<?php echo $accountgroup_preview->AccountGroupCode->headerCellClass() ?>"><?php echo $accountgroup_preview->AccountGroupCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $accountgroup_preview->AccountGroupCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($accountgroup_preview->AccountGroupCode->Name) ?>" data-sort-order="<?php echo $accountgroup_preview->SortField == $accountgroup_preview->AccountGroupCode->Name && $accountgroup_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_preview->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_preview->SortField == $accountgroup_preview->AccountGroupCode->Name) { ?><?php if ($accountgroup_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accountgroup_preview->AccountGroupName->Visible) { // AccountGroupName ?>
	<?php if ($accountgroup->SortUrl($accountgroup_preview->AccountGroupName) == "") { ?>
		<th class="<?php echo $accountgroup_preview->AccountGroupName->headerCellClass() ?>"><?php echo $accountgroup_preview->AccountGroupName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $accountgroup_preview->AccountGroupName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($accountgroup_preview->AccountGroupName->Name) ?>" data-sort-order="<?php echo $accountgroup_preview->SortField == $accountgroup_preview->AccountGroupName->Name && $accountgroup_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_preview->AccountGroupName->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_preview->SortField == $accountgroup_preview->AccountGroupName->Name) { ?><?php if ($accountgroup_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accountgroup_preview->AccountType->Visible) { // AccountType ?>
	<?php if ($accountgroup->SortUrl($accountgroup_preview->AccountType) == "") { ?>
		<th class="<?php echo $accountgroup_preview->AccountType->headerCellClass() ?>"><?php echo $accountgroup_preview->AccountType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $accountgroup_preview->AccountType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($accountgroup_preview->AccountType->Name) ?>" data-sort-order="<?php echo $accountgroup_preview->SortField == $accountgroup_preview->AccountType->Name && $accountgroup_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_preview->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_preview->SortField == $accountgroup_preview->AccountType->Name) { ?><?php if ($accountgroup_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$accountgroup_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$accountgroup_preview->RecCount = 0;
$accountgroup_preview->RowCount = 0;
while ($accountgroup_preview->Recordset && !$accountgroup_preview->Recordset->EOF) {

	// Init row class and style
	$accountgroup_preview->RecCount++;
	$accountgroup_preview->RowCount++;
	$accountgroup_preview->CssStyle = "";
	$accountgroup_preview->loadListRowValues($accountgroup_preview->Recordset);

	// Render row
	$accountgroup->RowType = ROWTYPE_PREVIEW; // Preview record
	$accountgroup_preview->resetAttributes();
	$accountgroup_preview->renderListRow();

	// Render list options
	$accountgroup_preview->renderListOptions();
?>
	<tr <?php echo $accountgroup->rowAttributes() ?>>
<?php

// Render list options (body, left)
$accountgroup_preview->ListOptions->render("body", "left", $accountgroup_preview->RowCount);
?>
<?php if ($accountgroup_preview->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<!-- AccountGroupCode -->
		<td<?php echo $accountgroup_preview->AccountGroupCode->cellAttributes() ?>>
<span<?php echo $accountgroup_preview->AccountGroupCode->viewAttributes() ?>><?php echo $accountgroup_preview->AccountGroupCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($accountgroup_preview->AccountGroupName->Visible) { // AccountGroupName ?>
		<!-- AccountGroupName -->
		<td<?php echo $accountgroup_preview->AccountGroupName->cellAttributes() ?>>
<span<?php echo $accountgroup_preview->AccountGroupName->viewAttributes() ?>><?php echo $accountgroup_preview->AccountGroupName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($accountgroup_preview->AccountType->Visible) { // AccountType ?>
		<!-- AccountType -->
		<td<?php echo $accountgroup_preview->AccountType->cellAttributes() ?>>
<span<?php echo $accountgroup_preview->AccountType->viewAttributes() ?>><?php echo $accountgroup_preview->AccountType->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$accountgroup_preview->ListOptions->render("body", "right", $accountgroup_preview->RowCount);
?>
	</tr>
<?php
	$accountgroup_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $accountgroup_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($accountgroup_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($accountgroup_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$accountgroup_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($accountgroup_preview->Recordset)
	$accountgroup_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$accountgroup_preview->terminate();
?>