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
$bank_branch_preview = new bank_branch_preview();

// Run the page
$bank_branch_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_branch_preview->Page_Render();
?>
<?php $bank_branch_preview->showPageHeader(); ?>
<?php if ($bank_branch_preview->TotalRecords > 0) { ?>
<div class="card ew-grid bank_branch"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$bank_branch_preview->renderListOptions();

// Render list options (header, left)
$bank_branch_preview->ListOptions->render("header", "left");
?>
<?php if ($bank_branch_preview->BranchCode->Visible) { // BranchCode ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BranchCode) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BranchCode->headerCellClass() ?>"><?php echo $bank_branch_preview->BranchCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BranchCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BranchCode->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BranchCode->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BranchCode->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->BranchName->Visible) { // BranchName ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BranchName) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BranchName->headerCellClass() ?>"><?php echo $bank_branch_preview->BranchName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BranchName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BranchName->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BranchName->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BranchName->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BranchName->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->BankCode->Visible) { // BankCode ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BankCode) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BankCode->headerCellClass() ?>"><?php echo $bank_branch_preview->BankCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BankCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BankCode->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BankCode->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BankCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BankCode->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->AreaCode->Visible) { // AreaCode ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->AreaCode) == "") { ?>
		<th class="<?php echo $bank_branch_preview->AreaCode->headerCellClass() ?>"><?php echo $bank_branch_preview->AreaCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->AreaCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->AreaCode->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->AreaCode->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->AreaCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->AreaCode->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->BranchNo->Visible) { // BranchNo ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BranchNo) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BranchNo->headerCellClass() ?>"><?php echo $bank_branch_preview->BranchNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BranchNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BranchNo->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BranchNo->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BranchNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BranchNo->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->BranchAddress->Visible) { // BranchAddress ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BranchAddress) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BranchAddress->headerCellClass() ?>"><?php echo $bank_branch_preview->BranchAddress->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BranchAddress->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BranchAddress->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BranchAddress->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BranchAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BranchAddress->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->BranchTel->Visible) { // BranchTel ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BranchTel) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BranchTel->headerCellClass() ?>"><?php echo $bank_branch_preview->BranchTel->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BranchTel->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BranchTel->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BranchTel->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BranchTel->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BranchTel->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->BranchEmail->Visible) { // BranchEmail ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BranchEmail) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BranchEmail->headerCellClass() ?>"><?php echo $bank_branch_preview->BranchEmail->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BranchEmail->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BranchEmail->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BranchEmail->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BranchEmail->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BranchEmail->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->BranchFax->Visible) { // BranchFax ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->BranchFax) == "") { ?>
		<th class="<?php echo $bank_branch_preview->BranchFax->headerCellClass() ?>"><?php echo $bank_branch_preview->BranchFax->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->BranchFax->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->BranchFax->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->BranchFax->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->BranchFax->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->BranchFax->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->SWIFT->Visible) { // SWIFT ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->SWIFT) == "") { ?>
		<th class="<?php echo $bank_branch_preview->SWIFT->headerCellClass() ?>"><?php echo $bank_branch_preview->SWIFT->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->SWIFT->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->SWIFT->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->SWIFT->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->SWIFT->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->SWIFT->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_branch_preview->IBAN->Visible) { // IBAN ?>
	<?php if ($bank_branch->SortUrl($bank_branch_preview->IBAN) == "") { ?>
		<th class="<?php echo $bank_branch_preview->IBAN->headerCellClass() ?>"><?php echo $bank_branch_preview->IBAN->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bank_branch_preview->IBAN->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bank_branch_preview->IBAN->Name) ?>" data-sort-order="<?php echo $bank_branch_preview->SortField == $bank_branch_preview->IBAN->Name && $bank_branch_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_branch_preview->IBAN->caption() ?></span><span class="ew-table-header-sort"><?php if ($bank_branch_preview->SortField == $bank_branch_preview->IBAN->Name) { ?><?php if ($bank_branch_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_branch_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bank_branch_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$bank_branch_preview->RecCount = 0;
$bank_branch_preview->RowCount = 0;
while ($bank_branch_preview->Recordset && !$bank_branch_preview->Recordset->EOF) {

	// Init row class and style
	$bank_branch_preview->RecCount++;
	$bank_branch_preview->RowCount++;
	$bank_branch_preview->CssStyle = "";
	$bank_branch_preview->loadListRowValues($bank_branch_preview->Recordset);

	// Render row
	$bank_branch->RowType = ROWTYPE_PREVIEW; // Preview record
	$bank_branch_preview->resetAttributes();
	$bank_branch_preview->renderListRow();

	// Render list options
	$bank_branch_preview->renderListOptions();
?>
	<tr <?php echo $bank_branch->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bank_branch_preview->ListOptions->render("body", "left", $bank_branch_preview->RowCount);
?>
<?php if ($bank_branch_preview->BranchCode->Visible) { // BranchCode ?>
		<!-- BranchCode -->
		<td<?php echo $bank_branch_preview->BranchCode->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BranchCode->viewAttributes() ?>><?php echo $bank_branch_preview->BranchCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->BranchName->Visible) { // BranchName ?>
		<!-- BranchName -->
		<td<?php echo $bank_branch_preview->BranchName->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BranchName->viewAttributes() ?>><?php echo $bank_branch_preview->BranchName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->BankCode->Visible) { // BankCode ?>
		<!-- BankCode -->
		<td<?php echo $bank_branch_preview->BankCode->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BankCode->viewAttributes() ?>><?php echo $bank_branch_preview->BankCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->AreaCode->Visible) { // AreaCode ?>
		<!-- AreaCode -->
		<td<?php echo $bank_branch_preview->AreaCode->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->AreaCode->viewAttributes() ?>><?php echo $bank_branch_preview->AreaCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->BranchNo->Visible) { // BranchNo ?>
		<!-- BranchNo -->
		<td<?php echo $bank_branch_preview->BranchNo->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BranchNo->viewAttributes() ?>><?php echo $bank_branch_preview->BranchNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->BranchAddress->Visible) { // BranchAddress ?>
		<!-- BranchAddress -->
		<td<?php echo $bank_branch_preview->BranchAddress->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BranchAddress->viewAttributes() ?>><?php echo $bank_branch_preview->BranchAddress->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->BranchTel->Visible) { // BranchTel ?>
		<!-- BranchTel -->
		<td<?php echo $bank_branch_preview->BranchTel->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BranchTel->viewAttributes() ?>><?php echo $bank_branch_preview->BranchTel->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->BranchEmail->Visible) { // BranchEmail ?>
		<!-- BranchEmail -->
		<td<?php echo $bank_branch_preview->BranchEmail->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BranchEmail->viewAttributes() ?>><?php echo $bank_branch_preview->BranchEmail->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->BranchFax->Visible) { // BranchFax ?>
		<!-- BranchFax -->
		<td<?php echo $bank_branch_preview->BranchFax->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->BranchFax->viewAttributes() ?>><?php echo $bank_branch_preview->BranchFax->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->SWIFT->Visible) { // SWIFT ?>
		<!-- SWIFT -->
		<td<?php echo $bank_branch_preview->SWIFT->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->SWIFT->viewAttributes() ?>><?php echo $bank_branch_preview->SWIFT->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bank_branch_preview->IBAN->Visible) { // IBAN ?>
		<!-- IBAN -->
		<td<?php echo $bank_branch_preview->IBAN->cellAttributes() ?>>
<span<?php echo $bank_branch_preview->IBAN->viewAttributes() ?>><?php echo $bank_branch_preview->IBAN->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$bank_branch_preview->ListOptions->render("body", "right", $bank_branch_preview->RowCount);
?>
	</tr>
<?php
	$bank_branch_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $bank_branch_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($bank_branch_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($bank_branch_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$bank_branch_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($bank_branch_preview->Recordset)
	$bank_branch_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$bank_branch_preview->terminate();
?>