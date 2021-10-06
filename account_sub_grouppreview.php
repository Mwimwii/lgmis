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
$account_sub_group_preview = new account_sub_group_preview();

// Run the page
$account_sub_group_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$account_sub_group_preview->Page_Render();
?>
<?php $account_sub_group_preview->showPageHeader(); ?>
<?php if ($account_sub_group_preview->TotalRecords > 0) { ?>
<div class="card ew-grid account_sub_group"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$account_sub_group_preview->renderListOptions();

// Render list options (header, left)
$account_sub_group_preview->ListOptions->render("header", "left");
?>
<?php if ($account_sub_group_preview->AccountType->Visible) { // AccountType ?>
	<?php if ($account_sub_group->SortUrl($account_sub_group_preview->AccountType) == "") { ?>
		<th class="<?php echo $account_sub_group_preview->AccountType->headerCellClass() ?>"><?php echo $account_sub_group_preview->AccountType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $account_sub_group_preview->AccountType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($account_sub_group_preview->AccountType->Name) ?>" data-sort-order="<?php echo $account_sub_group_preview->SortField == $account_sub_group_preview->AccountType->Name && $account_sub_group_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_preview->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_preview->SortField == $account_sub_group_preview->AccountType->Name) { ?><?php if ($account_sub_group_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_preview->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($account_sub_group->SortUrl($account_sub_group_preview->AccountGroupCode) == "") { ?>
		<th class="<?php echo $account_sub_group_preview->AccountGroupCode->headerCellClass() ?>"><?php echo $account_sub_group_preview->AccountGroupCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $account_sub_group_preview->AccountGroupCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($account_sub_group_preview->AccountGroupCode->Name) ?>" data-sort-order="<?php echo $account_sub_group_preview->SortField == $account_sub_group_preview->AccountGroupCode->Name && $account_sub_group_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_preview->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_preview->SortField == $account_sub_group_preview->AccountGroupCode->Name) { ?><?php if ($account_sub_group_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_preview->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<?php if ($account_sub_group->SortUrl($account_sub_group_preview->AccountSubGroupCode) == "") { ?>
		<th class="<?php echo $account_sub_group_preview->AccountSubGroupCode->headerCellClass() ?>"><?php echo $account_sub_group_preview->AccountSubGroupCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $account_sub_group_preview->AccountSubGroupCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($account_sub_group_preview->AccountSubGroupCode->Name) ?>" data-sort-order="<?php echo $account_sub_group_preview->SortField == $account_sub_group_preview->AccountSubGroupCode->Name && $account_sub_group_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_preview->AccountSubGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_preview->SortField == $account_sub_group_preview->AccountSubGroupCode->Name) { ?><?php if ($account_sub_group_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_preview->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
	<?php if ($account_sub_group->SortUrl($account_sub_group_preview->AccountSubGroupName) == "") { ?>
		<th class="<?php echo $account_sub_group_preview->AccountSubGroupName->headerCellClass() ?>"><?php echo $account_sub_group_preview->AccountSubGroupName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $account_sub_group_preview->AccountSubGroupName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($account_sub_group_preview->AccountSubGroupName->Name) ?>" data-sort-order="<?php echo $account_sub_group_preview->SortField == $account_sub_group_preview->AccountSubGroupName->Name && $account_sub_group_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_preview->AccountSubGroupName->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_preview->SortField == $account_sub_group_preview->AccountSubGroupName->Name) { ?><?php if ($account_sub_group_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$account_sub_group_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$account_sub_group_preview->RecCount = 0;
$account_sub_group_preview->RowCount = 0;
while ($account_sub_group_preview->Recordset && !$account_sub_group_preview->Recordset->EOF) {

	// Init row class and style
	$account_sub_group_preview->RecCount++;
	$account_sub_group_preview->RowCount++;
	$account_sub_group_preview->CssStyle = "";
	$account_sub_group_preview->loadListRowValues($account_sub_group_preview->Recordset);

	// Render row
	$account_sub_group->RowType = ROWTYPE_PREVIEW; // Preview record
	$account_sub_group_preview->resetAttributes();
	$account_sub_group_preview->renderListRow();

	// Render list options
	$account_sub_group_preview->renderListOptions();
?>
	<tr <?php echo $account_sub_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$account_sub_group_preview->ListOptions->render("body", "left", $account_sub_group_preview->RowCount);
?>
<?php if ($account_sub_group_preview->AccountType->Visible) { // AccountType ?>
		<!-- AccountType -->
		<td<?php echo $account_sub_group_preview->AccountType->cellAttributes() ?>>
<span<?php echo $account_sub_group_preview->AccountType->viewAttributes() ?>><?php echo $account_sub_group_preview->AccountType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($account_sub_group_preview->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<!-- AccountGroupCode -->
		<td<?php echo $account_sub_group_preview->AccountGroupCode->cellAttributes() ?>>
<span<?php echo $account_sub_group_preview->AccountGroupCode->viewAttributes() ?>><?php echo $account_sub_group_preview->AccountGroupCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($account_sub_group_preview->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<!-- AccountSubGroupCode -->
		<td<?php echo $account_sub_group_preview->AccountSubGroupCode->cellAttributes() ?>>
<span<?php echo $account_sub_group_preview->AccountSubGroupCode->viewAttributes() ?>><?php echo $account_sub_group_preview->AccountSubGroupCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($account_sub_group_preview->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
		<!-- AccountSubGroupName -->
		<td<?php echo $account_sub_group_preview->AccountSubGroupName->cellAttributes() ?>>
<span<?php echo $account_sub_group_preview->AccountSubGroupName->viewAttributes() ?>><?php echo $account_sub_group_preview->AccountSubGroupName->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$account_sub_group_preview->ListOptions->render("body", "right", $account_sub_group_preview->RowCount);
?>
	</tr>
<?php
	$account_sub_group_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $account_sub_group_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($account_sub_group_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($account_sub_group_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$account_sub_group_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($account_sub_group_preview->Recordset)
	$account_sub_group_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$account_sub_group_preview->terminate();
?>