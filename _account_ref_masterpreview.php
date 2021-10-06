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
$_account_ref_master_preview = new _account_ref_master_preview();

// Run the page
$_account_ref_master_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_account_ref_master_preview->Page_Render();
?>
<?php $_account_ref_master_preview->showPageHeader(); ?>
<?php if ($_account_ref_master_preview->TotalRecords > 0) { ?>
<div class="card ew-grid _account_ref_master"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$_account_ref_master_preview->renderListOptions();

// Render list options (header, left)
$_account_ref_master_preview->ListOptions->render("header", "left");
?>
<?php if ($_account_ref_master_preview->AccountCode->Visible) { // AccountCode ?>
	<?php if ($_account_ref_master->SortUrl($_account_ref_master_preview->AccountCode) == "") { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountCode->headerCellClass() ?>"><?php echo $_account_ref_master_preview->AccountCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_account_ref_master_preview->AccountCode->Name) ?>" data-sort-order="<?php echo $_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountCode->Name && $_account_ref_master_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_preview->AccountCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountCode->Name) { ?><?php if ($_account_ref_master_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountName->Visible) { // AccountName ?>
	<?php if ($_account_ref_master->SortUrl($_account_ref_master_preview->AccountName) == "") { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountName->headerCellClass() ?>"><?php echo $_account_ref_master_preview->AccountName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_account_ref_master_preview->AccountName->Name) ?>" data-sort-order="<?php echo $_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountName->Name && $_account_ref_master_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_preview->AccountName->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountName->Name) { ?><?php if ($_account_ref_master_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($_account_ref_master->SortUrl($_account_ref_master_preview->AccountGroupCode) == "") { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountGroupCode->headerCellClass() ?>"><?php echo $_account_ref_master_preview->AccountGroupCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountGroupCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_account_ref_master_preview->AccountGroupCode->Name) ?>" data-sort-order="<?php echo $_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountGroupCode->Name && $_account_ref_master_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_preview->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountGroupCode->Name) { ?><?php if ($_account_ref_master_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountDesc->Visible) { // AccountDesc ?>
	<?php if ($_account_ref_master->SortUrl($_account_ref_master_preview->AccountDesc) == "") { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountDesc->headerCellClass() ?>"><?php echo $_account_ref_master_preview->AccountDesc->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountDesc->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_account_ref_master_preview->AccountDesc->Name) ?>" data-sort-order="<?php echo $_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountDesc->Name && $_account_ref_master_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_preview->AccountDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountDesc->Name) { ?><?php if ($_account_ref_master_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_preview->Amount->Visible) { // Amount ?>
	<?php if ($_account_ref_master->SortUrl($_account_ref_master_preview->Amount) == "") { ?>
		<th class="<?php echo $_account_ref_master_preview->Amount->headerCellClass() ?>"><?php echo $_account_ref_master_preview->Amount->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_account_ref_master_preview->Amount->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_account_ref_master_preview->Amount->Name) ?>" data-sort-order="<?php echo $_account_ref_master_preview->SortField == $_account_ref_master_preview->Amount->Name && $_account_ref_master_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_preview->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_preview->SortField == $_account_ref_master_preview->Amount->Name) { ?><?php if ($_account_ref_master_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountType->Visible) { // AccountType ?>
	<?php if ($_account_ref_master->SortUrl($_account_ref_master_preview->AccountType) == "") { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountType->headerCellClass() ?>"><?php echo $_account_ref_master_preview->AccountType->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountType->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_account_ref_master_preview->AccountType->Name) ?>" data-sort-order="<?php echo $_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountType->Name && $_account_ref_master_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_preview->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountType->Name) { ?><?php if ($_account_ref_master_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<?php if ($_account_ref_master->SortUrl($_account_ref_master_preview->AccountSubGroupCode) == "") { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountSubGroupCode->headerCellClass() ?>"><?php echo $_account_ref_master_preview->AccountSubGroupCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $_account_ref_master_preview->AccountSubGroupCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($_account_ref_master_preview->AccountSubGroupCode->Name) ?>" data-sort-order="<?php echo $_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountSubGroupCode->Name && $_account_ref_master_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_preview->AccountSubGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_preview->SortField == $_account_ref_master_preview->AccountSubGroupCode->Name) { ?><?php if ($_account_ref_master_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_account_ref_master_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$_account_ref_master_preview->RecCount = 0;
$_account_ref_master_preview->RowCount = 0;
while ($_account_ref_master_preview->Recordset && !$_account_ref_master_preview->Recordset->EOF) {

	// Init row class and style
	$_account_ref_master_preview->RecCount++;
	$_account_ref_master_preview->RowCount++;
	$_account_ref_master_preview->CssStyle = "";
	$_account_ref_master_preview->loadListRowValues($_account_ref_master_preview->Recordset);

	// Render row
	$_account_ref_master->RowType = ROWTYPE_PREVIEW; // Preview record
	$_account_ref_master_preview->resetAttributes();
	$_account_ref_master_preview->renderListRow();

	// Render list options
	$_account_ref_master_preview->renderListOptions();
?>
	<tr <?php echo $_account_ref_master->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_account_ref_master_preview->ListOptions->render("body", "left", $_account_ref_master_preview->RowCount);
?>
<?php if ($_account_ref_master_preview->AccountCode->Visible) { // AccountCode ?>
		<!-- AccountCode -->
		<td<?php echo $_account_ref_master_preview->AccountCode->cellAttributes() ?>>
<span<?php echo $_account_ref_master_preview->AccountCode->viewAttributes() ?>><?php echo $_account_ref_master_preview->AccountCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountName->Visible) { // AccountName ?>
		<!-- AccountName -->
		<td<?php echo $_account_ref_master_preview->AccountName->cellAttributes() ?>>
<span<?php echo $_account_ref_master_preview->AccountName->viewAttributes() ?>><?php echo $_account_ref_master_preview->AccountName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<!-- AccountGroupCode -->
		<td<?php echo $_account_ref_master_preview->AccountGroupCode->cellAttributes() ?>>
<span<?php echo $_account_ref_master_preview->AccountGroupCode->viewAttributes() ?>><?php echo $_account_ref_master_preview->AccountGroupCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountDesc->Visible) { // AccountDesc ?>
		<!-- AccountDesc -->
		<td<?php echo $_account_ref_master_preview->AccountDesc->cellAttributes() ?>>
<span<?php echo $_account_ref_master_preview->AccountDesc->viewAttributes() ?>><?php echo $_account_ref_master_preview->AccountDesc->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_account_ref_master_preview->Amount->Visible) { // Amount ?>
		<!-- Amount -->
		<td<?php echo $_account_ref_master_preview->Amount->cellAttributes() ?>>
<span<?php echo $_account_ref_master_preview->Amount->viewAttributes() ?>><?php echo $_account_ref_master_preview->Amount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountType->Visible) { // AccountType ?>
		<!-- AccountType -->
		<td<?php echo $_account_ref_master_preview->AccountType->cellAttributes() ?>>
<span<?php echo $_account_ref_master_preview->AccountType->viewAttributes() ?>><?php echo $_account_ref_master_preview->AccountType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($_account_ref_master_preview->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<!-- AccountSubGroupCode -->
		<td<?php echo $_account_ref_master_preview->AccountSubGroupCode->cellAttributes() ?>>
<span<?php echo $_account_ref_master_preview->AccountSubGroupCode->viewAttributes() ?>><?php echo $_account_ref_master_preview->AccountSubGroupCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$_account_ref_master_preview->ListOptions->render("body", "right", $_account_ref_master_preview->RowCount);
?>
	</tr>
<?php
	$_account_ref_master_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $_account_ref_master_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($_account_ref_master_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($_account_ref_master_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$_account_ref_master_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($_account_ref_master_preview->Recordset)
	$_account_ref_master_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$_account_ref_master_preview->terminate();
?>