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
$la_bank_account_preview = new la_bank_account_preview();

// Run the page
$la_bank_account_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_preview->Page_Render();
?>
<?php $la_bank_account_preview->showPageHeader(); ?>
<?php if ($la_bank_account_preview->TotalRecords > 0) { ?>
<div class="card ew-grid la_bank_account"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$la_bank_account_preview->renderListOptions();

// Render list options (header, left)
$la_bank_account_preview->ListOptions->render("header", "left");
?>
<?php if ($la_bank_account_preview->BankCode->Visible) { // BankCode ?>
	<?php if ($la_bank_account->SortUrl($la_bank_account_preview->BankCode) == "") { ?>
		<th class="<?php echo $la_bank_account_preview->BankCode->headerCellClass() ?>"><?php echo $la_bank_account_preview->BankCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_bank_account_preview->BankCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_bank_account_preview->BankCode->Name) ?>" data-sort-order="<?php echo $la_bank_account_preview->SortField == $la_bank_account_preview->BankCode->Name && $la_bank_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_preview->BankCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_preview->SortField == $la_bank_account_preview->BankCode->Name) { ?><?php if ($la_bank_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_preview->BranchCode->Visible) { // BranchCode ?>
	<?php if ($la_bank_account->SortUrl($la_bank_account_preview->BranchCode) == "") { ?>
		<th class="<?php echo $la_bank_account_preview->BranchCode->headerCellClass() ?>"><?php echo $la_bank_account_preview->BranchCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_bank_account_preview->BranchCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_bank_account_preview->BranchCode->Name) ?>" data-sort-order="<?php echo $la_bank_account_preview->SortField == $la_bank_account_preview->BranchCode->Name && $la_bank_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_preview->BranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_preview->SortField == $la_bank_account_preview->BranchCode->Name) { ?><?php if ($la_bank_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_preview->AccountName->Visible) { // AccountName ?>
	<?php if ($la_bank_account->SortUrl($la_bank_account_preview->AccountName) == "") { ?>
		<th class="<?php echo $la_bank_account_preview->AccountName->headerCellClass() ?>"><?php echo $la_bank_account_preview->AccountName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_bank_account_preview->AccountName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_bank_account_preview->AccountName->Name) ?>" data-sort-order="<?php echo $la_bank_account_preview->SortField == $la_bank_account_preview->AccountName->Name && $la_bank_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_preview->AccountName->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_preview->SortField == $la_bank_account_preview->AccountName->Name) { ?><?php if ($la_bank_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_preview->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($la_bank_account->SortUrl($la_bank_account_preview->BankAccountNo) == "") { ?>
		<th class="<?php echo $la_bank_account_preview->BankAccountNo->headerCellClass() ?>"><?php echo $la_bank_account_preview->BankAccountNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_bank_account_preview->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_bank_account_preview->BankAccountNo->Name) ?>" data-sort-order="<?php echo $la_bank_account_preview->SortField == $la_bank_account_preview->BankAccountNo->Name && $la_bank_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_preview->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_preview->SortField == $la_bank_account_preview->BankAccountNo->Name) { ?><?php if ($la_bank_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_preview->LACode->Visible) { // LACode ?>
	<?php if ($la_bank_account->SortUrl($la_bank_account_preview->LACode) == "") { ?>
		<th class="<?php echo $la_bank_account_preview->LACode->headerCellClass() ?>"><?php echo $la_bank_account_preview->LACode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $la_bank_account_preview->LACode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($la_bank_account_preview->LACode->Name) ?>" data-sort-order="<?php echo $la_bank_account_preview->SortField == $la_bank_account_preview->LACode->Name && $la_bank_account_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_preview->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_preview->SortField == $la_bank_account_preview->LACode->Name) { ?><?php if ($la_bank_account_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$la_bank_account_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$la_bank_account_preview->RecCount = 0;
$la_bank_account_preview->RowCount = 0;
while ($la_bank_account_preview->Recordset && !$la_bank_account_preview->Recordset->EOF) {

	// Init row class and style
	$la_bank_account_preview->RecCount++;
	$la_bank_account_preview->RowCount++;
	$la_bank_account_preview->CssStyle = "";
	$la_bank_account_preview->loadListRowValues($la_bank_account_preview->Recordset);

	// Render row
	$la_bank_account->RowType = ROWTYPE_PREVIEW; // Preview record
	$la_bank_account_preview->resetAttributes();
	$la_bank_account_preview->renderListRow();

	// Render list options
	$la_bank_account_preview->renderListOptions();
?>
	<tr <?php echo $la_bank_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_bank_account_preview->ListOptions->render("body", "left", $la_bank_account_preview->RowCount);
?>
<?php if ($la_bank_account_preview->BankCode->Visible) { // BankCode ?>
		<!-- BankCode -->
		<td<?php echo $la_bank_account_preview->BankCode->cellAttributes() ?>>
<span<?php echo $la_bank_account_preview->BankCode->viewAttributes() ?>><?php echo $la_bank_account_preview->BankCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($la_bank_account_preview->BranchCode->Visible) { // BranchCode ?>
		<!-- BranchCode -->
		<td<?php echo $la_bank_account_preview->BranchCode->cellAttributes() ?>>
<span<?php echo $la_bank_account_preview->BranchCode->viewAttributes() ?>><?php echo $la_bank_account_preview->BranchCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($la_bank_account_preview->AccountName->Visible) { // AccountName ?>
		<!-- AccountName -->
		<td<?php echo $la_bank_account_preview->AccountName->cellAttributes() ?>>
<span<?php echo $la_bank_account_preview->AccountName->viewAttributes() ?>><?php echo $la_bank_account_preview->AccountName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($la_bank_account_preview->BankAccountNo->Visible) { // BankAccountNo ?>
		<!-- BankAccountNo -->
		<td<?php echo $la_bank_account_preview->BankAccountNo->cellAttributes() ?>>
<span<?php echo $la_bank_account_preview->BankAccountNo->viewAttributes() ?>><?php echo $la_bank_account_preview->BankAccountNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($la_bank_account_preview->LACode->Visible) { // LACode ?>
		<!-- LACode -->
		<td<?php echo $la_bank_account_preview->LACode->cellAttributes() ?>>
<span<?php echo $la_bank_account_preview->LACode->viewAttributes() ?>><?php echo $la_bank_account_preview->LACode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$la_bank_account_preview->ListOptions->render("body", "right", $la_bank_account_preview->RowCount);
?>
	</tr>
<?php
	$la_bank_account_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $la_bank_account_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($la_bank_account_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($la_bank_account_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$la_bank_account_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($la_bank_account_preview->Recordset)
	$la_bank_account_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$la_bank_account_preview->terminate();
?>